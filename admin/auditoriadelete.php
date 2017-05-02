<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "auditoriainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$auditoria_delete = new cauditoria_delete();
$Page =& $auditoria_delete;

// Page init
$auditoria_delete->Page_Init();

// Page main
$auditoria_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var auditoria_delete = new ew_Page("auditoria_delete");

// page properties
auditoria_delete.PageID = "delete"; // page ID
auditoria_delete.FormID = "fauditoriadelete"; // form ID
var EW_PAGE_ID = auditoria_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
auditoria_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
auditoria_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
auditoria_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($auditoria_delete->Recordset = $auditoria_delete->LoadRecordset())
	$auditoria_deleteTotalRecs = $auditoria_delete->Recordset->RecordCount(); // Get record count
if ($auditoria_deleteTotalRecs <= 0) { // No record found, exit
	if ($auditoria_delete->Recordset)
		$auditoria_delete->Recordset->Close();
	$auditoria_delete->Page_Terminate("auditorialist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $auditoria->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $auditoria->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $auditoria_delete->ShowPageHeader(); ?>
<?php
$auditoria_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="auditoria">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($auditoria_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $auditoria->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $auditoria->id->FldCaption() ?></td>
		<td valign="top"><?php echo $auditoria->fecha->FldCaption() ?></td>
		<td valign="top"><?php echo $auditoria->script->FldCaption() ?></td>
		<td valign="top"><?php echo $auditoria->usuario->FldCaption() ?></td>
		<td valign="top"><?php echo $auditoria->accion->FldCaption() ?></td>
		<td valign="top"><?php echo $auditoria->tabla->FldCaption() ?></td>
		<td valign="top"><?php echo $auditoria->archivo->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$auditoria_delete->RecCnt = 0;
$i = 0;
while (!$auditoria_delete->Recordset->EOF) {
	$auditoria_delete->RecCnt++;

	// Set row properties
	$auditoria->ResetAttrs();
	$auditoria->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$auditoria_delete->LoadRowValues($auditoria_delete->Recordset);

	// Render row
	$auditoria_delete->RenderRow();
?>
	<tr<?php echo $auditoria->RowAttributes() ?>>
		<td<?php echo $auditoria->id->CellAttributes() ?>>
<div<?php echo $auditoria->id->ViewAttributes() ?>><?php echo $auditoria->id->ListViewValue() ?></div></td>
		<td<?php echo $auditoria->fecha->CellAttributes() ?>>
<div<?php echo $auditoria->fecha->ViewAttributes() ?>><?php echo $auditoria->fecha->ListViewValue() ?></div></td>
		<td<?php echo $auditoria->script->CellAttributes() ?>>
<div<?php echo $auditoria->script->ViewAttributes() ?>><?php echo $auditoria->script->ListViewValue() ?></div></td>
		<td<?php echo $auditoria->usuario->CellAttributes() ?>>
<div<?php echo $auditoria->usuario->ViewAttributes() ?>><?php echo $auditoria->usuario->ListViewValue() ?></div></td>
		<td<?php echo $auditoria->accion->CellAttributes() ?>>
<div<?php echo $auditoria->accion->ViewAttributes() ?>><?php echo $auditoria->accion->ListViewValue() ?></div></td>
		<td<?php echo $auditoria->tabla->CellAttributes() ?>>
<div<?php echo $auditoria->tabla->ViewAttributes() ?>><?php echo $auditoria->tabla->ListViewValue() ?></div></td>
		<td<?php echo $auditoria->archivo->CellAttributes() ?>>
<div<?php echo $auditoria->archivo->ViewAttributes() ?>><?php echo $auditoria->archivo->ListViewValue() ?></div></td>
	</tr>
<?php
	$auditoria_delete->Recordset->MoveNext();
}
$auditoria_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$auditoria_delete->ShowPageFooter();
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
$auditoria_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cauditoria_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'auditoria';

	// Page object name
	var $PageObjName = 'auditoria_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $auditoria;
		if ($auditoria->UseTokenInUrl) $PageUrl .= "t=" . $auditoria->TableVar . "&"; // Add page token
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
		global $objForm, $auditoria;
		if ($auditoria->UseTokenInUrl) {
			if ($objForm)
				return ($auditoria->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($auditoria->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cauditoria_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (auditoria)
		if (!isset($GLOBALS["auditoria"])) {
			$GLOBALS["auditoria"] = new cauditoria();
			$GLOBALS["Table"] =& $GLOBALS["auditoria"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'auditoria', TRUE);

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
		global $auditoria;

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("auditorialist.php");
		}

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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $auditoria;

		// Load key parameters
		$this->RecKeys = $auditoria->GetRecordKeys(); // Load record keys
		$sFilter = $auditoria->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("auditorialist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in auditoria class, auditoriainfo.php

		$auditoria->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$auditoria->CurrentAction = $_POST["a_delete"];
		} else {
			$auditoria->CurrentAction = "I"; // Display record
		}
		switch ($auditoria->CurrentAction) {
			case "D": // Delete
				$auditoria->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($auditoria->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $auditoria;

		// Call Recordset Selecting event
		$auditoria->Recordset_Selecting($auditoria->CurrentFilter);

		// Load List page SQL
		$sSql = $auditoria->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$auditoria->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $auditoria;
		$sFilter = $auditoria->KeyFilter();

		// Call Row Selecting event
		$auditoria->Row_Selecting($sFilter);

		// Load SQL based on filter
		$auditoria->CurrentFilter = $sFilter;
		$sSql = $auditoria->SQL();
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
		global $conn, $auditoria;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$auditoria->Row_Selected($row);
		$auditoria->id->setDbValue($rs->fields('id'));
		$auditoria->fecha->setDbValue($rs->fields('fecha'));
		$auditoria->script->setDbValue($rs->fields('script'));
		$auditoria->usuario->setDbValue($rs->fields('usuario'));
		$auditoria->accion->setDbValue($rs->fields('accion'));
		$auditoria->tabla->setDbValue($rs->fields('tabla'));
		$auditoria->archivo->setDbValue($rs->fields('archivo'));
		$auditoria->valor->setDbValue($rs->fields('valor'));
		$auditoria->valorinicial->setDbValue($rs->fields('valorinicial'));
		$auditoria->valorfinal->setDbValue($rs->fields('valorfinal'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $auditoria;

		// Initialize URLs
		// Call Row_Rendering event

		$auditoria->Row_Rendering();

		// Common render codes for all row types
		// id
		// fecha
		// script
		// usuario
		// accion
		// tabla
		// archivo
		// valor
		// valorinicial
		// valorfinal

		if ($auditoria->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$auditoria->id->ViewValue = $auditoria->id->CurrentValue;
			$auditoria->id->ViewCustomAttributes = "";

			// fecha
			$auditoria->fecha->ViewValue = $auditoria->fecha->CurrentValue;
			$auditoria->fecha->ViewValue = ew_FormatDateTime($auditoria->fecha->ViewValue, 7);
			$auditoria->fecha->ViewCustomAttributes = "";

			// script
			$auditoria->script->ViewValue = $auditoria->script->CurrentValue;
			$auditoria->script->ViewCustomAttributes = "";

			// usuario
			$auditoria->usuario->ViewValue = $auditoria->usuario->CurrentValue;
			$auditoria->usuario->ViewCustomAttributes = "";

			// accion
			$auditoria->accion->ViewValue = $auditoria->accion->CurrentValue;
			$auditoria->accion->ViewCustomAttributes = "";

			// tabla
			$auditoria->tabla->ViewValue = $auditoria->tabla->CurrentValue;
			$auditoria->tabla->ViewCustomAttributes = "";

			// archivo
			$auditoria->archivo->ViewValue = $auditoria->archivo->CurrentValue;
			$auditoria->archivo->ViewCustomAttributes = "";

			// id
			$auditoria->id->LinkCustomAttributes = "";
			$auditoria->id->HrefValue = "";
			$auditoria->id->TooltipValue = "";

			// fecha
			$auditoria->fecha->LinkCustomAttributes = "";
			$auditoria->fecha->HrefValue = "";
			$auditoria->fecha->TooltipValue = "";

			// script
			$auditoria->script->LinkCustomAttributes = "";
			$auditoria->script->HrefValue = "";
			$auditoria->script->TooltipValue = "";

			// usuario
			$auditoria->usuario->LinkCustomAttributes = "";
			$auditoria->usuario->HrefValue = "";
			$auditoria->usuario->TooltipValue = "";

			// accion
			$auditoria->accion->LinkCustomAttributes = "";
			$auditoria->accion->HrefValue = "";
			$auditoria->accion->TooltipValue = "";

			// tabla
			$auditoria->tabla->LinkCustomAttributes = "";
			$auditoria->tabla->HrefValue = "";
			$auditoria->tabla->TooltipValue = "";

			// archivo
			$auditoria->archivo->LinkCustomAttributes = "";
			$auditoria->archivo->HrefValue = "";
			$auditoria->archivo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($auditoria->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$auditoria->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $auditoria;
		$DeleteRows = TRUE;
		$sSql = $auditoria->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $auditoria->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($auditoria->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($auditoria->CancelMessage <> "") {
				$this->setFailureMessage($auditoria->CancelMessage);
				$auditoria->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$auditoria->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
}
?>
