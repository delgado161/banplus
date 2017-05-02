<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "calendarioinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$calendario_view = new ccalendario_view();
$Page =& $calendario_view;

// Page init
$calendario_view->Page_Init();

// Page main
$calendario_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($calendario->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var calendario_view = new ew_Page("calendario_view");

// page properties
calendario_view.PageID = "view"; // page ID
calendario_view.FormID = "fcalendarioview"; // form ID
var EW_PAGE_ID = calendario_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
calendario_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
calendario_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
calendario_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $calendario->TableCaption() ?>
&nbsp;&nbsp;<?php $calendario_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($calendario->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $calendario_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $calendario_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $calendario_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $calendario_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $calendario_view->ShowPageHeader(); ?>
<?php
$calendario_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($calendario->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $calendario->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calendario->tipo->FldCaption() ?></td>
		<td<?php echo $calendario->tipo->CellAttributes() ?>>
<div<?php echo $calendario->tipo->ViewAttributes() ?>><?php echo $calendario->tipo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($calendario->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $calendario->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calendario->fecha->FldCaption() ?></td>
		<td<?php echo $calendario->fecha->CellAttributes() ?>>
<div<?php echo $calendario->fecha->ViewAttributes() ?>><?php echo $calendario->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($calendario->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion"<?php echo $calendario->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calendario->descripcion->FldCaption() ?></td>
		<td<?php echo $calendario->descripcion->CellAttributes() ?>>
<div<?php echo $calendario->descripcion->ViewAttributes() ?>><?php echo $calendario->descripcion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($calendario->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $calendario->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calendario->estatus->FldCaption() ?></td>
		<td<?php echo $calendario->estatus->CellAttributes() ?>>
<div<?php echo $calendario->estatus->ViewAttributes() ?>><?php echo $calendario->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$calendario_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($calendario->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$calendario_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccalendario_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'calendario';

	// Page object name
	var $PageObjName = 'calendario_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $calendario;
		if ($calendario->UseTokenInUrl) $PageUrl .= "t=" . $calendario->TableVar . "&"; // Add page token
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
		global $objForm, $calendario;
		if ($calendario->UseTokenInUrl) {
			if ($objForm)
				return ($calendario->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($calendario->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccalendario_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (calendario)
		if (!isset($GLOBALS["calendario"])) {
			$GLOBALS["calendario"] = new ccalendario();
			$GLOBALS["Table"] =& $GLOBALS["calendario"];
		}
		$KeyUrl = "";
		if (@$_GET["id_calendario"] <> "") {
			$this->RecKey["id_calendario"] = $_GET["id_calendario"];
			$KeyUrl .= "&id_calendario=" . urlencode($this->RecKey["id_calendario"]);
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
			define("EW_TABLE_NAME", 'calendario', TRUE);

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
		global $calendario;

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
			$this->Page_Terminate("calendariolist.php");
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
		global $Language, $calendario;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_calendario"] <> "") {
				$calendario->id_calendario->setQueryStringValue($_GET["id_calendario"]);
				$this->RecKey["id_calendario"] = $calendario->id_calendario->QueryStringValue;
			} else {
				$sReturnUrl = "calendariolist.php"; // Return to list
			}

			// Get action
			$calendario->CurrentAction = "I"; // Display form
			switch ($calendario->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "calendariolist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "calendariolist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$calendario->RowType = EW_ROWTYPE_VIEW;
		$calendario->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $calendario;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$calendario->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$calendario->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $calendario->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$calendario->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$calendario->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$calendario->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $calendario;
		$sFilter = $calendario->KeyFilter();

		// Call Row Selecting event
		$calendario->Row_Selecting($sFilter);

		// Load SQL based on filter
		$calendario->CurrentFilter = $sFilter;
		$sSql = $calendario->SQL();
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
		global $conn, $calendario;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$calendario->Row_Selected($row);
		$calendario->id_calendario->setDbValue($rs->fields('id_calendario'));
		$calendario->tipo->setDbValue($rs->fields('tipo'));
		$calendario->fecha->setDbValue($rs->fields('fecha'));
		$calendario->descripcion->setDbValue($rs->fields('descripcion'));
		$calendario->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $calendario;

		// Initialize URLs
		$this->AddUrl = $calendario->AddUrl();
		$this->EditUrl = $calendario->EditUrl();
		$this->CopyUrl = $calendario->CopyUrl();
		$this->DeleteUrl = $calendario->DeleteUrl();
		$this->ListUrl = $calendario->ListUrl();

		// Call Row_Rendering event
		$calendario->Row_Rendering();

		// Common render codes for all row types
		// id_calendario
		// tipo
		// fecha
		// descripcion
		// estatus

		if ($calendario->RowType == EW_ROWTYPE_VIEW) { // View row

			// tipo
			if (strval($calendario->tipo->CurrentValue) <> "") {
				$calendario->tipo->ViewValue = "";
				$arwrk = explode(",", strval($calendario->tipo->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++) {
					switch (trim($arwrk[$ari])) {
						case "1":
							$calendario->tipo->ViewValue .= $calendario->tipo->FldTagCaption(1) <> "" ? $calendario->tipo->FldTagCaption(1) : trim($arwrk[$ari]);
							break;
						case "2":
							$calendario->tipo->ViewValue .= $calendario->tipo->FldTagCaption(2) <> "" ? $calendario->tipo->FldTagCaption(2) : trim($arwrk[$ari]);
							break;
						default:
							$calendario->tipo->ViewValue .= trim($arwrk[$ari]);
					}
					if ($ari < $cnt-1) $calendario->tipo->ViewValue .= ew_ViewOptionSeparator($ari);
				}
			} else {
				$calendario->tipo->ViewValue = NULL;
			}
			$calendario->tipo->ViewCustomAttributes = "";

			// fecha
			$calendario->fecha->ViewValue = $calendario->fecha->CurrentValue;
			$calendario->fecha->ViewValue = ew_FormatDateTime($calendario->fecha->ViewValue, 7);
			$calendario->fecha->ViewCustomAttributes = "";

			// descripcion
			$calendario->descripcion->ViewValue = $calendario->descripcion->CurrentValue;
			$calendario->descripcion->ViewCustomAttributes = "";

			// estatus
			if (strval($calendario->estatus->CurrentValue) <> "") {
				switch ($calendario->estatus->CurrentValue) {
					case "1":
						$calendario->estatus->ViewValue = $calendario->estatus->FldTagCaption(1) <> "" ? $calendario->estatus->FldTagCaption(1) : $calendario->estatus->CurrentValue;
						break;
					case "0":
						$calendario->estatus->ViewValue = $calendario->estatus->FldTagCaption(2) <> "" ? $calendario->estatus->FldTagCaption(2) : $calendario->estatus->CurrentValue;
						break;
					default:
						$calendario->estatus->ViewValue = $calendario->estatus->CurrentValue;
				}
			} else {
				$calendario->estatus->ViewValue = NULL;
			}
			$calendario->estatus->ViewCustomAttributes = "";

			// tipo
			$calendario->tipo->LinkCustomAttributes = "";
			$calendario->tipo->HrefValue = "";
			$calendario->tipo->TooltipValue = "";

			// fecha
			$calendario->fecha->LinkCustomAttributes = "";
			$calendario->fecha->HrefValue = "";
			$calendario->fecha->TooltipValue = "";

			// descripcion
			$calendario->descripcion->LinkCustomAttributes = "";
			$calendario->descripcion->HrefValue = "";
			$calendario->descripcion->TooltipValue = "";

			// estatus
			$calendario->estatus->LinkCustomAttributes = "";
			$calendario->estatus->HrefValue = "";
			$calendario->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($calendario->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$calendario->Row_Rendered();
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
