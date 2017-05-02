<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "contenidosinfo.php" ?>
<?php include_once "grupo_seccionesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$contenidos_list = new ccontenidos_list();
$Page =& $contenidos_list;

// Page init
$contenidos_list->Page_Init();

// Page main
$contenidos_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($contenidos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var contenidos_list = new ew_Page("contenidos_list");

// page properties
contenidos_list.PageID = "list"; // page ID
contenidos_list.FormID = "fcontenidoslist"; // form ID
var EW_PAGE_ID = contenidos_list.PageID; // for backward compatibility

// extend page with ValidateForm function
contenidos_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_edicion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($contenidos->edicion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($contenidos->estatus->FldCaption()) ?>");

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
	}
	return true;
}

// extend page with Form_CustomValidate function
contenidos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contenidos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contenidos_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($contenidos->Export == "") || (EW_EXPORT_MASTER_RECORD && $contenidos->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$contenidos_list->TotalRecs = $contenidos->SelectRecordCount();
	} else {
		if ($contenidos_list->Recordset = $contenidos_list->LoadRecordset())
			$contenidos_list->TotalRecs = $contenidos_list->Recordset->RecordCount();
	}
	$contenidos_list->StartRec = 1;
	if ($contenidos_list->DisplayRecs <= 0 || ($contenidos->Export <> "" && $contenidos->ExportAll)) // Display all records
		$contenidos_list->DisplayRecs = $contenidos_list->TotalRecs;
	if (!($contenidos->Export <> "" && $contenidos->ExportAll))
		$contenidos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$contenidos_list->Recordset = $contenidos_list->LoadRecordset($contenidos_list->StartRec-1, $contenidos_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $contenidos->TableCaption() ?>
&nbsp;&nbsp;<?php $contenidos_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($contenidos->Export == "" && $contenidos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(contenidos_list);" style="text-decoration: none;"><img id="contenidos_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="contenidos_list_SearchPanel">
<form name="fcontenidoslistsrch" id="fcontenidoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="contenidos">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($contenidos->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $contenidos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($contenidos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($contenidos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($contenidos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $contenidos_list->ShowPageHeader(); ?>
<?php
$contenidos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fcontenidoslist" id="fcontenidoslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="contenidos">
<div id="gmp_contenidos" class="ewGridMiddlePanel">
<?php if ($contenidos_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $contenidos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$contenidos_list->RenderListOptions();

// Render list options (header, left)
$contenidos_list->ListOptions->Render("header", "left");
?>
<?php if ($contenidos->titulo->Visible) { // titulo ?>
	<?php if ($contenidos->SortUrl($contenidos->titulo) == "") { ?>
		<td><?php echo $contenidos->titulo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contenidos->SortUrl($contenidos->titulo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contenidos->titulo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($contenidos->titulo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contenidos->titulo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contenidos->edicion->Visible) { // edicion ?>
	<?php if ($contenidos->SortUrl($contenidos->edicion) == "") { ?>
		<td><?php echo $contenidos->edicion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contenidos->SortUrl($contenidos->edicion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contenidos->edicion->FldCaption() ?></td><td style="width: 10px;"><?php if ($contenidos->edicion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contenidos->edicion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contenidos->estatus->Visible) { // estatus ?>
	<?php if ($contenidos->SortUrl($contenidos->estatus) == "") { ?>
		<td><?php echo $contenidos->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contenidos->SortUrl($contenidos->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contenidos->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($contenidos->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contenidos->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$contenidos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($contenidos->ExportAll && $contenidos->Export <> "") {
	$contenidos_list->StopRec = $contenidos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($contenidos_list->TotalRecs > $contenidos_list->StartRec + $contenidos_list->DisplayRecs - 1)
		$contenidos_list->StopRec = $contenidos_list->StartRec + $contenidos_list->DisplayRecs - 1;
	else
		$contenidos_list->StopRec = $contenidos_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($contenidos->CurrentAction == "gridadd" || $contenidos->CurrentAction == "gridedit" || $contenidos->CurrentAction == "F")) {
		$contenidos_list->KeyCount = $objForm->GetValue("key_count");
		$contenidos_list->StopRec = $contenidos_list->KeyCount;
	}
}
$contenidos_list->RecCnt = $contenidos_list->StartRec - 1;
if ($contenidos_list->Recordset && !$contenidos_list->Recordset->EOF) {
	$contenidos_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $contenidos_list->StartRec > 1)
		$contenidos_list->Recordset->Move($contenidos_list->StartRec - 1);
} elseif (!$contenidos->AllowAddDeleteRow && $contenidos_list->StopRec == 0) {
	$contenidos_list->StopRec = $contenidos->GridAddRowCount;
}

// Initialize aggregate
$contenidos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$contenidos->ResetAttrs();
$contenidos_list->RenderRow();
$contenidos_list->RowCnt = 0;
$contenidos_list->EditRowCnt = 0;
if ($contenidos->CurrentAction == "edit")
	$contenidos_list->RowIndex = 1;
while ($contenidos_list->RecCnt < $contenidos_list->StopRec) {
	$contenidos_list->RecCnt++;
	if (intval($contenidos_list->RecCnt) >= intval($contenidos_list->StartRec)) {
		$contenidos_list->RowCnt++;

		// Set up key count
		$contenidos_list->KeyCount = $contenidos_list->RowIndex;

		// Init row class and style
		$contenidos->ResetAttrs();
		$contenidos->CssClass = "";
		if ($contenidos->CurrentAction == "gridadd") {
			$contenidos_list->LoadDefaultValues(); // Load default values
		} else {
			$contenidos_list->LoadRowValues($contenidos_list->Recordset); // Load row values
		}
		$contenidos->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($contenidos->CurrentAction == "edit") {
			if ($contenidos_list->CheckInlineEditKey() && $contenidos_list->EditRowCnt == 0) { // Inline edit
				$contenidos->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($contenidos->CurrentAction == "edit" && $contenidos->RowType == EW_ROWTYPE_EDIT && $contenidos->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$contenidos_list->RestoreFormValues(); // Restore form values
		}
		if ($contenidos->RowType == EW_ROWTYPE_EDIT) // Edit row
			$contenidos_list->EditRowCnt++;
		if ($contenidos->RowType == EW_ROWTYPE_ADD || $contenidos->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($contenidos->CurrentAction == "edit") {
				$contenidos->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
				$contenidos->CssClass = "ewTableEditRow";
			} else {
				$contenidos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
			}
			if (!empty($contenidos_list->RowIndex))
				$contenidos->RowAttrs = array_merge($contenidos->RowAttrs, array('data-rowindex'=>$contenidos_list->RowIndex, 'id'=>'r' . $contenidos_list->RowIndex . '_contenidos'));
		} else {
			$contenidos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		}

		// Render row
		$contenidos_list->RenderRow();

		// Render list options
		$contenidos_list->RenderListOptions();
?>
	<tr<?php echo $contenidos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$contenidos_list->ListOptions->Render("body", "left");
?>
	<?php if ($contenidos->titulo->Visible) { // titulo ?>
		<td<?php echo $contenidos->titulo->CellAttributes() ?>>
<?php if ($contenidos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contenidos_list->RowIndex ?>_titulo" id="x<?php echo $contenidos_list->RowIndex ?>_titulo" size="100" maxlength="100" value="<?php echo $contenidos->titulo->EditValue ?>"<?php echo $contenidos->titulo->EditAttributes() ?>>
<?php } ?>
<?php if ($contenidos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contenidos->titulo->ViewAttributes() ?>><?php echo $contenidos->titulo->ListViewValue() ?></div>
<?php } ?>
<a name="<?php echo $contenidos_list->PageObjName . "_row_" . $contenidos_list->RowCnt ?>" id="<?php echo $contenidos_list->PageObjName . "_row_" . $contenidos_list->RowCnt ?>"></a>
<?php if ($contenidos->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $contenidos_list->RowIndex ?>_id_contenido" id="x<?php echo $contenidos_list->RowIndex ?>_id_contenido" value="<?php echo ew_HtmlEncode($contenidos->id_contenido->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contenidos->edicion->Visible) { // edicion ?>
		<td<?php echo $contenidos->edicion->CellAttributes() ?>>
<?php if ($contenidos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $contenidos_list->RowIndex ?>_edicion" name="x<?php echo $contenidos_list->RowIndex ?>_edicion"<?php echo $contenidos->edicion->EditAttributes() ?>>
<?php
if (is_array($contenidos->edicion->EditValue)) {
	$arwrk = $contenidos->edicion->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($contenidos->edicion->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
<?php if ($contenidos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contenidos->edicion->ViewAttributes() ?>><?php echo $contenidos->edicion->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contenidos->estatus->Visible) { // estatus ?>
		<td<?php echo $contenidos->estatus->CellAttributes() ?>>
<?php if ($contenidos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $contenidos_list->RowIndex ?>_estatus" name="x<?php echo $contenidos_list->RowIndex ?>_estatus"<?php echo $contenidos->estatus->EditAttributes() ?>>
<?php
if (is_array($contenidos->estatus->EditValue)) {
	$arwrk = $contenidos->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($contenidos->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
<?php if ($contenidos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contenidos->estatus->ViewAttributes() ?>><?php echo $contenidos->estatus->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contenidos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($contenidos->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($contenidos->CurrentAction <> "gridadd")
		$contenidos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($contenidos->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $contenidos_list->KeyCount ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($contenidos_list->Recordset)
	$contenidos_list->Recordset->Close();
?>
<?php if ($contenidos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($contenidos->CurrentAction <> "gridadd" && $contenidos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($contenidos_list->Pager)) $contenidos_list->Pager = new cPrevNextPager($contenidos_list->StartRec, $contenidos_list->DisplayRecs, $contenidos_list->TotalRecs) ?>
<?php if ($contenidos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($contenidos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $contenidos_list->PageUrl() ?>start=<?php echo $contenidos_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($contenidos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $contenidos_list->PageUrl() ?>start=<?php echo $contenidos_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $contenidos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($contenidos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $contenidos_list->PageUrl() ?>start=<?php echo $contenidos_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($contenidos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $contenidos_list->PageUrl() ?>start=<?php echo $contenidos_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contenidos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $contenidos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $contenidos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $contenidos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($contenidos_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $contenidos_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($grupo_secciones->DetailAdd && $Security->AllowAdd('grupo_secciones')) { ?>
<a class="ewGridLink" href="<?php echo $contenidos->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=grupo_secciones" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $contenidos->TableCaption() ?>/<?php echo $grupo_secciones->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($contenidos->Export == "" && $contenidos->CurrentAction == "") { ?>
<?php } ?>
<?php
$contenidos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($contenidos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contenidos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccontenidos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'contenidos';

	// Page object name
	var $PageObjName = 'contenidos_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $contenidos;
		if ($contenidos->UseTokenInUrl) $PageUrl .= "t=" . $contenidos->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $contenidos;
		if ($contenidos->UseTokenInUrl) {
			if ($objForm)
				return ($contenidos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($contenidos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccontenidos_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (contenidos)
		if (!isset($GLOBALS["contenidos"])) {
			$GLOBALS["contenidos"] = new ccontenidos();
			$GLOBALS["Table"] =& $GLOBALS["contenidos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "contenidosadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "contenidosdelete.php";
		$this->MultiUpdateUrl = "contenidosupdate.php";

		// Table object (grupo_secciones)
		if (!isset($GLOBALS['grupo_secciones'])) $GLOBALS['grupo_secciones'] = new cgrupo_secciones();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'contenidos', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $contenidos;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Create form object
		$objForm = new cFormObj();

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$contenidos->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $contenidos;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$contenidos->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($contenidos->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($contenidos->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$contenidos->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($contenidos->CurrentAction == "update" || $contenidos->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();
				}
			}

			// Hide all options
			if ($contenidos->Export <> "" ||
				$contenidos->CurrentAction == "gridadd" ||
				$contenidos->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$contenidos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($contenidos->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $contenidos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$contenidos->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$contenidos->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$contenidos->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $contenidos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$contenidos->setSessionWhere($sFilter);
		$contenidos->CurrentFilter = "";
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $contenidos;
		$contenidos->setKey("id_contenido", ""); // Clear inline edit key
		$contenidos->LastAction = $contenidos->CurrentAction; // Save last action
		$contenidos->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $contenidos;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id_contenido"] <> "") {
			$contenidos->id_contenido->setQueryStringValue($_GET["id_contenido"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$contenidos->setKey("id_contenido", $contenidos->id_contenido->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $contenidos;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;	
			if ($this->CheckInlineEditKey()) { // Check key
				$contenidos->SendEmail = TRUE; // Send email on update success
				$bInlineUpdate = $this->EditRow(); // Update record
			} else {
				$bInlineUpdate = FALSE;
			}
		}
		if ($bInlineUpdate) { // Update success
			$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$contenidos->EventCancelled = TRUE; // Cancel event
			$contenidos->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $contenidos;

		//CheckInlineEditKey = True
		if (strval($contenidos->getKey("id_contenido")) <> strval($contenidos->id_contenido->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $contenidos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $contenidos->titulo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $contenidos->resumen, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $contenidos->contenido, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $contenidos->imagen, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $contenidos;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $contenidos->BasicSearchKeyword;
		$sSearchType = $contenidos->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$contenidos->setSessionBasicSearchKeyword($sSearchKeyword);
			$contenidos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $contenidos;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$contenidos->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $contenidos;
		$contenidos->setSessionBasicSearchKeyword("");
		$contenidos->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $contenidos;
		$bRestore = TRUE;
		if ($contenidos->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$contenidos->BasicSearchKeyword = $contenidos->getSessionBasicSearchKeyword();
			$contenidos->BasicSearchType = $contenidos->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $contenidos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$contenidos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$contenidos->CurrentOrderType = @$_GET["ordertype"];
			$contenidos->UpdateSort($contenidos->titulo); // titulo
			$contenidos->UpdateSort($contenidos->edicion); // edicion
			$contenidos->UpdateSort($contenidos->estatus); // estatus
			$contenidos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $contenidos;
		$sOrderBy = $contenidos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($contenidos->SqlOrderBy() <> "") {
				$sOrderBy = $contenidos->SqlOrderBy();
				$contenidos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $contenidos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$contenidos->setSessionOrderBy($sOrderBy);
				$contenidos->titulo->setSort("");
				$contenidos->edicion->setSort("");
				$contenidos->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$contenidos->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $contenidos;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// "detail_grupo_secciones"
		$item =& $this->ListOptions->Add("detail_grupo_secciones");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('grupo_secciones');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $contenidos, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex)) {
			$objForm->Index = $this->RowIndex;
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_action\" id=\"k" . $this->RowIndex . "_action\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue("k_key");
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $contenidos->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($contenidos->CurrentAction == "edit" && $contenidos->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a class=\"ewGridLink\" href=\"\" onclick=\"return ew_SubmitForm(contenidos_list, document.fcontenidoslist, '" . $this->PageName() . "#" . $this->PageObjName . "_row_" . $this->RowCnt . "');\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ewGridLink\" href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			return;
		}

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<span class=\"ewSeparator\">&nbsp;|&nbsp;</span>";
			$oListOpt->Body .= "<a class=\"ewRowLink\" href=\"" . $this->InlineEditUrl . "#" . $this->PageObjName . "_row_" . $this->RowCnt . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";

		// "detail_grupo_secciones"
		$oListOpt =& $this->ListOptions->Items["detail_grupo_secciones"];
		if ($Security->AllowList('grupo_secciones')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("grupo_secciones", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"grupo_seccioneslist.php?" . EW_TABLE_SHOW_MASTER . "=contenidos&id_contenido=" . urlencode(strval($contenidos->id_contenido->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["grupo_secciones"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit('grupo_secciones'))
				$links .= "<a class=\"ewRowLink\" href=\"" . $contenidos->EditUrl(EW_TABLE_SHOW_DETAIL . "=grupo_secciones") . "\">" . $Language->Phrase("EditLink") . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $contenidos;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $contenidos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$contenidos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$contenidos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $contenidos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$contenidos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$contenidos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$contenidos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $contenidos;
		$contenidos->titulo->CurrentValue = NULL;
		$contenidos->titulo->OldValue = $contenidos->titulo->CurrentValue;
		$contenidos->edicion->CurrentValue = NULL;
		$contenidos->edicion->OldValue = $contenidos->edicion->CurrentValue;
		$contenidos->estatus->CurrentValue = NULL;
		$contenidos->estatus->OldValue = $contenidos->estatus->CurrentValue;
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $contenidos;
		$contenidos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$contenidos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $contenidos;
		if (!$contenidos->titulo->FldIsDetailKey) {
			$contenidos->titulo->setFormValue($objForm->GetValue("x_titulo"));
		}
		if (!$contenidos->edicion->FldIsDetailKey) {
			$contenidos->edicion->setFormValue($objForm->GetValue("x_edicion"));
		}
		if (!$contenidos->estatus->FldIsDetailKey) {
			$contenidos->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$contenidos->id_contenido->FldIsDetailKey && $contenidos->CurrentAction <> "gridadd" && $contenidos->CurrentAction <> "add")
			$contenidos->id_contenido->setFormValue($objForm->GetValue("x_id_contenido"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $contenidos;
		if ($contenidos->CurrentAction <> "gridadd" && $contenidos->CurrentAction <> "add")
			$contenidos->id_contenido->CurrentValue = $contenidos->id_contenido->FormValue;
		$contenidos->titulo->CurrentValue = $contenidos->titulo->FormValue;
		$contenidos->edicion->CurrentValue = $contenidos->edicion->FormValue;
		$contenidos->estatus->CurrentValue = $contenidos->estatus->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $contenidos;

		// Call Recordset Selecting event
		$contenidos->Recordset_Selecting($contenidos->CurrentFilter);

		// Load List page SQL
		$sSql = $contenidos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$contenidos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $contenidos;
		$sFilter = $contenidos->KeyFilter();

		// Call Row Selecting event
		$contenidos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$contenidos->CurrentFilter = $sFilter;
		$sSql = $contenidos->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $contenidos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$contenidos->Row_Selected($row);
		$contenidos->id_contenido->setDbValue($rs->fields('id_contenido'));
		$contenidos->titulo->setDbValue($rs->fields('titulo'));
		$contenidos->resumen->setDbValue($rs->fields('resumen'));
		$contenidos->contenido->setDbValue($rs->fields('contenido'));
		$contenidos->imagen->Upload->DbValue = $rs->fields('imagen');
		$contenidos->id_herramienta_financiera->setDbValue($rs->fields('id_herramienta_financiera'));
		$contenidos->edicion->setDbValue($rs->fields('edicion'));
		$contenidos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $contenidos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($contenidos->getKey("id_contenido")) <> "")
			$contenidos->id_contenido->CurrentValue = $contenidos->getKey("id_contenido"); // id_contenido
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$contenidos->CurrentFilter = $contenidos->KeyFilter();
			$sSql = $contenidos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $contenidos;

		// Initialize URLs
		$this->ViewUrl = $contenidos->ViewUrl();
		$this->EditUrl = $contenidos->EditUrl();
		$this->InlineEditUrl = $contenidos->InlineEditUrl();
		$this->CopyUrl = $contenidos->CopyUrl();
		$this->InlineCopyUrl = $contenidos->InlineCopyUrl();
		$this->DeleteUrl = $contenidos->DeleteUrl();

		// Call Row_Rendering event
		$contenidos->Row_Rendering();

		// Common render codes for all row types
		// id_contenido
		// titulo
		// resumen
		// contenido
		// imagen
		// id_herramienta_financiera

		$contenidos->id_herramienta_financiera->CellCssStyle = "white-space: nowrap;";

		// edicion
		// estatus

		if ($contenidos->RowType == EW_ROWTYPE_VIEW) { // View row

			// titulo
			$contenidos->titulo->ViewValue = $contenidos->titulo->CurrentValue;
			$contenidos->titulo->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($contenidos->imagen->Upload->DbValue)) {
				$contenidos->imagen->ViewValue = $contenidos->imagen->Upload->DbValue;
				$contenidos->imagen->ImageWidth = 200;
				$contenidos->imagen->ImageHeight = 50;
				$contenidos->imagen->ImageAlt = $contenidos->imagen->FldAlt();
			} else {
				$contenidos->imagen->ViewValue = "";
			}
			$contenidos->imagen->ViewCustomAttributes = "";

			// id_herramienta_financiera
			if (strval($contenidos->id_herramienta_financiera->CurrentValue) <> "") {
				$sFilterWrk = "`id_modulo_financiero` = " . ew_AdjustSql($contenidos->id_herramienta_financiera->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `modulos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$contenidos->id_herramienta_financiera->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$contenidos->id_herramienta_financiera->ViewValue = $contenidos->id_herramienta_financiera->CurrentValue;
				}
			} else {
				$contenidos->id_herramienta_financiera->ViewValue = NULL;
			}
			$contenidos->id_herramienta_financiera->ViewCustomAttributes = "";

			// edicion
			if (strval($contenidos->edicion->CurrentValue) <> "") {
				switch ($contenidos->edicion->CurrentValue) {
					case "1":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : $contenidos->edicion->CurrentValue;
						break;
					case "3":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : $contenidos->edicion->CurrentValue;
						break;
					case "2":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : $contenidos->edicion->CurrentValue;
						break;
					default:
						$contenidos->edicion->ViewValue = $contenidos->edicion->CurrentValue;
				}
			} else {
				$contenidos->edicion->ViewValue = NULL;
			}
			$contenidos->edicion->ViewCustomAttributes = "";

			// estatus
			if (strval($contenidos->estatus->CurrentValue) <> "") {
				switch ($contenidos->estatus->CurrentValue) {
					case "1":
						$contenidos->estatus->ViewValue = $contenidos->estatus->FldTagCaption(1) <> "" ? $contenidos->estatus->FldTagCaption(1) : $contenidos->estatus->CurrentValue;
						break;
					case "0":
						$contenidos->estatus->ViewValue = $contenidos->estatus->FldTagCaption(2) <> "" ? $contenidos->estatus->FldTagCaption(2) : $contenidos->estatus->CurrentValue;
						break;
					default:
						$contenidos->estatus->ViewValue = $contenidos->estatus->CurrentValue;
				}
			} else {
				$contenidos->estatus->ViewValue = NULL;
			}
			$contenidos->estatus->ViewCustomAttributes = "";

			// titulo
			$contenidos->titulo->LinkCustomAttributes = "";
			$contenidos->titulo->HrefValue = "";
			$contenidos->titulo->TooltipValue = "";

			// edicion
			$contenidos->edicion->LinkCustomAttributes = "";
			$contenidos->edicion->HrefValue = "";
			$contenidos->edicion->TooltipValue = "";

			// estatus
			$contenidos->estatus->LinkCustomAttributes = "";
			$contenidos->estatus->HrefValue = "";
			$contenidos->estatus->TooltipValue = "";
		} elseif ($contenidos->RowType == EW_ROWTYPE_ADD) { // Add row

			// titulo
			$contenidos->titulo->EditCustomAttributes = "";
			$contenidos->titulo->EditValue = ew_HtmlEncode($contenidos->titulo->CurrentValue);

			// edicion
			$contenidos->edicion->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : "1");
			$arwrk[] = array("3", $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : "3");
			$arwrk[] = array("2", $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : "2");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$contenidos->edicion->EditValue = $arwrk;

			// estatus
			$contenidos->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $contenidos->estatus->FldTagCaption(1) <> "" ? $contenidos->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $contenidos->estatus->FldTagCaption(2) <> "" ? $contenidos->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$contenidos->estatus->EditValue = $arwrk;

			// Edit refer script
			// titulo

			$contenidos->titulo->HrefValue = "";

			// edicion
			$contenidos->edicion->HrefValue = "";

			// estatus
			$contenidos->estatus->HrefValue = "";
		} elseif ($contenidos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// titulo
			$contenidos->titulo->EditCustomAttributes = "";
			$contenidos->titulo->EditValue = ew_HtmlEncode($contenidos->titulo->CurrentValue);

			// edicion
			$contenidos->edicion->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : "1");
			$arwrk[] = array("3", $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : "3");
			$arwrk[] = array("2", $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : "2");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$contenidos->edicion->EditValue = $arwrk;

			// estatus
			$contenidos->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $contenidos->estatus->FldTagCaption(1) <> "" ? $contenidos->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $contenidos->estatus->FldTagCaption(2) <> "" ? $contenidos->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$contenidos->estatus->EditValue = $arwrk;

			// Edit refer script
			// titulo

			$contenidos->titulo->HrefValue = "";

			// edicion
			$contenidos->edicion->HrefValue = "";

			// estatus
			$contenidos->estatus->HrefValue = "";
		}
		if ($contenidos->RowType == EW_ROWTYPE_ADD ||
			$contenidos->RowType == EW_ROWTYPE_EDIT ||
			$contenidos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$contenidos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($contenidos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$contenidos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $contenidos;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($contenidos->edicion->FormValue) && $contenidos->edicion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $contenidos->edicion->FldCaption());
		}
		if (!is_null($contenidos->estatus->FormValue) && $contenidos->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $contenidos->estatus->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $contenidos;
		$sFilter = $contenidos->KeyFilter();
		$contenidos->CurrentFilter = $sFilter;
		$sSql = $contenidos->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// titulo
			$contenidos->titulo->SetDbValueDef($rsnew, $contenidos->titulo->CurrentValue, NULL, $contenidos->titulo->ReadOnly);

			// edicion
			$contenidos->edicion->SetDbValueDef($rsnew, $contenidos->edicion->CurrentValue, NULL, $contenidos->edicion->ReadOnly);

			// estatus
			$contenidos->estatus->SetDbValueDef($rsnew, $contenidos->estatus->CurrentValue, NULL, $contenidos->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $contenidos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($contenidos->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($contenidos->CancelMessage <> "") {
					$this->setFailureMessage($contenidos->CancelMessage);
					$contenidos->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$contenidos->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $contenidos;
		$rsnew = array();

		// titulo
		$contenidos->titulo->SetDbValueDef($rsnew, $contenidos->titulo->CurrentValue, NULL, FALSE);

		// edicion
		$contenidos->edicion->SetDbValueDef($rsnew, $contenidos->edicion->CurrentValue, NULL, FALSE);

		// estatus
		$contenidos->estatus->SetDbValueDef($rsnew, $contenidos->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $contenidos->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($contenidos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($contenidos->CancelMessage <> "") {
				$this->setFailureMessage($contenidos->CancelMessage);
				$contenidos->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$contenidos->id_contenido->setDbValue($conn->Insert_ID());
			$rsnew['id_contenido'] = $contenidos->id_contenido->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$contenidos->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
		$dompdf->render();
		ob_end_clean();
		ew_DeleteTmpImages();
		$dompdf->stream($gsExportFile . ".pdf", array("Attachment" => 1)); // 0 to open in browser, 1 to download

//		exit();
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'contenidos';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $contenidos;
		$table = 'contenidos';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_contenido'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($contenidos->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($contenidos->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($contenidos->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($contenidos->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $contenidos;
		$table = 'contenidos';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_contenido'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $contenidos->fields) && $contenidos->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($contenidos->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($contenidos->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
