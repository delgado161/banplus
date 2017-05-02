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
$user_levels_edit = new cuser_levels_edit();
$Page =& $user_levels_edit;

// Page init
$user_levels_edit->Page_Init();

// Page main
$user_levels_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var user_levels_edit = new ew_Page("user_levels_edit");

// page properties
user_levels_edit.PageID = "edit"; // page ID
user_levels_edit.FormID = "fuser_levelsedit"; // form ID
var EW_PAGE_ID = user_levels_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
user_levels_edit.ValidateForm = function(fobj) {
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
user_levels_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_levels_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_levels_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $user_levels->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $user_levels->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $user_levels_edit->ShowPageHeader(); ?>
<?php
$user_levels_edit->ShowMessage();
?>
<form name="fuser_levelsedit" id="fuser_levelsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return user_levels_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="user_levels">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($user_levels->UserLevelID->Visible) { // UserLevelID ?>
	<tr id="r_UserLevelID"<?php echo $user_levels->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $user_levels->UserLevelID->FldCaption() ?></td>
		<td<?php echo $user_levels->UserLevelID->CellAttributes() ?>><span id="el_UserLevelID">
<div<?php echo $user_levels->UserLevelID->ViewAttributes() ?>><?php echo $user_levels->UserLevelID->EditValue ?></div>
<input type="hidden" name="x_UserLevelID" id="x_UserLevelID" value="<?php echo ew_HtmlEncode($user_levels->UserLevelID->CurrentValue) ?>">
</span><?php echo $user_levels->UserLevelID->CustomMsg ?></td>
	</tr>
<?php } ?>
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$user_levels_edit->ShowPageFooter();
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
$user_levels_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cuser_levels_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'user_levels';

	// Page object name
	var $PageObjName = 'user_levels_edit';

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
	function cuser_levels_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $user_levels;

		// Load key from QueryString
		if (@$_GET["UserLevelID"] <> "")
			$user_levels->UserLevelID->setQueryStringValue($_GET["UserLevelID"]);
		if (@$_POST["a_edit"] <> "") {
			$user_levels->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$user_levels->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$user_levels->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$user_levels->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($user_levels->UserLevelID->CurrentValue == "")
			$this->Page_Terminate("user_levelslist.php"); // Invalid key, return to list
		switch ($user_levels->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("user_levelslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$user_levels->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $user_levels->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$user_levels->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$user_levels->RowType = EW_ROWTYPE_EDIT; // Render as Edit
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

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $user_levels;
		if (!$user_levels->UserLevelID->FldIsDetailKey)
			$user_levels->UserLevelID->setFormValue($objForm->GetValue("x_UserLevelID"));
		if (!$user_levels->UserLevelName->FldIsDetailKey) {
			$user_levels->UserLevelName->setFormValue($objForm->GetValue("x_UserLevelName"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $user_levels;
		$this->LoadRow();
		$user_levels->UserLevelID->CurrentValue = $user_levels->UserLevelID->FormValue;
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
		} elseif ($user_levels->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// UserLevelID
			$user_levels->UserLevelID->EditCustomAttributes = "";
			$user_levels->UserLevelID->EditValue = $user_levels->UserLevelID->CurrentValue;
			$user_levels->UserLevelID->ViewCustomAttributes = "";

			// UserLevelName
			$user_levels->UserLevelName->EditCustomAttributes = "";
			$user_levels->UserLevelName->EditValue = ew_HtmlEncode($user_levels->UserLevelName->CurrentValue);

			// Edit refer script
			// UserLevelID

			$user_levels->UserLevelID->HrefValue = "";

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $user_levels;
		$sFilter = $user_levels->KeyFilter();
		$user_levels->CurrentFilter = $sFilter;
		$sSql = $user_levels->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// UserLevelName
			$user_levels->UserLevelName->SetDbValueDef($rsnew, $user_levels->UserLevelName->CurrentValue, NULL, $user_levels->UserLevelName->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $user_levels->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($user_levels->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($user_levels->CancelMessage <> "") {
					$this->setFailureMessage($user_levels->CancelMessage);
					$user_levels->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$user_levels->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
