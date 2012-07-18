<?php

/**
 * This is the model class for table "ResourceFlow".
 *
 * The followings are the available columns in table 'ResourceFlow':
 * @property integer $id
 * @property string $label
 * @property integer $qty
 * @property string $qtyUom
 * @property string $frequency
 * @property string $reach
 * @property string $added_on
 * @property integer $hideQty
 * @property integer $hideQtyUom
 * @property integer $hideLocation
 * @property string $ResourceCode_number
 * @property integer $CustomResource_id
 * @property integer $Provider_id
 * @property integer $Receiver_id
 *
 * The followings are the available model relations:
 * @property Location[] $locations
 * @property CustomResource $customResource
 * @property ResourceCode $resourceCodeNumber
 * @property Organization $provider
 * @property Organization $receiver
 * @property Symbiosis[] $symbiosises
 */
class ResourceFlow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResourceFlow the static model class
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
		return 'ResourceFlow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('added_on', 'required'),
			array('qty, hideQty, hideQtyUom, hideLocation, CustomResource_id, Provider_id, Receiver_id', 'numerical', 'integerOnly'=>true),
			array('label', 'length', 'max'=>255),
			array('qtyUom, frequency', 'length', 'max'=>20),
			array('reach, ResourceCode_number', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, label, qty, qtyUom, frequency, reach, added_on, hideQty, hideQtyUom, hideLocation, ResourceCode_number, CustomResource_id, Provider_id, Receiver_id', 'safe', 'on'=>'search'),
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
			'locations' => array(self::HAS_MANY, 'Location', 'ResourceFlow_id'),
			'customResource' => array(self::BELONGS_TO, 'CustomResource', 'CustomResource_id'),
			'resourceCodeNumber' => array(self::BELONGS_TO, 'ResourceCode', 'ResourceCode_number'),
			'provider' => array(self::BELONGS_TO, 'Organization', 'Provider_id'),
			'receiver' => array(self::BELONGS_TO, 'Organization', 'Receiver_id'),
			'symbiosises' => array(self::MANY_MANY, 'Symbiosis', 'SymbioticFlow(ResourceFlow_id, Symbiosis_id)'),
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
			'qty' => 'Qty',
			'qtyUom' => 'Qty Uom',
			'frequency' => 'Frequency',
			'reach' => 'Reach',
			'added_on' => 'Added On',
			'hideQty' => 'Hide Qty',
			'hideQtyUom' => 'Hide Qty Uom',
			'hideLocation' => 'Hide Location',
			'ResourceCode_number' => 'Resource Code Number',
			'CustomResource_id' => 'Custom Resource',
			'Provider_id' => 'Provider',
			'Receiver_id' => 'Receiver',
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
		$criteria->compare('qty',$this->qty);
		$criteria->compare('qtyUom',$this->qtyUom,true);
		$criteria->compare('frequency',$this->frequency,true);
		$criteria->compare('reach',$this->reach,true);
		$criteria->compare('added_on',$this->added_on,true);
		$criteria->compare('hideQty',$this->hideQty);
		$criteria->compare('hideQtyUom',$this->hideQtyUom);
		$criteria->compare('hideLocation',$this->hideLocation);
		$criteria->compare('ResourceCode_number',$this->ResourceCode_number,true);
		$criteria->compare('CustomResource_id',$this->CustomResource_id);
		$criteria->compare('Provider_id',$this->Provider_id);
		$criteria->compare('Receiver_id',$this->Receiver_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}