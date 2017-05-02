<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modulos_financierosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$modulos_financieros_delete = new cmodulos_financieros_delete();
$Page =& $modulos_financieros_delete;

// Page init
$modulos_financieros_delete->Page_Init();

// Page main
$modulos_financieros_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var modulos_financieros_delete = new ew_Page("modulos_financieros_delete");

// page properties
modulos_financieros_delete.PageID = "delete"; // page ID
modulos_financieros_delete.FormID = "fmodulos_financierosdelete"; // form ID
var EW_PAGE_ID = modulos_financieros_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
modulos_financieros_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
modulos_financieros_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
modulos_financieros_delete.ValidateRequired = false; // no JavaScript validation
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
if ($modulos_financieros_delete->Recordset = $modulos_financieros_delete->LoadRecordset())
	$modulos_financieros_deleteTotalRecs = $modulos_financieros_delete->Recordset->RecordCount(); // Get record count
if ($modulos_financieros_deleteTotalRecs <= 0) { // No record found, exit
	if ($modulos_financieros_delete->Recordset)
		$modulos_financieros_delete->Recordset->Close();
	$modulos_financieros_delete->Page_Terminate("modulos_financieroslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $modulos_financieros->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $modulos_financieros->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $modulos_financieros_delete->ShowPageHeader(); ?>
<?php
$modulos_financieros_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="modulos_financieros">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($modulos_financieros_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $modulos_financieros->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $modulos_financieros->id_modulo_financiero->FldCaption() ?></td>
		<td valign="top"><?php echo $modulos_financieros->plantilla->FldCaption() ?></td>
		<td valign="top"><?php echo $modulos_financieros->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $modulos_financieros->estatus->FldCaption() ?></td>
		<td valign="top"><?php echo $modulos_financieros->orden->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$modulos_financieros_delete->RecCnt = 0;
$i = 0;
while (!$modulos_financieros_delete->Recordset->EOF) {
	$modulos_financieros_delete->RecCnt++;

	// Set row properties
	$modulos_financieros->ResetAttrs();
	$modulos_financieros->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$modulos_financieros_delete->LoadRowValues($modulos_financieros_delete->Recordset);

	// Render row
	$modulos_financieros_delete->RenderRow();
?>
	<tr<?php echo $modulos_financieros->RowAttributes() ?>>
		<td<?php echo $modulos_financieros->id_modulo_financiero->CellAttributes() ?>>
<div<?php echo $modulos_financieros->id_modulo_financiero->ViewAttributes() ?>><?php echo $modulos_financieros->id_modulo_financiero->ListViewValue() ?></div></td>
		<td<?php echo $modulos_financieros->plantilla->CellAttributes() ?>>
<div<?php echo $modulos_financieros->plantilla->ViewAttributes() ?>><?php echo $modulos_financieros->plantilla->ListViewValue() ?></div></td>
		<td<?php echo $modulos_financieros->nombre->CellAttributes() ?>>
<div<?php echo $modulos_financieros->nombre->ViewAttributes() ?>><?php echo $modulos_financieros->nombre->ListViewValue() ?></div></td>
		<td<?php echo $modulos_financieros->estatus->CellAttributes() ?>>
<div<?php echo $modulos_financieros->estatus->ViewAttributes() ?>><?php echo $modulos_financieros->estatus->ListViewValue() ?></div></td>
		<td<?php echo $modulos_financieros->orden->CellAttributes() ?>>
<div<?php echo $modulos_financieros->orden->ViewAttributes() ?>><?php echo $modulos_financieros->orden->ListViewValue() ?></div></td>
	</tr>
<?php
	$modulos_financieros_delete->Recordset->MoveNext();
}
$modulos_financieros_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$modulos_financieros_delete->ShowPageFooter();
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
$modulos_financieros_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodulos_financieros_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'modulos_financieros';

	// Page object name
	var $PageObjName = 'modulos_financieros_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $modulos_financieros;
		if ($modulos_financieros->UseTokenInUrl) $PageUrl .= "t=" . $modulos_financieros->TableVar . "&"; // Add page token
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
		global $objForm, $modulos_financieros;
		if ($modulos_financieros->UseTokenInUrl) {
			if ($objForm)
				return ($modulos_financieros->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($modulos_financieros->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodulos_financieros_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (modulos_financieros)
		if (!isset($GLOBALS["modulos_financieros"])) {
			$GLOBALS["modulos_financieros"] = new cmodulos_financieros();
			$GLOBALS["Table"] =& $GLOBALS["modulos_financieros"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'modulos_financieros', TRUE);

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
		global $modulos_financieros;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $Language, $modulos_financieros;

		// Load key parameters
		$this->RecKeys = $modulos_financieros->GetRecordKeys(); // Load record keys
		$sFilter = $modulos_financieros->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("modulos_financieroslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in modulos_financieros class, modulos_financierosinfo.php

		$modulos_financieros->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$modulos_financieros->CurrentAction = $_POST["a_delete"];
		} else {
			$modulos_financieros->CurrentAction = "I"; // Display record
		}
		switch ($modulos_financieros->CurrentAction) {
			case "D": // Delete
				$modulos_financieros->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($modulos_financieros->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $modulos_financieros;

		// Call Recordset Selecting event
		$modulos_financieros->Recordset_Selecting($modulos_financieros->CurrentFilter);

		// Load List page SQL
		$sSql = $modulos_financieros->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$modulos_financieros->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $modulos_financieros;
		$sFilter = $modulos_financieros->KeyFilter();

		// Call Row Selecting event
		$modulos_financieros->Row_Selecting($sFilter);

		// Load SQL based on filter
		$modulos_financieros->CurrentFilter = $sFilter;
		$sSql = $modulos_financieros->SQL();
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
		global $conn, $modulos_financieros;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$modulos_financieros->Row_Selected($row);
		$modulos_financieros->id_modulo_financiero->setDbValue($rs->fields('id_modulo_financiero'));
		$modulos_financieros->plantilla->setDbValue($rs->fields('plantilla'));
		$modulos_financieros->nombre->setDbValue($rs->fields('nombre'));
		$modulos_financieros->estatus->setDbValue($rs->fields('estatus'));
		$modulos_financieros->orden->setDbValue($rs->fields('orden'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $modulos_financieros;

		// Initialize URLs
		// Call Row_Rendering event

		$modulos_financieros->Row_Rendering();

		// Common render codes for all row types
		// id_modulo_financiero
		// plantilla
		// nombre
		// estatus
		// orden

		if ($modulos_financieros->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_modulo_financiero
			$modulos_financieros->id_modulo_financiero->ViewValue = $modulos_financieros->id_modulo_financiero->CurrentValue;
			$modulos_financieros->id_modulo_financiero->ViewCustomAttributes = "";

			// plantilla
			$modulos_financieros->plantilla->ViewValue = $modulos_financieros->plantilla->CurrentValue;
			$modulos_financieros->plantilla->ViewCustomAttributes = "";

			// nombre
			$modulos_financieros->nombre->ViewValue = $modulos_financieros->nombre->CurrentValue;
			$modulos_financieros->nombre->ViewCustomAttributes = "";

			// estatus
			$modulos_financieros->estatus->ViewValue = $modulos_financieros->estatus->CurrentValue;
			$modulos_financieros->estatus->ViewCustomAttributes = "";

			// orden
			$modulos_financieros->orden->ViewValue = $modulos_financieros->orden->CurrentValue;
			$modulos_financieros->orden->ViewCustomAttributes = "";

			// id_modulo_financiero
			$modulos_financieros->id_modulo_financiero->LinkCustomAttributes = "";
			$modulos_financieros->id_modulo_financiero->HrefValue = "";
			$modulos_financieros->id_modulo_financiero->TooltipValue = "";

			// plantilla
			$modulos_financieros->plantilla->LinkCustomAttributes = "";
			$modulos_financieros->plantilla->HrefValue = "";
			$modulos_financieros->plantilla->TooltipValue = "";

			// nombre
			$modulos_financieros->nombre->LinkCustomAttributes = "";
			$modulos_financieros->nombre->HrefValue = "";
			$modulos_financieros->nombre->TooltipValue = "";

			// estatus
			$modulos_financieros->estatus->LinkCustomAttributes = "";
			$modulos_financieros->estatus->HrefValue = "";
			$modulos_financieros->estatus->TooltipValue = "";

			// orden
			$modulos_financieros->orden->LinkCustomAttributes = "";
			$modulos_financieros->orden->HrefValue = "";
			$modulos_financieros->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($modulos_financieros->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$modulos_financieros->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $modulos_financieros;
		$DeleteRows = TRUE;
		$sSql = $modulos_financieros->SQL();
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
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $modulos_financieros->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_modulo_financiero'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($modulos_financieros->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($modulos_financieros->CancelMessage <> "") {
				$this->setFailureMessage($modulos_financieros->CancelMessage);
				$modulos_financieros->CancelMessage = "";
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
				$modulos_financieros->Row_Deleted($row);
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
