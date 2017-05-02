<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tasas_interesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tasas_interes_edit = new ctasas_interes_edit();
$Page =& $tasas_interes_edit;

// Page init
$tasas_interes_edit->Page_Init();

// Page main
$tasas_interes_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tasas_interes_edit = new ew_Page("tasas_interes_edit");

// page properties
tasas_interes_edit.PageID = "edit"; // page ID
tasas_interes_edit.FormID = "ftasas_interesedit"; // form ID
var EW_PAGE_ID = tasas_interes_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tasas_interes_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_inicio"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tasas_interes->inicio->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fin"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tasas_interes->fin->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tasa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tasas_interes->tasa->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tipo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tasas_interes->tipo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tasas_interes->estatus->FldCaption()) ?>");

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
tasas_interes_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tasas_interes_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tasas_interes_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tasas_interes->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tasas_interes->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tasas_interes_edit->ShowPageHeader(); ?>
<?php
$tasas_interes_edit->ShowMessage();
?>
<form name="ftasas_interesedit" id="ftasas_interesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tasas_interes_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tasas_interes">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tasas_interes->inicio->Visible) { // inicio ?>
	<tr id="r_inicio"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->inicio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tasas_interes->inicio->CellAttributes() ?>><span id="el_inicio">
<input type="text" name="x_inicio" id="x_inicio" size="2" maxlength="2" value="<?php echo $tasas_interes->inicio->EditValue ?>"<?php echo $tasas_interes->inicio->EditAttributes() ?>>
</span><?php echo $tasas_interes->inicio->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tasas_interes->fin->Visible) { // fin ?>
	<tr id="r_fin"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->fin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tasas_interes->fin->CellAttributes() ?>><span id="el_fin">
<input type="text" name="x_fin" id="x_fin" size="2" maxlength="2" value="<?php echo $tasas_interes->fin->EditValue ?>"<?php echo $tasas_interes->fin->EditAttributes() ?>>
</span><?php echo $tasas_interes->fin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tasas_interes->tasa->Visible) { // tasa ?>
	<tr id="r_tasa"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->tasa->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tasas_interes->tasa->CellAttributes() ?>><span id="el_tasa">
<input type="text" name="x_tasa" id="x_tasa" size="5" maxlength="5" value="<?php echo $tasas_interes->tasa->EditValue ?>"<?php echo $tasas_interes->tasa->EditAttributes() ?>>
</span><?php echo $tasas_interes->tasa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tasas_interes->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->tipo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tasas_interes->tipo->CellAttributes() ?>><span id="el_tipo">
<select id="x_tipo" name="x_tipo"<?php echo $tasas_interes->tipo->EditAttributes() ?>>
<?php
if (is_array($tasas_interes->tipo->EditValue)) {
	$arwrk = $tasas_interes->tipo->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tasas_interes->tipo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $tasas_interes->tipo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tasas_interes->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $tasas_interes->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tasas_interes->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tasas_interes->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $tasas_interes->estatus->EditAttributes() ?>>
<?php
if (is_array($tasas_interes->estatus->EditValue)) {
	$arwrk = $tasas_interes->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tasas_interes->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $tasas_interes->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_tasas_interes" id="x_id_tasas_interes" value="<?php echo ew_HtmlEncode($tasas_interes->id_tasas_interes->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$tasas_interes_edit->ShowPageFooter();
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
$tasas_interes_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctasas_interes_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tasas_interes';

	// Page object name
	var $PageObjName = 'tasas_interes_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tasas_interes;
		if ($tasas_interes->UseTokenInUrl) $PageUrl .= "t=" . $tasas_interes->TableVar . "&"; // Add page token
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
		global $objForm, $tasas_interes;
		if ($tasas_interes->UseTokenInUrl) {
			if ($objForm)
				return ($tasas_interes->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tasas_interes->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctasas_interes_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tasas_interes)
		if (!isset($GLOBALS["tasas_interes"])) {
			$GLOBALS["tasas_interes"] = new ctasas_interes();
			$GLOBALS["Table"] =& $GLOBALS["tasas_interes"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tasas_interes', TRUE);

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
		global $tasas_interes;

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
			$this->Page_Terminate("tasas_intereslist.php");
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
		global $objForm, $Language, $gsFormError, $tasas_interes;

		// Load key from QueryString
		if (@$_GET["id_tasas_interes"] <> "")
			$tasas_interes->id_tasas_interes->setQueryStringValue($_GET["id_tasas_interes"]);
		if (@$_POST["a_edit"] <> "") {
			$tasas_interes->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tasas_interes->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$tasas_interes->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tasas_interes->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tasas_interes->id_tasas_interes->CurrentValue == "")
			$this->Page_Terminate("tasas_intereslist.php"); // Invalid key, return to list
		switch ($tasas_interes->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tasas_intereslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tasas_interes->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tasas_interes->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tasas_interes->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tasas_interes->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$tasas_interes->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tasas_interes;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tasas_interes;
		if (!$tasas_interes->inicio->FldIsDetailKey) {
			$tasas_interes->inicio->setFormValue($objForm->GetValue("x_inicio"));
		}
		if (!$tasas_interes->fin->FldIsDetailKey) {
			$tasas_interes->fin->setFormValue($objForm->GetValue("x_fin"));
		}
		if (!$tasas_interes->tasa->FldIsDetailKey) {
			$tasas_interes->tasa->setFormValue($objForm->GetValue("x_tasa"));
		}
		if (!$tasas_interes->tipo->FldIsDetailKey) {
			$tasas_interes->tipo->setFormValue($objForm->GetValue("x_tipo"));
		}
		if (!$tasas_interes->estatus->FldIsDetailKey) {
			$tasas_interes->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$tasas_interes->id_tasas_interes->FldIsDetailKey)
			$tasas_interes->id_tasas_interes->setFormValue($objForm->GetValue("x_id_tasas_interes"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tasas_interes;
		$this->LoadRow();
		$tasas_interes->id_tasas_interes->CurrentValue = $tasas_interes->id_tasas_interes->FormValue;
		$tasas_interes->inicio->CurrentValue = $tasas_interes->inicio->FormValue;
		$tasas_interes->fin->CurrentValue = $tasas_interes->fin->FormValue;
		$tasas_interes->tasa->CurrentValue = $tasas_interes->tasa->FormValue;
		$tasas_interes->tipo->CurrentValue = $tasas_interes->tipo->FormValue;
		$tasas_interes->estatus->CurrentValue = $tasas_interes->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tasas_interes;
		$sFilter = $tasas_interes->KeyFilter();

		// Call Row Selecting event
		$tasas_interes->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tasas_interes->CurrentFilter = $sFilter;
		$sSql = $tasas_interes->SQL();
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
		global $conn, $tasas_interes;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tasas_interes->Row_Selected($row);
		$tasas_interes->id_tasas_interes->setDbValue($rs->fields('id_tasas_interes'));
		$tasas_interes->inicio->setDbValue($rs->fields('inicio'));
		$tasas_interes->fin->setDbValue($rs->fields('fin'));
		$tasas_interes->tasa->setDbValue($rs->fields('tasa'));
		$tasas_interes->tipo->setDbValue($rs->fields('tipo'));
		$tasas_interes->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tasas_interes;

		// Initialize URLs
		// Call Row_Rendering event

		$tasas_interes->Row_Rendering();

		// Common render codes for all row types
		// id_tasas_interes
		// inicio
		// fin
		// tasa
		// tipo
		// estatus

		if ($tasas_interes->RowType == EW_ROWTYPE_VIEW) { // View row

			// inicio
			$tasas_interes->inicio->ViewValue = $tasas_interes->inicio->CurrentValue;
			$tasas_interes->inicio->ViewCustomAttributes = "";

			// fin
			$tasas_interes->fin->ViewValue = $tasas_interes->fin->CurrentValue;
			$tasas_interes->fin->ViewCustomAttributes = "";

			// tasa
			$tasas_interes->tasa->ViewValue = $tasas_interes->tasa->CurrentValue;
			$tasas_interes->tasa->ViewCustomAttributes = "";

			// tipo
			if (strval($tasas_interes->tipo->CurrentValue) <> "") {
				switch ($tasas_interes->tipo->CurrentValue) {
					case "1":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(1) <> "" ? $tasas_interes->tipo->FldTagCaption(1) : $tasas_interes->tipo->CurrentValue;
						break;
					case "2":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(2) <> "" ? $tasas_interes->tipo->FldTagCaption(2) : $tasas_interes->tipo->CurrentValue;
						break;
					case "3":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(3) <> "" ? $tasas_interes->tipo->FldTagCaption(3) : $tasas_interes->tipo->CurrentValue;
						break;
					default:
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->CurrentValue;
				}
			} else {
				$tasas_interes->tipo->ViewValue = NULL;
			}
			$tasas_interes->tipo->ViewCustomAttributes = "";

			// estatus
			if (strval($tasas_interes->estatus->CurrentValue) <> "") {
				switch ($tasas_interes->estatus->CurrentValue) {
					case "1":
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->FldTagCaption(1) <> "" ? $tasas_interes->estatus->FldTagCaption(1) : $tasas_interes->estatus->CurrentValue;
						break;
					case "0":
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->FldTagCaption(2) <> "" ? $tasas_interes->estatus->FldTagCaption(2) : $tasas_interes->estatus->CurrentValue;
						break;
					default:
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->CurrentValue;
				}
			} else {
				$tasas_interes->estatus->ViewValue = NULL;
			}
			$tasas_interes->estatus->ViewCustomAttributes = "";

			// inicio
			$tasas_interes->inicio->LinkCustomAttributes = "";
			$tasas_interes->inicio->HrefValue = "";
			$tasas_interes->inicio->TooltipValue = "";

			// fin
			$tasas_interes->fin->LinkCustomAttributes = "";
			$tasas_interes->fin->HrefValue = "";
			$tasas_interes->fin->TooltipValue = "";

			// tasa
			$tasas_interes->tasa->LinkCustomAttributes = "";
			$tasas_interes->tasa->HrefValue = "";
			$tasas_interes->tasa->TooltipValue = "";

			// tipo
			$tasas_interes->tipo->LinkCustomAttributes = "";
			$tasas_interes->tipo->HrefValue = "";
			$tasas_interes->tipo->TooltipValue = "";

			// estatus
			$tasas_interes->estatus->LinkCustomAttributes = "";
			$tasas_interes->estatus->HrefValue = "";
			$tasas_interes->estatus->TooltipValue = "";
		} elseif ($tasas_interes->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// inicio
			$tasas_interes->inicio->EditCustomAttributes = "";
			$tasas_interes->inicio->EditValue = ew_HtmlEncode($tasas_interes->inicio->CurrentValue);

			// fin
			$tasas_interes->fin->EditCustomAttributes = "";
			$tasas_interes->fin->EditValue = ew_HtmlEncode($tasas_interes->fin->CurrentValue);

			// tasa
			$tasas_interes->tasa->EditCustomAttributes = "";
			$tasas_interes->tasa->EditValue = ew_HtmlEncode($tasas_interes->tasa->CurrentValue);

			// tipo
			$tasas_interes->tipo->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $tasas_interes->tipo->FldTagCaption(1) <> "" ? $tasas_interes->tipo->FldTagCaption(1) : "1");
			$arwrk[] = array("2", $tasas_interes->tipo->FldTagCaption(2) <> "" ? $tasas_interes->tipo->FldTagCaption(2) : "2");
			$arwrk[] = array("3", $tasas_interes->tipo->FldTagCaption(3) <> "" ? $tasas_interes->tipo->FldTagCaption(3) : "3");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$tasas_interes->tipo->EditValue = $arwrk;

			// estatus
			$tasas_interes->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $tasas_interes->estatus->FldTagCaption(1) <> "" ? $tasas_interes->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $tasas_interes->estatus->FldTagCaption(2) <> "" ? $tasas_interes->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$tasas_interes->estatus->EditValue = $arwrk;

			// Edit refer script
			// inicio

			$tasas_interes->inicio->HrefValue = "";

			// fin
			$tasas_interes->fin->HrefValue = "";

			// tasa
			$tasas_interes->tasa->HrefValue = "";

			// tipo
			$tasas_interes->tipo->HrefValue = "";

			// estatus
			$tasas_interes->estatus->HrefValue = "";
		}
		if ($tasas_interes->RowType == EW_ROWTYPE_ADD ||
			$tasas_interes->RowType == EW_ROWTYPE_EDIT ||
			$tasas_interes->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$tasas_interes->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($tasas_interes->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tasas_interes->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tasas_interes;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tasas_interes->inicio->FormValue) && $tasas_interes->inicio->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tasas_interes->inicio->FldCaption());
		}
		if (!is_null($tasas_interes->fin->FormValue) && $tasas_interes->fin->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tasas_interes->fin->FldCaption());
		}
		if (!is_null($tasas_interes->tasa->FormValue) && $tasas_interes->tasa->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tasas_interes->tasa->FldCaption());
		}
		if (!is_null($tasas_interes->tipo->FormValue) && $tasas_interes->tipo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tasas_interes->tipo->FldCaption());
		}
		if (!is_null($tasas_interes->estatus->FormValue) && $tasas_interes->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tasas_interes->estatus->FldCaption());
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
		global $conn, $Security, $Language, $tasas_interes;
		$sFilter = $tasas_interes->KeyFilter();
		$tasas_interes->CurrentFilter = $sFilter;
		$sSql = $tasas_interes->SQL();
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

			// inicio
			$tasas_interes->inicio->SetDbValueDef($rsnew, $tasas_interes->inicio->CurrentValue, "", $tasas_interes->inicio->ReadOnly);

			// fin
			$tasas_interes->fin->SetDbValueDef($rsnew, $tasas_interes->fin->CurrentValue, "", $tasas_interes->fin->ReadOnly);

			// tasa
			$tasas_interes->tasa->SetDbValueDef($rsnew, $tasas_interes->tasa->CurrentValue, "", $tasas_interes->tasa->ReadOnly);

			// tipo
			$tasas_interes->tipo->SetDbValueDef($rsnew, $tasas_interes->tipo->CurrentValue, "", $tasas_interes->tipo->ReadOnly);

			// estatus
			$tasas_interes->estatus->SetDbValueDef($rsnew, $tasas_interes->estatus->CurrentValue, 0, $tasas_interes->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $tasas_interes->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($tasas_interes->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($tasas_interes->CancelMessage <> "") {
					$this->setFailureMessage($tasas_interes->CancelMessage);
					$tasas_interes->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tasas_interes->Row_Updated($rsold, $rsnew);
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
