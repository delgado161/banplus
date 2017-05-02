<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "zmenuinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$zmenu_delete = new czmenu_delete();
$Page =& $zmenu_delete;

// Page init
$zmenu_delete->Page_Init();

// Page main
$zmenu_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var zmenu_delete = new ew_Page("zmenu_delete");

// page properties
zmenu_delete.PageID = "delete"; // page ID
zmenu_delete.FormID = "fzmenudelete"; // form ID
var EW_PAGE_ID = zmenu_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
zmenu_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
zmenu_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
zmenu_delete.ValidateRequired = false; // no JavaScript validation
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
if ($zmenu_delete->Recordset = $zmenu_delete->LoadRecordset())
	$zmenu_deleteTotalRecs = $zmenu_delete->Recordset->RecordCount(); // Get record count
if ($zmenu_deleteTotalRecs <= 0) { // No record found, exit
	if ($zmenu_delete->Recordset)
		$zmenu_delete->Recordset->Close();
	$zmenu_delete->Page_Terminate("zmenulist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $zmenu->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $zmenu->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $zmenu_delete->ShowPageHeader(); ?>
<?php
$zmenu_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="zmenu">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($zmenu_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $zmenu->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $zmenu->id_grupo_seccion->FldCaption() ?></td>
		<td valign="top"><?php echo $zmenu->posicion->FldCaption() ?></td>
		<td valign="top"><?php echo $zmenu->orden->FldCaption() ?></td>
		<td valign="top"><?php echo $zmenu->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$zmenu_delete->RecCnt = 0;
$i = 0;
while (!$zmenu_delete->Recordset->EOF) {
	$zmenu_delete->RecCnt++;

	// Set row properties
	$zmenu->ResetAttrs();
	$zmenu->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$zmenu_delete->LoadRowValues($zmenu_delete->Recordset);

	// Render row
	$zmenu_delete->RenderRow();
?>
	<tr<?php echo $zmenu->RowAttributes() ?>>
		<td<?php echo $zmenu->id_grupo_seccion->CellAttributes() ?>>
<div<?php echo $zmenu->id_grupo_seccion->ViewAttributes() ?>><?php echo $zmenu->id_grupo_seccion->ListViewValue() ?></div></td>
		<td<?php echo $zmenu->posicion->CellAttributes() ?>>
<div<?php echo $zmenu->posicion->ViewAttributes() ?>><?php echo $zmenu->posicion->ListViewValue() ?></div></td>
		<td<?php echo $zmenu->orden->CellAttributes() ?>>
<div<?php echo $zmenu->orden->ViewAttributes() ?>><?php echo $zmenu->orden->ListViewValue() ?></div></td>
		<td<?php echo $zmenu->estatus->CellAttributes() ?>>
<div<?php echo $zmenu->estatus->ViewAttributes() ?>><?php echo $zmenu->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$zmenu_delete->Recordset->MoveNext();
}
$zmenu_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$zmenu_delete->ShowPageFooter();
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
$zmenu_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class czmenu_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'menu';

	// Page object name
	var $PageObjName = 'zmenu_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $zmenu;
		if ($zmenu->UseTokenInUrl) $PageUrl .= "t=" . $zmenu->TableVar . "&"; // Add page token
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
		global $objForm, $zmenu;
		if ($zmenu->UseTokenInUrl) {
			if ($objForm)
				return ($zmenu->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($zmenu->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function czmenu_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (zmenu)
		if (!isset($GLOBALS["zmenu"])) {
			$GLOBALS["zmenu"] = new czmenu();
			$GLOBALS["Table"] =& $GLOBALS["zmenu"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'menu', TRUE);

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
		global $zmenu;

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
			$this->Page_Terminate("zmenulist.php");
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
		global $Language, $zmenu;

		// Load key parameters
		$this->RecKeys = $zmenu->GetRecordKeys(); // Load record keys
		$sFilter = $zmenu->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("zmenulist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in zmenu class, zmenuinfo.php

		$zmenu->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$zmenu->CurrentAction = $_POST["a_delete"];
		} else {
			$zmenu->CurrentAction = "I"; // Display record
		}
		switch ($zmenu->CurrentAction) {
			case "D": // Delete
				$zmenu->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($zmenu->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $zmenu;

		// Call Recordset Selecting event
		$zmenu->Recordset_Selecting($zmenu->CurrentFilter);

		// Load List page SQL
		$sSql = $zmenu->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$zmenu->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $zmenu;
		$sFilter = $zmenu->KeyFilter();

		// Call Row Selecting event
		$zmenu->Row_Selecting($sFilter);

		// Load SQL based on filter
		$zmenu->CurrentFilter = $sFilter;
		$sSql = $zmenu->SQL();
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
		global $conn, $zmenu;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$zmenu->Row_Selected($row);
		$zmenu->id_menu->setDbValue($rs->fields('id_menu'));
		$zmenu->id_grupo_seccion->setDbValue($rs->fields('id_grupo_seccion'));
		$zmenu->posicion->setDbValue($rs->fields('posicion'));
		$zmenu->orden->setDbValue($rs->fields('orden'));
		$zmenu->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $zmenu;

		// Initialize URLs
		// Call Row_Rendering event

		$zmenu->Row_Rendering();

		// Common render codes for all row types
		// id_menu

		$zmenu->id_menu->CellCssStyle = "white-space: nowrap;";

		// id_grupo_seccion
		// posicion
		// orden
		// estatus

		if ($zmenu->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_grupo_seccion
			if (strval($zmenu->id_grupo_seccion->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($zmenu->id_grupo_seccion->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view2`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$zmenu->id_grupo_seccion->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$zmenu->id_grupo_seccion->ViewValue = $zmenu->id_grupo_seccion->CurrentValue;
				}
			} else {
				$zmenu->id_grupo_seccion->ViewValue = NULL;
			}
			$zmenu->id_grupo_seccion->ViewCustomAttributes = "";

			// posicion
			if (strval($zmenu->posicion->CurrentValue) <> "") {
				switch ($zmenu->posicion->CurrentValue) {
					case "1":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(1) <> "" ? $zmenu->posicion->FldTagCaption(1) : $zmenu->posicion->CurrentValue;
						break;
					case "2":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(2) <> "" ? $zmenu->posicion->FldTagCaption(2) : $zmenu->posicion->CurrentValue;
						break;
					case "3":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(3) <> "" ? $zmenu->posicion->FldTagCaption(3) : $zmenu->posicion->CurrentValue;
						break;
					case "4":
						$zmenu->posicion->ViewValue = $zmenu->posicion->FldTagCaption(4) <> "" ? $zmenu->posicion->FldTagCaption(4) : $zmenu->posicion->CurrentValue;
						break;
					default:
						$zmenu->posicion->ViewValue = $zmenu->posicion->CurrentValue;
				}
			} else {
				$zmenu->posicion->ViewValue = NULL;
			}
			$zmenu->posicion->ViewCustomAttributes = "";

			// orden
			$zmenu->orden->ViewValue = $zmenu->orden->CurrentValue;
			$zmenu->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($zmenu->estatus->CurrentValue) <> "") {
				switch ($zmenu->estatus->CurrentValue) {
					case "1":
						$zmenu->estatus->ViewValue = $zmenu->estatus->FldTagCaption(1) <> "" ? $zmenu->estatus->FldTagCaption(1) : $zmenu->estatus->CurrentValue;
						break;
					case "0":
						$zmenu->estatus->ViewValue = $zmenu->estatus->FldTagCaption(2) <> "" ? $zmenu->estatus->FldTagCaption(2) : $zmenu->estatus->CurrentValue;
						break;
					default:
						$zmenu->estatus->ViewValue = $zmenu->estatus->CurrentValue;
				}
			} else {
				$zmenu->estatus->ViewValue = NULL;
			}
			$zmenu->estatus->ViewCustomAttributes = "";

			// id_grupo_seccion
			$zmenu->id_grupo_seccion->LinkCustomAttributes = "";
			$zmenu->id_grupo_seccion->HrefValue = "";
			$zmenu->id_grupo_seccion->TooltipValue = "";

			// posicion
			$zmenu->posicion->LinkCustomAttributes = "";
			$zmenu->posicion->HrefValue = "";
			$zmenu->posicion->TooltipValue = "";

			// orden
			$zmenu->orden->LinkCustomAttributes = "";
			$zmenu->orden->HrefValue = "";
			$zmenu->orden->TooltipValue = "";

			// estatus
			$zmenu->estatus->LinkCustomAttributes = "";
			$zmenu->estatus->HrefValue = "";
			$zmenu->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($zmenu->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$zmenu->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $zmenu;
		$DeleteRows = TRUE;
		$sSql = $zmenu->SQL();
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
				$DeleteRows = $zmenu->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_menu'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($zmenu->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($zmenu->CancelMessage <> "") {
				$this->setFailureMessage($zmenu->CancelMessage);
				$zmenu->CancelMessage = "";
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
				$zmenu->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'menu';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $zmenu;
		$table = 'menu';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_menu'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $zmenu->fields) && $zmenu->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($zmenu->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($zmenu->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
