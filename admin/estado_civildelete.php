<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "estado_civilinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$estado_civil_delete = new cestado_civil_delete();
$Page =& $estado_civil_delete;

// Page init
$estado_civil_delete->Page_Init();

// Page main
$estado_civil_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var estado_civil_delete = new ew_Page("estado_civil_delete");

// page properties
estado_civil_delete.PageID = "delete"; // page ID
estado_civil_delete.FormID = "festado_civildelete"; // form ID
var EW_PAGE_ID = estado_civil_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
estado_civil_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
estado_civil_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
estado_civil_delete.ValidateRequired = false; // no JavaScript validation
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
if ($estado_civil_delete->Recordset = $estado_civil_delete->LoadRecordset())
	$estado_civil_deleteTotalRecs = $estado_civil_delete->Recordset->RecordCount(); // Get record count
if ($estado_civil_deleteTotalRecs <= 0) { // No record found, exit
	if ($estado_civil_delete->Recordset)
		$estado_civil_delete->Recordset->Close();
	$estado_civil_delete->Page_Terminate("estado_civillist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $estado_civil->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $estado_civil->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $estado_civil_delete->ShowPageHeader(); ?>
<?php
$estado_civil_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="estado_civil">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($estado_civil_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $estado_civil->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $estado_civil->id_civil->FldCaption() ?></td>
		<td valign="top"><?php echo $estado_civil->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $estado_civil->visibilidad->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$estado_civil_delete->RecCnt = 0;
$i = 0;
while (!$estado_civil_delete->Recordset->EOF) {
	$estado_civil_delete->RecCnt++;

	// Set row properties
	$estado_civil->ResetAttrs();
	$estado_civil->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$estado_civil_delete->LoadRowValues($estado_civil_delete->Recordset);

	// Render row
	$estado_civil_delete->RenderRow();
?>
	<tr<?php echo $estado_civil->RowAttributes() ?>>
		<td<?php echo $estado_civil->id_civil->CellAttributes() ?>>
<div<?php echo $estado_civil->id_civil->ViewAttributes() ?>><?php echo $estado_civil->id_civil->ListViewValue() ?></div></td>
		<td<?php echo $estado_civil->nombre->CellAttributes() ?>>
<div<?php echo $estado_civil->nombre->ViewAttributes() ?>><?php echo $estado_civil->nombre->ListViewValue() ?></div></td>
		<td<?php echo $estado_civil->visibilidad->CellAttributes() ?>>
<div<?php echo $estado_civil->visibilidad->ViewAttributes() ?>><?php echo $estado_civil->visibilidad->ListViewValue() ?></div></td>
	</tr>
<?php
	$estado_civil_delete->Recordset->MoveNext();
}
$estado_civil_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$estado_civil_delete->ShowPageFooter();
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
$estado_civil_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cestado_civil_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'estado_civil';

	// Page object name
	var $PageObjName = 'estado_civil_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $estado_civil;
		if ($estado_civil->UseTokenInUrl) $PageUrl .= "t=" . $estado_civil->TableVar . "&"; // Add page token
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
		global $objForm, $estado_civil;
		if ($estado_civil->UseTokenInUrl) {
			if ($objForm)
				return ($estado_civil->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($estado_civil->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cestado_civil_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (estado_civil)
		if (!isset($GLOBALS["estado_civil"])) {
			$GLOBALS["estado_civil"] = new cestado_civil();
			$GLOBALS["Table"] =& $GLOBALS["estado_civil"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'estado_civil', TRUE);

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
		global $estado_civil;

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
		global $Language, $estado_civil;

		// Load key parameters
		$this->RecKeys = $estado_civil->GetRecordKeys(); // Load record keys
		$sFilter = $estado_civil->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("estado_civillist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in estado_civil class, estado_civilinfo.php

		$estado_civil->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$estado_civil->CurrentAction = $_POST["a_delete"];
		} else {
			$estado_civil->CurrentAction = "I"; // Display record
		}
		switch ($estado_civil->CurrentAction) {
			case "D": // Delete
				$estado_civil->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($estado_civil->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $estado_civil;

		// Call Recordset Selecting event
		$estado_civil->Recordset_Selecting($estado_civil->CurrentFilter);

		// Load List page SQL
		$sSql = $estado_civil->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$estado_civil->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $estado_civil;
		$sFilter = $estado_civil->KeyFilter();

		// Call Row Selecting event
		$estado_civil->Row_Selecting($sFilter);

		// Load SQL based on filter
		$estado_civil->CurrentFilter = $sFilter;
		$sSql = $estado_civil->SQL();
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
		global $conn, $estado_civil;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$estado_civil->Row_Selected($row);
		$estado_civil->id_civil->setDbValue($rs->fields('id_civil'));
		$estado_civil->nombre->setDbValue($rs->fields('nombre'));
		$estado_civil->id_char->setDbValue($rs->fields('id_char'));
		$estado_civil->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $estado_civil;

		// Initialize URLs
		// Call Row_Rendering event

		$estado_civil->Row_Rendering();

		// Common render codes for all row types
		// id_civil
		// nombre
		// id_char
		// visibilidad

		if ($estado_civil->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_civil
			$estado_civil->id_civil->ViewValue = $estado_civil->id_civil->CurrentValue;
			$estado_civil->id_civil->ViewCustomAttributes = "";

			// nombre
			$estado_civil->nombre->ViewValue = $estado_civil->nombre->CurrentValue;
			$estado_civil->nombre->ViewCustomAttributes = "";

			// id_char
			$estado_civil->id_char->ViewValue = $estado_civil->id_char->CurrentValue;
			$estado_civil->id_char->ViewCustomAttributes = "";

			// visibilidad
			if (strval($estado_civil->visibilidad->CurrentValue) <> "") {
				switch ($estado_civil->visibilidad->CurrentValue) {
					case "1":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(1) <> "" ? $estado_civil->visibilidad->FldTagCaption(1) : $estado_civil->visibilidad->CurrentValue;
						break;
					case "0":
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->FldTagCaption(2) <> "" ? $estado_civil->visibilidad->FldTagCaption(2) : $estado_civil->visibilidad->CurrentValue;
						break;
					default:
						$estado_civil->visibilidad->ViewValue = $estado_civil->visibilidad->CurrentValue;
				}
			} else {
				$estado_civil->visibilidad->ViewValue = NULL;
			}
			$estado_civil->visibilidad->ViewCustomAttributes = "";

			// id_civil
			$estado_civil->id_civil->LinkCustomAttributes = "";
			$estado_civil->id_civil->HrefValue = "";
			$estado_civil->id_civil->TooltipValue = "";

			// nombre
			$estado_civil->nombre->LinkCustomAttributes = "";
			$estado_civil->nombre->HrefValue = "";
			$estado_civil->nombre->TooltipValue = "";

			// visibilidad
			$estado_civil->visibilidad->LinkCustomAttributes = "";
			$estado_civil->visibilidad->HrefValue = "";
			$estado_civil->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($estado_civil->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$estado_civil->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $estado_civil;
		$DeleteRows = TRUE;
		$sSql = $estado_civil->SQL();
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
				$DeleteRows = $estado_civil->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_civil'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($estado_civil->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($estado_civil->CancelMessage <> "") {
				$this->setFailureMessage($estado_civil->CancelMessage);
				$estado_civil->CancelMessage = "";
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
				$estado_civil->Row_Deleted($row);
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
