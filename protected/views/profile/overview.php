<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Main Profile Overview
 * The profile page of an organization.
 * 
 * @package     profile
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// set page title
$this->pageTitle= Helpers::buildPageTitle("My Profile");
// register CSS + JS scripts
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/profile.css');
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.profile')."/profile.js"),
    CClientScript::POS_END
);
?>
<!-- PROFILE VIEW -->
<div id="org_profile">
    
    <!-- Organization Info -->
    <div id="org_info">
        <div id="org_logo"><img src="<?php echo Yii::app()->baseUrl.'/images/default_organization.gif'; ?>" alt="<?php echo Yii::app()->user->organizationAcronym; ?> logo" /></div>
        <h3><?php echo Yii::app()->user->organizationName; ?> &nbsp;<span>(<?php echo Yii::app()->user->organizationAcronym; ?>)</span></h3>
        <p>Lorem ipsum dolor sit amet several times just to describe the organization. Lorem ipsum dolor sit amet several times just to describe the organization.</p>
    </div>
    
    <!-- Organization Resource Flows -->
    <?php
    $this->beginWidget('IBoxWidget',array(
        'boxId'=>'org_flows',
        'title'=> '<span>'.Yii::app()->user->organizationAcronym.'</span> has <span>4</span> resource flows',
        'closable'=>  false));
    ?>
    2 Input flows<br/>
    - Steam<br/>
    - Metal<br/>
    <br/>
    3 Output flows<br/>
    - Waste water<br/>
    - Metal scraps
    <?php $this->endWidget(); ?>
    
</div>

<h2>// <?php echo Yii::app()->user->organizationAcronym; ?>'s activities</h2>