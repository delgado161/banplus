<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "banner_seccioninfo.php" ?>
<?php include_once "bannerinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$banner_seccion_add = new cbanner_seccion_add();
$Page =& $banner_seccion_add;

// Page init
$banner_seccion_add->Page_Init();

// Page main
$banner_seccion_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var banner_seccion_add = new ew_Page("banner_seccion_add");

// page properties
banner_seccion_add.PageID = "add"; // page ID
banner_seccion_add.FormID = "fbanner_seccionadd"; // form ID
var EW_PAGE_ID = banner_seccion_add.PageID; // for backward compatibility

// extend page with ValidateForm function
banner_seccion_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_id_banner"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner_seccion->id_banner->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_grupo_secciones"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner_seccion->id_grupo_secciones->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_grupo_secciones"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($banner_seccion->id_grupo_secciones->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha_inicio"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($banner_seccion->fecha_inicio->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha_fin"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($banner_seccion->fecha_fin->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_id_posicion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner_seccion->id_posicion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner_seccion->orden->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($banner_seccion->orden->FldErrMsg()) ?>");

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
banner_seccion_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
banner_seccion_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banner_seccion_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banner_seccion->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $banner_seccion->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $banner_seccion_add->ShowPageHeader(); ?>
<?php
$banner_seccion_add->ShowMessage();
?>
<form name="fbanner_seccionadd" id="fbanner_seccionadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return banner_seccion_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="banner_seccion">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($banner_seccion->id_banner->Visible) { // id_banner ?>
	<tr id="r_id_banner"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->id_banner->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $banner_seccion->id_banner->CellAttributes() ?>><span id="el_id_banner">
<?php if ($banner_seccion->id_banner->getSessionValue() <> "") { ?>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ViewValue ?></div>
<input type="hidden" id="x_id_banner" name="x_id_banner" value="<?php echo ew_HtmlEncode($banner_seccion->id_banner->CurrentValue) ?>">
<?php } else { ?>
<select id="x_id_banner" name="x_id_banner"<?php echo $banner_seccion->id_banner->EditAttributes() ?>>
<?php
if (is_array($banner_seccion->id_banner->EditValue)) {
	$arwrk = $banner_seccion->id_banner->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner_seccion->id_banner->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $banner_seccion->id_banner->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->id_grupo_secciones->Visible) { // id_grupo_secciones ?>
	<tr id="r_id_grupo_secciones"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->id_grupo_secciones->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $banner_seccion->id_grupo_secciones->CellAttributes() ?>><span id="el_id_grupo_secciones">

<select id="x_id_grupo_secciones" name="x_id_grupo_secciones"<?php echo $banner_seccion->id_grupo_secciones->EditAttributes() ?>>
<?php
if (is_array($banner_seccion->id_grupo_secciones->EditValue)) {
	$arwrk = $banner_seccion->id_grupo_secciones->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner_seccion->id_grupo_secciones->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $banner_seccion->id_grupo_secciones->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->fecha_inicio->Visible) { // fecha_inicio ?>
	<tr id="r_fecha_inicio"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->fecha_inicio->FldCaption() ?></td>
		<td<?php echo $banner_seccion->fecha_inicio->CellAttributes() ?>><span id="el_fecha_inicio">
<input type="text" name="x_fecha_inicio" id="x_fecha_inicio" size="12" value="<?php echo $banner_seccion->fecha_inicio->EditValue ?>"<?php echo $banner_seccion->fecha_inicio->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_fecha_inicio" name="cal_x_fecha_inicio" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_fecha_inicio", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_fecha_inicio" // button id
});
</script>
</span><?php echo $banner_seccion->fecha_inicio->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->fecha_fin->Visible) { // fecha_fin ?>
	<tr id="r_fecha_fin"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->fecha_fin->FldCaption() ?></td>
		<td<?php echo $banner_seccion->fecha_fin->CellAttributes() ?>><span id="el_fecha_fin">
<input type="text" name="x_fecha_fin" id="x_fecha_fin" size="12" value="<?php echo $banner_seccion->fecha_fin->EditValue ?>"<?php echo $banner_seccion->fecha_fin->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_fecha_fin" name="cal_x_fecha_fin" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_fecha_fin", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_fecha_fin" // button id
});
</script>
</span><?php echo $banner_seccion->fecha_fin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->link->Visible) { // link ?>
	<tr id="r_link"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->link->FldCaption() ?></td>
		<td<?php echo $banner_seccion->link->CellAttributes() ?>><span id="el_link">
<textarea name="x_link" id="x_link" cols="45" rows="2"<?php echo $banner_seccion->link->EditAttributes() ?>><?php echo $banner_seccion->link->EditValue ?></textarea>
</span><?php echo $banner_seccion->link->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->externo->Visible) { // externo ?>
	<tr id="r_externo"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->externo->FldCaption() ?></td>
		<td<?php echo $banner_seccion->externo->CellAttributes() ?>><span id="el_externo">
<div id="tp_x_externo" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x_externo[]" id="x_externo[]" value="{value}"<?php echo $banner_seccion->externo->EditAttributes() ?>></div>
<div id="dsl_x_externo" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $banner_seccion->externo->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($banner_seccion->externo->CurrentValue));
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
<label><input type="checkbox" name="x_externo[]" id="x_externo[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $banner_seccion->externo->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $banner_seccion->externo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->id_posicion->Visible) { // id_posicion ?>
	<tr id="r_id_posicion"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->id_posicion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $banner_seccion->id_posicion->CellAttributes() ?>><span id="el_id_posicion">
<select id="x_id_posicion" name="x_id_posicion"<?php echo $banner_seccion->id_posicion->EditAttributes() ?>>
<?php
if (is_array($banner_seccion->id_posicion->EditValue)) {
	$arwrk = $banner_seccion->id_posicion->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner_seccion->id_posicion->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $banner_seccion->id_posicion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banner_seccion->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $banner_seccion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner_seccion->orden->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $banner_seccion->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" size="30" value="<?php echo $banner_seccion->orden->EditValue ?>"<?php echo $banner_seccion->orden->EditAttributes() ?>>
</span><?php echo $banner_seccion->orden->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$banner_seccion_add->ShowPageFooter();
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
$banner_seccion_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanner_seccion_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'banner_seccion';

	// Page object name
	var $PageObjName = 'banner_seccion_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banner_seccion;
		if ($banner_seccion->UseTokenInUrl) $PageUrl .= "t=" . $banner_seccion->TableVar . "&"; // Add page token
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
		global $objForm, $banner_seccion;
		if ($banner_seccion->UseTokenInUrl) {
			if ($objForm)
				return ($banner_seccion->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banner_seccion->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanner_seccion_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (banner_seccion)
		if (!isset($GLOBALS["banner_seccion"])) {
			$GLOBALS["banner_seccion"] = new cbanner_seccion();
			$GLOBALS["Table"] =& $GLOBALS["banner_seccion"];
		}

		// Table object (banner)
		if (!isset($GLOBALS['banner'])) $GLOBALS['banner'] = new cbanner();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banner_seccion', TRUE);

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
		global $banner_seccion;

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
			$this->Page_Terminate("banner_seccionlist.php");
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
		global $objForm, $Language, $gsFormError, $banner_seccion;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$banner_seccion->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$banner_seccion->CurrentAction = "I"; // Form error, reset action
				$banner_seccion->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_banner_seccion"] != "") {
				$banner_seccion->id_banner_seccion->setQueryStringValue($_GET["id_banner_seccion"]);
				$banner_seccion->setKey("id_banner_seccion", $banner_seccion->id_banner_seccion->CurrentValue); // Set up key
			} else {
				$banner_seccion->setKey("id_banner_seccion", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$banner_seccion->CurrentAction = "C"; // Copy record
			} else {
				$banner_seccion->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($banner_seccion->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("banner_seccionlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$banner_seccion->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $banner_seccion->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "banner_seccionview.php")
						$sReturnUrl = $banner_seccion->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$banner_seccion->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$banner_seccion->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$banner_seccion->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $banner_seccion;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $banner_seccion;
		$banner_seccion->id_banner->CurrentValue = NULL;
		$banner_seccion->id_banner->OldValue = $banner_seccion->id_banner->CurrentValue;
		$banner_seccion->id_grupo_secciones->CurrentValue = NULL;
		$banner_seccion->id_grupo_secciones->OldValue = $banner_seccion->id_grupo_secciones->CurrentValue;
		$banner_seccion->fecha_inicio->CurrentValue = NULL;
		$banner_seccion->fecha_inicio->OldValue = $banner_seccion->fecha_inicio->CurrentValue;
		$banner_seccion->fecha_fin->CurrentValue = NULL;
		$banner_seccion->fecha_fin->OldValue = $banner_seccion->fecha_fin->CurrentValue;
		$banner_seccion->link->CurrentValue = NULL;
		$banner_seccion->link->OldValue = $banner_seccion->link->CurrentValue;
		$banner_seccion->externo->CurrentValue = 0;
		$banner_seccion->id_posicion->CurrentValue = NULL;
		$banner_seccion->id_posicion->OldValue = $banner_seccion->id_posicion->CurrentValue;
		$banner_seccion->orden->CurrentValue = 1;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $banner_seccion;
		if (!$banner_seccion->id_banner->FldIsDetailKey) {
			$banner_seccion->id_banner->setFormValue($objForm->GetValue("x_id_banner"));
		}
		if (!$banner_seccion->id_grupo_secciones->FldIsDetailKey) {
			$banner_seccion->id_grupo_secciones->setFormValue($objForm->GetValue("x_id_grupo_secciones"));
		}
		if (!$banner_seccion->fecha_inicio->FldIsDetailKey) {
			$banner_seccion->fecha_inicio->setFormValue($objForm->GetValue("x_fecha_inicio"));
			$banner_seccion->fecha_inicio->CurrentValue = ew_UnFormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7);
		}
		if (!$banner_seccion->fecha_fin->FldIsDetailKey) {
			$banner_seccion->fecha_fin->setFormValue($objForm->GetValue("x_fecha_fin"));
			$banner_seccion->fecha_fin->CurrentValue = ew_UnFormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7);
		}
		if (!$banner_seccion->link->FldIsDetailKey) {
			$banner_seccion->link->setFormValue($objForm->GetValue("x_link"));
		}
		if (!$banner_seccion->externo->FldIsDetailKey) {
			$banner_seccion->externo->setFormValue($objForm->GetValue("x_externo"));
		}
		if (!$banner_seccion->id_posicion->FldIsDetailKey) {
			$banner_seccion->id_posicion->setFormValue($objForm->GetValue("x_id_posicion"));
		}
		if (!$banner_seccion->orden->FldIsDetailKey) {
			$banner_seccion->orden->setFormValue($objForm->GetValue("x_orden"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $banner_seccion;
		$this->LoadOldRecord();
		$banner_seccion->id_banner->CurrentValue = $banner_seccion->id_banner->FormValue;
		$banner_seccion->id_grupo_secciones->CurrentValue = $banner_seccion->id_grupo_secciones->FormValue;
		$banner_seccion->fecha_inicio->CurrentValue = $banner_seccion->fecha_inicio->FormValue;
		$banner_seccion->fecha_inicio->CurrentValue = ew_UnFormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7);
		$banner_seccion->fecha_fin->CurrentValue = $banner_seccion->fecha_fin->FormValue;
		$banner_seccion->fecha_fin->CurrentValue = ew_UnFormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7);
		$banner_seccion->link->CurrentValue = $banner_seccion->link->FormValue;
		$banner_seccion->externo->CurrentValue = $banner_seccion->externo->FormValue;
		$banner_seccion->id_posicion->CurrentValue = $banner_seccion->id_posicion->FormValue;
		$banner_seccion->orden->CurrentValue = $banner_seccion->orden->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banner_seccion;
		$sFilter = $banner_seccion->KeyFilter();

		// Call Row Selecting event
		$banner_seccion->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banner_seccion->CurrentFilter = $sFilter;
		$sSql = $banner_seccion->SQL();
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
		global $conn, $banner_seccion;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$banner_seccion->Row_Selected($row);
		$banner_seccion->id_banner_seccion->setDbValue($rs->fields('id_banner_seccion'));
		$banner_seccion->id_banner->setDbValue($rs->fields('id_banner'));
		$banner_seccion->id_grupo_secciones->setDbValue($rs->fields('id_grupo_secciones'));
		$banner_seccion->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$banner_seccion->fecha_fin->setDbValue($rs->fields('fecha_fin'));
		$banner_seccion->link->setDbValue($rs->fields('link'));
		$banner_seccion->externo->setDbValue($rs->fields('externo'));
		$banner_seccion->id_posicion->setDbValue($rs->fields('id_posicion'));
		$banner_seccion->orden->setDbValue($rs->fields('orden'));
	}

	// Load old record
	function LoadOldRecord() {
		global $banner_seccion;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($banner_seccion->getKey("id_banner_seccion")) <> "")
			$banner_seccion->id_banner_seccion->CurrentValue = $banner_seccion->getKey("id_banner_seccion"); // id_banner_seccion
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$banner_seccion->CurrentFilter = $banner_seccion->KeyFilter();
			$sSql = $banner_seccion->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banner_seccion;

		// Initialize URLs
		// Call Row_Rendering event

		$banner_seccion->Row_Rendering();

		// Common render codes for all row types
		// id_banner_seccion
		// id_banner
		// id_grupo_secciones
		// fecha_inicio
		// fecha_fin
		// link
		// externo
		// id_posicion
		// orden

		if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_banner
			if (strval($banner_seccion->id_banner->CurrentValue) <> "") {
				$sFilterWrk = "`id_banner` = " . ew_AdjustSql($banner_seccion->id_banner->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `banner`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_banner->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$banner_seccion->id_banner->ViewValue = $banner_seccion->id_banner->CurrentValue;
				}
			} else {
				$banner_seccion->id_banner->ViewValue = NULL;
			}
			$banner_seccion->id_banner->ViewCustomAttributes = "";

			// id_grupo_secciones
			if (strval($banner_seccion->id_grupo_secciones->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($banner_seccion->id_grupo_secciones->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view1`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_grupo_secciones->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$banner_seccion->id_grupo_secciones->ViewValue = $banner_seccion->id_grupo_secciones->CurrentValue;
				}
			} else {
				$banner_seccion->id_grupo_secciones->ViewValue = NULL;
			}
			$banner_seccion->id_grupo_secciones->ViewCustomAttributes = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->ViewValue = $banner_seccion->fecha_inicio->CurrentValue;
			$banner_seccion->fecha_inicio->ViewValue = ew_FormatDateTime($banner_seccion->fecha_inicio->ViewValue, 7);
			$banner_seccion->fecha_inicio->ViewCustomAttributes = "";

			// fecha_fin
			$banner_seccion->fecha_fin->ViewValue = $banner_seccion->fecha_fin->CurrentValue;
			$banner_seccion->fecha_fin->ViewValue = ew_FormatDateTime($banner_seccion->fecha_fin->ViewValue, 7);
			$banner_seccion->fecha_fin->ViewCustomAttributes = "";

			// link
			$banner_seccion->link->ViewValue = $banner_seccion->link->CurrentValue;
			$banner_seccion->link->ViewCustomAttributes = "";

			// externo
			if (strval($banner_seccion->externo->CurrentValue) <> "") {
				$banner_seccion->externo->ViewValue = "";
				$arwrk = explode(",", strval($banner_seccion->externo->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++) {
					switch (trim($arwrk[$ari])) {
						case "1":
							$banner_seccion->externo->ViewValue .= $banner_seccion->externo->FldTagCaption(1) <> "" ? $banner_seccion->externo->FldTagCaption(1) : trim($arwrk[$ari]);
							break;
						default:
							$banner_seccion->externo->ViewValue .= trim($arwrk[$ari]);
					}
					if ($ari < $cnt-1) $banner_seccion->externo->ViewValue .= ew_ViewOptionSeparator($ari);
				}
			} else {
				$banner_seccion->externo->ViewValue = NULL;
			}
			$banner_seccion->externo->ViewCustomAttributes = "";

			// id_posicion
			if (strval($banner_seccion->id_posicion->CurrentValue) <> "") {
				$sFilterWrk = "`id_posicion` = " . ew_AdjustSql($banner_seccion->id_posicion->CurrentValue) . "";
			$sSqlWrk = "SELECT `posicion` FROM `banner_posicion`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `posicion`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_posicion->ViewValue = $rswrk->fields('posicion');
					$rswrk->Close();
				} else {
					$banner_seccion->id_posicion->ViewValue = $banner_seccion->id_posicion->CurrentValue;
				}
			} else {
				$banner_seccion->id_posicion->ViewValue = NULL;
			}
			$banner_seccion->id_posicion->ViewCustomAttributes = "";

			// orden
			$banner_seccion->orden->ViewValue = $banner_seccion->orden->CurrentValue;
			$banner_seccion->orden->ViewCustomAttributes = "";

			// id_banner
			$banner_seccion->id_banner->LinkCustomAttributes = "";
			$banner_seccion->id_banner->HrefValue = "";
			$banner_seccion->id_banner->TooltipValue = "";

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->LinkCustomAttributes = "";
			$banner_seccion->id_grupo_secciones->HrefValue = "";
			$banner_seccion->id_grupo_secciones->TooltipValue = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->LinkCustomAttributes = "";
			$banner_seccion->fecha_inicio->HrefValue = "";
			$banner_seccion->fecha_inicio->TooltipValue = "";

			// fecha_fin
			$banner_seccion->fecha_fin->LinkCustomAttributes = "";
			$banner_seccion->fecha_fin->HrefValue = "";
			$banner_seccion->fecha_fin->TooltipValue = "";

			// link
			$banner_seccion->link->LinkCustomAttributes = "";
			$banner_seccion->link->HrefValue = "";
			$banner_seccion->link->TooltipValue = "";

			// externo
			$banner_seccion->externo->LinkCustomAttributes = "";
			$banner_seccion->externo->HrefValue = "";
			$banner_seccion->externo->TooltipValue = "";

			// id_posicion
			$banner_seccion->id_posicion->LinkCustomAttributes = "";
			$banner_seccion->id_posicion->HrefValue = "";
			$banner_seccion->id_posicion->TooltipValue = "";

			// orden
			$banner_seccion->orden->LinkCustomAttributes = "";
			$banner_seccion->orden->HrefValue = "";
			$banner_seccion->orden->TooltipValue = "";
		} elseif ($banner_seccion->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_banner
			$banner_seccion->id_banner->EditCustomAttributes = "";
			if ($banner_seccion->id_banner->getSessionValue() <> "") {
				$banner_seccion->id_banner->CurrentValue = $banner_seccion->id_banner->getSessionValue();
			if (strval($banner_seccion->id_banner->CurrentValue) <> "") {
				$sFilterWrk = "`id_banner` = " . ew_AdjustSql($banner_seccion->id_banner->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `banner`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_banner->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$banner_seccion->id_banner->ViewValue = $banner_seccion->id_banner->CurrentValue;
				}
			} else {
				$banner_seccion->id_banner->ViewValue = NULL;
			}
			$banner_seccion->id_banner->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_banner`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `banner`";
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
			$banner_seccion->id_banner->EditValue = $arwrk;
			}

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->EditCustomAttributes = "";

				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_grupo_seccion`, `titulo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `view1`";
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
			$banner_seccion->id_grupo_secciones->EditValue = $arwrk;

			// fecha_inicio
			$banner_seccion->fecha_inicio->EditCustomAttributes = "";
			$banner_seccion->fecha_inicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7));

			// fecha_fin
			$banner_seccion->fecha_fin->EditCustomAttributes = "";
			$banner_seccion->fecha_fin->EditValue = ew_HtmlEncode(ew_FormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7));

			// link
			$banner_seccion->link->EditCustomAttributes = "";
			$banner_seccion->link->EditValue = ew_HtmlEncode($banner_seccion->link->CurrentValue);

			// externo
			$banner_seccion->externo->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $banner_seccion->externo->FldTagCaption(1) <> "" ? $banner_seccion->externo->FldTagCaption(1) : "1");
			$banner_seccion->externo->EditValue = $arwrk;

			// id_posicion
			$banner_seccion->id_posicion->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_posicion`, `posicion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `banner_posicion`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `posicion`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$banner_seccion->id_posicion->EditValue = $arwrk;

			// orden
			$banner_seccion->orden->EditCustomAttributes = "";
			$banner_seccion->orden->EditValue = ew_HtmlEncode($banner_seccion->orden->CurrentValue);

			// Edit refer script
			// id_banner

			$banner_seccion->id_banner->HrefValue = "";

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->HrefValue = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->HrefValue = "";

			// fecha_fin
			$banner_seccion->fecha_fin->HrefValue = "";

			// link
			$banner_seccion->link->HrefValue = "";

			// externo
			$banner_seccion->externo->HrefValue = "";

			// id_posicion
			$banner_seccion->id_posicion->HrefValue = "";

			// orden
			$banner_seccion->orden->HrefValue = "";
		}
		if ($banner_seccion->RowType == EW_ROWTYPE_ADD ||
			$banner_seccion->RowType == EW_ROWTYPE_EDIT ||
			$banner_seccion->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$banner_seccion->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($banner_seccion->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banner_seccion->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $banner_seccion;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($banner_seccion->id_banner->FormValue) && $banner_seccion->id_banner->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner_seccion->id_banner->FldCaption());
		}
		if (!is_null($banner_seccion->id_grupo_secciones->FormValue) && $banner_seccion->id_grupo_secciones->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner_seccion->id_grupo_secciones->FldCaption());
		}
		if (!ew_CheckInteger($banner_seccion->id_grupo_secciones->FormValue)) {
			ew_AddMessage($gsFormError, $banner_seccion->id_grupo_secciones->FldErrMsg());
		}
		if (!ew_CheckEuroDate($banner_seccion->fecha_inicio->FormValue)) {
			ew_AddMessage($gsFormError, $banner_seccion->fecha_inicio->FldErrMsg());
		}
		if (!ew_CheckEuroDate($banner_seccion->fecha_fin->FormValue)) {
			ew_AddMessage($gsFormError, $banner_seccion->fecha_fin->FldErrMsg());
		}
		if (!is_null($banner_seccion->id_posicion->FormValue) && $banner_seccion->id_posicion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner_seccion->id_posicion->FldCaption());
		}
		if (!is_null($banner_seccion->orden->FormValue) && $banner_seccion->orden->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner_seccion->orden->FldCaption());
		}
		if (!ew_CheckInteger($banner_seccion->orden->FormValue)) {
			ew_AddMessage($gsFormError, $banner_seccion->orden->FldErrMsg());
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
		global $conn, $Language, $Security, $banner_seccion;
		$rsnew = array();

		// id_banner
		$banner_seccion->id_banner->SetDbValueDef($rsnew, $banner_seccion->id_banner->CurrentValue, 0, FALSE);

		// id_grupo_secciones
		$banner_seccion->id_grupo_secciones->SetDbValueDef($rsnew, $banner_seccion->id_grupo_secciones->CurrentValue, 0, FALSE);

		// fecha_inicio
		$banner_seccion->fecha_inicio->SetDbValueDef($rsnew, ew_UnFormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7), NULL, FALSE);

		// fecha_fin
		$banner_seccion->fecha_fin->SetDbValueDef($rsnew, ew_UnFormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7), NULL, FALSE);

		// link
		$banner_seccion->link->SetDbValueDef($rsnew, $banner_seccion->link->CurrentValue, NULL, FALSE);

		// externo
		$banner_seccion->externo->SetDbValueDef($rsnew, $banner_seccion->externo->CurrentValue, NULL, strval($banner_seccion->externo->CurrentValue) == "");

		// id_posicion
		$banner_seccion->id_posicion->SetDbValueDef($rsnew, $banner_seccion->id_posicion->CurrentValue, NULL, FALSE);

		// orden
		$banner_seccion->orden->SetDbValueDef($rsnew, $banner_seccion->orden->CurrentValue, 0, strval($banner_seccion->orden->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $banner_seccion->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($banner_seccion->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($banner_seccion->CancelMessage <> "") {
				$this->setFailureMessage($banner_seccion->CancelMessage);
				$banner_seccion->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$banner_seccion->id_banner_seccion->setDbValue($conn->Insert_ID());
			$rsnew['id_banner_seccion'] = $banner_seccion->id_banner_seccion->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$banner_seccion->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $banner_seccion;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "banner") {
				$bValidMaster = TRUE;
				if (@$_GET["id_banner"] <> "") {
					$GLOBALS["banner"]->id_banner->setQueryStringValue($_GET["id_banner"]);
					$banner_seccion->id_banner->setQueryStringValue($GLOBALS["banner"]->id_banner->QueryStringValue);
					$banner_seccion->id_banner->setSessionValue($banner_seccion->id_banner->QueryStringValue);
					if (!is_numeric($GLOBALS["banner"]->id_banner->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$banner_seccion->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$banner_seccion->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "banner") {
				if ($banner_seccion->id_banner->QueryStringValue == "") $banner_seccion->id_banner->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $banner_seccion->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $banner_seccion->getDetailFilter(); // Get detail filter
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'banner_seccion';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $banner_seccion;
		$table = 'banner_seccion';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_banner_seccion'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($banner_seccion->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($banner_seccion->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($banner_seccion->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
