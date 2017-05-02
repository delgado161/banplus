<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuario_niveles_permisosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuario_niveles_permisos_view = new cusuario_niveles_permisos_view();
$Page =& $usuario_niveles_permisos_view;

// Page init
$usuario_niveles_permisos_view->Page_Init();

// Page main
$usuario_niveles_permisos_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuario_niveles_permisos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuario_niveles_permisos_view = new ew_Page("usuario_niveles_permisos_view");

// page properties
usuario_niveles_permisos_view.PageID = "view"; // page ID
usuario_niveles_permisos_view.FormID = "fusuario_niveles_permisosview"; // form ID
var EW_PAGE_ID = usuario_niveles_permisos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuario_niveles_permisos_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuario_niveles_permisos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuario_niveles_permisos_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuario_niveles_permisos->TableCaption() ?>
&nbsp;&nbsp;<?php $usuario_niveles_permisos_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($usuario_niveles_permisos->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $usuario_niveles_permisos_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuario_niveles_permisos_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuario_niveles_permisos_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuario_niveles_permisos_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $usuario_niveles_permisos_view->ShowPageHeader(); ?>
<?php
$usuario_niveles_permisos_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuario_niveles_permisos->id_usuario_nivel_permiso->Visible) { // id_usuario_nivel_permiso ?>
	<tr id="r_id_usuario_nivel_permiso"<?php echo $usuario_niveles_permisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuario_niveles_permisos->id_usuario_nivel_permiso->FldCaption() ?></td>
		<td<?php echo $usuario_niveles_permisos->id_usuario_nivel_permiso->CellAttributes() ?>>
<div<?php echo $usuario_niveles_permisos->id_usuario_nivel_permiso->ViewAttributes() ?>><?php echo $usuario_niveles_permisos->id_usuario_nivel_permiso->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuario_niveles_permisos->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $usuario_niveles_permisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuario_niveles_permisos->nombre->FldCaption() ?></td>
		<td<?php echo $usuario_niveles_permisos->nombre->CellAttributes() ?>>
<div<?php echo $usuario_niveles_permisos->nombre->ViewAttributes() ?>><?php echo $usuario_niveles_permisos->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuario_niveles_permisos->permiso->Visible) { // permiso ?>
	<tr id="r_permiso"<?php echo $usuario_niveles_permisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuario_niveles_permisos->permiso->FldCaption() ?></td>
		<td<?php echo $usuario_niveles_permisos->permiso->CellAttributes() ?>>
<div<?php echo $usuario_niveles_permisos->permiso->ViewAttributes() ?>><?php echo $usuario_niveles_permisos->permiso->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$usuario_niveles_permisos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuario_niveles_permisos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuario_niveles_permisos_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuario_niveles_permisos_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'usuario_niveles_permisos';

	// Page object name
	var $PageObjName = 'usuario_niveles_permisos_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuario_niveles_permisos;
		if ($usuario_niveles_permisos->UseTokenInUrl) $PageUrl .= "t=" . $usuario_niveles_permisos->TableVar . "&"; // Add page token
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
		global $objForm, $usuario_niveles_permisos;
		if ($usuario_niveles_permisos->UseTokenInUrl) {
			if ($objForm)
				return ($usuario_niveles_permisos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuario_niveles_permisos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuario_niveles_permisos_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuario_niveles_permisos)
		if (!isset($GLOBALS["usuario_niveles_permisos"])) {
			$GLOBALS["usuario_niveles_permisos"] = new cusuario_niveles_permisos();
			$GLOBALS["Table"] =& $GLOBALS["usuario_niveles_permisos"];
		}
		$KeyUrl = "";
		if (@$_GET["id_usuario_nivel_permiso"] <> "") {
			$this->RecKey["id_usuario_nivel_permiso"] = $_GET["id_usuario_nivel_permiso"];
			$KeyUrl .= "&id_usuario_nivel_permiso=" . urlencode($this->RecKey["id_usuario_nivel_permiso"]);
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
			define("EW_TABLE_NAME", 'usuario_niveles_permisos', TRUE);

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
		global $usuario_niveles_permisos;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $Language, $usuario_niveles_permisos;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_usuario_nivel_permiso"] <> "") {
				$usuario_niveles_permisos->id_usuario_nivel_permiso->setQueryStringValue($_GET["id_usuario_nivel_permiso"]);
				$this->RecKey["id_usuario_nivel_permiso"] = $usuario_niveles_permisos->id_usuario_nivel_permiso->QueryStringValue;
			} else {
				$sReturnUrl = "usuario_niveles_permisoslist.php"; // Return to list
			}

			// Get action
			$usuario_niveles_permisos->CurrentAction = "I"; // Display form
			switch ($usuario_niveles_permisos->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "usuario_niveles_permisoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "usuario_niveles_permisoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$usuario_niveles_permisos->RowType = EW_ROWTYPE_VIEW;
		$usuario_niveles_permisos->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuario_niveles_permisos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuario_niveles_permisos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuario_niveles_permisos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuario_niveles_permisos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuario_niveles_permisos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuario_niveles_permisos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuario_niveles_permisos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuario_niveles_permisos;
		$sFilter = $usuario_niveles_permisos->KeyFilter();

		// Call Row Selecting event
		$usuario_niveles_permisos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuario_niveles_permisos->CurrentFilter = $sFilter;
		$sSql = $usuario_niveles_permisos->SQL();
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
		global $conn, $usuario_niveles_permisos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuario_niveles_permisos->Row_Selected($row);
		$usuario_niveles_permisos->id_usuario_nivel_permiso->setDbValue($rs->fields('id_usuario_nivel_permiso'));
		$usuario_niveles_permisos->nombre->setDbValue($rs->fields('nombre'));
		$usuario_niveles_permisos->permiso->setDbValue($rs->fields('permiso'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuario_niveles_permisos;

		// Initialize URLs
		$this->AddUrl = $usuario_niveles_permisos->AddUrl();
		$this->EditUrl = $usuario_niveles_permisos->EditUrl();
		$this->CopyUrl = $usuario_niveles_permisos->CopyUrl();
		$this->DeleteUrl = $usuario_niveles_permisos->DeleteUrl();
		$this->ListUrl = $usuario_niveles_permisos->ListUrl();

		// Call Row_Rendering event
		$usuario_niveles_permisos->Row_Rendering();

		// Common render codes for all row types
		// id_usuario_nivel_permiso
		// nombre
		// permiso

		if ($usuario_niveles_permisos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_usuario_nivel_permiso
			$usuario_niveles_permisos->id_usuario_nivel_permiso->ViewValue = $usuario_niveles_permisos->id_usuario_nivel_permiso->CurrentValue;
			$usuario_niveles_permisos->id_usuario_nivel_permiso->ViewCustomAttributes = "";

			// nombre
			$usuario_niveles_permisos->nombre->ViewValue = $usuario_niveles_permisos->nombre->CurrentValue;
			$usuario_niveles_permisos->nombre->ViewCustomAttributes = "";

			// permiso
			$usuario_niveles_permisos->permiso->ViewValue = $usuario_niveles_permisos->permiso->CurrentValue;
			$usuario_niveles_permisos->permiso->ViewCustomAttributes = "";

			// id_usuario_nivel_permiso
			$usuario_niveles_permisos->id_usuario_nivel_permiso->LinkCustomAttributes = "";
			$usuario_niveles_permisos->id_usuario_nivel_permiso->HrefValue = "";
			$usuario_niveles_permisos->id_usuario_nivel_permiso->TooltipValue = "";

			// nombre
			$usuario_niveles_permisos->nombre->LinkCustomAttributes = "";
			$usuario_niveles_permisos->nombre->HrefValue = "";
			$usuario_niveles_permisos->nombre->TooltipValue = "";

			// permiso
			$usuario_niveles_permisos->permiso->LinkCustomAttributes = "";
			$usuario_niveles_permisos->permiso->HrefValue = "";
			$usuario_niveles_permisos->permiso->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuario_niveles_permisos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuario_niveles_permisos->Row_Rendered();
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
