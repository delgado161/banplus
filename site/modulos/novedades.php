<span id="novedades">
	<?php
		if ($Idn=="") {
			$Novedades = get_novedades($Id,$Ids,$Idc);
			echo $Novedades;
		}else{
			$Novedades_det = get_novedades_det($Idn);
			echo $Novedades_det;
		}
	?>
</span>
