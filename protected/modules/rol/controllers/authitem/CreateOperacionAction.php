<?php
class CreateOperacionAction extends CAction
{
   public function run()
   {
		$model=new AuthItem;
		$getPost=false;
		$valido=true;

		// Uncomment the following line if AJAX validation is needed
		$this->controller->performAjaxValidation($model);

		if(isset($_POST['AuthItem']))
		{
			$model->attributes=$_POST['AuthItem'];
			$getPost=true;
			//if($model->save())
			$valido=$model->validate();
			if($valido){
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
					Yii::app()->user->setFlash('success', 'Para ver el haga click '.CHtml::link('<i class="right zoom in icon"></i>',array('authItem/view','id'=>$model->name),array('target'=>'_blank','class'=>'fancybox mini ui icon circular  button')).'<br/> Para modificar el haga click '.CHtml::link('<i class="right edit icon"></i>',array('authItem/update','id'=>$model->name),array('class'=>'mini ui icon circular  button')).'<br/> Para agregar nuevo haga click '.CHtml::link('<i class="add icon"></i>',array('authItem/createOperacion'),array('class'=>'mini ui icon circular  button')));

					$this->controller->redirect(array('admin'));
				}
				catch(Exception $e) // an exception is raised if a query fails
				{
				    throw new CHttpException('500','No se puede crear el Item.');
				    
					$this->controller->render('create',array(
						'model'=>$model,
					));
				}	    	
		    	
		    	//$auth->createRole($model->name, $model->description, $bizRule);
					//$this->controller->redirect(array('view','id'=>$model->name));
			}
		}

		$roles=array();//CHtml::listData(AuthItem::model()->findAll('type=:tipo',array(':tipo'=>2)),"name","name");
		$tareas=CHtml::listData(AuthItem::model()->findAll('type=:tipo',array(':tipo'=>1)),"name","name");
		$operaciones=CHtml::listData(AuthItem::model()->findAll('type=:tipo',array(':tipo'=>0)),"name","name");
				
		$rolesChild=array();
		$tareasChild=array();
		$operacionesChild=array();
		
		
		/*
		foreach($roles as $i=>$rol) {
					
		print($rol->name);echo "<br/><br/><br/>";
		}
		die();
		*/
		if ($getPost && !$valido)
			Yii::app()->user->setFlash('error', 'Por favor corrija los errores del formulario.');			
		
		$this->controller->render('createOperacion',array(
			'model'=>$model,'roles'=>$roles,'tareas'=>$tareas,'operaciones'=>$operaciones,
		 	'rolesChild'=>$rolesChild,'tareasChild'=>$tareasChild,'operacionesChild'=>$operacionesChild,
			'getPost'=>$getPost,
		));
	}
} 
