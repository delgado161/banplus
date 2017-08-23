<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_parroquiasinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_parroquias_edit = new cz_parroquias_edit();
$Page =& $z_parroquias_edit;

// Page init
$z_parroquias_edit->Page_Init();

// Page main
$z_parroquias_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_parroquias_edit = new ew_Page("z_parroquias_edit");

// page properties
z_parroquias_edit.PageID = "edit"; // page ID
z_parroquias_edit.FormID = "fz_parroquiasedit"; // form ID
var EW_PAGE_ID = z_parroquias_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
z_parroquias_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_parroquias->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lf_parroquia_municipio"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_parroquias->lf_parroquia_municipio->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_parroquias->visibilidad->FldCaption()) ?>");

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
z_parroquias_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_parroquias_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_parroquias_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_parroquias->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_parroquias->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_parroquias_edit->ShowPageHeader(); ?>
<?php
$z_parroquias_edit->ShowMessage();
?>
<form name="fz_parroquiasedit" id="fz_parroquiasedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_parroquias_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="z_parroquias">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_parroquias->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $z_parroquias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_parroquias->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_parroquias->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="25" value="<?php echo $z_parroquias->nombre->EditValue ?>"<?php echo $z_parroquias->nombre->EditAttributes() ?>>
</span><?php echo $z_parroquias->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_parroquias->lf_parroquia_municipio->Visible) { // lf_parroquia_municipio ?>
	<tr id="r_lf_parroquia_municipio"<?php echo $z_parroquias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_parroquias->lf_parroquia_municipio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_parroquias->lf_parroquia_municipio->CellAttributes() ?>><span id="el_lf_parroquia_municipio">
<select id="x_lf_parroquia_municipio" name="x_lf_parroquia_municipio"<?php echo $z_parroquias->lf_parroquia_municipio->EditAttributes() ?>>
<?php
if (is_array($z_parroquias->lf_parroquia_municipio->EditValue)) {
	$arwrk = $z_parroquias->lf_parroquia_municipio->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($z_parroquias->lf_parroquia_municipio->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $z_parroquias->lf_parroquia_municipio->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_parroquias->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_parroquias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_parroquias->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_parroquias->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<div id="tp_x_visibilidad" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="{value}"<?php echo $z_parroquias->visibilidad->EditAttributes() ?>></label></div>
<div id="dsl_x_visibilidad" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $z_parroquias->visibilidad->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($z_parroquias->visibilidad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $z_parroquias->visibilidad->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $z_parroquias->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_lp_parroquia_id" id="x_lp_parroquia_id" value="<?php echo ew_HtmlEncode($z_parroquias->lp_parroquia_id->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$z_parroquias_edit->ShowPageFooter();
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
$z_parroquias_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_parroquias_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = '_parroquias';

	// Page object name
	var $PageObjName = 'z_parroquias_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_parroquias;
		if ($z_parroquias->UseTokenInUrl) $PageUrl .= "t=" . $z_parroquias->TableVar . "&"; // Add page token
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
		global $objForm, $z_parroquias;
		if ($z_parroquias->UseTokenInUrl) {
			if ($objForm)
				return ($z_parroquias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_parroquias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_parroquias_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_parroquias)
		if (!isset($GLOBALS["z_parroquias"])) {
			$GLOBALS["z_parroquias"] = new cz_parroquias();
			$GLOBALS["Table"] =& $GLOBALS["z_parroquias"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_parroquias', TRUE);

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
		global $z_parroquias;

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
		global $objForm, $Language, $gsFormError, $z_parroquias;

		// Load key from QueryString
		if (@$_GET["lp_parroquia_id"] <> "")
			$z_parroquias->lp_parroquia_id->setQueryStringValue($_GET["lp_parroquia_id"]);
		if (@$_POST["a_edit"] <> "") {
			$z_parroquias->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_parroquias->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$z_parroquias->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$z_parroquias->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($z_parroquias->lp_parroquia_id->CurrentValue == "")
			$this->Page_Terminate("z_parroquiaslist.php"); // Invalid key, return to list
		switch ($z_parroquias->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_parroquiaslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$z_parroquias->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $z_parroquias->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$z_parroquias->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$z_parroquias->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$z_parroquias->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $z_parroquias;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_parroquias;
		if (!$z_parroquias->nombre->FldIsDetailKey) {
			$z_parroquias->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$z_parroquias->lf_parroquia_municipio->FldIsDetailKey) {
			$z_parroquias->lf_parroquia_municipio->setFormValue($objForm->GetValue("x_lf_parroquia_municipio"));
		}
		if (!$z_parroquias->visibilidad->FldIsDetailKey) {
			$z_parroquias->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
		if (!$z_parroquias->lp_parroquia_id->FldIsDetailKey)
			$z_parroquias->lp_parroquia_id->setFormValue($objForm->GetValue("x_lp_parroquia_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $z_parroquias;
		$this->LoadRow();
		$z_parroquias->lp_parroquia_id->CurrentValue = $z_parroquias->lp_parroquia_id->FormValue;
		$z_parroquias->nombre->CurrentValue = $z_parroquias->nombre->FormValue;
		$z_parroquias->lf_parroquia_municipio->CurrentValue = $z_parroquias->lf_parroquia_municipio->FormValue;
		$z_parroquias->visibilidad->CurrentValue = $z_parroquias->visibilidad->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_parroquias;
		$sFilter = $z_parroquias->KeyFilter();

		// Call Row Selecting event
		$z_parroquias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_parroquias->CurrentFilter = $sFilter;
		$sSql = $z_parroquias->SQL();
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
		global $conn, $z_parroquias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_parroquias->Row_Selected($row);
		$z_parroquias->lp_parroquia_id->setDbValue($rs->fields('lp_parroquia_id'));
		$z_parroquias->nombre->setDbValue($rs->fields('nombre'));
		$z_parroquias->lf_parroquia_municipio->setDbValue($rs->fields('lf_parroquia_municipio'));
		$z_parroquias->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_parroquias;

		// Initialize URLs
		// Call Row_Rendering event

		$z_parroquias->Row_Rendering();

		// Common render codes for all row types
		// lp_parroquia_id
		// nombre
		// lf_parroquia_municipio
		// visibilidad

		if ($z_parroquias->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_parroquia_id
			$z_parroquias->lp_parroquia_id->ViewValue = $z_parroquias->lp_parroquia_id->CurrentValue;
			$z_parroquias->lp_parroquia_id->ViewCustomAttributes = "";

			// nombre
			$z_parroquias->nombre->ViewValue = $z_parroquias->nombre->CurrentValue;
			$z_parroquias->nombre->ViewCustomAttributes = "";

			// lf_parroquia_municipio
			if (strval($z_parroquias->lf_parroquia_municipio->CurrentValue) <> "") {
				$sFilterWrk = "`lp_municipio_id` = '" . ew_AdjustSql($z_parroquias->lf_parroquia_municipio->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nombre` FROM `_municipios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_parroquias->lf_parroquia_municipio->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_parroquias->lf_parroquia_municipio->ViewValue = $z_parroquias->lf_parroquia_municipio->CurrentValue;
				}
			} else {
				$z_parroquias->lf_parroquia_municipio->ViewValue = NULL;
			}
			$z_parroquias->lf_parroquia_municipio->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_parroquias->visibilidad->CurrentValue) <> "") {
				switch ($z_parroquias->visibilidad->CurrentValue) {
					case "1":
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->FldTagCaption(1) <> "" ? $z_parroquias->visibilidad->FldTagCaption(1) : $z_parroquias->visibilidad->CurrentValue;
						break;
					case "0":
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->FldTagCaption(2) <> "" ? $z_parroquias->visibilidad->FldTagCaption(2) : $z_parroquias->visibilidad->CurrentValue;
						break;
					default:
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->CurrentValue;
				}
			} else {
				$z_parroquias->visibilidad->ViewValue = NULL;
			}
			$z_parroquias->visibilidad->ViewCustomAttributes = "";

			// nombre
			$z_parroquias->nombre->LinkCustomAttributes = "";
			$z_parroquias->nombre->HrefValue = "";
			$z_parroquias->nombre->TooltipValue = "";

			// lf_parroquia_municipio
			$z_parroquias->lf_parroquia_municipio->LinkCustomAttributes = "";
			$z_parroquias->lf_parroquia_municipio->HrefValue = "";
			$z_parroquias->lf_parroquia_municipio->TooltipValue = "";

			// visibilidad
			$z_parroquias->visibilidad->LinkCustomAttributes = "";
			$z_parroquias->visibilidad->HrefValue = "";
			$z_parroquias->visibilidad->TooltipValue = "";
		} elseif ($z_parroquias->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$z_parroquias->nombre->EditCustomAttributes = "";
			$z_parroquias->nombre->EditValue = ew_HtmlEncode($z_parroquias->nombre->CurrentValue);

			// lf_parroquia_municipio
			$z_parroquias->lf_parroquia_municipio->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `lp_municipio_id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `_municipios`";
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
			$z_parroquias->lf_parroquia_municipio->EditValue = $arwrk;

			// visibilidad
			$z_parroquias->visibilidad->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $z_parroquias->visibilidad->FldTagCaption(1) <> "" ? $z_parroquias->visibilidad->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $z_parroquias->visibilidad->FldTagCaption(2) <> "" ? $z_parroquias->visibilidad->FldTagCaption(2) : "0");
			$z_parroquias->visibilidad->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$z_parroquias->nombre->HrefValue = "";

			// lf_parroquia_municipio
			$z_parroquias->lf_parroquia_municipio->HrefValue = "";

			// visibilidad
			$z_parroquias->visibilidad->HrefValue = "";
		}
		if ($z_parroquias->RowType == EW_ROWTYPE_ADD ||
			$z_parroquias->RowType == EW_ROWTYPE_EDIT ||
			$z_parroquias->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$z_parroquias->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($z_parroquias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_parroquias->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $z_parroquias;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($z_parroquias->nombre->FormValue) && $z_parroquias->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_parroquias->nombre->FldCaption());
		}
		if (!is_null($z_parroquias->lf_parroquia_municipio->FormValue) && $z_parroquias->lf_parroquia_municipio->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_parroquias->lf_parroquia_municipio->FldCaption());
		}
		if ($z_parroquias->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_parroquias->visibilidad->FldCaption());
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
		global $conn, $Security, $Language, $z_parroquias;
		$sFilter = $z_parroquias->KeyFilter();
		$z_parroquias->CurrentFilter = $sFilter;
		$sSql = $z_parroquias->SQL();
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
			$z_parroquias->nombre->SetDbValueDef($rsnew, $z_parroquias->nombre->CurrentValue, "", $z_parroquias->nombre->ReadOnly);

			// lf_parroquia_municipio
			$z_parroquias->lf_parroquia_municipio->SetDbValueDef($rsnew, $z_parroquias->lf_parroquia_municipio->CurrentValue, "", $z_parroquias->lf_parroquia_municipio->ReadOnly);

			// visibilidad
			$z_parroquias->visibilidad->SetDbValueDef($rsnew, $z_parroquias->visibilidad->CurrentValue, 0, $z_parroquias->visibilidad->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $z_parroquias->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($z_parroquias->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($z_parroquias->CancelMessage <> "") {
					$this->setFailureMessage($z_parroquias->CancelMessage);
					$z_parroquias->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$z_parroquias->Row_Updated($rsold, $rsnew);
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
