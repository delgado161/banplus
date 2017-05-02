<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "encuestainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$encuesta_view = new cencuesta_view();
$Page =& $encuesta_view;

// Page init
$encuesta_view->Page_Init();

// Page main
$encuesta_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($encuesta->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var encuesta_view = new ew_Page("encuesta_view");

// page properties
encuesta_view.PageID = "view"; // page ID
encuesta_view.FormID = "fencuestaview"; // form ID
var EW_PAGE_ID = encuesta_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
encuesta_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
encuesta_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
encuesta_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $encuesta->TableCaption() ?>
&nbsp;&nbsp;<?php $encuesta_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($encuesta->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $encuesta_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $encuesta_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $encuesta_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $encuesta_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('preguntas')) { ?>
<a href="preguntaslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=encuesta&id_encuesta=<?php echo urlencode(strval($encuesta->id_encuesta->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("preguntas", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $encuesta_view->ShowPageHeader(); ?>
<?php
$encuesta_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($encuesta->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $encuesta->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $encuesta->nombre->FldCaption() ?></td>
		<td<?php echo $encuesta->nombre->CellAttributes() ?>>
<div<?php echo $encuesta->nombre->ViewAttributes() ?>><?php echo $encuesta->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($encuesta->id_grupo->Visible) { // id_grupo ?>
	<tr id="r_id_grupo"<?php echo $encuesta->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $encuesta->id_grupo->FldCaption() ?></td>
		<td<?php echo $encuesta->id_grupo->CellAttributes() ?>>
<div<?php echo $encuesta->id_grupo->ViewAttributes() ?>><?php echo $encuesta->id_grupo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($encuesta->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $encuesta->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $encuesta->estatus->FldCaption() ?></td>
		<td<?php echo $encuesta->estatus->CellAttributes() ?>>
<div<?php echo $encuesta->estatus->ViewAttributes() ?>><?php echo $encuesta->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$encuesta_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($encuesta->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$encuesta_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cencuesta_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'encuesta';

	// Page object name
	var $PageObjName = 'encuesta_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $encuesta;
		if ($encuesta->UseTokenInUrl) $PageUrl .= "t=" . $encuesta->TableVar . "&"; // Add page token
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
		global $objForm, $encuesta;
		if ($encuesta->UseTokenInUrl) {
			if ($objForm)
				return ($encuesta->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($encuesta->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cencuesta_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (encuesta)
		if (!isset($GLOBALS["encuesta"])) {
			$GLOBALS["encuesta"] = new cencuesta();
			$GLOBALS["Table"] =& $GLOBALS["encuesta"];
		}
		$KeyUrl = "";
		if (@$_GET["id_encuesta"] <> "") {
			$this->RecKey["id_encuesta"] = $_GET["id_encuesta"];
			$KeyUrl .= "&id_encuesta=" . urlencode($this->RecKey["id_encuesta"]);
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
			define("EW_TABLE_NAME", 'encuesta', TRUE);

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
		global $encuesta;

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
			$this->Page_Terminate("encuestalist.php");
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
		global $Language, $encuesta;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_encuesta"] <> "") {
				$encuesta->id_encuesta->setQueryStringValue($_GET["id_encuesta"]);
				$this->RecKey["id_encuesta"] = $encuesta->id_encuesta->QueryStringValue;
			} else {
				$sReturnUrl = "encuestalist.php"; // Return to list
			}

			// Get action
			$encuesta->CurrentAction = "I"; // Display form
			switch ($encuesta->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "encuestalist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "encuestalist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$encuesta->RowType = EW_ROWTYPE_VIEW;
		$encuesta->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $encuesta;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$encuesta->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$encuesta->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $encuesta->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$encuesta->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$encuesta->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$encuesta->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $encuesta;
		$sFilter = $encuesta->KeyFilter();

		// Call Row Selecting event
		$encuesta->Row_Selecting($sFilter);

		// Load SQL based on filter
		$encuesta->CurrentFilter = $sFilter;
		$sSql = $encuesta->SQL();
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
		global $conn, $encuesta;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$encuesta->Row_Selected($row);
		$encuesta->id_encuesta->setDbValue($rs->fields('id_encuesta'));
		$encuesta->nombre->setDbValue($rs->fields('nombre'));
		$encuesta->id_grupo->setDbValue($rs->fields('id_grupo'));
		$encuesta->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $encuesta;

		// Initialize URLs
		$this->AddUrl = $encuesta->AddUrl();
		$this->EditUrl = $encuesta->EditUrl();
		$this->CopyUrl = $encuesta->CopyUrl();
		$this->DeleteUrl = $encuesta->DeleteUrl();
		$this->ListUrl = $encuesta->ListUrl();

		// Call Row_Rendering event
		$encuesta->Row_Rendering();

		// Common render codes for all row types
		// id_encuesta
		// nombre
		// id_grupo
		// estatus

		if ($encuesta->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$encuesta->nombre->ViewValue = $encuesta->nombre->CurrentValue;
			$encuesta->nombre->ViewCustomAttributes = "";

			// id_grupo
			if (strval($encuesta->id_grupo->CurrentValue) <> "") {
				$arwrk = explode(",", $encuesta->id_grupo->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_grupo` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is NULL";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$encuesta->id_grupo->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$encuesta->id_grupo->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $encuesta->id_grupo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$encuesta->id_grupo->ViewValue = $encuesta->id_grupo->CurrentValue;
				}
			} else {
				$encuesta->id_grupo->ViewValue = NULL;
			}
			$encuesta->id_grupo->ViewCustomAttributes = "";

			// estatus
			if (strval($encuesta->estatus->CurrentValue) <> "") {
				switch ($encuesta->estatus->CurrentValue) {
					case "1":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(1) <> "" ? $encuesta->estatus->FldTagCaption(1) : $encuesta->estatus->CurrentValue;
						break;
					case "0":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(2) <> "" ? $encuesta->estatus->FldTagCaption(2) : $encuesta->estatus->CurrentValue;
						break;
					default:
						$encuesta->estatus->ViewValue = $encuesta->estatus->CurrentValue;
				}
			} else {
				$encuesta->estatus->ViewValue = NULL;
			}
			$encuesta->estatus->ViewCustomAttributes = "";

			// nombre
			$encuesta->nombre->LinkCustomAttributes = "";
			$encuesta->nombre->HrefValue = "";
			$encuesta->nombre->TooltipValue = "";

			// id_grupo
			$encuesta->id_grupo->LinkCustomAttributes = "";
			$encuesta->id_grupo->HrefValue = "";
			$encuesta->id_grupo->TooltipValue = "";

			// estatus
			$encuesta->estatus->LinkCustomAttributes = "";
			$encuesta->estatus->HrefValue = "";
			$encuesta->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($encuesta->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$encuesta->Row_Rendered();
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
