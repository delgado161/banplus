<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "faqinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$faq_view = new cfaq_view();
$Page =& $faq_view;

// Page init
$faq_view->Page_Init();

// Page main
$faq_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($faq->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var faq_view = new ew_Page("faq_view");

// page properties
faq_view.PageID = "view"; // page ID
faq_view.FormID = "ffaqview"; // form ID
var EW_PAGE_ID = faq_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
faq_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
faq_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
faq_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $faq->TableCaption() ?>
&nbsp;&nbsp;<?php $faq_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($faq->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $faq_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $faq_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $faq_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $faq_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $faq_view->ShowPageHeader(); ?>
<?php
$faq_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($faq->pregunta->Visible) { // pregunta ?>
	<tr id="r_pregunta"<?php echo $faq->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $faq->pregunta->FldCaption() ?></td>
		<td<?php echo $faq->pregunta->CellAttributes() ?>>
<div<?php echo $faq->pregunta->ViewAttributes() ?>><?php echo $faq->pregunta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($faq->respuesta->Visible) { // respuesta ?>
	<tr id="r_respuesta"<?php echo $faq->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $faq->respuesta->FldCaption() ?></td>
		<td<?php echo $faq->respuesta->CellAttributes() ?>>
<div<?php echo $faq->respuesta->ViewAttributes() ?>><?php echo $faq->respuesta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($faq->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $faq->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $faq->estatus->FldCaption() ?></td>
		<td<?php echo $faq->estatus->CellAttributes() ?>>
<div<?php echo $faq->estatus->ViewAttributes() ?>><?php echo $faq->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$faq_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($faq->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$faq_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cfaq_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'faq';

	// Page object name
	var $PageObjName = 'faq_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $faq;
		if ($faq->UseTokenInUrl) $PageUrl .= "t=" . $faq->TableVar . "&"; // Add page token
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
		global $objForm, $faq;
		if ($faq->UseTokenInUrl) {
			if ($objForm)
				return ($faq->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($faq->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfaq_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (faq)
		if (!isset($GLOBALS["faq"])) {
			$GLOBALS["faq"] = new cfaq();
			$GLOBALS["Table"] =& $GLOBALS["faq"];
		}
		$KeyUrl = "";
		if (@$_GET["id_faq"] <> "") {
			$this->RecKey["id_faq"] = $_GET["id_faq"];
			$KeyUrl .= "&id_faq=" . urlencode($this->RecKey["id_faq"]);
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
			define("EW_TABLE_NAME", 'faq', TRUE);

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
		global $faq;

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
			$this->Page_Terminate("faqlist.php");
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
		global $Language, $faq;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_faq"] <> "") {
				$faq->id_faq->setQueryStringValue($_GET["id_faq"]);
				$this->RecKey["id_faq"] = $faq->id_faq->QueryStringValue;
			} else {
				$sReturnUrl = "faqlist.php"; // Return to list
			}

			// Get action
			$faq->CurrentAction = "I"; // Display form
			switch ($faq->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "faqlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "faqlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$faq->RowType = EW_ROWTYPE_VIEW;
		$faq->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $faq;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$faq->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$faq->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $faq->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$faq->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$faq->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$faq->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $faq;
		$sFilter = $faq->KeyFilter();

		// Call Row Selecting event
		$faq->Row_Selecting($sFilter);

		// Load SQL based on filter
		$faq->CurrentFilter = $sFilter;
		$sSql = $faq->SQL();
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
		global $conn, $faq;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$faq->Row_Selected($row);
		$faq->id_faq->setDbValue($rs->fields('id_faq'));
		$faq->pregunta->setDbValue($rs->fields('pregunta'));
		$faq->respuesta->setDbValue($rs->fields('respuesta'));
		$faq->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $faq;

		// Initialize URLs
		$this->AddUrl = $faq->AddUrl();
		$this->EditUrl = $faq->EditUrl();
		$this->CopyUrl = $faq->CopyUrl();
		$this->DeleteUrl = $faq->DeleteUrl();
		$this->ListUrl = $faq->ListUrl();

		// Call Row_Rendering event
		$faq->Row_Rendering();

		// Common render codes for all row types
		// id_faq
		// pregunta
		// respuesta
		// estatus

		if ($faq->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_faq
			$faq->id_faq->ViewValue = $faq->id_faq->CurrentValue;
			$faq->id_faq->ViewCustomAttributes = "";

			// pregunta
			$faq->pregunta->ViewValue = $faq->pregunta->CurrentValue;
			$faq->pregunta->ViewCustomAttributes = "";

			// respuesta
			$faq->respuesta->ViewValue = $faq->respuesta->CurrentValue;
			$faq->respuesta->ViewCustomAttributes = "";

			// estatus
			if (strval($faq->estatus->CurrentValue) <> "") {
				switch ($faq->estatus->CurrentValue) {
					case "1":
						$faq->estatus->ViewValue = $faq->estatus->FldTagCaption(1) <> "" ? $faq->estatus->FldTagCaption(1) : $faq->estatus->CurrentValue;
						break;
					case "0":
						$faq->estatus->ViewValue = $faq->estatus->FldTagCaption(2) <> "" ? $faq->estatus->FldTagCaption(2) : $faq->estatus->CurrentValue;
						break;
					default:
						$faq->estatus->ViewValue = $faq->estatus->CurrentValue;
				}
			} else {
				$faq->estatus->ViewValue = NULL;
			}
			$faq->estatus->ViewCustomAttributes = "";

			// pregunta
			$faq->pregunta->LinkCustomAttributes = "";
			$faq->pregunta->HrefValue = "";
			$faq->pregunta->TooltipValue = "";

			// respuesta
			$faq->respuesta->LinkCustomAttributes = "";
			$faq->respuesta->HrefValue = "";
			$faq->respuesta->TooltipValue = "";

			// estatus
			$faq->estatus->LinkCustomAttributes = "";
			$faq->estatus->HrefValue = "";
			$faq->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($faq->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$faq->Row_Rendered();
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
