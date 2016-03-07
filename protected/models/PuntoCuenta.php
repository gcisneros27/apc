<?php

/**
 * This is the model class for table "punto_cuenta".
 *
 * The followings are the available columns in table 'punto_cuenta':
 * @property integer $id_punto_cuenta
 * @property string $id_punto_padre
 * @property string $co_punto_cuenta
 * @property boolean $presidencial
 * @property string $monto_bs
 * @property string $monto_disp_bs
 * @property string $monto_dv
 * @property string $monto_disp_dv
 * @property string $id_tp_moneda
 * @property string $id_tp_recurso
 * @property string $asunto
 * @property string $descripcion
 * @property string $presentado
 * @property string $id_funcionario
 * @property string $fecha_aprobacion
 *
 * The followings are the available model relations:
 * @property PuntoCuenta $idPuntoPadre
 * @property PuntoCuenta[] $puntoCuentas
 * @property Moneda $idTpMoneda
 * @property TipoRecurso $idTpRecurso
 * @property Funcionario $idFuncionariofecha_vigencia
 */
class PuntoCuenta extends CActiveRecord
{
    
    public $fe_aprobacion_range = array();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'punto_cuenta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('co_punto_cuenta, presidencial, monto_bs,asunto,descripcion,fecha_aprobacion,id_funcionario', 'required'),
			array('monto_bs, monto_disp_bs', 'length', 'max'=>20),
			array('monto_dv, monto_disp_dv', 'length', 'max'=>15),
                        array('monto_bs,monto_disp_bs,monto_dv,monto_disp_dv', 'match',
					'pattern' => '/^[0-9]\d{0,2}(\.[0-9]\d{2,2})*(\,\d{1,2})?$/',
					//'pattern' => '/^[0-9]\d{0,20}(\.[0-9]{0,2})?$/',
					'message' => 'El valor del campo debe tener un formato 1.000,00',
					//'on'=>'create,update',
			),
			array('id_punto_padre, id_tp_moneda, id_tp_recurso, asunto, descripcion, presentado, id_funcionario, fecha_aprobacion,fe_aprobacion_range', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_punto_cuenta, id_punto_padre, co_punto_cuenta, presidencial, monto_bs, monto_disp_bs, monto_dv, monto_disp_dv, id_tp_moneda, id_tp_recurso, asunto, descripcion, presentado, id_funcionario, fecha_aprobacion', 'safe', 'on'=>'search'),
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
			'idPuntoPadre' => array(self::BELONGS_TO, 'PuntoCuenta', 'id_punto_padre'),
			'puntoCuentas' => array(self::HAS_MANY, 'PuntoCuenta', 'id_punto_padre'),
			'idTpMoneda' => array(self::BELONGS_TO, 'Moneda', 'id_tp_moneda'),
			'idTpRecurso' => array(self::BELONGS_TO, 'TipoRecurso', 'id_tp_recurso'),
			'idFuncionario' => array(self::BELONGS_TO, 'Funcionario', 'id_funcionario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_punto_cuenta' => 'Punto Cuenta',
			'id_punto_padre' => 'Punto de Cuenta Presindencial',
			'co_punto_cuenta' => 'Código del Punto Cuenta',
			'presidencial' => 'Presidencial',
			'monto_bs' => 'Monto(Bs)',
			'monto_disp_bs' => 'Monto Disponible(Bs)',
			'monto_dv' => 'Monto en Divisas (Bs)',
			'monto_disp_dv' => 'Monto Disponible en Divisas',
			'id_tp_moneda' => 'Tipo de Moneda',
			'id_tp_recurso' => 'Tipo de Recurso',
			'asunto' => 'Asunto',
			'descripcion' => 'Descripción',
			'presentado' => 'Presentado',
			'id_funcionario' => 'Aprobado por',
			'fecha_aprobacion' => 'Fecha Aprobación',
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

		$criteria->compare('id_punto_cuenta',$this->id_punto_cuenta);
		$criteria->compare('id_punto_padre',$this->id_punto_padre);
		$criteria->compare('co_punto_cuenta',$this->co_punto_cuenta,true);
		$criteria->compare('presidencial',$this->presidencial);
		//$criteria->compare('monto_bs',$this->monto_bs,true);
                #Monto en Bs
                $this->monto_bs=str_replace('.', '', $this->monto_bs);
                $this->monto_bs=str_replace(',', '.', $this->monto_bs);
                $criteria->compare('monto_bs',$this->monto_bs);
                $this->monto_bs=number_format((double)$this->monto_bs, 2, ",", ".");
                if($this->monto_bs==0.00)$this->monto_bs=NULL;
                ##
		$criteria->compare('monto_disp_bs',$this->monto_disp_bs,true);
		//$criteria->compare('monto_dv',$this->monto_dv,true);
                #Monto en DV
                $this->monto_dv=str_replace('.', '', $this->monto_dv);
                $this->monto_dv=str_replace(',', '.', $this->monto_dv);
                $criteria->compare('monto_bs',$this->monto_dv);
                $this->monto_dv=number_format((double)$this->monto_dv, 2, ",", ".");
                if($this->monto_dv==0.00)$this->monto_dv=NULL;
                ##
		$criteria->compare('monto_disp_dv',$this->monto_disp_dv,true);
		$criteria->compare('id_tp_moneda',$this->id_tp_moneda,true);
		$criteria->compare('id_tp_recurso',$this->id_tp_recurso,true);
		$criteria->compare('asunto',$this->asunto,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('presentado',$this->presentado,true);
		$criteria->compare('id_funcionario',$this->id_funcionario,true);
		$criteria->compare('fecha_aprobacion',$this->fecha_aprobacion,true);
                 $from = $to = '';
		if (count($this->fe_aprobacion_range)>=1) {
			if (isset($this->fe_aprobacion_range['from'])) {
				$from = $this->fe_aprobacion_range['from'];
			}
			if (isset($this->fe_aprobacion_range['to'])) {
				$to= $this->fe_aprobacion_range['to'];
			}
		 
		}
		if ($from!='' || $to !='') {
			if ($from!='' && $to!='') {
				$from = date("d-m-Y", strtotime($from));
				$to = date("d-m-Y", strtotime($to));
				$criteria->compare('fecha_aprobacion',">= $from",false);
				$criteria->compare('fecha_aprobacion',"<= $to",false);
			}
			else {
				if ($from!='') $creation_time = $from;
				if ($to != '') $creation_time = $to;
				$creation_time = date("d-m-Y", strtotime($creation_time));
				$criteria->compare('fecha_aprobacion', "$creation_time" ,false);
			}
		}
                $criteria->compare('st_punto_cuenta',true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PuntoCuenta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        /**
         *  BeforeSafe
         *  Se ejecuta antes de guardar
         */
        protected function beforeSave() {
		
            #Monto en Bs
            $this->monto_bs=str_replace('.', '', $this->monto_bs);
            $this->monto_bs=str_replace(',', '.', $this->monto_bs);
            if($this->monto_bs=='')$this->monto_bs=NULL;
            #Monto Disponible en Bs
            $this->monto_disp_bs=str_replace('.', '', $this->monto_disp_bs);
            $this->monto_disp_bs=str_replace(',', '.', $this->monto_disp_bs);
            if($this->monto_disp_bs=='')$this->monto_disp_bs=NULL;
            #Monto en Divisas
            $this->monto_dv=str_replace('.', '', $this->monto_dv);
            $this->monto_dv=str_replace(',', '.', $this->monto_dv);
            if($this->monto_dv=='')$this->monto_dv=NULL;
            #Monto Disponible en Divisas
            $this->monto_disp_dv=str_replace('.', '', $this->monto_disp_dv);
            $this->monto_disp_dv=str_replace(',', '.', $this->monto_disp_dv);
            if($this->monto_disp_dv=='')$this->monto_disp_dv=NULL;
		return parent::beforeSave();
	}
        
                /**
         *  AfterFind
         *  Se ejecuta despues de buscar
         */
        protected function afterFind() {
		
            
            $this->monto_bs=number_format($this->monto_bs, 2, ",", ".");
            $this->monto_disp_bs=number_format($this->monto_disp_bs, 2, ",", ".");
            $this->monto_dv=number_format($this->monto_dv, 2, ",", ".");
            $this->monto_disp_dv=number_format($this->monto_disp_dv, 2, ",", ".");
            $this->fecha_aprobacion=implode("-",array_reverse(explode("-",$this->fecha_aprobacion)));
            
            
		return parent::afterFind();
	}
}
