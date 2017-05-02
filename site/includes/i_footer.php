<div id="footer">

<script type="text/javascript">
<!--
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12592892-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
-->
</script>


	<span id="menu_inferior_nivel1">
		<?php
			$MenFoo = menu_inferior($Id,3);
			echo $MenFoo;

			//var_dump($MenFoo);
		?>
	</span>
	<span id="menu_inferior_nivel2">
		<?php
			$MenFoo2 = menu_inferior($Id,4);
			echo $MenFoo2;
		?>
	</span>
	
	<div class="mensajefooter">
		<?php
		$explorer = execute_sql("get_parametro",array(24));
		$chorome = execute_sql("get_parametro",array(25));
		$opera = execute_sql("get_parametro",array(28));
		$firefox = execute_sql("get_parametro",array(29));
		$safari = execute_sql("get_parametro",array(32));
			echo "Recomendamos la utilizaci&oacute;n de los siguientes navegadores: <a  href='".$explorer[1]["valor"]."' target='_blank'> Explorer 8 o superior </a>,<a  href='".$chorome[1]["valor"]."'  target='_blank' > Chrome </a>,<a  href='".$opera[1]["valor"]."'  target='_blank'>  Opera </a>, <a  href='".$firefox[1]["valor"]."'  target='_blank'> Firefox </a>,<a  href='".$safari[1]["valor"]."'  target='_blank'>  Safari</a>. Resoluci&oacute;n recomendada  1024x768 o superior.";
		?>
	</div>
	
</div>