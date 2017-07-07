<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "actividad_economicainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$actividad_economica_list = new cactividad_economica_list();
$Page =& $actividad_economica_list;

// Page init
$actividad_economica_list->Page_Init();

// Page main
$actividad_economica_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($actividad_economica->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var actividad_economica_list = new ew_Page("actividad_economica_list");

// page properties
actividad_economica_list.PageID = "list"; // page ID
actividad_economica_list.FormID = "factividad_economicalist"; // form ID
var EW_PAGE_ID = actividad_economica_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
actividad_economica_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
actividad_economica_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
actividad_economica_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($actividad_economica->Export == "") || (EW_EXPORT_MASTER_RECORD && $actividad_economica->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$actividad_economica_list->TotalRecs = $actividad_economica->SelectRecordCount();
	} else {
		if ($actividad_economica_list->Recordset = $actividad_economica_list->LoadRecordset())
			$actividad_economica_list->TotalRecs = $actividad_economica_list->Recordset->RecordCount();
	}
	$actividad_economica_list->StartRec = 1;
	if ($actividad_economica_list->DisplayRecs <= 0 || ($actividad_economica->Export <> "" && $actividad_economica->ExportAll)) // Display all records
		$actividad_economica_list->DisplayRecs = $actividad_economica_list->TotalRecs;
	if (!($actividad_economica->Export <> "" && $actividad_economica->ExportAll))
		$actividad_economica_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$actividad_economica_list->Recordset = $actividad_economica_list->LoadRecordset($actividad_economica_list->StartRec-1, $actividad_economica_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $actividad_economica->TableCaption() ?>
&nbsp;&nbsp;<?php $actividad_economica_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($actividad_economica->Export == "" && $actividad_economica->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(actividad_economica_list);" style="text-decoration: none;"><img id="actividad_economica_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="actividad_economica_list_SearchPanel">
<form name="factividad_economicalistsrch" id="factividad_economicalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="actividad_economica">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($actividad_economica->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $actividad_economica_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($actividad_economica->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($actividad_economica->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($actividad_economica->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $actividad_economica_list->ShowPageHeader(); ?>
<?php
$actividad_economica_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="factividad_economicalist" id="factividad_economicalist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="actividad_economica">
<div id="gmp_actividad_economica" class="ewGridMiddlePanel">
<?php if ($actividad_economica_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $actividad_economica->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$actividad_economica_list->RenderListOptions();

// Render list options (header, left)
$actividad_economica_list->ListOptions->Render("header", "left");
?>
<?php if ($actividad_economica->id_acteconomica->Visible) { // id_acteconomica ?>
	<?php if ($actividad_economica->SortUrl($actividad_economica->id_acteconomica) == "") { ?>
		<td><?php echo $actividad_economica->id_acteconomica->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $actividad_economica->SortUrl($actividad_economica->id_acteconomica) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $actividad_economica->id_acteconomica->FldCaption() ?></td><td style="width: 10px;"><?php if ($actividad_economica->id_acteconomica->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($actividad_economica->id_acteconomica->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($actividad_economica->actividad->Visible) { // actividad ?>
	<?php if ($actividad_economica->SortUrl($actividad_economica->actividad) == "") { ?>
		<td><?php echo $actividad_economica->actividad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $actividad_economica->SortUrl($actividad_economica->actividad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $actividad_economica->actividad->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($actividad_economica->actividad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($actividad_economica->actividad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($actividad_economica->visibilidad->Visible) { // visibilidad ?>
	<?php if ($actividad_economica->SortUrl($actividad_economica->visibilidad) == "") { ?>
		<td><?php echo $actividad_economica->visibilidad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $actividad_economica->SortUrl($actividad_economica->visibilidad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $actividad_economica->visibilidad->FldCaption() ?></td><td style="width: 10px;"><?php if ($actividad_economica->visibilidad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($actividad_economica->visibilidad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$actividad_economica_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($actividad_economica->ExportAll && $actividad_economica->Export <> "") {
	$actividad_economica_list->StopRec = $actividad_economica_list->TotalRecs;
} else {

	// Set the last record to display
	if ($actividad_economica_list->TotalRecs > $actividad_economica_list->StartRec + $actividad_economica_list->DisplayRecs - 1)
		$actividad_economica_list->StopRec = $actividad_economica_list->StartRec + $actividad_economica_list->DisplayRecs - 1;
	else
		$actividad_economica_list->StopRec = $actividad_economica_list->TotalRecs;
}
$actividad_economica_list->RecCnt = $actividad_economica_list->StartRec - 1;
if ($actividad_economica_list->Recordset && !$actividad_economica_list->Recordset->EOF) {
	$actividad_economica_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $actividad_economica_list->StartRec > 1)
		$actividad_economica_list->Recordset->Move($actividad_economica_list->StartRec - 1);
} elseif (!$actividad_economica->AllowAddDeleteRow && $actividad_economica_list->StopRec == 0) {
	$actividad_economica_list->StopRec = $actividad_economica->GridAddRowCount;
}

// Initialize aggregate
$actividad_economica->RowType = EW_ROWTYPE_AGGREGATEINIT;
$actividad_economica->ResetAttrs();
$actividad_economica_list->RenderRow();
$actividad_economica_list->RowCnt = 0;
while ($actividad_economica_list->RecCnt < $actividad_economica_list->StopRec) {
	$actividad_economica_list->RecCnt++;
	if (intval($actividad_economica_list->RecCnt) >= intval($actividad_economica_list->StartRec)) {
		$actividad_economica_list->RowCnt++;

		// Set up key count
		$actividad_economica_list->KeyCount = $actividad_economica_list->RowIndex;

		// Init row class and style
		$actividad_economica->ResetAttrs();
		$actividad_economica->CssClass = "";
		if ($actividad_economica->CurrentAction == "gridadd") {
		} else {
			$actividad_economica_list->LoadRowValues($actividad_economica_list->Recordset); // Load row values
		}
		$actividad_economica->RowType = EW_ROWTYPE_VIEW; // Render view
		$actividad_economica->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$actividad_economica_list->RenderRow();

		// Render list options
		$actividad_economica_list->RenderListOptions();
?>
	<tr<?php echo $actividad_economica->RowAttributes() ?>>
<?php

// Render list options (body, left)
$actividad_economica_list->ListOptions->Render("body", "left");
?>
	<?php if ($actividad_economica->id_acteconomica->Visible) { // id_acteconomica ?>
		<td<?php echo $actividad_economica->id_acteconomica->CellAttributes() ?>>
<div<?php echo $actividad_economica->id_acteconomica->ViewAttributes() ?>><?php echo $actividad_economica->id_acteconomica->ListViewValue() ?></div>
<a name="<?php echo $actividad_economica_list->PageObjName . "_row_" . $actividad_economica_list->RowCnt ?>" id="<?php echo $actividad_economica_list->PageObjName . "_row_" . $actividad_economica_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($actividad_economica->actividad->Visible) { // actividad ?>
		<td<?php echo $actividad_economica->actividad->CellAttributes() ?>>
<div<?php echo $actividad_economica->actividad->ViewAttributes() ?>><?php echo $actividad_economica->actividad->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($actividad_economica->visibilidad->Visible) { // visibilidad ?>
		<td<?php echo $actividad_economica->visibilidad->CellAttributes() ?>>
<div<?php echo $actividad_economica->visibilidad->ViewAttributes() ?>><?php echo $actividad_economica->visibilidad->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$actividad_economica_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($actividad_economica->CurrentAction <> "gridadd")
		$actividad_economica_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($actividad_economica_list->Recordset)
	$actividad_economica_list->Recordset->Close();
?>
<?php if ($actividad_economica->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($actividad_economica->CurrentAction <> "gridadd" && $actividad_economica->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($actividad_economica_list->Pager)) $actividad_economica_list->Pager = new cPrevNextPager($actividad_economica_list->StartRec, $actividad_economica_list->DisplayRecs, $actividad_economica_list->TotalRecs) ?>
<?php if ($actividad_economica_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($actividad_economica_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $actividad_economica_list->PageUrl() ?>start=<?php echo $actividad_economica_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($actividad_economica_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $actividad_economica_list->PageUrl() ?>start=<?php echo $actividad_economica_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $actividad_economica_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($actividad_economica_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $actividad_economica_list->PageUrl() ?>start=<?php echo $actividad_economica_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($actividad_economica_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $actividad_economica_list->PageUrl() ?>start=<?php echo $actividad_economica_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $actividad_economica_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $actividad_economica_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $actividad_economica_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $actividad_economica_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($actividad_economica_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $actividad_economica_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($actividad_economica->Export == "" && $actividad_economica->CurrentAction == "") { ?>
<?php } ?>
<?php
$actividad_economica_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($actividad_economica->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$actividad_economica_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cactividad_economica_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'actividad_economica';

	// Page object name
	var $PageObjName = 'actividad_economica_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $actividad_economica;
		if ($actividad_economica->UseTokenInUrl) $PageUrl .= "t=" . $actividad_economica->TableVar . "&"; // Add page token
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
		global $objForm, $actividad_economica;
		if ($actividad_economica->UseTokenInUrl) {
			if ($objForm)
				return ($actividad_economica->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($actividad_economica->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cactividad_economica_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (actividad_economica)
		if (!isset($GLOBALS["actividad_economica"])) {
			$GLOBALS["actividad_economica"] = new cactividad_economica();
			$GLOBALS["Table"] =& $GLOBALS["actividad_economica"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "actividad_economicaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "actividad_economicadelete.php";
		$this->MultiUpdateUrl = "actividad_economicaupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'actividad_economica', TRUE);

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
		global $actividad_economica;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$actividad_economica->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $actividad_economica;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($actividad_economica->Export <> "" ||
				$actividad_economica->CurrentAction == "gridadd" ||
				$actividad_economica->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$actividad_economica->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($actividad_economica->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $actividad_economica->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$actividad_economica->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$actividad_economica->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$actividad_economica->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $actividad_economica->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$actividad_economica->setSessionWhere($sFilter);
		$actividad_economica->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $actividad_economica;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $actividad_economica->actividad, $Keyword);
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
		global $Security, $actividad_economica;
		$sSearchStr = "";
		$sSearchKeyword = $actividad_economica->BasicSearchKeyword;
		$sSearchType = $actividad_economica->BasicSearchType;
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
			$actividad_economica->setSessionBasicSearchKeyword($sSearchKeyword);
			$actividad_economica->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $actividad_economica;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$actividad_economica->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $actividad_economica;
		$actividad_economica->setSessionBasicSearchKeyword("");
		$actividad_economica->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $actividad_economica;
		$bRestore = TRUE;
		if ($actividad_economica->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$actividad_economica->BasicSearchKeyword = $actividad_economica->getSessionBasicSearchKeyword();
			$actividad_economica->BasicSearchType = $actividad_economica->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $actividad_economica;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$actividad_economica->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$actividad_economica->CurrentOrderType = @$_GET["ordertype"];
			$actividad_economica->UpdateSort($actividad_economica->id_acteconomica); // id_acteconomica
			$actividad_economica->UpdateSort($actividad_economica->actividad); // actividad
			$actividad_economica->UpdateSort($actividad_economica->visibilidad); // visibilidad
			$actividad_economica->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $actividad_economica;
		$sOrderBy = $actividad_economica->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($actividad_economica->SqlOrderBy() <> "") {
				$sOrderBy = $actividad_economica->SqlOrderBy();
				$actividad_economica->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $actividad_economica;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$actividad_economica->setSessionOrderBy($sOrderBy);
				$actividad_economica->id_acteconomica->setSort("");
				$actividad_economica->actividad->setSort("");
				$actividad_economica->visibilidad->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$actividad_economica->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $actividad_economica;

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
		global $Security, $Language, $actividad_economica, $objForm;
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
		global $Security, $Language, $actividad_economica;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $actividad_economica;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$actividad_economica->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$actividad_economica->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $actividad_economica->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$actividad_economica->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$actividad_economica->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$actividad_economica->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $actividad_economica;
		$actividad_economica->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$actividad_economica->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $actividad_economica;

		// Call Recordset Selecting event
		$actividad_economica->Recordset_Selecting($actividad_economica->CurrentFilter);

		// Load List page SQL
		$sSql = $actividad_economica->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$actividad_economica->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $actividad_economica;
		$sFilter = $actividad_economica->KeyFilter();

		// Call Row Selecting event
		$actividad_economica->Row_Selecting($sFilter);

		// Load SQL based on filter
		$actividad_economica->CurrentFilter = $sFilter;
		$sSql = $actividad_economica->SQL();
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
		global $conn, $actividad_economica;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$actividad_economica->Row_Selected($row);
		$actividad_economica->id_acteconomica->setDbValue($rs->fields('id_acteconomica'));
		$actividad_economica->actividad->setDbValue($rs->fields('actividad'));
		$actividad_economica->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Load old record
	function LoadOldRecord() {
		global $actividad_economica;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($actividad_economica->getKey("id_acteconomica")) <> "")
			$actividad_economica->id_acteconomica->CurrentValue = $actividad_economica->getKey("id_acteconomica"); // id_acteconomica
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$actividad_economica->CurrentFilter = $actividad_economica->KeyFilter();
			$sSql = $actividad_economica->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $actividad_economica;

		// Initialize URLs
		$this->ViewUrl = $actividad_economica->ViewUrl();
		$this->EditUrl = $actividad_economica->EditUrl();
		$this->InlineEditUrl = $actividad_economica->InlineEditUrl();
		$this->CopyUrl = $actividad_economica->CopyUrl();
		$this->InlineCopyUrl = $actividad_economica->InlineCopyUrl();
		$this->DeleteUrl = $actividad_economica->DeleteUrl();

		// Call Row_Rendering event
		$actividad_economica->Row_Rendering();

		// Common render codes for all row types
		// id_acteconomica
		// actividad
		// visibilidad

		if ($actividad_economica->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_acteconomica
			$actividad_economica->id_acteconomica->ViewValue = $actividad_economica->id_acteconomica->CurrentValue;
			$actividad_economica->id_acteconomica->ViewCustomAttributes = "";

			// actividad
			$actividad_economica->actividad->ViewValue = $actividad_economica->actividad->CurrentValue;
			$actividad_economica->actividad->ViewCustomAttributes = "";

			// visibilidad
			if (strval($actividad_economica->visibilidad->CurrentValue) <> "") {
				switch ($actividad_economica->visibilidad->CurrentValue) {
					case "1":
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->FldTagCaption(1) <> "" ? $actividad_economica->visibilidad->FldTagCaption(1) : $actividad_economica->visibilidad->CurrentValue;
						break;
					case "0":
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->FldTagCaption(2) <> "" ? $actividad_economica->visibilidad->FldTagCaption(2) : $actividad_economica->visibilidad->CurrentValue;
						break;
					default:
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->CurrentValue;
				}
			} else {
				$actividad_economica->visibilidad->ViewValue = NULL;
			}
			$actividad_economica->visibilidad->ViewCustomAttributes = "";

			// id_acteconomica
			$actividad_economica->id_acteconomica->LinkCustomAttributes = "";
			$actividad_economica->id_acteconomica->HrefValue = "";
			$actividad_economica->id_acteconomica->TooltipValue = "";

			// actividad
			$actividad_economica->actividad->LinkCustomAttributes = "";
			$actividad_economica->actividad->HrefValue = "";
			$actividad_economica->actividad->TooltipValue = "";

			// visibilidad
			$actividad_economica->visibilidad->LinkCustomAttributes = "";
			$actividad_economica->visibilidad->HrefValue = "";
			$actividad_economica->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($actividad_economica->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$actividad_economica->Row_Rendered();
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
