<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariopermisosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuariopermisos_view = new cusuariopermisos_view();
$Page =& $usuariopermisos_view;

// Page init
$usuariopermisos_view->Page_Init();

// Page main
$usuariopermisos_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuariopermisos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuariopermisos_view = new ew_Page("usuariopermisos_view");

// page properties
usuariopermisos_view.PageID = "view"; // page ID
usuariopermisos_view.FormID = "fusuariopermisosview"; // form ID
var EW_PAGE_ID = usuariopermisos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuariopermisos_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuariopermisos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuariopermisos_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuariopermisos->TableCaption() ?>
&nbsp;&nbsp;<?php $usuariopermisos_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($usuariopermisos->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $usuariopermisos_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $usuariopermisos_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $usuariopermisos_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $usuariopermisos_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $usuariopermisos_view->ShowPageHeader(); ?>
<?php
$usuariopermisos_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuariopermisos->userlevelid->Visible) { // userlevelid ?>
	<tr id="r_userlevelid"<?php echo $usuariopermisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuariopermisos->userlevelid->FldCaption() ?></td>
		<td<?php echo $usuariopermisos->userlevelid->CellAttributes() ?>>
<div<?php echo $usuariopermisos->userlevelid->ViewAttributes() ?>><?php echo $usuariopermisos->userlevelid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuariopermisos->ztablename->Visible) { // tablename ?>
	<tr id="r_ztablename"<?php echo $usuariopermisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuariopermisos->ztablename->FldCaption() ?></td>
		<td<?php echo $usuariopermisos->ztablename->CellAttributes() ?>>
<div<?php echo $usuariopermisos->ztablename->ViewAttributes() ?>><?php echo $usuariopermisos->ztablename->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuariopermisos->permission->Visible) { // permission ?>
	<tr id="r_permission"<?php echo $usuariopermisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuariopermisos->permission->FldCaption() ?></td>
		<td<?php echo $usuariopermisos->permission->CellAttributes() ?>>
<div<?php echo $usuariopermisos->permission->ViewAttributes() ?>><?php echo $usuariopermisos->permission->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$usuariopermisos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuariopermisos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuariopermisos_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuariopermisos_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'usuariopermisos';

	// Page object name
	var $PageObjName = 'usuariopermisos_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuariopermisos;
		if ($usuariopermisos->UseTokenInUrl) $PageUrl .= "t=" . $usuariopermisos->TableVar . "&"; // Add page token
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
		global $objForm, $usuariopermisos;
		if ($usuariopermisos->UseTokenInUrl) {
			if ($objForm)
				return ($usuariopermisos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuariopermisos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuariopermisos_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuariopermisos)
		if (!isset($GLOBALS["usuariopermisos"])) {
			$GLOBALS["usuariopermisos"] = new cusuariopermisos();
			$GLOBALS["Table"] =& $GLOBALS["usuariopermisos"];
		}
		$KeyUrl = "";
		if (@$_GET["userlevelid"] <> "") {
			$this->RecKey["userlevelid"] = $_GET["userlevelid"];
			$KeyUrl .= "&userlevelid=" . urlencode($this->RecKey["userlevelid"]);
		}
		if (@$_GET["ztablename"] <> "") {
			$this->RecKey["ztablename"] = $_GET["ztablename"];
			$KeyUrl .= "&ztablename=" . urlencode($this->RecKey["ztablename"]);
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
			define("EW_TABLE_NAME", 'usuariopermisos', TRUE);

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
		global $usuariopermisos;

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
		if (!$Security->CanAdmin()) {
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
		global $Language, $usuariopermisos;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["userlevelid"] <> "") {
				$usuariopermisos->userlevelid->setQueryStringValue($_GET["userlevelid"]);
				$this->RecKey["userlevelid"] = $usuariopermisos->userlevelid->QueryStringValue;
			} else {
				$sReturnUrl = "usuariopermisoslist.php"; // Return to list
			}
			if (@$_GET["ztablename"] <> "") {
				$usuariopermisos->ztablename->setQueryStringValue($_GET["ztablename"]);
				$this->RecKey["ztablename"] = $usuariopermisos->ztablename->QueryStringValue;
			} else {
				$sReturnUrl = "usuariopermisoslist.php"; // Return to list
			}

			// Get action
			$usuariopermisos->CurrentAction = "I"; // Display form
			switch ($usuariopermisos->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "usuariopermisoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "usuariopermisoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$usuariopermisos->RowType = EW_ROWTYPE_VIEW;
		$usuariopermisos->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuariopermisos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuariopermisos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuariopermisos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuariopermisos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuariopermisos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuariopermisos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuariopermisos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuariopermisos;
		$sFilter = $usuariopermisos->KeyFilter();

		// Call Row Selecting event
		$usuariopermisos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuariopermisos->CurrentFilter = $sFilter;
		$sSql = $usuariopermisos->SQL();
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
		global $conn, $usuariopermisos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuariopermisos->Row_Selected($row);
		$usuariopermisos->userlevelid->setDbValue($rs->fields('userlevelid'));
		$usuariopermisos->ztablename->setDbValue($rs->fields('tablename'));
		$usuariopermisos->permission->setDbValue($rs->fields('permission'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuariopermisos;

		// Initialize URLs
		$this->AddUrl = $usuariopermisos->AddUrl();
		$this->EditUrl = $usuariopermisos->EditUrl();
		$this->CopyUrl = $usuariopermisos->CopyUrl();
		$this->DeleteUrl = $usuariopermisos->DeleteUrl();
		$this->ListUrl = $usuariopermisos->ListUrl();

		// Call Row_Rendering event
		$usuariopermisos->Row_Rendering();

		// Common render codes for all row types
		// userlevelid
		// tablename
		// permission

		if ($usuariopermisos->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$usuariopermisos->userlevelid->ViewValue = $usuariopermisos->userlevelid->CurrentValue;
			$usuariopermisos->userlevelid->ViewCustomAttributes = "";

			// tablename
			$usuariopermisos->ztablename->ViewValue = $usuariopermisos->ztablename->CurrentValue;
			$usuariopermisos->ztablename->ViewCustomAttributes = "";

			// permission
			if (strval($usuariopermisos->permission->CurrentValue) <> "") {
				$arwrk = explode(",", $usuariopermisos->permission->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`userlevelid` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `userlevelname` FROM `usuarioniveles`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$usuariopermisos->permission->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$usuariopermisos->permission->ViewValue .= $rswrk->fields('userlevelname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $usuariopermisos->permission->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$usuariopermisos->permission->ViewValue = $usuariopermisos->permission->CurrentValue;
				}
			} else {
				$usuariopermisos->permission->ViewValue = NULL;
			}
			$usuariopermisos->permission->ViewCustomAttributes = "";

			// userlevelid
			$usuariopermisos->userlevelid->LinkCustomAttributes = "";
			$usuariopermisos->userlevelid->HrefValue = "";
			$usuariopermisos->userlevelid->TooltipValue = "";

			// tablename
			$usuariopermisos->ztablename->LinkCustomAttributes = "";
			$usuariopermisos->ztablename->HrefValue = "";
			$usuariopermisos->ztablename->TooltipValue = "";

			// permission
			$usuariopermisos->permission->LinkCustomAttributes = "";
			$usuariopermisos->permission->HrefValue = "";
			$usuariopermisos->permission->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuariopermisos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuariopermisos->Row_Rendered();
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
