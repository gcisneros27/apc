<?php

class PuntoCuentaController extends Controller
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
			array('allow','actions' => array('View'), 'roles' => array('principal/PuntoCuenta/View')),
                        array('allow','actions' => array('Create'), 'roles' => array('principal/PuntoCuenta/Create')),
                        array('allow','actions' => array('Update'), 'roles' => array('principal/PuntoCuenta/Update')),
                        array('allow','actions' => array('Delete'), 'roles' => array('principal/PuntoCuenta/Delete')),
                        array('allow','actions' => array('Index'), 'roles' => array('principal/PuntoCuenta/Index')),
                        array('allow','actions' => array('Admin'), 'roles' => array('principal/PuntoCuenta/Admin')),
                        array('allow','actions' => array('ImprimirPdf'), 'roles' => array('principal/PuntoCuenta/ImprimirPdf')),
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
		$model=new PuntoCuenta();
                $getPost=false;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PuntoCuenta']))
		{
			$model->attributes=$_POST['PuntoCuenta'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_punto_cuenta));
		}

		$this->render('create',array(
			'model'=>$model,    
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

		if(isset($_POST['PuntoCuenta']))
		{
			$model->attributes=$_POST['PuntoCuenta'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_punto_cuenta));
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
                $model->st_punto_cuenta=false;
                if($model->save(false))
                    {
                        $contratos=  Contrato::model()->findAll('id_punto_cuenta=:idc',array(':idc'=>$id));
                        if($contratos)
                            { foreach ($contratos as $key=>$contrato)
                                {
                                    $contrato->st_contrato=FALSE;
                                    if($contrato->save(false))
                                    {  
                                        $addenda= Addendum::model()->findAll('id_contrato=:idc',array(':idc'=>$contrato->id_contrato));
                                        if($addenda){
                                            foreach ($addenda as $key=>$addendum)
                                                {
                                                    $addendum->st_addendum=FALSE;
                                                    $addendum->save(false);

                                                }
                                        }
                                    }
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
         * Imprimir Pdf
         * Genera el punto de cuenta en pdf
         * 
         */
        public function actionImprimirPdf($id)
        {
          $model= $this->loadModel($id);
          
          $html=$this->renderPartial('imprime_punto',array('model'=>$model,),true);
          $header=$this->renderPartial('header_pdf',array('model'=>$model,),true);
          $footer=$this->renderPartial('footer_pdf',array('model'=>$model,),true);
          
          FuncionesPublicas::generarPdf($opcion=array('html'=>$html,'header'=>$header,'footer'=>$footer,'nombre_archivo'=>'Punto de Cuenta'));
        }
        
        
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PuntoCuenta');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PuntoCuenta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PuntoCuenta']))
			$model->attributes=$_GET['PuntoCuenta'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PuntoCuenta the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PuntoCuenta::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PuntoCuenta $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='punto-cuenta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
