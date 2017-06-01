<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_bancosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_bancos_list = new cz_bancos_list();
$Page =& $z_bancos_list;

// Page init
$z_bancos_list->Page_Init();

// Page main
$z_bancos_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_bancos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_bancos_list = new ew_Page("z_bancos_list");

// page properties
z_bancos_list.PageID = "list"; // page ID
z_bancos_list.FormID = "fz_bancoslist"; // form ID
var EW_PAGE_ID = z_bancos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_bancos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_bancos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_bancos_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($z_bancos->Export == "") || (EW_EXPORT_MASTER_RECORD && $z_bancos->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$z_bancos_list->TotalRecs = $z_bancos->SelectRecordCount();
	} else {
		if ($z_bancos_list->Recordset = $z_bancos_list->LoadRecordset())
			$z_bancos_list->TotalRecs = $z_bancos_list->Recordset->RecordCount();
	}
	$z_bancos_list->StartRec = 1;
	if ($z_bancos_list->DisplayRecs <= 0 || ($z_bancos->Export <> "" && $z_bancos->ExportAll)) // Display all records
		$z_bancos_list->DisplayRecs = $z_bancos_list->TotalRecs;
	if (!($z_bancos->Export <> "" && $z_bancos->ExportAll))
		$z_bancos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$z_bancos_list->Recordset = $z_bancos_list->LoadRecordset($z_bancos_list->StartRec-1, $z_bancos_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_bancos->TableCaption() ?>
&nbsp;&nbsp;<?php $z_bancos_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_bancos->Export == "" && $z_bancos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(z_bancos_list);" style="text-decoration: none;"><img id="z_bancos_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="z_bancos_list_SearchPanel">
<form name="fz_bancoslistsrch" id="fz_bancoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="z_bancos">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($z_bancos->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $z_bancos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($z_bancos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($z_bancos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($z_bancos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $z_bancos_list->ShowPageHeader(); ?>
<?php
$z_bancos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fz_bancoslist" id="fz_bancoslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="z_bancos">
<div id="gmp_z_bancos" class="ewGridMiddlePanel">
<?php if ($z_bancos_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $z_bancos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$z_bancos_list->RenderListOptions();

// Render list options (header, left)
$z_bancos_list->ListOptions->Render("header", "left");
?>
<?php if ($z_bancos->id_bancos->Visible) { // id_bancos ?>
	<?php if ($z_bancos->SortUrl($z_bancos->id_bancos) == "") { ?>
		<td><?php echo $z_bancos->id_bancos->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_bancos->SortUrl($z_bancos->id_bancos) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_bancos->id_bancos->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_bancos->id_bancos->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_bancos->id_bancos->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_bancos->banco->Visible) { // banco ?>
	<?php if ($z_bancos->SortUrl($z_bancos->banco) == "") { ?>
		<td><?php echo $z_bancos->banco->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_bancos->SortUrl($z_bancos->banco) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_bancos->banco->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($z_bancos->banco->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_bancos->banco->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_bancos->visibilidad->Visible) { // visibilidad ?>
	<?php if ($z_bancos->SortUrl($z_bancos->visibilidad) == "") { ?>
		<td><?php echo $z_bancos->visibilidad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_bancos->SortUrl($z_bancos->visibilidad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_bancos->visibilidad->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_bancos->visibilidad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_bancos->visibilidad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$z_bancos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($z_bancos->ExportAll && $z_bancos->Export <> "") {
	$z_bancos_list->StopRec = $z_bancos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($z_bancos_list->TotalRecs > $z_bancos_list->StartRec + $z_bancos_list->DisplayRecs - 1)
		$z_bancos_list->StopRec = $z_bancos_list->StartRec + $z_bancos_list->DisplayRecs - 1;
	else
		$z_bancos_list->StopRec = $z_bancos_list->TotalRecs;
}
$z_bancos_list->RecCnt = $z_bancos_list->StartRec - 1;
if ($z_bancos_list->Recordset && !$z_bancos_list->Recordset->EOF) {
	$z_bancos_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $z_bancos_list->StartRec > 1)
		$z_bancos_list->Recordset->Move($z_bancos_list->StartRec - 1);
} elseif (!$z_bancos->AllowAddDeleteRow && $z_bancos_list->StopRec == 0) {
	$z_bancos_list->StopRec = $z_bancos->GridAddRowCount;
}

// Initialize aggregate
$z_bancos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$z_bancos->ResetAttrs();
$z_bancos_list->RenderRow();
$z_bancos_list->RowCnt = 0;
while ($z_bancos_list->RecCnt < $z_bancos_list->StopRec) {
	$z_bancos_list->RecCnt++;
	if (intval($z_bancos_list->RecCnt) >= intval($z_bancos_list->StartRec)) {
		$z_bancos_list->RowCnt++;

		// Set up key count
		$z_bancos_list->KeyCount = $z_bancos_list->RowIndex;

		// Init row class and style
		$z_bancos->ResetAttrs();
		$z_bancos->CssClass = "";
		if ($z_bancos->CurrentAction == "gridadd") {
		} else {
			$z_bancos_list->LoadRowValues($z_bancos_list->Recordset); // Load row values
		}
		$z_bancos->RowType = EW_ROWTYPE_VIEW; // Render view
		$z_bancos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$z_bancos_list->RenderRow();

		// Render list options
		$z_bancos_list->RenderListOptions();
?>
	<tr<?php echo $z_bancos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$z_bancos_list->ListOptions->Render("body", "left");
?>
	<?php if ($z_bancos->id_bancos->Visible) { // id_bancos ?>
		<td<?php echo $z_bancos->id_bancos->CellAttributes() ?>>
<div<?php echo $z_bancos->id_bancos->ViewAttributes() ?>><?php echo $z_bancos->id_bancos->ListViewValue() ?></div>
<a name="<?php echo $z_bancos_list->PageObjName . "_row_" . $z_bancos_list->RowCnt ?>" id="<?php echo $z_bancos_list->PageObjName . "_row_" . $z_bancos_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($z_bancos->banco->Visible) { // banco ?>
		<td<?php echo $z_bancos->banco->CellAttributes() ?>>
<div<?php echo $z_bancos->banco->ViewAttributes() ?>><?php echo $z_bancos->banco->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_bancos->visibilidad->Visible) { // visibilidad ?>
		<td<?php echo $z_bancos->visibilidad->CellAttributes() ?>>
<div<?php echo $z_bancos->visibilidad->ViewAttributes() ?>><?php echo $z_bancos->visibilidad->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$z_bancos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($z_bancos->CurrentAction <> "gridadd")
		$z_bancos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($z_bancos_list->Recordset)
	$z_bancos_list->Recordset->Close();
?>
<?php if ($z_bancos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($z_bancos->CurrentAction <> "gridadd" && $z_bancos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($z_bancos_list->Pager)) $z_bancos_list->Pager = new cPrevNextPager($z_bancos_list->StartRec, $z_bancos_list->DisplayRecs, $z_bancos_list->TotalRecs) ?>
<?php if ($z_bancos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($z_bancos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $z_bancos_list->PageUrl() ?>start=<?php echo $z_bancos_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($z_bancos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $z_bancos_list->PageUrl() ?>start=<?php echo $z_bancos_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $z_bancos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($z_bancos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $z_bancos_list->PageUrl() ?>start=<?php echo $z_bancos_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($z_bancos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $z_bancos_list->PageUrl() ?>start=<?php echo $z_bancos_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $z_bancos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $z_bancos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $z_bancos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $z_bancos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($z_bancos_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $z_bancos_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($z_bancos->Export == "" && $z_bancos->CurrentAction == "") { ?>
<?php } ?>
<?php
$z_bancos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_bancos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_bancos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_bancos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = '_bancos';

	// Page object name
	var $PageObjName = 'z_bancos_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_bancos;
		if ($z_bancos->UseTokenInUrl) $PageUrl .= "t=" . $z_bancos->TableVar . "&"; // Add page token
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
		global $objForm, $z_bancos;
		if ($z_bancos->UseTokenInUrl) {
			if ($objForm)
				return ($z_bancos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_bancos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_bancos_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_bancos)
		if (!isset($GLOBALS["z_bancos"])) {
			$GLOBALS["z_bancos"] = new cz_bancos();
			$GLOBALS["Table"] =& $GLOBALS["z_bancos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "z_bancosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "z_bancosdelete.php";
		$this->MultiUpdateUrl = "z_bancosupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_bancos', TRUE);

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
		global $z_bancos;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$z_bancos->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $z_bancos;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($z_bancos->Export <> "" ||
				$z_bancos->CurrentAction == "gridadd" ||
				$z_bancos->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$z_bancos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($z_bancos->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $z_bancos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$z_bancos->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$z_bancos->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$z_bancos->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $z_bancos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$z_bancos->setSessionWhere($sFilter);
		$z_bancos->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $z_bancos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $z_bancos->banco, $Keyword);
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
		global $Security, $z_bancos;
		$sSearchStr = "";
		$sSearchKeyword = $z_bancos->BasicSearchKeyword;
		$sSearchType = $z_bancos->BasicSearchType;
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
			$z_bancos->setSessionBasicSearchKeyword($sSearchKeyword);
			$z_bancos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $z_bancos;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$z_bancos->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $z_bancos;
		$z_bancos->setSessionBasicSearchKeyword("");
		$z_bancos->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $z_bancos;
		$bRestore = TRUE;
		if ($z_bancos->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$z_bancos->BasicSearchKeyword = $z_bancos->getSessionBasicSearchKeyword();
			$z_bancos->BasicSearchType = $z_bancos->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $z_bancos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$z_bancos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$z_bancos->CurrentOrderType = @$_GET["ordertype"];
			$z_bancos->UpdateSort($z_bancos->id_bancos); // id_bancos
			$z_bancos->UpdateSort($z_bancos->banco); // banco
			$z_bancos->UpdateSort($z_bancos->visibilidad); // visibilidad
			$z_bancos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $z_bancos;
		$sOrderBy = $z_bancos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($z_bancos->SqlOrderBy() <> "") {
				$sOrderBy = $z_bancos->SqlOrderBy();
				$z_bancos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $z_bancos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$z_bancos->setSessionOrderBy($sOrderBy);
				$z_bancos->id_bancos->setSort("");
				$z_bancos->banco->setSort("");
				$z_bancos->visibilidad->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$z_bancos->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $z_bancos;

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
		global $Security, $Language, $z_bancos, $objForm;
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
		global $Security, $Language, $z_bancos;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_bancos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_bancos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_bancos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_bancos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_bancos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_bancos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_bancos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $z_bancos;
		$z_bancos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$z_bancos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_bancos;

		// Call Recordset Selecting event
		$z_bancos->Recordset_Selecting($z_bancos->CurrentFilter);

		// Load List page SQL
		$sSql = $z_bancos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_bancos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_bancos;
		$sFilter = $z_bancos->KeyFilter();

		// Call Row Selecting event
		$z_bancos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_bancos->CurrentFilter = $sFilter;
		$sSql = $z_bancos->SQL();
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
		global $conn, $z_bancos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_bancos->Row_Selected($row);
		$z_bancos->id_bancos->setDbValue($rs->fields('id_bancos'));
		$z_bancos->banco->setDbValue($rs->fields('banco'));
		$z_bancos->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Load old record
	function LoadOldRecord() {
		global $z_bancos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($z_bancos->getKey("id_bancos")) <> "")
			$z_bancos->id_bancos->CurrentValue = $z_bancos->getKey("id_bancos"); // id_bancos
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$z_bancos->CurrentFilter = $z_bancos->KeyFilter();
			$sSql = $z_bancos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_bancos;

		// Initialize URLs
		$this->ViewUrl = $z_bancos->ViewUrl();
		$this->EditUrl = $z_bancos->EditUrl();
		$this->InlineEditUrl = $z_bancos->InlineEditUrl();
		$this->CopyUrl = $z_bancos->CopyUrl();
		$this->InlineCopyUrl = $z_bancos->InlineCopyUrl();
		$this->DeleteUrl = $z_bancos->DeleteUrl();

		// Call Row_Rendering event
		$z_bancos->Row_Rendering();

		// Common render codes for all row types
		// id_bancos
		// banco
		// visibilidad

		if ($z_bancos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_bancos
			$z_bancos->id_bancos->ViewValue = $z_bancos->id_bancos->CurrentValue;
			$z_bancos->id_bancos->ViewCustomAttributes = "";

			// banco
			$z_bancos->banco->ViewValue = $z_bancos->banco->CurrentValue;
			$z_bancos->banco->ViewCustomAttributes = "";

			// visibilidad
			$z_bancos->visibilidad->ViewValue = $z_bancos->visibilidad->CurrentValue;
			$z_bancos->visibilidad->ViewCustomAttributes = "";

			// id_bancos
			$z_bancos->id_bancos->LinkCustomAttributes = "";
			$z_bancos->id_bancos->HrefValue = "";
			$z_bancos->id_bancos->TooltipValue = "";

			// banco
			$z_bancos->banco->LinkCustomAttributes = "";
			$z_bancos->banco->HrefValue = "";
			$z_bancos->banco->TooltipValue = "";

			// visibilidad
			$z_bancos->visibilidad->LinkCustomAttributes = "";
			$z_bancos->visibilidad->HrefValue = "";
			$z_bancos->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_bancos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_bancos->Row_Rendered();
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
