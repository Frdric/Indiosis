<?php

/**
 * This is the model class for table "CommunicationMean".
 *
 * The followings are the available columns in table 'CommunicationMean':
 * @property integer $id
 * @property string $type
 * @property string $value
 * @property string $label
 * @property integer $User_id
 * @property integer $Organization_id
 *
 * The followings are the available model relations:
 * @property Organization $organization
 * @property User $user
 */
class CommunicationMean extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CommunicationMean the static model class
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
		return 'CommunicationMean';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, value', 'required'),
			array('User_id, Organization_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>7),
			array('value, label', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, value, label, User_id, Organization_id', 'safe', 'on'=>'search'),
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
			'organization' => array(self::BELONGS_TO, 'Organization', 'Organization_id'),
			'user' => array(self::BELONGS_TO, 'User', 'User_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'value' => 'Value',
			'label' => 'Label',
			'User_id' => 'User',
			'Organization_id' => 'Organization',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('User_id',$this->User_id);
		$criteria->compare('Organization_id',$this->Organization_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}