<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * VIEW : Excel file import
 *
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// set page title
$this->pageTitle= Helpers::buildPageTitle("ISBC Import");

// register CSS + JS scripts
Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.repository')."/newcase.css")
);

$form=$this->beginWidget('IndiosisForm', array(
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions'=>array('hideErrorMessage'=>false)
));

$this->beginWidget('IBoxWidget',array(
'boxId'=>'ISBC-import',
'title'=>'Auto-import ISBCs',
'color'=>IBoxWidget::BLUE_IBOX,
'closable'=> false));
?>
<br/>
<div class="case-form">
	<h4>Spreadsheet Upload</h4>
	<hr/>
	<br/>
	<div class="row">
	    <div class="label-wrapper"><?php echo $form->label($xcelform,'xcelfile',array("label"=>"Excel or CSV file")); ?></div>
	    <?php echo $form->fileField($xcelform,'xcelfile'); ?><br/><br/>
	    <?php echo $form->error($xcelform,'xcelfile'); ?>
	</div>
	<?php echo CHtml::submitButton('Upload',array("class"=>'ibutton_big iblue',"style"=>"margin-left: 55px;")); ?>
	<br/>
	<div style="color: #AAA; text-align: center;">A preview of the data will be displayed<br/>before submitting the import.</div>
	<br/>
	<br/>
	<br/>
	<br/>
</div>
<div class="instructions">
	<h3>File Requirements</h3>
	<p>
        <em class="bold">Structure</em> – the spreadsheet structure must be based on the Indiosis ISBC Excel Template (provided below).
    </p>
    <p>
        <em class="bold">Format</em> – only Excel (2003, 2007) or CSV formated files are supported.
    </p>
    <hr/>
    <div style="text-align: center;">
    	<a href="<?php echo Yii::app()->createUrl('repository/download/file/Indiosis_ISBC_Sprdsheet_Template.xls'); ?>" class="bold-sans" style="text-decoration: none;">
    		<span class="websymbol-modernpicto" style="font-size: 50px; color: darkgreen;">D</span><br/>
    		ISBC Spreadsheet Template
    	</a>
    </div>
</div>
<div style="clear: both;">&nbsp;</div>
<?php
$this->endWidget();
$this->endWidget();
?>
<br/>
<br/>