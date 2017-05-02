<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memoria_semestralinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memoria_semestral_delete = new cmemoria_semestral_delete();
$Page =& $memoria_semestral_delete;

// Page init
$memoria_semestral_delete->Page_Init();

// Page main
$memoria_semestral_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var memoria_semestral_delete = new ew_Page("memoria_semestral_delete");

// page properties
memoria_semestral_delete.PageID = "delete"; // page ID
memoria_semestral_delete.FormID = "fmemoria_semestraldelete"; // form ID
var EW_PAGE_ID = memoria_semestral_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
memoria_semestral_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
memoria_semestral_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memoria_semestral_delete.ValidateRequired = false; // no JavaScript validation
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
if ($memoria_semestral_delete->Recordset = $memoria_semestral_delete->LoadRecordset())
	$memoria_semestral_deleteTotalRecs = $memoria_semestral_delete->Recordset->RecordCount(); // Get record count
if ($memoria_semestral_deleteTotalRecs <= 0) { // No record found, exit
	if ($memoria_semestral_delete->Recordset)
		$memoria_semestral_delete->Recordset->Close();
	$memoria_semestral_delete->Page_Terminate("memoria_semestrallist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memoria_semestral->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $memoria_semestral->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $memoria_semestral_delete->ShowPageHeader(); ?>
<?php
$memoria_semestral_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="memoria_semestral">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($memoria_semestral_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $memoria_semestral->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $memoria_semestral->id_memoria_semestral->FldCaption() ?></td>
		<td valign="top"><?php echo $memoria_semestral->ano->FldCaption() ?></td>
		<td valign="top"><?php echo $memoria_semestral->mes->FldCaption() ?></td>
		<td valign="top"><?php echo $memoria_semestral->archivo->FldCaption() ?></td>
		<td valign="top"><?php echo $memoria_semestral->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$memoria_semestral_delete->RecCnt = 0;
$i = 0;
while (!$memoria_semestral_delete->Recordset->EOF) {
	$memoria_semestral_delete->RecCnt++;

	// Set row properties
	$memoria_semestral->ResetAttrs();
	$memoria_semestral->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$memoria_semestral_delete->LoadRowValues($memoria_semestral_delete->Recordset);

	// Render row
	$memoria_semestral_delete->RenderRow();
?>
	<tr<?php echo $memoria_semestral->RowAttributes() ?>>
		<td<?php echo $memoria_semestral->id_memoria_semestral->CellAttributes() ?>>
<div<?php echo $memoria_semestral->id_memoria_semestral->ViewAttributes() ?>><?php echo $memoria_semestral->id_memoria_semestral->ListViewValue() ?></div></td>
		<td<?php echo $memoria_semestral->ano->CellAttributes() ?>>
<div<?php echo $memoria_semestral->ano->ViewAttributes() ?>><?php echo $memoria_semestral->ano->ListViewValue() ?></div></td>
		<td<?php echo $memoria_semestral->mes->CellAttributes() ?>>
<div<?php echo $memoria_semestral->mes->ViewAttributes() ?>><?php echo $memoria_semestral->mes->ListViewValue() ?></div></td>
		<td<?php echo $memoria_semestral->archivo->CellAttributes() ?>>
<?php if ($memoria_semestral->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($memoria_semestral->archivo->Upload->DbValue)) { ?>
<a<?php echo $memoria_semestral->archivo->LinkAttributes() ?>><?php echo $memoria_semestral->archivo->ListViewValue() ?></a>
<?php } elseif (!in_array($memoria_semestral->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($memoria_semestral->archivo->Upload->DbValue)) { ?>
<?php echo $memoria_semestral->archivo->ListViewValue() ?>
<?php } elseif (!in_array($memoria_semestral->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $memoria_semestral->estatus->CellAttributes() ?>>
<div<?php echo $memoria_semestral->estatus->ViewAttributes() ?>><?php echo $memoria_semestral->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$memoria_semestral_delete->Recordset->MoveNext();
}
$memoria_semestral_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$memoria_semestral_delete->ShowPageFooter();
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
$memoria_semestral_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemoria_semestral_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'memoria_semestral';

	// Page object name
	var $PageObjName = 'memoria_semestral_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memoria_semestral;
		if ($memoria_semestral->UseTokenInUrl) $PageUrl .= "t=" . $memoria_semestral->TableVar . "&"; // Add page token
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
		global $objForm, $memoria_semestral;
		if ($memoria_semestral->UseTokenInUrl) {
			if ($objForm)
				return ($memoria_semestral->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memoria_semestral->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemoria_semestral_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memoria_semestral)
		if (!isset($GLOBALS["memoria_semestral"])) {
			$GLOBALS["memoria_semestral"] = new cmemoria_semestral();
			$GLOBALS["Table"] =& $GLOBALS["memoria_semestral"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memoria_semestral', TRUE);

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
		global $memoria_semestral;

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
		global $Language, $memoria_semestral;

		// Load key parameters
		$this->RecKeys = $memoria_semestral->GetRecordKeys(); // Load record keys
		$sFilter = $memoria_semestral->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("memoria_semestrallist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in memoria_semestral class, memoria_semestralinfo.php

		$memoria_semestral->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$memoria_semestral->CurrentAction = $_POST["a_delete"];
		} else {
			$memoria_semestral->CurrentAction = "I"; // Display record
		}
		switch ($memoria_semestral->CurrentAction) {
			case "D": // Delete
				$memoria_semestral->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($memoria_semestral->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $memoria_semestral;

		// Call Recordset Selecting event
		$memoria_semestral->Recordset_Selecting($memoria_semestral->CurrentFilter);

		// Load List page SQL
		$sSql = $memoria_semestral->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$memoria_semestral->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memoria_semestral;
		$sFilter = $memoria_semestral->KeyFilter();

		// Call Row Selecting event
		$memoria_semestral->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memoria_semestral->CurrentFilter = $sFilter;
		$sSql = $memoria_semestral->SQL();
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
		global $conn, $memoria_semestral;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memoria_semestral->Row_Selected($row);
		$memoria_semestral->id_memoria_semestral->setDbValue($rs->fields('id_memoria_semestral'));
		$memoria_semestral->ano->setDbValue($rs->fields('ano'));
		$memoria_semestral->mes->setDbValue($rs->fields('mes'));
		$memoria_semestral->archivo->Upload->DbValue = $rs->fields('archivo');
		$memoria_semestral->estatus->setDbValue($rs->fields('estatus'));
		$memoria_semestral->memoria_s->setDbValue($rs->fields('memoria_s'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memoria_semestral;

		// Initialize URLs
		// Call Row_Rendering event

		$memoria_semestral->Row_Rendering();

		// Common render codes for all row types
		// id_memoria_semestral
		// ano
		// mes
		// archivo
		// estatus
		// memoria_s

		$memoria_semestral->memoria_s->CellCssStyle = "white-space: nowrap;";
		if ($memoria_semestral->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_memoria_semestral
			$memoria_semestral->id_memoria_semestral->ViewValue = $memoria_semestral->id_memoria_semestral->CurrentValue;
			$memoria_semestral->id_memoria_semestral->ViewCustomAttributes = "";

			// ano
			$memoria_semestral->ano->ViewValue = $memoria_semestral->ano->CurrentValue;
			$memoria_semestral->ano->ViewCustomAttributes = "";

			// mes
			if (strval($memoria_semestral->mes->CurrentValue) <> "") {
				switch ($memoria_semestral->mes->CurrentValue) {
					case "1":
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->FldTagCaption(1) <> "" ? $memoria_semestral->mes->FldTagCaption(1) : $memoria_semestral->mes->CurrentValue;
						break;
					case "2":
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->FldTagCaption(2) <> "" ? $memoria_semestral->mes->FldTagCaption(2) : $memoria_semestral->mes->CurrentValue;
						break;
					default:
						$memoria_semestral->mes->ViewValue = $memoria_semestral->mes->CurrentValue;
				}
			} else {
				$memoria_semestral->mes->ViewValue = NULL;
			}
			$memoria_semestral->mes->ViewCustomAttributes = "";

			// archivo
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->ViewValue = $memoria_semestral->archivo->Upload->DbValue;
			} else {
				$memoria_semestral->archivo->ViewValue = "";
			}
			$memoria_semestral->archivo->ViewCustomAttributes = "";

			// estatus
			if (strval($memoria_semestral->estatus->CurrentValue) <> "") {
				switch ($memoria_semestral->estatus->CurrentValue) {
					case "1":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(1) <> "" ? $memoria_semestral->estatus->FldTagCaption(1) : $memoria_semestral->estatus->CurrentValue;
						break;
					case "0":
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->FldTagCaption(2) <> "" ? $memoria_semestral->estatus->FldTagCaption(2) : $memoria_semestral->estatus->CurrentValue;
						break;
					default:
						$memoria_semestral->estatus->ViewValue = $memoria_semestral->estatus->CurrentValue;
				}
			} else {
				$memoria_semestral->estatus->ViewValue = NULL;
			}
			$memoria_semestral->estatus->ViewCustomAttributes = "";

			// id_memoria_semestral
			$memoria_semestral->id_memoria_semestral->LinkCustomAttributes = "";
			$memoria_semestral->id_memoria_semestral->HrefValue = "";
			$memoria_semestral->id_memoria_semestral->TooltipValue = "";

			// ano
			$memoria_semestral->ano->LinkCustomAttributes = "";
			$memoria_semestral->ano->HrefValue = "";
			$memoria_semestral->ano->TooltipValue = "";

			// mes
			$memoria_semestral->mes->LinkCustomAttributes = "";
			$memoria_semestral->mes->HrefValue = "";
			$memoria_semestral->mes->TooltipValue = "";

			// archivo
			$memoria_semestral->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($memoria_semestral->archivo->Upload->DbValue)) {
				$memoria_semestral->archivo->HrefValue = ew_UploadPathEx(FALSE, $memoria_semestral->archivo->UploadPath) . ((!empty($memoria_semestral->archivo->ViewValue)) ? $memoria_semestral->archivo->ViewValue : $memoria_semestral->archivo->CurrentValue); // Add prefix/suffix
				$memoria_semestral->archivo->LinkAttrs["target"] = ""; // Add target
				if ($memoria_semestral->Export <> "") $memoria_semestral->archivo->HrefValue = ew_ConvertFullUrl($memoria_semestral->archivo->HrefValue);
			} else {
				$memoria_semestral->archivo->HrefValue = "";
			}
			$memoria_semestral->archivo->TooltipValue = "";

			// estatus
			$memoria_semestral->estatus->LinkCustomAttributes = "";
			$memoria_semestral->estatus->HrefValue = "";
			$memoria_semestral->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($memoria_semestral->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memoria_semestral->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $memoria_semestral;
		$DeleteRows = TRUE;
		$sSql = $memoria_semestral->SQL();
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
				$DeleteRows = $memoria_semestral->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_memoria_semestral'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($memoria_semestral->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($memoria_semestral->CancelMessage <> "") {
				$this->setFailureMessage($memoria_semestral->CancelMessage);
				$memoria_semestral->CancelMessage = "";
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
				$memoria_semestral->Row_Deleted($row);
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
