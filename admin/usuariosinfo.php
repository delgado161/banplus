<?php

// Global variable for table object
$usuarios = NULL;

//
// Table class for usuarios
//
class cusuarios {
	var $TableVar = 'usuarios';
	var $TableName = 'usuarios';
	var $TableType = 'TABLE';
	var $id_usuario;
	var $nombre;
	var $apellido;
	var $acceso;
	var $llave;
	var $correo;
	var $UserLevelID;
	var $estatus;
	var $profile;
	var $duracion_pass;
	var $duracion_fech;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $ExportPageBreakCount = 0; // Page break per every n record (PDF only)
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $dg;
	// Reset attributes for table object
	function ResetAttrs() {
		$this->CssClass = "";
		$this->CssStyle = "";
    	$this->RowAttrs = array();
		foreach ($this->fields as $fld) {
			$fld->ResetAttrs();
		}
	}

	// Setup field titles
	function SetupFieldTitles() {
		foreach ($this->fields as &$fld) {
			if (strval($fld->FldTitle()) <> "") {
				$fld->EditAttrs["onmouseover"] = "ew_ShowTitle(this, '" . ew_JsEncode3($fld->FldTitle()) . "');";
				$fld->EditAttrs["onmouseout"] = "ew_HideTooltip();";
			}
		}
	}
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $LastAction; // Last action
	var $CurrentMode = ""; // Current mode
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $AllowAddDeleteRow = TRUE; // Allow add/delete row
	var $DetailAdd = FALSE; // Allow detail add
	var $DetailEdit = FALSE; // Allow detail edit
	var $GridAddRowCount = 5;

	// Check current action
	// - Add
	function IsAdd() {
		return $this->CurrentAction == "add";
	}

	// - Copy
	function IsCopy() {
		return $this->CurrentAction == "copy" || $this->CurrentAction == "C";
	}

	// - Edit
	function IsEdit() {
		return $this->CurrentAction == "edit";
	}

	// - Delete
	function IsDelete() {
		return $this->CurrentAction == "D";
	}

	// - Confirm
	function IsConfirm() {
		return $this->CurrentAction == "F";
	}

	// - Overwrite
	function IsOverwrite() {
		return $this->CurrentAction == "overwrite";
	}

	// - Cancel
	function IsCancel() {
		return $this->CurrentAction == "cancel";
	}

	// - Grid add
	function IsGridAdd() {
		return $this->CurrentAction == "gridadd";
	}

	// - Grid edit
	function IsGridEdit() {
		return $this->CurrentAction == "gridedit";
	}

	// - Insert
	function IsInsert() {
		return $this->CurrentAction == "insert" || $this->CurrentAction == "A";
	}

	// - Update
	function IsUpdate() {
		return $this->CurrentAction == "update" || $this->CurrentAction == "U";
	}

	// - Grid update
	function IsGridUpdate() {
		return $this->CurrentAction == "gridupdate";
	}

	// - Grid insert
	function IsGridInsert() {
		return $this->CurrentAction == "gridinsert";
	}

	// - Grid overwrite
	function IsGridOverwrite() {
		return $this->CurrentAction == "gridoverwrite";
	}

	// Check last action
	// - Cancelled
	function IsCanceled() {
		return $this->LastAction == "cancel" && $this->CurrentAction == "";
	}

	// - Inline inserted
	function IsInlineInserted() {
		return $this->LastAction == "insert" && $this->CurrentAction == "";
	}

	// - Inline updated
	function IsInlineUpdated() {
		return $this->LastAction == "update" && $this->CurrentAction == "";
	}

	// - Grid updated
	function IsGridUpdated() {
		return $this->LastAction == "gridupdate" && $this->CurrentAction == "";
	}

	// - Grid inserted
	function IsGridInserted() {
		return $this->LastAction == "gridinsert" && $this->CurrentAction == "";
	}

	//
	// Table class constructor
	//
	function cusuarios($dg) {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// id_usuario
		$this->id_usuario = new cField('usuarios', 'usuarios', 'x_id_usuario', 'id_usuario', '`id_usuario`', 3, -1, FALSE, '`id_usuario`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->id_usuario->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_usuario'] =& $this->id_usuario;

		// nombre
		$this->nombre = new cField('usuarios', 'usuarios', 'x_nombre', 'nombre', '`nombre`', 200, -1, FALSE, '`nombre`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nombre'] =& $this->nombre;

		// apellido
		$this->apellido = new cField('usuarios', 'usuarios', 'x_apellido', 'apellido', '`apellido`', 200, -1, FALSE, '`apellido`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['apellido'] =& $this->apellido;

		// acceso
		$this->acceso = new cField('usuarios', 'usuarios', 'x_acceso', 'acceso', '`acceso`', 200, -1, FALSE, '`acceso`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['acceso'] =& $this->acceso;

		// llave
		$this->llave = new cField('usuarios', 'usuarios', 'x_llave', 'llave', '`llave`', 200, -1, FALSE, '`llave`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['llave'] =& $this->llave;

		// correo
		$this->correo = new cField('usuarios', 'usuarios', 'x_correo', 'correo', '`correo`', 200, -1, FALSE, '`correo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['correo'] =& $this->correo;

		// UserLevelID
		$this->UserLevelID = new cField('usuarios', 'usuarios', 'x_UserLevelID', 'UserLevelID', '`UserLevelID`', 3, -1, FALSE, '`UserLevelID`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->UserLevelID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['UserLevelID'] =& $this->UserLevelID;

		// estatus
		$this->estatus = new cField('usuarios', 'usuarios', 'x_estatus', 'estatus', '`estatus`', 3, -1, FALSE, '`estatus`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->estatus->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estatus'] =& $this->estatus;

		// profile
		$this->profile = new cField('usuarios', 'usuarios', 'x_profile', 'profile', '`profile`', 201, -1, FALSE, '`profile`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['profile'] =& $this->profile;
		// duracion_pass
		$this->duracion_pass = new cField('usuarios', 'usuarios', 'x_duracion_pass', 'duracion_pass', '`duracion_pass`', 3, -1, FALSE, '`duracion_pass`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->duracion_pass->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['duracion_pass'] =& $this->duracion_pass;

		// duracion_fech
		$this->duracion_fech = new cField('usuarios', 'usuarios', 'x_duracion_fech', 'duracion_fech', '`duracion_fech`', 133, 5, FALSE, '`duracion_fech`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->duracion_fech->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['duracion_fech'] =& $this->duracion_fech;
		
		$this->dg=$dg;
	}

	// Get field values
	function GetFieldValues($propertyname) {
		$values = array();
		foreach ($this->fields as $fldname => $fld)
			$values[$fldname] =& $fld->$propertyname;
		return $values;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "usuarios_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`usuarios`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		//var_dump($this->dg);
		if($this->dg==1){
		return $sWhere." estatus='1'";
		}else{
		return $sWhere;
		}
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (EW_ENCRYPTED_PASSWORD && $name == 'llave')
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? ew_EncryptPassword($value) : ew_EncryptPassword(strtolower($value));
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `usuarios` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `usuarios` SET ";
		foreach ($rs as $name => $value) {
			if (EW_ENCRYPTED_PASSWORD && $name == 'llave') {
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? ew_EncryptPassword($value) : ew_EncryptPassword(strtolower($value));
			}
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `usuarios` WHERE ";
		$SQL .= ew_QuotedName('id_usuario') . '=' . ew_QuotedValue($rs['id_usuario'], $this->id_usuario->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id_usuario` = @id_usuario@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id_usuario->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id_usuario@", ew_AdjustSql($this->id_usuario->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session

		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "usuarioslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "usuarioslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("usuariosview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "usuariosadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("usuariosedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("usuariosadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("usuariosdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id_usuario->CurrentValue)) {
			$sUrl .= "id_usuario=" . urlencode($this->id_usuario->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=usuarios" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["id_usuario"]; // id_usuario

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
				continue;
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id_usuario->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id_usuario->setDbValue($rs->fields('id_usuario'));
		$this->nombre->setDbValue($rs->fields('nombre'));
		$this->apellido->setDbValue($rs->fields('apellido'));
		$this->acceso->setDbValue($rs->fields('acceso'));
		$this->llave->setDbValue($rs->fields('llave'));
		$this->correo->setDbValue($rs->fields('correo'));
		$this->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$this->estatus->setDbValue($rs->fields('estatus'));
		$this->profile->setDbValue($rs->fields('profile'));
		$this->duracion_pass->setDbValue($rs->fields('duracion_pass'));
		$this->duracion_fech->setDbValue($rs->fields('duracion_fech'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id_usuario
		// nombre
		// apellido
		// acceso
		// llave
		// correo
		// UserLevelID
		// estatus
		// duracion_pass
		// duracion_fech
		// id_usuario

		$this->id_usuario->ViewValue = $this->id_usuario->CurrentValue;
		$this->id_usuario->ViewCustomAttributes = "";

		// nombre
		$this->nombre->ViewValue = $this->nombre->CurrentValue;
		$this->nombre->ViewCustomAttributes = "";

		// apellido
		$this->apellido->ViewValue = $this->apellido->CurrentValue;
		$this->apellido->ViewCustomAttributes = "";

		// acceso
		$this->acceso->ViewValue = $this->acceso->CurrentValue;
		$this->acceso->ViewCustomAttributes = "";

		// llave
		$this->llave->ViewValue = "********";
		$this->llave->ViewCustomAttributes = "";

		// correo
		$this->correo->ViewValue = $this->correo->CurrentValue;
		$this->correo->ViewCustomAttributes = "";

		// UserLevelID
		if ($Security->CanAdmin()) { // System admin
		if (strval($this->UserLevelID->CurrentValue) <> "") {
			$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($this->UserLevelID->CurrentValue) . "";
		$sSqlWrk = "SELECT `userlevelname` FROM `usuarioniveles`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->UserLevelID->ViewValue = $rswrk->fields('userlevelname');
				$rswrk->Close();
			} else {
				$this->UserLevelID->ViewValue = $this->UserLevelID->CurrentValue;
			}
		} else {
			$this->UserLevelID->ViewValue = NULL;
		}
		} else {
			$this->UserLevelID->ViewValue = "********";
		}
		$this->UserLevelID->ViewCustomAttributes = "";

		// estatus
		if (strval($this->estatus->CurrentValue) <> "") {
			switch ($this->estatus->CurrentValue) {
				case "1":
					$this->estatus->ViewValue = $this->estatus->FldTagCaption(1) <> "" ? $this->estatus->FldTagCaption(1) : $this->estatus->CurrentValue;
					break;
				case "0":
					$this->estatus->ViewValue = $this->estatus->FldTagCaption(2) <> "" ? $this->estatus->FldTagCaption(2) : $this->estatus->CurrentValue;
					break;
				default:
					$this->estatus->ViewValue = $this->estatus->CurrentValue;
			}
		} else {
			$this->estatus->ViewValue = NULL;
		}
		$this->estatus->ViewCustomAttributes = "";

		// profile
		$this->profile->ViewValue = $this->profile->CurrentValue;
		$this->profile->ViewCustomAttributes = "";

		// duracion_pass
		if (strval($this->duracion_pass->CurrentValue) <> "") {
			switch ($this->duracion_pass->CurrentValue) {
				case "2":
					$this->duracion_pass->ViewValue = $this->duracion_pass->FldTagCaption(1) <> "" ? $this->duracion_pass->FldTagCaption(1) : $this->duracion_pass->CurrentValue;
					break;
				case "3":
					$this->duracion_pass->ViewValue = $this->duracion_pass->FldTagCaption(2) <> "" ? $this->duracion_pass->FldTagCaption(2) : $this->duracion_pass->CurrentValue;
					break;
				case "4":
					$this->duracion_pass->ViewValue = $this->duracion_pass->FldTagCaption(3) <> "" ? $this->duracion_pass->FldTagCaption(3) : $this->duracion_pass->CurrentValue;
					break;
				default:
					$this->duracion_pass->ViewValue = $this->duracion_pass->CurrentValue;
			}
		} else {
			$this->duracion_pass->ViewValue = NULL;
		}
		$this->duracion_pass->ViewCustomAttributes = "";

		// duracion_fech
		$this->duracion_fech->ViewValue = $this->duracion_fech->CurrentValue;
		$this->duracion_fech->ViewValue = ew_FormatDateTime($this->duracion_fech->ViewValue, 5);
		$this->duracion_fech->ViewCustomAttributes = "";
		// id_usuario
		$this->id_usuario->LinkCustomAttributes = "";
		$this->id_usuario->HrefValue = "";
		$this->id_usuario->TooltipValue = "";

		// nombre
		$this->nombre->LinkCustomAttributes = "";
		$this->nombre->HrefValue = "";
		$this->nombre->TooltipValue = "";

		// apellido
		$this->apellido->LinkCustomAttributes = "";
		$this->apellido->HrefValue = "";
		$this->apellido->TooltipValue = "";

		// acceso
		$this->acceso->LinkCustomAttributes = "";
		$this->acceso->HrefValue = "";
		$this->acceso->TooltipValue = "";

		// llave
		$this->llave->LinkCustomAttributes = "";
		$this->llave->HrefValue = "";
		$this->llave->TooltipValue = "";

		// correo
		$this->correo->LinkCustomAttributes = "";
		$this->correo->HrefValue = "";
		$this->correo->TooltipValue = "";

		// UserLevelID
		$this->UserLevelID->LinkCustomAttributes = "";
		$this->UserLevelID->HrefValue = "";
		$this->UserLevelID->TooltipValue = "";

		// estatus
		$this->estatus->LinkCustomAttributes = "";
		$this->estatus->HrefValue = "";
		$this->estatus->TooltipValue = "";

		// profile
		$this->profile->LinkCustomAttributes = "";
		$this->profile->HrefValue = "";
		$this->profile->TooltipValue = "";

		// duracion_pass
		$this->duracion_pass->LinkCustomAttributes = "";
		$this->duracion_pass->HrefValue = "";
		$this->duracion_pass->TooltipValue = "";

		// duracion_fech
		$this->duracion_fech->LinkCustomAttributes = "";
		$this->duracion_fech->HrefValue = "";
		$this->duracion_fech->TooltipValue = "";
		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in Xml Format
	function ExportXmlDocument(&$XmlDoc, $HasParent, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$XmlDoc)
			return;
		if (!$HasParent)
			$XmlDoc->AddRoot($this->TableVar);

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if ($HasParent)
					$XmlDoc->AddRow($this->TableVar);
				else
					$XmlDoc->AddRow();
				if ($ExportPageType == "view") {
					$XmlDoc->AddField('nombre', $this->nombre->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('apellido', $this->apellido->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('acceso', $this->acceso->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('llave', $this->llave->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('correo', $this->correo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('UserLevelID', $this->UserLevelID->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estatus', $this->estatus->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('profile', $this->profile->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('duracion_pass', $this->duracion_pass->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('duracion_fech', $this->duracion_fech->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('nombre', $this->nombre->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('apellido', $this->apellido->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('acceso', $this->acceso->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('llave', $this->llave->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('correo', $this->correo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('UserLevelID', $this->UserLevelID->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estatus', $this->estatus->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('duracion_pass', $this->duracion_pass->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('duracion_fech', $this->duracion_fech->ExportValue($this->Export, $this->ExportOriginalValue));
				}
			}
			$Recordset->MoveNext();
		}
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			$Doc->BeginExportRow();
			if ($ExportPageType == "view") {
				$Doc->ExportCaption($this->nombre);
				$Doc->ExportCaption($this->apellido);
				$Doc->ExportCaption($this->acceso);
				$Doc->ExportCaption($this->llave);
				$Doc->ExportCaption($this->correo);
				$Doc->ExportCaption($this->UserLevelID);
				$Doc->ExportCaption($this->estatus);
				$Doc->ExportCaption($this->profile);
				$Doc->ExportCaption($this->duracion_pass);
				$Doc->ExportCaption($this->duracion_fech);
			} else {
				$Doc->ExportCaption($this->nombre);
				$Doc->ExportCaption($this->apellido);
				$Doc->ExportCaption($this->acceso);
				$Doc->ExportCaption($this->llave);
				$Doc->ExportCaption($this->correo);
				$Doc->ExportCaption($this->UserLevelID);
				$Doc->ExportCaption($this->estatus);
				$Doc->ExportCaption($this->duracion_pass);
				$Doc->ExportCaption($this->duracion_fech);
			}
			if ($this->Export == "pdf") {
				$Doc->EndExportRow(TRUE);
			} else {
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break for PDF
				if ($this->Export == "pdf" && $this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					$Doc->ExportField($this->nombre);
					$Doc->ExportField($this->apellido);
					$Doc->ExportField($this->acceso);
					$Doc->ExportField($this->llave);
					$Doc->ExportField($this->correo);
					$Doc->ExportField($this->UserLevelID);
					$Doc->ExportField($this->estatus);
					$Doc->ExportField($this->profile);
					$Doc->ExportField($this->duracion_pass);
					$Doc->ExportField($this->duracion_fech);
				} else {
					$Doc->ExportField($this->nombre);
					$Doc->ExportField($this->apellido);
					$Doc->ExportField($this->acceso);
					$Doc->ExportField($this->llave);
					$Doc->ExportField($this->correo);
					$Doc->ExportField($this->UserLevelID);
					$Doc->ExportField($this->estatus);
					$Doc->ExportField($this->duracion_pass);
					$Doc->ExportField($this->duracion_fech);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}
}
?>
