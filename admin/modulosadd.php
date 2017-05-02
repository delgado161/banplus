<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modulosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$modulos_add = new cmodulos_add();
$Page =& $modulos_add;

// Page init
$modulos_add->Page_Init();

// Page main
$modulos_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var modulos_add = new ew_Page("modulos_add");

// page properties
modulos_add.PageID = "add"; // page ID
modulos_add.FormID = "fmodulosadd"; // form ID
var EW_PAGE_ID = modulos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
modulos_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";

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
modulos_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
modulos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
modulos_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $modulos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $modulos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $modulos_add->ShowPageHeader(); ?>
<?php
$modulos_add->ShowMessage();
?>
<form name="fmodulosadd" id="fmodulosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return modulos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="modulos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$modulos_add->ShowPageFooter();
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
$modulos_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodulos_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'modulos';

	// Page object name
	var $PageObjName = 'modulos_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $modulos;
		if ($modulos->UseTokenInUrl) $PageUrl .= "t=" . $modulos->TableVar . "&"; // Add page token
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
		global $objForm, $modulos;
		if ($modulos->UseTokenInUrl) {
			if ($objForm)
				return ($modulos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($modulos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodulos_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (modulos)
		if (!isset($GLOBALS["modulos"])) {
			$GLOBALS["modulos"] = new cmodulos();
			$GLOBALS["Table"] =& $GLOBALS["modulos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'modulos', TRUE);

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
		global $modulos;

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
			$this->Page_Terminate("moduloslist.php");
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
		global $objForm, $Language, $gsFormError, $modulos;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$modulos->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$modulos->CurrentAction = "I"; // Form error, reset action
				$modulos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_modulo_financiero"] != "") {
				$modulos->id_modulo_financiero->setQueryStringValue($_GET["id_modulo_financiero"]);
				$modulos->setKey("id_modulo_financiero", $modulos->id_modulo_financiero->CurrentValue); // Set up key
			} else {
				$modulos->setKey("id_modulo_financiero", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$modulos->CurrentAction = "C"; // Copy record
			} else {
				$modulos->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($modulos->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("moduloslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$modulos->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $modulos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "modulosview.php")
						$sReturnUrl = $modulos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$modulos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$modulos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$modulos->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $modulos;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $modulos;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $modulos;
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $modulos;
		$this->LoadOldRecord();
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $modulos;
		$sFilter = $modulos->KeyFilter();

		// Call Row Selecting event
		$modulos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$modulos->CurrentFilter = $sFilter;
		$sSql = $modulos->SQL();
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
		global $conn, $modulos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$modulos->Row_Selected($row);
		$modulos->id_modulo_financiero->setDbValue($rs->fields('id_modulo_financiero'));
		$modulos->nombre->setDbValue($rs->fields('nombre'));
		$modulos->plantilla->Upload->DbValue = $rs->fields('plantilla');
		$modulos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $modulos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($modulos->getKey("id_modulo_financiero")) <> "")
			$modulos->id_modulo_financiero->CurrentValue = $modulos->getKey("id_modulo_financiero"); // id_modulo_financiero
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$modulos->CurrentFilter = $modulos->KeyFilter();
			$sSql = $modulos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $modulos;

		// Initialize URLs
		// Call Row_Rendering event

		$modulos->Row_Rendering();

		// Common render codes for all row types
		// id_modulo_financiero
		// nombre
		// plantilla
		// estatus

		if ($modulos->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$modulos->nombre->ViewValue = $modulos->nombre->CurrentValue;
			$modulos->nombre->ViewCustomAttributes = "";

			// plantilla
			if (!ew_Empty($modulos->plantilla->Upload->DbValue)) {
				$modulos->plantilla->ViewValue = $modulos->plantilla->Upload->DbValue;
			} else {
				$modulos->plantilla->ViewValue = "";
			}
			$modulos->plantilla->ViewCustomAttributes = "";

			// estatus
			if (strval($modulos->estatus->CurrentValue) <> "") {
				switch ($modulos->estatus->CurrentValue) {
					case "1":
						$modulos->estatus->ViewValue = $modulos->estatus->FldTagCaption(1) <> "" ? $modulos->estatus->FldTagCaption(1) : $modulos->estatus->CurrentValue;
						break;
					case "0":
						$modulos->estatus->ViewValue = $modulos->estatus->FldTagCaption(2) <> "" ? $modulos->estatus->FldTagCaption(2) : $modulos->estatus->CurrentValue;
						break;
					default:
						$modulos->estatus->ViewValue = $modulos->estatus->CurrentValue;
				}
			} else {
				$modulos->estatus->ViewValue = NULL;
			}
			$modulos->estatus->ViewCustomAttributes = "";
		} elseif ($modulos->RowType == EW_ROWTYPE_ADD) { // Add row

			// Edit refer script
		}
		if ($modulos->RowType == EW_ROWTYPE_ADD ||
			$modulos->RowType == EW_ROWTYPE_EDIT ||
			$modulos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$modulos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($modulos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$modulos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $modulos;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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
		global $conn, $Language, $Security, $modulos;
		$rsnew = array();

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $modulos->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($modulos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($modulos->CancelMessage <> "") {
				$this->setFailureMessage($modulos->CancelMessage);
				$modulos->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$modulos->id_modulo_financiero->setDbValue($conn->Insert_ID());
			$rsnew['id_modulo_financiero'] = $modulos->id_modulo_financiero->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$modulos->Row_Inserted($rs, $rsnew);
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
