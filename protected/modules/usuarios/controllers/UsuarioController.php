<?php
class UsuarioController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login','registro','captcha','activaremail','recuperar','recuperar2','preguntasecreta','nuevac','clave','logout','recuperarusuario'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','nueva','temporal'),
				'users'=>array('@'),
			),			
			
			
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xF5F5F5,
				'testLimit'=>1,
			),
		);
	}
	
	public function actionIndex()
	{
		if(!Yii::app()->user->isGuest) {
			if($this->diasDeParada(Usuario::model()->findByPk((int)Yii::app()->user->id))) {
				Yii::app()->user->logout();
				$this->redirect(Yii::app()->homeUrl);
				Yii::app()->end();
			}
		} 
		$this->render('index');
	}
	


	
	public function actionLogin()
	{

		$getPost=false;

		$datospost=false;
		if(!Yii::app()->user->isGuest) {
				$this->redirect(Yii::app()->homeUrl);
		}
		$model=new Usuario('login');
		$Captcha=new Captcha();
		//$Captcha->validate();
		//$Captcha=new Captcha();
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['Usuario']))
		{
			$getPost=true;
			$datospost=true;
			$model->attributes=$_POST['Usuario'];
			$Captcha->attributes=$_POST['Captcha'];
			// validate user input and redirect to the previous page if valid

			if($Captcha->validate()&& $model->validate() && $model->login()) {
					$this->redirect(Yii::app()->homeUrl);
				}
		}
		// display the login form
		$Captcha->verifyCode='';
		$this->render('login',array('model'=>$model,'Captcha'=>$Captcha,'datospost'=>$datospost,'getPost'=>$getPost,));
	}
	
	public function actionNueva()
	{
		
		$getPost=false;
		$valido=true;
		$model=New Usuario('cambio');
		// Uncomment the following line if AJAX validation is needed
		 //$this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			$getPost=false;
			//$model->des_password=md5($_POST['Usuario']['newpass']);
			$valido=$model->validate();
			if($valido) {
				
				$transaction = $model->dbConnection->beginTransaction();
				try {
					
					$user=Usuario::model()->findByAttributes(array('id_usuario'=>Yii::app()->user->id));
					if($user->tx_contrasena!=md5($model->tx_contrasena)) {
						$model->addError('tx_contrasena','Contraseña actual incorrecta.');
					} else {
						$user->tx_contrasena=md5($model->nueva);
						
						$user->usuario_id_aud=Yii::app()->user->id;
						$user->save();
						$transaction->commit();
						Yii::app()->user->logout();
						//Yii::app()->user->setFlash('success', "Cambio de clave exitoso.");
						Yii::app()->user->setFlash('notice', "Registro guardado.");
						$this->redirect(array('/usuario/usuario/login'));
						Yii::app()->end();
					}
				} catch(Exception $e) {
					$transaction->rollBack();
					throw new CHttpException($e->getCode(),$e->getMessage());
				}
			}
				
		}
		if ($getPost && !$valido)
			Yii::app()->user->setFlash('error', 'Por favor corrija los errores del formulario.');
		$this->render('nueva',array(
			'model'=>$model,
			'getPost'=>$getPost,
		));
	}


	
	
	
	public function actionNuevac($cod2)
	{
		if($cod2==''||Yii::app()->user->getState('cod2')!=$cod2) {
			$this->redirect($this->createUrl('/usuario/usuario/recuperar2'));
			Yii::app()->end();
		}
		$model=New Usuario('nuevac');
		// Uncomment the following line if AJAX validation is needed
		 //$this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			//$model->des_password=md5($_POST['Usuario']['newpass']);
			if($model->validate()) {
				$transaction = $model->dbConnection->beginTransaction();
				try {
					$user=Usuario::model()->findByAttributes(array('tx_usuario'=>strtolower(Yii::app()->user->getState('tx_usuario'))));
					$user->tx_contrasena=md5($model->nueva);
					$user->bo_temporal=0;
					if(!Yii::app()->user->isGuest) {
						$user->usuario_id_aud=Yii::app()->user->id;
					} else {
						$user->usuario_id_aud=$user->id_usuario;
					}
					$user->save();
					$transaction->commit();
					Yii::app()->user->logout();
					$this->redirect($this->createUrl('/usuario/usuario/login'));
					Yii::app()->end();
				} catch(Exception $e) {
					$transaction->rollBack();
					throw new CHttpException($e->getCode(),$e->getMessage());
				}
			}	
				
		}

		$this->render('nuevac',array(
			'model'=>$model,
		));
	}
	
	
     public function actionBuscarSaime()
	 {
	 	if(isset($_POST['cedula']))
	 	{
		 $cedula=$_POST['cedula'];
		 $personaSaime=Onidex::model()->find('cedula=:CI',array(':CI'=>$cedula));
		 echo $personaSaime->nombre1.'/'.$personaSaime->nombre2.'/'.$personaSaime->apellido1.'/'.$personaSaime->apellido2.'/'.$personaSaime->nac;
	 	}
	 	else echo '////';
	}
	
	
	
	
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	protected function diasDeParada($regis) {
		if(Yii::app()->params['resCedActivado']==='1'&&$regis->id_rol=='2') {
			date_default_timezone_set('America/Caracas');
			$dia=date('w');
			$encontrado=false;
			if($dia==0) {
				foreach(Yii::app()->params['resCedDom'] as $domingo) {
					if(substr($regis->idRegistroPersona->idPersona->cedula, strlen($regis->idRegistroPersona->idPersona->cedula)-1)==$domingo)
					$encontrado=true;
				}
			} else if($dia==1) {
				foreach(Yii::app()->params['resCedLun'] as $lunes) {
					if(substr($regis->idRegistroPersona->idPersona->cedula, strlen($regis->idRegistroPersona->idPersona->cedula)-1)==$lunes)
					$encontrado=true;
				}	
			} else if($dia==2) {
				foreach(Yii::app()->params['resCedMar'] as $martes) {
					if(substr($regis->idRegistroPersona->idPersona->cedula, strlen($regis->idRegistroPersona->idPersona->cedula)-1)==$martes)
					$encontrado=true;
				}
			} else if($dia==3) {
				foreach(Yii::app()->params['resCedMie'] as $miercoles) {
					if(substr($regis->idRegistroPersona->idPersona->cedula, strlen($regis->idRegistroPersona->idPersona->cedula)-1)==$miercoles)
					$encontrado=true;
				}
			} else if($dia==4) {
				foreach(Yii::app()->params['resCedJue'] as $jueves) {
					if(substr($regis->idRegistroPersona->idPersona->cedula, strlen($regis->idRegistroPersona->idPersona->cedula)-1)==$jueves)
					$encontrado=true;
				}
			} else if($dia==5) {
				foreach(Yii::app()->params['resCedVie'] as $viernes) {
					if(substr($regis->idRegistroPersona->idPersona->cedula, strlen($regis->idRegistroPersona->idPersona->cedula)-1)==$viernes)
					$encontrado=true;
				}
			} else if($dia==6) {
				foreach(Yii::app()->params['resCedsab'] as $sabado) {
					if(substr($regis->idRegistroPersona->idPersona->cedula, strlen($regis->idRegistroPersona->idPersona->cedula)-1)==$sabado)
					$encontrado=true;
				}
			}
			if(!$encontrado) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
    }
	
	public function correo($aquien,$aquiennombre,$mensaje)
	{
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = Yii::app()->params['mailHost'];/*'172.16.0.20';*/
		$mail->Port = Yii::app()->params['mailPortSsl'];
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Username = Yii::app()->params['mailUsername'];/*'xmolina';*/
		$mail->Password = Yii::app()->params['mailUserPassw'];
		$mail->SetFrom(Yii::app()->params['mailRemitente'], Yii::app()->params['nombreRemitente']);
		
		$mail->Subject = Yii::app()->params['mailAsunto'];
		//$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->MsgHTML($mensaje);
		$mail->AddAddress($aquien, $aquiennombre);
		
		if(!$mail->Send()) {
		   throw new CHttpException(500,'EL servidor de correo esta inhabilitado temporalmente intentelo mas tarde.',500);
		}
		else {
		   //echo 'Mail enviado!';
		}
		

	}
}
