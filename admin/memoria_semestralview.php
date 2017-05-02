<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memoria_semestralinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memoria_semestral_view = new cmemoria_semestral_view();
$Page =& $memoria_semestral_view;

// Page init
$memoria_semestral_view->Page_Init();

// Page main
$memoria_semestral_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($memoria_semestral->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var memoria_semestral_view = new ew_Page("memoria_semestral_view");

// page properties
memoria_semestral_view.PageID = "view"; // page ID
memoria_semestral_view.FormID = "fmemoria_semestralview"; // form ID
var EW_PAGE_ID = memoria_semestral_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
memoria_semestral_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
memoria_semestral_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memoria_semestral_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memoria_semestral->TableCaption() ?>
&nbsp;&nbsp;<?php $memoria_semestral_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($memoria_semestral->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $memoria_semestral_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $memoria_semestral_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $memoria_semestral_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $memoria_semestral_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $memoria_semestral_view->ShowPageHeader(); ?>
<?php
$memoria_semestral_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($memoria_semestral->id_memoria_semestral->Visible) { // id_memoria_semestral ?>
	<tr id="r_id_memoria_semestral"<?php echo $memoria_semestral->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memoria_semestral->id_memoria_semestral->FldCaption() ?></td>
		<td<?php echo $memoria_semestral->id_memoria_semestral->CellAttributes() ?>>
<div<?php echo $memoria_semestral->id_memoria_semestral->ViewAttributes() ?>><?php echo $memoria_semestral->id_memoria_semestral->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($memoria_semestral->ano->Visible) { // ano ?>
	<tr id="r_ano"<?php echo $memoria_semestral->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memoria_semestral->ano->FldCaption() ?></td>
		<td<?php echo $memoria_semestral->ano->CellAttributes() ?>>
<div<?php echo $memoria_semestral->ano->ViewAttributes() ?>><?php echo $memoria_semestral->ano->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($memoria_semestral->mes->Visible) { // mes ?>
	<tr id="r_mes"<?php echo $memoria_semestral->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memoria_semestral->mes->FldCaption() ?></td>
		<td<?php echo $memoria_semestral->mes->CellAttributes() ?>>
<div<?php echo $memoria_semestral->mes->ViewAttributes() ?>><?php echo $memoria_semestral->mes->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($memoria_semestral->archivo->Visible) { // archivo ?>
	<tr id="r_archivo"<?php echo $memoria_semestral->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memoria_semestral->archivo->FldCaption() ?></td>
		<td<?php echo $memoria_semestral->archivo->CellAttributes() ?>>
<?php if ($memoria_semestral->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($memoria_semestral->archivo->Upload->DbValue)) { ?>
<a<?php echo $memoria_semestral->archivo->LinkAttributes() ?>><?php echo $memoria_semestral->archivo->ViewValue ?></a>
<?php } elseif (!in_array($memoria_semestral->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($memoria_semestral->archivo->Upload->DbValue)) { ?>
<?php echo $memoria_semestral->archivo->ViewValue ?>
<?php } elseif (!in_array($memoria_semestral->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($memoria_semestral->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $memoria_semestral->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memoria_semestral->estatus->FldCaption() ?></td>
		<td<?php echo $memoria_semestral->estatus->CellAttributes() ?>>
<div<?php echo $memoria_semestral->estatus->ViewAttributes() ?>><?php echo $memoria_semestral->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$memoria_semestral_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($memoria_semestral->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$memoria_semestral_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemoria_semestral_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'memoria_semestral';

	// Page object name
	var $PageObjName = 'memoria_semestral_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memoria_semestral;
		if ($memoria_semestral->UseTokenInUrl) $PageUrl .= "t=" . $memoria_semestral->TableVar . "&"; // Add page token
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
		global $objForm, $memoria_semestral;
		if ($memoria_semestral->UseTokenInUrl) {
			if ($objForm)
				return ($memoria_semestral->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memoria_semestral->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemoria_semestral_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memoria_semestral)
		if (!isset($GLOBALS["memoria_semestral"])) {
			$GLOBALS["memoria_semestral"] = new cmemoria_semestral();
			$GLOBALS["Table"] =& $GLOBALS["memoria_semestral"];
		}
		$KeyUrl = "";
		if (@$_GET["id_memoria_semestral"] <> "") {
			$this->RecKey["id_memoria_semestral"] = $_GET["id_memoria_semestral"];
			$KeyUrl .= "&id_memoria_semestral=" . urlencode($this->RecKey["id_memoria_semestral"]);
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
			define("EW_TABLE_NAME", 'memoria_semestral', TRUE);

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
		global $memoria_semestral;

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
		global $Language, $memoria_semestral;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_memoria_semestral"] <> "") {
				$memoria_semestral->id_memoria_semestral->setQueryStringValue($_GET["id_memoria_semestral"]);
				$this->RecKey["id_memoria_semestral"] = $memoria_semestral->id_memoria_semestral->QueryStringValue;
			} else {
				$sReturnUrl = "memoria_semestrallist.php"; // Return to list
			}

			// Get action
			$memoria_semestral->CurrentAction = "I"; // Display form
			switch ($memoria_semestral->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "memoria_semestrallist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "memoria_semestrallist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$memoria_semestral->RowType = EW_ROWTYPE_VIEW;
		$memoria_semestral->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $memoria_semestral;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$memoria_semestral->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$memoria_semestral->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $memoria_semestral->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$memoria_semestral->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$memoria_semestral->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$memoria_semestral->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memoria_semestral;
		$sFilter = $memoria_semestral->KeyFilter();

		// Call Row Selecting event
		$memoria_semestral->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memoria_semestral->CurrentFilter = $sFilter;
		$sSql = $memoria_semestral->SQL();
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
		global $conn, $memoria_semestral;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memoria_semestral->Row_Selected($row);
		$memoria_semestral->id_memoria_semestral->setDbValue($rs->fields('id_memoria_semestral'));
		$memoria_semestral->ano->setDbValue($rs->fields('ano'));
		$memoria_semestral->mes->setDbValue($rs->fields('mes'));
		$memoria_semestral->archivo->Upload->DbValue = $rs->fields('archivo');
		$memoria_semestral->estatus->setDbValue($rs->fields('estatus'));
		$memoria_semestral->memoria_s->setDbValue($rs->fields('memoria_s'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memoria_semestral;

		// Initialize URLs
		$this->AddUrl = $memoria_semestral->AddUrl();
		$this->EditUrl = $memoria_semestral->EditUrl();
		$this->CopyUrl = $memoria_semestral->CopyUrl();
		$this->DeleteUrl = $memoria_semestral->DeleteUrl();
		$this->ListUrl = $memoria_semestral->ListUrl();

		// Call Row_Rendering event
		$memoria_semestral->Row_Rendering();

		// Common render codes for all row types
		// id_memoria_semestral
		// ano
		// mes
		// archivo
		// estatus
		// memoria_s

		if ($memoria_semestral->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_memoria_semestral
			$memoria_semestral->id_memoria_semestral->ViewValue = $memoria_semestral->id_memoria_semestral->CurrentValue;
			$memoria_semestral->id_memoria_semestral->ViewCustomAttributes = "";

			// ano
			$memoria_semestral->ano->ViewValue = $memoria_semestral->ano->CurrentValue;
			$memoria_semestral->ano->ViewCustomAttributes = "";

			// mes
			if (strval($memoria_semestral->mes->CurrentValue) <> "") {
				switch ($memoria_semestral->mes->CurrentValue) {
					case "1":
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->FldTagCaption(1) <> "" ? $memoria_semestral->mes->FldTagCaption(1) : $memoria_semestral->mes->CurrentValue;
						break;
					case "2":
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->FldTagCaption(2) <> "" ? $memoria_semestral->mes->FldTagCaption(2) : $memoria_semestral->mes->CurrentValue;
						break;
					default:
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->CurrentValue;
				}
			} else {
				$memoria_semestral->mes->ViewValue = NULL;
			}
			$memoria_semestral->mes->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->ViewValue = $memoria_semestral->archivo->Upload->DbValue;
			} else {
				$memoria_semestral->archivo->ViewValue = "";
			}
			$memoria_semestral->archivo->ViewCustomAttributes = "";

			// estatus
			if (strval($memoria_semestral->estatus->CurrentValue) <> "") {
				switch ($memoria_semestral->estatus->CurrentValue) {
					case "1":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(1) <> "" ? $memoria_semestral->estatus->FldTagCaption(1) : $memoria_semestral->estatus->CurrentValue;
						break;
					case "0":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(2) <> "" ? $memoria_semestral->estatus->FldTagCaption(2) : $memoria_semestral->estatus->CurrentValue;
						break;
					default:
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->CurrentValue;
				}
			} else {
				$memoria_semestral->estatus->ViewValue = NULL;
			}
			$memoria_semestral->estatus->ViewCustomAttributes = "";

			// id_memoria_semestral
			$memoria_semestral->id_memoria_semestral->LinkCustomAttributes = "";
			$memoria_semestral->id_memoria_semestral->HrefValue = "";
			$memoria_semestral->id_memoria_semestral->TooltipValue = "";

			// ano
			$memoria_semestral->ano->LinkCustomAttributes = "";
			$memoria_semestral->ano->HrefValue = "";
			$memoria_semestral->ano->TooltipValue = "";

			// mes
			$memoria_semestral->mes->LinkCustomAttributes = "";
			$memoria_semestral->mes->HrefValue = "";
			$memoria_semestral->mes->TooltipValue = "";

			// archivo
			$memoria_semestral->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->HrefValue = ew_UploadPathEx(FALSE, $memoria_semestral->archivo->UploadPath) . ((!empty($memoria_semestral->archivo->ViewValue)) ? $memoria_semestral->archivo->ViewValue : $memoria_semestral->archivo->CurrentValue); // Add prefix/suffix
				$memoria_semestral->archivo->LinkAttrs["target"] = ""; // Add target
				if ($memoria_semestral->Export <> "") $memoria_semestral->archivo->HrefValue = ew_ConvertFullUrl($memoria_semestral->archivo->HrefValue);
			} else {
				$memoria_semestral->archivo->HrefValue = "";
			}
			$memoria_semestral->archivo->TooltipValue = "";

			// estatus
			$memoria_semestral->estatus->LinkCustomAttributes = "";
			$memoria_semestral->estatus->HrefValue = "";
			$memoria_semestral->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($memoria_semestral->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memoria_semestral->Row_Rendered();
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
