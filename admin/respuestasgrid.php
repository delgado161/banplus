<?php include_once "usuariosinfo.php" ?>
<?php

// Create page object
$respuestas_grid = new crespuestas_grid();
$MasterPage =& $Page;
$Page =& $respuestas_grid;

// Page init
$respuestas_grid->Page_Init();

// Page main
$respuestas_grid->Page_Main();
?>
<?php if ($respuestas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var respuestas_grid = new ew_Page("respuestas_grid");

// page properties
respuestas_grid.PageID = "grid"; // page ID
respuestas_grid.FormID = "frespuestasgrid"; // form ID
var EW_PAGE_ID = respuestas_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
respuestas_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_respuesta"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($respuestas->respuesta->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($respuestas->orden->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($respuestas->estatus->FldCaption()) ?>");

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
respuestas_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "id_pregunta", false)) return false;
	if (ew_ValueChanged(fobj, infix, "respuesta", false)) return false;
	if (ew_ValueChanged(fobj, infix, "contador", false)) return false;
	if (ew_ValueChanged(fobj, infix, "orden", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estatus", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
respuestas_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
respuestas_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
respuestas_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($respuestas->CurrentAction == "gridadd") {
	if ($respuestas->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$respuestas_grid->TotalRecs = $respuestas->SelectRecordCount();
			$respuestas_grid->Recordset = $respuestas_grid->LoadRecordset($respuestas_grid->StartRec-1, $respuestas_grid->DisplayRecs);
		} else {
			if ($respuestas_grid->Recordset = $respuestas_grid->LoadRecordset())
				$respuestas_grid->TotalRecs = $respuestas_grid->Recordset->RecordCount();
		}
		$respuestas_grid->StartRec = 1;
		$respuestas_grid->DisplayRecs = $respuestas_grid->TotalRecs;
	} else {
		$respuestas->CurrentFilter = "0=1";
		$respuestas_grid->StartRec = 1;
		$respuestas_grid->DisplayRecs = $respuestas->GridAddRowCount;
	}
	$respuestas_grid->TotalRecs = $respuestas_grid->DisplayRecs;
	$respuestas_grid->StopRec = $respuestas_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$respuestas_grid->TotalRecs = $respuestas->SelectRecordCount();
	} else {
		if ($respuestas_grid->Recordset = $respuestas_grid->LoadRecordset())
			$respuestas_grid->TotalRecs = $respuestas_grid->Recordset->RecordCount();
	}
	$respuestas_grid->StartRec = 1;
	$respuestas_grid->DisplayRecs = $respuestas_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$respuestas_grid->Recordset = $respuestas_grid->LoadRecordset($respuestas_grid->StartRec-1, $respuestas_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($respuestas->CurrentMode == "add" || $respuestas->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($respuestas->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $respuestas->TableCaption() ?></p>
</p>
<?php $respuestas_grid->ShowPageHeader(); ?>
<?php
$respuestas_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_respuestas" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $respuestas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$respuestas_grid->RenderListOptions();

// Render list options (header, left)
$respuestas_grid->ListOptions->Render("header", "left");
?>
<?php if ($respuestas->id_pregunta->Visible) { // id_pregunta ?>
	<?php if ($respuestas->SortUrl($respuestas->id_pregunta) == "") { ?>
		<td><?php echo $respuestas->id_pregunta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->id_pregunta->FldCaption() ?></td><td style="width: 10px;"><?php if ($respuestas->id_pregunta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->id_pregunta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($respuestas->respuesta->Visible) { // respuesta ?>
	<?php if ($respuestas->SortUrl($respuestas->respuesta) == "") { ?>
		<td><?php echo $respuestas->respuesta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->respuesta->FldCaption() ?></td><td style="width: 10px;"><?php if ($respuestas->respuesta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->respuesta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($respuestas->contador->Visible) { // contador ?>
	<?php if ($respuestas->SortUrl($respuestas->contador) == "") { ?>
		<td><?php echo $respuestas->contador->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->contador->FldCaption() ?></td><td style="width: 10px;"><?php if ($respuestas->contador->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->contador->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($respuestas->orden->Visible) { // orden ?>
	<?php if ($respuestas->SortUrl($respuestas->orden) == "") { ?>
		<td><?php echo $respuestas->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->orden->FldCaption() ?></td><td style="width: 10px;"><?php if ($respuestas->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($respuestas->estatus->Visible) { // estatus ?>
	<?php if ($respuestas->SortUrl($respuestas->estatus) == "") { ?>
		<td><?php echo $respuestas->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($respuestas->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$respuestas_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$respuestas_grid->StartRec = 1;
$respuestas_grid->StopRec = $respuestas_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($respuestas->CurrentAction == "gridadd" || $respuestas->CurrentAction == "gridedit" || $respuestas->CurrentAction == "F")) {
		$respuestas_grid->KeyCount = $objForm->GetValue("key_count");
		$respuestas_grid->StopRec = $respuestas_grid->KeyCount;
	}
}
$respuestas_grid->RecCnt = $respuestas_grid->StartRec - 1;
if ($respuestas_grid->Recordset && !$respuestas_grid->Recordset->EOF) {
	$respuestas_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $respuestas_grid->StartRec > 1)
		$respuestas_grid->Recordset->Move($respuestas_grid->StartRec - 1);
} elseif (!$respuestas->AllowAddDeleteRow && $respuestas_grid->StopRec == 0) {
	$respuestas_grid->StopRec = $respuestas->GridAddRowCount;
}

// Initialize aggregate
$respuestas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$respuestas->ResetAttrs();
$respuestas_grid->RenderRow();
$respuestas_grid->RowCnt = 0;
if ($respuestas->CurrentAction == "gridadd")
	$respuestas_grid->RowIndex = 0;
if ($respuestas->CurrentAction == "gridedit")
	$respuestas_grid->RowIndex = 0;
while ($respuestas_grid->RecCnt < $respuestas_grid->StopRec) {
	$respuestas_grid->RecCnt++;
	if (intval($respuestas_grid->RecCnt) >= intval($respuestas_grid->StartRec)) {
		$respuestas_grid->RowCnt++;
		if ($respuestas->CurrentAction == "gridadd" || $respuestas->CurrentAction == "gridedit" || $respuestas->CurrentAction == "F") {
			$respuestas_grid->RowIndex++;
			$objForm->Index = $respuestas_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$respuestas_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($respuestas->CurrentAction == "gridadd")
				$respuestas_grid->RowAction = "insert";
			else
				$respuestas_grid->RowAction = "";
		}

		// Set up key count
		$respuestas_grid->KeyCount = $respuestas_grid->RowIndex;

		// Init row class and style
		$respuestas->ResetAttrs();
		$respuestas->CssClass = "";
		if ($respuestas->CurrentAction == "gridadd") {
			if ($respuestas->CurrentMode == "copy") {
				$respuestas_grid->LoadRowValues($respuestas_grid->Recordset); // Load row values
				$respuestas_grid->SetRecordKey($respuestas_grid->RowOldKey, $respuestas_grid->Recordset); // Set old record key
			} else {
				$respuestas_grid->LoadDefaultValues(); // Load default values
				$respuestas_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($respuestas->CurrentAction == "gridedit") {
			$respuestas_grid->LoadRowValues($respuestas_grid->Recordset); // Load row values
		}
		$respuestas->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($respuestas->CurrentAction == "gridadd") // Grid add
			$respuestas->RowType = EW_ROWTYPE_ADD; // Render add
		if ($respuestas->CurrentAction == "gridadd" && $respuestas->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$respuestas_grid->RestoreCurrentRowFormValues($respuestas_grid->RowIndex); // Restore form values
		if ($respuestas->CurrentAction == "gridedit") { // Grid edit
			if ($respuestas->EventCancelled) {
				$respuestas_grid->RestoreCurrentRowFormValues($respuestas_grid->RowIndex); // Restore form values
			}
			if ($respuestas_grid->RowAction == "insert")
				$respuestas->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$respuestas->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($respuestas->CurrentAction == "gridedit" && ($respuestas->RowType == EW_ROWTYPE_EDIT || $respuestas->RowType == EW_ROWTYPE_ADD) && $respuestas->EventCancelled) // Update failed
			$respuestas_grid->RestoreCurrentRowFormValues($respuestas_grid->RowIndex); // Restore form values
		if ($respuestas->RowType == EW_ROWTYPE_EDIT) // Edit row
			$respuestas_grid->EditRowCnt++;
		if ($respuestas->CurrentAction == "F") // Confirm row
			$respuestas_grid->RestoreCurrentRowFormValues($respuestas_grid->RowIndex); // Restore form values
		if ($respuestas->RowType == EW_ROWTYPE_ADD || $respuestas->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($respuestas->CurrentAction == "edit") {
				$respuestas->RowAttrs = array();
				$respuestas->CssClass = "ewTableEditRow";
			} else {
				$respuestas->RowAttrs = array();
			}
			if (!empty($respuestas_grid->RowIndex))
				$respuestas->RowAttrs = array_merge($respuestas->RowAttrs, array('data-rowindex'=>$respuestas_grid->RowIndex, 'id'=>'r' . $respuestas_grid->RowIndex . '_respuestas'));
		} else {
			$respuestas->RowAttrs = array();
		}

		// Render row
		$respuestas_grid->RenderRow();

		// Render list options
		$respuestas_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($respuestas_grid->RowAction <> "delete" && $respuestas_grid->RowAction <> "insertdelete" && !($respuestas_grid->RowAction == "insert" && $respuestas->CurrentAction == "F" && $respuestas_grid->EmptyRow())) {
?>
	<tr<?php echo $respuestas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$respuestas_grid->ListOptions->Render("body", "left");
?>
	<?php if ($respuestas->id_pregunta->Visible) { // id_pregunta ?>
		<td<?php echo $respuestas->id_pregunta->CellAttributes() ?>>
<?php if ($respuestas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($respuestas->id_pregunta->getSessionValue() <> "") { ?>
<div<?php echo $respuestas->id_pregunta->ViewAttributes() ?>><?php echo $respuestas->id_pregunta->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" name="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($respuestas->id_pregunta->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" name="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta"<?php echo $respuestas->id_pregunta->EditAttributes() ?>>
<?php
if (is_array($respuestas->id_pregunta->EditValue)) {
	$arwrk = $respuestas->id_pregunta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($respuestas->id_pregunta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $respuestas->id_pregunta->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" id="o<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($respuestas->id_pregunta->OldValue) ?>">
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($respuestas->id_pregunta->getSessionValue() <> "") { ?>
<div<?php echo $respuestas->id_pregunta->ViewAttributes() ?>><?php echo $respuestas->id_pregunta->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" name="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($respuestas->id_pregunta->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" name="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta"<?php echo $respuestas->id_pregunta->EditAttributes() ?>>
<?php
if (is_array($respuestas->id_pregunta->EditValue)) {
	$arwrk = $respuestas->id_pregunta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($respuestas->id_pregunta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $respuestas->id_pregunta->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $respuestas->id_pregunta->ViewAttributes() ?>><?php echo $respuestas->id_pregunta->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" id="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($respuestas->id_pregunta->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" id="o<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($respuestas->id_pregunta->OldValue) ?>">
<?php } ?>
<a name="<?php echo $respuestas_grid->PageObjName . "_row_" . $respuestas_grid->RowCnt ?>" id="<?php echo $respuestas_grid->PageObjName . "_row_" . $respuestas_grid->RowCnt ?>"></a>
<?php if ($respuestas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_id_respuestas" id="o<?php echo $respuestas_grid->RowIndex ?>_id_respuestas" value="<?php echo ew_HtmlEncode($respuestas->id_respuestas->OldValue) ?>">
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_id_respuestas" id="x<?php echo $respuestas_grid->RowIndex ?>_id_respuestas" value="<?php echo ew_HtmlEncode($respuestas->id_respuestas->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($respuestas->respuesta->Visible) { // respuesta ?>
		<td<?php echo $respuestas->respuesta->CellAttributes() ?>>
<?php if ($respuestas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" id="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" size="50" maxlength="50" value="<?php echo $respuestas->respuesta->EditValue ?>"<?php echo $respuestas->respuesta->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_respuesta" id="o<?php echo $respuestas_grid->RowIndex ?>_respuesta" value="<?php echo ew_HtmlEncode($respuestas->respuesta->OldValue) ?>">
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" id="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" size="50" maxlength="50" value="<?php echo $respuestas->respuesta->EditValue ?>"<?php echo $respuestas->respuesta->EditAttributes() ?>>
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $respuestas->respuesta->ViewAttributes() ?>><?php echo $respuestas->respuesta->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" id="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" value="<?php echo ew_HtmlEncode($respuestas->respuesta->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_respuesta" id="o<?php echo $respuestas_grid->RowIndex ?>_respuesta" value="<?php echo ew_HtmlEncode($respuestas->respuesta->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($respuestas->contador->Visible) { // contador ?>
		<td<?php echo $respuestas->contador->CellAttributes() ?>>
<?php if ($respuestas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $respuestas_grid->RowIndex ?>_contador" id="x<?php echo $respuestas_grid->RowIndex ?>_contador" size="30" value="<?php echo $respuestas->contador->EditValue ?>"<?php echo $respuestas->contador->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_contador" id="o<?php echo $respuestas_grid->RowIndex ?>_contador" value="<?php echo ew_HtmlEncode($respuestas->contador->OldValue) ?>">
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $respuestas->contador->ViewAttributes() ?>><?php echo $respuestas->contador->EditValue ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_contador" id="x<?php echo $respuestas_grid->RowIndex ?>_contador" value="<?php echo ew_HtmlEncode($respuestas->contador->CurrentValue) ?>">
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $respuestas->contador->ViewAttributes() ?>><?php echo $respuestas->contador->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_contador" id="x<?php echo $respuestas_grid->RowIndex ?>_contador" value="<?php echo ew_HtmlEncode($respuestas->contador->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_contador" id="o<?php echo $respuestas_grid->RowIndex ?>_contador" value="<?php echo ew_HtmlEncode($respuestas->contador->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($respuestas->orden->Visible) { // orden ?>
		<td<?php echo $respuestas->orden->CellAttributes() ?>>
<?php if ($respuestas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $respuestas_grid->RowIndex ?>_orden" id="x<?php echo $respuestas_grid->RowIndex ?>_orden" size="3" value="<?php echo $respuestas->orden->EditValue ?>"<?php echo $respuestas->orden->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_orden" id="o<?php echo $respuestas_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($respuestas->orden->OldValue) ?>">
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $respuestas_grid->RowIndex ?>_orden" id="x<?php echo $respuestas_grid->RowIndex ?>_orden" size="3" value="<?php echo $respuestas->orden->EditValue ?>"<?php echo $respuestas->orden->EditAttributes() ?>>
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $respuestas->orden->ViewAttributes() ?>><?php echo $respuestas->orden->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_orden" id="x<?php echo $respuestas_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($respuestas->orden->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_orden" id="o<?php echo $respuestas_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($respuestas->orden->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($respuestas->estatus->Visible) { // estatus ?>
		<td<?php echo $respuestas->estatus->CellAttributes() ?>>
<?php if ($respuestas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $respuestas_grid->RowIndex ?>_estatus" name="x<?php echo $respuestas_grid->RowIndex ?>_estatus"<?php echo $respuestas->estatus->EditAttributes() ?>>
<?php
if (is_array($respuestas->estatus->EditValue)) {
	$arwrk = $respuestas->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($respuestas->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $respuestas->estatus->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_estatus" id="o<?php echo $respuestas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($respuestas->estatus->OldValue) ?>">
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $respuestas_grid->RowIndex ?>_estatus" name="x<?php echo $respuestas_grid->RowIndex ?>_estatus"<?php echo $respuestas->estatus->EditAttributes() ?>>
<?php
if (is_array($respuestas->estatus->EditValue)) {
	$arwrk = $respuestas->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($respuestas->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $respuestas->estatus->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $respuestas->estatus->ViewAttributes() ?>><?php echo $respuestas->estatus->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_estatus" id="x<?php echo $respuestas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($respuestas->estatus->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_estatus" id="o<?php echo $respuestas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($respuestas->estatus->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$respuestas_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($respuestas->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($respuestas->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($respuestas->CurrentAction <> "gridadd" || $respuestas->CurrentMode == "copy")
		if (!$respuestas_grid->Recordset->EOF) $respuestas_grid->Recordset->MoveNext();
}
?>
<?php
	if ($respuestas->CurrentMode == "add" || $respuestas->CurrentMode == "copy" || $respuestas->CurrentMode == "edit") {
		$respuestas_grid->RowIndex = '$rowindex$';
		$respuestas_grid->LoadDefaultValues();

		// Set row properties
		$respuestas->ResetAttrs();
		$respuestas->RowAttrs = array();
		if (!empty($respuestas_grid->RowIndex))
			$respuestas->RowAttrs = array_merge($respuestas->RowAttrs, array('data-rowindex'=>$respuestas_grid->RowIndex, 'id'=>'r' . $respuestas_grid->RowIndex . '_respuestas'));
		$respuestas->RowType = EW_ROWTYPE_ADD;

		// Render row
		$respuestas_grid->RenderRow();

		// Render list options
		$respuestas_grid->RenderListOptions();

		// Add id and class to the template row
		$respuestas->RowAttrs["id"] = "r0_respuestas";
		ew_AppendClass($respuestas->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $respuestas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$respuestas_grid->ListOptions->Render("body", "left");
?>
	<?php if ($respuestas->id_pregunta->Visible) { // id_pregunta ?>
		<td>
<?php if ($respuestas->CurrentAction <> "F") { ?>
<?php if ($respuestas->id_pregunta->getSessionValue() <> "") { ?>
<div<?php echo $respuestas->id_pregunta->ViewAttributes() ?>><?php echo $respuestas->id_pregunta->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" name="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($respuestas->id_pregunta->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" name="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta"<?php echo $respuestas->id_pregunta->EditAttributes() ?>>
<?php
if (is_array($respuestas->id_pregunta->EditValue)) {
	$arwrk = $respuestas->id_pregunta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($respuestas->id_pregunta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $respuestas->id_pregunta->OldValue = "";
?>
</select>
<?php } ?>
<?php } else { ?>
<div<?php echo $respuestas->id_pregunta->ViewAttributes() ?>><?php echo $respuestas->id_pregunta->ViewValue ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" id="x<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($respuestas->id_pregunta->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" id="o<?php echo $respuestas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($respuestas->id_pregunta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($respuestas->respuesta->Visible) { // respuesta ?>
		<td>
<?php if ($respuestas->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" id="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" size="50" maxlength="50" value="<?php echo $respuestas->respuesta->EditValue ?>"<?php echo $respuestas->respuesta->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $respuestas->respuesta->ViewAttributes() ?>><?php echo $respuestas->respuesta->ViewValue ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" id="x<?php echo $respuestas_grid->RowIndex ?>_respuesta" value="<?php echo ew_HtmlEncode($respuestas->respuesta->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_respuesta" id="o<?php echo $respuestas_grid->RowIndex ?>_respuesta" value="<?php echo ew_HtmlEncode($respuestas->respuesta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($respuestas->contador->Visible) { // contador ?>
		<td>
<?php if ($respuestas->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $respuestas_grid->RowIndex ?>_contador" id="x<?php echo $respuestas_grid->RowIndex ?>_contador" size="30" value="<?php echo $respuestas->contador->EditValue ?>"<?php echo $respuestas->contador->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $respuestas->contador->ViewAttributes() ?>><?php echo $respuestas->contador->ViewValue ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_contador" id="x<?php echo $respuestas_grid->RowIndex ?>_contador" value="<?php echo ew_HtmlEncode($respuestas->contador->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_contador" id="o<?php echo $respuestas_grid->RowIndex ?>_contador" value="<?php echo ew_HtmlEncode($respuestas->contador->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($respuestas->orden->Visible) { // orden ?>
		<td>
<?php if ($respuestas->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $respuestas_grid->RowIndex ?>_orden" id="x<?php echo $respuestas_grid->RowIndex ?>_orden" size="3" value="<?php echo $respuestas->orden->EditValue ?>"<?php echo $respuestas->orden->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $respuestas->orden->ViewAttributes() ?>><?php echo $respuestas->orden->ViewValue ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_orden" id="x<?php echo $respuestas_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($respuestas->orden->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_orden" id="o<?php echo $respuestas_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($respuestas->orden->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($respuestas->estatus->Visible) { // estatus ?>
		<td>
<?php if ($respuestas->CurrentAction <> "F") { ?>
<select id="x<?php echo $respuestas_grid->RowIndex ?>_estatus" name="x<?php echo $respuestas_grid->RowIndex ?>_estatus"<?php echo $respuestas->estatus->EditAttributes() ?>>
<?php
if (is_array($respuestas->estatus->EditValue)) {
	$arwrk = $respuestas->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($respuestas->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $respuestas->estatus->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $respuestas->estatus->ViewAttributes() ?>><?php echo $respuestas->estatus->ViewValue ?></div>
<input type="hidden" name="x<?php echo $respuestas_grid->RowIndex ?>_estatus" id="x<?php echo $respuestas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($respuestas->estatus->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $respuestas_grid->RowIndex ?>_estatus" id="o<?php echo $respuestas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($respuestas->estatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$respuestas_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($respuestas->CurrentMode == "add" || $respuestas->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $respuestas_grid->KeyCount ?>">
<?php echo $respuestas_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($respuestas->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $respuestas_grid->KeyCount ?>">
<?php echo $respuestas_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="respuestas_grid">
</div>
<?php

// Close recordset
if ($respuestas_grid->Recordset)
	$respuestas_grid->Recordset->Close();
?>
<?php if (($respuestas->CurrentMode == "add" || $respuestas->CurrentMode == "copy" || $respuestas->CurrentMode == "edit") && $respuestas->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($respuestas->AllowAddDeleteRow) { ?>
<?php if ($Security->CanAdd()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($respuestas->Export == "" && $respuestas->CurrentAction == "") { ?>
<?php } ?>
<?php
$respuestas_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$respuestas_grid->Page_Terminate();
$Page =& $MasterPage;
?>
