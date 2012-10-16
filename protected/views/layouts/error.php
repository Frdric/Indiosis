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

$this->layout='errors';

$this->pageTitle= Helpers::buildPageTitle('Oops !');
Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.layouts').'/error.css'));
?>
<h1>:-( Oops... Indiosis generated an error!</h1>

<p class="main_message"><?php echo CHtml::encode($message); ?></p>

<p>
   (if this is a recurent bug, our team will be working on it and fix the problem.)
</p>

<?php
if(YII_DEBUG == TRUE) {
    echo '<br/><hr/><p class="error">Error '.$code.' : '.$type.' in '.$file.' (line '.$line.')</p>';
}
?>