<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "departamentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$departamentos_view = new cdepartamentos_view();
$Page =& $departamentos_view;

// Page init
$departamentos_view->Page_Init();

// Page main
$departamentos_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($departamentos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var departamentos_view = new ew_Page("departamentos_view");

// page properties
departamentos_view.PageID = "view"; // page ID
departamentos_view.FormID = "fdepartamentosview"; // form ID
var EW_PAGE_ID = departamentos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
departamentos_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
departamentos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
departamentos_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $departamentos->TableCaption() ?>
&nbsp;&nbsp;<?php $departamentos_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($departamentos->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $departamentos_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $departamentos_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $departamentos_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $departamentos_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $departamentos_view->ShowPageHeader(); ?>
<?php
$departamentos_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($departamentos->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $departamentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $departamentos->nombre->FldCaption() ?></td>
		<td<?php echo $departamentos->nombre->CellAttributes() ?>>
<div<?php echo $departamentos->nombre->ViewAttributes() ?>><?php echo $departamentos->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($departamentos->zemail->Visible) { // email ?>
	<tr id="r_zemail"<?php echo $departamentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $departamentos->zemail->FldCaption() ?></td>
		<td<?php echo $departamentos->zemail->CellAttributes() ?>>
<div<?php echo $departamentos->zemail->ViewAttributes() ?>><?php echo $departamentos->zemail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($departamentos->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $departamentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $departamentos->estatus->FldCaption() ?></td>
		<td<?php echo $departamentos->estatus->CellAttributes() ?>>
<div<?php echo $departamentos->estatus->ViewAttributes() ?>><?php echo $departamentos->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$departamentos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($departamentos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$departamentos_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cdepartamentos_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'departamentos';

	// Page object name
	var $PageObjName = 'departamentos_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $departamentos;
		if ($departamentos->UseTokenInUrl) $PageUrl .= "t=" . $departamentos->TableVar . "&"; // Add page token
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
		global $objForm, $departamentos;
		if ($departamentos->UseTokenInUrl) {
			if ($objForm)
				return ($departamentos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($departamentos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdepartamentos_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (departamentos)
		if (!isset($GLOBALS["departamentos"])) {
			$GLOBALS["departamentos"] = new cdepartamentos();
			$GLOBALS["Table"] =& $GLOBALS["departamentos"];
		}
		$KeyUrl = "";
		if (@$_GET["id_departamentos"] <> "") {
			$this->RecKey["id_departamentos"] = $_GET["id_departamentos"];
			$KeyUrl .= "&id_departamentos=" . urlencode($this->RecKey["id_departamentos"]);
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
			define("EW_TABLE_NAME", 'departamentos', TRUE);

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
		global $departamentos;

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
			$this->Page_Terminate("departamentoslist.php");
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
		global $Language, $departamentos;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_departamentos"] <> "") {
				$departamentos->id_departamentos->setQueryStringValue($_GET["id_departamentos"]);
				$this->RecKey["id_departamentos"] = $departamentos->id_departamentos->QueryStringValue;
			} else {
				$sReturnUrl = "departamentoslist.php"; // Return to list
			}

			// Get action
			$departamentos->CurrentAction = "I"; // Display form
			switch ($departamentos->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "departamentoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "departamentoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$departamentos->RowType = EW_ROWTYPE_VIEW;
		$departamentos->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $departamentos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$departamentos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$departamentos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $departamentos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$departamentos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$departamentos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$departamentos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $departamentos;
		$sFilter = $departamentos->KeyFilter();

		// Call Row Selecting event
		$departamentos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$departamentos->CurrentFilter = $sFilter;
		$sSql = $departamentos->SQL();
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
		global $conn, $departamentos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$departamentos->Row_Selected($row);
		$departamentos->id_departamentos->setDbValue($rs->fields('id_departamentos'));
		$departamentos->nombre->setDbValue($rs->fields('nombre'));
		$departamentos->zemail->setDbValue($rs->fields('email'));
		$departamentos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $departamentos;

		// Initialize URLs
		$this->AddUrl = $departamentos->AddUrl();
		$this->EditUrl = $departamentos->EditUrl();
		$this->CopyUrl = $departamentos->CopyUrl();
		$this->DeleteUrl = $departamentos->DeleteUrl();
		$this->ListUrl = $departamentos->ListUrl();

		// Call Row_Rendering event
		$departamentos->Row_Rendering();

		// Common render codes for all row types
		// id_departamentos
		// nombre
		// email
		// estatus

		if ($departamentos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_departamentos
			$departamentos->id_departamentos->ViewValue = $departamentos->id_departamentos->CurrentValue;
			$departamentos->id_departamentos->ViewCustomAttributes = "";

			// nombre
			$departamentos->nombre->ViewValue = $departamentos->nombre->CurrentValue;
			$departamentos->nombre->ViewCustomAttributes = "";

			// email
			$departamentos->zemail->ViewValue = $departamentos->zemail->CurrentValue;
			$departamentos->zemail->ViewCustomAttributes = "";

			// estatus
			if (strval($departamentos->estatus->CurrentValue) <> "") {
				switch ($departamentos->estatus->CurrentValue) {
					case "1":
						$departamentos->estatus->ViewValue = $departamentos->estatus->FldTagCaption(1) <> "" ? $departamentos->estatus->FldTagCaption(1) : $departamentos->estatus->CurrentValue;
						break;
					case "0":
						$departamentos->estatus->ViewValue = $departamentos->estatus->FldTagCaption(2) <> "" ? $departamentos->estatus->FldTagCaption(2) : $departamentos->estatus->CurrentValue;
						break;
					default:
						$departamentos->estatus->ViewValue = $departamentos->estatus->CurrentValue;
				}
			} else {
				$departamentos->estatus->ViewValue = NULL;
			}
			$departamentos->estatus->ViewCustomAttributes = "";

			// nombre
			$departamentos->nombre->LinkCustomAttributes = "";
			$departamentos->nombre->HrefValue = "";
			$departamentos->nombre->TooltipValue = "";

			// email
			$departamentos->zemail->LinkCustomAttributes = "";
			$departamentos->zemail->HrefValue = "";
			$departamentos->zemail->TooltipValue = "";

			// estatus
			$departamentos->estatus->LinkCustomAttributes = "";
			$departamentos->estatus->HrefValue = "";
			$departamentos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($departamentos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$departamentos->Row_Rendered();
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
