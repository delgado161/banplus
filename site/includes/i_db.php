<?php
/* ==================================================
	   FUNCION:       abrirConexion
	   DESCRIPCION:   Abre la Conexion a la base de datos
	   PARAMETROS:    No tiene
	================================================== */
	
	$conexion = "";
	function abrirConexion()
	{
		global $conexion;
		$conexion = @mysql_connect("192.168.1.134","admin","12345");
		if(mysql_errno()){
			die("Discupe!<br>Un error ha ocurrido. Intente mas tarde. 1");
		}else{
			if(!$conexion){
				die("Discupe!<br>Un error ha ocurrido. Intente mas tarde. 2");
			}else{
				mysql_select_db("awvps_banplus");
			}
		}
	}	
	
	/* ==================================================
	   FUNCION:       cerrarConexion
	   DESCRIPCION:   Cierra la Conexion a la base de datos
	   PARAMETROS:    No tiene
	================================================== */
	
	function cerrarConexion ()
	{
		global $conexion;
		mysql_close($conexion);
	}	
?>
