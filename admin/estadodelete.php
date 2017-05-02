<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "estadoinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$estado_delete = new cestado_delete();
$Page =& $estado_delete;

// Page init
$estado_delete->Page_Init();

// Page main
$estado_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var estado_delete = new ew_Page("estado_delete");

// page properties
estado_delete.PageID = "delete"; // page ID
estado_delete.FormID = "festadodelete"; // form ID
var EW_PAGE_ID = estado_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
estado_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
estado_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
estado_delete.ValidateRequired = false; // no JavaScript validation
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
if ($estado_delete->Recordset = $estado_delete->LoadRecordset())
	$estado_deleteTotalRecs = $estado_delete->Recordset->RecordCount(); // Get record count
if ($estado_deleteTotalRecs <= 0) { // No record found, exit
	if ($estado_delete->Recordset)
		$estado_delete->Recordset->Close();
	$estado_delete->Page_Terminate("estadolist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $estado->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $estado->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $estado_delete->ShowPageHeader(); ?>
<?php
$estado_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="estado">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($estado_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $estado->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $estado->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $estado->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$estado_delete->RecCnt = 0;
$i = 0;
while (!$estado_delete->Recordset->EOF) {
	$estado_delete->RecCnt++;

	// Set row properties
	$estado->ResetAttrs();
	$estado->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$estado_delete->LoadRowValues($estado_delete->Recordset);

	// Render row
	$estado_delete->RenderRow();
?>
	<tr<?php echo $estado->RowAttributes() ?>>
		<td<?php echo $estado->nombre->CellAttributes() ?>>
<div<?php echo $estado->nombre->ViewAttributes() ?>><?php echo $estado->nombre->ListViewValue() ?></div></td>
		<td<?php echo $estado->estatus->CellAttributes() ?>>
<div<?php echo $estado->estatus->ViewAttributes() ?>><?php echo $estado->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$estado_delete->Recordset->MoveNext();
}
$estado_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$estado_delete->ShowPageFooter();
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
$estado_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cestado_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'estado';

	// Page object name
	var $PageObjName = 'estado_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $estado;
		if ($estado->UseTokenInUrl) $PageUrl .= "t=" . $estado->TableVar . "&"; // Add page token
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
		global $objForm, $estado;
		if ($estado->UseTokenInUrl) {
			if ($objForm)
				return ($estado->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($estado->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cestado_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (estado)
		if (!isset($GLOBALS["estado"])) {
			$GLOBALS["estado"] = new cestado();
			$GLOBALS["Table"] =& $GLOBALS["estado"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'estado', TRUE);

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
		global $estado;

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
			$this->Page_Terminate("estadolist.php");
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
		global $Language, $estado;

		// Load key parameters
		$this->RecKeys = $estado->GetRecordKeys(); // Load record keys
		$sFilter = $estado->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("estadolist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in estado class, estadoinfo.php

		$estado->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$estado->CurrentAction = $_POST["a_delete"];
		} else {
			$estado->CurrentAction = "I"; // Display record
		}
		switch ($estado->CurrentAction) {
			case "D": // Delete
				$estado->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($estado->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $estado;

		// Call Recordset Selecting event
		$estado->Recordset_Selecting($estado->CurrentFilter);

		// Load List page SQL
		$sSql = $estado->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$estado->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $estado;
		$sFilter = $estado->KeyFilter();

		// Call Row Selecting event
		$estado->Row_Selecting($sFilter);

		// Load SQL based on filter
		$estado->CurrentFilter = $sFilter;
		$sSql = $estado->SQL();
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
		global $conn, $estado;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$estado->Row_Selected($row);
		$estado->id_estado->setDbValue($rs->fields('id_estado'));
		$estado->nombre->setDbValue($rs->fields('nombre'));
		$estado->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $estado;

		// Initialize URLs
		// Call Row_Rendering event

		$estado->Row_Rendering();

		// Common render codes for all row types
		// id_estado

		$estado->id_estado->CellCssStyle = "white-space: nowrap;";

		// nombre
		// estatus

		if ($estado->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$estado->nombre->ViewValue = $estado->nombre->CurrentValue;
			$estado->nombre->ViewCustomAttributes = "";

			// estatus
			if (strval($estado->estatus->CurrentValue) <> "") {
				switch ($estado->estatus->CurrentValue) {
					case "1":
						$estado->estatus->ViewValue = $estado->estatus->FldTagCaption(1) <> "" ? $estado->estatus->FldTagCaption(1) : $estado->estatus->CurrentValue;
						break;
					case "0":
						$estado->estatus->ViewValue = $estado->estatus->FldTagCaption(2) <> "" ? $estado->estatus->FldTagCaption(2) : $estado->estatus->CurrentValue;
						break;
					default:
						$estado->estatus->ViewValue = $estado->estatus->CurrentValue;
				}
			} else {
				$estado->estatus->ViewValue = NULL;
			}
			$estado->estatus->ViewCustomAttributes = "";

			// nombre
			$estado->nombre->LinkCustomAttributes = "";
			$estado->nombre->HrefValue = "";
			$estado->nombre->TooltipValue = "";

			// estatus
			$estado->estatus->LinkCustomAttributes = "";
			$estado->estatus->HrefValue = "";
			$estado->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($estado->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$estado->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $estado;
		$DeleteRows = TRUE;
		$sSql = $estado->SQL();
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
		$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $estado->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_estado'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($estado->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($estado->CancelMessage <> "") {
				$this->setFailureMessage($estado->CancelMessage);
				$estado->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($DeleteRows) {
				foreach ($rsold as $row)
					$this->WriteAuditTrailOnDelete($row);
			}
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$estado->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'estado';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $estado;
		$table = 'estado';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_estado'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $estado->fields) && $estado->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($estado->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($estado->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
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
}
?>
