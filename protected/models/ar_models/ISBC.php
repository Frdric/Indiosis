<?php

/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * AR MODEL : ISBC *
 * @package     model
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

/**
 * The followings are the available columns in table 'ISBC':
 * @property integer $id
 * @property string $title
 * @property string $type
 * @property string $overview
 * @property string $time_period
 * @property string $eco_drivers
 * @property string $eco_barriers
 * @property string $tech_drivers
 * @property string $tech_barriers
 * @property string $regul_drivers
 * @property string $regul_barriers
 * @property string $socioenv_benefits
 * @property string $contingencies
 * @property string $source
 * @property string $added_on
 * @property integer $added_by
 */
class ISBC extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ISBC the static model class
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
		return 'ISBC';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, type, added_on', 'required'),
			array('added_by', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>8),
			array('time_period', 'length', 'max'=>45),
			array('overview, eco_drivers, eco_barriers, tech_drivers, tech_barriers, regul_drivers, regul_barriers, socioenv_benefits, contingencies, source', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, type, overview, time_period, eco_drivers, eco_barriers, tech_drivers, tech_barriers, regul_drivers, regul_barriers, socioenv_benefits, contingencies, source, added_on, added_by', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'title' => 'Title',
			'type' => 'Type',
			'overview' => 'Overview',
			'time_period' => 'Time Period',
			'eco_drivers' => 'Eco Drivers',
			'eco_barriers' => 'Eco Barriers',
			'tech_drivers' => 'Tech Drivers',
			'tech_barriers' => 'Tech Barriers',
			'regul_drivers' => 'Regul Drivers',
			'regul_barriers' => 'Regul Barriers',
			'socioenv_benefits' => 'Socioenv Benefits',
			'contingencies' => 'Contingencies',
			'source' => 'Source',
			'added_on' => 'Added On',
			'added_by' => 'Added By',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('overview',$this->overview,true);
		$criteria->compare('time_period',$this->time_period,true);
		$criteria->compare('eco_drivers',$this->eco_drivers,true);
		$criteria->compare('eco_barriers',$this->eco_barriers,true);
		$criteria->compare('tech_drivers',$this->tech_drivers,true);
		$criteria->compare('tech_barriers',$this->tech_barriers,true);
		$criteria->compare('regul_drivers',$this->regul_drivers,true);
		$criteria->compare('regul_barriers',$this->regul_barriers,true);
		$criteria->compare('socioenv_benefits',$this->socioenv_benefits,true);
		$criteria->compare('contingencies',$this->contingencies,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('added_on',$this->added_on,true);
		$criteria->compare('added_by',$this->added_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}