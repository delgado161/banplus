<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_bancosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_bancos_edit = new cz_bancos_edit();
$Page =& $z_bancos_edit;

// Page init
$z_bancos_edit->Page_Init();

// Page main
$z_bancos_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_bancos_edit = new ew_Page("z_bancos_edit");

// page properties
z_bancos_edit.PageID = "edit"; // page ID
z_bancos_edit.FormID = "fz_bancosedit"; // form ID
var EW_PAGE_ID = z_bancos_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
z_bancos_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_banco"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_bancos->banco->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_bancos->visibilidad->FldCaption()) ?>");

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
z_bancos_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_bancos_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_bancos_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_bancos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_bancos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_bancos_edit->ShowPageHeader(); ?>
<?php
$z_bancos_edit->ShowMessage();
?>
<form name="fz_bancosedit" id="fz_bancosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_bancos_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="z_bancos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_bancos->id_bancos->Visible) { // id_bancos ?>
	<tr id="r_id_bancos"<?php echo $z_bancos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_bancos->id_bancos->FldCaption() ?></td>
		<td<?php echo $z_bancos->id_bancos->CellAttributes() ?>><span id="el_id_bancos">
<div<?php echo $z_bancos->id_bancos->ViewAttributes() ?>><?php echo $z_bancos->id_bancos->EditValue ?></div>
<input type="hidden" name="x_id_bancos" id="x_id_bancos" value="<?php echo ew_HtmlEncode($z_bancos->id_bancos->CurrentValue) ?>">
</span><?php echo $z_bancos->id_bancos->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_bancos->banco->Visible) { // banco ?>
	<tr id="r_banco"<?php echo $z_bancos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_bancos->banco->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_bancos->banco->CellAttributes() ?>><span id="el_banco">
<input type="text" name="x_banco" id="x_banco" size="30" maxlength="100" value="<?php echo $z_bancos->banco->EditValue ?>"<?php echo $z_bancos->banco->EditAttributes() ?>>
</span><?php echo $z_bancos->banco->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_bancos->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_bancos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_bancos->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_bancos->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<div id="tp_x_visibilidad" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="{value}"<?php echo $z_bancos->visibilidad->EditAttributes() ?>></label></div>
<div id="dsl_x_visibilidad" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $z_bancos->visibilidad->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($z_bancos->visibilidad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $z_bancos->visibilidad->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $z_bancos->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$z_bancos_edit->ShowPageFooter();
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
$z_bancos_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_bancos_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = '_bancos';

	// Page object name
	var $PageObjName = 'z_bancos_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_bancos;
		if ($z_bancos->UseTokenInUrl) $PageUrl .= "t=" . $z_bancos->TableVar . "&"; // Add page token
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
		global $objForm, $z_bancos;
		if ($z_bancos->UseTokenInUrl) {
			if ($objForm)
				return ($z_bancos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_bancos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_bancos_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_bancos)
		if (!isset($GLOBALS["z_bancos"])) {
			$GLOBALS["z_bancos"] = new cz_bancos();
			$GLOBALS["Table"] =& $GLOBALS["z_bancos"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_bancos', TRUE);

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
		global $z_bancos;

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
		global $objForm, $Language, $gsFormError, $z_bancos;

		// Load key from QueryString
		if (@$_GET["id_bancos"] <> "")
			$z_bancos->id_bancos->setQueryStringValue($_GET["id_bancos"]);
		if (@$_POST["a_edit"] <> "") {
			$z_bancos->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_bancos->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$z_bancos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$z_bancos->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($z_bancos->id_bancos->CurrentValue == "")
			$this->Page_Terminate("z_bancoslist.php"); // Invalid key, return to list
		switch ($z_bancos->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_bancoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$z_bancos->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $z_bancos->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$z_bancos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$z_bancos->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$z_bancos->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $z_bancos;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_bancos;
		if (!$z_bancos->id_bancos->FldIsDetailKey)
			$z_bancos->id_bancos->setFormValue($objForm->GetValue("x_id_bancos"));
		if (!$z_bancos->banco->FldIsDetailKey) {
			$z_bancos->banco->setFormValue($objForm->GetValue("x_banco"));
		}
		if (!$z_bancos->visibilidad->FldIsDetailKey) {
			$z_bancos->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $z_bancos;
		$this->LoadRow();
		$z_bancos->id_bancos->CurrentValue = $z_bancos->id_bancos->FormValue;
		$z_bancos->banco->CurrentValue = $z_bancos->banco->FormValue;
		$z_bancos->visibilidad->CurrentValue = $z_bancos->visibilidad->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_bancos;
		$sFilter = $z_bancos->KeyFilter();

		// Call Row Selecting event
		$z_bancos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_bancos->CurrentFilter = $sFilter;
		$sSql = $z_bancos->SQL();
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
		global $conn, $z_bancos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_bancos->Row_Selected($row);
		$z_bancos->id_bancos->setDbValue($rs->fields('id_bancos'));
		$z_bancos->banco->setDbValue($rs->fields('banco'));
		$z_bancos->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_bancos;

		// Initialize URLs
		// Call Row_Rendering event

		$z_bancos->Row_Rendering();

		// Common render codes for all row types
		// id_bancos
		// banco
		// visibilidad

		if ($z_bancos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_bancos
			$z_bancos->id_bancos->ViewValue = $z_bancos->id_bancos->CurrentValue;
			$z_bancos->id_bancos->ViewCustomAttributes = "";

			// banco
			$z_bancos->banco->ViewValue = $z_bancos->banco->CurrentValue;
			$z_bancos->banco->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_bancos->visibilidad->CurrentValue) <> "") {
				switch ($z_bancos->visibilidad->CurrentValue) {
					case "1":
						$z_bancos->visibilidad->ViewValue = $z_bancos->visibilidad->FldTagCaption(1) <> "" ? $z_bancos->visibilidad->FldTagCaption(1) : $z_bancos->visibilidad->CurrentValue;
						break;
					case "0":
						$z_bancos->visibilidad->ViewValue = $z_bancos->visibilidad->FldTagCaption(2) <> "" ? $z_bancos->visibilidad->FldTagCaption(2) : $z_bancos->visibilidad->CurrentValue;
						break;
					default:
						$z_bancos->visibilidad->ViewValue = $z_bancos->visibilidad->CurrentValue;
				}
			} else {
				$z_bancos->visibilidad->ViewValue = NULL;
			}
			$z_bancos->visibilidad->ViewCustomAttributes = "";

			// id_bancos
			$z_bancos->id_bancos->LinkCustomAttributes = "";
			$z_bancos->id_bancos->HrefValue = "";
			$z_bancos->id_bancos->TooltipValue = "";

			// banco
			$z_bancos->banco->LinkCustomAttributes = "";
			$z_bancos->banco->HrefValue = "";
			$z_bancos->banco->TooltipValue = "";

			// visibilidad
			$z_bancos->visibilidad->LinkCustomAttributes = "";
			$z_bancos->visibilidad->HrefValue = "";
			$z_bancos->visibilidad->TooltipValue = "";
		} elseif ($z_bancos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_bancos
			$z_bancos->id_bancos->EditCustomAttributes = "";
			$z_bancos->id_bancos->EditValue = $z_bancos->id_bancos->CurrentValue;
			$z_bancos->id_bancos->ViewCustomAttributes = "";

			// banco
			$z_bancos->banco->EditCustomAttributes = "";
			$z_bancos->banco->EditValue = ew_HtmlEncode($z_bancos->banco->CurrentValue);

			// visibilidad
			$z_bancos->visibilidad->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $z_bancos->visibilidad->FldTagCaption(1) <> "" ? $z_bancos->visibilidad->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $z_bancos->visibilidad->FldTagCaption(2) <> "" ? $z_bancos->visibilidad->FldTagCaption(2) : "0");
			$z_bancos->visibilidad->EditValue = $arwrk;

			// Edit refer script
			// id_bancos

			$z_bancos->id_bancos->HrefValue = "";

			// banco
			$z_bancos->banco->HrefValue = "";

			// visibilidad
			$z_bancos->visibilidad->HrefValue = "";
		}
		if ($z_bancos->RowType == EW_ROWTYPE_ADD ||
			$z_bancos->RowType == EW_ROWTYPE_EDIT ||
			$z_bancos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$z_bancos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($z_bancos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_bancos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $z_bancos;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($z_bancos->banco->FormValue) && $z_bancos->banco->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_bancos->banco->FldCaption());
		}
		if ($z_bancos->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_bancos->visibilidad->FldCaption());
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
		global $conn, $Security, $Language, $z_bancos;
		$sFilter = $z_bancos->KeyFilter();
		$z_bancos->CurrentFilter = $sFilter;
		$sSql = $z_bancos->SQL();
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

			// banco
			$z_bancos->banco->SetDbValueDef($rsnew, $z_bancos->banco->CurrentValue, "", $z_bancos->banco->ReadOnly);

			// visibilidad
			$z_bancos->visibilidad->SetDbValueDef($rsnew, $z_bancos->visibilidad->CurrentValue, 0, $z_bancos->visibilidad->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $z_bancos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($z_bancos->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($z_bancos->CancelMessage <> "") {
					$this->setFailureMessage($z_bancos->CancelMessage);
					$z_bancos->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$z_bancos->Row_Updated($rsold, $rsnew);
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
