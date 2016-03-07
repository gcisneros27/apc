<?php

class MMenusController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
// 			array('allow',  // allow all users to perform 'index' and 'view' actions
// 				'actions'=>array('index','view','adminItems','SubirOrden','BajarOrden'),
// 				'users'=>array('*'),
// 			),
// 			array('allow', // allow authenticated user to perform 'create' and 'update' actions
// 				'actions'=>array('create','update','agregarItems'),
// 				'users'=>array('@'),
// 			),
// 			array('allow', // allow admin user to perform 'admin' and 'delete' actions
// 				'actions'=>array('admin','delete'),
// 				'users'=>array('admin'),
// 			),
			array('allow','actions' => array('SubirOrden'), 'roles' => array('administracion/MMenus/SubirOrden')),
			array('allow','actions' => array('AgregarItems'), 'roles' => array('administracion/MMenus/AgregarItems')),
			array('allow','actions' => array('Admin'), 'roles' => array('administracion/MMenus/Admin')),
			array('allow','actions' => array('Update'), 'roles' => array('administracion/MMenus/Update')),
			array('allow','actions' => array('Create'), 'roles' => array('administracion/MMenus/Create')),
			array('allow','actions' => array('View'), 'roles' => array('administracion/MMenus/View')),
			array('allow','actions' => array('Delete'), 'roles' => array('administracion/MMenus/Delete')),
			array('allow','actions' => array('BajarOrden'), 'roles' => array('administracion/MMenus/BajarOrden')),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MMenus('registro_sub_items');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MMenus']))
		{
			$valido = TRUE;

			$model->attributes=$_POST['MMenus'];
			$modelOrden = MMenus::model()->find(array('condition'=>'id_menu_padre=:id_menu_padre',
														'params'=>array(':id_menu_padre'=>(int)$model->id_menu_padre),
														'order'=>'orden DESC',
														'limit'=>1));
			$orden =1;
			if($modelOrden){
				$orden =$modelOrden->orden+1;
			}
			
			$model->orden=$orden;
			if($model->save()){
					Yii::app()->user->setFlash('success', 'Registro guardado exitósamente.
	 												<br/> Para ver el registro haga click '.CHtml::link('Aquí',array('view','id'=>$model->id_menu),array('target'=>'_blank','class'=>'fancybox')).'
	 												<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('update','id'=>$model->id_menu)));
					if(isset($_POST['yt0']))
						$this->redirect(array('admin'));
					else
						$this->redirect(array('RMenusAuthitem/admin','id'=>$model->id_menu));
			}
     	}

		//ARMAR ARBOL DEPENDIENTE
		$arbol=$model->obtenerArbolAreas($id_dep=1,$nivel=0,$conhijos=false,$jstree=array(),$idDeptoSelected=0,$disalbled=false,$icon="", $departamento=0);

// 		ECHO "<pre>";
// 		//print_r($arbol);
// 		echo CJSON::encode($arbol);
// 		exit;

		$this->render('create',array(
			'model'=>$model,
			'arbol'=>$arbol,
		));

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->scenario='registro_sub_items';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MMenus']))
		{
			$valido = TRUE;

			$model->attributes=$_POST['MMenus'];
          	if($model->save()){
          		
					Yii::app()->user->setFlash('success', 'Registro guardado exitósamente.
	 												<br/> Para ver el registro haga click '.CHtml::link('Aquí',array('view','id'=>$model->id_menu),array('target'=>'_blank','class'=>'fancybox')).'
	 												<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('update','id'=>$model->id_menu)));
					if(isset($_POST['yt0']))
						$this->redirect(array('admin'));
					else
						$this->redirect(array('RMenusAuthitem/admin','id'=>$model->id_menu));
          	}
     	}
		$arbol=$model->obtenerArbolAreas($id_dep=1,$nivel=0,$conhijos=false,$jstree=array(),$idDeptoSelected=$model->id_menu,$disalbled=false,$icon="", $departamento=$model->id_menu );

		$this->render('update',array(
			'model'=>$model,
			'arbol'=>$arbol,
		));



	}

	public function actionAgregarItems(){
		if(isset($_POST['id'])){

			$this->layout='//layouts/emergenteCenso';
			$model= new RMenusAuthitem('registro_sub_items');
			$id = $_POST['id'];
			$getPost = TRUE;
			$this->render('agregarItems',array(
				'model'=>$model,
				'id'=>$id,
				'getPost'=>$getPost
			));
		}
	}
	
	public function actionSubirOrden($id){
//	  	print_r($id);
		  	$model = $this->loadModel($id);
		  	$parte = MMenus::model()->find("orden=:orden and id_menu_padre=:id_menu_padre",array(':orden'=>($model->orden-1),':id_menu_padre'=>$model->id_menu_padre));
		  	
			if($parte){
				$parte ->orden = $parte ->orden+1;
				$parte->save();
				$model ->orden = $model ->orden-1;
				$model->save();
				echo "exitoso";
			}
			else{
					echo "fallo";
			}
	
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
// 			if(!isset($_GET['ajax'])){
// 				echo isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','id_menu'=>$model->id_menu);exit;
// 				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','id_menu'=>$model->id_menu));
// 			}
				
	}
	
	public function actionBajarOrden($id){
		  	$model = $this->loadModel($id);
		  	$parte = MMenus::model()->find("orden=:orden and id_menu_padre=:id_menu_padre",array(':orden'=>($model->orden+1),':id_menu_padre'=>$model->id_menu_padre));
			if($parte){
				$parte ->orden = $parte ->orden-1;
				$parte->save();
				$model ->orden = $model ->orden+1;
				$model->save();
				echo "exitoso";
			}
			else{
					echo "fallo";
			}
			
	
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
// 			if(!isset($_GET['ajax']))
// 				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','id_menu'=>$model->id_menu));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		
		RMenusAuthitem::model()->deleteAll('id_menu=:id_menu',array(':id_menu'=>$id));
		$this->loadModel($id)->delete();
		echo "eliminado";
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('MMenus');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MMenus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MMenus']))
			$model->attributes=$_GET['MMenus'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MMenus the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MMenus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MMenus $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mmenus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
