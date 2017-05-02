<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "encuestainfo.php" ?>
<?php include_once "preguntasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "preguntasgridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$encuesta_edit = new cencuesta_edit();
$Page =& $encuesta_edit;

// Page init
$encuesta_edit->Page_Init();

// Page main
$encuesta_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var encuesta_edit = new ew_Page("encuesta_edit");

// page properties
encuesta_edit.PageID = "edit"; // page ID
encuesta_edit.FormID = "fencuestaedit"; // form ID
var EW_PAGE_ID = encuesta_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
encuesta_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($encuesta->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($encuesta->estatus->FldCaption()) ?>");

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
encuesta_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
encuesta_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
encuesta_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $encuesta->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $encuesta->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $encuesta_edit->ShowPageHeader(); ?>
<?php
$encuesta_edit->ShowMessage();
?>
<form name="fencuestaedit" id="fencuestaedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return encuesta_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="encuesta">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($encuesta->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $encuesta->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $encuesta->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $encuesta->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="45" maxlength="45" value="<?php echo $encuesta->nombre->EditValue ?>"<?php echo $encuesta->nombre->EditAttributes() ?>>
</span><?php echo $encuesta->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($encuesta->id_grupo->Visible) { // id_grupo ?>
	<tr id="r_id_grupo"<?php echo $encuesta->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $encuesta->id_grupo->FldCaption() ?></td>
		<td<?php echo $encuesta->id_grupo->CellAttributes() ?>><span id="el_id_grupo">
<select id="x_id_grupo[]" name="x_id_grupo[]" size=5 multiple="multiple"<?php echo $encuesta->id_grupo->EditAttributes() ?>>
<?php
if (is_array($encuesta->id_grupo->EditValue)) {
	$arwrk = $encuesta->id_grupo->EditValue;
	$armultiwrk= explode(",", strval($encuesta->id_grupo->CurrentValue));
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		$cnt = count($armultiwrk);
		for ($ari = 0; $ari < $cnt; $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " selected=\"selected\"";
				if ($selwrk <> "") $emptywrk = FALSE;
				break;
			}
		}	
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $encuesta->id_grupo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($encuesta->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $encuesta->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $encuesta->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $encuesta->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $encuesta->estatus->EditAttributes() ?>>
<?php
if (is_array($encuesta->estatus->EditValue)) {
	$arwrk = $encuesta->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($encuesta->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $encuesta->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_encuesta" id="x_id_encuesta" value="<?php echo ew_HtmlEncode($encuesta->id_encuesta->CurrentValue) ?>">
<p>
<?php if ($encuesta->getCurrentDetailTable() == "preguntas" && $preguntas->DetailEdit) { ?>
<br>
<?php include_once "preguntasgrid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$encuesta_edit->ShowPageFooter();
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
$encuesta_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cencuesta_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'encuesta';

	// Page object name
	var $PageObjName = 'encuesta_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $encuesta;
		if ($encuesta->UseTokenInUrl) $PageUrl .= "t=" . $encuesta->TableVar . "&"; // Add page token
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
		global $objForm, $encuesta;
		if ($encuesta->UseTokenInUrl) {
			if ($objForm)
				return ($encuesta->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($encuesta->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cencuesta_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (encuesta)
		if (!isset($GLOBALS["encuesta"])) {
			$GLOBALS["encuesta"] = new cencuesta();
			$GLOBALS["Table"] =& $GLOBALS["encuesta"];
		}

		// Table object (preguntas)
		if (!isset($GLOBALS['preguntas'])) $GLOBALS['preguntas'] = new cpreguntas();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'encuesta', TRUE);

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
		global $encuesta;

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
			$this->Page_Terminate("encuestalist.php");
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
		global $objForm, $Language, $gsFormError, $encuesta;

		// Load key from QueryString
		if (@$_GET["id_encuesta"] <> "")
			$encuesta->id_encuesta->setQueryStringValue($_GET["id_encuesta"]);
		if (@$_POST["a_edit"] <> "") {
			$encuesta->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$encuesta->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$encuesta->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$encuesta->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($encuesta->id_encuesta->CurrentValue == "")
			$this->Page_Terminate("encuestalist.php"); // Invalid key, return to list

		// Set up detail parameters
		$this->SetUpDetailParms();
		switch ($encuesta->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("encuestalist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$encuesta->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					if ($encuesta->getCurrentDetailTable() <> "") // Master/detail edit
						$sReturnUrl = $encuesta->getDetailUrl();
					else
						$sReturnUrl = $encuesta->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$encuesta->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$encuesta->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$encuesta->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $encuesta;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $encuesta;
		if (!$encuesta->nombre->FldIsDetailKey) {
			$encuesta->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$encuesta->id_grupo->FldIsDetailKey) {
			$encuesta->id_grupo->setFormValue($objForm->GetValue("x_id_grupo"));
		}
		if (!$encuesta->estatus->FldIsDetailKey) {
			$encuesta->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$encuesta->id_encuesta->FldIsDetailKey)
			$encuesta->id_encuesta->setFormValue($objForm->GetValue("x_id_encuesta"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $encuesta;
		$this->LoadRow();
		$encuesta->id_encuesta->CurrentValue = $encuesta->id_encuesta->FormValue;
		$encuesta->nombre->CurrentValue = $encuesta->nombre->FormValue;
		$encuesta->id_grupo->CurrentValue = $encuesta->id_grupo->FormValue;
		$encuesta->estatus->CurrentValue = $encuesta->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $encuesta;
		$sFilter = $encuesta->KeyFilter();

		// Call Row Selecting event
		$encuesta->Row_Selecting($sFilter);

		// Load SQL based on filter
		$encuesta->CurrentFilter = $sFilter;
		$sSql = $encuesta->SQL();
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
		global $conn, $encuesta;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$encuesta->Row_Selected($row);
		$encuesta->id_encuesta->setDbValue($rs->fields('id_encuesta'));
		$encuesta->nombre->setDbValue($rs->fields('nombre'));
		$encuesta->id_grupo->setDbValue($rs->fields('id_grupo'));
		$encuesta->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $encuesta;

		// Initialize URLs
		// Call Row_Rendering event

		$encuesta->Row_Rendering();

		// Common render codes for all row types
		// id_encuesta
		// nombre
		// id_grupo
		// estatus

		if ($encuesta->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$encuesta->nombre->ViewValue = $encuesta->nombre->CurrentValue;
			$encuesta->nombre->ViewCustomAttributes = "";

			// id_grupo
			if (strval($encuesta->id_grupo->CurrentValue) <> "") {
				$arwrk = explode(",", $encuesta->id_grupo->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_grupo` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is NULL";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$encuesta->id_grupo->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$encuesta->id_grupo->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $encuesta->id_grupo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$encuesta->id_grupo->ViewValue = $encuesta->id_grupo->CurrentValue;
				}
			} else {
				$encuesta->id_grupo->ViewValue = NULL;
			}
			$encuesta->id_grupo->ViewCustomAttributes = "";

			// estatus
			if (strval($encuesta->estatus->CurrentValue) <> "") {
				switch ($encuesta->estatus->CurrentValue) {
					case "1":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(1) <> "" ? $encuesta->estatus->FldTagCaption(1) : $encuesta->estatus->CurrentValue;
						break;
					case "0":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(2) <> "" ? $encuesta->estatus->FldTagCaption(2) : $encuesta->estatus->CurrentValue;
						break;
					case "3":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(3) <> "" ? $encuesta->estatus->FldTagCaption(3) : $encuesta->estatus->CurrentValue;
						break;
					case "4":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(4) <> "" ? $encuesta->estatus->FldTagCaption(4) : $encuesta->estatus->CurrentValue;
						break;
					default:
						$encuesta->estatus->ViewValue = $encuesta->estatus->CurrentValue;
				}
			} else {
				$encuesta->estatus->ViewValue = NULL;
			}
			$encuesta->estatus->ViewCustomAttributes = "";

			// nombre
			$encuesta->nombre->LinkCustomAttributes = "";
			$encuesta->nombre->HrefValue = "";
			$encuesta->nombre->TooltipValue = "";

			// id_grupo
			$encuesta->id_grupo->LinkCustomAttributes = "";
			$encuesta->id_grupo->HrefValue = "";
			$encuesta->id_grupo->TooltipValue = "";

			// estatus
			$encuesta->estatus->LinkCustomAttributes = "";
			$encuesta->estatus->HrefValue = "";
			$encuesta->estatus->TooltipValue = "";
		} elseif ($encuesta->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$encuesta->nombre->EditCustomAttributes = "";
			$encuesta->nombre->EditValue = ew_HtmlEncode($encuesta->nombre->CurrentValue);

			// id_grupo
			$encuesta->id_grupo->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_grupo`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is NULL";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$encuesta->id_grupo->EditValue = $arwrk;

			// estatus
			$encuesta->estatus->EditCustomAttributes = "";
			$arwrk = array();
			
			
			
			
				IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("0", $encuesta->estatus->FldTagCaption(2) <> "" ? $encuesta->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $encuesta->estatus->FldTagCaption(3) <> "" ? $encuesta->estatus->FldTagCaption(3) : "3");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $encuesta->estatus->FldTagCaption(3) <> "" ? $encuesta->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $encuesta->estatus->FldTagCaption(4) <> "" ? $encuesta->estatus->FldTagCaption(4) : "4");
			}
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $encuesta->estatus->FldTagCaption(1) <> "" ? $encuesta->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $encuesta->estatus->FldTagCaption(4) <> "" ? $encuesta->estatus->FldTagCaption(4) : "4");
			
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $encuesta->estatus->FldTagCaption(1) <> "" ? $encuesta->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $encuesta->estatus->FldTagCaption(2) <> "" ? $encuesta->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $encuesta->estatus->FldTagCaption(3) <> "" ? $encuesta->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $encuesta->estatus->FldTagCaption(4) <> "" ? $encuesta->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $encuesta->estatus->FldTagCaption(1) <> "" ? $encuesta->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $encuesta->estatus->FldTagCaption(2) <> "" ? $encuesta->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $encuesta->estatus->FldTagCaption(3) <> "" ? $encuesta->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $encuesta->estatus->FldTagCaption(4) <> "" ? $encuesta->estatus->FldTagCaption(4) : "4");
			}
			
			
			
			
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$encuesta->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$encuesta->nombre->HrefValue = "";

			// id_grupo
			$encuesta->id_grupo->HrefValue = "";

			// estatus
			$encuesta->estatus->HrefValue = "";
		}
		if ($encuesta->RowType == EW_ROWTYPE_ADD ||
			$encuesta->RowType == EW_ROWTYPE_EDIT ||
			$encuesta->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$encuesta->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($encuesta->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$encuesta->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $encuesta;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($encuesta->nombre->FormValue) && $encuesta->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $encuesta->nombre->FldCaption());
		}
		if (!is_null($encuesta->estatus->FormValue) && $encuesta->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $encuesta->estatus->FldCaption());
		}

		// Validate detail grid
		if ($encuesta->getCurrentDetailTable() == "preguntas" && $GLOBALS["preguntas"]->DetailEdit) {
			$preguntas_grid = new cpreguntas_grid(); // get detail page object
			$preguntas_grid->ValidateGridForm();
			$preguntas_grid = NULL;
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
		global $conn, $Security, $Language, $encuesta;
		$sFilter = $encuesta->KeyFilter();
		$encuesta->CurrentFilter = $sFilter;
		$sSql = $encuesta->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($encuesta->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// nombre
			$encuesta->nombre->SetDbValueDef($rsnew, $encuesta->nombre->CurrentValue, NULL, $encuesta->nombre->ReadOnly);

			// id_grupo
			$encuesta->id_grupo->SetDbValueDef($rsnew, $encuesta->id_grupo->CurrentValue, NULL, $encuesta->id_grupo->ReadOnly);

			// estatus
			$encuesta->estatus->SetDbValueDef($rsnew, $encuesta->estatus->CurrentValue, NULL, $encuesta->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $encuesta->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($encuesta->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';

				// Update detail records
				if ($EditRow) {
					if ($encuesta->getCurrentDetailTable() == "preguntas" && $GLOBALS["preguntas"]->DetailEdit) {
						$preguntas_grid = new cpreguntas_grid(); // get detail page object
						$EditRow = $preguntas_grid->GridUpdate();
						$preguntas_grid = NULL;
					}
				}

				// Commit/Rollback transaction
				if ($encuesta->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($encuesta->CancelMessage <> "") {
					$this->setFailureMessage($encuesta->CancelMessage);
					$encuesta->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$encuesta->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $encuesta;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$encuesta->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $encuesta->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "preguntas") {
				if (!isset($GLOBALS["preguntas"]))
					$GLOBALS["preguntas"] = new cpreguntas;
				if ($GLOBALS["preguntas"]->DetailEdit) {
					$GLOBALS["preguntas"]->CurrentMode = "edit";
					$GLOBALS["preguntas"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["preguntas"]->setCurrentMasterTable($encuesta->TableVar);
					$GLOBALS["preguntas"]->setStartRecordNumber(1);
					$GLOBALS["preguntas"]->id_encuesta->FldIsDetailKey = TRUE;
					$GLOBALS["preguntas"]->id_encuesta->CurrentValue = $encuesta->id_encuesta->CurrentValue;
					$GLOBALS["preguntas"]->id_encuesta->setSessionValue($GLOBALS["preguntas"]->id_encuesta->CurrentValue);
				}
			}
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'encuesta';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $encuesta;
		$table = 'encuesta';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_encuesta'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($encuesta->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($encuesta->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($encuesta->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($encuesta->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
