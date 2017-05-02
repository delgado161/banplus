<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modulos_financierosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$modulos_financieros_list = new cmodulos_financieros_list();
$Page =& $modulos_financieros_list;

// Page init
$modulos_financieros_list->Page_Init();

// Page main
$modulos_financieros_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($modulos_financieros->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var modulos_financieros_list = new ew_Page("modulos_financieros_list");

// page properties
modulos_financieros_list.PageID = "list"; // page ID
modulos_financieros_list.FormID = "fmodulos_financieroslist"; // form ID
var EW_PAGE_ID = modulos_financieros_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
modulos_financieros_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
modulos_financieros_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
modulos_financieros_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($modulos_financieros->Export == "") || (EW_EXPORT_MASTER_RECORD && $modulos_financieros->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$modulos_financieros_list->TotalRecs = $modulos_financieros->SelectRecordCount();
	} else {
		if ($modulos_financieros_list->Recordset = $modulos_financieros_list->LoadRecordset())
			$modulos_financieros_list->TotalRecs = $modulos_financieros_list->Recordset->RecordCount();
	}
	$modulos_financieros_list->StartRec = 1;
	if ($modulos_financieros_list->DisplayRecs <= 0 || ($modulos_financieros->Export <> "" && $modulos_financieros->ExportAll)) // Display all records
		$modulos_financieros_list->DisplayRecs = $modulos_financieros_list->TotalRecs;
	if (!($modulos_financieros->Export <> "" && $modulos_financieros->ExportAll))
		$modulos_financieros_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$modulos_financieros_list->Recordset = $modulos_financieros_list->LoadRecordset($modulos_financieros_list->StartRec-1, $modulos_financieros_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $modulos_financieros->TableCaption() ?>
&nbsp;&nbsp;<?php $modulos_financieros_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($modulos_financieros->Export == "" && $modulos_financieros->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(modulos_financieros_list);" style="text-decoration: none;"><img id="modulos_financieros_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="modulos_financieros_list_SearchPanel">
<form name="fmodulos_financieroslistsrch" id="fmodulos_financieroslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="modulos_financieros">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($modulos_financieros->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $modulos_financieros_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($modulos_financieros->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($modulos_financieros->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($modulos_financieros->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $modulos_financieros_list->ShowPageHeader(); ?>
<?php
$modulos_financieros_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmodulos_financieroslist" id="fmodulos_financieroslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="modulos_financieros">
<div id="gmp_modulos_financieros" class="ewGridMiddlePanel">
<?php if ($modulos_financieros_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $modulos_financieros->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$modulos_financieros_list->RenderListOptions();

// Render list options (header, left)
$modulos_financieros_list->ListOptions->Render("header", "left");
?>
<?php if ($modulos_financieros->id_modulo_financiero->Visible) { // id_modulo_financiero ?>
	<?php if ($modulos_financieros->SortUrl($modulos_financieros->id_modulo_financiero) == "") { ?>
		<td><?php echo $modulos_financieros->id_modulo_financiero->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $modulos_financieros->SortUrl($modulos_financieros->id_modulo_financiero) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $modulos_financieros->id_modulo_financiero->FldCaption() ?></td><td style="width: 10px;"><?php if ($modulos_financieros->id_modulo_financiero->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($modulos_financieros->id_modulo_financiero->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($modulos_financieros->plantilla->Visible) { // plantilla ?>
	<?php if ($modulos_financieros->SortUrl($modulos_financieros->plantilla) == "") { ?>
		<td><?php echo $modulos_financieros->plantilla->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $modulos_financieros->SortUrl($modulos_financieros->plantilla) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $modulos_financieros->plantilla->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($modulos_financieros->plantilla->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($modulos_financieros->plantilla->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($modulos_financieros->nombre->Visible) { // nombre ?>
	<?php if ($modulos_financieros->SortUrl($modulos_financieros->nombre) == "") { ?>
		<td><?php echo $modulos_financieros->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $modulos_financieros->SortUrl($modulos_financieros->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $modulos_financieros->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($modulos_financieros->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($modulos_financieros->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($modulos_financieros->estatus->Visible) { // estatus ?>
	<?php if ($modulos_financieros->SortUrl($modulos_financieros->estatus) == "") { ?>
		<td><?php echo $modulos_financieros->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $modulos_financieros->SortUrl($modulos_financieros->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $modulos_financieros->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($modulos_financieros->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($modulos_financieros->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($modulos_financieros->orden->Visible) { // orden ?>
	<?php if ($modulos_financieros->SortUrl($modulos_financieros->orden) == "") { ?>
		<td><?php echo $modulos_financieros->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $modulos_financieros->SortUrl($modulos_financieros->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $modulos_financieros->orden->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($modulos_financieros->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($modulos_financieros->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$modulos_financieros_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($modulos_financieros->ExportAll && $modulos_financieros->Export <> "") {
	$modulos_financieros_list->StopRec = $modulos_financieros_list->TotalRecs;
} else {

	// Set the last record to display
	if ($modulos_financieros_list->TotalRecs > $modulos_financieros_list->StartRec + $modulos_financieros_list->DisplayRecs - 1)
		$modulos_financieros_list->StopRec = $modulos_financieros_list->StartRec + $modulos_financieros_list->DisplayRecs - 1;
	else
		$modulos_financieros_list->StopRec = $modulos_financieros_list->TotalRecs;
}
$modulos_financieros_list->RecCnt = $modulos_financieros_list->StartRec - 1;
if ($modulos_financieros_list->Recordset && !$modulos_financieros_list->Recordset->EOF) {
	$modulos_financieros_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $modulos_financieros_list->StartRec > 1)
		$modulos_financieros_list->Recordset->Move($modulos_financieros_list->StartRec - 1);
} elseif (!$modulos_financieros->AllowAddDeleteRow && $modulos_financieros_list->StopRec == 0) {
	$modulos_financieros_list->StopRec = $modulos_financieros->GridAddRowCount;
}

// Initialize aggregate
$modulos_financieros->RowType = EW_ROWTYPE_AGGREGATEINIT;
$modulos_financieros->ResetAttrs();
$modulos_financieros_list->RenderRow();
$modulos_financieros_list->RowCnt = 0;
while ($modulos_financieros_list->RecCnt < $modulos_financieros_list->StopRec) {
	$modulos_financieros_list->RecCnt++;
	if (intval($modulos_financieros_list->RecCnt) >= intval($modulos_financieros_list->StartRec)) {
		$modulos_financieros_list->RowCnt++;

		// Set up key count
		$modulos_financieros_list->KeyCount = $modulos_financieros_list->RowIndex;

		// Init row class and style
		$modulos_financieros->ResetAttrs();
		$modulos_financieros->CssClass = "";
		if ($modulos_financieros->CurrentAction == "gridadd") {
		} else {
			$modulos_financieros_list->LoadRowValues($modulos_financieros_list->Recordset); // Load row values
		}
		$modulos_financieros->RowType = EW_ROWTYPE_VIEW; // Render view
		$modulos_financieros->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$modulos_financieros_list->RenderRow();

		// Render list options
		$modulos_financieros_list->RenderListOptions();
?>
	<tr<?php echo $modulos_financieros->RowAttributes() ?>>
<?php

// Render list options (body, left)
$modulos_financieros_list->ListOptions->Render("body", "left");
?>
	<?php if ($modulos_financieros->id_modulo_financiero->Visible) { // id_modulo_financiero ?>
		<td<?php echo $modulos_financieros->id_modulo_financiero->CellAttributes() ?>>
<div<?php echo $modulos_financieros->id_modulo_financiero->ViewAttributes() ?>><?php echo $modulos_financieros->id_modulo_financiero->ListViewValue() ?></div>
<a name="<?php echo $modulos_financieros_list->PageObjName . "_row_" . $modulos_financieros_list->RowCnt ?>" id="<?php echo $modulos_financieros_list->PageObjName . "_row_" . $modulos_financieros_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($modulos_financieros->plantilla->Visible) { // plantilla ?>
		<td<?php echo $modulos_financieros->plantilla->CellAttributes() ?>>
<div<?php echo $modulos_financieros->plantilla->ViewAttributes() ?>><?php echo $modulos_financieros->plantilla->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($modulos_financieros->nombre->Visible) { // nombre ?>
		<td<?php echo $modulos_financieros->nombre->CellAttributes() ?>>
<div<?php echo $modulos_financieros->nombre->ViewAttributes() ?>><?php echo $modulos_financieros->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($modulos_financieros->estatus->Visible) { // estatus ?>
		<td<?php echo $modulos_financieros->estatus->CellAttributes() ?>>
<div<?php echo $modulos_financieros->estatus->ViewAttributes() ?>><?php echo $modulos_financieros->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($modulos_financieros->orden->Visible) { // orden ?>
		<td<?php echo $modulos_financieros->orden->CellAttributes() ?>>
<div<?php echo $modulos_financieros->orden->ViewAttributes() ?>><?php echo $modulos_financieros->orden->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$modulos_financieros_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($modulos_financieros->CurrentAction <> "gridadd")
		$modulos_financieros_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($modulos_financieros_list->Recordset)
	$modulos_financieros_list->Recordset->Close();
?>
<?php if ($modulos_financieros->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($modulos_financieros->CurrentAction <> "gridadd" && $modulos_financieros->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($modulos_financieros_list->Pager)) $modulos_financieros_list->Pager = new cPrevNextPager($modulos_financieros_list->StartRec, $modulos_financieros_list->DisplayRecs, $modulos_financieros_list->TotalRecs) ?>
<?php if ($modulos_financieros_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($modulos_financieros_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $modulos_financieros_list->PageUrl() ?>start=<?php echo $modulos_financieros_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($modulos_financieros_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $modulos_financieros_list->PageUrl() ?>start=<?php echo $modulos_financieros_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $modulos_financieros_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($modulos_financieros_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $modulos_financieros_list->PageUrl() ?>start=<?php echo $modulos_financieros_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($modulos_financieros_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $modulos_financieros_list->PageUrl() ?>start=<?php echo $modulos_financieros_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $modulos_financieros_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $modulos_financieros_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $modulos_financieros_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $modulos_financieros_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($modulos_financieros_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $modulos_financieros_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($modulos_financieros->Export == "" && $modulos_financieros->CurrentAction == "") { ?>
<?php } ?>
<?php
$modulos_financieros_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($modulos_financieros->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$modulos_financieros_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodulos_financieros_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'modulos_financieros';

	// Page object name
	var $PageObjName = 'modulos_financieros_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $modulos_financieros;
		if ($modulos_financieros->UseTokenInUrl) $PageUrl .= "t=" . $modulos_financieros->TableVar . "&"; // Add page token
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
		global $objForm, $modulos_financieros;
		if ($modulos_financieros->UseTokenInUrl) {
			if ($objForm)
				return ($modulos_financieros->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($modulos_financieros->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodulos_financieros_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (modulos_financieros)
		if (!isset($GLOBALS["modulos_financieros"])) {
			$GLOBALS["modulos_financieros"] = new cmodulos_financieros();
			$GLOBALS["Table"] =& $GLOBALS["modulos_financieros"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "modulos_financierosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "modulos_financierosdelete.php";
		$this->MultiUpdateUrl = "modulos_financierosupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'modulos_financieros', TRUE);

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
		global $modulos_financieros;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$modulos_financieros->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $modulos_financieros;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($modulos_financieros->Export <> "" ||
				$modulos_financieros->CurrentAction == "gridadd" ||
				$modulos_financieros->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$modulos_financieros->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($modulos_financieros->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $modulos_financieros->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$modulos_financieros->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$modulos_financieros->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$modulos_financieros->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $modulos_financieros->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$modulos_financieros->setSessionWhere($sFilter);
		$modulos_financieros->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $modulos_financieros;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $modulos_financieros->plantilla, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $modulos_financieros->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $modulos_financieros->orden, $Keyword);
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
		global $Security, $modulos_financieros;
		$sSearchStr = "";
		$sSearchKeyword = $modulos_financieros->BasicSearchKeyword;
		$sSearchType = $modulos_financieros->BasicSearchType;
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
			$modulos_financieros->setSessionBasicSearchKeyword($sSearchKeyword);
			$modulos_financieros->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $modulos_financieros;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$modulos_financieros->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $modulos_financieros;
		$modulos_financieros->setSessionBasicSearchKeyword("");
		$modulos_financieros->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $modulos_financieros;
		$bRestore = TRUE;
		if ($modulos_financieros->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$modulos_financieros->BasicSearchKeyword = $modulos_financieros->getSessionBasicSearchKeyword();
			$modulos_financieros->BasicSearchType = $modulos_financieros->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $modulos_financieros;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$modulos_financieros->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$modulos_financieros->CurrentOrderType = @$_GET["ordertype"];
			$modulos_financieros->UpdateSort($modulos_financieros->id_modulo_financiero); // id_modulo_financiero
			$modulos_financieros->UpdateSort($modulos_financieros->plantilla); // plantilla
			$modulos_financieros->UpdateSort($modulos_financieros->nombre); // nombre
			$modulos_financieros->UpdateSort($modulos_financieros->estatus); // estatus
			$modulos_financieros->UpdateSort($modulos_financieros->orden); // orden
			$modulos_financieros->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $modulos_financieros;
		$sOrderBy = $modulos_financieros->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($modulos_financieros->SqlOrderBy() <> "") {
				$sOrderBy = $modulos_financieros->SqlOrderBy();
				$modulos_financieros->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $modulos_financieros;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$modulos_financieros->setSessionOrderBy($sOrderBy);
				$modulos_financieros->id_modulo_financiero->setSort("");
				$modulos_financieros->plantilla->setSort("");
				$modulos_financieros->nombre->setSort("");
				$modulos_financieros->estatus->setSort("");
				$modulos_financieros->orden->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$modulos_financieros->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $modulos_financieros;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $modulos_financieros, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $modulos_financieros;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $modulos_financieros;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$modulos_financieros->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$modulos_financieros->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $modulos_financieros->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$modulos_financieros->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$modulos_financieros->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$modulos_financieros->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $modulos_financieros;
		$modulos_financieros->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$modulos_financieros->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $modulos_financieros;

		// Call Recordset Selecting event
		$modulos_financieros->Recordset_Selecting($modulos_financieros->CurrentFilter);

		// Load List page SQL
		$sSql = $modulos_financieros->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$modulos_financieros->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $modulos_financieros;
		$sFilter = $modulos_financieros->KeyFilter();

		// Call Row Selecting event
		$modulos_financieros->Row_Selecting($sFilter);

		// Load SQL based on filter
		$modulos_financieros->CurrentFilter = $sFilter;
		$sSql = $modulos_financieros->SQL();
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
		global $conn, $modulos_financieros;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$modulos_financieros->Row_Selected($row);
		$modulos_financieros->id_modulo_financiero->setDbValue($rs->fields('id_modulo_financiero'));
		$modulos_financieros->plantilla->setDbValue($rs->fields('plantilla'));
		$modulos_financieros->nombre->setDbValue($rs->fields('nombre'));
		$modulos_financieros->estatus->setDbValue($rs->fields('estatus'));
		$modulos_financieros->orden->setDbValue($rs->fields('orden'));
	}

	// Load old record
	function LoadOldRecord() {
		global $modulos_financieros;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($modulos_financieros->getKey("id_modulo_financiero")) <> "")
			$modulos_financieros->id_modulo_financiero->CurrentValue = $modulos_financieros->getKey("id_modulo_financiero"); // id_modulo_financiero
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$modulos_financieros->CurrentFilter = $modulos_financieros->KeyFilter();
			$sSql = $modulos_financieros->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $modulos_financieros;

		// Initialize URLs
		$this->ViewUrl = $modulos_financieros->ViewUrl();
		$this->EditUrl = $modulos_financieros->EditUrl();
		$this->InlineEditUrl = $modulos_financieros->InlineEditUrl();
		$this->CopyUrl = $modulos_financieros->CopyUrl();
		$this->InlineCopyUrl = $modulos_financieros->InlineCopyUrl();
		$this->DeleteUrl = $modulos_financieros->DeleteUrl();

		// Call Row_Rendering event
		$modulos_financieros->Row_Rendering();

		// Common render codes for all row types
		// id_modulo_financiero
		// plantilla
		// nombre
		// estatus
		// orden

		if ($modulos_financieros->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_modulo_financiero
			$modulos_financieros->id_modulo_financiero->ViewValue = $modulos_financieros->id_modulo_financiero->CurrentValue;
			$modulos_financieros->id_modulo_financiero->ViewCustomAttributes = "";

			// plantilla
			$modulos_financieros->plantilla->ViewValue = $modulos_financieros->plantilla->CurrentValue;
			$modulos_financieros->plantilla->ViewCustomAttributes = "";

			// nombre
			$modulos_financieros->nombre->ViewValue = $modulos_financieros->nombre->CurrentValue;
			$modulos_financieros->nombre->ViewCustomAttributes = "";

			// estatus
			$modulos_financieros->estatus->ViewValue = $modulos_financieros->estatus->CurrentValue;
			$modulos_financieros->estatus->ViewCustomAttributes = "";

			// orden
			$modulos_financieros->orden->ViewValue = $modulos_financieros->orden->CurrentValue;
			$modulos_financieros->orden->ViewCustomAttributes = "";

			// id_modulo_financiero
			$modulos_financieros->id_modulo_financiero->LinkCustomAttributes = "";
			$modulos_financieros->id_modulo_financiero->HrefValue = "";
			$modulos_financieros->id_modulo_financiero->TooltipValue = "";

			// plantilla
			$modulos_financieros->plantilla->LinkCustomAttributes = "";
			$modulos_financieros->plantilla->HrefValue = "";
			$modulos_financieros->plantilla->TooltipValue = "";

			// nombre
			$modulos_financieros->nombre->LinkCustomAttributes = "";
			$modulos_financieros->nombre->HrefValue = "";
			$modulos_financieros->nombre->TooltipValue = "";

			// estatus
			$modulos_financieros->estatus->LinkCustomAttributes = "";
			$modulos_financieros->estatus->HrefValue = "";
			$modulos_financieros->estatus->TooltipValue = "";

			// orden
			$modulos_financieros->orden->LinkCustomAttributes = "";
			$modulos_financieros->orden->HrefValue = "";
			$modulos_financieros->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($modulos_financieros->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$modulos_financieros->Row_Rendered();
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
