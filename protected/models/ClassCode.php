<?php

/**
 * This is the model class for table "ClassCode".
 *
 * The followings are the available columns in table 'ClassCode':
 * @property string $number
 * @property string $description
 * @property string $uom
 * @property string $ClassificationSystem_name
 * @property string $ChildOf_number
 *
 * The followings are the available model relations:
 * @property ClassificationSystem $classificationSystemName
 * @property ClassCode $childOfNumber
 * @property ClassCode[] $classCodes
 * @property CodeCorrelation[] $codeCorrelations
 * @property CodeCorrelation[] $codeCorrelations1
 * @property CustomClass[] $customClasses
 * @property Expertise[] $expertises
 * @property ISCaseClass[] $iSCaseClasses
 * @property ResourceFlow[] $resourceFlows
 */
class ClassCode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassCode the static model class
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
		return 'ClassCode';
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
			'classificationSystemName' => array(self::BELONGS_TO, 'ClassificationSystem', 'ClassificationSystem_name'),
			'childOfNumber' => array(self::BELONGS_TO, 'ClassCode', 'ChildOf_number'),
			'classCodes' => array(self::HAS_MANY, 'ClassCode', 'ChildOf_number'),
			'codeCorrelations' => array(self::HAS_MANY, 'CodeCorrelation', 'ReferringCode_number'),
			'codeCorrelations1' => array(self::HAS_MANY, 'CodeCorrelation', 'CorrelatingCode_number'),
			'customClasses' => array(self::HAS_MANY, 'CustomClass', 'MatchingCode_number'),
			'expertises' => array(self::HAS_MANY, 'Expertise', 'ResourceCode_number'),
			'iSCaseClasses' => array(self::HAS_MANY, 'ISCaseClass', 'ClassCode_number'),
			'resourceFlows' => array(self::HAS_MANY, 'ResourceFlow', 'ClassCode_number'),
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