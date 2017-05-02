<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "calendarioinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$calendario_list = new ccalendario_list();
$Page =& $calendario_list;

// Page init
$calendario_list->Page_Init();

// Page main
$calendario_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($calendario->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var calendario_list = new ew_Page("calendario_list");

// page properties
calendario_list.PageID = "list"; // page ID
calendario_list.FormID = "fcalendariolist"; // form ID
var EW_PAGE_ID = calendario_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
calendario_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
calendario_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
calendario_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($calendario->Export == "") || (EW_EXPORT_MASTER_RECORD && $calendario->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$calendario_list->TotalRecs = $calendario->SelectRecordCount();
	} else {
		if ($calendario_list->Recordset = $calendario_list->LoadRecordset())
			$calendario_list->TotalRecs = $calendario_list->Recordset->RecordCount();
	}
	$calendario_list->StartRec = 1;
	if ($calendario_list->DisplayRecs <= 0 || ($calendario->Export <> "" && $calendario->ExportAll)) // Display all records
		$calendario_list->DisplayRecs = $calendario_list->TotalRecs;
	if (!($calendario->Export <> "" && $calendario->ExportAll))
		$calendario_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$calendario_list->Recordset = $calendario_list->LoadRecordset($calendario_list->StartRec-1, $calendario_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $calendario->TableCaption() ?>
&nbsp;&nbsp;<?php $calendario_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($calendario->Export == "" && $calendario->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(calendario_list);" style="text-decoration: none;"><img id="calendario_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="calendario_list_SearchPanel">
<form name="fcalendariolistsrch" id="fcalendariolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="calendario">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($calendario->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $calendario_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($calendario->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($calendario->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($calendario->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $calendario_list->ShowPageHeader(); ?>
<?php
$calendario_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fcalendariolist" id="fcalendariolist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="calendario">
<div id="gmp_calendario" class="ewGridMiddlePanel">
<?php if ($calendario_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $calendario->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$calendario_list->RenderListOptions();

// Render list options (header, left)
$calendario_list->ListOptions->Render("header", "left");
?>
<?php if ($calendario->tipo->Visible) { // tipo ?>
	<?php if ($calendario->SortUrl($calendario->tipo) == "") { ?>
		<td><?php echo $calendario->tipo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $calendario->SortUrl($calendario->tipo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $calendario->tipo->FldCaption() ?></td><td style="width: 10px;"><?php if ($calendario->tipo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($calendario->tipo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($calendario->fecha->Visible) { // fecha ?>
	<?php if ($calendario->SortUrl($calendario->fecha) == "") { ?>
		<td><?php echo $calendario->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $calendario->SortUrl($calendario->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $calendario->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($calendario->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($calendario->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($calendario->descripcion->Visible) { // descripcion ?>
	<?php if ($calendario->SortUrl($calendario->descripcion) == "") { ?>
		<td><?php echo $calendario->descripcion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $calendario->SortUrl($calendario->descripcion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $calendario->descripcion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($calendario->descripcion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($calendario->descripcion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($calendario->estatus->Visible) { // estatus ?>
	<?php if ($calendario->SortUrl($calendario->estatus) == "") { ?>
		<td><?php echo $calendario->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $calendario->SortUrl($calendario->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $calendario->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($calendario->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($calendario->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$calendario_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($calendario->ExportAll && $calendario->Export <> "") {
	$calendario_list->StopRec = $calendario_list->TotalRecs;
} else {

	// Set the last record to display
	if ($calendario_list->TotalRecs > $calendario_list->StartRec + $calendario_list->DisplayRecs - 1)
		$calendario_list->StopRec = $calendario_list->StartRec + $calendario_list->DisplayRecs - 1;
	else
		$calendario_list->StopRec = $calendario_list->TotalRecs;
}
$calendario_list->RecCnt = $calendario_list->StartRec - 1;
if ($calendario_list->Recordset && !$calendario_list->Recordset->EOF) {
	$calendario_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $calendario_list->StartRec > 1)
		$calendario_list->Recordset->Move($calendario_list->StartRec - 1);
} elseif (!$calendario->AllowAddDeleteRow && $calendario_list->StopRec == 0) {
	$calendario_list->StopRec = $calendario->GridAddRowCount;
}

// Initialize aggregate
$calendario->RowType = EW_ROWTYPE_AGGREGATEINIT;
$calendario->ResetAttrs();
$calendario_list->RenderRow();
$calendario_list->RowCnt = 0;
while ($calendario_list->RecCnt < $calendario_list->StopRec) {
	$calendario_list->RecCnt++;
	if (intval($calendario_list->RecCnt) >= intval($calendario_list->StartRec)) {
		$calendario_list->RowCnt++;

		// Set up key count
		$calendario_list->KeyCount = $calendario_list->RowIndex;

		// Init row class and style
		$calendario->ResetAttrs();
		$calendario->CssClass = "";
		if ($calendario->CurrentAction == "gridadd") {
		} else {
			$calendario_list->LoadRowValues($calendario_list->Recordset); // Load row values
		}
		$calendario->RowType = EW_ROWTYPE_VIEW; // Render view
		$calendario->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$calendario_list->RenderRow();

		// Render list options
		$calendario_list->RenderListOptions();
?>
	<tr<?php echo $calendario->RowAttributes() ?>>
<?php

// Render list options (body, left)
$calendario_list->ListOptions->Render("body", "left");
?>
	<?php if ($calendario->tipo->Visible) { // tipo ?>
		<td<?php echo $calendario->tipo->CellAttributes() ?>>
<div<?php echo $calendario->tipo->ViewAttributes() ?>><?php echo $calendario->tipo->ListViewValue() ?></div>
<a name="<?php echo $calendario_list->PageObjName . "_row_" . $calendario_list->RowCnt ?>" id="<?php echo $calendario_list->PageObjName . "_row_" . $calendario_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($calendario->fecha->Visible) { // fecha ?>
		<td<?php echo $calendario->fecha->CellAttributes() ?>>
<div<?php echo $calendario->fecha->ViewAttributes() ?>><?php echo $calendario->fecha->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($calendario->descripcion->Visible) { // descripcion ?>
		<td<?php echo $calendario->descripcion->CellAttributes() ?>>
<div<?php echo $calendario->descripcion->ViewAttributes() ?>><?php echo $calendario->descripcion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($calendario->estatus->Visible) { // estatus ?>
		<td<?php echo $calendario->estatus->CellAttributes() ?>>
<div<?php echo $calendario->estatus->ViewAttributes() ?>><?php echo $calendario->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$calendario_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($calendario->CurrentAction <> "gridadd")
		$calendario_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($calendario_list->Recordset)
	$calendario_list->Recordset->Close();
?>
<?php if ($calendario->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($calendario->CurrentAction <> "gridadd" && $calendario->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($calendario_list->Pager)) $calendario_list->Pager = new cPrevNextPager($calendario_list->StartRec, $calendario_list->DisplayRecs, $calendario_list->TotalRecs) ?>
<?php if ($calendario_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($calendario_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $calendario_list->PageUrl() ?>start=<?php echo $calendario_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($calendario_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $calendario_list->PageUrl() ?>start=<?php echo $calendario_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $calendario_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($calendario_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $calendario_list->PageUrl() ?>start=<?php echo $calendario_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($calendario_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $calendario_list->PageUrl() ?>start=<?php echo $calendario_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $calendario_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $calendario_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $calendario_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $calendario_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($calendario_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $calendario_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($calendario->Export == "" && $calendario->CurrentAction == "") { ?>
<?php } ?>
<?php
$calendario_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($calendario->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$calendario_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccalendario_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'calendario';

	// Page object name
	var $PageObjName = 'calendario_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $calendario;
		if ($calendario->UseTokenInUrl) $PageUrl .= "t=" . $calendario->TableVar . "&"; // Add page token
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
		global $objForm, $calendario;
		if ($calendario->UseTokenInUrl) {
			if ($objForm)
				return ($calendario->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($calendario->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccalendario_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (calendario)
		if (!isset($GLOBALS["calendario"])) {
			$GLOBALS["calendario"] = new ccalendario();
			$GLOBALS["Table"] =& $GLOBALS["calendario"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "calendarioadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "calendariodelete.php";
		$this->MultiUpdateUrl = "calendarioupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'calendario', TRUE);

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
		global $calendario;

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
			$calendario->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $calendario;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($calendario->Export <> "" ||
				$calendario->CurrentAction == "gridadd" ||
				$calendario->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$calendario->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($calendario->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $calendario->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$calendario->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$calendario->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$calendario->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $calendario->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$calendario->setSessionWhere($sFilter);
		$calendario->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $calendario;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $calendario->tipo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $calendario->descripcion, $Keyword);
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
		global $Security, $calendario;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $calendario->BasicSearchKeyword;
		$sSearchType = $calendario->BasicSearchType;
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
			$calendario->setSessionBasicSearchKeyword($sSearchKeyword);
			$calendario->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $calendario;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$calendario->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $calendario;
		$calendario->setSessionBasicSearchKeyword("");
		$calendario->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $calendario;
		$bRestore = TRUE;
		if ($calendario->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$calendario->BasicSearchKeyword = $calendario->getSessionBasicSearchKeyword();
			$calendario->BasicSearchType = $calendario->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $calendario;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$calendario->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$calendario->CurrentOrderType = @$_GET["ordertype"];
			$calendario->UpdateSort($calendario->tipo); // tipo
			$calendario->UpdateSort($calendario->fecha); // fecha
			$calendario->UpdateSort($calendario->descripcion); // descripcion
			$calendario->UpdateSort($calendario->estatus); // estatus
			$calendario->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $calendario;
		$sOrderBy = $calendario->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($calendario->SqlOrderBy() <> "") {
				$sOrderBy = $calendario->SqlOrderBy();
				$calendario->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $calendario;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$calendario->setSessionOrderBy($sOrderBy);
				$calendario->tipo->setSort("");
				$calendario->fecha->setSort("");
				$calendario->descripcion->setSort("");
				$calendario->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$calendario->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $calendario;

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
		global $Security, $Language, $calendario, $objForm;
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
		global $Security, $Language, $calendario;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $calendario;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$calendario->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$calendario->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $calendario->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$calendario->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$calendario->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$calendario->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $calendario;
		$calendario->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$calendario->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $calendario;

		// Call Recordset Selecting event
		$calendario->Recordset_Selecting($calendario->CurrentFilter);

		// Load List page SQL
		$sSql = $calendario->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$calendario->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $calendario;
		$sFilter = $calendario->KeyFilter();

		// Call Row Selecting event
		$calendario->Row_Selecting($sFilter);

		// Load SQL based on filter
		$calendario->CurrentFilter = $sFilter;
		$sSql = $calendario->SQL();
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
		global $conn, $calendario;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$calendario->Row_Selected($row);
		$calendario->id_calendario->setDbValue($rs->fields('id_calendario'));
		$calendario->tipo->setDbValue($rs->fields('tipo'));
		$calendario->fecha->setDbValue($rs->fields('fecha'));
		$calendario->descripcion->setDbValue($rs->fields('descripcion'));
		$calendario->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $calendario;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($calendario->getKey("id_calendario")) <> "")
			$calendario->id_calendario->CurrentValue = $calendario->getKey("id_calendario"); // id_calendario
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$calendario->CurrentFilter = $calendario->KeyFilter();
			$sSql = $calendario->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $calendario;

		// Initialize URLs
		$this->ViewUrl = $calendario->ViewUrl();
		$this->EditUrl = $calendario->EditUrl();
		$this->InlineEditUrl = $calendario->InlineEditUrl();
		$this->CopyUrl = $calendario->CopyUrl();
		$this->InlineCopyUrl = $calendario->InlineCopyUrl();
		$this->DeleteUrl = $calendario->DeleteUrl();

		// Call Row_Rendering event
		$calendario->Row_Rendering();

		// Common render codes for all row types
		// id_calendario
		// tipo
		// fecha
		// descripcion
		// estatus

		if ($calendario->RowType == EW_ROWTYPE_VIEW) { // View row

			// tipo
			if (strval($calendario->tipo->CurrentValue) <> "") {
				$calendario->tipo->ViewValue = "";
				$arwrk = explode(",", strval($calendario->tipo->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++) {
					switch (trim($arwrk[$ari])) {
						case "1":
							$calendario->tipo->ViewValue .= $calendario->tipo->FldTagCaption(1) <> "" ? $calendario->tipo->FldTagCaption(1) : trim($arwrk[$ari]);
							break;
						case "2":
							$calendario->tipo->ViewValue .= $calendario->tipo->FldTagCaption(2) <> "" ? $calendario->tipo->FldTagCaption(2) : trim($arwrk[$ari]);
							break;
						default:
							$calendario->tipo->ViewValue .= trim($arwrk[$ari]);
					}
					if ($ari < $cnt-1) $calendario->tipo->ViewValue .= ew_ViewOptionSeparator($ari);
				}
			} else {
				$calendario->tipo->ViewValue = NULL;
			}
			$calendario->tipo->ViewCustomAttributes = "";

			// fecha
			$calendario->fecha->ViewValue = $calendario->fecha->CurrentValue;
			$calendario->fecha->ViewValue = ew_FormatDateTime($calendario->fecha->ViewValue, 7);
			$calendario->fecha->ViewCustomAttributes = "";

			// descripcion
			$calendario->descripcion->ViewValue = $calendario->descripcion->CurrentValue;
			$calendario->descripcion->ViewCustomAttributes = "";

			// estatus
			if (strval($calendario->estatus->CurrentValue) <> "") {
				switch ($calendario->estatus->CurrentValue) {
					case "1":
						$calendario->estatus->ViewValue = $calendario->estatus->FldTagCaption(1) <> "" ? $calendario->estatus->FldTagCaption(1) : $calendario->estatus->CurrentValue;
						break;
					case "0":
						$calendario->estatus->ViewValue = $calendario->estatus->FldTagCaption(2) <> "" ? $calendario->estatus->FldTagCaption(2) : $calendario->estatus->CurrentValue;
						break;
					default:
						$calendario->estatus->ViewValue = $calendario->estatus->CurrentValue;
				}
			} else {
				$calendario->estatus->ViewValue = NULL;
			}
			$calendario->estatus->ViewCustomAttributes = "";

			// tipo
			$calendario->tipo->LinkCustomAttributes = "";
			$calendario->tipo->HrefValue = "";
			$calendario->tipo->TooltipValue = "";

			// fecha
			$calendario->fecha->LinkCustomAttributes = "";
			$calendario->fecha->HrefValue = "";
			$calendario->fecha->TooltipValue = "";

			// descripcion
			$calendario->descripcion->LinkCustomAttributes = "";
			$calendario->descripcion->HrefValue = "";
			$calendario->descripcion->TooltipValue = "";

			// estatus
			$calendario->estatus->LinkCustomAttributes = "";
			$calendario->estatus->HrefValue = "";
			$calendario->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($calendario->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$calendario->Row_Rendered();
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
		$table = 'calendario';
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
