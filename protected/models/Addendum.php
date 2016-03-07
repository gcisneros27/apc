<?php

/**
 * This is the model class for table "addendum".
 *
 * The followings are the available columns in table 'addendum':
 * @property integer $id_addendum
 * @property string $fecha_addendum
 * @property string $monto_addendum
 * @property string $id_estatus_addendum
 * @property boolean $st_addendum
 * @property string $id_contrato
 * @property string $id_punto_cuenta
 * @property string $nu_addendum
 *
 * The followings are the available model relations:
 * @property Contrato $idContrato
 * @property PuntoCuenta $idPuntoCuenta
 */
class Addendum extends CActiveRecord
{
     public $fe_addendum_range = array();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'addendum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('monto_addendum,id_estatus_addendum,fecha_addendum','required'),
			array('monto_addendum', 'length', 'max'=>20),
			array('fecha_addendum, id_estatus_addendum, st_addendum, id_contrato, id_punto_cuenta, nu_addendum', 'safe'),
			array('monto_addendum', 'match',
					'pattern' => '/^[0-9]\d{0,2}(\.[0-9]\d{2,2})*(\,\d{1,2})?$/',
					//'pattern' => '/^[0-9]\d{0,20}(\.[0-9]{0,2})?$/',
					'message' => 'El valor del campo debe tener un formato 1.000,00',
					//'on'=>'create,update',
			),
                        // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fe_addendum_range,id_addendum, fecha_addendum, monto_addendum, id_estatus_addendum, st_addendum, id_contrato, id_punto_cuenta, nu_addendum', 'safe', 'on'=>'search'),
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
			'idContrato' => array(self::BELONGS_TO, 'Contrato', 'id_contrato'),
			'idPuntoCuenta' => array(self::BELONGS_TO, 'PuntoCuenta', 'id_punto_cuenta'),
                        'idEstatusAddendum' => array(self::BELONGS_TO, 'EstatusAddendum', 'id_estatus_addendum'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_addendum' => 'Addendum',
			'fecha_addendum' => 'Fecha Addendum',
			'monto_addendum' => 'Monto Addendum',
			'id_estatus_addendum' => 'Estatus Addendum',
			'st_addendum' => 'St Addendum',
			'id_contrato' => 'Id Contrato',
			'id_punto_cuenta' => 'Punto de Cuenta',
			'nu_addendum' => 'N° Addendum',
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

		$criteria->compare('id_addendum',$this->id_addendum);
		$criteria->compare('fecha_addendum',$this->fecha_addendum,true);
                $from = $to = '';
		if (count($this->fe_addendum_range)>=1) {
			if (isset($this->fe_addendum_range['from'])) {
				$from = $this->fe_addendum_range['from'];
			}
			if (isset($this->fe_addendum_range['to'])) {
				$to= $this->fe_addendum_range['to'];
			}
		 
		}
		if ($from!='' || $to !='') {
			if ($from!='' && $to!='') {
				$from = date("d-m-Y", strtotime($from));
				$to = date("d-m-Y", strtotime($to));
				$criteria->compare('fecha_addendum',">= $from",false);
				$criteria->compare('fecha_addendum',"<= $to",false);
			}
			else {
				if ($from!='') $creation_time = $from;
				if ($to != '') $creation_time = $to;
				$creation_time = date("d-m-Y", strtotime($creation_time));
				$criteria->compare('fecha_addendum', "$creation_time" ,false);
			}
		}
		
                #Monto Addendum
                $this->monto_addendum=str_replace('.', '', $this->monto_addendum);
                $this->monto_addendum=str_replace(',', '.', $this->monto_addendum);
		$criteria->compare('monto_addendum',$this->monto_addendum);
                $this->monto_addendum=number_format((double)$this->monto_addendum, 2, ",", ".");
                if($this->monto_addendum==0.00)$this->monto_addendum=NULL;
               
                #
		$criteria->compare('id_estatus_addendum',$this->id_estatus_addendum,true);
		$criteria->compare('st_addendum',TRUE);
		$criteria->compare('id_contrato',$id);
		$criteria->compare('id_punto_cuenta',$this->id_punto_cuenta,true);
		$criteria->compare('nu_addendum',$this->nu_addendum);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Addendum the static model class
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
		
            #Monto Total en Bs
            $this->monto_addendum=str_replace('.', '', $this->monto_addendum);
            $this->monto_addendum=str_replace(',', '.', $this->monto_addendum);
            if($this->monto_addendum=='')$this->monto_addendum=NULL;
            if($this->id_punto_cuenta=='')$this->id_punto_cuenta=NULL;
		return parent::beforeSave();
	}
        /**
         *  AfterFind
         *  Se ejecuta despues de buscar
         */
        protected function afterFind() {
		
            #Monto Total en Bs
            $this->monto_addendum=number_format($this->monto_addendum, 2, ",", ".");
          
            
		return parent::afterFind();
	}
}
