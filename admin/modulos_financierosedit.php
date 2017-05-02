<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modulos_financierosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$modulos_financieros_edit = new cmodulos_financieros_edit();
$Page =& $modulos_financieros_edit;

// Page init
$modulos_financieros_edit->Page_Init();

// Page main
$modulos_financieros_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var modulos_financieros_edit = new ew_Page("modulos_financieros_edit");

// page properties
modulos_financieros_edit.PageID = "edit"; // page ID
modulos_financieros_edit.FormID = "fmodulos_financierosedit"; // form ID
var EW_PAGE_ID = modulos_financieros_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
modulos_financieros_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($modulos_financieros->estatus->FldErrMsg()) ?>");

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
modulos_financieros_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
modulos_financieros_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
modulos_financieros_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $modulos_financieros->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $modulos_financieros->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $modulos_financieros_edit->ShowPageHeader(); ?>
<?php
$modulos_financieros_edit->ShowMessage();
?>
<form name="fmodulos_financierosedit" id="fmodulos_financierosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return modulos_financieros_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="modulos_financieros">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($modulos_financieros->id_modulo_financiero->Visible) { // id_modulo_financiero ?>
	<tr id="r_id_modulo_financiero"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->id_modulo_financiero->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->id_modulo_financiero->CellAttributes() ?>><span id="el_id_modulo_financiero">
<div<?php echo $modulos_financieros->id_modulo_financiero->ViewAttributes() ?>><?php echo $modulos_financieros->id_modulo_financiero->EditValue ?></div>
<input type="hidden" name="x_id_modulo_financiero" id="x_id_modulo_financiero" value="<?php echo ew_HtmlEncode($modulos_financieros->id_modulo_financiero->CurrentValue) ?>">
</span><?php echo $modulos_financieros->id_modulo_financiero->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($modulos_financieros->plantilla->Visible) { // plantilla ?>
	<tr id="r_plantilla"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->plantilla->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->plantilla->CellAttributes() ?>><span id="el_plantilla">
<input type="text" name="x_plantilla" id="x_plantilla" size="30" maxlength="45" value="<?php echo $modulos_financieros->plantilla->EditValue ?>"<?php echo $modulos_financieros->plantilla->EditAttributes() ?>>
</span><?php echo $modulos_financieros->plantilla->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($modulos_financieros->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->nombre->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $modulos_financieros->nombre->EditValue ?>"<?php echo $modulos_financieros->nombre->EditAttributes() ?>>
</span><?php echo $modulos_financieros->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($modulos_financieros->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->estatus->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->estatus->CellAttributes() ?>><span id="el_estatus">
<input type="text" name="x_estatus" id="x_estatus" size="30" value="<?php echo $modulos_financieros->estatus->EditValue ?>"<?php echo $modulos_financieros->estatus->EditAttributes() ?>>
</span><?php echo $modulos_financieros->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($modulos_financieros->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $modulos_financieros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $modulos_financieros->orden->FldCaption() ?></td>
		<td<?php echo $modulos_financieros->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" size="30" maxlength="4" value="<?php echo $modulos_financieros->orden->EditValue ?>"<?php echo $modulos_financieros->orden->EditAttributes() ?>>
</span><?php echo $modulos_financieros->orden->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$modulos_financieros_edit->ShowPageFooter();
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
$modulos_financieros_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodulos_financieros_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'modulos_financieros';

	// Page object name
	var $PageObjName = 'modulos_financieros_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $modulos_financieros;
		if ($modulos_financieros->UseTokenInUrl) $PageUrl .= "t=" . $modulos_financieros->TableVar . "&"; // Add page token
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
		global $objForm, $modulos_financieros;
		if ($modulos_financieros->UseTokenInUrl) {
			if ($objForm)
				return ($modulos_financieros->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($modulos_financieros->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodulos_financieros_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (modulos_financieros)
		if (!isset($GLOBALS["modulos_financieros"])) {
			$GLOBALS["modulos_financieros"] = new cmodulos_financieros();
			$GLOBALS["Table"] =& $GLOBALS["modulos_financieros"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'modulos_financieros', TRUE);

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
		global $modulos_financieros;

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
		global $objForm, $Language, $gsFormError, $modulos_financieros;

		// Load key from QueryString
		if (@$_GET["id_modulo_financiero"] <> "")
			$modulos_financieros->id_modulo_financiero->setQueryStringValue($_GET["id_modulo_financiero"]);
		if (@$_POST["a_edit"] <> "") {
			$modulos_financieros->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$modulos_financieros->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$modulos_financieros->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$modulos_financieros->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($modulos_financieros->id_modulo_financiero->CurrentValue == "")
			$this->Page_Terminate("modulos_financieroslist.php"); // Invalid key, return to list
		switch ($modulos_financieros->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("modulos_financieroslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$modulos_financieros->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $modulos_financieros->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$modulos_financieros->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$modulos_financieros->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$modulos_financieros->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $modulos_financieros;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $modulos_financieros;
		if (!$modulos_financieros->id_modulo_financiero->FldIsDetailKey)
			$modulos_financieros->id_modulo_financiero->setFormValue($objForm->GetValue("x_id_modulo_financiero"));
		if (!$modulos_financieros->plantilla->FldIsDetailKey) {
			$modulos_financieros->plantilla->setFormValue($objForm->GetValue("x_plantilla"));
		}
		if (!$modulos_financieros->nombre->FldIsDetailKey) {
			$modulos_financieros->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$modulos_financieros->estatus->FldIsDetailKey) {
			$modulos_financieros->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$modulos_financieros->orden->FldIsDetailKey) {
			$modulos_financieros->orden->setFormValue($objForm->GetValue("x_orden"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $modulos_financieros;
		$this->LoadRow();
		$modulos_financieros->id_modulo_financiero->CurrentValue = $modulos_financieros->id_modulo_financiero->FormValue;
		$modulos_financieros->plantilla->CurrentValue = $modulos_financieros->plantilla->FormValue;
		$modulos_financieros->nombre->CurrentValue = $modulos_financieros->nombre->FormValue;
		$modulos_financieros->estatus->CurrentValue = $modulos_financieros->estatus->FormValue;
		$modulos_financieros->orden->CurrentValue = $modulos_financieros->orden->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $modulos_financieros;
		$sFilter = $modulos_financieros->KeyFilter();

		// Call Row Selecting event
		$modulos_financieros->Row_Selecting($sFilter);

		// Load SQL based on filter
		$modulos_financieros->CurrentFilter = $sFilter;
		$sSql = $modulos_financieros->SQL();
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
		global $conn, $modulos_financieros;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$modulos_financieros->Row_Selected($row);
		$modulos_financieros->id_modulo_financiero->setDbValue($rs->fields('id_modulo_financiero'));
		$modulos_financieros->plantilla->setDbValue($rs->fields('plantilla'));
		$modulos_financieros->nombre->setDbValue($rs->fields('nombre'));
		$modulos_financieros->estatus->setDbValue($rs->fields('estatus'));
		$modulos_financieros->orden->setDbValue($rs->fields('orden'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $modulos_financieros;

		// Initialize URLs
		// Call Row_Rendering event

		$modulos_financieros->Row_Rendering();

		// Common render codes for all row types
		// id_modulo_financiero
		// plantilla
		// nombre
		// estatus
		// orden

		if ($modulos_financieros->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_modulo_financiero
			$modulos_financieros->id_modulo_financiero->ViewValue = $modulos_financieros->id_modulo_financiero->CurrentValue;
			$modulos_financieros->id_modulo_financiero->ViewCustomAttributes = "";

			// plantilla
			$modulos_financieros->plantilla->ViewValue = $modulos_financieros->plantilla->CurrentValue;
			$modulos_financieros->plantilla->ViewCustomAttributes = "";

			// nombre
			$modulos_financieros->nombre->ViewValue = $modulos_financieros->nombre->CurrentValue;
			$modulos_financieros->nombre->ViewCustomAttributes = "";

			// estatus
			$modulos_financieros->estatus->ViewValue = $modulos_financieros->estatus->CurrentValue;
			$modulos_financieros->estatus->ViewCustomAttributes = "";

			// orden
			$modulos_financieros->orden->ViewValue = $modulos_financieros->orden->CurrentValue;
			$modulos_financieros->orden->ViewCustomAttributes = "";

			// id_modulo_financiero
			$modulos_financieros->id_modulo_financiero->LinkCustomAttributes = "";
			$modulos_financieros->id_modulo_financiero->HrefValue = "";
			$modulos_financieros->id_modulo_financiero->TooltipValue = "";

			// plantilla
			$modulos_financieros->plantilla->LinkCustomAttributes = "";
			$modulos_financieros->plantilla->HrefValue = "";
			$modulos_financieros->plantilla->TooltipValue = "";

			// nombre
			$modulos_financieros->nombre->LinkCustomAttributes = "";
			$modulos_financieros->nombre->HrefValue = "";
			$modulos_financieros->nombre->TooltipValue = "";

			// estatus
			$modulos_financieros->estatus->LinkCustomAttributes = "";
			$modulos_financieros->estatus->HrefValue = "";
			$modulos_financieros->estatus->TooltipValue = "";

			// orden
			$modulos_financieros->orden->LinkCustomAttributes = "";
			$modulos_financieros->orden->HrefValue = "";
			$modulos_financieros->orden->TooltipValue = "";
		} elseif ($modulos_financieros->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_modulo_financiero
			$modulos_financieros->id_modulo_financiero->EditCustomAttributes = "";
			$modulos_financieros->id_modulo_financiero->EditValue = $modulos_financieros->id_modulo_financiero->CurrentValue;
			$modulos_financieros->id_modulo_financiero->ViewCustomAttributes = "";

			// plantilla
			$modulos_financieros->plantilla->EditCustomAttributes = "";
			$modulos_financieros->plantilla->EditValue = ew_HtmlEncode($modulos_financieros->plantilla->CurrentValue);

			// nombre
			$modulos_financieros->nombre->EditCustomAttributes = "";
			$modulos_financieros->nombre->EditValue = ew_HtmlEncode($modulos_financieros->nombre->CurrentValue);

			// estatus
			$modulos_financieros->estatus->EditCustomAttributes = "";
			$modulos_financieros->estatus->EditValue = ew_HtmlEncode($modulos_financieros->estatus->CurrentValue);

			// orden
			$modulos_financieros->orden->EditCustomAttributes = "";
			$modulos_financieros->orden->EditValue = ew_HtmlEncode($modulos_financieros->orden->CurrentValue);

			// Edit refer script
			// id_modulo_financiero

			$modulos_financieros->id_modulo_financiero->HrefValue = "";

			// plantilla
			$modulos_financieros->plantilla->HrefValue = "";

			// nombre
			$modulos_financieros->nombre->HrefValue = "";

			// estatus
			$modulos_financieros->estatus->HrefValue = "";

			// orden
			$modulos_financieros->orden->HrefValue = "";
		}
		if ($modulos_financieros->RowType == EW_ROWTYPE_ADD ||
			$modulos_financieros->RowType == EW_ROWTYPE_EDIT ||
			$modulos_financieros->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$modulos_financieros->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($modulos_financieros->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$modulos_financieros->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $modulos_financieros;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($modulos_financieros->estatus->FormValue)) {
			ew_AddMessage($gsFormError, $modulos_financieros->estatus->FldErrMsg());
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
		global $conn, $Security, $Language, $modulos_financieros;
		$sFilter = $modulos_financieros->KeyFilter();
		$modulos_financieros->CurrentFilter = $sFilter;
		$sSql = $modulos_financieros->SQL();
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

			// plantilla
			$modulos_financieros->plantilla->SetDbValueDef($rsnew, $modulos_financieros->plantilla->CurrentValue, NULL, $modulos_financieros->plantilla->ReadOnly);

			// nombre
			$modulos_financieros->nombre->SetDbValueDef($rsnew, $modulos_financieros->nombre->CurrentValue, NULL, $modulos_financieros->nombre->ReadOnly);

			// estatus
			$modulos_financieros->estatus->SetDbValueDef($rsnew, $modulos_financieros->estatus->CurrentValue, NULL, $modulos_financieros->estatus->ReadOnly);

			// orden
			$modulos_financieros->orden->SetDbValueDef($rsnew, $modulos_financieros->orden->CurrentValue, NULL, $modulos_financieros->orden->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $modulos_financieros->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($modulos_financieros->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($modulos_financieros->CancelMessage <> "") {
					$this->setFailureMessage($modulos_financieros->CancelMessage);
					$modulos_financieros->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$modulos_financieros->Row_Updated($rsold, $rsnew);
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
