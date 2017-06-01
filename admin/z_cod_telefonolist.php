<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_cod_telefonoinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_cod_telefono_list = new cz_cod_telefono_list();
$Page =& $z_cod_telefono_list;

// Page init
$z_cod_telefono_list->Page_Init();

// Page main
$z_cod_telefono_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_cod_telefono->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_cod_telefono_list = new ew_Page("z_cod_telefono_list");

// page properties
z_cod_telefono_list.PageID = "list"; // page ID
z_cod_telefono_list.FormID = "fz_cod_telefonolist"; // form ID
var EW_PAGE_ID = z_cod_telefono_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_cod_telefono_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_cod_telefono_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_cod_telefono_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($z_cod_telefono->Export == "") || (EW_EXPORT_MASTER_RECORD && $z_cod_telefono->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$z_cod_telefono_list->TotalRecs = $z_cod_telefono->SelectRecordCount();
	} else {
		if ($z_cod_telefono_list->Recordset = $z_cod_telefono_list->LoadRecordset())
			$z_cod_telefono_list->TotalRecs = $z_cod_telefono_list->Recordset->RecordCount();
	}
	$z_cod_telefono_list->StartRec = 1;
	if ($z_cod_telefono_list->DisplayRecs <= 0 || ($z_cod_telefono->Export <> "" && $z_cod_telefono->ExportAll)) // Display all records
		$z_cod_telefono_list->DisplayRecs = $z_cod_telefono_list->TotalRecs;
	if (!($z_cod_telefono->Export <> "" && $z_cod_telefono->ExportAll))
		$z_cod_telefono_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$z_cod_telefono_list->Recordset = $z_cod_telefono_list->LoadRecordset($z_cod_telefono_list->StartRec-1, $z_cod_telefono_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_cod_telefono->TableCaption() ?>
&nbsp;&nbsp;<?php $z_cod_telefono_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_cod_telefono->Export == "" && $z_cod_telefono->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(z_cod_telefono_list);" style="text-decoration: none;"><img id="z_cod_telefono_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="z_cod_telefono_list_SearchPanel">
<form name="fz_cod_telefonolistsrch" id="fz_cod_telefonolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="z_cod_telefono">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($z_cod_telefono->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $z_cod_telefono_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($z_cod_telefono->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($z_cod_telefono->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($z_cod_telefono->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $z_cod_telefono_list->ShowPageHeader(); ?>
<?php
$z_cod_telefono_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fz_cod_telefonolist" id="fz_cod_telefonolist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="z_cod_telefono">
<div id="gmp_z_cod_telefono" class="ewGridMiddlePanel">
<?php if ($z_cod_telefono_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $z_cod_telefono->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$z_cod_telefono_list->RenderListOptions();

// Render list options (header, left)
$z_cod_telefono_list->ListOptions->Render("header", "left");
?>
<?php if ($z_cod_telefono->id_cod_telefono->Visible) { // id_cod_telefono ?>
	<?php if ($z_cod_telefono->SortUrl($z_cod_telefono->id_cod_telefono) == "") { ?>
		<td><?php echo $z_cod_telefono->id_cod_telefono->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_cod_telefono->SortUrl($z_cod_telefono->id_cod_telefono) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_cod_telefono->id_cod_telefono->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_cod_telefono->id_cod_telefono->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_cod_telefono->id_cod_telefono->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_cod_telefono->codigo->Visible) { // codigo ?>
	<?php if ($z_cod_telefono->SortUrl($z_cod_telefono->codigo) == "") { ?>
		<td><?php echo $z_cod_telefono->codigo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_cod_telefono->SortUrl($z_cod_telefono->codigo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_cod_telefono->codigo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($z_cod_telefono->codigo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_cod_telefono->codigo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_cod_telefono->cod_cel->Visible) { // cod_cel ?>
	<?php if ($z_cod_telefono->SortUrl($z_cod_telefono->cod_cel) == "") { ?>
		<td><?php echo $z_cod_telefono->cod_cel->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_cod_telefono->SortUrl($z_cod_telefono->cod_cel) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_cod_telefono->cod_cel->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_cod_telefono->cod_cel->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_cod_telefono->cod_cel->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_cod_telefono->visibilidad->Visible) { // visibilidad ?>
	<?php if ($z_cod_telefono->SortUrl($z_cod_telefono->visibilidad) == "") { ?>
		<td><?php echo $z_cod_telefono->visibilidad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_cod_telefono->SortUrl($z_cod_telefono->visibilidad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_cod_telefono->visibilidad->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_cod_telefono->visibilidad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_cod_telefono->visibilidad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_cod_telefono->descripcion->Visible) { // descripcion ?>
	<?php if ($z_cod_telefono->SortUrl($z_cod_telefono->descripcion) == "") { ?>
		<td><?php echo $z_cod_telefono->descripcion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_cod_telefono->SortUrl($z_cod_telefono->descripcion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_cod_telefono->descripcion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($z_cod_telefono->descripcion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_cod_telefono->descripcion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$z_cod_telefono_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($z_cod_telefono->ExportAll && $z_cod_telefono->Export <> "") {
	$z_cod_telefono_list->StopRec = $z_cod_telefono_list->TotalRecs;
} else {

	// Set the last record to display
	if ($z_cod_telefono_list->TotalRecs > $z_cod_telefono_list->StartRec + $z_cod_telefono_list->DisplayRecs - 1)
		$z_cod_telefono_list->StopRec = $z_cod_telefono_list->StartRec + $z_cod_telefono_list->DisplayRecs - 1;
	else
		$z_cod_telefono_list->StopRec = $z_cod_telefono_list->TotalRecs;
}
$z_cod_telefono_list->RecCnt = $z_cod_telefono_list->StartRec - 1;
if ($z_cod_telefono_list->Recordset && !$z_cod_telefono_list->Recordset->EOF) {
	$z_cod_telefono_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $z_cod_telefono_list->StartRec > 1)
		$z_cod_telefono_list->Recordset->Move($z_cod_telefono_list->StartRec - 1);
} elseif (!$z_cod_telefono->AllowAddDeleteRow && $z_cod_telefono_list->StopRec == 0) {
	$z_cod_telefono_list->StopRec = $z_cod_telefono->GridAddRowCount;
}

// Initialize aggregate
$z_cod_telefono->RowType = EW_ROWTYPE_AGGREGATEINIT;
$z_cod_telefono->ResetAttrs();
$z_cod_telefono_list->RenderRow();
$z_cod_telefono_list->RowCnt = 0;
while ($z_cod_telefono_list->RecCnt < $z_cod_telefono_list->StopRec) {
	$z_cod_telefono_list->RecCnt++;
	if (intval($z_cod_telefono_list->RecCnt) >= intval($z_cod_telefono_list->StartRec)) {
		$z_cod_telefono_list->RowCnt++;

		// Set up key count
		$z_cod_telefono_list->KeyCount = $z_cod_telefono_list->RowIndex;

		// Init row class and style
		$z_cod_telefono->ResetAttrs();
		$z_cod_telefono->CssClass = "";
		if ($z_cod_telefono->CurrentAction == "gridadd") {
		} else {
			$z_cod_telefono_list->LoadRowValues($z_cod_telefono_list->Recordset); // Load row values
		}
		$z_cod_telefono->RowType = EW_ROWTYPE_VIEW; // Render view
		$z_cod_telefono->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$z_cod_telefono_list->RenderRow();

		// Render list options
		$z_cod_telefono_list->RenderListOptions();
?>
	<tr<?php echo $z_cod_telefono->RowAttributes() ?>>
<?php

// Render list options (body, left)
$z_cod_telefono_list->ListOptions->Render("body", "left");
?>
	<?php if ($z_cod_telefono->id_cod_telefono->Visible) { // id_cod_telefono ?>
		<td<?php echo $z_cod_telefono->id_cod_telefono->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->id_cod_telefono->ViewAttributes() ?>><?php echo $z_cod_telefono->id_cod_telefono->ListViewValue() ?></div>
<a name="<?php echo $z_cod_telefono_list->PageObjName . "_row_" . $z_cod_telefono_list->RowCnt ?>" id="<?php echo $z_cod_telefono_list->PageObjName . "_row_" . $z_cod_telefono_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($z_cod_telefono->codigo->Visible) { // codigo ?>
		<td<?php echo $z_cod_telefono->codigo->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->codigo->ViewAttributes() ?>><?php echo $z_cod_telefono->codigo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_cod_telefono->cod_cel->Visible) { // cod_cel ?>
		<td<?php echo $z_cod_telefono->cod_cel->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->cod_cel->ViewAttributes() ?>><?php echo $z_cod_telefono->cod_cel->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_cod_telefono->visibilidad->Visible) { // visibilidad ?>
		<td<?php echo $z_cod_telefono->visibilidad->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->visibilidad->ViewAttributes() ?>><?php echo $z_cod_telefono->visibilidad->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_cod_telefono->descripcion->Visible) { // descripcion ?>
		<td<?php echo $z_cod_telefono->descripcion->CellAttributes() ?>>
<div<?php echo $z_cod_telefono->descripcion->ViewAttributes() ?>><?php echo $z_cod_telefono->descripcion->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$z_cod_telefono_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($z_cod_telefono->CurrentAction <> "gridadd")
		$z_cod_telefono_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($z_cod_telefono_list->Recordset)
	$z_cod_telefono_list->Recordset->Close();
?>
<?php if ($z_cod_telefono->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($z_cod_telefono->CurrentAction <> "gridadd" && $z_cod_telefono->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($z_cod_telefono_list->Pager)) $z_cod_telefono_list->Pager = new cPrevNextPager($z_cod_telefono_list->StartRec, $z_cod_telefono_list->DisplayRecs, $z_cod_telefono_list->TotalRecs) ?>
<?php if ($z_cod_telefono_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($z_cod_telefono_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $z_cod_telefono_list->PageUrl() ?>start=<?php echo $z_cod_telefono_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($z_cod_telefono_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $z_cod_telefono_list->PageUrl() ?>start=<?php echo $z_cod_telefono_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $z_cod_telefono_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($z_cod_telefono_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $z_cod_telefono_list->PageUrl() ?>start=<?php echo $z_cod_telefono_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($z_cod_telefono_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $z_cod_telefono_list->PageUrl() ?>start=<?php echo $z_cod_telefono_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $z_cod_telefono_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $z_cod_telefono_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $z_cod_telefono_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $z_cod_telefono_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($z_cod_telefono_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $z_cod_telefono_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($z_cod_telefono->Export == "" && $z_cod_telefono->CurrentAction == "") { ?>
<?php } ?>
<?php
$z_cod_telefono_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_cod_telefono->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_cod_telefono_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_cod_telefono_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = '_cod_telefono';

	// Page object name
	var $PageObjName = 'z_cod_telefono_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_cod_telefono;
		if ($z_cod_telefono->UseTokenInUrl) $PageUrl .= "t=" . $z_cod_telefono->TableVar . "&"; // Add page token
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
		global $objForm, $z_cod_telefono;
		if ($z_cod_telefono->UseTokenInUrl) {
			if ($objForm)
				return ($z_cod_telefono->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_cod_telefono->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_cod_telefono_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_cod_telefono)
		if (!isset($GLOBALS["z_cod_telefono"])) {
			$GLOBALS["z_cod_telefono"] = new cz_cod_telefono();
			$GLOBALS["Table"] =& $GLOBALS["z_cod_telefono"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "z_cod_telefonoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "z_cod_telefonodelete.php";
		$this->MultiUpdateUrl = "z_cod_telefonoupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_cod_telefono', TRUE);

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
		global $z_cod_telefono;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$z_cod_telefono->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $z_cod_telefono;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($z_cod_telefono->Export <> "" ||
				$z_cod_telefono->CurrentAction == "gridadd" ||
				$z_cod_telefono->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$z_cod_telefono->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($z_cod_telefono->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $z_cod_telefono->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$z_cod_telefono->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$z_cod_telefono->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$z_cod_telefono->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $z_cod_telefono->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$z_cod_telefono->setSessionWhere($sFilter);
		$z_cod_telefono->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $z_cod_telefono;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $z_cod_telefono->codigo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $z_cod_telefono->descripcion, $Keyword);
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
		global $Security, $z_cod_telefono;
		$sSearchStr = "";
		$sSearchKeyword = $z_cod_telefono->BasicSearchKeyword;
		$sSearchType = $z_cod_telefono->BasicSearchType;
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
			$z_cod_telefono->setSessionBasicSearchKeyword($sSearchKeyword);
			$z_cod_telefono->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $z_cod_telefono;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$z_cod_telefono->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $z_cod_telefono;
		$z_cod_telefono->setSessionBasicSearchKeyword("");
		$z_cod_telefono->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $z_cod_telefono;
		$bRestore = TRUE;
		if ($z_cod_telefono->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$z_cod_telefono->BasicSearchKeyword = $z_cod_telefono->getSessionBasicSearchKeyword();
			$z_cod_telefono->BasicSearchType = $z_cod_telefono->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $z_cod_telefono;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$z_cod_telefono->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$z_cod_telefono->CurrentOrderType = @$_GET["ordertype"];
			$z_cod_telefono->UpdateSort($z_cod_telefono->id_cod_telefono); // id_cod_telefono
			$z_cod_telefono->UpdateSort($z_cod_telefono->codigo); // codigo
			$z_cod_telefono->UpdateSort($z_cod_telefono->cod_cel); // cod_cel
			$z_cod_telefono->UpdateSort($z_cod_telefono->visibilidad); // visibilidad
			$z_cod_telefono->UpdateSort($z_cod_telefono->descripcion); // descripcion
			$z_cod_telefono->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $z_cod_telefono;
		$sOrderBy = $z_cod_telefono->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($z_cod_telefono->SqlOrderBy() <> "") {
				$sOrderBy = $z_cod_telefono->SqlOrderBy();
				$z_cod_telefono->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $z_cod_telefono;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$z_cod_telefono->setSessionOrderBy($sOrderBy);
				$z_cod_telefono->id_cod_telefono->setSort("");
				$z_cod_telefono->codigo->setSort("");
				$z_cod_telefono->cod_cel->setSort("");
				$z_cod_telefono->visibilidad->setSort("");
				$z_cod_telefono->descripcion->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$z_cod_telefono->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $z_cod_telefono;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $z_cod_telefono, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $z_cod_telefono;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_cod_telefono;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_cod_telefono->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_cod_telefono->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_cod_telefono->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_cod_telefono->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_cod_telefono->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_cod_telefono->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $z_cod_telefono;
		$z_cod_telefono->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$z_cod_telefono->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_cod_telefono;

		// Call Recordset Selecting event
		$z_cod_telefono->Recordset_Selecting($z_cod_telefono->CurrentFilter);

		// Load List page SQL
		$sSql = $z_cod_telefono->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_cod_telefono->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_cod_telefono;
		$sFilter = $z_cod_telefono->KeyFilter();

		// Call Row Selecting event
		$z_cod_telefono->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_cod_telefono->CurrentFilter = $sFilter;
		$sSql = $z_cod_telefono->SQL();
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
		global $conn, $z_cod_telefono;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_cod_telefono->Row_Selected($row);
		$z_cod_telefono->id_cod_telefono->setDbValue($rs->fields('id_cod_telefono'));
		$z_cod_telefono->codigo->setDbValue($rs->fields('codigo'));
		$z_cod_telefono->cod_cel->setDbValue($rs->fields('cod_cel'));
		$z_cod_telefono->visibilidad->setDbValue($rs->fields('visibilidad'));
		$z_cod_telefono->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Load old record
	function LoadOldRecord() {
		global $z_cod_telefono;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($z_cod_telefono->getKey("id_cod_telefono")) <> "")
			$z_cod_telefono->id_cod_telefono->CurrentValue = $z_cod_telefono->getKey("id_cod_telefono"); // id_cod_telefono
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$z_cod_telefono->CurrentFilter = $z_cod_telefono->KeyFilter();
			$sSql = $z_cod_telefono->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_cod_telefono;

		// Initialize URLs
		$this->ViewUrl = $z_cod_telefono->ViewUrl();
		$this->EditUrl = $z_cod_telefono->EditUrl();
		$this->InlineEditUrl = $z_cod_telefono->InlineEditUrl();
		$this->CopyUrl = $z_cod_telefono->CopyUrl();
		$this->InlineCopyUrl = $z_cod_telefono->InlineCopyUrl();
		$this->DeleteUrl = $z_cod_telefono->DeleteUrl();

		// Call Row_Rendering event
		$z_cod_telefono->Row_Rendering();

		// Common render codes for all row types
		// id_cod_telefono
		// codigo
		// cod_cel
		// visibilidad
		// descripcion

		if ($z_cod_telefono->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_cod_telefono
			$z_cod_telefono->id_cod_telefono->ViewValue = $z_cod_telefono->id_cod_telefono->CurrentValue;
			$z_cod_telefono->id_cod_telefono->ViewCustomAttributes = "";

			// codigo
			$z_cod_telefono->codigo->ViewValue = $z_cod_telefono->codigo->CurrentValue;
			$z_cod_telefono->codigo->ViewCustomAttributes = "";

			// cod_cel
			$z_cod_telefono->cod_cel->ViewValue = $z_cod_telefono->cod_cel->CurrentValue;
			$z_cod_telefono->cod_cel->ViewCustomAttributes = "";

			// visibilidad
			$z_cod_telefono->visibilidad->ViewValue = $z_cod_telefono->visibilidad->CurrentValue;
			$z_cod_telefono->visibilidad->ViewCustomAttributes = "";

			// descripcion
			$z_cod_telefono->descripcion->ViewValue = $z_cod_telefono->descripcion->CurrentValue;
			$z_cod_telefono->descripcion->ViewCustomAttributes = "";

			// id_cod_telefono
			$z_cod_telefono->id_cod_telefono->LinkCustomAttributes = "";
			$z_cod_telefono->id_cod_telefono->HrefValue = "";
			$z_cod_telefono->id_cod_telefono->TooltipValue = "";

			// codigo
			$z_cod_telefono->codigo->LinkCustomAttributes = "";
			$z_cod_telefono->codigo->HrefValue = "";
			$z_cod_telefono->codigo->TooltipValue = "";

			// cod_cel
			$z_cod_telefono->cod_cel->LinkCustomAttributes = "";
			$z_cod_telefono->cod_cel->HrefValue = "";
			$z_cod_telefono->cod_cel->TooltipValue = "";

			// visibilidad
			$z_cod_telefono->visibilidad->LinkCustomAttributes = "";
			$z_cod_telefono->visibilidad->HrefValue = "";
			$z_cod_telefono->visibilidad->TooltipValue = "";

			// descripcion
			$z_cod_telefono->descripcion->LinkCustomAttributes = "";
			$z_cod_telefono->descripcion->HrefValue = "";
			$z_cod_telefono->descripcion->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_cod_telefono->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_cod_telefono->Row_Rendered();
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
