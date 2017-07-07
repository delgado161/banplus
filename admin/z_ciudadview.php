<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_ciudadinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_ciudad_view = new cz_ciudad_view();
$Page =& $z_ciudad_view;

// Page init
$z_ciudad_view->Page_Init();

// Page main
$z_ciudad_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_ciudad->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_ciudad_view = new ew_Page("z_ciudad_view");

// page properties
z_ciudad_view.PageID = "view"; // page ID
z_ciudad_view.FormID = "fz_ciudadview"; // form ID
var EW_PAGE_ID = z_ciudad_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_ciudad_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_ciudad_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_ciudad_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_ciudad->TableCaption() ?>
&nbsp;&nbsp;<?php $z_ciudad_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_ciudad->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $z_ciudad_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $z_ciudad_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $z_ciudad_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $z_ciudad_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $z_ciudad_view->ShowPageHeader(); ?>
<?php
$z_ciudad_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_ciudad->id_ciudad->Visible) { // id_ciudad ?>
	<tr id="r_id_ciudad"<?php echo $z_ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_ciudad->id_ciudad->FldCaption() ?></td>
		<td<?php echo $z_ciudad->id_ciudad->CellAttributes() ?>>
<div<?php echo $z_ciudad->id_ciudad->ViewAttributes() ?>><?php echo $z_ciudad->id_ciudad->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_ciudad->lf_estado->Visible) { // lf_estado ?>
	<tr id="r_lf_estado"<?php echo $z_ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_ciudad->lf_estado->FldCaption() ?></td>
		<td<?php echo $z_ciudad->lf_estado->CellAttributes() ?>>
<div<?php echo $z_ciudad->lf_estado->ViewAttributes() ?>><?php echo $z_ciudad->lf_estado->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_ciudad->id_banplus->Visible) { // id_banplus ?>
	<tr id="r_id_banplus"<?php echo $z_ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_ciudad->id_banplus->FldCaption() ?></td>
		<td<?php echo $z_ciudad->id_banplus->CellAttributes() ?>>
<div<?php echo $z_ciudad->id_banplus->ViewAttributes() ?>><?php echo $z_ciudad->id_banplus->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_ciudad->ciudad->Visible) { // ciudad ?>
	<tr id="r_ciudad"<?php echo $z_ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_ciudad->ciudad->FldCaption() ?></td>
		<td<?php echo $z_ciudad->ciudad->CellAttributes() ?>>
<div<?php echo $z_ciudad->ciudad->ViewAttributes() ?>><?php echo $z_ciudad->ciudad->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_ciudad->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_ciudad->visibilidad->FldCaption() ?></td>
		<td<?php echo $z_ciudad->visibilidad->CellAttributes() ?>>
<div<?php echo $z_ciudad->visibilidad->ViewAttributes() ?>><?php echo $z_ciudad->visibilidad->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$z_ciudad_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_ciudad->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_ciudad_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_ciudad_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = '_ciudad';

	// Page object name
	var $PageObjName = 'z_ciudad_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_ciudad;
		if ($z_ciudad->UseTokenInUrl) $PageUrl .= "t=" . $z_ciudad->TableVar . "&"; // Add page token
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
		global $objForm, $z_ciudad;
		if ($z_ciudad->UseTokenInUrl) {
			if ($objForm)
				return ($z_ciudad->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_ciudad->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_ciudad_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_ciudad)
		if (!isset($GLOBALS["z_ciudad"])) {
			$GLOBALS["z_ciudad"] = new cz_ciudad();
			$GLOBALS["Table"] =& $GLOBALS["z_ciudad"];
		}
		$KeyUrl = "";
		if (@$_GET["id_ciudad"] <> "") {
			$this->RecKey["id_ciudad"] = $_GET["id_ciudad"];
			$KeyUrl .= "&id_ciudad=" . urlencode($this->RecKey["id_ciudad"]);
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
			define("EW_TABLE_NAME", '_ciudad', TRUE);

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
		global $z_ciudad;

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
		global $Language, $z_ciudad;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_ciudad"] <> "") {
				$z_ciudad->id_ciudad->setQueryStringValue($_GET["id_ciudad"]);
				$this->RecKey["id_ciudad"] = $z_ciudad->id_ciudad->QueryStringValue;
			} else {
				$sReturnUrl = "z_ciudadlist.php"; // Return to list
			}

			// Get action
			$z_ciudad->CurrentAction = "I"; // Display form
			switch ($z_ciudad->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "z_ciudadlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "z_ciudadlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$z_ciudad->RowType = EW_ROWTYPE_VIEW;
		$z_ciudad->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_ciudad;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_ciudad->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_ciudad->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_ciudad->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_ciudad->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_ciudad->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_ciudad->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_ciudad;
		$sFilter = $z_ciudad->KeyFilter();

		// Call Row Selecting event
		$z_ciudad->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_ciudad->CurrentFilter = $sFilter;
		$sSql = $z_ciudad->SQL();
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
		global $conn, $z_ciudad;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_ciudad->Row_Selected($row);
		$z_ciudad->id_ciudad->setDbValue($rs->fields('id_ciudad'));
		$z_ciudad->lf_estado->setDbValue($rs->fields('lf_estado'));
		$z_ciudad->id_banplus->setDbValue($rs->fields('id_banplus'));
		$z_ciudad->ciudad->setDbValue($rs->fields('ciudad'));
		$z_ciudad->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_ciudad;

		// Initialize URLs
		$this->AddUrl = $z_ciudad->AddUrl();
		$this->EditUrl = $z_ciudad->EditUrl();
		$this->CopyUrl = $z_ciudad->CopyUrl();
		$this->DeleteUrl = $z_ciudad->DeleteUrl();
		$this->ListUrl = $z_ciudad->ListUrl();

		// Call Row_Rendering event
		$z_ciudad->Row_Rendering();

		// Common render codes for all row types
		// id_ciudad
		// lf_estado
		// id_banplus
		// ciudad
		// visibilidad

		if ($z_ciudad->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_ciudad
			$z_ciudad->id_ciudad->ViewValue = $z_ciudad->id_ciudad->CurrentValue;
			$z_ciudad->id_ciudad->ViewCustomAttributes = "";

			// lf_estado
			if (strval($z_ciudad->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_ciudad->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_ciudad->lf_estado->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_ciudad->lf_estado->ViewValue = $z_ciudad->lf_estado->CurrentValue;
				}
			} else {
				$z_ciudad->lf_estado->ViewValue = NULL;
			}
			$z_ciudad->lf_estado->ViewCustomAttributes = "";

			// id_banplus
			$z_ciudad->id_banplus->ViewValue = $z_ciudad->id_banplus->CurrentValue;
			$z_ciudad->id_banplus->ViewCustomAttributes = "";

			// ciudad
			$z_ciudad->ciudad->ViewValue = $z_ciudad->ciudad->CurrentValue;
			$z_ciudad->ciudad->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_ciudad->visibilidad->CurrentValue) <> "") {
				switch ($z_ciudad->visibilidad->CurrentValue) {
					case "1":
						$z_ciudad->visibilidad->ViewValue = $z_ciudad->visibilidad->FldTagCaption(1) <> "" ? $z_ciudad->visibilidad->FldTagCaption(1) : $z_ciudad->visibilidad->CurrentValue;
						break;
					case "0":
						$z_ciudad->visibilidad->ViewValue = $z_ciudad->visibilidad->FldTagCaption(2) <> "" ? $z_ciudad->visibilidad->FldTagCaption(2) : $z_ciudad->visibilidad->CurrentValue;
						break;
					default:
						$z_ciudad->visibilidad->ViewValue = $z_ciudad->visibilidad->CurrentValue;
				}
			} else {
				$z_ciudad->visibilidad->ViewValue = NULL;
			}
			$z_ciudad->visibilidad->ViewCustomAttributes = "";

			// id_ciudad
			$z_ciudad->id_ciudad->LinkCustomAttributes = "";
			$z_ciudad->id_ciudad->HrefValue = "";
			$z_ciudad->id_ciudad->TooltipValue = "";

			// lf_estado
			$z_ciudad->lf_estado->LinkCustomAttributes = "";
			$z_ciudad->lf_estado->HrefValue = "";
			$z_ciudad->lf_estado->TooltipValue = "";

			// id_banplus
			$z_ciudad->id_banplus->LinkCustomAttributes = "";
			$z_ciudad->id_banplus->HrefValue = "";
			$z_ciudad->id_banplus->TooltipValue = "";

			// ciudad
			$z_ciudad->ciudad->LinkCustomAttributes = "";
			$z_ciudad->ciudad->HrefValue = "";
			$z_ciudad->ciudad->TooltipValue = "";

			// visibilidad
			$z_ciudad->visibilidad->LinkCustomAttributes = "";
			$z_ciudad->visibilidad->HrefValue = "";
			$z_ciudad->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_ciudad->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_ciudad->Row_Rendered();
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
