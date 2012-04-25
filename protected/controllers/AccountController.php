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
    
    public function actions() {}

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
        
        if(isset($_POST['SignupForm']))
        {
            // collects user input data
            $model->attributes=$_POST['SignupForm'];
            
            if($model->validate()) {
                // create a random confirmation code 
                $confirm_code = md5(uniqid(rand()));
                $newUser = new User;
                $newUser->setAttributes($model->attributes);
                $newUser->password = md5($newUser->password);
                $newUser->isExpert = 0;
                $newUser->date_joined = date("Y-m-d");
                $newUser->confirmationCode = $confirm_code;
                $newUser->verified = 0;
                
                // create the company if a name has been provided
                if($model->attributes['company']!='') {
                    $newCompany = new Company;
                    $newCompany->name = $model->attributes['company'];
                    $newCompany->date_created = date("Y-m-d");
                    $newCompany->anonymous = 1;
                    $newCompany->verified = 0;
                    $newCompany->CompanyType_id = 1;
                    $newCompany->save();
                    $newUser->Company_id = $newCompany->primaryKey;
                }
                $newUser->save();
                // send an email with the confirmation code.
                EmailHelper::sendAccountVerification($newUser,$confirm_code);
                // send back success response
                echo Yii::app()->params['ajaxSuccess'];
            }
            else {
                // send back failure response
                echo Yii::app()->params['ajaxFailure'];
            }
            Yii::app()->end();
        }
        // display the login form
        $this->render('register',array('model'=>$model),false,true);
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
        // Start an OAuth request to LinkedIn with Indiosis'key and secret  
        $oauth = new OAuth(Yii::app()->params['linkedinKey'], Yii::app()->params['linkedinSecret']);
        $oauth->disableSSLChecks(); // TODO : Remove to enable SSL
        $request_token_response = $oauth->getRequestToken('https://api.linkedin.com/uas/oauth/requestToken');
 
        // If API is up redirects to the "LinkedIn Grant Access page"
        if($request_token_response === FALSE) {
                throw new CHttpException(502, 'The LinkedIn API seems to be down at this time. Please try again in a moment...');
        } else {
            Yii::app()->session['linkedin_oauth_token'] = $request_token_response['oauth_token'];
            Yii::app()->session['linkedin_oauth_token_secret'] = $request_token_response['oauth_token_secret'];
            Yii::app()->request->redirect("https://api.linkedin.com/uas/oauth/authorize?oauth_token=".urlencode($request_token_response['oauth_token']));
        }
    }
    
    /**
     * Handles responses from LinkedIn authorization API.
     */
    public function actionLinkedInHandle()
    {
        $message = "A-OK";
        if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier']) && $_GET['oauth_token']==Yii::app()->session['linkedin_oauth_token'])
        {
            // Re-start an OAuth request to LinkedIn with Indiosis'key and secret  
            $oauth = new OAuth(Yii::app()->params['linkedinKey'], Yii::app()->params['linkedinSecret']);
            $oauth->disableSSLChecks(); // TODO : Remove to enable SSL
            $oauth->setToken(Yii::app()->session['linkedin_oauth_token'], Yii::app()->session['linkedin_oauth_token_secret']);
            $access_token_response = $oauth->getAccessToken("https://api.linkedin.com/uas/oauth/accessToken","", $_GET['oauth_verifier']);

            if($access_token_response === FALSE) {
                    throw new Exception("Failed fetching request token, response was: " . $oauth->getLastResponse());
            } else {
                    $message = $access_token_response;
            }
        }
        else {
            $message = "You need to tell your LinkedIn account to grant access to Indiosis if you want to connect with your LinkedIn account.<br/>Click here to try again.";
        }
        $this->render('linkedinotification',array('message'=>$message));
    }
    
    /**
     * Verifiy account using confirmation code sent by email.
     */
    public function actionVerifyAccount()
    {
        $verified = false;
        // lookup if a user having that confirmation code exists
        $user=User::model()->findByAttributes(array('confirmationCode'=>$_GET['confirmationcode']));
        if($user) {
            $user->verified = 1;
            $user->confirmationCode = null;
            $user->save();
            $verified = true;
        }
        
        $this->render('verifyaccount',array('verified'=>$verified,'user'=>$user));
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
     * AJAX > Authenticate an Indiosis User. 
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        Yii::app()->request->redirect(Yii::app()->baseUrl.'/');
    }
}