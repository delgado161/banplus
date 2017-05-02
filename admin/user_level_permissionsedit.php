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
$user_level_permissions_edit = new cuser_level_permissions_edit();
$Page =& $user_level_permissions_edit;

// Page init
$user_level_permissions_edit->Page_Init();

// Page main
$user_level_permissions_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var user_level_permissions_edit = new ew_Page("user_level_permissions_edit");

// page properties
user_level_permissions_edit.PageID = "edit"; // page ID
user_level_permissions_edit.FormID = "fuser_level_permissionsedit"; // form ID
var EW_PAGE_ID = user_level_permissions_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
user_level_permissions_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_Permission"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($user_level_permissions->Permission->FldErrMsg()) ?>");

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
user_level_permissions_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_level_permissions_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_level_permissions_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $user_level_permissions->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $user_level_permissions->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $user_level_permissions_edit->ShowPageHeader(); ?>
<?php
$user_level_permissions_edit->ShowMessage();
?>
<form name="fuser_level_permissionsedit" id="fuser_level_permissionsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return user_level_permissions_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="user_level_permissions">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($user_level_permissions->UserLevelID->Visible) { // UserLevelID ?>
	<tr id="r_UserLevelID"<?php echo $user_level_permissions->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $user_level_permissions->UserLevelID->FldCaption() ?></td>
		<td<?php echo $user_level_permissions->UserLevelID->CellAttributes() ?>><span id="el_UserLevelID">
<div<?php echo $user_level_permissions->UserLevelID->ViewAttributes() ?>><?php echo $user_level_permissions->UserLevelID->EditValue ?></div>
<input type="hidden" name="x_UserLevelID" id="x_UserLevelID" value="<?php echo ew_HtmlEncode($user_level_permissions->UserLevelID->CurrentValue) ?>">
</span><?php echo $user_level_permissions->UserLevelID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($user_level_permissions->zTableName->Visible) { // TableName ?>
	<tr id="r_zTableName"<?php echo $user_level_permissions->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $user_level_permissions->zTableName->FldCaption() ?></td>
		<td<?php echo $user_level_permissions->zTableName->CellAttributes() ?>><span id="el_zTableName">
<input type="text" name="x_zTableName" id="x_zTableName" size="30" maxlength="45" value="<?php echo $user_level_permissions->zTableName->EditValue ?>"<?php echo $user_level_permissions->zTableName->EditAttributes() ?>>
</span><?php echo $user_level_permissions->zTableName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($user_level_permissions->Permission->Visible) { // Permission ?>
	<tr id="r_Permission"<?php echo $user_level_permissions->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $user_level_permissions->Permission->FldCaption() ?></td>
		<td<?php echo $user_level_permissions->Permission->CellAttributes() ?>><span id="el_Permission">
<input type="text" name="x_Permission" id="x_Permission" size="30" value="<?php echo $user_level_permissions->Permission->EditValue ?>"<?php echo $user_level_permissions->Permission->EditAttributes() ?>>
</span><?php echo $user_level_permissions->Permission->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$user_level_permissions_edit->ShowPageFooter();
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
$user_level_permissions_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cuser_level_permissions_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'user_level_permissions';

	// Page object name
	var $PageObjName = 'user_level_permissions_edit';

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
	function cuser_level_permissions_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("user_level_permissionslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
		global $objForm, $Language, $gsFormError, $user_level_permissions;

		// Load key from QueryString
		if (@$_GET["UserLevelID"] <> "")
			$user_level_permissions->UserLevelID->setQueryStringValue($_GET["UserLevelID"]);
		if (@$_POST["a_edit"] <> "") {
			$user_level_permissions->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$user_level_permissions->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$user_level_permissions->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$user_level_permissions->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($user_level_permissions->UserLevelID->CurrentValue == "")
			$this->Page_Terminate("user_level_permissionslist.php"); // Invalid key, return to list
		switch ($user_level_permissions->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("user_level_permissionslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$user_level_permissions->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $user_level_permissions->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$user_level_permissions->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$user_level_permissions->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$user_level_permissions->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $user_level_permissions;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $user_level_permissions;
		if (!$user_level_permissions->UserLevelID->FldIsDetailKey)
			$user_level_permissions->UserLevelID->setFormValue($objForm->GetValue("x_UserLevelID"));
		if (!$user_level_permissions->zTableName->FldIsDetailKey) {
			$user_level_permissions->zTableName->setFormValue($objForm->GetValue("x_zTableName"));
		}
		if (!$user_level_permissions->Permission->FldIsDetailKey) {
			$user_level_permissions->Permission->setFormValue($objForm->GetValue("x_Permission"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $user_level_permissions;
		$this->LoadRow();
		$user_level_permissions->UserLevelID->CurrentValue = $user_level_permissions->UserLevelID->FormValue;
		$user_level_permissions->zTableName->CurrentValue = $user_level_permissions->zTableName->FormValue;
		$user_level_permissions->Permission->CurrentValue = $user_level_permissions->Permission->FormValue;
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
		} elseif ($user_level_permissions->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// UserLevelID
			$user_level_permissions->UserLevelID->EditCustomAttributes = "";
			$user_level_permissions->UserLevelID->EditValue = $user_level_permissions->UserLevelID->CurrentValue;
			$user_level_permissions->UserLevelID->ViewCustomAttributes = "";

			// TableName
			$user_level_permissions->zTableName->EditCustomAttributes = "";
			$user_level_permissions->zTableName->EditValue = ew_HtmlEncode($user_level_permissions->zTableName->CurrentValue);

			// Permission
			$user_level_permissions->Permission->EditCustomAttributes = "";
			$user_level_permissions->Permission->EditValue = ew_HtmlEncode($user_level_permissions->Permission->CurrentValue);

			// Edit refer script
			// UserLevelID

			$user_level_permissions->UserLevelID->HrefValue = "";

			// TableName
			$user_level_permissions->zTableName->HrefValue = "";

			// Permission
			$user_level_permissions->Permission->HrefValue = "";
		}
		if ($user_level_permissions->RowType == EW_ROWTYPE_ADD ||
			$user_level_permissions->RowType == EW_ROWTYPE_EDIT ||
			$user_level_permissions->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$user_level_permissions->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($user_level_permissions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$user_level_permissions->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $user_level_permissions;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($user_level_permissions->Permission->FormValue)) {
			ew_AddMessage($gsFormError, $user_level_permissions->Permission->FldErrMsg());
		}

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
		global $conn, $Security, $Language, $user_level_permissions;
		$sFilter = $user_level_permissions->KeyFilter();
		$user_level_permissions->CurrentFilter = $sFilter;
		$sSql = $user_level_permissions->SQL();
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

			// TableName
			$user_level_permissions->zTableName->SetDbValueDef($rsnew, $user_level_permissions->zTableName->CurrentValue, NULL, $user_level_permissions->zTableName->ReadOnly);

			// Permission
			$user_level_permissions->Permission->SetDbValueDef($rsnew, $user_level_permissions->Permission->CurrentValue, NULL, $user_level_permissions->Permission->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $user_level_permissions->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($user_level_permissions->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($user_level_permissions->CancelMessage <> "") {
					$this->setFailureMessage($user_level_permissions->CancelMessage);
					$user_level_permissions->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$user_level_permissions->Row_Updated($rsold, $rsnew);
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
