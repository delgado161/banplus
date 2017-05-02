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
$user_levels_add = new cuser_levels_add();
$Page =& $user_levels_add;

// Page init
$user_levels_add->Page_Init();

// Page main
$user_levels_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var user_levels_add = new ew_Page("user_levels_add");

// page properties
user_levels_add.PageID = "add"; // page ID
user_levels_add.FormID = "fuser_levelsadd"; // form ID
var EW_PAGE_ID = user_levels_add.PageID; // for backward compatibility

// extend page with ValidateForm function
user_levels_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
user_levels_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_levels_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_levels_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $user_levels->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $user_levels->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $user_levels_add->ShowPageHeader(); ?>
<?php
$user_levels_add->ShowMessage();
?>
<form name="fuser_levelsadd" id="fuser_levelsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return user_levels_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="user_levels">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($user_levels->UserLevelName->Visible) { // UserLevelName ?>
	<tr id="r_UserLevelName"<?php echo $user_levels->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $user_levels->UserLevelName->FldCaption() ?></td>
		<td<?php echo $user_levels->UserLevelName->CellAttributes() ?>><span id="el_UserLevelName">
<input type="text" name="x_UserLevelName" id="x_UserLevelName" size="30" maxlength="45" value="<?php echo $user_levels->UserLevelName->EditValue ?>"<?php echo $user_levels->UserLevelName->EditAttributes() ?>>
</span><?php echo $user_levels->UserLevelName->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$user_levels_add->ShowPageFooter();
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
$user_levels_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cuser_levels_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'user_levels';

	// Page object name
	var $PageObjName = 'user_levels_add';

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
	function cuser_levels_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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

		// Create form object
		$objForm = new cFormObj();

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $user_levels;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$user_levels->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$user_levels->CurrentAction = "I"; // Form error, reset action
				$user_levels->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["UserLevelID"] != "") {
				$user_levels->UserLevelID->setQueryStringValue($_GET["UserLevelID"]);
				$user_levels->setKey("UserLevelID", $user_levels->UserLevelID->CurrentValue); // Set up key
			} else {
				$user_levels->setKey("UserLevelID", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$user_levels->CurrentAction = "C"; // Copy record
			} else {
				$user_levels->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($user_levels->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("user_levelslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$user_levels->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $user_levels->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "user_levelsview.php")
						$sReturnUrl = $user_levels->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$user_levels->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$user_levels->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$user_levels->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $user_levels;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $user_levels;
		$user_levels->UserLevelName->CurrentValue = NULL;
		$user_levels->UserLevelName->OldValue = $user_levels->UserLevelName->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $user_levels;
		if (!$user_levels->UserLevelName->FldIsDetailKey) {
			$user_levels->UserLevelName->setFormValue($objForm->GetValue("x_UserLevelName"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $user_levels;
		$this->LoadOldRecord();
		$user_levels->UserLevelName->CurrentValue = $user_levels->UserLevelName->FormValue;
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

	// Load old record
	function LoadOldRecord() {
		global $user_levels;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($user_levels->getKey("UserLevelID")) <> "")
			$user_levels->UserLevelID->CurrentValue = $user_levels->getKey("UserLevelID"); // UserLevelID
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$user_levels->CurrentFilter = $user_levels->KeyFilter();
			$sSql = $user_levels->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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

			// UserLevelName
			$user_levels->UserLevelName->LinkCustomAttributes = "";
			$user_levels->UserLevelName->HrefValue = "";
			$user_levels->UserLevelName->TooltipValue = "";
		} elseif ($user_levels->RowType == EW_ROWTYPE_ADD) { // Add row

			// UserLevelName
			$user_levels->UserLevelName->EditCustomAttributes = "";
			$user_levels->UserLevelName->EditValue = ew_HtmlEncode($user_levels->UserLevelName->CurrentValue);

			// Edit refer script
			// UserLevelName

			$user_levels->UserLevelName->HrefValue = "";
		}
		if ($user_levels->RowType == EW_ROWTYPE_ADD ||
			$user_levels->RowType == EW_ROWTYPE_EDIT ||
			$user_levels->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$user_levels->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($user_levels->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$user_levels->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $user_levels;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $user_levels;
		$rsnew = array();

		// UserLevelName
		$user_levels->UserLevelName->SetDbValueDef($rsnew, $user_levels->UserLevelName->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $user_levels->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($user_levels->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($user_levels->CancelMessage <> "") {
				$this->setFailureMessage($user_levels->CancelMessage);
				$user_levels->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$user_levels->UserLevelID->setDbValue($conn->Insert_ID());
			$rsnew['UserLevelID'] = $user_levels->UserLevelID->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$user_levels->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
