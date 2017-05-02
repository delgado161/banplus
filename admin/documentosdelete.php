<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documentos_delete = new cdocumentos_delete();
$Page =& $documentos_delete;

// Page init
$documentos_delete->Page_Init();

// Page main
$documentos_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_delete = new ew_Page("documentos_delete");

// page properties
documentos_delete.PageID = "delete"; // page ID
documentos_delete.FormID = "fdocumentosdelete"; // form ID
var EW_PAGE_ID = documentos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
documentos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_delete.ValidateRequired = false; // no JavaScript validation
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
if ($documentos_delete->Recordset = $documentos_delete->LoadRecordset())
	$documentos_deleteTotalRecs = $documentos_delete->Recordset->RecordCount(); // Get record count
if ($documentos_deleteTotalRecs <= 0) { // No record found, exit
	if ($documentos_delete->Recordset)
		$documentos_delete->Recordset->Close();
	$documentos_delete->Page_Terminate("documentoslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $documentos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $documentos_delete->ShowPageHeader(); ?>
<?php
$documentos_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="documentos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($documentos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $documentos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $documentos->titulo->FldCaption() ?></td>
		<td valign="top"><?php echo $documentos->documento->FldCaption() ?></td>
		<td valign="top"><?php echo $documentos->fecha->FldCaption() ?></td>
		<td valign="top"><?php echo $documentos->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$documentos_delete->RecCnt = 0;
$i = 0;
while (!$documentos_delete->Recordset->EOF) {
	$documentos_delete->RecCnt++;

	// Set row properties
	$documentos->ResetAttrs();
	$documentos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$documentos_delete->LoadRowValues($documentos_delete->Recordset);

	// Render row
	$documentos_delete->RenderRow();
?>
	<tr<?php echo $documentos->RowAttributes() ?>>
		<td<?php echo $documentos->titulo->CellAttributes() ?>>
<div<?php echo $documentos->titulo->ViewAttributes() ?>><?php echo $documentos->titulo->ListViewValue() ?></div></td>
		<td<?php echo $documentos->documento->CellAttributes() ?>>
<?php if ($documentos->documento->LinkAttributes() <> "") { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<a<?php echo $documentos->documento->LinkAttributes() ?>><?php echo $documentos->documento->ListViewValue() ?></a>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<?php echo $documentos->documento->ListViewValue() ?>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $documentos->fecha->CellAttributes() ?>>
<div<?php echo $documentos->fecha->ViewAttributes() ?>><?php echo $documentos->fecha->ListViewValue() ?></div></td>
		<td<?php echo $documentos->estatus->CellAttributes() ?>>
<div<?php echo $documentos->estatus->ViewAttributes() ?>><?php echo $documentos->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$documentos_delete->Recordset->MoveNext();
}
$documentos_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$documentos_delete->ShowPageFooter();
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
$documentos_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumentos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'documentos';

	// Page object name
	var $PageObjName = 'documentos_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documentos;
		if ($documentos->UseTokenInUrl) $PageUrl .= "t=" . $documentos->TableVar . "&"; // Add page token
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
			$pos = strpos($sErrorMessage, "REFERENCES");
			if ($pos == true) 
				echo "<p class=\"ewErrorMessage\">No se puede eliminar este documento porque esta relacionado con un contenido</p>";
			else
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
		global $objForm, $documentos;
		if ($documentos->UseTokenInUrl) {
			if ($objForm)
				return ($documentos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documentos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumentos_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documentos)
		if (!isset($GLOBALS["documentos"])) {
			$GLOBALS["documentos"] = new cdocumentos();
			$GLOBALS["Table"] =& $GLOBALS["documentos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documentos', TRUE);

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
		global $documentos;

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
			$this->Page_Terminate("documentoslist.php");
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
		global $Language, $documentos;

		// Load key parameters
		$this->RecKeys = $documentos->GetRecordKeys(); // Load record keys
		$sFilter = $documentos->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("documentoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in documentos class, documentosinfo.php

		$documentos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$documentos->CurrentAction = $_POST["a_delete"];
		} else {
			$documentos->CurrentAction = "I"; // Display record
		}
		switch ($documentos->CurrentAction) {
			case "D": // Delete
				$documentos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($documentos->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $documentos;

		// Call Recordset Selecting event
		$documentos->Recordset_Selecting($documentos->CurrentFilter);

		// Load List page SQL
		$sSql = $documentos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$documentos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documentos;
		$sFilter = $documentos->KeyFilter();

		// Call Row Selecting event
		$documentos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documentos->CurrentFilter = $sFilter;
		$sSql = $documentos->SQL();
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
		global $conn, $documentos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documentos->Row_Selected($row);
		$documentos->id_documentos->setDbValue($rs->fields('id_documentos'));
		$documentos->titulo->setDbValue($rs->fields('titulo'));
		$documentos->sumario->setDbValue($rs->fields('sumario'));
		$documentos->documento->Upload->DbValue = $rs->fields('documento');
		$documentos->fecha->setDbValue($rs->fields('fecha'));
		$documentos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documentos;

		// Initialize URLs
		// Call Row_Rendering event

		$documentos->Row_Rendering();

		// Common render codes for all row types
		// id_documentos
		// titulo
		// sumario
		// documento
		// fecha
		// estatus

		if ($documentos->RowType == EW_ROWTYPE_VIEW) { // View row

			// titulo
			$documentos->titulo->ViewValue = $documentos->titulo->CurrentValue;
			$documentos->titulo->ViewCustomAttributes = "";

			// sumario
			$documentos->sumario->ViewValue = $documentos->sumario->CurrentValue;
			$documentos->sumario->ViewCustomAttributes = "";

			// documento
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->ViewValue = $documentos->documento->Upload->DbValue;
			} else {
				$documentos->documento->ViewValue = "";
			}
			$documentos->documento->ViewCustomAttributes = "";

			// fecha
			$documentos->fecha->ViewValue = $documentos->fecha->CurrentValue;
			$documentos->fecha->ViewValue = ew_FormatDateTime($documentos->fecha->ViewValue, 7);
			$documentos->fecha->ViewCustomAttributes = "";

			// estatus
			if (strval($documentos->estatus->CurrentValue) <> "") {
				switch ($documentos->estatus->CurrentValue) {
					case "1":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(1) <> "" ? $documentos->estatus->FldTagCaption(1) : $documentos->estatus->CurrentValue;
						break;
					case "0":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(2) <> "" ? $documentos->estatus->FldTagCaption(2) : $documentos->estatus->CurrentValue;
						break;
					default:
						$documentos->estatus->ViewValue = $documentos->estatus->CurrentValue;
				}
			} else {
				$documentos->estatus->ViewValue = NULL;
			}
			$documentos->estatus->ViewCustomAttributes = "";

			// titulo
			$documentos->titulo->LinkCustomAttributes = "";
			$documentos->titulo->HrefValue = "";
			$documentos->titulo->TooltipValue = "";

			// documento
			$documentos->documento->LinkCustomAttributes = "";
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->HrefValue = ew_UploadPathEx(FALSE, $documentos->documento->UploadPath) . ((!empty($documentos->documento->ViewValue)) ? $documentos->documento->ViewValue : $documentos->documento->CurrentValue); // Add prefix/suffix
				$documentos->documento->LinkAttrs["target"] = ""; // Add target
				if ($documentos->Export <> "") $documentos->documento->HrefValue = ew_ConvertFullUrl($documentos->documento->HrefValue);
			} else {
				$documentos->documento->HrefValue = "";
			}
			$documentos->documento->TooltipValue = "";

			// fecha
			$documentos->fecha->LinkCustomAttributes = "";
			$documentos->fecha->HrefValue = "";
			$documentos->fecha->TooltipValue = "";

			// estatus
			$documentos->estatus->LinkCustomAttributes = "";
			$documentos->estatus->HrefValue = "";
			$documentos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($documentos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documentos->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $documentos;
		$DeleteRows = TRUE;
		$sSql = $documentos->SQL();
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
				$DeleteRows = $documentos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_documentos'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($documentos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($documentos->CancelMessage <> "") {
				$this->setFailureMessage($documentos->CancelMessage);
				$documentos->CancelMessage = "";
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
				$documentos->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'documentos';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $documentos;
		$table = 'documentos';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_documentos'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $documentos->fields) && $documentos->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($documentos->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($documentos->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
