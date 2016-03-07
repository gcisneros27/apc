<?php
class AdministrarRolesAction extends CAction
{
   public function run()
   {
		$model=new UsuUsuario;

		// Uncomment the following line if AJAX validation is needed
		 $this->controller->performAjaxValidation($model);

		if(isset($_POST['AuthItemChild']))
		{
			$model->attributes=$_POST['AuthItemChild'];
			$model->usu_aud_id=Yii::app()->user->id;
			if($model->save())
				$this->controller->redirect(array('view','id'=>$model->parent));
		}

		$this->controller->render('adminRol',array(
			'model'=>$model,
		));
	}
} 