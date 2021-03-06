<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_municipiosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_municipios_list = new cz_municipios_list();
$Page =& $z_municipios_list;

// Page init
$z_municipios_list->Page_Init();

// Page main
$z_municipios_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_municipios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_municipios_list = new ew_Page("z_municipios_list");

// page properties
z_municipios_list.PageID = "list"; // page ID
z_municipios_list.FormID = "fz_municipioslist"; // form ID
var EW_PAGE_ID = z_municipios_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_municipios_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_municipios_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_municipios_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<style type="text/css">

/* main table preview row color */
.ewTablePreviewRow {
	background-color: inherit; /* preview row */
}
</style>
<script language="JavaScript" type="text/javascript">
<!--

// PreviewRow extension
var ew_AjaxDetailsTimer = null;
var EW_PREVIEW_SINGLE_ROW = false;
var EW_PREVIEW_IMAGE_CLASSNAME = "ewPreviewRowImage";
var EW_PREVIEW_SHOW_IMAGE = "phpimages/expand.gif";
var EW_PREVIEW_HIDE_IMAGE = "phpimages/collapse.gif";
var EW_PREVIEW_LOADING_IMAGE = "phpimages/loading.gif";
var EW_PREVIEW_LOADING_TEXT = ewLanguage.Phrase("Loading"); // lang phrase for loading

// add row
function ew_AddRowToTable(r) {
	var row, cell;
	var tb = ewDom.getAncestorByTagName(r, "TBODY");
	if (EW_PREVIEW_SINGLE_ROW) {
		row = ewDom.getElementBy(function(node) { return ewDom.hasClass(node, EW_TABLE_PREVIEW_ROW_CLASSNAME)}, "TR", tb);
		ew_RemoveRowFromTable(row);
	}
	var sr = ewDom.getNextSiblingBy(r, function(node) { return node.tagName == "TR"});
	if (sr && ewDom.hasClass(sr, EW_TABLE_PREVIEW_ROW_CLASSNAME)) {
		row = sr; // existing sibling row
		if (row && row.cells && row.cells[0])
			cell = row.cells[0];
	} else {
		row = tb.insertRow(r.rowIndex); // new row
		if (row) {
			row.className = EW_TABLE_PREVIEW_ROW_CLASSNAME;
			var cell = row.insertCell(0);
			cell.style.borderRight = "0";
			var colcnt = r.cells.length;
			if (r.cells) {
				var spancnt = 0;
				for (var i = 0; i < colcnt; i++)
					spancnt += r.cells[i].colSpan;
				if (spancnt > 0)
					cell.colSpan = spancnt;
			}
			var pt = ewDom.getAncestorByTagName(row, "TABLE");
			if (pt) ew_SetupTable(pt);
		}
	}
	if (cell)
		cell.innerHTML = "<img src=\"" + EW_PREVIEW_LOADING_IMAGE + "\" style=\"border: 0; vertical-align: middle;\"> " + EW_PREVIEW_LOADING_TEXT;
	return row;
}

// remove row
function ew_RemoveRowFromTable(r) {
	if (r && r.parentNode)
		r.parentNode.removeChild(r);
}

// show results in new table row
var ew_AjaxHandleSuccess2 = function(o) {
	if (o.responseText !== undefined) {
		var row = o.argument.row;
		if (!row || !row.cells || !row.cells[0]) return;
		row.cells[0].innerHTML = o.responseText;
		var ct = ewDom.getElementBy(function(node) { return ewDom.hasClass(node, EW_TABLE_CLASS)}, "TABLE", row);
		if (ct) ew_SetupTable(ct);

		//clearTimeout(ew_AjaxDetailsTimer);
		//setTimeout("alert(ew_AjaxDetailsTimer);", 500);

	}
}

// show error in new table row
var ew_AjaxHandleFailure2 = function(o) {
	var row = o.argument.row;
	if (!row || !row.cells || !row.cells[0]) return;
	row.cells[0].innerHTML = o.responseText;
}

// show detail preview by table row expansion
function ew_AjaxShowDetails2(ev, link, url) {
	var img = ewDom.getElementBy(function(node) { return true; }, "IMG", link);
	var r = ewDom.getAncestorByTagName(link, "TR");
	if (!img || !r)
		return;
	var show = (img.src.substr(img.src.length - EW_PREVIEW_SHOW_IMAGE.length) == EW_PREVIEW_SHOW_IMAGE);
	if (show) {
		if (ew_AjaxDetailsTimer)
			clearTimeout(ew_AjaxDetailsTimer);		
		var row = ew_AddRowToTable(r);
		ew_AjaxDetailsTimer = setTimeout(function() { ewConnect.asyncRequest('GET', url, {success: ew_AjaxHandleSuccess2, failure: ew_AjaxHandleFailure2, argument:{id: link, row: row}}) }, 200);
		ewDom.getElementsByClassName(EW_PREVIEW_IMAGE_CLASSNAME, "IMG", r, function(node) {node.src = EW_PREVIEW_SHOW_IMAGE});
		img.src = EW_PREVIEW_HIDE_IMAGE;
	} else {	 
		var sr = ewDom.getNextSiblingBy(r, function(node) { return node.tagName == "TR"});
		if (sr && ewDom.hasClass(sr, EW_TABLE_PREVIEW_ROW_CLASSNAME))
			ew_RemoveRowFromTable(sr);
		img.src = EW_PREVIEW_SHOW_IMAGE;
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($z_municipios->Export == "") || (EW_EXPORT_MASTER_RECORD && $z_municipios->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$z_municipios_list->TotalRecs = $z_municipios->SelectRecordCount();
	} else {
		if ($z_municipios_list->Recordset = $z_municipios_list->LoadRecordset())
			$z_municipios_list->TotalRecs = $z_municipios_list->Recordset->RecordCount();
	}
	$z_municipios_list->StartRec = 1;
	if ($z_municipios_list->DisplayRecs <= 0 || ($z_municipios->Export <> "" && $z_municipios->ExportAll)) // Display all records
		$z_municipios_list->DisplayRecs = $z_municipios_list->TotalRecs;
	if (!($z_municipios->Export <> "" && $z_municipios->ExportAll))
		$z_municipios_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$z_municipios_list->Recordset = $z_municipios_list->LoadRecordset($z_municipios_list->StartRec-1, $z_municipios_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_municipios->TableCaption() ?>
&nbsp;&nbsp;<?php $z_municipios_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_municipios->Export == "" && $z_municipios->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(z_municipios_list);" style="text-decoration: none;"><img id="z_municipios_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="z_municipios_list_SearchPanel">
<form name="fz_municipioslistsrch" id="fz_municipioslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="z_municipios">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($z_municipios->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $z_municipios_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($z_municipios->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($z_municipios->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($z_municipios->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $z_municipios_list->ShowPageHeader(); ?>
<?php
$z_municipios_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fz_municipioslist" id="fz_municipioslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="z_municipios">
<div id="gmp_z_municipios" class="ewGridMiddlePanel">
<?php if ($z_municipios_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $z_municipios->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$z_municipios_list->RenderListOptions();

// Render list options (header, left)
$z_municipios_list->ListOptions->Render("header", "left");
?>
<?php if ($z_municipios->lp_municipio_id->Visible) { // lp_municipio_id ?>
	<?php if ($z_municipios->SortUrl($z_municipios->lp_municipio_id) == "") { ?>
		<td><?php echo $z_municipios->lp_municipio_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_municipios->SortUrl($z_municipios->lp_municipio_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_municipios->lp_municipio_id->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($z_municipios->lp_municipio_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_municipios->lp_municipio_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_municipios->nombre->Visible) { // nombre ?>
	<?php if ($z_municipios->SortUrl($z_municipios->nombre) == "") { ?>
		<td><?php echo $z_municipios->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_municipios->SortUrl($z_municipios->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_municipios->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($z_municipios->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_municipios->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_municipios->visibilidad->Visible) { // visibilidad ?>
	<?php if ($z_municipios->SortUrl($z_municipios->visibilidad) == "") { ?>
		<td><?php echo $z_municipios->visibilidad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_municipios->SortUrl($z_municipios->visibilidad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_municipios->visibilidad->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_municipios->visibilidad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_municipios->visibilidad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_municipios->lf_estado->Visible) { // lf_estado ?>
	<?php if ($z_municipios->SortUrl($z_municipios->lf_estado) == "") { ?>
		<td><?php echo $z_municipios->lf_estado->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_municipios->SortUrl($z_municipios->lf_estado) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_municipios->lf_estado->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_municipios->lf_estado->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_municipios->lf_estado->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_municipios->pk_municipio->Visible) { // pk_municipio ?>
	<?php if ($z_municipios->SortUrl($z_municipios->pk_municipio) == "") { ?>
		<td><?php echo $z_municipios->pk_municipio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_municipios->SortUrl($z_municipios->pk_municipio) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_municipios->pk_municipio->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_municipios->pk_municipio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_municipios->pk_municipio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$z_municipios_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($z_municipios->ExportAll && $z_municipios->Export <> "") {
	$z_municipios_list->StopRec = $z_municipios_list->TotalRecs;
} else {

	// Set the last record to display
	if ($z_municipios_list->TotalRecs > $z_municipios_list->StartRec + $z_municipios_list->DisplayRecs - 1)
		$z_municipios_list->StopRec = $z_municipios_list->StartRec + $z_municipios_list->DisplayRecs - 1;
	else
		$z_municipios_list->StopRec = $z_municipios_list->TotalRecs;
}
$z_municipios_list->RecCnt = $z_municipios_list->StartRec - 1;
if ($z_municipios_list->Recordset && !$z_municipios_list->Recordset->EOF) {
	$z_municipios_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $z_municipios_list->StartRec > 1)
		$z_municipios_list->Recordset->Move($z_municipios_list->StartRec - 1);
} elseif (!$z_municipios->AllowAddDeleteRow && $z_municipios_list->StopRec == 0) {
	$z_municipios_list->StopRec = $z_municipios->GridAddRowCount;
}

// Initialize aggregate
$z_municipios->RowType = EW_ROWTYPE_AGGREGATEINIT;
$z_municipios->ResetAttrs();
$z_municipios_list->RenderRow();
$z_municipios_list->RowCnt = 0;
while ($z_municipios_list->RecCnt < $z_municipios_list->StopRec) {
	$z_municipios_list->RecCnt++;
	if (intval($z_municipios_list->RecCnt) >= intval($z_municipios_list->StartRec)) {
		$z_municipios_list->RowCnt++;

		// Set up key count
		$z_municipios_list->KeyCount = $z_municipios_list->RowIndex;

		// Init row class and style
		$z_municipios->ResetAttrs();
		$z_municipios->CssClass = "";
		if ($z_municipios->CurrentAction == "gridadd") {
		} else {
			$z_municipios_list->LoadRowValues($z_municipios_list->Recordset); // Load row values
		}
		$z_municipios->RowType = EW_ROWTYPE_VIEW; // Render view
		$z_municipios->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$z_municipios_list->RenderRow();

		// Render list options
		$z_municipios_list->RenderListOptions();
?>
	<tr<?php echo $z_municipios->RowAttributes() ?>>
<?php

// Render list options (body, left)
$z_municipios_list->ListOptions->Render("body", "left");
?>
	<?php if ($z_municipios->lp_municipio_id->Visible) { // lp_municipio_id ?>
		<td<?php echo $z_municipios->lp_municipio_id->CellAttributes() ?>>
<div<?php echo $z_municipios->lp_municipio_id->ViewAttributes() ?>><?php echo $z_municipios->lp_municipio_id->ListViewValue() ?></div>
<a name="<?php echo $z_municipios_list->PageObjName . "_row_" . $z_municipios_list->RowCnt ?>" id="<?php echo $z_municipios_list->PageObjName . "_row_" . $z_municipios_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($z_municipios->nombre->Visible) { // nombre ?>
		<td<?php echo $z_municipios->nombre->CellAttributes() ?>>
<div<?php echo $z_municipios->nombre->ViewAttributes() ?>><?php echo $z_municipios->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_municipios->visibilidad->Visible) { // visibilidad ?>
		<td<?php echo $z_municipios->visibilidad->CellAttributes() ?>>
<div<?php echo $z_municipios->visibilidad->ViewAttributes() ?>><?php echo $z_municipios->visibilidad->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_municipios->lf_estado->Visible) { // lf_estado ?>
		<td<?php echo $z_municipios->lf_estado->CellAttributes() ?>>
<div<?php echo $z_municipios->lf_estado->ViewAttributes() ?>><?php echo $z_municipios->lf_estado->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_municipios->pk_municipio->Visible) { // pk_municipio ?>
		<td<?php echo $z_municipios->pk_municipio->CellAttributes() ?>>
<div<?php echo $z_municipios->pk_municipio->ViewAttributes() ?>><?php echo $z_municipios->pk_municipio->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$z_municipios_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($z_municipios->CurrentAction <> "gridadd")
		$z_municipios_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($z_municipios_list->Recordset)
	$z_municipios_list->Recordset->Close();
?>
<?php if ($z_municipios->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($z_municipios->CurrentAction <> "gridadd" && $z_municipios->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($z_municipios_list->Pager)) $z_municipios_list->Pager = new cPrevNextPager($z_municipios_list->StartRec, $z_municipios_list->DisplayRecs, $z_municipios_list->TotalRecs) ?>
<?php if ($z_municipios_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($z_municipios_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $z_municipios_list->PageUrl() ?>start=<?php echo $z_municipios_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($z_municipios_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $z_municipios_list->PageUrl() ?>start=<?php echo $z_municipios_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $z_municipios_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($z_municipios_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $z_municipios_list->PageUrl() ?>start=<?php echo $z_municipios_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($z_municipios_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $z_municipios_list->PageUrl() ?>start=<?php echo $z_municipios_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $z_municipios_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $z_municipios_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $z_municipios_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $z_municipios_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($z_municipios_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a class="ewGridLink" href="<?php echo $z_municipios_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($z_municipios->Export == "" && $z_municipios->CurrentAction == "") { ?>
<?php } ?>
<?php
$z_municipios_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_municipios->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_municipios_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_municipios_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = '_municipios';

	// Page object name
	var $PageObjName = 'z_municipios_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_municipios;
		if ($z_municipios->UseTokenInUrl) $PageUrl .= "t=" . $z_municipios->TableVar . "&"; // Add page token
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
		global $objForm, $z_municipios;
		if ($z_municipios->UseTokenInUrl) {
			if ($objForm)
				return ($z_municipios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_municipios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_municipios_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_municipios)
		if (!isset($GLOBALS["z_municipios"])) {
			$GLOBALS["z_municipios"] = new cz_municipios();
			$GLOBALS["Table"] =& $GLOBALS["z_municipios"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "z_municipiosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "z_municipiosdelete.php";
		$this->MultiUpdateUrl = "z_municipiosupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_municipios', TRUE);

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
		global $z_municipios;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$z_municipios->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $z_municipios;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($z_municipios->Export <> "" ||
				$z_municipios->CurrentAction == "gridadd" ||
				$z_municipios->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$z_municipios->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($z_municipios->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $z_municipios->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$z_municipios->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$z_municipios->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$z_municipios->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $z_municipios->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$z_municipios->setSessionWhere($sFilter);
		$z_municipios->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $z_municipios;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $z_municipios->lp_municipio_id, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $z_municipios->nombre, $Keyword);
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
		global $Security, $z_municipios;
		$sSearchStr = "";
		$sSearchKeyword = $z_municipios->BasicSearchKeyword;
		$sSearchType = $z_municipios->BasicSearchType;
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
			$z_municipios->setSessionBasicSearchKeyword($sSearchKeyword);
			$z_municipios->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $z_municipios;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$z_municipios->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $z_municipios;
		$z_municipios->setSessionBasicSearchKeyword("");
		$z_municipios->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $z_municipios;
		$bRestore = TRUE;
		if ($z_municipios->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$z_municipios->BasicSearchKeyword = $z_municipios->getSessionBasicSearchKeyword();
			$z_municipios->BasicSearchType = $z_municipios->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $z_municipios;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$z_municipios->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$z_municipios->CurrentOrderType = @$_GET["ordertype"];
			$z_municipios->UpdateSort($z_municipios->lp_municipio_id); // lp_municipio_id
			$z_municipios->UpdateSort($z_municipios->nombre); // nombre
			$z_municipios->UpdateSort($z_municipios->visibilidad); // visibilidad
			$z_municipios->UpdateSort($z_municipios->lf_estado); // lf_estado
			$z_municipios->UpdateSort($z_municipios->pk_municipio); // pk_municipio
			$z_municipios->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $z_municipios;
		$sOrderBy = $z_municipios->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($z_municipios->SqlOrderBy() <> "") {
				$sOrderBy = $z_municipios->SqlOrderBy();
				$z_municipios->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $z_municipios;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$z_municipios->setSessionOrderBy($sOrderBy);
				$z_municipios->lp_municipio_id->setSort("");
				$z_municipios->nombre->setSort("");
				$z_municipios->visibilidad->setSort("");
				$z_municipios->lf_estado->setSort("");
				$z_municipios->pk_municipio->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$z_municipios->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $z_municipios;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $z_municipios, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $z_municipios;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_municipios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_municipios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_municipios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_municipios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_municipios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_municipios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_municipios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $z_municipios;
		$z_municipios->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$z_municipios->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_municipios;

		// Call Recordset Selecting event
		$z_municipios->Recordset_Selecting($z_municipios->CurrentFilter);

		// Load List page SQL
		$sSql = $z_municipios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_municipios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_municipios;
		$sFilter = $z_municipios->KeyFilter();

		// Call Row Selecting event
		$z_municipios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_municipios->CurrentFilter = $sFilter;
		$sSql = $z_municipios->SQL();
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
		global $conn, $z_municipios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_municipios->Row_Selected($row);
		$z_municipios->lp_municipio_id->setDbValue($rs->fields('lp_municipio_id'));
		$z_municipios->nombre->setDbValue($rs->fields('nombre'));
		$z_municipios->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_municipios->lf_estado->setDbValue($rs->fields('lf_estado'));
		$z_municipios->pk_municipio->setDbValue($rs->fields('pk_municipio'));
	}

	// Load old record
	function LoadOldRecord() {
		global $z_municipios;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($z_municipios->getKey("lp_municipio_id")) <> "")
			$z_municipios->lp_municipio_id->CurrentValue = $z_municipios->getKey("lp_municipio_id"); // lp_municipio_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$z_municipios->CurrentFilter = $z_municipios->KeyFilter();
			$sSql = $z_municipios->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_municipios;

		// Initialize URLs
		$this->ViewUrl = $z_municipios->ViewUrl();
		$this->EditUrl = $z_municipios->EditUrl();
		$this->InlineEditUrl = $z_municipios->InlineEditUrl();
		$this->CopyUrl = $z_municipios->CopyUrl();
		$this->InlineCopyUrl = $z_municipios->InlineCopyUrl();
		$this->DeleteUrl = $z_municipios->DeleteUrl();

		// Call Row_Rendering event
		$z_municipios->Row_Rendering();

		// Common render codes for all row types
		// lp_municipio_id
		// nombre
		// visibilidad
		// lf_estado
		// pk_municipio

		if ($z_municipios->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_municipio_id
			$z_municipios->lp_municipio_id->ViewValue = $z_municipios->lp_municipio_id->CurrentValue;
			$z_municipios->lp_municipio_id->ViewCustomAttributes = "";

			// nombre
			$z_municipios->nombre->ViewValue = $z_municipios->nombre->CurrentValue;
			$z_municipios->nombre->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_municipios->visibilidad->CurrentValue) <> "") {
				switch ($z_municipios->visibilidad->CurrentValue) {
					case "1":
						$z_municipios->visibilidad->ViewValue = $z_municipios->visibilidad->FldTagCaption(1) <> "" ? $z_municipios->visibilidad->FldTagCaption(1) : $z_municipios->visibilidad->CurrentValue;
						break;
					case "0":
						$z_municipios->visibilidad->ViewValue = $z_municipios->visibilidad->FldTagCaption(2) <> "" ? $z_municipios->visibilidad->FldTagCaption(2) : $z_municipios->visibilidad->CurrentValue;
						break;
					default:
						$z_municipios->visibilidad->ViewValue = $z_municipios->visibilidad->CurrentValue;
				}
			} else {
				$z_municipios->visibilidad->ViewValue = NULL;
			}
			$z_municipios->visibilidad->ViewCustomAttributes = "";

			// lf_estado
			$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
			if (strval($z_municipios->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_municipios->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_municipios->lf_estado->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
				}
			} else {
				$z_municipios->lf_estado->ViewValue = NULL;
			}
			$z_municipios->lf_estado->ViewCustomAttributes = "";

			// pk_municipio
			$z_municipios->pk_municipio->ViewValue = $z_municipios->pk_municipio->CurrentValue;
			$z_municipios->pk_municipio->ViewCustomAttributes = "";

			// lp_municipio_id
			$z_municipios->lp_municipio_id->LinkCustomAttributes = "";
			$z_municipios->lp_municipio_id->HrefValue = "";
			$z_municipios->lp_municipio_id->TooltipValue = "";

			// nombre
			$z_municipios->nombre->LinkCustomAttributes = "";
			$z_municipios->nombre->HrefValue = "";
			$z_municipios->nombre->TooltipValue = "";

			// visibilidad
			$z_municipios->visibilidad->LinkCustomAttributes = "";
			$z_municipios->visibilidad->HrefValue = "";
			$z_municipios->visibilidad->TooltipValue = "";

			// lf_estado
			$z_municipios->lf_estado->LinkCustomAttributes = "";
			$z_municipios->lf_estado->HrefValue = "";
			$z_municipios->lf_estado->TooltipValue = "";

			// pk_municipio
			$z_municipios->pk_municipio->LinkCustomAttributes = "";
			$z_municipios->pk_municipio->HrefValue = "";
			$z_municipios->pk_municipio->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_municipios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_municipios->Row_Rendered();
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
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
