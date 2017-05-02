<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "comentariosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$comentarios_delete = new ccomentarios_delete();
$Page =& $comentarios_delete;

// Page init
$comentarios_delete->Page_Init();

// Page main
$comentarios_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var comentarios_delete = new ew_Page("comentarios_delete");

// page properties
comentarios_delete.PageID = "delete"; // page ID
comentarios_delete.FormID = "fcomentariosdelete"; // form ID
var EW_PAGE_ID = comentarios_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comentarios_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comentarios_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comentarios_delete.ValidateRequired = false; // no JavaScript validation
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
if ($comentarios_delete->Recordset = $comentarios_delete->LoadRecordset())
	$comentarios_deleteTotalRecs = $comentarios_delete->Recordset->RecordCount(); // Get record count
if ($comentarios_deleteTotalRecs <= 0) { // No record found, exit
	if ($comentarios_delete->Recordset)
		$comentarios_delete->Recordset->Close();
	$comentarios_delete->Page_Terminate("comentarioslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comentarios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $comentarios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $comentarios_delete->ShowPageHeader(); ?>
<?php
$comentarios_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="comentarios">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($comentarios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $comentarios->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $comentarios->autor->FldCaption() ?></td>
		<td valign="top"><?php echo $comentarios->descripcion->FldCaption() ?></td>
		<td valign="top"><?php echo $comentarios->zemail->FldCaption() ?></td>
		<td valign="top"><?php echo $comentarios->fecha->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$comentarios_delete->RecCnt = 0;
$i = 0;
while (!$comentarios_delete->Recordset->EOF) {
	$comentarios_delete->RecCnt++;

	// Set row properties
	$comentarios->ResetAttrs();
	$comentarios->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$comentarios_delete->LoadRowValues($comentarios_delete->Recordset);

	// Render row
	$comentarios_delete->RenderRow();
?>
	<tr<?php echo $comentarios->RowAttributes() ?>>
		<td<?php echo $comentarios->autor->CellAttributes() ?>>
<div<?php echo $comentarios->autor->ViewAttributes() ?>><?php echo $comentarios->autor->ListViewValue() ?></div></td>
		<td<?php echo $comentarios->descripcion->CellAttributes() ?>>
<div<?php echo $comentarios->descripcion->ViewAttributes() ?>><?php echo $comentarios->descripcion->ListViewValue() ?></div></td>
		<td<?php echo $comentarios->zemail->CellAttributes() ?>>
<div<?php echo $comentarios->zemail->ViewAttributes() ?>><?php echo $comentarios->zemail->ListViewValue() ?></div></td>
		<td<?php echo $comentarios->fecha->CellAttributes() ?>>
<div<?php echo $comentarios->fecha->ViewAttributes() ?>><?php echo $comentarios->fecha->ListViewValue() ?></div></td>
	</tr>
<?php
	$comentarios_delete->Recordset->MoveNext();
}
$comentarios_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$comentarios_delete->ShowPageFooter();
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
$comentarios_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomentarios_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'comentarios';

	// Page object name
	var $PageObjName = 'comentarios_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comentarios;
		if ($comentarios->UseTokenInUrl) $PageUrl .= "t=" . $comentarios->TableVar . "&"; // Add page token
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
		global $objForm, $comentarios;
		if ($comentarios->UseTokenInUrl) {
			if ($objForm)
				return ($comentarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comentarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccomentarios_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (comentarios)
		if (!isset($GLOBALS["comentarios"])) {
			$GLOBALS["comentarios"] = new ccomentarios();
			$GLOBALS["Table"] =& $GLOBALS["comentarios"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comentarios', TRUE);

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
		global $comentarios;

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
			$this->Page_Terminate("comentarioslist.php");
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
		global $Language, $comentarios;

		// Load key parameters
		$this->RecKeys = $comentarios->GetRecordKeys(); // Load record keys
		$sFilter = $comentarios->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("comentarioslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in comentarios class, comentariosinfo.php

		$comentarios->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$comentarios->CurrentAction = $_POST["a_delete"];
		} else {
			$comentarios->CurrentAction = "I"; // Display record
		}
		switch ($comentarios->CurrentAction) {
			case "D": // Delete
				$comentarios->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($comentarios->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $comentarios;

		// Call Recordset Selecting event
		$comentarios->Recordset_Selecting($comentarios->CurrentFilter);

		// Load List page SQL
		$sSql = $comentarios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$comentarios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comentarios;
		$sFilter = $comentarios->KeyFilter();

		// Call Row Selecting event
		$comentarios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$comentarios->CurrentFilter = $sFilter;
		$sSql = $comentarios->SQL();
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
		global $conn, $comentarios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$comentarios->Row_Selected($row);
		$comentarios->id_comentario->setDbValue($rs->fields('id_comentario'));
		$comentarios->autor->setDbValue($rs->fields('autor'));
		$comentarios->descripcion->setDbValue($rs->fields('descripcion'));
		$comentarios->zemail->setDbValue($rs->fields('email'));
		$comentarios->fecha->setDbValue($rs->fields('fecha'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $comentarios;

		// Initialize URLs
		// Call Row_Rendering event

		$comentarios->Row_Rendering();

		// Common render codes for all row types
		// id_comentario
		// autor
		// descripcion
		// email
		// fecha

		if ($comentarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// autor
			$comentarios->autor->ViewValue = $comentarios->autor->CurrentValue;
			$comentarios->autor->ViewCustomAttributes = "";

			// descripcion
			$comentarios->descripcion->ViewValue = $comentarios->descripcion->CurrentValue;
			$comentarios->descripcion->ViewCustomAttributes = "";

			// email
			$comentarios->zemail->ViewValue = $comentarios->zemail->CurrentValue;
			$comentarios->zemail->ViewCustomAttributes = "";

			// fecha
			$comentarios->fecha->ViewValue = $comentarios->fecha->CurrentValue;
			$comentarios->fecha->ViewValue = ew_FormatDateTime($comentarios->fecha->ViewValue, 7);
			$comentarios->fecha->ViewCustomAttributes = "";

			// autor
			$comentarios->autor->LinkCustomAttributes = "";
			$comentarios->autor->HrefValue = "";
			$comentarios->autor->TooltipValue = "";

			// descripcion
			$comentarios->descripcion->LinkCustomAttributes = "";
			$comentarios->descripcion->HrefValue = "";
			$comentarios->descripcion->TooltipValue = "";

			// email
			$comentarios->zemail->LinkCustomAttributes = "";
			$comentarios->zemail->HrefValue = "";
			$comentarios->zemail->TooltipValue = "";

			// fecha
			$comentarios->fecha->LinkCustomAttributes = "";
			$comentarios->fecha->HrefValue = "";
			$comentarios->fecha->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($comentarios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$comentarios->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $comentarios;
		$DeleteRows = TRUE;
		$sSql = $comentarios->SQL();
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
				$DeleteRows = $comentarios->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_comentario'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($comentarios->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($comentarios->CancelMessage <> "") {
				$this->setFailureMessage($comentarios->CancelMessage);
				$comentarios->CancelMessage = "";
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
				$comentarios->Row_Deleted($row);
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
