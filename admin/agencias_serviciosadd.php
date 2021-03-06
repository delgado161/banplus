<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "agencias_serviciosinfo.php" ?>
<?php include_once "agenciasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$agencias_servicios_add = new cagencias_servicios_add();
$Page =& $agencias_servicios_add;

// Page init
$agencias_servicios_add->Page_Init();

// Page main
$agencias_servicios_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var agencias_servicios_add = new ew_Page("agencias_servicios_add");

// page properties
agencias_servicios_add.PageID = "add"; // page ID
agencias_servicios_add.FormID = "fagencias_serviciosadd"; // form ID
var EW_PAGE_ID = agencias_servicios_add.PageID; // for backward compatibility

// extend page with ValidateForm function
agencias_servicios_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_id_agencias"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($agencias_servicios->id_agencias->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_servicio"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($agencias_servicios->id_servicio->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($agencias_servicios->estatus->FldCaption()) ?>");

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
agencias_servicios_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
agencias_servicios_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
agencias_servicios_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $agencias_servicios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $agencias_servicios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $agencias_servicios_add->ShowPageHeader(); ?>
<?php
$agencias_servicios_add->ShowMessage();
?>
<form name="fagencias_serviciosadd" id="fagencias_serviciosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return agencias_servicios_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="agencias_servicios">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($agencias_servicios->id_agencias->Visible) { // id_agencias ?>
	<tr id="r_id_agencias"<?php echo $agencias_servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias_servicios->id_agencias->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $agencias_servicios->id_agencias->CellAttributes() ?>><span id="el_id_agencias">
<?php if ($agencias_servicios->id_agencias->getSessionValue() <> "") { ?>
<div<?php echo $agencias_servicios->id_agencias->ViewAttributes() ?>><?php echo $agencias_servicios->id_agencias->ViewValue ?></div>
<input type="hidden" id="x_id_agencias" name="x_id_agencias" value="<?php echo ew_HtmlEncode($agencias_servicios->id_agencias->CurrentValue) ?>">
<?php } else { ?>
<select id="x_id_agencias" name="x_id_agencias"<?php echo $agencias_servicios->id_agencias->EditAttributes() ?>>
<?php
if (is_array($agencias_servicios->id_agencias->EditValue)) {
	$arwrk = $agencias_servicios->id_agencias->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias_servicios->id_agencias->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$agencias_servicios->id_agencias) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $agencias_servicios->id_agencias->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias_servicios->id_servicio->Visible) { // id_servicio ?>
	<tr id="r_id_servicio"<?php echo $agencias_servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias_servicios->id_servicio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $agencias_servicios->id_servicio->CellAttributes() ?>><span id="el_id_servicio">
<select id="x_id_servicio" name="x_id_servicio"<?php echo $agencias_servicios->id_servicio->EditAttributes() ?>>
<?php
if (is_array($agencias_servicios->id_servicio->EditValue)) {
	$arwrk = $agencias_servicios->id_servicio->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias_servicios->id_servicio->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $agencias_servicios->id_servicio->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($agencias_servicios->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $agencias_servicios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $agencias_servicios->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $agencias_servicios->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $agencias_servicios->estatus->EditAttributes() ?>>
<?php
if (is_array($agencias_servicios->estatus->EditValue)) {
	$arwrk = $agencias_servicios->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($agencias_servicios->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $agencias_servicios->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$agencias_servicios_add->ShowPageFooter();
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
$agencias_servicios_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cagencias_servicios_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'agencias_servicios';

	// Page object name
	var $PageObjName = 'agencias_servicios_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $agencias_servicios;
		if ($agencias_servicios->UseTokenInUrl) $PageUrl .= "t=" . $agencias_servicios->TableVar . "&"; // Add page token
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
		global $objForm, $agencias_servicios;
		if ($agencias_servicios->UseTokenInUrl) {
			if ($objForm)
				return ($agencias_servicios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($agencias_servicios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cagencias_servicios_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (agencias_servicios)
		if (!isset($GLOBALS["agencias_servicios"])) {
			$GLOBALS["agencias_servicios"] = new cagencias_servicios();
			$GLOBALS["Table"] =& $GLOBALS["agencias_servicios"];
		}

		// Table object (agencias)
		if (!isset($GLOBALS['agencias'])) $GLOBALS['agencias'] = new cagencias();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'agencias_servicios', TRUE);

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
		global $agencias_servicios;

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
			$this->Page_Terminate("agencias_servicioslist.php");
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
		global $objForm, $Language, $gsFormError, $agencias_servicios;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$agencias_servicios->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$agencias_servicios->CurrentAction = "I"; // Form error, reset action
				$agencias_servicios->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_agencias_servicios"] != "") {
				$agencias_servicios->id_agencias_servicios->setQueryStringValue($_GET["id_agencias_servicios"]);
				$agencias_servicios->setKey("id_agencias_servicios", $agencias_servicios->id_agencias_servicios->CurrentValue); // Set up key
			} else {
				$agencias_servicios->setKey("id_agencias_servicios", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$agencias_servicios->CurrentAction = "C"; // Copy record
			} else {
				$agencias_servicios->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($agencias_servicios->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("agencias_servicioslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$agencias_servicios->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $agencias_servicios->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "agencias_serviciosview.php")
						$sReturnUrl = $agencias_servicios->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$agencias_servicios->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$agencias_servicios->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$agencias_servicios->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $agencias_servicios;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $agencias_servicios;
		$agencias_servicios->id_agencias->CurrentValue = NULL;
		$agencias_servicios->id_agencias->OldValue = $agencias_servicios->id_agencias->CurrentValue;
		$agencias_servicios->id_servicio->CurrentValue = NULL;
		$agencias_servicios->id_servicio->OldValue = $agencias_servicios->id_servicio->CurrentValue;
		$agencias_servicios->estatus->CurrentValue = NULL;
		$agencias_servicios->estatus->OldValue = $agencias_servicios->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $agencias_servicios;
		if (!$agencias_servicios->id_agencias->FldIsDetailKey) {
			$agencias_servicios->id_agencias->setFormValue($objForm->GetValue("x_id_agencias"));
		}
		if (!$agencias_servicios->id_servicio->FldIsDetailKey) {
			$agencias_servicios->id_servicio->setFormValue($objForm->GetValue("x_id_servicio"));
		}
		if (!$agencias_servicios->estatus->FldIsDetailKey) {
			$agencias_servicios->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $agencias_servicios;
		$this->LoadOldRecord();
		$agencias_servicios->id_agencias->CurrentValue = $agencias_servicios->id_agencias->FormValue;
		$agencias_servicios->id_servicio->CurrentValue = $agencias_servicios->id_servicio->FormValue;
		$agencias_servicios->estatus->CurrentValue = $agencias_servicios->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $agencias_servicios;
		$sFilter = $agencias_servicios->KeyFilter();

		// Call Row Selecting event
		$agencias_servicios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$agencias_servicios->CurrentFilter = $sFilter;
		$sSql = $agencias_servicios->SQL();
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
		global $conn, $agencias_servicios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$agencias_servicios->Row_Selected($row);
		$agencias_servicios->id_agencias_servicios->setDbValue($rs->fields('id_agencias_servicios'));
		$agencias_servicios->id_agencias->setDbValue($rs->fields('id_agencias'));
		$agencias_servicios->id_servicio->setDbValue($rs->fields('id_servicio'));
		$agencias_servicios->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $agencias_servicios;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($agencias_servicios->getKey("id_agencias_servicios")) <> "")
			$agencias_servicios->id_agencias_servicios->CurrentValue = $agencias_servicios->getKey("id_agencias_servicios"); // id_agencias_servicios
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$agencias_servicios->CurrentFilter = $agencias_servicios->KeyFilter();
			$sSql = $agencias_servicios->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $agencias_servicios;

		// Initialize URLs
		// Call Row_Rendering event

		$agencias_servicios->Row_Rendering();

		// Common render codes for all row types
		// id_agencias_servicios
		// id_agencias
		// id_servicio
		// estatus

		if ($agencias_servicios->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_agencias
			if (strval($agencias_servicios->id_agencias->CurrentValue) <> "") {
				$sFilterWrk = "`id_agencias` = " . ew_AdjustSql($agencias_servicios->id_agencias->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre`, `direccion` FROM `agencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias_servicios->id_agencias->ViewValue = $rswrk->fields('nombre');
					$agencias_servicios->id_agencias->ViewValue .= ew_ValueSeparator(0,1,$agencias_servicios->id_agencias) . $rswrk->fields('direccion');
					$rswrk->Close();
				} else {
					$agencias_servicios->id_agencias->ViewValue = $agencias_servicios->id_agencias->CurrentValue;
				}
			} else {
				$agencias_servicios->id_agencias->ViewValue = NULL;
			}
			$agencias_servicios->id_agencias->ViewCustomAttributes = "";

			// id_servicio
			if (strval($agencias_servicios->id_servicio->CurrentValue) <> "") {
				$sFilterWrk = "`id_servicios` = " . ew_AdjustSql($agencias_servicios->id_servicio->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `servicios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias_servicios->id_servicio->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$agencias_servicios->id_servicio->ViewValue = $agencias_servicios->id_servicio->CurrentValue;
				}
			} else {
				$agencias_servicios->id_servicio->ViewValue = NULL;
			}
			$agencias_servicios->id_servicio->ViewCustomAttributes = "";

			// estatus
			if (strval($agencias_servicios->estatus->CurrentValue) <> "") {
				switch ($agencias_servicios->estatus->CurrentValue) {
					case "1":
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->FldTagCaption(1) <> "" ? $agencias_servicios->estatus->FldTagCaption(1) : $agencias_servicios->estatus->CurrentValue;
						break;
					case "0":
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->FldTagCaption(2) <> "" ? $agencias_servicios->estatus->FldTagCaption(2) : $agencias_servicios->estatus->CurrentValue;
						break;
					default:
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->CurrentValue;
				}
			} else {
				$agencias_servicios->estatus->ViewValue = NULL;
			}
			$agencias_servicios->estatus->ViewCustomAttributes = "";

			// id_agencias
			$agencias_servicios->id_agencias->LinkCustomAttributes = "";
			$agencias_servicios->id_agencias->HrefValue = "";
			$agencias_servicios->id_agencias->TooltipValue = "";

			// id_servicio
			$agencias_servicios->id_servicio->LinkCustomAttributes = "";
			$agencias_servicios->id_servicio->HrefValue = "";
			$agencias_servicios->id_servicio->TooltipValue = "";

			// estatus
			$agencias_servicios->estatus->LinkCustomAttributes = "";
			$agencias_servicios->estatus->HrefValue = "";
			$agencias_servicios->estatus->TooltipValue = "";
		} elseif ($agencias_servicios->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_agencias
			$agencias_servicios->id_agencias->EditCustomAttributes = "";
			if ($agencias_servicios->id_agencias->getSessionValue() <> "") {
				$agencias_servicios->id_agencias->CurrentValue = $agencias_servicios->id_agencias->getSessionValue();
			if (strval($agencias_servicios->id_agencias->CurrentValue) <> "") {
				$sFilterWrk = "`id_agencias` = " . ew_AdjustSql($agencias_servicios->id_agencias->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre`, `direccion` FROM `agencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias_servicios->id_agencias->ViewValue = $rswrk->fields('nombre');
					$agencias_servicios->id_agencias->ViewValue .= ew_ValueSeparator(0,1,$agencias_servicios->id_agencias) . $rswrk->fields('direccion');
					$rswrk->Close();
				} else {
					$agencias_servicios->id_agencias->ViewValue = $agencias_servicios->id_agencias->CurrentValue;
				}
			} else {
				$agencias_servicios->id_agencias->ViewValue = NULL;
			}
			$agencias_servicios->id_agencias->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_agencias`, `nombre` AS `DispFld`, `direccion` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `agencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$agencias_servicios->id_agencias->EditValue = $arwrk;
			}

			// id_servicio
			$agencias_servicios->id_servicio->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_servicios`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `servicios`";
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
			$agencias_servicios->id_servicio->EditValue = $arwrk;

			// estatus
			$agencias_servicios->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $agencias_servicios->estatus->FldTagCaption(1) <> "" ? $agencias_servicios->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $agencias_servicios->estatus->FldTagCaption(2) <> "" ? $agencias_servicios->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$agencias_servicios->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_agencias

			$agencias_servicios->id_agencias->HrefValue = "";

			// id_servicio
			$agencias_servicios->id_servicio->HrefValue = "";

			// estatus
			$agencias_servicios->estatus->HrefValue = "";
		}
		if ($agencias_servicios->RowType == EW_ROWTYPE_ADD ||
			$agencias_servicios->RowType == EW_ROWTYPE_EDIT ||
			$agencias_servicios->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$agencias_servicios->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($agencias_servicios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$agencias_servicios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $agencias_servicios;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($agencias_servicios->id_agencias->FormValue) && $agencias_servicios->id_agencias->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $agencias_servicios->id_agencias->FldCaption());
		}
		if (!is_null($agencias_servicios->id_servicio->FormValue) && $agencias_servicios->id_servicio->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $agencias_servicios->id_servicio->FldCaption());
		}
		if (!is_null($agencias_servicios->estatus->FormValue) && $agencias_servicios->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $agencias_servicios->estatus->FldCaption());
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
		global $conn, $Language, $Security, $agencias_servicios;
		$rsnew = array();

		// id_agencias
		$agencias_servicios->id_agencias->SetDbValueDef($rsnew, $agencias_servicios->id_agencias->CurrentValue, 0, FALSE);

		// id_servicio
		$agencias_servicios->id_servicio->SetDbValueDef($rsnew, $agencias_servicios->id_servicio->CurrentValue, 0, FALSE);

		// estatus
		$agencias_servicios->estatus->SetDbValueDef($rsnew, $agencias_servicios->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $agencias_servicios->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($agencias_servicios->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($agencias_servicios->CancelMessage <> "") {
				$this->setFailureMessage($agencias_servicios->CancelMessage);
				$agencias_servicios->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$agencias_servicios->id_agencias_servicios->setDbValue($conn->Insert_ID());
			$rsnew['id_agencias_servicios'] = $agencias_servicios->id_agencias_servicios->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$agencias_servicios->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $agencias_servicios;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "agencias") {
				$bValidMaster = TRUE;
				if (@$_GET["id_agencias"] <> "") {
					$GLOBALS["agencias"]->id_agencias->setQueryStringValue($_GET["id_agencias"]);
					$agencias_servicios->id_agencias->setQueryStringValue($GLOBALS["agencias"]->id_agencias->QueryStringValue);
					$agencias_servicios->id_agencias->setSessionValue($agencias_servicios->id_agencias->QueryStringValue);
					if (!is_numeric($GLOBALS["agencias"]->id_agencias->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$agencias_servicios->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$agencias_servicios->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "agencias") {
				if ($agencias_servicios->id_agencias->QueryStringValue == "") $agencias_servicios->id_agencias->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $agencias_servicios->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $agencias_servicios->getDetailFilter(); // Get detail filter
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'agencias_servicios';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $agencias_servicios;
		$table = 'agencias_servicios';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_agencias_servicios'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($agencias_servicios->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($agencias_servicios->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($agencias_servicios->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
