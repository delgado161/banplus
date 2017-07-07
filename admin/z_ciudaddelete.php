<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_ciudadinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_ciudad_delete = new cz_ciudad_delete();
$Page =& $z_ciudad_delete;

// Page init
$z_ciudad_delete->Page_Init();

// Page main
$z_ciudad_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var z_ciudad_delete = new ew_Page("z_ciudad_delete");

// page properties
z_ciudad_delete.PageID = "delete"; // page ID
z_ciudad_delete.FormID = "fz_ciudaddelete"; // form ID
var EW_PAGE_ID = z_ciudad_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_ciudad_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_ciudad_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_ciudad_delete.ValidateRequired = false; // no JavaScript validation
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
if ($z_ciudad_delete->Recordset = $z_ciudad_delete->LoadRecordset())
	$z_ciudad_deleteTotalRecs = $z_ciudad_delete->Recordset->RecordCount(); // Get record count
if ($z_ciudad_deleteTotalRecs <= 0) { // No record found, exit
	if ($z_ciudad_delete->Recordset)
		$z_ciudad_delete->Recordset->Close();
	$z_ciudad_delete->Page_Terminate("z_ciudadlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_ciudad->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $z_ciudad->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $z_ciudad_delete->ShowPageHeader(); ?>
<?php
$z_ciudad_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="z_ciudad">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($z_ciudad_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $z_ciudad->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $z_ciudad->id_ciudad->FldCaption() ?></td>
		<td valign="top"><?php echo $z_ciudad->lf_estado->FldCaption() ?></td>
		<td valign="top"><?php echo $z_ciudad->id_banplus->FldCaption() ?></td>
		<td valign="top"><?php echo $z_ciudad->ciudad->FldCaption() ?></td>
		<td valign="top"><?php echo $z_ciudad->visibilidad->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$z_ciudad_delete->RecCnt = 0;
$i = 0;
while (!$z_ciudad_delete->Recordset->EOF) {
	$z_ciudad_delete->RecCnt++;

	// Set row properties
	$z_ciudad->ResetAttrs();
	$z_ciudad->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$z_ciudad_delete->LoadRowValues($z_ciudad_delete->Recordset);

	// Render row
	$z_ciudad_delete->RenderRow();
?>
	<tr<?php echo $z_ciudad->RowAttributes() ?>>
		<td<?php echo $z_ciudad->id_ciudad->CellAttributes() ?>>
<div<?php echo $z_ciudad->id_ciudad->ViewAttributes() ?>><?php echo $z_ciudad->id_ciudad->ListViewValue() ?></div></td>
		<td<?php echo $z_ciudad->lf_estado->CellAttributes() ?>>
<div<?php echo $z_ciudad->lf_estado->ViewAttributes() ?>><?php echo $z_ciudad->lf_estado->ListViewValue() ?></div></td>
		<td<?php echo $z_ciudad->id_banplus->CellAttributes() ?>>
<div<?php echo $z_ciudad->id_banplus->ViewAttributes() ?>><?php echo $z_ciudad->id_banplus->ListViewValue() ?></div></td>
		<td<?php echo $z_ciudad->ciudad->CellAttributes() ?>>
<div<?php echo $z_ciudad->ciudad->ViewAttributes() ?>><?php echo $z_ciudad->ciudad->ListViewValue() ?></div></td>
		<td<?php echo $z_ciudad->visibilidad->CellAttributes() ?>>
<div<?php echo $z_ciudad->visibilidad->ViewAttributes() ?>><?php echo $z_ciudad->visibilidad->ListViewValue() ?></div></td>
	</tr>
<?php
	$z_ciudad_delete->Recordset->MoveNext();
}
$z_ciudad_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$z_ciudad_delete->ShowPageFooter();
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
$z_ciudad_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_ciudad_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = '_ciudad';

	// Page object name
	var $PageObjName = 'z_ciudad_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_ciudad;
		if ($z_ciudad->UseTokenInUrl) $PageUrl .= "t=" . $z_ciudad->TableVar . "&"; // Add page token
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
		global $objForm, $z_ciudad;
		if ($z_ciudad->UseTokenInUrl) {
			if ($objForm)
				return ($z_ciudad->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_ciudad->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_ciudad_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_ciudad)
		if (!isset($GLOBALS["z_ciudad"])) {
			$GLOBALS["z_ciudad"] = new cz_ciudad();
			$GLOBALS["Table"] =& $GLOBALS["z_ciudad"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_ciudad', TRUE);

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
		global $z_ciudad;

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
		global $Language, $z_ciudad;

		// Load key parameters
		$this->RecKeys = $z_ciudad->GetRecordKeys(); // Load record keys
		$sFilter = $z_ciudad->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("z_ciudadlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in z_ciudad class, z_ciudadinfo.php

		$z_ciudad->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$z_ciudad->CurrentAction = $_POST["a_delete"];
		} else {
			$z_ciudad->CurrentAction = "I"; // Display record
		}
		switch ($z_ciudad->CurrentAction) {
			case "D": // Delete
				$z_ciudad->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($z_ciudad->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_ciudad;

		// Call Recordset Selecting event
		$z_ciudad->Recordset_Selecting($z_ciudad->CurrentFilter);

		// Load List page SQL
		$sSql = $z_ciudad->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_ciudad->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_ciudad;
		$sFilter = $z_ciudad->KeyFilter();

		// Call Row Selecting event
		$z_ciudad->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_ciudad->CurrentFilter = $sFilter;
		$sSql = $z_ciudad->SQL();
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
		global $conn, $z_ciudad;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_ciudad->Row_Selected($row);
		$z_ciudad->id_ciudad->setDbValue($rs->fields('id_ciudad'));
		$z_ciudad->lf_estado->setDbValue($rs->fields('lf_estado'));
		$z_ciudad->id_banplus->setDbValue($rs->fields('id_banplus'));
		$z_ciudad->ciudad->setDbValue($rs->fields('ciudad'));
		$z_ciudad->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_ciudad;

		// Initialize URLs
		// Call Row_Rendering event

		$z_ciudad->Row_Rendering();

		// Common render codes for all row types
		// id_ciudad
		// lf_estado
		// id_banplus
		// ciudad
		// visibilidad

		if ($z_ciudad->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_ciudad
			$z_ciudad->id_ciudad->ViewValue = $z_ciudad->id_ciudad->CurrentValue;
			$z_ciudad->id_ciudad->ViewCustomAttributes = "";

			// lf_estado
			if (strval($z_ciudad->lf_estado->CurrentValue) <> "") {
				$sFilterWrk = "`id2_estado` = " . ew_AdjustSql($z_ciudad->lf_estado->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `_estados`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$z_ciudad->lf_estado->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$z_ciudad->lf_estado->ViewValue = $z_ciudad->lf_estado->CurrentValue;
				}
			} else {
				$z_ciudad->lf_estado->ViewValue = NULL;
			}
			$z_ciudad->lf_estado->ViewCustomAttributes = "";

			// id_banplus
			$z_ciudad->id_banplus->ViewValue = $z_ciudad->id_banplus->CurrentValue;
			$z_ciudad->id_banplus->ViewCustomAttributes = "";

			// ciudad
			$z_ciudad->ciudad->ViewValue = $z_ciudad->ciudad->CurrentValue;
			$z_ciudad->ciudad->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_ciudad->visibilidad->CurrentValue) <> "") {
				switch ($z_ciudad->visibilidad->CurrentValue) {
					case "1":
						$z_ciudad->visibilidad->ViewValue = $z_ciudad->visibilidad->FldTagCaption(1) <> "" ? $z_ciudad->visibilidad->FldTagCaption(1) : $z_ciudad->visibilidad->CurrentValue;
						break;
					case "0":
						$z_ciudad->visibilidad->ViewValue = $z_ciudad->visibilidad->FldTagCaption(2) <> "" ? $z_ciudad->visibilidad->FldTagCaption(2) : $z_ciudad->visibilidad->CurrentValue;
						break;
					default:
						$z_ciudad->visibilidad->ViewValue = $z_ciudad->visibilidad->CurrentValue;
				}
			} else {
				$z_ciudad->visibilidad->ViewValue = NULL;
			}
			$z_ciudad->visibilidad->ViewCustomAttributes = "";

			// id_ciudad
			$z_ciudad->id_ciudad->LinkCustomAttributes = "";
			$z_ciudad->id_ciudad->HrefValue = "";
			$z_ciudad->id_ciudad->TooltipValue = "";

			// lf_estado
			$z_ciudad->lf_estado->LinkCustomAttributes = "";
			$z_ciudad->lf_estado->HrefValue = "";
			$z_ciudad->lf_estado->TooltipValue = "";

			// id_banplus
			$z_ciudad->id_banplus->LinkCustomAttributes = "";
			$z_ciudad->id_banplus->HrefValue = "";
			$z_ciudad->id_banplus->TooltipValue = "";

			// ciudad
			$z_ciudad->ciudad->LinkCustomAttributes = "";
			$z_ciudad->ciudad->HrefValue = "";
			$z_ciudad->ciudad->TooltipValue = "";

			// visibilidad
			$z_ciudad->visibilidad->LinkCustomAttributes = "";
			$z_ciudad->visibilidad->HrefValue = "";
			$z_ciudad->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_ciudad->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_ciudad->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $z_ciudad;
		$DeleteRows = TRUE;
		$sSql = $z_ciudad->SQL();
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
				$DeleteRows = $z_ciudad->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_ciudad'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($z_ciudad->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($z_ciudad->CancelMessage <> "") {
				$this->setFailureMessage($z_ciudad->CancelMessage);
				$z_ciudad->CancelMessage = "";
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
				$z_ciudad->Row_Deleted($row);
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
