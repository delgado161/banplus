<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuario_nivelesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuario_niveles_edit = new cusuario_niveles_edit();
$Page =& $usuario_niveles_edit;

// Page init
$usuario_niveles_edit->Page_Init();

// Page main
$usuario_niveles_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuario_niveles_edit = new ew_Page("usuario_niveles_edit");

// page properties
usuario_niveles_edit.PageID = "edit"; // page ID
usuario_niveles_edit.FormID = "fusuario_nivelesedit"; // form ID
var EW_PAGE_ID = usuario_niveles_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
usuario_niveles_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuario_niveles->nombre->FldCaption()) ?>");

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
usuario_niveles_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuario_niveles_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuario_niveles_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuario_niveles->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuario_niveles->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuario_niveles_edit->ShowPageHeader(); ?>
<?php
$usuario_niveles_edit->ShowMessage();
?>
<form name="fusuario_nivelesedit" id="fusuario_nivelesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return usuario_niveles_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="usuario_niveles">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuario_niveles->UserLevelID->Visible) { // UserLevelID ?>
	<tr id="r_UserLevelID"<?php echo $usuario_niveles->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuario_niveles->UserLevelID->FldCaption() ?></td>
		<td<?php echo $usuario_niveles->UserLevelID->CellAttributes() ?>><span id="el_UserLevelID">
<div<?php echo $usuario_niveles->UserLevelID->ViewAttributes() ?>><?php echo $usuario_niveles->UserLevelID->EditValue ?></div>
<input type="hidden" name="x_UserLevelID" id="x_UserLevelID" value="<?php echo ew_HtmlEncode($usuario_niveles->UserLevelID->CurrentValue) ?>">
</span><?php echo $usuario_niveles->UserLevelID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuario_niveles->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $usuario_niveles->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuario_niveles->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuario_niveles->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $usuario_niveles->nombre->EditValue ?>"<?php echo $usuario_niveles->nombre->EditAttributes() ?>>
</span><?php echo $usuario_niveles->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$usuario_niveles_edit->ShowPageFooter();
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
$usuario_niveles_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuario_niveles_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'usuario_niveles';

	// Page object name
	var $PageObjName = 'usuario_niveles_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuario_niveles;
		if ($usuario_niveles->UseTokenInUrl) $PageUrl .= "t=" . $usuario_niveles->TableVar . "&"; // Add page token
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
		global $objForm, $usuario_niveles;
		if ($usuario_niveles->UseTokenInUrl) {
			if ($objForm)
				return ($usuario_niveles->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuario_niveles->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuario_niveles_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuario_niveles)
		if (!isset($GLOBALS["usuario_niveles"])) {
			$GLOBALS["usuario_niveles"] = new cusuario_niveles();
			$GLOBALS["Table"] =& $GLOBALS["usuario_niveles"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuario_niveles', TRUE);

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
		global $usuario_niveles;

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
		global $objForm, $Language, $gsFormError, $usuario_niveles;

		// Load key from QueryString
		if (@$_GET["UserLevelID"] <> "")
			$usuario_niveles->UserLevelID->setQueryStringValue($_GET["UserLevelID"]);
		if (@$_POST["a_edit"] <> "") {
			$usuario_niveles->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$usuario_niveles->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$usuario_niveles->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$usuario_niveles->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($usuario_niveles->UserLevelID->CurrentValue == "")
			$this->Page_Terminate("usuario_niveleslist.php"); // Invalid key, return to list
		switch ($usuario_niveles->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("usuario_niveleslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$usuario_niveles->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $usuario_niveles->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$usuario_niveles->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$usuario_niveles->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$usuario_niveles->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $usuario_niveles;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $usuario_niveles;
		if (!$usuario_niveles->UserLevelID->FldIsDetailKey) {
			$usuario_niveles->UserLevelID->setFormValue($objForm->GetValue("x_UserLevelID"));
		}
		if (!$usuario_niveles->nombre->FldIsDetailKey) {
			$usuario_niveles->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $usuario_niveles;
		$this->LoadRow();
		$usuario_niveles->UserLevelID->CurrentValue = $usuario_niveles->UserLevelID->FormValue;
		$usuario_niveles->nombre->CurrentValue = $usuario_niveles->nombre->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuario_niveles;
		$sFilter = $usuario_niveles->KeyFilter();

		// Call Row Selecting event
		$usuario_niveles->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuario_niveles->CurrentFilter = $sFilter;
		$sSql = $usuario_niveles->SQL();
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
		global $conn, $usuario_niveles;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuario_niveles->Row_Selected($row);
		$usuario_niveles->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$usuario_niveles->nombre->setDbValue($rs->fields('nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuario_niveles;

		// Initialize URLs
		// Call Row_Rendering event

		$usuario_niveles->Row_Rendering();

		// Common render codes for all row types
		// UserLevelID
		// nombre

		if ($usuario_niveles->RowType == EW_ROWTYPE_VIEW) { // View row

			// UserLevelID
			$usuario_niveles->UserLevelID->ViewValue = $usuario_niveles->UserLevelID->CurrentValue;
			$usuario_niveles->UserLevelID->ViewCustomAttributes = "";

			// nombre
			$usuario_niveles->nombre->ViewValue = $usuario_niveles->nombre->CurrentValue;
			$usuario_niveles->nombre->ViewCustomAttributes = "";

			// UserLevelID
			$usuario_niveles->UserLevelID->LinkCustomAttributes = "";
			$usuario_niveles->UserLevelID->HrefValue = "";
			$usuario_niveles->UserLevelID->TooltipValue = "";

			// nombre
			$usuario_niveles->nombre->LinkCustomAttributes = "";
			$usuario_niveles->nombre->HrefValue = "";
			$usuario_niveles->nombre->TooltipValue = "";
		} elseif ($usuario_niveles->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// UserLevelID
			$usuario_niveles->UserLevelID->EditCustomAttributes = "";
			$usuario_niveles->UserLevelID->EditValue = $usuario_niveles->UserLevelID->CurrentValue;
			$usuario_niveles->UserLevelID->ViewCustomAttributes = "";

			// nombre
			$usuario_niveles->nombre->EditCustomAttributes = "";
			$usuario_niveles->nombre->EditValue = ew_HtmlEncode($usuario_niveles->nombre->CurrentValue);

			// Edit refer script
			// UserLevelID

			$usuario_niveles->UserLevelID->HrefValue = "";

			// nombre
			$usuario_niveles->nombre->HrefValue = "";
		}
		if ($usuario_niveles->RowType == EW_ROWTYPE_ADD ||
			$usuario_niveles->RowType == EW_ROWTYPE_EDIT ||
			$usuario_niveles->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$usuario_niveles->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($usuario_niveles->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuario_niveles->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $usuario_niveles;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($usuario_niveles->nombre->FormValue) && $usuario_niveles->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuario_niveles->nombre->FldCaption());
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
		global $conn, $Security, $Language, $usuario_niveles;
		$sFilter = $usuario_niveles->KeyFilter();
		$usuario_niveles->CurrentFilter = $sFilter;
		$sSql = $usuario_niveles->SQL();
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

			// UserLevelID
			// nombre

			$usuario_niveles->nombre->SetDbValueDef($rsnew, $usuario_niveles->nombre->CurrentValue, NULL, $usuario_niveles->nombre->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $usuario_niveles->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($usuario_niveles->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($usuario_niveles->CancelMessage <> "") {
					$this->setFailureMessage($usuario_niveles->CancelMessage);
					$usuario_niveles->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$usuario_niveles->Row_Updated($rsold, $rsnew);
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
