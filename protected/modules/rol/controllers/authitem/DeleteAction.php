<?php
class DeleteAction extends CAction
{
   public function run($id)
   {
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request

			$authItem=$this->controller->loadModel($id);
			if ($authItem){
				$authItemChildParent=AuthItemChild::model()->findAll('parent=:parent OR child=:child',array(':parent'=>$id,':child'=>$id));
				$authAssign=AuthAssignment::model()->findAll('itemname=:itemname',array(':itemname'=>$id));
				if (!$authAssign&&!$authItemChildParent){
					$this->controller->loadModel($id)->delete();
					$mensaje="eliminado";
				}
				else if ($authAssign){
					$mensaje="asignado";
				}
				else if ($authItemChildParent){
					$mensaje="relacionado";
				}
			}
			else {
				$mensaje="no existe";
			}
			echo $mensaje;
			//die();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}