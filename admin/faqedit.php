<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "faqinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$faq_edit = new cfaq_edit();
$Page =& $faq_edit;

// Page init
$faq_edit->Page_Init();

// Page main
$faq_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var faq_edit = new ew_Page("faq_edit");

// page properties
faq_edit.PageID = "edit"; // page ID
faq_edit.FormID = "ffaqedit"; // form ID
var EW_PAGE_ID = faq_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
faq_edit.ValidateForm = function(fobj) {
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
faq_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
faq_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
faq_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $faq->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $faq->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $faq_edit->ShowPageHeader(); ?>
<?php
$faq_edit->ShowMessage();
?>
<form name="ffaqedit" id="ffaqedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return faq_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="faq">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($faq->pregunta->Visible) { // pregunta ?>
	<tr id="r_pregunta"<?php echo $faq->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $faq->pregunta->FldCaption() ?></td>
		<td<?php echo $faq->pregunta->CellAttributes() ?>><span id="el_pregunta">
<input type="text" name="x_pregunta" id="x_pregunta" size="60" maxlength="255" value="<?php echo $faq->pregunta->EditValue ?>"<?php echo $faq->pregunta->EditAttributes() ?>>
</span><?php echo $faq->pregunta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($faq->respuesta->Visible) { // respuesta ?>
	<tr id="r_respuesta"<?php echo $faq->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $faq->respuesta->FldCaption() ?></td>
		<td<?php echo $faq->respuesta->CellAttributes() ?>><span id="el_respuesta">
<textarea name="x_respuesta" id="x_respuesta" cols="55" rows="6"<?php echo $faq->respuesta->EditAttributes() ?>><?php echo $faq->respuesta->EditValue ?></textarea>
</span><?php echo $faq->respuesta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($faq->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $faq->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $faq->estatus->FldCaption() ?></td>
		<td<?php echo $faq->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $faq->estatus->EditAttributes() ?>>
<?php
if (is_array($faq->estatus->EditValue)) {
	$arwrk = $faq->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($faq->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $faq->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_faq" id="x_id_faq" value="<?php echo ew_HtmlEncode($faq->id_faq->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$faq_edit->ShowPageFooter();
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
$faq_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cfaq_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'faq';

	// Page object name
	var $PageObjName = 'faq_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $faq;
		if ($faq->UseTokenInUrl) $PageUrl .= "t=" . $faq->TableVar . "&"; // Add page token
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
		global $objForm, $faq;
		if ($faq->UseTokenInUrl) {
			if ($objForm)
				return ($faq->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($faq->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfaq_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (faq)
		if (!isset($GLOBALS["faq"])) {
			$GLOBALS["faq"] = new cfaq();
			$GLOBALS["Table"] =& $GLOBALS["faq"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'faq', TRUE);

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
		global $faq;

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
			$this->Page_Terminate("faqlist.php");
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
		global $objForm, $Language, $gsFormError, $faq;

		// Load key from QueryString
		if (@$_GET["id_faq"] <> "")
			$faq->id_faq->setQueryStringValue($_GET["id_faq"]);
		if (@$_POST["a_edit"] <> "") {
			$faq->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$faq->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$faq->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$faq->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($faq->id_faq->CurrentValue == "")
			$this->Page_Terminate("faqlist.php"); // Invalid key, return to list
		switch ($faq->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("faqlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$faq->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $faq->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$faq->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$faq->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$faq->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $faq;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $faq;
		if (!$faq->pregunta->FldIsDetailKey) {
			$faq->pregunta->setFormValue($objForm->GetValue("x_pregunta"));
		}
		if (!$faq->respuesta->FldIsDetailKey) {
			$faq->respuesta->setFormValue($objForm->GetValue("x_respuesta"));
		}
		if (!$faq->estatus->FldIsDetailKey) {
			$faq->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$faq->id_faq->FldIsDetailKey)
			$faq->id_faq->setFormValue($objForm->GetValue("x_id_faq"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $faq;
		$this->LoadRow();
		$faq->id_faq->CurrentValue = $faq->id_faq->FormValue;
		$faq->pregunta->CurrentValue = $faq->pregunta->FormValue;
		$faq->respuesta->CurrentValue = $faq->respuesta->FormValue;
		$faq->estatus->CurrentValue = $faq->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $faq;
		$sFilter = $faq->KeyFilter();

		// Call Row Selecting event
		$faq->Row_Selecting($sFilter);

		// Load SQL based on filter
		$faq->CurrentFilter = $sFilter;
		$sSql = $faq->SQL();
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
		global $conn, $faq;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$faq->Row_Selected($row);
		$faq->id_faq->setDbValue($rs->fields('id_faq'));
		$faq->pregunta->setDbValue($rs->fields('pregunta'));
		$faq->respuesta->setDbValue($rs->fields('respuesta'));
		$faq->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $faq;

		// Initialize URLs
		// Call Row_Rendering event

		$faq->Row_Rendering();

		// Common render codes for all row types
		// id_faq
		// pregunta
		// respuesta
		// estatus

		if ($faq->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_faq
			$faq->id_faq->ViewValue = $faq->id_faq->CurrentValue;
			$faq->id_faq->ViewCustomAttributes = "";

			// pregunta
			$faq->pregunta->ViewValue = $faq->pregunta->CurrentValue;
			$faq->pregunta->ViewCustomAttributes = "";

			// respuesta
			$faq->respuesta->ViewValue = $faq->respuesta->CurrentValue;
			$faq->respuesta->ViewCustomAttributes = "";

			// estatus
			if (strval($faq->estatus->CurrentValue) <> "") {
				switch ($faq->estatus->CurrentValue) {
					case "1":
						$faq->estatus->ViewValue = $faq->estatus->FldTagCaption(1) <> "" ? $faq->estatus->FldTagCaption(1) : $faq->estatus->CurrentValue;
						break;
					case "0":
						$faq->estatus->ViewValue = $faq->estatus->FldTagCaption(2) <> "" ? $faq->estatus->FldTagCaption(2) : $faq->estatus->CurrentValue;
						break;
					case "3":
						$faq->estatus->ViewValue = $faq->estatus->FldTagCaption(3) <> "" ? $faq->estatus->FldTagCaption(3) : $faq->estatus->CurrentValue;
						break;
					case "4":
						$faq->estatus->ViewValue = $faq->estatus->FldTagCaption(4) <> "" ? $faq->estatus->FldTagCaption(4) : $faq->estatus->CurrentValue;
						break;
					default:
						$faq->estatus->ViewValue = $faq->estatus->CurrentValue;
				}
			} else {
				$faq->estatus->ViewValue = NULL;
			}
			$faq->estatus->ViewCustomAttributes = "";

			// pregunta
			$faq->pregunta->LinkCustomAttributes = "";
			$faq->pregunta->HrefValue = "";
			$faq->pregunta->TooltipValue = "";

			// respuesta
			$faq->respuesta->LinkCustomAttributes = "";
			$faq->respuesta->HrefValue = "";
			$faq->respuesta->TooltipValue = "";

			// estatus
			$faq->estatus->LinkCustomAttributes = "";
			$faq->estatus->HrefValue = "";
			$faq->estatus->TooltipValue = "";
		} elseif ($faq->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// pregunta
			$faq->pregunta->EditCustomAttributes = "";
			$faq->pregunta->EditValue = ew_HtmlEncode($faq->pregunta->CurrentValue);

			// respuesta
			$faq->respuesta->EditCustomAttributes = "";
			$faq->respuesta->EditValue = ew_HtmlEncode($faq->respuesta->CurrentValue);

			// estatus
			$faq->estatus->EditCustomAttributes = "";
			$arwrk = array();
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("0", $faq->estatus->FldTagCaption(2) <> "" ? $faq->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $faq->estatus->FldTagCaption(3) <> "" ? $faq->estatus->FldTagCaption(3) : "3");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $faq->estatus->FldTagCaption(3) <> "" ? $faq->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $faq->estatus->FldTagCaption(4) <> "" ? $faq->estatus->FldTagCaption(4) : "4");
			}
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $faq->estatus->FldTagCaption(1) <> "" ? $faq->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $faq->estatus->FldTagCaption(4) <> "" ? $faq->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $faq->estatus->FldTagCaption(1) <> "" ? $faq->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $faq->estatus->FldTagCaption(2) <> "" ? $faq->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $faq->estatus->FldTagCaption(3) <> "" ? $faq->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $faq->estatus->FldTagCaption(4) <> "" ? $faq->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $faq->estatus->FldTagCaption(1) <> "" ? $faq->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $faq->estatus->FldTagCaption(2) <> "" ? $faq->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $faq->estatus->FldTagCaption(3) <> "" ? $faq->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $faq->estatus->FldTagCaption(4) <> "" ? $faq->estatus->FldTagCaption(4) : "4");
			}
			
			
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$faq->estatus->EditValue = $arwrk;

			// Edit refer script
			// pregunta

			$faq->pregunta->HrefValue = "";

			// respuesta
			$faq->respuesta->HrefValue = "";

			// estatus
			$faq->estatus->HrefValue = "";
		}
		if ($faq->RowType == EW_ROWTYPE_ADD ||
			$faq->RowType == EW_ROWTYPE_EDIT ||
			$faq->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$faq->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($faq->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$faq->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $faq;

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $faq;
		$sFilter = $faq->KeyFilter();
		$faq->CurrentFilter = $sFilter;
		$sSql = $faq->SQL();
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

			// pregunta
			$faq->pregunta->SetDbValueDef($rsnew, $faq->pregunta->CurrentValue, NULL, $faq->pregunta->ReadOnly);

			// respuesta
			$faq->respuesta->SetDbValueDef($rsnew, $faq->respuesta->CurrentValue, NULL, $faq->respuesta->ReadOnly);

			// estatus
			$faq->estatus->SetDbValueDef($rsnew, $faq->estatus->CurrentValue, NULL, $faq->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $faq->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($faq->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($faq->CancelMessage <> "") {
					$this->setFailureMessage($faq->CancelMessage);
					$faq->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$faq->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
