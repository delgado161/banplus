<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "z_codigo_postalinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$z_codigo_postal_list = new cz_codigo_postal_list();
$Page =& $z_codigo_postal_list;

// Page init
$z_codigo_postal_list->Page_Init();

// Page main
$z_codigo_postal_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($z_codigo_postal->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var z_codigo_postal_list = new ew_Page("z_codigo_postal_list");

// page properties
z_codigo_postal_list.PageID = "list"; // page ID
z_codigo_postal_list.FormID = "fz_codigo_postallist"; // form ID
var EW_PAGE_ID = z_codigo_postal_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
z_codigo_postal_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
z_codigo_postal_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
z_codigo_postal_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($z_codigo_postal->Export == "") || (EW_EXPORT_MASTER_RECORD && $z_codigo_postal->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$z_codigo_postal_list->TotalRecs = $z_codigo_postal->SelectRecordCount();
	} else {
		if ($z_codigo_postal_list->Recordset = $z_codigo_postal_list->LoadRecordset())
			$z_codigo_postal_list->TotalRecs = $z_codigo_postal_list->Recordset->RecordCount();
	}
	$z_codigo_postal_list->StartRec = 1;
	if ($z_codigo_postal_list->DisplayRecs <= 0 || ($z_codigo_postal->Export <> "" && $z_codigo_postal->ExportAll)) // Display all records
		$z_codigo_postal_list->DisplayRecs = $z_codigo_postal_list->TotalRecs;
	if (!($z_codigo_postal->Export <> "" && $z_codigo_postal->ExportAll))
		$z_codigo_postal_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$z_codigo_postal_list->Recordset = $z_codigo_postal_list->LoadRecordset($z_codigo_postal_list->StartRec-1, $z_codigo_postal_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $z_codigo_postal->TableCaption() ?>
&nbsp;&nbsp;<?php $z_codigo_postal_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($z_codigo_postal->Export == "" && $z_codigo_postal->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(z_codigo_postal_list);" style="text-decoration: none;"><img id="z_codigo_postal_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="z_codigo_postal_list_SearchPanel">
<form name="fz_codigo_postallistsrch" id="fz_codigo_postallistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="z_codigo_postal">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($z_codigo_postal->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $z_codigo_postal_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($z_codigo_postal->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($z_codigo_postal->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($z_codigo_postal->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php $z_codigo_postal_list->ShowPageHeader(); ?>
<?php
$z_codigo_postal_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fz_codigo_postallist" id="fz_codigo_postallist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="z_codigo_postal">
<div id="gmp_z_codigo_postal" class="ewGridMiddlePanel">
<?php if ($z_codigo_postal_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $z_codigo_postal->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$z_codigo_postal_list->RenderListOptions();

// Render list options (header, left)
$z_codigo_postal_list->ListOptions->Render("header", "left");
?>
<?php if ($z_codigo_postal->id_codigo_postal->Visible) { // id_codigo_postal ?>
	<?php if ($z_codigo_postal->SortUrl($z_codigo_postal->id_codigo_postal) == "") { ?>
		<td><?php echo $z_codigo_postal->id_codigo_postal->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_codigo_postal->SortUrl($z_codigo_postal->id_codigo_postal) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_codigo_postal->id_codigo_postal->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_codigo_postal->id_codigo_postal->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_codigo_postal->id_codigo_postal->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_codigo_postal->codigo->Visible) { // codigo ?>
	<?php if ($z_codigo_postal->SortUrl($z_codigo_postal->codigo) == "") { ?>
		<td><?php echo $z_codigo_postal->codigo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_codigo_postal->SortUrl($z_codigo_postal->codigo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_codigo_postal->codigo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($z_codigo_postal->codigo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_codigo_postal->codigo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_codigo_postal->Descripcion->Visible) { // Descripcion ?>
	<?php if ($z_codigo_postal->SortUrl($z_codigo_postal->Descripcion) == "") { ?>
		<td><?php echo $z_codigo_postal->Descripcion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_codigo_postal->SortUrl($z_codigo_postal->Descripcion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_codigo_postal->Descripcion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($z_codigo_postal->Descripcion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_codigo_postal->Descripcion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($z_codigo_postal->visibilidad->Visible) { // visibilidad ?>
	<?php if ($z_codigo_postal->SortUrl($z_codigo_postal->visibilidad) == "") { ?>
		<td><?php echo $z_codigo_postal->visibilidad->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $z_codigo_postal->SortUrl($z_codigo_postal->visibilidad) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $z_codigo_postal->visibilidad->FldCaption() ?></td><td style="width: 10px;"><?php if ($z_codigo_postal->visibilidad->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($z_codigo_postal->visibilidad->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$z_codigo_postal_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($z_codigo_postal->ExportAll && $z_codigo_postal->Export <> "") {
	$z_codigo_postal_list->StopRec = $z_codigo_postal_list->TotalRecs;
} else {

	// Set the last record to display
	if ($z_codigo_postal_list->TotalRecs > $z_codigo_postal_list->StartRec + $z_codigo_postal_list->DisplayRecs - 1)
		$z_codigo_postal_list->StopRec = $z_codigo_postal_list->StartRec + $z_codigo_postal_list->DisplayRecs - 1;
	else
		$z_codigo_postal_list->StopRec = $z_codigo_postal_list->TotalRecs;
}
$z_codigo_postal_list->RecCnt = $z_codigo_postal_list->StartRec - 1;
if ($z_codigo_postal_list->Recordset && !$z_codigo_postal_list->Recordset->EOF) {
	$z_codigo_postal_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $z_codigo_postal_list->StartRec > 1)
		$z_codigo_postal_list->Recordset->Move($z_codigo_postal_list->StartRec - 1);
} elseif (!$z_codigo_postal->AllowAddDeleteRow && $z_codigo_postal_list->StopRec == 0) {
	$z_codigo_postal_list->StopRec = $z_codigo_postal->GridAddRowCount;
}

// Initialize aggregate
$z_codigo_postal->RowType = EW_ROWTYPE_AGGREGATEINIT;
$z_codigo_postal->ResetAttrs();
$z_codigo_postal_list->RenderRow();
$z_codigo_postal_list->RowCnt = 0;
while ($z_codigo_postal_list->RecCnt < $z_codigo_postal_list->StopRec) {
	$z_codigo_postal_list->RecCnt++;
	if (intval($z_codigo_postal_list->RecCnt) >= intval($z_codigo_postal_list->StartRec)) {
		$z_codigo_postal_list->RowCnt++;

		// Set up key count
		$z_codigo_postal_list->KeyCount = $z_codigo_postal_list->RowIndex;

		// Init row class and style
		$z_codigo_postal->ResetAttrs();
		$z_codigo_postal->CssClass = "";
		if ($z_codigo_postal->CurrentAction == "gridadd") {
		} else {
			$z_codigo_postal_list->LoadRowValues($z_codigo_postal_list->Recordset); // Load row values
		}
		$z_codigo_postal->RowType = EW_ROWTYPE_VIEW; // Render view
		$z_codigo_postal->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$z_codigo_postal_list->RenderRow();

		// Render list options
		$z_codigo_postal_list->RenderListOptions();
?>
	<tr<?php echo $z_codigo_postal->RowAttributes() ?>>
<?php

// Render list options (body, left)
$z_codigo_postal_list->ListOptions->Render("body", "left");
?>
	<?php if ($z_codigo_postal->id_codigo_postal->Visible) { // id_codigo_postal ?>
		<td<?php echo $z_codigo_postal->id_codigo_postal->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->id_codigo_postal->ViewAttributes() ?>><?php echo $z_codigo_postal->id_codigo_postal->ListViewValue() ?></div>
<a name="<?php echo $z_codigo_postal_list->PageObjName . "_row_" . $z_codigo_postal_list->RowCnt ?>" id="<?php echo $z_codigo_postal_list->PageObjName . "_row_" . $z_codigo_postal_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($z_codigo_postal->codigo->Visible) { // codigo ?>
		<td<?php echo $z_codigo_postal->codigo->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->codigo->ViewAttributes() ?>><?php echo $z_codigo_postal->codigo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_codigo_postal->Descripcion->Visible) { // Descripcion ?>
		<td<?php echo $z_codigo_postal->Descripcion->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->Descripcion->ViewAttributes() ?>><?php echo $z_codigo_postal->Descripcion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($z_codigo_postal->visibilidad->Visible) { // visibilidad ?>
		<td<?php echo $z_codigo_postal->visibilidad->CellAttributes() ?>>
<div<?php echo $z_codigo_postal->visibilidad->ViewAttributes() ?>><?php echo $z_codigo_postal->visibilidad->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$z_codigo_postal_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($z_codigo_postal->CurrentAction <> "gridadd")
		$z_codigo_postal_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($z_codigo_postal_list->Recordset)
	$z_codigo_postal_list->Recordset->Close();
?>
<?php if ($z_codigo_postal->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($z_codigo_postal->CurrentAction <> "gridadd" && $z_codigo_postal->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($z_codigo_postal_list->Pager)) $z_codigo_postal_list->Pager = new cPrevNextPager($z_codigo_postal_list->StartRec, $z_codigo_postal_list->DisplayRecs, $z_codigo_postal_list->TotalRecs) ?>
<?php if ($z_codigo_postal_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($z_codigo_postal_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $z_codigo_postal_list->PageUrl() ?>start=<?php echo $z_codigo_postal_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($z_codigo_postal_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $z_codigo_postal_list->PageUrl() ?>start=<?php echo $z_codigo_postal_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $z_codigo_postal_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($z_codigo_postal_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $z_codigo_postal_list->PageUrl() ?>start=<?php echo $z_codigo_postal_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($z_codigo_postal_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $z_codigo_postal_list->PageUrl() ?>start=<?php echo $z_codigo_postal_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $z_codigo_postal_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $z_codigo_postal_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $z_codigo_postal_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $z_codigo_postal_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($z_codigo_postal_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $z_codigo_postal_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($z_codigo_postal->Export == "" && $z_codigo_postal->CurrentAction == "") { ?>
<?php } ?>
<?php
$z_codigo_postal_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($z_codigo_postal->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$z_codigo_postal_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cz_codigo_postal_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = '_codigo_postal';

	// Page object name
	var $PageObjName = 'z_codigo_postal_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $z_codigo_postal;
		if ($z_codigo_postal->UseTokenInUrl) $PageUrl .= "t=" . $z_codigo_postal->TableVar . "&"; // Add page token
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
		global $objForm, $z_codigo_postal;
		if ($z_codigo_postal->UseTokenInUrl) {
			if ($objForm)
				return ($z_codigo_postal->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($z_codigo_postal->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cz_codigo_postal_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (z_codigo_postal)
		if (!isset($GLOBALS["z_codigo_postal"])) {
			$GLOBALS["z_codigo_postal"] = new cz_codigo_postal();
			$GLOBALS["Table"] =& $GLOBALS["z_codigo_postal"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "z_codigo_postaladd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "z_codigo_postaldelete.php";
		$this->MultiUpdateUrl = "z_codigo_postalupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", '_codigo_postal', TRUE);

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
		global $z_codigo_postal;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$z_codigo_postal->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $z_codigo_postal;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($z_codigo_postal->Export <> "" ||
				$z_codigo_postal->CurrentAction == "gridadd" ||
				$z_codigo_postal->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$z_codigo_postal->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($z_codigo_postal->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $z_codigo_postal->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$z_codigo_postal->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$z_codigo_postal->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$z_codigo_postal->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $z_codigo_postal->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$z_codigo_postal->setSessionWhere($sFilter);
		$z_codigo_postal->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $z_codigo_postal;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $z_codigo_postal->codigo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $z_codigo_postal->Descripcion, $Keyword);
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
		global $Security, $z_codigo_postal;
		$sSearchStr = "";
		$sSearchKeyword = $z_codigo_postal->BasicSearchKeyword;
		$sSearchType = $z_codigo_postal->BasicSearchType;
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
			$z_codigo_postal->setSessionBasicSearchKeyword($sSearchKeyword);
			$z_codigo_postal->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $z_codigo_postal;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$z_codigo_postal->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $z_codigo_postal;
		$z_codigo_postal->setSessionBasicSearchKeyword("");
		$z_codigo_postal->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $z_codigo_postal;
		$bRestore = TRUE;
		if ($z_codigo_postal->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$z_codigo_postal->BasicSearchKeyword = $z_codigo_postal->getSessionBasicSearchKeyword();
			$z_codigo_postal->BasicSearchType = $z_codigo_postal->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $z_codigo_postal;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$z_codigo_postal->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$z_codigo_postal->CurrentOrderType = @$_GET["ordertype"];
			$z_codigo_postal->UpdateSort($z_codigo_postal->id_codigo_postal); // id_codigo_postal
			$z_codigo_postal->UpdateSort($z_codigo_postal->codigo); // codigo
			$z_codigo_postal->UpdateSort($z_codigo_postal->Descripcion); // Descripcion
			$z_codigo_postal->UpdateSort($z_codigo_postal->visibilidad); // visibilidad
			$z_codigo_postal->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $z_codigo_postal;
		$sOrderBy = $z_codigo_postal->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($z_codigo_postal->SqlOrderBy() <> "") {
				$sOrderBy = $z_codigo_postal->SqlOrderBy();
				$z_codigo_postal->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $z_codigo_postal;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$z_codigo_postal->setSessionOrderBy($sOrderBy);
				$z_codigo_postal->id_codigo_postal->setSort("");
				$z_codigo_postal->codigo->setSort("");
				$z_codigo_postal->Descripcion->setSort("");
				$z_codigo_postal->visibilidad->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$z_codigo_postal->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $z_codigo_postal;

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
		global $Security, $Language, $z_codigo_postal, $objForm;
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
		global $Security, $Language, $z_codigo_postal;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $z_codigo_postal;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$z_codigo_postal->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$z_codigo_postal->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $z_codigo_postal->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$z_codigo_postal->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$z_codigo_postal->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$z_codigo_postal->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $z_codigo_postal;
		$z_codigo_postal->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$z_codigo_postal->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $z_codigo_postal;

		// Call Recordset Selecting event
		$z_codigo_postal->Recordset_Selecting($z_codigo_postal->CurrentFilter);

		// Load List page SQL
		$sSql = $z_codigo_postal->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$z_codigo_postal->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $z_codigo_postal;
		$sFilter = $z_codigo_postal->KeyFilter();

		// Call Row Selecting event
		$z_codigo_postal->Row_Selecting($sFilter);

		// Load SQL based on filter
		$z_codigo_postal->CurrentFilter = $sFilter;
		$sSql = $z_codigo_postal->SQL();
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
		global $conn, $z_codigo_postal;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$z_codigo_postal->Row_Selected($row);
		$z_codigo_postal->id_codigo_postal->setDbValue($rs->fields('id_codigo_postal'));
		$z_codigo_postal->codigo->setDbValue($rs->fields('codigo'));
		$z_codigo_postal->Descripcion->setDbValue($rs->fields('Descripcion'));
		$z_codigo_postal->visibilidad->setDbValue($rs->fields('visibilidad'));
	}

	// Load old record
	function LoadOldRecord() {
		global $z_codigo_postal;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($z_codigo_postal->getKey("id_codigo_postal")) <> "")
			$z_codigo_postal->id_codigo_postal->CurrentValue = $z_codigo_postal->getKey("id_codigo_postal"); // id_codigo_postal
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$z_codigo_postal->CurrentFilter = $z_codigo_postal->KeyFilter();
			$sSql = $z_codigo_postal->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $z_codigo_postal;

		// Initialize URLs
		$this->ViewUrl = $z_codigo_postal->ViewUrl();
		$this->EditUrl = $z_codigo_postal->EditUrl();
		$this->InlineEditUrl = $z_codigo_postal->InlineEditUrl();
		$this->CopyUrl = $z_codigo_postal->CopyUrl();
		$this->InlineCopyUrl = $z_codigo_postal->InlineCopyUrl();
		$this->DeleteUrl = $z_codigo_postal->DeleteUrl();

		// Call Row_Rendering event
		$z_codigo_postal->Row_Rendering();

		// Common render codes for all row types
		// id_codigo_postal
		// codigo
		// Descripcion
		// visibilidad

		if ($z_codigo_postal->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_codigo_postal
			$z_codigo_postal->id_codigo_postal->ViewValue = $z_codigo_postal->id_codigo_postal->CurrentValue;
			$z_codigo_postal->id_codigo_postal->ViewCustomAttributes = "";

			// codigo
			$z_codigo_postal->codigo->ViewValue = $z_codigo_postal->codigo->CurrentValue;
			$z_codigo_postal->codigo->ViewCustomAttributes = "";

			// Descripcion
			$z_codigo_postal->Descripcion->ViewValue = $z_codigo_postal->Descripcion->CurrentValue;
			$z_codigo_postal->Descripcion->ViewCustomAttributes = "";

			// visibilidad
			if (strval($z_codigo_postal->visibilidad->CurrentValue) <> "") {
				switch ($z_codigo_postal->visibilidad->CurrentValue) {
					case "1":
						$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->FldTagCaption(1) <> "" ? $z_codigo_postal->visibilidad->FldTagCaption(1) : $z_codigo_postal->visibilidad->CurrentValue;
						break;
					case "0":
						$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->FldTagCaption(2) <> "" ? $z_codigo_postal->visibilidad->FldTagCaption(2) : $z_codigo_postal->visibilidad->CurrentValue;
						break;
					default:
						$z_codigo_postal->visibilidad->ViewValue = $z_codigo_postal->visibilidad->CurrentValue;
				}
			} else {
				$z_codigo_postal->visibilidad->ViewValue = NULL;
			}
			$z_codigo_postal->visibilidad->ViewCustomAttributes = "";

			// id_codigo_postal
			$z_codigo_postal->id_codigo_postal->LinkCustomAttributes = "";
			$z_codigo_postal->id_codigo_postal->HrefValue = "";
			$z_codigo_postal->id_codigo_postal->TooltipValue = "";

			// codigo
			$z_codigo_postal->codigo->LinkCustomAttributes = "";
			$z_codigo_postal->codigo->HrefValue = "";
			$z_codigo_postal->codigo->TooltipValue = "";

			// Descripcion
			$z_codigo_postal->Descripcion->LinkCustomAttributes = "";
			$z_codigo_postal->Descripcion->HrefValue = "";
			$z_codigo_postal->Descripcion->TooltipValue = "";

			// visibilidad
			$z_codigo_postal->visibilidad->LinkCustomAttributes = "";
			$z_codigo_postal->visibilidad->HrefValue = "";
			$z_codigo_postal->visibilidad->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($z_codigo_postal->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$z_codigo_postal->Row_Rendered();
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
