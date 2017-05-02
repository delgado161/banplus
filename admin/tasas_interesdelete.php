<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tasas_interesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tasas_interes_delete = new ctasas_interes_delete();
$Page =& $tasas_interes_delete;

// Page init
$tasas_interes_delete->Page_Init();

// Page main
$tasas_interes_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tasas_interes_delete = new ew_Page("tasas_interes_delete");

// page properties
tasas_interes_delete.PageID = "delete"; // page ID
tasas_interes_delete.FormID = "ftasas_interesdelete"; // form ID
var EW_PAGE_ID = tasas_interes_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tasas_interes_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tasas_interes_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tasas_interes_delete.ValidateRequired = false; // no JavaScript validation
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
if ($tasas_interes_delete->Recordset = $tasas_interes_delete->LoadRecordset())
	$tasas_interes_deleteTotalRecs = $tasas_interes_delete->Recordset->RecordCount(); // Get record count
if ($tasas_interes_deleteTotalRecs <= 0) { // No record found, exit
	if ($tasas_interes_delete->Recordset)
		$tasas_interes_delete->Recordset->Close();
	$tasas_interes_delete->Page_Terminate("tasas_intereslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tasas_interes->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tasas_interes->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tasas_interes_delete->ShowPageHeader(); ?>
<?php
$tasas_interes_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tasas_interes">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tasas_interes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tasas_interes->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tasas_interes->inicio->FldCaption() ?></td>
		<td valign="top"><?php echo $tasas_interes->fin->FldCaption() ?></td>
		<td valign="top"><?php echo $tasas_interes->tasa->FldCaption() ?></td>
		<td valign="top"><?php echo $tasas_interes->tipo->FldCaption() ?></td>
		<td valign="top"><?php echo $tasas_interes->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tasas_interes_delete->RecCnt = 0;
$i = 0;
while (!$tasas_interes_delete->Recordset->EOF) {
	$tasas_interes_delete->RecCnt++;

	// Set row properties
	$tasas_interes->ResetAttrs();
	$tasas_interes->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tasas_interes_delete->LoadRowValues($tasas_interes_delete->Recordset);

	// Render row
	$tasas_interes_delete->RenderRow();
?>
	<tr<?php echo $tasas_interes->RowAttributes() ?>>
		<td<?php echo $tasas_interes->inicio->CellAttributes() ?>>
<div<?php echo $tasas_interes->inicio->ViewAttributes() ?>><?php echo $tasas_interes->inicio->ListViewValue() ?></div></td>
		<td<?php echo $tasas_interes->fin->CellAttributes() ?>>
<div<?php echo $tasas_interes->fin->ViewAttributes() ?>><?php echo $tasas_interes->fin->ListViewValue() ?></div></td>
		<td<?php echo $tasas_interes->tasa->CellAttributes() ?>>
<div<?php echo $tasas_interes->tasa->ViewAttributes() ?>><?php echo $tasas_interes->tasa->ListViewValue() ?></div></td>
		<td<?php echo $tasas_interes->tipo->CellAttributes() ?>>
<div<?php echo $tasas_interes->tipo->ViewAttributes() ?>><?php echo $tasas_interes->tipo->ListViewValue() ?></div></td>
		<td<?php echo $tasas_interes->estatus->CellAttributes() ?>>
<div<?php echo $tasas_interes->estatus->ViewAttributes() ?>><?php echo $tasas_interes->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$tasas_interes_delete->Recordset->MoveNext();
}
$tasas_interes_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$tasas_interes_delete->ShowPageFooter();
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
$tasas_interes_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctasas_interes_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tasas_interes';

	// Page object name
	var $PageObjName = 'tasas_interes_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tasas_interes;
		if ($tasas_interes->UseTokenInUrl) $PageUrl .= "t=" . $tasas_interes->TableVar . "&"; // Add page token
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
		global $objForm, $tasas_interes;
		if ($tasas_interes->UseTokenInUrl) {
			if ($objForm)
				return ($tasas_interes->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tasas_interes->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctasas_interes_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tasas_interes)
		if (!isset($GLOBALS["tasas_interes"])) {
			$GLOBALS["tasas_interes"] = new ctasas_interes();
			$GLOBALS["Table"] =& $GLOBALS["tasas_interes"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tasas_interes', TRUE);

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
		global $tasas_interes;

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
			$this->Page_Terminate("tasas_intereslist.php");
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
		global $Language, $tasas_interes;

		// Load key parameters
		$this->RecKeys = $tasas_interes->GetRecordKeys(); // Load record keys
		$sFilter = $tasas_interes->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("tasas_intereslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tasas_interes class, tasas_interesinfo.php

		$tasas_interes->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tasas_interes->CurrentAction = $_POST["a_delete"];
		} else {
			$tasas_interes->CurrentAction = "I"; // Display record
		}
		switch ($tasas_interes->CurrentAction) {
			case "D": // Delete
				$tasas_interes->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tasas_interes->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tasas_interes;

		// Call Recordset Selecting event
		$tasas_interes->Recordset_Selecting($tasas_interes->CurrentFilter);

		// Load List page SQL
		$sSql = $tasas_interes->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tasas_interes->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tasas_interes;
		$sFilter = $tasas_interes->KeyFilter();

		// Call Row Selecting event
		$tasas_interes->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tasas_interes->CurrentFilter = $sFilter;
		$sSql = $tasas_interes->SQL();
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
		global $conn, $tasas_interes;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tasas_interes->Row_Selected($row);
		$tasas_interes->id_tasas_interes->setDbValue($rs->fields('id_tasas_interes'));
		$tasas_interes->inicio->setDbValue($rs->fields('inicio'));
		$tasas_interes->fin->setDbValue($rs->fields('fin'));
		$tasas_interes->tasa->setDbValue($rs->fields('tasa'));
		$tasas_interes->tipo->setDbValue($rs->fields('tipo'));
		$tasas_interes->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tasas_interes;

		// Initialize URLs
		// Call Row_Rendering event

		$tasas_interes->Row_Rendering();

		// Common render codes for all row types
		// id_tasas_interes

		$tasas_interes->id_tasas_interes->CellCssStyle = "white-space: nowrap;";

		// inicio
		// fin
		// tasa
		// tipo
		// estatus

		if ($tasas_interes->RowType == EW_ROWTYPE_VIEW) { // View row

			// inicio
			$tasas_interes->inicio->ViewValue = $tasas_interes->inicio->CurrentValue;
			$tasas_interes->inicio->ViewCustomAttributes = "";

			// fin
			$tasas_interes->fin->ViewValue = $tasas_interes->fin->CurrentValue;
			$tasas_interes->fin->ViewCustomAttributes = "";

			// tasa
			$tasas_interes->tasa->ViewValue = $tasas_interes->tasa->CurrentValue;
			$tasas_interes->tasa->ViewCustomAttributes = "";

			// tipo
			if (strval($tasas_interes->tipo->CurrentValue) <> "") {
				switch ($tasas_interes->tipo->CurrentValue) {
					case "1":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(1) <> "" ? $tasas_interes->tipo->FldTagCaption(1) : $tasas_interes->tipo->CurrentValue;
						break;
					case "2":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(2) <> "" ? $tasas_interes->tipo->FldTagCaption(2) : $tasas_interes->tipo->CurrentValue;
						break;
					case "3":
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->FldTagCaption(3) <> "" ? $tasas_interes->tipo->FldTagCaption(3) : $tasas_interes->tipo->CurrentValue;
						break;
					default:
						$tasas_interes->tipo->ViewValue = $tasas_interes->tipo->CurrentValue;
				}
			} else {
				$tasas_interes->tipo->ViewValue = NULL;
			}
			$tasas_interes->tipo->ViewCustomAttributes = "";

			// estatus
			if (strval($tasas_interes->estatus->CurrentValue) <> "") {
				switch ($tasas_interes->estatus->CurrentValue) {
					case "1":
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->FldTagCaption(1) <> "" ? $tasas_interes->estatus->FldTagCaption(1) : $tasas_interes->estatus->CurrentValue;
						break;
					case "0":
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->FldTagCaption(2) <> "" ? $tasas_interes->estatus->FldTagCaption(2) : $tasas_interes->estatus->CurrentValue;
						break;
					default:
						$tasas_interes->estatus->ViewValue = $tasas_interes->estatus->CurrentValue;
				}
			} else {
				$tasas_interes->estatus->ViewValue = NULL;
			}
			$tasas_interes->estatus->ViewCustomAttributes = "";

			// inicio
			$tasas_interes->inicio->LinkCustomAttributes = "";
			$tasas_interes->inicio->HrefValue = "";
			$tasas_interes->inicio->TooltipValue = "";

			// fin
			$tasas_interes->fin->LinkCustomAttributes = "";
			$tasas_interes->fin->HrefValue = "";
			$tasas_interes->fin->TooltipValue = "";

			// tasa
			$tasas_interes->tasa->LinkCustomAttributes = "";
			$tasas_interes->tasa->HrefValue = "";
			$tasas_interes->tasa->TooltipValue = "";

			// tipo
			$tasas_interes->tipo->LinkCustomAttributes = "";
			$tasas_interes->tipo->HrefValue = "";
			$tasas_interes->tipo->TooltipValue = "";

			// estatus
			$tasas_interes->estatus->LinkCustomAttributes = "";
			$tasas_interes->estatus->HrefValue = "";
			$tasas_interes->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tasas_interes->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tasas_interes->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tasas_interes;
		$DeleteRows = TRUE;
		$sSql = $tasas_interes->SQL();
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
				$DeleteRows = $tasas_interes->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_tasas_interes'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tasas_interes->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tasas_interes->CancelMessage <> "") {
				$this->setFailureMessage($tasas_interes->CancelMessage);
				$tasas_interes->CancelMessage = "";
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
				$tasas_interes->Row_Deleted($row);
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
