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

    /**
     * Rules applying to the form fields.
     */
    public function rules()
    {
        return array(
            array('xcelfile', 'required'),
            array('xcelfile', 'file', 'types'=>array('xls', 'xlsx', 'csv'))
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
}
