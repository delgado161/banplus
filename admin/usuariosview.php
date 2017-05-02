<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuarios_view = new cusuarios_view();
$Page =& $usuarios_view;

// Page init
$usuarios_view->Page_Init();

// Page main
$usuarios_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuarios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_view = new ew_Page("usuarios_view");

// page properties
usuarios_view.PageID = "view"; // page ID
usuarios_view.FormID = "fusuariosview"; // form ID
var EW_PAGE_ID = usuarios_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarios_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?>
&nbsp;&nbsp;<?php $usuarios_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($usuarios->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $usuarios_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $usuarios_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $usuarios_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $usuarios_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $usuarios_view->ShowPageHeader(); ?>
<?php
$usuarios_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuarios->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->nombre->FldCaption() ?></td>
		<td<?php echo $usuarios->nombre->CellAttributes() ?>>
<div<?php echo $usuarios->nombre->ViewAttributes() ?>><?php echo $usuarios->nombre->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->apellido->Visible) { // apellido ?>
	<tr id="r_apellido"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->apellido->FldCaption() ?></td>
		<td<?php echo $usuarios->apellido->CellAttributes() ?>>
<div<?php echo $usuarios->apellido->ViewAttributes() ?>><?php echo $usuarios->apellido->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->acceso->Visible) { // acceso ?>
	<tr id="r_acceso"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->acceso->FldCaption() ?></td>
		<td<?php echo $usuarios->acceso->CellAttributes() ?>>
<div<?php echo $usuarios->acceso->ViewAttributes() ?>><?php echo $usuarios->acceso->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->llave->Visible) { // llave ?>
	<tr id="r_llave"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->llave->FldCaption() ?></td>
		<td<?php echo $usuarios->llave->CellAttributes() ?>>
<div<?php echo $usuarios->llave->ViewAttributes() ?>><?php echo $usuarios->llave->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->correo->Visible) { // correo ?>
	<tr id="r_correo"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->correo->FldCaption() ?></td>
		<td<?php echo $usuarios->correo->CellAttributes() ?>>
<div<?php echo $usuarios->correo->ViewAttributes() ?>><?php echo $usuarios->correo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->UserLevelID->Visible) { // UserLevelID ?>
	<tr id="r_UserLevelID"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->UserLevelID->FldCaption() ?></td>
		<td<?php echo $usuarios->UserLevelID->CellAttributes() ?>>
<div<?php echo $usuarios->UserLevelID->ViewAttributes() ?>><?php echo $usuarios->UserLevelID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->estatus->FldCaption() ?></td>
		<td<?php echo $usuarios->estatus->CellAttributes() ?>>
<div<?php echo $usuarios->estatus->ViewAttributes() ?>><?php echo $usuarios->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$usuarios_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuarios->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuarios_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'usuarios';

	// Page object name
	var $PageObjName = 'usuarios_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuarios;
		if ($usuarios->UseTokenInUrl) $PageUrl .= "t=" . $usuarios->TableVar . "&"; // Add page token
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
		global $objForm, $usuarios;
		if ($usuarios->UseTokenInUrl) {
			if ($objForm)
				return ($usuarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuarios_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuarios)
		if (!isset($GLOBALS["usuarios"])) {
			$GLOBALS["usuarios"] = new cusuarios();
			$GLOBALS["Table"] =& $GLOBALS["usuarios"];
		}
		$KeyUrl = "";
		if (@$_GET["id_usuario"] <> "") {
			$this->RecKey["id_usuario"] = $_GET["id_usuario"];
			$KeyUrl .= "&id_usuario=" . urlencode($this->RecKey["id_usuario"]);
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
			define("EW_TABLE_NAME", 'usuarios', TRUE);

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
		global $usuarios;

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
			$this->Page_Terminate("usuarioslist.php");
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
		global $Language, $usuarios;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_usuario"] <> "") {
				$usuarios->id_usuario->setQueryStringValue($_GET["id_usuario"]);
				$this->RecKey["id_usuario"] = $usuarios->id_usuario->QueryStringValue;
			} else {
				$sReturnUrl = "usuarioslist.php"; // Return to list
			}

			// Get action
			$usuarios->CurrentAction = "I"; // Display form
			switch ($usuarios->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "usuarioslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "usuarioslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$usuarios->RowType = EW_ROWTYPE_VIEW;
		$usuarios->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuarios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuarios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuarios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuarios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuarios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuarios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuarios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuarios;
		$sFilter = $usuarios->KeyFilter();

		// Call Row Selecting event
		$usuarios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuarios->CurrentFilter = $sFilter;
		$sSql = $usuarios->SQL();
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
		global $conn, $usuarios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuarios->Row_Selected($row);
		$usuarios->id_usuario->setDbValue($rs->fields('id_usuario'));
		$usuarios->nombre->setDbValue($rs->fields('nombre'));
		$usuarios->apellido->setDbValue($rs->fields('apellido'));
		$usuarios->acceso->setDbValue($rs->fields('acceso'));
		$usuarios->llave->setDbValue($rs->fields('llave'));
		$usuarios->correo->setDbValue($rs->fields('correo'));
		$usuarios->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$usuarios->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuarios;

		// Initialize URLs
		$this->AddUrl = $usuarios->AddUrl();
		$this->EditUrl = $usuarios->EditUrl();
		$this->CopyUrl = $usuarios->CopyUrl();
		$this->DeleteUrl = $usuarios->DeleteUrl();
		$this->ListUrl = $usuarios->ListUrl();

		// Call Row_Rendering event
		$usuarios->Row_Rendering();

		// Common render codes for all row types
		// id_usuario
		// nombre
		// apellido
		// acceso
		// llave
		// correo
		// UserLevelID
		// estatus

		if ($usuarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$usuarios->nombre->ViewValue = $usuarios->nombre->CurrentValue;
			$usuarios->nombre->ViewCustomAttributes = "";

			// apellido
			$usuarios->apellido->ViewValue = $usuarios->apellido->CurrentValue;
			$usuarios->apellido->ViewCustomAttributes = "";

			// acceso
			$usuarios->acceso->ViewValue = $usuarios->acceso->CurrentValue;
			$usuarios->acceso->ViewCustomAttributes = "";

			// llave
			$usuarios->llave->ViewValue = "********";
			$usuarios->llave->ViewCustomAttributes = "";

			// correo
			$usuarios->correo->ViewValue = $usuarios->correo->CurrentValue;
			$usuarios->correo->ViewCustomAttributes = "";

			// UserLevelID
			if ($Security->CanAdmin()) { // System admin
			if (strval($usuarios->UserLevelID->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($usuarios->UserLevelID->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `usuarioniveles`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$usuarios->UserLevelID->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$usuarios->UserLevelID->ViewValue = $usuarios->UserLevelID->CurrentValue;
				}
			} else {
				$usuarios->UserLevelID->ViewValue = NULL;
			}
			} else {
				$usuarios->UserLevelID->ViewValue = "********";
			}
			$usuarios->UserLevelID->ViewCustomAttributes = "";

			// estatus
			if (strval($usuarios->estatus->CurrentValue) <> "") {
				switch ($usuarios->estatus->CurrentValue) {
					case "1":
						$usuarios->estatus->ViewValue = $usuarios->estatus->FldTagCaption(1) <> "" ? $usuarios->estatus->FldTagCaption(1) : $usuarios->estatus->CurrentValue;
						break;
					case "0":
						$usuarios->estatus->ViewValue = $usuarios->estatus->FldTagCaption(2) <> "" ? $usuarios->estatus->FldTagCaption(2) : $usuarios->estatus->CurrentValue;
						break;
					default:
						$usuarios->estatus->ViewValue = $usuarios->estatus->CurrentValue;
				}
			} else {
				$usuarios->estatus->ViewValue = NULL;
			}
			$usuarios->estatus->ViewCustomAttributes = "";

			// nombre
			$usuarios->nombre->LinkCustomAttributes = "";
			$usuarios->nombre->HrefValue = "";
			$usuarios->nombre->TooltipValue = "";

			// apellido
			$usuarios->apellido->LinkCustomAttributes = "";
			$usuarios->apellido->HrefValue = "";
			$usuarios->apellido->TooltipValue = "";

			// acceso
			$usuarios->acceso->LinkCustomAttributes = "";
			$usuarios->acceso->HrefValue = "";
			$usuarios->acceso->TooltipValue = "";

			// llave
			$usuarios->llave->LinkCustomAttributes = "";
			$usuarios->llave->HrefValue = "";
			$usuarios->llave->TooltipValue = "";

			// correo
			$usuarios->correo->LinkCustomAttributes = "";
			$usuarios->correo->HrefValue = "";
			$usuarios->correo->TooltipValue = "";

			// UserLevelID
			$usuarios->UserLevelID->LinkCustomAttributes = "";
			$usuarios->UserLevelID->HrefValue = "";
			$usuarios->UserLevelID->TooltipValue = "";

			// estatus
			$usuarios->estatus->LinkCustomAttributes = "";
			$usuarios->estatus->HrefValue = "";
			$usuarios->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuarios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuarios->Row_Rendered();
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
