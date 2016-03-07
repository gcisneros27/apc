<br>
<br>
<h1 align="center" style="font-size:32px;" class="color_titulo">¡Aplicación de Puntos de Cuenta, Bienvenidos!</h1>
   
  <div align="center" style="margin:8px 0 15px 0;">
  	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gmvv.png" />
   
  </div>
    
  

<!--    <div align="center" style="margin:20px 0 15px 0;">
	  <div class="demo ui shape irregular" >
	        <div class="sides">
	          <div class="side active" >
	  			<img height="250" width="350" src="<?php // echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" />
	          </div>
	          <div class="side">
	  			<img height="250" width="350" src="<?php //echo Yii::app()->request->baseUrl; ?>/images/logo_caja.png" />
	          </div>
	        </div>
	  </div>
    </div>-->


<script type="text/javascript">

/*
flip up	Flips the shape upward
flip down	Flips the shape downward
flip right	Flips the shape right
flip left	Flips the shape left
flip over	Flips the shape over clock-wise
flip back	Flips the shape over counter-clockwise 
*/


var contador = 0;
function up(){
	$('.shape').shape('flip up');
}
function right(){
	$('.shape').shape('flip right');
}
function left(){
	$('.shape').shape('flip left');
}

setInterval(function() {
	if(document.hidden)return;
	if(contador==0){right();contador=1;}
	else {up();contador=0;}
}, 5000);

</script>      