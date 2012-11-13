<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * VIEW : New IS case form
 *
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// set page title
$this->pageTitle= Helpers::buildPageTitle("New ISBC");

// register CSS + JS scripts
Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.repository')."/newcase.css")
);
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.repository').'/newcase.js'), CClientScript::POS_END
);

$form=$this->beginWidget('IndiosisForm', array(
    'id'=>'myformname-form',
    'clientOptions'=>array('hideErrorMessage'=>true)
));


if($IScase->hasErrors() || $location->hasErrors() || $SymbioticLink->hasErrors()) {

    $this->beginWidget('INotificationWidget',array(
    'notId'=>'formError',
    'color'=>INotificationWidget::RED_INOT,
    'init_display'=>true));

    echo 'Fields marked in red are required.';
    // print_r($IScase->errors);
    // print_r($location->errors);
    // print_r($SymbioticLink->errors);

    $this->endWidget();
}

$this->beginWidget('IBoxWidget',array(
'boxId'=>'newCaseBox',
'title'=>'Add an Industrial Symbiosis Business Case (ISBC)',
'color'=>IBoxWidget::BLUE_IBOX,
'closable'=>  false));
?>
<br/>
<div class="case-form">
<h4>Main Designation</h4>
<hr/>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($IScase,'title',array('label'=>'Case title :')); ?></div>
    <?php echo $form->textField($IScase,'title'); ?>
</div>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($IScase,'type',array('label'=>'IS scale :')); ?></div>
    <?php echo $form->dropdownlist($IScase,'type',array('wastex'=>'Waste exchange','intra'=>'Intra-facility','ecopark'=>'Eco-industrial park','local'=>'Local','regional'=>'Regional','mutual'=>'Mutualization')); ?>
</div>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($IScase,'overview',array('label'=>'Overview :')); ?></div>
    <?php echo $form->textarea($IScase,'overview',array('rows'=>4)); ?>
</div>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($location,'country',array('label'=>'Location :')); ?></div>
    <?php echo $form->dropdownlist($location,'country',Yii::app()->params['countryList'],array('prompt'=>'(choose a country)','options'=>array(file_get_contents('http://api.hostip.info/country.php?ip='.CHttpRequest::getUserHostAddress()) => array('selected'=>'selected')))); ?>
</div>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($IScase,'source',array('label'=>'Source :')); ?></div>
    <?php echo $form->textField($IScase,'source'); ?>
</div>

<div id="classes">
    <br/>
    <h4>Symbiotic Linkages - 15 linkages max.</h4>
    <hr/>
    <?php
    for ($i=1; $i <= 15; $i++) {
    ?>
    <div id="companyline<?php echo $i; ?>" class="company-line <?php echo (($i!=1) ? 'hidden' : ''); ?> clearfix">
        <div class="company-head">LINKAGE&nbsp; <em><?php echo $i; ?></em></div>
        <div class="company-class">
            <div class="row">
                <div class="label-wrapper">
                    <?php echo $form->label($SymbioticLink,"[$i]type",array('label'=>'Type :')); ?>
                </div>
                <?php echo $form->radiobuttonlist($SymbioticLink,"[$i]type",array('reuse'=>'By-product reuse', 'sharing'=>'Shared resource','joint'=>'Joint service')); ?>
            </div>
            <div class="row">
                <?php echo $form->label($SymbioticLink,"[$i]MaterialClass_number",array('label'=>'Resource :')); ?>
                <?php echo $form->dropdownlist($SymbioticLink,"[$i]MaterialClass_number",$HScodes,array('class'=>'chzn-select','prompt'=>'','data-placeholder'=>'– select a resource reference –')); ?>
            </div>
            <div class="row">
                <?php echo $form->label($SymbioticLink,"[$i]qty",array('label'=>'Quantity :')); ?>&nbsp;
                <?php echo $form->textField($SymbioticLink,"[$i]qty"); ?>
            </div>
            <hr/>
            <div class="row">
                <?php echo $form->label($SymbioticLink,"[$i]SourceClass_number",array('label'=>'Source Ind. :')); ?>
                <?php echo $form->dropdownlist($SymbioticLink,"[$i]SourceClass_number",$ISIClist,array('class'=>'chzn-select','prompt'=>'','data-placeholder'=>'– select an activity –')); ?>
            </div>
            <div class="row">
                <?php echo $form->label($SymbioticLink,"[$i]benefit_source",array('label'=>'Benefits to Source-industry:')); ?>&nbsp;
                <?php echo $form->textarea($SymbioticLink,"[$i]benefit_source",array('rows'=>3,'cols'=>20)); ?>
            </div>
            <div class="row">
                <?php echo $form->label($SymbioticLink,"[$i]EndClass_number",array('label'=>'End Ind. :')); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $form->dropdownlist($SymbioticLink,"[$i]EndClass_number",$ISIClist,array('class'=>'chzn-select','prompt'=>'','data-placeholder'=>'– select an activity –')); ?>
            </div>
            <div class="row">
                <?php echo $form->label($SymbioticLink,"[$i]benefit_end",array('label'=>'Benefits to End-industry:')); ?>&nbsp;
                <?php echo $form->textarea($SymbioticLink,"[$i]benefit_end",array('rows'=>3,'cols'=>20)); ?>
            </div>
            <hr/>
            <div class="row">
                <?php echo $form->label($SymbioticLink,"[$i]implementation",array('label'=>'Implementation :')); ?>&nbsp;
                <?php echo $form->textarea($SymbioticLink,"[$i]implementation",array('rows'=>3)); ?>
            </div>
            <div class="row">
                <?php echo $form->label($SymbioticLink,"[$i]remarks",array('label'=>'Remarks / Additional details :')); ?>&nbsp;
                <?php echo $form->textarea($SymbioticLink,"[$i]remarks",array('rows'=>3)); ?>
            </div>
        </div>
        <?php if(($i+1) <= 5) { echo CHtml::button('NEW LINKAGE',array("class"=>'ibutton igray addcompbutton','id'=>'addcompany'.($i+1))); } ?>
    </div>
    <?php
    }
    ?>
</div>

<div id="impacts">
    <br/>
    <h4>Economic Requirements</h4>
    <hr/>
    <div class="row">
        <?php echo $form->label($IScase,'eco_drivers',array('label'=>'Economic Drivers :')); ?>
        <?php echo $form->textarea($IScase,'eco_drivers',array('rows'=>4)); ?>
    </div>
    <div class="row">
        <?php echo $form->label($IScase,'eco_barriers',array('label'=>'Economic Barriers :')); ?>
        <?php echo $form->textarea($IScase,'eco_barriers',array('rows'=>4)); ?>
    </div>
    <br/>
    <h4>Technical Requirements</h4>
    <hr/>
    <div class="row">
        <?php echo $form->label($IScase,'tech_drivers',array('label'=>'Technical Drivers :')); ?>
        <?php echo $form->textarea($IScase,'tech_drivers',array('rows'=>4)); ?>
    </div>
    <div class="row">
        <?php echo $form->label($IScase,'tech_barriers',array('label'=>'Technical Barriers :')); ?>
        <?php echo $form->textarea($IScase,'tech_barriers',array('rows'=>4)); ?>
    </div>
    <br/>
    <h4>Regulatory Requirements</h4>
    <hr/>
    <div class="row">
        <?php echo $form->label($IScase,'regul_drivers',array('label'=>'Regulatory Drivers :')); ?>
        <?php echo $form->textarea($IScase,'regul_drivers',array('rows'=>4)); ?>
    </div>
    <div class="row">
        <?php echo $form->label($IScase,'regul_barriers',array('label'=>'Regulatory Barriers :')); ?>
        <?php echo $form->textarea($IScase,'regul_barriers',array('rows'=>4)); ?>
    </div>
    <br/>
    <h4>Social & Environmental Benefits</h4>
    <hr/>
    <div class="row">
        <?php echo $form->textarea($IScase,'socioenv_benefits',array('rows'=>4)); ?>
    </div>
    <br/>
    <h4>Contingencies and other risks</h4>
    <hr/>
    <div class="row">
        <?php echo $form->textarea($IScase,'contingencies',array('rows'=>4)); ?>
    </div>
</div>

</div>

<div class="instructions">
    <h3>Filling Instructions</h3>
    <p>
        <em class="bold">Title</em> – should contain at least the material and/or industrial activities involved.
    </p>
    <p>
        <em class="bold">Scale of IS</em> – indicates the scale by which the symbiosis is taking place, either:
        <ul>
            <li><em class="bold">Waste exchange</em> - Material exchanges on a trade-by-trade basis rather than continuously. They feature exchange of materials rather than of water or energy.</li>
            <li><em class="bold">Intra-facility</em> - Material exchanges occuring primarily inside the boundaries of one organization rather than with a collection of outside parties.</li>
            <li><em class="bold">Eco-industrial park</em> - Exchanges occuring primarily within the defined area of an industrial park or industrial estate. Businesses are contiguously located and can exchange energy, water or materials and can go further to share information and services.</li>
            <li><em class="bold">Local</em> - Exchanges occuring between businesses that are not adjacent to one another but rather are located within a small geographic area. (e.g. Kalundborg symbiosis, companies located within a few-mile radius)</li>
            <li><em class="bold">Regional</em> - Exchanges depending on virtual linkages (e.g. regional economic community) rather than colocation. (e.g. network of scrap metal dealers, auto recyclers)</li>
            <li><em class="bold">Mutualization</em> - Indicates a particular form of symbiosis where there is a pooling of resources or services among several businesses. (e.g. transport sharing, shared cooling system)<br/><br/></li>
        </ul>
    </p>
    <p>
        <em class="bold">Overview</em> – should include general information about the organisation .
    </p>
    <p>
        <em class="bold">Source</em> – should indicate the source of the collected data and who compiled them.
    </p>
    <p>
        <em class="bold">Symbiotic Linkage</em> – represents an entity within the IS case. Each entity is active in a particular industrial activity (based on the "<a href="http://unstats.un.org/unsd/cr/registry/regcst.asp?Cl=27" target="blank">International Standard Industrial Classification of All Economic Activities</a>" of the UN). Each entity acts either as :
        <ul>
            <li><em class="bold">Producer</em> - An entity providing material or services as an output source.</li>
            <li><em class="bold">Consumer</em> - An entity using output material or services from any other entity present in the system.</li>
            <li><em class="bold">Reprocessor</em> - An entity acting both as a producer AND a consumer in the system (both input and output must come from or be used within the system).</li>
        </ul>
        <p>Each linkage also indicates the type of material or resource involved (based on the "<a href="http://www.wcoomd.org/home_hsnomenclaturetable2012.htm" target="blank">Harmonized System</a>" provided by the WCO).</p>
    </p>
    <p>
        <em class="bold">Contingencies</em> – should describe what are the possible risks involved in the setup and/or the maintenance of the described symbiosis.
    </p>
    <hr/>
    <p>
        - More information on ISIC can be found <a href="http://unstats.un.org/unsd/publication/seriesM/seriesm_4rev4e.pdf" target="blank">here</a>.<br/>
        - More information on HS can be found <a href="http://www.wcoomd.org/home_hsoverviewboxes.htm" target="blank">here</a>.
    </p>
</div>
<div class="submit-area"><?php echo CHtml::submitButton('Add to Repository',array("class"=>'ibutton_big iblue')); ?></div>
<?php
$this->endWidget();
$this->endWidget();
?>
<br/>
<br/>
<br/>