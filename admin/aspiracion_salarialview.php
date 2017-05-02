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
$aspiracion_salarial_view = new caspiracion_salarial_view();
$Page =& $aspiracion_salarial_view;

// Page init
$aspiracion_salarial_view->Page_Init();

// Page main
$aspiracion_salarial_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($aspiracion_salarial->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var aspiracion_salarial_view = new ew_Page("aspiracion_salarial_view");

// page properties
aspiracion_salarial_view.PageID = "view"; // page ID
aspiracion_salarial_view.FormID = "faspiracion_salarialview"; // form ID
var EW_PAGE_ID = aspiracion_salarial_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
aspiracion_salarial_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
aspiracion_salarial_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
aspiracion_salarial_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $aspiracion_salarial->TableCaption() ?>
&nbsp;&nbsp;<?php $aspiracion_salarial_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($aspiracion_salarial->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $aspiracion_salarial_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $aspiracion_salarial_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $aspiracion_salarial_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $aspiracion_salarial_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $aspiracion_salarial_view->ShowPageHeader(); ?>
<?php
$aspiracion_salarial_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($aspiracion_salarial->valor->Visible) { // valor ?>
	<tr id="r_valor"<?php echo $aspiracion_salarial->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $aspiracion_salarial->valor->FldCaption() ?></td>
		<td<?php echo $aspiracion_salarial->valor->CellAttributes() ?>>
<div<?php echo $aspiracion_salarial->valor->ViewAttributes() ?>><?php echo $aspiracion_salarial->valor->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($aspiracion_salarial->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $aspiracion_salarial->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $aspiracion_salarial->orden->FldCaption() ?></td>
		<td<?php echo $aspiracion_salarial->orden->CellAttributes() ?>>
<div<?php echo $aspiracion_salarial->orden->ViewAttributes() ?>><?php echo $aspiracion_salarial->orden->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$aspiracion_salarial_view->ShowPageFooter();
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
$aspiracion_salarial_view->Page_Terminate();
?>
<?php

//
// Page class
//
class caspiracion_salarial_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'aspiracion_salarial';

	// Page object name
	var $PageObjName = 'aspiracion_salarial_view';

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
	function caspiracion_salarial_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (aspiracion_salarial)
		if (!isset($GLOBALS["aspiracion_salarial"])) {
			$GLOBALS["aspiracion_salarial"] = new caspiracion_salarial();
			$GLOBALS["Table"] =& $GLOBALS["aspiracion_salarial"];
		}
		$KeyUrl = "";
		if (@$_GET["id_aspiracion_salarial"] <> "") {
			$this->RecKey["id_aspiracion_salarial"] = $_GET["id_aspiracion_salarial"];
			$KeyUrl .= "&id_aspiracion_salarial=" . urlencode($this->RecKey["id_aspiracion_salarial"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'aspiracion_salarial', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("aspiracion_salariallist.php");
		}

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
	var $ExportOptions; // Export options
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $aspiracion_salarial;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_aspiracion_salarial"] <> "") {
				$aspiracion_salarial->id_aspiracion_salarial->setQueryStringValue($_GET["id_aspiracion_salarial"]);
				$this->RecKey["id_aspiracion_salarial"] = $aspiracion_salarial->id_aspiracion_salarial->QueryStringValue;
			} else {
				$sReturnUrl = "aspiracion_salariallist.php"; // Return to list
			}

			// Get action
			$aspiracion_salarial->CurrentAction = "I"; // Display form
			switch ($aspiracion_salarial->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "aspiracion_salariallist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "aspiracion_salariallist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$aspiracion_salarial->RowType = EW_ROWTYPE_VIEW;
		$aspiracion_salarial->ResetAttrs();
		$this->RenderRow();
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

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $aspiracion_salarial;

		// Initialize URLs
		$this->AddUrl = $aspiracion_salarial->AddUrl();
		$this->EditUrl = $aspiracion_salarial->EditUrl();
		$this->CopyUrl = $aspiracion_salarial->CopyUrl();
		$this->DeleteUrl = $aspiracion_salarial->DeleteUrl();
		$this->ListUrl = $aspiracion_salarial->ListUrl();

		// Call Row_Rendering event
		$aspiracion_salarial->Row_Rendering();

		// Common render codes for all row types
		// id_aspiracion_salarial
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
}
?>
