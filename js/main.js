$(document).ready(function(){

	
	
});


function formato_numero(numero){ 
	
	var decimales=2,separador_decimal=",", separador_miles=".";
    numero=parseFloat(numero);
    if(isNaN(numero)){
        return "";
    }
    if(decimales!==undefined){
        // Redondeamos
        numero=numero.toFixed(decimales);
    }

    // Convertimos el punto en separador_decimal
  //  numero=numero.toString().replace(".", separador_decimal!==undefined ? separador_decimal : ",");

 /*   if(separador_miles){
        // Añadimos los separadores de miles
        var miles=new RegExp("(-?[0-9]+)([0-9]{3})");
        while(miles.test(numero)) {
            numero=numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }
*/
    return numero;
}

function formato_js(numero){

	numero=numero.toString().replace(/\./g, "");
	numero=numero.toString().replace(/\,/g, ".");
	return numero;
	
}


function cambiar_interfaz(color)
{

    $("#barra").removeAttr("class");
    $("#barra").addClass("ui fixed menu "+color+" inverted navbar");
     
}