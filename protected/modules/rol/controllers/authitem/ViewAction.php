<?php
class ViewAction extends CAction
{
   public function run($id)
   {
   		
		$this->controller->renderPartial('view',array(
			'model'=>$this->controller->loadModel($id),
		));
	}
}