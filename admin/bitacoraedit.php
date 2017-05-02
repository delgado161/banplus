<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "bitacorainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$bitacora_edit = new cbitacora_edit();
$Page =& $bitacora_edit;

// Page init
$bitacora_edit->Page_Init();

// Page main
$bitacora_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var bitacora_edit = new ew_Page("bitacora_edit");

// page properties
bitacora_edit.PageID = "edit"; // page ID
bitacora_edit.FormID = "fbitacoraedit"; // form ID
var EW_PAGE_ID = bitacora_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
bitacora_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bitacora->fecha->FldErrMsg()) ?>");

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
bitacora_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
bitacora_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
bitacora_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $bitacora->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $bitacora->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $bitacora_edit->ShowPageHeader(); ?>
<?php
$bitacora_edit->ShowMessage();
?>
<form name="fbitacoraedit" id="fbitacoraedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return bitacora_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="bitacora">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($bitacora->id_bitacora->Visible) { // id_bitacora ?>
	<tr id="r_id_bitacora"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->id_bitacora->FldCaption() ?></td>
		<td<?php echo $bitacora->id_bitacora->CellAttributes() ?>><span id="el_id_bitacora">
<div<?php echo $bitacora->id_bitacora->ViewAttributes() ?>><?php echo $bitacora->id_bitacora->EditValue ?></div>
<input type="hidden" name="x_id_bitacora" id="x_id_bitacora" value="<?php echo ew_HtmlEncode($bitacora->id_bitacora->CurrentValue) ?>">
</span><?php echo $bitacora->id_bitacora->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bitacora->valor_anterior->Visible) { // valor_anterior ?>
	<tr id="r_valor_anterior"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->valor_anterior->FldCaption() ?></td>
		<td<?php echo $bitacora->valor_anterior->CellAttributes() ?>><span id="el_valor_anterior">
<textarea name="x_valor_anterior" id="x_valor_anterior" cols="35" rows="4"<?php echo $bitacora->valor_anterior->EditAttributes() ?>><?php echo $bitacora->valor_anterior->EditValue ?></textarea>
</span><?php echo $bitacora->valor_anterior->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bitacora->valor_nuevo->Visible) { // valor_nuevo ?>
	<tr id="r_valor_nuevo"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->valor_nuevo->FldCaption() ?></td>
		<td<?php echo $bitacora->valor_nuevo->CellAttributes() ?>><span id="el_valor_nuevo">
<textarea name="x_valor_nuevo" id="x_valor_nuevo" cols="35" rows="4"<?php echo $bitacora->valor_nuevo->EditAttributes() ?>><?php echo $bitacora->valor_nuevo->EditValue ?></textarea>
</span><?php echo $bitacora->valor_nuevo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bitacora->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->fecha->FldCaption() ?></td>
		<td<?php echo $bitacora->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha" value="<?php echo $bitacora->fecha->EditValue ?>"<?php echo $bitacora->fecha->EditAttributes() ?>>
</span><?php echo $bitacora->fecha->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bitacora->usuario->Visible) { // usuario ?>
	<tr id="r_usuario"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->usuario->FldCaption() ?></td>
		<td<?php echo $bitacora->usuario->CellAttributes() ?>><span id="el_usuario">
<input type="text" name="x_usuario" id="x_usuario" size="30" maxlength="45" value="<?php echo $bitacora->usuario->EditValue ?>"<?php echo $bitacora->usuario->EditAttributes() ?>>
</span><?php echo $bitacora->usuario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bitacora->accion->Visible) { // accion ?>
	<tr id="r_accion"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->accion->FldCaption() ?></td>
		<td<?php echo $bitacora->accion->CellAttributes() ?>><span id="el_accion">
<input type="text" name="x_accion" id="x_accion" size="30" maxlength="45" value="<?php echo $bitacora->accion->EditValue ?>"<?php echo $bitacora->accion->EditAttributes() ?>>
</span><?php echo $bitacora->accion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bitacora->formulario->Visible) { // formulario ?>
	<tr id="r_formulario"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->formulario->FldCaption() ?></td>
		<td<?php echo $bitacora->formulario->CellAttributes() ?>><span id="el_formulario">
<input type="text" name="x_formulario" id="x_formulario" size="30" maxlength="45" value="<?php echo $bitacora->formulario->EditValue ?>"<?php echo $bitacora->formulario->EditAttributes() ?>>
</span><?php echo $bitacora->formulario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bitacora->campos->Visible) { // campos ?>
	<tr id="r_campos"<?php echo $bitacora->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $bitacora->campos->FldCaption() ?></td>
		<td<?php echo $bitacora->campos->CellAttributes() ?>><span id="el_campos">
<textarea name="x_campos" id="x_campos" cols="35" rows="4"<?php echo $bitacora->campos->EditAttributes() ?>><?php echo $bitacora->campos->EditValue ?></textarea>
</span><?php echo $bitacora->campos->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$bitacora_edit->ShowPageFooter();
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
$bitacora_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cbitacora_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'bitacora';

	// Page object name
	var $PageObjName = 'bitacora_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $bitacora;
		if ($bitacora->UseTokenInUrl) $PageUrl .= "t=" . $bitacora->TableVar . "&"; // Add page token
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
		global $objForm, $bitacora;
		if ($bitacora->UseTokenInUrl) {
			if ($objForm)
				return ($bitacora->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($bitacora->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbitacora_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (bitacora)
		if (!isset($GLOBALS["bitacora"])) {
			$GLOBALS["bitacora"] = new cbitacora();
			$GLOBALS["Table"] =& $GLOBALS["bitacora"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'bitacora', TRUE);

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
		global $bitacora;

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
			$this->Page_Terminate("bitacoralist.php");
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
		global $objForm, $Language, $gsFormError, $bitacora;

		// Load key from QueryString
		if (@$_GET["id_bitacora"] <> "")
			$bitacora->id_bitacora->setQueryStringValue($_GET["id_bitacora"]);
		if (@$_POST["a_edit"] <> "") {
			$bitacora->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$bitacora->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$bitacora->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$bitacora->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($bitacora->id_bitacora->CurrentValue == "")
			$this->Page_Terminate("bitacoralist.php"); // Invalid key, return to list
		switch ($bitacora->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("bitacoralist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$bitacora->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $bitacora->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$bitacora->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$bitacora->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$bitacora->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $bitacora;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $bitacora;
		if (!$bitacora->id_bitacora->FldIsDetailKey)
			$bitacora->id_bitacora->setFormValue($objForm->GetValue("x_id_bitacora"));
		if (!$bitacora->valor_anterior->FldIsDetailKey) {
			$bitacora->valor_anterior->setFormValue($objForm->GetValue("x_valor_anterior"));
		}
		if (!$bitacora->valor_nuevo->FldIsDetailKey) {
			$bitacora->valor_nuevo->setFormValue($objForm->GetValue("x_valor_nuevo"));
		}
		if (!$bitacora->fecha->FldIsDetailKey) {
			$bitacora->fecha->setFormValue($objForm->GetValue("x_fecha"));
			$bitacora->fecha->CurrentValue = ew_UnFormatDateTime($bitacora->fecha->CurrentValue, 7);
		}
		if (!$bitacora->usuario->FldIsDetailKey) {
			$bitacora->usuario->setFormValue($objForm->GetValue("x_usuario"));
		}
		if (!$bitacora->accion->FldIsDetailKey) {
			$bitacora->accion->setFormValue($objForm->GetValue("x_accion"));
		}
		if (!$bitacora->formulario->FldIsDetailKey) {
			$bitacora->formulario->setFormValue($objForm->GetValue("x_formulario"));
		}
		if (!$bitacora->campos->FldIsDetailKey) {
			$bitacora->campos->setFormValue($objForm->GetValue("x_campos"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $bitacora;
		$this->LoadRow();
		$bitacora->id_bitacora->CurrentValue = $bitacora->id_bitacora->FormValue;
		$bitacora->valor_anterior->CurrentValue = $bitacora->valor_anterior->FormValue;
		$bitacora->valor_nuevo->CurrentValue = $bitacora->valor_nuevo->FormValue;
		$bitacora->fecha->CurrentValue = $bitacora->fecha->FormValue;
		$bitacora->fecha->CurrentValue = ew_UnFormatDateTime($bitacora->fecha->CurrentValue, 7);
		$bitacora->usuario->CurrentValue = $bitacora->usuario->FormValue;
		$bitacora->accion->CurrentValue = $bitacora->accion->FormValue;
		$bitacora->formulario->CurrentValue = $bitacora->formulario->FormValue;
		$bitacora->campos->CurrentValue = $bitacora->campos->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $bitacora;
		$sFilter = $bitacora->KeyFilter();

		// Call Row Selecting event
		$bitacora->Row_Selecting($sFilter);

		// Load SQL based on filter
		$bitacora->CurrentFilter = $sFilter;
		$sSql = $bitacora->SQL();
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
		global $conn, $bitacora;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$bitacora->Row_Selected($row);
		$bitacora->id_bitacora->setDbValue($rs->fields('id_bitacora'));
		$bitacora->valor_anterior->setDbValue($rs->fields('valor_anterior'));
		$bitacora->valor_nuevo->setDbValue($rs->fields('valor_nuevo'));
		$bitacora->fecha->setDbValue($rs->fields('fecha'));
		$bitacora->usuario->setDbValue($rs->fields('usuario'));
		$bitacora->accion->setDbValue($rs->fields('accion'));
		$bitacora->formulario->setDbValue($rs->fields('formulario'));
		$bitacora->campos->setDbValue($rs->fields('campos'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $bitacora;

		// Initialize URLs
		// Call Row_Rendering event

		$bitacora->Row_Rendering();

		// Common render codes for all row types
		// id_bitacora
		// valor_anterior
		// valor_nuevo
		// fecha
		// usuario
		// accion
		// formulario
		// campos

		if ($bitacora->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_bitacora
			$bitacora->id_bitacora->ViewValue = $bitacora->id_bitacora->CurrentValue;
			$bitacora->id_bitacora->ViewCustomAttributes = "";

			// valor_anterior
			$bitacora->valor_anterior->ViewValue = $bitacora->valor_anterior->CurrentValue;
			$bitacora->valor_anterior->ViewCustomAttributes = "";

			// valor_nuevo
			$bitacora->valor_nuevo->ViewValue = $bitacora->valor_nuevo->CurrentValue;
			$bitacora->valor_nuevo->ViewCustomAttributes = "";

			// fecha
			$bitacora->fecha->ViewValue = $bitacora->fecha->CurrentValue;
			$bitacora->fecha->ViewValue = ew_FormatDateTime($bitacora->fecha->ViewValue, 7);
			$bitacora->fecha->ViewCustomAttributes = "";

			// usuario
			$bitacora->usuario->ViewValue = $bitacora->usuario->CurrentValue;
			$bitacora->usuario->ViewCustomAttributes = "";

			// accion
			$bitacora->accion->ViewValue = $bitacora->accion->CurrentValue;
			$bitacora->accion->ViewCustomAttributes = "";

			// formulario
			$bitacora->formulario->ViewValue = $bitacora->formulario->CurrentValue;
			$bitacora->formulario->ViewCustomAttributes = "";

			// campos
			$bitacora->campos->ViewValue = $bitacora->campos->CurrentValue;
			$bitacora->campos->ViewCustomAttributes = "";

			// id_bitacora
			$bitacora->id_bitacora->LinkCustomAttributes = "";
			$bitacora->id_bitacora->HrefValue = "";
			$bitacora->id_bitacora->TooltipValue = "";

			// valor_anterior
			$bitacora->valor_anterior->LinkCustomAttributes = "";
			$bitacora->valor_anterior->HrefValue = "";
			$bitacora->valor_anterior->TooltipValue = "";

			// valor_nuevo
			$bitacora->valor_nuevo->LinkCustomAttributes = "";
			$bitacora->valor_nuevo->HrefValue = "";
			$bitacora->valor_nuevo->TooltipValue = "";

			// fecha
			$bitacora->fecha->LinkCustomAttributes = "";
			$bitacora->fecha->HrefValue = "";
			$bitacora->fecha->TooltipValue = "";

			// usuario
			$bitacora->usuario->LinkCustomAttributes = "";
			$bitacora->usuario->HrefValue = "";
			$bitacora->usuario->TooltipValue = "";

			// accion
			$bitacora->accion->LinkCustomAttributes = "";
			$bitacora->accion->HrefValue = "";
			$bitacora->accion->TooltipValue = "";

			// formulario
			$bitacora->formulario->LinkCustomAttributes = "";
			$bitacora->formulario->HrefValue = "";
			$bitacora->formulario->TooltipValue = "";

			// campos
			$bitacora->campos->LinkCustomAttributes = "";
			$bitacora->campos->HrefValue = "";
			$bitacora->campos->TooltipValue = "";
		} elseif ($bitacora->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_bitacora
			$bitacora->id_bitacora->EditCustomAttributes = "";
			$bitacora->id_bitacora->EditValue = $bitacora->id_bitacora->CurrentValue;
			$bitacora->id_bitacora->ViewCustomAttributes = "";

			// valor_anterior
			$bitacora->valor_anterior->EditCustomAttributes = "";
			$bitacora->valor_anterior->EditValue = ew_HtmlEncode($bitacora->valor_anterior->CurrentValue);

			// valor_nuevo
			$bitacora->valor_nuevo->EditCustomAttributes = "";
			$bitacora->valor_nuevo->EditValue = ew_HtmlEncode($bitacora->valor_nuevo->CurrentValue);

			// fecha
			$bitacora->fecha->EditCustomAttributes = "";
			$bitacora->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($bitacora->fecha->CurrentValue, 7));

			// usuario
			$bitacora->usuario->EditCustomAttributes = "";
			$bitacora->usuario->EditValue = ew_HtmlEncode($bitacora->usuario->CurrentValue);

			// accion
			$bitacora->accion->EditCustomAttributes = "";
			$bitacora->accion->EditValue = ew_HtmlEncode($bitacora->accion->CurrentValue);

			// formulario
			$bitacora->formulario->EditCustomAttributes = "";
			$bitacora->formulario->EditValue = ew_HtmlEncode($bitacora->formulario->CurrentValue);

			// campos
			$bitacora->campos->EditCustomAttributes = "";
			$bitacora->campos->EditValue = ew_HtmlEncode($bitacora->campos->CurrentValue);

			// Edit refer script
			// id_bitacora

			$bitacora->id_bitacora->HrefValue = "";

			// valor_anterior
			$bitacora->valor_anterior->HrefValue = "";

			// valor_nuevo
			$bitacora->valor_nuevo->HrefValue = "";

			// fecha
			$bitacora->fecha->HrefValue = "";

			// usuario
			$bitacora->usuario->HrefValue = "";

			// accion
			$bitacora->accion->HrefValue = "";

			// formulario
			$bitacora->formulario->HrefValue = "";

			// campos
			$bitacora->campos->HrefValue = "";
		}
		if ($bitacora->RowType == EW_ROWTYPE_ADD ||
			$bitacora->RowType == EW_ROWTYPE_EDIT ||
			$bitacora->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$bitacora->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($bitacora->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$bitacora->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $bitacora;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckEuroDate($bitacora->fecha->FormValue)) {
			ew_AddMessage($gsFormError, $bitacora->fecha->FldErrMsg());
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
		global $conn, $Security, $Language, $bitacora;
		$sFilter = $bitacora->KeyFilter();
		$bitacora->CurrentFilter = $sFilter;
		$sSql = $bitacora->SQL();
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

			// valor_anterior
			$bitacora->valor_anterior->SetDbValueDef($rsnew, $bitacora->valor_anterior->CurrentValue, NULL, $bitacora->valor_anterior->ReadOnly);

			// valor_nuevo
			$bitacora->valor_nuevo->SetDbValueDef($rsnew, $bitacora->valor_nuevo->CurrentValue, NULL, $bitacora->valor_nuevo->ReadOnly);

			// fecha
			$bitacora->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($bitacora->fecha->CurrentValue, 7), NULL, $bitacora->fecha->ReadOnly);

			// usuario
			$bitacora->usuario->SetDbValueDef($rsnew, $bitacora->usuario->CurrentValue, NULL, $bitacora->usuario->ReadOnly);

			// accion
			$bitacora->accion->SetDbValueDef($rsnew, $bitacora->accion->CurrentValue, NULL, $bitacora->accion->ReadOnly);

			// formulario
			$bitacora->formulario->SetDbValueDef($rsnew, $bitacora->formulario->CurrentValue, NULL, $bitacora->formulario->ReadOnly);

			// campos
			$bitacora->campos->SetDbValueDef($rsnew, $bitacora->campos->CurrentValue, NULL, $bitacora->campos->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $bitacora->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($bitacora->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($bitacora->CancelMessage <> "") {
					$this->setFailureMessage($bitacora->CancelMessage);
					$bitacora->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$bitacora->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'bitacora';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $bitacora;
		$table = 'bitacora';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_bitacora'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($bitacora->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($bitacora->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($bitacora->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($bitacora->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
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
