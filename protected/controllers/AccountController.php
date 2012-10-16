<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * CONTROLLER : Account
 * Handles all user account related actions (including registration and login).
 *
 * @package     account
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class AccountController extends IndiosisController
{
    /**
     * Default action.
     */
    public function actionIndex()
    {
        $this->render('overview');
    }

    /**
     * Handles the registration process. (including LinkedIn users).
     */
    public function actionRegister()
    {
        $model = new SignupForm;
        $country_code = 'IN';

        if(isset($_POST['SignupForm']))
        {
            // collects user input data
            $model->attributes=$_POST['SignupForm'];

            if($model->validate()) {

                // create a random confirmation code
                $verif_code = md5(uniqid(rand()));
                $newUser = new User;
                $newUser->setAttributes($model->attributes);
                $newUser->password = md5($newUser->password);
                $newUser->joined_on = date("Y-m-d H:i:s");
                $newUser->verification_code = $verif_code;

                $newOrganization = new Organization;
                $newOrganization->name = $model->attributes['organization'];
                $newOrganization->type = $model->attributes['org_type'];
                $newOrganization->created_on = date("Y-m-d H:i:s");
                $newOrganization->save();

                $newOrgLocation = new Location;
                $newOrgLocation->label = 'main';
                $newOrgLocation->country = $model->attributes['org_country'];
                $newOrgLocation->Organization_id = $newOrganization->primaryKey;
                $newOrgLocation->save();

                $newUser->Organization_id = $newOrganization->primaryKey;
                $newUser->save();

                // send an email with the confirmation code.
                EmailHelper::sendAccountVerification($newUser,$verif_code);
                // send back success response
                echo Yii::app()->params['ajaxSuccess'];
            }
            else {
                // send back failure response
                echo Yii::app()->params['ajaxFailure'];
            }
            Yii::app()->end();
        }
        else {
            // get client's country code
            $country_code = file_get_contents('http://api.hostip.info/country.php?ip='.CHttpRequest::getUserHostAddress());
        }

        // display the login form
        $this->render('register',array('model'=>$model,'country_code'=>$country_code),false,true);
    }


    /*
     * AJAX > Handles the sign up ajax validation.
     */
    public function actionValidateSignUp()
    {
        $model = new SignupForm;
        if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Authorize Indiosis to access a user's LinkedIn account.
     */
    public function actionLinkedInAuthorize()
    {
        Yii::import('ext.simple-linkedin.*');

        $API_CONFIG = array(
          'appKey'       => Yii::app()->params['linkedinKey'],
          'appSecret'    => Yii::app()->params['linkedinSecret'],
          'callbackUrl'  => 'http://localhost/indiosis/account/linkedinhandle'
        );
        $linkedin = new LinkedIn($API_CONFIG);
        $request_token_response = $linkedin->retrieveTokenRequest();

        if($request_token_response === FALSE) {
                throw new CHttpException(502, 'The LinkedIn API seems to be down at this time. Please try again in a moment...');
        } else {
            $linkedInResponse = $request_token_response['linkedin'];
            Yii::app()->session['linkedin_oauth_token'] = $linkedInResponse['oauth_token'];
            Yii::app()->session['linkedin_oauth_token_secret'] = $linkedInResponse['oauth_token_secret'];
            Yii::app()->request->redirect("https://api.linkedin.com/uas/oauth/authorize?".urlencode('scope=r_basicprofile r_emailaddress')."&oauth_token=".urlencode($linkedInResponse['oauth_token']));
        }
    }

    /**
     * Handles responses from LinkedIn authorization API.
     */
    public function actionLinkedInHandle()
    {
        Yii::import('ext.simple-linkedin.*');

        $API_CONFIG = array(
          'appKey'       => Yii::app()->params['linkedinKey'],
          'appSecret'    => Yii::app()->params['linkedinSecret'],
          'callbackUrl'  => Yii::app()->params['linkedinBackUrl']
        );
        $linkedin = new LinkedIn($API_CONFIG);

        if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier']) && $_GET['oauth_token']==Yii::app()->session['linkedin_oauth_token'])
        {
            // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
            $response = $linkedin->retrieveTokenAccess(Yii::app()->session['linkedin_oauth_token'], Yii::app()->session['linkedin_oauth_token_secret'], $_GET['oauth_verifier']);

            if($response['success'] === TRUE)
            {
                $newLkdinUser = new User;
                $newLkdinUser->oauth_token = $response['linkedin']['oauth_token'];
                $newLkdinUser->oauth_secret = $response['linkedin']['oauth_token_secret'];
                // make the first API profile call to get user profile info
                $linkedin->setTokenAccess($response['linkedin']);
                $linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);
                $profileresp = $linkedin->profile('~:(id,first-name,last-name,email-address,positions)');
                if($profileresp['success'] === TRUE)
                {
                    $profileresp['linkedin'] = json_decode($profileresp['linkedin']);
                    $newLkdinUser->linkedin_id = $profileresp['linkedin']->id;
                    $newLkdinUser->email = $profileresp['linkedin']->emailAddress;
                    $newLkdinUser->firstName = $profileresp['linkedin']->firstName;
                    $newLkdinUser->lastName = $profileresp['linkedin']->lastName;
                    $newLkdinUser->title = $profileresp['linkedin']->positions->values[0]->title;
                    $newLkdinCompany = new Organization;
                    $newLkdinCompany->linkedin_id = $profileresp['linkedin']->positions->values[0]->company->id;
                    $newLkdinCompany->name = $profileresp['linkedin']->positions->values[0]->company->name;
                    $newLkdinCompany->verified = true;
                    $newLkdinCompany->anonymous = false;
                    $newLkdinCompany->created_on = date("Y-m-d H:i:s");;
                    // authenticate the user (register or login)
                    $this->authenticateLinkedIn($newLkdinUser,$newLkdinCompany);
                }
            }
            else {
                $message = "Failed fetching request token, response was: " . $response;
            }
        }
        else {
            $message = "You need to tell your LinkedIn account to grant access to Indiosis if you want to connect with your LinkedIn account.<br/>Click here to try again.";
        }
        $this->render('//layouts/notifications', array('message'=>$message));
    }


    /**
     * Verifiy account using confirmation code sent by email.
     */
    public function actionVerify()
    {
        $verified = false;
        // lookup if a user having that confirmation code exists
        $user=User::model()->findByAttributes(array('verification_code'=>$_GET['confirmationcode']));
        if($user) {
            $user->verification_code = 'verified';
            $user->save();
            $verified = true;
        }
        $this->render('verify',array('verified'=>$verified,'user'=>$user));
    }

    /**
     * Log In box action.
     */
    public function actionLogin()
    {
        $model = new LoginForm;
        $this->renderPartial('login',array('model'=>$model),false,true);
    }

    /**
     * AJAX > Authenticate an Indiosis User.
     */
    public function actionAuthenticate()
    {
        $model = new LoginForm;
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Handles authentication of a LinkedIn user.
     * @param array $lkdinUser LinkedIn user information array (including at least his ID)
     */
    protected function authenticateLinkedIn($lkdinUser,$lkdinCompany=null)
    {
        $record = User::model()->findByAttributes(array('linkedin_id'=>$lkdinUser->linkedin_id));
        if($record===null) {
            $lkdinUser->password = md5($lkdinUser->oauth_secret);
            $lkdinUser->joined_on = date("Y-m-d H:i:s");
            $lkdinUser->verification_code = "verified";
            $lkdinUser->Organization_id = 1;
            $lkdinUser->save();
        }
        $identity = new IndiosisUser($lkdinUser->email,$lkdinUser->oauth_secret);
        if(!$identity->authenticate()) {
            die("password incorrect");
        }
        else {
            Yii::app()->user->login($identity);
        }
        Yii::app()->request->redirect(Yii::app()->createUrl('profile/index'));
    }

    /**
     * Logout an Indiosis User.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        Yii::app()->request->redirect(Yii::app()->createUrl('home/index'));
    }
}