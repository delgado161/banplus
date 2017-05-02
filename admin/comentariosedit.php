<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "comentariosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$comentarios_edit = new ccomentarios_edit();
$Page =& $comentarios_edit;

// Page init
$comentarios_edit->Page_Init();

// Page main
$comentarios_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var comentarios_edit = new ew_Page("comentarios_edit");

// page properties
comentarios_edit.PageID = "edit"; // page ID
comentarios_edit.FormID = "fcomentariosedit"; // form ID
var EW_PAGE_ID = comentarios_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
comentarios_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_autor"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($comentarios->autor->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_descripcion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($comentarios->descripcion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($comentarios->fecha->FldErrMsg()) ?>");

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
comentarios_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comentarios_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comentarios_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comentarios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $comentarios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $comentarios_edit->ShowPageHeader(); ?>
<?php
$comentarios_edit->ShowMessage();
?>
<form name="fcomentariosedit" id="fcomentariosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return comentarios_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="comentarios">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($comentarios->autor->Visible) { // autor ?>
	<tr id="r_autor"<?php echo $comentarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comentarios->autor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comentarios->autor->CellAttributes() ?>><span id="el_autor">
<input type="text" name="x_autor" id="x_autor" size="30" maxlength="30" value="<?php echo $comentarios->autor->EditValue ?>"<?php echo $comentarios->autor->EditAttributes() ?>>
</span><?php echo $comentarios->autor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comentarios->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion"<?php echo $comentarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comentarios->descripcion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comentarios->descripcion->CellAttributes() ?>><span id="el_descripcion">
<textarea name="x_descripcion" id="x_descripcion" cols="0" rows="5"<?php echo $comentarios->descripcion->EditAttributes() ?>><?php echo $comentarios->descripcion->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($comentarios->descripcion->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x_descripcion', 0*_width_multiplier, 5*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x_descripcion", function() {
	var oCKeditor = CKEDITOR.replace('x_descripcion', { width: 0*_width_multiplier, height: 5*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
</span><?php echo $comentarios->descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comentarios->zemail->Visible) { // email ?>
	<tr id="r_zemail"<?php echo $comentarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comentarios->zemail->FldCaption() ?></td>
		<td<?php echo $comentarios->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" size="45" maxlength="45" value="<?php echo $comentarios->zemail->EditValue ?>"<?php echo $comentarios->zemail->EditAttributes() ?>>
</span><?php echo $comentarios->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comentarios->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $comentarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comentarios->fecha->FldCaption() ?></td>
		<td<?php echo $comentarios->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha" value="<?php echo $comentarios->fecha->EditValue ?>"<?php echo $comentarios->fecha->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_fecha" name="cal_x_fecha" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_fecha", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_fecha" // button id
});
</script>
</span><?php echo $comentarios->fecha->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_comentario" id="x_id_comentario" value="<?php echo ew_HtmlEncode($comentarios->id_comentario->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$comentarios_edit->ShowPageFooter();
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
$comentarios_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomentarios_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'comentarios';

	// Page object name
	var $PageObjName = 'comentarios_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comentarios;
		if ($comentarios->UseTokenInUrl) $PageUrl .= "t=" . $comentarios->TableVar . "&"; // Add page token
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
		global $objForm, $comentarios;
		if ($comentarios->UseTokenInUrl) {
			if ($objForm)
				return ($comentarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comentarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccomentarios_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (comentarios)
		if (!isset($GLOBALS["comentarios"])) {
			$GLOBALS["comentarios"] = new ccomentarios();
			$GLOBALS["Table"] =& $GLOBALS["comentarios"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comentarios', TRUE);

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
		global $comentarios;

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
			$this->Page_Terminate("comentarioslist.php");
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
		global $objForm, $Language, $gsFormError, $comentarios;

		// Load key from QueryString
		if (@$_GET["id_comentario"] <> "")
			$comentarios->id_comentario->setQueryStringValue($_GET["id_comentario"]);
		if (@$_POST["a_edit"] <> "") {
			$comentarios->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$comentarios->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$comentarios->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$comentarios->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($comentarios->id_comentario->CurrentValue == "")
			$this->Page_Terminate("comentarioslist.php"); // Invalid key, return to list
		switch ($comentarios->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("comentarioslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$comentarios->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $comentarios->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$comentarios->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$comentarios->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$comentarios->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $comentarios;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $comentarios;
		if (!$comentarios->autor->FldIsDetailKey) {
			$comentarios->autor->setFormValue($objForm->GetValue("x_autor"));
		}
		if (!$comentarios->descripcion->FldIsDetailKey) {
			$comentarios->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		}
		if (!$comentarios->zemail->FldIsDetailKey) {
			$comentarios->zemail->setFormValue($objForm->GetValue("x_zemail"));
		}
		if (!$comentarios->fecha->FldIsDetailKey) {
			$comentarios->fecha->setFormValue($objForm->GetValue("x_fecha"));
			$comentarios->fecha->CurrentValue = ew_UnFormatDateTime($comentarios->fecha->CurrentValue, 7);
		}
		if (!$comentarios->id_comentario->FldIsDetailKey)
			$comentarios->id_comentario->setFormValue($objForm->GetValue("x_id_comentario"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $comentarios;
		$this->LoadRow();
		$comentarios->id_comentario->CurrentValue = $comentarios->id_comentario->FormValue;
		$comentarios->autor->CurrentValue = $comentarios->autor->FormValue;
		$comentarios->descripcion->CurrentValue = $comentarios->descripcion->FormValue;
		$comentarios->zemail->CurrentValue = $comentarios->zemail->FormValue;
		$comentarios->fecha->CurrentValue = $comentarios->fecha->FormValue;
		$comentarios->fecha->CurrentValue = ew_UnFormatDateTime($comentarios->fecha->CurrentValue, 7);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comentarios;
		$sFilter = $comentarios->KeyFilter();

		// Call Row Selecting event
		$comentarios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$comentarios->CurrentFilter = $sFilter;
		$sSql = $comentarios->SQL();
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
		global $conn, $comentarios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$comentarios->Row_Selected($row);
		$comentarios->id_comentario->setDbValue($rs->fields('id_comentario'));
		$comentarios->autor->setDbValue($rs->fields('autor'));
		$comentarios->descripcion->setDbValue($rs->fields('descripcion'));
		$comentarios->zemail->setDbValue($rs->fields('email'));
		$comentarios->fecha->setDbValue($rs->fields('fecha'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $comentarios;

		// Initialize URLs
		// Call Row_Rendering event

		$comentarios->Row_Rendering();

		// Common render codes for all row types
		// id_comentario
		// autor
		// descripcion
		// email
		// fecha

		if ($comentarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// autor
			$comentarios->autor->ViewValue = $comentarios->autor->CurrentValue;
			$comentarios->autor->ViewCustomAttributes = "";

			// descripcion
			$comentarios->descripcion->ViewValue = $comentarios->descripcion->CurrentValue;
			$comentarios->descripcion->ViewCustomAttributes = "";

			// email
			$comentarios->zemail->ViewValue = $comentarios->zemail->CurrentValue;
			$comentarios->zemail->ViewCustomAttributes = "";

			// fecha
			$comentarios->fecha->ViewValue = $comentarios->fecha->CurrentValue;
			$comentarios->fecha->ViewValue = ew_FormatDateTime($comentarios->fecha->ViewValue, 7);
			$comentarios->fecha->ViewCustomAttributes = "";

			// autor
			$comentarios->autor->LinkCustomAttributes = "";
			$comentarios->autor->HrefValue = "";
			$comentarios->autor->TooltipValue = "";

			// descripcion
			$comentarios->descripcion->LinkCustomAttributes = "";
			$comentarios->descripcion->HrefValue = "";
			$comentarios->descripcion->TooltipValue = "";

			// email
			$comentarios->zemail->LinkCustomAttributes = "";
			$comentarios->zemail->HrefValue = "";
			$comentarios->zemail->TooltipValue = "";

			// fecha
			$comentarios->fecha->LinkCustomAttributes = "";
			$comentarios->fecha->HrefValue = "";
			$comentarios->fecha->TooltipValue = "";
		} elseif ($comentarios->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// autor
			$comentarios->autor->EditCustomAttributes = "";
			$comentarios->autor->EditValue = ew_HtmlEncode($comentarios->autor->CurrentValue);

			// descripcion
			$comentarios->descripcion->EditCustomAttributes = "";
			$comentarios->descripcion->EditValue = ew_HtmlEncode($comentarios->descripcion->CurrentValue);

			// email
			$comentarios->zemail->EditCustomAttributes = "";
			$comentarios->zemail->EditValue = ew_HtmlEncode($comentarios->zemail->CurrentValue);

			// fecha
			$comentarios->fecha->EditCustomAttributes = "";
			$comentarios->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($comentarios->fecha->CurrentValue, 7));

			// Edit refer script
			// autor

			$comentarios->autor->HrefValue = "";

			// descripcion
			$comentarios->descripcion->HrefValue = "";

			// email
			$comentarios->zemail->HrefValue = "";

			// fecha
			$comentarios->fecha->HrefValue = "";
		}
		if ($comentarios->RowType == EW_ROWTYPE_ADD ||
			$comentarios->RowType == EW_ROWTYPE_EDIT ||
			$comentarios->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$comentarios->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($comentarios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$comentarios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $comentarios;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($comentarios->autor->FormValue) && $comentarios->autor->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $comentarios->autor->FldCaption());
		}
		if (!is_null($comentarios->descripcion->FormValue) && $comentarios->descripcion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $comentarios->descripcion->FldCaption());
		}
		if (!ew_CheckEuroDate($comentarios->fecha->FormValue)) {
			ew_AddMessage($gsFormError, $comentarios->fecha->FldErrMsg());
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
		global $conn, $Security, $Language, $comentarios;
		$sFilter = $comentarios->KeyFilter();
		$comentarios->CurrentFilter = $sFilter;
		$sSql = $comentarios->SQL();
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

			// autor
			$comentarios->autor->SetDbValueDef($rsnew, $comentarios->autor->CurrentValue, NULL, $comentarios->autor->ReadOnly);

			// descripcion
			$comentarios->descripcion->SetDbValueDef($rsnew, $comentarios->descripcion->CurrentValue, NULL, $comentarios->descripcion->ReadOnly);

			// email
			$comentarios->zemail->SetDbValueDef($rsnew, $comentarios->zemail->CurrentValue, NULL, $comentarios->zemail->ReadOnly);

			// fecha
			$comentarios->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($comentarios->fecha->CurrentValue, 7), NULL, $comentarios->fecha->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $comentarios->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($comentarios->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($comentarios->CancelMessage <> "") {
					$this->setFailureMessage($comentarios->CancelMessage);
					$comentarios->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$comentarios->Row_Updated($rsold, $rsnew);
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
