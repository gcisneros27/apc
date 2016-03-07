
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js" language="javascript" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">

        $(function() { $.configureBoxes({ transferMode: 'move', useFilters: true, useCounters: true,selectOnSubmit:true });        

					  $.configureBoxes({            
            			 box1View: 'box3View',           
            			 box1Storage: 'box3Storage',            
            			 box1Filter: 'box3Filter',            
            			 box1Clear: 'box3Clear',            
            			 box1Counter: 'box3Counter',            
            			 box2View: 'box4View',            
            			 box2Storage: 'box4Storage',            
            			 box2Filter: 'box4Filter',            
            			 box2Clear: 'box4Clear',            
            			 box2Counter: 'box4Counter',            
            			 to1: 'to3',            
            			 to2: 'to4',            
            			 allTo1: 'allTo3',            
            			 allTo2: 'allTo4'        
                			 });      
					  $.configureBoxes({            
	            			 box1View: 'box5View',           
	            			 box1Storage: 'box5Storage',            
	            			 box1Filter: 'box5Filter',            
	            			 box1Clear: 'box5Clear',            
	            			 box1Counter: 'box5Counter',            
	            			 box2View: 'box6View',            
	            			 box2Storage: 'box6Storage',            
	            			 box2Filter: 'box6Filter',            
	            			 box2Clear: 'box6Clear',            
	            			 box2Counter: 'box6Counter',            
	            			 to1: 'to5',            
	            			 to2: 'to6',            
	            			 allTo1: 'allTo5',            
	            			 allTo2: 'allTo6'        
	                			 });     
       			 });
        
    </script>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dualListbox-1.3/styles.css" type="text/css" rel="stylesheet" />




   <?php /* $this->beginWidget('application.extensions.jui.ETab', array('name'=>'tab1', 'title'=>'Asignar Roles')); ?>

	<div>
	<table>
            <tr>
                <td>
			Filtro: <input type="text" id="box1Filter" /><button type="button" id="box1Clear">X</button><br /><br />
			<div>Roles No Asignados</div><br/>
			<select id="box1View" multiple="multiple" style="height:500px;width:300px;">
			<?php 
			
				foreach($roles as $rol) {
					echo "<option value='".$rol."'>".$rol."</option>";
				}
			
			?>				
			</select><br/>

			<span id="box1Counter" class="countLabel"></span>
			<select id="box1Storage">		
			</select>
                </td>
                <td>
			<button id="to2" type="button">&nbsp;>&nbsp;</button>
			<button id="allTo2" type="button">&nbsp;>>&nbsp;</button>
			<button id="allTo1" type="button">&nbsp;<<&nbsp;</button>
			<button id="to1" type="button">&nbsp;<&nbsp;</button>
                </td>
                <td>
			Filtro: <input type="text" id="box2Filter" /><button type="button" id="box2Clear">X</button><br /><br />
			<div>Roles Asignados</div><br/>
			<select name="roles[]" id="box2View" multiple="multiple" style="height:500px;width:300px;">
			<?php 
			
				foreach($rolesChild as $rol) {
					echo "<option value='".$rol['child']."'>".$rol['child']."</option>";
				}
			
			?>	
			</select><br/>
			<span id="box2Counter" class="countLabel"></span>
			<select id="box2Storage">
			</select>
                </td>
            </tr>

	</table>
	</div>
	
	<?php $this->endWidget('application.extensions.jui.ETab'); */?>
	
	

	
	
<div class="ui tab segment" data-tab="tarea">


	<div>
	<table>
            <tr>
                <td>
			Filtro: <input type="text" id="box3Filter" /><button type="button" id="box3Clear">X</button><br /><br />
			<div>Tareas No Asignadas</div><br/>
			<select id="box3View" multiple="multiple" style="height:500px;width:300px;">
			<?php 
			
				foreach($tareas as $tarea) {
					echo "<option value='".$tarea."'>".$tarea."</option>";
				}
			
			?>				
			</select><br/>

			<span id="box3Counter" class="countLabel"></span>
			<select id="box3Storage">		
			</select>
                </td>
                <td>
			<button id="to4" type="button">&nbsp;>&nbsp;</button>
			<button id="allTo4" type="button">&nbsp;>>&nbsp;</button>
			<button id="allTo3" type="button">&nbsp;<<&nbsp;</button>
			<button id="to3" type="button">&nbsp;<&nbsp;</button>
                </td>
                <td>
			Filtro: <input type="text" id="box4Filter" /><button type="button" id="box4Clear">X</button><br /><br />
			<div>Tareas Asignadas</div><br/>
			<select name="tareas[]" id="box4View" multiple="multiple" style="height:500px;width:300px;">
			<?php 
			
				foreach($tareasChild as $tarea) {
					echo "<option value='".$tarea['child']."'>".$tarea['child']."</option>";
				}
			
			?>	
			</select><br/>
			<span id="box4Counter" class="countLabel"></span>
			<select id="box4Storage">
			</select>
                </td>
            </tr>

	</table>
	</div>

</div>
<div class="ui tab segment" data-tab="operacion">	

	<div>
	<table>
            <tr>
                <td>
			Filtro: <input type="text" id="box5Filter" /><button type="button" id="box5Clear">X</button><br /><br />
			<div>Operaciones No Asignadas</div><br/>
			<select id="box5View" multiple="multiple" style="height:500px;width:300px;">
			<?php 
			
				foreach($operaciones as $operacion) {
					echo "<option value='".$operacion."'>".$operacion."</option>";
				}
			
			?>				
			</select><br/>

			<span id="box5Counter" class="countLabel"></span>
			<select id="box5Storage">		
			</select>
                </td>
                <td>
			<button id="to6" type="button">&nbsp;>&nbsp;</button>
			<button id="allTo6" type="button">&nbsp;>>&nbsp;</button>
			<button id="allTo5" type="button">&nbsp;<<&nbsp;</button>
			<button id="to5" type="button">&nbsp;<&nbsp;</button>
                </td>
                <td>
			Filtro: <input type="text" id="box6Filter" /><button type="button" id="box6Clear">X</button><br /><br />
			<div>Operaciones Asignadas</div><br/>
			<select name="operaciones[]" id="box6View" multiple="multiple" style="height:500px;width:300px;">
			<?php 
			
				foreach($operacionesChild as $operacion) {
					echo "<option value='".$operacion['child']."'>".$operacion['child']."</option>";
				}
			
			?>	
			</select><br/>
			<span id="box6Counter" class="countLabel"></span>
			<select id="box6Storage">
			</select>
                </td>
            </tr>

	</table>
	</div>

</div>



