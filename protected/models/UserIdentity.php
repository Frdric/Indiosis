<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * User Identity
 * Describes the identity of a User.
 * Used for authentication, session and login/logout actions.
 * 
 * @package     authentication
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


class UserIdentity extends CUserIdentity
{
    private $_id;
    
    /**
     * Authenticate a User.
     * @return type Error message if any
     */
    public function authenticate()
    {
        $record=User::model()->findByAttributes(array('email'=>$this->username));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else if(!$record->verified)
            $this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
        else
        {
            $this->_id=$record->id;
            $this->setState('email', $record->email);
            $this->setState('lastName', $record->lastName);
            $this->setState('firstName', $record->firstName);
            $this->setState('prefix', $record->prefix);
            $this->setState('title', $record->title);
            $this->setState('isExpert', $record->isExpert);
            $this->setState('linkedIn_id', $record->linkedIn_id);
            $this->setState('Company_id', $record->Company_id);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    /**
     * Get the logged in User ID.
     * @return type The User ID.
     */
    public function getId()
    {
        return $this->_id;
    }
}