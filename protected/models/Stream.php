<?php

/**
 * This is the model class for table "indiosis.Stream".
 *
 * The followings are the available columns in table 'indiosis.Stream':
 * @property integer $Resource_id
 * @property integer $provider
 * @property integer $receiver
 * @property integer $ExA_id
 * @property integer $qty
 * @property string $qtyUnit
 * @property string $frequency
 * @property integer $costSupporter
 *
 * The followings are the available model relations:
 * @property Company $provider0
 * @property Company $receiver0
 * @property Resource $resource
 * @property Company $costSupporter0
 * @property Synergy $exA
 */
class Stream extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Stream the static model class
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
		return 'indiosis.Stream';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Resource_id, provider, receiver, ExA_id, qty, qtyUnit, frequency', 'required'),
			array('Resource_id, provider, receiver, ExA_id, qty, costSupporter', 'numerical', 'integerOnly'=>true),
			array('qtyUnit', 'length', 'max'=>20),
			array('frequency', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Resource_id, provider, receiver, ExA_id, qty, qtyUnit, frequency, costSupporter', 'safe', 'on'=>'search'),
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
			'provider0' => array(self::BELONGS_TO, 'Company', 'provider'),
			'receiver0' => array(self::BELONGS_TO, 'Company', 'receiver'),
			'resource' => array(self::BELONGS_TO, 'Resource', 'Resource_id'),
			'costSupporter0' => array(self::BELONGS_TO, 'Company', 'costSupporter'),
			'exA' => array(self::BELONGS_TO, 'Synergy', 'ExA_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Resource_id' => 'Resource',
			'provider' => 'Provider',
			'receiver' => 'Receiver',
			'ExA_id' => 'Ex A',
			'qty' => 'Qty',
			'qtyUnit' => 'Qty Unit',
			'frequency' => 'Frequency',
			'costSupporter' => 'Cost Supporter',
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

		$criteria->compare('Resource_id',$this->Resource_id);
		$criteria->compare('provider',$this->provider);
		$criteria->compare('receiver',$this->receiver);
		$criteria->compare('ExA_id',$this->ExA_id);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('qtyUnit',$this->qtyUnit,true);
		$criteria->compare('frequency',$this->frequency,true);
		$criteria->compare('costSupporter',$this->costSupporter);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}