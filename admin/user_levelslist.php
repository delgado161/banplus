<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "user_levelsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$user_levels_list = new cuser_levels_list();
$Page =& $user_levels_list;

// Page init
$user_levels_list->Page_Init();

// Page main
$user_levels_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($user_levels->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var user_levels_list = new ew_Page("user_levels_list");

// page properties
user_levels_list.PageID = "list"; // page ID
user_levels_list.FormID = "fuser_levelslist"; // form ID
var EW_PAGE_ID = user_levels_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
user_levels_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_levels_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_levels_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($user_levels->Export == "") || (EW_EXPORT_MASTER_RECORD && $user_levels->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$user_levels_list->TotalRecs = $user_levels->SelectRecordCount();
	} else {
		if ($user_levels_list->Recordset = $user_levels_list->LoadRecordset())
			$user_levels_list->TotalRecs = $user_levels_list->Recordset->RecordCount();
	}
	$user_levels_list->StartRec = 1;
	if ($user_levels_list->DisplayRecs <= 0 || ($user_levels->Export <> "" && $user_levels->ExportAll)) // Display all records
		$user_levels_list->DisplayRecs = $user_levels_list->TotalRecs;
	if (!($user_levels->Export <> "" && $user_levels->ExportAll))
		$user_levels_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$user_levels_list->Recordset = $user_levels_list->LoadRecordset($user_levels_list->StartRec-1, $user_levels_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $user_levels->TableCaption() ?>
&nbsp;&nbsp;<?php $user_levels_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($user_levels->Export == "" && $user_levels->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(user_levels_list);" style="text-decoration: none;"><img id="user_levels_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="user_levels_list_SearchPanel">
<form name="fuser_levelslistsrch" id="fuser_levelslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="user_levels">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($user_levels->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $user_levels_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($user_levels->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($user_levels->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($user_levels->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $user_levels_list->ShowPageHeader(); ?>
<?php
$user_levels_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fuser_levelslist" id="fuser_levelslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="user_levels">
<div id="gmp_user_levels" class="ewGridMiddlePanel">
<?php if ($user_levels_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $user_levels->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$user_levels_list->RenderListOptions();

// Render list options (header, left)
$user_levels_list->ListOptions->Render("header", "left");
?>
<?php if ($user_levels->UserLevelID->Visible) { // UserLevelID ?>
	<?php if ($user_levels->SortUrl($user_levels->UserLevelID) == "") { ?>
		<td><?php echo $user_levels->UserLevelID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $user_levels->SortUrl($user_levels->UserLevelID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $user_levels->UserLevelID->FldCaption() ?></td><td style="width: 10px;"><?php if ($user_levels->UserLevelID->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($user_levels->UserLevelID->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($user_levels->UserLevelName->Visible) { // UserLevelName ?>
	<?php if ($user_levels->SortUrl($user_levels->UserLevelName) == "") { ?>
		<td><?php echo $user_levels->UserLevelName->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $user_levels->SortUrl($user_levels->UserLevelName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $user_levels->UserLevelName->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($user_levels->UserLevelName->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($user_levels->UserLevelName->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$user_levels_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($user_levels->ExportAll && $user_levels->Export <> "") {
	$user_levels_list->StopRec = $user_levels_list->TotalRecs;
} else {

	// Set the last record to display
	if ($user_levels_list->TotalRecs > $user_levels_list->StartRec + $user_levels_list->DisplayRecs - 1)
		$user_levels_list->StopRec = $user_levels_list->StartRec + $user_levels_list->DisplayRecs - 1;
	else
		$user_levels_list->StopRec = $user_levels_list->TotalRecs;
}
$user_levels_list->RecCnt = $user_levels_list->StartRec - 1;
if ($user_levels_list->Recordset && !$user_levels_list->Recordset->EOF) {
	$user_levels_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $user_levels_list->StartRec > 1)
		$user_levels_list->Recordset->Move($user_levels_list->StartRec - 1);
} elseif (!$user_levels->AllowAddDeleteRow && $user_levels_list->StopRec == 0) {
	$user_levels_list->StopRec = $user_levels->GridAddRowCount;
}

// Initialize aggregate
$user_levels->RowType = EW_ROWTYPE_AGGREGATEINIT;
$user_levels->ResetAttrs();
$user_levels_list->RenderRow();
$user_levels_list->RowCnt = 0;
while ($user_levels_list->RecCnt < $user_levels_list->StopRec) {
	$user_levels_list->RecCnt++;
	if (intval($user_levels_list->RecCnt) >= intval($user_levels_list->StartRec)) {
		$user_levels_list->RowCnt++;

		// Set up key count
		$user_levels_list->KeyCount = $user_levels_list->RowIndex;

		// Init row class and style
		$user_levels->ResetAttrs();
		$user_levels->CssClass = "";
		if ($user_levels->CurrentAction == "gridadd") {
		} else {
			$user_levels_list->LoadRowValues($user_levels_list->Recordset); // Load row values
		}
		$user_levels->RowType = EW_ROWTYPE_VIEW; // Render view
		$user_levels->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$user_levels_list->RenderRow();

		// Render list options
		$user_levels_list->RenderListOptions();
?>
	<tr<?php echo $user_levels->RowAttributes() ?>>
<?php

// Render list options (body, left)
$user_levels_list->ListOptions->Render("body", "left");
?>
	<?php if ($user_levels->UserLevelID->Visible) { // UserLevelID ?>
		<td<?php echo $user_levels->UserLevelID->CellAttributes() ?>>
<div<?php echo $user_levels->UserLevelID->ViewAttributes() ?>><?php echo $user_levels->UserLevelID->ListViewValue() ?></div>
<a name="<?php echo $user_levels_list->PageObjName . "_row_" . $user_levels_list->RowCnt ?>" id="<?php echo $user_levels_list->PageObjName . "_row_" . $user_levels_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($user_levels->UserLevelName->Visible) { // UserLevelName ?>
		<td<?php echo $user_levels->UserLevelName->CellAttributes() ?>>
<div<?php echo $user_levels->UserLevelName->ViewAttributes() ?>><?php echo $user_levels->UserLevelName->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_levels_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($user_levels->CurrentAction <> "gridadd")
		$user_levels_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($user_levels_list->Recordset)
	$user_levels_list->Recordset->Close();
?>
<?php if ($user_levels->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($user_levels->CurrentAction <> "gridadd" && $user_levels->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($user_levels_list->Pager)) $user_levels_list->Pager = new cPrevNextPager($user_levels_list->StartRec, $user_levels_list->DisplayRecs, $user_levels_list->TotalRecs) ?>
<?php if ($user_levels_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($user_levels_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $user_levels_list->PageUrl() ?>start=<?php echo $user_levels_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($user_levels_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $user_levels_list->PageUrl() ?>start=<?php echo $user_levels_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $user_levels_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($user_levels_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $user_levels_list->PageUrl() ?>start=<?php echo $user_levels_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($user_levels_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $user_levels_list->PageUrl() ?>start=<?php echo $user_levels_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $user_levels_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $user_levels_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $user_levels_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $user_levels_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($user_levels_list->SearchWhere == "0=101") { ?>
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
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $user_levels_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($user_levels->Export == "" && $user_levels->CurrentAction == "") { ?>
<?php } ?>
<?php
$user_levels_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($user_levels->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$user_levels_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cuser_levels_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'user_levels';

	// Page object name
	var $PageObjName = 'user_levels_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $user_levels;
		if ($user_levels->UseTokenInUrl) $PageUrl .= "t=" . $user_levels->TableVar . "&"; // Add page token
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
		global $objForm, $user_levels;
		if ($user_levels->UseTokenInUrl) {
			if ($objForm)
				return ($user_levels->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($user_levels->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuser_levels_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (user_levels)
		if (!isset($GLOBALS["user_levels"])) {
			$GLOBALS["user_levels"] = new cuser_levels();
			$GLOBALS["Table"] =& $GLOBALS["user_levels"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "user_levelsadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "user_levelsdelete.php";
		$this->MultiUpdateUrl = "user_levelsupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'user_levels', TRUE);

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
		global $user_levels;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$user_levels->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $user_levels;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($user_levels->Export <> "" ||
				$user_levels->CurrentAction == "gridadd" ||
				$user_levels->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$user_levels->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($user_levels->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $user_levels->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$user_levels->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$user_levels->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$user_levels->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $user_levels->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$user_levels->setSessionWhere($sFilter);
		$user_levels->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $user_levels;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $user_levels->UserLevelName, $Keyword);
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
		global $Security, $user_levels;
		$sSearchStr = "";
		$sSearchKeyword = $user_levels->BasicSearchKeyword;
		$sSearchType = $user_levels->BasicSearchType;
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
			$user_levels->setSessionBasicSearchKeyword($sSearchKeyword);
			$user_levels->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $user_levels;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$user_levels->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $user_levels;
		$user_levels->setSessionBasicSearchKeyword("");
		$user_levels->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $user_levels;
		$bRestore = TRUE;
		if ($user_levels->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$user_levels->BasicSearchKeyword = $user_levels->getSessionBasicSearchKeyword();
			$user_levels->BasicSearchType = $user_levels->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $user_levels;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$user_levels->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$user_levels->CurrentOrderType = @$_GET["ordertype"];
			$user_levels->UpdateSort($user_levels->UserLevelID); // UserLevelID
			$user_levels->UpdateSort($user_levels->UserLevelName); // UserLevelName
			$user_levels->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $user_levels;
		$sOrderBy = $user_levels->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($user_levels->SqlOrderBy() <> "") {
				$sOrderBy = $user_levels->SqlOrderBy();
				$user_levels->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $user_levels;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$user_levels->setSessionOrderBy($sOrderBy);
				$user_levels->UserLevelID->setSort("");
				$user_levels->UserLevelName->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$user_levels->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $user_levels;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $user_levels, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $user_levels;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $user_levels;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$user_levels->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$user_levels->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $user_levels->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$user_levels->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$user_levels->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$user_levels->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $user_levels;
		$user_levels->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$user_levels->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $user_levels;

		// Call Recordset Selecting event
		$user_levels->Recordset_Selecting($user_levels->CurrentFilter);

		// Load List page SQL
		$sSql = $user_levels->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$user_levels->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $user_levels;
		$sFilter = $user_levels->KeyFilter();

		// Call Row Selecting event
		$user_levels->Row_Selecting($sFilter);

		// Load SQL based on filter
		$user_levels->CurrentFilter = $sFilter;
		$sSql = $user_levels->SQL();
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
		global $conn, $user_levels;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$user_levels->Row_Selected($row);
		$user_levels->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$user_levels->UserLevelName->setDbValue($rs->fields('UserLevelName'));
	}

	// Load old record
	function LoadOldRecord() {
		global $user_levels;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($user_levels->getKey("UserLevelID")) <> "")
			$user_levels->UserLevelID->CurrentValue = $user_levels->getKey("UserLevelID"); // UserLevelID
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$user_levels->CurrentFilter = $user_levels->KeyFilter();
			$sSql = $user_levels->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $user_levels;

		// Initialize URLs
		$this->ViewUrl = $user_levels->ViewUrl();
		$this->EditUrl = $user_levels->EditUrl();
		$this->InlineEditUrl = $user_levels->InlineEditUrl();
		$this->CopyUrl = $user_levels->CopyUrl();
		$this->InlineCopyUrl = $user_levels->InlineCopyUrl();
		$this->DeleteUrl = $user_levels->DeleteUrl();

		// Call Row_Rendering event
		$user_levels->Row_Rendering();

		// Common render codes for all row types
		// UserLevelID
		// UserLevelName

		if ($user_levels->RowType == EW_ROWTYPE_VIEW) { // View row

			// UserLevelID
			$user_levels->UserLevelID->ViewValue = $user_levels->UserLevelID->CurrentValue;
			$user_levels->UserLevelID->ViewCustomAttributes = "";

			// UserLevelName
			$user_levels->UserLevelName->ViewValue = $user_levels->UserLevelName->CurrentValue;
			$user_levels->UserLevelName->ViewCustomAttributes = "";

			// UserLevelID
			$user_levels->UserLevelID->LinkCustomAttributes = "";
			$user_levels->UserLevelID->HrefValue = "";
			$user_levels->UserLevelID->TooltipValue = "";

			// UserLevelName
			$user_levels->UserLevelName->LinkCustomAttributes = "";
			$user_levels->UserLevelName->HrefValue = "";
			$user_levels->UserLevelName->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($user_levels->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$user_levels->Row_Rendered();
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
