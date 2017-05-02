<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "informacion_financierainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$informacion_financiera_edit = new cinformacion_financiera_edit();
$Page =& $informacion_financiera_edit;

// Page init
$informacion_financiera_edit->Page_Init();

// Page main
$informacion_financiera_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var informacion_financiera_edit = new ew_Page("informacion_financiera_edit");

// page properties
informacion_financiera_edit.PageID = "edit"; // page ID
informacion_financiera_edit.FormID = "finformacion_financieraedit"; // form ID
var EW_PAGE_ID = informacion_financiera_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
informacion_financiera_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_ano"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($informacion_financiera->ano->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ano"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($informacion_financiera->ano->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_mes"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($informacion_financiera->mes->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_archivo"];
		aelm = fobj.elements["a" + infix + "_archivo"];
		var chk_archivo = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_archivo && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($informacion_financiera->archivo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_archivo"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($informacion_financiera->estatus->FldCaption()) ?>");

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
informacion_financiera_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
informacion_financiera_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
informacion_financiera_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $informacion_financiera->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $informacion_financiera->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $informacion_financiera_edit->ShowPageHeader(); ?>
<?php
$informacion_financiera_edit->ShowMessage();
?>
<form name="finformacion_financieraedit" id="finformacion_financieraedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return informacion_financiera_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="informacion_financiera">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($informacion_financiera->ano->Visible) { // ano ?>
	<tr id="r_ano"<?php echo $informacion_financiera->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $informacion_financiera->ano->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $informacion_financiera->ano->CellAttributes() ?>><span id="el_ano">
<input type="text" name="x_ano" id="x_ano" size="4" maxlength="4" value="<?php echo $informacion_financiera->ano->EditValue ?>"<?php echo $informacion_financiera->ano->EditAttributes() ?>>
</span><?php echo $informacion_financiera->ano->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($informacion_financiera->mes->Visible) { // mes ?>
	<tr id="r_mes"<?php echo $informacion_financiera->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $informacion_financiera->mes->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $informacion_financiera->mes->CellAttributes() ?>><span id="el_mes">
<select id="x_mes" name="x_mes"<?php echo $informacion_financiera->mes->EditAttributes() ?>>
<?php
if (is_array($informacion_financiera->mes->EditValue)) {
	$arwrk = $informacion_financiera->mes->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($informacion_financiera->mes->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $informacion_financiera->mes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($informacion_financiera->archivo->Visible) { // archivo ?>
	<tr id="r_archivo"<?php echo $informacion_financiera->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $informacion_financiera->archivo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $informacion_financiera->archivo->CellAttributes() ?>><span id="el_archivo">
<div id="old_x_archivo">
<?php if ($informacion_financiera->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($informacion_financiera->archivo->Upload->DbValue)) { ?>
<a<?php echo $informacion_financiera->archivo->LinkAttributes() ?>><?php echo $informacion_financiera->archivo->EditValue ?></a>
<?php } elseif (!in_array($informacion_financiera->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($informacion_financiera->archivo->Upload->DbValue)) { ?>
<?php echo $informacion_financiera->archivo->EditValue ?>
<?php } elseif (!in_array($informacion_financiera->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_archivo">
<?php if (!empty($informacion_financiera->archivo->Upload->DbValue)) { ?>
<label><input type="radio" name="a_archivo" id="a_archivo" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $informacion_financiera->archivo->EditAttrs["onchange"] = "this.form.a_archivo[2].checked=true;" . @$informacion_financiera->archivo->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_archivo" id="a_archivo" value="3">
<?php } ?>
<input type="file" name="x_archivo" id="x_archivo" size="45"<?php echo $informacion_financiera->archivo->EditAttributes() ?>>
</div>
</span><?php echo $informacion_financiera->archivo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($informacion_financiera->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $informacion_financiera->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $informacion_financiera->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $informacion_financiera->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $informacion_financiera->estatus->EditAttributes() ?>>
<?php
if (is_array($informacion_financiera->estatus->EditValue)) {
	$arwrk = $informacion_financiera->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($informacion_financiera->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $informacion_financiera->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_informacion_financiera" id="x_id_informacion_financiera" value="<?php echo ew_HtmlEncode($informacion_financiera->id_informacion_financiera->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$informacion_financiera_edit->ShowPageFooter();
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
$informacion_financiera_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cinformacion_financiera_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'informacion_financiera';

	// Page object name
	var $PageObjName = 'informacion_financiera_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $informacion_financiera;
		if ($informacion_financiera->UseTokenInUrl) $PageUrl .= "t=" . $informacion_financiera->TableVar . "&"; // Add page token
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
		global $objForm, $informacion_financiera;
		if ($informacion_financiera->UseTokenInUrl) {
			if ($objForm)
				return ($informacion_financiera->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($informacion_financiera->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinformacion_financiera_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (informacion_financiera)
		if (!isset($GLOBALS["informacion_financiera"])) {
			$GLOBALS["informacion_financiera"] = new cinformacion_financiera();
			$GLOBALS["Table"] =& $GLOBALS["informacion_financiera"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'informacion_financiera', TRUE);

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
		global $informacion_financiera;

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
			$this->Page_Terminate("informacion_financieralist.php");
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
		global $objForm, $Language, $gsFormError, $informacion_financiera;

		// Load key from QueryString
		if (@$_GET["id_informacion_financiera"] <> "")
			$informacion_financiera->id_informacion_financiera->setQueryStringValue($_GET["id_informacion_financiera"]);
		if (@$_POST["a_edit"] <> "") {
			$informacion_financiera->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$informacion_financiera->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$informacion_financiera->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$informacion_financiera->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($informacion_financiera->id_informacion_financiera->CurrentValue == "")
			$this->Page_Terminate("informacion_financieralist.php"); // Invalid key, return to list
		switch ($informacion_financiera->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("informacion_financieralist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$informacion_financiera->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $informacion_financiera->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$informacion_financiera->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$informacion_financiera->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$informacion_financiera->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $informacion_financiera;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$informacion_financiera->archivo->Upload->Index = $objForm->Index;
		$informacion_financiera->archivo->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$informacion_financiera->archivo->Upload->RestoreFromSession();
		} else {
			if ($informacion_financiera->archivo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $informacion_financiera->archivo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$informacion_financiera->archivo->Upload->SaveToSession();
			$informacion_financiera->archivo->CurrentValue = $informacion_financiera->archivo->Upload->FileName;
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $informacion_financiera;
		$this->GetUploadFiles(); // Get upload files
		if (!$informacion_financiera->ano->FldIsDetailKey) {
			$informacion_financiera->ano->setFormValue($objForm->GetValue("x_ano"));
		}
		if (!$informacion_financiera->mes->FldIsDetailKey) {
			$informacion_financiera->mes->setFormValue($objForm->GetValue("x_mes"));
		}
		if (!$informacion_financiera->estatus->FldIsDetailKey) {
			$informacion_financiera->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$informacion_financiera->id_informacion_financiera->FldIsDetailKey)
			$informacion_financiera->id_informacion_financiera->setFormValue($objForm->GetValue("x_id_informacion_financiera"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $informacion_financiera;
		$this->LoadRow();
		$informacion_financiera->id_informacion_financiera->CurrentValue = $informacion_financiera->id_informacion_financiera->FormValue;
		$informacion_financiera->ano->CurrentValue = $informacion_financiera->ano->FormValue;
		$informacion_financiera->mes->CurrentValue = $informacion_financiera->mes->FormValue;
		$informacion_financiera->estatus->CurrentValue = $informacion_financiera->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $informacion_financiera;
		$sFilter = $informacion_financiera->KeyFilter();

		// Call Row Selecting event
		$informacion_financiera->Row_Selecting($sFilter);

		// Load SQL based on filter
		$informacion_financiera->CurrentFilter = $sFilter;
		$sSql = $informacion_financiera->SQL();
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
		global $conn, $informacion_financiera;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$informacion_financiera->Row_Selected($row);
		$informacion_financiera->id_informacion_financiera->setDbValue($rs->fields('id_informacion_financiera'));
		$informacion_financiera->ano->setDbValue($rs->fields('ano'));
		$informacion_financiera->mes->setDbValue($rs->fields('mes'));
		$informacion_financiera->archivo->Upload->DbValue = $rs->fields('archivo');
		$informacion_financiera->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $informacion_financiera;

		// Initialize URLs
		// Call Row_Rendering event

		$informacion_financiera->Row_Rendering();

		// Common render codes for all row types
		// id_informacion_financiera
		// ano
		// mes
		// archivo
		// estatus

		if ($informacion_financiera->RowType == EW_ROWTYPE_VIEW) { // View row

			// ano
			$informacion_financiera->ano->ViewValue = $informacion_financiera->ano->CurrentValue;
			$informacion_financiera->ano->ViewCustomAttributes = "";

			// mes
			if (strval($informacion_financiera->mes->CurrentValue) <> "") {
				switch ($informacion_financiera->mes->CurrentValue) {
					case "1":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(1) <> "" ? $informacion_financiera->mes->FldTagCaption(1) : $informacion_financiera->mes->CurrentValue;
						break;
					case "2":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(2) <> "" ? $informacion_financiera->mes->FldTagCaption(2) : $informacion_financiera->mes->CurrentValue;
						break;
					case "3":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(3) <> "" ? $informacion_financiera->mes->FldTagCaption(3) : $informacion_financiera->mes->CurrentValue;
						break;
					case "4":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(4) <> "" ? $informacion_financiera->mes->FldTagCaption(4) : $informacion_financiera->mes->CurrentValue;
						break;
					case "5":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(5) <> "" ? $informacion_financiera->mes->FldTagCaption(5) : $informacion_financiera->mes->CurrentValue;
						break;
					case "6":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(6) <> "" ? $informacion_financiera->mes->FldTagCaption(6) : $informacion_financiera->mes->CurrentValue;
						break;
					case "7":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(7) <> "" ? $informacion_financiera->mes->FldTagCaption(7) : $informacion_financiera->mes->CurrentValue;
						break;
					case "8":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(8) <> "" ? $informacion_financiera->mes->FldTagCaption(8) : $informacion_financiera->mes->CurrentValue;
						break;
					case "9":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(9) <> "" ? $informacion_financiera->mes->FldTagCaption(9) : $informacion_financiera->mes->CurrentValue;
						break;
					case "10":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(10) <> "" ? $informacion_financiera->mes->FldTagCaption(10) : $informacion_financiera->mes->CurrentValue;
						break;
					case "11":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(11) <> "" ? $informacion_financiera->mes->FldTagCaption(11) : $informacion_financiera->mes->CurrentValue;
						break;
					case "12":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(12) <> "" ? $informacion_financiera->mes->FldTagCaption(12) : $informacion_financiera->mes->CurrentValue;
						break;
					default:
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->CurrentValue;
				}
			} else {
				$informacion_financiera->mes->ViewValue = NULL;
			}
			$informacion_financiera->mes->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->ViewValue = $informacion_financiera->archivo->Upload->DbValue;
			} else {
				$informacion_financiera->archivo->ViewValue = "";
			}
			$informacion_financiera->archivo->ViewCustomAttributes = "";

			// estatus
			if (strval($informacion_financiera->estatus->CurrentValue) <> "") {
				switch ($informacion_financiera->estatus->CurrentValue) {
					case "1":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(1) <> "" ? $informacion_financiera->estatus->FldTagCaption(1) : $informacion_financiera->estatus->CurrentValue;
						break;
					case "0":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(2) <> "" ? $informacion_financiera->estatus->FldTagCaption(2) : $informacion_financiera->estatus->CurrentValue;
						break;
					case "3":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(3) <> "" ? $informacion_financiera->estatus->FldTagCaption(3) : $informacion_financiera->estatus->CurrentValue;
						break;
					case "4":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(4) <> "" ? $informacion_financiera->estatus->FldTagCaption(4) : $informacion_financiera->estatus->CurrentValue;
						break;
					default:
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->CurrentValue;
				}
			} else {
				$informacion_financiera->estatus->ViewValue = NULL;
			}
			$informacion_financiera->estatus->ViewCustomAttributes = "";

			// ano
			$informacion_financiera->ano->LinkCustomAttributes = "";
			$informacion_financiera->ano->HrefValue = "";
			$informacion_financiera->ano->TooltipValue = "";

			// mes
			$informacion_financiera->mes->LinkCustomAttributes = "";
			$informacion_financiera->mes->HrefValue = "";
			$informacion_financiera->mes->TooltipValue = "";

			// archivo
			$informacion_financiera->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->HrefValue = ew_UploadPathEx(FALSE, $informacion_financiera->archivo->UploadPath) . ((!empty($informacion_financiera->archivo->ViewValue)) ? $informacion_financiera->archivo->ViewValue : $informacion_financiera->archivo->CurrentValue); // Add prefix/suffix
				$informacion_financiera->archivo->LinkAttrs["target"] = ""; // Add target
				if ($informacion_financiera->Export <> "") $informacion_financiera->archivo->HrefValue = ew_ConvertFullUrl($informacion_financiera->archivo->HrefValue);
			} else {
				$informacion_financiera->archivo->HrefValue = "";
			}
			$informacion_financiera->archivo->TooltipValue = "";

			// estatus
			$informacion_financiera->estatus->LinkCustomAttributes = "";
			$informacion_financiera->estatus->HrefValue = "";
			$informacion_financiera->estatus->TooltipValue = "";
		} elseif ($informacion_financiera->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// ano
			$informacion_financiera->ano->EditCustomAttributes = "";
			$informacion_financiera->ano->EditValue = ew_HtmlEncode($informacion_financiera->ano->CurrentValue);

			// mes
			$informacion_financiera->mes->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $informacion_financiera->mes->FldTagCaption(1) <> "" ? $informacion_financiera->mes->FldTagCaption(1) : "1");
			$arwrk[] = array("2", $informacion_financiera->mes->FldTagCaption(2) <> "" ? $informacion_financiera->mes->FldTagCaption(2) : "2");
			$arwrk[] = array("3", $informacion_financiera->mes->FldTagCaption(3) <> "" ? $informacion_financiera->mes->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $informacion_financiera->mes->FldTagCaption(4) <> "" ? $informacion_financiera->mes->FldTagCaption(4) : "4");
			$arwrk[] = array("5", $informacion_financiera->mes->FldTagCaption(5) <> "" ? $informacion_financiera->mes->FldTagCaption(5) : "5");
			$arwrk[] = array("6", $informacion_financiera->mes->FldTagCaption(6) <> "" ? $informacion_financiera->mes->FldTagCaption(6) : "6");
			$arwrk[] = array("7", $informacion_financiera->mes->FldTagCaption(7) <> "" ? $informacion_financiera->mes->FldTagCaption(7) : "7");
			$arwrk[] = array("8", $informacion_financiera->mes->FldTagCaption(8) <> "" ? $informacion_financiera->mes->FldTagCaption(8) : "8");
			$arwrk[] = array("9", $informacion_financiera->mes->FldTagCaption(9) <> "" ? $informacion_financiera->mes->FldTagCaption(9) : "9");
			$arwrk[] = array("10", $informacion_financiera->mes->FldTagCaption(10) <> "" ? $informacion_financiera->mes->FldTagCaption(10) : "10");
			$arwrk[] = array("11", $informacion_financiera->mes->FldTagCaption(11) <> "" ? $informacion_financiera->mes->FldTagCaption(11) : "11");
			$arwrk[] = array("12", $informacion_financiera->mes->FldTagCaption(12) <> "" ? $informacion_financiera->mes->FldTagCaption(12) : "12");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$informacion_financiera->mes->EditValue = $arwrk;

			// archivo
			$informacion_financiera->archivo->EditCustomAttributes = "";
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->EditValue = $informacion_financiera->archivo->Upload->DbValue;
			} else {
				$informacion_financiera->archivo->EditValue = "";
			}

			// estatus
			$informacion_financiera->estatus->EditCustomAttributes = "";
			$arwrk = array();
			
			
			
				IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("0", $informacion_financiera->estatus->FldTagCaption(2) <> "" ? $informacion_financiera->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $informacion_financiera->estatus->FldTagCaption(3) <> "" ? $informacion_financiera->estatus->FldTagCaption(3) : "3");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $informacion_financiera->estatus->FldTagCaption(3) <> "" ? $informacion_financiera->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $informacion_financiera->estatus->FldTagCaption(4) <> "" ? $informacion_financiera->estatus->FldTagCaption(4) : "4");
			}
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $informacion_financiera->estatus->FldTagCaption(1) <> "" ? $informacion_financiera->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $informacion_financiera->estatus->FldTagCaption(4) <> "" ? $informacion_financiera->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $informacion_financiera->estatus->FldTagCaption(1) <> "" ? $informacion_financiera->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $informacion_financiera->estatus->FldTagCaption(2) <> "" ? $informacion_financiera->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $informacion_financiera->estatus->FldTagCaption(3) <> "" ? $informacion_financiera->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $informacion_financiera->estatus->FldTagCaption(4) <> "" ? $informacion_financiera->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $informacion_financiera->estatus->FldTagCaption(1) <> "" ? $informacion_financiera->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $informacion_financiera->estatus->FldTagCaption(2) <> "" ? $informacion_financiera->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $informacion_financiera->estatus->FldTagCaption(3) <> "" ? $informacion_financiera->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $informacion_financiera->estatus->FldTagCaption(4) <> "" ? $informacion_financiera->estatus->FldTagCaption(4) : "4");
			}
			
			
			
			
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$informacion_financiera->estatus->EditValue = $arwrk;

			// Edit refer script
			// ano

			$informacion_financiera->ano->HrefValue = "";

			// mes
			$informacion_financiera->mes->HrefValue = "";

			// archivo
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->HrefValue = ew_UploadPathEx(FALSE, $informacion_financiera->archivo->UploadPath) . ((!empty($informacion_financiera->archivo->EditValue)) ? $informacion_financiera->archivo->EditValue : $informacion_financiera->archivo->CurrentValue); // Add prefix/suffix
				$informacion_financiera->archivo->LinkAttrs["target"] = ""; // Add target
				if ($informacion_financiera->Export <> "") $informacion_financiera->archivo->HrefValue = ew_ConvertFullUrl($informacion_financiera->archivo->HrefValue);
			} else {
				$informacion_financiera->archivo->HrefValue = "";
			}

			// estatus
			$informacion_financiera->estatus->HrefValue = "";
		}
		if ($informacion_financiera->RowType == EW_ROWTYPE_ADD ||
			$informacion_financiera->RowType == EW_ROWTYPE_EDIT ||
			$informacion_financiera->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$informacion_financiera->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($informacion_financiera->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$informacion_financiera->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $informacion_financiera;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($informacion_financiera->archivo->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($informacion_financiera->archivo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $informacion_financiera->archivo->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($informacion_financiera->archivo->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $informacion_financiera->archivo->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($informacion_financiera->ano->FormValue) && $informacion_financiera->ano->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $informacion_financiera->ano->FldCaption());
		}
		if (!ew_CheckInteger($informacion_financiera->ano->FormValue)) {
			ew_AddMessage($gsFormError, $informacion_financiera->ano->FldErrMsg());
		}
		if (!is_null($informacion_financiera->mes->FormValue) && $informacion_financiera->mes->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $informacion_financiera->mes->FldCaption());
		}
		if ($informacion_financiera->archivo->Upload->Action == "3" && is_null($informacion_financiera->archivo->Upload->Value)) {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $informacion_financiera->archivo->FldCaption());
		}
		if (!is_null($informacion_financiera->estatus->FormValue) && $informacion_financiera->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $informacion_financiera->estatus->FldCaption());
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
		global $conn, $Security, $Language, $informacion_financiera;
		$sFilter = $informacion_financiera->KeyFilter();
		$informacion_financiera->CurrentFilter = $sFilter;
		$sSql = $informacion_financiera->SQL();
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

			// ano
			$informacion_financiera->ano->SetDbValueDef($rsnew, $informacion_financiera->ano->CurrentValue, 0, $informacion_financiera->ano->ReadOnly);

			// mes
			$informacion_financiera->mes->SetDbValueDef($rsnew, $informacion_financiera->mes->CurrentValue, "", $informacion_financiera->mes->ReadOnly);

			// archivo
			if ($informacion_financiera->archivo->Upload->Action == "1") { // Keep
			} elseif ($informacion_financiera->archivo->Upload->Action == "2" || $informacion_financiera->archivo->Upload->Action == "3") { // Update/Remove
			$informacion_financiera->archivo->Upload->DbValue = $rs->fields('archivo'); // Get original value
			if (is_null($informacion_financiera->archivo->Upload->Value)) {
				$rsnew['archivo'] = NULL;
			} else {
				$rsnew['archivo'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $informacion_financiera->archivo->UploadPath), $informacion_financiera->archivo->Upload->FileName);
			}
			}

			// estatus
			$informacion_financiera->estatus->SetDbValueDef($rsnew, $informacion_financiera->estatus->CurrentValue, 0, $informacion_financiera->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $informacion_financiera->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($informacion_financiera->archivo->Upload->Value)) {
				$informacion_financiera->archivo->Upload->SaveToFile($informacion_financiera->archivo->UploadPath, $rsnew['archivo'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($informacion_financiera->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($informacion_financiera->CancelMessage <> "") {
					$this->setFailureMessage($informacion_financiera->CancelMessage);
					$informacion_financiera->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$informacion_financiera->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// archivo
		$informacion_financiera->archivo->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'informacion_financiera';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $informacion_financiera;
		$table = 'informacion_financiera';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_informacion_financiera'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($informacion_financiera->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($informacion_financiera->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($informacion_financiera->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($informacion_financiera->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
