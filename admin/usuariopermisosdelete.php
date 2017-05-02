<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariopermisosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuariopermisos_delete = new cusuariopermisos_delete();
$Page =& $usuariopermisos_delete;

// Page init
$usuariopermisos_delete->Page_Init();

// Page main
$usuariopermisos_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuariopermisos_delete = new ew_Page("usuariopermisos_delete");

// page properties
usuariopermisos_delete.PageID = "delete"; // page ID
usuariopermisos_delete.FormID = "fusuariopermisosdelete"; // form ID
var EW_PAGE_ID = usuariopermisos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuariopermisos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuariopermisos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuariopermisos_delete.ValidateRequired = false; // no JavaScript validation
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
if ($usuariopermisos_delete->Recordset = $usuariopermisos_delete->LoadRecordset())
	$usuariopermisos_deleteTotalRecs = $usuariopermisos_delete->Recordset->RecordCount(); // Get record count
if ($usuariopermisos_deleteTotalRecs <= 0) { // No record found, exit
	if ($usuariopermisos_delete->Recordset)
		$usuariopermisos_delete->Recordset->Close();
	$usuariopermisos_delete->Page_Terminate("usuariopermisoslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuariopermisos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuariopermisos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuariopermisos_delete->ShowPageHeader(); ?>
<?php
$usuariopermisos_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="usuariopermisos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($usuariopermisos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $usuariopermisos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $usuariopermisos->userlevelid->FldCaption() ?></td>
		<td valign="top"><?php echo $usuariopermisos->ztablename->FldCaption() ?></td>
		<td valign="top"><?php echo $usuariopermisos->permission->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$usuariopermisos_delete->RecCnt = 0;
$i = 0;
while (!$usuariopermisos_delete->Recordset->EOF) {
	$usuariopermisos_delete->RecCnt++;

	// Set row properties
	$usuariopermisos->ResetAttrs();
	$usuariopermisos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$usuariopermisos_delete->LoadRowValues($usuariopermisos_delete->Recordset);

	// Render row
	$usuariopermisos_delete->RenderRow();
?>
	<tr<?php echo $usuariopermisos->RowAttributes() ?>>
		<td<?php echo $usuariopermisos->userlevelid->CellAttributes() ?>>
<div<?php echo $usuariopermisos->userlevelid->ViewAttributes() ?>><?php echo $usuariopermisos->userlevelid->ListViewValue() ?></div></td>
		<td<?php echo $usuariopermisos->ztablename->CellAttributes() ?>>
<div<?php echo $usuariopermisos->ztablename->ViewAttributes() ?>><?php echo $usuariopermisos->ztablename->ListViewValue() ?></div></td>
		<td<?php echo $usuariopermisos->permission->CellAttributes() ?>>
<div<?php echo $usuariopermisos->permission->ViewAttributes() ?>><?php echo $usuariopermisos->permission->ListViewValue() ?></div></td>
	</tr>
<?php
	$usuariopermisos_delete->Recordset->MoveNext();
}
$usuariopermisos_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$usuariopermisos_delete->ShowPageFooter();
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
$usuariopermisos_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuariopermisos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'usuariopermisos';

	// Page object name
	var $PageObjName = 'usuariopermisos_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuariopermisos;
		if ($usuariopermisos->UseTokenInUrl) $PageUrl .= "t=" . $usuariopermisos->TableVar . "&"; // Add page token
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
		global $objForm, $usuariopermisos;
		if ($usuariopermisos->UseTokenInUrl) {
			if ($objForm)
				return ($usuariopermisos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuariopermisos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuariopermisos_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuariopermisos)
		if (!isset($GLOBALS["usuariopermisos"])) {
			$GLOBALS["usuariopermisos"] = new cusuariopermisos();
			$GLOBALS["Table"] =& $GLOBALS["usuariopermisos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuariopermisos', TRUE);

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
		global $usuariopermisos;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $Language, $usuariopermisos;

		// Load key parameters
		$this->RecKeys = $usuariopermisos->GetRecordKeys(); // Load record keys
		$sFilter = $usuariopermisos->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("usuariopermisoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in usuariopermisos class, usuariopermisosinfo.php

		$usuariopermisos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$usuariopermisos->CurrentAction = $_POST["a_delete"];
		} else {
			$usuariopermisos->CurrentAction = "I"; // Display record
		}
		switch ($usuariopermisos->CurrentAction) {
			case "D": // Delete
				$usuariopermisos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($usuariopermisos->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuariopermisos;

		// Call Recordset Selecting event
		$usuariopermisos->Recordset_Selecting($usuariopermisos->CurrentFilter);

		// Load List page SQL
		$sSql = $usuariopermisos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$usuariopermisos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuariopermisos;
		$sFilter = $usuariopermisos->KeyFilter();

		// Call Row Selecting event
		$usuariopermisos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuariopermisos->CurrentFilter = $sFilter;
		$sSql = $usuariopermisos->SQL();
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
		global $conn, $usuariopermisos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuariopermisos->Row_Selected($row);
		$usuariopermisos->userlevelid->setDbValue($rs->fields('userlevelid'));
		$usuariopermisos->ztablename->setDbValue($rs->fields('tablename'));
		$usuariopermisos->permission->setDbValue($rs->fields('permission'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuariopermisos;

		// Initialize URLs
		// Call Row_Rendering event

		$usuariopermisos->Row_Rendering();

		// Common render codes for all row types
		// userlevelid
		// tablename
		// permission

		if ($usuariopermisos->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$usuariopermisos->userlevelid->ViewValue = $usuariopermisos->userlevelid->CurrentValue;
			$usuariopermisos->userlevelid->ViewCustomAttributes = "";

			// tablename
			$usuariopermisos->ztablename->ViewValue = $usuariopermisos->ztablename->CurrentValue;
			$usuariopermisos->ztablename->ViewCustomAttributes = "";

			// permission
			if (strval($usuariopermisos->permission->CurrentValue) <> "") {
				$arwrk = explode(",", $usuariopermisos->permission->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`userlevelid` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `userlevelname` FROM `usuarioniveles`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$usuariopermisos->permission->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$usuariopermisos->permission->ViewValue .= $rswrk->fields('userlevelname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $usuariopermisos->permission->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$usuariopermisos->permission->ViewValue = $usuariopermisos->permission->CurrentValue;
				}
			} else {
				$usuariopermisos->permission->ViewValue = NULL;
			}
			$usuariopermisos->permission->ViewCustomAttributes = "";

			// userlevelid
			$usuariopermisos->userlevelid->LinkCustomAttributes = "";
			$usuariopermisos->userlevelid->HrefValue = "";
			$usuariopermisos->userlevelid->TooltipValue = "";

			// tablename
			$usuariopermisos->ztablename->LinkCustomAttributes = "";
			$usuariopermisos->ztablename->HrefValue = "";
			$usuariopermisos->ztablename->TooltipValue = "";

			// permission
			$usuariopermisos->permission->LinkCustomAttributes = "";
			$usuariopermisos->permission->HrefValue = "";
			$usuariopermisos->permission->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuariopermisos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuariopermisos->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $usuariopermisos;
		$DeleteRows = TRUE;
		$sSql = $usuariopermisos->SQL();
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
				$DeleteRows = $usuariopermisos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['userlevelid'];
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['tablename'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($usuariopermisos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($usuariopermisos->CancelMessage <> "") {
				$this->setFailureMessage($usuariopermisos->CancelMessage);
				$usuariopermisos->CancelMessage = "";
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
				$usuariopermisos->Row_Deleted($row);
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
