<div class="header">
	<div class="container">
		<div class="top-menu">
	<ul>		
		<li id="inicio" class="inicio <?php echo $homecurrent; ?>"><a href="<?php echo base_url()?>index.php/site/members_area" class="<?php echo $homecurrent; ?>"><span class="arrow"></span>Inicio</a></li>
		<?php 
		
		if($this->session->userdata('role') == '3') //si es usuario
		{ 
			
		?>
		<li id="add_medida" class="add_medida <?php echo $add_medida; ?>"><a href="<?php echo base_url()?>index.php/medida/add" class="<?php echo $add_medida; ?>"><span class="arrow"></span>A&ntilde;adir medida</a></li>
		<!--<li class="last_medida"><a href="<?php echo base_url()?>index.php/medida/ultima_medida" class="<?php echo $last_medida; ?>"><span class="arrow"></span>&Uacute;ltima medidas</a></li>-->
		<li id="manage_medida" class="manage_medida <?php echo $manage_medida; ?>"><a href="<?php echo base_url()?>index.php/medida/manage_per_day" class="<?php echo $manage_medida; ?>"><span class="arrow"></span>Gestionar medidas</a></li>
		<li id="generar_informe" class="generar_informe <?php echo $make_informe; ?>"><a href="<?php echo base_url()?>index.php/informe/make" class="<?php echo $make_informe; ?>"><span class="arrow"></span>Generar informe</a></li>
		<li id="configuracion" class="configuracion <?php echo $setup_user; ?>"><a href="<?php echo base_url()?>index.php/configuracion" class="<?php echo $setup_user; ?>"><span class="arrow"></span>Configuraci&oacute;n</a></li>
		<?php 
		}
		else if(($this->session->userdata('role') == '2')) //si es editor
		{
		?>
			<li id="manage_receta" class="manage_receta <?php echo $manage_receta; ?>"><a href="<?php echo base_url()?>index.php/recetas/manage" class="<?php echo $manage_receta; ?>"><span class="arrow"></span>Gestionar recetas</a></li>
			<li id="add_receta" class="add_receta <?php echo $add_receta; ?>"><a href="<?php echo base_url()?>index.php/recetas/add" class="<?php echo $add_receta; ?>"><span class="arrow"></span>A&ntilde;adir recetas</a></li>
				
		<?php 
				
		}
		
		if($this->session->userdata('role') == '1')
		{
			
		?>
			<li id="manage_editor" class="manage_editor <?php echo $manage_editor; ?>"><a href="<?php echo base_url()?>index.php/editor/manage" class="<?php echo $manage_editor; ?>"><span class="arrow"></span>Gestionar editores</a></li>
			<li id="add_editor" class="add_editor <?php echo $add_editor; ?>"><a href="<?php echo base_url()?>index.php/editor/add" class="<?php echo $add_editor; ?>"><span class="arrow"></span>A&ntilde;adir editores</a></li>		
		<?php
		}
		?>
		<li id="salir" class="salir"><?php echo anchor('login/logout', 'Desconectar'); ?></li>
        </ul>
		</div>
	</div>
</div>


<div id="logo-interior"><img src="/images/mediabetes-beta.png" alt="mediabetes"  /></div>
<!--<a href="#" id="help">Ayuda</a>-->

<script>
var isSequenceComplete = true;
$('#help').click(function(e){
	e.preventDefault();
	if(isSequenceComplete === false) return true;
	isSequenceComplete = false;
	$('#inicio').grumble(
	{
		text: 'Dashboard', 
		angle: 180, 
		distance: 10, 
		showAfter: 500,
		//type: 'alt-', 
		hideAfter: 2000,
	} );
	$('#add_medida').grumble(
	{
		text: 'Añadir medida',
		angle: 150,
		distance: 10,
		showAfter: 2500,
		hideAfter: 2000,
		//hasHideButton: true, // just shows the button
		//buttonHideText: 'Pop!'
	} );
} );
</script>