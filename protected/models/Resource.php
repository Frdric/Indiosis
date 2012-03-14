<?php

/**
 * This is the model class for table "indiosis.Resource".
 *
 * The followings are the available columns in table 'indiosis.Resource':
 * @property integer $id
 * @property string $label
 * @property string $flowType
 * @property integer $qty
 * @property string $qtyUnit
 * @property string $frequency
 * @property integer $hideQty
 * @property integer $hideFrequency
 * @property integer $hideLocation
 * @property string $reach
 * @property string $date_added
 * @property integer $Company_id
 * @property string $Code_number
 * @property integer $CustomResource_id
 * @property integer $Location_id
 *
 * The followings are the available model relations:
 * @property Synergyrequest[] $synergyrequests
 * @property Company $company
 * @property Customresource $customResource
 * @property Location $location
 * @property Code $codeNumber
 * @property Stream[] $streams
 */
class Resource extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Resource the static model class
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
		return 'indiosis.Resource';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, flowType, date_added, Company_id', 'required'),
			array('id, qty, hideQty, hideFrequency, hideLocation, Company_id, CustomResource_id, Location_id', 'numerical', 'integerOnly'=>true),
			array('label, reach, Code_number', 'length', 'max'=>255),
			array('flowType', 'length', 'max'=>2),
			array('qtyUnit', 'length', 'max'=>20),
			array('frequency', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, label, flowType, qty, qtyUnit, frequency, hideQty, hideFrequency, hideLocation, reach, date_added, Company_id, Code_number, CustomResource_id, Location_id', 'safe', 'on'=>'search'),
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
			'synergyrequests' => array(self::MANY_MANY, 'Synergyrequest', 'RequestedResource(Resource_id, SynergyRequest_id)'),
			'company' => array(self::BELONGS_TO, 'Company', 'Company_id'),
			'customResource' => array(self::BELONGS_TO, 'Customresource', 'CustomResource_id'),
			'location' => array(self::BELONGS_TO, 'Location', 'Location_id'),
			'codeNumber' => array(self::BELONGS_TO, 'Code', 'Code_number'),
			'streams' => array(self::HAS_MANY, 'Stream', 'Resource_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'label' => 'Label',
			'flowType' => 'Flow Type',
			'qty' => 'Qty',
			'qtyUnit' => 'Qty Unit',
			'frequency' => 'Frequency',
			'hideQty' => 'Hide Qty',
			'hideFrequency' => 'Hide Frequency',
			'hideLocation' => 'Hide Location',
			'reach' => 'Reach',
			'date_added' => 'Date Added',
			'Company_id' => 'Company',
			'Code_number' => 'Code Number',
			'CustomResource_id' => 'Custom Resource',
			'Location_id' => 'Location',
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
		$criteria->compare('label',$this->label,true);
		$criteria->compare('flowType',$this->flowType,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('qtyUnit',$this->qtyUnit,true);
		$criteria->compare('frequency',$this->frequency,true);
		$criteria->compare('hideQty',$this->hideQty);
		$criteria->compare('hideFrequency',$this->hideFrequency);
		$criteria->compare('hideLocation',$this->hideLocation);
		$criteria->compare('reach',$this->reach,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('Company_id',$this->Company_id);
		$criteria->compare('Code_number',$this->Code_number,true);
		$criteria->compare('CustomResource_id',$this->CustomResource_id);
		$criteria->compare('Location_id',$this->Location_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}