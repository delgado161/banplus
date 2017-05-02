<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "estadoinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$estado_edit = new cestado_edit();
$Page =& $estado_edit;

// Page init
$estado_edit->Page_Init();

// Page main
$estado_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var estado_edit = new ew_Page("estado_edit");

// page properties
estado_edit.PageID = "edit"; // page ID
estado_edit.FormID = "festadoedit"; // form ID
var EW_PAGE_ID = estado_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
estado_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($estado->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($estado->estatus->FldCaption()) ?>");

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
estado_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
estado_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
estado_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $estado->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $estado->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $estado_edit->ShowPageHeader(); ?>
<?php
$estado_edit->ShowMessage();
?>
<form name="festadoedit" id="festadoedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return estado_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="estado">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($estado->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $estado->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $estado->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $estado->nombre->EditValue ?>"<?php echo $estado->nombre->EditAttributes() ?>>
</span><?php echo $estado->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($estado->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $estado->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $estado->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $estado->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $estado->estatus->EditAttributes() ?>>
<?php
if (is_array($estado->estatus->EditValue)) {
	$arwrk = $estado->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($estado->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $estado->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_estado" id="x_id_estado" value="<?php echo ew_HtmlEncode($estado->id_estado->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$estado_edit->ShowPageFooter();
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
$estado_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cestado_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'estado';

	// Page object name
	var $PageObjName = 'estado_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $estado;
		if ($estado->UseTokenInUrl) $PageUrl .= "t=" . $estado->TableVar . "&"; // Add page token
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
		global $objForm, $estado;
		if ($estado->UseTokenInUrl) {
			if ($objForm)
				return ($estado->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($estado->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cestado_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (estado)
		if (!isset($GLOBALS["estado"])) {
			$GLOBALS["estado"] = new cestado();
			$GLOBALS["Table"] =& $GLOBALS["estado"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'estado', TRUE);

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
		global $estado;

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
			$this->Page_Terminate("estadolist.php");
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
		global $objForm, $Language, $gsFormError, $estado;

		// Load key from QueryString
		if (@$_GET["id_estado"] <> "")
			$estado->id_estado->setQueryStringValue($_GET["id_estado"]);
		if (@$_POST["a_edit"] <> "") {
			$estado->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$estado->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$estado->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$estado->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($estado->id_estado->CurrentValue == "")
			$this->Page_Terminate("estadolist.php"); // Invalid key, return to list
		switch ($estado->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("estadolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$estado->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $estado->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$estado->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$estado->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$estado->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $estado;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $estado;
		if (!$estado->nombre->FldIsDetailKey) {
			$estado->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$estado->estatus->FldIsDetailKey) {
			$estado->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$estado->id_estado->FldIsDetailKey)
			$estado->id_estado->setFormValue($objForm->GetValue("x_id_estado"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $estado;
		$this->LoadRow();
		$estado->id_estado->CurrentValue = $estado->id_estado->FormValue;
		$estado->nombre->CurrentValue = $estado->nombre->FormValue;
		$estado->estatus->CurrentValue = $estado->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $estado;
		$sFilter = $estado->KeyFilter();

		// Call Row Selecting event
		$estado->Row_Selecting($sFilter);

		// Load SQL based on filter
		$estado->CurrentFilter = $sFilter;
		$sSql = $estado->SQL();
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
		global $conn, $estado;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$estado->Row_Selected($row);
		$estado->id_estado->setDbValue($rs->fields('id_estado'));
		$estado->nombre->setDbValue($rs->fields('nombre'));
		$estado->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $estado;

		// Initialize URLs
		// Call Row_Rendering event

		$estado->Row_Rendering();

		// Common render codes for all row types
		// id_estado
		// nombre
		// estatus

		if ($estado->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$estado->nombre->ViewValue = $estado->nombre->CurrentValue;
			$estado->nombre->ViewCustomAttributes = "";

			// estatus
			if (strval($estado->estatus->CurrentValue) <> "") {
				switch ($estado->estatus->CurrentValue) {
					case "1":
						$estado->estatus->ViewValue = $estado->estatus->FldTagCaption(1) <> "" ? $estado->estatus->FldTagCaption(1) : $estado->estatus->CurrentValue;
						break;
					case "0":
						$estado->estatus->ViewValue = $estado->estatus->FldTagCaption(2) <> "" ? $estado->estatus->FldTagCaption(2) : $estado->estatus->CurrentValue;
						break;
					default:
						$estado->estatus->ViewValue = $estado->estatus->CurrentValue;
				}
			} else {
				$estado->estatus->ViewValue = NULL;
			}
			$estado->estatus->ViewCustomAttributes = "";

			// nombre
			$estado->nombre->LinkCustomAttributes = "";
			$estado->nombre->HrefValue = "";
			$estado->nombre->TooltipValue = "";

			// estatus
			$estado->estatus->LinkCustomAttributes = "";
			$estado->estatus->HrefValue = "";
			$estado->estatus->TooltipValue = "";
		} elseif ($estado->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$estado->nombre->EditCustomAttributes = "";
			$estado->nombre->EditValue = ew_HtmlEncode($estado->nombre->CurrentValue);

			// estatus
			$estado->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $estado->estatus->FldTagCaption(1) <> "" ? $estado->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $estado->estatus->FldTagCaption(2) <> "" ? $estado->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$estado->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$estado->nombre->HrefValue = "";

			// estatus
			$estado->estatus->HrefValue = "";
		}
		if ($estado->RowType == EW_ROWTYPE_ADD ||
			$estado->RowType == EW_ROWTYPE_EDIT ||
			$estado->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$estado->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($estado->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$estado->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $estado;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($estado->nombre->FormValue) && $estado->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $estado->nombre->FldCaption());
		}
		if (!is_null($estado->estatus->FormValue) && $estado->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $estado->estatus->FldCaption());
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
		global $conn, $Security, $Language, $estado;
		$sFilter = $estado->KeyFilter();
		$estado->CurrentFilter = $sFilter;
		$sSql = $estado->SQL();
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

			// nombre
			$estado->nombre->SetDbValueDef($rsnew, $estado->nombre->CurrentValue, NULL, $estado->nombre->ReadOnly);

			// estatus
			$estado->estatus->SetDbValueDef($rsnew, $estado->estatus->CurrentValue, NULL, $estado->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $estado->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($estado->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($estado->CancelMessage <> "") {
					$this->setFailureMessage($estado->CancelMessage);
					$estado->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$estado->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'estado';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $estado;
		$table = 'estado';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_estado'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($estado->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($estado->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($estado->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($estado->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
