<?php

/**
 * This is the model class for table "ISCase".
 *
 * The followings are the available columns in table 'ISCase':
 * @property integer $id
 * @property string $title
 * @property string $type
 * @property string $description
 * @property string $financial_impact
 * @property string $hr_impact
 * @property string $org_impact
 * @property string $envmnt_impact
 * @property string $contingencies
 * @property string $source
 *
 * The followings are the available model relations:
 * @property ISCaseClass[] $iSCaseClasses
 * @property Location[] $locations
 */
class ISCase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ISCase the static model class
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
		return 'ISCase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('type', 'length', 'max'=>13),
			array('description, financial_impact, hr_impact, org_impact, envmnt_impact, contingencies, source', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, type, description, financial_impact, hr_impact, org_impact, envmnt_impact, contingencies, source', 'safe', 'on'=>'search'),
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
			'iSCaseClasses' => array(self::HAS_MANY, 'ISCaseClass', 'ISCase_id'),
			'locations' => array(self::HAS_MANY, 'Location', 'ISCase_id'),
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
			'type' => 'Type',
			'description' => 'Description',
			'financial_impact' => 'Financial Impact',
			'hr_impact' => 'Hr Impact',
			'org_impact' => 'Org Impact',
			'envmnt_impact' => 'Envmnt Impact',
			'contingencies' => 'Contingencies',
			'source' => 'Source',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('financial_impact',$this->financial_impact,true);
		$criteria->compare('hr_impact',$this->hr_impact,true);
		$criteria->compare('org_impact',$this->org_impact,true);
		$criteria->compare('envmnt_impact',$this->envmnt_impact,true);
		$criteria->compare('contingencies',$this->contingencies,true);
		$criteria->compare('source',$this->source,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}