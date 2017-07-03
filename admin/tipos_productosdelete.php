<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tipos_productosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tipos_productos_delete = new ctipos_productos_delete();
$Page =& $tipos_productos_delete;

// Page init
$tipos_productos_delete->Page_Init();

// Page main
$tipos_productos_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tipos_productos_delete = new ew_Page("tipos_productos_delete");

// page properties
tipos_productos_delete.PageID = "delete"; // page ID
tipos_productos_delete.FormID = "ftipos_productosdelete"; // form ID
var EW_PAGE_ID = tipos_productos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tipos_productos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tipos_productos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tipos_productos_delete.ValidateRequired = false; // no JavaScript validation
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
if ($tipos_productos_delete->Recordset = $tipos_productos_delete->LoadRecordset())
	$tipos_productos_deleteTotalRecs = $tipos_productos_delete->Recordset->RecordCount(); // Get record count
if ($tipos_productos_deleteTotalRecs <= 0) { // No record found, exit
	if ($tipos_productos_delete->Recordset)
		$tipos_productos_delete->Recordset->Close();
	$tipos_productos_delete->Page_Terminate("tipos_productoslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tipos_productos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tipos_productos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tipos_productos_delete->ShowPageHeader(); ?>
<?php
$tipos_productos_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tipos_productos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tipos_productos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tipos_productos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tipos_productos->id_producto->FldCaption() ?></td>
		<td valign="top"><?php echo $tipos_productos->tipo->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tipos_productos_delete->RecCnt = 0;
$i = 0;
while (!$tipos_productos_delete->Recordset->EOF) {
	$tipos_productos_delete->RecCnt++;

	// Set row properties
	$tipos_productos->ResetAttrs();
	$tipos_productos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tipos_productos_delete->LoadRowValues($tipos_productos_delete->Recordset);

	// Render row
	$tipos_productos_delete->RenderRow();
?>
	<tr<?php echo $tipos_productos->RowAttributes() ?>>
		<td<?php echo $tipos_productos->id_producto->CellAttributes() ?>>
<div<?php echo $tipos_productos->id_producto->ViewAttributes() ?>><?php echo $tipos_productos->id_producto->ListViewValue() ?></div></td>
		<td<?php echo $tipos_productos->tipo->CellAttributes() ?>>
<div<?php echo $tipos_productos->tipo->ViewAttributes() ?>><?php echo $tipos_productos->tipo->ListViewValue() ?></div></td>
	</tr>
<?php
	$tipos_productos_delete->Recordset->MoveNext();
}
$tipos_productos_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$tipos_productos_delete->ShowPageFooter();
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
$tipos_productos_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctipos_productos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tipos_productos';

	// Page object name
	var $PageObjName = 'tipos_productos_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tipos_productos;
		if ($tipos_productos->UseTokenInUrl) $PageUrl .= "t=" . $tipos_productos->TableVar . "&"; // Add page token
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
		global $objForm, $tipos_productos;
		if ($tipos_productos->UseTokenInUrl) {
			if ($objForm)
				return ($tipos_productos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tipos_productos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctipos_productos_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tipos_productos)
		if (!isset($GLOBALS["tipos_productos"])) {
			$GLOBALS["tipos_productos"] = new ctipos_productos();
			$GLOBALS["Table"] =& $GLOBALS["tipos_productos"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tipos_productos', TRUE);

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
		global $tipos_productos;

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
		global $Language, $tipos_productos;

		// Load key parameters
		$this->RecKeys = $tipos_productos->GetRecordKeys(); // Load record keys
		$sFilter = $tipos_productos->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("tipos_productoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tipos_productos class, tipos_productosinfo.php

		$tipos_productos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tipos_productos->CurrentAction = $_POST["a_delete"];
		} else {
			$tipos_productos->CurrentAction = "I"; // Display record
		}
		switch ($tipos_productos->CurrentAction) {
			case "D": // Delete
				$tipos_productos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tipos_productos->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tipos_productos;

		// Call Recordset Selecting event
		$tipos_productos->Recordset_Selecting($tipos_productos->CurrentFilter);

		// Load List page SQL
		$sSql = $tipos_productos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tipos_productos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tipos_productos;
		$sFilter = $tipos_productos->KeyFilter();

		// Call Row Selecting event
		$tipos_productos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tipos_productos->CurrentFilter = $sFilter;
		$sSql = $tipos_productos->SQL();
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
		global $conn, $tipos_productos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tipos_productos->Row_Selected($row);
		$tipos_productos->id_producto->setDbValue($rs->fields('id_producto'));
		$tipos_productos->tipo->setDbValue($rs->fields('tipo'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tipos_productos;

		// Initialize URLs
		// Call Row_Rendering event

		$tipos_productos->Row_Rendering();

		// Common render codes for all row types
		// id_producto
		// tipo

		if ($tipos_productos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_producto
			$tipos_productos->id_producto->ViewValue = $tipos_productos->id_producto->CurrentValue;
			$tipos_productos->id_producto->ViewCustomAttributes = "";

			// tipo
			$tipos_productos->tipo->ViewValue = $tipos_productos->tipo->CurrentValue;
			$tipos_productos->tipo->ViewCustomAttributes = "";

			// id_producto
			$tipos_productos->id_producto->LinkCustomAttributes = "";
			$tipos_productos->id_producto->HrefValue = "";
			$tipos_productos->id_producto->TooltipValue = "";

			// tipo
			$tipos_productos->tipo->LinkCustomAttributes = "";
			$tipos_productos->tipo->HrefValue = "";
			$tipos_productos->tipo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tipos_productos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tipos_productos->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tipos_productos;
		$DeleteRows = TRUE;
		$sSql = $tipos_productos->SQL();
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
				$DeleteRows = $tipos_productos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_producto'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tipos_productos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tipos_productos->CancelMessage <> "") {
				$this->setFailureMessage($tipos_productos->CancelMessage);
				$tipos_productos->CancelMessage = "";
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
				$tipos_productos->Row_Deleted($row);
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
