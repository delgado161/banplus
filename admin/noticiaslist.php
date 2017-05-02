<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "noticiasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$noticias_list = new cnoticias_list();
$Page =& $noticias_list;

// Page init
$noticias_list->Page_Init();

// Page main
$noticias_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($noticias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var noticias_list = new ew_Page("noticias_list");

// page properties
noticias_list.PageID = "list"; // page ID
noticias_list.FormID = "fnoticiaslist"; // form ID
var EW_PAGE_ID = noticias_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
noticias_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
noticias_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
noticias_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
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
<?php if (($noticias->Export == "") || (EW_EXPORT_MASTER_RECORD && $noticias->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$noticias_list->TotalRecs = $noticias->SelectRecordCount();
	} else {
		if ($noticias_list->Recordset = $noticias_list->LoadRecordset())
			$noticias_list->TotalRecs = $noticias_list->Recordset->RecordCount();
	}
	$noticias_list->StartRec = 1;
	if ($noticias_list->DisplayRecs <= 0 || ($noticias->Export <> "" && $noticias->ExportAll)) // Display all records
		$noticias_list->DisplayRecs = $noticias_list->TotalRecs;
	if (!($noticias->Export <> "" && $noticias->ExportAll))
		$noticias_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$noticias_list->Recordset = $noticias_list->LoadRecordset($noticias_list->StartRec-1, $noticias_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $noticias->TableCaption() ?>
&nbsp;&nbsp;<?php $noticias_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($noticias->Export == "" && $noticias->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(noticias_list);" style="text-decoration: none;"><img id="noticias_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="noticias_list_SearchPanel">
<form name="fnoticiaslistsrch" id="fnoticiaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="noticias">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($noticias->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $noticias_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($noticias->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($noticias->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($noticias->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $noticias_list->ShowPageHeader(); ?>
<?php
$noticias_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fnoticiaslist" id="fnoticiaslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="noticias">
<div id="gmp_noticias" class="ewGridMiddlePanel">
<?php if ($noticias_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $noticias->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$noticias_list->RenderListOptions();

// Render list options (header, left)
$noticias_list->ListOptions->Render("header", "left");
?>
<?php if ($noticias->tipo->Visible) { // tipo ?>
	<?php if ($noticias->SortUrl($noticias->tipo) == "") { ?>
		<td><?php echo $noticias->tipo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $noticias->SortUrl($noticias->tipo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $noticias->tipo->FldCaption() ?></td><td style="width: 10px;"><?php if ($noticias->tipo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($noticias->tipo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($noticias->titulo->Visible) { // titulo ?>
	<?php if ($noticias->SortUrl($noticias->titulo) == "") { ?>
		<td><?php echo $noticias->titulo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $noticias->SortUrl($noticias->titulo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $noticias->titulo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($noticias->titulo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($noticias->titulo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($noticias->id_grupo->Visible) { // id_grupo ?>
	<?php if ($noticias->SortUrl($noticias->id_grupo) == "") { ?>
		<td><?php echo $noticias->id_grupo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $noticias->SortUrl($noticias->id_grupo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $noticias->id_grupo->FldCaption() ?></td><td style="width: 10px;"><?php if ($noticias->id_grupo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($noticias->id_grupo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($noticias->fecha->Visible) { // fecha ?>
	<?php if ($noticias->SortUrl($noticias->fecha) == "") { ?>
		<td><?php echo $noticias->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $noticias->SortUrl($noticias->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $noticias->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($noticias->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($noticias->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($noticias->orden->Visible) { // orden ?>
	<?php if ($noticias->SortUrl($noticias->orden) == "") { ?>
		<td><?php echo $noticias->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $noticias->SortUrl($noticias->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $noticias->orden->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($noticias->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($noticias->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($noticias->estatus->Visible) { // estatus ?>
	<?php if ($noticias->SortUrl($noticias->estatus) == "") { ?>
		<td><?php echo $noticias->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $noticias->SortUrl($noticias->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $noticias->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($noticias->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($noticias->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$noticias_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($noticias->ExportAll && $noticias->Export <> "") {
	$noticias_list->StopRec = $noticias_list->TotalRecs;
} else {

	// Set the last record to display
	if ($noticias_list->TotalRecs > $noticias_list->StartRec + $noticias_list->DisplayRecs - 1)
		$noticias_list->StopRec = $noticias_list->StartRec + $noticias_list->DisplayRecs - 1;
	else
		$noticias_list->StopRec = $noticias_list->TotalRecs;
}
$noticias_list->RecCnt = $noticias_list->StartRec - 1;
if ($noticias_list->Recordset && !$noticias_list->Recordset->EOF) {
	$noticias_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $noticias_list->StartRec > 1)
		$noticias_list->Recordset->Move($noticias_list->StartRec - 1);
} elseif (!$noticias->AllowAddDeleteRow && $noticias_list->StopRec == 0) {
	$noticias_list->StopRec = $noticias->GridAddRowCount;
}

// Initialize aggregate
$noticias->RowType = EW_ROWTYPE_AGGREGATEINIT;
$noticias->ResetAttrs();
$noticias_list->RenderRow();
$noticias_list->RowCnt = 0;
while ($noticias_list->RecCnt < $noticias_list->StopRec) {
	$noticias_list->RecCnt++;
	if (intval($noticias_list->RecCnt) >= intval($noticias_list->StartRec)) {
		$noticias_list->RowCnt++;

		// Set up key count
		$noticias_list->KeyCount = $noticias_list->RowIndex;

		// Init row class and style
		$noticias->ResetAttrs();
		$noticias->CssClass = "";
		if ($noticias->CurrentAction == "gridadd") {
		} else {
			$noticias_list->LoadRowValues($noticias_list->Recordset); // Load row values
		}
		$noticias->RowType = EW_ROWTYPE_VIEW; // Render view
		$noticias->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$noticias_list->RenderRow();

		// Render list options
		$noticias_list->RenderListOptions();
?>
	<tr<?php echo $noticias->RowAttributes() ?>>
<?php

// Render list options (body, left)
$noticias_list->ListOptions->Render("body", "left");
?>
	<?php if ($noticias->tipo->Visible) { // tipo ?>
		<td<?php echo $noticias->tipo->CellAttributes() ?>>
<div<?php echo $noticias->tipo->ViewAttributes() ?>><?php echo $noticias->tipo->ListViewValue() ?></div>
<a name="<?php echo $noticias_list->PageObjName . "_row_" . $noticias_list->RowCnt ?>" id="<?php echo $noticias_list->PageObjName . "_row_" . $noticias_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($noticias->titulo->Visible) { // titulo ?>
		<td<?php echo $noticias->titulo->CellAttributes() ?>>
<div<?php echo $noticias->titulo->ViewAttributes() ?>><?php echo $noticias->titulo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($noticias->id_grupo->Visible) { // id_grupo ?>
		<td<?php echo $noticias->id_grupo->CellAttributes() ?>>
<div<?php echo $noticias->id_grupo->ViewAttributes() ?>><?php echo $noticias->id_grupo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($noticias->fecha->Visible) { // fecha ?>
		<td<?php echo $noticias->fecha->CellAttributes() ?>>
<div<?php echo $noticias->fecha->ViewAttributes() ?>><?php echo $noticias->fecha->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($noticias->orden->Visible) { // orden ?>
		<td<?php echo $noticias->orden->CellAttributes() ?>>
<div<?php echo $noticias->orden->ViewAttributes() ?>><?php echo $noticias->orden->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($noticias->estatus->Visible) { // estatus ?>
		<td<?php echo $noticias->estatus->CellAttributes() ?>>
<div<?php echo $noticias->estatus->ViewAttributes() ?>><?php echo $noticias->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$noticias_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($noticias->CurrentAction <> "gridadd")
		$noticias_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($noticias_list->Recordset)
	$noticias_list->Recordset->Close();
?>
<?php if ($noticias->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($noticias->CurrentAction <> "gridadd" && $noticias->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($noticias_list->Pager)) $noticias_list->Pager = new cPrevNextPager($noticias_list->StartRec, $noticias_list->DisplayRecs, $noticias_list->TotalRecs) ?>
<?php if ($noticias_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($noticias_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $noticias_list->PageUrl() ?>start=<?php echo $noticias_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($noticias_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $noticias_list->PageUrl() ?>start=<?php echo $noticias_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $noticias_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($noticias_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $noticias_list->PageUrl() ?>start=<?php echo $noticias_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($noticias_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $noticias_list->PageUrl() ?>start=<?php echo $noticias_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $noticias_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $noticias_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $noticias_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $noticias_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($noticias_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $noticias_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($noticias->Export == "" && $noticias->CurrentAction == "") { ?>
<?php } ?>
<?php
$noticias_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($noticias->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$noticias_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cnoticias_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'noticias';

	// Page object name
	var $PageObjName = 'noticias_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $noticias;
		if ($noticias->UseTokenInUrl) $PageUrl .= "t=" . $noticias->TableVar . "&"; // Add page token
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
		global $objForm, $noticias;
		if ($noticias->UseTokenInUrl) {
			if ($objForm)
				return ($noticias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($noticias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cnoticias_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (noticias)
		if (!isset($GLOBALS["noticias"])) {
			$GLOBALS["noticias"] = new cnoticias();
			$GLOBALS["Table"] =& $GLOBALS["noticias"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "noticiasadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "noticiasdelete.php";
		$this->MultiUpdateUrl = "noticiasupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'noticias', TRUE);

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
		global $noticias;

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

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$noticias->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $noticias;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($noticias->Export <> "" ||
				$noticias->CurrentAction == "gridadd" ||
				$noticias->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$noticias->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($noticias->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $noticias->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$noticias->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$noticias->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$noticias->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $noticias->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$noticias->setSessionWhere($sFilter);
		$noticias->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $noticias;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $noticias->titulo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $noticias->antetitulo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $noticias->sumario, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $noticias->contenido, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $noticias->imagen, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $noticias->orden, $Keyword);
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
		global $Security, $noticias;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $noticias->BasicSearchKeyword;
		$sSearchType = $noticias->BasicSearchType;
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
			$noticias->setSessionBasicSearchKeyword($sSearchKeyword);
			$noticias->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $noticias;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$noticias->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $noticias;
		$noticias->setSessionBasicSearchKeyword("");
		$noticias->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $noticias;
		$bRestore = TRUE;
		if ($noticias->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$noticias->BasicSearchKeyword = $noticias->getSessionBasicSearchKeyword();
			$noticias->BasicSearchType = $noticias->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $noticias;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$noticias->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$noticias->CurrentOrderType = @$_GET["ordertype"];
			$noticias->UpdateSort($noticias->tipo); // tipo
			$noticias->UpdateSort($noticias->titulo); // titulo
			$noticias->UpdateSort($noticias->id_grupo); // id_grupo
			$noticias->UpdateSort($noticias->fecha); // fecha
			$noticias->UpdateSort($noticias->orden); // orden
			$noticias->UpdateSort($noticias->estatus); // estatus
			$noticias->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $noticias;
		$sOrderBy = $noticias->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($noticias->SqlOrderBy() <> "") {
				$sOrderBy = $noticias->SqlOrderBy();
				$noticias->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $noticias;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$noticias->setSessionOrderBy($sOrderBy);
				$noticias->tipo->setSort("");
				$noticias->titulo->setSort("");
				$noticias->id_grupo->setSort("");
				$noticias->fecha->setSort("");
				$noticias->orden->setSort("");
				$noticias->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$noticias->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $noticias;

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

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $noticias, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $noticias;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $noticias;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$noticias->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$noticias->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $noticias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$noticias->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$noticias->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$noticias->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $noticias;
		$noticias->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$noticias->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $noticias;

		// Call Recordset Selecting event
		$noticias->Recordset_Selecting($noticias->CurrentFilter);

		// Load List page SQL
		$sSql = $noticias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$noticias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $noticias;
		$sFilter = $noticias->KeyFilter();

		// Call Row Selecting event
		$noticias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$noticias->CurrentFilter = $sFilter;
		$sSql = $noticias->SQL();
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
		global $conn, $noticias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$noticias->Row_Selected($row);
		$noticias->id_noticia->setDbValue($rs->fields('id_noticia'));
		$noticias->tipo->setDbValue($rs->fields('tipo'));
		$noticias->titulo->setDbValue($rs->fields('titulo'));
		$noticias->antetitulo->setDbValue($rs->fields('antetitulo'));
		$noticias->sumario->setDbValue($rs->fields('sumario'));
		$noticias->contenido->setDbValue($rs->fields('contenido'));
		$noticias->id_grupo->setDbValue($rs->fields('id_grupo'));
		$noticias->imagen->Upload->DbValue = $rs->fields('imagen');
		$noticias->fecha->setDbValue($rs->fields('fecha'));
		$noticias->orden->setDbValue($rs->fields('orden'));
		$noticias->f_desde->setDbValue($rs->fields('f_desde'));
		$noticias->f_hasta->setDbValue($rs->fields('f_hasta'));
		$noticias->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $noticias;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($noticias->getKey("id_noticia")) <> "")
			$noticias->id_noticia->CurrentValue = $noticias->getKey("id_noticia"); // id_noticia
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$noticias->CurrentFilter = $noticias->KeyFilter();
			$sSql = $noticias->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $noticias;

		// Initialize URLs
		$this->ViewUrl = $noticias->ViewUrl();
		$this->EditUrl = $noticias->EditUrl();
		$this->InlineEditUrl = $noticias->InlineEditUrl();
		$this->CopyUrl = $noticias->CopyUrl();
		$this->InlineCopyUrl = $noticias->InlineCopyUrl();
		$this->DeleteUrl = $noticias->DeleteUrl();

		// Call Row_Rendering event
		$noticias->Row_Rendering();

		// Common render codes for all row types
		// id_noticia

		$noticias->id_noticia->CellCssStyle = "white-space: nowrap;";

		// tipo
		// titulo
		// antetitulo
		// sumario
		// contenido
		// id_grupo
		// imagen
		// fecha
		// orden
		// f_desde
		// f_hasta
		// estatus

		if ($noticias->RowType == EW_ROWTYPE_VIEW) { // View row

			// tipo
			if (strval($noticias->tipo->CurrentValue) <> "") {
				switch ($noticias->tipo->CurrentValue) {
					case "1":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(1) <> "" ? $noticias->tipo->FldTagCaption(1) : $noticias->tipo->CurrentValue;
						break;
					case "2":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(2) <> "" ? $noticias->tipo->FldTagCaption(2) : $noticias->tipo->CurrentValue;
						break;
					case "3":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(3) <> "" ? $noticias->tipo->FldTagCaption(3) : $noticias->tipo->CurrentValue;
						break;
					case "4":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(4) <> "" ? $noticias->tipo->FldTagCaption(4) : $noticias->tipo->CurrentValue;
						break;
					case "5":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(5) <> "" ? $noticias->tipo->FldTagCaption(5) : $noticias->tipo->CurrentValue;
						break;
					default:
						$noticias->tipo->ViewValue = $noticias->tipo->CurrentValue;
				}
			} else {
				$noticias->tipo->ViewValue = NULL;
			}
			$noticias->tipo->ViewCustomAttributes = "";

			// titulo
			$noticias->titulo->ViewValue = $noticias->titulo->CurrentValue;
			$noticias->titulo->ViewCustomAttributes = "";

			// antetitulo
			$noticias->antetitulo->ViewValue = $noticias->antetitulo->CurrentValue;
			$noticias->antetitulo->ViewCustomAttributes = "";

			// id_grupo
			if (strval($noticias->id_grupo->CurrentValue) <> "") {
				$arwrk = explode(",", $noticias->id_grupo->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_grupo` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is null";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$noticias->id_grupo->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$noticias->id_grupo->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $noticias->id_grupo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$noticias->id_grupo->ViewValue = $noticias->id_grupo->CurrentValue;
				}
			} else {
				$noticias->id_grupo->ViewValue = NULL;
			}
			$noticias->id_grupo->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($noticias->imagen->Upload->DbValue)) {
				$noticias->imagen->ViewValue = $noticias->imagen->Upload->DbValue;
				$noticias->imagen->ImageWidth = 150;
				$noticias->imagen->ImageHeight = 30;
				$noticias->imagen->ImageAlt = $noticias->imagen->FldAlt();
			} else {
				$noticias->imagen->ViewValue = "";
			}
			$noticias->imagen->ViewCustomAttributes = "";

			// fecha
			$noticias->fecha->ViewValue = $noticias->fecha->CurrentValue;
			$noticias->fecha->ViewValue = ew_FormatDateTime($noticias->fecha->ViewValue, 7);
			$noticias->fecha->ViewCustomAttributes = "";

			// orden
			$noticias->orden->ViewValue = $noticias->orden->CurrentValue;
			$noticias->orden->ViewCustomAttributes = "";

			// f_desde
			$noticias->f_desde->ViewValue = $noticias->f_desde->CurrentValue;
			$noticias->f_desde->ViewValue = ew_FormatDateTime($noticias->f_desde->ViewValue, 7);
			$noticias->f_desde->ViewCustomAttributes = "";

			// f_hasta
			$noticias->f_hasta->ViewValue = $noticias->f_hasta->CurrentValue;
			$noticias->f_hasta->ViewValue = ew_FormatDateTime($noticias->f_hasta->ViewValue, 7);
			$noticias->f_hasta->ViewCustomAttributes = "";

			// estatus
			if (strval($noticias->estatus->CurrentValue) <> "") {
				switch ($noticias->estatus->CurrentValue) {
					case "1":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(1) <> "" ? $noticias->estatus->FldTagCaption(1) : $noticias->estatus->CurrentValue;
						break;
					case "0":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(2) <> "" ? $noticias->estatus->FldTagCaption(2) : $noticias->estatus->CurrentValue;
						break;
					case "3":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(3) <> "" ? $noticias->estatus->FldTagCaption(3) : $noticias->estatus->CurrentValue;
						break;
					case "4":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(4) <> "" ? $noticias->estatus->FldTagCaption(4) : $noticias->estatus->CurrentValue;
						break;
					default:
						$noticias->estatus->ViewValue = $noticias->estatus->CurrentValue;
				}
			} else {
				$noticias->estatus->ViewValue = NULL;
			}
			$noticias->estatus->ViewCustomAttributes = "";

			// tipo
			$noticias->tipo->LinkCustomAttributes = "";
			$noticias->tipo->HrefValue = "";
			$noticias->tipo->TooltipValue = "";

			// titulo
			$noticias->titulo->LinkCustomAttributes = "";
			$noticias->titulo->HrefValue = "";
			$noticias->titulo->TooltipValue = "";

			// id_grupo
			$noticias->id_grupo->LinkCustomAttributes = "";
			$noticias->id_grupo->HrefValue = "";
			$noticias->id_grupo->TooltipValue = "";

			// fecha
			$noticias->fecha->LinkCustomAttributes = "";
			$noticias->fecha->HrefValue = "";
			$noticias->fecha->TooltipValue = "";

			// orden
			$noticias->orden->LinkCustomAttributes = "";
			$noticias->orden->HrefValue = "";
			$noticias->orden->TooltipValue = "";

			// estatus
			$noticias->estatus->LinkCustomAttributes = "";
			$noticias->estatus->HrefValue = "";
			$noticias->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($noticias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$noticias->Row_Rendered();
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
		$table = 'noticias';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
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
