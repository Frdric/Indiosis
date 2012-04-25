<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Login
 * The login box.
 * 
 * @package     account
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */
?>
<!-- LOGIN BOX -->
<div class="login_box">
    <div class="login_side">
        <h3>Log in to Indiosis</h3>
        <hr class="ongray"/>
        <?php
        $form=$this->beginWidget('IndiosisForm', array(
            'id'=>'login-form',
            'action'=>Yii::app()->baseUrl.'/profile',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validationUrl'=>Yii::app()->baseUrl.'/account/authenticate',
                'validateOnSubmit'=>true,
                'validateOnChange'=>false,
                'beforeValidate'=>'js:function(form) { showLoader(".loader"); return true; }',
                'afterValidate'=>'js:function(form) { hideLoader(".loader"); return true; }')
            )
         );
        echo CHtml::beginForm();
        ?>
        <div class="login_line">
            <?php echo CHtml::activeLabel($model,'email'); ?> <?php echo CHtml::activeTextField($model,'email'); ?>
        </div>
        <div class="login_line">
            <?php echo CHtml::activeLabel($model,'password'); ?> <?php echo CHtml::activePasswordField($model,'password'); ?>
        </div>
        <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?> <?php echo CHtml::activeLabel($model,'rememberMe',array("class"=>"rememberme")); ?>
        <?php echo CHtml::submitButton('Log In',array("class"=>'ibutton_big iblue')); ?>
        <div class="errorSummary">
            <img src="<?php echo Yii::app()->baseUrl.'/images/loader.gif'; ?>" class="loader" alt="loading..." />
            <?php echo $form->error($model,'email'); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
        <?php
        echo CHtml::endForm();
        $this->endWidget();
        ?>
    </div>
    <div class="register_side">
        <h3>Not a member yet ?</h3>
        <hr class="ongray"/>
        <br/>
        <script type="in/Login"></script>
        <br/>
        <br/>
        OR <a href="<?php echo $this->createUrl('/account/register');?>">Sign up with Email</a>
    </div>
    <div class="pw_forgot"><span>&raquo;</span> <a href="#">Forgot your password ?</a></div>
</div>