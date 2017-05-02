<link title="win2k-1" href="calendar/calendar-win2k-cold-1.css" media="all" type="text/css" rel="stylesheet">
<script src="calendar/calendar.js" type="text/javascript"></script>
<script src="calendar/lang/calendar-es.js" type="text/javascript"></script>
<script src="calendar/calendar-setup.js" type="text/javascript"></script>
<span id="empleo" name="empleo">
	<form name="form_empleo" method="post" enctype="multipart/form-data">
	<input type="hidden" name="auth_token" value="<?php echo generateFormToken('send_message')?>"> 
		<?php
		$bandera=0;
			if ($_POST["nombre"]!="") {
				if (is_uploaded_file($_FILES['resumen']['tmp_name'])) {
					
					
					$_SESSION['var_empleados']=0;	
					//var_dump($_FILES['resumen']['name']);
					/*$split_path = split("/", $_FILES['resumen']['name']);
					$split_path = end ($split_path);*/
					$extension = split("[/.]", $_FILES['resumen']['name']);
					//var_dump(end($extension));
					
					if (strtolower(end($extension)) != "pdf") {	
						
						
						$bandera=2;
						
					}else{
						$sizeKbt = ($_FILES['resumen']['size'] / 1024) ; 
						
						$Size_Peso = "2000";
						//$Msg_Atencion = "<br><p class='error'><B>ATENCIÓN:</B> Disculpa, pero el archivo era demasiado pesado en Kb para ser aceptado.<br>(". $sizeKbt ."Kb es mayor que el tamaño máximo de ". $Size_Peso ."Kb).</p>";							

						if ($sizeKbt > $Size_Peso) {									
							$bandera=3;
						}else{
							$RUTA_UPLOADED = URL_UPLOADS_CURRICULUM;					 
							$NOMBRE_FILE = "CV_".$_POST["nombre"] . "_" . date("dmY_his") . "." . end($extension);

							move_uploaded_file($_FILES['resumen']['tmp_name'], $RUTA_UPLOADED . $NOMBRE_FILE);
							
							$mensaje = "Línea 1\nLínea 2\nLínea 3";

							

							// Send
										
							//Envio al Banco
							$Para=execute_sql("get_parametro",array(17));
							//$De=execute_sql("get_parametro",array(1));				
							$Asunto="Solicitud Empleo vía WebSite";				
							$Contenido = "<b>Solicitud Empleo vía WebSite</b><br><br>";
							$Contenido .= "La persona: " . $_POST["nombre"] . " (Email: " . $_POST["email"] . "), a enviado los siguientes datos personales:<br><br>";
							$Contenido .= "* Cargo Aspiras: ".$_POST["cargo"]."<br>";
							$Niveles = execute_sql("get_niveles_academicos_detalle",array($_POST["nivel"]));
							
							$Contenido .= "* Nivel Académico: ".$Niveles[1]["nivel"]."<br>";
							$Contenido .= "* Carrera: ".$_POST["carrera"]."<br>";
							$Contenido .= "* Fecha de Nacimiento: ".$_POST["nacimiento"]."<br>";
							$Salarios = execute_sql("get_salarios_detalle",array($_POST["aspiracion"]));
							$Contenido .= "* Aspiración Salarial: ".$Salarios[1]["valor"]."<br>";
							$Contenido .= "* Empresa / Cargo 1: ".$_POST["empresa1"]." - " . $_POST["cargo1"] . "<br>";
							$Contenido .= "* Empresa / Cargo 2: ".$_POST["empresa2"]." - " . $_POST["cargo2"] . "<br>";
							$Contenido .= "* Empresa / Cargo 3: ".$_POST["empresa3"]." - " . $_POST["cargo3"] . "<br>";
							$Contenido .= "<br>Puede descargar el Curriculum aquí: <a href='" . URL_UPLOADS_SITE . "curriculum/" . $NOMBRE_FILE . "'>DESCARGAR</a><br>";
							
							send_email($Para[1]["valor"],$Para[1]["valor"],$Asunto,$Contenido);

							//Envio al Usuario
							$Para=$_POST["email"];
							$De=execute_sql("get_parametro",array(17));				
							$Asunto="Solicitud Empleo Banplus.com";				
							$Contenido = "<b>Solicitud Empleo vía WebSite</b><br><br>";
							$Contenido .= "Muchas gracias por interesarse en nuestro banco. Si su experiencia y formación coinciden con la búsqueda que hace nuestra empresa en talento humano, nos contactaremos a la brevedad. Caso contrario su CV ingresará a nuestra base de datos para futuras incorporaciones. La información se manejará con absoluta confidencialidad.<br><br>";
							send_email($Para,$De[1]["valor"],$Asunto,$Contenido);
							$bandera=1;
											
							$_SESSION['var_empleados']=99;
						}
					}
				}				
			}			
		?>	
	<span style="width:48%;float:left;margin-right:30px;">
		<ul>
			<li class="titulo">Planilla de Postulación</li>
			<li><font color="red">*</font>Nombre y Apellido: <input type="text" id="nombre" name="nombre" maxlength="50"></li>
			<li><font color="red">*</font>Cargo que Aspiras: <input type="text" id="cargo" name="cargo" maxlength="50" ></li>
			<li><font color="red">*</font>
				Nivel Académico: 
				<select id="nivel" name="nivel" style="width:242px">
					<?php
						$Niveles = get_niveles_academicos();
						echo $Niveles;
					?>
				</select>			
			</li>
			<li><font color="red">*</font>Carrera: <input type="text" id="carrera" name="carrera" maxlength="50" ></li>
			<li><font color="red">*</font>
				Fecha de Nacimiento: 				
				<img style="cursor:pointer;cursor:hand;float:right;margin-left:10px;" title="Elije una fecha" alt="Elije una fecha" name="cal_x_fecha" id="cal_x_fecha" src="calendar/calendar.png"> 
				<input type="text" name="nacimiento" id="nacimiento" style="width:214px;" READONLY> 
				<script type="text/javascript">
				Calendar.setup({
					inputField: "nacimiento", // input field id
					ifFormat: "%d/%m/%Y", // date format
					button: "cal_x_fecha" // button id
				});
				</script>
			</li>
			<li><font color="red">*</font>Correo Electrónico: <input type="text" id="email" name="email"></li>
			<li><font color="red">*</font>
				Aspiración Salarial: 
				<select id="aspiracion" name="aspiracion" style="width:242px">
					<?php
						$Salarios = get_salarios();
						echo $Salarios;
					?>
				</select>			
			</li>
			
		</ul>
	</span>
	<span style="width:47%;float:left;">
		<ul>
			<li class="leyenda">Indique el nombre de las 3 últimas empresas y su cargo en la que trabajo</li>
			<li>Empresa 1: <input type="text" name="empresa1" ></li>
			<li>Cargo 1: <input type="text" name="cargo1" ></li>
			<li>Empresa 2: <input type="text" name="empresa2" ></li>
			<li>Cargo 2: <input type="text" name="cargo2" ></li>
			<li>Empresa 3: <input type="text" name="empresa3" ></li>
			<li>Cargo 3: <input type="text" name="cargo3" ></li>
			<li><font color="red">*</font>Adjuntar Currículum: <input type="file" id="resumen" name="resumen" class="file" style="width:242px"><br><span class="leyenda" style="float:right; padding-top: 7px;">[Únicamente formato PDF. Peso máximo: 2Mb]</span></li>
		</ul>
	</span>
	<div style="clear:left;float:left"><br><font color="red">*</font> Campos Obligatorios</div>
	</form>
</span>
<?php
if ($_SESSION['var_empleados']==99	)
{
	 
	echo '<p id="error1" class="error">Hemos recibido su informaci&oacute;n exitosamente.</p>';
	echo "<script>document.location.hash='#error1'</script>";
} 
if ($_POST["nombre"]==""){
	$_SESSION['var_empleados'] = 0;
}

if ($bandera==1)
	{
	//echo '<p style="text-align:center;width:100%;padding:4px;float:left; font-size:18px">Hemos recibido su informaci&oacute;n exitosamente.</p>';
	//echo '<p id="error1" class="error">Hemos recibido su informaci&oacute;n exitosamente.</p>';
	
	//echo "<script>document.location.hash='#error1'</script>";
	?>
	<script>
		window.location.href = "p_contenido.php?id=1&ids=1&idc=35"; 
	</script>
	<?php 
	}
else
if ($bandera==2)
	{
	echo "<div id='error2' name='nombre' class='error'>El archivo adjunto no corresponde con el formato solicitado</div>";				 
	echo "<script>document.location.hash='#error2'</script>";
	}
else
if ($bandera==3)
	{	
	echo "<p id='error3' class='error'>El archivo adjunto no corresponde con el formato solicitado</p>";				 
	echo "<script>document.location.hash='#error3'</script>";
	}
$bandera=0;
?>
<p style="float:right;margin-top:8px;margin-right:5px;">
	<!--<div class="a_empleate" >
		<a  href="#" OnClick="valida_empleo();return false">Enviar</a>
	</div>-->
	<input type="button" class="class_boton" onclick="valida_empleo();return false"  name="Enviar22" value="Enviar">
</p>
