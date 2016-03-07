<?php

// this contains the application parameters that can be maintained via GUI
return array(
	//nombre de los modelos que seran Instanciado para las busquedas de los select2 remotos de forma publica
       'clase'=> array('GeoEstado','GeoMunicipio','GeoParroquia'),
	// this is used in contact page
	'adminEmail'=>'webmaster@example.com',
	
	// ##configuracion de servidor de correo##
	'mailHost'=>'correo.sundde.gob.ve',
	'mailPortSsl'=>'587',
	'mailUsername'=>'jzafra@sundde.gob.ve',
	'mailUserPassw'=>'jzafra',	
        'mailRemitente'=>'noresponder@sundde.gob.ve',
	'nombreRemitente'=>'Superintendencia de Precios Justos',	
	'correoReporteError'=>array('halvarado@sundde.gob.ve'),		
   		

);
