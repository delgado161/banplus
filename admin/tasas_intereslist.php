<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tasas_interesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tasas_interes_list = new ctasas_interes_list();
$Page =& $tasas_interes_list;

// Page init
$tasas_interes_list->Page_Init();

// Page main
$tasas_interes_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($tasas_interes->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tasas_interes_list = new ew_Page("tasas_interes_list");

// page properties
tasas_interes_list.PageID = "list"; // page ID
tasas_interes_list.FormID = "ftasas_intereslist"; // form ID
var EW_PAGE_ID = tasas_interes_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tasas_interes_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tasas_interes_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tasas_interes_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($tasas_interes->Export == "") || (EW_EXPORT_MASTER_RECORD && $tasas_interes->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tasas_interes_list->TotalRecs = $tasas_interes->SelectRecordCount();
	} else {
		if ($tasas_interes_list->Recordset = $tasas_interes_list->LoadRecordset())
			$tasas_interes_list->TotalRecs = $tasas_interes_list->Recordset->RecordCount();
	}
	$tasas_interes_list->StartRec = 1;
	if ($tasas_interes_list->DisplayRecs <= 0 || ($tasas_interes->Export <> "" && $tasas_interes->ExportAll)) // Display all records
		$tasas_interes_list->DisplayRecs = $tasas_interes_list->TotalRecs;
	if (!($tasas_interes->Export <> "" && $tasas_interes->ExportAll))
		$tasas_interes_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$tasas_interes_list->Recordset = $tasas_interes_list->LoadRecordset($tasas_interes_list->StartRec-1, $tasas_interes_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tasas_interes->TableCaption() ?>
&nbsp;&nbsp;<?php $tasas_interes_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tasas_interes->Export == "" && $tasas_interes->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tasas_interes_list);" style="text-decoration: none;"><img id="tasas_interes_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tasas_interes_list_SearchPanel">
<form name="ftasas_intereslistsrch" id="ftasas_intereslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tasas_interes">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tasas_interes->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $tasas_interes_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tasas_interes->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tasas_interes->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tasas_interes->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $tasas_interes_list->ShowPageHeader(); ?>
<?php
$tasas_interes_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="ftasas_intereslist" id="ftasas_intereslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="tasas_interes">
<div id="gmp_tasas_interes" class="ewGridMiddlePanel">
<?php if ($tasas_interes_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tasas_interes->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tasas_interes_list->RenderListOptions();

// Render list options (header, left)
$tasas_interes_list->ListOptions->Render("header", "left");
?>
<?php if ($tasas_interes->inicio->Visible) { // inicio ?>
	<?php if ($tasas_interes->SortUrl($tasas_interes->inicio) == "") { ?>
		<td><?php echo $tasas_interes->inicio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tasas_interes->SortUrl($tasas_interes->inicio) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tasas_interes->inicio->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tasas_interes->inicio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tasas_interes->inicio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tasas_interes->fin->Visible) { // fin ?>
	<?php if ($tasas_interes->SortUrl($tasas_interes->fin) == "") { ?>
		<td><?php echo $tasas_interes->fin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tasas_interes->SortUrl($tasas_interes->fin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tasas_interes->fin->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tasas_interes->fin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tasas_interes->fin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tasas_interes->tasa->Visible) { // tasa ?>
	<?php if ($tasas_interes->SortUrl($tasas_interes->tasa) == "") { ?>
		<td><?php echo $tasas_interes->tasa->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tasas_interes->SortUrl($tasas_interes->tasa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tasas_interes->tasa->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tasas_interes->tasa->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tasas_interes->tasa->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tasas_interes->tipo->Visible) { // tipo ?>
	<?php if ($tasas_interes->SortUrl($tasas_interes->tipo) == "") { ?>
		<td><?php echo $tasas_interes->tipo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tasas_interes->SortUrl($tasas_interes->tipo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tasas_interes->tipo->FldCaption() ?></td><td style="width: 10px;"><?php if ($tasas_interes->tipo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tasas_interes->tipo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tasas_interes->estatus->Visible) { // estatus ?>
	<?php if ($tasas_interes->SortUrl($tasas_interes->estatus) == "") { ?>
		<td><?php echo $tasas_interes->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tasas_interes->SortUrl($tasas_interes->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tasas_interes->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($tasas_interes->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tasas_interes->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tasas_interes_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($tasas_interes->ExportAll && $tasas_interes->Export <> "") {
	$tasas_interes_list->StopRec = $tasas_interes_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tasas_interes_list->TotalRecs > $tasas_interes_list->StartRec + $tasas_interes_list->DisplayRecs - 1)
		$tasas_interes_list->StopRec = $tasas_interes_list->StartRec + $tasas_interes_list->DisplayRecs - 1;
	else
		$tasas_interes_list->StopRec = $tasas_interes_list->TotalRecs;
}
$tasas_interes_list->RecCnt = $tasas_interes_list->StartRec - 1;
if ($tasas_interes_list->Recordset && !$tasas_interes_list->Recordset->EOF) {
	$tasas_interes_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $tasas_interes_list->StartRec > 1)
		$tasas_interes_list->Recordset->Move($tasas_interes_list->StartRec - 1);
} elseif (!$tasas_interes->AllowAddDeleteRow && $tasas_interes_list->StopRec == 0) {
	$tasas_interes_list->StopRec = $tasas_interes->GridAddRowCount;
}

// Initialize aggregate
$tasas_interes->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tasas_interes->ResetAttrs();
$tasas_interes_list->RenderRow();
$tasas_interes_list->RowCnt = 0;
while ($tasas_interes_list->RecCnt < $tasas_interes_list->StopRec) {
	$tasas_interes_list->RecCnt++;
	if (intval($tasas_interes_list->RecCnt) >= intval($tasas_interes_list->StartRec)) {
		$tasas_interes_list->RowCnt++;

		// Set up key count
		$tasas_interes_list->KeyCount = $tasas_interes_list->RowIndex;

		// Init row class and style
		$tasas_interes->ResetAttrs();
		$tasas_interes->CssClass = "";
		if ($tasas_interes->CurrentAction == "gridadd") {
		} else {
			$tasas_interes_list->LoadRowValues($tasas_interes_list->Recordset); // Load row values
		}
		$tasas_interes->RowType = EW_ROWTYPE_VIEW; // Render view
		$tasas_interes->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$tasas_interes_list->RenderRow();

		// Render list options
		$tasas_interes_list->RenderListOptions();
?>
	<tr<?php echo $tasas_interes->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tasas_interes_list->ListOptions->Render("body", "left");
?>
	<?php if ($tasas_interes->inicio->Visible) { // inicio ?>
		<td<?php echo $tasas_interes->inicio->CellAttributes() ?>>
<div<?php echo $tasas_interes->inicio->ViewAttributes() ?>><?php echo $tasas_interes->inicio->ListViewValue() ?></div>
<a name="<?php echo $tasas_interes_list->PageObjName . "_row_" . $tasas_interes_list->RowCnt ?>" id="<?php echo $tasas_interes_list->PageObjName . "_row_" . $tasas_interes_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($tasas_interes->fin->Visible) { // fin ?>
		<td<?php echo $tasas_interes->fin->CellAttributes() ?>>
<div<?php echo $tasas_interes->fin->ViewAttributes() ?>><?php echo $tasas_interes->fin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tasas_interes->tasa->Visible) { // tasa ?>
		<td<?php echo $tasas_interes->tasa->CellAttributes() ?>>
<div<?php echo $tasas_interes->tasa->ViewAttributes() ?>><?php echo $tasas_interes->tasa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tasas_interes->tipo->Visible) { // tipo ?>
		<td<?php echo $tasas_interes->tipo->CellAttributes() ?>>
<div<?php echo $tasas_interes->tipo->ViewAttributes() ?>><?php echo $tasas_interes->tipo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tasas_interes->estatus->Visible) { // estatus ?>
		<td<?php echo $tasas_interes->estatus->CellAttributes() ?>>
<div<?php echo $tasas_interes->estatus->ViewAttributes() ?>><?php echo $tasas_interes->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tasas_interes_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($tasas_interes->CurrentAction <> "gridadd")
		$tasas_interes_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($tasas_interes_list->Recordset)
	$tasas_interes_list->Recordset->Close();
?>
<?php if ($tasas_interes->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tasas_interes->CurrentAction <> "gridadd" && $tasas_interes->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tasas_interes_list->Pager)) $tasas_interes_list->Pager = new cPrevNextPager($tasas_interes_list->StartRec, $tasas_interes_list->DisplayRecs, $tasas_interes_list->TotalRecs) ?>
<?php if ($tasas_interes_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tasas_interes_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tasas_interes_list->PageUrl() ?>start=<?php echo $tasas_interes_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tasas_interes_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tasas_interes_list->PageUrl() ?>start=<?php echo $tasas_interes_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tasas_interes_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tasas_interes_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tasas_interes_list->PageUrl() ?>start=<?php echo $tasas_interes_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tasas_interes_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tasas_interes_list->PageUrl() ?>start=<?php echo $tasas_interes_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tasas_interes_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tasas_interes_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tasas_interes_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tasas_interes_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tasas_interes_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $tasas_interes_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($tasas_interes->Export == "" && $tasas_interes->CurrentAction == "") { ?>
<?php } ?>
<?php
$tasas_interes_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($tasas_interes->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tasas_interes_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctasas_interes_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tasas_interes';

	// Page object name
	var $PageObjName = 'tasas_interes_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tasas_interes;
		if ($tasas_interes->UseTokenInUrl) $PageUrl .= "t=" . $tasas_interes->TableVar . "&"; // Add page token
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
		global $objForm, $tasas_interes;
		if ($tasas_interes->UseTokenInUrl) {
			if ($objForm)
				return ($tasas_interes->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tasas_interes->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctasas_interes_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tasas_interes)
		if (!isset($GLOBALS["tasas_interes"])) {
			$GLOBALS["tasas_interes"] = new ctasas_interes();
			$GLOBALS["Table"] =& $GLOBALS["tasas_interes"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "tasas_interesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tasas_interesdelete.php";
		$this->MultiUpdateUrl = "tasas_interesupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tasas_interes', TRUE);

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
		global $tasas_interes;

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
			$tasas_interes->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $tasas_interes;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($tasas_interes->Export <> "" ||
				$tasas_interes->CurrentAction == "gridadd" ||
				$tasas_interes->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$tasas_interes->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($tasas_interes->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $tasas_interes->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$tasas_interes->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$tasas_interes->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$tasas_interes->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $tasas_interes->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$tasas_interes->setSessionWhere($sFilter);
		$tasas_interes->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $tasas_interes;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tasas_interes->inicio, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tasas_interes->fin, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tasas_interes->tasa, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tasas_interes->tipo, $Keyword);
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
		global $Security, $tasas_interes;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $tasas_interes->BasicSearchKeyword;
		$sSearchType = $tasas_interes->BasicSearchType;
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
			$tasas_interes->setSessionBasicSearchKeyword($sSearchKeyword);
			$tasas_interes->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tasas_interes;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$tasas_interes->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tasas_interes;
		$tasas_interes->setSessionBasicSearchKeyword("");
		$tasas_interes->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tasas_interes;
		$bRestore = TRUE;
		if ($tasas_interes->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tasas_interes->BasicSearchKeyword = $tasas_interes->getSessionBasicSearchKeyword();
			$tasas_interes->BasicSearchType = $tasas_interes->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tasas_interes;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tasas_interes->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tasas_interes->CurrentOrderType = @$_GET["ordertype"];
			$tasas_interes->UpdateSort($tasas_interes->inicio); // inicio
			$tasas_interes->UpdateSort($tasas_interes->fin); // fin
			$tasas_interes->UpdateSort($tasas_interes->tasa); // tasa
			$tasas_interes->UpdateSort($tasas_interes->tipo); // tipo
			$tasas_interes->UpdateSort($tasas_interes->estatus); // estatus
			$tasas_interes->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tasas_interes;
		$sOrderBy = $tasas_interes->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tasas_interes->SqlOrderBy() <> "") {
				$sOrderBy = $tasas_interes->SqlOrderBy();
				$tasas_interes->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tasas_interes;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tasas_interes->setSessionOrderBy($sOrderBy);
				$tasas_interes->inicio->setSort("");
				$tasas_interes->fin->setSort("");
				$tasas_interes->tasa->setSort("");
				$tasas_interes->tipo->setSort("");
				$tasas_interes->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$tasas_interes->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $tasas_interes;

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
		global $Security, $Language, $tasas_interes, $objForm;
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
		global $Security, $Language, $tasas_interes;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tasas_interes;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$tasas_interes->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$tasas_interes->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $tasas_interes->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$tasas_interes->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$tasas_interes->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$tasas_interes->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tasas_interes;
		$tasas_interes->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tasas_interes->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tasas_interes;

		// Call Recordset Selecting event
		$tasas_interes->Recordset_Selecting($tasas_interes->CurrentFilter);

		// Load List page SQL
		$sSql = $tasas_interes->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tasas_interes->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tasas_interes;
		$sFilter = $tasas_interes->KeyFilter();

		// Call Row Selecting event
		$tasas_interes->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tasas_interes->CurrentFilter = $sFilter;
		$sSql = $tasas_interes->SQL();
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
		global $conn, $tasas_interes;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tasas_interes->Row_Selected($row);
		$tasas_interes->id_tasas_interes->setDbValue($rs->fields('id_tasas_interes'));
		$tasas_interes->inicio->setDbValue($rs->fields('inicio'));
		$tasas_interes->fin->setDbValue($rs->fields('fin'));
		$tasas_interes->tasa->setDbValue($rs->fields('tasa'));
		$tasas_interes->tipo->setDbValue($rs->fields('tipo'));
		$tasas_interes->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $tasas_interes;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tasas_interes->getKey("id_tasas_interes")) <> "")
			$tasas_interes->id_tasas_interes->CurrentValue = $tasas_interes->getKey("id_tasas_interes"); // id_tasas_interes
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tasas_interes->CurrentFilter = $tasas_interes->KeyFilter();
			$sSql = $tasas_interes->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tasas_interes;

		// Initialize URLs
		$this->ViewUrl = $tasas_interes->ViewUrl();
		$this->EditUrl = $tasas_interes->EditUrl();
		$this->InlineEditUrl = $tasas_interes->InlineEditUrl();
		$this->CopyUrl = $tasas_interes->CopyUrl();
		$this->InlineCopyUrl = $tasas_interes->InlineCopyUrl();
		$this->DeleteUrl = $tasas_interes->DeleteUrl();

		// Call Row_Rendering event
		$tasas_interes->Row_Rendering();

		// Common render codes for all row types
		// id_tasas_interes

		$tasas_interes->id_tasas_interes->CellCssStyle = "white-space: nowrap;";

		// inicio
		// fin
		// tasa
		// tipo
		// estatus

		if ($tasas_interes->RowType == EW_ROWTYPE_VIEW) { // View row

			// inicio
			$tasas_interes->inicio->ViewValue = $tasas_interes->inicio->CurrentValue;
			$tasas_interes->inicio->ViewCustomAttributes = "";

			// fin
			$tasas_interes->fin->ViewValue = $tasas_interes->fin->CurrentValue;
			$tasas_interes->fin->ViewCustomAttributes = "";

			// tasa
			$tasas_interes->tasa->ViewValue = $tasas_interes->tasa->CurrentValue;
			$tasas_interes->tasa->ViewCustomAttributes = "";

			// tipo
			if (strval($tasas_interes->tipo->CurrentValue) <> "") {
				switch ($tasas_interes->tipo->CurrentValue) {
					case "1":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(1) <> "" ? $tasas_interes->tipo->FldTagCaption(1) : $tasas_interes->tipo->CurrentValue;
						break;
					case "2":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(2) <> "" ? $tasas_interes->tipo->FldTagCaption(2) : $tasas_interes->tipo->CurrentValue;
						break;
					case "3":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(3) <> "" ? $tasas_interes->tipo->FldTagCaption(3) : $tasas_interes->tipo->CurrentValue;
						break;
					default:
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->CurrentValue;
				}
			} else {
				$tasas_interes->tipo->ViewValue = NULL;
			}
			$tasas_interes->tipo->ViewCustomAttributes = "";

			// estatus
			if (strval($tasas_interes->estatus->CurrentValue) <> "") {
				switch ($tasas_interes->estatus->CurrentValue) {
					case "1":
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->FldTagCaption(1) <> "" ? $tasas_interes->estatus->FldTagCaption(1) : $tasas_interes->estatus->CurrentValue;
						break;
					case "0":
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->FldTagCaption(2) <> "" ? $tasas_interes->estatus->FldTagCaption(2) : $tasas_interes->estatus->CurrentValue;
						break;
					default:
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->CurrentValue;
				}
			} else {
				$tasas_interes->estatus->ViewValue = NULL;
			}
			$tasas_interes->estatus->ViewCustomAttributes = "";

			// inicio
			$tasas_interes->inicio->LinkCustomAttributes = "";
			$tasas_interes->inicio->HrefValue = "";
			$tasas_interes->inicio->TooltipValue = "";

			// fin
			$tasas_interes->fin->LinkCustomAttributes = "";
			$tasas_interes->fin->HrefValue = "";
			$tasas_interes->fin->TooltipValue = "";

			// tasa
			$tasas_interes->tasa->LinkCustomAttributes = "";
			$tasas_interes->tasa->HrefValue = "";
			$tasas_interes->tasa->TooltipValue = "";

			// tipo
			$tasas_interes->tipo->LinkCustomAttributes = "";
			$tasas_interes->tipo->HrefValue = "";
			$tasas_interes->tipo->TooltipValue = "";

			// estatus
			$tasas_interes->estatus->LinkCustomAttributes = "";
			$tasas_interes->estatus->HrefValue = "";
			$tasas_interes->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tasas_interes->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tasas_interes->Row_Rendered();
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
