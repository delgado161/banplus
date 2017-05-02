<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documentosinfo.php" ?>
<?php include_once "documentos_seccionesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documentos_list = new cdocumentos_list();
$Page =& $documentos_list;

// Page init
$documentos_list->Page_Init();

// Page main
$documentos_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($documentos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var documentos_list = new ew_Page("documentos_list");

// page properties
documentos_list.PageID = "list"; // page ID
documentos_list.FormID = "fdocumentoslist"; // form ID
var EW_PAGE_ID = documentos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
documentos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documentos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documentos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($documentos->Export == "") || (EW_EXPORT_MASTER_RECORD && $documentos->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$documentos_list->TotalRecs = $documentos->SelectRecordCount();
	} else {
		if ($documentos_list->Recordset = $documentos_list->LoadRecordset())
			$documentos_list->TotalRecs = $documentos_list->Recordset->RecordCount();
	}
	$documentos_list->StartRec = 1;
	if ($documentos_list->DisplayRecs <= 0 || ($documentos->Export <> "" && $documentos->ExportAll)) // Display all records
		$documentos_list->DisplayRecs = $documentos_list->TotalRecs;
	if (!($documentos->Export <> "" && $documentos->ExportAll))
		$documentos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$documentos_list->Recordset = $documentos_list->LoadRecordset($documentos_list->StartRec-1, $documentos_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documentos->TableCaption() ?>
&nbsp;&nbsp;<?php $documentos_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($documentos->Export == "" && $documentos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(documentos_list);" style="text-decoration: none;"><img id="documentos_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="documentos_list_SearchPanel">
<form name="fdocumentoslistsrch" id="fdocumentoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="documentos">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($documentos->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $documentos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($documentos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($documentos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($documentos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $documentos_list->ShowPageHeader(); ?>
<?php
$documentos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fdocumentoslist" id="fdocumentoslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="documentos">
<div id="gmp_documentos" class="ewGridMiddlePanel">
<?php if ($documentos_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $documentos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$documentos_list->RenderListOptions();

// Render list options (header, left)
$documentos_list->ListOptions->Render("header", "left");
?>
<?php if ($documentos->titulo->Visible) { // titulo ?>
	<?php if ($documentos->SortUrl($documentos->titulo) == "") { ?>
		<td><?php echo $documentos->titulo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos->SortUrl($documentos->titulo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos->titulo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($documentos->titulo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos->titulo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos->documento->Visible) { // documento ?>
	<?php if ($documentos->SortUrl($documentos->documento) == "") { ?>
		<td><?php echo $documentos->documento->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos->SortUrl($documentos->documento) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos->documento->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos->documento->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos->documento->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos->fecha->Visible) { // fecha ?>
	<?php if ($documentos->SortUrl($documentos->fecha) == "") { ?>
		<td><?php echo $documentos->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos->SortUrl($documentos->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($documentos->estatus->Visible) { // estatus ?>
	<?php if ($documentos->SortUrl($documentos->estatus) == "") { ?>
		<td><?php echo $documentos->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $documentos->SortUrl($documentos->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $documentos->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($documentos->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($documentos->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$documentos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($documentos->ExportAll && $documentos->Export <> "") {
	$documentos_list->StopRec = $documentos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($documentos_list->TotalRecs > $documentos_list->StartRec + $documentos_list->DisplayRecs - 1)
		$documentos_list->StopRec = $documentos_list->StartRec + $documentos_list->DisplayRecs - 1;
	else
		$documentos_list->StopRec = $documentos_list->TotalRecs;
}
$documentos_list->RecCnt = $documentos_list->StartRec - 1;
if ($documentos_list->Recordset && !$documentos_list->Recordset->EOF) {
	$documentos_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $documentos_list->StartRec > 1)
		$documentos_list->Recordset->Move($documentos_list->StartRec - 1);
} elseif (!$documentos->AllowAddDeleteRow && $documentos_list->StopRec == 0) {
	$documentos_list->StopRec = $documentos->GridAddRowCount;
}

// Initialize aggregate
$documentos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$documentos->ResetAttrs();
$documentos_list->RenderRow();
$documentos_list->RowCnt = 0;
while ($documentos_list->RecCnt < $documentos_list->StopRec) {
	$documentos_list->RecCnt++;
	if (intval($documentos_list->RecCnt) >= intval($documentos_list->StartRec)) {
		$documentos_list->RowCnt++;

		// Set up key count
		$documentos_list->KeyCount = $documentos_list->RowIndex;

		// Init row class and style
		$documentos->ResetAttrs();
		$documentos->CssClass = "";
		if ($documentos->CurrentAction == "gridadd") {
		} else {
			$documentos_list->LoadRowValues($documentos_list->Recordset); // Load row values
		}
		$documentos->RowType = EW_ROWTYPE_VIEW; // Render view
		$documentos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$documentos_list->RenderRow();

		// Render list options
		$documentos_list->RenderListOptions();
?>
	<tr<?php echo $documentos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$documentos_list->ListOptions->Render("body", "left");
?>
	<?php if ($documentos->titulo->Visible) { // titulo ?>
		<td<?php echo $documentos->titulo->CellAttributes() ?>>
<div<?php echo $documentos->titulo->ViewAttributes() ?>><?php echo $documentos->titulo->ListViewValue() ?></div>
<a name="<?php echo $documentos_list->PageObjName . "_row_" . $documentos_list->RowCnt ?>" id="<?php echo $documentos_list->PageObjName . "_row_" . $documentos_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($documentos->documento->Visible) { // documento ?>
		<td<?php echo $documentos->documento->CellAttributes() ?>>
<?php if ($documentos->documento->LinkAttributes() <> "") { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<a<?php echo $documentos->documento->LinkAttributes() ?>><?php echo $documentos->documento->ListViewValue() ?></a>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($documentos->documento->Upload->DbValue)) { ?>
<?php echo $documentos->documento->ListViewValue() ?>
<?php } elseif (!in_array($documentos->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($documentos->fecha->Visible) { // fecha ?>
		<td<?php echo $documentos->fecha->CellAttributes() ?>>
<div<?php echo $documentos->fecha->ViewAttributes() ?>><?php echo $documentos->fecha->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($documentos->estatus->Visible) { // estatus ?>
		<td<?php echo $documentos->estatus->CellAttributes() ?>>
<div<?php echo $documentos->estatus->ViewAttributes() ?>><?php echo $documentos->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$documentos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($documentos->CurrentAction <> "gridadd")
		$documentos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($documentos_list->Recordset)
	$documentos_list->Recordset->Close();
?>
<?php if ($documentos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($documentos->CurrentAction <> "gridadd" && $documentos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($documentos_list->Pager)) $documentos_list->Pager = new cPrevNextPager($documentos_list->StartRec, $documentos_list->DisplayRecs, $documentos_list->TotalRecs) ?>
<?php if ($documentos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($documentos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $documentos_list->PageUrl() ?>start=<?php echo $documentos_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($documentos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $documentos_list->PageUrl() ?>start=<?php echo $documentos_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $documentos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($documentos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $documentos_list->PageUrl() ?>start=<?php echo $documentos_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($documentos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $documentos_list->PageUrl() ?>start=<?php echo $documentos_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $documentos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $documentos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $documentos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $documentos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($documentos_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $documentos_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($documentos_secciones->DetailAdd && $Security->AllowAdd('documentos_secciones')) { ?>
<a class="ewGridLink" href="<?php echo $documentos->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=documentos_secciones" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $documentos->TableCaption() ?>/<?php echo $documentos_secciones->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($documentos->Export == "" && $documentos->CurrentAction == "") { ?>
<?php } ?>
<?php
$documentos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($documentos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$documentos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumentos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'documentos';

	// Page object name
	var $PageObjName = 'documentos_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documentos;
		if ($documentos->UseTokenInUrl) $PageUrl .= "t=" . $documentos->TableVar . "&"; // Add page token
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
		global $objForm, $documentos;
		if ($documentos->UseTokenInUrl) {
			if ($objForm)
				return ($documentos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documentos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumentos_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documentos)
		if (!isset($GLOBALS["documentos"])) {
			$GLOBALS["documentos"] = new cdocumentos();
			$GLOBALS["Table"] =& $GLOBALS["documentos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "documentosadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "documentosdelete.php";
		$this->MultiUpdateUrl = "documentosupdate.php";

		// Table object (documentos_secciones)
		if (!isset($GLOBALS['documentos_secciones'])) $GLOBALS['documentos_secciones'] = new cdocumentos_secciones();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documentos', TRUE);

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
		global $documentos;

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
			$documentos->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $documentos;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($documentos->Export <> "" ||
				$documentos->CurrentAction == "gridadd" ||
				$documentos->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$documentos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($documentos->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $documentos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$documentos->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$documentos->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$documentos->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $documentos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$documentos->setSessionWhere($sFilter);
		$documentos->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $documentos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $documentos->titulo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $documentos->sumario, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $documentos->documento, $Keyword);
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
		global $Security, $documentos;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $documentos->BasicSearchKeyword;
		$sSearchType = $documentos->BasicSearchType;
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
			$documentos->setSessionBasicSearchKeyword($sSearchKeyword);
			$documentos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $documentos;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$documentos->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $documentos;
		$documentos->setSessionBasicSearchKeyword("");
		$documentos->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $documentos;
		$bRestore = TRUE;
		if ($documentos->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$documentos->BasicSearchKeyword = $documentos->getSessionBasicSearchKeyword();
			$documentos->BasicSearchType = $documentos->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $documentos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$documentos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$documentos->CurrentOrderType = @$_GET["ordertype"];
			$documentos->UpdateSort($documentos->titulo); // titulo
			$documentos->UpdateSort($documentos->documento); // documento
			$documentos->UpdateSort($documentos->fecha); // fecha
			$documentos->UpdateSort($documentos->estatus); // estatus
			$documentos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $documentos;
		$sOrderBy = $documentos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($documentos->SqlOrderBy() <> "") {
				$sOrderBy = $documentos->SqlOrderBy();
				$documentos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $documentos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$documentos->setSessionOrderBy($sOrderBy);
				$documentos->titulo->setSort("");
				$documentos->documento->setSort("");
				$documentos->fecha->setSort("");
				$documentos->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$documentos->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $documentos;

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

		// "detail_documentos_secciones"
		$item =& $this->ListOptions->Add("detail_documentos_secciones");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('documentos_secciones');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $documentos, $objForm;
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

		// "detail_documentos_secciones"
		$oListOpt =& $this->ListOptions->Items["detail_documentos_secciones"];
		if ($Security->AllowList('documentos_secciones')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("documentos_secciones", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"documentos_seccioneslist.php?" . EW_TABLE_SHOW_MASTER . "=documentos&id_documentos=" . urlencode(strval($documentos->id_documentos->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["documentos_secciones"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit('documentos_secciones'))
				$links .= "<a class=\"ewRowLink\" href=\"" . $documentos->EditUrl(EW_TABLE_SHOW_DETAIL . "=documentos_secciones") . "\">" . $Language->Phrase("EditLink") . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $documentos;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $documentos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$documentos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$documentos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $documentos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$documentos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$documentos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$documentos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $documentos;
		$documentos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$documentos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $documentos;

		// Call Recordset Selecting event
		$documentos->Recordset_Selecting($documentos->CurrentFilter);

		// Load List page SQL
		$sSql = $documentos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$documentos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documentos;
		$sFilter = $documentos->KeyFilter();

		// Call Row Selecting event
		$documentos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documentos->CurrentFilter = $sFilter;
		$sSql = $documentos->SQL();
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
		global $conn, $documentos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documentos->Row_Selected($row);
		$documentos->id_documentos->setDbValue($rs->fields('id_documentos'));
		$documentos->titulo->setDbValue($rs->fields('titulo'));
		$documentos->sumario->setDbValue($rs->fields('sumario'));
		$documentos->documento->Upload->DbValue = $rs->fields('documento');
		$documentos->fecha->setDbValue($rs->fields('fecha'));
		$documentos->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $documentos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($documentos->getKey("id_documentos")) <> "")
			$documentos->id_documentos->CurrentValue = $documentos->getKey("id_documentos"); // id_documentos
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$documentos->CurrentFilter = $documentos->KeyFilter();
			$sSql = $documentos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documentos;

		// Initialize URLs
		$this->ViewUrl = $documentos->ViewUrl();
		$this->EditUrl = $documentos->EditUrl();
		$this->InlineEditUrl = $documentos->InlineEditUrl();
		$this->CopyUrl = $documentos->CopyUrl();
		$this->InlineCopyUrl = $documentos->InlineCopyUrl();
		$this->DeleteUrl = $documentos->DeleteUrl();

		// Call Row_Rendering event
		$documentos->Row_Rendering();

		// Common render codes for all row types
		// id_documentos
		// titulo
		// sumario
		// documento
		// fecha
		// estatus

		if ($documentos->RowType == EW_ROWTYPE_VIEW) { // View row

			// titulo
			$documentos->titulo->ViewValue = $documentos->titulo->CurrentValue;
			$documentos->titulo->ViewCustomAttributes = "";

			// sumario
			$documentos->sumario->ViewValue = $documentos->sumario->CurrentValue;
			$documentos->sumario->ViewCustomAttributes = "";

			// documento
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->ViewValue = $documentos->documento->Upload->DbValue;
			} else {
				$documentos->documento->ViewValue = "";
			}
			$documentos->documento->ViewCustomAttributes = "";

			// fecha
			$documentos->fecha->ViewValue = $documentos->fecha->CurrentValue;
			$documentos->fecha->ViewValue = ew_FormatDateTime($documentos->fecha->ViewValue, 7);
			$documentos->fecha->ViewCustomAttributes = "";

			// estatus
			if (strval($documentos->estatus->CurrentValue) <> "") {
				switch ($documentos->estatus->CurrentValue) {
					case "1":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(1) <> "" ? $documentos->estatus->FldTagCaption(1) : $documentos->estatus->CurrentValue;
						break;
					case "0":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(2) <> "" ? $documentos->estatus->FldTagCaption(2) : $documentos->estatus->CurrentValue;
						break;
					case "3":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(3) <> "" ? $documentos->estatus->FldTagCaption(3) : $documentos->estatus->CurrentValue;
						break;
					case "4":
						$documentos->estatus->ViewValue = $documentos->estatus->FldTagCaption(4) <> "" ? $documentos->estatus->FldTagCaption(4) : $documentos->estatus->CurrentValue;
						break;
					default:
						$documentos->estatus->ViewValue = $documentos->estatus->CurrentValue;
				}
			} else {
				$documentos->estatus->ViewValue = NULL;
			}
			$documentos->estatus->ViewCustomAttributes = "";

			// titulo
			$documentos->titulo->LinkCustomAttributes = "";
			$documentos->titulo->HrefValue = "";
			$documentos->titulo->TooltipValue = "";

			// documento
			$documentos->documento->LinkCustomAttributes = "";
			if (!ew_Empty($documentos->documento->Upload->DbValue)) {
				$documentos->documento->HrefValue = ew_UploadPathEx(FALSE, $documentos->documento->UploadPath) . ((!empty($documentos->documento->ViewValue)) ? $documentos->documento->ViewValue : $documentos->documento->CurrentValue); // Add prefix/suffix
				$documentos->documento->LinkAttrs["target"] = ""; // Add target
				if ($documentos->Export <> "") $documentos->documento->HrefValue = ew_ConvertFullUrl($documentos->documento->HrefValue);
			} else {
				$documentos->documento->HrefValue = "";
			}
			$documentos->documento->TooltipValue = "";

			// fecha
			$documentos->fecha->LinkCustomAttributes = "";
			$documentos->fecha->HrefValue = "";
			$documentos->fecha->TooltipValue = "";

			// estatus
			$documentos->estatus->LinkCustomAttributes = "";
			$documentos->estatus->HrefValue = "";
			$documentos->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($documentos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documentos->Row_Rendered();
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
		$table = 'documentos';
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
