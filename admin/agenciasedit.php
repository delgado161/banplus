<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "agenciasinfo.php" ?>
<?php include_once "agencias_serviciosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$agencias_edit = new cagencias_edit();
$Page =& $agencias_edit;

// Page init
$agencias_edit->Page_Init();

// Page main
$agencias_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var agencias_edit = new ew_Page("agencias_edit");

// page properties
agencias_edit.PageID = "edit"; // page ID
agencias_edit.FormID = "fagenciasedit"; // form ID
var EW_PAGE_ID = agencias_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
agencias_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_citas_diarias"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($agencias->citas_diarias->FldErrMsg()) ?>");

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
agencias_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
agencias_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
agencias_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $agencias->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $agencias->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $agencias_edit->ShowPageHeader(); ?>
<?php
$agencias_edit->ShowMessage();
?>
<form name="fagenciasedit" id="fagenciasedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return agencias_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="agencias">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($agencias->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->nombre->FldCaption() ?></td>
		<td<?php echo $agencias->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $agencias->nombre->EditValue ?>"<?php echo $agencias->nombre->EditAttributes() ?>>
</span><?php echo $agencias->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias->direccion->Visible) { // direccion ?>
	<tr id="r_direccion"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->direccion->FldCaption() ?></td>
		<td<?php echo $agencias->direccion->CellAttributes() ?>><span id="el_direccion">
<textarea name="x_direccion" id="x_direccion" cols="35" rows="4"<?php echo $agencias->direccion->EditAttributes() ?>><?php echo $agencias->direccion->EditValue ?></textarea>
</span><?php echo $agencias->direccion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias->id_ciudad->Visible) { // id_ciudad ?>
	<tr id="r_id_ciudad"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->id_ciudad->FldCaption() ?></td>
		<td<?php echo $agencias->id_ciudad->CellAttributes() ?>><span id="el_id_ciudad">
<select id="x_id_ciudad" name="x_id_ciudad"<?php echo $agencias->id_ciudad->EditAttributes() ?>>
<?php
if (is_array($agencias->id_ciudad->EditValue)) {
	$arwrk = $agencias->id_ciudad->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias->id_ciudad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $agencias->id_ciudad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias->telef_1->Visible) { // telef_1 ?>
	<tr id="r_telef_1"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->telef_1->FldCaption() ?></td>
		<td<?php echo $agencias->telef_1->CellAttributes() ?>><span id="el_telef_1">
<textarea name="x_telef_1" id="x_telef_1" cols="35" rows="4"<?php echo $agencias->telef_1->EditAttributes() ?>><?php echo $agencias->telef_1->EditValue ?></textarea>
</span><?php echo $agencias->telef_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias->horario_agencia->Visible) { // horario_agencia ?>
	<tr id="r_horario_agencia"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->horario_agencia->FldCaption() ?></td>
		<td<?php echo $agencias->horario_agencia->CellAttributes() ?>><span id="el_horario_agencia">
<textarea name="x_horario_agencia" id="x_horario_agencia" cols="35" rows="4"<?php echo $agencias->horario_agencia->EditAttributes() ?>><?php echo $agencias->horario_agencia->EditValue ?></textarea>
</span><?php echo $agencias->horario_agencia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias->horario_taq_auto->Visible) { // horario_taq_auto ?>
	<tr id="r_horario_taq_auto"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->horario_taq_auto->FldCaption() ?></td>
		<td<?php echo $agencias->horario_taq_auto->CellAttributes() ?>><span id="el_horario_taq_auto">
<input type="text" name="x_horario_taq_auto" id="x_horario_taq_auto" size="30" maxlength="45" value="<?php echo $agencias->horario_taq_auto->EditValue ?>"<?php echo $agencias->horario_taq_auto->EditAttributes() ?>>
</span><?php echo $agencias->horario_taq_auto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias->coordenadas->Visible) { // coordenadas ?>
	<tr id="r_coordenadas"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->coordenadas->FldCaption() ?></td>
		<td<?php echo $agencias->coordenadas->CellAttributes() ?>><span id="el_coordenadas">
<input type="text" name="x_coordenadas" id="x_coordenadas" size="30" maxlength="45" value="<?php echo $agencias->coordenadas->EditValue ?>"<?php echo $agencias->coordenadas->EditAttributes() ?>>
</span><?php echo $agencias->coordenadas->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias->citas_diarias->Visible) { // citas_diarias ?>
	<tr id="r_citas_diarias"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->citas_diarias->FldCaption() ?></td>
		<td<?php echo $agencias->citas_diarias->CellAttributes() ?>><span id="el_citas_diarias">
<input type="text" name="x_citas_diarias" id="x_citas_diarias" size="30" value="<?php echo $agencias->citas_diarias->EditValue ?>"<?php echo $agencias->citas_diarias->EditAttributes() ?>>
</span><?php echo $agencias->citas_diarias->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $agencias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias->estatus->FldCaption() ?></td>
		<td<?php echo $agencias->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $agencias->estatus->EditAttributes() ?>>
<?php
if (is_array($agencias->estatus->EditValue)) {
	$arwrk = $agencias->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $agencias->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_agencias" id="x_id_agencias" value="<?php echo ew_HtmlEncode($agencias->id_agencias->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$agencias_edit->ShowPageFooter();
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
$agencias_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cagencias_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'agencias';

	// Page object name
	var $PageObjName = 'agencias_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $agencias;
		if ($agencias->UseTokenInUrl) $PageUrl .= "t=" . $agencias->TableVar . "&"; // Add page token
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
		global $objForm, $agencias;
		if ($agencias->UseTokenInUrl) {
			if ($objForm)
				return ($agencias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($agencias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cagencias_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (agencias)
		if (!isset($GLOBALS["agencias"])) {
			$GLOBALS["agencias"] = new cagencias();
			$GLOBALS["Table"] =& $GLOBALS["agencias"];
		}

		// Table object (agencias_servicios)
		if (!isset($GLOBALS['agencias_servicios'])) $GLOBALS['agencias_servicios'] = new cagencias_servicios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'agencias', TRUE);

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
		global $agencias;

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
		global $objForm, $Language, $gsFormError, $agencias;

		// Load key from QueryString
		if (@$_GET["id_agencias"] <> "")
			$agencias->id_agencias->setQueryStringValue($_GET["id_agencias"]);

		// Set up master detail parameters
		$this->SetUpMasterParms();
		if (@$_POST["a_edit"] <> "") {
			$agencias->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$agencias->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$agencias->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$agencias->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($agencias->id_agencias->CurrentValue == "")
			$this->Page_Terminate("agenciaslist.php"); // Invalid key, return to list
		switch ($agencias->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("agenciaslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$agencias->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $agencias->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$agencias->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$agencias->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$agencias->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $agencias;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $agencias;
		if (!$agencias->nombre->FldIsDetailKey) {
			$agencias->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$agencias->direccion->FldIsDetailKey) {
			$agencias->direccion->setFormValue($objForm->GetValue("x_direccion"));
		}
		if (!$agencias->id_ciudad->FldIsDetailKey) {
			$agencias->id_ciudad->setFormValue($objForm->GetValue("x_id_ciudad"));
		}
		if (!$agencias->telef_1->FldIsDetailKey) {
			$agencias->telef_1->setFormValue($objForm->GetValue("x_telef_1"));
		}
		if (!$agencias->horario_agencia->FldIsDetailKey) {
			$agencias->horario_agencia->setFormValue($objForm->GetValue("x_horario_agencia"));
		}
		if (!$agencias->horario_taq_auto->FldIsDetailKey) {
			$agencias->horario_taq_auto->setFormValue($objForm->GetValue("x_horario_taq_auto"));
		}
		if (!$agencias->coordenadas->FldIsDetailKey) {
			$agencias->coordenadas->setFormValue($objForm->GetValue("x_coordenadas"));
		}
		if (!$agencias->citas_diarias->FldIsDetailKey) {
			$agencias->citas_diarias->setFormValue($objForm->GetValue("x_citas_diarias"));
		}
		if (!$agencias->estatus->FldIsDetailKey) {
			$agencias->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$agencias->id_agencias->FldIsDetailKey)
			$agencias->id_agencias->setFormValue($objForm->GetValue("x_id_agencias"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $agencias;
		$this->LoadRow();
		$agencias->id_agencias->CurrentValue = $agencias->id_agencias->FormValue;
		$agencias->nombre->CurrentValue = $agencias->nombre->FormValue;
		$agencias->direccion->CurrentValue = $agencias->direccion->FormValue;
		$agencias->id_ciudad->CurrentValue = $agencias->id_ciudad->FormValue;
		$agencias->telef_1->CurrentValue = $agencias->telef_1->FormValue;
		$agencias->horario_agencia->CurrentValue = $agencias->horario_agencia->FormValue;
		$agencias->horario_taq_auto->CurrentValue = $agencias->horario_taq_auto->FormValue;
		$agencias->coordenadas->CurrentValue = $agencias->coordenadas->FormValue;
		$agencias->citas_diarias->CurrentValue = $agencias->citas_diarias->FormValue;
		$agencias->estatus->CurrentValue = $agencias->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $agencias;
		$sFilter = $agencias->KeyFilter();

		// Call Row Selecting event
		$agencias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$agencias->CurrentFilter = $sFilter;
		$sSql = $agencias->SQL();
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
		global $conn, $agencias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$agencias->Row_Selected($row);
		$agencias->id_agencias->setDbValue($rs->fields('id_agencias'));
		$agencias->nombre->setDbValue($rs->fields('nombre'));
		$agencias->direccion->setDbValue($rs->fields('direccion'));
		$agencias->id_ciudad->setDbValue($rs->fields('id_ciudad'));
		$agencias->telef_1->setDbValue($rs->fields('telef_1'));
		$agencias->horario_agencia->setDbValue($rs->fields('horario_agencia'));
		$agencias->horario_taq_auto->setDbValue($rs->fields('horario_taq_auto'));
		$agencias->coordenadas->setDbValue($rs->fields('coordenadas'));
		$agencias->citas_diarias->setDbValue($rs->fields('citas_diarias'));
		$agencias->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $agencias;

		// Initialize URLs
		// Call Row_Rendering event

		$agencias->Row_Rendering();

		// Common render codes for all row types
		// id_agencias
		// nombre
		// direccion
		// id_ciudad
		// telef_1
		// horario_agencia
		// horario_taq_auto
		// coordenadas
		// citas_diarias
		// estatus

		if ($agencias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_agencias
			$agencias->id_agencias->ViewValue = $agencias->id_agencias->CurrentValue;
			$agencias->id_agencias->ViewCustomAttributes = "";

			// nombre
			$agencias->nombre->ViewValue = $agencias->nombre->CurrentValue;
			$agencias->nombre->ViewCustomAttributes = "";

			// direccion
			$agencias->direccion->ViewValue = $agencias->direccion->CurrentValue;
			$agencias->direccion->ViewCustomAttributes = "";

			// id_ciudad
			if (strval($agencias->id_ciudad->CurrentValue) <> "") {
				$sFilterWrk = "`id_ciudad` = " . ew_AdjustSql($agencias->id_ciudad->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `ciudad`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias->id_ciudad->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$agencias->id_ciudad->ViewValue = $agencias->id_ciudad->CurrentValue;
				}
			} else {
				$agencias->id_ciudad->ViewValue = NULL;
			}
			$agencias->id_ciudad->ViewCustomAttributes = "";

			// telef_1
			$agencias->telef_1->ViewValue = $agencias->telef_1->CurrentValue;
			$agencias->telef_1->ViewCustomAttributes = "";

			// horario_agencia
			$agencias->horario_agencia->ViewValue = $agencias->horario_agencia->CurrentValue;
			$agencias->horario_agencia->ViewCustomAttributes = "";

			// horario_taq_auto
			$agencias->horario_taq_auto->ViewValue = $agencias->horario_taq_auto->CurrentValue;
			$agencias->horario_taq_auto->ViewCustomAttributes = "";

			// coordenadas
			$agencias->coordenadas->ViewValue = $agencias->coordenadas->CurrentValue;
			$agencias->coordenadas->ViewCustomAttributes = "";

			// citas_diarias
			$agencias->citas_diarias->ViewValue = $agencias->citas_diarias->CurrentValue;
			$agencias->citas_diarias->ViewCustomAttributes = "";

			// estatus
			if (strval($agencias->estatus->CurrentValue) <> "") {
				switch ($agencias->estatus->CurrentValue) {
					case "0":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(1) <> "" ? $agencias->estatus->FldTagCaption(1) : $agencias->estatus->CurrentValue;
						break;
					case "1":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(2) <> "" ? $agencias->estatus->FldTagCaption(2) : $agencias->estatus->CurrentValue;
						break;
					case "3":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(3) <> "" ? $agencias->estatus->FldTagCaption(3) : $agencias->estatus->CurrentValue;
						break;
					case "4":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(4) <> "" ? $agencias->estatus->FldTagCaption(4) : $agencias->estatus->CurrentValue;
						break;
					default:
						$agencias->estatus->ViewValue = $agencias->estatus->CurrentValue;
				}
			} else {
				$agencias->estatus->ViewValue = NULL;
			}
			$agencias->estatus->ViewCustomAttributes = "";

			// nombre
			$agencias->nombre->LinkCustomAttributes = "";
			$agencias->nombre->HrefValue = "";
			$agencias->nombre->TooltipValue = "";

			// direccion
			$agencias->direccion->LinkCustomAttributes = "";
			$agencias->direccion->HrefValue = "";
			$agencias->direccion->TooltipValue = "";

			// id_ciudad
			$agencias->id_ciudad->LinkCustomAttributes = "";
			$agencias->id_ciudad->HrefValue = "";
			$agencias->id_ciudad->TooltipValue = "";

			// telef_1
			$agencias->telef_1->LinkCustomAttributes = "";
			$agencias->telef_1->HrefValue = "";
			$agencias->telef_1->TooltipValue = "";

			// horario_agencia
			$agencias->horario_agencia->LinkCustomAttributes = "";
			$agencias->horario_agencia->HrefValue = "";
			$agencias->horario_agencia->TooltipValue = "";

			// horario_taq_auto
			$agencias->horario_taq_auto->LinkCustomAttributes = "";
			$agencias->horario_taq_auto->HrefValue = "";
			$agencias->horario_taq_auto->TooltipValue = "";

			// coordenadas
			$agencias->coordenadas->LinkCustomAttributes = "";
			$agencias->coordenadas->HrefValue = "";
			$agencias->coordenadas->TooltipValue = "";

			// citas_diarias
			$agencias->citas_diarias->LinkCustomAttributes = "";
			$agencias->citas_diarias->HrefValue = "";
			$agencias->citas_diarias->TooltipValue = "";

			// estatus
			$agencias->estatus->LinkCustomAttributes = "";
			$agencias->estatus->HrefValue = "";
			$agencias->estatus->TooltipValue = "";
		} elseif ($agencias->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$agencias->nombre->EditCustomAttributes = "";
			$agencias->nombre->EditValue = ew_HtmlEncode($agencias->nombre->CurrentValue);

			// direccion
			$agencias->direccion->EditCustomAttributes = "";
			$agencias->direccion->EditValue = ew_HtmlEncode($agencias->direccion->CurrentValue);

			// id_ciudad
			$agencias->id_ciudad->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_ciudad`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `ciudad`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$agencias->id_ciudad->EditValue = $arwrk;

			// telef_1
			$agencias->telef_1->EditCustomAttributes = "";
			$agencias->telef_1->EditValue = ew_HtmlEncode($agencias->telef_1->CurrentValue);

			// horario_agencia
			$agencias->horario_agencia->EditCustomAttributes = "";
			$agencias->horario_agencia->EditValue = ew_HtmlEncode($agencias->horario_agencia->CurrentValue);

			// horario_taq_auto
			$agencias->horario_taq_auto->EditCustomAttributes = "";
			$agencias->horario_taq_auto->EditValue = ew_HtmlEncode($agencias->horario_taq_auto->CurrentValue);

			// coordenadas
			$agencias->coordenadas->EditCustomAttributes = "";
			$agencias->coordenadas->EditValue = ew_HtmlEncode($agencias->coordenadas->CurrentValue);

			// citas_diarias
			$agencias->citas_diarias->EditCustomAttributes = "";
			$agencias->citas_diarias->EditValue = ew_HtmlEncode($agencias->citas_diarias->CurrentValue);

			// estatus
			$agencias->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", $agencias->estatus->FldTagCaption(1) <> "" ? $agencias->estatus->FldTagCaption(1) : "0");
			$arwrk[] = array("1", $agencias->estatus->FldTagCaption(2) <> "" ? $agencias->estatus->FldTagCaption(2) : "1");
			$arwrk[] = array("3", $agencias->estatus->FldTagCaption(3) <> "" ? $agencias->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $agencias->estatus->FldTagCaption(4) <> "" ? $agencias->estatus->FldTagCaption(4) : "4");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$agencias->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$agencias->nombre->HrefValue = "";

			// direccion
			$agencias->direccion->HrefValue = "";

			// id_ciudad
			$agencias->id_ciudad->HrefValue = "";

			// telef_1
			$agencias->telef_1->HrefValue = "";

			// horario_agencia
			$agencias->horario_agencia->HrefValue = "";

			// horario_taq_auto
			$agencias->horario_taq_auto->HrefValue = "";

			// coordenadas
			$agencias->coordenadas->HrefValue = "";

			// citas_diarias
			$agencias->citas_diarias->HrefValue = "";

			// estatus
			$agencias->estatus->HrefValue = "";
		}
		if ($agencias->RowType == EW_ROWTYPE_ADD ||
			$agencias->RowType == EW_ROWTYPE_EDIT ||
			$agencias->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$agencias->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($agencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$agencias->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $agencias;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($agencias->citas_diarias->FormValue)) {
			ew_AddMessage($gsFormError, $agencias->citas_diarias->FldErrMsg());
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
		global $conn, $Security, $Language, $agencias;
		$sFilter = $agencias->KeyFilter();
		$agencias->CurrentFilter = $sFilter;
		$sSql = $agencias->SQL();
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
			$agencias->nombre->SetDbValueDef($rsnew, $agencias->nombre->CurrentValue, NULL, $agencias->nombre->ReadOnly);

			// direccion
			$agencias->direccion->SetDbValueDef($rsnew, $agencias->direccion->CurrentValue, NULL, $agencias->direccion->ReadOnly);

			// id_ciudad
			$agencias->id_ciudad->SetDbValueDef($rsnew, $agencias->id_ciudad->CurrentValue, NULL, $agencias->id_ciudad->ReadOnly);

			// telef_1
			$agencias->telef_1->SetDbValueDef($rsnew, $agencias->telef_1->CurrentValue, NULL, $agencias->telef_1->ReadOnly);

			// horario_agencia
			$agencias->horario_agencia->SetDbValueDef($rsnew, $agencias->horario_agencia->CurrentValue, NULL, $agencias->horario_agencia->ReadOnly);

			// horario_taq_auto
			$agencias->horario_taq_auto->SetDbValueDef($rsnew, $agencias->horario_taq_auto->CurrentValue, NULL, $agencias->horario_taq_auto->ReadOnly);

			// coordenadas
			$agencias->coordenadas->SetDbValueDef($rsnew, $agencias->coordenadas->CurrentValue, NULL, $agencias->coordenadas->ReadOnly);

			// citas_diarias
			$agencias->citas_diarias->SetDbValueDef($rsnew, $agencias->citas_diarias->CurrentValue, NULL, $agencias->citas_diarias->ReadOnly);

			// estatus
			$agencias->estatus->SetDbValueDef($rsnew, $agencias->estatus->CurrentValue, NULL, $agencias->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $agencias->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($agencias->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($agencias->CancelMessage <> "") {
					$this->setFailureMessage($agencias->CancelMessage);
					$agencias->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$agencias->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $agencias;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "agencias_servicios") {
				$bValidMaster = TRUE;
				if (@$_GET["id_agencias"] <> "") {
					$GLOBALS["agencias_servicios"]->id_agencias->setQueryStringValue($_GET["id_agencias"]);
					$agencias->id_agencias->setQueryStringValue($GLOBALS["agencias_servicios"]->id_agencias->QueryStringValue);
					$agencias->id_agencias->setSessionValue($agencias->id_agencias->QueryStringValue);
					if (!is_numeric($GLOBALS["agencias_servicios"]->id_agencias->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$agencias->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$agencias->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "agencias_servicios") {
				if ($agencias->id_agencias->QueryStringValue == "") $agencias->id_agencias->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $agencias->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $agencias->getDetailFilter(); // Get detail filter
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
