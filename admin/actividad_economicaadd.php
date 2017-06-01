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
$actividad_economica_add = new cactividad_economica_add();
$Page =& $actividad_economica_add;

// Page init
$actividad_economica_add->Page_Init();

// Page main
$actividad_economica_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var actividad_economica_add = new ew_Page("actividad_economica_add");

// page properties
actividad_economica_add.PageID = "add"; // page ID
actividad_economica_add.FormID = "factividad_economicaadd"; // form ID
var EW_PAGE_ID = actividad_economica_add.PageID; // for backward compatibility

// extend page with ValidateForm function
actividad_economica_add.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($actividad_economica->visibilidad->FldErrMsg()) ?>");

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
actividad_economica_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
actividad_economica_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
actividad_economica_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $actividad_economica->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $actividad_economica->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $actividad_economica_add->ShowPageHeader(); ?>
<?php
$actividad_economica_add->ShowMessage();
?>
<form name="factividad_economicaadd" id="factividad_economicaadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return actividad_economica_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="actividad_economica">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="text" name="x_visibilidad" id="x_visibilidad" size="30" value="<?php echo $actividad_economica->visibilidad->EditValue ?>"<?php echo $actividad_economica->visibilidad->EditAttributes() ?>>
</span><?php echo $actividad_economica->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$actividad_economica_add->ShowPageFooter();
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
$actividad_economica_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cactividad_economica_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'actividad_economica';

	// Page object name
	var $PageObjName = 'actividad_economica_add';

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
	function cactividad_economica_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $actividad_economica;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$actividad_economica->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$actividad_economica->CurrentAction = "I"; // Form error, reset action
				$actividad_economica->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_acteconomica"] != "") {
				$actividad_economica->id_acteconomica->setQueryStringValue($_GET["id_acteconomica"]);
				$actividad_economica->setKey("id_acteconomica", $actividad_economica->id_acteconomica->CurrentValue); // Set up key
			} else {
				$actividad_economica->setKey("id_acteconomica", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$actividad_economica->CurrentAction = "C"; // Copy record
			} else {
				$actividad_economica->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($actividad_economica->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("actividad_economicalist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$actividad_economica->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $actividad_economica->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "actividad_economicaview.php")
						$sReturnUrl = $actividad_economica->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$actividad_economica->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$actividad_economica->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $actividad_economica;
		$actividad_economica->actividad->CurrentValue = NULL;
		$actividad_economica->actividad->OldValue = $actividad_economica->actividad->CurrentValue;
		$actividad_economica->visibilidad->CurrentValue = NULL;
		$actividad_economica->visibilidad->OldValue = $actividad_economica->visibilidad->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $actividad_economica;
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
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $actividad_economica;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($actividad_economica->getKey("id_acteconomica")) <> "")
			$actividad_economica->id_acteconomica->CurrentValue = $actividad_economica->getKey("id_acteconomica"); // id_acteconomica
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$actividad_economica->CurrentFilter = $actividad_economica->KeyFilter();
			$sSql = $actividad_economica->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
			$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->CurrentValue;
			$actividad_economica->visibilidad->ViewCustomAttributes = "";

			// actividad
			$actividad_economica->actividad->LinkCustomAttributes = "";
			$actividad_economica->actividad->HrefValue = "";
			$actividad_economica->actividad->TooltipValue = "";

			// visibilidad
			$actividad_economica->visibilidad->LinkCustomAttributes = "";
			$actividad_economica->visibilidad->HrefValue = "";
			$actividad_economica->visibilidad->TooltipValue = "";
		} elseif ($actividad_economica->RowType == EW_ROWTYPE_ADD) { // Add row

			// actividad
			$actividad_economica->actividad->EditCustomAttributes = "";
			$actividad_economica->actividad->EditValue = ew_HtmlEncode($actividad_economica->actividad->CurrentValue);

			// visibilidad
			$actividad_economica->visibilidad->EditCustomAttributes = "";
			$actividad_economica->visibilidad->EditValue = ew_HtmlEncode($actividad_economica->visibilidad->CurrentValue);

			// Edit refer script
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
		if (!is_null($actividad_economica->visibilidad->FormValue) && $actividad_economica->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $actividad_economica->visibilidad->FldCaption());
		}
		if (!ew_CheckInteger($actividad_economica->visibilidad->FormValue)) {
			ew_AddMessage($gsFormError, $actividad_economica->visibilidad->FldErrMsg());
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
		global $conn, $Language, $Security, $actividad_economica;
		$rsnew = array();

		// actividad
		$actividad_economica->actividad->SetDbValueDef($rsnew, $actividad_economica->actividad->CurrentValue, "", FALSE);

		// visibilidad
		$actividad_economica->visibilidad->SetDbValueDef($rsnew, $actividad_economica->visibilidad->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $actividad_economica->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($actividad_economica->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($actividad_economica->CancelMessage <> "") {
				$this->setFailureMessage($actividad_economica->CancelMessage);
				$actividad_economica->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$actividad_economica->id_acteconomica->setDbValue($conn->Insert_ID());
			$rsnew['id_acteconomica'] = $actividad_economica->id_acteconomica->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$actividad_economica->Row_Inserted($rs, $rsnew);
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
