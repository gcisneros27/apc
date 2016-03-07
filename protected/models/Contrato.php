<?php

/**
 * This is the model class for table "contrato".
 *
 * The followings are the available columns in table 'contrato':
 * @property integer $id_contrato
 * @property string $id_punto_cuenta
 * @property string $co_contrato
 * @property string $nb_obra
 * @property string $objeto
 * @property string $id_estado
 * @property string $id_municipio
 * @property string $id_parroquia
 * @property string $id_tp_contrato
 * @property string $id_institucion
 * @property string $fecha_suscripcion
 * @property string $fecha_culminacion
 * @property string $monto_total
 * @property string $avance_financiero
 * @property string $avance_fisico
 * @property string $observaciones
 * @property string $id_estatus
 * @property string $nb_constructor
 * @property string $telf_constructor
 * @property string $correo_constructor
 * @property string $nb_inspector
 * @property string $telf_inspector
 * @property string $correo_inspector
 *
 * The followings are the available model relations:
 * @property EstatusContrato $idEstatus
 * @property Institucion $idInstitucion
 * @property PuntoCuenta $idPuntoCuenta
 * @property TipoContrato $idTpContrato
 * @property GeoEstado $idEstado
 * @property GeoMunicipio $idMunicipio
 * @property GeoParroquia $idParroquia
 */
class Contrato extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contrato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('co_contrato,objeto,id_tp_contrato,fecha_suscripcion,fecha_culminacion,id_institucion', 'required'),
			array('co_contrato', 'length', 'max'=>30),
			array('monto_total', 'length', 'max'=>20),
                        array('correo_constructor,correo_inspector', 'email'),
                        array('fecha_suscripcion','compare','compareAttribute'=>'fecha_culminacion','operator'=>'<','message'=>  Yii::t('es', 'La fecha de suscripción del contrato no puede ser mayor a la fecha de culminación del mismo')),
                        array('monto_total,avance_fisico,avance_financiero', 'match',
					'pattern' => '/^[0-9]\d{0,2}(\.[0-9]\d{2,2})*(\,\d{1,2})?$/',
					//'pattern' => '/^[0-9]\d{0,20}(\.[0-9]{0,2})?$/',
					'message' => 'El valor del campo debe tener un formato 1.000,00',
					//'on'=>'create,update',
			),
			array('avance_financiero, avance_fisico', 'length', 'max'=>5),
			array('id_punto_cuenta, nb_obra, objeto, id_estado, id_municipio, id_parroquia, id_tp_contrato, id_institucion, fecha_suscripcion, fecha_culminacion, observaciones, id_estatus, nb_constructor, telf_constructor, correo_constructor, nb_inspector, telf_inspector, correo_inspector', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_contrato, id_punto_cuenta, co_contrato, nb_obra, objeto, id_estado, id_municipio, id_parroquia, id_tp_contrato, id_institucion, fecha_suscripcion, fecha_culminacion, monto_total, avance_financiero, avance_fisico, observaciones, id_estatus, nb_constructor, telf_constructor, correo_constructor, nb_inspector, telf_inspector, correo_inspector', 'safe', 'on'=>'search'),
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
			'idEstatus' => array(self::BELONGS_TO, 'EstatusContrato', 'id_estatus'),
			'idInstitucion' => array(self::BELONGS_TO, 'Institucion', 'id_institucion'),
			'idPuntoCuenta' => array(self::BELONGS_TO, 'PuntoCuenta', 'id_punto_cuenta'),
			'idTpContrato' => array(self::BELONGS_TO, 'TipoContrato', 'id_tp_contrato'),
			'idEstado' => array(self::BELONGS_TO, 'GeoEstado', 'id_estado'),
			'idMunicipio' => array(self::BELONGS_TO, 'GeoMunicipio', 'id_municipio'),
			'idParroquia' => array(self::BELONGS_TO, 'GeoParroquia', 'id_parroquia'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_contrato' => 'Contrato',
			'id_punto_cuenta' => 'Punto Cuenta',
			'co_contrato' => 'Número de Contrato',
			'nb_obra' => 'Nombre de la Obra',
			'objeto' => 'Objeto del Contrato',
			'id_estado' => 'Estado',
			'id_municipio' => 'Municipio',
			'id_parroquia' => 'Parroquia',
			'id_tp_contrato' => 'Tipo de Contrato',
			'id_institucion' => 'Institucion',
			'fecha_suscripcion' => 'Fecha Suscripcion',
			'fecha_culminacion' => 'Fecha Culminacion',
			'monto_total' => 'Monto Total',
			'avance_financiero' => 'Avance Financiero',
			'avance_fisico' => 'Avance Fisico',
			'observaciones' => 'Observaciones',
			'id_estatus' => 'Estatus',
			'nb_constructor' => 'Nombre del Constructor',
			'telf_constructor' => 'Telefono del Constructor',
			'correo_constructor' => 'Correo del Constructor',
			'nb_inspector' => 'Nombre del Inspector',
			'telf_inspector' => 'Telefono del Inspector',
			'correo_inspector' => 'Correo del Inspector',
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

		$criteria->compare('id_contrato',$this->id_contrato);
		$criteria->compare('id_punto_cuenta',$id);
		$criteria->compare('co_contrato',$this->co_contrato,true);
		$criteria->compare('nb_obra',$this->nb_obra,true);
		$criteria->compare('objeto',$this->objeto,true);
		$criteria->compare('id_estado',$this->id_estado);
		$criteria->compare('id_municipio',$this->id_municipio,true);
		$criteria->compare('id_parroquia',$this->id_parroquia,true);
		$criteria->compare('id_tp_contrato',$this->id_tp_contrato,true);
		$criteria->compare('id_institucion',$this->id_institucion,true);
		$criteria->compare('fecha_suscripcion',$this->fecha_suscripcion,true);
		$criteria->compare('fecha_culminacion',$this->fecha_culminacion,true);
                #Monto total
                $this->monto_total=str_replace('.', '', $this->monto_total);
                $this->monto_total=str_replace(',', '.', $this->monto_total);
		$criteria->compare('monto_total',$this->monto_total);
                $this->monto_total=number_format((double)$this->monto_total, 2, ",", ".");
                if($this->monto_total==0.00)$this->monto_total=NULL;
                #
		$criteria->compare('avance_financiero',$this->avance_financiero,true);
		$criteria->compare('avance_fisico',$this->avance_fisico,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('id_estatus',$this->id_estatus,true);
		$criteria->compare('nb_constructor',$this->nb_constructor,true);
		$criteria->compare('telf_constructor',$this->telf_constructor,true);
		$criteria->compare('correo_constructor',$this->correo_constructor,true);
		$criteria->compare('nb_inspector',$this->nb_inspector,true);
		$criteria->compare('telf_inspector',$this->telf_inspector,true);
		$criteria->compare('correo_inspector',$this->correo_inspector,true);
                $criteria->compare('st_contrato',true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function searchG()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_contrato',$this->id_contrato);
		
		$criteria->compare('co_contrato',$this->co_contrato,true);
		$criteria->compare('nb_obra',$this->nb_obra,true);
		$criteria->compare('objeto',$this->objeto,true);
		$criteria->compare('id_estado',$this->id_estado);
		$criteria->compare('id_municipio',$this->id_municipio,true);
		$criteria->compare('id_parroquia',$this->id_parroquia,true);
		$criteria->compare('id_tp_contrato',$this->id_tp_contrato,true);
		$criteria->compare('id_institucion',$this->id_institucion,true);
		$criteria->compare('fecha_suscripcion',$this->fecha_suscripcion,true);
		$criteria->compare('fecha_culminacion',$this->fecha_culminacion,true);
                #Monto total
                $this->monto_total=str_replace('.', '', $this->monto_total);
                $this->monto_total=str_replace(',', '.', $this->monto_total);
		$criteria->compare('monto_total',$this->monto_total);
                $this->monto_total=number_format((double)$this->monto_total, 2, ",", ".");
                if($this->monto_total==0.00)$this->monto_total=NULL;
                #
		$criteria->compare('avance_financiero',$this->avance_financiero,true);
		$criteria->compare('avance_fisico',$this->avance_fisico,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('id_estatus',$this->id_estatus,true);
		$criteria->compare('nb_constructor',$this->nb_constructor,true);
		$criteria->compare('telf_constructor',$this->telf_constructor,true);
		$criteria->compare('correo_constructor',$this->correo_constructor,true);
		$criteria->compare('nb_inspector',$this->nb_inspector,true);
		$criteria->compare('telf_inspector',$this->telf_inspector,true);
		$criteria->compare('correo_inspector',$this->correo_inspector,true);
                $criteria->compare('st_contrato',true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contrato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        /**
         * Validacion de Fechas del Contrato
         */
        public function valFechasContrato($attribute)
         {
            if(!$this->hasErrors('id_tp_prestamo')&&!$this->hasErrors('id_asociado'))
                {
                
                    $modelTpPrestamo=TipoPrestamo::model()->findByPk($this->id_tp_prestamo);
                    $modelAsociado= Asociado::model()->findByPk($this->id_asociado);
                
                    if($modelAsociado->tiempoEnCajaNum('m')<$modelTpPrestamo->tiempo_min)
                              {
                              $this->addError('id_tp_prestamo', 'El Asociado no cumple con la antigüedad minima necesaria para optar a este tipo de prestamo');
                              } 
                    
		  
		}    
         }
        
        
        
        
        /**
         *  BeforeSafe
         *  Se ejecuta antes de guardar
         */
        protected function beforeSave() {
		
            #Monto Total en Bs
            $this->monto_total=str_replace('.', '', $this->monto_total);
            $this->monto_total=str_replace(',', '.', $this->monto_total);
            if($this->monto_total=='')$this->monto_total=NULL;
            #Avance Financiero
            $this->avance_financiero=str_replace('.', '', $this->avance_financiero);
            $this->avance_financiero=str_replace(',', '.', $this->avance_financiero);
            if($this->avance_financiero=='')$this->avance_financiero=NULL;
            #Avance Fisico
            $this->avance_fisico=str_replace('.', '', $this->avance_fisico);
            $this->avance_fisico=str_replace(',', '.', $this->avance_fisico);
            if($this->avance_fisico=='')$this->avance_fisico=NULL;
		return parent::beforeSave();
	}
        
        /**
         *  AfterFind
         *  Se ejecuta despues de buscar
         */
        protected function afterFind() {
		
            #Monto Total en Bs
            $this->monto_total=number_format($this->monto_total, 2, ",", ".");
          
            #Avance Financiero
            $this->avance_financiero=number_format($this->avance_financiero, 2, ",", ".");
            
            #Avance Fisico
           $this->avance_fisico=number_format($this->avance_fisico, 2, ",", ".");
            
		return parent::afterFind();
	}
}
