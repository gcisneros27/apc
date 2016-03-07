
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
<div>
<?php $this->beginWidget('application.extensions.jui.ETabs', array('name'=>'tabpanel1')); ?>
    <?php $this->beginWidget('application.extensions.jui.ETab', array('name'=>'tab3', 'title'=>'Asignar Operaciones')); ?>
	<div>
	<table>
            <tr>
                <td width="41%">
			Filtro: <input style="width:90%" type="text" id="box5Filter" /><button type="button" id="box5Clear">X</button><br /><br />
			<div>Operaciones No Asignadas</div><br/>
			<select id="box5View" multiple="multiple" style="height:500px;width:100%;">
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
                <td  width="19%">
			<button id="to6" type="button">&nbsp;>&nbsp;</button>
			<button id="allTo6" type="button">&nbsp;>>&nbsp;</button>
			<button id="allTo5" type="button">&nbsp;<<&nbsp;</button>
			<button id="to5" type="button">&nbsp;<&nbsp;</button>
                </td>
                <td  width="41%">
			Filtro: <input style="width:90%" type="text" id="box6Filter" /><button type="button" id="box6Clear">X</button><br /><br />
			<div>Operaciones Asignadas</div><br/>
			<select name="operaciones[]" id="box6View" multiple="multiple" style="height:500px;width:100%;">
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

    <?php $this->endWidget('application.extensions.jui.ETab'); ?>
<?php $this->endWidget('application.extensions.jui.ETabs'); ?>

</div>

