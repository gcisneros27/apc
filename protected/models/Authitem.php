<?php

/**
 * This is the model class for table "seguridad.authitem".
 *
 * The followings are the available columns in table 'seguridad.authitem':
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 * @property string $usuario_id_aud
 *
 * The followings are the available model relations:
 * @property Authitemchild[] $authitemchildren
 * @property Authitemchild[] $authitemchildren1
 * @property Usuario[] $seguridad.usuarios
 */
class Authitem extends CActiveRecord
{
	public $modulos2, $descripcion_op;
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
			array('name, type', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('description, bizrule, data, usuario_id_aud,modulos2', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, type, description, bizrule, data, usuario_id_aud', 'safe', 'on'=>'search'),
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
			'authitemchildren' => array(self::HAS_MANY, 'Authitemchild', 'child'),
			'authitemchildren1' => array(self::HAS_MANY, 'Authitemchild', 'parent'),
			'seguridad.usuarios' => array(self::MANY_MANY, 'Usuario', 'authassignment(itemname, userid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'type' => 'Type',
			'description' => 'Description',
			'bizrule' => 'Bizrule',
			'data' => 'Data',
			'usuario_id_aud' => 'Usuario Id Aud',
			'modulos2'=>'Modulos del sistema',
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
	public function tipoItem($tipo){
		if ($tipo=='2') echo 'Rol';
		else if ($tipo=='1') echo 'Tarea';
		else if ($tipo=='0') echo 'Operacion';
	}
	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('bizrule',$this->bizrule,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('usuario_id_aud',$this->usuario_id_aud,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Authitem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
