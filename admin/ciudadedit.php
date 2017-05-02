<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "ciudadinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$ciudad_edit = new cciudad_edit();
$Page =& $ciudad_edit;

// Page init
$ciudad_edit->Page_Init();

// Page main
$ciudad_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var ciudad_edit = new ew_Page("ciudad_edit");

// page properties
ciudad_edit.PageID = "edit"; // page ID
ciudad_edit.FormID = "fciudadedit"; // form ID
var EW_PAGE_ID = ciudad_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
ciudad_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_id_estado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($ciudad->id_estado->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($ciudad->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($ciudad->estatus->FldCaption()) ?>");

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
ciudad_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
ciudad_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ciudad_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $ciudad->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $ciudad->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $ciudad_edit->ShowPageHeader(); ?>
<?php
$ciudad_edit->ShowMessage();
?>
<form name="fciudadedit" id="fciudadedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return ciudad_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="ciudad">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($ciudad->id_estado->Visible) { // id_estado ?>
	<tr id="r_id_estado"<?php echo $ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ciudad->id_estado->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $ciudad->id_estado->CellAttributes() ?>><span id="el_id_estado">
<select id="x_id_estado" name="x_id_estado"<?php echo $ciudad->id_estado->EditAttributes() ?>>
<?php
if (is_array($ciudad->id_estado->EditValue)) {
	$arwrk = $ciudad->id_estado->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ciudad->id_estado->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $ciudad->id_estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ciudad->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ciudad->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $ciudad->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="30" value="<?php echo $ciudad->nombre->EditValue ?>"<?php echo $ciudad->nombre->EditAttributes() ?>>
</span><?php echo $ciudad->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($ciudad->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $ciudad->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $ciudad->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $ciudad->estatus->EditAttributes() ?>>
<?php
if (is_array($ciudad->estatus->EditValue)) {
	$arwrk = $ciudad->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($ciudad->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $ciudad->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_ciudad" id="x_id_ciudad" value="<?php echo ew_HtmlEncode($ciudad->id_ciudad->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$ciudad_edit->ShowPageFooter();
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
$ciudad_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cciudad_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'ciudad';

	// Page object name
	var $PageObjName = 'ciudad_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $ciudad;
		if ($ciudad->UseTokenInUrl) $PageUrl .= "t=" . $ciudad->TableVar . "&"; // Add page token
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
		global $objForm, $ciudad;
		if ($ciudad->UseTokenInUrl) {
			if ($objForm)
				return ($ciudad->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($ciudad->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cciudad_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (ciudad)
		if (!isset($GLOBALS["ciudad"])) {
			$GLOBALS["ciudad"] = new cciudad();
			$GLOBALS["Table"] =& $GLOBALS["ciudad"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'ciudad', TRUE);

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
		global $ciudad;

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("ciudadlist.php");
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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $ciudad;

		// Load key from QueryString
		if (@$_GET["id_ciudad"] <> "")
			$ciudad->id_ciudad->setQueryStringValue($_GET["id_ciudad"]);
		if (@$_POST["a_edit"] <> "") {
			$ciudad->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$ciudad->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$ciudad->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$ciudad->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($ciudad->id_ciudad->CurrentValue == "")
			$this->Page_Terminate("ciudadlist.php"); // Invalid key, return to list
		switch ($ciudad->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("ciudadlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$ciudad->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $ciudad->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$ciudad->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$ciudad->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$ciudad->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $ciudad;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $ciudad;
		if (!$ciudad->id_estado->FldIsDetailKey) {
			$ciudad->id_estado->setFormValue($objForm->GetValue("x_id_estado"));
		}
		if (!$ciudad->nombre->FldIsDetailKey) {
			$ciudad->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$ciudad->estatus->FldIsDetailKey) {
			$ciudad->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$ciudad->id_ciudad->FldIsDetailKey)
			$ciudad->id_ciudad->setFormValue($objForm->GetValue("x_id_ciudad"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $ciudad;
		$this->LoadRow();
		$ciudad->id_ciudad->CurrentValue = $ciudad->id_ciudad->FormValue;
		$ciudad->id_estado->CurrentValue = $ciudad->id_estado->FormValue;
		$ciudad->nombre->CurrentValue = $ciudad->nombre->FormValue;
		$ciudad->estatus->CurrentValue = $ciudad->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $ciudad;
		$sFilter = $ciudad->KeyFilter();

		// Call Row Selecting event
		$ciudad->Row_Selecting($sFilter);

		// Load SQL based on filter
		$ciudad->CurrentFilter = $sFilter;
		$sSql = $ciudad->SQL();
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
		global $conn, $ciudad;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$ciudad->Row_Selected($row);
		$ciudad->id_ciudad->setDbValue($rs->fields('id_ciudad'));
		$ciudad->id_estado->setDbValue($rs->fields('id_estado'));
		$ciudad->nombre->setDbValue($rs->fields('nombre'));
		$ciudad->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $ciudad;

		// Initialize URLs
		// Call Row_Rendering event

		$ciudad->Row_Rendering();

		// Common render codes for all row types
		// id_ciudad
		// id_estado
		// nombre
		// estatus

		if ($ciudad->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_estado
			if (strval($ciudad->id_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id_estado` = " . ew_AdjustSql($ciudad->id_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `estado`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$ciudad->id_estado->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$ciudad->id_estado->ViewValue = $ciudad->id_estado->CurrentValue;
				}
			} else {
				$ciudad->id_estado->ViewValue = NULL;
			}
			$ciudad->id_estado->ViewCustomAttributes = "";

			// nombre
			$ciudad->nombre->ViewValue = $ciudad->nombre->CurrentValue;
			$ciudad->nombre->ViewCustomAttributes = "";

			// estatus
			if (strval($ciudad->estatus->CurrentValue) <> "") {
				switch ($ciudad->estatus->CurrentValue) {
					case "1":
						$ciudad->estatus->ViewValue = $ciudad->estatus->FldTagCaption(1) <> "" ? $ciudad->estatus->FldTagCaption(1) : $ciudad->estatus->CurrentValue;
						break;
					case "0":
						$ciudad->estatus->ViewValue = $ciudad->estatus->FldTagCaption(2) <> "" ? $ciudad->estatus->FldTagCaption(2) : $ciudad->estatus->CurrentValue;
						break;
					default:
						$ciudad->estatus->ViewValue = $ciudad->estatus->CurrentValue;
				}
			} else {
				$ciudad->estatus->ViewValue = NULL;
			}
			$ciudad->estatus->ViewCustomAttributes = "";

			// id_estado
			$ciudad->id_estado->LinkCustomAttributes = "";
			$ciudad->id_estado->HrefValue = "";
			$ciudad->id_estado->TooltipValue = "";

			// nombre
			$ciudad->nombre->LinkCustomAttributes = "";
			$ciudad->nombre->HrefValue = "";
			$ciudad->nombre->TooltipValue = "";

			// estatus
			$ciudad->estatus->LinkCustomAttributes = "";
			$ciudad->estatus->HrefValue = "";
			$ciudad->estatus->TooltipValue = "";
		} elseif ($ciudad->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_estado
			$ciudad->id_estado->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_estado`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `estado`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$ciudad->id_estado->EditValue = $arwrk;

			// nombre
			$ciudad->nombre->EditCustomAttributes = "";
			$ciudad->nombre->EditValue = ew_HtmlEncode($ciudad->nombre->CurrentValue);

			// estatus
			$ciudad->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $ciudad->estatus->FldTagCaption(1) <> "" ? $ciudad->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $ciudad->estatus->FldTagCaption(2) <> "" ? $ciudad->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$ciudad->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_estado

			$ciudad->id_estado->HrefValue = "";

			// nombre
			$ciudad->nombre->HrefValue = "";

			// estatus
			$ciudad->estatus->HrefValue = "";
		}
		if ($ciudad->RowType == EW_ROWTYPE_ADD ||
			$ciudad->RowType == EW_ROWTYPE_EDIT ||
			$ciudad->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$ciudad->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($ciudad->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$ciudad->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $ciudad;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($ciudad->id_estado->FormValue) && $ciudad->id_estado->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $ciudad->id_estado->FldCaption());
		}
		if (!is_null($ciudad->nombre->FormValue) && $ciudad->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $ciudad->nombre->FldCaption());
		}
		if (!is_null($ciudad->estatus->FormValue) && $ciudad->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $ciudad->estatus->FldCaption());
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
		global $conn, $Security, $Language, $ciudad;
		$sFilter = $ciudad->KeyFilter();
		$ciudad->CurrentFilter = $sFilter;
		$sSql = $ciudad->SQL();
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

			// id_estado
			$ciudad->id_estado->SetDbValueDef($rsnew, $ciudad->id_estado->CurrentValue, NULL, $ciudad->id_estado->ReadOnly);

			// nombre
			$ciudad->nombre->SetDbValueDef($rsnew, $ciudad->nombre->CurrentValue, NULL, $ciudad->nombre->ReadOnly);

			// estatus
			$ciudad->estatus->SetDbValueDef($rsnew, $ciudad->estatus->CurrentValue, NULL, $ciudad->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $ciudad->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($ciudad->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($ciudad->CancelMessage <> "") {
					$this->setFailureMessage($ciudad->CancelMessage);
					$ciudad->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$ciudad->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'ciudad';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $ciudad;
		$table = 'ciudad';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_ciudad'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($ciudad->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($ciudad->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($ciudad->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($ciudad->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
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
