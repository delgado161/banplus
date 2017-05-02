<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "user_level_permissionsinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$user_level_permissions_list = new cuser_level_permissions_list();
$Page =& $user_level_permissions_list;

// Page init
$user_level_permissions_list->Page_Init();

// Page main
$user_level_permissions_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($user_level_permissions->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var user_level_permissions_list = new ew_Page("user_level_permissions_list");

// page properties
user_level_permissions_list.PageID = "list"; // page ID
user_level_permissions_list.FormID = "fuser_level_permissionslist"; // form ID
var EW_PAGE_ID = user_level_permissions_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
user_level_permissions_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
user_level_permissions_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
user_level_permissions_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($user_level_permissions->Export == "") || (EW_EXPORT_MASTER_RECORD && $user_level_permissions->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$user_level_permissions_list->TotalRecs = $user_level_permissions->SelectRecordCount();
	} else {
		if ($user_level_permissions_list->Recordset = $user_level_permissions_list->LoadRecordset())
			$user_level_permissions_list->TotalRecs = $user_level_permissions_list->Recordset->RecordCount();
	}
	$user_level_permissions_list->StartRec = 1;
	if ($user_level_permissions_list->DisplayRecs <= 0 || ($user_level_permissions->Export <> "" && $user_level_permissions->ExportAll)) // Display all records
		$user_level_permissions_list->DisplayRecs = $user_level_permissions_list->TotalRecs;
	if (!($user_level_permissions->Export <> "" && $user_level_permissions->ExportAll))
		$user_level_permissions_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$user_level_permissions_list->Recordset = $user_level_permissions_list->LoadRecordset($user_level_permissions_list->StartRec-1, $user_level_permissions_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $user_level_permissions->TableCaption() ?>
&nbsp;&nbsp;<?php $user_level_permissions_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($user_level_permissions->Export == "" && $user_level_permissions->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(user_level_permissions_list);" style="text-decoration: none;"><img id="user_level_permissions_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="user_level_permissions_list_SearchPanel">
<form name="fuser_level_permissionslistsrch" id="fuser_level_permissionslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="user_level_permissions">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($user_level_permissions->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $user_level_permissions_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($user_level_permissions->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($user_level_permissions->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($user_level_permissions->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $user_level_permissions_list->ShowPageHeader(); ?>
<?php
$user_level_permissions_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fuser_level_permissionslist" id="fuser_level_permissionslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="user_level_permissions">
<div id="gmp_user_level_permissions" class="ewGridMiddlePanel">
<?php if ($user_level_permissions_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $user_level_permissions->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$user_level_permissions_list->RenderListOptions();

// Render list options (header, left)
$user_level_permissions_list->ListOptions->Render("header", "left");
?>
<?php if ($user_level_permissions->UserLevelID->Visible) { // UserLevelID ?>
	<?php if ($user_level_permissions->SortUrl($user_level_permissions->UserLevelID) == "") { ?>
		<td><?php echo $user_level_permissions->UserLevelID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $user_level_permissions->SortUrl($user_level_permissions->UserLevelID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $user_level_permissions->UserLevelID->FldCaption() ?></td><td style="width: 10px;"><?php if ($user_level_permissions->UserLevelID->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($user_level_permissions->UserLevelID->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($user_level_permissions->zTableName->Visible) { // TableName ?>
	<?php if ($user_level_permissions->SortUrl($user_level_permissions->zTableName) == "") { ?>
		<td><?php echo $user_level_permissions->zTableName->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $user_level_permissions->SortUrl($user_level_permissions->zTableName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $user_level_permissions->zTableName->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($user_level_permissions->zTableName->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($user_level_permissions->zTableName->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($user_level_permissions->Permission->Visible) { // Permission ?>
	<?php if ($user_level_permissions->SortUrl($user_level_permissions->Permission) == "") { ?>
		<td><?php echo $user_level_permissions->Permission->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $user_level_permissions->SortUrl($user_level_permissions->Permission) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $user_level_permissions->Permission->FldCaption() ?></td><td style="width: 10px;"><?php if ($user_level_permissions->Permission->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($user_level_permissions->Permission->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$user_level_permissions_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($user_level_permissions->ExportAll && $user_level_permissions->Export <> "") {
	$user_level_permissions_list->StopRec = $user_level_permissions_list->TotalRecs;
} else {

	// Set the last record to display
	if ($user_level_permissions_list->TotalRecs > $user_level_permissions_list->StartRec + $user_level_permissions_list->DisplayRecs - 1)
		$user_level_permissions_list->StopRec = $user_level_permissions_list->StartRec + $user_level_permissions_list->DisplayRecs - 1;
	else
		$user_level_permissions_list->StopRec = $user_level_permissions_list->TotalRecs;
}
$user_level_permissions_list->RecCnt = $user_level_permissions_list->StartRec - 1;
if ($user_level_permissions_list->Recordset && !$user_level_permissions_list->Recordset->EOF) {
	$user_level_permissions_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $user_level_permissions_list->StartRec > 1)
		$user_level_permissions_list->Recordset->Move($user_level_permissions_list->StartRec - 1);
} elseif (!$user_level_permissions->AllowAddDeleteRow && $user_level_permissions_list->StopRec == 0) {
	$user_level_permissions_list->StopRec = $user_level_permissions->GridAddRowCount;
}

// Initialize aggregate
$user_level_permissions->RowType = EW_ROWTYPE_AGGREGATEINIT;
$user_level_permissions->ResetAttrs();
$user_level_permissions_list->RenderRow();
$user_level_permissions_list->RowCnt = 0;
while ($user_level_permissions_list->RecCnt < $user_level_permissions_list->StopRec) {
	$user_level_permissions_list->RecCnt++;
	if (intval($user_level_permissions_list->RecCnt) >= intval($user_level_permissions_list->StartRec)) {
		$user_level_permissions_list->RowCnt++;

		// Set up key count
		$user_level_permissions_list->KeyCount = $user_level_permissions_list->RowIndex;

		// Init row class and style
		$user_level_permissions->ResetAttrs();
		$user_level_permissions->CssClass = "";
		if ($user_level_permissions->CurrentAction == "gridadd") {
		} else {
			$user_level_permissions_list->LoadRowValues($user_level_permissions_list->Recordset); // Load row values
		}
		$user_level_permissions->RowType = EW_ROWTYPE_VIEW; // Render view
		$user_level_permissions->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$user_level_permissions_list->RenderRow();

		// Render list options
		$user_level_permissions_list->RenderListOptions();
?>
	<tr<?php echo $user_level_permissions->RowAttributes() ?>>
<?php

// Render list options (body, left)
$user_level_permissions_list->ListOptions->Render("body", "left");
?>
	<?php if ($user_level_permissions->UserLevelID->Visible) { // UserLevelID ?>
		<td<?php echo $user_level_permissions->UserLevelID->CellAttributes() ?>>
<div<?php echo $user_level_permissions->UserLevelID->ViewAttributes() ?>><?php echo $user_level_permissions->UserLevelID->ListViewValue() ?></div>
<a name="<?php echo $user_level_permissions_list->PageObjName . "_row_" . $user_level_permissions_list->RowCnt ?>" id="<?php echo $user_level_permissions_list->PageObjName . "_row_" . $user_level_permissions_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($user_level_permissions->zTableName->Visible) { // TableName ?>
		<td<?php echo $user_level_permissions->zTableName->CellAttributes() ?>>
<div<?php echo $user_level_permissions->zTableName->ViewAttributes() ?>><?php echo $user_level_permissions->zTableName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($user_level_permissions->Permission->Visible) { // Permission ?>
		<td<?php echo $user_level_permissions->Permission->CellAttributes() ?>>
<div<?php echo $user_level_permissions->Permission->ViewAttributes() ?>><?php echo $user_level_permissions->Permission->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_level_permissions_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($user_level_permissions->CurrentAction <> "gridadd")
		$user_level_permissions_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($user_level_permissions_list->Recordset)
	$user_level_permissions_list->Recordset->Close();
?>
<?php if ($user_level_permissions->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($user_level_permissions->CurrentAction <> "gridadd" && $user_level_permissions->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($user_level_permissions_list->Pager)) $user_level_permissions_list->Pager = new cPrevNextPager($user_level_permissions_list->StartRec, $user_level_permissions_list->DisplayRecs, $user_level_permissions_list->TotalRecs) ?>
<?php if ($user_level_permissions_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($user_level_permissions_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $user_level_permissions_list->PageUrl() ?>start=<?php echo $user_level_permissions_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($user_level_permissions_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $user_level_permissions_list->PageUrl() ?>start=<?php echo $user_level_permissions_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $user_level_permissions_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($user_level_permissions_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $user_level_permissions_list->PageUrl() ?>start=<?php echo $user_level_permissions_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($user_level_permissions_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $user_level_permissions_list->PageUrl() ?>start=<?php echo $user_level_permissions_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $user_level_permissions_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $user_level_permissions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $user_level_permissions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $user_level_permissions_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($user_level_permissions_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $user_level_permissions_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($user_level_permissions->Export == "" && $user_level_permissions->CurrentAction == "") { ?>
<?php } ?>
<?php
$user_level_permissions_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($user_level_permissions->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$user_level_permissions_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cuser_level_permissions_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'user_level_permissions';

	// Page object name
	var $PageObjName = 'user_level_permissions_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $user_level_permissions;
		if ($user_level_permissions->UseTokenInUrl) $PageUrl .= "t=" . $user_level_permissions->TableVar . "&"; // Add page token
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
		global $objForm, $user_level_permissions;
		if ($user_level_permissions->UseTokenInUrl) {
			if ($objForm)
				return ($user_level_permissions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($user_level_permissions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuser_level_permissions_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (user_level_permissions)
		if (!isset($GLOBALS["user_level_permissions"])) {
			$GLOBALS["user_level_permissions"] = new cuser_level_permissions();
			$GLOBALS["Table"] =& $GLOBALS["user_level_permissions"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "user_level_permissionsadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "user_level_permissionsdelete.php";
		$this->MultiUpdateUrl = "user_level_permissionsupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'user_level_permissions', TRUE);

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
		global $user_level_permissions;

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
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$user_level_permissions->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $user_level_permissions;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($user_level_permissions->Export <> "" ||
				$user_level_permissions->CurrentAction == "gridadd" ||
				$user_level_permissions->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$user_level_permissions->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($user_level_permissions->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $user_level_permissions->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$user_level_permissions->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$user_level_permissions->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$user_level_permissions->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $user_level_permissions->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$user_level_permissions->setSessionWhere($sFilter);
		$user_level_permissions->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $user_level_permissions;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $user_level_permissions->zTableName, $Keyword);
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
		global $Security, $user_level_permissions;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $user_level_permissions->BasicSearchKeyword;
		$sSearchType = $user_level_permissions->BasicSearchType;
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
			$user_level_permissions->setSessionBasicSearchKeyword($sSearchKeyword);
			$user_level_permissions->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $user_level_permissions;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$user_level_permissions->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $user_level_permissions;
		$user_level_permissions->setSessionBasicSearchKeyword("");
		$user_level_permissions->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $user_level_permissions;
		$bRestore = TRUE;
		if ($user_level_permissions->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$user_level_permissions->BasicSearchKeyword = $user_level_permissions->getSessionBasicSearchKeyword();
			$user_level_permissions->BasicSearchType = $user_level_permissions->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $user_level_permissions;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$user_level_permissions->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$user_level_permissions->CurrentOrderType = @$_GET["ordertype"];
			$user_level_permissions->UpdateSort($user_level_permissions->UserLevelID); // UserLevelID
			$user_level_permissions->UpdateSort($user_level_permissions->zTableName); // TableName
			$user_level_permissions->UpdateSort($user_level_permissions->Permission); // Permission
			$user_level_permissions->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $user_level_permissions;
		$sOrderBy = $user_level_permissions->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($user_level_permissions->SqlOrderBy() <> "") {
				$sOrderBy = $user_level_permissions->SqlOrderBy();
				$user_level_permissions->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $user_level_permissions;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$user_level_permissions->setSessionOrderBy($sOrderBy);
				$user_level_permissions->UserLevelID->setSort("");
				$user_level_permissions->zTableName->setSort("");
				$user_level_permissions->Permission->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$user_level_permissions->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $user_level_permissions;

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

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
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
		global $Security, $Language, $user_level_permissions, $objForm;
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

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->CanAdd() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
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
		global $Security, $Language, $user_level_permissions;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $user_level_permissions;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$user_level_permissions->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$user_level_permissions->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $user_level_permissions->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$user_level_permissions->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$user_level_permissions->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$user_level_permissions->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $user_level_permissions;
		$user_level_permissions->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$user_level_permissions->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $user_level_permissions;

		// Call Recordset Selecting event
		$user_level_permissions->Recordset_Selecting($user_level_permissions->CurrentFilter);

		// Load List page SQL
		$sSql = $user_level_permissions->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$user_level_permissions->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $user_level_permissions;
		$sFilter = $user_level_permissions->KeyFilter();

		// Call Row Selecting event
		$user_level_permissions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$user_level_permissions->CurrentFilter = $sFilter;
		$sSql = $user_level_permissions->SQL();
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
		global $conn, $user_level_permissions;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$user_level_permissions->Row_Selected($row);
		$user_level_permissions->UserLevelID->setDbValue($rs->fields('UserLevelID'));
		$user_level_permissions->zTableName->setDbValue($rs->fields('TableName'));
		$user_level_permissions->Permission->setDbValue($rs->fields('Permission'));
	}

	// Load old record
	function LoadOldRecord() {
		global $user_level_permissions;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($user_level_permissions->getKey("UserLevelID")) <> "")
			$user_level_permissions->UserLevelID->CurrentValue = $user_level_permissions->getKey("UserLevelID"); // UserLevelID
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$user_level_permissions->CurrentFilter = $user_level_permissions->KeyFilter();
			$sSql = $user_level_permissions->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $user_level_permissions;

		// Initialize URLs
		$this->ViewUrl = $user_level_permissions->ViewUrl();
		$this->EditUrl = $user_level_permissions->EditUrl();
		$this->InlineEditUrl = $user_level_permissions->InlineEditUrl();
		$this->CopyUrl = $user_level_permissions->CopyUrl();
		$this->InlineCopyUrl = $user_level_permissions->InlineCopyUrl();
		$this->DeleteUrl = $user_level_permissions->DeleteUrl();

		// Call Row_Rendering event
		$user_level_permissions->Row_Rendering();

		// Common render codes for all row types
		// UserLevelID
		// TableName
		// Permission

		if ($user_level_permissions->RowType == EW_ROWTYPE_VIEW) { // View row

			// UserLevelID
			$user_level_permissions->UserLevelID->ViewValue = $user_level_permissions->UserLevelID->CurrentValue;
			$user_level_permissions->UserLevelID->ViewCustomAttributes = "";

			// TableName
			$user_level_permissions->zTableName->ViewValue = $user_level_permissions->zTableName->CurrentValue;
			$user_level_permissions->zTableName->ViewCustomAttributes = "";

			// Permission
			$user_level_permissions->Permission->ViewValue = $user_level_permissions->Permission->CurrentValue;
			$user_level_permissions->Permission->ViewCustomAttributes = "";

			// UserLevelID
			$user_level_permissions->UserLevelID->LinkCustomAttributes = "";
			$user_level_permissions->UserLevelID->HrefValue = "";
			$user_level_permissions->UserLevelID->TooltipValue = "";

			// TableName
			$user_level_permissions->zTableName->LinkCustomAttributes = "";
			$user_level_permissions->zTableName->HrefValue = "";
			$user_level_permissions->zTableName->TooltipValue = "";

			// Permission
			$user_level_permissions->Permission->LinkCustomAttributes = "";
			$user_level_permissions->Permission->HrefValue = "";
			$user_level_permissions->Permission->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($user_level_permissions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$user_level_permissions->Row_Rendered();
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
