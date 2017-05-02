<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "informacion_financierainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$informacion_financiera_list = new cinformacion_financiera_list();
$Page =& $informacion_financiera_list;

// Page init
$informacion_financiera_list->Page_Init();

// Page main
$informacion_financiera_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($informacion_financiera->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var informacion_financiera_list = new ew_Page("informacion_financiera_list");

// page properties
informacion_financiera_list.PageID = "list"; // page ID
informacion_financiera_list.FormID = "finformacion_financieralist"; // form ID
var EW_PAGE_ID = informacion_financiera_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
informacion_financiera_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
informacion_financiera_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
informacion_financiera_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($informacion_financiera->Export == "") || (EW_EXPORT_MASTER_RECORD && $informacion_financiera->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$informacion_financiera_list->TotalRecs = $informacion_financiera->SelectRecordCount();
	} else {
		if ($informacion_financiera_list->Recordset = $informacion_financiera_list->LoadRecordset())
			$informacion_financiera_list->TotalRecs = $informacion_financiera_list->Recordset->RecordCount();
	}
	$informacion_financiera_list->StartRec = 1;
	if ($informacion_financiera_list->DisplayRecs <= 0 || ($informacion_financiera->Export <> "" && $informacion_financiera->ExportAll)) // Display all records
		$informacion_financiera_list->DisplayRecs = $informacion_financiera_list->TotalRecs;
	if (!($informacion_financiera->Export <> "" && $informacion_financiera->ExportAll))
		$informacion_financiera_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$informacion_financiera_list->Recordset = $informacion_financiera_list->LoadRecordset($informacion_financiera_list->StartRec-1, $informacion_financiera_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $informacion_financiera->TableCaption() ?>
&nbsp;&nbsp;<?php $informacion_financiera_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($informacion_financiera->Export == "" && $informacion_financiera->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(informacion_financiera_list);" style="text-decoration: none;"><img id="informacion_financiera_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="informacion_financiera_list_SearchPanel">
<form name="finformacion_financieralistsrch" id="finformacion_financieralistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="informacion_financiera">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($informacion_financiera->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $informacion_financiera_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($informacion_financiera->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($informacion_financiera->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($informacion_financiera->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $informacion_financiera_list->ShowPageHeader(); ?>
<?php
$informacion_financiera_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="finformacion_financieralist" id="finformacion_financieralist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="informacion_financiera">
<div id="gmp_informacion_financiera" class="ewGridMiddlePanel">
<?php if ($informacion_financiera_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $informacion_financiera->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$informacion_financiera_list->RenderListOptions();

// Render list options (header, left)
$informacion_financiera_list->ListOptions->Render("header", "left");
?>
<?php if ($informacion_financiera->ano->Visible) { // ano ?>
	<?php if ($informacion_financiera->SortUrl($informacion_financiera->ano) == "") { ?>
		<td><?php echo $informacion_financiera->ano->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $informacion_financiera->SortUrl($informacion_financiera->ano) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $informacion_financiera->ano->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($informacion_financiera->ano->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($informacion_financiera->ano->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($informacion_financiera->mes->Visible) { // mes ?>
	<?php if ($informacion_financiera->SortUrl($informacion_financiera->mes) == "") { ?>
		<td><?php echo $informacion_financiera->mes->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $informacion_financiera->SortUrl($informacion_financiera->mes) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $informacion_financiera->mes->FldCaption() ?></td><td style="width: 10px;"><?php if ($informacion_financiera->mes->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($informacion_financiera->mes->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($informacion_financiera->archivo->Visible) { // archivo ?>
	<?php if ($informacion_financiera->SortUrl($informacion_financiera->archivo) == "") { ?>
		<td><?php echo $informacion_financiera->archivo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $informacion_financiera->SortUrl($informacion_financiera->archivo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $informacion_financiera->archivo->FldCaption() ?></td><td style="width: 10px;"><?php if ($informacion_financiera->archivo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($informacion_financiera->archivo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($informacion_financiera->estatus->Visible) { // estatus ?>
	<?php if ($informacion_financiera->SortUrl($informacion_financiera->estatus) == "") { ?>
		<td><?php echo $informacion_financiera->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $informacion_financiera->SortUrl($informacion_financiera->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $informacion_financiera->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($informacion_financiera->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($informacion_financiera->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$informacion_financiera_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($informacion_financiera->ExportAll && $informacion_financiera->Export <> "") {
	$informacion_financiera_list->StopRec = $informacion_financiera_list->TotalRecs;
} else {

	// Set the last record to display
	if ($informacion_financiera_list->TotalRecs > $informacion_financiera_list->StartRec + $informacion_financiera_list->DisplayRecs - 1)
		$informacion_financiera_list->StopRec = $informacion_financiera_list->StartRec + $informacion_financiera_list->DisplayRecs - 1;
	else
		$informacion_financiera_list->StopRec = $informacion_financiera_list->TotalRecs;
}
$informacion_financiera_list->RecCnt = $informacion_financiera_list->StartRec - 1;
if ($informacion_financiera_list->Recordset && !$informacion_financiera_list->Recordset->EOF) {
	$informacion_financiera_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $informacion_financiera_list->StartRec > 1)
		$informacion_financiera_list->Recordset->Move($informacion_financiera_list->StartRec - 1);
} elseif (!$informacion_financiera->AllowAddDeleteRow && $informacion_financiera_list->StopRec == 0) {
	$informacion_financiera_list->StopRec = $informacion_financiera->GridAddRowCount;
}

// Initialize aggregate
$informacion_financiera->RowType = EW_ROWTYPE_AGGREGATEINIT;
$informacion_financiera->ResetAttrs();
$informacion_financiera_list->RenderRow();
$informacion_financiera_list->RowCnt = 0;
while ($informacion_financiera_list->RecCnt < $informacion_financiera_list->StopRec) {
	$informacion_financiera_list->RecCnt++;
	if (intval($informacion_financiera_list->RecCnt) >= intval($informacion_financiera_list->StartRec)) {
		$informacion_financiera_list->RowCnt++;

		// Set up key count
		$informacion_financiera_list->KeyCount = $informacion_financiera_list->RowIndex;

		// Init row class and style
		$informacion_financiera->ResetAttrs();
		$informacion_financiera->CssClass = "";
		if ($informacion_financiera->CurrentAction == "gridadd") {
		} else {
			$informacion_financiera_list->LoadRowValues($informacion_financiera_list->Recordset); // Load row values
		}
		$informacion_financiera->RowType = EW_ROWTYPE_VIEW; // Render view
		$informacion_financiera->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$informacion_financiera_list->RenderRow();

		// Render list options
		$informacion_financiera_list->RenderListOptions();
?>
	<tr<?php echo $informacion_financiera->RowAttributes() ?>>
<?php

// Render list options (body, left)
$informacion_financiera_list->ListOptions->Render("body", "left");
?>
	<?php if ($informacion_financiera->ano->Visible) { // ano ?>
		<td<?php echo $informacion_financiera->ano->CellAttributes() ?>>
<div<?php echo $informacion_financiera->ano->ViewAttributes() ?>><?php echo $informacion_financiera->ano->ListViewValue() ?></div>
<a name="<?php echo $informacion_financiera_list->PageObjName . "_row_" . $informacion_financiera_list->RowCnt ?>" id="<?php echo $informacion_financiera_list->PageObjName . "_row_" . $informacion_financiera_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($informacion_financiera->mes->Visible) { // mes ?>
		<td<?php echo $informacion_financiera->mes->CellAttributes() ?>>
<div<?php echo $informacion_financiera->mes->ViewAttributes() ?>><?php echo $informacion_financiera->mes->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($informacion_financiera->archivo->Visible) { // archivo ?>
		<td<?php echo $informacion_financiera->archivo->CellAttributes() ?>>
<?php if ($informacion_financiera->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($informacion_financiera->archivo->Upload->DbValue)) { ?>
<a<?php echo $informacion_financiera->archivo->LinkAttributes() ?>><?php echo $informacion_financiera->archivo->ListViewValue() ?></a>
<?php } elseif (!in_array($informacion_financiera->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($informacion_financiera->archivo->Upload->DbValue)) { ?>
<?php echo $informacion_financiera->archivo->ListViewValue() ?>
<?php } elseif (!in_array($informacion_financiera->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($informacion_financiera->estatus->Visible) { // estatus ?>
		<td<?php echo $informacion_financiera->estatus->CellAttributes() ?>>
<div<?php echo $informacion_financiera->estatus->ViewAttributes() ?>><?php echo $informacion_financiera->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$informacion_financiera_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($informacion_financiera->CurrentAction <> "gridadd")
		$informacion_financiera_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($informacion_financiera_list->Recordset)
	$informacion_financiera_list->Recordset->Close();
?>
<?php if ($informacion_financiera->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($informacion_financiera->CurrentAction <> "gridadd" && $informacion_financiera->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($informacion_financiera_list->Pager)) $informacion_financiera_list->Pager = new cPrevNextPager($informacion_financiera_list->StartRec, $informacion_financiera_list->DisplayRecs, $informacion_financiera_list->TotalRecs) ?>
<?php if ($informacion_financiera_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($informacion_financiera_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $informacion_financiera_list->PageUrl() ?>start=<?php echo $informacion_financiera_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($informacion_financiera_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $informacion_financiera_list->PageUrl() ?>start=<?php echo $informacion_financiera_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $informacion_financiera_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($informacion_financiera_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $informacion_financiera_list->PageUrl() ?>start=<?php echo $informacion_financiera_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($informacion_financiera_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $informacion_financiera_list->PageUrl() ?>start=<?php echo $informacion_financiera_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $informacion_financiera_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $informacion_financiera_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $informacion_financiera_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $informacion_financiera_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($informacion_financiera_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $informacion_financiera_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($informacion_financiera->Export == "" && $informacion_financiera->CurrentAction == "") { ?>
<?php } ?>
<?php
$informacion_financiera_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($informacion_financiera->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$informacion_financiera_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cinformacion_financiera_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'informacion_financiera';

	// Page object name
	var $PageObjName = 'informacion_financiera_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $informacion_financiera;
		if ($informacion_financiera->UseTokenInUrl) $PageUrl .= "t=" . $informacion_financiera->TableVar . "&"; // Add page token
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
		global $objForm, $informacion_financiera;
		if ($informacion_financiera->UseTokenInUrl) {
			if ($objForm)
				return ($informacion_financiera->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($informacion_financiera->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinformacion_financiera_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (informacion_financiera)
		if (!isset($GLOBALS["informacion_financiera"])) {
			$GLOBALS["informacion_financiera"] = new cinformacion_financiera();
			$GLOBALS["Table"] =& $GLOBALS["informacion_financiera"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "informacion_financieraadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "informacion_financieradelete.php";
		$this->MultiUpdateUrl = "informacion_financieraupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'informacion_financiera', TRUE);

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
		global $informacion_financiera;

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
			$informacion_financiera->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $informacion_financiera;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($informacion_financiera->Export <> "" ||
				$informacion_financiera->CurrentAction == "gridadd" ||
				$informacion_financiera->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$informacion_financiera->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($informacion_financiera->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $informacion_financiera->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$informacion_financiera->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$informacion_financiera->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$informacion_financiera->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $informacion_financiera->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$informacion_financiera->setSessionWhere($sFilter);
		$informacion_financiera->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $informacion_financiera;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $informacion_financiera->ano, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $informacion_financiera->mes, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $informacion_financiera->archivo, $Keyword);
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
		global $Security, $informacion_financiera;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $informacion_financiera->BasicSearchKeyword;
		$sSearchType = $informacion_financiera->BasicSearchType;
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
			$informacion_financiera->setSessionBasicSearchKeyword($sSearchKeyword);
			$informacion_financiera->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $informacion_financiera;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$informacion_financiera->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $informacion_financiera;
		$informacion_financiera->setSessionBasicSearchKeyword("");
		$informacion_financiera->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $informacion_financiera;
		$bRestore = TRUE;
		if ($informacion_financiera->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$informacion_financiera->BasicSearchKeyword = $informacion_financiera->getSessionBasicSearchKeyword();
			$informacion_financiera->BasicSearchType = $informacion_financiera->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $informacion_financiera;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$informacion_financiera->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$informacion_financiera->CurrentOrderType = @$_GET["ordertype"];
			$informacion_financiera->UpdateSort($informacion_financiera->ano); // ano
			$informacion_financiera->UpdateSort($informacion_financiera->mes); // mes
			$informacion_financiera->UpdateSort($informacion_financiera->archivo); // archivo
			$informacion_financiera->UpdateSort($informacion_financiera->estatus); // estatus
			$informacion_financiera->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $informacion_financiera;
		$sOrderBy = $informacion_financiera->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($informacion_financiera->SqlOrderBy() <> "") {
				$sOrderBy = $informacion_financiera->SqlOrderBy();
				$informacion_financiera->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $informacion_financiera;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$informacion_financiera->setSessionOrderBy($sOrderBy);
				$informacion_financiera->ano->setSort("");
				$informacion_financiera->mes->setSort("");
				$informacion_financiera->archivo->setSort("");
				$informacion_financiera->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$informacion_financiera->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $informacion_financiera;

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
		global $Security, $Language, $informacion_financiera, $objForm;
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
		global $Security, $Language, $informacion_financiera;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $informacion_financiera;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$informacion_financiera->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$informacion_financiera->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $informacion_financiera->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$informacion_financiera->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$informacion_financiera->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$informacion_financiera->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $informacion_financiera;
		$informacion_financiera->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$informacion_financiera->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $informacion_financiera;

		// Call Recordset Selecting event
		$informacion_financiera->Recordset_Selecting($informacion_financiera->CurrentFilter);

		// Load List page SQL
		$sSql = $informacion_financiera->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$informacion_financiera->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $informacion_financiera;
		$sFilter = $informacion_financiera->KeyFilter();

		// Call Row Selecting event
		$informacion_financiera->Row_Selecting($sFilter);

		// Load SQL based on filter
		$informacion_financiera->CurrentFilter = $sFilter;
		$sSql = $informacion_financiera->SQL();
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
		global $conn, $informacion_financiera;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$informacion_financiera->Row_Selected($row);
		$informacion_financiera->id_informacion_financiera->setDbValue($rs->fields('id_informacion_financiera'));
		$informacion_financiera->ano->setDbValue($rs->fields('ano'));
		$informacion_financiera->mes->setDbValue($rs->fields('mes'));
		$informacion_financiera->archivo->Upload->DbValue = $rs->fields('archivo');
		$informacion_financiera->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $informacion_financiera;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($informacion_financiera->getKey("id_informacion_financiera")) <> "")
			$informacion_financiera->id_informacion_financiera->CurrentValue = $informacion_financiera->getKey("id_informacion_financiera"); // id_informacion_financiera
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$informacion_financiera->CurrentFilter = $informacion_financiera->KeyFilter();
			$sSql = $informacion_financiera->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $informacion_financiera;

		// Initialize URLs
		$this->ViewUrl = $informacion_financiera->ViewUrl();
		$this->EditUrl = $informacion_financiera->EditUrl();
		$this->InlineEditUrl = $informacion_financiera->InlineEditUrl();
		$this->CopyUrl = $informacion_financiera->CopyUrl();
		$this->InlineCopyUrl = $informacion_financiera->InlineCopyUrl();
		$this->DeleteUrl = $informacion_financiera->DeleteUrl();

		// Call Row_Rendering event
		$informacion_financiera->Row_Rendering();

		// Common render codes for all row types
		// id_informacion_financiera
		// ano
		// mes
		// archivo
		// estatus

		if ($informacion_financiera->RowType == EW_ROWTYPE_VIEW) { // View row

			// ano
			$informacion_financiera->ano->ViewValue = $informacion_financiera->ano->CurrentValue;
			$informacion_financiera->ano->ViewCustomAttributes = "";

			// mes
			if (strval($informacion_financiera->mes->CurrentValue) <> "") {
				switch ($informacion_financiera->mes->CurrentValue) {
					case "1":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(1) <> "" ? $informacion_financiera->mes->FldTagCaption(1) : $informacion_financiera->mes->CurrentValue;
						break;
					case "2":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(2) <> "" ? $informacion_financiera->mes->FldTagCaption(2) : $informacion_financiera->mes->CurrentValue;
						break;
					case "3":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(3) <> "" ? $informacion_financiera->mes->FldTagCaption(3) : $informacion_financiera->mes->CurrentValue;
						break;
					case "4":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(4) <> "" ? $informacion_financiera->mes->FldTagCaption(4) : $informacion_financiera->mes->CurrentValue;
						break;
					case "5":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(5) <> "" ? $informacion_financiera->mes->FldTagCaption(5) : $informacion_financiera->mes->CurrentValue;
						break;
					case "6":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(6) <> "" ? $informacion_financiera->mes->FldTagCaption(6) : $informacion_financiera->mes->CurrentValue;
						break;
					case "7":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(7) <> "" ? $informacion_financiera->mes->FldTagCaption(7) : $informacion_financiera->mes->CurrentValue;
						break;
					case "8":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(8) <> "" ? $informacion_financiera->mes->FldTagCaption(8) : $informacion_financiera->mes->CurrentValue;
						break;
					case "9":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(9) <> "" ? $informacion_financiera->mes->FldTagCaption(9) : $informacion_financiera->mes->CurrentValue;
						break;
					case "10":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(10) <> "" ? $informacion_financiera->mes->FldTagCaption(10) : $informacion_financiera->mes->CurrentValue;
						break;
					case "11":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(11) <> "" ? $informacion_financiera->mes->FldTagCaption(11) : $informacion_financiera->mes->CurrentValue;
						break;
					case "12":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(12) <> "" ? $informacion_financiera->mes->FldTagCaption(12) : $informacion_financiera->mes->CurrentValue;
						break;
					default:
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->CurrentValue;
				}
			} else {
				$informacion_financiera->mes->ViewValue = NULL;
			}
			$informacion_financiera->mes->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->ViewValue = $informacion_financiera->archivo->Upload->DbValue;
			} else {
				$informacion_financiera->archivo->ViewValue = "";
			}
			$informacion_financiera->archivo->ViewCustomAttributes = "";

			// estatus
			if (strval($informacion_financiera->estatus->CurrentValue) <> "") {
				switch ($informacion_financiera->estatus->CurrentValue) {
					case "1":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(1) <> "" ? $informacion_financiera->estatus->FldTagCaption(1) : $informacion_financiera->estatus->CurrentValue;
						break;
					case "0":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(2) <> "" ? $informacion_financiera->estatus->FldTagCaption(2) : $informacion_financiera->estatus->CurrentValue;
						break;
					case "3":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(3) <> "" ? $informacion_financiera->estatus->FldTagCaption(3) : $informacion_financiera->estatus->CurrentValue;
						break;
					case "4":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(4) <> "" ? $informacion_financiera->estatus->FldTagCaption(4) : $informacion_financiera->estatus->CurrentValue;
						break;
					default:
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->CurrentValue;
				}
			} else {
				$informacion_financiera->estatus->ViewValue = NULL;
			}
			$informacion_financiera->estatus->ViewCustomAttributes = "";

			// ano
			$informacion_financiera->ano->LinkCustomAttributes = "";
			$informacion_financiera->ano->HrefValue = "";
			$informacion_financiera->ano->TooltipValue = "";

			// mes
			$informacion_financiera->mes->LinkCustomAttributes = "";
			$informacion_financiera->mes->HrefValue = "";
			$informacion_financiera->mes->TooltipValue = "";

			// archivo
			$informacion_financiera->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->HrefValue = ew_UploadPathEx(FALSE, $informacion_financiera->archivo->UploadPath) . ((!empty($informacion_financiera->archivo->ViewValue)) ? $informacion_financiera->archivo->ViewValue : $informacion_financiera->archivo->CurrentValue); // Add prefix/suffix
				$informacion_financiera->archivo->LinkAttrs["target"] = ""; // Add target
				if ($informacion_financiera->Export <> "") $informacion_financiera->archivo->HrefValue = ew_ConvertFullUrl($informacion_financiera->archivo->HrefValue);
			} else {
				$informacion_financiera->archivo->HrefValue = "";
			}
			$informacion_financiera->archivo->TooltipValue = "";

			// estatus
			$informacion_financiera->estatus->LinkCustomAttributes = "";
			$informacion_financiera->estatus->HrefValue = "";
			$informacion_financiera->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($informacion_financiera->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$informacion_financiera->Row_Rendered();
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
		$table = 'informacion_financiera';
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
