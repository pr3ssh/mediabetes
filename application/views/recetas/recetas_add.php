<div id="login_form">

    <h1>A&ntilde;adir Receta</h1>

    <?php
	
	echo form_open_multipart('recetas/save');
	echo '<label>Titulo:</label>';
	echo form_input('titulo', set_value('titulo'));
	echo '<label>Imagen:</label>';
	$userfile = array(
              'name'        => 'userfile',
              'class'       => 'userfile',
            );
	echo form_upload($userfile);
	
	echo '<label>Receta:</label>';
	echo form_textarea('receta');
	?>
	
	<label>Categor&iacute;a</label>
    		
    <?php
    	
    $valores = array();
    foreach ($cat_recetas as $cat)
    {
    	$valores[$cat->id] = $cat->nombre;
    }
    	
	echo form_dropdown('categoria',$valores,set_value('categoria'));
    		
	?>
			
	<?php
	
	$submit = array(
              'name'        => 'submit',
              'value'       => 'Anadir Receta',
              'class'       => 'bt-submit bt-red bt-big right',
            );
	echo form_submit($submit);
	
	?>
	
	<?php echo '<div class="error">'.validation_errors().'</div>'; ?>
	
	<?php echo form_close(); ?>
</div>