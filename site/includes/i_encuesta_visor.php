<?
	header ('Content-type: text/html; charset=ISO-8859-1');
	include "i_generales.php";
	include "i_funciones.php";
?>
<form action="#" method="post" name="form_encuest" onSubmit="return valida_encuesta();">
<input type="hidden" name="auth_token" value="<?=generateFormToken('send_message')?>"> 
	<?
		$EncPre = encuesta_home(RemoveXSS(int_val($_POST["t1"])));
		echo $EncPre;
	?>
	<span id="ver_resultados"><a href="Javascript:cargarContenido(document.form_encuest.id_enc.value,<?php echo $_POST["t1"]; ?>);"><img src="img/btn_ver_resultados.jpg" border="0"></a></span>
	<span id="opinar"><input type="image" src="img/btn_opinar.jpg" name="Opinar" value="Opinar" id="bt_opinar"></span>
</form> 