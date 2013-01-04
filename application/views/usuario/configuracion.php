<div id="content" class="clearfix">
<?php if(isset($records)) : foreach($records as $row) : ?>
	
<h1 class="centrar">Configuraci&oacute;n Personal</h1>
	
	<?php
	
	echo form_open('configuracion/update_member');
	echo '<label>Nombre:</label>';
	echo form_input('first_name', set_value('first_name',$row->first_name));
	echo '<label>Apellido:</label>';
	echo form_input('last_name', set_value('last_name',$row->last_name));
	echo '<label>Email:</label>';
	echo form_input('email_address', set_value('email_address',$row->email_address));
	
	?>
	
	<?php

	for ($year['cnt'] = 1940; $year['cnt'] <= 2011; $year['cnt']++):
		
				$year['anios'][$year['cnt']] = $year['cnt'];
		
	endfor;
			
	//echo '<label>Email de su m&eacute;dico:</label>';
	//echo form_input('email_medico', set_value('email_medico',$row->email_medico));
	echo '<label>A&ntilde;o del debut diab&eacute;tico:</label>';
	//echo form_input('debut_diabetico', set_value('debut_diabetico',$row->debut_diabetico));
	echo form_dropdown('debut_diabetico', $year['anios'],set_value('debut_diabetico',$row->debut_diabetico));
	//echo '<label>Insulina que se inyecta:</label>';
	//echo form_input('tipo_insulina', set_value('tipo_insulina',$row->tipo_insulina));
	echo '<label>Ciudad:</label>';
	echo form_input('ciudad', set_value('ciudad',$row->ciudad));
	echo '<label>Provincia:</label>';
	echo form_input('provincia', set_value('provincia',$row->provincia));
	
	?>
	
	<?php
	
	echo '<label>Usuario:</label>';
	echo form_input('username', set_value('username',$row->username));
	echo '<label>Contrase&ntilde;a:</label>';
	echo form_password('password');
	echo '<label>Vuelve a escribir tu contrase&ntilde;a:</label>';
	echo form_password('password2');
	
	$submit = array(
              'name'        => 'submit',
              'value'       => 'Actualizar Cuenta',
              'class'       => 'bt-submit bt-red bt-big right',
            );
	echo form_submit($submit);
	
	?>
	
	<?php echo '<p class="error">'.validation_errors().'</p>'; ?>
	
	<?php echo form_close(); ?>


<?php endforeach; ?>

<?php else : ?>	
<h2>No records were returned.</h2>
<?php endif; ?>
</div>