<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "informacion_financierainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$informacion_financiera_delete = new cinformacion_financiera_delete();
$Page =& $informacion_financiera_delete;

// Page init
$informacion_financiera_delete->Page_Init();

// Page main
$informacion_financiera_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var informacion_financiera_delete = new ew_Page("informacion_financiera_delete");

// page properties
informacion_financiera_delete.PageID = "delete"; // page ID
informacion_financiera_delete.FormID = "finformacion_financieradelete"; // form ID
var EW_PAGE_ID = informacion_financiera_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
informacion_financiera_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
informacion_financiera_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
informacion_financiera_delete.ValidateRequired = false; // no JavaScript validation
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
if ($informacion_financiera_delete->Recordset = $informacion_financiera_delete->LoadRecordset())
	$informacion_financiera_deleteTotalRecs = $informacion_financiera_delete->Recordset->RecordCount(); // Get record count
if ($informacion_financiera_deleteTotalRecs <= 0) { // No record found, exit
	if ($informacion_financiera_delete->Recordset)
		$informacion_financiera_delete->Recordset->Close();
	$informacion_financiera_delete->Page_Terminate("informacion_financieralist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $informacion_financiera->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $informacion_financiera->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $informacion_financiera_delete->ShowPageHeader(); ?>
<?php
$informacion_financiera_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="informacion_financiera">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($informacion_financiera_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $informacion_financiera->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $informacion_financiera->ano->FldCaption() ?></td>
		<td valign="top"><?php echo $informacion_financiera->mes->FldCaption() ?></td>
		<td valign="top"><?php echo $informacion_financiera->archivo->FldCaption() ?></td>
		<td valign="top"><?php echo $informacion_financiera->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$informacion_financiera_delete->RecCnt = 0;
$i = 0;
while (!$informacion_financiera_delete->Recordset->EOF) {
	$informacion_financiera_delete->RecCnt++;

	// Set row properties
	$informacion_financiera->ResetAttrs();
	$informacion_financiera->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$informacion_financiera_delete->LoadRowValues($informacion_financiera_delete->Recordset);

	// Render row
	$informacion_financiera_delete->RenderRow();
?>
	<tr<?php echo $informacion_financiera->RowAttributes() ?>>
		<td<?php echo $informacion_financiera->ano->CellAttributes() ?>>
<div<?php echo $informacion_financiera->ano->ViewAttributes() ?>><?php echo $informacion_financiera->ano->ListViewValue() ?></div></td>
		<td<?php echo $informacion_financiera->mes->CellAttributes() ?>>
<div<?php echo $informacion_financiera->mes->ViewAttributes() ?>><?php echo $informacion_financiera->mes->ListViewValue() ?></div></td>
		<td<?php echo $informacion_financiera->archivo->CellAttributes() ?>>
<?php if ($informacion_financiera->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($informacion_financiera->archivo->Upload->DbValue)) { ?>
<a<?php echo $informacion_financiera->archivo->LinkAttributes() ?>><?php echo $informacion_financiera->archivo->ListViewValue() ?></a>
<?php } elseif (!in_array($informacion_financiera->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($informacion_financiera->archivo->Upload->DbValue)) { ?>
<?php echo $informacion_financiera->archivo->ListViewValue() ?>
<?php } elseif (!in_array($informacion_financiera->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $informacion_financiera->estatus->CellAttributes() ?>>
<div<?php echo $informacion_financiera->estatus->ViewAttributes() ?>><?php echo $informacion_financiera->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$informacion_financiera_delete->Recordset->MoveNext();
}
$informacion_financiera_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$informacion_financiera_delete->ShowPageFooter();
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
$informacion_financiera_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cinformacion_financiera_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'informacion_financiera';

	// Page object name
	var $PageObjName = 'informacion_financiera_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $informacion_financiera;
		if ($informacion_financiera->UseTokenInUrl) $PageUrl .= "t=" . $informacion_financiera->TableVar . "&"; // Add page token
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
		global $objForm, $informacion_financiera;
		if ($informacion_financiera->UseTokenInUrl) {
			if ($objForm)
				return ($informacion_financiera->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($informacion_financiera->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinformacion_financiera_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (informacion_financiera)
		if (!isset($GLOBALS["informacion_financiera"])) {
			$GLOBALS["informacion_financiera"] = new cinformacion_financiera();
			$GLOBALS["Table"] =& $GLOBALS["informacion_financiera"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'informacion_financiera', TRUE);

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
		global $informacion_financiera;

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
			$this->Page_Terminate("informacion_financieralist.php");
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
		global $Language, $informacion_financiera;

		// Load key parameters
		$this->RecKeys = $informacion_financiera->GetRecordKeys(); // Load record keys
		$sFilter = $informacion_financiera->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("informacion_financieralist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in informacion_financiera class, informacion_financierainfo.php

		$informacion_financiera->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$informacion_financiera->CurrentAction = $_POST["a_delete"];
		} else {
			$informacion_financiera->CurrentAction = "I"; // Display record
		}
		switch ($informacion_financiera->CurrentAction) {
			case "D": // Delete
				$informacion_financiera->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($informacion_financiera->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $informacion_financiera;

		// Call Recordset Selecting event
		$informacion_financiera->Recordset_Selecting($informacion_financiera->CurrentFilter);

		// Load List page SQL
		$sSql = $informacion_financiera->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$informacion_financiera->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $informacion_financiera;
		$sFilter = $informacion_financiera->KeyFilter();

		// Call Row Selecting event
		$informacion_financiera->Row_Selecting($sFilter);

		// Load SQL based on filter
		$informacion_financiera->CurrentFilter = $sFilter;
		$sSql = $informacion_financiera->SQL();
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
		global $conn, $informacion_financiera;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$informacion_financiera->Row_Selected($row);
		$informacion_financiera->id_informacion_financiera->setDbValue($rs->fields('id_informacion_financiera'));
		$informacion_financiera->ano->setDbValue($rs->fields('ano'));
		$informacion_financiera->mes->setDbValue($rs->fields('mes'));
		$informacion_financiera->archivo->Upload->DbValue = $rs->fields('archivo');
		$informacion_financiera->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $informacion_financiera;

		// Initialize URLs
		// Call Row_Rendering event

		$informacion_financiera->Row_Rendering();

		// Common render codes for all row types
		// id_informacion_financiera
		// ano
		// mes
		// archivo
		// estatus

		if ($informacion_financiera->RowType == EW_ROWTYPE_VIEW) { // View row

			// ano
			$informacion_financiera->ano->ViewValue = $informacion_financiera->ano->CurrentValue;
			$informacion_financiera->ano->ViewCustomAttributes = "";

			// mes
			if (strval($informacion_financiera->mes->CurrentValue) <> "") {
				switch ($informacion_financiera->mes->CurrentValue) {
					case "1":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(1) <> "" ? $informacion_financiera->mes->FldTagCaption(1) : $informacion_financiera->mes->CurrentValue;
						break;
					case "2":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(2) <> "" ? $informacion_financiera->mes->FldTagCaption(2) : $informacion_financiera->mes->CurrentValue;
						break;
					case "3":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(3) <> "" ? $informacion_financiera->mes->FldTagCaption(3) : $informacion_financiera->mes->CurrentValue;
						break;
					case "4":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(4) <> "" ? $informacion_financiera->mes->FldTagCaption(4) : $informacion_financiera->mes->CurrentValue;
						break;
					case "5":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(5) <> "" ? $informacion_financiera->mes->FldTagCaption(5) : $informacion_financiera->mes->CurrentValue;
						break;
					case "6":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(6) <> "" ? $informacion_financiera->mes->FldTagCaption(6) : $informacion_financiera->mes->CurrentValue;
						break;
					case "7":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(7) <> "" ? $informacion_financiera->mes->FldTagCaption(7) : $informacion_financiera->mes->CurrentValue;
						break;
					case "8":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(8) <> "" ? $informacion_financiera->mes->FldTagCaption(8) : $informacion_financiera->mes->CurrentValue;
						break;
					case "9":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(9) <> "" ? $informacion_financiera->mes->FldTagCaption(9) : $informacion_financiera->mes->CurrentValue;
						break;
					case "10":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(10) <> "" ? $informacion_financiera->mes->FldTagCaption(10) : $informacion_financiera->mes->CurrentValue;
						break;
					case "11":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(11) <> "" ? $informacion_financiera->mes->FldTagCaption(11) : $informacion_financiera->mes->CurrentValue;
						break;
					case "12":
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->FldTagCaption(12) <> "" ? $informacion_financiera->mes->FldTagCaption(12) : $informacion_financiera->mes->CurrentValue;
						break;
					default:
						$informacion_financiera->mes->ViewValue = $informacion_financiera->mes->CurrentValue;
				}
			} else {
				$informacion_financiera->mes->ViewValue = NULL;
			}
			$informacion_financiera->mes->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->ViewValue = $informacion_financiera->archivo->Upload->DbValue;
			} else {
				$informacion_financiera->archivo->ViewValue = "";
			}
			$informacion_financiera->archivo->ViewCustomAttributes = "";

			// estatus
			if (strval($informacion_financiera->estatus->CurrentValue) <> "") {
				switch ($informacion_financiera->estatus->CurrentValue) {
					case "1":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(1) <> "" ? $informacion_financiera->estatus->FldTagCaption(1) : $informacion_financiera->estatus->CurrentValue;
						break;
					case "0":
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->FldTagCaption(2) <> "" ? $informacion_financiera->estatus->FldTagCaption(2) : $informacion_financiera->estatus->CurrentValue;
						break;
					default:
						$informacion_financiera->estatus->ViewValue = $informacion_financiera->estatus->CurrentValue;
				}
			} else {
				$informacion_financiera->estatus->ViewValue = NULL;
			}
			$informacion_financiera->estatus->ViewCustomAttributes = "";

			// ano
			$informacion_financiera->ano->LinkCustomAttributes = "";
			$informacion_financiera->ano->HrefValue = "";
			$informacion_financiera->ano->TooltipValue = "";

			// mes
			$informacion_financiera->mes->LinkCustomAttributes = "";
			$informacion_financiera->mes->HrefValue = "";
			$informacion_financiera->mes->TooltipValue = "";

			// archivo
			$informacion_financiera->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($informacion_financiera->archivo->Upload->DbValue)) {
				$informacion_financiera->archivo->HrefValue = ew_UploadPathEx(FALSE, $informacion_financiera->archivo->UploadPath) . ((!empty($informacion_financiera->archivo->ViewValue)) ? $informacion_financiera->archivo->ViewValue : $informacion_financiera->archivo->CurrentValue); // Add prefix/suffix
				$informacion_financiera->archivo->LinkAttrs["target"] = ""; // Add target
				if ($informacion_financiera->Export <> "") $informacion_financiera->archivo->HrefValue = ew_ConvertFullUrl($informacion_financiera->archivo->HrefValue);
			} else {
				$informacion_financiera->archivo->HrefValue = "";
			}
			$informacion_financiera->archivo->TooltipValue = "";

			// estatus
			$informacion_financiera->estatus->LinkCustomAttributes = "";
			$informacion_financiera->estatus->HrefValue = "";
			$informacion_financiera->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($informacion_financiera->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$informacion_financiera->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $informacion_financiera;
		$DeleteRows = TRUE;
		$sSql = $informacion_financiera->SQL();
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
				$DeleteRows = $informacion_financiera->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_informacion_financiera'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($informacion_financiera->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($informacion_financiera->CancelMessage <> "") {
				$this->setFailureMessage($informacion_financiera->CancelMessage);
				$informacion_financiera->CancelMessage = "";
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
				$informacion_financiera->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'informacion_financiera';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $informacion_financiera;
		$table = 'informacion_financiera';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_informacion_financiera'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $informacion_financiera->fields) && $informacion_financiera->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($informacion_financiera->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($informacion_financiera->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
