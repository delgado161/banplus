<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "parametrosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$parametros_add = new cparametros_add();
$Page =& $parametros_add;

// Page init
$parametros_add->Page_Init();

// Page main
$parametros_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var parametros_add = new ew_Page("parametros_add");

// page properties
parametros_add.PageID = "add"; // page ID
parametros_add.FormID = "fparametrosadd"; // form ID
var EW_PAGE_ID = parametros_add.PageID; // for backward compatibility

// extend page with ValidateForm function
parametros_add.ValidateForm = function(fobj) {
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
parametros_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
parametros_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
parametros_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $parametros->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $parametros->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $parametros_add->ShowPageHeader(); ?>
<?php
$parametros_add->ShowMessage();
?>
<form name="fparametrosadd" id="fparametrosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return parametros_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="parametros">
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
$parametros_add->ShowPageFooter();
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
$parametros_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cparametros_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'parametros';

	// Page object name
	var $PageObjName = 'parametros_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $parametros;
		if ($parametros->UseTokenInUrl) $PageUrl .= "t=" . $parametros->TableVar . "&"; // Add page token
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
		global $objForm, $parametros;
		if ($parametros->UseTokenInUrl) {
			if ($objForm)
				return ($parametros->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($parametros->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cparametros_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (parametros)
		if (!isset($GLOBALS["parametros"])) {
			$GLOBALS["parametros"] = new cparametros();
			$GLOBALS["Table"] =& $GLOBALS["parametros"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'parametros', TRUE);

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
		global $parametros;

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
			$this->Page_Terminate("parametroslist.php");
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
		global $objForm, $Language, $gsFormError, $parametros;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$parametros->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$parametros->CurrentAction = "I"; // Form error, reset action
				$parametros->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_parametro"] != "") {
				$parametros->id_parametro->setQueryStringValue($_GET["id_parametro"]);
				$parametros->setKey("id_parametro", $parametros->id_parametro->CurrentValue); // Set up key
			} else {
				$parametros->setKey("id_parametro", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$parametros->CurrentAction = "C"; // Copy record
			} else {
				$parametros->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($parametros->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("parametroslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$parametros->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $parametros->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "parametrosview.php")
						$sReturnUrl = $parametros->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$parametros->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$parametros->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$parametros->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $parametros;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $parametros;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $parametros;
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $parametros;
		$this->LoadOldRecord();
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $parametros;
		$sFilter = $parametros->KeyFilter();

		// Call Row Selecting event
		$parametros->Row_Selecting($sFilter);

		// Load SQL based on filter
		$parametros->CurrentFilter = $sFilter;
		$sSql = $parametros->SQL();
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
		global $conn, $parametros;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$parametros->Row_Selected($row);
		$parametros->id_parametro->setDbValue($rs->fields('id_parametro'));
		$parametros->nombre->setDbValue($rs->fields('nombre'));
		$parametros->valor->setDbValue($rs->fields('valor'));
		$parametros->tipo_parametro->setDbValue($rs->fields('tipo_parametro'));
		$parametros->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $parametros;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($parametros->getKey("id_parametro")) <> "")
			$parametros->id_parametro->CurrentValue = $parametros->getKey("id_parametro"); // id_parametro
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$parametros->CurrentFilter = $parametros->KeyFilter();
			$sSql = $parametros->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $parametros;

		// Initialize URLs
		// Call Row_Rendering event

		$parametros->Row_Rendering();

		// Common render codes for all row types
		// id_parametro
		// nombre
		// valor
		// tipo_parametro
		// estatus

		if ($parametros->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$parametros->nombre->ViewValue = $parametros->nombre->CurrentValue;
			$parametros->nombre->ViewCustomAttributes = "";

			// valor
			$parametros->valor->ViewValue = $parametros->valor->CurrentValue;
			$parametros->valor->ViewCustomAttributes = "";

			// tipo_parametro
			$parametros->tipo_parametro->ViewValue = $parametros->tipo_parametro->CurrentValue;
			$parametros->tipo_parametro->ViewCustomAttributes = "";

			// estatus
			if (strval($parametros->estatus->CurrentValue) <> "") {
				switch ($parametros->estatus->CurrentValue) {
					case "1":
						$parametros->estatus->ViewValue = $parametros->estatus->FldTagCaption(1) <> "" ? $parametros->estatus->FldTagCaption(1) : $parametros->estatus->CurrentValue;
						break;
					case "0":
						$parametros->estatus->ViewValue = $parametros->estatus->FldTagCaption(2) <> "" ? $parametros->estatus->FldTagCaption(2) : $parametros->estatus->CurrentValue;
						break;
					default:
						$parametros->estatus->ViewValue = $parametros->estatus->CurrentValue;
				}
			} else {
				$parametros->estatus->ViewValue = NULL;
			}
			$parametros->estatus->ViewCustomAttributes = "";
		} elseif ($parametros->RowType == EW_ROWTYPE_ADD) { // Add row

			// Edit refer script
		}
		if ($parametros->RowType == EW_ROWTYPE_ADD ||
			$parametros->RowType == EW_ROWTYPE_EDIT ||
			$parametros->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$parametros->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($parametros->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$parametros->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $parametros;

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
		global $conn, $Language, $Security, $parametros;
		$rsnew = array();

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $parametros->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($parametros->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($parametros->CancelMessage <> "") {
				$this->setFailureMessage($parametros->CancelMessage);
				$parametros->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$parametros->id_parametro->setDbValue($conn->Insert_ID());
			$rsnew['id_parametro'] = $parametros->id_parametro->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$parametros->Row_Inserted($rs, $rsnew);
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
