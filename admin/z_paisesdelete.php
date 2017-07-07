<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_paisesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_paises_delete = new cz_paises_delete();
$Page =& $z_paises_delete;

// Page init
$z_paises_delete->Page_Init();

// Page main
$z_paises_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_paises_delete = new ew_Page("z_paises_delete");

// page properties
z_paises_delete.PageID = "delete"; // page ID
z_paises_delete.FormID = "fz_paisesdelete"; // form ID
var EW_PAGE_ID = z_paises_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_paises_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_paises_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_paises_delete.ValidateRequired = false; // no JavaScript validation
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
if ($z_paises_delete->Recordset = $z_paises_delete->LoadRecordset())
	$z_paises_deleteTotalRecs = $z_paises_delete->Recordset->RecordCount(); // Get record count
if ($z_paises_deleteTotalRecs <= 0) { // No record found, exit
	if ($z_paises_delete->Recordset)
		$z_paises_delete->Recordset->Close();
	$z_paises_delete->Page_Terminate("z_paiseslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_paises->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_paises->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_paises_delete->ShowPageHeader(); ?>
<?php
$z_paises_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="z_paises">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($z_paises_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $z_paises->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $z_paises->lp_pais_id->FldCaption() ?></td>
		<td valign="top"><?php echo $z_paises->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $z_paises->nacionalidad->FldCaption() ?></td>
		<td valign="top"><?php echo $z_paises->visibilidad->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$z_paises_delete->RecCnt = 0;
$i = 0;
while (!$z_paises_delete->Recordset->EOF) {
	$z_paises_delete->RecCnt++;

	// Set row properties
	$z_paises->ResetAttrs();
	$z_paises->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$z_paises_delete->LoadRowValues($z_paises_delete->Recordset);

	// Render row
	$z_paises_delete->RenderRow();
?>
	<tr<?php echo $z_paises->RowAttributes() ?>>
		<td<?php echo $z_paises->lp_pais_id->CellAttributes() ?>>
<div<?php echo $z_paises->lp_pais_id->ViewAttributes() ?>><?php echo $z_paises->lp_pais_id->ListViewValue() ?></div></td>
		<td<?php echo $z_paises->nombre->CellAttributes() ?>>
<div<?php echo $z_paises->nombre->ViewAttributes() ?>><?php echo $z_paises->nombre->ListViewValue() ?></div></td>
		<td<?php echo $z_paises->nacionalidad->CellAttributes() ?>>
<div<?php echo $z_paises->nacionalidad->ViewAttributes() ?>><?php echo $z_paises->nacionalidad->ListViewValue() ?></div></td>
		<td<?php echo $z_paises->visibilidad->CellAttributes() ?>>
<div<?php echo $z_paises->visibilidad->ViewAttributes() ?>><?php echo $z_paises->visibilidad->ListViewValue() ?></div></td>
	</tr>
<?php
	$z_paises_delete->Recordset->MoveNext();
}
$z_paises_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$z_paises_delete->ShowPageFooter();
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
$z_paises_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_paises_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = '_paises';

	// Page object name
	var $PageObjName = 'z_paises_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_paises;
		if ($z_paises->UseTokenInUrl) $PageUrl .= "t=" . $z_paises->TableVar . "&"; // Add page token
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
		global $objForm, $z_paises;
		if ($z_paises->UseTokenInUrl) {
			if ($objForm)
				return ($z_paises->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_paises->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_paises_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_paises)
		if (!isset($GLOBALS["z_paises"])) {
			$GLOBALS["z_paises"] = new cz_paises();
			$GLOBALS["Table"] =& $GLOBALS["z_paises"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_paises', TRUE);

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
		global $z_paises;

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
		global $Language, $z_paises;

		// Load key parameters
		$this->RecKeys = $z_paises->GetRecordKeys(); // Load record keys
		$sFilter = $z_paises->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("z_paiseslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in z_paises class, z_paisesinfo.php

		$z_paises->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$z_paises->CurrentAction = $_POST["a_delete"];
		} else {
			$z_paises->CurrentAction = "I"; // Display record
		}
		switch ($z_paises->CurrentAction) {
			case "D": // Delete
				$z_paises->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($z_paises->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_paises;

		// Call Recordset Selecting event
		$z_paises->Recordset_Selecting($z_paises->CurrentFilter);

		// Load List page SQL
		$sSql = $z_paises->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_paises->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_paises;
		$sFilter = $z_paises->KeyFilter();

		// Call Row Selecting event
		$z_paises->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_paises->CurrentFilter = $sFilter;
		$sSql = $z_paises->SQL();
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
		global $conn, $z_paises;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_paises->Row_Selected($row);
		$z_paises->lp_pais_id->setDbValue($rs->fields('lp_pais_id'));
		$z_paises->nombre->setDbValue($rs->fields('nombre'));
		$z_paises->nacionalidad->setDbValue($rs->fields('nacionalidad'));
		$z_paises->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_paises;

		// Initialize URLs
		// Call Row_Rendering event

		$z_paises->Row_Rendering();

		// Common render codes for all row types
		// lp_pais_id
		// nombre
		// nacionalidad
		// visibilidad

		if ($z_paises->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_pais_id
			$z_paises->lp_pais_id->ViewValue = $z_paises->lp_pais_id->CurrentValue;
			$z_paises->lp_pais_id->ViewCustomAttributes = "";

			// nombre
			$z_paises->nombre->ViewValue = $z_paises->nombre->CurrentValue;
			$z_paises->nombre->ViewCustomAttributes = "";

			// nacionalidad
			$z_paises->nacionalidad->ViewValue = $z_paises->nacionalidad->CurrentValue;
			$z_paises->nacionalidad->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_paises->visibilidad->CurrentValue) <> "") {
				switch ($z_paises->visibilidad->CurrentValue) {
					case "1":
						$z_paises->visibilidad->ViewValue = $z_paises->visibilidad->FldTagCaption(1) <> "" ? $z_paises->visibilidad->FldTagCaption(1) : $z_paises->visibilidad->CurrentValue;
						break;
					case "0":
						$z_paises->visibilidad->ViewValue = $z_paises->visibilidad->FldTagCaption(2) <> "" ? $z_paises->visibilidad->FldTagCaption(2) : $z_paises->visibilidad->CurrentValue;
						break;
					default:
						$z_paises->visibilidad->ViewValue = $z_paises->visibilidad->CurrentValue;
				}
			} else {
				$z_paises->visibilidad->ViewValue = NULL;
			}
			$z_paises->visibilidad->ViewCustomAttributes = "";

			// lp_pais_id
			$z_paises->lp_pais_id->LinkCustomAttributes = "";
			$z_paises->lp_pais_id->HrefValue = "";
			$z_paises->lp_pais_id->TooltipValue = "";

			// nombre
			$z_paises->nombre->LinkCustomAttributes = "";
			$z_paises->nombre->HrefValue = "";
			$z_paises->nombre->TooltipValue = "";

			// nacionalidad
			$z_paises->nacionalidad->LinkCustomAttributes = "";
			$z_paises->nacionalidad->HrefValue = "";
			$z_paises->nacionalidad->TooltipValue = "";

			// visibilidad
			$z_paises->visibilidad->LinkCustomAttributes = "";
			$z_paises->visibilidad->HrefValue = "";
			$z_paises->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_paises->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_paises->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $z_paises;
		$DeleteRows = TRUE;
		$sSql = $z_paises->SQL();
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
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $z_paises->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['lp_pais_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($z_paises->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($z_paises->CancelMessage <> "") {
				$this->setFailureMessage($z_paises->CancelMessage);
				$z_paises->CancelMessage = "";
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
				$z_paises->Row_Deleted($row);
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
