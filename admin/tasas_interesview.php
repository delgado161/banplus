<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tasas_interesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tasas_interes_view = new ctasas_interes_view();
$Page =& $tasas_interes_view;

// Page init
$tasas_interes_view->Page_Init();

// Page main
$tasas_interes_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($tasas_interes->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tasas_interes_view = new ew_Page("tasas_interes_view");

// page properties
tasas_interes_view.PageID = "view"; // page ID
tasas_interes_view.FormID = "ftasas_interesview"; // form ID
var EW_PAGE_ID = tasas_interes_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tasas_interes_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tasas_interes_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tasas_interes_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tasas_interes->TableCaption() ?>
&nbsp;&nbsp;<?php $tasas_interes_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($tasas_interes->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $tasas_interes_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tasas_interes_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $tasas_interes_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $tasas_interes_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $tasas_interes_view->ShowPageHeader(); ?>
<?php
$tasas_interes_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tasas_interes->inicio->Visible) { // inicio ?>
	<tr id="r_inicio"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->inicio->FldCaption() ?></td>
		<td<?php echo $tasas_interes->inicio->CellAttributes() ?>>
<div<?php echo $tasas_interes->inicio->ViewAttributes() ?>><?php echo $tasas_interes->inicio->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tasas_interes->fin->Visible) { // fin ?>
	<tr id="r_fin"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->fin->FldCaption() ?></td>
		<td<?php echo $tasas_interes->fin->CellAttributes() ?>>
<div<?php echo $tasas_interes->fin->ViewAttributes() ?>><?php echo $tasas_interes->fin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tasas_interes->tasa->Visible) { // tasa ?>
	<tr id="r_tasa"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->tasa->FldCaption() ?></td>
		<td<?php echo $tasas_interes->tasa->CellAttributes() ?>>
<div<?php echo $tasas_interes->tasa->ViewAttributes() ?>><?php echo $tasas_interes->tasa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tasas_interes->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->tipo->FldCaption() ?></td>
		<td<?php echo $tasas_interes->tipo->CellAttributes() ?>>
<div<?php echo $tasas_interes->tipo->ViewAttributes() ?>><?php echo $tasas_interes->tipo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tasas_interes->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->estatus->FldCaption() ?></td>
		<td<?php echo $tasas_interes->estatus->CellAttributes() ?>>
<div<?php echo $tasas_interes->estatus->ViewAttributes() ?>><?php echo $tasas_interes->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$tasas_interes_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($tasas_interes->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tasas_interes_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctasas_interes_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tasas_interes';

	// Page object name
	var $PageObjName = 'tasas_interes_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tasas_interes;
		if ($tasas_interes->UseTokenInUrl) $PageUrl .= "t=" . $tasas_interes->TableVar . "&"; // Add page token
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
		global $objForm, $tasas_interes;
		if ($tasas_interes->UseTokenInUrl) {
			if ($objForm)
				return ($tasas_interes->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tasas_interes->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctasas_interes_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tasas_interes)
		if (!isset($GLOBALS["tasas_interes"])) {
			$GLOBALS["tasas_interes"] = new ctasas_interes();
			$GLOBALS["Table"] =& $GLOBALS["tasas_interes"];
		}
		$KeyUrl = "";
		if (@$_GET["id_tasas_interes"] <> "") {
			$this->RecKey["id_tasas_interes"] = $_GET["id_tasas_interes"];
			$KeyUrl .= "&id_tasas_interes=" . urlencode($this->RecKey["id_tasas_interes"]);
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
			define("EW_TABLE_NAME", 'tasas_interes', TRUE);

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
		global $tasas_interes;

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
			$this->Page_Terminate("tasas_intereslist.php");
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
		global $Language, $tasas_interes;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_tasas_interes"] <> "") {
				$tasas_interes->id_tasas_interes->setQueryStringValue($_GET["id_tasas_interes"]);
				$this->RecKey["id_tasas_interes"] = $tasas_interes->id_tasas_interes->QueryStringValue;
			} else {
				$sReturnUrl = "tasas_intereslist.php"; // Return to list
			}

			// Get action
			$tasas_interes->CurrentAction = "I"; // Display form
			switch ($tasas_interes->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tasas_intereslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tasas_intereslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tasas_interes->RowType = EW_ROWTYPE_VIEW;
		$tasas_interes->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tasas_interes;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$tasas_interes->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$tasas_interes->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $tasas_interes->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$tasas_interes->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$tasas_interes->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$tasas_interes->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tasas_interes;
		$sFilter = $tasas_interes->KeyFilter();

		// Call Row Selecting event
		$tasas_interes->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tasas_interes->CurrentFilter = $sFilter;
		$sSql = $tasas_interes->SQL();
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
		global $conn, $tasas_interes;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tasas_interes->Row_Selected($row);
		$tasas_interes->id_tasas_interes->setDbValue($rs->fields('id_tasas_interes'));
		$tasas_interes->inicio->setDbValue($rs->fields('inicio'));
		$tasas_interes->fin->setDbValue($rs->fields('fin'));
		$tasas_interes->tasa->setDbValue($rs->fields('tasa'));
		$tasas_interes->tipo->setDbValue($rs->fields('tipo'));
		$tasas_interes->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tasas_interes;

		// Initialize URLs
		$this->AddUrl = $tasas_interes->AddUrl();
		$this->EditUrl = $tasas_interes->EditUrl();
		$this->CopyUrl = $tasas_interes->CopyUrl();
		$this->DeleteUrl = $tasas_interes->DeleteUrl();
		$this->ListUrl = $tasas_interes->ListUrl();

		// Call Row_Rendering event
		$tasas_interes->Row_Rendering();

		// Common render codes for all row types
		// id_tasas_interes
		// inicio
		// fin
		// tasa
		// tipo
		// estatus

		if ($tasas_interes->RowType == EW_ROWTYPE_VIEW) { // View row

			// inicio
			$tasas_interes->inicio->ViewValue = $tasas_interes->inicio->CurrentValue;
			$tasas_interes->inicio->ViewCustomAttributes = "";

			// fin
			$tasas_interes->fin->ViewValue = $tasas_interes->fin->CurrentValue;
			$tasas_interes->fin->ViewCustomAttributes = "";

			// tasa
			$tasas_interes->tasa->ViewValue = $tasas_interes->tasa->CurrentValue;
			$tasas_interes->tasa->ViewCustomAttributes = "";

			// tipo
			if (strval($tasas_interes->tipo->CurrentValue) <> "") {
				switch ($tasas_interes->tipo->CurrentValue) {
					case "1":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(1) <> "" ? $tasas_interes->tipo->FldTagCaption(1) : $tasas_interes->tipo->CurrentValue;
						break;
					case "2":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(2) <> "" ? $tasas_interes->tipo->FldTagCaption(2) : $tasas_interes->tipo->CurrentValue;
						break;
					case "3":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(3) <> "" ? $tasas_interes->tipo->FldTagCaption(3) : $tasas_interes->tipo->CurrentValue;
						break;
					default:
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->CurrentValue;
				}
			} else {
				$tasas_interes->tipo->ViewValue = NULL;
			}
			$tasas_interes->tipo->ViewCustomAttributes = "";

			// estatus
			if (strval($tasas_interes->estatus->CurrentValue) <> "") {
				switch ($tasas_interes->estatus->CurrentValue) {
					case "1":
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->FldTagCaption(1) <> "" ? $tasas_interes->estatus->FldTagCaption(1) : $tasas_interes->estatus->CurrentValue;
						break;
					case "0":
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->FldTagCaption(2) <> "" ? $tasas_interes->estatus->FldTagCaption(2) : $tasas_interes->estatus->CurrentValue;
						break;
					default:
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->CurrentValue;
				}
			} else {
				$tasas_interes->estatus->ViewValue = NULL;
			}
			$tasas_interes->estatus->ViewCustomAttributes = "";

			// inicio
			$tasas_interes->inicio->LinkCustomAttributes = "";
			$tasas_interes->inicio->HrefValue = "";
			$tasas_interes->inicio->TooltipValue = "";

			// fin
			$tasas_interes->fin->LinkCustomAttributes = "";
			$tasas_interes->fin->HrefValue = "";
			$tasas_interes->fin->TooltipValue = "";

			// tasa
			$tasas_interes->tasa->LinkCustomAttributes = "";
			$tasas_interes->tasa->HrefValue = "";
			$tasas_interes->tasa->TooltipValue = "";

			// tipo
			$tasas_interes->tipo->LinkCustomAttributes = "";
			$tasas_interes->tipo->HrefValue = "";
			$tasas_interes->tipo->TooltipValue = "";

			// estatus
			$tasas_interes->estatus->LinkCustomAttributes = "";
			$tasas_interes->estatus->HrefValue = "";
			$tasas_interes->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tasas_interes->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tasas_interes->Row_Rendered();
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
