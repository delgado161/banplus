<span id="contacto">
	<ul id="Contactos">
		<li id="B">Centro de Conformación y Atención Telefónico</li>
		<li id="C">
			<?php
				$Tel = execute_sql("get_parametro",array(10));
				Echo $Tel[1]["valor"];
			?>
		</li>
		
	</ul>

	<table width="100%">
		<tr>
			<td>
				<ul id="Contactos">
					<li id="B">Redes sociales</li>
					<li id="D">
							Email: 
							<?php
								$Email = execute_sql("get_parametro",array(1));
								Echo '<a href="mailto:' . $Email[1]["valor"] . '">' . $Email[1]["valor"] . '</a>';
							?>	
					</li>

					<?php				
					$Fbook = execute_sql("get_parametro",array(7));
					if ($Fbook[1]["valor"]!=""){
							?>
					<li id="G">
							Facebook: 
							<?php
								Echo '<a href="' . $Fbook[1]["valor"] . '" target="_Blank">BanplusOnLine</a>';
							?>	
					</li>
							<?php
						}
						?>
                   
                   	<?php				
					$Fbook = execute_sql("get_parametro",array(56));
					if ($Fbook[1]["valor"]!=""){
							?>
					<li id="G">
							Linkedin: 
							<?php
								Echo '<a href="' . $Fbook[1]["valor"] . '" target="_Blank">Linkedin</a>';
							?>	
					</li>
							<?php
						}
						?>
                   
                    	<?php				
					$Fbook = execute_sql("get_parametro",array(57));
					if ($Fbook[1]["valor"]!=""){
							?>
					<li id="G">
							Youtube: 
							<?php
								Echo '<a href="' . $Fbook[1]["valor"] . '" target="_Blank">Youtube</a>';
							?>	
					</li>
							<?php
						}
						?>
				</ul>
			</td>
			<td>
				<ul id="Contactos">
					<li id="B">&nbsp;</li>
					<?php
					$InstG = execute_sql("get_parametro",array(50));
					if ($InstG[1]["valor"]!=""){
						?>
					<li id="F">
						Instagram: 
						<?php
							Echo '<a href="http://www.instagram.com/' . $InstG[1]["valor"] . '" target="_Blank">' . $InstG[1]["valor"] . '</a>';
						?>	
					</li>
						<?php
					}?>
             
             <?php
					$InstG = execute_sql("get_parametro",array(59));
					if ($InstG[1]["valor"]!=""){
						?>
					<li id="G">
						Google+: 
						<?php
							Echo '<a href="" target="_Blank"> Google +</a>';
						?>	
					</li>
						<?php
					}?>
             
             
               <?php
					$InstG = execute_sql("get_parametro",array(59));
					if ($InstG[1]["valor"]!=""){
						?>
					<li id="G">
						Wordpress: 
						<?php
							Echo '<a href="" target="_Blank"> Wordpress</a>';
						?>	
					</li>
						<?php
					}?>

					<li id="E">
						Twitter: 
						<?php
							$Twit = execute_sql("get_parametro",array(2));
							Echo '<a href="http://www.twitter.com/' . $Twit	[1]["valor"] . '" target="_Blank">' . $Twit[1]["valor"] . '</a>';
						?>				
					</li>	
          	
                 
				</ul>


			</td>
		</tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	</table>		
	<?php
		$Motivos = get_departamentos();
		
		$IdAtencion = execute_sql("get_parametro",array(12));
		$Contenido_Atencion = get_contenido($IdAtencion[1]["valor"]);

		if ($Contenido_Atencion!="") {
			echo '<span id="caja1"><p class="titulo">' . $Contenido_Atencion["Titulo"] . '</p><p>' . $Contenido_Atencion["Contenido"] . '</p></span><span id="separador"></span>';
		}
	?>	
	<span id="caja1">
		<form name="form_contacto" method="post">
		<input type="hidden" name="auth_token" value="<?php echo generateFormToken('send_message')?>"> 
		<?php
			if ($_POST["nombre"]!="") {
				//Envio al Banco
				$dpto=$_POST["departamentos"];
				$De=execute_sql("get_parametro",array(1));				
				$MotivoV=execute_sql("get_parametro_value",array($dpto));//var_dump($MotivoV); die;				
				$Asunto="Contacto Vía WebSite – ".$MotivoV[1]["nombre"];				
				//echo $Asunto;
				$Contenido = "Remitente: ".$_POST["nombre"]."<br>";
				$Contenido .= "C.I / RIF: ".$_POST["cicontac"]."<br>";
				$Contenido .= "Correo de Contacto: ".$_POST["email"]."<br>";
				$Contenido .= "Telefono: ".$_POST["telfcontc"]."<br>";
				$Contenido .= "Comentario: ".$_POST["comentarios"]."<br><br><br>";
				//echo $Contenido;
				$Para = $MotivoV[1]["email"];
				send_email($Para,$De[1]["valor"],$Asunto,$Contenido);

				//Envio al Usuario
				$Para=$_POST["email"];
				$De=execute_sql("get_parametro",array(1));
				$Asunto="Contacto Vía WebSite – ".$MotivoV[1]["nombre"];		
				$Contenido = "<b>Contacto vía WebSite</b><br><br>";
				$Contenido .= "Gracias por contactarnos a través de esta vía. Si requiere atención inmediata, le recomendamos llamar al 
								0501-BANPLUS (05012267587). <br><br>El Centro de Atención Telefónico funciona las 24 horas y los 365 días. En caso 
								contrario, a la brevedad posible nuestros ejecutivos le brindarán respuesta a su consulta <br><br><br>";
				//echo $Asunto;
				//echo $Contenido;					
				send_email($Para,$De[1]["valor"],$Asunto,$Contenido);
			
				echo '<p style="text-align:center;width:100%;padding:4px;float:left;">Su mensaje fue enviado satisfactoriamente.</p>';
			}			
		?>
		<p class="titulo" style="width:100%;float:left;">Planilla de Contacto:</p>
		<span style="width:46%;float:left;margin-right:50px;">
			<ul>
				<li>Nombre y Apellido:<input type="text" name="nombre" id="nombre"></li>
				<li>Número de Cédula / RIF: <input type="text" name="cicontac" id="cicontac"></li>
				<li>Motivo: <?php echo $Motivos; ?></li>
			</ul>
		</span>
		<span style="width:47%;float:left;">
			<ul>
				<li>Correo Electrónico: <input type="text" name="email" id="email"></li>
				<li>Teléfono de Contacto: <input type="text" name="telfcontc" id="telfcontc"></li>
				<li>Comentarios: <textarea name="comentarios" id="comentarios"></textarea></li>
			</ul>
		</span>
		<p style="float:right;margin-top:8px;margin-right:5px;"><input type="button" onclick="valida_contacto();" id="btn_buscar" name="Buscar" value="Enviar"></p>
		</form>
	</span>
	<span id="separador"></span>
	<?php
		$IdDefensor = execute_sql("get_parametro",array(13));
		$Contenido_Defensor = get_contenido($IdDefensor[1]["valor"]);

		if ($Contenido_Defensor!="") {
			echo '<span id="caja1"><p class="titulo">' . $Contenido_Defensor["Titulo"] . '</p><p>' . $Contenido_Defensor["Contenido"] . '</p></span><span id="separador"></span>';
		}
	?>
</span>
