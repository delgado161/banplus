<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "calendarioinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$calendario_add = new ccalendario_add();
$Page =& $calendario_add;

// Page init
$calendario_add->Page_Init();

// Page main
$calendario_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var calendario_add = new ew_Page("calendario_add");

// page properties
calendario_add.PageID = "add"; // page ID
calendario_add.FormID = "fcalendarioadd"; // form ID
var EW_PAGE_ID = calendario_add.PageID; // for backward compatibility

// extend page with ValidateForm function
calendario_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_tipo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($calendario->tipo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($calendario->fecha->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($calendario->fecha->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_descripcion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($calendario->descripcion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($calendario->estatus->FldCaption()) ?>");

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
calendario_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
calendario_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
calendario_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $calendario->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $calendario->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $calendario_add->ShowPageHeader(); ?>
<?php
$calendario_add->ShowMessage();
?>
<form name="fcalendarioadd" id="fcalendarioadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return calendario_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="calendario">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($calendario->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $calendario->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calendario->tipo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $calendario->tipo->CellAttributes() ?>><span id="el_tipo">
<div id="tp_x_tipo" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x_tipo[]" id="x_tipo[]" value="{value}"<?php echo $calendario->tipo->EditAttributes() ?>></div>
<div id="dsl_x_tipo" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $calendario->tipo->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($calendario->tipo->CurrentValue));
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		$cnt = count($armultiwrk);
		for ($ari = 0; $ari < $cnt; $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " checked=\"checked\"";
				if ($selwrk <> "") $emptywrk = FALSE;
				break;
			}
		}

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="checkbox" name="x_tipo[]" id="x_tipo[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $calendario->tipo->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $calendario->tipo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($calendario->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $calendario->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calendario->fecha->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $calendario->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha" size="12" value="<?php echo $calendario->fecha->EditValue ?>"<?php echo $calendario->fecha->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_fecha" name="cal_x_fecha" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_fecha", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_fecha" // button id
});
</script>
</span><?php echo $calendario->fecha->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($calendario->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion"<?php echo $calendario->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calendario->descripcion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $calendario->descripcion->CellAttributes() ?>><span id="el_descripcion">
<input type="text" name="x_descripcion" id="x_descripcion" size="70" maxlength="70" value="<?php echo $calendario->descripcion->EditValue ?>"<?php echo $calendario->descripcion->EditAttributes() ?>>
</span><?php echo $calendario->descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($calendario->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $calendario->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $calendario->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $calendario->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $calendario->estatus->EditAttributes() ?>>
<?php
if (is_array($calendario->estatus->EditValue)) {
	$arwrk = $calendario->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($calendario->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $calendario->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$calendario_add->ShowPageFooter();
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
$calendario_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccalendario_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'calendario';

	// Page object name
	var $PageObjName = 'calendario_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $calendario;
		if ($calendario->UseTokenInUrl) $PageUrl .= "t=" . $calendario->TableVar . "&"; // Add page token
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
		global $objForm, $calendario;
		if ($calendario->UseTokenInUrl) {
			if ($objForm)
				return ($calendario->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($calendario->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccalendario_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (calendario)
		if (!isset($GLOBALS["calendario"])) {
			$GLOBALS["calendario"] = new ccalendario();
			$GLOBALS["Table"] =& $GLOBALS["calendario"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'calendario', TRUE);

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
		global $calendario;

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("calendariolist.php");
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $calendario;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$calendario->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$calendario->CurrentAction = "I"; // Form error, reset action
				$calendario->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_calendario"] != "") {
				$calendario->id_calendario->setQueryStringValue($_GET["id_calendario"]);
				$calendario->setKey("id_calendario", $calendario->id_calendario->CurrentValue); // Set up key
			} else {
				$calendario->setKey("id_calendario", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$calendario->CurrentAction = "C"; // Copy record
			} else {
				$calendario->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($calendario->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("calendariolist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$calendario->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $calendario->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "calendarioview.php")
						$sReturnUrl = $calendario->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$calendario->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$calendario->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$calendario->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $calendario;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $calendario;
		$calendario->tipo->CurrentValue = NULL;
		$calendario->tipo->OldValue = $calendario->tipo->CurrentValue;
		$calendario->fecha->CurrentValue = NULL;
		$calendario->fecha->OldValue = $calendario->fecha->CurrentValue;
		$calendario->descripcion->CurrentValue = NULL;
		$calendario->descripcion->OldValue = $calendario->descripcion->CurrentValue;
		$calendario->estatus->CurrentValue = NULL;
		$calendario->estatus->OldValue = $calendario->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $calendario;
		if (!$calendario->tipo->FldIsDetailKey) {
			$calendario->tipo->setFormValue($objForm->GetValue("x_tipo"));
		}
		if (!$calendario->fecha->FldIsDetailKey) {
			$calendario->fecha->setFormValue($objForm->GetValue("x_fecha"));
			$calendario->fecha->CurrentValue = ew_UnFormatDateTime($calendario->fecha->CurrentValue, 7);
		}
		if (!$calendario->descripcion->FldIsDetailKey) {
			$calendario->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		}
		if (!$calendario->estatus->FldIsDetailKey) {
			$calendario->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $calendario;
		$this->LoadOldRecord();
		$calendario->tipo->CurrentValue = $calendario->tipo->FormValue;
		$calendario->fecha->CurrentValue = $calendario->fecha->FormValue;
		$calendario->fecha->CurrentValue = ew_UnFormatDateTime($calendario->fecha->CurrentValue, 7);
		$calendario->descripcion->CurrentValue = $calendario->descripcion->FormValue;
		$calendario->estatus->CurrentValue = $calendario->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $calendario;
		$sFilter = $calendario->KeyFilter();

		// Call Row Selecting event
		$calendario->Row_Selecting($sFilter);

		// Load SQL based on filter
		$calendario->CurrentFilter = $sFilter;
		$sSql = $calendario->SQL();
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
		global $conn, $calendario;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$calendario->Row_Selected($row);
		$calendario->id_calendario->setDbValue($rs->fields('id_calendario'));
		$calendario->tipo->setDbValue($rs->fields('tipo'));
		$calendario->fecha->setDbValue($rs->fields('fecha'));
		$calendario->descripcion->setDbValue($rs->fields('descripcion'));
		$calendario->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $calendario;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($calendario->getKey("id_calendario")) <> "")
			$calendario->id_calendario->CurrentValue = $calendario->getKey("id_calendario"); // id_calendario
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$calendario->CurrentFilter = $calendario->KeyFilter();
			$sSql = $calendario->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $calendario;

		// Initialize URLs
		// Call Row_Rendering event

		$calendario->Row_Rendering();

		// Common render codes for all row types
		// id_calendario
		// tipo
		// fecha
		// descripcion
		// estatus

		if ($calendario->RowType == EW_ROWTYPE_VIEW) { // View row

			// tipo
			if (strval($calendario->tipo->CurrentValue) <> "") {
				$calendario->tipo->ViewValue = "";
				$arwrk = explode(",", strval($calendario->tipo->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++) {
					switch (trim($arwrk[$ari])) {
						case "1":
							$calendario->tipo->ViewValue .= $calendario->tipo->FldTagCaption(1) <> "" ? $calendario->tipo->FldTagCaption(1) : trim($arwrk[$ari]);
							break;
						case "2":
							$calendario->tipo->ViewValue .= $calendario->tipo->FldTagCaption(2) <> "" ? $calendario->tipo->FldTagCaption(2) : trim($arwrk[$ari]);
							break;
						default:
							$calendario->tipo->ViewValue .= trim($arwrk[$ari]);
					}
					if ($ari < $cnt-1) $calendario->tipo->ViewValue .= ew_ViewOptionSeparator($ari);
				}
			} else {
				$calendario->tipo->ViewValue = NULL;
			}
			$calendario->tipo->ViewCustomAttributes = "";

			// fecha
			$calendario->fecha->ViewValue = $calendario->fecha->CurrentValue;
			$calendario->fecha->ViewValue = ew_FormatDateTime($calendario->fecha->ViewValue, 7);
			$calendario->fecha->ViewCustomAttributes = "";

			// descripcion
			$calendario->descripcion->ViewValue = $calendario->descripcion->CurrentValue;
			$calendario->descripcion->ViewCustomAttributes = "";

			// estatus
			if (strval($calendario->estatus->CurrentValue) <> "") {
				switch ($calendario->estatus->CurrentValue) {
					case "1":
						$calendario->estatus->ViewValue = $calendario->estatus->FldTagCaption(1) <> "" ? $calendario->estatus->FldTagCaption(1) : $calendario->estatus->CurrentValue;
						break;
					case "0":
						$calendario->estatus->ViewValue = $calendario->estatus->FldTagCaption(2) <> "" ? $calendario->estatus->FldTagCaption(2) : $calendario->estatus->CurrentValue;
						break;
					default:
						$calendario->estatus->ViewValue = $calendario->estatus->CurrentValue;
				}
			} else {
				$calendario->estatus->ViewValue = NULL;
			}
			$calendario->estatus->ViewCustomAttributes = "";

			// tipo
			$calendario->tipo->LinkCustomAttributes = "";
			$calendario->tipo->HrefValue = "";
			$calendario->tipo->TooltipValue = "";

			// fecha
			$calendario->fecha->LinkCustomAttributes = "";
			$calendario->fecha->HrefValue = "";
			$calendario->fecha->TooltipValue = "";

			// descripcion
			$calendario->descripcion->LinkCustomAttributes = "";
			$calendario->descripcion->HrefValue = "";
			$calendario->descripcion->TooltipValue = "";

			// estatus
			$calendario->estatus->LinkCustomAttributes = "";
			$calendario->estatus->HrefValue = "";
			$calendario->estatus->TooltipValue = "";
		} elseif ($calendario->RowType == EW_ROWTYPE_ADD) { // Add row

			// tipo
			$calendario->tipo->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $calendario->tipo->FldTagCaption(1) <> "" ? $calendario->tipo->FldTagCaption(1) : "1");
			$arwrk[] = array("2", $calendario->tipo->FldTagCaption(2) <> "" ? $calendario->tipo->FldTagCaption(2) : "2");
			$calendario->tipo->EditValue = $arwrk;

			// fecha
			$calendario->fecha->EditCustomAttributes = "";
			$calendario->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($calendario->fecha->CurrentValue, 7));

			// descripcion
			$calendario->descripcion->EditCustomAttributes = "";
			$calendario->descripcion->EditValue = ew_HtmlEncode($calendario->descripcion->CurrentValue);

			// estatus
			$calendario->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $calendario->estatus->FldTagCaption(1) <> "" ? $calendario->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $calendario->estatus->FldTagCaption(2) <> "" ? $calendario->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$calendario->estatus->EditValue = $arwrk;

			// Edit refer script
			// tipo

			$calendario->tipo->HrefValue = "";

			// fecha
			$calendario->fecha->HrefValue = "";

			// descripcion
			$calendario->descripcion->HrefValue = "";

			// estatus
			$calendario->estatus->HrefValue = "";
		}
		if ($calendario->RowType == EW_ROWTYPE_ADD ||
			$calendario->RowType == EW_ROWTYPE_EDIT ||
			$calendario->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$calendario->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($calendario->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$calendario->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $calendario;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($calendario->tipo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $calendario->tipo->FldCaption());
		}
		if (!is_null($calendario->fecha->FormValue) && $calendario->fecha->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $calendario->fecha->FldCaption());
		}
		if (!ew_CheckEuroDate($calendario->fecha->FormValue)) {
			ew_AddMessage($gsFormError, $calendario->fecha->FldErrMsg());
		}
		if (!is_null($calendario->descripcion->FormValue) && $calendario->descripcion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $calendario->descripcion->FldCaption());
		}
		if (!is_null($calendario->estatus->FormValue) && $calendario->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $calendario->estatus->FldCaption());
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
		global $conn, $Language, $Security, $calendario;
		$rsnew = array();

		// tipo
		$calendario->tipo->SetDbValueDef($rsnew, $calendario->tipo->CurrentValue, NULL, FALSE);

		// fecha
		$calendario->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($calendario->fecha->CurrentValue, 7), NULL, FALSE);

		// descripcion
		$calendario->descripcion->SetDbValueDef($rsnew, $calendario->descripcion->CurrentValue, NULL, FALSE);

		// estatus
		$calendario->estatus->SetDbValueDef($rsnew, $calendario->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $calendario->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($calendario->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($calendario->CancelMessage <> "") {
				$this->setFailureMessage($calendario->CancelMessage);
				$calendario->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$calendario->id_calendario->setDbValue($conn->Insert_ID());
			$rsnew['id_calendario'] = $calendario->id_calendario->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$calendario->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'calendario';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $calendario;
		$table = 'calendario';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_calendario'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($calendario->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($calendario->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($calendario->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
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
