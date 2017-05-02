<?php

// Call Row_Rendering event
$documentos->Row_Rendering();

// titulo
// documento
// fecha
// estatus
// Call Row_Rendered event

$documentos->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($documentos->titulo->Visible) { // titulo ?>
		<tr id="r_titulo">
			<td class="ewTableHeader"><?php echo $documentos->titulo->FldCaption() ?></td>
			<td<?php echo $documentos->titulo->CellAttributes() ?>>
<div<?php echo $documentos->titulo->ViewAttributes() ?>><?php echo $documentos->titulo->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($documentos->documento->Visible) { // documento ?>
		<tr id="r_documento">
			<td class="ewTableHeader"><?php echo $documentos->documento->FldCaption() ?></td>
			<td<?php echo $documentos->documento->CellAttributes() ?>>
<?php if ($documentos->documento->LinkAttributes() <> "") { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<a<?php echo $documentos->documento->LinkAttributes() ?>><?php echo $documentos->documento->ListViewValue() ?></a>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<?php echo $documentos->documento->ListViewValue() ?>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		</tr>
<?php } ?>
<?php if ($documentos->fecha->Visible) { // fecha ?>
		<tr id="r_fecha">
			<td class="ewTableHeader"><?php echo $documentos->fecha->FldCaption() ?></td>
			<td<?php echo $documentos->fecha->CellAttributes() ?>>
<div<?php echo $documentos->fecha->ViewAttributes() ?>><?php echo $documentos->fecha->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($documentos->estatus->Visible) { // estatus ?>
		<tr id="r_estatus">
			<td class="ewTableHeader"><?php echo $documentos->estatus->FldCaption() ?></td>
			<td<?php echo $documentos->estatus->CellAttributes() ?>>
<div<?php echo $documentos->estatus->ViewAttributes() ?>><?php echo $documentos->estatus->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
