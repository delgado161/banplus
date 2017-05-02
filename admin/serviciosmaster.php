<?php

// Call Row_Rendering event
$servicios->Row_Rendering();

// nombre
// imagen
// estatus
// Call Row_Rendered event

$servicios->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($servicios->nombre->Visible) { // nombre ?>
		<tr id="r_nombre">
			<td class="ewTableHeader"><?php echo $servicios->nombre->FldCaption() ?></td>
			<td<?php echo $servicios->nombre->CellAttributes() ?>>
<div<?php echo $servicios->nombre->ViewAttributes() ?>><?php echo $servicios->nombre->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($servicios->imagen->Visible) { // imagen ?>
		<tr id="r_imagen">
			<td class="ewTableHeader"><?php echo $servicios->imagen->FldCaption() ?></td>
			<td<?php echo $servicios->imagen->CellAttributes() ?>>
<?php if ($servicios->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $servicios->imagen->UploadPath) . $servicios->imagen->Upload->DbValue ?>" border=0<?php echo $servicios->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($servicios->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $servicios->imagen->UploadPath) . $servicios->imagen->Upload->DbValue ?>" border=0<?php echo $servicios->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($servicios->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		</tr>
<?php } ?>
<?php if ($servicios->estatus->Visible) { // estatus ?>
		<tr id="r_estatus">
			<td class="ewTableHeader"><?php echo $servicios->estatus->FldCaption() ?></td>
			<td<?php echo $servicios->estatus->CellAttributes() ?>>
<div<?php echo $servicios->estatus->ViewAttributes() ?>><?php echo $servicios->estatus->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
