<span id="calculadora">
	<?php
		if ($_POST["tipo"]=="") {
			$Tipo = 1;
		}else{
			$Tipo = $_POST["tipo"];		
		}
		
		$Ingresos = get_ingresos($Tipo);

		$Plazos = get_cuotas($Tipo);		
		
		//$taza_veh = execute_sql(get_parametro,array(20));
		
		$plazo_veh = execute_sql(get_parametro,array(19));
		$plazo_hipo = execute_sql(get_parametro,array(21));
		
		//$taza_vhipo = execute_sql(get_parametro,array(24));
		
		
		
		 $taza_vhipo = execute_sql(get_tasas_salario2,array(1,1,4));
		
		 $taza_veh= execute_sql(get_tasas_salario2,array(2,1,99));
		
		
	?>	
	<span id="caja1">
		<form name="form_calculadora" method="post">
		<input type="hidden" name="auth_token" value="<?php echo generateFormToken('send_message')?>"> 
		<?php
			if ($Tipo==1){
		?>
				<span>
					<ul>
						<li><span>Tipo de Crédito: </span> Hipotecario <input type="radio" name="tipo" id="tipo" value="1" style="height:10px; line-height:20px; margin-right:20px;" checked> Vehículo <input type="radio" name="tipo" id="tipo" value="2" style="height:10px; line-height:20px;" onClick="document.form_calculadora.submit();"></li>
						<li><span>Ingreso Mensual (Bs.): </span> <select name="ingreso" id="ingreso" onchange="act_datos()"><?php echo $Ingresos; ?></select></li>
						<li><span>Monto a Financiar (Bs.): </span> <input type="text" class="auto" name="monto" id="monto"  maxlength="9"></li>
						<li><span>Plazo (Meses): </span> <input type="text" name="plazo" id="plazo" readonly="readonly" class="inp_calc"  value="<?php echo $plazo_hipo[1]['valor']; ?>"></input></li>
						<li><span>Tasa (%): </span> <input type="text" name="ingreso2" id="ingreso2" maxlength="2" readonly="readonly" class="inp_calc"  value="<?php  echo $taza_vhipo[1]['tasa']; ?>"></li>
						<li>
							<p style="float:left;margin-left:140px;"><input type="button" onclick="valida_calculadora();" id="btn_buscar" name="Buscar" value="Calcular"></p>
						</li>
						<li>
							<div class="centro_calc">
								<span><br>Cuota Mensual (Bs.): </span> <span id="resultado" class="resultados"></span>
							</div>
						</li>				
						<li>
							<div class="centro_calc2">
								<span>El resultado obtenido es referencial y de car&aacute;cter informativo, en consecuencia no podr&aacute; interpretarse que el Banco esta obligado a otorgar los cr&eacute;ditos que se le soliciten.</span>
							</div>
						</li>
					</ul>
				</span>
		<?php
			}elseif ($Tipo==2){
		?>
				<span>
					<ul>
						<li><span>Tipo de Crédito: </span> Hipotecario <input type="radio" name="tipo" id="tipo" value="1" style="height:10px; line-height:20px; margin-right:20px;" onClick="document.form_calculadora.submit();"> Vehículo <input type="radio" name="tipo" id="tipo" value="2" style="height:10px; line-height:20px;"checked></li>
						<li><span>Monto a Financiar (Bs.): </span> <input type="text" class="auto" name="monto" id="monto"  maxlength="9"></li>
						<li><span>Plazo (Meses): </span> <input type="text" name="plazo" id="plazo" readonly="readonly" class="inp_calc"  value="<?php  echo $plazo_veh[1]['valor']; ?>"> </li>						 
						<li><span>Tasa (%): </span> <input type="text" name="ingreso" id="ingreso" maxlength="2" readonly="readonly" class="inp_calc"  value="<?php  echo $taza_veh[1]['tasa']; ?>"></li>
						<li>
							<p style="float:left;margin-left:140px;"><input type="button" onclick="valida_calculadora();" id="btn_buscar" name="Buscar" value="Calcular"></p>
						</li>
						<li>
							<div class="centro_calc">
								<span></br>Cuota Mensual (Bs.): </span> <span id="resultado" class="resultados"></span>				
							</div>
						</li>
						<li>
							<div class="centro_calc2">
								<span>El resultado obtenido es referencial y de car&aacute;cter informativo, en consecuencia no podr&aacute; interpretarse que el Banco esta obligado a otorgar los cr&eacute;ditos que se le soliciten en las mismas condiciones arriba indicadas.</span>
							</div>
						</li>
					</ul>
				</span>
		<?php			
			}
		?>		
		</form>
	</span>
</span>
