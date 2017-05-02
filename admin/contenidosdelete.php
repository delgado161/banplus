<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "contenidosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$contenidos_delete = new ccontenidos_delete();
$Page =& $contenidos_delete;

// Page init
$contenidos_delete->Page_Init();

// Page main
$contenidos_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var contenidos_delete = new ew_Page("contenidos_delete");

// page properties
contenidos_delete.PageID = "delete"; // page ID
contenidos_delete.FormID = "fcontenidosdelete"; // form ID
var EW_PAGE_ID = contenidos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
contenidos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contenidos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contenidos_delete.ValidateRequired = false; // no JavaScript validation
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
if ($contenidos_delete->Recordset = $contenidos_delete->LoadRecordset())
	$contenidos_deleteTotalRecs = $contenidos_delete->Recordset->RecordCount(); // Get record count
if ($contenidos_deleteTotalRecs <= 0) { // No record found, exit
	if ($contenidos_delete->Recordset)
		$contenidos_delete->Recordset->Close();
	$contenidos_delete->Page_Terminate("contenidoslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $contenidos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $contenidos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $contenidos_delete->ShowPageHeader(); ?>
<?php
$contenidos_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="contenidos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($contenidos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $contenidos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $contenidos->titulo->FldCaption() ?></td>
		<td valign="top"><?php echo $contenidos->edicion->FldCaption() ?></td>
		<td valign="top"><?php echo $contenidos->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$contenidos_delete->RecCnt = 0;
$i = 0;
while (!$contenidos_delete->Recordset->EOF) {
	$contenidos_delete->RecCnt++;

	// Set row properties
	$contenidos->ResetAttrs();
	$contenidos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$contenidos_delete->LoadRowValues($contenidos_delete->Recordset);

	// Render row
	$contenidos_delete->RenderRow();
?>
	<tr<?php echo $contenidos->RowAttributes() ?>>
		<td<?php echo $contenidos->titulo->CellAttributes() ?>>
<div<?php echo $contenidos->titulo->ViewAttributes() ?>><?php echo $contenidos->titulo->ListViewValue() ?></div></td>
		<td<?php echo $contenidos->edicion->CellAttributes() ?>>
<div<?php echo $contenidos->edicion->ViewAttributes() ?>><?php echo $contenidos->edicion->ListViewValue() ?></div></td>
		<td<?php echo $contenidos->estatus->CellAttributes() ?>>
<div<?php echo $contenidos->estatus->ViewAttributes() ?>><?php echo $contenidos->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$contenidos_delete->Recordset->MoveNext();
}
$contenidos_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$contenidos_delete->ShowPageFooter();
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
$contenidos_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccontenidos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'contenidos';

	// Page object name
	var $PageObjName = 'contenidos_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $contenidos;
		if ($contenidos->UseTokenInUrl) $PageUrl .= "t=" . $contenidos->TableVar . "&"; // Add page token
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
			$pos = strpos($sErrorMessage, "cancelado");
			if ($pos == true) 
				echo "<p class=\"ewErrorMessage\">No se puede borrar por tener registros asociados</p>";
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
		global $objForm, $contenidos;
		if ($contenidos->UseTokenInUrl) {
			if ($objForm)
				return ($contenidos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($contenidos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccontenidos_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (contenidos)
		if (!isset($GLOBALS["contenidos"])) {
			$GLOBALS["contenidos"] = new ccontenidos();
			$GLOBALS["Table"] =& $GLOBALS["contenidos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'contenidos', TRUE);

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
		global $contenidos;

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
			$this->Page_Terminate("contenidoslist.php");
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
		global $Language, $contenidos;

		// Load key parameters
		$this->RecKeys = $contenidos->GetRecordKeys(); // Load record keys
		$sFilter = $contenidos->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("contenidoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in contenidos class, contenidosinfo.php

		$contenidos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$contenidos->CurrentAction = $_POST["a_delete"];
		} else {
			$contenidos->CurrentAction = "I"; // Display record
		}
		switch ($contenidos->CurrentAction) {
			case "D": // Delete
				$contenidos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($contenidos->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $contenidos;

		// Call Recordset Selecting event
		$contenidos->Recordset_Selecting($contenidos->CurrentFilter);

		// Load List page SQL
		$sSql = $contenidos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$contenidos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $contenidos;
		$sFilter = $contenidos->KeyFilter();

		// Call Row Selecting event
		$contenidos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$contenidos->CurrentFilter = $sFilter;
		$sSql = $contenidos->SQL();
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
		global $conn, $contenidos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$contenidos->Row_Selected($row);
		$contenidos->id_contenido->setDbValue($rs->fields('id_contenido'));
		$contenidos->titulo->setDbValue($rs->fields('titulo'));
		$contenidos->resumen->setDbValue($rs->fields('resumen'));
		$contenidos->contenido->setDbValue($rs->fields('contenido'));
		$contenidos->imagen->Upload->DbValue = $rs->fields('imagen');
		$contenidos->id_herramienta_financiera->setDbValue($rs->fields('id_herramienta_financiera'));
		$contenidos->edicion->setDbValue($rs->fields('edicion'));
		$contenidos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $contenidos;

		// Initialize URLs
		// Call Row_Rendering event

		$contenidos->Row_Rendering();

		// Common render codes for all row types
		// id_contenido
		// titulo
		// resumen
		// contenido
		// imagen
		// id_herramienta_financiera

		$contenidos->id_herramienta_financiera->CellCssStyle = "white-space: nowrap;";

		// edicion
		// estatus

		if ($contenidos->RowType == EW_ROWTYPE_VIEW) { // View row

			// titulo
			$contenidos->titulo->ViewValue = $contenidos->titulo->CurrentValue;
			$contenidos->titulo->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($contenidos->imagen->Upload->DbValue)) {
				$contenidos->imagen->ViewValue = $contenidos->imagen->Upload->DbValue;
				$contenidos->imagen->ImageWidth = 200;
				$contenidos->imagen->ImageHeight = 50;
				$contenidos->imagen->ImageAlt = $contenidos->imagen->FldAlt();
			} else {
				$contenidos->imagen->ViewValue = "";
			}
			$contenidos->imagen->ViewCustomAttributes = "";

			// id_herramienta_financiera
			if (strval($contenidos->id_herramienta_financiera->CurrentValue) <> "") {
				$sFilterWrk = "`id_modulo_financiero` = " . ew_AdjustSql($contenidos->id_herramienta_financiera->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `modulos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$contenidos->id_herramienta_financiera->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$contenidos->id_herramienta_financiera->ViewValue = $contenidos->id_herramienta_financiera->CurrentValue;
				}
			} else {
				$contenidos->id_herramienta_financiera->ViewValue = NULL;
			}
			$contenidos->id_herramienta_financiera->ViewCustomAttributes = "";

			// edicion
			if (strval($contenidos->edicion->CurrentValue) <> "") {
				switch ($contenidos->edicion->CurrentValue) {
					case "1":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(1) <> "" ? $contenidos->edicion->FldTagCaption(1) : $contenidos->edicion->CurrentValue;
						break;
					case "3":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(2) <> "" ? $contenidos->edicion->FldTagCaption(2) : $contenidos->edicion->CurrentValue;
						break;
					case "2":
						$contenidos->edicion->ViewValue = $contenidos->edicion->FldTagCaption(3) <> "" ? $contenidos->edicion->FldTagCaption(3) : $contenidos->edicion->CurrentValue;
						break;
					default:
						$contenidos->edicion->ViewValue = $contenidos->edicion->CurrentValue;
				}
			} else {
				$contenidos->edicion->ViewValue = NULL;
			}
			$contenidos->edicion->ViewCustomAttributes = "";

			// estatus
			if (strval($contenidos->estatus->CurrentValue) <> "") {
				switch ($contenidos->estatus->CurrentValue) {
					case "1":
						$contenidos->estatus->ViewValue = $contenidos->estatus->FldTagCaption(1) <> "" ? $contenidos->estatus->FldTagCaption(1) : $contenidos->estatus->CurrentValue;
						break;
					case "0":
						$contenidos->estatus->ViewValue = $contenidos->estatus->FldTagCaption(2) <> "" ? $contenidos->estatus->FldTagCaption(2) : $contenidos->estatus->CurrentValue;
						break;
					default:
						$contenidos->estatus->ViewValue = $contenidos->estatus->CurrentValue;
				}
			} else {
				$contenidos->estatus->ViewValue = NULL;
			}
			$contenidos->estatus->ViewCustomAttributes = "";

			// titulo
			$contenidos->titulo->LinkCustomAttributes = "";
			$contenidos->titulo->HrefValue = "";
			$contenidos->titulo->TooltipValue = "";

			// edicion
			$contenidos->edicion->LinkCustomAttributes = "";
			$contenidos->edicion->HrefValue = "";
			$contenidos->edicion->TooltipValue = "";

			// estatus
			$contenidos->estatus->LinkCustomAttributes = "";
			$contenidos->estatus->HrefValue = "";
			$contenidos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($contenidos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$contenidos->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $contenidos;
		$DeleteRows = TRUE;
		$sSql = $contenidos->SQL();
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
				$DeleteRows = $contenidos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_contenido'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($contenidos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($contenidos->CancelMessage <> "") {
				$this->setFailureMessage($contenidos->CancelMessage);
				$contenidos->CancelMessage = "";
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
				$contenidos->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'contenidos';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $contenidos;
		$table = 'contenidos';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_contenido'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $contenidos->fields) && $contenidos->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($contenidos->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($contenidos->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
