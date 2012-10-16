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

    /**
     * Specify the access rules for this controller.
     */
    public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('newcase'),
                'users'=>array("?")
            )
        );
    }

    /**
     * Run before every action.
     * @param CAction $action The action that'll be executed.
     * @return boolean Wether or not to continue.
     */
    protected function beforeAction($action)
    {
        $this->defaultAction = 'browse';
        $this->breadcrumbsLinks = array('IS Repository'=>'index');
        if(!Yii::app()->user->isGuest) {
            $this->menuActions = array('Add new IS case'=>$this->createUrl('repository/newCase'));
        }
        return true;
    }

    /**
     * Browse the IS repository.
     */
    public function actionBrowse()
    {
        $this->breadcrumbsLinks = array('IS Repository'=>'index','Browse');
        $resourceModel = new ClassCode;
        $this->render('repository',array('resourceModel'=>$resourceModel),false,true);
    }

    /**
     * Add a new IS case into the repository.
     */
    public function actionNewCase()
    {
    	$this->breadcrumbsLinks = array('IS Repository'=>$this->createUrl('repository/index'),'New IS Case');

        $IScase = new ISCase;
        $location = new Location;
        $IScaseClass = new ISCaseClass;

        if(isset($_POST['ISCase'], $_POST['Location'], $_POST['ISCaseClass']))
        {
            $IScase->attributes = $_POST['ISCase'];
            $location->attributes = $_POST['Location'];
            $location->label = 'IS Case Region';
            $isClassesValid = false;

            if($IScase->validate() && $location->validate()) {
                if($IScase->save())
                {
                    $location->ISCase_id = $IScase->id;
                    $location->save();
                    foreach($_POST['ISCaseClass'] as $ISClass) {
                        $IScC = new ISCaseClass;
                        $IScC->ISCase_id = $IScase->id;
                        $IScC->attributes = $ISClass;
                        $IScC->save();
                    }
                    $this->render('//layouts/notifications', array('message'=>"The IS case is now available in the main repository.",
                                                                    'title'=>"Saved to repository",
                                                                    'backUrl'=>$this->createUrl('repository/index')));
                    Yii::app()->end();
                }
            }
    	}

    	$this->render('newIScase',array('IScase'=>$IScase,
                                        'location'=>$location,
                                        'IScaseClass'=>$IScaseClass));
    }

    public function actionViewCase()
    {
        $this->menuActions['Edit case']=Yii::app()->createUrl('repository/editcase');
        $this->render('iscase');
    }


    /**
     * AJAX/JSON - Lookup a material name and retrieve possible matches.
     */
    public function actionMaterialAutocomplete()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['q']))
        {
            $materialList = array();
            $materialTree = ResourceManager::getHSCodeTree(0,false);
            foreach($materialTree as $material) {
                if(stripos($material['description'],$_GET['q'])!==false) {
                    $materialList[] = $material['description'].'|'.$material['code'];
                }
            }
            // return the material list
            echo implode("\n", $materialList);
            //echo CJSON::encode($materialList);
        }
    }
}