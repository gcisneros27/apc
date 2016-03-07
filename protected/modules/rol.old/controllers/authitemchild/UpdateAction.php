<?php
class UpdateAction extends CAction
{
   public function run($id)
   {
		$model=$this->controller->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AuthItemChild']))
		{
			$model->attributes=$_POST['AuthItemChild'];
			$model->usu_aud_id=Yii::app()->user->id;
			if($model->save())
				$this->controller->redirect(array('view','id'=>$model->parent));
		}

		$this->controller->render('update',array(
			'model'=>$model,
		));
	}
}