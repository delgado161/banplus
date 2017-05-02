<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "encuestainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$encuesta_delete = new cencuesta_delete();
$Page =& $encuesta_delete;

// Page init
$encuesta_delete->Page_Init();

// Page main
$encuesta_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var encuesta_delete = new ew_Page("encuesta_delete");

// page properties
encuesta_delete.PageID = "delete"; // page ID
encuesta_delete.FormID = "fencuestadelete"; // form ID
var EW_PAGE_ID = encuesta_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
encuesta_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
encuesta_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
encuesta_delete.ValidateRequired = false; // no JavaScript validation
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
if ($encuesta_delete->Recordset = $encuesta_delete->LoadRecordset())
	$encuesta_deleteTotalRecs = $encuesta_delete->Recordset->RecordCount(); // Get record count
if ($encuesta_deleteTotalRecs <= 0) { // No record found, exit
	if ($encuesta_delete->Recordset)
		$encuesta_delete->Recordset->Close();
	$encuesta_delete->Page_Terminate("encuestalist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $encuesta->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $encuesta->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $encuesta_delete->ShowPageHeader(); ?>
<?php
$encuesta_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="encuesta">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($encuesta_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $encuesta->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $encuesta->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $encuesta->id_grupo->FldCaption() ?></td>
		<td valign="top"><?php echo $encuesta->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$encuesta_delete->RecCnt = 0;
$i = 0;
while (!$encuesta_delete->Recordset->EOF) {
	$encuesta_delete->RecCnt++;

	// Set row properties
	$encuesta->ResetAttrs();
	$encuesta->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$encuesta_delete->LoadRowValues($encuesta_delete->Recordset);

	// Render row
	$encuesta_delete->RenderRow();
?>
	<tr<?php echo $encuesta->RowAttributes() ?>>
		<td<?php echo $encuesta->nombre->CellAttributes() ?>>
<div<?php echo $encuesta->nombre->ViewAttributes() ?>><?php echo $encuesta->nombre->ListViewValue() ?></div></td>
		<td<?php echo $encuesta->id_grupo->CellAttributes() ?>>
<div<?php echo $encuesta->id_grupo->ViewAttributes() ?>><?php echo $encuesta->id_grupo->ListViewValue() ?></div></td>
		<td<?php echo $encuesta->estatus->CellAttributes() ?>>
<div<?php echo $encuesta->estatus->ViewAttributes() ?>><?php echo $encuesta->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$encuesta_delete->Recordset->MoveNext();
}
$encuesta_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$encuesta_delete->ShowPageFooter();
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
$encuesta_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cencuesta_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'encuesta';

	// Page object name
	var $PageObjName = 'encuesta_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $encuesta;
		if ($encuesta->UseTokenInUrl) $PageUrl .= "t=" . $encuesta->TableVar . "&"; // Add page token
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
		global $objForm, $encuesta;
		if ($encuesta->UseTokenInUrl) {
			if ($objForm)
				return ($encuesta->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($encuesta->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cencuesta_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (encuesta)
		if (!isset($GLOBALS["encuesta"])) {
			$GLOBALS["encuesta"] = new cencuesta();
			$GLOBALS["Table"] =& $GLOBALS["encuesta"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'encuesta', TRUE);

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
		global $encuesta;

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
			$this->Page_Terminate("encuestalist.php");
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
		global $Language, $encuesta;

		// Load key parameters
		$this->RecKeys = $encuesta->GetRecordKeys(); // Load record keys
		$sFilter = $encuesta->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("encuestalist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in encuesta class, encuestainfo.php

		$encuesta->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$encuesta->CurrentAction = $_POST["a_delete"];
		} else {
			$encuesta->CurrentAction = "I"; // Display record
		}
		switch ($encuesta->CurrentAction) {
			case "D": // Delete
				$encuesta->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($encuesta->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $encuesta;

		// Call Recordset Selecting event
		$encuesta->Recordset_Selecting($encuesta->CurrentFilter);

		// Load List page SQL
		$sSql = $encuesta->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$encuesta->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $encuesta;
		$sFilter = $encuesta->KeyFilter();

		// Call Row Selecting event
		$encuesta->Row_Selecting($sFilter);

		// Load SQL based on filter
		$encuesta->CurrentFilter = $sFilter;
		$sSql = $encuesta->SQL();
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
		global $conn, $encuesta;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$encuesta->Row_Selected($row);
		$encuesta->id_encuesta->setDbValue($rs->fields('id_encuesta'));
		$encuesta->nombre->setDbValue($rs->fields('nombre'));
		$encuesta->id_grupo->setDbValue($rs->fields('id_grupo'));
		$encuesta->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $encuesta;

		// Initialize URLs
		// Call Row_Rendering event

		$encuesta->Row_Rendering();

		// Common render codes for all row types
		// id_encuesta
		// nombre
		// id_grupo
		// estatus

		if ($encuesta->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$encuesta->nombre->ViewValue = $encuesta->nombre->CurrentValue;
			$encuesta->nombre->ViewCustomAttributes = "";

			// id_grupo
			if (strval($encuesta->id_grupo->CurrentValue) <> "") {
				$arwrk = explode(",", $encuesta->id_grupo->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_grupo` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is NULL";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$encuesta->id_grupo->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$encuesta->id_grupo->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $encuesta->id_grupo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$encuesta->id_grupo->ViewValue = $encuesta->id_grupo->CurrentValue;
				}
			} else {
				$encuesta->id_grupo->ViewValue = NULL;
			}
			$encuesta->id_grupo->ViewCustomAttributes = "";

			// estatus
			if (strval($encuesta->estatus->CurrentValue) <> "") {
				switch ($encuesta->estatus->CurrentValue) {
					case "1":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(1) <> "" ? $encuesta->estatus->FldTagCaption(1) : $encuesta->estatus->CurrentValue;
						break;
					case "0":
						$encuesta->estatus->ViewValue = $encuesta->estatus->FldTagCaption(2) <> "" ? $encuesta->estatus->FldTagCaption(2) : $encuesta->estatus->CurrentValue;
						break;
					default:
						$encuesta->estatus->ViewValue = $encuesta->estatus->CurrentValue;
				}
			} else {
				$encuesta->estatus->ViewValue = NULL;
			}
			$encuesta->estatus->ViewCustomAttributes = "";

			// nombre
			$encuesta->nombre->LinkCustomAttributes = "";
			$encuesta->nombre->HrefValue = "";
			$encuesta->nombre->TooltipValue = "";

			// id_grupo
			$encuesta->id_grupo->LinkCustomAttributes = "";
			$encuesta->id_grupo->HrefValue = "";
			$encuesta->id_grupo->TooltipValue = "";

			// estatus
			$encuesta->estatus->LinkCustomAttributes = "";
			$encuesta->estatus->HrefValue = "";
			$encuesta->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($encuesta->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$encuesta->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $encuesta;
		$DeleteRows = TRUE;
		$sSql = $encuesta->SQL();
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
				$DeleteRows = $encuesta->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_encuesta'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($encuesta->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($encuesta->CancelMessage <> "") {
				$this->setFailureMessage($encuesta->CancelMessage);
				$encuesta->CancelMessage = "";
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
				$encuesta->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'encuesta';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $encuesta;
		$table = 'encuesta';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_encuesta'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $encuesta->fields) && $encuesta->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($encuesta->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($encuesta->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
