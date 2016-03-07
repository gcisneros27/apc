<?php

/**
 * This is the model class for table "AuthItem".
 *
 * The followings are the available columns in table 'AuthItem':
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 *
 * The followings are the available model relations:
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren1
 * @property AuthAssignment[] $authAssignments
 */
class AuthItem extends CActiveRecord
{
	public $modulos2;
	public $descripcion_op;
	/**
	 * Returns the static model of the specified AR class.
	 * @return AuthItem the static model class
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
		return 'seguridad.authitem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'filter', 'filter'=>'trim'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('name', 'unique'),
			array('description, bizrule, data', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, type, description, bizrule, data', 'safe', 'on'=>'search'),
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
			'authItemChildren' => array(self::HAS_MANY, 'AuthItemChild', 'parent'),
			'authItemChildren1' => array(self::HAS_MANY, 'AuthItemChild', 'child'),
			'authAssignments' => array(self::HAS_MANY, 'AuthAssignment', 'itemname'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Nombre',
			'type' => 'Tipo',
			'description' => 'Descripción',
			'bizrule' => 'Bizrule',
			'data' => 'Data',
			'modulos2'=>'Modulos del sistema',
			'descripcion_op'=>'Descripción de la operación'
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

		$criteria->compare('LOWER(name)',strtolower($this->name),true);
		$criteria->compare('type',$this->type);
		$criteria->compare('LOWER(description)',strtolower($this->description),true);
		$criteria->compare('bizrule',$this->bizrule,true);
		$criteria->compare('data',$this->data,true);
		$criteria->addCondition('name != \'authenticated\' and name != \'guest\'');
		$criteria->order='type DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function tipoItem($tipo){
		if ($tipo=='2') echo 'Rol';
		else if ($tipo=='1') echo 'Tarea';
		else if ($tipo=='0') echo 'Operacion';
	}
	
	public function tipoItemR($tipo){
		if ($tipo=='2') return  'Rol';
		else if ($tipo=='1') return  'Tarea';
		else if ($tipo=='0') return  'Operacion';
	}	
	
	public function buscarOperaciones($rol){
		//BUSCA OPERACIONES DE UN ROL ASOCIADAS DIRECTAMENTE O MEDIANTE UNA TAREA
		$connection=Yii::app()->db;
		$sql="	
		select aic.child from authitemchild aic join authitem as ai on ai.name=aic.parent join authitem as ai2 on ai2.name=aic.child 
		where ai2.type = 0 and 
		aic.parent in (
		select aic.child from authitemchild aic join authitem as ai on ai.name=aic.parent join authitem as ai2 on ai2.name=aic.child where ai2.type = 1 and aic.parent = '".$rol."'
		)
		UNION
		select aic.child from authitemchild aic join authitem as ai on ai.name=aic.parent join authitem as ai2 on ai2.name=aic.child where ai2.type = 0 and aic.parent = '".$rol."'	
		";
		$command=$connection->createCommand($sql);
		$operacionesChild=$command->queryAll();
		return $operacionesChild;
	}
	
	public function buscarRol($rol){
		//BUSCA ROLES ASOCIADOS A UN ROL
		$connection=Yii::app()->db;
		$sql="select * from \"authitemchild\" aic join \"authitem\" as ai on ai.\"name\"=aic.parent join \"authitem\" as ai2 on ai2.\"name\"=aic.child where ai2.type = 2 and aic.parent = '".$rol."'";
		$command=$connection->createCommand($sql);
		$rolesChild=$command->queryAll();
		return $rolesChild;
	}	
	
	public function validarOperaciones($operaciones){
		$operacionesValidas=true;
		foreach ($operaciones as $a=>$operacion) {
			if (!Yii::app()->user->checkAccess($operacion['child'])){
				$operacionesValidas=false;
				break;
			}
		}
		return $operacionesValidas;
	}
	
	public function validarRol(){
		$lista_roles_permitidos=array();
		//$lista_roles_no_permitidos=array();
		$lista_roles=AuthItem::model()->findAll('type=:tipo AND name!=:name1 AND name!=:name2 order by "name"',array(':tipo'=>2,':name1'=>'guest',':name2'=>'authenticated'));
		if (count($lista_roles)!=0){
			foreach ($lista_roles as $rol) {
				$lista_operaciones=array();
				$roles_child=$this->buscarRol($rol->name);
				foreach ($roles_child as $rol_child) {
					$lista_operaciones=array_merge($lista_operaciones,$this->buscarOperaciones($rol_child['name']));
				}
				$lista_operaciones=array_merge($lista_operaciones,$this->buscarOperaciones($rol->name));
				if ($this->validarOperaciones($lista_operaciones)){
					$lista_roles_permitidos[$rol->name]=$rol->name;
				}//else $lista_roles_no_permitidos[]=$rol->name;
			}
		}
		return $lista_roles_permitidos;
	}
	
}