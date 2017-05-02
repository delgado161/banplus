<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "departamentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$departamentos_delete = new cdepartamentos_delete();
$Page =& $departamentos_delete;

// Page init
$departamentos_delete->Page_Init();

// Page main
$departamentos_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var departamentos_delete = new ew_Page("departamentos_delete");

// page properties
departamentos_delete.PageID = "delete"; // page ID
departamentos_delete.FormID = "fdepartamentosdelete"; // form ID
var EW_PAGE_ID = departamentos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
departamentos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
departamentos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
departamentos_delete.ValidateRequired = false; // no JavaScript validation
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
if ($departamentos_delete->Recordset = $departamentos_delete->LoadRecordset())
	$departamentos_deleteTotalRecs = $departamentos_delete->Recordset->RecordCount(); // Get record count
if ($departamentos_deleteTotalRecs <= 0) { // No record found, exit
	if ($departamentos_delete->Recordset)
		$departamentos_delete->Recordset->Close();
	$departamentos_delete->Page_Terminate("departamentoslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $departamentos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $departamentos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $departamentos_delete->ShowPageHeader(); ?>
<?php
$departamentos_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="departamentos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($departamentos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $departamentos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $departamentos->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $departamentos->zemail->FldCaption() ?></td>
		<td valign="top"><?php echo $departamentos->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$departamentos_delete->RecCnt = 0;
$i = 0;
while (!$departamentos_delete->Recordset->EOF) {
	$departamentos_delete->RecCnt++;

	// Set row properties
	$departamentos->ResetAttrs();
	$departamentos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$departamentos_delete->LoadRowValues($departamentos_delete->Recordset);

	// Render row
	$departamentos_delete->RenderRow();
?>
	<tr<?php echo $departamentos->RowAttributes() ?>>
		<td<?php echo $departamentos->nombre->CellAttributes() ?>>
<div<?php echo $departamentos->nombre->ViewAttributes() ?>><?php echo $departamentos->nombre->ListViewValue() ?></div></td>
		<td<?php echo $departamentos->zemail->CellAttributes() ?>>
<div<?php echo $departamentos->zemail->ViewAttributes() ?>><?php echo $departamentos->zemail->ListViewValue() ?></div></td>
		<td<?php echo $departamentos->estatus->CellAttributes() ?>>
<div<?php echo $departamentos->estatus->ViewAttributes() ?>><?php echo $departamentos->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$departamentos_delete->Recordset->MoveNext();
}
$departamentos_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$departamentos_delete->ShowPageFooter();
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
$departamentos_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cdepartamentos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'departamentos';

	// Page object name
	var $PageObjName = 'departamentos_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $departamentos;
		if ($departamentos->UseTokenInUrl) $PageUrl .= "t=" . $departamentos->TableVar . "&"; // Add page token
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
		global $objForm, $departamentos;
		if ($departamentos->UseTokenInUrl) {
			if ($objForm)
				return ($departamentos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($departamentos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdepartamentos_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (departamentos)
		if (!isset($GLOBALS["departamentos"])) {
			$GLOBALS["departamentos"] = new cdepartamentos();
			$GLOBALS["Table"] =& $GLOBALS["departamentos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'departamentos', TRUE);

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
		global $departamentos;

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
			$this->Page_Terminate("departamentoslist.php");
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
		global $Language, $departamentos;

		// Load key parameters
		$this->RecKeys = $departamentos->GetRecordKeys(); // Load record keys
		$sFilter = $departamentos->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("departamentoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in departamentos class, departamentosinfo.php

		$departamentos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$departamentos->CurrentAction = $_POST["a_delete"];
		} else {
			$departamentos->CurrentAction = "I"; // Display record
		}
		switch ($departamentos->CurrentAction) {
			case "D": // Delete
				$departamentos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($departamentos->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $departamentos;

		// Call Recordset Selecting event
		$departamentos->Recordset_Selecting($departamentos->CurrentFilter);

		// Load List page SQL
		$sSql = $departamentos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$departamentos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $departamentos;
		$sFilter = $departamentos->KeyFilter();

		// Call Row Selecting event
		$departamentos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$departamentos->CurrentFilter = $sFilter;
		$sSql = $departamentos->SQL();
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
		global $conn, $departamentos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$departamentos->Row_Selected($row);
		$departamentos->id_departamentos->setDbValue($rs->fields('id_departamentos'));
		$departamentos->nombre->setDbValue($rs->fields('nombre'));
		$departamentos->zemail->setDbValue($rs->fields('email'));
		$departamentos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $departamentos;

		// Initialize URLs
		// Call Row_Rendering event

		$departamentos->Row_Rendering();

		// Common render codes for all row types
		// id_departamentos

		$departamentos->id_departamentos->CellCssStyle = "white-space: nowrap;";

		// nombre
		// email
		// estatus

		if ($departamentos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_departamentos
			$departamentos->id_departamentos->ViewValue = $departamentos->id_departamentos->CurrentValue;
			$departamentos->id_departamentos->ViewCustomAttributes = "";

			// nombre
			$departamentos->nombre->ViewValue = $departamentos->nombre->CurrentValue;
			$departamentos->nombre->ViewCustomAttributes = "";

			// email
			$departamentos->zemail->ViewValue = $departamentos->zemail->CurrentValue;
			$departamentos->zemail->ViewCustomAttributes = "";

			// estatus
			if (strval($departamentos->estatus->CurrentValue) <> "") {
				switch ($departamentos->estatus->CurrentValue) {
					case "1":
						$departamentos->estatus->ViewValue = $departamentos->estatus->FldTagCaption(1) <> "" ? $departamentos->estatus->FldTagCaption(1) : $departamentos->estatus->CurrentValue;
						break;
					case "0":
						$departamentos->estatus->ViewValue = $departamentos->estatus->FldTagCaption(2) <> "" ? $departamentos->estatus->FldTagCaption(2) : $departamentos->estatus->CurrentValue;
						break;
					default:
						$departamentos->estatus->ViewValue = $departamentos->estatus->CurrentValue;
				}
			} else {
				$departamentos->estatus->ViewValue = NULL;
			}
			$departamentos->estatus->ViewCustomAttributes = "";

			// nombre
			$departamentos->nombre->LinkCustomAttributes = "";
			$departamentos->nombre->HrefValue = "";
			$departamentos->nombre->TooltipValue = "";

			// email
			$departamentos->zemail->LinkCustomAttributes = "";
			$departamentos->zemail->HrefValue = "";
			$departamentos->zemail->TooltipValue = "";

			// estatus
			$departamentos->estatus->LinkCustomAttributes = "";
			$departamentos->estatus->HrefValue = "";
			$departamentos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($departamentos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$departamentos->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $departamentos;
		$DeleteRows = TRUE;
		$sSql = $departamentos->SQL();
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
				$DeleteRows = $departamentos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_departamentos'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($departamentos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($departamentos->CancelMessage <> "") {
				$this->setFailureMessage($departamentos->CancelMessage);
				$departamentos->CancelMessage = "";
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
				$departamentos->Row_Deleted($row);
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
