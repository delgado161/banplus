<?php include_once "usuariosinfo.php" ?>
<?php

// Create page object
$view1_grid = new cview1_grid();
$MasterPage =& $Page;
$Page =& $view1_grid;

// Page init
$view1_grid->Page_Init();

// Page main
$view1_grid->Page_Main();
?>
<?php if ($view1->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var view1_grid = new ew_Page("view1_grid");

// page properties
view1_grid.PageID = "grid"; // page ID
view1_grid.FormID = "fview1grid"; // form ID
var EW_PAGE_ID = view1_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
view1_grid.ValidateForm = function(fobj) {
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
view1_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "titulo", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
view1_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
view1_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view1_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($view1->CurrentAction == "gridadd") {
	if ($view1->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$view1_grid->TotalRecs = $view1->SelectRecordCount();
			$view1_grid->Recordset = $view1_grid->LoadRecordset($view1_grid->StartRec-1, $view1_grid->DisplayRecs);
		} else {
			if ($view1_grid->Recordset = $view1_grid->LoadRecordset())
				$view1_grid->TotalRecs = $view1_grid->Recordset->RecordCount();
		}
		$view1_grid->StartRec = 1;
		$view1_grid->DisplayRecs = $view1_grid->TotalRecs;
	} else {
		$view1->CurrentFilter = "0=1";
		$view1_grid->StartRec = 1;
		$view1_grid->DisplayRecs = $view1->GridAddRowCount;
	}
	$view1_grid->TotalRecs = $view1_grid->DisplayRecs;
	$view1_grid->StopRec = $view1_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$view1_grid->TotalRecs = $view1->SelectRecordCount();
	} else {
		if ($view1_grid->Recordset = $view1_grid->LoadRecordset())
			$view1_grid->TotalRecs = $view1_grid->Recordset->RecordCount();
	}
	$view1_grid->StartRec = 1;
	$view1_grid->DisplayRecs = $view1_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$view1_grid->Recordset = $view1_grid->LoadRecordset($view1_grid->StartRec-1, $view1_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($view1->CurrentMode == "add" || $view1->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($view1->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $view1->TableCaption() ?></p>
</p>
<?php $view1_grid->ShowPageHeader(); ?>
<?php
$view1_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_view1" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $view1->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$view1_grid->RenderListOptions();

// Render list options (header, left)
$view1_grid->ListOptions->Render("header", "left");
?>
<?php if ($view1->id_grupo_seccion->Visible) { // id_grupo_seccion ?>
	<?php if ($view1->SortUrl($view1->id_grupo_seccion) == "") { ?>
		<td><?php echo $view1->id_grupo_seccion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view1->id_grupo_seccion->FldCaption() ?></td><td style="width: 10px;"><?php if ($view1->id_grupo_seccion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->id_grupo_seccion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view1->titulo->Visible) { // titulo ?>
	<?php if ($view1->SortUrl($view1->titulo) == "") { ?>
		<td><?php echo $view1->titulo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view1->titulo->FldCaption() ?></td><td style="width: 10px;"><?php if ($view1->titulo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->titulo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$view1_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$view1_grid->StartRec = 1;
$view1_grid->StopRec = $view1_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($view1->CurrentAction == "gridadd" || $view1->CurrentAction == "gridedit" || $view1->CurrentAction == "F")) {
		$view1_grid->KeyCount = $objForm->GetValue("key_count");
		$view1_grid->StopRec = $view1_grid->KeyCount;
	}
}
$view1_grid->RecCnt = $view1_grid->StartRec - 1;
if ($view1_grid->Recordset && !$view1_grid->Recordset->EOF) {
	$view1_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $view1_grid->StartRec > 1)
		$view1_grid->Recordset->Move($view1_grid->StartRec - 1);
} elseif (!$view1->AllowAddDeleteRow && $view1_grid->StopRec == 0) {
	$view1_grid->StopRec = $view1->GridAddRowCount;
}

// Initialize aggregate
$view1->RowType = EW_ROWTYPE_AGGREGATEINIT;
$view1->ResetAttrs();
$view1_grid->RenderRow();
$view1_grid->RowCnt = 0;
if ($view1->CurrentAction == "gridadd")
	$view1_grid->RowIndex = 0;
if ($view1->CurrentAction == "gridedit")
	$view1_grid->RowIndex = 0;
while ($view1_grid->RecCnt < $view1_grid->StopRec) {
	$view1_grid->RecCnt++;
	if (intval($view1_grid->RecCnt) >= intval($view1_grid->StartRec)) {
		$view1_grid->RowCnt++;
		if ($view1->CurrentAction == "gridadd" || $view1->CurrentAction == "gridedit" || $view1->CurrentAction == "F") {
			$view1_grid->RowIndex++;
			$objForm->Index = $view1_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$view1_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($view1->CurrentAction == "gridadd")
				$view1_grid->RowAction = "insert";
			else
				$view1_grid->RowAction = "";
		}

		// Set up key count
		$view1_grid->KeyCount = $view1_grid->RowIndex;

		// Init row class and style
		$view1->ResetAttrs();
		$view1->CssClass = "";
		if ($view1->CurrentAction == "gridadd") {
			if ($view1->CurrentMode == "copy") {
				$view1_grid->LoadRowValues($view1_grid->Recordset); // Load row values
				$view1_grid->SetRecordKey($view1_grid->RowOldKey, $view1_grid->Recordset); // Set old record key
			} else {
				$view1_grid->LoadDefaultValues(); // Load default values
				$view1_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($view1->CurrentAction == "gridedit") {
			$view1_grid->LoadRowValues($view1_grid->Recordset); // Load row values
		}
		$view1->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($view1->CurrentAction == "gridadd") // Grid add
			$view1->RowType = EW_ROWTYPE_ADD; // Render add
		if ($view1->CurrentAction == "gridadd" && $view1->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$view1_grid->RestoreCurrentRowFormValues($view1_grid->RowIndex); // Restore form values
		if ($view1->CurrentAction == "gridedit") { // Grid edit
			if ($view1->EventCancelled) {
				$view1_grid->RestoreCurrentRowFormValues($view1_grid->RowIndex); // Restore form values
			}
			if ($view1_grid->RowAction == "insert")
				$view1->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$view1->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($view1->CurrentAction == "gridedit" && ($view1->RowType == EW_ROWTYPE_EDIT || $view1->RowType == EW_ROWTYPE_ADD) && $view1->EventCancelled) // Update failed
			$view1_grid->RestoreCurrentRowFormValues($view1_grid->RowIndex); // Restore form values
		if ($view1->RowType == EW_ROWTYPE_EDIT) // Edit row
			$view1_grid->EditRowCnt++;
		if ($view1->CurrentAction == "F") // Confirm row
			$view1_grid->RestoreCurrentRowFormValues($view1_grid->RowIndex); // Restore form values
		if ($view1->RowType == EW_ROWTYPE_ADD || $view1->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($view1->CurrentAction == "edit") {
				$view1->RowAttrs = array();
				$view1->CssClass = "ewTableEditRow";
			} else {
				$view1->RowAttrs = array();
			}
			if (!empty($view1_grid->RowIndex))
				$view1->RowAttrs = array_merge($view1->RowAttrs, array('data-rowindex'=>$view1_grid->RowIndex, 'id'=>'r' . $view1_grid->RowIndex . '_view1'));
		} else {
			$view1->RowAttrs = array();
		}

		// Render row
		$view1_grid->RenderRow();

		// Render list options
		$view1_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($view1_grid->RowAction <> "delete" && $view1_grid->RowAction <> "insertdelete" && !($view1_grid->RowAction == "insert" && $view1->CurrentAction == "F" && $view1_grid->EmptyRow())) {
?>
	<tr<?php echo $view1->RowAttributes() ?>>
<?php

// Render list options (body, left)
$view1_grid->ListOptions->Render("body", "left");
?>
	<?php if ($view1->id_grupo_seccion->Visible) { // id_grupo_seccion ?>
		<td<?php echo $view1->id_grupo_seccion->CellAttributes() ?>>
<?php if ($view1->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $view1_grid->RowIndex ?>_id_grupo_seccion" id="o<?php echo $view1_grid->RowIndex ?>_id_grupo_seccion" value="<?php echo ew_HtmlEncode($view1->id_grupo_seccion->OldValue) ?>">
<?php } ?>
<?php if ($view1->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $view1->id_grupo_seccion->ViewAttributes() ?>><?php echo $view1->id_grupo_seccion->EditValue ?></div>
<input type="hidden" name="x<?php echo $view1_grid->RowIndex ?>_id_grupo_seccion" id="x<?php echo $view1_grid->RowIndex ?>_id_grupo_seccion" value="<?php echo ew_HtmlEncode($view1->id_grupo_seccion->CurrentValue) ?>">
<?php } ?>
<?php if ($view1->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view1->id_grupo_seccion->ViewAttributes() ?>><?php echo $view1->id_grupo_seccion->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $view1_grid->RowIndex ?>_id_grupo_seccion" id="x<?php echo $view1_grid->RowIndex ?>_id_grupo_seccion" value="<?php echo ew_HtmlEncode($view1->id_grupo_seccion->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $view1_grid->RowIndex ?>_id_grupo_seccion" id="o<?php echo $view1_grid->RowIndex ?>_id_grupo_seccion" value="<?php echo ew_HtmlEncode($view1->id_grupo_seccion->OldValue) ?>">
<?php } ?>
<a name="<?php echo $view1_grid->PageObjName . "_row_" . $view1_grid->RowCnt ?>" id="<?php echo $view1_grid->PageObjName . "_row_" . $view1_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($view1->titulo->Visible) { // titulo ?>
		<td<?php echo $view1->titulo->CellAttributes() ?>>
<?php if ($view1->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $view1_grid->RowIndex ?>_titulo" id="x<?php echo $view1_grid->RowIndex ?>_titulo" size="30" maxlength="148" value="<?php echo $view1->titulo->EditValue ?>"<?php echo $view1->titulo->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $view1_grid->RowIndex ?>_titulo" id="o<?php echo $view1_grid->RowIndex ?>_titulo" value="<?php echo ew_HtmlEncode($view1->titulo->OldValue) ?>">
<?php } ?>
<?php if ($view1->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $view1_grid->RowIndex ?>_titulo" id="x<?php echo $view1_grid->RowIndex ?>_titulo" size="30" maxlength="148" value="<?php echo $view1->titulo->EditValue ?>"<?php echo $view1->titulo->EditAttributes() ?>>
<?php } ?>
<?php if ($view1->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view1->titulo->ViewAttributes() ?>><?php echo $view1->titulo->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $view1_grid->RowIndex ?>_titulo" id="x<?php echo $view1_grid->RowIndex ?>_titulo" value="<?php echo ew_HtmlEncode($view1->titulo->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $view1_grid->RowIndex ?>_titulo" id="o<?php echo $view1_grid->RowIndex ?>_titulo" value="<?php echo ew_HtmlEncode($view1->titulo->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view1_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($view1->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($view1->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($view1->CurrentAction <> "gridadd" || $view1->CurrentMode == "copy")
		if (!$view1_grid->Recordset->EOF) $view1_grid->Recordset->MoveNext();
}
?>
<?php
	if ($view1->CurrentMode == "add" || $view1->CurrentMode == "copy" || $view1->CurrentMode == "edit") {
		$view1_grid->RowIndex = '$rowindex$';
		$view1_grid->LoadDefaultValues();

		// Set row properties
		$view1->ResetAttrs();
		$view1->RowAttrs = array();
		if (!empty($view1_grid->RowIndex))
			$view1->RowAttrs = array_merge($view1->RowAttrs, array('data-rowindex'=>$view1_grid->RowIndex, 'id'=>'r' . $view1_grid->RowIndex . '_view1'));
		$view1->RowType = EW_ROWTYPE_ADD;

		// Render row
		$view1_grid->RenderRow();

		// Render list options
		$view1_grid->RenderListOptions();

		// Add id and class to the template row
		$view1->RowAttrs["id"] = "r0_view1";
		ew_AppendClass($view1->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $view1->RowAttributes() ?>>
<?php

// Render list options (body, left)
$view1_grid->ListOptions->Render("body", "left");
?>
	<?php if ($view1->id_grupo_seccion->Visible) { // id_grupo_seccion ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($view1->titulo->Visible) { // titulo ?>
		<td>
<?php if ($view1->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $view1_grid->RowIndex ?>_titulo" id="x<?php echo $view1_grid->RowIndex ?>_titulo" size="30" maxlength="148" value="<?php echo $view1->titulo->EditValue ?>"<?php echo $view1->titulo->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $view1->titulo->ViewAttributes() ?>><?php echo $view1->titulo->ViewValue ?></div>
<input type="hidden" name="x<?php echo $view1_grid->RowIndex ?>_titulo" id="x<?php echo $view1_grid->RowIndex ?>_titulo" value="<?php echo ew_HtmlEncode($view1->titulo->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $view1_grid->RowIndex ?>_titulo" id="o<?php echo $view1_grid->RowIndex ?>_titulo" value="<?php echo ew_HtmlEncode($view1->titulo->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view1_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($view1->CurrentMode == "add" || $view1->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $view1_grid->KeyCount ?>">
<?php echo $view1_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($view1->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $view1_grid->KeyCount ?>">
<?php echo $view1_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="view1_grid">
</div>
<?php

// Close recordset
if ($view1_grid->Recordset)
	$view1_grid->Recordset->Close();
?>
<?php if (($view1->CurrentMode == "add" || $view1->CurrentMode == "copy" || $view1->CurrentMode == "edit") && $view1->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
</div>
<?php } ?>
</td></tr></table>
<?php if ($view1->Export == "" && $view1->CurrentAction == "") { ?>
<?php } ?>
<?php
$view1_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$view1_grid->Page_Terminate();
$Page =& $MasterPage;
?>
