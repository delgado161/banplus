<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuario_nivelesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuario_niveles_list = new cusuario_niveles_list();
$Page =& $usuario_niveles_list;

// Page init
$usuario_niveles_list->Page_Init();

// Page main
$usuario_niveles_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuario_niveles->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuario_niveles_list = new ew_Page("usuario_niveles_list");

// page properties
usuario_niveles_list.PageID = "list"; // page ID
usuario_niveles_list.FormID = "fusuario_niveleslist"; // form ID
var EW_PAGE_ID = usuario_niveles_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuario_niveles_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuario_niveles_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuario_niveles_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($usuario_niveles->Export == "") || (EW_EXPORT_MASTER_RECORD && $usuario_niveles->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$usuario_niveles_list->TotalRecs = $usuario_niveles->SelectRecordCount();
	} else {
		if ($usuario_niveles_list->Recordset = $usuario_niveles_list->LoadRecordset())
			$usuario_niveles_list->TotalRecs = $usuario_niveles_list->Recordset->RecordCount();
	}
	$usuario_niveles_list->StartRec = 1;
	if ($usuario_niveles_list->DisplayRecs <= 0 || ($usuario_niveles->Export <> "" && $usuario_niveles->ExportAll)) // Display all records
		$usuario_niveles_list->DisplayRecs = $usuario_niveles_list->TotalRecs;
	if (!($usuario_niveles->Export <> "" && $usuario_niveles->ExportAll))
		$usuario_niveles_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$usuario_niveles_list->Recordset = $usuario_niveles_list->LoadRecordset($usuario_niveles_list->StartRec-1, $usuario_niveles_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuario_niveles->TableCaption() ?>
&nbsp;&nbsp;<?php $usuario_niveles_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($usuario_niveles->Export == "" && $usuario_niveles->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(usuario_niveles_list);" style="text-decoration: none;"><img id="usuario_niveles_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="usuario_niveles_list_SearchPanel">
<form name="fusuario_niveleslistsrch" id="fusuario_niveleslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="usuario_niveles">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($usuario_niveles->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $usuario_niveles_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($usuario_niveles->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($usuario_niveles->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($usuario_niveles->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $usuario_niveles_list->ShowPageHeader(); ?>
<?php
$usuario_niveles_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fusuario_niveleslist" id="fusuario_niveleslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="usuario_niveles">
<div id="gmp_usuario_niveles" class="ewGridMiddlePanel">
<?php if ($usuario_niveles_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $usuario_niveles->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$usuario_niveles_list->RenderListOptions();

// Render list options (header, left)
$usuario_niveles_list->ListOptions->Render("header", "left");
?>
<?php if ($usuario_niveles->UserLevelID->Visible) { // UserLevelID ?>
	<?php if ($usuario_niveles->SortUrl($usuario_niveles->UserLevelID) == "") { ?>
		<td><?php echo $usuario_niveles->UserLevelID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuario_niveles->SortUrl($usuario_niveles->UserLevelID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuario_niveles->UserLevelID->FldCaption() ?></td><td style="width: 10px;"><?php if ($usuario_niveles->UserLevelID->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario_niveles->UserLevelID->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuario_niveles->nombre->Visible) { // nombre ?>
	<?php if ($usuario_niveles->SortUrl($usuario_niveles->nombre) == "") { ?>
		<td><?php echo $usuario_niveles->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuario_niveles->SortUrl($usuario_niveles->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuario_niveles->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuario_niveles->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario_niveles->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$usuario_niveles_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($usuario_niveles->ExportAll && $usuario_niveles->Export <> "") {
	$usuario_niveles_list->StopRec = $usuario_niveles_list->TotalRecs;
} else {

	// Set the last record to display
	if ($usuario_niveles_list->TotalRecs > $usuario_niveles_list->StartRec + $usuario_niveles_list->DisplayRecs - 1)
		$usuario_niveles_list->StopRec = $usuario_niveles_list->StartRec + $usuario_niveles_list->DisplayRecs - 1;
	else
		$usuario_niveles_list->StopRec = $usuario_niveles_list->TotalRecs;
}
$usuario_niveles_list->RecCnt = $usuario_niveles_list->StartRec - 1;
if ($usuario_niveles_list->Recordset && !$usuario_niveles_list->Recordset->EOF) {
	$usuario_niveles_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $usuario_niveles_list->StartRec > 1)
		$usuario_niveles_list->Recordset->Move($usuario_niveles_list->StartRec - 1);
} elseif (!$usuario_niveles->AllowAddDeleteRow && $usuario_niveles_list->StopRec == 0) {
	$usuario_niveles_list->StopRec = $usuario_niveles->GridAddRowCount;
}

// Initialize aggregate
$usuario_niveles->RowType = EW_ROWTYPE_AGGREGATEINIT;
$usuario_niveles->ResetAttrs();
$usuario_niveles_list->RenderRow();
$usuario_niveles_list->RowCnt = 0;
while ($usuario_niveles_list->RecCnt < $usuario_niveles_list->StopRec) {
	$usuario_niveles_list->RecCnt++;
	if (intval($usuario_niveles_list->RecCnt) >= intval($usuario_niveles_list->StartRec)) {
		$usuario_niveles_list->RowCnt++;

		// Set up key count
		$usuario_niveles_list->KeyCount = $usuario_niveles_list->RowIndex;

		// Init row class and style
		$usuario_niveles->ResetAttrs();
		$usuario_niveles->CssClass = "";
		if ($usuario_niveles->CurrentAction == "gridadd") {
		} else {
			$usuario_niveles_list->LoadRowValues($usuario_niveles_list->Recordset); // Load row values
		}
		$usuario_niveles->RowType = EW_ROWTYPE_VIEW; // Render view
		$usuario_niveles->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$usuario_niveles_list->RenderRow();

		// Render list options
		$usuario_niveles_list->RenderListOptions();
?>
	<tr<?php echo $usuario_niveles->RowAttributes() ?>>
<?php

// Render list options (body, left)
$usuario_niveles_list->ListOptions->Render("body", "left");
?>
	<?php if ($usuario_niveles->UserLevelID->Visible) { // UserLevelID ?>
		<td<?php echo $usuario_niveles->UserLevelID->CellAttributes() ?>>
<div<?php echo $usuario_niveles->UserLevelID->ViewAttributes() ?>><?php echo $usuario_niveles->UserLevelID->ListViewValue() ?></div>
<a name="<?php echo $usuario_niveles_list->PageObjName . "_row_" . $usuario_niveles_list->RowCnt ?>" id="<?php echo $usuario_niveles_list->PageObjName . "_row_" . $usuario_niveles_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($usuario_niveles->nombre->Visible) { // nombre ?>
		<td<?php echo $usuario_niveles->nombre->CellAttributes() ?>>
<div<?php echo $usuario_niveles->nombre->ViewAttributes() ?>><?php echo $usuario_niveles->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$usuario_niveles_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($usuario_niveles->CurrentAction <> "gridadd")
		$usuario_niveles_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($usuario_niveles_list->Recordset)
	$usuario_niveles_list->Recordset->Close();
?>
<?php if ($usuario_niveles->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($usuario_niveles->CurrentAction <> "gridadd" && $usuario_niveles->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($usuario_niveles_list->Pager)) $usuario_niveles_list->Pager = new cPrevNextPager($usuario_niveles_list->StartRec, $usuario_niveles_list->DisplayRecs, $usuario_niveles_list->TotalRecs) ?>
<?php if ($usuario_niveles_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($usuario_niveles_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $usuario_niveles_list->PageUrl() ?>start=<?php echo $usuario_niveles_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($usuario_niveles_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $usuario_niveles_list->PageUrl() ?>start=<?php echo $usuario_niveles_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $usuario_niveles_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($usuario_niveles_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $usuario_niveles_list->PageUrl() ?>start=<?php echo $usuario_niveles_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($usuario_niveles_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $usuario_niveles_list->PageUrl() ?>start=<?php echo $usuario_niveles_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $usuario_niveles_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $usuario_niveles_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $usuario_niveles_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $usuario_niveles_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($usuario_niveles_list->SearchWhere == "0=101") { ?>
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
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $usuario_niveles_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($usuario_niveles->Export == "" && $usuario_niveles->CurrentAction == "") { ?>
<?php } ?>
<?php
$usuario_niveles_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuario_niveles->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuario_niveles_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuario_niveles_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'usuario_niveles';

	// Page object name
	var $PageObjName = 'usuario_niveles_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuario_niveles;
		if ($usuario_niveles->UseTokenInUrl) $PageUrl .= "t=" . $usuario_niveles->TableVar . "&"; // Add page token
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
		global $objForm, $usuario_niveles;
		if ($usuario_niveles->UseTokenInUrl) {
			if ($objForm)
				return ($usuario_niveles->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuario_niveles->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuario_niveles_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuario_niveles)
		if (!isset($GLOBALS["usuario_niveles"])) {
			$GLOBALS["usuario_niveles"] = new cusuario_niveles();
			$GLOBALS["Table"] =& $GLOBALS["usuario_niveles"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "usuario_nivelesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "usuario_nivelesdelete.php";
		$this->MultiUpdateUrl = "usuario_nivelesupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuario_niveles', TRUE);

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
		global $usuario_niveles;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$usuario_niveles->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $usuario_niveles;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($usuario_niveles->Export <> "" ||
				$usuario_niveles->CurrentAction == "gridadd" ||
				$usuario_niveles->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$usuario_niveles->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($usuario_niveles->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $usuario_niveles->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$usuario_niveles->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$usuario_niveles->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$usuario_niveles->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $usuario_niveles->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$usuario_niveles->setSessionWhere($sFilter);
		$usuario_niveles->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $usuario_niveles;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $usuario_niveles->nombre, $Keyword);
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
		global $Security, $usuario_niveles;
		$sSearchStr = "";
		$sSearchKeyword = $usuario_niveles->BasicSearchKeyword;
		$sSearchType = $usuario_niveles->BasicSearchType;
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
			$usuario_niveles->setSessionBasicSearchKeyword($sSearchKeyword);
			$usuario_niveles->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $usuario_niveles;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$usuario_niveles->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $usuario_niveles;
		$usuario_niveles->setSessionBasicSearchKeyword("");
		$usuario_niveles->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $usuario_niveles;
		$bRestore = TRUE;
		if ($usuario_niveles->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$usuario_niveles->BasicSearchKeyword = $usuario_niveles->getSessionBasicSearchKeyword();
			$usuario_niveles->BasicSearchType = $usuario_niveles->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $usuario_niveles;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$usuario_niveles->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$usuario_niveles->CurrentOrderType = @$_GET["ordertype"];
			$usuario_niveles->UpdateSort($usuario_niveles->UserLevelID); // UserLevelID
			$usuario_niveles->UpdateSort($usuario_niveles->nombre); // nombre
			$usuario_niveles->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $usuario_niveles;
		$sOrderBy = $usuario_niveles->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($usuario_niveles->SqlOrderBy() <> "") {
				$sOrderBy = $usuario_niveles->SqlOrderBy();
				$usuario_niveles->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $usuario_niveles;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$usuario_niveles->setSessionOrderBy($sOrderBy);
				$usuario_niveles->UserLevelID->setSort("");
				$usuario_niveles->nombre->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$usuario_niveles->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $usuario_niveles;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $usuario_niveles, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $usuario_niveles;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuario_niveles;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuario_niveles->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuario_niveles->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuario_niveles->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuario_niveles->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuario_niveles->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuario_niveles->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $usuario_niveles;
		$usuario_niveles->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$usuario_niveles->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuario_niveles;

		// Call Recordset Selecting event
		$usuario_niveles->Recordset_Selecting($usuario_niveles->CurrentFilter);

		// Load List page SQL
		$sSql = $usuario_niveles->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$usuario_niveles->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuario_niveles;
		$sFilter = $usuario_niveles->KeyFilter();

		// Call Row Selecting event
		$usuario_niveles->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuario_niveles->CurrentFilter = $sFilter;
		$sSql = $usuario_niveles->SQL();
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
		global $conn, $usuario_niveles;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuario_niveles->Row_Selected($row);
		$usuario_niveles->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$usuario_niveles->nombre->setDbValue($rs->fields('nombre'));
	}

	// Load old record
	function LoadOldRecord() {
		global $usuario_niveles;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($usuario_niveles->getKey("UserLevelID")) <> "")
			$usuario_niveles->UserLevelID->CurrentValue = $usuario_niveles->getKey("UserLevelID"); // UserLevelID
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$usuario_niveles->CurrentFilter = $usuario_niveles->KeyFilter();
			$sSql = $usuario_niveles->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuario_niveles;

		// Initialize URLs
		$this->ViewUrl = $usuario_niveles->ViewUrl();
		$this->EditUrl = $usuario_niveles->EditUrl();
		$this->InlineEditUrl = $usuario_niveles->InlineEditUrl();
		$this->CopyUrl = $usuario_niveles->CopyUrl();
		$this->InlineCopyUrl = $usuario_niveles->InlineCopyUrl();
		$this->DeleteUrl = $usuario_niveles->DeleteUrl();

		// Call Row_Rendering event
		$usuario_niveles->Row_Rendering();

		// Common render codes for all row types
		// UserLevelID
		// nombre

		if ($usuario_niveles->RowType == EW_ROWTYPE_VIEW) { // View row

			// UserLevelID
			$usuario_niveles->UserLevelID->ViewValue = $usuario_niveles->UserLevelID->CurrentValue;
			$usuario_niveles->UserLevelID->ViewCustomAttributes = "";

			// nombre
			$usuario_niveles->nombre->ViewValue = $usuario_niveles->nombre->CurrentValue;
			$usuario_niveles->nombre->ViewCustomAttributes = "";

			// UserLevelID
			$usuario_niveles->UserLevelID->LinkCustomAttributes = "";
			$usuario_niveles->UserLevelID->HrefValue = "";
			$usuario_niveles->UserLevelID->TooltipValue = "";

			// nombre
			$usuario_niveles->nombre->LinkCustomAttributes = "";
			$usuario_niveles->nombre->HrefValue = "";
			$usuario_niveles->nombre->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuario_niveles->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuario_niveles->Row_Rendered();
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
