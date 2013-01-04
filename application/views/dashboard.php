<div id="content" class="clearfix">
	
	
	
	<?php
	//$datestring = "%h:%i";
	$datestring_momento = "%H";
	$time = time();
	
	$t=mdate($datestring_momento, $time)+9; //Le sumamos 9 a la hora del servidor, porque es la diferencia horaria con España, lugar donde se va a utilizar en principio.
	
	echo '<div id="dash_bienvenida" style="margin-bottom: 20px;">';
	if (($t>6) and ($t<12)) {
		echo "Buenos d&iacute;as";
	}
	else if (($t>11) and ($t<22)) {
		echo "Buenas tardes";
	}
	else if (($t>21) or ($t<7)) {
		echo "Buenas noches";
	}
	//echo mdate($datestring, $time);
	
	?>
	
	<?php 
	
	foreach($records as $row) 
	{
		echo anchor('configuracion',$row->first_name.' '.$row->last_name);
	} 
	
	?>
	</div>
	
	<div id="dash_left">
	<div id="dash_medida" class="dash_content">
	<?php
	
	if ($medida != '') {
	foreach($medida as $row) 
	{
		echo '<h2>&Uacute;ltima medida</h2>';
		echo '<div class="htc clearfix"><strong>'.$row->valor.'</strong>mg/dL</div>';
		echo 'El '.$row->fecha;
		if ($row->tipo == 1) {
			echo ' antes del desayuno';
		}
		else if ($row->tipo == 2) {
			echo ' despu&eacutes del desayuno';
		}
		else if ($row->tipo == 3) {
			echo ' antes del almuerzo';
		}
		else if ($row->tipo == 4) {
			echo ' despu&eacutes del almuerzo';
		}
		else if ($row->tipo == 5) {
			echo ' antes de la cena';
		}
		else if ($row->tipo == 6) {
			echo ' despu&eacutes de la cena';
		}
		else if ($row->tipo == 7) {
			echo ' de Madrugada';
		}
	}
	
	echo '<div class="datos_dashboard">';
	echo '<h2>&Uacute;ltimo d&iacute;a</h2>';
	echo '<p>M&aacute;x &uacute;ltimo d&iacute;a: <strong>'.$dia_max.'</strong>mg/dL</p>';
	echo '<p>M&iacute;n &uacute;ltimo d&iacute;a: <strong>'.$dia_min.'</strong>mg/dL</p>';
	echo '<p>Media &uacute;ltimo d&iacute;a: <strong>'.$dia_media.'</strong>mg/dL</p>';
	echo '</div>';
	
	//ultimo mes
	echo '<div class="datos_dashboard">';
	/*echo '<h2>&Uacute;ltimo mes</h2>';
	echo '<p>M&aacute;xima &uacute;ltimo mes: <strong>'.$dia_max.'</strong>mg/dL</p>';
	echo '<p>M&iacute;nima &uacute;ltimo mes: <strong>'.$dia_min.'</strong>mg/dL</p>';
	echo '<p>Media &uacute;ltimo mes: <strong>'.$dia_media.'</strong>mg/dL</p>';*/
	echo '</div>';
	}
	?>
	</div>
	
	
	</div> <!-- Fin del div dash_left -->
	
    <div id="dash_centro">
    <!--<div id="dash_consejo" class="dash_content">
		<h2>Consejo del d&iacute;a:</h2><div class="italic">No tomes mas azuuuucar</div>
	</div>-->
    <?php 
    if ($medida != '') { ?>
    	<div class="jqplot code" id="chart1" style="height: 256px"></div>
        <div class="jqplot code" id="chart2" style="height: 256px"></div>
        <!--<div class="jqplot code" id="chart3" style="height: 256px"></div>-->
    <?php 
	} else { ?>
		<h1>Gracias por registrarte en Mediabetes</h1>
        <p>Esperamos que Mediabetes te sea &uacute;til en el control diario de tu diabetes</p>
        <p>Mediabetes se encuentra en fase beta; por ello, estamos trabajando a fondo para ofrecerte la mejor aplicaci&oacute;n de forma totalmente gratu&iacute;ta</p>
        <p>Si encuentras alg&uacute;n error, crees que podr&iacute;amos a&ntilde;adir m&aacute;s funcionalidades, o simplemente quieres dejar un comentario, somos todo o&iacute;dos. Por favor, escr&iacute;benos a <a href="mailto:hola@mediabetes.es">hola@mediabetes.es</a></p>
        <p>Y ahora, tiempo de a&ntilde;adir tus datos</p>
        <p>Un cordial saludo,<br />el equipo de <img src="/images/mediabetes-firma.jpg" alt="mediabetes" /></p>
	<?php }
	?>
    </div>
	<div id="dash_right">
	<div id="dash_noticias">
		<h2>Noticias</h2>
		<ul>
        <?php 
		foreach($res_feed as $item) {
			echo '<li><a href="'.$item->get_link().'" target="_blank">'.$item->get_title().'</a></li>';
		}
		?>
		</ul>
		<br />
		<p style="border-top: 2px solid #ccc; font-size: 10px; font-style: italic">Noticias extra&iacute;das de <a style="font-size: 10px;" href="http://www.fedesp.es/" target="_blank">fedesp</a></p>
	</div>
	</div> <!-- Fin del div dash_right -->
	
    <div style="clear:both;"></div>
    

</div>