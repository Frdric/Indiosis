<?php

/**
 * This is the model class for table "CustomClass".
 *
 * The followings are the available columns in table 'CustomClass':
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $MatchingCode_number
 *
 * The followings are the available model relations:
 * @property ClassCode $matchingCodeNumber
 * @property ResourceFlow[] $resourceFlows
 * @property SymbioticLinkage[] $symbioticLinkages
 */
class CustomClass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomClass the static model class
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
		return 'CustomClass';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, description, MatchingCode_number', 'required'),
			array('code', 'length', 'max'=>255),
			array('MatchingCode_number', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('code, name, description, MatchingCode_number', 'safe', 'on'=>'search'),
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
			'matchingCodeNumber' => array(self::BELONGS_TO, 'ClassCode', 'MatchingCode_number'),
			'resourceFlows' => array(self::HAS_MANY, 'ResourceFlow', 'CustomClass_code'),
			'symbioticLinkages' => array(self::HAS_MANY, 'SymbioticLinkage', 'CustomMaterial_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'code' => 'Code',
			'name' => 'Name',
			'description' => 'Description',
			'MatchingCode_number' => 'Matching Code Number',
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

		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('MatchingCode_number',$this->MatchingCode_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}