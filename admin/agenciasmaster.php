<?php

// Call Row_Rendering event
$agencias->Row_Rendering();

// nombre
// id_ciudad
// estatus
// Call Row_Rendered event

$agencias->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($agencias->nombre->Visible) { // nombre ?>
		<tr id="r_nombre">
			<td class="ewTableHeader"><?php echo $agencias->nombre->FldCaption() ?></td>
			<td<?php echo $agencias->nombre->CellAttributes() ?>>
<div<?php echo $agencias->nombre->ViewAttributes() ?>><?php echo $agencias->nombre->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($agencias->id_ciudad->Visible) { // id_ciudad ?>
		<tr id="r_id_ciudad">
			<td class="ewTableHeader"><?php echo $agencias->id_ciudad->FldCaption() ?></td>
			<td<?php echo $agencias->id_ciudad->CellAttributes() ?>>
<div<?php echo $agencias->id_ciudad->ViewAttributes() ?>><?php echo $agencias->id_ciudad->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($agencias->estatus->Visible) { // estatus ?>
		<tr id="r_estatus">
			<td class="ewTableHeader"><?php echo $agencias->estatus->FldCaption() ?></td>
			<td<?php echo $agencias->estatus->CellAttributes() ?>>
<div<?php echo $agencias->estatus->ViewAttributes() ?>><?php echo $agencias->estatus->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
