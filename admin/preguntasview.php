<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "preguntasinfo.php" ?>
<?php include_once "encuestainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$preguntas_view = new cpreguntas_view();
$Page =& $preguntas_view;

// Page init
$preguntas_view->Page_Init();

// Page main
$preguntas_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($preguntas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var preguntas_view = new ew_Page("preguntas_view");

// page properties
preguntas_view.PageID = "view"; // page ID
preguntas_view.FormID = "fpreguntasview"; // form ID
var EW_PAGE_ID = preguntas_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
preguntas_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
preguntas_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
preguntas_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $preguntas->TableCaption() ?>
&nbsp;&nbsp;<?php $preguntas_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($preguntas->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $preguntas_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $preguntas_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $preguntas_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $preguntas_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('respuestas')) { ?>
<a href="respuestaslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=preguntas&id_pregunta=<?php echo urlencode(strval($preguntas->id_pregunta->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("respuestas", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $preguntas_view->ShowPageHeader(); ?>
<?php
$preguntas_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($preguntas->id_encuesta->Visible) { // id_encuesta ?>
	<tr id="r_id_encuesta"<?php echo $preguntas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $preguntas->id_encuesta->FldCaption() ?></td>
		<td<?php echo $preguntas->id_encuesta->CellAttributes() ?>>
<div<?php echo $preguntas->id_encuesta->ViewAttributes() ?>><?php echo $preguntas->id_encuesta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($preguntas->pregunta->Visible) { // pregunta ?>
	<tr id="r_pregunta"<?php echo $preguntas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $preguntas->pregunta->FldCaption() ?></td>
		<td<?php echo $preguntas->pregunta->CellAttributes() ?>>
<div<?php echo $preguntas->pregunta->ViewAttributes() ?>><?php echo $preguntas->pregunta->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($preguntas->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $preguntas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $preguntas->estatus->FldCaption() ?></td>
		<td<?php echo $preguntas->estatus->CellAttributes() ?>>
<div<?php echo $preguntas->estatus->ViewAttributes() ?>><?php echo $preguntas->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$preguntas_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($preguntas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$preguntas_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cpreguntas_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'preguntas';

	// Page object name
	var $PageObjName = 'preguntas_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $preguntas;
		if ($preguntas->UseTokenInUrl) $PageUrl .= "t=" . $preguntas->TableVar . "&"; // Add page token
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
		global $objForm, $preguntas;
		if ($preguntas->UseTokenInUrl) {
			if ($objForm)
				return ($preguntas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($preguntas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpreguntas_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (preguntas)
		if (!isset($GLOBALS["preguntas"])) {
			$GLOBALS["preguntas"] = new cpreguntas();
			$GLOBALS["Table"] =& $GLOBALS["preguntas"];
		}
		$KeyUrl = "";
		if (@$_GET["id_pregunta"] <> "") {
			$this->RecKey["id_pregunta"] = $_GET["id_pregunta"];
			$KeyUrl .= "&id_pregunta=" . urlencode($this->RecKey["id_pregunta"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (encuesta)
		if (!isset($GLOBALS['encuesta'])) $GLOBALS['encuesta'] = new cencuesta();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'preguntas', TRUE);

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
		global $preguntas;

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
			$this->Page_Terminate("preguntaslist.php");
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
		global $Language, $preguntas;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_pregunta"] <> "") {
				$preguntas->id_pregunta->setQueryStringValue($_GET["id_pregunta"]);
				$this->RecKey["id_pregunta"] = $preguntas->id_pregunta->QueryStringValue;
			} else {
				$sReturnUrl = "preguntaslist.php"; // Return to list
			}

			// Get action
			$preguntas->CurrentAction = "I"; // Display form
			switch ($preguntas->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "preguntaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "preguntaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$preguntas->RowType = EW_ROWTYPE_VIEW;
		$preguntas->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $preguntas;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$preguntas->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$preguntas->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $preguntas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$preguntas->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$preguntas->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$preguntas->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $preguntas;
		$sFilter = $preguntas->KeyFilter();

		// Call Row Selecting event
		$preguntas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$preguntas->CurrentFilter = $sFilter;
		$sSql = $preguntas->SQL();
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
		global $conn, $preguntas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$preguntas->Row_Selected($row);
		$preguntas->id_pregunta->setDbValue($rs->fields('id_pregunta'));
		$preguntas->id_encuesta->setDbValue($rs->fields('id_encuesta'));
		$preguntas->pregunta->setDbValue($rs->fields('pregunta'));
		$preguntas->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $preguntas;

		// Initialize URLs
		$this->AddUrl = $preguntas->AddUrl();
		$this->EditUrl = $preguntas->EditUrl();
		$this->CopyUrl = $preguntas->CopyUrl();
		$this->DeleteUrl = $preguntas->DeleteUrl();
		$this->ListUrl = $preguntas->ListUrl();

		// Call Row_Rendering event
		$preguntas->Row_Rendering();

		// Common render codes for all row types
		// id_pregunta
		// id_encuesta
		// pregunta
		// estatus

		if ($preguntas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_encuesta
			if (strval($preguntas->id_encuesta->CurrentValue) <> "") {
				$sFilterWrk = "`id_encuesta` = " . ew_AdjustSql($preguntas->id_encuesta->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `encuesta`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$preguntas->id_encuesta->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$preguntas->id_encuesta->ViewValue = $preguntas->id_encuesta->CurrentValue;
				}
			} else {
				$preguntas->id_encuesta->ViewValue = NULL;
			}
			$preguntas->id_encuesta->ViewCustomAttributes = "";

			// pregunta
			$preguntas->pregunta->ViewValue = $preguntas->pregunta->CurrentValue;
			$preguntas->pregunta->ViewCustomAttributes = "";

			// estatus
			if (strval($preguntas->estatus->CurrentValue) <> "") {
				switch ($preguntas->estatus->CurrentValue) {
					case "1":
						$preguntas->estatus->ViewValue = $preguntas->estatus->FldTagCaption(1) <> "" ? $preguntas->estatus->FldTagCaption(1) : $preguntas->estatus->CurrentValue;
						break;
					case "0":
						$preguntas->estatus->ViewValue = $preguntas->estatus->FldTagCaption(2) <> "" ? $preguntas->estatus->FldTagCaption(2) : $preguntas->estatus->CurrentValue;
						break;
					default:
						$preguntas->estatus->ViewValue = $preguntas->estatus->CurrentValue;
				}
			} else {
				$preguntas->estatus->ViewValue = NULL;
			}
			$preguntas->estatus->ViewCustomAttributes = "";

			// id_encuesta
			$preguntas->id_encuesta->LinkCustomAttributes = "";
			$preguntas->id_encuesta->HrefValue = "";
			$preguntas->id_encuesta->TooltipValue = "";

			// pregunta
			$preguntas->pregunta->LinkCustomAttributes = "";
			$preguntas->pregunta->HrefValue = "";
			$preguntas->pregunta->TooltipValue = "";

			// estatus
			$preguntas->estatus->LinkCustomAttributes = "";
			$preguntas->estatus->HrefValue = "";
			$preguntas->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($preguntas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$preguntas->Row_Rendered();
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
