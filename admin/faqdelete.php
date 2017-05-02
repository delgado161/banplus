<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "faqinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$faq_delete = new cfaq_delete();
$Page =& $faq_delete;

// Page init
$faq_delete->Page_Init();

// Page main
$faq_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var faq_delete = new ew_Page("faq_delete");

// page properties
faq_delete.PageID = "delete"; // page ID
faq_delete.FormID = "ffaqdelete"; // form ID
var EW_PAGE_ID = faq_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
faq_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
faq_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
faq_delete.ValidateRequired = false; // no JavaScript validation
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
if ($faq_delete->Recordset = $faq_delete->LoadRecordset())
	$faq_deleteTotalRecs = $faq_delete->Recordset->RecordCount(); // Get record count
if ($faq_deleteTotalRecs <= 0) { // No record found, exit
	if ($faq_delete->Recordset)
		$faq_delete->Recordset->Close();
	$faq_delete->Page_Terminate("faqlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $faq->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $faq->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $faq_delete->ShowPageHeader(); ?>
<?php
$faq_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="faq">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($faq_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $faq->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $faq->pregunta->FldCaption() ?></td>
		<td valign="top"><?php echo $faq->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$faq_delete->RecCnt = 0;
$i = 0;
while (!$faq_delete->Recordset->EOF) {
	$faq_delete->RecCnt++;

	// Set row properties
	$faq->ResetAttrs();
	$faq->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$faq_delete->LoadRowValues($faq_delete->Recordset);

	// Render row
	$faq_delete->RenderRow();
?>
	<tr<?php echo $faq->RowAttributes() ?>>
		<td<?php echo $faq->pregunta->CellAttributes() ?>>
<div<?php echo $faq->pregunta->ViewAttributes() ?>><?php echo $faq->pregunta->ListViewValue() ?></div></td>
		<td<?php echo $faq->estatus->CellAttributes() ?>>
<div<?php echo $faq->estatus->ViewAttributes() ?>><?php echo $faq->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$faq_delete->Recordset->MoveNext();
}
$faq_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$faq_delete->ShowPageFooter();
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
$faq_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cfaq_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'faq';

	// Page object name
	var $PageObjName = 'faq_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $faq;
		if ($faq->UseTokenInUrl) $PageUrl .= "t=" . $faq->TableVar . "&"; // Add page token
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
		global $objForm, $faq;
		if ($faq->UseTokenInUrl) {
			if ($objForm)
				return ($faq->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($faq->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfaq_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (faq)
		if (!isset($GLOBALS["faq"])) {
			$GLOBALS["faq"] = new cfaq();
			$GLOBALS["Table"] =& $GLOBALS["faq"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'faq', TRUE);

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
		global $faq;

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
			$this->Page_Terminate("faqlist.php");
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
		global $Language, $faq;

		// Load key parameters
		$this->RecKeys = $faq->GetRecordKeys(); // Load record keys
		$sFilter = $faq->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("faqlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in faq class, faqinfo.php

		$faq->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$faq->CurrentAction = $_POST["a_delete"];
		} else {
			$faq->CurrentAction = "I"; // Display record
		}
		switch ($faq->CurrentAction) {
			case "D": // Delete
				$faq->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($faq->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $faq;

		// Call Recordset Selecting event
		$faq->Recordset_Selecting($faq->CurrentFilter);

		// Load List page SQL
		$sSql = $faq->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$faq->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $faq;
		$sFilter = $faq->KeyFilter();

		// Call Row Selecting event
		$faq->Row_Selecting($sFilter);

		// Load SQL based on filter
		$faq->CurrentFilter = $sFilter;
		$sSql = $faq->SQL();
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
		global $conn, $faq;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$faq->Row_Selected($row);
		$faq->id_faq->setDbValue($rs->fields('id_faq'));
		$faq->pregunta->setDbValue($rs->fields('pregunta'));
		$faq->respuesta->setDbValue($rs->fields('respuesta'));
		$faq->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $faq;

		// Initialize URLs
		// Call Row_Rendering event

		$faq->Row_Rendering();

		// Common render codes for all row types
		// id_faq
		// pregunta
		// respuesta
		// estatus

		if ($faq->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_faq
			$faq->id_faq->ViewValue = $faq->id_faq->CurrentValue;
			$faq->id_faq->ViewCustomAttributes = "";

			// pregunta
			$faq->pregunta->ViewValue = $faq->pregunta->CurrentValue;
			$faq->pregunta->ViewCustomAttributes = "";

			// estatus
			if (strval($faq->estatus->CurrentValue) <> "") {
				switch ($faq->estatus->CurrentValue) {
					case "1":
						$faq->estatus->ViewValue = $faq->estatus->FldTagCaption(1) <> "" ? $faq->estatus->FldTagCaption(1) : $faq->estatus->CurrentValue;
						break;
					case "0":
						$faq->estatus->ViewValue = $faq->estatus->FldTagCaption(2) <> "" ? $faq->estatus->FldTagCaption(2) : $faq->estatus->CurrentValue;
						break;
					default:
						$faq->estatus->ViewValue = $faq->estatus->CurrentValue;
				}
			} else {
				$faq->estatus->ViewValue = NULL;
			}
			$faq->estatus->ViewCustomAttributes = "";

			// pregunta
			$faq->pregunta->LinkCustomAttributes = "";
			$faq->pregunta->HrefValue = "";
			$faq->pregunta->TooltipValue = "";

			// estatus
			$faq->estatus->LinkCustomAttributes = "";
			$faq->estatus->HrefValue = "";
			$faq->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($faq->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$faq->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $faq;
		$DeleteRows = TRUE;
		$sSql = $faq->SQL();
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
				$DeleteRows = $faq->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_faq'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($faq->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($faq->CancelMessage <> "") {
				$this->setFailureMessage($faq->CancelMessage);
				$faq->CancelMessage = "";
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
				$faq->Row_Deleted($row);
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
