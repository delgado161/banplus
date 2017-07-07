<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_estadosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_estados_view = new cz_estados_view();
$Page =& $z_estados_view;

// Page init
$z_estados_view->Page_Init();

// Page main
$z_estados_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_estados->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_estados_view = new ew_Page("z_estados_view");

// page properties
z_estados_view.PageID = "view"; // page ID
z_estados_view.FormID = "fz_estadosview"; // form ID
var EW_PAGE_ID = z_estados_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_estados_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_estados_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_estados_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_estados->TableCaption() ?>
&nbsp;&nbsp;<?php $z_estados_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_estados->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $z_estados_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $z_estados_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $z_estados_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $z_estados_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $z_estados_view->ShowPageHeader(); ?>
<?php
$z_estados_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_estados->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $z_estados->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_estados->nombre->FldCaption() ?></td>
		<td<?php echo $z_estados->nombre->CellAttributes() ?>>
<div<?php echo $z_estados->nombre->ViewAttributes() ?>><?php echo $z_estados->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_estados->lf_estado_pais->Visible) { // lf_estado_pais ?>
	<tr id="r_lf_estado_pais"<?php echo $z_estados->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_estados->lf_estado_pais->FldCaption() ?></td>
		<td<?php echo $z_estados->lf_estado_pais->CellAttributes() ?>>
<div<?php echo $z_estados->lf_estado_pais->ViewAttributes() ?>><?php echo $z_estados->lf_estado_pais->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_estados->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_estados->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_estados->visibilidad->FldCaption() ?></td>
		<td<?php echo $z_estados->visibilidad->CellAttributes() ?>>
<div<?php echo $z_estados->visibilidad->ViewAttributes() ?>><?php echo $z_estados->visibilidad->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_estados->id2_estado->Visible) { // id2_estado ?>
	<tr id="r_id2_estado"<?php echo $z_estados->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_estados->id2_estado->FldCaption() ?></td>
		<td<?php echo $z_estados->id2_estado->CellAttributes() ?>>
<div<?php echo $z_estados->id2_estado->ViewAttributes() ?>><?php echo $z_estados->id2_estado->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$z_estados_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_estados->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_estados_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_estados_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = '_estados';

	// Page object name
	var $PageObjName = 'z_estados_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_estados;
		if ($z_estados->UseTokenInUrl) $PageUrl .= "t=" . $z_estados->TableVar . "&"; // Add page token
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
		global $objForm, $z_estados;
		if ($z_estados->UseTokenInUrl) {
			if ($objForm)
				return ($z_estados->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_estados->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_estados_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_estados)
		if (!isset($GLOBALS["z_estados"])) {
			$GLOBALS["z_estados"] = new cz_estados();
			$GLOBALS["Table"] =& $GLOBALS["z_estados"];
		}
		$KeyUrl = "";
		if (@$_GET["id2_estado"] <> "") {
			$this->RecKey["id2_estado"] = $_GET["id2_estado"];
			$KeyUrl .= "&id2_estado=" . urlencode($this->RecKey["id2_estado"]);
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
			define("EW_TABLE_NAME", '_estados', TRUE);

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
		global $z_estados;

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
		global $Language, $z_estados;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id2_estado"] <> "") {
				$z_estados->id2_estado->setQueryStringValue($_GET["id2_estado"]);
				$this->RecKey["id2_estado"] = $z_estados->id2_estado->QueryStringValue;
			} else {
				$sReturnUrl = "z_estadoslist.php"; // Return to list
			}

			// Get action
			$z_estados->CurrentAction = "I"; // Display form
			switch ($z_estados->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "z_estadoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "z_estadoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$z_estados->RowType = EW_ROWTYPE_VIEW;
		$z_estados->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_estados;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_estados->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_estados->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_estados->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_estados->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_estados->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_estados->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_estados;
		$sFilter = $z_estados->KeyFilter();

		// Call Row Selecting event
		$z_estados->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_estados->CurrentFilter = $sFilter;
		$sSql = $z_estados->SQL();
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
		global $conn, $z_estados;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_estados->Row_Selected($row);
		$z_estados->nombre->setDbValue($rs->fields('nombre'));
		$z_estados->lf_estado_pais->setDbValue($rs->fields('lf_estado_pais'));
		$z_estados->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_estados->id2_estado->setDbValue($rs->fields('id2_estado'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_estados;

		// Initialize URLs
		$this->AddUrl = $z_estados->AddUrl();
		$this->EditUrl = $z_estados->EditUrl();
		$this->CopyUrl = $z_estados->CopyUrl();
		$this->DeleteUrl = $z_estados->DeleteUrl();
		$this->ListUrl = $z_estados->ListUrl();

		// Call Row_Rendering event
		$z_estados->Row_Rendering();

		// Common render codes for all row types
		// nombre
		// lf_estado_pais
		// visibilidad
		// id2_estado

		if ($z_estados->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$z_estados->nombre->ViewValue = $z_estados->nombre->CurrentValue;
			$z_estados->nombre->ViewCustomAttributes = "";

			// lf_estado_pais
			if (strval($z_estados->lf_estado_pais->CurrentValue) <> "") {
				$sFilterWrk = "`lp_pais_id` = '" . ew_AdjustSql($z_estados->lf_estado_pais->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nombre` FROM `_paises`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_estados->lf_estado_pais->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_estados->lf_estado_pais->ViewValue = $z_estados->lf_estado_pais->CurrentValue;
				}
			} else {
				$z_estados->lf_estado_pais->ViewValue = NULL;
			}
			$z_estados->lf_estado_pais->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_estados->visibilidad->CurrentValue) <> "") {
				switch ($z_estados->visibilidad->CurrentValue) {
					case "1":
						$z_estados->visibilidad->ViewValue = $z_estados->visibilidad->FldTagCaption(1) <> "" ? $z_estados->visibilidad->FldTagCaption(1) : $z_estados->visibilidad->CurrentValue;
						break;
					case "0":
						$z_estados->visibilidad->ViewValue = $z_estados->visibilidad->FldTagCaption(2) <> "" ? $z_estados->visibilidad->FldTagCaption(2) : $z_estados->visibilidad->CurrentValue;
						break;
					default:
						$z_estados->visibilidad->ViewValue = $z_estados->visibilidad->CurrentValue;
				}
			} else {
				$z_estados->visibilidad->ViewValue = NULL;
			}
			$z_estados->visibilidad->ViewCustomAttributes = "";

			// id2_estado
			$z_estados->id2_estado->ViewValue = $z_estados->id2_estado->CurrentValue;
			$z_estados->id2_estado->ViewCustomAttributes = "";

			// nombre
			$z_estados->nombre->LinkCustomAttributes = "";
			$z_estados->nombre->HrefValue = "";
			$z_estados->nombre->TooltipValue = "";

			// lf_estado_pais
			$z_estados->lf_estado_pais->LinkCustomAttributes = "";
			$z_estados->lf_estado_pais->HrefValue = "";
			$z_estados->lf_estado_pais->TooltipValue = "";

			// visibilidad
			$z_estados->visibilidad->LinkCustomAttributes = "";
			$z_estados->visibilidad->HrefValue = "";
			$z_estados->visibilidad->TooltipValue = "";

			// id2_estado
			$z_estados->id2_estado->LinkCustomAttributes = "";
			$z_estados->id2_estado->HrefValue = "";
			$z_estados->id2_estado->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_estados->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_estados->Row_Rendered();
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
