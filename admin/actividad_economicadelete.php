<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "actividad_economicainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$actividad_economica_delete = new cactividad_economica_delete();
$Page =& $actividad_economica_delete;

// Page init
$actividad_economica_delete->Page_Init();

// Page main
$actividad_economica_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var actividad_economica_delete = new ew_Page("actividad_economica_delete");

// page properties
actividad_economica_delete.PageID = "delete"; // page ID
actividad_economica_delete.FormID = "factividad_economicadelete"; // form ID
var EW_PAGE_ID = actividad_economica_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
actividad_economica_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
actividad_economica_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
actividad_economica_delete.ValidateRequired = false; // no JavaScript validation
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
if ($actividad_economica_delete->Recordset = $actividad_economica_delete->LoadRecordset())
	$actividad_economica_deleteTotalRecs = $actividad_economica_delete->Recordset->RecordCount(); // Get record count
if ($actividad_economica_deleteTotalRecs <= 0) { // No record found, exit
	if ($actividad_economica_delete->Recordset)
		$actividad_economica_delete->Recordset->Close();
	$actividad_economica_delete->Page_Terminate("actividad_economicalist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $actividad_economica->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $actividad_economica->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $actividad_economica_delete->ShowPageHeader(); ?>
<?php
$actividad_economica_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="actividad_economica">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($actividad_economica_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $actividad_economica->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $actividad_economica->id_acteconomica->FldCaption() ?></td>
		<td valign="top"><?php echo $actividad_economica->actividad->FldCaption() ?></td>
		<td valign="top"><?php echo $actividad_economica->visibilidad->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$actividad_economica_delete->RecCnt = 0;
$i = 0;
while (!$actividad_economica_delete->Recordset->EOF) {
	$actividad_economica_delete->RecCnt++;

	// Set row properties
	$actividad_economica->ResetAttrs();
	$actividad_economica->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$actividad_economica_delete->LoadRowValues($actividad_economica_delete->Recordset);

	// Render row
	$actividad_economica_delete->RenderRow();
?>
	<tr<?php echo $actividad_economica->RowAttributes() ?>>
		<td<?php echo $actividad_economica->id_acteconomica->CellAttributes() ?>>
<div<?php echo $actividad_economica->id_acteconomica->ViewAttributes() ?>><?php echo $actividad_economica->id_acteconomica->ListViewValue() ?></div></td>
		<td<?php echo $actividad_economica->actividad->CellAttributes() ?>>
<div<?php echo $actividad_economica->actividad->ViewAttributes() ?>><?php echo $actividad_economica->actividad->ListViewValue() ?></div></td>
		<td<?php echo $actividad_economica->visibilidad->CellAttributes() ?>>
<div<?php echo $actividad_economica->visibilidad->ViewAttributes() ?>><?php echo $actividad_economica->visibilidad->ListViewValue() ?></div></td>
	</tr>
<?php
	$actividad_economica_delete->Recordset->MoveNext();
}
$actividad_economica_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$actividad_economica_delete->ShowPageFooter();
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
$actividad_economica_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cactividad_economica_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'actividad_economica';

	// Page object name
	var $PageObjName = 'actividad_economica_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $actividad_economica;
		if ($actividad_economica->UseTokenInUrl) $PageUrl .= "t=" . $actividad_economica->TableVar . "&"; // Add page token
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
		global $objForm, $actividad_economica;
		if ($actividad_economica->UseTokenInUrl) {
			if ($objForm)
				return ($actividad_economica->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($actividad_economica->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cactividad_economica_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (actividad_economica)
		if (!isset($GLOBALS["actividad_economica"])) {
			$GLOBALS["actividad_economica"] = new cactividad_economica();
			$GLOBALS["Table"] =& $GLOBALS["actividad_economica"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'actividad_economica', TRUE);

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
		global $actividad_economica;

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
		global $Language, $actividad_economica;

		// Load key parameters
		$this->RecKeys = $actividad_economica->GetRecordKeys(); // Load record keys
		$sFilter = $actividad_economica->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("actividad_economicalist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in actividad_economica class, actividad_economicainfo.php

		$actividad_economica->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$actividad_economica->CurrentAction = $_POST["a_delete"];
		} else {
			$actividad_economica->CurrentAction = "I"; // Display record
		}
		switch ($actividad_economica->CurrentAction) {
			case "D": // Delete
				$actividad_economica->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($actividad_economica->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $actividad_economica;

		// Call Recordset Selecting event
		$actividad_economica->Recordset_Selecting($actividad_economica->CurrentFilter);

		// Load List page SQL
		$sSql = $actividad_economica->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$actividad_economica->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $actividad_economica;
		$sFilter = $actividad_economica->KeyFilter();

		// Call Row Selecting event
		$actividad_economica->Row_Selecting($sFilter);

		// Load SQL based on filter
		$actividad_economica->CurrentFilter = $sFilter;
		$sSql = $actividad_economica->SQL();
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
		global $conn, $actividad_economica;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$actividad_economica->Row_Selected($row);
		$actividad_economica->id_acteconomica->setDbValue($rs->fields('id_acteconomica'));
		$actividad_economica->actividad->setDbValue($rs->fields('actividad'));
		$actividad_economica->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $actividad_economica;

		// Initialize URLs
		// Call Row_Rendering event

		$actividad_economica->Row_Rendering();

		// Common render codes for all row types
		// id_acteconomica
		// actividad
		// visibilidad

		if ($actividad_economica->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_acteconomica
			$actividad_economica->id_acteconomica->ViewValue = $actividad_economica->id_acteconomica->CurrentValue;
			$actividad_economica->id_acteconomica->ViewCustomAttributes = "";

			// actividad
			$actividad_economica->actividad->ViewValue = $actividad_economica->actividad->CurrentValue;
			$actividad_economica->actividad->ViewCustomAttributes = "";

			// visibilidad
			if (strval($actividad_economica->visibilidad->CurrentValue) <> "") {
				switch ($actividad_economica->visibilidad->CurrentValue) {
					case "1":
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->FldTagCaption(1) <> "" ? $actividad_economica->visibilidad->FldTagCaption(1) : $actividad_economica->visibilidad->CurrentValue;
						break;
					case "0":
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->FldTagCaption(2) <> "" ? $actividad_economica->visibilidad->FldTagCaption(2) : $actividad_economica->visibilidad->CurrentValue;
						break;
					default:
						$actividad_economica->visibilidad->ViewValue = $actividad_economica->visibilidad->CurrentValue;
				}
			} else {
				$actividad_economica->visibilidad->ViewValue = NULL;
			}
			$actividad_economica->visibilidad->ViewCustomAttributes = "";

			// id_acteconomica
			$actividad_economica->id_acteconomica->LinkCustomAttributes = "";
			$actividad_economica->id_acteconomica->HrefValue = "";
			$actividad_economica->id_acteconomica->TooltipValue = "";

			// actividad
			$actividad_economica->actividad->LinkCustomAttributes = "";
			$actividad_economica->actividad->HrefValue = "";
			$actividad_economica->actividad->TooltipValue = "";

			// visibilidad
			$actividad_economica->visibilidad->LinkCustomAttributes = "";
			$actividad_economica->visibilidad->HrefValue = "";
			$actividad_economica->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($actividad_economica->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$actividad_economica->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $actividad_economica;
		$DeleteRows = TRUE;
		$sSql = $actividad_economica->SQL();
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
				$DeleteRows = $actividad_economica->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_acteconomica'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($actividad_economica->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($actividad_economica->CancelMessage <> "") {
				$this->setFailureMessage($actividad_economica->CancelMessage);
				$actividad_economica->CancelMessage = "";
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
				$actividad_economica->Row_Deleted($row);
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
