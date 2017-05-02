<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "parametrosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$parametros_edit = new cparametros_edit();
$Page =& $parametros_edit;

// Page init
$parametros_edit->Page_Init();

// Page main
$parametros_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var parametros_edit = new ew_Page("parametros_edit");

// page properties
parametros_edit.PageID = "edit"; // page ID
parametros_edit.FormID = "fparametrosedit"; // form ID
var EW_PAGE_ID = parametros_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
parametros_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_archivo"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

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
parametros_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
parametros_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
parametros_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php
	if ($_GET['id_parametro']==40) { ?> 
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
		</script> <?php
	} ?>
	
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $parametros->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $parametros->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $parametros_edit->ShowPageHeader(); ?>
<?php
$parametros_edit->ShowMessage();
?>
<form name="fparametrosedit" id="fparametrosedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return parametros_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="parametros">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($parametros->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $parametros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $parametros->nombre->FldCaption() ?></td>
		<td<?php echo $parametros->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" <?php if ($_GET['id_parametro']!=40) { echo "size='45' "; } else { echo "size='113' "; }?> maxlength="45" value="<?php echo $parametros->nombre->EditValue ?>"<?php echo $parametros->nombre->EditAttributes() ?>>
</span><?php echo $parametros->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parametros->valor->Visible) { // valor ?>
	<tr id="r_valor"<?php echo $parametros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $parametros->valor->FldCaption() ?></td>
		<td<?php echo $parametros->valor->CellAttributes() ?>><span id="el_valor">
		<?php
		if ($_GET['id_parametro']!=40) { ?>
			<input type="text" name="x_valor" id="x_valor" size="45" maxlength="255" value="<?php echo $parametros->valor->EditValue ?>"<?php echo $parametros->valor->EditAttributes() ?>>
		<?php 
		}else { ?>
			<textarea name="x_valor" id="x_valor" cols="35" rows="4"<?php echo $parametros->valor->EditAttributes() ?>><?php echo $parametros->valor->EditValue ?></textarea>
			
			<script type="text/javascript">
			<!--
			<?php if ($parametros->valor->ReadOnly) { ?>
			new ew_ReadOnlyTextArea('x_valor', 35*_width_multiplier, 4*_height_multiplier);
			<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x_valor", function() {
				var oCKeditor = CKEDITOR.replace('x_valor', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
				this.active = true;
			}));
			<?php } ?>
			-->
			</script>
		<?php  
		} ?>
</span><?php echo $parametros->valor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parametros->archivo->Visible) { // archivo ?>
	<tr id="r_archivo"<?php echo $parametros->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $parametros->archivo->FldCaption() ?></td>
		<td<?php echo $parametros->archivo->CellAttributes() ?>><span id="el_archivo">
<div id="old_x_archivo">
<?php if ($parametros->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($parametros->archivo->Upload->DbValue)) { ?>
<a<?php echo $parametros->archivo->LinkAttributes() ?>><?php echo $parametros->archivo->EditValue ?></a>
<?php } elseif (!in_array($parametros->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($parametros->archivo->Upload->DbValue)) { ?>
<?php echo $parametros->archivo->EditValue ?>
<?php } elseif (!in_array($parametros->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_archivo">
<?php if (!empty($parametros->archivo->Upload->DbValue)) { ?>
<label><input type="radio" name="a_archivo" id="a_archivo" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $parametros->archivo->EditAttrs["onchange"] = "this.form.a_archivo[2].checked=true;" . @$parametros->archivo->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_archivo" id="a_archivo" value="3">
<?php } ?>
<input type="file" name="x_archivo" id="x_archivo" size="30"<?php echo $parametros->archivo->EditAttributes() ?>>
</div>
</span><?php echo $parametros->archivo->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_parametro" id="x_id_parametro" value="<?php echo ew_HtmlEncode($parametros->id_parametro->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$parametros_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
		if ($_GET['id_parametro']==40) { ?>
			<script type="text/javascript">
			<!--
			ew_CreateEditor();  // Create DHTML editor(s)

			//-->
			</script> 
		<?php 
		} ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$parametros_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cparametros_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'parametros';

	// Page object name
	var $PageObjName = 'parametros_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $parametros;
		if ($parametros->UseTokenInUrl) $PageUrl .= "t=" . $parametros->TableVar . "&"; // Add page token
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
		global $objForm, $parametros;
		if ($parametros->UseTokenInUrl) {
			if ($objForm)
				return ($parametros->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($parametros->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cparametros_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (parametros)
		if (!isset($GLOBALS["parametros"])) {
			$GLOBALS["parametros"] = new cparametros();
			$GLOBALS["Table"] =& $GLOBALS["parametros"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'parametros', TRUE);

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
		global $parametros;

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
			$this->Page_Terminate("parametroslist.php");
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
		global $objForm, $Language, $gsFormError, $parametros;

		// Load key from QueryString
		if (@$_GET["id_parametro"] <> "")
			$parametros->id_parametro->setQueryStringValue($_GET["id_parametro"]);
		if (@$_POST["a_edit"] <> "") {
			$parametros->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$parametros->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$parametros->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$parametros->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($parametros->id_parametro->CurrentValue == "")
			$this->Page_Terminate("parametroslist.php"); // Invalid key, return to list
		switch ($parametros->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("parametroslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$parametros->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $parametros->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$parametros->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$parametros->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$parametros->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $parametros;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$parametros->archivo->Upload->Index = $objForm->Index;
		$parametros->archivo->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$parametros->archivo->Upload->RestoreFromSession();
		} else {
			if ($parametros->archivo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $parametros->archivo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$parametros->archivo->Upload->SaveToSession();
			$parametros->archivo->CurrentValue = $parametros->archivo->Upload->FileName;
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $parametros;
		$this->GetUploadFiles(); // Get upload files
		if (!$parametros->nombre->FldIsDetailKey) {
			$parametros->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$parametros->valor->FldIsDetailKey) {
			$parametros->valor->setFormValue($objForm->GetValue("x_valor"));
		}
		if (!$parametros->id_parametro->FldIsDetailKey)
			$parametros->id_parametro->setFormValue($objForm->GetValue("x_id_parametro"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $parametros;
		$this->LoadRow();
		$parametros->id_parametro->CurrentValue = $parametros->id_parametro->FormValue;
		$parametros->nombre->CurrentValue = $parametros->nombre->FormValue;
		$parametros->valor->CurrentValue = $parametros->valor->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $parametros;
		$sFilter = $parametros->KeyFilter();

		// Call Row Selecting event
		$parametros->Row_Selecting($sFilter);

		// Load SQL based on filter
		$parametros->CurrentFilter = $sFilter;
		$sSql = $parametros->SQL();
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
		global $conn, $parametros;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$parametros->Row_Selected($row);
		$parametros->id_parametro->setDbValue($rs->fields('id_parametro'));
		$parametros->nombre->setDbValue($rs->fields('nombre'));
		$parametros->valor->setDbValue($rs->fields('valor'));
		$parametros->archivo->Upload->DbValue = $rs->fields('archivo');
		$parametros->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $parametros;

		// Initialize URLs
		// Call Row_Rendering event

		$parametros->Row_Rendering();

		// Common render codes for all row types
		// id_parametro
		// nombre
		// valor
		// archivo
		// estatus

		if ($parametros->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$parametros->nombre->ViewValue = $parametros->nombre->CurrentValue;
			$parametros->nombre->ViewCustomAttributes = "";

			// valor
			$parametros->valor->ViewValue = $parametros->valor->CurrentValue;
			$parametros->valor->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($parametros->archivo->Upload->DbValue)) {
				$parametros->archivo->ViewValue = $parametros->archivo->Upload->DbValue;
			} else {
				$parametros->archivo->ViewValue = "";
			}
			$parametros->archivo->ViewCustomAttributes = "";

			// nombre
			$parametros->nombre->LinkCustomAttributes = "";
			$parametros->nombre->HrefValue = "";
			$parametros->nombre->TooltipValue = "";

			// valor
			$parametros->valor->LinkCustomAttributes = "";
			$parametros->valor->HrefValue = "";
			$parametros->valor->TooltipValue = "";

			// archivo
			$parametros->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($parametros->archivo->Upload->DbValue)) {
				$parametros->archivo->HrefValue = ew_UploadPathEx(FALSE, $parametros->archivo->UploadPath) . ((!empty($parametros->archivo->ViewValue)) ? $parametros->archivo->ViewValue : $parametros->archivo->CurrentValue); // Add prefix/suffix
				$parametros->archivo->LinkAttrs["target"] = ""; // Add target
				if ($parametros->Export <> "") $parametros->archivo->HrefValue = ew_ConvertFullUrl($parametros->archivo->HrefValue);
			} else {
				$parametros->archivo->HrefValue = "";
			}
			$parametros->archivo->TooltipValue = "";
		} elseif ($parametros->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$parametros->nombre->EditCustomAttributes = "";
			$parametros->nombre->EditValue = ew_HtmlEncode($parametros->nombre->CurrentValue);

			// valor
			$parametros->valor->EditCustomAttributes = "";
			$parametros->valor->EditValue = ew_HtmlEncode($parametros->valor->CurrentValue);

			// archivo
			$parametros->archivo->EditCustomAttributes = "";
			if (!ew_Empty($parametros->archivo->Upload->DbValue)) {
				$parametros->archivo->EditValue = $parametros->archivo->Upload->DbValue;
			} else {
				$parametros->archivo->EditValue = "";
			}

			// Edit refer script
			// nombre

			$parametros->nombre->HrefValue = "";

			// valor
			$parametros->valor->HrefValue = "";

			// archivo
			if (!ew_Empty($parametros->archivo->Upload->DbValue)) {
				$parametros->archivo->HrefValue = ew_UploadPathEx(FALSE, $parametros->archivo->UploadPath) . ((!empty($parametros->archivo->EditValue)) ? $parametros->archivo->EditValue : $parametros->archivo->CurrentValue); // Add prefix/suffix
				$parametros->archivo->LinkAttrs["target"] = ""; // Add target
				if ($parametros->Export <> "") $parametros->archivo->HrefValue = ew_ConvertFullUrl($parametros->archivo->HrefValue);
			} else {
				$parametros->archivo->HrefValue = "";
			}
		}
		if ($parametros->RowType == EW_ROWTYPE_ADD ||
			$parametros->RowType == EW_ROWTYPE_EDIT ||
			$parametros->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$parametros->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($parametros->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$parametros->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $parametros;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($parametros->archivo->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($parametros->archivo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $parametros->archivo->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($parametros->archivo->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $parametros->archivo->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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
		global $conn, $Security, $Language, $parametros;
		$sFilter = $parametros->KeyFilter();
		$parametros->CurrentFilter = $sFilter;
		$sSql = $parametros->SQL();
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
			$parametros->nombre->SetDbValueDef($rsnew, $parametros->nombre->CurrentValue, NULL, $parametros->nombre->ReadOnly);

			// valor
			$parametros->valor->SetDbValueDef($rsnew, $parametros->valor->CurrentValue, NULL, $parametros->valor->ReadOnly);

			// archivo
			if ($parametros->archivo->Upload->Action == "1") { // Keep
			} elseif ($parametros->archivo->Upload->Action == "2" || $parametros->archivo->Upload->Action == "3") { // Update/Remove
			$parametros->archivo->Upload->DbValue = $rs->fields('archivo'); // Get original value
			if (is_null($parametros->archivo->Upload->Value)) {
				$rsnew['archivo'] = NULL;
			} else {
				$rsnew['archivo'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $parametros->archivo->UploadPath), $parametros->archivo->Upload->FileName);
			}
			}

			// Call Row Updating event
			$bUpdateRow = $parametros->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($parametros->archivo->Upload->Value)) {
				$parametros->archivo->Upload->SaveToFile($parametros->archivo->UploadPath, $rsnew['archivo'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($parametros->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($parametros->CancelMessage <> "") {
					$this->setFailureMessage($parametros->CancelMessage);
					$parametros->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$parametros->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// archivo
		$parametros->archivo->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'parametros';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $parametros;
		$table = 'parametros';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_parametro'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($parametros->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($parametros->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($parametros->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($parametros->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
