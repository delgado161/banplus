<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "bitacorainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$bitacora_view = new cbitacora_view();
$Page =& $bitacora_view;

// Page init
$bitacora_view->Page_Init();

// Page main
$bitacora_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($bitacora->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var bitacora_view = new ew_Page("bitacora_view");

// page properties
bitacora_view.PageID = "view"; // page ID
bitacora_view.FormID = "fbitacoraview"; // form ID
var EW_PAGE_ID = bitacora_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
bitacora_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
bitacora_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
bitacora_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $bitacora->TableCaption() ?>
&nbsp;&nbsp;<?php $bitacora_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($bitacora->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $bitacora_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $bitacora_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $bitacora_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $bitacora_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $bitacora_view->ShowPageHeader(); ?>
<?php
$bitacora_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($bitacora->id_bitacora->Visible) { // id_bitacora ?>
	<tr id="r_id_bitacora"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->id_bitacora->FldCaption() ?></td>
		<td<?php echo $bitacora->id_bitacora->CellAttributes() ?>>
<div<?php echo $bitacora->id_bitacora->ViewAttributes() ?>><?php echo $bitacora->id_bitacora->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($bitacora->valor_anterior->Visible) { // valor_anterior ?>
	<tr id="r_valor_anterior"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->valor_anterior->FldCaption() ?></td>
		<td<?php echo $bitacora->valor_anterior->CellAttributes() ?>>
<div<?php echo $bitacora->valor_anterior->ViewAttributes() ?>><?php echo $bitacora->valor_anterior->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($bitacora->valor_nuevo->Visible) { // valor_nuevo ?>
	<tr id="r_valor_nuevo"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->valor_nuevo->FldCaption() ?></td>
		<td<?php echo $bitacora->valor_nuevo->CellAttributes() ?>>
<div<?php echo $bitacora->valor_nuevo->ViewAttributes() ?>><?php echo $bitacora->valor_nuevo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($bitacora->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->fecha->FldCaption() ?></td>
		<td<?php echo $bitacora->fecha->CellAttributes() ?>>
<div<?php echo $bitacora->fecha->ViewAttributes() ?>><?php echo $bitacora->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($bitacora->usuario->Visible) { // usuario ?>
	<tr id="r_usuario"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->usuario->FldCaption() ?></td>
		<td<?php echo $bitacora->usuario->CellAttributes() ?>>
<div<?php echo $bitacora->usuario->ViewAttributes() ?>><?php echo $bitacora->usuario->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($bitacora->accion->Visible) { // accion ?>
	<tr id="r_accion"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->accion->FldCaption() ?></td>
		<td<?php echo $bitacora->accion->CellAttributes() ?>>
<div<?php echo $bitacora->accion->ViewAttributes() ?>><?php echo $bitacora->accion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($bitacora->formulario->Visible) { // formulario ?>
	<tr id="r_formulario"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->formulario->FldCaption() ?></td>
		<td<?php echo $bitacora->formulario->CellAttributes() ?>>
<div<?php echo $bitacora->formulario->ViewAttributes() ?>><?php echo $bitacora->formulario->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($bitacora->campos->Visible) { // campos ?>
	<tr id="r_campos"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->campos->FldCaption() ?></td>
		<td<?php echo $bitacora->campos->CellAttributes() ?>>
<div<?php echo $bitacora->campos->ViewAttributes() ?>><?php echo $bitacora->campos->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$bitacora_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($bitacora->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$bitacora_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cbitacora_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'bitacora';

	// Page object name
	var $PageObjName = 'bitacora_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $bitacora;
		if ($bitacora->UseTokenInUrl) $PageUrl .= "t=" . $bitacora->TableVar . "&"; // Add page token
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
		global $objForm, $bitacora;
		if ($bitacora->UseTokenInUrl) {
			if ($objForm)
				return ($bitacora->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($bitacora->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbitacora_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (bitacora)
		if (!isset($GLOBALS["bitacora"])) {
			$GLOBALS["bitacora"] = new cbitacora();
			$GLOBALS["Table"] =& $GLOBALS["bitacora"];
		}
		$KeyUrl = "";
		if (@$_GET["id_bitacora"] <> "") {
			$this->RecKey["id_bitacora"] = $_GET["id_bitacora"];
			$KeyUrl .= "&id_bitacora=" . urlencode($this->RecKey["id_bitacora"]);
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
			define("EW_TABLE_NAME", 'bitacora', TRUE);

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
		global $bitacora;

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
			$this->Page_Terminate("bitacoralist.php");
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
		global $Language, $bitacora;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_bitacora"] <> "") {
				$bitacora->id_bitacora->setQueryStringValue($_GET["id_bitacora"]);
				$this->RecKey["id_bitacora"] = $bitacora->id_bitacora->QueryStringValue;
			} else {
				$sReturnUrl = "bitacoralist.php"; // Return to list
			}

			// Get action
			$bitacora->CurrentAction = "I"; // Display form
			switch ($bitacora->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "bitacoralist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "bitacoralist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$bitacora->RowType = EW_ROWTYPE_VIEW;
		$bitacora->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $bitacora;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$bitacora->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$bitacora->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $bitacora->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$bitacora->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$bitacora->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$bitacora->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $bitacora;
		$sFilter = $bitacora->KeyFilter();

		// Call Row Selecting event
		$bitacora->Row_Selecting($sFilter);

		// Load SQL based on filter
		$bitacora->CurrentFilter = $sFilter;
		$sSql = $bitacora->SQL();
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
		global $conn, $bitacora;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$bitacora->Row_Selected($row);
		$bitacora->id_bitacora->setDbValue($rs->fields('id_bitacora'));
		$bitacora->valor_anterior->setDbValue($rs->fields('valor_anterior'));
		$bitacora->valor_nuevo->setDbValue($rs->fields('valor_nuevo'));
		$bitacora->fecha->setDbValue($rs->fields('fecha'));
		$bitacora->usuario->setDbValue($rs->fields('usuario'));
		$bitacora->accion->setDbValue($rs->fields('accion'));
		$bitacora->formulario->setDbValue($rs->fields('formulario'));
		$bitacora->campos->setDbValue($rs->fields('campos'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $bitacora;

		// Initialize URLs
		$this->AddUrl = $bitacora->AddUrl();
		$this->EditUrl = $bitacora->EditUrl();
		$this->CopyUrl = $bitacora->CopyUrl();
		$this->DeleteUrl = $bitacora->DeleteUrl();
		$this->ListUrl = $bitacora->ListUrl();

		// Call Row_Rendering event
		$bitacora->Row_Rendering();

		// Common render codes for all row types
		// id_bitacora
		// valor_anterior
		// valor_nuevo
		// fecha
		// usuario
		// accion
		// formulario
		// campos

		if ($bitacora->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_bitacora
			$bitacora->id_bitacora->ViewValue = $bitacora->id_bitacora->CurrentValue;
			$bitacora->id_bitacora->ViewCustomAttributes = "";

			// valor_anterior
			$bitacora->valor_anterior->ViewValue = $bitacora->valor_anterior->CurrentValue;
			$bitacora->valor_anterior->ViewCustomAttributes = "";

			// valor_nuevo
			$bitacora->valor_nuevo->ViewValue = $bitacora->valor_nuevo->CurrentValue;
			$bitacora->valor_nuevo->ViewCustomAttributes = "";

			// fecha
			$bitacora->fecha->ViewValue = $bitacora->fecha->CurrentValue;
			$bitacora->fecha->ViewValue = ew_FormatDateTime($bitacora->fecha->ViewValue, 7);
			$bitacora->fecha->ViewCustomAttributes = "";

			// usuario
			$bitacora->usuario->ViewValue = $bitacora->usuario->CurrentValue;
			$bitacora->usuario->ViewCustomAttributes = "";

			// accion
			$bitacora->accion->ViewValue = $bitacora->accion->CurrentValue;
			$bitacora->accion->ViewCustomAttributes = "";

			// formulario
			$bitacora->formulario->ViewValue = $bitacora->formulario->CurrentValue;
			$bitacora->formulario->ViewCustomAttributes = "";

			// campos
			$bitacora->campos->ViewValue = $bitacora->campos->CurrentValue;
			$bitacora->campos->ViewCustomAttributes = "";

			// id_bitacora
			$bitacora->id_bitacora->LinkCustomAttributes = "";
			$bitacora->id_bitacora->HrefValue = "";
			$bitacora->id_bitacora->TooltipValue = "";

			// valor_anterior
			$bitacora->valor_anterior->LinkCustomAttributes = "";
			$bitacora->valor_anterior->HrefValue = "";
			$bitacora->valor_anterior->TooltipValue = "";

			// valor_nuevo
			$bitacora->valor_nuevo->LinkCustomAttributes = "";
			$bitacora->valor_nuevo->HrefValue = "";
			$bitacora->valor_nuevo->TooltipValue = "";

			// fecha
			$bitacora->fecha->LinkCustomAttributes = "";
			$bitacora->fecha->HrefValue = "";
			$bitacora->fecha->TooltipValue = "";

			// usuario
			$bitacora->usuario->LinkCustomAttributes = "";
			$bitacora->usuario->HrefValue = "";
			$bitacora->usuario->TooltipValue = "";

			// accion
			$bitacora->accion->LinkCustomAttributes = "";
			$bitacora->accion->HrefValue = "";
			$bitacora->accion->TooltipValue = "";

			// formulario
			$bitacora->formulario->LinkCustomAttributes = "";
			$bitacora->formulario->HrefValue = "";
			$bitacora->formulario->TooltipValue = "";

			// campos
			$bitacora->campos->LinkCustomAttributes = "";
			$bitacora->campos->HrefValue = "";
			$bitacora->campos->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($bitacora->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$bitacora->Row_Rendered();
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
