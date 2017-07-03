<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_municipiosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_municipios_view = new cz_municipios_view();
$Page =& $z_municipios_view;

// Page init
$z_municipios_view->Page_Init();

// Page main
$z_municipios_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_municipios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_municipios_view = new ew_Page("z_municipios_view");

// page properties
z_municipios_view.PageID = "view"; // page ID
z_municipios_view.FormID = "fz_municipiosview"; // form ID
var EW_PAGE_ID = z_municipios_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_municipios_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_municipios_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_municipios_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_municipios->TableCaption() ?>
&nbsp;&nbsp;<?php $z_municipios_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_municipios->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $z_municipios_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $z_municipios_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $z_municipios_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $z_municipios_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $z_municipios_view->ShowPageHeader(); ?>
<?php
$z_municipios_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_municipios->lp_municipio_id->Visible) { // lp_municipio_id ?>
	<tr id="r_lp_municipio_id"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->lp_municipio_id->FldCaption() ?></td>
		<td<?php echo $z_municipios->lp_municipio_id->CellAttributes() ?>>
<div<?php echo $z_municipios->lp_municipio_id->ViewAttributes() ?>><?php echo $z_municipios->lp_municipio_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->nombre->FldCaption() ?></td>
		<td<?php echo $z_municipios->nombre->CellAttributes() ?>>
<div<?php echo $z_municipios->nombre->ViewAttributes() ?>><?php echo $z_municipios->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->visibilidad->FldCaption() ?></td>
		<td<?php echo $z_municipios->visibilidad->CellAttributes() ?>>
<div<?php echo $z_municipios->visibilidad->ViewAttributes() ?>><?php echo $z_municipios->visibilidad->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->lf_estado->Visible) { // lf_estado ?>
	<tr id="r_lf_estado"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->lf_estado->FldCaption() ?></td>
		<td<?php echo $z_municipios->lf_estado->CellAttributes() ?>>
<div<?php echo $z_municipios->lf_estado->ViewAttributes() ?>><?php echo $z_municipios->lf_estado->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->pk_municipio->Visible) { // pk_municipio ?>
	<tr id="r_pk_municipio"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->pk_municipio->FldCaption() ?></td>
		<td<?php echo $z_municipios->pk_municipio->CellAttributes() ?>>
<div<?php echo $z_municipios->pk_municipio->ViewAttributes() ?>><?php echo $z_municipios->pk_municipio->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$z_municipios_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_municipios->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_municipios_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_municipios_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = '_municipios';

	// Page object name
	var $PageObjName = 'z_municipios_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_municipios;
		if ($z_municipios->UseTokenInUrl) $PageUrl .= "t=" . $z_municipios->TableVar . "&"; // Add page token
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
		global $objForm, $z_municipios;
		if ($z_municipios->UseTokenInUrl) {
			if ($objForm)
				return ($z_municipios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_municipios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_municipios_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_municipios)
		if (!isset($GLOBALS["z_municipios"])) {
			$GLOBALS["z_municipios"] = new cz_municipios();
			$GLOBALS["Table"] =& $GLOBALS["z_municipios"];
		}
		$KeyUrl = "";
		if (@$_GET["lp_municipio_id"] <> "") {
			$this->RecKey["lp_municipio_id"] = $_GET["lp_municipio_id"];
			$KeyUrl .= "&lp_municipio_id=" . urlencode($this->RecKey["lp_municipio_id"]);
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
			define("EW_TABLE_NAME", '_municipios', TRUE);

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
		global $z_municipios;

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
		global $Language, $z_municipios;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["lp_municipio_id"] <> "") {
				$z_municipios->lp_municipio_id->setQueryStringValue($_GET["lp_municipio_id"]);
				$this->RecKey["lp_municipio_id"] = $z_municipios->lp_municipio_id->QueryStringValue;
			} else {
				$sReturnUrl = "z_municipioslist.php"; // Return to list
			}

			// Get action
			$z_municipios->CurrentAction = "I"; // Display form
			switch ($z_municipios->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "z_municipioslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "z_municipioslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$z_municipios->RowType = EW_ROWTYPE_VIEW;
		$z_municipios->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_municipios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_municipios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_municipios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_municipios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_municipios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_municipios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_municipios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_municipios;
		$sFilter = $z_municipios->KeyFilter();

		// Call Row Selecting event
		$z_municipios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_municipios->CurrentFilter = $sFilter;
		$sSql = $z_municipios->SQL();
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
		global $conn, $z_municipios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_municipios->Row_Selected($row);
		$z_municipios->lp_municipio_id->setDbValue($rs->fields('lp_municipio_id'));
		$z_municipios->nombre->setDbValue($rs->fields('nombre'));
		$z_municipios->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_municipios->lf_estado->setDbValue($rs->fields('lf_estado'));
		$z_municipios->pk_municipio->setDbValue($rs->fields('pk_municipio'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_municipios;

		// Initialize URLs
		$this->AddUrl = $z_municipios->AddUrl();
		$this->EditUrl = $z_municipios->EditUrl();
		$this->CopyUrl = $z_municipios->CopyUrl();
		$this->DeleteUrl = $z_municipios->DeleteUrl();
		$this->ListUrl = $z_municipios->ListUrl();

		// Call Row_Rendering event
		$z_municipios->Row_Rendering();

		// Common render codes for all row types
		// lp_municipio_id
		// nombre
		// visibilidad
		// lf_estado
		// pk_municipio

		if ($z_municipios->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_municipio_id
			$z_municipios->lp_municipio_id->ViewValue = $z_municipios->lp_municipio_id->CurrentValue;
			$z_municipios->lp_municipio_id->ViewCustomAttributes = "";

			// nombre
			$z_municipios->nombre->ViewValue = $z_municipios->nombre->CurrentValue;
			$z_municipios->nombre->ViewCustomAttributes = "";

			// visibilidad
			$z_municipios->visibilidad->ViewValue = $z_municipios->visibilidad->CurrentValue;
			$z_municipios->visibilidad->ViewCustomAttributes = "";

			// lf_estado
			$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
			if (strval($z_municipios->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_municipios->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_municipios->lf_estado->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
				}
			} else {
				$z_municipios->lf_estado->ViewValue = NULL;
			}
			$z_municipios->lf_estado->ViewCustomAttributes = "";

			// pk_municipio
			$z_municipios->pk_municipio->ViewValue = $z_municipios->pk_municipio->CurrentValue;
			$z_municipios->pk_municipio->ViewCustomAttributes = "";

			// lp_municipio_id
			$z_municipios->lp_municipio_id->LinkCustomAttributes = "";
			$z_municipios->lp_municipio_id->HrefValue = "";
			$z_municipios->lp_municipio_id->TooltipValue = "";

			// nombre
			$z_municipios->nombre->LinkCustomAttributes = "";
			$z_municipios->nombre->HrefValue = "";
			$z_municipios->nombre->TooltipValue = "";

			// visibilidad
			$z_municipios->visibilidad->LinkCustomAttributes = "";
			$z_municipios->visibilidad->HrefValue = "";
			$z_municipios->visibilidad->TooltipValue = "";

			// lf_estado
			$z_municipios->lf_estado->LinkCustomAttributes = "";
			$z_municipios->lf_estado->HrefValue = "";
			$z_municipios->lf_estado->TooltipValue = "";

			// pk_municipio
			$z_municipios->pk_municipio->LinkCustomAttributes = "";
			$z_municipios->pk_municipio->HrefValue = "";
			$z_municipios->pk_municipio->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_municipios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_municipios->Row_Rendered();
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
