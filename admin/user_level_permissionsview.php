<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "user_level_permissionsinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$user_level_permissions_view = new cuser_level_permissions_view();
$Page =& $user_level_permissions_view;

// Page init
$user_level_permissions_view->Page_Init();

// Page main
$user_level_permissions_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($user_level_permissions->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var user_level_permissions_view = new ew_Page("user_level_permissions_view");

// page properties
user_level_permissions_view.PageID = "view"; // page ID
user_level_permissions_view.FormID = "fuser_level_permissionsview"; // form ID
var EW_PAGE_ID = user_level_permissions_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
user_level_permissions_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_level_permissions_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_level_permissions_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $user_level_permissions->TableCaption() ?>
&nbsp;&nbsp;<?php $user_level_permissions_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($user_level_permissions->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $user_level_permissions_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $user_level_permissions_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $user_level_permissions_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $user_level_permissions_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $user_level_permissions_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $user_level_permissions_view->ShowPageHeader(); ?>
<?php
$user_level_permissions_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($user_level_permissions->UserLevelID->Visible) { // UserLevelID ?>
	<tr id="r_UserLevelID"<?php echo $user_level_permissions->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $user_level_permissions->UserLevelID->FldCaption() ?></td>
		<td<?php echo $user_level_permissions->UserLevelID->CellAttributes() ?>>
<div<?php echo $user_level_permissions->UserLevelID->ViewAttributes() ?>><?php echo $user_level_permissions->UserLevelID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_level_permissions->zTableName->Visible) { // TableName ?>
	<tr id="r_zTableName"<?php echo $user_level_permissions->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $user_level_permissions->zTableName->FldCaption() ?></td>
		<td<?php echo $user_level_permissions->zTableName->CellAttributes() ?>>
<div<?php echo $user_level_permissions->zTableName->ViewAttributes() ?>><?php echo $user_level_permissions->zTableName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($user_level_permissions->Permission->Visible) { // Permission ?>
	<tr id="r_Permission"<?php echo $user_level_permissions->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $user_level_permissions->Permission->FldCaption() ?></td>
		<td<?php echo $user_level_permissions->Permission->CellAttributes() ?>>
<div<?php echo $user_level_permissions->Permission->ViewAttributes() ?>><?php echo $user_level_permissions->Permission->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$user_level_permissions_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($user_level_permissions->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$user_level_permissions_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cuser_level_permissions_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'user_level_permissions';

	// Page object name
	var $PageObjName = 'user_level_permissions_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $user_level_permissions;
		if ($user_level_permissions->UseTokenInUrl) $PageUrl .= "t=" . $user_level_permissions->TableVar . "&"; // Add page token
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
		global $objForm, $user_level_permissions;
		if ($user_level_permissions->UseTokenInUrl) {
			if ($objForm)
				return ($user_level_permissions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($user_level_permissions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuser_level_permissions_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (user_level_permissions)
		if (!isset($GLOBALS["user_level_permissions"])) {
			$GLOBALS["user_level_permissions"] = new cuser_level_permissions();
			$GLOBALS["Table"] =& $GLOBALS["user_level_permissions"];
		}
		$KeyUrl = "";
		if (@$_GET["UserLevelID"] <> "") {
			$this->RecKey["UserLevelID"] = $_GET["UserLevelID"];
			$KeyUrl .= "&UserLevelID=" . urlencode($this->RecKey["UserLevelID"]);
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
			define("EW_TABLE_NAME", 'user_level_permissions', TRUE);

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
		global $user_level_permissions;

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
			$this->Page_Terminate("user_level_permissionslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
		global $Language, $user_level_permissions;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["UserLevelID"] <> "") {
				$user_level_permissions->UserLevelID->setQueryStringValue($_GET["UserLevelID"]);
				$this->RecKey["UserLevelID"] = $user_level_permissions->UserLevelID->QueryStringValue;
			} else {
				$sReturnUrl = "user_level_permissionslist.php"; // Return to list
			}

			// Get action
			$user_level_permissions->CurrentAction = "I"; // Display form
			switch ($user_level_permissions->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "user_level_permissionslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "user_level_permissionslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$user_level_permissions->RowType = EW_ROWTYPE_VIEW;
		$user_level_permissions->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $user_level_permissions;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$user_level_permissions->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$user_level_permissions->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $user_level_permissions->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$user_level_permissions->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$user_level_permissions->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$user_level_permissions->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $user_level_permissions;
		$sFilter = $user_level_permissions->KeyFilter();

		// Call Row Selecting event
		$user_level_permissions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$user_level_permissions->CurrentFilter = $sFilter;
		$sSql = $user_level_permissions->SQL();
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
		global $conn, $user_level_permissions;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$user_level_permissions->Row_Selected($row);
		$user_level_permissions->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$user_level_permissions->zTableName->setDbValue($rs->fields('TableName'));
		$user_level_permissions->Permission->setDbValue($rs->fields('Permission'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $user_level_permissions;

		// Initialize URLs
		$this->AddUrl = $user_level_permissions->AddUrl();
		$this->EditUrl = $user_level_permissions->EditUrl();
		$this->CopyUrl = $user_level_permissions->CopyUrl();
		$this->DeleteUrl = $user_level_permissions->DeleteUrl();
		$this->ListUrl = $user_level_permissions->ListUrl();

		// Call Row_Rendering event
		$user_level_permissions->Row_Rendering();

		// Common render codes for all row types
		// UserLevelID
		// TableName
		// Permission

		if ($user_level_permissions->RowType == EW_ROWTYPE_VIEW) { // View row

			// UserLevelID
			$user_level_permissions->UserLevelID->ViewValue = $user_level_permissions->UserLevelID->CurrentValue;
			$user_level_permissions->UserLevelID->ViewCustomAttributes = "";

			// TableName
			$user_level_permissions->zTableName->ViewValue = $user_level_permissions->zTableName->CurrentValue;
			$user_level_permissions->zTableName->ViewCustomAttributes = "";

			// Permission
			$user_level_permissions->Permission->ViewValue = $user_level_permissions->Permission->CurrentValue;
			$user_level_permissions->Permission->ViewCustomAttributes = "";

			// UserLevelID
			$user_level_permissions->UserLevelID->LinkCustomAttributes = "";
			$user_level_permissions->UserLevelID->HrefValue = "";
			$user_level_permissions->UserLevelID->TooltipValue = "";

			// TableName
			$user_level_permissions->zTableName->LinkCustomAttributes = "";
			$user_level_permissions->zTableName->HrefValue = "";
			$user_level_permissions->zTableName->TooltipValue = "";

			// Permission
			$user_level_permissions->Permission->LinkCustomAttributes = "";
			$user_level_permissions->Permission->HrefValue = "";
			$user_level_permissions->Permission->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($user_level_permissions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$user_level_permissions->Row_Rendered();
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
