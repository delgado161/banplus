<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_estadosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_estados_delete = new cz_estados_delete();
$Page =& $z_estados_delete;

// Page init
$z_estados_delete->Page_Init();

// Page main
$z_estados_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_estados_delete = new ew_Page("z_estados_delete");

// page properties
z_estados_delete.PageID = "delete"; // page ID
z_estados_delete.FormID = "fz_estadosdelete"; // form ID
var EW_PAGE_ID = z_estados_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_estados_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_estados_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_estados_delete.ValidateRequired = false; // no JavaScript validation
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
if ($z_estados_delete->Recordset = $z_estados_delete->LoadRecordset())
	$z_estados_deleteTotalRecs = $z_estados_delete->Recordset->RecordCount(); // Get record count
if ($z_estados_deleteTotalRecs <= 0) { // No record found, exit
	if ($z_estados_delete->Recordset)
		$z_estados_delete->Recordset->Close();
	$z_estados_delete->Page_Terminate("z_estadoslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_estados->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_estados->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_estados_delete->ShowPageHeader(); ?>
<?php
$z_estados_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="z_estados">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($z_estados_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $z_estados->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $z_estados->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $z_estados->lf_estado_pais->FldCaption() ?></td>
		<td valign="top"><?php echo $z_estados->visibilidad->FldCaption() ?></td>
		<td valign="top"><?php echo $z_estados->id2_estado->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$z_estados_delete->RecCnt = 0;
$i = 0;
while (!$z_estados_delete->Recordset->EOF) {
	$z_estados_delete->RecCnt++;

	// Set row properties
	$z_estados->ResetAttrs();
	$z_estados->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$z_estados_delete->LoadRowValues($z_estados_delete->Recordset);

	// Render row
	$z_estados_delete->RenderRow();
?>
	<tr<?php echo $z_estados->RowAttributes() ?>>
		<td<?php echo $z_estados->nombre->CellAttributes() ?>>
<div<?php echo $z_estados->nombre->ViewAttributes() ?>><?php echo $z_estados->nombre->ListViewValue() ?></div></td>
		<td<?php echo $z_estados->lf_estado_pais->CellAttributes() ?>>
<div<?php echo $z_estados->lf_estado_pais->ViewAttributes() ?>><?php echo $z_estados->lf_estado_pais->ListViewValue() ?></div></td>
		<td<?php echo $z_estados->visibilidad->CellAttributes() ?>>
<div<?php echo $z_estados->visibilidad->ViewAttributes() ?>><?php echo $z_estados->visibilidad->ListViewValue() ?></div></td>
		<td<?php echo $z_estados->id2_estado->CellAttributes() ?>>
<div<?php echo $z_estados->id2_estado->ViewAttributes() ?>><?php echo $z_estados->id2_estado->ListViewValue() ?></div></td>
	</tr>
<?php
	$z_estados_delete->Recordset->MoveNext();
}
$z_estados_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$z_estados_delete->ShowPageFooter();
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
$z_estados_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_estados_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = '_estados';

	// Page object name
	var $PageObjName = 'z_estados_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_estados;
		if ($z_estados->UseTokenInUrl) $PageUrl .= "t=" . $z_estados->TableVar . "&"; // Add page token
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
		global $objForm, $z_estados;
		if ($z_estados->UseTokenInUrl) {
			if ($objForm)
				return ($z_estados->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_estados->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_estados_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_estados)
		if (!isset($GLOBALS["z_estados"])) {
			$GLOBALS["z_estados"] = new cz_estados();
			$GLOBALS["Table"] =& $GLOBALS["z_estados"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_estados', TRUE);

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
		global $z_estados;

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
		global $Language, $z_estados;

		// Load key parameters
		$this->RecKeys = $z_estados->GetRecordKeys(); // Load record keys
		$sFilter = $z_estados->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("z_estadoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in z_estados class, z_estadosinfo.php

		$z_estados->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$z_estados->CurrentAction = $_POST["a_delete"];
		} else {
			$z_estados->CurrentAction = "I"; // Display record
		}
		switch ($z_estados->CurrentAction) {
			case "D": // Delete
				$z_estados->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($z_estados->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_estados;

		// Call Recordset Selecting event
		$z_estados->Recordset_Selecting($z_estados->CurrentFilter);

		// Load List page SQL
		$sSql = $z_estados->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_estados->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_estados;
		$sFilter = $z_estados->KeyFilter();

		// Call Row Selecting event
		$z_estados->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_estados->CurrentFilter = $sFilter;
		$sSql = $z_estados->SQL();
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
		global $conn, $z_estados;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_estados->Row_Selected($row);
		$z_estados->nombre->setDbValue($rs->fields('nombre'));
		$z_estados->lf_estado_pais->setDbValue($rs->fields('lf_estado_pais'));
		$z_estados->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_estados->id2_estado->setDbValue($rs->fields('id2_estado'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_estados;

		// Initialize URLs
		// Call Row_Rendering event

		$z_estados->Row_Rendering();

		// Common render codes for all row types
		// nombre
		// lf_estado_pais
		// visibilidad
		// id2_estado

		if ($z_estados->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$z_estados->nombre->ViewValue = $z_estados->nombre->CurrentValue;
			$z_estados->nombre->ViewCustomAttributes = "";

			// lf_estado_pais
			if (strval($z_estados->lf_estado_pais->CurrentValue) <> "") {
				$sFilterWrk = "`lp_pais_id` = '" . ew_AdjustSql($z_estados->lf_estado_pais->CurrentValue) . "'";
			$sSqlWrk = "SELECT `nombre` FROM `_paises`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_estados->lf_estado_pais->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_estados->lf_estado_pais->ViewValue = $z_estados->lf_estado_pais->CurrentValue;
				}
			} else {
				$z_estados->lf_estado_pais->ViewValue = NULL;
			}
			$z_estados->lf_estado_pais->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_estados->visibilidad->CurrentValue) <> "") {
				switch ($z_estados->visibilidad->CurrentValue) {
					case "1":
						$z_estados->visibilidad->ViewValue = $z_estados->visibilidad->FldTagCaption(1) <> "" ? $z_estados->visibilidad->FldTagCaption(1) : $z_estados->visibilidad->CurrentValue;
						break;
					case "0":
						$z_estados->visibilidad->ViewValue = $z_estados->visibilidad->FldTagCaption(2) <> "" ? $z_estados->visibilidad->FldTagCaption(2) : $z_estados->visibilidad->CurrentValue;
						break;
					default:
						$z_estados->visibilidad->ViewValue = $z_estados->visibilidad->CurrentValue;
				}
			} else {
				$z_estados->visibilidad->ViewValue = NULL;
			}
			$z_estados->visibilidad->ViewCustomAttributes = "";

			// id2_estado
			$z_estados->id2_estado->ViewValue = $z_estados->id2_estado->CurrentValue;
			$z_estados->id2_estado->ViewCustomAttributes = "";

			// nombre
			$z_estados->nombre->LinkCustomAttributes = "";
			$z_estados->nombre->HrefValue = "";
			$z_estados->nombre->TooltipValue = "";

			// lf_estado_pais
			$z_estados->lf_estado_pais->LinkCustomAttributes = "";
			$z_estados->lf_estado_pais->HrefValue = "";
			$z_estados->lf_estado_pais->TooltipValue = "";

			// visibilidad
			$z_estados->visibilidad->LinkCustomAttributes = "";
			$z_estados->visibilidad->HrefValue = "";
			$z_estados->visibilidad->TooltipValue = "";

			// id2_estado
			$z_estados->id2_estado->LinkCustomAttributes = "";
			$z_estados->id2_estado->HrefValue = "";
			$z_estados->id2_estado->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_estados->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_estados->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $z_estados;
		$DeleteRows = TRUE;
		$sSql = $z_estados->SQL();
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
				$DeleteRows = $z_estados->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id2_estado'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($z_estados->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($z_estados->CancelMessage <> "") {
				$this->setFailureMessage($z_estados->CancelMessage);
				$z_estados->CancelMessage = "";
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
				$z_estados->Row_Deleted($row);
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
