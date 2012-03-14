<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * VIEW : Inventory management
 * The view for a company to manage its resource inventory.
 * 
 * @package     inventory
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

$this->pageTitle= Helpers::buildPageTitle('Resource inventory');

// JS scripts
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.inventory').'/inventory.js')
);
// CSS sheets
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/profile.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/inventory.css');
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

<div class="heading" id="mat">
<strong> MATERIALS INVENTORY </strong>
</div><!--- #heading ends -->


<div id="main_content">

<div id="inventory">

<table width="500" border="0">
  <tr>
    <td class="mat_name">Rubber</td>
    <td class="mat_quantity">20</td>
    <td class="mat_unit">tonnes</td>
    <td><img src="<?php echo Yii::app()->baseUrl.'/images/delete.png' ;?>" width="16" height="16" />&nbsp;&nbsp;Remove&nbsp;&nbsp;<img src="<?php echo Yii::app()->baseUrl.'/images/wrench.png' ;?>" width="16" height="16" />&nbsp;&nbsp;<a href="#">Edit</a>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td class="mat_name">Rubber</td>
    <td class="mat_quantity">20</td>
    <td class="mat_unit">tonnes</td>
    <td><img src="<?php echo Yii::app()->baseUrl.'/images/delete.png' ;?>" width="16" height="16" />&nbsp;&nbsp;Remove&nbsp;&nbsp;<img src="<?php echo Yii::app()->baseUrl.'/images/wrench.png' ;?>" width="16" height="16" />&nbsp;&nbsp;<a href="#">Edit</a>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td class="mat_name">Rubber</td>
    <td class="mat_quantity">20</td>
    <td class="mat_unit">tonnes</td>
    <td><img src="<?php echo Yii::app()->baseUrl.'/images/delete.png' ;?>" width="16" height="16" />&nbsp;&nbsp;Remove&nbsp;&nbsp;<img src="<?php echo Yii::app()->baseUrl.'/images/wrench.png' ;?>" width="16" height="16" />&nbsp;&nbsp;<a href="#">Edit</a>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td class="mat_name">Rubber</td>
    <td class="mat_quantity">20</td>
    <td class="mat_unit">tonnes</td>
    <td><img src="<?php echo Yii::app()->baseUrl.'/images/delete.png' ;?>" width="16" height="16" />&nbsp;&nbsp;Remove&nbsp;&nbsp;<img src="<?php echo Yii::app()->baseUrl.'/images/wrench.png' ;?>" width="16" height="16" />&nbsp;&nbsp;<a href="#">Edit</a>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td class="mat_name">Rubber</td>
    <td class="mat_quantity">20</td>
    <td class="mat_unit">tonnes</td>
    <td><img src="<?php echo Yii::app()->baseUrl.'/images/delete.png' ;?>" width="16" height="16" />&nbsp;&nbsp;Remove&nbsp;&nbsp;<img src="<?php echo Yii::app()->baseUrl.'/images/wrench.png' ;?>" width="16" height="16" />&nbsp;&nbsp;<a href="#">Edit</a>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td class="mat_name">Rubber</td>
    <td class="mat_quantity">20</td>
    <td class="mat_unit">tonnes</td>
    <td><img src="<?php echo Yii::app()->baseUrl.'/images/delete.png' ;?>" width="16" height="16" />&nbsp;&nbsp;Remove&nbsp;&nbsp;<img src="<?php echo Yii::app()->baseUrl.'/images/wrench.png' ;?>" width="16" height="16" />&nbsp;&nbsp;<a href="#">Edit</a>&nbsp;&nbsp;</td>
  </tr>
</table>

</div><!-- #inventory ends -->

<div id="mat_add" class="heading">
ADD MATERIALS
</div>

<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'resource_form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('enctype' => 'multipart/form-data'))
 );

$this->widget('CAutoComplete', array(
    'name' => 'material_name',
    'url' => Yii::app()->baseUrl.'/inventory/MaterialAutocomplete',
    'methodChain'=>".result(function(event,item){ $(\"#Resource_Code_number\").val(item[1]);})"
));
echo $form->hiddenField($resourceModel, 'Code_number');
echo $form->textField($resourceModel,'label');
?> <input id="quantity" autocomplete="off" class="mat_input" value="enter quantity here"> <input id="frequency" autocomplete="off" class="mat_input" value="enter frequency here">

<?php
echo CHtml::ajaxSubmitButton('Add',Yii::app()->baseUrl.'inventory/addresource');
$this->endWidget(); ?>
<br />
<br />
<input type="checkbox" />
<strong>OR BROWSE BY TYPE</strong>
</div>
</div><!--- #right_column ends -->
<div class="clear"></div>