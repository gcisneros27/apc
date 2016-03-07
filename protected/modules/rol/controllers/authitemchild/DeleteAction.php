<?php
class DeleteAction extends CAction
{
   public function run($id)
   {
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->controller->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}