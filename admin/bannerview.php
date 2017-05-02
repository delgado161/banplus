<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "bannerinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$banner_view = new cbanner_view();
$Page =& $banner_view;

// Page init
$banner_view->Page_Init();

// Page main
$banner_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($banner->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var banner_view = new ew_Page("banner_view");

// page properties
banner_view.PageID = "view"; // page ID
banner_view.FormID = "fbannerview"; // form ID
var EW_PAGE_ID = banner_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
banner_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
banner_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banner_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banner->TableCaption() ?>
&nbsp;&nbsp;<?php $banner_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($banner->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $banner_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $banner_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $banner_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $banner_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('banner_seccion')) { ?>
<a href="banner_seccionlist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=banner&id_banner=<?php echo urlencode(strval($banner->id_banner->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("banner_seccion", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $banner_view->ShowPageHeader(); ?>
<?php
$banner_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($banner->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $banner->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner->nombre->FldCaption() ?></td>
		<td<?php echo $banner->nombre->CellAttributes() ?>>
<div<?php echo $banner->nombre->ViewAttributes() ?>><?php echo $banner->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banner->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $banner->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner->imagen->FldCaption() ?></td>
		<td<?php echo $banner->imagen->CellAttributes() ?>>
<?php if ($banner->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($banner->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $banner->imagen->UploadPath) . $banner->imagen->Upload->DbValue ?>" border=0<?php echo $banner->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($banner->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($banner->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $banner->imagen->UploadPath) . $banner->imagen->Upload->DbValue ?>" border=0<?php echo $banner->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($banner->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($banner->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $banner->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner->estatus->FldCaption() ?></td>
		<td<?php echo $banner->estatus->CellAttributes() ?>>
<div<?php echo $banner->estatus->ViewAttributes() ?>><?php echo $banner->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$banner_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($banner->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$banner_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanner_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'banner';

	// Page object name
	var $PageObjName = 'banner_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banner;
		if ($banner->UseTokenInUrl) $PageUrl .= "t=" . $banner->TableVar . "&"; // Add page token
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
		global $objForm, $banner;
		if ($banner->UseTokenInUrl) {
			if ($objForm)
				return ($banner->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banner->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanner_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (banner)
		if (!isset($GLOBALS["banner"])) {
			$GLOBALS["banner"] = new cbanner();
			$GLOBALS["Table"] =& $GLOBALS["banner"];
		}
		$KeyUrl = "";
		if (@$_GET["id_banner"] <> "") {
			$this->RecKey["id_banner"] = $_GET["id_banner"];
			$KeyUrl .= "&id_banner=" . urlencode($this->RecKey["id_banner"]);
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
			define("EW_TABLE_NAME", 'banner', TRUE);

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
		global $banner;

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
			$this->Page_Terminate("bannerlist.php");
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
		global $Language, $banner;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_banner"] <> "") {
				$banner->id_banner->setQueryStringValue($_GET["id_banner"]);
				$this->RecKey["id_banner"] = $banner->id_banner->QueryStringValue;
			} else {
				$sReturnUrl = "bannerlist.php"; // Return to list
			}

			// Get action
			$banner->CurrentAction = "I"; // Display form
			switch ($banner->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "bannerlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "bannerlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$banner->RowType = EW_ROWTYPE_VIEW;
		$banner->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $banner;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$banner->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$banner->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $banner->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$banner->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$banner->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$banner->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banner;
		$sFilter = $banner->KeyFilter();

		// Call Row Selecting event
		$banner->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banner->CurrentFilter = $sFilter;
		$sSql = $banner->SQL();
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
		global $conn, $banner;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$banner->Row_Selected($row);
		$banner->id_banner->setDbValue($rs->fields('id_banner'));
		$banner->nombre->setDbValue($rs->fields('nombre'));
		$banner->imagen->Upload->DbValue = $rs->fields('imagen');
		$banner->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banner;

		// Initialize URLs
		$this->AddUrl = $banner->AddUrl();
		$this->EditUrl = $banner->EditUrl();
		$this->CopyUrl = $banner->CopyUrl();
		$this->DeleteUrl = $banner->DeleteUrl();
		$this->ListUrl = $banner->ListUrl();

		// Call Row_Rendering event
		$banner->Row_Rendering();

		// Common render codes for all row types
		// id_banner
		// nombre
		// imagen
		// estatus

		if ($banner->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$banner->nombre->ViewValue = $banner->nombre->CurrentValue;
			$banner->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($banner->imagen->Upload->DbValue)) {
				$banner->imagen->ViewValue = $banner->imagen->Upload->DbValue;
				$banner->imagen->ImageWidth = 30;
				$banner->imagen->ImageHeight = 30;
				$banner->imagen->ImageAlt = $banner->imagen->FldAlt();
			} else {
				$banner->imagen->ViewValue = "";
			}
			$banner->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($banner->estatus->CurrentValue) <> "") {
				switch ($banner->estatus->CurrentValue) {
					case "1":
						$banner->estatus->ViewValue = $banner->estatus->FldTagCaption(1) <> "" ? $banner->estatus->FldTagCaption(1) : $banner->estatus->CurrentValue;
						break;
					case "0":
						$banner->estatus->ViewValue = $banner->estatus->FldTagCaption(2) <> "" ? $banner->estatus->FldTagCaption(2) : $banner->estatus->CurrentValue;
						break;
					default:
						$banner->estatus->ViewValue = $banner->estatus->CurrentValue;
				}
			} else {
				$banner->estatus->ViewValue = NULL;
			}
			$banner->estatus->ViewCustomAttributes = "";

			// nombre
			$banner->nombre->LinkCustomAttributes = "";
			$banner->nombre->HrefValue = "";
			$banner->nombre->TooltipValue = "";

			// imagen
			$banner->imagen->LinkCustomAttributes = "";
			$banner->imagen->HrefValue = "";
			$banner->imagen->TooltipValue = "";

			// estatus
			$banner->estatus->LinkCustomAttributes = "";
			$banner->estatus->HrefValue = "";
			$banner->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($banner->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banner->Row_Rendered();
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
