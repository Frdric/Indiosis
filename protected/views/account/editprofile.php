<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * VIEW : Profile Edition
 * Display the profile edition page (for user and company profile edition).
 * 
 * @package     account
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

// Register JS and CSS
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/account/editprofile.css');
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.account').'/editprofile.js')
);
?>
