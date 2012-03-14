<?php

/**
 * This is the model class for table "indiosis.Location".
 *
 * The followings are the available columns in table 'indiosis.Location':
 * @property integer $id
 * @property string $label
 * @property string $street
 * @property string $city
 * @property string $country
 * @property string $lat
 * @property string $lng
 *
 * The followings are the available model relations:
 * @property Company[] $companys
 * @property Resource[] $resources
 */
class Location extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Location the static model class
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
		return 'indiosis.Location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city, country', 'required'),
			array('label, city, country, lat, lng', 'length', 'max'=>255),
			array('street', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, label, street, city, country, lat, lng', 'safe', 'on'=>'search'),
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
			'companys' => array(self::HAS_MANY, 'Company', 'Location_id'),
			'resources' => array(self::HAS_MANY, 'Resource', 'Location_id'),
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
			'street' => 'Street',
			'city' => 'City',
			'country' => 'Country',
			'lat' => 'Lat',
			'lng' => 'Lng',
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
		$criteria->compare('street',$this->street,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('lng',$this->lng,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}