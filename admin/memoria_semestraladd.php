<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memoria_semestralinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memoria_semestral_add = new cmemoria_semestral_add();
$Page =& $memoria_semestral_add;

// Page init
$memoria_semestral_add->Page_Init();

// Page main
$memoria_semestral_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var memoria_semestral_add = new ew_Page("memoria_semestral_add");

// page properties
memoria_semestral_add.PageID = "add"; // page ID
memoria_semestral_add.FormID = "fmemoria_semestraladd"; // form ID
var EW_PAGE_ID = memoria_semestral_add.PageID; // for backward compatibility

// extend page with ValidateForm function
memoria_semestral_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memoria_semestral->ano->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ano"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($memoria_semestral->ano->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_mes"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memoria_semestral->mes->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_archivo"];
		aelm = fobj.elements["a" + infix + "_archivo"];
		var chk_archivo = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_archivo && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memoria_semestral->archivo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_archivo"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memoria_semestral->estatus->FldCaption()) ?>");

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
memoria_semestral_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
memoria_semestral_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memoria_semestral_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memoria_semestral->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $memoria_semestral->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $memoria_semestral_add->ShowPageHeader(); ?>
<?php
$memoria_semestral_add->ShowMessage();
?>
<form name="fmemoria_semestraladd" id="fmemoria_semestraladd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return memoria_semestral_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="memoria_semestral">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($memoria_semestral->ano->Visible) { // ano ?>
	<tr id="r_ano"<?php echo $memoria_semestral->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memoria_semestral->ano->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $memoria_semestral->ano->CellAttributes() ?>><span id="el_ano">
<input type="text" name="x_ano" id="x_ano" size="30" value="<?php echo $memoria_semestral->ano->EditValue ?>"<?php echo $memoria_semestral->ano->EditAttributes() ?>>
</span><?php echo $memoria_semestral->ano->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($memoria_semestral->mes->Visible) { // mes ?>
	<tr id="r_mes"<?php echo $memoria_semestral->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memoria_semestral->mes->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $memoria_semestral->mes->CellAttributes() ?>><span id="el_mes">
<select id="x_mes" name="x_mes"<?php echo $memoria_semestral->mes->EditAttributes() ?>>
<?php
if (is_array($memoria_semestral->mes->EditValue)) {
	$arwrk = $memoria_semestral->mes->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($memoria_semestral->mes->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $memoria_semestral->mes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($memoria_semestral->archivo->Visible) { // archivo ?>
	<tr id="r_archivo"<?php echo $memoria_semestral->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memoria_semestral->archivo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $memoria_semestral->archivo->CellAttributes() ?>><span id="el_archivo">
<div id="old_x_archivo">
<?php if ($memoria_semestral->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($memoria_semestral->archivo->Upload->DbValue)) { ?>
<a<?php echo $memoria_semestral->archivo->LinkAttributes() ?>><?php echo $memoria_semestral->archivo->EditValue ?></a>
<?php } elseif (!in_array($memoria_semestral->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($memoria_semestral->archivo->Upload->DbValue)) { ?>
<?php echo $memoria_semestral->archivo->EditValue ?>
<?php } elseif (!in_array($memoria_semestral->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_archivo">
<?php if (!empty($memoria_semestral->archivo->Upload->DbValue)) { ?>
<label><input type="radio" name="a_archivo" id="a_archivo" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $memoria_semestral->archivo->EditAttrs["onchange"] = "this.form.a_archivo[2].checked=true;" . @$memoria_semestral->archivo->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_archivo" id="a_archivo" value="3">
<?php } ?>
<input type="file" name="x_archivo" id="x_archivo" size="30"<?php echo $memoria_semestral->archivo->EditAttributes() ?>>
</div>
</span><?php echo $memoria_semestral->archivo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($memoria_semestral->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $memoria_semestral->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memoria_semestral->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $memoria_semestral->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $memoria_semestral->estatus->EditAttributes() ?>>
<?php
if (is_array($memoria_semestral->estatus->EditValue)) {
	$arwrk = $memoria_semestral->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($memoria_semestral->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $memoria_semestral->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$memoria_semestral_add->ShowPageFooter();
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
$memoria_semestral_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemoria_semestral_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'memoria_semestral';

	// Page object name
	var $PageObjName = 'memoria_semestral_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memoria_semestral;
		if ($memoria_semestral->UseTokenInUrl) $PageUrl .= "t=" . $memoria_semestral->TableVar . "&"; // Add page token
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
		global $objForm, $memoria_semestral;
		if ($memoria_semestral->UseTokenInUrl) {
			if ($objForm)
				return ($memoria_semestral->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memoria_semestral->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemoria_semestral_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memoria_semestral)
		if (!isset($GLOBALS["memoria_semestral"])) {
			$GLOBALS["memoria_semestral"] = new cmemoria_semestral();
			$GLOBALS["Table"] =& $GLOBALS["memoria_semestral"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memoria_semestral', TRUE);

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
		global $memoria_semestral;

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
		global $objForm, $Language, $gsFormError, $memoria_semestral;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$memoria_semestral->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$memoria_semestral->CurrentAction = "I"; // Form error, reset action
				$memoria_semestral->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_memoria_semestral"] != "") {
				$memoria_semestral->id_memoria_semestral->setQueryStringValue($_GET["id_memoria_semestral"]);
				$memoria_semestral->setKey("id_memoria_semestral", $memoria_semestral->id_memoria_semestral->CurrentValue); // Set up key
			} else {
				$memoria_semestral->setKey("id_memoria_semestral", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$memoria_semestral->CurrentAction = "C"; // Copy record
			} else {
				$memoria_semestral->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($memoria_semestral->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("memoria_semestrallist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$memoria_semestral->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $memoria_semestral->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "memoria_semestralview.php")
						$sReturnUrl = $memoria_semestral->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$memoria_semestral->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$memoria_semestral->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$memoria_semestral->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $memoria_semestral;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$memoria_semestral->archivo->Upload->Index = $objForm->Index;
		$memoria_semestral->archivo->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$memoria_semestral->archivo->Upload->RestoreFromSession();
		} else {
			if ($memoria_semestral->archivo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $memoria_semestral->archivo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$memoria_semestral->archivo->Upload->SaveToSession();
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $memoria_semestral;
		$memoria_semestral->ano->CurrentValue = NULL;
		$memoria_semestral->ano->OldValue = $memoria_semestral->ano->CurrentValue;
		$memoria_semestral->mes->CurrentValue = NULL;
		$memoria_semestral->mes->OldValue = $memoria_semestral->mes->CurrentValue;
		$memoria_semestral->archivo->Upload->DbValue = NULL;
		$memoria_semestral->archivo->OldValue = $memoria_semestral->archivo->Upload->DbValue;
		$memoria_semestral->estatus->CurrentValue = NULL;
		$memoria_semestral->estatus->OldValue = $memoria_semestral->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $memoria_semestral;
		$this->GetUploadFiles(); // Get upload files
		if (!$memoria_semestral->ano->FldIsDetailKey) {
			$memoria_semestral->ano->setFormValue($objForm->GetValue("x_ano"));
		}
		if (!$memoria_semestral->mes->FldIsDetailKey) {
			$memoria_semestral->mes->setFormValue($objForm->GetValue("x_mes"));
		}
		if (!$memoria_semestral->estatus->FldIsDetailKey) {
			$memoria_semestral->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $memoria_semestral;
		$this->LoadOldRecord();
		$memoria_semestral->ano->CurrentValue = $memoria_semestral->ano->FormValue;
		$memoria_semestral->mes->CurrentValue = $memoria_semestral->mes->FormValue;
		$memoria_semestral->estatus->CurrentValue = $memoria_semestral->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memoria_semestral;
		$sFilter = $memoria_semestral->KeyFilter();

		// Call Row Selecting event
		$memoria_semestral->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memoria_semestral->CurrentFilter = $sFilter;
		$sSql = $memoria_semestral->SQL();
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
		global $conn, $memoria_semestral;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memoria_semestral->Row_Selected($row);
		$memoria_semestral->id_memoria_semestral->setDbValue($rs->fields('id_memoria_semestral'));
		$memoria_semestral->ano->setDbValue($rs->fields('ano'));
		$memoria_semestral->mes->setDbValue($rs->fields('mes'));
		$memoria_semestral->archivo->Upload->DbValue = $rs->fields('archivo');
		$memoria_semestral->estatus->setDbValue($rs->fields('estatus'));
		$memoria_semestral->memoria_s->setDbValue($rs->fields('memoria_s'));
	}

	// Load old record
	function LoadOldRecord() {
		global $memoria_semestral;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($memoria_semestral->getKey("id_memoria_semestral")) <> "")
			$memoria_semestral->id_memoria_semestral->CurrentValue = $memoria_semestral->getKey("id_memoria_semestral"); // id_memoria_semestral
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$memoria_semestral->CurrentFilter = $memoria_semestral->KeyFilter();
			$sSql = $memoria_semestral->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memoria_semestral;

		// Initialize URLs
		// Call Row_Rendering event

		$memoria_semestral->Row_Rendering();

		// Common render codes for all row types
		// id_memoria_semestral
		// ano
		// mes
		// archivo
		// estatus
		// memoria_s

		if ($memoria_semestral->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_memoria_semestral
			$memoria_semestral->id_memoria_semestral->ViewValue = $memoria_semestral->id_memoria_semestral->CurrentValue;
			$memoria_semestral->id_memoria_semestral->ViewCustomAttributes = "";

			// ano
			$memoria_semestral->ano->ViewValue = $memoria_semestral->ano->CurrentValue;
			$memoria_semestral->ano->ViewCustomAttributes = "";

			// mes
			if (strval($memoria_semestral->mes->CurrentValue) <> "") {
				switch ($memoria_semestral->mes->CurrentValue) {
					case "1":
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->FldTagCaption(1) <> "" ? $memoria_semestral->mes->FldTagCaption(1) : $memoria_semestral->mes->CurrentValue;
						break;
					case "2":
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->FldTagCaption(2) <> "" ? $memoria_semestral->mes->FldTagCaption(2) : $memoria_semestral->mes->CurrentValue;
						break;
					default:
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->CurrentValue;
				}
			} else {
				$memoria_semestral->mes->ViewValue = NULL;
			}
			$memoria_semestral->mes->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->ViewValue = $memoria_semestral->archivo->Upload->DbValue;
			} else {
				$memoria_semestral->archivo->ViewValue = "";
			}
			$memoria_semestral->archivo->ViewCustomAttributes = "";

			// estatus
			if (strval($memoria_semestral->estatus->CurrentValue) <> "") {
				switch ($memoria_semestral->estatus->CurrentValue) {
					case "1":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(1) <> "" ? $memoria_semestral->estatus->FldTagCaption(1) : $memoria_semestral->estatus->CurrentValue;
						break;
					case "0":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(2) <> "" ? $memoria_semestral->estatus->FldTagCaption(2) : $memoria_semestral->estatus->CurrentValue;
						break;
					case "3":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(3) <> "" ? $memoria_semestral->estatus->FldTagCaption(3) : $memoria_semestral->estatus->CurrentValue;
						break;
					case "4":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(4) <> "" ? $memoria_semestral->estatus->FldTagCaption(4) : $memoria_semestral->estatus->CurrentValue;
						break;
					default:
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->CurrentValue;
				}
			} else {
				$memoria_semestral->estatus->ViewValue = NULL;
			}
			$memoria_semestral->estatus->ViewCustomAttributes = "";

			// ano
			$memoria_semestral->ano->LinkCustomAttributes = "";
			$memoria_semestral->ano->HrefValue = "";
			$memoria_semestral->ano->TooltipValue = "";

			// mes
			$memoria_semestral->mes->LinkCustomAttributes = "";
			$memoria_semestral->mes->HrefValue = "";
			$memoria_semestral->mes->TooltipValue = "";

			// archivo
			$memoria_semestral->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->HrefValue = ew_UploadPathEx(FALSE, $memoria_semestral->archivo->UploadPath) . ((!empty($memoria_semestral->archivo->ViewValue)) ? $memoria_semestral->archivo->ViewValue : $memoria_semestral->archivo->CurrentValue); // Add prefix/suffix
				$memoria_semestral->archivo->LinkAttrs["target"] = ""; // Add target
				if ($memoria_semestral->Export <> "") $memoria_semestral->archivo->HrefValue = ew_ConvertFullUrl($memoria_semestral->archivo->HrefValue);
			} else {
				$memoria_semestral->archivo->HrefValue = "";
			}
			$memoria_semestral->archivo->TooltipValue = "";

			// estatus
			$memoria_semestral->estatus->LinkCustomAttributes = "";
			$memoria_semestral->estatus->HrefValue = "";
			$memoria_semestral->estatus->TooltipValue = "";
		} elseif ($memoria_semestral->RowType == EW_ROWTYPE_ADD) { // Add row

			// ano
			$memoria_semestral->ano->EditCustomAttributes = "";
			$memoria_semestral->ano->EditValue = ew_HtmlEncode($memoria_semestral->ano->CurrentValue);

			// mes
			$memoria_semestral->mes->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $memoria_semestral->mes->FldTagCaption(1) <> "" ? $memoria_semestral->mes->FldTagCaption(1) : "1");
			$arwrk[] = array("2", $memoria_semestral->mes->FldTagCaption(2) <> "" ? $memoria_semestral->mes->FldTagCaption(2) : "2");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$memoria_semestral->mes->EditValue = $arwrk;

			// archivo
			$memoria_semestral->archivo->EditCustomAttributes = "";
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->EditValue = $memoria_semestral->archivo->Upload->DbValue;
			} else {
				$memoria_semestral->archivo->EditValue = "";
			}

			// estatus
			$memoria_semestral->estatus->EditCustomAttributes = "";
			$arwrk = array();
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("0", $memoria_semestral->estatus->FldTagCaption(2) <> "" ? $memoria_semestral->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $memoria_semestral->estatus->FldTagCaption(3) <> "" ? $memoria_semestral->estatus->FldTagCaption(3) : "3");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $memoria_semestral->estatus->FldTagCaption(3) <> "" ? $memoria_semestral->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $memoria_semestral->estatus->FldTagCaption(4) <> "" ? $memoria_semestral->estatus->FldTagCaption(4) : "4");
			}
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $memoria_semestral->estatus->FldTagCaption(1) <> "" ? $memoria_semestral->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $memoria_semestral->estatus->FldTagCaption(4) <> "" ? $memoria_semestral->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $memoria_semestral->estatus->FldTagCaption(1) <> "" ? $memoria_semestral->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $memoria_semestral->estatus->FldTagCaption(2) <> "" ? $memoria_semestral->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $memoria_semestral->estatus->FldTagCaption(3) <> "" ? $memoria_semestral->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $memoria_semestral->estatus->FldTagCaption(4) <> "" ? $memoria_semestral->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $memoria_semestral->estatus->FldTagCaption(1) <> "" ? $memoria_semestral->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $memoria_semestral->estatus->FldTagCaption(2) <> "" ? $memoria_semestral->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $memoria_semestral->estatus->FldTagCaption(3) <> "" ? $memoria_semestral->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $memoria_semestral->estatus->FldTagCaption(4) <> "" ? $memoria_semestral->estatus->FldTagCaption(4) : "4");
			}
			
			
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$memoria_semestral->estatus->EditValue = $arwrk;

			// Edit refer script
			// ano

			$memoria_semestral->ano->HrefValue = "";

			// mes
			$memoria_semestral->mes->HrefValue = "";

			// archivo
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->HrefValue = ew_UploadPathEx(FALSE, $memoria_semestral->archivo->UploadPath) . ((!empty($memoria_semestral->archivo->EditValue)) ? $memoria_semestral->archivo->EditValue : $memoria_semestral->archivo->CurrentValue); // Add prefix/suffix
				$memoria_semestral->archivo->LinkAttrs["target"] = ""; // Add target
				if ($memoria_semestral->Export <> "") $memoria_semestral->archivo->HrefValue = ew_ConvertFullUrl($memoria_semestral->archivo->HrefValue);
			} else {
				$memoria_semestral->archivo->HrefValue = "";
			}

			// estatus
			$memoria_semestral->estatus->HrefValue = "";
		}
		if ($memoria_semestral->RowType == EW_ROWTYPE_ADD ||
			$memoria_semestral->RowType == EW_ROWTYPE_EDIT ||
			$memoria_semestral->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$memoria_semestral->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($memoria_semestral->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memoria_semestral->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $memoria_semestral;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($memoria_semestral->archivo->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($memoria_semestral->archivo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $memoria_semestral->archivo->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($memoria_semestral->archivo->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $memoria_semestral->archivo->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($memoria_semestral->ano->FormValue) && $memoria_semestral->ano->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memoria_semestral->ano->FldCaption());
		}
		if (!ew_CheckInteger($memoria_semestral->ano->FormValue)) {
			ew_AddMessage($gsFormError, $memoria_semestral->ano->FldErrMsg());
		}
		if (!is_null($memoria_semestral->mes->FormValue) && $memoria_semestral->mes->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memoria_semestral->mes->FldCaption());
		}
		if ($memoria_semestral->archivo->Upload->Action == "3" && is_null($memoria_semestral->archivo->Upload->Value)) {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memoria_semestral->archivo->FldCaption());
		}
		if (!is_null($memoria_semestral->estatus->FormValue) && $memoria_semestral->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memoria_semestral->estatus->FldCaption());
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
		global $conn, $Language, $Security, $memoria_semestral;
		$rsnew = array();

		// ano
		$memoria_semestral->ano->SetDbValueDef($rsnew, $memoria_semestral->ano->CurrentValue, 0, FALSE);

		// mes
		$memoria_semestral->mes->SetDbValueDef($rsnew, $memoria_semestral->mes->CurrentValue, "", FALSE);

		// archivo
		if ($memoria_semestral->archivo->Upload->Action == "1") { // Keep
			if ($rsold) {
				$rsnew['archivo'] = $rsold->fields['archivo'];
			}
		} elseif ($memoria_semestral->archivo->Upload->Action == "2" || $memoria_semestral->archivo->Upload->Action == "3") { // Update/Remove
		if (is_null($memoria_semestral->archivo->Upload->Value)) {
			$rsnew['archivo'] = NULL;
		} else {
			$rsnew['archivo'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $memoria_semestral->archivo->UploadPath), $memoria_semestral->archivo->Upload->FileName);
		}
		}

		// estatus
		$memoria_semestral->estatus->SetDbValueDef($rsnew, $memoria_semestral->estatus->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $memoria_semestral->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($memoria_semestral->archivo->Upload->Value)) {
				$memoria_semestral->archivo->Upload->SaveToFile($memoria_semestral->archivo->UploadPath, $rsnew['archivo'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($memoria_semestral->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($memoria_semestral->CancelMessage <> "") {
				$this->setFailureMessage($memoria_semestral->CancelMessage);
				$memoria_semestral->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$memoria_semestral->id_memoria_semestral->setDbValue($conn->Insert_ID());
			$rsnew['id_memoria_semestral'] = $memoria_semestral->id_memoria_semestral->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$memoria_semestral->Row_Inserted($rs, $rsnew);
		}

		// archivo
		$memoria_semestral->archivo->Upload->RemoveFromSession(); // Remove file value from Session
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
