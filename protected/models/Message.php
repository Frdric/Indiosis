<?php

/**
 * This is the model class for table "indiosis.Message".
 *
 * The followings are the available columns in table 'indiosis.Message':
 * @property integer $id
 * @property integer $sender
 * @property integer $recipient
 * @property string $title
 * @property string $body
 * @property string $date_sent
 * @property integer $read
 * @property integer $Synergy_id
 *
 * The followings are the available model relations:
 * @property User $sender0
 * @property User $recipient0
 * @property Synergy $synergy
 */
class Message extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Message the static model class
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
		return 'indiosis.Message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender, date_sent', 'required'),
			array('sender, recipient, read, Synergy_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('body', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sender, recipient, title, body, date_sent, read, Synergy_id', 'safe', 'on'=>'search'),
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
			'sender0' => array(self::BELONGS_TO, 'User', 'sender'),
			'recipient0' => array(self::BELONGS_TO, 'User', 'recipient'),
			'synergy' => array(self::BELONGS_TO, 'Synergy', 'Synergy_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sender' => 'Sender',
			'recipient' => 'Recipient',
			'title' => 'Title',
			'body' => 'Body',
			'date_sent' => 'Date Sent',
			'read' => 'Read',
			'Synergy_id' => 'Synergy',
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
		$criteria->compare('sender',$this->sender);
		$criteria->compare('recipient',$this->recipient);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('date_sent',$this->date_sent,true);
		$criteria->compare('read',$this->read);
		$criteria->compare('Synergy_id',$this->Synergy_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}