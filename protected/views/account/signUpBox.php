<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * VIEW : Sign Up Box
 * Interface of the sign up box.
 * 
 * @package     signup
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

// Register JS and CSS
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/signUpBox.css');
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.account').'/signUpBox.js')
);
?>

<!-- SIGN UP BOX -->
<div id="loginBox" width="410">
    <div id="signUpTitle">Sign up on <span>Indi<em class="indiosis_blue"><i>o</i></em>sis</span></div>
    
    <div id="thankYouTxt" style="display: none;">Thanks for registering !<br/>
        We sent an e-mail to your mailbox containing a verification link.
    </div>
    <div id="thankYouTxtLinkedIn" style="display: none;">Thanks for registering !<br/>
        We created an account under <span class="name"></span>, you can login using your LinkedIn account, 
        please note that nothing you will do here will be shown on your LinkedInd account unless you specificaly request it.<br/>
        Enjoy Indiosis!
        <p>
            NEXT STEP :<br/>
            <br/>
            1. Complete your profile with your <br/>
            2. Add your material needs and the by-product or waste you generate.<br/>
            3. Wait for Indiosis and other companies in your area to recommand you companies that would suit your input and output.
        </p>
    </div>
    
    <div id="linkedInPart">
        <script type="in/Login" data-onAuth="registerLinkedInUser"></script>
        <p>You already have a LinkedIn account! We encourage you to sign in using your LinkedIn credentials.
        Indiosis will then be able to show you interesting companies that are already in your LinkedIn network.</p>
    </div>
    
    <!-- indiosis sign up form-->
    <div id="indiosisPart" class="form">
    <?php
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'signup-form',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validationUrl'=>Yii::app()->baseUrl.'/account/validatesignup',
                'errorCssClass'=>'errorField',
                'afterValidateAttribute'=>'js:enableSubmitButton')
            )
         );
    ?>

        <div class="row">
            <?php echo $form->label($model,'firstName'); ?>
            <?php echo $form->textField($model,'firstName') ?>
        </div>
        
        <div class="row">
            <?php echo $form->label($model,'lastName'); ?>
            <?php echo $form->textField($model,'lastName') ?>
        </div>
        
        <div class="row">
            <?php echo $form->label($model,'email'); ?>
            <?php echo $form->textField($model,'email') ?>
        </div>

        <div class="row">
            <?php echo $form->label($model,'password'); ?>
            <?php echo $form->passwordField($model,'password') ?>
        </div>

        <div class="row rememberMe">
            <?php echo $form->label($model,'company'); ?>
            <?php echo $form->textField($model,'company') ?>
        </div>
        <div class="row errorSummary">
            <?php echo $form->error($model,'email'); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
        <div class="row submit">
            <?php 
            //echo CHtml::submitButton('Save',array('id'=>'signUpButton','disabled'=>'disabled'));
            echo CHtml::ajaxSubmitButton('REGISTER','', array('success'=>'afterRegistration'),
                array('id'=>'signUpButton','disabled'=>'disabled')
            );
            ?>
        </div>

    <?php $this->endWidget(); ?>
    </div>
</div>