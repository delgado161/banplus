<?php
	$monthNames = Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
	"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

	if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
	if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");

	$cMonth = $_REQUEST["month"];
	$cYear = $_REQUEST["year"];
	 
	$prev_year = $cYear;
	$next_year = $cYear;
	$prev_month = $cMonth-1;
	$next_month = $cMonth+1;
	 
	if ($prev_month == 0 ) {
		$prev_month = 12;
		$prev_year = $cYear - 1;
	}
	if ($next_month == 13 ) {
		$next_month = 1;
		$next_year = $cYear + 1;
	}
?>
<table id="calendario">
	<tr align="center">
		<td colspan="7">
			<table id="tit">
				<tr>
					<td id="f_left">
						<a href="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $Id . "&ids=" . $Ids . "&idc=" . $Idc . "&month=" . $prev_month . "&year=" . $prev_year; ?>"><<</a>
					</td>
					<td id="center">
						<?php echo $monthNames[$cMonth-1].' '.$cYear; ?>
					</td>
					<td id="f_right">
						<a href="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $Id . "&ids=" . $Ids . "&idc=" . $Idc . "&month=". $next_month . "&year=" . $next_year; ?>">>></a>  
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr id="dias_nom">
		<td>Do</td>
		<td>Lu</td>
		<td>Ma</td>
		<td>Mi</td>
		<td>Ju</td>
		<td>Vi</td>
		<td>Sá</td>
	</tr>
	<tr>
		<td colspan="7"></td>
	</tr>
	<?php
		$Bancarios = get_calendar_days(1); 
		$Nacionales = get_calendar_days(2);
		$argB = execute_sql("get_calendar_days",array(1));
		$argN = execute_sql("get_calendar_days",array(2));
		
		$timestamp = $Dia = mktime(0,0,0,$cMonth,1,$cYear);
		$maxday = date("t",$timestamp);
		$thismonth = getdate ($timestamp);
		$startday = $thismonth['wday'];
		
		for ($i=0; $i<($maxday+$startday); $i++) {
			if(($i % 7) == 0 ) echo "<tr id='dias'>";
			
			if($i < $startday){
				echo "<td></td>";
			}else{ 
				$NDia=date ( "D" , mktime(0,0,0,$cMonth,($i - $startday + 1),$cYear) );
				$NDia_F=date ( "d-m-Y" , mktime(0,0,0,$cMonth,($i - $startday + 1),$cYear) );
				$NFecha=date ( "d-m-Y" , $Dia );				
				if (($NDia=="Sun") || ($NDia=="Sat"))  { 
					
					// echo  date("m")."</br>";
					// echo  $NDia_F."</br>";
					
					if ((date("d")==substr($NDia_F,0,2)) and (date("m")==substr($NDia_F,3,2)))
						$NomId="actual";  
					else  
						$NomId="fin";
					
				}elseif (trim(($i - $startday + 1)) == trim(date("d"))){
					//echo $NFecha." si ".date("d-m-Y");
					//echo $NFecha." si ".date("m");
					
					$mes_dg=Array("01"=>"Enero", "02"=>"Febrero", "03"=>"Marzo", "04"=>"Abril", "05"=>"Mayo", "06"=>"Junio", "07"=>"Julio"
					,"08"=>"Agosto", "09"=>"Septiembre", "10"=>"Octubre", "11"=>"Noviembre", "12"=>"Diciembre");
					
					//var_dump($mes_dg[date("m")]);
					if($monthNames[$cMonth-1]==$mes_dg[date("m")]){
					$NomId="actual";
					}else{$NomId="normal";}
				}else{
					$NomId="normal";
				}
				
				if (is_array($Bancarios)) {
					if (array_key_exists($NDia_F,$Bancarios)) {
						$NomId="bancario";
						for ($xi=1; $xi<= count($argB);$xi++){
							if($NDia_F==$argB[$xi]['fecha'])
								$reg_pr .= $argB[$xi]['descripcion'].". ";
						}
					}
				}
				
				if (is_array($Nacionales)) {
					if (array_key_exists($NDia_F,$Nacionales)) {
						$NomId="nacional";
						for ($xi=1; $xi<= count($argN);$xi++){
							if($NDia_F==$argN[$xi]['fecha'])
								$reg_pr .= $argN[$xi]['descripcion'].". ";
						}
					}
				}
				
				echo "<td><p id='" . $NomId . "'";
					 
				
				
				
				//argB argN
				
				 
					//echo " title= '".$cMonth." - ".($i-$startday+1)."<-dia'>" ;
					//	echo  " title= '".$Bancarios[$NDia_F][0].".' ";
					
				echo " title = '".$reg_pr."'>".($i - $startday + 1) . "</p></td>";
			}
			
			if(($i % 7) == 6 ) echo "</tr>";
			
			$Dia=$Dia+86400;
			$reg_pr="";
		}
	?>
</table>
<span id="leyenda_fecha_actual">Fecha Actual</span>
<span id="leyenda_fecha_fin">No Laborable</span>
<span id="leyenda_fecha_bancario">Feriado Bancario</span>
<span id="leyenda_fecha_nacional">Feriado Nacional</span>
