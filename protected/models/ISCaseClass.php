<?php

/**
 * This is the model class for table "ISCaseClass".
 *
 * The followings are the available columns in table 'ISCaseClass':
 * @property integer $ISCase_id
 * @property string $ClassCode_number
 * @property string $role
 *
 * The followings are the available model relations:
 * @property ISCase $iSCase
 * @property ClassCode $classCodeNumber
 */
class ISCaseClass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ISCaseClass the static model class
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
		return 'ISCaseClass';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ISCase_id, ClassCode_number, role', 'required'),
			array('ISCase_id', 'numerical', 'integerOnly'=>true),
			array('ClassCode_number', 'length', 'max'=>250),
			array('role', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ISCase_id, ClassCode_number, role', 'safe', 'on'=>'search'),
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
			'iSCase' => array(self::BELONGS_TO, 'ISCase', 'ISCase_id'),
			'classCodeNumber' => array(self::BELONGS_TO, 'ClassCode', 'ClassCode_number'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ISCase_id' => 'Iscase',
			'ClassCode_number' => 'Class Code Number',
			'role' => 'Role',
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

		$criteria->compare('ISCase_id',$this->ISCase_id);
		$criteria->compare('ClassCode_number',$this->ClassCode_number,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}