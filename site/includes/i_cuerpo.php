<?php
	$Contenido = get_contenido($Idc);

?>
<div id="cuerpo">
	<span id="banner_seccion">
		<?php
			if ($Contenido["Imagen"] != "") {
				if (is_file(URL_UPLOADS_CONTENIDOS.$Contenido["Imagen"])) {
					echo '<img src="' . URL_UPLOADS_CONTENIDOS . $Contenido["Imagen"] .'" width="788px" height="96px" />';

				}
			}
		?>
	</span>
	<div id="banplus_online">
		<ul>
			<?php
				$EnlacesOnline = link_online($Id);
				echo $EnlacesOnline;
			?>
		</ul>
	</div>
	<span id="tit_cont">
		<?php
			echo $Contenido["Titulo"];
			if($Contenido["Id"]==9){
			$ancho="width:100%";} else{$ancho="";}
		?>
	</span>
	<div id="contenidos">
		<span id="txt" class="txt" style="font-size:100%;<?php echo $ancho;?>">
			<span id="barra_text">
				<a  class="a_min" href="#" onClick="tamano(-1)">A</a>
				<a  class="a_may" href="#" onClick="tamano(+1)">A</a>				
			</span>
		
			<?php
				//if ($Contenido["Modulo"]==""){
					echo $Contenido["Contenido"];
                                       
				//}else{
					if (is_file('modulos/'.$Contenido["Plantilla"])) {
						include "modulos/" . $Contenido["Plantilla"];
					}
				//}
				
				$DocRel = get_doc($Ids,$Idc);
				
				if ($DocRel!=""){
					echo '<span id="documentos"><h4>Documentos</h4>' . $DocRel . '</span>';				
				}
			?>
		</span>
		<span id="banners">		
			<?php
				$Banner1 = get_banner_general($Idsb,10,1);
				echo $Banner1;
			?>
		</span>
	</div>
</div>
<div id="footer_interno">
	<span id="accesos_directos_int">
		<ul>
			<li>Accesos directos</li>
			<li>
				<form name="sch_acc_dir" method="post">
				<input type="hidden" name="auth_token" value="<?php echo generateFormToken('send_message')?>">
					<select name="acc_dir">
						<?php 
							$SelList = acc_dir_internos($Id);
							echo $SelList;
						?>
					</select>
					<input type="button" value="Buscar" name="Buscar" Id="btn_buscar" onClick="enviar_accdir();">
				</form>
			</li>
		</ul>
	</span>
	<span id="encontrarnos">
		<ul>
			<li>D&oacute;nde encontrarnos</li>
			<li>
				<form name="sch_donde" method="post" action="?id=<?php echo $Id; ?>&idc=28">
				<input type="hidden" name="auth_token" value="<?php echo generateFormToken('send_message')?>">
					<select name="opc_estado">
						<?php 
							$Agencias = get_agencias();
							echo $Agencias;
						?>
					</select>
					<input type="hidden" name="paso" value="2">
					<input type="button" value="Buscar" name="Buscar" Id="btn_buscar" onClick="document.sch_donde.submit();">
				</form>
			</li>
		</ul>
	</span>
	<span id="tips">
		<?php
			$Validar_Tips = validate_tips($Id);
			
			if ($Validar_Tips!="") {
		?>
				<a href="?id=<?php echo $Id; ?>&idc=<?php echo $Validar_Tips; ?>"><img src="img/icon_seguridad.png" title="Tips de Seguridad" align="left" border="0"> Tips de Seguridad</a>
		<?php
			}
		?>
		
	</span>	
	<span id="follow_interno">
		<?php
			include "includes/i_follow.php";
		?>
	</span>
</div>

