<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * COMPONENT : User Identity
 * Defines how a user is identified.
 *
 * @package     base
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class IndiosisUser extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $record = User::model()->findByAttributes(array('email'=>$this->username));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else if($record->verification_code!=='verified')
            $this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
        else {
            $this->_id=$record->id;
            $this->setState('email', $record->email);
            $this->setState('prefix', $record->prefix);
            $this->setState('firstName', $record->firstName);
            $this->setState('lastName', $record->lastName);
            $this->setState('title', $record->title);
            $this->setState('linkedin_id', $record->linkedin_id);
            $this->setState('oauthToken', $record->oauth_token);
            $this->setState('oauthSecret', $record->oauth_secret);
            $this->setState('lastConnected', $record->last_connected);
            // get user's organization info
            $userOrg = Organization::model()->findByAttributes(array('id'=>$record->Organization_id));
            $this->setState('organizationId', $userOrg->id);
            $this->setState('organizationName', $userOrg->name);
            $this->setState('organizationAcronym', $userOrg->acronym);
            $this->setState('organizationType', $userOrg->type);
            // check if Organization or User has expertise
            $userExpertise = Expertise::model()->findByAttributes(array('User_id'=>$record->id));
            $orgExpertise = Expertise::model()->findByAttributes(array('Organization_id'=>$record->Organization_id));
            $total_expertises = count($userExpertise) + count($orgExpertise);
            if($total_expertises > 0) {
                $this->setState('isExpert', true);
            }
            else {
                $this->setState('isExpert', false);
            }
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }


    public function getId()
    {
        return $this->_id;
    }
}
?>