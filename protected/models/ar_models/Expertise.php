<?php

/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * AR MODEL : Expertise *
 * @package     model
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

/**
 * The followings are the available columns in table 'Expertise':
 * @property string $ResourceCode_number
 * @property integer $Organization_id
 * @property integer $User_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property ClassCode $resourceCodeNumber
 * @property Organization $organization
 */
class Expertise extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Expertise the static model class
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
		return 'Expertise';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ResourceCode_number', 'required'),
			array('Organization_id, User_id', 'numerical', 'integerOnly'=>true),
			array('ResourceCode_number', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ResourceCode_number, Organization_id, User_id', 'safe', 'on'=>'search'),
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
			'resourceCodeNumber' => array(self::BELONGS_TO, 'ClassCode', 'ResourceCode_number'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'Organization_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ResourceCode_number' => 'Resource Code Number',
			'Organization_id' => 'Organization',
			'User_id' => 'User',
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

		$criteria->compare('ResourceCode_number',$this->ResourceCode_number,true);
		$criteria->compare('Organization_id',$this->Organization_id);
		$criteria->compare('User_id',$this->User_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}