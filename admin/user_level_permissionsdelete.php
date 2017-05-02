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
$user_level_permissions_delete = new cuser_level_permissions_delete();
$Page =& $user_level_permissions_delete;

// Page init
$user_level_permissions_delete->Page_Init();

// Page main
$user_level_permissions_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var user_level_permissions_delete = new ew_Page("user_level_permissions_delete");

// page properties
user_level_permissions_delete.PageID = "delete"; // page ID
user_level_permissions_delete.FormID = "fuser_level_permissionsdelete"; // form ID
var EW_PAGE_ID = user_level_permissions_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
user_level_permissions_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_level_permissions_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_level_permissions_delete.ValidateRequired = false; // no JavaScript validation
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
if ($user_level_permissions_delete->Recordset = $user_level_permissions_delete->LoadRecordset())
	$user_level_permissions_deleteTotalRecs = $user_level_permissions_delete->Recordset->RecordCount(); // Get record count
if ($user_level_permissions_deleteTotalRecs <= 0) { // No record found, exit
	if ($user_level_permissions_delete->Recordset)
		$user_level_permissions_delete->Recordset->Close();
	$user_level_permissions_delete->Page_Terminate("user_level_permissionslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $user_level_permissions->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $user_level_permissions->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $user_level_permissions_delete->ShowPageHeader(); ?>
<?php
$user_level_permissions_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="user_level_permissions">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($user_level_permissions_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $user_level_permissions->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $user_level_permissions->UserLevelID->FldCaption() ?></td>
		<td valign="top"><?php echo $user_level_permissions->zTableName->FldCaption() ?></td>
		<td valign="top"><?php echo $user_level_permissions->Permission->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$user_level_permissions_delete->RecCnt = 0;
$i = 0;
while (!$user_level_permissions_delete->Recordset->EOF) {
	$user_level_permissions_delete->RecCnt++;

	// Set row properties
	$user_level_permissions->ResetAttrs();
	$user_level_permissions->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$user_level_permissions_delete->LoadRowValues($user_level_permissions_delete->Recordset);

	// Render row
	$user_level_permissions_delete->RenderRow();
?>
	<tr<?php echo $user_level_permissions->RowAttributes() ?>>
		<td<?php echo $user_level_permissions->UserLevelID->CellAttributes() ?>>
<div<?php echo $user_level_permissions->UserLevelID->ViewAttributes() ?>><?php echo $user_level_permissions->UserLevelID->ListViewValue() ?></div></td>
		<td<?php echo $user_level_permissions->zTableName->CellAttributes() ?>>
<div<?php echo $user_level_permissions->zTableName->ViewAttributes() ?>><?php echo $user_level_permissions->zTableName->ListViewValue() ?></div></td>
		<td<?php echo $user_level_permissions->Permission->CellAttributes() ?>>
<div<?php echo $user_level_permissions->Permission->ViewAttributes() ?>><?php echo $user_level_permissions->Permission->ListViewValue() ?></div></td>
	</tr>
<?php
	$user_level_permissions_delete->Recordset->MoveNext();
}
$user_level_permissions_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$user_level_permissions_delete->ShowPageFooter();
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
$user_level_permissions_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cuser_level_permissions_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'user_level_permissions';

	// Page object name
	var $PageObjName = 'user_level_permissions_delete';

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
	function cuser_level_permissions_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (user_level_permissions)
		if (!isset($GLOBALS["user_level_permissions"])) {
			$GLOBALS["user_level_permissions"] = new cuser_level_permissions();
			$GLOBALS["Table"] =& $GLOBALS["user_level_permissions"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'user_level_permissions', TRUE);

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
		if (!$Security->CanDelete()) {
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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $user_level_permissions;

		// Load key parameters
		$this->RecKeys = $user_level_permissions->GetRecordKeys(); // Load record keys
		$sFilter = $user_level_permissions->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("user_level_permissionslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in user_level_permissions class, user_level_permissionsinfo.php

		$user_level_permissions->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$user_level_permissions->CurrentAction = $_POST["a_delete"];
		} else {
			$user_level_permissions->CurrentAction = "I"; // Display record
		}
		switch ($user_level_permissions->CurrentAction) {
			case "D": // Delete
				$user_level_permissions->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($user_level_permissions->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $user_level_permissions;

		// Call Recordset Selecting event
		$user_level_permissions->Recordset_Selecting($user_level_permissions->CurrentFilter);

		// Load List page SQL
		$sSql = $user_level_permissions->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$user_level_permissions->Recordset_Selected($rs);
		return $rs;
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $user_level_permissions;
		$DeleteRows = TRUE;
		$sSql = $user_level_permissions->SQL();
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
				$DeleteRows = $user_level_permissions->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['UserLevelID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($user_level_permissions->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($user_level_permissions->CancelMessage <> "") {
				$this->setFailureMessage($user_level_permissions->CancelMessage);
				$user_level_permissions->CancelMessage = "";
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
				$user_level_permissions->Row_Deleted($row);
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
