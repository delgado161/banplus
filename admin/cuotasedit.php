<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "cuotasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$cuotas_edit = new ccuotas_edit();
$Page =& $cuotas_edit;

// Page init
$cuotas_edit->Page_Init();

// Page main
$cuotas_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cuotas_edit = new ew_Page("cuotas_edit");

// page properties
cuotas_edit.PageID = "edit"; // page ID
cuotas_edit.FormID = "fcuotasedit"; // form ID
var EW_PAGE_ID = cuotas_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
cuotas_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_meses"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($cuotas->meses->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tipo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($cuotas->tipo->FldCaption()) ?>");

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
cuotas_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cuotas_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cuotas_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $cuotas->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $cuotas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $cuotas_edit->ShowPageHeader(); ?>
<?php
$cuotas_edit->ShowMessage();
?>
<form name="fcuotasedit" id="fcuotasedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return cuotas_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="cuotas">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($cuotas->meses->Visible) { // meses ?>
	<tr id="r_meses"<?php echo $cuotas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $cuotas->meses->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $cuotas->meses->CellAttributes() ?>><span id="el_meses">
<input type="text" name="x_meses" id="x_meses" size="3" maxlength="3" value="<?php echo $cuotas->meses->EditValue ?>"<?php echo $cuotas->meses->EditAttributes() ?>>
</span><?php echo $cuotas->meses->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cuotas->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $cuotas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $cuotas->tipo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $cuotas->tipo->CellAttributes() ?>><span id="el_tipo">
<select id="x_tipo" name="x_tipo"<?php echo $cuotas->tipo->EditAttributes() ?>>
<?php
if (is_array($cuotas->tipo->EditValue)) {
	$arwrk = $cuotas->tipo->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cuotas->tipo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $cuotas->tipo->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_cuotas" id="x_id_cuotas" value="<?php echo ew_HtmlEncode($cuotas->id_cuotas->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$cuotas_edit->ShowPageFooter();
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
$cuotas_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ccuotas_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'cuotas';

	// Page object name
	var $PageObjName = 'cuotas_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cuotas;
		if ($cuotas->UseTokenInUrl) $PageUrl .= "t=" . $cuotas->TableVar . "&"; // Add page token
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
		global $objForm, $cuotas;
		if ($cuotas->UseTokenInUrl) {
			if ($objForm)
				return ($cuotas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cuotas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccuotas_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (cuotas)
		if (!isset($GLOBALS["cuotas"])) {
			$GLOBALS["cuotas"] = new ccuotas();
			$GLOBALS["Table"] =& $GLOBALS["cuotas"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cuotas', TRUE);

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
		global $cuotas;

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
			$this->Page_Terminate("cuotaslist.php");
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
		global $objForm, $Language, $gsFormError, $cuotas;

		// Load key from QueryString
		if (@$_GET["id_cuotas"] <> "")
			$cuotas->id_cuotas->setQueryStringValue($_GET["id_cuotas"]);
		if (@$_POST["a_edit"] <> "") {
			$cuotas->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$cuotas->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$cuotas->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$cuotas->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($cuotas->id_cuotas->CurrentValue == "")
			$this->Page_Terminate("cuotaslist.php"); // Invalid key, return to list
		switch ($cuotas->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("cuotaslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$cuotas->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $cuotas->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$cuotas->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$cuotas->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$cuotas->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $cuotas;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $cuotas;
		if (!$cuotas->meses->FldIsDetailKey) {
			$cuotas->meses->setFormValue($objForm->GetValue("x_meses"));
		}
		if (!$cuotas->tipo->FldIsDetailKey) {
			$cuotas->tipo->setFormValue($objForm->GetValue("x_tipo"));
		}
		if (!$cuotas->id_cuotas->FldIsDetailKey)
			$cuotas->id_cuotas->setFormValue($objForm->GetValue("x_id_cuotas"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $cuotas;
		$this->LoadRow();
		$cuotas->id_cuotas->CurrentValue = $cuotas->id_cuotas->FormValue;
		$cuotas->meses->CurrentValue = $cuotas->meses->FormValue;
		$cuotas->tipo->CurrentValue = $cuotas->tipo->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cuotas;
		$sFilter = $cuotas->KeyFilter();

		// Call Row Selecting event
		$cuotas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$cuotas->CurrentFilter = $sFilter;
		$sSql = $cuotas->SQL();
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
		global $conn, $cuotas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$cuotas->Row_Selected($row);
		$cuotas->id_cuotas->setDbValue($rs->fields('id_cuotas'));
		$cuotas->meses->setDbValue($rs->fields('meses'));
		$cuotas->tipo->setDbValue($rs->fields('tipo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $cuotas;

		// Initialize URLs
		// Call Row_Rendering event

		$cuotas->Row_Rendering();

		// Common render codes for all row types
		// id_cuotas
		// meses
		// tipo

		if ($cuotas->RowType == EW_ROWTYPE_VIEW) { // View row

			// meses
			$cuotas->meses->ViewValue = $cuotas->meses->CurrentValue;
			$cuotas->meses->ViewCustomAttributes = "";

			// tipo
			if (strval($cuotas->tipo->CurrentValue) <> "") {
				switch ($cuotas->tipo->CurrentValue) {
					case "1":
						$cuotas->tipo->ViewValue = $cuotas->tipo->FldTagCaption(1) <> "" ? $cuotas->tipo->FldTagCaption(1) : $cuotas->tipo->CurrentValue;
						break;
					case "2":
						$cuotas->tipo->ViewValue = $cuotas->tipo->FldTagCaption(2) <> "" ? $cuotas->tipo->FldTagCaption(2) : $cuotas->tipo->CurrentValue;
						break;
					default:
						$cuotas->tipo->ViewValue = $cuotas->tipo->CurrentValue;
				}
			} else {
				$cuotas->tipo->ViewValue = NULL;
			}
			$cuotas->tipo->ViewCustomAttributes = "";

			// meses
			$cuotas->meses->LinkCustomAttributes = "";
			$cuotas->meses->HrefValue = "";
			$cuotas->meses->TooltipValue = "";

			// tipo
			$cuotas->tipo->LinkCustomAttributes = "";
			$cuotas->tipo->HrefValue = "";
			$cuotas->tipo->TooltipValue = "";
		} elseif ($cuotas->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// meses
			$cuotas->meses->EditCustomAttributes = "";
			$cuotas->meses->EditValue = ew_HtmlEncode($cuotas->meses->CurrentValue);

			// tipo
			$cuotas->tipo->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $cuotas->tipo->FldTagCaption(1) <> "" ? $cuotas->tipo->FldTagCaption(1) : "1");
			$arwrk[] = array("2", $cuotas->tipo->FldTagCaption(2) <> "" ? $cuotas->tipo->FldTagCaption(2) : "2");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$cuotas->tipo->EditValue = $arwrk;

			// Edit refer script
			// meses

			$cuotas->meses->HrefValue = "";

			// tipo
			$cuotas->tipo->HrefValue = "";
		}
		if ($cuotas->RowType == EW_ROWTYPE_ADD ||
			$cuotas->RowType == EW_ROWTYPE_EDIT ||
			$cuotas->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$cuotas->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($cuotas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$cuotas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $cuotas;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($cuotas->meses->FormValue) && $cuotas->meses->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $cuotas->meses->FldCaption());
		}
		if (!is_null($cuotas->tipo->FormValue) && $cuotas->tipo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $cuotas->tipo->FldCaption());
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
		global $conn, $Security, $Language, $cuotas;
		$sFilter = $cuotas->KeyFilter();
		$cuotas->CurrentFilter = $sFilter;
		$sSql = $cuotas->SQL();
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

			// meses
			$cuotas->meses->SetDbValueDef($rsnew, $cuotas->meses->CurrentValue, "", $cuotas->meses->ReadOnly);

			// tipo
			$cuotas->tipo->SetDbValueDef($rsnew, $cuotas->tipo->CurrentValue, 0, $cuotas->tipo->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $cuotas->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($cuotas->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($cuotas->CancelMessage <> "") {
					$this->setFailureMessage($cuotas->CancelMessage);
					$cuotas->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$cuotas->Row_Updated($rsold, $rsnew);
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
