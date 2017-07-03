<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "actividad_economicainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$actividad_economica_view = new cactividad_economica_view();
$Page =& $actividad_economica_view;

// Page init
$actividad_economica_view->Page_Init();

// Page main
$actividad_economica_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($actividad_economica->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var actividad_economica_view = new ew_Page("actividad_economica_view");

// page properties
actividad_economica_view.PageID = "view"; // page ID
actividad_economica_view.FormID = "factividad_economicaview"; // form ID
var EW_PAGE_ID = actividad_economica_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
actividad_economica_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
actividad_economica_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
actividad_economica_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $actividad_economica->TableCaption() ?>
&nbsp;&nbsp;<?php $actividad_economica_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($actividad_economica->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $actividad_economica_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $actividad_economica_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $actividad_economica_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $actividad_economica_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $actividad_economica_view->ShowPageHeader(); ?>
<?php
$actividad_economica_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($actividad_economica->id_acteconomica->Visible) { // id_acteconomica ?>
	<tr id="r_id_acteconomica"<?php echo $actividad_economica->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $actividad_economica->id_acteconomica->FldCaption() ?></td>
		<td<?php echo $actividad_economica->id_acteconomica->CellAttributes() ?>>
<div<?php echo $actividad_economica->id_acteconomica->ViewAttributes() ?>><?php echo $actividad_economica->id_acteconomica->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($actividad_economica->actividad->Visible) { // actividad ?>
	<tr id="r_actividad"<?php echo $actividad_economica->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $actividad_economica->actividad->FldCaption() ?></td>
		<td<?php echo $actividad_economica->actividad->CellAttributes() ?>>
<div<?php echo $actividad_economica->actividad->ViewAttributes() ?>><?php echo $actividad_economica->actividad->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($actividad_economica->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $actividad_economica->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $actividad_economica->visibilidad->FldCaption() ?></td>
		<td<?php echo $actividad_economica->visibilidad->CellAttributes() ?>>
<div<?php echo $actividad_economica->visibilidad->ViewAttributes() ?>><?php echo $actividad_economica->visibilidad->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$actividad_economica_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($actividad_economica->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$actividad_economica_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cactividad_economica_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'actividad_economica';

	// Page object name
	var $PageObjName = 'actividad_economica_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $actividad_economica;
		if ($actividad_economica->UseTokenInUrl) $PageUrl .= "t=" . $actividad_economica->TableVar . "&"; // Add page token
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
		global $objForm, $actividad_economica;
		if ($actividad_economica->UseTokenInUrl) {
			if ($objForm)
				return ($actividad_economica->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($actividad_economica->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cactividad_economica_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (actividad_economica)
		if (!isset($GLOBALS["actividad_economica"])) {
			$GLOBALS["actividad_economica"] = new cactividad_economica();
			$GLOBALS["Table"] =& $GLOBALS["actividad_economica"];
		}
		$KeyUrl = "";
		if (@$_GET["id_acteconomica"] <> "") {
			$this->RecKey["id_acteconomica"] = $_GET["id_acteconomica"];
			$KeyUrl .= "&id_acteconomica=" . urlencode($this->RecKey["id_acteconomica"]);
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
			define("EW_TABLE_NAME", 'actividad_economica', TRUE);

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
		global $actividad_economica;

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
		global $Language, $actividad_economica;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_acteconomica"] <> "") {
				$actividad_economica->id_acteconomica->setQueryStringValue($_GET["id_acteconomica"]);
				$this->RecKey["id_acteconomica"] = $actividad_economica->id_acteconomica->QueryStringValue;
			} else {
				$sReturnUrl = "actividad_economicalist.php"; // Return to list
			}

			// Get action
			$actividad_economica->CurrentAction = "I"; // Display form
			switch ($actividad_economica->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "actividad_economicalist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "actividad_economicalist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$actividad_economica->RowType = EW_ROWTYPE_VIEW;
		$actividad_economica->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $actividad_economica;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$actividad_economica->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$actividad_economica->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $actividad_economica->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$actividad_economica->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$actividad_economica->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$actividad_economica->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $actividad_economica;
		$sFilter = $actividad_economica->KeyFilter();

		// Call Row Selecting event
		$actividad_economica->Row_Selecting($sFilter);

		// Load SQL based on filter
		$actividad_economica->CurrentFilter = $sFilter;
		$sSql = $actividad_economica->SQL();
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
		global $conn, $actividad_economica;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$actividad_economica->Row_Selected($row);
		$actividad_economica->id_acteconomica->setDbValue($rs->fields('id_acteconomica'));
		$actividad_economica->actividad->setDbValue($rs->fields('actividad'));
		$actividad_economica->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $actividad_economica;

		// Initialize URLs
		$this->AddUrl = $actividad_economica->AddUrl();
		$this->EditUrl = $actividad_economica->EditUrl();
		$this->CopyUrl = $actividad_economica->CopyUrl();
		$this->DeleteUrl = $actividad_economica->DeleteUrl();
		$this->ListUrl = $actividad_economica->ListUrl();

		// Call Row_Rendering event
		$actividad_economica->Row_Rendering();

		// Common render codes for all row types
		// id_acteconomica
		// actividad
		// visibilidad

		if ($actividad_economica->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_acteconomica
			$actividad_economica->id_acteconomica->ViewValue = $actividad_economica->id_acteconomica->CurrentValue;
			$actividad_economica->id_acteconomica->ViewCustomAttributes = "";

			// actividad
			$actividad_economica->actividad->ViewValue = $actividad_economica->actividad->CurrentValue;
			$actividad_economica->actividad->ViewCustomAttributes = "";

			// visibilidad
			if (strval($actividad_economica->visibilidad->CurrentValue) <> "") {
				switch ($actividad_economica->visibilidad->CurrentValue) {
					case "1":
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->FldTagCaption(1) <> "" ? $actividad_economica->visibilidad->FldTagCaption(1) : $actividad_economica->visibilidad->CurrentValue;
						break;
					case "0":
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->FldTagCaption(2) <> "" ? $actividad_economica->visibilidad->FldTagCaption(2) : $actividad_economica->visibilidad->CurrentValue;
						break;
					default:
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->CurrentValue;
				}
			} else {
				$actividad_economica->visibilidad->ViewValue = NULL;
			}
			$actividad_economica->visibilidad->ViewCustomAttributes = "";

			// id_acteconomica
			$actividad_economica->id_acteconomica->LinkCustomAttributes = "";
			$actividad_economica->id_acteconomica->HrefValue = "";
			$actividad_economica->id_acteconomica->TooltipValue = "";

			// actividad
			$actividad_economica->actividad->LinkCustomAttributes = "";
			$actividad_economica->actividad->HrefValue = "";
			$actividad_economica->actividad->TooltipValue = "";

			// visibilidad
			$actividad_economica->visibilidad->LinkCustomAttributes = "";
			$actividad_economica->visibilidad->HrefValue = "";
			$actividad_economica->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($actividad_economica->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$actividad_economica->Row_Rendered();
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
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
