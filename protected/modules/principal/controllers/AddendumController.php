<?php

class AddendumController extends Controller
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
			array('allow','actions' => array('Admin'), 'roles' => array('principal/Addendum/Admin')),
                        array('allow','actions' => array('Index'), 'roles' => array('principal/Addendum/Index')),
                        array('allow','actions' => array('Delete'), 'roles' => array('principal/Addendum/Delete')),
                        array('allow','actions' => array('View'), 'roles' => array('principal/Addendum/View')),
                        array('allow','actions' => array('Update'), 'roles' => array('principal/Addendum/Update')),
                        array('allow','actions' => array('Create'), 'roles' => array('principal/Addendum/Create')),
			array('allow',  // deny all users
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
		$model=new Addendum;
                $modelContrato= Contrato::model()->findByPk($id);
                $getPost=FALSE;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Addendum']))
		{
			$model->attributes=$_POST['Addendum'];
                        $model->id_contrato=$modelContrato->id_contrato;
                        $add=Addendum::model()->count('id_contrato=:idc',array(':idc'=>$modelContrato->id_contrato));
                        $model->nu_addendum=++$add;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_addendum));
		}

		$this->render('create',array(
			'model'=>$model,
                        'getPost'=>$getPost,
                        'modelContrato'=>$modelContrato,
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
                $getPost=FALSE;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Addendum']))
		{
			$model->attributes=$_POST['Addendum'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_addendum));
		}

		$this->render('update',array(
			'model'=>$model,
                        'getPost'=>$getPost,
                        
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
                $model->st_addendum=FALSE;
                if($model->save(false)) echo 'eliminado';
                else {echo '<pre>';print_r($model->getErrors());}
                

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Addendum');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$model=new Addendum('search');
                $modelContrato= Contrato::model()->findByPk($id);
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Addendum']))
			$model->attributes=$_GET['Addendum'];

		$this->render('admin',array(
			'model'=>$model,
                        'modelContrato'=>$modelContrato,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Addendum the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Addendum::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Addendum $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='addendum-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
