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

    <h1 class="centrar">A&ntilde;adir medida</h1>

    <?php

    echo form_open('medida/save');

    ?>

    		<label>Valor</label>
    		
    		<?php

    		echo form_input('valor',set_value('valor')).' <span class="ayuda" id="ayuda1"><a href="#" id="ay1">?</a></span>';
			
			?>
            
            <div style="clear:both"></div>
    		<label>Fecha</label>
    		<?php 
			
			$fecha = array(
			              'name'        => 'fecha',
			              'id'          => 'fecha'
			            );
			
			echo form_input($fecha).' <span class="ayuda" id="ayuda2"><a href="#" id="ay2">?</a></span>'; 
			
			?>
            
            <div style="clear:both"></div>
    		<label>Hora</label>

    		<?php 
			
			$hora = array(
			              'name'        => 'hora',
			              'id'          => 'hora'
			            );
			
			echo form_input($hora).' <span class="ayuda" id="ayuda3"><a href="#" id="ay3">?</a></span>';
			
			?>

			<div style="clear:both"></div>
    		<label>Tipo</label>
    		
    		<?php
    		
    		$valores = array();
    		foreach ($tipos as $tipo)
    		{
    			$valores[$tipo->id] = $tipo->nombre;
    		}
    	
			echo form_dropdown('tipo',$valores,set_value('tipo')).' <span class="ayuda" id="ayuda4"><a href="#" id="ay4">?</a></span>';
    		
			?>

			<div style="clear:both"></div>
    		<label>Observaciones</label>

    		<?php echo form_textarea('observaciones',set_value('observaciones')).' <span class="ayuda" id="ayuda5"><a href="#" id="ay5">?</a></span>'; ?>

	    	<?php echo validation_errors(); ?>

			<?php 
				$submit = array(
				  'name'        => 'submit',
				  'value'       => 'Aceptar',
				  'class'       => 'bt-submit bt-red bt-big right',
				);
			?><div style="clear:both"></div>
    		<?php echo form_submit($submit); ?>

    <?php 
	
	echo form_close(); 

	?><div style="clear:both"></div>
</div>

	<script src="<?php echo base_url(); ?>js/jquery.grumble.min.js?v=3"></script>
    
<script>
	
		
		$('#ay1').click(function(e){
		var isSequenceComplete = true;
			e.preventDefault();
		
			if(isSequenceComplete === false) return true;
			isSequenceComplete = false;
			
			$('#ayuda1').grumble(
				{
					text: 'A&ntilde;ade el valor de tu toma',
					angle: 50,
					distance: 3,
					showAfter: 50,
					hideAfter: false,
					hasHideButton: true, // just shows the button
					buttonHideText: 'Cerrar!'
				}
			);	
		});
	
</script>

<script>
	
		
		$('#ay2').click(function(e){
		var isSequenceComplete2 = true;
			e.preventDefault();
		
			if(isSequenceComplete2 === false) return true;
			isSequenceComplete2 = false;
			
			$('#ayuda2').grumble(
				{
					text: 'A&ntilde;ade la fecha de tu toma',
					angle: 50,
					distance: 3,
					showAfter: 50,
					hideAfter: false,
					hasHideButton: true, // just shows the button
					buttonHideText: 'Cerrar!'
				}
			);	
		});
	
</script>

<script>
		$('#ay3').click(function(e){
			var isSequenceComplete3 = true;
			e.preventDefault();
		
			if(isSequenceComplete3 === false) return true;
			isSequenceComplete3 = false;
			
			$('#ayuda3').grumble(
				{
					text: 'A&ntilde;ade la hora de tu toma',
					angle: 50,
					distance: 3,
					showAfter: 50,
					hideAfter: false,
					hasHideButton: true, // just shows the button
					buttonHideText: 'Cerrar!'
				}
			);	
		});
	
</script>

<script>
		$('#ay4').click(function(e){
			var isSequenceComplete4 = true;
			e.preventDefault();
		
			if(isSequenceComplete4 === false) return true;
			isSequenceComplete4 = false;
			
			$('#ayuda4').grumble(
				{
					text: 'A&ntilde;ade el momento de tu toma',
					angle: 50,
					distance: 3,
					showAfter: 50,
					hideAfter: false,
					hasHideButton: true, // just shows the button
					buttonHideText: 'Cerrar!'
				}
			);	
		});
	
</script>

<script>
		$('#ay5').click(function(e){
			var isSequenceComplete5 = true;
			e.preventDefault();
		
			if(isSequenceComplete5 === false) return true;
			isSequenceComplete5 = false;
			
			$('#ayuda5').grumble(
				{
					text: 'A&ntilde;ade un texto informativo sobre lo que has comido o vas a comer, como te sientes, etc (opcional)',
					angle: 50,
					distance: 3,
					showAfter: 50,
					hideAfter: false,
					hasHideButton: true, // just shows the button
					buttonHideText: 'Cerrar!'
				}
			);	
		});
	
</script>

