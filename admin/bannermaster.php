<?php

// Call Row_Rendering event
$banner->Row_Rendering();

// nombre
// imagen
// estatus
// Call Row_Rendered event

$banner->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($banner->nombre->Visible) { // nombre ?>
		<tr id="r_nombre">
			<td class="ewTableHeader"><?php echo $banner->nombre->FldCaption() ?></td>
			<td<?php echo $banner->nombre->CellAttributes() ?>>
<div<?php echo $banner->nombre->ViewAttributes() ?>><?php echo $banner->nombre->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($banner->imagen->Visible) { // imagen ?>
		<tr id="r_imagen">
			<td class="ewTableHeader"><?php echo $banner->imagen->FldCaption() ?></td>
			<td<?php echo $banner->imagen->CellAttributes() ?>>
<?php if ($banner->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($banner->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $banner->imagen->UploadPath) . $banner->imagen->Upload->DbValue ?>" border=0<?php echo $banner->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($banner->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($banner->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $banner->imagen->UploadPath) . $banner->imagen->Upload->DbValue ?>" border=0<?php echo $banner->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($banner->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		</tr>
<?php } ?>
<?php if ($banner->estatus->Visible) { // estatus ?>
		<tr id="r_estatus">
			<td class="ewTableHeader"><?php echo $banner->estatus->FldCaption() ?></td>
			<td<?php echo $banner->estatus->CellAttributes() ?>>
<div<?php echo $banner->estatus->ViewAttributes() ?>><?php echo $banner->estatus->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
