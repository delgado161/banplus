<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tipos_productosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tipos_productos_view = new ctipos_productos_view();
$Page =& $tipos_productos_view;

// Page init
$tipos_productos_view->Page_Init();

// Page main
$tipos_productos_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($tipos_productos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tipos_productos_view = new ew_Page("tipos_productos_view");

// page properties
tipos_productos_view.PageID = "view"; // page ID
tipos_productos_view.FormID = "ftipos_productosview"; // form ID
var EW_PAGE_ID = tipos_productos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tipos_productos_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tipos_productos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tipos_productos_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tipos_productos->TableCaption() ?>
&nbsp;&nbsp;<?php $tipos_productos_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($tipos_productos->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $tipos_productos_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $tipos_productos_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $tipos_productos_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $tipos_productos_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $tipos_productos_view->ShowPageHeader(); ?>
<?php
$tipos_productos_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tipos_productos->id_producto->Visible) { // id_producto ?>
	<tr id="r_id_producto"<?php echo $tipos_productos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tipos_productos->id_producto->FldCaption() ?></td>
		<td<?php echo $tipos_productos->id_producto->CellAttributes() ?>>
<div<?php echo $tipos_productos->id_producto->ViewAttributes() ?>><?php echo $tipos_productos->id_producto->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tipos_productos->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $tipos_productos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tipos_productos->tipo->FldCaption() ?></td>
		<td<?php echo $tipos_productos->tipo->CellAttributes() ?>>
<div<?php echo $tipos_productos->tipo->ViewAttributes() ?>><?php echo $tipos_productos->tipo->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$tipos_productos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($tipos_productos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tipos_productos_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctipos_productos_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tipos_productos';

	// Page object name
	var $PageObjName = 'tipos_productos_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tipos_productos;
		if ($tipos_productos->UseTokenInUrl) $PageUrl .= "t=" . $tipos_productos->TableVar . "&"; // Add page token
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
		global $objForm, $tipos_productos;
		if ($tipos_productos->UseTokenInUrl) {
			if ($objForm)
				return ($tipos_productos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tipos_productos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctipos_productos_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tipos_productos)
		if (!isset($GLOBALS["tipos_productos"])) {
			$GLOBALS["tipos_productos"] = new ctipos_productos();
			$GLOBALS["Table"] =& $GLOBALS["tipos_productos"];
		}
		$KeyUrl = "";
		if (@$_GET["id_producto"] <> "") {
			$this->RecKey["id_producto"] = $_GET["id_producto"];
			$KeyUrl .= "&id_producto=" . urlencode($this->RecKey["id_producto"]);
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
			define("EW_TABLE_NAME", 'tipos_productos', TRUE);

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
		global $tipos_productos;

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
		global $Language, $tipos_productos;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_producto"] <> "") {
				$tipos_productos->id_producto->setQueryStringValue($_GET["id_producto"]);
				$this->RecKey["id_producto"] = $tipos_productos->id_producto->QueryStringValue;
			} else {
				$sReturnUrl = "tipos_productoslist.php"; // Return to list
			}

			// Get action
			$tipos_productos->CurrentAction = "I"; // Display form
			switch ($tipos_productos->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tipos_productoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tipos_productoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tipos_productos->RowType = EW_ROWTYPE_VIEW;
		$tipos_productos->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tipos_productos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$tipos_productos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$tipos_productos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $tipos_productos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$tipos_productos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$tipos_productos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$tipos_productos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tipos_productos;
		$sFilter = $tipos_productos->KeyFilter();

		// Call Row Selecting event
		$tipos_productos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tipos_productos->CurrentFilter = $sFilter;
		$sSql = $tipos_productos->SQL();
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
		global $conn, $tipos_productos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tipos_productos->Row_Selected($row);
		$tipos_productos->id_producto->setDbValue($rs->fields('id_producto'));
		$tipos_productos->tipo->setDbValue($rs->fields('tipo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tipos_productos;

		// Initialize URLs
		$this->AddUrl = $tipos_productos->AddUrl();
		$this->EditUrl = $tipos_productos->EditUrl();
		$this->CopyUrl = $tipos_productos->CopyUrl();
		$this->DeleteUrl = $tipos_productos->DeleteUrl();
		$this->ListUrl = $tipos_productos->ListUrl();

		// Call Row_Rendering event
		$tipos_productos->Row_Rendering();

		// Common render codes for all row types
		// id_producto
		// tipo

		if ($tipos_productos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_producto
			$tipos_productos->id_producto->ViewValue = $tipos_productos->id_producto->CurrentValue;
			$tipos_productos->id_producto->ViewCustomAttributes = "";

			// tipo
			$tipos_productos->tipo->ViewValue = $tipos_productos->tipo->CurrentValue;
			$tipos_productos->tipo->ViewCustomAttributes = "";

			// id_producto
			$tipos_productos->id_producto->LinkCustomAttributes = "";
			$tipos_productos->id_producto->HrefValue = "";
			$tipos_productos->id_producto->TooltipValue = "";

			// tipo
			$tipos_productos->tipo->LinkCustomAttributes = "";
			$tipos_productos->tipo->HrefValue = "";
			$tipos_productos->tipo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tipos_productos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tipos_productos->Row_Rendered();
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
