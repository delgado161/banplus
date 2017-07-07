<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "estado_civilinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$estado_civil_list = new cestado_civil_list();
$Page =& $estado_civil_list;

// Page init
$estado_civil_list->Page_Init();

// Page main
$estado_civil_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($estado_civil->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var estado_civil_list = new ew_Page("estado_civil_list");

// page properties
estado_civil_list.PageID = "list"; // page ID
estado_civil_list.FormID = "festado_civillist"; // form ID
var EW_PAGE_ID = estado_civil_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
estado_civil_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
estado_civil_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
estado_civil_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($estado_civil->Export == "") || (EW_EXPORT_MASTER_RECORD && $estado_civil->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$estado_civil_list->TotalRecs = $estado_civil->SelectRecordCount();
	} else {
		if ($estado_civil_list->Recordset = $estado_civil_list->LoadRecordset())
			$estado_civil_list->TotalRecs = $estado_civil_list->Recordset->RecordCount();
	}
	$estado_civil_list->StartRec = 1;
	if ($estado_civil_list->DisplayRecs <= 0 || ($estado_civil->Export <> "" && $estado_civil->ExportAll)) // Display all records
		$estado_civil_list->DisplayRecs = $estado_civil_list->TotalRecs;
	if (!($estado_civil->Export <> "" && $estado_civil->ExportAll))
		$estado_civil_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$estado_civil_list->Recordset = $estado_civil_list->LoadRecordset($estado_civil_list->StartRec-1, $estado_civil_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $estado_civil->TableCaption() ?>
&nbsp;&nbsp;<?php $estado_civil_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($estado_civil->Export == "" && $estado_civil->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(estado_civil_list);" style="text-decoration: none;"><img id="estado_civil_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="estado_civil_list_SearchPanel">
<form name="festado_civillistsrch" id="festado_civillistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="estado_civil">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($estado_civil->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $estado_civil_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($estado_civil->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($estado_civil->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($estado_civil->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $estado_civil_list->ShowPageHeader(); ?>
<?php
$estado_civil_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="festado_civillist" id="festado_civillist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="estado_civil">
<div id="gmp_estado_civil" class="ewGridMiddlePanel">
<?php if ($estado_civil_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $estado_civil->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$estado_civil_list->RenderListOptions();

// Render list options (header, left)
$estado_civil_list->ListOptions->Render("header", "left");
?>
<?php if ($estado_civil->id_civil->Visible) { // id_civil ?>
	<?php if ($estado_civil->SortUrl($estado_civil->id_civil) == "") { ?>
		<td><?php echo $estado_civil->id_civil->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $estado_civil->SortUrl($estado_civil->id_civil) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $estado_civil->id_civil->FldCaption() ?></td><td style="width: 10px;"><?php if ($estado_civil->id_civil->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($estado_civil->id_civil->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($estado_civil->nombre->Visible) { // nombre ?>
	<?php if ($estado_civil->SortUrl($estado_civil->nombre) == "") { ?>
		<td><?php echo $estado_civil->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $estado_civil->SortUrl($estado_civil->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $estado_civil->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($estado_civil->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($estado_civil->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($estado_civil->visibilidad->Visible) { // visibilidad ?>
	<?php if ($estado_civil->SortUrl($estado_civil->visibilidad) == "") { ?>
		<td><?php echo $estado_civil->visibilidad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $estado_civil->SortUrl($estado_civil->visibilidad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $estado_civil->visibilidad->FldCaption() ?></td><td style="width: 10px;"><?php if ($estado_civil->visibilidad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($estado_civil->visibilidad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$estado_civil_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($estado_civil->ExportAll && $estado_civil->Export <> "") {
	$estado_civil_list->StopRec = $estado_civil_list->TotalRecs;
} else {

	// Set the last record to display
	if ($estado_civil_list->TotalRecs > $estado_civil_list->StartRec + $estado_civil_list->DisplayRecs - 1)
		$estado_civil_list->StopRec = $estado_civil_list->StartRec + $estado_civil_list->DisplayRecs - 1;
	else
		$estado_civil_list->StopRec = $estado_civil_list->TotalRecs;
}
$estado_civil_list->RecCnt = $estado_civil_list->StartRec - 1;
if ($estado_civil_list->Recordset && !$estado_civil_list->Recordset->EOF) {
	$estado_civil_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $estado_civil_list->StartRec > 1)
		$estado_civil_list->Recordset->Move($estado_civil_list->StartRec - 1);
} elseif (!$estado_civil->AllowAddDeleteRow && $estado_civil_list->StopRec == 0) {
	$estado_civil_list->StopRec = $estado_civil->GridAddRowCount;
}

// Initialize aggregate
$estado_civil->RowType = EW_ROWTYPE_AGGREGATEINIT;
$estado_civil->ResetAttrs();
$estado_civil_list->RenderRow();
$estado_civil_list->RowCnt = 0;
while ($estado_civil_list->RecCnt < $estado_civil_list->StopRec) {
	$estado_civil_list->RecCnt++;
	if (intval($estado_civil_list->RecCnt) >= intval($estado_civil_list->StartRec)) {
		$estado_civil_list->RowCnt++;

		// Set up key count
		$estado_civil_list->KeyCount = $estado_civil_list->RowIndex;

		// Init row class and style
		$estado_civil->ResetAttrs();
		$estado_civil->CssClass = "";
		if ($estado_civil->CurrentAction == "gridadd") {
		} else {
			$estado_civil_list->LoadRowValues($estado_civil_list->Recordset); // Load row values
		}
		$estado_civil->RowType = EW_ROWTYPE_VIEW; // Render view
		$estado_civil->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$estado_civil_list->RenderRow();

		// Render list options
		$estado_civil_list->RenderListOptions();
?>
	<tr<?php echo $estado_civil->RowAttributes() ?>>
<?php

// Render list options (body, left)
$estado_civil_list->ListOptions->Render("body", "left");
?>
	<?php if ($estado_civil->id_civil->Visible) { // id_civil ?>
		<td<?php echo $estado_civil->id_civil->CellAttributes() ?>>
<div<?php echo $estado_civil->id_civil->ViewAttributes() ?>><?php echo $estado_civil->id_civil->ListViewValue() ?></div>
<a name="<?php echo $estado_civil_list->PageObjName . "_row_" . $estado_civil_list->RowCnt ?>" id="<?php echo $estado_civil_list->PageObjName . "_row_" . $estado_civil_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($estado_civil->nombre->Visible) { // nombre ?>
		<td<?php echo $estado_civil->nombre->CellAttributes() ?>>
<div<?php echo $estado_civil->nombre->ViewAttributes() ?>><?php echo $estado_civil->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($estado_civil->visibilidad->Visible) { // visibilidad ?>
		<td<?php echo $estado_civil->visibilidad->CellAttributes() ?>>
<div<?php echo $estado_civil->visibilidad->ViewAttributes() ?>><?php echo $estado_civil->visibilidad->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$estado_civil_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($estado_civil->CurrentAction <> "gridadd")
		$estado_civil_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($estado_civil_list->Recordset)
	$estado_civil_list->Recordset->Close();
?>
<?php if ($estado_civil->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($estado_civil->CurrentAction <> "gridadd" && $estado_civil->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($estado_civil_list->Pager)) $estado_civil_list->Pager = new cPrevNextPager($estado_civil_list->StartRec, $estado_civil_list->DisplayRecs, $estado_civil_list->TotalRecs) ?>
<?php if ($estado_civil_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($estado_civil_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $estado_civil_list->PageUrl() ?>start=<?php echo $estado_civil_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($estado_civil_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $estado_civil_list->PageUrl() ?>start=<?php echo $estado_civil_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $estado_civil_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($estado_civil_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $estado_civil_list->PageUrl() ?>start=<?php echo $estado_civil_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($estado_civil_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $estado_civil_list->PageUrl() ?>start=<?php echo $estado_civil_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $estado_civil_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $estado_civil_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $estado_civil_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $estado_civil_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($estado_civil_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $estado_civil_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($estado_civil->Export == "" && $estado_civil->CurrentAction == "") { ?>
<?php } ?>
<?php
$estado_civil_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($estado_civil->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$estado_civil_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cestado_civil_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'estado_civil';

	// Page object name
	var $PageObjName = 'estado_civil_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $estado_civil;
		if ($estado_civil->UseTokenInUrl) $PageUrl .= "t=" . $estado_civil->TableVar . "&"; // Add page token
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
		global $objForm, $estado_civil;
		if ($estado_civil->UseTokenInUrl) {
			if ($objForm)
				return ($estado_civil->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($estado_civil->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cestado_civil_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (estado_civil)
		if (!isset($GLOBALS["estado_civil"])) {
			$GLOBALS["estado_civil"] = new cestado_civil();
			$GLOBALS["Table"] =& $GLOBALS["estado_civil"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "estado_civiladd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "estado_civildelete.php";
		$this->MultiUpdateUrl = "estado_civilupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'estado_civil', TRUE);

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
		global $estado_civil;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$estado_civil->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $estado_civil;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($estado_civil->Export <> "" ||
				$estado_civil->CurrentAction == "gridadd" ||
				$estado_civil->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$estado_civil->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($estado_civil->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $estado_civil->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$estado_civil->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$estado_civil->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$estado_civil->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $estado_civil->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$estado_civil->setSessionWhere($sFilter);
		$estado_civil->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $estado_civil;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $estado_civil->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $estado_civil->id_char, $Keyword);
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
		global $Security, $estado_civil;
		$sSearchStr = "";
		$sSearchKeyword = $estado_civil->BasicSearchKeyword;
		$sSearchType = $estado_civil->BasicSearchType;
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
			$estado_civil->setSessionBasicSearchKeyword($sSearchKeyword);
			$estado_civil->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $estado_civil;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$estado_civil->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $estado_civil;
		$estado_civil->setSessionBasicSearchKeyword("");
		$estado_civil->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $estado_civil;
		$bRestore = TRUE;
		if ($estado_civil->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$estado_civil->BasicSearchKeyword = $estado_civil->getSessionBasicSearchKeyword();
			$estado_civil->BasicSearchType = $estado_civil->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $estado_civil;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$estado_civil->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$estado_civil->CurrentOrderType = @$_GET["ordertype"];
			$estado_civil->UpdateSort($estado_civil->id_civil); // id_civil
			$estado_civil->UpdateSort($estado_civil->nombre); // nombre
			$estado_civil->UpdateSort($estado_civil->visibilidad); // visibilidad
			$estado_civil->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $estado_civil;
		$sOrderBy = $estado_civil->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($estado_civil->SqlOrderBy() <> "") {
				$sOrderBy = $estado_civil->SqlOrderBy();
				$estado_civil->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $estado_civil;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$estado_civil->setSessionOrderBy($sOrderBy);
				$estado_civil->id_civil->setSort("");
				$estado_civil->nombre->setSort("");
				$estado_civil->visibilidad->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$estado_civil->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $estado_civil;

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
		global $Security, $Language, $estado_civil, $objForm;
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
		global $Security, $Language, $estado_civil;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $estado_civil;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$estado_civil->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$estado_civil->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $estado_civil->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$estado_civil->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$estado_civil->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$estado_civil->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $estado_civil;
		$estado_civil->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$estado_civil->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $estado_civil;

		// Call Recordset Selecting event
		$estado_civil->Recordset_Selecting($estado_civil->CurrentFilter);

		// Load List page SQL
		$sSql = $estado_civil->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$estado_civil->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $estado_civil;
		$sFilter = $estado_civil->KeyFilter();

		// Call Row Selecting event
		$estado_civil->Row_Selecting($sFilter);

		// Load SQL based on filter
		$estado_civil->CurrentFilter = $sFilter;
		$sSql = $estado_civil->SQL();
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
		global $conn, $estado_civil;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$estado_civil->Row_Selected($row);
		$estado_civil->id_civil->setDbValue($rs->fields('id_civil'));
		$estado_civil->nombre->setDbValue($rs->fields('nombre'));
		$estado_civil->id_char->setDbValue($rs->fields('id_char'));
		$estado_civil->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Load old record
	function LoadOldRecord() {
		global $estado_civil;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($estado_civil->getKey("id_civil")) <> "")
			$estado_civil->id_civil->CurrentValue = $estado_civil->getKey("id_civil"); // id_civil
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$estado_civil->CurrentFilter = $estado_civil->KeyFilter();
			$sSql = $estado_civil->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $estado_civil;

		// Initialize URLs
		$this->ViewUrl = $estado_civil->ViewUrl();
		$this->EditUrl = $estado_civil->EditUrl();
		$this->InlineEditUrl = $estado_civil->InlineEditUrl();
		$this->CopyUrl = $estado_civil->CopyUrl();
		$this->InlineCopyUrl = $estado_civil->InlineCopyUrl();
		$this->DeleteUrl = $estado_civil->DeleteUrl();

		// Call Row_Rendering event
		$estado_civil->Row_Rendering();

		// Common render codes for all row types
		// id_civil
		// nombre
		// id_char
		// visibilidad

		if ($estado_civil->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_civil
			$estado_civil->id_civil->ViewValue = $estado_civil->id_civil->CurrentValue;
			$estado_civil->id_civil->ViewCustomAttributes = "";

			// nombre
			$estado_civil->nombre->ViewValue = $estado_civil->nombre->CurrentValue;
			$estado_civil->nombre->ViewCustomAttributes = "";

			// id_char
			$estado_civil->id_char->ViewValue = $estado_civil->id_char->CurrentValue;
			$estado_civil->id_char->ViewCustomAttributes = "";

			// visibilidad
			if (strval($estado_civil->visibilidad->CurrentValue) <> "") {
				switch ($estado_civil->visibilidad->CurrentValue) {
					case "1":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(1) <> "" ? $estado_civil->visibilidad->FldTagCaption(1) : $estado_civil->visibilidad->CurrentValue;
						break;
					case "0":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(2) <> "" ? $estado_civil->visibilidad->FldTagCaption(2) : $estado_civil->visibilidad->CurrentValue;
						break;
					default:
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->CurrentValue;
				}
			} else {
				$estado_civil->visibilidad->ViewValue = NULL;
			}
			$estado_civil->visibilidad->ViewCustomAttributes = "";

			// id_civil
			$estado_civil->id_civil->LinkCustomAttributes = "";
			$estado_civil->id_civil->HrefValue = "";
			$estado_civil->id_civil->TooltipValue = "";

			// nombre
			$estado_civil->nombre->LinkCustomAttributes = "";
			$estado_civil->nombre->HrefValue = "";
			$estado_civil->nombre->TooltipValue = "";

			// visibilidad
			$estado_civil->visibilidad->LinkCustomAttributes = "";
			$estado_civil->visibilidad->HrefValue = "";
			$estado_civil->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($estado_civil->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$estado_civil->Row_Rendered();
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
