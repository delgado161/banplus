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
$tipos_productos_add = new ctipos_productos_add();
$Page =& $tipos_productos_add;

// Page init
$tipos_productos_add->Page_Init();

// Page main
$tipos_productos_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tipos_productos_add = new ew_Page("tipos_productos_add");

// page properties
tipos_productos_add.PageID = "add"; // page ID
tipos_productos_add.FormID = "ftipos_productosadd"; // form ID
var EW_PAGE_ID = tipos_productos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tipos_productos_add.ValidateForm = function(fobj) {
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
tipos_productos_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tipos_productos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tipos_productos_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tipos_productos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tipos_productos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tipos_productos_add->ShowPageHeader(); ?>
<?php
$tipos_productos_add->ShowMessage();
?>
<form name="ftipos_productosadd" id="ftipos_productosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tipos_productos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tipos_productos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tipos_productos->id_producto->Visible) { // id_producto ?>
	<tr id="r_id_producto"<?php echo $tipos_productos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tipos_productos->id_producto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tipos_productos->id_producto->CellAttributes() ?>><span id="el_id_producto">
<input type="text" name="x_id_producto" id="x_id_producto" size="30" value="<?php echo $tipos_productos->id_producto->EditValue ?>"<?php echo $tipos_productos->id_producto->EditAttributes() ?>>
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$tipos_productos_add->ShowPageFooter();
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
$tipos_productos_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctipos_productos_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tipos_productos';

	// Page object name
	var $PageObjName = 'tipos_productos_add';

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
	function ctipos_productos_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $tipos_productos;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$tipos_productos->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tipos_productos->CurrentAction = "I"; // Form error, reset action
				$tipos_productos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_producto"] != "") {
				$tipos_productos->id_producto->setQueryStringValue($_GET["id_producto"]);
				$tipos_productos->setKey("id_producto", $tipos_productos->id_producto->CurrentValue); // Set up key
			} else {
				$tipos_productos->setKey("id_producto", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$tipos_productos->CurrentAction = "C"; // Copy record
			} else {
				$tipos_productos->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($tipos_productos->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tipos_productoslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$tipos_productos->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tipos_productos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tipos_productosview.php")
						$sReturnUrl = $tipos_productos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$tipos_productos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$tipos_productos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $tipos_productos;
		$tipos_productos->id_producto->CurrentValue = NULL;
		$tipos_productos->id_producto->OldValue = $tipos_productos->id_producto->CurrentValue;
		$tipos_productos->tipo->CurrentValue = NULL;
		$tipos_productos->tipo->OldValue = $tipos_productos->tipo->CurrentValue;
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
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $tipos_productos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tipos_productos->getKey("id_producto")) <> "")
			$tipos_productos->id_producto->CurrentValue = $tipos_productos->getKey("id_producto"); // id_producto
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tipos_productos->CurrentFilter = $tipos_productos->KeyFilter();
			$sSql = $tipos_productos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($tipos_productos->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_producto
			$tipos_productos->id_producto->EditCustomAttributes = "";
			$tipos_productos->id_producto->EditValue = ew_HtmlEncode($tipos_productos->id_producto->CurrentValue);

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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $tipos_productos;

		// Check if key value entered
		if ($tipos_productos->id_producto->CurrentValue == "" && $tipos_productos->id_producto->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $tipos_productos->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $tipos_productos->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// id_producto
		$tipos_productos->id_producto->SetDbValueDef($rsnew, $tipos_productos->id_producto->CurrentValue, 0, FALSE);

		// tipo
		$tipos_productos->tipo->SetDbValueDef($rsnew, $tipos_productos->tipo->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $tipos_productos->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tipos_productos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tipos_productos->CancelMessage <> "") {
				$this->setFailureMessage($tipos_productos->CancelMessage);
				$tipos_productos->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$tipos_productos->Row_Inserted($rs, $rsnew);
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
