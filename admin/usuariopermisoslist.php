<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariopermisosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuariopermisos_list = new cusuariopermisos_list();
$Page =& $usuariopermisos_list;

// Page init
$usuariopermisos_list->Page_Init();

// Page main
$usuariopermisos_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuariopermisos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuariopermisos_list = new ew_Page("usuariopermisos_list");

// page properties
usuariopermisos_list.PageID = "list"; // page ID
usuariopermisos_list.FormID = "fusuariopermisoslist"; // form ID
var EW_PAGE_ID = usuariopermisos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuariopermisos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuariopermisos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuariopermisos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($usuariopermisos->Export == "") || (EW_EXPORT_MASTER_RECORD && $usuariopermisos->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$usuariopermisos_list->TotalRecs = $usuariopermisos->SelectRecordCount();
	} else {
		if ($usuariopermisos_list->Recordset = $usuariopermisos_list->LoadRecordset())
			$usuariopermisos_list->TotalRecs = $usuariopermisos_list->Recordset->RecordCount();
	}
	$usuariopermisos_list->StartRec = 1;
	if ($usuariopermisos_list->DisplayRecs <= 0 || ($usuariopermisos->Export <> "" && $usuariopermisos->ExportAll)) // Display all records
		$usuariopermisos_list->DisplayRecs = $usuariopermisos_list->TotalRecs;
	if (!($usuariopermisos->Export <> "" && $usuariopermisos->ExportAll))
		$usuariopermisos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$usuariopermisos_list->Recordset = $usuariopermisos_list->LoadRecordset($usuariopermisos_list->StartRec-1, $usuariopermisos_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuariopermisos->TableCaption() ?>
&nbsp;&nbsp;<?php $usuariopermisos_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($usuariopermisos->Export == "" && $usuariopermisos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(usuariopermisos_list);" style="text-decoration: none;"><img id="usuariopermisos_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="usuariopermisos_list_SearchPanel">
<form name="fusuariopermisoslistsrch" id="fusuariopermisoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="usuariopermisos">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($usuariopermisos->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $usuariopermisos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($usuariopermisos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($usuariopermisos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($usuariopermisos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $usuariopermisos_list->ShowPageHeader(); ?>
<?php
$usuariopermisos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fusuariopermisoslist" id="fusuariopermisoslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="usuariopermisos">
<div id="gmp_usuariopermisos" class="ewGridMiddlePanel">
<?php if ($usuariopermisos_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $usuariopermisos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$usuariopermisos_list->RenderListOptions();

// Render list options (header, left)
$usuariopermisos_list->ListOptions->Render("header", "left");
?>
<?php if ($usuariopermisos->userlevelid->Visible) { // userlevelid ?>
	<?php if ($usuariopermisos->SortUrl($usuariopermisos->userlevelid) == "") { ?>
		<td><?php echo $usuariopermisos->userlevelid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuariopermisos->SortUrl($usuariopermisos->userlevelid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuariopermisos->userlevelid->FldCaption() ?></td><td style="width: 10px;"><?php if ($usuariopermisos->userlevelid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuariopermisos->userlevelid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuariopermisos->ztablename->Visible) { // tablename ?>
	<?php if ($usuariopermisos->SortUrl($usuariopermisos->ztablename) == "") { ?>
		<td><?php echo $usuariopermisos->ztablename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuariopermisos->SortUrl($usuariopermisos->ztablename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuariopermisos->ztablename->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuariopermisos->ztablename->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuariopermisos->ztablename->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuariopermisos->permission->Visible) { // permission ?>
	<?php if ($usuariopermisos->SortUrl($usuariopermisos->permission) == "") { ?>
		<td><?php echo $usuariopermisos->permission->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuariopermisos->SortUrl($usuariopermisos->permission) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuariopermisos->permission->FldCaption() ?></td><td style="width: 10px;"><?php if ($usuariopermisos->permission->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuariopermisos->permission->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$usuariopermisos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($usuariopermisos->ExportAll && $usuariopermisos->Export <> "") {
	$usuariopermisos_list->StopRec = $usuariopermisos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($usuariopermisos_list->TotalRecs > $usuariopermisos_list->StartRec + $usuariopermisos_list->DisplayRecs - 1)
		$usuariopermisos_list->StopRec = $usuariopermisos_list->StartRec + $usuariopermisos_list->DisplayRecs - 1;
	else
		$usuariopermisos_list->StopRec = $usuariopermisos_list->TotalRecs;
}
$usuariopermisos_list->RecCnt = $usuariopermisos_list->StartRec - 1;
if ($usuariopermisos_list->Recordset && !$usuariopermisos_list->Recordset->EOF) {
	$usuariopermisos_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $usuariopermisos_list->StartRec > 1)
		$usuariopermisos_list->Recordset->Move($usuariopermisos_list->StartRec - 1);
} elseif (!$usuariopermisos->AllowAddDeleteRow && $usuariopermisos_list->StopRec == 0) {
	$usuariopermisos_list->StopRec = $usuariopermisos->GridAddRowCount;
}

// Initialize aggregate
$usuariopermisos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$usuariopermisos->ResetAttrs();
$usuariopermisos_list->RenderRow();
$usuariopermisos_list->RowCnt = 0;
while ($usuariopermisos_list->RecCnt < $usuariopermisos_list->StopRec) {
	$usuariopermisos_list->RecCnt++;
	if (intval($usuariopermisos_list->RecCnt) >= intval($usuariopermisos_list->StartRec)) {
		$usuariopermisos_list->RowCnt++;

		// Set up key count
		$usuariopermisos_list->KeyCount = $usuariopermisos_list->RowIndex;

		// Init row class and style
		$usuariopermisos->ResetAttrs();
		$usuariopermisos->CssClass = "";
		if ($usuariopermisos->CurrentAction == "gridadd") {
		} else {
			$usuariopermisos_list->LoadRowValues($usuariopermisos_list->Recordset); // Load row values
		}
		$usuariopermisos->RowType = EW_ROWTYPE_VIEW; // Render view
		$usuariopermisos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$usuariopermisos_list->RenderRow();

		// Render list options
		$usuariopermisos_list->RenderListOptions();
?>
	<tr<?php echo $usuariopermisos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$usuariopermisos_list->ListOptions->Render("body", "left");
?>
	<?php if ($usuariopermisos->userlevelid->Visible) { // userlevelid ?>
		<td<?php echo $usuariopermisos->userlevelid->CellAttributes() ?>>
<div<?php echo $usuariopermisos->userlevelid->ViewAttributes() ?>><?php echo $usuariopermisos->userlevelid->ListViewValue() ?></div>
<a name="<?php echo $usuariopermisos_list->PageObjName . "_row_" . $usuariopermisos_list->RowCnt ?>" id="<?php echo $usuariopermisos_list->PageObjName . "_row_" . $usuariopermisos_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($usuariopermisos->ztablename->Visible) { // tablename ?>
		<td<?php echo $usuariopermisos->ztablename->CellAttributes() ?>>
<div<?php echo $usuariopermisos->ztablename->ViewAttributes() ?>><?php echo $usuariopermisos->ztablename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuariopermisos->permission->Visible) { // permission ?>
		<td<?php echo $usuariopermisos->permission->CellAttributes() ?>>
<div<?php echo $usuariopermisos->permission->ViewAttributes() ?>><?php echo $usuariopermisos->permission->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$usuariopermisos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($usuariopermisos->CurrentAction <> "gridadd")
		$usuariopermisos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($usuariopermisos_list->Recordset)
	$usuariopermisos_list->Recordset->Close();
?>
<?php if ($usuariopermisos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($usuariopermisos->CurrentAction <> "gridadd" && $usuariopermisos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($usuariopermisos_list->Pager)) $usuariopermisos_list->Pager = new cPrevNextPager($usuariopermisos_list->StartRec, $usuariopermisos_list->DisplayRecs, $usuariopermisos_list->TotalRecs) ?>
<?php if ($usuariopermisos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($usuariopermisos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $usuariopermisos_list->PageUrl() ?>start=<?php echo $usuariopermisos_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($usuariopermisos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $usuariopermisos_list->PageUrl() ?>start=<?php echo $usuariopermisos_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $usuariopermisos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($usuariopermisos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $usuariopermisos_list->PageUrl() ?>start=<?php echo $usuariopermisos_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($usuariopermisos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $usuariopermisos_list->PageUrl() ?>start=<?php echo $usuariopermisos_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $usuariopermisos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $usuariopermisos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $usuariopermisos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $usuariopermisos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($usuariopermisos_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $usuariopermisos_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($usuariopermisos->Export == "" && $usuariopermisos->CurrentAction == "") { ?>
<?php } ?>
<?php
$usuariopermisos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuariopermisos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuariopermisos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuariopermisos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'usuariopermisos';

	// Page object name
	var $PageObjName = 'usuariopermisos_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuariopermisos;
		if ($usuariopermisos->UseTokenInUrl) $PageUrl .= "t=" . $usuariopermisos->TableVar . "&"; // Add page token
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
		global $objForm, $usuariopermisos;
		if ($usuariopermisos->UseTokenInUrl) {
			if ($objForm)
				return ($usuariopermisos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuariopermisos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuariopermisos_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuariopermisos)
		if (!isset($GLOBALS["usuariopermisos"])) {
			$GLOBALS["usuariopermisos"] = new cusuariopermisos();
			$GLOBALS["Table"] =& $GLOBALS["usuariopermisos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "usuariopermisosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "usuariopermisosdelete.php";
		$this->MultiUpdateUrl = "usuariopermisosupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuariopermisos', TRUE);

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
		global $usuariopermisos;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$usuariopermisos->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $usuariopermisos;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($usuariopermisos->Export <> "" ||
				$usuariopermisos->CurrentAction == "gridadd" ||
				$usuariopermisos->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$usuariopermisos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($usuariopermisos->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $usuariopermisos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$usuariopermisos->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$usuariopermisos->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$usuariopermisos->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $usuariopermisos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$usuariopermisos->setSessionWhere($sFilter);
		$usuariopermisos->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $usuariopermisos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $usuariopermisos->ztablename, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $usuariopermisos->permission, $Keyword);
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
		global $Security, $usuariopermisos;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $usuariopermisos->BasicSearchKeyword;
		$sSearchType = $usuariopermisos->BasicSearchType;
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
			$usuariopermisos->setSessionBasicSearchKeyword($sSearchKeyword);
			$usuariopermisos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $usuariopermisos;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$usuariopermisos->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $usuariopermisos;
		$usuariopermisos->setSessionBasicSearchKeyword("");
		$usuariopermisos->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $usuariopermisos;
		$bRestore = TRUE;
		if ($usuariopermisos->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$usuariopermisos->BasicSearchKeyword = $usuariopermisos->getSessionBasicSearchKeyword();
			$usuariopermisos->BasicSearchType = $usuariopermisos->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $usuariopermisos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$usuariopermisos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$usuariopermisos->CurrentOrderType = @$_GET["ordertype"];
			$usuariopermisos->UpdateSort($usuariopermisos->userlevelid); // userlevelid
			$usuariopermisos->UpdateSort($usuariopermisos->ztablename); // tablename
			$usuariopermisos->UpdateSort($usuariopermisos->permission); // permission
			$usuariopermisos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $usuariopermisos;
		$sOrderBy = $usuariopermisos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($usuariopermisos->SqlOrderBy() <> "") {
				$sOrderBy = $usuariopermisos->SqlOrderBy();
				$usuariopermisos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $usuariopermisos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$usuariopermisos->setSessionOrderBy($sOrderBy);
				$usuariopermisos->userlevelid->setSort("");
				$usuariopermisos->ztablename->setSort("");
				$usuariopermisos->permission->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$usuariopermisos->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $usuariopermisos;

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
		global $Security, $Language, $usuariopermisos, $objForm;
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
		global $Security, $Language, $usuariopermisos;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuariopermisos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuariopermisos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuariopermisos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuariopermisos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuariopermisos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuariopermisos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuariopermisos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $usuariopermisos;
		$usuariopermisos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$usuariopermisos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuariopermisos;

		// Call Recordset Selecting event
		$usuariopermisos->Recordset_Selecting($usuariopermisos->CurrentFilter);

		// Load List page SQL
		$sSql = $usuariopermisos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$usuariopermisos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuariopermisos;
		$sFilter = $usuariopermisos->KeyFilter();

		// Call Row Selecting event
		$usuariopermisos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuariopermisos->CurrentFilter = $sFilter;
		$sSql = $usuariopermisos->SQL();
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
		global $conn, $usuariopermisos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuariopermisos->Row_Selected($row);
		$usuariopermisos->userlevelid->setDbValue($rs->fields('userlevelid'));
		$usuariopermisos->ztablename->setDbValue($rs->fields('tablename'));
		$usuariopermisos->permission->setDbValue($rs->fields('permission'));
	}

	// Load old record
	function LoadOldRecord() {
		global $usuariopermisos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($usuariopermisos->getKey("userlevelid")) <> "")
			$usuariopermisos->userlevelid->CurrentValue = $usuariopermisos->getKey("userlevelid"); // userlevelid
		else
			$bValidKey = FALSE;
		if (strval($usuariopermisos->getKey("ztablename")) <> "")
			$usuariopermisos->ztablename->CurrentValue = $usuariopermisos->getKey("ztablename"); // tablename
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$usuariopermisos->CurrentFilter = $usuariopermisos->KeyFilter();
			$sSql = $usuariopermisos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuariopermisos;

		// Initialize URLs
		$this->ViewUrl = $usuariopermisos->ViewUrl();
		$this->EditUrl = $usuariopermisos->EditUrl();
		$this->InlineEditUrl = $usuariopermisos->InlineEditUrl();
		$this->CopyUrl = $usuariopermisos->CopyUrl();
		$this->InlineCopyUrl = $usuariopermisos->InlineCopyUrl();
		$this->DeleteUrl = $usuariopermisos->DeleteUrl();

		// Call Row_Rendering event
		$usuariopermisos->Row_Rendering();

		// Common render codes for all row types
		// userlevelid
		// tablename
		// permission

		if ($usuariopermisos->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$usuariopermisos->userlevelid->ViewValue = $usuariopermisos->userlevelid->CurrentValue;
			$usuariopermisos->userlevelid->ViewCustomAttributes = "";

			// tablename
			$usuariopermisos->ztablename->ViewValue = $usuariopermisos->ztablename->CurrentValue;
			$usuariopermisos->ztablename->ViewCustomAttributes = "";

			// permission
			if (strval($usuariopermisos->permission->CurrentValue) <> "") {
				$arwrk = explode(",", $usuariopermisos->permission->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`userlevelid` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `userlevelname` FROM `usuarioniveles`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$usuariopermisos->permission->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$usuariopermisos->permission->ViewValue .= $rswrk->fields('userlevelname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $usuariopermisos->permission->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$usuariopermisos->permission->ViewValue = $usuariopermisos->permission->CurrentValue;
				}
			} else {
				$usuariopermisos->permission->ViewValue = NULL;
			}
			$usuariopermisos->permission->ViewCustomAttributes = "";

			// userlevelid
			$usuariopermisos->userlevelid->LinkCustomAttributes = "";
			$usuariopermisos->userlevelid->HrefValue = "";
			$usuariopermisos->userlevelid->TooltipValue = "";

			// tablename
			$usuariopermisos->ztablename->LinkCustomAttributes = "";
			$usuariopermisos->ztablename->HrefValue = "";
			$usuariopermisos->ztablename->TooltipValue = "";

			// permission
			$usuariopermisos->permission->LinkCustomAttributes = "";
			$usuariopermisos->permission->HrefValue = "";
			$usuariopermisos->permission->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuariopermisos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuariopermisos->Row_Rendered();
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
