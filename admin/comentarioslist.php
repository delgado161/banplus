<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "comentariosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$comentarios_list = new ccomentarios_list();
$Page =& $comentarios_list;

// Page init
$comentarios_list->Page_Init();

// Page main
$comentarios_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($comentarios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var comentarios_list = new ew_Page("comentarios_list");

// page properties
comentarios_list.PageID = "list"; // page ID
comentarios_list.FormID = "fcomentarioslist"; // form ID
var EW_PAGE_ID = comentarios_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comentarios_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comentarios_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comentarios_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 20;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {			
		var inst;			
		for (inst in CKEDITOR.instances)
			CKEDITOR.instances[inst].updateElement();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];		
		if (inst)
			inst.setData(inst.element.value);
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];	
		if (inst)
			inst.focus();
	}
}

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($comentarios->Export == "") || (EW_EXPORT_MASTER_RECORD && $comentarios->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$comentarios_list->TotalRecs = $comentarios->SelectRecordCount();
	} else {
		if ($comentarios_list->Recordset = $comentarios_list->LoadRecordset())
			$comentarios_list->TotalRecs = $comentarios_list->Recordset->RecordCount();
	}
	$comentarios_list->StartRec = 1;
	if ($comentarios_list->DisplayRecs <= 0 || ($comentarios->Export <> "" && $comentarios->ExportAll)) // Display all records
		$comentarios_list->DisplayRecs = $comentarios_list->TotalRecs;
	if (!($comentarios->Export <> "" && $comentarios->ExportAll))
		$comentarios_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$comentarios_list->Recordset = $comentarios_list->LoadRecordset($comentarios_list->StartRec-1, $comentarios_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comentarios->TableCaption() ?>
&nbsp;&nbsp;<?php $comentarios_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($comentarios->Export == "" && $comentarios->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(comentarios_list);" style="text-decoration: none;"><img id="comentarios_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="comentarios_list_SearchPanel">
<form name="fcomentarioslistsrch" id="fcomentarioslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="comentarios">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($comentarios->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $comentarios_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($comentarios->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($comentarios->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($comentarios->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $comentarios_list->ShowPageHeader(); ?>
<?php
$comentarios_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fcomentarioslist" id="fcomentarioslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="comentarios">
<div id="gmp_comentarios" class="ewGridMiddlePanel">
<?php if ($comentarios_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $comentarios->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$comentarios_list->RenderListOptions();

// Render list options (header, left)
$comentarios_list->ListOptions->Render("header", "left");
?>
<?php if ($comentarios->autor->Visible) { // autor ?>
	<?php if ($comentarios->SortUrl($comentarios->autor) == "") { ?>
		<td><?php echo $comentarios->autor->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comentarios->SortUrl($comentarios->autor) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $comentarios->autor->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($comentarios->autor->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comentarios->autor->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($comentarios->descripcion->Visible) { // descripcion ?>
	<?php if ($comentarios->SortUrl($comentarios->descripcion) == "") { ?>
		<td><?php echo $comentarios->descripcion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comentarios->SortUrl($comentarios->descripcion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $comentarios->descripcion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($comentarios->descripcion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comentarios->descripcion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($comentarios->zemail->Visible) { // email ?>
	<?php if ($comentarios->SortUrl($comentarios->zemail) == "") { ?>
		<td><?php echo $comentarios->zemail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comentarios->SortUrl($comentarios->zemail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $comentarios->zemail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($comentarios->zemail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comentarios->zemail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($comentarios->fecha->Visible) { // fecha ?>
	<?php if ($comentarios->SortUrl($comentarios->fecha) == "") { ?>
		<td><?php echo $comentarios->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comentarios->SortUrl($comentarios->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $comentarios->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($comentarios->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comentarios->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$comentarios_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($comentarios->ExportAll && $comentarios->Export <> "") {
	$comentarios_list->StopRec = $comentarios_list->TotalRecs;
} else {

	// Set the last record to display
	if ($comentarios_list->TotalRecs > $comentarios_list->StartRec + $comentarios_list->DisplayRecs - 1)
		$comentarios_list->StopRec = $comentarios_list->StartRec + $comentarios_list->DisplayRecs - 1;
	else
		$comentarios_list->StopRec = $comentarios_list->TotalRecs;
}
$comentarios_list->RecCnt = $comentarios_list->StartRec - 1;
if ($comentarios_list->Recordset && !$comentarios_list->Recordset->EOF) {
	$comentarios_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $comentarios_list->StartRec > 1)
		$comentarios_list->Recordset->Move($comentarios_list->StartRec - 1);
} elseif (!$comentarios->AllowAddDeleteRow && $comentarios_list->StopRec == 0) {
	$comentarios_list->StopRec = $comentarios->GridAddRowCount;
}

// Initialize aggregate
$comentarios->RowType = EW_ROWTYPE_AGGREGATEINIT;
$comentarios->ResetAttrs();
$comentarios_list->RenderRow();
$comentarios_list->RowCnt = 0;
while ($comentarios_list->RecCnt < $comentarios_list->StopRec) {
	$comentarios_list->RecCnt++;
	if (intval($comentarios_list->RecCnt) >= intval($comentarios_list->StartRec)) {
		$comentarios_list->RowCnt++;

		// Set up key count
		$comentarios_list->KeyCount = $comentarios_list->RowIndex;

		// Init row class and style
		$comentarios->ResetAttrs();
		$comentarios->CssClass = "";
		if ($comentarios->CurrentAction == "gridadd") {
		} else {
			$comentarios_list->LoadRowValues($comentarios_list->Recordset); // Load row values
		}
		$comentarios->RowType = EW_ROWTYPE_VIEW; // Render view
		$comentarios->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$comentarios_list->RenderRow();

		// Render list options
		$comentarios_list->RenderListOptions();
?>
	<tr<?php echo $comentarios->RowAttributes() ?>>
<?php

// Render list options (body, left)
$comentarios_list->ListOptions->Render("body", "left");
?>
	<?php if ($comentarios->autor->Visible) { // autor ?>
		<td<?php echo $comentarios->autor->CellAttributes() ?>>
<div<?php echo $comentarios->autor->ViewAttributes() ?>><?php echo $comentarios->autor->ListViewValue() ?></div>
<a name="<?php echo $comentarios_list->PageObjName . "_row_" . $comentarios_list->RowCnt ?>" id="<?php echo $comentarios_list->PageObjName . "_row_" . $comentarios_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($comentarios->descripcion->Visible) { // descripcion ?>
		<td<?php echo $comentarios->descripcion->CellAttributes() ?>>
<div<?php echo $comentarios->descripcion->ViewAttributes() ?>><?php echo $comentarios->descripcion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($comentarios->zemail->Visible) { // email ?>
		<td<?php echo $comentarios->zemail->CellAttributes() ?>>
<div<?php echo $comentarios->zemail->ViewAttributes() ?>><?php echo $comentarios->zemail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($comentarios->fecha->Visible) { // fecha ?>
		<td<?php echo $comentarios->fecha->CellAttributes() ?>>
<div<?php echo $comentarios->fecha->ViewAttributes() ?>><?php echo $comentarios->fecha->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$comentarios_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($comentarios->CurrentAction <> "gridadd")
		$comentarios_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($comentarios_list->Recordset)
	$comentarios_list->Recordset->Close();
?>
<?php if ($comentarios->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($comentarios->CurrentAction <> "gridadd" && $comentarios->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($comentarios_list->Pager)) $comentarios_list->Pager = new cPrevNextPager($comentarios_list->StartRec, $comentarios_list->DisplayRecs, $comentarios_list->TotalRecs) ?>
<?php if ($comentarios_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($comentarios_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $comentarios_list->PageUrl() ?>start=<?php echo $comentarios_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($comentarios_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $comentarios_list->PageUrl() ?>start=<?php echo $comentarios_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $comentarios_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($comentarios_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $comentarios_list->PageUrl() ?>start=<?php echo $comentarios_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($comentarios_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $comentarios_list->PageUrl() ?>start=<?php echo $comentarios_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $comentarios_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $comentarios_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $comentarios_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $comentarios_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($comentarios_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $comentarios_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($comentarios->Export == "" && $comentarios->CurrentAction == "") { ?>
<?php } ?>
<?php
$comentarios_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($comentarios->Export == "") { ?>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$comentarios_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomentarios_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'comentarios';

	// Page object name
	var $PageObjName = 'comentarios_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comentarios;
		if ($comentarios->UseTokenInUrl) $PageUrl .= "t=" . $comentarios->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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
		global $objForm, $comentarios;
		if ($comentarios->UseTokenInUrl) {
			if ($objForm)
				return ($comentarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comentarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccomentarios_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (comentarios)
		if (!isset($GLOBALS["comentarios"])) {
			$GLOBALS["comentarios"] = new ccomentarios();
			$GLOBALS["Table"] =& $GLOBALS["comentarios"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "comentariosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "comentariosdelete.php";
		$this->MultiUpdateUrl = "comentariosupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comentarios', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $comentarios;

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
			$comentarios->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $comentarios;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($comentarios->Export <> "" ||
				$comentarios->CurrentAction == "gridadd" ||
				$comentarios->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$comentarios->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($comentarios->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $comentarios->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$comentarios->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$comentarios->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$comentarios->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $comentarios->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$comentarios->setSessionWhere($sFilter);
		$comentarios->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $comentarios;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $comentarios->autor, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $comentarios->descripcion, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $comentarios->zemail, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $comentarios;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $comentarios->BasicSearchKeyword;
		$sSearchType = $comentarios->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$comentarios->setSessionBasicSearchKeyword($sSearchKeyword);
			$comentarios->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $comentarios;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$comentarios->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $comentarios;
		$comentarios->setSessionBasicSearchKeyword("");
		$comentarios->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $comentarios;
		$bRestore = TRUE;
		if ($comentarios->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$comentarios->BasicSearchKeyword = $comentarios->getSessionBasicSearchKeyword();
			$comentarios->BasicSearchType = $comentarios->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $comentarios;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$comentarios->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$comentarios->CurrentOrderType = @$_GET["ordertype"];
			$comentarios->UpdateSort($comentarios->autor); // autor
			$comentarios->UpdateSort($comentarios->descripcion); // descripcion
			$comentarios->UpdateSort($comentarios->zemail); // email
			$comentarios->UpdateSort($comentarios->fecha); // fecha
			$comentarios->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $comentarios;
		$sOrderBy = $comentarios->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($comentarios->SqlOrderBy() <> "") {
				$sOrderBy = $comentarios->SqlOrderBy();
				$comentarios->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $comentarios;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$comentarios->setSessionOrderBy($sOrderBy);
				$comentarios->autor->setSort("");
				$comentarios->descripcion->setSort("");
				$comentarios->zemail->setSort("");
				$comentarios->fecha->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$comentarios->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $comentarios;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $comentarios, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $comentarios;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $comentarios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$comentarios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$comentarios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $comentarios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$comentarios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$comentarios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$comentarios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $comentarios;
		$comentarios->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$comentarios->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $comentarios;

		// Call Recordset Selecting event
		$comentarios->Recordset_Selecting($comentarios->CurrentFilter);

		// Load List page SQL
		$sSql = $comentarios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$comentarios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comentarios;
		$sFilter = $comentarios->KeyFilter();

		// Call Row Selecting event
		$comentarios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$comentarios->CurrentFilter = $sFilter;
		$sSql = $comentarios->SQL();
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
		global $conn, $comentarios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$comentarios->Row_Selected($row);
		$comentarios->id_comentario->setDbValue($rs->fields('id_comentario'));
		$comentarios->autor->setDbValue($rs->fields('autor'));
		$comentarios->descripcion->setDbValue($rs->fields('descripcion'));
		$comentarios->zemail->setDbValue($rs->fields('email'));
		$comentarios->fecha->setDbValue($rs->fields('fecha'));
	}

	// Load old record
	function LoadOldRecord() {
		global $comentarios;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($comentarios->getKey("id_comentario")) <> "")
			$comentarios->id_comentario->CurrentValue = $comentarios->getKey("id_comentario"); // id_comentario
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$comentarios->CurrentFilter = $comentarios->KeyFilter();
			$sSql = $comentarios->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $comentarios;

		// Initialize URLs
		$this->ViewUrl = $comentarios->ViewUrl();
		$this->EditUrl = $comentarios->EditUrl();
		$this->InlineEditUrl = $comentarios->InlineEditUrl();
		$this->CopyUrl = $comentarios->CopyUrl();
		$this->InlineCopyUrl = $comentarios->InlineCopyUrl();
		$this->DeleteUrl = $comentarios->DeleteUrl();

		// Call Row_Rendering event
		$comentarios->Row_Rendering();

		// Common render codes for all row types
		// id_comentario
		// autor
		// descripcion
		// email
		// fecha

		if ($comentarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// autor
			$comentarios->autor->ViewValue = $comentarios->autor->CurrentValue;
			$comentarios->autor->ViewCustomAttributes = "";

			// descripcion
			$comentarios->descripcion->ViewValue = $comentarios->descripcion->CurrentValue;
			$comentarios->descripcion->ViewCustomAttributes = "";

			// email
			$comentarios->zemail->ViewValue = $comentarios->zemail->CurrentValue;
			$comentarios->zemail->ViewCustomAttributes = "";

			// fecha
			$comentarios->fecha->ViewValue = $comentarios->fecha->CurrentValue;
			$comentarios->fecha->ViewValue = ew_FormatDateTime($comentarios->fecha->ViewValue, 7);
			$comentarios->fecha->ViewCustomAttributes = "";

			// autor
			$comentarios->autor->LinkCustomAttributes = "";
			$comentarios->autor->HrefValue = "";
			$comentarios->autor->TooltipValue = "";

			// descripcion
			$comentarios->descripcion->LinkCustomAttributes = "";
			$comentarios->descripcion->HrefValue = "";
			$comentarios->descripcion->TooltipValue = "";

			// email
			$comentarios->zemail->LinkCustomAttributes = "";
			$comentarios->zemail->HrefValue = "";
			$comentarios->zemail->TooltipValue = "";

			// fecha
			$comentarios->fecha->LinkCustomAttributes = "";
			$comentarios->fecha->HrefValue = "";
			$comentarios->fecha->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($comentarios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$comentarios->Row_Rendered();
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
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
