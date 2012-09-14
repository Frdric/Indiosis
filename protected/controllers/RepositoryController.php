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
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class RepositoryController extends IndiosisController
{

    public $menuActions;

    public function init()
    {
        $this->breadcrumbsLinks = array('IS Repository'=>'index');
        $this->menuActions = array('Add new IS case'=>Yii::app()->createUrl('repository/newCase'));
    }

    public function actionIndex()
    {
        $this->redirect(array('browse'));
    }

    /**
     * Browse the IS repository.
     */
    public function actionBrowse()
    {
        $this->breadcrumbsLinks = array('IS Repository');
        $resourceModel = new ClassCode;
        $this->render('repository',array('resourceModel'=>$resourceModel),false,true);
    }

    /**
     * Add a new IS case into the repository.
     */
    public function actionNewCase()
    {
    	$this->breadcrumbsLinks = array('IS Repository'=>'index','New IS Case');

    	// create the form
    	$form = new CForm('application.views.repository.ISCaseForm', new ISCase, $this->createWidget('IndiosisForm'));

        $form['iscase']->model = new ISCase;
        $form['location']->model = new Location;

        if($form->submitted('saveCase') && $form->validate())
    	{
            $iscase = $form['iscase']->model;
            $location = $form['location']->model;

            if($iscase->save(false))
            {
                $location->ISCase_id = $iscase->id;
                $location->save();
            }
    	}

    	$this->render('add',array('form'=>$form));
    }

    public function actionViewCase()
    {
        $this->menuActions['Edit case']=Yii::app()->createUrl('repository/editcase');
        $this->render('iscase');
    }
}