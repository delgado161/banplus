<?php

// Compatibility with PHP Report Maker
if (!isset($Language)) {
	include_once "ewcfg8.php";
	include_once "ewshared8.php";
	$Language = new cLanguage();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>



	<title><?php echo $Language->ProjectPhrase("BodyTitle") ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo ew_YuiHost() ?>build/container/assets/skins/sam/container.css">
<link rel="stylesheet" type="text/css" href="<?php echo ew_YuiHost() ?>build/resize/assets/skins/sam/resize.css">
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/utilities/utilities.js"></script>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/container/container-min.js"></script>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/resize/resize-min.js"></script>
<script type="text/javascript">
<!--
var EW_LANGUAGE_ID = "<?php echo $gsLanguage ?>";
var EW_DATE_SEPARATOR = "/"; 
if (EW_DATE_SEPARATOR == "") EW_DATE_SEPARATOR = "/"; // Default date separator
var EW_UPLOAD_ALLOWED_FILE_EXT = "gif,jpg,jpeg,bmp,png,doc,xls,pdf,zip"; // Allowed upload file extension
var EW_UPLOAD_ALLOWED_FILE_EXT22 = "pdf"; // Allowed upload file extension
var EW_FIELD_SEP = ", "; // Default field separator

// Ajax settings
var EW_RECORD_DELIMITER = "\r";
var EW_FIELD_DELIMITER = "|";
var EW_LOOKUP_FILE_NAME = "ewlookup8.php"; // Lookup file name
var EW_AUTO_SUGGEST_MAX_ENTRIES = <?php echo EW_AUTO_SUGGEST_MAX_ENTRIES ?>; // Auto-Suggest max entries

// Common JavaScript messages
var EW_ADDOPT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("AddBtn"))) ?>";
var EW_EMAIL_EXPORT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("SendEmailBtn"))) ?>";
var EW_BUTTON_CANCEL_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("CancelBtn"))) ?>";
var ewTooltipDiv;
var ew_TooltipTimer = null;

//-->
</script>
<script type="text/javascript" src="phpjs/ewp8.js"></script>
<script type="text/javascript" src="phpjs/pwd_meter_min.js"></script>
<script type="text/javascript" src="phpjs/crypto.js"></script>
<script type="text/javascript" src="phpjs/userfn8.js"></script>
<script type="text/javascript">
<!--
<?php echo $Language->ToJSON() ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<meta name="generator" content="PHPMaker v8.0.2">
</head>
<title>BANPLUS - Administrador de Contenidos</title>
<body class="yui-skin-sam">
	<?php
		$alink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];		
		if (strpos($alink,'atenasnew')){
			$ab = 'Ambiente Desarrollo';
		}else if (strpos($alink,'www.banplus.com')) {
			$ab = 'Ambiente Producci&oacute;n';
		}else {
			$ab = 'Ambiente Calidad';
		}
	?>
<div class="ewLayout">
	<!-- header (begin) --><!-- *** Note: Only licensed users are allowed to change the logo *** -->
	<table border="0" width="100%" >
	  <tr>  <td  width="100%">	  
		<div class="ewHeaderRow"><img src="phpimages/logo.png" style="height:80px; rezise:vertical" alt="" border="0"> </div> 
	   </td>
	   <td id="menu">
		<div class="sf-menu">
			<b><span style="font-size:18px">Administrador de Contenidos</span></b>
			<b><span style="font-size:18px"><?php echo $ab; ?></span></b>
		</div>
	   </td> 
	  </tr>

	  <tr><td colspan=2 height="20px">&nbsp;  </td>
	  	  </tr>
<!--	  <tr><td  height="20px">&nbsp;  </td>		  
											***************		TD UBICADOS DEBAJO DEL BANNER	***********		-->	  
      <td><div class="sf-menu2">	</div> </td> 
	  </tr>

 
 	  </table> 
  <!--div id="menu">Administrador de Contenidos</div-->
  
 
  
  
	<!-- header (end) -->
	<!-- content (begin) -->
	
  <!--<table cellspacing="0" class="ewContentTable" name="Tabla Header">
		<tr>	
			<td class="ewMenuColumn">
	-->

 <table cellspacing="0" class="ewContentTable" name="Tabla Header">
		<tr>	
		<?php if (IsLoggedIn()){
		

		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$actual_link = strpos($actual_link,'usuarioseditpass.php');
		
		if (!$actual_link){
			/*redireccion cambio de contraseña por seguridad*/
			global $conexion2;  
			$conexion2 = ew_Connect();
			$query = " SELECT nombre, apellido, acceso, estatus, duracion_pass, duracion_fech , TIMESTAMPDIFF( DAY,duracion_fech,now()) 
						as fdif , id_usuario from usuarios where acceso = '".$_SESSION[EW_SESSION_USER_PROFILE_USER_NAME]."' ";
			$result = $conexion2->GetArray($query);
			$_SESSION['IDUSER'] = $result[0][7];
			
			if ($result[0][4]==0){
				header("location: usuarioseditpass.php?i=1&id_usuario=".$result[0][7]);
			}else {
				// echo "<li>f:".$result[0][5];
				// echo "<li>dias:".$result[0][6];				
				switch(intval($result[0][4])){
					case 2: $eval = 30; break;
					case 3: $eval = 60; break;
					case 4: $eval = 120; break;
				}				
				if (intval($result[0][6])>$eval) {
					header("location: usuarioseditpass.php?i=2&id_usuario=".$result[0][7]);
				}else {
					$_SESSION['IDUSER'] = "";
				}
			}
			/*redireccion cambio de contraseña por seguridad*/
			
		}

		echo	"<td class='ewMenuColumn'>";
		}
		?>	
			<!-- left column (begin) -->
<?php include_once "ewmenu.php" ?>
			<!-- left column (end) -->
			</td>	
			
			<!-- left column (begin) -->
<?php include_once "ewmenu.php" ?>
			<!-- left column (end) -->
			</td>
	    <td class="ewContentColumn">
        
			<!-- right column (begin) -->
	<p class="phpmaker ewTitle" align="right">			
        <b>					<!--******SPAN: BARRA AZUL DEL HEADER***-->
        <?php echo $Language->ProjectPhrase("BodyTitle") ?>	<!--******AGREGA EL NOMBRE DE LA TABLA EN LA PARTE SUPERIOR***-->
        </b>
   </p>
	<div class="line"></div>
