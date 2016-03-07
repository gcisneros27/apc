<?php

class RMenusAuthitemController extends Controller
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
// 				'actions'=>array('index','view'),
// 				'users'=>array('*'),
// 			),
// 			array('allow', // allow authenticated user to perform 'create' and 'update' actions
// 				'actions'=>array('create','update'),
// 				'users'=>array('@'),
// 			),
// 			array('allow', // allow admin user to perform 'admin' and 'delete' actions
// 				'actions'=>array('admin','delete'),
// 				'users'=>array('admin'),
// 			),
			array('allow','actions' => array('Create'), 'roles' => array('administracion/RMenusAuthitem/Create')),
			array('allow','actions' => array('View'), 'roles' => array('administracion/RMenusAuthitem/View')),
			array('allow','actions' => array('Update'), 'roles' => array('administracion/RMenusAuthitem/Update')),
			array('allow','actions' => array('Admin'), 'roles' => array('administracion/RMenusAuthitem/Admin')),
			array('allow','actions' => array('BajarOrden'), 'roles' => array('administracion/RMenusAuthitem/BajarOrden')),
			array('allow','actions' => array('SubirOrden'), 'roles' => array('administracion/RMenusAuthitem/SubirOrden')),
			array('allow','actions' => array('Delete'), 'roles' => array('administracion/RMenusAuthitem/Delete')),
				
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
	public function actionCreate($id)
	{
		$model=new RMenusAuthitem('registrar_item_menu');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RMenusAuthitem']))
		{
			$model->attributes=$_POST['RMenusAuthitem'];
			$model->id_menu= $id;
			
			$modelOrden = RMenusAuthitem::model()->find(array('condition'=>'id_menu=:id_menu',
														'params'=>array(':id_menu'=>(int)$id),
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
	 												<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('update','id'=>$model->id_item_authitem)));
						$this->redirect(array('admin','id'=>$id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'id'=>$id
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RMenusAuthitem']))
		{
			$model->attributes=$_POST['RMenusAuthitem'];
			if($model->save()){
					Yii::app()->user->setFlash('success', 'Registro guardado exitósamente.
	 												<br/> Para ver el registro haga click '.CHtml::link('Aquí',array('view','id'=>$model->id_menu),array('target'=>'_blank','class'=>'fancybox')).'
	 												<br/> Para modificar el registro haga click '.CHtml::link('Aquí',array('update','id'=>$model->id_item_authitem)));
						$this->redirect(array('admin','id'=>$model->id_menu));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		echo "eliminado";
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

public function actionSubirOrden($id){
//	  	print_r($id);
		  	$model = $this->loadModel($id);
		  	$parte = RMenusAuthitem::model()->find("orden_parte=:orden_parte and id_menu=:id_menu",array(':orden_parte'=>($model->orden_parte-1),':id_formato'=>$model->id_menu));
			if($parte){
				$parte ->orden_parte = $parte ->orden_parte+1;
				$parte->save();
				$model ->orden_parte = $model ->orden_parte-1;
				$model->save();
				echo "exitoso";
			}
			else{
					echo "fallo";
			}
	
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
// 			if(!isset($_GET['ajax'])){
// 				echo isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','id_formato'=>$model->id_formato);exit;
// 				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','id_formato'=>$model->id_formato));
// 			}
				
	}
	
	public function actionBajarOrden($id){
		  	$model = $this->loadModel($id);
		  	$parte = RMenusAuthitem::model()->find("orden_parte=:orden_parte and id_menu=:id_menu",array(':orden_parte'=>($model->orden_parte+1),':id_formato'=>$model->id_menu));
			if($parte){
				$parte ->orden_parte = $parte ->orden_parte-1;
				$parte->save();
				$model ->orden_parte = $model ->orden_parte+1;
				$model->save();
				echo "exitoso";
			}
			else{
					echo "fallo";
			}
			
	
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
// 			if(!isset($_GET['ajax']))
// 				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','id_formato'=>$model->id_formato));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RMenusAuthitem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$model=new RMenusAuthitem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RMenusAuthitem']))
			$model->attributes=$_GET['RMenusAuthitem'];

		$this->render('admin',array(
			'model'=>$model,
			'id'=>$id
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RMenusAuthitem the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RMenusAuthitem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RMenusAuthitem $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='rmenus-authitem-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
