<?php
class FuncionesPublicas
{

	/**
	 * Timestamp Unix
	 *
	 * Funcion que genera el Timestamp de Unix tomando en cuenta
	 * la zona horaria de -4:30 GMT. Esta fecha/hora se inserta tomando
	 * en cuenta la hora de Venezuela y no la hora del meridiano 0 como
	 * generalmente lo hace la funcion el Timestamp de Unix.
	 *
	 * @return int $caracasDateTime Timestamp de Unix de la Hora de Caracas.
	 */
	public static function timestampUnix($fecha='') {

		if($fecha==''){
			$dateTimeZoneCaracas = new DateTimeZone ( "America/Caracas" );
			$dateTimeCaracas = new DateTime ( "now", $dateTimeZoneCaracas );
			$caracasOffset = $dateTimeZoneCaracas->getOffset ( $dateTimeCaracas );
			$caracasDateTime = strtotime ( date ( "d-m-Y H:i:s", time () + $caracasOffset ) );
		}else{
			$caracasDateTime = strtotime($fecha);
		}
		return $caracasDateTime;
	}
        public static function timestampUnixSinHoraMinSeg($fecha='') {

		if($fecha==''){
			$dateTimeZoneCaracas = new DateTimeZone ( "America/Caracas" );
			$dateTimeCaracas = new DateTime ( "now", $dateTimeZoneCaracas );
			$caracasOffset = $dateTimeZoneCaracas->getOffset ( $dateTimeCaracas );
			$caracasDateTime = strtotime ( date ( "d-m-Y", time () + $caracasOffset ) );
		}else{
			date_default_timezone_set('America/Caracas');
			$caracasDateTime = strtotime($fecha);
		}
		return $caracasDateTime;
	}


	/**
	* Conviente Timestamp Unix a Date con la hora
	*
	* Recibe una fecha Timestamp de Unix y la convierte
	* a una fecha tipo Date con el siguiente formato
	* Recibe un array donde se especifica el formato deseado
	* si no es espicificado el forma retornara d/m/Y
	*
	* @param int $fecha
	*        	Timestamp Unix
	* @param array $opcion
	*/
	public static function convertirUnixADate($fecha,$opcion= array()) {
		$fechaConvertida = NULL;
		if($fecha!=''){

			$formato = (array_key_exists('formato',$opcion))?$opcion['formato']:'d/m/Y';
			$dt = new DateTime ( "@$fecha" );
			$fechaConvertida =  $dt->format ($formato);
		}

		return$fechaConvertida;
	}

	/**
	* Devuelve la direrencia que existe entre 2 fecha
	*
	* Recibe una fecha Timestamp de Unix  y el formato que desea
	* la variable opcion es un array que devolvera los parametros solicitado
	* @param array $opcion
	* @param date $opcion['fecha_inicio']
	* 		fecha de inicio
	* @param date $opcion['fecha_fin']
	* 		fecha fin
	* @param array $opcion['fecha_fin']
	*/
	public static function diferenciaFecha($opcion= array()) {
		$retornoVariables = array();
		
		$fecha_inicio = (array_key_exists('fecha_inicio',$opcion))?$opcion['fecha_inicio']:date('Y/m/d H:i:s');
		$fecha_fin = (array_key_exists('fecha_fin',$opcion))?$opcion['fecha_fin']:date('Y/m/d H:i:s');
		$retorno = (array_key_exists('retorno',$opcion))?$opcion['retorno']:array();
		$date = new DateTime($fecha_inicio); // Fecha actual
		$date2 = new DateTime($fecha_fin); // Segunda fecha
		$date->setTimeZone( new DateTimeZone('America/Caracas') ); // Definimos seTimeZone para asegurarnos de que sea la hora actual del lugar donde estamos
		$interval = $date->diff( $date2 ); // Restamos la Fecha1 menos la Fecha2

		foreach ($retorno as $key =>$value){
			$retornoVariables[$value]= $interval->$value;
		}

		return$retornoVariables;
	}
	public static function correo($email,$nombre,$asunto='SUNDDE',$mensaje)
	{

		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail->IsSMTP();
// 		$mail->SMTPDebug= TRUE;
		$mail->Host = Yii::app()->params['mailHost'];/*'172.16.0.20';*/
		$mail->Port = Yii::app()->params['mailPortSsl'];
		$mail->CharSet = "utf-8";
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
                
		$mail->Username = Yii::app()->params['mailUsername'];
		$mail->Password = Yii::app()->params['mailUserPassw'];
		$mail->SetFrom( Yii::app()->params['mailRemitente'],  Yii::app()->params['nombreRemitente']);
		$mail->WordWrap = 50;
		$mail->isHTML(true);

		$mail->Subject = $asunto;
		$mail->AddAddress($email, $nombre);
		$mail->MsgHTML($mensaje);

		if(!$mail->Send()) {
                                    $mail->SMTPDebug=4;
                                    $mail->Send();
                                    $mail->ErrorInfo;
// 			Yii::app()->user->setFlash('info', "No se pudo enviar el Correo Electrónico");
			//throw new CHttpException(500,'EL servidor de correo esta inhabilitado temporalmente intentelo mas tarde.',500);
		}
		else{
// 			Yii::app()->user->setFlash('info', "Envio de Correo Electrónico");
		}

	}
	public static function mensajeTexto($opcion=array())
	{
		$buscar   = array("(", ")", "-"," ");
		$telefono= str_replace($buscar, '', $opcion['telefono']);
		
		if(strlen($telefono)<11)
			$telefono='0'.$telefono;
		$mensaje = urlencode($opcion['mensaje']);
		
		$url = 'http://mensajeria.sundde.gob.ve/index.php?app=ws&format=json&h=33605feed45c8276a86c1d8a2c674edd&u='.Yii::app()->params['userMensajeria'].'&p='.Yii::app()->params['passMensajeria'].
				'&op=pv&to='.$telefono.'&msg='.$mensaje;
		$respuesta = Yii::app()->CURL->run($url);

	}
	
	

	/**
	* Generea los pdf
	*
	* Recibe una fecha Timestamp de Unix  y el formato que desea
	* la variable opcion es un array que devolvera los parametros solicitado
	* @param array $opcion
	* @param date $opcion['fecha_inicio']
	* 		fecha de inicio
	* @param date $opcion['fecha_fin']
	* 		fecha fin
	* @param array $opcion['fecha_fin']
	*/
	public static function generarPdf($opcion= array()) {

		$header = (array_key_exists('header',$opcion))?$opcion['header']:
							'<div>
								<div>
									<img src="'.Yii::app()->baseUrl.'/images/banner.jpg"/>
								</div>
							
						</div>';

		$footer = (array_key_exists('footer',$opcion))?$opcion['footer']:
							'<div>
								<div>
									<img src="'.Yii::app()->baseUrl.'/images/cintillo_footer.png"/>
								</div>
						</div>';
		$html = (array_key_exists('html',$opcion))?$opcion['html']:"";
		$tipo_hoja = (array_key_exists('tipo_hoja',$opcion))?$opcion['tipo_hoja']:'Letter';
		$nombre_footer = (array_key_exists('nombre_footer',$opcion))?$opcion['nombre_footer']:'SI-SUNDDE';
		$nombre_archivo = (array_key_exists('nombre_archivo',$opcion))?$opcion['nombre_archivo']:'si_sundde';
		$destino = (array_key_exists('destino_documento',$opcion))?$opcion['destino_documento']:'D';
		
		date_default_timezone_set('America/Caracas');
		$pdf = Yii::createComponent('application.extensions.mpdf60.mpdf');
		$mpdf=new mPDF('utf8',$tipo_hoja,'','',2,15,40,20,0,0,'L');
		//$mpdf = new mPDF('',    // mode - default ''
		//'A4',    // format - A4, for example, default ''
		//0,     // font size - default 0
		//'',    // default font family
		//'',    // 15 margin_left
		//'',    // 15 margin right
		//25,     // 16 margin top
		//55,    // margin bottom
		//'',     // 9 margin header
		//'',     // 9 margin footer
		//'L');  // L - landscape, P - portrait
		
		
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetHTMLHeader($header,'O');
		$mpdf->SetHTMLHeader($header,'E');
		$mpdf->SetHTMLFooter($footer);
		$mpdf->WriteHTML($html);
		$mpdf->Output($nombre_archivo.'.pdf',$destino);
// 		$mpdf->Output($acta.'.pdf','I');
		exit;

	}
	
	/**
	 * tempAdminStep
	 *
	 * Funcion utilizada para mantener la busqueda de los admin cuando selecciona los steps de informacion
	 * la funcion recibe un array 
	 * @param array $opcion
	 * @param modelo $opcion['modelo']
	 * 		Modelo
	 * @param text $opcion['nombreModelo']
	 * 		Nombre del Modelo
	 * @param text $opcion['escenario']
	 */
	public static function tempAdminStep($opcion= array()) {
			$modelAdmin= $opcion['modelo'];
			$nombreModelo =$opcion['nombreModelo'];
			$escenario =(array_key_exists('escenario',$opcion))?$opcion['escenario']:'search';
			//$this->recorro($rules);exit;
			foreach ($modelAdmin->rules()AS $key =>$value){
				if($value[1]=='safe'){
					if (array_key_exists('on',$value)){
						if (is_array($value['on'])){
							if(array_search($escenario,$value['on'])==FALSE){
								foreach ( explode(",", $value[0]) AS $key3 =>$value3){
									$value3=trim($value3);
									if(isset($_GET[$nombreModelo][$value3])){
										Yii::app()->session[$nombreModelo.'_'.$value3]=$modelAdmin->$value3;
									}
									else {
										$modelAdmin->$value3=Yii::app()->session[$nombreModelo.'_'.$value3];
									}
								}
							}
						}else{
							if($value['on'] ==$escenario){
								foreach ( explode(",", $value[0]) AS $key3 =>$value3){
									$value3=trim($value3);
									if(isset($_GET[$nombreModelo][$value3])){
										Yii::app()->session[$nombreModelo.'_'.$value3]=$modelAdmin->$value3;
									}
									else {
										$modelAdmin->$value3=Yii::app()->session[$nombreModelo.'_'.$value3];
									}
								}
							}
						}
					}
				}
			}
	}
	/**
	 * tempAdminStepLimpiar
	 *
	 * Funcion utilizada limpiar las variables de session que son usada para mantener la busqueda de los admin cuando selecciona los steps de informacion
	 * la funcion recibe un array
	 * @param array $opcion
	 * @param modelo $opcion['modelo']
	 * 		Modelo
	 * @param text $opcion['nombreModelo']
	 * 		Nombre del Modelo
	 * @param text $opcion['escenario']
	 */
	public static function tempAdminStepLimpiar($opcion= array()) {
				$modelAdmin= $opcion['modelo'];
				$nombreModelo =$opcion['nombreModelo'];
				$escenario =(array_key_exists('escenario',$opcion))?$opcion['escenario']:'search';
				//$this->recorro($rules);exit;
				foreach ($modelAdmin->rules()AS $key =>$value){
					if($value[1]=='safe'){
						if (array_key_exists('on',$value)){
							if (is_array($value['on'])){
								if(array_search('search',$value['on'])){
									foreach (explode(",", $value[0]) AS $key3 =>$value3){
										unset(Yii::app()->session[trim($nombreModelo.'_'.$value3)]);
									}
								}
							}else{
								if($value['on'] ==$escenario){
									foreach (explode(",", $value[0]) AS $key3 =>$value3){
										unset(Yii::app()->session[trim($nombreModelo.'_'.$value3)]);
									}
								}
							}
						}
					}
				}
	}
	

	public static function esImagen($ruta){
		$imageSizeArray = getimagesize($ruta);
		$imageTypeArray = $imageSizeArray[2];
		
		return (bool)(in_array($imageTypeArray , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)));
	}


	
	public static function EnvioInformacionUsuario($opciones= array()){
		$id_mensaje = $opciones['id_mensaje'];
		$datos_funcionario = $opciones['datos_funcionario'];
		$nombre_usuario = $opciones['nombre_usuario'];
		$contrasenia_usuario = $opciones['contrasenia_usuario'];
		$correo = $opciones['correo_usuario'];
		$mensaje = MMensajes::model()->findByPk($id_mensaje);
		if($mensaje){
			$mensajeHtml = str_replace('[{datos_funcionarios}]', $datos_funcionario, $mensaje->descripcion_mensaje);
			$mensajeHtml = str_replace('[{nombre_usuario}]', $nombre_usuario, $mensajeHtml);
			$mensajeHtml = str_replace('[{contrasenia_usuario}]', $contrasenia_usuario, $mensajeHtml);
			
			FuncionesPublicas::correo($correo, 'Compatriota',$mensaje->titulo, $mensajeHtml);
		}
	
	}
	public static function nombreMes($opcion=array()){
		$nombreMes='';
		if(array_key_exists('mes',$opcion)){
			switch ($opcion['mes']){
				case 1 : $nombreMes = 'ENERO'; break;
				case 2 : $nombreMes = 'FEBRERO'; break;
				case 3 : $nombreMes = 'MARZO'; break;
				case 4 : $nombreMes = 'ABRIL'; break;
				case 5 : $nombreMes = 'MAYO'; break;
				case 6 : $nombreMes = 'JUNIO'; break;
				case 7 : $nombreMes = 'JULIO'; break;
				case 8 : $nombreMes = 'AGOSTO'; break;
				case 9 : $nombreMes = 'SEPTIEMBRE'; break;
				case 10 : $nombreMes = 'OCTUBRE'; break;
				case 11 : $nombreMes = 'NOVIEMBRE'; break;
				case 12 : $nombreMes = 'DICIEMBRE'; break;
			}
		}
		return $nombreMes;
	}
}
	