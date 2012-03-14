<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Home Controller
 * Handles all home pages related actions.
 * 
 * @package     home
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

class HomeController extends IndiosisController
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                    'class'=>'CCaptchaAction',
                    'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                    'class'=>'CViewAction',
            ),
        );
    }


    public function actionIndex()
    {
        $this->render('home');
    }
    
    
    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
                $model->attributes=$_POST['ContactForm'];
                if($model->validate())
                {
                        $headers="From: {$model->email}\r\nReply-To: {$model->email}";
                        mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
                        Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                        $this->refresh();
                }
        }
        $this->render('contact',array('model'=>$model));
    }
}