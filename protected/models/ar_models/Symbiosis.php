<?php

/**
 * This is the model class for table "Symbiosis".
 *
 * The followings are the available columns in table 'Symbiosis':
 * @property integer $id
 * @property string $status
 * @property string $descrition
 * @property string $created_on
 * @property string $expires_on
 *
 * The followings are the available model relations:
 * @property ResourceFlow[] $resourceFlows
 */
class Symbiosis extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Symbiosis the static model class
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
		return 'Symbiosis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, created_on', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>8),
			array('descrition, expires_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, descrition, created_on, expires_on', 'safe', 'on'=>'search'),
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
			'resourceFlows' => array(self::MANY_MANY, 'ResourceFlow', 'SymbioticFlow(Symbiosis_id, ResourceFlow_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'status' => 'Status',
			'descrition' => 'Descrition',
			'created_on' => 'Created On',
			'expires_on' => 'Expires On',
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('descrition',$this->descrition,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('expires_on',$this->expires_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}