<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * VIEW : Repository Page
 * The view for the main repository page.
 *
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

$this->pageTitle= Helpers::buildPageTitle("Repository");

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/repository.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/inventory.css'); // TODO : remove this line
?>

<!-- REPOSITORY PAGE CONTENT -->
<h1>Browse all Industrial Symbiosis cases</h1>
<br>
<div>IS Knowledge Base : Work in progress..</div>
<br/>
<br>
<br>
<h2>Search by Material</h2>

<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'resource_form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('enctype' => 'multipart/form-data'))
 );
echo 'Material name : ';
$this->widget('CAutoComplete', array(
    'name' => 'material_name',
    'url' => Yii::app()->baseUrl.'/inventory/MaterialAutocomplete',
    'methodChain'=>".result(function(event,item){ $(\"#Class_Code_number\").val(item[1]);})"
));

$this->endWidget();