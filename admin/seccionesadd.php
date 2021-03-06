<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "seccionesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$secciones_add = new csecciones_add();
$Page =& $secciones_add;

// Page init
$secciones_add->Page_Init();

// Page main
$secciones_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var secciones_add = new ew_Page("secciones_add");

// page properties
secciones_add.PageID = "add"; // page ID
secciones_add.FormID = "fseccionesadd"; // form ID
var EW_PAGE_ID = secciones_add.PageID; // for backward compatibility

// extend page with ValidateForm function
secciones_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($secciones->estatus->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_id_herramienta_financiera"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($secciones->id_herramienta_financiera->FldErrMsg()) ?>");

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
secciones_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secciones_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secciones_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secciones->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $secciones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $secciones_add->ShowPageHeader(); ?>
<?php
$secciones_add->ShowMessage();
?>
<form name="fseccionesadd" id="fseccionesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return secciones_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="secciones">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($secciones->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->imagen->FldCaption() ?></td>
		<td<?php echo $secciones->imagen->CellAttributes() ?>><span id="el_imagen">
<input type="text" name="x_imagen" id="x_imagen" size="30" maxlength="45" value="<?php echo $secciones->imagen->EditValue ?>"<?php echo $secciones->imagen->EditAttributes() ?>>
</span><?php echo $secciones->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secciones->contenido->Visible) { // contenido ?>
	<tr id="r_contenido"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->contenido->FldCaption() ?></td>
		<td<?php echo $secciones->contenido->CellAttributes() ?>><span id="el_contenido">
<textarea name="x_contenido" id="x_contenido" cols="35" rows="4"<?php echo $secciones->contenido->EditAttributes() ?>><?php echo $secciones->contenido->EditValue ?></textarea>
</span><?php echo $secciones->contenido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secciones->resumen->Visible) { // resumen ?>
	<tr id="r_resumen"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->resumen->FldCaption() ?></td>
		<td<?php echo $secciones->resumen->CellAttributes() ?>><span id="el_resumen">
<textarea name="x_resumen" id="x_resumen" cols="35" rows="4"<?php echo $secciones->resumen->EditAttributes() ?>><?php echo $secciones->resumen->EditValue ?></textarea>
</span><?php echo $secciones->resumen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secciones->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->estatus->FldCaption() ?></td>
		<td<?php echo $secciones->estatus->CellAttributes() ?>><span id="el_estatus">
<input type="text" name="x_estatus" id="x_estatus" size="30" value="<?php echo $secciones->estatus->EditValue ?>"<?php echo $secciones->estatus->EditAttributes() ?>>
</span><?php echo $secciones->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secciones->id_herramienta_financiera->Visible) { // id_herramienta_financiera ?>
	<tr id="r_id_herramienta_financiera"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->id_herramienta_financiera->FldCaption() ?></td>
		<td<?php echo $secciones->id_herramienta_financiera->CellAttributes() ?>><span id="el_id_herramienta_financiera">
<input type="text" name="x_id_herramienta_financiera" id="x_id_herramienta_financiera" size="30" value="<?php echo $secciones->id_herramienta_financiera->EditValue ?>"<?php echo $secciones->id_herramienta_financiera->EditAttributes() ?>>
</span><?php echo $secciones->id_herramienta_financiera->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secciones->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->titulo->FldCaption() ?></td>
		<td<?php echo $secciones->titulo->CellAttributes() ?>><span id="el_titulo">
<input type="text" name="x_titulo" id="x_titulo" size="30" maxlength="100" value="<?php echo $secciones->titulo->EditValue ?>"<?php echo $secciones->titulo->EditAttributes() ?>>
</span><?php echo $secciones->titulo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($secciones->imagen_interna->Visible) { // imagen_interna ?>
	<tr id="r_imagen_interna"<?php echo $secciones->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $secciones->imagen_interna->FldCaption() ?></td>
		<td<?php echo $secciones->imagen_interna->CellAttributes() ?>><span id="el_imagen_interna">
<input type="text" name="x_imagen_interna" id="x_imagen_interna" size="30" maxlength="50" value="<?php echo $secciones->imagen_interna->EditValue ?>"<?php echo $secciones->imagen_interna->EditAttributes() ?>>
</span><?php echo $secciones->imagen_interna->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$secciones_add->ShowPageFooter();
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
$secciones_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csecciones_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'secciones';

	// Page object name
	var $PageObjName = 'secciones_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $secciones;
		if ($secciones->UseTokenInUrl) $PageUrl .= "t=" . $secciones->TableVar . "&"; // Add page token
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
		global $objForm, $secciones;
		if ($secciones->UseTokenInUrl) {
			if ($objForm)
				return ($secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csecciones_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (secciones)
		if (!isset($GLOBALS["secciones"])) {
			$GLOBALS["secciones"] = new csecciones();
			$GLOBALS["Table"] =& $GLOBALS["secciones"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'secciones', TRUE);

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
		global $secciones;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $secciones;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$secciones->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$secciones->CurrentAction = "I"; // Form error, reset action
				$secciones->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_seccion"] != "") {
				$secciones->id_seccion->setQueryStringValue($_GET["id_seccion"]);
				$secciones->setKey("id_seccion", $secciones->id_seccion->CurrentValue); // Set up key
			} else {
				$secciones->setKey("id_seccion", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$secciones->CurrentAction = "C"; // Copy record
			} else {
				$secciones->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($secciones->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("seccioneslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$secciones->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $secciones->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "seccionesview.php")
						$sReturnUrl = $secciones->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$secciones->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$secciones->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$secciones->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $secciones;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $secciones;
		$secciones->imagen->CurrentValue = NULL;
		$secciones->imagen->OldValue = $secciones->imagen->CurrentValue;
		$secciones->contenido->CurrentValue = NULL;
		$secciones->contenido->OldValue = $secciones->contenido->CurrentValue;
		$secciones->resumen->CurrentValue = NULL;
		$secciones->resumen->OldValue = $secciones->resumen->CurrentValue;
		$secciones->estatus->CurrentValue = NULL;
		$secciones->estatus->OldValue = $secciones->estatus->CurrentValue;
		$secciones->id_herramienta_financiera->CurrentValue = NULL;
		$secciones->id_herramienta_financiera->OldValue = $secciones->id_herramienta_financiera->CurrentValue;
		$secciones->titulo->CurrentValue = NULL;
		$secciones->titulo->OldValue = $secciones->titulo->CurrentValue;
		$secciones->imagen_interna->CurrentValue = NULL;
		$secciones->imagen_interna->OldValue = $secciones->imagen_interna->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $secciones;
		if (!$secciones->imagen->FldIsDetailKey) {
			$secciones->imagen->setFormValue($objForm->GetValue("x_imagen"));
		}
		if (!$secciones->contenido->FldIsDetailKey) {
			$secciones->contenido->setFormValue($objForm->GetValue("x_contenido"));
		}
		if (!$secciones->resumen->FldIsDetailKey) {
			$secciones->resumen->setFormValue($objForm->GetValue("x_resumen"));
		}
		if (!$secciones->estatus->FldIsDetailKey) {
			$secciones->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$secciones->id_herramienta_financiera->FldIsDetailKey) {
			$secciones->id_herramienta_financiera->setFormValue($objForm->GetValue("x_id_herramienta_financiera"));
		}
		if (!$secciones->titulo->FldIsDetailKey) {
			$secciones->titulo->setFormValue($objForm->GetValue("x_titulo"));
		}
		if (!$secciones->imagen_interna->FldIsDetailKey) {
			$secciones->imagen_interna->setFormValue($objForm->GetValue("x_imagen_interna"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $secciones;
		$this->LoadOldRecord();
		$secciones->imagen->CurrentValue = $secciones->imagen->FormValue;
		$secciones->contenido->CurrentValue = $secciones->contenido->FormValue;
		$secciones->resumen->CurrentValue = $secciones->resumen->FormValue;
		$secciones->estatus->CurrentValue = $secciones->estatus->FormValue;
		$secciones->id_herramienta_financiera->CurrentValue = $secciones->id_herramienta_financiera->FormValue;
		$secciones->titulo->CurrentValue = $secciones->titulo->FormValue;
		$secciones->imagen_interna->CurrentValue = $secciones->imagen_interna->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $secciones;
		$sFilter = $secciones->KeyFilter();

		// Call Row Selecting event
		$secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$secciones->CurrentFilter = $sFilter;
		$sSql = $secciones->SQL();
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
		global $conn, $secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$secciones->Row_Selected($row);
		$secciones->id_seccion->setDbValue($rs->fields('id_seccion'));
		$secciones->imagen->setDbValue($rs->fields('imagen'));
		$secciones->contenido->setDbValue($rs->fields('contenido'));
		$secciones->resumen->setDbValue($rs->fields('resumen'));
		$secciones->estatus->setDbValue($rs->fields('estatus'));
		$secciones->id_herramienta_financiera->setDbValue($rs->fields('id_herramienta_financiera'));
		$secciones->titulo->setDbValue($rs->fields('titulo'));
		$secciones->imagen_interna->setDbValue($rs->fields('imagen_interna'));
	}

	// Load old record
	function LoadOldRecord() {
		global $secciones;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($secciones->getKey("id_seccion")) <> "")
			$secciones->id_seccion->CurrentValue = $secciones->getKey("id_seccion"); // id_seccion
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$secciones->CurrentFilter = $secciones->KeyFilter();
			$sSql = $secciones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $secciones;

		// Initialize URLs
		// Call Row_Rendering event

		$secciones->Row_Rendering();

		// Common render codes for all row types
		// id_seccion
		// imagen
		// contenido
		// resumen
		// estatus
		// id_herramienta_financiera
		// titulo
		// imagen_interna

		if ($secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_seccion
			$secciones->id_seccion->ViewValue = $secciones->id_seccion->CurrentValue;
			$secciones->id_seccion->ViewCustomAttributes = "";

			// imagen
			$secciones->imagen->ViewValue = $secciones->imagen->CurrentValue;
			$secciones->imagen->ViewCustomAttributes = "";

			// contenido
			$secciones->contenido->ViewValue = $secciones->contenido->CurrentValue;
			$secciones->contenido->ViewCustomAttributes = "";

			// resumen
			$secciones->resumen->ViewValue = $secciones->resumen->CurrentValue;
			$secciones->resumen->ViewCustomAttributes = "";

			// estatus
			$secciones->estatus->ViewValue = $secciones->estatus->CurrentValue;
			$secciones->estatus->ViewCustomAttributes = "";

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->ViewValue = $secciones->id_herramienta_financiera->CurrentValue;
			$secciones->id_herramienta_financiera->ViewCustomAttributes = "";

			// titulo
			$secciones->titulo->ViewValue = $secciones->titulo->CurrentValue;
			$secciones->titulo->ViewCustomAttributes = "";

			// imagen_interna
			$secciones->imagen_interna->ViewValue = $secciones->imagen_interna->CurrentValue;
			$secciones->imagen_interna->ViewCustomAttributes = "";

			// imagen
			$secciones->imagen->LinkCustomAttributes = "";
			$secciones->imagen->HrefValue = "";
			$secciones->imagen->TooltipValue = "";

			// contenido
			$secciones->contenido->LinkCustomAttributes = "";
			$secciones->contenido->HrefValue = "";
			$secciones->contenido->TooltipValue = "";

			// resumen
			$secciones->resumen->LinkCustomAttributes = "";
			$secciones->resumen->HrefValue = "";
			$secciones->resumen->TooltipValue = "";

			// estatus
			$secciones->estatus->LinkCustomAttributes = "";
			$secciones->estatus->HrefValue = "";
			$secciones->estatus->TooltipValue = "";

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->LinkCustomAttributes = "";
			$secciones->id_herramienta_financiera->HrefValue = "";
			$secciones->id_herramienta_financiera->TooltipValue = "";

			// titulo
			$secciones->titulo->LinkCustomAttributes = "";
			$secciones->titulo->HrefValue = "";
			$secciones->titulo->TooltipValue = "";

			// imagen_interna
			$secciones->imagen_interna->LinkCustomAttributes = "";
			$secciones->imagen_interna->HrefValue = "";
			$secciones->imagen_interna->TooltipValue = "";
		} elseif ($secciones->RowType == EW_ROWTYPE_ADD) { // Add row

			// imagen
			$secciones->imagen->EditCustomAttributes = "";
			$secciones->imagen->EditValue = ew_HtmlEncode($secciones->imagen->CurrentValue);

			// contenido
			$secciones->contenido->EditCustomAttributes = "";
			$secciones->contenido->EditValue = ew_HtmlEncode($secciones->contenido->CurrentValue);

			// resumen
			$secciones->resumen->EditCustomAttributes = "";
			$secciones->resumen->EditValue = ew_HtmlEncode($secciones->resumen->CurrentValue);

			// estatus
			$secciones->estatus->EditCustomAttributes = "";
			$secciones->estatus->EditValue = ew_HtmlEncode($secciones->estatus->CurrentValue);

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->EditCustomAttributes = "";
			$secciones->id_herramienta_financiera->EditValue = ew_HtmlEncode($secciones->id_herramienta_financiera->CurrentValue);

			// titulo
			$secciones->titulo->EditCustomAttributes = "";
			$secciones->titulo->EditValue = ew_HtmlEncode($secciones->titulo->CurrentValue);

			// imagen_interna
			$secciones->imagen_interna->EditCustomAttributes = "";
			$secciones->imagen_interna->EditValue = ew_HtmlEncode($secciones->imagen_interna->CurrentValue);

			// Edit refer script
			// imagen

			$secciones->imagen->HrefValue = "";

			// contenido
			$secciones->contenido->HrefValue = "";

			// resumen
			$secciones->resumen->HrefValue = "";

			// estatus
			$secciones->estatus->HrefValue = "";

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->HrefValue = "";

			// titulo
			$secciones->titulo->HrefValue = "";

			// imagen_interna
			$secciones->imagen_interna->HrefValue = "";
		}
		if ($secciones->RowType == EW_ROWTYPE_ADD ||
			$secciones->RowType == EW_ROWTYPE_EDIT ||
			$secciones->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$secciones->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secciones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $secciones;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($secciones->estatus->FormValue)) {
			ew_AddMessage($gsFormError, $secciones->estatus->FldErrMsg());
		}
		if (!ew_CheckInteger($secciones->id_herramienta_financiera->FormValue)) {
			ew_AddMessage($gsFormError, $secciones->id_herramienta_financiera->FldErrMsg());
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
		global $conn, $Language, $Security, $secciones;
		$rsnew = array();

		// imagen
		$secciones->imagen->SetDbValueDef($rsnew, $secciones->imagen->CurrentValue, NULL, FALSE);

		// contenido
		$secciones->contenido->SetDbValueDef($rsnew, $secciones->contenido->CurrentValue, NULL, FALSE);

		// resumen
		$secciones->resumen->SetDbValueDef($rsnew, $secciones->resumen->CurrentValue, NULL, FALSE);

		// estatus
		$secciones->estatus->SetDbValueDef($rsnew, $secciones->estatus->CurrentValue, NULL, FALSE);

		// id_herramienta_financiera
		$secciones->id_herramienta_financiera->SetDbValueDef($rsnew, $secciones->id_herramienta_financiera->CurrentValue, NULL, FALSE);

		// titulo
		$secciones->titulo->SetDbValueDef($rsnew, $secciones->titulo->CurrentValue, NULL, FALSE);

		// imagen_interna
		$secciones->imagen_interna->SetDbValueDef($rsnew, $secciones->imagen_interna->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $secciones->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($secciones->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($secciones->CancelMessage <> "") {
				$this->setFailureMessage($secciones->CancelMessage);
				$secciones->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$secciones->id_seccion->setDbValue($conn->Insert_ID());
			$rsnew['id_seccion'] = $secciones->id_seccion->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$secciones->Row_Inserted($rs, $rsnew);
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
