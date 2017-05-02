<?php include_once "usuariosinfo.php" ?>
<?php

//
// Page class
//
class cservicios_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'servicios';

	// Page object name
	var $PageObjName = 'servicios_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $servicios;
		if ($servicios->UseTokenInUrl) $PageUrl .= "t=" . $servicios->TableVar . "&"; // Add page token
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
		global $objForm, $servicios;
		if ($servicios->UseTokenInUrl) {
			if ($objForm)
				return ($servicios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($servicios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cservicios_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (servicios)
		if (!isset($GLOBALS["servicios"])) {
			$GLOBALS["servicios"] = new cservicios();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["servicios"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'servicios', TRUE);

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
		global $servicios;

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
			$servicios->GridAddRowCount = $gridaddcnt;

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
		global $servicios;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $servicios;

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
			if ($servicios->Export <> "" ||
				$servicios->CurrentAction == "gridadd" ||
				$servicios->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($servicios->AllowAddDeleteRow) {
				if ($servicios->CurrentAction == "gridadd" ||
					$servicios->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($servicios->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $servicios->getRecordsPerPage(); // Restore from Session
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
		$this->DbMasterFilter = $servicios->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $servicios->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($servicios->getMasterFilter() <> "" && $servicios->getCurrentMasterTable() == "agencias") {
			global $agencias;
			$rsmaster = $agencias->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($servicios->getReturnUrl()); // Return to caller
			} else {
				$agencias->LoadListRowValues($rsmaster);
				$agencias->RowType = EW_ROWTYPE_MASTER; // Master row
				$agencias->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$servicios->setSessionWhere($sFilter);
		$servicios->CurrentFilter = "";
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $servicios;
		$servicios->LastAction = $servicios->CurrentAction; // Save last action
		$servicios->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $servicios;
		$bGridUpdate = TRUE;

		// Get old recordset
		$servicios->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $servicios->SQL();
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
						$servicios->CurrentFilter = $servicios->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$servicios->SendEmail = FALSE; // Do not send email on update success
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
			$servicios->EventCancelled = TRUE; // Set event cancelled
			$servicios->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $servicios;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $servicios->KeyFilter();
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
		global $servicios;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$servicios->id_servicios->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($servicios->id_servicios->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $servicios;
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
				$servicios->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $servicios->id_servicios->CurrentValue;

					// Add filter for this record
					$sFilter = $servicios->KeyFilter();
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
			$servicios->CurrentFilter = $sWrkFilter;
			$sSql = $servicios->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$servicios->EventCancelled = TRUE; // Set event cancelled
			$servicios->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $servicios, $objForm;
		if ($objForm->HasValue("x_nombre") && $objForm->HasValue("o_nombre") && $servicios->nombre->CurrentValue <> $servicios->nombre->OldValue)
			return FALSE;
		if (!ew_Empty($servicios->imagen->Upload->Value))
			return FALSE;
		if ($objForm->HasValue("x_estatus") && $objForm->HasValue("o_estatus") && $servicios->estatus->CurrentValue <> $servicios->estatus->OldValue)
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
		global $objForm, $servicios;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $servicios;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$servicios->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$servicios->CurrentOrderType = @$_GET["ordertype"];
			$servicios->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $servicios;
		$sOrderBy = $servicios->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($servicios->SqlOrderBy() <> "") {
				$sOrderBy = $servicios->SqlOrderBy();
				$servicios->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $servicios;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$servicios->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$servicios->id_servicios->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$servicios->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$servicios->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $servicios;

		// "griddelete"
		if ($servicios->AllowAddDeleteRow) {
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
		global $Security, $Language, $servicios, $objForm;
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
			if ($this->RowAction == "insert" && $servicios->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($servicios->AllowAddDeleteRow) {
			if ($servicios->CurrentMode == "add" || $servicios->CurrentMode == "copy" || $servicios->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, servicios_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($servicios->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $servicios->id_servicios->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('id_servicios');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $servicios;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $servicios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$servicios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$servicios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $servicios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$servicios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$servicios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$servicios->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $servicios;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$servicios->imagen->Upload->Index = $objForm->Index;
		$servicios->imagen->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$servicios->imagen->Upload->RestoreFromSession();
		} else {
			if ($servicios->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $servicios->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$servicios->imagen->Upload->SaveToSession();
			$servicios->imagen->CurrentValue = $servicios->imagen->Upload->FileName;
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $servicios;
		$servicios->nombre->CurrentValue = NULL;
		$servicios->nombre->OldValue = $servicios->nombre->CurrentValue;
		$servicios->imagen->Upload->DbValue = NULL;
		$servicios->imagen->OldValue = $servicios->imagen->Upload->DbValue;
		$servicios->imagen->Upload->Index = $this->RowIndex;
		$servicios->imagen->Upload->RemoveDbFromSession();
		$servicios->estatus->CurrentValue = NULL;
		$servicios->estatus->OldValue = $servicios->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $servicios;
		$this->GetUploadFiles(); // Get upload files
		if (!$servicios->nombre->FldIsDetailKey) {
			$servicios->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		$servicios->nombre->setOldValue($objForm->GetValue("o_nombre"));
		if (!$servicios->estatus->FldIsDetailKey) {
			$servicios->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		$servicios->estatus->setOldValue($objForm->GetValue("o_estatus"));
		if (!$servicios->id_servicios->FldIsDetailKey && $servicios->CurrentAction <> "gridadd" && $servicios->CurrentAction <> "add")
			$servicios->id_servicios->setFormValue($objForm->GetValue("x_id_servicios"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $servicios;
		if ($servicios->CurrentAction <> "gridadd" && $servicios->CurrentAction <> "add")
			$servicios->id_servicios->CurrentValue = $servicios->id_servicios->FormValue;
		$servicios->nombre->CurrentValue = $servicios->nombre->FormValue;
		$servicios->estatus->CurrentValue = $servicios->estatus->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $servicios;

		// Call Recordset Selecting event
		$servicios->Recordset_Selecting($servicios->CurrentFilter);

		// Load List page SQL
		$sSql = $servicios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$servicios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $servicios;
		$sFilter = $servicios->KeyFilter();

		// Call Row Selecting event
		$servicios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$servicios->CurrentFilter = $sFilter;
		$sSql = $servicios->SQL();
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
		global $conn, $servicios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$servicios->Row_Selected($row);
		$servicios->id_servicios->setDbValue($rs->fields('id_servicios'));
		$servicios->nombre->setDbValue($rs->fields('nombre'));
		$servicios->imagen->Upload->DbValue = $rs->fields('imagen');
		$servicios->imagen->Upload->Index = $this->RowIndex;
		$servicios->imagen->Upload->SaveDbToSession();
		$servicios->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $servicios;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$servicios->id_servicios->CurrentValue = strval($arKeys[0]); // id_servicios
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$servicios->CurrentFilter = $servicios->KeyFilter();
			$sSql = $servicios->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $servicios;

		// Initialize URLs
		// Call Row_Rendering event

		$servicios->Row_Rendering();

		// Common render codes for all row types
		// id_servicios
		// nombre
		// imagen
		// estatus

		if ($servicios->RowType == EW_ROWTYPE_VIEW) { // View row

			// nombre
			$servicios->nombre->ViewValue = $servicios->nombre->CurrentValue;
			$servicios->nombre->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($servicios->imagen->Upload->DbValue)) {
				$servicios->imagen->ViewValue = $servicios->imagen->Upload->DbValue;
				$servicios->imagen->ImageAlt = $servicios->imagen->FldAlt();
			} else {
				$servicios->imagen->ViewValue = "";
			}
			$servicios->imagen->ViewCustomAttributes = "";

			// estatus
			if (strval($servicios->estatus->CurrentValue) <> "") {
				switch ($servicios->estatus->CurrentValue) {
					case "0":
						$servicios->estatus->ViewValue = $servicios->estatus->FldTagCaption(1) <> "" ? $servicios->estatus->FldTagCaption(1) : $servicios->estatus->CurrentValue;
						break;
					case "1":
						$servicios->estatus->ViewValue = $servicios->estatus->FldTagCaption(2) <> "" ? $servicios->estatus->FldTagCaption(2) : $servicios->estatus->CurrentValue;
						break;
					default:
						$servicios->estatus->ViewValue = $servicios->estatus->CurrentValue;
				}
			} else {
				$servicios->estatus->ViewValue = NULL;
			}
			$servicios->estatus->ViewCustomAttributes = "";

			// nombre
			$servicios->nombre->LinkCustomAttributes = "";
			$servicios->nombre->HrefValue = "";
			$servicios->nombre->TooltipValue = "";

			// imagen
			$servicios->imagen->LinkCustomAttributes = "";
			$servicios->imagen->HrefValue = "";
			$servicios->imagen->TooltipValue = "";

			// estatus
			$servicios->estatus->LinkCustomAttributes = "";
			$servicios->estatus->HrefValue = "";
			$servicios->estatus->TooltipValue = "";
		} elseif ($servicios->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$servicios->nombre->EditCustomAttributes = "";
			$servicios->nombre->EditValue = ew_HtmlEncode($servicios->nombre->CurrentValue);

			// imagen
			$servicios->imagen->EditCustomAttributes = "";
			if (!ew_Empty($servicios->imagen->Upload->DbValue)) {
				$servicios->imagen->EditValue = $servicios->imagen->Upload->DbValue;
				$servicios->imagen->ImageAlt = $servicios->imagen->FldAlt();
			} else {
				$servicios->imagen->EditValue = "";
			}

			// estatus
			$servicios->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", $servicios->estatus->FldTagCaption(1) <> "" ? $servicios->estatus->FldTagCaption(1) : "0");
			$arwrk[] = array("1", $servicios->estatus->FldTagCaption(2) <> "" ? $servicios->estatus->FldTagCaption(2) : "1");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$servicios->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$servicios->nombre->HrefValue = "";

			// imagen
			$servicios->imagen->HrefValue = "";

			// estatus
			$servicios->estatus->HrefValue = "";
		} elseif ($servicios->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre
			$servicios->nombre->EditCustomAttributes = "";
			$servicios->nombre->EditValue = ew_HtmlEncode($servicios->nombre->CurrentValue);

			// imagen
			$servicios->imagen->EditCustomAttributes = "";
			if (!ew_Empty($servicios->imagen->Upload->DbValue)) {
				$servicios->imagen->EditValue = $servicios->imagen->Upload->DbValue;
				$servicios->imagen->ImageAlt = $servicios->imagen->FldAlt();
			} else {
				$servicios->imagen->EditValue = "";
			}

			// estatus
			$servicios->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", $servicios->estatus->FldTagCaption(1) <> "" ? $servicios->estatus->FldTagCaption(1) : "0");
			$arwrk[] = array("1", $servicios->estatus->FldTagCaption(2) <> "" ? $servicios->estatus->FldTagCaption(2) : "1");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$servicios->estatus->EditValue = $arwrk;

			// Edit refer script
			// nombre

			$servicios->nombre->HrefValue = "";

			// imagen
			$servicios->imagen->HrefValue = "";

			// estatus
			$servicios->estatus->HrefValue = "";
		}
		if ($servicios->RowType == EW_ROWTYPE_ADD ||
			$servicios->RowType == EW_ROWTYPE_EDIT ||
			$servicios->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$servicios->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($servicios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$servicios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $servicios;
		if (!ew_CheckFileType($servicios->imagen->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($servicios->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $servicios->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($servicios->imagen->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $servicios->imagen->Upload->Error));
		}

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
		global $conn, $Language, $Security, $servicios;
		$DeleteRows = TRUE;
		$sSql = $servicios->SQL();
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

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $servicios->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_servicios'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($servicios->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($servicios->CancelMessage <> "") {
				$this->setFailureMessage($servicios->CancelMessage);
				$servicios->CancelMessage = "";
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
				$servicios->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $servicios;
		$sFilter = $servicios->KeyFilter();
		$servicios->CurrentFilter = $sFilter;
		$sSql = $servicios->SQL();
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
			$servicios->nombre->SetDbValueDef($rsnew, $servicios->nombre->CurrentValue, NULL, $servicios->nombre->ReadOnly);

			// imagen
			if ($servicios->imagen->Upload->Action == "1") { // Keep
			} elseif ($servicios->imagen->Upload->Action == "2" || $servicios->imagen->Upload->Action == "3") { // Update/Remove
			$servicios->imagen->Upload->DbValue = $rs->fields('imagen'); // Get original value
			if (is_null($servicios->imagen->Upload->Value)) {
				$rsnew['imagen'] = NULL;
			} else {
				$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $servicios->imagen->UploadPath), $servicios->imagen->Upload->FileName);
			}
			}

			// estatus
			$servicios->estatus->SetDbValueDef($rsnew, $servicios->estatus->CurrentValue, NULL, $servicios->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $servicios->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($servicios->imagen->Upload->Value)) {
				$servicios->imagen->Upload->SaveToFile($servicios->imagen->UploadPath, $rsnew['imagen'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($servicios->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($servicios->CancelMessage <> "") {
					$this->setFailureMessage($servicios->CancelMessage);
					$servicios->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$servicios->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// imagen
		$servicios->imagen->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $servicios;

		// Set up foreign key field value from Session
			if ($servicios->getCurrentMasterTable() == "agencias") {
				$servicios->id_servicios->CurrentValue = $servicios->id_servicios->getSessionValue();
			}
		$rsnew = array();

		// nombre
		$servicios->nombre->SetDbValueDef($rsnew, $servicios->nombre->CurrentValue, NULL, FALSE);

		// imagen
		if ($servicios->imagen->Upload->Action == "1") { // Keep
			if ($rsold) {
				$rsnew['imagen'] = $rsold->fields['imagen'];
			}
		} elseif ($servicios->imagen->Upload->Action == "2" || $servicios->imagen->Upload->Action == "3") { // Update/Remove
		if (is_null($servicios->imagen->Upload->Value)) {
			$rsnew['imagen'] = NULL;
		} else {
			$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $servicios->imagen->UploadPath), $servicios->imagen->Upload->FileName);
		}
		}

		// estatus
		$servicios->estatus->SetDbValueDef($rsnew, $servicios->estatus->CurrentValue, NULL, FALSE);

		// id_servicios
		if ($servicios->id_servicios->getSessionValue() <> "") {
			$rsnew['id_servicios'] = $servicios->id_servicios->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $servicios->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($servicios->imagen->Upload->Value)) {
				$servicios->imagen->Upload->SaveToFile($servicios->imagen->UploadPath, $rsnew['imagen'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($servicios->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($servicios->CancelMessage <> "") {
				$this->setFailureMessage($servicios->CancelMessage);
				$servicios->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$servicios->id_servicios->setDbValue($conn->Insert_ID());
			$rsnew['id_servicios'] = $servicios->id_servicios->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$servicios->Row_Inserted($rs, $rsnew);
		}

		// imagen
		$servicios->imagen->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $servicios;

		// Hide foreign keys
		$sMasterTblVar = $servicios->getCurrentMasterTable();
		if ($sMasterTblVar == "agencias") {
			$servicios->id_servicios->Visible = FALSE;
			if ($GLOBALS["agencias"]->EventCancelled) $servicios->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $servicios->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $servicios->getDetailFilter(); // Get detail filter
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
