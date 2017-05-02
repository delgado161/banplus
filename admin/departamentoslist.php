<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "departamentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$departamentos_list = new cdepartamentos_list();
$Page =& $departamentos_list;

// Page init
$departamentos_list->Page_Init();

// Page main
$departamentos_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($departamentos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var departamentos_list = new ew_Page("departamentos_list");

// page properties
departamentos_list.PageID = "list"; // page ID
departamentos_list.FormID = "fdepartamentoslist"; // form ID
var EW_PAGE_ID = departamentos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
departamentos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
departamentos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
departamentos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($departamentos->Export == "") || (EW_EXPORT_MASTER_RECORD && $departamentos->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$departamentos_list->TotalRecs = $departamentos->SelectRecordCount();
	} else {
		if ($departamentos_list->Recordset = $departamentos_list->LoadRecordset())
			$departamentos_list->TotalRecs = $departamentos_list->Recordset->RecordCount();
	}
	$departamentos_list->StartRec = 1;
	if ($departamentos_list->DisplayRecs <= 0 || ($departamentos->Export <> "" && $departamentos->ExportAll)) // Display all records
		$departamentos_list->DisplayRecs = $departamentos_list->TotalRecs;
	if (!($departamentos->Export <> "" && $departamentos->ExportAll))
		$departamentos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$departamentos_list->Recordset = $departamentos_list->LoadRecordset($departamentos_list->StartRec-1, $departamentos_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $departamentos->TableCaption() ?>
&nbsp;&nbsp;<?php $departamentos_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($departamentos->Export == "" && $departamentos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(departamentos_list);" style="text-decoration: none;"><img id="departamentos_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="departamentos_list_SearchPanel">
<form name="fdepartamentoslistsrch" id="fdepartamentoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="departamentos">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($departamentos->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $departamentos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($departamentos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($departamentos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($departamentos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $departamentos_list->ShowPageHeader(); ?>
<?php
$departamentos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fdepartamentoslist" id="fdepartamentoslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="departamentos">
<div id="gmp_departamentos" class="ewGridMiddlePanel">
<?php if ($departamentos_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $departamentos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$departamentos_list->RenderListOptions();

// Render list options (header, left)
$departamentos_list->ListOptions->Render("header", "left");
?>
<?php if ($departamentos->nombre->Visible) { // nombre ?>
	<?php if ($departamentos->SortUrl($departamentos->nombre) == "") { ?>
		<td><?php echo $departamentos->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $departamentos->SortUrl($departamentos->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $departamentos->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($departamentos->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($departamentos->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($departamentos->zemail->Visible) { // email ?>
	<?php if ($departamentos->SortUrl($departamentos->zemail) == "") { ?>
		<td><?php echo $departamentos->zemail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $departamentos->SortUrl($departamentos->zemail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $departamentos->zemail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($departamentos->zemail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($departamentos->zemail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($departamentos->estatus->Visible) { // estatus ?>
	<?php if ($departamentos->SortUrl($departamentos->estatus) == "") { ?>
		<td><?php echo $departamentos->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $departamentos->SortUrl($departamentos->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $departamentos->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($departamentos->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($departamentos->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$departamentos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($departamentos->ExportAll && $departamentos->Export <> "") {
	$departamentos_list->StopRec = $departamentos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($departamentos_list->TotalRecs > $departamentos_list->StartRec + $departamentos_list->DisplayRecs - 1)
		$departamentos_list->StopRec = $departamentos_list->StartRec + $departamentos_list->DisplayRecs - 1;
	else
		$departamentos_list->StopRec = $departamentos_list->TotalRecs;
}
$departamentos_list->RecCnt = $departamentos_list->StartRec - 1;
if ($departamentos_list->Recordset && !$departamentos_list->Recordset->EOF) {
	$departamentos_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $departamentos_list->StartRec > 1)
		$departamentos_list->Recordset->Move($departamentos_list->StartRec - 1);
} elseif (!$departamentos->AllowAddDeleteRow && $departamentos_list->StopRec == 0) {
	$departamentos_list->StopRec = $departamentos->GridAddRowCount;
}

// Initialize aggregate
$departamentos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$departamentos->ResetAttrs();
$departamentos_list->RenderRow();
$departamentos_list->RowCnt = 0;
while ($departamentos_list->RecCnt < $departamentos_list->StopRec) {
	$departamentos_list->RecCnt++;
	if (intval($departamentos_list->RecCnt) >= intval($departamentos_list->StartRec)) {
		$departamentos_list->RowCnt++;

		// Set up key count
		$departamentos_list->KeyCount = $departamentos_list->RowIndex;

		// Init row class and style
		$departamentos->ResetAttrs();
		$departamentos->CssClass = "";
		if ($departamentos->CurrentAction == "gridadd") {
		} else {
			$departamentos_list->LoadRowValues($departamentos_list->Recordset); // Load row values
		}
		$departamentos->RowType = EW_ROWTYPE_VIEW; // Render view
		$departamentos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$departamentos_list->RenderRow();

		// Render list options
		$departamentos_list->RenderListOptions();
?>
	<tr<?php echo $departamentos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$departamentos_list->ListOptions->Render("body", "left");
?>
	<?php if ($departamentos->nombre->Visible) { // nombre ?>
		<td<?php echo $departamentos->nombre->CellAttributes() ?>>
<div<?php echo $departamentos->nombre->ViewAttributes() ?>><?php echo $departamentos->nombre->ListViewValue() ?></div>
<a name="<?php echo $departamentos_list->PageObjName . "_row_" . $departamentos_list->RowCnt ?>" id="<?php echo $departamentos_list->PageObjName . "_row_" . $departamentos_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($departamentos->zemail->Visible) { // email ?>
		<td<?php echo $departamentos->zemail->CellAttributes() ?>>
<div<?php echo $departamentos->zemail->ViewAttributes() ?>><?php echo $departamentos->zemail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($departamentos->estatus->Visible) { // estatus ?>
		<td<?php echo $departamentos->estatus->CellAttributes() ?>>
<div<?php echo $departamentos->estatus->ViewAttributes() ?>><?php echo $departamentos->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$departamentos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($departamentos->CurrentAction <> "gridadd")
		$departamentos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($departamentos_list->Recordset)
	$departamentos_list->Recordset->Close();
?>
<?php if ($departamentos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($departamentos->CurrentAction <> "gridadd" && $departamentos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($departamentos_list->Pager)) $departamentos_list->Pager = new cPrevNextPager($departamentos_list->StartRec, $departamentos_list->DisplayRecs, $departamentos_list->TotalRecs) ?>
<?php if ($departamentos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($departamentos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $departamentos_list->PageUrl() ?>start=<?php echo $departamentos_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($departamentos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $departamentos_list->PageUrl() ?>start=<?php echo $departamentos_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $departamentos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($departamentos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $departamentos_list->PageUrl() ?>start=<?php echo $departamentos_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($departamentos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $departamentos_list->PageUrl() ?>start=<?php echo $departamentos_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $departamentos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $departamentos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $departamentos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $departamentos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($departamentos_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $departamentos_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($departamentos->Export == "" && $departamentos->CurrentAction == "") { ?>
<?php } ?>
<?php
$departamentos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($departamentos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$departamentos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cdepartamentos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'departamentos';

	// Page object name
	var $PageObjName = 'departamentos_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $departamentos;
		if ($departamentos->UseTokenInUrl) $PageUrl .= "t=" . $departamentos->TableVar . "&"; // Add page token
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
		global $objForm, $departamentos;
		if ($departamentos->UseTokenInUrl) {
			if ($objForm)
				return ($departamentos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($departamentos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdepartamentos_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (departamentos)
		if (!isset($GLOBALS["departamentos"])) {
			$GLOBALS["departamentos"] = new cdepartamentos();
			$GLOBALS["Table"] =& $GLOBALS["departamentos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "departamentosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "departamentosdelete.php";
		$this->MultiUpdateUrl = "departamentosupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'departamentos', TRUE);

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
		global $departamentos;

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
			$departamentos->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $departamentos;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($departamentos->Export <> "" ||
				$departamentos->CurrentAction == "gridadd" ||
				$departamentos->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$departamentos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($departamentos->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $departamentos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$departamentos->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$departamentos->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$departamentos->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $departamentos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$departamentos->setSessionWhere($sFilter);
		$departamentos->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $departamentos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $departamentos->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $departamentos->zemail, $Keyword);
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
		global $Security, $departamentos;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $departamentos->BasicSearchKeyword;
		$sSearchType = $departamentos->BasicSearchType;
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
			$departamentos->setSessionBasicSearchKeyword($sSearchKeyword);
			$departamentos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $departamentos;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$departamentos->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $departamentos;
		$departamentos->setSessionBasicSearchKeyword("");
		$departamentos->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $departamentos;
		$bRestore = TRUE;
		if ($departamentos->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$departamentos->BasicSearchKeyword = $departamentos->getSessionBasicSearchKeyword();
			$departamentos->BasicSearchType = $departamentos->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $departamentos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$departamentos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$departamentos->CurrentOrderType = @$_GET["ordertype"];
			$departamentos->UpdateSort($departamentos->nombre); // nombre
			$departamentos->UpdateSort($departamentos->zemail); // email
			$departamentos->UpdateSort($departamentos->estatus); // estatus
			$departamentos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $departamentos;
		$sOrderBy = $departamentos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($departamentos->SqlOrderBy() <> "") {
				$sOrderBy = $departamentos->SqlOrderBy();
				$departamentos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $departamentos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$departamentos->setSessionOrderBy($sOrderBy);
				$departamentos->nombre->setSort("");
				$departamentos->zemail->setSort("");
				$departamentos->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$departamentos->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $departamentos;

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
		global $Security, $Language, $departamentos, $objForm;
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
		global $Security, $Language, $departamentos;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $departamentos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$departamentos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$departamentos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $departamentos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$departamentos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$departamentos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$departamentos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $departamentos;
		$departamentos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$departamentos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $departamentos;

		// Call Recordset Selecting event
		$departamentos->Recordset_Selecting($departamentos->CurrentFilter);

		// Load List page SQL
		$sSql = $departamentos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$departamentos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $departamentos;
		$sFilter = $departamentos->KeyFilter();

		// Call Row Selecting event
		$departamentos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$departamentos->CurrentFilter = $sFilter;
		$sSql = $departamentos->SQL();
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
		global $conn, $departamentos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$departamentos->Row_Selected($row);
		$departamentos->id_departamentos->setDbValue($rs->fields('id_departamentos'));
		$departamentos->nombre->setDbValue($rs->fields('nombre'));
		$departamentos->zemail->setDbValue($rs->fields('email'));
		$departamentos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $departamentos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($departamentos->getKey("id_departamentos")) <> "")
			$departamentos->id_departamentos->CurrentValue = $departamentos->getKey("id_departamentos"); // id_departamentos
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$departamentos->CurrentFilter = $departamentos->KeyFilter();
			$sSql = $departamentos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $departamentos;

		// Initialize URLs
		$this->ViewUrl = $departamentos->ViewUrl();
		$this->EditUrl = $departamentos->EditUrl();
		$this->InlineEditUrl = $departamentos->InlineEditUrl();
		$this->CopyUrl = $departamentos->CopyUrl();
		$this->InlineCopyUrl = $departamentos->InlineCopyUrl();
		$this->DeleteUrl = $departamentos->DeleteUrl();

		// Call Row_Rendering event
		$departamentos->Row_Rendering();

		// Common render codes for all row types
		// id_departamentos

		$departamentos->id_departamentos->CellCssStyle = "white-space: nowrap;";

		// nombre
		// email
		// estatus

		if ($departamentos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_departamentos
			$departamentos->id_departamentos->ViewValue = $departamentos->id_departamentos->CurrentValue;
			$departamentos->id_departamentos->ViewCustomAttributes = "";

			// nombre
			$departamentos->nombre->ViewValue = $departamentos->nombre->CurrentValue;
			$departamentos->nombre->ViewCustomAttributes = "";

			// email
			$departamentos->zemail->ViewValue = $departamentos->zemail->CurrentValue;
			$departamentos->zemail->ViewCustomAttributes = "";

			// estatus
			if (strval($departamentos->estatus->CurrentValue) <> "") {
				switch ($departamentos->estatus->CurrentValue) {
					case "1":
						$departamentos->estatus->ViewValue = $departamentos->estatus->FldTagCaption(1) <> "" ? $departamentos->estatus->FldTagCaption(1) : $departamentos->estatus->CurrentValue;
						break;
					case "0":
						$departamentos->estatus->ViewValue = $departamentos->estatus->FldTagCaption(2) <> "" ? $departamentos->estatus->FldTagCaption(2) : $departamentos->estatus->CurrentValue;
						break;
					default:
						$departamentos->estatus->ViewValue = $departamentos->estatus->CurrentValue;
				}
			} else {
				$departamentos->estatus->ViewValue = NULL;
			}
			$departamentos->estatus->ViewCustomAttributes = "";

			// nombre
			$departamentos->nombre->LinkCustomAttributes = "";
			$departamentos->nombre->HrefValue = "";
			$departamentos->nombre->TooltipValue = "";

			// email
			$departamentos->zemail->LinkCustomAttributes = "";
			$departamentos->zemail->HrefValue = "";
			$departamentos->zemail->TooltipValue = "";

			// estatus
			$departamentos->estatus->LinkCustomAttributes = "";
			$departamentos->estatus->HrefValue = "";
			$departamentos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($departamentos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$departamentos->Row_Rendered();
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
