<?php

/**
 * This is the model class for table "indiosis.RequestedResource".
 *
 * The followings are the available columns in table 'indiosis.RequestedResource':
 * @property integer $SynergyRequest_id
 * @property integer $Resource_id
 */
class RequestedResource extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RequestedResource the static model class
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
		return 'indiosis.RequestedResource';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SynergyRequest_id, Resource_id', 'required'),
			array('SynergyRequest_id, Resource_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SynergyRequest_id, Resource_id', 'safe', 'on'=>'search'),
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
			'SynergyRequest_id' => 'Synergy Request',
			'Resource_id' => 'Resource',
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

		$criteria->compare('SynergyRequest_id',$this->SynergyRequest_id);
		$criteria->compare('Resource_id',$this->Resource_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}