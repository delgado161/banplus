<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "parametrosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$parametros_delete = new cparametros_delete();
$Page =& $parametros_delete;

// Page init
$parametros_delete->Page_Init();

// Page main
$parametros_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var parametros_delete = new ew_Page("parametros_delete");

// page properties
parametros_delete.PageID = "delete"; // page ID
parametros_delete.FormID = "fparametrosdelete"; // form ID
var EW_PAGE_ID = parametros_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
parametros_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
parametros_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
parametros_delete.ValidateRequired = false; // no JavaScript validation
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
if ($parametros_delete->Recordset = $parametros_delete->LoadRecordset())
	$parametros_deleteTotalRecs = $parametros_delete->Recordset->RecordCount(); // Get record count
if ($parametros_deleteTotalRecs <= 0) { // No record found, exit
	if ($parametros_delete->Recordset)
		$parametros_delete->Recordset->Close();
	$parametros_delete->Page_Terminate("parametroslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $parametros->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $parametros->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $parametros_delete->ShowPageHeader(); ?>
<?php
$parametros_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="parametros">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($parametros_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $parametros->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $parametros->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $parametros->valor->FldCaption() ?></td>
		<td valign="top"><?php echo $parametros->tipo_parametro->FldCaption() ?></td>
		<td valign="top"><?php echo $parametros->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$parametros_delete->RecCnt = 0;
$i = 0;
while (!$parametros_delete->Recordset->EOF) {
	$parametros_delete->RecCnt++;

	// Set row properties
	$parametros->ResetAttrs();
	$parametros->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$parametros_delete->LoadRowValues($parametros_delete->Recordset);

	// Render row
	$parametros_delete->RenderRow();
?>
	<tr<?php echo $parametros->RowAttributes() ?>>
		<td<?php echo $parametros->nombre->CellAttributes() ?>>
<div<?php echo $parametros->nombre->ViewAttributes() ?>><?php echo $parametros->nombre->ListViewValue() ?></div></td>
		<td<?php echo $parametros->valor->CellAttributes() ?>>
<div<?php echo $parametros->valor->ViewAttributes() ?>><?php echo $parametros->valor->ListViewValue() ?></div></td>
		<td<?php echo $parametros->tipo_parametro->CellAttributes() ?>>
<div<?php echo $parametros->tipo_parametro->ViewAttributes() ?>><?php echo $parametros->tipo_parametro->ListViewValue() ?></div></td>
		<td<?php echo $parametros->estatus->CellAttributes() ?>>
<div<?php echo $parametros->estatus->ViewAttributes() ?>><?php echo $parametros->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$parametros_delete->Recordset->MoveNext();
}
$parametros_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$parametros_delete->ShowPageFooter();
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
$parametros_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cparametros_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'parametros';

	// Page object name
	var $PageObjName = 'parametros_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $parametros;
		if ($parametros->UseTokenInUrl) $PageUrl .= "t=" . $parametros->TableVar . "&"; // Add page token
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
		global $objForm, $parametros;
		if ($parametros->UseTokenInUrl) {
			if ($objForm)
				return ($parametros->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($parametros->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cparametros_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (parametros)
		if (!isset($GLOBALS["parametros"])) {
			$GLOBALS["parametros"] = new cparametros();
			$GLOBALS["Table"] =& $GLOBALS["parametros"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'parametros', TRUE);

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
		global $parametros;

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
			$this->Page_Terminate("parametroslist.php");
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
		global $Language, $parametros;

		// Load key parameters
		$this->RecKeys = $parametros->GetRecordKeys(); // Load record keys
		$sFilter = $parametros->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("parametroslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in parametros class, parametrosinfo.php

		$parametros->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$parametros->CurrentAction = $_POST["a_delete"];
		} else {
			$parametros->CurrentAction = "I"; // Display record
		}
		switch ($parametros->CurrentAction) {
			case "D": // Delete
				$parametros->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($parametros->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $parametros;

		// Call Recordset Selecting event
		$parametros->Recordset_Selecting($parametros->CurrentFilter);

		// Load List page SQL
		$sSql = $parametros->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$parametros->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $parametros;
		$sFilter = $parametros->KeyFilter();

		// Call Row Selecting event
		$parametros->Row_Selecting($sFilter);

		// Load SQL based on filter
		$parametros->CurrentFilter = $sFilter;
		$sSql = $parametros->SQL();
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
		global $conn, $parametros;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$parametros->Row_Selected($row);
		$parametros->id_parametro->setDbValue($rs->fields('id_parametro'));
		$parametros->nombre->setDbValue($rs->fields('nombre'));
		$parametros->valor->setDbValue($rs->fields('valor'));
		$parametros->tipo_parametro->setDbValue($rs->fields('tipo_parametro'));
		$parametros->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $parametros;

		// Initialize URLs
		// Call Row_Rendering event

		$parametros->Row_Rendering();

		// Common render codes for all row types
		// id_parametro
		// nombre
		// valor
		// tipo_parametro
		// estatus

		if ($parametros->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$parametros->nombre->ViewValue = $parametros->nombre->CurrentValue;
			$parametros->nombre->ViewCustomAttributes = "";

			// valor
			$parametros->valor->ViewValue = $parametros->valor->CurrentValue;
			$parametros->valor->ViewCustomAttributes = "";

			// tipo_parametro
			$parametros->tipo_parametro->ViewValue = $parametros->tipo_parametro->CurrentValue;
			$parametros->tipo_parametro->ViewCustomAttributes = "";

			// estatus
			if (strval($parametros->estatus->CurrentValue) <> "") {
				switch ($parametros->estatus->CurrentValue) {
					case "1":
						$parametros->estatus->ViewValue = $parametros->estatus->FldTagCaption(1) <> "" ? $parametros->estatus->FldTagCaption(1) : $parametros->estatus->CurrentValue;
						break;
					case "0":
						$parametros->estatus->ViewValue = $parametros->estatus->FldTagCaption(2) <> "" ? $parametros->estatus->FldTagCaption(2) : $parametros->estatus->CurrentValue;
						break;
					default:
						$parametros->estatus->ViewValue = $parametros->estatus->CurrentValue;
				}
			} else {
				$parametros->estatus->ViewValue = NULL;
			}
			$parametros->estatus->ViewCustomAttributes = "";

			// nombre
			$parametros->nombre->LinkCustomAttributes = "";
			$parametros->nombre->HrefValue = "";
			$parametros->nombre->TooltipValue = "";

			// valor
			$parametros->valor->LinkCustomAttributes = "";
			$parametros->valor->HrefValue = "";
			$parametros->valor->TooltipValue = "";

			// tipo_parametro
			$parametros->tipo_parametro->LinkCustomAttributes = "";
			$parametros->tipo_parametro->HrefValue = "";
			$parametros->tipo_parametro->TooltipValue = "";

			// estatus
			$parametros->estatus->LinkCustomAttributes = "";
			$parametros->estatus->HrefValue = "";
			$parametros->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($parametros->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$parametros->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $parametros;
		$DeleteRows = TRUE;
		$sSql = $parametros->SQL();
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
				$DeleteRows = $parametros->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_parametro'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($parametros->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($parametros->CancelMessage <> "") {
				$this->setFailureMessage($parametros->CancelMessage);
				$parametros->CancelMessage = "";
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
				$parametros->Row_Deleted($row);
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
