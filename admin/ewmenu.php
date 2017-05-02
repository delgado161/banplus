<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENUBAR_ITEM_CLASSNAME", "", TRUE);
define("EW_MENUBAR_ITEM_LABEL_CLASSNAME", "", TRUE);
define("EW_MENU_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENU_ITEM_CLASSNAME", "", TRUE);
define("EW_MENU_ITEM_LABEL_CLASSNAME", "", TRUE);
?>
<?php

// Menu Rendering event
function Menu_Rendering(&$Menu) {

	// Change menu items here
}

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(84, $Language->MenuPhrase("84", "MenuText"), "", -1, "", True, FALSE);
$RootMenu->AddMenuItem(13, $Language->MenuPhrase("13", "MenuText"), "grupolist.php", 84, "", AllowListMenu('grupo'), FALSE);
$RootMenu->AddMenuItem(21, $Language->MenuPhrase("21", "MenuText"), "contenidoslist.php", 84, "", AllowListMenu('contenidos'), FALSE);
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "documentoslist.php", 84, "", AllowListMenu('documentos'), FALSE);
$RootMenu->AddMenuItem(17, $Language->MenuPhrase("17", "MenuText"), "noticiaslist.php", 84, "", AllowListMenu('noticias'), FALSE);
$RootMenu->AddMenuItem(124, $Language->MenuPhrase("124", "MenuText"), "promocioneslist.php", 84, "", AllowListMenu('promociones'), FALSE);
$RootMenu->AddMenuItem(15, $Language->MenuPhrase("15", "MenuText"), "informacion_financieralist.php", 84, "", AllowListMenu('informacion_financiera'), FALSE);
$RootMenu->AddMenuItem(23, $Language->MenuPhrase("23", "MenuText"), "memoria_semestrallist.php", 84, "", AllowListMenu('memoria_semestral'), FALSE);
//$RootMenu->AddMenuItem(15, $Language->MenuPhrase("15", "MenuText"), "memoria_semestrallist.php", 84, "", AllowListMenu('informacion'), FALSE);
$RootMenu->AddMenuItem(125, $Language->MenuPhrase("125", "MenuText"), "faqlist.php", 84, "", AllowListMenu('faq'), FALSE);
$RootMenu->AddMenuItem(36, $Language->MenuPhrase("36", "MenuText"), "", -1, "", True, FALSE);
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "agenciaslist.php", 36, "", AllowListMenu('agencias'), FALSE);
$RootMenu->AddMenuItem(22, $Language->MenuPhrase("22", "MenuText"), "servicioslist.php", 36, "", AllowListMenu('servicios'), FALSE);
$RootMenu->AddMenuItem(62, $Language->MenuPhrase("62", "MenuText"), "", -1, "", True, FALSE);
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "bannerlist.php", 62, "", AllowListMenu('banner'), FALSE);
$RootMenu->AddMenuItem(85, $Language->MenuPhrase("85", "MenuText"), "", -1, "", True, FALSE);
$RootMenu->AddMenuItem(11, $Language->MenuPhrase("11", "MenuText"), "encuestalist.php", 85, "", AllowListMenu('encuesta'), FALSE);
$RootMenu->AddMenuItem(114, $Language->MenuPhrase("114", "MenuText"), "", -1, "", True, FALSE);
$RootMenu->AddMenuItem(25, $Language->MenuPhrase("25", "MenuText"), "usuarioslist.php", 114, "", AllowListMenu('usuarios'), FALSE);
$RootMenu->AddMenuItem(116, $Language->MenuPhrase("116", "MenuText"), "usuarioniveleslist.php", 114, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE);
$RootMenu->AddMenuItem(113, $Language->MenuPhrase("113", "MenuText"), "", -1, "", True, FALSE);
$RootMenu->AddMenuItem(115, $Language->MenuPhrase("115", "MenuText"), "zmenulist.php", 113, "", AllowListMenu('menu'), FALSE);
$RootMenu->AddMenuItem(12, $Language->MenuPhrase("12", "MenuText"), "estadolist.php", 113, "", AllowListMenu('estado'), FALSE);
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "ciudadlist.php", 113, "", AllowListMenu('ciudad'), FALSE);
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "calendariolist.php", 113, "", AllowListMenu('calendario'), FALSE);
$RootMenu->AddMenuItem(126, $Language->MenuPhrase("126", "MenuText"), "departamentoslist.php", 113, "", AllowListMenu('departamentos'), FALSE);
$RootMenu->AddMenuItem(128, $Language->MenuPhrase("128", "MenuText"), "nivel_academicolist.php", 113, "", AllowListMenu('nivel_academico'), FALSE);
$RootMenu->AddMenuItem(127, $Language->MenuPhrase("127", "MenuText"), "aspiracion_salariallist.php", 113, "", AllowListMenu('aspiracion_salarial'), FALSE);
$RootMenu->AddMenuItem(129, $Language->MenuPhrase("129", "MenuText"), "tasas_intereslist.php", 113, "", AllowListMenu('Tasas de Interes'), FALSE);
$RootMenu->AddMenuItem(130, $Language->MenuPhrase("130", "MenuText"), "cuotaslist.php", 113, "", AllowListMenu('cuotas'), FALSE);
$RootMenu->AddMenuItem(18, $Language->MenuPhrase("18", "MenuText"), "parametroslist.php", 113, "", AllowListMenu('parametros'), FALSE);
$RootMenu->AddMenuItem(121, $Language->MenuPhrase("121", "MenuText"), "auditorialist.php", 113, "", AllowListMenu('auditoria'), FALSE);
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
//$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
