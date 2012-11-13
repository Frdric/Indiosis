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
            $this->menuActions = array('Add ISBC'=>$this->createUrl('repository/newcase'),'Import ISBCs'=>$this->createUrl('repository/importxcel'));
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

        $IScase = new ISBC;
        $location = new Location;
        $symbioticLink = new SymbioticLinkage;

        if(isset($_POST['ISBC'], $_POST['Location'], $_POST['SymbioticLinkage']))
        {
            $IScase->attributes = $_POST['ISBC'];
            $IScase->added_on = date("Y-m-d H:i:s");
            $location->attributes = $_POST['Location'];
            $location->label = 'IS Case Region';
            $symbioticLink->attributes = $_POST['SymbioticLinkage'][1];
            $symbioticLink->ISCase_id = 0;

            if($IScase->validate() && $location->validate() && $symbioticLink->validate()) {
                if($IScase->save())
                {
                    $location->ISCase_id = $IScase->id;
                    $location->save();
                    foreach($_POST['SymbioticLinkage'] as $ISClass) {
                        $IScC = new SymbioticLinkage;
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

        $ISIClist = ResourceManager::getISICList();
        $HScodes = ResourceManager::getHSList();

    	$this->render('newcase',array('IScase'=>$IScase,
                                        'location'=>$location,
                                        'SymbioticLink'=>$symbioticLink,
                                        'ISIClist'=>$ISIClist,
                                        'HScodes'=>$HScodes));
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

    /**
     * Auto inserts ISBCs from an Excel file (based on provided template).
     */
    public function actionImportXcel()
    {
        $xcelform = new ISBCXcelForm;

        if(isset($_POST['ISBCXcelForm']))
        {
            $xcelform->attributes = $_POST['ISBCXcelForm'];
            $xcelfile = CUploadedFile::getInstance($xcelform,'xcelfile');
            if($xcelform->validate())
            {
                spl_autoload_unregister(array('YiiBase','autoload')); # turns off Yii autoload

                // include the main class (phpExcel has its own autoload registration)
                include(Yii::getPathOfAlias('ext.PHPExcel') . DIRECTORY_SEPARATOR . 'PHPExcel.php');

                //$inputFileName = Yii::getPathOfAlias('application.data').'/Indiosis_ISBC_Sprdsheet_Template.xls';
                $objPHPExcel = PHPExcel_IOFactory::load($xcelfile->tempName);

                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                echo '<pre>';
                var_dump($sheetData);
                echo '</pre>';
                die("done");
            }
        }

        $this->render('xcelimport',array('xcelform'=>$xcelform));
    }
}