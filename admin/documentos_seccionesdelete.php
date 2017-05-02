<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documentos_seccionesinfo.php" ?>
<?php include_once "documentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documentos_secciones_delete = new cdocumentos_secciones_delete();
$Page =& $documentos_secciones_delete;

// Page init
$documentos_secciones_delete->Page_Init();

// Page main
$documentos_secciones_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_secciones_delete = new ew_Page("documentos_secciones_delete");

// page properties
documentos_secciones_delete.PageID = "delete"; // page ID
documentos_secciones_delete.FormID = "fdocumentos_seccionesdelete"; // form ID
var EW_PAGE_ID = documentos_secciones_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
documentos_secciones_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_secciones_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_secciones_delete.ValidateRequired = false; // no JavaScript validation
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
if ($documentos_secciones_delete->Recordset = $documentos_secciones_delete->LoadRecordset())
	$documentos_secciones_deleteTotalRecs = $documentos_secciones_delete->Recordset->RecordCount(); // Get record count
if ($documentos_secciones_deleteTotalRecs <= 0) { // No record found, exit
	if ($documentos_secciones_delete->Recordset)
		$documentos_secciones_delete->Recordset->Close();
	$documentos_secciones_delete->Page_Terminate("documentos_seccioneslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos_secciones->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $documentos_secciones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $documentos_secciones_delete->ShowPageHeader(); ?>
<?php
$documentos_secciones_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="documentos_secciones">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($documentos_secciones_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $documentos_secciones->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $documentos_secciones->id_documentos->FldCaption() ?></td>
		<td valign="top"><?php echo $documentos_secciones->id_grupo_sec->FldCaption() ?></td>
		<td valign="top"><?php echo $documentos_secciones->fecha_inicio->FldCaption() ?></td>
		<td valign="top"><?php echo $documentos_secciones->fecha_fin->FldCaption() ?></td>
		<td valign="top"><?php echo $documentos_secciones->fecha->FldCaption() ?></td>
		<td valign="top"><?php echo $documentos_secciones->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$documentos_secciones_delete->RecCnt = 0;
$i = 0;
while (!$documentos_secciones_delete->Recordset->EOF) {
	$documentos_secciones_delete->RecCnt++;

	// Set row properties
	$documentos_secciones->ResetAttrs();
	$documentos_secciones->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$documentos_secciones_delete->LoadRowValues($documentos_secciones_delete->Recordset);

	// Render row
	$documentos_secciones_delete->RenderRow();
?>
	<tr<?php echo $documentos_secciones->RowAttributes() ?>>
		<td<?php echo $documentos_secciones->id_documentos->CellAttributes() ?>>
<div<?php echo $documentos_secciones->id_documentos->ViewAttributes() ?>><?php echo $documentos_secciones->id_documentos->ListViewValue() ?></div></td>
		<td<?php echo $documentos_secciones->id_grupo_sec->CellAttributes() ?>>
<div<?php echo $documentos_secciones->id_grupo_sec->ViewAttributes() ?>><?php echo $documentos_secciones->id_grupo_sec->ListViewValue() ?></div></td>
		<td<?php echo $documentos_secciones->fecha_inicio->CellAttributes() ?>>
<div<?php echo $documentos_secciones->fecha_inicio->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_inicio->ListViewValue() ?></div></td>
		<td<?php echo $documentos_secciones->fecha_fin->CellAttributes() ?>>
<div<?php echo $documentos_secciones->fecha_fin->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_fin->ListViewValue() ?></div></td>
		<td<?php echo $documentos_secciones->fecha->CellAttributes() ?>>
<div<?php echo $documentos_secciones->fecha->ViewAttributes() ?>><?php echo $documentos_secciones->fecha->ListViewValue() ?></div></td>
		<td<?php echo $documentos_secciones->estatus->CellAttributes() ?>>
<div<?php echo $documentos_secciones->estatus->ViewAttributes() ?>><?php echo $documentos_secciones->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$documentos_secciones_delete->Recordset->MoveNext();
}
$documentos_secciones_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$documentos_secciones_delete->ShowPageFooter();
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
$documentos_secciones_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumentos_secciones_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'documentos_secciones';

	// Page object name
	var $PageObjName = 'documentos_secciones_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) $PageUrl .= "t=" . $documentos_secciones->TableVar . "&"; // Add page token
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
		global $objForm, $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) {
			if ($objForm)
				return ($documentos_secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documentos_secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumentos_secciones_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documentos_secciones)
		if (!isset($GLOBALS["documentos_secciones"])) {
			$GLOBALS["documentos_secciones"] = new cdocumentos_secciones();
			$GLOBALS["Table"] =& $GLOBALS["documentos_secciones"];
		}

		// Table object (documentos)
		if (!isset($GLOBALS['documentos'])) $GLOBALS['documentos'] = new cdocumentos();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documentos_secciones', TRUE);

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
		global $documentos_secciones;

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
			$this->Page_Terminate("documentos_seccioneslist.php");
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
		global $Language, $documentos_secciones;

		// Load key parameters
		$this->RecKeys = $documentos_secciones->GetRecordKeys(); // Load record keys
		$sFilter = $documentos_secciones->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("documentos_seccioneslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in documentos_secciones class, documentos_seccionesinfo.php

		$documentos_secciones->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$documentos_secciones->CurrentAction = $_POST["a_delete"];
		} else {
			$documentos_secciones->CurrentAction = "I"; // Display record
		}
		switch ($documentos_secciones->CurrentAction) {
			case "D": // Delete
				$documentos_secciones->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($documentos_secciones->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $documentos_secciones;

		// Call Recordset Selecting event
		$documentos_secciones->Recordset_Selecting($documentos_secciones->CurrentFilter);

		// Load List page SQL
		$sSql = $documentos_secciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$documentos_secciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documentos_secciones;
		$sFilter = $documentos_secciones->KeyFilter();

		// Call Row Selecting event
		$documentos_secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documentos_secciones->CurrentFilter = $sFilter;
		$sSql = $documentos_secciones->SQL();
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
		global $conn, $documentos_secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documentos_secciones->Row_Selected($row);
		$documentos_secciones->id_documentos_secciones->setDbValue($rs->fields('id_documentos_secciones'));
		$documentos_secciones->id_documentos->setDbValue($rs->fields('id_documentos'));
		$documentos_secciones->id_grupo_sec->setDbValue($rs->fields('id_grupo_sec'));
		$documentos_secciones->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$documentos_secciones->fecha_fin->setDbValue($rs->fields('fecha_fin'));
		$documentos_secciones->fecha->setDbValue($rs->fields('fecha'));
		$documentos_secciones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documentos_secciones;

		// Initialize URLs
		// Call Row_Rendering event

		$documentos_secciones->Row_Rendering();

		// Common render codes for all row types
		// id_documentos_secciones
		// id_documentos
		// id_grupo_sec
		// fecha_inicio
		// fecha_fin
		// fecha
		// estatus

		if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_documentos
			if (strval($documentos_secciones->id_documentos->CurrentValue) <> "") {
				$sFilterWrk = "`id_documentos` = " . ew_AdjustSql($documentos_secciones->id_documentos->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `documentos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_documentos->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_documentos->ViewValue = $documentos_secciones->id_documentos->CurrentValue;
				}
			} else {
				$documentos_secciones->id_documentos->ViewValue = NULL;
			}
			$documentos_secciones->id_documentos->ViewCustomAttributes = "";

			// id_grupo_sec
			if (strval($documentos_secciones->id_grupo_sec->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($documentos_secciones->id_grupo_sec->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view1`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_grupo_sec->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_grupo_sec->ViewValue = $documentos_secciones->id_grupo_sec->CurrentValue;
				}
			} else {
				$documentos_secciones->id_grupo_sec->ViewValue = NULL;
			}
			$documentos_secciones->id_grupo_sec->ViewCustomAttributes = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->ViewValue = $documentos_secciones->fecha_inicio->CurrentValue;
			$documentos_secciones->fecha_inicio->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_inicio->ViewValue, 7);
			$documentos_secciones->fecha_inicio->ViewCustomAttributes = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->ViewValue = $documentos_secciones->fecha_fin->CurrentValue;
			$documentos_secciones->fecha_fin->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_fin->ViewValue, 7);
			$documentos_secciones->fecha_fin->ViewCustomAttributes = "";

			// fecha
			$documentos_secciones->fecha->ViewValue = $documentos_secciones->fecha->CurrentValue;
			$documentos_secciones->fecha->ViewValue = ew_FormatDateTime($documentos_secciones->fecha->ViewValue, 7);
			$documentos_secciones->fecha->ViewCustomAttributes = "";

			// estatus
			if (strval($documentos_secciones->estatus->CurrentValue) <> "") {
				switch ($documentos_secciones->estatus->CurrentValue) {
					case "1":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(1) <> "" ? $documentos_secciones->estatus->FldTagCaption(1) : $documentos_secciones->estatus->CurrentValue;
						break;
					case "0":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(2) <> "" ? $documentos_secciones->estatus->FldTagCaption(2) : $documentos_secciones->estatus->CurrentValue;
						break;
					default:
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->CurrentValue;
				}
			} else {
				$documentos_secciones->estatus->ViewValue = NULL;
			}
			$documentos_secciones->estatus->ViewCustomAttributes = "";

			// id_documentos
			$documentos_secciones->id_documentos->LinkCustomAttributes = "";
			$documentos_secciones->id_documentos->HrefValue = "";
			$documentos_secciones->id_documentos->TooltipValue = "";

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->LinkCustomAttributes = "";
			$documentos_secciones->id_grupo_sec->HrefValue = "";
			$documentos_secciones->id_grupo_sec->TooltipValue = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->LinkCustomAttributes = "";
			$documentos_secciones->fecha_inicio->HrefValue = "";
			$documentos_secciones->fecha_inicio->TooltipValue = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->LinkCustomAttributes = "";
			$documentos_secciones->fecha_fin->HrefValue = "";
			$documentos_secciones->fecha_fin->TooltipValue = "";

			// fecha
			$documentos_secciones->fecha->LinkCustomAttributes = "";
			$documentos_secciones->fecha->HrefValue = "";
			$documentos_secciones->fecha->TooltipValue = "";

			// estatus
			$documentos_secciones->estatus->LinkCustomAttributes = "";
			$documentos_secciones->estatus->HrefValue = "";
			$documentos_secciones->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($documentos_secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documentos_secciones->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $documentos_secciones;
		$DeleteRows = TRUE;
		$sSql = $documentos_secciones->SQL();
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
				$DeleteRows = $documentos_secciones->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_documentos_secciones'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($documentos_secciones->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($documentos_secciones->CancelMessage <> "") {
				$this->setFailureMessage($documentos_secciones->CancelMessage);
				$documentos_secciones->CancelMessage = "";
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
				$documentos_secciones->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'documentos_secciones';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $documentos_secciones;
		$table = 'documentos_secciones';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_documentos_secciones'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $documentos_secciones->fields) && $documentos_secciones->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
