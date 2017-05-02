<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "zmenuinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$zmenu_list = new czmenu_list();
$Page =& $zmenu_list;

// Page init
$zmenu_list->Page_Init();

// Page main
$zmenu_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($zmenu->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var zmenu_list = new ew_Page("zmenu_list");

// page properties
zmenu_list.PageID = "list"; // page ID
zmenu_list.FormID = "fzmenulist"; // form ID
var EW_PAGE_ID = zmenu_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
zmenu_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
zmenu_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
zmenu_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($zmenu->Export == "") || (EW_EXPORT_MASTER_RECORD && $zmenu->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$zmenu_list->TotalRecs = $zmenu->SelectRecordCount();
	} else {
		if ($zmenu_list->Recordset = $zmenu_list->LoadRecordset())
			$zmenu_list->TotalRecs = $zmenu_list->Recordset->RecordCount();
	}
	$zmenu_list->StartRec = 1;
	if ($zmenu_list->DisplayRecs <= 0 || ($zmenu->Export <> "" && $zmenu->ExportAll)) // Display all records
		$zmenu_list->DisplayRecs = $zmenu_list->TotalRecs;
	if (!($zmenu->Export <> "" && $zmenu->ExportAll))
		$zmenu_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$zmenu_list->Recordset = $zmenu_list->LoadRecordset($zmenu_list->StartRec-1, $zmenu_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $zmenu->TableCaption() ?>
&nbsp;&nbsp;<?php $zmenu_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($zmenu->Export == "" && $zmenu->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(zmenu_list);" style="text-decoration: none;"><img id="zmenu_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="zmenu_list_SearchPanel">
<form name="fzmenulistsrch" id="fzmenulistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="zmenu">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($zmenu->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $zmenu_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($zmenu->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($zmenu->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($zmenu->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $zmenu_list->ShowPageHeader(); ?>
<?php
$zmenu_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fzmenulist" id="fzmenulist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="zmenu">
<div id="gmp_zmenu" class="ewGridMiddlePanel">
<?php if ($zmenu_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $zmenu->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$zmenu_list->RenderListOptions();

// Render list options (header, left)
$zmenu_list->ListOptions->Render("header", "left");
?>
<?php if ($zmenu->id_grupo_seccion->Visible) { // id_grupo_seccion ?>
	<?php if ($zmenu->SortUrl($zmenu->id_grupo_seccion) == "") { ?>
		<td><?php echo $zmenu->id_grupo_seccion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $zmenu->SortUrl($zmenu->id_grupo_seccion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $zmenu->id_grupo_seccion->FldCaption() ?></td><td style="width: 10px;"><?php if ($zmenu->id_grupo_seccion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($zmenu->id_grupo_seccion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($zmenu->posicion->Visible) { // posicion ?>
	<?php if ($zmenu->SortUrl($zmenu->posicion) == "") { ?>
		<td><?php echo $zmenu->posicion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $zmenu->SortUrl($zmenu->posicion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $zmenu->posicion->FldCaption() ?></td><td style="width: 10px;"><?php if ($zmenu->posicion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($zmenu->posicion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($zmenu->orden->Visible) { // orden ?>
	<?php if ($zmenu->SortUrl($zmenu->orden) == "") { ?>
		<td><?php echo $zmenu->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $zmenu->SortUrl($zmenu->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $zmenu->orden->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($zmenu->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($zmenu->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($zmenu->estatus->Visible) { // estatus ?>
	<?php if ($zmenu->SortUrl($zmenu->estatus) == "") { ?>
		<td><?php echo $zmenu->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $zmenu->SortUrl($zmenu->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $zmenu->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($zmenu->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($zmenu->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$zmenu_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($zmenu->ExportAll && $zmenu->Export <> "") {
	$zmenu_list->StopRec = $zmenu_list->TotalRecs;
} else {

	// Set the last record to display
	if ($zmenu_list->TotalRecs > $zmenu_list->StartRec + $zmenu_list->DisplayRecs - 1)
		$zmenu_list->StopRec = $zmenu_list->StartRec + $zmenu_list->DisplayRecs - 1;
	else
		$zmenu_list->StopRec = $zmenu_list->TotalRecs;
}
$zmenu_list->RecCnt = $zmenu_list->StartRec - 1;
if ($zmenu_list->Recordset && !$zmenu_list->Recordset->EOF) {
	$zmenu_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $zmenu_list->StartRec > 1)
		$zmenu_list->Recordset->Move($zmenu_list->StartRec - 1);
} elseif (!$zmenu->AllowAddDeleteRow && $zmenu_list->StopRec == 0) {
	$zmenu_list->StopRec = $zmenu->GridAddRowCount;
}

// Initialize aggregate
$zmenu->RowType = EW_ROWTYPE_AGGREGATEINIT;
$zmenu->ResetAttrs();
$zmenu_list->RenderRow();
$zmenu_list->RowCnt = 0;
while ($zmenu_list->RecCnt < $zmenu_list->StopRec) {
	$zmenu_list->RecCnt++;
	if (intval($zmenu_list->RecCnt) >= intval($zmenu_list->StartRec)) {
		$zmenu_list->RowCnt++;

		// Set up key count
		$zmenu_list->KeyCount = $zmenu_list->RowIndex;

		// Init row class and style
		$zmenu->ResetAttrs();
		$zmenu->CssClass = "";
		if ($zmenu->CurrentAction == "gridadd") {
		} else {
			$zmenu_list->LoadRowValues($zmenu_list->Recordset); // Load row values
		}
		$zmenu->RowType = EW_ROWTYPE_VIEW; // Render view
		$zmenu->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$zmenu_list->RenderRow();

		// Render list options
		$zmenu_list->RenderListOptions();
?>
	<tr<?php echo $zmenu->RowAttributes() ?>>
<?php

// Render list options (body, left)
$zmenu_list->ListOptions->Render("body", "left");
?>
	<?php if ($zmenu->id_grupo_seccion->Visible) { // id_grupo_seccion ?>
		<td<?php echo $zmenu->id_grupo_seccion->CellAttributes() ?>>
<div<?php echo $zmenu->id_grupo_seccion->ViewAttributes() ?>><?php echo $zmenu->id_grupo_seccion->ListViewValue() ?></div>
<a name="<?php echo $zmenu_list->PageObjName . "_row_" . $zmenu_list->RowCnt ?>" id="<?php echo $zmenu_list->PageObjName . "_row_" . $zmenu_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($zmenu->posicion->Visible) { // posicion ?>
		<td<?php echo $zmenu->posicion->CellAttributes() ?>>
<div<?php echo $zmenu->posicion->ViewAttributes() ?>><?php echo $zmenu->posicion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($zmenu->orden->Visible) { // orden ?>
		<td<?php echo $zmenu->orden->CellAttributes() ?>>
<div<?php echo $zmenu->orden->ViewAttributes() ?>><?php echo $zmenu->orden->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($zmenu->estatus->Visible) { // estatus ?>
		<td<?php echo $zmenu->estatus->CellAttributes() ?>>
<div<?php echo $zmenu->estatus->ViewAttributes() ?>><?php echo $zmenu->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$zmenu_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($zmenu->CurrentAction <> "gridadd")
		$zmenu_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($zmenu_list->Recordset)
	$zmenu_list->Recordset->Close();
?>
<?php if ($zmenu->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($zmenu->CurrentAction <> "gridadd" && $zmenu->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($zmenu_list->Pager)) $zmenu_list->Pager = new cPrevNextPager($zmenu_list->StartRec, $zmenu_list->DisplayRecs, $zmenu_list->TotalRecs) ?>
<?php if ($zmenu_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($zmenu_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $zmenu_list->PageUrl() ?>start=<?php echo $zmenu_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($zmenu_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $zmenu_list->PageUrl() ?>start=<?php echo $zmenu_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $zmenu_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($zmenu_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $zmenu_list->PageUrl() ?>start=<?php echo $zmenu_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($zmenu_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $zmenu_list->PageUrl() ?>start=<?php echo $zmenu_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $zmenu_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $zmenu_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $zmenu_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $zmenu_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($zmenu_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $zmenu_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($zmenu->Export == "" && $zmenu->CurrentAction == "") { ?>
<?php } ?>
<?php
$zmenu_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($zmenu->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$zmenu_list->Page_Terminate();
?>
<?php

//
// Page class
//
class czmenu_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'menu';

	// Page object name
	var $PageObjName = 'zmenu_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $zmenu;
		if ($zmenu->UseTokenInUrl) $PageUrl .= "t=" . $zmenu->TableVar . "&"; // Add page token
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
		global $objForm, $zmenu;
		if ($zmenu->UseTokenInUrl) {
			if ($objForm)
				return ($zmenu->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($zmenu->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function czmenu_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (zmenu)
		if (!isset($GLOBALS["zmenu"])) {
			$GLOBALS["zmenu"] = new czmenu();
			$GLOBALS["Table"] =& $GLOBALS["zmenu"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "zmenuadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "zmenudelete.php";
		$this->MultiUpdateUrl = "zmenuupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'menu', TRUE);

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
		global $zmenu;

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
			$zmenu->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $zmenu;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($zmenu->Export <> "" ||
				$zmenu->CurrentAction == "gridadd" ||
				$zmenu->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$zmenu->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($zmenu->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $zmenu->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$zmenu->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$zmenu->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$zmenu->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $zmenu->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$zmenu->setSessionWhere($sFilter);
		$zmenu->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $zmenu;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $zmenu->posicion, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $zmenu->orden, $Keyword);
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
		global $Security, $zmenu;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $zmenu->BasicSearchKeyword;
		$sSearchType = $zmenu->BasicSearchType;
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
			$zmenu->setSessionBasicSearchKeyword($sSearchKeyword);
			$zmenu->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $zmenu;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$zmenu->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $zmenu;
		$zmenu->setSessionBasicSearchKeyword("");
		$zmenu->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $zmenu;
		$bRestore = TRUE;
		if ($zmenu->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$zmenu->BasicSearchKeyword = $zmenu->getSessionBasicSearchKeyword();
			$zmenu->BasicSearchType = $zmenu->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $zmenu;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$zmenu->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$zmenu->CurrentOrderType = @$_GET["ordertype"];
			$zmenu->UpdateSort($zmenu->id_grupo_seccion); // id_grupo_seccion
			$zmenu->UpdateSort($zmenu->posicion); // posicion
			$zmenu->UpdateSort($zmenu->orden); // orden
			$zmenu->UpdateSort($zmenu->estatus); // estatus
			$zmenu->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $zmenu;
		$sOrderBy = $zmenu->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($zmenu->SqlOrderBy() <> "") {
				$sOrderBy = $zmenu->SqlOrderBy();
				$zmenu->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $zmenu;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$zmenu->setSessionOrderBy($sOrderBy);
				$zmenu->id_grupo_seccion->setSort("");
				$zmenu->posicion->setSort("");
				$zmenu->orden->setSort("");
				$zmenu->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$zmenu->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $zmenu;

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
		global $Security, $Language, $zmenu, $objForm;
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
		global $Security, $Language, $zmenu;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $zmenu;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$zmenu->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$zmenu->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $zmenu->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$zmenu->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$zmenu->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$zmenu->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $zmenu;
		$zmenu->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$zmenu->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $zmenu;

		// Call Recordset Selecting event
		$zmenu->Recordset_Selecting($zmenu->CurrentFilter);

		// Load List page SQL
		$sSql = $zmenu->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$zmenu->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $zmenu;
		$sFilter = $zmenu->KeyFilter();

		// Call Row Selecting event
		$zmenu->Row_Selecting($sFilter);

		// Load SQL based on filter
		$zmenu->CurrentFilter = $sFilter;
		$sSql = $zmenu->SQL();
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
		global $conn, $zmenu;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$zmenu->Row_Selected($row);
		$zmenu->id_menu->setDbValue($rs->fields('id_menu'));
		$zmenu->id_grupo_seccion->setDbValue($rs->fields('id_grupo_seccion'));
		$zmenu->posicion->setDbValue($rs->fields('posicion'));
		$zmenu->orden->setDbValue($rs->fields('orden'));
		$zmenu->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $zmenu;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($zmenu->getKey("id_menu")) <> "")
			$zmenu->id_menu->CurrentValue = $zmenu->getKey("id_menu"); // id_menu
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$zmenu->CurrentFilter = $zmenu->KeyFilter();
			$sSql = $zmenu->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $zmenu;

		// Initialize URLs
		$this->ViewUrl = $zmenu->ViewUrl();
		$this->EditUrl = $zmenu->EditUrl();
		$this->InlineEditUrl = $zmenu->InlineEditUrl();
		$this->CopyUrl = $zmenu->CopyUrl();
		$this->InlineCopyUrl = $zmenu->InlineCopyUrl();
		$this->DeleteUrl = $zmenu->DeleteUrl();

		// Call Row_Rendering event
		$zmenu->Row_Rendering();

		// Common render codes for all row types
		// id_menu

		$zmenu->id_menu->CellCssStyle = "white-space: nowrap;";

		// id_grupo_seccion
		// posicion
		// orden
		// estatus

		if ($zmenu->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_grupo_seccion
			if (strval($zmenu->id_grupo_seccion->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($zmenu->id_grupo_seccion->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$zmenu->id_grupo_seccion->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$zmenu->id_grupo_seccion->ViewValue = $zmenu->id_grupo_seccion->CurrentValue;
				}
			} else {
				$zmenu->id_grupo_seccion->ViewValue = NULL;
			}
			$zmenu->id_grupo_seccion->ViewCustomAttributes = "";

			// posicion
			if (strval($zmenu->posicion->CurrentValue) <> "") {
				switch ($zmenu->posicion->CurrentValue) {
					case "1":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(1) <> "" ? $zmenu->posicion->FldTagCaption(1) : $zmenu->posicion->CurrentValue;
						break;
					case "2":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(2) <> "" ? $zmenu->posicion->FldTagCaption(2) : $zmenu->posicion->CurrentValue;
						break;
					case "3":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(3) <> "" ? $zmenu->posicion->FldTagCaption(3) : $zmenu->posicion->CurrentValue;
						break;
					case "4":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(4) <> "" ? $zmenu->posicion->FldTagCaption(4) : $zmenu->posicion->CurrentValue;
						break;
					default:
						$zmenu->posicion->ViewValue = $zmenu->posicion->CurrentValue;
				}
			} else {
				$zmenu->posicion->ViewValue = NULL;
			}
			$zmenu->posicion->ViewCustomAttributes = "";

			// orden
			$zmenu->orden->ViewValue = $zmenu->orden->CurrentValue;
			$zmenu->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($zmenu->estatus->CurrentValue) <> "") {
				switch ($zmenu->estatus->CurrentValue) {
					case "1":
						$zmenu->estatus->ViewValue = $zmenu->estatus->FldTagCaption(1) <> "" ? $zmenu->estatus->FldTagCaption(1) : $zmenu->estatus->CurrentValue;
						break;
					case "0":
						$zmenu->estatus->ViewValue = $zmenu->estatus->FldTagCaption(2) <> "" ? $zmenu->estatus->FldTagCaption(2) : $zmenu->estatus->CurrentValue;
						break;
					default:
						$zmenu->estatus->ViewValue = $zmenu->estatus->CurrentValue;
				}
			} else {
				$zmenu->estatus->ViewValue = NULL;
			}
			$zmenu->estatus->ViewCustomAttributes = "";

			// id_grupo_seccion
			$zmenu->id_grupo_seccion->LinkCustomAttributes = "";
			$zmenu->id_grupo_seccion->HrefValue = "";
			$zmenu->id_grupo_seccion->TooltipValue = "";

			// posicion
			$zmenu->posicion->LinkCustomAttributes = "";
			$zmenu->posicion->HrefValue = "";
			$zmenu->posicion->TooltipValue = "";

			// orden
			$zmenu->orden->LinkCustomAttributes = "";
			$zmenu->orden->HrefValue = "";
			$zmenu->orden->TooltipValue = "";

			// estatus
			$zmenu->estatus->LinkCustomAttributes = "";
			$zmenu->estatus->HrefValue = "";
			$zmenu->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($zmenu->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$zmenu->Row_Rendered();
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
		$table = 'menu';
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
