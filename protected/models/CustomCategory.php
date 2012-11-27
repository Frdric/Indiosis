<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 *
 * MODEL : Custom Category
 * Component handling all the geographic-related functionalities.
 *
 * @package     models
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

class CustomCategory extends CustomClass
{
	public $classification; # classification system to refer to.

	/**
	 * Adding virtual field rules
	 */
	public function rules()
	{
		return array_merge(
			array(
				array('MatchingCode_number','length','max'=>10),
				array('MatchingCode_number','exist',
											'attributeName'=>'number',
		        							'className' => 'ClassCode',
		        							'message'=>'Code is not valid or does not exist.'
		        ),
				array('classification', 'required')
			),
			parent::rules()
		);
	}

	/**
	 * Customizing label.
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'classification' => 'Type'
		));
	}
}