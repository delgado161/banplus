<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariopermisosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuariopermisos_edit = new cusuariopermisos_edit();
$Page =& $usuariopermisos_edit;

// Page init
$usuariopermisos_edit->Page_Init();

// Page main
$usuariopermisos_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuariopermisos_edit = new ew_Page("usuariopermisos_edit");

// page properties
usuariopermisos_edit.PageID = "edit"; // page ID
usuariopermisos_edit.FormID = "fusuariopermisosedit"; // form ID
var EW_PAGE_ID = usuariopermisos_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
usuariopermisos_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_ztablename"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuariopermisos->ztablename->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_permission"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuariopermisos->permission->FldCaption()) ?>");

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
usuariopermisos_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuariopermisos_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuariopermisos_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuariopermisos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuariopermisos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuariopermisos_edit->ShowPageHeader(); ?>
<?php
$usuariopermisos_edit->ShowMessage();
?>
<form name="fusuariopermisosedit" id="fusuariopermisosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return usuariopermisos_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="usuariopermisos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuariopermisos->userlevelid->Visible) { // userlevelid ?>
	<tr id="r_userlevelid"<?php echo $usuariopermisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuariopermisos->userlevelid->FldCaption() ?></td>
		<td<?php echo $usuariopermisos->userlevelid->CellAttributes() ?>><span id="el_userlevelid">
<div<?php echo $usuariopermisos->userlevelid->ViewAttributes() ?>><?php echo $usuariopermisos->userlevelid->EditValue ?></div>
<input type="hidden" name="x_userlevelid" id="x_userlevelid" value="<?php echo ew_HtmlEncode($usuariopermisos->userlevelid->CurrentValue) ?>">
</span><?php echo $usuariopermisos->userlevelid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuariopermisos->ztablename->Visible) { // tablename ?>
	<tr id="r_ztablename"<?php echo $usuariopermisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuariopermisos->ztablename->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuariopermisos->ztablename->CellAttributes() ?>><span id="el_ztablename">
<div<?php echo $usuariopermisos->ztablename->ViewAttributes() ?>><?php echo $usuariopermisos->ztablename->EditValue ?></div>
<input type="hidden" name="x_ztablename" id="x_ztablename" value="<?php echo ew_HtmlEncode($usuariopermisos->ztablename->CurrentValue) ?>">
</span><?php echo $usuariopermisos->ztablename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuariopermisos->permission->Visible) { // permission ?>
	<tr id="r_permission"<?php echo $usuariopermisos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuariopermisos->permission->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuariopermisos->permission->CellAttributes() ?>><span id="el_permission">
<div id="tp_x_permission" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x_permission[]" id="x_permission[]" value="{value}"<?php echo $usuariopermisos->permission->EditAttributes() ?>></div>
<div id="dsl_x_permission" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $usuariopermisos->permission->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($usuariopermisos->permission->CurrentValue));
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		$cnt = count($armultiwrk);
		for ($ari = 0; $ari < $cnt; $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " checked=\"checked\"";
				if ($selwrk <> "") $emptywrk = FALSE;
				break;
			}
		}

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="checkbox" name="x_permission[]" id="x_permission[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $usuariopermisos->permission->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $usuariopermisos->permission->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$usuariopermisos_edit->ShowPageFooter();
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
$usuariopermisos_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuariopermisos_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'usuariopermisos';

	// Page object name
	var $PageObjName = 'usuariopermisos_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuariopermisos;
		if ($usuariopermisos->UseTokenInUrl) $PageUrl .= "t=" . $usuariopermisos->TableVar . "&"; // Add page token
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
		global $objForm, $usuariopermisos;
		if ($usuariopermisos->UseTokenInUrl) {
			if ($objForm)
				return ($usuariopermisos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuariopermisos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuariopermisos_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuariopermisos)
		if (!isset($GLOBALS["usuariopermisos"])) {
			$GLOBALS["usuariopermisos"] = new cusuariopermisos();
			$GLOBALS["Table"] =& $GLOBALS["usuariopermisos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuariopermisos', TRUE);

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
		global $usuariopermisos;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $objForm, $Language, $gsFormError, $usuariopermisos;

		// Load key from QueryString
		if (@$_GET["userlevelid"] <> "")
			$usuariopermisos->userlevelid->setQueryStringValue($_GET["userlevelid"]);
		if (@$_GET["ztablename"] <> "")
			$usuariopermisos->ztablename->setQueryStringValue($_GET["ztablename"]);
		if (@$_POST["a_edit"] <> "") {
			$usuariopermisos->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$usuariopermisos->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$usuariopermisos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$usuariopermisos->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($usuariopermisos->userlevelid->CurrentValue == "")
			$this->Page_Terminate("usuariopermisoslist.php"); // Invalid key, return to list
		if ($usuariopermisos->ztablename->CurrentValue == "")
			$this->Page_Terminate("usuariopermisoslist.php"); // Invalid key, return to list
		switch ($usuariopermisos->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("usuariopermisoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$usuariopermisos->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $usuariopermisos->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$usuariopermisos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$usuariopermisos->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$usuariopermisos->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $usuariopermisos;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $usuariopermisos;
		if (!$usuariopermisos->userlevelid->FldIsDetailKey)
			$usuariopermisos->userlevelid->setFormValue($objForm->GetValue("x_userlevelid"));
		if (!$usuariopermisos->ztablename->FldIsDetailKey) {
			$usuariopermisos->ztablename->setFormValue($objForm->GetValue("x_ztablename"));
		}
		if (!$usuariopermisos->permission->FldIsDetailKey) {
			$usuariopermisos->permission->setFormValue($objForm->GetValue("x_permission"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $usuariopermisos;
		$this->LoadRow();
		$usuariopermisos->userlevelid->CurrentValue = $usuariopermisos->userlevelid->FormValue;
		$usuariopermisos->ztablename->CurrentValue = $usuariopermisos->ztablename->FormValue;
		$usuariopermisos->permission->CurrentValue = $usuariopermisos->permission->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuariopermisos;
		$sFilter = $usuariopermisos->KeyFilter();

		// Call Row Selecting event
		$usuariopermisos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuariopermisos->CurrentFilter = $sFilter;
		$sSql = $usuariopermisos->SQL();
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
		global $conn, $usuariopermisos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuariopermisos->Row_Selected($row);
		$usuariopermisos->userlevelid->setDbValue($rs->fields('userlevelid'));
		$usuariopermisos->ztablename->setDbValue($rs->fields('tablename'));
		$usuariopermisos->permission->setDbValue($rs->fields('permission'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuariopermisos;

		// Initialize URLs
		// Call Row_Rendering event

		$usuariopermisos->Row_Rendering();

		// Common render codes for all row types
		// userlevelid
		// tablename
		// permission

		if ($usuariopermisos->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$usuariopermisos->userlevelid->ViewValue = $usuariopermisos->userlevelid->CurrentValue;
			$usuariopermisos->userlevelid->ViewCustomAttributes = "";

			// tablename
			$usuariopermisos->ztablename->ViewValue = $usuariopermisos->ztablename->CurrentValue;
			$usuariopermisos->ztablename->ViewCustomAttributes = "";

			// permission
			if (strval($usuariopermisos->permission->CurrentValue) <> "") {
				$arwrk = explode(",", $usuariopermisos->permission->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`userlevelid` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `userlevelname` FROM `usuarioniveles`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$usuariopermisos->permission->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$usuariopermisos->permission->ViewValue .= $rswrk->fields('userlevelname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $usuariopermisos->permission->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$usuariopermisos->permission->ViewValue = $usuariopermisos->permission->CurrentValue;
				}
			} else {
				$usuariopermisos->permission->ViewValue = NULL;
			}
			$usuariopermisos->permission->ViewCustomAttributes = "";

			// userlevelid
			$usuariopermisos->userlevelid->LinkCustomAttributes = "";
			$usuariopermisos->userlevelid->HrefValue = "";
			$usuariopermisos->userlevelid->TooltipValue = "";

			// tablename
			$usuariopermisos->ztablename->LinkCustomAttributes = "";
			$usuariopermisos->ztablename->HrefValue = "";
			$usuariopermisos->ztablename->TooltipValue = "";

			// permission
			$usuariopermisos->permission->LinkCustomAttributes = "";
			$usuariopermisos->permission->HrefValue = "";
			$usuariopermisos->permission->TooltipValue = "";
		} elseif ($usuariopermisos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// userlevelid
			$usuariopermisos->userlevelid->EditCustomAttributes = "";
			$usuariopermisos->userlevelid->EditValue = $usuariopermisos->userlevelid->CurrentValue;
			$usuariopermisos->userlevelid->ViewCustomAttributes = "";

			// tablename
			$usuariopermisos->ztablename->EditCustomAttributes = "";
			$usuariopermisos->ztablename->EditValue = $usuariopermisos->ztablename->CurrentValue;
			$usuariopermisos->ztablename->ViewCustomAttributes = "";

			// permission
			$usuariopermisos->permission->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `usuarioniveles`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$usuariopermisos->permission->EditValue = $arwrk;

			// Edit refer script
			// userlevelid

			$usuariopermisos->userlevelid->HrefValue = "";

			// tablename
			$usuariopermisos->ztablename->HrefValue = "";

			// permission
			$usuariopermisos->permission->HrefValue = "";
		}
		if ($usuariopermisos->RowType == EW_ROWTYPE_ADD ||
			$usuariopermisos->RowType == EW_ROWTYPE_EDIT ||
			$usuariopermisos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$usuariopermisos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($usuariopermisos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuariopermisos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $usuariopermisos;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($usuariopermisos->ztablename->FormValue) && $usuariopermisos->ztablename->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuariopermisos->ztablename->FldCaption());
		}
		if ($usuariopermisos->permission->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuariopermisos->permission->FldCaption());
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
		global $conn, $Security, $Language, $usuariopermisos;
		$sFilter = $usuariopermisos->KeyFilter();
		$usuariopermisos->CurrentFilter = $sFilter;
		$sSql = $usuariopermisos->SQL();
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

			// tablename
			// permission

			$usuariopermisos->permission->SetDbValueDef($rsnew, $usuariopermisos->permission->CurrentValue, 0, $usuariopermisos->permission->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $usuariopermisos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($usuariopermisos->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($usuariopermisos->CancelMessage <> "") {
					$this->setFailureMessage($usuariopermisos->CancelMessage);
					$usuariopermisos->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$usuariopermisos->Row_Updated($rsold, $rsnew);
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
