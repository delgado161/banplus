<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_municipiosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_municipios_delete = new cz_municipios_delete();
$Page =& $z_municipios_delete;

// Page init
$z_municipios_delete->Page_Init();

// Page main
$z_municipios_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_municipios_delete = new ew_Page("z_municipios_delete");

// page properties
z_municipios_delete.PageID = "delete"; // page ID
z_municipios_delete.FormID = "fz_municipiosdelete"; // form ID
var EW_PAGE_ID = z_municipios_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_municipios_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_municipios_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_municipios_delete.ValidateRequired = false; // no JavaScript validation
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
if ($z_municipios_delete->Recordset = $z_municipios_delete->LoadRecordset())
	$z_municipios_deleteTotalRecs = $z_municipios_delete->Recordset->RecordCount(); // Get record count
if ($z_municipios_deleteTotalRecs <= 0) { // No record found, exit
	if ($z_municipios_delete->Recordset)
		$z_municipios_delete->Recordset->Close();
	$z_municipios_delete->Page_Terminate("z_municipioslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_municipios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_municipios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_municipios_delete->ShowPageHeader(); ?>
<?php
$z_municipios_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="z_municipios">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($z_municipios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $z_municipios->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $z_municipios->lp_municipio_id->FldCaption() ?></td>
		<td valign="top"><?php echo $z_municipios->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $z_municipios->visibilidad->FldCaption() ?></td>
		<td valign="top"><?php echo $z_municipios->lf_estado->FldCaption() ?></td>
		<td valign="top"><?php echo $z_municipios->pk_municipio->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$z_municipios_delete->RecCnt = 0;
$i = 0;
while (!$z_municipios_delete->Recordset->EOF) {
	$z_municipios_delete->RecCnt++;

	// Set row properties
	$z_municipios->ResetAttrs();
	$z_municipios->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$z_municipios_delete->LoadRowValues($z_municipios_delete->Recordset);

	// Render row
	$z_municipios_delete->RenderRow();
?>
	<tr<?php echo $z_municipios->RowAttributes() ?>>
		<td<?php echo $z_municipios->lp_municipio_id->CellAttributes() ?>>
<div<?php echo $z_municipios->lp_municipio_id->ViewAttributes() ?>><?php echo $z_municipios->lp_municipio_id->ListViewValue() ?></div></td>
		<td<?php echo $z_municipios->nombre->CellAttributes() ?>>
<div<?php echo $z_municipios->nombre->ViewAttributes() ?>><?php echo $z_municipios->nombre->ListViewValue() ?></div></td>
		<td<?php echo $z_municipios->visibilidad->CellAttributes() ?>>
<div<?php echo $z_municipios->visibilidad->ViewAttributes() ?>><?php echo $z_municipios->visibilidad->ListViewValue() ?></div></td>
		<td<?php echo $z_municipios->lf_estado->CellAttributes() ?>>
<div<?php echo $z_municipios->lf_estado->ViewAttributes() ?>><?php echo $z_municipios->lf_estado->ListViewValue() ?></div></td>
		<td<?php echo $z_municipios->pk_municipio->CellAttributes() ?>>
<div<?php echo $z_municipios->pk_municipio->ViewAttributes() ?>><?php echo $z_municipios->pk_municipio->ListViewValue() ?></div></td>
	</tr>
<?php
	$z_municipios_delete->Recordset->MoveNext();
}
$z_municipios_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$z_municipios_delete->ShowPageFooter();
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
$z_municipios_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_municipios_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = '_municipios';

	// Page object name
	var $PageObjName = 'z_municipios_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_municipios;
		if ($z_municipios->UseTokenInUrl) $PageUrl .= "t=" . $z_municipios->TableVar . "&"; // Add page token
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
		global $objForm, $z_municipios;
		if ($z_municipios->UseTokenInUrl) {
			if ($objForm)
				return ($z_municipios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_municipios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_municipios_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_municipios)
		if (!isset($GLOBALS["z_municipios"])) {
			$GLOBALS["z_municipios"] = new cz_municipios();
			$GLOBALS["Table"] =& $GLOBALS["z_municipios"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_municipios', TRUE);

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
		global $z_municipios;

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
		global $Language, $z_municipios;

		// Load key parameters
		$this->RecKeys = $z_municipios->GetRecordKeys(); // Load record keys
		$sFilter = $z_municipios->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("z_municipioslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in z_municipios class, z_municipiosinfo.php

		$z_municipios->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$z_municipios->CurrentAction = $_POST["a_delete"];
		} else {
			$z_municipios->CurrentAction = "I"; // Display record
		}
		switch ($z_municipios->CurrentAction) {
			case "D": // Delete
				$z_municipios->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($z_municipios->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_municipios;

		// Call Recordset Selecting event
		$z_municipios->Recordset_Selecting($z_municipios->CurrentFilter);

		// Load List page SQL
		$sSql = $z_municipios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_municipios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_municipios;
		$sFilter = $z_municipios->KeyFilter();

		// Call Row Selecting event
		$z_municipios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_municipios->CurrentFilter = $sFilter;
		$sSql = $z_municipios->SQL();
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
		global $conn, $z_municipios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_municipios->Row_Selected($row);
		$z_municipios->lp_municipio_id->setDbValue($rs->fields('lp_municipio_id'));
		$z_municipios->nombre->setDbValue($rs->fields('nombre'));
		$z_municipios->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_municipios->lf_estado->setDbValue($rs->fields('lf_estado'));
		$z_municipios->pk_municipio->setDbValue($rs->fields('pk_municipio'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_municipios;

		// Initialize URLs
		// Call Row_Rendering event

		$z_municipios->Row_Rendering();

		// Common render codes for all row types
		// lp_municipio_id
		// nombre
		// visibilidad
		// lf_estado
		// pk_municipio

		if ($z_municipios->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_municipio_id
			$z_municipios->lp_municipio_id->ViewValue = $z_municipios->lp_municipio_id->CurrentValue;
			$z_municipios->lp_municipio_id->ViewCustomAttributes = "";

			// nombre
			$z_municipios->nombre->ViewValue = $z_municipios->nombre->CurrentValue;
			$z_municipios->nombre->ViewCustomAttributes = "";

			// visibilidad
			$z_municipios->visibilidad->ViewValue = $z_municipios->visibilidad->CurrentValue;
			$z_municipios->visibilidad->ViewCustomAttributes = "";

			// lf_estado
			$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
			if (strval($z_municipios->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_municipios->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_municipios->lf_estado->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_municipios->lf_estado->ViewValue = $z_municipios->lf_estado->CurrentValue;
				}
			} else {
				$z_municipios->lf_estado->ViewValue = NULL;
			}
			$z_municipios->lf_estado->ViewCustomAttributes = "";

			// pk_municipio
			$z_municipios->pk_municipio->ViewValue = $z_municipios->pk_municipio->CurrentValue;
			$z_municipios->pk_municipio->ViewCustomAttributes = "";

			// lp_municipio_id
			$z_municipios->lp_municipio_id->LinkCustomAttributes = "";
			$z_municipios->lp_municipio_id->HrefValue = "";
			$z_municipios->lp_municipio_id->TooltipValue = "";

			// nombre
			$z_municipios->nombre->LinkCustomAttributes = "";
			$z_municipios->nombre->HrefValue = "";
			$z_municipios->nombre->TooltipValue = "";

			// visibilidad
			$z_municipios->visibilidad->LinkCustomAttributes = "";
			$z_municipios->visibilidad->HrefValue = "";
			$z_municipios->visibilidad->TooltipValue = "";

			// lf_estado
			$z_municipios->lf_estado->LinkCustomAttributes = "";
			$z_municipios->lf_estado->HrefValue = "";
			$z_municipios->lf_estado->TooltipValue = "";

			// pk_municipio
			$z_municipios->pk_municipio->LinkCustomAttributes = "";
			$z_municipios->pk_municipio->HrefValue = "";
			$z_municipios->pk_municipio->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_municipios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_municipios->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $z_municipios;
		$DeleteRows = TRUE;
		$sSql = $z_municipios->SQL();
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
				$DeleteRows = $z_municipios->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['lp_municipio_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($z_municipios->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($z_municipios->CancelMessage <> "") {
				$this->setFailureMessage($z_municipios->CancelMessage);
				$z_municipios->CancelMessage = "";
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
				$z_municipios->Row_Deleted($row);
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
