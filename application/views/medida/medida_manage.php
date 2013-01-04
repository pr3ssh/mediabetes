<script>

		$(document).ready(function() { 
			$("#fecha").datepicker({ 
				dateFormat: 'yy-mm-dd',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'] 
			    });
		});

	</script>

<div id="content">
<h1 class="centrar">Gestionar medidas<?php //echo $fecha; ?></h1>
<div id="form_manage">	
	<?php

    	echo form_open('medida/manage_per_day');
     
		$fecha = array(
			'name'	=>	'fecha',
		    'id'	=>	'fecha'
		);
		
		echo form_input($fecha).' <span class="ayuda" id="ayuda1"><a href="#" id="ay1">?</a></span>'; 
		echo '<div style="clear:both"></div>';
		 
		$submit = array(
			'name'	=>	'submit',
			'value'	=>	'Ir',
			'class'	=>	'bt-submit bt-red bt-big right',
		);
	
		echo form_submit($submit);
		echo '<div style="clear:both"></div>';
		echo form_close();
		
		$array_medidas = array();
		foreach ($medidas as $medida)
		{
			$array_medidas[$medida->tipo] = array (
				'id'	=>	$medida->id,
				'valor'	=>	$medida->valor,
			);
		}
		
	?>
    
</div>

<ul>
	<li>
		<?php show_type(1, $array_medidas); ?>
	</li>
	<li>
		<?php show_type(2, $array_medidas); ?>
	</li>
	<li>
		<?php show_type(3, $array_medidas); ?>
	</li>
	<li>
		<?php show_type(4, $array_medidas); ?>
	</li>
	<li>
		<?php show_type(5, $array_medidas); ?>
	</li>
	<li>
		<?php show_type(6, $array_medidas); ?>
	</li>
	<li>
		<?php show_type(7, $array_medidas); ?>
	</li>
</ul>
</div>

<?php
function show_type($tipo, $array_medidas)
{
	if ( $tipo == 1) $nombre_tipo='<strong>Antes del desayuno: </strong>';
	else if ( $tipo == 2) $nombre_tipo='<strong>Despu&eacute;s del desayuno: </strong>';
	else if ( $tipo == 3) $nombre_tipo='<strong>Antes del almuerzo: </strong>';
	else if ( $tipo == 4) $nombre_tipo='<strong>Despu&eacute;s del almuerzo: </strong>';
	else if ( $tipo == 5) $nombre_tipo='<strong>Antes de la cena: </strong>';
	else if ( $tipo == 6) $nombre_tipo='<strong>Despu&eacute;s de la cena: </strong>';
	else if ( $tipo == 7) $nombre_tipo='<strong>Madrugada: </strong>';
	echo $nombre_tipo.' ';
	if (!isset($array_medidas[$tipo]))
	{
		echo 'No a&ntilde;adido';
	} else {
		echo $array_medidas[$tipo]['valor'];
		echo ' '.anchor("medida/editar_medida/".$array_medidas[$tipo]['id'], 'Editar') . ' / ' . anchor("medida/delete/id/".$array_medidas[$tipo]['id'], 'Borrar');
	}
	echo '</p>';
}
?>

<script src="<?php echo base_url(); ?>js/jquery.grumble.min.js?v=3"></script>
    
<script>		
		$('#ay1').click(function(e){
		var isSequenceComplete = true;
			e.preventDefault();
		
			if(isSequenceComplete === false) return true;
			isSequenceComplete = false;
			
			$('#ayuda1').grumble(
				{
					text: 'Elige el d&iacute;a para gestior tus medidas',
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