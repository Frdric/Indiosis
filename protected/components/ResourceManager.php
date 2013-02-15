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


class ResourceManager extends CApplicationComponent {

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

    /**
     * Check if a given class code is Custom or Standard (HS or ISIC).
     * @param string $classCode The class code to check.
     * @return boolean TRUE if the class is a Custom one, FALSE otherwise
     */
    public static function isCustomClass($classCode)
    {
        $customClasses = CustomClass::model()->findByPk($classCode);
        if($customClasses != NULL)
            return true;
        else
            return false;
    }


    /**
     * Parse a given ISBC spreadsheet file and extract ISBCs from it.
     * @param CUploadedFile $sprdsht The just uploaded spreadsheet file.
     * @param boolean $save Directly saves the ISBCs if true (default FALSE - structure check only)
     * @return array The ISBCs or CHttpException if the spreadsheet is incorrectly structured.
     */
    public static function parseIsbcSpreadsheet($sprdsht,$save=false)
    {
        // turn off Yii autoload
        spl_autoload_unregister(array('YiiBase','autoload'));

        // include the main class (phpExcel has its own autoload registration)
        include(Yii::getPathOfAlias('ext.PHPExcel') . DIRECTORY_SEPARATOR . 'PHPExcel.php');
        // transform file into an array
        $objPHPExcel = PHPExcel_IOFactory::load($sprdsht->tempName);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,false,true);

        // turn Yii autoload back on.
        spl_autoload_register(array('YiiBase','autoload'));

        // get ISIC and HS lists for validation
        $allISIC = ResourceManager::getISICList();
        $allHS = ResourceManager::getHSList();

        // try parsing...
        try
        {
            $validISBCs = array(); # stores valid ISBC ready to be imported.
            $current_ISBC = array(  'ISBC'=>null,
                                    'SymbLinks'=>null,
                                    'Location'=>null);
            // crawl each line..
            foreach ($sheetData as $line => $columns)
            {
                // -- new ISBC
                if(is_float($columns['A']))
                {
                    // keep previous valid ISBC
                    if($current_ISBC['ISBC']!=NULL) { $validISBCs[] = $current_ISBC;}

                    // requirements check
                    if(empty($columns['B'])) throw new CHttpException(417,'Title is missing for case number '.$columns['A'].' - row '.$line);
                    if(empty($columns['F'])) throw new CHttpException(417,'Type is missing for case number '.$columns['A'].' - row '.$line);

                    $newISBC = new ISBC;

                    $columns['F'] = strtolower($columns['F']);

                    // matching with Indiosis scales of IS
                    switch (true) {
                        case preg_match('(waste)', $columns['F']);
                            $newISBC->type = 'wastex';
                            break;
                        case preg_match('(eco|park)', $columns['F']);
                            $newISBC->type = 'ecopark';
                            break;
                        case preg_match('(intra|facility)', $columns['F']);
                            $newISBC->type = 'intra';
                            break;
                        case preg_match('(local)', $columns['F']);
                            $newISBC->type = 'local';
                            break;
                        case preg_match('(regional)', $columns['F']);
                            $newISBC->type = 'regional';
                            break;
                        case preg_match('(mutual|shared)', $columns['F']);
                            $newISBC->type = 'mutual';
                            break;
                        default:
                            throw new CHttpException(417,'Case number '.$columns['A'].' is missing an IS scale (wastex,ecopark,intra,local,regional or mutual) - row '.$line);
                            break;
                    }
                    $newISBC->title = $columns['B'];
                    $newISBC->overview = $columns['C'];
                    preg_match('(\d\d\d\d)',$columns['E'],$timePeriod); # match first year (YYYY string)
                    $newISBC->time_period = ( (isset($timePeriod[0])) ? $timePeriod[0] : '' );
                    $newISBC->eco_drivers = $columns['J'];
                    $newISBC->eco_barriers = $columns['K'];
                    $newISBC->tech_drivers = $columns['L'];
                    $newISBC->tech_barriers = $columns['M'];
                    $newISBC->regul_drivers = $columns['N'];
                    $newISBC->regul_barriers = $columns['O'];
                    $newISBC->socioenv_benefits = $columns['H'];
                    $newISBC->contingencies = $columns['I'];
                    $newISBC->source = $columns['G'];
                    $newISBC->added_on = date("Y-m-d H:i:s");

                    // -- new Location
                    $isbc_loc = new Location;
                    if(!$isbc_loc->country=array_search($columns['D'],Yii::app()->params['countryList'])) {
                        $isbc_loc->country = $columns['D'];
                    }
                    // keep valid location
                    if(!empty($isbc_loc->country)) { $current_ISBC['Location'] = clone $isbc_loc; }
                    $current_ISBC['ISBC'] = clone $newISBC;
                }

                // -- new Symbiotic Linkage
                if(!empty($columns['P']) && $current_ISBC['ISBC']!=NULL)
                {
                    // requirements check
                    if(empty($columns['R'])) throw new CHttpException(417,'An HS code is required at row '.$line);
                    if(empty($columns['U'])) throw new CHttpException(417,'An ISIC code is required at row '.$line);
                    if(empty($columns['W'])) throw new CHttpException(417,'An ISIC code is required at row '.$line);
                    if(empty($columns['S'])) throw new CHttpException(417,'Symbiotic linkage type is missing at row '.$line);

                    $sLink = new SymbioticLinkage;

                    $columns['S'] = strtolower($columns['S']);

                    // matching with Indiosis Symbiotic linkage types
                    switch (true) {
                        case preg_match('(reuse|by-product|waste|exchange)', $columns['S']);
                            $sLink->type = 'reuse';
                            break;
                        case preg_match('(sharing|shared|resource)', $columns['S']);
                            $sLink->type = 'sharing';
                            break;
                        case preg_match('(joint|joined|service|services)', $columns['S']);
                            $sLink->type = 'joint';
                            break;
                        default:
                            throw new CHttpException(417,'A valid type of symbiotic linkage (reuse,sharing or joint) is required at row '.$line);
                            break;
                    }

                    // transform to 6 digit code
                    for ($z=strlen($columns['R']); $z < 6 ; $z++) {
                        $columns['R'] = '0'.$columns['R'];
                    }
                    // checking if the Resource is a valid HS
                    if(isset($allHS[$columns['R']])) {
                        $sLink->MaterialClass_number = $columns['R'];
                    }
                    else {
                        throw new CHttpException(417,'A valid HS code is required at row '.$line.' - ('.$columns['R'].' does not exist)');
                    }
                    // checking if the Source & End are valid ISIC
                    if(isset($allISIC['ISIC-'.$columns['U']])) {
                        $sLink->SourceClass_number = 'ISIC-'.$columns['U'];
                    }
                    else {
                        throw new CHttpException(417,'A valid Source industry ISIC code is required at row '.$line.' - ('.$columns['U'].' does not exist)');
                    }
                    if(isset($allISIC['ISIC-'.$columns['W']])) {
                        $sLink->EndClass_number = 'ISIC-'.$columns['W'];
                    }
                    else {
                        throw new CHttpException(417,'A valid End industry ISIC code is required at row '.$line.' - ('.$columns['W'].' does not exist)');
                    }
                    $sLink->qty = $columns['X'];
                    $sLink->implementation = $columns['Y'];
                    $sLink->benefit_source = $columns['Z'];
                    $sLink->benefit_end = $columns['AA'];
                    $sLink->remarks = $columns['AB'];

                    // keep valid symbiotic linkage
                    $current_ISBC['SymbLinks'][] = clone $sLink;
                }
            }
        }
        // parsing end (catch exception if file is )
        catch (CHttpException $e) {
            return $e;
        }

        return $validISBCs;
    }

    /**
     * Parse an HS csv file and import into DB.
     */
    public function parseHScsv()
    {
        if (($handle = fopen(Yii::getPathOfAlias('application.data').'/HScodes.csv', "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                //print_r($row);
                if(count($row)>1)
                {
                    for ($i=strlen($row[0]); $i < 6 ; $i++) {
                        $row[0] = '0'.$row[0];
                    }
                    //echo $row[0].' : '.$row[1].'<br/>';

                    $ccode = new ClassCode();
                    $ccode->number = $row[0];
                    $ccode->description = $row[1];
                    $ccode->ClassificationSystem_name = 'HS';
                    if(!$ccode->validate()) {
                        print_r($ccode->errors);
                    }
                    $ccode->save();
                }
            }
            fclose($handle);
        }
    }

    /**
     * Parse an HS uom csv file and import into DB.
     */
    public function addUom()
    {
        if (($handle = fopen(Yii::getPathOfAlias('application.data').'/HSuom.csv', "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                //print_r($row);
                if(count($row)>1)
                {
                    $ccode = ClassCode::model()->findByPk($row[0]);
                    if($ccode!=null) {
                        $ccode->uom = $row[1];
                        $ccode->save();
                    }
                }
            }
            fclose($handle);
        }
    }
}
?>