<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "zmenuinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$zmenu_add = new czmenu_add();
$Page =& $zmenu_add;

// Page init
$zmenu_add->Page_Init();

// Page main
$zmenu_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var zmenu_add = new ew_Page("zmenu_add");

// page properties
zmenu_add.PageID = "add"; // page ID
zmenu_add.FormID = "fzmenuadd"; // form ID
var EW_PAGE_ID = zmenu_add.PageID; // for backward compatibility

// extend page with ValidateForm function
zmenu_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_id_grupo_seccion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($zmenu->id_grupo_seccion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_posicion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($zmenu->posicion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($zmenu->orden->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($zmenu->estatus->FldCaption()) ?>");

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
zmenu_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
zmenu_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
zmenu_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $zmenu->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $zmenu->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $zmenu_add->ShowPageHeader(); ?>
<?php
$zmenu_add->ShowMessage();
?>
<form name="fzmenuadd" id="fzmenuadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return zmenu_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="zmenu">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($zmenu->id_grupo_seccion->Visible) { // id_grupo_seccion ?>
	<tr id="r_id_grupo_seccion"<?php echo $zmenu->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zmenu->id_grupo_seccion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $zmenu->id_grupo_seccion->CellAttributes() ?>><span id="el_id_grupo_seccion">
<select id="x_id_grupo_seccion" name="x_id_grupo_seccion"<?php echo $zmenu->id_grupo_seccion->EditAttributes() ?>>
<?php
if (is_array($zmenu->id_grupo_seccion->EditValue)) {
	$arwrk = $zmenu->id_grupo_seccion->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($zmenu->id_grupo_seccion->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $zmenu->id_grupo_seccion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($zmenu->posicion->Visible) { // posicion ?>
	<tr id="r_posicion"<?php echo $zmenu->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zmenu->posicion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $zmenu->posicion->CellAttributes() ?>><span id="el_posicion">
<select id="x_posicion" name="x_posicion"<?php echo $zmenu->posicion->EditAttributes() ?>>
<?php
if (is_array($zmenu->posicion->EditValue)) {
	$arwrk = $zmenu->posicion->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($zmenu->posicion->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $zmenu->posicion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($zmenu->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $zmenu->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zmenu->orden->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $zmenu->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" size="3" maxlength="3" value="<?php echo $zmenu->orden->EditValue ?>"<?php echo $zmenu->orden->EditAttributes() ?>>
</span><?php echo $zmenu->orden->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($zmenu->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $zmenu->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zmenu->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $zmenu->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $zmenu->estatus->EditAttributes() ?>>
<?php
if (is_array($zmenu->estatus->EditValue)) {
	$arwrk = $zmenu->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($zmenu->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $zmenu->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$zmenu_add->ShowPageFooter();
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
$zmenu_add->Page_Terminate();
?>
<?php

//
// Page class
//
class czmenu_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'menu';

	// Page object name
	var $PageObjName = 'zmenu_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $zmenu;
		if ($zmenu->UseTokenInUrl) $PageUrl .= "t=" . $zmenu->TableVar . "&"; // Add page token
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
		global $objForm, $zmenu;
		if ($zmenu->UseTokenInUrl) {
			if ($objForm)
				return ($zmenu->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($zmenu->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function czmenu_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (zmenu)
		if (!isset($GLOBALS["zmenu"])) {
			$GLOBALS["zmenu"] = new czmenu();
			$GLOBALS["Table"] =& $GLOBALS["zmenu"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'menu', TRUE);

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
		global $zmenu;

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
			$this->Page_Terminate("zmenulist.php");
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
		global $objForm, $Language, $gsFormError, $zmenu;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$zmenu->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$zmenu->CurrentAction = "I"; // Form error, reset action
				$zmenu->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_menu"] != "") {
				$zmenu->id_menu->setQueryStringValue($_GET["id_menu"]);
				$zmenu->setKey("id_menu", $zmenu->id_menu->CurrentValue); // Set up key
			} else {
				$zmenu->setKey("id_menu", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$zmenu->CurrentAction = "C"; // Copy record
			} else {
				$zmenu->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($zmenu->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("zmenulist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$zmenu->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $zmenu->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "zmenuview.php")
						$sReturnUrl = $zmenu->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$zmenu->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$zmenu->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$zmenu->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $zmenu;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $zmenu;
		$zmenu->id_grupo_seccion->CurrentValue = NULL;
		$zmenu->id_grupo_seccion->OldValue = $zmenu->id_grupo_seccion->CurrentValue;
		$zmenu->posicion->CurrentValue = NULL;
		$zmenu->posicion->OldValue = $zmenu->posicion->CurrentValue;
		$zmenu->orden->CurrentValue = NULL;
		$zmenu->orden->OldValue = $zmenu->orden->CurrentValue;
		$zmenu->estatus->CurrentValue = NULL;
		$zmenu->estatus->OldValue = $zmenu->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $zmenu;
		if (!$zmenu->id_grupo_seccion->FldIsDetailKey) {
			$zmenu->id_grupo_seccion->setFormValue($objForm->GetValue("x_id_grupo_seccion"));
		}
		if (!$zmenu->posicion->FldIsDetailKey) {
			$zmenu->posicion->setFormValue($objForm->GetValue("x_posicion"));
		}
		if (!$zmenu->orden->FldIsDetailKey) {
			$zmenu->orden->setFormValue($objForm->GetValue("x_orden"));
		}
		if (!$zmenu->estatus->FldIsDetailKey) {
			$zmenu->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $zmenu;
		$this->LoadOldRecord();
		$zmenu->id_grupo_seccion->CurrentValue = $zmenu->id_grupo_seccion->FormValue;
		$zmenu->posicion->CurrentValue = $zmenu->posicion->FormValue;
		$zmenu->orden->CurrentValue = $zmenu->orden->FormValue;
		$zmenu->estatus->CurrentValue = $zmenu->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $zmenu;
		$sFilter = $zmenu->KeyFilter();

		// Call Row Selecting event
		$zmenu->Row_Selecting($sFilter);

		// Load SQL based on filter
		$zmenu->CurrentFilter = $sFilter;
		$sSql = $zmenu->SQL();
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
		global $conn, $zmenu;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$zmenu->Row_Selected($row);
		$zmenu->id_menu->setDbValue($rs->fields('id_menu'));
		$zmenu->id_grupo_seccion->setDbValue($rs->fields('id_grupo_seccion'));
		$zmenu->posicion->setDbValue($rs->fields('posicion'));
		$zmenu->orden->setDbValue($rs->fields('orden'));
		$zmenu->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $zmenu;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($zmenu->getKey("id_menu")) <> "")
			$zmenu->id_menu->CurrentValue = $zmenu->getKey("id_menu"); // id_menu
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$zmenu->CurrentFilter = $zmenu->KeyFilter();
			$sSql = $zmenu->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $zmenu;

		// Initialize URLs
		// Call Row_Rendering event

		$zmenu->Row_Rendering();

		// Common render codes for all row types
		// id_menu
		// id_grupo_seccion
		// posicion
		// orden
		// estatus

		if ($zmenu->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_grupo_seccion
			if (strval($zmenu->id_grupo_seccion->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($zmenu->id_grupo_seccion->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$zmenu->id_grupo_seccion->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$zmenu->id_grupo_seccion->ViewValue = $zmenu->id_grupo_seccion->CurrentValue;
				}
			} else {
				$zmenu->id_grupo_seccion->ViewValue = NULL;
			}
			$zmenu->id_grupo_seccion->ViewCustomAttributes = "";

			// posicion
			if (strval($zmenu->posicion->CurrentValue) <> "") {
				switch ($zmenu->posicion->CurrentValue) {
					case "1":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(1) <> "" ? $zmenu->posicion->FldTagCaption(1) : $zmenu->posicion->CurrentValue;
						break;
					case "2":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(2) <> "" ? $zmenu->posicion->FldTagCaption(2) : $zmenu->posicion->CurrentValue;
						break;
					case "3":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(3) <> "" ? $zmenu->posicion->FldTagCaption(3) : $zmenu->posicion->CurrentValue;
						break;
					case "4":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(4) <> "" ? $zmenu->posicion->FldTagCaption(4) : $zmenu->posicion->CurrentValue;
						break;
					default:
						$zmenu->posicion->ViewValue = $zmenu->posicion->CurrentValue;
				}
			} else {
				$zmenu->posicion->ViewValue = NULL;
			}
			$zmenu->posicion->ViewCustomAttributes = "";

			// orden
			$zmenu->orden->ViewValue = $zmenu->orden->CurrentValue;
			$zmenu->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($zmenu->estatus->CurrentValue) <> "") {
				switch ($zmenu->estatus->CurrentValue) {
					case "1":
						$zmenu->estatus->ViewValue = $zmenu->estatus->FldTagCaption(1) <> "" ? $zmenu->estatus->FldTagCaption(1) : $zmenu->estatus->CurrentValue;
						break;
					case "0":
						$zmenu->estatus->ViewValue = $zmenu->estatus->FldTagCaption(2) <> "" ? $zmenu->estatus->FldTagCaption(2) : $zmenu->estatus->CurrentValue;
						break;
					default:
						$zmenu->estatus->ViewValue = $zmenu->estatus->CurrentValue;
				}
			} else {
				$zmenu->estatus->ViewValue = NULL;
			}
			$zmenu->estatus->ViewCustomAttributes = "";

			// id_grupo_seccion
			$zmenu->id_grupo_seccion->LinkCustomAttributes = "";
			$zmenu->id_grupo_seccion->HrefValue = "";
			$zmenu->id_grupo_seccion->TooltipValue = "";

			// posicion
			$zmenu->posicion->LinkCustomAttributes = "";
			$zmenu->posicion->HrefValue = "";
			$zmenu->posicion->TooltipValue = "";

			// orden
			$zmenu->orden->LinkCustomAttributes = "";
			$zmenu->orden->HrefValue = "";
			$zmenu->orden->TooltipValue = "";

			// estatus
			$zmenu->estatus->LinkCustomAttributes = "";
			$zmenu->estatus->HrefValue = "";
			$zmenu->estatus->TooltipValue = "";
		} elseif ($zmenu->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_grupo_seccion
			$zmenu->id_grupo_seccion->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_grupo_seccion`, `titulo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `view2`";
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
			$zmenu->id_grupo_seccion->EditValue = $arwrk;

			// posicion
			$zmenu->posicion->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $zmenu->posicion->FldTagCaption(1) <> "" ? $zmenu->posicion->FldTagCaption(1) : "1");
			$arwrk[] = array("2", $zmenu->posicion->FldTagCaption(2) <> "" ? $zmenu->posicion->FldTagCaption(2) : "2");
			$arwrk[] = array("3", $zmenu->posicion->FldTagCaption(3) <> "" ? $zmenu->posicion->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $zmenu->posicion->FldTagCaption(4) <> "" ? $zmenu->posicion->FldTagCaption(4) : "4");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$zmenu->posicion->EditValue = $arwrk;

			// orden
			$zmenu->orden->EditCustomAttributes = "";
			$zmenu->orden->EditValue = ew_HtmlEncode($zmenu->orden->CurrentValue);

			// estatus
			$zmenu->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $zmenu->estatus->FldTagCaption(1) <> "" ? $zmenu->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $zmenu->estatus->FldTagCaption(2) <> "" ? $zmenu->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$zmenu->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_grupo_seccion

			$zmenu->id_grupo_seccion->HrefValue = "";

			// posicion
			$zmenu->posicion->HrefValue = "";

			// orden
			$zmenu->orden->HrefValue = "";

			// estatus
			$zmenu->estatus->HrefValue = "";
		}
		if ($zmenu->RowType == EW_ROWTYPE_ADD ||
			$zmenu->RowType == EW_ROWTYPE_EDIT ||
			$zmenu->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$zmenu->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($zmenu->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$zmenu->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $zmenu;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($zmenu->id_grupo_seccion->FormValue) && $zmenu->id_grupo_seccion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $zmenu->id_grupo_seccion->FldCaption());
		}
		if (!is_null($zmenu->posicion->FormValue) && $zmenu->posicion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $zmenu->posicion->FldCaption());
		}
		if (!is_null($zmenu->orden->FormValue) && $zmenu->orden->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $zmenu->orden->FldCaption());
		}
		if (!is_null($zmenu->estatus->FormValue) && $zmenu->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $zmenu->estatus->FldCaption());
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
		global $conn, $Language, $Security, $zmenu;
		$rsnew = array();

		// id_grupo_seccion
		$zmenu->id_grupo_seccion->SetDbValueDef($rsnew, $zmenu->id_grupo_seccion->CurrentValue, NULL, FALSE);

		// posicion
		$zmenu->posicion->SetDbValueDef($rsnew, $zmenu->posicion->CurrentValue, NULL, FALSE);

		// orden
		$zmenu->orden->SetDbValueDef($rsnew, $zmenu->orden->CurrentValue, NULL, FALSE);

		// estatus
		$zmenu->estatus->SetDbValueDef($rsnew, $zmenu->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $zmenu->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($zmenu->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($zmenu->CancelMessage <> "") {
				$this->setFailureMessage($zmenu->CancelMessage);
				$zmenu->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$zmenu->id_menu->setDbValue($conn->Insert_ID());
			$rsnew['id_menu'] = $zmenu->id_menu->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$zmenu->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'menu';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $zmenu;
		$table = 'menu';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_menu'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($zmenu->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($zmenu->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($zmenu->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
