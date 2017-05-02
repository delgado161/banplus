<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "preguntasinfo.php" ?>
<?php include_once "encuestainfo.php" ?>
<?php include_once "respuestasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$preguntas_list = new cpreguntas_list();
$Page =& $preguntas_list;

// Page init
$preguntas_list->Page_Init();

// Page main
$preguntas_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($preguntas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var preguntas_list = new ew_Page("preguntas_list");

// page properties
preguntas_list.PageID = "list"; // page ID
preguntas_list.FormID = "fpreguntaslist"; // form ID
var EW_PAGE_ID = preguntas_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
preguntas_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
preguntas_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
preguntas_list.ValidateRequired = false; // no JavaScript validation
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
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($preguntas->Export == "") || (EW_EXPORT_MASTER_RECORD && $preguntas->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "encuestalist.php";
if ($preguntas_list->DbMasterFilter <> "" && $preguntas->getCurrentMasterTable() == "encuesta") {
	if ($preguntas_list->MasterRecordExists) {
		if ($preguntas->getCurrentMasterTable() == $preguntas->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $encuesta->TableCaption() ?>
&nbsp;&nbsp;<?php $preguntas_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($preguntas->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "encuestamaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$preguntas_list->TotalRecs = $preguntas->SelectRecordCount();
	} else {
		if ($preguntas_list->Recordset = $preguntas_list->LoadRecordset())
			$preguntas_list->TotalRecs = $preguntas_list->Recordset->RecordCount();
	}
	$preguntas_list->StartRec = 1;
	if ($preguntas_list->DisplayRecs <= 0 || ($preguntas->Export <> "" && $preguntas->ExportAll)) // Display all records
		$preguntas_list->DisplayRecs = $preguntas_list->TotalRecs;
	if (!($preguntas->Export <> "" && $preguntas->ExportAll))
		$preguntas_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$preguntas_list->Recordset = $preguntas_list->LoadRecordset($preguntas_list->StartRec-1, $preguntas_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $preguntas->TableCaption() ?>
<?php if ($preguntas->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $preguntas_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($preguntas->Export == "" && $preguntas->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(preguntas_list);" style="text-decoration: none;"><img id="preguntas_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="preguntas_list_SearchPanel">
<form name="fpreguntaslistsrch" id="fpreguntaslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="preguntas">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($preguntas->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $preguntas_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($preguntas->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($preguntas->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($preguntas->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $preguntas_list->ShowPageHeader(); ?>
<?php
$preguntas_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fpreguntaslist" id="fpreguntaslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="preguntas">
<div id="gmp_preguntas" class="ewGridMiddlePanel">
<?php if ($preguntas_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $preguntas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$preguntas_list->RenderListOptions();

// Render list options (header, left)
$preguntas_list->ListOptions->Render("header", "left");
?>
<?php if ($preguntas->id_encuesta->Visible) { // id_encuesta ?>
	<?php if ($preguntas->SortUrl($preguntas->id_encuesta) == "") { ?>
		<td><?php echo $preguntas->id_encuesta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $preguntas->SortUrl($preguntas->id_encuesta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $preguntas->id_encuesta->FldCaption() ?></td><td style="width: 10px;"><?php if ($preguntas->id_encuesta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($preguntas->id_encuesta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($preguntas->pregunta->Visible) { // pregunta ?>
	<?php if ($preguntas->SortUrl($preguntas->pregunta) == "") { ?>
		<td><?php echo $preguntas->pregunta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $preguntas->SortUrl($preguntas->pregunta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $preguntas->pregunta->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($preguntas->pregunta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($preguntas->pregunta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($preguntas->estatus->Visible) { // estatus ?>
	<?php if ($preguntas->SortUrl($preguntas->estatus) == "") { ?>
		<td><?php echo $preguntas->estatus->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $preguntas->SortUrl($preguntas->estatus) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $preguntas->estatus->FldCaption() ?></td><td style="width: 10px;"><?php if ($preguntas->estatus->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($preguntas->estatus->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$preguntas_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($preguntas->ExportAll && $preguntas->Export <> "") {
	$preguntas_list->StopRec = $preguntas_list->TotalRecs;
} else {

	// Set the last record to display
	if ($preguntas_list->TotalRecs > $preguntas_list->StartRec + $preguntas_list->DisplayRecs - 1)
		$preguntas_list->StopRec = $preguntas_list->StartRec + $preguntas_list->DisplayRecs - 1;
	else
		$preguntas_list->StopRec = $preguntas_list->TotalRecs;
}
$preguntas_list->RecCnt = $preguntas_list->StartRec - 1;
if ($preguntas_list->Recordset && !$preguntas_list->Recordset->EOF) {
	$preguntas_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $preguntas_list->StartRec > 1)
		$preguntas_list->Recordset->Move($preguntas_list->StartRec - 1);
} elseif (!$preguntas->AllowAddDeleteRow && $preguntas_list->StopRec == 0) {
	$preguntas_list->StopRec = $preguntas->GridAddRowCount;
}

// Initialize aggregate
$preguntas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$preguntas->ResetAttrs();
$preguntas_list->RenderRow();
$preguntas_list->RowCnt = 0;
while ($preguntas_list->RecCnt < $preguntas_list->StopRec) {
	$preguntas_list->RecCnt++;
	if (intval($preguntas_list->RecCnt) >= intval($preguntas_list->StartRec)) {
		$preguntas_list->RowCnt++;

		// Set up key count
		$preguntas_list->KeyCount = $preguntas_list->RowIndex;

		// Init row class and style
		$preguntas->ResetAttrs();
		$preguntas->CssClass = "";
		if ($preguntas->CurrentAction == "gridadd") {
		} else {
			$preguntas_list->LoadRowValues($preguntas_list->Recordset); // Load row values
		}
		$preguntas->RowType = EW_ROWTYPE_VIEW; // Render view
		$preguntas->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$preguntas_list->RenderRow();

		// Render list options
		$preguntas_list->RenderListOptions();
?>
	<tr<?php echo $preguntas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$preguntas_list->ListOptions->Render("body", "left");
?>
	<?php if ($preguntas->id_encuesta->Visible) { // id_encuesta ?>
		<td<?php echo $preguntas->id_encuesta->CellAttributes() ?>>
<div<?php echo $preguntas->id_encuesta->ViewAttributes() ?>><?php echo $preguntas->id_encuesta->ListViewValue() ?></div>
<a name="<?php echo $preguntas_list->PageObjName . "_row_" . $preguntas_list->RowCnt ?>" id="<?php echo $preguntas_list->PageObjName . "_row_" . $preguntas_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($preguntas->pregunta->Visible) { // pregunta ?>
		<td<?php echo $preguntas->pregunta->CellAttributes() ?>>
<div<?php echo $preguntas->pregunta->ViewAttributes() ?>><?php echo $preguntas->pregunta->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($preguntas->estatus->Visible) { // estatus ?>
		<td<?php echo $preguntas->estatus->CellAttributes() ?>>
<div<?php echo $preguntas->estatus->ViewAttributes() ?>><?php echo $preguntas->estatus->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$preguntas_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($preguntas->CurrentAction <> "gridadd")
		$preguntas_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($preguntas_list->Recordset)
	$preguntas_list->Recordset->Close();
?>
<?php if ($preguntas->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($preguntas->CurrentAction <> "gridadd" && $preguntas->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($preguntas_list->Pager)) $preguntas_list->Pager = new cPrevNextPager($preguntas_list->StartRec, $preguntas_list->DisplayRecs, $preguntas_list->TotalRecs) ?>
<?php if ($preguntas_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($preguntas_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $preguntas_list->PageUrl() ?>start=<?php echo $preguntas_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($preguntas_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $preguntas_list->PageUrl() ?>start=<?php echo $preguntas_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $preguntas_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($preguntas_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $preguntas_list->PageUrl() ?>start=<?php echo $preguntas_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($preguntas_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $preguntas_list->PageUrl() ?>start=<?php echo $preguntas_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $preguntas_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $preguntas_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $preguntas_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $preguntas_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($preguntas_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $preguntas_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($respuestas->DetailAdd && $Security->AllowAdd('respuestas')) { ?>
<a class="ewGridLink" href="<?php echo $preguntas->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=respuestas" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $preguntas->TableCaption() ?>/<?php echo $respuestas->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($preguntas->Export == "" && $preguntas->CurrentAction == "") { ?>
<?php } ?>
<?php
$preguntas_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($preguntas->Export == "") { ?>
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
$preguntas_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpreguntas_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'preguntas';

	// Page object name
	var $PageObjName = 'preguntas_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $preguntas;
		if ($preguntas->UseTokenInUrl) $PageUrl .= "t=" . $preguntas->TableVar . "&"; // Add page token
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
		global $objForm, $preguntas;
		if ($preguntas->UseTokenInUrl) {
			if ($objForm)
				return ($preguntas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($preguntas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpreguntas_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (preguntas)
		if (!isset($GLOBALS["preguntas"])) {
			$GLOBALS["preguntas"] = new cpreguntas();
			$GLOBALS["Table"] =& $GLOBALS["preguntas"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "preguntasadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "preguntasdelete.php";
		$this->MultiUpdateUrl = "preguntasupdate.php";

		// Table object (encuesta)
		if (!isset($GLOBALS['encuesta'])) $GLOBALS['encuesta'] = new cencuesta();

		// Table object (respuestas)
		if (!isset($GLOBALS['respuestas'])) $GLOBALS['respuestas'] = new crespuestas();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'preguntas', TRUE);

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
		global $preguntas;

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
			$preguntas->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $preguntas;

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
			if ($preguntas->Export <> "" ||
				$preguntas->CurrentAction == "gridadd" ||
				$preguntas->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$preguntas->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($preguntas->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $preguntas->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$preguntas->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$preguntas->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$preguntas->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $preguntas->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $preguntas->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $preguntas->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($preguntas->getMasterFilter() <> "" && $preguntas->getCurrentMasterTable() == "encuesta") {
			global $encuesta;
			$rsmaster = $encuesta->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($preguntas->getReturnUrl()); // Return to caller
			} else {
				$encuesta->LoadListRowValues($rsmaster);
				$encuesta->RowType = EW_ROWTYPE_MASTER; // Master row
				$encuesta->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$preguntas->setSessionWhere($sFilter);
		$preguntas->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $preguntas;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $preguntas->pregunta, $Keyword);
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
		global $Security, $preguntas;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $preguntas->BasicSearchKeyword;
		$sSearchType = $preguntas->BasicSearchType;
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
			$preguntas->setSessionBasicSearchKeyword($sSearchKeyword);
			$preguntas->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $preguntas;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$preguntas->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $preguntas;
		$preguntas->setSessionBasicSearchKeyword("");
		$preguntas->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $preguntas;
		$bRestore = TRUE;
		if ($preguntas->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$preguntas->BasicSearchKeyword = $preguntas->getSessionBasicSearchKeyword();
			$preguntas->BasicSearchType = $preguntas->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $preguntas;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$preguntas->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$preguntas->CurrentOrderType = @$_GET["ordertype"];
			$preguntas->UpdateSort($preguntas->id_encuesta); // id_encuesta
			$preguntas->UpdateSort($preguntas->pregunta); // pregunta
			$preguntas->UpdateSort($preguntas->estatus); // estatus
			$preguntas->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $preguntas;
		$sOrderBy = $preguntas->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($preguntas->SqlOrderBy() <> "") {
				$sOrderBy = $preguntas->SqlOrderBy();
				$preguntas->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $preguntas;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$preguntas->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$preguntas->id_encuesta->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$preguntas->setSessionOrderBy($sOrderBy);
				$preguntas->id_encuesta->setSort("");
				$preguntas->pregunta->setSort("");
				$preguntas->estatus->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$preguntas->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $preguntas;

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

		// "detail_respuestas"
		$item =& $this->ListOptions->Add("detail_respuestas");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('respuestas');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $preguntas, $objForm;
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

		// "detail_respuestas"
		$oListOpt =& $this->ListOptions->Items["detail_respuestas"];
		if ($Security->AllowList('respuestas')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("respuestas", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"respuestaslist.php?" . EW_TABLE_SHOW_MASTER . "=preguntas&id_pregunta=" . urlencode(strval($preguntas->id_pregunta->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["respuestas"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit('respuestas'))
				$links .= "<a class=\"ewRowLink\" href=\"" . $preguntas->EditUrl(EW_TABLE_SHOW_DETAIL . "=respuestas") . "\">" . $Language->Phrase("EditLink") . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $preguntas;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $preguntas;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$preguntas->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$preguntas->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $preguntas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$preguntas->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$preguntas->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$preguntas->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $preguntas;
		$preguntas->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$preguntas->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $preguntas;

		// Call Recordset Selecting event
		$preguntas->Recordset_Selecting($preguntas->CurrentFilter);

		// Load List page SQL
		$sSql = $preguntas->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$preguntas->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $preguntas;
		$sFilter = $preguntas->KeyFilter();

		// Call Row Selecting event
		$preguntas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$preguntas->CurrentFilter = $sFilter;
		$sSql = $preguntas->SQL();
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
		global $conn, $preguntas;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$preguntas->Row_Selected($row);
		$preguntas->id_pregunta->setDbValue($rs->fields('id_pregunta'));
		$preguntas->id_encuesta->setDbValue($rs->fields('id_encuesta'));
		$preguntas->pregunta->setDbValue($rs->fields('pregunta'));
		$preguntas->estatus->setDbValue($rs->fields('estatus'));
	}

	// Load old record
	function LoadOldRecord() {
		global $preguntas;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($preguntas->getKey("id_pregunta")) <> "")
			$preguntas->id_pregunta->CurrentValue = $preguntas->getKey("id_pregunta"); // id_pregunta
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$preguntas->CurrentFilter = $preguntas->KeyFilter();
			$sSql = $preguntas->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $preguntas;

		// Initialize URLs
		$this->ViewUrl = $preguntas->ViewUrl();
		$this->EditUrl = $preguntas->EditUrl();
		$this->InlineEditUrl = $preguntas->InlineEditUrl();
		$this->CopyUrl = $preguntas->CopyUrl();
		$this->InlineCopyUrl = $preguntas->InlineCopyUrl();
		$this->DeleteUrl = $preguntas->DeleteUrl();

		// Call Row_Rendering event
		$preguntas->Row_Rendering();

		// Common render codes for all row types
		// id_pregunta
		// id_encuesta
		// pregunta
		// estatus

		if ($preguntas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_encuesta
			if (strval($preguntas->id_encuesta->CurrentValue) <> "") {
				$sFilterWrk = "`id_encuesta` = " . ew_AdjustSql($preguntas->id_encuesta->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `encuesta`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$preguntas->id_encuesta->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$preguntas->id_encuesta->ViewValue = $preguntas->id_encuesta->CurrentValue;
				}
			} else {
				$preguntas->id_encuesta->ViewValue = NULL;
			}
			$preguntas->id_encuesta->ViewCustomAttributes = "";

			// pregunta
			$preguntas->pregunta->ViewValue = $preguntas->pregunta->CurrentValue;
			$preguntas->pregunta->ViewCustomAttributes = "";

			// estatus
			if (strval($preguntas->estatus->CurrentValue) <> "") {
				switch ($preguntas->estatus->CurrentValue) {
					case "1":
						$preguntas->estatus->ViewValue = $preguntas->estatus->FldTagCaption(1) <> "" ? $preguntas->estatus->FldTagCaption(1) : $preguntas->estatus->CurrentValue;
						break;
					case "0":
						$preguntas->estatus->ViewValue = $preguntas->estatus->FldTagCaption(2) <> "" ? $preguntas->estatus->FldTagCaption(2) : $preguntas->estatus->CurrentValue;
						break;
					default:
						$preguntas->estatus->ViewValue = $preguntas->estatus->CurrentValue;
				}
			} else {
				$preguntas->estatus->ViewValue = NULL;
			}
			$preguntas->estatus->ViewCustomAttributes = "";

			// id_encuesta
			$preguntas->id_encuesta->LinkCustomAttributes = "";
			$preguntas->id_encuesta->HrefValue = "";
			$preguntas->id_encuesta->TooltipValue = "";

			// pregunta
			$preguntas->pregunta->LinkCustomAttributes = "";
			$preguntas->pregunta->HrefValue = "";
			$preguntas->pregunta->TooltipValue = "";

			// estatus
			$preguntas->estatus->LinkCustomAttributes = "";
			$preguntas->estatus->HrefValue = "";
			$preguntas->estatus->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($preguntas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$preguntas->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $preguntas;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "encuesta") {
				$bValidMaster = TRUE;
				if (@$_GET["id_encuesta"] <> "") {
					$GLOBALS["encuesta"]->id_encuesta->setQueryStringValue($_GET["id_encuesta"]);
					$preguntas->id_encuesta->setQueryStringValue($GLOBALS["encuesta"]->id_encuesta->QueryStringValue);
					$preguntas->id_encuesta->setSessionValue($preguntas->id_encuesta->QueryStringValue);
					if (!is_numeric($GLOBALS["encuesta"]->id_encuesta->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$preguntas->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$preguntas->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "encuesta") {
				if ($preguntas->id_encuesta->QueryStringValue == "") $preguntas->id_encuesta->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $preguntas->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $preguntas->getDetailFilter(); // Get detail filter
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
		$table = 'preguntas';
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
