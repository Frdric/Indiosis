<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Inventory Controller
 * Handles all actions related to profile's material inventory.
 * 
 * @package     inventory
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


class InventoryController extends IndiosisController
{
    /**
     * Displays inventory management page.
     */
    public function actionIndex()
    {
        $resourceModel = new Resource;
        $this->render('inventory',array('resourceModel'=>$resourceModel),false,true);
    }
    
    
    /**
     * AJAX/JSON - Add a resource/material to some company's inventory.
     */
    public function actionAddResource()
    {
        
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