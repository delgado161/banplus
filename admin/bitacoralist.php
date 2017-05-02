<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "bitacorainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$bitacora_list = new cbitacora_list();
$Page =& $bitacora_list;

// Page init
$bitacora_list->Page_Init();

// Page main
$bitacora_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($bitacora->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var bitacora_list = new ew_Page("bitacora_list");

// page properties
bitacora_list.PageID = "list"; // page ID
bitacora_list.FormID = "fbitacoralist"; // form ID
var EW_PAGE_ID = bitacora_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
bitacora_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
bitacora_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
bitacora_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($bitacora->Export == "") || (EW_EXPORT_MASTER_RECORD && $bitacora->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$bitacora_list->TotalRecs = $bitacora->SelectRecordCount();
	} else {
		if ($bitacora_list->Recordset = $bitacora_list->LoadRecordset())
			$bitacora_list->TotalRecs = $bitacora_list->Recordset->RecordCount();
	}
	$bitacora_list->StartRec = 1;
	if ($bitacora_list->DisplayRecs <= 0 || ($bitacora->Export <> "" && $bitacora->ExportAll)) // Display all records
		$bitacora_list->DisplayRecs = $bitacora_list->TotalRecs;
	if (!($bitacora->Export <> "" && $bitacora->ExportAll))
		$bitacora_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$bitacora_list->Recordset = $bitacora_list->LoadRecordset($bitacora_list->StartRec-1, $bitacora_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $bitacora->TableCaption() ?>
&nbsp;&nbsp;<?php $bitacora_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($bitacora->Export == "" && $bitacora->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(bitacora_list);" style="text-decoration: none;"><img id="bitacora_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="bitacora_list_SearchPanel">
<form name="fbitacoralistsrch" id="fbitacoralistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="bitacora">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($bitacora->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $bitacora_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($bitacora->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($bitacora->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($bitacora->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $bitacora_list->ShowPageHeader(); ?>
<?php
$bitacora_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fbitacoralist" id="fbitacoralist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="bitacora">
<div id="gmp_bitacora" class="ewGridMiddlePanel">
<?php if ($bitacora_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $bitacora->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$bitacora_list->RenderListOptions();

// Render list options (header, left)
$bitacora_list->ListOptions->Render("header", "left");
?>
<?php if ($bitacora->id_bitacora->Visible) { // id_bitacora ?>
	<?php if ($bitacora->SortUrl($bitacora->id_bitacora) == "") { ?>
		<td><?php echo $bitacora->id_bitacora->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bitacora->SortUrl($bitacora->id_bitacora) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bitacora->id_bitacora->FldCaption() ?></td><td style="width: 10px;"><?php if ($bitacora->id_bitacora->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bitacora->id_bitacora->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bitacora->fecha->Visible) { // fecha ?>
	<?php if ($bitacora->SortUrl($bitacora->fecha) == "") { ?>
		<td><?php echo $bitacora->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bitacora->SortUrl($bitacora->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bitacora->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($bitacora->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bitacora->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bitacora->usuario->Visible) { // usuario ?>
	<?php if ($bitacora->SortUrl($bitacora->usuario) == "") { ?>
		<td><?php echo $bitacora->usuario->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bitacora->SortUrl($bitacora->usuario) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bitacora->usuario->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($bitacora->usuario->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bitacora->usuario->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bitacora->accion->Visible) { // accion ?>
	<?php if ($bitacora->SortUrl($bitacora->accion) == "") { ?>
		<td><?php echo $bitacora->accion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bitacora->SortUrl($bitacora->accion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bitacora->accion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($bitacora->accion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bitacora->accion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bitacora->formulario->Visible) { // formulario ?>
	<?php if ($bitacora->SortUrl($bitacora->formulario) == "") { ?>
		<td><?php echo $bitacora->formulario->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bitacora->SortUrl($bitacora->formulario) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bitacora->formulario->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($bitacora->formulario->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bitacora->formulario->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$bitacora_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($bitacora->ExportAll && $bitacora->Export <> "") {
	$bitacora_list->StopRec = $bitacora_list->TotalRecs;
} else {

	// Set the last record to display
	if ($bitacora_list->TotalRecs > $bitacora_list->StartRec + $bitacora_list->DisplayRecs - 1)
		$bitacora_list->StopRec = $bitacora_list->StartRec + $bitacora_list->DisplayRecs - 1;
	else
		$bitacora_list->StopRec = $bitacora_list->TotalRecs;
}
$bitacora_list->RecCnt = $bitacora_list->StartRec - 1;
if ($bitacora_list->Recordset && !$bitacora_list->Recordset->EOF) {
	$bitacora_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $bitacora_list->StartRec > 1)
		$bitacora_list->Recordset->Move($bitacora_list->StartRec - 1);
} elseif (!$bitacora->AllowAddDeleteRow && $bitacora_list->StopRec == 0) {
	$bitacora_list->StopRec = $bitacora->GridAddRowCount;
}

// Initialize aggregate
$bitacora->RowType = EW_ROWTYPE_AGGREGATEINIT;
$bitacora->ResetAttrs();
$bitacora_list->RenderRow();
$bitacora_list->RowCnt = 0;
while ($bitacora_list->RecCnt < $bitacora_list->StopRec) {
	$bitacora_list->RecCnt++;
	if (intval($bitacora_list->RecCnt) >= intval($bitacora_list->StartRec)) {
		$bitacora_list->RowCnt++;

		// Set up key count
		$bitacora_list->KeyCount = $bitacora_list->RowIndex;

		// Init row class and style
		$bitacora->ResetAttrs();
		$bitacora->CssClass = "";
		if ($bitacora->CurrentAction == "gridadd") {
		} else {
			$bitacora_list->LoadRowValues($bitacora_list->Recordset); // Load row values
		}
		$bitacora->RowType = EW_ROWTYPE_VIEW; // Render view
		$bitacora->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$bitacora_list->RenderRow();

		// Render list options
		$bitacora_list->RenderListOptions();
?>
	<tr<?php echo $bitacora->RowAttributes() ?>>
<?php

// Render list options (body, left)
$bitacora_list->ListOptions->Render("body", "left");
?>
	<?php if ($bitacora->id_bitacora->Visible) { // id_bitacora ?>
		<td<?php echo $bitacora->id_bitacora->CellAttributes() ?>>
<div<?php echo $bitacora->id_bitacora->ViewAttributes() ?>><?php echo $bitacora->id_bitacora->ListViewValue() ?></div>
<a name="<?php echo $bitacora_list->PageObjName . "_row_" . $bitacora_list->RowCnt ?>" id="<?php echo $bitacora_list->PageObjName . "_row_" . $bitacora_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($bitacora->fecha->Visible) { // fecha ?>
		<td<?php echo $bitacora->fecha->CellAttributes() ?>>
<div<?php echo $bitacora->fecha->ViewAttributes() ?>><?php echo $bitacora->fecha->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bitacora->usuario->Visible) { // usuario ?>
		<td<?php echo $bitacora->usuario->CellAttributes() ?>>
<div<?php echo $bitacora->usuario->ViewAttributes() ?>><?php echo $bitacora->usuario->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bitacora->accion->Visible) { // accion ?>
		<td<?php echo $bitacora->accion->CellAttributes() ?>>
<div<?php echo $bitacora->accion->ViewAttributes() ?>><?php echo $bitacora->accion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bitacora->formulario->Visible) { // formulario ?>
		<td<?php echo $bitacora->formulario->CellAttributes() ?>>
<div<?php echo $bitacora->formulario->ViewAttributes() ?>><?php echo $bitacora->formulario->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bitacora_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($bitacora->CurrentAction <> "gridadd")
		$bitacora_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($bitacora_list->Recordset)
	$bitacora_list->Recordset->Close();
?>
<?php if ($bitacora->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($bitacora->CurrentAction <> "gridadd" && $bitacora->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($bitacora_list->Pager)) $bitacora_list->Pager = new cPrevNextPager($bitacora_list->StartRec, $bitacora_list->DisplayRecs, $bitacora_list->TotalRecs) ?>
<?php if ($bitacora_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($bitacora_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $bitacora_list->PageUrl() ?>start=<?php echo $bitacora_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($bitacora_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $bitacora_list->PageUrl() ?>start=<?php echo $bitacora_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $bitacora_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($bitacora_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $bitacora_list->PageUrl() ?>start=<?php echo $bitacora_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($bitacora_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $bitacora_list->PageUrl() ?>start=<?php echo $bitacora_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $bitacora_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $bitacora_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $bitacora_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $bitacora_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($bitacora_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $bitacora_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($bitacora->Export == "" && $bitacora->CurrentAction == "") { ?>
<?php } ?>
<?php
$bitacora_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($bitacora->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$bitacora_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cbitacora_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'bitacora';

	// Page object name
	var $PageObjName = 'bitacora_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $bitacora;
		if ($bitacora->UseTokenInUrl) $PageUrl .= "t=" . $bitacora->TableVar . "&"; // Add page token
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
		global $objForm, $bitacora;
		if ($bitacora->UseTokenInUrl) {
			if ($objForm)
				return ($bitacora->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($bitacora->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbitacora_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (bitacora)
		if (!isset($GLOBALS["bitacora"])) {
			$GLOBALS["bitacora"] = new cbitacora();
			$GLOBALS["Table"] =& $GLOBALS["bitacora"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "bitacoraadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "bitacoradelete.php";
		$this->MultiUpdateUrl = "bitacoraupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'bitacora', TRUE);

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
		global $bitacora;

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
			$bitacora->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $bitacora;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($bitacora->Export <> "" ||
				$bitacora->CurrentAction == "gridadd" ||
				$bitacora->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$bitacora->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($bitacora->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $bitacora->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$bitacora->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$bitacora->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$bitacora->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $bitacora->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$bitacora->setSessionWhere($sFilter);
		$bitacora->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $bitacora;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $bitacora->valor_anterior, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $bitacora->valor_nuevo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $bitacora->usuario, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $bitacora->accion, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $bitacora->formulario, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $bitacora->campos, $Keyword);
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
		global $Security, $bitacora;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $bitacora->BasicSearchKeyword;
		$sSearchType = $bitacora->BasicSearchType;
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
			$bitacora->setSessionBasicSearchKeyword($sSearchKeyword);
			$bitacora->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $bitacora;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$bitacora->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $bitacora;
		$bitacora->setSessionBasicSearchKeyword("");
		$bitacora->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $bitacora;
		$bRestore = TRUE;
		if ($bitacora->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$bitacora->BasicSearchKeyword = $bitacora->getSessionBasicSearchKeyword();
			$bitacora->BasicSearchType = $bitacora->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $bitacora;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$bitacora->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$bitacora->CurrentOrderType = @$_GET["ordertype"];
			$bitacora->UpdateSort($bitacora->id_bitacora); // id_bitacora
			$bitacora->UpdateSort($bitacora->fecha); // fecha
			$bitacora->UpdateSort($bitacora->usuario); // usuario
			$bitacora->UpdateSort($bitacora->accion); // accion
			$bitacora->UpdateSort($bitacora->formulario); // formulario
			$bitacora->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $bitacora;
		$sOrderBy = $bitacora->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($bitacora->SqlOrderBy() <> "") {
				$sOrderBy = $bitacora->SqlOrderBy();
				$bitacora->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $bitacora;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$bitacora->setSessionOrderBy($sOrderBy);
				$bitacora->id_bitacora->setSort("");
				$bitacora->fecha->setSort("");
				$bitacora->usuario->setSort("");
				$bitacora->accion->setSort("");
				$bitacora->formulario->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$bitacora->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $bitacora;

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
		global $Security, $Language, $bitacora, $objForm;
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
		global $Security, $Language, $bitacora;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $bitacora;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$bitacora->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$bitacora->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $bitacora->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$bitacora->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$bitacora->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$bitacora->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $bitacora;
		$bitacora->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$bitacora->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $bitacora;

		// Call Recordset Selecting event
		$bitacora->Recordset_Selecting($bitacora->CurrentFilter);

		// Load List page SQL
		$sSql = $bitacora->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$bitacora->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $bitacora;
		$sFilter = $bitacora->KeyFilter();

		// Call Row Selecting event
		$bitacora->Row_Selecting($sFilter);

		// Load SQL based on filter
		$bitacora->CurrentFilter = $sFilter;
		$sSql = $bitacora->SQL();
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
		global $conn, $bitacora;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$bitacora->Row_Selected($row);
		$bitacora->id_bitacora->setDbValue($rs->fields('id_bitacora'));
		$bitacora->valor_anterior->setDbValue($rs->fields('valor_anterior'));
		$bitacora->valor_nuevo->setDbValue($rs->fields('valor_nuevo'));
		$bitacora->fecha->setDbValue($rs->fields('fecha'));
		$bitacora->usuario->setDbValue($rs->fields('usuario'));
		$bitacora->accion->setDbValue($rs->fields('accion'));
		$bitacora->formulario->setDbValue($rs->fields('formulario'));
		$bitacora->campos->setDbValue($rs->fields('campos'));
	}

	// Load old record
	function LoadOldRecord() {
		global $bitacora;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($bitacora->getKey("id_bitacora")) <> "")
			$bitacora->id_bitacora->CurrentValue = $bitacora->getKey("id_bitacora"); // id_bitacora
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$bitacora->CurrentFilter = $bitacora->KeyFilter();
			$sSql = $bitacora->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $bitacora;

		// Initialize URLs
		$this->ViewUrl = $bitacora->ViewUrl();
		$this->EditUrl = $bitacora->EditUrl();
		$this->InlineEditUrl = $bitacora->InlineEditUrl();
		$this->CopyUrl = $bitacora->CopyUrl();
		$this->InlineCopyUrl = $bitacora->InlineCopyUrl();
		$this->DeleteUrl = $bitacora->DeleteUrl();

		// Call Row_Rendering event
		$bitacora->Row_Rendering();

		// Common render codes for all row types
		// id_bitacora
		// valor_anterior
		// valor_nuevo
		// fecha
		// usuario
		// accion
		// formulario
		// campos

		if ($bitacora->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_bitacora
			$bitacora->id_bitacora->ViewValue = $bitacora->id_bitacora->CurrentValue;
			$bitacora->id_bitacora->ViewCustomAttributes = "";

			// fecha
			$bitacora->fecha->ViewValue = $bitacora->fecha->CurrentValue;
			$bitacora->fecha->ViewValue = ew_FormatDateTime($bitacora->fecha->ViewValue, 7);
			$bitacora->fecha->ViewCustomAttributes = "";

			// usuario
			$bitacora->usuario->ViewValue = $bitacora->usuario->CurrentValue;
			$bitacora->usuario->ViewCustomAttributes = "";

			// accion
			$bitacora->accion->ViewValue = $bitacora->accion->CurrentValue;
			$bitacora->accion->ViewCustomAttributes = "";

			// formulario
			$bitacora->formulario->ViewValue = $bitacora->formulario->CurrentValue;
			$bitacora->formulario->ViewCustomAttributes = "";

			// id_bitacora
			$bitacora->id_bitacora->LinkCustomAttributes = "";
			$bitacora->id_bitacora->HrefValue = "";
			$bitacora->id_bitacora->TooltipValue = "";

			// fecha
			$bitacora->fecha->LinkCustomAttributes = "";
			$bitacora->fecha->HrefValue = "";
			$bitacora->fecha->TooltipValue = "";

			// usuario
			$bitacora->usuario->LinkCustomAttributes = "";
			$bitacora->usuario->HrefValue = "";
			$bitacora->usuario->TooltipValue = "";

			// accion
			$bitacora->accion->LinkCustomAttributes = "";
			$bitacora->accion->HrefValue = "";
			$bitacora->accion->TooltipValue = "";

			// formulario
			$bitacora->formulario->LinkCustomAttributes = "";
			$bitacora->formulario->HrefValue = "";
			$bitacora->formulario->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($bitacora->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$bitacora->Row_Rendered();
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

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'bitacora';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
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
