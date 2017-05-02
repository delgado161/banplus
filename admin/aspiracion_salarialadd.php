<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "aspiracion_salarialinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$aspiracion_salarial_add = new caspiracion_salarial_add();
$Page =& $aspiracion_salarial_add;

// Page init
$aspiracion_salarial_add->Page_Init();

// Page main
$aspiracion_salarial_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var aspiracion_salarial_add = new ew_Page("aspiracion_salarial_add");

// page properties
aspiracion_salarial_add.PageID = "add"; // page ID
aspiracion_salarial_add.FormID = "faspiracion_salarialadd"; // form ID
var EW_PAGE_ID = aspiracion_salarial_add.PageID; // for backward compatibility

// extend page with ValidateForm function
aspiracion_salarial_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_valor"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($aspiracion_salarial->valor->FldCaption()) ?>");

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
aspiracion_salarial_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
aspiracion_salarial_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
aspiracion_salarial_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $aspiracion_salarial->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $aspiracion_salarial->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $aspiracion_salarial_add->ShowPageHeader(); ?>
<?php
$aspiracion_salarial_add->ShowMessage();
?>
<form name="faspiracion_salarialadd" id="faspiracion_salarialadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return aspiracion_salarial_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="aspiracion_salarial">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($aspiracion_salarial->valor->Visible) { // valor ?>
	<tr id="r_valor"<?php echo $aspiracion_salarial->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $aspiracion_salarial->valor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $aspiracion_salarial->valor->CellAttributes() ?>><span id="el_valor">
<input type="text" name="x_valor" id="x_valor" size="30" maxlength="100" value="<?php echo $aspiracion_salarial->valor->EditValue ?>"<?php echo $aspiracion_salarial->valor->EditAttributes() ?>>
</span><?php echo $aspiracion_salarial->valor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($aspiracion_salarial->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $aspiracion_salarial->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $aspiracion_salarial->orden->FldCaption() ?></td>
		<td<?php echo $aspiracion_salarial->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" size="2" maxlength="2" value="<?php echo $aspiracion_salarial->orden->EditValue ?>"<?php echo $aspiracion_salarial->orden->EditAttributes() ?>>
</span><?php echo $aspiracion_salarial->orden->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$aspiracion_salarial_add->ShowPageFooter();
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
$aspiracion_salarial_add->Page_Terminate();
?>
<?php

//
// Page class
//
class caspiracion_salarial_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'aspiracion_salarial';

	// Page object name
	var $PageObjName = 'aspiracion_salarial_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $aspiracion_salarial;
		if ($aspiracion_salarial->UseTokenInUrl) $PageUrl .= "t=" . $aspiracion_salarial->TableVar . "&"; // Add page token
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
		global $objForm, $aspiracion_salarial;
		if ($aspiracion_salarial->UseTokenInUrl) {
			if ($objForm)
				return ($aspiracion_salarial->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($aspiracion_salarial->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caspiracion_salarial_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (aspiracion_salarial)
		if (!isset($GLOBALS["aspiracion_salarial"])) {
			$GLOBALS["aspiracion_salarial"] = new caspiracion_salarial();
			$GLOBALS["Table"] =& $GLOBALS["aspiracion_salarial"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'aspiracion_salarial', TRUE);

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
		global $aspiracion_salarial;

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("aspiracion_salariallist.php");
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $aspiracion_salarial;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$aspiracion_salarial->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$aspiracion_salarial->CurrentAction = "I"; // Form error, reset action
				$aspiracion_salarial->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_aspiracion_salarial"] != "") {
				$aspiracion_salarial->id_aspiracion_salarial->setQueryStringValue($_GET["id_aspiracion_salarial"]);
				$aspiracion_salarial->setKey("id_aspiracion_salarial", $aspiracion_salarial->id_aspiracion_salarial->CurrentValue); // Set up key
			} else {
				$aspiracion_salarial->setKey("id_aspiracion_salarial", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$aspiracion_salarial->CurrentAction = "C"; // Copy record
			} else {
				$aspiracion_salarial->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($aspiracion_salarial->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("aspiracion_salariallist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$aspiracion_salarial->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $aspiracion_salarial->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "aspiracion_salarialview.php")
						$sReturnUrl = $aspiracion_salarial->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$aspiracion_salarial->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$aspiracion_salarial->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$aspiracion_salarial->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $aspiracion_salarial;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $aspiracion_salarial;
		$aspiracion_salarial->valor->CurrentValue = NULL;
		$aspiracion_salarial->valor->OldValue = $aspiracion_salarial->valor->CurrentValue;
		$aspiracion_salarial->orden->CurrentValue = NULL;
		$aspiracion_salarial->orden->OldValue = $aspiracion_salarial->orden->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $aspiracion_salarial;
		if (!$aspiracion_salarial->valor->FldIsDetailKey) {
			$aspiracion_salarial->valor->setFormValue($objForm->GetValue("x_valor"));
		}
		if (!$aspiracion_salarial->orden->FldIsDetailKey) {
			$aspiracion_salarial->orden->setFormValue($objForm->GetValue("x_orden"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $aspiracion_salarial;
		$this->LoadOldRecord();
		$aspiracion_salarial->valor->CurrentValue = $aspiracion_salarial->valor->FormValue;
		$aspiracion_salarial->orden->CurrentValue = $aspiracion_salarial->orden->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $aspiracion_salarial;
		$sFilter = $aspiracion_salarial->KeyFilter();

		// Call Row Selecting event
		$aspiracion_salarial->Row_Selecting($sFilter);

		// Load SQL based on filter
		$aspiracion_salarial->CurrentFilter = $sFilter;
		$sSql = $aspiracion_salarial->SQL();
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
		global $conn, $aspiracion_salarial;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$aspiracion_salarial->Row_Selected($row);
		$aspiracion_salarial->id_aspiracion_salarial->setDbValue($rs->fields('id_aspiracion_salarial'));
		$aspiracion_salarial->valor->setDbValue($rs->fields('valor'));
		$aspiracion_salarial->orden->setDbValue($rs->fields('orden'));
	}

	// Load old record
	function LoadOldRecord() {
		global $aspiracion_salarial;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($aspiracion_salarial->getKey("id_aspiracion_salarial")) <> "")
			$aspiracion_salarial->id_aspiracion_salarial->CurrentValue = $aspiracion_salarial->getKey("id_aspiracion_salarial"); // id_aspiracion_salarial
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$aspiracion_salarial->CurrentFilter = $aspiracion_salarial->KeyFilter();
			$sSql = $aspiracion_salarial->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $aspiracion_salarial;

		// Initialize URLs
		// Call Row_Rendering event

		$aspiracion_salarial->Row_Rendering();

		// Common render codes for all row types
		// id_aspiracion_salarial
		// valor
		// orden

		if ($aspiracion_salarial->RowType == EW_ROWTYPE_VIEW) { // View row

			// valor
			$aspiracion_salarial->valor->ViewValue = $aspiracion_salarial->valor->CurrentValue;
			$aspiracion_salarial->valor->ViewCustomAttributes = "";

			// orden
			$aspiracion_salarial->orden->ViewValue = $aspiracion_salarial->orden->CurrentValue;
			$aspiracion_salarial->orden->ViewCustomAttributes = "";

			// valor
			$aspiracion_salarial->valor->LinkCustomAttributes = "";
			$aspiracion_salarial->valor->HrefValue = "";
			$aspiracion_salarial->valor->TooltipValue = "";

			// orden
			$aspiracion_salarial->orden->LinkCustomAttributes = "";
			$aspiracion_salarial->orden->HrefValue = "";
			$aspiracion_salarial->orden->TooltipValue = "";
		} elseif ($aspiracion_salarial->RowType == EW_ROWTYPE_ADD) { // Add row

			// valor
			$aspiracion_salarial->valor->EditCustomAttributes = "";
			$aspiracion_salarial->valor->EditValue = ew_HtmlEncode($aspiracion_salarial->valor->CurrentValue);

			// orden
			$aspiracion_salarial->orden->EditCustomAttributes = "";
			$aspiracion_salarial->orden->EditValue = ew_HtmlEncode($aspiracion_salarial->orden->CurrentValue);

			// Edit refer script
			// valor

			$aspiracion_salarial->valor->HrefValue = "";

			// orden
			$aspiracion_salarial->orden->HrefValue = "";
		}
		if ($aspiracion_salarial->RowType == EW_ROWTYPE_ADD ||
			$aspiracion_salarial->RowType == EW_ROWTYPE_EDIT ||
			$aspiracion_salarial->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$aspiracion_salarial->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($aspiracion_salarial->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$aspiracion_salarial->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $aspiracion_salarial;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($aspiracion_salarial->valor->FormValue) && $aspiracion_salarial->valor->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $aspiracion_salarial->valor->FldCaption());
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
		global $conn, $Language, $Security, $aspiracion_salarial;
		$rsnew = array();

		// valor
		$aspiracion_salarial->valor->SetDbValueDef($rsnew, $aspiracion_salarial->valor->CurrentValue, "", FALSE);

		// orden
		$aspiracion_salarial->orden->SetDbValueDef($rsnew, $aspiracion_salarial->orden->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $aspiracion_salarial->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($aspiracion_salarial->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($aspiracion_salarial->CancelMessage <> "") {
				$this->setFailureMessage($aspiracion_salarial->CancelMessage);
				$aspiracion_salarial->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$aspiracion_salarial->id_aspiracion_salarial->setDbValue($conn->Insert_ID());
			$rsnew['id_aspiracion_salarial'] = $aspiracion_salarial->id_aspiracion_salarial->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$aspiracion_salarial->Row_Inserted($rs, $rsnew);
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
