<?php

/**
 * This is the model class for table "indiosis.Company".
 *
 * The followings are the available columns in table 'indiosis.Company':
 * @property integer $id
 * @property string $name
 * @property string $acronym
 * @property string $description
 * @property integer $anonymous
 * @property integer $linkedId_id
 * @property string $date_created
 * @property integer $verified
 * @property integer $CompanyType_id
 * @property integer $Location_id
 *
 * The followings are the available model relations:
 * @property CommunicationMean[] $communicationMeans
 * @property Companytype $companyType
 * @property Location $location
 * @property Synergyrequest[] $synergyrequests
 * @property Resource[] $resources
 * @property Stream[] $streams
 * @property Stream[] $streams1
 * @property Stream[] $streams2
 * @property SynergyRequest[] $synergyRequests
 * @property User[] $users
 */
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Company the static model class
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
		return 'indiosis.Company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, date_created', 'required'),
			array('anonymous, linkedId_id, verified, CompanyType_id, Location_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('acronym', 'length', 'max'=>10),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, acronym, description, anonymous, linkedId_id, date_created, verified, CompanyType_id, Location_id', 'safe', 'on'=>'search'),
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
			'communicationMeans' => array(self::HAS_MANY, 'CommunicationMean', 'Company_id'),
			'companyType' => array(self::BELONGS_TO, 'Companytype', 'CompanyType_id'),
			'location' => array(self::BELONGS_TO, 'Location', 'Location_id'),
			'synergyrequests' => array(self::MANY_MANY, 'Synergyrequest', 'RequestedCompany(Company_id, SynergyRequest_id)'),
			'resources' => array(self::HAS_MANY, 'Resource', 'Company_id'),
			'streams' => array(self::HAS_MANY, 'Stream', 'provider'),
			'streams1' => array(self::HAS_MANY, 'Stream', 'receiver'),
			'streams2' => array(self::HAS_MANY, 'Stream', 'costSupporter'),
			'synergyRequests' => array(self::HAS_MANY, 'SynergyRequest', 'initiator'),
			'users' => array(self::HAS_MANY, 'User', 'Company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'acronym' => 'Acronym',
			'description' => 'Description',
			'anonymous' => 'Anonymous',
			'linkedId_id' => 'Linked Id',
			'date_created' => 'Date Created',
			'verified' => 'Verified',
			'CompanyType_id' => 'Company Type',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('acronym',$this->acronym,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('anonymous',$this->anonymous);
		$criteria->compare('linkedId_id',$this->linkedId_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('verified',$this->verified);
		$criteria->compare('CompanyType_id',$this->CompanyType_id);
		$criteria->compare('Location_id',$this->Location_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}