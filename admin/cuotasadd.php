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
$cuotas_add = new ccuotas_add();
$Page =& $cuotas_add;

// Page init
$cuotas_add->Page_Init();

// Page main
$cuotas_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cuotas_add = new ew_Page("cuotas_add");

// page properties
cuotas_add.PageID = "add"; // page ID
cuotas_add.FormID = "fcuotasadd"; // form ID
var EW_PAGE_ID = cuotas_add.PageID; // for backward compatibility

// extend page with ValidateForm function
cuotas_add.ValidateForm = function(fobj) {
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
cuotas_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cuotas_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cuotas_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $cuotas->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $cuotas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $cuotas_add->ShowPageHeader(); ?>
<?php
$cuotas_add->ShowMessage();
?>
<form name="fcuotasadd" id="fcuotasadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return cuotas_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="cuotas">
<input type="hidden" name="a_add" id="a_add" value="A">
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
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$cuotas_add->ShowPageFooter();
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
$cuotas_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccuotas_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'cuotas';

	// Page object name
	var $PageObjName = 'cuotas_add';

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
	function ccuotas_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $cuotas;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$cuotas->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$cuotas->CurrentAction = "I"; // Form error, reset action
				$cuotas->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_cuotas"] != "") {
				$cuotas->id_cuotas->setQueryStringValue($_GET["id_cuotas"]);
				$cuotas->setKey("id_cuotas", $cuotas->id_cuotas->CurrentValue); // Set up key
			} else {
				$cuotas->setKey("id_cuotas", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$cuotas->CurrentAction = "C"; // Copy record
			} else {
				$cuotas->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($cuotas->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("cuotaslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$cuotas->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $cuotas->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "cuotasview.php")
						$sReturnUrl = $cuotas->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$cuotas->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$cuotas->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $cuotas;
		$cuotas->meses->CurrentValue = NULL;
		$cuotas->meses->OldValue = $cuotas->meses->CurrentValue;
		$cuotas->tipo->CurrentValue = NULL;
		$cuotas->tipo->OldValue = $cuotas->tipo->CurrentValue;
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
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $cuotas;
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $cuotas;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($cuotas->getKey("id_cuotas")) <> "")
			$cuotas->id_cuotas->CurrentValue = $cuotas->getKey("id_cuotas"); // id_cuotas
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$cuotas->CurrentFilter = $cuotas->KeyFilter();
			$sSql = $cuotas->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($cuotas->RowType == EW_ROWTYPE_ADD) { // Add row

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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $cuotas;
		$rsnew = array();

		// meses
		$cuotas->meses->SetDbValueDef($rsnew, $cuotas->meses->CurrentValue, "", FALSE);

		// tipo
		$cuotas->tipo->SetDbValueDef($rsnew, $cuotas->tipo->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $cuotas->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($cuotas->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($cuotas->CancelMessage <> "") {
				$this->setFailureMessage($cuotas->CancelMessage);
				$cuotas->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$cuotas->id_cuotas->setDbValue($conn->Insert_ID());
			$rsnew['id_cuotas'] = $cuotas->id_cuotas->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$cuotas->Row_Inserted($rs, $rsnew);
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
