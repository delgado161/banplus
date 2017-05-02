<span id="buscador">
	<?php
		if ($BuscarSrc!="") {
		
			if ($_GET["np"]==0) {

				$NumP=1;
			} 
			
			$MRXP=10;
			$Not_Totales = execute_sql("get_buscador_resultados2",array($BuscarSrc));

			$Not_Totales=count($Not_Totales);
			$Not_Num_Pag = ceil($Not_Totales/$MRXP);		


			$Limit = ($NumP-1)*$MRXP;


			$Buscador = get_buscador_resultados($BuscarSrc,$Limit,$MRXP);
			
			if ($Buscador!=""){
				echo '<span style="float:left;" class="stit">Resultados de <strong>' . strtoupper($BuscarSrc) . '</strong></span>';
				echo '<span style="float:right;" class="stit">aproximadamente <strong>' . $Not_Totales . '</strong> resultados</span>';
				echo $Buscador;
	?>
				<span id="paginador">
					<ul>
					<?php	
						$Cadena = "&buscar=".$BuscarSrc;
						$Paginador = get_paginador($Not_Num_Pag,$NumP,$Id,$Idc,$Cadena);
						echo $Paginador;							
					?>
					</ul>
				</span>
	<?php
				
			}else{
				echo "No se encontraron resultados para: <b>$BuscarSrc</b>";
			}	
		}
	?>
</span>
