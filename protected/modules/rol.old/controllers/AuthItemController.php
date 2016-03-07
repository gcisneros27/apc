<?php

class AuthitemController extends Controller
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
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','createTarea','createOperacion','admin','delete'),
				'users'=>array('@'),
			),*/
			
			array('allow','actions' => array('ViewOperacion'),	'roles' => array('rol/AuthItem/ViewOperacion')),
			array('allow','actions' => array('ViewTarea'),	'roles' => array('rol/AuthItem/ViewTarea')),
			array('allow','actions' => array('UpdateTarea'),	'roles' => array('rol/AuthItem/UpdateTarea')),
			array('allow','actions' => array('UpdateOperacion'),	'roles' => array('rol/AuthItem/UpdateOperacion')),
			array('allow','actions' => array('admin'),	'roles' => array('rol/authItem/admin')),
			array('allow','actions' => array('create'),	'roles' => array('rol/authItem/create')),
			array('allow','actions' => array('createOperacion'),	'roles' => array('rol/authItem/createOperacion')),
			array('allow','actions' => array('createTarea'),	'roles' => array('rol/authItem/createTarea')),
			array('allow','actions' => array('delete'),	'roles' => array('rol/authItem/delete')),
			array('allow','actions' => array('update'),	'roles' => array('rol/authItem/update')),
			array('allow','actions' => array('view'),	'roles' => array('rol/authItem/view')),
			array('allow','actions' => array('AdministrarModulos'),	'roles' => array('rol/AuthItem/AdministrarModulos')),
			array('allow','actions' => array('VerReglas'),	'roles' => array('rol/AuthItem/VerReglas')),
			array('allow','actions' => array('ViewPermisos'),	'roles' => array('rol/AuthItem/ViewPermisos')),
			array('allow','actions' => array('BuscarAcciones'),	'roles' => array('rol/AuthItem/BuscarAcciones')),
			array('allow','actions' => array('ExportarPermiso'), 'roles' => array('rol/AuthItem/ExportarPermiso')),

				
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
		$this->layout='//layouts/main_emergente';
		$model= $this->loadModel($id);
		$connection=Yii::app()->db;
		$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 2 and aic.parent = '$model->name'";
		$command=$connection->createCommand($sql);
		$rolesChild=$command->queryAll();	
			
		$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 1 and aic.parent = '$model->name'";
		$command=$connection->createCommand($sql);
		$tareasChild=$command->queryAll();
		
		$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name'";
		$command=$connection->createCommand($sql);
		$operacionesChild=$command->queryAll();	
		
		
		$this->render('view',array(
			'model'=>$model,
			'rolesChild'=>$rolesChild,
			'tareasChild'=>$tareasChild,
			'operacionesChild'=>$operacionesChild,
		));
	}
	
	public function actionViewOperacion($id)
	{
		$this->layout='//layouts/main_emergente';
		$model= $this->loadModel($id);
		$connection=Yii::app()->db;
		$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name'";
		$command=$connection->createCommand($sql);
		$operacionesChild=$command->queryAll();		
		$this->render('viewOPeracion',array(
			'model'=>$model,
			'operacionesChild'=>$operacionesChild,
		));
	}
	public function actionViewTarea($id)
	{
		$this->layout='//layouts/main_emergente';
		$model= $this->loadModel($id);
		$connection=Yii::app()->db;
		$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 1 and aic.parent = '$model->name'";
		$command=$connection->createCommand($sql);
		$tareasChild=$command->queryAll();
		
		$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name'";
		$command=$connection->createCommand($sql);
		$operacionesChild=$command->queryAll();		
		$this->render('viewTarea',array(
			'model'=>$model,
			'tareasChild'=>$tareasChild,
			'operacionesChild'=>$operacionesChild,
		));
	}
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	
	public function actionCreate()
	{
		$model=new Authitem();
		$getPost=false;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Authitem']))
		{
			$model->attributes=$_POST['Authitem'];
			$getPost=true;
			//if($model->save())
			if($model->validate()){
				$transaction = Yii::app()->db->beginTransaction();
				try {
					$auth=Yii::app()->authManager;
		    		$bizRule='';
					$auth->createRole($model->name, $model->description, $bizRule);
					
					if(isset($_POST['roles'])){
						$roles=$_POST['roles'];
						for($i=0;$i<count($roles);$i++) {
							$auth->addItemChild($model->name,$roles[$i]);
						}
					}
					
					if(isset($_POST['tareas'])){
						$tareas=$_POST['tareas'];
						for($i=0;$i<count($tareas);$i++) {
							$auth->addItemChild($model->name,$tareas[$i]);
						}
					}					

					if(isset($_POST['operaciones'])){
						$operaciones=$_POST['operaciones'];
						for($i=0;$i<count($operaciones);$i++) {
							$auth->addItemChild($model->name,$operaciones[$i]);
						}
					}
					
					/*if(isset($_POST['Authitem']['rol_name'])){
						$rolesPadre=$_POST['Authitem']['rol_name'];
						foreach ($rolesPadre AS $key =>$value){
							$auth->addItemChild($value,$model->name);
						}
					}*/
						$transaction->commit();
	                        Yii::app()->user->setFlash('success', 'Registro guardado exitósamente. 
												<br/> Para ver el registro haga click '.CHtml::link('Aquí',array('view','id'=>$model->name),array('target'=>'_blank','class'=>'fancybox')).'
												<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('update','id'=>$model->name)));
				
						$this->redirect(array('admin'));
                     }
             	catch (Exception $e){
             		throw new CHttpException(400,$e->getMessage());
           			$transaction->rollBack();
              	}
              	
				$auth=Yii::app()->authManager;
		    	$bizRule='';
		    	
			}
		}

		$roles=CHtml::listData(Authitem::model()->findAll('type=:tipo AND name!=:name1 AND name!=:name2',array(':tipo'=>2,':name1'=>'guest',':name2'=>'authenticated')),"name","name");
		$tareas=CHtml::listData(Authitem::model()->findAll('type=:tipo',array(':tipo'=>1)),"name","name");
		$operaciones=CHtml::listData(Authitem::model()->findAll('type=:tipo',array(':tipo'=>0)),"name","name");
		
		$rolesChild=array();
		$tareasChild=array();
		$operacionesChild=array();
		
		//$rolPadre = CHtml::listData(Authitem::model()->findAll('type=:tipo AND name!=:name1 AND name!=:name2',array(':tipo'=>2,':name1'=>'guest',':name2'=>'authenticated')),"name","name");
		

		$this->render('create',array(
			'model'=>$model,'roles'=>$roles,'tareas'=>$tareas,'operaciones'=>$operaciones,
		 	'rolesChild'=>$rolesChild,'tareasChild'=>$tareasChild,'operacionesChild'=>$operacionesChild,
			'getPost'=>$getPost//,'rolPadre'=>$rolPadre
		));
	}
	
	public  function actionCreateTarea(){
		$model=new Authitem;
		$getPost=false;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Authitem']))
		{
			$model->attributes=$_POST['Authitem'];
			$getPost=true;
			//if($model->save())
			if($model->validate()){
				$auth=Yii::app()->authManager;
		    	$bizRule='';
		    	
				try
				{
					$auth->createTask($model->name, $model->description, $bizRule);
					if(isset($_POST['roles'])){
						$roles=$_POST['roles'];
						for($i=0;$i<count($roles);$i++) {
							$auth->addItemChild($model->name,$roles[$i]);
						}
					}
					
					if(isset($_POST['tareas'])){
						$tareas=$_POST['tareas'];
						for($i=0;$i<count($tareas);$i++) {
							$auth->addItemChild($model->name,$tareas[$i]);
						}
					}					

					if(isset($_POST['operaciones'])){
						$operaciones=$_POST['operaciones'];
						for($i=0;$i<count($operaciones);$i++) {
							$auth->addItemChild($model->name,$operaciones[$i]);
						}
					}	
					Yii::app()->user->setFlash('success', 'Registro guardado exitósamente. <br/> Para ver el registro haga click '.CHtml::link('Aquí',array('Authitem/view','id'=>$model->name),array('target'=>'_blank','class'=>'fancybox')).'<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('Authitem/update','id'=>$model->name)));
					$this->redirect(array('admin'));
				}
				catch(Exception $e) // an exception is raised if a query fails
				{
				    throw new CHttpException('500','No se puede crear el Item.');
				    
					$this->render('create',array(
						'model'=>$model,
					));
				}	    	
		    	
		    	//$auth->createRole($model->name, $model->description, $bizRule);
					//$this->redirect(array('view','id'=>$model->name));
			}
		}

		$tareas=CHtml::listData(Authitem::model()->findAll('type=:tipo',array(':tipo'=>1)),"name","name");
		$operaciones=CHtml::listData(Authitem::model()->findAll('type=:tipo',array(':tipo'=>0)),"name","name");
				
		$tareasChild=array();
		$operacionesChild=array();
		
		
		/*
		foreach($roles as $i=>$rol) {
					
		print($rol->name);echo "<br/><br/><br/>";
		}
		die();
		*/
		$this->render('createTarea',array(
												'model'=>$model,
												'tareas'=>$tareas,'operaciones'=>$operaciones,
		 										'tareasChild'=>$tareasChild,'operacionesChild'=>$operacionesChild,
												'getPost'=>$getPost,
		));
	
	}
	
	
	public function actionCreateOperacion(){
		$model=new Authitem;
		$getPost=false;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Authitem']))
		{
			$model->attributes=$_POST['Authitem'];
			$getPost=true;
			//if($model->save())
			if($model->validate()){
				$auth=Yii::app()->authManager;
		    	$bizRule='';
		    	
				try
				{
					$auth->createOperation($model->name, $model->description, $bizRule);
					if(isset($_POST['roles'])){
						$roles=$_POST['roles'];
						for($i=0;$i<count($roles);$i++) {
							$auth->addItemChild($model->name,$roles[$i]);
						}
					}
					
					if(isset($_POST['tareas'])){
						$tareas=$_POST['tareas'];
						for($i=0;$i<count($tareas);$i++) {
							$auth->addItemChild($model->name,$tareas[$i]);
						}
					}					

					if(isset($_POST['operaciones'])){
						$operaciones=$_POST['operaciones'];
						for($i=0;$i<count($operaciones);$i++) {
							$auth->addItemChild($model->name,$operaciones[$i]);
						}
					}	
					Yii::app()->user->setFlash('success', 'Registro guardado exitósamente. <br/> Para ver el registro haga click '.CHtml::link('Aquí',array('Authitem/view','id'=>$model->name),array('target'=>'_blank','class'=>'fancybox')).'<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('Authitem/update','id'=>$model->name)));
					$this->redirect(array('admin'));
				}
				catch(Exception $e) // an exception is raised if a query fails
				{
				    throw new CHttpException('500','No se puede crear el Item.');
				    
					$this->render('create',array(
						'model'=>$model,
					));
				}	    	
		    	
		    	//$auth->createRole($model->name, $model->description, $bizRule);
					//$this->redirect(array('view','id'=>$model->name));
			}
		}

		$roles=array();//CHtml::listData(Authitem::model()->findAll('type=:tipo',array(':tipo'=>2)),"name","name");
		$tareas=CHtml::listData(Authitem::model()->findAll('type=:tipo',array(':tipo'=>1)),"name","name");
		$operaciones=CHtml::listData(Authitem::model()->findAll('type=:tipo',array(':tipo'=>0)),"name","name");
				
		$rolesChild=array();
		$tareasChild=array();
		$operacionesChild=array();
		
		
		/*
		foreach($roles as $i=>$rol) {
					
		print($rol->name);echo "<br/><br/><br/>";
		}
		die();
		*/
		$this->render('createOperacion',array(
			'model'=>$model,'roles'=>$roles,'tareas'=>$tareas,'operaciones'=>$operaciones,
		 	'rolesChild'=>$rolesChild,'tareasChild'=>$tareasChild,'operacionesChild'=>$operacionesChild,
			'getPost'=>$getPost,
		));
	
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		$getPost=false;
		$rolesPadre = Authitemchild::model()->findAll('child=:child',array(':child'=>$id));
		$idR = array();
		/*foreach ($rolesPadre AS $key=> $value)
			$idR[]=$value->parent;
		
		$model->rol_name = $idR;*/
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$connection=Yii::app()->db;
					
		if(isset($_POST['Authitem']))
		{
			$auth=Yii::app()->authManager;
			$model->attributes=$_POST['Authitem'];
			$getPost=true;
			if (isset($_POST['roles']))	$roles_hijos=$_POST['roles'];else $roles_hijos=array();
			if (isset($_POST['tareas']))	$tareas_hijos=$_POST['tareas'];else $tareas_hijos=array();
			if (isset($_POST['operaciones']))	$operaciones_hijos=$_POST['operaciones'];else $operaciones_hijos=array();
			//$model->usuario_id_aud=Yii::app()->user->id;
			if($model->save()){
				$transaction = Yii::app()->db->beginTransaction();
				try {
				
					//OBTENER TODS LOS ITEM HIJOS
					$itemsHijos=$auth->getItemChildren($model->name);
					
					//ELIMINAR ITEM HIJOS DEL ITEM A MODIFICAR
					foreach ($itemsHijos as $itemsHijo) {
						$auth->removeItemChild($model->name,$itemsHijo->name);
					} 
					//AGREGAR NUEVOS ITEM HIJOS ASOCIADOS
					for ($i=0;$i<count($roles_hijos);$i++)	$auth->addItemChild($model->name,$roles_hijos[$i]);
					for ($i=0;$i<count($tareas_hijos);$i++)	$auth->addItemChild($model->name,$tareas_hijos[$i]);
					for ($i=0;$i<count($operaciones_hijos);$i++) $auth->addItemChild($model->name,$operaciones_hijos[$i]);
					
					//Yii::app()->user->setFlash('success', "Rol ha sido creado exitósamente");
					//$this->redirect(array('view','id'=>$model->name));
					
					$transaction->commit();
					Yii::app()->user->setFlash('success', 'Registro guardado exitósamente. <br/> Para ver el registro haga click '.CHtml::link('Aquí',array('view','id'=>$model->name),array('target'=>'_blank','class'=>'fancybox'))
											.'<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('update','id'=>$model->name)));
						
					$this->redirect(array('admin'));					
					}
					catch (Exception $e){
						throw new CHttpException(400,$e->getMessage());
						$transaction->rollBack();
					}
					exit;
				
			}
				
		}
		
		if ($model)	{
			//PADRES
			$sql="select * from seguridad.authitem as ai where ai.type = 2 and ai.\"name\" not in (select aic.child from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 2 and aic.parent = '$model->name') and ai.\"name\"!='$model->name' and ai.\"name\"!='guest' and ai.\"name\"!='authenticated'";
			$command=$connection->createCommand($sql);
			$roles=$command->queryAll();
			$roles=$this->limpiarItems($roles,$model->name);
			
			$sql="select * from seguridad.authitem as ai where ai.type = 1 and ai.\"name\" not in (select aic.child from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 1 and aic.parent = '$model->name') and ai.\"name\"!='$model->name'";
			$command=$connection->createCommand($sql);
			$tareas=$command->queryAll();
			$tareas=$this->limpiarItems($tareas,$model->name);

			$sql="select * from seguridad.authitem as ai where ai.type = 0 and ai.\"name\" not in (select aic.child from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name') and ai.\"name\"!='$model->name'";
			$command=$connection->createCommand($sql);
			$operaciones=$command->queryAll();
			$operaciones=$this->limpiarItems($operaciones,$model->name);			

			//HIJOS
			$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 2 and aic.parent = '$model->name'";
			$command=$connection->createCommand($sql);
			$rolesChild=$command->queryAll();				

			$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 1 and aic.parent = '$model->name'";
			$command=$connection->createCommand($sql);
			$tareasChild=$command->queryAll();	

			$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name'";
			$command=$connection->createCommand($sql);
			$operacionesChild=$command->queryAll();	

			/*$sql="select * from seguridad.authitem as ai where ai.type = 2 and ai.\"name\" in (
										select aic.parent 
											from seguridad.authitemchild aic
											join seguridad.authitem as ai on ai.\"name\"=aic.parent 
										where ai.type = 2 and
											aic.child = '$model->name'
										
										) and ai.\"name\"!='guest' and ai.\"name\"!='authenticated'";
			$command=$connection->createCommand($sql);
			$rolPadre=$command->queryAll();	*/
		}
		else {
			$roles=Authitem::model()->findAll('type=:tipo',array(':tipo'=>2));
			$tareas=Authitem::model()->findAll('type=:tipo',array(':tipo'=>1));
			$operaciones=Authitem::model()->findAll('type=:tipo',array(':tipo'=>0));			
			//$rolPadre = CHtml::listData(Authitem::model()->findAll('type=:tipo AND name!=:name1 AND name!=:name2',array(':tipo'=>2,':name1'=>'guest',':name2'=>'authenticated')),"name","name");
		
			$rolesChild=array();
			$tareasChild=array();
			$operacionesChild=array();
		}
		
		//print_r($rolesPadre);exit;

		$this->render('update',array(
				'model'=>$model,
				'roles'=>$roles,
				'tareas'=>$tareas,
				'operaciones'=>$operaciones,
				'rolesChild'=>$rolesChild,
				'tareasChild'=>$tareasChild,
				//'rolPadre'=>$rolPadre,
				'operacionesChild'=>$operacionesChild,
				'getPost'=>$getPost,
			));
	
	}
	public function actionUpdateTarea($id)
	{
		
		$model=$this->loadModel($id);
		$getPost=false;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$connection=Yii::app()->db;
					
		if(isset($_POST['Authitem']))
		{
			$auth=Yii::app()->authManager;
			$model->attributes=$_POST['Authitem'];
			$getPost=true;
			if (isset($_POST['tareas']))	$tareas_hijos=$_POST['tareas'];else $tareas_hijos=array();
			if (isset($_POST['operaciones']))	$operaciones_hijos=$_POST['operaciones'];else $operaciones_hijos=array();
			//$model->usuario_id_aud=Yii::app()->user->id;
			if($model->save()){
				
				$transaction = Yii::app()->db->beginTransaction();
				try {
					//OBTENER TODS LOS ITEM HIJOS
					$itemsHijos=$auth->getItemChildren($model->name);
				
					//ELIMINAR ITEM HIJOS DEL ITEM A MODIFICAR
					foreach ($itemsHijos as $itemsHijo) {
						$auth->removeItemChild($model->name,$itemsHijo->name);
					} 
					//AGREGAR NUEVOS ITEM HIJOS ASOCIADOS
					for ($i=0;$i<count($tareas_hijos);$i++)	$auth->addItemChild($model->name,$tareas_hijos[$i]);
					for ($i=0;$i<count($operaciones_hijos);$i++) $auth->addItemChild($model->name,$operaciones_hijos[$i]);
					
					$transaction->commit();
					Yii::app()->user->setFlash('success', 'Registro guardado exitósamente. <br/> Para ver el registro haga click '.CHtml::link('Aquí',array('view','id'=>$model->name),array('target'=>'_blank','class'=>'fancybox')).'<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('update','id'=>$model->name)));
					$this->redirect(array('admin'));
				}
				catch (Exception $e){
					throw new CHttpException(400,$e->getMessage());
					$transaction->rollBack();
				}
				exit;
			}
				
		}
		
		if ($model)	{
			//PADRES
			
			$sql="select * from seguridad.authitem as ai where ai.type = 1 and ai.\"name\" not in (select aic.child from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 1 and aic.parent = '$model->name') and ai.\"name\"!='$model->name'";
			$command=$connection->createCommand($sql);
			$tareas=$command->queryAll();
			$tareas=$this->limpiarItems($tareas,$model->name);

			$sql="select * from seguridad.authitem as ai where ai.type = 0 and ai.\"name\" not in (select aic.child from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name') and ai.\"name\"!='$model->name'";
			$command=$connection->createCommand($sql);
			$operaciones=$command->queryAll();
			$operaciones=$this->limpiarItems($operaciones,$model->name);			

			//HIJOS
			$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 1 and aic.parent = '$model->name'";
			$command=$connection->createCommand($sql);
			$tareasChild=$command->queryAll();	

			$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name'";
			$command=$connection->createCommand($sql);
			$operacionesChild=$command->queryAll();				
		}
		else {
			$tareas=Authitem::model()->findAll('type=:tipo',array(':tipo'=>1));
			$operaciones=Authitem::model()->findAll('type=:tipo',array(':tipo'=>0));			
			
			$tareasChild=array();
			$operacionesChild=array();
		}

		
		
   		$this->render('updateTarea',array(
				'model'=>$model,
				'tareas'=>$tareas,
				'operaciones'=>$operaciones,
				'tareasChild'=>$tareasChild,
				'operacionesChild'=>$operacionesChild,
				'getPost'=>$getPost,
			));
	}

	public function actionUpdateOperacion($id)
	{
		$model=$this->loadModel($id);
		$getPost=false;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$connection=Yii::app()->db;
//					echo "<pre>";print_r($_POST['operaciones']);exit;
		if(isset($_POST['Authitem']))
		{
			$auth=Yii::app()->authManager;
			$model->attributes=$_POST['Authitem'];
			$getPost=true;
			if (isset($_POST['operaciones']))
				$operaciones_hijos=$_POST['operaciones'];
			else 
				$operaciones_hijos=array();
			//$model->usuario_id_aud=Yii::app()->user->id;
			if($model->save()){
				$transaction = Yii::app()->db->beginTransaction();
				try {
					//OBTENER TODS LOS ITEM HIJOS
					$itemsHijos=$auth->getItemChildren($model->name);
					
					//ELIMINAR ITEM HIJOS DEL ITEM A MODIFICAR
					foreach ($itemsHijos as $itemsHijo) {
						$auth->removeItemChild($model->name,$itemsHijo->name);
					} 
					//AGREGAR NUEVOS ITEM HIJOS ASOCIADOS
					for ($i=0;$i<count($operaciones_hijos);$i++) $auth->addItemChild($model->name,$operaciones_hijos[$i]);
				
					$transaction->commit();
					Yii::app()->user->setFlash('success', 'Registro guardado exitósamente. <br/> Para ver el registro haga click '.CHtml::link('Aquí',array('view','id'=>$model->name),array('target'=>'_blank','class'=>'fancybox')).'<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('update','id'=>$model->name)));
					$this->redirect(array('admin'));
				}
				catch (Exception $e){
					throw new CHttpException(400,$e->getMessage());
					$transaction->rollBack();
				}
				exit;
				
			}
				
		}
		
		if ($model)	{
			//PADRES
			$sql="select * from seguridad.authitem as ai where ai.type = 0 and ai.\"name\" not in (select aic.child from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name') and ai.\"name\"!='$model->name'";
			$command=$connection->createCommand($sql);
			$operaciones=$command->queryAll();
			$operaciones=$this->limpiarItems($operaciones,$model->name);			

			//HIJOS
			$sql="select * from seguridad.authitemchild aic join seguridad.authitem as ai on ai.\"name\"=aic.parent join seguridad.authitem as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name'";
			$command=$connection->createCommand($sql);
			$operacionesChild=$command->queryAll();				
		}
		else {
			$operaciones=Authitem::model()->findAll('type=:tipo',array(':tipo'=>0));			
			$operacionesChild=array();
		}

		$this->render('updateOperacion',array(
				'model'=>$model,
				'operaciones'=>$operaciones,
				'operacionesChild'=>$operacionesChild,
				'getPost'=>$getPost,
			));
	}
	
	public function limpiarItems($items,$itemName){
		$AIC = new Authitemchild();
		$items_sin_loop=array();
		foreach($items as $i=>$item) {
			if (!$AIC->detectLoop($itemName, $item['name']))$items_sin_loop[]=$item['name'];
		}
		
		return $items_sin_loop;
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

			$Authitem=$this->loadModel($id);
			if ($Authitem){
				$AuthitemChildParent=AuthitemChild::model()->findAll('parent=:parent OR child=:child',array(':parent'=>$id,':child'=>$id));
				$authAssign=AuthAssignment::model()->findAll('itemname=:itemname',array(':itemname'=>$id));
				if (!$authAssign&&!$AuthitemChildParent){
					$this->loadModel($id)->delete();
					$mensaje="eliminado";
				}
				else if ($authAssign){
					$mensaje="asignado";
				}
				else if ($AuthitemChildParent){
					$mensaje="relacionado";
				}
			}
			else {
				$mensaje="no existe";
			}
			echo $mensaje;
			//die();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	
	}
	
	/**
	 * Lists all models.
	 */
	/*
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Authitem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	*/
	/**
	 * Manages all models.
	 */
	
	public function actionAdmin()
	{
		$model=new Authitem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Authitem']))
			$model->attributes=$_GET['Authitem'];

		$this->render('admin',array(
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
		$model=Authitem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	public function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='auth-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}/*
	
		public function beforeAction()
	
	{

		if (!Yii::app()->user->isGuest){
			$user=GenUsuUsuario::model()->findByPk(Yii::app()->user->id);
			if (!$user->validarUsuarioSesion())	{
				$this->redirect(Yii::app()->homeUrl);
				Yii::app()->end();	
			}
		}
		else {
			$this->redirect(Yii::app()->homeUrl);
		}
			
	   // if($this->action->id == 'index')  { }
	   
	   return true;
		
	}*/
	
	public function actionAdministrarModulos(){
		
	$model = new Authitem();
	$modelOperaciones= array();
	
	if(isset($_POST['RegistrarOperacion']))
	{
		unset($modelOperaciones);
		$modelOperaciones= array();
		
		$model->attributes=$_POST['AuthItem'];
		$valido= TRUE;
		
		 foreach($_POST['RegistrarOperacion'] as $i=>$data) {
		 	 $item = new RegistrarOperacion('RegistrarOperacion');
		 	  if(isset($data)) {
		 	  	$item->attributes=$data;
		 	  	if($item->operacion_chk ==1)
		 	  		$item->scenario='seleccionado';
		 	  	
		 	  	$valido =$item->validate()&&$valido;
		 	  	$modelOperaciones[] = $item;
		 	  }
		}
		if($valido){
			$st_operacion=false;
			foreach ($modelOperaciones as $key=>$value){
				if($value->operacion_chk ==1){
					$this->crearOperacion($value->operacion_ruta,$value->operacion_descripcion);
					$st_operacion=true;
				}
			}
			
			if ($st_operacion){
				Yii::app()->user->setFlash('success', 'Registro guardado exitósamente.');
				$this->redirect(array('ViewPermisos','modulo'=>$model->modulos2));
				Yii::app()->end;
			}
		}
	}
   
	    $this->render('administrarModulos',array(
			'model'=>$model,
	    	'modelOperaciones'=>$modelOperaciones
		));
	    
	    
	}

	public function actionVerReglas(){
		
	$model= new Authitem();
	$modulo = '';
	if(isset($_POST['Authitem'])){
		$modulo=$_POST['Authitem']['modulos2'];
		if ($modulo==''){
			$this->redirect(array('administrarModulos','modulo'=>$modulo));Yii::app()->end;
		}
		$this->redirect(array('ViewPermisos','modulo'=>$modulo));
		Yii::app()->end;
	}

		$this->redirect(array('administrarModulos','modulo'=>$modulo));
		Yii::app()->end;			
				
	}

	public function actionViewPermisos($modulo)
	{
		$sql="SELECT lower(p.x[2]) as controlador,p.* FROM (
		SELECT string_to_array(name,'/') as x,* FROM seguridad.Authitem WHERE name ilike '".$modulo."/%'
		) AS p
		order by controlador ASC";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$rules=$command->queryAll();			
		/*
		$rules = Authitem::model()->findAll(
		    'name LIKE :name',
		    array(':name' => "$modulo%")
		);
		*/
		
		$this->render('viewPermisos',array(
			'rules'=>$rules,
			'modulo'=>$modulo
		));
		
		
	}	
	
	public function crearOperacion($operacion,$descripcion){
		$auth=Yii::app()->authManager;
    	$bizRule='';
    	
		try
		{
			$auth->createOperation($operacion, $descripcion, $bizRule);				
		}
		catch(Exception $e) // an exception is raised if a query fails
		{
			return false;
		}	    	
		return true;
	} 	
	
	
	public function actionBuscarAcciones(){

		if(Yii::app()->user->isGuest) {
			echo "Su sesion ha expirado.";
			exit;
		}
		if (isset($_POST['modulo'])){
			
			$modulo=$_POST['modulo'];
	    	if ($modulo!='.svn'){
//	    		$modelOperaciones []= new RegistrarOperacion('inicial');
	    		$this->renderPartial('viewAcciones',array(
	    				'modulo'=>$modulo//,'modelOperaciones'=>$modelOperaciones
	    		));
		    }
		}
	    echo "";	    
	}	
	
	public function actionaModulos(){
	
	echo "<pre>";		
	echo "Acciones de un controlador<br/>";
	/*		
		$user_actions = Yii::app()->metadata->getActions('FamBeneficiadoController','familia');
	    var_dump($user_actions); #Get actions of 'UserController'
	   */ 
    $modules = Yii::app()->metadata->getModules();
    print_r($modules);
    foreach ($modules as $modulo){
    	if ($modulo!='.svn'){
	    	$controllers = Yii::app()->metadata->getControllers($modulo);
	    	foreach ($controllers as $controlador){
	    		if ($controlador!='DefaultController'){
		    		echo " Modulo: ".$modulo.' Controlador: '.$controlador.' <br/>';
		    		//$actions = Yii::app()->metadata->getActions($controlador,$modulo);
	    		}
	    	}
    	}
    }
  
    
/*
echo "controladores de un modulo<br/>";
    $controllers = Yii::app()->metadata->getControllers('usuario'); #You can specify module name as parameter
    var_dump($controllers); #Get list of application controllers
    
echo "Acciones y controladores de un modulo<br/>";
    $controllersWithActions = Yii::app()->metadata->getControllersActions('refugio'); #if no $module param, controllers&actions of application will returned
    var_dump($controllers); #Get controllers and their actions of module 'user'

  //  $models = Yii::app()->metadata->getModels(); #You can specify module name as parameter
  //  var_dump($models); #Get list of models application 

    
echo "Modulos sistema<br/>";
    $modules = Yii::app()->metadata->getModules();
    var_dump($modules);
 */   
	
	
	}
	
	 public function consultar_operacion($operacion){
	 	if(Authitem::model()->findAll('type=:tipo AND LOWER(TRIM(name))=:name',array(':tipo'=>0,'name'=>strtolower(trim($operacion)))))
	 		return true;
	 	else 
	 		return false;
	 } 	
	 
	 private function exportarPermiso($id){
	 	
	 	$model= $this->loadModel($id);
	 	if($model){
	 		$permido = array();
	 		$connection=Yii::app()->db;
	 		$permido['nombre_permiso']=$model->name;
	 		$permido['tipo_permiso']=$model->type;
	 		$permido['descripcion_permiso']=$model->description;
	 		
	 		$permiso =$this->exportarOperecion($model->name);
	 		if(count($permiso)>0)
	 			$permido['operacion_permiso']=$permiso;
	 		unset($permiso);
	 		$permiso =$this->exportarTarea($model->name);
	 		if(count($permiso)>0)
	 			$permido['tareas_permiso']=$permiso;
	 		unset($permiso);
	 		//tareas hijas
// 	 		$sql="SELECT name, type, description, bizrule, data FROM seguridad.authitemchild aic
// 	 		JOIN seguridad.authitem AS ai2 ON ai2.\"name\"=aic.child WHERE ai2.type = 0 and aic.parent ='$model->name'";
// 	 		$command=$connection->createCommand($sql);
// 	 		$operacionesChild=$command->queryAll();
// 	 		if($operacionesChild){
// 		 		$permisorOperacion=array();
// 		 		foreach ($operacionesChild AS $key =>$value){
// 			 		$permisorOperacion[$key]['name']=$value['name'];
// 			 		$permisorOperacion[$key]['type']=$value['type'];
// 			 		$permisorOperacion[$key]['description']=$value['description'];
// 		 		}
		 			
// 		 		$permido['operacion_permiso']=$permisorOperacion;
// 		 		unset($permisorOperacion);
// 	 		}

	 		
	 		//rol padre
	 		$sql="SELECT child FROM seguridad.authitemchild aic 
			JOIN seguridad.authitem AS ai2 on ai2.\"name\"=aic.child 
			WHERE ai2.type = 2 AND aic.parent ='$model->name'";
	 		$command=$connection->createCommand($sql);
	 		$rolPadre=$command->queryAll();
	 		if($rolPadre){
		 		$permisorRolPadre=array();
		 		foreach ($rolPadre AS $key =>$value){
			 		$permisorRolPadre[$key]['child']=$value['child'];
		 		}
		 			
		 		$permido['rol_padre']=$permisorRolPadre;
// 		 		print_r($permisorRolPadre);exit;
		 		unset($permisorRolPadre);
	 		}
	 		return $permido;
	 	}
	 	return array();
	 	
	 }
	 
	 protected function exportarOperecion($nombre){
	 	$permisorOperacion= array();
	 	$connection=Yii::app()->db;
	 	$sql="SELECT name, type, description, bizrule FROM seguridad.authitemchild aic
	 	JOIN seguridad.authitem AS ai2 ON ai2.\"name\"=aic.child WHERE ai2.type = 0 and aic.parent ='$nombre'";
	 	$command=$connection->createCommand($sql);
	 	$operacionesChild=$command->queryAll();
	 	if($operacionesChild){
	 		$permisorOperacion=array();
	 		foreach ($operacionesChild AS $key =>$value){
	 			$permisorOperacion[$key]['name']=$value['name'];
	 			$permisorOperacion[$key]['type']=$value['type'];
	 			$permisorOperacion[$key]['description']=$value['description'];
	 		}
	 			
	 	}
	 	
	 	return $permisorOperacion;
	 	
	 }
	 protected function exportarTarea($nombre){
	 	$permisorTarea= array();
	 	$connection=Yii::app()->db;
	 	$sql="SELECT name, type, description, bizrule FROM seguridad.authitemchild aic 
			JOIN seguridad.authitem AS ai2 on ai2.\"name\"=aic.child 
			WHERE ai2.type = 1 AND aic.parent = '$nombre'";
	 	$command=$connection->createCommand($sql);
	 	$operacionesChild=$command->queryAll();
	 	if($operacionesChild){
	 		$permisorOperacion=array();
	 		
	 		foreach ($operacionesChild AS $key =>$value){
	 			$permisorTarea[$key]['nombre_permiso']=$value['name'];
		 		$permisorTarea[$key]['tipo_permiso']=$value['type'];
		 		$permisorTarea[$key]['descripcion_permiso']=$value['description'];
		 		
		 		$permisorOperacion =$this->exportarOperecion($value['name']);
		 		if(count($permisorOperacion)>0)
		 			$permisorTarea[$key]['operacion_permiso']=$permisorOperacion;
		 		}
	 	 	
	 	}
	 	 
	 	return $permisorTarea;
	 	 
	 }
	
}
