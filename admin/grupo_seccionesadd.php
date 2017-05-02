<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "grupo_seccionesinfo.php" ?>
<?php include_once "contenidosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$grupo_secciones_add = new cgrupo_secciones_add();
$Page =& $grupo_secciones_add;

// Page init
$grupo_secciones_add->Page_Init();

// Page main
$grupo_secciones_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grupo_secciones_add = new ew_Page("grupo_secciones_add");

// page properties
grupo_secciones_add.PageID = "add"; // page ID
grupo_secciones_add.FormID = "fgrupo_seccionesadd"; // form ID
var EW_PAGE_ID = grupo_secciones_add.PageID; // for backward compatibility

// extend page with ValidateForm function
grupo_secciones_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_id_grupo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grupo_secciones->id_grupo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_contenido"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grupo_secciones->id_contenido->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grupo_secciones->orden->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grupo_secciones->estatus->FldCaption()) ?>");

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
grupo_secciones_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grupo_secciones_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grupo_secciones_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grupo_secciones->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $grupo_secciones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $grupo_secciones_add->ShowPageHeader(); ?>
<?php
$grupo_secciones_add->ShowMessage();
?>
<form name="fgrupo_seccionesadd" id="fgrupo_seccionesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return grupo_secciones_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="grupo_secciones">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($grupo_secciones->id_grupo->Visible) { // id_grupo ?>
	<tr id="r_id_grupo"<?php echo $grupo_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo_secciones->id_grupo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $grupo_secciones->id_grupo->CellAttributes() ?>><span id="el_id_grupo">
<select id="x_id_grupo" name="x_id_grupo"<?php echo $grupo_secciones->id_grupo->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->id_grupo->EditValue)) {
	$arwrk = $grupo_secciones->id_grupo->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->id_grupo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $grupo_secciones->id_grupo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grupo_secciones->id_contenido->Visible) { // id_contenido ?>
	<tr id="r_id_contenido"<?php echo $grupo_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo_secciones->id_contenido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $grupo_secciones->id_contenido->CellAttributes() ?>><span id="el_id_contenido">
<?php if ($grupo_secciones->id_contenido->getSessionValue() <> "") { ?>
<div<?php echo $grupo_secciones->id_contenido->ViewAttributes() ?>><?php echo $grupo_secciones->id_contenido->ViewValue ?></div>
<input type="hidden" id="x_id_contenido" name="x_id_contenido" value="<?php echo ew_HtmlEncode($grupo_secciones->id_contenido->CurrentValue) ?>">
<?php } else { ?>
<select id="x_id_contenido" name="x_id_contenido"<?php echo $grupo_secciones->id_contenido->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->id_contenido->EditValue)) {
	$arwrk = $grupo_secciones->id_contenido->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->id_contenido->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span><?php echo $grupo_secciones->id_contenido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grupo_secciones->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $grupo_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo_secciones->orden->FldCaption() ?></td>
		<td<?php echo $grupo_secciones->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" size="3" maxlength="3" value="<?php echo $grupo_secciones->orden->EditValue ?>"<?php echo $grupo_secciones->orden->EditAttributes() ?>>
</span><?php echo $grupo_secciones->orden->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grupo_secciones->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $grupo_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grupo_secciones->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $grupo_secciones->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $grupo_secciones->estatus->EditAttributes() ?>>
<?php
if (is_array($grupo_secciones->estatus->EditValue)) {
	$arwrk = $grupo_secciones->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($grupo_secciones->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $grupo_secciones->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$grupo_secciones_add->ShowPageFooter();
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
$grupo_secciones_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrupo_secciones_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'grupo_secciones';

	// Page object name
	var $PageObjName = 'grupo_secciones_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grupo_secciones;
		if ($grupo_secciones->UseTokenInUrl) $PageUrl .= "t=" . $grupo_secciones->TableVar . "&"; // Add page token
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
		global $objForm, $grupo_secciones;
		if ($grupo_secciones->UseTokenInUrl) {
			if ($objForm)
				return ($grupo_secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grupo_secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrupo_secciones_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (grupo_secciones)
		if (!isset($GLOBALS["grupo_secciones"])) {
			$GLOBALS["grupo_secciones"] = new cgrupo_secciones();
			$GLOBALS["Table"] =& $GLOBALS["grupo_secciones"];
		}

		// Table object (contenidos)
		if (!isset($GLOBALS['contenidos'])) $GLOBALS['contenidos'] = new ccontenidos();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grupo_secciones', TRUE);

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
		global $grupo_secciones;

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
			$this->Page_Terminate("grupo_seccioneslist.php");
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
		global $objForm, $Language, $gsFormError, $grupo_secciones;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$grupo_secciones->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$grupo_secciones->CurrentAction = "I"; // Form error, reset action
				$grupo_secciones->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_grupo_seccion"] != "") {
				$grupo_secciones->id_grupo_seccion->setQueryStringValue($_GET["id_grupo_seccion"]);
				$grupo_secciones->setKey("id_grupo_seccion", $grupo_secciones->id_grupo_seccion->CurrentValue); // Set up key
			} else {
				$grupo_secciones->setKey("id_grupo_seccion", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$grupo_secciones->CurrentAction = "C"; // Copy record
			} else {
				$grupo_secciones->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($grupo_secciones->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("grupo_seccioneslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$grupo_secciones->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $grupo_secciones->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "grupo_seccionesview.php")
						$sReturnUrl = $grupo_secciones->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$grupo_secciones->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$grupo_secciones->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$grupo_secciones->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $grupo_secciones;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $grupo_secciones;
		$grupo_secciones->id_grupo->CurrentValue = NULL;
		$grupo_secciones->id_grupo->OldValue = $grupo_secciones->id_grupo->CurrentValue;
		$grupo_secciones->id_contenido->CurrentValue = NULL;
		$grupo_secciones->id_contenido->OldValue = $grupo_secciones->id_contenido->CurrentValue;
		$grupo_secciones->orden->CurrentValue = NULL;
		$grupo_secciones->orden->OldValue = $grupo_secciones->orden->CurrentValue;
		$grupo_secciones->estatus->CurrentValue = NULL;
		$grupo_secciones->estatus->OldValue = $grupo_secciones->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $grupo_secciones;
		if (!$grupo_secciones->id_grupo->FldIsDetailKey) {
			$grupo_secciones->id_grupo->setFormValue($objForm->GetValue("x_id_grupo"));
		}
		if (!$grupo_secciones->id_contenido->FldIsDetailKey) {
			$grupo_secciones->id_contenido->setFormValue($objForm->GetValue("x_id_contenido"));
		}
		if (!$grupo_secciones->orden->FldIsDetailKey) {
			$grupo_secciones->orden->setFormValue($objForm->GetValue("x_orden"));
		}
		if (!$grupo_secciones->estatus->FldIsDetailKey) {
			$grupo_secciones->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $grupo_secciones;
		$this->LoadOldRecord();
		$grupo_secciones->id_grupo->CurrentValue = $grupo_secciones->id_grupo->FormValue;
		$grupo_secciones->id_contenido->CurrentValue = $grupo_secciones->id_contenido->FormValue;
		$grupo_secciones->orden->CurrentValue = $grupo_secciones->orden->FormValue;
		$grupo_secciones->estatus->CurrentValue = $grupo_secciones->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grupo_secciones;
		$sFilter = $grupo_secciones->KeyFilter();

		// Call Row Selecting event
		$grupo_secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grupo_secciones->CurrentFilter = $sFilter;
		$sSql = $grupo_secciones->SQL();
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
		global $conn, $grupo_secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$grupo_secciones->Row_Selected($row);
		$grupo_secciones->id_grupo_seccion->setDbValue($rs->fields('id_grupo_seccion'));
		$grupo_secciones->id_grupo->setDbValue($rs->fields('id_grupo'));
		$grupo_secciones->id_contenido->setDbValue($rs->fields('id_contenido'));
		$grupo_secciones->orden->setDbValue($rs->fields('orden'));
		$grupo_secciones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $grupo_secciones;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($grupo_secciones->getKey("id_grupo_seccion")) <> "")
			$grupo_secciones->id_grupo_seccion->CurrentValue = $grupo_secciones->getKey("id_grupo_seccion"); // id_grupo_seccion
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$grupo_secciones->CurrentFilter = $grupo_secciones->KeyFilter();
			$sSql = $grupo_secciones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grupo_secciones;

		// Initialize URLs
		// Call Row_Rendering event

		$grupo_secciones->Row_Rendering();

		// Common render codes for all row types
		// id_grupo_seccion
		// id_grupo
		// id_contenido
		// orden
		// estatus

		if ($grupo_secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_grupo
			if (strval($grupo_secciones->id_grupo->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo` = " . ew_AdjustSql($grupo_secciones->id_grupo->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view3`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo_secciones->id_grupo->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo_secciones->id_grupo->ViewValue = $grupo_secciones->id_grupo->CurrentValue;
				}
			} else {
				$grupo_secciones->id_grupo->ViewValue = NULL;
			}
			$grupo_secciones->id_grupo->ViewCustomAttributes = "";

			// id_contenido
			if (strval($grupo_secciones->id_contenido->CurrentValue) <> "") {
				$sFilterWrk = "`id_contenido` = " . ew_AdjustSql($grupo_secciones->id_contenido->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo_secciones->id_contenido->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo_secciones->id_contenido->ViewValue = $grupo_secciones->id_contenido->CurrentValue;
				}
			} else {
				$grupo_secciones->id_contenido->ViewValue = NULL;
			}
			$grupo_secciones->id_contenido->ViewCustomAttributes = "";

			// orden
			$grupo_secciones->orden->ViewValue = $grupo_secciones->orden->CurrentValue;
			$grupo_secciones->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($grupo_secciones->estatus->CurrentValue) <> "") {
				switch ($grupo_secciones->estatus->CurrentValue) {
					case "1":
						$grupo_secciones->estatus->ViewValue = $grupo_secciones->estatus->FldTagCaption(1) <> "" ? $grupo_secciones->estatus->FldTagCaption(1) : $grupo_secciones->estatus->CurrentValue;
						break;
					case "0":
						$grupo_secciones->estatus->ViewValue = $grupo_secciones->estatus->FldTagCaption(2) <> "" ? $grupo_secciones->estatus->FldTagCaption(2) : $grupo_secciones->estatus->CurrentValue;
						break;
					default:
						$grupo_secciones->estatus->ViewValue = $grupo_secciones->estatus->CurrentValue;
				}
			} else {
				$grupo_secciones->estatus->ViewValue = NULL;
			}
			$grupo_secciones->estatus->ViewCustomAttributes = "";

			// id_grupo
			$grupo_secciones->id_grupo->LinkCustomAttributes = "";
			$grupo_secciones->id_grupo->HrefValue = "";
			$grupo_secciones->id_grupo->TooltipValue = "";

			// id_contenido
			$grupo_secciones->id_contenido->LinkCustomAttributes = "";
			$grupo_secciones->id_contenido->HrefValue = "";
			$grupo_secciones->id_contenido->TooltipValue = "";

			// orden
			$grupo_secciones->orden->LinkCustomAttributes = "";
			$grupo_secciones->orden->HrefValue = "";
			$grupo_secciones->orden->TooltipValue = "";

			// estatus
			$grupo_secciones->estatus->LinkCustomAttributes = "";
			$grupo_secciones->estatus->HrefValue = "";
			$grupo_secciones->estatus->TooltipValue = "";
		} elseif ($grupo_secciones->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_grupo
			$grupo_secciones->id_grupo->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_grupo`, `titulo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `view3`";
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
			$grupo_secciones->id_grupo->EditValue = $arwrk;

			// id_contenido
			$grupo_secciones->id_contenido->EditCustomAttributes = "";
			if ($grupo_secciones->id_contenido->getSessionValue() <> "") {
				$grupo_secciones->id_contenido->CurrentValue = $grupo_secciones->id_contenido->getSessionValue();
			if (strval($grupo_secciones->id_contenido->CurrentValue) <> "") {
				$sFilterWrk = "`id_contenido` = " . ew_AdjustSql($grupo_secciones->id_contenido->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo_secciones->id_contenido->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo_secciones->id_contenido->ViewValue = $grupo_secciones->id_contenido->CurrentValue;
				}
			} else {
				$grupo_secciones->id_contenido->ViewValue = NULL;
			}
			$grupo_secciones->id_contenido->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_contenido`, `titulo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `contenidos`";
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
			$grupo_secciones->id_contenido->EditValue = $arwrk;
			}

			// orden
			$grupo_secciones->orden->EditCustomAttributes = "";
			$grupo_secciones->orden->EditValue = ew_HtmlEncode($grupo_secciones->orden->CurrentValue);

			// estatus
			$grupo_secciones->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $grupo_secciones->estatus->FldTagCaption(1) <> "" ? $grupo_secciones->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $grupo_secciones->estatus->FldTagCaption(2) <> "" ? $grupo_secciones->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$grupo_secciones->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_grupo

			$grupo_secciones->id_grupo->HrefValue = "";

			// id_contenido
			$grupo_secciones->id_contenido->HrefValue = "";

			// orden
			$grupo_secciones->orden->HrefValue = "";

			// estatus
			$grupo_secciones->estatus->HrefValue = "";
		}
		if ($grupo_secciones->RowType == EW_ROWTYPE_ADD ||
			$grupo_secciones->RowType == EW_ROWTYPE_EDIT ||
			$grupo_secciones->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$grupo_secciones->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($grupo_secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grupo_secciones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $grupo_secciones;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($grupo_secciones->id_grupo->FormValue) && $grupo_secciones->id_grupo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $grupo_secciones->id_grupo->FldCaption());
		}
		if (!is_null($grupo_secciones->id_contenido->FormValue) && $grupo_secciones->id_contenido->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $grupo_secciones->id_contenido->FldCaption());
		}
		if (!ew_CheckInteger($grupo_secciones->orden->FormValue)) {
			ew_AddMessage($gsFormError, $grupo_secciones->orden->FldErrMsg());
		}
		if (!is_null($grupo_secciones->estatus->FormValue) && $grupo_secciones->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $grupo_secciones->estatus->FldCaption());
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
		global $conn, $Language, $Security, $grupo_secciones;
		$rsnew = array();

		// id_grupo
		$grupo_secciones->id_grupo->SetDbValueDef($rsnew, $grupo_secciones->id_grupo->CurrentValue, NULL, FALSE);

		// id_contenido
		$grupo_secciones->id_contenido->SetDbValueDef($rsnew, $grupo_secciones->id_contenido->CurrentValue, NULL, FALSE);

		// orden
		$grupo_secciones->orden->SetDbValueDef($rsnew, $grupo_secciones->orden->CurrentValue, NULL, FALSE);

		// estatus
		$grupo_secciones->estatus->SetDbValueDef($rsnew, $grupo_secciones->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $grupo_secciones->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($grupo_secciones->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($grupo_secciones->CancelMessage <> "") {
				$this->setFailureMessage($grupo_secciones->CancelMessage);
				$grupo_secciones->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$grupo_secciones->id_grupo_seccion->setDbValue($conn->Insert_ID());
			$rsnew['id_grupo_seccion'] = $grupo_secciones->id_grupo_seccion->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$grupo_secciones->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $grupo_secciones;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "contenidos") {
				$bValidMaster = TRUE;
				if (@$_GET["id_contenido"] <> "") {
					$GLOBALS["contenidos"]->id_contenido->setQueryStringValue($_GET["id_contenido"]);
					$grupo_secciones->id_contenido->setQueryStringValue($GLOBALS["contenidos"]->id_contenido->QueryStringValue);
					$grupo_secciones->id_contenido->setSessionValue($grupo_secciones->id_contenido->QueryStringValue);
					if (!is_numeric($GLOBALS["contenidos"]->id_contenido->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$grupo_secciones->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$grupo_secciones->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "contenidos") {
				if ($grupo_secciones->id_contenido->QueryStringValue == "") $grupo_secciones->id_contenido->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $grupo_secciones->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $grupo_secciones->getDetailFilter(); // Get detail filter
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'grupo_secciones';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $grupo_secciones;
		$table = 'grupo_secciones';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_grupo_seccion'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($grupo_secciones->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($grupo_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($grupo_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
