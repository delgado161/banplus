<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memoria_semestralinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memoria_semestral_list = new cmemoria_semestral_list();
$Page =& $memoria_semestral_list;

// Page init
$memoria_semestral_list->Page_Init();

// Page main
$memoria_semestral_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($memoria_semestral->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var memoria_semestral_list = new ew_Page("memoria_semestral_list");

// page properties
memoria_semestral_list.PageID = "list"; // page ID
memoria_semestral_list.FormID = "fmemoria_semestrallist"; // form ID
var EW_PAGE_ID = memoria_semestral_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
memoria_semestral_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
memoria_semestral_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memoria_semestral_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($memoria_semestral->Export == "") || (EW_EXPORT_MASTER_RECORD && $memoria_semestral->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$memoria_semestral_list->TotalRecs = $memoria_semestral->SelectRecordCount();
	} else {
		if ($memoria_semestral_list->Recordset = $memoria_semestral_list->LoadRecordset())
			$memoria_semestral_list->TotalRecs = $memoria_semestral_list->Recordset->RecordCount();
	}
	$memoria_semestral_list->StartRec = 1;
	if ($memoria_semestral_list->DisplayRecs <= 0 || ($memoria_semestral->Export <> "" && $memoria_semestral->ExportAll)) // Display all records
		$memoria_semestral_list->DisplayRecs = $memoria_semestral_list->TotalRecs;
	if (!($memoria_semestral->Export <> "" && $memoria_semestral->ExportAll))
		$memoria_semestral_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$memoria_semestral_list->Recordset = $memoria_semestral_list->LoadRecordset($memoria_semestral_list->StartRec-1, $memoria_semestral_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memoria_semestral->TableCaption() ?>
&nbsp;&nbsp;<?php $memoria_semestral_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($memoria_semestral->Export == "" && $memoria_semestral->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(memoria_semestral_list);" style="text-decoration: none;"><img id="memoria_semestral_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="memoria_semestral_list_SearchPanel">
<form name="fmemoria_semestrallistsrch" id="fmemoria_semestrallistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="memoria_semestral">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($memoria_semestral->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $memoria_semestral_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($memoria_semestral->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($memoria_semestral->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($memoria_semestral->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $memoria_semestral_list->ShowPageHeader(); ?>
<?php
$memoria_semestral_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmemoria_semestrallist" id="fmemoria_semestrallist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="memoria_semestral">
<div id="gmp_memoria_semestral" class="ewGridMiddlePanel">
<?php if ($memoria_semestral_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $memoria_semestral->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$memoria_semestral_list->RenderListOptions();

// Render list options (header, left)
$memoria_semestral_list->ListOptions->Render("header", "left");
?>
<?php if ($memoria_semestral->id_memoria_semestral->Visible) { // id_memoria_semestral ?>
	<?php if ($memoria_semestral->SortUrl($memoria_semestral->id_memoria_semestral) == "") { ?>
		<td><?php echo $memoria_semestral->id_memoria_semestral->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memoria_semestral->SortUrl($memoria_semestral->id_memoria_semestral) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $memoria_semestral->id_memoria_semestral->FldCaption() ?></td><td style="width: 10px;"><?php if ($memoria_semestral->id_memoria_semestral->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memoria_semestral->id_memoria_semestral->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memoria_semestral->ano->Visible) { // ano ?>
	<?php if ($memoria_semestral->SortUrl($memoria_semestral->ano) == "") { ?>
		<td><?php echo $memoria_semestral->ano->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memoria_semestral->SortUrl($memoria_semestral->ano) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $memoria_semestral->ano->FldCaption() ?></td><td style="width: 10px;"><?php if ($memoria_semestral->ano->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memoria_semestral->ano->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memoria_semestral->mes->Visible) { // mes ?>
	<?php if ($memoria_semestral->SortUrl($memoria_semestral->mes) == "") { ?>
		<td><?php echo $memoria_semestral->mes->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memoria_semestral->SortUrl($memoria_semestral->mes) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $memoria_semestral->mes->FldCaption() ?></td><td style="width: 10px;"><?php if ($memoria_semestral->mes->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memoria_semestral->mes->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memoria_semestral->archivo->Visible) { // archivo ?>
	<?php if ($memoria_semestral->SortUrl($memoria_semestral->archivo) == "") { ?>
		<td><?php echo $memoria_semestral->archivo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memoria_semestral->SortUrl($memoria_semestral->archivo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $memoria_semestral->archivo->FldCaption() ?></td><td style="width: 10px;"><?php if ($memoria_semestral->archivo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memoria_semestral->archivo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memoria_semestral->estatus->Visible) { // estatus ?>
	<?php if ($memoria_semestral->SortUrl($memoria_semestral->estatus) == "") { ?>
		<td><?php echo $memoria_semestral->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $memoria_semestral->SortUrl($memoria_semestral->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $memoria_semestral->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($memoria_semestral->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memoria_semestral->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$memoria_semestral_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($memoria_semestral->ExportAll && $memoria_semestral->Export <> "") {
	$memoria_semestral_list->StopRec = $memoria_semestral_list->TotalRecs;
} else {

	// Set the last record to display
	if ($memoria_semestral_list->TotalRecs > $memoria_semestral_list->StartRec + $memoria_semestral_list->DisplayRecs - 1)
		$memoria_semestral_list->StopRec = $memoria_semestral_list->StartRec + $memoria_semestral_list->DisplayRecs - 1;
	else
		$memoria_semestral_list->StopRec = $memoria_semestral_list->TotalRecs;
}
$memoria_semestral_list->RecCnt = $memoria_semestral_list->StartRec - 1;
if ($memoria_semestral_list->Recordset && !$memoria_semestral_list->Recordset->EOF) {
	$memoria_semestral_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $memoria_semestral_list->StartRec > 1)
		$memoria_semestral_list->Recordset->Move($memoria_semestral_list->StartRec - 1);
} elseif (!$memoria_semestral->AllowAddDeleteRow && $memoria_semestral_list->StopRec == 0) {
	$memoria_semestral_list->StopRec = $memoria_semestral->GridAddRowCount;
}

// Initialize aggregate
$memoria_semestral->RowType = EW_ROWTYPE_AGGREGATEINIT;
$memoria_semestral->ResetAttrs();
$memoria_semestral_list->RenderRow();
$memoria_semestral_list->RowCnt = 0;
while ($memoria_semestral_list->RecCnt < $memoria_semestral_list->StopRec) {
	$memoria_semestral_list->RecCnt++;
	if (intval($memoria_semestral_list->RecCnt) >= intval($memoria_semestral_list->StartRec)) {
		$memoria_semestral_list->RowCnt++;

		// Set up key count
		$memoria_semestral_list->KeyCount = $memoria_semestral_list->RowIndex;

		// Init row class and style
		$memoria_semestral->ResetAttrs();
		$memoria_semestral->CssClass = "";
		if ($memoria_semestral->CurrentAction == "gridadd") {
		} else {
			$memoria_semestral_list->LoadRowValues($memoria_semestral_list->Recordset); // Load row values
		}
		$memoria_semestral->RowType = EW_ROWTYPE_VIEW; // Render view
		$memoria_semestral->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$memoria_semestral_list->RenderRow();

		// Render list options
		$memoria_semestral_list->RenderListOptions();
?>
	<tr<?php echo $memoria_semestral->RowAttributes() ?>>
<?php

// Render list options (body, left)
$memoria_semestral_list->ListOptions->Render("body", "left");
?>
	<?php if ($memoria_semestral->id_memoria_semestral->Visible) { // id_memoria_semestral ?>
		<td<?php echo $memoria_semestral->id_memoria_semestral->CellAttributes() ?>>
<div<?php echo $memoria_semestral->id_memoria_semestral->ViewAttributes() ?>><?php echo $memoria_semestral->id_memoria_semestral->ListViewValue() ?></div>
<a name="<?php echo $memoria_semestral_list->PageObjName . "_row_" . $memoria_semestral_list->RowCnt ?>" id="<?php echo $memoria_semestral_list->PageObjName . "_row_" . $memoria_semestral_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($memoria_semestral->ano->Visible) { // ano ?>
		<td<?php echo $memoria_semestral->ano->CellAttributes() ?>>
<div<?php echo $memoria_semestral->ano->ViewAttributes() ?>><?php echo $memoria_semestral->ano->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($memoria_semestral->mes->Visible) { // mes ?>
		<td<?php echo $memoria_semestral->mes->CellAttributes() ?>>
<div<?php echo $memoria_semestral->mes->ViewAttributes() ?>><?php echo $memoria_semestral->mes->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($memoria_semestral->archivo->Visible) { // archivo ?>
		<td<?php echo $memoria_semestral->archivo->CellAttributes() ?>>
<?php if ($memoria_semestral->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($memoria_semestral->archivo->Upload->DbValue)) { ?>
<a<?php echo $memoria_semestral->archivo->LinkAttributes() ?>><?php echo $memoria_semestral->archivo->ListViewValue() ?></a>
<?php } elseif (!in_array($memoria_semestral->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($memoria_semestral->archivo->Upload->DbValue)) { ?>
<?php echo $memoria_semestral->archivo->ListViewValue() ?>
<?php } elseif (!in_array($memoria_semestral->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($memoria_semestral->estatus->Visible) { // estatus ?>
		<td<?php echo $memoria_semestral->estatus->CellAttributes() ?>>
<div<?php echo $memoria_semestral->estatus->ViewAttributes() ?>><?php echo $memoria_semestral->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$memoria_semestral_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($memoria_semestral->CurrentAction <> "gridadd")
		$memoria_semestral_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($memoria_semestral_list->Recordset)
	$memoria_semestral_list->Recordset->Close();
?>
<?php if ($memoria_semestral->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($memoria_semestral->CurrentAction <> "gridadd" && $memoria_semestral->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($memoria_semestral_list->Pager)) $memoria_semestral_list->Pager = new cPrevNextPager($memoria_semestral_list->StartRec, $memoria_semestral_list->DisplayRecs, $memoria_semestral_list->TotalRecs) ?>
<?php if ($memoria_semestral_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($memoria_semestral_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $memoria_semestral_list->PageUrl() ?>start=<?php echo $memoria_semestral_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($memoria_semestral_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $memoria_semestral_list->PageUrl() ?>start=<?php echo $memoria_semestral_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $memoria_semestral_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($memoria_semestral_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $memoria_semestral_list->PageUrl() ?>start=<?php echo $memoria_semestral_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($memoria_semestral_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $memoria_semestral_list->PageUrl() ?>start=<?php echo $memoria_semestral_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $memoria_semestral_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $memoria_semestral_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $memoria_semestral_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $memoria_semestral_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($memoria_semestral_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $memoria_semestral_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($memoria_semestral->Export == "" && $memoria_semestral->CurrentAction == "") { ?>
<?php } ?>
<?php
$memoria_semestral_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($memoria_semestral->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$memoria_semestral_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemoria_semestral_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'memoria_semestral';

	// Page object name
	var $PageObjName = 'memoria_semestral_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memoria_semestral;
		if ($memoria_semestral->UseTokenInUrl) $PageUrl .= "t=" . $memoria_semestral->TableVar . "&"; // Add page token
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
		global $objForm, $memoria_semestral;
		if ($memoria_semestral->UseTokenInUrl) {
			if ($objForm)
				return ($memoria_semestral->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memoria_semestral->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemoria_semestral_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memoria_semestral)
		if (!isset($GLOBALS["memoria_semestral"])) {
			$GLOBALS["memoria_semestral"] = new cmemoria_semestral();
			$GLOBALS["Table"] =& $GLOBALS["memoria_semestral"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "memoria_semestraladd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "memoria_semestraldelete.php";
		$this->MultiUpdateUrl = "memoria_semestralupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memoria_semestral', TRUE);

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
		global $memoria_semestral;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$memoria_semestral->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $memoria_semestral;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($memoria_semestral->Export <> "" ||
				$memoria_semestral->CurrentAction == "gridadd" ||
				$memoria_semestral->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$memoria_semestral->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($memoria_semestral->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $memoria_semestral->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$memoria_semestral->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$memoria_semestral->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$memoria_semestral->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $memoria_semestral->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$memoria_semestral->setSessionWhere($sFilter);
		$memoria_semestral->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $memoria_semestral;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $memoria_semestral->mes, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $memoria_semestral->archivo, $Keyword);
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
		global $Security, $memoria_semestral;
		$sSearchStr = "";
		$sSearchKeyword = $memoria_semestral->BasicSearchKeyword;
		$sSearchType = $memoria_semestral->BasicSearchType;
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
			$memoria_semestral->setSessionBasicSearchKeyword($sSearchKeyword);
			$memoria_semestral->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $memoria_semestral;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$memoria_semestral->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $memoria_semestral;
		$memoria_semestral->setSessionBasicSearchKeyword("");
		$memoria_semestral->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $memoria_semestral;
		$bRestore = TRUE;
		if ($memoria_semestral->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$memoria_semestral->BasicSearchKeyword = $memoria_semestral->getSessionBasicSearchKeyword();
			$memoria_semestral->BasicSearchType = $memoria_semestral->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $memoria_semestral;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$memoria_semestral->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$memoria_semestral->CurrentOrderType = @$_GET["ordertype"];
			$memoria_semestral->UpdateSort($memoria_semestral->id_memoria_semestral); // id_memoria_semestral
			$memoria_semestral->UpdateSort($memoria_semestral->ano); // ano
			$memoria_semestral->UpdateSort($memoria_semestral->mes); // mes
			$memoria_semestral->UpdateSort($memoria_semestral->archivo); // archivo
			$memoria_semestral->UpdateSort($memoria_semestral->estatus); // estatus
			$memoria_semestral->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $memoria_semestral;
		$sOrderBy = $memoria_semestral->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($memoria_semestral->SqlOrderBy() <> "") {
				$sOrderBy = $memoria_semestral->SqlOrderBy();
				$memoria_semestral->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $memoria_semestral;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$memoria_semestral->setSessionOrderBy($sOrderBy);
				$memoria_semestral->id_memoria_semestral->setSort("");
				$memoria_semestral->ano->setSort("");
				$memoria_semestral->mes->setSort("");
				$memoria_semestral->archivo->setSort("");
				$memoria_semestral->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$memoria_semestral->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $memoria_semestral;

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
		global $Security, $Language, $memoria_semestral, $objForm;
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
		global $Security, $Language, $memoria_semestral;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $memoria_semestral;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$memoria_semestral->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$memoria_semestral->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $memoria_semestral->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$memoria_semestral->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$memoria_semestral->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$memoria_semestral->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $memoria_semestral;
		$memoria_semestral->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$memoria_semestral->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $memoria_semestral;

		// Call Recordset Selecting event
		$memoria_semestral->Recordset_Selecting($memoria_semestral->CurrentFilter);

		// Load List page SQL
		$sSql = $memoria_semestral->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$memoria_semestral->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memoria_semestral;
		$sFilter = $memoria_semestral->KeyFilter();

		// Call Row Selecting event
		$memoria_semestral->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memoria_semestral->CurrentFilter = $sFilter;
		$sSql = $memoria_semestral->SQL();
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
		global $conn, $memoria_semestral;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memoria_semestral->Row_Selected($row);
		$memoria_semestral->id_memoria_semestral->setDbValue($rs->fields('id_memoria_semestral'));
		$memoria_semestral->ano->setDbValue($rs->fields('ano'));
		$memoria_semestral->mes->setDbValue($rs->fields('mes'));
		$memoria_semestral->archivo->Upload->DbValue = $rs->fields('archivo');
		$memoria_semestral->estatus->setDbValue($rs->fields('estatus'));
		$memoria_semestral->memoria_s->setDbValue($rs->fields('memoria_s'));
	}

	// Load old record
	function LoadOldRecord() {
		global $memoria_semestral;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($memoria_semestral->getKey("id_memoria_semestral")) <> "")
			$memoria_semestral->id_memoria_semestral->CurrentValue = $memoria_semestral->getKey("id_memoria_semestral"); // id_memoria_semestral
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$memoria_semestral->CurrentFilter = $memoria_semestral->KeyFilter();
			$sSql = $memoria_semestral->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memoria_semestral;

		// Initialize URLs
		$this->ViewUrl = $memoria_semestral->ViewUrl();
		$this->EditUrl = $memoria_semestral->EditUrl();
		$this->InlineEditUrl = $memoria_semestral->InlineEditUrl();
		$this->CopyUrl = $memoria_semestral->CopyUrl();
		$this->InlineCopyUrl = $memoria_semestral->InlineCopyUrl();
		$this->DeleteUrl = $memoria_semestral->DeleteUrl();

		// Call Row_Rendering event
		$memoria_semestral->Row_Rendering();

		// Common render codes for all row types
		// id_memoria_semestral
		// ano
		// mes
		// archivo
		// estatus
		// memoria_s

		$memoria_semestral->memoria_s->CellCssStyle = "white-space: nowrap;";
		if ($memoria_semestral->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_memoria_semestral
			$memoria_semestral->id_memoria_semestral->ViewValue = $memoria_semestral->id_memoria_semestral->CurrentValue;
			$memoria_semestral->id_memoria_semestral->ViewCustomAttributes = "";

			// ano
			$memoria_semestral->ano->ViewValue = $memoria_semestral->ano->CurrentValue;
			$memoria_semestral->ano->ViewCustomAttributes = "";

			// mes
			if (strval($memoria_semestral->mes->CurrentValue) <> "") {
				switch ($memoria_semestral->mes->CurrentValue) {
					case "1":
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->FldTagCaption(1) <> "" ? $memoria_semestral->mes->FldTagCaption(1) : $memoria_semestral->mes->CurrentValue;
						break;
					case "2":
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->FldTagCaption(2) <> "" ? $memoria_semestral->mes->FldTagCaption(2) : $memoria_semestral->mes->CurrentValue;
						break;
					default:
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->CurrentValue;
				}
			} else {
				$memoria_semestral->mes->ViewValue = NULL;
			}
			$memoria_semestral->mes->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->ViewValue = $memoria_semestral->archivo->Upload->DbValue;
			} else {
				$memoria_semestral->archivo->ViewValue = "";
			}
			$memoria_semestral->archivo->ViewCustomAttributes = "";

			// estatus
			if (strval($memoria_semestral->estatus->CurrentValue) <> "") {
				switch ($memoria_semestral->estatus->CurrentValue) {
					case "1":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(1) <> "" ? $memoria_semestral->estatus->FldTagCaption(1) : $memoria_semestral->estatus->CurrentValue;
						break;
					case "0":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(2) <> "" ? $memoria_semestral->estatus->FldTagCaption(2) : $memoria_semestral->estatus->CurrentValue;
						break;
					case "3":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(3) <> "" ? $memoria_semestral->estatus->FldTagCaption(3) : $memoria_semestral->estatus->CurrentValue;
						break;
					case "4":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(4) <> "" ? $memoria_semestral->estatus->FldTagCaption(4) : $memoria_semestral->estatus->CurrentValue;
						break;
					default:
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->CurrentValue;
				}
			} else {
				$memoria_semestral->estatus->ViewValue = NULL;
			}
			$memoria_semestral->estatus->ViewCustomAttributes = "";

			// id_memoria_semestral
			$memoria_semestral->id_memoria_semestral->LinkCustomAttributes = "";
			$memoria_semestral->id_memoria_semestral->HrefValue = "";
			$memoria_semestral->id_memoria_semestral->TooltipValue = "";

			// ano
			$memoria_semestral->ano->LinkCustomAttributes = "";
			$memoria_semestral->ano->HrefValue = "";
			$memoria_semestral->ano->TooltipValue = "";

			// mes
			$memoria_semestral->mes->LinkCustomAttributes = "";
			$memoria_semestral->mes->HrefValue = "";
			$memoria_semestral->mes->TooltipValue = "";

			// archivo
			$memoria_semestral->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->HrefValue = ew_UploadPathEx(FALSE, $memoria_semestral->archivo->UploadPath) . ((!empty($memoria_semestral->archivo->ViewValue)) ? $memoria_semestral->archivo->ViewValue : $memoria_semestral->archivo->CurrentValue); // Add prefix/suffix
				$memoria_semestral->archivo->LinkAttrs["target"] = ""; // Add target
				if ($memoria_semestral->Export <> "") $memoria_semestral->archivo->HrefValue = ew_ConvertFullUrl($memoria_semestral->archivo->HrefValue);
			} else {
				$memoria_semestral->archivo->HrefValue = "";
			}
			$memoria_semestral->archivo->TooltipValue = "";

			// estatus
			$memoria_semestral->estatus->LinkCustomAttributes = "";
			$memoria_semestral->estatus->HrefValue = "";
			$memoria_semestral->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($memoria_semestral->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memoria_semestral->Row_Rendered();
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
