<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$default = new cdefault();
$Page =& $default;

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php include_once "header.php" ?>
<?php
$default->ShowMessage();
?>
<?php include_once "footer.php" ?>
<?php
$default->Page_Terminate();
?>
<?php

//
// Page class
//
class cdefault {

	// Page ID
	var $PageID = 'default';

	// Page object name
	var $PageObjName = 'default';

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

	//
	// Page class constructor
	//
	function cdefault() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// User table object (usuarios)
		if (!isset($GLOBALS["usuarios"])) $GLOBALS["usuarios"] = new cusuarios;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

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
		global $usuarios;

		// Security
		$Security = new cAdvancedSecurity();

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

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // load User Level
		if ($Security->AllowList('grupo'))
			$this->Page_Terminate("grupolist.php"); // Exit and go to default page
		if ($Security->AllowList('agencias'))
			$this->Page_Terminate("agenciaslist.php");
		if ($Security->AllowList('agencias_servicios'))
			$this->Page_Terminate("agencias_servicioslist.php");
		if ($Security->AllowList('banner'))
			$this->Page_Terminate("bannerlist.php");
		if ($Security->AllowList('banner_seccion'))
			$this->Page_Terminate("banner_seccionlist.php");
		if ($Security->AllowList('bitacora'))
			$this->Page_Terminate("bitacoralist.php");
		if ($Security->AllowList('calendario'))
			$this->Page_Terminate("calendariolist.php");
		if ($Security->AllowList('ciudad'))
			$this->Page_Terminate("ciudadlist.php");
		if ($Security->AllowList('documentos'))
			$this->Page_Terminate("documentoslist.php");
		if ($Security->AllowList('documentos_secciones'))
			$this->Page_Terminate("documentos_seccioneslist.php");
		if ($Security->AllowList('encuesta'))
			$this->Page_Terminate("encuestalist.php");
		if ($Security->AllowList('estado'))
			$this->Page_Terminate("estadolist.php");
		
		if ($Security->AllowList('grupo_secciones'))
			$this->Page_Terminate("grupo_seccioneslist.php");
		if ($Security->AllowList('informacion_financiera'))
			$this->Page_Terminate("informacion_financieralist.php");
		if ($Security->AllowList('modulos'))
			$this->Page_Terminate("moduloslist.php");
		if ($Security->AllowList('noticias'))
			$this->Page_Terminate("noticiaslist.php");
		if ($Security->AllowList('parametros'))
			$this->Page_Terminate("parametroslist.php");
		if ($Security->AllowList('preguntas'))
			$this->Page_Terminate("preguntaslist.php");
		if ($Security->AllowList('respuestas'))
			$this->Page_Terminate("respuestaslist.php");
		if ($Security->AllowList('contenidos'))
			$this->Page_Terminate("contenidoslist.php");
		if ($Security->AllowList('servicios'))
			$this->Page_Terminate("servicioslist.php");
		if ($Security->AllowList('usuarios'))
			$this->Page_Terminate("usuarioslist.php");
		if ($Security->AllowList('menu'))
			$this->Page_Terminate("zmenulist.php");
		if ($Security->AllowList('usuarioniveles'))
			$this->Page_Terminate("usuarioniveleslist.php");
		if ($Security->AllowList('auditoria'))
			$this->Page_Terminate("auditorialist.php");
		if ($Security->AllowList('view1'))
			$this->Page_Terminate("view1list.php");
		if ($Security->AllowList('view2'))
			$this->Page_Terminate("view2list.php");
		if ($Security->IsLoggedIn()) {
			$this->setFailureMessage($Language->Phrase("NoPermission") . "<br><br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>");
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
		}
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
}
?>
