<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "preguntasinfo.php" ?>
<?php include_once "encuestainfo.php" ?>
<?php include_once "respuestasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "respuestasgridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$preguntas_edit = new cpreguntas_edit();
$Page =& $preguntas_edit;

// Page init
$preguntas_edit->Page_Init();

// Page main
$preguntas_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var preguntas_edit = new ew_Page("preguntas_edit");

// page properties
preguntas_edit.PageID = "edit"; // page ID
preguntas_edit.FormID = "fpreguntasedit"; // form ID
var EW_PAGE_ID = preguntas_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
preguntas_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_pregunta"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($preguntas->pregunta->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($preguntas->estatus->FldCaption()) ?>");

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
preguntas_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
preguntas_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
preguntas_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 20;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {			
		var inst;			
		for (inst in CKEDITOR.instances)
			CKEDITOR.instances[inst].updateElement();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];		
		if (inst)
			inst.setData(inst.element.value);
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];	
		if (inst)
			inst.focus();
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $preguntas->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $preguntas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $preguntas_edit->ShowPageHeader(); ?>
<?php
$preguntas_edit->ShowMessage();
?>
<form name="fpreguntasedit" id="fpreguntasedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return preguntas_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="preguntas">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($preguntas->id_encuesta->Visible) { // id_encuesta ?>
	<tr id="r_id_encuesta"<?php echo $preguntas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $preguntas->id_encuesta->FldCaption() ?></td>
		<td<?php echo $preguntas->id_encuesta->CellAttributes() ?>><span id="el_id_encuesta">
<?php if ($preguntas->id_encuesta->getSessionValue() <> "") { ?>
<div<?php echo $preguntas->id_encuesta->ViewAttributes() ?>><?php echo $preguntas->id_encuesta->ViewValue ?></div>
<input type="hidden" id="x_id_encuesta" name="x_id_encuesta" value="<?php echo ew_HtmlEncode($preguntas->id_encuesta->CurrentValue) ?>">
<?php } else { ?>
<select id="x_id_encuesta" name="x_id_encuesta"<?php echo $preguntas->id_encuesta->EditAttributes() ?>>
<?php
if (is_array($preguntas->id_encuesta->EditValue)) {
	$arwrk = $preguntas->id_encuesta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($preguntas->id_encuesta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $preguntas->id_encuesta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($preguntas->pregunta->Visible) { // pregunta ?>
	<tr id="r_pregunta"<?php echo $preguntas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $preguntas->pregunta->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $preguntas->pregunta->CellAttributes() ?>><span id="el_pregunta">
<textarea name="x_pregunta" id="x_pregunta" cols="0" rows="5"<?php echo $preguntas->pregunta->EditAttributes() ?>><?php echo $preguntas->pregunta->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($preguntas->pregunta->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x_pregunta', 0*_width_multiplier, 5*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x_pregunta", function() {
	var oCKeditor = CKEDITOR.replace('x_pregunta', { width: 0*_width_multiplier, height: 5*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
</span><?php echo $preguntas->pregunta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($preguntas->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $preguntas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $preguntas->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $preguntas->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $preguntas->estatus->EditAttributes() ?>>
<?php
if (is_array($preguntas->estatus->EditValue)) {
	$arwrk = $preguntas->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($preguntas->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $preguntas->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_pregunta" id="x_id_pregunta" value="<?php echo ew_HtmlEncode($preguntas->id_pregunta->CurrentValue) ?>">
<p>
<?php if ($preguntas->getCurrentDetailTable() == "respuestas" && $respuestas->DetailEdit) { ?>
<br>
<?php include_once "respuestasgrid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$preguntas_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$preguntas_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cpreguntas_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'preguntas';

	// Page object name
	var $PageObjName = 'preguntas_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $preguntas;
		if ($preguntas->UseTokenInUrl) $PageUrl .= "t=" . $preguntas->TableVar . "&"; // Add page token
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
		global $objForm, $preguntas;
		if ($preguntas->UseTokenInUrl) {
			if ($objForm)
				return ($preguntas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($preguntas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpreguntas_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (preguntas)
		if (!isset($GLOBALS["preguntas"])) {
			$GLOBALS["preguntas"] = new cpreguntas();
			$GLOBALS["Table"] =& $GLOBALS["preguntas"];
		}

		// Table object (encuesta)
		if (!isset($GLOBALS['encuesta'])) $GLOBALS['encuesta'] = new cencuesta();

		// Table object (respuestas)
		if (!isset($GLOBALS['respuestas'])) $GLOBALS['respuestas'] = new crespuestas();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'preguntas', TRUE);

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
		global $preguntas;

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
			$this->Page_Terminate("preguntaslist.php");
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
		global $objForm, $Language, $gsFormError, $preguntas;

		// Load key from QueryString
		if (@$_GET["id_pregunta"] <> "")
			$preguntas->id_pregunta->setQueryStringValue($_GET["id_pregunta"]);

		// Set up master detail parameters
		$this->SetUpMasterParms();
		if (@$_POST["a_edit"] <> "") {
			$preguntas->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$preguntas->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$preguntas->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$preguntas->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($preguntas->id_pregunta->CurrentValue == "")
			$this->Page_Terminate("preguntaslist.php"); // Invalid key, return to list

		// Set up detail parameters
		$this->SetUpDetailParms();
		switch ($preguntas->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("preguntaslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$preguntas->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					if ($preguntas->getCurrentDetailTable() <> "") // Master/detail edit
						$sReturnUrl = $preguntas->getDetailUrl();
					else
						$sReturnUrl = $preguntas->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$preguntas->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$preguntas->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$preguntas->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $preguntas;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $preguntas;
		if (!$preguntas->id_encuesta->FldIsDetailKey) {
			$preguntas->id_encuesta->setFormValue($objForm->GetValue("x_id_encuesta"));
		}
		if (!$preguntas->pregunta->FldIsDetailKey) {
			$preguntas->pregunta->setFormValue($objForm->GetValue("x_pregunta"));
		}
		if (!$preguntas->estatus->FldIsDetailKey) {
			$preguntas->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$preguntas->id_pregunta->FldIsDetailKey)
			$preguntas->id_pregunta->setFormValue($objForm->GetValue("x_id_pregunta"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $preguntas;
		$this->LoadRow();
		$preguntas->id_pregunta->CurrentValue = $preguntas->id_pregunta->FormValue;
		$preguntas->id_encuesta->CurrentValue = $preguntas->id_encuesta->FormValue;
		$preguntas->pregunta->CurrentValue = $preguntas->pregunta->FormValue;
		$preguntas->estatus->CurrentValue = $preguntas->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $preguntas;
		$sFilter = $preguntas->KeyFilter();

		// Call Row Selecting event
		$preguntas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$preguntas->CurrentFilter = $sFilter;
		$sSql = $preguntas->SQL();
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
		global $conn, $preguntas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$preguntas->Row_Selected($row);
		$preguntas->id_pregunta->setDbValue($rs->fields('id_pregunta'));
		$preguntas->id_encuesta->setDbValue($rs->fields('id_encuesta'));
		$preguntas->pregunta->setDbValue($rs->fields('pregunta'));
		$preguntas->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $preguntas;

		// Initialize URLs
		// Call Row_Rendering event

		$preguntas->Row_Rendering();

		// Common render codes for all row types
		// id_pregunta
		// id_encuesta
		// pregunta
		// estatus

		if ($preguntas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_encuesta
			if (strval($preguntas->id_encuesta->CurrentValue) <> "") {
				$sFilterWrk = "`id_encuesta` = " . ew_AdjustSql($preguntas->id_encuesta->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `encuesta`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$preguntas->id_encuesta->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$preguntas->id_encuesta->ViewValue = $preguntas->id_encuesta->CurrentValue;
				}
			} else {
				$preguntas->id_encuesta->ViewValue = NULL;
			}
			$preguntas->id_encuesta->ViewCustomAttributes = "";

			// pregunta
			$preguntas->pregunta->ViewValue = $preguntas->pregunta->CurrentValue;
			$preguntas->pregunta->ViewCustomAttributes = "";

			// estatus
			if (strval($preguntas->estatus->CurrentValue) <> "") {
				switch ($preguntas->estatus->CurrentValue) {
					case "1":
						$preguntas->estatus->ViewValue = $preguntas->estatus->FldTagCaption(1) <> "" ? $preguntas->estatus->FldTagCaption(1) : $preguntas->estatus->CurrentValue;
						break;
					case "0":
						$preguntas->estatus->ViewValue = $preguntas->estatus->FldTagCaption(2) <> "" ? $preguntas->estatus->FldTagCaption(2) : $preguntas->estatus->CurrentValue;
						break;
					default:
						$preguntas->estatus->ViewValue = $preguntas->estatus->CurrentValue;
				}
			} else {
				$preguntas->estatus->ViewValue = NULL;
			}
			$preguntas->estatus->ViewCustomAttributes = "";

			// id_encuesta
			$preguntas->id_encuesta->LinkCustomAttributes = "";
			$preguntas->id_encuesta->HrefValue = "";
			$preguntas->id_encuesta->TooltipValue = "";

			// pregunta
			$preguntas->pregunta->LinkCustomAttributes = "";
			$preguntas->pregunta->HrefValue = "";
			$preguntas->pregunta->TooltipValue = "";

			// estatus
			$preguntas->estatus->LinkCustomAttributes = "";
			$preguntas->estatus->HrefValue = "";
			$preguntas->estatus->TooltipValue = "";
		} elseif ($preguntas->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_encuesta
			$preguntas->id_encuesta->EditCustomAttributes = "";
			if ($preguntas->id_encuesta->getSessionValue() <> "") {
				$preguntas->id_encuesta->CurrentValue = $preguntas->id_encuesta->getSessionValue();
			if (strval($preguntas->id_encuesta->CurrentValue) <> "") {
				$sFilterWrk = "`id_encuesta` = " . ew_AdjustSql($preguntas->id_encuesta->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `encuesta`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$preguntas->id_encuesta->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$preguntas->id_encuesta->ViewValue = $preguntas->id_encuesta->CurrentValue;
				}
			} else {
				$preguntas->id_encuesta->ViewValue = NULL;
			}
			$preguntas->id_encuesta->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_encuesta`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `encuesta`";
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
			$preguntas->id_encuesta->EditValue = $arwrk;
			}

			// pregunta
			$preguntas->pregunta->EditCustomAttributes = "";
			$preguntas->pregunta->EditValue = ew_HtmlEncode($preguntas->pregunta->CurrentValue);

			// estatus
			$preguntas->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $preguntas->estatus->FldTagCaption(1) <> "" ? $preguntas->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $preguntas->estatus->FldTagCaption(2) <> "" ? $preguntas->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$preguntas->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_encuesta

			$preguntas->id_encuesta->HrefValue = "";

			// pregunta
			$preguntas->pregunta->HrefValue = "";

			// estatus
			$preguntas->estatus->HrefValue = "";
		}
		if ($preguntas->RowType == EW_ROWTYPE_ADD ||
			$preguntas->RowType == EW_ROWTYPE_EDIT ||
			$preguntas->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$preguntas->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($preguntas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$preguntas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $preguntas;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($preguntas->pregunta->FormValue) && $preguntas->pregunta->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $preguntas->pregunta->FldCaption());
		}
		if (!is_null($preguntas->estatus->FormValue) && $preguntas->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $preguntas->estatus->FldCaption());
		}

		// Validate detail grid
		if ($preguntas->getCurrentDetailTable() == "respuestas" && $GLOBALS["respuestas"]->DetailEdit) {
			$respuestas_grid = new crespuestas_grid(); // get detail page object
			$respuestas_grid->ValidateGridForm();
			$respuestas_grid = NULL;
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
		global $conn, $Security, $Language, $preguntas;
		$sFilter = $preguntas->KeyFilter();
		$preguntas->CurrentFilter = $sFilter;
		$sSql = $preguntas->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($preguntas->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// id_encuesta
			$preguntas->id_encuesta->SetDbValueDef($rsnew, $preguntas->id_encuesta->CurrentValue, NULL, $preguntas->id_encuesta->ReadOnly);

			// pregunta
			$preguntas->pregunta->SetDbValueDef($rsnew, $preguntas->pregunta->CurrentValue, NULL, $preguntas->pregunta->ReadOnly);

			// estatus
			$preguntas->estatus->SetDbValueDef($rsnew, $preguntas->estatus->CurrentValue, NULL, $preguntas->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $preguntas->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($preguntas->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';

				// Update detail records
				if ($EditRow) {
					if ($preguntas->getCurrentDetailTable() == "respuestas" && $GLOBALS["respuestas"]->DetailEdit) {
						$respuestas_grid = new crespuestas_grid(); // get detail page object
						$EditRow = $respuestas_grid->GridUpdate();
						$respuestas_grid = NULL;
					}
				}

				// Commit/Rollback transaction
				if ($preguntas->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($preguntas->CancelMessage <> "") {
					$this->setFailureMessage($preguntas->CancelMessage);
					$preguntas->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$preguntas->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $preguntas;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "encuesta") {
				$bValidMaster = TRUE;
				if (@$_GET["id_encuesta"] <> "") {
					$GLOBALS["encuesta"]->id_encuesta->setQueryStringValue($_GET["id_encuesta"]);
					$preguntas->id_encuesta->setQueryStringValue($GLOBALS["encuesta"]->id_encuesta->QueryStringValue);
					$preguntas->id_encuesta->setSessionValue($preguntas->id_encuesta->QueryStringValue);
					if (!is_numeric($GLOBALS["encuesta"]->id_encuesta->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$preguntas->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$preguntas->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "encuesta") {
				if ($preguntas->id_encuesta->QueryStringValue == "") $preguntas->id_encuesta->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $preguntas->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $preguntas->getDetailFilter(); // Get detail filter
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $preguntas;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$preguntas->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $preguntas->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "respuestas") {
				if (!isset($GLOBALS["respuestas"]))
					$GLOBALS["respuestas"] = new crespuestas;
				if ($GLOBALS["respuestas"]->DetailEdit) {
					$GLOBALS["respuestas"]->CurrentMode = "edit";
					$GLOBALS["respuestas"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["respuestas"]->setCurrentMasterTable($preguntas->TableVar);
					$GLOBALS["respuestas"]->setStartRecordNumber(1);
					$GLOBALS["respuestas"]->id_pregunta->FldIsDetailKey = TRUE;
					$GLOBALS["respuestas"]->id_pregunta->CurrentValue = $preguntas->id_pregunta->CurrentValue;
					$GLOBALS["respuestas"]->id_pregunta->setSessionValue($GLOBALS["respuestas"]->id_pregunta->CurrentValue);
				}
			}
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'preguntas';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $preguntas;
		$table = 'preguntas';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_pregunta'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($preguntas->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($preguntas->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($preguntas->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($preguntas->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
