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

    $html2pdf = new HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(2, 2, 2, 2));
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
    .titulo{text-align: center;font-size: 12px;border:none;font-weight: bold;}
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
        <td  style="width:33.33%;border:none;padding-right:5px;vertical-align: top;">
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
                    <td class="titulo2">
                        DATOS PERSONALES
                    </td>               
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
                  <tr class="valores">
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
        <td  style="width:33.33%;border:none;vertical-align: top;">
        
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       REFERENCIAS FAMILIARES O PERSONALES
                    </td>               
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
            <br>
  <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="titulo2">
                       DATOS LABORABLES
                    </td>               
                </tr>
            </table>
    


</td>
        <td  style="width:33.33%;border:none;"><b>FECHA:</b>  ' . $_POST['fc_cita'] . '</td>
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





