<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "agencias_serviciosinfo.php" ?>
<?php include_once "agenciasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$agencias_servicios_delete = new cagencias_servicios_delete();
$Page =& $agencias_servicios_delete;

// Page init
$agencias_servicios_delete->Page_Init();

// Page main
$agencias_servicios_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var agencias_servicios_delete = new ew_Page("agencias_servicios_delete");

// page properties
agencias_servicios_delete.PageID = "delete"; // page ID
agencias_servicios_delete.FormID = "fagencias_serviciosdelete"; // form ID
var EW_PAGE_ID = agencias_servicios_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
agencias_servicios_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
agencias_servicios_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
agencias_servicios_delete.ValidateRequired = false; // no JavaScript validation
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
if ($agencias_servicios_delete->Recordset = $agencias_servicios_delete->LoadRecordset())
	$agencias_servicios_deleteTotalRecs = $agencias_servicios_delete->Recordset->RecordCount(); // Get record count
if ($agencias_servicios_deleteTotalRecs <= 0) { // No record found, exit
	if ($agencias_servicios_delete->Recordset)
		$agencias_servicios_delete->Recordset->Close();
	$agencias_servicios_delete->Page_Terminate("agencias_servicioslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $agencias_servicios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $agencias_servicios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $agencias_servicios_delete->ShowPageHeader(); ?>
<?php
$agencias_servicios_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="agencias_servicios">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($agencias_servicios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $agencias_servicios->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $agencias_servicios->id_servicio->FldCaption() ?></td>
		<td valign="top"><?php echo $agencias_servicios->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$agencias_servicios_delete->RecCnt = 0;
$i = 0;
while (!$agencias_servicios_delete->Recordset->EOF) {
	$agencias_servicios_delete->RecCnt++;

	// Set row properties
	$agencias_servicios->ResetAttrs();
	$agencias_servicios->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$agencias_servicios_delete->LoadRowValues($agencias_servicios_delete->Recordset);

	// Render row
	$agencias_servicios_delete->RenderRow();
?>
	<tr<?php echo $agencias_servicios->RowAttributes() ?>>
		<td<?php echo $agencias_servicios->id_servicio->CellAttributes() ?>>
<div<?php echo $agencias_servicios->id_servicio->ViewAttributes() ?>><?php echo $agencias_servicios->id_servicio->ListViewValue() ?></div></td>
		<td<?php echo $agencias_servicios->estatus->CellAttributes() ?>>
<div<?php echo $agencias_servicios->estatus->ViewAttributes() ?>><?php echo $agencias_servicios->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$agencias_servicios_delete->Recordset->MoveNext();
}
$agencias_servicios_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$agencias_servicios_delete->ShowPageFooter();
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
$agencias_servicios_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cagencias_servicios_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'agencias_servicios';

	// Page object name
	var $PageObjName = 'agencias_servicios_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $agencias_servicios;
		if ($agencias_servicios->UseTokenInUrl) $PageUrl .= "t=" . $agencias_servicios->TableVar . "&"; // Add page token
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
		global $objForm, $agencias_servicios;
		if ($agencias_servicios->UseTokenInUrl) {
			if ($objForm)
				return ($agencias_servicios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($agencias_servicios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cagencias_servicios_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (agencias_servicios)
		if (!isset($GLOBALS["agencias_servicios"])) {
			$GLOBALS["agencias_servicios"] = new cagencias_servicios();
			$GLOBALS["Table"] =& $GLOBALS["agencias_servicios"];
		}

		// Table object (agencias)
		if (!isset($GLOBALS['agencias'])) $GLOBALS['agencias'] = new cagencias();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'agencias_servicios', TRUE);

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
		global $agencias_servicios;

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
			$this->Page_Terminate("agencias_servicioslist.php");
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
		global $Language, $agencias_servicios;

		// Load key parameters
		$this->RecKeys = $agencias_servicios->GetRecordKeys(); // Load record keys
		$sFilter = $agencias_servicios->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("agencias_servicioslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in agencias_servicios class, agencias_serviciosinfo.php

		$agencias_servicios->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$agencias_servicios->CurrentAction = $_POST["a_delete"];
		} else {
			$agencias_servicios->CurrentAction = "I"; // Display record
		}
		switch ($agencias_servicios->CurrentAction) {
			case "D": // Delete
				$agencias_servicios->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($agencias_servicios->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $agencias_servicios;

		// Call Recordset Selecting event
		$agencias_servicios->Recordset_Selecting($agencias_servicios->CurrentFilter);

		// Load List page SQL
		$sSql = $agencias_servicios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$agencias_servicios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $agencias_servicios;
		$sFilter = $agencias_servicios->KeyFilter();

		// Call Row Selecting event
		$agencias_servicios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$agencias_servicios->CurrentFilter = $sFilter;
		$sSql = $agencias_servicios->SQL();
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
		global $conn, $agencias_servicios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$agencias_servicios->Row_Selected($row);
		$agencias_servicios->id_agencias_servicios->setDbValue($rs->fields('id_agencias_servicios'));
		$agencias_servicios->id_agencias->setDbValue($rs->fields('id_agencias'));
		$agencias_servicios->id_servicio->setDbValue($rs->fields('id_servicio'));
		$agencias_servicios->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $agencias_servicios;

		// Initialize URLs
		// Call Row_Rendering event

		$agencias_servicios->Row_Rendering();

		// Common render codes for all row types
		// id_agencias_servicios
		// id_agencias
		// id_servicio
		// estatus

		if ($agencias_servicios->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_agencias
			if (strval($agencias_servicios->id_agencias->CurrentValue) <> "") {
				$sFilterWrk = "`id_agencias` = " . ew_AdjustSql($agencias_servicios->id_agencias->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre`, `direccion` FROM `agencias`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias_servicios->id_agencias->ViewValue = $rswrk->fields('nombre');
					$agencias_servicios->id_agencias->ViewValue .= ew_ValueSeparator(0,1,$agencias_servicios->id_agencias) . $rswrk->fields('direccion');
					$rswrk->Close();
				} else {
					$agencias_servicios->id_agencias->ViewValue = $agencias_servicios->id_agencias->CurrentValue;
				}
			} else {
				$agencias_servicios->id_agencias->ViewValue = NULL;
			}
			$agencias_servicios->id_agencias->ViewCustomAttributes = "";

			// id_servicio
			if (strval($agencias_servicios->id_servicio->CurrentValue) <> "") {
				$sFilterWrk = "`id_servicios` = " . ew_AdjustSql($agencias_servicios->id_servicio->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `servicios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias_servicios->id_servicio->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$agencias_servicios->id_servicio->ViewValue = $agencias_servicios->id_servicio->CurrentValue;
				}
			} else {
				$agencias_servicios->id_servicio->ViewValue = NULL;
			}
			$agencias_servicios->id_servicio->ViewCustomAttributes = "";

			// estatus
			if (strval($agencias_servicios->estatus->CurrentValue) <> "") {
				switch ($agencias_servicios->estatus->CurrentValue) {
					case "1":
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->FldTagCaption(1) <> "" ? $agencias_servicios->estatus->FldTagCaption(1) : $agencias_servicios->estatus->CurrentValue;
						break;
					case "0":
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->FldTagCaption(2) <> "" ? $agencias_servicios->estatus->FldTagCaption(2) : $agencias_servicios->estatus->CurrentValue;
						break;
					default:
						$agencias_servicios->estatus->ViewValue = $agencias_servicios->estatus->CurrentValue;
				}
			} else {
				$agencias_servicios->estatus->ViewValue = NULL;
			}
			$agencias_servicios->estatus->ViewCustomAttributes = "";

			// id_servicio
			$agencias_servicios->id_servicio->LinkCustomAttributes = "";
			$agencias_servicios->id_servicio->HrefValue = "";
			$agencias_servicios->id_servicio->TooltipValue = "";

			// estatus
			$agencias_servicios->estatus->LinkCustomAttributes = "";
			$agencias_servicios->estatus->HrefValue = "";
			$agencias_servicios->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($agencias_servicios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$agencias_servicios->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $agencias_servicios;
		$DeleteRows = TRUE;
		$sSql = $agencias_servicios->SQL();
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
				$DeleteRows = $agencias_servicios->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_agencias_servicios'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($agencias_servicios->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($agencias_servicios->CancelMessage <> "") {
				$this->setFailureMessage($agencias_servicios->CancelMessage);
				$agencias_servicios->CancelMessage = "";
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
				$agencias_servicios->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'agencias_servicios';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $agencias_servicios;
		$table = 'agencias_servicios';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_agencias_servicios'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $agencias_servicios->fields) && $agencias_servicios->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($agencias_servicios->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($agencias_servicios->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
