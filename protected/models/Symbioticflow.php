<?php

/**
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * MODEL : Symbioticflow 
 * The model class for table "symbioticflow".
 * 
 * The followings are the available columns in table 'symbioticflow':
 * @property integer $Symbiosis_id
 * @property integer $ResourceFlow_id
 *
 * @package     base
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */
 
class Symbioticflow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Symbioticflow the static model class
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
		return 'symbioticflow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Symbiosis_id, ResourceFlow_id', 'required'),
			array('Symbiosis_id, ResourceFlow_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Symbiosis_id, ResourceFlow_id', 'safe', 'on'=>'search'),
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
			'Symbiosis_id' => 'Symbiosis',
			'ResourceFlow_id' => 'Resource Flow',
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

		$criteria->compare('Symbiosis_id',$this->Symbiosis_id);
		$criteria->compare('ResourceFlow_id',$this->ResourceFlow_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}