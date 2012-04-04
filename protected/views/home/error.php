<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Error
 * Indiosis's error page.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

$this->pageTitle= Helpers::buildPageTitle('Oops !');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/error.css');
$this->layout='errors';
?>
<h1>:-( Oops... Indiosis generated an error!</h1>
<p>
   Sorry for any inconvinience it may have caused.
   If this is a recurent bug, our team will be working on it and fix the problem.
</p>
<p>
    <b><?php echo CHtml::encode($message); ?></b><br/>
    <?php echo 'Error '.$code.' : '.$type.' in '.$file.' (line '.$line.')'; ?>
</p>
