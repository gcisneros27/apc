<?php

/**
 * This is the model class for table "funcionario".
 *
 * The followings are the available columns in table 'funcionario':
 * @property integer $id_funcionario
 * @property string $nb_funcionario
 * @property string $cargo_funcionario
 * @property boolean $st_funcionario
 *
 * The followings are the available model relations:
 * @property PuntoCuenta[] $puntoCuentas
 */
class Funcionario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'funcionario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nb_funcionario', 'required'),
			array('cargo_funcionario, st_funcionario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_funcionario, nb_funcionario, cargo_funcionario, st_funcionario', 'safe', 'on'=>'search'),
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
			'puntoCuentas' => array(self::HAS_MANY, 'PuntoCuenta', 'id_funcionario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_funcionario' => 'Id Funcionario',
			'nb_funcionario' => 'Nb Funcionario',
			'cargo_funcionario' => 'Cargo Funcionario',
			'st_funcionario' => 'St Funcionario',
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

		$criteria->compare('id_funcionario',$this->id_funcionario);
		$criteria->compare('nb_funcionario',$this->nb_funcionario,true);
		$criteria->compare('cargo_funcionario',$this->cargo_funcionario,true);
		$criteria->compare('st_funcionario',$this->st_funcionario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Funcionario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
