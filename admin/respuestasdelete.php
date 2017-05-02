<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "respuestasinfo.php" ?>
<?php include_once "preguntasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$respuestas_delete = new crespuestas_delete();
$Page =& $respuestas_delete;

// Page init
$respuestas_delete->Page_Init();

// Page main
$respuestas_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var respuestas_delete = new ew_Page("respuestas_delete");

// page properties
respuestas_delete.PageID = "delete"; // page ID
respuestas_delete.FormID = "frespuestasdelete"; // form ID
var EW_PAGE_ID = respuestas_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
respuestas_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
respuestas_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
respuestas_delete.ValidateRequired = false; // no JavaScript validation
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
if ($respuestas_delete->Recordset = $respuestas_delete->LoadRecordset())
	$respuestas_deleteTotalRecs = $respuestas_delete->Recordset->RecordCount(); // Get record count
if ($respuestas_deleteTotalRecs <= 0) { // No record found, exit
	if ($respuestas_delete->Recordset)
		$respuestas_delete->Recordset->Close();
	$respuestas_delete->Page_Terminate("respuestaslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $respuestas->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $respuestas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $respuestas_delete->ShowPageHeader(); ?>
<?php
$respuestas_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="respuestas">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($respuestas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $respuestas->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $respuestas->id_pregunta->FldCaption() ?></td>
		<td valign="top"><?php echo $respuestas->respuesta->FldCaption() ?></td>
		<td valign="top"><?php echo $respuestas->contador->FldCaption() ?></td>
		<td valign="top"><?php echo $respuestas->orden->FldCaption() ?></td>
		<td valign="top"><?php echo $respuestas->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$respuestas_delete->RecCnt = 0;
$i = 0;
while (!$respuestas_delete->Recordset->EOF) {
	$respuestas_delete->RecCnt++;

	// Set row properties
	$respuestas->ResetAttrs();
	$respuestas->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$respuestas_delete->LoadRowValues($respuestas_delete->Recordset);

	// Render row
	$respuestas_delete->RenderRow();
?>
	<tr<?php echo $respuestas->RowAttributes() ?>>
		<td<?php echo $respuestas->id_pregunta->CellAttributes() ?>>
<div<?php echo $respuestas->id_pregunta->ViewAttributes() ?>><?php echo $respuestas->id_pregunta->ListViewValue() ?></div></td>
		<td<?php echo $respuestas->respuesta->CellAttributes() ?>>
<div<?php echo $respuestas->respuesta->ViewAttributes() ?>><?php echo $respuestas->respuesta->ListViewValue() ?></div></td>
		<td<?php echo $respuestas->contador->CellAttributes() ?>>
<div<?php echo $respuestas->contador->ViewAttributes() ?>><?php echo $respuestas->contador->ListViewValue() ?></div></td>
		<td<?php echo $respuestas->orden->CellAttributes() ?>>
<div<?php echo $respuestas->orden->ViewAttributes() ?>><?php echo $respuestas->orden->ListViewValue() ?></div></td>
		<td<?php echo $respuestas->estatus->CellAttributes() ?>>
<div<?php echo $respuestas->estatus->ViewAttributes() ?>><?php echo $respuestas->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$respuestas_delete->Recordset->MoveNext();
}
$respuestas_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$respuestas_delete->ShowPageFooter();
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
$respuestas_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class crespuestas_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'respuestas';

	// Page object name
	var $PageObjName = 'respuestas_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $respuestas;
		if ($respuestas->UseTokenInUrl) $PageUrl .= "t=" . $respuestas->TableVar . "&"; // Add page token
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
		global $objForm, $respuestas;
		if ($respuestas->UseTokenInUrl) {
			if ($objForm)
				return ($respuestas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($respuestas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crespuestas_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (respuestas)
		if (!isset($GLOBALS["respuestas"])) {
			$GLOBALS["respuestas"] = new crespuestas();
			$GLOBALS["Table"] =& $GLOBALS["respuestas"];
		}

		// Table object (preguntas)
		if (!isset($GLOBALS['preguntas'])) $GLOBALS['preguntas'] = new cpreguntas();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'respuestas', TRUE);

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
		global $respuestas;

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
			$this->Page_Terminate("respuestaslist.php");
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
		global $Language, $respuestas;

		// Load key parameters
		$this->RecKeys = $respuestas->GetRecordKeys(); // Load record keys
		$sFilter = $respuestas->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("respuestaslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in respuestas class, respuestasinfo.php

		$respuestas->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$respuestas->CurrentAction = $_POST["a_delete"];
		} else {
			$respuestas->CurrentAction = "I"; // Display record
		}
		switch ($respuestas->CurrentAction) {
			case "D": // Delete
				$respuestas->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($respuestas->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $respuestas;

		// Call Recordset Selecting event
		$respuestas->Recordset_Selecting($respuestas->CurrentFilter);

		// Load List page SQL
		$sSql = $respuestas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$respuestas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $respuestas;
		$sFilter = $respuestas->KeyFilter();

		// Call Row Selecting event
		$respuestas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$respuestas->CurrentFilter = $sFilter;
		$sSql = $respuestas->SQL();
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
		global $conn, $respuestas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$respuestas->Row_Selected($row);
		$respuestas->id_respuestas->setDbValue($rs->fields('id_respuestas'));
		$respuestas->id_pregunta->setDbValue($rs->fields('id_pregunta'));
		$respuestas->respuesta->setDbValue($rs->fields('respuesta'));
		$respuestas->contador->setDbValue($rs->fields('contador'));
		$respuestas->orden->setDbValue($rs->fields('orden'));
		$respuestas->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $respuestas;

		// Initialize URLs
		// Call Row_Rendering event

		$respuestas->Row_Rendering();

		// Common render codes for all row types
		// id_respuestas
		// id_pregunta
		// respuesta
		// contador
		// orden
		// estatus

		if ($respuestas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_pregunta
			if (strval($respuestas->id_pregunta->CurrentValue) <> "") {
				$sFilterWrk = "`id_pregunta` = " . ew_AdjustSql($respuestas->id_pregunta->CurrentValue) . "";
			$sSqlWrk = "SELECT `pregunta` FROM `preguntas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$respuestas->id_pregunta->ViewValue = $rswrk->fields('pregunta');
					$rswrk->Close();
				} else {
					$respuestas->id_pregunta->ViewValue = $respuestas->id_pregunta->CurrentValue;
				}
			} else {
				$respuestas->id_pregunta->ViewValue = NULL;
			}
			$respuestas->id_pregunta->ViewCustomAttributes = "";

			// respuesta
			$respuestas->respuesta->ViewValue = $respuestas->respuesta->CurrentValue;
			$respuestas->respuesta->ViewCustomAttributes = "";

			// contador
			$respuestas->contador->ViewValue = $respuestas->contador->CurrentValue;
			$respuestas->contador->ViewCustomAttributes = "";

			// orden
			$respuestas->orden->ViewValue = $respuestas->orden->CurrentValue;
			$respuestas->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($respuestas->estatus->CurrentValue) <> "") {
				switch ($respuestas->estatus->CurrentValue) {
					case "1":
						$respuestas->estatus->ViewValue = $respuestas->estatus->FldTagCaption(1) <> "" ? $respuestas->estatus->FldTagCaption(1) : $respuestas->estatus->CurrentValue;
						break;
					case "0":
						$respuestas->estatus->ViewValue = $respuestas->estatus->FldTagCaption(2) <> "" ? $respuestas->estatus->FldTagCaption(2) : $respuestas->estatus->CurrentValue;
						break;
					default:
						$respuestas->estatus->ViewValue = $respuestas->estatus->CurrentValue;
				}
			} else {
				$respuestas->estatus->ViewValue = NULL;
			}
			$respuestas->estatus->ViewCustomAttributes = "";

			// id_pregunta
			$respuestas->id_pregunta->LinkCustomAttributes = "";
			$respuestas->id_pregunta->HrefValue = "";
			$respuestas->id_pregunta->TooltipValue = "";

			// respuesta
			$respuestas->respuesta->LinkCustomAttributes = "";
			$respuestas->respuesta->HrefValue = "";
			$respuestas->respuesta->TooltipValue = "";

			// contador
			$respuestas->contador->LinkCustomAttributes = "";
			$respuestas->contador->HrefValue = "";
			$respuestas->contador->TooltipValue = "";

			// orden
			$respuestas->orden->LinkCustomAttributes = "";
			$respuestas->orden->HrefValue = "";
			$respuestas->orden->TooltipValue = "";

			// estatus
			$respuestas->estatus->LinkCustomAttributes = "";
			$respuestas->estatus->HrefValue = "";
			$respuestas->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($respuestas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$respuestas->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $respuestas;
		$DeleteRows = TRUE;
		$sSql = $respuestas->SQL();
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
				$DeleteRows = $respuestas->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_respuestas'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($respuestas->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($respuestas->CancelMessage <> "") {
				$this->setFailureMessage($respuestas->CancelMessage);
				$respuestas->CancelMessage = "";
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
				$respuestas->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'respuestas';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $respuestas;
		$table = 'respuestas';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_respuestas'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $respuestas->fields) && $respuestas->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
