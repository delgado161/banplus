<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "bannerinfo.php" ?>
<?php include_once "banner_seccioninfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$banner_list = new cbanner_list();
$Page =& $banner_list;

// Page init
$banner_list->Page_Init();

// Page main
$banner_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($banner->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var banner_list = new ew_Page("banner_list");

// page properties
banner_list.PageID = "list"; // page ID
banner_list.FormID = "fbannerlist"; // form ID
var EW_PAGE_ID = banner_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
banner_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
banner_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banner_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($banner->Export == "") || (EW_EXPORT_MASTER_RECORD && $banner->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$banner_list->TotalRecs = $banner->SelectRecordCount();
	} else {
		if ($banner_list->Recordset = $banner_list->LoadRecordset())
			$banner_list->TotalRecs = $banner_list->Recordset->RecordCount();
	}
	$banner_list->StartRec = 1;
	if ($banner_list->DisplayRecs <= 0 || ($banner->Export <> "" && $banner->ExportAll)) // Display all records
		$banner_list->DisplayRecs = $banner_list->TotalRecs;
	if (!($banner->Export <> "" && $banner->ExportAll))
		$banner_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$banner_list->Recordset = $banner_list->LoadRecordset($banner_list->StartRec-1, $banner_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banner->TableCaption() ?>
&nbsp;&nbsp;<?php $banner_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($banner->Export == "" && $banner->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(banner_list);" style="text-decoration: none;"><img id="banner_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="banner_list_SearchPanel">
<form name="fbannerlistsrch" id="fbannerlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="banner">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($banner->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $banner_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($banner->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($banner->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($banner->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $banner_list->ShowPageHeader(); ?>
<?php
$banner_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fbannerlist" id="fbannerlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="banner">
<div id="gmp_banner" class="ewGridMiddlePanel">
<?php if ($banner_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $banner->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$banner_list->RenderListOptions();

// Render list options (header, left)
$banner_list->ListOptions->Render("header", "left");
?>
<?php if ($banner->nombre->Visible) { // nombre ?>
	<?php if ($banner->SortUrl($banner->nombre) == "") { ?>
		<td><?php echo $banner->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banner->SortUrl($banner->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($banner->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner->imagen->Visible) { // imagen ?>
	<?php if ($banner->SortUrl($banner->imagen) == "") { ?>
		<td><?php echo $banner->imagen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banner->SortUrl($banner->imagen) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner->imagen->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner->imagen->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner->imagen->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner->estatus->Visible) { // estatus ?>
	<?php if ($banner->SortUrl($banner->estatus) == "") { ?>
		<td><?php echo $banner->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banner->SortUrl($banner->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$banner_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($banner->ExportAll && $banner->Export <> "") {
	$banner_list->StopRec = $banner_list->TotalRecs;
} else {

	// Set the last record to display
	if ($banner_list->TotalRecs > $banner_list->StartRec + $banner_list->DisplayRecs - 1)
		$banner_list->StopRec = $banner_list->StartRec + $banner_list->DisplayRecs - 1;
	else
		$banner_list->StopRec = $banner_list->TotalRecs;
}
$banner_list->RecCnt = $banner_list->StartRec - 1;
if ($banner_list->Recordset && !$banner_list->Recordset->EOF) {
	$banner_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $banner_list->StartRec > 1)
		$banner_list->Recordset->Move($banner_list->StartRec - 1);
} elseif (!$banner->AllowAddDeleteRow && $banner_list->StopRec == 0) {
	$banner_list->StopRec = $banner->GridAddRowCount;
}

// Initialize aggregate
$banner->RowType = EW_ROWTYPE_AGGREGATEINIT;
$banner->ResetAttrs();
$banner_list->RenderRow();
$banner_list->RowCnt = 0;
while ($banner_list->RecCnt < $banner_list->StopRec) {
	$banner_list->RecCnt++;
	if (intval($banner_list->RecCnt) >= intval($banner_list->StartRec)) {
		$banner_list->RowCnt++;

		// Set up key count
		$banner_list->KeyCount = $banner_list->RowIndex;

		// Init row class and style
		$banner->ResetAttrs();
		$banner->CssClass = "";
		if ($banner->CurrentAction == "gridadd") {
		} else {
			$banner_list->LoadRowValues($banner_list->Recordset); // Load row values
		}
		$banner->RowType = EW_ROWTYPE_VIEW; // Render view
		$banner->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$banner_list->RenderRow();

		// Render list options
		$banner_list->RenderListOptions();
?>
	<tr<?php echo $banner->RowAttributes() ?>>
<?php

// Render list options (body, left)
$banner_list->ListOptions->Render("body", "left");
?>
	<?php if ($banner->nombre->Visible) { // nombre ?>
		<td<?php echo $banner->nombre->CellAttributes() ?>>
<div<?php echo $banner->nombre->ViewAttributes() ?>><?php echo $banner->nombre->ListViewValue() ?></div>
<a name="<?php echo $banner_list->PageObjName . "_row_" . $banner_list->RowCnt ?>" id="<?php echo $banner_list->PageObjName . "_row_" . $banner_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($banner->imagen->Visible) { // imagen ?>
		<td<?php echo $banner->imagen->CellAttributes() ?>>
<?php if ($banner->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($banner->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $banner->imagen->UploadPath) . $banner->imagen->Upload->DbValue ?>" border=0<?php echo $banner->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($banner->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($banner->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $banner->imagen->UploadPath) . $banner->imagen->Upload->DbValue ?>" border=0<?php echo $banner->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($banner->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($banner->estatus->Visible) { // estatus ?>
		<td<?php echo $banner->estatus->CellAttributes() ?>>
<div<?php echo $banner->estatus->ViewAttributes() ?>><?php echo $banner->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$banner_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($banner->CurrentAction <> "gridadd")
		$banner_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($banner_list->Recordset)
	$banner_list->Recordset->Close();
?>
<?php if ($banner->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($banner->CurrentAction <> "gridadd" && $banner->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($banner_list->Pager)) $banner_list->Pager = new cPrevNextPager($banner_list->StartRec, $banner_list->DisplayRecs, $banner_list->TotalRecs) ?>
<?php if ($banner_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($banner_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $banner_list->PageUrl() ?>start=<?php echo $banner_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($banner_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $banner_list->PageUrl() ?>start=<?php echo $banner_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $banner_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($banner_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $banner_list->PageUrl() ?>start=<?php echo $banner_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($banner_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $banner_list->PageUrl() ?>start=<?php echo $banner_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $banner_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $banner_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $banner_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $banner_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($banner_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $banner_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($banner_seccion->DetailAdd && $Security->AllowAdd('banner_seccion')) { ?>
<a class="ewGridLink" href="<?php echo $banner->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=banner_seccion" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $banner->TableCaption() ?>/<?php echo $banner_seccion->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($banner->Export == "" && $banner->CurrentAction == "") { ?>
<?php } ?>
<?php
$banner_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($banner->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$banner_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanner_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'banner';

	// Page object name
	var $PageObjName = 'banner_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banner;
		if ($banner->UseTokenInUrl) $PageUrl .= "t=" . $banner->TableVar . "&"; // Add page token
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
		global $objForm, $banner;
		if ($banner->UseTokenInUrl) {
			if ($objForm)
				return ($banner->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banner->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanner_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (banner)
		if (!isset($GLOBALS["banner"])) {
			$GLOBALS["banner"] = new cbanner();
			$GLOBALS["Table"] =& $GLOBALS["banner"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "banneradd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "bannerdelete.php";
		$this->MultiUpdateUrl = "bannerupdate.php";

		// Table object (banner_seccion)
		if (!isset($GLOBALS['banner_seccion'])) $GLOBALS['banner_seccion'] = new cbanner_seccion();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banner', TRUE);

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
		global $banner;

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
			$banner->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $banner;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($banner->Export <> "" ||
				$banner->CurrentAction == "gridadd" ||
				$banner->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$banner->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($banner->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $banner->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$banner->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$banner->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$banner->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $banner->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$banner->setSessionWhere($sFilter);
		$banner->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $banner;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $banner->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $banner->imagen, $Keyword);
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
		global $Security, $banner;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $banner->BasicSearchKeyword;
		$sSearchType = $banner->BasicSearchType;
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
			$banner->setSessionBasicSearchKeyword($sSearchKeyword);
			$banner->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $banner;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$banner->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $banner;
		$banner->setSessionBasicSearchKeyword("");
		$banner->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $banner;
		$bRestore = TRUE;
		if ($banner->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$banner->BasicSearchKeyword = $banner->getSessionBasicSearchKeyword();
			$banner->BasicSearchType = $banner->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $banner;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$banner->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$banner->CurrentOrderType = @$_GET["ordertype"];
			$banner->UpdateSort($banner->nombre); // nombre
			$banner->UpdateSort($banner->imagen); // imagen
			$banner->UpdateSort($banner->estatus); // estatus
			$banner->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $banner;
		$sOrderBy = $banner->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($banner->SqlOrderBy() <> "") {
				$sOrderBy = $banner->SqlOrderBy();
				$banner->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $banner;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$banner->setSessionOrderBy($sOrderBy);
				$banner->nombre->setSort("");
				$banner->imagen->setSort("");
				$banner->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$banner->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $banner;

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

		// "detail_banner_seccion"
		$item =& $this->ListOptions->Add("detail_banner_seccion");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('banner_seccion');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $banner, $objForm;
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

		// "detail_banner_seccion"
		$oListOpt =& $this->ListOptions->Items["detail_banner_seccion"];
		if ($Security->AllowList('banner_seccion')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("banner_seccion", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"banner_seccionlist.php?" . EW_TABLE_SHOW_MASTER . "=banner&id_banner=" . urlencode(strval($banner->id_banner->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["banner_seccion"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit('banner_seccion'))
				$links .= "<a class=\"ewRowLink\" href=\"" . $banner->EditUrl(EW_TABLE_SHOW_DETAIL . "=banner_seccion") . "\">" . $Language->Phrase("EditLink") . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $banner;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $banner;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$banner->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$banner->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $banner->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$banner->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$banner->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$banner->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $banner;
		$banner->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$banner->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $banner;

		// Call Recordset Selecting event
		$banner->Recordset_Selecting($banner->CurrentFilter);

		// Load List page SQL
		$sSql = $banner->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$banner->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banner;
		$sFilter = $banner->KeyFilter();

		// Call Row Selecting event
		$banner->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banner->CurrentFilter = $sFilter;
		$sSql = $banner->SQL();
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
		global $conn, $banner;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$banner->Row_Selected($row);
		$banner->id_banner->setDbValue($rs->fields('id_banner'));
		$banner->nombre->setDbValue($rs->fields('nombre'));
		$banner->imagen->Upload->DbValue = $rs->fields('imagen');
		$banner->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $banner;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($banner->getKey("id_banner")) <> "")
			$banner->id_banner->CurrentValue = $banner->getKey("id_banner"); // id_banner
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$banner->CurrentFilter = $banner->KeyFilter();
			$sSql = $banner->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banner;

		// Initialize URLs
		$this->ViewUrl = $banner->ViewUrl();
		$this->EditUrl = $banner->EditUrl();
		$this->InlineEditUrl = $banner->InlineEditUrl();
		$this->CopyUrl = $banner->CopyUrl();
		$this->InlineCopyUrl = $banner->InlineCopyUrl();
		$this->DeleteUrl = $banner->DeleteUrl();

		// Call Row_Rendering event
		$banner->Row_Rendering();

		// Common render codes for all row types
		// id_banner
		// nombre
		// imagen
		// estatus

		if ($banner->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$banner->nombre->ViewValue = $banner->nombre->CurrentValue;
			$banner->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($banner->imagen->Upload->DbValue)) {
				$banner->imagen->ViewValue = $banner->imagen->Upload->DbValue;
				$banner->imagen->ImageWidth = 350;
				$banner->imagen->ImageHeight ="";
				$banner->imagen->ImageAlt = $banner->imagen->FldAlt();
			} else {
				$banner->imagen->ViewValue = "";
			}
			$banner->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($banner->estatus->CurrentValue) <> "") {
				switch ($banner->estatus->CurrentValue) {
					case "1":
						$banner->estatus->ViewValue = $banner->estatus->FldTagCaption(1) <> "" ? $banner->estatus->FldTagCaption(1) : $banner->estatus->CurrentValue;
						break;
					case "0":
						$banner->estatus->ViewValue = $banner->estatus->FldTagCaption(2) <> "" ? $banner->estatus->FldTagCaption(2) : $banner->estatus->CurrentValue;
						break;
					default:
						$banner->estatus->ViewValue = $banner->estatus->CurrentValue;
				}
			} else {
				$banner->estatus->ViewValue = NULL;
			}
			$banner->estatus->ViewCustomAttributes = "";

			// nombre
			$banner->nombre->LinkCustomAttributes = "";
			$banner->nombre->HrefValue = "";
			$banner->nombre->TooltipValue = "";

			// imagen
			$banner->imagen->LinkCustomAttributes = "";
			$banner->imagen->HrefValue = "";
			$banner->imagen->TooltipValue = "";

			// estatus
			$banner->estatus->LinkCustomAttributes = "";
			$banner->estatus->HrefValue = "";
			$banner->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($banner->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banner->Row_Rendered();
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
		$table = 'banner';
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
