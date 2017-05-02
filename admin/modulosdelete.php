<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modulosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$modulos_delete = new cmodulos_delete();
$Page =& $modulos_delete;

// Page init
$modulos_delete->Page_Init();

// Page main
$modulos_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var modulos_delete = new ew_Page("modulos_delete");

// page properties
modulos_delete.PageID = "delete"; // page ID
modulos_delete.FormID = "fmodulosdelete"; // form ID
var EW_PAGE_ID = modulos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
modulos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
modulos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
modulos_delete.ValidateRequired = false; // no JavaScript validation
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
if ($modulos_delete->Recordset = $modulos_delete->LoadRecordset())
	$modulos_deleteTotalRecs = $modulos_delete->Recordset->RecordCount(); // Get record count
if ($modulos_deleteTotalRecs <= 0) { // No record found, exit
	if ($modulos_delete->Recordset)
		$modulos_delete->Recordset->Close();
	$modulos_delete->Page_Terminate("moduloslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $modulos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $modulos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $modulos_delete->ShowPageHeader(); ?>
<?php
$modulos_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="modulos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($modulos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $modulos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $modulos->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $modulos->plantilla->FldCaption() ?></td>
		<td valign="top"><?php echo $modulos->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$modulos_delete->RecCnt = 0;
$i = 0;
while (!$modulos_delete->Recordset->EOF) {
	$modulos_delete->RecCnt++;

	// Set row properties
	$modulos->ResetAttrs();
	$modulos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$modulos_delete->LoadRowValues($modulos_delete->Recordset);

	// Render row
	$modulos_delete->RenderRow();
?>
	<tr<?php echo $modulos->RowAttributes() ?>>
		<td<?php echo $modulos->nombre->CellAttributes() ?>>
<div<?php echo $modulos->nombre->ViewAttributes() ?>><?php echo $modulos->nombre->ListViewValue() ?></div></td>
		<td<?php echo $modulos->plantilla->CellAttributes() ?>>
<?php if ($modulos->plantilla->LinkAttributes() <> "") { ?>
<?php if (!empty($modulos->plantilla->Upload->DbValue)) { ?>
<a<?php echo $modulos->plantilla->LinkAttributes() ?>><?php echo $modulos->plantilla->ListViewValue() ?></a>
<?php } elseif (!in_array($modulos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($modulos->plantilla->Upload->DbValue)) { ?>
<?php echo $modulos->plantilla->ListViewValue() ?>
<?php } elseif (!in_array($modulos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $modulos->estatus->CellAttributes() ?>>
<div<?php echo $modulos->estatus->ViewAttributes() ?>><?php echo $modulos->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$modulos_delete->Recordset->MoveNext();
}
$modulos_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$modulos_delete->ShowPageFooter();
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
$modulos_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodulos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'modulos';

	// Page object name
	var $PageObjName = 'modulos_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $modulos;
		if ($modulos->UseTokenInUrl) $PageUrl .= "t=" . $modulos->TableVar . "&"; // Add page token
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
		global $objForm, $modulos;
		if ($modulos->UseTokenInUrl) {
			if ($objForm)
				return ($modulos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($modulos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodulos_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (modulos)
		if (!isset($GLOBALS["modulos"])) {
			$GLOBALS["modulos"] = new cmodulos();
			$GLOBALS["Table"] =& $GLOBALS["modulos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'modulos', TRUE);

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
		global $modulos;

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
			$this->Page_Terminate("moduloslist.php");
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
		global $Language, $modulos;

		// Load key parameters
		$this->RecKeys = $modulos->GetRecordKeys(); // Load record keys
		$sFilter = $modulos->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("moduloslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in modulos class, modulosinfo.php

		$modulos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$modulos->CurrentAction = $_POST["a_delete"];
		} else {
			$modulos->CurrentAction = "I"; // Display record
		}
		switch ($modulos->CurrentAction) {
			case "D": // Delete
				$modulos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($modulos->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $modulos;

		// Call Recordset Selecting event
		$modulos->Recordset_Selecting($modulos->CurrentFilter);

		// Load List page SQL
		$sSql = $modulos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$modulos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $modulos;
		$sFilter = $modulos->KeyFilter();

		// Call Row Selecting event
		$modulos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$modulos->CurrentFilter = $sFilter;
		$sSql = $modulos->SQL();
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
		global $conn, $modulos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$modulos->Row_Selected($row);
		$modulos->id_modulo_financiero->setDbValue($rs->fields('id_modulo_financiero'));
		$modulos->nombre->setDbValue($rs->fields('nombre'));
		$modulos->plantilla->Upload->DbValue = $rs->fields('plantilla');
		$modulos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $modulos;

		// Initialize URLs
		// Call Row_Rendering event

		$modulos->Row_Rendering();

		// Common render codes for all row types
		// id_modulo_financiero
		// nombre
		// plantilla
		// estatus

		if ($modulos->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$modulos->nombre->ViewValue = $modulos->nombre->CurrentValue;
			$modulos->nombre->ViewCustomAttributes = "";

			// plantilla
			if (!ew_Empty($modulos->plantilla->Upload->DbValue)) {
				$modulos->plantilla->ViewValue = $modulos->plantilla->Upload->DbValue;
			} else {
				$modulos->plantilla->ViewValue = "";
			}
			$modulos->plantilla->ViewCustomAttributes = "";

			// estatus
			if (strval($modulos->estatus->CurrentValue) <> "") {
				switch ($modulos->estatus->CurrentValue) {
					case "1":
						$modulos->estatus->ViewValue = $modulos->estatus->FldTagCaption(1) <> "" ? $modulos->estatus->FldTagCaption(1) : $modulos->estatus->CurrentValue;
						break;
					case "0":
						$modulos->estatus->ViewValue = $modulos->estatus->FldTagCaption(2) <> "" ? $modulos->estatus->FldTagCaption(2) : $modulos->estatus->CurrentValue;
						break;
					default:
						$modulos->estatus->ViewValue = $modulos->estatus->CurrentValue;
				}
			} else {
				$modulos->estatus->ViewValue = NULL;
			}
			$modulos->estatus->ViewCustomAttributes = "";

			// nombre
			$modulos->nombre->LinkCustomAttributes = "";
			$modulos->nombre->HrefValue = "";
			$modulos->nombre->TooltipValue = "";

			// plantilla
			$modulos->plantilla->LinkCustomAttributes = "";
			if (!ew_Empty($modulos->plantilla->Upload->DbValue)) {
				$modulos->plantilla->HrefValue = ew_UploadPathEx(FALSE, $modulos->plantilla->UploadPath) . ((!empty($modulos->plantilla->ViewValue)) ? $modulos->plantilla->ViewValue : $modulos->plantilla->CurrentValue); // Add prefix/suffix
				$modulos->plantilla->LinkAttrs["target"] = ""; // Add target
				if ($modulos->Export <> "") $modulos->plantilla->HrefValue = ew_ConvertFullUrl($modulos->plantilla->HrefValue);
			} else {
				$modulos->plantilla->HrefValue = "";
			}
			$modulos->plantilla->TooltipValue = "";

			// estatus
			$modulos->estatus->LinkCustomAttributes = "";
			$modulos->estatus->HrefValue = "";
			$modulos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($modulos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$modulos->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $modulos;
		$DeleteRows = TRUE;
		$sSql = $modulos->SQL();
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

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $modulos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_modulo_financiero'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($modulos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($modulos->CancelMessage <> "") {
				$this->setFailureMessage($modulos->CancelMessage);
				$modulos->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$modulos->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
