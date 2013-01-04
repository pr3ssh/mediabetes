<div id="login_form">
<?php foreach($records as $row) {?>
	<h1>Editar Editor</h1>

    <?php

    echo form_open('editor/update_editor/'.$this->uri->segment(3));
    
    ?>

    		<label>Nombre</label>
    		
    		<?php

    		echo form_input('first_name',set_value('first_name', $row->first_name));
			
			?>
    		<label>Apellido</label>
    		
				
    		<?php

    		echo form_input('last_name',set_value('last_name', $row->last_name));
			
			?>

    		<label>Email</label>

    		<?php

    		echo form_input('email',set_value('email', $row->email_address));
			
			?>
			
    		<label>Usuario</label>

    		<?php

    		echo form_input('username',set_value('username', $row->username));
			
			?>			

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