<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "contenidosinfo.php" ?>
<?php include_once "grupo_seccionesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "grupo_seccionesgridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$contenidos_add = new ccontenidos_add();
$Page =& $contenidos_add;

// Page init
$contenidos_add->Page_Init();

// Page main
$contenidos_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var contenidos_add = new ew_Page("contenidos_add");

// page properties
contenidos_add.PageID = "add"; // page ID
contenidos_add.FormID = "fcontenidosadd"; // form ID
var EW_PAGE_ID = contenidos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
contenidos_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_edicion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo "Edición" ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($contenidos->estatus->FldCaption()) ?>");

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
contenidos_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contenidos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contenidos_add.ValidateRequired = false; // no JavaScript validation
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
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $contenidos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $contenidos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $contenidos_add->ShowPageHeader(); ?>
<?php
$contenidos_add->ShowMessage();
?>
<form name="fcontenidosadd" id="fcontenidosadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return contenidos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="contenidos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($contenidos->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->titulo->FldCaption() ?></td>
		<td<?php echo $contenidos->titulo->CellAttributes() ?>><span id="el_titulo">
<input type="text" name="x_titulo" id="x_titulo" size="100" maxlength="100" value="<?php echo $contenidos->titulo->EditValue ?>"<?php echo $contenidos->titulo->EditAttributes() ?>>
</span><?php echo $contenidos->titulo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contenidos->resumen->Visible) { // resumen ?>
	<tr id="r_resumen"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->resumen->FldCaption() ?></td>
		<td<?php echo $contenidos->resumen->CellAttributes() ?>><span id="el_resumen">
<textarea name="x_resumen" id="x_resumen" cols="0" rows="3"<?php echo $contenidos->resumen->EditAttributes() ?>><?php echo $contenidos->resumen->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($contenidos->resumen->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x_resumen', 0*_width_multiplier, 3*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x_resumen", function() {
	var oCKeditor = CKEDITOR.replace('x_resumen', { width: 0*_width_multiplier, height: 3*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
</span><?php echo $contenidos->resumen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contenidos->contenido->Visible) { // contenido ?>
	<tr id="r_contenido"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->contenido->FldCaption() ?></td>
		<td<?php echo $contenidos->contenido->CellAttributes() ?>><span id="el_contenido">
<textarea name="x_contenido" id="x_contenido" cols="0" rows="5"<?php echo $contenidos->contenido->EditAttributes() ?>><?php echo $contenidos->contenido->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($contenidos->contenido->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x_contenido', 0*_width_multiplier, 5*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x_contenido", function() {
	var oCKeditor = CKEDITOR.replace('x_contenido', { width: 0*_width_multiplier, height: 5*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
</span><?php echo $contenidos->contenido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contenidos->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->imagen->FldCaption() ?></td>
		<td<?php echo $contenidos->imagen->CellAttributes() ?>><span id="el_imagen">
<div id="old_x_imagen">
<?php if ($contenidos->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($contenidos->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $contenidos->imagen->UploadPath) . $contenidos->imagen->Upload->DbValue ?>" border=0<?php echo $contenidos->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($contenidos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($contenidos->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $contenidos->imagen->UploadPath) . $contenidos->imagen->Upload->DbValue ?>" border=0<?php echo $contenidos->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($contenidos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_imagen">
<?php if (!empty($contenidos->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a_imagen" id="a_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $contenidos->imagen->EditAttrs["onchange"] = "this.form.a_imagen[2].checked=true;" . @$contenidos->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="3">
<?php } ?>
<input type="file" name="x_imagen" id="x_imagen" size="45"<?php echo $contenidos->imagen->EditAttributes() ?>>
</div>
</span><?php echo $contenidos->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contenidos->edicion->Visible) { // edicion ?>
	<tr id="r_edicion"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->edicion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $contenidos->edicion->CellAttributes() ?>><span id="el_edicion">
<select id="x_edicion" name="x_edicion"<?php echo $contenidos->edicion->EditAttributes() ?>>
<?php
if (is_array($contenidos->edicion->EditValue)) {
	$arwrk = $contenidos->edicion->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($contenidos->edicion->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $contenidos->edicion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contenidos->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $contenidos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $contenidos->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $contenidos->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $contenidos->estatus->EditAttributes() ?>>
<?php
if (is_array($contenidos->estatus->EditValue)) {
	$arwrk = $contenidos->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($contenidos->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $contenidos->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($contenidos->getCurrentDetailTable() == "grupo_secciones" && $grupo_secciones->DetailAdd) { ?>
<br>
<?php include_once "grupo_seccionesgrid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$contenidos_add->ShowPageFooter();
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
$contenidos_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccontenidos_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'contenidos';

	// Page object name
	var $PageObjName = 'contenidos_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $contenidos;
		if ($contenidos->UseTokenInUrl) $PageUrl .= "t=" . $contenidos->TableVar . "&"; // Add page token
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
		global $objForm, $contenidos;
		if ($contenidos->UseTokenInUrl) {
			if ($objForm)
				return ($contenidos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($contenidos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccontenidos_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (contenidos)
		if (!isset($GLOBALS["contenidos"])) {
			$GLOBALS["contenidos"] = new ccontenidos();
			$GLOBALS["Table"] =& $GLOBALS["contenidos"];
		}

		// Table object (grupo_secciones)
		if (!isset($GLOBALS['grupo_secciones'])) $GLOBALS['grupo_secciones'] = new cgrupo_secciones();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'contenidos', TRUE);

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
		global $contenidos;

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
			$this->Page_Terminate("contenidoslist.php");
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
		global $objForm, $Language, $gsFormError, $contenidos;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$contenidos->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$contenidos->CurrentAction = "I"; // Form error, reset action
				$contenidos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_contenido"] != "") {
				$contenidos->id_contenido->setQueryStringValue($_GET["id_contenido"]);
				$contenidos->setKey("id_contenido", $contenidos->id_contenido->CurrentValue); // Set up key
			} else {
				$contenidos->setKey("id_contenido", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$contenidos->CurrentAction = "C"; // Copy record
			} else {
				$contenidos->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Perform action based on action code
		switch ($contenidos->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("contenidoslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$contenidos->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($contenidos->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $contenidos->getDetailUrl();
					else
						$sReturnUrl = $contenidos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "contenidosview.php")
						$sReturnUrl = $contenidos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$contenidos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$contenidos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$contenidos->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $contenidos;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$contenidos->imagen->Upload->Index = $objForm->Index;
		$contenidos->imagen->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$contenidos->imagen->Upload->RestoreFromSession();
		} else {
			if ($contenidos->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $contenidos->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$contenidos->imagen->Upload->SaveToSession();
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $contenidos;
		$contenidos->titulo->CurrentValue = NULL;
		$contenidos->titulo->OldValue = $contenidos->titulo->CurrentValue;
		$contenidos->resumen->CurrentValue = NULL;
		$contenidos->resumen->OldValue = $contenidos->resumen->CurrentValue;
		$contenidos->contenido->CurrentValue = NULL;
		$contenidos->contenido->OldValue = $contenidos->contenido->CurrentValue;
		$contenidos->imagen->Upload->DbValue = NULL;
		$contenidos->imagen->OldValue = $contenidos->imagen->Upload->DbValue;
		$contenidos->edicion->CurrentValue = NULL;
		$contenidos->edicion->OldValue = $contenidos->edicion->CurrentValue;
		$contenidos->estatus->CurrentValue = NULL;
		$contenidos->estatus->OldValue = $contenidos->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $contenidos;
		$this->GetUploadFiles(); // Get upload files
		if (!$contenidos->titulo->FldIsDetailKey) {
			$contenidos->titulo->setFormValue($objForm->GetValue("x_titulo"));
		}
		if (!$contenidos->resumen->FldIsDetailKey) {
			$contenidos->resumen->setFormValue($objForm->GetValue("x_resumen"));
		}
		if (!$contenidos->contenido->FldIsDetailKey) {
			$contenidos->contenido->setFormValue($objForm->GetValue("x_contenido"));
		}
		if (!$contenidos->edicion->FldIsDetailKey) {
			$contenidos->edicion->setFormValue($objForm->GetValue("x_edicion"));
		}
		if (!$contenidos->estatus->FldIsDetailKey) {
			$contenidos->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $contenidos;
		$this->LoadOldRecord();
		$contenidos->titulo->CurrentValue = $contenidos->titulo->FormValue;
		$contenidos->resumen->CurrentValue = $contenidos->resumen->FormValue;
		$contenidos->contenido->CurrentValue = $contenidos->contenido->FormValue;
		$contenidos->edicion->CurrentValue = $contenidos->edicion->FormValue;
		$contenidos->estatus->CurrentValue = $contenidos->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $contenidos;
		$sFilter = $contenidos->KeyFilter();

		// Call Row Selecting event
		$contenidos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$contenidos->CurrentFilter = $sFilter;
		$sSql = $contenidos->SQL();
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
		global $conn, $contenidos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$contenidos->Row_Selected($row);
		$contenidos->id_contenido->setDbValue($rs->fields('id_contenido'));
		$contenidos->titulo->setDbValue($rs->fields('titulo'));
		$contenidos->resumen->setDbValue($rs->fields('resumen'));
		$contenidos->contenido->setDbValue($rs->fields('contenido'));
		$contenidos->imagen->Upload->DbValue = $rs->fields('imagen');
		$contenidos->id_herramienta_financiera->setDbValue($rs->fields('id_herramienta_financiera'));
		$contenidos->edicion->setDbValue($rs->fields('edicion'));
		$contenidos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $contenidos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($contenidos->getKey("id_contenido")) <> "")
			$contenidos->id_contenido->CurrentValue = $contenidos->getKey("id_contenido"); // id_contenido
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$contenidos->CurrentFilter = $contenidos->KeyFilter();
			$sSql = $contenidos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $contenidos;

		// Initialize URLs
		// Call Row_Rendering event

		$contenidos->Row_Rendering();

		// Common render codes for all row types
		// id_contenido
		// titulo
		// resumen
		// contenido
		// imagen
		// id_herramienta_financiera
		// edicion
		// estatus

		if ($contenidos->RowType == EW_ROWTYPE_VIEW) { // View row

			// titulo
			$contenidos->titulo->ViewValue = $contenidos->titulo->CurrentValue;
			$contenidos->titulo->ViewCustomAttributes = "";

			// resumen
			$contenidos->resumen->ViewValue = $contenidos->resumen->CurrentValue;
			$contenidos->resumen->ViewCustomAttributes = "";

			// contenido
			$contenidos->contenido->ViewValue = $contenidos->contenido->CurrentValue;
			$contenidos->contenido->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($contenidos->imagen->Upload->DbValue)) {
				$contenidos->imagen->ViewValue = $contenidos->imagen->Upload->DbValue;
				$contenidos->imagen->ImageWidth = 200;
				$contenidos->imagen->ImageHeight = 50;
				$contenidos->imagen->ImageAlt = $contenidos->imagen->FldAlt();
			} else {
				$contenidos->imagen->ViewValue = "";
			}
			$contenidos->imagen->ViewCustomAttributes = "";

			// id_herramienta_financiera
			if (strval($contenidos->id_herramienta_financiera->CurrentValue) <> "") {
				$sFilterWrk = "`id_modulo_financiero` = " . ew_AdjustSql($contenidos->id_herramienta_financiera->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `modulos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$contenidos->id_herramienta_financiera->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$contenidos->id_herramienta_financiera->ViewValue = $contenidos->id_herramienta_financiera->CurrentValue;
				}
			} else {
				$contenidos->id_herramienta_financiera->ViewValue = NULL;
			}
			$contenidos->id_herramienta_financiera->ViewCustomAttributes = "";

			// edicion
			if (strval($contenidos->edicion->CurrentValue) <> "") {
				switch ($contenidos->edicion->CurrentValue) {
					case "1":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : $contenidos->edicion->CurrentValue;
						break;
					case "2":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : $contenidos->edicion->CurrentValue;
						break;
					case "3":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : $contenidos->edicion->CurrentValue;
						break;
					case "4":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(4) <> "" ? $contenidos->edicion->FldTagCaption(4) : $contenidos->edicion->CurrentValue;
						break;
					default:
						$contenidos->edicion->ViewValue = $contenidos->edicion->CurrentValue;
				}
			} else {
				$contenidos->edicion->ViewValue = NULL;
			}
			$contenidos->edicion->ViewCustomAttributes = "";

			// estatus
			if (strval($contenidos->estatus->CurrentValue) <> "") {
				switch ($contenidos->estatus->CurrentValue) {
					case "1":
						$contenidos->estatus->ViewValue = $contenidos->estatus->FldTagCaption(1) <> "" ? $contenidos->estatus->FldTagCaption(1) : $contenidos->estatus->CurrentValue;
						break;
					case "0":
						$contenidos->estatus->ViewValue = $contenidos->estatus->FldTagCaption(2) <> "" ? $contenidos->estatus->FldTagCaption(2) : $contenidos->estatus->CurrentValue;
						break;
					default:
						$contenidos->estatus->ViewValue = $contenidos->estatus->CurrentValue;
				}
			} else {
				$contenidos->estatus->ViewValue = NULL;
			}
			$contenidos->estatus->ViewCustomAttributes = "";

			// titulo
			$contenidos->titulo->LinkCustomAttributes = "";
			$contenidos->titulo->HrefValue = "";
			$contenidos->titulo->TooltipValue = "";

			// resumen
			$contenidos->resumen->LinkCustomAttributes = "";
			$contenidos->resumen->HrefValue = "";
			$contenidos->resumen->TooltipValue = "";

			// contenido
			$contenidos->contenido->LinkCustomAttributes = "";
			$contenidos->contenido->HrefValue = "";
			$contenidos->contenido->TooltipValue = "";

			// imagen
			$contenidos->imagen->LinkCustomAttributes = "";
			$contenidos->imagen->HrefValue = "";
			$contenidos->imagen->TooltipValue = "";

			// edicion
			$contenidos->edicion->LinkCustomAttributes = "";
			$contenidos->edicion->HrefValue = "";
			$contenidos->edicion->TooltipValue = "";

			// estatus
			$contenidos->estatus->LinkCustomAttributes = "";
			$contenidos->estatus->HrefValue = "";
			$contenidos->estatus->TooltipValue = "";
		} elseif ($contenidos->RowType == EW_ROWTYPE_ADD) { // Add row

			// titulo
			$contenidos->titulo->EditCustomAttributes = "";
			$contenidos->titulo->EditValue = ew_HtmlEncode($contenidos->titulo->CurrentValue);

			// resumen
			$contenidos->resumen->EditCustomAttributes = "";
			$contenidos->resumen->EditValue = ew_HtmlEncode($contenidos->resumen->CurrentValue);

			// contenido
			$contenidos->contenido->EditCustomAttributes = "";
			$contenidos->contenido->EditValue = ew_HtmlEncode($contenidos->contenido->CurrentValue);

			// imagen
			$contenidos->imagen->EditCustomAttributes = "";
			if (!ew_Empty($contenidos->imagen->Upload->DbValue)) {
				$contenidos->imagen->EditValue = $contenidos->imagen->Upload->DbValue;
				$contenidos->imagen->ImageWidth = 200;
				$contenidos->imagen->ImageHeight = 50;
				$contenidos->imagen->ImageAlt = $contenidos->imagen->FldAlt();
			} else {
				$contenidos->imagen->EditValue = "";
			}

			// edicion
			$contenidos->edicion->EditCustomAttributes = "";
			$arwrk = array();
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("3", $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : "3");
			$arwrk[] = array("2", $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : "2");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $contenidos->edicion->FldTagCaption(4) <> "" ? $contenidos->edicion->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : "1");
			$arwrk[] = array("2", $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : "3");
			$arwrk[] = array("3", $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $contenidos->edicion->FldTagCaption(4) <> "" ? $contenidos->edicion->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $contenidos->edicion->FldTagCaption(4) <> "" ? $contenidos->edicion->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : "1");
			$arwrk[] = array("2", $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : "2");
			$arwrk[] = array("3", $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $contenidos->edicion->FldTagCaption(4) <> "" ? $contenidos->edicion->FldTagCaption(4) : "4");
			}
			
			
			/*$arwrk[] = array("1", $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : "1");
			$arwrk[] = array("3", $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : "3");
			$arwrk[] = array("2", $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : "2");
			*/
			
			
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			
			$contenidos->edicion->EditValue = $arwrk;

			// estatus
			$contenidos->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $contenidos->estatus->FldTagCaption(1) <> "" ? $contenidos->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $contenidos->estatus->FldTagCaption(2) <> "" ? $contenidos->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$contenidos->estatus->EditValue = $arwrk;

			// Edit refer script
			// titulo

			$contenidos->titulo->HrefValue = "";

			// resumen
			$contenidos->resumen->HrefValue = "";

			// contenido
			$contenidos->contenido->HrefValue = "";

			// imagen
			$contenidos->imagen->HrefValue = "";

			// edicion
			$contenidos->edicion->HrefValue = "";

			// estatus
			$contenidos->estatus->HrefValue = "";
		}
		if ($contenidos->RowType == EW_ROWTYPE_ADD ||
			$contenidos->RowType == EW_ROWTYPE_EDIT ||
			$contenidos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$contenidos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($contenidos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$contenidos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $contenidos;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($contenidos->imagen->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($contenidos->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $contenidos->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($contenidos->imagen->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $contenidos->imagen->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($contenidos->edicion->FormValue) && $contenidos->edicion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $contenidos->edicion->FldCaption());
		}
		if (!is_null($contenidos->estatus->FormValue) && $contenidos->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $contenidos->estatus->FldCaption());
		}

		// Validate detail grid
		if ($contenidos->getCurrentDetailTable() == "grupo_secciones" && $GLOBALS["grupo_secciones"]->DetailAdd) {
			$grupo_secciones_grid = new cgrupo_secciones_grid(); // get detail page object
			$grupo_secciones_grid->ValidateGridForm();
			$grupo_secciones_grid = NULL;
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
		global $conn, $Language, $Security, $contenidos;

		// Begin transaction
		if ($contenidos->getCurrentDetailTable() <> "")
			$conn->BeginTrans();
		$rsnew = array();

		// titulo
		$contenidos->titulo->SetDbValueDef($rsnew, $contenidos->titulo->CurrentValue, NULL, FALSE);

		// resumen
		$contenidos->resumen->SetDbValueDef($rsnew, $contenidos->resumen->CurrentValue, NULL, FALSE);

		// contenido
		$contenidos->contenido->SetDbValueDef($rsnew, $contenidos->contenido->CurrentValue, NULL, FALSE);

		// imagen
		if ($contenidos->imagen->Upload->Action == "1") { // Keep
			if ($rsold) {
				$rsnew['imagen'] = $rsold->fields['imagen'];
			}
		} elseif ($contenidos->imagen->Upload->Action == "2" || $contenidos->imagen->Upload->Action == "3") { // Update/Remove
		if (is_null($contenidos->imagen->Upload->Value)) {
			$rsnew['imagen'] = NULL;
		} else {
			$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $contenidos->imagen->UploadPath), $contenidos->imagen->Upload->FileName);
		}
		}

		// edicion
		$contenidos->edicion->SetDbValueDef($rsnew, $contenidos->edicion->CurrentValue, NULL, FALSE);

		// estatus
		$contenidos->estatus->SetDbValueDef($rsnew, $contenidos->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $contenidos->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($contenidos->imagen->Upload->Value)) {
				$contenidos->imagen->Upload->SaveToFile($contenidos->imagen->UploadPath, $rsnew['imagen'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($contenidos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($contenidos->CancelMessage <> "") {
				$this->setFailureMessage($contenidos->CancelMessage);
				$contenidos->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$contenidos->id_contenido->setDbValue($conn->Insert_ID());
			$rsnew['id_contenido'] = $contenidos->id_contenido->DbValue;
		}

		// Add detail records
		if ($AddRow) {
			if ($contenidos->getCurrentDetailTable() == "grupo_secciones" && $GLOBALS["grupo_secciones"]->DetailAdd) {
				$GLOBALS["grupo_secciones"]->id_contenido->setSessionValue($contenidos->id_contenido->CurrentValue); // Set master key
				$grupo_secciones_grid = new cgrupo_secciones_grid(); // get detail page object
				$AddRow = $grupo_secciones_grid->GridInsert();
				$grupo_secciones_grid = NULL;
			}
		}

		// Commit/Rollback transaction
		if ($contenidos->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$contenidos->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}

		// imagen
		$contenidos->imagen->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $contenidos;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$contenidos->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $contenidos->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "grupo_secciones") {
				if (!isset($GLOBALS["grupo_secciones"]))
					$GLOBALS["grupo_secciones"] = new cgrupo_secciones;
				if ($GLOBALS["grupo_secciones"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["grupo_secciones"]->CurrentMode = "copy";
					else
						$GLOBALS["grupo_secciones"]->CurrentMode = "add";
					$GLOBALS["grupo_secciones"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["grupo_secciones"]->setCurrentMasterTable($contenidos->TableVar);
					$GLOBALS["grupo_secciones"]->setStartRecordNumber(1);
					$GLOBALS["grupo_secciones"]->id_contenido->FldIsDetailKey = TRUE;
					$GLOBALS["grupo_secciones"]->id_contenido->CurrentValue = $contenidos->id_contenido->CurrentValue;
					$GLOBALS["grupo_secciones"]->id_contenido->setSessionValue($GLOBALS["grupo_secciones"]->id_contenido->CurrentValue);
				}
			}
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'contenidos';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $contenidos;
		$table = 'contenidos';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_contenido'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($contenidos->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($contenidos->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($contenidos->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
