// JavaScript Document

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function valida_encuesta(pre) {
 	var total = 0;
	var seleccion = 0;
	
	total = document.form_encuest.opc_enc.length;
	//alert(total);
	for (i=0; i<total; i++) {
		if (document.form_encuest.opc_enc[i].checked == 1) {
			seleccion = document.form_encuest.opc_enc[i].value;
			//alert(seleccion);
			break;
		}
	}
	
	if (seleccion == 0) {
		alert("Debe seleccionar al menos una opcion");
		return false;
	}else{
		document.getElementById('bt_opinar').style.display="none";
		//alert(seleccion);
		seleccion2 = document.form_encuest.id_seg.value;
		cargarContenido(seleccion,seleccion2);
		return false;
	}
}

function cargarContenido(t1,t2){
	var t1, t2, contenedor;
	contenedor = document.getElementById('encuesta');
	ajax=nuevoAjax();
	ajax.open("POST", "includes/i_encuesta.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			contenedor.innerHTML = ajax.responseText
	 	}else{
			contenedor.innerHTML='<img src="img/ajax-loader.gif" alt="Cargando" style="padding-left:200px;" />'
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("t1="+t1+"&t2="+t2)
}

function cargarContenido2(t1){
	var t1, contenedor;
	contenedor = document.getElementById('encuesta');
	ajax=nuevoAjax();
	ajax.open("POST", "includes/i_encuesta_visor.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			contenedor.innerHTML = ajax.responseText
	 	}else{
			contenedor.innerHTML='<img src="img/ajax-loader.gif" alt="Cargando" style="padding-left:200px;" />'
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("t1="+t1)
}

function abrir_popup(ulr, titulo, alto, ancho) {
	window.open(ulr, titulo,'scrollbars=yes,width='+ancho+',height='+alto+',resizable=0,menubar=0,toolbar=0');
}

function cambiar_icono_over(celda){
	celda = document.getElementById(celda);
	celda.style.backgroundImage='url(img/arrow_up.jpg)';
	celda.style.backgroundRepeat='no-repeat';
}
function cambiar_icono_out(celda){
	celda = document.getElementById(celda);
	celda.style.backgroundImage="";
} 

function nuevoAjax(){
	var xmlhttp=false;
 	try {
 		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 	} catch (e) {
 		try {
 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 		} catch (E) {
 			xmlhttp = false;
 		}
  	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
 		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function valida_estados(pre) {
 	var total = 0;
	var seleccion = 0;
	
	total = document.src_agencias.opc_estado.length;
	//alert(total);
	for (i=0; i<total; i++) {
		if (document.src_agencias.opc_estado[i].checked == 1) {
			seleccion = document.src_agencias.opc_estado[i].value;
			break;
		}
	}
	
	if (seleccion == 0) {
		alert("Debe seleccionar al menos un Estado");
		return false;
	}else{
		document.src_agencias.submit();
	}
}

function valida_agencias() {
 	var total = 0;
	var seleccion = 0;
	
	total = document.src_agencias.opc_agencias.length;
	//alert(total);
	
	if (total>1){
		for (i=0; i<total; i++) {
			if (document.src_agencias.opc_agencias[i].checked) {
				seleccion = document.src_agencias.opc_agencias[i].value;
				break;
			}
		}
		
		if (seleccion == 0) {
			alert("Estimado Cliente debe seleccionar una Agencia para poder continuar con su consulta");
			return false;
		}else{
			document.src_agencias.submit();
		}
	}else{
		document.src_agencias.submit();
	}
}

function regresar_paso(paso) {
	
	if(paso==1){
		var element = document.getElementById("desc1");
		element.parentNode.removeChild(element);
	}else{
		var element = document.getElementById("desc2");
		element.parentNode.removeChild(element);
	}
	 
	document.src_agencias.paso.value=paso;
	document.src_agencias.submit();
}

function enviar_accdir() {
	enviar=document.sch_acc_dir.acc_dir.value;
	window.location = enviar;
}

function enviar_herramientas() {
	var cad = new String(document.FrmHerramientas.SltHeader.value);
	var lista = cad.substring(5, 1); 	
	if (lista!="id=&"){
	enviar=document.FrmHerramientas.SltHeader.value;
	window.location = enviar;}
	else
		alert('Debe seleccionar alguna opci\u00F3n');
}

	var vista = null; 

function ver(ide) {
	var capas=document.getElementById('Totales');

	for (i=1;i<=capas.value;i++){
		document.getElementById('respuesta'+i).style.display='none';
	}

	obj = document.getElementById(ide);
	vista = obj.style.display;
	if (vista=='none'){
		obj.style.display = 'block';
	}else{
		obj.style.display = 'none';
	}
} 

function valida_empleo() {
 	var total = 0;
	var seleccion = 0;
	var Nombre;
	
	total = document.form_empleo;
	//alert(total);
	
	for (i=0; i<total.elements.length; i++) {
		if (total.elements[i].value=="") {
			alert(capitaliseFirstLetter(total.elements[i].name) + " es un campo requerido");
			total.elements[i].focus();
			//seleccion = document.src_agencias.opc_agencias[i].value;
			break;
		}
	}
	
	/*if (seleccion == 0) {
		alert("Debe seleccionar al menos una Agencia");
		return false;
	}else{
		document.src_agencias.submit();
	}*/
}

function capitaliseFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function valida_contacto() {	
	var encabezado=msj+"\n";
	var mensaje="";
	if (document.getElementById('nombre').value=="")
		mensaje=mensaje+msj1+"\n";
	if (document.getElementById('cicontac').value=="")
		mensaje=mensaje+msj24+"\n";	
	
	var filt_num = /^([0-9])*$/;
	var telfCon = document.getElementById('telfcontc').value;		
	if (document.getElementById('telfcontc').value=="")
		mensaje=mensaje+msj36+"\n";	
	else 
	if (!filt_num.test(telfCon))
			mensaje=mensaje+msj37+"\n";
	var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	var correo=document.getElementById('email').value;
	if (document.getElementById('email').value=="")
		mensaje=mensaje+msj3+"\n";
	else
	if (!filter.test(correo))
		mensaje=mensaje+msj4+"\n";
	if (document.getElementById('departamentos').value=="")
		mensaje=mensaje+msj5+"\n";
	if (document.getElementById('comentarios').value=="")
		mensaje=mensaje+msj7+"\n";
		
	if (mensaje!="")
		{
		alert(encabezado+mensaje);
		return false;
		}
	else
		document.form_contacto.submit();	
}

function valida_empleo() {	
	var encabezado=msj+"\n";
	var mensaje="";
	if (document.getElementById('nombre').value=="")
		mensaje=mensaje+msj1+"\n";
	if (document.getElementById('cargo').value=="")
		mensaje=mensaje+msj30+"\n";
	if (document.getElementById('carrera').value=="")
		mensaje=mensaje+msj31+"\n";
	if (document.getElementById('nacimiento').value=="")
		mensaje=mensaje+msj25+"\n";		
	var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	var correo=document.getElementById('email').value;
	if (document.getElementById('email').value=="")
		mensaje=mensaje+msj3+"\n";
	else
	if (!filter.test(correo))
		mensaje=mensaje+msj4+"\n";
	if (document.getElementById('resumen').value=="")
		mensaje=mensaje+msj32+"\n";
	if (mensaje!="")
		{
		alert(encabezado+mensaje);
		return false;
		}
	else
		{
		document.form_empleo.submit();	
		}
}

function tamano(mas) {
	// Obtenemos el objeto que contiene el texto
	var obj=document.getElementById("txt");
	// Obtenemos el tamaño de letra y lo modificamos
	var fontsize = obj.style.fontSize;

	fontsize = parseInt(fontsize.replace(/%/g, ''));
	fontsize += mas*10;

	if (fontsize!="") {
		obj.style.fontSize = fontsize+"%";
	}
}

function validar_solo_numeros_decimales(e) {
	if (!/^([0-9])*[,]?[0-9]*$/.test(e)){
		//e.value = e.substring(0,e.length-1);
		alert ("S\u00f3lo n\u00fameros por favor");
   }
}

function validar_solo_numeros_enteros(e) {
	if (!/^([0-9])*$/.test(e)){
		//e.value = e.substring(0,e.length-1);
		alert ("S\u00f3lo n\u00fameros enteros por favor");
   }
}

function tryNumberFormat(obj)
{
	var x;
	var a,b,c,d;
	
	a=obj;
	while(a.indexOf(",") != -1)
	{
		a = a.replace(",",".");
	}
	return (a);
}

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? ',' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}

function replaceAll( text, busca, reemplaza ){
	  while (text.toString().indexOf(busca) != -1)
	      text = text.toString().replace(busca,reemplaza);
	  return text;
	}

function valida_calculadora() {	
	var encabezado=msj+"\n";
	var mensaje="";
	if(document.getElementById('ingreso').value=="")
		mensaje=mensaje+msj35+"\n";
	if (document.getElementById('monto').value=="")
		mensaje=mensaje+msj33+"\n";
	if (document.getElementById('plazo').value=="")
		mensaje=mensaje+msj34+"\n";
	
	if (mensaje!="")
		{
		alert(encabezado+mensaje);
		return false;
		}
	else
		{
			var monto=replaceAll(document.form_calculadora.monto.value,".","");
			monto=monto.replace(",",".");
			
			var TazaAnualizada = (tryNumberFormat(document.form_calculadora.ingreso.value)/100)/12;
			var CreditoInteres = monto*TazaAnualizada;
			var pow = 1-(Math.pow((1+TazaAnualizada),(-1*eval(document.form_calculadora.plazo.value))));
			var MonthPayment = CreditoInteres/pow;
			
			document.getElementById('resultado').innerHTML = addCommas(MonthPayment.toFixed(2));
		}
}

function act_datos(){
	var valornuevo = document.form_calculadora.ingreso.value;
	document.form_calculadora.ingreso2.value = valornuevo;
}

function valida_buscador() {	
	var encabezado=msj+"\n";
	var mensaje="";
	if (document.getElementById('InpTxt').value=="")
		mensaje=mensaje+msj15+"\n";
	
	if (mensaje!="")
		{
		alert(encabezado+mensaje);
		return false;
		}
	else
		{
		document.FrmBuscar.submit();	
		}
}

function borrarTexto () {
	document.getElementById('InpTxt').value="";
}
function cargform(){
			var box = document.getElementById("body_id"); 
			var box2= document.getElementById("banner_central"); 
			box.style.visibility = 'visible';   
			box2.style.display = 'block';   
		}
		
	function popUp2(URL) {
		ancho = screen.availWidth;
		alto = screen.availHeight;
		day = new Date();
		id = day.getTime();
		//eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,status=0,menubar=0,resizable=0,width="+ancho+",height="+alto+",left = 302,top = 154');");
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,status=0,menubar=0,resizable=0,fullscreen=1');");
	}	
	 
	 
	 