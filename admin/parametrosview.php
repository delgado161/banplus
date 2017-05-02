<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "parametrosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$parametros_view = new cparametros_view();
$Page =& $parametros_view;

// Page init
$parametros_view->Page_Init();

// Page main
$parametros_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($parametros->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var parametros_view = new ew_Page("parametros_view");

// page properties
parametros_view.PageID = "view"; // page ID
parametros_view.FormID = "fparametrosview"; // form ID
var EW_PAGE_ID = parametros_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
parametros_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
parametros_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
parametros_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $parametros->TableCaption() ?>
&nbsp;&nbsp;<?php $parametros_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($parametros->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $parametros_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $parametros_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $parametros_view->ShowPageHeader(); ?>
<?php
$parametros_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($parametros->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $parametros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $parametros->nombre->FldCaption() ?></td>
		<td<?php echo $parametros->nombre->CellAttributes() ?>>
<div<?php echo $parametros->nombre->ViewAttributes() ?>><?php echo $parametros->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parametros->valor->Visible) { // valor ?>
	<tr id="r_valor"<?php echo $parametros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $parametros->valor->FldCaption() ?></td>
		<td<?php echo $parametros->valor->CellAttributes() ?>>
<div<?php echo $parametros->valor->ViewAttributes() ?>><?php echo $parametros->valor->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parametros->archivo->Visible) { // archivo ?>
	<tr id="r_archivo"<?php echo $parametros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $parametros->archivo->FldCaption() ?></td>
		<td<?php echo $parametros->archivo->CellAttributes() ?>>
<?php if ($parametros->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($parametros->archivo->Upload->DbValue)) { ?>
<a<?php echo $parametros->archivo->LinkAttributes() ?>><?php echo $parametros->archivo->ViewValue ?></a>
<?php } elseif (!in_array($parametros->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($parametros->archivo->Upload->DbValue)) { ?>
<?php echo $parametros->archivo->ViewValue ?>
<?php } elseif (!in_array($parametros->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$parametros_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($parametros->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$parametros_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cparametros_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'parametros';

	// Page object name
	var $PageObjName = 'parametros_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $parametros;
		if ($parametros->UseTokenInUrl) $PageUrl .= "t=" . $parametros->TableVar . "&"; // Add page token
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
		global $objForm, $parametros;
		if ($parametros->UseTokenInUrl) {
			if ($objForm)
				return ($parametros->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($parametros->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cparametros_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (parametros)
		if (!isset($GLOBALS["parametros"])) {
			$GLOBALS["parametros"] = new cparametros();
			$GLOBALS["Table"] =& $GLOBALS["parametros"];
		}
		$KeyUrl = "";
		if (@$_GET["id_parametro"] <> "") {
			$this->RecKey["id_parametro"] = $_GET["id_parametro"];
			$KeyUrl .= "&id_parametro=" . urlencode($this->RecKey["id_parametro"]);
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
			define("EW_TABLE_NAME", 'parametros', TRUE);

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
		global $parametros;

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
			$this->Page_Terminate("parametroslist.php");
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
		global $Language, $parametros;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_parametro"] <> "") {
				$parametros->id_parametro->setQueryStringValue($_GET["id_parametro"]);
				$this->RecKey["id_parametro"] = $parametros->id_parametro->QueryStringValue;
			} else {
				$sReturnUrl = "parametroslist.php"; // Return to list
			}

			// Get action
			$parametros->CurrentAction = "I"; // Display form
			switch ($parametros->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "parametroslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "parametroslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$parametros->RowType = EW_ROWTYPE_VIEW;
		$parametros->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $parametros;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$parametros->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$parametros->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $parametros->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$parametros->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$parametros->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$parametros->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $parametros;
		$sFilter = $parametros->KeyFilter();

		// Call Row Selecting event
		$parametros->Row_Selecting($sFilter);

		// Load SQL based on filter
		$parametros->CurrentFilter = $sFilter;
		$sSql = $parametros->SQL();
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
		global $conn, $parametros;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$parametros->Row_Selected($row);
		$parametros->id_parametro->setDbValue($rs->fields('id_parametro'));
		$parametros->nombre->setDbValue($rs->fields('nombre'));
		$parametros->valor->setDbValue($rs->fields('valor'));
		$parametros->archivo->Upload->DbValue = $rs->fields('archivo');
		$parametros->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $parametros;

		// Initialize URLs
		$this->AddUrl = $parametros->AddUrl();
		$this->EditUrl = $parametros->EditUrl();
		$this->CopyUrl = $parametros->CopyUrl();
		$this->DeleteUrl = $parametros->DeleteUrl();
		$this->ListUrl = $parametros->ListUrl();

		// Call Row_Rendering event
		$parametros->Row_Rendering();

		// Common render codes for all row types
		// id_parametro
		// nombre
		// valor
		// archivo
		// estatus

		if ($parametros->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$parametros->nombre->ViewValue = $parametros->nombre->CurrentValue;
			$parametros->nombre->ViewCustomAttributes = "";

			// valor
			$parametros->valor->ViewValue = $parametros->valor->CurrentValue;
			$parametros->valor->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($parametros->archivo->Upload->DbValue)) {
				$parametros->archivo->ViewValue = $parametros->archivo->Upload->DbValue;
			} else {
				$parametros->archivo->ViewValue = "";
			}
			$parametros->archivo->ViewCustomAttributes = "";

			// nombre
			$parametros->nombre->LinkCustomAttributes = "";
			$parametros->nombre->HrefValue = "";
			$parametros->nombre->TooltipValue = "";

			// valor
			$parametros->valor->LinkCustomAttributes = "";
			$parametros->valor->HrefValue = "";
			$parametros->valor->TooltipValue = "";

			// archivo
			$parametros->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($parametros->archivo->Upload->DbValue)) {
				$parametros->archivo->HrefValue = ew_UploadPathEx(FALSE, $parametros->archivo->UploadPath) . ((!empty($parametros->archivo->ViewValue)) ? $parametros->archivo->ViewValue : $parametros->archivo->CurrentValue); // Add prefix/suffix
				$parametros->archivo->LinkAttrs["target"] = ""; // Add target
				if ($parametros->Export <> "") $parametros->archivo->HrefValue = ew_ConvertFullUrl($parametros->archivo->HrefValue);
			} else {
				$parametros->archivo->HrefValue = "";
			}
			$parametros->archivo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($parametros->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$parametros->Row_Rendered();
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
