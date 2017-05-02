<?
	header ('Content-type: text/html; charset=ISO-8859-1');
	include_once "i_generales.php";
	include_once "i_funciones.php";
?>
<div id="encuesta_resultados">
	<span id="tit">RESULTADOS</span>
	<?
		$Valor = explode("#",RemoveXSS($_POST["t1"]));

		if ($Valor[0]!=0) {
			registrar_voto_encuesta($Valor[0]);
		}
		
		$Resultados = encuesta_respuesta_totales($Valor[1]);
		echo $Resultados;
		
		if ($Valor[0]==0) {
			//echo '<span id="volver"><a href="Javascript:cargarContenido2(' . $_POST["t2"] . ');"><img src="img/btn_volver.png" border="0" title="Volver"></a></span>';
			echo '<span id="volver"><a href="p_contenido.php?id=1"><img src="img/btn_volver.png" border="0" title="Volver"></a></span>';
		}
	?>
</div>