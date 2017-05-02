<?php include_once "usuariosinfo.php" ?>
<?php

// Create page object
$banner_seccion_grid = new cbanner_seccion_grid();
$MasterPage =& $Page;
$Page =& $banner_seccion_grid;

// Page init
$banner_seccion_grid->Page_Init();

// Page main
$banner_seccion_grid->Page_Main();
?>
<?php if ($banner_seccion->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var banner_seccion_grid = new ew_Page("banner_seccion_grid");

// page properties
banner_seccion_grid.PageID = "grid"; // page ID
banner_seccion_grid.FormID = "fbanner_secciongrid"; // form ID
var EW_PAGE_ID = banner_seccion_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
banner_seccion_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_id_banner"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner_seccion->id_banner->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_grupo_secciones"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner_seccion->id_grupo_secciones->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_grupo_secciones"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($banner_seccion->id_grupo_secciones->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha_inicio"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($banner_seccion->fecha_inicio->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha_fin"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($banner_seccion->fecha_fin->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_id_posicion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner_seccion->id_posicion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner_seccion->orden->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($banner_seccion->orden->FldErrMsg()) ?>");

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
banner_seccion_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "id_banner", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_grupo_secciones", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_inicio", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_fin", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_posicion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "orden", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
banner_seccion_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
banner_seccion_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banner_seccion_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<?php } ?>
<?php
if ($banner_seccion->CurrentAction == "gridadd") {
	if ($banner_seccion->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$banner_seccion_grid->TotalRecs = $banner_seccion->SelectRecordCount();
			$banner_seccion_grid->Recordset = $banner_seccion_grid->LoadRecordset($banner_seccion_grid->StartRec-1, $banner_seccion_grid->DisplayRecs);
		} else {
			if ($banner_seccion_grid->Recordset = $banner_seccion_grid->LoadRecordset())
				$banner_seccion_grid->TotalRecs = $banner_seccion_grid->Recordset->RecordCount();
		}
		$banner_seccion_grid->StartRec = 1;
		$banner_seccion_grid->DisplayRecs = $banner_seccion_grid->TotalRecs;
	} else {
		$banner_seccion->CurrentFilter = "0=1";
		$banner_seccion_grid->StartRec = 1;
		$banner_seccion_grid->DisplayRecs = $banner_seccion->GridAddRowCount;
	}
	$banner_seccion_grid->TotalRecs = $banner_seccion_grid->DisplayRecs;
	$banner_seccion_grid->StopRec = $banner_seccion_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$banner_seccion_grid->TotalRecs = $banner_seccion->SelectRecordCount();
	} else {
		if ($banner_seccion_grid->Recordset = $banner_seccion_grid->LoadRecordset())
			$banner_seccion_grid->TotalRecs = $banner_seccion_grid->Recordset->RecordCount();
	}
	$banner_seccion_grid->StartRec = 1;
	$banner_seccion_grid->DisplayRecs = $banner_seccion_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$banner_seccion_grid->Recordset = $banner_seccion_grid->LoadRecordset($banner_seccion_grid->StartRec-1, $banner_seccion_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($banner_seccion->CurrentMode == "add" || $banner_seccion->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($banner_seccion->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banner_seccion->TableCaption() ?></p>
</p>
<?php $banner_seccion_grid->ShowPageHeader(); ?>
<?php
$banner_seccion_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_banner_seccion" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $banner_seccion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$banner_seccion_grid->RenderListOptions();

// Render list options (header, left)
$banner_seccion_grid->ListOptions->Render("header", "left");
?>
<?php if ($banner_seccion->id_banner->Visible) { // id_banner ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->id_banner) == "") { ?>
		<td><?php echo $banner_seccion->id_banner->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->id_banner->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->id_banner->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->id_banner->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->id_grupo_secciones->Visible) { // id_grupo_secciones ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->id_grupo_secciones) == "") { ?>
		<td><?php echo $banner_seccion->id_grupo_secciones->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->id_grupo_secciones->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->id_grupo_secciones->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->id_grupo_secciones->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->fecha_inicio->Visible) { // fecha_inicio ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->fecha_inicio) == "") { ?>
		<td><?php echo $banner_seccion->fecha_inicio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->fecha_inicio->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->fecha_inicio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->fecha_inicio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->fecha_fin->Visible) { // fecha_fin ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->fecha_fin) == "") { ?>
		<td><?php echo $banner_seccion->fecha_fin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->fecha_fin->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->fecha_fin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->fecha_fin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->id_posicion->Visible) { // id_posicion ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->id_posicion) == "") { ?>
		<td><?php echo $banner_seccion->id_posicion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->id_posicion->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->id_posicion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->id_posicion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->orden->Visible) { // orden ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->orden) == "") { ?>
		<td><?php echo $banner_seccion->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->orden->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$banner_seccion_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$banner_seccion_grid->StartRec = 1;
$banner_seccion_grid->StopRec = $banner_seccion_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($banner_seccion->CurrentAction == "gridadd" || $banner_seccion->CurrentAction == "gridedit" || $banner_seccion->CurrentAction == "F")) {
		$banner_seccion_grid->KeyCount = $objForm->GetValue("key_count");
		$banner_seccion_grid->StopRec = $banner_seccion_grid->KeyCount;
	}
}
$banner_seccion_grid->RecCnt = $banner_seccion_grid->StartRec - 1;
if ($banner_seccion_grid->Recordset && !$banner_seccion_grid->Recordset->EOF) {
	$banner_seccion_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $banner_seccion_grid->StartRec > 1)
		$banner_seccion_grid->Recordset->Move($banner_seccion_grid->StartRec - 1);
} elseif (!$banner_seccion->AllowAddDeleteRow && $banner_seccion_grid->StopRec == 0) {
	$banner_seccion_grid->StopRec = $banner_seccion->GridAddRowCount;
}

// Initialize aggregate
$banner_seccion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$banner_seccion->ResetAttrs();
$banner_seccion_grid->RenderRow();
$banner_seccion_grid->RowCnt = 0;
if ($banner_seccion->CurrentAction == "gridadd")
	$banner_seccion_grid->RowIndex = 0;
if ($banner_seccion->CurrentAction == "gridedit")
	$banner_seccion_grid->RowIndex = 0;
while ($banner_seccion_grid->RecCnt < $banner_seccion_grid->StopRec) {
	$banner_seccion_grid->RecCnt++;
	if (intval($banner_seccion_grid->RecCnt) >= intval($banner_seccion_grid->StartRec)) {
		$banner_seccion_grid->RowCnt++;
		if ($banner_seccion->CurrentAction == "gridadd" || $banner_seccion->CurrentAction == "gridedit" || $banner_seccion->CurrentAction == "F") {
			$banner_seccion_grid->RowIndex++;
			$objForm->Index = $banner_seccion_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$banner_seccion_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($banner_seccion->CurrentAction == "gridadd")
				$banner_seccion_grid->RowAction = "insert";
			else
				$banner_seccion_grid->RowAction = "";
		}

		// Set up key count
		$banner_seccion_grid->KeyCount = $banner_seccion_grid->RowIndex;

		// Init row class and style
		$banner_seccion->ResetAttrs();
		$banner_seccion->CssClass = "";
		if ($banner_seccion->CurrentAction == "gridadd") {
			if ($banner_seccion->CurrentMode == "copy") {
				$banner_seccion_grid->LoadRowValues($banner_seccion_grid->Recordset); // Load row values
				$banner_seccion_grid->SetRecordKey($banner_seccion_grid->RowOldKey, $banner_seccion_grid->Recordset); // Set old record key
			} else {
				$banner_seccion_grid->LoadDefaultValues(); // Load default values
				$banner_seccion_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($banner_seccion->CurrentAction == "gridedit") {
			$banner_seccion_grid->LoadRowValues($banner_seccion_grid->Recordset); // Load row values
		}
		$banner_seccion->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($banner_seccion->CurrentAction == "gridadd") // Grid add
			$banner_seccion->RowType = EW_ROWTYPE_ADD; // Render add
		if ($banner_seccion->CurrentAction == "gridadd" && $banner_seccion->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$banner_seccion_grid->RestoreCurrentRowFormValues($banner_seccion_grid->RowIndex); // Restore form values
		if ($banner_seccion->CurrentAction == "gridedit") { // Grid edit
			if ($banner_seccion->EventCancelled) {
				$banner_seccion_grid->RestoreCurrentRowFormValues($banner_seccion_grid->RowIndex); // Restore form values
			}
			if ($banner_seccion_grid->RowAction == "insert")
				$banner_seccion->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$banner_seccion->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($banner_seccion->CurrentAction == "gridedit" && ($banner_seccion->RowType == EW_ROWTYPE_EDIT || $banner_seccion->RowType == EW_ROWTYPE_ADD) && $banner_seccion->EventCancelled) // Update failed
			$banner_seccion_grid->RestoreCurrentRowFormValues($banner_seccion_grid->RowIndex); // Restore form values
		if ($banner_seccion->RowType == EW_ROWTYPE_EDIT) // Edit row
			$banner_seccion_grid->EditRowCnt++;
		if ($banner_seccion->CurrentAction == "F") // Confirm row
			$banner_seccion_grid->RestoreCurrentRowFormValues($banner_seccion_grid->RowIndex); // Restore form values
		if ($banner_seccion->RowType == EW_ROWTYPE_ADD || $banner_seccion->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($banner_seccion->CurrentAction == "edit") {
				$banner_seccion->RowAttrs = array();
				$banner_seccion->CssClass = "ewTableEditRow";
			} else {
				$banner_seccion->RowAttrs = array();
			}
			if (!empty($banner_seccion_grid->RowIndex))
				$banner_seccion->RowAttrs = array_merge($banner_seccion->RowAttrs, array('data-rowindex'=>$banner_seccion_grid->RowIndex, 'id'=>'r' . $banner_seccion_grid->RowIndex . '_banner_seccion'));
		} else {
			$banner_seccion->RowAttrs = array();
		}

		// Render row
		$banner_seccion_grid->RenderRow();

		// Render list options
		$banner_seccion_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($banner_seccion_grid->RowAction <> "delete" && $banner_seccion_grid->RowAction <> "insertdelete" && !($banner_seccion_grid->RowAction == "insert" && $banner_seccion->CurrentAction == "F" && $banner_seccion_grid->EmptyRow())) {
?>
	<tr<?php echo $banner_seccion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$banner_seccion_grid->ListOptions->Render("body", "left");
?>
	<?php if ($banner_seccion->id_banner->Visible) { // id_banner ?>
		<td<?php echo $banner_seccion->id_banner->CellAttributes() ?>>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($banner_seccion->id_banner->getSessionValue() <> "") { ?>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner"<?php echo $banner_seccion->id_banner->EditAttributes() ?>>
<?php
if (is_array($banner_seccion->id_banner->EditValue)) {
	$arwrk = $banner_seccion->id_banner->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner_seccion->id_banner->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $banner_seccion->id_banner->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner->OldValue) ?>">
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($banner_seccion->id_banner->getSessionValue() <> "") { ?>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner"<?php echo $banner_seccion->id_banner->EditAttributes() ?>>
<?php
if (is_array($banner_seccion->id_banner->EditValue)) {
	$arwrk = $banner_seccion->id_banner->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner_seccion->id_banner->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $banner_seccion->id_banner->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner->OldValue) ?>">
<?php } ?>
<a name="<?php echo $banner_seccion_grid->PageObjName . "_row_" . $banner_seccion_grid->RowCnt ?>" id="<?php echo $banner_seccion_grid->PageObjName . "_row_" . $banner_seccion_grid->RowCnt ?>"></a>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_banner_seccion" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_banner_seccion" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner_seccion->OldValue) ?>">
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner_seccion" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner_seccion" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner_seccion->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($banner_seccion->id_grupo_secciones->Visible) { // id_grupo_secciones ?>
		<td<?php echo $banner_seccion->id_grupo_secciones->CellAttributes() ?>>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" size="30" value="<?php echo $banner_seccion->id_grupo_secciones->EditValue ?>"<?php echo $banner_seccion->id_grupo_secciones->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" value="<?php echo ew_HtmlEncode($banner_seccion->id_grupo_secciones->OldValue) ?>">
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" size="30" value="<?php echo $banner_seccion->id_grupo_secciones->EditValue ?>"<?php echo $banner_seccion->id_grupo_secciones->EditAttributes() ?>>
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $banner_seccion->id_grupo_secciones->ViewAttributes() ?>><?php echo $banner_seccion->id_grupo_secciones->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" value="<?php echo ew_HtmlEncode($banner_seccion->id_grupo_secciones->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" value="<?php echo ew_HtmlEncode($banner_seccion->id_grupo_secciones->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($banner_seccion->fecha_inicio->Visible) { // fecha_inicio ?>
		<td<?php echo $banner_seccion->fecha_inicio->CellAttributes() ?>>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" size="12" value="<?php echo $banner_seccion->fecha_inicio->EditValue ?>"<?php echo $banner_seccion->fecha_inicio->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" name="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" // button id
});
</script>
<input type="hidden" name="fo<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" id="fo<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($banner_seccion->fecha_inicio->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" id="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_inicio->OldValue) ?>">
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" size="12" value="<?php echo $banner_seccion->fecha_inicio->EditValue ?>"<?php echo $banner_seccion->fecha_inicio->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" name="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" // button id
});
</script>
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $banner_seccion->fecha_inicio->ViewAttributes() ?>><?php echo $banner_seccion->fecha_inicio->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_inicio->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" id="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_inicio->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($banner_seccion->fecha_fin->Visible) { // fecha_fin ?>
		<td<?php echo $banner_seccion->fecha_fin->CellAttributes() ?>>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" size="12" value="<?php echo $banner_seccion->fecha_fin->EditValue ?>"<?php echo $banner_seccion->fecha_fin->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" name="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" // button id
});
</script>
<input type="hidden" name="fo<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" id="fo<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($banner_seccion->fecha_fin->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" id="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_fin->OldValue) ?>">
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" size="12" value="<?php echo $banner_seccion->fecha_fin->EditValue ?>"<?php echo $banner_seccion->fecha_fin->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" name="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" // button id
});
</script>
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $banner_seccion->fecha_fin->ViewAttributes() ?>><?php echo $banner_seccion->fecha_fin->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_fin->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" id="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_fin->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($banner_seccion->id_posicion->Visible) { // id_posicion ?>
		<td<?php echo $banner_seccion->id_posicion->CellAttributes() ?>>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion"<?php echo $banner_seccion->id_posicion->EditAttributes() ?>>
<?php
if (is_array($banner_seccion->id_posicion->EditValue)) {
	$arwrk = $banner_seccion->id_posicion->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner_seccion->id_posicion->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $banner_seccion->id_posicion->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" value="<?php echo ew_HtmlEncode($banner_seccion->id_posicion->OldValue) ?>">
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion"<?php echo $banner_seccion->id_posicion->EditAttributes() ?>>
<?php
if (is_array($banner_seccion->id_posicion->EditValue)) {
	$arwrk = $banner_seccion->id_posicion->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner_seccion->id_posicion->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $banner_seccion->id_posicion->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $banner_seccion->id_posicion->ViewAttributes() ?>><?php echo $banner_seccion->id_posicion->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" value="<?php echo ew_HtmlEncode($banner_seccion->id_posicion->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" value="<?php echo ew_HtmlEncode($banner_seccion->id_posicion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($banner_seccion->orden->Visible) { // orden ?>
		<td<?php echo $banner_seccion->orden->CellAttributes() ?>>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" id="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" size="30" value="<?php echo $banner_seccion->orden->EditValue ?>"<?php echo $banner_seccion->orden->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_orden" id="o<?php echo $banner_seccion_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($banner_seccion->orden->OldValue) ?>">
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" id="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" size="30" value="<?php echo $banner_seccion->orden->EditValue ?>"<?php echo $banner_seccion->orden->EditAttributes() ?>>
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $banner_seccion->orden->ViewAttributes() ?>><?php echo $banner_seccion->orden->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" id="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($banner_seccion->orden->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_orden" id="o<?php echo $banner_seccion_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($banner_seccion->orden->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$banner_seccion_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($banner_seccion->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($banner_seccion->CurrentAction <> "gridadd" || $banner_seccion->CurrentMode == "copy")
		if (!$banner_seccion_grid->Recordset->EOF) $banner_seccion_grid->Recordset->MoveNext();
}
?>
<?php
	if ($banner_seccion->CurrentMode == "add" || $banner_seccion->CurrentMode == "copy" || $banner_seccion->CurrentMode == "edit") {
		$banner_seccion_grid->RowIndex = '$rowindex$';
		$banner_seccion_grid->LoadDefaultValues();

		// Set row properties
		$banner_seccion->ResetAttrs();
		$banner_seccion->RowAttrs = array();
		if (!empty($banner_seccion_grid->RowIndex))
			$banner_seccion->RowAttrs = array_merge($banner_seccion->RowAttrs, array('data-rowindex'=>$banner_seccion_grid->RowIndex, 'id'=>'r' . $banner_seccion_grid->RowIndex . '_banner_seccion'));
		$banner_seccion->RowType = EW_ROWTYPE_ADD;

		// Render row
		$banner_seccion_grid->RenderRow();

		// Render list options
		$banner_seccion_grid->RenderListOptions();

		// Add id and class to the template row
		$banner_seccion->RowAttrs["id"] = "r0_banner_seccion";
		ew_AppendClass($banner_seccion->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $banner_seccion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$banner_seccion_grid->ListOptions->Render("body", "left");
?>
	<?php if ($banner_seccion->id_banner->Visible) { // id_banner ?>
		<td>
<?php if ($banner_seccion->CurrentAction <> "F") { ?>
<?php if ($banner_seccion->id_banner->getSessionValue() <> "") { ?>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner"<?php echo $banner_seccion->id_banner->EditAttributes() ?>>
<?php
if (is_array($banner_seccion->id_banner->EditValue)) {
	$arwrk = $banner_seccion->id_banner->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner_seccion->id_banner->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $banner_seccion->id_banner->OldValue = "";
?>
</select>
<?php } ?>
<?php } else { ?>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ViewValue ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_banner" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($banner_seccion->id_grupo_secciones->Visible) { // id_grupo_secciones ?>
		<td>
<?php if ($banner_seccion->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" size="30" value="<?php echo $banner_seccion->id_grupo_secciones->EditValue ?>"<?php echo $banner_seccion->id_grupo_secciones->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $banner_seccion->id_grupo_secciones->ViewAttributes() ?>><?php echo $banner_seccion->id_grupo_secciones->ViewValue ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" value="<?php echo ew_HtmlEncode($banner_seccion->id_grupo_secciones->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_grupo_secciones" value="<?php echo ew_HtmlEncode($banner_seccion->id_grupo_secciones->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($banner_seccion->fecha_inicio->Visible) { // fecha_inicio ?>
		<td>
<?php if ($banner_seccion->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" size="12" value="<?php echo $banner_seccion->fecha_inicio->EditValue ?>"<?php echo $banner_seccion->fecha_inicio->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" name="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" // button id
});
</script>
<?php } else { ?>
<div<?php echo $banner_seccion->fecha_inicio->ViewAttributes() ?>><?php echo $banner_seccion->fecha_inicio->ViewValue ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_inicio->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" id="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_inicio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($banner_seccion->fecha_fin->Visible) { // fecha_fin ?>
		<td>
<?php if ($banner_seccion->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" size="12" value="<?php echo $banner_seccion->fecha_fin->EditValue ?>"<?php echo $banner_seccion->fecha_fin->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" name="cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" // button id
});
</script>
<?php } else { ?>
<div<?php echo $banner_seccion->fecha_fin->ViewAttributes() ?>><?php echo $banner_seccion->fecha_fin->ViewValue ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" id="x<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_fin->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" id="o<?php echo $banner_seccion_grid->RowIndex ?>_fecha_fin" value="<?php echo ew_HtmlEncode($banner_seccion->fecha_fin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($banner_seccion->id_posicion->Visible) { // id_posicion ?>
		<td>
<?php if ($banner_seccion->CurrentAction <> "F") { ?>
<select id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion"<?php echo $banner_seccion->id_posicion->EditAttributes() ?>>
<?php
if (is_array($banner_seccion->id_posicion->EditValue)) {
	$arwrk = $banner_seccion->id_posicion->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner_seccion->id_posicion->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $banner_seccion->id_posicion->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $banner_seccion->id_posicion->ViewAttributes() ?>><?php echo $banner_seccion->id_posicion->ViewValue ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" id="x<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" value="<?php echo ew_HtmlEncode($banner_seccion->id_posicion->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" id="o<?php echo $banner_seccion_grid->RowIndex ?>_id_posicion" value="<?php echo ew_HtmlEncode($banner_seccion->id_posicion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($banner_seccion->orden->Visible) { // orden ?>
		<td>
<?php if ($banner_seccion->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" id="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" size="30" value="<?php echo $banner_seccion->orden->EditValue ?>"<?php echo $banner_seccion->orden->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $banner_seccion->orden->ViewAttributes() ?>><?php echo $banner_seccion->orden->ViewValue ?></div>
<input type="hidden" name="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" id="x<?php echo $banner_seccion_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($banner_seccion->orden->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $banner_seccion_grid->RowIndex ?>_orden" id="o<?php echo $banner_seccion_grid->RowIndex ?>_orden" value="<?php echo ew_HtmlEncode($banner_seccion->orden->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$banner_seccion_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($banner_seccion->CurrentMode == "add" || $banner_seccion->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $banner_seccion_grid->KeyCount ?>">
<?php echo $banner_seccion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($banner_seccion->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $banner_seccion_grid->KeyCount ?>">
<?php echo $banner_seccion_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="banner_seccion_grid">
</div>
<?php

// Close recordset
if ($banner_seccion_grid->Recordset)
	$banner_seccion_grid->Recordset->Close();
?>
<?php if (($banner_seccion->CurrentMode == "add" || $banner_seccion->CurrentMode == "copy" || $banner_seccion->CurrentMode == "edit") && $banner_seccion->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($banner_seccion->AllowAddDeleteRow) { ?>
<?php if ($Security->CanAdd()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($banner_seccion->Export == "" && $banner_seccion->CurrentAction == "") { ?>
<?php } ?>
<?php
$banner_seccion_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$banner_seccion_grid->Page_Terminate();
$Page =& $MasterPage;
?>
