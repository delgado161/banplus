<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "grupoinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$grupo_list = new cgrupo_list();
$Page =& $grupo_list;

// Page init
$grupo_list->Page_Init();

// Page main
$grupo_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($grupo->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grupo_list = new ew_Page("grupo_list");

// page properties
grupo_list.PageID = "list"; // page ID
grupo_list.FormID = "fgrupolist"; // form ID
var EW_PAGE_ID = grupo_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grupo_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grupo_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grupo_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($grupo->Export == "") || (EW_EXPORT_MASTER_RECORD && $grupo->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$grupo_list->TotalRecs = $grupo->SelectRecordCount();
	} else {
		if ($grupo_list->Recordset = $grupo_list->LoadRecordset())
			$grupo_list->TotalRecs = $grupo_list->Recordset->RecordCount();
	}
	$grupo_list->StartRec = 1;
	if ($grupo_list->DisplayRecs <= 0 || ($grupo->Export <> "" && $grupo->ExportAll)) // Display all records
		$grupo_list->DisplayRecs = $grupo_list->TotalRecs;
	if (!($grupo->Export <> "" && $grupo->ExportAll))
		$grupo_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$grupo_list->Recordset = $grupo_list->LoadRecordset($grupo_list->StartRec-1, $grupo_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grupo->TableCaption() ?>
&nbsp;&nbsp;<?php $grupo_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($grupo->Export == "" && $grupo->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(grupo_list);" style="text-decoration: none;"><img id="grupo_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="grupo_list_SearchPanel">
<form name="fgrupolistsrch" id="fgrupolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="grupo">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($grupo->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $grupo_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($grupo->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($grupo->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($grupo->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $grupo_list->ShowPageHeader(); ?>
<?php
$grupo_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fgrupolist" id="fgrupolist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="grupo">
<div id="gmp_grupo" class="ewGridMiddlePanel">
<?php if ($grupo_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $grupo->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$grupo_list->RenderListOptions();

// Render list options (header, left)
$grupo_list->ListOptions->Render("header", "left");
?>
<?php if ($grupo->nombre->Visible) { // nombre ?>
	<?php if ($grupo->SortUrl($grupo->nombre) == "") { ?>
		<td><?php echo $grupo->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grupo->SortUrl($grupo->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($grupo->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo->id_padre->Visible) { // id_padre ?>
	<?php if ($grupo->SortUrl($grupo->id_padre) == "") { ?>
		<td><?php echo $grupo->id_padre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grupo->SortUrl($grupo->id_padre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo->id_padre->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo->id_padre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo->id_padre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo->id_contenido->Visible) { // id_contenido ?>
	<?php if ($grupo->SortUrl($grupo->id_contenido) == "") { ?>
		<td><?php echo $grupo->id_contenido->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grupo->SortUrl($grupo->id_contenido) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo->id_contenido->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo->id_contenido->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo->id_contenido->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo->orden->Visible) { // orden ?>
	<?php if ($grupo->SortUrl($grupo->orden) == "") { ?>
		<td><?php echo $grupo->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grupo->SortUrl($grupo->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo->orden->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo->estatus->Visible) { // estatus ?>
	<?php if ($grupo->SortUrl($grupo->estatus) == "") { ?>
		<td><?php echo $grupo->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grupo->SortUrl($grupo->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$grupo_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($grupo->ExportAll && $grupo->Export <> "") {
	$grupo_list->StopRec = $grupo_list->TotalRecs;
} else {

	// Set the last record to display
	if ($grupo_list->TotalRecs > $grupo_list->StartRec + $grupo_list->DisplayRecs - 1)
		$grupo_list->StopRec = $grupo_list->StartRec + $grupo_list->DisplayRecs - 1;
	else
		$grupo_list->StopRec = $grupo_list->TotalRecs;
}
$grupo_list->RecCnt = $grupo_list->StartRec - 1;
if ($grupo_list->Recordset && !$grupo_list->Recordset->EOF) {
	$grupo_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $grupo_list->StartRec > 1)
		$grupo_list->Recordset->Move($grupo_list->StartRec - 1);
} elseif (!$grupo->AllowAddDeleteRow && $grupo_list->StopRec == 0) {
	$grupo_list->StopRec = $grupo->GridAddRowCount;
}

// Initialize aggregate
$grupo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$grupo->ResetAttrs();
$grupo_list->RenderRow();
$grupo_list->RowCnt = 0;
while ($grupo_list->RecCnt < $grupo_list->StopRec) {
	$grupo_list->RecCnt++;
	if (intval($grupo_list->RecCnt) >= intval($grupo_list->StartRec)) {
		$grupo_list->RowCnt++;

		// Set up key count
		$grupo_list->KeyCount = $grupo_list->RowIndex;

		// Init row class and style
		$grupo->ResetAttrs();
		$grupo->CssClass = "";
		if ($grupo->CurrentAction == "gridadd") {
		} else {
			$grupo_list->LoadRowValues($grupo_list->Recordset); // Load row values
		}
		$grupo->RowType = EW_ROWTYPE_VIEW; // Render view
		$grupo->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$grupo_list->RenderRow();

		// Render list options
		$grupo_list->RenderListOptions();
?>
	<tr<?php echo $grupo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$grupo_list->ListOptions->Render("body", "left");
?>
	<?php if ($grupo->nombre->Visible) { // nombre ?>
		<td<?php echo $grupo->nombre->CellAttributes() ?>>
<div<?php echo $grupo->nombre->ViewAttributes() ?>><?php echo $grupo->nombre->ListViewValue() ?></div>
<a name="<?php echo $grupo_list->PageObjName . "_row_" . $grupo_list->RowCnt ?>" id="<?php echo $grupo_list->PageObjName . "_row_" . $grupo_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($grupo->id_padre->Visible) { // id_padre ?>
		<td<?php echo $grupo->id_padre->CellAttributes() ?>>
<div<?php echo $grupo->id_padre->ViewAttributes() ?>><?php echo $grupo->id_padre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grupo->id_contenido->Visible) { // id_contenido ?>
		<td<?php echo $grupo->id_contenido->CellAttributes() ?>>
<div<?php echo $grupo->id_contenido->ViewAttributes() ?>><?php echo $grupo->id_contenido->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grupo->orden->Visible) { // orden ?>
		<td<?php echo $grupo->orden->CellAttributes() ?>>
<div<?php echo $grupo->orden->ViewAttributes() ?>><?php echo $grupo->orden->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grupo->estatus->Visible) { // estatus ?>
		<td<?php echo $grupo->estatus->CellAttributes() ?>>
<div<?php echo $grupo->estatus->ViewAttributes() ?>><?php echo $grupo->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grupo_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($grupo->CurrentAction <> "gridadd")
		$grupo_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($grupo_list->Recordset)
	$grupo_list->Recordset->Close();
?>
<?php if ($grupo->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($grupo->CurrentAction <> "gridadd" && $grupo->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($grupo_list->Pager)) $grupo_list->Pager = new cPrevNextPager($grupo_list->StartRec, $grupo_list->DisplayRecs, $grupo_list->TotalRecs) ?>
<?php if ($grupo_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($grupo_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $grupo_list->PageUrl() ?>start=<?php echo $grupo_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($grupo_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $grupo_list->PageUrl() ?>start=<?php echo $grupo_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $grupo_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($grupo_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $grupo_list->PageUrl() ?>start=<?php echo $grupo_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($grupo_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $grupo_list->PageUrl() ?>start=<?php echo $grupo_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $grupo_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $grupo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $grupo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $grupo_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($grupo_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $grupo_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($grupo->Export == "" && $grupo->CurrentAction == "") { ?>
<?php } ?>
<?php
$grupo_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($grupo->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$grupo_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrupo_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'grupo';

	// Page object name
	var $PageObjName = 'grupo_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grupo;
		if ($grupo->UseTokenInUrl) $PageUrl .= "t=" . $grupo->TableVar . "&"; // Add page token
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
		global $objForm, $grupo;
		if ($grupo->UseTokenInUrl) {
			if ($objForm)
				return ($grupo->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grupo->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrupo_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (grupo)
		if (!isset($GLOBALS["grupo"])) {
			$GLOBALS["grupo"] = new cgrupo();
			$GLOBALS["Table"] =& $GLOBALS["grupo"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "grupoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "grupodelete.php";
		$this->MultiUpdateUrl = "grupoupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grupo', TRUE);

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
		global $grupo;

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
			$grupo->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $grupo;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($grupo->Export <> "" ||
				$grupo->CurrentAction == "gridadd" ||
				$grupo->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$grupo->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($grupo->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $grupo->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$grupo->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$grupo->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$grupo->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $grupo->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$grupo->setSessionWhere($sFilter);
		$grupo->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $grupo;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $grupo->nombre, $Keyword);
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
		global $Security, $grupo;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $grupo->BasicSearchKeyword;
		$sSearchType = $grupo->BasicSearchType;
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
			$grupo->setSessionBasicSearchKeyword($sSearchKeyword);
			$grupo->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $grupo;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$grupo->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $grupo;
		$grupo->setSessionBasicSearchKeyword("");
		$grupo->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $grupo;
		$bRestore = TRUE;
		if ($grupo->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$grupo->BasicSearchKeyword = $grupo->getSessionBasicSearchKeyword();
			$grupo->BasicSearchType = $grupo->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $grupo;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$grupo->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$grupo->CurrentOrderType = @$_GET["ordertype"];
			$grupo->UpdateSort($grupo->nombre); // nombre
			$grupo->UpdateSort($grupo->id_padre); // id_padre
			$grupo->UpdateSort($grupo->id_contenido); // id_contenido
			$grupo->UpdateSort($grupo->orden); // orden
			$grupo->UpdateSort($grupo->estatus); // estatus
			$grupo->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $grupo;
		$sOrderBy = $grupo->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($grupo->SqlOrderBy() <> "") {
				$sOrderBy = $grupo->SqlOrderBy();
				$grupo->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $grupo;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$grupo->setSessionOrderBy($sOrderBy);
				$grupo->nombre->setSort("");
				$grupo->id_padre->setSort("");
				$grupo->id_contenido->setSort("");
				$grupo->orden->setSort("");
				$grupo->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$grupo->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $grupo;

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
		global $Security, $Language, $grupo, $objForm;
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
		global $Security, $Language, $grupo;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $grupo;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$grupo->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$grupo->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $grupo->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$grupo->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$grupo->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$grupo->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $grupo;
		$grupo->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$grupo->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $grupo;

		// Call Recordset Selecting event
		$grupo->Recordset_Selecting($grupo->CurrentFilter);

		// Load List page SQL
		$sSql = $grupo->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$grupo->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grupo;
		$sFilter = $grupo->KeyFilter();

		// Call Row Selecting event
		$grupo->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grupo->CurrentFilter = $sFilter;
		$sSql = $grupo->SQL();
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
		global $conn, $grupo;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$grupo->Row_Selected($row);
		$grupo->id_grupo->setDbValue($rs->fields('id_grupo'));
		$grupo->nombre->setDbValue($rs->fields('nombre'));
		$grupo->id_padre->setDbValue($rs->fields('id_padre'));
		$grupo->id_contenido->setDbValue($rs->fields('id_contenido'));
		$grupo->orden->setDbValue($rs->fields('orden'));
		$grupo->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $grupo;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($grupo->getKey("id_grupo")) <> "")
			$grupo->id_grupo->CurrentValue = $grupo->getKey("id_grupo"); // id_grupo
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$grupo->CurrentFilter = $grupo->KeyFilter();
			$sSql = $grupo->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grupo;

		// Initialize URLs
		$this->ViewUrl = $grupo->ViewUrl();
		$this->EditUrl = $grupo->EditUrl();
		$this->InlineEditUrl = $grupo->InlineEditUrl();
		$this->CopyUrl = $grupo->CopyUrl();
		$this->InlineCopyUrl = $grupo->InlineCopyUrl();
		$this->DeleteUrl = $grupo->DeleteUrl();

		// Call Row_Rendering event
		$grupo->Row_Rendering();

		// Common render codes for all row types
		// id_grupo

		$grupo->id_grupo->CellCssStyle = "white-space: nowrap;";

		// nombre
		// id_padre
		// id_contenido
		// orden
		// estatus

		if ($grupo->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$grupo->nombre->ViewValue = $grupo->nombre->CurrentValue;
			$grupo->nombre->ViewCustomAttributes = "";

			// id_padre
			if (strval($grupo->id_padre->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo` = " . ew_AdjustSql($grupo->id_padre->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo->id_padre->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$grupo->id_padre->ViewValue = $grupo->id_padre->CurrentValue;
				}
			} else {
				$grupo->id_padre->ViewValue = NULL;
			}
			$grupo->id_padre->ViewCustomAttributes = "";

			// id_contenido
			if (strval($grupo->id_contenido->CurrentValue) <> "") {
				$sFilterWrk = "`id_contenido` = " . ew_AdjustSql($grupo->id_contenido->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo->id_contenido->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo->id_contenido->ViewValue = $grupo->id_contenido->CurrentValue;
				}
			} else {
				$grupo->id_contenido->ViewValue = NULL;
			}
			$grupo->id_contenido->ViewCustomAttributes = "";

			// orden
			$grupo->orden->ViewValue = $grupo->orden->CurrentValue;
			$grupo->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($grupo->estatus->CurrentValue) <> "") {
				switch ($grupo->estatus->CurrentValue) {
					case "1":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(1) <> "" ? $grupo->estatus->FldTagCaption(1) : $grupo->estatus->CurrentValue;
						break;
					case "0":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(2) <> "" ? $grupo->estatus->FldTagCaption(2) : $grupo->estatus->CurrentValue;
						break;
					case "3":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(3) <> "" ? $grupo->estatus->FldTagCaption(3) : $grupo->estatus->CurrentValue;
						break;
					case "4":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(4) <> "" ? $grupo->estatus->FldTagCaption(4) : $grupo->estatus->CurrentValue;
						break;
					default:
						$grupo->estatus->ViewValue = $grupo->estatus->CurrentValue;
				}
			} else {
				$grupo->estatus->ViewValue = NULL;
			}
			$grupo->estatus->ViewCustomAttributes = "";

			// nombre
			$grupo->nombre->LinkCustomAttributes = "";
			$grupo->nombre->HrefValue = "";
			$grupo->nombre->TooltipValue = "";

			// id_padre
			$grupo->id_padre->LinkCustomAttributes = "";
			$grupo->id_padre->HrefValue = "";
			$grupo->id_padre->TooltipValue = "";

			// id_contenido
			$grupo->id_contenido->LinkCustomAttributes = "";
			$grupo->id_contenido->HrefValue = "";
			$grupo->id_contenido->TooltipValue = "";

			// orden
			$grupo->orden->LinkCustomAttributes = "";
			$grupo->orden->HrefValue = "";
			$grupo->orden->TooltipValue = "";

			// estatus
			$grupo->estatus->LinkCustomAttributes = "";
			$grupo->estatus->HrefValue = "";
			$grupo->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grupo->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grupo->Row_Rendered();
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
		$table = 'grupo';
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
