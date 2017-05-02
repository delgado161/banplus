<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modulosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$modulos_view = new cmodulos_view();
$Page =& $modulos_view;

// Page init
$modulos_view->Page_Init();

// Page main
$modulos_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($modulos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var modulos_view = new ew_Page("modulos_view");

// page properties
modulos_view.PageID = "view"; // page ID
modulos_view.FormID = "fmodulosview"; // form ID
var EW_PAGE_ID = modulos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
modulos_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
modulos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
modulos_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $modulos->TableCaption() ?>
&nbsp;&nbsp;<?php $modulos_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($modulos->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $modulos_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php } ?>
</p>
<?php $modulos_view->ShowPageHeader(); ?>
<?php
$modulos_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($modulos->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $modulos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos->nombre->FldCaption() ?></td>
		<td<?php echo $modulos->nombre->CellAttributes() ?>>
<div<?php echo $modulos->nombre->ViewAttributes() ?>><?php echo $modulos->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($modulos->plantilla->Visible) { // plantilla ?>
	<tr id="r_plantilla"<?php echo $modulos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos->plantilla->FldCaption() ?></td>
		<td<?php echo $modulos->plantilla->CellAttributes() ?>>
<?php if ($modulos->plantilla->LinkAttributes() <> "") { ?>
<?php if (!empty($modulos->plantilla->Upload->DbValue)) { ?>
<a<?php echo $modulos->plantilla->LinkAttributes() ?>><?php echo $modulos->plantilla->ViewValue ?></a>
<?php } elseif (!in_array($modulos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($modulos->plantilla->Upload->DbValue)) { ?>
<?php echo $modulos->plantilla->ViewValue ?>
<?php } elseif (!in_array($modulos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($modulos->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $modulos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos->estatus->FldCaption() ?></td>
		<td<?php echo $modulos->estatus->CellAttributes() ?>>
<div<?php echo $modulos->estatus->ViewAttributes() ?>><?php echo $modulos->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$modulos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($modulos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$modulos_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodulos_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'modulos';

	// Page object name
	var $PageObjName = 'modulos_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $modulos;
		if ($modulos->UseTokenInUrl) $PageUrl .= "t=" . $modulos->TableVar . "&"; // Add page token
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
		global $objForm, $modulos;
		if ($modulos->UseTokenInUrl) {
			if ($objForm)
				return ($modulos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($modulos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodulos_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (modulos)
		if (!isset($GLOBALS["modulos"])) {
			$GLOBALS["modulos"] = new cmodulos();
			$GLOBALS["Table"] =& $GLOBALS["modulos"];
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

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'modulos', TRUE);

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
		global $modulos;

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
			$this->Page_Terminate("moduloslist.php");
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
		global $Language, $modulos;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_modulo_financiero"] <> "") {
				$modulos->id_modulo_financiero->setQueryStringValue($_GET["id_modulo_financiero"]);
				$this->RecKey["id_modulo_financiero"] = $modulos->id_modulo_financiero->QueryStringValue;
			} else {
				$sReturnUrl = "moduloslist.php"; // Return to list
			}

			// Get action
			$modulos->CurrentAction = "I"; // Display form
			switch ($modulos->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "moduloslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "moduloslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$modulos->RowType = EW_ROWTYPE_VIEW;
		$modulos->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $modulos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$modulos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$modulos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $modulos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$modulos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$modulos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$modulos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $modulos;
		$sFilter = $modulos->KeyFilter();

		// Call Row Selecting event
		$modulos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$modulos->CurrentFilter = $sFilter;
		$sSql = $modulos->SQL();
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
		global $conn, $modulos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$modulos->Row_Selected($row);
		$modulos->id_modulo_financiero->setDbValue($rs->fields('id_modulo_financiero'));
		$modulos->nombre->setDbValue($rs->fields('nombre'));
		$modulos->plantilla->Upload->DbValue = $rs->fields('plantilla');
		$modulos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $modulos;

		// Initialize URLs
		$this->AddUrl = $modulos->AddUrl();
		$this->EditUrl = $modulos->EditUrl();
		$this->CopyUrl = $modulos->CopyUrl();
		$this->DeleteUrl = $modulos->DeleteUrl();
		$this->ListUrl = $modulos->ListUrl();

		// Call Row_Rendering event
		$modulos->Row_Rendering();

		// Common render codes for all row types
		// id_modulo_financiero
		// nombre
		// plantilla
		// estatus

		if ($modulos->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$modulos->nombre->ViewValue = $modulos->nombre->CurrentValue;
			$modulos->nombre->ViewCustomAttributes = "";

			// plantilla
			if (!ew_Empty($modulos->plantilla->Upload->DbValue)) {
				$modulos->plantilla->ViewValue = $modulos->plantilla->Upload->DbValue;
			} else {
				$modulos->plantilla->ViewValue = "";
			}
			$modulos->plantilla->ViewCustomAttributes = "";

			// estatus
			if (strval($modulos->estatus->CurrentValue) <> "") {
				switch ($modulos->estatus->CurrentValue) {
					case "1":
						$modulos->estatus->ViewValue = $modulos->estatus->FldTagCaption(1) <> "" ? $modulos->estatus->FldTagCaption(1) : $modulos->estatus->CurrentValue;
						break;
					case "0":
						$modulos->estatus->ViewValue = $modulos->estatus->FldTagCaption(2) <> "" ? $modulos->estatus->FldTagCaption(2) : $modulos->estatus->CurrentValue;
						break;
					default:
						$modulos->estatus->ViewValue = $modulos->estatus->CurrentValue;
				}
			} else {
				$modulos->estatus->ViewValue = NULL;
			}
			$modulos->estatus->ViewCustomAttributes = "";

			// nombre
			$modulos->nombre->LinkCustomAttributes = "";
			$modulos->nombre->HrefValue = "";
			$modulos->nombre->TooltipValue = "";

			// plantilla
			$modulos->plantilla->LinkCustomAttributes = "";
			if (!ew_Empty($modulos->plantilla->Upload->DbValue)) {
				$modulos->plantilla->HrefValue = ew_UploadPathEx(FALSE, $modulos->plantilla->UploadPath) . ((!empty($modulos->plantilla->ViewValue)) ? $modulos->plantilla->ViewValue : $modulos->plantilla->CurrentValue); // Add prefix/suffix
				$modulos->plantilla->LinkAttrs["target"] = ""; // Add target
				if ($modulos->Export <> "") $modulos->plantilla->HrefValue = ew_ConvertFullUrl($modulos->plantilla->HrefValue);
			} else {
				$modulos->plantilla->HrefValue = "";
			}
			$modulos->plantilla->TooltipValue = "";

			// estatus
			$modulos->estatus->LinkCustomAttributes = "";
			$modulos->estatus->HrefValue = "";
			$modulos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($modulos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$modulos->Row_Rendered();
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
