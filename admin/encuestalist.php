<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "encuestainfo.php" ?>
<?php include_once "preguntasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$encuesta_list = new cencuesta_list();
$Page =& $encuesta_list;

// Page init
$encuesta_list->Page_Init();

// Page main
$encuesta_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($encuesta->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var encuesta_list = new ew_Page("encuesta_list");

// page properties
encuesta_list.PageID = "list"; // page ID
encuesta_list.FormID = "fencuestalist"; // form ID
var EW_PAGE_ID = encuesta_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
encuesta_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
encuesta_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
encuesta_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($encuesta->Export == "") || (EW_EXPORT_MASTER_RECORD && $encuesta->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$encuesta_list->TotalRecs = $encuesta->SelectRecordCount();
	} else {
		if ($encuesta_list->Recordset = $encuesta_list->LoadRecordset())
			$encuesta_list->TotalRecs = $encuesta_list->Recordset->RecordCount();
	}
	$encuesta_list->StartRec = 1;
	if ($encuesta_list->DisplayRecs <= 0 || ($encuesta->Export <> "" && $encuesta->ExportAll)) // Display all records
		$encuesta_list->DisplayRecs = $encuesta_list->TotalRecs;
	if (!($encuesta->Export <> "" && $encuesta->ExportAll))
		$encuesta_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$encuesta_list->Recordset = $encuesta_list->LoadRecordset($encuesta_list->StartRec-1, $encuesta_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $encuesta->TableCaption() ?>
&nbsp;&nbsp;<?php $encuesta_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($encuesta->Export == "" && $encuesta->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(encuesta_list);" style="text-decoration: none;"><img id="encuesta_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="encuesta_list_SearchPanel">
<form name="fencuestalistsrch" id="fencuestalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="encuesta">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($encuesta->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $encuesta_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($encuesta->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($encuesta->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($encuesta->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $encuesta_list->ShowPageHeader(); ?>
<?php
$encuesta_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fencuestalist" id="fencuestalist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="encuesta">
<div id="gmp_encuesta" class="ewGridMiddlePanel">
<?php if ($encuesta_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $encuesta->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$encuesta_list->RenderListOptions();

// Render list options (header, left)
$encuesta_list->ListOptions->Render("header", "left");
?>
<?php if ($encuesta->nombre->Visible) { // nombre ?>
	<?php if ($encuesta->SortUrl($encuesta->nombre) == "") { ?>
		<td><?php echo $encuesta->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $encuesta->SortUrl($encuesta->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $encuesta->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($encuesta->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($encuesta->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($encuesta->id_grupo->Visible) { // id_grupo ?>
	<?php if ($encuesta->SortUrl($encuesta->id_grupo) == "") { ?>
		<td><?php echo $encuesta->id_grupo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $encuesta->SortUrl($encuesta->id_grupo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $encuesta->id_grupo->FldCaption() ?></td><td style="width: 10px;"><?php if ($encuesta->id_grupo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($encuesta->id_grupo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($encuesta->estatus->Visible) { // estatus ?>
	<?php if ($encuesta->SortUrl($encuesta->estatus) == "") { ?>
		<td><?php echo $encuesta->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $encuesta->SortUrl($encuesta->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $encuesta->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($encuesta->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($encuesta->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$encuesta_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($encuesta->ExportAll && $encuesta->Export <> "") {
	$encuesta_list->StopRec = $encuesta_list->TotalRecs;
} else {

	// Set the last record to display
	if ($encuesta_list->TotalRecs > $encuesta_list->StartRec + $encuesta_list->DisplayRecs - 1)
		$encuesta_list->StopRec = $encuesta_list->StartRec + $encuesta_list->DisplayRecs - 1;
	else
		$encuesta_list->StopRec = $encuesta_list->TotalRecs;
}
$encuesta_list->RecCnt = $encuesta_list->StartRec - 1;
if ($encuesta_list->Recordset && !$encuesta_list->Recordset->EOF) {
	$encuesta_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $encuesta_list->StartRec > 1)
		$encuesta_list->Recordset->Move($encuesta_list->StartRec - 1);
} elseif (!$encuesta->AllowAddDeleteRow && $encuesta_list->StopRec == 0) {
	$encuesta_list->StopRec = $encuesta->GridAddRowCount;
}

// Initialize aggregate
$encuesta->RowType = EW_ROWTYPE_AGGREGATEINIT;
$encuesta->ResetAttrs();
$encuesta_list->RenderRow();
$encuesta_list->RowCnt = 0;
while ($encuesta_list->RecCnt < $encuesta_list->StopRec) {
	$encuesta_list->RecCnt++;
	if (intval($encuesta_list->RecCnt) >= intval($encuesta_list->StartRec)) {
		$encuesta_list->RowCnt++;

		// Set up key count
		$encuesta_list->KeyCount = $encuesta_list->RowIndex;

		// Init row class and style
		$encuesta->ResetAttrs();
		$encuesta->CssClass = "";
		if ($encuesta->CurrentAction == "gridadd") {
		} else {
			$encuesta_list->LoadRowValues($encuesta_list->Recordset); // Load row values
		}
		$encuesta->RowType = EW_ROWTYPE_VIEW; // Render view
		$encuesta->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$encuesta_list->RenderRow();

		// Render list options
		$encuesta_list->RenderListOptions();
?>
	<tr<?php echo $encuesta->RowAttributes() ?>>
<?php

// Render list options (body, left)
$encuesta_list->ListOptions->Render("body", "left");
?>
	<?php if ($encuesta->nombre->Visible) { // nombre ?>
		<td<?php echo $encuesta->nombre->CellAttributes() ?>>
<div<?php echo $encuesta->nombre->ViewAttributes() ?>><?php echo $encuesta->nombre->ListViewValue() ?></div>
<a name="<?php echo $encuesta_list->PageObjName . "_row_" . $encuesta_list->RowCnt ?>" id="<?php echo $encuesta_list->PageObjName . "_row_" . $encuesta_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($encuesta->id_grupo->Visible) { // id_grupo ?>
		<td<?php echo $encuesta->id_grupo->CellAttributes() ?>>
<div<?php echo $encuesta->id_grupo->ViewAttributes() ?>><?php echo $encuesta->id_grupo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($encuesta->estatus->Visible) { // estatus ?>
		<td<?php echo $encuesta->estatus->CellAttributes() ?>>
<div<?php echo $encuesta->estatus->ViewAttributes() ?>><?php echo $encuesta->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$encuesta_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($encuesta->CurrentAction <> "gridadd")
		$encuesta_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($encuesta_list->Recordset)
	$encuesta_list->Recordset->Close();
?>
<?php if ($encuesta->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($encuesta->CurrentAction <> "gridadd" && $encuesta->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($encuesta_list->Pager)) $encuesta_list->Pager = new cPrevNextPager($encuesta_list->StartRec, $encuesta_list->DisplayRecs, $encuesta_list->TotalRecs) ?>
<?php if ($encuesta_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($encuesta_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $encuesta_list->PageUrl() ?>start=<?php echo $encuesta_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($encuesta_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $encuesta_list->PageUrl() ?>start=<?php echo $encuesta_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $encuesta_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($encuesta_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $encuesta_list->PageUrl() ?>start=<?php echo $encuesta_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($encuesta_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $encuesta_list->PageUrl() ?>start=<?php echo $encuesta_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $encuesta_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $encuesta_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $encuesta_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $encuesta_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($encuesta_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $encuesta_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($preguntas->DetailAdd && $Security->AllowAdd('preguntas')) { ?>
<a class="ewGridLink" href="<?php echo $encuesta->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=preguntas" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $encuesta->TableCaption() ?>/<?php echo $preguntas->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($encuesta->Export == "" && $encuesta->CurrentAction == "") { ?>
<?php } ?>
<?php
$encuesta_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($encuesta->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$encuesta_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cencuesta_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'encuesta';

	// Page object name
	var $PageObjName = 'encuesta_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $encuesta;
		if ($encuesta->UseTokenInUrl) $PageUrl .= "t=" . $encuesta->TableVar . "&"; // Add page token
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
		global $objForm, $encuesta;
		if ($encuesta->UseTokenInUrl) {
			if ($objForm)
				return ($encuesta->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($encuesta->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cencuesta_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (encuesta)
		if (!isset($GLOBALS["encuesta"])) {
			$GLOBALS["encuesta"] = new cencuesta();
			$GLOBALS["Table"] =& $GLOBALS["encuesta"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "encuestaadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "encuestadelete.php";
		$this->MultiUpdateUrl = "encuestaupdate.php";

		// Table object (preguntas)
		if (!isset($GLOBALS['preguntas'])) $GLOBALS['preguntas'] = new cpreguntas();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'encuesta', TRUE);

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
		global $encuesta;

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
			$encuesta->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $encuesta;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($encuesta->Export <> "" ||
				$encuesta->CurrentAction == "gridadd" ||
				$encuesta->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$encuesta->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($encuesta->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $encuesta->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$encuesta->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$encuesta->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$encuesta->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $encuesta->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$encuesta->setSessionWhere($sFilter);
		$encuesta->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $encuesta;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $encuesta->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $encuesta->id_grupo, $Keyword);
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
		global $Security, $encuesta;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $encuesta->BasicSearchKeyword;
		$sSearchType = $encuesta->BasicSearchType;
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
			$encuesta->setSessionBasicSearchKeyword($sSearchKeyword);
			$encuesta->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $encuesta;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$encuesta->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $encuesta;
		$encuesta->setSessionBasicSearchKeyword("");
		$encuesta->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $encuesta;
		$bRestore = TRUE;
		if ($encuesta->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$encuesta->BasicSearchKeyword = $encuesta->getSessionBasicSearchKeyword();
			$encuesta->BasicSearchType = $encuesta->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $encuesta;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$encuesta->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$encuesta->CurrentOrderType = @$_GET["ordertype"];
			$encuesta->UpdateSort($encuesta->nombre); // nombre
			$encuesta->UpdateSort($encuesta->id_grupo); // id_grupo
			$encuesta->UpdateSort($encuesta->estatus); // estatus
			$encuesta->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $encuesta;
		$sOrderBy = $encuesta->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($encuesta->SqlOrderBy() <> "") {
				$sOrderBy = $encuesta->SqlOrderBy();
				$encuesta->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $encuesta;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$encuesta->setSessionOrderBy($sOrderBy);
				$encuesta->nombre->setSort("");
				$encuesta->id_grupo->setSort("");
				$encuesta->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$encuesta->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $encuesta;

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

		// "detail_preguntas"
		$item =& $this->ListOptions->Add("detail_preguntas");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('preguntas');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $encuesta, $objForm;
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

		// "detail_preguntas"
		$oListOpt =& $this->ListOptions->Items["detail_preguntas"];
		if ($Security->AllowList('preguntas')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("preguntas", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"preguntaslist.php?" . EW_TABLE_SHOW_MASTER . "=encuesta&id_encuesta=" . urlencode(strval($encuesta->id_encuesta->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["preguntas"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit('preguntas'))
				$links .= "<a class=\"ewRowLink\" href=\"" . $encuesta->EditUrl(EW_TABLE_SHOW_DETAIL . "=preguntas") . "\">" . $Language->Phrase("EditLink") . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $encuesta;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $encuesta;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$encuesta->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$encuesta->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $encuesta->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$encuesta->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$encuesta->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$encuesta->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $encuesta;
		$encuesta->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$encuesta->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $encuesta;

		// Call Recordset Selecting event
		$encuesta->Recordset_Selecting($encuesta->CurrentFilter);

		// Load List page SQL
		$sSql = $encuesta->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$encuesta->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $encuesta;
		$sFilter = $encuesta->KeyFilter();

		// Call Row Selecting event
		$encuesta->Row_Selecting($sFilter);

		// Load SQL based on filter
		$encuesta->CurrentFilter = $sFilter;
		$sSql = $encuesta->SQL();
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
		global $conn, $encuesta;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$encuesta->Row_Selected($row);
		$encuesta->id_encuesta->setDbValue($rs->fields('id_encuesta'));
		$encuesta->nombre->setDbValue($rs->fields('nombre'));
		$encuesta->id_grupo->setDbValue($rs->fields('id_grupo'));
		$encuesta->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $encuesta;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($encuesta->getKey("id_encuesta")) <> "")
			$encuesta->id_encuesta->CurrentValue = $encuesta->getKey("id_encuesta"); // id_encuesta
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$encuesta->CurrentFilter = $encuesta->KeyFilter();
			$sSql = $encuesta->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $encuesta;

		// Initialize URLs
		$this->ViewUrl = $encuesta->ViewUrl();
		$this->EditUrl = $encuesta->EditUrl();
		$this->InlineEditUrl = $encuesta->InlineEditUrl();
		$this->CopyUrl = $encuesta->CopyUrl();
		$this->InlineCopyUrl = $encuesta->InlineCopyUrl();
		$this->DeleteUrl = $encuesta->DeleteUrl();

		// Call Row_Rendering event
		$encuesta->Row_Rendering();

		// Common render codes for all row types
		// id_encuesta
		// nombre
		// id_grupo
		// estatus

		if ($encuesta->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$encuesta->nombre->ViewValue = $encuesta->nombre->CurrentValue;
			$encuesta->nombre->ViewCustomAttributes = "";

			// id_grupo
			if (strval($encuesta->id_grupo->CurrentValue) <> "") {
				$arwrk = explode(",", $encuesta->id_grupo->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_grupo` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is NULL";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$encuesta->id_grupo->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$encuesta->id_grupo->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $encuesta->id_grupo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$encuesta->id_grupo->ViewValue = $encuesta->id_grupo->CurrentValue;
				}
			} else {
				$encuesta->id_grupo->ViewValue = NULL;
			}
			$encuesta->id_grupo->ViewCustomAttributes = "";

			// estatus
			if (strval($encuesta->estatus->CurrentValue) <> "") {
				switch ($encuesta->estatus->CurrentValue) {
					case "1":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(1) <> "" ? $encuesta->estatus->FldTagCaption(1) : $encuesta->estatus->CurrentValue;
						break;
					case "0":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(2) <> "" ? $encuesta->estatus->FldTagCaption(2) : $encuesta->estatus->CurrentValue;
						break;
					default:
						$encuesta->estatus->ViewValue = $encuesta->estatus->CurrentValue;
				}
			} else {
				$encuesta->estatus->ViewValue = NULL;
			}
			$encuesta->estatus->ViewCustomAttributes = "";

			// nombre
			$encuesta->nombre->LinkCustomAttributes = "";
			$encuesta->nombre->HrefValue = "";
			$encuesta->nombre->TooltipValue = "";

			// id_grupo
			$encuesta->id_grupo->LinkCustomAttributes = "";
			$encuesta->id_grupo->HrefValue = "";
			$encuesta->id_grupo->TooltipValue = "";

			// estatus
			$encuesta->estatus->LinkCustomAttributes = "";
			$encuesta->estatus->HrefValue = "";
			$encuesta->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($encuesta->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$encuesta->Row_Rendered();
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
		$table = 'encuesta';
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
