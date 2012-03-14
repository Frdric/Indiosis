<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * LAYOUT : Main Container
 * Main container layout for all pages.
 * 
 * @package     layout
 * @author      Arjun Shankar, Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="description" content="A state-of-the art resource matchmaking platform that helps you find business partners to conclude long lasting material exchange. Need cheaper raw materials? Want to value your by-products? Go ahead, sign up and start synergizing your resources." />
    <meta name="keywords" content="industrial symbiosis,synergy,resource,material,exchange" />
    <meta name="author" content="ROI" />
    
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <?php
    // Global JS
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.layouts').'/main.js'));
    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.extensions.uniform').'/jquery.uniform.js'));
    // Global JS constant
    Yii::app()->clientScript->registerScript('globalConstants','
        // Setup global JS constants
        var BASE_URL = "'.Yii::app()->baseUrl.'";', CClientScript::POS_HEAD);
    // Global CSS
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/jquery-ui/jquery-ui-1.8.16.indiosis.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/jquery-ui/uniform.default.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/main.css');
?>
    <!-- Import the LinkedIn API JS script-->
    <script type="text/javascript" src="http://platform.linkedin.com/in.js">
      api_key: L4gyxZw6qwgyw1Gc2baz0HutNqeIafCLf7WhjHklXyGnBvcL65-ysOa1smgdN3lc
    </script>
    
</head>

<body>
    <div id="topBannerHolder">
    <div id="topbanner">
        <img id="topLogo" src="<?php echo Yii::app()->baseUrl.'/images/topBannerLogo.png'; ?>" width="159" height="65" alt="Home - Indiosis" />

        <div id="topLinks">
            <a href="profile">Company Profile</a>
            <a href="inventory">Resource Inventory</a>
        </div>
        <div id="topUserInfo">
            Suren Erkman &#x25BC;<br/>
            <b>FIDEST&nbsp;&nbsp;&nbsp;&nbsp;</b>
        </div>
    <div class="clear"></div>
    </div>
    <!-- #topbanner ends -->

    <div id="holder">
    <div id="mainpanel">

        <?php echo $content; ?>

        <div id="footernotes">
            2011 &copy; Indiosis - a Resource Optimitzation Initiative (ROI) project<br/>
            <?php echo Yii::powered(); ?> <?php echo Yii::getVersion() ; ?>
        </div>
    </div>
    <!-- #mainpanel ends -->
    
    </div>
<!-- #holder ends -->

<div id="tiptip_holder">
    <div id="tiptip_content">
        <div id="tiptip_arrow">
            <div id="tiptip_arrow_inner"></div>
        </div>
    </div>
</div>

<script>
$("a#close").click(function ( event ) {
      event.preventDefault();
      $("#notification").hide();
    });
</script>

</body>
</html>