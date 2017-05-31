<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_cod_telefonoinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_cod_telefono_view = new cz_cod_telefono_view();
$Page =& $z_cod_telefono_view;

// Page init
$z_cod_telefono_view->Page_Init();

// Page main
$z_cod_telefono_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_cod_telefono->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_cod_telefono_view = new ew_Page("z_cod_telefono_view");

// page properties
z_cod_telefono_view.PageID = "view"; // page ID
z_cod_telefono_view.FormID = "fz_cod_telefonoview"; // form ID
var EW_PAGE_ID = z_cod_telefono_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_cod_telefono_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_cod_telefono_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_cod_telefono_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_cod_telefono->TableCaption() ?>
&nbsp;&nbsp;<?php $z_cod_telefono_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_cod_telefono->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $z_cod_telefono_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $z_cod_telefono_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $z_cod_telefono_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $z_cod_telefono_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $z_cod_telefono_view->ShowPageHeader(); ?>
<?php
$z_cod_telefono_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_cod_telefono->id_cod_telefono->Visible) { // id_cod_telefono ?>
	<tr id="r_id_cod_telefono"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->id_cod_telefono->FldCaption() ?></td>
		<td<?php echo $z_cod_telefono->id_cod_telefono->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->id_cod_telefono->ViewAttributes() ?>><?php echo $z_cod_telefono->id_cod_telefono->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_cod_telefono->codigo->Visible) { // codigo ?>
	<tr id="r_codigo"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->codigo->FldCaption() ?></td>
		<td<?php echo $z_cod_telefono->codigo->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->codigo->ViewAttributes() ?>><?php echo $z_cod_telefono->codigo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_cod_telefono->cod_cel->Visible) { // cod_cel ?>
	<tr id="r_cod_cel"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->cod_cel->FldCaption() ?></td>
		<td<?php echo $z_cod_telefono->cod_cel->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->cod_cel->ViewAttributes() ?>><?php echo $z_cod_telefono->cod_cel->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_cod_telefono->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->visibilidad->FldCaption() ?></td>
		<td<?php echo $z_cod_telefono->visibilidad->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->visibilidad->ViewAttributes() ?>><?php echo $z_cod_telefono->visibilidad->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($z_cod_telefono->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->descripcion->FldCaption() ?></td>
		<td<?php echo $z_cod_telefono->descripcion->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->descripcion->ViewAttributes() ?>><?php echo $z_cod_telefono->descripcion->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$z_cod_telefono_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_cod_telefono->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_cod_telefono_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_cod_telefono_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = '_cod_telefono';

	// Page object name
	var $PageObjName = 'z_cod_telefono_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_cod_telefono;
		if ($z_cod_telefono->UseTokenInUrl) $PageUrl .= "t=" . $z_cod_telefono->TableVar . "&"; // Add page token
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
		global $objForm, $z_cod_telefono;
		if ($z_cod_telefono->UseTokenInUrl) {
			if ($objForm)
				return ($z_cod_telefono->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_cod_telefono->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_cod_telefono_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_cod_telefono)
		if (!isset($GLOBALS["z_cod_telefono"])) {
			$GLOBALS["z_cod_telefono"] = new cz_cod_telefono();
			$GLOBALS["Table"] =& $GLOBALS["z_cod_telefono"];
		}
		$KeyUrl = "";
		if (@$_GET["id_cod_telefono"] <> "") {
			$this->RecKey["id_cod_telefono"] = $_GET["id_cod_telefono"];
			$KeyUrl .= "&id_cod_telefono=" . urlencode($this->RecKey["id_cod_telefono"]);
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
			define("EW_TABLE_NAME", '_cod_telefono', TRUE);

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
		global $z_cod_telefono;

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
		global $Language, $z_cod_telefono;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_cod_telefono"] <> "") {
				$z_cod_telefono->id_cod_telefono->setQueryStringValue($_GET["id_cod_telefono"]);
				$this->RecKey["id_cod_telefono"] = $z_cod_telefono->id_cod_telefono->QueryStringValue;
			} else {
				$sReturnUrl = "z_cod_telefonolist.php"; // Return to list
			}

			// Get action
			$z_cod_telefono->CurrentAction = "I"; // Display form
			switch ($z_cod_telefono->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "z_cod_telefonolist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "z_cod_telefonolist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$z_cod_telefono->RowType = EW_ROWTYPE_VIEW;
		$z_cod_telefono->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_cod_telefono;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_cod_telefono->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_cod_telefono->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_cod_telefono->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_cod_telefono->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_cod_telefono->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_cod_telefono->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_cod_telefono;
		$sFilter = $z_cod_telefono->KeyFilter();

		// Call Row Selecting event
		$z_cod_telefono->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_cod_telefono->CurrentFilter = $sFilter;
		$sSql = $z_cod_telefono->SQL();
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
		global $conn, $z_cod_telefono;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_cod_telefono->Row_Selected($row);
		$z_cod_telefono->id_cod_telefono->setDbValue($rs->fields('id_cod_telefono'));
		$z_cod_telefono->codigo->setDbValue($rs->fields('codigo'));
		$z_cod_telefono->cod_cel->setDbValue($rs->fields('cod_cel'));
		$z_cod_telefono->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_cod_telefono->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_cod_telefono;

		// Initialize URLs
		$this->AddUrl = $z_cod_telefono->AddUrl();
		$this->EditUrl = $z_cod_telefono->EditUrl();
		$this->CopyUrl = $z_cod_telefono->CopyUrl();
		$this->DeleteUrl = $z_cod_telefono->DeleteUrl();
		$this->ListUrl = $z_cod_telefono->ListUrl();

		// Call Row_Rendering event
		$z_cod_telefono->Row_Rendering();

		// Common render codes for all row types
		// id_cod_telefono
		// codigo
		// cod_cel
		// visibilidad
		// descripcion

		if ($z_cod_telefono->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_cod_telefono
			$z_cod_telefono->id_cod_telefono->ViewValue = $z_cod_telefono->id_cod_telefono->CurrentValue;
			$z_cod_telefono->id_cod_telefono->ViewCustomAttributes = "";

			// codigo
			$z_cod_telefono->codigo->ViewValue = $z_cod_telefono->codigo->CurrentValue;
			$z_cod_telefono->codigo->ViewCustomAttributes = "";

			// cod_cel
			$z_cod_telefono->cod_cel->ViewValue = $z_cod_telefono->cod_cel->CurrentValue;
			$z_cod_telefono->cod_cel->ViewCustomAttributes = "";

			// visibilidad
			$z_cod_telefono->visibilidad->ViewValue = $z_cod_telefono->visibilidad->CurrentValue;
			$z_cod_telefono->visibilidad->ViewCustomAttributes = "";

			// descripcion
			$z_cod_telefono->descripcion->ViewValue = $z_cod_telefono->descripcion->CurrentValue;
			$z_cod_telefono->descripcion->ViewCustomAttributes = "";

			// id_cod_telefono
			$z_cod_telefono->id_cod_telefono->LinkCustomAttributes = "";
			$z_cod_telefono->id_cod_telefono->HrefValue = "";
			$z_cod_telefono->id_cod_telefono->TooltipValue = "";

			// codigo
			$z_cod_telefono->codigo->LinkCustomAttributes = "";
			$z_cod_telefono->codigo->HrefValue = "";
			$z_cod_telefono->codigo->TooltipValue = "";

			// cod_cel
			$z_cod_telefono->cod_cel->LinkCustomAttributes = "";
			$z_cod_telefono->cod_cel->HrefValue = "";
			$z_cod_telefono->cod_cel->TooltipValue = "";

			// visibilidad
			$z_cod_telefono->visibilidad->LinkCustomAttributes = "";
			$z_cod_telefono->visibilidad->HrefValue = "";
			$z_cod_telefono->visibilidad->TooltipValue = "";

			// descripcion
			$z_cod_telefono->descripcion->LinkCustomAttributes = "";
			$z_cod_telefono->descripcion->HrefValue = "";
			$z_cod_telefono->descripcion->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_cod_telefono->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_cod_telefono->Row_Rendered();
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
