<?php
class UpdateAction extends CAction
{
   public function run($id)
   {
		$model=$this->controller->loadModel($id);
		$getPost=false;
		$valido=true;

		// Uncomment the following line if AJAX validation is needed
		$this->controller->performAjaxValidation($model);
		$connection=Yii::app()->db;
					
		if(isset($_POST['AuthItem']))
		{
			$auth=Yii::app()->authManager;
			$model->attributes=$_POST['AuthItem'];
			$getPost=true;
			if (isset($_POST['roles']))	$roles_hijos=$_POST['roles'];else $roles_hijos=array();
			if (isset($_POST['tareas']))	$tareas_hijos=$_POST['tareas'];else $tareas_hijos=array();
			if (isset($_POST['operaciones']))	$operaciones_hijos=$_POST['operaciones'];else $operaciones_hijos=array();
			$model->usuario_id_aud=Yii::app()->user->id;
			$valido=$model->validate();
			if($valido){			
				$model->save();
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
				
				Yii::app()->user->setFlash('success', 'Para ver el haga click '.CHtml::link('<i class="right zoom in icon"></i>',array('authItem/view','id'=>$model->name),array('target'=>'_blank','class'=>'fancybox mini ui icon circular  button')).'<br/> Para modificar el haga click '.CHtml::link('<i class="right edit icon"></i>',array('authItem/update','id'=>$model->name),array('class'=>'mini ui icon circular  button')));
													
				//Yii::app()->user->setFlash('success', "Rol ha sido creado exitósamente");
				//$this->controller->redirect(array('view','id'=>$model->name));
				$this->controller->redirect(array('admin'));
				
				
			}
				
		}
		
		if ($model)	{
			//PADRES
			$sql="select * from seguridad.\"authitem\" as ai where ai.type = 2 and ai.\"name\" not in (select aic.child from seguridad.\"authitemchild\" aic join seguridad.\"authitem\" as ai on ai.\"name\"=aic.parent join seguridad.\"authitem\" as ai2 on ai2.\"name\"=aic.child where ai2.type = 2 and aic.parent = '$model->name') and ai.\"name\"!='$model->name' and ai.\"name\"!='guest' and ai.\"name\"!='authenticated'";
			$command=$connection->createCommand($sql);
			$roles=$command->queryAll();
			$roles=$this->limpiarItems($roles,$model->name);
			
			$sql="select * from seguridad.\"authitem\" as ai where ai.type = 1 and ai.\"name\" not in (select aic.child from seguridad.\"authitemchild\" aic join seguridad.\"authitem\" as ai on ai.\"name\"=aic.parent join seguridad.\"authitem\" as ai2 on ai2.\"name\"=aic.child where ai2.type = 1 and aic.parent = '$model->name') and ai.\"name\"!='$model->name'";
			$command=$connection->createCommand($sql);
			$tareas=$command->queryAll();
			$tareas=$this->limpiarItems($tareas,$model->name);

			$sql="select * from seguridad.\"authitem\" as ai where ai.type = 0 and ai.\"name\" not in (select aic.child from seguridad.\"authitemchild\" aic join seguridad.\"authitem\" as ai on ai.\"name\"=aic.parent join seguridad.\"authitem\" as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name') and ai.\"name\"!='$model->name'";
			$command=$connection->createCommand($sql);
			$operaciones=$command->queryAll();
			$operaciones=$this->limpiarItems($operaciones,$model->name);			

			//HIJOS
			$sql="select * from seguridad.\"authitemchild\" aic join seguridad.\"authitem\" as ai on ai.\"name\"=aic.parent join seguridad.\"authitem\" as ai2 on ai2.\"name\"=aic.child where ai2.type = 2 and aic.parent = '$model->name'";
			$command=$connection->createCommand($sql);
			$rolesChild=$command->queryAll();				

			$sql="select * from seguridad.\"authitemchild\" aic join seguridad.\"authitem\" as ai on ai.\"name\"=aic.parent join seguridad.\"authitem\" as ai2 on ai2.\"name\"=aic.child where ai2.type = 1 and aic.parent = '$model->name'";
			$command=$connection->createCommand($sql);
			$tareasChild=$command->queryAll();	

			$sql="select * from seguridad.\"authitemchild\" aic join seguridad.\"authitem\" as ai on ai.\"name\"=aic.parent join seguridad.\"authitem\" as ai2 on ai2.\"name\"=aic.child where ai2.type = 0 and aic.parent = '$model->name'";
			$command=$connection->createCommand($sql);
			$operacionesChild=$command->queryAll();				
		}
		else {
			$roles=AuthItem::model()->findAll('type=:tipo',array(':tipo'=>2));
			$tareas=AuthItem::model()->findAll('type=:tipo',array(':tipo'=>1));
			$operaciones=AuthItem::model()->findAll('type=:tipo',array(':tipo'=>0));			
			
			$rolesChild=array();
			$tareasChild=array();
			$operacionesChild=array();
		}

		if ($getPost && !$valido)
			Yii::app()->user->setFlash('error', 'Por favor corrija los errores del formulario.');		
		
		
		if ($model->type==2){
			$this->controller->render('update',array(
				'model'=>$model,
				'roles'=>$roles,
				'tareas'=>$tareas,
				'operaciones'=>$operaciones,
				'rolesChild'=>$rolesChild,
				'tareasChild'=>$tareasChild,
				'operacionesChild'=>$operacionesChild,
				'getPost'=>$getPost,
			));
   		}
   		elseif ($model->type==1) {
   				$this->controller->render('updateTarea',array(
				'model'=>$model,
				'roles'=>$roles,
				'tareas'=>$tareas,
				'operaciones'=>$operaciones,
				'rolesChild'=>$rolesChild,
				'tareasChild'=>$tareasChild,
				'operacionesChild'=>$operacionesChild,
				'getPost'=>$getPost,
			));
   		}
      	elseif ($model->type==0) {
   				$this->controller->render('updateOperacion',array(
				'model'=>$model,
				'roles'=>$roles,
				'tareas'=>$tareas,
				'operaciones'=>$operaciones,
				'rolesChild'=>$rolesChild,
				'tareasChild'=>$tareasChild,
				'operacionesChild'=>$operacionesChild,
				'getPost'=>$getPost,
			));
   		}   		
   		
		
	}
	
	//RETORNA LOS ITEMS VALIDOS PARA SER ASIGNADOS EN LA HERENCIA, NO PROVOCAN LOOP
	public function limpiarItems($items,$itemName){
		$AIC = new AuthItemChild();
		$items_sin_loop=array();
		foreach($items as $i=>$item) {
			if (!$AIC->detectLoop($itemName, $item['name']))$items_sin_loop[]=$item['name'];
		}
		
		return $items_sin_loop;
	}
	
}