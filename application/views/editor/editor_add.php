<div id="login_form">

    <h1>A&ntilde;adir Editor</h1>

    <?php
	
	echo form_open('editor/save');
	echo '<label>Nombre:</label>';
	echo form_input('first_name', set_value('first_name'));
	echo '<label>Apellido:</label>';
	echo form_input('last_name', set_value('last_name'));
	echo '<label>Email:</label>';
	echo form_input('email_address', set_value('email_address'));
	
	?>
	
	
	<?php
	
	echo '<label>Username:</label>';
	echo form_input('username', set_value('username'));
	echo '<label>Contrase&ntilde;a:</label>';
	echo form_password('password', set_value('password'));
	echo '<label>Vuelve a escribir tu contrase&ntilde;a:</label>';
	echo form_password('password2', set_value('password2'));
	$submit = array(
              'name'        => 'submit',
              'value'       => 'Crear Cuenta',
              'class'       => 'bt-submit bt-red bt-big right',
            );
	echo form_submit($submit);
	
	?>
	
	<?php echo '<div class="error">'.validation_errors().'</div>'; ?>
	
	<?php echo form_close(); ?>
</div>