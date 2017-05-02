<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuarios_add = new cusuarios_add();
$Page =& $usuarios_add;

// Page init
$usuarios_add->Page_Init();

// Page main
$usuarios_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script src="http://code.jquery.com/jquery-1.7.min.js"></script>
<script type="text/javascript">
<!--

// Create page object
var usuarios_add = new ew_Page("usuarios_add");

// page properties
usuarios_add.PageID = "add"; // page ID
usuarios_add.FormID = "fusuariosadd"; // form ID
var EW_PAGE_ID = usuarios_add.PageID; // for backward compatibility

	$(document).ready(function() {
		//you have to use keyup, because keydown will not catch the currently entered value
		$('#x_llave').keyup(function() { 			
			//valid_passd($(this).val());			
			valid_passd(1);			
		}).blur(function() {
			$('#pswd_info').hide();
		});		
	});		
	
	function act_pass(){
		var el1;
		el1 =  document.getElementById('x_acceso').value;
		document.getElementById('x_llave').value = el1;
	}
	
// extend page with ValidateForm function
usuarios_add.ValidateForm = function(fobj) {
	var pswdlength = false; var pswdletter = false; var pswduppercase = false; var pswdnumber = false; 	
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_correo"];
		if (elm && !ew_CheckEmail(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2("Correo Invalido") ?>");
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_apellido"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->apellido->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_acceso"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->acceso->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_llave"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->llave->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_UserLevelID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->UserLevelID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->estatus->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_duracion_pass"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->duracion_pass->FldCaption()) ?>");
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
usuarios_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuarios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuarios_add->ShowPageHeader(); ?>
<?php
$usuarios_add->ShowMessage();
?>
<form name="fusuariosadd" id="fusuariosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return usuarios_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="usuarios">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuarios->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->nombre->FldCaption() ?> <?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="45" value="<?php echo $usuarios->nombre->EditValue ?>"<?php echo $usuarios->nombre->EditAttributes() ?>>
</span><?php echo $usuarios->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->apellido->Visible) { // apellido ?>
	<tr id="r_apellido"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->apellido->FldCaption() ?> <?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->apellido->CellAttributes() ?>><span id="el_apellido">
<input type="text" name="x_apellido" id="x_apellido" size="30" maxlength="45" value="<?php echo $usuarios->apellido->EditValue ?>"<?php echo $usuarios->apellido->EditAttributes() ?>>
</span><?php echo $usuarios->apellido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->acceso->Visible) { // acceso ?>
	<tr id="r_acceso"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->acceso->FldCaption() ?> <?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->acceso->CellAttributes() ?>><span id="el_acceso">
<input type="text" name="x_acceso" id="x_acceso" onkeyup="act_pass();" size="15" maxlength="15" value="<?php echo $usuarios->acceso->EditValue ?>"<?php echo $usuarios->acceso->EditAttributes() ?>>
</span><?php echo $usuarios->acceso->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->llave->Visible) { // llave ?>
	<tr id="r_llave"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->llave->FldCaption() ?> <?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->llave->CellAttributes() ?>><span id="el_llave">
<input type="password" disabled="disabled" name="x_llave" id="x_llave" size="30" maxlength="30" onkeypress="valid_passd(1);" <?php echo $usuarios->llave->EditAttributes() ?>>
<div id="pswd_info">
	<h4>La contraseña debe tener contemplar lo siguiente:</h4>
	<ul>
		<li id="letter" class="invalid">Al menos un caracteres especial</li>
		<li id="capital" class="invalid">No debe contener valores asociados al nombre o apellido</li>
		<li id="number" class="invalid">Al menos 1 número</li>
		<li id="length" class="invalid">La cantidad de caracteres debe ser entre 8 y 10</li>
		<li id="sequenc1" class="invalid">No debe tener tres o más caracteres alfanuméricos consecutivos</li>
		<li id="sequenc2" class="invalid">No debe tener tres o más caracteres numéricos consecutivos</li>
		<li id="bco" class="invalid">No debe contener información sobre la institución</li>
		<li id="repetidos" class="invalid">No puede tener valores repetidos mas de 2 veces.</li> 
	</ul>
</div>
</span><?php echo $usuarios->llave->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->correo->Visible) { // correo ?>
	<tr id="r_correo"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->correo->FldCaption() ?></td>
		<td<?php echo $usuarios->correo->CellAttributes() ?>><span id="el_correo">
<input type="text" name="x_correo" id="x_correo" size="45" maxlength="45" value="<?php echo $usuarios->correo->EditValue ?>"<?php echo $usuarios->correo->EditAttributes() ?>>
</span><?php echo $usuarios->correo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->UserLevelID->Visible) { // UserLevelID ?>
	<tr id="r_UserLevelID"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->UserLevelID->FldCaption() ?> <?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->UserLevelID->CellAttributes() ?>><span id="el_UserLevelID">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $usuarios->UserLevelID->ViewAttributes() ?>><?php echo $usuarios->UserLevelID->EditValue ?></div>
<?php } else { ?>
<select id="x_UserLevelID" name="x_UserLevelID"<?php echo $usuarios->UserLevelID->EditAttributes() ?>>
<?php
if (is_array($usuarios->UserLevelID->EditValue)) {
	$arwrk = $usuarios->UserLevelID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($usuarios->UserLevelID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $usuarios->UserLevelID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $usuarios->estatus->EditAttributes() ?>>
<?php
if (is_array($usuarios->estatus->EditValue)) {
	$arwrk = $usuarios->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($usuarios->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $usuarios->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->duracion_pass->Visible) { // duracion_pass ?>
	<tr id="r_duracion_pass"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->duracion_pass->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->duracion_pass->CellAttributes() ?>><span id="el_duracion_pass">
<select id="x_duracion_pass" name="x_duracion_pass"<?php echo $usuarios->duracion_pass->EditAttributes() ?>>
<?php
if (is_array($usuarios->duracion_pass->EditValue)) {
	$arwrk = $usuarios->duracion_pass->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($usuarios->duracion_pass->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1]; ?>
</option>
<?php
	}
}
?>
</select>

<script>
/*esto seria lo nuevo para agreg la considion en un nuevo usuario*/
$('#x_duracion_pass').append( new Option('Nuevo','0') );  
</script>

</span><?php echo $usuarios->duracion_pass->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$usuarios_add->ShowPageFooter();
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
$usuarios_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'usuarios';

	// Page object name
	var $PageObjName = 'usuarios_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuarios;
		if ($usuarios->UseTokenInUrl) $PageUrl .= "t=" . $usuarios->TableVar . "&"; // Add page token
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
		global $objForm, $usuarios;
		if ($usuarios->UseTokenInUrl) {
			if ($objForm)
				return ($usuarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuarios_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuarios)
		if (!isset($GLOBALS["usuarios"])) {
			$GLOBALS["usuarios"] = new cusuarios();
			$GLOBALS["Table"] =& $GLOBALS["usuarios"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuarios', TRUE);

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
		global $usuarios;

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
			$this->Page_Terminate("usuarioslist.php");
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
		global $objForm, $Language, $gsFormError, $usuarios;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$usuarios->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$usuarios->CurrentAction = "I"; // Form error, reset action
				$usuarios->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_usuario"] != "") {
				$usuarios->id_usuario->setQueryStringValue($_GET["id_usuario"]);
				$usuarios->setKey("id_usuario", $usuarios->id_usuario->CurrentValue); // Set up key
			} else {
				$usuarios->setKey("id_usuario", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$usuarios->CurrentAction = "C"; // Copy record
			} else {
				$usuarios->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($usuarios->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("usuarioslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$usuarios->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $usuarios->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "usuariosview.php")
						$sReturnUrl = $usuarios->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$usuarios->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$usuarios->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$usuarios->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $usuarios;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $usuarios;
		$usuarios->nombre->CurrentValue = NULL;
		$usuarios->nombre->OldValue = $usuarios->nombre->CurrentValue;
		$usuarios->apellido->CurrentValue = NULL;
		$usuarios->apellido->OldValue = $usuarios->apellido->CurrentValue;
		$usuarios->acceso->CurrentValue = NULL;
		$usuarios->acceso->OldValue = $usuarios->acceso->CurrentValue;
		$usuarios->llave->CurrentValue = NULL;
		$usuarios->llave->OldValue = $usuarios->llave->CurrentValue;
		$usuarios->correo->CurrentValue = NULL;
		$usuarios->correo->OldValue = $usuarios->correo->CurrentValue;
		$usuarios->UserLevelID->CurrentValue = NULL;
		$usuarios->UserLevelID->OldValue = $usuarios->UserLevelID->CurrentValue;
		$usuarios->estatus->CurrentValue = NULL;
		$usuarios->estatus->OldValue = $usuarios->estatus->CurrentValue;
		$usuarios->duracion_pass->CurrentValue = 0;
		$usuarios->duracion_fech->CurrentValue = NULL;
		$usuarios->duracion_fech->OldValue = $usuarios->duracion_fech->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $usuarios;
		if (!$usuarios->nombre->FldIsDetailKey) {
			$usuarios->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$usuarios->apellido->FldIsDetailKey) {
			$usuarios->apellido->setFormValue($objForm->GetValue("x_apellido"));
		}
		if (!$usuarios->acceso->FldIsDetailKey) {
			$usuarios->acceso->setFormValue($objForm->GetValue("x_acceso"));
		}
		if (!$usuarios->llave->FldIsDetailKey) {
			$usuarios->llave->setFormValue($objForm->GetValue("x_llave"));
		}
		if (!$usuarios->correo->FldIsDetailKey) {
			$usuarios->correo->setFormValue($objForm->GetValue("x_correo"));
		}
		if (!$usuarios->UserLevelID->FldIsDetailKey) {
			$usuarios->UserLevelID->setFormValue($objForm->GetValue("x_UserLevelID"));
		}
		if (!$usuarios->estatus->FldIsDetailKey) {
			$usuarios->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$usuarios->duracion_pass->FldIsDetailKey) {
			$usuarios->duracion_pass->setFormValue($objForm->GetValue("e"));
		}
		if (!$usuarios->duracion_fech->FldIsDetailKey) {
			$usuarios->duracion_fech->setFormValue($objForm->GetValue("x_duracion_fech"));
			$usuarios->duracion_fech->CurrentValue = ew_UnFormatDateTime($usuarios->duracion_fech->CurrentValue, 5);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $usuarios;
		$this->LoadOldRecord();
		$usuarios->nombre->CurrentValue = $usuarios->nombre->FormValue;
		$usuarios->apellido->CurrentValue = $usuarios->apellido->FormValue;
		$usuarios->acceso->CurrentValue = $usuarios->acceso->FormValue;
		$usuarios->llave->CurrentValue = $usuarios->llave->FormValue;
		$usuarios->correo->CurrentValue = $usuarios->correo->FormValue;
		$usuarios->UserLevelID->CurrentValue = $usuarios->UserLevelID->FormValue;
		$usuarios->estatus->CurrentValue = $usuarios->estatus->FormValue;
		$usuarios->duracion_pass->CurrentValue = $usuarios->duracion_pass->FormValue;
		$usuarios->duracion_fech->CurrentValue = $usuarios->duracion_fech->FormValue;
		$usuarios->duracion_fech->CurrentValue = ew_UnFormatDateTime($usuarios->duracion_fech->CurrentValue, 5);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuarios;
		$sFilter = $usuarios->KeyFilter();

		// Call Row Selecting event
		$usuarios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuarios->CurrentFilter = $sFilter;
		$sSql = $usuarios->SQL();
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
		global $conn, $usuarios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuarios->Row_Selected($row);
		$usuarios->id_usuario->setDbValue($rs->fields('id_usuario'));
		$usuarios->nombre->setDbValue($rs->fields('nombre'));
		$usuarios->apellido->setDbValue($rs->fields('apellido'));
		$usuarios->acceso->setDbValue($rs->fields('acceso'));
		$usuarios->llave->setDbValue($rs->fields('llave'));
		$usuarios->correo->setDbValue($rs->fields('correo'));
		$usuarios->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$usuarios->estatus->setDbValue($rs->fields('estatus'));
		$usuarios->duracion_pass->setDbValue($rs->fields('duracion_pass'));
		$usuarios->duracion_fech->setDbValue($rs->fields('duracion_fech'));
	}

	// Load old record
	function LoadOldRecord() {
		global $usuarios;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($usuarios->getKey("id_usuario")) <> "")
			$usuarios->id_usuario->CurrentValue = $usuarios->getKey("id_usuario"); // id_usuario
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$usuarios->CurrentFilter = $usuarios->KeyFilter();
			$sSql = $usuarios->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuarios;

		// Initialize URLs
		// Call Row_Rendering event

		$usuarios->Row_Rendering();

		// Common render codes for all row types
		// id_usuario
		// nombre
		// apellido
		// acceso
		// llave
		// correo
		// UserLevelID
		// estatus

		if ($usuarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$usuarios->nombre->ViewValue = $usuarios->nombre->CurrentValue;
			$usuarios->nombre->ViewCustomAttributes = "";

			// apellido
			$usuarios->apellido->ViewValue = $usuarios->apellido->CurrentValue;
			$usuarios->apellido->ViewCustomAttributes = "";

			// acceso
			$usuarios->acceso->ViewValue = $usuarios->acceso->CurrentValue;
			$usuarios->acceso->ViewCustomAttributes = "";

			// llave
			$usuarios->llave->ViewValue = "********";
			$usuarios->llave->ViewCustomAttributes = "";

			// correo
			$usuarios->correo->ViewValue = $usuarios->correo->CurrentValue;
			$usuarios->correo->ViewCustomAttributes = "";

			// UserLevelID
			if ($Security->CanAdmin()) { // System admin
			if (strval($usuarios->UserLevelID->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($usuarios->UserLevelID->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `usuarioniveles`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$usuarios->UserLevelID->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$usuarios->UserLevelID->ViewValue = $usuarios->UserLevelID->CurrentValue;
				}
			} else {
				$usuarios->UserLevelID->ViewValue = NULL;
			}
			} else {
				$usuarios->UserLevelID->ViewValue = "********";
			}
			$usuarios->UserLevelID->ViewCustomAttributes = "";

			// estatus
			if (strval($usuarios->estatus->CurrentValue) <> "") {
				switch ($usuarios->estatus->CurrentValue) {
					case "1":
						$usuarios->estatus->ViewValue = $usuarios->estatus->FldTagCaption(1) <> "" ? $usuarios->estatus->FldTagCaption(1) : $usuarios->estatus->CurrentValue;
						break;
					case "0":
						$usuarios->estatus->ViewValue = $usuarios->estatus->FldTagCaption(2) <> "" ? $usuarios->estatus->FldTagCaption(2) : $usuarios->estatus->CurrentValue;
						break;
					default:
						$usuarios->estatus->ViewValue = $usuarios->estatus->CurrentValue;
				}
			} else {
				$usuarios->estatus->ViewValue = NULL;
			}
			$usuarios->estatus->ViewCustomAttributes = "";

			// duracion_pass
			if (strval($usuarios->duracion_pass->CurrentValue) <> "") {
				switch ($usuarios->duracion_pass->CurrentValue) {
					case "2":
						$usuarios->duracion_pass->ViewValue = $usuarios->duracion_pass->FldTagCaption(1) <> "" ? $usuarios->duracion_pass->FldTagCaption(1) : $usuarios->duracion_pass->CurrentValue;
						break;
					case "3":
						$usuarios->duracion_pass->ViewValue = $usuarios->duracion_pass->FldTagCaption(2) <> "" ? $usuarios->duracion_pass->FldTagCaption(2) : $usuarios->duracion_pass->CurrentValue;
						break;
					case "4":
						$usuarios->duracion_pass->ViewValue = $usuarios->duracion_pass->FldTagCaption(3) <> "" ? $usuarios->duracion_pass->FldTagCaption(3) : $usuarios->duracion_pass->CurrentValue;
						break;
					default:
						$usuarios->duracion_pass->ViewValue = $usuarios->duracion_pass->CurrentValue;
				}
			} else {
				$usuarios->duracion_pass->ViewValue = NULL;
			}
			$usuarios->duracion_pass->ViewCustomAttributes = "";

			// duracion_fech
			$usuarios->duracion_fech->ViewValue = $usuarios->duracion_fech->CurrentValue;
			$usuarios->duracion_fech->ViewValue = ew_FormatDateTime($usuarios->duracion_fech->ViewValue, 5);
			$usuarios->duracion_fech->ViewCustomAttributes = "";
			// nombre
			$usuarios->nombre->LinkCustomAttributes = "";
			$usuarios->nombre->HrefValue = "";
			$usuarios->nombre->TooltipValue = "";

			// apellido
			$usuarios->apellido->LinkCustomAttributes = "";
			$usuarios->apellido->HrefValue = "";
			$usuarios->apellido->TooltipValue = "";

			// acceso
			$usuarios->acceso->LinkCustomAttributes = "";
			$usuarios->acceso->HrefValue = "";
			$usuarios->acceso->TooltipValue = "";

			// llave
			$usuarios->llave->LinkCustomAttributes = "";
			$usuarios->llave->HrefValue = "";
			$usuarios->llave->TooltipValue = "";

			// correo
			$usuarios->correo->LinkCustomAttributes = "";
			$usuarios->correo->HrefValue = "";
			$usuarios->correo->TooltipValue = "";

			// UserLevelID
			$usuarios->UserLevelID->LinkCustomAttributes = "";
			$usuarios->UserLevelID->HrefValue = "";
			$usuarios->UserLevelID->TooltipValue = "";

			// estatus
			$usuarios->estatus->LinkCustomAttributes = "";
			$usuarios->estatus->HrefValue = "";
			$usuarios->estatus->TooltipValue = "";
			// duracion_pass
			$usuarios->duracion_pass->LinkCustomAttributes = "";
			$usuarios->duracion_pass->HrefValue = "";
			$usuarios->duracion_pass->TooltipValue = "";

			// duracion_fech
			$usuarios->duracion_fech->LinkCustomAttributes = "";
			$usuarios->duracion_fech->HrefValue = "";
			$usuarios->duracion_fech->TooltipValue = "";
		} elseif ($usuarios->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$usuarios->nombre->EditCustomAttributes = "";
			$usuarios->nombre->EditValue = ew_HtmlEncode($usuarios->nombre->CurrentValue);

			// apellido
			$usuarios->apellido->EditCustomAttributes = "";
			$usuarios->apellido->EditValue = ew_HtmlEncode($usuarios->apellido->CurrentValue);

			// acceso
			$usuarios->acceso->EditCustomAttributes = "";
			$usuarios->acceso->EditValue = ew_HtmlEncode($usuarios->acceso->CurrentValue);

			// llave
			$usuarios->llave->EditCustomAttributes = "";
			$usuarios->llave->EditValue = ew_HtmlEncode($usuarios->llave->CurrentValue);

			// correo
			$usuarios->correo->EditCustomAttributes = "";
			$usuarios->correo->EditValue = ew_HtmlEncode($usuarios->correo->CurrentValue);

			// UserLevelID
			$usuarios->UserLevelID->EditCustomAttributes = "";
			if (!$Security->CanAdmin()) { // System admin
				$usuarios->UserLevelID->EditValue = "********";
			} else {
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
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$usuarios->UserLevelID->EditValue = $arwrk;
			}

			// estatus
			$usuarios->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $usuarios->estatus->FldTagCaption(1) <> "" ? $usuarios->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $usuarios->estatus->FldTagCaption(2) <> "" ? $usuarios->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$usuarios->estatus->EditValue = $arwrk;

			// duracion_pass
			$usuarios->duracion_pass->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("2", $usuarios->duracion_pass->FldTagCaption(1) <> "" ? $usuarios->duracion_pass->FldTagCaption(1) : "2");
			$arwrk[] = array("3", $usuarios->duracion_pass->FldTagCaption(2) <> "" ? $usuarios->duracion_pass->FldTagCaption(2) : "3");
			$arwrk[] = array("4", $usuarios->duracion_pass->FldTagCaption(3) <> "" ? $usuarios->duracion_pass->FldTagCaption(3) : "4");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$usuarios->duracion_pass->EditValue = $arwrk;

			// duracion_fech
			// Edit refer script
			// nombre

			$usuarios->nombre->HrefValue = "";

			// apellido
			$usuarios->apellido->HrefValue = "";

			// acceso
			$usuarios->acceso->HrefValue = "";

			// llave
			$usuarios->llave->HrefValue = "";

			// correo
			$usuarios->correo->HrefValue = "";

			// UserLevelID
			$usuarios->UserLevelID->HrefValue = "";

			// estatus
			$usuarios->estatus->HrefValue = "";
			// duracion_pass
			$usuarios->duracion_pass->HrefValue = "";

			// duracion_fech
			$usuarios->duracion_fech->HrefValue = "";
		}
		if ($usuarios->RowType == EW_ROWTYPE_ADD ||
			$usuarios->RowType == EW_ROWTYPE_EDIT ||
			$usuarios->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$usuarios->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($usuarios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuarios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $usuarios;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckEmail($usuarios->correo->FormValue)) {
			ew_AddMessage($gsFormError, "");
		}
		if (!is_null($usuarios->estatus->FormValue) && $usuarios->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuarios->estatus->FldCaption());
		}
		if (!is_null($usuarios->duracion_pass->FormValue) && $usuarios->duracion_pass->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuarios->duracion_pass->FldCaption());
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
		global $conn, $Language, $Security, $usuarios;
		$rsnew = array();

		// nombre
		$usuarios->nombre->SetDbValueDef($rsnew, $usuarios->nombre->CurrentValue, NULL, FALSE);

		// apellido
		$usuarios->apellido->SetDbValueDef($rsnew, $usuarios->apellido->CurrentValue, NULL, FALSE);

		// acceso
		$usuarios->acceso->SetDbValueDef($rsnew, $usuarios->acceso->CurrentValue, NULL, FALSE);

		// llave
		$usuarios->llave->SetDbValueDef($rsnew, $usuarios->llave->CurrentValue, NULL, FALSE);

		// correo
		$usuarios->correo->SetDbValueDef($rsnew, $usuarios->correo->CurrentValue, NULL, FALSE);

		// UserLevelID
		if ($Security->CanAdmin()) { // System admin
		$usuarios->UserLevelID->SetDbValueDef($rsnew, $usuarios->UserLevelID->CurrentValue, NULL, FALSE);
		}

		// estatus
		$usuarios->estatus->SetDbValueDef($rsnew, $usuarios->estatus->CurrentValue, NULL, FALSE);

		// duracion_pass
		$usuarios->duracion_pass->SetDbValueDef($rsnew, $usuarios->duracion_pass->CurrentValue, 0, strval($usuarios->duracion_pass->CurrentValue) == "");

		// duracion_fech
		$usuarios->duracion_fech->SetDbValueDef($rsnew, ew_CurrentDate(), NULL);
		$rsnew['duracion_fech'] =& $usuarios->duracion_fech->DbValue;
		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $usuarios->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsnew['llave']=$rsnew['acceso'];
			$AddRow = $conn->Execute($usuarios->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($usuarios->CancelMessage <> "") {
				$this->setFailureMessage($usuarios->CancelMessage);
				$usuarios->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$usuarios->id_usuario->setDbValue($conn->Insert_ID());
			$rsnew['id_usuario'] = $usuarios->id_usuario->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$usuarios->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'usuarios';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $usuarios;
		$table = 'usuarios';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_usuario'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($usuarios->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($usuarios->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($usuarios->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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