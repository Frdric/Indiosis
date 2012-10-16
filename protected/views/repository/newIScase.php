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
$this->pageTitle= Helpers::buildPageTitle("New IS Case");

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


if($IScase->hasErrors() || $location->hasErrors()) {

    $this->beginWidget('INotificationWidget',array(
    'notId'=>'formError',
    'color'=>INotificationWidget::RED_INOT,
    'init_display'=>true));

    echo 'Fields marked in red are required.';

    $this->endWidget();
}

$this->beginWidget('IBoxWidget',array(
'boxId'=>'newCaseBox',
'title'=>'New I.S. Case',
'color'=>IBoxWidget::BLUE_IBOX,
'closable'=>  false));
?>
<br/>
<div class="case-form">


<h4>Main Designation</h4>
<hr/>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($IScase,'title',array('label'=>'Case title')); ?></div>
    <?php echo $form->textField($IScase,'title'); ?>
</div>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($IScase,'type',array('label'=>'Symbiosis Type')); ?></div>
    <?php echo $form->dropdownlist($IScase,'type',array('wastex'=>'Waste exchange','intra'=>'Intra-facility','ecopark'=>'Eco-industrial park','local'=>'Local','regional'=>'Regional','mutual'=>'Mutualization')); ?>
</div>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($IScase,'description',array('label'=>'Practice<br/>description')); ?></div>
    <?php echo $form->textarea($IScase,'description',array('rows'=>4)); ?>
</div>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($location,'country',array('label'=>'Country')); ?></div>
    <?php echo $form->dropdownlist($location,'country',Yii::app()->params['countryList'],array('prompt'=>'(choose a country)','options'=>array(file_get_contents('http://api.hostip.info/country.php?ip='.CHttpRequest::getUserHostAddress()) => array('selected'=>'selected')))); ?>
</div>
<div class="row">
    <div class="label-wrapper"><?php echo $form->label($IScase,'source',array('label'=>'Source')); ?></div>
    <?php echo $form->textField($IScase,'source'); ?>
</div>

<div id="classes">
    <h4>Industrial entities</h4>
    <hr/>
    <?php
    for ($i=1; $i <= 5; $i++) {
    ?>
    <div id="companyline<?php echo $i; ?>" class="company-line <?php echo (($i!=1) ? 'hidden' : ''); ?> clearfix">
        <div class="company-head">COMPANY&nbsp; <em><?php echo $i; ?></em></div>
        <div class="company-class">
            <div class="row">
                <div class="label-wrapper">
                    <?php echo $form->label($IScaseClass,"[$i]role",array('label'=>'acting as :')); ?>
                </div>
                <?php echo $form->radiobuttonlist($IScaseClass,"[$i]role",array('producer'=>'Producer', 'consumer'=>'Consumer', 'reprocessor'=>'Reprocessor')); ?>
            </div>
            <div class="row">
                <?php echo $form->label($IScaseClass,"[$i]ClassCode_number",array('label'=>'active in :')); ?>&nbsp;
                <?php echo $form->dropdownlist($IScaseClass,"[$i]ClassCode_number",ResourceManager::getISICList(),array('class'=>'chzn-select','prompt'=>'','data-placeholder'=>'(select an activity)')); ?>
            </div>
        </div>
        <?php if(($i+1) <= 5) { echo CHtml::button('ADD ONE MORE ENTITY',array("class"=>'ibutton igray addcompbutton','id'=>'addcompany'.($i+1))); } ?>
    </div>
    <?php
    }
    ?>
</div>

<div id="impacts">
    <h4>Impacts</h4>
    <hr/>
    <div class="row">
        <?php echo $form->label($IScase,'financial_impact',array('label'=>'Financial :')); ?>
        <?php echo $form->textarea($IScase,'financial_impact',array('rows'=>4)); ?>
    </div>
    <div class="row">
        <?php echo $form->label($IScase,'hr_impact',array('label'=>'Human Resource :')); ?>
        <?php echo $form->textarea($IScase,'hr_impact',array('rows'=>4)); ?>
    </div>
    <div class="row">
        <?php echo $form->label($IScase,'org_impact',array('label'=>'Organisational :')); ?>
        <?php echo $form->textarea($IScase,'org_impact',array('rows'=>4)); ?>
    </div>
    <div class="row">
        <?php echo $form->label($IScase,'envmnt_impact',array('label'=>'Environmental :')); ?>
        <?php echo $form->textarea($IScase,'envmnt_impact',array('rows'=>4)); ?>
    </div>
    <div class="row">
        <?php echo $form->label($IScase,'contingencies',array('label'=>'Contingencies :')); ?>
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
        <em class="bold">Symbiosis type</em> – indicates the way by which the symbiosis is taking place, either:
        <ul>
            <li><em>Waste exchange</em> - Material exchanges on a trade-by-trade basis rather than continuously. They feature exchange of materials rather than of water or energy.</li>
            <li><em>Intra-facility</em> - Material exchanges occuring primarily inside the boundaries of one organization rather than with a collection of outside parties.</li>
            <li><em>Eco-industrial park</em> - Exchanges occuring primarily within the defined area of an industrial park or industrial estate. Businesses are contiguously located and can exchange energy, water or materials and can go further to share information and services.</li>
            <li><em>Local</em> - Exchanges occuring between businesses that are not adjacent to one another but rather are located within a small geographic area. (e.g. Kalundborg symbiosis, companies located within a few-mile radius)</li>
            <li><em>Regional</em> - Exchanges depending on virtual linkages (e.g. regional economic community) rather than colocation. (e.g. network of scrap metal dealers, auto recyclers)</li>
            <li><em>Mutualization</em> - Indicates a particular form of symbiosis where there is a pooling of resources or services among several businesses. (e.g. transport sharing, shared cooling system)<br/><br/></li>
        </ul>
    </p>
    <p>
        <em class="bold">Practice description</em> – should include specific details about the material or resource involved and how the input and/or output flows are organised.
    </p>
    <p>
        <em class="bold">Industrial entity</em> – represents a company or entity having a key role in the system. The industrial activity types are based on the "<a href="http://unstats.un.org/unsd/cr/registry/regcst.asp?Cl=27" target="blank">International Standard Industrial Classification of All Economic Activities</a>"" (ISIC) from the United Nations.<br/>(More information can be found <a href="http://unstats.un.org/unsd/publication/seriesM/seriesm_4rev4e.pdf" target="blank">here</a>).<br/><br/>In addition to the industrial activity, each entity must be either :
        <ul>
            <li><em>Producer</em> - An entity providing material or services as an output source.</li>
            <li><em>Consumer</em> - An entity using output material or services from any other entity present in the system.</li>
            <li><em>Reprocessor</em> - An entity acting both as a producer AND a consumer in the system (both input and output must come from or be used inside the system).</li>
        </ul>
    </p>
    <p>
        <em class="bold">Impacts</em> – should describe (for each kind) what are the positive impacts of the symbiosis once it is setup.
    </p>
    <p>
        <em class="bold">Contingencies</em> – should describe what are the possible risks involved in practicing the described symbiosis.
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