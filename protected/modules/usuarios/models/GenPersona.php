<?php

/**
 * This is the model class for table "gen_persona".
 *
 * The followings are the available columns in table 'gen_persona':
 * @property string $id_persona
 * @property string $nacionalidad
 * @property integer $cedula
 * @property string $nombre1
 * @property string $nombre2
 * @property string $apellido1
 * @property string $apellido2
 * @property string $fecha_nacimiento
 * @property string $sexo
 * @property string $telefono
 * @property string $telefono2
 * @property string $telefono3
 * @property string $correo
 * @property integer $pais_id
 * @property integer $estado_civil_id
 * @property integer $profesion_id
 * @property string $usuario_id_aud
 *
 * The followings are the available model relations:
 * @property EveEmpresaServicio[] $eveEmpresaServicios
 * @property GenEstadoCivil $estadoCivil
 * @property GenPais $pais
 * @property GenProfesion $profesion
 * @property AseMiembroFamilia[] $aseMiembroFamilias
 */
class GenPersona extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GenPersona the static model class
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
		return 'persona';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cedula', 'numerical', 'integerOnly'=>true),
			array('nacionalidad', 'length', 'max'=>1),
			array('nombre1, nombre2, apellido1, apellido2, fecha_nacimiento, telefono,  correo, usuario_id_aud', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_persona, nacionalidad, cedula, nombre1, nombre2, apellido1, apellido2, fecha_nacimiento, sexo, telefono, correo,   usuario_id_aud', 'safe', 'on'=>'search'),
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
			//'eveEmpresaServicios' => array(self::HAS_MANY, 'EveEmpresaServicio', 'persona_id'),
			//'estadoCivil' => array(self::BELONGS_TO, 'GenEstadoCivil', 'estado_civil_id'),
			//'pais' => array(self::BELONGS_TO, 'GenPais', 'pais_id'),
			//'profesion' => array(self::BELONGS_TO, 'GenProfesion', 'profesion_id'),
			//'aseMiembroFamilias' => array(self::HAS_MANY, 'AseMiembroFamilia', 'persona_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_persona' => 'Id Persona',
			'nacionalidad' => 'Per Nacionalidad',
			'cedula' => 'Per Cedula',
			'nombre1' => 'Per Nombre1',
			'nombre2' => 'Per Nombre2',
			'apellido1' => 'Per Apellido1',
			'apellido2' => 'Per Apellido2',
			'fecha_nacimiento' => 'Per Fecha Nacimiento',
			'sexo' => 'Per Sexo',
			'telefono' => 'Telefono',
			'correo' => 'Per Correo',
			//'pais_id' => 'Pais',
			'estado_civil_id' => 'Estado Civil',
			'profesion_id' => 'Profesion',
			'usuario_id_aud' => 'Usuario Id Aud',
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

		$criteria->compare('id_persona',$this->id_persona,true);
		$criteria->compare('nacionalidad',$this->nacionalidad,true);
		$criteria->compare('cedula',$this->cedula);
		$criteria->compare('nombre1',$this->nombre1,true);
		$criteria->compare('nombre2',$this->nombre2,true);
		$criteria->compare('apellido1',$this->apellido1,true);
		$criteria->compare('apellido2',$this->apellido2,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		///$criteria->compare('sexo',$this->sexo,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('correo',$this->correo,true);
		//$criteria->compare('pais_id',$this->pais_id);
		//$criteria->compare('estado_civil_id',$this->estado_civil_id);
		//$criteria->compare('profesion_id',$this->profesion_id);
		$criteria->compare('usuario_id_aud',$this->usuario_id_aud,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}