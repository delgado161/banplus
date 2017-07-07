<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_codigo_postalinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_codigo_postal_delete = new cz_codigo_postal_delete();
$Page =& $z_codigo_postal_delete;

// Page init
$z_codigo_postal_delete->Page_Init();

// Page main
$z_codigo_postal_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_codigo_postal_delete = new ew_Page("z_codigo_postal_delete");

// page properties
z_codigo_postal_delete.PageID = "delete"; // page ID
z_codigo_postal_delete.FormID = "fz_codigo_postaldelete"; // form ID
var EW_PAGE_ID = z_codigo_postal_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_codigo_postal_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_codigo_postal_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_codigo_postal_delete.ValidateRequired = false; // no JavaScript validation
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
if ($z_codigo_postal_delete->Recordset = $z_codigo_postal_delete->LoadRecordset())
	$z_codigo_postal_deleteTotalRecs = $z_codigo_postal_delete->Recordset->RecordCount(); // Get record count
if ($z_codigo_postal_deleteTotalRecs <= 0) { // No record found, exit
	if ($z_codigo_postal_delete->Recordset)
		$z_codigo_postal_delete->Recordset->Close();
	$z_codigo_postal_delete->Page_Terminate("z_codigo_postallist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_codigo_postal->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_codigo_postal->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_codigo_postal_delete->ShowPageHeader(); ?>
<?php
$z_codigo_postal_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="z_codigo_postal">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($z_codigo_postal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $z_codigo_postal->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $z_codigo_postal->id_codigo_postal->FldCaption() ?></td>
		<td valign="top"><?php echo $z_codigo_postal->codigo->FldCaption() ?></td>
		<td valign="top"><?php echo $z_codigo_postal->Descripcion->FldCaption() ?></td>
		<td valign="top"><?php echo $z_codigo_postal->visibilidad->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$z_codigo_postal_delete->RecCnt = 0;
$i = 0;
while (!$z_codigo_postal_delete->Recordset->EOF) {
	$z_codigo_postal_delete->RecCnt++;

	// Set row properties
	$z_codigo_postal->ResetAttrs();
	$z_codigo_postal->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$z_codigo_postal_delete->LoadRowValues($z_codigo_postal_delete->Recordset);

	// Render row
	$z_codigo_postal_delete->RenderRow();
?>
	<tr<?php echo $z_codigo_postal->RowAttributes() ?>>
		<td<?php echo $z_codigo_postal->id_codigo_postal->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->id_codigo_postal->ViewAttributes() ?>><?php echo $z_codigo_postal->id_codigo_postal->ListViewValue() ?></div></td>
		<td<?php echo $z_codigo_postal->codigo->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->codigo->ViewAttributes() ?>><?php echo $z_codigo_postal->codigo->ListViewValue() ?></div></td>
		<td<?php echo $z_codigo_postal->Descripcion->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->Descripcion->ViewAttributes() ?>><?php echo $z_codigo_postal->Descripcion->ListViewValue() ?></div></td>
		<td<?php echo $z_codigo_postal->visibilidad->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->visibilidad->ViewAttributes() ?>><?php echo $z_codigo_postal->visibilidad->ListViewValue() ?></div></td>
	</tr>
<?php
	$z_codigo_postal_delete->Recordset->MoveNext();
}
$z_codigo_postal_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$z_codigo_postal_delete->ShowPageFooter();
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
$z_codigo_postal_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_codigo_postal_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = '_codigo_postal';

	// Page object name
	var $PageObjName = 'z_codigo_postal_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_codigo_postal;
		if ($z_codigo_postal->UseTokenInUrl) $PageUrl .= "t=" . $z_codigo_postal->TableVar . "&"; // Add page token
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
		global $objForm, $z_codigo_postal;
		if ($z_codigo_postal->UseTokenInUrl) {
			if ($objForm)
				return ($z_codigo_postal->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_codigo_postal->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_codigo_postal_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_codigo_postal)
		if (!isset($GLOBALS["z_codigo_postal"])) {
			$GLOBALS["z_codigo_postal"] = new cz_codigo_postal();
			$GLOBALS["Table"] =& $GLOBALS["z_codigo_postal"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_codigo_postal', TRUE);

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
		global $z_codigo_postal;

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
		global $Language, $z_codigo_postal;

		// Load key parameters
		$this->RecKeys = $z_codigo_postal->GetRecordKeys(); // Load record keys
		$sFilter = $z_codigo_postal->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("z_codigo_postallist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in z_codigo_postal class, z_codigo_postalinfo.php

		$z_codigo_postal->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$z_codigo_postal->CurrentAction = $_POST["a_delete"];
		} else {
			$z_codigo_postal->CurrentAction = "I"; // Display record
		}
		switch ($z_codigo_postal->CurrentAction) {
			case "D": // Delete
				$z_codigo_postal->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($z_codigo_postal->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_codigo_postal;

		// Call Recordset Selecting event
		$z_codigo_postal->Recordset_Selecting($z_codigo_postal->CurrentFilter);

		// Load List page SQL
		$sSql = $z_codigo_postal->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_codigo_postal->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_codigo_postal;
		$sFilter = $z_codigo_postal->KeyFilter();

		// Call Row Selecting event
		$z_codigo_postal->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_codigo_postal->CurrentFilter = $sFilter;
		$sSql = $z_codigo_postal->SQL();
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
		global $conn, $z_codigo_postal;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_codigo_postal->Row_Selected($row);
		$z_codigo_postal->id_codigo_postal->setDbValue($rs->fields('id_codigo_postal'));
		$z_codigo_postal->codigo->setDbValue($rs->fields('codigo'));
		$z_codigo_postal->Descripcion->setDbValue($rs->fields('Descripcion'));
		$z_codigo_postal->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_codigo_postal;

		// Initialize URLs
		// Call Row_Rendering event

		$z_codigo_postal->Row_Rendering();

		// Common render codes for all row types
		// id_codigo_postal
		// codigo
		// Descripcion
		// visibilidad

		if ($z_codigo_postal->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_codigo_postal
			$z_codigo_postal->id_codigo_postal->ViewValue = $z_codigo_postal->id_codigo_postal->CurrentValue;
			$z_codigo_postal->id_codigo_postal->ViewCustomAttributes = "";

			// codigo
			$z_codigo_postal->codigo->ViewValue = $z_codigo_postal->codigo->CurrentValue;
			$z_codigo_postal->codigo->ViewCustomAttributes = "";

			// Descripcion
			$z_codigo_postal->Descripcion->ViewValue = $z_codigo_postal->Descripcion->CurrentValue;
			$z_codigo_postal->Descripcion->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_codigo_postal->visibilidad->CurrentValue) <> "") {
				switch ($z_codigo_postal->visibilidad->CurrentValue) {
					case "1":
						$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->FldTagCaption(1) <> "" ? $z_codigo_postal->visibilidad->FldTagCaption(1) : $z_codigo_postal->visibilidad->CurrentValue;
						break;
					case "0":
						$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->FldTagCaption(2) <> "" ? $z_codigo_postal->visibilidad->FldTagCaption(2) : $z_codigo_postal->visibilidad->CurrentValue;
						break;
					default:
						$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->CurrentValue;
				}
			} else {
				$z_codigo_postal->visibilidad->ViewValue = NULL;
			}
			$z_codigo_postal->visibilidad->ViewCustomAttributes = "";

			// id_codigo_postal
			$z_codigo_postal->id_codigo_postal->LinkCustomAttributes = "";
			$z_codigo_postal->id_codigo_postal->HrefValue = "";
			$z_codigo_postal->id_codigo_postal->TooltipValue = "";

			// codigo
			$z_codigo_postal->codigo->LinkCustomAttributes = "";
			$z_codigo_postal->codigo->HrefValue = "";
			$z_codigo_postal->codigo->TooltipValue = "";

			// Descripcion
			$z_codigo_postal->Descripcion->LinkCustomAttributes = "";
			$z_codigo_postal->Descripcion->HrefValue = "";
			$z_codigo_postal->Descripcion->TooltipValue = "";

			// visibilidad
			$z_codigo_postal->visibilidad->LinkCustomAttributes = "";
			$z_codigo_postal->visibilidad->HrefValue = "";
			$z_codigo_postal->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_codigo_postal->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_codigo_postal->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $z_codigo_postal;
		$DeleteRows = TRUE;
		$sSql = $z_codigo_postal->SQL();
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
				$DeleteRows = $z_codigo_postal->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_codigo_postal'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($z_codigo_postal->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($z_codigo_postal->CancelMessage <> "") {
				$this->setFailureMessage($z_codigo_postal->CancelMessage);
				$z_codigo_postal->CancelMessage = "";
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
				$z_codigo_postal->Row_Deleted($row);
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
