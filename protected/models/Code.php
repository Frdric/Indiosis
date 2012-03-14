<?php

/**
 * This is the model class for table "indiosis.Code".
 *
 * The followings are the available columns in table 'indiosis.Code':
 * @property string $number
 * @property string $description
 * @property string $uom
 * @property string $isChildOf
 * @property string $CodingSystem_name
 *
 * The followings are the available model relations:
 * @property Code $isChildOf0
 * @property Code[] $codes
 * @property Codingsystem $codingSystemName
 * @property CodeCorrelation[] $codeCorrelations
 * @property CodeCorrelation[] $codeCorrelations1
 * @property CustomResource[] $customResources
 * @property News[] $news
 * @property Resource[] $resources
 * @property User[] $users
 */
class Code extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Code the static model class
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
		return 'indiosis.Code';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, description, CodingSystem_name', 'required'),
			array('number, isChildOf', 'length', 'max'=>255),
			array('uom', 'length', 'max'=>45),
			array('CodingSystem_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('number, description, uom, isChildOf, CodingSystem_name', 'safe', 'on'=>'search'),
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
			'isChildOf0' => array(self::BELONGS_TO, 'Code', 'isChildOf'),
			'codes' => array(self::HAS_MANY, 'Code', 'isChildOf'),
			'codingSystemName' => array(self::BELONGS_TO, 'Codingsystem', 'CodingSystem_name'),
			'codeCorrelations' => array(self::HAS_MANY, 'CodeCorrelation', 'ReferringCode'),
			'codeCorrelations1' => array(self::HAS_MANY, 'CodeCorrelation', 'CorrelatingCode'),
			'customResources' => array(self::HAS_MANY, 'CustomResource', 'matchingCode'),
			'news' => array(self::MANY_MANY, 'News', 'NewsCodeRelation(Code_number, News_id)'),
			'resources' => array(self::HAS_MANY, 'Resource', 'Code_number'),
			'users' => array(self::MANY_MANY, 'User', 'UserExpertise(Code_number, User_id)'),
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
			'isChildOf' => 'Is Child Of',
			'CodingSystem_name' => 'Coding System Name',
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
		$criteria->compare('isChildOf',$this->isChildOf,true);
		$criteria->compare('CodingSystem_name',$this->CodingSystem_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}