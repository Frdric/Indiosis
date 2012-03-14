<?php

/**
 * This is the model class for table "indiosis.CommunicationMean".
 *
 * The followings are the available columns in table 'indiosis.CommunicationMean':
 * @property integer $id
 * @property string $value
 * @property string $label
 * @property integer $MeanType_id
 * @property integer $Company_id
 * @property integer $User_id
 *
 * The followings are the available model relations:
 * @property Meantype $meanType
 * @property Company $company
 * @property User $user
 */
class CommunicationMean extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CommunicationMean the static model class
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
		return 'indiosis.CommunicationMean';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value, MeanType_id', 'required'),
			array('MeanType_id, Company_id, User_id', 'numerical', 'integerOnly'=>true),
			array('value, label', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, value, label, MeanType_id, Company_id, User_id', 'safe', 'on'=>'search'),
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
			'meanType' => array(self::BELONGS_TO, 'Meantype', 'MeanType_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'Company_id'),
			'user' => array(self::BELONGS_TO, 'User', 'User_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value' => 'Value',
			'label' => 'Label',
			'MeanType_id' => 'Mean Type',
			'Company_id' => 'Company',
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
		$criteria->compare('value',$this->value,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('MeanType_id',$this->MeanType_id);
		$criteria->compare('Company_id',$this->Company_id);
		$criteria->compare('User_id',$this->User_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}