<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documentosinfo.php" ?>
<?php include_once "documentos_seccionesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "documentos_seccionesgridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documentos_edit = new cdocumentos_edit();
$Page =& $documentos_edit;

// Page init
$documentos_edit->Page_Init();

// Page main
$documentos_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_edit = new ew_Page("documentos_edit");

// page properties
documentos_edit.PageID = "edit"; // page ID
documentos_edit.FormID = "fdocumentosedit"; // form ID
var EW_PAGE_ID = documentos_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
documentos_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_titulo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documentos->titulo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_documento"];
		if (elm && !ew_CheckFileType2(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		
		var cadena = elm.value; 
		x = ew_ValidAcent (cadena);
		if (x>0) {alert("El archivo no tiene que llevar caracteres especiales"); return false}
		
		
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documentos->estatus->FldCaption()) ?>");

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
documentos_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 20;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {			
		var inst;			
		for (inst in CKEDITOR.instances)
			CKEDITOR.instances[inst].updateElement();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];		
		if (inst)
			inst.setData(inst.element.value);
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];	
		if (inst)
			inst.focus();
	}
}

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $documentos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $documentos_edit->ShowPageHeader(); ?>
<?php
$documentos_edit->ShowMessage();
?>
<form name="fdocumentosedit" id="fdocumentosedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return documentos_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="documentos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($documentos->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->titulo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $documentos->titulo->CellAttributes() ?>><span id="el_titulo">
<input type="text" name="x_titulo" id="x_titulo" size="100" maxlength="100" value="<?php echo $documentos->titulo->EditValue ?>"<?php echo $documentos->titulo->EditAttributes() ?>>
</span><?php echo $documentos->titulo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($documentos->sumario->Visible) { // sumario ?>
	<tr id="r_sumario"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->sumario->FldCaption() ?></td>
		<td<?php echo $documentos->sumario->CellAttributes() ?>><span id="el_sumario">
<textarea name="x_sumario" id="x_sumario" cols="0" rows="5"<?php echo $documentos->sumario->EditAttributes() ?>><?php echo $documentos->sumario->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($documentos->sumario->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x_sumario', 0*_width_multiplier, 5*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x_sumario", function() {
	var oCKeditor = CKEDITOR.replace('x_sumario', { width: 0*_width_multiplier, height: 5*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
</span><?php echo $documentos->sumario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($documentos->documento->Visible) { // documento ?>
	<tr id="r_documento"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->documento->FldCaption() ?></td>
		<td<?php echo $documentos->documento->CellAttributes() ?>><span id="el_documento">
<div id="old_x_documento">
<?php if ($documentos->documento->LinkAttributes() <> "") { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<a<?php echo $documentos->documento->LinkAttributes() ?>><?php echo $documentos->documento->EditValue ?></a>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<?php echo $documentos->documento->EditValue ?>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_documento">
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<label><input type="radio" name="a_documento" id="a_documento" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_documento" id="a_documento" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_documento" id="a_documento" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $documentos->documento->EditAttrs["onchange"] = "this.form.a_documento[2].checked=true;" . @$documentos->documento->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_documento" id="a_documento" value="3">
<?php } ?>
<input type="file" name="x_documento" id="x_documento" size="45"<?php echo $documentos->documento->EditAttributes() ?>>
</div>
</span><?php echo $documentos->documento->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($documentos->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->fecha->FldCaption() ?></td>
		<td<?php echo $documentos->fecha->CellAttributes() ?>><span id="el_fecha">
<div<?php echo $documentos->fecha->ViewAttributes() ?>><?php echo $documentos->fecha->EditValue ?></div>
<input type="hidden" name="x_fecha" id="x_fecha" value="<?php echo ew_HtmlEncode($documentos->fecha->CurrentValue) ?>">
</span><?php echo $documentos->fecha->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($documentos->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $documentos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $documentos->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $documentos->estatus->EditAttributes() ?>>
<?php
if (is_array($documentos->estatus->EditValue)) {
	$arwrk = $documentos->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $documentos->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_documentos" id="x_id_documentos" value="<?php echo ew_HtmlEncode($documentos->id_documentos->CurrentValue) ?>">
<p>
<?php if ($documentos->getCurrentDetailTable() == "documentos_secciones" && $documentos_secciones->DetailEdit) { ?>
<br>
<?php include_once "documentos_seccionesgrid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$documentos_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$documentos_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumentos_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'documentos';

	// Page object name
	var $PageObjName = 'documentos_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documentos;
		if ($documentos->UseTokenInUrl) $PageUrl .= "t=" . $documentos->TableVar . "&"; // Add page token
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
		global $objForm, $documentos;
		if ($documentos->UseTokenInUrl) {
			if ($objForm)
				return ($documentos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documentos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumentos_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documentos)
		if (!isset($GLOBALS["documentos"])) {
			$GLOBALS["documentos"] = new cdocumentos();
			$GLOBALS["Table"] =& $GLOBALS["documentos"];
		}

		// Table object (documentos_secciones)
		if (!isset($GLOBALS['documentos_secciones'])) $GLOBALS['documentos_secciones'] = new cdocumentos_secciones();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documentos', TRUE);

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
		global $documentos;

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
			$this->Page_Terminate("documentoslist.php");
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
		global $objForm, $Language, $gsFormError, $documentos;

		// Load key from QueryString
		if (@$_GET["id_documentos"] <> "")
			$documentos->id_documentos->setQueryStringValue($_GET["id_documentos"]);
		if (@$_POST["a_edit"] <> "") {
			$documentos->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$documentos->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$documentos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$documentos->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($documentos->id_documentos->CurrentValue == "")
			$this->Page_Terminate("documentoslist.php"); // Invalid key, return to list

		// Set up detail parameters
		$this->SetUpDetailParms();
		switch ($documentos->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("documentoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$documentos->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					if ($documentos->getCurrentDetailTable() <> "") // Master/detail edit
						$sReturnUrl = $documentos->getDetailUrl();
					else
						$sReturnUrl = $documentos->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$documentos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$documentos->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$documentos->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $documentos;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$documentos->documento->Upload->Index = $objForm->Index;
		$documentos->documento->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$documentos->documento->Upload->RestoreFromSession();
		} else {
			if ($documentos->documento->Upload->UploadFile()) {

				// No action required
			} else {
				echo $documentos->documento->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$documentos->documento->Upload->SaveToSession();
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $documentos;
		$this->GetUploadFiles(); // Get upload files
		if (!$documentos->titulo->FldIsDetailKey) {
			$documentos->titulo->setFormValue($objForm->GetValue("x_titulo"));
		}
		if (!$documentos->sumario->FldIsDetailKey) {
			$documentos->sumario->setFormValue($objForm->GetValue("x_sumario"));
		}
		if (!$documentos->fecha->FldIsDetailKey) {
			$documentos->fecha->setFormValue($objForm->GetValue("x_fecha"));
			$documentos->fecha->CurrentValue = ew_UnFormatDateTime($documentos->fecha->CurrentValue, 7);
		}
		if (!$documentos->estatus->FldIsDetailKey) {
			$documentos->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$documentos->id_documentos->FldIsDetailKey)
			$documentos->id_documentos->setFormValue($objForm->GetValue("x_id_documentos"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $documentos;
		$this->LoadRow();
		$documentos->id_documentos->CurrentValue = $documentos->id_documentos->FormValue;
		$documentos->titulo->CurrentValue = $documentos->titulo->FormValue;
		$documentos->sumario->CurrentValue = $documentos->sumario->FormValue;
		$documentos->fecha->CurrentValue = $documentos->fecha->FormValue;
		$documentos->fecha->CurrentValue = ew_UnFormatDateTime($documentos->fecha->CurrentValue, 7);
		$documentos->estatus->CurrentValue = $documentos->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documentos;
		$sFilter = $documentos->KeyFilter();

		// Call Row Selecting event
		$documentos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documentos->CurrentFilter = $sFilter;
		$sSql = $documentos->SQL();
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
		global $conn, $documentos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documentos->Row_Selected($row);
		$documentos->id_documentos->setDbValue($rs->fields('id_documentos'));
		$documentos->titulo->setDbValue($rs->fields('titulo'));
		$documentos->sumario->setDbValue($rs->fields('sumario'));
		$documentos->documento->Upload->DbValue = $rs->fields('documento');
		$documentos->fecha->setDbValue($rs->fields('fecha'));
		$documentos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documentos;

		// Initialize URLs
		// Call Row_Rendering event

		$documentos->Row_Rendering();

		// Common render codes for all row types
		// id_documentos
		// titulo
		// sumario
		// documento
		// fecha
		// estatus

		if ($documentos->RowType == EW_ROWTYPE_VIEW) { // View row

			// titulo
			$documentos->titulo->ViewValue = $documentos->titulo->CurrentValue;
			$documentos->titulo->ViewCustomAttributes = "";

			// sumario
			$documentos->sumario->ViewValue = $documentos->sumario->CurrentValue;
			$documentos->sumario->ViewCustomAttributes = "";

			// documento
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->ViewValue = $documentos->documento->Upload->DbValue;
			} else {
				$documentos->documento->ViewValue = "";
			}
			$documentos->documento->ViewCustomAttributes = "";

			// fecha
			$documentos->fecha->ViewValue = $documentos->fecha->CurrentValue;
			$documentos->fecha->ViewValue = ew_FormatDateTime($documentos->fecha->ViewValue, 7);
			$documentos->fecha->ViewCustomAttributes = "";

			// estatus
			if (strval($documentos->estatus->CurrentValue) <> "") {
				switch ($documentos->estatus->CurrentValue) {
					case "1":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(1) <> "" ? $documentos->estatus->FldTagCaption(1) : $documentos->estatus->CurrentValue;
						break;
					case "0":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(2) <> "" ? $documentos->estatus->FldTagCaption(2) : $documentos->estatus->CurrentValue;
						break;
					case "3":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(3) <> "" ? $documentos->estatus->FldTagCaption(3) : $documentos->estatus->CurrentValue;
						break;
					case "4":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(4) <> "" ? $documentos->estatus->FldTagCaption(4) : $documentos->estatus->CurrentValue;
						break;
					default:
						$documentos->estatus->ViewValue = $documentos->estatus->CurrentValue;
				}
			} else {
				$documentos->estatus->ViewValue = NULL;
			}
			$documentos->estatus->ViewCustomAttributes = "";

			// titulo
			$documentos->titulo->LinkCustomAttributes = "";
			$documentos->titulo->HrefValue = "";
			$documentos->titulo->TooltipValue = "";

			// sumario
			$documentos->sumario->LinkCustomAttributes = "";
			$documentos->sumario->HrefValue = "";
			$documentos->sumario->TooltipValue = "";

			// documento
			$documentos->documento->LinkCustomAttributes = "";
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->HrefValue = ew_UploadPathEx(FALSE, $documentos->documento->UploadPath) . ((!empty($documentos->documento->ViewValue)) ? $documentos->documento->ViewValue : $documentos->documento->CurrentValue); // Add prefix/suffix
				$documentos->documento->LinkAttrs["target"] = ""; // Add target
				if ($documentos->Export <> "") $documentos->documento->HrefValue = ew_ConvertFullUrl($documentos->documento->HrefValue);
			} else {
				$documentos->documento->HrefValue = "";
			}
			$documentos->documento->TooltipValue = "";

			// fecha
			$documentos->fecha->LinkCustomAttributes = "";
			$documentos->fecha->HrefValue = "";
			$documentos->fecha->TooltipValue = "";

			// estatus
			$documentos->estatus->LinkCustomAttributes = "";
			$documentos->estatus->HrefValue = "";
			$documentos->estatus->TooltipValue = "";
		} elseif ($documentos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// titulo
			$documentos->titulo->EditCustomAttributes = "";
			$documentos->titulo->EditValue = ew_HtmlEncode($documentos->titulo->CurrentValue);

			// sumario
			$documentos->sumario->EditCustomAttributes = "";
			$documentos->sumario->EditValue = ew_HtmlEncode($documentos->sumario->CurrentValue);

			// documento
			$documentos->documento->EditCustomAttributes = "";
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->EditValue = $documentos->documento->Upload->DbValue;
			} else {
				$documentos->documento->EditValue = "";
			}

			// fecha
			$documentos->fecha->EditCustomAttributes = "";
			$documentos->fecha->EditValue = $documentos->fecha->CurrentValue;
			$documentos->fecha->EditValue = ew_FormatDateTime($documentos->fecha->EditValue, 7);
			$documentos->fecha->ViewCustomAttributes = "";

			// estatus
			$documentos->estatus->EditCustomAttributes = "";
			$arwrk = array();
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("0", $documentos->estatus->FldTagCaption(2) <> "" ? $documentos->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $documentos->estatus->FldTagCaption(3) <> "" ? $documentos->estatus->FldTagCaption(3) : "3");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $documentos->estatus->FldTagCaption(3) <> "" ? $documentos->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $documentos->estatus->FldTagCaption(4) <> "" ? $documentos->estatus->FldTagCaption(4) : "4");
			}
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $documentos->estatus->FldTagCaption(1) <> "" ? $documentos->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $documentos->estatus->FldTagCaption(4) <> "" ? $documentos->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $documentos->estatus->FldTagCaption(1) <> "" ? $documentos->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $documentos->estatus->FldTagCaption(2) <> "" ? $documentos->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $documentos->estatus->FldTagCaption(3) <> "" ? $documentos->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $documentos->estatus->FldTagCaption(4) <> "" ? $documentos->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $documentos->estatus->FldTagCaption(1) <> "" ? $documentos->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $documentos->estatus->FldTagCaption(2) <> "" ? $documentos->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $documentos->estatus->FldTagCaption(3) <> "" ? $documentos->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $documentos->estatus->FldTagCaption(4) <> "" ? $documentos->estatus->FldTagCaption(4) : "4");
			}
			
			
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$documentos->estatus->EditValue = $arwrk;

			// Edit refer script
			// titulo

			$documentos->titulo->HrefValue = "";

			// sumario
			$documentos->sumario->HrefValue = "";

			// documento
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->HrefValue = ew_UploadPathEx(FALSE, $documentos->documento->UploadPath) . ((!empty($documentos->documento->EditValue)) ? $documentos->documento->EditValue : $documentos->documento->CurrentValue); // Add prefix/suffix
				$documentos->documento->LinkAttrs["target"] = ""; // Add target
				if ($documentos->Export <> "") $documentos->documento->HrefValue = ew_ConvertFullUrl($documentos->documento->HrefValue);
			} else {
				$documentos->documento->HrefValue = "";
			}

			// fecha
			$documentos->fecha->HrefValue = "";

			// estatus
			$documentos->estatus->HrefValue = "";
		}
		if ($documentos->RowType == EW_ROWTYPE_ADD ||
			$documentos->RowType == EW_ROWTYPE_EDIT ||
			$documentos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$documentos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($documentos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documentos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $documentos;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($documentos->documento->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($documentos->documento->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $documentos->documento->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($documentos->documento->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $documentos->documento->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($documentos->titulo->FormValue) && $documentos->titulo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documentos->titulo->FldCaption());
		}
		if (!is_null($documentos->estatus->FormValue) && $documentos->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documentos->estatus->FldCaption());
		}

		// Validate detail grid
		if ($documentos->getCurrentDetailTable() == "documentos_secciones" && $GLOBALS["documentos_secciones"]->DetailEdit) {
			$documentos_secciones_grid = new cdocumentos_secciones_grid(); // get detail page object
			$documentos_secciones_grid->ValidateGridForm();
			$documentos_secciones_grid = NULL;
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
		global $conn, $Security, $Language, $documentos;
		$sFilter = $documentos->KeyFilter();
		$documentos->CurrentFilter = $sFilter;
		$sSql = $documentos->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($documentos->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// titulo
			$documentos->titulo->SetDbValueDef($rsnew, $documentos->titulo->CurrentValue, NULL, $documentos->titulo->ReadOnly);

			// sumario
			$documentos->sumario->SetDbValueDef($rsnew, $documentos->sumario->CurrentValue, NULL, $documentos->sumario->ReadOnly);

			// documento
			if ($documentos->documento->Upload->Action == "1") { // Keep
			} elseif ($documentos->documento->Upload->Action == "2" || $documentos->documento->Upload->Action == "3") { // Update/Remove
			$documentos->documento->Upload->DbValue = $rs->fields('documento'); // Get original value
			if (is_null($documentos->documento->Upload->Value)) {
				$rsnew['documento'] = NULL;
			} else {
				$rsnew['documento'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $documentos->documento->UploadPath), $documentos->documento->Upload->FileName);
			}
			}

			// estatus
			$documentos->estatus->SetDbValueDef($rsnew, $documentos->estatus->CurrentValue, NULL, $documentos->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $documentos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($documentos->documento->Upload->Value)) {
				$documentos->documento->Upload->SaveToFile($documentos->documento->UploadPath, $rsnew['documento'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($documentos->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';

				// Update detail records
				if ($EditRow) {
					if ($documentos->getCurrentDetailTable() == "documentos_secciones" && $GLOBALS["documentos_secciones"]->DetailEdit) {
						$documentos_secciones_grid = new cdocumentos_secciones_grid(); // get detail page object
						$EditRow = $documentos_secciones_grid->GridUpdate();
						$documentos_secciones_grid = NULL;
					}
				}

				// Commit/Rollback transaction
				if ($documentos->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($documentos->CancelMessage <> "") {
					$this->setFailureMessage($documentos->CancelMessage);
					$documentos->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$documentos->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// documento
		$documentos->documento->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $documentos;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$documentos->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $documentos->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "documentos_secciones") {
				if (!isset($GLOBALS["documentos_secciones"]))
					$GLOBALS["documentos_secciones"] = new cdocumentos_secciones;
				if ($GLOBALS["documentos_secciones"]->DetailEdit) {
					$GLOBALS["documentos_secciones"]->CurrentMode = "edit";
					$GLOBALS["documentos_secciones"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["documentos_secciones"]->setCurrentMasterTable($documentos->TableVar);
					$GLOBALS["documentos_secciones"]->setStartRecordNumber(1);
					$GLOBALS["documentos_secciones"]->id_documentos->FldIsDetailKey = TRUE;
					$GLOBALS["documentos_secciones"]->id_documentos->CurrentValue = $documentos->id_documentos->CurrentValue;
					$GLOBALS["documentos_secciones"]->id_documentos->setSessionValue($GLOBALS["documentos_secciones"]->id_documentos->CurrentValue);
				}
			}
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'documentos';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $documentos;
		$table = 'documentos';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_documentos'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($documentos->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($documentos->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($documentos->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($documentos->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
