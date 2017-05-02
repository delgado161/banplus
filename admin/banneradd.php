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
$banner_add = new cbanner_add();
$Page =& $banner_add;

// Page init
$banner_add->Page_Init();

// Page main
$banner_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var banner_add = new ew_Page("banner_add");

// page properties
banner_add.PageID = "add"; // page ID
banner_add.FormID = "fbanneradd"; // form ID
var EW_PAGE_ID = banner_add.PageID; // for backward compatibility

// extend page with ValidateForm function
banner_add.ValidateForm = function(fobj) {
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
banner_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
banner_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banner_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banner->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $banner->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $banner_add->ShowPageHeader(); ?>
<?php
$banner_add->ShowMessage();
?>
<form name="fbanneradd" id="fbanneradd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return banner_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="banner">
<input type="hidden" name="a_add" id="a_add" value="A">
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
<p>
<?php if ($banner->getCurrentDetailTable() == "banner_seccion" && $banner_seccion->DetailAdd) { ?>
<br>
<?php include_once "banner_secciongrid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$banner_add->ShowPageFooter();
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
$banner_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanner_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'banner';

	// Page object name
	var $PageObjName = 'banner_add';

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
	function cbanner_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $banner;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$banner->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$banner->CurrentAction = "I"; // Form error, reset action
				$banner->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_banner"] != "") {
				$banner->id_banner->setQueryStringValue($_GET["id_banner"]);
				$banner->setKey("id_banner", $banner->id_banner->CurrentValue); // Set up key
			} else {
				$banner->setKey("id_banner", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$banner->CurrentAction = "C"; // Copy record
			} else {
				$banner->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Perform action based on action code
		switch ($banner->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("bannerlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$banner->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($banner->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $banner->getDetailUrl();
					else
						$sReturnUrl = $banner->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "bannerview.php")
						$sReturnUrl = $banner->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$banner->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$banner->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $banner;
		$banner->nombre->CurrentValue = NULL;
		$banner->nombre->OldValue = $banner->nombre->CurrentValue;
		$banner->imagen->Upload->DbValue = NULL;
		$banner->imagen->OldValue = $banner->imagen->Upload->DbValue;
		$banner->estatus->CurrentValue = NULL;
		$banner->estatus->OldValue = $banner->estatus->CurrentValue;
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
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $banner;
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $banner;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($banner->getKey("id_banner")) <> "")
			$banner->id_banner->CurrentValue = $banner->getKey("id_banner"); // id_banner
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$banner->CurrentFilter = $banner->KeyFilter();
			$sSql = $banner->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($banner->RowType == EW_ROWTYPE_ADD) { // Add row

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
		if ($banner->getCurrentDetailTable() == "banner_seccion" && $GLOBALS["banner_seccion"]->DetailAdd) {
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $banner;

		// Begin transaction
		if ($banner->getCurrentDetailTable() <> "")
			$conn->BeginTrans();
		$rsnew = array();

		// nombre
		$banner->nombre->SetDbValueDef($rsnew, $banner->nombre->CurrentValue, NULL, FALSE);

		// imagen
		if ($banner->imagen->Upload->Action == "1") { // Keep
			if ($rsold) {
				$rsnew['imagen'] = $rsold->fields['imagen'];
			}
		} elseif ($banner->imagen->Upload->Action == "2" || $banner->imagen->Upload->Action == "3") { // Update/Remove
		if (is_null($banner->imagen->Upload->Value)) {
			$rsnew['imagen'] = NULL;
		} else {
			$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $banner->imagen->UploadPath), $banner->imagen->Upload->FileName);
		}
		}

		// estatus
		$banner->estatus->SetDbValueDef($rsnew, $banner->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $banner->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($banner->imagen->Upload->Value)) {
				$banner->imagen->Upload->SaveToFile($banner->imagen->UploadPath, $rsnew['imagen'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($banner->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($banner->CancelMessage <> "") {
				$this->setFailureMessage($banner->CancelMessage);
				$banner->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$banner->id_banner->setDbValue($conn->Insert_ID());
			$rsnew['id_banner'] = $banner->id_banner->DbValue;
		}

		// Add detail records
		if ($AddRow) {
			if ($banner->getCurrentDetailTable() == "banner_seccion" && $GLOBALS["banner_seccion"]->DetailAdd) {
				$GLOBALS["banner_seccion"]->id_banner->setSessionValue($banner->id_banner->CurrentValue); // Set master key
				$banner_seccion_grid = new cbanner_seccion_grid(); // get detail page object
				$AddRow = $banner_seccion_grid->GridInsert();
				$banner_seccion_grid = NULL;
			}
		}

		// Commit/Rollback transaction
		if ($banner->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$banner->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}

		// imagen
		$banner->imagen->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
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
				if ($GLOBALS["banner_seccion"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["banner_seccion"]->CurrentMode = "copy";
					else
						$GLOBALS["banner_seccion"]->CurrentMode = "add";
					$GLOBALS["banner_seccion"]->CurrentAction = "gridadd";

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

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $banner;
		$table = 'banner';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_banner'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($banner->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($banner->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($banner->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
