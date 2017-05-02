<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modulosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$modulos_list = new cmodulos_list();
$Page =& $modulos_list;

// Page init
$modulos_list->Page_Init();

// Page main
$modulos_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($modulos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var modulos_list = new ew_Page("modulos_list");

// page properties
modulos_list.PageID = "list"; // page ID
modulos_list.FormID = "fmoduloslist"; // form ID
var EW_PAGE_ID = modulos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
modulos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
modulos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
modulos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($modulos->Export == "") || (EW_EXPORT_MASTER_RECORD && $modulos->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$modulos_list->TotalRecs = $modulos->SelectRecordCount();
	} else {
		if ($modulos_list->Recordset = $modulos_list->LoadRecordset())
			$modulos_list->TotalRecs = $modulos_list->Recordset->RecordCount();
	}
	$modulos_list->StartRec = 1;
	if ($modulos_list->DisplayRecs <= 0 || ($modulos->Export <> "" && $modulos->ExportAll)) // Display all records
		$modulos_list->DisplayRecs = $modulos_list->TotalRecs;
	if (!($modulos->Export <> "" && $modulos->ExportAll))
		$modulos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$modulos_list->Recordset = $modulos_list->LoadRecordset($modulos_list->StartRec-1, $modulos_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $modulos->TableCaption() ?>
&nbsp;&nbsp;<?php $modulos_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($modulos->Export == "" && $modulos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(modulos_list);" style="text-decoration: none;"><img id="modulos_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="modulos_list_SearchPanel">
<form name="fmoduloslistsrch" id="fmoduloslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="modulos">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($modulos->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $modulos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($modulos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($modulos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($modulos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $modulos_list->ShowPageHeader(); ?>
<?php
$modulos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmoduloslist" id="fmoduloslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="modulos">
<div id="gmp_modulos" class="ewGridMiddlePanel">
<?php if ($modulos_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $modulos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$modulos_list->RenderListOptions();

// Render list options (header, left)
$modulos_list->ListOptions->Render("header", "left");
?>
<?php if ($modulos->nombre->Visible) { // nombre ?>
	<?php if ($modulos->SortUrl($modulos->nombre) == "") { ?>
		<td><?php echo $modulos->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $modulos->SortUrl($modulos->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $modulos->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($modulos->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($modulos->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($modulos->plantilla->Visible) { // plantilla ?>
	<?php if ($modulos->SortUrl($modulos->plantilla) == "") { ?>
		<td><?php echo $modulos->plantilla->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $modulos->SortUrl($modulos->plantilla) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $modulos->plantilla->FldCaption() ?></td><td style="width: 10px;"><?php if ($modulos->plantilla->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($modulos->plantilla->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($modulos->estatus->Visible) { // estatus ?>
	<?php if ($modulos->SortUrl($modulos->estatus) == "") { ?>
		<td><?php echo $modulos->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $modulos->SortUrl($modulos->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $modulos->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($modulos->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($modulos->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$modulos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($modulos->ExportAll && $modulos->Export <> "") {
	$modulos_list->StopRec = $modulos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($modulos_list->TotalRecs > $modulos_list->StartRec + $modulos_list->DisplayRecs - 1)
		$modulos_list->StopRec = $modulos_list->StartRec + $modulos_list->DisplayRecs - 1;
	else
		$modulos_list->StopRec = $modulos_list->TotalRecs;
}
$modulos_list->RecCnt = $modulos_list->StartRec - 1;
if ($modulos_list->Recordset && !$modulos_list->Recordset->EOF) {
	$modulos_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $modulos_list->StartRec > 1)
		$modulos_list->Recordset->Move($modulos_list->StartRec - 1);
} elseif (!$modulos->AllowAddDeleteRow && $modulos_list->StopRec == 0) {
	$modulos_list->StopRec = $modulos->GridAddRowCount;
}

// Initialize aggregate
$modulos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$modulos->ResetAttrs();
$modulos_list->RenderRow();
$modulos_list->RowCnt = 0;
while ($modulos_list->RecCnt < $modulos_list->StopRec) {
	$modulos_list->RecCnt++;
	if (intval($modulos_list->RecCnt) >= intval($modulos_list->StartRec)) {
		$modulos_list->RowCnt++;

		// Set up key count
		$modulos_list->KeyCount = $modulos_list->RowIndex;

		// Init row class and style
		$modulos->ResetAttrs();
		$modulos->CssClass = "";
		if ($modulos->CurrentAction == "gridadd") {
		} else {
			$modulos_list->LoadRowValues($modulos_list->Recordset); // Load row values
		}
		$modulos->RowType = EW_ROWTYPE_VIEW; // Render view
		$modulos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$modulos_list->RenderRow();

		// Render list options
		$modulos_list->RenderListOptions();
?>
	<tr<?php echo $modulos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$modulos_list->ListOptions->Render("body", "left");
?>
	<?php if ($modulos->nombre->Visible) { // nombre ?>
		<td<?php echo $modulos->nombre->CellAttributes() ?>>
<div<?php echo $modulos->nombre->ViewAttributes() ?>><?php echo $modulos->nombre->ListViewValue() ?></div>
<a name="<?php echo $modulos_list->PageObjName . "_row_" . $modulos_list->RowCnt ?>" id="<?php echo $modulos_list->PageObjName . "_row_" . $modulos_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($modulos->plantilla->Visible) { // plantilla ?>
		<td<?php echo $modulos->plantilla->CellAttributes() ?>>
<?php if ($modulos->plantilla->LinkAttributes() <> "") { ?>
<?php if (!empty($modulos->plantilla->Upload->DbValue)) { ?>
<a<?php echo $modulos->plantilla->LinkAttributes() ?>><?php echo $modulos->plantilla->ListViewValue() ?></a>
<?php } elseif (!in_array($modulos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($modulos->plantilla->Upload->DbValue)) { ?>
<?php echo $modulos->plantilla->ListViewValue() ?>
<?php } elseif (!in_array($modulos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($modulos->estatus->Visible) { // estatus ?>
		<td<?php echo $modulos->estatus->CellAttributes() ?>>
<div<?php echo $modulos->estatus->ViewAttributes() ?>><?php echo $modulos->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$modulos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($modulos->CurrentAction <> "gridadd")
		$modulos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($modulos_list->Recordset)
	$modulos_list->Recordset->Close();
?>
<?php if ($modulos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($modulos->CurrentAction <> "gridadd" && $modulos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($modulos_list->Pager)) $modulos_list->Pager = new cPrevNextPager($modulos_list->StartRec, $modulos_list->DisplayRecs, $modulos_list->TotalRecs) ?>
<?php if ($modulos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($modulos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $modulos_list->PageUrl() ?>start=<?php echo $modulos_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($modulos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $modulos_list->PageUrl() ?>start=<?php echo $modulos_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $modulos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($modulos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $modulos_list->PageUrl() ?>start=<?php echo $modulos_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($modulos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $modulos_list->PageUrl() ?>start=<?php echo $modulos_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $modulos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $modulos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $modulos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $modulos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($modulos_list->SearchWhere == "0=101") { ?>
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
<?php if ($modulos->Export == "" && $modulos->CurrentAction == "") { ?>
<?php } ?>
<?php
$modulos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($modulos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$modulos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodulos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'modulos';

	// Page object name
	var $PageObjName = 'modulos_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $modulos;
		if ($modulos->UseTokenInUrl) $PageUrl .= "t=" . $modulos->TableVar . "&"; // Add page token
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
		global $objForm, $modulos;
		if ($modulos->UseTokenInUrl) {
			if ($objForm)
				return ($modulos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($modulos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodulos_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (modulos)
		if (!isset($GLOBALS["modulos"])) {
			$GLOBALS["modulos"] = new cmodulos();
			$GLOBALS["Table"] =& $GLOBALS["modulos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "modulosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "modulosdelete.php";
		$this->MultiUpdateUrl = "modulosupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'modulos', TRUE);

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
		global $modulos;

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
			$modulos->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $modulos;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($modulos->Export <> "" ||
				$modulos->CurrentAction == "gridadd" ||
				$modulos->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$modulos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($modulos->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $modulos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$modulos->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$modulos->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$modulos->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $modulos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$modulos->setSessionWhere($sFilter);
		$modulos->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $modulos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $modulos->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $modulos->plantilla, $Keyword);
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
		global $Security, $modulos;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $modulos->BasicSearchKeyword;
		$sSearchType = $modulos->BasicSearchType;
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
			$modulos->setSessionBasicSearchKeyword($sSearchKeyword);
			$modulos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $modulos;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$modulos->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $modulos;
		$modulos->setSessionBasicSearchKeyword("");
		$modulos->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $modulos;
		$bRestore = TRUE;
		if ($modulos->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$modulos->BasicSearchKeyword = $modulos->getSessionBasicSearchKeyword();
			$modulos->BasicSearchType = $modulos->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $modulos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$modulos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$modulos->CurrentOrderType = @$_GET["ordertype"];
			$modulos->UpdateSort($modulos->nombre); // nombre
			$modulos->UpdateSort($modulos->plantilla); // plantilla
			$modulos->UpdateSort($modulos->estatus); // estatus
			$modulos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $modulos;
		$sOrderBy = $modulos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($modulos->SqlOrderBy() <> "") {
				$sOrderBy = $modulos->SqlOrderBy();
				$modulos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $modulos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$modulos->setSessionOrderBy($sOrderBy);
				$modulos->nombre->setSort("");
				$modulos->plantilla->setSort("");
				$modulos->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$modulos->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $modulos;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $modulos, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $modulos;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $modulos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$modulos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$modulos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $modulos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$modulos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$modulos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$modulos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $modulos;
		$modulos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$modulos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $modulos;

		// Call Recordset Selecting event
		$modulos->Recordset_Selecting($modulos->CurrentFilter);

		// Load List page SQL
		$sSql = $modulos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$modulos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $modulos;
		$sFilter = $modulos->KeyFilter();

		// Call Row Selecting event
		$modulos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$modulos->CurrentFilter = $sFilter;
		$sSql = $modulos->SQL();
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
		global $conn, $modulos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$modulos->Row_Selected($row);
		$modulos->id_modulo_financiero->setDbValue($rs->fields('id_modulo_financiero'));
		$modulos->nombre->setDbValue($rs->fields('nombre'));
		$modulos->plantilla->Upload->DbValue = $rs->fields('plantilla');
		$modulos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $modulos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($modulos->getKey("id_modulo_financiero")) <> "")
			$modulos->id_modulo_financiero->CurrentValue = $modulos->getKey("id_modulo_financiero"); // id_modulo_financiero
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$modulos->CurrentFilter = $modulos->KeyFilter();
			$sSql = $modulos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $modulos;

		// Initialize URLs
		$this->ViewUrl = $modulos->ViewUrl();
		$this->EditUrl = $modulos->EditUrl();
		$this->InlineEditUrl = $modulos->InlineEditUrl();
		$this->CopyUrl = $modulos->CopyUrl();
		$this->InlineCopyUrl = $modulos->InlineCopyUrl();
		$this->DeleteUrl = $modulos->DeleteUrl();

		// Call Row_Rendering event
		$modulos->Row_Rendering();

		// Common render codes for all row types
		// id_modulo_financiero
		// nombre
		// plantilla
		// estatus

		if ($modulos->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$modulos->nombre->ViewValue = $modulos->nombre->CurrentValue;
			$modulos->nombre->ViewCustomAttributes = "";

			// plantilla
			if (!ew_Empty($modulos->plantilla->Upload->DbValue)) {
				$modulos->plantilla->ViewValue = $modulos->plantilla->Upload->DbValue;
			} else {
				$modulos->plantilla->ViewValue = "";
			}
			$modulos->plantilla->ViewCustomAttributes = "";

			// estatus
			if (strval($modulos->estatus->CurrentValue) <> "") {
				switch ($modulos->estatus->CurrentValue) {
					case "1":
						$modulos->estatus->ViewValue = $modulos->estatus->FldTagCaption(1) <> "" ? $modulos->estatus->FldTagCaption(1) : $modulos->estatus->CurrentValue;
						break;
					case "0":
						$modulos->estatus->ViewValue = $modulos->estatus->FldTagCaption(2) <> "" ? $modulos->estatus->FldTagCaption(2) : $modulos->estatus->CurrentValue;
						break;
					default:
						$modulos->estatus->ViewValue = $modulos->estatus->CurrentValue;
				}
			} else {
				$modulos->estatus->ViewValue = NULL;
			}
			$modulos->estatus->ViewCustomAttributes = "";

			// nombre
			$modulos->nombre->LinkCustomAttributes = "";
			$modulos->nombre->HrefValue = "";
			$modulos->nombre->TooltipValue = "";

			// plantilla
			$modulos->plantilla->LinkCustomAttributes = "";
			if (!ew_Empty($modulos->plantilla->Upload->DbValue)) {
				$modulos->plantilla->HrefValue = ew_UploadPathEx(FALSE, $modulos->plantilla->UploadPath) . ((!empty($modulos->plantilla->ViewValue)) ? $modulos->plantilla->ViewValue : $modulos->plantilla->CurrentValue); // Add prefix/suffix
				$modulos->plantilla->LinkAttrs["target"] = ""; // Add target
				if ($modulos->Export <> "") $modulos->plantilla->HrefValue = ew_ConvertFullUrl($modulos->plantilla->HrefValue);
			} else {
				$modulos->plantilla->HrefValue = "";
			}
			$modulos->plantilla->TooltipValue = "";

			// estatus
			$modulos->estatus->LinkCustomAttributes = "";
			$modulos->estatus->HrefValue = "";
			$modulos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($modulos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$modulos->Row_Rendered();
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
		$table = 'modulos';
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
