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
$bitacora_add = new cbitacora_add();
$Page =& $bitacora_add;

// Page init
$bitacora_add->Page_Init();

// Page main
$bitacora_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var bitacora_add = new ew_Page("bitacora_add");

// page properties
bitacora_add.PageID = "add"; // page ID
bitacora_add.FormID = "fbitacoraadd"; // form ID
var EW_PAGE_ID = bitacora_add.PageID; // for backward compatibility

// extend page with ValidateForm function
bitacora_add.ValidateForm = function(fobj) {
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
bitacora_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
bitacora_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
bitacora_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $bitacora->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $bitacora->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $bitacora_add->ShowPageHeader(); ?>
<?php
$bitacora_add->ShowMessage();
?>
<form name="fbitacoraadd" id="fbitacoraadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return bitacora_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="bitacora">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$bitacora_add->ShowPageFooter();
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
$bitacora_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cbitacora_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'bitacora';

	// Page object name
	var $PageObjName = 'bitacora_add';

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
	function cbitacora_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $bitacora;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$bitacora->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$bitacora->CurrentAction = "I"; // Form error, reset action
				$bitacora->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_bitacora"] != "") {
				$bitacora->id_bitacora->setQueryStringValue($_GET["id_bitacora"]);
				$bitacora->setKey("id_bitacora", $bitacora->id_bitacora->CurrentValue); // Set up key
			} else {
				$bitacora->setKey("id_bitacora", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$bitacora->CurrentAction = "C"; // Copy record
			} else {
				$bitacora->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($bitacora->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("bitacoralist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$bitacora->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $bitacora->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "bitacoraview.php")
						$sReturnUrl = $bitacora->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$bitacora->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$bitacora->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $bitacora;
		$bitacora->valor_anterior->CurrentValue = NULL;
		$bitacora->valor_anterior->OldValue = $bitacora->valor_anterior->CurrentValue;
		$bitacora->valor_nuevo->CurrentValue = NULL;
		$bitacora->valor_nuevo->OldValue = $bitacora->valor_nuevo->CurrentValue;
		$bitacora->fecha->CurrentValue = NULL;
		$bitacora->fecha->OldValue = $bitacora->fecha->CurrentValue;
		$bitacora->usuario->CurrentValue = NULL;
		$bitacora->usuario->OldValue = $bitacora->usuario->CurrentValue;
		$bitacora->accion->CurrentValue = NULL;
		$bitacora->accion->OldValue = $bitacora->accion->CurrentValue;
		$bitacora->formulario->CurrentValue = NULL;
		$bitacora->formulario->OldValue = $bitacora->formulario->CurrentValue;
		$bitacora->campos->CurrentValue = NULL;
		$bitacora->campos->OldValue = $bitacora->campos->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $bitacora;
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
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $bitacora;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($bitacora->getKey("id_bitacora")) <> "")
			$bitacora->id_bitacora->CurrentValue = $bitacora->getKey("id_bitacora"); // id_bitacora
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$bitacora->CurrentFilter = $bitacora->KeyFilter();
			$sSql = $bitacora->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($bitacora->RowType == EW_ROWTYPE_ADD) { // Add row

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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $bitacora;
		$rsnew = array();

		// valor_anterior
		$bitacora->valor_anterior->SetDbValueDef($rsnew, $bitacora->valor_anterior->CurrentValue, NULL, FALSE);

		// valor_nuevo
		$bitacora->valor_nuevo->SetDbValueDef($rsnew, $bitacora->valor_nuevo->CurrentValue, NULL, FALSE);

		// fecha
		$bitacora->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($bitacora->fecha->CurrentValue, 7), NULL, FALSE);

		// usuario
		$bitacora->usuario->SetDbValueDef($rsnew, $bitacora->usuario->CurrentValue, NULL, FALSE);

		// accion
		$bitacora->accion->SetDbValueDef($rsnew, $bitacora->accion->CurrentValue, NULL, FALSE);

		// formulario
		$bitacora->formulario->SetDbValueDef($rsnew, $bitacora->formulario->CurrentValue, NULL, FALSE);

		// campos
		$bitacora->campos->SetDbValueDef($rsnew, $bitacora->campos->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $bitacora->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($bitacora->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($bitacora->CancelMessage <> "") {
				$this->setFailureMessage($bitacora->CancelMessage);
				$bitacora->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$bitacora->id_bitacora->setDbValue($conn->Insert_ID());
			$rsnew['id_bitacora'] = $bitacora->id_bitacora->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$bitacora->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'bitacora';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $bitacora;
		$table = 'bitacora';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_bitacora'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($bitacora->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($bitacora->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($bitacora->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
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
