
<div id="logo-login"><a href="/" title="mediabetes"><img src="/images/mediabetes-inicio-rosa-500.png" alt="mediabetes"  /></a></div>

<div id="login_form" style="margin-top:80px;">

<h1>Registro</h1>
	
	<?php
	
	echo form_open('login/create_member');
	echo '<label>Nombre:</label>';
	echo form_input('first_name', set_value('first_name'));
	echo '<label>Apellido:</label>';
	echo form_input('last_name', set_value('last_name'));
	echo '<label>Email:</label>';
	echo form_input('email_address', set_value('email_address'));
	
	?>
	
	
	<?php
	
	echo '<label>Usuario:</label>';
	echo form_input('username', set_value('username'));
	echo '<label>Contrase&ntilde;a:</label>';
	echo form_password('password', set_value('password'));
	echo '<label>Repite tu contrase&ntilde;a:</label>';
	echo form_password('password2', set_value('password2'));
	$submit = array(
              'name'        => 'submit',
              'value'       => 'Crear Cuenta',
              'class'       => 'bt-submit bt-red bt-big right',
            );
	echo form_submit($submit);
	
	?>
    
    <p class="registro">Todo usuario que se registre en<a href="/" title="mediabetes">mediabetes.es</a> <strong>ACEPTA</strong> la<a href="/politica-de-privacidad.php" target="_blank" title="Política de Privacidad">pol&iacute;tica de privacidad</a></p>
    
	<?php echo '<div class="error">'.validation_errors().'</div>'; ?>
	
	<?php echo form_close(); ?>
	
</div>