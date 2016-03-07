<?php

/**
 * This is the model class for table "geo_ubicacion.geo_municipio".
 *
 * The followings are the available columns in table 'geo_ubicacion.geo_municipio':
 * @property integer $geo_municipio_id
 * @property integer $geo_estado_id
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property GeoEstado $geoEstado
 * @property GeoParroquia[] $geoParroquias
 */
class GeoMunicipio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'geo_ubicacion.geo_municipio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('geo_estado_id', 'numerical', 'integerOnly'=>true),
			array('nombre', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('geo_municipio_id, geo_estado_id, nombre', 'safe', 'on'=>'search'),
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
			'geoEstado' => array(self::BELONGS_TO, 'GeoEstado', 'geo_estado_id'),
			'geoParroquias' => array(self::HAS_MANY, 'GeoParroquia', 'geo_municipio_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'geo_municipio_id' => 'Geo Municipio',
			'geo_estado_id' => 'Geo Estado',
			'nombre' => 'Nombre',
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

		$criteria->compare('geo_municipio_id',$this->geo_municipio_id);
		$criteria->compare('geo_estado_id',$this->geo_estado_id);
		$criteria->compare('nombre',$this->nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GeoMunicipio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
