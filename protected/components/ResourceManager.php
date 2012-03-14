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
     * Fetch from the database the entire HS classification.
     * @param integer $level The level (or tree node code) from which to retrieve the tree.
     * @param bool $levelOnly Whether to retrieve only codes from the specified level or retreive the entire below tree.
     * @return array An array representing the HS classification tree. 
     */
    public static function getHSCodeTree($level=0,$levelOnly=true)
    {
        $hsTree = array();
        if($level != 0 && $levelOnly) {
            $codes = Code::model()->findAll(array('condition'=>"isChildOf = $level",'order'=>'isChildOf'));
        }
        elseif($level == 0 && $levelOnly) {
            $codes = Code::model()->findAll(array('condition'=>"isChildOf IS NULL",'order'=>'isChildOf'));
        }
        else {
            $codes = Code::model()->findAll(array('order'=>'isChildOf'));
        }
        //TODO : Create a proper leveled tree array.
        // create the array
        foreach($codes as $code) {
            $hsTree[] = array(  "code"=>$code->number,
                                "description"=>$code->description,
                                "parent"=>$code->isChildOf);
        }
        return $hsTree;
    }
}
?>