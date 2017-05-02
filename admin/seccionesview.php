<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "seccionesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$secciones_view = new csecciones_view();
$Page =& $secciones_view;

// Page init
$secciones_view->Page_Init();

// Page main
$secciones_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($secciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var secciones_view = new ew_Page("secciones_view");

// page properties
secciones_view.PageID = "view"; // page ID
secciones_view.FormID = "fseccionesview"; // form ID
var EW_PAGE_ID = secciones_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
secciones_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secciones_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secciones_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secciones->TableCaption() ?>
&nbsp;&nbsp;<?php $secciones_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($secciones->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $secciones_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secciones_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secciones_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $secciones_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $secciones_view->ShowPageHeader(); ?>
<?php
$secciones_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($secciones->id_seccion->Visible) { // id_seccion ?>
	<tr id="r_id_seccion"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->id_seccion->FldCaption() ?></td>
		<td<?php echo $secciones->id_seccion->CellAttributes() ?>>
<div<?php echo $secciones->id_seccion->ViewAttributes() ?>><?php echo $secciones->id_seccion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secciones->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->imagen->FldCaption() ?></td>
		<td<?php echo $secciones->imagen->CellAttributes() ?>>
<div<?php echo $secciones->imagen->ViewAttributes() ?>><?php echo $secciones->imagen->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secciones->contenido->Visible) { // contenido ?>
	<tr id="r_contenido"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->contenido->FldCaption() ?></td>
		<td<?php echo $secciones->contenido->CellAttributes() ?>>
<div<?php echo $secciones->contenido->ViewAttributes() ?>><?php echo $secciones->contenido->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secciones->resumen->Visible) { // resumen ?>
	<tr id="r_resumen"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->resumen->FldCaption() ?></td>
		<td<?php echo $secciones->resumen->CellAttributes() ?>>
<div<?php echo $secciones->resumen->ViewAttributes() ?>><?php echo $secciones->resumen->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secciones->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->estatus->FldCaption() ?></td>
		<td<?php echo $secciones->estatus->CellAttributes() ?>>
<div<?php echo $secciones->estatus->ViewAttributes() ?>><?php echo $secciones->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secciones->id_herramienta_financiera->Visible) { // id_herramienta_financiera ?>
	<tr id="r_id_herramienta_financiera"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->id_herramienta_financiera->FldCaption() ?></td>
		<td<?php echo $secciones->id_herramienta_financiera->CellAttributes() ?>>
<div<?php echo $secciones->id_herramienta_financiera->ViewAttributes() ?>><?php echo $secciones->id_herramienta_financiera->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secciones->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->titulo->FldCaption() ?></td>
		<td<?php echo $secciones->titulo->CellAttributes() ?>>
<div<?php echo $secciones->titulo->ViewAttributes() ?>><?php echo $secciones->titulo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($secciones->imagen_interna->Visible) { // imagen_interna ?>
	<tr id="r_imagen_interna"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->imagen_interna->FldCaption() ?></td>
		<td<?php echo $secciones->imagen_interna->CellAttributes() ?>>
<div<?php echo $secciones->imagen_interna->ViewAttributes() ?>><?php echo $secciones->imagen_interna->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$secciones_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($secciones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$secciones_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csecciones_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'secciones';

	// Page object name
	var $PageObjName = 'secciones_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $secciones;
		if ($secciones->UseTokenInUrl) $PageUrl .= "t=" . $secciones->TableVar . "&"; // Add page token
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
		global $objForm, $secciones;
		if ($secciones->UseTokenInUrl) {
			if ($objForm)
				return ($secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csecciones_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (secciones)
		if (!isset($GLOBALS["secciones"])) {
			$GLOBALS["secciones"] = new csecciones();
			$GLOBALS["Table"] =& $GLOBALS["secciones"];
		}
		$KeyUrl = "";
		if (@$_GET["id_seccion"] <> "") {
			$this->RecKey["id_seccion"] = $_GET["id_seccion"];
			$KeyUrl .= "&id_seccion=" . urlencode($this->RecKey["id_seccion"]);
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
			define("EW_TABLE_NAME", 'secciones', TRUE);

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
		global $secciones;

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
		global $Language, $secciones;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_seccion"] <> "") {
				$secciones->id_seccion->setQueryStringValue($_GET["id_seccion"]);
				$this->RecKey["id_seccion"] = $secciones->id_seccion->QueryStringValue;
			} else {
				$sReturnUrl = "seccioneslist.php"; // Return to list
			}

			// Get action
			$secciones->CurrentAction = "I"; // Display form
			switch ($secciones->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "seccioneslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "seccioneslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$secciones->RowType = EW_ROWTYPE_VIEW;
		$secciones->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $secciones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$secciones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$secciones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $secciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$secciones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$secciones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $secciones;
		$sFilter = $secciones->KeyFilter();

		// Call Row Selecting event
		$secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$secciones->CurrentFilter = $sFilter;
		$sSql = $secciones->SQL();
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
		global $conn, $secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$secciones->Row_Selected($row);
		$secciones->id_seccion->setDbValue($rs->fields('id_seccion'));
		$secciones->imagen->setDbValue($rs->fields('imagen'));
		$secciones->contenido->setDbValue($rs->fields('contenido'));
		$secciones->resumen->setDbValue($rs->fields('resumen'));
		$secciones->estatus->setDbValue($rs->fields('estatus'));
		$secciones->id_herramienta_financiera->setDbValue($rs->fields('id_herramienta_financiera'));
		$secciones->titulo->setDbValue($rs->fields('titulo'));
		$secciones->imagen_interna->setDbValue($rs->fields('imagen_interna'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $secciones;

		// Initialize URLs
		$this->AddUrl = $secciones->AddUrl();
		$this->EditUrl = $secciones->EditUrl();
		$this->CopyUrl = $secciones->CopyUrl();
		$this->DeleteUrl = $secciones->DeleteUrl();
		$this->ListUrl = $secciones->ListUrl();

		// Call Row_Rendering event
		$secciones->Row_Rendering();

		// Common render codes for all row types
		// id_seccion
		// imagen
		// contenido
		// resumen
		// estatus
		// id_herramienta_financiera
		// titulo
		// imagen_interna

		if ($secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_seccion
			$secciones->id_seccion->ViewValue = $secciones->id_seccion->CurrentValue;
			$secciones->id_seccion->ViewCustomAttributes = "";

			// imagen
			$secciones->imagen->ViewValue = $secciones->imagen->CurrentValue;
			$secciones->imagen->ViewCustomAttributes = "";

			// contenido
			$secciones->contenido->ViewValue = $secciones->contenido->CurrentValue;
			$secciones->contenido->ViewCustomAttributes = "";

			// resumen
			$secciones->resumen->ViewValue = $secciones->resumen->CurrentValue;
			$secciones->resumen->ViewCustomAttributes = "";

			// estatus
			$secciones->estatus->ViewValue = $secciones->estatus->CurrentValue;
			$secciones->estatus->ViewCustomAttributes = "";

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->ViewValue = $secciones->id_herramienta_financiera->CurrentValue;
			$secciones->id_herramienta_financiera->ViewCustomAttributes = "";

			// titulo
			$secciones->titulo->ViewValue = $secciones->titulo->CurrentValue;
			$secciones->titulo->ViewCustomAttributes = "";

			// imagen_interna
			$secciones->imagen_interna->ViewValue = $secciones->imagen_interna->CurrentValue;
			$secciones->imagen_interna->ViewCustomAttributes = "";

			// id_seccion
			$secciones->id_seccion->LinkCustomAttributes = "";
			$secciones->id_seccion->HrefValue = "";
			$secciones->id_seccion->TooltipValue = "";

			// imagen
			$secciones->imagen->LinkCustomAttributes = "";
			$secciones->imagen->HrefValue = "";
			$secciones->imagen->TooltipValue = "";

			// contenido
			$secciones->contenido->LinkCustomAttributes = "";
			$secciones->contenido->HrefValue = "";
			$secciones->contenido->TooltipValue = "";

			// resumen
			$secciones->resumen->LinkCustomAttributes = "";
			$secciones->resumen->HrefValue = "";
			$secciones->resumen->TooltipValue = "";

			// estatus
			$secciones->estatus->LinkCustomAttributes = "";
			$secciones->estatus->HrefValue = "";
			$secciones->estatus->TooltipValue = "";

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->LinkCustomAttributes = "";
			$secciones->id_herramienta_financiera->HrefValue = "";
			$secciones->id_herramienta_financiera->TooltipValue = "";

			// titulo
			$secciones->titulo->LinkCustomAttributes = "";
			$secciones->titulo->HrefValue = "";
			$secciones->titulo->TooltipValue = "";

			// imagen_interna
			$secciones->imagen_interna->LinkCustomAttributes = "";
			$secciones->imagen_interna->HrefValue = "";
			$secciones->imagen_interna->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secciones->Row_Rendered();
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
