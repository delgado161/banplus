<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "agencias_serviciosinfo.php" ?>
<?php include_once "agenciasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$agencias_servicios_view = new cagencias_servicios_view();
$Page =& $agencias_servicios_view;

// Page init
$agencias_servicios_view->Page_Init();

// Page main
$agencias_servicios_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($agencias_servicios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var agencias_servicios_view = new ew_Page("agencias_servicios_view");

// page properties
agencias_servicios_view.PageID = "view"; // page ID
agencias_servicios_view.FormID = "fagencias_serviciosview"; // form ID
var EW_PAGE_ID = agencias_servicios_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
agencias_servicios_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
agencias_servicios_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
agencias_servicios_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $agencias_servicios->TableCaption() ?>
&nbsp;&nbsp;<?php $agencias_servicios_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($agencias_servicios->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $agencias_servicios_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $agencias_servicios_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $agencias_servicios_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $agencias_servicios_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $agencias_servicios_view->ShowPageHeader(); ?>
<?php
$agencias_servicios_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($agencias_servicios->id_agencias_servicios->Visible) { // id_agencias_servicios ?>
	<tr id="r_id_agencias_servicios"<?php echo $agencias_servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias_servicios->id_agencias_servicios->FldCaption() ?></td>
		<td<?php echo $agencias_servicios->id_agencias_servicios->CellAttributes() ?>>
<div<?php echo $agencias_servicios->id_agencias_servicios->ViewAttributes() ?>><?php echo $agencias_servicios->id_agencias_servicios->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias_servicios->id_agencias->Visible) { // id_agencias ?>
	<tr id="r_id_agencias"<?php echo $agencias_servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias_servicios->id_agencias->FldCaption() ?></td>
		<td<?php echo $agencias_servicios->id_agencias->CellAttributes() ?>>
<div<?php echo $agencias_servicios->id_agencias->ViewAttributes() ?>><?php echo $agencias_servicios->id_agencias->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias_servicios->id_servicio->Visible) { // id_servicio ?>
	<tr id="r_id_servicio"<?php echo $agencias_servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias_servicios->id_servicio->FldCaption() ?></td>
		<td<?php echo $agencias_servicios->id_servicio->CellAttributes() ?>>
<div<?php echo $agencias_servicios->id_servicio->ViewAttributes() ?>><?php echo $agencias_servicios->id_servicio->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias_servicios->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $agencias_servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias_servicios->estatus->FldCaption() ?></td>
		<td<?php echo $agencias_servicios->estatus->CellAttributes() ?>>
<div<?php echo $agencias_servicios->estatus->ViewAttributes() ?>><?php echo $agencias_servicios->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$agencias_servicios_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($agencias_servicios->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$agencias_servicios_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cagencias_servicios_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'agencias_servicios';

	// Page object name
	var $PageObjName = 'agencias_servicios_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $agencias_servicios;
		if ($agencias_servicios->UseTokenInUrl) $PageUrl .= "t=" . $agencias_servicios->TableVar . "&"; // Add page token
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
		global $objForm, $agencias_servicios;
		if ($agencias_servicios->UseTokenInUrl) {
			if ($objForm)
				return ($agencias_servicios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($agencias_servicios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cagencias_servicios_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (agencias_servicios)
		if (!isset($GLOBALS["agencias_servicios"])) {
			$GLOBALS["agencias_servicios"] = new cagencias_servicios();
			$GLOBALS["Table"] =& $GLOBALS["agencias_servicios"];
		}
		$KeyUrl = "";
		if (@$_GET["id_agencias_servicios"] <> "") {
			$this->RecKey["id_agencias_servicios"] = $_GET["id_agencias_servicios"];
			$KeyUrl .= "&id_agencias_servicios=" . urlencode($this->RecKey["id_agencias_servicios"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (agencias)
		if (!isset($GLOBALS['agencias'])) $GLOBALS['agencias'] = new cagencias();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'agencias_servicios', TRUE);

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
		global $agencias_servicios;

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
			$this->Page_Terminate("agencias_servicioslist.php");
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
		global $Language, $agencias_servicios;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_agencias_servicios"] <> "") {
				$agencias_servicios->id_agencias_servicios->setQueryStringValue($_GET["id_agencias_servicios"]);
				$this->RecKey["id_agencias_servicios"] = $agencias_servicios->id_agencias_servicios->QueryStringValue;
			} else {
				$sReturnUrl = "agencias_servicioslist.php"; // Return to list
			}

			// Get action
			$agencias_servicios->CurrentAction = "I"; // Display form
			switch ($agencias_servicios->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "agencias_servicioslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "agencias_servicioslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$agencias_servicios->RowType = EW_ROWTYPE_VIEW;
		$agencias_servicios->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $agencias_servicios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$agencias_servicios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$agencias_servicios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $agencias_servicios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$agencias_servicios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$agencias_servicios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$agencias_servicios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $agencias_servicios;
		$sFilter = $agencias_servicios->KeyFilter();

		// Call Row Selecting event
		$agencias_servicios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$agencias_servicios->CurrentFilter = $sFilter;
		$sSql = $agencias_servicios->SQL();
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
		global $conn, $agencias_servicios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$agencias_servicios->Row_Selected($row);
		$agencias_servicios->id_agencias_servicios->setDbValue($rs->fields('id_agencias_servicios'));
		$agencias_servicios->id_agencias->setDbValue($rs->fields('id_agencias'));
		$agencias_servicios->id_servicio->setDbValue($rs->fields('id_servicio'));
		$agencias_servicios->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $agencias_servicios;

		// Initialize URLs
		$this->AddUrl = $agencias_servicios->AddUrl();
		$this->EditUrl = $agencias_servicios->EditUrl();
		$this->CopyUrl = $agencias_servicios->CopyUrl();
		$this->DeleteUrl = $agencias_servicios->DeleteUrl();
		$this->ListUrl = $agencias_servicios->ListUrl();

		// Call Row_Rendering event
		$agencias_servicios->Row_Rendering();

		// Common render codes for all row types
		// id_agencias_servicios
		// id_agencias
		// id_servicio
		// estatus

		if ($agencias_servicios->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_agencias_servicios
			$agencias_servicios->id_agencias_servicios->ViewValue = $agencias_servicios->id_agencias_servicios->CurrentValue;
			$agencias_servicios->id_agencias_servicios->ViewCustomAttributes = "";

			// id_agencias
			if (strval($agencias_servicios->id_agencias->CurrentValue) <> "") {
				$sFilterWrk = "`id_agencias` = " . ew_AdjustSql($agencias_servicios->id_agencias->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre`, `direccion` FROM `agencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias_servicios->id_agencias->ViewValue = $rswrk->fields('nombre');
					$agencias_servicios->id_agencias->ViewValue .= ew_ValueSeparator(0,1,$agencias_servicios->id_agencias) . $rswrk->fields('direccion');
					$rswrk->Close();
				} else {
					$agencias_servicios->id_agencias->ViewValue = $agencias_servicios->id_agencias->CurrentValue;
				}
			} else {
				$agencias_servicios->id_agencias->ViewValue = NULL;
			}
			$agencias_servicios->id_agencias->ViewCustomAttributes = "";

			// id_servicio
			if (strval($agencias_servicios->id_servicio->CurrentValue) <> "") {
				$sFilterWrk = "`id_servicios` = " . ew_AdjustSql($agencias_servicios->id_servicio->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `servicios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias_servicios->id_servicio->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$agencias_servicios->id_servicio->ViewValue = $agencias_servicios->id_servicio->CurrentValue;
				}
			} else {
				$agencias_servicios->id_servicio->ViewValue = NULL;
			}
			$agencias_servicios->id_servicio->ViewCustomAttributes = "";

			// estatus
			if (strval($agencias_servicios->estatus->CurrentValue) <> "") {
				switch ($agencias_servicios->estatus->CurrentValue) {
					case "1":
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->FldTagCaption(1) <> "" ? $agencias_servicios->estatus->FldTagCaption(1) : $agencias_servicios->estatus->CurrentValue;
						break;
					case "0":
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->FldTagCaption(2) <> "" ? $agencias_servicios->estatus->FldTagCaption(2) : $agencias_servicios->estatus->CurrentValue;
						break;
					default:
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->CurrentValue;
				}
			} else {
				$agencias_servicios->estatus->ViewValue = NULL;
			}
			$agencias_servicios->estatus->ViewCustomAttributes = "";

			// id_agencias_servicios
			$agencias_servicios->id_agencias_servicios->LinkCustomAttributes = "";
			$agencias_servicios->id_agencias_servicios->HrefValue = "";
			$agencias_servicios->id_agencias_servicios->TooltipValue = "";

			// id_agencias
			$agencias_servicios->id_agencias->LinkCustomAttributes = "";
			$agencias_servicios->id_agencias->HrefValue = "";
			$agencias_servicios->id_agencias->TooltipValue = "";

			// id_servicio
			$agencias_servicios->id_servicio->LinkCustomAttributes = "";
			$agencias_servicios->id_servicio->HrefValue = "";
			$agencias_servicios->id_servicio->TooltipValue = "";

			// estatus
			$agencias_servicios->estatus->LinkCustomAttributes = "";
			$agencias_servicios->estatus->HrefValue = "";
			$agencias_servicios->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($agencias_servicios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$agencias_servicios->Row_Rendered();
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
