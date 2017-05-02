<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "promocionesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$promociones_list = new cpromociones_list();
$Page =& $promociones_list;

// Page init
$promociones_list->Page_Init();

// Page main
$promociones_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($promociones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var promociones_list = new ew_Page("promociones_list");

// page properties
promociones_list.PageID = "list"; // page ID
promociones_list.FormID = "fpromocioneslist"; // form ID
var EW_PAGE_ID = promociones_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
promociones_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
promociones_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
promociones_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($promociones->Export == "") || (EW_EXPORT_MASTER_RECORD && $promociones->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$promociones_list->TotalRecs = $promociones->SelectRecordCount();
	} else {
		if ($promociones_list->Recordset = $promociones_list->LoadRecordset())
			$promociones_list->TotalRecs = $promociones_list->Recordset->RecordCount();
	}
	$promociones_list->StartRec = 1;
	if ($promociones_list->DisplayRecs <= 0 || ($promociones->Export <> "" && $promociones->ExportAll)) // Display all records
		$promociones_list->DisplayRecs = $promociones_list->TotalRecs;
	if (!($promociones->Export <> "" && $promociones->ExportAll))
		$promociones_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$promociones_list->Recordset = $promociones_list->LoadRecordset($promociones_list->StartRec-1, $promociones_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $promociones->TableCaption() ?>
&nbsp;&nbsp;<?php $promociones_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($promociones->Export == "" && $promociones->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(promociones_list);" style="text-decoration: none;"><img id="promociones_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="promociones_list_SearchPanel">
<form name="fpromocioneslistsrch" id="fpromocioneslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="promociones">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($promociones->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $promociones_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($promociones->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($promociones->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($promociones->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $promociones_list->ShowPageHeader(); ?>
<?php
$promociones_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fpromocioneslist" id="fpromocioneslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="promociones">
<div id="gmp_promociones" class="ewGridMiddlePanel">
<?php if ($promociones_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $promociones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$promociones_list->RenderListOptions();

// Render list options (header, left)
$promociones_list->ListOptions->Render("header", "left");
?>
<?php if ($promociones->titulo->Visible) { // titulo ?>
	<?php if ($promociones->SortUrl($promociones->titulo) == "") { ?>
		<td><?php echo $promociones->titulo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $promociones->SortUrl($promociones->titulo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $promociones->titulo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($promociones->titulo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($promociones->titulo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($promociones->imagen->Visible) { // imagen ?>
	<?php if ($promociones->SortUrl($promociones->imagen) == "") { ?>
		<td><?php echo $promociones->imagen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $promociones->SortUrl($promociones->imagen) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $promociones->imagen->FldCaption() ?></td><td style="width: 10px;"><?php if ($promociones->imagen->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($promociones->imagen->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($promociones->estatus->Visible) { // estatus ?>
	<?php if ($promociones->SortUrl($promociones->estatus) == "") { ?>
		<td><?php echo $promociones->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $promociones->SortUrl($promociones->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $promociones->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($promociones->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($promociones->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$promociones_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($promociones->ExportAll && $promociones->Export <> "") {
	$promociones_list->StopRec = $promociones_list->TotalRecs;
} else {

	// Set the last record to display
	if ($promociones_list->TotalRecs > $promociones_list->StartRec + $promociones_list->DisplayRecs - 1)
		$promociones_list->StopRec = $promociones_list->StartRec + $promociones_list->DisplayRecs - 1;
	else
		$promociones_list->StopRec = $promociones_list->TotalRecs;
}
$promociones_list->RecCnt = $promociones_list->StartRec - 1;
if ($promociones_list->Recordset && !$promociones_list->Recordset->EOF) {
	$promociones_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $promociones_list->StartRec > 1)
		$promociones_list->Recordset->Move($promociones_list->StartRec - 1);
} elseif (!$promociones->AllowAddDeleteRow && $promociones_list->StopRec == 0) {
	$promociones_list->StopRec = $promociones->GridAddRowCount;
}

// Initialize aggregate
$promociones->RowType = EW_ROWTYPE_AGGREGATEINIT;
$promociones->ResetAttrs();
$promociones_list->RenderRow();
$promociones_list->RowCnt = 0;
while ($promociones_list->RecCnt < $promociones_list->StopRec) {
	$promociones_list->RecCnt++;
	if (intval($promociones_list->RecCnt) >= intval($promociones_list->StartRec)) {
		$promociones_list->RowCnt++;

		// Set up key count
		$promociones_list->KeyCount = $promociones_list->RowIndex;

		// Init row class and style
		$promociones->ResetAttrs();
		$promociones->CssClass = "";
		if ($promociones->CurrentAction == "gridadd") {
		} else {
			$promociones_list->LoadRowValues($promociones_list->Recordset); // Load row values
		}
		$promociones->RowType = EW_ROWTYPE_VIEW; // Render view
		$promociones->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$promociones_list->RenderRow();

		// Render list options
		$promociones_list->RenderListOptions();
?>
	<tr<?php echo $promociones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$promociones_list->ListOptions->Render("body", "left");
?>
	<?php if ($promociones->titulo->Visible) { // titulo ?>
		<td<?php echo $promociones->titulo->CellAttributes() ?>>
<div<?php echo $promociones->titulo->ViewAttributes() ?>><?php echo $promociones->titulo->ListViewValue() ?></div>
<a name="<?php echo $promociones_list->PageObjName . "_row_" . $promociones_list->RowCnt ?>" id="<?php echo $promociones_list->PageObjName . "_row_" . $promociones_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($promociones->imagen->Visible) { // imagen ?>
		<td<?php echo $promociones->imagen->CellAttributes() ?>>
<?php if ($promociones->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($promociones->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $promociones->imagen->UploadPath) . $promociones->imagen->Upload->DbValue ?>" border=0<?php echo $promociones->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($promociones->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($promociones->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $promociones->imagen->UploadPath) . $promociones->imagen->Upload->DbValue ?>" border=0<?php echo $promociones->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($promociones->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($promociones->estatus->Visible) { // estatus ?>
		<td<?php echo $promociones->estatus->CellAttributes() ?>>
<div<?php echo $promociones->estatus->ViewAttributes() ?>><?php echo $promociones->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$promociones_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($promociones->CurrentAction <> "gridadd")
		$promociones_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($promociones_list->Recordset)
	$promociones_list->Recordset->Close();
?>
<?php if ($promociones->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($promociones->CurrentAction <> "gridadd" && $promociones->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($promociones_list->Pager)) $promociones_list->Pager = new cPrevNextPager($promociones_list->StartRec, $promociones_list->DisplayRecs, $promociones_list->TotalRecs) ?>
<?php if ($promociones_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($promociones_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $promociones_list->PageUrl() ?>start=<?php echo $promociones_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($promociones_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $promociones_list->PageUrl() ?>start=<?php echo $promociones_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $promociones_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($promociones_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $promociones_list->PageUrl() ?>start=<?php echo $promociones_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($promociones_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $promociones_list->PageUrl() ?>start=<?php echo $promociones_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $promociones_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $promociones_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $promociones_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $promociones_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($promociones_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $promociones_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($promociones->Export == "" && $promociones->CurrentAction == "") { ?>
<?php } ?>
<?php
$promociones_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($promociones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$promociones_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpromociones_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'promociones';

	// Page object name
	var $PageObjName = 'promociones_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $promociones;
		if ($promociones->UseTokenInUrl) $PageUrl .= "t=" . $promociones->TableVar . "&"; // Add page token
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
		global $objForm, $promociones;
		if ($promociones->UseTokenInUrl) {
			if ($objForm)
				return ($promociones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($promociones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpromociones_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (promociones)
		if (!isset($GLOBALS["promociones"])) {
			$GLOBALS["promociones"] = new cpromociones();
			$GLOBALS["Table"] =& $GLOBALS["promociones"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "promocionesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "promocionesdelete.php";
		$this->MultiUpdateUrl = "promocionesupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'promociones', TRUE);

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
		global $promociones;

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
			$promociones->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $promociones;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($promociones->Export <> "" ||
				$promociones->CurrentAction == "gridadd" ||
				$promociones->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$promociones->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($promociones->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $promociones->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$promociones->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$promociones->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$promociones->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $promociones->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$promociones->setSessionWhere($sFilter);
		$promociones->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $promociones;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $promociones->titulo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $promociones->contenido, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $promociones->imagen, $Keyword);
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
		global $Security, $promociones;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $promociones->BasicSearchKeyword;
		$sSearchType = $promociones->BasicSearchType;
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
			$promociones->setSessionBasicSearchKeyword($sSearchKeyword);
			$promociones->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $promociones;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$promociones->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $promociones;
		$promociones->setSessionBasicSearchKeyword("");
		$promociones->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $promociones;
		$bRestore = TRUE;
		if ($promociones->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$promociones->BasicSearchKeyword = $promociones->getSessionBasicSearchKeyword();
			$promociones->BasicSearchType = $promociones->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $promociones;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$promociones->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$promociones->CurrentOrderType = @$_GET["ordertype"];
			$promociones->UpdateSort($promociones->titulo); // titulo
			$promociones->UpdateSort($promociones->imagen); // imagen
			$promociones->UpdateSort($promociones->estatus); // estatus
			$promociones->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $promociones;
		$sOrderBy = $promociones->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($promociones->SqlOrderBy() <> "") {
				$sOrderBy = $promociones->SqlOrderBy();
				$promociones->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $promociones;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$promociones->setSessionOrderBy($sOrderBy);
				$promociones->titulo->setSort("");
				$promociones->imagen->setSort("");
				$promociones->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$promociones->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $promociones;

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
		global $Security, $Language, $promociones, $objForm;
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
		global $Security, $Language, $promociones;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $promociones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$promociones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$promociones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $promociones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$promociones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$promociones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$promociones->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $promociones;
		$promociones->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$promociones->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $promociones;

		// Call Recordset Selecting event
		$promociones->Recordset_Selecting($promociones->CurrentFilter);

		// Load List page SQL
		$sSql = $promociones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$promociones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $promociones;
		$sFilter = $promociones->KeyFilter();

		// Call Row Selecting event
		$promociones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$promociones->CurrentFilter = $sFilter;
		$sSql = $promociones->SQL();
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
		global $conn, $promociones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$promociones->Row_Selected($row);
		$promociones->id_promociones->setDbValue($rs->fields('id_promociones'));
		$promociones->titulo->setDbValue($rs->fields('titulo'));
		$promociones->contenido->setDbValue($rs->fields('contenido'));
		$promociones->imagen->Upload->DbValue = $rs->fields('imagen');
		$promociones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $promociones;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($promociones->getKey("id_promociones")) <> "")
			$promociones->id_promociones->CurrentValue = $promociones->getKey("id_promociones"); // id_promociones
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$promociones->CurrentFilter = $promociones->KeyFilter();
			$sSql = $promociones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $promociones;

		// Initialize URLs
		$this->ViewUrl = $promociones->ViewUrl();
		$this->EditUrl = $promociones->EditUrl();
		$this->InlineEditUrl = $promociones->InlineEditUrl();
		$this->CopyUrl = $promociones->CopyUrl();
		$this->InlineCopyUrl = $promociones->InlineCopyUrl();
		$this->DeleteUrl = $promociones->DeleteUrl();

		// Call Row_Rendering event
		$promociones->Row_Rendering();

		// Common render codes for all row types
		// id_promociones
		// titulo
		// contenido
		// imagen
		// estatus

		if ($promociones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_promociones
			$promociones->id_promociones->ViewValue = $promociones->id_promociones->CurrentValue;
			$promociones->id_promociones->ViewCustomAttributes = "";

			// titulo
			$promociones->titulo->ViewValue = $promociones->titulo->CurrentValue;
			$promociones->titulo->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($promociones->imagen->Upload->DbValue)) {
				$promociones->imagen->ViewValue = $promociones->imagen->Upload->DbValue;
				$promociones->imagen->ImageWidth = 150;
				$promociones->imagen->ImageHeight = 0;
				$promociones->imagen->ImageAlt = $promociones->imagen->FldAlt();
			} else {
				$promociones->imagen->ViewValue = "";
			}
			$promociones->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($promociones->estatus->CurrentValue) <> "") {
				switch ($promociones->estatus->CurrentValue) {
					case "1":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(1) <> "" ? $promociones->estatus->FldTagCaption(1) : $promociones->estatus->CurrentValue;
						break;
					case "0":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(2) <> "" ? $promociones->estatus->FldTagCaption(2) : $promociones->estatus->CurrentValue;
						break;
					case "3":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(3) <> "" ? $promociones->estatus->FldTagCaption(3) : $promociones->estatus->CurrentValue;
						break;
					case "4":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(4) <> "" ? $promociones->estatus->FldTagCaption(4) : $promociones->estatus->CurrentValue;
						break;
					default:
						$promociones->estatus->ViewValue = $promociones->estatus->CurrentValue;
				}
			} else {
				$promociones->estatus->ViewValue = NULL;
			}
			$promociones->estatus->ViewCustomAttributes = "";

			// titulo
			$promociones->titulo->LinkCustomAttributes = "";
			$promociones->titulo->HrefValue = "";
			$promociones->titulo->TooltipValue = "";

			// imagen
			$promociones->imagen->LinkCustomAttributes = "";
			$promociones->imagen->HrefValue = "";
			$promociones->imagen->TooltipValue = "";

			// estatus
			$promociones->estatus->LinkCustomAttributes = "";
			$promociones->estatus->HrefValue = "";
			$promociones->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($promociones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$promociones->Row_Rendered();
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
