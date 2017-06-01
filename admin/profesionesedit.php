<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "profesionesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$profesiones_edit = new cprofesiones_edit();
$Page =& $profesiones_edit;

// Page init
$profesiones_edit->Page_Init();

// Page main
$profesiones_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var profesiones_edit = new ew_Page("profesiones_edit");

// page properties
profesiones_edit.PageID = "edit"; // page ID
profesiones_edit.FormID = "fprofesionesedit"; // form ID
var EW_PAGE_ID = profesiones_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
profesiones_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_id_profesion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($profesiones->id_profesion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_profesion"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($profesiones->id_profesion->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_descripcion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($profesiones->descripcion->FldCaption()) ?>");

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
profesiones_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
profesiones_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
profesiones_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $profesiones->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $profesiones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $profesiones_edit->ShowPageHeader(); ?>
<?php
$profesiones_edit->ShowMessage();
?>
<form name="fprofesionesedit" id="fprofesionesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return profesiones_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="profesiones">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($profesiones->id_profesion->Visible) { // id_profesion ?>
	<tr id="r_id_profesion"<?php echo $profesiones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $profesiones->id_profesion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $profesiones->id_profesion->CellAttributes() ?>><span id="el_id_profesion">
<div<?php echo $profesiones->id_profesion->ViewAttributes() ?>><?php echo $profesiones->id_profesion->EditValue ?></div>
<input type="hidden" name="x_id_profesion" id="x_id_profesion" value="<?php echo ew_HtmlEncode($profesiones->id_profesion->CurrentValue) ?>">
</span><?php echo $profesiones->id_profesion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($profesiones->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion"<?php echo $profesiones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $profesiones->descripcion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $profesiones->descripcion->CellAttributes() ?>><span id="el_descripcion">
<input type="text" name="x_descripcion" id="x_descripcion" size="30" maxlength="100" value="<?php echo $profesiones->descripcion->EditValue ?>"<?php echo $profesiones->descripcion->EditAttributes() ?>>
</span><?php echo $profesiones->descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$profesiones_edit->ShowPageFooter();
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
$profesiones_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cprofesiones_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'profesiones';

	// Page object name
	var $PageObjName = 'profesiones_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $profesiones;
		if ($profesiones->UseTokenInUrl) $PageUrl .= "t=" . $profesiones->TableVar . "&"; // Add page token
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
		global $objForm, $profesiones;
		if ($profesiones->UseTokenInUrl) {
			if ($objForm)
				return ($profesiones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($profesiones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprofesiones_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (profesiones)
		if (!isset($GLOBALS["profesiones"])) {
			$GLOBALS["profesiones"] = new cprofesiones();
			$GLOBALS["Table"] =& $GLOBALS["profesiones"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'profesiones', TRUE);

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
		global $profesiones;

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
		global $objForm, $Language, $gsFormError, $profesiones;

		// Load key from QueryString
		if (@$_GET["id_profesion"] <> "")
			$profesiones->id_profesion->setQueryStringValue($_GET["id_profesion"]);
		if (@$_POST["a_edit"] <> "") {
			$profesiones->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$profesiones->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$profesiones->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$profesiones->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($profesiones->id_profesion->CurrentValue == "")
			$this->Page_Terminate("profesioneslist.php"); // Invalid key, return to list
		switch ($profesiones->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("profesioneslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$profesiones->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $profesiones->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$profesiones->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$profesiones->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$profesiones->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $profesiones;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $profesiones;
		if (!$profesiones->id_profesion->FldIsDetailKey) {
			$profesiones->id_profesion->setFormValue($objForm->GetValue("x_id_profesion"));
		}
		if (!$profesiones->descripcion->FldIsDetailKey) {
			$profesiones->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $profesiones;
		$this->LoadRow();
		$profesiones->id_profesion->CurrentValue = $profesiones->id_profesion->FormValue;
		$profesiones->descripcion->CurrentValue = $profesiones->descripcion->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $profesiones;
		$sFilter = $profesiones->KeyFilter();

		// Call Row Selecting event
		$profesiones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$profesiones->CurrentFilter = $sFilter;
		$sSql = $profesiones->SQL();
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
		global $conn, $profesiones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$profesiones->Row_Selected($row);
		$profesiones->id_profesion->setDbValue($rs->fields('id_profesion'));
		$profesiones->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $profesiones;

		// Initialize URLs
		// Call Row_Rendering event

		$profesiones->Row_Rendering();

		// Common render codes for all row types
		// id_profesion
		// descripcion

		if ($profesiones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profesion
			$profesiones->id_profesion->ViewValue = $profesiones->id_profesion->CurrentValue;
			$profesiones->id_profesion->ViewCustomAttributes = "";

			// descripcion
			$profesiones->descripcion->ViewValue = $profesiones->descripcion->CurrentValue;
			$profesiones->descripcion->ViewCustomAttributes = "";

			// id_profesion
			$profesiones->id_profesion->LinkCustomAttributes = "";
			$profesiones->id_profesion->HrefValue = "";
			$profesiones->id_profesion->TooltipValue = "";

			// descripcion
			$profesiones->descripcion->LinkCustomAttributes = "";
			$profesiones->descripcion->HrefValue = "";
			$profesiones->descripcion->TooltipValue = "";
		} elseif ($profesiones->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_profesion
			$profesiones->id_profesion->EditCustomAttributes = "";
			$profesiones->id_profesion->EditValue = $profesiones->id_profesion->CurrentValue;
			$profesiones->id_profesion->ViewCustomAttributes = "";

			// descripcion
			$profesiones->descripcion->EditCustomAttributes = "";
			$profesiones->descripcion->EditValue = ew_HtmlEncode($profesiones->descripcion->CurrentValue);

			// Edit refer script
			// id_profesion

			$profesiones->id_profesion->HrefValue = "";

			// descripcion
			$profesiones->descripcion->HrefValue = "";
		}
		if ($profesiones->RowType == EW_ROWTYPE_ADD ||
			$profesiones->RowType == EW_ROWTYPE_EDIT ||
			$profesiones->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$profesiones->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($profesiones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$profesiones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $profesiones;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($profesiones->id_profesion->FormValue) && $profesiones->id_profesion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $profesiones->id_profesion->FldCaption());
		}
		if (!ew_CheckInteger($profesiones->id_profesion->FormValue)) {
			ew_AddMessage($gsFormError, $profesiones->id_profesion->FldErrMsg());
		}
		if (!is_null($profesiones->descripcion->FormValue) && $profesiones->descripcion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $profesiones->descripcion->FldCaption());
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
		global $conn, $Security, $Language, $profesiones;
		$sFilter = $profesiones->KeyFilter();
		$profesiones->CurrentFilter = $sFilter;
		$sSql = $profesiones->SQL();
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

			// id_profesion
			// descripcion

			$profesiones->descripcion->SetDbValueDef($rsnew, $profesiones->descripcion->CurrentValue, "", $profesiones->descripcion->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $profesiones->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($profesiones->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($profesiones->CancelMessage <> "") {
					$this->setFailureMessage($profesiones->CancelMessage);
					$profesiones->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$profesiones->Row_Updated($rsold, $rsnew);
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
