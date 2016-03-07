<div>
    <div>
            <img src="<?php echo Yii::app()->baseUrl.'/images/banner.jpg';?>"/>
    </div>
							
</div>
<table style="padding: 2px;border-spacing: 5px;">
    <tr>
        <td style="border-color: #6E6E6E; border-style:solid; border-width: 0.5px;text-align: center;" colspan="4"><b><?php if ($model->presidencial) echo 'PUNTO DE CUENTA AL CUIDADANO PRESIDENTE DE LA REPUBLICA BOLIVARIANA DE VENEZUELA';else echo 'PUNTO DE CUENTA AL CUIDADANO MINISTRO DEL PODEL POPULAR PARA HÁBITAT Y VIVIENDA DE LA REPUBLICA BOLIVARIANA DE VENEZUELA'; ?></b></td>
    </tr>
    <tr>
        <td style="border-color: #6E6E6E; border-style:solid; border-width: 0.5px;width: 20%;"><b>No:</b> <?php echo $model->co_punto_cuenta;?></td>
        <td style="border-color: #6E6E6E; border-style:solid; border-width: 0.5px;width: 40%;"><b>Presentante:</b><?php echo $model->presentado;?></td>
        <td style="border-color: #6E6E6E; border-style:solid; border-width: 0.5px;width: 20%;"><b>Fecha:</b> <?php echo $model->fecha_aprobacion?></td>
        <td style="border-color: #6E6E6E; border-style:solid; border-width: 0.5px;width: 20%;"><b>Página:</b>  {PAGENO}/{nbpg}</td>
    </tr>  
</table>
