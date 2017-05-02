<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documentos_seccionesinfo.php" ?>
<?php include_once "documentosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documentos_secciones_list = new cdocumentos_secciones_list();
$Page =& $documentos_secciones_list;

// Page init
$documentos_secciones_list->Page_Init();

// Page main
$documentos_secciones_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($documentos_secciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_secciones_list = new ew_Page("documentos_secciones_list");

// page properties
documentos_secciones_list.PageID = "list"; // page ID
documentos_secciones_list.FormID = "fdocumentos_seccioneslist"; // form ID
var EW_PAGE_ID = documentos_secciones_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
documentos_secciones_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_secciones_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_secciones_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

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
<?php if (($documentos_secciones->Export == "") || (EW_EXPORT_MASTER_RECORD && $documentos_secciones->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "documentoslist.php";
if ($documentos_secciones_list->DbMasterFilter <> "" && $documentos_secciones->getCurrentMasterTable() == "documentos") {
	if ($documentos_secciones_list->MasterRecordExists) {
		if ($documentos_secciones->getCurrentMasterTable() == $documentos_secciones->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $documentos->TableCaption() ?>
&nbsp;&nbsp;<?php $documentos_secciones_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($documentos_secciones->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "documentosmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$documentos_secciones_list->TotalRecs = $documentos_secciones->SelectRecordCount();
	} else {
		if ($documentos_secciones_list->Recordset = $documentos_secciones_list->LoadRecordset())
			$documentos_secciones_list->TotalRecs = $documentos_secciones_list->Recordset->RecordCount();
	}
	$documentos_secciones_list->StartRec = 1;
	if ($documentos_secciones_list->DisplayRecs <= 0 || ($documentos_secciones->Export <> "" && $documentos_secciones->ExportAll)) // Display all records
		$documentos_secciones_list->DisplayRecs = $documentos_secciones_list->TotalRecs;
	if (!($documentos_secciones->Export <> "" && $documentos_secciones->ExportAll))
		$documentos_secciones_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$documentos_secciones_list->Recordset = $documentos_secciones_list->LoadRecordset($documentos_secciones_list->StartRec-1, $documentos_secciones_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos_secciones->TableCaption() ?>
<?php if ($documentos_secciones->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $documentos_secciones_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php $documentos_secciones_list->ShowPageHeader(); ?>
<?php
$documentos_secciones_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fdocumentos_seccioneslist" id="fdocumentos_seccioneslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="documentos_secciones">
<div id="gmp_documentos_secciones" class="ewGridMiddlePanel">
<?php if ($documentos_secciones_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $documentos_secciones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$documentos_secciones_list->RenderListOptions();

// Render list options (header, left)
$documentos_secciones_list->ListOptions->Render("header", "left");
?>
<?php if ($documentos_secciones->id_documentos->Visible) { // id_documentos ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->id_documentos) == "") { ?>
		<td><?php echo $documentos_secciones->id_documentos->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos_secciones->SortUrl($documentos_secciones->id_documentos) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->id_documentos->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->id_documentos->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->id_documentos->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->id_grupo_sec->Visible) { // id_grupo_sec ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->id_grupo_sec) == "") { ?>
		<td><?php echo $documentos_secciones->id_grupo_sec->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos_secciones->SortUrl($documentos_secciones->id_grupo_sec) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->id_grupo_sec->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->id_grupo_sec->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->id_grupo_sec->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->fecha_inicio->Visible) { // fecha_inicio ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->fecha_inicio) == "") { ?>
		<td><?php echo $documentos_secciones->fecha_inicio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos_secciones->SortUrl($documentos_secciones->fecha_inicio) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->fecha_inicio->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->fecha_inicio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->fecha_inicio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->fecha_fin->Visible) { // fecha_fin ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->fecha_fin) == "") { ?>
		<td><?php echo $documentos_secciones->fecha_fin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos_secciones->SortUrl($documentos_secciones->fecha_fin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->fecha_fin->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->fecha_fin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->fecha_fin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->fecha->Visible) { // fecha ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->fecha) == "") { ?>
		<td><?php echo $documentos_secciones->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos_secciones->SortUrl($documentos_secciones->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos_secciones->estatus->Visible) { // estatus ?>
	<?php if ($documentos_secciones->SortUrl($documentos_secciones->estatus) == "") { ?>
		<td><?php echo $documentos_secciones->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos_secciones->SortUrl($documentos_secciones->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos_secciones->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos_secciones->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos_secciones->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$documentos_secciones_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($documentos_secciones->ExportAll && $documentos_secciones->Export <> "") {
	$documentos_secciones_list->StopRec = $documentos_secciones_list->TotalRecs;
} else {

	// Set the last record to display
	if ($documentos_secciones_list->TotalRecs > $documentos_secciones_list->StartRec + $documentos_secciones_list->DisplayRecs - 1)
		$documentos_secciones_list->StopRec = $documentos_secciones_list->StartRec + $documentos_secciones_list->DisplayRecs - 1;
	else
		$documentos_secciones_list->StopRec = $documentos_secciones_list->TotalRecs;
}
$documentos_secciones_list->RecCnt = $documentos_secciones_list->StartRec - 1;
if ($documentos_secciones_list->Recordset && !$documentos_secciones_list->Recordset->EOF) {
	$documentos_secciones_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $documentos_secciones_list->StartRec > 1)
		$documentos_secciones_list->Recordset->Move($documentos_secciones_list->StartRec - 1);
} elseif (!$documentos_secciones->AllowAddDeleteRow && $documentos_secciones_list->StopRec == 0) {
	$documentos_secciones_list->StopRec = $documentos_secciones->GridAddRowCount;
}

// Initialize aggregate
$documentos_secciones->RowType = EW_ROWTYPE_AGGREGATEINIT;
$documentos_secciones->ResetAttrs();
$documentos_secciones_list->RenderRow();
$documentos_secciones_list->RowCnt = 0;
while ($documentos_secciones_list->RecCnt < $documentos_secciones_list->StopRec) {
	$documentos_secciones_list->RecCnt++;
	if (intval($documentos_secciones_list->RecCnt) >= intval($documentos_secciones_list->StartRec)) {
		$documentos_secciones_list->RowCnt++;

		// Set up key count
		$documentos_secciones_list->KeyCount = $documentos_secciones_list->RowIndex;

		// Init row class and style
		$documentos_secciones->ResetAttrs();
		$documentos_secciones->CssClass = "";
		if ($documentos_secciones->CurrentAction == "gridadd") {
		} else {
			$documentos_secciones_list->LoadRowValues($documentos_secciones_list->Recordset); // Load row values
		}
		$documentos_secciones->RowType = EW_ROWTYPE_VIEW; // Render view
		$documentos_secciones->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$documentos_secciones_list->RenderRow();

		// Render list options
		$documentos_secciones_list->RenderListOptions();
?>
	<tr<?php echo $documentos_secciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$documentos_secciones_list->ListOptions->Render("body", "left");
?>
	<?php if ($documentos_secciones->id_documentos->Visible) { // id_documentos ?>
		<td<?php echo $documentos_secciones->id_documentos->CellAttributes() ?>>
<div<?php echo $documentos_secciones->id_documentos->ViewAttributes() ?>><?php echo $documentos_secciones->id_documentos->ListViewValue() ?></div>
<a name="<?php echo $documentos_secciones_list->PageObjName . "_row_" . $documentos_secciones_list->RowCnt ?>" id="<?php echo $documentos_secciones_list->PageObjName . "_row_" . $documentos_secciones_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($documentos_secciones->id_grupo_sec->Visible) { // id_grupo_sec ?>
		<td<?php echo $documentos_secciones->id_grupo_sec->CellAttributes() ?>>
<div<?php echo $documentos_secciones->id_grupo_sec->ViewAttributes() ?>><?php echo $documentos_secciones->id_grupo_sec->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($documentos_secciones->fecha_inicio->Visible) { // fecha_inicio ?>
		<td<?php echo $documentos_secciones->fecha_inicio->CellAttributes() ?>>
<div<?php echo $documentos_secciones->fecha_inicio->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_inicio->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($documentos_secciones->fecha_fin->Visible) { // fecha_fin ?>
		<td<?php echo $documentos_secciones->fecha_fin->CellAttributes() ?>>
<div<?php echo $documentos_secciones->fecha_fin->ViewAttributes() ?>><?php echo $documentos_secciones->fecha_fin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($documentos_secciones->fecha->Visible) { // fecha ?>
		<td<?php echo $documentos_secciones->fecha->CellAttributes() ?>>
<div<?php echo $documentos_secciones->fecha->ViewAttributes() ?>><?php echo $documentos_secciones->fecha->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($documentos_secciones->estatus->Visible) { // estatus ?>
		<td<?php echo $documentos_secciones->estatus->CellAttributes() ?>>
<div<?php echo $documentos_secciones->estatus->ViewAttributes() ?>><?php echo $documentos_secciones->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$documentos_secciones_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($documentos_secciones->CurrentAction <> "gridadd")
		$documentos_secciones_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($documentos_secciones_list->Recordset)
	$documentos_secciones_list->Recordset->Close();
?>
<?php if ($documentos_secciones->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($documentos_secciones->CurrentAction <> "gridadd" && $documentos_secciones->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($documentos_secciones_list->Pager)) $documentos_secciones_list->Pager = new cPrevNextPager($documentos_secciones_list->StartRec, $documentos_secciones_list->DisplayRecs, $documentos_secciones_list->TotalRecs) ?>
<?php if ($documentos_secciones_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($documentos_secciones_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $documentos_secciones_list->PageUrl() ?>start=<?php echo $documentos_secciones_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($documentos_secciones_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $documentos_secciones_list->PageUrl() ?>start=<?php echo $documentos_secciones_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $documentos_secciones_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($documentos_secciones_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $documentos_secciones_list->PageUrl() ?>start=<?php echo $documentos_secciones_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($documentos_secciones_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $documentos_secciones_list->PageUrl() ?>start=<?php echo $documentos_secciones_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $documentos_secciones_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $documentos_secciones_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $documentos_secciones_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $documentos_secciones_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($documentos_secciones_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $documentos_secciones_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($documentos_secciones->Export == "" && $documentos_secciones->CurrentAction == "") { ?>
<?php } ?>
<?php
$documentos_secciones_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($documentos_secciones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$documentos_secciones_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumentos_secciones_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'documentos_secciones';

	// Page object name
	var $PageObjName = 'documentos_secciones_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) $PageUrl .= "t=" . $documentos_secciones->TableVar . "&"; // Add page token
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
		global $objForm, $documentos_secciones;
		if ($documentos_secciones->UseTokenInUrl) {
			if ($objForm)
				return ($documentos_secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documentos_secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumentos_secciones_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documentos_secciones)
		if (!isset($GLOBALS["documentos_secciones"])) {
			$GLOBALS["documentos_secciones"] = new cdocumentos_secciones();
			$GLOBALS["Table"] =& $GLOBALS["documentos_secciones"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "documentos_seccionesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "documentos_seccionesdelete.php";
		$this->MultiUpdateUrl = "documentos_seccionesupdate.php";

		// Table object (documentos)
		if (!isset($GLOBALS['documentos'])) $GLOBALS['documentos'] = new cdocumentos();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documentos_secciones', TRUE);

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
		global $documentos_secciones;

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
			$documentos_secciones->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $documentos_secciones;

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
			if ($documentos_secciones->Export <> "" ||
				$documentos_secciones->CurrentAction == "gridadd" ||
				$documentos_secciones->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($documentos_secciones->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $documentos_secciones->getRecordsPerPage(); // Restore from Session
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
		$this->DbMasterFilter = $documentos_secciones->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $documentos_secciones->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($documentos_secciones->getMasterFilter() <> "" && $documentos_secciones->getCurrentMasterTable() == "documentos") {
			global $documentos;
			$rsmaster = $documentos->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($documentos_secciones->getReturnUrl()); // Return to caller
			} else {
				$documentos->LoadListRowValues($rsmaster);
				$documentos->RowType = EW_ROWTYPE_MASTER; // Master row
				$documentos->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$documentos_secciones->setSessionWhere($sFilter);
		$documentos_secciones->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $documentos_secciones;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$documentos_secciones->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$documentos_secciones->CurrentOrderType = @$_GET["ordertype"];
			$documentos_secciones->UpdateSort($documentos_secciones->id_documentos); // id_documentos
			$documentos_secciones->UpdateSort($documentos_secciones->id_grupo_sec); // id_grupo_sec
			$documentos_secciones->UpdateSort($documentos_secciones->fecha_inicio); // fecha_inicio
			$documentos_secciones->UpdateSort($documentos_secciones->fecha_fin); // fecha_fin
			$documentos_secciones->UpdateSort($documentos_secciones->fecha); // fecha
			$documentos_secciones->UpdateSort($documentos_secciones->estatus); // estatus
			$documentos_secciones->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $documentos_secciones;
		$sOrderBy = $documentos_secciones->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($documentos_secciones->SqlOrderBy() <> "") {
				$sOrderBy = $documentos_secciones->SqlOrderBy();
				$documentos_secciones->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $documentos_secciones;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$documentos_secciones->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$documentos_secciones->id_documentos->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$documentos_secciones->setSessionOrderBy($sOrderBy);
				$documentos_secciones->id_documentos->setSort("");
				$documentos_secciones->id_grupo_sec->setSort("");
				$documentos_secciones->fecha_inicio->setSort("");
				$documentos_secciones->fecha_fin->setSort("");
				$documentos_secciones->fecha->setSort("");
				$documentos_secciones->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $documentos_secciones;

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
		global $Security, $Language, $documentos_secciones, $objForm;
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
		global $Security, $Language, $documentos_secciones;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $documentos_secciones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$documentos_secciones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$documentos_secciones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $documentos_secciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$documentos_secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $documentos_secciones;

		// Call Recordset Selecting event
		$documentos_secciones->Recordset_Selecting($documentos_secciones->CurrentFilter);

		// Load List page SQL
		$sSql = $documentos_secciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$documentos_secciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documentos_secciones;
		$sFilter = $documentos_secciones->KeyFilter();

		// Call Row Selecting event
		$documentos_secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documentos_secciones->CurrentFilter = $sFilter;
		$sSql = $documentos_secciones->SQL();
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
		global $conn, $documentos_secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documentos_secciones->Row_Selected($row);
		$documentos_secciones->id_documentos_secciones->setDbValue($rs->fields('id_documentos_secciones'));
		$documentos_secciones->id_documentos->setDbValue($rs->fields('id_documentos'));
		$documentos_secciones->id_grupo_sec->setDbValue($rs->fields('id_grupo_sec'));
		$documentos_secciones->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$documentos_secciones->fecha_fin->setDbValue($rs->fields('fecha_fin'));
		$documentos_secciones->fecha->setDbValue($rs->fields('fecha'));
		$documentos_secciones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $documentos_secciones;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($documentos_secciones->getKey("id_documentos_secciones")) <> "")
			$documentos_secciones->id_documentos_secciones->CurrentValue = $documentos_secciones->getKey("id_documentos_secciones"); // id_documentos_secciones
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$documentos_secciones->CurrentFilter = $documentos_secciones->KeyFilter();
			$sSql = $documentos_secciones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documentos_secciones;

		// Initialize URLs
		$this->ViewUrl = $documentos_secciones->ViewUrl();
		$this->EditUrl = $documentos_secciones->EditUrl();
		$this->InlineEditUrl = $documentos_secciones->InlineEditUrl();
		$this->CopyUrl = $documentos_secciones->CopyUrl();
		$this->InlineCopyUrl = $documentos_secciones->InlineCopyUrl();
		$this->DeleteUrl = $documentos_secciones->DeleteUrl();

		// Call Row_Rendering event
		$documentos_secciones->Row_Rendering();

		// Common render codes for all row types
		// id_documentos_secciones
		// id_documentos
		// id_grupo_sec
		// fecha_inicio
		// fecha_fin
		// fecha
		// estatus

		if ($documentos_secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_documentos
			if (strval($documentos_secciones->id_documentos->CurrentValue) <> "") {
				$sFilterWrk = "`id_documentos` = " . ew_AdjustSql($documentos_secciones->id_documentos->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `documentos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_documentos->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_documentos->ViewValue = $documentos_secciones->id_documentos->CurrentValue;
				}
			} else {
				$documentos_secciones->id_documentos->ViewValue = NULL;
			}
			$documentos_secciones->id_documentos->ViewCustomAttributes = "";

			// id_grupo_sec
			if (strval($documentos_secciones->id_grupo_sec->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($documentos_secciones->id_grupo_sec->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view1`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documentos_secciones->id_grupo_sec->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$documentos_secciones->id_grupo_sec->ViewValue = $documentos_secciones->id_grupo_sec->CurrentValue;
				}
			} else {
				$documentos_secciones->id_grupo_sec->ViewValue = NULL;
			}
			$documentos_secciones->id_grupo_sec->ViewCustomAttributes = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->ViewValue = $documentos_secciones->fecha_inicio->CurrentValue;
			$documentos_secciones->fecha_inicio->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_inicio->ViewValue, 7);
			$documentos_secciones->fecha_inicio->ViewCustomAttributes = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->ViewValue = $documentos_secciones->fecha_fin->CurrentValue;
			$documentos_secciones->fecha_fin->ViewValue = ew_FormatDateTime($documentos_secciones->fecha_fin->ViewValue, 7);
			$documentos_secciones->fecha_fin->ViewCustomAttributes = "";

			// fecha
			$documentos_secciones->fecha->ViewValue = $documentos_secciones->fecha->CurrentValue;
			$documentos_secciones->fecha->ViewValue = ew_FormatDateTime($documentos_secciones->fecha->ViewValue, 7);
			$documentos_secciones->fecha->ViewCustomAttributes = "";

			// estatus
			if (strval($documentos_secciones->estatus->CurrentValue) <> "") {
				switch ($documentos_secciones->estatus->CurrentValue) {
					case "1":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(1) <> "" ? $documentos_secciones->estatus->FldTagCaption(1) : $documentos_secciones->estatus->CurrentValue;
						break;
					case "0":
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->FldTagCaption(2) <> "" ? $documentos_secciones->estatus->FldTagCaption(2) : $documentos_secciones->estatus->CurrentValue;
						break;
					default:
						$documentos_secciones->estatus->ViewValue = $documentos_secciones->estatus->CurrentValue;
				}
			} else {
				$documentos_secciones->estatus->ViewValue = NULL;
			}
			$documentos_secciones->estatus->ViewCustomAttributes = "";

			// id_documentos
			$documentos_secciones->id_documentos->LinkCustomAttributes = "";
			$documentos_secciones->id_documentos->HrefValue = "";
			$documentos_secciones->id_documentos->TooltipValue = "";

			// id_grupo_sec
			$documentos_secciones->id_grupo_sec->LinkCustomAttributes = "";
			$documentos_secciones->id_grupo_sec->HrefValue = "";
			$documentos_secciones->id_grupo_sec->TooltipValue = "";

			// fecha_inicio
			$documentos_secciones->fecha_inicio->LinkCustomAttributes = "";
			$documentos_secciones->fecha_inicio->HrefValue = "";
			$documentos_secciones->fecha_inicio->TooltipValue = "";

			// fecha_fin
			$documentos_secciones->fecha_fin->LinkCustomAttributes = "";
			$documentos_secciones->fecha_fin->HrefValue = "";
			$documentos_secciones->fecha_fin->TooltipValue = "";

			// fecha
			$documentos_secciones->fecha->LinkCustomAttributes = "";
			$documentos_secciones->fecha->HrefValue = "";
			$documentos_secciones->fecha->TooltipValue = "";

			// estatus
			$documentos_secciones->estatus->LinkCustomAttributes = "";
			$documentos_secciones->estatus->HrefValue = "";
			$documentos_secciones->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($documentos_secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documentos_secciones->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $documentos_secciones;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "documentos") {
				$bValidMaster = TRUE;
				if (@$_GET["id_documentos"] <> "") {
					$GLOBALS["documentos"]->id_documentos->setQueryStringValue($_GET["id_documentos"]);
					$documentos_secciones->id_documentos->setQueryStringValue($GLOBALS["documentos"]->id_documentos->QueryStringValue);
					$documentos_secciones->id_documentos->setSessionValue($documentos_secciones->id_documentos->QueryStringValue);
					if (!is_numeric($GLOBALS["documentos"]->id_documentos->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$documentos_secciones->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$documentos_secciones->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "documentos") {
				if ($documentos_secciones->id_documentos->QueryStringValue == "") $documentos_secciones->id_documentos->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $documentos_secciones->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $documentos_secciones->getDetailFilter(); // Get detail filter
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
		$table = 'documentos_secciones';
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
