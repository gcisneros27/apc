<?php

/**
 * This is the model class for table "seguridad.r_menus_authitem".
 *
 * The followings are the available columns in table 'seguridad.r_menus_authitem':
 * @property integer $id_item_authitem
 * @property string $id_menu
 * @property integer $orden
 * @property string $nombre_item
 * @property string $operacion
 * @property string $fecha_creacion
 * @property string $fecha_expiracion
 * @property boolean $estatus_usuario_activo
 * @property string $id_usuario_creador
 * @property string $id_usuario_modificador
 * @property string $ruta_imagen
 *
 * The followings are the available model relations:
 * @property MMenus $idMenu
 */
class RMenusAuthitem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguridad.r_menus_authitem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orden', 'numerical', 'integerOnly'=>true),
			array('id_menu, nombre_item, operacion, fecha_creacion, fecha_expiracion, estatus_usuario_activo, id_usuario_creador, id_usuario_modificador, ruta_imagen', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_item_authitem, id_menu, orden, nombre_item, operacion, fecha_creacion, fecha_expiracion, estatus_usuario_activo, id_usuario_creador, id_usuario_modificador, ruta_imagen', 'safe', 'on'=>'search'),
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
			'idMenu' => array(self::BELONGS_TO, 'MMenus', 'id_menu'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_item_authitem' => 'Id Item Authitem',
			'id_menu' => 'Id Menu',
			'orden' => 'Orden',
			'nombre_item' => 'Nombre Item',
			'operacion' => 'Operacion',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_expiracion' => 'Fecha Expiracion',
			'estatus_usuario_activo' => 'Estatus Usuario Activo',
			'id_usuario_creador' => 'Id Usuario Creador',
			'id_usuario_modificador' => 'Id Usuario Modificador',
			'ruta_imagen' => 'Ruta Imagen',
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
	public function search($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_item_authitem',$this->id_item_authitem);
		$criteria->compare('id_menu',$id);
		$criteria->compare('orden',$this->orden);
		$criteria->compare('nombre_item',$this->nombre_item,true);
		$criteria->compare('operacion',$this->operacion,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_expiracion',$this->fecha_expiracion,true);
		$criteria->compare('estatus_usuario_activo',$this->estatus_usuario_activo);
		$criteria->compare('id_usuario_creador',$this->id_usuario_creador,true);
		$criteria->compare('id_usuario_modificador',$this->id_usuario_modificador,true);
		$criteria->compare('ruta_imagen',$this->ruta_imagen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RMenusAuthitem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
