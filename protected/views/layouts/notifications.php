<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * VIEW : Notification message
 * Show a simple notification message page.
 *
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// set page title
$this->pageTitle= Helpers::buildPageTitle(((isset($title) ? $title : 'Indiosis Notification' )));
// register CSS + JS scripts
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/register.css');

$this->beginWidget('INotificationWidget',array(
    'notId'=>'indiosisNotif',
    'title'=>((isset($title) ? $title : 'Notification from Indiosis' )),
    'init_display'=>true));

echo ((isset($message) ? $message : 'Done.'));

?>
<br/>
<br/>
<
<?php
if(isset($backUrl)) {
	echo '<a href="'.$backUrl.'">'.( (isset($backMsg)) ? $backMsg : 'Back' ).'</a>';
}
else {
	echo '<a href="'.Yii::app()->homeUrl.'">Back to homepage</a>';
}
$this->endWidget();
?>