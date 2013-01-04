<!DOCTYPE html>

<html lang="es"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Mediabetes</title>    
    <META name="description" content="Aplicacion gratuita para llevar el control de tu diabetes de forma sencilla y en cualquier lugar">
	<META name="keywords" content="DIABETES, MEDIR AZUCAR EN SANGRE, APLICACION DIABETES">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.png" type="image/png" />
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.8.16.custom.css" />
	<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-timepicker.css" />
	<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/grumble.css" />
    
    <!-- slider css -->
    
    <?php if(current_url() == 'http://www.mediabetes.es/index.php') { ?>
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/slider/default/default.css" />
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/slider/pascal/pascal.css" />
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/slider/orman/orman.css" />
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/slider/nivo-slider.css" />
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>css/slider/style.css" />
    <?php } ?>
    <link href="https://plus.google.com/117659148951965045694" rel="publisher" />

	<script src="<?php echo base_url(); ?>js/jquery-1.6.2.min.js" type="text/javascript"></script>
	

	<script src="<?php echo base_url(); ?>js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/jquery.ui.timepicker.js" type="text/javascript"></script>
		
	<!-- TinyMCE -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			        mode : "textareas",
			        theme : "advanced",
			        

			        // Theme options
			        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,undo,redo",
					theme_advanced_buttons2: "",
					    theme_advanced_buttons3: "",
					    theme_advanced_buttons4: "",
			    
			        theme_advanced_toolbar_location : "top",
			        theme_advanced_toolbar_align : "left",
			        theme_advanced_statusbar_location : "",
			        theme_advanced_resizing : true,

			        // Example content CSS (should be your site CSS)
			        content_css : "css/tinymce.css",

			        // Drop lists for link/image/media/template dialogs
			        template_external_list_url : "js/template_list.js",
			        external_link_list_url : "js/link_list.js",
			        external_image_list_url : "js/image_list.js",
			        media_external_list_url : "js/media_list.js",

			        
			
		});
	</script>
	<!-- /TinyMCE -->
    
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
