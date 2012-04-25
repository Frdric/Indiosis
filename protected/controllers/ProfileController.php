<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
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
    
    public function actions() {}

    /**
     * Default action.
     */
    public function actionIndex()
    { 
        $this->render('profile');
    }
}