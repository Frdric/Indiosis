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
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.home')."/home.js"),
    CClientScript::POS_END
);
?>
<!-- HOME PAGE CONTENT -->
<div id="home_txt">
    <div id="features_description" class="visible">
        <h1>Industrial symbiosis made easy.</h1>
        <p>Indiosis is a collaborative platform for industrial symbiosis *.<br/>It helps you find business partners and symbiotic practices that best fit your company.</p>
    </div>
    <div id="txt_feature1">
        <h1>Free access to our repository of symbiotic practices.</h1>
        <p>Use our repository of well-known and established symbiotic practices,<br/>and find the one that best fit your company requirements.</p>
    </div>
    <div id="txt_feature2">
        <h1>Live synergy notifications.</h1>
        <p>Many companies are looking for synergy partners. Indiosis notifies you when opportunities are detected<br/>or if a company wants to collaborate with yours.</p>
    </div>
    <div id="txt_feature3">
        <h1>Connections with industrial symbiosis experts.</h1>
        <p>Receive help from industrial symbiosis practicioners in your area to setup or join an eco-industrial park.</p>
    </div>
</div>

<div id="homeillustration">
    <div class="feature_illu" id="feature1">
        <img src="<?php echo Yii::app()->baseUrl.'/images/feature_repo.png'; ?>" alt="Industrial symbiosis practices repository"/>
        <div class="feature_subtitle">Learn about known &AMP;<br/>working symbiotic practices</div>
    </div>
    <div class="feature_illu" id="feature2">
        <img src="<?php echo Yii::app()->baseUrl.'/images/feature_synergy.png'; ?>" alt="Synergy partner"/>
        <div class="feature_subtitle">Find suitable<br/>synergy partners</div>
    </div>
    <div class="feature_illu" id="feature3">
        <img src="<?php echo Yii::app()->baseUrl.'/images/feature_experts.png'; ?>" alt="Industrial symbiosis experts"/>
        <div class="feature_subtitle">Get help from industrial<br/>symbiosis experts</div>
    </div>
</div>
<hr/>
<div id="register_area">
    <h2>SIGN UP <span>- it's free !</span></h2>
    <p id="signup_subtitle">Set up a profile page for your company and start looking for synergy partners.</p>
    <div id="signup_buttons">
        <div id="signup_left">
            <div id="linkedin_signup" class="ibutton gradient">
                Connect with your<br/><span>LinkedIn</span> account
            </div>
            or <a href="https://www.linkedin.com/reg/join" target="_blank"/>go here</a> to register on LinkedIn.
        </div>
        <div id="signup_middle">OR</div>
        <div id="signup_right">
            <div id="account_signup" class="ibutton igray gradient">Create a new<br/><span>Indiosis account</span></div>
            For experts registration, <a href="/register" />click here</a>.
        </div>
    </div>
    <p id="signup_note">We recommand using your LinkedIn account<br/>as it will allow Indiosis to better suggest you with synergy partners.</p>
</div>

<h3>// News and Activities</h3>
<div id="what_is">
    <h2>What is<br/><span>INDUSTRIAL SYMBIOSIS</span> ?</h2>
    <p>Industrial symbiosis can be defined as sharing of services, utility and by-product resources among diverse industrial actors in order to add value, reduce costs and improve the environement.</p>
    <p>Direct inter-firm reuse of waste is the cornerstone of the pheonomenon termed industrial symbiosis (IS), where a group of firms in relative geographic proximity cooperate on resource management issues. Three types of symbiotic practices can occur among industries : (1) utilizing waste as raw material inputs from others (aka by-product exchange).</p>
</div>