<?php

// Create page object
$agencias_grid = new cagencias_grid();
$MasterPage =& $Page;
$Page =& $agencias_grid;

// Page init
$agencias_grid->Page_Init();

// Page main
$agencias_grid->Page_Main();
?>
<?php if ($agencias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var agencias_grid = new ew_Page("agencias_grid");

// page properties
agencias_grid.PageID = "grid"; // page ID
agencias_grid.FormID = "fagenciasgrid"; // form ID
var EW_PAGE_ID = agencias_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
agencias_grid.ValidateForm = function(fobj) {
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
agencias_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "nombre", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_ciudad", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estatus", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
agencias_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
agencias_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
agencias_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($agencias->CurrentAction == "gridadd") {
	if ($agencias->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$agencias_grid->TotalRecs = $agencias->SelectRecordCount();
			$agencias_grid->Recordset = $agencias_grid->LoadRecordset($agencias_grid->StartRec-1, $agencias_grid->DisplayRecs);
		} else {
			if ($agencias_grid->Recordset = $agencias_grid->LoadRecordset())
				$agencias_grid->TotalRecs = $agencias_grid->Recordset->RecordCount();
		}
		$agencias_grid->StartRec = 1;
		$agencias_grid->DisplayRecs = $agencias_grid->TotalRecs;
	} else {
		$agencias->CurrentFilter = "0=1";
		$agencias_grid->StartRec = 1;
		$agencias_grid->DisplayRecs = $agencias->GridAddRowCount;
	}
	$agencias_grid->TotalRecs = $agencias_grid->DisplayRecs;
	$agencias_grid->StopRec = $agencias_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$agencias_grid->TotalRecs = $agencias->SelectRecordCount();
	} else {
		if ($agencias_grid->Recordset = $agencias_grid->LoadRecordset())
			$agencias_grid->TotalRecs = $agencias_grid->Recordset->RecordCount();
	}
	$agencias_grid->StartRec = 1;
	$agencias_grid->DisplayRecs = $agencias_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$agencias_grid->Recordset = $agencias_grid->LoadRecordset($agencias_grid->StartRec-1, $agencias_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($agencias->CurrentMode == "add" || $agencias->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($agencias->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $agencias->TableCaption() ?></p>
</p>
<?php $agencias_grid->ShowPageHeader(); ?>
<?php
$agencias_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_agencias" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $agencias->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$agencias_grid->RenderListOptions();

// Render list options (header, left)
$agencias_grid->ListOptions->Render("header", "left");
?>
<?php if ($agencias->nombre->Visible) { // nombre ?>
	<?php if ($agencias->SortUrl($agencias->nombre) == "") { ?>
		<td><?php echo $agencias->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias->nombre->FldCaption() ?></td><td style="width: 10px;"><?php if ($agencias->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($agencias->id_ciudad->Visible) { // id_ciudad ?>
	<?php if ($agencias->SortUrl($agencias->id_ciudad) == "") { ?>
		<td><?php echo $agencias->id_ciudad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias->id_ciudad->FldCaption() ?></td><td style="width: 10px;"><?php if ($agencias->id_ciudad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias->id_ciudad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($agencias->estatus->Visible) { // estatus ?>
	<?php if ($agencias->SortUrl($agencias->estatus) == "") { ?>
		<td><?php echo $agencias->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($agencias->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$agencias_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$agencias_grid->StartRec = 1;
$agencias_grid->StopRec = $agencias_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($agencias->CurrentAction == "gridadd" || $agencias->CurrentAction == "gridedit" || $agencias->CurrentAction == "F")) {
		$agencias_grid->KeyCount = $objForm->GetValue("key_count");
		$agencias_grid->StopRec = $agencias_grid->KeyCount;
	}
}
$agencias_grid->RecCnt = $agencias_grid->StartRec - 1;
if ($agencias_grid->Recordset && !$agencias_grid->Recordset->EOF) {
	$agencias_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $agencias_grid->StartRec > 1)
		$agencias_grid->Recordset->Move($agencias_grid->StartRec - 1);
} elseif (!$agencias->AllowAddDeleteRow && $agencias_grid->StopRec == 0) {
	$agencias_grid->StopRec = $agencias->GridAddRowCount;
}

// Initialize aggregate
$agencias->RowType = EW_ROWTYPE_AGGREGATEINIT;
$agencias->ResetAttrs();
$agencias_grid->RenderRow();
$agencias_grid->RowCnt = 0;
if ($agencias->CurrentAction == "gridadd")
	$agencias_grid->RowIndex = 0;
if ($agencias->CurrentAction == "gridedit")
	$agencias_grid->RowIndex = 0;
while ($agencias_grid->RecCnt < $agencias_grid->StopRec) {
	$agencias_grid->RecCnt++;
	if (intval($agencias_grid->RecCnt) >= intval($agencias_grid->StartRec)) {
		$agencias_grid->RowCnt++;
		if ($agencias->CurrentAction == "gridadd" || $agencias->CurrentAction == "gridedit" || $agencias->CurrentAction == "F") {
			$agencias_grid->RowIndex++;
			$objForm->Index = $agencias_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$agencias_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($agencias->CurrentAction == "gridadd")
				$agencias_grid->RowAction = "insert";
			else
				$agencias_grid->RowAction = "";
		}

		// Set up key count
		$agencias_grid->KeyCount = $agencias_grid->RowIndex;

		// Init row class and style
		$agencias->ResetAttrs();
		$agencias->CssClass = "";
		if ($agencias->CurrentAction == "gridadd") {
			if ($agencias->CurrentMode == "copy") {
				$agencias_grid->LoadRowValues($agencias_grid->Recordset); // Load row values
				$agencias_grid->SetRecordKey($agencias_grid->RowOldKey, $agencias_grid->Recordset); // Set old record key
			} else {
				$agencias_grid->LoadDefaultValues(); // Load default values
				$agencias_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($agencias->CurrentAction == "gridedit") {
			$agencias_grid->LoadRowValues($agencias_grid->Recordset); // Load row values
		}
		$agencias->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($agencias->CurrentAction == "gridadd") // Grid add
			$agencias->RowType = EW_ROWTYPE_ADD; // Render add
		if ($agencias->CurrentAction == "gridadd" && $agencias->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$agencias_grid->RestoreCurrentRowFormValues($agencias_grid->RowIndex); // Restore form values
		if ($agencias->CurrentAction == "gridedit") { // Grid edit
			if ($agencias->EventCancelled) {
				$agencias_grid->RestoreCurrentRowFormValues($agencias_grid->RowIndex); // Restore form values
			}
			if ($agencias_grid->RowAction == "insert")
				$agencias->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$agencias->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($agencias->CurrentAction == "gridedit" && ($agencias->RowType == EW_ROWTYPE_EDIT || $agencias->RowType == EW_ROWTYPE_ADD) && $agencias->EventCancelled) // Update failed
			$agencias_grid->RestoreCurrentRowFormValues($agencias_grid->RowIndex); // Restore form values
		if ($agencias->RowType == EW_ROWTYPE_EDIT) // Edit row
			$agencias_grid->EditRowCnt++;
		if ($agencias->CurrentAction == "F") // Confirm row
			$agencias_grid->RestoreCurrentRowFormValues($agencias_grid->RowIndex); // Restore form values
		if ($agencias->RowType == EW_ROWTYPE_ADD || $agencias->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($agencias->CurrentAction == "edit") {
				$agencias->RowAttrs = array();
				$agencias->CssClass = "ewTableEditRow";
			} else {
				$agencias->RowAttrs = array();
			}
			if (!empty($agencias_grid->RowIndex))
				$agencias->RowAttrs = array_merge($agencias->RowAttrs, array('data-rowindex'=>$agencias_grid->RowIndex, 'id'=>'r' . $agencias_grid->RowIndex . '_agencias'));
		} else {
			$agencias->RowAttrs = array();
		}

		// Render row
		$agencias_grid->RenderRow();

		// Render list options
		$agencias_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($agencias_grid->RowAction <> "delete" && $agencias_grid->RowAction <> "insertdelete" && !($agencias_grid->RowAction == "insert" && $agencias->CurrentAction == "F" && $agencias_grid->EmptyRow())) {
?>
	<tr<?php echo $agencias->RowAttributes() ?>>
<?php

// Render list options (body, left)
$agencias_grid->ListOptions->Render("body", "left");
?>
	<?php if ($agencias->nombre->Visible) { // nombre ?>
		<td<?php echo $agencias->nombre->CellAttributes() ?>>
<?php if ($agencias->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $agencias_grid->RowIndex ?>_nombre" id="x<?php echo $agencias_grid->RowIndex ?>_nombre" size="30" maxlength="45" value="<?php echo $agencias->nombre->EditValue ?>"<?php echo $agencias->nombre->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_nombre" id="o<?php echo $agencias_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($agencias->nombre->OldValue) ?>">
<?php } ?>
<?php if ($agencias->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $agencias_grid->RowIndex ?>_nombre" id="x<?php echo $agencias_grid->RowIndex ?>_nombre" size="30" maxlength="45" value="<?php echo $agencias->nombre->EditValue ?>"<?php echo $agencias->nombre->EditAttributes() ?>>
<?php } ?>
<?php if ($agencias->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $agencias->nombre->ViewAttributes() ?>><?php echo $agencias->nombre->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $agencias_grid->RowIndex ?>_nombre" id="x<?php echo $agencias_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($agencias->nombre->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_nombre" id="o<?php echo $agencias_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($agencias->nombre->OldValue) ?>">
<?php } ?>
<a name="<?php echo $agencias_grid->PageObjName . "_row_" . $agencias_grid->RowCnt ?>" id="<?php echo $agencias_grid->PageObjName . "_row_" . $agencias_grid->RowCnt ?>"></a>
<?php if ($agencias->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_id_agencias" id="o<?php echo $agencias_grid->RowIndex ?>_id_agencias" value="<?php echo ew_HtmlEncode($agencias->id_agencias->OldValue) ?>">
<?php } ?>
<?php if ($agencias->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $agencias_grid->RowIndex ?>_id_agencias" id="x<?php echo $agencias_grid->RowIndex ?>_id_agencias" value="<?php echo ew_HtmlEncode($agencias->id_agencias->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($agencias->id_ciudad->Visible) { // id_ciudad ?>
		<td<?php echo $agencias->id_ciudad->CellAttributes() ?>>
<?php if ($agencias->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad" name="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad"<?php echo $agencias->id_ciudad->EditAttributes() ?>>
<?php
if (is_array($agencias->id_ciudad->EditValue)) {
	$arwrk = $agencias->id_ciudad->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias->id_ciudad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias->id_ciudad->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_id_ciudad" id="o<?php echo $agencias_grid->RowIndex ?>_id_ciudad" value="<?php echo ew_HtmlEncode($agencias->id_ciudad->OldValue) ?>">
<?php } ?>
<?php if ($agencias->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad" name="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad"<?php echo $agencias->id_ciudad->EditAttributes() ?>>
<?php
if (is_array($agencias->id_ciudad->EditValue)) {
	$arwrk = $agencias->id_ciudad->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias->id_ciudad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias->id_ciudad->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($agencias->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $agencias->id_ciudad->ViewAttributes() ?>><?php echo $agencias->id_ciudad->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad" id="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad" value="<?php echo ew_HtmlEncode($agencias->id_ciudad->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_id_ciudad" id="o<?php echo $agencias_grid->RowIndex ?>_id_ciudad" value="<?php echo ew_HtmlEncode($agencias->id_ciudad->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($agencias->estatus->Visible) { // estatus ?>
		<td<?php echo $agencias->estatus->CellAttributes() ?>>
<?php if ($agencias->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $agencias_grid->RowIndex ?>_estatus" name="x<?php echo $agencias_grid->RowIndex ?>_estatus"<?php echo $agencias->estatus->EditAttributes() ?>>
<?php
if (is_array($agencias->estatus->EditValue)) {
	$arwrk = $agencias->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias->estatus->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_estatus" id="o<?php echo $agencias_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias->estatus->OldValue) ?>">
<?php } ?>
<?php if ($agencias->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $agencias_grid->RowIndex ?>_estatus" name="x<?php echo $agencias_grid->RowIndex ?>_estatus"<?php echo $agencias->estatus->EditAttributes() ?>>
<?php
if (is_array($agencias->estatus->EditValue)) {
	$arwrk = $agencias->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias->estatus->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($agencias->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $agencias->estatus->ViewAttributes() ?>><?php echo $agencias->estatus->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $agencias_grid->RowIndex ?>_estatus" id="x<?php echo $agencias_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias->estatus->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_estatus" id="o<?php echo $agencias_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias->estatus->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agencias_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($agencias->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($agencias->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($agencias->CurrentAction <> "gridadd" || $agencias->CurrentMode == "copy")
		if (!$agencias_grid->Recordset->EOF) $agencias_grid->Recordset->MoveNext();
}
?>
<?php
	if ($agencias->CurrentMode == "add" || $agencias->CurrentMode == "copy" || $agencias->CurrentMode == "edit") {
		$agencias_grid->RowIndex = '$rowindex$';
		$agencias_grid->LoadDefaultValues();

		// Set row properties
		$agencias->ResetAttrs();
		$agencias->RowAttrs = array();
		if (!empty($agencias_grid->RowIndex))
			$agencias->RowAttrs = array_merge($agencias->RowAttrs, array('data-rowindex'=>$agencias_grid->RowIndex, 'id'=>'r' . $agencias_grid->RowIndex . '_agencias'));
		$agencias->RowType = EW_ROWTYPE_ADD;

		// Render row
		$agencias_grid->RenderRow();

		// Render list options
		$agencias_grid->RenderListOptions();

		// Add id and class to the template row
		$agencias->RowAttrs["id"] = "r0_agencias";
		ew_AppendClass($agencias->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $agencias->RowAttributes() ?>>
<?php

// Render list options (body, left)
$agencias_grid->ListOptions->Render("body", "left");
?>
	<?php if ($agencias->nombre->Visible) { // nombre ?>
		<td>
<?php if ($agencias->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $agencias_grid->RowIndex ?>_nombre" id="x<?php echo $agencias_grid->RowIndex ?>_nombre" size="30" maxlength="45" value="<?php echo $agencias->nombre->EditValue ?>"<?php echo $agencias->nombre->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $agencias->nombre->ViewAttributes() ?>><?php echo $agencias->nombre->ViewValue ?></div>
<input type="hidden" name="x<?php echo $agencias_grid->RowIndex ?>_nombre" id="x<?php echo $agencias_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($agencias->nombre->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_nombre" id="o<?php echo $agencias_grid->RowIndex ?>_nombre" value="<?php echo ew_HtmlEncode($agencias->nombre->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agencias->id_ciudad->Visible) { // id_ciudad ?>
		<td>
<?php if ($agencias->CurrentAction <> "F") { ?>
<select id="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad" name="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad"<?php echo $agencias->id_ciudad->EditAttributes() ?>>
<?php
if (is_array($agencias->id_ciudad->EditValue)) {
	$arwrk = $agencias->id_ciudad->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias->id_ciudad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias->id_ciudad->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $agencias->id_ciudad->ViewAttributes() ?>><?php echo $agencias->id_ciudad->ViewValue ?></div>
<input type="hidden" name="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad" id="x<?php echo $agencias_grid->RowIndex ?>_id_ciudad" value="<?php echo ew_HtmlEncode($agencias->id_ciudad->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_id_ciudad" id="o<?php echo $agencias_grid->RowIndex ?>_id_ciudad" value="<?php echo ew_HtmlEncode($agencias->id_ciudad->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agencias->estatus->Visible) { // estatus ?>
		<td>
<?php if ($agencias->CurrentAction <> "F") { ?>
<select id="x<?php echo $agencias_grid->RowIndex ?>_estatus" name="x<?php echo $agencias_grid->RowIndex ?>_estatus"<?php echo $agencias->estatus->EditAttributes() ?>>
<?php
if (is_array($agencias->estatus->EditValue)) {
	$arwrk = $agencias->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $agencias->estatus->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $agencias->estatus->ViewAttributes() ?>><?php echo $agencias->estatus->ViewValue ?></div>
<input type="hidden" name="x<?php echo $agencias_grid->RowIndex ?>_estatus" id="x<?php echo $agencias_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias->estatus->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $agencias_grid->RowIndex ?>_estatus" id="o<?php echo $agencias_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($agencias->estatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agencias_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($agencias->CurrentMode == "add" || $agencias->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $agencias_grid->KeyCount ?>">
<?php echo $agencias_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($agencias->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $agencias_grid->KeyCount ?>">
<?php echo $agencias_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="agencias_grid">
</div>
<?php

// Close recordset
if ($agencias_grid->Recordset)
	$agencias_grid->Recordset->Close();
?>
<?php if (($agencias->CurrentMode == "add" || $agencias->CurrentMode == "copy" || $agencias->CurrentMode == "edit") && $agencias->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($agencias->AllowAddDeleteRow) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($agencias->Export == "" && $agencias->CurrentAction == "") { ?>
<?php } ?>
<?php
$agencias_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$agencias_grid->Page_Terminate();
$Page =& $MasterPage;
?>
