<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
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
				'actions'=>array('index','view',/*'create',*/'update','admin','delete'),
				//'expression'=>'Yii::app()->user->getState(\'rol\')==\'administrador\'',
				'roles' => array('create'),
			),
			array('allow','actions' => array('create'),	'roles' => array('create')),
			

			array('allow','actions' => array('View'), 'roles' => array('usuarios/User/View')),
			array('allow','actions' => array('Create'), 'roles' => array('usuarios/User/Create')),
			array('allow','actions' => array('Update'), 'roles' => array('usuarios/User/Update')),
			array('allow','actions' => array('Admin'), 'roles' => array('usuarios/User/Admin')),			
			
			
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('cambioPassw'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->renderPartial('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$getPost=false;	
		
		////////////////////////////////////////////////////////////////////////////////////////////
		
		
		$model=new Usuario('reg');
		$model->bo_activado=1;
		$modelAA=new AuthAssignment;
		//

		if(isset($_POST['Usuario'])) {

			$getPost=true;
			
			$model->attributes=$_POST['Usuario'];
			$modelAA->attributes=$_POST['AuthAssignment'];

			
			$valido=true;
			//$valUsuario = array('cedula','nombre1','apellido1','ente_id','tx_usuario','tx_contrasena','rol_id','correo');

			$valido=$model->validate()/*($valUsuario)*/&&$valido;

			$valido=$modelAA->validate()&&$valido;

			if($valido) {
				$transaction = $model->dbConnection->beginTransaction();
				try {
					
					$model->tx_contrasena=md5($model->tx_contrasena);
					$model->tx_usuario=strtolower($model->tx_usuario);
					
					//persona
					$persona = new GenPersona();
							if($peraux = GenPersona::model()->findByAttributes(array('cedula'=>$model->cedula))) {
                         	
						 	$peraux->nacionalidad = $model->nacionalidad;
						 	$peraux->cedula = $model->cedula;
						 	$peraux->nombre1 = mb_strtoupper($model->nombre1, "utf-8");
						 	$peraux->nombre2 = mb_strtoupper($model->nombre2, "utf-8");
						 	$peraux->apellido1 = mb_strtoupper($model->apellido1, "utf-8");
						 	$peraux->apellido2 = mb_strtoupper($model->apellido2, "utf-8");
						 	$peraux->correo = $model->correo;
						 	$peraux->telefono=	$model->telefono;

                         	$persona=$peraux;
                        }		
                        else {
		 					$persona->nacionalidad=$model->nacionalidad;
							$persona->cedula=$model->cedula;
						 	$persona->nombre1 = mb_strtoupper($model->nombre1, "utf-8");
						 	$persona->nombre2 = mb_strtoupper($model->nombre2, "utf-8");
						 	$persona->apellido1 = mb_strtoupper($model->apellido1, "utf-8");
						 	$persona->apellido2 = mb_strtoupper($model->apellido2, "utf-8");		
							$persona->correo=$model->correo;
							$persona->telefono=	$model->telefono;
							                    	
                        }

					$persona->usuario_id_aud=Yii::app()->user->id;
					$persona->save();
			
					//usuario
					$model->persona_id=$persona->id_persona;
					$model->usuario_id_aud=Yii::app()->user->id;
					$model->save();
					
					//asigno perfil al usuario
					$auth=Yii::app()->authManager;
					$auth->assign($modelAA->itemname,$model->id_usuario);					
					
					//guardo los instituciones asociadas
					/*foreach ($model->instituciones as $iu) {
						$modelUsIn=new UsuarioInstitucion();
						$modelUsIn->usuario_id=$model->id_usuario;
						$modelUsIn->institucion_id=$iu;
						$modelUsIn->usuario_id_aud=Yii::app()->user->id;
						$modelUsIn->save();
					}	*/
					
					
					
					$transaction->commit();
					Yii::app()->user->setFlash('success', 'Para ver el registro haga click '.CHtml::link(' <i class="right zoom in icon"></i>',array('/usuario/user/view','id'=>$model->id_usuario),array('target'=>'_blank','class'=>'fancybox mini ui icon circular  button')).'<br/> Para modificar el registro haga click '.CHtml::link('<i class="edit in icon"></i>',array('/usuario/user/update','id'=>$model->id_usuario),array('class'=>'mini ui icon circular  button')));
					
					$this->redirect(array('admin'));
					
				} catch(Exception $e) {
					$transaction->rollBack();
					throw new CHttpException($e->getCode(),$e->getMessage());
				}
			}
		}

		if ($getPost && !$valido)
			Yii::app()->user->setFlash('error', 'Por favor corrija los errores del formulario.');

		$this->render('create',array(
			'model'=>$model,
			'getPost'=>$getPost,
			'modelAA'=>$modelAA,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
            
		$model=$this->loadModel($id);
		$model->scenario='reg';
		
		$getPost=false;
		
		$persona = $model->persona;
		$model->nacionalidad=$persona->nacionalidad;
		$model->cedula=$persona->cedula;
		$model->nombre1=$persona->nombre1;
		$model->nombre2=$persona->nombre2;
		$model->apellido1=$persona->apellido1;
		$model->apellido2=$persona->apellido2;
		$model->correo=$persona->correo;
		$model->telefono=$persona->telefono;
		if(!$modelAA=AuthAssignment::model()->find('userid=:userid',array(':userid'=>"$model->id_usuario")))$modelAA=new AuthAssignment();
		/*$io=array();
		foreach ($model->usuarioinstitucions as $key=>$insti) {
			$io[]=$insti->institucion_id;
		}
		$model->instituciones=$io;*/
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$passant=$model->tx_contrasena; 
		if(isset($_POST['Usuario'])) {

			$getPost=true;
			$itemname=$modelAA->itemname;
			$model->attributes=$_POST['Usuario'];
			$modelAA->attributes=$_POST['AuthAssignment'];
			$model->tx_usuario=strtolower($model->tx_usuario);
			$model->usuario_id_aud=Yii::app()->user->id;
			
			
			$valido=true;
			$valido=$model->validate()&&$valido;
			$valido=$modelAA->validate()&&$valido;
			
			if($valido) {
				$transaction = $model->dbConnection->beginTransaction();
				try {
					if($model->tx_contrasena==$passant) {
					} else {
						$model->tx_contrasena=md5($model->tx_contrasena);
					}

						$model->tx_usuario=strtolower($model->tx_usuario);

						$model->cedula=$persona->cedula;
						
						$persona = new GenPersona();
						if($peraux = GenPersona::model()->findByAttributes(array('cedula'=>$model->cedula))) {
								                        	
						 	$peraux->nacionalidad = $model->nacionalidad;
						 	$peraux->cedula = $model->cedula;
						 	$peraux->nombre1 = mb_strtoupper($model->nombre1, "utf-8");
						 	$peraux->nombre2 = mb_strtoupper($model->nombre2, "utf-8");
						 	$peraux->apellido1 = mb_strtoupper($model->apellido1, "utf-8");
						 	$peraux->apellido2 = mb_strtoupper($model->apellido2, "utf-8");
						 	$peraux->correo = $model->correo;
						 	$peraux->telefono=	$model->telefono;

                         	$persona=$peraux;
                        }		
                        else {
		 					$persona->nacionalidad=$model->nacionalidad;
							$persona->cedula=$model->cedula;
						 	$persona->nombre1 = mb_strtoupper($model->nombre1, "utf-8");
						 	$persona->nombre2 = mb_strtoupper($model->nombre2, "utf-8");
						 	$persona->apellido1 = mb_strtoupper($model->apellido1, "utf-8");
						 	$persona->apellido2 = mb_strtoupper($model->apellido2, "utf-8");		
							$persona->correo=$model->correo;
							$persona->telefono=	$model->telefono;
							                    	
                        }			
                        
						$persona->usuario_id_aud=Yii::app()->user->id;   
						$persona->save();
						
						//usuario
						$model->persona_id=$persona->id_persona;
						$model->usuario_id_aud=Yii::app()->user->id;
						$model->save();

						//asigno perfil al usuario
						$auth=Yii::app()->authManager;
                                                $auth->revoke($itemname,$model->id_usuario);
                                                //echo $modelAA->itemname.'-'.$model->id_usuario;exit;
						$auth->assign($modelAA->itemname,$model->id_usuario);	
				
						/*UsuarioInstitucion::model()->updateAll(array('st_usuario_institucion'=>0,'usuario_id_aud'=>Yii::app()->user->id),'usuario_id=:usuario_id AND st_usuario_institucion=true',array(':usuario_id'=>$model->id_usuario));
						UsuarioInstitucion::model()->deleteAll('usuario_id=:usuario_id',array(':usuario_id'=>$model->id_usuario));
						//guardo los instituciones asociadas
						foreach ($model->instituciones as $iu) {
							$modelUsIn=new UsuarioInstitucion();
							$modelUsIn->usuario_id=$model->id_usuario;
							$modelUsIn->institucion_id=$iu;
							$modelUsIn->usuario_id_aud=Yii::app()->user->id;
							$modelUsIn->save();
						}	
						
						*/
						
						$transaction->commit();
						Yii::app()->user->setFlash('success', 'Para ver el registro haga click '.CHtml::link(' <i class="right zoom in icon"></i>',array('/usuario/user/view','id'=>$model->id_usuario),array('target'=>'_blank','class'=>'fancybox mini ui icon circular  button')).'<br/> Para modificar el registro haga click '.CHtml::link('<i class="edit in icon"></i>',array('/usuario/user/update','id'=>$model->id_usuario),array('class'=>'mini ui icon circular  button')));
						
						$this->redirect(array('admin'));
					
				} catch(Exception $e) {
					$transaction->rollBack();
					throw new CHttpException($e->getCode(),$e->getMessage());
				}
			}
		}
		if ($getPost && !$valido)
			Yii::app()->user->setFlash('error', 'Por favor corrija los errores del formulario.');
		$this->render('update',array(
			'model'=>$model,
			'getPost'=>$getPost,
			'modelAA'=>$modelAA,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
				$model=$this->loadModel($id);
				$model->st_usuario=0;
				$model->usuario_id_aud = Yii::app()->user->id;
				$model->save();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCambioPassw()
	{
		
		$model=$this->loadModel(Yii::app()->user->id);
		$model->scenario='cambio';
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuaris'];
			$model->des_password=md5($_POST['Usuario']['newpass']);
			if($model->save()) {
			}
				Yii::app()->user->logout();
				$this->redirect(Yii::app()->homeUrl);
		}

		$this->render('cambioPassw',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Usuario::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'La página solicitada no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
