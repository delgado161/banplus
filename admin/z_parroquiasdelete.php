<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_parroquiasinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_parroquias_delete = new cz_parroquias_delete();
$Page =& $z_parroquias_delete;

// Page init
$z_parroquias_delete->Page_Init();

// Page main
$z_parroquias_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_parroquias_delete = new ew_Page("z_parroquias_delete");

// page properties
z_parroquias_delete.PageID = "delete"; // page ID
z_parroquias_delete.FormID = "fz_parroquiasdelete"; // form ID
var EW_PAGE_ID = z_parroquias_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_parroquias_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_parroquias_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_parroquias_delete.ValidateRequired = false; // no JavaScript validation
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
if ($z_parroquias_delete->Recordset = $z_parroquias_delete->LoadRecordset())
	$z_parroquias_deleteTotalRecs = $z_parroquias_delete->Recordset->RecordCount(); // Get record count
if ($z_parroquias_deleteTotalRecs <= 0) { // No record found, exit
	if ($z_parroquias_delete->Recordset)
		$z_parroquias_delete->Recordset->Close();
	$z_parroquias_delete->Page_Terminate("z_parroquiaslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_parroquias->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_parroquias->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_parroquias_delete->ShowPageHeader(); ?>
<?php
$z_parroquias_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="z_parroquias">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($z_parroquias_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $z_parroquias->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $z_parroquias->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $z_parroquias->lf_parroquia_municipio->FldCaption() ?></td>
		<td valign="top"><?php echo $z_parroquias->visibilidad->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$z_parroquias_delete->RecCnt = 0;
$i = 0;
while (!$z_parroquias_delete->Recordset->EOF) {
	$z_parroquias_delete->RecCnt++;

	// Set row properties
	$z_parroquias->ResetAttrs();
	$z_parroquias->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$z_parroquias_delete->LoadRowValues($z_parroquias_delete->Recordset);

	// Render row
	$z_parroquias_delete->RenderRow();
?>
	<tr<?php echo $z_parroquias->RowAttributes() ?>>
		<td<?php echo $z_parroquias->nombre->CellAttributes() ?>>
<div<?php echo $z_parroquias->nombre->ViewAttributes() ?>><?php echo $z_parroquias->nombre->ListViewValue() ?></div></td>
		<td<?php echo $z_parroquias->lf_parroquia_municipio->CellAttributes() ?>>
<div<?php echo $z_parroquias->lf_parroquia_municipio->ViewAttributes() ?>><?php echo $z_parroquias->lf_parroquia_municipio->ListViewValue() ?></div></td>
		<td<?php echo $z_parroquias->visibilidad->CellAttributes() ?>>
<div<?php echo $z_parroquias->visibilidad->ViewAttributes() ?>><?php echo $z_parroquias->visibilidad->ListViewValue() ?></div></td>
	</tr>
<?php
	$z_parroquias_delete->Recordset->MoveNext();
}
$z_parroquias_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$z_parroquias_delete->ShowPageFooter();
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
$z_parroquias_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_parroquias_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = '_parroquias';

	// Page object name
	var $PageObjName = 'z_parroquias_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_parroquias;
		if ($z_parroquias->UseTokenInUrl) $PageUrl .= "t=" . $z_parroquias->TableVar . "&"; // Add page token
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
		global $objForm, $z_parroquias;
		if ($z_parroquias->UseTokenInUrl) {
			if ($objForm)
				return ($z_parroquias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_parroquias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_parroquias_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_parroquias)
		if (!isset($GLOBALS["z_parroquias"])) {
			$GLOBALS["z_parroquias"] = new cz_parroquias();
			$GLOBALS["Table"] =& $GLOBALS["z_parroquias"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_parroquias', TRUE);

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
		global $z_parroquias;

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
		global $Language, $z_parroquias;

		// Load key parameters
		$this->RecKeys = $z_parroquias->GetRecordKeys(); // Load record keys
		$sFilter = $z_parroquias->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("z_parroquiaslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in z_parroquias class, z_parroquiasinfo.php

		$z_parroquias->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$z_parroquias->CurrentAction = $_POST["a_delete"];
		} else {
			$z_parroquias->CurrentAction = "I"; // Display record
		}
		switch ($z_parroquias->CurrentAction) {
			case "D": // Delete
				$z_parroquias->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($z_parroquias->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_parroquias;

		// Call Recordset Selecting event
		$z_parroquias->Recordset_Selecting($z_parroquias->CurrentFilter);

		// Load List page SQL
		$sSql = $z_parroquias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_parroquias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_parroquias;
		$sFilter = $z_parroquias->KeyFilter();

		// Call Row Selecting event
		$z_parroquias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_parroquias->CurrentFilter = $sFilter;
		$sSql = $z_parroquias->SQL();
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
		global $conn, $z_parroquias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_parroquias->Row_Selected($row);
		$z_parroquias->lp_parroquia_id->setDbValue($rs->fields('lp_parroquia_id'));
		$z_parroquias->nombre->setDbValue($rs->fields('nombre'));
		$z_parroquias->lf_parroquia_municipio->setDbValue($rs->fields('lf_parroquia_municipio'));
		$z_parroquias->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_parroquias;

		// Initialize URLs
		// Call Row_Rendering event

		$z_parroquias->Row_Rendering();

		// Common render codes for all row types
		// lp_parroquia_id
		// nombre
		// lf_parroquia_municipio
		// visibilidad

		if ($z_parroquias->RowType == EW_ROWTYPE_VIEW) { // View row

			// lp_parroquia_id
			$z_parroquias->lp_parroquia_id->ViewValue = $z_parroquias->lp_parroquia_id->CurrentValue;
			$z_parroquias->lp_parroquia_id->ViewCustomAttributes = "";

			// nombre
			$z_parroquias->nombre->ViewValue = $z_parroquias->nombre->CurrentValue;
			$z_parroquias->nombre->ViewCustomAttributes = "";

			// lf_parroquia_municipio
			if (strval($z_parroquias->lf_parroquia_municipio->CurrentValue) <> "") {
				$sFilterWrk = "`lp_municipio_id` = '" . ew_AdjustSql($z_parroquias->lf_parroquia_municipio->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nombre` FROM `_municipios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_parroquias->lf_parroquia_municipio->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_parroquias->lf_parroquia_municipio->ViewValue = $z_parroquias->lf_parroquia_municipio->CurrentValue;
				}
			} else {
				$z_parroquias->lf_parroquia_municipio->ViewValue = NULL;
			}
			$z_parroquias->lf_parroquia_municipio->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_parroquias->visibilidad->CurrentValue) <> "") {
				switch ($z_parroquias->visibilidad->CurrentValue) {
					case "1":
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->FldTagCaption(1) <> "" ? $z_parroquias->visibilidad->FldTagCaption(1) : $z_parroquias->visibilidad->CurrentValue;
						break;
					case "0":
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->FldTagCaption(2) <> "" ? $z_parroquias->visibilidad->FldTagCaption(2) : $z_parroquias->visibilidad->CurrentValue;
						break;
					default:
						$z_parroquias->visibilidad->ViewValue = $z_parroquias->visibilidad->CurrentValue;
				}
			} else {
				$z_parroquias->visibilidad->ViewValue = NULL;
			}
			$z_parroquias->visibilidad->ViewCustomAttributes = "";

			// nombre
			$z_parroquias->nombre->LinkCustomAttributes = "";
			$z_parroquias->nombre->HrefValue = "";
			$z_parroquias->nombre->TooltipValue = "";

			// lf_parroquia_municipio
			$z_parroquias->lf_parroquia_municipio->LinkCustomAttributes = "";
			$z_parroquias->lf_parroquia_municipio->HrefValue = "";
			$z_parroquias->lf_parroquia_municipio->TooltipValue = "";

			// visibilidad
			$z_parroquias->visibilidad->LinkCustomAttributes = "";
			$z_parroquias->visibilidad->HrefValue = "";
			$z_parroquias->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_parroquias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_parroquias->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $z_parroquias;
		$DeleteRows = TRUE;
		$sSql = $z_parroquias->SQL();
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
				$DeleteRows = $z_parroquias->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['lp_parroquia_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($z_parroquias->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($z_parroquias->CancelMessage <> "") {
				$this->setFailureMessage($z_parroquias->CancelMessage);
				$z_parroquias->CancelMessage = "";
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
				$z_parroquias->Row_Deleted($row);
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
