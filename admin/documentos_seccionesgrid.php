<?php include_once "usuariosinfo.php" ?>
<?php

// Create page object
$documentos_secciones_grid = new cdocumentos_secciones_grid();
$MasterPage =& $Page;
$Page =& $documentos_secciones_grid;

// Page init
$documentos_secciones_grid->Page_Init();

// Page main
$documentos_secciones_grid->Page_Main();
?>
<?php if ($documentos_secciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_secciones_grid = new ew_Page("documentos_secciones_grid");

// page properties
documentos_secciones_grid.PageID = "grid"; // page ID
documentos_secciones_grid.FormID = "fdocumentos_seccionesgrid"; // form ID
var EW_PAGE_ID = documentos_secciones_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
documentos_secciones_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_id_documentos"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documentos_secciones->id_documentos->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_grupo_sec"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documentos_secciones->id_grupo_sec->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fecha_inicio"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documentos_secciones->fecha_inicio->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha_fin"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documentos_secciones->fecha_fin->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documentos_secciones->estatus->FldCaption()) ?>");

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
documentos_secciones_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "id_documentos", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_grupo_sec", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_inicio", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_fin", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estatus", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
documentos_secciones_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_secciones_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_secciones_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<?php } ?>
<?php
if ($documentos_secciones->CurrentAction == "gridadd") {
	if ($documentos_secciones->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$documentos_secciones_grid->TotalRecs = $documentos_secciones->SelectRecordCount();
			$documentos_secciones_grid->Recordset = $documentos_secciones_grid->LoadRecordset($documentos_secciones_grid->StartRec-1, $documentos_secciones_grid->DisplayRecs);
		} else {
			if ($documentos_secciones_grid->Recordset = $documentos_secciones_grid->LoadRecordset())
				$documentos_secciones_grid->TotalRecs = $documentos_secciones_grid->Recordset->RecordCount();
		}
		$documentos_secciones_grid->StartRec = 1;
		$documentos_secciones_grid->DisplayRecs = $documentos_secciones_grid->TotalRecs;
	} else {
		$documentos_secciones->CurrentFilter = "0=1";
		$documentos_secciones_grid->StartRec = 1;
		$documentos_secciones_grid->DisplayRecs = $documentos_secciones->GridAddRowCount;
	}
	$documentos_secciones_grid->TotalRecs = $documentos_secciones_grid->DisplayRecs;
	$documentos_secciones_grid->StopRec = $documentos_secciones_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$documentos_secciones_grid->TotalRecs = $documentos_secciones->SelectRecordCount();
	} else {
		if ($documentos_secciones_grid->Recordset = $documentos_secciones_grid->LoadRecordset())
			$documentos_secciones_grid->TotalRecs = $documentos_secciones_grid->Recordset->RecordCount();
	}
	$documentos_secciones_grid->StartRec = 1;
	$documentos_secciones_grid->DisplayRecs = $documentos_secciones_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$documentos_secciones_grid->Recordset = $documentos_secciones_grid->LoadRecordset($documentos_secciones_grid->StartRec-1, $documentos_secciones_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($documentos_secciones->CurrentMode == "add" || $documentos_secciones->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($documentos_secciones->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos_secciones->TableCaption() ?></p>
</p>
<?php $documentos_secciones_grid->ShowPageHeader(); ?>
<?php
$documentos_secciones_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_documentos_secciones" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $documentos_secciones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$documentos_secciones_grid->RenderListOptions();

// Render list options (header, left)
$documentos_secciones_grid->ListOptions->Render("header", "left");
?>
<?php if ($documentos_secciones->id_documentos->Visible) { // id_documentos ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->id_documentos) == "") { ?>
		<td><?php echo $documentos_secciones->id_documentos->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->id_documentos->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->id_documentos->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->id_documentos->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->id_grupo_sec->Visible) { // id_grupo_sec ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->id_grupo_sec) == "") { ?>
		<td><?php echo $documentos_secciones->id_grupo_sec->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->id_grupo_sec->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->id_grupo_sec->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->id_grupo_sec->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->fecha_inicio->Visible) { // fecha_inicio ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->fecha_inicio) == "") { ?>
		<td><?php echo $documentos_secciones->fecha_inicio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->fecha_inicio->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->fecha_inicio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->fecha_inicio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->fecha_fin->Visible) { // fecha_fin ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->fecha_fin) == "") { ?>
		<td><?php echo $documentos_secciones->fecha_fin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->fecha_fin->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->fecha_fin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->fecha_fin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->fecha->Visible) { // fecha ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->fecha) == "") { ?>
		<td><?php echo $documentos_secciones->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->estatus->Visible) { // estatus ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->estatus) == "") { ?>
		<td><?php echo $documentos_secciones->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$documentos_secciones_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$documentos_secciones_grid->StartRec = 1;
$documentos_secciones_grid->StopRec = $documentos_secciones_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($documentos_secciones->CurrentAction == "gridadd" || $documentos_secciones->CurrentAction == "gridedit" || $documentos_secciones->CurrentAction == "F")) {
		$documentos_secciones_grid->KeyCount = $objForm->GetValue("key_count");
		$documentos_secciones_grid->StopRec = $documentos_secciones_grid->KeyCount;
	}
}
$documentos_secciones_grid->RecCnt = $documentos_secciones_grid->StartRec - 1;
if ($documentos_secciones_grid->Recordset && !$documentos_secciones_grid->Recordset->EOF) {
	$documentos_secciones_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $documentos_secciones_grid->StartRec > 1)
		$documentos_secciones_grid->Recordset->Move($documentos_secciones_grid->StartRec - 1);
} elseif (!$documentos_secciones->AllowAddDeleteRow && $documentos_secciones_grid->StopRec == 0) {
	$documentos_secciones_grid->StopRec = $documentos_secciones->GridAddRowCount;
}

// Initialize aggregate
$documentos_secciones->RowType = EW_ROWTYPE_AGGREGATEINIT;
$documentos_secciones->ResetAttrs();
$documentos_secciones_grid->RenderRow();
$documentos_secciones_grid->RowCnt = 0;
if ($documentos_secciones->CurrentAction == "gridadd")
	$documentos_secciones_grid->RowIndex = 0;
if ($documentos_secciones->CurrentAction == "gridedit")
	$documentos_secciones_grid->RowIndex = 0;
while ($documentos_secciones_grid->RecCnt < $documentos_secciones_grid->StopRec) {
	$documentos_secciones_grid->RecCnt++;
	if (intval($documentos_secciones_grid->RecCnt) >= intval($documentos_secciones_grid->StartRec)) {
		$documentos_secciones_grid->RowCnt++;
		if ($documentos_secciones->CurrentAction == "gridadd" || $documentos_secciones->CurrentAction == "gridedit" || $documentos_secciones->CurrentAction == "F") {
			$documentos_secciones_grid->RowIndex++;
			$objForm->Index = $documentos_secciones_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$documentos_secciones_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($documentos_secciones->CurrentAction == "gridadd")
				$documentos_secciones_grid->RowAction = "insert";
			else
				$documentos_secciones_grid->RowAction = "";
		}

		// Set up key count
		$documentos_secciones_grid->KeyCount = $documentos_secciones_grid->RowIndex;

		// Init row class and style
		$documentos_secciones->ResetAttrs();
		$documentos_secciones->CssClass = "";
		if ($documentos_secciones->CurrentAction == "gridadd") {
			if ($documentos_secciones->CurrentMode == "copy") {
				$documentos_secciones_grid->LoadRowValues($documentos_secciones_grid->Recordset); // Load row values
				$documentos_secciones_grid->SetRecordKey($documentos_secciones_grid->RowOldKey, $documentos_secciones_grid->Recordset); // Set old record key
			} else {
				$documentos_secciones_grid->LoadDefaultValues(); // Load default values
				$documentos_secciones_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($documentos_secciones->CurrentAction == "gridedit") {
			$documentos_secciones_grid->LoadRowValues($documentos_secciones_grid->Recordset); // Load row values
		}
		$documentos_secciones->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($documentos_secciones->CurrentAction == "gridadd") // Grid add
			$documentos_secciones->RowType = EW_ROWTYPE_ADD; // Render add
		if ($documentos_secciones->CurrentAction == "gridadd" && $documentos_secciones->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$documentos_secciones_grid->RestoreCurrentRowFormValues($documentos_secciones_grid->RowIndex); // Restore form values
		if ($documentos_secciones->CurrentAction == "gridedit") { // Grid edit
			if ($documentos_secciones->EventCancelled) {
				$documentos_secciones_grid->RestoreCurrentRowFormValues($documentos_secciones_grid->RowIndex); // Restore form values
			}
			if ($documentos_secciones_grid->RowAction == "insert")
				$documentos_secciones->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$documentos_secciones->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($documentos_secciones->CurrentAction == "gridedit" && ($documentos_secciones->RowType == EW_ROWTYPE_EDIT || $documentos_secciones->RowType == EW_ROWTYPE_ADD) && $documentos_secciones->EventCancelled) // Update failed
			$documentos_secciones_grid->RestoreCurrentRowFormValues($documentos_secciones_grid->RowIndex); // Restore form values
		if ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) // Edit row
			$documentos_secciones_grid->EditRowCnt++;
		if ($documentos_secciones->CurrentAction == "F") // Confirm row
			$documentos_secciones_grid->RestoreCurrentRowFormValues($documentos_secciones_grid->RowIndex); // Restore form values
		if ($documentos_secciones->RowType == EW_ROWTYPE_ADD || $documentos_secciones->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($documentos_secciones->CurrentAction == "edit") {
				$documentos_secciones->RowAttrs = array();
				$documentos_secciones->CssClass = "ewTableEditRow";
			} else {
				$documentos_secciones->RowAttrs = array();
			}
			if (!empty($documentos_secciones_grid->RowIndex))
				$documentos_secciones->RowAttrs = array_merge($documentos_secciones->RowAttrs, array('data-rowindex'=>$documentos_secciones_grid->RowIndex, 'id'=>'r' . $documentos_secciones_grid->RowIndex . '_documentos_secciones'));
		} else {
			$documentos_secciones->RowAttrs = array();
		}

		// Render row
		$documentos_secciones_grid->RenderRow();

		// Render list options
		$documentos_secciones_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($documentos_secciones_grid->RowAction <> "delete" && $documentos_secciones_grid->RowAction <> "insertdelete" && !($documentos_secciones_grid->RowAction == "insert" && $documentos_secciones->CurrentAction == "F" && $documentos_secciones_grid->EmptyRow())) {
?>
	<tr<?php echo $documentos_secciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$documentos_secciones_grid->ListOptions->Render("body", "left");
?>
	<?php if ($documentos_secciones->id_documentos->Visible) { // id_documentos ?>
		<td<?php echo $documentos_secciones->id_documentos->CellAttributes() ?>>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($documentos_secciones->id_documentos->getSessionValue() <> "") { ?>
<div<?php echo $documentos_secciones->id_documentos->ViewAttributes() ?>><?php echo $documentos_secciones->id_documentos->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos"<?php echo $documentos_secciones->id_documentos->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->id_documentos->EditValue)) {
	$arwrk = $documentos_secciones->id_documentos->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->id_documentos->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $documentos_secciones->id_documentos->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos->OldValue) ?>">
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($documentos_secciones->id_documentos->getSessionValue() <> "") { ?>
<div<?php echo $documentos_secciones->id_documentos->ViewAttributes() ?>><?php echo $documentos_secciones->id_documentos->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos"<?php echo $documentos_secciones->id_documentos->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->id_documentos->EditValue)) {
	$arwrk = $documentos_secciones->id_documentos->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->id_documentos->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $documentos_secciones->id_documentos->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $documentos_secciones->id_documentos->ViewAttributes() ?>><?php echo $documentos_secciones->id_documentos->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos->OldValue) ?>">
<?php } ?>
<a name="<?php echo $documentos_secciones_grid->PageObjName . "_row_" . $documentos_secciones_grid->RowCnt ?>" id="<?php echo $documentos_secciones_grid->PageObjName . "_row_" . $documentos_secciones_grid->RowCnt ?>"></a>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos_secciones" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos_secciones" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos_secciones->OldValue) ?>">
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos_secciones" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos_secciones" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos_secciones->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($documentos_secciones->id_grupo_sec->Visible) { // id_grupo_sec ?>
		<td<?php echo $documentos_secciones->id_grupo_sec->CellAttributes() ?>>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec"<?php echo $documentos_secciones->id_grupo_sec->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->id_grupo_sec->EditValue)) {
	$arwrk = $documentos_secciones->id_grupo_sec->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->id_grupo_sec->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $documentos_secciones->id_grupo_sec->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" value="<?php echo ew_HtmlEncode($documentos_secciones->id_grupo_sec->OldValue) ?>">
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec"<?php echo $documentos_secciones->id_grupo_sec->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->id_grupo_sec->EditValue)) {
	$arwrk = $documentos_secciones->id_grupo_sec->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->id_grupo_sec->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $documentos_secciones->id_grupo_sec->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $documentos_secciones->id_grupo_sec->ViewAttributes() ?>><?php echo $documentos_secciones->id_grupo_sec->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" value="<?php echo ew_HtmlEncode($documentos_secciones->id_grupo_sec->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" value="<?php echo ew_HtmlEncode($documentos_secciones->id_grupo_sec->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($documentos_secciones->fecha_inicio->Visible) { // fecha_inicio ?>
		<td<?php echo $documentos_secciones->fecha_inicio->CellAttributes() ?>>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" size="12" value="<?php echo $documentos_secciones->fecha_inicio->EditValue ?>"<?php echo $documentos_secciones->fecha_inicio->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" name="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" // button id
});
</script>
<input type="hidden" name="fo<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" id="fo<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha_inicio->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_inicio->OldValue) ?>">
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" size="12" value="<?php echo $documentos_secciones->fecha_inicio->EditValue ?>"<?php echo $documentos_secciones->fecha_inicio->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" name="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" // button id
});
</script>
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $documentos_secciones->fecha_inicio->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_inicio->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_inicio->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_inicio->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($documentos_secciones->fecha_fin->Visible) { // fecha_fin ?>
		<td<?php echo $documentos_secciones->fecha_fin->CellAttributes() ?>>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" size="12" value="<?php echo $documentos_secciones->fecha_fin->EditValue ?>"<?php echo $documentos_secciones->fecha_fin->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" name="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" // button id
});
</script>
<input type="hidden" name="fo<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" id="fo<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha_fin->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_fin->OldValue) ?>">
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" size="12" value="<?php echo $documentos_secciones->fecha_fin->EditValue ?>"<?php echo $documentos_secciones->fecha_fin->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" name="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" // button id
});
</script>
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $documentos_secciones->fecha_fin->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_fin->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_fin->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_fin->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($documentos_secciones->fecha->Visible) { // fecha ?>
		<td<?php echo $documentos_secciones->fecha->CellAttributes() ?>>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" size="12" value="<?php echo $documentos_secciones->fecha->EditValue ?>"<?php echo $documentos_secciones->fecha->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" name="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" // button id
});
</script>
<input type="hidden" name="fo<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" id="fo<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha->OldValue) ?>">
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $documentos_secciones->fecha->ViewAttributes() ?>><?php echo $documentos_secciones->fecha->EditValue ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha->CurrentValue) ?>">
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $documentos_secciones->fecha->ViewAttributes() ?>><?php echo $documentos_secciones->fecha->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($documentos_secciones->estatus->Visible) { // estatus ?>
		<td<?php echo $documentos_secciones->estatus->CellAttributes() ?>>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus"<?php echo $documentos_secciones->estatus->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->estatus->EditValue)) {
	$arwrk = $documentos_secciones->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $documentos_secciones->estatus->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($documentos_secciones->estatus->OldValue) ?>">
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus"<?php echo $documentos_secciones->estatus->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->estatus->EditValue)) {
	$arwrk = $documentos_secciones->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $documentos_secciones->estatus->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $documentos_secciones->estatus->ViewAttributes() ?>><?php echo $documentos_secciones->estatus->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($documentos_secciones->estatus->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($documentos_secciones->estatus->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$documentos_secciones_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($documentos_secciones->CurrentAction <> "gridadd" || $documentos_secciones->CurrentMode == "copy")
		if (!$documentos_secciones_grid->Recordset->EOF) $documentos_secciones_grid->Recordset->MoveNext();
}
?>
<?php
	if ($documentos_secciones->CurrentMode == "add" || $documentos_secciones->CurrentMode == "copy" || $documentos_secciones->CurrentMode == "edit") {
		$documentos_secciones_grid->RowIndex = '$rowindex$';
		$documentos_secciones_grid->LoadDefaultValues();

		// Set row properties
		$documentos_secciones->ResetAttrs();
		$documentos_secciones->RowAttrs = array();
		if (!empty($documentos_secciones_grid->RowIndex))
			$documentos_secciones->RowAttrs = array_merge($documentos_secciones->RowAttrs, array('data-rowindex'=>$documentos_secciones_grid->RowIndex, 'id'=>'r' . $documentos_secciones_grid->RowIndex . '_documentos_secciones'));
		$documentos_secciones->RowType = EW_ROWTYPE_ADD;

		// Render row
		$documentos_secciones_grid->RenderRow();

		// Render list options
		$documentos_secciones_grid->RenderListOptions();

		// Add id and class to the template row
		$documentos_secciones->RowAttrs["id"] = "r0_documentos_secciones";
		ew_AppendClass($documentos_secciones->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $documentos_secciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$documentos_secciones_grid->ListOptions->Render("body", "left");
?>
	<?php if ($documentos_secciones->id_documentos->Visible) { // id_documentos ?>
		<td>
<?php if ($documentos_secciones->CurrentAction <> "F") { ?>
<?php if ($documentos_secciones->id_documentos->getSessionValue() <> "") { ?>
<div<?php echo $documentos_secciones->id_documentos->ViewAttributes() ?>><?php echo $documentos_secciones->id_documentos->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos"<?php echo $documentos_secciones->id_documentos->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->id_documentos->EditValue)) {
	$arwrk = $documentos_secciones->id_documentos->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->id_documentos->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $documentos_secciones->id_documentos->OldValue = "";
?>
</select>
<?php } ?>
<?php } else { ?>
<div<?php echo $documentos_secciones->id_documentos->ViewAttributes() ?>><?php echo $documentos_secciones->id_documentos->ViewValue ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_documentos" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($documentos_secciones->id_grupo_sec->Visible) { // id_grupo_sec ?>
		<td>
<?php if ($documentos_secciones->CurrentAction <> "F") { ?>
<select id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec"<?php echo $documentos_secciones->id_grupo_sec->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->id_grupo_sec->EditValue)) {
	$arwrk = $documentos_secciones->id_grupo_sec->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->id_grupo_sec->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $documentos_secciones->id_grupo_sec->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $documentos_secciones->id_grupo_sec->ViewAttributes() ?>><?php echo $documentos_secciones->id_grupo_sec->ViewValue ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" value="<?php echo ew_HtmlEncode($documentos_secciones->id_grupo_sec->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_id_grupo_sec" value="<?php echo ew_HtmlEncode($documentos_secciones->id_grupo_sec->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($documentos_secciones->fecha_inicio->Visible) { // fecha_inicio ?>
		<td>
<?php if ($documentos_secciones->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" size="12" value="<?php echo $documentos_secciones->fecha_inicio->EditValue ?>"<?php echo $documentos_secciones->fecha_inicio->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" name="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" // button id
});
</script>
<?php } else { ?>
<div<?php echo $documentos_secciones->fecha_inicio->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_inicio->ViewValue ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_inicio->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_inicio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($documentos_secciones->fecha_fin->Visible) { // fecha_fin ?>
		<td>
<?php if ($documentos_secciones->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" size="12" value="<?php echo $documentos_secciones->fecha_fin->EditValue ?>"<?php echo $documentos_secciones->fecha_fin->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" name="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" // button id
});
</script>
<?php } else { ?>
<div<?php echo $documentos_secciones->fecha_fin->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_fin->ViewValue ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_fin->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha_fin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($documentos_secciones->fecha->Visible) { // fecha ?>
		<td>
<?php if ($documentos_secciones->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" size="12" value="<?php echo $documentos_secciones->fecha->EditValue ?>"<?php echo $documentos_secciones->fecha->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" name="cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" // button id
});
</script>
<?php } else { ?>
<div<?php echo $documentos_secciones->fecha->ViewAttributes() ?>><?php echo $documentos_secciones->fecha->ViewValue ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($documentos_secciones->fecha->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($documentos_secciones->estatus->Visible) { // estatus ?>
		<td>
<?php if ($documentos_secciones->CurrentAction <> "F") { ?>
<select id="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus"<?php echo $documentos_secciones->estatus->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->estatus->EditValue)) {
	$arwrk = $documentos_secciones->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $documentos_secciones->estatus->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $documentos_secciones->estatus->ViewAttributes() ?>><?php echo $documentos_secciones->estatus->ViewValue ?></div>
<input type="hidden" name="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" id="x<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($documentos_secciones->estatus->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" id="o<?php echo $documentos_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($documentos_secciones->estatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$documentos_secciones_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($documentos_secciones->CurrentMode == "add" || $documentos_secciones->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $documentos_secciones_grid->KeyCount ?>">
<?php echo $documentos_secciones_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($documentos_secciones->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $documentos_secciones_grid->KeyCount ?>">
<?php echo $documentos_secciones_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="documentos_secciones_grid">
</div>
<?php

// Close recordset
if ($documentos_secciones_grid->Recordset)
	$documentos_secciones_grid->Recordset->Close();
?>
<?php if (($documentos_secciones->CurrentMode == "add" || $documentos_secciones->CurrentMode == "copy" || $documentos_secciones->CurrentMode == "edit") && $documentos_secciones->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($documentos_secciones->AllowAddDeleteRow) { ?>
<?php if ($Security->CanAdd()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($documentos_secciones->Export == "" && $documentos_secciones->CurrentAction == "") { ?>
<?php } ?>
<?php
$documentos_secciones_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$documentos_secciones_grid->Page_Terminate();
$Page =& $MasterPage;
?>
