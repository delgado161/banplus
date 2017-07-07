<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "estado_civilinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$estado_civil_edit = new cestado_civil_edit();
$Page =& $estado_civil_edit;

// Page init
$estado_civil_edit->Page_Init();

// Page main
$estado_civil_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var estado_civil_edit = new ew_Page("estado_civil_edit");

// page properties
estado_civil_edit.PageID = "edit"; // page ID
estado_civil_edit.FormID = "festado_civiledit"; // form ID
var EW_PAGE_ID = estado_civil_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
estado_civil_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($estado_civil->visibilidad->FldCaption()) ?>");

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
estado_civil_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
estado_civil_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
estado_civil_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $estado_civil->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $estado_civil->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $estado_civil_edit->ShowPageHeader(); ?>
<?php
$estado_civil_edit->ShowMessage();
?>
<form name="festado_civiledit" id="festado_civiledit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return estado_civil_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="estado_civil">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($estado_civil->id_civil->Visible) { // id_civil ?>
	<tr id="r_id_civil"<?php echo $estado_civil->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado_civil->id_civil->FldCaption() ?></td>
		<td<?php echo $estado_civil->id_civil->CellAttributes() ?>><span id="el_id_civil">
<div<?php echo $estado_civil->id_civil->ViewAttributes() ?>><?php echo $estado_civil->id_civil->EditValue ?></div>
<input type="hidden" name="x_id_civil" id="x_id_civil" value="<?php echo ew_HtmlEncode($estado_civil->id_civil->CurrentValue) ?>">
</span><?php echo $estado_civil->id_civil->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($estado_civil->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $estado_civil->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado_civil->nombre->FldCaption() ?></td>
		<td<?php echo $estado_civil->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $estado_civil->nombre->EditValue ?>"<?php echo $estado_civil->nombre->EditAttributes() ?>>
</span><?php echo $estado_civil->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($estado_civil->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $estado_civil->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado_civil->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $estado_civil->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<div id="tp_x_visibilidad" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="{value}"<?php echo $estado_civil->visibilidad->EditAttributes() ?>></label></div>
<div id="dsl_x_visibilidad" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $estado_civil->visibilidad->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($estado_civil->visibilidad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $estado_civil->visibilidad->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $estado_civil->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$estado_civil_edit->ShowPageFooter();
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
$estado_civil_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cestado_civil_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'estado_civil';

	// Page object name
	var $PageObjName = 'estado_civil_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $estado_civil;
		if ($estado_civil->UseTokenInUrl) $PageUrl .= "t=" . $estado_civil->TableVar . "&"; // Add page token
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
		global $objForm, $estado_civil;
		if ($estado_civil->UseTokenInUrl) {
			if ($objForm)
				return ($estado_civil->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($estado_civil->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cestado_civil_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (estado_civil)
		if (!isset($GLOBALS["estado_civil"])) {
			$GLOBALS["estado_civil"] = new cestado_civil();
			$GLOBALS["Table"] =& $GLOBALS["estado_civil"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'estado_civil', TRUE);

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
		global $estado_civil;

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
		global $objForm, $Language, $gsFormError, $estado_civil;

		// Load key from QueryString
		if (@$_GET["id_civil"] <> "")
			$estado_civil->id_civil->setQueryStringValue($_GET["id_civil"]);
		if (@$_POST["a_edit"] <> "") {
			$estado_civil->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$estado_civil->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$estado_civil->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$estado_civil->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($estado_civil->id_civil->CurrentValue == "")
			$this->Page_Terminate("estado_civillist.php"); // Invalid key, return to list
		switch ($estado_civil->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("estado_civillist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$estado_civil->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $estado_civil->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$estado_civil->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$estado_civil->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$estado_civil->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $estado_civil;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $estado_civil;
		if (!$estado_civil->id_civil->FldIsDetailKey)
			$estado_civil->id_civil->setFormValue($objForm->GetValue("x_id_civil"));
		if (!$estado_civil->nombre->FldIsDetailKey) {
			$estado_civil->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$estado_civil->visibilidad->FldIsDetailKey) {
			$estado_civil->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $estado_civil;
		$this->LoadRow();
		$estado_civil->id_civil->CurrentValue = $estado_civil->id_civil->FormValue;
		$estado_civil->nombre->CurrentValue = $estado_civil->nombre->FormValue;
		$estado_civil->visibilidad->CurrentValue = $estado_civil->visibilidad->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $estado_civil;
		$sFilter = $estado_civil->KeyFilter();

		// Call Row Selecting event
		$estado_civil->Row_Selecting($sFilter);

		// Load SQL based on filter
		$estado_civil->CurrentFilter = $sFilter;
		$sSql = $estado_civil->SQL();
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
		global $conn, $estado_civil;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$estado_civil->Row_Selected($row);
		$estado_civil->id_civil->setDbValue($rs->fields('id_civil'));
		$estado_civil->nombre->setDbValue($rs->fields('nombre'));
		$estado_civil->id_char->setDbValue($rs->fields('id_char'));
		$estado_civil->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $estado_civil;

		// Initialize URLs
		// Call Row_Rendering event

		$estado_civil->Row_Rendering();

		// Common render codes for all row types
		// id_civil
		// nombre
		// id_char
		// visibilidad

		if ($estado_civil->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_civil
			$estado_civil->id_civil->ViewValue = $estado_civil->id_civil->CurrentValue;
			$estado_civil->id_civil->ViewCustomAttributes = "";

			// nombre
			$estado_civil->nombre->ViewValue = $estado_civil->nombre->CurrentValue;
			$estado_civil->nombre->ViewCustomAttributes = "";

			// id_char
			$estado_civil->id_char->ViewValue = $estado_civil->id_char->CurrentValue;
			$estado_civil->id_char->ViewCustomAttributes = "";

			// visibilidad
			if (strval($estado_civil->visibilidad->CurrentValue) <> "") {
				switch ($estado_civil->visibilidad->CurrentValue) {
					case "1":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(1) <> "" ? $estado_civil->visibilidad->FldTagCaption(1) : $estado_civil->visibilidad->CurrentValue;
						break;
					case "0":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(2) <> "" ? $estado_civil->visibilidad->FldTagCaption(2) : $estado_civil->visibilidad->CurrentValue;
						break;
					default:
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->CurrentValue;
				}
			} else {
				$estado_civil->visibilidad->ViewValue = NULL;
			}
			$estado_civil->visibilidad->ViewCustomAttributes = "";

			// id_civil
			$estado_civil->id_civil->LinkCustomAttributes = "";
			$estado_civil->id_civil->HrefValue = "";
			$estado_civil->id_civil->TooltipValue = "";

			// nombre
			$estado_civil->nombre->LinkCustomAttributes = "";
			$estado_civil->nombre->HrefValue = "";
			$estado_civil->nombre->TooltipValue = "";

			// visibilidad
			$estado_civil->visibilidad->LinkCustomAttributes = "";
			$estado_civil->visibilidad->HrefValue = "";
			$estado_civil->visibilidad->TooltipValue = "";
		} elseif ($estado_civil->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_civil
			$estado_civil->id_civil->EditCustomAttributes = "";
			$estado_civil->id_civil->EditValue = $estado_civil->id_civil->CurrentValue;
			$estado_civil->id_civil->ViewCustomAttributes = "";

			// nombre
			$estado_civil->nombre->EditCustomAttributes = "";
			$estado_civil->nombre->EditValue = ew_HtmlEncode($estado_civil->nombre->CurrentValue);

			// visibilidad
			$estado_civil->visibilidad->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $estado_civil->visibilidad->FldTagCaption(1) <> "" ? $estado_civil->visibilidad->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $estado_civil->visibilidad->FldTagCaption(2) <> "" ? $estado_civil->visibilidad->FldTagCaption(2) : "0");
			$estado_civil->visibilidad->EditValue = $arwrk;

			// Edit refer script
			// id_civil

			$estado_civil->id_civil->HrefValue = "";

			// nombre
			$estado_civil->nombre->HrefValue = "";

			// visibilidad
			$estado_civil->visibilidad->HrefValue = "";
		}
		if ($estado_civil->RowType == EW_ROWTYPE_ADD ||
			$estado_civil->RowType == EW_ROWTYPE_EDIT ||
			$estado_civil->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$estado_civil->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($estado_civil->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$estado_civil->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $estado_civil;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($estado_civil->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $estado_civil->visibilidad->FldCaption());
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
		global $conn, $Security, $Language, $estado_civil;
		$sFilter = $estado_civil->KeyFilter();
		$estado_civil->CurrentFilter = $sFilter;
		$sSql = $estado_civil->SQL();
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
			$estado_civil->nombre->SetDbValueDef($rsnew, $estado_civil->nombre->CurrentValue, NULL, $estado_civil->nombre->ReadOnly);

			// visibilidad
			$estado_civil->visibilidad->SetDbValueDef($rsnew, $estado_civil->visibilidad->CurrentValue, 0, $estado_civil->visibilidad->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $estado_civil->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($estado_civil->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($estado_civil->CancelMessage <> "") {
					$this->setFailureMessage($estado_civil->CancelMessage);
					$estado_civil->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$estado_civil->Row_Updated($rsold, $rsnew);
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
