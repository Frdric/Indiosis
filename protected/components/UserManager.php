<?php
/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * User Manager
 * Component handling all user related operations.
 * 
 * @package     user
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


class UserManager extends CComponent {
    
    
    /**
     * Send a message to another User on Indiosis.
     * @param type $sender The user sending the message.
     * @param type $receiver The user recipient.
     * @param type $title Title of the message.
     * @param type $content Content of the message.
     * @param type $synergy_id The ID of the related Synergy if applicable.
     */
    public static function sendIndiosisMessage($sender,$receiver,$title,$content,$synergy_id=null)
    {
        $message = new Message();
        $message->sender = $sender->id;
        $message->recipient = $receiver->id;
        $message->title = $title;
        $message->body = $content;
        $message->date_sent = date("d-m-Y H:m:s");
        if($synergy_id!=null) {
            // TODO : Implement synergy ID in DB.
        }
        // sends the message by saving and send an email
        $message->save();
        EmailHelper::sendEmail($receiver, 'New message on Indiosis', 'Your received a new message on Indiosis.');
    }
    
}
?>
