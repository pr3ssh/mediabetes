<script>

		$(document).ready(function() { 
			$("#fecha_inicio").datepicker({ 
				dateFormat: 'yy-mm-dd',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'] 
			    });
			$("#fecha_fin").datepicker({ 
				dateFormat: 'yy-mm-dd',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'] 
			    });
		});

	</script>

<div id="content">
<h1 class="centrar">Generar informe</h1>
	
	<?php

    	echo form_open('informe/make');
     
		$fecha_inicio = array(
			'name'	=>	'fecha_inicio',
		    'id'	=>	'fecha_inicio',
		    'value'	=>	$fecha_inicio,
		);
		echo '<label>Fecha inicio: </label>';
		echo form_input($fecha_inicio); 
		
		$fecha_fin = array(
			'name'	=>	'fecha_fin',
		    'id'	=>	'fecha_fin',
		    'value'	=>	$fecha_fin,
		);
		
		echo '<label>Fecha fin: </label>';
		echo form_input($fecha_fin); 
		 
		$submit = array(
			'name'	=>	'submit',
			'value'	=>	'Descarga PDF',
			'class'	=>	'bt-submit bt-red bt-big right',
		);
	
		echo form_submit($submit);

		echo form_close();
		
		/*foreach ($medidas as $medida)
		{
			echo $medida->id . ' - ' . $medida->valor . '<br />';
		}*/
		
	?>

</div>