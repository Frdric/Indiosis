<?php
/* 
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * HELPER : Email Manager
 * Component handling all email sent by Indiosis
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */


class EmailHelper extends CComponent
{
    const HOST = 'smtp.unil.ch';
    const USERNAME = 'fandreae';
    const PASSWORD = 'PUT_THE_PASSWORD_HERE';
    
    
    public static function sendAccountVerification($recipients,$confirm_code)
    {
        $title = "New Indiosis account";
        $body = "Click on this link to verify your account : ".
                Yii::app()->baseUrl.'/account/verifyaccount/confirmationcode/'.$confirm_code;
        // send the email
        EmailHelper::sendEmail($recipients, $title, $body);
    }
    
    
    /**
     * Send emails to users (with Indiosis as the sender).
     * @param User $recipients The users (or array of User) to which an email should be sent.
     * @param string $title The title of the message.
     * @param string $body Body of the message (should be HTML).
     */
    public static function sendEmail($recipients,$title,$body)
    {
        if(!is_array($recipients)) {
            $recipients = array($recipients);
        }
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->Host = self::HOST;
        $mailer->Username = self::USERNAME;
        $mailer->Password = $PASSWORD;
        $mailer->IsSMTP();
        $mailer->IsHTML();
        $mailer->FromName = 'Indiosis';
        $mailer->From = 'indiosis@roi-online.org';
        foreach($recipients as $recipient) {
            $mailer->AddAddress('fred@roi-online.org');
            // $mailer->AddAddress($recipient->email); TODO : Uncomment this line for production.
        }
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $title;
        $mailer->Body = $body;
        $mailer->Send();
    }
}
?>
