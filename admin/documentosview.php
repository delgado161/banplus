<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documentos_view = new cdocumentos_view();
$Page =& $documentos_view;

// Page init
$documentos_view->Page_Init();

// Page main
$documentos_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($documentos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_view = new ew_Page("documentos_view");

// page properties
documentos_view.PageID = "view"; // page ID
documentos_view.FormID = "fdocumentosview"; // form ID
var EW_PAGE_ID = documentos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
documentos_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos->TableCaption() ?>
&nbsp;&nbsp;<?php $documentos_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($documentos->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $documentos_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $documentos_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $documentos_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $documentos_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('documentos_secciones')) { ?>
<a href="documentos_seccioneslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=documentos&id_documentos=<?php echo urlencode(strval($documentos->id_documentos->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("documentos_secciones", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $documentos_view->ShowPageHeader(); ?>
<?php
$documentos_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($documentos->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->titulo->FldCaption() ?></td>
		<td<?php echo $documentos->titulo->CellAttributes() ?>>
<div<?php echo $documentos->titulo->ViewAttributes() ?>><?php echo $documentos->titulo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documentos->sumario->Visible) { // sumario ?>
	<tr id="r_sumario"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->sumario->FldCaption() ?></td>
		<td<?php echo $documentos->sumario->CellAttributes() ?>>
<div<?php echo $documentos->sumario->ViewAttributes() ?>><?php echo $documentos->sumario->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documentos->documento->Visible) { // documento ?>
	<tr id="r_documento"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->documento->FldCaption() ?></td>
		<td<?php echo $documentos->documento->CellAttributes() ?>>
<?php if ($documentos->documento->LinkAttributes() <> "") { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<a<?php echo $documentos->documento->LinkAttributes() ?>><?php echo $documentos->documento->ViewValue ?></a>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<?php echo $documentos->documento->ViewValue ?>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($documentos->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->fecha->FldCaption() ?></td>
		<td<?php echo $documentos->fecha->CellAttributes() ?>>
<div<?php echo $documentos->fecha->ViewAttributes() ?>><?php echo $documentos->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documentos->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->estatus->FldCaption() ?></td>
		<td<?php echo $documentos->estatus->CellAttributes() ?>>
<div<?php echo $documentos->estatus->ViewAttributes() ?>><?php echo $documentos->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$documentos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($documentos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$documentos_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumentos_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'documentos';

	// Page object name
	var $PageObjName = 'documentos_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documentos;
		if ($documentos->UseTokenInUrl) $PageUrl .= "t=" . $documentos->TableVar . "&"; // Add page token
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
		global $objForm, $documentos;
		if ($documentos->UseTokenInUrl) {
			if ($objForm)
				return ($documentos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documentos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumentos_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documentos)
		if (!isset($GLOBALS["documentos"])) {
			$GLOBALS["documentos"] = new cdocumentos();
			$GLOBALS["Table"] =& $GLOBALS["documentos"];
		}
		$KeyUrl = "";
		if (@$_GET["id_documentos"] <> "") {
			$this->RecKey["id_documentos"] = $_GET["id_documentos"];
			$KeyUrl .= "&id_documentos=" . urlencode($this->RecKey["id_documentos"]);
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
			define("EW_TABLE_NAME", 'documentos', TRUE);

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
		global $documentos;

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
			$this->Page_Terminate("documentoslist.php");
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
		global $Language, $documentos;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_documentos"] <> "") {
				$documentos->id_documentos->setQueryStringValue($_GET["id_documentos"]);
				$this->RecKey["id_documentos"] = $documentos->id_documentos->QueryStringValue;
			} else {
				$sReturnUrl = "documentoslist.php"; // Return to list
			}

			// Get action
			$documentos->CurrentAction = "I"; // Display form
			switch ($documentos->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "documentoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "documentoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$documentos->RowType = EW_ROWTYPE_VIEW;
		$documentos->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $documentos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$documentos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$documentos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $documentos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$documentos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$documentos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$documentos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documentos;
		$sFilter = $documentos->KeyFilter();

		// Call Row Selecting event
		$documentos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documentos->CurrentFilter = $sFilter;
		$sSql = $documentos->SQL();
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
		global $conn, $documentos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documentos->Row_Selected($row);
		$documentos->id_documentos->setDbValue($rs->fields('id_documentos'));
		$documentos->titulo->setDbValue($rs->fields('titulo'));
		$documentos->sumario->setDbValue($rs->fields('sumario'));
		$documentos->documento->Upload->DbValue = $rs->fields('documento');
		$documentos->fecha->setDbValue($rs->fields('fecha'));
		$documentos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documentos;

		// Initialize URLs
		$this->AddUrl = $documentos->AddUrl();
		$this->EditUrl = $documentos->EditUrl();
		$this->CopyUrl = $documentos->CopyUrl();
		$this->DeleteUrl = $documentos->DeleteUrl();
		$this->ListUrl = $documentos->ListUrl();

		// Call Row_Rendering event
		$documentos->Row_Rendering();

		// Common render codes for all row types
		// id_documentos
		// titulo
		// sumario
		// documento
		// fecha
		// estatus

		if ($documentos->RowType == EW_ROWTYPE_VIEW) { // View row

			// titulo
			$documentos->titulo->ViewValue = $documentos->titulo->CurrentValue;
			$documentos->titulo->ViewCustomAttributes = "";

			// sumario
			$documentos->sumario->ViewValue = $documentos->sumario->CurrentValue;
			$documentos->sumario->ViewCustomAttributes = "";

			// documento
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->ViewValue = $documentos->documento->Upload->DbValue;
			} else {
				$documentos->documento->ViewValue = "";
			}
			$documentos->documento->ViewCustomAttributes = "";

			// fecha
			$documentos->fecha->ViewValue = $documentos->fecha->CurrentValue;
			$documentos->fecha->ViewValue = ew_FormatDateTime($documentos->fecha->ViewValue, 7);
			$documentos->fecha->ViewCustomAttributes = "";

			// estatus
			if (strval($documentos->estatus->CurrentValue) <> "") {
				switch ($documentos->estatus->CurrentValue) {
					case "1":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(1) <> "" ? $documentos->estatus->FldTagCaption(1) : $documentos->estatus->CurrentValue;
						break;
					case "0":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(2) <> "" ? $documentos->estatus->FldTagCaption(2) : $documentos->estatus->CurrentValue;
						break;
					default:
						$documentos->estatus->ViewValue = $documentos->estatus->CurrentValue;
				}
			} else {
				$documentos->estatus->ViewValue = NULL;
			}
			$documentos->estatus->ViewCustomAttributes = "";

			// titulo
			$documentos->titulo->LinkCustomAttributes = "";
			$documentos->titulo->HrefValue = "";
			$documentos->titulo->TooltipValue = "";

			// sumario
			$documentos->sumario->LinkCustomAttributes = "";
			$documentos->sumario->HrefValue = "";
			$documentos->sumario->TooltipValue = "";

			// documento
			$documentos->documento->LinkCustomAttributes = "";
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->HrefValue = ew_UploadPathEx(FALSE, $documentos->documento->UploadPath) . ((!empty($documentos->documento->ViewValue)) ? $documentos->documento->ViewValue : $documentos->documento->CurrentValue); // Add prefix/suffix
				$documentos->documento->LinkAttrs["target"] = ""; // Add target
				if ($documentos->Export <> "") $documentos->documento->HrefValue = ew_ConvertFullUrl($documentos->documento->HrefValue);
			} else {
				$documentos->documento->HrefValue = "";
			}
			$documentos->documento->TooltipValue = "";

			// fecha
			$documentos->fecha->LinkCustomAttributes = "";
			$documentos->fecha->HrefValue = "";
			$documentos->fecha->TooltipValue = "";

			// estatus
			$documentos->estatus->LinkCustomAttributes = "";
			$documentos->estatus->HrefValue = "";
			$documentos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($documentos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documentos->Row_Rendered();
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
