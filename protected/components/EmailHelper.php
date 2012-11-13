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
        $title = "Your new Indiosis account";
        $body = "Click on this link to verify your account : ".
                Yii::app()->createAbsoluteUrl('account/verify/confirmationcode/'.$confirm_code);
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
        //$mailer->Password = self::PASSWORD;
        $mailer->IsSMTP();
        $mailer->IsHTML();
        $mailer->FromName = 'Indiosis';
        $mailer->From = Yii::app()->params['notificationEmail'];
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $title;
        $mailer->Body = $body;
        foreach($recipients as $recipient) {
            // send to admin email if in dev-mode.
            if(Yii::app()->id == 'indiosis-dev') {
                $mailer->AddAddress();
                break;
            }
            $mailer->AddAddress($recipient->email);
        }
        $mailer->Send();
    }
}
?>
