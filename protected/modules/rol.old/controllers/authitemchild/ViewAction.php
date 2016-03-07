<?php
class ViewAction extends CAction
{
   public function run($id)
   {
   	/*
		$this->controller->render('view',array(
			'model'=>$this->controller->loadModel($id),
		));
		*/
   	
   	
   	
   	
		$dataProvider=new CActiveDataProvider('AuthItemChild');
		$this->controller->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		
   }	
		
}