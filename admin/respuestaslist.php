<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "respuestasinfo.php" ?>
<?php include_once "preguntasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$respuestas_list = new crespuestas_list();
$Page =& $respuestas_list;

// Page init
$respuestas_list->Page_Init();

// Page main
$respuestas_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($respuestas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var respuestas_list = new ew_Page("respuestas_list");

// page properties
respuestas_list.PageID = "list"; // page ID
respuestas_list.FormID = "frespuestaslist"; // form ID
var EW_PAGE_ID = respuestas_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
respuestas_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
respuestas_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
respuestas_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($respuestas->Export == "") || (EW_EXPORT_MASTER_RECORD && $respuestas->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "preguntaslist.php";
if ($respuestas_list->DbMasterFilter <> "" && $respuestas->getCurrentMasterTable() == "preguntas") {
	if ($respuestas_list->MasterRecordExists) {
		if ($respuestas->getCurrentMasterTable() == $respuestas->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $preguntas->TableCaption() ?>
&nbsp;&nbsp;<?php $respuestas_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($respuestas->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "preguntasmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$respuestas_list->TotalRecs = $respuestas->SelectRecordCount();
	} else {
		if ($respuestas_list->Recordset = $respuestas_list->LoadRecordset())
			$respuestas_list->TotalRecs = $respuestas_list->Recordset->RecordCount();
	}
	$respuestas_list->StartRec = 1;
	if ($respuestas_list->DisplayRecs <= 0 || ($respuestas->Export <> "" && $respuestas->ExportAll)) // Display all records
		$respuestas_list->DisplayRecs = $respuestas_list->TotalRecs;
	if (!($respuestas->Export <> "" && $respuestas->ExportAll))
		$respuestas_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$respuestas_list->Recordset = $respuestas_list->LoadRecordset($respuestas_list->StartRec-1, $respuestas_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $respuestas->TableCaption() ?>
<?php if ($respuestas->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $respuestas_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($respuestas->Export == "" && $respuestas->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(respuestas_list);" style="text-decoration: none;"><img id="respuestas_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="respuestas_list_SearchPanel">
<form name="frespuestaslistsrch" id="frespuestaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="respuestas">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($respuestas->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $respuestas_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($respuestas->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($respuestas->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($respuestas->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $respuestas_list->ShowPageHeader(); ?>
<?php
$respuestas_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="frespuestaslist" id="frespuestaslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="respuestas">
<div id="gmp_respuestas" class="ewGridMiddlePanel">
<?php if ($respuestas_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $respuestas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$respuestas_list->RenderListOptions();

// Render list options (header, left)
$respuestas_list->ListOptions->Render("header", "left");
?>
<?php if ($respuestas->id_pregunta->Visible) { // id_pregunta ?>
	<?php if ($respuestas->SortUrl($respuestas->id_pregunta) == "") { ?>
		<td><?php echo $respuestas->id_pregunta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $respuestas->SortUrl($respuestas->id_pregunta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->id_pregunta->FldCaption() ?></td><td style="width: 10px;"><?php if ($respuestas->id_pregunta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->id_pregunta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($respuestas->respuesta->Visible) { // respuesta ?>
	<?php if ($respuestas->SortUrl($respuestas->respuesta) == "") { ?>
		<td><?php echo $respuestas->respuesta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $respuestas->SortUrl($respuestas->respuesta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->respuesta->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($respuestas->respuesta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->respuesta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($respuestas->contador->Visible) { // contador ?>
	<?php if ($respuestas->SortUrl($respuestas->contador) == "") { ?>
		<td><?php echo $respuestas->contador->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $respuestas->SortUrl($respuestas->contador) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->contador->FldCaption() ?></td><td style="width: 10px;"><?php if ($respuestas->contador->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->contador->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($respuestas->orden->Visible) { // orden ?>
	<?php if ($respuestas->SortUrl($respuestas->orden) == "") { ?>
		<td><?php echo $respuestas->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $respuestas->SortUrl($respuestas->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->orden->FldCaption() ?></td><td style="width: 10px;"><?php if ($respuestas->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($respuestas->estatus->Visible) { // estatus ?>
	<?php if ($respuestas->SortUrl($respuestas->estatus) == "") { ?>
		<td><?php echo $respuestas->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $respuestas->SortUrl($respuestas->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $respuestas->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($respuestas->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($respuestas->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$respuestas_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($respuestas->ExportAll && $respuestas->Export <> "") {
	$respuestas_list->StopRec = $respuestas_list->TotalRecs;
} else {

	// Set the last record to display
	if ($respuestas_list->TotalRecs > $respuestas_list->StartRec + $respuestas_list->DisplayRecs - 1)
		$respuestas_list->StopRec = $respuestas_list->StartRec + $respuestas_list->DisplayRecs - 1;
	else
		$respuestas_list->StopRec = $respuestas_list->TotalRecs;
}
$respuestas_list->RecCnt = $respuestas_list->StartRec - 1;
if ($respuestas_list->Recordset && !$respuestas_list->Recordset->EOF) {
	$respuestas_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $respuestas_list->StartRec > 1)
		$respuestas_list->Recordset->Move($respuestas_list->StartRec - 1);
} elseif (!$respuestas->AllowAddDeleteRow && $respuestas_list->StopRec == 0) {
	$respuestas_list->StopRec = $respuestas->GridAddRowCount;
}

// Initialize aggregate
$respuestas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$respuestas->ResetAttrs();
$respuestas_list->RenderRow();
$respuestas_list->RowCnt = 0;
while ($respuestas_list->RecCnt < $respuestas_list->StopRec) {
	$respuestas_list->RecCnt++;
	if (intval($respuestas_list->RecCnt) >= intval($respuestas_list->StartRec)) {
		$respuestas_list->RowCnt++;

		// Set up key count
		$respuestas_list->KeyCount = $respuestas_list->RowIndex;

		// Init row class and style
		$respuestas->ResetAttrs();
		$respuestas->CssClass = "";
		if ($respuestas->CurrentAction == "gridadd") {
		} else {
			$respuestas_list->LoadRowValues($respuestas_list->Recordset); // Load row values
		}
		$respuestas->RowType = EW_ROWTYPE_VIEW; // Render view
		$respuestas->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$respuestas_list->RenderRow();

		// Render list options
		$respuestas_list->RenderListOptions();
?>
	<tr<?php echo $respuestas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$respuestas_list->ListOptions->Render("body", "left");
?>
	<?php if ($respuestas->id_pregunta->Visible) { // id_pregunta ?>
		<td<?php echo $respuestas->id_pregunta->CellAttributes() ?>>
<div<?php echo $respuestas->id_pregunta->ViewAttributes() ?>><?php echo $respuestas->id_pregunta->ListViewValue() ?></div>
<a name="<?php echo $respuestas_list->PageObjName . "_row_" . $respuestas_list->RowCnt ?>" id="<?php echo $respuestas_list->PageObjName . "_row_" . $respuestas_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($respuestas->respuesta->Visible) { // respuesta ?>
		<td<?php echo $respuestas->respuesta->CellAttributes() ?>>
<div<?php echo $respuestas->respuesta->ViewAttributes() ?>><?php echo $respuestas->respuesta->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($respuestas->contador->Visible) { // contador ?>
		<td<?php echo $respuestas->contador->CellAttributes() ?>>
<div<?php echo $respuestas->contador->ViewAttributes() ?>><?php echo $respuestas->contador->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($respuestas->orden->Visible) { // orden ?>
		<td<?php echo $respuestas->orden->CellAttributes() ?>>
<div<?php echo $respuestas->orden->ViewAttributes() ?>><?php echo $respuestas->orden->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($respuestas->estatus->Visible) { // estatus ?>
		<td<?php echo $respuestas->estatus->CellAttributes() ?>>
<div<?php echo $respuestas->estatus->ViewAttributes() ?>><?php echo $respuestas->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$respuestas_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($respuestas->CurrentAction <> "gridadd")
		$respuestas_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($respuestas_list->Recordset)
	$respuestas_list->Recordset->Close();
?>
<?php if ($respuestas->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($respuestas->CurrentAction <> "gridadd" && $respuestas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($respuestas_list->Pager)) $respuestas_list->Pager = new cPrevNextPager($respuestas_list->StartRec, $respuestas_list->DisplayRecs, $respuestas_list->TotalRecs) ?>
<?php if ($respuestas_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($respuestas_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $respuestas_list->PageUrl() ?>start=<?php echo $respuestas_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($respuestas_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $respuestas_list->PageUrl() ?>start=<?php echo $respuestas_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $respuestas_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($respuestas_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $respuestas_list->PageUrl() ?>start=<?php echo $respuestas_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($respuestas_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $respuestas_list->PageUrl() ?>start=<?php echo $respuestas_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $respuestas_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $respuestas_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $respuestas_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $respuestas_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($respuestas_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $respuestas_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($respuestas->Export == "" && $respuestas->CurrentAction == "") { ?>
<?php } ?>
<?php
$respuestas_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($respuestas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$respuestas_list->Page_Terminate();
?>
<?php

//
// Page class
//
class crespuestas_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'respuestas';

	// Page object name
	var $PageObjName = 'respuestas_list';

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
	function crespuestas_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (respuestas)
		if (!isset($GLOBALS["respuestas"])) {
			$GLOBALS["respuestas"] = new crespuestas();
			$GLOBALS["Table"] =& $GLOBALS["respuestas"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "respuestasadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "respuestasdelete.php";
		$this->MultiUpdateUrl = "respuestasupdate.php";

		// Table object (preguntas)
		if (!isset($GLOBALS['preguntas'])) $GLOBALS['preguntas'] = new cpreguntas();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'respuestas', TRUE);

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
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$respuestas->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($respuestas->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $respuestas->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$respuestas->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$respuestas->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$respuestas->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $respuestas->getSearchWhere();
		}

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

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $respuestas;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $respuestas->respuesta, $Keyword);
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
		global $Security, $respuestas;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $respuestas->BasicSearchKeyword;
		$sSearchType = $respuestas->BasicSearchType;
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
			$respuestas->setSessionBasicSearchKeyword($sSearchKeyword);
			$respuestas->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $respuestas;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$respuestas->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $respuestas;
		$respuestas->setSessionBasicSearchKeyword("");
		$respuestas->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $respuestas;
		$bRestore = TRUE;
		if ($respuestas->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$respuestas->BasicSearchKeyword = $respuestas->getSessionBasicSearchKeyword();
			$respuestas->BasicSearchType = $respuestas->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $respuestas;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$respuestas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$respuestas->CurrentOrderType = @$_GET["ordertype"];
			$respuestas->UpdateSort($respuestas->id_pregunta); // id_pregunta
			$respuestas->UpdateSort($respuestas->respuesta); // respuesta
			$respuestas->UpdateSort($respuestas->contador); // contador
			$respuestas->UpdateSort($respuestas->orden); // orden
			$respuestas->UpdateSort($respuestas->estatus); // estatus
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

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

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
				$respuestas->id_pregunta->setSort("");
				$respuestas->respuesta->setSort("");
				$respuestas->contador->setSort("");
				$respuestas->orden->setSort("");
				$respuestas->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$respuestas->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $respuestas;

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
		global $Security, $Language, $respuestas, $objForm;
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

	// Load basic search values
	function LoadBasicSearchValues() {
		global $respuestas;
		$respuestas->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$respuestas->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		if (strval($respuestas->getKey("id_respuestas")) <> "")
			$respuestas->id_respuestas->CurrentValue = $respuestas->getKey("id_respuestas"); // id_respuestas
		else
			$bValidKey = FALSE;

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
		$this->ViewUrl = $respuestas->ViewUrl();
		$this->EditUrl = $respuestas->EditUrl();
		$this->InlineEditUrl = $respuestas->InlineEditUrl();
		$this->CopyUrl = $respuestas->CopyUrl();
		$this->InlineCopyUrl = $respuestas->InlineCopyUrl();
		$this->DeleteUrl = $respuestas->DeleteUrl();

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
		}

		// Call Row Rendered event
		if ($respuestas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$respuestas->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $respuestas;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "preguntas") {
				$bValidMaster = TRUE;
				if (@$_GET["id_pregunta"] <> "") {
					$GLOBALS["preguntas"]->id_pregunta->setQueryStringValue($_GET["id_pregunta"]);
					$respuestas->id_pregunta->setQueryStringValue($GLOBALS["preguntas"]->id_pregunta->QueryStringValue);
					$respuestas->id_pregunta->setSessionValue($respuestas->id_pregunta->QueryStringValue);
					if (!is_numeric($GLOBALS["preguntas"]->id_pregunta->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$respuestas->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$respuestas->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "preguntas") {
				if ($respuestas->id_pregunta->QueryStringValue == "") $respuestas->id_pregunta->setSessionValue("");
			}
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
		$dompdf->set_paper("a4", "portrait");
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
