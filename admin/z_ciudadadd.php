<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_ciudadinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_ciudad_add = new cz_ciudad_add();
$Page =& $z_ciudad_add;

// Page init
$z_ciudad_add->Page_Init();

// Page main
$z_ciudad_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_ciudad_add = new ew_Page("z_ciudad_add");

// page properties
z_ciudad_add.PageID = "add"; // page ID
z_ciudad_add.FormID = "fz_ciudadadd"; // form ID
var EW_PAGE_ID = z_ciudad_add.PageID; // for backward compatibility

// extend page with ValidateForm function
z_ciudad_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_lf_estado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_ciudad->lf_estado->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_banplus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_ciudad->id_banplus->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_banplus"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($z_ciudad->id_banplus->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ciudad"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($z_ciudad->ciudad->FldCaption()) ?>");

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
z_ciudad_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_ciudad_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_ciudad_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_ciudad->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_ciudad->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_ciudad_add->ShowPageHeader(); ?>
<?php
$z_ciudad_add->ShowMessage();
?>
<form name="fz_ciudadadd" id="fz_ciudadadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return z_ciudad_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="z_ciudad">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($z_ciudad->lf_estado->Visible) { // lf_estado ?>
	<tr id="r_lf_estado"<?php echo $z_ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_ciudad->lf_estado->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_ciudad->lf_estado->CellAttributes() ?>><span id="el_lf_estado">
<select id="x_lf_estado" name="x_lf_estado"<?php echo $z_ciudad->lf_estado->EditAttributes() ?>>
<?php
if (is_array($z_ciudad->lf_estado->EditValue)) {
	$arwrk = $z_ciudad->lf_estado->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($z_ciudad->lf_estado->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $z_ciudad->lf_estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_ciudad->id_banplus->Visible) { // id_banplus ?>
	<tr id="r_id_banplus"<?php echo $z_ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_ciudad->id_banplus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_ciudad->id_banplus->CellAttributes() ?>><span id="el_id_banplus">
<input type="text" name="x_id_banplus" id="x_id_banplus" size="30" value="<?php echo $z_ciudad->id_banplus->EditValue ?>"<?php echo $z_ciudad->id_banplus->EditAttributes() ?>>
</span><?php echo $z_ciudad->id_banplus->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_ciudad->ciudad->Visible) { // ciudad ?>
	<tr id="r_ciudad"<?php echo $z_ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_ciudad->ciudad->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $z_ciudad->ciudad->CellAttributes() ?>><span id="el_ciudad">
<input type="text" name="x_ciudad" id="x_ciudad" size="30" maxlength="50" value="<?php echo $z_ciudad->ciudad->EditValue ?>"<?php echo $z_ciudad->ciudad->EditAttributes() ?>>
</span><?php echo $z_ciudad->ciudad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($z_ciudad->visibilidad->Visible) { // visibilidad ?>
	<tr id="r_visibilidad"<?php echo $z_ciudad->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $z_ciudad->visibilidad->FldCaption() ?></td>
		<td<?php echo $z_ciudad->visibilidad->CellAttributes() ?>><span id="el_visibilidad">
<div id="tp_x_visibilidad" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="{value}"<?php echo $z_ciudad->visibilidad->EditAttributes() ?>></label></div>
<div id="dsl_x_visibilidad" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $z_ciudad->visibilidad->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($z_ciudad->visibilidad->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_visibilidad" id="x_visibilidad" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $z_ciudad->visibilidad->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $z_ciudad->visibilidad->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$z_ciudad_add->ShowPageFooter();
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
$z_ciudad_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_ciudad_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = '_ciudad';

	// Page object name
	var $PageObjName = 'z_ciudad_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_ciudad;
		if ($z_ciudad->UseTokenInUrl) $PageUrl .= "t=" . $z_ciudad->TableVar . "&"; // Add page token
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
		global $objForm, $z_ciudad;
		if ($z_ciudad->UseTokenInUrl) {
			if ($objForm)
				return ($z_ciudad->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_ciudad->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_ciudad_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_ciudad)
		if (!isset($GLOBALS["z_ciudad"])) {
			$GLOBALS["z_ciudad"] = new cz_ciudad();
			$GLOBALS["Table"] =& $GLOBALS["z_ciudad"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_ciudad', TRUE);

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
		global $z_ciudad;

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
		global $objForm, $Language, $gsFormError, $z_ciudad;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$z_ciudad->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$z_ciudad->CurrentAction = "I"; // Form error, reset action
				$z_ciudad->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_ciudad"] != "") {
				$z_ciudad->id_ciudad->setQueryStringValue($_GET["id_ciudad"]);
				$z_ciudad->setKey("id_ciudad", $z_ciudad->id_ciudad->CurrentValue); // Set up key
			} else {
				$z_ciudad->setKey("id_ciudad", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$z_ciudad->CurrentAction = "C"; // Copy record
			} else {
				$z_ciudad->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($z_ciudad->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("z_ciudadlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$z_ciudad->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $z_ciudad->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "z_ciudadview.php")
						$sReturnUrl = $z_ciudad->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$z_ciudad->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$z_ciudad->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$z_ciudad->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $z_ciudad;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $z_ciudad;
		$z_ciudad->lf_estado->CurrentValue = NULL;
		$z_ciudad->lf_estado->OldValue = $z_ciudad->lf_estado->CurrentValue;
		$z_ciudad->id_banplus->CurrentValue = NULL;
		$z_ciudad->id_banplus->OldValue = $z_ciudad->id_banplus->CurrentValue;
		$z_ciudad->ciudad->CurrentValue = NULL;
		$z_ciudad->ciudad->OldValue = $z_ciudad->ciudad->CurrentValue;
		$z_ciudad->visibilidad->CurrentValue = NULL;
		$z_ciudad->visibilidad->OldValue = $z_ciudad->visibilidad->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $z_ciudad;
		if (!$z_ciudad->lf_estado->FldIsDetailKey) {
			$z_ciudad->lf_estado->setFormValue($objForm->GetValue("x_lf_estado"));
		}
		if (!$z_ciudad->id_banplus->FldIsDetailKey) {
			$z_ciudad->id_banplus->setFormValue($objForm->GetValue("x_id_banplus"));
		}
		if (!$z_ciudad->ciudad->FldIsDetailKey) {
			$z_ciudad->ciudad->setFormValue($objForm->GetValue("x_ciudad"));
		}
		if (!$z_ciudad->visibilidad->FldIsDetailKey) {
			$z_ciudad->visibilidad->setFormValue($objForm->GetValue("x_visibilidad"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $z_ciudad;
		$this->LoadOldRecord();
		$z_ciudad->lf_estado->CurrentValue = $z_ciudad->lf_estado->FormValue;
		$z_ciudad->id_banplus->CurrentValue = $z_ciudad->id_banplus->FormValue;
		$z_ciudad->ciudad->CurrentValue = $z_ciudad->ciudad->FormValue;
		$z_ciudad->visibilidad->CurrentValue = $z_ciudad->visibilidad->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_ciudad;
		$sFilter = $z_ciudad->KeyFilter();

		// Call Row Selecting event
		$z_ciudad->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_ciudad->CurrentFilter = $sFilter;
		$sSql = $z_ciudad->SQL();
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
		global $conn, $z_ciudad;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_ciudad->Row_Selected($row);
		$z_ciudad->id_ciudad->setDbValue($rs->fields('id_ciudad'));
		$z_ciudad->lf_estado->setDbValue($rs->fields('lf_estado'));
		$z_ciudad->id_banplus->setDbValue($rs->fields('id_banplus'));
		$z_ciudad->ciudad->setDbValue($rs->fields('ciudad'));
		$z_ciudad->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Load old record
	function LoadOldRecord() {
		global $z_ciudad;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($z_ciudad->getKey("id_ciudad")) <> "")
			$z_ciudad->id_ciudad->CurrentValue = $z_ciudad->getKey("id_ciudad"); // id_ciudad
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$z_ciudad->CurrentFilter = $z_ciudad->KeyFilter();
			$sSql = $z_ciudad->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_ciudad;

		// Initialize URLs
		// Call Row_Rendering event

		$z_ciudad->Row_Rendering();

		// Common render codes for all row types
		// id_ciudad
		// lf_estado
		// id_banplus
		// ciudad
		// visibilidad

		if ($z_ciudad->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_ciudad
			$z_ciudad->id_ciudad->ViewValue = $z_ciudad->id_ciudad->CurrentValue;
			$z_ciudad->id_ciudad->ViewCustomAttributes = "";

			// lf_estado
			if (strval($z_ciudad->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_ciudad->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_ciudad->lf_estado->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_ciudad->lf_estado->ViewValue = $z_ciudad->lf_estado->CurrentValue;
				}
			} else {
				$z_ciudad->lf_estado->ViewValue = NULL;
			}
			$z_ciudad->lf_estado->ViewCustomAttributes = "";

			// id_banplus
			$z_ciudad->id_banplus->ViewValue = $z_ciudad->id_banplus->CurrentValue;
			$z_ciudad->id_banplus->ViewCustomAttributes = "";

			// ciudad
			$z_ciudad->ciudad->ViewValue = $z_ciudad->ciudad->CurrentValue;
			$z_ciudad->ciudad->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_ciudad->visibilidad->CurrentValue) <> "") {
				switch ($z_ciudad->visibilidad->CurrentValue) {
					case "1":
						$z_ciudad->visibilidad->ViewValue = $z_ciudad->visibilidad->FldTagCaption(1) <> "" ? $z_ciudad->visibilidad->FldTagCaption(1) : $z_ciudad->visibilidad->CurrentValue;
						break;
					case "0":
						$z_ciudad->visibilidad->ViewValue = $z_ciudad->visibilidad->FldTagCaption(2) <> "" ? $z_ciudad->visibilidad->FldTagCaption(2) : $z_ciudad->visibilidad->CurrentValue;
						break;
					default:
						$z_ciudad->visibilidad->ViewValue = $z_ciudad->visibilidad->CurrentValue;
				}
			} else {
				$z_ciudad->visibilidad->ViewValue = NULL;
			}
			$z_ciudad->visibilidad->ViewCustomAttributes = "";

			// lf_estado
			$z_ciudad->lf_estado->LinkCustomAttributes = "";
			$z_ciudad->lf_estado->HrefValue = "";
			$z_ciudad->lf_estado->TooltipValue = "";

			// id_banplus
			$z_ciudad->id_banplus->LinkCustomAttributes = "";
			$z_ciudad->id_banplus->HrefValue = "";
			$z_ciudad->id_banplus->TooltipValue = "";

			// ciudad
			$z_ciudad->ciudad->LinkCustomAttributes = "";
			$z_ciudad->ciudad->HrefValue = "";
			$z_ciudad->ciudad->TooltipValue = "";

			// visibilidad
			$z_ciudad->visibilidad->LinkCustomAttributes = "";
			$z_ciudad->visibilidad->HrefValue = "";
			$z_ciudad->visibilidad->TooltipValue = "";
		} elseif ($z_ciudad->RowType == EW_ROWTYPE_ADD) { // Add row

			// lf_estado
			$z_ciudad->lf_estado->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id2_estado`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `_estados`";
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
			$z_ciudad->lf_estado->EditValue = $arwrk;

			// id_banplus
			$z_ciudad->id_banplus->EditCustomAttributes = "";
			$z_ciudad->id_banplus->EditValue = ew_HtmlEncode($z_ciudad->id_banplus->CurrentValue);

			// ciudad
			$z_ciudad->ciudad->EditCustomAttributes = "";
			$z_ciudad->ciudad->EditValue = ew_HtmlEncode($z_ciudad->ciudad->CurrentValue);

			// visibilidad
			$z_ciudad->visibilidad->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $z_ciudad->visibilidad->FldTagCaption(1) <> "" ? $z_ciudad->visibilidad->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $z_ciudad->visibilidad->FldTagCaption(2) <> "" ? $z_ciudad->visibilidad->FldTagCaption(2) : "0");
			$z_ciudad->visibilidad->EditValue = $arwrk;

			// Edit refer script
			// lf_estado

			$z_ciudad->lf_estado->HrefValue = "";

			// id_banplus
			$z_ciudad->id_banplus->HrefValue = "";

			// ciudad
			$z_ciudad->ciudad->HrefValue = "";

			// visibilidad
			$z_ciudad->visibilidad->HrefValue = "";
		}
		if ($z_ciudad->RowType == EW_ROWTYPE_ADD ||
			$z_ciudad->RowType == EW_ROWTYPE_EDIT ||
			$z_ciudad->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$z_ciudad->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($z_ciudad->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_ciudad->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $z_ciudad;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($z_ciudad->lf_estado->FormValue) && $z_ciudad->lf_estado->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_ciudad->lf_estado->FldCaption());
		}
		if (!is_null($z_ciudad->id_banplus->FormValue) && $z_ciudad->id_banplus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_ciudad->id_banplus->FldCaption());
		}
		if (!ew_CheckInteger($z_ciudad->id_banplus->FormValue)) {
			ew_AddMessage($gsFormError, $z_ciudad->id_banplus->FldErrMsg());
		}
		if (!is_null($z_ciudad->ciudad->FormValue) && $z_ciudad->ciudad->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $z_ciudad->ciudad->FldCaption());
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
		global $conn, $Language, $Security, $z_ciudad;
		$rsnew = array();

		// lf_estado
		$z_ciudad->lf_estado->SetDbValueDef($rsnew, $z_ciudad->lf_estado->CurrentValue, 0, FALSE);

		// id_banplus
		$z_ciudad->id_banplus->SetDbValueDef($rsnew, $z_ciudad->id_banplus->CurrentValue, 0, FALSE);

		// ciudad
		$z_ciudad->ciudad->SetDbValueDef($rsnew, $z_ciudad->ciudad->CurrentValue, "", FALSE);

		// visibilidad
		$z_ciudad->visibilidad->SetDbValueDef($rsnew, $z_ciudad->visibilidad->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $z_ciudad->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($z_ciudad->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($z_ciudad->CancelMessage <> "") {
				$this->setFailureMessage($z_ciudad->CancelMessage);
				$z_ciudad->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$z_ciudad->id_ciudad->setDbValue($conn->Insert_ID());
			$rsnew['id_ciudad'] = $z_ciudad->id_ciudad->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$z_ciudad->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
