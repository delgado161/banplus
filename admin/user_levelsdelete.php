<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "user_levelsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$user_levels_delete = new cuser_levels_delete();
$Page =& $user_levels_delete;

// Page init
$user_levels_delete->Page_Init();

// Page main
$user_levels_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var user_levels_delete = new ew_Page("user_levels_delete");

// page properties
user_levels_delete.PageID = "delete"; // page ID
user_levels_delete.FormID = "fuser_levelsdelete"; // form ID
var EW_PAGE_ID = user_levels_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
user_levels_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_levels_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_levels_delete.ValidateRequired = false; // no JavaScript validation
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
if ($user_levels_delete->Recordset = $user_levels_delete->LoadRecordset())
	$user_levels_deleteTotalRecs = $user_levels_delete->Recordset->RecordCount(); // Get record count
if ($user_levels_deleteTotalRecs <= 0) { // No record found, exit
	if ($user_levels_delete->Recordset)
		$user_levels_delete->Recordset->Close();
	$user_levels_delete->Page_Terminate("user_levelslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $user_levels->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $user_levels->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $user_levels_delete->ShowPageHeader(); ?>
<?php
$user_levels_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="user_levels">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($user_levels_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $user_levels->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $user_levels->UserLevelID->FldCaption() ?></td>
		<td valign="top"><?php echo $user_levels->UserLevelName->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$user_levels_delete->RecCnt = 0;
$i = 0;
while (!$user_levels_delete->Recordset->EOF) {
	$user_levels_delete->RecCnt++;

	// Set row properties
	$user_levels->ResetAttrs();
	$user_levels->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$user_levels_delete->LoadRowValues($user_levels_delete->Recordset);

	// Render row
	$user_levels_delete->RenderRow();
?>
	<tr<?php echo $user_levels->RowAttributes() ?>>
		<td<?php echo $user_levels->UserLevelID->CellAttributes() ?>>
<div<?php echo $user_levels->UserLevelID->ViewAttributes() ?>><?php echo $user_levels->UserLevelID->ListViewValue() ?></div></td>
		<td<?php echo $user_levels->UserLevelName->CellAttributes() ?>>
<div<?php echo $user_levels->UserLevelName->ViewAttributes() ?>><?php echo $user_levels->UserLevelName->ListViewValue() ?></div></td>
	</tr>
<?php
	$user_levels_delete->Recordset->MoveNext();
}
$user_levels_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$user_levels_delete->ShowPageFooter();
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
$user_levels_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cuser_levels_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'user_levels';

	// Page object name
	var $PageObjName = 'user_levels_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $user_levels;
		if ($user_levels->UseTokenInUrl) $PageUrl .= "t=" . $user_levels->TableVar . "&"; // Add page token
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
		global $objForm, $user_levels;
		if ($user_levels->UseTokenInUrl) {
			if ($objForm)
				return ($user_levels->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($user_levels->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuser_levels_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (user_levels)
		if (!isset($GLOBALS["user_levels"])) {
			$GLOBALS["user_levels"] = new cuser_levels();
			$GLOBALS["Table"] =& $GLOBALS["user_levels"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'user_levels', TRUE);

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
		global $user_levels;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $user_levels;

		// Load key parameters
		$this->RecKeys = $user_levels->GetRecordKeys(); // Load record keys
		$sFilter = $user_levels->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("user_levelslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in user_levels class, user_levelsinfo.php

		$user_levels->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$user_levels->CurrentAction = $_POST["a_delete"];
		} else {
			$user_levels->CurrentAction = "I"; // Display record
		}
		switch ($user_levels->CurrentAction) {
			case "D": // Delete
				$user_levels->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($user_levels->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $user_levels;

		// Call Recordset Selecting event
		$user_levels->Recordset_Selecting($user_levels->CurrentFilter);

		// Load List page SQL
		$sSql = $user_levels->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$user_levels->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $user_levels;
		$sFilter = $user_levels->KeyFilter();

		// Call Row Selecting event
		$user_levels->Row_Selecting($sFilter);

		// Load SQL based on filter
		$user_levels->CurrentFilter = $sFilter;
		$sSql = $user_levels->SQL();
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
		global $conn, $user_levels;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$user_levels->Row_Selected($row);
		$user_levels->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$user_levels->UserLevelName->setDbValue($rs->fields('UserLevelName'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $user_levels;

		// Initialize URLs
		// Call Row_Rendering event

		$user_levels->Row_Rendering();

		// Common render codes for all row types
		// UserLevelID
		// UserLevelName

		if ($user_levels->RowType == EW_ROWTYPE_VIEW) { // View row

			// UserLevelID
			$user_levels->UserLevelID->ViewValue = $user_levels->UserLevelID->CurrentValue;
			$user_levels->UserLevelID->ViewCustomAttributes = "";

			// UserLevelName
			$user_levels->UserLevelName->ViewValue = $user_levels->UserLevelName->CurrentValue;
			$user_levels->UserLevelName->ViewCustomAttributes = "";

			// UserLevelID
			$user_levels->UserLevelID->LinkCustomAttributes = "";
			$user_levels->UserLevelID->HrefValue = "";
			$user_levels->UserLevelID->TooltipValue = "";

			// UserLevelName
			$user_levels->UserLevelName->LinkCustomAttributes = "";
			$user_levels->UserLevelName->HrefValue = "";
			$user_levels->UserLevelName->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($user_levels->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$user_levels->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $user_levels;
		$DeleteRows = TRUE;
		$sSql = $user_levels->SQL();
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
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $user_levels->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($user_levels->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($user_levels->CancelMessage <> "") {
				$this->setFailureMessage($user_levels->CancelMessage);
				$user_levels->CancelMessage = "";
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
				$user_levels->Row_Deleted($row);
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
