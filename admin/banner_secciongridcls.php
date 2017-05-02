<?php include_once "usuariosinfo.php" ?>
<?php

//
// Page class
//
class cbanner_seccion_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'banner_seccion';

	// Page object name
	var $PageObjName = 'banner_seccion_grid';

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
	function cbanner_seccion_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (banner_seccion)
		if (!isset($GLOBALS["banner_seccion"])) {
			$GLOBALS["banner_seccion"] = new cbanner_seccion();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["banner_seccion"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banner_seccion', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$banner_seccion->GridAddRowCount = $gridaddcnt;

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
		global $banner_seccion;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $banner_seccion;

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
			if ($banner_seccion->Export <> "" ||
				$banner_seccion->CurrentAction == "gridadd" ||
				$banner_seccion->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($banner_seccion->AllowAddDeleteRow) {
				if ($banner_seccion->CurrentAction == "gridadd" ||
					$banner_seccion->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($banner_seccion->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $banner_seccion->getRecordsPerPage(); // Restore from Session
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
		$this->DbMasterFilter = $banner_seccion->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $banner_seccion->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($banner_seccion->getMasterFilter() <> "" && $banner_seccion->getCurrentMasterTable() == "banner") {
			global $banner;
			$rsmaster = $banner->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($banner_seccion->getReturnUrl()); // Return to caller
			} else {
				$banner->LoadListRowValues($rsmaster);
				$banner->RowType = EW_ROWTYPE_MASTER; // Master row
				$banner->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$banner_seccion->setSessionWhere($sFilter);
		$banner_seccion->CurrentFilter = "";
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $banner_seccion;
		$banner_seccion->LastAction = $banner_seccion->CurrentAction; // Save last action
		$banner_seccion->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $banner_seccion;
		$bGridUpdate = TRUE;
		$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin

		// Get old recordset
		$banner_seccion->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $banner_seccion->SQL();
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
						$banner_seccion->CurrentFilter = $banner_seccion->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$banner_seccion->SendEmail = FALSE; // Do not send email on update success
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
			$banner_seccion->EventCancelled = TRUE; // Set event cancelled
			$banner_seccion->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $banner_seccion;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $banner_seccion->KeyFilter();
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
		global $banner_seccion;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$banner_seccion->id_banner_seccion->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($banner_seccion->id_banner_seccion->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $banner_seccion;
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
				$banner_seccion->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $banner_seccion->id_banner_seccion->CurrentValue;

					// Add filter for this record
					$sFilter = $banner_seccion->KeyFilter();
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
			$banner_seccion->CurrentFilter = $sWrkFilter;
			$sSql = $banner_seccion->SQL();
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
			$banner_seccion->EventCancelled = TRUE; // Set event cancelled
			$banner_seccion->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $banner_seccion, $objForm;
		if ($objForm->HasValue("x_id_banner") && $objForm->HasValue("o_id_banner") && $banner_seccion->id_banner->CurrentValue <> $banner_seccion->id_banner->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_id_grupo_secciones") && $objForm->HasValue("o_id_grupo_secciones") && $banner_seccion->id_grupo_secciones->CurrentValue <> $banner_seccion->id_grupo_secciones->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_inicio") && $objForm->HasValue("o_fecha_inicio") && $banner_seccion->fecha_inicio->CurrentValue <> $banner_seccion->fecha_inicio->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_fin") && $objForm->HasValue("o_fecha_fin") && $banner_seccion->fecha_fin->CurrentValue <> $banner_seccion->fecha_fin->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_id_posicion") && $objForm->HasValue("o_id_posicion") && $banner_seccion->id_posicion->CurrentValue <> $banner_seccion->id_posicion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_orden") && $objForm->HasValue("o_orden") && $banner_seccion->orden->CurrentValue <> $banner_seccion->orden->OldValue)
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
		global $objForm, $banner_seccion;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $banner_seccion;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$banner_seccion->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$banner_seccion->CurrentOrderType = @$_GET["ordertype"];
			$banner_seccion->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $banner_seccion;
		$sOrderBy = $banner_seccion->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($banner_seccion->SqlOrderBy() <> "") {
				$sOrderBy = $banner_seccion->SqlOrderBy();
				$banner_seccion->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $banner_seccion;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$banner_seccion->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$banner_seccion->id_banner->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$banner_seccion->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$banner_seccion->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $banner_seccion;

		// "griddelete"
		if ($banner_seccion->AllowAddDeleteRow) {
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
		global $Security, $Language, $banner_seccion, $objForm;
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
			if ($this->RowAction == "insert" && $banner_seccion->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($banner_seccion->AllowAddDeleteRow) {
			if ($banner_seccion->CurrentMode == "add" || $banner_seccion->CurrentMode == "copy" || $banner_seccion->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, banner_seccion_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($banner_seccion->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $banner_seccion->id_banner_seccion->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('id_banner_seccion');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $banner_seccion;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $banner_seccion;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$banner_seccion->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$banner_seccion->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $banner_seccion->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$banner_seccion->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$banner_seccion->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$banner_seccion->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $banner_seccion;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $banner_seccion;
		$banner_seccion->id_banner->CurrentValue = NULL;
		$banner_seccion->id_banner->OldValue = $banner_seccion->id_banner->CurrentValue;
		$banner_seccion->id_grupo_secciones->CurrentValue = NULL;
		$banner_seccion->id_grupo_secciones->OldValue = $banner_seccion->id_grupo_secciones->CurrentValue;
		$banner_seccion->fecha_inicio->CurrentValue = NULL;
		$banner_seccion->fecha_inicio->OldValue = $banner_seccion->fecha_inicio->CurrentValue;
		$banner_seccion->fecha_fin->CurrentValue = NULL;
		$banner_seccion->fecha_fin->OldValue = $banner_seccion->fecha_fin->CurrentValue;
		$banner_seccion->id_posicion->CurrentValue = NULL;
		$banner_seccion->id_posicion->OldValue = $banner_seccion->id_posicion->CurrentValue;
		$banner_seccion->orden->CurrentValue = 1;
		$banner_seccion->orden->OldValue = $banner_seccion->orden->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $banner_seccion;
		if (!$banner_seccion->id_banner->FldIsDetailKey) {
			$banner_seccion->id_banner->setFormValue($objForm->GetValue("x_id_banner"));
		}
		$banner_seccion->id_banner->setOldValue($objForm->GetValue("o_id_banner"));
		if (!$banner_seccion->id_grupo_secciones->FldIsDetailKey) {
			$banner_seccion->id_grupo_secciones->setFormValue($objForm->GetValue("x_id_grupo_secciones"));
		}
		$banner_seccion->id_grupo_secciones->setOldValue($objForm->GetValue("o_id_grupo_secciones"));
		if (!$banner_seccion->fecha_inicio->FldIsDetailKey) {
			$banner_seccion->fecha_inicio->setFormValue($objForm->GetValue("x_fecha_inicio"));
			$banner_seccion->fecha_inicio->CurrentValue = ew_UnFormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7);
		}
		$banner_seccion->fecha_inicio->setOldValue($objForm->GetValue("o_fecha_inicio"));
		if (!$banner_seccion->fecha_fin->FldIsDetailKey) {
			$banner_seccion->fecha_fin->setFormValue($objForm->GetValue("x_fecha_fin"));
			$banner_seccion->fecha_fin->CurrentValue = ew_UnFormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7);
		}
		$banner_seccion->fecha_fin->setOldValue($objForm->GetValue("o_fecha_fin"));
		if (!$banner_seccion->id_posicion->FldIsDetailKey) {
			$banner_seccion->id_posicion->setFormValue($objForm->GetValue("x_id_posicion"));
		}
		$banner_seccion->id_posicion->setOldValue($objForm->GetValue("o_id_posicion"));
		if (!$banner_seccion->orden->FldIsDetailKey) {
			$banner_seccion->orden->setFormValue($objForm->GetValue("x_orden"));
		}
		$banner_seccion->orden->setOldValue($objForm->GetValue("o_orden"));
		if (!$banner_seccion->id_banner_seccion->FldIsDetailKey && $banner_seccion->CurrentAction <> "gridadd" && $banner_seccion->CurrentAction <> "add")
			$banner_seccion->id_banner_seccion->setFormValue($objForm->GetValue("x_id_banner_seccion"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $banner_seccion;
		if ($banner_seccion->CurrentAction <> "gridadd" && $banner_seccion->CurrentAction <> "add")
			$banner_seccion->id_banner_seccion->CurrentValue = $banner_seccion->id_banner_seccion->FormValue;
		$banner_seccion->id_banner->CurrentValue = $banner_seccion->id_banner->FormValue;
		$banner_seccion->id_grupo_secciones->CurrentValue = $banner_seccion->id_grupo_secciones->FormValue;
		$banner_seccion->fecha_inicio->CurrentValue = $banner_seccion->fecha_inicio->FormValue;
		$banner_seccion->fecha_inicio->CurrentValue = ew_UnFormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7);
		$banner_seccion->fecha_fin->CurrentValue = $banner_seccion->fecha_fin->FormValue;
		$banner_seccion->fecha_fin->CurrentValue = ew_UnFormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7);
		$banner_seccion->id_posicion->CurrentValue = $banner_seccion->id_posicion->FormValue;
		$banner_seccion->orden->CurrentValue = $banner_seccion->orden->FormValue;
	}

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

	// Load old record
	function LoadOldRecord() {
		global $banner_seccion;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$banner_seccion->id_banner_seccion->CurrentValue = strval($arKeys[0]); // id_banner_seccion
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$banner_seccion->CurrentFilter = $banner_seccion->KeyFilter();
			$sSql = $banner_seccion->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
			$banner_seccion->id_grupo_secciones->ViewValue = $banner_seccion->id_grupo_secciones->CurrentValue;
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
		} elseif ($banner_seccion->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_banner
			$banner_seccion->id_banner->EditCustomAttributes = "";
			if ($banner_seccion->id_banner->getSessionValue() <> "") {
				$banner_seccion->id_banner->CurrentValue = $banner_seccion->id_banner->getSessionValue();
				$banner_seccion->id_banner->OldValue = $banner_seccion->id_banner->CurrentValue;
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
			} else {
			}

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->EditCustomAttributes = "";
			$banner_seccion->id_grupo_secciones->EditValue = ew_HtmlEncode($banner_seccion->id_grupo_secciones->CurrentValue);

			// fecha_inicio
			$banner_seccion->fecha_inicio->EditCustomAttributes = "";
			$banner_seccion->fecha_inicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7));

			// fecha_fin
			$banner_seccion->fecha_fin->EditCustomAttributes = "";
			$banner_seccion->fecha_fin->EditValue = ew_HtmlEncode(ew_FormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7));

			// id_posicion
			$banner_seccion->id_posicion->EditCustomAttributes = "";

			// orden
			$banner_seccion->orden->EditCustomAttributes = "";
			$banner_seccion->orden->EditValue = ew_HtmlEncode($banner_seccion->orden->CurrentValue);

			// Edit refer script
			// id_banner

			$banner_seccion->id_banner->HrefValue = "";

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->HrefValue = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->HrefValue = "";

			// fecha_fin
			$banner_seccion->fecha_fin->HrefValue = "";

			// id_posicion
			$banner_seccion->id_posicion->HrefValue = "";

			// orden
			$banner_seccion->orden->HrefValue = "";
		} elseif ($banner_seccion->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_banner
			$banner_seccion->id_banner->EditCustomAttributes = "";
			if ($banner_seccion->id_banner->getSessionValue() <> "") {
				$banner_seccion->id_banner->CurrentValue = $banner_seccion->id_banner->getSessionValue();
				$banner_seccion->id_banner->OldValue = $banner_seccion->id_banner->CurrentValue;
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
			} else {
			}

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->EditCustomAttributes = "";
			$banner_seccion->id_grupo_secciones->EditValue = ew_HtmlEncode($banner_seccion->id_grupo_secciones->CurrentValue);

			// fecha_inicio
			$banner_seccion->fecha_inicio->EditCustomAttributes = "";
			$banner_seccion->fecha_inicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7));

			// fecha_fin
			$banner_seccion->fecha_fin->EditCustomAttributes = "";
			$banner_seccion->fecha_fin->EditValue = ew_HtmlEncode(ew_FormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7));

			// id_posicion
			$banner_seccion->id_posicion->EditCustomAttributes = "";

			// orden
			$banner_seccion->orden->EditCustomAttributes = "";
			$banner_seccion->orden->EditValue = ew_HtmlEncode($banner_seccion->orden->CurrentValue);

			// Edit refer script
			// id_banner

			$banner_seccion->id_banner->HrefValue = "";

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->HrefValue = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->HrefValue = "";

			// fecha_fin
			$banner_seccion->fecha_fin->HrefValue = "";

			// id_posicion
			$banner_seccion->id_posicion->HrefValue = "";

			// orden
			$banner_seccion->orden->HrefValue = "";
		}
		if ($banner_seccion->RowType == EW_ROWTYPE_ADD ||
			$banner_seccion->RowType == EW_ROWTYPE_EDIT ||
			$banner_seccion->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$banner_seccion->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($banner_seccion->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banner_seccion->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $banner_seccion;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($banner_seccion->id_banner->FormValue) && $banner_seccion->id_banner->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner_seccion->id_banner->FldCaption());
		}
		if (!is_null($banner_seccion->id_grupo_secciones->FormValue) && $banner_seccion->id_grupo_secciones->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner_seccion->id_grupo_secciones->FldCaption());
		}
		if (!ew_CheckInteger($banner_seccion->id_grupo_secciones->FormValue)) {
			ew_AddMessage($gsFormError, $banner_seccion->id_grupo_secciones->FldErrMsg());
		}
		if (!ew_CheckEuroDate($banner_seccion->fecha_inicio->FormValue)) {
			ew_AddMessage($gsFormError, $banner_seccion->fecha_inicio->FldErrMsg());
		}
		if (!ew_CheckEuroDate($banner_seccion->fecha_fin->FormValue)) {
			ew_AddMessage($gsFormError, $banner_seccion->fecha_fin->FldErrMsg());
		}
		if (!is_null($banner_seccion->id_posicion->FormValue) && $banner_seccion->id_posicion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner_seccion->id_posicion->FldCaption());
		}
		if (!is_null($banner_seccion->orden->FormValue) && $banner_seccion->orden->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $banner_seccion->orden->FldCaption());
		}
		if (!ew_CheckInteger($banner_seccion->orden->FormValue)) {
			ew_AddMessage($gsFormError, $banner_seccion->orden->FldErrMsg());
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
			if ($DeleteRows) {
				foreach ($rsold as $row)
					$this->WriteAuditTrailOnDelete($row);
			}
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$banner_seccion->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $banner_seccion;
		$sFilter = $banner_seccion->KeyFilter();
		$banner_seccion->CurrentFilter = $sFilter;
		$sSql = $banner_seccion->SQL();
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

			// id_banner
			$banner_seccion->id_banner->SetDbValueDef($rsnew, $banner_seccion->id_banner->CurrentValue, 0, $banner_seccion->id_banner->ReadOnly);

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->SetDbValueDef($rsnew, $banner_seccion->id_grupo_secciones->CurrentValue, 0, $banner_seccion->id_grupo_secciones->ReadOnly);

			// fecha_inicio
			$banner_seccion->fecha_inicio->SetDbValueDef($rsnew, ew_UnFormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7), NULL, $banner_seccion->fecha_inicio->ReadOnly);

			// fecha_fin
			$banner_seccion->fecha_fin->SetDbValueDef($rsnew, ew_UnFormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7), NULL, $banner_seccion->fecha_fin->ReadOnly);

			// id_posicion
			$banner_seccion->id_posicion->SetDbValueDef($rsnew, $banner_seccion->id_posicion->CurrentValue, NULL, $banner_seccion->id_posicion->ReadOnly);

			// orden
			$banner_seccion->orden->SetDbValueDef($rsnew, $banner_seccion->orden->CurrentValue, 0, $banner_seccion->orden->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $banner_seccion->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($banner_seccion->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($banner_seccion->CancelMessage <> "") {
					$this->setFailureMessage($banner_seccion->CancelMessage);
					$banner_seccion->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$banner_seccion->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $banner_seccion;

		// Set up foreign key field value from Session
			if ($banner_seccion->getCurrentMasterTable() == "banner") {
				$banner_seccion->id_banner->CurrentValue = $banner_seccion->id_banner->getSessionValue();
			}
		$rsnew = array();

		// id_banner
		$banner_seccion->id_banner->SetDbValueDef($rsnew, $banner_seccion->id_banner->CurrentValue, 0, FALSE);

		// id_grupo_secciones
		$banner_seccion->id_grupo_secciones->SetDbValueDef($rsnew, $banner_seccion->id_grupo_secciones->CurrentValue, 0, FALSE);

		// fecha_inicio
		$banner_seccion->fecha_inicio->SetDbValueDef($rsnew, ew_UnFormatDateTime($banner_seccion->fecha_inicio->CurrentValue, 7), NULL, FALSE);

		// fecha_fin
		$banner_seccion->fecha_fin->SetDbValueDef($rsnew, ew_UnFormatDateTime($banner_seccion->fecha_fin->CurrentValue, 7), NULL, FALSE);

		// id_posicion
		$banner_seccion->id_posicion->SetDbValueDef($rsnew, $banner_seccion->id_posicion->CurrentValue, NULL, FALSE);

		// orden
		$banner_seccion->orden->SetDbValueDef($rsnew, $banner_seccion->orden->CurrentValue, 0, strval($banner_seccion->orden->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $banner_seccion->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($banner_seccion->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($banner_seccion->CancelMessage <> "") {
				$this->setFailureMessage($banner_seccion->CancelMessage);
				$banner_seccion->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$banner_seccion->id_banner_seccion->setDbValue($conn->Insert_ID());
			$rsnew['id_banner_seccion'] = $banner_seccion->id_banner_seccion->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$banner_seccion->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $banner_seccion;

		// Hide foreign keys
		$sMasterTblVar = $banner_seccion->getCurrentMasterTable();
		if ($sMasterTblVar == "banner") {
			$banner_seccion->id_banner->Visible = FALSE;
			if ($GLOBALS["banner"]->EventCancelled) $banner_seccion->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $banner_seccion->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $banner_seccion->getDetailFilter(); // Get detail filter
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
		$table = 'banner_seccion';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $banner_seccion;
		$table = 'banner_seccion';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_banner_seccion'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($banner_seccion->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($banner_seccion->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($banner_seccion->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
		global $banner_seccion;
		$table = 'banner_seccion';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_banner_seccion'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($banner_seccion->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($banner_seccion->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($banner_seccion->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($banner_seccion->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
