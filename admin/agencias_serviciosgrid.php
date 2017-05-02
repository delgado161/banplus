<?php include_once "usuariosinfo.php" ?>
<?php

// Create page object
$agencias_servicios_grid = new cagencias_servicios_grid();
$MasterPage =& $Page;
$Page =& $agencias_servicios_grid;

// Page init
$agencias_servicios_grid->Page_Init();

// Page main
$agencias_servicios_grid->Page_Main();
?>
<?php if ($agencias_servicios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var agencias_servicios_grid = new ew_Page("agencias_servicios_grid");

// page properties
agencias_servicios_grid.PageID = "grid"; // page ID
agencias_servicios_grid.FormID = "fagencias_serviciosgrid"; // form ID
var EW_PAGE_ID = agencias_servicios_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
agencias_servicios_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_id_servicio"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($agencias_servicios->id_servicio->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($agencias_servicios->estatus->FldCaption()) ?>");

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
agencias_servicios_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "id_servicio", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estatus", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
agencias_servicios_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
agencias_servicios_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
agencias_servicios_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($agencias_servicios->CurrentAction == "gridadd") {
	if ($agencias_servicios->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$agencias_servicios_grid->TotalRecs = $agencias_servicios->SelectRecordCount();
			$agencias_servicios_grid->Recordset = $agencias_servicios_grid->LoadRecordset($agencias_servicios_grid->StartRec-1, $agencias_servicios_grid->DisplayRecs);
		} else {
			if ($agencias_servicios_grid->Recordset = $agencias_servicios_grid->LoadRecordset())
				$agencias_servicios_grid->TotalRecs = $agencias_servicios_grid->Recordset->RecordCount();
		}
		$agencias_servicios_grid->StartRec = 1;
		$agencias_servicios_grid->DisplayRecs = $agencias_servicios_grid->TotalRecs;
	} else {
		$agencias_servicios->CurrentFilter = "0=1";
		$agencias_servicios_grid->StartRec = 1;
		$agencias_servicios_grid->DisplayRecs = $agencias_servicios->GridAddRowCount;
	}
	$agencias_servicios_grid->TotalRecs = $agencias_servicios_grid->DisplayRecs;
	$agencias_servicios_grid->StopRec = $agencias_servicios_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$agencias_servicios_grid->TotalRecs = $agencias_servicios->SelectRecordCount();
	} else {
		if ($agencias_servicios_grid->Recordset = $agencias_servicios_grid->LoadRecordset())
			$agencias_servicios_grid->TotalRecs = $agencias_servicios_grid->Recordset->RecordCount();
	}
	$agencias_servicios_grid->StartRec = 1;
	$agencias_servicios_grid->DisplayRecs = $agencias_servicios_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$agencias_servicios_grid->Recordset = $agencias_servicios_grid->LoadRecordset($agencias_servicios_grid->StartRec-1, $agencias_servicios_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($agencias_servicios->CurrentMode == "add" || $agencias_servicios->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($agencias_servicios->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $agencias_servicios->TableCaption() ?></p>
</p>
<?php $agencias_servicios_grid->ShowPageHeader(); ?>
<?php
$agencias_servicios_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_agencias_servicios" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $agencias_servicios->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$agencias_servicios_grid->RenderListOptions();

// Render list options (header, left)
$agencias_servicios_grid->ListOptions->Render("header", "left");
?>
<?php if ($agencias_servicios->id_servicio->Visible) { // id_servicio ?>
	<?php if ($agencias_servicios->SortUrl($agencias_servicios->id_servicio) == "") { ?>
		<td><?php echo $agencias_servicios->id_servicio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias_servicios->id_servicio->FldCaption() ?></td><td style="width: 10px;"><?php if ($agencias_servicios->id_servicio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias_servicios->id_servicio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($agencias_servicios->estatus->Visible) { // estatus ?>
	<?php if ($agencias_servicios->SortUrl($agencias_servicios->estatus) == "") { ?>
		<td><?php echo $agencias_servicios->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias_servicios->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($agencias_servicios->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias_servicios->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$agencias_servicios_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$agencias_servicios_grid->StartRec = 1;
$agencias_servicios_grid->StopRec = $agencias_servicios_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($agencias_servicios->CurrentAction == "gridadd" || $agencias_servicios->CurrentAction == "gridedit" || $agencias_servicios->CurrentAction == "F")) {
		$agencias_servicios_grid->KeyCount = $objForm->GetValue("key_count");
		$agencias_servicios_grid->StopRec = $agencias_servicios_grid->KeyCount;
	}
}
$agencias_servicios_grid->RecCnt = $agencias_servicios_grid->StartRec - 1;
if ($agencias_servicios_grid->Recordset && !$agencias_servicios_grid->Recordset->EOF) {
	$agencias_servicios_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $agencias_servicios_grid->StartRec > 1)
		$agencias_servicios_grid->Recordset->Move($agencias_servicios_grid->StartRec - 1);
} elseif (!$agencias_servicios->AllowAddDeleteRow && $agencias_servicios_grid->StopRec == 0) {
	$agencias_servicios_grid->StopRec = $agencias_servicios->GridAddRowCount;
}

// Initialize aggregate
$agencias_servicios->RowType = EW_ROWTYPE_AGGREGATEINIT;
$agencias_servicios->ResetAttrs();
$agencias_servicios_grid->RenderRow();
$agencias_servicios_grid->RowCnt = 0;
if ($agencias_servicios->CurrentAction == "gridadd")
	$agencias_servicios_grid->RowIndex = 0;
if ($agencias_servicios->CurrentAction == "gridedit")
	$agencias_servicios_grid->RowIndex = 0;
while ($agencias_servicios_grid->RecCnt < $agencias_servicios_grid->StopRec) {
	$agencias_servicios_grid->RecCnt++;
	if (intval($agencias_servicios_grid->RecCnt) >= intval($agencias_servicios_grid->StartRec)) {
		$agencias_servicios_grid->RowCnt++;
		if ($agencias_servicios->CurrentAction == "gridadd" || $agencias_servicios->CurrentAction == "gridedit" || $agencias_servicios->CurrentAction == "F") {
			$agencias_servicios_grid->RowIndex++;
			$objForm->Index = $agencias_servicios_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$agencias_servicios_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($agencias_servicios->CurrentAction == "gridadd")
				$agencias_servicios_grid->RowAction = "insert";
			else
				$agencias_servicios_grid->RowAction = "";
		}

		// Set up key count
		$agencias_servicios_grid->KeyCount = $agencias_servicios_grid->RowIndex;

		// Init row class and style
		$agencias_servicios->ResetAttrs();
		$agencias_servicios->CssClass = "";
		if ($agencias_servicios->CurrentAction == "gridadd") {
			if ($agencias_servicios->CurrentMode == "copy") {
				$agencias_servicios_grid->LoadRowValues($agencias_servicios_grid->Recordset); // Load row values
				$agencias_servicios_grid->SetRecordKey($agencias_servicios_grid->RowOldKey, $agencias_servicios_grid->Recordset); // Set old record key
			} else {
				$agencias_servicios_grid->LoadDefaultValues(); // Load default values
				$agencias_servicios_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($agencias_servicios->CurrentAction == "gridedit") {
			$agencias_servicios_grid->LoadRowValues($agencias_servicios_grid->Recordset); // Load row values
		}
		$agencias_servicios->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($agencias_servicios->CurrentAction == "gridadd") // Grid add
			$agencias_servicios->RowType = EW_ROWTYPE_ADD; // Render add
		if ($agencias_servicios->CurrentAction == "gridadd" && $agencias_servicios->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$agencias_servicios_grid->RestoreCurrentRowFormValues($agencias_servicios_grid->RowIndex); // Restore form values
		if ($agencias_servicios->CurrentAction == "gridedit") { // Grid edit
			if ($agencias_servicios->EventCancelled) {
				$agencias_servicios_grid->RestoreCurrentRowFormValues($agencias_servicios_grid->RowIndex); // Restore form values
			}
			if ($agencias_servicios_grid->RowAction == "insert")
				$agencias_servicios->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$agencias_servicios->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($agencias_servicios->CurrentAction == "gridedit" && ($agencias_servicios->RowType == EW_ROWTYPE_EDIT || $agencias_servicios->RowType == EW_ROWTYPE_ADD) && $agencias_servicios->EventCancelled) // Update failed
			$agencias_servicios_grid->RestoreCurrentRowFormValues($agencias_servicios_grid->RowIndex); // Restore form values
		if ($agencias_servicios->RowType == EW_ROWTYPE_EDIT) // Edit row
			$agencias_servicios_grid->EditRowCnt++;
		if ($agencias_servicios->CurrentAction == "F") // Confirm row
			$agencias_servicios_grid->RestoreCurrentRowFormValues($agencias_servicios_grid->RowIndex); // Restore form values
		if ($agencias_servicios->RowType == EW_ROWTYPE_ADD || $agencias_servicios->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($agencias_servicios->CurrentAction == "edit") {
				$agencias_servicios->RowAttrs = array();
				$agencias_servicios->CssClass = "ewTableEditRow";
			} else {
				$agencias_servicios->RowAttrs = array();
			}
			if (!empty($agencias_servicios_grid->RowIndex))
				$agencias_servicios->RowAttrs = array_merge($agencias_servicios->RowAttrs, array('data-rowindex'=>$agencias_servicios_grid->RowIndex, 'id'=>'r' . $agencias_servicios_grid->RowIndex . '_agencias_servicios'));
		} else {
			$agencias_servicios->RowAttrs = array();
		}

		// Render row
		$agencias_servicios_grid->RenderRow();

		// Render list options
		$agencias_servicios_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($agencias_servicios_grid->RowAction <> "delete" && $agencias_servicios_grid->RowAction <> "insertdelete" && !($agencias_servicios_grid->RowAction == "insert" && $agencias_servicios->CurrentAction == "F" && $agencias_servicios_grid->EmptyRow())) {
?>
	<tr<?php echo $agencias_servicios->RowAttributes() ?>>
<?php

// Render list options (body, left)
$agencias_servicios_grid->ListOptions->Render("body", "left");
?>
	<?php if ($agencias_servicios->id_servicio->Visible) { // id_servicio ?>
		<td<?php echo $agencias_servicios->id_servicio->CellAttributes() ?>>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio"<?php echo $agencias_servicios->id_servicio->EditAttributes() ?>>
<?php
if (is_array($agencias_servicios->id_servicio->EditValue)) {
	$arwrk = $agencias_servicios->id_servicio->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias_servicios->id_servicio->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias_servicios->id_servicio->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" id="o<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" value="<?php echo ew_HtmlEncode($agencias_servicios->id_servicio->OldValue) ?>">
<?php } ?>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio"<?php echo $agencias_servicios->id_servicio->EditAttributes() ?>>
<?php
if (is_array($agencias_servicios->id_servicio->EditValue)) {
	$arwrk = $agencias_servicios->id_servicio->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias_servicios->id_servicio->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias_servicios->id_servicio->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $agencias_servicios->id_servicio->ViewAttributes() ?>><?php echo $agencias_servicios->id_servicio->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" id="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" value="<?php echo ew_HtmlEncode($agencias_servicios->id_servicio->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" id="o<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" value="<?php echo ew_HtmlEncode($agencias_servicios->id_servicio->OldValue) ?>">
<?php } ?>
<a name="<?php echo $agencias_servicios_grid->PageObjName . "_row_" . $agencias_servicios_grid->RowCnt ?>" id="<?php echo $agencias_servicios_grid->PageObjName . "_row_" . $agencias_servicios_grid->RowCnt ?>"></a>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $agencias_servicios_grid->RowIndex ?>_id_agencias_servicios" id="o<?php echo $agencias_servicios_grid->RowIndex ?>_id_agencias_servicios" value="<?php echo ew_HtmlEncode($agencias_servicios->id_agencias_servicios->OldValue) ?>">
<?php } ?>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_agencias_servicios" id="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_agencias_servicios" value="<?php echo ew_HtmlEncode($agencias_servicios->id_agencias_servicios->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($agencias_servicios->estatus->Visible) { // estatus ?>
		<td<?php echo $agencias_servicios->estatus->CellAttributes() ?>>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus"<?php echo $agencias_servicios->estatus->EditAttributes() ?>>
<?php
if (is_array($agencias_servicios->estatus->EditValue)) {
	$arwrk = $agencias_servicios->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias_servicios->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias_servicios->estatus->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" id="o<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias_servicios->estatus->OldValue) ?>">
<?php } ?>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus"<?php echo $agencias_servicios->estatus->EditAttributes() ?>>
<?php
if (is_array($agencias_servicios->estatus->EditValue)) {
	$arwrk = $agencias_servicios->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias_servicios->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias_servicios->estatus->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $agencias_servicios->estatus->ViewAttributes() ?>><?php echo $agencias_servicios->estatus->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" id="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias_servicios->estatus->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" id="o<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias_servicios->estatus->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agencias_servicios_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($agencias_servicios->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($agencias_servicios->CurrentAction <> "gridadd" || $agencias_servicios->CurrentMode == "copy")
		if (!$agencias_servicios_grid->Recordset->EOF) $agencias_servicios_grid->Recordset->MoveNext();
}
?>
<?php
	if ($agencias_servicios->CurrentMode == "add" || $agencias_servicios->CurrentMode == "copy" || $agencias_servicios->CurrentMode == "edit") {
		$agencias_servicios_grid->RowIndex = '$rowindex$';
		$agencias_servicios_grid->LoadDefaultValues();

		// Set row properties
		$agencias_servicios->ResetAttrs();
		$agencias_servicios->RowAttrs = array();
		if (!empty($agencias_servicios_grid->RowIndex))
			$agencias_servicios->RowAttrs = array_merge($agencias_servicios->RowAttrs, array('data-rowindex'=>$agencias_servicios_grid->RowIndex, 'id'=>'r' . $agencias_servicios_grid->RowIndex . '_agencias_servicios'));
		$agencias_servicios->RowType = EW_ROWTYPE_ADD;

		// Render row
		$agencias_servicios_grid->RenderRow();

		// Render list options
		$agencias_servicios_grid->RenderListOptions();

		// Add id and class to the template row
		$agencias_servicios->RowAttrs["id"] = "r0_agencias_servicios";
		ew_AppendClass($agencias_servicios->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $agencias_servicios->RowAttributes() ?>>
<?php

// Render list options (body, left)
$agencias_servicios_grid->ListOptions->Render("body", "left");
?>
	<?php if ($agencias_servicios->id_servicio->Visible) { // id_servicio ?>
		<td>
<?php if ($agencias_servicios->CurrentAction <> "F") { ?>
<select id="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio"<?php echo $agencias_servicios->id_servicio->EditAttributes() ?>>
<?php
if (is_array($agencias_servicios->id_servicio->EditValue)) {
	$arwrk = $agencias_servicios->id_servicio->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias_servicios->id_servicio->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias_servicios->id_servicio->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $agencias_servicios->id_servicio->ViewAttributes() ?>><?php echo $agencias_servicios->id_servicio->ViewValue ?></div>
<input type="hidden" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" id="x<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" value="<?php echo ew_HtmlEncode($agencias_servicios->id_servicio->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" id="o<?php echo $agencias_servicios_grid->RowIndex ?>_id_servicio" value="<?php echo ew_HtmlEncode($agencias_servicios->id_servicio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agencias_servicios->estatus->Visible) { // estatus ?>
		<td>
<?php if ($agencias_servicios->CurrentAction <> "F") { ?>
<select id="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus"<?php echo $agencias_servicios->estatus->EditAttributes() ?>>
<?php
if (is_array($agencias_servicios->estatus->EditValue)) {
	$arwrk = $agencias_servicios->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias_servicios->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias_servicios->estatus->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $agencias_servicios->estatus->ViewAttributes() ?>><?php echo $agencias_servicios->estatus->ViewValue ?></div>
<input type="hidden" name="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" id="x<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias_servicios->estatus->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" id="o<?php echo $agencias_servicios_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias_servicios->estatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agencias_servicios_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($agencias_servicios->CurrentMode == "add" || $agencias_servicios->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $agencias_servicios_grid->KeyCount ?>">
<?php echo $agencias_servicios_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($agencias_servicios->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $agencias_servicios_grid->KeyCount ?>">
<?php echo $agencias_servicios_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="agencias_servicios_grid">
</div>
<?php

// Close recordset
if ($agencias_servicios_grid->Recordset)
	$agencias_servicios_grid->Recordset->Close();
?>
<?php if (($agencias_servicios->CurrentMode == "add" || $agencias_servicios->CurrentMode == "copy" || $agencias_servicios->CurrentMode == "edit") && $agencias_servicios->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($agencias_servicios->AllowAddDeleteRow) { ?>
<?php if ($Security->CanAdd()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($agencias_servicios->Export == "" && $agencias_servicios->CurrentAction == "") { ?>
<?php } ?>
<?php
$agencias_servicios_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$agencias_servicios_grid->Page_Terminate();
$Page =& $MasterPage;
?>
