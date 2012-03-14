<?php
/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Email Helper component
 * Component handling all email sent by Indiosis
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


class EmailHelper extends CComponent {
    
    public static final $HOST = 'smtp.unil.ch';
    public static final $USERNAME = 'fandreae';
    public static final $PASSWORD = 'PUT_THE_PASSWORD_HERE';
    
    
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
        $mailer->Host = $HOST;
        $mailer->Username = $USERNAME;
        //$mailer->Password = $PASSWORD;
        $mailer->IsSMTP();
        $mailer->IsHTML();
        $mailer->FromName = 'Indiosis';
        $mailer->From = 'fred@roi-online.org';
        foreach($recipients as $recipient) {
            $mailer->AddAddress($recipient->email);
        }
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $title;
        $mailer->Body = $body;
        $mailer->Send();
    }
    
}
?>
