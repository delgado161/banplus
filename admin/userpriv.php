<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuarionivelesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$userpriv = new cuserpriv();
$Page =& $userpriv;

// Page init
$userpriv->Page_Init();

// Page main
$userpriv->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var userpriv = new ew_Page("userpriv");

// page properties
userpriv.PageID = "userpriv"; // page ID
userpriv.FormID = "fusuarionivelesuserpriv"; // form ID
var EW_PAGE_ID = userpriv.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
userpriv.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
userpriv.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userpriv.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("UserLevelPermission") ?></p>
<p class="phpmaker"><a href="usuarioniveleslist.php"><?php echo $Language->Phrase("BackToList") ?></a></p>
<p class="phpmaker"><?php echo $Language->Phrase("UserLevel") ?><?php echo $Security->GetUserLevelName($usuarioniveles->userlevelid->CurrentValue) ?>(<?php echo $usuarioniveles->userlevelid->CurrentValue ?>)</p>
<?php
$userpriv->ShowMessage();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="userpriv" id="userpriv" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="usuarioniveles">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<!-- hidden tag for User Level ID -->
<input type="hidden" name="x_userlevelid" id="x_userlevelid" value="<?php echo $usuarioniveles->userlevelid->CurrentValue ?>">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
	<thead>
	<tr class="ewTableHeader">
		<td><?php echo $Language->Phrase("TableOrView") ?></td>
		<td><?php echo $Language->Phrase("PermissionAddCopy") ?><input type="checkbox" name="Add" id="Add" onclick="ew_SelectAll(this);"<?php echo $userpriv->Disabled ?>></td>
		<td><?php echo $Language->Phrase("PermissionDelete") ?><input type="checkbox" name="Delete" id="Delete" onclick="ew_SelectAll(this);"<?php echo $userpriv->Disabled ?>></td>
		<td><?php echo $Language->Phrase("PermissionEdit") ?><input type="checkbox" name="Edit" id="Edit" onclick="ew_SelectAll(this);"<?php echo $userpriv->Disabled ?>></td>
<?php if (defined("EW_USER_LEVEL_COMPAT")) { ?>
		<td><?php echo $Language->Phrase("PermissionListSearchView") ?><input type="checkbox" name="List" id="List" onclick="ew_SelectAll(this);"<?php echo $userpriv->Disabled ?>></td>
<?php } else { ?>
		<td><?php echo $Language->Phrase("PermissionList") ?><input type="checkbox" name="List" id="List" onclick="ew_SelectAll(this);"<?php echo $userpriv->Disabled ?>></td>
		<td><?php echo $Language->Phrase("PermissionView") ?><input type="checkbox" name="View" id="View" onclick="ew_SelectAll(this);"<?php echo $userpriv->Disabled ?>></td>
		<td><?php echo $Language->Phrase("PermissionSearch") ?><input type="checkbox" name="Search" id="Search" onclick="ew_SelectAll(this);"<?php echo $userpriv->Disabled ?>></td>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
for ($i = 0; $i < $userpriv->TableNameCount; $i++) {
	$userpriv->TempPriv = $Security->GetUserLevelPrivEx($EW_USER_LEVEL_TABLE_NAME[$i], $usuarioniveles->userlevelid->CurrentValue);

	// Set row properties
	$usuarioniveles->ResetAttrs();
	$usuarioniveles->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
?>
	<tr<?php echo $usuarioniveles->RowAttributes() ?>>
		<td><span class="phpmaker"><?php echo $userpriv->GetTableCaption($i) ?></span></td>
		<td align="center"><input type="checkbox" name="Add_<?php echo $i ?>" id="Add_<?php echo $i ?>" value="1"<?php if (($userpriv->TempPriv & EW_ALLOW_ADD) == EW_ALLOW_ADD) { ?> checked="checked"<?php } ?><?php echo $userpriv->Disabled ?>></td>
		<td align="center"><input type="checkbox" name="Delete_<?php echo $i ?>" id="Delete_<?php echo $i ?>" value="2"<?php if (($userpriv->TempPriv & EW_ALLOW_DELETE) == EW_ALLOW_DELETE) { ?> checked="checked"<?php } ?><?php echo $userpriv->Disabled ?>></td>
		<td align="center"><input type="checkbox" name="Edit_<?php echo $i ?>" id="Edit_<?php echo $i ?>" value="4"<?php if (($userpriv->TempPriv & EW_ALLOW_EDIT) == EW_ALLOW_EDIT) { ?> checked="checked"<?php } ?><?php echo $userpriv->Disabled ?>></td>
<?php if (defined("EW_USER_LEVEL_COMPAT")) { ?>
		<td align="center"><input type="checkbox" name="List_<?php echo $i ?>" id="List_<?php echo $i ?>" value="8"<?php if (($userpriv->TempPriv & EW_ALLOW_LIST) == EW_ALLOW_LIST) { ?> checked="checked"<?php } ?><?php echo $userpriv->Disabled ?>></td>
<?php } else { ?>
		<td align="center"><input type="checkbox" name="List_<?php echo $i ?>" id="List_<?php echo $i ?>" value="8"<?php if (($userpriv->TempPriv & EW_ALLOW_LIST) == EW_ALLOW_LIST) { ?> checked="checked"<?php } ?><?php echo $userpriv->Disabled ?>></td>
		<td align="center"><input type="checkbox" name="View_<?php echo $i ?>" id="View_<?php echo $i ?>" value="32"<?php if (($userpriv->TempPriv & EW_ALLOW_VIEW) == EW_ALLOW_VIEW) { ?> checked="checked"<?php } ?><?php echo $userpriv->Disabled ?>></td>
		<td align="center"><input type="checkbox" name="Search_<?php echo $i ?>" id="Search_<?php echo $i ?>" value="64"<?php if (($userpriv->TempPriv & EW_ALLOW_SEARCH) == EW_ALLOW_SEARCH) { ?> checked="checked"<?php } ?><?php echo $userpriv->Disabled ?>></td>
<?php } ?>
	</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo ew_BtnCaption($Language->Phrase("Update")) ?>"<?php echo $userpriv->Disabled ?>>
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$userpriv->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserpriv {

	// Page ID
	var $PageID = 'userpriv';

	// Page object name
	var $PageObjName = 'userpriv';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

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
		return TRUE;
	}

	//
	// Page class constructor
	//
	function cuserpriv() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuarioniveles)
		if (!isset($GLOBALS["usuarioniveles"])) $GLOBALS["usuarioniveles"] = new cusuarioniveles();

		// User table object (usuarios)
		if (!isset($GLOBALS["usuarios"])) $GLOBALS["usuarios"] = new cusuarios;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'userpriv', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $usuarioniveles;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel('usuarioniveles');
		$Security->TablePermission_Loaded();
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

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
	var $TempPriv;
	var $Disabled;
	var $Privileges;
	var $TableNameCount;
	var $ReportLanguage;

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language, $usuarioniveles;

		// Try to load PHP Report Maker language file
		// Note: The langauge IDs must be the same in both projects

		if (defined("EW_REPORT_LANGUAGE_FOLDER"))
			$this->ReportLanguage = new cLanguage(EW_REPORT_LANGUAGE_FOLDER);
		if (!is_array($GLOBALS["EW_USER_LEVEL_TABLE_NAME"])) {
			$this->setFailureMessage($Language->Phrase("NoTableGenerated"));
			$this->Page_Terminate("usuarioniveleslist.php"); // Return to list
		}
		$this->TableNameCount = count($GLOBALS["EW_USER_LEVEL_TABLE_NAME"]);
		$this->TableCaptionCount = count($GLOBALS["EW_USER_LEVEL_TABLE_CAPTION"]);
		$this->Privileges =& ew_InitArray($this->TableNameCount, 0);

		// Get action
		if (@$_POST["a_edit"] == "") {
			$usuarioniveles->CurrentAction = "I"; // Display with input box

			// Load key from QueryString
			if (@$_GET["userlevelid"] <> "") {
				$usuarioniveles->userlevelid->setQueryStringValue($_GET["userlevelid"]);
			} else {
				$this->Page_Terminate("usuarioniveleslist.php"); // Return to list
			}
			if ($usuarioniveles->userlevelid->QueryStringValue == "-1") {
				$this->Disabled = " disabled=\"disabled\"";
			} else {
				$this->Disabled = "";
			}
		} else {
			$usuarioniveles->CurrentAction = $_POST["a_edit"];

			// Get fields from form
			$usuarioniveles->userlevelid->setFormValue($_POST["x_userlevelid"]);
			for ($i = 0; $i < $this->TableNameCount; $i++) {
				if (defined("EW_USER_LEVEL_COMPAT")) {
					$this->Privileges[$i] = intval(@$_POST["Add_" . $i]) + 
						intval(@$_POST["Delete_" . $i]) + intval(@$_POST["Edit_" . $i]) +
						intval(@$_POST["List_" . $i]);
				} else {
					$this->Privileges[$i] = intval(@$_POST["Add_" . $i]) +
						intval(@$_POST["Delete_" . $i]) + intval(@$_POST["Edit_" . $i]) +
						intval(@$_POST["List_" . $i]) + intval(@$_POST["View_" . $i]) +
						intval(@$_POST["Search_" . $i]);
				}
			}
		}
		switch ($usuarioniveles->CurrentAction) {
			case "I": // Display
				$Security->SetUpUserLevelEx(); // Get all User Level info
				break;
			case "U": // Update
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set update success message

					// Alternatively, comment out the following line to go back to this page
					$this->Page_Terminate("usuarioniveleslist.php"); // Return to list
				}
		}
	}

	// Update privileges
	function EditRow() {
		global $conn, $EW_USER_LEVEL_TABLE_NAME, $usuarioniveles;
		for ($i = 0; $i < $this->TableNameCount; $i++) {
			$Sql = "SELECT * FROM " . EW_USER_LEVEL_PRIV_TABLE . " WHERE " . 
				EW_USER_LEVEL_PRIV_TABLE_NAME_FIELD . " = '" . ew_AdjustSql($EW_USER_LEVEL_TABLE_NAME[$i]) . "' AND " .
				EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . " = " . $usuarioniveles->userlevelid->CurrentValue;
			$rs = $conn->Execute($Sql);
			if ($rs && !$rs->EOF) {
				$Sql = "UPDATE " . EW_USER_LEVEL_PRIV_TABLE . " SET " . EW_USER_LEVEL_PRIV_PRIV_FIELD . " = " . $this->Privileges[$i] . " WHERE " .
					EW_USER_LEVEL_PRIV_TABLE_NAME_FIELD . " = '" . ew_AdjustSql($EW_USER_LEVEL_TABLE_NAME[$i]) . "' AND " .
					EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . " = " . $usuarioniveles->userlevelid->CurrentValue;
				$conn->Execute($Sql);
			} else {
				$Sql = "INSERT INTO " . EW_USER_LEVEL_PRIV_TABLE . " (" . EW_USER_LEVEL_PRIV_TABLE_NAME_FIELD . ", " . EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . ", " . EW_USER_LEVEL_PRIV_PRIV_FIELD . ") VALUES ('" . ew_AdjustSql($EW_USER_LEVEL_TABLE_NAME[$i]) . "', " . $usuarioniveles->userlevelid->CurrentValue . ", " . $this->Privileges[$i] . ")";
				$conn->Execute($Sql);
			}
			if ($rs)
				$rs->Close();
		}
		return TRUE;
	}

	// Get table caption
	function GetTableCaption($i) {
		global $Language, $EW_USER_LEVEL_TABLE_NAME,
			$EW_USER_LEVEL_TABLE_VAR, $EW_USER_LEVEL_TABLE_CAPTION;
		$caption = "";
		if ($i < $this->TableNameCount) {
			$caption = $Language->TablePhrase(@$EW_USER_LEVEL_TABLE_VAR[$i], "TblCaption");
			$report = (substr($GLOBALS["EW_USER_LEVEL_TABLE_NAME"][$i], 0, strlen(EW_TABLE_PREFIX)) == EW_TABLE_PREFIX);
            if ($report && is_object($this->ReportLanguage))
				$caption = $this->ReportLanguage->TablePhrase(@$EW_USER_LEVEL_TABLE_VAR[$i], "TblCaption");
			if ($caption == "" && $i < $this->TableCaptionCount)
				$caption = $EW_USER_LEVEL_TABLE_CAPTION[$i];
			if ($caption == "") {
				$caption = $EW_USER_LEVEL_TABLE_NAME[$i];
				if ($report)
					$caption = substr($caption, strlen(EW_TABLE_PREFIX));
			}
			if ($report)
				$caption .= " (" . $Language->Phrase("Report") . ")";
		}
		return $caption;
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
}
?>
