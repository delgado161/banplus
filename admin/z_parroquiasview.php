<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_parroquiasinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_parroquias_view = new cz_parroquias_view();
$Page =& $z_parroquias_view;

// Page init
$z_parroquias_view->Page_Init();

// Page main
$z_parroquias_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_parroquias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_parroquias_view = new ew_Page("z_parroquias_view");

// page properties
z_parroquias_view.PageID = "view"; // page ID
z_parroquias_view.FormID = "fz_parroquiasview"; // form ID
var EW_PAGE_ID = z_parroquias_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_parroquias_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_parroquias_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_parroquias_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_parroquias->TableCaption() ?>
&nbsp;&nbsp;<?php $z_parroquias_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_parroquias->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $z_parroquias_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $z_parroquias_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $z_parroquias_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $z_parroquias_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $z_parroquias_view->ShowPageHeader(); ?>
<?php
$z_parroquias_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_parroquias->lp_parroquia_id->Visible) { // lp_parroquia_id ?>
	<tr id="r_lp_parroquia_id"<?php echo $z_parroquias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_parroquias->lp_parroquia_id->FldCaption() ?></td>
		<td<?php echo $z_parroquias->lp_parroquia_id->CellAttributes() ?>>
<div<?php echo $z_parroquias->lp_parroquia_id->ViewAttributes() ?>><?php echo $z_parroquias->lp_parroquia_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_parroquias->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $z_parroquias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_parroquias->nombre->FldCaption() ?></td>
		<td<?php echo $z_parroquias->nombre->CellAttributes() ?>>
<div<?php echo $z_parroquias->nombre->ViewAttributes() ?>><?php echo $z_parroquias->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_parroquias->lf_parroquia_municipio->Visible) { // lf_parroquia_municipio ?>
	<tr id="r_lf_parroquia_municipio"<?php echo $z_parroquias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_parroquias->lf_parroquia_municipio->FldCaption() ?></td>
		<td<?php echo $z_parroquias->lf_parroquia_municipio->CellAttributes() ?>>
<div<?php echo $z_parroquias->lf_parroquia_municipio->ViewAttributes() ?>><?php echo $z_parroquias->lf_parroquia_municipio->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_parroquias->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_parroquias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_parroquias->visibilidad->FldCaption() ?></td>
		<td<?php echo $z_parroquias->visibilidad->CellAttributes() ?>>
<div<?php echo $z_parroquias->visibilidad->ViewAttributes() ?>><?php echo $z_parroquias->visibilidad->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$z_parroquias_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_parroquias->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_parroquias_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_parroquias_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = '_parroquias';

	// Page object name
	var $PageObjName = 'z_parroquias_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_parroquias;
		if ($z_parroquias->UseTokenInUrl) $PageUrl .= "t=" . $z_parroquias->TableVar . "&"; // Add page token
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
		global $objForm, $z_parroquias;
		if ($z_parroquias->UseTokenInUrl) {
			if ($objForm)
				return ($z_parroquias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_parroquias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_parroquias_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_parroquias)
		if (!isset($GLOBALS["z_parroquias"])) {
			$GLOBALS["z_parroquias"] = new cz_parroquias();
			$GLOBALS["Table"] =& $GLOBALS["z_parroquias"];
		}
		$KeyUrl = "";
		if (@$_GET["lp_parroquia_id"] <> "") {
			$this->RecKey["lp_parroquia_id"] = $_GET["lp_parroquia_id"];
			$KeyUrl .= "&lp_parroquia_id=" . urlencode($this->RecKey["lp_parroquia_id"]);
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
			define("EW_TABLE_NAME", '_parroquias', TRUE);

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
		global $z_parroquias;

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
		global $Language, $z_parroquias;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["lp_parroquia_id"] <> "") {
				$z_parroquias->lp_parroquia_id->setQueryStringValue($_GET["lp_parroquia_id"]);
				$this->RecKey["lp_parroquia_id"] = $z_parroquias->lp_parroquia_id->QueryStringValue;
			} else {
				$sReturnUrl = "z_parroquiaslist.php"; // Return to list
			}

			// Get action
			$z_parroquias->CurrentAction = "I"; // Display form
			switch ($z_parroquias->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "z_parroquiaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "z_parroquiaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$z_parroquias->RowType = EW_ROWTYPE_VIEW;
		$z_parroquias->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_parroquias;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_parroquias->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_parroquias->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_parroquias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_parroquias->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_parroquias->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_parroquias->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_parroquias;
		$sFilter = $z_parroquias->KeyFilter();

		// Call Row Selecting event
		$z_parroquias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_parroquias->CurrentFilter = $sFilter;
		$sSql = $z_parroquias->SQL();
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
		global $conn, $z_parroquias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_parroquias->Row_Selected($row);
		$z_parroquias->lp_parroquia_id->setDbValue($rs->fields('lp_parroquia_id'));
		$z_parroquias->nombre->setDbValue($rs->fields('nombre'));
		$z_parroquias->lf_parroquia_municipio->setDbValue($rs->fields('lf_parroquia_municipio'));
		$z_parroquias->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_parroquias;

		// Initialize URLs
		$this->AddUrl = $z_parroquias->AddUrl();
		$this->EditUrl = $z_parroquias->EditUrl();
		$this->CopyUrl = $z_parroquias->CopyUrl();
		$this->DeleteUrl = $z_parroquias->DeleteUrl();
		$this->ListUrl = $z_parroquias->ListUrl();

		// Call Row_Rendering event
		$z_parroquias->Row_Rendering();

		// Common render codes for all row types
		// lp_parroquia_id
		// nombre
		// lf_parroquia_municipio
		// visibilidad

		if ($z_parroquias->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_parroquia_id
			$z_parroquias->lp_parroquia_id->ViewValue = $z_parroquias->lp_parroquia_id->CurrentValue;
			$z_parroquias->lp_parroquia_id->ViewCustomAttributes = "";

			// nombre
			$z_parroquias->nombre->ViewValue = $z_parroquias->nombre->CurrentValue;
			$z_parroquias->nombre->ViewCustomAttributes = "";

			// lf_parroquia_municipio
			if (strval($z_parroquias->lf_parroquia_municipio->CurrentValue) <> "") {
				$sFilterWrk = "`lp_municipio_id` = '" . ew_AdjustSql($z_parroquias->lf_parroquia_municipio->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nombre` FROM `_municipios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_parroquias->lf_parroquia_municipio->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_parroquias->lf_parroquia_municipio->ViewValue = $z_parroquias->lf_parroquia_municipio->CurrentValue;
				}
			} else {
				$z_parroquias->lf_parroquia_municipio->ViewValue = NULL;
			}
			$z_parroquias->lf_parroquia_municipio->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_parroquias->visibilidad->CurrentValue) <> "") {
				switch ($z_parroquias->visibilidad->CurrentValue) {
					case "1":
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->FldTagCaption(1) <> "" ? $z_parroquias->visibilidad->FldTagCaption(1) : $z_parroquias->visibilidad->CurrentValue;
						break;
					case "0":
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->FldTagCaption(2) <> "" ? $z_parroquias->visibilidad->FldTagCaption(2) : $z_parroquias->visibilidad->CurrentValue;
						break;
					default:
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->CurrentValue;
				}
			} else {
				$z_parroquias->visibilidad->ViewValue = NULL;
			}
			$z_parroquias->visibilidad->ViewCustomAttributes = "";

			// lp_parroquia_id
			$z_parroquias->lp_parroquia_id->LinkCustomAttributes = "";
			$z_parroquias->lp_parroquia_id->HrefValue = "";
			$z_parroquias->lp_parroquia_id->TooltipValue = "";

			// nombre
			$z_parroquias->nombre->LinkCustomAttributes = "";
			$z_parroquias->nombre->HrefValue = "";
			$z_parroquias->nombre->TooltipValue = "";

			// lf_parroquia_municipio
			$z_parroquias->lf_parroquia_municipio->LinkCustomAttributes = "";
			$z_parroquias->lf_parroquia_municipio->HrefValue = "";
			$z_parroquias->lf_parroquia_municipio->TooltipValue = "";

			// visibilidad
			$z_parroquias->visibilidad->LinkCustomAttributes = "";
			$z_parroquias->visibilidad->HrefValue = "";
			$z_parroquias->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_parroquias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_parroquias->Row_Rendered();
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
