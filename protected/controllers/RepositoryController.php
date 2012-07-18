<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * CONTROLLER : Home Controller
 * Handles all home pages related actions.
 *
 * @package     home
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class RepositoryController extends IndiosisController
{

    public function actionIndex()
    {
    	$this->breadcrumbsLinks = array('IS Repository');
        $this->render('repository');
    }
}