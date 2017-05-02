 <div id="cuerpo">
<div id="banner_central">
	<div class="content">
		<div id="myGallery">
			<?php
				$BannerHC = get_banner_home($Idsb,9);
				echo $BannerHC;
			?>
		</div>
	</div>
</div>
<div id="banplus_online">
	<ul>
		<?php
			$EnlacesOnline = link_online($Id);
			echo $EnlacesOnline;
		?>
	</ul>
</div>
<div id="banner_1">
	<?php
		$Banner1 = get_banner_general($Idsb,2);
		echo $Banner1;
	?>
</div>
<div id="banner_2">
	<?php
		$Banner2 = get_banner_general($Idsb,3);
		echo $Banner2;
	?>
</div>

<div id="informacion">
	<?php
		$Noticia = get_noticias_home($Id);
		$tit_info = execute_sql("get_parametro",array(42));   
		echo '<span id="tit">'.$tit_info[1]["valor"].'</span>';
		
		echo '<div id="mooqueecarousel"><div id="mooquee">' . $Noticia . '</div></div>';
	?>	
</div>
<div id="twitter">

		<div id="tw3" >
			<?php require_once 'includes/i_twitter.php'; ?>
		
		</div>

		<div id="tw2" style="display:none;">
		<?php
			
			$Banner12 = get_banner_general($Idsb,13,1);
			echo $Banner12;
		?>
		</div>

		
</div>


<div id="accesos_directos">
	<p>ACCESOS DIRECTOS</p>
	<?php
		$AccDir = menu_lateral($Id);
		echo $AccDir;
	?>
</div>

<div id="banner_3">
	<?php
		$Banner3 = get_banner_general($Idsb,5);
		echo $Banner3;
	?>
</div>
<div id="banner_4">
	<?php
		$Banner4 = get_banner_general($Idsb,4);
		echo $Banner4;
	?>
</div>


<?php
	$EncPre = encuesta_home($Id); 
	if ($EncPre) { ?> 
		<div id="encuesta">

			<form action="#" method="post" name="form_encuest" onSubmit="return valida_encuesta();">
			<input type="hidden" name="auth_token" value="<?php echo generateFormToken('send_message')?>">
				<? 

					echo $EncPre;
				?>
				<span id="ver_resultados"><a href="Javascript:cargarContenido(document.form_encuest.id_enc.value, document.form_encuest.id_seg.value);"><img src="img/btn_ver_resultados.jpg" border="0"></a></span>
				<span id="opinar"><input type="image" src="img/btn_opinar.jpg" name="Opinar" value="Opinar" id="bt_opinar"></span>
			</form>

		</div> <?php } 
	else { ?> 
		<div style="width:611px; height:108px; overflow:hidden;">
			<?php
				$nbnn = get_banner_general($Idsb,11);
				echo $nbnn;
			?>
		</div>	 <?php } ?>

<div id="follow">
		<br>
<?php

	include "includes/i_follow.php";
?>
</div>
<div id="banner_5">
	<?php
		$Banner5 = get_banner_general($Idsb,8);
		echo $Banner5;
	?>
</div>
<div id="banner_6">
	<?php
		$Banner6 = get_banner_general($Idsb,7);
		echo $Banner6;
	?>
</div>
<div id="banner_7">
	<?php
		$Banner7 = get_banner_general($Idsb,6);
		echo $Banner7;
	?>
</div>

<div id="banner_8">
	<?php
		$Banner7 = get_banner_general($Idsb,14);
		echo $Banner7;
	?>
</div>

</div>