<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Mediabetes</title>
<META name="robots" content="index,nofollow">
<META name="description" content="Mediabetes es una aplicación web que pretende ayudar a los diabéticos a controlar su enfermedad de una forma simple y cómoda. Mediabetes quiere que conozcas tu enfermedad, que te conozcas a ti mismo con respecto a ella y que nos conozcas a nosotros. Entre todos lo conseguiremos.">
<META name="keywords" content="DIABETES, MEDIR AZUCAR EN SANGRE, APLICACION DIABETES, diabeticos">
<link rel="icon" href="/favicon.png" type="image/png" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

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

<body class="login">

<div id="logo-login">
	<img alt="mediabetes" src="images/mediabetes-inicio-rosa-500.png">
</div>

<div style="width:480px; margin:0 auto; margin-top:40px;">
<iframe src="http://player.vimeo.com/video/32047166?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" width="480" height="270" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
</div>

<div id="login_form" style="margin-top:30px;">



<h3>Mantente informado de nuestro pr&oacute;ximo lanzamiento</h3>

<? if (!$_POST){ ?>
<form id="newsletter" method="post" action="">
     <label>Email: </label>
     <input id="cemail" name="email" size="25"  class="required email" />
     <input class="submit bt-submit bt-red bt-big right" type="submit" value="Inf&oacute;rmame"/>
</form>
<?  } else {
		$dbh=mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
		mysql_select_db ("diabetes",$dbh);
		mysql_query("SET NAMES 'utf8'");
		
		$email=mysql_real_escape_string($_POST['email']);
		
		$sql="insert into diabetes.newsletter(email) values ('$email')";
		$resultado=mysql_query($sql);
		mysql_close($dbh);
		
		echo '<br /><h3>Gracias, le mantendremos informados</h3>';
	}
?>
</div>

<div id="redes">
    <a href="https://www.facebook.com/mediabetes" target="_blank" title="Mediabetes en Facebook"><img alt="facebook" src="images/facebook.png"></a>
    <a href="http://www.twitter.com/mediabetes" target="_blank" title="Mediabetes en Twitter"><img alt="twitter" src="images/twitter.png"></a>
</div>


<div id="footer">
	<div class="container-footer">
		<div class="bottom-menu">
		<ul>
            <li><a href="/" style="text-transform: Capitalize;" title="Mediabetes">Mediabetes <?php echo date('Y')?></a></li>
            <li><a href="/terminos-condiciones-de-uso.php">Terminos de uso y Privacidad</a></li>
        </ul>
		</div>
	</div>
</div>

<!-- Scripts -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
   
<script>
  	$(document).ready(function(){
    	$("#newsletter").validate();
  	});
</script>
</body>
</html>
