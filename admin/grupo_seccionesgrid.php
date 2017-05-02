<?php include_once "usuariosinfo.php" ?>
<?php

// Create page object
$grupo_secciones_grid = new cgrupo_secciones_grid();
$MasterPage =& $Page;
$Page =& $grupo_secciones_grid;

// Page init
$grupo_secciones_grid->Page_Init();

// Page main
$grupo_secciones_grid->Page_Main();
?>
<?php if ($grupo_secciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grupo_secciones_grid = new ew_Page("grupo_secciones_grid");

// page properties
grupo_secciones_grid.PageID = "grid"; // page ID
grupo_secciones_grid.FormID = "fgrupo_seccionesgrid"; // form ID
var EW_PAGE_ID = grupo_secciones_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
grupo_secciones_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_id_grupo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grupo_secciones->id_grupo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_contenido"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grupo_secciones->id_contenido->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grupo_secciones->orden->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grupo_secciones->estatus->FldCaption()) ?>");

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
grupo_secciones_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "id_grupo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_contenido", false)) return false;
	if (ew_ValueChanged(fobj, infix, "orden", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estatus", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
grupo_secciones_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grupo_secciones_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grupo_secciones_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($grupo_secciones->CurrentAction == "gridadd") {
	if ($grupo_secciones->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$grupo_secciones_grid->TotalRecs = $grupo_secciones->SelectRecordCount();
			$grupo_secciones_grid->Recordset = $grupo_secciones_grid->LoadRecordset($grupo_secciones_grid->StartRec-1, $grupo_secciones_grid->DisplayRecs);
		} else {
			if ($grupo_secciones_grid->Recordset = $grupo_secciones_grid->LoadRecordset())
				$grupo_secciones_grid->TotalRecs = $grupo_secciones_grid->Recordset->RecordCount();
		}
		$grupo_secciones_grid->StartRec = 1;
		$grupo_secciones_grid->DisplayRecs = $grupo_secciones_grid->TotalRecs;
	} else {
		$grupo_secciones->CurrentFilter = "0=1";
		$grupo_secciones_grid->StartRec = 1;
		$grupo_secciones_grid->DisplayRecs = $grupo_secciones->GridAddRowCount;
	}
	$grupo_secciones_grid->TotalRecs = $grupo_secciones_grid->DisplayRecs;
	$grupo_secciones_grid->StopRec = $grupo_secciones_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$grupo_secciones_grid->TotalRecs = $grupo_secciones->SelectRecordCount();
	} else {
		if ($grupo_secciones_grid->Recordset = $grupo_secciones_grid->LoadRecordset())
			$grupo_secciones_grid->TotalRecs = $grupo_secciones_grid->Recordset->RecordCount();
	}
	$grupo_secciones_grid->StartRec = 1;
	$grupo_secciones_grid->DisplayRecs = $grupo_secciones_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$grupo_secciones_grid->Recordset = $grupo_secciones_grid->LoadRecordset($grupo_secciones_grid->StartRec-1, $grupo_secciones_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($grupo_secciones->CurrentMode == "add" || $grupo_secciones->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($grupo_secciones->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grupo_secciones->TableCaption() ?></p>
</p>
<?php $grupo_secciones_grid->ShowPageHeader(); ?>
<?php
$grupo_secciones_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_grupo_secciones" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $grupo_secciones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$grupo_secciones_grid->RenderListOptions();

// Render list options (header, left)
$grupo_secciones_grid->ListOptions->Render("header", "left");
?>
<?php if ($grupo_secciones->id_grupo->Visible) { // id_grupo ?>
	<?php if ($grupo_secciones->SortUrl($grupo_secciones->id_grupo) == "") { ?>
		<td><?php echo $grupo_secciones->id_grupo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo_secciones->id_grupo->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo_secciones->id_grupo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo_secciones->id_grupo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo_secciones->id_contenido->Visible) { // id_contenido ?>
	<?php if ($grupo_secciones->SortUrl($grupo_secciones->id_contenido) == "") { ?>
		<td><?php echo $grupo_secciones->id_contenido->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo_secciones->id_contenido->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo_secciones->id_contenido->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo_secciones->id_contenido->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo_secciones->orden->Visible) { // orden ?>
	<?php if ($grupo_secciones->SortUrl($grupo_secciones->orden) == "") { ?>
		<td><?php echo $grupo_secciones->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo_secciones->orden->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo_secciones->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo_secciones->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo_secciones->estatus->Visible) { // estatus ?>
	<?php if ($grupo_secciones->SortUrl($grupo_secciones->estatus) == "") { ?>
		<td><?php echo $grupo_secciones->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo_secciones->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo_secciones->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo_secciones->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$grupo_secciones_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$grupo_secciones_grid->StartRec = 1;
$grupo_secciones_grid->StopRec = $grupo_secciones_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($grupo_secciones->CurrentAction == "gridadd" || $grupo_secciones->CurrentAction == "gridedit" || $grupo_secciones->CurrentAction == "F")) {
		$grupo_secciones_grid->KeyCount = $objForm->GetValue("key_count");
		$grupo_secciones_grid->StopRec = $grupo_secciones_grid->KeyCount;
	}
}
$grupo_secciones_grid->RecCnt = $grupo_secciones_grid->StartRec - 1;
if ($grupo_secciones_grid->Recordset && !$grupo_secciones_grid->Recordset->EOF) {
	$grupo_secciones_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $grupo_secciones_grid->StartRec > 1)
		$grupo_secciones_grid->Recordset->Move($grupo_secciones_grid->StartRec - 1);
} elseif (!$grupo_secciones->AllowAddDeleteRow && $grupo_secciones_grid->StopRec == 0) {
	$grupo_secciones_grid->StopRec = $grupo_secciones->GridAddRowCount;
}

// Initialize aggregate
$grupo_secciones->RowType = EW_ROWTYPE_AGGREGATEINIT;
$grupo_secciones->ResetAttrs();
$grupo_secciones_grid->RenderRow();
$grupo_secciones_grid->RowCnt = 0;
if ($grupo_secciones->CurrentAction == "gridadd")
	$grupo_secciones_grid->RowIndex = 0;
if ($grupo_secciones->CurrentAction == "gridedit")
	$grupo_secciones_grid->RowIndex = 0;
while ($grupo_secciones_grid->RecCnt < $grupo_secciones_grid->StopRec) {
	$grupo_secciones_grid->RecCnt++;
	if (intval($grupo_secciones_grid->RecCnt) >= intval($grupo_secciones_grid->StartRec)) {
		$grupo_secciones_grid->RowCnt++;
		if ($grupo_secciones->CurrentAction == "gridadd" || $grupo_secciones->CurrentAction == "gridedit" || $grupo_secciones->CurrentAction == "F") {
			$grupo_secciones_grid->RowIndex++;
			$objForm->Index = $grupo_secciones_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$grupo_secciones_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($grupo_secciones->CurrentAction == "gridadd")
				$grupo_secciones_grid->RowAction = "insert";
			else
				$grupo_secciones_grid->RowAction = "";
		}

		// Set up key count
		$grupo_secciones_grid->KeyCount = $grupo_secciones_grid->RowIndex;

		// Init row class and style
		$grupo_secciones->ResetAttrs();
		$grupo_secciones->CssClass = "";
		if ($grupo_secciones->CurrentAction == "gridadd") {
			if ($grupo_secciones->CurrentMode == "copy") {
				$grupo_secciones_grid->LoadRowValues($grupo_secciones_grid->Recordset); // Load row values
				$grupo_secciones_grid->SetRecordKey($grupo_secciones_grid->RowOldKey, $grupo_secciones_grid->Recordset); // Set old record key
			} else {
				$grupo_secciones_grid->LoadDefaultValues(); // Load default values
				$grupo_secciones_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($grupo_secciones->CurrentAction == "gridedit") {
			$grupo_secciones_grid->LoadRowValues($grupo_secciones_grid->Recordset); // Load row values
		}
		$grupo_secciones->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($grupo_secciones->CurrentAction == "gridadd") // Grid add
			$grupo_secciones->RowType = EW_ROWTYPE_ADD; // Render add
		if ($grupo_secciones->CurrentAction == "gridadd" && $grupo_secciones->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$grupo_secciones_grid->RestoreCurrentRowFormValues($grupo_secciones_grid->RowIndex); // Restore form values
		if ($grupo_secciones->CurrentAction == "gridedit") { // Grid edit
			if ($grupo_secciones->EventCancelled) {
				$grupo_secciones_grid->RestoreCurrentRowFormValues($grupo_secciones_grid->RowIndex); // Restore form values
			}
			if ($grupo_secciones_grid->RowAction == "insert")
				$grupo_secciones->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$grupo_secciones->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($grupo_secciones->CurrentAction == "gridedit" && ($grupo_secciones->RowType == EW_ROWTYPE_EDIT || $grupo_secciones->RowType == EW_ROWTYPE_ADD) && $grupo_secciones->EventCancelled) // Update failed
			$grupo_secciones_grid->RestoreCurrentRowFormValues($grupo_secciones_grid->RowIndex); // Restore form values
		if ($grupo_secciones->RowType == EW_ROWTYPE_EDIT) // Edit row
			$grupo_secciones_grid->EditRowCnt++;
		if ($grupo_secciones->CurrentAction == "F") // Confirm row
			$grupo_secciones_grid->RestoreCurrentRowFormValues($grupo_secciones_grid->RowIndex); // Restore form values
		if ($grupo_secciones->RowType == EW_ROWTYPE_ADD || $grupo_secciones->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($grupo_secciones->CurrentAction == "edit") {
				$grupo_secciones->RowAttrs = array();
				$grupo_secciones->CssClass = "ewTableEditRow";
			} else {
				$grupo_secciones->RowAttrs = array();
			}
			if (!empty($grupo_secciones_grid->RowIndex))
				$grupo_secciones->RowAttrs = array_merge($grupo_secciones->RowAttrs, array('data-rowindex'=>$grupo_secciones_grid->RowIndex, 'id'=>'r' . $grupo_secciones_grid->RowIndex . '_grupo_secciones'));
		} else {
			$grupo_secciones->RowAttrs = array();
		}

		// Render row
		$grupo_secciones_grid->RenderRow();

		// Render list options
		$grupo_secciones_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($grupo_secciones_grid->RowAction <> "delete" && $grupo_secciones_grid->RowAction <> "insertdelete" && !($grupo_secciones_grid->RowAction == "insert" && $grupo_secciones->CurrentAction == "F" && $grupo_secciones_grid->EmptyRow())) {
?>
	<tr<?php echo $grupo_secciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$grupo_secciones_grid->ListOptions->Render("body", "left");
?>
	<?php if ($grupo_secciones->id_grupo->Visible) { // id_grupo ?>
		<td<?php echo $grupo_secciones->id_grupo->CellAttributes() ?>>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo"<?php echo $grupo_secciones->id_grupo->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->id_grupo->EditValue)) {
	$arwrk = $grupo_secciones->id_grupo->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->id_grupo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $grupo_secciones->id_grupo->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" value="<?php echo ew_HtmlEncode($grupo_secciones->id_grupo->OldValue) ?>">
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo"<?php echo $grupo_secciones->id_grupo->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->id_grupo->EditValue)) {
	$arwrk = $grupo_secciones->id_grupo->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->id_grupo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $grupo_secciones->id_grupo->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $grupo_secciones->id_grupo->ViewAttributes() ?>><?php echo $grupo_secciones->id_grupo->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" value="<?php echo ew_HtmlEncode($grupo_secciones->id_grupo->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" value="<?php echo ew_HtmlEncode($grupo_secciones->id_grupo->OldValue) ?>">
<?php } ?>
<a name="<?php echo $grupo_secciones_grid->PageObjName . "_row_" . $grupo_secciones_grid->RowCnt ?>" id="<?php echo $grupo_secciones_grid->PageObjName . "_row_" . $grupo_secciones_grid->RowCnt ?>"></a>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo_seccion" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo_seccion" value="<?php echo ew_HtmlEncode($grupo_secciones->id_grupo_seccion->OldValue) ?>">
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo_seccion" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo_seccion" value="<?php echo ew_HtmlEncode($grupo_secciones->id_grupo_seccion->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($grupo_secciones->id_contenido->Visible) { // id_contenido ?>
		<td<?php echo $grupo_secciones->id_contenido->CellAttributes() ?>>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($grupo_secciones->id_contenido->getSessionValue() <> "") { ?>
<div<?php echo $grupo_secciones->id_contenido->ViewAttributes() ?>><?php echo $grupo_secciones->id_contenido->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" value="<?php echo ew_HtmlEncode($grupo_secciones->id_contenido->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido"<?php echo $grupo_secciones->id_contenido->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->id_contenido->EditValue)) {
	$arwrk = $grupo_secciones->id_contenido->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->id_contenido->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $grupo_secciones->id_contenido->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" value="<?php echo ew_HtmlEncode($grupo_secciones->id_contenido->OldValue) ?>">
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($grupo_secciones->id_contenido->getSessionValue() <> "") { ?>
<div<?php echo $grupo_secciones->id_contenido->ViewAttributes() ?>><?php echo $grupo_secciones->id_contenido->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" value="<?php echo ew_HtmlEncode($grupo_secciones->id_contenido->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido"<?php echo $grupo_secciones->id_contenido->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->id_contenido->EditValue)) {
	$arwrk = $grupo_secciones->id_contenido->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->id_contenido->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $grupo_secciones->id_contenido->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $grupo_secciones->id_contenido->ViewAttributes() ?>><?php echo $grupo_secciones->id_contenido->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" value="<?php echo ew_HtmlEncode($grupo_secciones->id_contenido->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" value="<?php echo ew_HtmlEncode($grupo_secciones->id_contenido->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($grupo_secciones->orden->Visible) { // orden ?>
		<td<?php echo $grupo_secciones->orden->CellAttributes() ?>>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" size="3" maxlength="3" value="<?php echo $grupo_secciones->orden->EditValue ?>"<?php echo $grupo_secciones->orden->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_orden" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($grupo_secciones->orden->OldValue) ?>">
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" size="3" maxlength="3" value="<?php echo $grupo_secciones->orden->EditValue ?>"<?php echo $grupo_secciones->orden->EditAttributes() ?>>
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $grupo_secciones->orden->ViewAttributes() ?>><?php echo $grupo_secciones->orden->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($grupo_secciones->orden->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_orden" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($grupo_secciones->orden->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($grupo_secciones->estatus->Visible) { // estatus ?>
		<td<?php echo $grupo_secciones->estatus->CellAttributes() ?>>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus"<?php echo $grupo_secciones->estatus->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->estatus->EditValue)) {
	$arwrk = $grupo_secciones->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $grupo_secciones->estatus->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($grupo_secciones->estatus->OldValue) ?>">
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus"<?php echo $grupo_secciones->estatus->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->estatus->EditValue)) {
	$arwrk = $grupo_secciones->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $grupo_secciones->estatus->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $grupo_secciones->estatus->ViewAttributes() ?>><?php echo $grupo_secciones->estatus->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($grupo_secciones->estatus->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($grupo_secciones->estatus->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grupo_secciones_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($grupo_secciones->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($grupo_secciones->CurrentAction <> "gridadd" || $grupo_secciones->CurrentMode == "copy")
		if (!$grupo_secciones_grid->Recordset->EOF) $grupo_secciones_grid->Recordset->MoveNext();
}
?>
<?php
	if ($grupo_secciones->CurrentMode == "add" || $grupo_secciones->CurrentMode == "copy" || $grupo_secciones->CurrentMode == "edit") {
		$grupo_secciones_grid->RowIndex = '$rowindex$';
		$grupo_secciones_grid->LoadDefaultValues();

		// Set row properties
		$grupo_secciones->ResetAttrs();
		$grupo_secciones->RowAttrs = array();
		if (!empty($grupo_secciones_grid->RowIndex))
			$grupo_secciones->RowAttrs = array_merge($grupo_secciones->RowAttrs, array('data-rowindex'=>$grupo_secciones_grid->RowIndex, 'id'=>'r' . $grupo_secciones_grid->RowIndex . '_grupo_secciones'));
		$grupo_secciones->RowType = EW_ROWTYPE_ADD;

		// Render row
		$grupo_secciones_grid->RenderRow();

		// Render list options
		$grupo_secciones_grid->RenderListOptions();

		// Add id and class to the template row
		$grupo_secciones->RowAttrs["id"] = "r0_grupo_secciones";
		ew_AppendClass($grupo_secciones->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $grupo_secciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$grupo_secciones_grid->ListOptions->Render("body", "left");
?>
	<?php if ($grupo_secciones->id_grupo->Visible) { // id_grupo ?>
		<td>
<?php if ($grupo_secciones->CurrentAction <> "F") { ?>
<select id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo"<?php echo $grupo_secciones->id_grupo->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->id_grupo->EditValue)) {
	$arwrk = $grupo_secciones->id_grupo->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->id_grupo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $grupo_secciones->id_grupo->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $grupo_secciones->id_grupo->ViewAttributes() ?>><?php echo $grupo_secciones->id_grupo->ViewValue ?></div>
<input type="hidden" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" value="<?php echo ew_HtmlEncode($grupo_secciones->id_grupo->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_grupo" value="<?php echo ew_HtmlEncode($grupo_secciones->id_grupo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($grupo_secciones->id_contenido->Visible) { // id_contenido ?>
		<td>
<?php if ($grupo_secciones->CurrentAction <> "F") { ?>
<?php if ($grupo_secciones->id_contenido->getSessionValue() <> "") { ?>
<div<?php echo $grupo_secciones->id_contenido->ViewAttributes() ?>><?php echo $grupo_secciones->id_contenido->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" value="<?php echo ew_HtmlEncode($grupo_secciones->id_contenido->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido"<?php echo $grupo_secciones->id_contenido->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->id_contenido->EditValue)) {
	$arwrk = $grupo_secciones->id_contenido->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->id_contenido->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $grupo_secciones->id_contenido->OldValue = "";
?>
</select>
<?php } ?>
<?php } else { ?>
<div<?php echo $grupo_secciones->id_contenido->ViewAttributes() ?>><?php echo $grupo_secciones->id_contenido->ViewValue ?></div>
<input type="hidden" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" value="<?php echo ew_HtmlEncode($grupo_secciones->id_contenido->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_id_contenido" value="<?php echo ew_HtmlEncode($grupo_secciones->id_contenido->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($grupo_secciones->orden->Visible) { // orden ?>
		<td>
<?php if ($grupo_secciones->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" size="3" maxlength="3" value="<?php echo $grupo_secciones->orden->EditValue ?>"<?php echo $grupo_secciones->orden->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $grupo_secciones->orden->ViewAttributes() ?>><?php echo $grupo_secciones->orden->ViewValue ?></div>
<input type="hidden" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($grupo_secciones->orden->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_orden" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($grupo_secciones->orden->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($grupo_secciones->estatus->Visible) { // estatus ?>
		<td>
<?php if ($grupo_secciones->CurrentAction <> "F") { ?>
<select id="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus"<?php echo $grupo_secciones->estatus->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->estatus->EditValue)) {
	$arwrk = $grupo_secciones->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $grupo_secciones->estatus->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $grupo_secciones->estatus->ViewAttributes() ?>><?php echo $grupo_secciones->estatus->ViewValue ?></div>
<input type="hidden" name="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" id="x<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($grupo_secciones->estatus->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" id="o<?php echo $grupo_secciones_grid->RowIndex ?>_estatus" value="<?php echo ew_HtmlEncode($grupo_secciones->estatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grupo_secciones_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($grupo_secciones->CurrentMode == "add" || $grupo_secciones->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $grupo_secciones_grid->KeyCount ?>">
<?php echo $grupo_secciones_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($grupo_secciones->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $grupo_secciones_grid->KeyCount ?>">
<?php echo $grupo_secciones_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="grupo_secciones_grid">
</div>
<?php

// Close recordset
if ($grupo_secciones_grid->Recordset)
	$grupo_secciones_grid->Recordset->Close();
?>
<?php if (($grupo_secciones->CurrentMode == "add" || $grupo_secciones->CurrentMode == "copy" || $grupo_secciones->CurrentMode == "edit") && $grupo_secciones->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($grupo_secciones->AllowAddDeleteRow) { ?>
<?php if ($Security->CanAdd()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($grupo_secciones->Export == "" && $grupo_secciones->CurrentAction == "") { ?>
<?php } ?>
<?php
$grupo_secciones_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$grupo_secciones_grid->Page_Terminate();
$Page =& $MasterPage;
?>
