<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuarionivelesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuarioniveles_list = new cusuarioniveles_list();
$Page =& $usuarioniveles_list;

// Page init
$usuarioniveles_list->Page_Init();

// Page main
$usuarioniveles_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuarioniveles->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuarioniveles_list = new ew_Page("usuarioniveles_list");

// page properties
usuarioniveles_list.PageID = "list"; // page ID
usuarioniveles_list.FormID = "fusuarioniveleslist"; // form ID
var EW_PAGE_ID = usuarioniveles_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarioniveles_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarioniveles_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarioniveles_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($usuarioniveles->Export == "") || (EW_EXPORT_MASTER_RECORD && $usuarioniveles->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$usuarioniveles_list->TotalRecs = $usuarioniveles->SelectRecordCount();
	} else {
		if ($usuarioniveles_list->Recordset = $usuarioniveles_list->LoadRecordset())
			$usuarioniveles_list->TotalRecs = $usuarioniveles_list->Recordset->RecordCount();
	}
	$usuarioniveles_list->StartRec = 1;
	if ($usuarioniveles_list->DisplayRecs <= 0 || ($usuarioniveles->Export <> "" && $usuarioniveles->ExportAll)) // Display all records
		$usuarioniveles_list->DisplayRecs = $usuarioniveles_list->TotalRecs;
	if (!($usuarioniveles->Export <> "" && $usuarioniveles->ExportAll))
		$usuarioniveles_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$usuarioniveles_list->Recordset = $usuarioniveles_list->LoadRecordset($usuarioniveles_list->StartRec-1, $usuarioniveles_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarioniveles->TableCaption() ?>
&nbsp;&nbsp;<?php $usuarioniveles_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($usuarioniveles->Export == "" && $usuarioniveles->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(usuarioniveles_list);" style="text-decoration: none;"><img id="usuarioniveles_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="usuarioniveles_list_SearchPanel">
<form name="fusuarioniveleslistsrch" id="fusuarioniveleslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="usuarioniveles">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($usuarioniveles->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $usuarioniveles_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($usuarioniveles->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($usuarioniveles->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($usuarioniveles->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $usuarioniveles_list->ShowPageHeader(); ?>
<?php
$usuarioniveles_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fusuarioniveleslist" id="fusuarioniveleslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="usuarioniveles">
<div id="gmp_usuarioniveles" class="ewGridMiddlePanel">
<?php if ($usuarioniveles_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $usuarioniveles->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$usuarioniveles_list->RenderListOptions();

// Render list options (header, left)
$usuarioniveles_list->ListOptions->Render("header", "left");
?>
<?php if ($usuarioniveles->userlevelname->Visible) { // userlevelname ?>
	<?php if ($usuarioniveles->SortUrl($usuarioniveles->userlevelname) == "") { ?>
		<td><?php echo $usuarioniveles->userlevelname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarioniveles->SortUrl($usuarioniveles->userlevelname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarioniveles->userlevelname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarioniveles->userlevelname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarioniveles->userlevelname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$usuarioniveles_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($usuarioniveles->ExportAll && $usuarioniveles->Export <> "") {
	$usuarioniveles_list->StopRec = $usuarioniveles_list->TotalRecs;
} else {

	// Set the last record to display
	if ($usuarioniveles_list->TotalRecs > $usuarioniveles_list->StartRec + $usuarioniveles_list->DisplayRecs - 1)
		$usuarioniveles_list->StopRec = $usuarioniveles_list->StartRec + $usuarioniveles_list->DisplayRecs - 1;
	else
		$usuarioniveles_list->StopRec = $usuarioniveles_list->TotalRecs;
}
$usuarioniveles_list->RecCnt = $usuarioniveles_list->StartRec - 1;
if ($usuarioniveles_list->Recordset && !$usuarioniveles_list->Recordset->EOF) {
	$usuarioniveles_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $usuarioniveles_list->StartRec > 1)
		$usuarioniveles_list->Recordset->Move($usuarioniveles_list->StartRec - 1);
} elseif (!$usuarioniveles->AllowAddDeleteRow && $usuarioniveles_list->StopRec == 0) {
	$usuarioniveles_list->StopRec = $usuarioniveles->GridAddRowCount;
}

// Initialize aggregate
$usuarioniveles->RowType = EW_ROWTYPE_AGGREGATEINIT;
$usuarioniveles->ResetAttrs();
$usuarioniveles_list->RenderRow();
$usuarioniveles_list->RowCnt = 0;
while ($usuarioniveles_list->RecCnt < $usuarioniveles_list->StopRec) {
	$usuarioniveles_list->RecCnt++;
	if (intval($usuarioniveles_list->RecCnt) >= intval($usuarioniveles_list->StartRec)) {
		$usuarioniveles_list->RowCnt++;

		// Set up key count
		$usuarioniveles_list->KeyCount = $usuarioniveles_list->RowIndex;

		// Init row class and style
		$usuarioniveles->ResetAttrs();
		$usuarioniveles->CssClass = "";
		if ($usuarioniveles->CurrentAction == "gridadd") {
		} else {
			$usuarioniveles_list->LoadRowValues($usuarioniveles_list->Recordset); // Load row values
		}
		$usuarioniveles->RowType = EW_ROWTYPE_VIEW; // Render view
		$usuarioniveles->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$usuarioniveles_list->RenderRow();

		// Render list options
		$usuarioniveles_list->RenderListOptions();
?>
	<tr<?php echo $usuarioniveles->RowAttributes() ?>>
<?php

// Render list options (body, left)
$usuarioniveles_list->ListOptions->Render("body", "left");
?>
	<?php if ($usuarioniveles->userlevelname->Visible) { // userlevelname ?>
		<td<?php echo $usuarioniveles->userlevelname->CellAttributes() ?>>
<div<?php echo $usuarioniveles->userlevelname->ViewAttributes() ?>><?php echo $usuarioniveles->userlevelname->ListViewValue() ?></div>
<a name="<?php echo $usuarioniveles_list->PageObjName . "_row_" . $usuarioniveles_list->RowCnt ?>" id="<?php echo $usuarioniveles_list->PageObjName . "_row_" . $usuarioniveles_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php

// Render list options (body, right)
$usuarioniveles_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($usuarioniveles->CurrentAction <> "gridadd")
		$usuarioniveles_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($usuarioniveles_list->Recordset)
	$usuarioniveles_list->Recordset->Close();
?>
<?php if ($usuarioniveles->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($usuarioniveles->CurrentAction <> "gridadd" && $usuarioniveles->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($usuarioniveles_list->Pager)) $usuarioniveles_list->Pager = new cPrevNextPager($usuarioniveles_list->StartRec, $usuarioniveles_list->DisplayRecs, $usuarioniveles_list->TotalRecs) ?>
<?php if ($usuarioniveles_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($usuarioniveles_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $usuarioniveles_list->PageUrl() ?>start=<?php echo $usuarioniveles_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($usuarioniveles_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $usuarioniveles_list->PageUrl() ?>start=<?php echo $usuarioniveles_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $usuarioniveles_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($usuarioniveles_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $usuarioniveles_list->PageUrl() ?>start=<?php echo $usuarioniveles_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($usuarioniveles_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $usuarioniveles_list->PageUrl() ?>start=<?php echo $usuarioniveles_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $usuarioniveles_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $usuarioniveles_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $usuarioniveles_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $usuarioniveles_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($usuarioniveles_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $usuarioniveles_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($usuarioniveles->Export == "" && $usuarioniveles->CurrentAction == "") { ?>
<?php } ?>
<?php
$usuarioniveles_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuarioniveles->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuarioniveles_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarioniveles_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'usuarioniveles';

	// Page object name
	var $PageObjName = 'usuarioniveles_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuarioniveles;
		if ($usuarioniveles->UseTokenInUrl) $PageUrl .= "t=" . $usuarioniveles->TableVar . "&"; // Add page token
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
		global $objForm, $usuarioniveles;
		if ($usuarioniveles->UseTokenInUrl) {
			if ($objForm)
				return ($usuarioniveles->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuarioniveles->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuarioniveles_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuarioniveles)
		if (!isset($GLOBALS["usuarioniveles"])) {
			$GLOBALS["usuarioniveles"] = new cusuarioniveles();
			$GLOBALS["Table"] =& $GLOBALS["usuarioniveles"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "usuarionivelesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "usuarionivelesdelete.php";
		$this->MultiUpdateUrl = "usuarionivelesupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuarioniveles', TRUE);

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
		global $usuarioniveles;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$usuarioniveles->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $usuarioniveles;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($usuarioniveles->Export <> "" ||
				$usuarioniveles->CurrentAction == "gridadd" ||
				$usuarioniveles->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$usuarioniveles->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($usuarioniveles->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $usuarioniveles->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$usuarioniveles->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$usuarioniveles->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$usuarioniveles->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $usuarioniveles->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$usuarioniveles->setSessionWhere($sFilter);
		$usuarioniveles->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $usuarioniveles;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $usuarioniveles->userlevelname, $Keyword);
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
		global $Security, $usuarioniveles;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $usuarioniveles->BasicSearchKeyword;
		$sSearchType = $usuarioniveles->BasicSearchType;
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
			$usuarioniveles->setSessionBasicSearchKeyword($sSearchKeyword);
			$usuarioniveles->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $usuarioniveles;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$usuarioniveles->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $usuarioniveles;
		$usuarioniveles->setSessionBasicSearchKeyword("");
		$usuarioniveles->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $usuarioniveles;
		$bRestore = TRUE;
		if ($usuarioniveles->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$usuarioniveles->BasicSearchKeyword = $usuarioniveles->getSessionBasicSearchKeyword();
			$usuarioniveles->BasicSearchType = $usuarioniveles->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $usuarioniveles;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$usuarioniveles->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$usuarioniveles->CurrentOrderType = @$_GET["ordertype"];
			$usuarioniveles->UpdateSort($usuarioniveles->userlevelname); // userlevelname
			$usuarioniveles->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $usuarioniveles;
		$sOrderBy = $usuarioniveles->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($usuarioniveles->SqlOrderBy() <> "") {
				$sOrderBy = $usuarioniveles->SqlOrderBy();
				$usuarioniveles->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $usuarioniveles;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$usuarioniveles->setSessionOrderBy($sOrderBy);
				$usuarioniveles->userlevelname->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$usuarioniveles->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $usuarioniveles;

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

		// "userpermission"
		$item =& $this->ListOptions->Add("userpermission");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsAdmin();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $usuarioniveles, $objForm;
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

		// "userpermission"
		$oListOpt =& $this->ListOptions->Items["userpermission"];
		if ($usuarioniveles->userlevelid->CurrentValue < 0) {
			$oListOpt->Body = "-";
		} else {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . "userpriv.php?userlevelid=" . $usuarioniveles->userlevelid->CurrentValue . "\">" . $Language->Phrase("Permission") . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $usuarioniveles;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuarioniveles;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuarioniveles->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuarioniveles->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuarioniveles->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuarioniveles->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuarioniveles->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuarioniveles->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $usuarioniveles;
		$usuarioniveles->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$usuarioniveles->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuarioniveles;

		// Call Recordset Selecting event
		$usuarioniveles->Recordset_Selecting($usuarioniveles->CurrentFilter);

		// Load List page SQL
		$sSql = $usuarioniveles->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$usuarioniveles->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuarioniveles;
		$sFilter = $usuarioniveles->KeyFilter();

		// Call Row Selecting event
		$usuarioniveles->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuarioniveles->CurrentFilter = $sFilter;
		$sSql = $usuarioniveles->SQL();
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
		global $conn, $usuarioniveles;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuarioniveles->Row_Selected($row);
		$usuarioniveles->userlevelid->setDbValue($rs->fields('userlevelid'));
		if (is_null($usuarioniveles->userlevelid->CurrentValue)) {
			$usuarioniveles->userlevelid->CurrentValue = 0;
		} else {
			$usuarioniveles->userlevelid->CurrentValue = intval($usuarioniveles->userlevelid->CurrentValue);
		}
		$usuarioniveles->userlevelname->setDbValue($rs->fields('userlevelname'));
	}

	// Load old record
	function LoadOldRecord() {
		global $usuarioniveles;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($usuarioniveles->getKey("userlevelid")) <> "")
			$usuarioniveles->userlevelid->CurrentValue = $usuarioniveles->getKey("userlevelid"); // userlevelid
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$usuarioniveles->CurrentFilter = $usuarioniveles->KeyFilter();
			$sSql = $usuarioniveles->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuarioniveles;

		// Initialize URLs
		$this->ViewUrl = $usuarioniveles->ViewUrl();
		$this->EditUrl = $usuarioniveles->EditUrl();
		$this->InlineEditUrl = $usuarioniveles->InlineEditUrl();
		$this->CopyUrl = $usuarioniveles->CopyUrl();
		$this->InlineCopyUrl = $usuarioniveles->InlineCopyUrl();
		$this->DeleteUrl = $usuarioniveles->DeleteUrl();

		// Call Row_Rendering event
		$usuarioniveles->Row_Rendering();

		// Common render codes for all row types
		// userlevelid
		// userlevelname

		if ($usuarioniveles->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelname
			$usuarioniveles->userlevelname->ViewValue = $usuarioniveles->userlevelname->CurrentValue;
			$usuarioniveles->userlevelname->ViewCustomAttributes = "";

			// userlevelname
			$usuarioniveles->userlevelname->LinkCustomAttributes = "";
			$usuarioniveles->userlevelname->HrefValue = "";
			$usuarioniveles->userlevelname->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuarioniveles->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuarioniveles->Row_Rendered();
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
		$table = 'usuarioniveles';
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
