<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "serviciosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$servicios_view = new cservicios_view();
$Page =& $servicios_view;

// Page init
$servicios_view->Page_Init();

// Page main
$servicios_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($servicios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var servicios_view = new ew_Page("servicios_view");

// page properties
servicios_view.PageID = "view"; // page ID
servicios_view.FormID = "fserviciosview"; // form ID
var EW_PAGE_ID = servicios_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
servicios_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
servicios_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
servicios_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $servicios->TableCaption() ?>
&nbsp;&nbsp;<?php $servicios_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($servicios->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $servicios_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $servicios_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $servicios_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $servicios_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $servicios_view->ShowPageHeader(); ?>
<?php
$servicios_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($servicios->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $servicios->nombre->FldCaption() ?></td>
		<td<?php echo $servicios->nombre->CellAttributes() ?>>
<div<?php echo $servicios->nombre->ViewAttributes() ?>><?php echo $servicios->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($servicios->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $servicios->imagen->FldCaption() ?></td>
		<td<?php echo $servicios->imagen->CellAttributes() ?>>
<?php if ($servicios->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $servicios->imagen->UploadPath) . $servicios->imagen->Upload->DbValue ?>" border=0<?php echo $servicios->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($servicios->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $servicios->imagen->UploadPath) . $servicios->imagen->Upload->DbValue ?>" border=0<?php echo $servicios->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($servicios->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($servicios->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $servicios->estatus->FldCaption() ?></td>
		<td<?php echo $servicios->estatus->CellAttributes() ?>>
<div<?php echo $servicios->estatus->ViewAttributes() ?>><?php echo $servicios->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$servicios_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($servicios->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$servicios_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cservicios_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'servicios';

	// Page object name
	var $PageObjName = 'servicios_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $servicios;
		if ($servicios->UseTokenInUrl) $PageUrl .= "t=" . $servicios->TableVar . "&"; // Add page token
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
		global $objForm, $servicios;
		if ($servicios->UseTokenInUrl) {
			if ($objForm)
				return ($servicios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($servicios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cservicios_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (servicios)
		if (!isset($GLOBALS["servicios"])) {
			$GLOBALS["servicios"] = new cservicios();
			$GLOBALS["Table"] =& $GLOBALS["servicios"];
		}
		$KeyUrl = "";
		if (@$_GET["id_servicios"] <> "") {
			$this->RecKey["id_servicios"] = $_GET["id_servicios"];
			$KeyUrl .= "&id_servicios=" . urlencode($this->RecKey["id_servicios"]);
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
			define("EW_TABLE_NAME", 'servicios', TRUE);

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
		global $servicios;

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
			$this->Page_Terminate("servicioslist.php");
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
		global $Language, $servicios;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_servicios"] <> "") {
				$servicios->id_servicios->setQueryStringValue($_GET["id_servicios"]);
				$this->RecKey["id_servicios"] = $servicios->id_servicios->QueryStringValue;
			} else {
				$sReturnUrl = "servicioslist.php"; // Return to list
			}

			// Get action
			$servicios->CurrentAction = "I"; // Display form
			switch ($servicios->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "servicioslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "servicioslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$servicios->RowType = EW_ROWTYPE_VIEW;
		$servicios->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $servicios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$servicios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$servicios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $servicios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$servicios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$servicios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$servicios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $servicios;
		$sFilter = $servicios->KeyFilter();

		// Call Row Selecting event
		$servicios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$servicios->CurrentFilter = $sFilter;
		$sSql = $servicios->SQL();
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
		global $conn, $servicios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$servicios->Row_Selected($row);
		$servicios->id_servicios->setDbValue($rs->fields('id_servicios'));
		$servicios->nombre->setDbValue($rs->fields('nombre'));
		$servicios->imagen->Upload->DbValue = $rs->fields('imagen');
		$servicios->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $servicios;

		// Initialize URLs
		$this->AddUrl = $servicios->AddUrl();
		$this->EditUrl = $servicios->EditUrl();
		$this->CopyUrl = $servicios->CopyUrl();
		$this->DeleteUrl = $servicios->DeleteUrl();
		$this->ListUrl = $servicios->ListUrl();

		// Call Row_Rendering event
		$servicios->Row_Rendering();

		// Common render codes for all row types
		// id_servicios
		// nombre
		// imagen
		// estatus

		if ($servicios->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$servicios->nombre->ViewValue = $servicios->nombre->CurrentValue;
			$servicios->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($servicios->imagen->Upload->DbValue)) {
				$servicios->imagen->ViewValue = $servicios->imagen->Upload->DbValue;
				$servicios->imagen->ImageWidth = 30;
				$servicios->imagen->ImageHeight = 30;
				$servicios->imagen->ImageAlt = $servicios->imagen->FldAlt();
			} else {
				$servicios->imagen->ViewValue = "";
			}
			$servicios->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($servicios->estatus->CurrentValue) <> "") {
				switch ($servicios->estatus->CurrentValue) {
					case "0":
						$servicios->estatus->ViewValue = $servicios->estatus->FldTagCaption(1) <> "" ? $servicios->estatus->FldTagCaption(1) : $servicios->estatus->CurrentValue;
						break;
					case "1":
						$servicios->estatus->ViewValue = $servicios->estatus->FldTagCaption(2) <> "" ? $servicios->estatus->FldTagCaption(2) : $servicios->estatus->CurrentValue;
						break;
					default:
						$servicios->estatus->ViewValue = $servicios->estatus->CurrentValue;
				}
			} else {
				$servicios->estatus->ViewValue = NULL;
			}
			$servicios->estatus->ViewCustomAttributes = "";

			// nombre
			$servicios->nombre->LinkCustomAttributes = "";
			$servicios->nombre->HrefValue = "";
			$servicios->nombre->TooltipValue = "";

			// imagen
			$servicios->imagen->LinkCustomAttributes = "";
			$servicios->imagen->HrefValue = "";
			$servicios->imagen->TooltipValue = "";

			// estatus
			$servicios->estatus->LinkCustomAttributes = "";
			$servicios->estatus->HrefValue = "";
			$servicios->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($servicios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$servicios->Row_Rendered();
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
