<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "estado_civilinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$estado_civil_add = new cestado_civil_add();
$Page =& $estado_civil_add;

// Page init
$estado_civil_add->Page_Init();

// Page main
$estado_civil_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var estado_civil_add = new ew_Page("estado_civil_add");

// page properties
estado_civil_add.PageID = "add"; // page ID
estado_civil_add.FormID = "festado_civiladd"; // form ID
var EW_PAGE_ID = estado_civil_add.PageID; // for backward compatibility

// extend page with ValidateForm function
estado_civil_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_id_char"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($estado_civil->id_char->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($estado_civil->visibilidad->FldCaption()) ?>");

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
estado_civil_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
estado_civil_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
estado_civil_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $estado_civil->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $estado_civil->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $estado_civil_add->ShowPageHeader(); ?>
<?php
$estado_civil_add->ShowMessage();
?>
<form name="festado_civiladd" id="festado_civiladd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return estado_civil_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="estado_civil">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($estado_civil->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $estado_civil->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado_civil->nombre->FldCaption() ?></td>
		<td<?php echo $estado_civil->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $estado_civil->nombre->EditValue ?>"<?php echo $estado_civil->nombre->EditAttributes() ?>>
</span><?php echo $estado_civil->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($estado_civil->id_char->Visible) { // id_char ?>
	<tr id="r_id_char"<?php echo $estado_civil->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado_civil->id_char->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $estado_civil->id_char->CellAttributes() ?>><span id="el_id_char">
<input type="text" name="x_id_char" id="x_id_char" size="30" maxlength="1" value="<?php echo $estado_civil->id_char->EditValue ?>"<?php echo $estado_civil->id_char->EditAttributes() ?>>
</span><?php echo $estado_civil->id_char->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($estado_civil->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $estado_civil->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado_civil->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $estado_civil->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<div id="tp_x_visibilidad" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="{value}"<?php echo $estado_civil->visibilidad->EditAttributes() ?>></label></div>
<div id="dsl_x_visibilidad" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $estado_civil->visibilidad->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($estado_civil->visibilidad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $estado_civil->visibilidad->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $estado_civil->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$estado_civil_add->ShowPageFooter();
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
$estado_civil_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cestado_civil_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'estado_civil';

	// Page object name
	var $PageObjName = 'estado_civil_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $estado_civil;
		if ($estado_civil->UseTokenInUrl) $PageUrl .= "t=" . $estado_civil->TableVar . "&"; // Add page token
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
		global $objForm, $estado_civil;
		if ($estado_civil->UseTokenInUrl) {
			if ($objForm)
				return ($estado_civil->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($estado_civil->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cestado_civil_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (estado_civil)
		if (!isset($GLOBALS["estado_civil"])) {
			$GLOBALS["estado_civil"] = new cestado_civil();
			$GLOBALS["Table"] =& $GLOBALS["estado_civil"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'estado_civil', TRUE);

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
		global $estado_civil;

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
		global $objForm, $Language, $gsFormError, $estado_civil;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$estado_civil->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$estado_civil->CurrentAction = "I"; // Form error, reset action
				$estado_civil->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_civil"] != "") {
				$estado_civil->id_civil->setQueryStringValue($_GET["id_civil"]);
				$estado_civil->setKey("id_civil", $estado_civil->id_civil->CurrentValue); // Set up key
			} else {
				$estado_civil->setKey("id_civil", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$estado_civil->CurrentAction = "C"; // Copy record
			} else {
				$estado_civil->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($estado_civil->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("estado_civillist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$estado_civil->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $estado_civil->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "estado_civilview.php")
						$sReturnUrl = $estado_civil->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$estado_civil->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$estado_civil->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$estado_civil->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $estado_civil;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $estado_civil;
		$estado_civil->nombre->CurrentValue = NULL;
		$estado_civil->nombre->OldValue = $estado_civil->nombre->CurrentValue;
		$estado_civil->id_char->CurrentValue = NULL;
		$estado_civil->id_char->OldValue = $estado_civil->id_char->CurrentValue;
		$estado_civil->visibilidad->CurrentValue = NULL;
		$estado_civil->visibilidad->OldValue = $estado_civil->visibilidad->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $estado_civil;
		if (!$estado_civil->nombre->FldIsDetailKey) {
			$estado_civil->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$estado_civil->id_char->FldIsDetailKey) {
			$estado_civil->id_char->setFormValue($objForm->GetValue("x_id_char"));
		}
		if (!$estado_civil->visibilidad->FldIsDetailKey) {
			$estado_civil->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $estado_civil;
		$this->LoadOldRecord();
		$estado_civil->nombre->CurrentValue = $estado_civil->nombre->FormValue;
		$estado_civil->id_char->CurrentValue = $estado_civil->id_char->FormValue;
		$estado_civil->visibilidad->CurrentValue = $estado_civil->visibilidad->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $estado_civil;
		$sFilter = $estado_civil->KeyFilter();

		// Call Row Selecting event
		$estado_civil->Row_Selecting($sFilter);

		// Load SQL based on filter
		$estado_civil->CurrentFilter = $sFilter;
		$sSql = $estado_civil->SQL();
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
		global $conn, $estado_civil;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$estado_civil->Row_Selected($row);
		$estado_civil->id_civil->setDbValue($rs->fields('id_civil'));
		$estado_civil->nombre->setDbValue($rs->fields('nombre'));
		$estado_civil->id_char->setDbValue($rs->fields('id_char'));
		$estado_civil->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Load old record
	function LoadOldRecord() {
		global $estado_civil;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($estado_civil->getKey("id_civil")) <> "")
			$estado_civil->id_civil->CurrentValue = $estado_civil->getKey("id_civil"); // id_civil
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$estado_civil->CurrentFilter = $estado_civil->KeyFilter();
			$sSql = $estado_civil->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $estado_civil;

		// Initialize URLs
		// Call Row_Rendering event

		$estado_civil->Row_Rendering();

		// Common render codes for all row types
		// id_civil
		// nombre
		// id_char
		// visibilidad

		if ($estado_civil->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_civil
			$estado_civil->id_civil->ViewValue = $estado_civil->id_civil->CurrentValue;
			$estado_civil->id_civil->ViewCustomAttributes = "";

			// nombre
			$estado_civil->nombre->ViewValue = $estado_civil->nombre->CurrentValue;
			$estado_civil->nombre->ViewCustomAttributes = "";

			// id_char
			$estado_civil->id_char->ViewValue = $estado_civil->id_char->CurrentValue;
			$estado_civil->id_char->ViewCustomAttributes = "";

			// visibilidad
			if (strval($estado_civil->visibilidad->CurrentValue) <> "") {
				switch ($estado_civil->visibilidad->CurrentValue) {
					case "1":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(1) <> "" ? $estado_civil->visibilidad->FldTagCaption(1) : $estado_civil->visibilidad->CurrentValue;
						break;
					case "0":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(2) <> "" ? $estado_civil->visibilidad->FldTagCaption(2) : $estado_civil->visibilidad->CurrentValue;
						break;
					default:
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->CurrentValue;
				}
			} else {
				$estado_civil->visibilidad->ViewValue = NULL;
			}
			$estado_civil->visibilidad->ViewCustomAttributes = "";

			// nombre
			$estado_civil->nombre->LinkCustomAttributes = "";
			$estado_civil->nombre->HrefValue = "";
			$estado_civil->nombre->TooltipValue = "";

			// id_char
			$estado_civil->id_char->LinkCustomAttributes = "";
			$estado_civil->id_char->HrefValue = "";
			$estado_civil->id_char->TooltipValue = "";

			// visibilidad
			$estado_civil->visibilidad->LinkCustomAttributes = "";
			$estado_civil->visibilidad->HrefValue = "";
			$estado_civil->visibilidad->TooltipValue = "";
		} elseif ($estado_civil->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$estado_civil->nombre->EditCustomAttributes = "";
			$estado_civil->nombre->EditValue = ew_HtmlEncode($estado_civil->nombre->CurrentValue);

			// id_char
			$estado_civil->id_char->EditCustomAttributes = "";
			$estado_civil->id_char->EditValue = ew_HtmlEncode($estado_civil->id_char->CurrentValue);

			// visibilidad
			$estado_civil->visibilidad->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $estado_civil->visibilidad->FldTagCaption(1) <> "" ? $estado_civil->visibilidad->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $estado_civil->visibilidad->FldTagCaption(2) <> "" ? $estado_civil->visibilidad->FldTagCaption(2) : "0");
			$estado_civil->visibilidad->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$estado_civil->nombre->HrefValue = "";

			// id_char
			$estado_civil->id_char->HrefValue = "";

			// visibilidad
			$estado_civil->visibilidad->HrefValue = "";
		}
		if ($estado_civil->RowType == EW_ROWTYPE_ADD ||
			$estado_civil->RowType == EW_ROWTYPE_EDIT ||
			$estado_civil->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$estado_civil->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($estado_civil->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$estado_civil->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $estado_civil;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($estado_civil->id_char->FormValue) && $estado_civil->id_char->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $estado_civil->id_char->FldCaption());
		}
		if ($estado_civil->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $estado_civil->visibilidad->FldCaption());
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
		global $conn, $Language, $Security, $estado_civil;
		$rsnew = array();

		// nombre
		$estado_civil->nombre->SetDbValueDef($rsnew, $estado_civil->nombre->CurrentValue, NULL, FALSE);

		// id_char
		$estado_civil->id_char->SetDbValueDef($rsnew, $estado_civil->id_char->CurrentValue, "", FALSE);

		// visibilidad
		$estado_civil->visibilidad->SetDbValueDef($rsnew, $estado_civil->visibilidad->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $estado_civil->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($estado_civil->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($estado_civil->CancelMessage <> "") {
				$this->setFailureMessage($estado_civil->CancelMessage);
				$estado_civil->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$estado_civil->id_civil->setDbValue($conn->Insert_ID());
			$rsnew['id_civil'] = $estado_civil->id_civil->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$estado_civil->Row_Inserted($rs, $rsnew);
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