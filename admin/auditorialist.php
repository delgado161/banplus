<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "auditoriainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$auditoria_list = new cauditoria_list();
$Page =& $auditoria_list;

// Page init
$auditoria_list->Page_Init();

// Page main
$auditoria_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($auditoria->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var auditoria_list = new ew_Page("auditoria_list");

// page properties
auditoria_list.PageID = "list"; // page ID
auditoria_list.FormID = "fauditorialist"; // form ID
var EW_PAGE_ID = auditoria_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
auditoria_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
auditoria_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
auditoria_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($auditoria->Export == "") || (EW_EXPORT_MASTER_RECORD && $auditoria->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$auditoria_list->TotalRecs = $auditoria->SelectRecordCount();
	} else {
		if ($auditoria_list->Recordset = $auditoria_list->LoadRecordset())
			$auditoria_list->TotalRecs = $auditoria_list->Recordset->RecordCount();
	}
	$auditoria_list->StartRec = 1;
	if ($auditoria_list->DisplayRecs <= 0 || ($auditoria->Export <> "" && $auditoria->ExportAll)) // Display all records
		$auditoria_list->DisplayRecs = $auditoria_list->TotalRecs;
	if (!($auditoria->Export <> "" && $auditoria->ExportAll))
		$auditoria_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$auditoria_list->Recordset = $auditoria_list->LoadRecordset($auditoria_list->StartRec-1, $auditoria_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $auditoria->TableCaption() ?>
&nbsp;&nbsp;<?php $auditoria_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($auditoria->Export == "" && $auditoria->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(auditoria_list);" style="text-decoration: none;"><img id="auditoria_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="auditoria_list_SearchPanel">
<form name="fauditorialistsrch" id="fauditorialistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="auditoria">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($auditoria->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $auditoria_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($auditoria->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($auditoria->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($auditoria->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $auditoria_list->ShowPageHeader(); ?>
<?php
$auditoria_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fauditorialist" id="fauditorialist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="auditoria">
<div id="gmp_auditoria" class="ewGridMiddlePanel">
<?php if ($auditoria_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $auditoria->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$auditoria_list->RenderListOptions();

// Render list options (header, left)
$auditoria_list->ListOptions->Render("header", "left");
?>
<?php if ($auditoria->fecha->Visible) { // fecha ?>
	<?php if ($auditoria->SortUrl($auditoria->fecha) == "") { ?>
		<td><?php echo $auditoria->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $auditoria->SortUrl($auditoria->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $auditoria->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($auditoria->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($auditoria->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($auditoria->script->Visible) { // script ?>
	<?php if ($auditoria->SortUrl($auditoria->script) == "") { ?>
		<td><?php echo $auditoria->script->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $auditoria->SortUrl($auditoria->script) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $auditoria->script->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($auditoria->script->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($auditoria->script->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($auditoria->usuario->Visible) { // usuario ?>
	<?php if ($auditoria->SortUrl($auditoria->usuario) == "") { ?>
		<td><?php echo $auditoria->usuario->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $auditoria->SortUrl($auditoria->usuario) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $auditoria->usuario->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($auditoria->usuario->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($auditoria->usuario->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($auditoria->accion->Visible) { // accion ?>
	<?php if ($auditoria->SortUrl($auditoria->accion) == "") { ?>
		<td><?php echo $auditoria->accion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $auditoria->SortUrl($auditoria->accion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $auditoria->accion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($auditoria->accion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($auditoria->accion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($auditoria->tabla->Visible) { // tabla ?>
	<?php if ($auditoria->SortUrl($auditoria->tabla) == "") { ?>
		<td><?php echo $auditoria->tabla->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $auditoria->SortUrl($auditoria->tabla) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $auditoria->tabla->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($auditoria->tabla->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($auditoria->tabla->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($auditoria->archivo->Visible) { // archivo ?>
	<?php if ($auditoria->SortUrl($auditoria->archivo) == "") { ?>
		<td><?php echo $auditoria->archivo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $auditoria->SortUrl($auditoria->archivo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $auditoria->archivo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($auditoria->archivo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($auditoria->archivo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$auditoria_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($auditoria->ExportAll && $auditoria->Export <> "") {
	$auditoria_list->StopRec = $auditoria_list->TotalRecs;
} else {

	// Set the last record to display
	if ($auditoria_list->TotalRecs > $auditoria_list->StartRec + $auditoria_list->DisplayRecs - 1)
		$auditoria_list->StopRec = $auditoria_list->StartRec + $auditoria_list->DisplayRecs - 1;
	else
		$auditoria_list->StopRec = $auditoria_list->TotalRecs;
}
$auditoria_list->RecCnt = $auditoria_list->StartRec - 1;
if ($auditoria_list->Recordset && !$auditoria_list->Recordset->EOF) {
	$auditoria_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $auditoria_list->StartRec > 1)
		$auditoria_list->Recordset->Move($auditoria_list->StartRec - 1);
} elseif (!$auditoria->AllowAddDeleteRow && $auditoria_list->StopRec == 0) {
	$auditoria_list->StopRec = $auditoria->GridAddRowCount;
}

// Initialize aggregate
$auditoria->RowType = EW_ROWTYPE_AGGREGATEINIT;
$auditoria->ResetAttrs();
$auditoria_list->RenderRow();
$auditoria_list->RowCnt = 0;
while ($auditoria_list->RecCnt < $auditoria_list->StopRec) {
	$auditoria_list->RecCnt++;
	if (intval($auditoria_list->RecCnt) >= intval($auditoria_list->StartRec)) {
		$auditoria_list->RowCnt++;

		// Set up key count
		$auditoria_list->KeyCount = $auditoria_list->RowIndex;

		// Init row class and style
		$auditoria->ResetAttrs();
		$auditoria->CssClass = "";
		if ($auditoria->CurrentAction == "gridadd") {
		} else {
			$auditoria_list->LoadRowValues($auditoria_list->Recordset); // Load row values
		}
		$auditoria->RowType = EW_ROWTYPE_VIEW; // Render view
		$auditoria->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$auditoria_list->RenderRow();

		// Render list options
		$auditoria_list->RenderListOptions();
?>
	<tr<?php echo $auditoria->RowAttributes() ?>>
<?php

// Render list options (body, left)
$auditoria_list->ListOptions->Render("body", "left");
?>
	<?php if ($auditoria->fecha->Visible) { // fecha ?>
		<td<?php echo $auditoria->fecha->CellAttributes() ?>>
<div<?php echo $auditoria->fecha->ViewAttributes() ?>><?php echo $auditoria->fecha->ListViewValue() ?></div>
<a name="<?php echo $auditoria_list->PageObjName . "_row_" . $auditoria_list->RowCnt ?>" id="<?php echo $auditoria_list->PageObjName . "_row_" . $auditoria_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($auditoria->script->Visible) { // script ?>
		<td<?php echo $auditoria->script->CellAttributes() ?>>
<div<?php echo $auditoria->script->ViewAttributes() ?>><?php echo $auditoria->script->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($auditoria->usuario->Visible) { // usuario ?>
		<td<?php echo $auditoria->usuario->CellAttributes() ?>>
<div<?php echo $auditoria->usuario->ViewAttributes() ?>><?php echo $auditoria->usuario->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($auditoria->accion->Visible) { // accion ?>
		<td<?php echo $auditoria->accion->CellAttributes() ?>>
<div<?php echo $auditoria->accion->ViewAttributes() ?>><?php echo $auditoria->accion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($auditoria->tabla->Visible) { // tabla ?>
		<td<?php echo $auditoria->tabla->CellAttributes() ?>>
<div<?php echo $auditoria->tabla->ViewAttributes() ?>><?php echo $auditoria->tabla->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($auditoria->archivo->Visible) { // archivo ?>
		<td<?php echo $auditoria->archivo->CellAttributes() ?>>
<div<?php echo $auditoria->archivo->ViewAttributes() ?>><?php echo $auditoria->archivo->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$auditoria_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($auditoria->CurrentAction <> "gridadd")
		$auditoria_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($auditoria_list->Recordset)
	$auditoria_list->Recordset->Close();
?>
<?php if ($auditoria->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($auditoria->CurrentAction <> "gridadd" && $auditoria->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($auditoria_list->Pager)) $auditoria_list->Pager = new cPrevNextPager($auditoria_list->StartRec, $auditoria_list->DisplayRecs, $auditoria_list->TotalRecs) ?>
<?php if ($auditoria_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($auditoria_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $auditoria_list->PageUrl() ?>start=<?php echo $auditoria_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($auditoria_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $auditoria_list->PageUrl() ?>start=<?php echo $auditoria_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $auditoria_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($auditoria_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $auditoria_list->PageUrl() ?>start=<?php echo $auditoria_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($auditoria_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $auditoria_list->PageUrl() ?>start=<?php echo $auditoria_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $auditoria_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $auditoria_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $auditoria_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $auditoria_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($auditoria_list->SearchWhere == "0=101") { ?>
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
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($auditoria->Export == "" && $auditoria->CurrentAction == "") { ?>
<?php } ?>
<?php
$auditoria_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($auditoria->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$auditoria_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cauditoria_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'auditoria';

	// Page object name
	var $PageObjName = 'auditoria_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $auditoria;
		if ($auditoria->UseTokenInUrl) $PageUrl .= "t=" . $auditoria->TableVar . "&"; // Add page token
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
		global $objForm, $auditoria;
		if ($auditoria->UseTokenInUrl) {
			if ($objForm)
				return ($auditoria->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($auditoria->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cauditoria_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (auditoria)
		if (!isset($GLOBALS["auditoria"])) {
			$GLOBALS["auditoria"] = new cauditoria();
			$GLOBALS["Table"] =& $GLOBALS["auditoria"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "auditoriaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "auditoriadelete.php";
		$this->MultiUpdateUrl = "auditoriaupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'auditoria', TRUE);

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
		global $auditoria;

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
			$auditoria->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $auditoria;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($auditoria->Export <> "" ||
				$auditoria->CurrentAction == "gridadd" ||
				$auditoria->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$auditoria->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($auditoria->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $auditoria->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$auditoria->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$auditoria->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$auditoria->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $auditoria->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$auditoria->setSessionWhere($sFilter);
		$auditoria->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $auditoria;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $auditoria->script, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $auditoria->usuario, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $auditoria->accion, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $auditoria->tabla, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $auditoria->archivo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $auditoria->valor, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $auditoria->valorinicial, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $auditoria->valorfinal, $Keyword);
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
		global $Security, $auditoria;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $auditoria->BasicSearchKeyword;
		$sSearchType = $auditoria->BasicSearchType;
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
			$auditoria->setSessionBasicSearchKeyword($sSearchKeyword);
			$auditoria->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $auditoria;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$auditoria->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $auditoria;
		$auditoria->setSessionBasicSearchKeyword("");
		$auditoria->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $auditoria;
		$bRestore = TRUE;
		if ($auditoria->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$auditoria->BasicSearchKeyword = $auditoria->getSessionBasicSearchKeyword();
			$auditoria->BasicSearchType = $auditoria->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $auditoria;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$auditoria->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$auditoria->CurrentOrderType = @$_GET["ordertype"];
			$auditoria->UpdateSort($auditoria->fecha); // fecha
			$auditoria->UpdateSort($auditoria->script); // script
			$auditoria->UpdateSort($auditoria->usuario); // usuario
			$auditoria->UpdateSort($auditoria->accion); // accion
			$auditoria->UpdateSort($auditoria->tabla); // tabla
			$auditoria->UpdateSort($auditoria->archivo); // archivo
			$auditoria->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $auditoria;
		$sOrderBy = $auditoria->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($auditoria->SqlOrderBy() <> "") {
				$sOrderBy = $auditoria->SqlOrderBy();
				$auditoria->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $auditoria;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$auditoria->setSessionOrderBy($sOrderBy);
				$auditoria->fecha->setSort("");
				$auditoria->script->setSort("");
				$auditoria->usuario->setSort("");
				$auditoria->accion->setSort("");
				$auditoria->tabla->setSort("");
				$auditoria->archivo->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$auditoria->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $auditoria;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $auditoria, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $auditoria;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $auditoria;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$auditoria->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$auditoria->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $auditoria->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$auditoria->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$auditoria->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$auditoria->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $auditoria;
		$auditoria->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$auditoria->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $auditoria;

		// Call Recordset Selecting event
		$auditoria->Recordset_Selecting($auditoria->CurrentFilter);

		// Load List page SQL
		$sSql = $auditoria->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$auditoria->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $auditoria;
		$sFilter = $auditoria->KeyFilter();

		// Call Row Selecting event
		$auditoria->Row_Selecting($sFilter);

		// Load SQL based on filter
		$auditoria->CurrentFilter = $sFilter;
		$sSql = $auditoria->SQL();
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
		global $conn, $auditoria;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$auditoria->Row_Selected($row);
		$auditoria->id->setDbValue($rs->fields('id'));
		$auditoria->fecha->setDbValue($rs->fields('fecha'));
		$auditoria->script->setDbValue($rs->fields('script'));
		$auditoria->usuario->setDbValue($rs->fields('usuario'));
		$auditoria->accion->setDbValue($rs->fields('accion'));
		$auditoria->tabla->setDbValue($rs->fields('tabla'));
		$auditoria->archivo->setDbValue($rs->fields('archivo'));
		$auditoria->valor->setDbValue($rs->fields('valor'));
		$auditoria->valorinicial->setDbValue($rs->fields('valorinicial'));
		$auditoria->valorfinal->setDbValue($rs->fields('valorfinal'));
	}

	// Load old record
	function LoadOldRecord() {
		global $auditoria;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($auditoria->getKey("id")) <> "")
			$auditoria->id->CurrentValue = $auditoria->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$auditoria->CurrentFilter = $auditoria->KeyFilter();
			$sSql = $auditoria->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $auditoria;

		// Initialize URLs
		$this->ViewUrl = $auditoria->ViewUrl();
		$this->EditUrl = $auditoria->EditUrl();
		$this->InlineEditUrl = $auditoria->InlineEditUrl();
		$this->CopyUrl = $auditoria->CopyUrl();
		$this->InlineCopyUrl = $auditoria->InlineCopyUrl();
		$this->DeleteUrl = $auditoria->DeleteUrl();

		// Call Row_Rendering event
		$auditoria->Row_Rendering();

		// Common render codes for all row types
		// id

		$auditoria->id->CellCssStyle = "white-space: nowrap;";

		// fecha
		// script
		// usuario
		// accion
		// tabla
		// archivo
		// valor
		// valorinicial
		// valorfinal

		if ($auditoria->RowType == EW_ROWTYPE_VIEW) { // View row

			// fecha
			$auditoria->fecha->ViewValue = $auditoria->fecha->CurrentValue;
			$auditoria->fecha->ViewValue = ew_FormatDateTime($auditoria->fecha->ViewValue, 7);
			$auditoria->fecha->ViewCustomAttributes = "";

			// script
			$auditoria->script->ViewValue = $auditoria->script->CurrentValue;
			$auditoria->script->ViewCustomAttributes = "";

			// usuario
			$auditoria->usuario->ViewValue = $auditoria->usuario->CurrentValue;
			$auditoria->usuario->ViewCustomAttributes = "";

			// accion
			$auditoria->accion->ViewValue = str_replace('descinexi&oacute;n','desconexi&oacute;n',$auditoria->accion->CurrentValue);
			$auditoria->accion->ViewCustomAttributes = "";

			// tabla
			$auditoria->tabla->ViewValue = $auditoria->tabla->CurrentValue;
			$auditoria->tabla->ViewCustomAttributes = "";

			// archivo
			$auditoria->archivo->ViewValue = $auditoria->archivo->CurrentValue;
			$auditoria->archivo->ViewCustomAttributes = "";

			// fecha
			$auditoria->fecha->LinkCustomAttributes = "";
			$auditoria->fecha->HrefValue = "";
			$auditoria->fecha->TooltipValue = "";

			// script
			$auditoria->script->LinkCustomAttributes = "";
			$auditoria->script->HrefValue = "";
			$auditoria->script->TooltipValue = "";

			// usuario
			$auditoria->usuario->LinkCustomAttributes = "";
			$auditoria->usuario->HrefValue = "";
			$auditoria->usuario->TooltipValue = "";

			// accion
			$auditoria->accion->LinkCustomAttributes = "";
			$auditoria->accion->HrefValue = "";
			$auditoria->accion->TooltipValue = "";

			// tabla
			$auditoria->tabla->LinkCustomAttributes = "";
			$auditoria->tabla->HrefValue = "";
			$auditoria->tabla->TooltipValue = "";

			// archivo
			$auditoria->archivo->LinkCustomAttributes = "";
			$auditoria->archivo->HrefValue = "";
			$auditoria->archivo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($auditoria->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$auditoria->Row_Rendered();
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
