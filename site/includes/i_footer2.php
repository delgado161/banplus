<span id="copyr">
	<p>Copyright 2012 <?php $Rif=execute_sql("get_parametro",array(22)); echo $Rif[1]["valor"]; ?>, RIF. <?php $Rif=execute_sql("get_parametro",array(8)); echo $Rif[1]["valor"]; ?></p>
	<p>Todos los derechos reservados BANPLUS.COM</p>
	
</span>
<span id="legal">
	<?php
		$Aviso=execute_sql("get_parametro",array(16));
	?>
	<p>Aviso legal (<a href="../uploads/contenidos/<?php echo $Aviso[1]["archivo"]; ?>" target="_Blank">Términos y condiciones</a>)</p>
	<p>Creado por <a href="#" onClick="window.open('http://www.adverweb.com/creditos.html','','scrollbars=no,width=300,height=280');return false;">Adverweb c.a.</a></p>
</span>