<?php include_once "usuariosinfo.php" ?>
<?php

//
// Page class
//
class cgrupo_secciones_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'grupo_secciones';

	// Page object name
	var $PageObjName = 'grupo_secciones_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grupo_secciones;
		if ($grupo_secciones->UseTokenInUrl) $PageUrl .= "t=" . $grupo_secciones->TableVar . "&"; // Add page token
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
		global $objForm, $grupo_secciones;
		if ($grupo_secciones->UseTokenInUrl) {
			if ($objForm)
				return ($grupo_secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grupo_secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrupo_secciones_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (grupo_secciones)
		if (!isset($GLOBALS["grupo_secciones"])) {
			$GLOBALS["grupo_secciones"] = new cgrupo_secciones();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["grupo_secciones"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grupo_secciones', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $grupo_secciones;

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$grupo_secciones->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

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
		global $grupo_secciones;

//		$GLOBALS["Table"] =& $GLOBALS["MasterTable"];
		if ($url == "")
			return;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $grupo_secciones;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Hide all options
			if ($grupo_secciones->Export <> "" ||
				$grupo_secciones->CurrentAction == "gridadd" ||
				$grupo_secciones->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($grupo_secciones->AllowAddDeleteRow) {
				if ($grupo_secciones->CurrentAction == "gridadd" ||
					$grupo_secciones->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($grupo_secciones->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $grupo_secciones->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $grupo_secciones->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $grupo_secciones->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($grupo_secciones->getMasterFilter() <> "" && $grupo_secciones->getCurrentMasterTable() == "contenidos") {
			global $contenidos;
			$rsmaster = $contenidos->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($grupo_secciones->getReturnUrl()); // Return to caller
			} else {
				$contenidos->LoadListRowValues($rsmaster);
				$contenidos->RowType = EW_ROWTYPE_MASTER; // Master row
				$contenidos->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$grupo_secciones->setSessionWhere($sFilter);
		$grupo_secciones->CurrentFilter = "";
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $grupo_secciones;
		$grupo_secciones->LastAction = $grupo_secciones->CurrentAction; // Save last action
		$grupo_secciones->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $grupo_secciones;
		$bGridUpdate = TRUE;
		$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin

		// Get old recordset
		$grupo_secciones->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $grupo_secciones->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue("k_key"));
			$rowaction = strval($objForm->GetValue("k_action"));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$grupo_secciones->CurrentFilter = $grupo_secciones->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$grupo_secciones->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateSuccess")); // Batch update success
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$grupo_secciones->EventCancelled = TRUE; // Set event cancelled
			$grupo_secciones->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $grupo_secciones;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $grupo_secciones->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $grupo_secciones;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$grupo_secciones->id_grupo_seccion->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($grupo_secciones->id_grupo_seccion->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $grupo_secciones;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$this->WriteAuditTrailDummy($Language->Phrase("BatchInsertBegin")); // Batch insert begin
		$sKey = "";

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($objForm->GetValue("k_oldkey"));
				$this->LoadOldRecord(); // Load old recordset
			}
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$grupo_secciones->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $grupo_secciones->id_grupo_seccion->CurrentValue;

					// Add filter for this record
					$sFilter = $grupo_secciones->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->ClearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($bGridInsert) {

			// Get new recordset
			$grupo_secciones->CurrentFilter = $sWrkFilter;
			$sSql = $grupo_secciones->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->WriteAuditTrailDummy($Language->Phrase("BatchInsertSuccess")); // Batch insert success
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$this->WriteAuditTrailDummy($Language->Phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$grupo_secciones->EventCancelled = TRUE; // Set event cancelled
			$grupo_secciones->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $grupo_secciones, $objForm;
		if ($objForm->HasValue("x_id_grupo") && $objForm->HasValue("o_id_grupo") && $grupo_secciones->id_grupo->CurrentValue <> $grupo_secciones->id_grupo->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_id_contenido") && $objForm->HasValue("o_id_contenido") && $grupo_secciones->id_contenido->CurrentValue <> $grupo_secciones->id_contenido->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_orden") && $objForm->HasValue("o_orden") && $grupo_secciones->orden->CurrentValue <> $grupo_secciones->orden->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estatus") && $objForm->HasValue("o_estatus") && $grupo_secciones->estatus->CurrentValue <> $grupo_secciones->estatus->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $grupo_secciones;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $grupo_secciones;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$grupo_secciones->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$grupo_secciones->CurrentOrderType = @$_GET["ordertype"];
			$grupo_secciones->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $grupo_secciones;
		$sOrderBy = $grupo_secciones->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($grupo_secciones->SqlOrderBy() <> "") {
				$sOrderBy = $grupo_secciones->SqlOrderBy();
				$grupo_secciones->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $grupo_secciones;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$grupo_secciones->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$grupo_secciones->id_contenido->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$grupo_secciones->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$grupo_secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $grupo_secciones;

		// "griddelete"
		if ($grupo_secciones->AllowAddDeleteRow) {
			$item =& $this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = FALSE;
			$item->Visible = FALSE; // Default hidden
		}

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $grupo_secciones, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex)) {
			$objForm->Index = $this->RowIndex;
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_action\" id=\"k" . $this->RowIndex . "_action\" value=\"" . $this->RowAction . "\">";
			if ($objForm->HasValue("k_oldkey"))
				$this->RowOldKey = strval($objForm->GetValue("k_oldkey"));
			if ($this->RowOldKey <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_oldkey\" id=\"k" . $this->RowIndex . "_oldkey\" value=\"" . ew_HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue("k_key");
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $grupo_secciones->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($grupo_secciones->AllowAddDeleteRow) {
			if ($grupo_secciones->CurrentMode == "add" || $grupo_secciones->CurrentMode == "copy" || $grupo_secciones->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, grupo_secciones_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($grupo_secciones->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $grupo_secciones->id_grupo_seccion->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('id_grupo_seccion');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $grupo_secciones;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $grupo_secciones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$grupo_secciones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$grupo_secciones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $grupo_secciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$grupo_secciones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$grupo_secciones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$grupo_secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $grupo_secciones;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $grupo_secciones;
		$grupo_secciones->id_grupo->CurrentValue = NULL;
		$grupo_secciones->id_grupo->OldValue = $grupo_secciones->id_grupo->CurrentValue;
		$grupo_secciones->id_contenido->CurrentValue = NULL;
		$grupo_secciones->id_contenido->OldValue = $grupo_secciones->id_contenido->CurrentValue;
		$grupo_secciones->orden->CurrentValue = NULL;
		$grupo_secciones->orden->OldValue = $grupo_secciones->orden->CurrentValue;
		$grupo_secciones->estatus->CurrentValue = NULL;
		$grupo_secciones->estatus->OldValue = $grupo_secciones->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $grupo_secciones;
		if (!$grupo_secciones->id_grupo->FldIsDetailKey) {
			$grupo_secciones->id_grupo->setFormValue($objForm->GetValue("x_id_grupo"));
		}
		$grupo_secciones->id_grupo->setOldValue($objForm->GetValue("o_id_grupo"));
		if (!$grupo_secciones->id_contenido->FldIsDetailKey) {
			$grupo_secciones->id_contenido->setFormValue($objForm->GetValue("x_id_contenido"));
		}
		$grupo_secciones->id_contenido->setOldValue($objForm->GetValue("o_id_contenido"));
		if (!$grupo_secciones->orden->FldIsDetailKey) {
			$grupo_secciones->orden->setFormValue($objForm->GetValue("x_orden"));
		}
		$grupo_secciones->orden->setOldValue($objForm->GetValue("o_orden"));
		if (!$grupo_secciones->estatus->FldIsDetailKey) {
			$grupo_secciones->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		$grupo_secciones->estatus->setOldValue($objForm->GetValue("o_estatus"));
		if (!$grupo_secciones->id_grupo_seccion->FldIsDetailKey && $grupo_secciones->CurrentAction <> "gridadd" && $grupo_secciones->CurrentAction <> "add")
			$grupo_secciones->id_grupo_seccion->setFormValue($objForm->GetValue("x_id_grupo_seccion"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $grupo_secciones;
		if ($grupo_secciones->CurrentAction <> "gridadd" && $grupo_secciones->CurrentAction <> "add")
			$grupo_secciones->id_grupo_seccion->CurrentValue = $grupo_secciones->id_grupo_seccion->FormValue;
		$grupo_secciones->id_grupo->CurrentValue = $grupo_secciones->id_grupo->FormValue;
		$grupo_secciones->id_contenido->CurrentValue = $grupo_secciones->id_contenido->FormValue;
		$grupo_secciones->orden->CurrentValue = $grupo_secciones->orden->FormValue;
		$grupo_secciones->estatus->CurrentValue = $grupo_secciones->estatus->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $grupo_secciones;

		// Call Recordset Selecting event
		$grupo_secciones->Recordset_Selecting($grupo_secciones->CurrentFilter);

		// Load List page SQL
		$sSql = $grupo_secciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$grupo_secciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grupo_secciones;
		$sFilter = $grupo_secciones->KeyFilter();

		// Call Row Selecting event
		$grupo_secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grupo_secciones->CurrentFilter = $sFilter;
		$sSql = $grupo_secciones->SQL();
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
		global $conn, $grupo_secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$grupo_secciones->Row_Selected($row);
		$grupo_secciones->id_grupo_seccion->setDbValue($rs->fields('id_grupo_seccion'));
		$grupo_secciones->id_grupo->setDbValue($rs->fields('id_grupo'));
		$grupo_secciones->id_contenido->setDbValue($rs->fields('id_contenido'));
		$grupo_secciones->orden->setDbValue($rs->fields('orden'));
		$grupo_secciones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $grupo_secciones;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$grupo_secciones->id_grupo_seccion->CurrentValue = strval($arKeys[0]); // id_grupo_seccion
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$grupo_secciones->CurrentFilter = $grupo_secciones->KeyFilter();
			$sSql = $grupo_secciones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grupo_secciones;

		// Initialize URLs
		// Call Row_Rendering event

		$grupo_secciones->Row_Rendering();

		// Common render codes for all row types
		// id_grupo_seccion
		// id_grupo
		// id_contenido
		// orden
		// estatus

		if ($grupo_secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_grupo
			if (strval($grupo_secciones->id_grupo->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo` = " . ew_AdjustSql($grupo_secciones->id_grupo->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view3`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo_secciones->id_grupo->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo_secciones->id_grupo->ViewValue = $grupo_secciones->id_grupo->CurrentValue;
				}
			} else {
				$grupo_secciones->id_grupo->ViewValue = NULL;
			}
			$grupo_secciones->id_grupo->ViewCustomAttributes = "";

			// id_contenido
			if (strval($grupo_secciones->id_contenido->CurrentValue) <> "") {
				$sFilterWrk = "`id_contenido` = " . ew_AdjustSql($grupo_secciones->id_contenido->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo_secciones->id_contenido->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo_secciones->id_contenido->ViewValue = $grupo_secciones->id_contenido->CurrentValue;
				}
			} else {
				$grupo_secciones->id_contenido->ViewValue = NULL;
			}
			$grupo_secciones->id_contenido->ViewCustomAttributes = "";

			// orden
			$grupo_secciones->orden->ViewValue = $grupo_secciones->orden->CurrentValue;
			$grupo_secciones->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($grupo_secciones->estatus->CurrentValue) <> "") {
				switch ($grupo_secciones->estatus->CurrentValue) {
					case "1":
						$grupo_secciones->estatus->ViewValue = $grupo_secciones->estatus->FldTagCaption(1) <> "" ? $grupo_secciones->estatus->FldTagCaption(1) : $grupo_secciones->estatus->CurrentValue;
						break;
					case "0":
						$grupo_secciones->estatus->ViewValue = $grupo_secciones->estatus->FldTagCaption(2) <> "" ? $grupo_secciones->estatus->FldTagCaption(2) : $grupo_secciones->estatus->CurrentValue;
						break;
					default:
						$grupo_secciones->estatus->ViewValue = $grupo_secciones->estatus->CurrentValue;
				}
			} else {
				$grupo_secciones->estatus->ViewValue = NULL;
			}
			$grupo_secciones->estatus->ViewCustomAttributes = "";

			// id_grupo
			$grupo_secciones->id_grupo->LinkCustomAttributes = "";
			$grupo_secciones->id_grupo->HrefValue = "";
			$grupo_secciones->id_grupo->TooltipValue = "";

			// id_contenido
			$grupo_secciones->id_contenido->LinkCustomAttributes = "";
			$grupo_secciones->id_contenido->HrefValue = "";
			$grupo_secciones->id_contenido->TooltipValue = "";

			// orden
			$grupo_secciones->orden->LinkCustomAttributes = "";
			$grupo_secciones->orden->HrefValue = "";
			$grupo_secciones->orden->TooltipValue = "";

			// estatus
			$grupo_secciones->estatus->LinkCustomAttributes = "";
			$grupo_secciones->estatus->HrefValue = "";
			$grupo_secciones->estatus->TooltipValue = "";
		} elseif ($grupo_secciones->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_grupo
			$grupo_secciones->id_grupo->EditCustomAttributes = "";

			// id_contenido
			$grupo_secciones->id_contenido->EditCustomAttributes = "";
			if ($grupo_secciones->id_contenido->getSessionValue() <> "") {
				$grupo_secciones->id_contenido->CurrentValue = $grupo_secciones->id_contenido->getSessionValue();
				$grupo_secciones->id_contenido->OldValue = $grupo_secciones->id_contenido->CurrentValue;
			if (strval($grupo_secciones->id_contenido->CurrentValue) <> "") {
				$sFilterWrk = "`id_contenido` = " . ew_AdjustSql($grupo_secciones->id_contenido->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo_secciones->id_contenido->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo_secciones->id_contenido->ViewValue = $grupo_secciones->id_contenido->CurrentValue;
				}
			} else {
				$grupo_secciones->id_contenido->ViewValue = NULL;
			}
			$grupo_secciones->id_contenido->ViewCustomAttributes = "";
			} else {
			}

			// orden
			$grupo_secciones->orden->EditCustomAttributes = "";
			$grupo_secciones->orden->EditValue = ew_HtmlEncode($grupo_secciones->orden->CurrentValue);

			// estatus
			$grupo_secciones->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $grupo_secciones->estatus->FldTagCaption(1) <> "" ? $grupo_secciones->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $grupo_secciones->estatus->FldTagCaption(2) <> "" ? $grupo_secciones->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$grupo_secciones->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_grupo

			$grupo_secciones->id_grupo->HrefValue = "";

			// id_contenido
			$grupo_secciones->id_contenido->HrefValue = "";

			// orden
			$grupo_secciones->orden->HrefValue = "";

			// estatus
			$grupo_secciones->estatus->HrefValue = "";
		} elseif ($grupo_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_grupo
			$grupo_secciones->id_grupo->EditCustomAttributes = "";

			// id_contenido
			$grupo_secciones->id_contenido->EditCustomAttributes = "";
			if ($grupo_secciones->id_contenido->getSessionValue() <> "") {
				$grupo_secciones->id_contenido->CurrentValue = $grupo_secciones->id_contenido->getSessionValue();
				$grupo_secciones->id_contenido->OldValue = $grupo_secciones->id_contenido->CurrentValue;
			if (strval($grupo_secciones->id_contenido->CurrentValue) <> "") {
				$sFilterWrk = "`id_contenido` = " . ew_AdjustSql($grupo_secciones->id_contenido->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo_secciones->id_contenido->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo_secciones->id_contenido->ViewValue = $grupo_secciones->id_contenido->CurrentValue;
				}
			} else {
				$grupo_secciones->id_contenido->ViewValue = NULL;
			}
			$grupo_secciones->id_contenido->ViewCustomAttributes = "";
			} else {
			}

			// orden
			$grupo_secciones->orden->EditCustomAttributes = "";
			$grupo_secciones->orden->EditValue = ew_HtmlEncode($grupo_secciones->orden->CurrentValue);

			// estatus
			$grupo_secciones->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $grupo_secciones->estatus->FldTagCaption(1) <> "" ? $grupo_secciones->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $grupo_secciones->estatus->FldTagCaption(2) <> "" ? $grupo_secciones->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$grupo_secciones->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_grupo

			$grupo_secciones->id_grupo->HrefValue = "";

			// id_contenido
			$grupo_secciones->id_contenido->HrefValue = "";

			// orden
			$grupo_secciones->orden->HrefValue = "";

			// estatus
			$grupo_secciones->estatus->HrefValue = "";
		}
		if ($grupo_secciones->RowType == EW_ROWTYPE_ADD ||
			$grupo_secciones->RowType == EW_ROWTYPE_EDIT ||
			$grupo_secciones->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$grupo_secciones->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($grupo_secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grupo_secciones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $grupo_secciones;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($grupo_secciones->id_grupo->FormValue) && $grupo_secciones->id_grupo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $grupo_secciones->id_grupo->FldCaption());
		}
		if (!is_null($grupo_secciones->id_contenido->FormValue) && $grupo_secciones->id_contenido->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $grupo_secciones->id_contenido->FldCaption());
		}
		if (!ew_CheckInteger($grupo_secciones->orden->FormValue)) {
			ew_AddMessage($gsFormError, $grupo_secciones->orden->FldErrMsg());
		}
		if (!is_null($grupo_secciones->estatus->FormValue) && $grupo_secciones->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $grupo_secciones->estatus->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $grupo_secciones;
		$DeleteRows = TRUE;
		$sSql = $grupo_secciones->SQL();
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
		$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $grupo_secciones->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_grupo_seccion'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($grupo_secciones->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($grupo_secciones->CancelMessage <> "") {
				$this->setFailureMessage($grupo_secciones->CancelMessage);
				$grupo_secciones->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			if ($DeleteRows) {
				foreach ($rsold as $row)
					$this->WriteAuditTrailOnDelete($row);
			}
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$grupo_secciones->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $grupo_secciones;
		$sFilter = $grupo_secciones->KeyFilter();
		$grupo_secciones->CurrentFilter = $sFilter;
		$sSql = $grupo_secciones->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// id_grupo
			$grupo_secciones->id_grupo->SetDbValueDef($rsnew, $grupo_secciones->id_grupo->CurrentValue, NULL, $grupo_secciones->id_grupo->ReadOnly);

			// id_contenido
			$grupo_secciones->id_contenido->SetDbValueDef($rsnew, $grupo_secciones->id_contenido->CurrentValue, NULL, $grupo_secciones->id_contenido->ReadOnly);

			// orden
			$grupo_secciones->orden->SetDbValueDef($rsnew, $grupo_secciones->orden->CurrentValue, NULL, $grupo_secciones->orden->ReadOnly);

			// estatus
			$grupo_secciones->estatus->SetDbValueDef($rsnew, $grupo_secciones->estatus->CurrentValue, NULL, $grupo_secciones->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $grupo_secciones->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($grupo_secciones->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($grupo_secciones->CancelMessage <> "") {
					$this->setFailureMessage($grupo_secciones->CancelMessage);
					$grupo_secciones->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$grupo_secciones->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $grupo_secciones;

		// Set up foreign key field value from Session
			if ($grupo_secciones->getCurrentMasterTable() == "contenidos") {
				$grupo_secciones->id_contenido->CurrentValue = $grupo_secciones->id_contenido->getSessionValue();
			}
		$rsnew = array();

		// id_grupo
		$grupo_secciones->id_grupo->SetDbValueDef($rsnew, $grupo_secciones->id_grupo->CurrentValue, NULL, FALSE);

		// id_contenido
		$grupo_secciones->id_contenido->SetDbValueDef($rsnew, $grupo_secciones->id_contenido->CurrentValue, NULL, FALSE);

		// orden
		$grupo_secciones->orden->SetDbValueDef($rsnew, $grupo_secciones->orden->CurrentValue, NULL, FALSE);

		// estatus
		$grupo_secciones->estatus->SetDbValueDef($rsnew, $grupo_secciones->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $grupo_secciones->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($grupo_secciones->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($grupo_secciones->CancelMessage <> "") {
				$this->setFailureMessage($grupo_secciones->CancelMessage);
				$grupo_secciones->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$grupo_secciones->id_grupo_seccion->setDbValue($conn->Insert_ID());
			$rsnew['id_grupo_seccion'] = $grupo_secciones->id_grupo_seccion->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$grupo_secciones->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $grupo_secciones;

		// Hide foreign keys
		$sMasterTblVar = $grupo_secciones->getCurrentMasterTable();
		if ($sMasterTblVar == "contenidos") {
			$grupo_secciones->id_contenido->Visible = FALSE;
			if ($GLOBALS["contenidos"]->EventCancelled) $grupo_secciones->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $grupo_secciones->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $grupo_secciones->getDetailFilter(); // Get detail filter
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("", "");
		$dompdf->render();
		ob_end_clean();
		ew_DeleteTmpImages();
		$dompdf->stream($gsExportFile . ".pdf", array("Attachment" => 1)); // 0 to open in browser, 1 to download

//		exit();
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'grupo_secciones';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $grupo_secciones;
		$table = 'grupo_secciones';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_grupo_seccion'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($grupo_secciones->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($grupo_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($grupo_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $grupo_secciones;
		$table = 'grupo_secciones';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_grupo_seccion'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($grupo_secciones->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($grupo_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($grupo_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($grupo_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $grupo_secciones;
		$table = 'grupo_secciones';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_grupo_seccion'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $grupo_secciones->fields) && $grupo_secciones->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($grupo_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($grupo_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
