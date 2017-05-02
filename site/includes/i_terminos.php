<?php
	ob_start();
	session_start();

	$Id = $_REQUEST["id"];
	$Idc = $_REQUEST["idc"];

	include "i_generales.php";
	include "i_funciones.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<head>
		<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<META NAME="keywords" content="<?php echo Keywords; ?>">
		<META NAME="Description" CONTENT="<?php echo Description; ?>">
		<title><?php echo TITLE_SITE; ?><?php echo $Title; ?></title>		
		<script src="<?php echo URL_SITE; ?>js/i_generales.js" type="text/javascript"></script>
		<link href="<?php echo URL_SITE; ?>css/site.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<div id="principal_visor">
			<div id="header">
				<span id="logo"><img src="<?php echo URL_IMAGES_SITE; ?>/logo_banplus.jpg"></span>
			</div>
			<div id="contenido">
				<?php
					$Contenido = get_contenido(11);
					echo '<span id="tit">' . $Contenido["Titulo"] . '</span>';
					echo '<span id="cont">' . $Contenido["Contenido"] . '</span>';
				?>
				<span><input type="button" name="Cerrar" value="Cerrar" onClick="window.close();"></span>
			</div>
		</div>
	</body>
</html>