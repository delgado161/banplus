<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "estado_civilinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$estado_civil_view = new cestado_civil_view();
$Page =& $estado_civil_view;

// Page init
$estado_civil_view->Page_Init();

// Page main
$estado_civil_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($estado_civil->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var estado_civil_view = new ew_Page("estado_civil_view");

// page properties
estado_civil_view.PageID = "view"; // page ID
estado_civil_view.FormID = "festado_civilview"; // form ID
var EW_PAGE_ID = estado_civil_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
estado_civil_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
estado_civil_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
estado_civil_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $estado_civil->TableCaption() ?>
&nbsp;&nbsp;<?php $estado_civil_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($estado_civil->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $estado_civil_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $estado_civil_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $estado_civil_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $estado_civil_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $estado_civil_view->ShowPageHeader(); ?>
<?php
$estado_civil_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($estado_civil->id_civil->Visible) { // id_civil ?>
	<tr id="r_id_civil"<?php echo $estado_civil->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado_civil->id_civil->FldCaption() ?></td>
		<td<?php echo $estado_civil->id_civil->CellAttributes() ?>>
<div<?php echo $estado_civil->id_civil->ViewAttributes() ?>><?php echo $estado_civil->id_civil->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($estado_civil->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $estado_civil->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado_civil->nombre->FldCaption() ?></td>
		<td<?php echo $estado_civil->nombre->CellAttributes() ?>>
<div<?php echo $estado_civil->nombre->ViewAttributes() ?>><?php echo $estado_civil->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($estado_civil->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $estado_civil->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado_civil->visibilidad->FldCaption() ?></td>
		<td<?php echo $estado_civil->visibilidad->CellAttributes() ?>>
<div<?php echo $estado_civil->visibilidad->ViewAttributes() ?>><?php echo $estado_civil->visibilidad->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$estado_civil_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($estado_civil->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$estado_civil_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cestado_civil_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'estado_civil';

	// Page object name
	var $PageObjName = 'estado_civil_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $estado_civil;
		if ($estado_civil->UseTokenInUrl) $PageUrl .= "t=" . $estado_civil->TableVar . "&"; // Add page token
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
		global $objForm, $estado_civil;
		if ($estado_civil->UseTokenInUrl) {
			if ($objForm)
				return ($estado_civil->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($estado_civil->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cestado_civil_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (estado_civil)
		if (!isset($GLOBALS["estado_civil"])) {
			$GLOBALS["estado_civil"] = new cestado_civil();
			$GLOBALS["Table"] =& $GLOBALS["estado_civil"];
		}
		$KeyUrl = "";
		if (@$_GET["id_civil"] <> "") {
			$this->RecKey["id_civil"] = $_GET["id_civil"];
			$KeyUrl .= "&id_civil=" . urlencode($this->RecKey["id_civil"]);
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
			define("EW_TABLE_NAME", 'estado_civil', TRUE);

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
		global $estado_civil;

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
		global $Language, $estado_civil;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_civil"] <> "") {
				$estado_civil->id_civil->setQueryStringValue($_GET["id_civil"]);
				$this->RecKey["id_civil"] = $estado_civil->id_civil->QueryStringValue;
			} else {
				$sReturnUrl = "estado_civillist.php"; // Return to list
			}

			// Get action
			$estado_civil->CurrentAction = "I"; // Display form
			switch ($estado_civil->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "estado_civillist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "estado_civillist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$estado_civil->RowType = EW_ROWTYPE_VIEW;
		$estado_civil->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $estado_civil;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$estado_civil->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$estado_civil->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $estado_civil->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$estado_civil->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$estado_civil->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$estado_civil->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $estado_civil;
		$sFilter = $estado_civil->KeyFilter();

		// Call Row Selecting event
		$estado_civil->Row_Selecting($sFilter);

		// Load SQL based on filter
		$estado_civil->CurrentFilter = $sFilter;
		$sSql = $estado_civil->SQL();
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
		global $conn, $estado_civil;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$estado_civil->Row_Selected($row);
		$estado_civil->id_civil->setDbValue($rs->fields('id_civil'));
		$estado_civil->nombre->setDbValue($rs->fields('nombre'));
		$estado_civil->id_char->setDbValue($rs->fields('id_char'));
		$estado_civil->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $estado_civil;

		// Initialize URLs
		$this->AddUrl = $estado_civil->AddUrl();
		$this->EditUrl = $estado_civil->EditUrl();
		$this->CopyUrl = $estado_civil->CopyUrl();
		$this->DeleteUrl = $estado_civil->DeleteUrl();
		$this->ListUrl = $estado_civil->ListUrl();

		// Call Row_Rendering event
		$estado_civil->Row_Rendering();

		// Common render codes for all row types
		// id_civil
		// nombre
		// id_char
		// visibilidad

		if ($estado_civil->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_civil
			$estado_civil->id_civil->ViewValue = $estado_civil->id_civil->CurrentValue;
			$estado_civil->id_civil->ViewCustomAttributes = "";

			// nombre
			$estado_civil->nombre->ViewValue = $estado_civil->nombre->CurrentValue;
			$estado_civil->nombre->ViewCustomAttributes = "";

			// id_char
			$estado_civil->id_char->ViewValue = $estado_civil->id_char->CurrentValue;
			$estado_civil->id_char->ViewCustomAttributes = "";

			// visibilidad
			if (strval($estado_civil->visibilidad->CurrentValue) <> "") {
				switch ($estado_civil->visibilidad->CurrentValue) {
					case "1":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(1) <> "" ? $estado_civil->visibilidad->FldTagCaption(1) : $estado_civil->visibilidad->CurrentValue;
						break;
					case "0":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(2) <> "" ? $estado_civil->visibilidad->FldTagCaption(2) : $estado_civil->visibilidad->CurrentValue;
						break;
					default:
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->CurrentValue;
				}
			} else {
				$estado_civil->visibilidad->ViewValue = NULL;
			}
			$estado_civil->visibilidad->ViewCustomAttributes = "";

			// id_civil
			$estado_civil->id_civil->LinkCustomAttributes = "";
			$estado_civil->id_civil->HrefValue = "";
			$estado_civil->id_civil->TooltipValue = "";

			// nombre
			$estado_civil->nombre->LinkCustomAttributes = "";
			$estado_civil->nombre->HrefValue = "";
			$estado_civil->nombre->TooltipValue = "";

			// visibilidad
			$estado_civil->visibilidad->LinkCustomAttributes = "";
			$estado_civil->visibilidad->HrefValue = "";
			$estado_civil->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($estado_civil->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$estado_civil->Row_Rendered();
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
