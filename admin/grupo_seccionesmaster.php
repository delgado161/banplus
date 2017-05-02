<?php

// Call Row_Rendering event
$grupo_secciones->Row_Rendering();

// id_contenido
// id_grupo
// orden
// estatus
// Call Row_Rendered event

$grupo_secciones->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($grupo_secciones->id_contenido->Visible) { // id_contenido ?>
		<tr id="r_id_contenido">
			<td class="ewTableHeader"><?php echo $grupo_secciones->id_contenido->FldCaption() ?></td>
			<td<?php echo $grupo_secciones->id_contenido->CellAttributes() ?>>
<div<?php echo $grupo_secciones->id_contenido->ViewAttributes() ?>><?php echo $grupo_secciones->id_contenido->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($grupo_secciones->id_grupo->Visible) { // id_grupo ?>
		<tr id="r_id_grupo">
			<td class="ewTableHeader"><?php echo $grupo_secciones->id_grupo->FldCaption() ?></td>
			<td<?php echo $grupo_secciones->id_grupo->CellAttributes() ?>>
<div<?php echo $grupo_secciones->id_grupo->ViewAttributes() ?>><?php echo $grupo_secciones->id_grupo->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($grupo_secciones->orden->Visible) { // orden ?>
		<tr id="r_orden">
			<td class="ewTableHeader"><?php echo $grupo_secciones->orden->FldCaption() ?></td>
			<td<?php echo $grupo_secciones->orden->CellAttributes() ?>>
<div<?php echo $grupo_secciones->orden->ViewAttributes() ?>><?php echo $grupo_secciones->orden->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($grupo_secciones->estatus->Visible) { // estatus ?>
		<tr id="r_estatus">
			<td class="ewTableHeader"><?php echo $grupo_secciones->estatus->FldCaption() ?></td>
			<td<?php echo $grupo_secciones->estatus->CellAttributes() ?>>
<div<?php echo $grupo_secciones->estatus->ViewAttributes() ?>><?php echo $grupo_secciones->estatus->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
