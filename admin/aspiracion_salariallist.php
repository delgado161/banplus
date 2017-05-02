<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "aspiracion_salarialinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$aspiracion_salarial_list = new caspiracion_salarial_list();
$Page =& $aspiracion_salarial_list;

// Page init
$aspiracion_salarial_list->Page_Init();

// Page main
$aspiracion_salarial_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($aspiracion_salarial->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var aspiracion_salarial_list = new ew_Page("aspiracion_salarial_list");

// page properties
aspiracion_salarial_list.PageID = "list"; // page ID
aspiracion_salarial_list.FormID = "faspiracion_salariallist"; // form ID
var EW_PAGE_ID = aspiracion_salarial_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
aspiracion_salarial_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
aspiracion_salarial_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
aspiracion_salarial_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($aspiracion_salarial->Export == "") || (EW_EXPORT_MASTER_RECORD && $aspiracion_salarial->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$aspiracion_salarial_list->TotalRecs = $aspiracion_salarial->SelectRecordCount();
	} else {
		if ($aspiracion_salarial_list->Recordset = $aspiracion_salarial_list->LoadRecordset())
			$aspiracion_salarial_list->TotalRecs = $aspiracion_salarial_list->Recordset->RecordCount();
	}
	$aspiracion_salarial_list->StartRec = 1;
	if ($aspiracion_salarial_list->DisplayRecs <= 0 || ($aspiracion_salarial->Export <> "" && $aspiracion_salarial->ExportAll)) // Display all records
		$aspiracion_salarial_list->DisplayRecs = $aspiracion_salarial_list->TotalRecs;
	if (!($aspiracion_salarial->Export <> "" && $aspiracion_salarial->ExportAll))
		$aspiracion_salarial_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$aspiracion_salarial_list->Recordset = $aspiracion_salarial_list->LoadRecordset($aspiracion_salarial_list->StartRec-1, $aspiracion_salarial_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $aspiracion_salarial->TableCaption() ?>
&nbsp;&nbsp;<?php $aspiracion_salarial_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($aspiracion_salarial->Export == "" && $aspiracion_salarial->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(aspiracion_salarial_list);" style="text-decoration: none;"><img id="aspiracion_salarial_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="aspiracion_salarial_list_SearchPanel">
<form name="faspiracion_salariallistsrch" id="faspiracion_salariallistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="aspiracion_salarial">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($aspiracion_salarial->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $aspiracion_salarial_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($aspiracion_salarial->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($aspiracion_salarial->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($aspiracion_salarial->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $aspiracion_salarial_list->ShowPageHeader(); ?>
<?php
$aspiracion_salarial_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="faspiracion_salariallist" id="faspiracion_salariallist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="aspiracion_salarial">
<div id="gmp_aspiracion_salarial" class="ewGridMiddlePanel">
<?php if ($aspiracion_salarial_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $aspiracion_salarial->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$aspiracion_salarial_list->RenderListOptions();

// Render list options (header, left)
$aspiracion_salarial_list->ListOptions->Render("header", "left");
?>
<?php if ($aspiracion_salarial->valor->Visible) { // valor ?>
	<?php if ($aspiracion_salarial->SortUrl($aspiracion_salarial->valor) == "") { ?>
		<td><?php echo $aspiracion_salarial->valor->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $aspiracion_salarial->SortUrl($aspiracion_salarial->valor) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $aspiracion_salarial->valor->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($aspiracion_salarial->valor->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($aspiracion_salarial->valor->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($aspiracion_salarial->orden->Visible) { // orden ?>
	<?php if ($aspiracion_salarial->SortUrl($aspiracion_salarial->orden) == "") { ?>
		<td><?php echo $aspiracion_salarial->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $aspiracion_salarial->SortUrl($aspiracion_salarial->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $aspiracion_salarial->orden->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($aspiracion_salarial->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($aspiracion_salarial->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$aspiracion_salarial_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($aspiracion_salarial->ExportAll && $aspiracion_salarial->Export <> "") {
	$aspiracion_salarial_list->StopRec = $aspiracion_salarial_list->TotalRecs;
} else {

	// Set the last record to display
	if ($aspiracion_salarial_list->TotalRecs > $aspiracion_salarial_list->StartRec + $aspiracion_salarial_list->DisplayRecs - 1)
		$aspiracion_salarial_list->StopRec = $aspiracion_salarial_list->StartRec + $aspiracion_salarial_list->DisplayRecs - 1;
	else
		$aspiracion_salarial_list->StopRec = $aspiracion_salarial_list->TotalRecs;
}
$aspiracion_salarial_list->RecCnt = $aspiracion_salarial_list->StartRec - 1;
if ($aspiracion_salarial_list->Recordset && !$aspiracion_salarial_list->Recordset->EOF) {
	$aspiracion_salarial_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $aspiracion_salarial_list->StartRec > 1)
		$aspiracion_salarial_list->Recordset->Move($aspiracion_salarial_list->StartRec - 1);
} elseif (!$aspiracion_salarial->AllowAddDeleteRow && $aspiracion_salarial_list->StopRec == 0) {
	$aspiracion_salarial_list->StopRec = $aspiracion_salarial->GridAddRowCount;
}

// Initialize aggregate
$aspiracion_salarial->RowType = EW_ROWTYPE_AGGREGATEINIT;
$aspiracion_salarial->ResetAttrs();
$aspiracion_salarial_list->RenderRow();
$aspiracion_salarial_list->RowCnt = 0;
while ($aspiracion_salarial_list->RecCnt < $aspiracion_salarial_list->StopRec) {
	$aspiracion_salarial_list->RecCnt++;
	if (intval($aspiracion_salarial_list->RecCnt) >= intval($aspiracion_salarial_list->StartRec)) {
		$aspiracion_salarial_list->RowCnt++;

		// Set up key count
		$aspiracion_salarial_list->KeyCount = $aspiracion_salarial_list->RowIndex;

		// Init row class and style
		$aspiracion_salarial->ResetAttrs();
		$aspiracion_salarial->CssClass = "";
		if ($aspiracion_salarial->CurrentAction == "gridadd") {
		} else {
			$aspiracion_salarial_list->LoadRowValues($aspiracion_salarial_list->Recordset); // Load row values
		}
		$aspiracion_salarial->RowType = EW_ROWTYPE_VIEW; // Render view
		$aspiracion_salarial->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$aspiracion_salarial_list->RenderRow();

		// Render list options
		$aspiracion_salarial_list->RenderListOptions();
?>
	<tr<?php echo $aspiracion_salarial->RowAttributes() ?>>
<?php

// Render list options (body, left)
$aspiracion_salarial_list->ListOptions->Render("body", "left");
?>
	<?php if ($aspiracion_salarial->valor->Visible) { // valor ?>
		<td<?php echo $aspiracion_salarial->valor->CellAttributes() ?>>
<div<?php echo $aspiracion_salarial->valor->ViewAttributes() ?>><?php echo $aspiracion_salarial->valor->ListViewValue() ?></div>
<a name="<?php echo $aspiracion_salarial_list->PageObjName . "_row_" . $aspiracion_salarial_list->RowCnt ?>" id="<?php echo $aspiracion_salarial_list->PageObjName . "_row_" . $aspiracion_salarial_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($aspiracion_salarial->orden->Visible) { // orden ?>
		<td<?php echo $aspiracion_salarial->orden->CellAttributes() ?>>
<div<?php echo $aspiracion_salarial->orden->ViewAttributes() ?>><?php echo $aspiracion_salarial->orden->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$aspiracion_salarial_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($aspiracion_salarial->CurrentAction <> "gridadd")
		$aspiracion_salarial_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($aspiracion_salarial_list->Recordset)
	$aspiracion_salarial_list->Recordset->Close();
?>
<?php if ($aspiracion_salarial->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($aspiracion_salarial->CurrentAction <> "gridadd" && $aspiracion_salarial->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($aspiracion_salarial_list->Pager)) $aspiracion_salarial_list->Pager = new cPrevNextPager($aspiracion_salarial_list->StartRec, $aspiracion_salarial_list->DisplayRecs, $aspiracion_salarial_list->TotalRecs) ?>
<?php if ($aspiracion_salarial_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($aspiracion_salarial_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $aspiracion_salarial_list->PageUrl() ?>start=<?php echo $aspiracion_salarial_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($aspiracion_salarial_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $aspiracion_salarial_list->PageUrl() ?>start=<?php echo $aspiracion_salarial_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $aspiracion_salarial_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($aspiracion_salarial_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $aspiracion_salarial_list->PageUrl() ?>start=<?php echo $aspiracion_salarial_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($aspiracion_salarial_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $aspiracion_salarial_list->PageUrl() ?>start=<?php echo $aspiracion_salarial_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $aspiracion_salarial_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $aspiracion_salarial_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $aspiracion_salarial_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $aspiracion_salarial_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($aspiracion_salarial_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $aspiracion_salarial_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($aspiracion_salarial->Export == "" && $aspiracion_salarial->CurrentAction == "") { ?>
<?php } ?>
<?php
$aspiracion_salarial_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($aspiracion_salarial->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$aspiracion_salarial_list->Page_Terminate();
?>
<?php

//
// Page class
//
class caspiracion_salarial_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'aspiracion_salarial';

	// Page object name
	var $PageObjName = 'aspiracion_salarial_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $aspiracion_salarial;
		if ($aspiracion_salarial->UseTokenInUrl) $PageUrl .= "t=" . $aspiracion_salarial->TableVar . "&"; // Add page token
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
		global $objForm, $aspiracion_salarial;
		if ($aspiracion_salarial->UseTokenInUrl) {
			if ($objForm)
				return ($aspiracion_salarial->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($aspiracion_salarial->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caspiracion_salarial_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (aspiracion_salarial)
		if (!isset($GLOBALS["aspiracion_salarial"])) {
			$GLOBALS["aspiracion_salarial"] = new caspiracion_salarial();
			$GLOBALS["Table"] =& $GLOBALS["aspiracion_salarial"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "aspiracion_salarialadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "aspiracion_salarialdelete.php";
		$this->MultiUpdateUrl = "aspiracion_salarialupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'aspiracion_salarial', TRUE);

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
		global $aspiracion_salarial;

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
			$aspiracion_salarial->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $aspiracion_salarial;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($aspiracion_salarial->Export <> "" ||
				$aspiracion_salarial->CurrentAction == "gridadd" ||
				$aspiracion_salarial->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$aspiracion_salarial->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($aspiracion_salarial->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $aspiracion_salarial->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$aspiracion_salarial->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$aspiracion_salarial->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$aspiracion_salarial->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $aspiracion_salarial->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$aspiracion_salarial->setSessionWhere($sFilter);
		$aspiracion_salarial->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $aspiracion_salarial;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $aspiracion_salarial->valor, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $aspiracion_salarial->orden, $Keyword);
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
		global $Security, $aspiracion_salarial;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $aspiracion_salarial->BasicSearchKeyword;
		$sSearchType = $aspiracion_salarial->BasicSearchType;
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
			$aspiracion_salarial->setSessionBasicSearchKeyword($sSearchKeyword);
			$aspiracion_salarial->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $aspiracion_salarial;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$aspiracion_salarial->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $aspiracion_salarial;
		$aspiracion_salarial->setSessionBasicSearchKeyword("");
		$aspiracion_salarial->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $aspiracion_salarial;
		$bRestore = TRUE;
		if ($aspiracion_salarial->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$aspiracion_salarial->BasicSearchKeyword = $aspiracion_salarial->getSessionBasicSearchKeyword();
			$aspiracion_salarial->BasicSearchType = $aspiracion_salarial->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $aspiracion_salarial;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$aspiracion_salarial->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$aspiracion_salarial->CurrentOrderType = @$_GET["ordertype"];
			$aspiracion_salarial->UpdateSort($aspiracion_salarial->valor); // valor
			$aspiracion_salarial->UpdateSort($aspiracion_salarial->orden); // orden
			$aspiracion_salarial->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $aspiracion_salarial;
		$sOrderBy = $aspiracion_salarial->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($aspiracion_salarial->SqlOrderBy() <> "") {
				$sOrderBy = $aspiracion_salarial->SqlOrderBy();
				$aspiracion_salarial->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $aspiracion_salarial;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$aspiracion_salarial->setSessionOrderBy($sOrderBy);
				$aspiracion_salarial->valor->setSort("");
				$aspiracion_salarial->orden->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$aspiracion_salarial->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $aspiracion_salarial;

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
		global $Security, $Language, $aspiracion_salarial, $objForm;
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
		global $Security, $Language, $aspiracion_salarial;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $aspiracion_salarial;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$aspiracion_salarial->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$aspiracion_salarial->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $aspiracion_salarial->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$aspiracion_salarial->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$aspiracion_salarial->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$aspiracion_salarial->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $aspiracion_salarial;
		$aspiracion_salarial->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$aspiracion_salarial->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $aspiracion_salarial;

		// Call Recordset Selecting event
		$aspiracion_salarial->Recordset_Selecting($aspiracion_salarial->CurrentFilter);

		// Load List page SQL
		$sSql = $aspiracion_salarial->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$aspiracion_salarial->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $aspiracion_salarial;
		$sFilter = $aspiracion_salarial->KeyFilter();

		// Call Row Selecting event
		$aspiracion_salarial->Row_Selecting($sFilter);

		// Load SQL based on filter
		$aspiracion_salarial->CurrentFilter = $sFilter;
		$sSql = $aspiracion_salarial->SQL();
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
		global $conn, $aspiracion_salarial;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$aspiracion_salarial->Row_Selected($row);
		$aspiracion_salarial->id_aspiracion_salarial->setDbValue($rs->fields('id_aspiracion_salarial'));
		$aspiracion_salarial->valor->setDbValue($rs->fields('valor'));
		$aspiracion_salarial->orden->setDbValue($rs->fields('orden'));
	}

	// Load old record
	function LoadOldRecord() {
		global $aspiracion_salarial;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($aspiracion_salarial->getKey("id_aspiracion_salarial")) <> "")
			$aspiracion_salarial->id_aspiracion_salarial->CurrentValue = $aspiracion_salarial->getKey("id_aspiracion_salarial"); // id_aspiracion_salarial
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$aspiracion_salarial->CurrentFilter = $aspiracion_salarial->KeyFilter();
			$sSql = $aspiracion_salarial->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $aspiracion_salarial;

		// Initialize URLs
		$this->ViewUrl = $aspiracion_salarial->ViewUrl();
		$this->EditUrl = $aspiracion_salarial->EditUrl();
		$this->InlineEditUrl = $aspiracion_salarial->InlineEditUrl();
		$this->CopyUrl = $aspiracion_salarial->CopyUrl();
		$this->InlineCopyUrl = $aspiracion_salarial->InlineCopyUrl();
		$this->DeleteUrl = $aspiracion_salarial->DeleteUrl();

		// Call Row_Rendering event
		$aspiracion_salarial->Row_Rendering();

		// Common render codes for all row types
		// id_aspiracion_salarial

		$aspiracion_salarial->id_aspiracion_salarial->CellCssStyle = "white-space: nowrap;";

		// valor
		// orden

		if ($aspiracion_salarial->RowType == EW_ROWTYPE_VIEW) { // View row

			// valor
			$aspiracion_salarial->valor->ViewValue = $aspiracion_salarial->valor->CurrentValue;
			$aspiracion_salarial->valor->ViewCustomAttributes = "";

			// orden
			$aspiracion_salarial->orden->ViewValue = $aspiracion_salarial->orden->CurrentValue;
			$aspiracion_salarial->orden->ViewCustomAttributes = "";

			// valor
			$aspiracion_salarial->valor->LinkCustomAttributes = "";
			$aspiracion_salarial->valor->HrefValue = "";
			$aspiracion_salarial->valor->TooltipValue = "";

			// orden
			$aspiracion_salarial->orden->LinkCustomAttributes = "";
			$aspiracion_salarial->orden->HrefValue = "";
			$aspiracion_salarial->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($aspiracion_salarial->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$aspiracion_salarial->Row_Rendered();
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
