<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * COMPONENT : Indiosis Base Controller
 * All controller classes of Indiosis should extend this base class.
 *
 * @package     base
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class IndiosisController extends CController
{
    // stores page breadcrumbs (to overwrite for breadcrumbs to appear)
    public $breadcrumbsLinks = array();
    // stores the default action (to overwrite in each controller)
    public $defaultAction = 'index';

    /*
     * Enable access control.
     */
    public function filters()
    {
        return array('accessControl');
    }

    /**
     * Exectued at every
     */
    public function init()
    {
        if(Yii::app()->request->isAjaxRequest != TRUE)
        {
            $am = Yii::app()->assetManager;
            $cs = Yii::app()->clientScript;
            // Global CSS sheets
            $cs->registerCssFile(Yii::app()->baseUrl.'/images/fonts/bitstream/fontface.css');
            $cs->registerCssFile(Yii::app()->baseUrl.'/images/fonts/open-sans/fontface.css');
            $cs->registerCssFile(Yii::app()->baseUrl.'/images/fonts/entypo/fontface.css');
            $cs->registerCssFile(Yii::app()->baseUrl.'/images/fonts/modernpics/fontface.css');
            $cs->registerCssFile(Yii::app()->baseUrl.'/images/fonts/websymbols/fontface.css');
            $cs->registerCssFile($am->publish(Yii::getPathOfAlias('application.views.layouts').'/css_reset.css'));
            $cs->registerCssFile($am->publish(Yii::getPathOfAlias('application.views.layouts').'/h5bp-base.css'));
            $cs->registerCssFile($am->publish(Yii::getPathOfAlias('application.views.layouts').'/main.css'));

            // Global JS constants
            $cs->registerScript('globalConstants','
                // Set global JS constants
                var BASE_URL = "'.Yii::app()->createUrl('').'";', CClientScript::POS_HEAD);

            // Global JS scripts
            $cs->registerCoreScript('jquery');
            $cs->registerCoreScript('jquery.ui');
            $cs->registerScriptFile($am->publish(Yii::getPathOfAlias('application.views.layouts').'/main.js'),CClientScript::POS_END);
        }
    }

    /**
     * Default index action for every controller.
     */
    public function actionIndex()
    {
        $this->redirect(array($this->id.'/'.$this->defaultAction));
    }

    /**
     * The error action called each time a bug occurs.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error) {
            //die('<pre>'.print_r($error).'</pre>');
            $this->render('//layouts/error', $error);
        }
    }
}