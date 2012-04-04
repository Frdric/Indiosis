<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Main Layout
 * Main container layout for all pages.
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
    <meta name="description" content="A collaborative web-platform for industrial symbiosis." />
    <meta name="keywords" content="industrial symbiosis,industrial symbiosis practices,synergy,resource exchange,material exchange,social network" />
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
    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.layouts').'/primary.js'));
    // Global JS constants
    Yii::app()->clientScript->registerScript('globalConstants','
        // Set global JS constants
        var BASE_URL = "'.Yii::app()->baseUrl.'";',
    CClientScript::POS_HEAD);
?>
    <!-- LinkedIn API import -->
    <script type="text/javascript" src="http://platform.linkedin.com/in.js">
      api_key: L4gyxZw6qwgyw1Gc2baz0HutNqeIafCLf7WhjHklXyGnBvcL65-ysOa1smgdN3lc
    </script>
</head>
    
<body>
    <div id="wrapper">
        
        <!-- HEADER -->
        <div id="header_wrapper">
            <div id="header">
                <a href="<?php echo Yii::app()->baseUrl; ?>/"><img src="<?php echo Yii::app()->baseUrl.'/images/indiosis_headerlogo.png'; ?>" alt="Indiosis" id="headerlogo"/></a>
                <div id="topmenu">
                    <div class="topmenubutton"><a href="<?php echo Yii::app()->baseUrl; ?>/repository">PRACTICES<br/>REPOSITORY</a></div>
                    <div class="topmenubutton monoline"><a href="<?php echo Yii::app()->baseUrl; ?>/profile">My PROFILE</a></div>
                    <div class="topmenubutton"><a href="<?php echo Yii::app()->baseUrl; ?>/about">EXPERTS<br/>CORNER</a></div>
                    <div id="searchfield"><input type="text" name="spractice" value="search symbiosis practices.." /></div>
                </div>
            </div>
            <div id="infobar_wrapper">
                <div id="infobar">
                    <a href="login">Log In</a>
                </div>
            </div>
        </div>
        
        <!-- MAIN CONTENT -->
        <div id="main_content">
            <?php echo $content; ?>
        </div>
        <div id="footer_push"></div>
    </div>
    
    <!-- FOOTER -->
    <div id="footer_wrapper">
    <div id="footer_inwrapper">
        <div id="footer">
            <a href="">About Indiosis</a> | <a href="">User Agreement & Privacy</a> | <a href="">Contact Us</a> | <a href="">Help</a>
        </div>
        &copy; 2011-<?php echo date("Y"); ?> Indiosis. All rights reserved.<br/>A product of PRIME/UNIL in collaboration with ROI. <?php echo Yii::powered(); ?>
    </div>
    </div>
</body>
</html>