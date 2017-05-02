<?php

// Call Row_Rendering event
$encuesta->Row_Rendering();

// nombre
// id_grupo
// estatus
// Call Row_Rendered event

$encuesta->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($encuesta->nombre->Visible) { // nombre ?>
		<tr id="r_nombre">
			<td class="ewTableHeader"><?php echo $encuesta->nombre->FldCaption() ?></td>
			<td<?php echo $encuesta->nombre->CellAttributes() ?>>
<div<?php echo $encuesta->nombre->ViewAttributes() ?>><?php echo $encuesta->nombre->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($encuesta->id_grupo->Visible) { // id_grupo ?>
		<tr id="r_id_grupo">
			<td class="ewTableHeader"><?php echo $encuesta->id_grupo->FldCaption() ?></td>
			<td<?php echo $encuesta->id_grupo->CellAttributes() ?>>
<div<?php echo $encuesta->id_grupo->ViewAttributes() ?>><?php echo $encuesta->id_grupo->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($encuesta->estatus->Visible) { // estatus ?>
		<tr id="r_estatus">
			<td class="ewTableHeader"><?php echo $encuesta->estatus->FldCaption() ?></td>
			<td<?php echo $encuesta->estatus->CellAttributes() ?>>
<div<?php echo $encuesta->estatus->ViewAttributes() ?>><?php echo $encuesta->estatus->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
