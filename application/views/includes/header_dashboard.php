<!DOCTYPE html>

<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Mediabetes</title>    
    <link rel="icon" href="/favicon.png" type="image/png" />
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />

	<script src="<?php echo base_url(); ?>js/jquery-1.6.2.min.js" type="text/javascript"></script>

  <!-- BEGIN: load jqplot -->
  <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jqplot.min.js"></script>
    <?php /*?><script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jqplot.logAxisRenderer.min.js"></script><?php */?>
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
    <?php /*?><script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jqplot.dateAxisRenderer.min.js"></script><?php */?>
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jqplot.barRenderer.min.js"></script>
    
    <style type="text/css">
      .jqplot-point-label {white-space: nowrap;}
/*    .jqplot-yaxis-label {font-size: 14pt;}*/
/*    .jqplot-yaxis-tick {font-size: 7pt;}*/

    div.jqplot {
        height: 256px;
        width: 520px;
		margin-bottom:40px;
    }
    </style>
    
    
        <script class="code" type="text/javascript" language="javascript">
		$(document).ready(function(){
			<?php
			for($i=1;$i<8;$i++) {
				$dia[$i]=0;
			}
			foreach($medida_dia as $m_dia) {
				if($m_dia->valor != NULL) $dia[$m_dia->tipo] = $m_dia->valor;
		  	}
			
			echo 'var line1 = [[\'Ant Desayuno\','.$dia[1].'], [\'Desp Desayuno\', '.$dia[2].'], [\'Ant Almuerzo\', '.$dia[3].'], 
		  [\'Desp Almuerzo\', '.$dia[4].'], [\' Ant Cena\', '.$dia[5].'], 
		  [\'Desp Cena\', '.$dia[6].'], [\'Madrugada\', '.$dia[7].']];';
			 ?>
			 
			<?php

			echo 'var line2 = [[\'Min\','.$dia_min.'], [\'Media\', '.$dia_media.'], [\'Max\', '.$dia_max.']];';
			
			echo 'var line3 = [[\'Min\','.$dia_min.'], [\'Media\', '.$dia_media.'], [\'Max\', '.$dia_max.']];';
			
			?>
		  var plot1 = $.jqplot('chart1', [line1], {
			title: 'Ultimo dia',
			series:[{renderer:$.jqplot.BarRenderer, color:'#21b4fa'}],
			axesDefaults: {
				tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
				tickOptions: {
				  angle: -30,
				  fontSize: '10pt'
				}
			},
			axes: {
			  xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer
			  }
			}
		  });
		  
		  var plot2 = $.jqplot('chart2', [line2], {
			title: 'Datos Estadisticos del ultimo dia',
			series:[{renderer:$.jqplot.BarRenderer, color:'#a2e1f9'}],
			axesDefaults: {
				tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
				tickOptions: {
				  angle: -30,
				  fontSize: '10pt'
				}
			},
			axes: {
			  xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer
			  }
			}
		  });
		  
		  var plot3 = $.jqplot('chart3', [line3], {
			title: 'Datos Estadisticos del ultimo mes',
			series:[{renderer:$.jqplot.BarRenderer, color:'#ee2352'}],
			axesDefaults: {
				tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
				tickOptions: {
				  angle: -30,
				  fontSize: '10pt'
				}
			},
			axes: {
			  xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer
			  }
			}
		  });
		  
		});
		</script>

	 <!-- END: load jqplot -->
	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26993833-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>	
</head>
<body class="<?php 
	if(current_url() == "http://localhost/index.php")
	{
		echo "login";
	}
	else
	{
		echo $this->uri->segment(2);
	}
?>">
