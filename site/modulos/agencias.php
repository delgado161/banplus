<?php
	if ($_POST["opc_estado"]) {
		$Datos_Estado = get_estado_id(intval($_POST["opc_estado"]));
	}
	
	if ($_POST["opc_agencias"]) {
		$Datos_Agencia = get_agencia_id(intval($_POST["opc_agencias"]));
	}
?>
<span id="tit">
	<?php
		if (($_POST["paso"]=="") or ($_POST["paso"]=="1")){
		
		$text_agencia = execute_sql("get_parametro",array(23));
		echo $text_agencia[1]["valor"];
	?>	
			
	<?php
		}elseif($_POST["paso"]=="2"){
	?>
			Seleccione la agencia disponible en este estado
	<?php
		}
		
		
	?>
</span>
<span id="paso">
	<ul>
		<li<?php if (($_POST["paso"]=="") or ($_POST["paso"]=="1")) {
			$Datos_Estado[1]="";
			echo ' id="activos"'; } ?>>
				<span id="paso_txt"><b>PASO 1</b> - UBICACIÓN</span>
				<span id="desc">Seleccione un Estado</span>
		</li>
		<li<?php if ($_POST["paso"]=="2") {
			$Datos_Agencia[1]="";
			echo ' id="activos"'; } ?>>
				<span id="paso_txt"><b>PASO 2</b> - AGENCIAS</span>
				<span id="desc1"><?php 
					if ($Datos_Estado[1]=="") {
						?>Según Estado<?php 
					}else{ 
						echo $Datos_Estado[1]; } ?>
				</span>
		</li>
		<li<?php if ($_POST["paso"]=="3") {
			echo ' id="activos"'; } ?>>
			<span id="paso_txt"><b>PASO 3</b> - INFORMACIÓN</span>
			<span id="desc2"><?php 
				if (($Datos_Agencia[1]=="") or ($_POST["paso"]==1)) {
					?>Según Ubicación<?php 
				}else{
					echo $Datos_Agencia[1]; } ?>
			</span>
		</li>
	</ul>
</span>
<?php
	if (($_POST["paso"]=="") or ($_POST["paso"]=="1")) {
?>
		<span id="estados">
			<form name="src_agencias" method="post" action="?id=<?php echo $Id; ?>&ids=<?php echo $Ids; ?>&idc=<?php echo $Idc; ?>" onSubmit="return valida_estados();">
				<input type="hidden" name="auth_token" value="<?php echo generateFormToken('send_message')?>"> 
				<?php
					$Estados = get_estados(intval($_POST["opc_estado"]));
					echo $Estados;
				?>
				<input type="hidden" name="paso" value="2">
				<!--<input type="submit" name="btn_sig" id="btn_sig" value="Siguiente">-->
			</form>
		</span>
<?php
	}elseif($_POST["paso"]=="2"){
?>
		<span id="agencias">
			<form name="src_agencias" method="post" action="?id=<?php echo $Id; ?>&ids=<?php echo $Ids; ?>&idc=<?php echo $Idc; ?>" onSubmit="return valida_agencias();">
				<input type="hidden" name="auth_token" value="<?php echo generateFormToken('send_message')?>"> 
				<?php
					$Estados = get_agencias_estados(intval($_POST["opc_estado"]),intval($_POST["opc_agencias"]));
					if ($Estados!="") {
						echo $Estados;
					}else{
						echo '<ul><li style="width:100%;text-align:center;">Disculpe, por los momentos no contamos con Agencias en este Estado</li></ul>';
					}
				?>
				<input type="hidden" name="paso" value="3">
				<input type="hidden" name="opc_estado" value="<?php echo $_POST["opc_estado"]; ?>">
				<?php
					if ($Estados!="") {
				?>
						<!--<input type="submit" name="btn_sig" id="btn_sig" value="Siguiente">-->
				<?php
					}
				?>
				<input type="button" name="btn_ant" id="btn_ant" value="Anterior" onClick="regresar_paso(1);">
			</form>
		</span>
<?php
	}elseif($_POST["paso"]=="3"){
	
?>

		<script type="text/javascript">
		var map;
		var panorama;
		var astorPlace = new google.maps.LatLng(<?php echo $Datos_Agencia[6]; ?>);
		var busStop = new google.maps.LatLng(<?php echo $Datos_Agencia[6]; ?>);

		function initialize() {

		  // Set up the map
		  var mapOptions = {
			center: astorPlace,
			zoom: 16,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: false
		  };
		  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);


		  var busMarker = new google.maps.Marker({
			  position: busStop,
			  map: map,
			 // icon: "images/ico_googlemap.png",
			 <?php
				echo "icon: 'img/indicadorBanplus.png' , "; 
			  ?> 
			  title: '<?php echo $Datos_Agencia[1]; ?>'
		  });
		  
		  // We get the map's default panorama and set up some defaults.
		  // Note that we don't yet set it visible.
		  panorama = map.getStreetView();
		  panorama.setPosition(astorPlace);
		  panorama.setPov({
			heading: 265,
			zoom:1,
			pitch:0}
		  );
		}
		  
		
		</script>
		<span id="agencias_detalle">
			<form name="src_agencias" method="post" action="?id=<?php echo $Id; ?>&ids=<?php echo $Ids; ?>&idc=<?php echo $Idc; ?>">
				<input type="hidden" name="auth_token" value="<?php  echo generateFormToken('send_message')?>"> 
				<span id="datos">
					<ul>
						<!--<li id="nombre"><?php //echo strtoupper($Datos_Agencia[1]); ?></li>-->
						<li id="nombre"><?php echo strtr(strtoupper($Datos_Agencia[1]),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"); ?></li>
						<li id="tit_dir">Dirección:</li>
						<li id="dir"><?php echo $Datos_Agencia[2]; ?></li>
						<li id="tit_tel">Teléfono:</li>
						<li id="tel"><?php echo $Datos_Agencia[3]; ?></li>
						<li id="tit_horar">Horarios:</li>
						<li id="horar"><?php echo $Datos_Agencia[4]; ?></li>
						<li id="tit_serv">Servicios:</li>
						<li id="serv">
						<?php
							$Servicios = get_servicios_agencias(intval($_POST["opc_agencias"]));
							if (!$Servicios) {
								echo "<img src='img/no_aplica.PNG' style='overflow:hidden;' />";
							}else{
								echo $Servicios; }
						?>
						</li>
					</ul>
				</span>
				<span id="mapa">
					<div id="map_canvas" style="width:450px; height:235px;"></div>
				</span>
				<script>
					initialize();
				</script>
				<span id="separador"></span>

				<input type="hidden" name="paso" value="3">
				<input type="hidden" name="opc_estado" value="<?php echo $_POST["opc_estado"]; ?>">
				<input type="hidden" name="opc_agencias" value="<?php echo $_POST["opc_agencias"]; ?>">
				<input type="button" name="btn_ant" id="btn_ant" value="Anterior" onClick="regresar_paso(2);">
			</form>
		</span>
		<span id="agencias_detalle">
			<div style="float: left; width: 550px; color: #999; font: bold 12px/24px Arial,Georgia,Verdana,Geneva,Helvetica,sans-serif; font-weight:bold; margin-top: -25px; padding-bottom: 10px;">
			Leyenda
			</div>
			<div style="float: left; width: 550px;">
			<?php
							$Servicios2 = get_servicios_agencias2(intval($_POST["opc_agencias"]));
							if (!$Servicios2) { ?>
								<div class="div_grupo_agencias">
									<img style="float:left; overflow:hidden;" src="img/no_aplica.PNG"/>
									<label class="agen_leyenda">No Aplica</label>
								</div> <?php 
							}else {
								echo $Servicios2; }
			?>
			</div>
		</span>
<?php
	}
?>