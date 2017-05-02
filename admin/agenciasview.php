<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "agenciasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$agencias_view = new cagencias_view();
$Page =& $agencias_view;

// Page init
$agencias_view->Page_Init();

// Page main
$agencias_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($agencias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var agencias_view = new ew_Page("agencias_view");

// page properties
agencias_view.PageID = "view"; // page ID
agencias_view.FormID = "fagenciasview"; // form ID
var EW_PAGE_ID = agencias_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
agencias_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
agencias_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
agencias_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $agencias->TableCaption() ?>
&nbsp;&nbsp;<?php $agencias_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($agencias->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $agencias_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $agencias_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $agencias_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $agencias_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('agencias_servicios')) { ?>
<a href="agencias_servicioslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=agencias&id_agencias=<?php echo urlencode(strval($agencias->id_agencias->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("agencias_servicios", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $agencias_view->ShowPageHeader(); ?>
<?php
$agencias_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($agencias->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->nombre->FldCaption() ?></td>
		<td<?php echo $agencias->nombre->CellAttributes() ?>>
<div<?php echo $agencias->nombre->ViewAttributes() ?>><?php echo $agencias->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias->id_ciudad->Visible) { // id_ciudad ?>
	<tr id="r_id_ciudad"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->id_ciudad->FldCaption() ?></td>
		<td<?php echo $agencias->id_ciudad->CellAttributes() ?>>
<div<?php echo $agencias->id_ciudad->ViewAttributes() ?>><?php echo $agencias->id_ciudad->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias->direccion->Visible) { // direccion ?>
	<tr id="r_direccion"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->direccion->FldCaption() ?></td>
		<td<?php echo $agencias->direccion->CellAttributes() ?>>
<div<?php echo $agencias->direccion->ViewAttributes() ?>><?php echo $agencias->direccion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias->telef_1->Visible) { // telef_1 ?>
	<tr id="r_telef_1"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->telef_1->FldCaption() ?></td>
		<td<?php echo $agencias->telef_1->CellAttributes() ?>>
<div<?php echo $agencias->telef_1->ViewAttributes() ?>><?php echo $agencias->telef_1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias->horario_agencia->Visible) { // horario_agencia ?>
	<tr id="r_horario_agencia"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->horario_agencia->FldCaption() ?></td>
		<td<?php echo $agencias->horario_agencia->CellAttributes() ?>>
<div<?php echo $agencias->horario_agencia->ViewAttributes() ?>><?php echo $agencias->horario_agencia->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias->horario_taq_auto->Visible) { // horario_taq_auto ?>
	<tr id="r_horario_taq_auto"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->horario_taq_auto->FldCaption() ?></td>
		<td<?php echo $agencias->horario_taq_auto->CellAttributes() ?>>
<div<?php echo $agencias->horario_taq_auto->ViewAttributes() ?>><?php echo $agencias->horario_taq_auto->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias->coordenadas->Visible) { // coordenadas ?>
	<tr id="r_coordenadas"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->coordenadas->FldCaption() ?></td>
		<td<?php echo $agencias->coordenadas->CellAttributes() ?>>
<div<?php echo $agencias->coordenadas->ViewAttributes() ?>><?php echo $agencias->coordenadas->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($agencias->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->estatus->FldCaption() ?></td>
		<td<?php echo $agencias->estatus->CellAttributes() ?>>
<div<?php echo $agencias->estatus->ViewAttributes() ?>><?php echo $agencias->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$agencias_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($agencias->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$agencias_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cagencias_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'agencias';

	// Page object name
	var $PageObjName = 'agencias_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $agencias;
		if ($agencias->UseTokenInUrl) $PageUrl .= "t=" . $agencias->TableVar . "&"; // Add page token
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
		global $objForm, $agencias;
		if ($agencias->UseTokenInUrl) {
			if ($objForm)
				return ($agencias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($agencias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cagencias_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (agencias)
		if (!isset($GLOBALS["agencias"])) {
			$GLOBALS["agencias"] = new cagencias();
			$GLOBALS["Table"] =& $GLOBALS["agencias"];
		}
		$KeyUrl = "";
		if (@$_GET["id_agencias"] <> "") {
			$this->RecKey["id_agencias"] = $_GET["id_agencias"];
			$KeyUrl .= "&id_agencias=" . urlencode($this->RecKey["id_agencias"]);
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
			define("EW_TABLE_NAME", 'agencias', TRUE);

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
		global $agencias;

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
			$this->Page_Terminate("agenciaslist.php");
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
		global $Language, $agencias;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_agencias"] <> "") {
				$agencias->id_agencias->setQueryStringValue($_GET["id_agencias"]);
				$this->RecKey["id_agencias"] = $agencias->id_agencias->QueryStringValue;
			} else {
				$sReturnUrl = "agenciaslist.php"; // Return to list
			}

			// Get action
			$agencias->CurrentAction = "I"; // Display form
			switch ($agencias->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "agenciaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "agenciaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$agencias->RowType = EW_ROWTYPE_VIEW;
		$agencias->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $agencias;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$agencias->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$agencias->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $agencias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$agencias->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$agencias->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$agencias->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $agencias;
		$sFilter = $agencias->KeyFilter();

		// Call Row Selecting event
		$agencias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$agencias->CurrentFilter = $sFilter;
		$sSql = $agencias->SQL();
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
		global $conn, $agencias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$agencias->Row_Selected($row);
		$agencias->id_agencias->setDbValue($rs->fields('id_agencias'));
		$agencias->nombre->setDbValue($rs->fields('nombre'));
		$agencias->id_ciudad->setDbValue($rs->fields('id_ciudad'));
		$agencias->direccion->setDbValue($rs->fields('direccion'));
		$agencias->telef_1->setDbValue($rs->fields('telef_1'));
		$agencias->horario_agencia->setDbValue($rs->fields('horario_agencia'));
		$agencias->horario_taq_auto->setDbValue($rs->fields('horario_taq_auto'));
		$agencias->coordenadas->setDbValue($rs->fields('coordenadas'));
		$agencias->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $agencias;

		// Initialize URLs
		$this->AddUrl = $agencias->AddUrl();
		$this->EditUrl = $agencias->EditUrl();
		$this->CopyUrl = $agencias->CopyUrl();
		$this->DeleteUrl = $agencias->DeleteUrl();
		$this->ListUrl = $agencias->ListUrl();

		// Call Row_Rendering event
		$agencias->Row_Rendering();

		// Common render codes for all row types
		// id_agencias
		// nombre
		// id_ciudad
		// direccion
		// telef_1
		// horario_agencia
		// horario_taq_auto
		// coordenadas
		// estatus

		if ($agencias->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$agencias->nombre->ViewValue = $agencias->nombre->CurrentValue;
			$agencias->nombre->ViewCustomAttributes = "";

			// id_ciudad
			if (strval($agencias->id_ciudad->CurrentValue) <> "") {
				$sFilterWrk = "`id_ciudad` = " . ew_AdjustSql($agencias->id_ciudad->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `ciudad`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias->id_ciudad->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$agencias->id_ciudad->ViewValue = $agencias->id_ciudad->CurrentValue;
				}
			} else {
				$agencias->id_ciudad->ViewValue = NULL;
			}
			$agencias->id_ciudad->ViewCustomAttributes = "";

			// direccion
			$agencias->direccion->ViewValue = $agencias->direccion->CurrentValue;
			$agencias->direccion->ViewCustomAttributes = "";

			// telef_1
			$agencias->telef_1->ViewValue = $agencias->telef_1->CurrentValue;
			$agencias->telef_1->ViewCustomAttributes = "";

			// horario_agencia
			$agencias->horario_agencia->ViewValue = $agencias->horario_agencia->CurrentValue;
			$agencias->horario_agencia->ViewCustomAttributes = "";

			// horario_taq_auto
			$agencias->horario_taq_auto->ViewValue = $agencias->horario_taq_auto->CurrentValue;
			$agencias->horario_taq_auto->ViewCustomAttributes = "";

			// coordenadas
			$agencias->coordenadas->ViewValue = $agencias->coordenadas->CurrentValue;
			$agencias->coordenadas->ViewCustomAttributes = "";

			// estatus
			if (strval($agencias->estatus->CurrentValue) <> "") {
				switch ($agencias->estatus->CurrentValue) {
					case "0":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(1) <> "" ? $agencias->estatus->FldTagCaption(1) : $agencias->estatus->CurrentValue;
						break;
					case "1":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(2) <> "" ? $agencias->estatus->FldTagCaption(2) : $agencias->estatus->CurrentValue;
						break;
					default:
						$agencias->estatus->ViewValue = $agencias->estatus->CurrentValue;
				}
			} else {
				$agencias->estatus->ViewValue = NULL;
			}
			$agencias->estatus->ViewCustomAttributes = "";

			// nombre
			$agencias->nombre->LinkCustomAttributes = "";
			$agencias->nombre->HrefValue = "";
			$agencias->nombre->TooltipValue = "";

			// id_ciudad
			$agencias->id_ciudad->LinkCustomAttributes = "";
			$agencias->id_ciudad->HrefValue = "";
			$agencias->id_ciudad->TooltipValue = "";

			// direccion
			$agencias->direccion->LinkCustomAttributes = "";
			$agencias->direccion->HrefValue = "";
			$agencias->direccion->TooltipValue = "";

			// telef_1
			$agencias->telef_1->LinkCustomAttributes = "";
			$agencias->telef_1->HrefValue = "";
			$agencias->telef_1->TooltipValue = "";

			// horario_agencia
			$agencias->horario_agencia->LinkCustomAttributes = "";
			$agencias->horario_agencia->HrefValue = "";
			$agencias->horario_agencia->TooltipValue = "";

			// horario_taq_auto
			$agencias->horario_taq_auto->LinkCustomAttributes = "";
			$agencias->horario_taq_auto->HrefValue = "";
			$agencias->horario_taq_auto->TooltipValue = "";

			// coordenadas
			$agencias->coordenadas->LinkCustomAttributes = "";
			$agencias->coordenadas->HrefValue = "";
			$agencias->coordenadas->TooltipValue = "";

			// estatus
			$agencias->estatus->LinkCustomAttributes = "";
			$agencias->estatus->HrefValue = "";
			$agencias->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($agencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$agencias->Row_Rendered();
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
