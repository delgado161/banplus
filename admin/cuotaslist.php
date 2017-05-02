<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "cuotasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$cuotas_list = new ccuotas_list();
$Page =& $cuotas_list;

// Page init
$cuotas_list->Page_Init();

// Page main
$cuotas_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($cuotas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cuotas_list = new ew_Page("cuotas_list");

// page properties
cuotas_list.PageID = "list"; // page ID
cuotas_list.FormID = "fcuotaslist"; // form ID
var EW_PAGE_ID = cuotas_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cuotas_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cuotas_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cuotas_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($cuotas->Export == "") || (EW_EXPORT_MASTER_RECORD && $cuotas->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$cuotas_list->TotalRecs = $cuotas->SelectRecordCount();
	} else {
		if ($cuotas_list->Recordset = $cuotas_list->LoadRecordset())
			$cuotas_list->TotalRecs = $cuotas_list->Recordset->RecordCount();
	}
	$cuotas_list->StartRec = 1;
	if ($cuotas_list->DisplayRecs <= 0 || ($cuotas->Export <> "" && $cuotas->ExportAll)) // Display all records
		$cuotas_list->DisplayRecs = $cuotas_list->TotalRecs;
	if (!($cuotas->Export <> "" && $cuotas->ExportAll))
		$cuotas_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$cuotas_list->Recordset = $cuotas_list->LoadRecordset($cuotas_list->StartRec-1, $cuotas_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $cuotas->TableCaption() ?>
&nbsp;&nbsp;<?php $cuotas_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($cuotas->Export == "" && $cuotas->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(cuotas_list);" style="text-decoration: none;"><img id="cuotas_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="cuotas_list_SearchPanel">
<form name="fcuotaslistsrch" id="fcuotaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="cuotas">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($cuotas->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $cuotas_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($cuotas->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($cuotas->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($cuotas->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $cuotas_list->ShowPageHeader(); ?>
<?php
$cuotas_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fcuotaslist" id="fcuotaslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="cuotas">
<div id="gmp_cuotas" class="ewGridMiddlePanel">
<?php if ($cuotas_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $cuotas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$cuotas_list->RenderListOptions();

// Render list options (header, left)
$cuotas_list->ListOptions->Render("header", "left");
?>
<?php if ($cuotas->meses->Visible) { // meses ?>
	<?php if ($cuotas->SortUrl($cuotas->meses) == "") { ?>
		<td><?php echo $cuotas->meses->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuotas->SortUrl($cuotas->meses) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $cuotas->meses->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($cuotas->meses->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuotas->meses->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($cuotas->tipo->Visible) { // tipo ?>
	<?php if ($cuotas->SortUrl($cuotas->tipo) == "") { ?>
		<td><?php echo $cuotas->tipo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cuotas->SortUrl($cuotas->tipo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $cuotas->tipo->FldCaption() ?></td><td style="width: 10px;"><?php if ($cuotas->tipo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cuotas->tipo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cuotas_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($cuotas->ExportAll && $cuotas->Export <> "") {
	$cuotas_list->StopRec = $cuotas_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cuotas_list->TotalRecs > $cuotas_list->StartRec + $cuotas_list->DisplayRecs - 1)
		$cuotas_list->StopRec = $cuotas_list->StartRec + $cuotas_list->DisplayRecs - 1;
	else
		$cuotas_list->StopRec = $cuotas_list->TotalRecs;
}
$cuotas_list->RecCnt = $cuotas_list->StartRec - 1;
if ($cuotas_list->Recordset && !$cuotas_list->Recordset->EOF) {
	$cuotas_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $cuotas_list->StartRec > 1)
		$cuotas_list->Recordset->Move($cuotas_list->StartRec - 1);
} elseif (!$cuotas->AllowAddDeleteRow && $cuotas_list->StopRec == 0) {
	$cuotas_list->StopRec = $cuotas->GridAddRowCount;
}

// Initialize aggregate
$cuotas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cuotas->ResetAttrs();
$cuotas_list->RenderRow();
$cuotas_list->RowCnt = 0;
while ($cuotas_list->RecCnt < $cuotas_list->StopRec) {
	$cuotas_list->RecCnt++;
	if (intval($cuotas_list->RecCnt) >= intval($cuotas_list->StartRec)) {
		$cuotas_list->RowCnt++;

		// Set up key count
		$cuotas_list->KeyCount = $cuotas_list->RowIndex;

		// Init row class and style
		$cuotas->ResetAttrs();
		$cuotas->CssClass = "";
		if ($cuotas->CurrentAction == "gridadd") {
		} else {
			$cuotas_list->LoadRowValues($cuotas_list->Recordset); // Load row values
		}
		$cuotas->RowType = EW_ROWTYPE_VIEW; // Render view
		$cuotas->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$cuotas_list->RenderRow();

		// Render list options
		$cuotas_list->RenderListOptions();
?>
	<tr<?php echo $cuotas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cuotas_list->ListOptions->Render("body", "left");
?>
	<?php if ($cuotas->meses->Visible) { // meses ?>
		<td<?php echo $cuotas->meses->CellAttributes() ?>>
<div<?php echo $cuotas->meses->ViewAttributes() ?>><?php echo $cuotas->meses->ListViewValue() ?></div>
<a name="<?php echo $cuotas_list->PageObjName . "_row_" . $cuotas_list->RowCnt ?>" id="<?php echo $cuotas_list->PageObjName . "_row_" . $cuotas_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cuotas->tipo->Visible) { // tipo ?>
		<td<?php echo $cuotas->tipo->CellAttributes() ?>>
<div<?php echo $cuotas->tipo->ViewAttributes() ?>><?php echo $cuotas->tipo->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cuotas_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($cuotas->CurrentAction <> "gridadd")
		$cuotas_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($cuotas_list->Recordset)
	$cuotas_list->Recordset->Close();
?>
<?php if ($cuotas->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($cuotas->CurrentAction <> "gridadd" && $cuotas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($cuotas_list->Pager)) $cuotas_list->Pager = new cPrevNextPager($cuotas_list->StartRec, $cuotas_list->DisplayRecs, $cuotas_list->TotalRecs) ?>
<?php if ($cuotas_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($cuotas_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $cuotas_list->PageUrl() ?>start=<?php echo $cuotas_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($cuotas_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $cuotas_list->PageUrl() ?>start=<?php echo $cuotas_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cuotas_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($cuotas_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $cuotas_list->PageUrl() ?>start=<?php echo $cuotas_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($cuotas_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $cuotas_list->PageUrl() ?>start=<?php echo $cuotas_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cuotas_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cuotas_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cuotas_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cuotas_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($cuotas_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $cuotas_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($cuotas->Export == "" && $cuotas->CurrentAction == "") { ?>
<?php } ?>
<?php
$cuotas_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($cuotas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cuotas_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccuotas_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'cuotas';

	// Page object name
	var $PageObjName = 'cuotas_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cuotas;
		if ($cuotas->UseTokenInUrl) $PageUrl .= "t=" . $cuotas->TableVar . "&"; // Add page token
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
		global $objForm, $cuotas;
		if ($cuotas->UseTokenInUrl) {
			if ($objForm)
				return ($cuotas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cuotas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccuotas_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (cuotas)
		if (!isset($GLOBALS["cuotas"])) {
			$GLOBALS["cuotas"] = new ccuotas();
			$GLOBALS["Table"] =& $GLOBALS["cuotas"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "cuotasadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "cuotasdelete.php";
		$this->MultiUpdateUrl = "cuotasupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cuotas', TRUE);

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
		global $cuotas;

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
			$cuotas->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $cuotas;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($cuotas->Export <> "" ||
				$cuotas->CurrentAction == "gridadd" ||
				$cuotas->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$cuotas->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($cuotas->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $cuotas->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$cuotas->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$cuotas->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$cuotas->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $cuotas->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$cuotas->setSessionWhere($sFilter);
		$cuotas->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $cuotas;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $cuotas->meses, $Keyword);
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
		global $Security, $cuotas;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $cuotas->BasicSearchKeyword;
		$sSearchType = $cuotas->BasicSearchType;
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
			$cuotas->setSessionBasicSearchKeyword($sSearchKeyword);
			$cuotas->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $cuotas;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$cuotas->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $cuotas;
		$cuotas->setSessionBasicSearchKeyword("");
		$cuotas->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $cuotas;
		$bRestore = TRUE;
		if ($cuotas->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$cuotas->BasicSearchKeyword = $cuotas->getSessionBasicSearchKeyword();
			$cuotas->BasicSearchType = $cuotas->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $cuotas;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$cuotas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$cuotas->CurrentOrderType = @$_GET["ordertype"];
			$cuotas->UpdateSort($cuotas->meses); // meses
			$cuotas->UpdateSort($cuotas->tipo); // tipo
			$cuotas->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $cuotas;
		$sOrderBy = $cuotas->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($cuotas->SqlOrderBy() <> "") {
				$sOrderBy = $cuotas->SqlOrderBy();
				$cuotas->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $cuotas;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$cuotas->setSessionOrderBy($sOrderBy);
				$cuotas->meses->setSort("");
				$cuotas->tipo->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$cuotas->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $cuotas;

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
		global $Security, $Language, $cuotas, $objForm;
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
		global $Security, $Language, $cuotas;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $cuotas;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$cuotas->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$cuotas->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $cuotas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$cuotas->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$cuotas->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$cuotas->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $cuotas;
		$cuotas->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$cuotas->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cuotas;

		// Call Recordset Selecting event
		$cuotas->Recordset_Selecting($cuotas->CurrentFilter);

		// Load List page SQL
		$sSql = $cuotas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$cuotas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cuotas;
		$sFilter = $cuotas->KeyFilter();

		// Call Row Selecting event
		$cuotas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$cuotas->CurrentFilter = $sFilter;
		$sSql = $cuotas->SQL();
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
		global $conn, $cuotas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$cuotas->Row_Selected($row);
		$cuotas->id_cuotas->setDbValue($rs->fields('id_cuotas'));
		$cuotas->meses->setDbValue($rs->fields('meses'));
		$cuotas->tipo->setDbValue($rs->fields('tipo'));
	}

	// Load old record
	function LoadOldRecord() {
		global $cuotas;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($cuotas->getKey("id_cuotas")) <> "")
			$cuotas->id_cuotas->CurrentValue = $cuotas->getKey("id_cuotas"); // id_cuotas
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$cuotas->CurrentFilter = $cuotas->KeyFilter();
			$sSql = $cuotas->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $cuotas;

		// Initialize URLs
		$this->ViewUrl = $cuotas->ViewUrl();
		$this->EditUrl = $cuotas->EditUrl();
		$this->InlineEditUrl = $cuotas->InlineEditUrl();
		$this->CopyUrl = $cuotas->CopyUrl();
		$this->InlineCopyUrl = $cuotas->InlineCopyUrl();
		$this->DeleteUrl = $cuotas->DeleteUrl();

		// Call Row_Rendering event
		$cuotas->Row_Rendering();

		// Common render codes for all row types
		// id_cuotas

		$cuotas->id_cuotas->CellCssStyle = "white-space: nowrap;";

		// meses
		// tipo

		if ($cuotas->RowType == EW_ROWTYPE_VIEW) { // View row

			// meses
			$cuotas->meses->ViewValue = $cuotas->meses->CurrentValue;
			$cuotas->meses->ViewCustomAttributes = "";

			// tipo
			if (strval($cuotas->tipo->CurrentValue) <> "") {
				switch ($cuotas->tipo->CurrentValue) {
					case "1":
						$cuotas->tipo->ViewValue = $cuotas->tipo->FldTagCaption(1) <> "" ? $cuotas->tipo->FldTagCaption(1) : $cuotas->tipo->CurrentValue;
						break;
					case "2":
						$cuotas->tipo->ViewValue = $cuotas->tipo->FldTagCaption(2) <> "" ? $cuotas->tipo->FldTagCaption(2) : $cuotas->tipo->CurrentValue;
						break;
					default:
						$cuotas->tipo->ViewValue = $cuotas->tipo->CurrentValue;
				}
			} else {
				$cuotas->tipo->ViewValue = NULL;
			}
			$cuotas->tipo->ViewCustomAttributes = "";

			// meses
			$cuotas->meses->LinkCustomAttributes = "";
			$cuotas->meses->HrefValue = "";
			$cuotas->meses->TooltipValue = "";

			// tipo
			$cuotas->tipo->LinkCustomAttributes = "";
			$cuotas->tipo->HrefValue = "";
			$cuotas->tipo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($cuotas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$cuotas->Row_Rendered();
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
