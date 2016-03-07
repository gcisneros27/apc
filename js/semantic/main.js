$(document).ready(function(){
	$('.ui.dropdown').dropdown();
	
/* Animacion Boton Menu Izq*/
$(".launch.button").mouseenter(function(){//over
		$(this).stop().animate({width: '140px'}, 250, 
             function(){$(this).find('.text').show();});
	}).mouseleave(function (event){//otro
		$(this).find('.text').hide();
		$(this).stop().animate({width: '50px'}, 300);
	});	
	
/* Comentarios */
$('.comentario-focus')
.popup({
  on: 'focus'
})
;

/* Comentarios */
$('.comentario-hover')
.popup({
  on: 'hover'
})
;

/*checks box*/
$('.ui.checkbox')
.checkbox()
;

//cerrar mensajes de alerta
$('.message .close').on('click', function() {
	  $(this).closest('.message').fadeOut();
	});

//bloquear formulario al enviar
$('form.blockuis').on('submit',function() {
	$( "#cargando" ).addClass( "active" );
});



//initialize both popups inline
$('.taulador.menu .item')
.tab()
;

});

/* Evento Click Boton Menu Izq */
function menuizq(){
	$('.menuizq.sidebar')
	  .sidebar('toggle')
	;
}	

/* Evento Click Boton Menu Inferior */
function menuinf(){
	$('.menuinf.sidebar')
	  .sidebar('toggle')
	;
}	

/* Evento Click Boton Menu Izq */
function menuder(){
	$('.menuder.sidebar')
	  .sidebar('toggle')
	;
}	

