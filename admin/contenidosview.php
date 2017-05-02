<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "contenidosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$contenidos_view = new ccontenidos_view();
$Page =& $contenidos_view;

// Page init
$contenidos_view->Page_Init();

// Page main
$contenidos_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($contenidos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var contenidos_view = new ew_Page("contenidos_view");

// page properties
contenidos_view.PageID = "view"; // page ID
contenidos_view.FormID = "fcontenidosview"; // form ID
var EW_PAGE_ID = contenidos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
contenidos_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contenidos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contenidos_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $contenidos->TableCaption() ?>
&nbsp;&nbsp;<?php $contenidos_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($contenidos->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $contenidos_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $contenidos_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $contenidos_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $contenidos_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('grupo_secciones')) { ?>
<a href="grupo_seccioneslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=contenidos&id_contenido=<?php echo urlencode(strval($contenidos->id_contenido->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("grupo_secciones", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $contenidos_view->ShowPageHeader(); ?>
<?php
$contenidos_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($contenidos->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->titulo->FldCaption() ?></td>
		<td<?php echo $contenidos->titulo->CellAttributes() ?>>
<div<?php echo $contenidos->titulo->ViewAttributes() ?>><?php echo $contenidos->titulo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contenidos->contenido->Visible) { // contenido ?>
	<tr id="r_contenido"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->contenido->FldCaption() ?></td>
		<td<?php echo $contenidos->contenido->CellAttributes() ?>>
<div<?php echo $contenidos->contenido->ViewAttributes() ?>><?php echo $contenidos->contenido->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contenidos->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->imagen->FldCaption() ?></td>
		<td<?php echo $contenidos->imagen->CellAttributes() ?>>
<?php if ($contenidos->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($contenidos->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $contenidos->imagen->UploadPath) . $contenidos->imagen->Upload->DbValue ?>" border=0<?php echo $contenidos->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($contenidos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($contenidos->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $contenidos->imagen->UploadPath) . $contenidos->imagen->Upload->DbValue ?>" border=0<?php echo $contenidos->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($contenidos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($contenidos->id_herramienta_financiera->Visible) { // id_herramienta_financiera ?>
	<tr id="r_id_herramienta_financiera"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->id_herramienta_financiera->FldCaption() ?></td>
		<td<?php echo $contenidos->id_herramienta_financiera->CellAttributes() ?>>
<div<?php echo $contenidos->id_herramienta_financiera->ViewAttributes() ?>><?php echo $contenidos->id_herramienta_financiera->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contenidos->edicion->Visible) { // edicion ?>
	<tr id="r_edicion"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->edicion->FldCaption() ?></td>
		<td<?php echo $contenidos->edicion->CellAttributes() ?>>
<div<?php echo $contenidos->edicion->ViewAttributes() ?>><?php echo $contenidos->edicion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contenidos->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->estatus->FldCaption() ?></td>
		<td<?php echo $contenidos->estatus->CellAttributes() ?>>
<div<?php echo $contenidos->estatus->ViewAttributes() ?>><?php echo $contenidos->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$contenidos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($contenidos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contenidos_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccontenidos_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'contenidos';

	// Page object name
	var $PageObjName = 'contenidos_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $contenidos;
		if ($contenidos->UseTokenInUrl) $PageUrl .= "t=" . $contenidos->TableVar . "&"; // Add page token
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
		global $objForm, $contenidos;
		if ($contenidos->UseTokenInUrl) {
			if ($objForm)
				return ($contenidos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($contenidos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccontenidos_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (contenidos)
		if (!isset($GLOBALS["contenidos"])) {
			$GLOBALS["contenidos"] = new ccontenidos();
			$GLOBALS["Table"] =& $GLOBALS["contenidos"];
		}
		$KeyUrl = "";
		if (@$_GET["id_contenido"] <> "") {
			$this->RecKey["id_contenido"] = $_GET["id_contenido"];
			$KeyUrl .= "&id_contenido=" . urlencode($this->RecKey["id_contenido"]);
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
			define("EW_TABLE_NAME", 'contenidos', TRUE);

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
		global $contenidos;

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
			$this->Page_Terminate("contenidoslist.php");
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
		global $Language, $contenidos;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_contenido"] <> "") {
				$contenidos->id_contenido->setQueryStringValue($_GET["id_contenido"]);
				$this->RecKey["id_contenido"] = $contenidos->id_contenido->QueryStringValue;
			} else {
				$sReturnUrl = "contenidoslist.php"; // Return to list
			}

			// Get action
			$contenidos->CurrentAction = "I"; // Display form
			switch ($contenidos->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "contenidoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "contenidoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$contenidos->RowType = EW_ROWTYPE_VIEW;
		$contenidos->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $contenidos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$contenidos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$contenidos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $contenidos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$contenidos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$contenidos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$contenidos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $contenidos;
		$sFilter = $contenidos->KeyFilter();

		// Call Row Selecting event
		$contenidos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$contenidos->CurrentFilter = $sFilter;
		$sSql = $contenidos->SQL();
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
		global $conn, $contenidos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$contenidos->Row_Selected($row);
		$contenidos->id_contenido->setDbValue($rs->fields('id_contenido'));
		$contenidos->titulo->setDbValue($rs->fields('titulo'));
		$contenidos->resumen->setDbValue($rs->fields('resumen'));
		$contenidos->contenido->setDbValue($rs->fields('contenido'));
		$contenidos->imagen->Upload->DbValue = $rs->fields('imagen');
		$contenidos->id_herramienta_financiera->setDbValue($rs->fields('id_herramienta_financiera'));
		$contenidos->edicion->setDbValue($rs->fields('edicion'));
		$contenidos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $contenidos;

		// Initialize URLs
		$this->AddUrl = $contenidos->AddUrl();
		$this->EditUrl = $contenidos->EditUrl();
		$this->CopyUrl = $contenidos->CopyUrl();
		$this->DeleteUrl = $contenidos->DeleteUrl();
		$this->ListUrl = $contenidos->ListUrl();

		// Call Row_Rendering event
		$contenidos->Row_Rendering();

		// Common render codes for all row types
		// id_contenido
		// titulo
		// resumen
		// contenido
		// imagen
		// id_herramienta_financiera
		// edicion
		// estatus

		if ($contenidos->RowType == EW_ROWTYPE_VIEW) { // View row

			// titulo
			$contenidos->titulo->ViewValue = $contenidos->titulo->CurrentValue;
			$contenidos->titulo->ViewCustomAttributes = "";

			// contenido
			$contenidos->contenido->ViewValue = $contenidos->contenido->CurrentValue;
			$contenidos->contenido->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($contenidos->imagen->Upload->DbValue)) {
				$contenidos->imagen->ViewValue = $contenidos->imagen->Upload->DbValue;
				$contenidos->imagen->ImageWidth = 200;
				$contenidos->imagen->ImageHeight = 50;
				$contenidos->imagen->ImageAlt = $contenidos->imagen->FldAlt();
			} else {
				$contenidos->imagen->ViewValue = "";
			}
			$contenidos->imagen->ViewCustomAttributes = "";

			// id_herramienta_financiera
			if (strval($contenidos->id_herramienta_financiera->CurrentValue) <> "") {
				$sFilterWrk = "`id_modulo_financiero` = " . ew_AdjustSql($contenidos->id_herramienta_financiera->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `modulos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$contenidos->id_herramienta_financiera->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$contenidos->id_herramienta_financiera->ViewValue = $contenidos->id_herramienta_financiera->CurrentValue;
				}
			} else {
				$contenidos->id_herramienta_financiera->ViewValue = NULL;
			}
			$contenidos->id_herramienta_financiera->ViewCustomAttributes = "";

			// edicion
			if (strval($contenidos->edicion->CurrentValue) <> "") {
				switch ($contenidos->edicion->CurrentValue) {
					case "1":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : $contenidos->edicion->CurrentValue;
						break;
					case "3":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : $contenidos->edicion->CurrentValue;
						break;
					case "2":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : $contenidos->edicion->CurrentValue;
						break;
					default:
						$contenidos->edicion->ViewValue = $contenidos->edicion->CurrentValue;
				}
			} else {
				$contenidos->edicion->ViewValue = NULL;
			}
			$contenidos->edicion->ViewCustomAttributes = "";

			// estatus
			if (strval($contenidos->estatus->CurrentValue) <> "") {
				switch ($contenidos->estatus->CurrentValue) {
					case "1":
						$contenidos->estatus->ViewValue = $contenidos->estatus->FldTagCaption(1) <> "" ? $contenidos->estatus->FldTagCaption(1) : $contenidos->estatus->CurrentValue;
						break;
					case "0":
						$contenidos->estatus->ViewValue = $contenidos->estatus->FldTagCaption(2) <> "" ? $contenidos->estatus->FldTagCaption(2) : $contenidos->estatus->CurrentValue;
						break;
					default:
						$contenidos->estatus->ViewValue = $contenidos->estatus->CurrentValue;
				}
			} else {
				$contenidos->estatus->ViewValue = NULL;
			}
			$contenidos->estatus->ViewCustomAttributes = "";

			// titulo
			$contenidos->titulo->LinkCustomAttributes = "";
			$contenidos->titulo->HrefValue = "";
			$contenidos->titulo->TooltipValue = "";

			// contenido
			$contenidos->contenido->LinkCustomAttributes = "";
			$contenidos->contenido->HrefValue = "";
			$contenidos->contenido->TooltipValue = "";

			// imagen
			$contenidos->imagen->LinkCustomAttributes = "";
			$contenidos->imagen->HrefValue = "";
			$contenidos->imagen->TooltipValue = "";

			// id_herramienta_financiera
			$contenidos->id_herramienta_financiera->LinkCustomAttributes = "";
			$contenidos->id_herramienta_financiera->HrefValue = "";
			$contenidos->id_herramienta_financiera->TooltipValue = "";

			// edicion
			$contenidos->edicion->LinkCustomAttributes = "";
			$contenidos->edicion->HrefValue = "";
			$contenidos->edicion->TooltipValue = "";

			// estatus
			$contenidos->estatus->LinkCustomAttributes = "";
			$contenidos->estatus->HrefValue = "";
			$contenidos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($contenidos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$contenidos->Row_Rendered();
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
