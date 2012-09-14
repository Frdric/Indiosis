<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * FORM : IS Case Form
 * Describes the fields of a IS case.
 *
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */
return array(
    'elements'=>array(

        'iscase'=>array(
            'type'=>'form',
            'elements'=>array(

                '<h4>Main Designation</h4>',
                '<hr/>',

                'title'=>array(
                    'type'=>'text',
                    'label'=>'Case title'
                ),
                'type'=>array(
                    'type'=>'dropdownlist',
                    'items'=>array('type-1'=>'Waste exchange','type-2'=>'Intra-facility','type-3'=>'Eco-industrial park','type-4'=>'Local','type-5'=>'Regional','type-6'=>'Mutualization'),
                    'label'=>'Symbiosis Type'
                ),
                'description'=>array(
                    'type'=>'textarea',
                    'label'=>'Practice<br/>description',
                    'rows'=>'10'
                ),
                'source'=>array(
                    'type'=>'text',
                    'label'=>'Source'
                ),

                '<div class="impacts">',
                '<h4>Impacts</h4>',
                '<hr/>',

                'financial_impact'=>array(
                    'type'=>'textarea',
                    'label'=>'Financial :<br/>',
                    'rows'=>'10'
                ),
                'ht_impact'=>array(
                    'type'=>'textarea',
                    'label'=>'Financial',
                    'rows'=>'10'
                ),
                'org_impact'=>array(
                    'type'=>'textarea',
                    'label'=>'Organisational :<br/>',
                    'rows'=>'10'
                ),
                'envmnt_impact'=>array(
                    'type'=>'textarea',
                    'label'=>'Environmental :<br/>',
                    'rows'=>'10'
                ),
                'contingencies'=>array(
                    'type'=>'textarea',
                    'label'=>'Contingencies :<br/>',
                    'rows'=>'10'
                ),
                '</div>'
            )
        ),

        'location'=>array(
            'type'=>'form',
            'elements'=>array(
                'label'=>array(
                    'type'=>'dropdownlist',
                    'items'=>Yii::app()->params['countryList'],
                    'label'=>'Location',
                )
            )
        )
    ),

    'buttons'=>array(
        'saveCase'=>array(
            'type'=>'submit',
            'label'=>'Add to Repository',
            'class'=>'ibutton_big iblue'
        ),
    ),
);
?>