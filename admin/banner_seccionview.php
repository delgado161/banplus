<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "banner_seccioninfo.php" ?>
<?php include_once "bannerinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$banner_seccion_view = new cbanner_seccion_view();
$Page =& $banner_seccion_view;

// Page init
$banner_seccion_view->Page_Init();

// Page main
$banner_seccion_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($banner_seccion->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var banner_seccion_view = new ew_Page("banner_seccion_view");

// page properties
banner_seccion_view.PageID = "view"; // page ID
banner_seccion_view.FormID = "fbanner_seccionview"; // form ID
var EW_PAGE_ID = banner_seccion_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
banner_seccion_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
banner_seccion_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banner_seccion_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banner_seccion->TableCaption() ?>
&nbsp;&nbsp;<?php $banner_seccion_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($banner_seccion->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $banner_seccion_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $banner_seccion_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $banner_seccion_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $banner_seccion_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $banner_seccion_view->ShowPageHeader(); ?>
<?php
$banner_seccion_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($banner_seccion->id_banner->Visible) { // id_banner ?>
	<tr id="r_id_banner"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->id_banner->FldCaption() ?></td>
		<td<?php echo $banner_seccion->id_banner->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->id_grupo_secciones->Visible) { // id_grupo_secciones ?>
	<tr id="r_id_grupo_secciones"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->id_grupo_secciones->FldCaption() ?></td>
		<td<?php echo $banner_seccion->id_grupo_secciones->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_grupo_secciones->ViewAttributes() ?>><?php echo $banner_seccion->id_grupo_secciones->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->fecha_inicio->Visible) { // fecha_inicio ?>
	<tr id="r_fecha_inicio"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->fecha_inicio->FldCaption() ?></td>
		<td<?php echo $banner_seccion->fecha_inicio->CellAttributes() ?>>
<div<?php echo $banner_seccion->fecha_inicio->ViewAttributes() ?>><?php echo $banner_seccion->fecha_inicio->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->fecha_fin->Visible) { // fecha_fin ?>
	<tr id="r_fecha_fin"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->fecha_fin->FldCaption() ?></td>
		<td<?php echo $banner_seccion->fecha_fin->CellAttributes() ?>>
<div<?php echo $banner_seccion->fecha_fin->ViewAttributes() ?>><?php echo $banner_seccion->fecha_fin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->link->Visible) { // link ?>
	<tr id="r_link"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->link->FldCaption() ?></td>
		<td<?php echo $banner_seccion->link->CellAttributes() ?>>
<div<?php echo $banner_seccion->link->ViewAttributes() ?>><?php echo $banner_seccion->link->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->externo->Visible) { // externo ?>
	<tr id="r_externo"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->externo->FldCaption() ?></td>
		<td<?php echo $banner_seccion->externo->CellAttributes() ?>>
<div<?php echo $banner_seccion->externo->ViewAttributes() ?>><?php echo $banner_seccion->externo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->id_posicion->Visible) { // id_posicion ?>
	<tr id="r_id_posicion"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->id_posicion->FldCaption() ?></td>
		<td<?php echo $banner_seccion->id_posicion->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_posicion->ViewAttributes() ?>><?php echo $banner_seccion->id_posicion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->orden->FldCaption() ?></td>
		<td<?php echo $banner_seccion->orden->CellAttributes() ?>>
<div<?php echo $banner_seccion->orden->ViewAttributes() ?>><?php echo $banner_seccion->orden->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$banner_seccion_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($banner_seccion->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$banner_seccion_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanner_seccion_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'banner_seccion';

	// Page object name
	var $PageObjName = 'banner_seccion_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banner_seccion;
		if ($banner_seccion->UseTokenInUrl) $PageUrl .= "t=" . $banner_seccion->TableVar . "&"; // Add page token
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
		global $objForm, $banner_seccion;
		if ($banner_seccion->UseTokenInUrl) {
			if ($objForm)
				return ($banner_seccion->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banner_seccion->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanner_seccion_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (banner_seccion)
		if (!isset($GLOBALS["banner_seccion"])) {
			$GLOBALS["banner_seccion"] = new cbanner_seccion();
			$GLOBALS["Table"] =& $GLOBALS["banner_seccion"];
		}
		$KeyUrl = "";
		if (@$_GET["id_banner_seccion"] <> "") {
			$this->RecKey["id_banner_seccion"] = $_GET["id_banner_seccion"];
			$KeyUrl .= "&id_banner_seccion=" . urlencode($this->RecKey["id_banner_seccion"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (banner)
		if (!isset($GLOBALS['banner'])) $GLOBALS['banner'] = new cbanner();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banner_seccion', TRUE);

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
		global $banner_seccion;

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
			$this->Page_Terminate("banner_seccionlist.php");
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
		global $Language, $banner_seccion;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_banner_seccion"] <> "") {
				$banner_seccion->id_banner_seccion->setQueryStringValue($_GET["id_banner_seccion"]);
				$this->RecKey["id_banner_seccion"] = $banner_seccion->id_banner_seccion->QueryStringValue;
			} else {
				$sReturnUrl = "banner_seccionlist.php"; // Return to list
			}

			// Get action
			$banner_seccion->CurrentAction = "I"; // Display form
			switch ($banner_seccion->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "banner_seccionlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "banner_seccionlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$banner_seccion->RowType = EW_ROWTYPE_VIEW;
		$banner_seccion->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $banner_seccion;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$banner_seccion->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$banner_seccion->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $banner_seccion->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$banner_seccion->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$banner_seccion->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$banner_seccion->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banner_seccion;
		$sFilter = $banner_seccion->KeyFilter();

		// Call Row Selecting event
		$banner_seccion->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banner_seccion->CurrentFilter = $sFilter;
		$sSql = $banner_seccion->SQL();
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
		global $conn, $banner_seccion;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$banner_seccion->Row_Selected($row);
		$banner_seccion->id_banner_seccion->setDbValue($rs->fields('id_banner_seccion'));
		$banner_seccion->id_banner->setDbValue($rs->fields('id_banner'));
		$banner_seccion->id_grupo_secciones->setDbValue($rs->fields('id_grupo_secciones'));
		$banner_seccion->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$banner_seccion->fecha_fin->setDbValue($rs->fields('fecha_fin'));
		$banner_seccion->link->setDbValue($rs->fields('link'));
		$banner_seccion->externo->setDbValue($rs->fields('externo'));
		$banner_seccion->id_posicion->setDbValue($rs->fields('id_posicion'));
		$banner_seccion->orden->setDbValue($rs->fields('orden'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banner_seccion;

		// Initialize URLs
		$this->AddUrl = $banner_seccion->AddUrl();
		$this->EditUrl = $banner_seccion->EditUrl();
		$this->CopyUrl = $banner_seccion->CopyUrl();
		$this->DeleteUrl = $banner_seccion->DeleteUrl();
		$this->ListUrl = $banner_seccion->ListUrl();

		// Call Row_Rendering event
		$banner_seccion->Row_Rendering();

		// Common render codes for all row types
		// id_banner_seccion
		// id_banner
		// id_grupo_secciones
		// fecha_inicio
		// fecha_fin
		// link
		// externo
		// id_posicion
		// orden

		if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_banner
			if (strval($banner_seccion->id_banner->CurrentValue) <> "") {
				$sFilterWrk = "`id_banner` = " . ew_AdjustSql($banner_seccion->id_banner->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `banner`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_banner->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$banner_seccion->id_banner->ViewValue = $banner_seccion->id_banner->CurrentValue;
				}
			} else {
				$banner_seccion->id_banner->ViewValue = NULL;
			}
			$banner_seccion->id_banner->ViewCustomAttributes = "";

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->ViewValue = $banner_seccion->id_grupo_secciones->CurrentValue;
			$banner_seccion->id_grupo_secciones->ViewCustomAttributes = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->ViewValue = $banner_seccion->fecha_inicio->CurrentValue;
			$banner_seccion->fecha_inicio->ViewValue = ew_FormatDateTime($banner_seccion->fecha_inicio->ViewValue, 7);
			$banner_seccion->fecha_inicio->ViewCustomAttributes = "";

			// fecha_fin
			$banner_seccion->fecha_fin->ViewValue = $banner_seccion->fecha_fin->CurrentValue;
			$banner_seccion->fecha_fin->ViewValue = ew_FormatDateTime($banner_seccion->fecha_fin->ViewValue, 7);
			$banner_seccion->fecha_fin->ViewCustomAttributes = "";

			// link
			$banner_seccion->link->ViewValue = $banner_seccion->link->CurrentValue;
			$banner_seccion->link->ViewCustomAttributes = "";

			// externo
			if (strval($banner_seccion->externo->CurrentValue) <> "") {
				$banner_seccion->externo->ViewValue = "";
				$arwrk = explode(",", strval($banner_seccion->externo->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++) {
					switch (trim($arwrk[$ari])) {
						case "1":
							$banner_seccion->externo->ViewValue .= $banner_seccion->externo->FldTagCaption(1) <> "" ? $banner_seccion->externo->FldTagCaption(1) : trim($arwrk[$ari]);
							break;
						default:
							$banner_seccion->externo->ViewValue .= trim($arwrk[$ari]);
					}
					if ($ari < $cnt-1) $banner_seccion->externo->ViewValue .= ew_ViewOptionSeparator($ari);
				}
			} else {
				$banner_seccion->externo->ViewValue = NULL;
			}
			$banner_seccion->externo->ViewCustomAttributes = "";

			// id_posicion
			if (strval($banner_seccion->id_posicion->CurrentValue) <> "") {
				$sFilterWrk = "`id_posicion` = " . ew_AdjustSql($banner_seccion->id_posicion->CurrentValue) . "";
			$sSqlWrk = "SELECT `posicion` FROM `banner_posicion`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `posicion`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_posicion->ViewValue = $rswrk->fields('posicion');
					$rswrk->Close();
				} else {
					$banner_seccion->id_posicion->ViewValue = $banner_seccion->id_posicion->CurrentValue;
				}
			} else {
				$banner_seccion->id_posicion->ViewValue = NULL;
			}
			$banner_seccion->id_posicion->ViewCustomAttributes = "";

			// orden
			$banner_seccion->orden->ViewValue = $banner_seccion->orden->CurrentValue;
			$banner_seccion->orden->ViewCustomAttributes = "";

			// id_banner
			$banner_seccion->id_banner->LinkCustomAttributes = "";
			$banner_seccion->id_banner->HrefValue = "";
			$banner_seccion->id_banner->TooltipValue = "";

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->LinkCustomAttributes = "";
			$banner_seccion->id_grupo_secciones->HrefValue = "";
			$banner_seccion->id_grupo_secciones->TooltipValue = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->LinkCustomAttributes = "";
			$banner_seccion->fecha_inicio->HrefValue = "";
			$banner_seccion->fecha_inicio->TooltipValue = "";

			// fecha_fin
			$banner_seccion->fecha_fin->LinkCustomAttributes = "";
			$banner_seccion->fecha_fin->HrefValue = "";
			$banner_seccion->fecha_fin->TooltipValue = "";

			// link
			$banner_seccion->link->LinkCustomAttributes = "";
			$banner_seccion->link->HrefValue = "";
			$banner_seccion->link->TooltipValue = "";

			// externo
			$banner_seccion->externo->LinkCustomAttributes = "";
			$banner_seccion->externo->HrefValue = "";
			$banner_seccion->externo->TooltipValue = "";

			// id_posicion
			$banner_seccion->id_posicion->LinkCustomAttributes = "";
			$banner_seccion->id_posicion->HrefValue = "";
			$banner_seccion->id_posicion->TooltipValue = "";

			// orden
			$banner_seccion->orden->LinkCustomAttributes = "";
			$banner_seccion->orden->HrefValue = "";
			$banner_seccion->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($banner_seccion->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banner_seccion->Row_Rendered();
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
