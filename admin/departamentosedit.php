<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "departamentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$departamentos_edit = new cdepartamentos_edit();
$Page =& $departamentos_edit;

// Page init
$departamentos_edit->Page_Init();

// Page main
$departamentos_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var departamentos_edit = new ew_Page("departamentos_edit");

// page properties
departamentos_edit.PageID = "edit"; // page ID
departamentos_edit.FormID = "fdepartamentosedit"; // form ID
var EW_PAGE_ID = departamentos_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
departamentos_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($departamentos->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($departamentos->zemail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_CheckEmail(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($departamentos->zemail->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($departamentos->estatus->FldCaption()) ?>");

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
departamentos_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
departamentos_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
departamentos_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $departamentos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $departamentos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $departamentos_edit->ShowPageHeader(); ?>
<?php
$departamentos_edit->ShowMessage();
?>
<form name="fdepartamentosedit" id="fdepartamentosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return departamentos_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="departamentos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($departamentos->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $departamentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $departamentos->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $departamentos->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="100" value="<?php echo $departamentos->nombre->EditValue ?>"<?php echo $departamentos->nombre->EditAttributes() ?>>
</span><?php echo $departamentos->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($departamentos->zemail->Visible) { // email ?>
	<tr id="r_zemail"<?php echo $departamentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $departamentos->zemail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $departamentos->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" size="50" maxlength="100" value="<?php echo $departamentos->zemail->EditValue ?>"<?php echo $departamentos->zemail->EditAttributes() ?>>
</span><?php echo $departamentos->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($departamentos->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $departamentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $departamentos->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $departamentos->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $departamentos->estatus->EditAttributes() ?>>
<?php
if (is_array($departamentos->estatus->EditValue)) {
	$arwrk = $departamentos->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($departamentos->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $departamentos->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_departamentos" id="x_id_departamentos" value="<?php echo ew_HtmlEncode($departamentos->id_departamentos->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$departamentos_edit->ShowPageFooter();
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
$departamentos_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cdepartamentos_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'departamentos';

	// Page object name
	var $PageObjName = 'departamentos_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $departamentos;
		if ($departamentos->UseTokenInUrl) $PageUrl .= "t=" . $departamentos->TableVar . "&"; // Add page token
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
		global $objForm, $departamentos;
		if ($departamentos->UseTokenInUrl) {
			if ($objForm)
				return ($departamentos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($departamentos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdepartamentos_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (departamentos)
		if (!isset($GLOBALS["departamentos"])) {
			$GLOBALS["departamentos"] = new cdepartamentos();
			$GLOBALS["Table"] =& $GLOBALS["departamentos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'departamentos', TRUE);

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
		global $departamentos;

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
			$this->Page_Terminate("departamentoslist.php");
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
		global $objForm, $Language, $gsFormError, $departamentos;

		// Load key from QueryString
		if (@$_GET["id_departamentos"] <> "")
			$departamentos->id_departamentos->setQueryStringValue($_GET["id_departamentos"]);
		if (@$_POST["a_edit"] <> "") {
			$departamentos->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$departamentos->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$departamentos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$departamentos->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($departamentos->id_departamentos->CurrentValue == "")
			$this->Page_Terminate("departamentoslist.php"); // Invalid key, return to list
		switch ($departamentos->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("departamentoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$departamentos->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $departamentos->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$departamentos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$departamentos->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$departamentos->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $departamentos;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $departamentos;
		if (!$departamentos->nombre->FldIsDetailKey) {
			$departamentos->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$departamentos->zemail->FldIsDetailKey) {
			$departamentos->zemail->setFormValue($objForm->GetValue("x_zemail"));
		}
		if (!$departamentos->estatus->FldIsDetailKey) {
			$departamentos->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$departamentos->id_departamentos->FldIsDetailKey)
			$departamentos->id_departamentos->setFormValue($objForm->GetValue("x_id_departamentos"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $departamentos;
		$this->LoadRow();
		$departamentos->id_departamentos->CurrentValue = $departamentos->id_departamentos->FormValue;
		$departamentos->nombre->CurrentValue = $departamentos->nombre->FormValue;
		$departamentos->zemail->CurrentValue = $departamentos->zemail->FormValue;
		$departamentos->estatus->CurrentValue = $departamentos->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $departamentos;
		$sFilter = $departamentos->KeyFilter();

		// Call Row Selecting event
		$departamentos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$departamentos->CurrentFilter = $sFilter;
		$sSql = $departamentos->SQL();
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
		global $conn, $departamentos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$departamentos->Row_Selected($row);
		$departamentos->id_departamentos->setDbValue($rs->fields('id_departamentos'));
		$departamentos->nombre->setDbValue($rs->fields('nombre'));
		$departamentos->zemail->setDbValue($rs->fields('email'));
		$departamentos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $departamentos;

		// Initialize URLs
		// Call Row_Rendering event

		$departamentos->Row_Rendering();

		// Common render codes for all row types
		// id_departamentos
		// nombre
		// email
		// estatus

		if ($departamentos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_departamentos
			$departamentos->id_departamentos->ViewValue = $departamentos->id_departamentos->CurrentValue;
			$departamentos->id_departamentos->ViewCustomAttributes = "";

			// nombre
			$departamentos->nombre->ViewValue = $departamentos->nombre->CurrentValue;
			$departamentos->nombre->ViewCustomAttributes = "";

			// email
			$departamentos->zemail->ViewValue = $departamentos->zemail->CurrentValue;
			$departamentos->zemail->ViewCustomAttributes = "";

			// estatus
			if (strval($departamentos->estatus->CurrentValue) <> "") {
				switch ($departamentos->estatus->CurrentValue) {
					case "1":
						$departamentos->estatus->ViewValue = $departamentos->estatus->FldTagCaption(1) <> "" ? $departamentos->estatus->FldTagCaption(1) : $departamentos->estatus->CurrentValue;
						break;
					case "0":
						$departamentos->estatus->ViewValue = $departamentos->estatus->FldTagCaption(2) <> "" ? $departamentos->estatus->FldTagCaption(2) : $departamentos->estatus->CurrentValue;
						break;
					default:
						$departamentos->estatus->ViewValue = $departamentos->estatus->CurrentValue;
				}
			} else {
				$departamentos->estatus->ViewValue = NULL;
			}
			$departamentos->estatus->ViewCustomAttributes = "";

			// nombre
			$departamentos->nombre->LinkCustomAttributes = "";
			$departamentos->nombre->HrefValue = "";
			$departamentos->nombre->TooltipValue = "";

			// email
			$departamentos->zemail->LinkCustomAttributes = "";
			$departamentos->zemail->HrefValue = "";
			$departamentos->zemail->TooltipValue = "";

			// estatus
			$departamentos->estatus->LinkCustomAttributes = "";
			$departamentos->estatus->HrefValue = "";
			$departamentos->estatus->TooltipValue = "";
		} elseif ($departamentos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$departamentos->nombre->EditCustomAttributes = "";
			$departamentos->nombre->EditValue = ew_HtmlEncode($departamentos->nombre->CurrentValue);

			// email
			$departamentos->zemail->EditCustomAttributes = "";
			$departamentos->zemail->EditValue = ew_HtmlEncode($departamentos->zemail->CurrentValue);

			// estatus
			$departamentos->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $departamentos->estatus->FldTagCaption(1) <> "" ? $departamentos->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $departamentos->estatus->FldTagCaption(2) <> "" ? $departamentos->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$departamentos->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$departamentos->nombre->HrefValue = "";

			// email
			$departamentos->zemail->HrefValue = "";

			// estatus
			$departamentos->estatus->HrefValue = "";
		}
		if ($departamentos->RowType == EW_ROWTYPE_ADD ||
			$departamentos->RowType == EW_ROWTYPE_EDIT ||
			$departamentos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$departamentos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($departamentos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$departamentos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $departamentos;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($departamentos->nombre->FormValue) && $departamentos->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $departamentos->nombre->FldCaption());
		}
		if (!is_null($departamentos->zemail->FormValue) && $departamentos->zemail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $departamentos->zemail->FldCaption());
		}
		if (!ew_CheckEmail($departamentos->zemail->FormValue)) {
			ew_AddMessage($gsFormError, $departamentos->zemail->FldErrMsg());
		}
		if (!is_null($departamentos->estatus->FormValue) && $departamentos->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $departamentos->estatus->FldCaption());
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
		global $conn, $Security, $Language, $departamentos;
		$sFilter = $departamentos->KeyFilter();
		$departamentos->CurrentFilter = $sFilter;
		$sSql = $departamentos->SQL();
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

			// nombre
			$departamentos->nombre->SetDbValueDef($rsnew, $departamentos->nombre->CurrentValue, "", $departamentos->nombre->ReadOnly);

			// email
			$departamentos->zemail->SetDbValueDef($rsnew, $departamentos->zemail->CurrentValue, "", $departamentos->zemail->ReadOnly);

			// estatus
			$departamentos->estatus->SetDbValueDef($rsnew, $departamentos->estatus->CurrentValue, 0, $departamentos->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $departamentos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($departamentos->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($departamentos->CancelMessage <> "") {
					$this->setFailureMessage($departamentos->CancelMessage);
					$departamentos->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$departamentos->Row_Updated($rsold, $rsnew);
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
