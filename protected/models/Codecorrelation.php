<?php

/**
 * This is the model class for table "CodeCorrelation".
 *
 * The followings are the available columns in table 'CodeCorrelation':
 * @property string $ReferringCode_number
 * @property string $CorrelatingCode_number
 *
 * The followings are the available model relations:
 * @property ClassCode $correlatingCodeNumber
 * @property ClassCode $referringCodeNumber
 */
class CodeCorrelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CodeCorrelation the static model class
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
		return 'CodeCorrelation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ReferringCode_number, CorrelatingCode_number', 'required'),
			array('ReferringCode_number, CorrelatingCode_number', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ReferringCode_number, CorrelatingCode_number', 'safe', 'on'=>'search'),
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
			'correlatingCodeNumber' => array(self::BELONGS_TO, 'ClassCode', 'CorrelatingCode_number'),
			'referringCodeNumber' => array(self::BELONGS_TO, 'ClassCode', 'ReferringCode_number'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ReferringCode_number' => 'Referring Code Number',
			'CorrelatingCode_number' => 'Correlating Code Number',
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

		$criteria->compare('ReferringCode_number',$this->ReferringCode_number,true);
		$criteria->compare('CorrelatingCode_number',$this->CorrelatingCode_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}