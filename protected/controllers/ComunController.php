<?php

class ComunController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		TUsuarioSesion::model()->updateAll(array('fecha_fin'=> FuncionesPublicas::timestampUnix()),'id_usuario_sesion=:id_usuario_sesion',array(':id_usuario_sesion'=>Yii::app()->session['idSession']));
		Yii::app()->session['idSession'] = NULL;
		Yii::app()->session['fecha_inicio'] = NULL;
		
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
    public function actionBuscarSaime(){
	 	if(isset($_POST['cedula'])&&isset($_POST['nacionalidad']))
	 	{
	    	$datosPersona=array();
			$cedula=$_POST['cedula'];
			$nacionalidad=$_POST['nacionalidad'];
			
			$saime=ESaime::model()->find('cedula=:cedula AND tipo=:tipo',array('cedula'=>$cedula,'tipo'=>$nacionalidad));
			
			if($saime){
				$datosPersona['cedula']=$saime->cedula;
				$datosPersona['apellido1']=$saime->apellido1;
				$datosPersona['apellido2']=$saime->apellido2;
				$datosPersona['nombre1']=$saime->nombre1;
				$datosPersona['nombre2']=$saime->nombre2;
				$datosPersona['sexo']=$saime->sexo;
				$datosPersona['existe']=1;
			}else {
				$persona=MDatosContactos::model()->find('cedula_contacto=:cedula_contacto AND nacionalidad_contacto=:nacionalidad_contacto',array('cedula_contacto'=>$cedula,'nacionalidad_contacto'=>$nacionalidad));
				if ($persona) {
					$datosPersona['apellido1']=$persona->apellido_contacto;
				//	$datosPersona['apellido2']=$persona->apellido2;
					$datosPersona['nombre1']=$persona->nombre_contacto;
					//$datosPersona['nombre2']=$persona->nombre2;
					$datosPersona['sexo']=$persona->sexo;
				}
				$datosPersona['existe']=0;
			}
			
			echo CJSON::encode($datosPersona);
	 	}

	}
	
    public function actionBuscarRif(){
	 	if(isset($_POST['rif']))
	 	{
	 		$datos=array(
	 			'sujeto'=>'','id_estado'=>'','id_municipio'=>'', 'id_parroquia'=>'','estado'=>'','municipio'=>'','parroquia'=>'','avenida'=>'','calle'=>'','carrera'=>'',
	 			'urbanizacion'=>'','transvelsar'=>'','esquina'=>'','callejon'=>'','vereda'=>'','punto_referencia'=>''
			);

			$rif=$_POST['rif'];
			$rifMsujeto=MSujetosAplicaciones::model()->find('rif=:rif',array(':rif'=>$rif));
			 if ($rifMsujeto)
			 {
				// $datos['estado']=$rifMsujeto->id_estado;
				// $datos['municipio']=$rifMsujeto->id_municipio;
				// $datos['parroquia']=$rifMsujeto->id_parroquia;
			 	$datos['sujeto']=$rifMsujeto->sujeto;
				
				$datos['id_estado']= $rifMsujeto->id_estado;
				$datos['id_municipio']= $rifMsujeto->id_municipio;
				$datos['id_parroquia']= $rifMsujeto->id_parroquia;

				$datos['estado']= $rifMsujeto->idEstado->estado;
				$datos['municipio']= $rifMsujeto->idMunicipio->municipio;
				$datos['parroquia']= $rifMsujeto->idParroquia->parroquia;

				$datos['avenida']=$rifMsujeto->avenida;
				$datos['calle']=$rifMsujeto->calle;
				$datos['carrera']=$rifMsujeto->carrera;
				$datos['urbanizacion']=$rifMsujeto->urbanizacion_barrio;
				$datos['transvelsar']=$rifMsujeto->transversal;
				$datos['esquina']=$rifMsujeto->esquina;
				$datos['callejon']=$rifMsujeto->callejon;
				$datos['vereda']=$rifMsujeto->vereda;
				$datos['punto_referencia']=$rifMsujeto->punto_referencia;
			 }else if (!$rifMsujeto) {
				$rifRupdae=V1MSujetosRupdaeMSujetosFiscaDen::model()->find('rif=:rif',array(':rif'=>$rif));
			 	if ($rifRupdae)
			 	{
					// $datos['estado']=$rifRupdae->id_estado;
					// $datos['municipio']=$rifRupdae->id_municipio;
					// $datos['parroquia']=$rifRupdae->id_parroquia;
				 	$datos['sujeto']=$rifRupdae->sujeto;
					$datos['id_estado']= $rifRupdae->id_estado;
					$datos['id_municipio']= $rifRupdae->id_municipio;
					$datos['id_parroquia']= $rifRupdae->id_parroquia;
					$datos['estado']= $rifRupdae->idEstado->estado;
					$datos['municipio']= $rifRupdae->idMunicipio->municipio;
					$datos['parroquia']= $rifRupdae->idParroquia->parroquia;
					$datos['avenida']=$rifRupdae->avenida;
					$datos['calle']=$rifRupdae->calle;
					$datos['carrera']=$rifRupdae->carrera;
					$datos['urbanizacion']=$rifRupdae->urbanizacion_barrio;
					$datos['transvelsar']=$rifRupdae->transversal;
					$datos['esquina']=$rifRupdae->esquina;
					$datos['callejon']=$rifRupdae->callejon;
					$datos['vereda']=$rifRupdae->vereda;
				}
			}
//echo '<pre>';print_r($datos); die();
			 echo CJSON::encode($datos);
	 	}
	}

    public function actionBuscarOnidex(){
	 	if(isset($_POST['cedula']))
	 	{
	 		$datosPersona=array();
	 		$datosPersona['nombre1']="";
	 		$datosPersona['nombre2']="";
	 		$datosPersona['apellido1']="";
	 		$datosPersona['apellido2']="";
	 		$datosPersona['correo']="";
	 		$datosPersona['telefono']="";	
	 		$datosPersona['telefono2']="";
	 		$datosPersona['telefono3']="";
	 		$datosPersona['nacionalidad']="";
	 		$datosPersona['sexo']="";
	 		$datosPersona['estado_civil_id']="";
	 		$datosPersona['fe_nacimiento']="";
	 		$datosPersona['dir_estado_id']="";
	 		$datosPersona['dir_ciudad_id']="";
			$datosPersona['dir_municipio_id']="";

			
			 $cedula=$_POST['cedula'];
			 if(is_numeric($cedula)){

				$condicion='cedula=:cedula';
				$parametro=array('cedula'=>$cedula);
				 if ($persona=PersonaGen::model()->find($condicion,$parametro)){
			 		$datosPersona['nombre1']=$persona->nombre1;
			 		$datosPersona['nombre2']=$persona->nombre2;
			 		$datosPersona['apellido1']=$persona->apellido1;
			 		$datosPersona['apellido2']=$persona->apellido2;
			 		$datosPersona['correo']=$persona->correo;
			 		$datosPersona['telefono']=$persona->telefono;
					$datosPersona['nacionalidad']=$persona->nacionalidad;
					$fechaNacimiento=date("m-d-Y", strtotime($persona->fe_nacimiento));				
					$datosPersona['fe_nacimiento']=$fechaNacimiento;
				 }
				 else{
					 $persona=Onidex::model()->find('cedula=:CI',array(':CI'=>$cedula));
					 if ($persona){
				 		$datosPersona['nombre1']=$persona->nombre1;
				 		$datosPersona['nombre2']=$persona->nombre2;
				 		$datosPersona['apellido1']=$persona->apellido1;
				 		$datosPersona['apellido2']=$persona->apellido2;
				 		$datosPersona['nacionalidad']=$persona->nac;
				 		$fechaNacimiento=date("d-m-Y", strtotime($persona->fecha_nac));
				 		$datosPersona['fe_nacimiento']=$fechaNacimiento;
					 }
				 }			 	
			 }
			 echo CJSON::encode($datosPersona);
	 	}
	}	

	public function actionBuscarPersona(){
		if(isset($_POST['cedula']) && isset($_POST['cedula']) !='' && isset($_POST['nacionalidad']))
		{
			
			$nacionalidad = $_POST['nacionalidad'];
			$cedula = $_POST['cedula'];
			$datosPersona=array();
			$datosPersona['nombres']="";
			$datosPersona['nombres_2']="";
			$datosPersona['apellidos']="";
			$datosPersona['apellidos_2']="";
			$id=$_POST['id'];
			if(is_numeric($cedula)){
				$persona=ESaime::model()->find('cedula=:cedula AND upper(tipo)=:tipo',
							array(':cedula'=>$cedula,':tipo'=>strtoupper($nacionalidad)));
				if($persona){
					$datosPersona['nombres']=strtoupper($persona->nombre1);
					$datosPersona['nombres_2']=strtoupper($persona->nombre2);
					$datosPersona['apellidos']=strtoupper($persona->apellido1);
					$datosPersona['apellidos_2']=strtoupper($persona->apellido2);
				}
				else{
					$persona=MDenunciantes::model()->find('cedula=:cedula AND nacionalidad=:nacionalidad',
						array(':cedula'=>$cedula,':nacionalidad'=>$nacionalidad));
					
					if(!$persona){
						$persona=MSujetosAplicaciones::model()->find('cedula=:cedula AND nacionalidad=:nacionalidad',
								array(':cedula'=>$cedula,':nacionalidad'=>$nacionalidad));
						
						if($persona){
							$datosPersona['nombres']=strtoupper($persona->nombre_1);
							$datosPersona['nombres_2']=strtoupper($persona->nombre_2);
							$datosPersona['apellidos']=strtoupper($persona->apellido_1);
							$datosPersona['apellidos_2']=strtoupper($persona->apellido_2);
						}
						else{
							$persona=MDatosContactos::model()->find('cedula_contacto=:cedula_contacto AND nacionalidad_contacto=:nacionalidad_contacto',
									array(':cedula_contacto'=>$cedula,':nacionalidad_contacto'=>$nacionalidad));
							
							if($persona){
								$datosPersona['nombres']=strtoupper($persona->nombre_contacto);
								$datosPersona['apellidos']=strtoupper($persona->apellido_contacto);
							}
						}
						
					}
					else{
						$datosPersona['nombres']=strtoupper($persona->nombre_1);
						$datosPersona['apellidos']=strtoupper($persona->apellido_1);
					}
					
				}
				
					
				
				if ($persona){
					if($id==1){
						$datosPersona['id_estado']= (isset($persona->id_estado))?$persona->id_estado:"";
						$datosPersona['id_municipio']= (isset($persona->id_municipio))?$persona->id_municipio:"";
						$datosPersona['id_parroquia']= (isset($persona->id_parroquia))?$persona->id_parroquia:"" ;

						$datosPersona['estado']= (isset($persona->idEstado)&&isset($persona->idEstado->estado))?$persona->idEstado->estado:"--SELECCIONE--";
						$datosPersona['municipio']= (isset($persona->idMunicipio)&&isset($persona->idMunicipio->municipio))?$persona->idMunicipio->municipio:"--SELECCIONE--" ;
						$datosPersona['parroquia']= (isset($persona->idParroquia)&&isset($persona->idParroquia->parroquia))?$persona->idParroquia->parroquia:"--SELECCIONE--";
	
						$datosPersona['calle']= (isset($persona->calle))?$persona->calle:"";
						$datosPersona['carrera']= (isset($persona->carrera))?$persona->carrera:""; 
						$datosPersona['callejon']= (isset($persona->callejon))?$persona->callejon:"";
						$datosPersona['esquina']= (isset($persona->esquina))?$persona->esquina:"";
						$datosPersona['transversal']= (isset($persona->transversal))?$persona->transversal:"";
						$datosPersona['urbanizacion_barrio']= (isset($persona->urbanizacion_barrio))?$persona->urbanizacion_barrio:"";
						$datosPersona['vereda']= (isset($persona->vereda))?$persona->vereda:"";
						$datosPersona['punto_referencia']= (isset($persona->punto_referencia))?$persona->punto_referencia:"";
					}
				}
			}
			echo CJSON::encode($datosPersona);
		}
	}

  public function actionBuscarFiscal(){

		$nacionalidad = $_POST['nacionalidad'];
		$cedula = $_POST['cedula'];
		$datos=array();
		$fiscal['nombres']="";
		$fiscal['apellidos']="";

		
		$fiscal=MDatosContactos::model()->find(
	    'cedula_contacto=:cedula_contacto AND nacionalidad_contacto=:nacionalidad_contacto',
			array(':cedula_contacto'=>$cedula,':nacionalidad_contacto'=>strtoupper($nacionalidad))
		);
		
		if($fiscal){
			$datos['nombres']=strtoupper($fiscal->nombre_contacto);
			$datos['apellidos']=strtoupper($fiscal->apellido_contacto);
		}
		echo CJSON::encode($datos);
  }

	public function actionCiudad()  {
		$data=CHtml::listData(GenCiudad::model()->findAll('estado_id=:estado_id AND ciu_status=true',
		array(':estado_id'=>(int)$_POST['dir_estado_id'])) , 'id_ciudad', 'ciu_nombre' );
		echo CHtml::tag('option',array('value' => ''),'--Seleccione--',true);
	    foreach($data as $value=>$name){
	       echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
		}
    }
	
	public function actionMunicipio()  {
		$data=CHtml::listData(GenCiudad::model()->with('municipio')->together(true)->
		findAll('t.estado_id=:estado_id AND id_ciudad=:id_ciudad AND ciu_status=true',
		array(':estado_id'=>(int)$_POST['dir_estado_id'],':id_ciudad'=>
		(int)$_POST['dir_ciudad_id'])),'municipio.id_municipio', 'municipio.mun_nombre' );
		echo CHtml::tag('option',array('value' => ''),'--Seleccione--',true);
	    foreach($data as $value=>$name){
	       echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
		}
                   
    }
    
    public function actionCargarTipoPrestamo()
                {$datosTipo=array();
                    if(isset($_POST['tipo']))
                    {
                        $datosTipo['interes']=""; 
                        $datosTipo['p_max_solicitud']=""; 
                        $datosTipo['p_min_amortizacion']=""; 
                        $datosTipo['tiempo_min']="";  
                        $datosTipo['nu_cuotas']=""; 
                        
                      $id_tipo= $_POST['tipo'];
                      if(is_numeric($id_tipo))
                          {
                            $tipoPrestamo= TipoPrestamo::model()->findByPk($id_tipo);
                            if($tipoPrestamo)
                                {
                                $datosTipo['interes']=number_format($tipoPrestamo->interes, 2, ",", ".");
                                $datosTipo['p_max_solicitud']=$tipoPrestamo->p_max_solicitud; 
                                $datosTipo['p_min_amortizacion']=$tipoPrestamo->p_min_amortizacion; 
                                $datosTipo['tiempo_min']=$tipoPrestamo->tiempo_min;  
                                $datosTipo['nu_cuotas']=$tipoPrestamo->nu_cuotas;
                                
                                
                                }
                          
                          
                          }    
                        echo CJSON::encode($datosTipo);
                    }
            
            
            
                }
    
    
 public function actionBusqueda(){
              if(isset($_POST['idPrimeraBusqueda'])&& isset($_POST['clase']) && $_POST['clase']!='' && in_array($_POST['clase'], Yii::app()->params['clase']) ){
                
                $model = $_POST['clase'];
                $variable =$_POST['idBusqueda'];
                $nombre_campo = $_POST['nombreBusqueda'];
                $data= $model::model()->find($variable.'=:'.$variable,array(':'.$variable=>$_POST['idPrimeraBusqueda']));
		$respuesta = array();
		if($data){
			$respuesta['id'] = $data->$variable;
			$respuesta['text'] = CHtml::encode($data->$nombre_campo);
		}
                else{
                    $respuesta['id'] = "";
			$respuesta['text'] = "---SELECCIONE---";
                }
		
		echo CJSON::encode($respuesta);
            }
		
    	
        }
        public function actionBusquedaModelo(){
            
            if(isset($_POST['idDependiente'])&& isset($_POST['clase']) && $_POST['clase']!='' && in_array($_POST['clase'], Yii::app()->params['clase']) )
            {
                
                        $valor=(isset( $_POST['idDependiente'])? $_POST['idDependiente']:null);
                        $model = $_POST['clase'];
                        $variable =$_POST['idBusqueda'];
                        $variableNombre = $_POST['nombreBusqueda'];
                        $variableDependiente = $_POST['nombreIdDependiente'];
                        
                       $data=CHtml::listData($model::model()->findAll($variableDependiente.'=:'.$variableDependiente.' AND '.$variableNombre.' ILIKE :'.$variableNombre.' ORDER BY '.$variableNombre.' ASC',
                                                               array(':'.$variableDependiente=>($valor=="")?null:$valor,':'.$variableNombre=>"%".$_POST['q']."%")) ,$variableDependiente, $variableNombre );
//                         $data=CHtml::listData(GeoMunicipio::model()->findAll('geo_estado_id=:geo_estado_id AND nombre ILIKE :nombre ORDER BY nombre ASC',
//                                         array(':geo_estado_id'=>($valor=="")?null:15,':nombre'=>"%".$_POST['q']."%")) ,"geo_municipio_id", "nombre" );
//                        $data=CHtml::listData(GeoMunicipio::model()->findAll('geo_estado_id=:geo_estado_id AND nombre ILIKE :nombre ORDER BY nombre ASC',array(':geo_estado_id'=>15,':nombre'=>"%".$_POST['q']."%")),"geo_municipio_id", "nombre");
                        //print_r($data);exit;
                        $result = array();
                        foreach($data as $value=>$name){
                                 $result[] = array(
                                     'id'   => $value,
                                     'text' => CHtml::encode($name),
                                 );
                             }

                        $respuesta = array();
                        $respuesta['res'] = $result;
                        $respuesta['total'] = count($data);
                        echo CJSON::encode($respuesta);
               
               
            }
            
    	
        }
        public function actionBusqueda2(){
        	if(isset($_POST['idPrimeraBusqueda'])&& isset($_POST['id_busqueda']) && $_POST['id_busqueda']!='' && in_array($_POST['id_busqueda'], Yii::app()->params['clase']) ){
        		$datos= $this->configuracionBusqueda($_POST['id_busqueda']);
        		 $join = NULL;	
	               if(array_key_exists('join',$datos))
	                	$join=$datos['join'];
	                	
	                	
        		$data= $datos['clase']::model()->with($join)->find($datos['id_busqueda'].'=:id',array(':id'=>(int)$_POST['idPrimeraBusqueda']));
        		$respuesta = array();
        		if($data){
        			
        			$respuesta['id'] = $data->$datos['id_busqueda'];
        			$campo = str_replace('.', '->', $datos['nombre_campo']);
        			 
        			$pos = strpos($datos['nombre_campo'], '.');
					if ($pos !== false) {
						list($primero,$segundo) = explode(".", $datos['nombre_campo']);
						$campo = $data->$primero->$segundo;
					}
					else 	
						$campo = $data->$datos['nombre_campo'];
					
        			$respuesta['text'] = CHtml::encode($campo);
        		}
        		else{
        			$respuesta['id'] = "";
        			$respuesta['text'] = "---SELECCIONE---";
        		}
        
        		echo CJSON::encode($respuesta);
        	}
        
        	 
        }
        
        public function actionBusquedaModelo2(){
        	$respuesta = array();
	       	$respuesta['res'] = array();
			$respuesta['total'] = 0;    
			            
           	if(isset($_POST['clase']) && $_POST['clase']!='' && in_array($_POST['clase'], Yii::app()->params['clase']) ){
           		
                $datos= $this->configuracionBusqueda($_POST['clase']);
                if(count($datos)>0){
                	$sql =$datos['condicion'];

	                if (array_key_exists('id_dependiente',$datos)){
		                foreach ($datos['id_dependiente'] AS $key=>$value){
		                	$campo = $value[0];
		                	$dato = $_POST[$value[0]];
		                	$condicion = (array_key_exists('condicion',$value))?$value['condicion']:"=";
		                	//$alias = (array_key_exists('alias',$value))?$value['alias'].'.':"";
		                	//$campo=$alias.$campo;
		                	if(array_key_exists('tipo',$value) &&$value['tipo']=='int')
		                		$dato =(int)$dato;
							else {
								$dato ="'".$dato."'";
							}
		                	if(array_key_exists('condicion',$value))
		                		$condicion =$value['condicion'];
		                		
		                	$requerido = (array_key_exists(1,$value))?$value[1]:'';
		           			if($requerido== 'requerido'){
		        				$sql.=' AND '.$campo.$condicion.$dato;
		        			}
		       				else{
		          				if($dato !='')
		    						$sql.=' AND '.$campo.$condicion.$dato;
							}
		                }
	                }
	                if($_POST['q']!=''){
	                	$sql .= ' AND '.$datos['nombre_campo'].' ilike \'%'.$_POST['q'].'%\'';
	                }
	                
	               // echo $sql;exit;
	                $model = $datos['clase'];
	                $variable =$datos['id_busqueda'];
	                $variableNombre = $datos['nombre_campo'];
	                
	                $order=NULL;
	                if(array_key_exists('order',$datos))
	                	$order=$datos['order'];
	                	
	                $join = NULL;	
	                if(array_key_exists('join',$datos))
	                	$join=$datos['join'];
	                $datosConsulta =$model::model()->with($join)->findAll(array('condition'=>$sql,'order'=>$order));
	            
					$result = array();
					unset($respuesta);
					$respuesta = array();

					$variableNombre = str_replace(array('"'), array(''), $variableNombre);
					
	                foreach($datosConsulta as $value=>$name){
	                	
	                	$pos = strpos($variableNombre, '.');
	                	if ($pos !== false) {
	                		list($primero,$segundo) = explode(".", $variableNombre);
	                		$campo = (isset($name->$primero->$segundo))?$name->$primero->$segundo:"";
	                	}
	                	else
	                		$campo = $name->$variableNombre;
	                		
	                         $result[] = array(
	                             'id'   => $name->$variable,
	                             'text' => CHtml::encode($campo),
	                         );
	                     }
					$respuesta['res'] = $result;
					$respuesta['total'] = count($datosConsulta);
                }
				
            }
            echo CJSON::encode($respuesta);
        }
	
	public function actionBusquedaMotivosEconomicos(){
        	$respuesta = array();
        	if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
        
        		$data=MMotivosEconomicos::model()->findAll('id_motivo_economico in('.$_POST['idPrimeraBusqueda'].')');
        
        		if(count($data)>0){
        			foreach ($data AS $k =>$v){
        				$respuesta2['id'] = $v->id_motivo_economico;
        				$respuesta2['text'] = CHtml::encode($v->nombre_motivo_economico);
        				$respuesta[]= $respuesta2;
        			}
        
        		}
        		else {
        			$respuesta2['id'] = "";
        			$respuesta2['text'] = "---SELECCIONE---";
        			$respuesta[]=$respuesta2;
        		}
        	}
        	echo CJSON::encode($respuesta);
	}
	public function actionBusquedaMensaje(){
		$respuesta = array();
		if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
	
			$data=MMensajes::model()->findAll('id_mensaje in('.$_POST['idPrimeraBusqueda'].')');
			if(count($data)>0){
				foreach ($data AS $k =>$v){
					$respuesta2['id'] = $v->id_mensaje;
					$respuesta2['text'] = CHtml::encode($v->titulo);
					$respuesta[]= $respuesta2;
				}
	
			}
			else {
				$respuesta2['id'] = "";
				$respuesta2['text'] = "---SELECCIONE---";
				$respuesta[]=$respuesta2;
			}
		}
		echo CJSON::encode($respuesta);
	}
	
	public function actionBusquedaTiposInfracciones(){
        	$respuesta = array();
        	if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
        
        		$data=MTiposInfracciones::model()->findAll('id_tipo_infraccion in('.$_POST['idPrimeraBusqueda'].')');
        
        		if(count($data)>0){
        			foreach ($data AS $k =>$v){
        				$respuesta2['id'] = $v->id_tipo_infraccion;
        				$respuesta2['text'] = CHtml::encode($v->nombre_tipo_infraccion);
        				$respuesta[]= $respuesta2;
        			}
        
        		}
        		else {
        			$respuesta2['id'] = "";
        			$respuesta2['text'] = "---SELECCIONE---";
        			$respuesta[]=$respuesta2;
        		}
        	}
        	echo CJSON::encode($respuesta);
	}
	public function actionBusquedaInfracciones(){
        	$respuesta = array();
        	if(in_array($_POST['clase'], Yii::app()->params['clase'])){
        		
				    $sql='';
        			 if($_POST['q']!=''){
	                	$sql .= 'numero_articulo='.(int)$_POST['q'].' or descripcion_articulo ilike \'%'.$_POST['q'].'%\'';
	                }
        
        		$data=MInfracciones::model()->findAll($sql);
        		if(count($data)>0){
        			foreach ($data AS $k =>$v){
        				$respuesta2['id'] = $v->id_infraccion;
        				$respuesta2['text'] ='Art. '.$v->numero_articulo.'-'.CHtml::encode($v->descripcion_articulo);
        				$respuesta[]= $respuesta2;
        			}
        
        		}
        		else {
        			$respuesta2['id'] = "";
        			$respuesta2['text'] = "---SELECCIONE---";
        			$respuesta[]=$respuesta2;
        		}
        	}//print_r($respuesta);die;
        	
        	$respuestas['res'] = $respuesta;
			$respuestas['total'] = count($data);
			
        	echo CJSON::encode($respuestas);
	}
		public function actionPrimeraBusquedaInfracciones(){
        	$respuesta = array();
        	if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
        
        		//$data=MInfracciones::model()->findAll('id_infraccion in('.$_POST['idPrimeraBusqueda'].')');  
        		$sql='select inf.id_infraccion,inf.numero_articulo,inf.descripcion_articulo
				from fiscalizaciones.r_actos_infracciones raci
				join m_infracciones inf ON inf.id_infraccion=raci.id_infraccion 
				where raci.estatus_r_actos_infracciones=true AND inf.id_infraccion in('.$_POST['idPrimeraBusqueda'].')';
        		//echo $sql;die;
        		$data=Yii::app()->db->cache(31536000)->createCommand($sql)->queryAll();
        		if(count($data)>0){
	        			foreach ($data AS $k =>$v){
	        				$respuesta2['id'] = $v['id_infraccion'];
	        				$respuesta2['text'] ='Art. '.$v['numero_articulo'].'-'.CHtml::encode($v['descripcion_articulo']);
	        				$respuesta[]= $respuesta2;
	        			}
        		}
        		else {
        			$respuesta2['id'] = "";
        			$respuesta2['text'] = "---SELECCIONE---";
        			$respuesta[]=$respuesta2;
        		}
        	}
        	
			
			
			// print_r($respuestas);die;
        	echo CJSON::encode($respuesta);
	}
	public function actionBusquedaliteral(){
        	$respuesta = array();
           	if(isset($_POST['clase']) && $_POST['clase']!='' && in_array($_POST['clase'], Yii::app()->params['clase']) ){
        		
        		$data=MInfracciones::model()->findAll('numero_articulo=:numero_articulo',array(':numero_articulo'=>$_POST['numero_articulo']));
        		if(count($data)>0){
        			foreach ($data AS $k =>$v){
        				$respuesta2['id'] = $v->literal;
        				$respuesta2['text'] =$v->literal;
        				$respuesta[]= $respuesta2;
        			}
        
        		}
        		else {
        			$respuesta2['id'] = "";
        			$respuesta2['text'] = "---SELECCIONE---";
        			$respuesta[]=$respuesta2;
        		}
        	}//print_r($respuesta);die;
        	
        	$respuestas['res'] = $respuesta;
			$respuestas['total'] = count($data);
			
        	echo CJSON::encode($respuestas);
	}
	public function actionPrimeraBusquedaliteral(){
        	$respuesta = array();
			//$_POST['idPrimeraBusqueda'] se utiliza para buscar el valor en la tabla por el id que contiene el
			//$_POST['id_busqueda'] es el id de la relacion
        	if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
        		
        		$data=MInfracciones::model()->find('literal=:literal',array(':literal'=>$_POST['idPrimeraBusqueda']));
        		if($data){
        				$respuesta['id'] = $data->id_infraccion;
        				$respuesta['text'] =$data->literal;
        
        		}
        		else {
        			$respuesta['id'] = "";
        			$respuesta['text'] = "---SELECCIONE---";
        		}
        	}//print_r($respuesta);die;
			
        	echo CJSON::encode($respuesta);
	}
	
	public function actionBusquedaRubrosActividad(){
			$respuesta = array();
			if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
				$data=RRubrosActividadesEconomicas::model()->findAll('id_rubro_actividad_economica in('.$_POST['idPrimeraBusqueda'].')');
				if(count($data)>0){
					foreach ($data AS $k =>$v){
						$respuesta2['id'] = $v->id_rubro_actividad_economica;
						$respuesta2['text'] = CHtml::encode($v->idRubro->nombre_rubro);
						$respuesta[]= $respuesta2;
					}
				}
				else {
					$respuesta2['id'] = "";
					$respuesta2['text'] = "---SELECCIONE---";
					$respuesta[]=$respuesta2;
				}
			}
			echo CJSON::encode($respuesta);
	}
        
        public function actionBusquedaMotivoActividad(){
			$respuesta = array();
			if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
				$data=  MMotivosEconomicos::model()->findAll('id_motivo_economico in('.$_POST['idPrimeraBusqueda'].')');
				if(count($data)>0){
					foreach ($data AS $k =>$v){
						$respuesta2['id'] = $v->id_motivo_economico;
						$respuesta2['text'] = CHtml::encode($v->nombre_motivo_economico);
						$respuesta[]= $respuesta2;
					}
				}
				else {
					$respuesta2['id'] = "";
					$respuesta2['text'] = "---SELECCIONE---";
					$respuesta[]=$respuesta2;
				}
			}
			echo CJSON::encode($respuesta);
	}
	
	
	

	public function actionBusquedaMedPrev(){
        	$respuesta = array();
        	if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
        
        		//$data=MMedidasPreventivas::model()->findAll('id_medida_preventiva in('.$_POST['idPrimeraBusqueda'].')');
        
				$sql='select med.id_medida_preventiva,med.nombre_medida_preventiva
				from fiscalizaciones.r_acto_medidas_preventivas racm
				join fiscalizaciones.m_medidas_preventivas med ON med.id_medida_preventiva=racm.id_medida_preventiva 
				where racm.estatus_r_acto_medidas_preventivas=true AND med.id_medida_preventiva in('.$_POST['idPrimeraBusqueda'].')';
        		//echo $sql;die;
        		$data=Yii::app()->db->cache(31536000)->createCommand($sql)->queryAll();
		
        		if(count($data)>0){
        			foreach ($data AS $k =>$v){
        				$respuesta2['id'] = $v['id_medida_preventiva'];
        				$respuesta2['text'] = CHtml::encode($v['nombre_medida_preventiva']);
        				$respuesta[]= $respuesta2;
        			}
        
        		}
        		else {
        			$respuesta2['id'] = "";
        			$respuesta2['text'] = "---SELECCIONE---";
        			$respuesta[]=$respuesta2;
        		}
        	}
        	echo CJSON::encode($respuesta);
	}

	public function actionBusquedaSanciones(){
        	$respuesta = array();
        	if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
        
        		//$data=MSanciones::model()->findAll('id_sancion in('.$_POST['idPrimeraBusqueda'].')');
				
				$sql='select san.id_sancion,san.nombre_sancion
				from fiscalizaciones.r_actos_sanciones racs
				join m_sanciones san ON san.id_sancion=racs.id_sancion 
				where racs.estatus_r_actos_sanciones=true AND san.id_sancion in('.$_POST['idPrimeraBusqueda'].')';
        		//echo $sql;die;
        		$data=Yii::app()->db->cache(31536000)->createCommand($sql)->queryAll();
        		if(count($data)>0){
        			foreach ($data AS $k =>$v){
        				$respuesta2['id'] = $v['id_sancion'];
        				$respuesta2['text'] = CHtml::encode($v['nombre_sancion']);
        				$respuesta[]= $respuesta2;
        			}
        
        		}
        		else {
        			$respuesta2['id'] = "";
        			$respuesta2['text'] = "---SELECCIONE---";
					
        			$respuesta[]=$respuesta2;
        		}
        	}
        	echo CJSON::encode($respuesta);
	}
	public function actionBusquedaIlicitos(){
		$respuesta = array();
		if(isset($_POST['idPrimeraBusqueda'])&& $_POST['idPrimeraBusqueda'] !=''&& in_array($_POST['id_busqueda'], Yii::app()->params['clase'])){
	
			$data=RMotivosInfracciones::model()->findAll('id_motivo_infraccion in('.$_POST['idPrimeraBusqueda'].')');
        
        		if(count($data)>0){
        			foreach ($data AS $k =>$v){
        				$respuesta2['id'] = $v->id_motivo_infraccion;
        				$respuesta2['text'] = CHtml::encode($v->idInfraccion->descripcion_articulo);
        				$respuesta[]= $respuesta2;
        			}
        
        	}
			else {
				$respuesta2['id'] = "";
				$respuesta2['text'] = "---SELECCIONE---";
				$respuesta[]=$respuesta2;
			}
		}
		echo CJSON::encode($respuesta);
	}
       
    public function actionBusquedaAutoCompletadoEmpresa() {

    	$sql ='id_parroquia='.(int)$_GET['id_parroquia'].' AND nombre_comercial ilike \'%'.$_GET['term'].'%\'';
        $data = MSujetosAplicaciones::model()->findAll(array('condition'=>$sql,'order'=>'nombre_comercial ASC'));
        $idD='';
        $idSR ='';
        $pr = '';
        $encontradoSistema=TRUE;
        if(!$data){
            $data = RupdaeMSujetos::model()->findAll(array('condition'=>$sql,'order'=>'nombre_comercial ASC'));
            $encontradoSistema= FALSE;
        }
        
        $result = array();
    	foreach($data as $value=>$name){
            
	        // $result[] = CHtml::encode($name->nombre_comercial)." <br /> REFERENCIAS:";
	        	if($encontradoSistema){
	        		$idD=$name->id_sujeto_aplicacion;
        			$idSR ='';
        			$nombre= CHtml::encode($name->nombre_comercial).' PUNTO REFERENCIA:'.$name->punto_referencia;
					$pr= $name->punto_referencia;        			
	        	}
	        	else{
	        		$idD= '';
        			$idSR =$name->id_sujeto;
        			$nombre= CHtml::encode($name->nombre_comercial).' REFERENCIA:'.$name->sujeto.'<br>dsds';
	        	}
	         $result[] = array(
							
	         				'label'=>strtoupper($nombre),
	         				'value'=>strtoupper(CHtml::encode($name->nombre_comercial)),
							'rif'=>$name->rif, // value for input field
	         				'idD'=>$idD, // value for input field
	         				'idSR'=>$idSR, // value for input field
	         				'PR'=>$pr, // value for input field
	         				);
	 	}
	 	echo CJSON::encode($result);
							
    }	
    
    public function actionBusquedaRubrosTag() {
        $respuesta = array();
        
        if(isset($_POST['term'] ) && $_POST['term']!=" "&& $_POST['term']!="" AND isset($_POST['actividad'] ) && $_POST['actividad']!=""){
           $data=  RRubrosActividadesEconomicas::model()->with('idRubro')->findAll(
           													array( 'condition'=>"nombre_rubro like :rubro AND id_actividad_economica =:id_actividad_economica AND (estatus_rubro is null OR estatus_rubro= TRUE)",
                                                            	   'params'=>array(':rubro'=>"%".strtoupper(trim($_POST['term']))."%",':id_actividad_economica'=>$_POST['actividad']),
           															'order'=>'nombre_rubro'
           															)
           													);
            if(count($data)>0){
		foreach ($data AS $k =>$v){
                    $respuesta2['id'] = $v->id_rubro;
                    $respuesta2['label'] = CHtml::encode($v->idRubro->nombre_rubro);
                    $respuesta2['value'] = CHtml::encode($v->idRubro->nombre_rubro);
                    $respuesta[]= $respuesta2;
		}
                echo CJSON::encode($respuesta);
            }      
        }						
    }	
    
    
     public function actionRifEmpresa()
    {
    	if(isset($_POST['rif'])&&$_POST['rif']!=''){
	    	$result = array();
	    	$result['rif']="";
	    	$result['idD']="";
	    	$result['idSR']="";
	        $data = MSujetosAplicaciones::model()->find('rif =:rif',array(':rif'=>strtoupper($_POST['rif'])));
			if($data){
				$result['punto_referencia']= $data->punto_referencia;
	        	$result['idD']=$data->id_sujeto_aplicacion;
			}
	        else{
	        	$data = RupdaeMSujetos::model()->find('rif =:rif',array(':rif'=>strtoupper($_POST['rif'])));
	            if($data)
	            	$result['idSR']=$data->id_sujeto;
	        }
	        if($data){
	        	$result['rif']= $data->rif;
	        	$result['nombre_comercial']= $data->nombre_comercial;
				$result['id_estado']= $data->id_estado;
				$result['id_municipio']= $data->id_municipio;
				$result['id_parroquia']= $data->id_parroquia;
				$result['estado']= $data->idEstado->estado;
				$result['municipio']= $data->idMunicipio->municipio;
				$result['parroquia']= $data->idParroquia->parroquia;
				$result['calle']= $data->calle;
				$result['carrera']= $data->carrera;
				$result['callejon']= $data->callejon;
				$result['esquina']= $data->esquina;
				$result['transversal']= $data->transversal;
				$result['urbanizacion_barrio']= $data->urbanizacion_barrio;
				$result['vereda']= $data->vereda;
				
	        	
	        }
	        else{
	        		$data = ESeniat::model()->find('rif =:rif',array(':rif'=>strtoupper($_POST['rif'])));
	        		if($data){
	        			$result['rif']= $data->rif;
	        			$result['nombre_comercial']= $data->razon_social;
	        			$result['id_estado']= NULL;
	        			$result['id_municipio']= NULL;
	        			$result['id_parroquia']= NULL;
	        			$result['estado']= '--SELECCIONE--';
	        			$result['municipio']= '--SELECCIONE--';
	        			$result['parroquia']= '--SELECCIONE--';
	        		}
	        					
	        }
	
			echo CJSON::encode($result);
    	}
							
    }	
    
    
    
    
    
    public function actionPrimeraBusquedaHoraConciliacion(){
    	$respuesta = array();
    	$respuesta['id'] = "";
    	$respuesta['text'] = "---SELECCIONE---";
        	if(isset($_POST['idPrimeraBusqueda'])&& isset($_POST['id_busqueda']) && $_POST['id_busqueda']!='' && in_array($_POST['id_busqueda'], Yii::app()->params['clase']) ){
        		if($_POST['idPrimeraBusqueda']!=""){
        			$respuesta['id'] = $_POST['idPrimeraBusqueda'];
        			$respuesta['text'] = $_POST['idPrimeraBusqueda'];
        		}
        	}
        	echo CJSON::encode($respuesta);
        }
       
    
    public function actionBusquedaHoraConciliacion(){
    	$respuesta = array();
    	$respuesta['res'] = array();
    	$respuesta['total'] = 0;
    	$dato=0;
    	$result= array();
    	if(isset($_POST['clase']) && $_POST['clase']!='' && in_array($_POST['clase'], Yii::app()->params['clase']) ){
    		$citas = MCitasAreas::model()->find('id_area=:id_area',array(':id_area'=>(int)$_POST['id_area']));
    		$tiempoDisponible = array();
    		if($citas){
    			$tiempoInicio = $citas->primer_turno_inicio;
    			$tiempoFin =  $citas->primer_turno_fin;
    			list($hora,$minuto,$segundo) = explode(":", $citas->persona_tiempo);
    			
    			$tiempoInicio = date("H:i:s", strtotime("00:00:00") + strtotime($tiempoInicio) -strtotime($citas->persona_tiempo) );
    			while (strtotime($tiempoInicio) < strtotime($tiempoFin)){
    		
    				$dt = new DateTime($tiempoInicio);
    				$dt->add(new DateInterval('PT'.$hora.'H'.$minuto.'M'));
    				$tiempo = $dt->format('H:i:s'); //17:00:00
    				$datos = TCitasDenunciasAdmisibles::model()->find(array('select'=>'hora_conciliacion, count(*) AS observacion',
    						'condition'=> 'id_area=:id_area AND fecha_conciliacion=:fecha_conciliacion AND hora_conciliacion=:hora_conciliacion',
    						'params'=>array(':id_area'=>(int)$_POST['id_area'],':fecha_conciliacion'=>$_POST['fecha_conciliacion'], ':hora_conciliacion'=>$tiempo ),
    						'group'=>'hora_conciliacion',
    						//'having'=>'count(*)<'.$citas->numero_funcionario
    				));
    				if($datos){
    					if($datos->observacion <$citas->numero_funcionario){
    						$result[] = array(
	    						'id'   => $tiempo,
	    						'text' => CHtml::encode($tiempo),
    						);
    					}
    						
    				}
    				else{
    					$result[] = array(
	    						'id'   => $tiempo,
	    						'text' => CHtml::encode($tiempo),
    						);
    				}
    				//echo $tiempoInicio;exit;
    				$tiempoInicio =$tiempo;
    				$dato+=count($datos);
    			}
    		}
    		
    			$respuesta['res'] = $result;
    			$respuesta['total'] = count($dato);
    		}
    
    	echo CJSON::encode($respuesta);
    }
    
    public function actionBusquedaAbogadosAdmisible(){
		$respuesta = array();
		$respuesta['res'] = array();
		$respuesta['total'] = 0;
		if(isset($_POST['id_area'])&& $_POST['id_area'] !=''&&(isset($_POST['fecha_conciliacion'])&& $_POST['fecha_conciliacion'] !='')&&
					(isset($_POST['hora_conciliacion'])&& $_POST['hora_conciliacion'] !='')&& in_array($_POST['clase'], Yii::app()->params['clase'])){
			$data = MFuncionarios::model()->with('idArea')->findAll('id_area_padre=:id_area_padre AND id_funcionario not in
																		(SELECT id_funcionario FROM admisible.t_citas_denuncias_admisibles 
																				WHERE id_area=:id_area AND fecha_conciliacion=:fecha_conciliacion AND hora_conciliacion=:hora_conciliacion)',
																	array(':id_area_padre'=>$_POST['id_area'],':id_area'=>$_POST['id_area'],'fecha_conciliacion'=>$_POST['fecha_conciliacion'],':hora_conciliacion'=>$_POST['hora_conciliacion']));
			$respuestaConsulta =array();
			if(count($data)>0){
				foreach ($data AS $k =>$v){
					$respuesta2['id'] = $v->id_funcionario;
					$respuesta2['text'] = CHtml::encode($v->idDatoContacto->nombre_contacto.' '.$v->idDatoContacto->apellido_contacto);
					$respuestaConsulta[]= $respuesta2;
				}
	
			}
			$respuesta['res'] = $respuestaConsulta;
			$respuesta['total'] = count($data);
		}
		echo CJSON::encode($respuesta);
	}
    
	/* ESTRUCTURA DE CONFIGURACION DE BUSQUEDA
	 * case 'NOMBRE_A_IDENTIFIACAR_CONFIGURACION' :  $configuracion=array(
	        		'clase'=>'NOMBRE_CLASE A CONSULTAR',
	        		'id_busqueda'=>'VALOR QUE VA A CONTENER LA OPCION DEL SELECT',
	        		'nombre_campo'=>'NOMBRE QUE VA A CONTENER LA OPCION DEL SELECT',
	        		'id_dependiente'=>array(array(
	 * 											'VALOR DEL QUE DEPENDE LA BUSQUEDA',
	 * 											'requerido',// ES OPCIONAL, SI NO ES REQUERIDO NO COLOCARLO
	 * 											'tipo'=>'TIPO DE DATO',//int, text 
	 * 											'condicion'=>'CONDICION')), // ES OPCIONAL POR DEFECTO LA CONDICION ES '=', ACEPTA '!='
	        		'condicion'=>'CONDICION INICIAL', //por ejemplo el estatus de la seleccion, se debe colocar 'TRUE' si no tiene condicion
	        		'join'=>'RELACIONES',
	        		'order'=>'ORDEN QUE MUESTRA LAS OCCIONES'); ASC, DESC
	 * */
    
        private function configuracionBusqueda($model){
        	$configuracion = array();
        	switch ($model){
        		case 'GeoMunicipio' :  $configuracion=array(
	        		'clase'=>'GeoMunicipio',
	        		'id_busqueda'=>'geo_municipio_id',
	        		'nombre_campo'=>'nombre',
	        		'id_dependiente'=>array(array('geo_estado_id','requerido','tipo'=>'int')),
	        		'condicion'=>'nombre !=\'OTRO\' ',
	        		'order'=>' nombre ASC');
        		break;
        		case 'GeoParroquia' :  $configuracion=array(
	        		'clase'=>'GeoParroquia',
	        		'id_busqueda'=>'geo_parroquia_id',
	        		'nombre_campo'=>'nombre',
	        		'id_dependiente'=>array(array('geo_municipio_id','requerido','tipo'=>'int')),
	        		'condicion'=>'nombre !=\'OTRA\' ',
	        		'order'=>'nombre ASC');
        		break;
        		
        	}
        	return $configuracion;
        
        }
  	public function actionBusquedaInfraccion() {
        $respuesta = array();
        
        if(isset($_GET['term'] ) && $_GET['term']!=" "&& $_GET['term']!="" ){
           $data= MRubros::model()->findAll("nombre_rubro like :rubro",
                                                            array(':rubro'=>"%".strtoupper(trim($_GET['term']))."%",
                                                                  ));
            if(count($data)>0){
		foreach ($data AS $k =>$v){
                    $respuesta2['id'] = $v->id_rubro;
                    $respuesta2['label'] = CHtml::encode($v->nombre_rubro);
                    $respuesta2['value'] = CHtml::encode($v->nombre_rubro);
                    $respuesta[]= $respuesta2;
		}
                echo CJSON::encode($respuesta);
            }      
        }						
    } 
        
        
        
}
