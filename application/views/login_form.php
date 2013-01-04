<!-- Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=153771054695550";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- Google Plus -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'es'}
</script>

<div id="logo-login"><img src="/images/mediabetes-inicio-rosa-500.png" alt="mediabetes"  /></div>

<div id="redes">
    <ul>
    	<li>
            <g:plusone></g:plusone>
		</li>
    	<li>
            <a href="https://twitter.com/mediabetes" class="twitter-follow-button" data-show-count="false" data-lang="es">Segui @mediabetes</a>
            <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
		</li>
		<li>
            <div class="fb-like" data-href="http://www.facebook.com/mediabetes" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false" style="width:100px;"></div>
		</li>
     </ul>
    
    
</div>
<div class="slider-wrapper theme-default">
	<div id="slider" class="nivoSlider">
		<img src="/images/slider_inicio.png" alt="" />
		<img src="/images/slider_anadir-medida.png" alt="" />
		<img src="/images/slider_gestionar-medidas.png" alt="" />
		<img src="/images/slider_generar-informe.png" alt="" />
	</div>
</div>

<div id="login_home">
	<?php
	
	echo form_open('login/validate_credentials');
	echo '<label>Usuario:</label>';
	echo form_input('username');
	echo '<label>Contrase&ntilde;a:</label>';
	echo form_password('password');
	$submit = array(
              'name'        => 'submit',
              'value'       => 'Entrar',
              'class'       => 'bt-submit bt-red bt-big right',
            );
	
	echo '<p class="registro">'.anchor('login/signup','&iquest;No eres miembro todav&iacute;a? Reg&iacute;strate <strong>GRATIS</strong> aqu&iacute;').form_submit($submit).'</p>';
	echo form_close();
	
	?>
	
</div>



<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
</script>
