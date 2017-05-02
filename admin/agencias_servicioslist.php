<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "agencias_serviciosinfo.php" ?>
<?php include_once "agenciasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$agencias_servicios_list = new cagencias_servicios_list();
$Page =& $agencias_servicios_list;

// Page init
$agencias_servicios_list->Page_Init();

// Page main
$agencias_servicios_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($agencias_servicios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var agencias_servicios_list = new ew_Page("agencias_servicios_list");

// page properties
agencias_servicios_list.PageID = "list"; // page ID
agencias_servicios_list.FormID = "fagencias_servicioslist"; // form ID
var EW_PAGE_ID = agencias_servicios_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
agencias_servicios_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
agencias_servicios_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
agencias_servicios_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($agencias_servicios->Export == "") || (EW_EXPORT_MASTER_RECORD && $agencias_servicios->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "agenciaslist.php";
if ($agencias_servicios_list->DbMasterFilter <> "" && $agencias_servicios->getCurrentMasterTable() == "agencias") {
	if ($agencias_servicios_list->MasterRecordExists) {
		if ($agencias_servicios->getCurrentMasterTable() == $agencias_servicios->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $agencias->TableCaption() ?>
&nbsp;&nbsp;<?php $agencias_servicios_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($agencias_servicios->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "agenciasmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$agencias_servicios_list->TotalRecs = $agencias_servicios->SelectRecordCount();
	} else {
		if ($agencias_servicios_list->Recordset = $agencias_servicios_list->LoadRecordset())
			$agencias_servicios_list->TotalRecs = $agencias_servicios_list->Recordset->RecordCount();
	}
	$agencias_servicios_list->StartRec = 1;
	if ($agencias_servicios_list->DisplayRecs <= 0 || ($agencias_servicios->Export <> "" && $agencias_servicios->ExportAll)) // Display all records
		$agencias_servicios_list->DisplayRecs = $agencias_servicios_list->TotalRecs;
	if (!($agencias_servicios->Export <> "" && $agencias_servicios->ExportAll))
		$agencias_servicios_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$agencias_servicios_list->Recordset = $agencias_servicios_list->LoadRecordset($agencias_servicios_list->StartRec-1, $agencias_servicios_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $agencias_servicios->TableCaption() ?>
<?php if ($agencias_servicios->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $agencias_servicios_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php $agencias_servicios_list->ShowPageHeader(); ?>
<?php
$agencias_servicios_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fagencias_servicioslist" id="fagencias_servicioslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="agencias_servicios">
<div id="gmp_agencias_servicios" class="ewGridMiddlePanel">
<?php if ($agencias_servicios_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $agencias_servicios->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$agencias_servicios_list->RenderListOptions();

// Render list options (header, left)
$agencias_servicios_list->ListOptions->Render("header", "left");
?>
<?php if ($agencias_servicios->id_servicio->Visible) { // id_servicio ?>
	<?php if ($agencias_servicios->SortUrl($agencias_servicios->id_servicio) == "") { ?>
		<td><?php echo $agencias_servicios->id_servicio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $agencias_servicios->SortUrl($agencias_servicios->id_servicio) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias_servicios->id_servicio->FldCaption() ?></td><td style="width: 10px;"><?php if ($agencias_servicios->id_servicio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias_servicios->id_servicio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($agencias_servicios->estatus->Visible) { // estatus ?>
	<?php if ($agencias_servicios->SortUrl($agencias_servicios->estatus) == "") { ?>
		<td><?php echo $agencias_servicios->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $agencias_servicios->SortUrl($agencias_servicios->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $agencias_servicios->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($agencias_servicios->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($agencias_servicios->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$agencias_servicios_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($agencias_servicios->ExportAll && $agencias_servicios->Export <> "") {
	$agencias_servicios_list->StopRec = $agencias_servicios_list->TotalRecs;
} else {

	// Set the last record to display
	if ($agencias_servicios_list->TotalRecs > $agencias_servicios_list->StartRec + $agencias_servicios_list->DisplayRecs - 1)
		$agencias_servicios_list->StopRec = $agencias_servicios_list->StartRec + $agencias_servicios_list->DisplayRecs - 1;
	else
		$agencias_servicios_list->StopRec = $agencias_servicios_list->TotalRecs;
}
$agencias_servicios_list->RecCnt = $agencias_servicios_list->StartRec - 1;
if ($agencias_servicios_list->Recordset && !$agencias_servicios_list->Recordset->EOF) {
	$agencias_servicios_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $agencias_servicios_list->StartRec > 1)
		$agencias_servicios_list->Recordset->Move($agencias_servicios_list->StartRec - 1);
} elseif (!$agencias_servicios->AllowAddDeleteRow && $agencias_servicios_list->StopRec == 0) {
	$agencias_servicios_list->StopRec = $agencias_servicios->GridAddRowCount;
}

// Initialize aggregate
$agencias_servicios->RowType = EW_ROWTYPE_AGGREGATEINIT;
$agencias_servicios->ResetAttrs();
$agencias_servicios_list->RenderRow();
$agencias_servicios_list->RowCnt = 0;
while ($agencias_servicios_list->RecCnt < $agencias_servicios_list->StopRec) {
	$agencias_servicios_list->RecCnt++;
	if (intval($agencias_servicios_list->RecCnt) >= intval($agencias_servicios_list->StartRec)) {
		$agencias_servicios_list->RowCnt++;

		// Set up key count
		$agencias_servicios_list->KeyCount = $agencias_servicios_list->RowIndex;

		// Init row class and style
		$agencias_servicios->ResetAttrs();
		$agencias_servicios->CssClass = "";
		if ($agencias_servicios->CurrentAction == "gridadd") {
		} else {
			$agencias_servicios_list->LoadRowValues($agencias_servicios_list->Recordset); // Load row values
		}
		$agencias_servicios->RowType = EW_ROWTYPE_VIEW; // Render view
		$agencias_servicios->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$agencias_servicios_list->RenderRow();

		// Render list options
		$agencias_servicios_list->RenderListOptions();
?>
	<tr<?php echo $agencias_servicios->RowAttributes() ?>>
<?php

// Render list options (body, left)
$agencias_servicios_list->ListOptions->Render("body", "left");
?>
	<?php if ($agencias_servicios->id_servicio->Visible) { // id_servicio ?>
		<td<?php echo $agencias_servicios->id_servicio->CellAttributes() ?>>
<div<?php echo $agencias_servicios->id_servicio->ViewAttributes() ?>><?php echo $agencias_servicios->id_servicio->ListViewValue() ?></div>
<a name="<?php echo $agencias_servicios_list->PageObjName . "_row_" . $agencias_servicios_list->RowCnt ?>" id="<?php echo $agencias_servicios_list->PageObjName . "_row_" . $agencias_servicios_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($agencias_servicios->estatus->Visible) { // estatus ?>
		<td<?php echo $agencias_servicios->estatus->CellAttributes() ?>>
<div<?php echo $agencias_servicios->estatus->ViewAttributes() ?>><?php echo $agencias_servicios->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agencias_servicios_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($agencias_servicios->CurrentAction <> "gridadd")
		$agencias_servicios_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($agencias_servicios_list->Recordset)
	$agencias_servicios_list->Recordset->Close();
?>
<?php if ($agencias_servicios->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($agencias_servicios->CurrentAction <> "gridadd" && $agencias_servicios->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($agencias_servicios_list->Pager)) $agencias_servicios_list->Pager = new cPrevNextPager($agencias_servicios_list->StartRec, $agencias_servicios_list->DisplayRecs, $agencias_servicios_list->TotalRecs) ?>
<?php if ($agencias_servicios_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($agencias_servicios_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $agencias_servicios_list->PageUrl() ?>start=<?php echo $agencias_servicios_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($agencias_servicios_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $agencias_servicios_list->PageUrl() ?>start=<?php echo $agencias_servicios_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $agencias_servicios_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($agencias_servicios_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $agencias_servicios_list->PageUrl() ?>start=<?php echo $agencias_servicios_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($agencias_servicios_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $agencias_servicios_list->PageUrl() ?>start=<?php echo $agencias_servicios_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $agencias_servicios_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $agencias_servicios_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $agencias_servicios_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $agencias_servicios_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($agencias_servicios_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $agencias_servicios_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($agencias_servicios->Export == "" && $agencias_servicios->CurrentAction == "") { ?>
<?php } ?>
<?php
$agencias_servicios_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($agencias_servicios->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$agencias_servicios_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cagencias_servicios_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'agencias_servicios';

	// Page object name
	var $PageObjName = 'agencias_servicios_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $agencias_servicios;
		if ($agencias_servicios->UseTokenInUrl) $PageUrl .= "t=" . $agencias_servicios->TableVar . "&"; // Add page token
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
		global $objForm, $agencias_servicios;
		if ($agencias_servicios->UseTokenInUrl) {
			if ($objForm)
				return ($agencias_servicios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($agencias_servicios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cagencias_servicios_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (agencias_servicios)
		if (!isset($GLOBALS["agencias_servicios"])) {
			$GLOBALS["agencias_servicios"] = new cagencias_servicios();
			$GLOBALS["Table"] =& $GLOBALS["agencias_servicios"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "agencias_serviciosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "agencias_serviciosdelete.php";
		$this->MultiUpdateUrl = "agencias_serviciosupdate.php";

		// Table object (agencias)
		if (!isset($GLOBALS['agencias'])) $GLOBALS['agencias'] = new cagencias();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'agencias_servicios', TRUE);

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
		global $agencias_servicios;

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
			$agencias_servicios->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $agencias_servicios;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Hide all options
			if ($agencias_servicios->Export <> "" ||
				$agencias_servicios->CurrentAction == "gridadd" ||
				$agencias_servicios->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($agencias_servicios->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $agencias_servicios->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $agencias_servicios->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $agencias_servicios->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($agencias_servicios->getMasterFilter() <> "" && $agencias_servicios->getCurrentMasterTable() == "agencias") {
			global $agencias;
			$rsmaster = $agencias->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($agencias_servicios->getReturnUrl()); // Return to caller
			} else {
				$agencias->LoadListRowValues($rsmaster);
				$agencias->RowType = EW_ROWTYPE_MASTER; // Master row
				$agencias->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$agencias_servicios->setSessionWhere($sFilter);
		$agencias_servicios->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $agencias_servicios;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$agencias_servicios->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$agencias_servicios->CurrentOrderType = @$_GET["ordertype"];
			$agencias_servicios->UpdateSort($agencias_servicios->id_servicio); // id_servicio
			$agencias_servicios->UpdateSort($agencias_servicios->estatus); // estatus
			$agencias_servicios->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $agencias_servicios;
		$sOrderBy = $agencias_servicios->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($agencias_servicios->SqlOrderBy() <> "") {
				$sOrderBy = $agencias_servicios->SqlOrderBy();
				$agencias_servicios->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $agencias_servicios;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$agencias_servicios->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$agencias_servicios->id_agencias->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$agencias_servicios->setSessionOrderBy($sOrderBy);
				$agencias_servicios->id_servicio->setSort("");
				$agencias_servicios->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$agencias_servicios->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $agencias_servicios;

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
		global $Security, $Language, $agencias_servicios, $objForm;
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
		global $Security, $Language, $agencias_servicios;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $agencias_servicios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$agencias_servicios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$agencias_servicios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $agencias_servicios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$agencias_servicios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$agencias_servicios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$agencias_servicios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $agencias_servicios;

		// Call Recordset Selecting event
		$agencias_servicios->Recordset_Selecting($agencias_servicios->CurrentFilter);

		// Load List page SQL
		$sSql = $agencias_servicios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$agencias_servicios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $agencias_servicios;
		$sFilter = $agencias_servicios->KeyFilter();

		// Call Row Selecting event
		$agencias_servicios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$agencias_servicios->CurrentFilter = $sFilter;
		$sSql = $agencias_servicios->SQL();
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
		global $conn, $agencias_servicios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$agencias_servicios->Row_Selected($row);
		$agencias_servicios->id_agencias_servicios->setDbValue($rs->fields('id_agencias_servicios'));
		$agencias_servicios->id_agencias->setDbValue($rs->fields('id_agencias'));
		$agencias_servicios->id_servicio->setDbValue($rs->fields('id_servicio'));
		$agencias_servicios->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $agencias_servicios;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($agencias_servicios->getKey("id_agencias_servicios")) <> "")
			$agencias_servicios->id_agencias_servicios->CurrentValue = $agencias_servicios->getKey("id_agencias_servicios"); // id_agencias_servicios
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$agencias_servicios->CurrentFilter = $agencias_servicios->KeyFilter();
			$sSql = $agencias_servicios->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $agencias_servicios;

		// Initialize URLs
		$this->ViewUrl = $agencias_servicios->ViewUrl();
		$this->EditUrl = $agencias_servicios->EditUrl();
		$this->InlineEditUrl = $agencias_servicios->InlineEditUrl();
		$this->CopyUrl = $agencias_servicios->CopyUrl();
		$this->InlineCopyUrl = $agencias_servicios->InlineCopyUrl();
		$this->DeleteUrl = $agencias_servicios->DeleteUrl();

		// Call Row_Rendering event
		$agencias_servicios->Row_Rendering();

		// Common render codes for all row types
		// id_agencias_servicios
		// id_agencias
		// id_servicio
		// estatus

		if ($agencias_servicios->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_agencias
			if (strval($agencias_servicios->id_agencias->CurrentValue) <> "") {
				$sFilterWrk = "`id_agencias` = " . ew_AdjustSql($agencias_servicios->id_agencias->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre`, `direccion` FROM `agencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias_servicios->id_agencias->ViewValue = $rswrk->fields('nombre');
					$agencias_servicios->id_agencias->ViewValue .= ew_ValueSeparator(0,1,$agencias_servicios->id_agencias) . $rswrk->fields('direccion');
					$rswrk->Close();
				} else {
					$agencias_servicios->id_agencias->ViewValue = $agencias_servicios->id_agencias->CurrentValue;
				}
			} else {
				$agencias_servicios->id_agencias->ViewValue = NULL;
			}
			$agencias_servicios->id_agencias->ViewCustomAttributes = "";

			// id_servicio
			if (strval($agencias_servicios->id_servicio->CurrentValue) <> "") {
				$sFilterWrk = "`id_servicios` = " . ew_AdjustSql($agencias_servicios->id_servicio->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `servicios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias_servicios->id_servicio->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$agencias_servicios->id_servicio->ViewValue = $agencias_servicios->id_servicio->CurrentValue;
				}
			} else {
				$agencias_servicios->id_servicio->ViewValue = NULL;
			}
			$agencias_servicios->id_servicio->ViewCustomAttributes = "";

			// estatus
			if (strval($agencias_servicios->estatus->CurrentValue) <> "") {
				switch ($agencias_servicios->estatus->CurrentValue) {
					case "1":
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->FldTagCaption(1) <> "" ? $agencias_servicios->estatus->FldTagCaption(1) : $agencias_servicios->estatus->CurrentValue;
						break;
					case "0":
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->FldTagCaption(2) <> "" ? $agencias_servicios->estatus->FldTagCaption(2) : $agencias_servicios->estatus->CurrentValue;
						break;
					default:
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->CurrentValue;
				}
			} else {
				$agencias_servicios->estatus->ViewValue = NULL;
			}
			$agencias_servicios->estatus->ViewCustomAttributes = "";

			// id_servicio
			$agencias_servicios->id_servicio->LinkCustomAttributes = "";
			$agencias_servicios->id_servicio->HrefValue = "";
			$agencias_servicios->id_servicio->TooltipValue = "";

			// estatus
			$agencias_servicios->estatus->LinkCustomAttributes = "";
			$agencias_servicios->estatus->HrefValue = "";
			$agencias_servicios->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($agencias_servicios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$agencias_servicios->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $agencias_servicios;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "agencias") {
				$bValidMaster = TRUE;
				if (@$_GET["id_agencias"] <> "") {
					$GLOBALS["agencias"]->id_agencias->setQueryStringValue($_GET["id_agencias"]);
					$agencias_servicios->id_agencias->setQueryStringValue($GLOBALS["agencias"]->id_agencias->QueryStringValue);
					$agencias_servicios->id_agencias->setSessionValue($agencias_servicios->id_agencias->QueryStringValue);
					if (!is_numeric($GLOBALS["agencias"]->id_agencias->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$agencias_servicios->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$agencias_servicios->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "agencias") {
				if ($agencias_servicios->id_agencias->QueryStringValue == "") $agencias_servicios->id_agencias->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $agencias_servicios->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $agencias_servicios->getDetailFilter(); // Get detail filter
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
		$table = 'agencias_servicios';
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
