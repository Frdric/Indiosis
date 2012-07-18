<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $lastName
 * @property string $firstName
 * @property string $prefix
 * @property string $title
 * @property string $bio
 * @property integer $linkedin_id
 * @property string $oauth_token
 * @property string $oauth_secret
 * @property string $last_connected
 * @property string $joined_on
 * @property string $verification_code
 * @property integer $Organization_id
 *
 * The followings are the available model relations:
 * @property CommunicationMean[] $communicationMeans
 * @property Expertise[] $expertises
 * @property Message[] $messages
 * @property Tag[] $tags
 * @property Organization $organization
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
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
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password, joined_on, Organization_id', 'required'),
			array('linkedin_id, Organization_id', 'numerical', 'integerOnly'=>true),
			array('email, lastName, firstName', 'length', 'max'=>45),
			array('password', 'length', 'max'=>32),
			array('prefix', 'length', 'max'=>20),
			array('title', 'length', 'max'=>250),
			array('oauth_token, oauth_secret, verification_code', 'length', 'max'=>100),
			array('bio, last_connected', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, password, lastName, firstName, prefix, title, bio, linkedin_id, oauth_token, oauth_secret, last_connected, joined_on, verification_code, Organization_id', 'safe', 'on'=>'search'),
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
			'expertises' => array(self::HAS_MANY, 'Expertise', 'User_id'),
			'messages' => array(self::MANY_MANY, 'Message', 'MessageRecipient(Recipient_id, Message_id)'),
			'tags' => array(self::HAS_MANY, 'Tag', 'User_id'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'Organization_id'),
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
			'linkedin_id' => 'Linkedin',
			'oauth_token' => 'Oauth Token',
			'oauth_secret' => 'Oauth Secret',
			'last_connected' => 'Last Connected',
			'joined_on' => 'Joined On',
			'verification_code' => 'Verification Code',
			'Organization_id' => 'Organization',
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
		$criteria->compare('linkedin_id',$this->linkedin_id);
		$criteria->compare('oauth_token',$this->oauth_token,true);
		$criteria->compare('oauth_secret',$this->oauth_secret,true);
		$criteria->compare('last_connected',$this->last_connected,true);
		$criteria->compare('joined_on',$this->joined_on,true);
		$criteria->compare('verification_code',$this->verification_code,true);
		$criteria->compare('Organization_id',$this->Organization_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}