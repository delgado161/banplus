<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "banner_seccioninfo.php" ?>
<?php include_once "bannerinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$banner_seccion_list = new cbanner_seccion_list();
$Page =& $banner_seccion_list;

// Page init
$banner_seccion_list->Page_Init();

// Page main
$banner_seccion_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($banner_seccion->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var banner_seccion_list = new ew_Page("banner_seccion_list");

// page properties
banner_seccion_list.PageID = "list"; // page ID
banner_seccion_list.FormID = "fbanner_seccionlist"; // form ID
var EW_PAGE_ID = banner_seccion_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
banner_seccion_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
banner_seccion_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banner_seccion_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($banner_seccion->Export == "") || (EW_EXPORT_MASTER_RECORD && $banner_seccion->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "bannerlist.php";
if ($banner_seccion_list->DbMasterFilter <> "" && $banner_seccion->getCurrentMasterTable() == "banner") {
	if ($banner_seccion_list->MasterRecordExists) {
		if ($banner_seccion->getCurrentMasterTable() == $banner_seccion->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $banner->TableCaption() ?>
&nbsp;&nbsp;<?php $banner_seccion_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($banner_seccion->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "bannermaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$banner_seccion_list->TotalRecs = $banner_seccion->SelectRecordCount();
	} else {
		if ($banner_seccion_list->Recordset = $banner_seccion_list->LoadRecordset())
			$banner_seccion_list->TotalRecs = $banner_seccion_list->Recordset->RecordCount();
	}
	$banner_seccion_list->StartRec = 1;
	if ($banner_seccion_list->DisplayRecs <= 0 || ($banner_seccion->Export <> "" && $banner_seccion->ExportAll)) // Display all records
		$banner_seccion_list->DisplayRecs = $banner_seccion_list->TotalRecs;
	if (!($banner_seccion->Export <> "" && $banner_seccion->ExportAll))
		$banner_seccion_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$banner_seccion_list->Recordset = $banner_seccion_list->LoadRecordset($banner_seccion_list->StartRec-1, $banner_seccion_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banner_seccion->TableCaption() ?>
<?php if ($banner_seccion->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $banner_seccion_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php $banner_seccion_list->ShowPageHeader(); ?>
<?php
$banner_seccion_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fbanner_seccionlist" id="fbanner_seccionlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="banner_seccion">
<div id="gmp_banner_seccion" class="ewGridMiddlePanel">
<?php if ($banner_seccion_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $banner_seccion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$banner_seccion_list->RenderListOptions();

// Render list options (header, left)
$banner_seccion_list->ListOptions->Render("header", "left");
?>
<?php if ($banner_seccion->id_banner->Visible) { // id_banner ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->id_banner) == "") { ?>
		<td><?php echo $banner_seccion->id_banner->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banner_seccion->SortUrl($banner_seccion->id_banner) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->id_banner->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->id_banner->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->id_banner->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->id_grupo_secciones->Visible) { // id_grupo_secciones ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->id_grupo_secciones) == "") { ?>
		<td><?php echo $banner_seccion->id_grupo_secciones->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banner_seccion->SortUrl($banner_seccion->id_grupo_secciones) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->id_grupo_secciones->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->id_grupo_secciones->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->id_grupo_secciones->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->fecha_inicio->Visible) { // fecha_inicio ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->fecha_inicio) == "") { ?>
		<td><?php echo $banner_seccion->fecha_inicio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banner_seccion->SortUrl($banner_seccion->fecha_inicio) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->fecha_inicio->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->fecha_inicio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->fecha_inicio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->fecha_fin->Visible) { // fecha_fin ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->fecha_fin) == "") { ?>
		<td><?php echo $banner_seccion->fecha_fin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banner_seccion->SortUrl($banner_seccion->fecha_fin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->fecha_fin->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->fecha_fin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->fecha_fin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->id_posicion->Visible) { // id_posicion ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->id_posicion) == "") { ?>
		<td><?php echo $banner_seccion->id_posicion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banner_seccion->SortUrl($banner_seccion->id_posicion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->id_posicion->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->id_posicion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->id_posicion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banner_seccion->orden->Visible) { // orden ?>
	<?php if ($banner_seccion->SortUrl($banner_seccion->orden) == "") { ?>
		<td><?php echo $banner_seccion->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banner_seccion->SortUrl($banner_seccion->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banner_seccion->orden->FldCaption() ?></td><td style="width: 10px;"><?php if ($banner_seccion->orden->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banner_seccion->orden->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$banner_seccion_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($banner_seccion->ExportAll && $banner_seccion->Export <> "") {
	$banner_seccion_list->StopRec = $banner_seccion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($banner_seccion_list->TotalRecs > $banner_seccion_list->StartRec + $banner_seccion_list->DisplayRecs - 1)
		$banner_seccion_list->StopRec = $banner_seccion_list->StartRec + $banner_seccion_list->DisplayRecs - 1;
	else
		$banner_seccion_list->StopRec = $banner_seccion_list->TotalRecs;
}
$banner_seccion_list->RecCnt = $banner_seccion_list->StartRec - 1;
if ($banner_seccion_list->Recordset && !$banner_seccion_list->Recordset->EOF) {
	$banner_seccion_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $banner_seccion_list->StartRec > 1)
		$banner_seccion_list->Recordset->Move($banner_seccion_list->StartRec - 1);
} elseif (!$banner_seccion->AllowAddDeleteRow && $banner_seccion_list->StopRec == 0) {
	$banner_seccion_list->StopRec = $banner_seccion->GridAddRowCount;
}

// Initialize aggregate
$banner_seccion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$banner_seccion->ResetAttrs();
$banner_seccion_list->RenderRow();
$banner_seccion_list->RowCnt = 0;
while ($banner_seccion_list->RecCnt < $banner_seccion_list->StopRec) {
	$banner_seccion_list->RecCnt++;
	if (intval($banner_seccion_list->RecCnt) >= intval($banner_seccion_list->StartRec)) {
		$banner_seccion_list->RowCnt++;

		// Set up key count
		$banner_seccion_list->KeyCount = $banner_seccion_list->RowIndex;

		// Init row class and style
		$banner_seccion->ResetAttrs();
		$banner_seccion->CssClass = "";
		if ($banner_seccion->CurrentAction == "gridadd") {
		} else {
			$banner_seccion_list->LoadRowValues($banner_seccion_list->Recordset); // Load row values
		}
		$banner_seccion->RowType = EW_ROWTYPE_VIEW; // Render view
		$banner_seccion->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$banner_seccion_list->RenderRow();

		// Render list options
		$banner_seccion_list->RenderListOptions();
?>
	<tr<?php echo $banner_seccion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$banner_seccion_list->ListOptions->Render("body", "left");
?>
	<?php if ($banner_seccion->id_banner->Visible) { // id_banner ?>
		<td<?php echo $banner_seccion->id_banner->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_banner->ViewAttributes() ?>><?php echo $banner_seccion->id_banner->ListViewValue() ?></div>
<a name="<?php echo $banner_seccion_list->PageObjName . "_row_" . $banner_seccion_list->RowCnt ?>" id="<?php echo $banner_seccion_list->PageObjName . "_row_" . $banner_seccion_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($banner_seccion->id_grupo_secciones->Visible) { // id_grupo_secciones ?>
		<td<?php echo $banner_seccion->id_grupo_secciones->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_grupo_secciones->ViewAttributes() ?>><?php echo $banner_seccion->id_grupo_secciones->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banner_seccion->fecha_inicio->Visible) { // fecha_inicio ?>
		<td<?php echo $banner_seccion->fecha_inicio->CellAttributes() ?>>
<div<?php echo $banner_seccion->fecha_inicio->ViewAttributes() ?>><?php echo $banner_seccion->fecha_inicio->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banner_seccion->fecha_fin->Visible) { // fecha_fin ?>
		<td<?php echo $banner_seccion->fecha_fin->CellAttributes() ?>>
<div<?php echo $banner_seccion->fecha_fin->ViewAttributes() ?>><?php echo $banner_seccion->fecha_fin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banner_seccion->id_posicion->Visible) { // id_posicion ?>
		<td<?php echo $banner_seccion->id_posicion->CellAttributes() ?>>
<div<?php echo $banner_seccion->id_posicion->ViewAttributes() ?>><?php echo $banner_seccion->id_posicion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banner_seccion->orden->Visible) { // orden ?>
		<td<?php echo $banner_seccion->orden->CellAttributes() ?>>
<div<?php echo $banner_seccion->orden->ViewAttributes() ?>><?php echo $banner_seccion->orden->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$banner_seccion_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($banner_seccion->CurrentAction <> "gridadd")
		$banner_seccion_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($banner_seccion_list->Recordset)
	$banner_seccion_list->Recordset->Close();
?>
<?php if ($banner_seccion->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($banner_seccion->CurrentAction <> "gridadd" && $banner_seccion->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($banner_seccion_list->Pager)) $banner_seccion_list->Pager = new cPrevNextPager($banner_seccion_list->StartRec, $banner_seccion_list->DisplayRecs, $banner_seccion_list->TotalRecs) ?>
<?php if ($banner_seccion_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($banner_seccion_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $banner_seccion_list->PageUrl() ?>start=<?php echo $banner_seccion_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($banner_seccion_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $banner_seccion_list->PageUrl() ?>start=<?php echo $banner_seccion_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $banner_seccion_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($banner_seccion_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $banner_seccion_list->PageUrl() ?>start=<?php echo $banner_seccion_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($banner_seccion_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $banner_seccion_list->PageUrl() ?>start=<?php echo $banner_seccion_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $banner_seccion_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $banner_seccion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $banner_seccion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $banner_seccion_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($banner_seccion_list->SearchWhere == "0=101") { ?>
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
<a class="ewGridLink" href="<?php echo $banner_seccion_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($banner_seccion->Export == "" && $banner_seccion->CurrentAction == "") { ?>
<?php } ?>
<?php
$banner_seccion_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($banner_seccion->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$banner_seccion_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanner_seccion_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'banner_seccion';

	// Page object name
	var $PageObjName = 'banner_seccion_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banner_seccion;
		if ($banner_seccion->UseTokenInUrl) $PageUrl .= "t=" . $banner_seccion->TableVar . "&"; // Add page token
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
		global $objForm, $banner_seccion;
		if ($banner_seccion->UseTokenInUrl) {
			if ($objForm)
				return ($banner_seccion->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banner_seccion->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanner_seccion_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (banner_seccion)
		if (!isset($GLOBALS["banner_seccion"])) {
			$GLOBALS["banner_seccion"] = new cbanner_seccion();
			$GLOBALS["Table"] =& $GLOBALS["banner_seccion"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "banner_seccionadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "banner_secciondelete.php";
		$this->MultiUpdateUrl = "banner_seccionupdate.php";

		// Table object (banner)
		if (!isset($GLOBALS['banner'])) $GLOBALS['banner'] = new cbanner();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banner_seccion', TRUE);

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
		global $banner_seccion;

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
			$banner_seccion->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $banner_seccion;

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
			if ($banner_seccion->Export <> "" ||
				$banner_seccion->CurrentAction == "gridadd" ||
				$banner_seccion->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($banner_seccion->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $banner_seccion->getRecordsPerPage(); // Restore from Session
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
		$this->DbMasterFilter = $banner_seccion->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $banner_seccion->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($banner_seccion->getMasterFilter() <> "" && $banner_seccion->getCurrentMasterTable() == "banner") {
			global $banner;
			$rsmaster = $banner->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($banner_seccion->getReturnUrl()); // Return to caller
			} else {
				$banner->LoadListRowValues($rsmaster);
				$banner->RowType = EW_ROWTYPE_MASTER; // Master row
				$banner->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$banner_seccion->setSessionWhere($sFilter);
		$banner_seccion->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $banner_seccion;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$banner_seccion->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$banner_seccion->CurrentOrderType = @$_GET["ordertype"];
			$banner_seccion->UpdateSort($banner_seccion->id_banner); // id_banner
			$banner_seccion->UpdateSort($banner_seccion->id_grupo_secciones); // id_grupo_secciones
			$banner_seccion->UpdateSort($banner_seccion->fecha_inicio); // fecha_inicio
			$banner_seccion->UpdateSort($banner_seccion->fecha_fin); // fecha_fin
			$banner_seccion->UpdateSort($banner_seccion->id_posicion); // id_posicion
			$banner_seccion->UpdateSort($banner_seccion->orden); // orden
			$banner_seccion->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $banner_seccion;
		$sOrderBy = $banner_seccion->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($banner_seccion->SqlOrderBy() <> "") {
				$sOrderBy = $banner_seccion->SqlOrderBy();
				$banner_seccion->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $banner_seccion;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$banner_seccion->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$banner_seccion->id_banner->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$banner_seccion->setSessionOrderBy($sOrderBy);
				$banner_seccion->id_banner->setSort("");
				$banner_seccion->id_grupo_secciones->setSort("");
				$banner_seccion->fecha_inicio->setSort("");
				$banner_seccion->fecha_fin->setSort("");
				$banner_seccion->id_posicion->setSort("");
				$banner_seccion->orden->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$banner_seccion->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $banner_seccion;

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
		global $Security, $Language, $banner_seccion, $objForm;
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
		global $Security, $Language, $banner_seccion;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $banner_seccion;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$banner_seccion->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$banner_seccion->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $banner_seccion->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$banner_seccion->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$banner_seccion->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$banner_seccion->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $banner_seccion;

		// Call Recordset Selecting event
		$banner_seccion->Recordset_Selecting($banner_seccion->CurrentFilter);

		// Load List page SQL
		$sSql = $banner_seccion->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$banner_seccion->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banner_seccion;
		$sFilter = $banner_seccion->KeyFilter();

		// Call Row Selecting event
		$banner_seccion->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banner_seccion->CurrentFilter = $sFilter;
		$sSql = $banner_seccion->SQL();
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
		global $conn, $banner_seccion;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$banner_seccion->Row_Selected($row);
		$banner_seccion->id_banner_seccion->setDbValue($rs->fields('id_banner_seccion'));
		$banner_seccion->id_banner->setDbValue($rs->fields('id_banner'));
		$banner_seccion->id_grupo_secciones->setDbValue($rs->fields('id_grupo_secciones'));
		$banner_seccion->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$banner_seccion->fecha_fin->setDbValue($rs->fields('fecha_fin'));
		$banner_seccion->link->setDbValue($rs->fields('link'));
		$banner_seccion->externo->setDbValue($rs->fields('externo'));
		$banner_seccion->id_posicion->setDbValue($rs->fields('id_posicion'));
		$banner_seccion->orden->setDbValue($rs->fields('orden'));
	}

	// Load old record
	function LoadOldRecord() {
		global $banner_seccion;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($banner_seccion->getKey("id_banner_seccion")) <> "")
			$banner_seccion->id_banner_seccion->CurrentValue = $banner_seccion->getKey("id_banner_seccion"); // id_banner_seccion
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$banner_seccion->CurrentFilter = $banner_seccion->KeyFilter();
			$sSql = $banner_seccion->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banner_seccion;

		// Initialize URLs
		$this->ViewUrl = $banner_seccion->ViewUrl();
		$this->EditUrl = $banner_seccion->EditUrl();
		$this->InlineEditUrl = $banner_seccion->InlineEditUrl();
		$this->CopyUrl = $banner_seccion->CopyUrl();
		$this->InlineCopyUrl = $banner_seccion->InlineCopyUrl();
		$this->DeleteUrl = $banner_seccion->DeleteUrl();

		// Call Row_Rendering event
		$banner_seccion->Row_Rendering();

		// Common render codes for all row types
		// id_banner_seccion

		$banner_seccion->id_banner_seccion->CellCssStyle = "white-space: nowrap;";

		// id_banner
		// id_grupo_secciones
		// fecha_inicio
		// fecha_fin
		// link
		// externo
		// id_posicion
		// orden

		if ($banner_seccion->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_banner
			if (strval($banner_seccion->id_banner->CurrentValue) <> "") {
				$sFilterWrk = "`id_banner` = " . ew_AdjustSql($banner_seccion->id_banner->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `banner`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_banner->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$banner_seccion->id_banner->ViewValue = $banner_seccion->id_banner->CurrentValue;
				}
			} else {
				$banner_seccion->id_banner->ViewValue = NULL;
			}
			$banner_seccion->id_banner->ViewCustomAttributes = "";

			// id_grupo_secciones
			if (strval($banner_seccion->id_grupo_secciones->CurrentValue) <> "") {
				$sFilterWrk = "`id_grupo_seccion` = " . ew_AdjustSql($banner_seccion->id_grupo_secciones->CurrentValue) . "";
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
					$banner_seccion->id_grupo_secciones->ViewValue = $rswrk->fields('titulo');
					$rswrk->Close();
				} else {
					$banner_seccion->id_grupo_secciones->ViewValue = $banner_seccion->id_grupo_secciones->CurrentValue;
				}
			} else {
				$banner_seccion->id_grupo_secciones->ViewValue = NULL;
			}
			$banner_seccion->id_grupo_secciones->ViewCustomAttributes = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->ViewValue = $banner_seccion->fecha_inicio->CurrentValue;
			$banner_seccion->fecha_inicio->ViewValue = ew_FormatDateTime($banner_seccion->fecha_inicio->ViewValue, 7);
			$banner_seccion->fecha_inicio->ViewCustomAttributes = "";

			// fecha_fin
			$banner_seccion->fecha_fin->ViewValue = $banner_seccion->fecha_fin->CurrentValue;
			$banner_seccion->fecha_fin->ViewValue = ew_FormatDateTime($banner_seccion->fecha_fin->ViewValue, 7);
			$banner_seccion->fecha_fin->ViewCustomAttributes = "";

			// link
			$banner_seccion->link->ViewValue = $banner_seccion->link->CurrentValue;
			$banner_seccion->link->ViewCustomAttributes = "";

			// externo
			if (strval($banner_seccion->externo->CurrentValue) <> "") {
				$banner_seccion->externo->ViewValue = "";
				$arwrk = explode(",", strval($banner_seccion->externo->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++) {
					switch (trim($arwrk[$ari])) {
						case "1":
							$banner_seccion->externo->ViewValue .= $banner_seccion->externo->FldTagCaption(1) <> "" ? $banner_seccion->externo->FldTagCaption(1) : trim($arwrk[$ari]);
							break;
						default:
							$banner_seccion->externo->ViewValue .= trim($arwrk[$ari]);
					}
					if ($ari < $cnt-1) $banner_seccion->externo->ViewValue .= ew_ViewOptionSeparator($ari);
				}
			} else {
				$banner_seccion->externo->ViewValue = NULL;
			}
			$banner_seccion->externo->ViewCustomAttributes = "";

			// id_posicion
			if (strval($banner_seccion->id_posicion->CurrentValue) <> "") {
				$sFilterWrk = "`id_posicion` = " . ew_AdjustSql($banner_seccion->id_posicion->CurrentValue) . "";
			$sSqlWrk = "SELECT `posicion` FROM `banner_posicion`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `posicion`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banner_seccion->id_posicion->ViewValue = $rswrk->fields('posicion');
					$rswrk->Close();
				} else {
					$banner_seccion->id_posicion->ViewValue = $banner_seccion->id_posicion->CurrentValue;
				}
			} else {
				$banner_seccion->id_posicion->ViewValue = NULL;
			}
			$banner_seccion->id_posicion->ViewCustomAttributes = "";

			// orden
			$banner_seccion->orden->ViewValue = $banner_seccion->orden->CurrentValue;
			$banner_seccion->orden->ViewCustomAttributes = "";

			// id_banner
			$banner_seccion->id_banner->LinkCustomAttributes = "";
			$banner_seccion->id_banner->HrefValue = "";
			$banner_seccion->id_banner->TooltipValue = "";

			// id_grupo_secciones
			$banner_seccion->id_grupo_secciones->LinkCustomAttributes = "";
			$banner_seccion->id_grupo_secciones->HrefValue = "";
			$banner_seccion->id_grupo_secciones->TooltipValue = "";

			// fecha_inicio
			$banner_seccion->fecha_inicio->LinkCustomAttributes = "";
			$banner_seccion->fecha_inicio->HrefValue = "";
			$banner_seccion->fecha_inicio->TooltipValue = "";

			// fecha_fin
			$banner_seccion->fecha_fin->LinkCustomAttributes = "";
			$banner_seccion->fecha_fin->HrefValue = "";
			$banner_seccion->fecha_fin->TooltipValue = "";

			// id_posicion
			$banner_seccion->id_posicion->LinkCustomAttributes = "";
			$banner_seccion->id_posicion->HrefValue = "";
			$banner_seccion->id_posicion->TooltipValue = "";

			// orden
			$banner_seccion->orden->LinkCustomAttributes = "";
			$banner_seccion->orden->HrefValue = "";
			$banner_seccion->orden->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($banner_seccion->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banner_seccion->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $banner_seccion;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "banner") {
				$bValidMaster = TRUE;
				if (@$_GET["id_banner"] <> "") {
					$GLOBALS["banner"]->id_banner->setQueryStringValue($_GET["id_banner"]);
					$banner_seccion->id_banner->setQueryStringValue($GLOBALS["banner"]->id_banner->QueryStringValue);
					$banner_seccion->id_banner->setSessionValue($banner_seccion->id_banner->QueryStringValue);
					if (!is_numeric($GLOBALS["banner"]->id_banner->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$banner_seccion->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$banner_seccion->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "banner") {
				if ($banner_seccion->id_banner->QueryStringValue == "") $banner_seccion->id_banner->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $banner_seccion->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $banner_seccion->getDetailFilter(); // Get detail filter
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
		$table = 'banner_seccion';
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
