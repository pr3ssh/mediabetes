<div id="login_form">
<?php foreach($records as $row) {?>
	<h1>Editar Receta</h1>

    <?php

    echo form_open_multipart('recetas/update_receta/'.$this->uri->segment(3));
    
    ?>

    		<label>T&iacute;tulo</label>
    		
    		<?php

    		echo form_input('titulo',set_value('titulo', $row->titulo));
			
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
							
			<label>Imagen</label>
    		
    		<?php   		 	
    		
    		if($row->imagen != '0') {
    	
			echo '<img src="'.base_url().'uploads/recetas/'.$row->imagen.'.jpg" alt="'.$row->titulo.'" style="display: block; margin-bottom: 20px;" />';
    		
			}
			
			else
			{
				$userfile = array(
              		'name'        => 'userfile',
            	 	'class'       => 'userfile',
          		  );
				echo form_upload($userfile);
			}
			?>
			
    		<label>Receta</label>
    		
				
    		<?php

    		echo form_textarea('receta',set_value('receta', $row->receta));
			
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