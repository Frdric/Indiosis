<?php

/**
 * This is the model class for table "indiosis.User".
 *
 * The followings are the available columns in table 'indiosis.User':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $lastName
 * @property string $firstName
 * @property string $prefix
 * @property string $title
 * @property string $bio
 * @property integer $isExpert
 * @property string $linkedIn_id
 * @property string $date_joined
 * @property string $last_connected
 * @property string $confirmationCode
 * @property integer $verified
 * @property integer $Company_id
 *
 * The followings are the available model relations:
 * @property CommunicationMean[] $communicationMeans
 * @property Message[] $messages
 * @property Message[] $messages1
 * @property News[] $news
 * @property Company $company
 * @property Code[] $codes
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'indiosis.User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_joined', 'required'),
			array('isExpert, verified, Company_id', 'numerical', 'integerOnly'=>true),
			array('email, password, lastName, firstName, prefix, title, bio', 'length', 'max'=>45),
			array('linkedIn_id, confirmationCode', 'length', 'max'=>255),
			array('last_connected', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, password, lastName, firstName, prefix, title, bio, isExpert, linkedIn_id, date_joined, last_connected, confirmationCode, verified, Company_id', 'safe', 'on'=>'search'),
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
			'communicationMeans' => array(self::HAS_MANY, 'CommunicationMean', 'User_id'),
			'messages' => array(self::HAS_MANY, 'Message', 'sender'),
			'messages1' => array(self::HAS_MANY, 'Message', 'recipient'),
			'news' => array(self::HAS_MANY, 'News', 'User_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'Company_id'),
			'codes' => array(self::MANY_MANY, 'Code', 'UserExpertise(User_id, Code_number)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'lastName' => 'Last Name',
			'firstName' => 'First Name',
			'prefix' => 'Prefix',
			'title' => 'Title',
			'bio' => 'Bio',
			'isExpert' => 'Is Expert',
			'linkedIn_id' => 'Linked In',
			'date_joined' => 'Date Joined',
			'last_connected' => 'Last Connected',
			'confirmationCode' => 'Confirmation Code',
			'verified' => 'Verified',
			'Company_id' => 'Company',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('bio',$this->bio,true);
		$criteria->compare('isExpert',$this->isExpert);
		$criteria->compare('linkedIn_id',$this->linkedIn_id,true);
		$criteria->compare('date_joined',$this->date_joined,true);
		$criteria->compare('last_connected',$this->last_connected,true);
		$criteria->compare('confirmationCode',$this->confirmationCode,true);
		$criteria->compare('verified',$this->verified);
		$criteria->compare('Company_id',$this->Company_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}