<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_paisesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_paises_edit = new cz_paises_edit();
$Page =& $z_paises_edit;

// Page init
$z_paises_edit->Page_Init();

// Page main
$z_paises_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_paises_edit = new ew_Page("z_paises_edit");

// page properties
z_paises_edit.PageID = "edit"; // page ID
z_paises_edit.FormID = "fz_paisesedit"; // form ID
var EW_PAGE_ID = z_paises_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
z_paises_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_lp_pais_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_paises->lp_pais_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_paises->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_paises->visibilidad->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_paises->visibilidad->FldErrMsg()) ?>");

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
z_paises_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_paises_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_paises_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_paises->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_paises->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_paises_edit->ShowPageHeader(); ?>
<?php
$z_paises_edit->ShowMessage();
?>
<form name="fz_paisesedit" id="fz_paisesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_paises_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="z_paises">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_paises->lp_pais_id->Visible) { // lp_pais_id ?>
	<tr id="r_lp_pais_id"<?php echo $z_paises->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_paises->lp_pais_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_paises->lp_pais_id->CellAttributes() ?>><span id="el_lp_pais_id">
<div<?php echo $z_paises->lp_pais_id->ViewAttributes() ?>><?php echo $z_paises->lp_pais_id->EditValue ?></div>
<input type="hidden" name="x_lp_pais_id" id="x_lp_pais_id" value="<?php echo ew_HtmlEncode($z_paises->lp_pais_id->CurrentValue) ?>">
</span><?php echo $z_paises->lp_pais_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_paises->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $z_paises->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_paises->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_paises->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="25" value="<?php echo $z_paises->nombre->EditValue ?>"<?php echo $z_paises->nombre->EditAttributes() ?>>
</span><?php echo $z_paises->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_paises->nacionalidad->Visible) { // nacionalidad ?>
	<tr id="r_nacionalidad"<?php echo $z_paises->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_paises->nacionalidad->FldCaption() ?></td>
		<td<?php echo $z_paises->nacionalidad->CellAttributes() ?>><span id="el_nacionalidad">
<input type="text" name="x_nacionalidad" id="x_nacionalidad" size="30" maxlength="100" value="<?php echo $z_paises->nacionalidad->EditValue ?>"<?php echo $z_paises->nacionalidad->EditAttributes() ?>>
</span><?php echo $z_paises->nacionalidad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_paises->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_paises->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_paises->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_paises->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<input type="text" name="x_visibilidad" id="x_visibilidad" size="30" value="<?php echo $z_paises->visibilidad->EditValue ?>"<?php echo $z_paises->visibilidad->EditAttributes() ?>>
</span><?php echo $z_paises->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$z_paises_edit->ShowPageFooter();
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
$z_paises_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_paises_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = '_paises';

	// Page object name
	var $PageObjName = 'z_paises_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_paises;
		if ($z_paises->UseTokenInUrl) $PageUrl .= "t=" . $z_paises->TableVar . "&"; // Add page token
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
		global $objForm, $z_paises;
		if ($z_paises->UseTokenInUrl) {
			if ($objForm)
				return ($z_paises->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_paises->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_paises_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_paises)
		if (!isset($GLOBALS["z_paises"])) {
			$GLOBALS["z_paises"] = new cz_paises();
			$GLOBALS["Table"] =& $GLOBALS["z_paises"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_paises', TRUE);

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
		global $z_paises;

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
		global $objForm, $Language, $gsFormError, $z_paises;

		// Load key from QueryString
		if (@$_GET["lp_pais_id"] <> "")
			$z_paises->lp_pais_id->setQueryStringValue($_GET["lp_pais_id"]);
		if (@$_POST["a_edit"] <> "") {
			$z_paises->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_paises->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$z_paises->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$z_paises->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($z_paises->lp_pais_id->CurrentValue == "")
			$this->Page_Terminate("z_paiseslist.php"); // Invalid key, return to list
		switch ($z_paises->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_paiseslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$z_paises->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $z_paises->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$z_paises->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$z_paises->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$z_paises->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $z_paises;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_paises;
		if (!$z_paises->lp_pais_id->FldIsDetailKey) {
			$z_paises->lp_pais_id->setFormValue($objForm->GetValue("x_lp_pais_id"));
		}
		if (!$z_paises->nombre->FldIsDetailKey) {
			$z_paises->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$z_paises->nacionalidad->FldIsDetailKey) {
			$z_paises->nacionalidad->setFormValue($objForm->GetValue("x_nacionalidad"));
		}
		if (!$z_paises->visibilidad->FldIsDetailKey) {
			$z_paises->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $z_paises;
		$this->LoadRow();
		$z_paises->lp_pais_id->CurrentValue = $z_paises->lp_pais_id->FormValue;
		$z_paises->nombre->CurrentValue = $z_paises->nombre->FormValue;
		$z_paises->nacionalidad->CurrentValue = $z_paises->nacionalidad->FormValue;
		$z_paises->visibilidad->CurrentValue = $z_paises->visibilidad->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_paises;
		$sFilter = $z_paises->KeyFilter();

		// Call Row Selecting event
		$z_paises->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_paises->CurrentFilter = $sFilter;
		$sSql = $z_paises->SQL();
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
		global $conn, $z_paises;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_paises->Row_Selected($row);
		$z_paises->lp_pais_id->setDbValue($rs->fields('lp_pais_id'));
		$z_paises->nombre->setDbValue($rs->fields('nombre'));
		$z_paises->nacionalidad->setDbValue($rs->fields('nacionalidad'));
		$z_paises->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_paises;

		// Initialize URLs
		// Call Row_Rendering event

		$z_paises->Row_Rendering();

		// Common render codes for all row types
		// lp_pais_id
		// nombre
		// nacionalidad
		// visibilidad

		if ($z_paises->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_pais_id
			$z_paises->lp_pais_id->ViewValue = $z_paises->lp_pais_id->CurrentValue;
			$z_paises->lp_pais_id->ViewCustomAttributes = "";

			// nombre
			$z_paises->nombre->ViewValue = $z_paises->nombre->CurrentValue;
			$z_paises->nombre->ViewCustomAttributes = "";

			// nacionalidad
			$z_paises->nacionalidad->ViewValue = $z_paises->nacionalidad->CurrentValue;
			$z_paises->nacionalidad->ViewCustomAttributes = "";

			// visibilidad
			$z_paises->visibilidad->ViewValue = $z_paises->visibilidad->CurrentValue;
			$z_paises->visibilidad->ViewCustomAttributes = "";

			// lp_pais_id
			$z_paises->lp_pais_id->LinkCustomAttributes = "";
			$z_paises->lp_pais_id->HrefValue = "";
			$z_paises->lp_pais_id->TooltipValue = "";

			// nombre
			$z_paises->nombre->LinkCustomAttributes = "";
			$z_paises->nombre->HrefValue = "";
			$z_paises->nombre->TooltipValue = "";

			// nacionalidad
			$z_paises->nacionalidad->LinkCustomAttributes = "";
			$z_paises->nacionalidad->HrefValue = "";
			$z_paises->nacionalidad->TooltipValue = "";

			// visibilidad
			$z_paises->visibilidad->LinkCustomAttributes = "";
			$z_paises->visibilidad->HrefValue = "";
			$z_paises->visibilidad->TooltipValue = "";
		} elseif ($z_paises->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// lp_pais_id
			$z_paises->lp_pais_id->EditCustomAttributes = "";
			$z_paises->lp_pais_id->EditValue = $z_paises->lp_pais_id->CurrentValue;
			$z_paises->lp_pais_id->ViewCustomAttributes = "";

			// nombre
			$z_paises->nombre->EditCustomAttributes = "";
			$z_paises->nombre->EditValue = ew_HtmlEncode($z_paises->nombre->CurrentValue);

			// nacionalidad
			$z_paises->nacionalidad->EditCustomAttributes = "";
			$z_paises->nacionalidad->EditValue = ew_HtmlEncode($z_paises->nacionalidad->CurrentValue);

			// visibilidad
			$z_paises->visibilidad->EditCustomAttributes = "";
			$z_paises->visibilidad->EditValue = ew_HtmlEncode($z_paises->visibilidad->CurrentValue);

			// Edit refer script
			// lp_pais_id

			$z_paises->lp_pais_id->HrefValue = "";

			// nombre
			$z_paises->nombre->HrefValue = "";

			// nacionalidad
			$z_paises->nacionalidad->HrefValue = "";

			// visibilidad
			$z_paises->visibilidad->HrefValue = "";
		}
		if ($z_paises->RowType == EW_ROWTYPE_ADD ||
			$z_paises->RowType == EW_ROWTYPE_EDIT ||
			$z_paises->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$z_paises->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($z_paises->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_paises->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $z_paises;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($z_paises->lp_pais_id->FormValue) && $z_paises->lp_pais_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_paises->lp_pais_id->FldCaption());
		}
		if (!is_null($z_paises->nombre->FormValue) && $z_paises->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_paises->nombre->FldCaption());
		}
		if (!is_null($z_paises->visibilidad->FormValue) && $z_paises->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_paises->visibilidad->FldCaption());
		}
		if (!ew_CheckInteger($z_paises->visibilidad->FormValue)) {
			ew_AddMessage($gsFormError, $z_paises->visibilidad->FldErrMsg());
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
		global $conn, $Security, $Language, $z_paises;
		$sFilter = $z_paises->KeyFilter();
		$z_paises->CurrentFilter = $sFilter;
		$sSql = $z_paises->SQL();
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

			// lp_pais_id
			// nombre

			$z_paises->nombre->SetDbValueDef($rsnew, $z_paises->nombre->CurrentValue, "", $z_paises->nombre->ReadOnly);

			// nacionalidad
			$z_paises->nacionalidad->SetDbValueDef($rsnew, $z_paises->nacionalidad->CurrentValue, NULL, $z_paises->nacionalidad->ReadOnly);

			// visibilidad
			$z_paises->visibilidad->SetDbValueDef($rsnew, $z_paises->visibilidad->CurrentValue, 0, $z_paises->visibilidad->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $z_paises->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($z_paises->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($z_paises->CancelMessage <> "") {
					$this->setFailureMessage($z_paises->CancelMessage);
					$z_paises->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$z_paises->Row_Updated($rsold, $rsnew);
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
