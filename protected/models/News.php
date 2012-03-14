<?php

/**
 * This is the model class for table "indiosis.News".
 *
 * The followings are the available columns in table 'indiosis.News':
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $date
 * @property string $source
 * @property integer $User_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Code[] $codes
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return News the static model class
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
		return 'indiosis.News';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, body, date, User_id', 'required'),
			array('User_id', 'numerical', 'integerOnly'=>true),
			array('source', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, body, date, source, User_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'User_id'),
			'codes' => array(self::MANY_MANY, 'Code', 'NewsCodeRelation(News_id, Code_number)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'body' => 'Body',
			'date' => 'Date',
			'source' => 'Source',
			'User_id' => 'User',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('User_id',$this->User_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}