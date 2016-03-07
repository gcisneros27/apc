<?php

/**
 * This is the model class for table "usu_usuario".
 *
 * The followings are the available columns in table 'usu_usuario':
 * @property integer $usuario_id
 * @property string $nb_usuario
 * @property string $contrasena
 * @property string $persona_id
 * @property boolean $st_usuario
 *
 * The followings are the available model relations:
 * @property AudAuditoria[] $audAuditorias
 * @property UsuRol[] $usuRols
 * @property PerPersona $persona
 */
class UsuUsuario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UsuUsuario the static model class
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
		return 'seguridad.usu_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nb_usuario, contrasena', 'required'),
			array('persona_id, st_usuario', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('usuario_id, nb_usuario, contrasena, persona_id, st_usuario', 'safe', 'on'=>'search'),
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
			//'audAuditorias' => array(self::HAS_MANY, 'AudAuditoria', 'usuario_id'),
			//'usuRols' => array(self::MANY_MANY, 'UsuRol', 'usu_usuario_rol(usuario_id, rol_id)'),
			'authitems' => array(self::MANY_MANY, 'Authitem', 'seguridad.authassignment(userid, itemname)'),
			'persona' => array(self::BELONGS_TO, 'GenPersona', 'persona_id'),
			'institucion' => array(self::BELONGS_TO, 'InsInstitucion', 'institucion_id'),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usuario_id' => 'Usuario',
			'nb_usuario' => 'Nb Usuario',
			'contrasena' => 'Contrasena',
			'persona_id' => 'Persona',
			'st_usuario' => 'St Usuario',
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

		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('nb_usuario',$this->nb_usuario,true);
		$criteria->compare('contrasena',$this->contrasena,true);
		$criteria->compare('persona_id',$this->persona_id,true);
		$criteria->compare('st_usuario',$this->st_usuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}