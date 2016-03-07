<?php

/**
 * This is the model class for table "seguridad.t_usuario_sesion".
 *
 * The followings are the available columns in table 'seguridad.t_usuario_sesion':
 * @property integer $id_usuario_sesion
 * @property string $id_usuario
 * @property integer $fecha_inicio
 * @property integer $fecha_fin
 *
 * The followings are the available model relations:
 * @property MUsuarios $idUsuario
 */
class RegistrarOperacion extends CFormModel
{
	public $nombre_controller,$operacion_ruta, $operacion_descripcion, $operacion_chk;
	

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				
			array('operacion_descripcion', 'required', 'on'=>array('inicial')),
			array('operacion_descripcion', 'required', 'on'=>array('seleccionado')),
			array('nombre_controller, operacion_ruta, operacion_descripcion, operacion_chk', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario_sesion, id_usuario, fecha_inicio, fecha_fin', 'safe', 'on'=>'search'),
		);
	}
	public function attributeLabels()
	{
		return array(
				'nombre_controller' => 'nombre_controller',
				'operacion_descripcion' => 'Descripcion de la Operacion',
				);
		}
}
