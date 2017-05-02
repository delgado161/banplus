<?php include_once "usuariosinfo.php" ?>
<?php

//
// Page class
//
class crespuestas_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'respuestas';

	// Page object name
	var $PageObjName = 'respuestas_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $respuestas;
		if ($respuestas->UseTokenInUrl) $PageUrl .= "t=" . $respuestas->TableVar . "&"; // Add page token
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
		global $objForm, $respuestas;
		if ($respuestas->UseTokenInUrl) {
			if ($objForm)
				return ($respuestas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($respuestas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crespuestas_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (respuestas)
		if (!isset($GLOBALS["respuestas"])) {
			$GLOBALS["respuestas"] = new crespuestas();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["respuestas"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'respuestas', TRUE);

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
		global $respuestas;

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
			$respuestas->GridAddRowCount = $gridaddcnt;

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
		global $respuestas;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $respuestas;

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
			if ($respuestas->Export <> "" ||
				$respuestas->CurrentAction == "gridadd" ||
				$respuestas->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($respuestas->AllowAddDeleteRow) {
				if ($respuestas->CurrentAction == "gridadd" ||
					$respuestas->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($respuestas->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $respuestas->getRecordsPerPage(); // Restore from Session
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
		$this->DbMasterFilter = $respuestas->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $respuestas->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($respuestas->getMasterFilter() <> "" && $respuestas->getCurrentMasterTable() == "preguntas") {
			global $preguntas;
			$rsmaster = $preguntas->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($respuestas->getReturnUrl()); // Return to caller
			} else {
				$preguntas->LoadListRowValues($rsmaster);
				$preguntas->RowType = EW_ROWTYPE_MASTER; // Master row
				$preguntas->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$respuestas->setSessionWhere($sFilter);
		$respuestas->CurrentFilter = "";
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $respuestas;
		$respuestas->LastAction = $respuestas->CurrentAction; // Save last action
		$respuestas->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $respuestas;
		$bGridUpdate = TRUE;
		$this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin

		// Get old recordset
		$respuestas->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $respuestas->SQL();
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
						$respuestas->CurrentFilter = $respuestas->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$respuestas->SendEmail = FALSE; // Do not send email on update success
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
			$respuestas->EventCancelled = TRUE; // Set event cancelled
			$respuestas->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $respuestas;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $respuestas->KeyFilter();
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
		global $respuestas;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$respuestas->id_respuestas->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($respuestas->id_respuestas->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $respuestas;
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
				$respuestas->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $respuestas->id_respuestas->CurrentValue;

					// Add filter for this record
					$sFilter = $respuestas->KeyFilter();
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
			$respuestas->CurrentFilter = $sWrkFilter;
			$sSql = $respuestas->SQL();
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
			$respuestas->EventCancelled = TRUE; // Set event cancelled
			$respuestas->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $respuestas, $objForm;
		if ($objForm->HasValue("x_id_pregunta") && $objForm->HasValue("o_id_pregunta") && $respuestas->id_pregunta->CurrentValue <> $respuestas->id_pregunta->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_respuesta") && $objForm->HasValue("o_respuesta") && $respuestas->respuesta->CurrentValue <> $respuestas->respuesta->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_contador") && $objForm->HasValue("o_contador") && $respuestas->contador->CurrentValue <> $respuestas->contador->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_orden") && $objForm->HasValue("o_orden") && $respuestas->orden->CurrentValue <> $respuestas->orden->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estatus") && $objForm->HasValue("o_estatus") && $respuestas->estatus->CurrentValue <> $respuestas->estatus->OldValue)
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
		global $objForm, $respuestas;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $respuestas;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$respuestas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$respuestas->CurrentOrderType = @$_GET["ordertype"];
			$respuestas->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $respuestas;
		$sOrderBy = $respuestas->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($respuestas->SqlOrderBy() <> "") {
				$sOrderBy = $respuestas->SqlOrderBy();
				$respuestas->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $respuestas;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$respuestas->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$respuestas->id_pregunta->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$respuestas->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$respuestas->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $respuestas;

		// "griddelete"
		if ($respuestas->AllowAddDeleteRow) {
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
		global $Security, $Language, $respuestas, $objForm;
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
			if ($this->RowAction == "insert" && $respuestas->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($respuestas->AllowAddDeleteRow) {
			if ($respuestas->CurrentMode == "add" || $respuestas->CurrentMode == "copy" || $respuestas->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, respuestas_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($respuestas->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $respuestas->id_respuestas->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('id_respuestas');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $respuestas;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $respuestas;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$respuestas->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$respuestas->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $respuestas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$respuestas->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$respuestas->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$respuestas->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $respuestas;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $respuestas;
		$respuestas->id_pregunta->CurrentValue = NULL;
		$respuestas->id_pregunta->OldValue = $respuestas->id_pregunta->CurrentValue;
		$respuestas->respuesta->CurrentValue = NULL;
		$respuestas->respuesta->OldValue = $respuestas->respuesta->CurrentValue;
		$respuestas->contador->CurrentValue = j;
		$respuestas->contador->OldValue = $respuestas->contador->CurrentValue;
		$respuestas->orden->CurrentValue = NULL;
		$respuestas->orden->OldValue = $respuestas->orden->CurrentValue;
		$respuestas->estatus->CurrentValue = NULL;
		$respuestas->estatus->OldValue = $respuestas->estatus->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $respuestas;
		if (!$respuestas->id_pregunta->FldIsDetailKey) {
			$respuestas->id_pregunta->setFormValue($objForm->GetValue("x_id_pregunta"));
		}
		$respuestas->id_pregunta->setOldValue($objForm->GetValue("o_id_pregunta"));
		if (!$respuestas->respuesta->FldIsDetailKey) {
			$respuestas->respuesta->setFormValue($objForm->GetValue("x_respuesta"));
		}
		$respuestas->respuesta->setOldValue($objForm->GetValue("o_respuesta"));
		if (!$respuestas->contador->FldIsDetailKey) {
			$respuestas->contador->setFormValue($objForm->GetValue("x_contador"));
		}
		$respuestas->contador->setOldValue($objForm->GetValue("o_contador"));
		if (!$respuestas->orden->FldIsDetailKey) {
			$respuestas->orden->setFormValue($objForm->GetValue("x_orden"));
		}
		$respuestas->orden->setOldValue($objForm->GetValue("o_orden"));
		if (!$respuestas->estatus->FldIsDetailKey) {
			$respuestas->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		$respuestas->estatus->setOldValue($objForm->GetValue("o_estatus"));
		if (!$respuestas->id_respuestas->FldIsDetailKey && $respuestas->CurrentAction <> "gridadd" && $respuestas->CurrentAction <> "add")
			$respuestas->id_respuestas->setFormValue($objForm->GetValue("x_id_respuestas"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $respuestas;
		if ($respuestas->CurrentAction <> "gridadd" && $respuestas->CurrentAction <> "add")
			$respuestas->id_respuestas->CurrentValue = $respuestas->id_respuestas->FormValue;
		$respuestas->id_pregunta->CurrentValue = $respuestas->id_pregunta->FormValue;
		$respuestas->respuesta->CurrentValue = $respuestas->respuesta->FormValue;
		$respuestas->contador->CurrentValue = $respuestas->contador->FormValue;
		$respuestas->orden->CurrentValue = $respuestas->orden->FormValue;
		$respuestas->estatus->CurrentValue = $respuestas->estatus->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $respuestas;

		// Call Recordset Selecting event
		$respuestas->Recordset_Selecting($respuestas->CurrentFilter);

		// Load List page SQL
		$sSql = $respuestas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$respuestas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $respuestas;
		$sFilter = $respuestas->KeyFilter();

		// Call Row Selecting event
		$respuestas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$respuestas->CurrentFilter = $sFilter;
		$sSql = $respuestas->SQL();
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
		global $conn, $respuestas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$respuestas->Row_Selected($row);
		$respuestas->id_respuestas->setDbValue($rs->fields('id_respuestas'));
		$respuestas->id_pregunta->setDbValue($rs->fields('id_pregunta'));
		$respuestas->respuesta->setDbValue($rs->fields('respuesta'));
		$respuestas->contador->setDbValue($rs->fields('contador'));
		$respuestas->orden->setDbValue($rs->fields('orden'));
		$respuestas->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $respuestas;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$respuestas->id_respuestas->CurrentValue = strval($arKeys[0]); // id_respuestas
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$respuestas->CurrentFilter = $respuestas->KeyFilter();
			$sSql = $respuestas->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $respuestas;

		// Initialize URLs
		// Call Row_Rendering event

		$respuestas->Row_Rendering();

		// Common render codes for all row types
		// id_respuestas
		// id_pregunta
		// respuesta
		// contador
		// orden
		// estatus

		if ($respuestas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_pregunta
			if (strval($respuestas->id_pregunta->CurrentValue) <> "") {
				$sFilterWrk = "`id_pregunta` = " . ew_AdjustSql($respuestas->id_pregunta->CurrentValue) . "";
			$sSqlWrk = "SELECT `pregunta` FROM `preguntas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$respuestas->id_pregunta->ViewValue = $rswrk->fields('pregunta');
					$rswrk->Close();
				} else {
					$respuestas->id_pregunta->ViewValue = $respuestas->id_pregunta->CurrentValue;
				}
			} else {
				$respuestas->id_pregunta->ViewValue = NULL;
			}
			$respuestas->id_pregunta->ViewCustomAttributes = "";

			// respuesta
			$respuestas->respuesta->ViewValue = $respuestas->respuesta->CurrentValue;
			$respuestas->respuesta->ViewCustomAttributes = "";

			// contador
			$respuestas->contador->ViewValue = $respuestas->contador->CurrentValue;
			$respuestas->contador->ViewCustomAttributes = "";

			// orden
			$respuestas->orden->ViewValue = $respuestas->orden->CurrentValue;
			$respuestas->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($respuestas->estatus->CurrentValue) <> "") {
				switch ($respuestas->estatus->CurrentValue) {
					case "1":
						$respuestas->estatus->ViewValue = $respuestas->estatus->FldTagCaption(1) <> "" ? $respuestas->estatus->FldTagCaption(1) : $respuestas->estatus->CurrentValue;
						break;
					case "0":
						$respuestas->estatus->ViewValue = $respuestas->estatus->FldTagCaption(2) <> "" ? $respuestas->estatus->FldTagCaption(2) : $respuestas->estatus->CurrentValue;
						break;
					default:
						$respuestas->estatus->ViewValue = $respuestas->estatus->CurrentValue;
				}
			} else {
				$respuestas->estatus->ViewValue = NULL;
			}
			$respuestas->estatus->ViewCustomAttributes = "";

			// id_pregunta
			$respuestas->id_pregunta->LinkCustomAttributes = "";
			$respuestas->id_pregunta->HrefValue = "";
			$respuestas->id_pregunta->TooltipValue = "";

			// respuesta
			$respuestas->respuesta->LinkCustomAttributes = "";
			$respuestas->respuesta->HrefValue = "";
			$respuestas->respuesta->TooltipValue = "";

			// contador
			$respuestas->contador->LinkCustomAttributes = "";
			$respuestas->contador->HrefValue = "";
			$respuestas->contador->TooltipValue = "";

			// orden
			$respuestas->orden->LinkCustomAttributes = "";
			$respuestas->orden->HrefValue = "";
			$respuestas->orden->TooltipValue = "";

			// estatus
			$respuestas->estatus->LinkCustomAttributes = "";
			$respuestas->estatus->HrefValue = "";
			$respuestas->estatus->TooltipValue = "";
		} elseif ($respuestas->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_pregunta
			$respuestas->id_pregunta->EditCustomAttributes = "";
			if ($respuestas->id_pregunta->getSessionValue() <> "") {
				$respuestas->id_pregunta->CurrentValue = $respuestas->id_pregunta->getSessionValue();
				$respuestas->id_pregunta->OldValue = $respuestas->id_pregunta->CurrentValue;
			if (strval($respuestas->id_pregunta->CurrentValue) <> "") {
				$sFilterWrk = "`id_pregunta` = " . ew_AdjustSql($respuestas->id_pregunta->CurrentValue) . "";
			$sSqlWrk = "SELECT `pregunta` FROM `preguntas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$respuestas->id_pregunta->ViewValue = $rswrk->fields('pregunta');
					$rswrk->Close();
				} else {
					$respuestas->id_pregunta->ViewValue = $respuestas->id_pregunta->CurrentValue;
				}
			} else {
				$respuestas->id_pregunta->ViewValue = NULL;
			}
			$respuestas->id_pregunta->ViewCustomAttributes = "";
			} else {
			}

			// respuesta
			$respuestas->respuesta->EditCustomAttributes = "";
			$respuestas->respuesta->EditValue = ew_HtmlEncode($respuestas->respuesta->CurrentValue);

			// contador
			$respuestas->contador->EditCustomAttributes = "";
			$respuestas->contador->EditValue = ew_HtmlEncode($respuestas->contador->CurrentValue);

			// orden
			$respuestas->orden->EditCustomAttributes = "";
			$respuestas->orden->EditValue = ew_HtmlEncode($respuestas->orden->CurrentValue);

			// estatus
			$respuestas->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $respuestas->estatus->FldTagCaption(1) <> "" ? $respuestas->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $respuestas->estatus->FldTagCaption(2) <> "" ? $respuestas->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$respuestas->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_pregunta

			$respuestas->id_pregunta->HrefValue = "";

			// respuesta
			$respuestas->respuesta->HrefValue = "";

			// contador
			$respuestas->contador->HrefValue = "";

			// orden
			$respuestas->orden->HrefValue = "";

			// estatus
			$respuestas->estatus->HrefValue = "";
		} elseif ($respuestas->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_pregunta
			$respuestas->id_pregunta->EditCustomAttributes = "";
			if ($respuestas->id_pregunta->getSessionValue() <> "") {
				$respuestas->id_pregunta->CurrentValue = $respuestas->id_pregunta->getSessionValue();
				$respuestas->id_pregunta->OldValue = $respuestas->id_pregunta->CurrentValue;
			if (strval($respuestas->id_pregunta->CurrentValue) <> "") {
				$sFilterWrk = "`id_pregunta` = " . ew_AdjustSql($respuestas->id_pregunta->CurrentValue) . "";
			$sSqlWrk = "SELECT `pregunta` FROM `preguntas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$respuestas->id_pregunta->ViewValue = $rswrk->fields('pregunta');
					$rswrk->Close();
				} else {
					$respuestas->id_pregunta->ViewValue = $respuestas->id_pregunta->CurrentValue;
				}
			} else {
				$respuestas->id_pregunta->ViewValue = NULL;
			}
			$respuestas->id_pregunta->ViewCustomAttributes = "";
			} else {
			}

			// respuesta
			$respuestas->respuesta->EditCustomAttributes = "";
			$respuestas->respuesta->EditValue = ew_HtmlEncode($respuestas->respuesta->CurrentValue);

			// contador
			$respuestas->contador->EditCustomAttributes = "";
			$respuestas->contador->EditValue = $respuestas->contador->CurrentValue;
			$respuestas->contador->ViewCustomAttributes = "";

			// orden
			$respuestas->orden->EditCustomAttributes = "";
			$respuestas->orden->EditValue = ew_HtmlEncode($respuestas->orden->CurrentValue);

			// estatus
			$respuestas->estatus->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $respuestas->estatus->FldTagCaption(1) <> "" ? $respuestas->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $respuestas->estatus->FldTagCaption(2) <> "" ? $respuestas->estatus->FldTagCaption(2) : "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$respuestas->estatus->EditValue = $arwrk;

			// Edit refer script
			// id_pregunta

			$respuestas->id_pregunta->HrefValue = "";

			// respuesta
			$respuestas->respuesta->HrefValue = "";

			// contador
			$respuestas->contador->HrefValue = "";

			// orden
			$respuestas->orden->HrefValue = "";

			// estatus
			$respuestas->estatus->HrefValue = "";
		}
		if ($respuestas->RowType == EW_ROWTYPE_ADD ||
			$respuestas->RowType == EW_ROWTYPE_EDIT ||
			$respuestas->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$respuestas->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($respuestas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$respuestas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $respuestas;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($respuestas->respuesta->FormValue) && $respuestas->respuesta->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $respuestas->respuesta->FldCaption());
		}
		if (!ew_CheckInteger($respuestas->orden->FormValue)) {
			ew_AddMessage($gsFormError, $respuestas->orden->FldErrMsg());
		}
		if (!is_null($respuestas->estatus->FormValue) && $respuestas->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $respuestas->estatus->FldCaption());
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
		global $conn, $Language, $Security, $respuestas;
		$DeleteRows = TRUE;
		$sSql = $respuestas->SQL();
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
				$DeleteRows = $respuestas->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_respuestas'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($respuestas->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($respuestas->CancelMessage <> "") {
				$this->setFailureMessage($respuestas->CancelMessage);
				$respuestas->CancelMessage = "";
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
				$respuestas->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $respuestas;
		$sFilter = $respuestas->KeyFilter();
		$respuestas->CurrentFilter = $sFilter;
		$sSql = $respuestas->SQL();
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

			// id_pregunta
			$respuestas->id_pregunta->SetDbValueDef($rsnew, $respuestas->id_pregunta->CurrentValue, NULL, $respuestas->id_pregunta->ReadOnly);

			// respuesta
			$respuestas->respuesta->SetDbValueDef($rsnew, $respuestas->respuesta->CurrentValue, NULL, $respuestas->respuesta->ReadOnly);

			// orden
			$respuestas->orden->SetDbValueDef($rsnew, $respuestas->orden->CurrentValue, NULL, $respuestas->orden->ReadOnly);

			// estatus
			$respuestas->estatus->SetDbValueDef($rsnew, $respuestas->estatus->CurrentValue, NULL, $respuestas->estatus->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $respuestas->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($respuestas->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($respuestas->CancelMessage <> "") {
					$this->setFailureMessage($respuestas->CancelMessage);
					$respuestas->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$respuestas->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $respuestas;

		// Set up foreign key field value from Session
			if ($respuestas->getCurrentMasterTable() == "preguntas") {
				$respuestas->id_pregunta->CurrentValue = $respuestas->id_pregunta->getSessionValue();
			}
		$rsnew = array();

		// id_pregunta
		$respuestas->id_pregunta->SetDbValueDef($rsnew, $respuestas->id_pregunta->CurrentValue, NULL, FALSE);

		// respuesta
		$respuestas->respuesta->SetDbValueDef($rsnew, $respuestas->respuesta->CurrentValue, NULL, FALSE);

		// contador
		$respuestas->contador->SetDbValueDef($rsnew, $respuestas->contador->CurrentValue, NULL, FALSE);

		// orden
		$respuestas->orden->SetDbValueDef($rsnew, $respuestas->orden->CurrentValue, NULL, FALSE);

		// estatus
		$respuestas->estatus->SetDbValueDef($rsnew, $respuestas->estatus->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $respuestas->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($respuestas->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($respuestas->CancelMessage <> "") {
				$this->setFailureMessage($respuestas->CancelMessage);
				$respuestas->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$respuestas->id_respuestas->setDbValue($conn->Insert_ID());
			$rsnew['id_respuestas'] = $respuestas->id_respuestas->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$respuestas->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $respuestas;

		// Hide foreign keys
		$sMasterTblVar = $respuestas->getCurrentMasterTable();
		if ($sMasterTblVar == "preguntas") {
			$respuestas->id_pregunta->Visible = FALSE;
			if ($GLOBALS["preguntas"]->EventCancelled) $respuestas->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $respuestas->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $respuestas->getDetailFilter(); // Get detail filter
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
		$table = 'respuestas';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $respuestas;
		$table = 'respuestas';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_respuestas'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($respuestas->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
		global $respuestas;
		$table = 'respuestas';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id_respuestas'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($respuestas->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
		global $respuestas;
		$table = 'respuestas';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_respuestas'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $respuestas->fields) && $respuestas->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($respuestas->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
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
