<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_codigo_postalinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_codigo_postal_view = new cz_codigo_postal_view();
$Page =& $z_codigo_postal_view;

// Page init
$z_codigo_postal_view->Page_Init();

// Page main
$z_codigo_postal_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_codigo_postal->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_codigo_postal_view = new ew_Page("z_codigo_postal_view");

// page properties
z_codigo_postal_view.PageID = "view"; // page ID
z_codigo_postal_view.FormID = "fz_codigo_postalview"; // form ID
var EW_PAGE_ID = z_codigo_postal_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_codigo_postal_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_codigo_postal_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_codigo_postal_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_codigo_postal->TableCaption() ?>
&nbsp;&nbsp;<?php $z_codigo_postal_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_codigo_postal->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $z_codigo_postal_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $z_codigo_postal_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $z_codigo_postal_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $z_codigo_postal_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $z_codigo_postal_view->ShowPageHeader(); ?>
<?php
$z_codigo_postal_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_codigo_postal->id_codigo_postal->Visible) { // id_codigo_postal ?>
	<tr id="r_id_codigo_postal"<?php echo $z_codigo_postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_codigo_postal->id_codigo_postal->FldCaption() ?></td>
		<td<?php echo $z_codigo_postal->id_codigo_postal->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->id_codigo_postal->ViewAttributes() ?>><?php echo $z_codigo_postal->id_codigo_postal->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_codigo_postal->codigo->Visible) { // codigo ?>
	<tr id="r_codigo"<?php echo $z_codigo_postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_codigo_postal->codigo->FldCaption() ?></td>
		<td<?php echo $z_codigo_postal->codigo->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->codigo->ViewAttributes() ?>><?php echo $z_codigo_postal->codigo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_codigo_postal->Descripcion->Visible) { // Descripcion ?>
	<tr id="r_Descripcion"<?php echo $z_codigo_postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_codigo_postal->Descripcion->FldCaption() ?></td>
		<td<?php echo $z_codigo_postal->Descripcion->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->Descripcion->ViewAttributes() ?>><?php echo $z_codigo_postal->Descripcion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_codigo_postal->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_codigo_postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_codigo_postal->visibilidad->FldCaption() ?></td>
		<td<?php echo $z_codigo_postal->visibilidad->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->visibilidad->ViewAttributes() ?>><?php echo $z_codigo_postal->visibilidad->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$z_codigo_postal_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_codigo_postal->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_codigo_postal_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_codigo_postal_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = '_codigo_postal';

	// Page object name
	var $PageObjName = 'z_codigo_postal_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_codigo_postal;
		if ($z_codigo_postal->UseTokenInUrl) $PageUrl .= "t=" . $z_codigo_postal->TableVar . "&"; // Add page token
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
		global $objForm, $z_codigo_postal;
		if ($z_codigo_postal->UseTokenInUrl) {
			if ($objForm)
				return ($z_codigo_postal->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_codigo_postal->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_codigo_postal_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_codigo_postal)
		if (!isset($GLOBALS["z_codigo_postal"])) {
			$GLOBALS["z_codigo_postal"] = new cz_codigo_postal();
			$GLOBALS["Table"] =& $GLOBALS["z_codigo_postal"];
		}
		$KeyUrl = "";
		if (@$_GET["id_codigo_postal"] <> "") {
			$this->RecKey["id_codigo_postal"] = $_GET["id_codigo_postal"];
			$KeyUrl .= "&id_codigo_postal=" . urlencode($this->RecKey["id_codigo_postal"]);
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
			define("EW_TABLE_NAME", '_codigo_postal', TRUE);

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
		global $z_codigo_postal;

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
		global $Language, $z_codigo_postal;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_codigo_postal"] <> "") {
				$z_codigo_postal->id_codigo_postal->setQueryStringValue($_GET["id_codigo_postal"]);
				$this->RecKey["id_codigo_postal"] = $z_codigo_postal->id_codigo_postal->QueryStringValue;
			} else {
				$sReturnUrl = "z_codigo_postallist.php"; // Return to list
			}

			// Get action
			$z_codigo_postal->CurrentAction = "I"; // Display form
			switch ($z_codigo_postal->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "z_codigo_postallist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "z_codigo_postallist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$z_codigo_postal->RowType = EW_ROWTYPE_VIEW;
		$z_codigo_postal->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_codigo_postal;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_codigo_postal->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_codigo_postal->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_codigo_postal->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_codigo_postal->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_codigo_postal->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_codigo_postal->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_codigo_postal;
		$sFilter = $z_codigo_postal->KeyFilter();

		// Call Row Selecting event
		$z_codigo_postal->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_codigo_postal->CurrentFilter = $sFilter;
		$sSql = $z_codigo_postal->SQL();
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
		global $conn, $z_codigo_postal;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_codigo_postal->Row_Selected($row);
		$z_codigo_postal->id_codigo_postal->setDbValue($rs->fields('id_codigo_postal'));
		$z_codigo_postal->codigo->setDbValue($rs->fields('codigo'));
		$z_codigo_postal->Descripcion->setDbValue($rs->fields('Descripcion'));
		$z_codigo_postal->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_codigo_postal;

		// Initialize URLs
		$this->AddUrl = $z_codigo_postal->AddUrl();
		$this->EditUrl = $z_codigo_postal->EditUrl();
		$this->CopyUrl = $z_codigo_postal->CopyUrl();
		$this->DeleteUrl = $z_codigo_postal->DeleteUrl();
		$this->ListUrl = $z_codigo_postal->ListUrl();

		// Call Row_Rendering event
		$z_codigo_postal->Row_Rendering();

		// Common render codes for all row types
		// id_codigo_postal
		// codigo
		// Descripcion
		// visibilidad

		if ($z_codigo_postal->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_codigo_postal
			$z_codigo_postal->id_codigo_postal->ViewValue = $z_codigo_postal->id_codigo_postal->CurrentValue;
			$z_codigo_postal->id_codigo_postal->ViewCustomAttributes = "";

			// codigo
			$z_codigo_postal->codigo->ViewValue = $z_codigo_postal->codigo->CurrentValue;
			$z_codigo_postal->codigo->ViewCustomAttributes = "";

			// Descripcion
			$z_codigo_postal->Descripcion->ViewValue = $z_codigo_postal->Descripcion->CurrentValue;
			$z_codigo_postal->Descripcion->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_codigo_postal->visibilidad->CurrentValue) <> "") {
				switch ($z_codigo_postal->visibilidad->CurrentValue) {
					case "1":
						$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->FldTagCaption(1) <> "" ? $z_codigo_postal->visibilidad->FldTagCaption(1) : $z_codigo_postal->visibilidad->CurrentValue;
						break;
					case "0":
						$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->FldTagCaption(2) <> "" ? $z_codigo_postal->visibilidad->FldTagCaption(2) : $z_codigo_postal->visibilidad->CurrentValue;
						break;
					default:
						$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->CurrentValue;
				}
			} else {
				$z_codigo_postal->visibilidad->ViewValue = NULL;
			}
			$z_codigo_postal->visibilidad->ViewCustomAttributes = "";

			// id_codigo_postal
			$z_codigo_postal->id_codigo_postal->LinkCustomAttributes = "";
			$z_codigo_postal->id_codigo_postal->HrefValue = "";
			$z_codigo_postal->id_codigo_postal->TooltipValue = "";

			// codigo
			$z_codigo_postal->codigo->LinkCustomAttributes = "";
			$z_codigo_postal->codigo->HrefValue = "";
			$z_codigo_postal->codigo->TooltipValue = "";

			// Descripcion
			$z_codigo_postal->Descripcion->LinkCustomAttributes = "";
			$z_codigo_postal->Descripcion->HrefValue = "";
			$z_codigo_postal->Descripcion->TooltipValue = "";

			// visibilidad
			$z_codigo_postal->visibilidad->LinkCustomAttributes = "";
			$z_codigo_postal->visibilidad->HrefValue = "";
			$z_codigo_postal->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_codigo_postal->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_codigo_postal->Row_Rendered();
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
