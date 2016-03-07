<table class="tabla">
    <tr class="encabezado">
        <td class="encabezado_td" colspan="2"><h3>ASUNTO:</h3></td>
    </tr>
    <tr>
        <td class="texto" colspan="2"><?php echo $model->asunto;?></td>
    </tr>
    <tr class="encabezado">
        <td class="encabezado_td" colspan="2"><h3>SÍNTESIS:</h3></td>
    </tr>
    <tr>
        <td class="texto" colspan="2"><?php echo $model->descripcion;?></td>
    </tr>
     <tr class="encabezado">
        <td class="encabezado_td" colspan="2"><h3>RECOMENDACIONES:</h3></td>
    </tr>
    <tr>
        <td class="texto" colspan="2"><?php echo $model->recomendaciones;?> </td>
    </tr>
         <tr class="encabezado">
        <td class="encabezado_td" colspan="2"><h3>COMENTARIOS DEL CUIDADANO <?php if ($model->presidencial)echo 'PRESIDENTE';else echo 'MINISTRO';?>:</h3></td>
    </tr>
    <tr>
        <td class="texto" colspan="2"><?php //echo $model->descripcion;?> <br><br></td>
    </tr>
    </tr>
         <tr class="encabezado">
             <td class="encabezado_td" colspan="2"><h3>DECISIÓN DEL CUIDADANO <?php if ($model->presidencial)echo 'PRESIDENTE';else echo 'MINISTRO';?>:</h3></td>
    </tr>
    <tr>
        <td class="texto"><?php //echo $model->descripcion;?> <br><br></td>
    </tr>
    <tr>
        <td class="firma"><b>FIRMA Y SELLO DE LA DEPENDENCIA:</b></td>
        <td class="firma"><b>FIRMA Y SELLO DEL <?php if($model->presidencial)echo 'PRESIDENTE';else echo 'MINISTRO';?></b></td>
    </tr>
    <tr>
        <td colspan="2"><b>FECHA DE APROBACIÓN:  </b><?php echo $model->fecha_aprobacion;?></td>
    </tr>
    
</table>
 <style type="text/css">
    
 .tabla
 {
   width: 100%;
   border-color: #000000; 
   border-style:solid; 
   border-width: 1px;
   padding: 0px;
   border-spacing:0px;  
     
  }    
 .encabezado
 {
  background:#DF0101;
  padding: 0px;
  border-spacing:0px;
  border-color: #000000;
  border-style:solid; 
  border-width: 1px;   
     
 }
 
 .encabezado_td
 {
    border-color: #000000;
    color: #FFF; 
    border-style:solid; 
    border-width: 1px; 
  }
  
  .texto {
      text-align: justify;
      line-height: 1.5em;
     }
  .firma
  {
    border-color: #000000;
    border-style:solid; 
    border-width: 1px;   
    height: 150px;  
    vertical-align: top;
    text-align: center;
  }
</style> 