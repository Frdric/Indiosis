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

class HomeController extends IndiosisController
{

    /**
     * Run before every action.
     * @param CAction $action The action that'll be executed.
     * @return boolean Wether or not to continue.
     */
    protected function beforeAction($action)
    {
        $this->defaultAction = 'index';
        return true;
    }


    public function actionIndex()
    {
        $this->render('home');
    }
}