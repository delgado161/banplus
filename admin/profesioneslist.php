<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "profesionesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$profesiones_list = new cprofesiones_list();
$Page =& $profesiones_list;

// Page init
$profesiones_list->Page_Init();

// Page main
$profesiones_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($profesiones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var profesiones_list = new ew_Page("profesiones_list");

// page properties
profesiones_list.PageID = "list"; // page ID
profesiones_list.FormID = "fprofesioneslist"; // form ID
var EW_PAGE_ID = profesiones_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
profesiones_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
profesiones_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
profesiones_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($profesiones->Export == "") || (EW_EXPORT_MASTER_RECORD && $profesiones->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$profesiones_list->TotalRecs = $profesiones->SelectRecordCount();
	} else {
		if ($profesiones_list->Recordset = $profesiones_list->LoadRecordset())
			$profesiones_list->TotalRecs = $profesiones_list->Recordset->RecordCount();
	}
	$profesiones_list->StartRec = 1;
	if ($profesiones_list->DisplayRecs <= 0 || ($profesiones->Export <> "" && $profesiones->ExportAll)) // Display all records
		$profesiones_list->DisplayRecs = $profesiones_list->TotalRecs;
	if (!($profesiones->Export <> "" && $profesiones->ExportAll))
		$profesiones_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$profesiones_list->Recordset = $profesiones_list->LoadRecordset($profesiones_list->StartRec-1, $profesiones_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $profesiones->TableCaption() ?>
&nbsp;&nbsp;<?php $profesiones_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($profesiones->Export == "" && $profesiones->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(profesiones_list);" style="text-decoration: none;"><img id="profesiones_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="profesiones_list_SearchPanel">
<form name="fprofesioneslistsrch" id="fprofesioneslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="profesiones">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($profesiones->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $profesiones_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($profesiones->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($profesiones->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($profesiones->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $profesiones_list->ShowPageHeader(); ?>
<?php
$profesiones_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fprofesioneslist" id="fprofesioneslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="profesiones">
<div id="gmp_profesiones" class="ewGridMiddlePanel">
<?php if ($profesiones_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $profesiones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$profesiones_list->RenderListOptions();

// Render list options (header, left)
$profesiones_list->ListOptions->Render("header", "left");
?>
<?php if ($profesiones->id_profesion->Visible) { // id_profesion ?>
	<?php if ($profesiones->SortUrl($profesiones->id_profesion) == "") { ?>
		<td><?php echo $profesiones->id_profesion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $profesiones->SortUrl($profesiones->id_profesion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $profesiones->id_profesion->FldCaption() ?></td><td style="width: 10px;"><?php if ($profesiones->id_profesion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($profesiones->id_profesion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($profesiones->descripcion->Visible) { // descripcion ?>
	<?php if ($profesiones->SortUrl($profesiones->descripcion) == "") { ?>
		<td><?php echo $profesiones->descripcion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $profesiones->SortUrl($profesiones->descripcion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $profesiones->descripcion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($profesiones->descripcion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($profesiones->descripcion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$profesiones_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($profesiones->ExportAll && $profesiones->Export <> "") {
	$profesiones_list->StopRec = $profesiones_list->TotalRecs;
} else {

	// Set the last record to display
	if ($profesiones_list->TotalRecs > $profesiones_list->StartRec + $profesiones_list->DisplayRecs - 1)
		$profesiones_list->StopRec = $profesiones_list->StartRec + $profesiones_list->DisplayRecs - 1;
	else
		$profesiones_list->StopRec = $profesiones_list->TotalRecs;
}
$profesiones_list->RecCnt = $profesiones_list->StartRec - 1;
if ($profesiones_list->Recordset && !$profesiones_list->Recordset->EOF) {
	$profesiones_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $profesiones_list->StartRec > 1)
		$profesiones_list->Recordset->Move($profesiones_list->StartRec - 1);
} elseif (!$profesiones->AllowAddDeleteRow && $profesiones_list->StopRec == 0) {
	$profesiones_list->StopRec = $profesiones->GridAddRowCount;
}

// Initialize aggregate
$profesiones->RowType = EW_ROWTYPE_AGGREGATEINIT;
$profesiones->ResetAttrs();
$profesiones_list->RenderRow();
$profesiones_list->RowCnt = 0;
while ($profesiones_list->RecCnt < $profesiones_list->StopRec) {
	$profesiones_list->RecCnt++;
	if (intval($profesiones_list->RecCnt) >= intval($profesiones_list->StartRec)) {
		$profesiones_list->RowCnt++;

		// Set up key count
		$profesiones_list->KeyCount = $profesiones_list->RowIndex;

		// Init row class and style
		$profesiones->ResetAttrs();
		$profesiones->CssClass = "";
		if ($profesiones->CurrentAction == "gridadd") {
		} else {
			$profesiones_list->LoadRowValues($profesiones_list->Recordset); // Load row values
		}
		$profesiones->RowType = EW_ROWTYPE_VIEW; // Render view
		$profesiones->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$profesiones_list->RenderRow();

		// Render list options
		$profesiones_list->RenderListOptions();
?>
	<tr<?php echo $profesiones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$profesiones_list->ListOptions->Render("body", "left");
?>
	<?php if ($profesiones->id_profesion->Visible) { // id_profesion ?>
		<td<?php echo $profesiones->id_profesion->CellAttributes() ?>>
<div<?php echo $profesiones->id_profesion->ViewAttributes() ?>><?php echo $profesiones->id_profesion->ListViewValue() ?></div>
<a name="<?php echo $profesiones_list->PageObjName . "_row_" . $profesiones_list->RowCnt ?>" id="<?php echo $profesiones_list->PageObjName . "_row_" . $profesiones_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($profesiones->descripcion->Visible) { // descripcion ?>
		<td<?php echo $profesiones->descripcion->CellAttributes() ?>>
<div<?php echo $profesiones->descripcion->ViewAttributes() ?>><?php echo $profesiones->descripcion->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$profesiones_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($profesiones->CurrentAction <> "gridadd")
		$profesiones_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($profesiones_list->Recordset)
	$profesiones_list->Recordset->Close();
?>
<?php if ($profesiones->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($profesiones->CurrentAction <> "gridadd" && $profesiones->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($profesiones_list->Pager)) $profesiones_list->Pager = new cPrevNextPager($profesiones_list->StartRec, $profesiones_list->DisplayRecs, $profesiones_list->TotalRecs) ?>
<?php if ($profesiones_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($profesiones_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $profesiones_list->PageUrl() ?>start=<?php echo $profesiones_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($profesiones_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $profesiones_list->PageUrl() ?>start=<?php echo $profesiones_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $profesiones_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($profesiones_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $profesiones_list->PageUrl() ?>start=<?php echo $profesiones_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($profesiones_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $profesiones_list->PageUrl() ?>start=<?php echo $profesiones_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $profesiones_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $profesiones_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $profesiones_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $profesiones_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($profesiones_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $profesiones_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($profesiones->Export == "" && $profesiones->CurrentAction == "") { ?>
<?php } ?>
<?php
$profesiones_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($profesiones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$profesiones_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cprofesiones_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'profesiones';

	// Page object name
	var $PageObjName = 'profesiones_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $profesiones;
		if ($profesiones->UseTokenInUrl) $PageUrl .= "t=" . $profesiones->TableVar . "&"; // Add page token
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
		global $objForm, $profesiones;
		if ($profesiones->UseTokenInUrl) {
			if ($objForm)
				return ($profesiones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($profesiones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprofesiones_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (profesiones)
		if (!isset($GLOBALS["profesiones"])) {
			$GLOBALS["profesiones"] = new cprofesiones();
			$GLOBALS["Table"] =& $GLOBALS["profesiones"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "profesionesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "profesionesdelete.php";
		$this->MultiUpdateUrl = "profesionesupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'profesiones', TRUE);

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
		global $profesiones;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$profesiones->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $profesiones;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($profesiones->Export <> "" ||
				$profesiones->CurrentAction == "gridadd" ||
				$profesiones->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$profesiones->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($profesiones->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $profesiones->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$profesiones->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$profesiones->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$profesiones->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $profesiones->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$profesiones->setSessionWhere($sFilter);
		$profesiones->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $profesiones;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $profesiones->descripcion, $Keyword);
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
		global $Security, $profesiones;
		$sSearchStr = "";
		$sSearchKeyword = $profesiones->BasicSearchKeyword;
		$sSearchType = $profesiones->BasicSearchType;
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
			$profesiones->setSessionBasicSearchKeyword($sSearchKeyword);
			$profesiones->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $profesiones;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$profesiones->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $profesiones;
		$profesiones->setSessionBasicSearchKeyword("");
		$profesiones->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $profesiones;
		$bRestore = TRUE;
		if ($profesiones->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$profesiones->BasicSearchKeyword = $profesiones->getSessionBasicSearchKeyword();
			$profesiones->BasicSearchType = $profesiones->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $profesiones;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$profesiones->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$profesiones->CurrentOrderType = @$_GET["ordertype"];
			$profesiones->UpdateSort($profesiones->id_profesion); // id_profesion
			$profesiones->UpdateSort($profesiones->descripcion); // descripcion
			$profesiones->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $profesiones;
		$sOrderBy = $profesiones->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($profesiones->SqlOrderBy() <> "") {
				$sOrderBy = $profesiones->SqlOrderBy();
				$profesiones->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $profesiones;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$profesiones->setSessionOrderBy($sOrderBy);
				$profesiones->id_profesion->setSort("");
				$profesiones->descripcion->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$profesiones->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $profesiones;

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
		global $Security, $Language, $profesiones, $objForm;
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
		global $Security, $Language, $profesiones;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $profesiones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$profesiones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$profesiones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $profesiones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$profesiones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$profesiones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$profesiones->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $profesiones;
		$profesiones->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$profesiones->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $profesiones;

		// Call Recordset Selecting event
		$profesiones->Recordset_Selecting($profesiones->CurrentFilter);

		// Load List page SQL
		$sSql = $profesiones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$profesiones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $profesiones;
		$sFilter = $profesiones->KeyFilter();

		// Call Row Selecting event
		$profesiones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$profesiones->CurrentFilter = $sFilter;
		$sSql = $profesiones->SQL();
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
		global $conn, $profesiones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$profesiones->Row_Selected($row);
		$profesiones->id_profesion->setDbValue($rs->fields('id_profesion'));
		$profesiones->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Load old record
	function LoadOldRecord() {
		global $profesiones;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($profesiones->getKey("id_profesion")) <> "")
			$profesiones->id_profesion->CurrentValue = $profesiones->getKey("id_profesion"); // id_profesion
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$profesiones->CurrentFilter = $profesiones->KeyFilter();
			$sSql = $profesiones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $profesiones;

		// Initialize URLs
		$this->ViewUrl = $profesiones->ViewUrl();
		$this->EditUrl = $profesiones->EditUrl();
		$this->InlineEditUrl = $profesiones->InlineEditUrl();
		$this->CopyUrl = $profesiones->CopyUrl();
		$this->InlineCopyUrl = $profesiones->InlineCopyUrl();
		$this->DeleteUrl = $profesiones->DeleteUrl();

		// Call Row_Rendering event
		$profesiones->Row_Rendering();

		// Common render codes for all row types
		// id_profesion
		// descripcion

		if ($profesiones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profesion
			$profesiones->id_profesion->ViewValue = $profesiones->id_profesion->CurrentValue;
			$profesiones->id_profesion->ViewCustomAttributes = "";

			// descripcion
			$profesiones->descripcion->ViewValue = $profesiones->descripcion->CurrentValue;
			$profesiones->descripcion->ViewCustomAttributes = "";

			// id_profesion
			$profesiones->id_profesion->LinkCustomAttributes = "";
			$profesiones->id_profesion->HrefValue = "";
			$profesiones->id_profesion->TooltipValue = "";

			// descripcion
			$profesiones->descripcion->LinkCustomAttributes = "";
			$profesiones->descripcion->HrefValue = "";
			$profesiones->descripcion->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($profesiones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$profesiones->Row_Rendered();
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
