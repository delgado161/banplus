<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "seccionesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$secciones_delete = new csecciones_delete();
$Page =& $secciones_delete;

// Page init
$secciones_delete->Page_Init();

// Page main
$secciones_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var secciones_delete = new ew_Page("secciones_delete");

// page properties
secciones_delete.PageID = "delete"; // page ID
secciones_delete.FormID = "fseccionesdelete"; // form ID
var EW_PAGE_ID = secciones_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
secciones_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secciones_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secciones_delete.ValidateRequired = false; // no JavaScript validation
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
if ($secciones_delete->Recordset = $secciones_delete->LoadRecordset())
	$secciones_deleteTotalRecs = $secciones_delete->Recordset->RecordCount(); // Get record count
if ($secciones_deleteTotalRecs <= 0) { // No record found, exit
	if ($secciones_delete->Recordset)
		$secciones_delete->Recordset->Close();
	$secciones_delete->Page_Terminate("seccioneslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secciones->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $secciones->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $secciones_delete->ShowPageHeader(); ?>
<?php
$secciones_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="secciones">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($secciones_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $secciones->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $secciones->id_seccion->FldCaption() ?></td>
		<td valign="top"><?php echo $secciones->imagen->FldCaption() ?></td>
		<td valign="top"><?php echo $secciones->estatus->FldCaption() ?></td>
		<td valign="top"><?php echo $secciones->id_herramienta_financiera->FldCaption() ?></td>
		<td valign="top"><?php echo $secciones->titulo->FldCaption() ?></td>
		<td valign="top"><?php echo $secciones->imagen_interna->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$secciones_delete->RecCnt = 0;
$i = 0;
while (!$secciones_delete->Recordset->EOF) {
	$secciones_delete->RecCnt++;

	// Set row properties
	$secciones->ResetAttrs();
	$secciones->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$secciones_delete->LoadRowValues($secciones_delete->Recordset);

	// Render row
	$secciones_delete->RenderRow();
?>
	<tr<?php echo $secciones->RowAttributes() ?>>
		<td<?php echo $secciones->id_seccion->CellAttributes() ?>>
<div<?php echo $secciones->id_seccion->ViewAttributes() ?>><?php echo $secciones->id_seccion->ListViewValue() ?></div></td>
		<td<?php echo $secciones->imagen->CellAttributes() ?>>
<div<?php echo $secciones->imagen->ViewAttributes() ?>><?php echo $secciones->imagen->ListViewValue() ?></div></td>
		<td<?php echo $secciones->estatus->CellAttributes() ?>>
<div<?php echo $secciones->estatus->ViewAttributes() ?>><?php echo $secciones->estatus->ListViewValue() ?></div></td>
		<td<?php echo $secciones->id_herramienta_financiera->CellAttributes() ?>>
<div<?php echo $secciones->id_herramienta_financiera->ViewAttributes() ?>><?php echo $secciones->id_herramienta_financiera->ListViewValue() ?></div></td>
		<td<?php echo $secciones->titulo->CellAttributes() ?>>
<div<?php echo $secciones->titulo->ViewAttributes() ?>><?php echo $secciones->titulo->ListViewValue() ?></div></td>
		<td<?php echo $secciones->imagen_interna->CellAttributes() ?>>
<div<?php echo $secciones->imagen_interna->ViewAttributes() ?>><?php echo $secciones->imagen_interna->ListViewValue() ?></div></td>
	</tr>
<?php
	$secciones_delete->Recordset->MoveNext();
}
$secciones_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$secciones_delete->ShowPageFooter();
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
$secciones_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csecciones_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'secciones';

	// Page object name
	var $PageObjName = 'secciones_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $secciones;
		if ($secciones->UseTokenInUrl) $PageUrl .= "t=" . $secciones->TableVar . "&"; // Add page token
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
		global $objForm, $secciones;
		if ($secciones->UseTokenInUrl) {
			if ($objForm)
				return ($secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csecciones_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (secciones)
		if (!isset($GLOBALS["secciones"])) {
			$GLOBALS["secciones"] = new csecciones();
			$GLOBALS["Table"] =& $GLOBALS["secciones"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'secciones', TRUE);

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
		global $secciones;

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
		global $Language, $secciones;

		// Load key parameters
		$this->RecKeys = $secciones->GetRecordKeys(); // Load record keys
		$sFilter = $secciones->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("seccioneslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in secciones class, seccionesinfo.php

		$secciones->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$secciones->CurrentAction = $_POST["a_delete"];
		} else {
			$secciones->CurrentAction = "I"; // Display record
		}
		switch ($secciones->CurrentAction) {
			case "D": // Delete
				$secciones->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($secciones->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $secciones;

		// Call Recordset Selecting event
		$secciones->Recordset_Selecting($secciones->CurrentFilter);

		// Load List page SQL
		$sSql = $secciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$secciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $secciones;
		$sFilter = $secciones->KeyFilter();

		// Call Row Selecting event
		$secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$secciones->CurrentFilter = $sFilter;
		$sSql = $secciones->SQL();
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
		global $conn, $secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$secciones->Row_Selected($row);
		$secciones->id_seccion->setDbValue($rs->fields('id_seccion'));
		$secciones->imagen->setDbValue($rs->fields('imagen'));
		$secciones->contenido->setDbValue($rs->fields('contenido'));
		$secciones->resumen->setDbValue($rs->fields('resumen'));
		$secciones->estatus->setDbValue($rs->fields('estatus'));
		$secciones->id_herramienta_financiera->setDbValue($rs->fields('id_herramienta_financiera'));
		$secciones->titulo->setDbValue($rs->fields('titulo'));
		$secciones->imagen_interna->setDbValue($rs->fields('imagen_interna'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $secciones;

		// Initialize URLs
		// Call Row_Rendering event

		$secciones->Row_Rendering();

		// Common render codes for all row types
		// id_seccion
		// imagen
		// contenido
		// resumen
		// estatus
		// id_herramienta_financiera
		// titulo
		// imagen_interna

		if ($secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_seccion
			$secciones->id_seccion->ViewValue = $secciones->id_seccion->CurrentValue;
			$secciones->id_seccion->ViewCustomAttributes = "";

			// imagen
			$secciones->imagen->ViewValue = $secciones->imagen->CurrentValue;
			$secciones->imagen->ViewCustomAttributes = "";

			// estatus
			$secciones->estatus->ViewValue = $secciones->estatus->CurrentValue;
			$secciones->estatus->ViewCustomAttributes = "";

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->ViewValue = $secciones->id_herramienta_financiera->CurrentValue;
			$secciones->id_herramienta_financiera->ViewCustomAttributes = "";

			// titulo
			$secciones->titulo->ViewValue = $secciones->titulo->CurrentValue;
			$secciones->titulo->ViewCustomAttributes = "";

			// imagen_interna
			$secciones->imagen_interna->ViewValue = $secciones->imagen_interna->CurrentValue;
			$secciones->imagen_interna->ViewCustomAttributes = "";

			// id_seccion
			$secciones->id_seccion->LinkCustomAttributes = "";
			$secciones->id_seccion->HrefValue = "";
			$secciones->id_seccion->TooltipValue = "";

			// imagen
			$secciones->imagen->LinkCustomAttributes = "";
			$secciones->imagen->HrefValue = "";
			$secciones->imagen->TooltipValue = "";

			// estatus
			$secciones->estatus->LinkCustomAttributes = "";
			$secciones->estatus->HrefValue = "";
			$secciones->estatus->TooltipValue = "";

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->LinkCustomAttributes = "";
			$secciones->id_herramienta_financiera->HrefValue = "";
			$secciones->id_herramienta_financiera->TooltipValue = "";

			// titulo
			$secciones->titulo->LinkCustomAttributes = "";
			$secciones->titulo->HrefValue = "";
			$secciones->titulo->TooltipValue = "";

			// imagen_interna
			$secciones->imagen_interna->LinkCustomAttributes = "";
			$secciones->imagen_interna->HrefValue = "";
			$secciones->imagen_interna->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secciones->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $secciones;
		$DeleteRows = TRUE;
		$sSql = $secciones->SQL();
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
				$DeleteRows = $secciones->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_seccion'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($secciones->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($secciones->CancelMessage <> "") {
				$this->setFailureMessage($secciones->CancelMessage);
				$secciones->CancelMessage = "";
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
				$secciones->Row_Deleted($row);
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
