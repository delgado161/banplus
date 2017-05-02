<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "noticiasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$noticias_view = new cnoticias_view();
$Page =& $noticias_view;

// Page init
$noticias_view->Page_Init();

// Page main
$noticias_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($noticias->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var noticias_view = new ew_Page("noticias_view");

// page properties
noticias_view.PageID = "view"; // page ID
noticias_view.FormID = "fnoticiasview"; // form ID
var EW_PAGE_ID = noticias_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
noticias_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
noticias_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
noticias_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $noticias->TableCaption() ?>
&nbsp;&nbsp;<?php $noticias_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($noticias->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $noticias_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $noticias_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $noticias_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $noticias_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $noticias_view->ShowPageHeader(); ?>
<?php
$noticias_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($noticias->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->tipo->FldCaption() ?></td>
		<td<?php echo $noticias->tipo->CellAttributes() ?>>
<div<?php echo $noticias->tipo->ViewAttributes() ?>><?php echo $noticias->tipo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($noticias->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->titulo->FldCaption() ?></td>
		<td<?php echo $noticias->titulo->CellAttributes() ?>>
<div<?php echo $noticias->titulo->ViewAttributes() ?>><?php echo $noticias->titulo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($noticias->antetitulo->Visible) { // antetitulo ?>
	<tr id="r_antetitulo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->antetitulo->FldCaption() ?></td>
		<td<?php echo $noticias->antetitulo->CellAttributes() ?>>
<div<?php echo $noticias->antetitulo->ViewAttributes() ?>><?php echo $noticias->antetitulo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($noticias->sumario->Visible) { // sumario ?>
	<tr id="r_sumario"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->sumario->FldCaption() ?></td>
		<td<?php echo $noticias->sumario->CellAttributes() ?>>
<div<?php echo $noticias->sumario->ViewAttributes() ?>><?php echo $noticias->sumario->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($noticias->contenido->Visible) { // contenido ?>
	<tr id="r_contenido"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->contenido->FldCaption() ?></td>
		<td<?php echo $noticias->contenido->CellAttributes() ?>>
<div<?php echo $noticias->contenido->ViewAttributes() ?>><?php echo $noticias->contenido->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($noticias->id_grupo->Visible) { // id_grupo ?>
	<tr id="r_id_grupo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->id_grupo->FldCaption() ?></td>
		<td<?php echo $noticias->id_grupo->CellAttributes() ?>>
<div<?php echo $noticias->id_grupo->ViewAttributes() ?>><?php echo $noticias->id_grupo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($noticias->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->imagen->FldCaption() ?></td>
		<td<?php echo $noticias->imagen->CellAttributes() ?>>
<?php if ($noticias->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($noticias->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $noticias->imagen->UploadPath) . $noticias->imagen->Upload->DbValue ?>" border=0<?php echo $noticias->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($noticias->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($noticias->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $noticias->imagen->UploadPath) . $noticias->imagen->Upload->DbValue ?>" border=0<?php echo $noticias->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($noticias->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($noticias->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->fecha->FldCaption() ?></td>
		<td<?php echo $noticias->fecha->CellAttributes() ?>>
<div<?php echo $noticias->fecha->ViewAttributes() ?>><?php echo $noticias->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($noticias->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->orden->FldCaption() ?></td>
		<td<?php echo $noticias->orden->CellAttributes() ?>>
<div<?php echo $noticias->orden->ViewAttributes() ?>><?php echo $noticias->orden->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($noticias->f_desde->Visible) { // f_desde ?>
	<tr id="r_f_desde"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->f_desde->FldCaption() ?></td>
		<td<?php echo $noticias->f_desde->CellAttributes() ?>>
<div<?php echo $noticias->f_desde->ViewAttributes() ?>><?php echo $noticias->f_desde->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($noticias->f_hasta->Visible) { // f_hasta ?>
	<tr id="r_f_hasta"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->f_hasta->FldCaption() ?></td>
		<td<?php echo $noticias->f_hasta->CellAttributes() ?>>
<div<?php echo $noticias->f_hasta->ViewAttributes() ?>><?php echo $noticias->f_hasta->ViewValue ?></div></td>
	</tr>
<?php } ?>

<?php if ($noticias->noticias_link->Visible) { // noticias_link ?>
	<tr id="r_noticias_link"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo "Link a noticia" ?></td>
		<td<?php echo $noticias->noticias_link->CellAttributes() ?>>
<div<?php echo $noticias->noticias_link->ViewAttributes() ?>><?php echo $noticias->noticias_link->ViewValue ?></div></td>
	</tr>
<?php } ?>

<?php if ($noticias->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->estatus->FldCaption() ?></td>
		<td<?php echo $noticias->estatus->CellAttributes() ?>>
<div<?php echo $noticias->estatus->ViewAttributes() ?>><?php echo $noticias->estatus->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$noticias_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($noticias->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$noticias_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cnoticias_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'noticias';

	// Page object name
	var $PageObjName = 'noticias_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $noticias;
		if ($noticias->UseTokenInUrl) $PageUrl .= "t=" . $noticias->TableVar . "&"; // Add page token
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
		global $objForm, $noticias;
		if ($noticias->UseTokenInUrl) {
			if ($objForm)
				return ($noticias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($noticias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cnoticias_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (noticias)
		if (!isset($GLOBALS["noticias"])) {
			$GLOBALS["noticias"] = new cnoticias();
			$GLOBALS["Table"] =& $GLOBALS["noticias"];
		}
		$KeyUrl = "";
		if (@$_GET["id_noticia"] <> "") {
			$this->RecKey["id_noticia"] = $_GET["id_noticia"];
			$KeyUrl .= "&id_noticia=" . urlencode($this->RecKey["id_noticia"]);
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
			define("EW_TABLE_NAME", 'noticias', TRUE);

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
		global $noticias;

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
			$this->Page_Terminate("noticiaslist.php");
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
		global $Language, $noticias;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_noticia"] <> "") {
				$noticias->id_noticia->setQueryStringValue($_GET["id_noticia"]);
				$this->RecKey["id_noticia"] = $noticias->id_noticia->QueryStringValue;
			} else {
				$sReturnUrl = "noticiaslist.php"; // Return to list
			}

			// Get action
			$noticias->CurrentAction = "I"; // Display form
			switch ($noticias->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "noticiaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "noticiaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$noticias->RowType = EW_ROWTYPE_VIEW;
		$noticias->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $noticias;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$noticias->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$noticias->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $noticias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$noticias->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$noticias->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$noticias->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $noticias;
		$sFilter = $noticias->KeyFilter();

		// Call Row Selecting event
		$noticias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$noticias->CurrentFilter = $sFilter;
		$sSql = $noticias->SQL();
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
		global $conn, $noticias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$noticias->Row_Selected($row);
		$noticias->id_noticia->setDbValue($rs->fields('id_noticia'));
		$noticias->tipo->setDbValue($rs->fields('tipo'));
		$noticias->titulo->setDbValue($rs->fields('titulo'));
		$noticias->antetitulo->setDbValue($rs->fields('antetitulo'));
		$noticias->sumario->setDbValue($rs->fields('sumario'));
		$noticias->contenido->setDbValue($rs->fields('contenido'));
		$noticias->id_grupo->setDbValue($rs->fields('id_grupo'));
		$noticias->imagen->Upload->DbValue = $rs->fields('imagen');
		$noticias->fecha->setDbValue($rs->fields('fecha'));
		$noticias->orden->setDbValue($rs->fields('orden'));
		$noticias->f_desde->setDbValue($rs->fields('f_desde'));
		$noticias->f_hasta->setDbValue($rs->fields('f_hasta'));
		$noticias->estatus->setDbValue($rs->fields('estatus'));
		$noticias->noticias_link->setDbValue($rs->fields('noticias_link'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $noticias;

		// Initialize URLs
		$this->AddUrl = $noticias->AddUrl();
		$this->EditUrl = $noticias->EditUrl();
		$this->CopyUrl = $noticias->CopyUrl();
		$this->DeleteUrl = $noticias->DeleteUrl();
		$this->ListUrl = $noticias->ListUrl();

		// Call Row_Rendering event
		$noticias->Row_Rendering();

		// Common render codes for all row types
		// id_noticia
		// tipo
		// titulo
		// antetitulo
		// sumario
		// contenido
		// id_grupo
		// imagen
		// fecha
		// orden
		// f_desde
		// f_hasta
		// estatus

		if ($noticias->RowType == EW_ROWTYPE_VIEW) { // View row

			// tipo
			if (strval($noticias->tipo->CurrentValue) <> "") {
				switch ($noticias->tipo->CurrentValue) {
					case "1":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(1) <> "" ? $noticias->tipo->FldTagCaption(1) : $noticias->tipo->CurrentValue;
						break;
					case "2":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(2) <> "" ? $noticias->tipo->FldTagCaption(2) : $noticias->tipo->CurrentValue;
						break;
					case "3":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(3) <> "" ? $noticias->tipo->FldTagCaption(3) : $noticias->tipo->CurrentValue;
						break;
					case "4":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(4) <> "" ? $noticias->tipo->FldTagCaption(4) : $noticias->tipo->CurrentValue;
						break;
					default:
						$noticias->tipo->ViewValue = $noticias->tipo->CurrentValue;
				}
			} else {
				$noticias->tipo->ViewValue = NULL;
			}
			$noticias->tipo->ViewCustomAttributes = "";

			// titulo
			$noticias->titulo->ViewValue = $noticias->titulo->CurrentValue;
			$noticias->titulo->ViewCustomAttributes = "";

			// antetitulo
			$noticias->antetitulo->ViewValue = $noticias->antetitulo->CurrentValue;
			$noticias->antetitulo->ViewCustomAttributes = "";

			// sumario
			$noticias->sumario->ViewValue = $noticias->sumario->CurrentValue;
			$noticias->sumario->ViewCustomAttributes = "";

			// contenido
			$noticias->contenido->ViewValue = $noticias->contenido->CurrentValue;
			$noticias->contenido->ViewCustomAttributes = "";

			// id_grupo
			if (strval($noticias->id_grupo->CurrentValue) <> "") {
				$arwrk = explode(",", $noticias->id_grupo->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_grupo` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is null";
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
					$noticias->id_grupo->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$noticias->id_grupo->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $noticias->id_grupo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$noticias->id_grupo->ViewValue = $noticias->id_grupo->CurrentValue;
				}
			} else {
				$noticias->id_grupo->ViewValue = NULL;
			}
			$noticias->id_grupo->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($noticias->imagen->Upload->DbValue)) {
				$noticias->imagen->ViewValue = $noticias->imagen->Upload->DbValue;
				$noticias->imagen->ImageWidth = 150;
				$noticias->imagen->ImageHeight = 30;
				$noticias->imagen->ImageAlt = $noticias->imagen->FldAlt();
			} else {
				$noticias->imagen->ViewValue = "";
			}
			$noticias->imagen->ViewCustomAttributes = "";

			// fecha
			$noticias->fecha->ViewValue = $noticias->fecha->CurrentValue;
			$noticias->fecha->ViewValue = ew_FormatDateTime($noticias->fecha->ViewValue, 7);
			$noticias->fecha->ViewCustomAttributes = "";

			// orden
			$noticias->orden->ViewValue = $noticias->orden->CurrentValue;
			$noticias->orden->ViewCustomAttributes = "";

			// f_desde
			$noticias->f_desde->ViewValue = $noticias->f_desde->CurrentValue;
			$noticias->f_desde->ViewValue = ew_FormatDateTime($noticias->f_desde->ViewValue, 7);
			$noticias->f_desde->ViewCustomAttributes = "";

			// f_hasta
			$noticias->f_hasta->ViewValue = $noticias->f_hasta->CurrentValue;
			$noticias->f_hasta->ViewValue = ew_FormatDateTime($noticias->f_hasta->ViewValue, 7);
			$noticias->f_hasta->ViewCustomAttributes = "";
			
			// noticias_link
			$noticias->noticias_link->ViewValue = $noticias->noticias_link->CurrentValue;
			$noticias->noticias_link->ViewCustomAttributes = "";

			// estatus
			if (strval($noticias->estatus->CurrentValue) <> "") {
				switch ($noticias->estatus->CurrentValue) {
					case "1":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(1) <> "" ? $noticias->estatus->FldTagCaption(1) : $noticias->estatus->CurrentValue;
						break;
					case "0":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(2) <> "" ? $noticias->estatus->FldTagCaption(2) : $noticias->estatus->CurrentValue;
						break;
					default:
						$noticias->estatus->ViewValue = $noticias->estatus->CurrentValue;
				}
			} else {
				$noticias->estatus->ViewValue = NULL;
			}
			$noticias->estatus->ViewCustomAttributes = "";

			// tipo
			$noticias->tipo->LinkCustomAttributes = "";
			$noticias->tipo->HrefValue = "";
			$noticias->tipo->TooltipValue = "";

			// titulo
			$noticias->titulo->LinkCustomAttributes = "";
			$noticias->titulo->HrefValue = "";
			$noticias->titulo->TooltipValue = "";

			// antetitulo
			$noticias->antetitulo->LinkCustomAttributes = "";
			$noticias->antetitulo->HrefValue = "";
			$noticias->antetitulo->TooltipValue = "";

			// sumario
			$noticias->sumario->LinkCustomAttributes = "";
			$noticias->sumario->HrefValue = "";
			$noticias->sumario->TooltipValue = "";

			// contenido
			$noticias->contenido->LinkCustomAttributes = "";
			$noticias->contenido->HrefValue = "";
			$noticias->contenido->TooltipValue = "";

			// id_grupo
			$noticias->id_grupo->LinkCustomAttributes = "";
			$noticias->id_grupo->HrefValue = "";
			$noticias->id_grupo->TooltipValue = "";

			// imagen
			$noticias->imagen->LinkCustomAttributes = "";
			$noticias->imagen->HrefValue = "";
			$noticias->imagen->TooltipValue = "";

			// fecha
			$noticias->fecha->LinkCustomAttributes = "";
			$noticias->fecha->HrefValue = "";
			$noticias->fecha->TooltipValue = "";

			// orden
			$noticias->orden->LinkCustomAttributes = "";
			$noticias->orden->HrefValue = "";
			$noticias->orden->TooltipValue = "";

			// f_desde
			$noticias->f_desde->LinkCustomAttributes = "";
			$noticias->f_desde->HrefValue = "";
			$noticias->f_desde->TooltipValue = "";

			// f_hasta
			$noticias->f_hasta->LinkCustomAttributes = "";
			$noticias->f_hasta->HrefValue = "";
			$noticias->f_hasta->TooltipValue = "";

			// estatus
			$noticias->estatus->LinkCustomAttributes = "";
			$noticias->estatus->HrefValue = "";
			$noticias->estatus->TooltipValue = "";
			
			// noticias_link
			$noticias->noticias_link->LinkCustomAttributes = "";
			$noticias->noticias_link->HrefValue = "";
			$noticias->noticias_link->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($noticias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$noticias->Row_Rendered();
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
