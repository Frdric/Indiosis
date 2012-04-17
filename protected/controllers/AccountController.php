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
     * AJAX > Handles the registration process.
     */
    public function actionSignUp()
    {
        $model = new FormSignup;

        if(isset($_POST['FormSignup']))
        {
            // collects user input data
            $model->attributes=$_POST['FormSignup'];
            
            if($model->validate()) {
                
                // create a random confirmation code 
                $confirm_code = md5(uniqid(rand()));
                $newUser = new User;
                $newUser->setAttributes($model->attributes);
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
                EmailHelper::sendEmail($newUser,'Verify your Indiosis account','Click on this link to verify your account : '.Yii::app()->baseUrl.'/account/verifyaccount/confirmationcode/'.$confirm_code);
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
        $this->renderPartial('signUpBox',array('model'=>$model),false,true);
    }
    
    
    /*
     * AJAX > Handles of the sign up form ajax validation.
     */
    public function actionValidateSignUp()
    {
        $model=new FormSignup;
        if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    /**
     * AJAX > Register a new LinkedIn member User.
     */
    public function actionLinkedInRegister()
    {
        $newLinkedInUser = new User;
        $newLinkedInUser->linkedIn_id = $_POST['id'];
        $newLinkedInUser->firstName = $_POST['firstName'];
        $newLinkedInUser->lastName = $_POST['lastName'];
        $newLinkedInUser->isExpert = 0;
        $newLinkedInUser->date_joined = date("Y-m-d");
        $newLinkedInUser->verified = 1;
        if($newLinkedInUser->save()) {
            echo CJSON::encode($newLinkedInUser->getAttributes());
        }
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
        $model = new FormLogin;
        $this->renderPartial('login',array('model'=>$model),false,true);
    }
    
    /**
     * AJAX > Authenticate an Indiosis User. 
     */
    public function actionAuthenticate()
    {
        $model = new FormLogin;
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