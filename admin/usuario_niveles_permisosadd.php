<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuario_niveles_permisosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuario_niveles_permisos_add = new cusuario_niveles_permisos_add();
$Page =& $usuario_niveles_permisos_add;

// Page init
$usuario_niveles_permisos_add->Page_Init();

// Page main
$usuario_niveles_permisos_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuario_niveles_permisos_add = new ew_Page("usuario_niveles_permisos_add");

// page properties
usuario_niveles_permisos_add.PageID = "add"; // page ID
usuario_niveles_permisos_add.FormID = "fusuario_niveles_permisosadd"; // form ID
var EW_PAGE_ID = usuario_niveles_permisos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
usuario_niveles_permisos_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuario_niveles_permisos->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_permiso"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuario_niveles_permisos->permiso->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_permiso"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($usuario_niveles_permisos->permiso->FldErrMsg()) ?>");

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
usuario_niveles_permisos_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuario_niveles_permisos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuario_niveles_permisos_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuario_niveles_permisos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuario_niveles_permisos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuario_niveles_permisos_add->ShowPageHeader(); ?>
<?php
$usuario_niveles_permisos_add->ShowMessage();
?>
<form name="fusuario_niveles_permisosadd" id="fusuario_niveles_permisosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return usuario_niveles_permisos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="usuario_niveles_permisos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuario_niveles_permisos->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $usuario_niveles_permisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuario_niveles_permisos->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuario_niveles_permisos->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $usuario_niveles_permisos->nombre->EditValue ?>"<?php echo $usuario_niveles_permisos->nombre->EditAttributes() ?>>
</span><?php echo $usuario_niveles_permisos->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuario_niveles_permisos->permiso->Visible) { // permiso ?>
	<tr id="r_permiso"<?php echo $usuario_niveles_permisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuario_niveles_permisos->permiso->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuario_niveles_permisos->permiso->CellAttributes() ?>><span id="el_permiso">
<input type="text" name="x_permiso" id="x_permiso" size="30" value="<?php echo $usuario_niveles_permisos->permiso->EditValue ?>"<?php echo $usuario_niveles_permisos->permiso->EditAttributes() ?>>
</span><?php echo $usuario_niveles_permisos->permiso->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$usuario_niveles_permisos_add->ShowPageFooter();
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
$usuario_niveles_permisos_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuario_niveles_permisos_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'usuario_niveles_permisos';

	// Page object name
	var $PageObjName = 'usuario_niveles_permisos_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuario_niveles_permisos;
		if ($usuario_niveles_permisos->UseTokenInUrl) $PageUrl .= "t=" . $usuario_niveles_permisos->TableVar . "&"; // Add page token
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
		global $objForm, $usuario_niveles_permisos;
		if ($usuario_niveles_permisos->UseTokenInUrl) {
			if ($objForm)
				return ($usuario_niveles_permisos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuario_niveles_permisos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuario_niveles_permisos_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuario_niveles_permisos)
		if (!isset($GLOBALS["usuario_niveles_permisos"])) {
			$GLOBALS["usuario_niveles_permisos"] = new cusuario_niveles_permisos();
			$GLOBALS["Table"] =& $GLOBALS["usuario_niveles_permisos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuario_niveles_permisos', TRUE);

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
		global $usuario_niveles_permisos;

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
		global $objForm, $Language, $gsFormError, $usuario_niveles_permisos;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$usuario_niveles_permisos->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$usuario_niveles_permisos->CurrentAction = "I"; // Form error, reset action
				$usuario_niveles_permisos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_usuario_nivel_permiso"] != "") {
				$usuario_niveles_permisos->id_usuario_nivel_permiso->setQueryStringValue($_GET["id_usuario_nivel_permiso"]);
				$usuario_niveles_permisos->setKey("id_usuario_nivel_permiso", $usuario_niveles_permisos->id_usuario_nivel_permiso->CurrentValue); // Set up key
			} else {
				$usuario_niveles_permisos->setKey("id_usuario_nivel_permiso", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$usuario_niveles_permisos->CurrentAction = "C"; // Copy record
			} else {
				$usuario_niveles_permisos->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($usuario_niveles_permisos->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("usuario_niveles_permisoslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$usuario_niveles_permisos->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $usuario_niveles_permisos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "usuario_niveles_permisosview.php")
						$sReturnUrl = $usuario_niveles_permisos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$usuario_niveles_permisos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$usuario_niveles_permisos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$usuario_niveles_permisos->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $usuario_niveles_permisos;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $usuario_niveles_permisos;
		$usuario_niveles_permisos->nombre->CurrentValue = NULL;
		$usuario_niveles_permisos->nombre->OldValue = $usuario_niveles_permisos->nombre->CurrentValue;
		$usuario_niveles_permisos->permiso->CurrentValue = NULL;
		$usuario_niveles_permisos->permiso->OldValue = $usuario_niveles_permisos->permiso->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $usuario_niveles_permisos;
		if (!$usuario_niveles_permisos->nombre->FldIsDetailKey) {
			$usuario_niveles_permisos->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$usuario_niveles_permisos->permiso->FldIsDetailKey) {
			$usuario_niveles_permisos->permiso->setFormValue($objForm->GetValue("x_permiso"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $usuario_niveles_permisos;
		$this->LoadOldRecord();
		$usuario_niveles_permisos->nombre->CurrentValue = $usuario_niveles_permisos->nombre->FormValue;
		$usuario_niveles_permisos->permiso->CurrentValue = $usuario_niveles_permisos->permiso->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuario_niveles_permisos;
		$sFilter = $usuario_niveles_permisos->KeyFilter();

		// Call Row Selecting event
		$usuario_niveles_permisos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuario_niveles_permisos->CurrentFilter = $sFilter;
		$sSql = $usuario_niveles_permisos->SQL();
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
		global $conn, $usuario_niveles_permisos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuario_niveles_permisos->Row_Selected($row);
		$usuario_niveles_permisos->id_usuario_nivel_permiso->setDbValue($rs->fields('id_usuario_nivel_permiso'));
		$usuario_niveles_permisos->nombre->setDbValue($rs->fields('nombre'));
		$usuario_niveles_permisos->permiso->setDbValue($rs->fields('permiso'));
	}

	// Load old record
	function LoadOldRecord() {
		global $usuario_niveles_permisos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($usuario_niveles_permisos->getKey("id_usuario_nivel_permiso")) <> "")
			$usuario_niveles_permisos->id_usuario_nivel_permiso->CurrentValue = $usuario_niveles_permisos->getKey("id_usuario_nivel_permiso"); // id_usuario_nivel_permiso
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$usuario_niveles_permisos->CurrentFilter = $usuario_niveles_permisos->KeyFilter();
			$sSql = $usuario_niveles_permisos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuario_niveles_permisos;

		// Initialize URLs
		// Call Row_Rendering event

		$usuario_niveles_permisos->Row_Rendering();

		// Common render codes for all row types
		// id_usuario_nivel_permiso
		// nombre
		// permiso

		if ($usuario_niveles_permisos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_usuario_nivel_permiso
			$usuario_niveles_permisos->id_usuario_nivel_permiso->ViewValue = $usuario_niveles_permisos->id_usuario_nivel_permiso->CurrentValue;
			$usuario_niveles_permisos->id_usuario_nivel_permiso->ViewCustomAttributes = "";

			// nombre
			$usuario_niveles_permisos->nombre->ViewValue = $usuario_niveles_permisos->nombre->CurrentValue;
			$usuario_niveles_permisos->nombre->ViewCustomAttributes = "";

			// permiso
			$usuario_niveles_permisos->permiso->ViewValue = $usuario_niveles_permisos->permiso->CurrentValue;
			$usuario_niveles_permisos->permiso->ViewCustomAttributes = "";

			// nombre
			$usuario_niveles_permisos->nombre->LinkCustomAttributes = "";
			$usuario_niveles_permisos->nombre->HrefValue = "";
			$usuario_niveles_permisos->nombre->TooltipValue = "";

			// permiso
			$usuario_niveles_permisos->permiso->LinkCustomAttributes = "";
			$usuario_niveles_permisos->permiso->HrefValue = "";
			$usuario_niveles_permisos->permiso->TooltipValue = "";
		} elseif ($usuario_niveles_permisos->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$usuario_niveles_permisos->nombre->EditCustomAttributes = "";
			$usuario_niveles_permisos->nombre->EditValue = ew_HtmlEncode($usuario_niveles_permisos->nombre->CurrentValue);

			// permiso
			$usuario_niveles_permisos->permiso->EditCustomAttributes = "";
			$usuario_niveles_permisos->permiso->EditValue = ew_HtmlEncode($usuario_niveles_permisos->permiso->CurrentValue);

			// Edit refer script
			// nombre

			$usuario_niveles_permisos->nombre->HrefValue = "";

			// permiso
			$usuario_niveles_permisos->permiso->HrefValue = "";
		}
		if ($usuario_niveles_permisos->RowType == EW_ROWTYPE_ADD ||
			$usuario_niveles_permisos->RowType == EW_ROWTYPE_EDIT ||
			$usuario_niveles_permisos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$usuario_niveles_permisos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($usuario_niveles_permisos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuario_niveles_permisos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $usuario_niveles_permisos;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($usuario_niveles_permisos->nombre->FormValue) && $usuario_niveles_permisos->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuario_niveles_permisos->nombre->FldCaption());
		}
		if (!is_null($usuario_niveles_permisos->permiso->FormValue) && $usuario_niveles_permisos->permiso->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuario_niveles_permisos->permiso->FldCaption());
		}
		if (!ew_CheckInteger($usuario_niveles_permisos->permiso->FormValue)) {
			ew_AddMessage($gsFormError, $usuario_niveles_permisos->permiso->FldErrMsg());
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $usuario_niveles_permisos;
		$rsnew = array();

		// nombre
		$usuario_niveles_permisos->nombre->SetDbValueDef($rsnew, $usuario_niveles_permisos->nombre->CurrentValue, NULL, FALSE);

		// permiso
		$usuario_niveles_permisos->permiso->SetDbValueDef($rsnew, $usuario_niveles_permisos->permiso->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $usuario_niveles_permisos->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($usuario_niveles_permisos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($usuario_niveles_permisos->CancelMessage <> "") {
				$this->setFailureMessage($usuario_niveles_permisos->CancelMessage);
				$usuario_niveles_permisos->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$usuario_niveles_permisos->id_usuario_nivel_permiso->setDbValue($conn->Insert_ID());
			$rsnew['id_usuario_nivel_permiso'] = $usuario_niveles_permisos->id_usuario_nivel_permiso->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$usuario_niveles_permisos->Row_Inserted($rs, $rsnew);
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
