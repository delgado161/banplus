<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_municipiosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_municipios_add = new cz_municipios_add();
$Page =& $z_municipios_add;

// Page init
$z_municipios_add->Page_Init();

// Page main
$z_municipios_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_municipios_add = new ew_Page("z_municipios_add");

// page properties
z_municipios_add.PageID = "add"; // page ID
z_municipios_add.FormID = "fz_municipiosadd"; // form ID
var EW_PAGE_ID = z_municipios_add.PageID; // for backward compatibility

// extend page with ValidateForm function
z_municipios_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_lp_municipio_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->lp_municipio_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->visibilidad->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lf_estado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->lf_estado->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lf_estado"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_municipios->lf_estado->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pk_municipio"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->pk_municipio->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pk_municipio"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_municipios->pk_municipio->FldErrMsg()) ?>");

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
z_municipios_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_municipios_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_municipios_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_municipios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_municipios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_municipios_add->ShowPageHeader(); ?>
<?php
$z_municipios_add->ShowMessage();
?>
<form name="fz_municipiosadd" id="fz_municipiosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_municipios_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="z_municipios">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_municipios->lp_municipio_id->Visible) { // lp_municipio_id ?>
	<tr id="r_lp_municipio_id"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->lp_municipio_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->lp_municipio_id->CellAttributes() ?>><span id="el_lp_municipio_id">
<input type="text" name="x_lp_municipio_id" id="x_lp_municipio_id" size="30" maxlength="5" value="<?php echo $z_municipios->lp_municipio_id->EditValue ?>"<?php echo $z_municipios->lp_municipio_id->EditAttributes() ?>>
</span><?php echo $z_municipios->lp_municipio_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="50" value="<?php echo $z_municipios->nombre->EditValue ?>"<?php echo $z_municipios->nombre->EditAttributes() ?>>
</span><?php echo $z_municipios->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<div id="tp_x_visibilidad" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="{value}"<?php echo $z_municipios->visibilidad->EditAttributes() ?>></label></div>
<div id="dsl_x_visibilidad" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $z_municipios->visibilidad->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($z_municipios->visibilidad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $z_municipios->visibilidad->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $z_municipios->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->lf_estado->Visible) { // lf_estado ?>
	<tr id="r_lf_estado"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->lf_estado->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->lf_estado->CellAttributes() ?>><span id="el_lf_estado">
<span id="as_x_lf_estado" style="white-space: nowrap; z-index: 8960">
	<input type="text" name="sv_x_lf_estado" id="sv_x_lf_estado" value="<?php echo $z_municipios->lf_estado->EditValue ?>" size="30"<?php echo $z_municipios->lf_estado->EditAttributes() ?>>&nbsp;<span id="em_x_lf_estado" class="ewMessage" style="display: none"><?php echo str_replace("%f", "phpimages/", $Language->Phrase("UnmatchedValue")) ?></span>
	<div id="sc_x_lf_estado" style="z-index: 8960"></div>
</span>
<input type="hidden" name="x_lf_estado" id="x_lf_estado" value="<?php echo $z_municipios->lf_estado->CurrentValue ?>">
<?php
$sSqlWrk = "SELECT `id2_estado`, `nombre` FROM `_estados`";
$sWhereWrk = "`nombre`  LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_lf_estado" id="s_x_lf_estado" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_lf_estado = new ew_AutoSuggest("sv_x_lf_estado", "sc_x_lf_estado", "s_x_lf_estado", "em_x_lf_estado", "x_lf_estado", "", false, EW_AUTO_SUGGEST_MAX_ENTRIES);
oas_x_lf_estado.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_lf_estado.ac.typeAhead = false;

//-->
</script>
</span><?php echo $z_municipios->lf_estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->pk_municipio->Visible) { // pk_municipio ?>
	<tr id="r_pk_municipio"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->pk_municipio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->pk_municipio->CellAttributes() ?>><span id="el_pk_municipio">
<input type="text" name="x_pk_municipio" id="x_pk_municipio" size="30" value="<?php echo $z_municipios->pk_municipio->EditValue ?>"<?php echo $z_municipios->pk_municipio->EditAttributes() ?>>
</span><?php echo $z_municipios->pk_municipio->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$z_municipios_add->ShowPageFooter();
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
$z_municipios_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_municipios_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = '_municipios';

	// Page object name
	var $PageObjName = 'z_municipios_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_municipios;
		if ($z_municipios->UseTokenInUrl) $PageUrl .= "t=" . $z_municipios->TableVar . "&"; // Add page token
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
		global $objForm, $z_municipios;
		if ($z_municipios->UseTokenInUrl) {
			if ($objForm)
				return ($z_municipios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_municipios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_municipios_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_municipios)
		if (!isset($GLOBALS["z_municipios"])) {
			$GLOBALS["z_municipios"] = new cz_municipios();
			$GLOBALS["Table"] =& $GLOBALS["z_municipios"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_municipios', TRUE);

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
		global $z_municipios;

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
		global $objForm, $Language, $gsFormError, $z_municipios;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$z_municipios->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_municipios->CurrentAction = "I"; // Form error, reset action
				$z_municipios->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["lp_municipio_id"] != "") {
				$z_municipios->lp_municipio_id->setQueryStringValue($_GET["lp_municipio_id"]);
				$z_municipios->setKey("lp_municipio_id", $z_municipios->lp_municipio_id->CurrentValue); // Set up key
			} else {
				$z_municipios->setKey("lp_municipio_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$z_municipios->CurrentAction = "C"; // Copy record
			} else {
				$z_municipios->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($z_municipios->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_municipioslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$z_municipios->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $z_municipios->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "z_municipiosview.php")
						$sReturnUrl = $z_municipios->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$z_municipios->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$z_municipios->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$z_municipios->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $z_municipios;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $z_municipios;
		$z_municipios->lp_municipio_id->CurrentValue = NULL;
		$z_municipios->lp_municipio_id->OldValue = $z_municipios->lp_municipio_id->CurrentValue;
		$z_municipios->nombre->CurrentValue = NULL;
		$z_municipios->nombre->OldValue = $z_municipios->nombre->CurrentValue;
		$z_municipios->visibilidad->CurrentValue = NULL;
		$z_municipios->visibilidad->OldValue = $z_municipios->visibilidad->CurrentValue;
		$z_municipios->lf_estado->CurrentValue = NULL;
		$z_municipios->lf_estado->OldValue = $z_municipios->lf_estado->CurrentValue;
		$z_municipios->pk_municipio->CurrentValue = NULL;
		$z_municipios->pk_municipio->OldValue = $z_municipios->pk_municipio->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_municipios;
		if (!$z_municipios->lp_municipio_id->FldIsDetailKey) {
			$z_municipios->lp_municipio_id->setFormValue($objForm->GetValue("x_lp_municipio_id"));
		}
		if (!$z_municipios->nombre->FldIsDetailKey) {
			$z_municipios->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$z_municipios->visibilidad->FldIsDetailKey) {
			$z_municipios->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
		if (!$z_municipios->lf_estado->FldIsDetailKey) {
			$z_municipios->lf_estado->setFormValue($objForm->GetValue("x_lf_estado"));
		}
		if (!$z_municipios->pk_municipio->FldIsDetailKey) {
			$z_municipios->pk_municipio->setFormValue($objForm->GetValue("x_pk_municipio"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $z_municipios;
		$this->LoadOldRecord();
		$z_municipios->lp_municipio_id->CurrentValue = $z_municipios->lp_municipio_id->FormValue;
		$z_municipios->nombre->CurrentValue = $z_municipios->nombre->FormValue;
		$z_municipios->visibilidad->CurrentValue = $z_municipios->visibilidad->FormValue;
		$z_municipios->lf_estado->CurrentValue = $z_municipios->lf_estado->FormValue;
		$z_municipios->pk_municipio->CurrentValue = $z_municipios->pk_municipio->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_municipios;
		$sFilter = $z_municipios->KeyFilter();

		// Call Row Selecting event
		$z_municipios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_municipios->CurrentFilter = $sFilter;
		$sSql = $z_municipios->SQL();
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
		global $conn, $z_municipios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_municipios->Row_Selected($row);
		$z_municipios->lp_municipio_id->setDbValue($rs->fields('lp_municipio_id'));
		$z_municipios->nombre->setDbValue($rs->fields('nombre'));
		$z_municipios->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_municipios->lf_estado->setDbValue($rs->fields('lf_estado'));
		$z_municipios->pk_municipio->setDbValue($rs->fields('pk_municipio'));
	}

	// Load old record
	function LoadOldRecord() {
		global $z_municipios;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($z_municipios->getKey("lp_municipio_id")) <> "")
			$z_municipios->lp_municipio_id->CurrentValue = $z_municipios->getKey("lp_municipio_id"); // lp_municipio_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$z_municipios->CurrentFilter = $z_municipios->KeyFilter();
			$sSql = $z_municipios->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_municipios;

		// Initialize URLs
		// Call Row_Rendering event

		$z_municipios->Row_Rendering();

		// Common render codes for all row types
		// lp_municipio_id
		// nombre
		// visibilidad
		// lf_estado
		// pk_municipio

		if ($z_municipios->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_municipio_id
			$z_municipios->lp_municipio_id->ViewValue = $z_municipios->lp_municipio_id->CurrentValue;
			$z_municipios->lp_municipio_id->ViewCustomAttributes = "";

			// nombre
			$z_municipios->nombre->ViewValue = $z_municipios->nombre->CurrentValue;
			$z_municipios->nombre->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_municipios->visibilidad->CurrentValue) <> "") {
				switch ($z_municipios->visibilidad->CurrentValue) {
					case "1":
						$z_municipios->visibilidad->ViewValue = $z_municipios->visibilidad->FldTagCaption(1) <> "" ? $z_municipios->visibilidad->FldTagCaption(1) : $z_municipios->visibilidad->CurrentValue;
						break;
					case "0":
						$z_municipios->visibilidad->ViewValue = $z_municipios->visibilidad->FldTagCaption(2) <> "" ? $z_municipios->visibilidad->FldTagCaption(2) : $z_municipios->visibilidad->CurrentValue;
						break;
					default:
						$z_municipios->visibilidad->ViewValue = $z_municipios->visibilidad->CurrentValue;
				}
			} else {
				$z_municipios->visibilidad->ViewValue = NULL;
			}
			$z_municipios->visibilidad->ViewCustomAttributes = "";

			// lf_estado
			$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
			if (strval($z_municipios->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_municipios->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_municipios->lf_estado->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
				}
			} else {
				$z_municipios->lf_estado->ViewValue = NULL;
			}
			$z_municipios->lf_estado->ViewCustomAttributes = "";

			// pk_municipio
			$z_municipios->pk_municipio->ViewValue = $z_municipios->pk_municipio->CurrentValue;
			$z_municipios->pk_municipio->ViewCustomAttributes = "";

			// lp_municipio_id
			$z_municipios->lp_municipio_id->LinkCustomAttributes = "";
			$z_municipios->lp_municipio_id->HrefValue = "";
			$z_municipios->lp_municipio_id->TooltipValue = "";

			// nombre
			$z_municipios->nombre->LinkCustomAttributes = "";
			$z_municipios->nombre->HrefValue = "";
			$z_municipios->nombre->TooltipValue = "";

			// visibilidad
			$z_municipios->visibilidad->LinkCustomAttributes = "";
			$z_municipios->visibilidad->HrefValue = "";
			$z_municipios->visibilidad->TooltipValue = "";

			// lf_estado
			$z_municipios->lf_estado->LinkCustomAttributes = "";
			$z_municipios->lf_estado->HrefValue = "";
			$z_municipios->lf_estado->TooltipValue = "";

			// pk_municipio
			$z_municipios->pk_municipio->LinkCustomAttributes = "";
			$z_municipios->pk_municipio->HrefValue = "";
			$z_municipios->pk_municipio->TooltipValue = "";
		} elseif ($z_municipios->RowType == EW_ROWTYPE_ADD) { // Add row

			// lp_municipio_id
			$z_municipios->lp_municipio_id->EditCustomAttributes = "";
			$z_municipios->lp_municipio_id->EditValue = ew_HtmlEncode($z_municipios->lp_municipio_id->CurrentValue);

			// nombre
			$z_municipios->nombre->EditCustomAttributes = "";
			$z_municipios->nombre->EditValue = ew_HtmlEncode($z_municipios->nombre->CurrentValue);

			// visibilidad
			$z_municipios->visibilidad->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $z_municipios->visibilidad->FldTagCaption(1) <> "" ? $z_municipios->visibilidad->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $z_municipios->visibilidad->FldTagCaption(2) <> "" ? $z_municipios->visibilidad->FldTagCaption(2) : "0");
			$z_municipios->visibilidad->EditValue = $arwrk;

			// lf_estado
			$z_municipios->lf_estado->EditCustomAttributes = "";
			$z_municipios->lf_estado->EditValue = ew_HtmlEncode($z_municipios->lf_estado->CurrentValue);
			if (strval($z_municipios->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_municipios->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_municipios->lf_estado->EditValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_municipios->lf_estado->EditValue = $z_municipios->lf_estado->CurrentValue;
				}
			} else {
				$z_municipios->lf_estado->EditValue = NULL;
			}

			// pk_municipio
			$z_municipios->pk_municipio->EditCustomAttributes = "";
			$z_municipios->pk_municipio->EditValue = ew_HtmlEncode($z_municipios->pk_municipio->CurrentValue);

			// Edit refer script
			// lp_municipio_id

			$z_municipios->lp_municipio_id->HrefValue = "";

			// nombre
			$z_municipios->nombre->HrefValue = "";

			// visibilidad
			$z_municipios->visibilidad->HrefValue = "";

			// lf_estado
			$z_municipios->lf_estado->HrefValue = "";

			// pk_municipio
			$z_municipios->pk_municipio->HrefValue = "";
		}
		if ($z_municipios->RowType == EW_ROWTYPE_ADD ||
			$z_municipios->RowType == EW_ROWTYPE_EDIT ||
			$z_municipios->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$z_municipios->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($z_municipios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_municipios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $z_municipios;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($z_municipios->lp_municipio_id->FormValue) && $z_municipios->lp_municipio_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->lp_municipio_id->FldCaption());
		}
		if (!is_null($z_municipios->nombre->FormValue) && $z_municipios->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->nombre->FldCaption());
		}
		if ($z_municipios->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->visibilidad->FldCaption());
		}
		if (!is_null($z_municipios->lf_estado->FormValue) && $z_municipios->lf_estado->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->lf_estado->FldCaption());
		}
		if (!ew_CheckInteger($z_municipios->lf_estado->FormValue)) {
			ew_AddMessage($gsFormError, $z_municipios->lf_estado->FldErrMsg());
		}
		if (!is_null($z_municipios->pk_municipio->FormValue) && $z_municipios->pk_municipio->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->pk_municipio->FldCaption());
		}
		if (!ew_CheckInteger($z_municipios->pk_municipio->FormValue)) {
			ew_AddMessage($gsFormError, $z_municipios->pk_municipio->FldErrMsg());
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
		global $conn, $Language, $Security, $z_municipios;

		// Check if key value entered
		if ($z_municipios->lp_municipio_id->CurrentValue == "" && $z_municipios->lp_municipio_id->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $z_municipios->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $z_municipios->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($z_municipios->lp_municipio_id->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(lp_municipio_id = '" . ew_AdjustSql($z_municipios->lp_municipio_id->CurrentValue) . "')";
			$rsChk = $z_municipios->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $z_municipios->lp_municipio_id->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $z_municipios->lp_municipio_id->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// lp_municipio_id
		$z_municipios->lp_municipio_id->SetDbValueDef($rsnew, $z_municipios->lp_municipio_id->CurrentValue, "", FALSE);

		// nombre
		$z_municipios->nombre->SetDbValueDef($rsnew, $z_municipios->nombre->CurrentValue, "", FALSE);

		// visibilidad
		$z_municipios->visibilidad->SetDbValueDef($rsnew, $z_municipios->visibilidad->CurrentValue, 0, FALSE);

		// lf_estado
		$z_municipios->lf_estado->SetDbValueDef($rsnew, $z_municipios->lf_estado->CurrentValue, 0, FALSE);

		// pk_municipio
		$z_municipios->pk_municipio->SetDbValueDef($rsnew, $z_municipios->pk_municipio->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $z_municipios->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($z_municipios->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($z_municipios->CancelMessage <> "") {
				$this->setFailureMessage($z_municipios->CancelMessage);
				$z_municipios->CancelMessage = "";
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
			$z_municipios->Row_Inserted($rs, $rsnew);
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
