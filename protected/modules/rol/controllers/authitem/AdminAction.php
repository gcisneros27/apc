<?php
class AdminAction extends CAction
{
   public function run()
   {
		$model=new AuthItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AuthItem']))
			$model->attributes=$_GET['AuthItem'];

		$this->controller->render('admin',array(
			'model'=>$model,
		));		
	}
}