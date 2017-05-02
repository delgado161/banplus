<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "cuotasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$cuotas_delete = new ccuotas_delete();
$Page =& $cuotas_delete;

// Page init
$cuotas_delete->Page_Init();

// Page main
$cuotas_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cuotas_delete = new ew_Page("cuotas_delete");

// page properties
cuotas_delete.PageID = "delete"; // page ID
cuotas_delete.FormID = "fcuotasdelete"; // form ID
var EW_PAGE_ID = cuotas_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cuotas_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cuotas_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cuotas_delete.ValidateRequired = false; // no JavaScript validation
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
if ($cuotas_delete->Recordset = $cuotas_delete->LoadRecordset())
	$cuotas_deleteTotalRecs = $cuotas_delete->Recordset->RecordCount(); // Get record count
if ($cuotas_deleteTotalRecs <= 0) { // No record found, exit
	if ($cuotas_delete->Recordset)
		$cuotas_delete->Recordset->Close();
	$cuotas_delete->Page_Terminate("cuotaslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $cuotas->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $cuotas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $cuotas_delete->ShowPageHeader(); ?>
<?php
$cuotas_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="cuotas">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($cuotas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $cuotas->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $cuotas->meses->FldCaption() ?></td>
		<td valign="top"><?php echo $cuotas->tipo->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$cuotas_delete->RecCnt = 0;
$i = 0;
while (!$cuotas_delete->Recordset->EOF) {
	$cuotas_delete->RecCnt++;

	// Set row properties
	$cuotas->ResetAttrs();
	$cuotas->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$cuotas_delete->LoadRowValues($cuotas_delete->Recordset);

	// Render row
	$cuotas_delete->RenderRow();
?>
	<tr<?php echo $cuotas->RowAttributes() ?>>
		<td<?php echo $cuotas->meses->CellAttributes() ?>>
<div<?php echo $cuotas->meses->ViewAttributes() ?>><?php echo $cuotas->meses->ListViewValue() ?></div></td>
		<td<?php echo $cuotas->tipo->CellAttributes() ?>>
<div<?php echo $cuotas->tipo->ViewAttributes() ?>><?php echo $cuotas->tipo->ListViewValue() ?></div></td>
	</tr>
<?php
	$cuotas_delete->Recordset->MoveNext();
}
$cuotas_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$cuotas_delete->ShowPageFooter();
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
$cuotas_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccuotas_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'cuotas';

	// Page object name
	var $PageObjName = 'cuotas_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cuotas;
		if ($cuotas->UseTokenInUrl) $PageUrl .= "t=" . $cuotas->TableVar . "&"; // Add page token
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
		global $objForm, $cuotas;
		if ($cuotas->UseTokenInUrl) {
			if ($objForm)
				return ($cuotas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cuotas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccuotas_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (cuotas)
		if (!isset($GLOBALS["cuotas"])) {
			$GLOBALS["cuotas"] = new ccuotas();
			$GLOBALS["Table"] =& $GLOBALS["cuotas"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cuotas', TRUE);

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
		global $cuotas;

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
			$this->Page_Terminate("cuotaslist.php");
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
		global $Language, $cuotas;

		// Load key parameters
		$this->RecKeys = $cuotas->GetRecordKeys(); // Load record keys
		$sFilter = $cuotas->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("cuotaslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in cuotas class, cuotasinfo.php

		$cuotas->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$cuotas->CurrentAction = $_POST["a_delete"];
		} else {
			$cuotas->CurrentAction = "I"; // Display record
		}
		switch ($cuotas->CurrentAction) {
			case "D": // Delete
				$cuotas->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($cuotas->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cuotas;

		// Call Recordset Selecting event
		$cuotas->Recordset_Selecting($cuotas->CurrentFilter);

		// Load List page SQL
		$sSql = $cuotas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$cuotas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cuotas;
		$sFilter = $cuotas->KeyFilter();

		// Call Row Selecting event
		$cuotas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$cuotas->CurrentFilter = $sFilter;
		$sSql = $cuotas->SQL();
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
		global $conn, $cuotas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$cuotas->Row_Selected($row);
		$cuotas->id_cuotas->setDbValue($rs->fields('id_cuotas'));
		$cuotas->meses->setDbValue($rs->fields('meses'));
		$cuotas->tipo->setDbValue($rs->fields('tipo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $cuotas;

		// Initialize URLs
		// Call Row_Rendering event

		$cuotas->Row_Rendering();

		// Common render codes for all row types
		// id_cuotas

		$cuotas->id_cuotas->CellCssStyle = "white-space: nowrap;";

		// meses
		// tipo

		if ($cuotas->RowType == EW_ROWTYPE_VIEW) { // View row

			// meses
			$cuotas->meses->ViewValue = $cuotas->meses->CurrentValue;
			$cuotas->meses->ViewCustomAttributes = "";

			// tipo
			if (strval($cuotas->tipo->CurrentValue) <> "") {
				switch ($cuotas->tipo->CurrentValue) {
					case "1":
						$cuotas->tipo->ViewValue = $cuotas->tipo->FldTagCaption(1) <> "" ? $cuotas->tipo->FldTagCaption(1) : $cuotas->tipo->CurrentValue;
						break;
					case "2":
						$cuotas->tipo->ViewValue = $cuotas->tipo->FldTagCaption(2) <> "" ? $cuotas->tipo->FldTagCaption(2) : $cuotas->tipo->CurrentValue;
						break;
					default:
						$cuotas->tipo->ViewValue = $cuotas->tipo->CurrentValue;
				}
			} else {
				$cuotas->tipo->ViewValue = NULL;
			}
			$cuotas->tipo->ViewCustomAttributes = "";

			// meses
			$cuotas->meses->LinkCustomAttributes = "";
			$cuotas->meses->HrefValue = "";
			$cuotas->meses->TooltipValue = "";

			// tipo
			$cuotas->tipo->LinkCustomAttributes = "";
			$cuotas->tipo->HrefValue = "";
			$cuotas->tipo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($cuotas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$cuotas->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $cuotas;
		$DeleteRows = TRUE;
		$sSql = $cuotas->SQL();
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
				$DeleteRows = $cuotas->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_cuotas'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($cuotas->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($cuotas->CancelMessage <> "") {
				$this->setFailureMessage($cuotas->CancelMessage);
				$cuotas->CancelMessage = "";
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
				$cuotas->Row_Deleted($row);
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
