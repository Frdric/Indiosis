<?php

/**
 * This is the model class for table "Organization".
 *
 * The followings are the available columns in table 'Organization':
 * @property integer $id
 * @property string $acronym
 * @property string $name
 * @property string $type
 * @property string $industry
 * @property string $description
 * @property integer $linkedin_id
 * @property integer $verified
 * @property integer $anonymous
 * @property string $created_on
 *
 * The followings are the available model relations:
 * @property Affiliation[] $affiliations
 * @property Affiliation[] $affiliations1
 * @property CommunicationMean[] $communicationMeans
 * @property Expertise[] $expertises
 * @property Location[] $locations
 * @property ResourceFlow[] $resourceFlows
 * @property ResourceFlow[] $resourceFlows1
 * @property Symbiosis[] $symbiosises
 * @property Tag[] $tags
 * @property User[] $users
 */
class Organization extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Organization the static model class
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
		return 'Organization';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, created_on', 'required'),
			array('linkedin_id, verified, anonymous', 'numerical', 'integerOnly'=>true),
			array('acronym', 'length', 'max'=>10),
			array('name, industry', 'length', 'max'=>250),
			array('type', 'length', 'max'=>11),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, acronym, name, type, industry, description, linkedin_id, verified, anonymous, created_on', 'safe', 'on'=>'search'),
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
			'affiliations' => array(self::HAS_MANY, 'Affiliation', 'Parent_id'),
			'affiliations1' => array(self::HAS_MANY, 'Affiliation', 'Child_id'),
			'communicationMeans' => array(self::HAS_MANY, 'CommunicationMean', 'Organization_id'),
			'expertises' => array(self::HAS_MANY, 'Expertise', 'Organization_id'),
			'locations' => array(self::HAS_MANY, 'Location', 'Organization_id'),
			'resourceFlows' => array(self::HAS_MANY, 'ResourceFlow', 'Provider_id'),
			'resourceFlows1' => array(self::HAS_MANY, 'ResourceFlow', 'Receiver_id'),
			'symbiosises' => array(self::MANY_MANY, 'Symbiosis', 'SymbioticOrganization(Organization_id, Symbiosis_id)'),
			'tags' => array(self::HAS_MANY, 'Tag', 'Organization_id'),
			'users' => array(self::HAS_MANY, 'User', 'Organization_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'acronym' => 'Acronym',
			'name' => 'Name',
			'type' => 'Type',
			'industry' => 'Industry',
			'description' => 'Description',
			'linkedin_id' => 'Linkedin',
			'verified' => 'Verified',
			'anonymous' => 'Anonymous',
			'created_on' => 'Created On',
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
		$criteria->compare('acronym',$this->acronym,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('industry',$this->industry,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('linkedin_id',$this->linkedin_id);
		$criteria->compare('verified',$this->verified);
		$criteria->compare('anonymous',$this->anonymous);
		$criteria->compare('created_on',$this->created_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}