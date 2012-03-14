<?php

/**
 * This is the model class for table "indiosis.CodeCorrelation".
 *
 * The followings are the available columns in table 'indiosis.CodeCorrelation':
 * @property string $ReferringCode
 * @property string $CorrelatingCode
 * @property integer $isPartOf
 *
 * The followings are the available model relations:
 * @property Code $referringCode
 * @property Code $correlatingCode
 */
class CodeCorrelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
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
		return 'indiosis.CodeCorrelation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ReferringCode, CorrelatingCode', 'required'),
			array('isPartOf', 'numerical', 'integerOnly'=>true),
			array('ReferringCode, CorrelatingCode', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ReferringCode, CorrelatingCode, isPartOf', 'safe', 'on'=>'search'),
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
			'referringCode' => array(self::BELONGS_TO, 'Code', 'ReferringCode'),
			'correlatingCode' => array(self::BELONGS_TO, 'Code', 'CorrelatingCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ReferringCode' => 'Referring Code',
			'CorrelatingCode' => 'Correlating Code',
			'isPartOf' => 'Is Part Of',
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

		$criteria->compare('ReferringCode',$this->ReferringCode,true);
		$criteria->compare('CorrelatingCode',$this->CorrelatingCode,true);
		$criteria->compare('isPartOf',$this->isPartOf);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}