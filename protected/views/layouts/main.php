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

$am = Yii::app()->assetManager;
$cs = Yii::app()->clientScript;
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
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- LinkedIn API import -->
    <script type="text/javascript" src="http://platform.linkedin.com/in.js">
      api_key: <?php echo Yii::app()->params['linkedinKey']; ?>
      authorize: true
    </script>

    <?php
    // Add fancybox to login link
    $this->widget('ext.fancybox.EFancyBox', array(
        'target'=>'a#login_link',
        'config'=>array("padding" => 0)
    ));
    ?>
</head>

<body>
    <div class="wrapper">
        <!-- HEADER -->
        <div class="header_wrapper">
            <div class="header">
                <div id="toplogo">
                    <a href="<?php echo Yii::app()->baseUrl; ?>/">
                        <img src="<?php echo Yii::app()->baseUrl.'/images/indiosis_headlogo.png'; ?>" alt="Indiosis" id="headerlogo"/>
                    </a>
                </div>
                <div id="topmenu">
                    <div class="topmenubutton <?php echo ((Yii::app()->controller->id=='repository') ? 'current' : ''); ?>"><a href="<?php echo Yii::app()->createUrl('repository'); ?>"><span class="websymbol-modernpicto" style="font-size: 32px;">B</span><br/>REPOSITORY</a></div>
                    <div class="topmenubutton <?php echo ((Yii::app()->controller->id=='company') ? 'current' : ''); ?>"><a href="<?php echo Yii::app()->createUrl('members'); ?>"><span class="websymbol-entypo">&#128101;</span><br/>MEMBERS</a></div>
                    <div class="topmenubutton  <?php echo ((Yii::app()->controller->id=='profile') ? 'current' : ''); ?>"><a href="<?php echo Yii::app()->createUrl('profile'); ?>"><span class="websymbol-entypo">&#59191;</span><br/>MY COMPANY</a></div>
                    <div class="topmenubutton dbline <?php echo ((Yii::app()->controller->id=='expert') ? 'current' : ''); ?>"><a href="<?php echo Yii::app()->createUrl('about'); ?>">EXPERTS<br/>CORNER</a></div>
                    <div id="searchfield"><input type="text" name="spractice" value="search symbiosis practices.." class="no-uniform empty" /></div>
                </div>
            </div>
            <div class="infobar_wrapper">
                <div class="infobar <?php echo (Yii::app()->user->isGuest)? 'guest':'logged' ; ?>">
                    <?php
                    // Breadcrumbs (if set)
                    $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbsLinks,'homeLink'=>false,'separator'=>'&nbsp;&nbsp;<span class="websymbol-entypo" style="font-size: 15px;">&#59238;</span>&nbsp;&nbsp;'));

                    if(Yii::app()->user->isGuest) {
                        echo '<a href="'.Yii::app()->createUrl('account/login').'" id="login_link"><img src="'.Yii::app()->baseUrl.'/images/login_lock.gif'.'" alt="Secure login" />Log In</a>';
                    }
                    else {
                        echo Yii::app()->user->firstName." ".Yii::app()->user->lastName.' &nbsp;<span>('.((!empty(Yii::app()->user->organizationAcronym)) ? Yii::app()->user->organizationAcronym : Yii::app()->user->organizationName ).')</span> | '.'<a href="'.Yii::app()->createUrl('account/logout').'"><span class="websymbol">X</span></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- MAIN CONTENT -->
        <div class="main_content">
            <?php
            // Expert access
            if(isset($this->menuActions)) {
                ?>
                <div class="actionMenu">
                    <span>Expert access</span>
                <?php
                $first=true;
                foreach ($this->menuActions as $action => $link) {
                    if(!$first) {
                        echo '&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;';
                    }
                    else {
                        $first=false;
                    }
                    if(strstr($link,$this->action->id)) {
                        echo '<a href="'.$link.'"><em>'.$action.'</em></a>';
                    }
                    else {
                        echo '<a href="'.$link.'">'.$action.'</a>';
                    }
                }
                ?>
                </div>
                <?php
            }
            // Output main content
            echo $content;
            ?>
        </div>
        <div id="footer_push"></div>
    </div>
    <!-- FOOTER -->
    <div id="footer_wrapper">
    <div id="footer_inwrapper">
        <div id="footer">
            <div id="footer_links">
                <h4>More about Indiosis</h4>
                <a href="<?php echo Yii::app()->createUrl('help'); ?>">Help</a> | <a href="<?php echo Yii::app()->createUrl('privacy'); ?>">User Agreement & Privacy</a> | <a href="<?php echo Yii::app()->createUrl('about'); ?>">About Indiosis</a> | <a href="<?php echo Yii::app()->createUrl('contact'); ?>">Send us your feedback</a>
            </div>
            <div id="footer_supportedby">
                <a href="http://www.roionline.org" target="_blank"><img src="<?php echo Yii::app()->baseUrl.'/images/roi_logo.png'; ?>" alt="ROI - Resource Optimization Initiative" /></a>
                <a href="http://www.unil.ch/hec" target="_blank"><img src="<?php echo Yii::app()->baseUrl.'/images/unilprime_logo.png'; ?>" alt="University of Lausanne"/></a>
                <div id="support_note">Supported by the<br/>University of Lausanne,<br/>in collaboration with ROI.</div>
            </div>
        </div>
        <div class="copyright">
            <div>
                <img src="<?php echo Yii::app()->baseUrl.'/images/indiosis_gray.png'; ?>" alt="Indiosis"/>
                <br/>
                <span>&copy; 2011-<?php echo date("Y"); ?></span><br/>All rights reserved.
            </div>
            <div>
                <img src="<?php echo Yii::app()->baseUrl.'/images/yii_logo.png'; ?>" alt="Yii Framework - version <?php echo Yii::getVersion(); ?>"/>
                <br/>Powered by<br/>Yii Framework.
            </div>
        </div>
    </div>
    </div>
</body>
</html>