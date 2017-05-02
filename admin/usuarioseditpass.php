<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php include_once "../site/includes/i_comunes.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuarios_edit = new cusuarios_edit();
$Page =& $usuarios_edit;

// Page init
$usuarios_edit->Page_Init();

// Page main
$usuarios_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script src="http://code.jquery.com/jquery-1.7.min.js"></script>
<script type="text/javascript">
<!--

	$(document).ready(function() {
		//you have to use keyup, because keydown will not catch the currently entered value
		$('#x_llave').keyup(function() { 			
			//valid_passd($(this).val());			
			valid_passd(2);			
		}).blur(function() {
			$('#pswd_info').hide();
		});		
	});	

// Create page object
var usuarios_edit = new ew_Page("usuarios_edit");

// page properties
usuarios_edit.PageID = "edit"; // page ID
usuarios_edit.FormID = "fusuariosedit"; // form ID
var EW_PAGE_ID = usuarios_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
usuarios_edit.ValidateForm = function(fobj) {
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
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->estatus->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_duracion_pass"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->duracion_pass->FldCaption()) ?>");

		elm = fobj.elements["x" + infix + "_llave"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->llave->FldCaption()) ?>");	
			
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
usuarios_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_edit.ValidateRequired = false; // no JavaScript validation
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

<?php 
	if ($_GET['i']==1) { ?>
		<script type="text/javascript">alert('Se ha restaurado su acceso');</script>
<?php 
	} else { ?>
		<script type="text/javascript">alert('Su acceso ha caducado');</script>
<?php
	}
?>
	


<?php	
	if ($_SESSION['IDUSER']==""){
		header("location: grupolist.php");				
	}else {
		if ($_SESSION['IDUSER']==$_GET['id_usuario']){
			//echo "<li>ok:".$_SESSION['IDUSER'];
			global $conexion3;  
			$conexion3 = ew_Connect();
			$query = " SELECT nombre, apellido from usuarios where id_usuario = ".$_GET['id_usuario']." ";
			$result = $conexion3->GetArray($query);
			$nombreU = $result[0][0];
			$apellidoU = $result[0][1];
			
			$query = " SELECT * from historico_acceso where id_usuario = ".$_GET['id_usuario']." order by id_acceso desc limit 5 ";
			$result = $conexion3->GetArray($query);
			$md5pass = ""; /*pass de un array de claves*/
			
			for ($i=0;$i<count($result);$i++){
				if ($i==0)
					$md5pass.= $result[$i]['acceso'];
				else
					$md5pass.= "/".$result[$i]['acceso'];
			}

			
			
		}else {
			header("location: grupolist.php");
		}
	}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuarios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuarios_edit->ShowPageHeader(); ?>
<?php
$usuarios_edit->ShowMessage();
?>
<form name="fusuariosedit" id="fusuariosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return usuarios_edit.ValidateForm(this);">

<input type="hidden" name="u_nombre" id="u_nombre" value="<?php echo $nombreU; ?>">
<input type="hidden" name="u_apellido" id="u_apellido" value="<?php echo $apellidoU; ?>">
<input type="hidden" name="u_md5pass" id="u_md5pass" value="<?php echo $md5pass; ?>">

<p>
<input type="hidden" name="a_table" id="a_table" value="usuarios">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuarios->llave->Visible) { // llave ?>
	<tr id="r_llave"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->llave->FldCaption() ?> <?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->llave->CellAttributes() ?>><span id="el_llave">
<input type="password" name="x_llave" id="x_llave" onkeypress="valid_passd(2);" value="<?php /*echo $usuarios->llave->EditValue*/ ?>" size="30" maxlength="30"<?php echo $usuarios->llave->EditAttributes() ?>>
<div id="pswd_info">
	<h4>La contrase&ntilde;a debe tener contemplar lo siguiente:</h4>
	<ul>
		<li id="letter" class="invalid">Al menos un caracteres especial</li>
		<li id="capital" class="invalid">No debe contener valores asociados al nombre o apellido</li>
		<li id="number" class="invalid">Al menos 1 n&uacute;mero</li>
		<li id="carach" class="invalid">Al menos 1 car&aacute;cter del alfabeto</li>
		<li id="uppercase" class="invalid">Al menos 1 car&aacute;cter en may&uacute;scula</li>
		<li id="length" class="invalid">La cantidad de caracteres debe ser entre 8 y 10</li>
		<!--li id="sequenc1" class="invalid">No debe tener tres o m&aacute;s caracteres alfanum&eacute;ricos consecutivos</li>
		<li id="sequenc2" class="invalid">No debe tener tres o m&aacute;s caracteres num&eacute;ricos consecutivos</li-->
		<li id="bco" class="invalid">No debe contener informaci&oacute;n sobre la instituci&oacute;n</li>
		<li id="ultipass" class="invalid">No puede ser ninguna de las ultimas 5 contrase&ntilde;as usadas.</li>
		<li id="repetidos" class="invalid">No puede tener valores repetidos mas de 2 veces.</li> 
	</ul>
</div>
</span><?php echo $usuarios->llave->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->estatus->Visible) { // estatus ?>
	<tr style='display:none;' id="r_estatus"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus" <?php echo $usuarios->estatus->EditAttributes() ?>>
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
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $usuarios->duracion_pass->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_id_usuario" id="x_id_usuario" value="<?php echo ew_HtmlEncode($usuarios->id_usuario->CurrentValue) ?>">
<p>
<!--input type="submit" name="btnAction" id="btnAction" disabled="true" value="<?php //echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>"-->
<!--input type="submit" name="btnAction" id="btnAction" disabled="disabled" value="<?php //echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>"-->

<input type="submit" name="btnAction" id="btnAction" disable value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>"/>



</form>
<?php
$usuarios_edit->ShowPageFooter();
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
$usuarios_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'usuarios';

	// Page object name
	var $PageObjName = 'usuarios_edit';

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
	function cusuarios_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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

		$actual_l = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$actual_l = strpos($actual_l,'usuarioseditpass.php');
		
		if (!$actual_l){
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
				$this->Page_Terminate("usuarioslist.php");
			}
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
		global $objForm, $Language, $gsFormError, $usuarios;

		// Load key from QueryString
		if (@$_GET["id_usuario"] <> "")
			$usuarios->id_usuario->setQueryStringValue($_GET["id_usuario"]);
		if (@$_POST["a_edit"] <> "") {
			$usuarios->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$usuarios->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$usuarios->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$usuarios->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($usuarios->id_usuario->CurrentValue == "")
			$this->Page_Terminate("usuarioslist.php"); // Invalid key, return to list
		switch ($usuarios->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("usuarioslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$usuarios->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $usuarios->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$usuarios->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$usuarios->RowType = EW_ROWTYPE_EDIT; // Render as Edit
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

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $usuarios;
		if (!$usuarios->llave->FldIsDetailKey) {
			$usuarios->llave->setFormValue($objForm->GetValue("x_llave"));
		}
		if (!$usuarios->estatus->FldIsDetailKey) {
			$usuarios->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		if (!$usuarios->duracion_pass->FldIsDetailKey) {
			$usuarios->duracion_pass->setFormValue($objForm->GetValue("x_duracion_pass"));
		}
		if (!$usuarios->duracion_fech->FldIsDetailKey) {
			$usuarios->duracion_fech->setFormValue($objForm->GetValue("x_duracion_fech"));
			$usuarios->duracion_fech->CurrentValue = ew_UnFormatDateTime($usuarios->duracion_fech->CurrentValue, 5);
		}
		if (!$usuarios->id_usuario->FldIsDetailKey)
			$usuarios->id_usuario->setFormValue($objForm->GetValue("x_id_usuario"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $usuarios;
		$this->LoadRow();
		$usuarios->id_usuario->CurrentValue = $usuarios->id_usuario->FormValue;
		$usuarios->llave->CurrentValue = $usuarios->llave->FormValue;
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
		// duracion_pass
		// duracion_fech

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
			// llave
			$usuarios->llave->LinkCustomAttributes = "";
			$usuarios->llave->HrefValue = "";
			$usuarios->llave->TooltipValue = "";

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
		} elseif ($usuarios->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// llave
			$usuarios->llave->EditCustomAttributes = "";
			$usuarios->llave->EditValue = ew_HtmlEncode($usuarios->llave->CurrentValue);

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
			
			
			
			
			
			
			// Edit refer script
			// llave
			$usuarios->llave->HrefValue = "";

			

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $usuarios;
		$sFilter = $usuarios->KeyFilter();
		$usuarios->CurrentFilter = $sFilter;
		$sSql = $usuarios->SQL();
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

			// llave
			$usuarios->llave->SetDbValueDef($rsnew, $usuarios->llave->CurrentValue, NULL, $usuarios->llave->ReadOnly || (EW_ENCRYPTED_PASSWORD && $rs->fields('llave') == $usuarios->llave->CurrentValue));

			// estatus
			$usuarios->estatus->SetDbValueDef($rsnew, $usuarios->estatus->CurrentValue, NULL, $usuarios->estatus->ReadOnly);

			// duracion_pass
			$usuarios->duracion_pass->SetDbValueDef($rsnew, $usuarios->duracion_pass->CurrentValue, 0, $usuarios->duracion_pass->ReadOnly);

			// duracion_fech
			$usuarios->duracion_fech->SetDbValueDef($rsnew, ew_CurrentDate(), NULL);
			$rsnew['duracion_fech'] =& $usuarios->duracion_fech->DbValue;

			// Call Row Updating event
			$bUpdateRow = $usuarios->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0){
					// $conexion4 = ew_Connect();
					// $query2 = " insert into historico_acceso (id_usuario,acceso) values (".$usuarios->id_usuario->FormValue.",md5('".$rsnew['llave']."')) ";
					// $result22 = $conexion4->GetArray($query2);
					
					$result22 = actualizar_campo('insert_historico_acceso',array($usuarios->id_usuario->FormValue,$rsnew['llave']));
					
					$EditRow = $conn->Execute($usuarios->UpdateSQL($rsnew));
				}
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($usuarios->CancelMessage <> "") {
					$this->setFailureMessage($usuarios->CancelMessage);
					$usuarios->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$usuarios->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'usuarios';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $usuarios;
		$table = 'usuarios';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_usuario'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($usuarios->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($usuarios->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($usuarios->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($usuarios->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
