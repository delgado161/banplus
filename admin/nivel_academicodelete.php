<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "nivel_academicoinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$nivel_academico_delete = new cnivel_academico_delete();
$Page =& $nivel_academico_delete;

// Page init
$nivel_academico_delete->Page_Init();

// Page main
$nivel_academico_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var nivel_academico_delete = new ew_Page("nivel_academico_delete");

// page properties
nivel_academico_delete.PageID = "delete"; // page ID
nivel_academico_delete.FormID = "fnivel_academicodelete"; // form ID
var EW_PAGE_ID = nivel_academico_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
nivel_academico_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
nivel_academico_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nivel_academico_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($nivel_academico_delete->Recordset = $nivel_academico_delete->LoadRecordset())
	$nivel_academico_deleteTotalRecs = $nivel_academico_delete->Recordset->RecordCount(); // Get record count
if ($nivel_academico_deleteTotalRecs <= 0) { // No record found, exit
	if ($nivel_academico_delete->Recordset)
		$nivel_academico_delete->Recordset->Close();
	$nivel_academico_delete->Page_Terminate("nivel_academicolist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $nivel_academico->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $nivel_academico->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $nivel_academico_delete->ShowPageHeader(); ?>
<?php
$nivel_academico_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="nivel_academico">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($nivel_academico_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $nivel_academico->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $nivel_academico->nivel->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$nivel_academico_delete->RecCnt = 0;
$i = 0;
while (!$nivel_academico_delete->Recordset->EOF) {
	$nivel_academico_delete->RecCnt++;

	// Set row properties
	$nivel_academico->ResetAttrs();
	$nivel_academico->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$nivel_academico_delete->LoadRowValues($nivel_academico_delete->Recordset);

	// Render row
	$nivel_academico_delete->RenderRow();
?>
	<tr<?php echo $nivel_academico->RowAttributes() ?>>
		<td<?php echo $nivel_academico->nivel->CellAttributes() ?>>
<div<?php echo $nivel_academico->nivel->ViewAttributes() ?>><?php echo $nivel_academico->nivel->ListViewValue() ?></div></td>
	</tr>
<?php
	$nivel_academico_delete->Recordset->MoveNext();
}
$nivel_academico_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$nivel_academico_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$nivel_academico_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cnivel_academico_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'nivel_academico';

	// Page object name
	var $PageObjName = 'nivel_academico_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $nivel_academico;
		if ($nivel_academico->UseTokenInUrl) $PageUrl .= "t=" . $nivel_academico->TableVar . "&"; // Add page token
		return $PageUrl;
	}

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
		global $objForm, $nivel_academico;
		if ($nivel_academico->UseTokenInUrl) {
			if ($objForm)
				return ($nivel_academico->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($nivel_academico->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cnivel_academico_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (nivel_academico)
		if (!isset($GLOBALS["nivel_academico"])) {
			$GLOBALS["nivel_academico"] = new cnivel_academico();
			$GLOBALS["Table"] =& $GLOBALS["nivel_academico"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'nivel_academico', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $nivel_academico;

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("nivel_academicolist.php");
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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $nivel_academico;

		// Load key parameters
		$this->RecKeys = $nivel_academico->GetRecordKeys(); // Load record keys
		$sFilter = $nivel_academico->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("nivel_academicolist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in nivel_academico class, nivel_academicoinfo.php

		$nivel_academico->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$nivel_academico->CurrentAction = $_POST["a_delete"];
		} else {
			$nivel_academico->CurrentAction = "I"; // Display record
		}
		switch ($nivel_academico->CurrentAction) {
			case "D": // Delete
				$nivel_academico->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($nivel_academico->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $nivel_academico;

		// Call Recordset Selecting event
		$nivel_academico->Recordset_Selecting($nivel_academico->CurrentFilter);

		// Load List page SQL
		$sSql = $nivel_academico->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$nivel_academico->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $nivel_academico;
		$sFilter = $nivel_academico->KeyFilter();

		// Call Row Selecting event
		$nivel_academico->Row_Selecting($sFilter);

		// Load SQL based on filter
		$nivel_academico->CurrentFilter = $sFilter;
		$sSql = $nivel_academico->SQL();
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
		global $conn, $nivel_academico;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$nivel_academico->Row_Selected($row);
		$nivel_academico->id_nivel_academico->setDbValue($rs->fields('id_nivel_academico'));
		$nivel_academico->nivel->setDbValue($rs->fields('nivel'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $nivel_academico;

		// Initialize URLs
		// Call Row_Rendering event

		$nivel_academico->Row_Rendering();

		// Common render codes for all row types
		// id_nivel_academico

		$nivel_academico->id_nivel_academico->CellCssStyle = "white-space: nowrap;";

		// nivel
		if ($nivel_academico->RowType == EW_ROWTYPE_VIEW) { // View row

			// nivel
			$nivel_academico->nivel->ViewValue = $nivel_academico->nivel->CurrentValue;
			$nivel_academico->nivel->ViewCustomAttributes = "";

			// nivel
			$nivel_academico->nivel->LinkCustomAttributes = "";
			$nivel_academico->nivel->HrefValue = "";
			$nivel_academico->nivel->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($nivel_academico->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$nivel_academico->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $nivel_academico;
		$DeleteRows = TRUE;
		$sSql = $nivel_academico->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $nivel_academico->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_nivel_academico'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($nivel_academico->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($nivel_academico->CancelMessage <> "") {
				$this->setFailureMessage($nivel_academico->CancelMessage);
				$nivel_academico->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$nivel_academico->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
