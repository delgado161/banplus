<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "respuestasinfo.php" ?>
<?php include_once "preguntasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$respuestas_add = new crespuestas_add();
$Page =& $respuestas_add;

// Page init
$respuestas_add->Page_Init();

// Page main
$respuestas_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var respuestas_add = new ew_Page("respuestas_add");

// page properties
respuestas_add.PageID = "add"; // page ID
respuestas_add.FormID = "frespuestasadd"; // form ID
var EW_PAGE_ID = respuestas_add.PageID; // for backward compatibility

// extend page with ValidateForm function
respuestas_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_respuesta"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($respuestas->respuesta->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($respuestas->orden->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($respuestas->estatus->FldCaption()) ?>");

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
respuestas_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
respuestas_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
respuestas_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $respuestas->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $respuestas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $respuestas_add->ShowPageHeader(); ?>
<?php
$respuestas_add->ShowMessage();
?>
<form name="frespuestasadd" id="frespuestasadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return respuestas_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="respuestas">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($respuestas->id_pregunta->Visible) { // id_pregunta ?>
	<tr id="r_id_pregunta"<?php echo $respuestas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $respuestas->id_pregunta->FldCaption() ?></td>
		<td<?php echo $respuestas->id_pregunta->CellAttributes() ?>><span id="el_id_pregunta">
<?php if ($respuestas->id_pregunta->getSessionValue() <> "") { ?>
<div<?php echo $respuestas->id_pregunta->ViewAttributes() ?>><?php echo $respuestas->id_pregunta->ViewValue ?></div>
<input type="hidden" id="x_id_pregunta" name="x_id_pregunta" value="<?php echo ew_HtmlEncode($respuestas->id_pregunta->CurrentValue) ?>">
<?php } else { ?>
<select id="x_id_pregunta" name="x_id_pregunta"<?php echo $respuestas->id_pregunta->EditAttributes() ?>>
<?php
if (is_array($respuestas->id_pregunta->EditValue)) {
	$arwrk = $respuestas->id_pregunta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($respuestas->id_pregunta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $respuestas->id_pregunta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($respuestas->respuesta->Visible) { // respuesta ?>
	<tr id="r_respuesta"<?php echo $respuestas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $respuestas->respuesta->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $respuestas->respuesta->CellAttributes() ?>><span id="el_respuesta">
<input type="text" name="x_respuesta" id="x_respuesta" size="50" maxlength="50" value="<?php echo $respuestas->respuesta->EditValue ?>"<?php echo $respuestas->respuesta->EditAttributes() ?>>
</span><?php echo $respuestas->respuesta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($respuestas->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $respuestas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $respuestas->orden->FldCaption() ?></td>
		<td<?php echo $respuestas->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" size="3" value="<?php echo $respuestas->orden->EditValue ?>"<?php echo $respuestas->orden->EditAttributes() ?>>
</span><?php echo $respuestas->orden->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($respuestas->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $respuestas->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $respuestas->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $respuestas->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $respuestas->estatus->EditAttributes() ?>>
<?php
if (is_array($respuestas->estatus->EditValue)) {
	$arwrk = $respuestas->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($respuestas->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $respuestas->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$respuestas_add->ShowPageFooter();
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
$respuestas_add->Page_Terminate();
?>
<?php

//
// Page class
//
class crespuestas_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'respuestas';

	// Page object name
	var $PageObjName = 'respuestas_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $respuestas;
		if ($respuestas->UseTokenInUrl) $PageUrl .= "t=" . $respuestas->TableVar . "&"; // Add page token
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
		global $objForm, $respuestas;
		if ($respuestas->UseTokenInUrl) {
			if ($objForm)
				return ($respuestas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($respuestas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crespuestas_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (respuestas)
		if (!isset($GLOBALS["respuestas"])) {
			$GLOBALS["respuestas"] = new crespuestas();
			$GLOBALS["Table"] =& $GLOBALS["respuestas"];
		}

		// Table object (preguntas)
		if (!isset($GLOBALS['preguntas'])) $GLOBALS['preguntas'] = new cpreguntas();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'respuestas', TRUE);

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
		global $respuestas;

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
			$this->Page_Terminate("respuestaslist.php");
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
		global $objForm, $Language, $gsFormError, $respuestas;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$respuestas->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$respuestas->CurrentAction = "I"; // Form error, reset action
				$respuestas->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_respuestas"] != "") {
				$respuestas->id_respuestas->setQueryStringValue($_GET["id_respuestas"]);
				$respuestas->setKey("id_respuestas", $respuestas->id_respuestas->CurrentValue); // Set up key
			} else {
				$respuestas->setKey("id_respuestas", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$respuestas->CurrentAction = "C"; // Copy record
			} else {
				$respuestas->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($respuestas->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("respuestaslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$respuestas->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $respuestas->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "respuestasview.php")
						$sReturnUrl = $respuestas->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$respuestas->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$respuestas->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$respuestas->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $respuestas;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $respuestas;
		$respuestas->id_pregunta->CurrentValue = NULL;
		$respuestas->id_pregunta->OldValue = $respuestas->id_pregunta->CurrentValue;
		$respuestas->respuesta->CurrentValue = NULL;
		$respuestas->respuesta->OldValue = $respuestas->respuesta->CurrentValue;
		$respuestas->orden->CurrentValue = NULL;
		$respuestas->orden->OldValue = $respuestas->orden->CurrentValue;
		$respuestas->estatus->CurrentValue = NULL;
		$respuestas->estatus->OldValue = $respuestas->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $respuestas;
		if (!$respuestas->id_pregunta->FldIsDetailKey) {
			$respuestas->id_pregunta->setFormValue($objForm->GetValue("x_id_pregunta"));
		}
		if (!$respuestas->respuesta->FldIsDetailKey) {
			$respuestas->respuesta->setFormValue($objForm->GetValue("x_respuesta"));
		}
		if (!$respuestas->orden->FldIsDetailKey) {
			$respuestas->orden->setFormValue($objForm->GetValue("x_orden"));
		}
		if (!$respuestas->estatus->FldIsDetailKey) {
			$respuestas->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $respuestas;
		$this->LoadOldRecord();
		$respuestas->id_pregunta->CurrentValue = $respuestas->id_pregunta->FormValue;
		$respuestas->respuesta->CurrentValue = $respuestas->respuesta->FormValue;
		$respuestas->orden->CurrentValue = $respuestas->orden->FormValue;
		$respuestas->estatus->CurrentValue = $respuestas->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $respuestas;
		$sFilter = $respuestas->KeyFilter();

		// Call Row Selecting event
		$respuestas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$respuestas->CurrentFilter = $sFilter;
		$sSql = $respuestas->SQL();
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
		global $conn, $respuestas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$respuestas->Row_Selected($row);
		$respuestas->id_respuestas->setDbValue($rs->fields('id_respuestas'));
		$respuestas->id_pregunta->setDbValue($rs->fields('id_pregunta'));
		$respuestas->respuesta->setDbValue($rs->fields('respuesta'));
		$respuestas->contador->setDbValue($rs->fields('contador'));
		$respuestas->orden->setDbValue($rs->fields('orden'));
		$respuestas->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $respuestas;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($respuestas->getKey("id_respuestas")) <> "")
			$respuestas->id_respuestas->CurrentValue = $respuestas->getKey("id_respuestas"); // id_respuestas
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$respuestas->CurrentFilter = $respuestas->KeyFilter();
			$sSql = $respuestas->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $respuestas;

		// Initialize URLs
		// Call Row_Rendering event

		$respuestas->Row_Rendering();

		// Common render codes for all row types
		// id_respuestas
		// id_pregunta
		// respuesta
		// contador
		// orden
		// estatus

		if ($respuestas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_pregunta
			if (strval($respuestas->id_pregunta->CurrentValue) <> "") {
				$sFilterWrk = "`id_pregunta` = " . ew_AdjustSql($respuestas->id_pregunta->CurrentValue) . "";
			$sSqlWrk = "SELECT `pregunta` FROM `preguntas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$respuestas->id_pregunta->ViewValue = $rswrk->fields('pregunta');
					$rswrk->Close();
				} else {
					$respuestas->id_pregunta->ViewValue = $respuestas->id_pregunta->CurrentValue;
				}
			} else {
				$respuestas->id_pregunta->ViewValue = NULL;
			}
			$respuestas->id_pregunta->ViewCustomAttributes = "";

			// respuesta
			$respuestas->respuesta->ViewValue = $respuestas->respuesta->CurrentValue;
			$respuestas->respuesta->ViewCustomAttributes = "";

			// contador
			$respuestas->contador->ViewValue = $respuestas->contador->CurrentValue;
			$respuestas->contador->ViewCustomAttributes = "";

			// orden
			$respuestas->orden->ViewValue = $respuestas->orden->CurrentValue;
			$respuestas->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($respuestas->estatus->CurrentValue) <> "") {
				switch ($respuestas->estatus->CurrentValue) {
					case "1":
						$respuestas->estatus->ViewValue = $respuestas->estatus->FldTagCaption(1) <> "" ? $respuestas->estatus->FldTagCaption(1) : $respuestas->estatus->CurrentValue;
						break;
					case "0":
						$respuestas->estatus->ViewValue = $respuestas->estatus->FldTagCaption(2) <> "" ? $respuestas->estatus->FldTagCaption(2) : $respuestas->estatus->CurrentValue;
						break;
					default:
						$respuestas->estatus->ViewValue = $respuestas->estatus->CurrentValue;
				}
			} else {
				$respuestas->estatus->ViewValue = NULL;
			}
			$respuestas->estatus->ViewCustomAttributes = "";

			// id_pregunta
			$respuestas->id_pregunta->LinkCustomAttributes = "";
			$respuestas->id_pregunta->HrefValue = "";
			$respuestas->id_pregunta->TooltipValue = "";

			// respuesta
			$respuestas->respuesta->LinkCustomAttributes = "";
			$respuestas->respuesta->HrefValue = "";
			$respuestas->respuesta->TooltipValue = "";

			// orden
			$respuestas->orden->LinkCustomAttributes = "";
			$respuestas->orden->HrefValue = "";
			$respuestas->orden->TooltipValue = "";

			// estatus
			$respuestas->estatus->LinkCustomAttributes = "";
			$respuestas->estatus->HrefValue = "";
			$respuestas->estatus->TooltipValue = "";
		} elseif ($respuestas->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_pregunta
			$respuestas->id_pregunta->EditCustomAttributes = "";
			if ($respuestas->id_pregunta->getSessionValue() <> "") {
				$respuestas->id_pregunta->CurrentValue = $respuestas->id_pregunta->getSessionValue();
			if (strval($respuestas->id_pregunta->CurrentValue) <> "") {
				$sFilterWrk = "`id_pregunta` = " . ew_AdjustSql($respuestas->id_pregunta->CurrentValue) . "";
			$sSqlWrk = "SELECT `pregunta` FROM `preguntas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$respuestas->id_pregunta->ViewValue = $rswrk->fields('pregunta');
					$rswrk->Close();
				} else {
					$respuestas->id_pregunta->ViewValue = $respuestas->id_pregunta->CurrentValue;
				}
			} else {
				$respuestas->id_pregunta->ViewValue = NULL;
			}
			$respuestas->id_pregunta->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_pregunta`, `pregunta` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `preguntas`";
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
			$respuestas->id_pregunta->EditValue = $arwrk;
			}

			// respuesta
			$respuestas->respuesta->EditCustomAttributes = "";
			$respuestas->respuesta->EditValue = ew_HtmlEncode($respuestas->respuesta->CurrentValue);

			// orden
			$respuestas->orden->EditCustomAttributes = "";
			$respuestas->orden->EditValue = ew_HtmlEncode($respuestas->orden->CurrentValue);

			// estatus
			$respuestas->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $respuestas->estatus->FldTagCaption(1) <> "" ? $respuestas->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $respuestas->estatus->FldTagCaption(2) <> "" ? $respuestas->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$respuestas->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_pregunta

			$respuestas->id_pregunta->HrefValue = "";

			// respuesta
			$respuestas->respuesta->HrefValue = "";

			// orden
			$respuestas->orden->HrefValue = "";

			// estatus
			$respuestas->estatus->HrefValue = "";
		}
		if ($respuestas->RowType == EW_ROWTYPE_ADD ||
			$respuestas->RowType == EW_ROWTYPE_EDIT ||
			$respuestas->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$respuestas->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($respuestas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$respuestas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $respuestas;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($respuestas->respuesta->FormValue) && $respuestas->respuesta->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $respuestas->respuesta->FldCaption());
		}
		if (!ew_CheckInteger($respuestas->orden->FormValue)) {
			ew_AddMessage($gsFormError, $respuestas->orden->FldErrMsg());
		}
		if (!is_null($respuestas->estatus->FormValue) && $respuestas->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $respuestas->estatus->FldCaption());
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
		global $conn, $Language, $Security, $respuestas;
		$rsnew = array();

		// id_pregunta
		$respuestas->id_pregunta->SetDbValueDef($rsnew, $respuestas->id_pregunta->CurrentValue, NULL, FALSE);

		// respuesta
		$respuestas->respuesta->SetDbValueDef($rsnew, $respuestas->respuesta->CurrentValue, NULL, FALSE);

		// orden
		$respuestas->orden->SetDbValueDef($rsnew, $respuestas->orden->CurrentValue, NULL, FALSE);

		// estatus
		$respuestas->estatus->SetDbValueDef($rsnew, $respuestas->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $respuestas->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($respuestas->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($respuestas->CancelMessage <> "") {
				$this->setFailureMessage($respuestas->CancelMessage);
				$respuestas->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$respuestas->id_respuestas->setDbValue($conn->Insert_ID());
			$rsnew['id_respuestas'] = $respuestas->id_respuestas->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$respuestas->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $respuestas;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "preguntas") {
				$bValidMaster = TRUE;
				if (@$_GET["id_pregunta"] <> "") {
					$GLOBALS["preguntas"]->id_pregunta->setQueryStringValue($_GET["id_pregunta"]);
					$respuestas->id_pregunta->setQueryStringValue($GLOBALS["preguntas"]->id_pregunta->QueryStringValue);
					$respuestas->id_pregunta->setSessionValue($respuestas->id_pregunta->QueryStringValue);
					if (!is_numeric($GLOBALS["preguntas"]->id_pregunta->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$respuestas->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$respuestas->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "preguntas") {
				if ($respuestas->id_pregunta->QueryStringValue == "") $respuestas->id_pregunta->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $respuestas->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $respuestas->getDetailFilter(); // Get detail filter
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'respuestas';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $respuestas;
		$table = 'respuestas';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_respuestas'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($respuestas->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
