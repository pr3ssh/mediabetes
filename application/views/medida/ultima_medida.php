<div id="content">
<?php if(isset($records)) : foreach($records as $row) : ?>
	
<fieldset>
	<legend>&Uacute;ltima medida</legend>
	
	<?php
	
	echo '<div id="valor">Valor: '.$row->valor.'</div>';
	echo '<div id="fecha">Fecha: '.$row->fecha.'</div>';
	echo '<div id="hora">Hora: '.$row->hora.'</div>';
	echo '<div id="tipo">Tipo: '.$row->tipo.'</div>';
	echo '<div id="observacion">Observaciones: '.$row->observaciones.'</div>';
	/*echo form_input('first_name', set_value('first_name',$row->first_name));
	echo form_input('last_name', set_value('last_name',$row->last_name));
	echo form_input('email_address', set_value('email_address',$row->email_address));*/
	
	?>
	
</fieldset>



<?php endforeach; ?>

<?php else : ?>	
<h2>No records were returned.</h2>
<?php endif; ?>
</div>