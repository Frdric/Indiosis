<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Registration page
 * Registration form including LinkedIn based registration.
 * 
 * @package     account
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// set page title
$this->pageTitle= Helpers::buildPageTitle("Register");
// register CSS + JS scripts
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/register.css');
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.account')."/register.js"),
    CClientScript::POS_END
);
?>
<!-- REGISTER VIEW -->
<?php
$this->beginWidget('IBoxWidget',array(
    'boxId'=>'signupbox',
    'title'=>'Sign Up to Indiosis',
    'closable'=>  false));
?>
<div id="signup_side">
    <br/>
    <h2>Create an Indiosis account</h2>
    <?php
    $form=$this->beginWidget('IndiosisForm', array(
        'id'=>'signup-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validationUrl'=>Yii::app()->baseUrl.'/account/validatesignup',
            'errorCssClass'=>'errorField',
            'validateOnSubmit'=>true,
            'beforeValidate'=>'js:beforeSignupValidate',
            'afterValidate'=>'js:afterSignupValidate'),
        'focus'=>($model->hasErrors()) ? '.error:first' : array($model, 'firstName'))
    );
    ?>
    <div class="row">
        <div><?php echo $form->label($model,'firstName'); ?></div>
        <div><?php echo $form->textField($model,'firstName') ?></div>
        <?php echo $form->error($model,'firstName'); ?>
    </div>
    <div class="row">
        <div><?php echo $form->label($model,'lastName'); ?></div>
        <div><?php echo $form->textField($model,'lastName') ?></div>
        <?php echo $form->error($model,'lastName'); ?>
    </div>
    <div class="row">
        <div><?php echo $form->label($model,'email'); ?></div>
        <div><?php echo $form->textField($model,'email') ?></div>
        <?php echo $form->error($model,'email'); ?>
    </div>
    <div class="row">
        <div><?php echo $form->label($model,'password'); ?></div>
        <div><?php echo $form->passwordField($model,'password') ?></div>
        <?php echo $form->error($model,'password'); ?>
    </div>
    <div class="row">
        <div>Company name</div>
        <div><?php echo $form->textField($model,'organization') ?></div>
        <?php echo $form->error($model,'organization'); ?>
    </div>            
    <div class="row uaagreed">
        <div><?php echo $form->checkBox($model,'uaagreed') ?></div>
        <div class="txt">By signing up I agree to<br/>Indiosis <a href="#" target="_blank">terms of service</a>.</div>
        <?php echo $form->error($model,'uaagreed'); ?>
    </div>
    <div class="row submit">
        <?php echo CHtml::submitButton('Sign Up',array("class"=>'ibutton_big iblue')); ?>
        <img src="<?php echo Yii::app()->baseUrl.'/images/loader.gif'; ?>" class="loader signuploader" alt="loading..." />
    </div>
    <?php $this->endWidget(); ?>
</div>

<div id="info_side">
    <br/>
    <h2>Connect with LinkedIn !</h2>
    <p><em>You can use your LinkedIn account to connect to Indiosis.</em></p>
    <script type="in/Login" data-onAuth="registerLinkedInUser"></script>
    <br/>
    <br/>
    <p>It's quicker and your Indiosis account will use your business connections to better suggest you with symbiotic opportunities.</p>
    <br/>
    <br/>
    <h2>Expert registration</h2>
    <p>
        For industrial ecology or industrial symbiosis experts: <br/><br/>
        Go to the <a href="">expert registration</a> page.
    </p>
</div>

<?php $this->endWidget(); ?>

<?php
$this->beginWidget('INotificationWidget',array(
    'notId'=>'registeredMsg',
    'title'=>'Done. Thank you for registering!'));
?>
Like usual, we just sent you a confirmation email with a validation link that will activate your account...
<br/>
<br/>
< <a href="<?php echo Yii::app()->homeUrl; ?>">Back to homepage</a>
<?php $this->endWidget(); ?>