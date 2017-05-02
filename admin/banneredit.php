<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "bannerinfo.php" ?>
<?php include_once "banner_seccioninfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "banner_secciongridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$banner_edit = new cbanner_edit();
$Page =& $banner_edit;

// Page init
$banner_edit->Page_Init();

// Page main
$banner_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var banner_edit = new ew_Page("banner_edit");

// page properties
banner_edit.PageID = "edit"; // page ID
banner_edit.FormID = "fbanneredit"; // form ID
var EW_PAGE_ID = banner_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
banner_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		aelm = fobj.elements["a" + infix + "_imagen"];
		var chk_imagen = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_imagen && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner->imagen->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		
		var cadena = elm.value; 
		x = ew_ValidAcent (cadena);
		if (x>0) {alert("El archivo no tiene que llevar caracteres especiales"); return false}
		
		
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($banner->estatus->FldCaption()) ?>");

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
banner_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
banner_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banner_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banner->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $banner->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $banner_edit->ShowPageHeader(); ?>
<?php
$banner_edit->ShowMessage();
?>
<form name="fbanneredit" id="fbanneredit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return banner_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="banner">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($banner->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $banner->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $banner->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="45" maxlength="45" value="<?php echo $banner->nombre->EditValue ?>"<?php echo $banner->nombre->EditAttributes() ?>>
</span><?php echo $banner->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banner->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $banner->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner->imagen->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $banner->imagen->CellAttributes() ?>><span id="el_imagen">
<div id="old_x_imagen">
<?php if ($banner->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($banner->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $banner->imagen->UploadPath) . $banner->imagen->Upload->DbValue ?>" border=0<?php echo $banner->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($banner->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($banner->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $banner->imagen->UploadPath) . $banner->imagen->Upload->DbValue ?>" border=0<?php echo $banner->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($banner->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_imagen">
<?php if (!empty($banner->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a_imagen" id="a_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $banner->imagen->EditAttrs["onchange"] = "this.form.a_imagen[2].checked=true;" . @$banner->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="3">
<?php } ?>
<input type="file" name="x_imagen" id="x_imagen" size="30"<?php echo $banner->imagen->EditAttributes() ?>>
</div>
</span><?php echo $banner->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banner->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $banner->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $banner->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $banner->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $banner->estatus->EditAttributes() ?>>
<?php
if (is_array($banner->estatus->EditValue)) {
	$arwrk = $banner->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banner->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $banner->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_banner" id="x_id_banner" value="<?php echo ew_HtmlEncode($banner->id_banner->CurrentValue) ?>">
<p>
<?php if ($banner->getCurrentDetailTable() == "banner_seccion" && $banner_seccion->DetailEdit) { ?>
<br>
<?php include_once "banner_secciongrid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$banner_edit->ShowPageFooter();
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
$banner_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanner_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'banner';

	// Page object name
	var $PageObjName = 'banner_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banner;
		if ($banner->UseTokenInUrl) $PageUrl .= "t=" . $banner->TableVar . "&"; // Add page token
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
		global $objForm, $banner;
		if ($banner->UseTokenInUrl) {
			if ($objForm)
				return ($banner->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banner->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanner_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (banner)
		if (!isset($GLOBALS["banner"])) {
			$GLOBALS["banner"] = new cbanner();
			$GLOBALS["Table"] =& $GLOBALS["banner"];
		}

		// Table object (banner_seccion)
		if (!isset($GLOBALS['banner_seccion'])) $GLOBALS['banner_seccion'] = new cbanner_seccion();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banner', TRUE);

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
		global $banner;

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
			$this->Page_Terminate("bannerlist.php");
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
		global $objForm, $Language, $gsFormError, $banner;

		// Load key from QueryString
		if (@$_GET["id_banner"] <> "")
			$banner->id_banner->setQueryStringValue($_GET["id_banner"]);
		if (@$_POST["a_edit"] <> "") {
			$banner->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$banner->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$banner->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$banner->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($banner->id_banner->CurrentValue == "")
			$this->Page_Terminate("bannerlist.php"); // Invalid key, return to list

		// Set up detail parameters
		$this->SetUpDetailParms();
		switch ($banner->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("bannerlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$banner->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					if ($banner->getCurrentDetailTable() <> "") // Master/detail edit
						$sReturnUrl = $banner->getDetailUrl();
					else
						$sReturnUrl = $banner->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$banner->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$banner->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$banner->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $banner;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$banner->imagen->Upload->Index = $objForm->Index;
		$banner->imagen->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$banner->imagen->Upload->RestoreFromSession();
		} else {
			if ($banner->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $banner->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$banner->imagen->Upload->SaveToSession();
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $banner;
		$this->GetUploadFiles(); // Get upload files
		if (!$banner->nombre->FldIsDetailKey) {
			$banner->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$banner->estatus->FldIsDetailKey) {
			$banner->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$banner->id_banner->FldIsDetailKey)
			$banner->id_banner->setFormValue($objForm->GetValue("x_id_banner"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $banner;
		$this->LoadRow();
		$banner->id_banner->CurrentValue = $banner->id_banner->FormValue;
		$banner->nombre->CurrentValue = $banner->nombre->FormValue;
		$banner->estatus->CurrentValue = $banner->estatus->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banner;
		$sFilter = $banner->KeyFilter();

		// Call Row Selecting event
		$banner->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banner->CurrentFilter = $sFilter;
		$sSql = $banner->SQL();
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
		global $conn, $banner;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$banner->Row_Selected($row);
		$banner->id_banner->setDbValue($rs->fields('id_banner'));
		$banner->nombre->setDbValue($rs->fields('nombre'));
		$banner->imagen->Upload->DbValue = $rs->fields('imagen');
		$banner->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banner;

		// Initialize URLs
		// Call Row_Rendering event

		$banner->Row_Rendering();

		// Common render codes for all row types
		// id_banner
		// nombre
		// imagen
		// estatus

		if ($banner->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$banner->nombre->ViewValue = $banner->nombre->CurrentValue;
			$banner->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($banner->imagen->Upload->DbValue)) {
				$banner->imagen->ViewValue = $banner->imagen->Upload->DbValue;
				$banner->imagen->ImageWidth = 30;
				$banner->imagen->ImageHeight = 30;
				$banner->imagen->ImageAlt = $banner->imagen->FldAlt();
			} else {
				$banner->imagen->ViewValue = "";
			}
			$banner->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($banner->estatus->CurrentValue) <> "") {
				switch ($banner->estatus->CurrentValue) {
				case "1":
						$banner->estatus->ViewValue = $banner->estatus->FldTagCaption(1) <> "" ? $banner->estatus->FldTagCaption(1) : $banner->estatus->CurrentValue;
						break;
					case "0":
						$banner->estatus->ViewValue = $banner->estatus->FldTagCaption(2) <> "" ? $banner->estatus->FldTagCaption(2) : $banner->estatus->CurrentValue;
						break;
					case "3":
						$banner->estatus->ViewValue = $banner->estatus->FldTagCaption(3) <> "" ? $banner->estatus->FldTagCaption(3) : $banner->estatus->CurrentValue;
						break;
					case "4":
						$banner->estatus->ViewValue = $banner->estatus->FldTagCaption(4) <> "" ? $banner->estatus->FldTagCaption(4) : $banner->estatus->CurrentValue;
						break;
					default:
						$banner->estatus->ViewValue = $banner->estatus->CurrentValue;
				}
			} else {
				$banner->estatus->ViewValue = NULL;
			}
			$banner->estatus->ViewCustomAttributes = "";

			// nombre
			$banner->nombre->LinkCustomAttributes = "";
			$banner->nombre->HrefValue = "";
			$banner->nombre->TooltipValue = "";

			// imagen
			$banner->imagen->LinkCustomAttributes = "";
			$banner->imagen->HrefValue = "";
			$banner->imagen->TooltipValue = "";

			// estatus
			$banner->estatus->LinkCustomAttributes = "";
			$banner->estatus->HrefValue = "";
			$banner->estatus->TooltipValue = "";
		} elseif ($banner->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$banner->nombre->EditCustomAttributes = "";
			$banner->nombre->EditValue = ew_HtmlEncode($banner->nombre->CurrentValue);

			// imagen
			$banner->imagen->EditCustomAttributes = "";
			if (!ew_Empty($banner->imagen->Upload->DbValue)) {
				$banner->imagen->EditValue = $banner->imagen->Upload->DbValue;
				$banner->imagen->ImageWidth = 30;
				$banner->imagen->ImageHeight = 30;
				$banner->imagen->ImageAlt = $banner->imagen->FldAlt();
			} else {
				$banner->imagen->EditValue = "";
			}

			// estatus
			$banner->estatus->EditCustomAttributes = "";
			$arwrk = array();
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("0", $banner->estatus->FldTagCaption(2) <> "" ? $banner->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $banner->estatus->FldTagCaption(3) <> "" ? $banner->estatus->FldTagCaption(3) : "3");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $banner->estatus->FldTagCaption(3) <> "" ? $banner->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $banner->estatus->FldTagCaption(4) <> "" ? $banner->estatus->FldTagCaption(4) : "4");
			}
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $banner->estatus->FldTagCaption(1) <> "" ? $banner->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $banner->estatus->FldTagCaption(4) <> "" ? $banner->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $banner->estatus->FldTagCaption(1) <> "" ? $banner->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $banner->estatus->FldTagCaption(2) <> "" ? $banner->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $banner->estatus->FldTagCaption(3) <> "" ? $banner->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $banner->estatus->FldTagCaption(4) <> "" ? $banner->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $banner->estatus->FldTagCaption(1) <> "" ? $banner->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $banner->estatus->FldTagCaption(2) <> "" ? $banner->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $banner->estatus->FldTagCaption(3) <> "" ? $banner->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $banner->estatus->FldTagCaption(4) <> "" ? $banner->estatus->FldTagCaption(4) : "4");
			}
			
			
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$banner->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$banner->nombre->HrefValue = "";

			// imagen
			$banner->imagen->HrefValue = "";

			// estatus
			$banner->estatus->HrefValue = "";
		}
		if ($banner->RowType == EW_ROWTYPE_ADD ||
			$banner->RowType == EW_ROWTYPE_EDIT ||
			$banner->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$banner->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($banner->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banner->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $banner;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($banner->imagen->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($banner->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $banner->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($banner->imagen->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $banner->imagen->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($banner->nombre->FormValue) && $banner->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner->nombre->FldCaption());
		}
		if ($banner->imagen->Upload->Action == "3" && is_null($banner->imagen->Upload->Value)) {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner->imagen->FldCaption());
		}
		if (!is_null($banner->estatus->FormValue) && $banner->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner->estatus->FldCaption());
		}

		// Validate detail grid
		if ($banner->getCurrentDetailTable() == "banner_seccion" && $GLOBALS["banner_seccion"]->DetailEdit) {
			$banner_seccion_grid = new cbanner_seccion_grid(); // get detail page object
			$banner_seccion_grid->ValidateGridForm();
			$banner_seccion_grid = NULL;
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
		global $conn, $Security, $Language, $banner;
		$sFilter = $banner->KeyFilter();
		$banner->CurrentFilter = $sFilter;
		$sSql = $banner->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($banner->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// nombre
			$banner->nombre->SetDbValueDef($rsnew, $banner->nombre->CurrentValue, NULL, $banner->nombre->ReadOnly);

			// imagen
			if ($banner->imagen->Upload->Action == "1") { // Keep
			} elseif ($banner->imagen->Upload->Action == "2" || $banner->imagen->Upload->Action == "3") { // Update/Remove
			$banner->imagen->Upload->DbValue = $rs->fields('imagen'); // Get original value
			if (is_null($banner->imagen->Upload->Value)) {
				$rsnew['imagen'] = NULL;
			} else {
				$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $banner->imagen->UploadPath), $banner->imagen->Upload->FileName);
			}
			}

			// estatus
			$banner->estatus->SetDbValueDef($rsnew, $banner->estatus->CurrentValue, NULL, $banner->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $banner->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($banner->imagen->Upload->Value)) {
				$banner->imagen->Upload->SaveToFile($banner->imagen->UploadPath, $rsnew['imagen'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($banner->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';

				// Update detail records
				if ($EditRow) {
					if ($banner->getCurrentDetailTable() == "banner_seccion" && $GLOBALS["banner_seccion"]->DetailEdit) {
						$banner_seccion_grid = new cbanner_seccion_grid(); // get detail page object
						$EditRow = $banner_seccion_grid->GridUpdate();
						$banner_seccion_grid = NULL;
					}
				}

				// Commit/Rollback transaction
				if ($banner->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($banner->CancelMessage <> "") {
					$this->setFailureMessage($banner->CancelMessage);
					$banner->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$banner->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// imagen
		$banner->imagen->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $banner;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$banner->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $banner->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "banner_seccion") {
				if (!isset($GLOBALS["banner_seccion"]))
					$GLOBALS["banner_seccion"] = new cbanner_seccion;
				if ($GLOBALS["banner_seccion"]->DetailEdit) {
					$GLOBALS["banner_seccion"]->CurrentMode = "edit";
					$GLOBALS["banner_seccion"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["banner_seccion"]->setCurrentMasterTable($banner->TableVar);
					$GLOBALS["banner_seccion"]->setStartRecordNumber(1);
					$GLOBALS["banner_seccion"]->id_banner->FldIsDetailKey = TRUE;
					$GLOBALS["banner_seccion"]->id_banner->CurrentValue = $banner->id_banner->CurrentValue;
					$GLOBALS["banner_seccion"]->id_banner->setSessionValue($GLOBALS["banner_seccion"]->id_banner->CurrentValue);
				}
			}
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'banner';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $banner;
		$table = 'banner';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_banner'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($banner->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($banner->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($banner->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($banner->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
