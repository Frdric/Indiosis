<?php

/**
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * MODEL : Resourcecode 
 * The model class for table "resourcecode".
 * 
 * The followings are the available columns in table 'resourcecode':
 * @property string $number
 * @property string $description
 * @property string $uom
 * @property string $ClassificationSystem_name
 * @property string $ChildOf_number
 *
 * The followings are the available model relations:
 * @property Codecorrelation[] $codecorrelations
 * @property Codecorrelation[] $codecorrelations1
 * @property Customresource[] $customresources
 * @property Expertise[] $expertises
 * @property Resourcecode $childOfNumber
 * @property Resourcecode[] $resourcecodes
 * @property Classificationsystem $classificationSystemName
 * @property Resourceflow[] $resourceflows
 *
 * @package     base
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */
 
class Resourcecode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resourcecode the static model class
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
		return 'resourcecode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, description, ClassificationSystem_name', 'required'),
			array('number, ChildOf_number', 'length', 'max'=>250),
			array('uom', 'length', 'max'=>50),
			array('ClassificationSystem_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('number, description, uom, ClassificationSystem_name, ChildOf_number', 'safe', 'on'=>'search'),
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
			'codecorrelations' => array(self::HAS_MANY, 'Codecorrelation', 'CorrelatingCode_number'),
			'codecorrelations1' => array(self::HAS_MANY, 'Codecorrelation', 'ReferringCode_number'),
			'customresources' => array(self::HAS_MANY, 'Customresource', 'MatchingCode_number'),
			'expertises' => array(self::HAS_MANY, 'Expertise', 'ResourceCode_number'),
			'childOfNumber' => array(self::BELONGS_TO, 'Resourcecode', 'ChildOf_number'),
			'resourcecodes' => array(self::HAS_MANY, 'Resourcecode', 'ChildOf_number'),
			'classificationSystemName' => array(self::BELONGS_TO, 'Classificationsystem', 'ClassificationSystem_name'),
			'resourceflows' => array(self::HAS_MANY, 'Resourceflow', 'ResourceCode_number'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'number' => 'Number',
			'description' => 'Description',
			'uom' => 'Uom',
			'ClassificationSystem_name' => 'Classification System Name',
			'ChildOf_number' => 'Child Of Number',
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

		$criteria->compare('number',$this->number,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('uom',$this->uom,true);
		$criteria->compare('ClassificationSystem_name',$this->ClassificationSystem_name,true);
		$criteria->compare('ChildOf_number',$this->ChildOf_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}