<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_codigo_postalinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_codigo_postal_add = new cz_codigo_postal_add();
$Page =& $z_codigo_postal_add;

// Page init
$z_codigo_postal_add->Page_Init();

// Page main
$z_codigo_postal_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_codigo_postal_add = new ew_Page("z_codigo_postal_add");

// page properties
z_codigo_postal_add.PageID = "add"; // page ID
z_codigo_postal_add.FormID = "fz_codigo_postaladd"; // form ID
var EW_PAGE_ID = z_codigo_postal_add.PageID; // for backward compatibility

// extend page with ValidateForm function
z_codigo_postal_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_codigo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_codigo_postal->codigo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Descripcion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_codigo_postal->Descripcion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_codigo_postal->visibilidad->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_codigo_postal->visibilidad->FldErrMsg()) ?>");

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
z_codigo_postal_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_codigo_postal_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_codigo_postal_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_codigo_postal->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_codigo_postal->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_codigo_postal_add->ShowPageHeader(); ?>
<?php
$z_codigo_postal_add->ShowMessage();
?>
<form name="fz_codigo_postaladd" id="fz_codigo_postaladd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_codigo_postal_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="z_codigo_postal">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_codigo_postal->codigo->Visible) { // codigo ?>
	<tr id="r_codigo"<?php echo $z_codigo_postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_codigo_postal->codigo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_codigo_postal->codigo->CellAttributes() ?>><span id="el_codigo">
<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="45" value="<?php echo $z_codigo_postal->codigo->EditValue ?>"<?php echo $z_codigo_postal->codigo->EditAttributes() ?>>
</span><?php echo $z_codigo_postal->codigo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_codigo_postal->Descripcion->Visible) { // Descripcion ?>
	<tr id="r_Descripcion"<?php echo $z_codigo_postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_codigo_postal->Descripcion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_codigo_postal->Descripcion->CellAttributes() ?>><span id="el_Descripcion">
<input type="text" name="x_Descripcion" id="x_Descripcion" size="30" maxlength="50" value="<?php echo $z_codigo_postal->Descripcion->EditValue ?>"<?php echo $z_codigo_postal->Descripcion->EditAttributes() ?>>
</span><?php echo $z_codigo_postal->Descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_codigo_postal->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_codigo_postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_codigo_postal->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_codigo_postal->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<input type="text" name="x_visibilidad" id="x_visibilidad" size="30" value="<?php echo $z_codigo_postal->visibilidad->EditValue ?>"<?php echo $z_codigo_postal->visibilidad->EditAttributes() ?>>
</span><?php echo $z_codigo_postal->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$z_codigo_postal_add->ShowPageFooter();
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
$z_codigo_postal_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_codigo_postal_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = '_codigo_postal';

	// Page object name
	var $PageObjName = 'z_codigo_postal_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_codigo_postal;
		if ($z_codigo_postal->UseTokenInUrl) $PageUrl .= "t=" . $z_codigo_postal->TableVar . "&"; // Add page token
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
		global $objForm, $z_codigo_postal;
		if ($z_codigo_postal->UseTokenInUrl) {
			if ($objForm)
				return ($z_codigo_postal->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_codigo_postal->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_codigo_postal_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_codigo_postal)
		if (!isset($GLOBALS["z_codigo_postal"])) {
			$GLOBALS["z_codigo_postal"] = new cz_codigo_postal();
			$GLOBALS["Table"] =& $GLOBALS["z_codigo_postal"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_codigo_postal', TRUE);

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
		global $z_codigo_postal;

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
		global $objForm, $Language, $gsFormError, $z_codigo_postal;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$z_codigo_postal->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_codigo_postal->CurrentAction = "I"; // Form error, reset action
				$z_codigo_postal->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_codigo_postal"] != "") {
				$z_codigo_postal->id_codigo_postal->setQueryStringValue($_GET["id_codigo_postal"]);
				$z_codigo_postal->setKey("id_codigo_postal", $z_codigo_postal->id_codigo_postal->CurrentValue); // Set up key
			} else {
				$z_codigo_postal->setKey("id_codigo_postal", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$z_codigo_postal->CurrentAction = "C"; // Copy record
			} else {
				$z_codigo_postal->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($z_codigo_postal->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_codigo_postallist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$z_codigo_postal->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $z_codigo_postal->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "z_codigo_postalview.php")
						$sReturnUrl = $z_codigo_postal->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$z_codigo_postal->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$z_codigo_postal->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$z_codigo_postal->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $z_codigo_postal;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $z_codigo_postal;
		$z_codigo_postal->codigo->CurrentValue = NULL;
		$z_codigo_postal->codigo->OldValue = $z_codigo_postal->codigo->CurrentValue;
		$z_codigo_postal->Descripcion->CurrentValue = NULL;
		$z_codigo_postal->Descripcion->OldValue = $z_codigo_postal->Descripcion->CurrentValue;
		$z_codigo_postal->visibilidad->CurrentValue = NULL;
		$z_codigo_postal->visibilidad->OldValue = $z_codigo_postal->visibilidad->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_codigo_postal;
		if (!$z_codigo_postal->codigo->FldIsDetailKey) {
			$z_codigo_postal->codigo->setFormValue($objForm->GetValue("x_codigo"));
		}
		if (!$z_codigo_postal->Descripcion->FldIsDetailKey) {
			$z_codigo_postal->Descripcion->setFormValue($objForm->GetValue("x_Descripcion"));
		}
		if (!$z_codigo_postal->visibilidad->FldIsDetailKey) {
			$z_codigo_postal->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $z_codigo_postal;
		$this->LoadOldRecord();
		$z_codigo_postal->codigo->CurrentValue = $z_codigo_postal->codigo->FormValue;
		$z_codigo_postal->Descripcion->CurrentValue = $z_codigo_postal->Descripcion->FormValue;
		$z_codigo_postal->visibilidad->CurrentValue = $z_codigo_postal->visibilidad->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_codigo_postal;
		$sFilter = $z_codigo_postal->KeyFilter();

		// Call Row Selecting event
		$z_codigo_postal->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_codigo_postal->CurrentFilter = $sFilter;
		$sSql = $z_codigo_postal->SQL();
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
		global $conn, $z_codigo_postal;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_codigo_postal->Row_Selected($row);
		$z_codigo_postal->id_codigo_postal->setDbValue($rs->fields('id_codigo_postal'));
		$z_codigo_postal->codigo->setDbValue($rs->fields('codigo'));
		$z_codigo_postal->Descripcion->setDbValue($rs->fields('Descripcion'));
		$z_codigo_postal->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Load old record
	function LoadOldRecord() {
		global $z_codigo_postal;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($z_codigo_postal->getKey("id_codigo_postal")) <> "")
			$z_codigo_postal->id_codigo_postal->CurrentValue = $z_codigo_postal->getKey("id_codigo_postal"); // id_codigo_postal
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$z_codigo_postal->CurrentFilter = $z_codigo_postal->KeyFilter();
			$sSql = $z_codigo_postal->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_codigo_postal;

		// Initialize URLs
		// Call Row_Rendering event

		$z_codigo_postal->Row_Rendering();

		// Common render codes for all row types
		// id_codigo_postal
		// codigo
		// Descripcion
		// visibilidad

		if ($z_codigo_postal->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_codigo_postal
			$z_codigo_postal->id_codigo_postal->ViewValue = $z_codigo_postal->id_codigo_postal->CurrentValue;
			$z_codigo_postal->id_codigo_postal->ViewCustomAttributes = "";

			// codigo
			$z_codigo_postal->codigo->ViewValue = $z_codigo_postal->codigo->CurrentValue;
			$z_codigo_postal->codigo->ViewCustomAttributes = "";

			// Descripcion
			$z_codigo_postal->Descripcion->ViewValue = $z_codigo_postal->Descripcion->CurrentValue;
			$z_codigo_postal->Descripcion->ViewCustomAttributes = "";

			// visibilidad
			$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->CurrentValue;
			$z_codigo_postal->visibilidad->ViewCustomAttributes = "";

			// codigo
			$z_codigo_postal->codigo->LinkCustomAttributes = "";
			$z_codigo_postal->codigo->HrefValue = "";
			$z_codigo_postal->codigo->TooltipValue = "";

			// Descripcion
			$z_codigo_postal->Descripcion->LinkCustomAttributes = "";
			$z_codigo_postal->Descripcion->HrefValue = "";
			$z_codigo_postal->Descripcion->TooltipValue = "";

			// visibilidad
			$z_codigo_postal->visibilidad->LinkCustomAttributes = "";
			$z_codigo_postal->visibilidad->HrefValue = "";
			$z_codigo_postal->visibilidad->TooltipValue = "";
		} elseif ($z_codigo_postal->RowType == EW_ROWTYPE_ADD) { // Add row

			// codigo
			$z_codigo_postal->codigo->EditCustomAttributes = "";
			$z_codigo_postal->codigo->EditValue = ew_HtmlEncode($z_codigo_postal->codigo->CurrentValue);

			// Descripcion
			$z_codigo_postal->Descripcion->EditCustomAttributes = "";
			$z_codigo_postal->Descripcion->EditValue = ew_HtmlEncode($z_codigo_postal->Descripcion->CurrentValue);

			// visibilidad
			$z_codigo_postal->visibilidad->EditCustomAttributes = "";
			$z_codigo_postal->visibilidad->EditValue = ew_HtmlEncode($z_codigo_postal->visibilidad->CurrentValue);

			// Edit refer script
			// codigo

			$z_codigo_postal->codigo->HrefValue = "";

			// Descripcion
			$z_codigo_postal->Descripcion->HrefValue = "";

			// visibilidad
			$z_codigo_postal->visibilidad->HrefValue = "";
		}
		if ($z_codigo_postal->RowType == EW_ROWTYPE_ADD ||
			$z_codigo_postal->RowType == EW_ROWTYPE_EDIT ||
			$z_codigo_postal->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$z_codigo_postal->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($z_codigo_postal->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_codigo_postal->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $z_codigo_postal;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($z_codigo_postal->codigo->FormValue) && $z_codigo_postal->codigo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_codigo_postal->codigo->FldCaption());
		}
		if (!is_null($z_codigo_postal->Descripcion->FormValue) && $z_codigo_postal->Descripcion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_codigo_postal->Descripcion->FldCaption());
		}
		if (!is_null($z_codigo_postal->visibilidad->FormValue) && $z_codigo_postal->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_codigo_postal->visibilidad->FldCaption());
		}
		if (!ew_CheckInteger($z_codigo_postal->visibilidad->FormValue)) {
			ew_AddMessage($gsFormError, $z_codigo_postal->visibilidad->FldErrMsg());
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
		global $conn, $Language, $Security, $z_codigo_postal;
		$rsnew = array();

		// codigo
		$z_codigo_postal->codigo->SetDbValueDef($rsnew, $z_codigo_postal->codigo->CurrentValue, "", FALSE);

		// Descripcion
		$z_codigo_postal->Descripcion->SetDbValueDef($rsnew, $z_codigo_postal->Descripcion->CurrentValue, "", FALSE);

		// visibilidad
		$z_codigo_postal->visibilidad->SetDbValueDef($rsnew, $z_codigo_postal->visibilidad->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $z_codigo_postal->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($z_codigo_postal->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($z_codigo_postal->CancelMessage <> "") {
				$this->setFailureMessage($z_codigo_postal->CancelMessage);
				$z_codigo_postal->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$z_codigo_postal->id_codigo_postal->setDbValue($conn->Insert_ID());
			$rsnew['id_codigo_postal'] = $z_codigo_postal->id_codigo_postal->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$z_codigo_postal->Row_Inserted($rs, $rsnew);
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
