<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "grupoinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$grupo_view = new cgrupo_view();
$Page =& $grupo_view;

// Page init
$grupo_view->Page_Init();

// Page main
$grupo_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($grupo->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grupo_view = new ew_Page("grupo_view");

// page properties
grupo_view.PageID = "view"; // page ID
grupo_view.FormID = "fgrupoview"; // form ID
var EW_PAGE_ID = grupo_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grupo_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grupo_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grupo_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grupo->TableCaption() ?>
&nbsp;&nbsp;<?php $grupo_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($grupo->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $grupo_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $grupo_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $grupo_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $grupo_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $grupo_view->ShowPageHeader(); ?>
<?php
$grupo_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($grupo->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->nombre->FldCaption() ?></td>
		<td<?php echo $grupo->nombre->CellAttributes() ?>>
<div<?php echo $grupo->nombre->ViewAttributes() ?>><?php echo $grupo->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grupo->id_padre->Visible) { // id_padre ?>
	<tr id="r_id_padre"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->id_padre->FldCaption() ?></td>
		<td<?php echo $grupo->id_padre->CellAttributes() ?>>
<div<?php echo $grupo->id_padre->ViewAttributes() ?>><?php echo $grupo->id_padre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grupo->id_contenido->Visible) { // id_contenido ?>
	<tr id="r_id_contenido"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->id_contenido->FldCaption() ?></td>
		<td<?php echo $grupo->id_contenido->CellAttributes() ?>>
<div<?php echo $grupo->id_contenido->ViewAttributes() ?>><?php echo $grupo->id_contenido->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grupo->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->orden->FldCaption() ?></td>
		<td<?php echo $grupo->orden->CellAttributes() ?>>
<div<?php echo $grupo->orden->ViewAttributes() ?>><?php echo $grupo->orden->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($grupo->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->estatus->FldCaption() ?></td>
		<td<?php echo $grupo->estatus->CellAttributes() ?>>
<div<?php echo $grupo->estatus->ViewAttributes() ?>><?php echo $grupo->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$grupo_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($grupo->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$grupo_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrupo_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'grupo';

	// Page object name
	var $PageObjName = 'grupo_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grupo;
		if ($grupo->UseTokenInUrl) $PageUrl .= "t=" . $grupo->TableVar . "&"; // Add page token
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
		global $objForm, $grupo;
		if ($grupo->UseTokenInUrl) {
			if ($objForm)
				return ($grupo->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grupo->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrupo_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (grupo)
		if (!isset($GLOBALS["grupo"])) {
			$GLOBALS["grupo"] = new cgrupo();
			$GLOBALS["Table"] =& $GLOBALS["grupo"];
		}
		$KeyUrl = "";
		if (@$_GET["id_grupo"] <> "") {
			$this->RecKey["id_grupo"] = $_GET["id_grupo"];
			$KeyUrl .= "&id_grupo=" . urlencode($this->RecKey["id_grupo"]);
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
			define("EW_TABLE_NAME", 'grupo', TRUE);

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
		global $grupo;

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
			$this->Page_Terminate("grupolist.php");
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
		global $Language, $grupo;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_grupo"] <> "") {
				$grupo->id_grupo->setQueryStringValue($_GET["id_grupo"]);
				$this->RecKey["id_grupo"] = $grupo->id_grupo->QueryStringValue;
			} else {
				$sReturnUrl = "grupolist.php"; // Return to list
			}

			// Get action
			$grupo->CurrentAction = "I"; // Display form
			switch ($grupo->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "grupolist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "grupolist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$grupo->RowType = EW_ROWTYPE_VIEW;
		$grupo->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $grupo;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$grupo->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$grupo->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $grupo->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$grupo->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$grupo->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$grupo->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grupo;
		$sFilter = $grupo->KeyFilter();

		// Call Row Selecting event
		$grupo->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grupo->CurrentFilter = $sFilter;
		$sSql = $grupo->SQL();
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
		global $conn, $grupo;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$grupo->Row_Selected($row);
		$grupo->id_grupo->setDbValue($rs->fields('id_grupo'));
		$grupo->nombre->setDbValue($rs->fields('nombre'));
		$grupo->id_padre->setDbValue($rs->fields('id_padre'));
		$grupo->id_contenido->setDbValue($rs->fields('id_contenido'));
		$grupo->orden->setDbValue($rs->fields('orden'));
		$grupo->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grupo;

		// Initialize URLs
		$this->AddUrl = $grupo->AddUrl();
		$this->EditUrl = $grupo->EditUrl();
		$this->CopyUrl = $grupo->CopyUrl();
		$this->DeleteUrl = $grupo->DeleteUrl();
		$this->ListUrl = $grupo->ListUrl();

		// Call Row_Rendering event
		$grupo->Row_Rendering();

		// Common render codes for all row types
		// id_grupo
		// nombre
		// id_padre
		// id_contenido
		// orden
		// estatus

		if ($grupo->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$grupo->nombre->ViewValue = $grupo->nombre->CurrentValue;
			$grupo->nombre->ViewCustomAttributes = "";

			// id_padre
			if (strval($grupo->id_padre->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo` = " . ew_AdjustSql($grupo->id_padre->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo->id_padre->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$grupo->id_padre->ViewValue = $grupo->id_padre->CurrentValue;
				}
			} else {
				$grupo->id_padre->ViewValue = NULL;
			}
			$grupo->id_padre->ViewCustomAttributes = "";

			// id_contenido
			if (strval($grupo->id_contenido->CurrentValue) <> "") {
				$sFilterWrk = "`id_contenido` = " . ew_AdjustSql($grupo->id_contenido->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo->id_contenido->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo->id_contenido->ViewValue = $grupo->id_contenido->CurrentValue;
				}
			} else {
				$grupo->id_contenido->ViewValue = NULL;
			}
			$grupo->id_contenido->ViewCustomAttributes = "";

			// orden
			$grupo->orden->ViewValue = $grupo->orden->CurrentValue;
			$grupo->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($grupo->estatus->CurrentValue) <> "") {
				switch ($grupo->estatus->CurrentValue) {
					case "1":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(1) <> "" ? $grupo->estatus->FldTagCaption(1) : $grupo->estatus->CurrentValue;
						break;
					case "0":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(2) <> "" ? $grupo->estatus->FldTagCaption(2) : $grupo->estatus->CurrentValue;
						break;
					default:
						$grupo->estatus->ViewValue = $grupo->estatus->CurrentValue;
				}
			} else {
				$grupo->estatus->ViewValue = NULL;
			}
			$grupo->estatus->ViewCustomAttributes = "";

			// nombre
			$grupo->nombre->LinkCustomAttributes = "";
			$grupo->nombre->HrefValue = "";
			$grupo->nombre->TooltipValue = "";

			// id_padre
			$grupo->id_padre->LinkCustomAttributes = "";
			$grupo->id_padre->HrefValue = "";
			$grupo->id_padre->TooltipValue = "";

			// id_contenido
			$grupo->id_contenido->LinkCustomAttributes = "";
			$grupo->id_contenido->HrefValue = "";
			$grupo->id_contenido->TooltipValue = "";

			// orden
			$grupo->orden->LinkCustomAttributes = "";
			$grupo->orden->HrefValue = "";
			$grupo->orden->TooltipValue = "";

			// estatus
			$grupo->estatus->LinkCustomAttributes = "";
			$grupo->estatus->HrefValue = "";
			$grupo->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grupo->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grupo->Row_Rendered();
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
