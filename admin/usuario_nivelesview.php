<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuario_nivelesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuario_niveles_view = new cusuario_niveles_view();
$Page =& $usuario_niveles_view;

// Page init
$usuario_niveles_view->Page_Init();

// Page main
$usuario_niveles_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuario_niveles->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuario_niveles_view = new ew_Page("usuario_niveles_view");

// page properties
usuario_niveles_view.PageID = "view"; // page ID
usuario_niveles_view.FormID = "fusuario_nivelesview"; // form ID
var EW_PAGE_ID = usuario_niveles_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuario_niveles_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuario_niveles_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuario_niveles_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuario_niveles->TableCaption() ?>
&nbsp;&nbsp;<?php $usuario_niveles_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($usuario_niveles->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $usuario_niveles_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuario_niveles_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuario_niveles_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuario_niveles_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $usuario_niveles_view->ShowPageHeader(); ?>
<?php
$usuario_niveles_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuario_niveles->UserLevelID->Visible) { // UserLevelID ?>
	<tr id="r_UserLevelID"<?php echo $usuario_niveles->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuario_niveles->UserLevelID->FldCaption() ?></td>
		<td<?php echo $usuario_niveles->UserLevelID->CellAttributes() ?>>
<div<?php echo $usuario_niveles->UserLevelID->ViewAttributes() ?>><?php echo $usuario_niveles->UserLevelID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuario_niveles->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $usuario_niveles->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuario_niveles->nombre->FldCaption() ?></td>
		<td<?php echo $usuario_niveles->nombre->CellAttributes() ?>>
<div<?php echo $usuario_niveles->nombre->ViewAttributes() ?>><?php echo $usuario_niveles->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$usuario_niveles_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuario_niveles->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuario_niveles_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuario_niveles_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'usuario_niveles';

	// Page object name
	var $PageObjName = 'usuario_niveles_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuario_niveles;
		if ($usuario_niveles->UseTokenInUrl) $PageUrl .= "t=" . $usuario_niveles->TableVar . "&"; // Add page token
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
		global $objForm, $usuario_niveles;
		if ($usuario_niveles->UseTokenInUrl) {
			if ($objForm)
				return ($usuario_niveles->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuario_niveles->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuario_niveles_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuario_niveles)
		if (!isset($GLOBALS["usuario_niveles"])) {
			$GLOBALS["usuario_niveles"] = new cusuario_niveles();
			$GLOBALS["Table"] =& $GLOBALS["usuario_niveles"];
		}
		$KeyUrl = "";
		if (@$_GET["UserLevelID"] <> "") {
			$this->RecKey["UserLevelID"] = $_GET["UserLevelID"];
			$KeyUrl .= "&UserLevelID=" . urlencode($this->RecKey["UserLevelID"]);
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
			define("EW_TABLE_NAME", 'usuario_niveles', TRUE);

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
		global $usuario_niveles;

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
		global $Language, $usuario_niveles;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["UserLevelID"] <> "") {
				$usuario_niveles->UserLevelID->setQueryStringValue($_GET["UserLevelID"]);
				$this->RecKey["UserLevelID"] = $usuario_niveles->UserLevelID->QueryStringValue;
			} else {
				$sReturnUrl = "usuario_niveleslist.php"; // Return to list
			}

			// Get action
			$usuario_niveles->CurrentAction = "I"; // Display form
			switch ($usuario_niveles->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "usuario_niveleslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "usuario_niveleslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$usuario_niveles->RowType = EW_ROWTYPE_VIEW;
		$usuario_niveles->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuario_niveles;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuario_niveles->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuario_niveles->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuario_niveles->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuario_niveles->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuario_niveles->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuario_niveles->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuario_niveles;
		$sFilter = $usuario_niveles->KeyFilter();

		// Call Row Selecting event
		$usuario_niveles->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuario_niveles->CurrentFilter = $sFilter;
		$sSql = $usuario_niveles->SQL();
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
		global $conn, $usuario_niveles;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuario_niveles->Row_Selected($row);
		$usuario_niveles->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$usuario_niveles->nombre->setDbValue($rs->fields('nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuario_niveles;

		// Initialize URLs
		$this->AddUrl = $usuario_niveles->AddUrl();
		$this->EditUrl = $usuario_niveles->EditUrl();
		$this->CopyUrl = $usuario_niveles->CopyUrl();
		$this->DeleteUrl = $usuario_niveles->DeleteUrl();
		$this->ListUrl = $usuario_niveles->ListUrl();

		// Call Row_Rendering event
		$usuario_niveles->Row_Rendering();

		// Common render codes for all row types
		// UserLevelID
		// nombre

		if ($usuario_niveles->RowType == EW_ROWTYPE_VIEW) { // View row

			// UserLevelID
			$usuario_niveles->UserLevelID->ViewValue = $usuario_niveles->UserLevelID->CurrentValue;
			$usuario_niveles->UserLevelID->ViewCustomAttributes = "";

			// nombre
			$usuario_niveles->nombre->ViewValue = $usuario_niveles->nombre->CurrentValue;
			$usuario_niveles->nombre->ViewCustomAttributes = "";

			// UserLevelID
			$usuario_niveles->UserLevelID->LinkCustomAttributes = "";
			$usuario_niveles->UserLevelID->HrefValue = "";
			$usuario_niveles->UserLevelID->TooltipValue = "";

			// nombre
			$usuario_niveles->nombre->LinkCustomAttributes = "";
			$usuario_niveles->nombre->HrefValue = "";
			$usuario_niveles->nombre->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuario_niveles->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuario_niveles->Row_Rendered();
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
