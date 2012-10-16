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

$am = Yii::app()->assetManager;
$cs = Yii::app()->clientScript;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="author" content="Frederic Andreae" />
    <meta name="copyright" content="&copy; <?php echo date("Y"); ?> UNIL/ROI">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div id="error_wrapper">
        <?php echo $content; ?>
    </div>
</body>
</html>