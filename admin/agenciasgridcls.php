<?php

//
// Page class
//
class cagencias_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'agencias';

	// Page object name
	var $PageObjName = 'agencias_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $agencias;
		if ($agencias->UseTokenInUrl) $PageUrl .= "t=" . $agencias->TableVar . "&"; // Add page token
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
		global $objForm, $agencias;
		if ($agencias->UseTokenInUrl) {
			if ($objForm)
				return ($agencias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($agencias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cagencias_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (agencias)
		if (!isset($GLOBALS["agencias"])) {
			$GLOBALS["agencias"] = new cagencias();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["agencias"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'agencias', TRUE);

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
		global $agencias;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$agencias->GridAddRowCount = $gridaddcnt;

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
		global $agencias;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $agencias;

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
			if ($agencias->Export <> "" ||
				$agencias->CurrentAction == "gridadd" ||
				$agencias->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($agencias->AllowAddDeleteRow) {
				if ($agencias->CurrentAction == "gridadd" ||
					$agencias->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($agencias->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $agencias->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $agencias->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $agencias->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($agencias->getMasterFilter() <> "" && $agencias->getCurrentMasterTable() == "agencias_servicios") {
			global $agencias_servicios;
			$rsmaster = $agencias_servicios->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($agencias->getReturnUrl()); // Return to caller
			} else {
				$agencias_servicios->LoadListRowValues($rsmaster);
				$agencias_servicios->RowType = EW_ROWTYPE_MASTER; // Master row
				$agencias_servicios->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$agencias->setSessionWhere($sFilter);
		$agencias->CurrentFilter = "";
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $agencias;
		$agencias->LastAction = $agencias->CurrentAction; // Save last action
		$agencias->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $agencias;
		$bGridUpdate = TRUE;

		// Get old recordset
		$agencias->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $agencias->SQL();
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
						$agencias->CurrentFilter = $agencias->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$agencias->SendEmail = FALSE; // Do not send email on update success
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
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$agencias->EventCancelled = TRUE; // Set event cancelled
			$agencias->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $agencias;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $agencias->KeyFilter();
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
		global $agencias;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$agencias->id_agencias->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($agencias->id_agencias->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $agencias;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
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
				$agencias->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $agencias->id_agencias->CurrentValue;

					// Add filter for this record
					$sFilter = $agencias->KeyFilter();
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
			$agencias->CurrentFilter = $sWrkFilter;
			$sSql = $agencias->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$agencias->EventCancelled = TRUE; // Set event cancelled
			$agencias->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $agencias, $objForm;
		if ($objForm->HasValue("x_nombre") && $objForm->HasValue("o_nombre") && $agencias->nombre->CurrentValue <> $agencias->nombre->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_id_ciudad") && $objForm->HasValue("o_id_ciudad") && $agencias->id_ciudad->CurrentValue <> $agencias->id_ciudad->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estatus") && $objForm->HasValue("o_estatus") && $agencias->estatus->CurrentValue <> $agencias->estatus->OldValue)
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
		global $objForm, $agencias;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $agencias;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$agencias->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$agencias->CurrentOrderType = @$_GET["ordertype"];
			$agencias->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $agencias;
		$sOrderBy = $agencias->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($agencias->SqlOrderBy() <> "") {
				$sOrderBy = $agencias->SqlOrderBy();
				$agencias->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $agencias;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$agencias->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$agencias->id_agencias->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$agencias->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$agencias->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $agencias;

		// "griddelete"
		if ($agencias->AllowAddDeleteRow) {
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
		global $Security, $Language, $agencias, $objForm;
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
			if ($this->RowAction == "insert" && $agencias->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($agencias->AllowAddDeleteRow) {
			if ($agencias->CurrentMode == "add" || $agencias->CurrentMode == "copy" || $agencias->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, agencias_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
			}
		}
		if ($agencias->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $agencias->id_agencias->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('id_agencias');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $agencias;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $agencias;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$agencias->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$agencias->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $agencias->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$agencias->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$agencias->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$agencias->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $agencias;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $agencias;
		$agencias->nombre->CurrentValue = NULL;
		$agencias->nombre->OldValue = $agencias->nombre->CurrentValue;
		$agencias->id_ciudad->CurrentValue = NULL;
		$agencias->id_ciudad->OldValue = $agencias->id_ciudad->CurrentValue;
		$agencias->estatus->CurrentValue = NULL;
		$agencias->estatus->OldValue = $agencias->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $agencias;
		if (!$agencias->nombre->FldIsDetailKey) {
			$agencias->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		$agencias->nombre->setOldValue($objForm->GetValue("o_nombre"));
		if (!$agencias->id_ciudad->FldIsDetailKey) {
			$agencias->id_ciudad->setFormValue($objForm->GetValue("x_id_ciudad"));
		}
		$agencias->id_ciudad->setOldValue($objForm->GetValue("o_id_ciudad"));
		if (!$agencias->estatus->FldIsDetailKey) {
			$agencias->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		$agencias->estatus->setOldValue($objForm->GetValue("o_estatus"));
		if (!$agencias->id_agencias->FldIsDetailKey && $agencias->CurrentAction <> "gridadd" && $agencias->CurrentAction <> "add")
			$agencias->id_agencias->setFormValue($objForm->GetValue("x_id_agencias"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $agencias;
		if ($agencias->CurrentAction <> "gridadd" && $agencias->CurrentAction <> "add")
			$agencias->id_agencias->CurrentValue = $agencias->id_agencias->FormValue;
		$agencias->nombre->CurrentValue = $agencias->nombre->FormValue;
		$agencias->id_ciudad->CurrentValue = $agencias->id_ciudad->FormValue;
		$agencias->estatus->CurrentValue = $agencias->estatus->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $agencias;

		// Call Recordset Selecting event
		$agencias->Recordset_Selecting($agencias->CurrentFilter);

		// Load List page SQL
		$sSql = $agencias->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$agencias->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $agencias;
		$sFilter = $agencias->KeyFilter();

		// Call Row Selecting event
		$agencias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$agencias->CurrentFilter = $sFilter;
		$sSql = $agencias->SQL();
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
		global $conn, $agencias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$agencias->Row_Selected($row);
		$agencias->id_agencias->setDbValue($rs->fields('id_agencias'));
		$agencias->nombre->setDbValue($rs->fields('nombre'));
		$agencias->direccion->setDbValue($rs->fields('direccion'));
		$agencias->id_ciudad->setDbValue($rs->fields('id_ciudad'));
		$agencias->telef_1->setDbValue($rs->fields('telef_1'));
		$agencias->horario_agencia->setDbValue($rs->fields('horario_agencia'));
		$agencias->horario_taq_auto->setDbValue($rs->fields('horario_taq_auto'));
		$agencias->coordenadas->setDbValue($rs->fields('coordenadas'));
		$agencias->citas_diarias->setDbValue($rs->fields('citas_diarias'));
		$agencias->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $agencias;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$agencias->id_agencias->CurrentValue = strval($arKeys[0]); // id_agencias
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$agencias->CurrentFilter = $agencias->KeyFilter();
			$sSql = $agencias->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $agencias;

		// Initialize URLs
		// Call Row_Rendering event

		$agencias->Row_Rendering();

		// Common render codes for all row types
		// id_agencias
		// nombre
		// direccion
		// id_ciudad
		// telef_1
		// horario_agencia
		// horario_taq_auto
		// coordenadas
		// citas_diarias
		// estatus

		if ($agencias->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_agencias
			$agencias->id_agencias->ViewValue = $agencias->id_agencias->CurrentValue;
			$agencias->id_agencias->ViewCustomAttributes = "";

			// nombre
			$agencias->nombre->ViewValue = $agencias->nombre->CurrentValue;
			$agencias->nombre->ViewCustomAttributes = "";

			// id_ciudad
			if (strval($agencias->id_ciudad->CurrentValue) <> "") {
				$sFilterWrk = "`id_ciudad` = " . ew_AdjustSql($agencias->id_ciudad->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `ciudad`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$agencias->id_ciudad->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$agencias->id_ciudad->ViewValue = $agencias->id_ciudad->CurrentValue;
				}
			} else {
				$agencias->id_ciudad->ViewValue = NULL;
			}
			$agencias->id_ciudad->ViewCustomAttributes = "";

			// horario_taq_auto
			$agencias->horario_taq_auto->ViewValue = $agencias->horario_taq_auto->CurrentValue;
			$agencias->horario_taq_auto->ViewCustomAttributes = "";

			// coordenadas
			$agencias->coordenadas->ViewValue = $agencias->coordenadas->CurrentValue;
			$agencias->coordenadas->ViewCustomAttributes = "";

			// citas_diarias
			$agencias->citas_diarias->ViewValue = $agencias->citas_diarias->CurrentValue;
			$agencias->citas_diarias->ViewCustomAttributes = "";

			// estatus
			if (strval($agencias->estatus->CurrentValue) <> "") {
				switch ($agencias->estatus->CurrentValue) {
					case "0":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(1) <> "" ? $agencias->estatus->FldTagCaption(1) : $agencias->estatus->CurrentValue;
						break;
					case "1":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(2) <> "" ? $agencias->estatus->FldTagCaption(2) : $agencias->estatus->CurrentValue;
						break;
					case "3":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(3) <> "" ? $agencias->estatus->FldTagCaption(3) : $agencias->estatus->CurrentValue;
						break;
					case "4":
						$agencias->estatus->ViewValue = $agencias->estatus->FldTagCaption(4) <> "" ? $agencias->estatus->FldTagCaption(4) : $agencias->estatus->CurrentValue;
						break;
					default:
						$agencias->estatus->ViewValue = $agencias->estatus->CurrentValue;
				}
			} else {
				$agencias->estatus->ViewValue = NULL;
			}
			$agencias->estatus->ViewCustomAttributes = "";

			// nombre
			$agencias->nombre->LinkCustomAttributes = "";
			$agencias->nombre->HrefValue = "";
			$agencias->nombre->TooltipValue = "";

			// id_ciudad
			$agencias->id_ciudad->LinkCustomAttributes = "";
			$agencias->id_ciudad->HrefValue = "";
			$agencias->id_ciudad->TooltipValue = "";

			// estatus
			$agencias->estatus->LinkCustomAttributes = "";
			$agencias->estatus->HrefValue = "";
			$agencias->estatus->TooltipValue = "";
		} elseif ($agencias->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$agencias->nombre->EditCustomAttributes = "";
			$agencias->nombre->EditValue = ew_HtmlEncode($agencias->nombre->CurrentValue);

			// id_ciudad
			$agencias->id_ciudad->EditCustomAttributes = "";

			// estatus
			$agencias->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", $agencias->estatus->FldTagCaption(1) <> "" ? $agencias->estatus->FldTagCaption(1) : "0");
			$arwrk[] = array("1", $agencias->estatus->FldTagCaption(2) <> "" ? $agencias->estatus->FldTagCaption(2) : "1");
			$arwrk[] = array("3", $agencias->estatus->FldTagCaption(3) <> "" ? $agencias->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $agencias->estatus->FldTagCaption(4) <> "" ? $agencias->estatus->FldTagCaption(4) : "4");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$agencias->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$agencias->nombre->HrefValue = "";

			// id_ciudad
			$agencias->id_ciudad->HrefValue = "";

			// estatus
			$agencias->estatus->HrefValue = "";
		} elseif ($agencias->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$agencias->nombre->EditCustomAttributes = "";
			$agencias->nombre->EditValue = ew_HtmlEncode($agencias->nombre->CurrentValue);

			// id_ciudad
			$agencias->id_ciudad->EditCustomAttributes = "";

			// estatus
			$agencias->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", $agencias->estatus->FldTagCaption(1) <> "" ? $agencias->estatus->FldTagCaption(1) : "0");
			$arwrk[] = array("1", $agencias->estatus->FldTagCaption(2) <> "" ? $agencias->estatus->FldTagCaption(2) : "1");
			$arwrk[] = array("3", $agencias->estatus->FldTagCaption(3) <> "" ? $agencias->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $agencias->estatus->FldTagCaption(4) <> "" ? $agencias->estatus->FldTagCaption(4) : "4");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$agencias->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$agencias->nombre->HrefValue = "";

			// id_ciudad
			$agencias->id_ciudad->HrefValue = "";

			// estatus
			$agencias->estatus->HrefValue = "";
		}
		if ($agencias->RowType == EW_ROWTYPE_ADD ||
			$agencias->RowType == EW_ROWTYPE_EDIT ||
			$agencias->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$agencias->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($agencias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$agencias->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $agencias;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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
		global $conn, $Language, $Security, $agencias;
		$DeleteRows = TRUE;
		$sSql = $agencias->SQL();
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

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $agencias->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_agencias'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($agencias->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($agencias->CancelMessage <> "") {
				$this->setFailureMessage($agencias->CancelMessage);
				$agencias->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$agencias->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $agencias;
		$sFilter = $agencias->KeyFilter();
		$agencias->CurrentFilter = $sFilter;
		$sSql = $agencias->SQL();
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

			// nombre
			$agencias->nombre->SetDbValueDef($rsnew, $agencias->nombre->CurrentValue, NULL, $agencias->nombre->ReadOnly);

			// id_ciudad
			$agencias->id_ciudad->SetDbValueDef($rsnew, $agencias->id_ciudad->CurrentValue, NULL, $agencias->id_ciudad->ReadOnly);

			// estatus
			$agencias->estatus->SetDbValueDef($rsnew, $agencias->estatus->CurrentValue, NULL, $agencias->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $agencias->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($agencias->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($agencias->CancelMessage <> "") {
					$this->setFailureMessage($agencias->CancelMessage);
					$agencias->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$agencias->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $agencias;

		// Set up foreign key field value from Session
			if ($agencias->getCurrentMasterTable() == "agencias_servicios") {
				$agencias->id_agencias->CurrentValue = $agencias->id_agencias->getSessionValue();
			}
		$rsnew = array();

		// nombre
		$agencias->nombre->SetDbValueDef($rsnew, $agencias->nombre->CurrentValue, NULL, FALSE);

		// id_ciudad
		$agencias->id_ciudad->SetDbValueDef($rsnew, $agencias->id_ciudad->CurrentValue, NULL, FALSE);

		// estatus
		$agencias->estatus->SetDbValueDef($rsnew, $agencias->estatus->CurrentValue, NULL, FALSE);

		// id_agencias
		if ($agencias->id_agencias->getSessionValue() <> "") {
			$rsnew['id_agencias'] = $agencias->id_agencias->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $agencias->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($agencias->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($agencias->CancelMessage <> "") {
				$this->setFailureMessage($agencias->CancelMessage);
				$agencias->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$agencias->id_agencias->setDbValue($conn->Insert_ID());
			$rsnew['id_agencias'] = $agencias->id_agencias->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$agencias->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $agencias;

		// Hide foreign keys
		$sMasterTblVar = $agencias->getCurrentMasterTable();
		if ($sMasterTblVar == "agencias_servicios") {
			$agencias->id_agencias->Visible = FALSE;
			if ($GLOBALS["agencias_servicios"]->EventCancelled) $agencias->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $agencias->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $agencias->getDetailFilter(); // Get detail filter
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
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
