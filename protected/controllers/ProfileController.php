<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Profile Controller
 * Handles all company profile related actions.
 * 
 * @package     profile
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

class ProfileController extends IndiosisController
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->render('overview');
    }
}