<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * VIEW : Profile Landing Page
 * The view for the profile landing page.
 * 
 * @package     profile
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

$this->pageTitle= Helpers::buildPageTitle('My Company');

// register CSS and JS scripts
$cs=Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->baseUrl . '/css/jquery-ui/tipTip.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/css/profile.css');
$cs->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.extensions.tiptip').'/jquery.tipTip.minified.js'),
    CClientScript::POS_HEAD
);
$cs->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.profile').'/profile.js'),
    CClientScript::POS_HEAD
);
?>

<br />
<br />

<div class="info">
You have <a href="#">3 pending requests</a> and <a href="#">1 unread message</a>. Your <a href="#">profile completeness</a> is 85% 
</div>

<div id="notification">

INDIOSIS NOTIFICATION : Lorem dolor sit amet.

<a id="close" href="#" title="click to close the notification">close</a>
</div>


<div id="left_column">

<div class="selfphotologo"><a href="#">Click here to add photo</a></div>

<div id="baseinfo">
<div id="name">User Name here</div>
<div id="designation_company">Designation<br /> Company</div>
<div id="location">Location, Country</div>
</div><!--- #baseinfo ends -->

<div id="profile_complete">
Your profile is :<br /><br />

<div id="progressbarWrapper" style="height:10px; " class="ui-widget-default">
<div id="progressbar" style="height:100%;"></div>
</div>
<br />

<a href="#">Click here to complete your profile</a>
<br />
<br />
<br />
</div> <!--- #profile_complete ends -->

<div id="materialfinder">

<strong><label class="screen-reader-text" for="s">Find Materials</label></strong>
	<input type="text" value="" name="s" id="s" /> 
	<input type="submit" id="searchsubmit" value="Search" /> 
    <div id="advanced_search">Advanced Search</div>
    <div class="clear"></div>
</div><!--- #materialfinder ends -->


</div><!--- #left_column ends -->

<div id="right_column">
<div id="topsort">
<div class="currently">Currently Viewing</div>
<div class="currentlyviewing now">ALL</div>
<div class="currentlyviewing" title="click to only view agreements"><a href="#">Agreements</a></div>
<div class="currentlyviewing" title="click to only view Indiosis generated matches"><a href="#">Matches</a></div>
<div class="currentlyviewing" title="click to only view news"><a href="#">News</a></div>
<div class="clear"></div>
</div><!--- #topsort ends -->
<div id="feed">

<div class="news">
Ministry of Environment, Govt of India posts new notification about hazardous waste disposal. <a href="#">Click to see the full report.</a>

<div class="source">Source: Times of India</div>

<div class="feed_actions"> <a href="#"><img title="click here to remove this item from your feed" class="feedaction" src="images/delete.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to give this item priority in your feed" class="feedaction" src="images/thumb_up.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to take action" class="feedaction" src="images/small_business.png" width="16" height="16" /></a>
  <div class="clear"></div>
</div>
<div class="clear"></div>

</div>


<div class="match">
<a class="company" href="#">Samvedhi Industries</a> needs chalk dust. You have 12 tonnes in your inventory. <a href="#">click to view details</a>.
<div class="source">Source: Times of India</div>
<div class="feed_actions"> <a href="#"><img title="click here to remove this item from your feed" class="feedaction" src="images/delete.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to give this item priority in your feed" class="feedaction" src="images/thumb_up.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to take action" class="feedaction" src="images/small_business.png" width="16" height="16" /></a>
  <div class="clear"></div>
</div>
<div class="clear"></div>
</div>


<div class="match">
<a class="company" href="#">Samvedhi Industries</a> needs chalk dust. You have 12 tonnes in your inventory. <a href="#">click to view details</a>.
<div class="source">Source: Times of India</div>
<div class="feed_actions"> <a href="#"><img title="click here to remove this item from your feed" class="feedaction" src="images/delete.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to give this item priority in your feed" class="feedaction" src="images/thumb_up.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to take action" class="feedaction" src="images/small_business.png" width="16" height="16" /></a>
  <div class="clear"></div>
</div>
<div class="clear"></div>
</div>


<div class="match">
<a class="company" href="#">Samvedhi Industries</a> needs chalk dust. You have 12 tonnes in your inventory. <a href="#">click to view details</a>.
<div class="source">Source: Times of India</div>
<div class="feed_actions"> <a href="#"><img title="click here to remove this item from your feed" class="feedaction" src="images/delete.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to give this item priority in your feed" class="feedaction" src="images/thumb_up.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to take action" class="feedaction" src="images/small_business.png" width="16" height="16" /></a>
  <div class="clear"></div>
</div>
<div class="clear"></div>
</div>


<div class="match">
<a class="company" href="#">Samvedhi Industries</a> needs chalk dust. You have 12 tonnes in your inventory. <a href="#">click to view details</a>.
<div class="source">Source: Times of India</div>
<div class="feed_actions"> <a href="#"><img title="click here to remove this item from your feed" class="feedaction" src="images/delete.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to give this item priority in your feed" class="feedaction" src="images/thumb_up.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to take action" class="feedaction" src="images/small_business.png" width="16" height="16" /></a>
  <div class="clear"></div>
</div>
<div class="clear"></div>
</div>


<div class="match">
<a class="company" href="#">Samvedhi Industries</a> needs chalk dust. You have 12 tonnes in your inventory. <a href="#">click to view details</a>.
<div class="source">Source: Times of India</div>
<div class="feed_actions"> <a href="#"><img title="click here to remove this item from your feed" class="feedaction" src="images/delete.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to give this item priority in your feed" class="feedaction" src="images/thumb_up.png" width="16" height="16" /></a>
  <a href="#"><img title="click here to take action" class="feedaction" src="images/small_business.png" width="16" height="16" /></a>
  <div class="clear"></div>
</div>
<div class="clear"></div>
</div>


<div id="more">
  <a href="#">Show more.</a>
</div>


</div><!--- Feed edns here -->

<div id="indiosis_widgets">

<div class="indiosis_widget" id="materialsinventorywidget">
<a href="mat_index.html">MATERIALS INVENTORY</a><br />
<br />

<table width="200" border="0">
  <tr>
    <td class="mat_name">Rubber</td>
    <td class="mat_quantity">20</td>
    <td class="mat_unit">tonnes</td>
  </tr>
  <tr>
    <td class="mat_name">Chalk Dust</td>
    <td class="mat_quantity">6</td>
    <td class="mat_unit">bags</td>
  </tr>
  <tr>
    <td class="mat_name">Other Material</td>
    <td class="mat_quantity">46</td>
    <td class="mat_unit">sq. metres</td>
  </tr>
</table><br />


<br />

<a href="mat_index.html">See complete inventory</a>
<br />
<br />
<img src="images/add.png" width="16" height="16" />&nbsp;&nbsp;Add&nbsp;&nbsp;<img src="images/delete.png" width="16" height="16" />&nbsp;&nbsp;Remove&nbsp;&nbsp;<img src="images/wrench.png" width="16" height="16" />&nbsp;&nbsp;<a href="mat_index.html">Edit</a>&nbsp;&nbsp;
<br />

 </div><!-- #Materialsinventorywidget ends -->

<div class="indiosis_widget" id="incomingrequestswidget">
  <a href="#">INCOMING REQUESTS</a>
  
</div>

<div class="indiosis_widget" id="outgoingrequestswidget">
  <a href="#">RECENTLY SENT REQUESTS</a>
  
</div>

</div><!-- #indiosis_widgets ends -->

</div><!--- #right_column ends -->
<div class="clear"></div>