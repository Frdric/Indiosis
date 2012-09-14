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

// CSS sheets
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/profile.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/inventory.css');
?>


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
echo $form->hiddenField($resourceModel, 'number');
echo $form->textField($resourceModel,'description');
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