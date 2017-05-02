<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "promocionesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$promociones_delete = new cpromociones_delete();
$Page =& $promociones_delete;

// Page init
$promociones_delete->Page_Init();

// Page main
$promociones_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var promociones_delete = new ew_Page("promociones_delete");

// page properties
promociones_delete.PageID = "delete"; // page ID
promociones_delete.FormID = "fpromocionesdelete"; // form ID
var EW_PAGE_ID = promociones_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
promociones_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
promociones_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
promociones_delete.ValidateRequired = false; // no JavaScript validation
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
if ($promociones_delete->Recordset = $promociones_delete->LoadRecordset())
	$promociones_deleteTotalRecs = $promociones_delete->Recordset->RecordCount(); // Get record count
if ($promociones_deleteTotalRecs <= 0) { // No record found, exit
	if ($promociones_delete->Recordset)
		$promociones_delete->Recordset->Close();
	$promociones_delete->Page_Terminate("promocioneslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $promociones->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $promociones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $promociones_delete->ShowPageHeader(); ?>
<?php
$promociones_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="promociones">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($promociones_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $promociones->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $promociones->titulo->FldCaption() ?></td>
		<td valign="top"><?php echo $promociones->imagen->FldCaption() ?></td>
		<td valign="top"><?php echo $promociones->estatus->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$promociones_delete->RecCnt = 0;
$i = 0;
while (!$promociones_delete->Recordset->EOF) {
	$promociones_delete->RecCnt++;

	// Set row properties
	$promociones->ResetAttrs();
	$promociones->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$promociones_delete->LoadRowValues($promociones_delete->Recordset);

	// Render row
	$promociones_delete->RenderRow();
?>
	<tr<?php echo $promociones->RowAttributes() ?>>
		<td<?php echo $promociones->titulo->CellAttributes() ?>>
<div<?php echo $promociones->titulo->ViewAttributes() ?>><?php echo $promociones->titulo->ListViewValue() ?></div></td>
		<td<?php echo $promociones->imagen->CellAttributes() ?>>
<?php if ($promociones->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($promociones->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $promociones->imagen->UploadPath) . $promociones->imagen->Upload->DbValue ?>" border=0<?php echo $promociones->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($promociones->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($promociones->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $promociones->imagen->UploadPath) . $promociones->imagen->Upload->DbValue ?>" border=0<?php echo $promociones->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($promociones->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $promociones->estatus->CellAttributes() ?>>
<div<?php echo $promociones->estatus->ViewAttributes() ?>><?php echo $promociones->estatus->ListViewValue() ?></div></td>
	</tr>
<?php
	$promociones_delete->Recordset->MoveNext();
}
$promociones_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$promociones_delete->ShowPageFooter();
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
$promociones_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpromociones_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'promociones';

	// Page object name
	var $PageObjName = 'promociones_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $promociones;
		if ($promociones->UseTokenInUrl) $PageUrl .= "t=" . $promociones->TableVar . "&"; // Add page token
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
		global $objForm, $promociones;
		if ($promociones->UseTokenInUrl) {
			if ($objForm)
				return ($promociones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($promociones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpromociones_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (promociones)
		if (!isset($GLOBALS["promociones"])) {
			$GLOBALS["promociones"] = new cpromociones();
			$GLOBALS["Table"] =& $GLOBALS["promociones"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'promociones', TRUE);

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
		global $promociones;

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
			$this->Page_Terminate("promocioneslist.php");
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
		global $Language, $promociones;

		// Load key parameters
		$this->RecKeys = $promociones->GetRecordKeys(); // Load record keys
		$sFilter = $promociones->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("promocioneslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in promociones class, promocionesinfo.php

		$promociones->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$promociones->CurrentAction = $_POST["a_delete"];
		} else {
			$promociones->CurrentAction = "I"; // Display record
		}
		switch ($promociones->CurrentAction) {
			case "D": // Delete
				$promociones->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($promociones->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $promociones;

		// Call Recordset Selecting event
		$promociones->Recordset_Selecting($promociones->CurrentFilter);

		// Load List page SQL
		$sSql = $promociones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$promociones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $promociones;
		$sFilter = $promociones->KeyFilter();

		// Call Row Selecting event
		$promociones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$promociones->CurrentFilter = $sFilter;
		$sSql = $promociones->SQL();
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
		global $conn, $promociones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$promociones->Row_Selected($row);
		$promociones->id_promociones->setDbValue($rs->fields('id_promociones'));
		$promociones->titulo->setDbValue($rs->fields('titulo'));
		$promociones->contenido->setDbValue($rs->fields('contenido'));
		$promociones->imagen->Upload->DbValue = $rs->fields('imagen');
		$promociones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $promociones;

		// Initialize URLs
		// Call Row_Rendering event

		$promociones->Row_Rendering();

		// Common render codes for all row types
		// id_promociones
		// titulo
		// contenido
		// imagen
		// estatus

		if ($promociones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_promociones
			$promociones->id_promociones->ViewValue = $promociones->id_promociones->CurrentValue;
			$promociones->id_promociones->ViewCustomAttributes = "";

			// titulo
			$promociones->titulo->ViewValue = $promociones->titulo->CurrentValue;
			$promociones->titulo->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($promociones->imagen->Upload->DbValue)) {
				$promociones->imagen->ViewValue = $promociones->imagen->Upload->DbValue;
				$promociones->imagen->ImageWidth = 150;
				$promociones->imagen->ImageHeight = 0;
				$promociones->imagen->ImageAlt = $promociones->imagen->FldAlt();
			} else {
				$promociones->imagen->ViewValue = "";
			}
			$promociones->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($promociones->estatus->CurrentValue) <> "") {
				switch ($promociones->estatus->CurrentValue) {
					case "1":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(1) <> "" ? $promociones->estatus->FldTagCaption(1) : $promociones->estatus->CurrentValue;
						break;
					case "0":
						$promociones->estatus->ViewValue = $promociones->estatus->FldTagCaption(2) <> "" ? $promociones->estatus->FldTagCaption(2) : $promociones->estatus->CurrentValue;
						break;
					default:
						$promociones->estatus->ViewValue = $promociones->estatus->CurrentValue;
				}
			} else {
				$promociones->estatus->ViewValue = NULL;
			}
			$promociones->estatus->ViewCustomAttributes = "";

			// titulo
			$promociones->titulo->LinkCustomAttributes = "";
			$promociones->titulo->HrefValue = "";
			$promociones->titulo->TooltipValue = "";

			// imagen
			$promociones->imagen->LinkCustomAttributes = "";
			$promociones->imagen->HrefValue = "";
			$promociones->imagen->TooltipValue = "";

			// estatus
			$promociones->estatus->LinkCustomAttributes = "";
			$promociones->estatus->HrefValue = "";
			$promociones->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($promociones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$promociones->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $promociones;
		$DeleteRows = TRUE;
		$sSql = $promociones->SQL();
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
				$DeleteRows = $promociones->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_promociones'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($promociones->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($promociones->CancelMessage <> "") {
				$this->setFailureMessage($promociones->CancelMessage);
				$promociones->CancelMessage = "";
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
				$promociones->Row_Deleted($row);
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
