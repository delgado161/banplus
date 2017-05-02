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
$nivel_academico_edit = new cnivel_academico_edit();
$Page =& $nivel_academico_edit;

// Page init
$nivel_academico_edit->Page_Init();

// Page main
$nivel_academico_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var nivel_academico_edit = new ew_Page("nivel_academico_edit");

// page properties
nivel_academico_edit.PageID = "edit"; // page ID
nivel_academico_edit.FormID = "fnivel_academicoedit"; // form ID
var EW_PAGE_ID = nivel_academico_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
nivel_academico_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_nivel"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($nivel_academico->nivel->FldCaption()) ?>");

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
nivel_academico_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
nivel_academico_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
nivel_academico_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $nivel_academico->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $nivel_academico->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $nivel_academico_edit->ShowPageHeader(); ?>
<?php
$nivel_academico_edit->ShowMessage();
?>
<form name="fnivel_academicoedit" id="fnivel_academicoedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return nivel_academico_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="nivel_academico">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($nivel_academico->nivel->Visible) { // nivel ?>
	<tr id="r_nivel"<?php echo $nivel_academico->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $nivel_academico->nivel->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $nivel_academico->nivel->CellAttributes() ?>><span id="el_nivel">
<input type="text" name="x_nivel" id="x_nivel" size="45" maxlength="45" value="<?php echo $nivel_academico->nivel->EditValue ?>"<?php echo $nivel_academico->nivel->EditAttributes() ?>>
</span><?php echo $nivel_academico->nivel->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_nivel_academico" id="x_id_nivel_academico" value="<?php echo ew_HtmlEncode($nivel_academico->id_nivel_academico->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$nivel_academico_edit->ShowPageFooter();
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
$nivel_academico_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cnivel_academico_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'nivel_academico';

	// Page object name
	var $PageObjName = 'nivel_academico_edit';

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
	function cnivel_academico_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("nivel_academicolist.php");
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
		global $objForm, $Language, $gsFormError, $nivel_academico;

		// Load key from QueryString
		if (@$_GET["id_nivel_academico"] <> "")
			$nivel_academico->id_nivel_academico->setQueryStringValue($_GET["id_nivel_academico"]);
		if (@$_POST["a_edit"] <> "") {
			$nivel_academico->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$nivel_academico->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$nivel_academico->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$nivel_academico->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($nivel_academico->id_nivel_academico->CurrentValue == "")
			$this->Page_Terminate("nivel_academicolist.php"); // Invalid key, return to list
		switch ($nivel_academico->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("nivel_academicolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$nivel_academico->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $nivel_academico->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$nivel_academico->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$nivel_academico->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$nivel_academico->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $nivel_academico;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $nivel_academico;
		if (!$nivel_academico->nivel->FldIsDetailKey) {
			$nivel_academico->nivel->setFormValue($objForm->GetValue("x_nivel"));
		}
		if (!$nivel_academico->id_nivel_academico->FldIsDetailKey)
			$nivel_academico->id_nivel_academico->setFormValue($objForm->GetValue("x_id_nivel_academico"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $nivel_academico;
		$this->LoadRow();
		$nivel_academico->id_nivel_academico->CurrentValue = $nivel_academico->id_nivel_academico->FormValue;
		$nivel_academico->nivel->CurrentValue = $nivel_academico->nivel->FormValue;
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
		// nivel

		if ($nivel_academico->RowType == EW_ROWTYPE_VIEW) { // View row

			// nivel
			$nivel_academico->nivel->ViewValue = $nivel_academico->nivel->CurrentValue;
			$nivel_academico->nivel->ViewCustomAttributes = "";

			// nivel
			$nivel_academico->nivel->LinkCustomAttributes = "";
			$nivel_academico->nivel->HrefValue = "";
			$nivel_academico->nivel->TooltipValue = "";
		} elseif ($nivel_academico->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nivel
			$nivel_academico->nivel->EditCustomAttributes = "";
			$nivel_academico->nivel->EditValue = ew_HtmlEncode($nivel_academico->nivel->CurrentValue);

			// Edit refer script
			// nivel

			$nivel_academico->nivel->HrefValue = "";
		}
		if ($nivel_academico->RowType == EW_ROWTYPE_ADD ||
			$nivel_academico->RowType == EW_ROWTYPE_EDIT ||
			$nivel_academico->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$nivel_academico->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($nivel_academico->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$nivel_academico->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $nivel_academico;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($nivel_academico->nivel->FormValue) && $nivel_academico->nivel->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $nivel_academico->nivel->FldCaption());
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
		global $conn, $Security, $Language, $nivel_academico;
		$sFilter = $nivel_academico->KeyFilter();
		$nivel_academico->CurrentFilter = $sFilter;
		$sSql = $nivel_academico->SQL();
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

			// nivel
			$nivel_academico->nivel->SetDbValueDef($rsnew, $nivel_academico->nivel->CurrentValue, "", $nivel_academico->nivel->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $nivel_academico->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($nivel_academico->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($nivel_academico->CancelMessage <> "") {
					$this->setFailureMessage($nivel_academico->CancelMessage);
					$nivel_academico->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$nivel_academico->Row_Updated($rsold, $rsnew);
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
