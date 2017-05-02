<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "grupoinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$grupo_add = new cgrupo_add();
$Page =& $grupo_add;

// Page init
$grupo_add->Page_Init();

// Page main
$grupo_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grupo_add = new ew_Page("grupo_add");

// page properties
grupo_add.PageID = "add"; // page ID
grupo_add.FormID = "fgrupoadd"; // form ID
var EW_PAGE_ID = grupo_add.PageID; // for backward compatibility

// extend page with ValidateForm function
grupo_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grupo->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grupo->orden->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grupo->estatus->FldCaption()) ?>");

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
grupo_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grupo_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grupo_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grupo->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $grupo->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $grupo_add->ShowPageHeader(); ?>
<?php
$grupo_add->ShowMessage();
?>
<form name="fgrupoadd" id="fgrupoadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return grupo_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="grupo">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($grupo->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $grupo->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $grupo->nombre->EditValue ?>"<?php echo $grupo->nombre->EditAttributes() ?>>
</span><?php echo $grupo->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grupo->id_padre->Visible) { // id_padre ?>
	<tr id="r_id_padre"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->id_padre->FldCaption() ?></td>
		<td<?php echo $grupo->id_padre->CellAttributes() ?>><span id="el_id_padre">
<select id="x_id_padre" name="x_id_padre"<?php echo $grupo->id_padre->EditAttributes() ?>>
<?php
if (is_array($grupo->id_padre->EditValue)) {
	$arwrk = $grupo->id_padre->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo->id_padre->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $grupo->id_padre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grupo->id_contenido->Visible) { // id_contenido ?>
	<tr id="r_id_contenido"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->id_contenido->FldCaption() ?></td>
		<td<?php echo $grupo->id_contenido->CellAttributes() ?>><span id="el_id_contenido">
<select id="x_id_contenido" name="x_id_contenido"<?php echo $grupo->id_contenido->EditAttributes() ?>>
<?php
if (is_array($grupo->id_contenido->EditValue)) {
	$arwrk = $grupo->id_contenido->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo->id_contenido->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $grupo->id_contenido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grupo->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->orden->FldCaption() ?></td>
		<td<?php echo $grupo->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" size="4" value="<?php echo $grupo->orden->EditValue ?>"<?php echo $grupo->orden->EditAttributes() ?>>
</span><?php echo $grupo->orden->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grupo->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $grupo->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $grupo->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $grupo->estatus->EditAttributes() ?>>
<?php
if (is_array($grupo->estatus->EditValue)) {
	$arwrk = $grupo->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $grupo->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$grupo_add->ShowPageFooter();
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
$grupo_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrupo_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'grupo';

	// Page object name
	var $PageObjName = 'grupo_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grupo;
		if ($grupo->UseTokenInUrl) $PageUrl .= "t=" . $grupo->TableVar . "&"; // Add page token
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
		global $objForm, $grupo;
		if ($grupo->UseTokenInUrl) {
			if ($objForm)
				return ($grupo->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grupo->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrupo_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (grupo)
		if (!isset($GLOBALS["grupo"])) {
			$GLOBALS["grupo"] = new cgrupo();
			$GLOBALS["Table"] =& $GLOBALS["grupo"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grupo', TRUE);

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
		global $grupo;

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
			$this->Page_Terminate("grupolist.php");
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
		global $objForm, $Language, $gsFormError, $grupo;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$grupo->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$grupo->CurrentAction = "I"; // Form error, reset action
				$grupo->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_grupo"] != "") {
				$grupo->id_grupo->setQueryStringValue($_GET["id_grupo"]);
				$grupo->setKey("id_grupo", $grupo->id_grupo->CurrentValue); // Set up key
			} else {
				$grupo->setKey("id_grupo", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$grupo->CurrentAction = "C"; // Copy record
			} else {
				$grupo->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($grupo->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("grupolist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$grupo->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $grupo->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "grupoview.php")
						$sReturnUrl = $grupo->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$grupo->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$grupo->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$grupo->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $grupo;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $grupo;
		$grupo->nombre->CurrentValue = NULL;
		$grupo->nombre->OldValue = $grupo->nombre->CurrentValue;
		$grupo->id_padre->CurrentValue = NULL;
		$grupo->id_padre->OldValue = $grupo->id_padre->CurrentValue;
		$grupo->id_contenido->CurrentValue = NULL;
		$grupo->id_contenido->OldValue = $grupo->id_contenido->CurrentValue;
		$grupo->orden->CurrentValue = NULL;
		$grupo->orden->OldValue = $grupo->orden->CurrentValue;
		$grupo->estatus->CurrentValue = NULL;
		$grupo->estatus->OldValue = $grupo->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $grupo;
		if (!$grupo->nombre->FldIsDetailKey) {
			$grupo->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$grupo->id_padre->FldIsDetailKey) {
			$grupo->id_padre->setFormValue($objForm->GetValue("x_id_padre"));
		}
		if (!$grupo->id_contenido->FldIsDetailKey) {
			$grupo->id_contenido->setFormValue($objForm->GetValue("x_id_contenido"));
		}
		if (!$grupo->orden->FldIsDetailKey) {
			$grupo->orden->setFormValue($objForm->GetValue("x_orden"));
		}
		if (!$grupo->estatus->FldIsDetailKey) {
			$grupo->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $grupo;
		$this->LoadOldRecord();
		$grupo->nombre->CurrentValue = $grupo->nombre->FormValue;
		$grupo->id_padre->CurrentValue = $grupo->id_padre->FormValue;
		$grupo->id_contenido->CurrentValue = $grupo->id_contenido->FormValue;
		$grupo->orden->CurrentValue = $grupo->orden->FormValue;
		$grupo->estatus->CurrentValue = $grupo->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grupo;
		$sFilter = $grupo->KeyFilter();

		// Call Row Selecting event
		$grupo->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grupo->CurrentFilter = $sFilter;
		$sSql = $grupo->SQL();
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
		global $conn, $grupo;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$grupo->Row_Selected($row);
		$grupo->id_grupo->setDbValue($rs->fields('id_grupo'));
		$grupo->nombre->setDbValue($rs->fields('nombre'));
		$grupo->id_padre->setDbValue($rs->fields('id_padre'));
		$grupo->id_contenido->setDbValue($rs->fields('id_contenido'));
		$grupo->orden->setDbValue($rs->fields('orden'));
		$grupo->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $grupo;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($grupo->getKey("id_grupo")) <> "")
			$grupo->id_grupo->CurrentValue = $grupo->getKey("id_grupo"); // id_grupo
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$grupo->CurrentFilter = $grupo->KeyFilter();
			$sSql = $grupo->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grupo;

		// Initialize URLs
		// Call Row_Rendering event

		$grupo->Row_Rendering();

		// Common render codes for all row types
		// id_grupo
		// nombre
		// id_padre
		// id_contenido
		// orden
		// estatus

		if ($grupo->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$grupo->nombre->ViewValue = $grupo->nombre->CurrentValue;
			$grupo->nombre->ViewCustomAttributes = "";

			// id_padre
			if (strval($grupo->id_padre->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo` = " . ew_AdjustSql($grupo->id_padre->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombssre` FROM `grupo`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo->id_padre->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$grupo->id_padre->ViewValue = $grupo->id_padre->CurrentValue;
				}
			} else {
				$grupo->id_padre->ViewValue = NULL;
			}
			$grupo->id_padre->ViewCustomAttributes = "";

			// id_contenido
			if (strval($grupo->id_contenido->CurrentValue) <> "") {
				$sFilterWrk = "`id_contenido` = " . ew_AdjustSql($grupo->id_contenido->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo->id_contenido->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo->id_contenido->ViewValue = $grupo->id_contenido->CurrentValue;
				}
			} else {
				$grupo->id_contenido->ViewValue = NULL;
			}
			$grupo->id_contenido->ViewCustomAttributes = "";

			// orden
			$grupo->orden->ViewValue = $grupo->orden->CurrentValue;
			$grupo->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($grupo->estatus->CurrentValue) <> "") {
				switch ($grupo->estatus->CurrentValue) {
					case "1":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(1) <> "" ? $grupo->estatus->FldTagCaption(1) : $grupo->estatus->CurrentValue;
						break;
					case "0":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(2) <> "" ? $grupo->estatus->FldTagCaption(2) : $grupo->estatus->CurrentValue;
						break;
					case "3":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(3) <> "" ? $grupo->estatus->FldTagCaption(3) : $grupo->estatus->CurrentValue;
						break;
					case "4":
						$grupo->estatus->ViewValue = $grupo->estatus->FldTagCaption(4) <> "" ? $grupo->estatus->FldTagCaption(4) : $grupo->estatus->CurrentValue;
						break;
					default:
						$grupo->estatus->ViewValue = $grupo->estatus->CurrentValue;
				}
			} else {
				$grupo->estatus->ViewValue = NULL;
			}
			$grupo->estatus->ViewCustomAttributes = "";

			// nombre
			$grupo->nombre->LinkCustomAttributes = "";
			$grupo->nombre->HrefValue = "";
			$grupo->nombre->TooltipValue = "";

			
			// id_padre
			$grupo->id_padre->LinkCustomAttributes = "";
			$grupo->id_padre->HrefValue = "";
			$grupo->id_padre->TooltipValue = "";

			// id_contenido
			$grupo->id_contenido->LinkCustomAttributes = "";
			$grupo->id_contenido->HrefValue = "";
			$grupo->id_contenido->TooltipValue = "";

			// orden
			$grupo->orden->LinkCustomAttributes = "";
			$grupo->orden->HrefValue = "";
			$grupo->orden->TooltipValue = "";

			// estatus
			$grupo->estatus->LinkCustomAttributes = "";
			$grupo->estatus->HrefValue = "";
			$grupo->estatus->TooltipValue = "";
		} elseif ($grupo->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$grupo->nombre->EditCustomAttributes = "";
			$grupo->nombre->EditValue = ew_HtmlEncode($grupo->nombre->CurrentValue);

			// id_padre
			$grupo->id_padre->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_grupo`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `grupo`";
			$sWhereWrk = "`id_padre` is null";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$grupo->id_padre->EditValue = $arwrk;

			// id_contenido
			$grupo->id_contenido->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_contenido`, `titulo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$grupo->id_contenido->EditValue = $arwrk;

			// orden
			$grupo->orden->EditCustomAttributes = "";
			$grupo->orden->EditValue = ew_HtmlEncode($grupo->orden->CurrentValue);

			// estatus
			$grupo->estatus->EditCustomAttributes = "";
			$arwrk = array();
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("0", $grupo->estatus->FldTagCaption(2) <> "" ? $grupo->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $grupo->estatus->FldTagCaption(3) <> "" ? $grupo->estatus->FldTagCaption(3) : "3");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $grupo->estatus->FldTagCaption(3) <> "" ? $grupo->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $grupo->estatus->FldTagCaption(4) <> "" ? $grupo->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $grupo->estatus->FldTagCaption(1) <> "" ? $grupo->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $grupo->estatus->FldTagCaption(2) <> "" ? $grupo->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $grupo->estatus->FldTagCaption(3) <> "" ? $grupo->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $grupo->estatus->FldTagCaption(4) <> "" ? $grupo->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $grupo->estatus->FldTagCaption(1) <> "" ? $grupo->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $grupo->estatus->FldTagCaption(4) <> "" ? $grupo->estatus->FldTagCaption(4) : "4"); 
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $grupo->estatus->FldTagCaption(1) <> "" ? $grupo->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $grupo->estatus->FldTagCaption(2) <> "" ? $grupo->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $grupo->estatus->FldTagCaption(3) <> "" ? $grupo->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $grupo->estatus->FldTagCaption(4) <> "" ? $grupo->estatus->FldTagCaption(4) : "4");
			}
			
			
			
			
			
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$grupo->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$grupo->nombre->HrefValue = "";

			// id_padre
			$grupo->id_padre->HrefValue = "";

			// id_contenido
			$grupo->id_contenido->HrefValue = "";

			// orden
			$grupo->orden->HrefValue = "";

			// estatus
			$grupo->estatus->HrefValue = "";
		}
		if ($grupo->RowType == EW_ROWTYPE_ADD ||
			$grupo->RowType == EW_ROWTYPE_EDIT ||
			$grupo->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$grupo->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($grupo->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grupo->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $grupo;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($grupo->nombre->FormValue) && $grupo->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $grupo->nombre->FldCaption());
		}
		if (!ew_CheckInteger($grupo->orden->FormValue)) {
			ew_AddMessage($gsFormError, $grupo->orden->FldErrMsg());
		}
		if (!is_null($grupo->estatus->FormValue) && $grupo->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $grupo->estatus->FldCaption());
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
		global $conn, $Language, $Security, $grupo;
		$rsnew = array();

		// nombre
		$grupo->nombre->SetDbValueDef($rsnew, $grupo->nombre->CurrentValue, NULL, FALSE);

		// id_padre
		$grupo->id_padre->SetDbValueDef($rsnew, $grupo->id_padre->CurrentValue, NULL, FALSE);

		// id_contenido
		$grupo->id_contenido->SetDbValueDef($rsnew, $grupo->id_contenido->CurrentValue, NULL, FALSE);

		// orden
		$grupo->orden->SetDbValueDef($rsnew, $grupo->orden->CurrentValue, NULL, FALSE);

		// estatus
		$grupo->estatus->SetDbValueDef($rsnew, $grupo->estatus->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $grupo->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($grupo->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($grupo->CancelMessage <> "") {
				$this->setFailureMessage($grupo->CancelMessage);
				$grupo->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$grupo->id_grupo->setDbValue($conn->Insert_ID());
			$rsnew['id_grupo'] = $grupo->id_grupo->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$grupo->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'grupo';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $grupo;
		$table = 'grupo';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_grupo'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($grupo->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($grupo->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($grupo->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
