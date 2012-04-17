<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * FORM : Login
 * Describes the login form.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class FormLogin extends CFormModel
{
    public $email;
    public $password;
    public $rememberMe=false;
    
    /**
     * Rules applying to the form fields.
     */
    public function rules()
    {
        return array(
            array('email, password', 'required'),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate')
        );
    }

    /**
     * Customized attribute labels.
     */
    public function attributeLabels()
    {
            return array(
                'email'=>'email',
                'password'=>'password'
            );
    }
    
    /**
     * Check if the user is valid.
     * @param type $attribute
     * @param type $params 
     */
    public function authenticate($attribute,$params)
    {
        // Login a user with the provided username and password.
        $identity = new IndiosisUserID($this->email,$this->password);
        if(!$identity->authenticate()) {
            $this->addError('password','Incorrect username or password.');
        }
        else {
            Yii::app()->user->login($identity);
        }
    }
}
