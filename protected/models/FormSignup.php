<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * FORM : Sign Up Form Model
 * Describes required fields for the Sign Up form.
 * 
 * @package     account
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

class FormSignup extends CFormModel
{
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $company;
    
    /**
     * Rules applying to the form fields.
     */
    public function rules()
    {
        return array(
            array('firstName, lastName, email, password', 'required'),
            array('email','email'),
            array('email', 'unique','className'=>'User','attributeName'=>'email'),
            array('password', 'length', 'min'=>6),
            array('company','safe')
        );
    }
    
    
    /**
     * Customized attribute labels.
     */
    public function attributeLabels()
    {
            return array(
                'email'=>'e-mail',
                'firstName'=>'First name',
                'lastName'=>'Last name',
                'password'=>'password',
                'company'=>'Your company'
            );
    }
}
