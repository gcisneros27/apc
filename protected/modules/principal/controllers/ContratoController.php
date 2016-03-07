<?php

class ContratoController extends Controller
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
			array('allow','actions' => array('Admin'), 'roles' => array('principal/Contrato/Admin')),
                        array('allow','actions' => array('AdminG'), 'roles' => array('principal/Contrato/AdminG')),
                        array('allow','actions' => array('View'), 'roles' => array('principal/Contrato/View')),
                        array('allow','actions' => array('Create'), 'roles' => array('principal/Contrato/Create')),
                        array('allow','actions' => array('Update'), 'roles' => array('principal/Contrato/Update')),
                        array('allow','actions' => array('Delete'), 'roles' => array('principal/Contrato/Delete')),
                        array('allow','actions' => array('Index'), 'roles' => array('principal/Contrato/Index')),
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
		$model=new Contrato;
                $modelPunto=  PuntoCuenta::model()->findByPk($id);
                $getPost=false;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contrato']))
		{
			$model->attributes=$_POST['Contrato'];
                        $model->id_punto_cuenta=$modelPunto->id_punto_cuenta;
                        if($model->id_estado=='')$model->id_estado=NULL;
                        if($model->id_municipio=='')$model->id_municipio=NULL;
                        if($model->id_parroquia=='')$model->id_parroquia=NULL;
                        if($model->id_estatus=='')$model->id_estatus=NULL;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_contrato));
		}

		$this->render('create',array(
			'model'=>$model,
                        'modelPunto'=>$modelPunto,
                        'getPost'=>$getPost,
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
                $getPost=false;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contrato']))
		{
			$model->attributes=$_POST['Contrato'];
                        $model->id_punto_cuenta=$id;
                        if($model->id_estado=='')$model->id_estado=NULL;
                        if($model->id_municipio=='')$model->id_municipio=NULL;
                        if($model->id_parroquia=='')$model->id_parroquia=NULL;
                        if($model->id_estatus=='')$model->id_estatus=NULL;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_contrato));
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
                $model->st_contrato=false;
                if($model->save())
                    {
                        $addenda= Addendum::model()->findAll('id_contrato=:idc',array(':idc'=>$id));
                        if($addenda){
                        foreach ($addenda as $key=>$addendum)
                            {
                                $addendum->st_addendum=FALSE;
                                $addendum->save(FALSE);
                            
                            }
                        }
                        echo 'eliminado';
                    }
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
		$dataProvider=new CActiveDataProvider('Contrato');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$model=new Contrato('search');
                $modelPunto=  PuntoCuenta::model()->findByPk($id);
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contrato']))
			$model->attributes=$_GET['Contrato'];

		$this->render('admin',array(
			'model'=>$model,
                        'modelPunto'=>$modelPunto,
		));
	}
        public function actionAdminG()
	{
		$model=new Contrato('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contrato']))
			$model->attributes=$_GET['Contrato'];

		$this->render('admin_g',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contrato the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contrato::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contrato $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contrato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
