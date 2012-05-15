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
    // The default layout
    public $layout = '//layouts/primary';
    
    // Initialize pages breadcrumbs (to overwrite for breadcrumbs to appear)
    public $breadcrumbsLinks = array();
    
    
    /*
     * Enable access control.
     */
    public function filters()
    {
        return array('accessControl');
    }
    
    /**
     * Specify the access rules for all controllers.
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow everyone
                'users'=>array('*'),
            ),
        );
    }
    
    /**
     * The error action called each time a bug occurs.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error) {
            $this->render('error', $error);
        }
    }
}