<?php

/**
 * This is the model class for table "estatus_addendum".
 *
 * The followings are the available columns in table 'estatus_addendum':
 * @property integer $id_estatus_addendum
 * @property string $nb_estatus_addendum
 * @property boolean $st_estatus_addendum
 *
 * The followings are the available model relations:
 * @property Addendum[] $addendums
 */
class EstatusAddendum extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'estatus_addendum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nb_estatus_addendum, st_estatus_addendum', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_estatus_addendum, nb_estatus_addendum, st_estatus_addendum', 'safe', 'on'=>'search'),
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
			'addendums' => array(self::HAS_MANY, 'Addendum', 'id_estatus_addendum'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_estatus_addendum' => 'Id Estatus Addendum',
			'nb_estatus_addendum' => 'Nb Estatus Addendum',
			'st_estatus_addendum' => 'St Estatus Addendum',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_estatus_addendum',$this->id_estatus_addendum);
		$criteria->compare('nb_estatus_addendum',$this->nb_estatus_addendum,true);
		$criteria->compare('st_estatus_addendum',$this->st_estatus_addendum);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstatusAddendum the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
