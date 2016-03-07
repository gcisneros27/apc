<?php

/**
 * This is the model class for table "seguridad.m_menus".
 *
 * The followings are the available columns in table 'seguridad.m_menus':
 * @property integer $id_menu
 * @property string $id_menu_padre
 * @property string $nombre_menu
 * @property integer $orden
 * @property string $icono
 * @property integer $id_usuario_creador
 * @property integer $id_usuario_modificador
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 *
 * The followings are the available model relations:
 * @property MMenus $idMenuPadre
 * @property MMenus[] $mMenuses
 * @property RMenusAuthitem[] $rMenusAuthitems
 */
class MMenus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguridad.m_menus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			array('nombre_menu, orden', 'required', 'on'=>'registro_sub_items'),
			array('id_menu_padre, nombre_menu,icono,color_texto,color_interfaz', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_menu, id_menu_padre, nombre_menu, orden', 'safe', 'on'=>'search'),
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
			'idMenuPadre' => array(self::BELONGS_TO, 'MMenus', 'id_menu_padre'),
			'mMenuses' => array(self::HAS_MANY, 'MMenus', 'id_menu_padre'),
			'rMenusAuthitems' => array(self::HAS_MANY, 'RMenusAuthitem', 'id_menu'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_menu' => 'Id Menu',
			'id_menu_padre' => 'Id Menu Padre',
			'nombre_menu' => 'Nombre Menu',
			'orden' => 'Orden',
			'icono' => 'Icono',
			'id_usuario_creador' => 'Id Usuario Creador',
			'id_usuario_modificador' => 'Id Usuario Modificador',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_modificacion' => 'Fecha Modificacion',
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

		$criteria->compare('id_menu',$this->id_menu);
		$criteria->compare('id_menu_padre',$this->id_menu_padre,true);
		$criteria->compare('nombre_menu',$this->nombre_menu,true);
		$criteria->compare('orden',$this->orden);
		$criteria->compare('icono',$this->icono,true);
		$criteria->compare('id_usuario_creador',$this->id_usuario_creador);
		$criteria->compare('id_usuario_modificador',$this->id_usuario_modificador);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MMenus the static model class
	 */
        public function obtenerArbolAreas($id_dep,$nivel,$conhijos,$jstree,$idDeptoSelected,$disalbled,$icon,$departamento){
		$dep= MMenus::model()->find('id_menu=:id_menu',array(':id_menu'=>$id_dep));
		$arr=array(
				'id' => $dep->id_menu,
				'text' => $dep->nombre_menu,
				'state'       => array(
						'opened'    => ($idDeptoSelected==$dep->id_menu)?true:false,
						'disabled'  => ($disalbled)?true:false ,
						'selected'  => ($idDeptoSelected==$dep->id_menu)?true:false,
				),
				"icon" => $icon,
		);
		$jstree=$this->array_push2($jstree, $arr);
		$hijos=$this->verificarHijos($dep->id_menu);
		$arra2=array();
		if(($hijos)>0){
			$conhijos=true;
			foreach ($hijos as $key=>$value){
				if ($value->id_menu!=$departamento)
					$arra2[]=$this->obtenerArbolAreas($value->id_menu,$nivel+1,$conhijos,array(),$idDeptoSelected,$disalbled,$icon,$departamento);
			}
		}
		if (count($arra2)>0){
			if ($conhijos)
				$jstree=$this->array_push2($jstree, array('children'=>$arra2));
			else
				$jstree=$this->array_push2($jstree, $arra2);
		}
	
		return $jstree;
	}
	
	public function	array_push2($jstree, $arra2){
		if (count($jstree)>0){
			$arraynvo=array();
			$contator=0;
			foreach ($jstree as $key=>$valor){
				$arraynvo[$key]=$valor;
				$contator++;
				if ($contator==count($jstree)){
					foreach ($arra2 as $key2=>$valor2){
						$arraynvo[$key2]=$valor2;
					}
				}
			}
			$jstree=$arraynvo;
		}
		else $jstree=$arra2;
		return $jstree;
	}
        private function verificarHijos($id)
	{
		$hijo = MMenus::model()->findAllByAttributes(array('id_menu_padre'=>$id));
		if(count($hijo)>0){
			return $hijo;
		}
		else return 0;
	}
	
	public function visibleSubir($id,$orden){
		$model=MMenus::model()->find("id_menu_padre=:id_menu_padre ORDER BY orden ASC",array(":id_menu_padre"=>(int)$id));
		if($model){
			if($model->orden !=$orden)
				return TRUE;
		}
		return FALSE;
	}
	public function visibleBajar($id,$orden){
		$model=MMenus::model()->find("id_menu_padre=:id_menu_padre ORDER BY orden DESC",array(":id_menu_padre"=>(int)$id));
		if($model){
			if($model->orden !=$orden)
				return TRUE;
		}
		return FALSE;
	}
        
        
        
        protected function beforeSave() {  //PARA CAMBIAR AL FORMATO QUE ACEPTA POSTGRES ANTES DE GUARDAR
	
	
	
		foreach ($this->getTableSchema()->columns as $column) {
			if ($column->allowNull == 1 && $this->getAttribute($column->name) == '')
				$this->setAttribute($column->name, null);
		}
	
		return parent::beforeSave();
	}
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
