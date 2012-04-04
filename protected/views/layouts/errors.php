<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Error Layout
 * Main container layout for all errors.
 * 
 * @package     layout
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="author" content="Frederic Andreae" />
    <meta name="copyright" content="&copy; 2012 UNIL/ROI">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/css_reset.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/fonts/bitstream/fontface.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/fonts/open-sans/fontface.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/jquery-ui/jquery-ui-1.8.16.indiosis.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/main.css' ?>" />
    
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <?php
    // Global JS scripts
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    // Global JS constants
    Yii::app()->clientScript->registerScript('globalConstants','
        // Set global JS constants
        var BASE_URL = "'.Yii::app()->baseUrl.'";',
    CClientScript::POS_HEAD);
?>
</head>
    
<body>
    <div id="error_wrapper">
        <?php echo $content; ?>
    </div>
</body>
</html>