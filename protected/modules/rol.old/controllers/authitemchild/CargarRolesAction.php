<?php
class CargarRolesAction extends CAction
{
   public function run()
   {
   	
   	
		$model=new AuthItem;
		$model->unsetAttributes();  // clear any default values
		//if(isset($_POST['AuthItemChild']))	$model->attributes=$_GET['AuthItemChild'];

		echo "voy";
		
		
	}
}