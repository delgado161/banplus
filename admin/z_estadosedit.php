<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_estadosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_estados_edit = new cz_estados_edit();
$Page =& $z_estados_edit;

// Page init
$z_estados_edit->Page_Init();

// Page main
$z_estados_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_estados_edit = new ew_Page("z_estados_edit");

// page properties
z_estados_edit.PageID = "edit"; // page ID
z_estados_edit.FormID = "fz_estadosedit"; // form ID
var EW_PAGE_ID = z_estados_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
z_estados_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_estados->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lf_estado_pais"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_estados->lf_estado_pais->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_estados->visibilidad->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id2_estado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_estados->id2_estado->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id2_estado"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_estados->id2_estado->FldErrMsg()) ?>");

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
z_estados_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_estados_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_estados_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_estados->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_estados->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_estados_edit->ShowPageHeader(); ?>
<?php
$z_estados_edit->ShowMessage();
?>
<form name="fz_estadosedit" id="fz_estadosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_estados_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="z_estados">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_estados->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $z_estados->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_estados->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_estados->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="50" value="<?php echo $z_estados->nombre->EditValue ?>"<?php echo $z_estados->nombre->EditAttributes() ?>>
</span><?php echo $z_estados->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_estados->lf_estado_pais->Visible) { // lf_estado_pais ?>
	<tr id="r_lf_estado_pais"<?php echo $z_estados->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_estados->lf_estado_pais->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_estados->lf_estado_pais->CellAttributes() ?>><span id="el_lf_estado_pais">
<select id="x_lf_estado_pais" name="x_lf_estado_pais"<?php echo $z_estados->lf_estado_pais->EditAttributes() ?>>
<?php
if (is_array($z_estados->lf_estado_pais->EditValue)) {
	$arwrk = $z_estados->lf_estado_pais->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($z_estados->lf_estado_pais->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $z_estados->lf_estado_pais->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_estados->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_estados->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_estados->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_estados->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<div id="tp_x_visibilidad" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="{value}"<?php echo $z_estados->visibilidad->EditAttributes() ?>></label></div>
<div id="dsl_x_visibilidad" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $z_estados->visibilidad->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($z_estados->visibilidad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $z_estados->visibilidad->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $z_estados->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_estados->id2_estado->Visible) { // id2_estado ?>
	<tr id="r_id2_estado"<?php echo $z_estados->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_estados->id2_estado->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_estados->id2_estado->CellAttributes() ?>><span id="el_id2_estado">
<div<?php echo $z_estados->id2_estado->ViewAttributes() ?>><?php echo $z_estados->id2_estado->EditValue ?></div>
<input type="hidden" name="x_id2_estado" id="x_id2_estado" value="<?php echo ew_HtmlEncode($z_estados->id2_estado->CurrentValue) ?>">
</span><?php echo $z_estados->id2_estado->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$z_estados_edit->ShowPageFooter();
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
$z_estados_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_estados_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = '_estados';

	// Page object name
	var $PageObjName = 'z_estados_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_estados;
		if ($z_estados->UseTokenInUrl) $PageUrl .= "t=" . $z_estados->TableVar . "&"; // Add page token
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
		global $objForm, $z_estados;
		if ($z_estados->UseTokenInUrl) {
			if ($objForm)
				return ($z_estados->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_estados->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_estados_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_estados)
		if (!isset($GLOBALS["z_estados"])) {
			$GLOBALS["z_estados"] = new cz_estados();
			$GLOBALS["Table"] =& $GLOBALS["z_estados"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_estados', TRUE);

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
		global $z_estados;

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
		global $objForm, $Language, $gsFormError, $z_estados;

		// Load key from QueryString
		if (@$_GET["id2_estado"] <> "")
			$z_estados->id2_estado->setQueryStringValue($_GET["id2_estado"]);
		if (@$_POST["a_edit"] <> "") {
			$z_estados->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_estados->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$z_estados->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$z_estados->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($z_estados->id2_estado->CurrentValue == "")
			$this->Page_Terminate("z_estadoslist.php"); // Invalid key, return to list
		switch ($z_estados->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_estadoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$z_estados->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $z_estados->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$z_estados->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$z_estados->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$z_estados->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $z_estados;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_estados;
		if (!$z_estados->nombre->FldIsDetailKey) {
			$z_estados->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$z_estados->lf_estado_pais->FldIsDetailKey) {
			$z_estados->lf_estado_pais->setFormValue($objForm->GetValue("x_lf_estado_pais"));
		}
		if (!$z_estados->visibilidad->FldIsDetailKey) {
			$z_estados->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
		if (!$z_estados->id2_estado->FldIsDetailKey) {
			$z_estados->id2_estado->setFormValue($objForm->GetValue("x_id2_estado"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $z_estados;
		$this->LoadRow();
		$z_estados->nombre->CurrentValue = $z_estados->nombre->FormValue;
		$z_estados->lf_estado_pais->CurrentValue = $z_estados->lf_estado_pais->FormValue;
		$z_estados->visibilidad->CurrentValue = $z_estados->visibilidad->FormValue;
		$z_estados->id2_estado->CurrentValue = $z_estados->id2_estado->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_estados;
		$sFilter = $z_estados->KeyFilter();

		// Call Row Selecting event
		$z_estados->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_estados->CurrentFilter = $sFilter;
		$sSql = $z_estados->SQL();
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
		global $conn, $z_estados;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_estados->Row_Selected($row);
		$z_estados->nombre->setDbValue($rs->fields('nombre'));
		$z_estados->lf_estado_pais->setDbValue($rs->fields('lf_estado_pais'));
		$z_estados->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_estados->id2_estado->setDbValue($rs->fields('id2_estado'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_estados;

		// Initialize URLs
		// Call Row_Rendering event

		$z_estados->Row_Rendering();

		// Common render codes for all row types
		// nombre
		// lf_estado_pais
		// visibilidad
		// id2_estado

		if ($z_estados->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$z_estados->nombre->ViewValue = $z_estados->nombre->CurrentValue;
			$z_estados->nombre->ViewCustomAttributes = "";

			// lf_estado_pais
			if (strval($z_estados->lf_estado_pais->CurrentValue) <> "") {
				$sFilterWrk = "`lp_pais_id` = '" . ew_AdjustSql($z_estados->lf_estado_pais->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nombre` FROM `_paises`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_estados->lf_estado_pais->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_estados->lf_estado_pais->ViewValue = $z_estados->lf_estado_pais->CurrentValue;
				}
			} else {
				$z_estados->lf_estado_pais->ViewValue = NULL;
			}
			$z_estados->lf_estado_pais->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_estados->visibilidad->CurrentValue) <> "") {
				switch ($z_estados->visibilidad->CurrentValue) {
					case "1":
						$z_estados->visibilidad->ViewValue = $z_estados->visibilidad->FldTagCaption(1) <> "" ? $z_estados->visibilidad->FldTagCaption(1) : $z_estados->visibilidad->CurrentValue;
						break;
					case "0":
						$z_estados->visibilidad->ViewValue = $z_estados->visibilidad->FldTagCaption(2) <> "" ? $z_estados->visibilidad->FldTagCaption(2) : $z_estados->visibilidad->CurrentValue;
						break;
					default:
						$z_estados->visibilidad->ViewValue = $z_estados->visibilidad->CurrentValue;
				}
			} else {
				$z_estados->visibilidad->ViewValue = NULL;
			}
			$z_estados->visibilidad->ViewCustomAttributes = "";

			// id2_estado
			$z_estados->id2_estado->ViewValue = $z_estados->id2_estado->CurrentValue;
			$z_estados->id2_estado->ViewCustomAttributes = "";

			// nombre
			$z_estados->nombre->LinkCustomAttributes = "";
			$z_estados->nombre->HrefValue = "";
			$z_estados->nombre->TooltipValue = "";

			// lf_estado_pais
			$z_estados->lf_estado_pais->LinkCustomAttributes = "";
			$z_estados->lf_estado_pais->HrefValue = "";
			$z_estados->lf_estado_pais->TooltipValue = "";

			// visibilidad
			$z_estados->visibilidad->LinkCustomAttributes = "";
			$z_estados->visibilidad->HrefValue = "";
			$z_estados->visibilidad->TooltipValue = "";

			// id2_estado
			$z_estados->id2_estado->LinkCustomAttributes = "";
			$z_estados->id2_estado->HrefValue = "";
			$z_estados->id2_estado->TooltipValue = "";
		} elseif ($z_estados->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$z_estados->nombre->EditCustomAttributes = "";
			$z_estados->nombre->EditValue = ew_HtmlEncode($z_estados->nombre->CurrentValue);

			// lf_estado_pais
			$z_estados->lf_estado_pais->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `lp_pais_id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `_paises`";
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
			$z_estados->lf_estado_pais->EditValue = $arwrk;

			// visibilidad
			$z_estados->visibilidad->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $z_estados->visibilidad->FldTagCaption(1) <> "" ? $z_estados->visibilidad->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $z_estados->visibilidad->FldTagCaption(2) <> "" ? $z_estados->visibilidad->FldTagCaption(2) : "0");
			$z_estados->visibilidad->EditValue = $arwrk;

			// id2_estado
			$z_estados->id2_estado->EditCustomAttributes = "";
			$z_estados->id2_estado->EditValue = $z_estados->id2_estado->CurrentValue;
			$z_estados->id2_estado->ViewCustomAttributes = "";

			// Edit refer script
			// nombre

			$z_estados->nombre->HrefValue = "";

			// lf_estado_pais
			$z_estados->lf_estado_pais->HrefValue = "";

			// visibilidad
			$z_estados->visibilidad->HrefValue = "";

			// id2_estado
			$z_estados->id2_estado->HrefValue = "";
		}
		if ($z_estados->RowType == EW_ROWTYPE_ADD ||
			$z_estados->RowType == EW_ROWTYPE_EDIT ||
			$z_estados->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$z_estados->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($z_estados->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_estados->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $z_estados;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($z_estados->nombre->FormValue) && $z_estados->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_estados->nombre->FldCaption());
		}
		if (!is_null($z_estados->lf_estado_pais->FormValue) && $z_estados->lf_estado_pais->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_estados->lf_estado_pais->FldCaption());
		}
		if ($z_estados->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_estados->visibilidad->FldCaption());
		}
		if (!is_null($z_estados->id2_estado->FormValue) && $z_estados->id2_estado->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_estados->id2_estado->FldCaption());
		}
		if (!ew_CheckInteger($z_estados->id2_estado->FormValue)) {
			ew_AddMessage($gsFormError, $z_estados->id2_estado->FldErrMsg());
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
		global $conn, $Security, $Language, $z_estados;
		$sFilter = $z_estados->KeyFilter();
		$z_estados->CurrentFilter = $sFilter;
		$sSql = $z_estados->SQL();
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

			// nombre
			$z_estados->nombre->SetDbValueDef($rsnew, $z_estados->nombre->CurrentValue, "", $z_estados->nombre->ReadOnly);

			// lf_estado_pais
			$z_estados->lf_estado_pais->SetDbValueDef($rsnew, $z_estados->lf_estado_pais->CurrentValue, "", $z_estados->lf_estado_pais->ReadOnly);

			// visibilidad
			$z_estados->visibilidad->SetDbValueDef($rsnew, $z_estados->visibilidad->CurrentValue, 0, $z_estados->visibilidad->ReadOnly);

			// id2_estado
			// Call Row Updating event

			$bUpdateRow = $z_estados->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($z_estados->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($z_estados->CancelMessage <> "") {
					$this->setFailureMessage($z_estados->CancelMessage);
					$z_estados->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$z_estados->Row_Updated($rsold, $rsnew);
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
