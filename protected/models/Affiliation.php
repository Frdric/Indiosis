<?php

/**
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * MODEL : Affiliation 
 * The model class for table "affiliation".
 * 
 * The followings are the available columns in table 'affiliation':
 * @property integer $Parent_id
 * @property integer $Child_id
 *
 * The followings are the available model relations:
 * @property Organization $child
 * @property Organization $parent
 *
 * @package     base
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */
 
class Affiliation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Affiliation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'affiliation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Parent_id, Child_id', 'required'),
			array('Parent_id, Child_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Parent_id, Child_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'child' => array(self::BELONGS_TO, 'Organization', 'Child_id'),
			'parent' => array(self::BELONGS_TO, 'Organization', 'Parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Parent_id' => 'Parent',
			'Child_id' => 'Child',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Parent_id',$this->Parent_id);
		$criteria->compare('Child_id',$this->Child_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}