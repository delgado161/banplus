<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "auditoriainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$auditoria_view = new cauditoria_view();
$Page =& $auditoria_view;

// Page init
$auditoria_view->Page_Init();

// Page main
$auditoria_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($auditoria->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var auditoria_view = new ew_Page("auditoria_view");

// page properties
auditoria_view.PageID = "view"; // page ID
auditoria_view.FormID = "fauditoriaview"; // form ID
var EW_PAGE_ID = auditoria_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
auditoria_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
auditoria_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
auditoria_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $auditoria->TableCaption() ?>
&nbsp;&nbsp;<?php $auditoria_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($auditoria->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $auditoria_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php } ?>
</p>
<?php $auditoria_view->ShowPageHeader(); ?>
<?php
$auditoria_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($auditoria->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $auditoria->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $auditoria->fecha->FldCaption() ?></td>
		<td<?php echo $auditoria->fecha->CellAttributes() ?>>
<div<?php echo $auditoria->fecha->ViewAttributes() ?>><?php echo $auditoria->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($auditoria->script->Visible) { // script ?>
	<tr id="r_script"<?php echo $auditoria->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $auditoria->script->FldCaption() ?></td>
		<td<?php echo $auditoria->script->CellAttributes() ?>>
<div<?php echo $auditoria->script->ViewAttributes() ?>><?php echo $auditoria->script->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($auditoria->usuario->Visible) { // usuario ?>
	<tr id="r_usuario"<?php echo $auditoria->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $auditoria->usuario->FldCaption() ?></td>
		<td<?php echo $auditoria->usuario->CellAttributes() ?>>
<div<?php echo $auditoria->usuario->ViewAttributes() ?>><?php echo $auditoria->usuario->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($auditoria->accion->Visible) { // accion ?>
	<tr id="r_accion"<?php echo $auditoria->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $auditoria->accion->FldCaption() ?></td>
		<td<?php echo $auditoria->accion->CellAttributes() ?>>
<div<?php echo $auditoria->accion->ViewAttributes() ?>><?php echo str_replace('descinexi&oacute;n','desconexi&oacute;n',$auditoria->accion->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($auditoria->tabla->Visible) { // tabla ?>
	<tr id="r_tabla"<?php echo $auditoria->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $auditoria->tabla->FldCaption() ?></td>
		<td<?php echo $auditoria->tabla->CellAttributes() ?>>
<div<?php echo $auditoria->tabla->ViewAttributes() ?>><?php echo $auditoria->tabla->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($auditoria->archivo->Visible) { // archivo ?>
	<tr id="r_archivo"<?php echo $auditoria->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $auditoria->archivo->FldCaption() ?></td>
		<td<?php echo $auditoria->archivo->CellAttributes() ?>>
<div<?php echo $auditoria->archivo->ViewAttributes() ?>><?php echo $auditoria->archivo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($auditoria->valor->Visible) { // valor ?>
	<tr id="r_valor"<?php echo $auditoria->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $auditoria->valor->FldCaption() ?></td>
		<td<?php echo $auditoria->valor->CellAttributes() ?>>
<div<?php echo $auditoria->valor->ViewAttributes() ?>><?php echo $auditoria->valor->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($auditoria->valorinicial->Visible) { // valorinicial ?>
	<tr id="r_valorinicial"<?php echo $auditoria->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $auditoria->valorinicial->FldCaption() ?></td>
		<td<?php echo $auditoria->valorinicial->CellAttributes() ?>>
<div<?php echo $auditoria->valorinicial->ViewAttributes() ?>><?php echo $auditoria->valorinicial->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($auditoria->valorfinal->Visible) { // valorfinal ?>
	<tr id="r_valorfinal"<?php echo $auditoria->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $auditoria->valorfinal->FldCaption() ?></td>
		<td<?php echo $auditoria->valorfinal->CellAttributes() ?>>
<div<?php echo $auditoria->valorfinal->ViewAttributes() ?>><?php echo $auditoria->valorfinal->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$auditoria_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($auditoria->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$auditoria_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cauditoria_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'auditoria';

	// Page object name
	var $PageObjName = 'auditoria_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $auditoria;
		if ($auditoria->UseTokenInUrl) $PageUrl .= "t=" . $auditoria->TableVar . "&"; // Add page token
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
		global $objForm, $auditoria;
		if ($auditoria->UseTokenInUrl) {
			if ($objForm)
				return ($auditoria->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($auditoria->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cauditoria_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (auditoria)
		if (!isset($GLOBALS["auditoria"])) {
			$GLOBALS["auditoria"] = new cauditoria();
			$GLOBALS["Table"] =& $GLOBALS["auditoria"];
		}
		$KeyUrl = "";
		if (@$_GET["id"] <> "") {
			$this->RecKey["id"] = $_GET["id"];
			$KeyUrl .= "&id=" . urlencode($this->RecKey["id"]);
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
			define("EW_TABLE_NAME", 'auditoria', TRUE);

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
		global $auditoria;

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
			$this->Page_Terminate("auditorialist.php");
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
		global $Language, $auditoria;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$auditoria->id->setQueryStringValue($_GET["id"]);
				$this->RecKey["id"] = $auditoria->id->QueryStringValue;
			} else {
				$sReturnUrl = "auditorialist.php"; // Return to list
			}

			// Get action
			$auditoria->CurrentAction = "I"; // Display form
			switch ($auditoria->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "auditorialist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "auditorialist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$auditoria->RowType = EW_ROWTYPE_VIEW;
		$auditoria->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $auditoria;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$auditoria->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$auditoria->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $auditoria->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$auditoria->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$auditoria->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$auditoria->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $auditoria;
		$sFilter = $auditoria->KeyFilter();

		// Call Row Selecting event
		$auditoria->Row_Selecting($sFilter);

		// Load SQL based on filter
		$auditoria->CurrentFilter = $sFilter;
		$sSql = $auditoria->SQL();
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
		global $conn, $auditoria;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$auditoria->Row_Selected($row);
		$auditoria->id->setDbValue($rs->fields('id'));
		$auditoria->fecha->setDbValue($rs->fields('fecha'));
		$auditoria->script->setDbValue($rs->fields('script'));
		$auditoria->usuario->setDbValue($rs->fields('usuario'));
		$auditoria->accion->setDbValue($rs->fields('accion'));
		$auditoria->tabla->setDbValue($rs->fields('tabla'));
		$auditoria->archivo->setDbValue($rs->fields('archivo'));
		$auditoria->valor->setDbValue($rs->fields('valor'));
		$auditoria->valorinicial->setDbValue($rs->fields('valorinicial'));
		$auditoria->valorfinal->setDbValue($rs->fields('valorfinal'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $auditoria;

		// Initialize URLs
		$this->AddUrl = $auditoria->AddUrl();
		$this->EditUrl = $auditoria->EditUrl();
		$this->CopyUrl = $auditoria->CopyUrl();
		$this->DeleteUrl = $auditoria->DeleteUrl();
		$this->ListUrl = $auditoria->ListUrl();

		// Call Row_Rendering event
		$auditoria->Row_Rendering();

		// Common render codes for all row types
		// id
		// fecha
		// script
		// usuario
		// accion
		// tabla
		// archivo
		// valor
		// valorinicial
		// valorfinal

		if ($auditoria->RowType == EW_ROWTYPE_VIEW) { // View row

			// fecha
			$auditoria->fecha->ViewValue = $auditoria->fecha->CurrentValue;
			$auditoria->fecha->ViewValue = ew_FormatDateTime($auditoria->fecha->ViewValue, 7);
			$auditoria->fecha->ViewCustomAttributes = "";

			// script
			$auditoria->script->ViewValue = $auditoria->script->CurrentValue;
			$auditoria->script->ViewCustomAttributes = "";

			// usuario
			$auditoria->usuario->ViewValue = $auditoria->usuario->CurrentValue;
			$auditoria->usuario->ViewCustomAttributes = "";

			// accion
			$auditoria->accion->ViewValue = $auditoria->accion->CurrentValue;
			$auditoria->accion->ViewCustomAttributes = "";

			// tabla
			$auditoria->tabla->ViewValue = $auditoria->tabla->CurrentValue;
			$auditoria->tabla->ViewCustomAttributes = "";

			// archivo
			$auditoria->archivo->ViewValue = $auditoria->archivo->CurrentValue;
			$auditoria->archivo->ViewCustomAttributes = "";

			// valor
			$auditoria->valor->ViewValue = $auditoria->valor->CurrentValue;
			$auditoria->valor->ViewCustomAttributes = "";

			// valorinicial
			$auditoria->valorinicial->ViewValue = $auditoria->valorinicial->CurrentValue;
			$auditoria->valorinicial->ViewCustomAttributes = "";

			// valorfinal
			$auditoria->valorfinal->ViewValue = $auditoria->valorfinal->CurrentValue;
			$auditoria->valorfinal->ViewCustomAttributes = "";

			// fecha
			$auditoria->fecha->LinkCustomAttributes = "";
			$auditoria->fecha->HrefValue = "";
			$auditoria->fecha->TooltipValue = "";

			// script
			$auditoria->script->LinkCustomAttributes = "";
			$auditoria->script->HrefValue = "";
			$auditoria->script->TooltipValue = "";

			// usuario
			$auditoria->usuario->LinkCustomAttributes = "";
			$auditoria->usuario->HrefValue = "";
			$auditoria->usuario->TooltipValue = "";

			// accion
			$auditoria->accion->LinkCustomAttributes = "";
			$auditoria->accion->HrefValue = "";
			$auditoria->accion->TooltipValue = "";

			// tabla
			$auditoria->tabla->LinkCustomAttributes = "";
			$auditoria->tabla->HrefValue = "";
			$auditoria->tabla->TooltipValue = "";

			// archivo
			$auditoria->archivo->LinkCustomAttributes = "";
			$auditoria->archivo->HrefValue = "";
			$auditoria->archivo->TooltipValue = "";

			// valor
			$auditoria->valor->LinkCustomAttributes = "";
			$auditoria->valor->HrefValue = "";
			$auditoria->valor->TooltipValue = "";

			// valorinicial
			$auditoria->valorinicial->LinkCustomAttributes = "";
			$auditoria->valorinicial->HrefValue = "";
			$auditoria->valorinicial->TooltipValue = "";

			// valorfinal
			$auditoria->valorfinal->LinkCustomAttributes = "";
			$auditoria->valorfinal->HrefValue = "";
			$auditoria->valorfinal->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($auditoria->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$auditoria->Row_Rendered();
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
