<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Registration page
 * Registration form including LinkedIn based registration.
 * 
 * @package     account
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// set page title
$this->pageTitle= Helpers::buildPageTitle("LinkedIn message");
// register CSS + JS scripts
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/register.css');

$this->beginWidget('INotificationWidget',array(
    'notId'=>'linkedinMsg',
    'title'=>'LinkedIn Notification',
    'init_display'=>true));

echo $message;
?>
<br/>
<br/>
< <a href="<?php echo Yii::app()->homeUrl; ?>">Back to homepage</a>
<?php $this->endWidget(); ?>