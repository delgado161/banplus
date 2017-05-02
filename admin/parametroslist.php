<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "parametrosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$parametros_list = new cparametros_list();
$Page =& $parametros_list;

// Page init
$parametros_list->Page_Init();

// Page main
$parametros_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($parametros->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var parametros_list = new ew_Page("parametros_list");

// page properties
parametros_list.PageID = "list"; // page ID
parametros_list.FormID = "fparametroslist"; // form ID
var EW_PAGE_ID = parametros_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
parametros_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
parametros_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
parametros_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($parametros->Export == "") || (EW_EXPORT_MASTER_RECORD && $parametros->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$parametros_list->TotalRecs = $parametros->SelectRecordCount();
	} else {
		if ($parametros_list->Recordset = $parametros_list->LoadRecordset())
			$parametros_list->TotalRecs = $parametros_list->Recordset->RecordCount();
	}
	$parametros_list->StartRec = 1;
	if ($parametros_list->DisplayRecs <= 0 || ($parametros->Export <> "" && $parametros->ExportAll)) // Display all records
		$parametros_list->DisplayRecs = $parametros_list->TotalRecs;
	if (!($parametros->Export <> "" && $parametros->ExportAll))
		$parametros_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$parametros_list->Recordset = $parametros_list->LoadRecordset($parametros_list->StartRec-1, $parametros_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $parametros->TableCaption() ?>
&nbsp;&nbsp;<?php $parametros_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($parametros->Export == "" && $parametros->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(parametros_list);" style="text-decoration: none;"><img id="parametros_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="parametros_list_SearchPanel">
<form name="fparametroslistsrch" id="fparametroslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="parametros">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($parametros->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $parametros_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($parametros->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($parametros->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($parametros->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $parametros_list->ShowPageHeader(); ?>
<?php
$parametros_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fparametroslist" id="fparametroslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="parametros">
<div id="gmp_parametros" class="ewGridMiddlePanel">
<?php if ($parametros_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $parametros->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$parametros_list->RenderListOptions();

// Render list options (header, left)
$parametros_list->ListOptions->Render("header", "left");
?>
<?php if ($parametros->nombre->Visible) { // nombre ?>
	<?php if ($parametros->SortUrl($parametros->nombre) == "") { ?>
		<td><?php echo $parametros->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parametros->SortUrl($parametros->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parametros->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parametros->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parametros->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parametros->valor->Visible) { // valor ?>
	<?php if ($parametros->SortUrl($parametros->valor) == "") { ?>
		<td><?php echo $parametros->valor->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parametros->SortUrl($parametros->valor) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parametros->valor->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parametros->valor->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parametros->valor->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$parametros_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($parametros->ExportAll && $parametros->Export <> "") {
	$parametros_list->StopRec = $parametros_list->TotalRecs;
} else {

	// Set the last record to display
	if ($parametros_list->TotalRecs > $parametros_list->StartRec + $parametros_list->DisplayRecs - 1)
		$parametros_list->StopRec = $parametros_list->StartRec + $parametros_list->DisplayRecs - 1;
	else
		$parametros_list->StopRec = $parametros_list->TotalRecs;
}
$parametros_list->RecCnt = $parametros_list->StartRec - 1;
if ($parametros_list->Recordset && !$parametros_list->Recordset->EOF) {
	$parametros_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $parametros_list->StartRec > 1)
		$parametros_list->Recordset->Move($parametros_list->StartRec - 1);
} elseif (!$parametros->AllowAddDeleteRow && $parametros_list->StopRec == 0) {
	$parametros_list->StopRec = $parametros->GridAddRowCount;
}

// Initialize aggregate
$parametros->RowType = EW_ROWTYPE_AGGREGATEINIT;
$parametros->ResetAttrs();
$parametros_list->RenderRow();
$parametros_list->RowCnt = 0;
while ($parametros_list->RecCnt < $parametros_list->StopRec) {
	$parametros_list->RecCnt++;
	if (intval($parametros_list->RecCnt) >= intval($parametros_list->StartRec)) {
		$parametros_list->RowCnt++;

		// Set up key count
		$parametros_list->KeyCount = $parametros_list->RowIndex;

		// Init row class and style
		$parametros->ResetAttrs();
		$parametros->CssClass = "";
		if ($parametros->CurrentAction == "gridadd") {
		} else {
			$parametros_list->LoadRowValues($parametros_list->Recordset); // Load row values
		}
		$parametros->RowType = EW_ROWTYPE_VIEW; // Render view
		$parametros->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$parametros_list->RenderRow();

		// Render list options
		$parametros_list->RenderListOptions();
?>
	<tr<?php echo $parametros->RowAttributes() ?>>
<?php

// Render list options (body, left)
$parametros_list->ListOptions->Render("body", "left");
?>
	<?php if ($parametros->nombre->Visible) { // nombre ?>
		<td<?php echo $parametros->nombre->CellAttributes() ?>>
<div<?php echo $parametros->nombre->ViewAttributes() ?>><?php echo $parametros->nombre->ListViewValue() ?></div>
<a name="<?php echo $parametros_list->PageObjName . "_row_" . $parametros_list->RowCnt ?>" id="<?php echo $parametros_list->PageObjName . "_row_" . $parametros_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($parametros->valor->Visible) { // valor ?>
		<td<?php echo $parametros->valor->CellAttributes() ?>>
<div<?php echo $parametros->valor->ViewAttributes() ?>><?php echo $parametros->valor->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$parametros_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($parametros->CurrentAction <> "gridadd")
		$parametros_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($parametros_list->Recordset)
	$parametros_list->Recordset->Close();
?>
<?php if ($parametros->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($parametros->CurrentAction <> "gridadd" && $parametros->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($parametros_list->Pager)) $parametros_list->Pager = new cPrevNextPager($parametros_list->StartRec, $parametros_list->DisplayRecs, $parametros_list->TotalRecs) ?>
<?php if ($parametros_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($parametros_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $parametros_list->PageUrl() ?>start=<?php echo $parametros_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($parametros_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $parametros_list->PageUrl() ?>start=<?php echo $parametros_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $parametros_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($parametros_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $parametros_list->PageUrl() ?>start=<?php echo $parametros_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($parametros_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $parametros_list->PageUrl() ?>start=<?php echo $parametros_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $parametros_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $parametros_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $parametros_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $parametros_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($parametros_list->SearchWhere == "0=101") { ?>
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
<?php if ($parametros->Export == "" && $parametros->CurrentAction == "") { ?>
<?php } ?>
<?php
$parametros_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($parametros->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$parametros_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cparametros_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'parametros';

	// Page object name
	var $PageObjName = 'parametros_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $parametros;
		if ($parametros->UseTokenInUrl) $PageUrl .= "t=" . $parametros->TableVar . "&"; // Add page token
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
		global $objForm, $parametros;
		if ($parametros->UseTokenInUrl) {
			if ($objForm)
				return ($parametros->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($parametros->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cparametros_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (parametros)
		if (!isset($GLOBALS["parametros"])) {
			$GLOBALS["parametros"] = new cparametros();
			$GLOBALS["Table"] =& $GLOBALS["parametros"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "parametrosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "parametrosdelete.php";
		$this->MultiUpdateUrl = "parametrosupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'parametros', TRUE);

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
		global $parametros;

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
			$parametros->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $parametros;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($parametros->Export <> "" ||
				$parametros->CurrentAction == "gridadd" ||
				$parametros->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$parametros->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($parametros->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $parametros->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$parametros->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$parametros->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$parametros->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $parametros->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$parametros->setSessionWhere($sFilter);
		$parametros->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $parametros;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $parametros->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parametros->valor, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parametros->archivo, $Keyword);
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
		global $Security, $parametros;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $parametros->BasicSearchKeyword;
		$sSearchType = $parametros->BasicSearchType;
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
			$parametros->setSessionBasicSearchKeyword($sSearchKeyword);
			$parametros->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $parametros;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$parametros->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $parametros;
		$parametros->setSessionBasicSearchKeyword("");
		$parametros->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $parametros;
		$bRestore = TRUE;
		if ($parametros->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$parametros->BasicSearchKeyword = $parametros->getSessionBasicSearchKeyword();
			$parametros->BasicSearchType = $parametros->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $parametros;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$parametros->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$parametros->CurrentOrderType = @$_GET["ordertype"];
			$parametros->UpdateSort($parametros->nombre); // nombre
			$parametros->UpdateSort($parametros->valor); // valor
			$parametros->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $parametros;
		$sOrderBy = $parametros->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($parametros->SqlOrderBy() <> "") {
				$sOrderBy = $parametros->SqlOrderBy();
				$parametros->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $parametros;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$parametros->setSessionOrderBy($sOrderBy);
				$parametros->nombre->setSort("");
				$parametros->valor->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$parametros->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $parametros;

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

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $parametros, $objForm;
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
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $parametros;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $parametros;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$parametros->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$parametros->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $parametros->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$parametros->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$parametros->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$parametros->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $parametros;
		$parametros->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$parametros->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $parametros;

		// Call Recordset Selecting event
		$parametros->Recordset_Selecting($parametros->CurrentFilter);

		// Load List page SQL
		$sSql = $parametros->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$parametros->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $parametros;
		$sFilter = $parametros->KeyFilter();

		// Call Row Selecting event
		$parametros->Row_Selecting($sFilter);

		// Load SQL based on filter
		$parametros->CurrentFilter = $sFilter;
		$sSql = $parametros->SQL();
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
		global $conn, $parametros;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$parametros->Row_Selected($row);
		$parametros->id_parametro->setDbValue($rs->fields('id_parametro'));
		$parametros->nombre->setDbValue($rs->fields('nombre'));
		$parametros->valor->setDbValue($rs->fields('valor'));
		$parametros->archivo->Upload->DbValue = $rs->fields('archivo');
		$parametros->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $parametros;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($parametros->getKey("id_parametro")) <> "")
			$parametros->id_parametro->CurrentValue = $parametros->getKey("id_parametro"); // id_parametro
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$parametros->CurrentFilter = $parametros->KeyFilter();
			$sSql = $parametros->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $parametros;

		// Initialize URLs
		$this->ViewUrl = $parametros->ViewUrl();
		$this->EditUrl = $parametros->EditUrl();
		$this->InlineEditUrl = $parametros->InlineEditUrl();
		$this->CopyUrl = $parametros->CopyUrl();
		$this->InlineCopyUrl = $parametros->InlineCopyUrl();
		$this->DeleteUrl = $parametros->DeleteUrl();

		// Call Row_Rendering event
		$parametros->Row_Rendering();

		// Common render codes for all row types
		// id_parametro
		// nombre
		// valor
		// archivo
		// estatus

		$parametros->estatus->CellCssStyle = "white-space: nowrap;";
		if ($parametros->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$parametros->nombre->ViewValue = $parametros->nombre->CurrentValue;
			$parametros->nombre->ViewCustomAttributes = "";

			// valor
			$parametros->valor->ViewValue = $parametros->valor->CurrentValue;
			$parametros->valor->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($parametros->archivo->Upload->DbValue)) {
				$parametros->archivo->ViewValue = $parametros->archivo->Upload->DbValue;
			} else {
				$parametros->archivo->ViewValue = "";
			}
			$parametros->archivo->ViewCustomAttributes = "";

			// nombre
			$parametros->nombre->LinkCustomAttributes = "";
			$parametros->nombre->HrefValue = "";
			$parametros->nombre->TooltipValue = "";

			// valor
			$parametros->valor->LinkCustomAttributes = "";
			$parametros->valor->HrefValue = "";
			$parametros->valor->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($parametros->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$parametros->Row_Rendered();
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
		$table = 'parametros';
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
