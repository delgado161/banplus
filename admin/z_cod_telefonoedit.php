<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_cod_telefonoinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_cod_telefono_edit = new cz_cod_telefono_edit();
$Page =& $z_cod_telefono_edit;

// Page init
$z_cod_telefono_edit->Page_Init();

// Page main
$z_cod_telefono_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_cod_telefono_edit = new ew_Page("z_cod_telefono_edit");

// page properties
z_cod_telefono_edit.PageID = "edit"; // page ID
z_cod_telefono_edit.FormID = "fz_cod_telefonoedit"; // form ID
var EW_PAGE_ID = z_cod_telefono_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
z_cod_telefono_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_codigo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_cod_telefono->codigo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cod_cel"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_cod_telefono->cod_cel->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cod_cel"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_cod_telefono->cod_cel->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_visibilidad"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_cod_telefono->visibilidad->FldErrMsg()) ?>");

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
z_cod_telefono_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_cod_telefono_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_cod_telefono_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_cod_telefono->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_cod_telefono->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_cod_telefono_edit->ShowPageHeader(); ?>
<?php
$z_cod_telefono_edit->ShowMessage();
?>
<form name="fz_cod_telefonoedit" id="fz_cod_telefonoedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_cod_telefono_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="z_cod_telefono">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_cod_telefono->id_cod_telefono->Visible) { // id_cod_telefono ?>
	<tr id="r_id_cod_telefono"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->id_cod_telefono->FldCaption() ?></td>
		<td<?php echo $z_cod_telefono->id_cod_telefono->CellAttributes() ?>><span id="el_id_cod_telefono">
<div<?php echo $z_cod_telefono->id_cod_telefono->ViewAttributes() ?>><?php echo $z_cod_telefono->id_cod_telefono->EditValue ?></div>
<input type="hidden" name="x_id_cod_telefono" id="x_id_cod_telefono" value="<?php echo ew_HtmlEncode($z_cod_telefono->id_cod_telefono->CurrentValue) ?>">
</span><?php echo $z_cod_telefono->id_cod_telefono->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_cod_telefono->codigo->Visible) { // codigo ?>
	<tr id="r_codigo"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->codigo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_cod_telefono->codigo->CellAttributes() ?>><span id="el_codigo">
<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="10" value="<?php echo $z_cod_telefono->codigo->EditValue ?>"<?php echo $z_cod_telefono->codigo->EditAttributes() ?>>
</span><?php echo $z_cod_telefono->codigo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_cod_telefono->cod_cel->Visible) { // cod_cel ?>
	<tr id="r_cod_cel"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->cod_cel->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_cod_telefono->cod_cel->CellAttributes() ?>><span id="el_cod_cel">
<input type="text" name="x_cod_cel" id="x_cod_cel" size="30" value="<?php echo $z_cod_telefono->cod_cel->EditValue ?>"<?php echo $z_cod_telefono->cod_cel->EditAttributes() ?>>
</span><?php echo $z_cod_telefono->cod_cel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_cod_telefono->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->visibilidad->FldCaption() ?></td>
		<td<?php echo $z_cod_telefono->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<input type="text" name="x_visibilidad" id="x_visibilidad" size="30" value="<?php echo $z_cod_telefono->visibilidad->EditValue ?>"<?php echo $z_cod_telefono->visibilidad->EditAttributes() ?>>
</span><?php echo $z_cod_telefono->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_cod_telefono->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion"<?php echo $z_cod_telefono->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_cod_telefono->descripcion->FldCaption() ?></td>
		<td<?php echo $z_cod_telefono->descripcion->CellAttributes() ?>><span id="el_descripcion">
<input type="text" name="x_descripcion" id="x_descripcion" size="30" maxlength="45" value="<?php echo $z_cod_telefono->descripcion->EditValue ?>"<?php echo $z_cod_telefono->descripcion->EditAttributes() ?>>
</span><?php echo $z_cod_telefono->descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$z_cod_telefono_edit->ShowPageFooter();
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
$z_cod_telefono_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_cod_telefono_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = '_cod_telefono';

	// Page object name
	var $PageObjName = 'z_cod_telefono_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_cod_telefono;
		if ($z_cod_telefono->UseTokenInUrl) $PageUrl .= "t=" . $z_cod_telefono->TableVar . "&"; // Add page token
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
		global $objForm, $z_cod_telefono;
		if ($z_cod_telefono->UseTokenInUrl) {
			if ($objForm)
				return ($z_cod_telefono->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_cod_telefono->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_cod_telefono_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_cod_telefono)
		if (!isset($GLOBALS["z_cod_telefono"])) {
			$GLOBALS["z_cod_telefono"] = new cz_cod_telefono();
			$GLOBALS["Table"] =& $GLOBALS["z_cod_telefono"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_cod_telefono', TRUE);

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
		global $z_cod_telefono;

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
		global $objForm, $Language, $gsFormError, $z_cod_telefono;

		// Load key from QueryString
		if (@$_GET["id_cod_telefono"] <> "")
			$z_cod_telefono->id_cod_telefono->setQueryStringValue($_GET["id_cod_telefono"]);
		if (@$_POST["a_edit"] <> "") {
			$z_cod_telefono->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_cod_telefono->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$z_cod_telefono->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$z_cod_telefono->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($z_cod_telefono->id_cod_telefono->CurrentValue == "")
			$this->Page_Terminate("z_cod_telefonolist.php"); // Invalid key, return to list
		switch ($z_cod_telefono->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_cod_telefonolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$z_cod_telefono->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $z_cod_telefono->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$z_cod_telefono->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$z_cod_telefono->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$z_cod_telefono->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $z_cod_telefono;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_cod_telefono;
		if (!$z_cod_telefono->id_cod_telefono->FldIsDetailKey)
			$z_cod_telefono->id_cod_telefono->setFormValue($objForm->GetValue("x_id_cod_telefono"));
		if (!$z_cod_telefono->codigo->FldIsDetailKey) {
			$z_cod_telefono->codigo->setFormValue($objForm->GetValue("x_codigo"));
		}
		if (!$z_cod_telefono->cod_cel->FldIsDetailKey) {
			$z_cod_telefono->cod_cel->setFormValue($objForm->GetValue("x_cod_cel"));
		}
		if (!$z_cod_telefono->visibilidad->FldIsDetailKey) {
			$z_cod_telefono->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
		if (!$z_cod_telefono->descripcion->FldIsDetailKey) {
			$z_cod_telefono->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $z_cod_telefono;
		$this->LoadRow();
		$z_cod_telefono->id_cod_telefono->CurrentValue = $z_cod_telefono->id_cod_telefono->FormValue;
		$z_cod_telefono->codigo->CurrentValue = $z_cod_telefono->codigo->FormValue;
		$z_cod_telefono->cod_cel->CurrentValue = $z_cod_telefono->cod_cel->FormValue;
		$z_cod_telefono->visibilidad->CurrentValue = $z_cod_telefono->visibilidad->FormValue;
		$z_cod_telefono->descripcion->CurrentValue = $z_cod_telefono->descripcion->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_cod_telefono;
		$sFilter = $z_cod_telefono->KeyFilter();

		// Call Row Selecting event
		$z_cod_telefono->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_cod_telefono->CurrentFilter = $sFilter;
		$sSql = $z_cod_telefono->SQL();
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
		global $conn, $z_cod_telefono;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_cod_telefono->Row_Selected($row);
		$z_cod_telefono->id_cod_telefono->setDbValue($rs->fields('id_cod_telefono'));
		$z_cod_telefono->codigo->setDbValue($rs->fields('codigo'));
		$z_cod_telefono->cod_cel->setDbValue($rs->fields('cod_cel'));
		$z_cod_telefono->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_cod_telefono->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_cod_telefono;

		// Initialize URLs
		// Call Row_Rendering event

		$z_cod_telefono->Row_Rendering();

		// Common render codes for all row types
		// id_cod_telefono
		// codigo
		// cod_cel
		// visibilidad
		// descripcion

		if ($z_cod_telefono->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_cod_telefono
			$z_cod_telefono->id_cod_telefono->ViewValue = $z_cod_telefono->id_cod_telefono->CurrentValue;
			$z_cod_telefono->id_cod_telefono->ViewCustomAttributes = "";

			// codigo
			$z_cod_telefono->codigo->ViewValue = $z_cod_telefono->codigo->CurrentValue;
			$z_cod_telefono->codigo->ViewCustomAttributes = "";

			// cod_cel
			$z_cod_telefono->cod_cel->ViewValue = $z_cod_telefono->cod_cel->CurrentValue;
			$z_cod_telefono->cod_cel->ViewCustomAttributes = "";

			// visibilidad
			$z_cod_telefono->visibilidad->ViewValue = $z_cod_telefono->visibilidad->CurrentValue;
			$z_cod_telefono->visibilidad->ViewCustomAttributes = "";

			// descripcion
			$z_cod_telefono->descripcion->ViewValue = $z_cod_telefono->descripcion->CurrentValue;
			$z_cod_telefono->descripcion->ViewCustomAttributes = "";

			// id_cod_telefono
			$z_cod_telefono->id_cod_telefono->LinkCustomAttributes = "";
			$z_cod_telefono->id_cod_telefono->HrefValue = "";
			$z_cod_telefono->id_cod_telefono->TooltipValue = "";

			// codigo
			$z_cod_telefono->codigo->LinkCustomAttributes = "";
			$z_cod_telefono->codigo->HrefValue = "";
			$z_cod_telefono->codigo->TooltipValue = "";

			// cod_cel
			$z_cod_telefono->cod_cel->LinkCustomAttributes = "";
			$z_cod_telefono->cod_cel->HrefValue = "";
			$z_cod_telefono->cod_cel->TooltipValue = "";

			// visibilidad
			$z_cod_telefono->visibilidad->LinkCustomAttributes = "";
			$z_cod_telefono->visibilidad->HrefValue = "";
			$z_cod_telefono->visibilidad->TooltipValue = "";

			// descripcion
			$z_cod_telefono->descripcion->LinkCustomAttributes = "";
			$z_cod_telefono->descripcion->HrefValue = "";
			$z_cod_telefono->descripcion->TooltipValue = "";
		} elseif ($z_cod_telefono->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_cod_telefono
			$z_cod_telefono->id_cod_telefono->EditCustomAttributes = "";
			$z_cod_telefono->id_cod_telefono->EditValue = $z_cod_telefono->id_cod_telefono->CurrentValue;
			$z_cod_telefono->id_cod_telefono->ViewCustomAttributes = "";

			// codigo
			$z_cod_telefono->codigo->EditCustomAttributes = "";
			$z_cod_telefono->codigo->EditValue = ew_HtmlEncode($z_cod_telefono->codigo->CurrentValue);

			// cod_cel
			$z_cod_telefono->cod_cel->EditCustomAttributes = "";
			$z_cod_telefono->cod_cel->EditValue = ew_HtmlEncode($z_cod_telefono->cod_cel->CurrentValue);

			// visibilidad
			$z_cod_telefono->visibilidad->EditCustomAttributes = "";
			$z_cod_telefono->visibilidad->EditValue = ew_HtmlEncode($z_cod_telefono->visibilidad->CurrentValue);

			// descripcion
			$z_cod_telefono->descripcion->EditCustomAttributes = "";
			$z_cod_telefono->descripcion->EditValue = ew_HtmlEncode($z_cod_telefono->descripcion->CurrentValue);

			// Edit refer script
			// id_cod_telefono

			$z_cod_telefono->id_cod_telefono->HrefValue = "";

			// codigo
			$z_cod_telefono->codigo->HrefValue = "";

			// cod_cel
			$z_cod_telefono->cod_cel->HrefValue = "";

			// visibilidad
			$z_cod_telefono->visibilidad->HrefValue = "";

			// descripcion
			$z_cod_telefono->descripcion->HrefValue = "";
		}
		if ($z_cod_telefono->RowType == EW_ROWTYPE_ADD ||
			$z_cod_telefono->RowType == EW_ROWTYPE_EDIT ||
			$z_cod_telefono->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$z_cod_telefono->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($z_cod_telefono->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_cod_telefono->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $z_cod_telefono;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($z_cod_telefono->codigo->FormValue) && $z_cod_telefono->codigo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_cod_telefono->codigo->FldCaption());
		}
		if (!is_null($z_cod_telefono->cod_cel->FormValue) && $z_cod_telefono->cod_cel->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_cod_telefono->cod_cel->FldCaption());
		}
		if (!ew_CheckInteger($z_cod_telefono->cod_cel->FormValue)) {
			ew_AddMessage($gsFormError, $z_cod_telefono->cod_cel->FldErrMsg());
		}
		if (!ew_CheckInteger($z_cod_telefono->visibilidad->FormValue)) {
			ew_AddMessage($gsFormError, $z_cod_telefono->visibilidad->FldErrMsg());
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
		global $conn, $Security, $Language, $z_cod_telefono;
		$sFilter = $z_cod_telefono->KeyFilter();
		$z_cod_telefono->CurrentFilter = $sFilter;
		$sSql = $z_cod_telefono->SQL();
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

			// codigo
			$z_cod_telefono->codigo->SetDbValueDef($rsnew, $z_cod_telefono->codigo->CurrentValue, "", $z_cod_telefono->codigo->ReadOnly);

			// cod_cel
			$z_cod_telefono->cod_cel->SetDbValueDef($rsnew, $z_cod_telefono->cod_cel->CurrentValue, 0, $z_cod_telefono->cod_cel->ReadOnly);

			// visibilidad
			$z_cod_telefono->visibilidad->SetDbValueDef($rsnew, $z_cod_telefono->visibilidad->CurrentValue, NULL, $z_cod_telefono->visibilidad->ReadOnly);

			// descripcion
			$z_cod_telefono->descripcion->SetDbValueDef($rsnew, $z_cod_telefono->descripcion->CurrentValue, NULL, $z_cod_telefono->descripcion->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $z_cod_telefono->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($z_cod_telefono->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($z_cod_telefono->CancelMessage <> "") {
					$this->setFailureMessage($z_cod_telefono->CancelMessage);
					$z_cod_telefono->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$z_cod_telefono->Row_Updated($rsold, $rsnew);
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
