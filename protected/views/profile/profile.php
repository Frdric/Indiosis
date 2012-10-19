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
$this->pageTitle= Helpers::buildPageTitle("Profile");
// register CSS + JS scripts
Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.profile')."/profile.css")
);
Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.extensions.jvectormap')."/jvectormap.css")
);
$this->pageTitle= Helpers::varToJS($vmapMarkers);
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.extensions.jvectormap')."/jquery-jvectormap.js"),
    CClientScript::POS_END
);
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.extensions.jvectormap.maps')."/jquery-jvectormap-world-en.js"),
    CClientScript::POS_END
);
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.profile')."/profile.js"),
    CClientScript::POS_END
);
?>
<!-- PROFILE VIEW -->
<div id="org_profile">

    <!-- Organization Info -->
    <div id="org_info">
        <div id="org_maplogo">
            <div id="org_logo">
                <img src="<?php echo Yii::app()->baseUrl.'/images/default_organization.gif'; ?>" alt="<?php echo $organization->acronym; ?> logo" />
            </div>
            <div id="org_detail">
                <?php
                foreach ($org_commeans as $comean) {
                    echo '<span>'.$comean->label.'</span><br/>'.$comean->value.'<br/> ';
                }
                ?>
                <br/>
                <?php if(!empty($org_location->addressLine1)) echo $org_location->addressLine1.'<br/>'; ?>
                <?php if(!empty($org_location->addressLine2)) echo $org_location->addressLine2.'<br/>'; ?>
                <?php if(!empty($org_location->city)) echo $org_location->city.', '; ?>
                <?php if(!empty($org_location->country)) echo $org_location->country.'<br/>'; ?>
                <?php // echo $gMap->renderMap(); ?>
                <div id="org_vmap" style="width: 162px; height: 100px"></div>
            </div>
        </div>
        <div id="org_descr">
            <h3><?php echo $organization->name; ?> &nbsp;<span>(<?php echo $organization->acronym; ?>)</span></h3>
            active in <a href="">Industrial Activity</a>
            <br/><hr/>
            <p><?php
            if(strlen($organization->description)>300) {
                $organization_short_descr = substr($organization->description,0,300);
                echo substr($organization_short_descr, 0, strrpos($organization_short_descr, " "));
                echo '...<br/><a href="" class="more_button">+ more</a>';
            }
            else {
                echo $organization->description;
            }
            ?></p>
            <div id="org_members">
                <h4>Representatives</h4>
                <div class="member"><img src="" /><span>CEO</span><br/>Persone Name</div>
                <div class="member"><img src="" /><span>CEO</span><br/>Persone Name</div>
            </div>
        </div>
        <br class="float_clearer"/>
        <div id="org_activities">
            <h2>// <?php echo $organization->acronym; ?> recents activities</h2>
            <div class="activity_line">
                <span class="websymbols">V</span>
                <div>
                    <em><?php echo (empty($organization->acronym)) ? $organization->name : $organization->acronym; ?></em> accepted a synergy request from <em>HES-SO</em>.
                    <div>today</div>
                </div>
            </div>
            <div class="activity_line">
                <img src="<?php echo Yii::app()->baseUrl.'/images/joined.png'; ?>" alt="joined" />
                <div>
                    <em><?php echo (empty($organization->acronym)) ? $organization->name : $organization->acronym; ?></em> joined Indiosis.
                    <div><?php echo Helpers::timeAgoInWords($organization->created_on); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Organization Resource Flows -->
    <?php
    $this->beginWidget('IBoxWidget',array(
        'boxId'=>'org_flows',
        'title'=> '<span>'.((empty($organization->acronym)) ? $organization->name : $organization->acronym).'</span> has <span>3</span> resource flows',
        'closable'=>  false));
    ?>
    <em>2</em> input flows
    <div class="symb_flow"><span class="websymbols">><em class="websymbols">></em></span> Alumnium (13 rolls / month)</div>
    <div class="symb_flow"><span class="websymbols">><em class="websymbols">></em></span> Iron (1 ton / day)</div>
    <br/><em>1</em> output flow
    <div class="symb_flow"><span class="websymbols"><em class="websymbols"><</em><</span> Metal scraps ()</div>
    <?php $this->endWidget(); ?>

    <!-- Interaction buttons -->
    <div id="interactions">
        <input type="button" class="ibutton_big igray" value="&#9733; Retain" />
        <input type="button" class="ibutton_big idarkgray" value="Message" />
        <input type="button" class="ibutton_big iblue" value="Ask for synergy" />
    </div>

</div>
<br class="float_clearer"/>