<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tipos_productosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tipos_productos_edit = new ctipos_productos_edit();
$Page =& $tipos_productos_edit;

// Page init
$tipos_productos_edit->Page_Init();

// Page main
$tipos_productos_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tipos_productos_edit = new ew_Page("tipos_productos_edit");

// page properties
tipos_productos_edit.PageID = "edit"; // page ID
tipos_productos_edit.FormID = "ftipos_productosedit"; // form ID
var EW_PAGE_ID = tipos_productos_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tipos_productos_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_id_producto"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tipos_productos->id_producto->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_producto"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tipos_productos->id_producto->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tipo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tipos_productos->tipo->FldCaption()) ?>");

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
tipos_productos_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tipos_productos_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tipos_productos_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tipos_productos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tipos_productos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tipos_productos_edit->ShowPageHeader(); ?>
<?php
$tipos_productos_edit->ShowMessage();
?>
<form name="ftipos_productosedit" id="ftipos_productosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tipos_productos_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tipos_productos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tipos_productos->id_producto->Visible) { // id_producto ?>
	<tr id="r_id_producto"<?php echo $tipos_productos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tipos_productos->id_producto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tipos_productos->id_producto->CellAttributes() ?>><span id="el_id_producto">
<div<?php echo $tipos_productos->id_producto->ViewAttributes() ?>><?php echo $tipos_productos->id_producto->EditValue ?></div>
<input type="hidden" name="x_id_producto" id="x_id_producto" value="<?php echo ew_HtmlEncode($tipos_productos->id_producto->CurrentValue) ?>">
</span><?php echo $tipos_productos->id_producto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tipos_productos->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $tipos_productos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tipos_productos->tipo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tipos_productos->tipo->CellAttributes() ?>><span id="el_tipo">
<input type="text" name="x_tipo" id="x_tipo" size="30" maxlength="100" value="<?php echo $tipos_productos->tipo->EditValue ?>"<?php echo $tipos_productos->tipo->EditAttributes() ?>>
</span><?php echo $tipos_productos->tipo->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$tipos_productos_edit->ShowPageFooter();
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
$tipos_productos_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctipos_productos_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tipos_productos';

	// Page object name
	var $PageObjName = 'tipos_productos_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tipos_productos;
		if ($tipos_productos->UseTokenInUrl) $PageUrl .= "t=" . $tipos_productos->TableVar . "&"; // Add page token
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
		global $objForm, $tipos_productos;
		if ($tipos_productos->UseTokenInUrl) {
			if ($objForm)
				return ($tipos_productos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tipos_productos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctipos_productos_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tipos_productos)
		if (!isset($GLOBALS["tipos_productos"])) {
			$GLOBALS["tipos_productos"] = new ctipos_productos();
			$GLOBALS["Table"] =& $GLOBALS["tipos_productos"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tipos_productos', TRUE);

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
		global $tipos_productos;

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
		global $objForm, $Language, $gsFormError, $tipos_productos;

		// Load key from QueryString
		if (@$_GET["id_producto"] <> "")
			$tipos_productos->id_producto->setQueryStringValue($_GET["id_producto"]);
		if (@$_POST["a_edit"] <> "") {
			$tipos_productos->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tipos_productos->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$tipos_productos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tipos_productos->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tipos_productos->id_producto->CurrentValue == "")
			$this->Page_Terminate("tipos_productoslist.php"); // Invalid key, return to list
		switch ($tipos_productos->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tipos_productoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tipos_productos->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tipos_productos->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tipos_productos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tipos_productos->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$tipos_productos->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tipos_productos;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tipos_productos;
		if (!$tipos_productos->id_producto->FldIsDetailKey) {
			$tipos_productos->id_producto->setFormValue($objForm->GetValue("x_id_producto"));
		}
		if (!$tipos_productos->tipo->FldIsDetailKey) {
			$tipos_productos->tipo->setFormValue($objForm->GetValue("x_tipo"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tipos_productos;
		$this->LoadRow();
		$tipos_productos->id_producto->CurrentValue = $tipos_productos->id_producto->FormValue;
		$tipos_productos->tipo->CurrentValue = $tipos_productos->tipo->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tipos_productos;
		$sFilter = $tipos_productos->KeyFilter();

		// Call Row Selecting event
		$tipos_productos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tipos_productos->CurrentFilter = $sFilter;
		$sSql = $tipos_productos->SQL();
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
		global $conn, $tipos_productos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tipos_productos->Row_Selected($row);
		$tipos_productos->id_producto->setDbValue($rs->fields('id_producto'));
		$tipos_productos->tipo->setDbValue($rs->fields('tipo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tipos_productos;

		// Initialize URLs
		// Call Row_Rendering event

		$tipos_productos->Row_Rendering();

		// Common render codes for all row types
		// id_producto
		// tipo

		if ($tipos_productos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_producto
			$tipos_productos->id_producto->ViewValue = $tipos_productos->id_producto->CurrentValue;
			$tipos_productos->id_producto->ViewCustomAttributes = "";

			// tipo
			$tipos_productos->tipo->ViewValue = $tipos_productos->tipo->CurrentValue;
			$tipos_productos->tipo->ViewCustomAttributes = "";

			// id_producto
			$tipos_productos->id_producto->LinkCustomAttributes = "";
			$tipos_productos->id_producto->HrefValue = "";
			$tipos_productos->id_producto->TooltipValue = "";

			// tipo
			$tipos_productos->tipo->LinkCustomAttributes = "";
			$tipos_productos->tipo->HrefValue = "";
			$tipos_productos->tipo->TooltipValue = "";
		} elseif ($tipos_productos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_producto
			$tipos_productos->id_producto->EditCustomAttributes = "";
			$tipos_productos->id_producto->EditValue = $tipos_productos->id_producto->CurrentValue;
			$tipos_productos->id_producto->ViewCustomAttributes = "";

			// tipo
			$tipos_productos->tipo->EditCustomAttributes = "";
			$tipos_productos->tipo->EditValue = ew_HtmlEncode($tipos_productos->tipo->CurrentValue);

			// Edit refer script
			// id_producto

			$tipos_productos->id_producto->HrefValue = "";

			// tipo
			$tipos_productos->tipo->HrefValue = "";
		}
		if ($tipos_productos->RowType == EW_ROWTYPE_ADD ||
			$tipos_productos->RowType == EW_ROWTYPE_EDIT ||
			$tipos_productos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$tipos_productos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($tipos_productos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tipos_productos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tipos_productos;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tipos_productos->id_producto->FormValue) && $tipos_productos->id_producto->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tipos_productos->id_producto->FldCaption());
		}
		if (!ew_CheckInteger($tipos_productos->id_producto->FormValue)) {
			ew_AddMessage($gsFormError, $tipos_productos->id_producto->FldErrMsg());
		}
		if (!is_null($tipos_productos->tipo->FormValue) && $tipos_productos->tipo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tipos_productos->tipo->FldCaption());
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
		global $conn, $Security, $Language, $tipos_productos;
		$sFilter = $tipos_productos->KeyFilter();
		$tipos_productos->CurrentFilter = $sFilter;
		$sSql = $tipos_productos->SQL();
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

			// id_producto
			// tipo

			$tipos_productos->tipo->SetDbValueDef($rsnew, $tipos_productos->tipo->CurrentValue, "", $tipos_productos->tipo->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $tipos_productos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($tipos_productos->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($tipos_productos->CancelMessage <> "") {
					$this->setFailureMessage($tipos_productos->CancelMessage);
					$tipos_productos->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tipos_productos->Row_Updated($rsold, $rsnew);
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
