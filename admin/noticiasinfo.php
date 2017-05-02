<?php

// Global variable for table object
$noticias = NULL;

//
// Table class for noticias
//
class cnoticias {
	var $TableVar = 'noticias';
	var $TableName = 'noticias';
	var $TableType = 'TABLE';
	var $id_noticia;
	var $tipo;
	var $titulo;
	var $antetitulo;
	var $sumario;
	var $contenido;
	var $id_grupo;
	var $imagen;
	var $fecha;
	var $orden;
	var $f_desde;
	var $f_hasta;
	var $estatus;
	var $archivo;
	var $noticias_link;
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
	function cnoticias() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// id_noticia
		$this->id_noticia = new cField('noticias', 'noticias', 'x_id_noticia', 'id_noticia', '`id_noticia`', 3, -1, FALSE, '`id_noticia`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->id_noticia->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_noticia'] =& $this->id_noticia;

		// tipo
		$this->tipo = new cField('noticias', 'noticias', 'x_tipo', 'tipo', '`tipo`', 3, -1, FALSE, '`tipo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->tipo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tipo'] =& $this->tipo;

		// titulo
		$this->titulo = new cField('noticias', 'noticias', 'x_titulo', 'titulo', '`titulo`', 200, -1, FALSE, '`titulo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['titulo'] =& $this->titulo;

		// antetitulo
		$this->antetitulo = new cField('noticias', 'noticias', 'x_antetitulo', 'antetitulo', '`antetitulo`', 200, -1, FALSE, '`antetitulo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['antetitulo'] =& $this->antetitulo;

		// sumario
		$this->sumario = new cField('noticias', 'noticias', 'x_sumario', 'sumario', '`sumario`', 201, -1, FALSE, '`sumario`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->sumario->TruncateMemoRemoveHtml = TRUE;
		$this->fields['sumario'] =& $this->sumario;

		// contenido
		$this->contenido = new cField('noticias', 'noticias', 'x_contenido', 'contenido', '`contenido`', 201, -1, FALSE, '`contenido`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->contenido->TruncateMemoRemoveHtml = TRUE;
		$this->fields['contenido'] =& $this->contenido;

		// id_grupo
		$this->id_grupo = new cField('noticias', 'noticias', 'x_id_grupo', 'id_grupo', '`id_grupo`', 200, -1, FALSE, '`id_grupo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->id_grupo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_grupo'] =& $this->id_grupo;

		// imagen
		$this->imagen = new cField('noticias', 'noticias', 'x_imagen', 'imagen', '`imagen`', 200, -1, TRUE, '`imagen`', FALSE, FALSE, 'IMAGE');
		$this->imagen->UploadPath = '../uploads';
		$this->fields['imagen'] =& $this->imagen;

		// fecha
		$this->fecha = new cField('noticias', 'noticias', 'x_fecha', 'fecha', '`fecha`', 135, 7, FALSE, '`fecha`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fecha->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['fecha'] =& $this->fecha;

		// orden
		$this->orden = new cField('noticias', 'noticias', 'x_orden', 'orden', '`orden`', 200, -1, FALSE, '`orden`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['orden'] =& $this->orden;

		// f_desde
		$this->f_desde = new cField('noticias', 'noticias', 'x_f_desde', 'f_desde', '`f_desde`', 133, 7, FALSE, '`f_desde`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->f_desde->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['f_desde'] =& $this->f_desde;

		// f_hasta
		$this->f_hasta = new cField('noticias', 'noticias', 'x_f_hasta', 'f_hasta', '`f_hasta`', 133, 7, FALSE, '`f_hasta`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->f_hasta->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['f_hasta'] =& $this->f_hasta;

		// estatus
		$this->estatus = new cField('noticias', 'noticias', 'x_estatus', 'estatus', '`estatus`', 3, -1, FALSE, '`estatus`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->estatus->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estatus'] =& $this->estatus;
		
		// archivo
		$this->archivo = new cField('noticias', 'noticias', 'x_archivo', 'archivo', '`archivo`', 200, -1, TRUE, '`archivo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->archivo->UploadPath = '../uploads';
		$this->fields['archivo'] =& $this->archivo;
		
		// noticias_link
		$this->noticias_link = new cField('noticias', 'noticias', 'x_noticias_link', 'noticias_link', '`noticias_link`', 201, -1, FALSE, '`noticias_link`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['noticias_link'] =& $this->noticias_link;
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
		return "noticias_Highlight";
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
		return "`noticias`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
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
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `noticias` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `noticias` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `noticias` WHERE ";
		$SQL .= ew_QuotedName('id_noticia') . '=' . ew_QuotedValue($rs['id_noticia'], $this->id_noticia->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id_noticia` = @id_noticia@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id_noticia->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id_noticia@", ew_AdjustSql($this->id_noticia->CurrentValue), $sKeyFilter); // Replace key value
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
			return "noticiaslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "noticiaslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("noticiasview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "noticiasadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("noticiasedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("noticiasadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("noticiasdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id_noticia->CurrentValue)) {
			$sUrl .= "id_noticia=" . urlencode($this->id_noticia->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=noticias" : "";
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
			$arKeys[] = @$_GET["id_noticia"]; // id_noticia

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
			$this->id_noticia->CurrentValue = $key;
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
		$this->id_noticia->setDbValue($rs->fields('id_noticia'));
		$this->tipo->setDbValue($rs->fields('tipo'));
		$this->titulo->setDbValue($rs->fields('titulo'));
		$this->antetitulo->setDbValue($rs->fields('antetitulo'));
		$this->sumario->setDbValue($rs->fields('sumario'));
		$this->contenido->setDbValue($rs->fields('contenido'));
		$this->id_grupo->setDbValue($rs->fields('id_grupo'));
		$this->imagen->Upload->DbValue = $rs->fields('imagen');
		$this->fecha->setDbValue($rs->fields('fecha'));
		$this->orden->setDbValue($rs->fields('orden'));
		$this->f_desde->setDbValue($rs->fields('f_desde'));
		$this->f_hasta->setDbValue($rs->fields('f_hasta'));
		$this->estatus->setDbValue($rs->fields('estatus'));
		$this->archivo->Upload->DbValue = $rs->fields('archivo');
		$this->noticias_link->setDbValue($rs->fields('noticias_link'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id_noticia

		$this->id_noticia->CellCssStyle = "white-space: nowrap;";

		// tipo
		// titulo
		// antetitulo
		// sumario
		// contenido
		// id_grupo
		// imagen
		// fecha
		// orden
		// f_desde
		// f_hasta
		// estatus
		// id_noticia

		$this->id_noticia->ViewValue = $this->id_noticia->CurrentValue;
		$this->id_noticia->ViewCustomAttributes = "";

		// tipo
		if (strval($this->tipo->CurrentValue) <> "") {
			switch ($this->tipo->CurrentValue) {
				case "1":
					$this->tipo->ViewValue = $this->tipo->FldTagCaption(1) <> "" ? $this->tipo->FldTagCaption(1) : $this->tipo->CurrentValue;
					break;
				case "2":
					$this->tipo->ViewValue = $this->tipo->FldTagCaption(2) <> "" ? $this->tipo->FldTagCaption(2) : $this->tipo->CurrentValue;
					break;
				case "3":
					$this->tipo->ViewValue = $this->tipo->FldTagCaption(3) <> "" ? $this->tipo->FldTagCaption(3) : $this->tipo->CurrentValue;
					break;
				case "4":
					$this->tipo->ViewValue = $this->tipo->FldTagCaption(4) <> "" ? $this->tipo->FldTagCaption(4) : $this->tipo->CurrentValue;
					break;
				default:
					$this->tipo->ViewValue = $this->tipo->CurrentValue;
			}
		} else {
			$this->tipo->ViewValue = NULL;
		}
		$this->tipo->ViewCustomAttributes = "";

		// titulo
		$this->titulo->ViewValue = $this->titulo->CurrentValue;
		$this->titulo->ViewCustomAttributes = "";

		// antetitulo
		$this->antetitulo->ViewValue = $this->antetitulo->CurrentValue;
		$this->antetitulo->ViewCustomAttributes = "";

		// sumario
		$this->sumario->ViewValue = $this->sumario->CurrentValue;
		$this->sumario->ViewCustomAttributes = "";

		// contenido
		$this->contenido->ViewValue = $this->contenido->CurrentValue;
		$this->contenido->ViewCustomAttributes = "";

		// id_grupo
		if (strval($this->id_grupo->CurrentValue) <> "") {
			$arwrk = explode(",", $this->id_grupo->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`id_grupo` = " . ew_AdjustSql(trim($wrk)) . "";
			}	
		$sSqlWrk = "SELECT `nombre` FROM `grupo`";
		$sWhereWrk = "";
		$lookuptblfilter = "`id_padre` is null";
		if (strval($lookuptblfilter) <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $lookuptblfilter . ")";
		}
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `nombre`";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->id_grupo->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$this->id_grupo->ViewValue .= $rswrk->fields('nombre');
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->id_grupo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->id_grupo->ViewValue = $this->id_grupo->CurrentValue;
			}
		} else {
			$this->id_grupo->ViewValue = NULL;
		}
		$this->id_grupo->ViewCustomAttributes = "";

		// imagen
		if (!ew_Empty($this->imagen->Upload->DbValue)) {
			$this->imagen->ViewValue = $this->imagen->Upload->DbValue;
			$this->imagen->ImageWidth = 150;
			$this->imagen->ImageHeight = 30;
			$this->imagen->ImageAlt = $this->imagen->FldAlt();
		} else {
			$this->imagen->ViewValue = "";
		}
		$this->imagen->ViewCustomAttributes = "";

		// fecha
		$this->fecha->ViewValue = $this->fecha->CurrentValue;
		$this->fecha->ViewValue = ew_FormatDateTime($this->fecha->ViewValue, 7);
		$this->fecha->ViewCustomAttributes = "";

		// orden
		$this->orden->ViewValue = $this->orden->CurrentValue;
		$this->orden->ViewCustomAttributes = "";

		// f_desde
		$this->f_desde->ViewValue = $this->f_desde->CurrentValue;
		$this->f_desde->ViewValue = ew_FormatDateTime($this->f_desde->ViewValue, 7);
		$this->f_desde->ViewCustomAttributes = "";

		// f_hasta
		$this->f_hasta->ViewValue = $this->f_hasta->CurrentValue;
		$this->f_hasta->ViewValue = ew_FormatDateTime($this->f_hasta->ViewValue, 7);
		$this->f_hasta->ViewCustomAttributes = "";

		// estatus
		if (strval($this->estatus->CurrentValue) <> "") {
			switch ($this->estatus->CurrentValue) {
					case "1":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(1) <> "" ? $noticias->estatus->FldTagCaption(1) : $noticias->estatus->CurrentValue;
						break;
					case "0":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(2) <> "" ? $noticias->estatus->FldTagCaption(2) : $noticias->estatus->CurrentValue;
						break;
					case "3":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(3) <> "" ? $noticias->estatus->FldTagCaption(3) : $noticias->estatus->CurrentValue;
						break;
					case "4":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(4) <> "" ? $noticias->estatus->FldTagCaption(4) : $noticias->estatus->CurrentValue;
						break;
				default:
					$this->estatus->ViewValue = $this->estatus->CurrentValue;
			}
		} else {
			$this->estatus->ViewValue = NULL;
		}
		$this->estatus->ViewCustomAttributes = "";
		
		// archivo
		if (!ew_Empty($this->archivo->Upload->DbValue)) {
			$this->archivo->ViewValue = $this->archivo->Upload->DbValue;
		} else {
			$this->archivo->ViewValue = "";
		}
		$this->archivo->ViewCustomAttributes = "";

		// noticias_link
		$this->noticias_link->ViewValue = $this->noticias_link->CurrentValue;
		$this->noticias_link->ViewCustomAttributes = "";
		

		// id_noticia
		$this->id_noticia->LinkCustomAttributes = "";
		$this->id_noticia->HrefValue = "";
		$this->id_noticia->TooltipValue = "";

		// tipo
		$this->tipo->LinkCustomAttributes = "";
		$this->tipo->HrefValue = "";
		$this->tipo->TooltipValue = "";

		// titulo
		$this->titulo->LinkCustomAttributes = "";
		$this->titulo->HrefValue = "";
		$this->titulo->TooltipValue = "";

		// antetitulo
		$this->antetitulo->LinkCustomAttributes = "";
		$this->antetitulo->HrefValue = "";
		$this->antetitulo->TooltipValue = "";

		// sumario
		$this->sumario->LinkCustomAttributes = "";
		$this->sumario->HrefValue = "";
		$this->sumario->TooltipValue = "";

		// contenido
		$this->contenido->LinkCustomAttributes = "";
		$this->contenido->HrefValue = "";
		$this->contenido->TooltipValue = "";

		// id_grupo
		$this->id_grupo->LinkCustomAttributes = "";
		$this->id_grupo->HrefValue = "";
		$this->id_grupo->TooltipValue = "";

		// imagen
		$this->imagen->LinkCustomAttributes = "";
		$this->imagen->HrefValue = "";
		$this->imagen->TooltipValue = "";

		// fecha
		$this->fecha->LinkCustomAttributes = "";
		$this->fecha->HrefValue = "";
		$this->fecha->TooltipValue = "";

		// orden
		$this->orden->LinkCustomAttributes = "";
		$this->orden->HrefValue = "";
		$this->orden->TooltipValue = "";

		// f_desde
		$this->f_desde->LinkCustomAttributes = "";
		$this->f_desde->HrefValue = "";
		$this->f_desde->TooltipValue = "";

		// f_hasta
		$this->f_hasta->LinkCustomAttributes = "";
		$this->f_hasta->HrefValue = "";
		$this->f_hasta->TooltipValue = "";
		
			// archivo
		$this->archivo->LinkCustomAttributes = "";
		if (!ew_Empty($this->archivo->Upload->DbValue)) {
			$this->archivo->HrefValue = ew_UploadPathEx(FALSE, $this->archivo->UploadPath) . ((!empty($this->archivo->ViewValue)) ? $this->archivo->ViewValue : $this->archivo->CurrentValue); // Add prefix/suffix
		}
		// estatus
		$this->estatus->LinkCustomAttributes = "";
		$this->estatus->HrefValue = "";
		$this->estatus->TooltipValue = "";
		
		// noticias_link
		$this->noticias_link->LinkCustomAttributes = "";
		$this->noticias_link->HrefValue = "";
		$this->noticias_link->TooltipValue = "";

		

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
					$XmlDoc->AddField('tipo', $this->tipo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('titulo', $this->titulo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('antetitulo', $this->antetitulo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('sumario', $this->sumario->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('contenido', $this->contenido->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('id_grupo', $this->id_grupo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('imagen', $this->imagen->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fecha', $this->fecha->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('orden', $this->orden->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('f_desde', $this->f_desde->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('f_hasta', $this->f_hasta->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estatus', $this->estatus->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('archivo', $this->archivo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('noticias_link', $this->noticias_link->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('tipo', $this->tipo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('titulo', $this->titulo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('antetitulo', $this->antetitulo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('id_grupo', $this->id_grupo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('imagen', $this->imagen->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fecha', $this->fecha->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('orden', $this->orden->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('f_desde', $this->f_desde->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('f_hasta', $this->f_hasta->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estatus', $this->estatus->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('archivo', $this->archivo->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->tipo);
				$Doc->ExportCaption($this->titulo);
				$Doc->ExportCaption($this->antetitulo);
				$Doc->ExportCaption($this->sumario);
				$Doc->ExportCaption($this->contenido);
				$Doc->ExportCaption($this->id_grupo);
				$Doc->ExportCaption($this->imagen);
				$Doc->ExportCaption($this->fecha);
				$Doc->ExportCaption($this->orden);
				$Doc->ExportCaption($this->f_desde);
				$Doc->ExportCaption($this->f_hasta);
				$Doc->ExportCaption($this->estatus);
				$Doc->ExportCaption($this->archivo);
				$Doc->ExportCaption($this->noticias_link);
			} else {
				$Doc->ExportCaption($this->tipo);
				$Doc->ExportCaption($this->titulo);
				$Doc->ExportCaption($this->antetitulo);
				$Doc->ExportCaption($this->id_grupo);
				$Doc->ExportCaption($this->imagen);
				$Doc->ExportCaption($this->fecha);
				$Doc->ExportCaption($this->orden);
				$Doc->ExportCaption($this->f_desde);
				$Doc->ExportCaption($this->f_hasta);
				$Doc->ExportCaption($this->estatus);
				$Doc->ExportCaption($this->archivo);
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
					$Doc->ExportField($this->tipo);
					$Doc->ExportField($this->titulo);
					$Doc->ExportField($this->antetitulo);
					$Doc->ExportField($this->sumario);
					$Doc->ExportField($this->contenido);
					$Doc->ExportField($this->id_grupo);
					$Doc->ExportField($this->imagen);
					$Doc->ExportField($this->fecha);
					$Doc->ExportField($this->orden);
					$Doc->ExportField($this->f_desde);
					$Doc->ExportField($this->f_hasta);
					$Doc->ExportField($this->estatus);
					$Doc->ExportField($this->archivo);
					$Doc->ExportField($this->noticias_link);
				} else {
					$Doc->ExportField($this->tipo);
					$Doc->ExportField($this->titulo);
					$Doc->ExportField($this->antetitulo);
					$Doc->ExportField($this->id_grupo);
					$Doc->ExportField($this->imagen);
					$Doc->ExportField($this->fecha);
					$Doc->ExportField($this->orden);
					$Doc->ExportField($this->f_desde);
					$Doc->ExportField($this->f_hasta);
					$Doc->ExportField($this->estatus);
					$Doc->ExportField($this->archivo);
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
