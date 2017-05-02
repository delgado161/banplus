<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "promocionesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$promociones_add = new cpromociones_add();
$Page =& $promociones_add;

// Page init
$promociones_add->Page_Init();

// Page main
$promociones_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var promociones_add = new ew_Page("promociones_add");

// page properties
promociones_add.PageID = "add"; // page ID
promociones_add.FormID = "fpromocionesadd"; // form ID
var EW_PAGE_ID = promociones_add.PageID; // for backward compatibility

// extend page with ValidateForm function
promociones_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		
		elm = fobj.elements["x" + infix + "_tipo"];
		tipo = elm.value;
		
		elm = fobj.elements["x" + infix + "_titulo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo "Titulo" ?>");
		
		if (tipo ==1){
		elm = fobj.elements["x" + infix + "_contenido"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($promociones->contenido->FldCaption()) ?>");
		}
		
		elm = fobj.elements["x" + infix + "_imagen"];
		aelm = fobj.elements["a" + infix + "_imagen"];
		var chk_imagen = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_imagen && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($promociones->imagen->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($promociones->estatus->FldCaption()) ?>");
		
		elm = fobj.elements["x" + infix + "_tipo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($promociones->tipo->FldCaption()) ?>");
		
		if (tipo ==1){
		elm = fobj.elements["x" + infix + "_url"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($promociones->url->FldCaption()) ?>");
	}
		
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
promociones_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
promociones_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
promociones_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $promociones->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $promociones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $promociones_add->ShowPageHeader(); ?>
<?php
$promociones_add->ShowMessage();
?>
<form name="fpromocionesadd" id="fpromocionesadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return promociones_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="promociones">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($promociones->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->titulo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $promociones->titulo->CellAttributes() ?>><span id="el_titulo">
<input type="text" name="x_titulo" id="x_titulo" size="90" maxlength="255" value="<?php echo $promociones->titulo->EditValue ?>"<?php echo $promociones->titulo->EditAttributes() ?>>
</span><?php echo $promociones->titulo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($promociones->contenido->Visible) { // contenido ?>
	<tr id="r_contenido"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->contenido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $promociones->contenido->CellAttributes() ?>><span id="el_contenido">
<textarea name="x_contenido" id="x_contenido" cols="35" rows="8"<?php echo $promociones->contenido->EditAttributes() ?>><?php echo $promociones->contenido->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($promociones->contenido->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x_contenido', 35*_width_multiplier, 8*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x_contenido", function() {
	var oCKeditor = CKEDITOR.replace('x_contenido', { width: 35*_width_multiplier, height: 8*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
</span><?php echo $promociones->contenido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($promociones->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->imagen->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $promociones->imagen->CellAttributes() ?>><span id="el_imagen">
<div id="old_x_imagen">
<?php if ($promociones->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($promociones->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $promociones->imagen->UploadPath) . $promociones->imagen->Upload->DbValue ?>" border=0<?php echo $promociones->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($promociones->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($promociones->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $promociones->imagen->UploadPath) . $promociones->imagen->Upload->DbValue ?>" border=0<?php echo $promociones->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($promociones->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_imagen">
<?php if (!empty($promociones->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a_imagen" id="a_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $promociones->imagen->EditAttrs["onchange"] = "this.form.a_imagen[2].checked=true;" . @$promociones->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="3">
<?php } ?>
<input type="file" name="x_imagen" id="x_imagen" size="30"<?php echo $promociones->imagen->EditAttributes() ?>>
</div>
</span><?php echo $promociones->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>

<?php if ($promociones->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->tipo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $promociones->tipo->CellAttributes() ?>><span id="el_tipo">
<select id="x_tipo" name="x_tipo"<?php echo $promociones->tipo->EditAttributes() ?>>
<?php
if (is_array($promociones->tipo->EditValue)) {
	$arwrk = $promociones->tipo->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($promociones->tipo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $promociones->tipo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($promociones->url->Visible) { // url ?>
	<tr id="r_url"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->url->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $promociones->url->CellAttributes() ?>><span id="el_url">
<textarea name="x_url" id="x_url" cols="35" rows="4"<?php echo $promociones->url->EditAttributes() ?>><?php echo $promociones->url->EditValue ?></textarea>
</span><?php echo $promociones->url->CustomMsg ?></td>
	</tr>
<?php } ?>

<?php if ($promociones->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $promociones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $promociones->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $promociones->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $promociones->estatus->EditAttributes() ?>>
<?php
if (is_array($promociones->estatus->EditValue)) {
	$arwrk = $promociones->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($promociones->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $promociones->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$promociones_add->ShowPageFooter();
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
$promociones_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpromociones_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'promociones';

	// Page object name
	var $PageObjName = 'promociones_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $promociones;
		if ($promociones->UseTokenInUrl) $PageUrl .= "t=" . $promociones->TableVar . "&"; // Add page token
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
		global $objForm, $promociones;
		if ($promociones->UseTokenInUrl) {
			if ($objForm)
				return ($promociones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($promociones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpromociones_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (promociones)
		if (!isset($GLOBALS["promociones"])) {
			$GLOBALS["promociones"] = new cpromociones();
			$GLOBALS["Table"] =& $GLOBALS["promociones"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'promociones', TRUE);

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
		global $promociones;

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
			$this->Page_Terminate("promocioneslist.php");
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
		global $objForm, $Language, $gsFormError, $promociones;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$promociones->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$promociones->CurrentAction = "I"; // Form error, reset action
				$promociones->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_promociones"] != "") {
				$promociones->id_promociones->setQueryStringValue($_GET["id_promociones"]);
				$promociones->setKey("id_promociones", $promociones->id_promociones->CurrentValue); // Set up key
			} else {
				$promociones->setKey("id_promociones", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$promociones->CurrentAction = "C"; // Copy record
			} else {
				$promociones->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($promociones->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("promocioneslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$promociones->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $promociones->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "promocionesview.php")
						$sReturnUrl = $promociones->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$promociones->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$promociones->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$promociones->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $promociones;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$promociones->imagen->Upload->Index = $objForm->Index;
		$promociones->imagen->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$promociones->imagen->Upload->RestoreFromSession();
		} else {
			if ($promociones->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $promociones->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$promociones->imagen->Upload->SaveToSession();
			$promociones->imagen->CurrentValue = $promociones->imagen->Upload->FileName;
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $promociones;
		$promociones->titulo->CurrentValue = NULL;
		$promociones->titulo->OldValue = $promociones->titulo->CurrentValue;
		$promociones->contenido->CurrentValue = NULL;
		$promociones->contenido->OldValue = $promociones->contenido->CurrentValue;
		$promociones->imagen->Upload->DbValue = NULL;
		$promociones->imagen->OldValue = $promociones->imagen->Upload->DbValue;
		$promociones->imagen->CurrentValue = NULL; // Clear file related field
		$promociones->estatus->CurrentValue = NULL;
		$promociones->estatus->OldValue = $promociones->estatus->CurrentValue;
		$promociones->tipo->CurrentValue = NULL;
		$promociones->tipo->OldValue = $promociones->tipo->CurrentValue;
		$promociones->url->CurrentValue = NULL;
		$promociones->url->OldValue = $promociones->url->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $promociones;
		$this->GetUploadFiles(); // Get upload files
		if (!$promociones->titulo->FldIsDetailKey) {
			$promociones->titulo->setFormValue($objForm->GetValue("x_titulo"));
		}
		if (!$promociones->contenido->FldIsDetailKey) {
			$promociones->contenido->setFormValue($objForm->GetValue("x_contenido"));
		}
		if (!$promociones->estatus->FldIsDetailKey) {
			$promociones->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$promociones->tipo->FldIsDetailKey) {
			$promociones->tipo->setFormValue($objForm->GetValue("x_tipo"));
		}
		if (!$promociones->url->FldIsDetailKey) {
			$promociones->url->setFormValue($objForm->GetValue("x_url"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $promociones;
		$this->LoadOldRecord();
		$promociones->titulo->CurrentValue = $promociones->titulo->FormValue;
		$promociones->contenido->CurrentValue = $promociones->contenido->FormValue;
		$promociones->estatus->CurrentValue = $promociones->estatus->FormValue;
		$promociones->tipo->CurrentValue = $promociones->tipo->FormValue;
		$promociones->url->CurrentValue = $promociones->url->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $promociones;
		$sFilter = $promociones->KeyFilter();

		// Call Row Selecting event
		$promociones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$promociones->CurrentFilter = $sFilter;
		$sSql = $promociones->SQL();
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
		global $conn, $promociones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$promociones->Row_Selected($row);
		$promociones->id_promociones->setDbValue($rs->fields('id_promociones'));
		$promociones->titulo->setDbValue($rs->fields('titulo'));
		$promociones->contenido->setDbValue($rs->fields('contenido'));
		$promociones->imagen->Upload->DbValue = $rs->fields('imagen');
		$promociones->estatus->setDbValue($rs->fields('estatus'));
		$promociones->tipo->setDbValue($rs->fields('tipo'));
		$promociones->url->setDbValue($rs->fields('url'));
	}

	// Load old record
	function LoadOldRecord() {
		global $promociones;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($promociones->getKey("id_promociones")) <> "")
			$promociones->id_promociones->CurrentValue = $promociones->getKey("id_promociones"); // id_promociones
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$promociones->CurrentFilter = $promociones->KeyFilter();
			$sSql = $promociones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $promociones;

		// Initialize URLs
		// Call Row_Rendering event

		$promociones->Row_Rendering();

		// Common render codes for all row types
		// id_promociones
		// titulo
		// contenido
		// imagen
		// estatus
		// tipo
		// url

		if ($promociones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_promociones
			$promociones->id_promociones->ViewValue = $promociones->id_promociones->CurrentValue;
			$promociones->id_promociones->ViewCustomAttributes = "";

			// titulo
			$promociones->titulo->ViewValue = $promociones->titulo->CurrentValue;
			$promociones->titulo->ViewCustomAttributes = "";

			// contenido
			$promociones->contenido->ViewValue = $promociones->contenido->CurrentValue;
			$promociones->contenido->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($promociones->imagen->Upload->DbValue)) {
				$promociones->imagen->ViewValue = $promociones->imagen->Upload->DbValue;
				$promociones->imagen->ImageWidth = 150;
				$promociones->imagen->ImageHeight = 0;
				$promociones->imagen->ImageAlt = $promociones->imagen->FldAlt();
			} else {
				$promociones->imagen->ViewValue = "";
			}
			$promociones->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($promociones->estatus->CurrentValue) <> "") {
				switch ($promociones->estatus->CurrentValue) {
					case "1":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(1) <> "" ? $promociones->estatus->FldTagCaption(1) : $promociones->estatus->CurrentValue;
						break;
					case "0":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(2) <> "" ? $promociones->estatus->FldTagCaption(2) : $promociones->estatus->CurrentValue;
						break;
					case "3":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(3) <> "" ? $promociones->estatus->FldTagCaption(3) : $promociones->estatus->CurrentValue;
						break;
					case "4":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(4) <> "" ? $promociones->estatus->FldTagCaption(4) : $promociones->estatus->CurrentValue;
						break;
					default:
						$promociones->estatus->ViewValue = $promociones->estatus->CurrentValue;
				}
			} else {
				$promociones->estatus->ViewValue = NULL;
			}
			$promociones->estatus->ViewCustomAttributes = "";

			// tipo
			if (strval($promociones->tipo->CurrentValue) <> "") {
				switch ($promociones->tipo->CurrentValue) {
					case "1":
						$promociones->tipo->ViewValue = $promociones->tipo->FldTagCaption(1) <> "" ? $promociones->tipo->FldTagCaption(1) : $promociones->tipo->CurrentValue;
						break;
					case "0":
						$promociones->tipo->ViewValue = $promociones->tipo->FldTagCaption(2) <> "" ? $promociones->tipo->FldTagCaption(2) : $promociones->tipo->CurrentValue;
						break;
					default:
						$promociones->tipo->ViewValue = $promociones->tipo->CurrentValue;
				}
			} else {
				$promociones->tipo->ViewValue = NULL;
			}
			$promociones->tipo->ViewCustomAttributes = "";

			// url
			$promociones->url->ViewValue = $promociones->url->CurrentValue;
			$promociones->url->ViewCustomAttributes = "";

			// titulo
			$promociones->titulo->LinkCustomAttributes = "";
			$promociones->titulo->HrefValue = "";
			$promociones->titulo->TooltipValue = "";

			// contenido
			$promociones->contenido->LinkCustomAttributes = "";
			$promociones->contenido->HrefValue = "";
			$promociones->contenido->TooltipValue = "";

			// imagen
			$promociones->imagen->LinkCustomAttributes = "";
			$promociones->imagen->HrefValue = "";
			$promociones->imagen->TooltipValue = "";

			// estatus
			$promociones->estatus->LinkCustomAttributes = "";
			$promociones->estatus->HrefValue = "";
			$promociones->estatus->TooltipValue = "";

			// tipo
			$promociones->tipo->LinkCustomAttributes = "";
			$promociones->tipo->HrefValue = "";
			$promociones->tipo->TooltipValue = "";

			// url
			$promociones->url->LinkCustomAttributes = "";
			$promociones->url->HrefValue = "";
			$promociones->url->TooltipValue = "";
		} elseif ($promociones->RowType == EW_ROWTYPE_ADD) { // Add row

			// titulo
			$promociones->titulo->EditCustomAttributes = "";
			$promociones->titulo->EditValue = ew_HtmlEncode($promociones->titulo->CurrentValue);

			// contenido
			$promociones->contenido->EditCustomAttributes = "";
			$promociones->contenido->EditValue = ew_HtmlEncode($promociones->contenido->CurrentValue);

			// imagen
			$promociones->imagen->EditCustomAttributes = "";
			if (!ew_Empty($promociones->imagen->Upload->DbValue)) {
				$promociones->imagen->EditValue = $promociones->imagen->Upload->DbValue;
				$promociones->imagen->ImageWidth = 150;
				$promociones->imagen->ImageHeight = 0;
				$promociones->imagen->ImageAlt = $promociones->imagen->FldAlt();
			} else {
				$promociones->imagen->EditValue = "";
			}

			// estatus
			$promociones->estatus->EditCustomAttributes = "";
			$arwrk = array();
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("0", $promociones->estatus->FldTagCaption(2) <> "" ? $promociones->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $promociones->estatus->FldTagCaption(3) <> "" ? $promociones->estatus->FldTagCaption(3) : "3");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $promociones->estatus->FldTagCaption(3) <> "" ? $promociones->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $promociones->estatus->FldTagCaption(4) <> "" ? $promociones->estatus->FldTagCaption(4) : "4");
			}
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $promociones->estatus->FldTagCaption(1) <> "" ? $promociones->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $promociones->estatus->FldTagCaption(4) <> "" ? $promociones->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $promociones->estatus->FldTagCaption(1) <> "" ? $promociones->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $promociones->estatus->FldTagCaption(2) <> "" ? $promociones->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $promociones->estatus->FldTagCaption(3) <> "" ? $promociones->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $promociones->estatus->FldTagCaption(4) <> "" ? $promociones->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $promociones->estatus->FldTagCaption(1) <> "" ? $promociones->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $promociones->estatus->FldTagCaption(2) <> "" ? $promociones->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $promociones->estatus->FldTagCaption(3) <> "" ? $promociones->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $promociones->estatus->FldTagCaption(4) <> "" ? $promociones->estatus->FldTagCaption(4) : "4");
			}
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$promociones->estatus->EditValue = $arwrk;

			// tipo
			$promociones->tipo->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $promociones->tipo->FldTagCaption(1) <> "" ? $promociones->tipo->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $promociones->tipo->FldTagCaption(2) <> "" ? $promociones->tipo->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$promociones->tipo->EditValue = $arwrk;

			// url
			$promociones->url->EditCustomAttributes = "";
			$promociones->url->EditValue = ew_HtmlEncode($promociones->url->CurrentValue);

			// Edit refer script
			// titulo

			$promociones->titulo->HrefValue = "";

			// contenido
			$promociones->contenido->HrefValue = "";

			// imagen
			$promociones->imagen->HrefValue = "";

			// estatus
			$promociones->estatus->HrefValue = "";

			// tipo
			$promociones->tipo->HrefValue = "";

			// url
			$promociones->url->HrefValue = "";
		}
		if ($promociones->RowType == EW_ROWTYPE_ADD ||
			$promociones->RowType == EW_ROWTYPE_EDIT ||
			$promociones->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$promociones->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($promociones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$promociones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $promociones;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($promociones->imagen->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($promociones->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $promociones->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($promociones->imagen->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $promociones->imagen->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($promociones->titulo->FormValue) && $promociones->titulo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $promociones->titulo->FldCaption());
		}
		if (!is_null($promociones->contenido->FormValue) && $promociones->contenido->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $promociones->contenido->FldCaption());
		}
		if ($promociones->imagen->Upload->Action == "3" && is_null($promociones->imagen->Upload->Value)) {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $promociones->imagen->FldCaption());
		}
		if (!is_null($promociones->estatus->FormValue) && $promociones->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $promociones->estatus->FldCaption());
		}
		if (!is_null($promociones->tipo->FormValue) && $promociones->tipo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $promociones->tipo->FldCaption());
		}
		if (!is_null($promociones->url->FormValue) && $promociones->url->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $promociones->url->FldCaption());
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
		global $conn, $Language, $Security, $promociones;
		$rsnew = array();

		// titulo
		$promociones->titulo->SetDbValueDef($rsnew, $promociones->titulo->CurrentValue, "", FALSE);

		// contenido
		$promociones->contenido->SetDbValueDef($rsnew, $promociones->contenido->CurrentValue, "", FALSE);

		// imagen
		if ($promociones->imagen->Upload->Action == "1") { // Keep
			if ($rsold) {
				$rsnew['imagen'] = $rsold->fields['imagen'];
			}
		} elseif ($promociones->imagen->Upload->Action == "2" || $promociones->imagen->Upload->Action == "3") { // Update/Remove
		if (is_null($promociones->imagen->Upload->Value)) {
			$rsnew['imagen'] = NULL;
		} else {
			$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $promociones->imagen->UploadPath), $promociones->imagen->Upload->FileName);
		}
		}

		// estatus
		$promociones->estatus->SetDbValueDef($rsnew, $promociones->estatus->CurrentValue, 0, FALSE);

		// tipo
		$promociones->tipo->SetDbValueDef($rsnew, $promociones->tipo->CurrentValue, NULL, FALSE);

		// url
		$promociones->url->SetDbValueDef($rsnew, $promociones->url->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $promociones->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($promociones->imagen->Upload->Value)) {
				$promociones->imagen->Upload->SaveToFile($promociones->imagen->UploadPath, $rsnew['imagen'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($promociones->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($promociones->CancelMessage <> "") {
				$this->setFailureMessage($promociones->CancelMessage);
				$promociones->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$promociones->id_promociones->setDbValue($conn->Insert_ID());
			$rsnew['id_promociones'] = $promociones->id_promociones->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$promociones->Row_Inserted($rs, $rsnew);
		}

		// imagen
		$promociones->imagen->Upload->RemoveFromSession(); // Remove file value from Session
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
