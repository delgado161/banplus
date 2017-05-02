<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "nivel_academicoinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$nivel_academico_list = new cnivel_academico_list();
$Page =& $nivel_academico_list;

// Page init
$nivel_academico_list->Page_Init();

// Page main
$nivel_academico_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($nivel_academico->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var nivel_academico_list = new ew_Page("nivel_academico_list");

// page properties
nivel_academico_list.PageID = "list"; // page ID
nivel_academico_list.FormID = "fnivel_academicolist"; // form ID
var EW_PAGE_ID = nivel_academico_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
nivel_academico_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
nivel_academico_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nivel_academico_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($nivel_academico->Export == "") || (EW_EXPORT_MASTER_RECORD && $nivel_academico->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$nivel_academico_list->TotalRecs = $nivel_academico->SelectRecordCount();
	} else {
		if ($nivel_academico_list->Recordset = $nivel_academico_list->LoadRecordset())
			$nivel_academico_list->TotalRecs = $nivel_academico_list->Recordset->RecordCount();
	}
	$nivel_academico_list->StartRec = 1;
	if ($nivel_academico_list->DisplayRecs <= 0 || ($nivel_academico->Export <> "" && $nivel_academico->ExportAll)) // Display all records
		$nivel_academico_list->DisplayRecs = $nivel_academico_list->TotalRecs;
	if (!($nivel_academico->Export <> "" && $nivel_academico->ExportAll))
		$nivel_academico_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$nivel_academico_list->Recordset = $nivel_academico_list->LoadRecordset($nivel_academico_list->StartRec-1, $nivel_academico_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $nivel_academico->TableCaption() ?>
&nbsp;&nbsp;<?php $nivel_academico_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($nivel_academico->Export == "" && $nivel_academico->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(nivel_academico_list);" style="text-decoration: none;"><img id="nivel_academico_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="nivel_academico_list_SearchPanel">
<form name="fnivel_academicolistsrch" id="fnivel_academicolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="nivel_academico">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($nivel_academico->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $nivel_academico_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($nivel_academico->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($nivel_academico->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($nivel_academico->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $nivel_academico_list->ShowPageHeader(); ?>
<?php
$nivel_academico_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fnivel_academicolist" id="fnivel_academicolist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="nivel_academico">
<div id="gmp_nivel_academico" class="ewGridMiddlePanel">
<?php if ($nivel_academico_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $nivel_academico->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$nivel_academico_list->RenderListOptions();

// Render list options (header, left)
$nivel_academico_list->ListOptions->Render("header", "left");
?>
<?php if ($nivel_academico->nivel->Visible) { // nivel ?>
	<?php if ($nivel_academico->SortUrl($nivel_academico->nivel) == "") { ?>
		<td><?php echo $nivel_academico->nivel->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $nivel_academico->SortUrl($nivel_academico->nivel) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $nivel_academico->nivel->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($nivel_academico->nivel->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($nivel_academico->nivel->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$nivel_academico_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($nivel_academico->ExportAll && $nivel_academico->Export <> "") {
	$nivel_academico_list->StopRec = $nivel_academico_list->TotalRecs;
} else {

	// Set the last record to display
	if ($nivel_academico_list->TotalRecs > $nivel_academico_list->StartRec + $nivel_academico_list->DisplayRecs - 1)
		$nivel_academico_list->StopRec = $nivel_academico_list->StartRec + $nivel_academico_list->DisplayRecs - 1;
	else
		$nivel_academico_list->StopRec = $nivel_academico_list->TotalRecs;
}
$nivel_academico_list->RecCnt = $nivel_academico_list->StartRec - 1;
if ($nivel_academico_list->Recordset && !$nivel_academico_list->Recordset->EOF) {
	$nivel_academico_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $nivel_academico_list->StartRec > 1)
		$nivel_academico_list->Recordset->Move($nivel_academico_list->StartRec - 1);
} elseif (!$nivel_academico->AllowAddDeleteRow && $nivel_academico_list->StopRec == 0) {
	$nivel_academico_list->StopRec = $nivel_academico->GridAddRowCount;
}

// Initialize aggregate
$nivel_academico->RowType = EW_ROWTYPE_AGGREGATEINIT;
$nivel_academico->ResetAttrs();
$nivel_academico_list->RenderRow();
$nivel_academico_list->RowCnt = 0;
while ($nivel_academico_list->RecCnt < $nivel_academico_list->StopRec) {
	$nivel_academico_list->RecCnt++;
	if (intval($nivel_academico_list->RecCnt) >= intval($nivel_academico_list->StartRec)) {
		$nivel_academico_list->RowCnt++;

		// Set up key count
		$nivel_academico_list->KeyCount = $nivel_academico_list->RowIndex;

		// Init row class and style
		$nivel_academico->ResetAttrs();
		$nivel_academico->CssClass = "";
		if ($nivel_academico->CurrentAction == "gridadd") {
		} else {
			$nivel_academico_list->LoadRowValues($nivel_academico_list->Recordset); // Load row values
		}
		$nivel_academico->RowType = EW_ROWTYPE_VIEW; // Render view
		$nivel_academico->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$nivel_academico_list->RenderRow();

		// Render list options
		$nivel_academico_list->RenderListOptions();
?>
	<tr<?php echo $nivel_academico->RowAttributes() ?>>
<?php

// Render list options (body, left)
$nivel_academico_list->ListOptions->Render("body", "left");
?>
	<?php if ($nivel_academico->nivel->Visible) { // nivel ?>
		<td<?php echo $nivel_academico->nivel->CellAttributes() ?>>
<div<?php echo $nivel_academico->nivel->ViewAttributes() ?>><?php echo $nivel_academico->nivel->ListViewValue() ?></div>
<a name="<?php echo $nivel_academico_list->PageObjName . "_row_" . $nivel_academico_list->RowCnt ?>" id="<?php echo $nivel_academico_list->PageObjName . "_row_" . $nivel_academico_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php

// Render list options (body, right)
$nivel_academico_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($nivel_academico->CurrentAction <> "gridadd")
		$nivel_academico_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($nivel_academico_list->Recordset)
	$nivel_academico_list->Recordset->Close();
?>
<?php if ($nivel_academico->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($nivel_academico->CurrentAction <> "gridadd" && $nivel_academico->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($nivel_academico_list->Pager)) $nivel_academico_list->Pager = new cPrevNextPager($nivel_academico_list->StartRec, $nivel_academico_list->DisplayRecs, $nivel_academico_list->TotalRecs) ?>
<?php if ($nivel_academico_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($nivel_academico_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $nivel_academico_list->PageUrl() ?>start=<?php echo $nivel_academico_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($nivel_academico_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $nivel_academico_list->PageUrl() ?>start=<?php echo $nivel_academico_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $nivel_academico_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($nivel_academico_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $nivel_academico_list->PageUrl() ?>start=<?php echo $nivel_academico_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($nivel_academico_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $nivel_academico_list->PageUrl() ?>start=<?php echo $nivel_academico_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $nivel_academico_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $nivel_academico_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $nivel_academico_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $nivel_academico_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($nivel_academico_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $nivel_academico_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($nivel_academico->Export == "" && $nivel_academico->CurrentAction == "") { ?>
<?php } ?>
<?php
$nivel_academico_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($nivel_academico->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$nivel_academico_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cnivel_academico_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'nivel_academico';

	// Page object name
	var $PageObjName = 'nivel_academico_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $nivel_academico;
		if ($nivel_academico->UseTokenInUrl) $PageUrl .= "t=" . $nivel_academico->TableVar . "&"; // Add page token
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
		global $objForm, $nivel_academico;
		if ($nivel_academico->UseTokenInUrl) {
			if ($objForm)
				return ($nivel_academico->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($nivel_academico->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cnivel_academico_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (nivel_academico)
		if (!isset($GLOBALS["nivel_academico"])) {
			$GLOBALS["nivel_academico"] = new cnivel_academico();
			$GLOBALS["Table"] =& $GLOBALS["nivel_academico"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "nivel_academicoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "nivel_academicodelete.php";
		$this->MultiUpdateUrl = "nivel_academicoupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'nivel_academico', TRUE);

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
		global $nivel_academico;

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
			$nivel_academico->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $nivel_academico;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($nivel_academico->Export <> "" ||
				$nivel_academico->CurrentAction == "gridadd" ||
				$nivel_academico->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$nivel_academico->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($nivel_academico->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $nivel_academico->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$nivel_academico->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$nivel_academico->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$nivel_academico->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $nivel_academico->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$nivel_academico->setSessionWhere($sFilter);
		$nivel_academico->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $nivel_academico;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $nivel_academico->nivel, $Keyword);
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
		global $Security, $nivel_academico;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $nivel_academico->BasicSearchKeyword;
		$sSearchType = $nivel_academico->BasicSearchType;
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
			$nivel_academico->setSessionBasicSearchKeyword($sSearchKeyword);
			$nivel_academico->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $nivel_academico;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$nivel_academico->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $nivel_academico;
		$nivel_academico->setSessionBasicSearchKeyword("");
		$nivel_academico->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $nivel_academico;
		$bRestore = TRUE;
		if ($nivel_academico->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$nivel_academico->BasicSearchKeyword = $nivel_academico->getSessionBasicSearchKeyword();
			$nivel_academico->BasicSearchType = $nivel_academico->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $nivel_academico;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$nivel_academico->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$nivel_academico->CurrentOrderType = @$_GET["ordertype"];
			$nivel_academico->UpdateSort($nivel_academico->nivel); // nivel
			$nivel_academico->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $nivel_academico;
		$sOrderBy = $nivel_academico->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($nivel_academico->SqlOrderBy() <> "") {
				$sOrderBy = $nivel_academico->SqlOrderBy();
				$nivel_academico->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $nivel_academico;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$nivel_academico->setSessionOrderBy($sOrderBy);
				$nivel_academico->nivel->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$nivel_academico->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $nivel_academico;

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
		global $Security, $Language, $nivel_academico, $objForm;
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
		global $Security, $Language, $nivel_academico;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $nivel_academico;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$nivel_academico->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$nivel_academico->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $nivel_academico->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$nivel_academico->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$nivel_academico->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$nivel_academico->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $nivel_academico;
		$nivel_academico->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$nivel_academico->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $nivel_academico;

		// Call Recordset Selecting event
		$nivel_academico->Recordset_Selecting($nivel_academico->CurrentFilter);

		// Load List page SQL
		$sSql = $nivel_academico->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$nivel_academico->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $nivel_academico;
		$sFilter = $nivel_academico->KeyFilter();

		// Call Row Selecting event
		$nivel_academico->Row_Selecting($sFilter);

		// Load SQL based on filter
		$nivel_academico->CurrentFilter = $sFilter;
		$sSql = $nivel_academico->SQL();
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
		global $conn, $nivel_academico;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$nivel_academico->Row_Selected($row);
		$nivel_academico->id_nivel_academico->setDbValue($rs->fields('id_nivel_academico'));
		$nivel_academico->nivel->setDbValue($rs->fields('nivel'));
	}

	// Load old record
	function LoadOldRecord() {
		global $nivel_academico;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($nivel_academico->getKey("id_nivel_academico")) <> "")
			$nivel_academico->id_nivel_academico->CurrentValue = $nivel_academico->getKey("id_nivel_academico"); // id_nivel_academico
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$nivel_academico->CurrentFilter = $nivel_academico->KeyFilter();
			$sSql = $nivel_academico->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $nivel_academico;

		// Initialize URLs
		$this->ViewUrl = $nivel_academico->ViewUrl();
		$this->EditUrl = $nivel_academico->EditUrl();
		$this->InlineEditUrl = $nivel_academico->InlineEditUrl();
		$this->CopyUrl = $nivel_academico->CopyUrl();
		$this->InlineCopyUrl = $nivel_academico->InlineCopyUrl();
		$this->DeleteUrl = $nivel_academico->DeleteUrl();

		// Call Row_Rendering event
		$nivel_academico->Row_Rendering();

		// Common render codes for all row types
		// id_nivel_academico

		$nivel_academico->id_nivel_academico->CellCssStyle = "white-space: nowrap;";

		// nivel
		if ($nivel_academico->RowType == EW_ROWTYPE_VIEW) { // View row

			// nivel
			$nivel_academico->nivel->ViewValue = $nivel_academico->nivel->CurrentValue;
			$nivel_academico->nivel->ViewCustomAttributes = "";

			// nivel
			$nivel_academico->nivel->LinkCustomAttributes = "";
			$nivel_academico->nivel->HrefValue = "";
			$nivel_academico->nivel->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($nivel_academico->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$nivel_academico->Row_Rendered();
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
