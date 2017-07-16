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
                    <td  style="width:80%;border-left:none;">' . $_POST['p_nombre'] . ' ' . $_POST['s_nombre'] . ' ' . $_POST['p_apellido'] . ' ' . $_POST['s_apellido'] . '</td>
                    <td  style="width:20%;border-right:none;">';

    if ($_POST['tp_sexo'] == "M")
        $conte .= '&nbsp;&nbsp;<input type="checkbox"  checked="checked"> M';
    else
        $conte .= '&nbsp;&nbsp;<input type="checkbox"  > M';

    if ($_POST['tp_sexo'] == "F")
        $conte .= ' &nbsp;&nbsp;<input type="checkbox"  checked="checked"> F';
    else
        $conte .= ' &nbsp;&nbsp;<input type="checkbox"  > F';

    $conte .= ' 
                    </td>
                </tr>

            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> C&eacute;dula de Identidad:';

    if ($_POST['tp_documento'] == "C")
        $conte .= '&nbsp;&nbsp;V<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;&nbsp;V<input type="checkbox"  >';

    if ($_POST['tp_documento'] == "E")
        $conte .= '&nbsp;&nbsp;E<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;&nbsp;E<input type="checkbox"  >';

    $conte .= '              
                    </td>
                    <td class="etiqueta" style="width:50%;"> RIF:</td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;"> ' . $_POST['n_documento'] . '</td>
                    <td  style="width:50%;border-right:none;"> ' . $_POST['pn_rif'] . '</td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Pasaporte: </td>
                    <td class="etiqueta" style="width:50%;"> Lugar y fecha de Nacimiento:</td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;">' . $_POST['pasaporte'] . '</td>
                    <td  style="width:50%;border-right:none;">' . $_POST['tp_pais'] . ' ' . $_POST['tp_estado'] . ' ' . $_POST['tp_ciudad'] . ' ' . $_POST['fc_nac'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);font-size:9px;"> Si es nacionalizado, indique C.I. anterior: </td>
                    <td class="etiqueta" style="width:50%;"> Tiempo en el Pa&iacute;s:</td>
                </tr>
                
                 <tr class="valores">tiempo_pais
                    <td  style="width:50%;border-left:none;">' . $_POST['naturalizado'] . '</td>
                    <td  style="width:50%;border-right:none;">' . $_POST['tiempo_antiguo'] . ' ' . $_POST['tiempo_pais'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Estado civil:  ';



    if ($_POST['tp_civil'] == "Soltero")
        $conte .= ' <input type="checkbox" checked="checked" >&nbsp;&nbsp;Soltero&nbsp;';
    else
        $conte .= ' <input type="checkbox"  >&nbsp;&nbsp;Soltero&nbsp;';

    if ($_POST['tp_civil'] == "Casado")
        $conte .= '<input type="checkbox" checked="checked" >&nbsp;&nbsp;Casado';
    else
        $conte .= '<input type="checkbox"  >&nbsp;&nbsp;Casado';

    $conte .= '       
                 
                   </td>
                    <td class="etiqueta" style="width:50%;">Profesi&oacute;n:</td>
                </tr>
                
               <tr class="valores">
                    <td  style="width:50%;border-left:none;">';


    if ($_POST['tp_civil'] == "Divorciado")
        $conte .= ' <input type="checkbox" checked="checked" >&nbsp;&nbsp;Divorciado';
    else
        $conte .= ' <input type="checkbox"  >&nbsp;&nbsp;Divorciado';

    if ($_POST['tp_civil'] == "Viudo")
        $conte .= '<input type="checkbox" checked="checked" >&nbsp;&nbsp;Viudo';
    else
        $conte .= '<input type="checkbox"  >&nbsp;&nbsp;Viudo';
    $conte .= '  
                     
                    </td>
                    <td  style="width:50%;border-right:none;">' . $_POST['tp_profecion'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Cargas familiares: </td>
                    <td class="etiqueta" style="width:50%;">Tel&eacute;fonos:</td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">' . $_POST['tp_profecion'] . '</td>
                    <td  style="width:50%;border-right:none;">' . $_POST['dtp_telefonoH'] . ' ' . $_POST['d_telefonoh'] . ' / ' . $_POST['dtp_telefono2'] . ' ' . $_POST['d_telefono2'] . ' </td>
                </tr>
            </table>
            
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Tel&eacute;fonos Celular: </td>
                    <td class="etiqueta" style="width:50%;">Correo Electr&oacute;nico:</td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">' . $_POST['dtp_celular'] . ' ' . $_POST['d_celular'] . '</td>
                    <td  style="width:50%;border-right:none;">' . $_POST['email'] . '</td>
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
                   <td  style="width:50%;border-right:none;border-left:none;">' . $_POST['ccp_nombre'] . ' ' . $_POST['ccs_nombre'] . ' ' . $_POST['ccp_apellido'] . ' ' . $_POST['ccs_apellido'] . '</td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> C&eacute;dula de Identidad:
                     ';
    if ($_POST['cctp_documento'] == "C")
        $conte .= '&nbsp;&nbsp;V<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;&nbsp;V<input type="checkbox"  >';

    if ($_POST['cctp_documento'] == "E")
        $conte .= '&nbsp;&nbsp;E<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;&nbsp;E<input type="checkbox"  >';
    $conte .= '    </td>
                       <td class="etiqueta" style="width:50%;"> Lugar y fecha de Nacimiento:</td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">' . $_POST['CCn_documento'] . '</td>
                    <td  style="width:50%;border-right:none;"> ' . $_POST['cctp_pais'] . ' ' . $_POST['cctp_estado'] . ' ' . $_POST['cctp_ciudad'] . ' ' . $_POST['ccfc_nac'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Empresa donde trabaja actualmente: </td>
                    <td class="etiqueta" style="width:20%;border-right: 1px solid rgb(129,129,129);"> Tel&eacute;fonos: </td>
                    <td class="etiqueta" style="width:30%;"> Sueldo Mensual Bs.:</td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:50%;border-left:none;">' . $_POST['cct_empresa_'] . '</td>
                    <td  style="width:20%;border-left:none;">' . $_POST['dcc_dtp_telefonoH'] . ' ' . $_POST['dcc_d_telefonoh'] . ' / ' . $_POST['dcc_dtp_telefono2'] . ' ' . $_POST['dcc_d_telefono2'] . '</td>
                     <td  style="width:30%;border-right:none;">' . $_POST['ccsueldo'] . '</td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:100%;" colspan="2"> Correo Electr&oacute;nico: </td>
                </tr>
                
                 <tr class="valores">
                   <td  style="width:50%;border-right:none;border-left:none;">' . $_POST['ccemail'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:100%;" colspan="3"> <b>DIRECCI&Oacute;N HABITACI&Oacute;N </b></td>
                </tr>                
                  <tr >
                    <td class="etiqueta" style="width:32%;border-right: 1px solid rgb(129,129,129);" > Avenida: </td>
                   <td class="etiqueta" style="width:32%;border-right: 1px solid rgb(129,129,129);" > Calle: </td>
                    <td class="etiqueta" style="width:36%;" > ';

    if ($_POST['d_ceq'] == "CASA")
        $conte .= 'Casa<input type="checkbox" checked="checked" >';
    else
        $conte .= 'Casa<input type="checkbox"  >';

    if ($_POST['d_ceq'] == "QUINTA")
        $conte .= '&nbsp;Quinta<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;Quinta<input type="checkbox"  >';

    if ($_POST['d_ceq'] == "EDIFICIO")
        $conte .= '&nbsp;Edf.<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;Edf.<input type="checkbox"  >';

    $conte .= ' 
                    <br>
                    Nombre o N&ordm;
                    </td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:32%;border-left:none;" >' . $_POST['d_avenida'] . '</td>
                   <td  style="width:32%;" > ' . $_POST['d_calle'] . ' </td>
                    <td  style="width:36%;border-right:none;" >' . $_POST['d_ceq2'] . '</td>
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
                    <td  style="width:14%;border-left:none;" >' . $_POST['d_piso'] . '</td>
                   <td  style="width:14%;" >' . $_POST['d_apartamento'] . '</td>
                    <td  style="width:36%;" >' . $_POST['d_urbanizacion'] . '</td>
                     <td  style="width:36%;border-right:none;" >' . $_POST['dtp_municipio'] . '</td>
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
                    <td  style="width:25%;border-left:none;" >' . $_POST['dtp_parroquia'] . '</td>
                   <td  style="width:25%;" >' . $_POST['dtp_estado'] . ' </td>
                    <td  style="width:25%;" >' . $_POST['dtp_ciudad'] . '</td>
                     <td  style="width:25%;border-right:none;" >' . $_POST['d_postal'] . ' </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Tel&eacute;fonos: </td>
                   <td class="etiqueta" style="width:50%;" >Vivienda:';

    if ($_POST['tp_inmueble'] == "DE MIS PADRES")
        $conte .= '<input type="checkbox" checked="checked" >De mis padre';
    else
        $conte .= '<input type="checkbox"  >De mis padre';

    if ($_POST['tp_inmueble'] == "PROPIA")
        $conte .= '<input type="checkbox" checked="checked" > Propia';
    else
        $conte .= '<input type="checkbox"  > Propia';

    $conte .= '    
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" >' . $_POST['dcc_dtp_telefono2_'] . ' ' . $_POST['dcc_d_telefono2__'] . '</td>
                     <td  style="width:50%;border-right:none;" > ';

    if ($_POST['tp_inmueble'] == "DE UN FAMILIAR")
        $conte .= '<input type="checkbox" checked="checked" > De un familiar';
    else
        $conte .= '<input type="checkbox"  > De un familiar';

    if ($_POST['tp_inmueble'] == "ALQUILADA")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" > Alquilada';
    else
        $conte .= '&nbsp;<input type="checkbox"  > Alquilada';

    $conte .= '    
                    </td>
                </tr>
            </table>
               <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > Si es vivienda propia, indique a&ntilde;o de adquisici&oacute;n: </td>
               
                </tr>
                
               <tr class="valores">
                    <td  style="width:100%;border-left:none;border-right:none;" > ' . $_POST['ano_vivienda'] . ' </td>
                    
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Alquiler o Cuota Hipotecaria: </td>
                   <td class="etiqueta" style="width:50%;" > A&ntilde;os en esta direcci&oacute;n: </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > ' . $_POST['canon'] . '  </td>
                     <td  style="width:50%;border-right:none;" >  ' . $_POST['ano_vivienda2'] . ' </td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Nombre de su Acreedor<br>Hipotecario o Arrendador: </td>
                   <td class="etiqueta" style="width:50%;" > N&uacute;mero de Cr&eacute;dito: </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > ' . $_POST['canon_nombre'] . '  </td>
                     <td  style="width:50%;border-right:none;" >   ' . $_POST['canon_credito'] . ' </td>
                </tr>
            </table>
               <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > Tel&eacute;fonos: </td>
               
                </tr>
                
                 <tr class="valores">
                    <td  style="width:100%;border-left:none;border-right:none;" > ' . $_POST['dctp_telefono'] . ' ' . $_POST['cd_telefono'] . ' </td>
                    
                </tr>
            </table>
               <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > Otras Propiedades que posee: </td>
               
                </tr>
                
                 <tr class="valores">
                    <td  style="width:100%;border-left:none;border-right:none;" > rrrr';

//     if ($_POST['tp_inmueble'] == "DE UN FAMILIAR")
//        $conte .= '&nbsp; &nbsp;<input type="checkbox" checked="checked" > Apartamentos';
//    else
//        $conte .= '&nbsp; &nbsp;<input type="checkbox"  > Apartamentos';
//
//    if ($_POST['tp_inmueble'] == "ALQUILADA")
//        $conte .= '&nbsp;<input type="checkbox" checked="checked" > Terrenos';
//    else
//        $conte .= '&nbsp;<input type="checkbox"  > Terrenos';
//    
//     if ($_POST['tp_inmueble'] == "DE UN FAMILIAR")
//        $conte .= '&nbsp;<input type="checkbox" checked="checked" > Locales';
//    else
//        $conte .= '&nbsp;<input type="checkbox"  > Locales';
//
//    if ($_POST['tp_inmueble'] == "ALQUILADA")
//        $conte .= '&nbsp;<input type="checkbox" checked="checked" > Otros';
//    else
//        $conte .= '&nbsp;<input type="checkbox"  > Otros';



    $conte .= '   
                    </td>
                    
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Automov&iacute;l: </td>
                   <td class="etiqueta" style="width:50%;" > Modelo: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;" >  ' . $_POST['automovil_'] . ' </td>
                     <td  style="width:50%;border-right:none;" >   ' . $_POST['auto_model'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > A&ntilde;o: </td>
                   <td class="etiqueta" style="width:50%;" > Placa: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;" >  ' . $_POST['auto_ano'] . ' </td>
                     <td  style="width:50%;border-right:none;" >   ' . $_POST['auto_placa'] . '</td>
                </tr>
            </table>


</td>';
    
    
    $conte .= '  
    
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
                  <td  style="width:74%;border-left:none;" >' . $_POST['rfa_nombre10'] . ' </td>
                     <td  style="width:26%;border-right:none;" > ' . $_POST['rf_parentesco10'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:37%;border-right: 1px solid rgb(129,129,129);" >Ciudad: </td>
                    <td class="etiqueta" style="width:37%;border-right: 1px solid rgb(129,129,129);" >  Tel&eacute;fonos: </td>
                    <td class="etiqueta" style="width:26%;" > Celular: </td>
                </tr>
                
                 <tr class="valores">
                   <td  style="width:37%;border-left:none;" > ' . $_POST['rf_direccion10'] . ' </td>
                    <td  style="width:37%;border-left:none;" > ' . $_POST['dtp_telefonoH10'] . ' ' . $_POST['d_telefonoh10'] . ' </td>
                     <td  style="width:26%;border-right:none;" >  ' . $_POST['2_dtp_telefonoH10'] . ' ' . $_POST['2_d_telefonoh10'] . '</td>
              
                </tr>
            </table>
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:74%;border-right: 1px solid rgb(129,129,129);" >Nombres y Apellidos: </td>
                    <td class="etiqueta" style="width:26%;" > Parentesco: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:74%;border-left:none;" >' . $_POST['rfa_nombre11'] . ' </td>
                     <td  style="width:26%;border-right:none;" > ' . $_POST['rf_parentesco11'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:37%;border-right: 1px solid rgb(129,129,129);" >Ciudad: </td>
                    <td class="etiqueta" style="width:37%;border-right: 1px solid rgb(129,129,129);" >  Tel&eacute;fono: </td>
                    <td class="etiqueta" style="width:26%;" > Celular: </td>
                </tr>
                
                 <tr class="valores">
                    <td  style="width:37%;border-left:none;" > ' . $_POST['rf_direccion11'] . ' </td>
                    <td  style="width:37%;border-left:none;" > ' . $_POST['dtp_telefonoH11'] . ' ' . $_POST['d_telefonoh11'] . ' </td>
                     <td  style="width:26%;border-right:none;" >  ' . $_POST['2_dtp_telefonoH11'] . ' ' . $_POST['2_d_telefonoh11'] . '</td>
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
                    <td  style="width:100%;border-left:none;border-right:none;" > ' . $_POST['n_empresa'] . '</td>
                    
                </tr>
            </table>
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                  <tr >
                    <td class="etiqueta" style="width:32%;border-right: 1px solid rgb(129,129,129);" > Avenida: </td>
                   <td class="etiqueta" style="width:32%;border-right: 1px solid rgb(129,129,129);" > Calle: </td>
                    <td class="etiqueta" style="width:36%;" > ';

    if ($_POST['ee_ceq'] == "CASA")
        $conte .= 'Casa<input type="checkbox" checked="checked" >';
    else
        $conte .= 'Casa<input type="checkbox"  >';

    if ($_POST['ee_ceq'] == "QUINTA")
        $conte .= '&nbsp;Quinta<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;Quinta<input type="checkbox"  >';

    if ($_POST['ee_ceq'] == "EDIFICIO")
        $conte .= '&nbsp;Edf.<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;Edf.<input type="checkbox"  >';


    $conte .= '
                <br>
                    Nombre o N&ordm;
                    </td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:32%;border-left:none;" >' . $_POST['e_avenida'] . '</td>
                   <td  style="width:32%;" >' . $_POST['e_calle'] . ' </td>
                    <td  style="width:36%;border-right:none;" >' . $_POST['e_ceq'] . ' </td>
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
                    <td  style="width:14%;border-left:none;" > ' . $_POST['e_piso'] . ' </td>
                   <td  style="width:14%;" > ' . $_POST['e_Oficina'] . ' </td>
                    <td  style="width:36%;" > ' . $_POST['e_urbanizacion'] . ' </td>
                     <td  style="width:36%;border-right:none;" > ' . $_POST['etp_parroquia'] . ' </td>
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
                    <td  style="width:25%;border-left:none;" >  ' . $_POST['etp_municipio'] . ' </td>
                   <td  style="width:25%;" >  ' . $_POST['etp_estado'] . '</td>
                    <td  style="width:25%;" >  ' . $_POST['etp_ciudad'] . ' </td>
                     <td  style="width:25%;border-right:none;" >  ' . $_POST['e_postal'] . ' </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:70%;border-right: 1px solid rgb(129,129,129);" > Tel&eacute;fonos Oficina: </td>
                   <td class="etiqueta" style="width:30%;" >Fax Oficina:
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:70%;border-left:none;" > ' . $_POST['edctp_telefono'] . ' ' . $_POST['ecd_telefono'] . ' / ' . $_POST['edctp_telefono2'] . ' ' . $_POST['ecd_telefono2'] . ' </td>
                    <td  style="width:30%;border-right:none;" > ' . $_POST['edctp_fax'] . ' ' . $_POST['ecd_fax'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:70%;border-right: 1px solid rgb(129,129,129);" > Correo Electr&oacute;nico: </td>
                   <td class="etiqueta" style="width:30%;" >Sector Econ&oacute;mico:
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:70%;border-left:none;" > ' . $_POST['ramo_empresa'] . ' </td>
                     <td  style="width:30%;border-right:none;" > ' . $_POST['emp_email'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:70%;border-right: 1px solid rgb(129,129,129);" > Cargo: </td>
                   <td class="etiqueta" style="width:30%;" >Tiempo en la Empresa:
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:70%;border-left:none;" > ' . $_POST['cargo_empresa'] . ' </td>
                     <td  style="width:30%;border-right:none;" >  ' . $_POST['e_antiguo'] . ' ' . $_POST['e_antiguo_op'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Sueldo Mensual: </td>
                   <td class="etiqueta" style="width:50%;" >Otros Ingresos:  </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > ' . $_POST['sueldo'] . ' </td>
                     <td  style="width:50%;border-right:none;" > ' . $_POST['otros_ingresos'] . '</td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:100%;" > Por Concepto de: </td>
               
                </tr>
                
                 <tr class="valores">
                    <td  style="width:100%;border-left:none;border-right:none;" >  ' . $_POST['concepto_empresa'] . '</td>
                    
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:70%;border-right: 1px solid rgb(129,129,129);" > Nombre de la Empresa donde trabajo anteriolmente: </td>
                   <td class="etiqueta" style="width:30%;" >Sector Econ&oacute;mico:
                    </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:70%;border-left:none;" > ' . $_POST['n_empresa2'] . '</td>
                     <td  style="width:30%;border-right:none;" > ' . $_POST['ramo_empresa2'] . '</td>
                </tr>
            </table>
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Cargo: </td>
                   <td class="etiqueta" style="width:50%;" >Ingreso Mensual:  </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > ' . $_POST['cargo_empresa2'] . '</td>
                     <td  style="width:50%;border-right:none;" > ' . $_POST['sueldo2'] . ' </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                             
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);" > Fecha Egreso: </td>
                   <td class="etiqueta" style="width:50%;" >Tiempo en la Empresa:  </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:50%;border-left:none;" > ' . $_POST['fc_egreso'] . ' </td>
                     <td  style="width:50%;border-right:none;" >  ' . $_POST['e_antiguo2'] . ' ' . $_POST['e_antiguo_op'] . ' </td>
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
                    <td class="etiqueta" style="width:100%;" > <br>Balance al: ' . $_POST['balance_al'] . '</td>
               
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
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" >' . $_POST['df_banco'] . '</td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" >7. Tarjetas de Cr&eacute;dito </td>
                    <td  style="width:25%;text-align:center;border-right:none;" > ' . $_POST['df_tarjetas'] . ' </td>
                </tr>
                <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" >2. Inversiones</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" >' . $_POST['df_invercion'] . '</td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" >8. Pr&eacute;stamos  </td>
                    <td  style="width:25%;text-align:center;border-right:none;" > ' . $_POST['df_prestamos'] . ' </td>
                </tr>  
                <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" >3. Moviliario</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" >' . $_POST['df_mobiliario'] . '</td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" >9. Hipotecas por Pagar  </td>
                    <td  style="width:25%;text-align:center;border-right:none;" > ' . $_POST['df_hipoteca'] . ' </td>
                </tr> 
                 <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" >4. Veh&iacute;culos</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" >' . $_POST['df_vehivulo'] . '</td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" ><b>10. Total Pasivo</b><br>(7+8+9)</td>
                    <td  style="width:25%;text-align:center;border-right:none;" > ' . $_POST['df_tpasivo'] . ' </td>
                </tr> 
                 <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" >5. Inmuebles</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" >' . $_POST['df_inmuebles'] . '</td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none" >11. Patrimonio (6-10)</td>
                    <td  style="width:25%;text-align:center;border-right:none;" > ' . $_POST['df_patrimonio'] . ' </td>
                </tr> 
                 <tr class="valores">
                    <td  style="width:25%;background:rgb(200,200,200);height:20px;border-left:none;border-right:none" ><b>6. Total Activos</b><br>(1+2+3+4+5)</td>
                    <td  style="width:25%;text-align:center;border-left:none;border-right:none" >' . $_POST['df_tactivos'] . '</td>
                    <td  style="width:25%;background:rgb(200,200,200);border-left:none;border-right:none;" ><b>10. Total Pasivo y Patrimonio</b></td>
                    <td  style="width:25%;text-align:center;border-right:none;" >' . $_POST['df_total'] . '  </td>
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
                    <td  style="width:24%;border-left:none;" > ' . $_POST['tp_banco0'] . ' </td>
                    <td  style="width:68%;border-left:none;" > ' . $_POST['cuenta0'] . ' </td>
                     <td  style="width:8%;border-right:none;" >';


    if ($_POST['tp_cuenta0'] == "C")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" >C <br>';
    else
        $conte .= '&nbsp;<input type="checkbox"  >C <br>';

    if ($_POST['tp_cuenta0'] == "A")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" >A';
    else
        $conte .= '&nbsp;<input type="checkbox"  >A';


    $conte .= '                
                     </td>
                </tr>
                <tr class="valores">
                    <td  style="width:24%;border-left:none;" > ' . $_POST['tp_banco1'] . '</td>
                    <td  style="width:68%;border-left:none;" > ' . $_POST['cuenta1'] . ' </td>
                     <td  style="width:8%;border-right:none;" > ';
    if ($_POST['tp_cuenta1'] == "C")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" >C <br>';
    else
        $conte .= '&nbsp;<input type="checkbox"  >C <br>';

    if ($_POST['tp_cuenta1'] == "A")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" >A';
    else
        $conte .= '&nbsp;<input type="checkbox"  >A';


    $conte .= '                
                     </td>
                </tr>
                <tr class="valores">
                     <td  style="width:24%;border-left:none;" > ' . $_POST['tp_banco2'] . ' </td>
                    <td  style="width:68%;border-left:none;" > ' . $_POST['cuenta2'] . ' </td>
                     <td  style="width:8%;border-right:none;" >                       ';
    if ($_POST['tp_cuenta2'] == "C")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" >C <br>';
    else
        $conte .= '&nbsp;<input type="checkbox"  >C <br>';

    if ($_POST['tp_cuenta2'] == "A")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" >A';
    else
        $conte .= '&nbsp;<input type="checkbox"  >A';


    $conte .= '                             
                     </td>
                </tr>
                <tr class="valores">
                    <td  style="width:24%;border-left:none;" > ' . $_POST['tp_banco3'] . ' </td>
                    <td  style="width:68%;border-left:none;" > ' . $_POST['cuenta3'] . ' </td>
                     <td  style="width:8%;border-right:none;" > ';
    if ($_POST['tp_cuenta3'] == "C")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" >C <br>';
    else
        $conte .= '&nbsp;<input type="checkbox"  >C <br>';

    if ($_POST['tp_cuenta3'] == "A")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" >A';
    else
        $conte .= '&nbsp;<input type="checkbox"  >A';


    $conte .= '                            
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
            </table>';

    for ($i = 0; $i <= 3; $i++) {

        $conte .= '  <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;"  colspan="3">  </td>
                </tr>        
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" > Banco </td>
                     <td class="etiqueta" style=width:62%;border-right: 1px solid rgb(129,129,129);" > Tarjeta N&ordm; </td>
                   <td class="etiqueta" style="width:8%;" >';

        if ($_POST['tjp_titularidad' . $i] == "T")
            $conte .= '&nbsp;<input type="checkbox" checked="checked" >T';
        else
            $conte .= '&nbsp;<input type="checkbox"  >T';



        $conte .= '   </td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" > ' . $_POST['tjp_banco' . $i] . '  </td>
                    <td  style="width:62%;border-left:none;" > ' . $_POST['tjp_cuenta' . $i] . '  </td>
                     <td  style="width:8%;border-right:none;" >  ';
        if ($_POST['tjp_titularidad' . $i] == "S")
            $conte .= '&nbsp;<input type="checkbox" checked="checked" >S';
        else
            $conte .= '&nbsp;<input type="checkbox"  >S';

        $conte .= '  
                                 
                     </td>
                </tr>
              
            </table> 
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:30%;border-right: 1px solid rgb(129,129,129);" >';

        if ($_POST['tjp_tj' . $i] == "CLÁSICA")
            $conte .= '&nbsp;<input type="checkbox" checked="checked" >Cl&aacute;sica';
        else
            $conte .= '&nbsp;<input type="checkbox"  >Cl&aacute;sica';

        if ($_POST['tjp_tj' . $i] == "DORADA")
            $conte .= '&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" checked="checked" >Dorada<br>';
        else
            $conte .= '&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  >Dorada<br>';

        if ($_POST['tjp_tj' . $i] == "PLATINUM")
            $conte .= '&nbsp;<input type="checkbox" checked="checked" >Platinum';
        else
            $conte .= '&nbsp;<input type="checkbox"  >Platinum';

        if ($_POST['tjp_tj' . $i] == "BLACK")
            $conte .= ' &nbsp;&nbsp;<input type="checkbox" checked="checked" >Black';
        else
            $conte .= ' &nbsp;&nbsp;<input type="checkbox"  >Black';


        $conte .= '          
                  
                    </td>
                     <td class="etiqueta" style=width:35%;" > L&iacute;mite de Cr&eacute;dito </td>
                     <td class="etiqueta" style="width:35%;" >Saldo Actual</td>
                </tr>
                <tr class="valores">
                    <td  style="width:30%;border-left:none;" >';

        if ($_POST['tjp_tj' . $i] == "OTRO")
            $conte .= ' &nbsp;<input type="checkbox" checked="checked" >Otros';
        else
            $conte .= ' &nbsp;<input type="checkbox"  >Otros';



        $conte .= '   </td>
                    <td  style="width:35%;border-left:none;border-right:none;" > ' . $_POST['tjp_limite' . $i] . ' </td>
                     <td  style="width:35%;border-left:none;border-right:none;" > ' . $_POST['tjp_saldo' . $i] . '             </td>
                </tr>
              
            </table> ';
    }



    $conte .= '        
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
             <tr>
                    <td class="etiqueta" style="width:100%;borde: none;height:2px;" >  </td>
                </tr> 
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
                   Autorizo a cargar mensualmente el pago';

    if ($_POST['autor_tpago'] == "T")
        $conte .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total<input type="checkbox"  >';

    if ($_POST['autor_tpago'] == "M")
        $conte .= ' &nbsp;&nbsp;&nbsp;M&iacute;nimo<input type="checkbox" checked="checked" >';
    else
        $conte .= ' &nbsp;&nbsp;&nbsp;M&iacute;nimo<input type="checkbox"  >';


    $conte .= '    
                </td>
                </tr>
                <tr class="valores">
                      <td  style="width:100%;border-left:none;border-right:none;" >  
                            ' . $_POST['autor_autorizacion'] . '
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
                            ' . $_POST['autor_cuenta'] . '
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
                          Agencia Banplus:  ' . $_POST['env_fn_agencia'] . '
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
                      <td  style="width:100%;border-left:none;border-right:none;" >';


    if (!empty($_POST['corresp_correo']))
        $conte .= '<input type="checkbox" checked="checked" >';
    else
        $conte .= '<input type="checkbox" >';

    $conte .= '
                          Correo Electr&oacute;nico:' . $_POST['corresp_correo'] . '
                         
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    if ($_POST['env_tarjeta'] == "H")
        $conte .= '<input type="checkbox" checked="checked" >Habitaci&oacute;n ';
    else
        $conte .= '<input type="checkbox" >Habitaci&oacute;n ';

    if ($_POST['env_tarjeta'] == "O")
        $conte .= '<input type="checkbox" checked="checked" >Oficina';
    else
        $conte .= '<input type="checkbox" >Oficina';



    $conte .= '
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
                     <td  style="width:80%;border-left:none;">' . $_POST['ts_p_nombre0'] . ' ' . $_POST['ts_s_nombre0'] . ' ' . $_POST['ts_p_apellido0'] . ' ' . $_POST['ts_s_apellido0'] . '</td>
                    <td  style="width:20%;border-right:none;">';

    if ($_POST['ts_tp_sexo0'] == "M")
        $conte .= '&nbsp;&nbsp;<input type="checkbox"  checked="checked"> M';
    else
        $conte .= '&nbsp;&nbsp;<input type="checkbox"  > M';

    if ($_POST['ts_tp_sexo0'] == "F")
        $conte .= ' &nbsp;&nbsp;<input type="checkbox"  checked="checked"> F';
    else
        $conte .= ' &nbsp;&nbsp;<input type="checkbox"  > F';

    $conte .= ' 
                    </td>
                </tr>

            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Fecha de Nacimiento:</td>
                    <td class="etiqueta" style="width:50%;"> C&eacute;dula de Identidad:';
    
     if ($_POST['ts_tp_documento0'] == "C")
        $conte .= '&nbsp;&nbsp;V<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;&nbsp;V<input type="checkbox"  >';

    if ($_POST['ts_tp_documento0'] == "E")
        $conte .= '&nbsp;&nbsp;E<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;&nbsp;E<input type="checkbox"  >';

    $conte .= '       
                    </td>
                   
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">   ' . $_POST['ts_fc_nac0'] . '</td>
                    <td  style="width:50%;border-right:none;">       ' . $_POST['ts_n_documento0'] . '  </td>
                </tr>
            </table>
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Parentesco:</td>
                    <td class="etiqueta" style="width:50%;"> Firma del Solicitante Suplementario</td>
                   
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">  ' . $_POST['ts_parentesco0'] . '</td>
                    <td  style="width:50%;border-right:none;"> &nbsp; </td>
                </tr>
            </table>
              <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:80%;border-right: 1px solid rgb(129,129,129);">Nombres y Apellidos:</td>
                    <td class="etiqueta" style="width:20%;">Sexo</td>
                </tr>
                
                  <tr class="valores">
                    <td  style="width:80%;border-left:none;">' . $_POST['ts_p_nombre1'] . ' ' . $_POST['ts_s_nombre1'] . ' ' . $_POST['ts_p_apellido1'] . ' ' . $_POST['ts_s_apellido1'] . '</td>
                    <td  style="width:20%;border-right:none;">';

    if ($_POST['ts_tp_sexo1'] == "M")
        $conte .= '&nbsp;&nbsp;<input type="checkbox"  checked="checked"> M';
    else
        $conte .= '&nbsp;&nbsp;<input type="checkbox"  > M';

    if ($_POST['ts_tp_sexo1'] == "F")
        $conte .= ' &nbsp;&nbsp;<input type="checkbox"  checked="checked"> F';
    else
        $conte .= ' &nbsp;&nbsp;<input type="checkbox"  > F';

    $conte .= ' </td>
                </tr>

            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Fecha de Nacimiento:</td>
                    <td class="etiqueta" style="width:50%;"> C&eacute;dula de Identidad:';
                      if ($_POST['ts_tp_documento1'] == "C")
        $conte .= '&nbsp;&nbsp;V<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;&nbsp;V<input type="checkbox"  >';

    if ($_POST['ts_tp_documento1'] == "E")
        $conte .= '&nbsp;&nbsp;E<input type="checkbox" checked="checked" >';
    else
        $conte .= '&nbsp;&nbsp;E<input type="checkbox"  >';

    $conte .= '   
                    </td>
                   
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;"> ' . $_POST['ts_fc_nac1'] . '</td>
                    <td  style="width:50%;border-right:none;">   ' . $_POST['ts_n_documento1'] . ' </td>
                </tr>
            </table>
             <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td class="etiqueta" style="width:50%;border-right: 1px solid rgb(129,129,129);"> Parentesco:</td>
                    <td class="etiqueta" style="width:50%;"> Firma del Solicitante Suplementario</td>
                   
                </tr>
                
                 <tr class="valores">
                    <td  style="width:50%;border-left:none;">   ' . $_POST['ts_parentesco1'] . ' </td>
                    <td  style="width:50%;border-right:none;">      &nbsp;  </td>
                </tr>
            </table>
            
        </td>
    </tr>
    


    
</table>
</page>


';

    if (!file_exists(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'])) {
        mkdir(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'], 0777, true);
    }


    $html2pdf->writeHTML($conte);
    $html2pdf->Output(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . '/' . $_POST['tp_documento'] . $_POST['n_documento'] . '_SOLI_TARJETA.pdf', 'F');
//  $html2pdf->Output('_APERTURA.pdf');

    exit();
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}





