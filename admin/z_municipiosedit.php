<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_municipiosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_municipios_edit = new cz_municipios_edit();
$Page =& $z_municipios_edit;

// Page init
$z_municipios_edit->Page_Init();

// Page main
$z_municipios_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_municipios_edit = new ew_Page("z_municipios_edit");

// page properties
z_municipios_edit.PageID = "edit"; // page ID
z_municipios_edit.FormID = "fz_municipiosedit"; // form ID
var EW_PAGE_ID = z_municipios_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
z_municipios_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_lp_municipio_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->lp_municipio_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->visibilidad->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_municipios->visibilidad->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_lf_estado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->lf_estado->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lf_estado"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_municipios->lf_estado->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pk_municipio"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_municipios->pk_municipio->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pk_municipio"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_municipios->pk_municipio->FldErrMsg()) ?>");

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
z_municipios_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_municipios_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_municipios_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_municipios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_municipios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_municipios_edit->ShowPageHeader(); ?>
<?php
$z_municipios_edit->ShowMessage();
?>
<form name="fz_municipiosedit" id="fz_municipiosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_municipios_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="z_municipios">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_municipios->lp_municipio_id->Visible) { // lp_municipio_id ?>
	<tr id="r_lp_municipio_id"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->lp_municipio_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->lp_municipio_id->CellAttributes() ?>><span id="el_lp_municipio_id">
<div<?php echo $z_municipios->lp_municipio_id->ViewAttributes() ?>><?php echo $z_municipios->lp_municipio_id->EditValue ?></div>
<input type="hidden" name="x_lp_municipio_id" id="x_lp_municipio_id" value="<?php echo ew_HtmlEncode($z_municipios->lp_municipio_id->CurrentValue) ?>">
</span><?php echo $z_municipios->lp_municipio_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="50" value="<?php echo $z_municipios->nombre->EditValue ?>"<?php echo $z_municipios->nombre->EditAttributes() ?>>
</span><?php echo $z_municipios->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->visibilidad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<input type="text" name="x_visibilidad" id="x_visibilidad" size="30" value="<?php echo $z_municipios->visibilidad->EditValue ?>"<?php echo $z_municipios->visibilidad->EditAttributes() ?>>
</span><?php echo $z_municipios->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->lf_estado->Visible) { // lf_estado ?>
	<tr id="r_lf_estado"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->lf_estado->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->lf_estado->CellAttributes() ?>><span id="el_lf_estado">
<span id="as_x_lf_estado" style="white-space: nowrap; z-index: 8960">
	<input type="text" name="sv_x_lf_estado" id="sv_x_lf_estado" value="<?php echo $z_municipios->lf_estado->EditValue ?>" size="30"<?php echo $z_municipios->lf_estado->EditAttributes() ?>>&nbsp;<span id="em_x_lf_estado" class="ewMessage" style="display: none"><?php echo str_replace("%f", "phpimages/", $Language->Phrase("UnmatchedValue")) ?></span>
	<div id="sc_x_lf_estado" style="z-index: 8960"></div>
</span>
<input type="hidden" name="x_lf_estado" id="x_lf_estado" value="<?php echo $z_municipios->lf_estado->CurrentValue ?>">
<?php
$sSqlWrk = "SELECT `id2_estado`, `nombre` FROM `_estados`";
$sWhereWrk = "`nombre`  LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_lf_estado" id="s_x_lf_estado" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_lf_estado = new ew_AutoSuggest("sv_x_lf_estado", "sc_x_lf_estado", "s_x_lf_estado", "em_x_lf_estado", "x_lf_estado", "", false, EW_AUTO_SUGGEST_MAX_ENTRIES);
oas_x_lf_estado.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_lf_estado.ac.typeAhead = false;

//-->
</script>
</span><?php echo $z_municipios->lf_estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_municipios->pk_municipio->Visible) { // pk_municipio ?>
	<tr id="r_pk_municipio"<?php echo $z_municipios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_municipios->pk_municipio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_municipios->pk_municipio->CellAttributes() ?>><span id="el_pk_municipio">
<input type="text" name="x_pk_municipio" id="x_pk_municipio" size="30" value="<?php echo $z_municipios->pk_municipio->EditValue ?>"<?php echo $z_municipios->pk_municipio->EditAttributes() ?>>
</span><?php echo $z_municipios->pk_municipio->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$z_municipios_edit->ShowPageFooter();
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
$z_municipios_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_municipios_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = '_municipios';

	// Page object name
	var $PageObjName = 'z_municipios_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_municipios;
		if ($z_municipios->UseTokenInUrl) $PageUrl .= "t=" . $z_municipios->TableVar . "&"; // Add page token
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
		global $objForm, $z_municipios;
		if ($z_municipios->UseTokenInUrl) {
			if ($objForm)
				return ($z_municipios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_municipios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_municipios_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_municipios)
		if (!isset($GLOBALS["z_municipios"])) {
			$GLOBALS["z_municipios"] = new cz_municipios();
			$GLOBALS["Table"] =& $GLOBALS["z_municipios"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_municipios', TRUE);

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
		global $z_municipios;

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
		global $objForm, $Language, $gsFormError, $z_municipios;

		// Load key from QueryString
		if (@$_GET["lp_municipio_id"] <> "")
			$z_municipios->lp_municipio_id->setQueryStringValue($_GET["lp_municipio_id"]);
		if (@$_POST["a_edit"] <> "") {
			$z_municipios->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_municipios->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$z_municipios->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$z_municipios->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($z_municipios->lp_municipio_id->CurrentValue == "")
			$this->Page_Terminate("z_municipioslist.php"); // Invalid key, return to list
		switch ($z_municipios->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_municipioslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$z_municipios->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $z_municipios->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$z_municipios->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$z_municipios->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$z_municipios->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $z_municipios;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_municipios;
		if (!$z_municipios->lp_municipio_id->FldIsDetailKey) {
			$z_municipios->lp_municipio_id->setFormValue($objForm->GetValue("x_lp_municipio_id"));
		}
		if (!$z_municipios->nombre->FldIsDetailKey) {
			$z_municipios->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$z_municipios->visibilidad->FldIsDetailKey) {
			$z_municipios->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
		if (!$z_municipios->lf_estado->FldIsDetailKey) {
			$z_municipios->lf_estado->setFormValue($objForm->GetValue("x_lf_estado"));
		}
		if (!$z_municipios->pk_municipio->FldIsDetailKey) {
			$z_municipios->pk_municipio->setFormValue($objForm->GetValue("x_pk_municipio"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $z_municipios;
		$this->LoadRow();
		$z_municipios->lp_municipio_id->CurrentValue = $z_municipios->lp_municipio_id->FormValue;
		$z_municipios->nombre->CurrentValue = $z_municipios->nombre->FormValue;
		$z_municipios->visibilidad->CurrentValue = $z_municipios->visibilidad->FormValue;
		$z_municipios->lf_estado->CurrentValue = $z_municipios->lf_estado->FormValue;
		$z_municipios->pk_municipio->CurrentValue = $z_municipios->pk_municipio->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_municipios;
		$sFilter = $z_municipios->KeyFilter();

		// Call Row Selecting event
		$z_municipios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_municipios->CurrentFilter = $sFilter;
		$sSql = $z_municipios->SQL();
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
		global $conn, $z_municipios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_municipios->Row_Selected($row);
		$z_municipios->lp_municipio_id->setDbValue($rs->fields('lp_municipio_id'));
		$z_municipios->nombre->setDbValue($rs->fields('nombre'));
		$z_municipios->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_municipios->lf_estado->setDbValue($rs->fields('lf_estado'));
		$z_municipios->pk_municipio->setDbValue($rs->fields('pk_municipio'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_municipios;

		// Initialize URLs
		// Call Row_Rendering event

		$z_municipios->Row_Rendering();

		// Common render codes for all row types
		// lp_municipio_id
		// nombre
		// visibilidad
		// lf_estado
		// pk_municipio

		if ($z_municipios->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_municipio_id
			$z_municipios->lp_municipio_id->ViewValue = $z_municipios->lp_municipio_id->CurrentValue;
			$z_municipios->lp_municipio_id->ViewCustomAttributes = "";

			// nombre
			$z_municipios->nombre->ViewValue = $z_municipios->nombre->CurrentValue;
			$z_municipios->nombre->ViewCustomAttributes = "";

			// visibilidad
			$z_municipios->visibilidad->ViewValue = $z_municipios->visibilidad->CurrentValue;
			$z_municipios->visibilidad->ViewCustomAttributes = "";

			// lf_estado
			$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
			if (strval($z_municipios->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_municipios->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_municipios->lf_estado->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
				}
			} else {
				$z_municipios->lf_estado->ViewValue = NULL;
			}
			$z_municipios->lf_estado->ViewCustomAttributes = "";

			// pk_municipio
			$z_municipios->pk_municipio->ViewValue = $z_municipios->pk_municipio->CurrentValue;
			$z_municipios->pk_municipio->ViewCustomAttributes = "";

			// lp_municipio_id
			$z_municipios->lp_municipio_id->LinkCustomAttributes = "";
			$z_municipios->lp_municipio_id->HrefValue = "";
			$z_municipios->lp_municipio_id->TooltipValue = "";

			// nombre
			$z_municipios->nombre->LinkCustomAttributes = "";
			$z_municipios->nombre->HrefValue = "";
			$z_municipios->nombre->TooltipValue = "";

			// visibilidad
			$z_municipios->visibilidad->LinkCustomAttributes = "";
			$z_municipios->visibilidad->HrefValue = "";
			$z_municipios->visibilidad->TooltipValue = "";

			// lf_estado
			$z_municipios->lf_estado->LinkCustomAttributes = "";
			$z_municipios->lf_estado->HrefValue = "";
			$z_municipios->lf_estado->TooltipValue = "";

			// pk_municipio
			$z_municipios->pk_municipio->LinkCustomAttributes = "";
			$z_municipios->pk_municipio->HrefValue = "";
			$z_municipios->pk_municipio->TooltipValue = "";
		} elseif ($z_municipios->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// lp_municipio_id
			$z_municipios->lp_municipio_id->EditCustomAttributes = "";
			$z_municipios->lp_municipio_id->EditValue = $z_municipios->lp_municipio_id->CurrentValue;
			$z_municipios->lp_municipio_id->ViewCustomAttributes = "";

			// nombre
			$z_municipios->nombre->EditCustomAttributes = "";
			$z_municipios->nombre->EditValue = ew_HtmlEncode($z_municipios->nombre->CurrentValue);

			// visibilidad
			$z_municipios->visibilidad->EditCustomAttributes = "";
			$z_municipios->visibilidad->EditValue = ew_HtmlEncode($z_municipios->visibilidad->CurrentValue);

			// lf_estado
			$z_municipios->lf_estado->EditCustomAttributes = "";
			$z_municipios->lf_estado->EditValue = ew_HtmlEncode($z_municipios->lf_estado->CurrentValue);
			if (strval($z_municipios->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_municipios->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_municipios->lf_estado->EditValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_municipios->lf_estado->EditValue = $z_municipios->lf_estado->CurrentValue;
				}
			} else {
				$z_municipios->lf_estado->EditValue = NULL;
			}

			// pk_municipio
			$z_municipios->pk_municipio->EditCustomAttributes = "";
			$z_municipios->pk_municipio->EditValue = ew_HtmlEncode($z_municipios->pk_municipio->CurrentValue);

			// Edit refer script
			// lp_municipio_id

			$z_municipios->lp_municipio_id->HrefValue = "";

			// nombre
			$z_municipios->nombre->HrefValue = "";

			// visibilidad
			$z_municipios->visibilidad->HrefValue = "";

			// lf_estado
			$z_municipios->lf_estado->HrefValue = "";

			// pk_municipio
			$z_municipios->pk_municipio->HrefValue = "";
		}
		if ($z_municipios->RowType == EW_ROWTYPE_ADD ||
			$z_municipios->RowType == EW_ROWTYPE_EDIT ||
			$z_municipios->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$z_municipios->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($z_municipios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_municipios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $z_municipios;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($z_municipios->lp_municipio_id->FormValue) && $z_municipios->lp_municipio_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->lp_municipio_id->FldCaption());
		}
		if (!is_null($z_municipios->nombre->FormValue) && $z_municipios->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->nombre->FldCaption());
		}
		if (!is_null($z_municipios->visibilidad->FormValue) && $z_municipios->visibilidad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->visibilidad->FldCaption());
		}
		if (!ew_CheckInteger($z_municipios->visibilidad->FormValue)) {
			ew_AddMessage($gsFormError, $z_municipios->visibilidad->FldErrMsg());
		}
		if (!is_null($z_municipios->lf_estado->FormValue) && $z_municipios->lf_estado->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->lf_estado->FldCaption());
		}
		if (!ew_CheckInteger($z_municipios->lf_estado->FormValue)) {
			ew_AddMessage($gsFormError, $z_municipios->lf_estado->FldErrMsg());
		}
		if (!is_null($z_municipios->pk_municipio->FormValue) && $z_municipios->pk_municipio->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_municipios->pk_municipio->FldCaption());
		}
		if (!ew_CheckInteger($z_municipios->pk_municipio->FormValue)) {
			ew_AddMessage($gsFormError, $z_municipios->pk_municipio->FldErrMsg());
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
		global $conn, $Security, $Language, $z_municipios;
		$sFilter = $z_municipios->KeyFilter();
		$z_municipios->CurrentFilter = $sFilter;
		$sSql = $z_municipios->SQL();
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

			// lp_municipio_id
			// nombre

			$z_municipios->nombre->SetDbValueDef($rsnew, $z_municipios->nombre->CurrentValue, "", $z_municipios->nombre->ReadOnly);

			// visibilidad
			$z_municipios->visibilidad->SetDbValueDef($rsnew, $z_municipios->visibilidad->CurrentValue, 0, $z_municipios->visibilidad->ReadOnly);

			// lf_estado
			$z_municipios->lf_estado->SetDbValueDef($rsnew, $z_municipios->lf_estado->CurrentValue, 0, $z_municipios->lf_estado->ReadOnly);

			// pk_municipio
			$z_municipios->pk_municipio->SetDbValueDef($rsnew, $z_municipios->pk_municipio->CurrentValue, 0, $z_municipios->pk_municipio->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $z_municipios->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($z_municipios->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($z_municipios->CancelMessage <> "") {
					$this->setFailureMessage($z_municipios->CancelMessage);
					$z_municipios->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$z_municipios->Row_Updated($rsold, $rsnew);
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
