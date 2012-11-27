<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * VIEW : Custom Class Add / Edit
 *
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// set page title
$this->pageTitle= Helpers::buildPageTitle("Custom Categories");

// register CSS + JS scripts
Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.repository')."/newcase.css")
);
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.repository').'/newcase.js'), CClientScript::POS_END
);

if(isset($customCategory->code) && !$customCategory->hasErrors()) {

    $this->beginWidget('INotificationWidget',array(
					    'notId'=>'formError',
					    'init_display'=>true));

    echo 'Custom Category "'.$customCategory->name.'" has been added.<br/><br/>';
    echo 'You may use the following generated code as a reference : <em class="bold">'.$customCategory->primaryKey.'</em>';

    $this->endWidget();
}
else {

$form=$this->beginWidget('IndiosisForm', array(
    'id'=>'customcat-form'
));

$this->beginWidget('IBoxWidget',array(
					'boxId'=>'newcustomCategory',
					'title'=>'Add a Custom Category',
					'color'=>IBoxWidget::BLUE_IBOX,
					'closable'=> (($customCategory->hasErrors())? false : true) ));
?>

<br/>
<div class="case-form">
	<h4>New Category</h4>
	<hr/>
	<br/>
	<div class="row">
		<div class="label-wrapper"><?php echo $form->label($customCategory,'classification'); ?></div>
		<?php echo $form->radiobuttonlist($customCategory,"classification",array('HS'=>'HS - Resource / Material - HS','ISIC'=>'ISIC - Industrial Activity')); ?>
	</div>
	<div class="row">
		<div class="label-wrapper"><?php echo $form->label($customCategory,'MatchingCode_number',array("label"=>"Equivalent")); ?></div>
		<?php echo $form->textField($customCategory,"MatchingCode_number",array("style"=>"width: 80px;")); ?> &nbsp;&nbsp;<span style="color: #AAA; text-align: center;"> closest matching code.</span>
		<?php echo $form->error($customCategory,"MatchingCode_number"); ?>
	</div>
	<div class="row">
	    <div class="label-wrapper"><?php echo $form->label($customCategory,'name',array("label"=>"Name / Label")); ?></div>
	    <?php echo $form->textField($customCategory,'name'); ?>
	</div>
	<div class="row">
	    <div class="label-wrapper"><?php echo $form->label($customCategory,'description',array("label"=>"Description")); ?></div>
	    <?php echo $form->textarea($customCategory,'description'); ?>
	</div>
	<?php echo $form->hiddenField($customCategory,'id',array("value"=>(count($customClasses)+1)) ); ?>
	<?php echo CHtml::submitButton('Add',array("class"=>'ibutton_big iblue',"style"=>"margin-left: 55px;")); ?>
</div>
<div class="instructions">
	<h3>Important Note</h3>
	<p>
		The <em class="bold">Equivalent</em> field refers to the HS or ISIC code that most closely matches your new category.
	</p>
	<p>
		Please refer to the below links to find the appropriate correspondance.
	</p>
	<br/>
	<h3>Usefull Links</h3>
	<p>
        <em class="bold">HS</em> – Browse the HS classification <a href="http://www.allhscodes.com" target="blank">here</a>.
    </p>
    <p>
        <em class="bold">ISIC</em> – Browse the ISIC classification <a href="http://unstats.un.org/unsd/cr/registry/regcst.asp?Cl=27" target="blank">here</a>.
    </p>
</div>
<div style="clear: both;">&nbsp;</div>

<?php
	$this->endWidget();
	$this->endWidget();
}
?>
<br/>
<br/>
<br/>
<?php
$this->beginWidget('IBoxWidget',array(
					'boxId'=>'categoryList',
					'title'=>'All Custom Categories',
					'color'=>IBoxWidget::BLUE_IBOX,
					'closable'=> false));
?>
<table class="customcat-list">
	<tr>
		<th>CODE</th>
		<th>NAME</th>
		<th>DESCRIPTION</th>
		<th>CLOSEST MATCH</th>
	</tr>
	<?php
	foreach ($customClasses as $class) {
		$codesys = 'HS';
		if(strpos($class->MatchingCode_number,'ISIC')!==FALSE) {
			$codesys = 'ISIC';
		}
		echo '<tr>';
		echo '<td>'.$class->code.'</td>';
		echo '<td>'.$class->name.'</td>';
		echo '<td>'.$class->description.'</td>';
		echo '<td>'.$codesys.' : '.str_replace("ISIC-","",$class->MatchingCode_number).'</td>';
		echo '</tr>';
	}
	?>
</table>
<?php
$this->endWidget();
?>
<br/>
<br/>