<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documentos_seccionesinfo.php" ?>
<?php include_once "documentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documentos_secciones_add = new cdocumentos_secciones_add();
$Page =& $documentos_secciones_add;

// Page init
$documentos_secciones_add->Page_Init();

// Page main
$documentos_secciones_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_secciones_add = new ew_Page("documentos_secciones_add");

// page properties
documentos_secciones_add.PageID = "add"; // page ID
documentos_secciones_add.FormID = "fdocumentos_seccionesadd"; // form ID
var EW_PAGE_ID = documentos_secciones_add.PageID; // for backward compatibility

// extend page with ValidateForm function
documentos_secciones_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_id_documentos"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documentos_secciones->id_documentos->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_grupo_sec"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documentos_secciones->id_grupo_sec->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fecha_inicio"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documentos_secciones->fecha_inicio->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha_fin"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documentos_secciones->fecha_fin->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documentos_secciones->fecha->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documentos_secciones->estatus->FldCaption()) ?>");

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
documentos_secciones_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_secciones_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_secciones_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos_secciones->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $documentos_secciones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $documentos_secciones_add->ShowPageHeader(); ?>
<?php
$documentos_secciones_add->ShowMessage();
?>
<form name="fdocumentos_seccionesadd" id="fdocumentos_seccionesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return documentos_secciones_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="documentos_secciones">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($documentos_secciones->id_documentos->Visible) { // id_documentos ?>
	<tr id="r_id_documentos"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->id_documentos->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $documentos_secciones->id_documentos->CellAttributes() ?>><span id="el_id_documentos">
<?php if ($documentos_secciones->id_documentos->getSessionValue() <> "") { ?>
<div<?php echo $documentos_secciones->id_documentos->ViewAttributes() ?>><?php echo $documentos_secciones->id_documentos->ViewValue ?></div>
<input type="hidden" id="x_id_documentos" name="x_id_documentos" value="<?php echo ew_HtmlEncode($documentos_secciones->id_documentos->CurrentValue) ?>">
<?php } else { ?>
<select id="x_id_documentos" name="x_id_documentos"<?php echo $documentos_secciones->id_documentos->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->id_documentos->EditValue)) {
	$arwrk = $documentos_secciones->id_documentos->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->id_documentos->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $documentos_secciones->id_documentos->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->id_grupo_sec->Visible) { // id_grupo_sec ?>
	<tr id="r_id_grupo_sec"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->id_grupo_sec->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $documentos_secciones->id_grupo_sec->CellAttributes() ?>><span id="el_id_grupo_sec">
<select id="x_id_grupo_sec" name="x_id_grupo_sec"<?php echo $documentos_secciones->id_grupo_sec->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->id_grupo_sec->EditValue)) {
	$arwrk = $documentos_secciones->id_grupo_sec->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->id_grupo_sec->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $documentos_secciones->id_grupo_sec->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->fecha_inicio->Visible) { // fecha_inicio ?>
	<tr id="r_fecha_inicio"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->fecha_inicio->FldCaption() ?></td>
		<td<?php echo $documentos_secciones->fecha_inicio->CellAttributes() ?>><span id="el_fecha_inicio">
<input type="text" name="x_fecha_inicio" id="x_fecha_inicio" size="12" value="<?php echo $documentos_secciones->fecha_inicio->EditValue ?>"<?php echo $documentos_secciones->fecha_inicio->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_fecha_inicio" name="cal_x_fecha_inicio" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_fecha_inicio", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_fecha_inicio" // button id
});
</script>
</span><?php echo $documentos_secciones->fecha_inicio->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->fecha_fin->Visible) { // fecha_fin ?>
	<tr id="r_fecha_fin"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->fecha_fin->FldCaption() ?></td>
		<td<?php echo $documentos_secciones->fecha_fin->CellAttributes() ?>><span id="el_fecha_fin">
<input type="text" name="x_fecha_fin" id="x_fecha_fin" size="12" value="<?php echo $documentos_secciones->fecha_fin->EditValue ?>"<?php echo $documentos_secciones->fecha_fin->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_fecha_fin" name="cal_x_fecha_fin" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_fecha_fin", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_fecha_fin" // button id
});
</script>
</span><?php echo $documentos_secciones->fecha_fin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->fecha->FldCaption() ?></td>
		<td<?php echo $documentos_secciones->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha" size="12" value="<?php echo $documentos_secciones->fecha->EditValue ?>"<?php echo $documentos_secciones->fecha->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_fecha" name="cal_x_fecha" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_fecha", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_fecha" // button id
});
</script>
</span><?php echo $documentos_secciones->fecha->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($documentos_secciones->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $documentos_secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documentos_secciones->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $documentos_secciones->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $documentos_secciones->estatus->EditAttributes() ?>>
<?php
if (is_array($documentos_secciones->estatus->EditValue)) {
	$arwrk = $documentos_secciones->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($documentos_secciones->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $documentos_secciones->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$documentos_secciones_add->ShowPageFooter();
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
$documentos_secciones_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumentos_secciones_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'documentos_secciones';

	// Page object name
	var $PageObjName = 'documentos_secciones_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) $PageUrl .= "t=" . $documentos_secciones->TableVar . "&"; // Add page token
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
		global $objForm, $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) {
			if ($objForm)
				return ($documentos_secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documentos_secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumentos_secciones_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documentos_secciones)
		if (!isset($GLOBALS["documentos_secciones"])) {
			$GLOBALS["documentos_secciones"] = new cdocumentos_secciones();
			$GLOBALS["Table"] =& $GLOBALS["documentos_secciones"];
		}

		// Table object (documentos)
		if (!isset($GLOBALS['documentos'])) $GLOBALS['documentos'] = new cdocumentos();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documentos_secciones', TRUE);

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
		global $documentos_secciones;

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
			$this->Page_Terminate("documentos_seccioneslist.php");
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
		global $objForm, $Language, $gsFormError, $documentos_secciones;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$documentos_secciones->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$documentos_secciones->CurrentAction = "I"; // Form error, reset action
				$documentos_secciones->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_documentos_secciones"] != "") {
				$documentos_secciones->id_documentos_secciones->setQueryStringValue($_GET["id_documentos_secciones"]);
				$documentos_secciones->setKey("id_documentos_secciones", $documentos_secciones->id_documentos_secciones->CurrentValue); // Set up key
			} else {
				$documentos_secciones->setKey("id_documentos_secciones", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$documentos_secciones->CurrentAction = "C"; // Copy record
			} else {
				$documentos_secciones->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($documentos_secciones->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("documentos_seccioneslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$documentos_secciones->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $documentos_secciones->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "documentos_seccionesview.php")
						$sReturnUrl = $documentos_secciones->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$documentos_secciones->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$documentos_secciones->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$documentos_secciones->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $documentos_secciones;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $documentos_secciones;
		$documentos_secciones->id_documentos->CurrentValue = NULL;
		$documentos_secciones->id_documentos->OldValue = $documentos_secciones->id_documentos->CurrentValue;
		$documentos_secciones->id_grupo_sec->CurrentValue = NULL;
		$documentos_secciones->id_grupo_sec->OldValue = $documentos_secciones->id_grupo_sec->CurrentValue;
		$documentos_secciones->fecha_inicio->CurrentValue = NULL;
		$documentos_secciones->fecha_inicio->OldValue = $documentos_secciones->fecha_inicio->CurrentValue;
		$documentos_secciones->fecha_fin->CurrentValue = NULL;
		$documentos_secciones->fecha_fin->OldValue = $documentos_secciones->fecha_fin->CurrentValue;
		$documentos_secciones->fecha->CurrentValue = ew_CurrentDate();
		$documentos_secciones->estatus->CurrentValue = NULL;
		$documentos_secciones->estatus->OldValue = $documentos_secciones->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $documentos_secciones;
		if (!$documentos_secciones->id_documentos->FldIsDetailKey) {
			$documentos_secciones->id_documentos->setFormValue($objForm->GetValue("x_id_documentos"));
		}
		if (!$documentos_secciones->id_grupo_sec->FldIsDetailKey) {
			$documentos_secciones->id_grupo_sec->setFormValue($objForm->GetValue("x_id_grupo_sec"));
		}
		if (!$documentos_secciones->fecha_inicio->FldIsDetailKey) {
			$documentos_secciones->fecha_inicio->setFormValue($objForm->GetValue("x_fecha_inicio"));
			$documentos_secciones->fecha_inicio->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7);
		}
		if (!$documentos_secciones->fecha_fin->FldIsDetailKey) {
			$documentos_secciones->fecha_fin->setFormValue($objForm->GetValue("x_fecha_fin"));
			$documentos_secciones->fecha_fin->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7);
		}
		if (!$documentos_secciones->fecha->FldIsDetailKey) {
			$documentos_secciones->fecha->setFormValue($objForm->GetValue("x_fecha"));
			$documentos_secciones->fecha->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha->CurrentValue, 7);
		}
		if (!$documentos_secciones->estatus->FldIsDetailKey) {
			$documentos_secciones->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $documentos_secciones;
		$this->LoadOldRecord();
		$documentos_secciones->id_documentos->CurrentValue = $documentos_secciones->id_documentos->FormValue;
		$documentos_secciones->id_grupo_sec->CurrentValue = $documentos_secciones->id_grupo_sec->FormValue;
		$documentos_secciones->fecha_inicio->CurrentValue = $documentos_secciones->fecha_inicio->FormValue;
		$documentos_secciones->fecha_inicio->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7);
		$documentos_secciones->fecha_fin->CurrentValue = $documentos_secciones->fecha_fin->FormValue;
		$documentos_secciones->fecha_fin->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7);
		$documentos_secciones->fecha->CurrentValue = $documentos_secciones->fecha->FormValue;
		$documentos_secciones->fecha->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha->CurrentValue, 7);
		$documentos_secciones->estatus->CurrentValue = $documentos_secciones->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documentos_secciones;
		$sFilter = $documentos_secciones->KeyFilter();

		// Call Row Selecting event
		$documentos_secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documentos_secciones->CurrentFilter = $sFilter;
		$sSql = $documentos_secciones->SQL();
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
		global $conn, $documentos_secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documentos_secciones->Row_Selected($row);
		$documentos_secciones->id_documentos_secciones->setDbValue($rs->fields('id_documentos_secciones'));
		$documentos_secciones->id_documentos->setDbValue($rs->fields('id_documentos'));
		$documentos_secciones->id_grupo_sec->setDbValue($rs->fields('id_grupo_sec'));
		$documentos_secciones->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$documentos_secciones->fecha_fin->setDbValue($rs->fields('fecha_fin'));
		$documentos_secciones->fecha->setDbValue($rs->fields('fecha'));
		$documentos_secciones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $documentos_secciones;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($documentos_secciones->getKey("id_documentos_secciones")) <> "")
			$documentos_secciones->id_documentos_secciones->CurrentValue = $documentos_secciones->getKey("id_documentos_secciones"); // id_documentos_secciones
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$documentos_secciones->CurrentFilter = $documentos_secciones->KeyFilter();
			$sSql = $documentos_secciones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documentos_secciones;

		// Initialize URLs
		// Call Row_Rendering event

		$documentos_secciones->Row_Rendering();

		// Common render codes for all row types
		// id_documentos_secciones
		// id_documentos
		// id_grupo_sec
		// fecha_inicio
		// fecha_fin
		// fecha
		// estatus

		if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_documentos
			if (strval($documentos_secciones->id_documentos->CurrentValue) <> "") {
				$sFilterWrk = "`id_documentos` = " . ew_AdjustSql($documentos_secciones->id_documentos->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `documentos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_documentos->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_documentos->ViewValue = $documentos_secciones->id_documentos->CurrentValue;
				}
			} else {
				$documentos_secciones->id_documentos->ViewValue = NULL;
			}
			$documentos_secciones->id_documentos->ViewCustomAttributes = "";

			// id_grupo_sec
			if (strval($documentos_secciones->id_grupo_sec->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($documentos_secciones->id_grupo_sec->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view1`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_grupo_sec->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_grupo_sec->ViewValue = $documentos_secciones->id_grupo_sec->CurrentValue;
				}
			} else {
				$documentos_secciones->id_grupo_sec->ViewValue = NULL;
			}
			$documentos_secciones->id_grupo_sec->ViewCustomAttributes = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->ViewValue = $documentos_secciones->fecha_inicio->CurrentValue;
			$documentos_secciones->fecha_inicio->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_inicio->ViewValue, 7);
			$documentos_secciones->fecha_inicio->ViewCustomAttributes = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->ViewValue = $documentos_secciones->fecha_fin->CurrentValue;
			$documentos_secciones->fecha_fin->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_fin->ViewValue, 7);
			$documentos_secciones->fecha_fin->ViewCustomAttributes = "";

			// fecha
			$documentos_secciones->fecha->ViewValue = $documentos_secciones->fecha->CurrentValue;
			$documentos_secciones->fecha->ViewValue = ew_FormatDateTime($documentos_secciones->fecha->ViewValue, 7);
			$documentos_secciones->fecha->ViewCustomAttributes = "";

			// estatus
			if (strval($documentos_secciones->estatus->CurrentValue) <> "") {
				switch ($documentos_secciones->estatus->CurrentValue) {
					case "1":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(1) <> "" ? $documentos_secciones->estatus->FldTagCaption(1) : $documentos_secciones->estatus->CurrentValue;
						break;
					case "0":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(2) <> "" ? $documentos_secciones->estatus->FldTagCaption(2) : $documentos_secciones->estatus->CurrentValue;
						break;
					default:
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->CurrentValue;
				}
			} else {
				$documentos_secciones->estatus->ViewValue = NULL;
			}
			$documentos_secciones->estatus->ViewCustomAttributes = "";

			// id_documentos
			$documentos_secciones->id_documentos->LinkCustomAttributes = "";
			$documentos_secciones->id_documentos->HrefValue = "";
			$documentos_secciones->id_documentos->TooltipValue = "";

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->LinkCustomAttributes = "";
			$documentos_secciones->id_grupo_sec->HrefValue = "";
			$documentos_secciones->id_grupo_sec->TooltipValue = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->LinkCustomAttributes = "";
			$documentos_secciones->fecha_inicio->HrefValue = "";
			$documentos_secciones->fecha_inicio->TooltipValue = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->LinkCustomAttributes = "";
			$documentos_secciones->fecha_fin->HrefValue = "";
			$documentos_secciones->fecha_fin->TooltipValue = "";

			// fecha
			$documentos_secciones->fecha->LinkCustomAttributes = "";
			$documentos_secciones->fecha->HrefValue = "";
			$documentos_secciones->fecha->TooltipValue = "";

			// estatus
			$documentos_secciones->estatus->LinkCustomAttributes = "";
			$documentos_secciones->estatus->HrefValue = "";
			$documentos_secciones->estatus->TooltipValue = "";
		} elseif ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_documentos
			$documentos_secciones->id_documentos->EditCustomAttributes = "";
			if ($documentos_secciones->id_documentos->getSessionValue() <> "") {
				$documentos_secciones->id_documentos->CurrentValue = $documentos_secciones->id_documentos->getSessionValue();
			if (strval($documentos_secciones->id_documentos->CurrentValue) <> "") {
				$sFilterWrk = "`id_documentos` = " . ew_AdjustSql($documentos_secciones->id_documentos->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `documentos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_documentos->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_documentos->ViewValue = $documentos_secciones->id_documentos->CurrentValue;
				}
			} else {
				$documentos_secciones->id_documentos->ViewValue = NULL;
			}
			$documentos_secciones->id_documentos->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_documentos`, `titulo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `documentos`";
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
			$documentos_secciones->id_documentos->EditValue = $arwrk;
			}

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_grupo_seccion`, `titulo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `view1`";
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
			$documentos_secciones->id_grupo_sec->EditValue = $arwrk;

			// fecha_inicio
			$documentos_secciones->fecha_inicio->EditCustomAttributes = "";
			$documentos_secciones->fecha_inicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7));

			// fecha_fin
			$documentos_secciones->fecha_fin->EditCustomAttributes = "";
			$documentos_secciones->fecha_fin->EditValue = ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7));

			// fecha
			$documentos_secciones->fecha->EditCustomAttributes = "";
			$documentos_secciones->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha->CurrentValue, 7));

			// estatus
			$documentos_secciones->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $documentos_secciones->estatus->FldTagCaption(1) <> "" ? $documentos_secciones->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $documentos_secciones->estatus->FldTagCaption(2) <> "" ? $documentos_secciones->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$documentos_secciones->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_documentos

			$documentos_secciones->id_documentos->HrefValue = "";

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->HrefValue = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->HrefValue = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->HrefValue = "";

			// fecha
			$documentos_secciones->fecha->HrefValue = "";

			// estatus
			$documentos_secciones->estatus->HrefValue = "";
		}
		if ($documentos_secciones->RowType == EW_ROWTYPE_ADD ||
			$documentos_secciones->RowType == EW_ROWTYPE_EDIT ||
			$documentos_secciones->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$documentos_secciones->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($documentos_secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documentos_secciones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $documentos_secciones;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($documentos_secciones->id_documentos->FormValue) && $documentos_secciones->id_documentos->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documentos_secciones->id_documentos->FldCaption());
		}
		if (!is_null($documentos_secciones->id_grupo_sec->FormValue) && $documentos_secciones->id_grupo_sec->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documentos_secciones->id_grupo_sec->FldCaption());
		}
		if (!ew_CheckEuroDate($documentos_secciones->fecha_inicio->FormValue)) {
			ew_AddMessage($gsFormError, $documentos_secciones->fecha_inicio->FldErrMsg());
		}
		if (!ew_CheckEuroDate($documentos_secciones->fecha_fin->FormValue)) {
			ew_AddMessage($gsFormError, $documentos_secciones->fecha_fin->FldErrMsg());
		}
		if (!ew_CheckEuroDate($documentos_secciones->fecha->FormValue)) {
			ew_AddMessage($gsFormError, $documentos_secciones->fecha->FldErrMsg());
		}
		if (!is_null($documentos_secciones->estatus->FormValue) && $documentos_secciones->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documentos_secciones->estatus->FldCaption());
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
		global $conn, $Language, $Security, $documentos_secciones;
		$rsnew = array();

		// id_documentos
		$documentos_secciones->id_documentos->SetDbValueDef($rsnew, $documentos_secciones->id_documentos->CurrentValue, NULL, FALSE);

		// id_grupo_sec
		$documentos_secciones->id_grupo_sec->SetDbValueDef($rsnew, $documentos_secciones->id_grupo_sec->CurrentValue, NULL, FALSE);

		// fecha_inicio
		$documentos_secciones->fecha_inicio->SetDbValueDef($rsnew, ew_UnFormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7), NULL, FALSE);

		// fecha_fin
		$documentos_secciones->fecha_fin->SetDbValueDef($rsnew, ew_UnFormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7), NULL, FALSE);

		// fecha
		$documentos_secciones->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($documentos_secciones->fecha->CurrentValue, 7), NULL, FALSE);

		// estatus
		$documentos_secciones->estatus->SetDbValueDef($rsnew, $documentos_secciones->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $documentos_secciones->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($documentos_secciones->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($documentos_secciones->CancelMessage <> "") {
				$this->setFailureMessage($documentos_secciones->CancelMessage);
				$documentos_secciones->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$documentos_secciones->id_documentos_secciones->setDbValue($conn->Insert_ID());
			$rsnew['id_documentos_secciones'] = $documentos_secciones->id_documentos_secciones->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$documentos_secciones->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $documentos_secciones;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "documentos") {
				$bValidMaster = TRUE;
				if (@$_GET["id_documentos"] <> "") {
					$GLOBALS["documentos"]->id_documentos->setQueryStringValue($_GET["id_documentos"]);
					$documentos_secciones->id_documentos->setQueryStringValue($GLOBALS["documentos"]->id_documentos->QueryStringValue);
					$documentos_secciones->id_documentos->setSessionValue($documentos_secciones->id_documentos->QueryStringValue);
					if (!is_numeric($GLOBALS["documentos"]->id_documentos->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$documentos_secciones->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$documentos_secciones->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "documentos") {
				if ($documentos_secciones->id_documentos->QueryStringValue == "") $documentos_secciones->id_documentos->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $documentos_secciones->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $documentos_secciones->getDetailFilter(); // Get detail filter
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'documentos_secciones';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $documentos_secciones;
		$table = 'documentos_secciones';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_documentos_secciones'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($documentos_secciones->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
