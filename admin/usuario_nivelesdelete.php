<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuario_nivelesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuario_niveles_delete = new cusuario_niveles_delete();
$Page =& $usuario_niveles_delete;

// Page init
$usuario_niveles_delete->Page_Init();

// Page main
$usuario_niveles_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuario_niveles_delete = new ew_Page("usuario_niveles_delete");

// page properties
usuario_niveles_delete.PageID = "delete"; // page ID
usuario_niveles_delete.FormID = "fusuario_nivelesdelete"; // form ID
var EW_PAGE_ID = usuario_niveles_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuario_niveles_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuario_niveles_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuario_niveles_delete.ValidateRequired = false; // no JavaScript validation
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
if ($usuario_niveles_delete->Recordset = $usuario_niveles_delete->LoadRecordset())
	$usuario_niveles_deleteTotalRecs = $usuario_niveles_delete->Recordset->RecordCount(); // Get record count
if ($usuario_niveles_deleteTotalRecs <= 0) { // No record found, exit
	if ($usuario_niveles_delete->Recordset)
		$usuario_niveles_delete->Recordset->Close();
	$usuario_niveles_delete->Page_Terminate("usuario_niveleslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuario_niveles->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuario_niveles->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuario_niveles_delete->ShowPageHeader(); ?>
<?php
$usuario_niveles_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="usuario_niveles">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($usuario_niveles_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $usuario_niveles->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $usuario_niveles->UserLevelID->FldCaption() ?></td>
		<td valign="top"><?php echo $usuario_niveles->nombre->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$usuario_niveles_delete->RecCnt = 0;
$i = 0;
while (!$usuario_niveles_delete->Recordset->EOF) {
	$usuario_niveles_delete->RecCnt++;

	// Set row properties
	$usuario_niveles->ResetAttrs();
	$usuario_niveles->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$usuario_niveles_delete->LoadRowValues($usuario_niveles_delete->Recordset);

	// Render row
	$usuario_niveles_delete->RenderRow();
?>
	<tr<?php echo $usuario_niveles->RowAttributes() ?>>
		<td<?php echo $usuario_niveles->UserLevelID->CellAttributes() ?>>
<div<?php echo $usuario_niveles->UserLevelID->ViewAttributes() ?>><?php echo $usuario_niveles->UserLevelID->ListViewValue() ?></div></td>
		<td<?php echo $usuario_niveles->nombre->CellAttributes() ?>>
<div<?php echo $usuario_niveles->nombre->ViewAttributes() ?>><?php echo $usuario_niveles->nombre->ListViewValue() ?></div></td>
	</tr>
<?php
	$usuario_niveles_delete->Recordset->MoveNext();
}
$usuario_niveles_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$usuario_niveles_delete->ShowPageFooter();
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
$usuario_niveles_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuario_niveles_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'usuario_niveles';

	// Page object name
	var $PageObjName = 'usuario_niveles_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuario_niveles;
		if ($usuario_niveles->UseTokenInUrl) $PageUrl .= "t=" . $usuario_niveles->TableVar . "&"; // Add page token
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
		global $objForm, $usuario_niveles;
		if ($usuario_niveles->UseTokenInUrl) {
			if ($objForm)
				return ($usuario_niveles->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuario_niveles->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuario_niveles_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuario_niveles)
		if (!isset($GLOBALS["usuario_niveles"])) {
			$GLOBALS["usuario_niveles"] = new cusuario_niveles();
			$GLOBALS["Table"] =& $GLOBALS["usuario_niveles"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuario_niveles', TRUE);

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
		global $usuario_niveles;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
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
		global $Language, $usuario_niveles;

		// Load key parameters
		$this->RecKeys = $usuario_niveles->GetRecordKeys(); // Load record keys
		$sFilter = $usuario_niveles->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("usuario_niveleslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in usuario_niveles class, usuario_nivelesinfo.php

		$usuario_niveles->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$usuario_niveles->CurrentAction = $_POST["a_delete"];
		} else {
			$usuario_niveles->CurrentAction = "I"; // Display record
		}
		switch ($usuario_niveles->CurrentAction) {
			case "D": // Delete
				$usuario_niveles->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($usuario_niveles->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuario_niveles;

		// Call Recordset Selecting event
		$usuario_niveles->Recordset_Selecting($usuario_niveles->CurrentFilter);

		// Load List page SQL
		$sSql = $usuario_niveles->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$usuario_niveles->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuario_niveles;
		$sFilter = $usuario_niveles->KeyFilter();

		// Call Row Selecting event
		$usuario_niveles->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuario_niveles->CurrentFilter = $sFilter;
		$sSql = $usuario_niveles->SQL();
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
		global $conn, $usuario_niveles;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuario_niveles->Row_Selected($row);
		$usuario_niveles->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$usuario_niveles->nombre->setDbValue($rs->fields('nombre'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuario_niveles;

		// Initialize URLs
		// Call Row_Rendering event

		$usuario_niveles->Row_Rendering();

		// Common render codes for all row types
		// UserLevelID
		// nombre

		if ($usuario_niveles->RowType == EW_ROWTYPE_VIEW) { // View row

			// UserLevelID
			$usuario_niveles->UserLevelID->ViewValue = $usuario_niveles->UserLevelID->CurrentValue;
			$usuario_niveles->UserLevelID->ViewCustomAttributes = "";

			// nombre
			$usuario_niveles->nombre->ViewValue = $usuario_niveles->nombre->CurrentValue;
			$usuario_niveles->nombre->ViewCustomAttributes = "";

			// UserLevelID
			$usuario_niveles->UserLevelID->LinkCustomAttributes = "";
			$usuario_niveles->UserLevelID->HrefValue = "";
			$usuario_niveles->UserLevelID->TooltipValue = "";

			// nombre
			$usuario_niveles->nombre->LinkCustomAttributes = "";
			$usuario_niveles->nombre->HrefValue = "";
			$usuario_niveles->nombre->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuario_niveles->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuario_niveles->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $usuario_niveles;
		$DeleteRows = TRUE;
		$sSql = $usuario_niveles->SQL();
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
				$DeleteRows = $usuario_niveles->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['UserLevelID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($usuario_niveles->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($usuario_niveles->CancelMessage <> "") {
				$this->setFailureMessage($usuario_niveles->CancelMessage);
				$usuario_niveles->CancelMessage = "";
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
				$usuario_niveles->Row_Deleted($row);
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
