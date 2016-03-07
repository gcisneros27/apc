<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html class="no-js">
<head>
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/sica.ico" type="image/x-icon" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta charset="utf-8"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="mobile-web-app-capable" content="yes"/>

	<!-- CSS -->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/semantic/semantic.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/semantic/main.css" />
	
	<!-- JS -->
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<!--        <script src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.blockUI.js"></script>-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/semantic/semantic.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/semantic/main.js"></script>	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/semantic/jquery.address.js"></script>	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>		
	
</head>
<body>

<!-- Menu Superior -->
<nav id="barra" class="<?php echo SemanticForm::colorBarra();?>">
       <?php if(!Yii::app()->user->isGuest): ?> 
        <a class="view-ui item" onClick="menuizq();">
            <i class="sidebar icon"></i>
            Menu
        </a>
    
    
    <a href="<?php echo Yii::app()->homeUrl ?>"  class="brand item"><i class="file text icon"></i>Aplicación de Puntos de Cuenta</a>
	<?php endif; ?>	
        <?php if(!Yii::app()->user->isGuest): ?>
                <div class="right menu">
	        <div class="ui dropdown item">
				<i class="user icon"></i>
				Usuario: <b><?php echo Yii::app()->user->name; ?></b>
	          <i class="dropdown icon"></i>
	          <div class="menu ui transition hidden">
			      <a href="<?php echo Yii::app()->createUrl("/usuarios/usuario/Nueva") ?>" class="item"><i class="settings icon"></i> Cambiar Contraseña</a>
			      <a href="<?php echo Yii::app()->createUrl("/usuarios/usuario/logout") ?>" class="item"><i class="sign out icon"></i> Cerrar Sesi&oacute;n </a>
	          </div>
	        </div>
                </div>    
        <?php endif; ?>
        
        
    </nav> 
<!-- Menu Superior -->	
 <?php //echo '<pre>';print_r( Yii::app()->getController()->getAction());exit; ?>
<?php if(!Yii::app()->user->isGuest): ?>
	<!-- Menu Lado Izquierdo -->
	  <div class="ui large vertical menuizq labeled icon sidebar menu">
	    
         	<img src="images/gmvv.png" class="ui image" border="0" >
         

	     <?php echo  SemanticForm::menu_2();?>
	  </div>


  <?php endif; ?>
	
    <main class="ui page grid">

        <div class="row" style="margin-top:20px">
            <div class="column">
            	<!-- estudiar loader 
				<div class="ui active dimmer"><div class="ui medium text loader">Cargando...</div></div>
				 -->          
	
	<?php  /* 			 
<div id="breadcrumbs">
<?php $this->widget('application.components.BreadCrumb', array(
  'newCrumb' =>
    array('name' => isset($this->crumbTitle)?$this->crumbTitle:$this->getPageTitle(), 'url' => array($_SERVER['REQUEST_URI']))
)); ?>
</div>				 
			*/?>	 
				 
				   <?php if(isset($this->breadcrumbs)):?>
					<?php $this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
						//'separator'=>' &rarr;',
						'separator'=>' <i class="right arrow icon divider"></i>',
					    'htmlOptions' => array(
					      'class' => 'ui breadcrumb'
					    )					
					)); ?>
					<?php endif; ?>
					
					
					
					<?php echo $content; ?>
			</div>
		</div>

		
    </main>



<div class="ui divider"></div>

<div class="ui center aligned one column grid">
	<div class="row">
        <div class="column">
          <p style="color: #B0B0B0">GLOBAL SERVICE GREY C.A - <?php echo date('Y'); ?>.</p>
		</div>
	</div>
</div>

</body>

</html>
