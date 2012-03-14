<?php

/**
 * This is the model class for table "indiosis.CodingSystem".
 *
 * The followings are the available columns in table 'indiosis.CodingSystem':
 * @property string $name
 * @property string $fullName
 * @property string $revision
 */
class CodingSystem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CodingSystem the static model class
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
		return 'indiosis.CodingSystem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>20),
			array('fullName', 'length', 'max'=>255),
			array('revision', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, fullName, revision', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'fullName' => 'Full Name',
			'revision' => 'Revision',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('fullName',$this->fullName,true);
		$criteria->compare('revision',$this->revision,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}