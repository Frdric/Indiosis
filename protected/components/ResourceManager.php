<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 *
 * Resource Manager
 * Component handling all resource related operations,
 * including classification and company's material.
 *
 * @package     resource
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


class ResourceManager extends CComponent {

    // whether to perform the matching according to the reach (matching result will be within the reach radius).
    private $reach_on = false;


    /**
     * Match a company's material with other potential synergy companies.
     * @param Company $company The company to make the match on.
     * @return array A list of material matching the company's inventory.
     */
    public static function matchResources($company)
    {
        $user = Yii::app()->db->createCommand()
            ->select()
            ->from('Resource')
            ->join('Company', 'Company_id = 1')
            ->queryRow();
        print_r($user);
        return 1;
    }

    /**
     * Fetch from the database the entire ISIC classification.
     * @param integer $level The level (or tree node code) from which to retrieve the tree.
     * @param bool $levelOnly Whether to retrieve only codes from the specified level or retreive the entire below tree.
     * @return array An array representing the ISIC classification tree.
     */
    public static function getISICTree($level=0,$levelOnly=true)
    {
        $isicTree = array();
        if($level != 0 && $levelOnly) {
            $codes = ClassCode::model()->findAll(array('condition'=>"ChildOf_number = $level AND ClassificationSystem_name = 'ISIC'",'order'=>'ChildOf_number'));
        }
        elseif($level == 0 && $levelOnly) {
            $codes = ClassCode::model()->findAll(array('condition'=>"ChildOf_number IS NULL AND ClassificationSystem_name = 'ISIC'",'order'=>'ChildOf_number'));
        }
        else {
            $codes = ClassCode::model()->findAll(array('condition'=>"ClassificationSystem_name = 'ISIC'",'order'=>'number'));
        }
        //TODO : Create a proper leveled tree array.
        // create the array
        foreach($codes as $code) {
            $isicTree[] = array("code"=>$code->number,
                                "description"=>$code->description,
                                "parent"=>$code->ChildOf_number);
        }
        return $isicTree;
    }

    /**
     * Return the ISIC activity list (with indented descriptions).
     */
    public static function getISICList()
    {
        $isicTree = ResourceManager::getISICTree(0,false);

        foreach($isicTree as $code) {
            switch (strlen($code['code'])) {
                case 9:
                    $isicList[$code['code']] = $code['description']." - [ class ]";
                    break;
                case 8:
                    $isicList[$code['code']] = $code['description']." - [ group ]";
                    break;
                case 7:
                    $isicList[$code['code']] = $code['description']." - [ division ]";
                    break;
                default:
                    $isicList[$code['code']] = $code['description']." - [ section ]";
                    break;
            }
        }
        return $isicList;
    }

    /**
     * Fetch from the database the entire HS classification.
     * @param integer $level The level (or tree node code) from which to retrieve the tree.
     * @param bool $levelOnly Whether to retrieve only codes from the specified level or retreive the entire below tree.
     * @return array An array representing the HS classification tree.
     */
    public static function getHSCodeTree($level=0,$levelOnly=true)
    {
        $hsTree = array();
        if($level != 0 && $levelOnly) {
            $codes = ClassCode::model()->findAll(array('condition'=>"ChildOf_number = $level AND ClassificationSystem_name = 'HS'",'order'=>'ChildOf_number'));
        }
        elseif($level == 0 && $levelOnly) {
            $codes = ClassCode::model()->findAll(array('condition'=>"ChildOf_number IS NULL AND ClassificationSystem_name = 'HS'",'order'=>'ChildOf_number'));
        }
        else {
            $codes = ClassCode::model()->findAll(array('condition'=>"ClassificationSystem_name = 'HS'",'order'=>'ChildOf_number'));
        }
        //TODO : Create a proper leveled tree array.
        // create the array
        foreach($codes as $code) {
            $hsTree[] = array(  "code"=>$code->number,
                                "description"=>$code->description,
                                "parent"=>$code->ChildOf_number);
        }
        return $hsTree;
    }

    /**
     * Return the ISIC activity list (with indented descriptions).
     */
    public static function getHSList()
    {
        $hsTree = ResourceManager::getHSCodeTree(0,false);

        foreach($hsTree as $code) {
            if($code['parent']=='') {
                $hsList[$code['code']] = $code['description']." - [ chapter ]";
            }
            else {
                $hsList[$code['code']] = $code['description'];
            }
        }

        return $hsList;
    }
}
?>