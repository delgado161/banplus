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
$documentos_add = new cdocumentos_add();
$Page =& $documentos_add;

// Page init
$documentos_add->Page_Init();

// Page main
$documentos_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_add = new ew_Page("documentos_add");

// page properties
documentos_add.PageID = "add"; // page ID
documentos_add.FormID = "fdocumentosadd"; // form ID
var EW_PAGE_ID = documentos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
documentos_add.ValidateForm = function(fobj) {
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
		
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documentos->fecha->FldErrMsg()) ?>");
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
documentos_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $documentos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $documentos_add->ShowPageHeader(); ?>
<?php
$documentos_add->ShowMessage();
?>
<form name="fdocumentosadd" id="fdocumentosadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return documentos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="documentos">
<input type="hidden" name="a_add" id="a_add" value="A">
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
<input type="text" name="x_fecha" id="x_fecha" size="12" maxlength="12" value="<?php echo $documentos->fecha->EditValue ?>"<?php echo $documentos->fecha->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_fecha" name="cal_x_fecha" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_fecha", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_fecha" // button id
});
</script>
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
<p>
<?php if ($documentos->getCurrentDetailTable() == "documentos_secciones" && $documentos_secciones->DetailAdd) { ?>
<br>
<?php include_once "documentos_seccionesgrid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$documentos_add->ShowPageFooter();
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
$documentos_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumentos_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'documentos';

	// Page object name
	var $PageObjName = 'documentos_add';

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
	function cdocumentos_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $documentos;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$documentos->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$documentos->CurrentAction = "I"; // Form error, reset action
				$documentos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_documentos"] != "") {
				$documentos->id_documentos->setQueryStringValue($_GET["id_documentos"]);
				$documentos->setKey("id_documentos", $documentos->id_documentos->CurrentValue); // Set up key
			} else {
				$documentos->setKey("id_documentos", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$documentos->CurrentAction = "C"; // Copy record
			} else {
				$documentos->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Perform action based on action code
		switch ($documentos->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("documentoslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$documentos->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($documentos->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $documentos->getDetailUrl();
					else
						$sReturnUrl = $documentos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "documentosview.php")
						$sReturnUrl = $documentos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$documentos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$documentos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $documentos;
		$documentos->titulo->CurrentValue = NULL;
		$documentos->titulo->OldValue = $documentos->titulo->CurrentValue;
		$documentos->sumario->CurrentValue = NULL;
		$documentos->sumario->OldValue = $documentos->sumario->CurrentValue;
		$documentos->documento->Upload->DbValue = NULL;
		$documentos->documento->OldValue = $documentos->documento->Upload->DbValue;
		$documentos->fecha->CurrentValue = ew_CurrentDate();
		$documentos->estatus->CurrentValue = NULL;
		$documentos->estatus->OldValue = $documentos->estatus->CurrentValue;
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
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $documentos;
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $documentos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($documentos->getKey("id_documentos")) <> "")
			$documentos->id_documentos->CurrentValue = $documentos->getKey("id_documentos"); // id_documentos
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$documentos->CurrentFilter = $documentos->KeyFilter();
			$sSql = $documentos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($documentos->RowType == EW_ROWTYPE_ADD) { // Add row

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
			$documentos->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($documentos->fecha->CurrentValue, 7));

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
		if (!ew_CheckEuroDate($documentos->fecha->FormValue)) {
			ew_AddMessage($gsFormError, $documentos->fecha->FldErrMsg());
		}
		if (!is_null($documentos->estatus->FormValue) && $documentos->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documentos->estatus->FldCaption());
		}

		// Validate detail grid
		if ($documentos->getCurrentDetailTable() == "documentos_secciones" && $GLOBALS["documentos_secciones"]->DetailAdd) {
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $documentos;

		// Begin transaction
		if ($documentos->getCurrentDetailTable() <> "")
			$conn->BeginTrans();
		$rsnew = array();

		// titulo
		$documentos->titulo->SetDbValueDef($rsnew, $documentos->titulo->CurrentValue, NULL, FALSE);

		// sumario
		$documentos->sumario->SetDbValueDef($rsnew, $documentos->sumario->CurrentValue, NULL, FALSE);

		// documento
		if ($documentos->documento->Upload->Action == "1") { // Keep
			if ($rsold) {
				$rsnew['documento'] = $rsold->fields['documento'];
			}
		} elseif ($documentos->documento->Upload->Action == "2" || $documentos->documento->Upload->Action == "3") { // Update/Remove
		if (is_null($documentos->documento->Upload->Value)) {
			$rsnew['documento'] = NULL;
		} else {
			$rsnew['documento'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $documentos->documento->UploadPath), $documentos->documento->Upload->FileName);
		}
		}

		// fecha
		$documentos->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($documentos->fecha->CurrentValue, 7), NULL, FALSE);

		// estatus
		$documentos->estatus->SetDbValueDef($rsnew, $documentos->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $documentos->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($documentos->documento->Upload->Value)) {
				$documentos->documento->Upload->SaveToFile($documentos->documento->UploadPath, $rsnew['documento'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($documentos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($documentos->CancelMessage <> "") {
				$this->setFailureMessage($documentos->CancelMessage);
				$documentos->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$documentos->id_documentos->setDbValue($conn->Insert_ID());
			$rsnew['id_documentos'] = $documentos->id_documentos->DbValue;
		}

		// Add detail records
		if ($AddRow) {
			if ($documentos->getCurrentDetailTable() == "documentos_secciones" && $GLOBALS["documentos_secciones"]->DetailAdd) {
				$GLOBALS["documentos_secciones"]->id_documentos->setSessionValue($documentos->id_documentos->CurrentValue); // Set master key
				$documentos_secciones_grid = new cdocumentos_secciones_grid(); // get detail page object
				$AddRow = $documentos_secciones_grid->GridInsert();
				$documentos_secciones_grid = NULL;
			}
		}

		// Commit/Rollback transaction
		if ($documentos->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$documentos->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}

		// documento
		$documentos->documento->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
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
				if ($GLOBALS["documentos_secciones"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["documentos_secciones"]->CurrentMode = "copy";
					else
						$GLOBALS["documentos_secciones"]->CurrentMode = "add";
					$GLOBALS["documentos_secciones"]->CurrentAction = "gridadd";

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

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $documentos;
		$table = 'documentos';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_documentos'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($documentos->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($documentos->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($documentos->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
