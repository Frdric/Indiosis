<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * VIEW : Home Page
 * The view for Indiosis landing page.
 * 
 * @package     home
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

$this->pageTitle= Helpers::buildPageTitle();

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.extensions.fancybox').'/jquery.fancybox-1.3.4.pack.js'));
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.home').'/home.js')
);

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/fancybox/jquery.fancybox-1.3.4.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/home.css');
Yii::app()->clientScript->registerCssFile('http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic');



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


<br />
<br />

<h2>Indiosis is a state-of-the art resource matchmaking platform that helps you find business partners to conclude long lasting material exchange. Want to value your by-products ? Need cheaper raw materials? Go ahead and sign up...</h2>

<div id="illustrationholder" style="background-image: url(<?php echo Yii::app()->baseUrl.'/images/homeillustration.jpg'; ?>);">

<div id="value">
<h3><a href="#about">Value your by-products</a></h3>
<p>Do you have periodical outputs? From paper to plastic to chalk dust to chemicals. Indiosis will find synergies for you.</p>

</div>

<div id="cheaper">
<h3><a href="#about">Find cheaper raw materials</a></h3>
<p>Find raw materials by browsing through the by-products of other companies.</p>
</div>

<div id="signup">
<h3> Go ahead, sign up<br/>and start synergizing your resources...</h3>

<form id="signupform" action="" method="get">
<input class="signup" name="fname" type="text" size="22" value="First Name" />
<input class="signup" name="lname" type="text" size="22" value="Last Name" />
<input class="signup" name="email" type="text" size="52" value="eMail address" />
<input class="signup" name="pass" type="text" size="43" value="Password" />
<input class="signup" name="pass_conf" type="text" size="43" value="Confirm password" />
<input class="signup" name="company" type="text" size="43" value="Company Name" /><br/><br/>
<input id="signupsubmit" type="submit" value="SUBMIT"  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OR<script type="in/Login" data-onAuth="registerLinkedInUser"></script>
</form>

</div><!-- #signup ends here --->

<div class="clear">.</div>
</div><!-- #illustrationholder ends -->


<div class="clear"></div>
