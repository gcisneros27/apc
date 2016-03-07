<?php

class AuthItemController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	
	public function actions()  
	{  
	    return array(  
				'create'=>'application.modules.rol.controllers.authitem.CreateAction',
				'createTarea'=>'application.modules.rol.controllers.authitem.CreateTareaAction',
				'createOperacion'=>'application.modules.rol.controllers.authitem.CreateOperacionAction',
	    		'view'=>'application.modules.rol.controllers.authitem.ViewAction',
				'update'=>'application.modules.rol.controllers.authitem.UpdateAction',
				'delete'=>'application.modules.rol.controllers.authitem.DeleteAction',
				'index'=>'application.modules.rol.controllers.authitem.IndexAction',
				'admin'=>'application.modules.rol.controllers.authitem.AdminAction',
	    	    	    );  
	} 	
	
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
			/*
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','createTarea','createOperacion','admin','delete'),
				'users'=>array('@'),
			),
		*/	
		
			array('allow','actions' => array('create'),	'roles' => array('rol/authItem/create')),
			array('allow','actions' => array('update'),	'roles' => array('rol/authItem/update')),
			array('allow','actions' => array('createTarea'),	'roles' => array('rol/authItem/createTarea')),
			array('allow','actions' => array('createOperacion'),	'roles' => array('rol/authItem/createOperacion')),
			array('allow','actions' => array('admin'),	'roles' => array('rol/authItem/admin')),
			array('allow','actions' => array('delete'),	'roles' => array('rol/authItem/delete')),
			array('allow','actions' => array('view'),	'roles' => array('rol/authItem/view')),
			array('allow','actions' => array('VerReglas'),	'roles' => array('rol/AuthItem/VerReglas')),
			array('allow','actions' => array('AdministrarModulos'),	'roles' => array('rol/AuthItem/AdministrarModulos')),
			array('allow','actions' => array('ViewPermisos'),	'roles' => array('rol/AuthItem/ViewPermisos')),
			array('allow','actions' => array('BuscarAcciones'),	'roles' => array('rol/AuthItem/BuscarAcciones')),
			
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	/*
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	*/

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	/*
	public function actionCreate()
	{
		$model=new AuthItem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AuthItem']))
		{
			$model->attributes=$_POST['AuthItem'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->name));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	*/
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	/*
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AuthItem']))
		{
			$model->attributes=$_POST['AuthItem'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->name));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	/*
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	*/
	/**
	 * Lists all models.
	 */
	/*
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AuthItem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	*/
	/**
	 * Manages all models.
	 */
	/*
	public function actionAdmin()
	{
		$model=new AuthItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AuthItem']))
			$model->attributes=$_GET['AuthItem'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
*/
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=AuthItem::model()->findByPk($id);
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
		
	$model = new AuthItem();
	
	
	if(isset($_POST['operacion']))
	{
		$operacion=$_POST['operacion'];
		$st_operacion=false;
		for($i=0;$i<count($operacion);$i++){
			//echo $i.' '.$operacion[$i]['ope'].' '.$operacion[$i]['des']."<br/>";
			if(isset($operacion[$i]['ope'])&&!$this->consultar_operacion($operacion[$i]['ope'])){
				$this->crearOperacion($operacion[$i]['ope'],$operacion[$i]['des']);
				
				if (!$st_operacion){
					$modulo_r = explode("/", $operacion[$i]['ope']);
				}
				$st_operacion=true;
			}
		}
		
		if ($st_operacion){
			$modulo=$modulo_r[0];
			
			Yii::app()->user->setFlash('notice', 'Registro guardado exitósamente.');
			
			$this->redirect(array('ViewPermisos','modulo'=>$modulo));
			Yii::app()->end;
		}
		
	}
	
	
	//die();
/*	echo "<pre>";		
	echo "Acciones de un controlador<br/>";
			
		//$user_actions = Yii::app()->metadata->getActions('FamBeneficiadoController','familia');
	   // var_dump($user_actions); #Get actions of 'UserController'
	  
	   
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
*/	    
	    $this->render('administrarModulos',array(
			'model'=>$model,
		));
	    
	    
	}

	public function actionVerReglas(){
		
	$model= new AuthItem();
	
	if(isset($_POST['AuthItem'])){
		$modulo=$_POST['AuthItem']['modulos2'];
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
		SELECT string_to_array(name,'/') as x,* FROM seguridad.authitem WHERE name ilike '".$modulo."/%'
		) AS p
		order by controlador ASC";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$rules=$command->queryAll();			
		
		/*
		$rules = AuthItem::model()->findAll(
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
		    	$controllers = Yii::app()->metadata->getControllers($modulo);
		    	$tabla="
		    			<style>
	    					table.preview tr.new{
								background-color:#C5FBBD;
								}
							td.tdact,th.tdact {
							    border: 1px solid #529EC6;
								}					
						</style>
		    	
		    	<table class='preview' border=\"1\">";
		    	$tabla.="<tr><th class=\"tdact\">Operacion/accion</th><th class=\"tdact\">Descripción de la operación</th></tr>";
		    	
		    	$i=0;
		    	$accioness=false;
		    	$cont="";
		    	foreach ($controllers as $controlador){
		    		if ($controlador!='DefaultController'){
			    		$actions = Yii::app()->metadata->getActions($controlador,$modulo);
			    		foreach ($actions as $action){
			    			$nb_controlador=explode("Controller", $controlador);
			    			$ruta_accion= $modulo."/".$nb_controlador[0]."/".$action;
			    			if(!$this->consultar_operacion($ruta_accion)&&$action!='s'){
			    				$accioness=true;
			    				if ($controlador!=$cont){
				    				$tabla.="<tr class=\"controller\">
				    					<td colspan=\"2\"><b>Controlador: ".($nb_controlador[0])."</b></td>
				    				</tr>";
				    				$cont=$controlador;
			    				}
			    				$tabla.="<tr class=\"new\">";
				    				$tabla.="<td class=\"tdact\">".$ruta_accion."</td>";
				    				$tabla.="<td class=\"tdact\">".CHtml::textArea("operacion[$i][des]", false ,array('id' => $i,'rows'=>2, 'cols'=>30))."</td>";
				    				$tabla.= "<td class=\"tdact\">".CHtml::checkBox("operacion[$i][ope]", false ,array('id' => $i++,'value'=>$ruta_accion))."</td>";
			    				$tabla.="</tr>"; 
			    			}
			    			else {
			    				
			    			}
			    		}
		    		}
		    		
		    	}
		    	$tabla.="</table>";
		    	$tabla.= '<div class="row buttons" style="text-align:center">'.CHtml::submitButton('Guardar',array('class'=>'btn btn-danger'))."</div>";
		    	if ($accioness)echo $tabla;
		    	else echo "";
			    exit;
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
	 	if(AuthItem::model()->findAll('type=:tipo AND LOWER(TRIM(name))=:name',array(':tipo'=>0,'name'=>strtolower(trim($operacion)))))
	 		return true;
	 	else 
	 		return false;
	 } 	
	
}
