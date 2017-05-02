<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "noticiasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$noticias_delete = new cnoticias_delete();
$Page =& $noticias_delete;

// Page init
$noticias_delete->Page_Init();

// Page main
$noticias_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var noticias_delete = new ew_Page("noticias_delete");

// page properties
noticias_delete.PageID = "delete"; // page ID
noticias_delete.FormID = "fnoticiasdelete"; // form ID
var EW_PAGE_ID = noticias_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
noticias_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
noticias_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
noticias_delete.ValidateRequired = false; // no JavaScript validation
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
if ($noticias_delete->Recordset = $noticias_delete->LoadRecordset())
	$noticias_deleteTotalRecs = $noticias_delete->Recordset->RecordCount(); // Get record count
if ($noticias_deleteTotalRecs <= 0) { // No record found, exit
	if ($noticias_delete->Recordset)
		$noticias_delete->Recordset->Close();
	$noticias_delete->Page_Terminate("noticiaslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $noticias->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $noticias->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $noticias_delete->ShowPageHeader(); ?>
<?php
$noticias_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="noticias">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($noticias_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $noticias->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $noticias->tipo->FldCaption() ?></td>
		<td valign="top"><?php echo $noticias->titulo->FldCaption() ?></td>
		<td valign="top"><?php echo $noticias->id_grupo->FldCaption() ?></td>
		<td valign="top"><?php echo $noticias->fecha->FldCaption() ?></td>
		<td valign="top"><?php echo $noticias->orden->FldCaption() ?></td>
		<td valign="top"><?php echo $noticias->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$noticias_delete->RecCnt = 0;
$i = 0;
while (!$noticias_delete->Recordset->EOF) {
	$noticias_delete->RecCnt++;

	// Set row properties
	$noticias->ResetAttrs();
	$noticias->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$noticias_delete->LoadRowValues($noticias_delete->Recordset);

	// Render row
	$noticias_delete->RenderRow();
?>
	<tr<?php echo $noticias->RowAttributes() ?>>
		<td<?php echo $noticias->tipo->CellAttributes() ?>>
<div<?php echo $noticias->tipo->ViewAttributes() ?>><?php echo $noticias->tipo->ListViewValue() ?></div></td>
		<td<?php echo $noticias->titulo->CellAttributes() ?>>
<div<?php echo $noticias->titulo->ViewAttributes() ?>><?php echo $noticias->titulo->ListViewValue() ?></div></td>
		<td<?php echo $noticias->id_grupo->CellAttributes() ?>>
<div<?php echo $noticias->id_grupo->ViewAttributes() ?>><?php echo $noticias->id_grupo->ListViewValue() ?></div></td>
		<td<?php echo $noticias->fecha->CellAttributes() ?>>
<div<?php echo $noticias->fecha->ViewAttributes() ?>><?php echo $noticias->fecha->ListViewValue() ?></div></td>
		<td<?php echo $noticias->orden->CellAttributes() ?>>
<div<?php echo $noticias->orden->ViewAttributes() ?>><?php echo $noticias->orden->ListViewValue() ?></div></td>
		<td<?php echo $noticias->estatus->CellAttributes() ?>>
<div<?php echo $noticias->estatus->ViewAttributes() ?>><?php echo $noticias->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$noticias_delete->Recordset->MoveNext();
}
$noticias_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$noticias_delete->ShowPageFooter();
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
$noticias_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cnoticias_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'noticias';

	// Page object name
	var $PageObjName = 'noticias_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $noticias;
		if ($noticias->UseTokenInUrl) $PageUrl .= "t=" . $noticias->TableVar . "&"; // Add page token
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
		global $objForm, $noticias;
		if ($noticias->UseTokenInUrl) {
			if ($objForm)
				return ($noticias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($noticias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cnoticias_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (noticias)
		if (!isset($GLOBALS["noticias"])) {
			$GLOBALS["noticias"] = new cnoticias();
			$GLOBALS["Table"] =& $GLOBALS["noticias"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'noticias', TRUE);

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
		global $noticias;

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
			$this->Page_Terminate("noticiaslist.php");
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
		global $Language, $noticias;

		// Load key parameters
		$this->RecKeys = $noticias->GetRecordKeys(); // Load record keys
		$sFilter = $noticias->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("noticiaslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in noticias class, noticiasinfo.php

		$noticias->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$noticias->CurrentAction = $_POST["a_delete"];
		} else {
			$noticias->CurrentAction = "I"; // Display record
		}
		switch ($noticias->CurrentAction) {
			case "D": // Delete
				$noticias->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($noticias->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $noticias;

		// Call Recordset Selecting event
		$noticias->Recordset_Selecting($noticias->CurrentFilter);

		// Load List page SQL
		$sSql = $noticias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$noticias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $noticias;
		$sFilter = $noticias->KeyFilter();

		// Call Row Selecting event
		$noticias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$noticias->CurrentFilter = $sFilter;
		$sSql = $noticias->SQL();
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
		global $conn, $noticias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$noticias->Row_Selected($row);
		$noticias->id_noticia->setDbValue($rs->fields('id_noticia'));
		$noticias->tipo->setDbValue($rs->fields('tipo'));
		$noticias->titulo->setDbValue($rs->fields('titulo'));
		$noticias->antetitulo->setDbValue($rs->fields('antetitulo'));
		$noticias->sumario->setDbValue($rs->fields('sumario'));
		$noticias->contenido->setDbValue($rs->fields('contenido'));
		$noticias->id_grupo->setDbValue($rs->fields('id_grupo'));
		$noticias->imagen->Upload->DbValue = $rs->fields('imagen');
		$noticias->fecha->setDbValue($rs->fields('fecha'));
		$noticias->orden->setDbValue($rs->fields('orden'));
		$noticias->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $noticias;

		// Initialize URLs
		// Call Row_Rendering event

		$noticias->Row_Rendering();

		// Common render codes for all row types
		// id_noticia

		$noticias->id_noticia->CellCssStyle = "white-space: nowrap;";

		// tipo
		// titulo
		// antetitulo
		// sumario
		// contenido
		// id_grupo
		// imagen
		// fecha
		// orden
		// estatus

		if ($noticias->RowType == EW_ROWTYPE_VIEW) { // View row

			// tipo
			if (strval($noticias->tipo->CurrentValue) <> "") {
				switch ($noticias->tipo->CurrentValue) {
					case "1":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(1) <> "" ? $noticias->tipo->FldTagCaption(1) : $noticias->tipo->CurrentValue;
						break;
					case "2":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(2) <> "" ? $noticias->tipo->FldTagCaption(2) : $noticias->tipo->CurrentValue;
						break;
					default:
						$noticias->tipo->ViewValue = $noticias->tipo->CurrentValue;
				}
			} else {
				$noticias->tipo->ViewValue = NULL;
			}
			$noticias->tipo->ViewCustomAttributes = "";

			// titulo
			$noticias->titulo->ViewValue = $noticias->titulo->CurrentValue;
			$noticias->titulo->ViewCustomAttributes = "";

			// antetitulo
			$noticias->antetitulo->ViewValue = $noticias->antetitulo->CurrentValue;
			$noticias->antetitulo->ViewCustomAttributes = "";

			// id_grupo
			if (strval($noticias->id_grupo->CurrentValue) <> "") {
				$arwrk = explode(",", $noticias->id_grupo->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_grupo` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is null";
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
					$noticias->id_grupo->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$noticias->id_grupo->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $noticias->id_grupo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$noticias->id_grupo->ViewValue = $noticias->id_grupo->CurrentValue;
				}
			} else {
				$noticias->id_grupo->ViewValue = NULL;
			}
			$noticias->id_grupo->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($noticias->imagen->Upload->DbValue)) {
				$noticias->imagen->ViewValue = $noticias->imagen->Upload->DbValue;
				$noticias->imagen->ImageWidth = 150;
				$noticias->imagen->ImageHeight = 30;
				$noticias->imagen->ImageAlt = $noticias->imagen->FldAlt();
			} else {
				$noticias->imagen->ViewValue = "";
			}
			$noticias->imagen->ViewCustomAttributes = "";

			// fecha
			$noticias->fecha->ViewValue = $noticias->fecha->CurrentValue;
			$noticias->fecha->ViewValue = ew_FormatDateTime($noticias->fecha->ViewValue, 7);
			$noticias->fecha->ViewCustomAttributes = "";

			// orden
			$noticias->orden->ViewValue = $noticias->orden->CurrentValue;
			$noticias->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($noticias->estatus->CurrentValue) <> "") {
				switch ($noticias->estatus->CurrentValue) {
					case "1":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(1) <> "" ? $noticias->estatus->FldTagCaption(1) : $noticias->estatus->CurrentValue;
						break;
					case "0":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(2) <> "" ? $noticias->estatus->FldTagCaption(2) : $noticias->estatus->CurrentValue;
						break;
					default:
						$noticias->estatus->ViewValue = $noticias->estatus->CurrentValue;
				}
			} else {
				$noticias->estatus->ViewValue = NULL;
			}
			$noticias->estatus->ViewCustomAttributes = "";

			// tipo
			$noticias->tipo->LinkCustomAttributes = "";
			$noticias->tipo->HrefValue = "";
			$noticias->tipo->TooltipValue = "";

			// titulo
			$noticias->titulo->LinkCustomAttributes = "";
			$noticias->titulo->HrefValue = "";
			$noticias->titulo->TooltipValue = "";

			// id_grupo
			$noticias->id_grupo->LinkCustomAttributes = "";
			$noticias->id_grupo->HrefValue = "";
			$noticias->id_grupo->TooltipValue = "";

			// fecha
			$noticias->fecha->LinkCustomAttributes = "";
			$noticias->fecha->HrefValue = "";
			$noticias->fecha->TooltipValue = "";

			// orden
			$noticias->orden->LinkCustomAttributes = "";
			$noticias->orden->HrefValue = "";
			$noticias->orden->TooltipValue = "";

			// estatus
			$noticias->estatus->LinkCustomAttributes = "";
			$noticias->estatus->HrefValue = "";
			$noticias->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($noticias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$noticias->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $noticias;
		$DeleteRows = TRUE;
		$sSql = $noticias->SQL();
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
				$DeleteRows = $noticias->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_noticia'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($noticias->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($noticias->CancelMessage <> "") {
				$this->setFailureMessage($noticias->CancelMessage);
				$noticias->CancelMessage = "";
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
				$noticias->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'noticias';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $noticias;
		$table = 'noticias';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_noticia'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $noticias->fields) && $noticias->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($noticias->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($noticias->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
