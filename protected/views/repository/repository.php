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

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.home')."/repository.js"),
    CClientScript::POS_END
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
<!-- REPOSITORY PAGE CONTENT -->
<div id="req_res"></div>