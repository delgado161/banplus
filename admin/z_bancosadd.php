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
$z_bancos_add = new cz_bancos_add();
$Page =& $z_bancos_add;

// Page init
$z_bancos_add->Page_Init();

// Page main
$z_bancos_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_bancos_add = new ew_Page("z_bancos_add");

// page properties
z_bancos_add.PageID = "add"; // page ID
z_bancos_add.FormID = "fz_bancosadd"; // form ID
var EW_PAGE_ID = z_bancos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
z_bancos_add.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_bancos->visibilidad->FldErrMsg()) ?>");

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
z_bancos_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_bancos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_bancos_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_bancos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_bancos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_bancos_add->ShowPageHeader(); ?>
<?php
$z_bancos_add->ShowMessage();
?>
<form name="fz_bancosadd" id="fz_bancosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_bancos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="z_bancos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="text" name="x_visibilidad" id="x_visibilidad" size="30" value="<?php echo $z_bancos->visibilidad->EditValue ?>"<?php echo $z_bancos->visibilidad->EditAttributes() ?>>
</span><?php echo $z_bancos->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$z_bancos_add->ShowPageFooter();
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
$z_bancos_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_bancos_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = '_bancos';

	// Page object name
	var $PageObjName = 'z_bancos_add';

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
	function cz_bancos_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $z_bancos;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$z_bancos->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_bancos->CurrentAction = "I"; // Form error, reset action
				$z_bancos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_bancos"] != "") {
				$z_bancos->id_bancos->setQueryStringValue($_GET["id_bancos"]);
				$z_bancos->setKey("id_bancos", $z_bancos->id_bancos->CurrentValue); // Set up key
			} else {
				$z_bancos->setKey("id_bancos", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$z_bancos->CurrentAction = "C"; // Copy record
			} else {
				$z_bancos->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($z_bancos->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_bancoslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$z_bancos->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $z_bancos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "z_bancosview.php")
						$sReturnUrl = $z_bancos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$z_bancos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$z_bancos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $z_bancos;
		$z_bancos->banco->CurrentValue = NULL;
		$z_bancos->banco->OldValue = $z_bancos->banco->CurrentValue;
		$z_bancos->visibilidad->CurrentValue = 1;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_bancos;
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
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $z_bancos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($z_bancos->getKey("id_bancos")) <> "")
			$z_bancos->id_bancos->CurrentValue = $z_bancos->getKey("id_bancos"); // id_bancos
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$z_bancos->CurrentFilter = $z_bancos->KeyFilter();
			$sSql = $z_bancos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
			$z_bancos->visibilidad->ViewValue = $z_bancos->visibilidad->CurrentValue;
			$z_bancos->visibilidad->ViewCustomAttributes = "";

			// banco
			$z_bancos->banco->LinkCustomAttributes = "";
			$z_bancos->banco->HrefValue = "";
			$z_bancos->banco->TooltipValue = "";

			// visibilidad
			$z_bancos->visibilidad->LinkCustomAttributes = "";
			$z_bancos->visibilidad->HrefValue = "";
			$z_bancos->visibilidad->TooltipValue = "";
		} elseif ($z_bancos->RowType == EW_ROWTYPE_ADD) { // Add row

			// banco
			$z_bancos->banco->EditCustomAttributes = "";
			$z_bancos->banco->EditValue = ew_HtmlEncode($z_bancos->banco->CurrentValue);

			// visibilidad
			$z_bancos->visibilidad->EditCustomAttributes = "";
			$z_bancos->visibilidad->EditValue = ew_HtmlEncode($z_bancos->visibilidad->CurrentValue);

			// Edit refer script
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
		if (!is_null($z_bancos->visibilidad->FormValue) && $z_bancos->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_bancos->visibilidad->FldCaption());
		}
		if (!ew_CheckInteger($z_bancos->visibilidad->FormValue)) {
			ew_AddMessage($gsFormError, $z_bancos->visibilidad->FldErrMsg());
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $z_bancos;
		$rsnew = array();

		// banco
		$z_bancos->banco->SetDbValueDef($rsnew, $z_bancos->banco->CurrentValue, "", FALSE);

		// visibilidad
		$z_bancos->visibilidad->SetDbValueDef($rsnew, $z_bancos->visibilidad->CurrentValue, 0, strval($z_bancos->visibilidad->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $z_bancos->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($z_bancos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($z_bancos->CancelMessage <> "") {
				$this->setFailureMessage($z_bancos->CancelMessage);
				$z_bancos->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$z_bancos->id_bancos->setDbValue($conn->Insert_ID());
			$rsnew['id_bancos'] = $z_bancos->id_bancos->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$z_bancos->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
