<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Home Page
 * The view for Indiosis landing page.
 * 
 * @package     home
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

$this->pageTitle= Helpers::buildPageTitle("Home");

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/home.css');

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.home').'/home.js'), CClientScript::POS_END
);

//echo CHtml::ajaxLink(
//	'Test request',          // the link body (it will NOT be HTML-encoded.)
//	array('home/reqTest01'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
//	array(
//		'update'=>'#req_res'
//	),
//        array('id' => 'send-link-'.uniqid())
//);
?>
<!--<div id="req_res">...</div>-->

<div id="home_txt">
    <h1>Welcome to Indiosis</h1>
    <p id="features_description">Indiosis is a collaborative platform for industrial symbiosis. It helps you find business partners and symbiosis practices that best fit your company.</h2>
</div>

<div id="homeillustration">
    <div class="feature_illu" id="feature1">
        <img src="<?php echo Yii::app()->baseUrl.'/images/feature_book.gif'; ?>" alt="Industrial symbiosis practices repository"/>
        <div class="feature_subtitle">Learn about known &AMP;<br/>working symbiosis practices</div>
    </div>
    <div class="feature_illu" id="feature2">
        <img src="<?php echo Yii::app()->baseUrl.'/images/feature_synpartner.gif'; ?>" alt="Synergy partner"/>
        <div class="feature_subtitle">Find suitable<br/>synergy partners</div>
    </div>
    <div class="feature_illu" id="feature3">
        <img src="<?php echo Yii::app()->baseUrl.'/images/feature_experts.gif'; ?>" alt="Industrial symbiosis experts"/>
        <div class="feature_subtitle">Get help from industrial<br/>symbiosis experts</div>
    </div>
</div>

<div id="register_area">
    <h2>SIGN UP <span>- it's free !</span></h2>
</div>