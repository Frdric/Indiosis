<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * FORM : ISBC Excel file upload form.
 *
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class ISBCXcelForm extends CFormModel
{
    public $xcelfile;
    public $parsedISBCs;

    /**
     * Rules applying to the form fields.
     */
    public function rules()
    {
        return array(
            array('xcelfile', 'required'),
            array('xcelfile', 'file', 'types'=>array('xls', 'xlsx')),
            array('xcelfile', 'wellStructured', 'skipOnError'=>true) # executed only if previous rules are met
        );
    }

    /**
     * Customize attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'xcelfile'=>'Spreadsheet',
        );
    }

    /**
     * Checks if the spreasheet file is correctly structured.
     */
    public function wellStructured($attribute,$params)
    {
        if(!empty($this->xcelfile->tempName)) {
            $this->parsedISBCs = ResourceManager::parseIsbcSpreadsheet($this->xcelfile);
            if(!is_array($this->parsedISBCs) && get_class($this->parsedISBCs) == "CHttpException") {
                $this->addError($attribute, '<em class="bold error">Unable to import :</em> <em class="error">Spreasheet is incorrectly formated !</em><br/><br/>'.$this->parsedISBCs->getMessage());
            }
        }
    }
}
