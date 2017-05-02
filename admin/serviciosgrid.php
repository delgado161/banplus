<?php include_once "usuariosinfo.php" ?>
<?php

// Create page object
$servicios_grid = new cservicios_grid();
$MasterPage =& $Page;
$Page =& $servicios_grid;

// Page init
$servicios_grid->Page_Init();

// Page main
$servicios_grid->Page_Main();
?>
<?php if ($servicios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var servicios_grid = new ew_Page("servicios_grid");

// page properties
servicios_grid.PageID = "grid"; // page ID
servicios_grid.FormID = "fserviciosgrid"; // form ID
var EW_PAGE_ID = servicios_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
servicios_grid.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	var addcnt = 0;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		var chkthisrow = true;
		if (fobj.a_list && fobj.a_list.value == "gridinsert")
			chkthisrow = !(this.EmptyRow(fobj, infix));
		else
			chkthisrow = true;
		if (chkthisrow) {
			addcnt += 1;
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
		} // End Grid Add checking
	}
	return true;
}

// Extend page with empty row check
servicios_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "nombre", false)) return false;
	if (ew_ValueChanged(fobj, infix, "imagen", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estatus", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
servicios_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
servicios_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
servicios_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($servicios->CurrentAction == "gridadd") {
	if ($servicios->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$servicios_grid->TotalRecs = $servicios->SelectRecordCount();
			$servicios_grid->Recordset = $servicios_grid->LoadRecordset($servicios_grid->StartRec-1, $servicios_grid->DisplayRecs);
		} else {
			if ($servicios_grid->Recordset = $servicios_grid->LoadRecordset())
				$servicios_grid->TotalRecs = $servicios_grid->Recordset->RecordCount();
		}
		$servicios_grid->StartRec = 1;
		$servicios_grid->DisplayRecs = $servicios_grid->TotalRecs;
	} else {
		$servicios->CurrentFilter = "0=1";
		$servicios_grid->StartRec = 1;
		$servicios_grid->DisplayRecs = $servicios->GridAddRowCount;
	}
	$servicios_grid->TotalRecs = $servicios_grid->DisplayRecs;
	$servicios_grid->StopRec = $servicios_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$servicios_grid->TotalRecs = $servicios->SelectRecordCount();
	} else {
		if ($servicios_grid->Recordset = $servicios_grid->LoadRecordset())
			$servicios_grid->TotalRecs = $servicios_grid->Recordset->RecordCount();
	}
	$servicios_grid->StartRec = 1;
	$servicios_grid->DisplayRecs = $servicios_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$servicios_grid->Recordset = $servicios_grid->LoadRecordset($servicios_grid->StartRec-1, $servicios_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($servicios->CurrentMode == "add" || $servicios->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($servicios->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $servicios->TableCaption() ?></p>
</p>
<?php $servicios_grid->ShowPageHeader(); ?>
<?php
$servicios_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_servicios" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $servicios->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$servicios_grid->RenderListOptions();

// Render list options (header, left)
$servicios_grid->ListOptions->Render("header", "left");
?>
<?php if ($servicios->nombre->Visible) { // nombre ?>
	<?php if ($servicios->SortUrl($servicios->nombre) == "") { ?>
		<td><?php echo $servicios->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $servicios->nombre->FldCaption() ?></td><td style="width: 10px;"><?php if ($servicios->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($servicios->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($servicios->imagen->Visible) { // imagen ?>
	<?php if ($servicios->SortUrl($servicios->imagen) == "") { ?>
		<td><?php echo $servicios->imagen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $servicios->imagen->FldCaption() ?></td><td style="width: 10px;"><?php if ($servicios->imagen->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($servicios->imagen->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($servicios->estatus->Visible) { // estatus ?>
	<?php if ($servicios->SortUrl($servicios->estatus) == "") { ?>
		<td><?php echo $servicios->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $servicios->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($servicios->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($servicios->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$servicios_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$servicios_grid->StartRec = 1;
$servicios_grid->StopRec = $servicios_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($servicios->CurrentAction == "gridadd" || $servicios->CurrentAction == "gridedit" || $servicios->CurrentAction == "F")) {
		$servicios_grid->KeyCount = $objForm->GetValue("key_count");
		$servicios_grid->StopRec = $servicios_grid->KeyCount;
	}
}
$servicios_grid->RecCnt = $servicios_grid->StartRec - 1;
if ($servicios_grid->Recordset && !$servicios_grid->Recordset->EOF) {
	$servicios_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $servicios_grid->StartRec > 1)
		$servicios_grid->Recordset->Move($servicios_grid->StartRec - 1);
} elseif (!$servicios->AllowAddDeleteRow && $servicios_grid->StopRec == 0) {
	$servicios_grid->StopRec = $servicios->GridAddRowCount;
}

// Initialize aggregate
$servicios->RowType = EW_ROWTYPE_AGGREGATEINIT;
$servicios->ResetAttrs();
$servicios_grid->RenderRow();
$servicios_grid->RowCnt = 0;
if ($servicios->CurrentAction == "gridadd")
	$servicios_grid->RowIndex = 0;
if ($servicios->CurrentAction == "gridedit")
	$servicios_grid->RowIndex = 0;
while ($servicios_grid->RecCnt < $servicios_grid->StopRec) {
	$servicios_grid->RecCnt++;
	if (intval($servicios_grid->RecCnt) >= intval($servicios_grid->StartRec)) {
		$servicios_grid->RowCnt++;
		if ($servicios->CurrentAction == "gridadd" || $servicios->CurrentAction == "gridedit" || $servicios->CurrentAction == "F") {
			$servicios_grid->RowIndex++;
			$objForm->Index = $servicios_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$servicios_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($servicios->CurrentAction == "gridadd")
				$servicios_grid->RowAction = "insert";
			else
				$servicios_grid->RowAction = "";
		}

		// Set up key count
		$servicios_grid->KeyCount = $servicios_grid->RowIndex;

		// Init row class and style
		$servicios->ResetAttrs();
		$servicios->CssClass = "";
		if ($servicios->CurrentAction == "gridadd") {
			if ($servicios->CurrentMode == "copy") {
				$servicios_grid->LoadRowValues($servicios_grid->Recordset); // Load row values
				$servicios_grid->SetRecordKey($servicios_grid->RowOldKey, $servicios_grid->Recordset); // Set old record key
			} else {
				$servicios_grid->LoadDefaultValues(); // Load default values
				$servicios_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($servicios->CurrentAction == "gridedit") {
			$servicios_grid->LoadRowValues($servicios_grid->Recordset); // Load row values
		}
		$servicios->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($servicios->CurrentAction == "gridadd") // Grid add
			$servicios->RowType = EW_ROWTYPE_ADD; // Render add
		if ($servicios->CurrentAction == "gridadd" && $servicios->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$servicios_grid->RestoreCurrentRowFormValues($servicios_grid->RowIndex); // Restore form values
		if ($servicios->CurrentAction == "gridedit") { // Grid edit
			if ($servicios->EventCancelled) {
				$servicios_grid->RestoreCurrentRowFormValues($servicios_grid->RowIndex); // Restore form values
			}
			if ($servicios_grid->RowAction == "insert")
				$servicios->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$servicios->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($servicios->CurrentAction == "gridedit" && ($servicios->RowType == EW_ROWTYPE_EDIT || $servicios->RowType == EW_ROWTYPE_ADD) && $servicios->EventCancelled) // Update failed
			$servicios_grid->RestoreCurrentRowFormValues($servicios_grid->RowIndex); // Restore form values
		if ($servicios->RowType == EW_ROWTYPE_EDIT) // Edit row
			$servicios_grid->EditRowCnt++;
		if ($servicios->CurrentAction == "F") // Confirm row
			$servicios_grid->RestoreCurrentRowFormValues($servicios_grid->RowIndex); // Restore form values
		if ($servicios->RowType == EW_ROWTYPE_ADD || $servicios->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($servicios->CurrentAction == "edit") {
				$servicios->RowAttrs = array();
				$servicios->CssClass = "ewTableEditRow";
			} else {
				$servicios->RowAttrs = array();
			}
			if (!empty($servicios_grid->RowIndex))
				$servicios->RowAttrs = array_merge($servicios->RowAttrs, array('data-rowindex'=>$servicios_grid->RowIndex, 'id'=>'r' . $servicios_grid->RowIndex . '_servicios'));
		} else {
			$servicios->RowAttrs = array();
		}

		// Render row
		$servicios_grid->RenderRow();

		// Render list options
		$servicios_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($servicios_grid->RowAction <> "delete" && $servicios_grid->RowAction <> "insertdelete" && !($servicios_grid->RowAction == "insert" && $servicios->CurrentAction == "F" && $servicios_grid->EmptyRow())) {
?>
	<tr<?php echo $servicios->RowAttributes() ?>>
<?php

// Render list options (body, left)
$servicios_grid->ListOptions->Render("body", "left");
?>
	<?php if ($servicios->nombre->Visible) { // nombre ?>
		<td<?php echo $servicios->nombre->CellAttributes() ?>>
<?php if ($servicios->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $servicios_grid->RowIndex ?>_nombre" id="x<?php echo $servicios_grid->RowIndex ?>_nombre" size="30" maxlength="45" value="<?php echo $servicios->nombre->EditValue ?>"<?php echo $servicios->nombre->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $servicios_grid->RowIndex ?>_nombre" id="o<?php echo $servicios_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($servicios->nombre->OldValue) ?>">
<?php } ?>
<?php if ($servicios->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $servicios_grid->RowIndex ?>_nombre" id="x<?php echo $servicios_grid->RowIndex ?>_nombre" size="30" maxlength="45" value="<?php echo $servicios->nombre->EditValue ?>"<?php echo $servicios->nombre->EditAttributes() ?>>
<?php } ?>
<?php if ($servicios->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $servicios->nombre->ViewAttributes() ?>><?php echo $servicios->nombre->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $servicios_grid->RowIndex ?>_nombre" id="x<?php echo $servicios_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($servicios->nombre->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $servicios_grid->RowIndex ?>_nombre" id="o<?php echo $servicios_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($servicios->nombre->OldValue) ?>">
<?php } ?>
<a name="<?php echo $servicios_grid->PageObjName . "_row_" . $servicios_grid->RowCnt ?>" id="<?php echo $servicios_grid->PageObjName . "_row_" . $servicios_grid->RowCnt ?>"></a>
<?php if ($servicios->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $servicios_grid->RowIndex ?>_id_servicios" id="o<?php echo $servicios_grid->RowIndex ?>_id_servicios" value="<?php echo ew_HtmlEncode($servicios->id_servicios->OldValue) ?>">
<?php } ?>
<?php if ($servicios->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $servicios_grid->RowIndex ?>_id_servicios" id="x<?php echo $servicios_grid->RowIndex ?>_id_servicios" value="<?php echo ew_HtmlEncode($servicios->id_servicios->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($servicios->imagen->Visible) { // imagen ?>
		<td<?php echo $servicios->imagen->CellAttributes() ?>>
<?php if ($servicios_grid->RowAction == "insert") { // Add record ?>
<?php if ($servicios->CurrentAction <> "F") { ?>
<div id="old_x<?php echo $servicios_grid->RowIndex ?>_imagen">
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
</div>
<div id="new_x<?php echo $servicios_grid->RowIndex ?>_imagen">
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $servicios->imagen->EditAttrs["onchange"] = "this.form.a" . $servicios_grid->RowIndex . "_imagen[2].checked=true;" . @$servicios->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="3">
<?php } ?>
<input type="file" name="x<?php echo $servicios_grid->RowIndex ?>_imagen" id="x<?php echo $servicios_grid->RowIndex ?>_imagen" size="30"<?php echo $servicios->imagen->EditAttributes() ?>>
</div>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="<?php echo $servicios->imagen->Upload->Action ?>">
<?php
if ($servicios->imagen->Upload->Action == "1") {
	if (!ew_Empty($servicios->imagen->Upload->DbValue)) {
?>
<img src="ewbv8.php?tbl=<?php echo $servicios->TableVar ?>&fld=x_imagen&rnd=<?php echo ew_Random() ?>&idx=<?php echo $servicios_grid->RowIndex ?>&db=1&file=1&path=<?php echo urlencode($servicios->imagen->UploadPath) ?>" border="0">
<?php
	}
} elseif ($servicios->imagen->Upload->Action == "2") {
} else {
	if (!ew_Empty($servicios->imagen->Upload->Value)) {
?>
<img src="ewbv8.php?tbl=<?php echo $servicios->TableVar ?>&fld=x_imagen&rnd=<?php echo ew_Random() ?>&idx=<?php echo $servicios_grid->RowIndex ?>" border="0">
<?php
	}
}
?>
<?php } ?>
<input type="hidden" name="o<?php echo $servicios_grid->RowIndex ?>_imagen" id="o<?php echo $servicios_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($servicios->imagen->OldValue) ?>">
<?php } else { // Edit record ?>
<?php if ($servicios->CurrentAction <> "F") { ?>
<div id="old_x<?php echo $servicios_grid->RowIndex ?>_imagen">
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
</div>
<div id="new_x<?php echo $servicios_grid->RowIndex ?>_imagen">
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $servicios->imagen->EditAttrs["onchange"] = "this.form.a" . $servicios_grid->RowIndex . "_imagen[2].checked=true;" . @$servicios->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="3">
<?php } ?>
<input type="file" name="x<?php echo $servicios_grid->RowIndex ?>_imagen" id="x<?php echo $servicios_grid->RowIndex ?>_imagen" size="30"<?php echo $servicios->imagen->EditAttributes() ?>>
</div>
<?php } else { ?>
<div id="old_x<?php echo $servicios_grid->RowIndex ?>_imagen">
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
<?php if (!ew_Empty($servicios->imagen->Upload->DbValue) && $servicios->imagen->Upload->Action == "3") echo "[" . $Language->Phrase("Old") . "]"; ?>
</div>
<div id="new_x<?php echo $servicios_grid->RowIndex ?>_imagen">
<input type="hidden" name="a_imagen" id="a_imagen" value="<?php echo $servicios->imagen->Upload->Action ?>">
<?php
if ($servicios->imagen->Upload->Action == "1") {
	echo "[" . $Language->Phrase("Keep") . "]";
} elseif ($servicios->imagen->Upload->Action == "2") {
	echo "[" . $Language->Phrase("Remove") . "]";
} else {
	if (!ew_Empty($servicios->imagen->Upload->Value)) {
?>
<img src="ewbv8.php?tbl=<?php echo $servicios->TableVar ?>&fld=x_imagen&rnd=<?php echo ew_Random() ?>&idx=<?php echo $servicios_grid->RowIndex ?>" border="0">
<?php
	}
}
?>
<?php if (!ew_Empty($servicios->imagen->Upload->DbValue) && $servicios->imagen->Upload->Action == "3") echo "[" . $Language->Phrase("New") . "]"; ?>
</div>
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($servicios->estatus->Visible) { // estatus ?>
		<td<?php echo $servicios->estatus->CellAttributes() ?>>
<?php if ($servicios->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $servicios_grid->RowIndex ?>_estatus" name="x<?php echo $servicios_grid->RowIndex ?>_estatus"<?php echo $servicios->estatus->EditAttributes() ?>>
<?php
if (is_array($servicios->estatus->EditValue)) {
	$arwrk = $servicios->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($servicios->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $servicios->estatus->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $servicios_grid->RowIndex ?>_estatus" id="o<?php echo $servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($servicios->estatus->OldValue) ?>">
<?php } ?>
<?php if ($servicios->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $servicios_grid->RowIndex ?>_estatus" name="x<?php echo $servicios_grid->RowIndex ?>_estatus"<?php echo $servicios->estatus->EditAttributes() ?>>
<?php
if (is_array($servicios->estatus->EditValue)) {
	$arwrk = $servicios->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($servicios->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $servicios->estatus->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($servicios->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $servicios->estatus->ViewAttributes() ?>><?php echo $servicios->estatus->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $servicios_grid->RowIndex ?>_estatus" id="x<?php echo $servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($servicios->estatus->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $servicios_grid->RowIndex ?>_estatus" id="o<?php echo $servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($servicios->estatus->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$servicios_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($servicios->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($servicios->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($servicios->CurrentAction <> "gridadd" || $servicios->CurrentMode == "copy")
		if (!$servicios_grid->Recordset->EOF) $servicios_grid->Recordset->MoveNext();
}
?>
<?php
	if ($servicios->CurrentMode == "add" || $servicios->CurrentMode == "copy" || $servicios->CurrentMode == "edit") {
		$servicios_grid->RowIndex = '$rowindex$';
		$servicios_grid->LoadDefaultValues();

		// Set row properties
		$servicios->ResetAttrs();
		$servicios->RowAttrs = array();
		if (!empty($servicios_grid->RowIndex))
			$servicios->RowAttrs = array_merge($servicios->RowAttrs, array('data-rowindex'=>$servicios_grid->RowIndex, 'id'=>'r' . $servicios_grid->RowIndex . '_servicios'));
		$servicios->RowType = EW_ROWTYPE_ADD;

		// Render row
		$servicios_grid->RenderRow();

		// Render list options
		$servicios_grid->RenderListOptions();

		// Add id and class to the template row
		$servicios->RowAttrs["id"] = "r0_servicios";
		ew_AppendClass($servicios->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $servicios->RowAttributes() ?>>
<?php

// Render list options (body, left)
$servicios_grid->ListOptions->Render("body", "left");
?>
	<?php if ($servicios->nombre->Visible) { // nombre ?>
		<td>
<?php if ($servicios->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $servicios_grid->RowIndex ?>_nombre" id="x<?php echo $servicios_grid->RowIndex ?>_nombre" size="30" maxlength="45" value="<?php echo $servicios->nombre->EditValue ?>"<?php echo $servicios->nombre->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $servicios->nombre->ViewAttributes() ?>><?php echo $servicios->nombre->ViewValue ?></div>
<input type="hidden" name="x<?php echo $servicios_grid->RowIndex ?>_nombre" id="x<?php echo $servicios_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($servicios->nombre->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $servicios_grid->RowIndex ?>_nombre" id="o<?php echo $servicios_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($servicios->nombre->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($servicios->imagen->Visible) { // imagen ?>
		<td>
<?php if ($servicios->CurrentAction <> "F") { ?>
<div id="old_x<?php echo $servicios_grid->RowIndex ?>_imagen">
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
</div>
<div id="new_x<?php echo $servicios_grid->RowIndex ?>_imagen">
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $servicios->imagen->EditAttrs["onchange"] = "this.form.a" . $servicios_grid->RowIndex . "_imagen[2].checked=true;" . @$servicios->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a<?php echo $servicios_grid->RowIndex ?>_imagen" id="a<?php echo $servicios_grid->RowIndex ?>_imagen" value="3">
<?php } ?>
<input type="file" name="x<?php echo $servicios_grid->RowIndex ?>_imagen" id="x<?php echo $servicios_grid->RowIndex ?>_imagen" size="30"<?php echo $servicios->imagen->EditAttributes() ?>>
</div>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="<?php echo $servicios->imagen->Upload->Action ?>">
<?php
if ($servicios->imagen->Upload->Action == "1") {
	if (!ew_Empty($servicios->imagen->Upload->DbValue)) {
?>
<img src="ewbv8.php?tbl=<?php echo $servicios->TableVar ?>&fld=x_imagen&rnd=<?php echo ew_Random() ?>&idx=<?php echo $servicios_grid->RowIndex ?>&db=1&file=1&path=<?php echo urlencode($servicios->imagen->UploadPath) ?>" border="0">
<?php
	}
} elseif ($servicios->imagen->Upload->Action == "2") {
} else {
	if (!ew_Empty($servicios->imagen->Upload->Value)) {
?>
<img src="ewbv8.php?tbl=<?php echo $servicios->TableVar ?>&fld=x_imagen&rnd=<?php echo ew_Random() ?>&idx=<?php echo $servicios_grid->RowIndex ?>" border="0">
<?php
	}
}
?>
<?php } ?>
<input type="hidden" name="o<?php echo $servicios_grid->RowIndex ?>_imagen" id="o<?php echo $servicios_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($servicios->imagen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($servicios->estatus->Visible) { // estatus ?>
		<td>
<?php if ($servicios->CurrentAction <> "F") { ?>
<select id="x<?php echo $servicios_grid->RowIndex ?>_estatus" name="x<?php echo $servicios_grid->RowIndex ?>_estatus"<?php echo $servicios->estatus->EditAttributes() ?>>
<?php
if (is_array($servicios->estatus->EditValue)) {
	$arwrk = $servicios->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($servicios->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $servicios->estatus->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $servicios->estatus->ViewAttributes() ?>><?php echo $servicios->estatus->ViewValue ?></div>
<input type="hidden" name="x<?php echo $servicios_grid->RowIndex ?>_estatus" id="x<?php echo $servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($servicios->estatus->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $servicios_grid->RowIndex ?>_estatus" id="o<?php echo $servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($servicios->estatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$servicios_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($servicios->CurrentMode == "add" || $servicios->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $servicios_grid->KeyCount ?>">
<?php echo $servicios_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($servicios->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $servicios_grid->KeyCount ?>">
<?php echo $servicios_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="servicios_grid">
</div>
<?php

// Close recordset
if ($servicios_grid->Recordset)
	$servicios_grid->Recordset->Close();
?>
<?php if (($servicios->CurrentMode == "add" || $servicios->CurrentMode == "copy" || $servicios->CurrentMode == "edit") && $servicios->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($servicios->AllowAddDeleteRow) { ?>
<?php if ($Security->CanAdd()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($servicios->Export == "" && $servicios->CurrentAction == "") { ?>
<?php } ?>
<?php
$servicios_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$servicios_grid->Page_Terminate();
$Page =& $MasterPage;
?>
