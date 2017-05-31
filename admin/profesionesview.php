<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "profesionesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$profesiones_view = new cprofesiones_view();
$Page =& $profesiones_view;

// Page init
$profesiones_view->Page_Init();

// Page main
$profesiones_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($profesiones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var profesiones_view = new ew_Page("profesiones_view");

// page properties
profesiones_view.PageID = "view"; // page ID
profesiones_view.FormID = "fprofesionesview"; // form ID
var EW_PAGE_ID = profesiones_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
profesiones_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
profesiones_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
profesiones_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $profesiones->TableCaption() ?>
&nbsp;&nbsp;<?php $profesiones_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($profesiones->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $profesiones_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $profesiones_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $profesiones_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $profesiones_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $profesiones_view->ShowPageHeader(); ?>
<?php
$profesiones_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($profesiones->id_profesion->Visible) { // id_profesion ?>
	<tr id="r_id_profesion"<?php echo $profesiones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $profesiones->id_profesion->FldCaption() ?></td>
		<td<?php echo $profesiones->id_profesion->CellAttributes() ?>>
<div<?php echo $profesiones->id_profesion->ViewAttributes() ?>><?php echo $profesiones->id_profesion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($profesiones->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion"<?php echo $profesiones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $profesiones->descripcion->FldCaption() ?></td>
		<td<?php echo $profesiones->descripcion->CellAttributes() ?>>
<div<?php echo $profesiones->descripcion->ViewAttributes() ?>><?php echo $profesiones->descripcion->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$profesiones_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($profesiones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$profesiones_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cprofesiones_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'profesiones';

	// Page object name
	var $PageObjName = 'profesiones_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $profesiones;
		if ($profesiones->UseTokenInUrl) $PageUrl .= "t=" . $profesiones->TableVar . "&"; // Add page token
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
		global $objForm, $profesiones;
		if ($profesiones->UseTokenInUrl) {
			if ($objForm)
				return ($profesiones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($profesiones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprofesiones_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (profesiones)
		if (!isset($GLOBALS["profesiones"])) {
			$GLOBALS["profesiones"] = new cprofesiones();
			$GLOBALS["Table"] =& $GLOBALS["profesiones"];
		}
		$KeyUrl = "";
		if (@$_GET["id_profesion"] <> "") {
			$this->RecKey["id_profesion"] = $_GET["id_profesion"];
			$KeyUrl .= "&id_profesion=" . urlencode($this->RecKey["id_profesion"]);
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
			define("EW_TABLE_NAME", 'profesiones', TRUE);

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
		global $profesiones;

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
		global $Language, $profesiones;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_profesion"] <> "") {
				$profesiones->id_profesion->setQueryStringValue($_GET["id_profesion"]);
				$this->RecKey["id_profesion"] = $profesiones->id_profesion->QueryStringValue;
			} else {
				$sReturnUrl = "profesioneslist.php"; // Return to list
			}

			// Get action
			$profesiones->CurrentAction = "I"; // Display form
			switch ($profesiones->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "profesioneslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "profesioneslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$profesiones->RowType = EW_ROWTYPE_VIEW;
		$profesiones->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $profesiones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$profesiones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$profesiones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $profesiones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$profesiones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$profesiones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$profesiones->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $profesiones;
		$sFilter = $profesiones->KeyFilter();

		// Call Row Selecting event
		$profesiones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$profesiones->CurrentFilter = $sFilter;
		$sSql = $profesiones->SQL();
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
		global $conn, $profesiones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$profesiones->Row_Selected($row);
		$profesiones->id_profesion->setDbValue($rs->fields('id_profesion'));
		$profesiones->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $profesiones;

		// Initialize URLs
		$this->AddUrl = $profesiones->AddUrl();
		$this->EditUrl = $profesiones->EditUrl();
		$this->CopyUrl = $profesiones->CopyUrl();
		$this->DeleteUrl = $profesiones->DeleteUrl();
		$this->ListUrl = $profesiones->ListUrl();

		// Call Row_Rendering event
		$profesiones->Row_Rendering();

		// Common render codes for all row types
		// id_profesion
		// descripcion

		if ($profesiones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profesion
			$profesiones->id_profesion->ViewValue = $profesiones->id_profesion->CurrentValue;
			$profesiones->id_profesion->ViewCustomAttributes = "";

			// descripcion
			$profesiones->descripcion->ViewValue = $profesiones->descripcion->CurrentValue;
			$profesiones->descripcion->ViewCustomAttributes = "";

			// id_profesion
			$profesiones->id_profesion->LinkCustomAttributes = "";
			$profesiones->id_profesion->HrefValue = "";
			$profesiones->id_profesion->TooltipValue = "";

			// descripcion
			$profesiones->descripcion->LinkCustomAttributes = "";
			$profesiones->descripcion->HrefValue = "";
			$profesiones->descripcion->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($profesiones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$profesiones->Row_Rendered();
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
