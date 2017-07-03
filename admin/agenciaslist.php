<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "agenciasinfo.php" ?>
<?php include_once "agencias_serviciosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$agencias_list = new cagencias_list();
$Page =& $agencias_list;

// Page init
$agencias_list->Page_Init();

// Page main
$agencias_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($agencias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var agencias_list = new ew_Page("agencias_list");

// page properties
agencias_list.PageID = "list"; // page ID
agencias_list.FormID = "fagenciaslist"; // form ID
var EW_PAGE_ID = agencias_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
agencias_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
agencias_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
agencias_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($agencias->Export == "") || (EW_EXPORT_MASTER_RECORD && $agencias->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "agencias_servicioslist.php";
if ($agencias_list->DbMasterFilter <> "" && $agencias->getCurrentMasterTable() == "agencias_servicios") {
	if ($agencias_list->MasterRecordExists) {
		if ($agencias->getCurrentMasterTable() == $agencias->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $agencias_servicios->TableCaption() ?>
&nbsp;&nbsp;<?php $agencias_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($agencias->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "agencias_serviciosmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$agencias_list->TotalRecs = $agencias->SelectRecordCount();
	} else {
		if ($agencias_list->Recordset = $agencias_list->LoadRecordset())
			$agencias_list->TotalRecs = $agencias_list->Recordset->RecordCount();
	}
	$agencias_list->StartRec = 1;
	if ($agencias_list->DisplayRecs <= 0 || ($agencias->Export <> "" && $agencias->ExportAll)) // Display all records
		$agencias_list->DisplayRecs = $agencias_list->TotalRecs;
	if (!($agencias->Export <> "" && $agencias->ExportAll))
		$agencias_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$agencias_list->Recordset = $agencias_list->LoadRecordset($agencias_list->StartRec-1, $agencias_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $agencias->TableCaption() ?>
<?php if ($agencias->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $agencias_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php if ($agencias->Export == "" && $agencias->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(agencias_list);" style="text-decoration: none;"><img id="agencias_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="agencias_list_SearchPanel">
<form name="fagenciaslistsrch" id="fagenciaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="agencias">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($agencias->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $agencias_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($agencias->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($agencias->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($agencias->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $agencias_list->ShowPageHeader(); ?>
<?php
$agencias_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fagenciaslist" id="fagenciaslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="agencias">
<div id="gmp_agencias" class="ewGridMiddlePanel">
<?php if ($agencias_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $agencias->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$agencias_list->RenderListOptions();

// Render list options (header, left)
$agencias_list->ListOptions->Render("header", "left");
?>
<?php if ($agencias->nombre->Visible) { // nombre ?>
	<?php if ($agencias->SortUrl($agencias->nombre) == "") { ?>
		<td><?php echo $agencias->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $agencias->SortUrl($agencias->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($agencias->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($agencias->id_ciudad->Visible) { // id_ciudad ?>
	<?php if ($agencias->SortUrl($agencias->id_ciudad) == "") { ?>
		<td><?php echo $agencias->id_ciudad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $agencias->SortUrl($agencias->id_ciudad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias->id_ciudad->FldCaption() ?></td><td style="width: 10px;"><?php if ($agencias->id_ciudad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias->id_ciudad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($agencias->estatus->Visible) { // estatus ?>
	<?php if ($agencias->SortUrl($agencias->estatus) == "") { ?>
		<td><?php echo $agencias->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $agencias->SortUrl($agencias->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($agencias->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$agencias_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($agencias->ExportAll && $agencias->Export <> "") {
	$agencias_list->StopRec = $agencias_list->TotalRecs;
} else {

	// Set the last record to display
	if ($agencias_list->TotalRecs > $agencias_list->StartRec + $agencias_list->DisplayRecs - 1)
		$agencias_list->StopRec = $agencias_list->StartRec + $agencias_list->DisplayRecs - 1;
	else
		$agencias_list->StopRec = $agencias_list->TotalRecs;
}
$agencias_list->RecCnt = $agencias_list->StartRec - 1;
if ($agencias_list->Recordset && !$agencias_list->Recordset->EOF) {
	$agencias_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $agencias_list->StartRec > 1)
		$agencias_list->Recordset->Move($agencias_list->StartRec - 1);
} elseif (!$agencias->AllowAddDeleteRow && $agencias_list->StopRec == 0) {
	$agencias_list->StopRec = $agencias->GridAddRowCount;
}

// Initialize aggregate
$agencias->RowType = EW_ROWTYPE_AGGREGATEINIT;
$agencias->ResetAttrs();
$agencias_list->RenderRow();
$agencias_list->RowCnt = 0;
while ($agencias_list->RecCnt < $agencias_list->StopRec) {
	$agencias_list->RecCnt++;
	if (intval($agencias_list->RecCnt) >= intval($agencias_list->StartRec)) {
		$agencias_list->RowCnt++;

		// Set up key count
		$agencias_list->KeyCount = $agencias_list->RowIndex;

		// Init row class and style
		$agencias->ResetAttrs();
		$agencias->CssClass = "";
		if ($agencias->CurrentAction == "gridadd") {
		} else {
			$agencias_list->LoadRowValues($agencias_list->Recordset); // Load row values
		}
		$agencias->RowType = EW_ROWTYPE_VIEW; // Render view
		$agencias->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$agencias_list->RenderRow();

		// Render list options
		$agencias_list->RenderListOptions();
?>
	<tr<?php echo $agencias->RowAttributes() ?>>
<?php

// Render list options (body, left)
$agencias_list->ListOptions->Render("body", "left");
?>
	<?php if ($agencias->nombre->Visible) { // nombre ?>
		<td<?php echo $agencias->nombre->CellAttributes() ?>>
<div<?php echo $agencias->nombre->ViewAttributes() ?>><?php echo $agencias->nombre->ListViewValue() ?></div>
<a name="<?php echo $agencias_list->PageObjName . "_row_" . $agencias_list->RowCnt ?>" id="<?php echo $agencias_list->PageObjName . "_row_" . $agencias_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($agencias->id_ciudad->Visible) { // id_ciudad ?>
		<td<?php echo $agencias->id_ciudad->CellAttributes() ?>>
<div<?php echo $agencias->id_ciudad->ViewAttributes() ?>><?php echo $agencias->id_ciudad->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($agencias->estatus->Visible) { // estatus ?>
		<td<?php echo $agencias->estatus->CellAttributes() ?>>
<div<?php echo $agencias->estatus->ViewAttributes() ?>><?php echo $agencias->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agencias_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($agencias->CurrentAction <> "gridadd")
		$agencias_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($agencias_list->Recordset)
	$agencias_list->Recordset->Close();
?>
<?php if ($agencias->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($agencias->CurrentAction <> "gridadd" && $agencias->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($agencias_list->Pager)) $agencias_list->Pager = new cPrevNextPager($agencias_list->StartRec, $agencias_list->DisplayRecs, $agencias_list->TotalRecs) ?>
<?php if ($agencias_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($agencias_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $agencias_list->PageUrl() ?>start=<?php echo $agencias_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($agencias_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $agencias_list->PageUrl() ?>start=<?php echo $agencias_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $agencias_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($agencias_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $agencias_list->PageUrl() ?>start=<?php echo $agencias_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($agencias_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $agencias_list->PageUrl() ?>start=<?php echo $agencias_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $agencias_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $agencias_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $agencias_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $agencias_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($agencias_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $agencias_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($agencias->Export == "" && $agencias->CurrentAction == "") { ?>
<?php } ?>
<?php
$agencias_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($agencias->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$agencias_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cagencias_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'agencias';

	// Page object name
	var $PageObjName = 'agencias_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $agencias;
		if ($agencias->UseTokenInUrl) $PageUrl .= "t=" . $agencias->TableVar . "&"; // Add page token
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
		global $objForm, $agencias;
		if ($agencias->UseTokenInUrl) {
			if ($objForm)
				return ($agencias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($agencias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cagencias_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (agencias)
		if (!isset($GLOBALS["agencias"])) {
			$GLOBALS["agencias"] = new cagencias();
			$GLOBALS["Table"] =& $GLOBALS["agencias"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "agenciasadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "agenciasdelete.php";
		$this->MultiUpdateUrl = "agenciasupdate.php";

		// Table object (agencias_servicios)
		if (!isset($GLOBALS['agencias_servicios'])) $GLOBALS['agencias_servicios'] = new cagencias_servicios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'agencias', TRUE);

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
		global $agencias;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$agencias->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $agencias;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Hide all options
			if ($agencias->Export <> "" ||
				$agencias->CurrentAction == "gridadd" ||
				$agencias->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$agencias->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($agencias->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $agencias->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$agencias->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$agencias->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$agencias->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $agencias->getSearchWhere();
		}

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $agencias->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $agencias->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($agencias->getMasterFilter() <> "" && $agencias->getCurrentMasterTable() == "agencias_servicios") {
			global $agencias_servicios;
			$rsmaster = $agencias_servicios->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($agencias->getReturnUrl()); // Return to caller
			} else {
				$agencias_servicios->LoadListRowValues($rsmaster);
				$agencias_servicios->RowType = EW_ROWTYPE_MASTER; // Master row
				$agencias_servicios->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$agencias->setSessionWhere($sFilter);
		$agencias->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $agencias;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $agencias->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $agencias->direccion, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $agencias->telef_1, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $agencias->horario_agencia, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $agencias->horario_taq_auto, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $agencias->coordenadas, $Keyword);
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
		global $Security, $agencias;
		$sSearchStr = "";
		$sSearchKeyword = $agencias->BasicSearchKeyword;
		$sSearchType = $agencias->BasicSearchType;
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
			$agencias->setSessionBasicSearchKeyword($sSearchKeyword);
			$agencias->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $agencias;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$agencias->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $agencias;
		$agencias->setSessionBasicSearchKeyword("");
		$agencias->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $agencias;
		$bRestore = TRUE;
		if ($agencias->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$agencias->BasicSearchKeyword = $agencias->getSessionBasicSearchKeyword();
			$agencias->BasicSearchType = $agencias->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $agencias;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$agencias->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$agencias->CurrentOrderType = @$_GET["ordertype"];
			$agencias->UpdateSort($agencias->nombre); // nombre
			$agencias->UpdateSort($agencias->id_ciudad); // id_ciudad
			$agencias->UpdateSort($agencias->estatus); // estatus
			$agencias->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $agencias;
		$sOrderBy = $agencias->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($agencias->SqlOrderBy() <> "") {
				$sOrderBy = $agencias->SqlOrderBy();
				$agencias->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $agencias;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$agencias->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$agencias->id_agencias->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$agencias->setSessionOrderBy($sOrderBy);
				$agencias->nombre->setSort("");
				$agencias->id_ciudad->setSort("");
				$agencias->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$agencias->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $agencias;

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
		global $Security, $Language, $agencias, $objForm;
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
		global $Security, $Language, $agencias;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $agencias;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$agencias->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$agencias->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $agencias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$agencias->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$agencias->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$agencias->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $agencias;
		$agencias->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$agencias->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $agencias;

		// Call Recordset Selecting event
		$agencias->Recordset_Selecting($agencias->CurrentFilter);

		// Load List page SQL
		$sSql = $agencias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$agencias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $agencias;
		$sFilter = $agencias->KeyFilter();

		// Call Row Selecting event
		$agencias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$agencias->CurrentFilter = $sFilter;
		$sSql = $agencias->SQL();
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
		global $conn, $agencias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$agencias->Row_Selected($row);
		$agencias->id_agencias->setDbValue($rs->fields('id_agencias'));
		$agencias->nombre->setDbValue($rs->fields('nombre'));
		$agencias->direccion->setDbValue($rs->fields('direccion'));
		$agencias->id_ciudad->setDbValue($rs->fields('id_ciudad'));
		$agencias->telef_1->setDbValue($rs->fields('telef_1'));
		$agencias->horario_agencia->setDbValue($rs->fields('horario_agencia'));
		$agencias->horario_taq_auto->setDbValue($rs->fields('horario_taq_auto'));
		$agencias->coordenadas->setDbValue($rs->fields('coordenadas'));
		$agencias->citas_diarias->setDbValue($rs->fields('citas_diarias'));
		$agencias->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $agencias;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($agencias->getKey("id_agencias")) <> "")
			$agencias->id_agencias->CurrentValue = $agencias->getKey("id_agencias"); // id_agencias
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$agencias->CurrentFilter = $agencias->KeyFilter();
			$sSql = $agencias->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $agencias;

		// Initialize URLs
		$this->ViewUrl = $agencias->ViewUrl();
		$this->EditUrl = $agencias->EditUrl();
		$this->InlineEditUrl = $agencias->InlineEditUrl();
		$this->CopyUrl = $agencias->CopyUrl();
		$this->InlineCopyUrl = $agencias->InlineCopyUrl();
		$this->DeleteUrl = $agencias->DeleteUrl();

		// Call Row_Rendering event
		$agencias->Row_Rendering();

		// Common render codes for all row types
		// id_agencias
		// nombre
		// direccion
		// id_ciudad
		// telef_1
		// horario_agencia
		// horario_taq_auto
		// coordenadas
		// citas_diarias
		// estatus

		if ($agencias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_agencias
			$agencias->id_agencias->ViewValue = $agencias->id_agencias->CurrentValue;
			$agencias->id_agencias->ViewCustomAttributes = "";

			// nombre
			$agencias->nombre->ViewValue = $agencias->nombre->CurrentValue;
			$agencias->nombre->ViewCustomAttributes = "";

			// id_ciudad
			if (strval($agencias->id_ciudad->CurrentValue) <> "") {
				$sFilterWrk = "`id_ciudad` = " . ew_AdjustSql($agencias->id_ciudad->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `ciudad`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias->id_ciudad->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$agencias->id_ciudad->ViewValue = $agencias->id_ciudad->CurrentValue;
				}
			} else {
				$agencias->id_ciudad->ViewValue = NULL;
			}
			$agencias->id_ciudad->ViewCustomAttributes = "";

			// horario_taq_auto
			$agencias->horario_taq_auto->ViewValue = $agencias->horario_taq_auto->CurrentValue;
			$agencias->horario_taq_auto->ViewCustomAttributes = "";

			// coordenadas
			$agencias->coordenadas->ViewValue = $agencias->coordenadas->CurrentValue;
			$agencias->coordenadas->ViewCustomAttributes = "";

			// citas_diarias
			$agencias->citas_diarias->ViewValue = $agencias->citas_diarias->CurrentValue;
			$agencias->citas_diarias->ViewCustomAttributes = "";

			// estatus
			if (strval($agencias->estatus->CurrentValue) <> "") {
				switch ($agencias->estatus->CurrentValue) {
					case "0":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(1) <> "" ? $agencias->estatus->FldTagCaption(1) : $agencias->estatus->CurrentValue;
						break;
					case "1":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(2) <> "" ? $agencias->estatus->FldTagCaption(2) : $agencias->estatus->CurrentValue;
						break;
					case "3":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(3) <> "" ? $agencias->estatus->FldTagCaption(3) : $agencias->estatus->CurrentValue;
						break;
					case "4":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(4) <> "" ? $agencias->estatus->FldTagCaption(4) : $agencias->estatus->CurrentValue;
						break;
					default:
						$agencias->estatus->ViewValue = $agencias->estatus->CurrentValue;
				}
			} else {
				$agencias->estatus->ViewValue = NULL;
			}
			$agencias->estatus->ViewCustomAttributes = "";

			// nombre
			$agencias->nombre->LinkCustomAttributes = "";
			$agencias->nombre->HrefValue = "";
			$agencias->nombre->TooltipValue = "";

			// id_ciudad
			$agencias->id_ciudad->LinkCustomAttributes = "";
			$agencias->id_ciudad->HrefValue = "";
			$agencias->id_ciudad->TooltipValue = "";

			// estatus
			$agencias->estatus->LinkCustomAttributes = "";
			$agencias->estatus->HrefValue = "";
			$agencias->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($agencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$agencias->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $agencias;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "agencias_servicios") {
				$bValidMaster = TRUE;
				if (@$_GET["id_agencias"] <> "") {
					$GLOBALS["agencias_servicios"]->id_agencias->setQueryStringValue($_GET["id_agencias"]);
					$agencias->id_agencias->setQueryStringValue($GLOBALS["agencias_servicios"]->id_agencias->QueryStringValue);
					$agencias->id_agencias->setSessionValue($agencias->id_agencias->QueryStringValue);
					if (!is_numeric($GLOBALS["agencias_servicios"]->id_agencias->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$agencias->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$agencias->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "agencias_servicios") {
				if ($agencias->id_agencias->QueryStringValue == "") $agencias->id_agencias->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $agencias->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $agencias->getDetailFilter(); // Get detail filter
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
