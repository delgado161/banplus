<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documentos_seccionesinfo.php" ?>
<?php include_once "documentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documentos_secciones_view = new cdocumentos_secciones_view();
$Page =& $documentos_secciones_view;

// Page init
$documentos_secciones_view->Page_Init();

// Page main
$documentos_secciones_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($documentos_secciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_secciones_view = new ew_Page("documentos_secciones_view");

// page properties
documentos_secciones_view.PageID = "view"; // page ID
documentos_secciones_view.FormID = "fdocumentos_seccionesview"; // form ID
var EW_PAGE_ID = documentos_secciones_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
documentos_secciones_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_secciones_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_secciones_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos_secciones->TableCaption() ?>
&nbsp;&nbsp;<?php $documentos_secciones_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($documentos_secciones->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $documentos_secciones_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $documentos_secciones_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $documentos_secciones_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $documentos_secciones_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $documentos_secciones_view->ShowPageHeader(); ?>
<?php
$documentos_secciones_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($documentos_secciones->id_documentos->Visible) { // id_documentos ?>
	<tr id="r_id_documentos"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->id_documentos->FldCaption() ?></td>
		<td<?php echo $documentos_secciones->id_documentos->CellAttributes() ?>>
<div<?php echo $documentos_secciones->id_documentos->ViewAttributes() ?>><?php echo $documentos_secciones->id_documentos->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->id_grupo_sec->Visible) { // id_grupo_sec ?>
	<tr id="r_id_grupo_sec"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->id_grupo_sec->FldCaption() ?></td>
		<td<?php echo $documentos_secciones->id_grupo_sec->CellAttributes() ?>>
<div<?php echo $documentos_secciones->id_grupo_sec->ViewAttributes() ?>><?php echo $documentos_secciones->id_grupo_sec->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->fecha_inicio->Visible) { // fecha_inicio ?>
	<tr id="r_fecha_inicio"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->fecha_inicio->FldCaption() ?></td>
		<td<?php echo $documentos_secciones->fecha_inicio->CellAttributes() ?>>
<div<?php echo $documentos_secciones->fecha_inicio->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_inicio->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->fecha_fin->Visible) { // fecha_fin ?>
	<tr id="r_fecha_fin"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->fecha_fin->FldCaption() ?></td>
		<td<?php echo $documentos_secciones->fecha_fin->CellAttributes() ?>>
<div<?php echo $documentos_secciones->fecha_fin->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_fin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->fecha->FldCaption() ?></td>
		<td<?php echo $documentos_secciones->fecha->CellAttributes() ?>>
<div<?php echo $documentos_secciones->fecha->ViewAttributes() ?>><?php echo $documentos_secciones->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->estatus->FldCaption() ?></td>
		<td<?php echo $documentos_secciones->estatus->CellAttributes() ?>>
<div<?php echo $documentos_secciones->estatus->ViewAttributes() ?>><?php echo $documentos_secciones->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$documentos_secciones_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($documentos_secciones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$documentos_secciones_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumentos_secciones_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'documentos_secciones';

	// Page object name
	var $PageObjName = 'documentos_secciones_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) $PageUrl .= "t=" . $documentos_secciones->TableVar . "&"; // Add page token
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
		global $objForm, $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) {
			if ($objForm)
				return ($documentos_secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documentos_secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumentos_secciones_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documentos_secciones)
		if (!isset($GLOBALS["documentos_secciones"])) {
			$GLOBALS["documentos_secciones"] = new cdocumentos_secciones();
			$GLOBALS["Table"] =& $GLOBALS["documentos_secciones"];
		}
		$KeyUrl = "";
		if (@$_GET["id_documentos_secciones"] <> "") {
			$this->RecKey["id_documentos_secciones"] = $_GET["id_documentos_secciones"];
			$KeyUrl .= "&id_documentos_secciones=" . urlencode($this->RecKey["id_documentos_secciones"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (documentos)
		if (!isset($GLOBALS['documentos'])) $GLOBALS['documentos'] = new cdocumentos();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documentos_secciones', TRUE);

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
		global $documentos_secciones;

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
			$this->Page_Terminate("documentos_seccioneslist.php");
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
		global $Language, $documentos_secciones;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_documentos_secciones"] <> "") {
				$documentos_secciones->id_documentos_secciones->setQueryStringValue($_GET["id_documentos_secciones"]);
				$this->RecKey["id_documentos_secciones"] = $documentos_secciones->id_documentos_secciones->QueryStringValue;
			} else {
				$sReturnUrl = "documentos_seccioneslist.php"; // Return to list
			}

			// Get action
			$documentos_secciones->CurrentAction = "I"; // Display form
			switch ($documentos_secciones->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "documentos_seccioneslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "documentos_seccioneslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$documentos_secciones->RowType = EW_ROWTYPE_VIEW;
		$documentos_secciones->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $documentos_secciones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$documentos_secciones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$documentos_secciones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $documentos_secciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documentos_secciones;
		$sFilter = $documentos_secciones->KeyFilter();

		// Call Row Selecting event
		$documentos_secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documentos_secciones->CurrentFilter = $sFilter;
		$sSql = $documentos_secciones->SQL();
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
		global $conn, $documentos_secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documentos_secciones->Row_Selected($row);
		$documentos_secciones->id_documentos_secciones->setDbValue($rs->fields('id_documentos_secciones'));
		$documentos_secciones->id_documentos->setDbValue($rs->fields('id_documentos'));
		$documentos_secciones->id_grupo_sec->setDbValue($rs->fields('id_grupo_sec'));
		$documentos_secciones->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$documentos_secciones->fecha_fin->setDbValue($rs->fields('fecha_fin'));
		$documentos_secciones->fecha->setDbValue($rs->fields('fecha'));
		$documentos_secciones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documentos_secciones;

		// Initialize URLs
		$this->AddUrl = $documentos_secciones->AddUrl();
		$this->EditUrl = $documentos_secciones->EditUrl();
		$this->CopyUrl = $documentos_secciones->CopyUrl();
		$this->DeleteUrl = $documentos_secciones->DeleteUrl();
		$this->ListUrl = $documentos_secciones->ListUrl();

		// Call Row_Rendering event
		$documentos_secciones->Row_Rendering();

		// Common render codes for all row types
		// id_documentos_secciones
		// id_documentos
		// id_grupo_sec
		// fecha_inicio
		// fecha_fin
		// fecha
		// estatus

		if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_documentos
			if (strval($documentos_secciones->id_documentos->CurrentValue) <> "") {
				$sFilterWrk = "`id_documentos` = " . ew_AdjustSql($documentos_secciones->id_documentos->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `documentos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_documentos->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_documentos->ViewValue = $documentos_secciones->id_documentos->CurrentValue;
				}
			} else {
				$documentos_secciones->id_documentos->ViewValue = NULL;
			}
			$documentos_secciones->id_documentos->ViewCustomAttributes = "";

			// id_grupo_sec
			if (strval($documentos_secciones->id_grupo_sec->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($documentos_secciones->id_grupo_sec->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view1`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_grupo_sec->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_grupo_sec->ViewValue = $documentos_secciones->id_grupo_sec->CurrentValue;
				}
			} else {
				$documentos_secciones->id_grupo_sec->ViewValue = NULL;
			}
			$documentos_secciones->id_grupo_sec->ViewCustomAttributes = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->ViewValue = $documentos_secciones->fecha_inicio->CurrentValue;
			$documentos_secciones->fecha_inicio->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_inicio->ViewValue, 7);
			$documentos_secciones->fecha_inicio->ViewCustomAttributes = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->ViewValue = $documentos_secciones->fecha_fin->CurrentValue;
			$documentos_secciones->fecha_fin->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_fin->ViewValue, 7);
			$documentos_secciones->fecha_fin->ViewCustomAttributes = "";

			// fecha
			$documentos_secciones->fecha->ViewValue = $documentos_secciones->fecha->CurrentValue;
			$documentos_secciones->fecha->ViewValue = ew_FormatDateTime($documentos_secciones->fecha->ViewValue, 7);
			$documentos_secciones->fecha->ViewCustomAttributes = "";

			// estatus
			if (strval($documentos_secciones->estatus->CurrentValue) <> "") {
				switch ($documentos_secciones->estatus->CurrentValue) {
					case "1":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(1) <> "" ? $documentos_secciones->estatus->FldTagCaption(1) : $documentos_secciones->estatus->CurrentValue;
						break;
					case "0":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(2) <> "" ? $documentos_secciones->estatus->FldTagCaption(2) : $documentos_secciones->estatus->CurrentValue;
						break;
					default:
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->CurrentValue;
				}
			} else {
				$documentos_secciones->estatus->ViewValue = NULL;
			}
			$documentos_secciones->estatus->ViewCustomAttributes = "";

			// id_documentos
			$documentos_secciones->id_documentos->LinkCustomAttributes = "";
			$documentos_secciones->id_documentos->HrefValue = "";
			$documentos_secciones->id_documentos->TooltipValue = "";

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->LinkCustomAttributes = "";
			$documentos_secciones->id_grupo_sec->HrefValue = "";
			$documentos_secciones->id_grupo_sec->TooltipValue = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->LinkCustomAttributes = "";
			$documentos_secciones->fecha_inicio->HrefValue = "";
			$documentos_secciones->fecha_inicio->TooltipValue = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->LinkCustomAttributes = "";
			$documentos_secciones->fecha_fin->HrefValue = "";
			$documentos_secciones->fecha_fin->TooltipValue = "";

			// fecha
			$documentos_secciones->fecha->LinkCustomAttributes = "";
			$documentos_secciones->fecha->HrefValue = "";
			$documentos_secciones->fecha->TooltipValue = "";

			// estatus
			$documentos_secciones->estatus->LinkCustomAttributes = "";
			$documentos_secciones->estatus->HrefValue = "";
			$documentos_secciones->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($documentos_secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documentos_secciones->Row_Rendered();
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
