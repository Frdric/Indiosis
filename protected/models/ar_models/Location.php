<?php

/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * AR MODEL : Location *
 * @package     model
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

/**
 * The followings are the available columns in table 'Location':
 * @property integer $id
 * @property string $label
 * @property string $addressLine1
 * @property string $addressLine2
 * @property string $city
 * @property string $zip
 * @property string $state
 * @property string $country
 * @property string $lat
 * @property string $lng
 * @property integer $Organization_id
 * @property integer $ResourceFlow_id
 * @property integer $ISCase_id
 */
class Location extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
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
		return 'Location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label, country', 'required'),
			array('Organization_id, ResourceFlow_id, ISCase_id', 'numerical', 'integerOnly'=>true),
			array('label, city, zip, state, country, lat, lng', 'length', 'max'=>250),
			array('addressLine1, addressLine2', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, label, addressLine1, addressLine2, city, zip, state, country, lat, lng, Organization_id, ResourceFlow_id, ISCase_id', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'label' => 'Label',
			'addressLine1' => 'Address Line1',
			'addressLine2' => 'Address Line2',
			'city' => 'City',
			'zip' => 'Zip',
			'state' => 'State',
			'country' => 'Country',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'Organization_id' => 'Organization',
			'ResourceFlow_id' => 'Resource Flow',
			'ISCase_id' => 'Iscase',
		);
	}


	/**
	 * Retrieves the list of possible values for an ENUM field.
	 * @param string $name The name of an ENUM type attribute.
	 * @return array The list of ENUM options.
	 */
	public function attributeEnumOptions($name)
	{
        preg_match('/\((.*)\)/',$this->tableSchema->columns[$name]->dbType,$matches);
        foreach(explode(',', $matches[1]) as $value)
        {
                $value=str_replace("'",null,$value);
                $values[$value]=Yii::t('enumItem',$value);
        }

        return $values;
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
		$criteria->compare('addressLine1',$this->addressLine1,true);
		$criteria->compare('addressLine2',$this->addressLine2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('Organization_id',$this->Organization_id);
		$criteria->compare('ResourceFlow_id',$this->ResourceFlow_id);
		$criteria->compare('ISCase_id',$this->ISCase_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}