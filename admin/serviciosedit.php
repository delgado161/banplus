<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "serviciosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$servicios_edit = new cservicios_edit();
$Page =& $servicios_edit;

// Page init
$servicios_edit->Page_Init();

// Page main
$servicios_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var servicios_edit = new ew_Page("servicios_edit");

// page properties
servicios_edit.PageID = "edit"; // page ID
servicios_edit.FormID = "fserviciosedit"; // form ID
var EW_PAGE_ID = servicios_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
servicios_edit.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($servicios->estatus->FldCaption()) ?>");

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
servicios_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
servicios_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
servicios_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $servicios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $servicios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $servicios_edit->ShowPageHeader(); ?>
<?php
$servicios_edit->ShowMessage();
?>
<form name="fserviciosedit" id="fserviciosedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return servicios_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="servicios">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($servicios->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $servicios->nombre->FldCaption() ?></td>
		<td<?php echo $servicios->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $servicios->nombre->EditValue ?>"<?php echo $servicios->nombre->EditAttributes() ?>>
</span><?php echo $servicios->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($servicios->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $servicios->imagen->FldCaption() ?></td>
		<td<?php echo $servicios->imagen->CellAttributes() ?>><span id="el_imagen">
<div id="old_x_imagen">
<?php if ($servicios->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $servicios->imagen->UploadPath) . $servicios->imagen->Upload->DbValue ?>" border=0<?php echo $servicios->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($servicios->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $servicios->imagen->UploadPath) . $servicios->imagen->Upload->DbValue ?>" border=0<?php echo $servicios->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($servicios->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_imagen">
<?php if (!empty($servicios->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a_imagen" id="a_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $servicios->imagen->EditAttrs["onchange"] = "this.form.a_imagen[2].checked=true;" . @$servicios->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="3">
<?php } ?>
<input type="file" name="x_imagen" id="x_imagen" size="30"<?php echo $servicios->imagen->EditAttributes() ?>>
</div>
</span><?php echo $servicios->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($servicios->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $servicios->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $servicios->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $servicios->estatus->EditAttributes() ?>>
<?php
if (is_array($servicios->estatus->EditValue)) {
	$arwrk = $servicios->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($servicios->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $servicios->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_servicios" id="x_id_servicios" value="<?php echo ew_HtmlEncode($servicios->id_servicios->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$servicios_edit->ShowPageFooter();
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
$servicios_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cservicios_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'servicios';

	// Page object name
	var $PageObjName = 'servicios_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $servicios;
		if ($servicios->UseTokenInUrl) $PageUrl .= "t=" . $servicios->TableVar . "&"; // Add page token
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
		global $objForm, $servicios;
		if ($servicios->UseTokenInUrl) {
			if ($objForm)
				return ($servicios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($servicios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cservicios_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (servicios)
		if (!isset($GLOBALS["servicios"])) {
			$GLOBALS["servicios"] = new cservicios();
			$GLOBALS["Table"] =& $GLOBALS["servicios"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'servicios', TRUE);

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
		global $servicios;

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
			$this->Page_Terminate("servicioslist.php");
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
		global $objForm, $Language, $gsFormError, $servicios;

		// Load key from QueryString
		if (@$_GET["id_servicios"] <> "")
			$servicios->id_servicios->setQueryStringValue($_GET["id_servicios"]);
		if (@$_POST["a_edit"] <> "") {
			$servicios->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$servicios->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$servicios->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$servicios->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($servicios->id_servicios->CurrentValue == "")
			$this->Page_Terminate("servicioslist.php"); // Invalid key, return to list
		switch ($servicios->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("servicioslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$servicios->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $servicios->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$servicios->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$servicios->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$servicios->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $servicios;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$servicios->imagen->Upload->Index = $objForm->Index;
		$servicios->imagen->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$servicios->imagen->Upload->RestoreFromSession();
		} else {
			if ($servicios->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $servicios->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$servicios->imagen->Upload->SaveToSession();
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $servicios;
		$this->GetUploadFiles(); // Get upload files
		if (!$servicios->nombre->FldIsDetailKey) {
			$servicios->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$servicios->estatus->FldIsDetailKey) {
			$servicios->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$servicios->id_servicios->FldIsDetailKey)
			$servicios->id_servicios->setFormValue($objForm->GetValue("x_id_servicios"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $servicios;
		$this->LoadRow();
		$servicios->id_servicios->CurrentValue = $servicios->id_servicios->FormValue;
		$servicios->nombre->CurrentValue = $servicios->nombre->FormValue;
		$servicios->estatus->CurrentValue = $servicios->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $servicios;
		$sFilter = $servicios->KeyFilter();

		// Call Row Selecting event
		$servicios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$servicios->CurrentFilter = $sFilter;
		$sSql = $servicios->SQL();
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
		global $conn, $servicios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$servicios->Row_Selected($row);
		$servicios->id_servicios->setDbValue($rs->fields('id_servicios'));
		$servicios->nombre->setDbValue($rs->fields('nombre'));
		$servicios->imagen->Upload->DbValue = $rs->fields('imagen');
		$servicios->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $servicios;

		// Initialize URLs
		// Call Row_Rendering event

		$servicios->Row_Rendering();

		// Common render codes for all row types
		// id_servicios
		// nombre
		// imagen
		// estatus

		if ($servicios->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$servicios->nombre->ViewValue = $servicios->nombre->CurrentValue;
			$servicios->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($servicios->imagen->Upload->DbValue)) {
				$servicios->imagen->ViewValue = $servicios->imagen->Upload->DbValue;
				$servicios->imagen->ImageWidth = 30;
				$servicios->imagen->ImageHeight = 30;
				$servicios->imagen->ImageAlt = $servicios->imagen->FldAlt();
			} else {
				$servicios->imagen->ViewValue = "";
			}
			$servicios->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($servicios->estatus->CurrentValue) <> "") {
				switch ($servicios->estatus->CurrentValue) {
					case "0":
						$servicios->estatus->ViewValue = $servicios->estatus->FldTagCaption(1) <> "" ? $servicios->estatus->FldTagCaption(1) : $servicios->estatus->CurrentValue;
						break;
					case "1":
						$servicios->estatus->ViewValue = $servicios->estatus->FldTagCaption(2) <> "" ? $servicios->estatus->FldTagCaption(2) : $servicios->estatus->CurrentValue;
						break;
					default:
						$servicios->estatus->ViewValue = $servicios->estatus->CurrentValue;
				}
			} else {
				$servicios->estatus->ViewValue = NULL;
			}
			$servicios->estatus->ViewCustomAttributes = "";

			// nombre
			$servicios->nombre->LinkCustomAttributes = "";
			$servicios->nombre->HrefValue = "";
			$servicios->nombre->TooltipValue = "";

			// imagen
			$servicios->imagen->LinkCustomAttributes = "";
			$servicios->imagen->HrefValue = "";
			$servicios->imagen->TooltipValue = "";

			// estatus
			$servicios->estatus->LinkCustomAttributes = "";
			$servicios->estatus->HrefValue = "";
			$servicios->estatus->TooltipValue = "";
		} elseif ($servicios->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$servicios->nombre->EditCustomAttributes = "";
			$servicios->nombre->EditValue = ew_HtmlEncode($servicios->nombre->CurrentValue);

			// imagen
			$servicios->imagen->EditCustomAttributes = "";
			if (!ew_Empty($servicios->imagen->Upload->DbValue)) {
				$servicios->imagen->EditValue = $servicios->imagen->Upload->DbValue;
				$servicios->imagen->ImageWidth = 30;
				$servicios->imagen->ImageHeight = 30;
				$servicios->imagen->ImageAlt = $servicios->imagen->FldAlt();
			} else {
				$servicios->imagen->EditValue = "";
			}

			// estatus
			$servicios->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", $servicios->estatus->FldTagCaption(1) <> "" ? $servicios->estatus->FldTagCaption(1) : "0");
			$arwrk[] = array("1", $servicios->estatus->FldTagCaption(2) <> "" ? $servicios->estatus->FldTagCaption(2) : "1");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$servicios->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$servicios->nombre->HrefValue = "";

			// imagen
			$servicios->imagen->HrefValue = "";

			// estatus
			$servicios->estatus->HrefValue = "";
		}
		if ($servicios->RowType == EW_ROWTYPE_ADD ||
			$servicios->RowType == EW_ROWTYPE_EDIT ||
			$servicios->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$servicios->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($servicios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$servicios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $servicios;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($servicios->imagen->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($servicios->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $servicios->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($servicios->imagen->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $servicios->imagen->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($servicios->estatus->FormValue) && $servicios->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $servicios->estatus->FldCaption());
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
		global $conn, $Security, $Language, $servicios;
		$sFilter = $servicios->KeyFilter();
		$servicios->CurrentFilter = $sFilter;
		$sSql = $servicios->SQL();
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
			$servicios->nombre->SetDbValueDef($rsnew, $servicios->nombre->CurrentValue, NULL, $servicios->nombre->ReadOnly);

			// imagen
			if ($servicios->imagen->Upload->Action == "1") { // Keep
			} elseif ($servicios->imagen->Upload->Action == "2" || $servicios->imagen->Upload->Action == "3") { // Update/Remove
			$servicios->imagen->Upload->DbValue = $rs->fields('imagen'); // Get original value
			if (is_null($servicios->imagen->Upload->Value)) {
				$rsnew['imagen'] = NULL;
			} else {
				$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $servicios->imagen->UploadPath), $servicios->imagen->Upload->FileName);
			}
			}

			// estatus
			$servicios->estatus->SetDbValueDef($rsnew, $servicios->estatus->CurrentValue, NULL, $servicios->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $servicios->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($servicios->imagen->Upload->Value)) {
				$servicios->imagen->Upload->SaveToFile($servicios->imagen->UploadPath, $rsnew['imagen'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($servicios->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($servicios->CancelMessage <> "") {
					$this->setFailureMessage($servicios->CancelMessage);
					$servicios->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$servicios->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// imagen
		$servicios->imagen->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'servicios';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $servicios;
		$table = 'servicios';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_servicios'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($servicios->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($servicios->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($servicios->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($servicios->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
