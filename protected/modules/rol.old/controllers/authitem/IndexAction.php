<?php
class IndexAction extends CAction
{
   public function run()
   {
		$dataProvider=new CActiveDataProvider('AuthItem');
		$this->controller->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}