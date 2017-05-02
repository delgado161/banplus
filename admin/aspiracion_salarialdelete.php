<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "aspiracion_salarialinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$aspiracion_salarial_delete = new caspiracion_salarial_delete();
$Page =& $aspiracion_salarial_delete;

// Page init
$aspiracion_salarial_delete->Page_Init();

// Page main
$aspiracion_salarial_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var aspiracion_salarial_delete = new ew_Page("aspiracion_salarial_delete");

// page properties
aspiracion_salarial_delete.PageID = "delete"; // page ID
aspiracion_salarial_delete.FormID = "faspiracion_salarialdelete"; // form ID
var EW_PAGE_ID = aspiracion_salarial_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
aspiracion_salarial_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
aspiracion_salarial_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
aspiracion_salarial_delete.ValidateRequired = false; // no JavaScript validation
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
if ($aspiracion_salarial_delete->Recordset = $aspiracion_salarial_delete->LoadRecordset())
	$aspiracion_salarial_deleteTotalRecs = $aspiracion_salarial_delete->Recordset->RecordCount(); // Get record count
if ($aspiracion_salarial_deleteTotalRecs <= 0) { // No record found, exit
	if ($aspiracion_salarial_delete->Recordset)
		$aspiracion_salarial_delete->Recordset->Close();
	$aspiracion_salarial_delete->Page_Terminate("aspiracion_salariallist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $aspiracion_salarial->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $aspiracion_salarial->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $aspiracion_salarial_delete->ShowPageHeader(); ?>
<?php
$aspiracion_salarial_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="aspiracion_salarial">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($aspiracion_salarial_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $aspiracion_salarial->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $aspiracion_salarial->valor->FldCaption() ?></td>
		<td valign="top"><?php echo $aspiracion_salarial->orden->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$aspiracion_salarial_delete->RecCnt = 0;
$i = 0;
while (!$aspiracion_salarial_delete->Recordset->EOF) {
	$aspiracion_salarial_delete->RecCnt++;

	// Set row properties
	$aspiracion_salarial->ResetAttrs();
	$aspiracion_salarial->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$aspiracion_salarial_delete->LoadRowValues($aspiracion_salarial_delete->Recordset);

	// Render row
	$aspiracion_salarial_delete->RenderRow();
?>
	<tr<?php echo $aspiracion_salarial->RowAttributes() ?>>
		<td<?php echo $aspiracion_salarial->valor->CellAttributes() ?>>
<div<?php echo $aspiracion_salarial->valor->ViewAttributes() ?>><?php echo $aspiracion_salarial->valor->ListViewValue() ?></div></td>
		<td<?php echo $aspiracion_salarial->orden->CellAttributes() ?>>
<div<?php echo $aspiracion_salarial->orden->ViewAttributes() ?>><?php echo $aspiracion_salarial->orden->ListViewValue() ?></div></td>
	</tr>
<?php
	$aspiracion_salarial_delete->Recordset->MoveNext();
}
$aspiracion_salarial_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$aspiracion_salarial_delete->ShowPageFooter();
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
$aspiracion_salarial_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class caspiracion_salarial_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'aspiracion_salarial';

	// Page object name
	var $PageObjName = 'aspiracion_salarial_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $aspiracion_salarial;
		if ($aspiracion_salarial->UseTokenInUrl) $PageUrl .= "t=" . $aspiracion_salarial->TableVar . "&"; // Add page token
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
		global $objForm, $aspiracion_salarial;
		if ($aspiracion_salarial->UseTokenInUrl) {
			if ($objForm)
				return ($aspiracion_salarial->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($aspiracion_salarial->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caspiracion_salarial_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (aspiracion_salarial)
		if (!isset($GLOBALS["aspiracion_salarial"])) {
			$GLOBALS["aspiracion_salarial"] = new caspiracion_salarial();
			$GLOBALS["Table"] =& $GLOBALS["aspiracion_salarial"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'aspiracion_salarial', TRUE);

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
		global $aspiracion_salarial;

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
			$this->Page_Terminate("aspiracion_salariallist.php");
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
		global $Language, $aspiracion_salarial;

		// Load key parameters
		$this->RecKeys = $aspiracion_salarial->GetRecordKeys(); // Load record keys
		$sFilter = $aspiracion_salarial->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("aspiracion_salariallist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in aspiracion_salarial class, aspiracion_salarialinfo.php

		$aspiracion_salarial->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$aspiracion_salarial->CurrentAction = $_POST["a_delete"];
		} else {
			$aspiracion_salarial->CurrentAction = "I"; // Display record
		}
		switch ($aspiracion_salarial->CurrentAction) {
			case "D": // Delete
				$aspiracion_salarial->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($aspiracion_salarial->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $aspiracion_salarial;

		// Call Recordset Selecting event
		$aspiracion_salarial->Recordset_Selecting($aspiracion_salarial->CurrentFilter);

		// Load List page SQL
		$sSql = $aspiracion_salarial->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$aspiracion_salarial->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $aspiracion_salarial;
		$sFilter = $aspiracion_salarial->KeyFilter();

		// Call Row Selecting event
		$aspiracion_salarial->Row_Selecting($sFilter);

		// Load SQL based on filter
		$aspiracion_salarial->CurrentFilter = $sFilter;
		$sSql = $aspiracion_salarial->SQL();
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
		global $conn, $aspiracion_salarial;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$aspiracion_salarial->Row_Selected($row);
		$aspiracion_salarial->id_aspiracion_salarial->setDbValue($rs->fields('id_aspiracion_salarial'));
		$aspiracion_salarial->valor->setDbValue($rs->fields('valor'));
		$aspiracion_salarial->orden->setDbValue($rs->fields('orden'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $aspiracion_salarial;

		// Initialize URLs
		// Call Row_Rendering event

		$aspiracion_salarial->Row_Rendering();

		// Common render codes for all row types
		// id_aspiracion_salarial

		$aspiracion_salarial->id_aspiracion_salarial->CellCssStyle = "white-space: nowrap;";

		// valor
		// orden

		if ($aspiracion_salarial->RowType == EW_ROWTYPE_VIEW) { // View row

			// valor
			$aspiracion_salarial->valor->ViewValue = $aspiracion_salarial->valor->CurrentValue;
			$aspiracion_salarial->valor->ViewCustomAttributes = "";

			// orden
			$aspiracion_salarial->orden->ViewValue = $aspiracion_salarial->orden->CurrentValue;
			$aspiracion_salarial->orden->ViewCustomAttributes = "";

			// valor
			$aspiracion_salarial->valor->LinkCustomAttributes = "";
			$aspiracion_salarial->valor->HrefValue = "";
			$aspiracion_salarial->valor->TooltipValue = "";

			// orden
			$aspiracion_salarial->orden->LinkCustomAttributes = "";
			$aspiracion_salarial->orden->HrefValue = "";
			$aspiracion_salarial->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($aspiracion_salarial->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$aspiracion_salarial->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $aspiracion_salarial;
		$DeleteRows = TRUE;
		$sSql = $aspiracion_salarial->SQL();
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
				$DeleteRows = $aspiracion_salarial->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_aspiracion_salarial'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($aspiracion_salarial->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($aspiracion_salarial->CancelMessage <> "") {
				$this->setFailureMessage($aspiracion_salarial->CancelMessage);
				$aspiracion_salarial->CancelMessage = "";
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
				$aspiracion_salarial->Row_Deleted($row);
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
