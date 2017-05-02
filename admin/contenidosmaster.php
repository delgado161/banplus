<?php

// Call Row_Rendering event
$contenidos->Row_Rendering();

// titulo
// edicion
// estatus
// Call Row_Rendered event

$contenidos->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($contenidos->titulo->Visible) { // titulo ?>
		<tr id="r_titulo">
			<td class="ewTableHeader"><?php echo $contenidos->titulo->FldCaption() ?></td>
			<td<?php echo $contenidos->titulo->CellAttributes() ?>>
<div<?php echo $contenidos->titulo->ViewAttributes() ?>><?php echo $contenidos->titulo->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($contenidos->edicion->Visible) { // edicion ?>
		<tr id="r_edicion">
			<td class="ewTableHeader"><?php echo $contenidos->edicion->FldCaption() ?></td>
			<td<?php echo $contenidos->edicion->CellAttributes() ?>>
<div<?php echo $contenidos->edicion->ViewAttributes() ?>><?php echo $contenidos->edicion->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($contenidos->estatus->Visible) { // estatus ?>
		<tr id="r_estatus">
			<td class="ewTableHeader"><?php echo $contenidos->estatus->FldCaption() ?></td>
			<td<?php echo $contenidos->estatus->CellAttributes() ?>>
<div<?php echo $contenidos->estatus->ViewAttributes() ?>><?php echo $contenidos->estatus->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
