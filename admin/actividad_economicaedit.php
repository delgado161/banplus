<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "actividad_economicainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$actividad_economica_edit = new cactividad_economica_edit();
$Page =& $actividad_economica_edit;

// Page init
$actividad_economica_edit->Page_Init();

// Page main
$actividad_economica_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var actividad_economica_edit = new ew_Page("actividad_economica_edit");

// page properties
actividad_economica_edit.PageID = "edit"; // page ID
actividad_economica_edit.FormID = "factividad_economicaedit"; // form ID
var EW_PAGE_ID = actividad_economica_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
actividad_economica_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_actividad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($actividad_economica->actividad->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($actividad_economica->visibilidad->FldCaption()) ?>");

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
actividad_economica_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
actividad_economica_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
actividad_economica_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $actividad_economica->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $actividad_economica->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $actividad_economica_edit->ShowPageHeader(); ?>
<?php
$actividad_economica_edit->ShowMessage();
?>
<form name="factividad_economicaedit" id="factividad_economicaedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return actividad_economica_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="actividad_economica">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($actividad_economica->id_acteconomica->Visible) { // id_acteconomica ?>
	<tr id="r_id_acteconomica"<?php echo $actividad_economica->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $actividad_economica->id_acteconomica->FldCaption() ?></td>
		<td<?php echo $actividad_economica->id_acteconomica->CellAttributes() ?>><span id="el_id_acteconomica">
<div<?php echo $actividad_economica->id_acteconomica->ViewAttributes() ?>><?php echo $actividad_economica->id_acteconomica->EditValue ?></div>
<input type="hidden" name="x_id_acteconomica" id="x_id_acteconomica" value="<?php echo ew_HtmlEncode($actividad_economica->id_acteconomica->CurrentValue) ?>">
</span><?php echo $actividad_economica->id_acteconomica->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($actividad_economica->actividad->Visible) { // actividad ?>
	<tr id="r_actividad"<?php echo $actividad_economica->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $actividad_economica->actividad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $actividad_economica->actividad->CellAttributes() ?>><span id="el_actividad">
<input type="text" name="x_actividad" id="x_actividad" size="30" maxlength="100" value="<?php echo $actividad_economica->actividad->EditValue ?>"<?php echo $actividad_economica->actividad->EditAttributes() ?>>
</span><?php echo $actividad_economica->actividad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($actividad_economica->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $actividad_economica->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $actividad_economica->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $actividad_economica->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<div id="tp_x_visibilidad" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="{value}"<?php echo $actividad_economica->visibilidad->EditAttributes() ?>></label></div>
<div id="dsl_x_visibilidad" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $actividad_economica->visibilidad->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($actividad_economica->visibilidad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $actividad_economica->visibilidad->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $actividad_economica->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$actividad_economica_edit->ShowPageFooter();
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
$actividad_economica_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cactividad_economica_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'actividad_economica';

	// Page object name
	var $PageObjName = 'actividad_economica_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $actividad_economica;
		if ($actividad_economica->UseTokenInUrl) $PageUrl .= "t=" . $actividad_economica->TableVar . "&"; // Add page token
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
		global $objForm, $actividad_economica;
		if ($actividad_economica->UseTokenInUrl) {
			if ($objForm)
				return ($actividad_economica->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($actividad_economica->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cactividad_economica_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (actividad_economica)
		if (!isset($GLOBALS["actividad_economica"])) {
			$GLOBALS["actividad_economica"] = new cactividad_economica();
			$GLOBALS["Table"] =& $GLOBALS["actividad_economica"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'actividad_economica', TRUE);

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
		global $actividad_economica;

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
		global $objForm, $Language, $gsFormError, $actividad_economica;

		// Load key from QueryString
		if (@$_GET["id_acteconomica"] <> "")
			$actividad_economica->id_acteconomica->setQueryStringValue($_GET["id_acteconomica"]);
		if (@$_POST["a_edit"] <> "") {
			$actividad_economica->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$actividad_economica->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$actividad_economica->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$actividad_economica->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($actividad_economica->id_acteconomica->CurrentValue == "")
			$this->Page_Terminate("actividad_economicalist.php"); // Invalid key, return to list
		switch ($actividad_economica->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("actividad_economicalist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$actividad_economica->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $actividad_economica->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$actividad_economica->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$actividad_economica->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$actividad_economica->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $actividad_economica;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $actividad_economica;
		if (!$actividad_economica->id_acteconomica->FldIsDetailKey)
			$actividad_economica->id_acteconomica->setFormValue($objForm->GetValue("x_id_acteconomica"));
		if (!$actividad_economica->actividad->FldIsDetailKey) {
			$actividad_economica->actividad->setFormValue($objForm->GetValue("x_actividad"));
		}
		if (!$actividad_economica->visibilidad->FldIsDetailKey) {
			$actividad_economica->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $actividad_economica;
		$this->LoadRow();
		$actividad_economica->id_acteconomica->CurrentValue = $actividad_economica->id_acteconomica->FormValue;
		$actividad_economica->actividad->CurrentValue = $actividad_economica->actividad->FormValue;
		$actividad_economica->visibilidad->CurrentValue = $actividad_economica->visibilidad->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $actividad_economica;
		$sFilter = $actividad_economica->KeyFilter();

		// Call Row Selecting event
		$actividad_economica->Row_Selecting($sFilter);

		// Load SQL based on filter
		$actividad_economica->CurrentFilter = $sFilter;
		$sSql = $actividad_economica->SQL();
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
		global $conn, $actividad_economica;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$actividad_economica->Row_Selected($row);
		$actividad_economica->id_acteconomica->setDbValue($rs->fields('id_acteconomica'));
		$actividad_economica->actividad->setDbValue($rs->fields('actividad'));
		$actividad_economica->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $actividad_economica;

		// Initialize URLs
		// Call Row_Rendering event

		$actividad_economica->Row_Rendering();

		// Common render codes for all row types
		// id_acteconomica
		// actividad
		// visibilidad

		if ($actividad_economica->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_acteconomica
			$actividad_economica->id_acteconomica->ViewValue = $actividad_economica->id_acteconomica->CurrentValue;
			$actividad_economica->id_acteconomica->ViewCustomAttributes = "";

			// actividad
			$actividad_economica->actividad->ViewValue = $actividad_economica->actividad->CurrentValue;
			$actividad_economica->actividad->ViewCustomAttributes = "";

			// visibilidad
			if (strval($actividad_economica->visibilidad->CurrentValue) <> "") {
				switch ($actividad_economica->visibilidad->CurrentValue) {
					case "1":
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->FldTagCaption(1) <> "" ? $actividad_economica->visibilidad->FldTagCaption(1) : $actividad_economica->visibilidad->CurrentValue;
						break;
					case "0":
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->FldTagCaption(2) <> "" ? $actividad_economica->visibilidad->FldTagCaption(2) : $actividad_economica->visibilidad->CurrentValue;
						break;
					default:
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->CurrentValue;
				}
			} else {
				$actividad_economica->visibilidad->ViewValue = NULL;
			}
			$actividad_economica->visibilidad->ViewCustomAttributes = "";

			// id_acteconomica
			$actividad_economica->id_acteconomica->LinkCustomAttributes = "";
			$actividad_economica->id_acteconomica->HrefValue = "";
			$actividad_economica->id_acteconomica->TooltipValue = "";

			// actividad
			$actividad_economica->actividad->LinkCustomAttributes = "";
			$actividad_economica->actividad->HrefValue = "";
			$actividad_economica->actividad->TooltipValue = "";

			// visibilidad
			$actividad_economica->visibilidad->LinkCustomAttributes = "";
			$actividad_economica->visibilidad->HrefValue = "";
			$actividad_economica->visibilidad->TooltipValue = "";
		} elseif ($actividad_economica->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_acteconomica
			$actividad_economica->id_acteconomica->EditCustomAttributes = "";
			$actividad_economica->id_acteconomica->EditValue = $actividad_economica->id_acteconomica->CurrentValue;
			$actividad_economica->id_acteconomica->ViewCustomAttributes = "";

			// actividad
			$actividad_economica->actividad->EditCustomAttributes = "";
			$actividad_economica->actividad->EditValue = ew_HtmlEncode($actividad_economica->actividad->CurrentValue);

			// visibilidad
			$actividad_economica->visibilidad->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $actividad_economica->visibilidad->FldTagCaption(1) <> "" ? $actividad_economica->visibilidad->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $actividad_economica->visibilidad->FldTagCaption(2) <> "" ? $actividad_economica->visibilidad->FldTagCaption(2) : "0");
			$actividad_economica->visibilidad->EditValue = $arwrk;

			// Edit refer script
			// id_acteconomica

			$actividad_economica->id_acteconomica->HrefValue = "";

			// actividad
			$actividad_economica->actividad->HrefValue = "";

			// visibilidad
			$actividad_economica->visibilidad->HrefValue = "";
		}
		if ($actividad_economica->RowType == EW_ROWTYPE_ADD ||
			$actividad_economica->RowType == EW_ROWTYPE_EDIT ||
			$actividad_economica->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$actividad_economica->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($actividad_economica->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$actividad_economica->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $actividad_economica;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($actividad_economica->actividad->FormValue) && $actividad_economica->actividad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $actividad_economica->actividad->FldCaption());
		}
		if ($actividad_economica->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $actividad_economica->visibilidad->FldCaption());
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
		global $conn, $Security, $Language, $actividad_economica;
		$sFilter = $actividad_economica->KeyFilter();
		$actividad_economica->CurrentFilter = $sFilter;
		$sSql = $actividad_economica->SQL();
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

			// actividad
			$actividad_economica->actividad->SetDbValueDef($rsnew, $actividad_economica->actividad->CurrentValue, "", $actividad_economica->actividad->ReadOnly);

			// visibilidad
			$actividad_economica->visibilidad->SetDbValueDef($rsnew, $actividad_economica->visibilidad->CurrentValue, 0, $actividad_economica->visibilidad->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $actividad_economica->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($actividad_economica->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($actividad_economica->CancelMessage <> "") {
					$this->setFailureMessage($actividad_economica->CancelMessage);
					$actividad_economica->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$actividad_economica->Row_Updated($rsold, $rsnew);
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
