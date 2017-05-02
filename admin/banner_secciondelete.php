<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "banner_seccioninfo.php" ?>
<?php include_once "bannerinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$banner_seccion_delete = new cbanner_seccion_delete();
$Page =& $banner_seccion_delete;

// Page init
$banner_seccion_delete->Page_Init();

// Page main
$banner_seccion_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var banner_seccion_delete = new ew_Page("banner_seccion_delete");

// page properties
banner_seccion_delete.PageID = "delete"; // page ID
banner_seccion_delete.FormID = "fbanner_secciondelete"; // form ID
var EW_PAGE_ID = banner_seccion_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
banner_seccion_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
banner_seccion_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banner_seccion_delete.ValidateRequired = false; // no JavaScript validation
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
if ($banner_seccion_delete->Recordset = $banner_seccion_delete->LoadRecordset())
	$banner_seccion_deleteTotalRecs = $banner_seccion_delete->Recordset->RecordCount(); // Get record count
if ($banner_seccion_deleteTotalRecs <= 0) { // No record found, exit
	if ($banner_seccion_delete->Recordset)
		$banner_seccion_delete->Recordset->Close();
	$banner_seccion_delete->Page_Terminate("banner_seccionlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banner_seccion->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $banner_seccion->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $banner_seccion_delete->ShowPageHeader(); ?>
<?php
$banner_seccion_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="banner_seccion">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($banner_seccion_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $banner_seccion->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $banner_seccion->id_banner->FldCaption() ?></td>
		<td valign="top"><?php echo $banner_seccion->id_grupo_secciones->FldCaption() ?></td>
		<td valign="top"><?php echo $banner_seccion->fecha_inicio->FldCaption() ?></td>
		<td valign="top"><?php echo $banner_seccion->fecha_fin->FldCaption() ?></td>
		<td valign="top"><?php echo $banner_seccion->id_posicion->FldCaption() ?></td>
		<td valign="top"><?php echo $banner_seccion->orden->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$banner_seccion_delete->RecCnt = 0;
$i = 0;
while (!$banner_seccion_delete->Recordset->EOF) {
	$banner_seccion_delete->RecCnt++;

	// Set row properties
	$banner_seccion->ResetAttrs();
	$banner_seccion->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$banner_seccion_delete->LoadRowValues($banner_seccion_delete->Recordset);

	// Render row
	$banner_seccion_delete->RenderRow();
?>
	<tr<?php echo $banner_seccion->RowAttributes() ?>>
		<td<?php echo $banner_seccion->id_banner->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ListViewValue() ?></div></td>
		<td<?php echo $banner_seccion->id_grupo_secciones->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_grupo_secciones->ViewAttributes() ?>><?php echo $banner_seccion->id_grupo_secciones->ListViewValue() ?></div></td>
		<td<?php echo $banner_seccion->fecha_inicio->CellAttributes() ?>>
<div<?php echo $banner_seccion->fecha_inicio->ViewAttributes() ?>><?php echo $banner_seccion->fecha_inicio->ListViewValue() ?></div></td>
		<td<?php echo $banner_seccion->fecha_fin->CellAttributes() ?>>
<div<?php echo $banner_seccion->fecha_fin->ViewAttributes() ?>><?php echo $banner_seccion->fecha_fin->ListViewValue() ?></div></td>
		<td<?php echo $banner_seccion->id_posicion->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_posicion->ViewAttributes() ?>><?php echo $banner_seccion->id_posicion->ListViewValue() ?></div></td>
		<td<?php echo $banner_seccion->orden->CellAttributes() ?>>
<div<?php echo $banner_seccion->orden->ViewAttributes() ?>><?php echo $banner_seccion->orden->ListViewValue() ?></div></td>
	</tr>
<?php
	$banner_seccion_delete->Recordset->MoveNext();
}
$banner_seccion_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$banner_seccion_delete->ShowPageFooter();
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
$banner_seccion_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanner_seccion_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'banner_seccion';

	// Page object name
	var $PageObjName = 'banner_seccion_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banner_seccion;
		if ($banner_seccion->UseTokenInUrl) $PageUrl .= "t=" . $banner_seccion->TableVar . "&"; // Add page token
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
		global $objForm, $banner_seccion;
		if ($banner_seccion->UseTokenInUrl) {
			if ($objForm)
				return ($banner_seccion->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banner_seccion->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanner_seccion_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (banner_seccion)
		if (!isset($GLOBALS["banner_seccion"])) {
			$GLOBALS["banner_seccion"] = new cbanner_seccion();
			$GLOBALS["Table"] =& $GLOBALS["banner_seccion"];
		}

		// Table object (banner)
		if (!isset($GLOBALS['banner'])) $GLOBALS['banner'] = new cbanner();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banner_seccion', TRUE);

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
		global $banner_seccion;

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
			$this->Page_Terminate("banner_seccionlist.php");
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
		global $Language, $banner_seccion;

		// Load key parameters
		$this->RecKeys = $banner_seccion->GetRecordKeys(); // Load record keys
		$sFilter = $banner_seccion->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("banner_seccionlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in banner_seccion class, banner_seccioninfo.php

		$banner_seccion->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$banner_seccion->CurrentAction = $_POST["a_delete"];
		} else {
			$banner_seccion->CurrentAction = "I"; // Display record
		}
		switch ($banner_seccion->CurrentAction) {
			case "D": // Delete
				$banner_seccion->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($banner_seccion->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $banner_seccion;

		// Call Recordset Selecting event
		$banner_seccion->Recordset_Selecting($banner_seccion->CurrentFilter);

		// Load List page SQL
		$sSql = $banner_seccion->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$banner_seccion->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banner_seccion;
		$sFilter = $banner_seccion->KeyFilter();

		// Call Row Selecting event
		$banner_seccion->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banner_seccion->CurrentFilter = $sFilter;
		$sSql = $banner_seccion->SQL();
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
		global $conn, $banner_seccion;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$banner_seccion->Row_Selected($row);
		$banner_seccion->id_banner_seccion->setDbValue($rs->fields('id_banner_seccion'));
		$banner_seccion->id_banner->setDbValue($rs->fields('id_banner'));
		$banner_seccion->id_grupo_secciones->setDbValue($rs->fields('id_grupo_secciones'));
		$banner_seccion->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$banner_seccion->fecha_fin->setDbValue($rs->fields('fecha_fin'));
		$banner_seccion->link->setDbValue($rs->fields('link'));
		$banner_seccion->externo->setDbValue($rs->fields('externo'));
		$banner_seccion->id_posicion->setDbValue($rs->fields('id_posicion'));
		$banner_seccion->orden->setDbValue($rs->fields('orden'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banner_seccion;

		// Initialize URLs
		// Call Row_Rendering event

		$banner_seccion->Row_Rendering();

		// Common render codes for all row types
		// id_banner_seccion

		$banner_seccion->id_banner_seccion->CellCssStyle = "white-space: nowrap;";

		// id_banner
		// id_grupo_secciones
		// fecha_inicio
		// fecha_fin
		// link
		// externo
		// id_posicion
		// orden

		if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_banner
			if (strval($banner_seccion->id_banner->CurrentValue) <> "") {
				$sFilterWrk = "`id_banner` = " . ew_AdjustSql($banner_seccion->id_banner->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `banner`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_banner->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$banner_seccion->id_banner->ViewValue = $banner_seccion->id_banner->CurrentValue;
				}
			} else {
				$banner_seccion->id_banner->ViewValue = NULL;
			}
			$banner_seccion->id_banner->ViewCustomAttributes = "";

			// id_grupo_secciones
			if (strval($banner_seccion->id_grupo_secciones->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($banner_seccion->id_grupo_secciones->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view1`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_grupo_secciones->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$banner_seccion->id_grupo_secciones->ViewValue = $banner_seccion->id_grupo_secciones->CurrentValue;
				}
			} else {
				$banner_seccion->id_grupo_secciones->ViewValue = NULL;
			}
			$banner_seccion->id_grupo_secciones->ViewCustomAttributes = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->ViewValue = $banner_seccion->fecha_inicio->CurrentValue;
			$banner_seccion->fecha_inicio->ViewValue = ew_FormatDateTime($banner_seccion->fecha_inicio->ViewValue, 7);
			$banner_seccion->fecha_inicio->ViewCustomAttributes = "";

			// fecha_fin
			$banner_seccion->fecha_fin->ViewValue = $banner_seccion->fecha_fin->CurrentValue;
			$banner_seccion->fecha_fin->ViewValue = ew_FormatDateTime($banner_seccion->fecha_fin->ViewValue, 7);
			$banner_seccion->fecha_fin->ViewCustomAttributes = "";

			// link
			$banner_seccion->link->ViewValue = $banner_seccion->link->CurrentValue;
			$banner_seccion->link->ViewCustomAttributes = "";

			// externo
			if (strval($banner_seccion->externo->CurrentValue) <> "") {
				$banner_seccion->externo->ViewValue = "";
				$arwrk = explode(",", strval($banner_seccion->externo->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++) {
					switch (trim($arwrk[$ari])) {
						case "1":
							$banner_seccion->externo->ViewValue .= $banner_seccion->externo->FldTagCaption(1) <> "" ? $banner_seccion->externo->FldTagCaption(1) : trim($arwrk[$ari]);
							break;
						default:
							$banner_seccion->externo->ViewValue .= trim($arwrk[$ari]);
					}
					if ($ari < $cnt-1) $banner_seccion->externo->ViewValue .= ew_ViewOptionSeparator($ari);
				}
			} else {
				$banner_seccion->externo->ViewValue = NULL;
			}
			$banner_seccion->externo->ViewCustomAttributes = "";

			// id_posicion
			if (strval($banner_seccion->id_posicion->CurrentValue) <> "") {
				$sFilterWrk = "`id_posicion` = " . ew_AdjustSql($banner_seccion->id_posicion->CurrentValue) . "";
			$sSqlWrk = "SELECT `posicion` FROM `banner_posicion`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `posicion`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_posicion->ViewValue = $rswrk->fields('posicion');
					$rswrk->Close();
				} else {
					$banner_seccion->id_posicion->ViewValue = $banner_seccion->id_posicion->CurrentValue;
				}
			} else {
				$banner_seccion->id_posicion->ViewValue = NULL;
			}
			$banner_seccion->id_posicion->ViewCustomAttributes = "";

			// orden
			$banner_seccion->orden->ViewValue = $banner_seccion->orden->CurrentValue;
			$banner_seccion->orden->ViewCustomAttributes = "";

			// id_banner
			$banner_seccion->id_banner->LinkCustomAttributes = "";
			$banner_seccion->id_banner->HrefValue = "";
			$banner_seccion->id_banner->TooltipValue = "";

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->LinkCustomAttributes = "";
			$banner_seccion->id_grupo_secciones->HrefValue = "";
			$banner_seccion->id_grupo_secciones->TooltipValue = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->LinkCustomAttributes = "";
			$banner_seccion->fecha_inicio->HrefValue = "";
			$banner_seccion->fecha_inicio->TooltipValue = "";

			// fecha_fin
			$banner_seccion->fecha_fin->LinkCustomAttributes = "";
			$banner_seccion->fecha_fin->HrefValue = "";
			$banner_seccion->fecha_fin->TooltipValue = "";

			// id_posicion
			$banner_seccion->id_posicion->LinkCustomAttributes = "";
			$banner_seccion->id_posicion->HrefValue = "";
			$banner_seccion->id_posicion->TooltipValue = "";

			// orden
			$banner_seccion->orden->LinkCustomAttributes = "";
			$banner_seccion->orden->HrefValue = "";
			$banner_seccion->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($banner_seccion->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banner_seccion->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $banner_seccion;
		$DeleteRows = TRUE;
		$sSql = $banner_seccion->SQL();
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
		$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $banner_seccion->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_banner_seccion'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($banner_seccion->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($banner_seccion->CancelMessage <> "") {
				$this->setFailureMessage($banner_seccion->CancelMessage);
				$banner_seccion->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($DeleteRows) {
				foreach ($rsold as $row)
					$this->WriteAuditTrailOnDelete($row);
			}
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$banner_seccion->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'banner_seccion';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $banner_seccion;
		$table = 'banner_seccion';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_banner_seccion'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $banner_seccion->fields) && $banner_seccion->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($banner_seccion->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($banner_seccion->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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
