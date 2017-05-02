<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "promocionesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$promociones_view = new cpromociones_view();
$Page =& $promociones_view;

// Page init
$promociones_view->Page_Init();

// Page main
$promociones_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($promociones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var promociones_view = new ew_Page("promociones_view");

// page properties
promociones_view.PageID = "view"; // page ID
promociones_view.FormID = "fpromocionesview"; // form ID
var EW_PAGE_ID = promociones_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
promociones_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
promociones_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
promociones_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $promociones->TableCaption() ?>
&nbsp;&nbsp;<?php $promociones_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($promociones->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $promociones_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $promociones_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $promociones_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $promociones_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $promociones_view->ShowPageHeader(); ?>
<?php
$promociones_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($promociones->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->titulo->FldCaption() ?></td>
		<td<?php echo $promociones->titulo->CellAttributes() ?>>
<div<?php echo $promociones->titulo->ViewAttributes() ?>><?php echo $promociones->titulo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($promociones->contenido->Visible) { // contenido ?>
	<tr id="r_contenido"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->contenido->FldCaption() ?></td>
		<td<?php echo $promociones->contenido->CellAttributes() ?>>
<div<?php echo $promociones->contenido->ViewAttributes() ?>><?php echo $promociones->contenido->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($promociones->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->imagen->FldCaption() ?></td>
		<td<?php echo $promociones->imagen->CellAttributes() ?>>
<?php if ($promociones->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($promociones->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $promociones->imagen->UploadPath) . $promociones->imagen->Upload->DbValue ?>" border=0<?php echo $promociones->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($promociones->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($promociones->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $promociones->imagen->UploadPath) . $promociones->imagen->Upload->DbValue ?>" border=0<?php echo $promociones->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($promociones->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($promociones->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->estatus->FldCaption() ?></td>
		<td<?php echo $promociones->estatus->CellAttributes() ?>>
<div<?php echo $promociones->estatus->ViewAttributes() ?>><?php echo $promociones->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$promociones_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($promociones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$promociones_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cpromociones_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'promociones';

	// Page object name
	var $PageObjName = 'promociones_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $promociones;
		if ($promociones->UseTokenInUrl) $PageUrl .= "t=" . $promociones->TableVar . "&"; // Add page token
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
		global $objForm, $promociones;
		if ($promociones->UseTokenInUrl) {
			if ($objForm)
				return ($promociones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($promociones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpromociones_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (promociones)
		if (!isset($GLOBALS["promociones"])) {
			$GLOBALS["promociones"] = new cpromociones();
			$GLOBALS["Table"] =& $GLOBALS["promociones"];
		}
		$KeyUrl = "";
		if (@$_GET["id_promociones"] <> "") {
			$this->RecKey["id_promociones"] = $_GET["id_promociones"];
			$KeyUrl .= "&id_promociones=" . urlencode($this->RecKey["id_promociones"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'promociones', TRUE);

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
		global $promociones;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("promocioneslist.php");
		}

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
		global $Language, $promociones;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_promociones"] <> "") {
				$promociones->id_promociones->setQueryStringValue($_GET["id_promociones"]);
				$this->RecKey["id_promociones"] = $promociones->id_promociones->QueryStringValue;
			} else {
				$sReturnUrl = "promocioneslist.php"; // Return to list
			}

			// Get action
			$promociones->CurrentAction = "I"; // Display form
			switch ($promociones->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "promocioneslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "promocioneslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$promociones->RowType = EW_ROWTYPE_VIEW;
		$promociones->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $promociones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$promociones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$promociones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $promociones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$promociones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$promociones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$promociones->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $promociones;
		$sFilter = $promociones->KeyFilter();

		// Call Row Selecting event
		$promociones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$promociones->CurrentFilter = $sFilter;
		$sSql = $promociones->SQL();
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
		global $conn, $promociones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$promociones->Row_Selected($row);
		$promociones->id_promociones->setDbValue($rs->fields('id_promociones'));
		$promociones->titulo->setDbValue($rs->fields('titulo'));
		$promociones->contenido->setDbValue($rs->fields('contenido'));
		$promociones->imagen->Upload->DbValue = $rs->fields('imagen');
		$promociones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $promociones;

		// Initialize URLs
		$this->AddUrl = $promociones->AddUrl();
		$this->EditUrl = $promociones->EditUrl();
		$this->CopyUrl = $promociones->CopyUrl();
		$this->DeleteUrl = $promociones->DeleteUrl();
		$this->ListUrl = $promociones->ListUrl();

		// Call Row_Rendering event
		$promociones->Row_Rendering();

		// Common render codes for all row types
		// id_promociones
		// titulo
		// contenido
		// imagen
		// estatus

		if ($promociones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_promociones
			$promociones->id_promociones->ViewValue = $promociones->id_promociones->CurrentValue;
			$promociones->id_promociones->ViewCustomAttributes = "";

			// titulo
			$promociones->titulo->ViewValue = $promociones->titulo->CurrentValue;
			$promociones->titulo->ViewCustomAttributes = "";

			// contenido
			$promociones->contenido->ViewValue = $promociones->contenido->CurrentValue;
			$promociones->contenido->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($promociones->imagen->Upload->DbValue)) {
				$promociones->imagen->ViewValue = $promociones->imagen->Upload->DbValue;
				$promociones->imagen->ImageWidth = 150;
				$promociones->imagen->ImageHeight = 0;
				$promociones->imagen->ImageAlt = $promociones->imagen->FldAlt();
			} else {
				$promociones->imagen->ViewValue = "";
			}
			$promociones->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($promociones->estatus->CurrentValue) <> "") {
				switch ($promociones->estatus->CurrentValue) {
					case "1":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(1) <> "" ? $promociones->estatus->FldTagCaption(1) : $promociones->estatus->CurrentValue;
						break;
					case "0":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(2) <> "" ? $promociones->estatus->FldTagCaption(2) : $promociones->estatus->CurrentValue;
						break;
					default:
						$promociones->estatus->ViewValue = $promociones->estatus->CurrentValue;
				}
			} else {
				$promociones->estatus->ViewValue = NULL;
			}
			$promociones->estatus->ViewCustomAttributes = "";

			// titulo
			$promociones->titulo->LinkCustomAttributes = "";
			$promociones->titulo->HrefValue = "";
			$promociones->titulo->TooltipValue = "";

			// contenido
			$promociones->contenido->LinkCustomAttributes = "";
			$promociones->contenido->HrefValue = "";
			$promociones->contenido->TooltipValue = "";

			// imagen
			$promociones->imagen->LinkCustomAttributes = "";
			$promociones->imagen->HrefValue = "";
			$promociones->imagen->TooltipValue = "";

			// estatus
			$promociones->estatus->LinkCustomAttributes = "";
			$promociones->estatus->HrefValue = "";
			$promociones->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($promociones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$promociones->Row_Rendered();
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
		$dompdf->render();
		ob_end_clean();
		ew_DeleteTmpImages();
		$dompdf->stream($gsExportFile . ".pdf", array("Attachment" => 1)); // 0 to open in browser, 1 to download

//		exit();
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
