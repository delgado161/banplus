<?php
	$IdBuscador = execute_sql("get_parametro",array(11));
	
?>
<div id="header">
	<span id="logo"><a href="<?php echo URL_SITE; ?>"><img src="<?php echo URL_IMAGES_SITE; ?>/logo_banplus_aniv.png" border="0"></a></span>
	<span id="sector_b">
		<ul>
			<li>
				<form action="" name="FrmBuscar" method="GET" onSubmit="return valida_buscador();">
					 
					<!--input type="hidden" name="auth_token" value="<?//=generateFormToken('send_message');?>"/--> 
					<div id="InpTxt2" style="font: 11px Arial,Georgia,Verdana,Geneva,Helvetica,sans-serif;">
						<input type="text" id="InpTxt" value="Buscar" onfocus="borrarTexto();" name="buscar" />
						<input type="hidden" name="id" value="<?php echo $Id; ?>"/> 
						<input type="hidden" name="idc" value="<?php echo $IdBuscador[1]["valor"]; ?>"/> 
					</div>
					<div id="BtnBuscar">
						<input type="image" src="img/bg_btn_buscar.jpg" name="BtnBuscar" id="BtnBuscar"/>
					</div>
				</form>
			</li>
			<li>
				<form method="post" name="FrmHerramientas">
				<input type="hidden" name="auth_token" value="<?=generateFormToken('send_message')?>"> 
					<div id="SltHeader">
						<select name="SltHeader" id="SltHeader">
							<option value="?id=<?php echo ""; ?>&idc=6">Seleccione</option>
							<option value="?id=<?php echo $Id; ?>&idc=6">Calculadora Financiera</option>
							<?php
								$herramientas = execute_sql("menu_inferior",array($Id,1));
								for($i=1;$i<=count($herramientas);$i++)
									{
									
									echo '<option value="p_contenido.php?id=' . $Id . '&ids=' . $herramientas[$i]["id_grupo"] . '&idc=' . $herramientas[$i]["id_contenido"] . '">'.$herramientas[$i]["titulo"].'</option>';
									
									}
							?>
						</select>
						
					</div>
					<div id="BtnIr"><input type="button" name="BtnIr" value="Ir" id="BtnIr" onClick="enviar_herramientas();"></div>						
				</form>				
			</li>
		</ul>
	</span>
	<span id="menu_superior">
		<span id="fecha">
			<?php 
				//echo Date(l);
				$mes = mes_anhio (strftime('%u'));
				echo ucfirst($mes);
			?>
		</span>
		<?php
			$OpcMenSup = menu_principal_superior($Id,$Ids);	
			echo $OpcMenSup[0];
		?>
	</span>
	<span id="menu_hijas">
		<?php
			echo $OpcMenSup[1];
		?>
	</span>
</div>