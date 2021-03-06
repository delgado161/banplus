<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "calendarioinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$calendario_delete = new ccalendario_delete();
$Page =& $calendario_delete;

// Page init
$calendario_delete->Page_Init();

// Page main
$calendario_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var calendario_delete = new ew_Page("calendario_delete");

// page properties
calendario_delete.PageID = "delete"; // page ID
calendario_delete.FormID = "fcalendariodelete"; // form ID
var EW_PAGE_ID = calendario_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
calendario_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
calendario_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
calendario_delete.ValidateRequired = false; // no JavaScript validation
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
if ($calendario_delete->Recordset = $calendario_delete->LoadRecordset())
	$calendario_deleteTotalRecs = $calendario_delete->Recordset->RecordCount(); // Get record count
if ($calendario_deleteTotalRecs <= 0) { // No record found, exit
	if ($calendario_delete->Recordset)
		$calendario_delete->Recordset->Close();
	$calendario_delete->Page_Terminate("calendariolist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $calendario->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $calendario->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $calendario_delete->ShowPageHeader(); ?>
<?php
$calendario_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="calendario">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($calendario_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $calendario->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $calendario->tipo->FldCaption() ?></td>
		<td valign="top"><?php echo $calendario->fecha->FldCaption() ?></td>
		<td valign="top"><?php echo $calendario->descripcion->FldCaption() ?></td>
		<td valign="top"><?php echo $calendario->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$calendario_delete->RecCnt = 0;
$i = 0;
while (!$calendario_delete->Recordset->EOF) {
	$calendario_delete->RecCnt++;

	// Set row properties
	$calendario->ResetAttrs();
	$calendario->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$calendario_delete->LoadRowValues($calendario_delete->Recordset);

	// Render row
	$calendario_delete->RenderRow();
?>
	<tr<?php echo $calendario->RowAttributes() ?>>
		<td<?php echo $calendario->tipo->CellAttributes() ?>>
<div<?php echo $calendario->tipo->ViewAttributes() ?>><?php echo $calendario->tipo->ListViewValue() ?></div></td>
		<td<?php echo $calendario->fecha->CellAttributes() ?>>
<div<?php echo $calendario->fecha->ViewAttributes() ?>><?php echo $calendario->fecha->ListViewValue() ?></div></td>
		<td<?php echo $calendario->descripcion->CellAttributes() ?>>
<div<?php echo $calendario->descripcion->ViewAttributes() ?>><?php echo $calendario->descripcion->ListViewValue() ?></div></td>
		<td<?php echo $calendario->estatus->CellAttributes() ?>>
<div<?php echo $calendario->estatus->ViewAttributes() ?>><?php echo $calendario->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$calendario_delete->Recordset->MoveNext();
}
$calendario_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$calendario_delete->ShowPageFooter();
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
$calendario_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccalendario_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'calendario';

	// Page object name
	var $PageObjName = 'calendario_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $calendario;
		if ($calendario->UseTokenInUrl) $PageUrl .= "t=" . $calendario->TableVar . "&"; // Add page token
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
		global $objForm, $calendario;
		if ($calendario->UseTokenInUrl) {
			if ($objForm)
				return ($calendario->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($calendario->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccalendario_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (calendario)
		if (!isset($GLOBALS["calendario"])) {
			$GLOBALS["calendario"] = new ccalendario();
			$GLOBALS["Table"] =& $GLOBALS["calendario"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'calendario', TRUE);

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
		global $calendario;

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
			$this->Page_Terminate("calendariolist.php");
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
		global $Language, $calendario;

		// Load key parameters
		$this->RecKeys = $calendario->GetRecordKeys(); // Load record keys
		$sFilter = $calendario->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("calendariolist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in calendario class, calendarioinfo.php

		$calendario->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$calendario->CurrentAction = $_POST["a_delete"];
		} else {
			$calendario->CurrentAction = "I"; // Display record
		}
		switch ($calendario->CurrentAction) {
			case "D": // Delete
				$calendario->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($calendario->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $calendario;

		// Call Recordset Selecting event
		$calendario->Recordset_Selecting($calendario->CurrentFilter);

		// Load List page SQL
		$sSql = $calendario->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$calendario->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $calendario;
		$sFilter = $calendario->KeyFilter();

		// Call Row Selecting event
		$calendario->Row_Selecting($sFilter);

		// Load SQL based on filter
		$calendario->CurrentFilter = $sFilter;
		$sSql = $calendario->SQL();
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
		global $conn, $calendario;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$calendario->Row_Selected($row);
		$calendario->id_calendario->setDbValue($rs->fields('id_calendario'));
		$calendario->tipo->setDbValue($rs->fields('tipo'));
		$calendario->fecha->setDbValue($rs->fields('fecha'));
		$calendario->descripcion->setDbValue($rs->fields('descripcion'));
		$calendario->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $calendario;

		// Initialize URLs
		// Call Row_Rendering event

		$calendario->Row_Rendering();

		// Common render codes for all row types
		// id_calendario
		// tipo
		// fecha
		// descripcion
		// estatus

		if ($calendario->RowType == EW_ROWTYPE_VIEW) { // View row

			// tipo
			if (strval($calendario->tipo->CurrentValue) <> "") {
				$calendario->tipo->ViewValue = "";
				$arwrk = explode(",", strval($calendario->tipo->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++) {
					switch (trim($arwrk[$ari])) {
						case "1":
							$calendario->tipo->ViewValue .= $calendario->tipo->FldTagCaption(1) <> "" ? $calendario->tipo->FldTagCaption(1) : trim($arwrk[$ari]);
							break;
						case "2":
							$calendario->tipo->ViewValue .= $calendario->tipo->FldTagCaption(2) <> "" ? $calendario->tipo->FldTagCaption(2) : trim($arwrk[$ari]);
							break;
						default:
							$calendario->tipo->ViewValue .= trim($arwrk[$ari]);
					}
					if ($ari < $cnt-1) $calendario->tipo->ViewValue .= ew_ViewOptionSeparator($ari);
				}
			} else {
				$calendario->tipo->ViewValue = NULL;
			}
			$calendario->tipo->ViewCustomAttributes = "";

			// fecha
			$calendario->fecha->ViewValue = $calendario->fecha->CurrentValue;
			$calendario->fecha->ViewValue = ew_FormatDateTime($calendario->fecha->ViewValue, 7);
			$calendario->fecha->ViewCustomAttributes = "";

			// descripcion
			$calendario->descripcion->ViewValue = $calendario->descripcion->CurrentValue;
			$calendario->descripcion->ViewCustomAttributes = "";

			// estatus
			if (strval($calendario->estatus->CurrentValue) <> "") {
				switch ($calendario->estatus->CurrentValue) {
					case "1":
						$calendario->estatus->ViewValue = $calendario->estatus->FldTagCaption(1) <> "" ? $calendario->estatus->FldTagCaption(1) : $calendario->estatus->CurrentValue;
						break;
					case "0":
						$calendario->estatus->ViewValue = $calendario->estatus->FldTagCaption(2) <> "" ? $calendario->estatus->FldTagCaption(2) : $calendario->estatus->CurrentValue;
						break;
					default:
						$calendario->estatus->ViewValue = $calendario->estatus->CurrentValue;
				}
			} else {
				$calendario->estatus->ViewValue = NULL;
			}
			$calendario->estatus->ViewCustomAttributes = "";

			// tipo
			$calendario->tipo->LinkCustomAttributes = "";
			$calendario->tipo->HrefValue = "";
			$calendario->tipo->TooltipValue = "";

			// fecha
			$calendario->fecha->LinkCustomAttributes = "";
			$calendario->fecha->HrefValue = "";
			$calendario->fecha->TooltipValue = "";

			// descripcion
			$calendario->descripcion->LinkCustomAttributes = "";
			$calendario->descripcion->HrefValue = "";
			$calendario->descripcion->TooltipValue = "";

			// estatus
			$calendario->estatus->LinkCustomAttributes = "";
			$calendario->estatus->HrefValue = "";
			$calendario->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($calendario->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$calendario->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $calendario;
		$DeleteRows = TRUE;
		$sSql = $calendario->SQL();
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
				$DeleteRows = $calendario->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_calendario'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($calendario->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($calendario->CancelMessage <> "") {
				$this->setFailureMessage($calendario->CancelMessage);
				$calendario->CancelMessage = "";
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
				$calendario->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'calendario';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $calendario;
		$table = 'calendario';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_calendario'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $calendario->fields) && $calendario->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($calendario->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($calendario->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
