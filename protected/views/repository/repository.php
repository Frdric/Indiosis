<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * VIEW : Repository Page
 * The view for the main repository page.
 *
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

$this->pageTitle= Helpers::buildPageTitle("Repository");

// register CSS + JS scripts
Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.views.repository')."/repository.css")
);
?>

<!-- REPOSITORY PAGE CONTENT -->
<div class="base-logo websymbol-entypo">&#128214;</div>
<h1>Indiosis ISBC Knowledge Base</h1>
<br/>
<!-- <p class="intro">
	Welcome to our repository of industrial symbiosis business cases (ISBC).
</p> -->

<?php
// $form=$this->beginWidget('CActiveForm', array(
//     'id'=>'resource_form',
//     'enableAjaxValidation'=>true,
//     'htmlOptions'=>array('enctype' => 'multipart/form-data'))
//  );
// echo 'Material name : ';
// $this->widget('CAutoComplete', array(
//     'name' => 'material_name',
//     'url' => Yii::app()->createUrl('repository/MaterialAutocomplete'),
//     'methodChain'=>".result(function(event,item){ $(\"#Class_Code_number\").val(item[1]);})"
// ));

// $this->endWidget();

$this->beginWidget(	'IBoxWidget',array(
					'boxId'=>'allIsbcBox',
					'title'=>"All Industrial Symbiosis Business Cases",
					'color'=>IBoxWidget::BLUE_IBOX,
					'closable'=>  false)
);
?>
<table class="isbc-list">
	<tr>
		<th>TITLE</th>
		<th>SCALE</th>
		<th>ABSTRACT</th>
		<th>ADDED ON</th>
	</tr>
	<?php
	foreach ($isbcs as $isbc) {
		echo '<tr>';
		echo '<td>'.$isbc->title.'</td>';
		echo '<td>'.Yii::app()->params['isbcScales'][$isbc->type].'</td>';
		echo '<td>'.$isbc->overview.'</td>';
		echo '<td>'.Yii::app()->dateFormatter->format('MMMM, d yyyy',$isbc->added_on).'</td>';
		echo '</tr>';
	}
	?>
</table>
<?php
$this->endWidget();
?>
<br/>
<div class="licencing websymbol-entypo">&#128325;&#128326;&#128327;&#128330;</div>
<br/>
<br/>