<span id="faq">
	<?php
		$FAQ = get_faq();
		echo $FAQ;
	?>
	
	<ul id="Contactos">
		<li id="A">Para más información contáctenos:</li>
		<li id="B">Centro de Conformación y Atención Telefónico</li>
		<li id="C">
			<?php
				$Tel = execute_sql("get_parametro",array(10));
				Echo $Tel[1]["valor"];
			?>
		</li>
		<li id="D">
			Email: 
			<?php
				$Email = execute_sql("get_parametro",array(1));
				Echo '<a href="mailto:' . $Email[1]["valor"] . '">' . $Email[1]["valor"] . '</a>';
			?>	
		</li>	
		<li id="E">
			Twitter: 
			<?php
				$Twit = execute_sql("get_parametro",array(2));
				Echo '<a href="http://www.twitter.com/' . $Twit	[1]["valor"] . '" target="_Blank">' . $Twit[1]["valor"] . '</a>';
			?>				
		</li>	
	</ul>
</span>
