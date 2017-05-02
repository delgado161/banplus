<?php

// Call Row_Rendering event
$banner_seccion->Row_Rendering();

// id_banner
// id_grupo_secciones
// fecha_inicio
// fecha_fin
// id_posicion
// Call Row_Rendered event

$banner_seccion->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($banner_seccion->id_banner->Visible) { // id_banner ?>
		<tr id="r_id_banner">
			<td class="ewTableHeader"><?php echo $banner_seccion->id_banner->FldCaption() ?></td>
			<td<?php echo $banner_seccion->id_banner->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($banner_seccion->id_grupo_secciones->Visible) { // id_grupo_secciones ?>
		<tr id="r_id_grupo_secciones">
			<td class="ewTableHeader"><?php echo $banner_seccion->id_grupo_secciones->FldCaption() ?></td>
			<td<?php echo $banner_seccion->id_grupo_secciones->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_grupo_secciones->ViewAttributes() ?>><?php echo $banner_seccion->id_grupo_secciones->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($banner_seccion->fecha_inicio->Visible) { // fecha_inicio ?>
		<tr id="r_fecha_inicio">
			<td class="ewTableHeader"><?php echo $banner_seccion->fecha_inicio->FldCaption() ?></td>
			<td<?php echo $banner_seccion->fecha_inicio->CellAttributes() ?>>
<div<?php echo $banner_seccion->fecha_inicio->ViewAttributes() ?>><?php echo $banner_seccion->fecha_inicio->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($banner_seccion->fecha_fin->Visible) { // fecha_fin ?>
		<tr id="r_fecha_fin">
			<td class="ewTableHeader"><?php echo $banner_seccion->fecha_fin->FldCaption() ?></td>
			<td<?php echo $banner_seccion->fecha_fin->CellAttributes() ?>>
<div<?php echo $banner_seccion->fecha_fin->ViewAttributes() ?>><?php echo $banner_seccion->fecha_fin->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($banner_seccion->id_posicion->Visible) { // id_posicion ?>
		<tr id="r_id_posicion">
			<td class="ewTableHeader"><?php echo $banner_seccion->id_posicion->FldCaption() ?></td>
			<td<?php echo $banner_seccion->id_posicion->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_posicion->ViewAttributes() ?>><?php echo $banner_seccion->id_posicion->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
