<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "grupo_seccionesinfo.php" ?>
<?php include_once "contenidosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$grupo_secciones_list = new cgrupo_secciones_list();
$Page =& $grupo_secciones_list;

// Page init
$grupo_secciones_list->Page_Init();

// Page main
$grupo_secciones_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($grupo_secciones->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var grupo_secciones_list = new ew_Page("grupo_secciones_list");

// page properties
grupo_secciones_list.PageID = "list"; // page ID
grupo_secciones_list.FormID = "fgrupo_seccioneslist"; // form ID
var EW_PAGE_ID = grupo_secciones_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
grupo_secciones_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grupo_secciones_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grupo_secciones_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($grupo_secciones->Export == "") || (EW_EXPORT_MASTER_RECORD && $grupo_secciones->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "contenidoslist.php";
if ($grupo_secciones_list->DbMasterFilter <> "" && $grupo_secciones->getCurrentMasterTable() == "contenidos") {
	if ($grupo_secciones_list->MasterRecordExists) {
		if ($grupo_secciones->getCurrentMasterTable() == $grupo_secciones->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $contenidos->TableCaption() ?>
&nbsp;&nbsp;<?php $grupo_secciones_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($grupo_secciones->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "contenidosmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$grupo_secciones_list->TotalRecs = $grupo_secciones->SelectRecordCount();
	} else {
		if ($grupo_secciones_list->Recordset = $grupo_secciones_list->LoadRecordset())
			$grupo_secciones_list->TotalRecs = $grupo_secciones_list->Recordset->RecordCount();
	}
	$grupo_secciones_list->StartRec = 1;
	if ($grupo_secciones_list->DisplayRecs <= 0 || ($grupo_secciones->Export <> "" && $grupo_secciones->ExportAll)) // Display all records
		$grupo_secciones_list->DisplayRecs = $grupo_secciones_list->TotalRecs;
	if (!($grupo_secciones->Export <> "" && $grupo_secciones->ExportAll))
		$grupo_secciones_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$grupo_secciones_list->Recordset = $grupo_secciones_list->LoadRecordset($grupo_secciones_list->StartRec-1, $grupo_secciones_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grupo_secciones->TableCaption() ?>
<?php if ($grupo_secciones->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $grupo_secciones_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($grupo_secciones->Export == "" && $grupo_secciones->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(grupo_secciones_list);" style="text-decoration: none;"><img id="grupo_secciones_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="grupo_secciones_list_SearchPanel">
<form name="fgrupo_seccioneslistsrch" id="fgrupo_seccioneslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="grupo_secciones">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($grupo_secciones->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $grupo_secciones_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($grupo_secciones->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($grupo_secciones->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($grupo_secciones->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $grupo_secciones_list->ShowPageHeader(); ?>
<?php
$grupo_secciones_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fgrupo_seccioneslist" id="fgrupo_seccioneslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="grupo_secciones">
<div id="gmp_grupo_secciones" class="ewGridMiddlePanel">
<?php if ($grupo_secciones_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $grupo_secciones->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$grupo_secciones_list->RenderListOptions();

// Render list options (header, left)
$grupo_secciones_list->ListOptions->Render("header", "left");
?>
<?php if ($grupo_secciones->id_grupo->Visible) { // id_grupo ?>
	<?php if ($grupo_secciones->SortUrl($grupo_secciones->id_grupo) == "") { ?>
		<td><?php echo $grupo_secciones->id_grupo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grupo_secciones->SortUrl($grupo_secciones->id_grupo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo_secciones->id_grupo->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo_secciones->id_grupo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo_secciones->id_grupo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo_secciones->id_contenido->Visible) { // id_contenido ?>
	<?php if ($grupo_secciones->SortUrl($grupo_secciones->id_contenido) == "") { ?>
		<td><?php echo $grupo_secciones->id_contenido->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grupo_secciones->SortUrl($grupo_secciones->id_contenido) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo_secciones->id_contenido->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo_secciones->id_contenido->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo_secciones->id_contenido->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo_secciones->orden->Visible) { // orden ?>
	<?php if ($grupo_secciones->SortUrl($grupo_secciones->orden) == "") { ?>
		<td><?php echo $grupo_secciones->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grupo_secciones->SortUrl($grupo_secciones->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo_secciones->orden->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($grupo_secciones->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo_secciones->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($grupo_secciones->estatus->Visible) { // estatus ?>
	<?php if ($grupo_secciones->SortUrl($grupo_secciones->estatus) == "") { ?>
		<td><?php echo $grupo_secciones->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $grupo_secciones->SortUrl($grupo_secciones->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $grupo_secciones->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($grupo_secciones->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($grupo_secciones->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$grupo_secciones_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($grupo_secciones->ExportAll && $grupo_secciones->Export <> "") {
	$grupo_secciones_list->StopRec = $grupo_secciones_list->TotalRecs;
} else {

	// Set the last record to display
	if ($grupo_secciones_list->TotalRecs > $grupo_secciones_list->StartRec + $grupo_secciones_list->DisplayRecs - 1)
		$grupo_secciones_list->StopRec = $grupo_secciones_list->StartRec + $grupo_secciones_list->DisplayRecs - 1;
	else
		$grupo_secciones_list->StopRec = $grupo_secciones_list->TotalRecs;
}
$grupo_secciones_list->RecCnt = $grupo_secciones_list->StartRec - 1;
if ($grupo_secciones_list->Recordset && !$grupo_secciones_list->Recordset->EOF) {
	$grupo_secciones_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $grupo_secciones_list->StartRec > 1)
		$grupo_secciones_list->Recordset->Move($grupo_secciones_list->StartRec - 1);
} elseif (!$grupo_secciones->AllowAddDeleteRow && $grupo_secciones_list->StopRec == 0) {
	$grupo_secciones_list->StopRec = $grupo_secciones->GridAddRowCount;
}

// Initialize aggregate
$grupo_secciones->RowType = EW_ROWTYPE_AGGREGATEINIT;
$grupo_secciones->ResetAttrs();
$grupo_secciones_list->RenderRow();
$grupo_secciones_list->RowCnt = 0;
while ($grupo_secciones_list->RecCnt < $grupo_secciones_list->StopRec) {
	$grupo_secciones_list->RecCnt++;
	if (intval($grupo_secciones_list->RecCnt) >= intval($grupo_secciones_list->StartRec)) {
		$grupo_secciones_list->RowCnt++;

		// Set up key count
		$grupo_secciones_list->KeyCount = $grupo_secciones_list->RowIndex;

		// Init row class and style
		$grupo_secciones->ResetAttrs();
		$grupo_secciones->CssClass = "";
		if ($grupo_secciones->CurrentAction == "gridadd") {
		} else {
			$grupo_secciones_list->LoadRowValues($grupo_secciones_list->Recordset); // Load row values
		}
		$grupo_secciones->RowType = EW_ROWTYPE_VIEW; // Render view
		$grupo_secciones->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$grupo_secciones_list->RenderRow();

		// Render list options
		$grupo_secciones_list->RenderListOptions();
?>
	<tr<?php echo $grupo_secciones->RowAttributes() ?>>
<?php

// Render list options (body, left)
$grupo_secciones_list->ListOptions->Render("body", "left");
?>
	<?php if ($grupo_secciones->id_grupo->Visible) { // id_grupo ?>
		<td<?php echo $grupo_secciones->id_grupo->CellAttributes() ?>>
<div<?php echo $grupo_secciones->id_grupo->ViewAttributes() ?>><?php echo $grupo_secciones->id_grupo->ListViewValue() ?></div>
<a name="<?php echo $grupo_secciones_list->PageObjName . "_row_" . $grupo_secciones_list->RowCnt ?>" id="<?php echo $grupo_secciones_list->PageObjName . "_row_" . $grupo_secciones_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($grupo_secciones->id_contenido->Visible) { // id_contenido ?>
		<td<?php echo $grupo_secciones->id_contenido->CellAttributes() ?>>
<div<?php echo $grupo_secciones->id_contenido->ViewAttributes() ?>><?php echo $grupo_secciones->id_contenido->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grupo_secciones->orden->Visible) { // orden ?>
		<td<?php echo $grupo_secciones->orden->CellAttributes() ?>>
<div<?php echo $grupo_secciones->orden->ViewAttributes() ?>><?php echo $grupo_secciones->orden->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($grupo_secciones->estatus->Visible) { // estatus ?>
		<td<?php echo $grupo_secciones->estatus->CellAttributes() ?>>
<div<?php echo $grupo_secciones->estatus->ViewAttributes() ?>><?php echo $grupo_secciones->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grupo_secciones_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($grupo_secciones->CurrentAction <> "gridadd")
		$grupo_secciones_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($grupo_secciones_list->Recordset)
	$grupo_secciones_list->Recordset->Close();
?>
<?php if ($grupo_secciones->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($grupo_secciones->CurrentAction <> "gridadd" && $grupo_secciones->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($grupo_secciones_list->Pager)) $grupo_secciones_list->Pager = new cPrevNextPager($grupo_secciones_list->StartRec, $grupo_secciones_list->DisplayRecs, $grupo_secciones_list->TotalRecs) ?>
<?php if ($grupo_secciones_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($grupo_secciones_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $grupo_secciones_list->PageUrl() ?>start=<?php echo $grupo_secciones_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($grupo_secciones_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $grupo_secciones_list->PageUrl() ?>start=<?php echo $grupo_secciones_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $grupo_secciones_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($grupo_secciones_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $grupo_secciones_list->PageUrl() ?>start=<?php echo $grupo_secciones_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($grupo_secciones_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $grupo_secciones_list->PageUrl() ?>start=<?php echo $grupo_secciones_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $grupo_secciones_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $grupo_secciones_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $grupo_secciones_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $grupo_secciones_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($grupo_secciones_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $grupo_secciones_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($grupo_secciones->Export == "" && $grupo_secciones->CurrentAction == "") { ?>
<?php } ?>
<?php
$grupo_secciones_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($grupo_secciones->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$grupo_secciones_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrupo_secciones_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'grupo_secciones';

	// Page object name
	var $PageObjName = 'grupo_secciones_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grupo_secciones;
		if ($grupo_secciones->UseTokenInUrl) $PageUrl .= "t=" . $grupo_secciones->TableVar . "&"; // Add page token
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
		global $objForm, $grupo_secciones;
		if ($grupo_secciones->UseTokenInUrl) {
			if ($objForm)
				return ($grupo_secciones->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grupo_secciones->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrupo_secciones_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (grupo_secciones)
		if (!isset($GLOBALS["grupo_secciones"])) {
			$GLOBALS["grupo_secciones"] = new cgrupo_secciones();
			$GLOBALS["Table"] =& $GLOBALS["grupo_secciones"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "grupo_seccionesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "grupo_seccionesdelete.php";
		$this->MultiUpdateUrl = "grupo_seccionesupdate.php";

		// Table object (contenidos)
		if (!isset($GLOBALS['contenidos'])) $GLOBALS['contenidos'] = new ccontenidos();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grupo_secciones', TRUE);

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
		global $grupo_secciones;

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
			$grupo_secciones->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $grupo_secciones;

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
			if ($grupo_secciones->Export <> "" ||
				$grupo_secciones->CurrentAction == "gridadd" ||
				$grupo_secciones->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$grupo_secciones->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($grupo_secciones->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $grupo_secciones->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$grupo_secciones->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$grupo_secciones->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$grupo_secciones->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $grupo_secciones->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $grupo_secciones->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $grupo_secciones->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($grupo_secciones->getMasterFilter() <> "" && $grupo_secciones->getCurrentMasterTable() == "contenidos") {
			global $contenidos;
			$rsmaster = $contenidos->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($grupo_secciones->getReturnUrl()); // Return to caller
			} else {
				$contenidos->LoadListRowValues($rsmaster);
				$contenidos->RowType = EW_ROWTYPE_MASTER; // Master row
				$contenidos->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$grupo_secciones->setSessionWhere($sFilter);
		$grupo_secciones->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $grupo_secciones;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $grupo_secciones->orden, $Keyword);
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
		global $Security, $grupo_secciones;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $grupo_secciones->BasicSearchKeyword;
		$sSearchType = $grupo_secciones->BasicSearchType;
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
			$grupo_secciones->setSessionBasicSearchKeyword($sSearchKeyword);
			$grupo_secciones->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $grupo_secciones;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$grupo_secciones->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $grupo_secciones;
		$grupo_secciones->setSessionBasicSearchKeyword("");
		$grupo_secciones->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $grupo_secciones;
		$bRestore = TRUE;
		if ($grupo_secciones->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$grupo_secciones->BasicSearchKeyword = $grupo_secciones->getSessionBasicSearchKeyword();
			$grupo_secciones->BasicSearchType = $grupo_secciones->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $grupo_secciones;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$grupo_secciones->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$grupo_secciones->CurrentOrderType = @$_GET["ordertype"];
			$grupo_secciones->UpdateSort($grupo_secciones->id_grupo); // id_grupo
			$grupo_secciones->UpdateSort($grupo_secciones->id_contenido); // id_contenido
			$grupo_secciones->UpdateSort($grupo_secciones->orden); // orden
			$grupo_secciones->UpdateSort($grupo_secciones->estatus); // estatus
			$grupo_secciones->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $grupo_secciones;
		$sOrderBy = $grupo_secciones->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($grupo_secciones->SqlOrderBy() <> "") {
				$sOrderBy = $grupo_secciones->SqlOrderBy();
				$grupo_secciones->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $grupo_secciones;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$grupo_secciones->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$grupo_secciones->id_contenido->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$grupo_secciones->setSessionOrderBy($sOrderBy);
				$grupo_secciones->id_grupo->setSort("");
				$grupo_secciones->id_contenido->setSort("");
				$grupo_secciones->orden->setSort("");
				$grupo_secciones->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$grupo_secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $grupo_secciones;

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
		global $Security, $Language, $grupo_secciones, $objForm;
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
		global $Security, $Language, $grupo_secciones;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $grupo_secciones;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$grupo_secciones->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$grupo_secciones->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $grupo_secciones->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$grupo_secciones->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$grupo_secciones->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$grupo_secciones->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $grupo_secciones;
		$grupo_secciones->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$grupo_secciones->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $grupo_secciones;

		// Call Recordset Selecting event
		$grupo_secciones->Recordset_Selecting($grupo_secciones->CurrentFilter);

		// Load List page SQL
		$sSql = $grupo_secciones->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$grupo_secciones->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grupo_secciones;
		$sFilter = $grupo_secciones->KeyFilter();

		// Call Row Selecting event
		$grupo_secciones->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grupo_secciones->CurrentFilter = $sFilter;
		$sSql = $grupo_secciones->SQL();
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
		global $conn, $grupo_secciones;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$grupo_secciones->Row_Selected($row);
		$grupo_secciones->id_grupo_seccion->setDbValue($rs->fields('id_grupo_seccion'));
		$grupo_secciones->id_grupo->setDbValue($rs->fields('id_grupo'));
		$grupo_secciones->id_contenido->setDbValue($rs->fields('id_contenido'));
		$grupo_secciones->orden->setDbValue($rs->fields('orden'));
		$grupo_secciones->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $grupo_secciones;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($grupo_secciones->getKey("id_grupo_seccion")) <> "")
			$grupo_secciones->id_grupo_seccion->CurrentValue = $grupo_secciones->getKey("id_grupo_seccion"); // id_grupo_seccion
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$grupo_secciones->CurrentFilter = $grupo_secciones->KeyFilter();
			$sSql = $grupo_secciones->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grupo_secciones;

		// Initialize URLs
		$this->ViewUrl = $grupo_secciones->ViewUrl();
		$this->EditUrl = $grupo_secciones->EditUrl();
		$this->InlineEditUrl = $grupo_secciones->InlineEditUrl();
		$this->CopyUrl = $grupo_secciones->CopyUrl();
		$this->InlineCopyUrl = $grupo_secciones->InlineCopyUrl();
		$this->DeleteUrl = $grupo_secciones->DeleteUrl();

		// Call Row_Rendering event
		$grupo_secciones->Row_Rendering();

		// Common render codes for all row types
		// id_grupo_seccion
		// id_grupo
		// id_contenido
		// orden
		// estatus

		if ($grupo_secciones->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_grupo
			if (strval($grupo_secciones->id_grupo->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo` = " . ew_AdjustSql($grupo_secciones->id_grupo->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `view3`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `titulo`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo_secciones->id_grupo->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo_secciones->id_grupo->ViewValue = $grupo_secciones->id_grupo->CurrentValue;
				}
			} else {
				$grupo_secciones->id_grupo->ViewValue = NULL;
			}
			$grupo_secciones->id_grupo->ViewCustomAttributes = "";

			// id_contenido
			if (strval($grupo_secciones->id_contenido->CurrentValue) <> "") {
				$sFilterWrk = "`id_contenido` = " . ew_AdjustSql($grupo_secciones->id_contenido->CurrentValue) . "";
			$sSqlWrk = "SELECT `titulo` FROM `contenidos`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$grupo_secciones->id_contenido->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$grupo_secciones->id_contenido->ViewValue = $grupo_secciones->id_contenido->CurrentValue;
				}
			} else {
				$grupo_secciones->id_contenido->ViewValue = NULL;
			}
			$grupo_secciones->id_contenido->ViewCustomAttributes = "";

			// orden
			$grupo_secciones->orden->ViewValue = $grupo_secciones->orden->CurrentValue;
			$grupo_secciones->orden->ViewCustomAttributes = "";

			// estatus
			if (strval($grupo_secciones->estatus->CurrentValue) <> "") {
				switch ($grupo_secciones->estatus->CurrentValue) {
					case "1":
						$grupo_secciones->estatus->ViewValue = $grupo_secciones->estatus->FldTagCaption(1) <> "" ? $grupo_secciones->estatus->FldTagCaption(1) : $grupo_secciones->estatus->CurrentValue;
						break;
					case "0":
						$grupo_secciones->estatus->ViewValue = $grupo_secciones->estatus->FldTagCaption(2) <> "" ? $grupo_secciones->estatus->FldTagCaption(2) : $grupo_secciones->estatus->CurrentValue;
						break;
					default:
						$grupo_secciones->estatus->ViewValue = $grupo_secciones->estatus->CurrentValue;
				}
			} else {
				$grupo_secciones->estatus->ViewValue = NULL;
			}
			$grupo_secciones->estatus->ViewCustomAttributes = "";

			// id_grupo
			$grupo_secciones->id_grupo->LinkCustomAttributes = "";
			$grupo_secciones->id_grupo->HrefValue = "";
			$grupo_secciones->id_grupo->TooltipValue = "";

			// id_contenido
			$grupo_secciones->id_contenido->LinkCustomAttributes = "";
			$grupo_secciones->id_contenido->HrefValue = "";
			$grupo_secciones->id_contenido->TooltipValue = "";

			// orden
			$grupo_secciones->orden->LinkCustomAttributes = "";
			$grupo_secciones->orden->HrefValue = "";
			$grupo_secciones->orden->TooltipValue = "";

			// estatus
			$grupo_secciones->estatus->LinkCustomAttributes = "";
			$grupo_secciones->estatus->HrefValue = "";
			$grupo_secciones->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($grupo_secciones->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grupo_secciones->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $grupo_secciones;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "contenidos") {
				$bValidMaster = TRUE;
				if (@$_GET["id_contenido"] <> "") {
					$GLOBALS["contenidos"]->id_contenido->setQueryStringValue($_GET["id_contenido"]);
					$grupo_secciones->id_contenido->setQueryStringValue($GLOBALS["contenidos"]->id_contenido->QueryStringValue);
					$grupo_secciones->id_contenido->setSessionValue($grupo_secciones->id_contenido->QueryStringValue);
					if (!is_numeric($GLOBALS["contenidos"]->id_contenido->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$grupo_secciones->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$grupo_secciones->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "contenidos") {
				if ($grupo_secciones->id_contenido->QueryStringValue == "") $grupo_secciones->id_contenido->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $grupo_secciones->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $grupo_secciones->getDetailFilter(); // Get detail filter
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
		$table = 'grupo_secciones';
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
