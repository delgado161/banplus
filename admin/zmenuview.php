<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "zmenuinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$zmenu_view = new czmenu_view();
$Page =& $zmenu_view;

// Page init
$zmenu_view->Page_Init();

// Page main
$zmenu_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($zmenu->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var zmenu_view = new ew_Page("zmenu_view");

// page properties
zmenu_view.PageID = "view"; // page ID
zmenu_view.FormID = "fzmenuview"; // form ID
var EW_PAGE_ID = zmenu_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
zmenu_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
zmenu_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
zmenu_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $zmenu->TableCaption() ?>
&nbsp;&nbsp;<?php $zmenu_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($zmenu->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $zmenu_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $zmenu_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $zmenu_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $zmenu_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $zmenu_view->ShowPageHeader(); ?>
<?php
$zmenu_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($zmenu->id_grupo_seccion->Visible) { // id_grupo_seccion ?>
	<tr id="r_id_grupo_seccion"<?php echo $zmenu->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zmenu->id_grupo_seccion->FldCaption() ?></td>
		<td<?php echo $zmenu->id_grupo_seccion->CellAttributes() ?>>
<div<?php echo $zmenu->id_grupo_seccion->ViewAttributes() ?>><?php echo $zmenu->id_grupo_seccion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($zmenu->posicion->Visible) { // posicion ?>
	<tr id="r_posicion"<?php echo $zmenu->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zmenu->posicion->FldCaption() ?></td>
		<td<?php echo $zmenu->posicion->CellAttributes() ?>>
<div<?php echo $zmenu->posicion->ViewAttributes() ?>><?php echo $zmenu->posicion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($zmenu->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $zmenu->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zmenu->orden->FldCaption() ?></td>
		<td<?php echo $zmenu->orden->CellAttributes() ?>>
<div<?php echo $zmenu->orden->ViewAttributes() ?>><?php echo $zmenu->orden->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($zmenu->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $zmenu->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zmenu->estatus->FldCaption() ?></td>
		<td<?php echo $zmenu->estatus->CellAttributes() ?>>
<div<?php echo $zmenu->estatus->ViewAttributes() ?>><?php echo $zmenu->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$zmenu_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($zmenu->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$zmenu_view->Page_Terminate();
?>
<?php

//
// Page class
//
class czmenu_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'menu';

	// Page object name
	var $PageObjName = 'zmenu_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $zmenu;
		if ($zmenu->UseTokenInUrl) $PageUrl .= "t=" . $zmenu->TableVar . "&"; // Add page token
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
		global $objForm, $zmenu;
		if ($zmenu->UseTokenInUrl) {
			if ($objForm)
				return ($zmenu->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($zmenu->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function czmenu_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (zmenu)
		if (!isset($GLOBALS["zmenu"])) {
			$GLOBALS["zmenu"] = new czmenu();
			$GLOBALS["Table"] =& $GLOBALS["zmenu"];
		}
		$KeyUrl = "";
		if (@$_GET["id_menu"] <> "") {
			$this->RecKey["id_menu"] = $_GET["id_menu"];
			$KeyUrl .= "&id_menu=" . urlencode($this->RecKey["id_menu"]);
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
			define("EW_TABLE_NAME", 'menu', TRUE);

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
		global $zmenu;

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
			$this->Page_Terminate("zmenulist.php");
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
		global $Language, $zmenu;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_menu"] <> "") {
				$zmenu->id_menu->setQueryStringValue($_GET["id_menu"]);
				$this->RecKey["id_menu"] = $zmenu->id_menu->QueryStringValue;
			} else {
				$sReturnUrl = "zmenulist.php"; // Return to list
			}

			// Get action
			$zmenu->CurrentAction = "I"; // Display form
			switch ($zmenu->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "zmenulist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "zmenulist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$zmenu->RowType = EW_ROWTYPE_VIEW;
		$zmenu->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $zmenu;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$zmenu->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$zmenu->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $zmenu->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$zmenu->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$zmenu->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$zmenu->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $zmenu;
		$sFilter = $zmenu->KeyFilter();

		// Call Row Selecting event
		$zmenu->Row_Selecting($sFilter);

		// Load SQL based on filter
		$zmenu->CurrentFilter = $sFilter;
		$sSql = $zmenu->SQL();
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
		global $conn, $zmenu;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$zmenu->Row_Selected($row);
		$zmenu->id_menu->setDbValue($rs->fields('id_menu'));
		$zmenu->id_grupo_seccion->setDbValue($rs->fields('id_grupo_seccion'));
		$zmenu->posicion->setDbValue($rs->fields('posicion'));
		$zmenu->orden->setDbValue($rs->fields('orden'));
		$zmenu->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $zmenu;

		// Initialize URLs
		$this->AddUrl = $zmenu->AddUrl();
		$this->EditUrl = $zmenu->EditUrl();
		$this->CopyUrl = $zmenu->CopyUrl();
		$this->DeleteUrl = $zmenu->DeleteUrl();
		$this->ListUrl = $zmenu->ListUrl();

		// Call Row_Rendering event
		$zmenu->Row_Rendering();

		// Common render codes for all row types
		// id_menu
		// id_grupo_seccion
		// posicion
		// orden
		// estatus

		if ($zmenu->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_grupo_seccion
			if (strval($zmenu->id_grupo_seccion->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($zmenu->id_grupo_seccion->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$zmenu->id_grupo_seccion->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$zmenu->id_grupo_seccion->ViewValue = $zmenu->id_grupo_seccion->CurrentValue;
				}
			} else {
				$zmenu->id_grupo_seccion->ViewValue = NULL;
			}
			$zmenu->id_grupo_seccion->ViewCustomAttributes = "";

			// posicion
			if (strval($zmenu->posicion->CurrentValue) <> "") {
				switch ($zmenu->posicion->CurrentValue) {
					case "1":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(1) <> "" ? $zmenu->posicion->FldTagCaption(1) : $zmenu->posicion->CurrentValue;
						break;
					case "2":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(2) <> "" ? $zmenu->posicion->FldTagCaption(2) : $zmenu->posicion->CurrentValue;
						break;
					case "3":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(3) <> "" ? $zmenu->posicion->FldTagCaption(3) : $zmenu->posicion->CurrentValue;
						break;
					case "4":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(4) <> "" ? $zmenu->posicion->FldTagCaption(4) : $zmenu->posicion->CurrentValue;
						break;
					default:
						$zmenu->posicion->ViewValue = $zmenu->posicion->CurrentValue;
				}
			} else {
				$zmenu->posicion->ViewValue = NULL;
			}
			$zmenu->posicion->ViewCustomAttributes = "";

			// orden
			$zmenu->orden->ViewValue = $zmenu->orden->CurrentValue;
			$zmenu->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($zmenu->estatus->CurrentValue) <> "") {
				switch ($zmenu->estatus->CurrentValue) {
					case "1":
						$zmenu->estatus->ViewValue = $zmenu->estatus->FldTagCaption(1) <> "" ? $zmenu->estatus->FldTagCaption(1) : $zmenu->estatus->CurrentValue;
						break;
					case "0":
						$zmenu->estatus->ViewValue = $zmenu->estatus->FldTagCaption(2) <> "" ? $zmenu->estatus->FldTagCaption(2) : $zmenu->estatus->CurrentValue;
						break;
					default:
						$zmenu->estatus->ViewValue = $zmenu->estatus->CurrentValue;
				}
			} else {
				$zmenu->estatus->ViewValue = NULL;
			}
			$zmenu->estatus->ViewCustomAttributes = "";

			// id_grupo_seccion
			$zmenu->id_grupo_seccion->LinkCustomAttributes = "";
			$zmenu->id_grupo_seccion->HrefValue = "";
			$zmenu->id_grupo_seccion->TooltipValue = "";

			// posicion
			$zmenu->posicion->LinkCustomAttributes = "";
			$zmenu->posicion->HrefValue = "";
			$zmenu->posicion->TooltipValue = "";

			// orden
			$zmenu->orden->LinkCustomAttributes = "";
			$zmenu->orden->HrefValue = "";
			$zmenu->orden->TooltipValue = "";

			// estatus
			$zmenu->estatus->LinkCustomAttributes = "";
			$zmenu->estatus->HrefValue = "";
			$zmenu->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($zmenu->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$zmenu->Row_Rendered();
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
