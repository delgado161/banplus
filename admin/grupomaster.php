<?php

// Call Row_Rendering event
$grupo->Row_Rendering();

// nombre
// descripcion
// Call Row_Rendered event

$grupo->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($grupo->nombre->Visible) { // nombre ?>
		<tr id="r_nombre">
			<td class="ewTableHeader"><?php echo $grupo->nombre->FldCaption() ?></td>
			<td<?php echo $grupo->nombre->CellAttributes() ?>>
<div<?php echo $grupo->nombre->ViewAttributes() ?>><?php echo $grupo->nombre->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($grupo->descripcion->Visible) { // descripcion ?>
		<tr id="r_descripcion">
			<td class="ewTableHeader"><?php echo $grupo->descripcion->FldCaption() ?></td>
			<td<?php echo $grupo->descripcion->CellAttributes() ?>>
<div<?php echo $grupo->descripcion->ViewAttributes() ?>><?php echo $grupo->descripcion->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
