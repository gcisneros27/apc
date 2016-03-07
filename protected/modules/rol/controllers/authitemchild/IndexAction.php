<?php
class IndexAction extends CAction
{
   public function run()
   {
		$dataProvider=new CActiveDataProvider('AuthItemChild');
		$this->controller->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}