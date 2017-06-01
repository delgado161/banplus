<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "profesionesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$profesiones_delete = new cprofesiones_delete();
$Page =& $profesiones_delete;

// Page init
$profesiones_delete->Page_Init();

// Page main
$profesiones_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var profesiones_delete = new ew_Page("profesiones_delete");

// page properties
profesiones_delete.PageID = "delete"; // page ID
profesiones_delete.FormID = "fprofesionesdelete"; // form ID
var EW_PAGE_ID = profesiones_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
profesiones_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
profesiones_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
profesiones_delete.ValidateRequired = false; // no JavaScript validation
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
if ($profesiones_delete->Recordset = $profesiones_delete->LoadRecordset())
	$profesiones_deleteTotalRecs = $profesiones_delete->Recordset->RecordCount(); // Get record count
if ($profesiones_deleteTotalRecs <= 0) { // No record found, exit
	if ($profesiones_delete->Recordset)
		$profesiones_delete->Recordset->Close();
	$profesiones_delete->Page_Terminate("profesioneslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $profesiones->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $profesiones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $profesiones_delete->ShowPageHeader(); ?>
<?php
$profesiones_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="profesiones">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($profesiones_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $profesiones->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $profesiones->id_profesion->FldCaption() ?></td>
		<td valign="top"><?php echo $profesiones->descripcion->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$profesiones_delete->RecCnt = 0;
$i = 0;
while (!$profesiones_delete->Recordset->EOF) {
	$profesiones_delete->RecCnt++;

	// Set row properties
	$profesiones->ResetAttrs();
	$profesiones->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$profesiones_delete->LoadRowValues($profesiones_delete->Recordset);

	// Render row
	$profesiones_delete->RenderRow();
?>
	<tr<?php echo $profesiones->RowAttributes() ?>>
		<td<?php echo $profesiones->id_profesion->CellAttributes() ?>>
<div<?php echo $profesiones->id_profesion->ViewAttributes() ?>><?php echo $profesiones->id_profesion->ListViewValue() ?></div></td>
		<td<?php echo $profesiones->descripcion->CellAttributes() ?>>
<div<?php echo $profesiones->descripcion->ViewAttributes() ?>><?php echo $profesiones->descripcion->ListViewValue() ?></div></td>
	</tr>
<?php
	$profesiones_delete->Recordset->MoveNext();
}
$profesiones_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$profesiones_delete->ShowPageFooter();
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
$profesiones_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cprofesiones_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'profesiones';

	// Page object name
	var $PageObjName = 'profesiones_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $profesiones;
		if ($profesiones->UseTokenInUrl) $PageUrl .= "t=" . $profesiones->TableVar . "&"; // Add page token
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
		global $objForm, $profesiones;
		if ($profesiones->UseTokenInUrl) {
			if ($objForm)
				return ($profesiones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($profesiones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprofesiones_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (profesiones)
		if (!isset($GLOBALS["profesiones"])) {
			$GLOBALS["profesiones"] = new cprofesiones();
			$GLOBALS["Table"] =& $GLOBALS["profesiones"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'profesiones', TRUE);

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
		global $profesiones;

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
		global $Language, $profesiones;

		// Load key parameters
		$this->RecKeys = $profesiones->GetRecordKeys(); // Load record keys
		$sFilter = $profesiones->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("profesioneslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in profesiones class, profesionesinfo.php

		$profesiones->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$profesiones->CurrentAction = $_POST["a_delete"];
		} else {
			$profesiones->CurrentAction = "I"; // Display record
		}
		switch ($profesiones->CurrentAction) {
			case "D": // Delete
				$profesiones->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($profesiones->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $profesiones;

		// Call Recordset Selecting event
		$profesiones->Recordset_Selecting($profesiones->CurrentFilter);

		// Load List page SQL
		$sSql = $profesiones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$profesiones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $profesiones;
		$sFilter = $profesiones->KeyFilter();

		// Call Row Selecting event
		$profesiones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$profesiones->CurrentFilter = $sFilter;
		$sSql = $profesiones->SQL();
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
		global $conn, $profesiones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$profesiones->Row_Selected($row);
		$profesiones->id_profesion->setDbValue($rs->fields('id_profesion'));
		$profesiones->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $profesiones;

		// Initialize URLs
		// Call Row_Rendering event

		$profesiones->Row_Rendering();

		// Common render codes for all row types
		// id_profesion
		// descripcion

		if ($profesiones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profesion
			$profesiones->id_profesion->ViewValue = $profesiones->id_profesion->CurrentValue;
			$profesiones->id_profesion->ViewCustomAttributes = "";

			// descripcion
			$profesiones->descripcion->ViewValue = $profesiones->descripcion->CurrentValue;
			$profesiones->descripcion->ViewCustomAttributes = "";

			// id_profesion
			$profesiones->id_profesion->LinkCustomAttributes = "";
			$profesiones->id_profesion->HrefValue = "";
			$profesiones->id_profesion->TooltipValue = "";

			// descripcion
			$profesiones->descripcion->LinkCustomAttributes = "";
			$profesiones->descripcion->HrefValue = "";
			$profesiones->descripcion->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($profesiones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$profesiones->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $profesiones;
		$DeleteRows = TRUE;
		$sSql = $profesiones->SQL();
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
				$DeleteRows = $profesiones->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_profesion'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($profesiones->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($profesiones->CancelMessage <> "") {
				$this->setFailureMessage($profesiones->CancelMessage);
				$profesiones->CancelMessage = "";
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
				$profesiones->Row_Deleted($row);
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
