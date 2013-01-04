	<script>

		$(document).ready(function() { 
			$("#fecha").datepicker({ 
				dateFormat: 'yy-mm-dd',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'] 
			    });
			
			$('#hora').timepicker({
				hourText: 'Hora',
			    minuteText: 'Minutos'
			});
		});

	</script>
	
<div id="content" class="clearfix">
<?php foreach($records as $row) {?>
	<h1 class="centrar">Editar medida</h1>

    <?php

    echo form_open('medida/update_medida/'.$this->uri->segment(3));
    
    ?>

    		<label>Valor</label>
    		
    		<?php

    		echo form_input('valor',set_value('valor', $row->valor));
			
			?>
    		<label>Fecha</label>
    		
				
    		<?php 
			
			$fecha = array(
			              'name'        => 'fecha',
			              'id'          => 'fecha',
				    	  'value'       => $row->fecha
			            );
			
			echo form_input($fecha); 
			
			?>

    		<label>Hora</label>

    		<?php 
			
			$hora = array(
			              'name'        => 'hora',
			              'id'          => 'hora',
				    	  'value'       => $row->hora
			            );
			
			echo form_input($hora);
			
			?>

    		<label>Tipo</label>
    		
    		<?php
    		
			$valores = array();
    		foreach ($tipos as $tipo)
    		{
    			$valores[$tipo->id] = $tipo->nombre;
    		}
    	
			echo form_dropdown('tipo',$valores,set_value('tipo', $row->tipo));
    		
			?>

    		<label>Observaciones</label>

    		<?php echo form_textarea('observaciones',set_value('observaciones', $row->observaciones)); ?>

    		<?php echo validation_errors(); ?>

    		<?php $submit = array(
              'name'        => 'submit',
              'value'       => 'Actualizar',
              'class'       => 'bt-submit bt-red bt-big right',
            );
			echo form_submit($submit);?>

    <?php 
	
	echo form_close(); 

	?>
<?php } ?>
</div>