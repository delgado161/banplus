<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tipos_productosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tipos_productos_list = new ctipos_productos_list();
$Page =& $tipos_productos_list;

// Page init
$tipos_productos_list->Page_Init();

// Page main
$tipos_productos_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($tipos_productos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tipos_productos_list = new ew_Page("tipos_productos_list");

// page properties
tipos_productos_list.PageID = "list"; // page ID
tipos_productos_list.FormID = "ftipos_productoslist"; // form ID
var EW_PAGE_ID = tipos_productos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tipos_productos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tipos_productos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tipos_productos_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($tipos_productos->Export == "") || (EW_EXPORT_MASTER_RECORD && $tipos_productos->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tipos_productos_list->TotalRecs = $tipos_productos->SelectRecordCount();
	} else {
		if ($tipos_productos_list->Recordset = $tipos_productos_list->LoadRecordset())
			$tipos_productos_list->TotalRecs = $tipos_productos_list->Recordset->RecordCount();
	}
	$tipos_productos_list->StartRec = 1;
	if ($tipos_productos_list->DisplayRecs <= 0 || ($tipos_productos->Export <> "" && $tipos_productos->ExportAll)) // Display all records
		$tipos_productos_list->DisplayRecs = $tipos_productos_list->TotalRecs;
	if (!($tipos_productos->Export <> "" && $tipos_productos->ExportAll))
		$tipos_productos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$tipos_productos_list->Recordset = $tipos_productos_list->LoadRecordset($tipos_productos_list->StartRec-1, $tipos_productos_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tipos_productos->TableCaption() ?>
&nbsp;&nbsp;<?php $tipos_productos_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($tipos_productos->Export == "" && $tipos_productos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tipos_productos_list);" style="text-decoration: none;"><img id="tipos_productos_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tipos_productos_list_SearchPanel">
<form name="ftipos_productoslistsrch" id="ftipos_productoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tipos_productos">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tipos_productos->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $tipos_productos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tipos_productos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tipos_productos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tipos_productos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $tipos_productos_list->ShowPageHeader(); ?>
<?php
$tipos_productos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="ftipos_productoslist" id="ftipos_productoslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="tipos_productos">
<div id="gmp_tipos_productos" class="ewGridMiddlePanel">
<?php if ($tipos_productos_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tipos_productos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tipos_productos_list->RenderListOptions();

// Render list options (header, left)
$tipos_productos_list->ListOptions->Render("header", "left");
?>
<?php if ($tipos_productos->id_producto->Visible) { // id_producto ?>
	<?php if ($tipos_productos->SortUrl($tipos_productos->id_producto) == "") { ?>
		<td><?php echo $tipos_productos->id_producto->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tipos_productos->SortUrl($tipos_productos->id_producto) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tipos_productos->id_producto->FldCaption() ?></td><td style="width: 10px;"><?php if ($tipos_productos->id_producto->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tipos_productos->id_producto->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tipos_productos->tipo->Visible) { // tipo ?>
	<?php if ($tipos_productos->SortUrl($tipos_productos->tipo) == "") { ?>
		<td><?php echo $tipos_productos->tipo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tipos_productos->SortUrl($tipos_productos->tipo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tipos_productos->tipo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tipos_productos->tipo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tipos_productos->tipo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tipos_productos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($tipos_productos->ExportAll && $tipos_productos->Export <> "") {
	$tipos_productos_list->StopRec = $tipos_productos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tipos_productos_list->TotalRecs > $tipos_productos_list->StartRec + $tipos_productos_list->DisplayRecs - 1)
		$tipos_productos_list->StopRec = $tipos_productos_list->StartRec + $tipos_productos_list->DisplayRecs - 1;
	else
		$tipos_productos_list->StopRec = $tipos_productos_list->TotalRecs;
}
$tipos_productos_list->RecCnt = $tipos_productos_list->StartRec - 1;
if ($tipos_productos_list->Recordset && !$tipos_productos_list->Recordset->EOF) {
	$tipos_productos_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $tipos_productos_list->StartRec > 1)
		$tipos_productos_list->Recordset->Move($tipos_productos_list->StartRec - 1);
} elseif (!$tipos_productos->AllowAddDeleteRow && $tipos_productos_list->StopRec == 0) {
	$tipos_productos_list->StopRec = $tipos_productos->GridAddRowCount;
}

// Initialize aggregate
$tipos_productos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tipos_productos->ResetAttrs();
$tipos_productos_list->RenderRow();
$tipos_productos_list->RowCnt = 0;
while ($tipos_productos_list->RecCnt < $tipos_productos_list->StopRec) {
	$tipos_productos_list->RecCnt++;
	if (intval($tipos_productos_list->RecCnt) >= intval($tipos_productos_list->StartRec)) {
		$tipos_productos_list->RowCnt++;

		// Set up key count
		$tipos_productos_list->KeyCount = $tipos_productos_list->RowIndex;

		// Init row class and style
		$tipos_productos->ResetAttrs();
		$tipos_productos->CssClass = "";
		if ($tipos_productos->CurrentAction == "gridadd") {
		} else {
			$tipos_productos_list->LoadRowValues($tipos_productos_list->Recordset); // Load row values
		}
		$tipos_productos->RowType = EW_ROWTYPE_VIEW; // Render view
		$tipos_productos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$tipos_productos_list->RenderRow();

		// Render list options
		$tipos_productos_list->RenderListOptions();
?>
	<tr<?php echo $tipos_productos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tipos_productos_list->ListOptions->Render("body", "left");
?>
	<?php if ($tipos_productos->id_producto->Visible) { // id_producto ?>
		<td<?php echo $tipos_productos->id_producto->CellAttributes() ?>>
<div<?php echo $tipos_productos->id_producto->ViewAttributes() ?>><?php echo $tipos_productos->id_producto->ListViewValue() ?></div>
<a name="<?php echo $tipos_productos_list->PageObjName . "_row_" . $tipos_productos_list->RowCnt ?>" id="<?php echo $tipos_productos_list->PageObjName . "_row_" . $tipos_productos_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($tipos_productos->tipo->Visible) { // tipo ?>
		<td<?php echo $tipos_productos->tipo->CellAttributes() ?>>
<div<?php echo $tipos_productos->tipo->ViewAttributes() ?>><?php echo $tipos_productos->tipo->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tipos_productos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($tipos_productos->CurrentAction <> "gridadd")
		$tipos_productos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($tipos_productos_list->Recordset)
	$tipos_productos_list->Recordset->Close();
?>
<?php if ($tipos_productos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tipos_productos->CurrentAction <> "gridadd" && $tipos_productos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tipos_productos_list->Pager)) $tipos_productos_list->Pager = new cPrevNextPager($tipos_productos_list->StartRec, $tipos_productos_list->DisplayRecs, $tipos_productos_list->TotalRecs) ?>
<?php if ($tipos_productos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tipos_productos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tipos_productos_list->PageUrl() ?>start=<?php echo $tipos_productos_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tipos_productos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tipos_productos_list->PageUrl() ?>start=<?php echo $tipos_productos_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tipos_productos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tipos_productos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tipos_productos_list->PageUrl() ?>start=<?php echo $tipos_productos_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tipos_productos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tipos_productos_list->PageUrl() ?>start=<?php echo $tipos_productos_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tipos_productos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tipos_productos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tipos_productos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tipos_productos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($tipos_productos_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $tipos_productos_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($tipos_productos->Export == "" && $tipos_productos->CurrentAction == "") { ?>
<?php } ?>
<?php
$tipos_productos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($tipos_productos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tipos_productos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctipos_productos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tipos_productos';

	// Page object name
	var $PageObjName = 'tipos_productos_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tipos_productos;
		if ($tipos_productos->UseTokenInUrl) $PageUrl .= "t=" . $tipos_productos->TableVar . "&"; // Add page token
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
		global $objForm, $tipos_productos;
		if ($tipos_productos->UseTokenInUrl) {
			if ($objForm)
				return ($tipos_productos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tipos_productos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctipos_productos_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tipos_productos)
		if (!isset($GLOBALS["tipos_productos"])) {
			$GLOBALS["tipos_productos"] = new ctipos_productos();
			$GLOBALS["Table"] =& $GLOBALS["tipos_productos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "tipos_productosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tipos_productosdelete.php";
		$this->MultiUpdateUrl = "tipos_productosupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tipos_productos', TRUE);

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
		global $tipos_productos;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$tipos_productos->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $tipos_productos;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($tipos_productos->Export <> "" ||
				$tipos_productos->CurrentAction == "gridadd" ||
				$tipos_productos->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$tipos_productos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($tipos_productos->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $tipos_productos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$tipos_productos->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$tipos_productos->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$tipos_productos->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $tipos_productos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$tipos_productos->setSessionWhere($sFilter);
		$tipos_productos->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $tipos_productos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tipos_productos->tipo, $Keyword);
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
		global $Security, $tipos_productos;
		$sSearchStr = "";
		$sSearchKeyword = $tipos_productos->BasicSearchKeyword;
		$sSearchType = $tipos_productos->BasicSearchType;
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
			$tipos_productos->setSessionBasicSearchKeyword($sSearchKeyword);
			$tipos_productos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tipos_productos;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$tipos_productos->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tipos_productos;
		$tipos_productos->setSessionBasicSearchKeyword("");
		$tipos_productos->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tipos_productos;
		$bRestore = TRUE;
		if ($tipos_productos->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tipos_productos->BasicSearchKeyword = $tipos_productos->getSessionBasicSearchKeyword();
			$tipos_productos->BasicSearchType = $tipos_productos->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tipos_productos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tipos_productos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tipos_productos->CurrentOrderType = @$_GET["ordertype"];
			$tipos_productos->UpdateSort($tipos_productos->id_producto); // id_producto
			$tipos_productos->UpdateSort($tipos_productos->tipo); // tipo
			$tipos_productos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tipos_productos;
		$sOrderBy = $tipos_productos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tipos_productos->SqlOrderBy() <> "") {
				$sOrderBy = $tipos_productos->SqlOrderBy();
				$tipos_productos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tipos_productos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tipos_productos->setSessionOrderBy($sOrderBy);
				$tipos_productos->id_producto->setSort("");
				$tipos_productos->tipo->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$tipos_productos->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $tipos_productos;

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
		global $Security, $Language, $tipos_productos, $objForm;
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
		global $Security, $Language, $tipos_productos;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tipos_productos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$tipos_productos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$tipos_productos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $tipos_productos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$tipos_productos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$tipos_productos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$tipos_productos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tipos_productos;
		$tipos_productos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tipos_productos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tipos_productos;

		// Call Recordset Selecting event
		$tipos_productos->Recordset_Selecting($tipos_productos->CurrentFilter);

		// Load List page SQL
		$sSql = $tipos_productos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tipos_productos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tipos_productos;
		$sFilter = $tipos_productos->KeyFilter();

		// Call Row Selecting event
		$tipos_productos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tipos_productos->CurrentFilter = $sFilter;
		$sSql = $tipos_productos->SQL();
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
		global $conn, $tipos_productos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tipos_productos->Row_Selected($row);
		$tipos_productos->id_producto->setDbValue($rs->fields('id_producto'));
		$tipos_productos->tipo->setDbValue($rs->fields('tipo'));
	}

	// Load old record
	function LoadOldRecord() {
		global $tipos_productos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tipos_productos->getKey("id_producto")) <> "")
			$tipos_productos->id_producto->CurrentValue = $tipos_productos->getKey("id_producto"); // id_producto
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tipos_productos->CurrentFilter = $tipos_productos->KeyFilter();
			$sSql = $tipos_productos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tipos_productos;

		// Initialize URLs
		$this->ViewUrl = $tipos_productos->ViewUrl();
		$this->EditUrl = $tipos_productos->EditUrl();
		$this->InlineEditUrl = $tipos_productos->InlineEditUrl();
		$this->CopyUrl = $tipos_productos->CopyUrl();
		$this->InlineCopyUrl = $tipos_productos->InlineCopyUrl();
		$this->DeleteUrl = $tipos_productos->DeleteUrl();

		// Call Row_Rendering event
		$tipos_productos->Row_Rendering();

		// Common render codes for all row types
		// id_producto
		// tipo

		if ($tipos_productos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_producto
			$tipos_productos->id_producto->ViewValue = $tipos_productos->id_producto->CurrentValue;
			$tipos_productos->id_producto->ViewCustomAttributes = "";

			// tipo
			$tipos_productos->tipo->ViewValue = $tipos_productos->tipo->CurrentValue;
			$tipos_productos->tipo->ViewCustomAttributes = "";

			// id_producto
			$tipos_productos->id_producto->LinkCustomAttributes = "";
			$tipos_productos->id_producto->HrefValue = "";
			$tipos_productos->id_producto->TooltipValue = "";

			// tipo
			$tipos_productos->tipo->LinkCustomAttributes = "";
			$tipos_productos->tipo->HrefValue = "";
			$tipos_productos->tipo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tipos_productos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tipos_productos->Row_Rendered();
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
