<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "seccionesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$secciones_list = new csecciones_list();
$Page =& $secciones_list;

// Page init
$secciones_list->Page_Init();

// Page main
$secciones_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($secciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var secciones_list = new ew_Page("secciones_list");

// page properties
secciones_list.PageID = "list"; // page ID
secciones_list.FormID = "fseccioneslist"; // form ID
var EW_PAGE_ID = secciones_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
secciones_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
secciones_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
secciones_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($secciones->Export == "") || (EW_EXPORT_MASTER_RECORD && $secciones->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$secciones_list->TotalRecs = $secciones->SelectRecordCount();
	} else {
		if ($secciones_list->Recordset = $secciones_list->LoadRecordset())
			$secciones_list->TotalRecs = $secciones_list->Recordset->RecordCount();
	}
	$secciones_list->StartRec = 1;
	if ($secciones_list->DisplayRecs <= 0 || ($secciones->Export <> "" && $secciones->ExportAll)) // Display all records
		$secciones_list->DisplayRecs = $secciones_list->TotalRecs;
	if (!($secciones->Export <> "" && $secciones->ExportAll))
		$secciones_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$secciones_list->Recordset = $secciones_list->LoadRecordset($secciones_list->StartRec-1, $secciones_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $secciones->TableCaption() ?>
&nbsp;&nbsp;<?php $secciones_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($secciones->Export == "" && $secciones->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(secciones_list);" style="text-decoration: none;"><img id="secciones_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="secciones_list_SearchPanel">
<form name="fseccioneslistsrch" id="fseccioneslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="secciones">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($secciones->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $secciones_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($secciones->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($secciones->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($secciones->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $secciones_list->ShowPageHeader(); ?>
<?php
$secciones_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fseccioneslist" id="fseccioneslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="secciones">
<div id="gmp_secciones" class="ewGridMiddlePanel">
<?php if ($secciones_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $secciones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$secciones_list->RenderListOptions();

// Render list options (header, left)
$secciones_list->ListOptions->Render("header", "left");
?>
<?php if ($secciones->id_seccion->Visible) { // id_seccion ?>
	<?php if ($secciones->SortUrl($secciones->id_seccion) == "") { ?>
		<td><?php echo $secciones->id_seccion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secciones->SortUrl($secciones->id_seccion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secciones->id_seccion->FldCaption() ?></td><td style="width: 10px;"><?php if ($secciones->id_seccion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secciones->id_seccion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secciones->imagen->Visible) { // imagen ?>
	<?php if ($secciones->SortUrl($secciones->imagen) == "") { ?>
		<td><?php echo $secciones->imagen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secciones->SortUrl($secciones->imagen) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secciones->imagen->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($secciones->imagen->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secciones->imagen->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secciones->estatus->Visible) { // estatus ?>
	<?php if ($secciones->SortUrl($secciones->estatus) == "") { ?>
		<td><?php echo $secciones->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secciones->SortUrl($secciones->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secciones->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($secciones->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secciones->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secciones->id_herramienta_financiera->Visible) { // id_herramienta_financiera ?>
	<?php if ($secciones->SortUrl($secciones->id_herramienta_financiera) == "") { ?>
		<td><?php echo $secciones->id_herramienta_financiera->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secciones->SortUrl($secciones->id_herramienta_financiera) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secciones->id_herramienta_financiera->FldCaption() ?></td><td style="width: 10px;"><?php if ($secciones->id_herramienta_financiera->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secciones->id_herramienta_financiera->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secciones->titulo->Visible) { // titulo ?>
	<?php if ($secciones->SortUrl($secciones->titulo) == "") { ?>
		<td><?php echo $secciones->titulo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secciones->SortUrl($secciones->titulo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secciones->titulo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($secciones->titulo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secciones->titulo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($secciones->imagen_interna->Visible) { // imagen_interna ?>
	<?php if ($secciones->SortUrl($secciones->imagen_interna) == "") { ?>
		<td><?php echo $secciones->imagen_interna->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $secciones->SortUrl($secciones->imagen_interna) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $secciones->imagen_interna->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($secciones->imagen_interna->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($secciones->imagen_interna->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$secciones_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($secciones->ExportAll && $secciones->Export <> "") {
	$secciones_list->StopRec = $secciones_list->TotalRecs;
} else {

	// Set the last record to display
	if ($secciones_list->TotalRecs > $secciones_list->StartRec + $secciones_list->DisplayRecs - 1)
		$secciones_list->StopRec = $secciones_list->StartRec + $secciones_list->DisplayRecs - 1;
	else
		$secciones_list->StopRec = $secciones_list->TotalRecs;
}
$secciones_list->RecCnt = $secciones_list->StartRec - 1;
if ($secciones_list->Recordset && !$secciones_list->Recordset->EOF) {
	$secciones_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $secciones_list->StartRec > 1)
		$secciones_list->Recordset->Move($secciones_list->StartRec - 1);
} elseif (!$secciones->AllowAddDeleteRow && $secciones_list->StopRec == 0) {
	$secciones_list->StopRec = $secciones->GridAddRowCount;
}

// Initialize aggregate
$secciones->RowType = EW_ROWTYPE_AGGREGATEINIT;
$secciones->ResetAttrs();
$secciones_list->RenderRow();
$secciones_list->RowCnt = 0;
while ($secciones_list->RecCnt < $secciones_list->StopRec) {
	$secciones_list->RecCnt++;
	if (intval($secciones_list->RecCnt) >= intval($secciones_list->StartRec)) {
		$secciones_list->RowCnt++;

		// Set up key count
		$secciones_list->KeyCount = $secciones_list->RowIndex;

		// Init row class and style
		$secciones->ResetAttrs();
		$secciones->CssClass = "";
		if ($secciones->CurrentAction == "gridadd") {
		} else {
			$secciones_list->LoadRowValues($secciones_list->Recordset); // Load row values
		}
		$secciones->RowType = EW_ROWTYPE_VIEW; // Render view
		$secciones->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$secciones_list->RenderRow();

		// Render list options
		$secciones_list->RenderListOptions();
?>
	<tr<?php echo $secciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$secciones_list->ListOptions->Render("body", "left");
?>
	<?php if ($secciones->id_seccion->Visible) { // id_seccion ?>
		<td<?php echo $secciones->id_seccion->CellAttributes() ?>>
<div<?php echo $secciones->id_seccion->ViewAttributes() ?>><?php echo $secciones->id_seccion->ListViewValue() ?></div>
<a name="<?php echo $secciones_list->PageObjName . "_row_" . $secciones_list->RowCnt ?>" id="<?php echo $secciones_list->PageObjName . "_row_" . $secciones_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($secciones->imagen->Visible) { // imagen ?>
		<td<?php echo $secciones->imagen->CellAttributes() ?>>
<div<?php echo $secciones->imagen->ViewAttributes() ?>><?php echo $secciones->imagen->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($secciones->estatus->Visible) { // estatus ?>
		<td<?php echo $secciones->estatus->CellAttributes() ?>>
<div<?php echo $secciones->estatus->ViewAttributes() ?>><?php echo $secciones->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($secciones->id_herramienta_financiera->Visible) { // id_herramienta_financiera ?>
		<td<?php echo $secciones->id_herramienta_financiera->CellAttributes() ?>>
<div<?php echo $secciones->id_herramienta_financiera->ViewAttributes() ?>><?php echo $secciones->id_herramienta_financiera->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($secciones->titulo->Visible) { // titulo ?>
		<td<?php echo $secciones->titulo->CellAttributes() ?>>
<div<?php echo $secciones->titulo->ViewAttributes() ?>><?php echo $secciones->titulo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($secciones->imagen_interna->Visible) { // imagen_interna ?>
		<td<?php echo $secciones->imagen_interna->CellAttributes() ?>>
<div<?php echo $secciones->imagen_interna->ViewAttributes() ?>><?php echo $secciones->imagen_interna->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$secciones_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($secciones->CurrentAction <> "gridadd")
		$secciones_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($secciones_list->Recordset)
	$secciones_list->Recordset->Close();
?>
<?php if ($secciones->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($secciones->CurrentAction <> "gridadd" && $secciones->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($secciones_list->Pager)) $secciones_list->Pager = new cPrevNextPager($secciones_list->StartRec, $secciones_list->DisplayRecs, $secciones_list->TotalRecs) ?>
<?php if ($secciones_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($secciones_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $secciones_list->PageUrl() ?>start=<?php echo $secciones_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($secciones_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $secciones_list->PageUrl() ?>start=<?php echo $secciones_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $secciones_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($secciones_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $secciones_list->PageUrl() ?>start=<?php echo $secciones_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($secciones_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $secciones_list->PageUrl() ?>start=<?php echo $secciones_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $secciones_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $secciones_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $secciones_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $secciones_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($secciones_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $secciones_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($secciones->Export == "" && $secciones->CurrentAction == "") { ?>
<?php } ?>
<?php
$secciones_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($secciones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$secciones_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csecciones_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'secciones';

	// Page object name
	var $PageObjName = 'secciones_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $secciones;
		if ($secciones->UseTokenInUrl) $PageUrl .= "t=" . $secciones->TableVar . "&"; // Add page token
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
		global $objForm, $secciones;
		if ($secciones->UseTokenInUrl) {
			if ($objForm)
				return ($secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csecciones_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (secciones)
		if (!isset($GLOBALS["secciones"])) {
			$GLOBALS["secciones"] = new csecciones();
			$GLOBALS["Table"] =& $GLOBALS["secciones"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "seccionesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "seccionesdelete.php";
		$this->MultiUpdateUrl = "seccionesupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'secciones', TRUE);

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
		global $secciones;

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
			$secciones->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $secciones;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($secciones->Export <> "" ||
				$secciones->CurrentAction == "gridadd" ||
				$secciones->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$secciones->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($secciones->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $secciones->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$secciones->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$secciones->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$secciones->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $secciones->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$secciones->setSessionWhere($sFilter);
		$secciones->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $secciones;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $secciones->imagen, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $secciones->contenido, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $secciones->resumen, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $secciones->titulo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $secciones->imagen_interna, $Keyword);
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
		global $Security, $secciones;
		$sSearchStr = "";
		$sSearchKeyword = $secciones->BasicSearchKeyword;
		$sSearchType = $secciones->BasicSearchType;
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
			$secciones->setSessionBasicSearchKeyword($sSearchKeyword);
			$secciones->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $secciones;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$secciones->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $secciones;
		$secciones->setSessionBasicSearchKeyword("");
		$secciones->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $secciones;
		$bRestore = TRUE;
		if ($secciones->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$secciones->BasicSearchKeyword = $secciones->getSessionBasicSearchKeyword();
			$secciones->BasicSearchType = $secciones->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $secciones;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$secciones->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$secciones->CurrentOrderType = @$_GET["ordertype"];
			$secciones->UpdateSort($secciones->id_seccion); // id_seccion
			$secciones->UpdateSort($secciones->imagen); // imagen
			$secciones->UpdateSort($secciones->estatus); // estatus
			$secciones->UpdateSort($secciones->id_herramienta_financiera); // id_herramienta_financiera
			$secciones->UpdateSort($secciones->titulo); // titulo
			$secciones->UpdateSort($secciones->imagen_interna); // imagen_interna
			$secciones->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $secciones;
		$sOrderBy = $secciones->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($secciones->SqlOrderBy() <> "") {
				$sOrderBy = $secciones->SqlOrderBy();
				$secciones->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $secciones;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$secciones->setSessionOrderBy($sOrderBy);
				$secciones->id_seccion->setSort("");
				$secciones->imagen->setSort("");
				$secciones->estatus->setSort("");
				$secciones->id_herramienta_financiera->setSort("");
				$secciones->titulo->setSort("");
				$secciones->imagen_interna->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $secciones;

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
		global $Security, $Language, $secciones, $objForm;
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
		global $Security, $Language, $secciones;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $secciones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$secciones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$secciones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $secciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$secciones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$secciones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $secciones;
		$secciones->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$secciones->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $secciones;

		// Call Recordset Selecting event
		$secciones->Recordset_Selecting($secciones->CurrentFilter);

		// Load List page SQL
		$sSql = $secciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$secciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $secciones;
		$sFilter = $secciones->KeyFilter();

		// Call Row Selecting event
		$secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$secciones->CurrentFilter = $sFilter;
		$sSql = $secciones->SQL();
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
		global $conn, $secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$secciones->Row_Selected($row);
		$secciones->id_seccion->setDbValue($rs->fields('id_seccion'));
		$secciones->imagen->setDbValue($rs->fields('imagen'));
		$secciones->contenido->setDbValue($rs->fields('contenido'));
		$secciones->resumen->setDbValue($rs->fields('resumen'));
		$secciones->estatus->setDbValue($rs->fields('estatus'));
		$secciones->id_herramienta_financiera->setDbValue($rs->fields('id_herramienta_financiera'));
		$secciones->titulo->setDbValue($rs->fields('titulo'));
		$secciones->imagen_interna->setDbValue($rs->fields('imagen_interna'));
	}

	// Load old record
	function LoadOldRecord() {
		global $secciones;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($secciones->getKey("id_seccion")) <> "")
			$secciones->id_seccion->CurrentValue = $secciones->getKey("id_seccion"); // id_seccion
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$secciones->CurrentFilter = $secciones->KeyFilter();
			$sSql = $secciones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $secciones;

		// Initialize URLs
		$this->ViewUrl = $secciones->ViewUrl();
		$this->EditUrl = $secciones->EditUrl();
		$this->InlineEditUrl = $secciones->InlineEditUrl();
		$this->CopyUrl = $secciones->CopyUrl();
		$this->InlineCopyUrl = $secciones->InlineCopyUrl();
		$this->DeleteUrl = $secciones->DeleteUrl();

		// Call Row_Rendering event
		$secciones->Row_Rendering();

		// Common render codes for all row types
		// id_seccion
		// imagen
		// contenido
		// resumen
		// estatus
		// id_herramienta_financiera
		// titulo
		// imagen_interna

		if ($secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_seccion
			$secciones->id_seccion->ViewValue = $secciones->id_seccion->CurrentValue;
			$secciones->id_seccion->ViewCustomAttributes = "";

			// imagen
			$secciones->imagen->ViewValue = $secciones->imagen->CurrentValue;
			$secciones->imagen->ViewCustomAttributes = "";

			// estatus
			$secciones->estatus->ViewValue = $secciones->estatus->CurrentValue;
			$secciones->estatus->ViewCustomAttributes = "";

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->ViewValue = $secciones->id_herramienta_financiera->CurrentValue;
			$secciones->id_herramienta_financiera->ViewCustomAttributes = "";

			// titulo
			$secciones->titulo->ViewValue = $secciones->titulo->CurrentValue;
			$secciones->titulo->ViewCustomAttributes = "";

			// imagen_interna
			$secciones->imagen_interna->ViewValue = $secciones->imagen_interna->CurrentValue;
			$secciones->imagen_interna->ViewCustomAttributes = "";

			// id_seccion
			$secciones->id_seccion->LinkCustomAttributes = "";
			$secciones->id_seccion->HrefValue = "";
			$secciones->id_seccion->TooltipValue = "";

			// imagen
			$secciones->imagen->LinkCustomAttributes = "";
			$secciones->imagen->HrefValue = "";
			$secciones->imagen->TooltipValue = "";

			// estatus
			$secciones->estatus->LinkCustomAttributes = "";
			$secciones->estatus->HrefValue = "";
			$secciones->estatus->TooltipValue = "";

			// id_herramienta_financiera
			$secciones->id_herramienta_financiera->LinkCustomAttributes = "";
			$secciones->id_herramienta_financiera->HrefValue = "";
			$secciones->id_herramienta_financiera->TooltipValue = "";

			// titulo
			$secciones->titulo->LinkCustomAttributes = "";
			$secciones->titulo->HrefValue = "";
			$secciones->titulo->TooltipValue = "";

			// imagen_interna
			$secciones->imagen_interna->LinkCustomAttributes = "";
			$secciones->imagen_interna->HrefValue = "";
			$secciones->imagen_interna->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$secciones->Row_Rendered();
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
