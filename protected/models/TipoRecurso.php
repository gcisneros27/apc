<?php

/**
 * This is the model class for table "tipo_recurso".
 *
 * The followings are the available columns in table 'tipo_recurso':
 * @property integer $id_tp_recurso
 * @property string $nb_tp_recurso
 * @property boolean $st_tp_recurso
 *
 * The followings are the available model relations:
 * @property PuntoCuenta[] $puntoCuentas
 */
class TipoRecurso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_recurso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nb_tp_recurso, st_tp_recurso', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tp_recurso, nb_tp_recurso, st_tp_recurso', 'safe', 'on'=>'search'),
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
			'puntoCuentas' => array(self::HAS_MANY, 'PuntoCuenta', 'id_tp_recurso'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tp_recurso' => 'Id Tp Recurso',
			'nb_tp_recurso' => 'Nb Tp Recurso',
			'st_tp_recurso' => 'St Tp Recurso',
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

		$criteria->compare('id_tp_recurso',$this->id_tp_recurso);
		$criteria->compare('nb_tp_recurso',$this->nb_tp_recurso,true);
		$criteria->compare('st_tp_recurso',$this->st_tp_recurso);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoRecurso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
