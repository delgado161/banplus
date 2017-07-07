<?php

ini_set('display_errors', 0);
//var_dump($_POST);
//return;
//exit();
//ob_start();
//$content = ob_get_clean();
// convert in PDF
include_once "../includes/html2pdf/vendor/autoload.php";
try {

    foreach ($_POST as $key => $post) {
        $_POST[$key] = htmlentities($post);
    }

    $html2pdf = new HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(1, 1, 1, 1));
//      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');


    $conte = '
<style type="text/css">
    td {border: 1px solid rgb(129,129,129); width:100%;}
    table{width:100%;}
    .seccion{text-align: center;width:100%;background: rgb(150,150,150);font-weight: bold;font-size: 10px;}
    .bloque{width:100%;border: none;}
    .bloque table{border:none;margin-left:-1px;width:100.3%;margin-top:-2px;}
    .etiqueta{ border: none;text-align: left;font-size: 9px;vertical-align: top;}
    .titulo{text-align: center;font-size: 16px;border:none;font-weight: bold;}
     .titulo2{text-align: center;font-size: 12px;border:none;font-weight: bold; background: rgb(0,37,84);color:white;border-radius:8px;}
    .d_linea{font-size: 9px;}
    .b_left{border-left: none;}
    .b_right{border-right: none;}
    .valores td{vertical-align: middle;padding: 1px;font-size: 10px;border-top: none;}
    .sub_td{border:none;width:100%;margin-left:-1px;}
    .sub_td td{border-left: none;border-right: none;padding: 0px 0 0px 0;height:5px;text-align: center;font-size: 8px;}
    
</style>
<page  backleft="0mm" backright="0mm">
<table style=" border-collapse: collapse;">
    <tr>
        <td  style="width:33.33%;border:none;padding-right:10px;vertical-align: top;">
        <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td style="border:none;">
                    <img src="../img/logo_banplus.jpg" width="190px;" />
                    </td>                
                </tr>
                <tr>
                    <td class="titulo">
                        SOLICITUD DE TARJETA DE CR&Eacute;DITO
                    </td>               
                </tr>
                <tr>
                    <td class="titulo" style="text-align:right;">
                       <input type="checkbox" checked="checked" > <img src="../img/visa.png" width="50px;" /> 
 &nbsp;&nbsp;                      
<input type="checkbox" checked="checked" > <img src="../img/MasterCard.png" width="40px;" /> &nbsp;&nbsp; 
                    </td>               
                </tr>
                 <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"   >  </td>
                </tr>   
                <tr>
                    <td class="titulo2">
                        DATOS PERSONALES
                    </td>               
                </tr>
            </table>
           
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
 <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;" colspan="2"  >  </td>
                </tr>                  
<tr>
                    <td class="etiqueta" style="width:80%;border-right: 1px solid rgb(129,129,129);">Nombres y Apellidos:</td>
                    <td class="etiqueta" style="width:20%;">Sexo</td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:80%;border-left:none;">NOMBRES Y APELLIDOS</td>
                    <td  style="width:20%;border-right:none;">
                    &nbsp;&nbsp;M<input type="checkbox" checked="checked" >
                    &nbsp;&nbsp;F<input type="checkbox" checked="checked" >
                    </td>
                </tr>

            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> C&eacute;dula de Identidad:
                     &nbsp;&nbsp;V<input type="checkbox" checked="checked" >
                    &nbsp;&nbsp;E<input type="checkbox" checked="checked" >
                    </td>
                    <td class="etiqueta" style="width:50%;"> RIF:</td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">                     sd                    </td>
                    <td  style="width:50%;border-right:none;">                     sd                    </td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Pasaporte: </td>
                    <td class="etiqueta" style="width:50%;"> Lugar y fecha de Nacimiento:</td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;">                     sd                    </td>
                    <td  style="width:50%;border-right:none;">                     sd                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);font-size:9px;"> Si es nacionalizado, indique C.I. anterior: </td>
                    <td class="etiqueta" style="width:50%;"> Tiempo en el Pa&iacute;s:</td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">                     sd                    </td>
                    <td  style="width:50%;border-right:none;">                     sd                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Estado civil:  
                    <input type="checkbox" checked="checked" >&nbsp;&nbsp;Soltero&nbsp;
                   <input type="checkbox" checked="checked" >&nbsp;&nbsp;Casado
                   </td>
                    <td class="etiqueta" style="width:50%;">Profesi&oacute;n:</td>
                </tr>
                
               <tr class="valores">
                    <td  style="width:50%;border-left:none;">
                     <input type="checkbox" checked="checked" >&nbsp;&nbsp;Divorciado
                      <input type="checkbox" checked="checked" >&nbsp;&nbsp;Viudo   
                    </td>
                    <td  style="width:50%;border-right:none;">sd                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Cargas familiares: </td>
                    <td class="etiqueta" style="width:50%;">Tel&eacute;fonos:</td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">sd</td>
                    <td  style="width:50%;border-right:none;">   sd </td>
                </tr>
            </table>
            
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Tel&eacute;fonos Celular: </td>
                    <td class="etiqueta" style="width:50%;">Correo Electr&oacute;nico:</td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">sd</td>
                    <td  style="width:50%;border-right:none;">   sd </td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:100%;" colspan="2"> <b>DATOS DEL C&Oacute;NYUGE </b></td>
                </tr>                
                <tr>
                    <td class="etiqueta" style="width:100%;" colspan="2"> Nombres y Apellidos: </td>
                </tr>
                
                 <tr class="valores">
                   <td  style="width:50%;border-right:none;border-left:none;">   sd </td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> C&eacute;dula de Identidad:
                     &nbsp;&nbsp;V<input type="checkbox" checked="checked" >
                    &nbsp;&nbsp;E<input type="checkbox" checked="checked" >
                    </td>
                       <td class="etiqueta" style="width:50%;"> Lugar y fecha de Nacimiento:</td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">                     sd                    </td>
                    <td  style="width:50%;border-right:none;">                     sd                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Empresa donde trabaja actualmente: </td>
                    <td class="etiqueta" style="width:20%;border-right: 1px solid rgb(129,129,129);"> Tel&eacute;fonos: </td>
                    <td class="etiqueta" style="width:30%;"> Sueldo Mensual Bs.:</td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:50%;border-left:none;">                     sd                    </td>
                    <td  style="width:20%;border-left:none;">                     sd                    </td>
                     <td  style="width:30%;border-right:none;">                     sd                    </td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:100%;" colspan="2"> Correo Electr&oacute;nico: </td>
                </tr>
                
                 <tr class="valores">
                   <td  style="width:50%;border-right:none;border-left:none;">   sd </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:100%;" colspan="3"> <b>DIRECCI&Oacute;N HABITACI&Oacute;N </b></td>
                </tr>                
                  <tr >
                    <td class="etiqueta" style="width:32%;border-right: 1px solid rgb(129,129,129);" > Avenida: </td>
                   <td class="etiqueta" style="width:32%;border-right: 1px solid rgb(129,129,129);" > Calle: </td>
                    <td class="etiqueta" style="width:36%;" > 
                    Casa<input type="checkbox" checked="checked" >
                    &nbsp;Quinta<input type="checkbox" checked="checked" >
                    &nbsp;Edf.<input type="checkbox" checked="checked" ><br>
                    Nombre o N&ordm;
                    </td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:32%;border-left:none;" > s </td>
                   <td  style="width:32%;" > f </td>
                    <td  style="width:36%;border-right:none;" > g </td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:14%;border-right: 1px solid rgb(129,129,129);" > Piso: </td>
                   <td class="etiqueta" style="width:14%;border-right: 1px solid rgb(129,129,129);" > Apto.: </td>
                    <td class="etiqueta" style="width:36%;border-right: 1px solid rgb(129,129,129);" > Urbanizaci&oacute;n/Sector/Barrio: </td>
                   <td class="etiqueta" style="width:36%;" > Municipio: </td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:14%;border-left:none;" > s </td>
                   <td  style="width:14%;" > f </td>
                    <td  style="width:36%;" > g </td>
                     <td  style="width:36%;border-right:none;" > g </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:25%;border-right: 1px solid rgb(129,129,129);" > Parroquia: </td>
                   <td class="etiqueta" style="width:25%;border-right: 1px solid rgb(129,129,129);" > Estado: </td>
                    <td class="etiqueta" style="width:25%;border-right: 1px solid rgb(129,129,129);" > Ciudad: </td>
                   <td class="etiqueta" style="width:25%;" > Zona Postal: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:25%;border-left:none;" > s </td>
                   <td  style="width:25%;" > f </td>
                    <td  style="width:25%;" > g </td>
                     <td  style="width:25%;border-right:none;" > g </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Tel&eacute;fonos: </td>
                   <td class="etiqueta" style="width:50%;" >Vivienda:
                     <input type="checkbox" checked="checked" >De mis padre <input type="checkbox" checked="checked" > Propia
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > s </td>
                     <td  style="width:50%;border-right:none;" > 
                      <input type="checkbox" checked="checked" > De un familiar
                    &nbsp;<input type="checkbox" checked="checked" > Alquilada
                    </td>
                </tr>
            </table>
               <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > Si es vivienda propia, indique a&ntilde;o de adquisici&oacute;n: </td>
               
                </tr>
                
               <tr class="valores">
                    <td  style="width:100%;border-left:none;border-right:none;" > s </td>
                    
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Alquiler o Cuota Hipotecaria: </td>
                   <td class="etiqueta" style="width:50%;" > A&ntilde;os en esta direcci&oacute;n: </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > s </td>
                     <td  style="width:50%;border-right:none;" >   s</td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Nombre de su Acreedor<br>Hipotecario o Arrendador: </td>
                   <td class="etiqueta" style="width:50%;" > N&uacute;mero de Cr&eacute;dito: </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > s </td>
                     <td  style="width:50%;border-right:none;" >   s</td>
                </tr>
            </table>
               <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > Tel&eacute;fonos: </td>
               
                </tr>
                
                 <tr class="valores">
                    <td  style="width:100%;border-left:none;border-right:none;" > s </td>
                    
                </tr>
            </table>
               <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > Otras Propiedades que posee: </td>
               
                </tr>
                
                 <tr class="valores">
                    <td  style="width:100%;border-left:none;border-right:none;" > 
                      &nbsp; &nbsp;<input type="checkbox" checked="checked" > Apartamentos
                    &nbsp;<input type="checkbox" checked="checked" > Terrenos
                        &nbsp; <input type="checkbox" checked="checked" > Locales
                    &nbsp;<input type="checkbox" checked="checked" > Otros
                    </td>
                    
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Automov&iacute;l: </td>
                   <td class="etiqueta" style="width:50%;" > Modelo: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;" > s </td>
                     <td  style="width:50%;border-right:none;" >   s</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > A&ntilde;o: </td>
                   <td class="etiqueta" style="width:50%;" > Placa: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;" > s </td>
                     <td  style="width:50%;border-right:none;" >   s</td>
                </tr>
            </table>


</td>
        <td  style="width:33.33%;border:none;vertical-align: top;padding-right:10px;">
        
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       REFERENCIAS FAMILIARES O PERSONALES
                    </td>               
                </tr>
            </table>
            <br>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:74%;border-right: 1px solid rgb(129,129,129);" >Nombres y Apellidos: </td>
                    <td class="etiqueta" style="width:26%;" > Parentesco: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:74%;border-left:none;" > s </td>
                     <td  style="width:26%;border-right:none;" >   s</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:37%;border-right: 1px solid rgb(129,129,129);" >Ciudad: </td>
                    <td class="etiqueta" style="width:37%;border-right: 1px solid rgb(129,129,129);" >  Tel&eacute;fonos: </td>
                    <td class="etiqueta" style="width:26%;" > Celular: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:37%;border-left:none;" > s </td>
                    <td  style="width:37%;border-left:none;" > s </td>
                     <td  style="width:26%;border-right:none;" >   s</td>
                </tr>
            </table>
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:74%;border-right: 1px solid rgb(129,129,129);" >Nombres y Apellidos: </td>
                    <td class="etiqueta" style="width:26%;" > Parentesco: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:74%;border-left:none;" > s </td>
                     <td  style="width:26%;border-right:none;" >   s</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:37%;border-right: 1px solid rgb(129,129,129);" >Ciudad: </td>
                    <td class="etiqueta" style="width:37%;border-right: 1px solid rgb(129,129,129);" >  Tel&eacute;fonos: </td>
                    <td class="etiqueta" style="width:26%;" > Celular: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:37%;border-left:none;" > s </td>
                    <td  style="width:37%;border-left:none;" > s </td>
                     <td  style="width:26%;border-right:none;" >   s</td>
                </tr>
            </table>
            <br>
            <br>
            
  <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       DATOS LABORABLES
                    </td>               
                </tr>
            </table>
             <br>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > Empresa donde trabaja (Actual): </td>
               
                </tr>
                
                 <tr class="valores">
                    <td  style="width:100%;border-left:none;border-right:none;" > 
                    sd
                    </td>
                    
                </tr>
            </table>
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                  <tr >
                    <td class="etiqueta" style="width:32%;border-right: 1px solid rgb(129,129,129);" > Avenida: </td>
                   <td class="etiqueta" style="width:32%;border-right: 1px solid rgb(129,129,129);" > Calle: </td>
                    <td class="etiqueta" style="width:36%;" > 
                    Casa<input type="checkbox" checked="checked" >
                    &nbsp;Quinta<input type="checkbox" checked="checked" >
                    &nbsp;Edf.<input type="checkbox" checked="checked" ><br>
                    Nombre o N&ordm;
                    </td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:32%;border-left:none;" > s </td>
                   <td  style="width:32%;" > f </td>
                    <td  style="width:36%;border-right:none;" > g </td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:14%;border-right: 1px solid rgb(129,129,129);" > Piso: </td>
                   <td class="etiqueta" style="width:14%;border-right: 1px solid rgb(129,129,129);" > Oficina: </td>
                    <td class="etiqueta" style="width:36%;border-right: 1px solid rgb(129,129,129);" > Urbanizaci&oacute;n/Sector/Barrio: </td>
                   <td class="etiqueta" style="width:36%;" > Parroquia: </td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:14%;border-left:none;" > s </td>
                   <td  style="width:14%;" > f </td>
                    <td  style="width:36%;" > g </td>
                     <td  style="width:36%;border-right:none;" > g </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:25%;border-right: 1px solid rgb(129,129,129);" > Municipio: </td>
                   <td class="etiqueta" style="width:25%;border-right: 1px solid rgb(129,129,129);" > Estado: </td>
                    <td class="etiqueta" style="width:25%;border-right: 1px solid rgb(129,129,129);" > Ciudad: </td>
                   <td class="etiqueta" style="width:25%;" > Zona Postal: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:25%;border-left:none;" > s </td>
                   <td  style="width:25%;" > f </td>
                    <td  style="width:25%;" > g </td>
                     <td  style="width:25%;border-right:none;" > g </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:70%;border-right: 1px solid rgb(129,129,129);" > Tel&eacute;fonos Oficina: </td>
                   <td class="etiqueta" style="width:30%;" >Fax Oficina:
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:70%;border-left:none;" > s </td>
                     <td  style="width:30%;border-right:none;" > 
                     d
                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:70%;border-right: 1px solid rgb(129,129,129);" > Correo Electr&oacute;nico: </td>
                   <td class="etiqueta" style="width:30%;" >Sector Econ&oacute;mico:
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:70%;border-left:none;" > s </td>
                     <td  style="width:30%;border-right:none;" > 
                     d
                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:70%;border-right: 1px solid rgb(129,129,129);" > Cargo: </td>
                   <td class="etiqueta" style="width:30%;" >Tiempo en la Empresa:
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:70%;border-left:none;" > s </td>
                     <td  style="width:30%;border-right:none;" > 
                     d
                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Sueldo Mensual: </td>
                   <td class="etiqueta" style="width:50%;" >Otros Ingresos:  </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > s </td>
                     <td  style="width:50%;border-right:none;" >    d                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > Por Concepto de: </td>
               
                </tr>
                
                 <tr class="valores">
                    <td  style="width:100%;border-left:none;border-right:none;" > 
                    sd
                    </td>
                    
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:70%;border-right: 1px solid rgb(129,129,129);" > Nombre de la Empresa donde trabajo anteriolmente: </td>
                   <td class="etiqueta" style="width:30%;" >Sector Econ&oacute;mico:
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:70%;border-left:none;" > s </td>
                     <td  style="width:30%;border-right:none;" > 
                     d
                    </td>
                </tr>
            </table>
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Cargo: </td>
                   <td class="etiqueta" style="width:50%;" >Ingreso Mensual:  </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > s </td>
                     <td  style="width:50%;border-right:none;" >    d                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Fecha Egreso: </td>
                   <td class="etiqueta" style="width:50%;" >Tiempo en la Empresa:  </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > s </td>
                     <td  style="width:50%;border-right:none;" >    d                    </td>
                </tr>
            </table>
            <br>
            <br>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       DATOS FINANCIEROS
                    </td>               
                </tr>
            </table>
               <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > <br>Balance al: </td>
               
                </tr>
               
            </table>
            
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:25%;border-bottom: 1px solid rgb(129,129,129);" ></td>
                    <td class="etiqueta" style="width:25%;text-align:center;border-bottom: 1px solid rgb(129,129,129);" > <b>Activos</b></td>
                    <td class="etiqueta" style="width:25%;border-bottom: 1px solid rgb(129,129,129);" > </td>
                    <td class="etiqueta" style="width:25%;text-align:center;border-bottom: 1px solid rgb(129,129,129);" > <b>Pasivo y Patrimonio</b> </td>
                </tr>
               
            </table>
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" >1. Banco</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" ></td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" >7. Tarjetas de Cr&eacute;dito </td>
                    <td  style="width:25%;text-align:center;border-right:none;" >  </td>
                </tr>
                <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" >2. Inversiones</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" ></td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" >8. Pr&eacute;stamos  </td>
                    <td  style="width:25%;text-align:center;border-right:none;" >  </td>
                </tr>  
                <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" >3. Moviliario</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" ></td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" >9. Hipotecas por Pagar  </td>
                    <td  style="width:25%;text-align:center;border-right:none;" >  </td>
                </tr> 
                 <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" >4. Veh&iacute;culos</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" ></td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" ><b>10. Total Pasivo</b><br>(7+8+9)</td>
                    <td  style="width:25%;text-align:center;border-right:none;" >  </td>
                </tr> 
                 <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" >5. Inmuebles</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" ></td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" >11. Patrimonio (6-10)</td>
                    <td  style="width:25%;text-align:center;border-right:none;" >  </td>
                </tr> 
                 <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" ><b>6. Total Activos</b><br>(1+2+3+4+5)</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" ></td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none;" ><b>10. Total Pasivo y Patrimonio</b></td>
                    <td  style="width:25%;text-align:center;border-right:none;" >  </td>
                </tr> 

            </table>
            


</td>
        <td  style="width:33.33%;border:none;vertical-align: top;padding-right:10px;">
        <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       REFERENCIAS BANCARIAS
                    </td>               
                </tr>
            </table>
            
                 <table style="border-collapse: collapse;border:none;font-size:11px;" >
                   <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"  colspan="3">  </td>
                </tr>          
                <tr>
                    <td class="etiqueta" style="vertical-align:middle;text-align:center;width:24%;border-right: 1px solid rgb(129,129,129);background:rgb(200,200,200);height:15px;" > BANCO </td>
                     <td class="etiqueta" style="vertical-align:middle;text-align:center;width:68%;border-right: 1px solid rgb(129,129,129);background:rgb(200,200,200);height:15px;" > C&Oacute;DIGO CUENTA CORRIENTE (C= Corriente / A= Ahorro) </td>
                   <td class="etiqueta" style="vertical-align:middle;text-align:center;width:8%;background:rgb(200,200,200);height:15px;" >TIPO  </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:24%;border-left:none;" > s </td>
                    <td  style="width:68%;border-left:none;" > s </td>
                     <td  style="width:8%;border-right:none;" >  
                      &nbsp;<input type="checkbox" checked="checked" >C <br>
                    &nbsp;<input type="checkbox" checked="checked" >A               
                     </td>
                </tr>
                <tr class="valores">
                    <td  style="width:24%;border-left:none;" > s </td>
                    <td  style="width:68%;border-left:none;" > s </td>
                     <td  style="width:8%;border-right:none;" >  
                      &nbsp;<input type="checkbox" checked="checked" >C <br>
                    &nbsp;<input type="checkbox" checked="checked" >A               
                     </td>
                </tr>
                <tr class="valores">
                    <td  style="width:24%;border-left:none;" > s </td>
                    <td  style="width:68%;border-left:none;" > s </td>
                     <td  style="width:8%;border-right:none;" >  
                      &nbsp;<input type="checkbox" checked="checked" >C <br>
                    &nbsp;<input type="checkbox" checked="checked" >A               
                     </td>
                </tr>
                <tr class="valores">
                    <td  style="width:24%;border-left:none;" > s </td>
                    <td  style="width:68%;border-left:none;" > s </td>
                     <td  style="width:8%;border-right:none;" >  
                      &nbsp;<input type="checkbox" checked="checked" >C <br>
                    &nbsp;<input type="checkbox" checked="checked" >A               
                     </td>
                </tr>
                  <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"  colspan="3">  </td>
                </tr>   
                
            </table>
          
          
  <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       REFERENCIAS DE TARJETAS DE CREDITO
                    </td>               
                </tr>
            </table>
           
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"  colspan="3">  </td>
                </tr>        
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" > Banco </td>
                     <td class="etiqueta" style=width:62%;border-right: 1px solid rgb(129,129,129);" > Tarjeta N&ordm; </td>
                   <td class="etiqueta" style="width:8%;" >&nbsp;<input type="checkbox" checked="checked" >T </td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" > s </td>
                    <td  style="width:62%;border-left:none;" > s </td>
                     <td  style="width:8%;border-right:none;" >  
                     &nbsp;<input type="checkbox" checked="checked" >s               
                     </td>
                </tr>
              
            </table> 
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" > 
                    &nbsp;<input type="checkbox" checked="checked" >Cl&aacute;sica
                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" checked="checked" >Dorada<br>
                    &nbsp;<input type="checkbox" checked="checked" >Platinum
                    &nbsp;&nbsp;<input type="checkbox" checked="checked" >Black
                    </td>
                     <td class="etiqueta" style=width:35%;" > L&iacute;mite de Cr&eacute;dito </td>
                   <td class="etiqueta" style="width:35%;" >Saldo Actual</td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" >
                    
                    &nbsp;<input type="checkbox" checked="checked" >Otros 
                    </td>
                    <td  style="width:35%;border-left:none;border-right:none;" > s </td>
                     <td  style="width:35%;border-left:none;border-right:none;" >  
                                   
                     </td>
                </tr>
              
            </table> 
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" > Banco </td>
                     <td class="etiqueta" style=width:62%;border-right: 1px solid rgb(129,129,129);" > Tarjeta N&ordm; </td>
                   <td class="etiqueta" style="width:8%;" >&nbsp;<input type="checkbox" checked="checked" >T </td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" > s </td>
                    <td  style="width:62%;border-left:none;" > s </td>
                     <td  style="width:8%;border-right:none;" >  
                     &nbsp;<input type="checkbox" checked="checked" >s               
                     </td>
                </tr>
              
            </table> 
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" > 
                    &nbsp;<input type="checkbox" checked="checked" >Cl&aacute;sica
                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" checked="checked" >Dorada<br>
                    &nbsp;<input type="checkbox" checked="checked" >Platinum
                    &nbsp;&nbsp;<input type="checkbox" checked="checked" >Black
                    </td>
                     <td class="etiqueta" style=width:35%;" > L&iacute;mite de Cr&eacute;dito </td>
                   <td class="etiqueta" style="width:35%;" >Saldo Actual</td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" >
                    
                    &nbsp;<input type="checkbox" checked="checked" >Otros 
                    </td>
                    <td  style="width:35%;border-left:none;border-right:none;" > s </td>
                     <td  style="width:35%;border-left:none;border-right:none;" >  
                                   
                     </td>
                </tr>
              
            </table> 
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" > Banco </td>
                     <td class="etiqueta" style=width:62%;border-right: 1px solid rgb(129,129,129);" > Tarjeta N&ordm; </td>
                   <td class="etiqueta" style="width:8%;" >&nbsp;<input type="checkbox" checked="checked" >T </td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" > s </td>
                    <td  style="width:62%;border-left:none;" > s </td>
                     <td  style="width:8%;border-right:none;" >  
                     &nbsp;<input type="checkbox" checked="checked" >s               
                     </td>
                </tr>
              
            </table> 
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" > 
                    &nbsp;<input type="checkbox" checked="checked" >Cl&aacute;sica
                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" checked="checked" >Dorada<br>
                    &nbsp;<input type="checkbox" checked="checked" >Platinum
                    &nbsp;&nbsp;<input type="checkbox" checked="checked" >Black
                    </td>
                     <td class="etiqueta" style=width:35%;" > L&iacute;mite de Cr&eacute;dito </td>
                   <td class="etiqueta" style="width:35%;" >Saldo Actual</td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" >
                    
                    &nbsp;<input type="checkbox" checked="checked" >Otros 
                    </td>
                    <td  style="width:35%;border-left:none;border-right:none;" > s </td>
                     <td  style="width:35%;border-left:none;border-right:none;" >  
                                   
                     </td>
                </tr>
              
            </table> 
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" > Banco </td>
                     <td class="etiqueta" style=width:62%;border-right: 1px solid rgb(129,129,129);" > Tarjeta N&ordm; </td>
                   <td class="etiqueta" style="width:8%;" >&nbsp;<input type="checkbox" checked="checked" >T </td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" > s </td>
                    <td  style="width:62%;border-left:none;" > s </td>
                     <td  style="width:8%;border-right:none;" >  
                     &nbsp;<input type="checkbox" checked="checked" >s               
                     </td>
                </tr>
              
            </table> 
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" > 
                    &nbsp;<input type="checkbox" checked="checked" >Cl&aacute;sica
                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" checked="checked" >Dorada<br>
                    &nbsp;<input type="checkbox" checked="checked" >Platinum
                    &nbsp;&nbsp;<input type="checkbox" checked="checked" >Black
                    </td>
                     <td class="etiqueta" style=width:35%;" > L&iacute;mite de Cr&eacute;dito </td>
                   <td class="etiqueta" style="width:35%;" >Saldo Actual</td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" >
                    
                    &nbsp;<input type="checkbox" checked="checked" >Otros 
                    </td>
                    <td  style="width:35%;border-left:none;border-right:none;" > s </td>
                     <td  style="width:35%;border-left:none;border-right:none;" >  
                                   
                     </td>
                </tr>
                  <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"  colspan="3">  </td>
                </tr>     
              
            </table> 
            
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       AUTORIZACI&Oacute;N DE CARGO EN CUENTA
                    </td>               
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                 <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"  >  </td>
                </tr> 
                <tr>
                   <td class="etiqueta" style="width:100%;" >
                   Autorizo a cargar mensualmente el pago
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total<input type="checkbox" checked="checked" >
                &nbsp;&nbsp;&nbsp;M&iacute;nimo<input type="checkbox" checked="checked" >
                </td>
                </tr>
                <tr class="valores">
                      <td  style="width:100%;border-left:none;border-right:none;" >  
                            sd
                     </td>
                </tr>
              
            </table> 
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                   <td class="etiqueta" style="width:100%;" >
                   En mi cuenta Banplus N&ordm;
                </td>
                </tr>
                <tr class="valores">
                      <td  style="width:100%;border-left:none;border-right:none;" >  
                            sd
                     </td>
                </tr>
                <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"  >  </td>
                </tr> 
              
            </table> 
            
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       DIRECCI&Oacute;N DE CORRESPONDENCIA
                    </td>               
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
              <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"  >  </td>
                </tr>    
                <tr>
                   <td class="etiqueta" style="width:100%;" >
                  ENV&Iacute;O TARJETA DE CR&Eacute;DITO
                </td>
                </tr>
                <tr class="valores">
                      <td  style="width:100%;border-left:none;border-right:none;" >  
                          Agencia Banplus:
                     </td>
                </tr>
              
            </table> 
            
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                   <td class="etiqueta" style="width:100%;" >
                  ESTADOS DE CUENTA Y CORRESPONDENCIA
                </td>
                </tr>
                <tr class="valores">
                      <td  style="width:100%;border-left:none;border-right:none;" >  
                          <input type="checkbox" checked="checked" >Correo Electr&oacute;nico:
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" checked="checked" >Habitaci&oacute;n
                          <input type="checkbox" checked="checked" >Oficina

                     </td>
                </tr>
              <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"  >  </td>
                </tr> 
            </table> 
             
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       SOLICITUD DE TARJETAS SUPLEMENTARIAS
                    </td>               
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
              <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;" colspan="2"  >  </td>
                </tr>   
                <tr>
                    <td class="etiqueta" style="width:80%;border-right: 1px solid rgb(129,129,129);">Nombres y Apellidos:</td>
                    <td class="etiqueta" style="width:20%;">Sexo</td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:80%;border-left:none;">NOMBRES Y APELLIDOS</td>
                    <td  style="width:20%;border-right:none;">
                    &nbsp;&nbsp;M<input type="checkbox" checked="checked" >
                    &nbsp;&nbsp;F<input type="checkbox" checked="checked" >
                    </td>
                </tr>

            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Fecha de Nacimiento:</td>
                    <td class="etiqueta" style="width:50%;"> C&eacute;dula de Identidad:
                     &nbsp;&nbsp;V<input type="checkbox" checked="checked" >
                    &nbsp;&nbsp;E<input type="checkbox" checked="checked" >
                    </td>
                   
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">                     sd                    </td>
                    <td  style="width:50%;border-right:none;">                     sd                    </td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Parentesco:</td>
                    <td class="etiqueta" style="width:50%;"> Firma del Solicitante Suplementario</td>
                   
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">                     sd                    </td>
                    <td  style="width:50%;border-right:none;">                     sd                    </td>
                </tr>
            </table>
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:80%;border-right: 1px solid rgb(129,129,129);">Nombres y Apellidos:</td>
                    <td class="etiqueta" style="width:20%;">Sexo</td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:80%;border-left:none;">NOMBRES Y APELLIDOS</td>
                    <td  style="width:20%;border-right:none;">
                    &nbsp;&nbsp;M<input type="checkbox" checked="checked" >
                    &nbsp;&nbsp;F<input type="checkbox" checked="checked" >
                    </td>
                </tr>

            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Fecha de Nacimiento:</td>
                    <td class="etiqueta" style="width:50%;"> C&eacute;dula de Identidad:
                     &nbsp;&nbsp;V<input type="checkbox" checked="checked" >
                    &nbsp;&nbsp;E<input type="checkbox" checked="checked" >
                    </td>
                   
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">                     sd                    </td>
                    <td  style="width:50%;border-right:none;">                     sd                    </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Parentesco:</td>
                    <td class="etiqueta" style="width:50%;"> Firma del Solicitante Suplementario</td>
                   
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">                     sd                    </td>
                    <td  style="width:50%;border-right:none;">                     sd                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
    


    
</table>
</page>


';

//    if (!file_exists(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'])) {
//        mkdir(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'], 0777, true);
//    }


    $html2pdf->writeHTML($conte);
//    $html2pdf->Output(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . '/' . $_POST['tp_documento'] . $_POST['n_documento'] . '_APERTURA.pdf', 'F');
    $html2pdf->Output('_APERTURA.pdf');

    exit();
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}





