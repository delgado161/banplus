<?php include_once "usuariosinfo.php" ?>
<?php

// Create page object
$preguntas_grid = new cpreguntas_grid();
$MasterPage =& $Page;
$Page =& $preguntas_grid;

// Page init
$preguntas_grid->Page_Init();

// Page main
$preguntas_grid->Page_Main();
?>
<?php if ($preguntas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var preguntas_grid = new ew_Page("preguntas_grid");

// page properties
preguntas_grid.PageID = "grid"; // page ID
preguntas_grid.FormID = "fpreguntasgrid"; // form ID
var EW_PAGE_ID = preguntas_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
preguntas_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_pregunta"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($preguntas->pregunta->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($preguntas->estatus->FldCaption()) ?>");

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
preguntas_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "id_encuesta", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pregunta", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estatus", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
preguntas_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
preguntas_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
preguntas_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($preguntas->CurrentAction == "gridadd") {
	if ($preguntas->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$preguntas_grid->TotalRecs = $preguntas->SelectRecordCount();
			$preguntas_grid->Recordset = $preguntas_grid->LoadRecordset($preguntas_grid->StartRec-1, $preguntas_grid->DisplayRecs);
		} else {
			if ($preguntas_grid->Recordset = $preguntas_grid->LoadRecordset())
				$preguntas_grid->TotalRecs = $preguntas_grid->Recordset->RecordCount();
		}
		$preguntas_grid->StartRec = 1;
		$preguntas_grid->DisplayRecs = $preguntas_grid->TotalRecs;
	} else {
		$preguntas->CurrentFilter = "0=1";
		$preguntas_grid->StartRec = 1;
		$preguntas_grid->DisplayRecs = $preguntas->GridAddRowCount;
	}
	$preguntas_grid->TotalRecs = $preguntas_grid->DisplayRecs;
	$preguntas_grid->StopRec = $preguntas_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$preguntas_grid->TotalRecs = $preguntas->SelectRecordCount();
	} else {
		if ($preguntas_grid->Recordset = $preguntas_grid->LoadRecordset())
			$preguntas_grid->TotalRecs = $preguntas_grid->Recordset->RecordCount();
	}
	$preguntas_grid->StartRec = 1;
	$preguntas_grid->DisplayRecs = $preguntas_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$preguntas_grid->Recordset = $preguntas_grid->LoadRecordset($preguntas_grid->StartRec-1, $preguntas_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($preguntas->CurrentMode == "add" || $preguntas->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($preguntas->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $preguntas->TableCaption() ?></p>
</p>
<?php $preguntas_grid->ShowPageHeader(); ?>
<?php
$preguntas_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_preguntas" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $preguntas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$preguntas_grid->RenderListOptions();

// Render list options (header, left)
$preguntas_grid->ListOptions->Render("header", "left");
?>
<?php if ($preguntas->id_encuesta->Visible) { // id_encuesta ?>
	<?php if ($preguntas->SortUrl($preguntas->id_encuesta) == "") { ?>
		<td><?php echo $preguntas->id_encuesta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $preguntas->id_encuesta->FldCaption() ?></td><td style="width: 10px;"><?php if ($preguntas->id_encuesta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($preguntas->id_encuesta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($preguntas->pregunta->Visible) { // pregunta ?>
	<?php if ($preguntas->SortUrl($preguntas->pregunta) == "") { ?>
		<td><?php echo $preguntas->pregunta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $preguntas->pregunta->FldCaption() ?></td><td style="width: 10px;"><?php if ($preguntas->pregunta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($preguntas->pregunta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($preguntas->estatus->Visible) { // estatus ?>
	<?php if ($preguntas->SortUrl($preguntas->estatus) == "") { ?>
		<td><?php echo $preguntas->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $preguntas->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($preguntas->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($preguntas->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$preguntas_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$preguntas_grid->StartRec = 1;
$preguntas_grid->StopRec = $preguntas_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($preguntas->CurrentAction == "gridadd" || $preguntas->CurrentAction == "gridedit" || $preguntas->CurrentAction == "F")) {
		$preguntas_grid->KeyCount = $objForm->GetValue("key_count");
		$preguntas_grid->StopRec = $preguntas_grid->KeyCount;
	}
}
$preguntas_grid->RecCnt = $preguntas_grid->StartRec - 1;
if ($preguntas_grid->Recordset && !$preguntas_grid->Recordset->EOF) {
	$preguntas_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $preguntas_grid->StartRec > 1)
		$preguntas_grid->Recordset->Move($preguntas_grid->StartRec - 1);
} elseif (!$preguntas->AllowAddDeleteRow && $preguntas_grid->StopRec == 0) {
	$preguntas_grid->StopRec = $preguntas->GridAddRowCount;
}

// Initialize aggregate
$preguntas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$preguntas->ResetAttrs();
$preguntas_grid->RenderRow();
$preguntas_grid->RowCnt = 0;
if ($preguntas->CurrentAction == "gridadd")
	$preguntas_grid->RowIndex = 0;
if ($preguntas->CurrentAction == "gridedit")
	$preguntas_grid->RowIndex = 0;
while ($preguntas_grid->RecCnt < $preguntas_grid->StopRec) {
	$preguntas_grid->RecCnt++;
	if (intval($preguntas_grid->RecCnt) >= intval($preguntas_grid->StartRec)) {
		$preguntas_grid->RowCnt++;
		if ($preguntas->CurrentAction == "gridadd" || $preguntas->CurrentAction == "gridedit" || $preguntas->CurrentAction == "F") {
			$preguntas_grid->RowIndex++;
			$objForm->Index = $preguntas_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$preguntas_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($preguntas->CurrentAction == "gridadd")
				$preguntas_grid->RowAction = "insert";
			else
				$preguntas_grid->RowAction = "";
		}

		// Set up key count
		$preguntas_grid->KeyCount = $preguntas_grid->RowIndex;

		// Init row class and style
		$preguntas->ResetAttrs();
		$preguntas->CssClass = "";
		if ($preguntas->CurrentAction == "gridadd") {
			if ($preguntas->CurrentMode == "copy") {
				$preguntas_grid->LoadRowValues($preguntas_grid->Recordset); // Load row values
				$preguntas_grid->SetRecordKey($preguntas_grid->RowOldKey, $preguntas_grid->Recordset); // Set old record key
			} else {
				$preguntas_grid->LoadDefaultValues(); // Load default values
				$preguntas_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($preguntas->CurrentAction == "gridedit") {
			$preguntas_grid->LoadRowValues($preguntas_grid->Recordset); // Load row values
		}
		$preguntas->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($preguntas->CurrentAction == "gridadd") // Grid add
			$preguntas->RowType = EW_ROWTYPE_ADD; // Render add
		if ($preguntas->CurrentAction == "gridadd" && $preguntas->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$preguntas_grid->RestoreCurrentRowFormValues($preguntas_grid->RowIndex); // Restore form values
		if ($preguntas->CurrentAction == "gridedit") { // Grid edit
			if ($preguntas->EventCancelled) {
				$preguntas_grid->RestoreCurrentRowFormValues($preguntas_grid->RowIndex); // Restore form values
			}
			if ($preguntas_grid->RowAction == "insert")
				$preguntas->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$preguntas->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($preguntas->CurrentAction == "gridedit" && ($preguntas->RowType == EW_ROWTYPE_EDIT || $preguntas->RowType == EW_ROWTYPE_ADD) && $preguntas->EventCancelled) // Update failed
			$preguntas_grid->RestoreCurrentRowFormValues($preguntas_grid->RowIndex); // Restore form values
		if ($preguntas->RowType == EW_ROWTYPE_EDIT) // Edit row
			$preguntas_grid->EditRowCnt++;
		if ($preguntas->CurrentAction == "F") // Confirm row
			$preguntas_grid->RestoreCurrentRowFormValues($preguntas_grid->RowIndex); // Restore form values
		if ($preguntas->RowType == EW_ROWTYPE_ADD || $preguntas->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($preguntas->CurrentAction == "edit") {
				$preguntas->RowAttrs = array();
				$preguntas->CssClass = "ewTableEditRow";
			} else {
				$preguntas->RowAttrs = array();
			}
			if (!empty($preguntas_grid->RowIndex))
				$preguntas->RowAttrs = array_merge($preguntas->RowAttrs, array('data-rowindex'=>$preguntas_grid->RowIndex, 'id'=>'r' . $preguntas_grid->RowIndex . '_preguntas'));
		} else {
			$preguntas->RowAttrs = array();
		}

		// Render row
		$preguntas_grid->RenderRow();

		// Render list options
		$preguntas_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($preguntas_grid->RowAction <> "delete" && $preguntas_grid->RowAction <> "insertdelete" && !($preguntas_grid->RowAction == "insert" && $preguntas->CurrentAction == "F" && $preguntas_grid->EmptyRow())) {
?>
	<tr<?php echo $preguntas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$preguntas_grid->ListOptions->Render("body", "left");
?>
	<?php if ($preguntas->id_encuesta->Visible) { // id_encuesta ?>
		<td<?php echo $preguntas->id_encuesta->CellAttributes() ?>>
<?php if ($preguntas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($preguntas->id_encuesta->getSessionValue() <> "") { ?>
<div<?php echo $preguntas->id_encuesta->ViewAttributes() ?>><?php echo $preguntas->id_encuesta->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" name="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" value="<?php echo ew_HtmlEncode($preguntas->id_encuesta->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" name="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta"<?php echo $preguntas->id_encuesta->EditAttributes() ?>>
<?php
if (is_array($preguntas->id_encuesta->EditValue)) {
	$arwrk = $preguntas->id_encuesta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($preguntas->id_encuesta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $preguntas->id_encuesta->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" id="o<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" value="<?php echo ew_HtmlEncode($preguntas->id_encuesta->OldValue) ?>">
<?php } ?>
<?php if ($preguntas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($preguntas->id_encuesta->getSessionValue() <> "") { ?>
<div<?php echo $preguntas->id_encuesta->ViewAttributes() ?>><?php echo $preguntas->id_encuesta->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" name="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" value="<?php echo ew_HtmlEncode($preguntas->id_encuesta->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" name="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta"<?php echo $preguntas->id_encuesta->EditAttributes() ?>>
<?php
if (is_array($preguntas->id_encuesta->EditValue)) {
	$arwrk = $preguntas->id_encuesta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($preguntas->id_encuesta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $preguntas->id_encuesta->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($preguntas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $preguntas->id_encuesta->ViewAttributes() ?>><?php echo $preguntas->id_encuesta->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" id="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" value="<?php echo ew_HtmlEncode($preguntas->id_encuesta->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" id="o<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" value="<?php echo ew_HtmlEncode($preguntas->id_encuesta->OldValue) ?>">
<?php } ?>
<a name="<?php echo $preguntas_grid->PageObjName . "_row_" . $preguntas_grid->RowCnt ?>" id="<?php echo $preguntas_grid->PageObjName . "_row_" . $preguntas_grid->RowCnt ?>"></a>
<?php if ($preguntas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_id_pregunta" id="o<?php echo $preguntas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($preguntas->id_pregunta->OldValue) ?>">
<?php } ?>
<?php if ($preguntas->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $preguntas_grid->RowIndex ?>_id_pregunta" id="x<?php echo $preguntas_grid->RowIndex ?>_id_pregunta" value="<?php echo ew_HtmlEncode($preguntas->id_pregunta->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($preguntas->pregunta->Visible) { // pregunta ?>
		<td<?php echo $preguntas->pregunta->CellAttributes() ?>>
<?php if ($preguntas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<textarea name="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" id="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" cols="0" rows="5"<?php echo $preguntas->pregunta->EditAttributes() ?>><?php echo $preguntas->pregunta->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($preguntas->pregunta->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x<?php echo $preguntas_grid->RowIndex ?>_pregunta', 0*_width_multiplier, 5*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x<?php echo $preguntas_grid->RowIndex ?>_pregunta", function() {
	var oCKeditor = CKEDITOR.replace('x<?php echo $preguntas_grid->RowIndex ?>_pregunta', { width: 0*_width_multiplier, height: 5*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_pregunta" id="o<?php echo $preguntas_grid->RowIndex ?>_pregunta" value="<?php echo ew_HtmlEncode($preguntas->pregunta->OldValue) ?>">
<?php } ?>
<?php if ($preguntas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<textarea name="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" id="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" cols="0" rows="5"<?php echo $preguntas->pregunta->EditAttributes() ?>><?php echo $preguntas->pregunta->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($preguntas->pregunta->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x<?php echo $preguntas_grid->RowIndex ?>_pregunta', 0*_width_multiplier, 5*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x<?php echo $preguntas_grid->RowIndex ?>_pregunta", function() {
	var oCKeditor = CKEDITOR.replace('x<?php echo $preguntas_grid->RowIndex ?>_pregunta', { width: 0*_width_multiplier, height: 5*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
<?php } ?>
<?php if ($preguntas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $preguntas->pregunta->ViewAttributes() ?>><?php echo $preguntas->pregunta->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" id="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" value="<?php echo ew_HtmlEncode($preguntas->pregunta->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_pregunta" id="o<?php echo $preguntas_grid->RowIndex ?>_pregunta" value="<?php echo ew_HtmlEncode($preguntas->pregunta->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($preguntas->estatus->Visible) { // estatus ?>
		<td<?php echo $preguntas->estatus->CellAttributes() ?>>
<?php if ($preguntas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $preguntas_grid->RowIndex ?>_estatus" name="x<?php echo $preguntas_grid->RowIndex ?>_estatus"<?php echo $preguntas->estatus->EditAttributes() ?>>
<?php
if (is_array($preguntas->estatus->EditValue)) {
	$arwrk = $preguntas->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($preguntas->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $preguntas->estatus->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_estatus" id="o<?php echo $preguntas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($preguntas->estatus->OldValue) ?>">
<?php } ?>
<?php if ($preguntas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $preguntas_grid->RowIndex ?>_estatus" name="x<?php echo $preguntas_grid->RowIndex ?>_estatus"<?php echo $preguntas->estatus->EditAttributes() ?>>
<?php
if (is_array($preguntas->estatus->EditValue)) {
	$arwrk = $preguntas->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($preguntas->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $preguntas->estatus->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($preguntas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $preguntas->estatus->ViewAttributes() ?>><?php echo $preguntas->estatus->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $preguntas_grid->RowIndex ?>_estatus" id="x<?php echo $preguntas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($preguntas->estatus->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_estatus" id="o<?php echo $preguntas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($preguntas->estatus->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$preguntas_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($preguntas->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($preguntas->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($preguntas->CurrentAction <> "gridadd" || $preguntas->CurrentMode == "copy")
		if (!$preguntas_grid->Recordset->EOF) $preguntas_grid->Recordset->MoveNext();
}
?>
<?php
	if ($preguntas->CurrentMode == "add" || $preguntas->CurrentMode == "copy" || $preguntas->CurrentMode == "edit") {
		$preguntas_grid->RowIndex = '$rowindex$';
		$preguntas_grid->LoadDefaultValues();

		// Set row properties
		$preguntas->ResetAttrs();
		$preguntas->RowAttrs = array();
		if (!empty($preguntas_grid->RowIndex))
			$preguntas->RowAttrs = array_merge($preguntas->RowAttrs, array('data-rowindex'=>$preguntas_grid->RowIndex, 'id'=>'r' . $preguntas_grid->RowIndex . '_preguntas'));
		$preguntas->RowType = EW_ROWTYPE_ADD;

		// Render row
		$preguntas_grid->RenderRow();

		// Render list options
		$preguntas_grid->RenderListOptions();

		// Add id and class to the template row
		$preguntas->RowAttrs["id"] = "r0_preguntas";
		ew_AppendClass($preguntas->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $preguntas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$preguntas_grid->ListOptions->Render("body", "left");
?>
	<?php if ($preguntas->id_encuesta->Visible) { // id_encuesta ?>
		<td>
<?php if ($preguntas->CurrentAction <> "F") { ?>
<?php if ($preguntas->id_encuesta->getSessionValue() <> "") { ?>
<div<?php echo $preguntas->id_encuesta->ViewAttributes() ?>><?php echo $preguntas->id_encuesta->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" name="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" value="<?php echo ew_HtmlEncode($preguntas->id_encuesta->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" name="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta"<?php echo $preguntas->id_encuesta->EditAttributes() ?>>
<?php
if (is_array($preguntas->id_encuesta->EditValue)) {
	$arwrk = $preguntas->id_encuesta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($preguntas->id_encuesta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $preguntas->id_encuesta->OldValue = "";
?>
</select>
<?php } ?>
<?php } else { ?>
<div<?php echo $preguntas->id_encuesta->ViewAttributes() ?>><?php echo $preguntas->id_encuesta->ViewValue ?></div>
<input type="hidden" name="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" id="x<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" value="<?php echo ew_HtmlEncode($preguntas->id_encuesta->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" id="o<?php echo $preguntas_grid->RowIndex ?>_id_encuesta" value="<?php echo ew_HtmlEncode($preguntas->id_encuesta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($preguntas->pregunta->Visible) { // pregunta ?>
		<td>
<?php if ($preguntas->CurrentAction <> "F") { ?>
<textarea name="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" id="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" cols="0" rows="5"<?php echo $preguntas->pregunta->EditAttributes() ?>><?php echo $preguntas->pregunta->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($preguntas->pregunta->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x<?php echo $preguntas_grid->RowIndex ?>_pregunta', 0*_width_multiplier, 5*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x<?php echo $preguntas_grid->RowIndex ?>_pregunta", function() {
	var oCKeditor = CKEDITOR.replace('x<?php echo $preguntas_grid->RowIndex ?>_pregunta', { width: 0*_width_multiplier, height: 5*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
<?php } else { ?>
<div<?php echo $preguntas->pregunta->ViewAttributes() ?>><?php echo $preguntas->pregunta->ViewValue ?></div>
<input type="hidden" name="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" id="x<?php echo $preguntas_grid->RowIndex ?>_pregunta" value="<?php echo ew_HtmlEncode($preguntas->pregunta->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_pregunta" id="o<?php echo $preguntas_grid->RowIndex ?>_pregunta" value="<?php echo ew_HtmlEncode($preguntas->pregunta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($preguntas->estatus->Visible) { // estatus ?>
		<td>
<?php if ($preguntas->CurrentAction <> "F") { ?>
<select id="x<?php echo $preguntas_grid->RowIndex ?>_estatus" name="x<?php echo $preguntas_grid->RowIndex ?>_estatus"<?php echo $preguntas->estatus->EditAttributes() ?>>
<?php
if (is_array($preguntas->estatus->EditValue)) {
	$arwrk = $preguntas->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($preguntas->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $preguntas->estatus->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $preguntas->estatus->ViewAttributes() ?>><?php echo $preguntas->estatus->ViewValue ?></div>
<input type="hidden" name="x<?php echo $preguntas_grid->RowIndex ?>_estatus" id="x<?php echo $preguntas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($preguntas->estatus->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $preguntas_grid->RowIndex ?>_estatus" id="o<?php echo $preguntas_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($preguntas->estatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$preguntas_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($preguntas->CurrentMode == "add" || $preguntas->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $preguntas_grid->KeyCount ?>">
<?php echo $preguntas_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($preguntas->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $preguntas_grid->KeyCount ?>">
<?php echo $preguntas_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="preguntas_grid">
</div>
<?php

// Close recordset
if ($preguntas_grid->Recordset)
	$preguntas_grid->Recordset->Close();
?>
<?php if (($preguntas->CurrentMode == "add" || $preguntas->CurrentMode == "copy" || $preguntas->CurrentMode == "edit") && $preguntas->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($preguntas->AllowAddDeleteRow) { ?>
<?php if ($Security->CanAdd()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($preguntas->Export == "" && $preguntas->CurrentAction == "") { ?>
<?php } ?>
<?php
$preguntas_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$preguntas_grid->Page_Terminate();
$Page =& $MasterPage;
?>
