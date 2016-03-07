<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $id_usuario
 * @property string $tx_usuario
 * @property string $tx_contrasena
 * @property string $tx_pregunta_secreta
 * @property string $tx_respuesta_pregunta
 * @property string $tx_cod_activacion
 * @property string $rol_id
 * @property boolean $bo_activado
 * @property boolean $bo_temporal
 * @property boolean $st_usuario
 * @property string $usuario_id_aud
 * @property string $persona_id
 *
 * The followings are the available model relations:
 * @property Rol $rol
 * @property Persona $persona
 * @property UsuarioUnidadProduccion[] $usuarioUnidadProduccions
 */
class Usuario extends CActiveRecord
{
	public $recordarme;
	public $repetirclave;
	public $nueva;
	public $repetirnueva;
	public $_identificacion;
	
	public $cedula;
	public $nacionalidad;
	public $nombre1;
	public $nombre2;
	public $apellido1;	
	public $apellido2;	
	public $correo;
	public $telefono;

	public $rol;
	public $instituciones=array();
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuario the static model class
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
		return 'seguridad.usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			
			array('tx_usuario, tx_contrasena, cedula, nombre1, apellido1, correo,telefono,nacionalidad', 'required', 'on'=>'reg'),
			array('tx_contrasena', 'length','min'=>4, 'on'=>'reg'),
			array('nombre1, apellido1,nombre2, apellido2', 'match', 'pattern'=>'/^([a-zA-ZÁÉÍÓÚáéíóúñÑ\s])+$/', 'message' => 'Este campo puede contener solamente letras', 'on'=>'reg'),
			array('tx_usuario', 'usuarioUnicoAdmin', 'on'=>'reg'),
			array('cedula', 'cedulaUnicoAdmin', 'on'=>'reg'),	
			array('correo', 'correoUnicoAdmin', 'on'=>'reg'),			
			array('bo_activo', 'safe', 'on'=>'reg'),
			array('cedula,telefono', 'numerical', 'integerOnly'=>true, 'on'=>'reg'),
			array('cedula', 'numerical', 'integerOnly'=>true, 'min'=>1, 'on'=>'reg'),
			array('telefono', 'length', 'min'=>11, 'on'=>'reg'),
			array('correo', 'email', 'message' => 'No es un correo valido','on'=>'reg'),

			array('tx_usuario, tx_contrasena', 'required' , 'on'=>'login'),
			array('tx_contrasena', 'autenticar','on'=>'login'),
			array('recordarme', 'safe','on'=>'login'),

			array('tx_contrasena', 'required','message' => 'Debe ingresar una contraseña valida','on'=>'cambio'),
			array('nueva', 'required','message' => 'Debe escribir una contraseña valida','on'=>'cambio'),
			array('repetirnueva', 'required','message' => 'Debe escribir una contraseña valida','on'=>'cambio'),
			array('nueva', 'compare', 'compareAttribute'=>'repetirnueva','message' => 'Las contraseñas nuevas no son iguales', 'on'=>'cambio'),
			array('repetirnueva', 'compare', 'compareAttribute'=>'nueva','message' => 'Las contraseñas nuevas no son iguales', 'on'=>'cambio'),
			array('nueva', 'length','min'=>4,'on'=>'cambio'),
			

			
			array('tx_pregunta_secreta, tx_respuesta_pregunta, tx_cod_activacion, rol_id, bo_activado, bo_temporal, st_usuario, usuario_id_aud, persona_id, correo, telefono,nombre2, apellido2', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_usuario, tx_usuario, tx_contrasena, tx_pregunta_secreta, tx_respuesta_pregunta, tx_cod_activacion, rol_id, bo_activado, bo_temporal, st_usuario, usuario_id_aud, persona_id, banco_id,rol', 'safe', 'on'=>'search'),
		);
	}
	
	public function usuarioUnico($attribute,$params)	{
		if(!$this->hasErrors())	{
			
			if($user = Usuario::model()->find('tx_usuario ILIKE :tx_usuario AND st_usuario=true',array(':tx_usuario'=>$this->tx_usuario))) {
				$this->addError('tx_usuario','Usuario ya esta registrado.');
			}
				
		}
	}
	
	public function usuarioUnicoAdmin($attribute,$params)	{
		if(!$this->hasErrors('tx_usuario'))	{
			if($user = Usuario::model()->find('tx_usuario ILIKE :tx_usuario AND st_usuario=true',array(':tx_usuario'=>$this->tx_usuario))) {
				if($this->isNewRecord) {
					$this->addError('tx_usuario','Usuario ya esta registrado.');
				} else if($user->id_usuario!=$this->id_usuario){
					$this->addError('tx_usuario','Usuario ya esta registrad.');
				}
			}
				
		}
	}
	
	public function cedulaUnicoAdmin($attribute,$params)	{
		if(!$this->hasErrors('cedula'))	{
			if($user = Usuario::model()->with('persona')->find('cedula =:nu_cedula AND st_usuario=true',array(':nu_cedula'=>$this->cedula))) {
				if($this->isNewRecord) {
					$this->addError('cedula','Persona ya posee usuario.');
				} else if($user->id_usuario!=$this->id_usuario){
					$this->addError('cedula','Persona ya posee usuario.');
				}
			}
		}
	}
	
	public function correoUnicoAdmin($attribute,$params)	{
		if(!$this->hasErrors('correo')&&!$this->hasErrors('cedula'))	{
		
			if($user = Usuario::model()->with('persona')->find('correo =:tx_correo AND st_usuario=true ',array(':tx_correo'=>$this->correo))) {
				if($this->isNewRecord) {
					$this->addError('correo','Correo ya esta en uso por otro usuario.');
				} else if($user->persona->cedula!=$this->cedula){
					$this->addError('correo','Correo ya esta en uso por otro usuario.');
				}
			}
		}
	}	
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'rol' => array(self::BELONGS_TO, 'Rol', 'rol_id'),
			'authitems' => array(self::MANY_MANY, 'Authitem', 'seguridad.authassignment(userid, itemname)'),
			'persona' => array(self::BELONGS_TO, 'GenPersona', 'persona_id'),
			//'institucion' => array(self::BELONGS_TO, 'InsInstitucion', 'institucion_id'),
			//'usuarioinstitucions' => array(self::HAS_MANY, 'UsuarioInstitucion', 'usuario_id','condition'=>'st_usuario_institucion=true'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			'tx_usuario' => 'Usuario',
			'tx_contrasena' => 'Contraseña',
			'tx_pregunta_secreta' => 'Pregunta Secreta',
			'tx_respuesta_pregunta' => 'Respuesta de Pregunta Secreta',
			'tx_cod_activacion' => 'Tx Cod Activacion',
			'rol_id' => 'Rol',
			'bo_activado' => 'Activo',
			'bo_temporal' => 'Bo Temporal',
			'st_usuario' => 'St Usuario',
			'usuario_id_aud' => 'Usuario Id Aud',
			'persona_id' => 'Persona',
			'repetirclave' => 'Repetir Contraseña',
			'nueva' => 'Nueva Contraseña',
			'repetirnueva' => 'Repetir Contraseña Nueva',
			'ente_id' => 'Sede',
			'correo' => 'Correo',
			'telefono' => 'Teléfono',
			'nombre1' => 'Primer Nombre',
			'nombre2' => 'Segundo Nombre',
			'apellido1' => 'Primer Apellido',
			'apellido2' => 'Segundo Apellido',
			//'institucion_id' => 'Institución',
			//'instituciones'=>'Acceso a instituciones',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($accion=0)
	{
 
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with=array('authitems');
		$criteria->together=true;

		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('upper(tx_usuario)',mb_strtoupper($this->tx_usuario,'utf-8'),true);
		$criteria->compare('tx_contrasena',$this->tx_contrasena,true);
		
		$criteria->compare('itemname',$this->rol,false);
		
		$criteria->compare('bo_activado',$this->bo_activado);

		$criteria->compare('st_usuario',$this->st_usuario);
		$criteria->compare('usuario_id_aud',$this->usuario_id_aud,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
 			'sort'=>array(
            	'defaultOrder'=>'id_usuario ASC',
        	),			
		));

//		if ($accion==0){
//			$datos_filtrados = new CActiveDataProvider($this, array(
//				'criteria'=>$criteria,
//				'pagination' => array('pageSize' => 10,)
//			));						
//			return $datos_filtrados;
//		}
//		//PARA REPORTES
//		else if ($accion==1){
//			$datos_filtrados = new CActiveDataProvider($this, array(
//				'criteria'=>$criteria,
//				"pagination" => false
//			));		
//				
//			return $datos_filtrados->getData();
//		}
				
	}
	
	public function autenticar($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identificacion=new UserIdentity($this->tx_usuario,$this->tx_contrasena);
			if(!$this->_identificacion->autenticar()) {
				if($this->_identificacion->errorCode==UserIdentity::ERROR_USERNAME_INVALID) {
					$this->addError('tx_usuario','Usuario no existe.');
				} else if($this->_identificacion->errorCode==UserIdentity::ERROR_PASSWORD_INVALID) {
					$this->addError('tx_contrasena','Contraseña invalida.');
				} else if($this->_identificacion->errorCode==3) {
					$this->addError('tx_usuario','Usuario bloqueado.');
				} else if($this->_identificacion->errorCode==4) {
					$this->addError('tx_usuario','El último dígito de su cédula no corresponde con el día de hoy para realizar operaciones en el sistema');
				}
			}
		}
	}
	
	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identificacion===null)
		{
			$this->_identificacion=new UserIdentity($this->tx_usuario,$this->tx_contrasena);
			$this->_identificacion->autenticar();
		}
		if($this->_identificacion->errorCode===UserIdentity::ERROR_NONE)
		{
			$duracion=$this->recordarme ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identificacion,$duracion);
	
			return true;
		}
		else
			return false;
	}
	

	
	protected function beforeValidate() {
		foreach ($this->getTableSchema()->columns as $column) {
			if ($column->allowNull == 1 && $this->getAttribute($column->name) == '')
				$this->setAttribute($column->name, null);
		}
	
		return parent::beforeValidate();
	}
	
	public function rol($id_usuario){
		
		$rol_=AuthAssignment::model()->find("userid=:userid",array(":userid"=>(string)$id_usuario));
		if ($rol_){
			echo $rol_->itemname;
		}
		else {
			echo "No asignado";
		}
	}	
	
}