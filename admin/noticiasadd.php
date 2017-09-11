<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "noticiasinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$noticias_add = new cnoticias_add();
$Page =& $noticias_add;

// Page init
$noticias_add->Page_Init();

// Page main
$noticias_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var noticias_add = new ew_Page("noticias_add");

// page properties
noticias_add.PageID = "add"; // page ID
noticias_add.FormID = "fnoticiasadd"; // form ID
var EW_PAGE_ID = noticias_add.PageID; // for backward compatibility

// extend page with ValidateForm function
noticias_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	var tipo;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_tipo"];
		tipo = elm.value;
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($noticias->tipo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_titulo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo "T�tulo"  ?>");
		elm = fobj.elements["x" + infix + "_contenido"];
		if (tipo ==1){
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($noticias->contenido->FldCaption()) ?>");
		}
		elm = fobj.elements["x" + infix + "_id_grupo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($noticias->id_grupo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($noticias->fecha->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($noticias->fecha->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_f_desde"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($noticias->f_desde->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_f_desde"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($noticias->f_desde->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_f_hasta"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($noticias->f_hasta->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_f_hasta"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($noticias->f_hasta->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estatus"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($noticias->estatus->FldCaption()) ?>");

			
		if(tipo==5)	{	
		elm = fobj.elements["x" + infix + "_noticias_link"];
		
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($noticias->noticias_link->FldCaption()) ?>");
		
		}	
			
		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
noticias_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
noticias_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
noticias_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $noticias->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $noticias->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $noticias_add->ShowPageHeader(); ?>
<?php
$noticias_add->ShowMessage();
?>
<form name="fnoticiasadd" id="fnoticiasadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return noticias_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="noticias">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($noticias->tipo->Visible) { // tipo ?>
	<tr id="r_tipo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->tipo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->tipo->CellAttributes() ?>><span id="el_tipo">
<select id="x_tipo" name="x_tipo"<?php echo $noticias->tipo->EditAttributes() ?>>
<?php
if (is_array($noticias->tipo->EditValue)) {
	$arwrk = $noticias->tipo->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($noticias->tipo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $noticias->tipo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->titulo->Visible) { // titulo ?>
	<tr id="r_titulo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->titulo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->titulo->CellAttributes() ?>><span id="el_titulo">
<input type="text" name="x_titulo" id="x_titulo" size="150" maxlength="150" value="<?php echo $noticias->titulo->EditValue ?>"<?php echo $noticias->titulo->EditAttributes() ?>>
</span><?php echo $noticias->titulo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->antetitulo->Visible) { // antetitulo ?>
	<tr id="r_antetitulo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->antetitulo->FldCaption() ?></td>
		<td<?php echo $noticias->antetitulo->CellAttributes() ?>><span id="el_antetitulo">
<input type="text" name="x_antetitulo" id="x_antetitulo" size="100" maxlength="100" value="<?php echo $noticias->antetitulo->EditValue ?>"<?php echo $noticias->antetitulo->EditAttributes() ?>>
</span><?php echo $noticias->antetitulo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->sumario->Visible) { // sumario ?>
	<tr id="r_sumario"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->sumario->FldCaption() ?></td>
		<td<?php echo $noticias->sumario->CellAttributes() ?>><span id="el_sumario">
<textarea name="x_sumario" id="x_sumario" cols="0" rows="2"<?php echo $noticias->sumario->EditAttributes() ?>><?php echo $noticias->sumario->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($noticias->sumario->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x_sumario', 0*_width_multiplier, 2*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x_sumario", function() {
	var oCKeditor = CKEDITOR.replace('x_sumario', { width: 0*_width_multiplier, height: 2*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
</span><?php echo $noticias->sumario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->contenido->Visible) { // contenido ?>
	<tr id="r_contenido"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->contenido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->contenido->CellAttributes() ?>><span id="el_contenido">
<textarea name="x_contenido" id="x_contenido" cols="0" rows="4"<?php echo $noticias->contenido->EditAttributes() ?>><?php echo $noticias->contenido->EditValue ?></textarea>
<script type="text/javascript">
<!--
<?php if ($noticias->contenido->ReadOnly) { ?>
new ew_ReadOnlyTextArea('x_contenido', 0*_width_multiplier, 4*_height_multiplier);
<?php } else { ?>ew_DHTMLEditors.push(new ew_DHTMLEditor("x_contenido", function() {
	var oCKeditor = CKEDITOR.replace('x_contenido', { width: 0*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
<?php } ?>
-->
</script>
</span><?php echo $noticias->contenido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->id_grupo->Visible) { // id_grupo ?>
	<tr id="r_id_grupo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->id_grupo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->id_grupo->CellAttributes() ?>><span id="el_id_grupo">
<select id="x_id_grupo[]" name="x_id_grupo[]" size=5 multiple="multiple"<?php echo $noticias->id_grupo->EditAttributes() ?>>
<?php
if (is_array($noticias->id_grupo->EditValue)) {
	$arwrk = $noticias->id_grupo->EditValue;
	$armultiwrk= explode(",", strval($noticias->id_grupo->CurrentValue));
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		$cnt = count($armultiwrk);
		for ($ari = 0; $ari < $cnt; $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " selected=\"selected\"";
				if ($selwrk <> "") $emptywrk = FALSE;
				break;
			}
		}	
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $noticias->id_grupo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->imagen->FldCaption() ?></td>
		<td<?php echo $noticias->imagen->CellAttributes() ?>><span id="el_imagen">
<div id="old_x_imagen">
<?php if ($noticias->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($noticias->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $noticias->imagen->UploadPath) . $noticias->imagen->Upload->DbValue ?>" border=0<?php echo $noticias->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($noticias->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($noticias->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $noticias->imagen->UploadPath) . $noticias->imagen->Upload->DbValue ?>" border=0<?php echo $noticias->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($noticias->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_imagen">
<?php if (!empty($noticias->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a_imagen" id="a_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $noticias->imagen->EditAttrs["onchange"] = "this.form.a_imagen[2].checked=true;" . @$noticias->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="3">
<?php } ?>
<input type="file" name="x_imagen" id="x_imagen" size="30"<?php echo $noticias->imagen->EditAttributes() ?>>
</div>
</span><?php echo $noticias->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->fecha->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha" value="<?php echo $noticias->fecha->EditValue ?>"<?php echo $noticias->fecha->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_fecha" name="cal_x_fecha" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_fecha", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_fecha" // button id
});
</script>
</span><?php echo $noticias->fecha->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->orden->Visible) { // orden ?>
	<tr id="r_orden"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->orden->FldCaption() ?></td>
		<td<?php echo $noticias->orden->CellAttributes() ?>><span id="el_orden">
<input type="text" name="x_orden" id="x_orden" size="3" maxlength="3" value="<?php echo $noticias->orden->EditValue ?>"<?php echo $noticias->orden->EditAttributes() ?>>
</span><?php echo $noticias->orden->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->f_desde->Visible) { // f_desde ?>
	<tr id="r_f_desde"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->f_desde->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->f_desde->CellAttributes() ?>><span id="el_f_desde">
<input type="text" name="x_f_desde" id="x_f_desde" value="<?php echo $noticias->f_desde->EditValue ?>"<?php echo $noticias->f_desde->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_f_desde" name="cal_x_f_desde" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_f_desde", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_f_desde" // button id
});
</script>
</span><?php echo $noticias->f_desde->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($noticias->f_hasta->Visible) { // f_hasta ?>
	<tr id="r_f_hasta"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->f_hasta->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->f_hasta->CellAttributes() ?>><span id="el_f_hasta">
<input type="text" name="x_f_hasta" id="x_f_hasta" value="<?php echo $noticias->f_hasta->EditValue ?>"<?php echo $noticias->f_hasta->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_f_hasta" name="cal_x_f_hasta" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_f_hasta", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_f_hasta" // button id
});
</script>
</span><?php echo $noticias->f_hasta->CustomMsg ?></td>
	</tr>
<?php } ?>

<?php /* if ($noticias->f_hasta->Visible) { // f_hasta ?>
	<tr id="r_f_hasta"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->f_hasta->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->f_hasta->CellAttributes() ?>><span id="el_f_hasta">
<input type="text" name="x_f_hasta" id="x_f_hasta" value="<?php echo $noticias->f_hasta->EditValue ?>"<?php echo $noticias->f_hasta->EditAttributes() ?>>
</span><?php echo $noticias->f_hasta->CustomMsg ?></td>
	</tr>
<?php } */?>
<?php if ($noticias->archivo->Visible) { // archivo ?>
	<tr id="r_archivo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->archivo->FldCaption() ?></td>
		<td<?php echo $noticias->archivo->CellAttributes() ?>><span id="el_archivo">
<div id="old_x_archivo">
<?php if ($noticias->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($noticias->archivo->Upload->DbValue)) { ?>
<a<?php echo $noticias->archivo->LinkAttributes() ?>><?php echo $noticias->archivo->EditValue ?></a>
<?php } elseif (!in_array($noticias->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;


<?php if ($noticias->archivo->Visible) { // archivo ?>
	<tr id="r_archivo"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->archivo->FldCaption() ?></td>
		<td<?php echo $noticias->archivo->CellAttributes() ?>><span id="el_archivo">
<div id="old_x_archivo">
<?php if ($noticias->archivo->LinkAttributes() <> "") { ?>
<?php if (!empty($noticias->archivo->Upload->DbValue)) { ?>
<a<?php echo $noticias->archivo->LinkAttributes() ?>><?php echo $noticias->archivo->EditValue ?></a>
<?php } elseif (!in_array($noticias->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;






<?php } ?>
<?php } else { ?>
<?php if (!empty($noticias->archivo->Upload->DbValue)) { ?>
<?php echo $noticias->archivo->EditValue ?>
<?php } elseif (!in_array($noticias->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_archivo">
<?php if (!empty($noticias->archivo->Upload->DbValue)) { ?>
<label><input type="radio" name="a_archivo" id="a_archivo" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $noticias->archivo->EditAttrs["onchange"] = "this.form.a_archivo[2].checked=true;" . @$noticias->archivo->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_archivo" id="a_archivo" value="3">
<?php } ?>
<input type="file" name="x_archivo" id="x_archivo" size="30"<?php echo $noticias->archivo->EditAttributes() ?>>
</div>
</span><?php echo $noticias->archivo->CustomMsg ?></td>
	</tr>
<?php } ?>



<?php } ?>
<?php } else { ?>
<?php if (!empty($noticias->archivo->Upload->DbValue)) { ?>
<?php echo $noticias->archivo->EditValue ?>
<?php } elseif (!in_array($noticias->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_archivo">
<?php if (!empty($noticias->archivo->Upload->DbValue)) { ?>
<label><input type="radio" name="a_archivo" id="a_archivo" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_archivo" id="a_archivo" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $noticias->archivo->EditAttrs["onchange"] = "this.form.a_archivo[2].checked=true;" . @$noticias->archivo->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_archivo" id="a_archivo" value="3">
<?php } ?>
<input type="file" name="x_archivo" id="x_archivo" size="30"<?php echo $noticias->archivo->EditAttributes() ?>>
</div>
</span><?php echo $noticias->archivo->CustomMsg ?></td>
	</tr>
<?php } ?>

<?php if ($noticias->noticias_link->Visible) { // noticias_link ?>
	<tr id="r_noticias_link"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo "Link a noticia" ?> <?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->noticias_link->CellAttributes() ?>><span id="el_noticias_link">
<textarea name="x_noticias_link" id="x_noticias_link" cols="35" rows="4"<?php echo $noticias->noticias_link->EditAttributes() ?>><?php echo $noticias->noticias_link->EditValue ?></textarea>
</span><?php echo $noticias->noticias_link->CustomMsg ?></td>
	</tr>
<?php } ?>


<?php if ($noticias->estatus->Visible) { // estatus ?>
	<tr id="r_estatus"<?php echo $noticias->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $noticias->estatus->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $noticias->estatus->CellAttributes() ?>><span id="el_estatus">
<select id="x_estatus" name="x_estatus"<?php echo $noticias->estatus->EditAttributes() ?>>
<?php
if (is_array($noticias->estatus->EditValue)) {
	$arwrk = $noticias->estatus->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($noticias->estatus->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $noticias->estatus->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$noticias_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
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
<?php include_once "footer.php" ?>
<?php
$noticias_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cnoticias_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'noticias';

	// Page object name
	var $PageObjName = 'noticias_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $noticias;
		if ($noticias->UseTokenInUrl) $PageUrl .= "t=" . $noticias->TableVar . "&"; // Add page token
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
		global $objForm, $noticias;
		if ($noticias->UseTokenInUrl) {
			if ($objForm)
				return ($noticias->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($noticias->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cnoticias_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (noticias)
		if (!isset($GLOBALS["noticias"])) {
			$GLOBALS["noticias"] = new cnoticias();
			$GLOBALS["Table"] =& $GLOBALS["noticias"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'noticias', TRUE);

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
		global $noticias;

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("noticiaslist.php");
		}

		// Create form object
		$objForm = new cFormObj();

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $noticias;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$noticias->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$noticias->CurrentAction = "I"; // Form error, reset action
				$noticias->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id_noticia"] != "") {
				$noticias->id_noticia->setQueryStringValue($_GET["id_noticia"]);
				$noticias->setKey("id_noticia", $noticias->id_noticia->CurrentValue); // Set up key
			} else {
				$noticias->setKey("id_noticia", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$noticias->CurrentAction = "C"; // Copy record
			} else {
				$noticias->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($noticias->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("noticiaslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$noticias->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $noticias->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "noticiasview.php")
						$sReturnUrl = $noticias->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$noticias->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$noticias->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$noticias->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $noticias;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$noticias->imagen->Upload->Index = $objForm->Index;
		$noticias->imagen->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$noticias->imagen->Upload->RestoreFromSession();
		} else {
			if ($noticias->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $noticias->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$noticias->imagen->Upload->SaveToSession();
			$noticias->imagen->CurrentValue = $noticias->imagen->Upload->FileName;
		}
		
		$noticias->archivo->Upload->Index = $objForm->Index;
		$noticias->archivo->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$noticias->archivo->Upload->RestoreFromSession();
		} else {
			if ($noticias->archivo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $noticias->archivo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$noticias->archivo->Upload->SaveToSession();
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $noticias;
		$noticias->tipo->CurrentValue = 1;
		$noticias->titulo->CurrentValue = NULL;
		$noticias->titulo->OldValue = $noticias->titulo->CurrentValue;
		$noticias->antetitulo->CurrentValue = NULL;
		$noticias->antetitulo->OldValue = $noticias->antetitulo->CurrentValue;
		$noticias->sumario->CurrentValue = NULL;
		$noticias->sumario->OldValue = $noticias->sumario->CurrentValue;
		$noticias->contenido->CurrentValue = NULL;
		$noticias->contenido->OldValue = $noticias->contenido->CurrentValue;
		$noticias->id_grupo->CurrentValue = NULL;
		$noticias->id_grupo->OldValue = $noticias->id_grupo->CurrentValue;
		$noticias->imagen->Upload->DbValue = NULL;
		$noticias->imagen->OldValue = $noticias->imagen->Upload->DbValue;
		$noticias->imagen->CurrentValue = NULL; // Clear file related field
		$noticias->fecha->CurrentValue = NULL;
		$noticias->fecha->OldValue = $noticias->fecha->CurrentValue;
		$noticias->orden->CurrentValue = NULL;
		$noticias->orden->OldValue = $noticias->orden->CurrentValue;
		$noticias->f_desde->CurrentValue = NULL;
		$noticias->f_desde->OldValue = $noticias->f_desde->CurrentValue;
		$noticias->f_hasta->CurrentValue = NULL;
		$noticias->f_hasta->OldValue = $noticias->f_hasta->CurrentValue;
		$noticias->estatus->CurrentValue = NULL;
		$noticias->estatus->OldValue = $noticias->estatus->CurrentValue;
		$noticias->archivo->Upload->DbValue = NULL;
		$noticias->archivo->OldValue = $noticias->archivo->Upload->DbValue;
		$noticias->noticias_link->CurrentValue = NULL;
		$noticias->noticias_link->OldValue = $noticias->noticias_link->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $noticias;
		$this->GetUploadFiles(); // Get upload files
		if (!$noticias->tipo->FldIsDetailKey) {
			$noticias->tipo->setFormValue($objForm->GetValue("x_tipo"));
		}
		if (!$noticias->titulo->FldIsDetailKey) {
			$noticias->titulo->setFormValue($objForm->GetValue("x_titulo"));
		}
		if (!$noticias->antetitulo->FldIsDetailKey) {
			$noticias->antetitulo->setFormValue($objForm->GetValue("x_antetitulo"));
		}
		if (!$noticias->sumario->FldIsDetailKey) {
			$noticias->sumario->setFormValue($objForm->GetValue("x_sumario"));
		}
		if (!$noticias->contenido->FldIsDetailKey) {
			$noticias->contenido->setFormValue($objForm->GetValue("x_contenido"));
		}
		if (!$noticias->id_grupo->FldIsDetailKey) {
			$noticias->id_grupo->setFormValue($objForm->GetValue("x_id_grupo"));
		}
		if (!$noticias->fecha->FldIsDetailKey) {
			$noticias->fecha->setFormValue($objForm->GetValue("x_fecha"));
			$noticias->fecha->CurrentValue = ew_UnFormatDateTime($noticias->fecha->CurrentValue, 7);
		}
		if (!$noticias->orden->FldIsDetailKey) {
			$noticias->orden->setFormValue($objForm->GetValue("x_orden"));
		}
		if (!$noticias->f_desde->FldIsDetailKey) {
			$noticias->f_desde->setFormValue($objForm->GetValue("x_f_desde"));
			$noticias->f_desde->CurrentValue = ew_UnFormatDateTime($noticias->f_desde->CurrentValue, 7);
		}
		if (!$noticias->f_hasta->FldIsDetailKey) {
			$noticias->f_hasta->setFormValue($objForm->GetValue("x_f_hasta"));
			$noticias->f_hasta->CurrentValue = ew_UnFormatDateTime($noticias->f_hasta->CurrentValue, 7);
		}
		if (!$noticias->estatus->FldIsDetailKey) {
			$noticias->estatus->setFormValue($objForm->GetValue("x_estatus"));
		}
		
		if (!$noticias->noticias_link->FldIsDetailKey) {
			$noticias->noticias_link->setFormValue($objForm->GetValue("x_noticias_link"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $noticias;
		$this->LoadOldRecord();
		$noticias->tipo->CurrentValue = $noticias->tipo->FormValue;
		$noticias->titulo->CurrentValue = $noticias->titulo->FormValue;
		$noticias->antetitulo->CurrentValue = $noticias->antetitulo->FormValue;
		$noticias->sumario->CurrentValue = $noticias->sumario->FormValue;
		$noticias->contenido->CurrentValue = $noticias->contenido->FormValue;
		$noticias->id_grupo->CurrentValue = $noticias->id_grupo->FormValue;
		$noticias->fecha->CurrentValue = $noticias->fecha->FormValue;
		$noticias->fecha->CurrentValue = ew_UnFormatDateTime($noticias->fecha->CurrentValue, 7);
		$noticias->orden->CurrentValue = $noticias->orden->FormValue;
		$noticias->f_desde->CurrentValue = $noticias->f_desde->FormValue;
		$noticias->f_desde->CurrentValue = ew_UnFormatDateTime($noticias->f_desde->CurrentValue, 7);
		$noticias->f_hasta->CurrentValue = $noticias->f_hasta->FormValue;
		$noticias->f_hasta->CurrentValue = ew_UnFormatDateTime($noticias->f_hasta->CurrentValue, 7);
		$noticias->estatus->CurrentValue = $noticias->estatus->FormValue;
		$noticias->noticias_link->CurrentValue = $noticias->noticias_link->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $noticias;
		$sFilter = $noticias->KeyFilter();

		// Call Row Selecting event
		$noticias->Row_Selecting($sFilter);

		// Load SQL based on filter
		$noticias->CurrentFilter = $sFilter;
		$sSql = $noticias->SQL();
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
		global $conn, $noticias;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$noticias->Row_Selected($row);
		$noticias->id_noticia->setDbValue($rs->fields('id_noticia'));
		$noticias->tipo->setDbValue($rs->fields('tipo'));
		$noticias->titulo->setDbValue($rs->fields('titulo'));
		$noticias->antetitulo->setDbValue($rs->fields('antetitulo'));
		$noticias->sumario->setDbValue($rs->fields('sumario'));
		$noticias->contenido->setDbValue($rs->fields('contenido'));
		$noticias->id_grupo->setDbValue($rs->fields('id_grupo'));
		$noticias->imagen->Upload->DbValue = $rs->fields('imagen');
		$noticias->fecha->setDbValue($rs->fields('fecha'));
		$noticias->orden->setDbValue($rs->fields('orden'));
		$noticias->f_desde->setDbValue($rs->fields('f_desde'));
		$noticias->f_hasta->setDbValue($rs->fields('f_hasta'));
		$noticias->estatus->setDbValue($rs->fields('estatus'));
		$noticias->archivo->Upload->DbValue = $rs->fields('archivo');
		$noticias->noticias_link->setDbValue($rs->fields('noticias_link'));
	}

	// Load old record
	function LoadOldRecord() {
		global $noticias;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($noticias->getKey("id_noticia")) <> "")
			$noticias->id_noticia->CurrentValue = $noticias->getKey("id_noticia"); // id_noticia
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$noticias->CurrentFilter = $noticias->KeyFilter();
			$sSql = $noticias->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $noticias;

		// Initialize URLs
		// Call Row_Rendering event

		$noticias->Row_Rendering();

		// Common render codes for all row types
		// id_noticia
		// tipo
		// titulo
		// antetitulo
		// sumario
		// contenido
		// id_grupo
		// imagen
		// fecha
		// orden
		// f_desde
		// f_hasta
		// estatus

		if ($noticias->RowType == EW_ROWTYPE_VIEW) { // View row

			// tipo
			if (strval($noticias->tipo->CurrentValue) <> "") {
				switch ($noticias->tipo->CurrentValue) {
					case "1":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(1) <> "" ? $noticias->tipo->FldTagCaption(1) : $noticias->tipo->CurrentValue;
						break;
					case "2":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(2) <> "" ? $noticias->tipo->FldTagCaption(2) : $noticias->tipo->CurrentValue;
						break;
					case "3":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(3) <> "" ? $noticias->tipo->FldTagCaption(3) : $noticias->tipo->CurrentValue;
						break;
					case "4":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(4) <> "" ? $noticias->tipo->FldTagCaption(4) : $noticias->tipo->CurrentValue;
						break;
					case "5":
						$noticias->tipo->ViewValue = $noticias->tipo->FldTagCaption(5) <> "" ? $noticias->tipo->FldTagCaption(5) : $noticias->tipo->CurrentValue;
						break;
					default:
						$noticias->tipo->ViewValue = $noticias->tipo->CurrentValue;
				}
			} else {
				$noticias->tipo->ViewValue = NULL;
			}
			$noticias->tipo->ViewCustomAttributes = "";

			// titulo
			$noticias->titulo->ViewValue = $noticias->titulo->CurrentValue;
			$noticias->titulo->ViewCustomAttributes = "";

			// antetitulo
			$noticias->antetitulo->ViewValue = $noticias->antetitulo->CurrentValue;
			$noticias->antetitulo->ViewCustomAttributes = "";

			// sumario
			$noticias->sumario->ViewValue = $noticias->sumario->CurrentValue;
			$noticias->sumario->ViewCustomAttributes = "";

			// contenido
			$noticias->contenido->ViewValue = $noticias->contenido->CurrentValue;
			$noticias->contenido->ViewCustomAttributes = "";

			// id_grupo
			if (strval($noticias->id_grupo->CurrentValue) <> "") {
				$arwrk = explode(",", $noticias->id_grupo->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_grupo` = " . ew_AdjustSql(trim($wrk)) . "";
				}	
			$sSqlWrk = "SELECT `nombre` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is null";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$noticias->id_grupo->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$noticias->id_grupo->ViewValue .= $rswrk->fields('nombre');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $noticias->id_grupo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$noticias->id_grupo->ViewValue = $noticias->id_grupo->CurrentValue;
				}
			} else {
				$noticias->id_grupo->ViewValue = NULL;
			}
			$noticias->id_grupo->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($noticias->imagen->Upload->DbValue)) {
				$noticias->imagen->ViewValue = $noticias->imagen->Upload->DbValue;
				$noticias->imagen->ImageWidth = 150;
				$noticias->imagen->ImageHeight = 30;
				$noticias->imagen->ImageAlt = $noticias->imagen->FldAlt();
			} else {
				$noticias->imagen->ViewValue = "";
			}
			$noticias->imagen->ViewCustomAttributes = "";

			// fecha
			$noticias->fecha->ViewValue = $noticias->fecha->CurrentValue;
			$noticias->fecha->ViewValue = ew_FormatDateTime($noticias->fecha->ViewValue, 7);
			$noticias->fecha->ViewCustomAttributes = "";

			// orden
			$noticias->orden->ViewValue = $noticias->orden->CurrentValue;
			$noticias->orden->ViewCustomAttributes = "";

			// f_desde
			$noticias->f_desde->ViewValue = $noticias->f_desde->CurrentValue;
			$noticias->f_desde->ViewValue = ew_FormatDateTime($noticias->f_desde->ViewValue, 7);
			$noticias->f_desde->ViewCustomAttributes = "";

			// f_hasta
			$noticias->f_hasta->ViewValue = $noticias->f_hasta->CurrentValue;
			$noticias->f_hasta->ViewValue = ew_FormatDateTime($noticias->f_hasta->ViewValue, 7);
			$noticias->f_hasta->ViewCustomAttributes = "";

			// noticias_link
			$noticias->noticias_link->ViewValue = $noticias->noticias_link->CurrentValue;
			$noticias->noticias_link->ViewCustomAttributes = "";

			
			// estatus
			if (strval($noticias->estatus->CurrentValue) <> "") {
				switch ($noticias->estatus->CurrentValue) {
					case "1":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(1) <> "" ? $noticias->estatus->FldTagCaption(1) : $noticias->estatus->CurrentValue;
						break;
					case "0":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(2) <> "" ? $noticias->estatus->FldTagCaption(2) : $noticias->estatus->CurrentValue;
						break;
					case "3":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(3) <> "" ? $noticias->estatus->FldTagCaption(3) : $noticias->estatus->CurrentValue;
						break;
					case "4":
						$noticias->estatus->ViewValue = $noticias->estatus->FldTagCaption(4) <> "" ? $noticias->estatus->FldTagCaption(4) : $noticias->estatus->CurrentValue;
						break;
					default:
						$noticias->estatus->ViewValue = $noticias->estatus->CurrentValue;
				}
			} else {
				$noticias->estatus->ViewValue = NULL;
			}
			$noticias->estatus->ViewCustomAttributes = "";
			
			// archivo
			if (!ew_Empty($noticias->archivo->Upload->DbValue)) {
				$noticias->archivo->ViewValue = $noticias->archivo->Upload->DbValue;
			} else {
				$noticias->archivo->ViewValue = "";
			}
			$noticias->archivo->ViewCustomAttributes = "";

			// tipo
			$noticias->tipo->LinkCustomAttributes = "";
			$noticias->tipo->HrefValue = "";
			$noticias->tipo->TooltipValue = "";

			// titulo
			$noticias->titulo->LinkCustomAttributes = "";
			$noticias->titulo->HrefValue = "";
			$noticias->titulo->TooltipValue = "";

			// antetitulo
			$noticias->antetitulo->LinkCustomAttributes = "";
			$noticias->antetitulo->HrefValue = "";
			$noticias->antetitulo->TooltipValue = "";

			// sumario
			$noticias->sumario->LinkCustomAttributes = "";
			$noticias->sumario->HrefValue = "";
			$noticias->sumario->TooltipValue = "";

			// contenido
			$noticias->contenido->LinkCustomAttributes = "";
			$noticias->contenido->HrefValue = "";
			$noticias->contenido->TooltipValue = "";

			// id_grupo
			$noticias->id_grupo->LinkCustomAttributes = "";
			$noticias->id_grupo->HrefValue = "";
			$noticias->id_grupo->TooltipValue = "";

			// imagen
			$noticias->imagen->LinkCustomAttributes = "";
			$noticias->imagen->HrefValue = "";
			$noticias->imagen->TooltipValue = "";

			// fecha
			$noticias->fecha->LinkCustomAttributes = "";
			$noticias->fecha->HrefValue = "";
			$noticias->fecha->TooltipValue = "";

			// orden
			$noticias->orden->LinkCustomAttributes = "";
			$noticias->orden->HrefValue = "";
			$noticias->orden->TooltipValue = "";

			// f_desde
			$noticias->f_desde->LinkCustomAttributes = "";
			$noticias->f_desde->HrefValue = "";
			$noticias->f_desde->TooltipValue = "";

			// f_hasta
			$noticias->f_hasta->LinkCustomAttributes = "";
			$noticias->f_hasta->HrefValue = "";
			$noticias->f_hasta->TooltipValue = "";
			
			
			// noticias_link
			$noticias->noticias_link->LinkCustomAttributes = "";
			$noticias->noticias_link->HrefValue = "";
			$noticias->noticias_link->TooltipValue = "";
			
			// archivo
			$noticias->archivo->LinkCustomAttributes = "";
			if (!ew_Empty($noticias->archivo->Upload->DbValue)) {
				$noticias->archivo->HrefValue = ew_UploadPathEx(FALSE, $noticias->archivo->UploadPath) . ((!empty($noticias->archivo->ViewValue)) ? $noticias->archivo->ViewValue : $noticias->archivo->CurrentValue); // Add prefix/suffix
				$noticias->archivo->LinkAttrs["target"] = ""; // Add target
				if ($noticias->Export <> "") $noticias->archivo->HrefValue = ew_ConvertFullUrl($noticias->archivo->HrefValue);
			} else {
				$noticias->archivo->HrefValue = "";
			}
			$noticias->archivo->TooltipValue = "";

			// estatus
			$noticias->estatus->LinkCustomAttributes = "";
			$noticias->estatus->HrefValue = "";
			$noticias->estatus->TooltipValue = "";
		} elseif ($noticias->RowType == EW_ROWTYPE_ADD) { // Add row

			// tipo
			$noticias->tipo->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", $noticias->tipo->FldTagCaption(1) <> "" ? $noticias->tipo->FldTagCaption(1) : "1");
			$arwrk[] = array("2", $noticias->tipo->FldTagCaption(2) <> "" ? $noticias->tipo->FldTagCaption(2) : "2");
			$arwrk[] = array("3", $noticias->tipo->FldTagCaption(3) <> "" ? $noticias->tipo->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $noticias->tipo->FldTagCaption(4) <> "" ? $noticias->tipo->FldTagCaption(4) : "4");
			$arwrk[] = array("5", $noticias->tipo->FldTagCaption(5) <> "" ? $noticias->tipo->FldTagCaption(5) : "5");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$noticias->tipo->EditValue = $arwrk;

			// titulo
			$noticias->titulo->EditCustomAttributes = "";
			$noticias->titulo->EditValue = ew_HtmlEncode($noticias->titulo->CurrentValue);

			// antetitulo
			$noticias->antetitulo->EditCustomAttributes = "";
			$noticias->antetitulo->EditValue = ew_HtmlEncode($noticias->antetitulo->CurrentValue);

			// sumario
			$noticias->sumario->EditCustomAttributes = "";
			$noticias->sumario->EditValue = ew_HtmlEncode($noticias->sumario->CurrentValue);

			// contenido
			$noticias->contenido->EditCustomAttributes = "";
			$noticias->contenido->EditValue = ew_HtmlEncode($noticias->contenido->CurrentValue);

			// id_grupo
			$noticias->id_grupo->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id_grupo`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `grupo`";
			$sWhereWrk = "";
			$lookuptblfilter = "`id_padre` is null";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nombre`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$noticias->id_grupo->EditValue = $arwrk;

			// imagen
			$noticias->imagen->EditCustomAttributes = "";
			if (!ew_Empty($noticias->imagen->Upload->DbValue)) {
				$noticias->imagen->EditValue = $noticias->imagen->Upload->DbValue;
				$noticias->imagen->ImageWidth = 150;
				$noticias->imagen->ImageHeight = 30;
				$noticias->imagen->ImageAlt = $noticias->imagen->FldAlt();
			} else {
				$noticias->imagen->EditValue = "";
			}

			// fecha
			$noticias->fecha->EditCustomAttributes = "";
			$noticias->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($noticias->fecha->CurrentValue, 7));

			// orden
			$noticias->orden->EditCustomAttributes = "";
			$noticias->orden->EditValue = ew_HtmlEncode($noticias->orden->CurrentValue);

			// f_desde
			$noticias->f_desde->EditCustomAttributes = "";
			$noticias->f_desde->EditValue = ew_HtmlEncode(ew_FormatDateTime($noticias->f_desde->CurrentValue, 7));

			// f_hasta
			$noticias->f_hasta->EditCustomAttributes = "";
			$noticias->f_hasta->EditValue = ew_HtmlEncode(ew_FormatDateTime($noticias->f_hasta->CurrentValue, 7));

			// noticias_link
			$noticias->noticias_link->EditCustomAttributes = "";
			$noticias->noticias_link->EditValue = ew_HtmlEncode($noticias->noticias_link->CurrentValue);

			
				// archivo
			$noticias->archivo->EditCustomAttributes = "";
			if (!ew_Empty($noticias->archivo->Upload->DbValue)) {
				$noticias->archivo->EditValue = $noticias->archivo->Upload->DbValue;
			} else {
				$noticias->archivo->EditValue = "";
			}
			
			
			// estatus
			$noticias->estatus->EditCustomAttributes = "";
			$arwrk = array();
			
			
				IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==4){
			$arwrk[] = array("0", $noticias->estatus->FldTagCaption(2) <> "" ? $noticias->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $noticias->estatus->FldTagCaption(3) <> "" ? $noticias->estatus->FldTagCaption(3) : "3");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==5){
			$arwrk[] = array("3", $noticias->estatus->FldTagCaption(3) <> "" ? $noticias->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $noticias->estatus->FldTagCaption(4) <> "" ? $noticias->estatus->FldTagCaption(4) : "4");
			}
			
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==6){
			$arwrk[] = array("1", $noticias->estatus->FldTagCaption(1) <> "" ? $noticias->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("4", $noticias->estatus->FldTagCaption(4) <> "" ? $noticias->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==1){
			$arwrk[] = array("1", $noticias->estatus->FldTagCaption(1) <> "" ? $noticias->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $noticias->estatus->FldTagCaption(2) <> "" ? $noticias->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $noticias->estatus->FldTagCaption(3) <> "" ? $noticias->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $noticias->estatus->FldTagCaption(4) <> "" ? $noticias->estatus->FldTagCaption(4) : "4");
			}
			
			IF(@$_SESSION[EW_SESSION_USER_LEVEL_ID]==-1){
			$arwrk[] = array("1", $noticias->estatus->FldTagCaption(1) <> "" ? $noticias->estatus->FldTagCaption(1) : "1");
			$arwrk[] = array("0", $noticias->estatus->FldTagCaption(2) <> "" ? $noticias->estatus->FldTagCaption(2) : "0");
			$arwrk[] = array("3", $noticias->estatus->FldTagCaption(3) <> "" ? $noticias->estatus->FldTagCaption(3) : "3");
			$arwrk[] = array("4", $noticias->estatus->FldTagCaption(4) <> "" ? $noticias->estatus->FldTagCaption(4) : "4");
			}
			
			
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$noticias->estatus->EditValue = $arwrk;

			// Edit refer script
			// tipo

			$noticias->tipo->HrefValue = "";

			// titulo
			$noticias->titulo->HrefValue = "";

			// antetitulo
			$noticias->antetitulo->HrefValue = "";

			// sumario
			$noticias->sumario->HrefValue = "";

			// contenido
			$noticias->contenido->HrefValue = "";

			// id_grupo
			$noticias->id_grupo->HrefValue = "";

			// imagen
			$noticias->imagen->HrefValue = "";

			// fecha
			$noticias->fecha->HrefValue = "";

			// orden
			$noticias->orden->HrefValue = "";

			// f_desde
			$noticias->f_desde->HrefValue = "";

			// f_hasta
			$noticias->f_hasta->HrefValue = "";
			
			// noticias_link
			$noticias->noticias_link->HrefValue = "";
			
			// archivo
			if (!ew_Empty($noticias->archivo->Upload->DbValue)) {
				$noticias->archivo->HrefValue = ew_UploadPathEx(FALSE, $noticias->archivo->UploadPath) . ((!empty($noticias->archivo->EditValue)) ? $noticias->archivo->EditValue : $noticias->archivo->CurrentValue); // Add prefix/suffix
				$noticias->archivo->LinkAttrs["target"] = ""; // Add target
				if ($noticias->Export <> "") $noticias->archivo->HrefValue = ew_ConvertFullUrl($noticias->archivo->HrefValue);
			} else {
				$noticias->archivo->HrefValue = "";
			}

			// estatus
			$noticias->estatus->HrefValue = "";
		}
		if ($noticias->RowType == EW_ROWTYPE_ADD ||
			$noticias->RowType == EW_ROWTYPE_EDIT ||
			$noticias->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$noticias->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($noticias->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$noticias->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $noticias;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($noticias->imagen->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($noticias->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $noticias->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($noticias->imagen->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $noticias->imagen->Upload->Error));
		}
		
		if (!ew_CheckFileType($noticias->archivo->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($noticias->archivo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $noticias->archivo->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($noticias->archivo->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $noticias->archivo->Upload->Error));
		}


		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($noticias->tipo->FormValue) && $noticias->tipo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $noticias->tipo->FldCaption());
		}
		if (!is_null($noticias->titulo->FormValue) && $noticias->titulo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $noticias->titulo->FldCaption());
		}
		
		if (!is_null($noticias->contenido->FormValue) && $noticias->contenido->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $noticias->contenido->FldCaption());
		}
		
		if ($noticias->id_grupo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $noticias->id_grupo->FldCaption());
		}
		if (!is_null($noticias->fecha->FormValue) && $noticias->fecha->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $noticias->fecha->FldCaption());
		}
		if (!ew_CheckEuroDate($noticias->fecha->FormValue)) {
			ew_AddMessage($gsFormError, $noticias->fecha->FldErrMsg());
		}
		if (!is_null($noticias->f_desde->FormValue) && $noticias->f_desde->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $noticias->f_desde->FldCaption());
		}
		if (!ew_CheckEuroDate($noticias->f_desde->FormValue)) {
			ew_AddMessage($gsFormError, $noticias->f_desde->FldErrMsg());
		}
		if (!is_null($noticias->f_hasta->FormValue) && $noticias->f_hasta->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $noticias->f_hasta->FldCaption());
		}
		if (!ew_CheckEuroDate($noticias->f_hasta->FormValue)) {
			ew_AddMessage($gsFormError, $noticias->f_hasta->FldErrMsg());
		}
		if (!is_null($noticias->estatus->FormValue) && $noticias->estatus->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $noticias->estatus->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $noticias;
		$rsnew = array();

		// tipo
		$noticias->tipo->SetDbValueDef($rsnew, $noticias->tipo->CurrentValue, 0, strval($noticias->tipo->CurrentValue) == "");

		// titulo
		$noticias->titulo->SetDbValueDef($rsnew, $noticias->titulo->CurrentValue, NULL, FALSE);

		// antetitulo
		$noticias->antetitulo->SetDbValueDef($rsnew, $noticias->antetitulo->CurrentValue, NULL, FALSE);

		// sumario
		$noticias->sumario->SetDbValueDef($rsnew, $noticias->sumario->CurrentValue, NULL, FALSE);

		// contenido
		$noticias->contenido->SetDbValueDef($rsnew, $noticias->contenido->CurrentValue, NULL, FALSE);

		// id_grupo
		$noticias->id_grupo->SetDbValueDef($rsnew, $noticias->id_grupo->CurrentValue, "", FALSE);

		// imagen
		if ($noticias->imagen->Upload->Action == "1") { // Keep
			if ($rsold) {
				$rsnew['imagen'] = $rsold->fields['imagen'];
			}
		} elseif ($noticias->imagen->Upload->Action == "2" || $noticias->imagen->Upload->Action == "3") { // Update/Remove
		if (is_null($noticias->imagen->Upload->Value)) {
			$rsnew['imagen'] = NULL;
		} else {
			$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $noticias->imagen->UploadPath), $noticias->imagen->Upload->FileName);
		}
		}

		// fecha
		$noticias->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($noticias->fecha->CurrentValue, 7), NULL, FALSE);

		// orden
		$noticias->orden->SetDbValueDef($rsnew, $noticias->orden->CurrentValue, NULL, FALSE);

		// f_desde
		$noticias->f_desde->SetDbValueDef($rsnew, ew_UnFormatDateTime($noticias->f_desde->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// f_hasta
		$noticias->f_hasta->SetDbValueDef($rsnew, ew_UnFormatDateTime($noticias->f_hasta->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// noticias_link
		$noticias->noticias_link->SetDbValueDef($rsnew, $noticias->noticias_link->CurrentValue, NULL, FALSE);

		
		// estatus
		$noticias->estatus->SetDbValueDef($rsnew, $noticias->estatus->CurrentValue, NULL, FALSE);

		// archivo
		if ($noticias->archivo->Upload->Action == "1") { // Keep
			if ($rsold) {
				$rsnew['archivo'] = $rsold->fields['archivo'];
			}
		} elseif ($noticias->archivo->Upload->Action == "2" || $noticias->archivo->Upload->Action == "3") { // Update/Remove
		if (is_null($noticias->archivo->Upload->Value)) {
			$rsnew['archivo'] = NULL;
		} else {
			$rsnew['archivo'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $noticias->archivo->UploadPath), $noticias->archivo->Upload->FileName);
		}
		}
		
		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $noticias->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($noticias->imagen->Upload->Value)) {
				$noticias->imagen->Upload->SaveToFile($noticias->imagen->UploadPath, $rsnew['imagen'], FALSE);
			}
			if (!ew_Empty($noticias->archivo->Upload->Value)) {
				$noticias->archivo->Upload->SaveToFile($noticias->archivo->UploadPath, $rsnew['archivo'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($noticias->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($noticias->CancelMessage <> "") {
				$this->setFailureMessage($noticias->CancelMessage);
				$noticias->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$noticias->id_noticia->setDbValue($conn->Insert_ID());
			$rsnew['id_noticia'] = $noticias->id_noticia->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$noticias->Row_Inserted($rs, $rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}

		// imagen
		$noticias->imagen->Upload->RemoveFromSession(); // Remove file value from Session
		// archivo
		$noticias->archivo->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'noticias';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $noticias;
		$table = 'noticias';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['id_noticia'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if ($noticias->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($noticias->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($noticias->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
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
}
?>
