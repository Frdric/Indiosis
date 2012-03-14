<?php

/**
 * This is the model class for table "indiosis.NewsCodeRelation".
 *
 * The followings are the available columns in table 'indiosis.NewsCodeRelation':
 * @property integer $News_id
 * @property string $Code_number
 */
class NewsCodeRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NewsCodeRelation the static model class
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
		return 'indiosis.NewsCodeRelation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('News_id, Code_number', 'required'),
			array('News_id', 'numerical', 'integerOnly'=>true),
			array('Code_number', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('News_id, Code_number', 'safe', 'on'=>'search'),
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
			'News_id' => 'News',
			'Code_number' => 'Code Number',
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

		$criteria->compare('News_id',$this->News_id);
		$criteria->compare('Code_number',$this->Code_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}