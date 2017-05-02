<?php include_once "usuariosinfo.php" ?>
<?php

//
// Page class
//
class cdocumentos_secciones_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'documentos_secciones';

	// Page object name
	var $PageObjName = 'documentos_secciones_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) $PageUrl .= "t=" . $documentos_secciones->TableVar . "&"; // Add page token
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
		global $objForm, $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) {
			if ($objForm)
				return ($documentos_secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documentos_secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumentos_secciones_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documentos_secciones)
		if (!isset($GLOBALS["documentos_secciones"])) {
			$GLOBALS["documentos_secciones"] = new cdocumentos_secciones();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["documentos_secciones"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documentos_secciones', TRUE);

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
		global $documentos_secciones;

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
			$documentos_secciones->GridAddRowCount = $gridaddcnt;

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
		global $documentos_secciones;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $documentos_secciones;

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
			if ($documentos_secciones->Export <> "" ||
				$documentos_secciones->CurrentAction == "gridadd" ||
				$documentos_secciones->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($documentos_secciones->AllowAddDeleteRow) {
				if ($documentos_secciones->CurrentAction == "gridadd" ||
					$documentos_secciones->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($documentos_secciones->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $documentos_secciones->getRecordsPerPage(); // Restore from Session
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
		$this->DbMasterFilter = $documentos_secciones->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $documentos_secciones->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($documentos_secciones->getMasterFilter() <> "" && $documentos_secciones->getCurrentMasterTable() == "documentos") {
			global $documentos;
			$rsmaster = $documentos->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($documentos_secciones->getReturnUrl()); // Return to caller
			} else {
				$documentos->LoadListRowValues($rsmaster);
				$documentos->RowType = EW_ROWTYPE_MASTER; // Master row
				$documentos->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$documentos_secciones->setSessionWhere($sFilter);
		$documentos_secciones->CurrentFilter = "";
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $documentos_secciones;
		$documentos_secciones->LastAction = $documentos_secciones->CurrentAction; // Save last action
		$documentos_secciones->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $documentos_secciones;
		$bGridUpdate = TRUE;
		$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin

		// Get old recordset
		$documentos_secciones->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $documentos_secciones->SQL();
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
						$documentos_secciones->CurrentFilter = $documentos_secciones->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$documentos_secciones->SendEmail = FALSE; // Do not send email on update success
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
			$documentos_secciones->EventCancelled = TRUE; // Set event cancelled
			$documentos_secciones->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $documentos_secciones;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $documentos_secciones->KeyFilter();
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
		global $documentos_secciones;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$documentos_secciones->id_documentos_secciones->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($documentos_secciones->id_documentos_secciones->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $documentos_secciones;
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
				$documentos_secciones->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $documentos_secciones->id_documentos_secciones->CurrentValue;

					// Add filter for this record
					$sFilter = $documentos_secciones->KeyFilter();
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
			$documentos_secciones->CurrentFilter = $sWrkFilter;
			$sSql = $documentos_secciones->SQL();
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
			$documentos_secciones->EventCancelled = TRUE; // Set event cancelled
			$documentos_secciones->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $documentos_secciones, $objForm;
		if ($objForm->HasValue("x_id_documentos") && $objForm->HasValue("o_id_documentos") && $documentos_secciones->id_documentos->CurrentValue <> $documentos_secciones->id_documentos->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_id_grupo_sec") && $objForm->HasValue("o_id_grupo_sec") && $documentos_secciones->id_grupo_sec->CurrentValue <> $documentos_secciones->id_grupo_sec->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_inicio") && $objForm->HasValue("o_fecha_inicio") && $documentos_secciones->fecha_inicio->CurrentValue <> $documentos_secciones->fecha_inicio->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_fin") && $objForm->HasValue("o_fecha_fin") && $documentos_secciones->fecha_fin->CurrentValue <> $documentos_secciones->fecha_fin->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha") && $objForm->HasValue("o_fecha") && $documentos_secciones->fecha->CurrentValue <> $documentos_secciones->fecha->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estatus") && $objForm->HasValue("o_estatus") && $documentos_secciones->estatus->CurrentValue <> $documentos_secciones->estatus->OldValue)
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
		global $objForm, $documentos_secciones;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $documentos_secciones;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$documentos_secciones->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$documentos_secciones->CurrentOrderType = @$_GET["ordertype"];
			$documentos_secciones->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $documentos_secciones;
		$sOrderBy = $documentos_secciones->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($documentos_secciones->SqlOrderBy() <> "") {
				$sOrderBy = $documentos_secciones->SqlOrderBy();
				$documentos_secciones->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $documentos_secciones;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$documentos_secciones->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$documentos_secciones->id_documentos->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$documentos_secciones->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $documentos_secciones;

		// "griddelete"
		if ($documentos_secciones->AllowAddDeleteRow) {
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
		global $Security, $Language, $documentos_secciones, $objForm;
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
			if ($this->RowAction == "insert" && $documentos_secciones->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($documentos_secciones->AllowAddDeleteRow) {
			if ($documentos_secciones->CurrentMode == "add" || $documentos_secciones->CurrentMode == "copy" || $documentos_secciones->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, documentos_secciones_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($documentos_secciones->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $documentos_secciones->id_documentos_secciones->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('id_documentos_secciones');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $documentos_secciones;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $documentos_secciones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$documentos_secciones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$documentos_secciones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $documentos_secciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $documentos_secciones;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $documentos_secciones;
		$documentos_secciones->id_documentos->CurrentValue = NULL;
		$documentos_secciones->id_documentos->OldValue = $documentos_secciones->id_documentos->CurrentValue;
		$documentos_secciones->id_grupo_sec->CurrentValue = NULL;
		$documentos_secciones->id_grupo_sec->OldValue = $documentos_secciones->id_grupo_sec->CurrentValue;
		$documentos_secciones->fecha_inicio->CurrentValue = NULL;
		$documentos_secciones->fecha_inicio->OldValue = $documentos_secciones->fecha_inicio->CurrentValue;
		$documentos_secciones->fecha_fin->CurrentValue = NULL;
		$documentos_secciones->fecha_fin->OldValue = $documentos_secciones->fecha_fin->CurrentValue;
		$documentos_secciones->fecha->CurrentValue = ew_CurrentDate();
		$documentos_secciones->fecha->OldValue = $documentos_secciones->fecha->CurrentValue;
		$documentos_secciones->estatus->CurrentValue = NULL;
		$documentos_secciones->estatus->OldValue = $documentos_secciones->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $documentos_secciones;
		if (!$documentos_secciones->id_documentos->FldIsDetailKey) {
			$documentos_secciones->id_documentos->setFormValue($objForm->GetValue("x_id_documentos"));
		}
		$documentos_secciones->id_documentos->setOldValue($objForm->GetValue("o_id_documentos"));
		if (!$documentos_secciones->id_grupo_sec->FldIsDetailKey) {
			$documentos_secciones->id_grupo_sec->setFormValue($objForm->GetValue("x_id_grupo_sec"));
		}
		$documentos_secciones->id_grupo_sec->setOldValue($objForm->GetValue("o_id_grupo_sec"));
		if (!$documentos_secciones->fecha_inicio->FldIsDetailKey) {
			$documentos_secciones->fecha_inicio->setFormValue($objForm->GetValue("x_fecha_inicio"));
			$documentos_secciones->fecha_inicio->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7);
		}
		$documentos_secciones->fecha_inicio->setOldValue($objForm->GetValue("o_fecha_inicio"));
		if (!$documentos_secciones->fecha_fin->FldIsDetailKey) {
			$documentos_secciones->fecha_fin->setFormValue($objForm->GetValue("x_fecha_fin"));
			$documentos_secciones->fecha_fin->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7);
		}
		$documentos_secciones->fecha_fin->setOldValue($objForm->GetValue("o_fecha_fin"));
		if (!$documentos_secciones->fecha->FldIsDetailKey) {
			$documentos_secciones->fecha->setFormValue($objForm->GetValue("x_fecha"));
			$documentos_secciones->fecha->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha->CurrentValue, 7);
		}
		$documentos_secciones->fecha->setOldValue($objForm->GetValue("o_fecha"));
		if (!$documentos_secciones->estatus->FldIsDetailKey) {
			$documentos_secciones->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		$documentos_secciones->estatus->setOldValue($objForm->GetValue("o_estatus"));
		if (!$documentos_secciones->id_documentos_secciones->FldIsDetailKey && $documentos_secciones->CurrentAction <> "gridadd" && $documentos_secciones->CurrentAction <> "add")
			$documentos_secciones->id_documentos_secciones->setFormValue($objForm->GetValue("x_id_documentos_secciones"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $documentos_secciones;
		if ($documentos_secciones->CurrentAction <> "gridadd" && $documentos_secciones->CurrentAction <> "add")
			$documentos_secciones->id_documentos_secciones->CurrentValue = $documentos_secciones->id_documentos_secciones->FormValue;
		$documentos_secciones->id_documentos->CurrentValue = $documentos_secciones->id_documentos->FormValue;
		$documentos_secciones->id_grupo_sec->CurrentValue = $documentos_secciones->id_grupo_sec->FormValue;
		$documentos_secciones->fecha_inicio->CurrentValue = $documentos_secciones->fecha_inicio->FormValue;
		$documentos_secciones->fecha_inicio->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7);
		$documentos_secciones->fecha_fin->CurrentValue = $documentos_secciones->fecha_fin->FormValue;
		$documentos_secciones->fecha_fin->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7);
		$documentos_secciones->fecha->CurrentValue = $documentos_secciones->fecha->FormValue;
		$documentos_secciones->fecha->CurrentValue = ew_UnFormatDateTime($documentos_secciones->fecha->CurrentValue, 7);
		$documentos_secciones->estatus->CurrentValue = $documentos_secciones->estatus->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $documentos_secciones;

		// Call Recordset Selecting event
		$documentos_secciones->Recordset_Selecting($documentos_secciones->CurrentFilter);

		// Load List page SQL
		$sSql = $documentos_secciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$documentos_secciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documentos_secciones;
		$sFilter = $documentos_secciones->KeyFilter();

		// Call Row Selecting event
		$documentos_secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documentos_secciones->CurrentFilter = $sFilter;
		$sSql = $documentos_secciones->SQL();
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
		global $conn, $documentos_secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documentos_secciones->Row_Selected($row);
		$documentos_secciones->id_documentos_secciones->setDbValue($rs->fields('id_documentos_secciones'));
		$documentos_secciones->id_documentos->setDbValue($rs->fields('id_documentos'));
		$documentos_secciones->id_grupo_sec->setDbValue($rs->fields('id_grupo_sec'));
		$documentos_secciones->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$documentos_secciones->fecha_fin->setDbValue($rs->fields('fecha_fin'));
		$documentos_secciones->fecha->setDbValue($rs->fields('fecha'));
		$documentos_secciones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $documentos_secciones;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$documentos_secciones->id_documentos_secciones->CurrentValue = strval($arKeys[0]); // id_documentos_secciones
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$documentos_secciones->CurrentFilter = $documentos_secciones->KeyFilter();
			$sSql = $documentos_secciones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documentos_secciones;

		// Initialize URLs
		// Call Row_Rendering event

		$documentos_secciones->Row_Rendering();

		// Common render codes for all row types
		// id_documentos_secciones
		// id_documentos
		// id_grupo_sec
		// fecha_inicio
		// fecha_fin
		// fecha
		// estatus

		if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_documentos
			if (strval($documentos_secciones->id_documentos->CurrentValue) <> "") {
				$sFilterWrk = "`id_documentos` = " . ew_AdjustSql($documentos_secciones->id_documentos->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `documentos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_documentos->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_documentos->ViewValue = $documentos_secciones->id_documentos->CurrentValue;
				}
			} else {
				$documentos_secciones->id_documentos->ViewValue = NULL;
			}
			$documentos_secciones->id_documentos->ViewCustomAttributes = "";

			// id_grupo_sec
			if (strval($documentos_secciones->id_grupo_sec->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($documentos_secciones->id_grupo_sec->CurrentValue) . "";
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
					$documentos_secciones->id_grupo_sec->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_grupo_sec->ViewValue = $documentos_secciones->id_grupo_sec->CurrentValue;
				}
			} else {
				$documentos_secciones->id_grupo_sec->ViewValue = NULL;
			}
			$documentos_secciones->id_grupo_sec->ViewCustomAttributes = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->ViewValue = $documentos_secciones->fecha_inicio->CurrentValue;
			$documentos_secciones->fecha_inicio->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_inicio->ViewValue, 7);
			$documentos_secciones->fecha_inicio->ViewCustomAttributes = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->ViewValue = $documentos_secciones->fecha_fin->CurrentValue;
			$documentos_secciones->fecha_fin->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_fin->ViewValue, 7);
			$documentos_secciones->fecha_fin->ViewCustomAttributes = "";

			// fecha
			$documentos_secciones->fecha->ViewValue = $documentos_secciones->fecha->CurrentValue;
			$documentos_secciones->fecha->ViewValue = ew_FormatDateTime($documentos_secciones->fecha->ViewValue, 7);
			$documentos_secciones->fecha->ViewCustomAttributes = "";

			// estatus
			if (strval($documentos_secciones->estatus->CurrentValue) <> "") {
				switch ($documentos_secciones->estatus->CurrentValue) {
					case "1":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(1) <> "" ? $documentos_secciones->estatus->FldTagCaption(1) : $documentos_secciones->estatus->CurrentValue;
						break;
					case "0":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(2) <> "" ? $documentos_secciones->estatus->FldTagCaption(2) : $documentos_secciones->estatus->CurrentValue;
						break;
					default:
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->CurrentValue;
				}
			} else {
				$documentos_secciones->estatus->ViewValue = NULL;
			}
			$documentos_secciones->estatus->ViewCustomAttributes = "";

			// id_documentos
			$documentos_secciones->id_documentos->LinkCustomAttributes = "";
			$documentos_secciones->id_documentos->HrefValue = "";
			$documentos_secciones->id_documentos->TooltipValue = "";

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->LinkCustomAttributes = "";
			$documentos_secciones->id_grupo_sec->HrefValue = "";
			$documentos_secciones->id_grupo_sec->TooltipValue = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->LinkCustomAttributes = "";
			$documentos_secciones->fecha_inicio->HrefValue = "";
			$documentos_secciones->fecha_inicio->TooltipValue = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->LinkCustomAttributes = "";
			$documentos_secciones->fecha_fin->HrefValue = "";
			$documentos_secciones->fecha_fin->TooltipValue = "";

			// fecha
			$documentos_secciones->fecha->LinkCustomAttributes = "";
			$documentos_secciones->fecha->HrefValue = "";
			$documentos_secciones->fecha->TooltipValue = "";

			// estatus
			$documentos_secciones->estatus->LinkCustomAttributes = "";
			$documentos_secciones->estatus->HrefValue = "";
			$documentos_secciones->estatus->TooltipValue = "";
		} elseif ($documentos_secciones->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_documentos
			$documentos_secciones->id_documentos->EditCustomAttributes = "";
			if ($documentos_secciones->id_documentos->getSessionValue() <> "") {
				$documentos_secciones->id_documentos->CurrentValue = $documentos_secciones->id_documentos->getSessionValue();
				$documentos_secciones->id_documentos->OldValue = $documentos_secciones->id_documentos->CurrentValue;
			if (strval($documentos_secciones->id_documentos->CurrentValue) <> "") {
				$sFilterWrk = "`id_documentos` = " . ew_AdjustSql($documentos_secciones->id_documentos->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `documentos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_documentos->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_documentos->ViewValue = $documentos_secciones->id_documentos->CurrentValue;
				}
			} else {
				$documentos_secciones->id_documentos->ViewValue = NULL;
			}
			$documentos_secciones->id_documentos->ViewCustomAttributes = "";
			} else {
			}

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->EditCustomAttributes = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->EditCustomAttributes = "";
			$documentos_secciones->fecha_inicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7));

			// fecha_fin
			$documentos_secciones->fecha_fin->EditCustomAttributes = "";
			$documentos_secciones->fecha_fin->EditValue = ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7));

			// fecha
			$documentos_secciones->fecha->EditCustomAttributes = "";
			$documentos_secciones->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha->CurrentValue, 7));

			// estatus
			$documentos_secciones->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $documentos_secciones->estatus->FldTagCaption(1) <> "" ? $documentos_secciones->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $documentos_secciones->estatus->FldTagCaption(2) <> "" ? $documentos_secciones->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$documentos_secciones->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_documentos

			$documentos_secciones->id_documentos->HrefValue = "";

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->HrefValue = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->HrefValue = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->HrefValue = "";

			// fecha
			$documentos_secciones->fecha->HrefValue = "";

			// estatus
			$documentos_secciones->estatus->HrefValue = "";
		} elseif ($documentos_secciones->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_documentos
			$documentos_secciones->id_documentos->EditCustomAttributes = "";
			if ($documentos_secciones->id_documentos->getSessionValue() <> "") {
				$documentos_secciones->id_documentos->CurrentValue = $documentos_secciones->id_documentos->getSessionValue();
				$documentos_secciones->id_documentos->OldValue = $documentos_secciones->id_documentos->CurrentValue;
			if (strval($documentos_secciones->id_documentos->CurrentValue) <> "") {
				$sFilterWrk = "`id_documentos` = " . ew_AdjustSql($documentos_secciones->id_documentos->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `documentos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_documentos->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_documentos->ViewValue = $documentos_secciones->id_documentos->CurrentValue;
				}
			} else {
				$documentos_secciones->id_documentos->ViewValue = NULL;
			}
			$documentos_secciones->id_documentos->ViewCustomAttributes = "";
			} else {
			}

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->EditCustomAttributes = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->EditCustomAttributes = "";
			$documentos_secciones->fecha_inicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7));

			// fecha_fin
			$documentos_secciones->fecha_fin->EditCustomAttributes = "";
			$documentos_secciones->fecha_fin->EditValue = ew_HtmlEncode(ew_FormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7));

			// fecha
			$documentos_secciones->fecha->EditCustomAttributes = "";
			$documentos_secciones->fecha->EditValue = $documentos_secciones->fecha->CurrentValue;
			$documentos_secciones->fecha->EditValue = ew_FormatDateTime($documentos_secciones->fecha->EditValue, 7);
			$documentos_secciones->fecha->ViewCustomAttributes = "";

			// estatus
			$documentos_secciones->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $documentos_secciones->estatus->FldTagCaption(1) <> "" ? $documentos_secciones->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $documentos_secciones->estatus->FldTagCaption(2) <> "" ? $documentos_secciones->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$documentos_secciones->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_documentos

			$documentos_secciones->id_documentos->HrefValue = "";

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->HrefValue = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->HrefValue = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->HrefValue = "";

			// fecha
			$documentos_secciones->fecha->HrefValue = "";

			// estatus
			$documentos_secciones->estatus->HrefValue = "";
		}
		if ($documentos_secciones->RowType == EW_ROWTYPE_ADD ||
			$documentos_secciones->RowType == EW_ROWTYPE_EDIT ||
			$documentos_secciones->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$documentos_secciones->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($documentos_secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documentos_secciones->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $documentos_secciones;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($documentos_secciones->id_documentos->FormValue) && $documentos_secciones->id_documentos->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documentos_secciones->id_documentos->FldCaption());
		}
		if (!is_null($documentos_secciones->id_grupo_sec->FormValue) && $documentos_secciones->id_grupo_sec->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documentos_secciones->id_grupo_sec->FldCaption());
		}
		if (!ew_CheckEuroDate($documentos_secciones->fecha_inicio->FormValue)) {
			ew_AddMessage($gsFormError, $documentos_secciones->fecha_inicio->FldErrMsg());
		}
		if (!ew_CheckEuroDate($documentos_secciones->fecha_fin->FormValue)) {
			ew_AddMessage($gsFormError, $documentos_secciones->fecha_fin->FldErrMsg());
		}
		if (!is_null($documentos_secciones->estatus->FormValue) && $documentos_secciones->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documentos_secciones->estatus->FldCaption());
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
		global $conn, $Language, $Security, $documentos_secciones;
		$DeleteRows = TRUE;
		$sSql = $documentos_secciones->SQL();
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
				$DeleteRows = $documentos_secciones->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_documentos_secciones'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($documentos_secciones->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($documentos_secciones->CancelMessage <> "") {
				$this->setFailureMessage($documentos_secciones->CancelMessage);
				$documentos_secciones->CancelMessage = "";
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
				$documentos_secciones->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $documentos_secciones;
		$sFilter = $documentos_secciones->KeyFilter();
		$documentos_secciones->CurrentFilter = $sFilter;
		$sSql = $documentos_secciones->SQL();
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

			// id_documentos
			$documentos_secciones->id_documentos->SetDbValueDef($rsnew, $documentos_secciones->id_documentos->CurrentValue, NULL, $documentos_secciones->id_documentos->ReadOnly);

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->SetDbValueDef($rsnew, $documentos_secciones->id_grupo_sec->CurrentValue, NULL, $documentos_secciones->id_grupo_sec->ReadOnly);

			// fecha_inicio
			$documentos_secciones->fecha_inicio->SetDbValueDef($rsnew, ew_UnFormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7), NULL, $documentos_secciones->fecha_inicio->ReadOnly);

			// fecha_fin
			$documentos_secciones->fecha_fin->SetDbValueDef($rsnew, ew_UnFormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7), NULL, $documentos_secciones->fecha_fin->ReadOnly);

			// estatus
			$documentos_secciones->estatus->SetDbValueDef($rsnew, $documentos_secciones->estatus->CurrentValue, NULL, $documentos_secciones->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $documentos_secciones->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($documentos_secciones->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($documentos_secciones->CancelMessage <> "") {
					$this->setFailureMessage($documentos_secciones->CancelMessage);
					$documentos_secciones->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$documentos_secciones->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $documentos_secciones;

		// Set up foreign key field value from Session
			if ($documentos_secciones->getCurrentMasterTable() == "documentos") {
				$documentos_secciones->id_documentos->CurrentValue = $documentos_secciones->id_documentos->getSessionValue();
			}
		$rsnew = array();

		// id_documentos
		$documentos_secciones->id_documentos->SetDbValueDef($rsnew, $documentos_secciones->id_documentos->CurrentValue, NULL, FALSE);

		// id_grupo_sec
		$documentos_secciones->id_grupo_sec->SetDbValueDef($rsnew, $documentos_secciones->id_grupo_sec->CurrentValue, NULL, FALSE);

		// fecha_inicio
		$documentos_secciones->fecha_inicio->SetDbValueDef($rsnew, ew_UnFormatDateTime($documentos_secciones->fecha_inicio->CurrentValue, 7), NULL, FALSE);

		// fecha_fin
		$documentos_secciones->fecha_fin->SetDbValueDef($rsnew, ew_UnFormatDateTime($documentos_secciones->fecha_fin->CurrentValue, 7), NULL, FALSE);

		// fecha
		$documentos_secciones->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($documentos_secciones->fecha->CurrentValue, 7), NULL, FALSE);

		// estatus
		$documentos_secciones->estatus->SetDbValueDef($rsnew, $documentos_secciones->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $documentos_secciones->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($documentos_secciones->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($documentos_secciones->CancelMessage <> "") {
				$this->setFailureMessage($documentos_secciones->CancelMessage);
				$documentos_secciones->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$documentos_secciones->id_documentos_secciones->setDbValue($conn->Insert_ID());
			$rsnew['id_documentos_secciones'] = $documentos_secciones->id_documentos_secciones->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$documentos_secciones->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $documentos_secciones;

		// Hide foreign keys
		$sMasterTblVar = $documentos_secciones->getCurrentMasterTable();
		if ($sMasterTblVar == "documentos") {
			$documentos_secciones->id_documentos->Visible = FALSE;
			if ($GLOBALS["documentos"]->EventCancelled) $documentos_secciones->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $documentos_secciones->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $documentos_secciones->getDetailFilter(); // Get detail filter
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
		$table = 'documentos_secciones';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $documentos_secciones;
		$table = 'documentos_secciones';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_documentos_secciones'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($documentos_secciones->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
		global $documentos_secciones;
		$table = 'documentos_secciones';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_documentos_secciones'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($documentos_secciones->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
		global $documentos_secciones;
		$table = 'documentos_secciones';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_documentos_secciones'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $documentos_secciones->fields) && $documentos_secciones->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($documentos_secciones->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
