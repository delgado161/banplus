<span id="noticias">
	<?php
		if ($Idn=="") {
			if ($NumP=="") {
				$NumP=1;
			}
		
			$MRXP=10;
			$Not_Totales = execute_sql("get_noticias_TOTALES",array($Id,1));
			$Not_Num_Pag = $Not_Totales[1]["Total"]/$MRXP;			
			$Limit = ($NumP-1)*$MRXP;
			
			$Not = get_noticias($Id,1,14,$Limit,$MRXP);
			echo $Not;
	?>
			<span id="paginador">
				<ul>
				<?php	
					$Paginador = get_paginador($Not_Num_Pag,$NumP,$Id,$Idc);
					echo $Paginador;							
				?>
				</ul>
			</span>
	<?php			
		}else{
			$Not = get_noticia_detalle($Id,$Idn,14);
			echo $Not;
		}
	?>	
</span>