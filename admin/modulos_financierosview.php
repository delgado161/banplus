<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modulos_financierosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$modulos_financieros_view = new cmodulos_financieros_view();
$Page =& $modulos_financieros_view;

// Page init
$modulos_financieros_view->Page_Init();

// Page main
$modulos_financieros_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($modulos_financieros->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var modulos_financieros_view = new ew_Page("modulos_financieros_view");

// page properties
modulos_financieros_view.PageID = "view"; // page ID
modulos_financieros_view.FormID = "fmodulos_financierosview"; // form ID
var EW_PAGE_ID = modulos_financieros_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
modulos_financieros_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
modulos_financieros_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
modulos_financieros_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $modulos_financieros->TableCaption() ?>
&nbsp;&nbsp;<?php $modulos_financieros_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($modulos_financieros->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $modulos_financieros_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $modulos_financieros_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $modulos_financieros_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $modulos_financieros_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $modulos_financieros_view->ShowPageHeader(); ?>
<?php
$modulos_financieros_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($modulos_financieros->id_modulo_financiero->Visible) { // id_modulo_financiero ?>
	<tr id="r_id_modulo_financiero"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->id_modulo_financiero->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->id_modulo_financiero->CellAttributes() ?>>
<div<?php echo $modulos_financieros->id_modulo_financiero->ViewAttributes() ?>><?php echo $modulos_financieros->id_modulo_financiero->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($modulos_financieros->plantilla->Visible) { // plantilla ?>
	<tr id="r_plantilla"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->plantilla->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->plantilla->CellAttributes() ?>>
<div<?php echo $modulos_financieros->plantilla->ViewAttributes() ?>><?php echo $modulos_financieros->plantilla->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($modulos_financieros->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->nombre->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->nombre->CellAttributes() ?>>
<div<?php echo $modulos_financieros->nombre->ViewAttributes() ?>><?php echo $modulos_financieros->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($modulos_financieros->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->estatus->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->estatus->CellAttributes() ?>>
<div<?php echo $modulos_financieros->estatus->ViewAttributes() ?>><?php echo $modulos_financieros->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($modulos_financieros->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->orden->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->orden->CellAttributes() ?>>
<div<?php echo $modulos_financieros->orden->ViewAttributes() ?>><?php echo $modulos_financieros->orden->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$modulos_financieros_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($modulos_financieros->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$modulos_financieros_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodulos_financieros_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'modulos_financieros';

	// Page object name
	var $PageObjName = 'modulos_financieros_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $modulos_financieros;
		if ($modulos_financieros->UseTokenInUrl) $PageUrl .= "t=" . $modulos_financieros->TableVar . "&"; // Add page token
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
		global $objForm, $modulos_financieros;
		if ($modulos_financieros->UseTokenInUrl) {
			if ($objForm)
				return ($modulos_financieros->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($modulos_financieros->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodulos_financieros_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (modulos_financieros)
		if (!isset($GLOBALS["modulos_financieros"])) {
			$GLOBALS["modulos_financieros"] = new cmodulos_financieros();
			$GLOBALS["Table"] =& $GLOBALS["modulos_financieros"];
		}
		$KeyUrl = "";
		if (@$_GET["id_modulo_financiero"] <> "") {
			$this->RecKey["id_modulo_financiero"] = $_GET["id_modulo_financiero"];
			$KeyUrl .= "&id_modulo_financiero=" . urlencode($this->RecKey["id_modulo_financiero"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'modulos_financieros', TRUE);

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
		global $modulos_financieros;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $Language, $modulos_financieros;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_modulo_financiero"] <> "") {
				$modulos_financieros->id_modulo_financiero->setQueryStringValue($_GET["id_modulo_financiero"]);
				$this->RecKey["id_modulo_financiero"] = $modulos_financieros->id_modulo_financiero->QueryStringValue;
			} else {
				$sReturnUrl = "modulos_financieroslist.php"; // Return to list
			}

			// Get action
			$modulos_financieros->CurrentAction = "I"; // Display form
			switch ($modulos_financieros->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "modulos_financieroslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "modulos_financieroslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$modulos_financieros->RowType = EW_ROWTYPE_VIEW;
		$modulos_financieros->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $modulos_financieros;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$modulos_financieros->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$modulos_financieros->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $modulos_financieros->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$modulos_financieros->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$modulos_financieros->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$modulos_financieros->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $modulos_financieros;
		$sFilter = $modulos_financieros->KeyFilter();

		// Call Row Selecting event
		$modulos_financieros->Row_Selecting($sFilter);

		// Load SQL based on filter
		$modulos_financieros->CurrentFilter = $sFilter;
		$sSql = $modulos_financieros->SQL();
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
		global $conn, $modulos_financieros;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$modulos_financieros->Row_Selected($row);
		$modulos_financieros->id_modulo_financiero->setDbValue($rs->fields('id_modulo_financiero'));
		$modulos_financieros->plantilla->setDbValue($rs->fields('plantilla'));
		$modulos_financieros->nombre->setDbValue($rs->fields('nombre'));
		$modulos_financieros->estatus->setDbValue($rs->fields('estatus'));
		$modulos_financieros->orden->setDbValue($rs->fields('orden'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $modulos_financieros;

		// Initialize URLs
		$this->AddUrl = $modulos_financieros->AddUrl();
		$this->EditUrl = $modulos_financieros->EditUrl();
		$this->CopyUrl = $modulos_financieros->CopyUrl();
		$this->DeleteUrl = $modulos_financieros->DeleteUrl();
		$this->ListUrl = $modulos_financieros->ListUrl();

		// Call Row_Rendering event
		$modulos_financieros->Row_Rendering();

		// Common render codes for all row types
		// id_modulo_financiero
		// plantilla
		// nombre
		// estatus
		// orden

		if ($modulos_financieros->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_modulo_financiero
			$modulos_financieros->id_modulo_financiero->ViewValue = $modulos_financieros->id_modulo_financiero->CurrentValue;
			$modulos_financieros->id_modulo_financiero->ViewCustomAttributes = "";

			// plantilla
			$modulos_financieros->plantilla->ViewValue = $modulos_financieros->plantilla->CurrentValue;
			$modulos_financieros->plantilla->ViewCustomAttributes = "";

			// nombre
			$modulos_financieros->nombre->ViewValue = $modulos_financieros->nombre->CurrentValue;
			$modulos_financieros->nombre->ViewCustomAttributes = "";

			// estatus
			$modulos_financieros->estatus->ViewValue = $modulos_financieros->estatus->CurrentValue;
			$modulos_financieros->estatus->ViewCustomAttributes = "";

			// orden
			$modulos_financieros->orden->ViewValue = $modulos_financieros->orden->CurrentValue;
			$modulos_financieros->orden->ViewCustomAttributes = "";

			// id_modulo_financiero
			$modulos_financieros->id_modulo_financiero->LinkCustomAttributes = "";
			$modulos_financieros->id_modulo_financiero->HrefValue = "";
			$modulos_financieros->id_modulo_financiero->TooltipValue = "";

			// plantilla
			$modulos_financieros->plantilla->LinkCustomAttributes = "";
			$modulos_financieros->plantilla->HrefValue = "";
			$modulos_financieros->plantilla->TooltipValue = "";

			// nombre
			$modulos_financieros->nombre->LinkCustomAttributes = "";
			$modulos_financieros->nombre->HrefValue = "";
			$modulos_financieros->nombre->TooltipValue = "";

			// estatus
			$modulos_financieros->estatus->LinkCustomAttributes = "";
			$modulos_financieros->estatus->HrefValue = "";
			$modulos_financieros->estatus->TooltipValue = "";

			// orden
			$modulos_financieros->orden->LinkCustomAttributes = "";
			$modulos_financieros->orden->HrefValue = "";
			$modulos_financieros->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($modulos_financieros->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$modulos_financieros->Row_Rendered();
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
