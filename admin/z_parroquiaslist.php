<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_parroquiasinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_parroquias_list = new cz_parroquias_list();
$Page =& $z_parroquias_list;

// Page init
$z_parroquias_list->Page_Init();

// Page main
$z_parroquias_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_parroquias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_parroquias_list = new ew_Page("z_parroquias_list");

// page properties
z_parroquias_list.PageID = "list"; // page ID
z_parroquias_list.FormID = "fz_parroquiaslist"; // form ID
var EW_PAGE_ID = z_parroquias_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_parroquias_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_parroquias_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_parroquias_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($z_parroquias->Export == "") || (EW_EXPORT_MASTER_RECORD && $z_parroquias->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$z_parroquias_list->TotalRecs = $z_parroquias->SelectRecordCount();
	} else {
		if ($z_parroquias_list->Recordset = $z_parroquias_list->LoadRecordset())
			$z_parroquias_list->TotalRecs = $z_parroquias_list->Recordset->RecordCount();
	}
	$z_parroquias_list->StartRec = 1;
	if ($z_parroquias_list->DisplayRecs <= 0 || ($z_parroquias->Export <> "" && $z_parroquias->ExportAll)) // Display all records
		$z_parroquias_list->DisplayRecs = $z_parroquias_list->TotalRecs;
	if (!($z_parroquias->Export <> "" && $z_parroquias->ExportAll))
		$z_parroquias_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$z_parroquias_list->Recordset = $z_parroquias_list->LoadRecordset($z_parroquias_list->StartRec-1, $z_parroquias_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_parroquias->TableCaption() ?>
&nbsp;&nbsp;<?php $z_parroquias_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_parroquias->Export == "" && $z_parroquias->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(z_parroquias_list);" style="text-decoration: none;"><img id="z_parroquias_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="z_parroquias_list_SearchPanel">
<form name="fz_parroquiaslistsrch" id="fz_parroquiaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="z_parroquias">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($z_parroquias->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $z_parroquias_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($z_parroquias->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($z_parroquias->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($z_parroquias->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $z_parroquias_list->ShowPageHeader(); ?>
<?php
$z_parroquias_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fz_parroquiaslist" id="fz_parroquiaslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="z_parroquias">
<div id="gmp_z_parroquias" class="ewGridMiddlePanel">
<?php if ($z_parroquias_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $z_parroquias->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$z_parroquias_list->RenderListOptions();

// Render list options (header, left)
$z_parroquias_list->ListOptions->Render("header", "left");
?>
<?php if ($z_parroquias->nombre->Visible) { // nombre ?>
	<?php if ($z_parroquias->SortUrl($z_parroquias->nombre) == "") { ?>
		<td><?php echo $z_parroquias->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_parroquias->SortUrl($z_parroquias->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_parroquias->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($z_parroquias->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_parroquias->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_parroquias->lf_parroquia_municipio->Visible) { // lf_parroquia_municipio ?>
	<?php if ($z_parroquias->SortUrl($z_parroquias->lf_parroquia_municipio) == "") { ?>
		<td><?php echo $z_parroquias->lf_parroquia_municipio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_parroquias->SortUrl($z_parroquias->lf_parroquia_municipio) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_parroquias->lf_parroquia_municipio->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_parroquias->lf_parroquia_municipio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_parroquias->lf_parroquia_municipio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_parroquias->visibilidad->Visible) { // visibilidad ?>
	<?php if ($z_parroquias->SortUrl($z_parroquias->visibilidad) == "") { ?>
		<td><?php echo $z_parroquias->visibilidad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_parroquias->SortUrl($z_parroquias->visibilidad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_parroquias->visibilidad->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_parroquias->visibilidad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_parroquias->visibilidad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$z_parroquias_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($z_parroquias->ExportAll && $z_parroquias->Export <> "") {
	$z_parroquias_list->StopRec = $z_parroquias_list->TotalRecs;
} else {

	// Set the last record to display
	if ($z_parroquias_list->TotalRecs > $z_parroquias_list->StartRec + $z_parroquias_list->DisplayRecs - 1)
		$z_parroquias_list->StopRec = $z_parroquias_list->StartRec + $z_parroquias_list->DisplayRecs - 1;
	else
		$z_parroquias_list->StopRec = $z_parroquias_list->TotalRecs;
}
$z_parroquias_list->RecCnt = $z_parroquias_list->StartRec - 1;
if ($z_parroquias_list->Recordset && !$z_parroquias_list->Recordset->EOF) {
	$z_parroquias_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $z_parroquias_list->StartRec > 1)
		$z_parroquias_list->Recordset->Move($z_parroquias_list->StartRec - 1);
} elseif (!$z_parroquias->AllowAddDeleteRow && $z_parroquias_list->StopRec == 0) {
	$z_parroquias_list->StopRec = $z_parroquias->GridAddRowCount;
}

// Initialize aggregate
$z_parroquias->RowType = EW_ROWTYPE_AGGREGATEINIT;
$z_parroquias->ResetAttrs();
$z_parroquias_list->RenderRow();
$z_parroquias_list->RowCnt = 0;
while ($z_parroquias_list->RecCnt < $z_parroquias_list->StopRec) {
	$z_parroquias_list->RecCnt++;
	if (intval($z_parroquias_list->RecCnt) >= intval($z_parroquias_list->StartRec)) {
		$z_parroquias_list->RowCnt++;

		// Set up key count
		$z_parroquias_list->KeyCount = $z_parroquias_list->RowIndex;

		// Init row class and style
		$z_parroquias->ResetAttrs();
		$z_parroquias->CssClass = "";
		if ($z_parroquias->CurrentAction == "gridadd") {
		} else {
			$z_parroquias_list->LoadRowValues($z_parroquias_list->Recordset); // Load row values
		}
		$z_parroquias->RowType = EW_ROWTYPE_VIEW; // Render view
		$z_parroquias->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$z_parroquias_list->RenderRow();

		// Render list options
		$z_parroquias_list->RenderListOptions();
?>
	<tr<?php echo $z_parroquias->RowAttributes() ?>>
<?php

// Render list options (body, left)
$z_parroquias_list->ListOptions->Render("body", "left");
?>
	<?php if ($z_parroquias->nombre->Visible) { // nombre ?>
		<td<?php echo $z_parroquias->nombre->CellAttributes() ?>>
<div<?php echo $z_parroquias->nombre->ViewAttributes() ?>><?php echo $z_parroquias->nombre->ListViewValue() ?></div>
<a name="<?php echo $z_parroquias_list->PageObjName . "_row_" . $z_parroquias_list->RowCnt ?>" id="<?php echo $z_parroquias_list->PageObjName . "_row_" . $z_parroquias_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($z_parroquias->lf_parroquia_municipio->Visible) { // lf_parroquia_municipio ?>
		<td<?php echo $z_parroquias->lf_parroquia_municipio->CellAttributes() ?>>
<div<?php echo $z_parroquias->lf_parroquia_municipio->ViewAttributes() ?>><?php echo $z_parroquias->lf_parroquia_municipio->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_parroquias->visibilidad->Visible) { // visibilidad ?>
		<td<?php echo $z_parroquias->visibilidad->CellAttributes() ?>>
<div<?php echo $z_parroquias->visibilidad->ViewAttributes() ?>><?php echo $z_parroquias->visibilidad->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$z_parroquias_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($z_parroquias->CurrentAction <> "gridadd")
		$z_parroquias_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($z_parroquias_list->Recordset)
	$z_parroquias_list->Recordset->Close();
?>
<?php if ($z_parroquias->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($z_parroquias->CurrentAction <> "gridadd" && $z_parroquias->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($z_parroquias_list->Pager)) $z_parroquias_list->Pager = new cPrevNextPager($z_parroquias_list->StartRec, $z_parroquias_list->DisplayRecs, $z_parroquias_list->TotalRecs) ?>
<?php if ($z_parroquias_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($z_parroquias_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $z_parroquias_list->PageUrl() ?>start=<?php echo $z_parroquias_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($z_parroquias_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $z_parroquias_list->PageUrl() ?>start=<?php echo $z_parroquias_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $z_parroquias_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($z_parroquias_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $z_parroquias_list->PageUrl() ?>start=<?php echo $z_parroquias_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($z_parroquias_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $z_parroquias_list->PageUrl() ?>start=<?php echo $z_parroquias_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $z_parroquias_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $z_parroquias_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $z_parroquias_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $z_parroquias_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($z_parroquias_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $z_parroquias_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($z_parroquias->Export == "" && $z_parroquias->CurrentAction == "") { ?>
<?php } ?>
<?php
$z_parroquias_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_parroquias->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_parroquias_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_parroquias_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = '_parroquias';

	// Page object name
	var $PageObjName = 'z_parroquias_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_parroquias;
		if ($z_parroquias->UseTokenInUrl) $PageUrl .= "t=" . $z_parroquias->TableVar . "&"; // Add page token
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
		global $objForm, $z_parroquias;
		if ($z_parroquias->UseTokenInUrl) {
			if ($objForm)
				return ($z_parroquias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_parroquias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_parroquias_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_parroquias)
		if (!isset($GLOBALS["z_parroquias"])) {
			$GLOBALS["z_parroquias"] = new cz_parroquias();
			$GLOBALS["Table"] =& $GLOBALS["z_parroquias"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "z_parroquiasadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "z_parroquiasdelete.php";
		$this->MultiUpdateUrl = "z_parroquiasupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_parroquias', TRUE);

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
		global $z_parroquias;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$z_parroquias->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $z_parroquias;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($z_parroquias->Export <> "" ||
				$z_parroquias->CurrentAction == "gridadd" ||
				$z_parroquias->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$z_parroquias->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($z_parroquias->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $z_parroquias->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$z_parroquias->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$z_parroquias->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$z_parroquias->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $z_parroquias->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$z_parroquias->setSessionWhere($sFilter);
		$z_parroquias->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $z_parroquias;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $z_parroquias->lp_parroquia_id, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $z_parroquias->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $z_parroquias->lf_parroquia_municipio, $Keyword);
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
		global $Security, $z_parroquias;
		$sSearchStr = "";
		$sSearchKeyword = $z_parroquias->BasicSearchKeyword;
		$sSearchType = $z_parroquias->BasicSearchType;
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
			$z_parroquias->setSessionBasicSearchKeyword($sSearchKeyword);
			$z_parroquias->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $z_parroquias;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$z_parroquias->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $z_parroquias;
		$z_parroquias->setSessionBasicSearchKeyword("");
		$z_parroquias->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $z_parroquias;
		$bRestore = TRUE;
		if ($z_parroquias->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$z_parroquias->BasicSearchKeyword = $z_parroquias->getSessionBasicSearchKeyword();
			$z_parroquias->BasicSearchType = $z_parroquias->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $z_parroquias;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$z_parroquias->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$z_parroquias->CurrentOrderType = @$_GET["ordertype"];
			$z_parroquias->UpdateSort($z_parroquias->nombre); // nombre
			$z_parroquias->UpdateSort($z_parroquias->lf_parroquia_municipio); // lf_parroquia_municipio
			$z_parroquias->UpdateSort($z_parroquias->visibilidad); // visibilidad
			$z_parroquias->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $z_parroquias;
		$sOrderBy = $z_parroquias->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($z_parroquias->SqlOrderBy() <> "") {
				$sOrderBy = $z_parroquias->SqlOrderBy();
				$z_parroquias->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $z_parroquias;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$z_parroquias->setSessionOrderBy($sOrderBy);
				$z_parroquias->nombre->setSort("");
				$z_parroquias->lf_parroquia_municipio->setSort("");
				$z_parroquias->visibilidad->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$z_parroquias->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $z_parroquias;

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
		global $Security, $Language, $z_parroquias, $objForm;
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
		global $Security, $Language, $z_parroquias;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_parroquias;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_parroquias->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_parroquias->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_parroquias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_parroquias->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_parroquias->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_parroquias->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $z_parroquias;
		$z_parroquias->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$z_parroquias->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_parroquias;

		// Call Recordset Selecting event
		$z_parroquias->Recordset_Selecting($z_parroquias->CurrentFilter);

		// Load List page SQL
		$sSql = $z_parroquias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_parroquias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_parroquias;
		$sFilter = $z_parroquias->KeyFilter();

		// Call Row Selecting event
		$z_parroquias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_parroquias->CurrentFilter = $sFilter;
		$sSql = $z_parroquias->SQL();
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
		global $conn, $z_parroquias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_parroquias->Row_Selected($row);
		$z_parroquias->lp_parroquia_id->setDbValue($rs->fields('lp_parroquia_id'));
		$z_parroquias->nombre->setDbValue($rs->fields('nombre'));
		$z_parroquias->lf_parroquia_municipio->setDbValue($rs->fields('lf_parroquia_municipio'));
		$z_parroquias->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Load old record
	function LoadOldRecord() {
		global $z_parroquias;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($z_parroquias->getKey("lp_parroquia_id")) <> "")
			$z_parroquias->lp_parroquia_id->CurrentValue = $z_parroquias->getKey("lp_parroquia_id"); // lp_parroquia_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$z_parroquias->CurrentFilter = $z_parroquias->KeyFilter();
			$sSql = $z_parroquias->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_parroquias;

		// Initialize URLs
		$this->ViewUrl = $z_parroquias->ViewUrl();
		$this->EditUrl = $z_parroquias->EditUrl();
		$this->InlineEditUrl = $z_parroquias->InlineEditUrl();
		$this->CopyUrl = $z_parroquias->CopyUrl();
		$this->InlineCopyUrl = $z_parroquias->InlineCopyUrl();
		$this->DeleteUrl = $z_parroquias->DeleteUrl();

		// Call Row_Rendering event
		$z_parroquias->Row_Rendering();

		// Common render codes for all row types
		// lp_parroquia_id
		// nombre
		// lf_parroquia_municipio
		// visibilidad

		if ($z_parroquias->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_parroquia_id
			$z_parroquias->lp_parroquia_id->ViewValue = $z_parroquias->lp_parroquia_id->CurrentValue;
			$z_parroquias->lp_parroquia_id->ViewCustomAttributes = "";

			// nombre
			$z_parroquias->nombre->ViewValue = $z_parroquias->nombre->CurrentValue;
			$z_parroquias->nombre->ViewCustomAttributes = "";

			// lf_parroquia_municipio
			if (strval($z_parroquias->lf_parroquia_municipio->CurrentValue) <> "") {
				$sFilterWrk = "`lp_municipio_id` = '" . ew_AdjustSql($z_parroquias->lf_parroquia_municipio->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nombre` FROM `_municipios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_parroquias->lf_parroquia_municipio->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_parroquias->lf_parroquia_municipio->ViewValue = $z_parroquias->lf_parroquia_municipio->CurrentValue;
				}
			} else {
				$z_parroquias->lf_parroquia_municipio->ViewValue = NULL;
			}
			$z_parroquias->lf_parroquia_municipio->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_parroquias->visibilidad->CurrentValue) <> "") {
				switch ($z_parroquias->visibilidad->CurrentValue) {
					case "1":
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->FldTagCaption(1) <> "" ? $z_parroquias->visibilidad->FldTagCaption(1) : $z_parroquias->visibilidad->CurrentValue;
						break;
					case "0":
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->FldTagCaption(2) <> "" ? $z_parroquias->visibilidad->FldTagCaption(2) : $z_parroquias->visibilidad->CurrentValue;
						break;
					default:
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->CurrentValue;
				}
			} else {
				$z_parroquias->visibilidad->ViewValue = NULL;
			}
			$z_parroquias->visibilidad->ViewCustomAttributes = "";

			// nombre
			$z_parroquias->nombre->LinkCustomAttributes = "";
			$z_parroquias->nombre->HrefValue = "";
			$z_parroquias->nombre->TooltipValue = "";

			// lf_parroquia_municipio
			$z_parroquias->lf_parroquia_municipio->LinkCustomAttributes = "";
			$z_parroquias->lf_parroquia_municipio->HrefValue = "";
			$z_parroquias->lf_parroquia_municipio->TooltipValue = "";

			// visibilidad
			$z_parroquias->visibilidad->LinkCustomAttributes = "";
			$z_parroquias->visibilidad->HrefValue = "";
			$z_parroquias->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_parroquias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_parroquias->Row_Rendered();
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
