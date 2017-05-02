<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "informacion_financierainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$informacion_financiera_view = new cinformacion_financiera_view();
$Page =& $informacion_financiera_view;

// Page init
$informacion_financiera_view->Page_Init();

// Page main
$informacion_financiera_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($informacion_financiera->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var informacion_financiera_view = new ew_Page("informacion_financiera_view");

// page properties
informacion_financiera_view.PageID = "view"; // page ID
informacion_financiera_view.FormID = "finformacion_financieraview"; // form ID
var EW_PAGE_ID = informacion_financiera_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
informacion_financiera_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
informacion_financiera_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
informacion_financiera_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $informacion_financiera->TableCaption() ?>
&nbsp;&nbsp;<?php $informacion_financiera_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($informacion_financiera->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $informacion_financiera_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $informacion_financiera_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $informacion_financiera_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $informacion_financiera_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $informacion_financiera_view->ShowPageHeader(); ?>
<?php
$informacion_financiera_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($informacion_financiera->ano->Visible) { // ano ?>
	<tr id="r_ano"<?php echo $informacion_financiera->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $informacion_financiera->ano->FldCaption() ?></td>
		<td<?php echo $informacion_financiera->ano->CellAttributes() ?>>
<div<?php echo $informacion_financiera->ano->ViewAttributes() ?>><?php echo $informacion_financiera->ano->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($informacion_financiera->mes->Visible) { // mes ?>
	<tr id="r_mes"<?php echo $informacion_financiera->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $informacion_financiera->mes->FldCaption() ?></td>
		<td<?php echo $informacion_financiera->mes->CellAttributes() ?>>
<div<?php echo $informacion_financiera->mes->ViewAttributes() ?>><?php echo $informacion_financiera->mes->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($informacion_financiera->archivo->Visible) { // archivo ?>
	<tr id="r_archivo"<?php echo $informacion_financiera->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $informacion_financiera->archivo->FldCaption() ?></td>
		<td<?php echo $informacion_financiera->archivo->CellAttributes() ?>>
<?php if ($informacion_financiera->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($informacion_financiera->archivo->Upload->DbValue)) { ?>
<a<?php echo $informacion_financiera->archivo->LinkAttributes() ?>><?php echo $informacion_financiera->archivo->ViewValue ?></a>
<?php } elseif (!in_array($informacion_financiera->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($informacion_financiera->archivo->Upload->DbValue)) { ?>
<?php echo $informacion_financiera->archivo->ViewValue ?>
<?php } elseif (!in_array($informacion_financiera->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($informacion_financiera->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $informacion_financiera->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $informacion_financiera->estatus->FldCaption() ?></td>
		<td<?php echo $informacion_financiera->estatus->CellAttributes() ?>>
<div<?php echo $informacion_financiera->estatus->ViewAttributes() ?>><?php echo $informacion_financiera->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$informacion_financiera_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($informacion_financiera->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$informacion_financiera_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cinformacion_financiera_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'informacion_financiera';

	// Page object name
	var $PageObjName = 'informacion_financiera_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $informacion_financiera;
		if ($informacion_financiera->UseTokenInUrl) $PageUrl .= "t=" . $informacion_financiera->TableVar . "&"; // Add page token
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
		global $objForm, $informacion_financiera;
		if ($informacion_financiera->UseTokenInUrl) {
			if ($objForm)
				return ($informacion_financiera->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($informacion_financiera->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinformacion_financiera_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (informacion_financiera)
		if (!isset($GLOBALS["informacion_financiera"])) {
			$GLOBALS["informacion_financiera"] = new cinformacion_financiera();
			$GLOBALS["Table"] =& $GLOBALS["informacion_financiera"];
		}
		$KeyUrl = "";
		if (@$_GET["id_informacion_financiera"] <> "") {
			$this->RecKey["id_informacion_financiera"] = $_GET["id_informacion_financiera"];
			$KeyUrl .= "&id_informacion_financiera=" . urlencode($this->RecKey["id_informacion_financiera"]);
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
			define("EW_TABLE_NAME", 'informacion_financiera', TRUE);

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
		global $informacion_financiera;

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
			$this->Page_Terminate("informacion_financieralist.php");
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
		global $Language, $informacion_financiera;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_informacion_financiera"] <> "") {
				$informacion_financiera->id_informacion_financiera->setQueryStringValue($_GET["id_informacion_financiera"]);
				$this->RecKey["id_informacion_financiera"] = $informacion_financiera->id_informacion_financiera->QueryStringValue;
			} else {
				$sReturnUrl = "informacion_financieralist.php"; // Return to list
			}

			// Get action
			$informacion_financiera->CurrentAction = "I"; // Display form
			switch ($informacion_financiera->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "informacion_financieralist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "informacion_financieralist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$informacion_financiera->RowType = EW_ROWTYPE_VIEW;
		$informacion_financiera->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $informacion_financiera;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$informacion_financiera->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$informacion_financiera->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $informacion_financiera->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$informacion_financiera->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$informacion_financiera->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$informacion_financiera->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $informacion_financiera;
		$sFilter = $informacion_financiera->KeyFilter();

		// Call Row Selecting event
		$informacion_financiera->Row_Selecting($sFilter);

		// Load SQL based on filter
		$informacion_financiera->CurrentFilter = $sFilter;
		$sSql = $informacion_financiera->SQL();
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
		global $conn, $informacion_financiera;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$informacion_financiera->Row_Selected($row);
		$informacion_financiera->id_informacion_financiera->setDbValue($rs->fields('id_informacion_financiera'));
		$informacion_financiera->ano->setDbValue($rs->fields('ano'));
		$informacion_financiera->mes->setDbValue($rs->fields('mes'));
		$informacion_financiera->archivo->Upload->DbValue = $rs->fields('archivo');
		$informacion_financiera->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $informacion_financiera;

		// Initialize URLs
		$this->AddUrl = $informacion_financiera->AddUrl();
		$this->EditUrl = $informacion_financiera->EditUrl();
		$this->CopyUrl = $informacion_financiera->CopyUrl();
		$this->DeleteUrl = $informacion_financiera->DeleteUrl();
		$this->ListUrl = $informacion_financiera->ListUrl();

		// Call Row_Rendering event
		$informacion_financiera->Row_Rendering();

		// Common render codes for all row types
		// id_informacion_financiera
		// ano
		// mes
		// archivo
		// estatus

		if ($informacion_financiera->RowType == EW_ROWTYPE_VIEW) { // View row

			// ano
			$informacion_financiera->ano->ViewValue = $informacion_financiera->ano->CurrentValue;
			$informacion_financiera->ano->ViewCustomAttributes = "";

			// mes
			if (strval($informacion_financiera->mes->CurrentValue) <> "") {
				switch ($informacion_financiera->mes->CurrentValue) {
					case "1":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(1) <> "" ? $informacion_financiera->mes->FldTagCaption(1) : $informacion_financiera->mes->CurrentValue;
						break;
					case "2":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(2) <> "" ? $informacion_financiera->mes->FldTagCaption(2) : $informacion_financiera->mes->CurrentValue;
						break;
					case "3":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(3) <> "" ? $informacion_financiera->mes->FldTagCaption(3) : $informacion_financiera->mes->CurrentValue;
						break;
					case "4":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(4) <> "" ? $informacion_financiera->mes->FldTagCaption(4) : $informacion_financiera->mes->CurrentValue;
						break;
					case "5":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(5) <> "" ? $informacion_financiera->mes->FldTagCaption(5) : $informacion_financiera->mes->CurrentValue;
						break;
					case "6":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(6) <> "" ? $informacion_financiera->mes->FldTagCaption(6) : $informacion_financiera->mes->CurrentValue;
						break;
					case "7":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(7) <> "" ? $informacion_financiera->mes->FldTagCaption(7) : $informacion_financiera->mes->CurrentValue;
						break;
					case "8":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(8) <> "" ? $informacion_financiera->mes->FldTagCaption(8) : $informacion_financiera->mes->CurrentValue;
						break;
					case "9":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(9) <> "" ? $informacion_financiera->mes->FldTagCaption(9) : $informacion_financiera->mes->CurrentValue;
						break;
					case "10":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(10) <> "" ? $informacion_financiera->mes->FldTagCaption(10) : $informacion_financiera->mes->CurrentValue;
						break;
					case "11":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(11) <> "" ? $informacion_financiera->mes->FldTagCaption(11) : $informacion_financiera->mes->CurrentValue;
						break;
					case "12":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(12) <> "" ? $informacion_financiera->mes->FldTagCaption(12) : $informacion_financiera->mes->CurrentValue;
						break;
					default:
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->CurrentValue;
				}
			} else {
				$informacion_financiera->mes->ViewValue = NULL;
			}
			$informacion_financiera->mes->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->ViewValue = $informacion_financiera->archivo->Upload->DbValue;
			} else {
				$informacion_financiera->archivo->ViewValue = "";
			}
			$informacion_financiera->archivo->ViewCustomAttributes = "";

			// estatus
			if (strval($informacion_financiera->estatus->CurrentValue) <> "") {
				switch ($informacion_financiera->estatus->CurrentValue) {
					case "1":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(1) <> "" ? $informacion_financiera->estatus->FldTagCaption(1) : $informacion_financiera->estatus->CurrentValue;
						break;
					case "0":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(2) <> "" ? $informacion_financiera->estatus->FldTagCaption(2) : $informacion_financiera->estatus->CurrentValue;
						break;
					default:
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->CurrentValue;
				}
			} else {
				$informacion_financiera->estatus->ViewValue = NULL;
			}
			$informacion_financiera->estatus->ViewCustomAttributes = "";

			// ano
			$informacion_financiera->ano->LinkCustomAttributes = "";
			$informacion_financiera->ano->HrefValue = "";
			$informacion_financiera->ano->TooltipValue = "";

			// mes
			$informacion_financiera->mes->LinkCustomAttributes = "";
			$informacion_financiera->mes->HrefValue = "";
			$informacion_financiera->mes->TooltipValue = "";

			// archivo
			$informacion_financiera->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->HrefValue = ew_UploadPathEx(FALSE, $informacion_financiera->archivo->UploadPath) . ((!empty($informacion_financiera->archivo->ViewValue)) ? $informacion_financiera->archivo->ViewValue : $informacion_financiera->archivo->CurrentValue); // Add prefix/suffix
				$informacion_financiera->archivo->LinkAttrs["target"] = ""; // Add target
				if ($informacion_financiera->Export <> "") $informacion_financiera->archivo->HrefValue = ew_ConvertFullUrl($informacion_financiera->archivo->HrefValue);
			} else {
				$informacion_financiera->archivo->HrefValue = "";
			}
			$informacion_financiera->archivo->TooltipValue = "";

			// estatus
			$informacion_financiera->estatus->LinkCustomAttributes = "";
			$informacion_financiera->estatus->HrefValue = "";
			$informacion_financiera->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($informacion_financiera->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$informacion_financiera->Row_Rendered();
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
