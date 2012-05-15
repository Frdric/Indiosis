<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * - -- - - - - - - - - - - - *
 * 
 * CONTROLLER : Profile
 * Handles all profile related actions.
 * 
 * @package     profile
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class ProfileController extends IndiosisController
{
    
    /**
     * Specify the access rules for this controller.
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index'),
                'users'=>array('@'),
            ),
            array('deny',
                'actions'=>array('index')
            ),
        );
    }

    /**
     * Default action.
     */
    public function actionIndex()
    {
        $this->breadcrumbsLinks = array('Profile'=>array('profile'),Yii::app()->user->organizationName.' (you)');
        $this->render('overview',array('companyName'=>null));
    }
}