<?php

//var_dump($_POST);
//return;
//exit();
//ob_start();
//$content = ob_get_clean();
// convert in PDF
include_once "../includes/html2pdf/vendor/autoload.php";
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(3, 6, 3, 3));
//      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');


    $conte = '
<style type="text/css">
    td {border: 1px solid rgb(129,129,129); width:100%;}
    table{width:100%;}
    .seccion{text-align: center;width:100%;background: rgb(150,150,150);font-weight: bold;font-size: 11px;}
    .bloque{width:100%;border: none;}
    .bloque table{border:none;margin-left:-1px;width:100.3%;margin-top:-2px;}
    .etiqueta{ border-top: none;text-align: center;background: rgb(193,193,193);font-weight: bold;font-size: 10px;vertical-align: middle;}
    .titulo{text-align: center;font-size: 12px;border:none;font-weight: bold;}
    .d_linea{font-size: 9px;}
    .b_left{border-left: none;}
    .b_right{border-right: none;}
    .valores td{height: 13px;vertical-align: middle;padding: 2px;font-size: 10px;border-top: none;}
    .sub_td{border:none;width:100%;margin-left:-1px;}
    .sub_td td{border-left: none;border-right: none;padding: 0px 0 0px 0;height:5px;text-align: center;font-size: 8px;}
    
</style>
<page  backleft="0mm" backright="0mm">
<table style=" border-collapse: collapse;">
    <tr>
        <td style="border:none;">
            <table style="border-collapse: collapse;border:none;font-size:11px;" >
                <tr>
                    <td  style="width:60%;border:none;" rowspan="2"><img src="../img/logo_banplus.jpg" width="200px;" /></td>
                    <td  style="width:20%;border:none;font-weight: bold;">AGENCIA:</td>
                    <td  style="width:20%;border:none;font-weight: bold;">FECHA: </td>
                </tr>
               <tr>
                    <td  style="width:40%;border:none;font-weight: bold;" colspan="2">N&ordm; DE CUENTA:</td>
                    
                </tr>
            </table>
        </td>
    </tr>


    <tr>
        <td class="titulo">
           FICHA DE IDENTIFICACI&Oacute;N DEL CLIENTE PERSONA NATURAL
        </td>
    </tr>
    <tr>
        <td class="seccion">
            DATOS PERSONALES
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:33%;">APELLIDOS</td>
                    <td class="etiqueta" style="width:33%;">NOMBRES</td>
                    <td class="etiqueta" style="width:34%;" colspan="2">LUGAR Y FECHA DE NACIMIENTO</td>
                </tr>
                <tr class="valores">
                    <td style="width:33%;">' . $_POST['p_apellido'] . ' ' . $_POST['s_apellido'] . '</td>
                    <td style="width:33%;">' . $_POST['p_nombre'] . ' ' . $_POST['s_nombre'] . '</td>
                    <td style="width:24%;">' . $_POST['tp_pais'] . ' ' . $_POST['tp_estado'] . ' ' . $_POST['tp_ciudad'] . '</td>
                    <td style="width:10%;">' . $_POST['fc_nac'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:28%;">C.I O N&ordm; PASAPORTE</td>
                    <td class="etiqueta d_linea" style="width:25%;">SI ES NATURALIZADO INDIQUE N&ordm; C.I<br>ANTERIOL</td>
                    <td class="etiqueta" style="width:15%;">NACIONALIDAD</td>
                    <td class="etiqueta" style="width:10%;">SEXO</td>
                    <td class="etiqueta" style="width:14%;">ESTADO CIVIL</td>
                    <td class="etiqueta" style="width:8%;">EDAD</td>
                </tr>
                <tr class="valores">
                    <td style="width:28%;font-size:12px;">';

    if ($_POST['tp_documento'] == "C")
        $conte .= 'V&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= ' V&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento'] == "E")
        $conte .= 'E&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'E&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento'] == "P")
        $conte .= 'P&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'P&nbsp;<input type="checkbox"  >';


    $conte .='   ' . $_POST['n_documento'] . '         
                    </td>
                    <td style="width:25%;">' . $_POST['naturalizado'] . '</td>
                    <td style="width:15%;">' . $_POST['tp_nacionalidad'] . '</td>
                    <td style="width:10%;font-size:12px;">';

    if ($_POST['tp_sexo'] == "M")
        $conte .= '&nbsp;<input type="checkbox"  checked="checked"> M';
    else
        $conte .= '&nbsp;<input type="checkbox"  > M';

    if ($_POST['tp_sexo'] == "F")
        $conte .= '&nbsp;<input type="checkbox"  checked="checked"> F';
    else
        $conte .= '&nbsp;<input type="checkbox"  > F';

    $conte .=' 
                    </td>
                    <td style="width:14%;">' . $_POST['tp_civil'] . '</td>
                    <td style="width:8%;">' . $_POST['edad'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:23%;">ACTIVIDAD ECON&Oacute;MICA</td>
                    <td class="etiqueta" style="width:20%;">PROFESI&Oacute; U OFICIO</td>
                    <td class="etiqueta" style="width:15%;">OCUPACI&Oacute;N</td>
                     <td class="etiqueta" style="width:14%;">CARGA FAMILIAR</td>
                    <td class="etiqueta" style="width:28%;">CORREO ELECTRONICO</td>
                </tr>
                <tr class="valores">
                    <td style="width:23%;">' . $_POST['tp_sctivida'] . '</td>
                    <td style="width:20%;">' . $_POST['tp_profecion'] . '</td>
                    <td style="width:15%;">' . $_POST['tp_ocupacion'] . '</td>
                    <td style="width:14%;">' . $_POST['g_familiar'] . '</td>
                    <td style="width:28%;">' . $_POST['email'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="seccion">
            DIRECCI&Oacute;N HABITACI&Oacute;N
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:26%;">EDIFICIO / QUINTA</td>
                    <td class="etiqueta" style="width:8%;">PISO</td>
                    <td class="etiqueta" style="width:8%;">APTO.</td>
                    <td class="etiqueta" style="width:38%;">CALLE O AVENIDA</td>
                    <td class="etiqueta" style="width:20%;">URBANIZACI&Oacute;N</td>
                </tr>
                <tr class="valores">
                    <td style="width:26%;">' . $_POST['d_ceq'] . '</td>
                    <td style="width:8%;">' . $_POST['d_piso'] . '</td>
                    <td style="width:8%;">' . $_POST['d_apartamento'] . '</td>
                    <td style="width:38%;">' . $_POST['d_calle'] . '</td>
                    <td style="width:20%;">' . $_POST['d_urbanizacion'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:20%;">CUIDAD O LOCALIDA</td>
                    <td class="etiqueta" style="width:16%;">ESTADO</td>
                    <td class="etiqueta" style="width:15%;">C&Oacute;DIGO POSTAL.</td>
                    <td class="etiqueta" style="width:17%;">N&ordm; TEL&Eacute;FONO HAB.</td>
                    <td class="etiqueta" style="width:17%;">OTRO N&ordm; DE TEL&Eacute;FONO</td>
                    <td class="etiqueta" style="width:15%;">CELULAR</td>
                </tr>
                <tr class="valores">
                    <td  style="width:20%;height:5px;text-align:center;" rowspan="2">' . $_POST['dtp_estado'] . '</td>
                    <td  style="width:16%;height:5px;text-align:center;"  rowspan="2">' . $_POST['dtp_ciudad'] . '</td>
                    <td  style="width:15%;height:5px;text-align:center;"  rowspan="2">' . $_POST['d_postal'] . '</td>
                    <td  style="width:17%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                    <td  style="width:17%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                    <td  style="width:15%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                </tr>
                <tr class="valores">
                    <td  style="width:17%;border-left:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefonoH'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefonoh'] . '</td>
                    <td  style="width:17%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefono2'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefono2'] . '</td>
                    <td  style="width:15%;">&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_celular'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_celular'] . '</td>
                    
                </tr>
                
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:23%;">TIPO DE VIVIENDA</td>
                    <td class="etiqueta d_linea" style="width:10%;">A&Ntilde;OS EN<br> LA VIVIENDA</td>
                    <td class="etiqueta d_linea" style="width:20%;">CANNON<br>ARRENDAMIENTO</td>
                    <td class="etiqueta" style="width:25%;">NOMBRE ARRENDADOR.</td>
                    <td class="etiqueta" style="width:22%; font-size:9px;padding-top:2px;">N&ordm; DE TEL&Eacute;FONO ARRENDADOR</td>
                </tr>
                  <tr class="valores">
                    <td  style="width:23%;font-size:11.8px;height:5px;" rowspan="2">';
    if ($_POST['tp_inmueble'] == "PROPIA")
        $conte .= '<input type="checkbox"  checked="checked">PROPIA ';
    else
        $conte .= '<input type="checkbox"  >PROPIA ';

    if ($_POST['tp_inmueble'] == "ARRENDADA")
        $conte .= ' <input type="checkbox" checked="checked" >ARRENDADA<br>';
    else
        $conte .= ' <input type="checkbox"  >ARRENDADA<br>';

    if ($_POST['tp_inmueble'] == "OTROS")
        $conte .= ' <input type="checkbox" checked="checked" >OTROS';
    else
        $conte .= ' <input type="checkbox"  >OTROS';

    $conte .= '    
            </td>
                    <td class="" style="width:10%;"  rowspan="2">' . $_POST['ano_vivienda'] . '</td>
                    <td class="" style="width:20%;text-align:right;"  rowspan="2">' . $_POST['canon'] . ' Bs.</td>
                    <td style="width:25%;"  rowspan="2">' . $_POST['canon_nombre'] . '</td>
                    <td  style="width:15%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                </tr>
                <tr class="valores">
                      <td  style="width:22%;;border-left:none;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dctp_telefono'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['cd_telefono'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="seccion">
            DATOS LABORABLES
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:33%;">NOMBRE DE LA EMPRESA</td>
                    <td class="etiqueta" style="width:20%;">ACTIVIDAD O RAMO</td>
                    <td class="etiqueta" style="width:16%;">CARGO</td>
                    <td class="etiqueta" style="width:19%;">RELACI&Oacute;N LABORAL</td>
                    <td class="etiqueta" style="width:12%;">ANTIG&Uuml;EDAD</td>
                </tr>
               
                <tr class="valores">
                    <td  style="width:33%;">' . $_POST['n_empresa'] . '</td>
                    <td  style="width:20%;">' . $_POST['ramo_empresa'] . '</td>
                    <td  style="width:16%;">' . $_POST['cargo_empresa'] . '</td>
                    <td  style="width:19%;">' . $_POST['relacion_l'] . '</td>
                    <td  style="width:12%;">' . $_POST['e_antiguo'] . ' ' . $_POST['e_antiguo_op'] . '</td>
                </tr>
                
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:20%;">SUELDO B&Aacute;SICO</td>
                    <td class="etiqueta" style="width:23%;">BONIFICACI&Oacute;N O COMISIONES</td>
                    <td class="etiqueta" style="width:23%;">LIBRE EJERCICIO PROFESI&Oacute;N</td>
                    <td class="etiqueta" style="width:17%;">OTROS INGRESOS</td>
                    <td class="etiqueta" style="width:17%;">TOTAL INGRESOS</td>
                </tr>
                <tr class="valores">
                    <td style="width:20%;text-align:right;">' . $_POST['sueldo'] . ' Bs.</td>
                    <td style="width:23%;text-align:right;">' . $_POST['comision'] . ' Bs.</td>
                    <td style="width:23%;text-align:right;">' . $_POST['libre_ejercicio'] . ' Bs.</td>
                    <td style="width:17%;text-align:right;">' . $_POST['otros_ingresos'] . ' Bs.</td>
                    <td style="width:17%;text-align:right;">' . $_POST['total_ingresos'] . ' Bs.</td>
                </tr>
                
            </table>
        </td>
    </tr>
     <tr style="">
        <td class="seccion">
            DIRECCI&Oacute;N DE LA EMPRESA
        </td>
    </tr>
      <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:26%;">EDIFICIO / QUINTA</td>
                    <td class="etiqueta" style="width:8%;">PISO</td>
                    <td class="etiqueta" style="width:7%;">OFIC.</td>
                    <td class="etiqueta" style="width:8%;">LOCAL</td>
                    <td class="etiqueta" style="width:35%;">CALLE O AVENIDA</td>
                    <td class="etiqueta" style="width:16%;">URBANIZACI&Oacute;N</td>
                </tr>
                <tr class="valores">
                   <td  style="width:26%;">' . $_POST['e_ceq'] . '</td>
                    <td  style="width:8%;">' . $_POST['e_piso'] . '</td>
                    <td  style="width:7%;">' . $_POST['e_Oficina'] . '</td>
                    <td  style="width:8%;">' . $_POST['e_local'] . '</td>
                    <td  style="width:35%;">' . $_POST['e_calle'] . '</td>
                    <td  style="width:16%;">' . $_POST['e_urbanizacion'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:25%;" >CUIDAD O LOCALIDA</td>
                    <td class="etiqueta" style="width:24%;">ESTADO</td>
                    <td class="etiqueta" style="width:15%;">C&Oacute;DIGO POSTAL.</td>
                    <td class="etiqueta" style="width:36%;" colspan="2">N&ordm; TEL&Eacute;FONOS</td>
                   
                </tr>
                   <tr class="valores">
                        <td  style="width:25%;" rowspan="2">' . $_POST['etp_estado'] . '</td>
                        <td  style="width:24%;" rowspan="2">' . $_POST['etp_ciudad'] . '</td>
                        <td  style="width:15%;" rowspan="2">' . $_POST['e_postal'] . '</td>
                        <td  style="width:18%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                        <td  style="width:18%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                </tr>
                
                <tr class="valores">
                    <td  style="width:18%;;border-left:none;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['edctp_telefono'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['ecd_telefono'] . '
                        </td>
                          <td  style="width:18%;;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['edctp_telefono2'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['ecd_telefono2'] . '
                        </td>
              
                </tr>                
            </table>
        </td>
    </tr>
     <tr style="">
        <td class="seccion">
            DATOS DE LOS PRODUCTOS QUE POSEE EN BANPLUS
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:20%;">TIPO DE PRODUCTO</td>
                    <td class="etiqueta" style="width:30%;">N&Uacute;MERO</td>
                    <td class="etiqueta" style="width:20%;">TIPO DE PRODUCTO</td>
                    <td class="etiqueta" style="width:30%;">N&Uacute;MERO</td>
                </tr>
                
                <tr class="valores">';

    $conte .= (isset($_POST['tp_producto0'])) ? ' <td style="width:20%;">' . $_POST['tp_producto0'] . '</td>' : ' <td style="width:20%;"></td>';
    $conte .= (isset($_POST['numero_prod0'])) ? ' <td style="width:30%;">' . $_POST['numero_prod0'] . '</td>' : ' <td style="width:30%;"></td>';

    $conte .= (isset($_POST['tp_producto1'])) ? ' <td style="width:20%;">' . $_POST['tp_producto1'] . '</td>' : ' <td style="width:20%;"></td>';
    $conte .= (isset($_POST['numero_prod1'])) ? ' <td style="width:30%;">' . $_POST['numero_prod1'] . '</td>' : ' <td style="width:30%;"></td>';

    $conte .='</tr>      
                  <tr class="valores">';
    $conte .= (isset($_POST['tp_producto2'])) ? ' <td style="width:20%;">' . $_POST['tp_producto2'] . '</td>' : ' <td style="width:20%;"></td>';
    $conte .= (isset($_POST['numero_prod2'])) ? ' <td style="width:30%;">' . $_POST['numero_prod2'] . '</td>' : ' <td style="width:30%;"></td>';

    $conte .= (isset($_POST['tp_producto3'])) ? ' <td style="width:20%;">' . $_POST['tp_producto3'] . '</td>' : ' <td style="width:20%;"></td>';
    $conte .= (isset($_POST['numero_prod3'])) ? ' <td style="width:30%;">' . $_POST['numero_prod3'] . '</td>' : ' <td style="width:30%;"></td>';

    $conte .='</tr>
            </table>
        </td>
    </tr>
     <tr style="">
        <td class="seccion">
            REFERENCIAS BANCARIAS
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:20%;">BANCO</td>
                    <td class="etiqueta" style="width:25%;">N&ordm; DE CUENTA O TDC</td>
                    <td class="etiqueta" style="width:25%;">TIPO DE CUENTA O TARJETA</td>
                    <td class="etiqueta" style="width:15%;">MIENBRO DESDE</td>
                    <td class="etiqueta" style="width:15%;">AGENCIA ORIGEN</td>
                </tr>
                <tr class="valores">';

    $conte .= (isset($_POST['tp_banco0'])) ? ' <td style="width:20%;">' . $_POST['tp_banco0'] . '</td>' : ' <td style="width:20%;"></td>';
    $conte .= (isset($_POST['cuenta0'])) ? ' <td style="width:25%;">' . $_POST['cuenta0'] . '</td>' : ' <td style="width:25%;"></td>';
    $conte .= (isset($_POST['tp_cuenta0'])) ? ' <td style="width:25%;">' . $_POST['tp_cuenta0'] . '</td>' : ' <td style="width:25%;"></td>';
    $conte .= (isset($_POST['cuenta_antiguo0'])) ? ' <td style="width:15%;">' . $_POST['cuenta_antiguo0'] . '</td>' : ' <td style="width:15%;"></td>';
    $conte .= (isset($_POST['ag_origen0'])) ? ' <td style="width:15%;">' . $_POST['ag_origen0'] . '</td>' : ' <td style="width:15%;"></td>';
    $conte .='</tr>      
                  <tr class="valores">';


    $conte .= (isset($_POST['tp_banco1'])) ? ' <td style="width:20%;">' . $_POST['tp_banco1'] . '</td>' : ' <td style="width:20%;"></td>';
    $conte .= (isset($_POST['cuenta1'])) ? ' <td style="width:25%;">' . $_POST['cuenta1'] . '</td>' : ' <td style="width:25%;"></td>';
    $conte .= (isset($_POST['tp_cuenta1'])) ? ' <td style="width:25%;">' . $_POST['tp_cuenta1'] . '</td>' : ' <td style="width:25%;"></td>';
    $conte .= (isset($_POST['cuenta_antiguo1'])) ? ' <td style="width:15%;">' . $_POST['cuenta_antiguo1'] . '</td>' : ' <td style="width:15%;"></td>';
    $conte .= (isset($_POST['ag_origen1'])) ? ' <td style="width:15%;">' . $_POST['ag_origen1'] . '</td>' : ' <td style="width:15%;"></td>';

    $conte .='</tr>      
                  <tr class="valores">';
    $conte .= (isset($_POST['tp_banco2'])) ? ' <td style="width:20%;">' . $_POST['tp_banco2'] . '</td>' : ' <td style="width:20%;"></td>';
    $conte .= (isset($_POST['cuenta2'])) ? ' <td style="width:25%;">' . $_POST['cuenta2'] . '</td>' : ' <td style="width:25%;"></td>';
    $conte .= (isset($_POST['tp_cuenta2'])) ? ' <td style="width:25%;">' . $_POST['tp_cuenta2'] . '</td>' : ' <td style="width:25%;"></td>';
    $conte .= (isset($_POST['cuenta_antiguo2'])) ? ' <td style="width:15%;">' . $_POST['cuenta_antiguo2'] . '</td>' : ' <td style="width:15%;"></td>';
    $conte .= (isset($_POST['ag_origen2'])) ? ' <td style="width:15%;">' . $_POST['ag_origen2'] . '</td>' : ' <td style="width:15%;"></td>';

    $conte .= ' </tr>        
            </table>
        </td>
    </tr>
     <tr style="">
        <td class="seccion">
            REFERENCIAS COMERCIALES
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:25%;">EMPRESA COMERCIO</td>
                    <td class="etiqueta" style="width:35%;">ACTIVIDAD / RAMO</td>
                    <td class="etiqueta" style="width:40%;" colspan="2">N&ordm; DE TEL&Eacute;FONOS</td>
                </tr>
                <tr class="valores">';
    $conte .= (isset($_POST['rc_empresa0'])) ? ' <td style="width:25%;" rowspan="2"> ' . $_POST['rc_empresa0'] . '</td>' : ' <td style="width:25%;" rowspan="2"></td>';
    $conte .= (isset($_POST['rctp_ramo0'])) ? ' <td style="width:35%;" rowspan="2">' . $_POST['rctp_ramo0'] . '</td>' : ' <td style="width:35%;" rowspan="2"></td>';

    $conte .= '
                    <td  style="width:20%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                    <td  style="width:20%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                </tr> 
               <tr class="valores">';
    $conte .= (isset($_POST['rc_empresa0'])) ? ' <td style="width:20%;border-left:none;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;' . $_POST['dtp_telefonoH0'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefonoh0'] . '
                    </td>' : ' <td style="width:20%;border-left:none;"></td>';
    $conte .= (isset($_POST['rc_empresa0'])) ? ' <td style="width:20%;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;' . $_POST['dtp_telefono20'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefono20'] . '
                    </td>' : ' <td style="width:20%;"></td>';

    $conte .= '
                </tr>   
                <tr class="valores">';

    $conte .= (isset($_POST['rc_empresa1'])) ? ' <td style="width:25%;">' . $_POST['rc_empresa1'] . '</td>' : ' <td style="width:25%;"></td>';
    $conte .= (isset($_POST['rctp_ramo1'])) ? ' <td style="width:35%;">' . $_POST['rctp_ramo1'] . '</td>' : ' <td style="width:35%;"></td>';
    $conte .= (isset($_POST['rc_empresa1'])) ? ' <td style="width:20%;border-left:none;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefonoH1'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefonoh1'] . '
                    </td>' : ' <td style="width:20%;border-left:none;"></td>';
    $conte .= (isset($_POST['rc_empresa1'])) ? ' <td style="width:20%;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefono21'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefono21'] . '
                    </td>' : ' <td style="width:20%;"></td>';

    $conte .= ' 
                </tr>   
            </table>
        </td>
    </tr>
     <tr style="">
        <td class="seccion">
            REFERENCIAS PERSONALES NO FAMILIARES
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:20%;">NOMBRE Y APELLIDO</td>
                    <td class="etiqueta" style="width:20%;">OCUPACI&Oacute;N</td>
                    <td class="etiqueta" style="width:40%;">DIRECCI&Oacute;N</td>
                    <td class="etiqueta" style="width:20%;">N&ordm; DE TEL&Eacute;FONO</td>
                </tr>
                <tr class="valores">';

    $conte .= (isset($_POST['rfa_nombre10'])) ? ' <td style="width:20%;" > ' . $_POST['rfa_nombre10'] . '</td>' : ' <td style="width:20%;" ></td>';
    $conte .= (isset($_POST['rf_ocupacion10'])) ? ' <td style="width:20%;" > ' . $_POST['rf_ocupacion10'] . '</td>' : ' <td style="width:20%;" ></td>';
    $conte .= (isset($_POST['rf_direccion10'])) ? ' <td style="width:40%;" >' . $_POST['rf_direccion10'] . '</td>' : ' <td style="width:40%;" ></td>';
    $conte .= (isset($_POST['dtp_telefonoH10'])) ? ' <td style="width:20%;" > ' . $_POST['dtp_telefonoH10'] . ' ' . $_POST['d_telefonoh10'] . '</td>' : ' <td style="width:20%;" ></td>';
    $conte .= '
                </tr>   
                <tr class="valores">';
    $conte .= (isset($_POST['rfa_nombre11'])) ? ' <td style="width:20%;" > ' . $_POST['rfa_nombre11'] . '</td>' : ' <td style="width:20%;" ></td>';
    $conte .= (isset($_POST['rf_ocupacion11'])) ? ' <td style="width:20%;" > ' . $_POST['rf_ocupacion11'] . '</td>' : ' <td style="width:20%;" ></td>';
    $conte .= (isset($_POST['rf_direccion11'])) ? ' <td style="width:40%;" >' . $_POST['rf_direccion11'] . '</td>' : ' <td style="width:40%;" ></td>';
    $conte .= (isset($_POST['dtp_telefonoH11'])) ? ' <td style="width:20%;" > ' . $_POST['dtp_telefonoH11'] . ' ' . $_POST['d_telefonoh11'] . '</td>' : ' <td style="width:20%;" ></td>';
    $conte .= '
                </tr>   
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="seccion">
           DATOS DEL C&Oacute;NYUGE O CONCUBINO
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:33%;">APELLIDOS</td>
                    <td class="etiqueta" style="width:33%;">NOMBRES</td>
                    <td class="etiqueta" style="width:34%; colspan="2">LUGAR Y FECHA DE NACIMIENTO</td>
                </tr>
                  <tr class="valores">
                    <td style="width:33%;">' . $_POST['ccp_apellido'] . ' ' . $_POST['ccs_apellido'] . '</td>
                    <td style="width:33%;">' . $_POST['ccp_nombre'] . ' ' . $_POST['ccs_nombre'] . '</td>
                    <td style="width:24%;">' . $_POST['cctp_pais'] . ' ' . $_POST['cctp_estado'] . ' ' . $_POST['cctp_ciudad'] . '</td>
                    <td style="width:10%;">' . $_POST['ccfc_nac'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:30%;">C.I O N&ordm; PASAPORTE</td>
                    <td class="etiqueta d_linea" style="width:26%;">SI ES NATURALIZADO INDIQUE N&ordm; C.I<br>ANTERIOL</td>
                    <td class="etiqueta" style="width:18%;">NACIONALIDAD</td>
                    <td class="etiqueta" style="width:16%;">ESTADO CIVIL</td>
                    <td class="etiqueta" style="width:10%;">EDAD</td>
                </tr>
                <tr class="valores">
                    <td style="width:30%;font-size:12px;">';
    if ($_POST['cctp_documento'] == "C")
        $conte .= 'V&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= ' V&nbsp;<input type="checkbox"  >';

    if ($_POST['cctp_documento'] == "E")
        $conte .= 'E&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'E&nbsp;<input type="checkbox"  >';

    if ($_POST['cctp_documento'] == "P")
        $conte .= 'P&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'P&nbsp;<input type="checkbox"  >';

    $conte .=' ' . $_POST['CCn_documento'] . '   </td>
                    <td style="width:26%;">' . $_POST['ccnaturalizado'] . '</td>
                    <td style="width:18%;">' . $_POST['cctp_nacionalidad'] . '</td>
                    <td style="width:16%;">' . $_POST['cctp_civil'] . '</td>
                    <td style="width:10%;">' . $_POST['ccedad'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:25%;">PROFESI&Oacute;</td>
                    <td class="etiqueta" style="width:23%;">OCUPACI&Oacute;N / OFICIO</td>
                     <td class="etiqueta" style="width:18%;">CARGA FAMILIAR</td>
                    <td class="etiqueta" style="width:34%;">CORREO ELECTRONICO</td>
                </tr>
                 <tr class="valores">
                    <td style="width:25%;">' . $_POST['cctp_profecion'] . '</td>
                    <td style="width:23%;">' . $_POST['cctp_ocupacion'] . '</td>
                    <td style="width:18%;">' . $_POST['ccg_familiar'] . '</td>
                    <td style="width:34%;">' . $_POST['ccemail'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
</table> 
<br>
<span style="font-size:8px;font-weight: bold;">CyP / FFI-PN V.07/ VP.OPERACIONES/ OPERACIONES DE AGENCIAS / JUNIO 2016</span>

</page>
<page  backleft="0mm" backright="0mm">
<table style=" border-collapse: collapse;">
     <tr style="">
        <td class="seccion">
          INGRESOS DEL C&Oacute;NYUGE O CONCUBINO
        </td>
    </tr>
       <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:20%;">SUELDO B&Aacute;SICO</td>
                    <td class="etiqueta" style="width:23%;">BONIFICACI&Oacute;N O COMISIONES</td>
                    <td class="etiqueta" style="width:23%;">LIBRE EJERCICIO PROFESI&Oacute;N</td>
                    <td class="etiqueta" style="width:17%;">OTROS INGRESOS</td>
                    <td class="etiqueta" style="width:17%;">TOTAL INGRESOS</td>
                </tr>
                  <tr class="valores">
                    <td style="width:20%;">' . $_POST['ccsueldo'] . '</td>
                    <td style="width:23%;">' . $_POST['cccomision'] . '</td>
                    <td style="width:23%;">' . $_POST['cctp_ocupacion'] . '</td>
                    <td style="width:17%;">' . $_POST['ccotros_ingresos'] . '</td>
                    <td style="width:17%;">' . $_POST['cctotal_ingresos'] . '</td>
                </tr>
                
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="seccion">
          INGRESOS MENSUAL PROMEDIO DEL GRUPO FAMILIAR
        </td>
    </tr>
       <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:20%;">SUELDO B&Aacute;SICO</td>
                    <td class="etiqueta" style="width:23%;">BONIFICACI&Oacute;N O COMISIONES</td>
                    <td class="etiqueta" style="width:23%;">LIBRE EJERCICIO PROFESI&Oacute;N</td>
                    <td class="etiqueta" style="width:17%;">OTROS INGRESOS</td>
                    <td class="etiqueta" style="width:17%;">TOTAL INGRESOS</td>
                </tr>
                <tr class="valores">
                    <td style="width:20%;">' . $_POST['igf_sueldo'] . '</td>
                    <td style="width:23%;">' . $_POST['igf_comision'] . '</td>
                    <td style="width:23%;">' . $_POST['igf_libre_ejercicio'] . '</td>
                    <td style="width:17%;">' . $_POST['igf_otros_ingresos'] . '</td>
                    <td style="width:17%;">' . $_POST['igf_total_ingresos'] . '</td>
                </tr>
                
            </table>
        </td>
    </tr>
     <tr style="">
        <td class="seccion">
          GASTOS MENSUAL PROMEDIO DEL GRUPO FAMILIAR
        </td>
    </tr>
       <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:28%;">SERVICIOS B&Aacute;SICO <span style="font-size:8px;font-weight:0px;">(Luz,Condominio,&Aacute;seo)</span></td>
                    <td class="etiqueta" style="width:17%;">ALQUILER</td>
                    <td class="etiqueta" style="width:17%;">TELEFON&Iacute;A</td>
                    <td class="etiqueta" style="width:17%;">ALIMENTOS</td>
                    <td class="etiqueta" style="width:21%;">COLEGIOS O ESTUDIOS</td>
                </tr>
                 <tr class="valores">
                    <td style="width:28%;">' . $_POST['gpm_servicios'] . '</td>
                    <td style="width:17%;">' . $_POST['gpm_alquiler'] . '</td>
                    <td style="width:17%;">' . $_POST['gpm_telefono'] . '</td>
                    <td style="width:17%;">' . $_POST['gpm_alimentos'] . '</td>
                    <td style="width:21%;">' . $_POST['go_estudios'] . '</td>
                </tr>
               
               
              
                
            </table>
        </td>
    </tr>
    <tr>
     <td class="bloque">
            <table style="border-collapse: collapse;" >
               
                 <tr>
                    <td class="etiqueta" style="width:21%;">CR&Eacute;DITOS</td>
                    <td class="etiqueta" style="width:20%;">TARJETAS DE CR&Eacute;DITOS</td>
                    <td class="etiqueta" style="width:42%;" colspan="2">OTROS GASTOS</td>
                    <td class="etiqueta" style="width:17%;">TOTAL GASTOS</td>
                </tr>
                <tr class="valores">
                    <td style="width:21%;">' . $_POST['go_creditos'] . '</td>
                    <td style="width:10%;">' . $_POST['go_tarjetas'] . '</td>
                    <td style="width:25%;">' . $_POST['go_otros_ingresos'] . '</td>
                    <td style="width:17%;">' . $_POST['go_otros_eso'] . '</td>
                    <td style="width:17%;">' . $_POST['go_total_ingresos'] . '</td>
                </tr>
                
            </table>
        </td>
    </tr>
     <tr style="">
        <td class="seccion">
          ENTREVISTA AL CLIENTE
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta d_linea" style="width:22%;font-size:8px;">MONTO PROMEDIO MENSUAL DE<br>MOVIMIENTOS EN LA CUENTA</td>
                    <td class="etiqueta d_linea" style="width:28%;font-size:8px;">PROMEDIO DE TRANSACCIONES MENSUALES<br>EN LA CUENTA</td>
                    <td class="etiqueta d_linea" style="width:34%;font-size:8px;">MOTIVO POR LOS CUALES SOLICITA LOS SERVICIOS DE LA<br>ENTIDAD Y USO QUE DARA A LA CUENTA </td>
                    <td class="etiqueta" style="width:16%;font-size:8px;">ORIGEN DE FONDOS</td>
                    
                </tr>
                 <tr class="valores">
                    <td style="width:22%;"></td>
                    <td style="width:28%;"></td>
                    <td style="width:34%;"></td>
                    <td style="width:16%;"></td>
                </tr>
               
                
            </table>
        </td>
    </tr>
         <tr style="">
        <td class="etiqueta" style="font-size:8.5px;text-align:left;">
          POSEE USTED O LA EMPRESA PARA LA CUAL TRABAJA RELACI&Oacute;N PERSONAL O COMERCIAL CON ALG&Uacute;N EMPLEADO DE BANPLUS
         &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
         &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
         &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
         &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
         &nbsp;&nbsp;&nbsp;&nbsp;Si&nbsp;<input type="checkbox"  >&nbsp;
            &nbsp;&nbsp;No&nbsp;<input type="checkbox"  >&nbsp;
        </td>
        
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                 <tr class="valores">
                    <td style="width:16%;border-right:none;">Si es afirmativo, indique:</td>
                    <td style="width:48%;border-right:none;"><span style="font-size:8px;">Nombre y Apellido:</span></td>
                    <td style="width:36%;"><span style="font-size:8px;">Tipo de Relaci&oacute;n:</span></td>
                </tr>
            </table>
        </td>
    </tr>
    
    <tr style="">
         <td class="etiqueta" style="font-size:8.5px;text-align:left;">
          USTED EJERCI&Oacute; O EJERCE ACTUALMENTE ALG&Uacute;N CARGO PUBLICO COMO FUNCIONARIO DE GOBIERNO
           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
             &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;Si&nbsp;<input type="checkbox"  >&nbsp;
            &nbsp;&nbsp;No&nbsp;<input type="checkbox"  >&nbsp;
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                 <tr class="valores">
                    <td style="width:40%;border-right:none;">Si es afirmativo, indique si es dentro o fuera de Venezuela:</td>
                    <td style="width:60%;"></td>
                </tr>
            </table>
        </td>
    </tr>

     <tr style="">
       <td class="etiqueta" style="font-size:8.5px;text-align:left;">
          USTED O LA EMPRESA PARA LA CUAL LABORA O REPRESENTA MANTIENE O MANTUVO RELACI&Oacute;N CON ALG&Uacute;N FAMILIAR QUE EJERCE O EJERCI&Oacute; ALG&Uacute;N 
          <br>CARGO
          PUBLICO COMO FUNCIONARIO DE GOBIERNO.
               &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
             &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
             &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;Si&nbsp;<input type="checkbox"  >&nbsp;
            &nbsp;&nbsp;No&nbsp;<input type="checkbox"  >&nbsp;
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                 <tr class="valores">
                    <td style="width:40%;border-right:none;">Si es afirmativo, indique tipo de Relaci&oacute;n:</td>
                    <td style="width:60%;"></td>
                </tr>
            </table>
        </td>
    </tr>
    

    <tr style="">
        <td class="etiqueta" style="font-size:8.5px;text-align:left;">
          MANTIENE USTED RELACI&Oacute;N PERSONAL Y/O COMERCIAL CON ALG&Uacute;N CLIENTE DE LA ENTIDAD.  
           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
             &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
             &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;Si&nbsp;<input type="checkbox"  >&nbsp;
            &nbsp;&nbsp;No&nbsp;<input type="checkbox"  >&nbsp;
        </td>
    </tr>
   <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                 <tr class="valores">
                    <td style="width:25%;border-right:none;">Especifique Relaci&oacute;n:</td>
                    <td style="width:75%;"></td>
                </tr>
            </table>
        </td>
    </tr>
     <tr>
  <td class="bloque">
            <table style="border-collapse: collapse;" >
               
                 <tr>
                    <td class="etiqueta d_linea" style="width:22%;">DESEA REALIZAR OPERACIONES<BR>EN DIVISAS</td>
                    <td class="etiqueta" style="width:40%;">INDIQUE TIPO DE OPERACIONES</td>
                    <td class="etiqueta" style="width:38%;" colspan="2">EN CASO DE TRANSFERENCIA INDIQUE</td>
                </tr>
               <tr class="valores">
                    <td style="width:20%;font-size:12px;text-align:center;" rowspan="2">
                     Si&nbsp;<input type="checkbox"  >&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;<input type="checkbox"  >&nbsp;
                    </td>
                    <td style="width:40%;font-size:11px;" rowspan="2">
                     Venta de Divisas&nbsp;<input type="checkbox"  >&nbsp;
                     Compra de Divisas&nbsp;<input type="checkbox"  >&nbsp;
                     Transferencias&nbsp;<input type="checkbox"  >
                    </td>
                    <td  style="width:19%;font-size:8px;height:5px;text-align:center;" >PA&Iacute;S DE ORIGEN</td>
                    <td  style="width:19%;font-size:8px;height:5px;text-align:center;" >PA&Iacute;S DESTINO</td>
                                       
                </tr>
                <tr class="valores">
                    <td  style="width:19%;border-left:none;" ></td>
                    <td  style="width:19%;" ></td>
                </tr>
                
            </table>
        </td>
    </tr>
    <tr>
     <td class="bloque">
            <table style="border-collapse: collapse;" >
               <tr class="valores">
                    <td style="width:100%;font-weight:bold;">
                      Autorizo(amos) a Banplus, a realizar todas las investigaciones y verificaciones que considere pertinentes, a fin de conocer con toda precisi&oacute;n y exactitud los datos e informaci&oacute;n
suministrados por mi (nosotros) y principalmente la informaci&oacute;n referida a mis (nuestros) activos, pasivos y antecedentes crediticios, as&iacute; como cualquier otra que considere necesaria.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="seccion">
          DECLARACI&Oacute;N JURADA DE ORIGEN Y DESTINO DE FONDOS
        </td>
    </tr>
     <tr>
     <td class="bloque">
            <table style="border-collapse: collapse;" >
               <tr class="valores">
                    <td style="width:100%;">
                      Declaro bajo f&eacute; de juramento que los fondos utilizados para la apertura y movilizacion de la cuenta, se originan y utilizar&aacute;n en actividades l&iacute;citas, con estricto apego a la legislaci&oacute;n
                        venezolana vigente y a la Resoluci&oacute;n N&ordm; 119-10, de Fecha 09 de marzo de 2010, emanada de la Superintendencia de Bancos y Otras Instituciones Financieras
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
     <td class="bloque">
            <table style="border-collapse: collapse;" >
               <tr class="valores">
                    <td style="width:100%;">
                        Declaro que acepto y estoy conforme, a tenor de lo dispuesto en el art&iacute;culo 22 de la Resoluci&oacute;n No. 063.15 de fecha 12 de junio de 2015, emanada de la SUDEBAN, con el
                        contenido del Contrato &Uacute;nico de Cuentas de Ahorro, Corriente y Dep&oacute;sitos, inscrito ante el Registro P&uacute;blico del Segundo Circuito del Municipio Baruta del Estado Miranda, en fecha
                        31 de Marzo de 2014, bajo el No. 8, Folio 49 del Tomo 4 del Protocolo de Transcripci&oacute;n del a&ntilde;o 2014, autorizado por la SUDEBAN, mediante Oficio No. SIB-DSB-CJ-OD-03308, de fecha 3
                        de Febrero de 2014.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="seccion">
          CONSTANCIA DE NO POSEER REFERENCIAS BANCARIAS Y/O COMERCIALES
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                 <tr class="valores">
                    <td style="width:15%;border-right:none;">Declaro no poseer:</td>
                    <td style="width:85%;font-size:12px;">
                        Referencias Bancarias&nbsp;<input type="checkbox"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Referencias Comerciales&nbsp;<input type="checkbox"  >
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:24%;" >LUGAR</td>
                    <td class="etiqueta" style="width:30%;"  >FIRMA DEL SOLICITANTE</td>
                    <td class="etiqueta" style="width:46%;" colspan="2" >HUELLA DACTILAR DEL AUTORIZADO</td>
                </tr>
                <tr class="valores" style="">
                    <td style="width:24%;height:5px;border-bottom:none;"></td>
                    <td style="width:30%;height:5px;" rowspan="4"></td>
                    <td style="width:23%;font-size:8px;height:5px;text-align:center;" >PULGAR IZQUIERDO</td>
                    <td style="width:23%;font-size:8px;height:5px;text-align:center;" >PULGAR DERECHO</td>
                </tr> 
                <tr class="valores">
                <td style="width:23%;"></td>
                    <td style="width:23%;height:40px;" rowspan="3"></td>
                    <td style="width:23%;" rowspan="3" ></td>
                </tr> 
                <tr>
                    <td class="etiqueta" style="width:24%;" >FECHA</td>
                </tr>
              <tr class="valores" style="">
                    <td style="width:24%;height:24px;" ></td>
                </tr> 
                
            </table>
        </td>
    </tr>
    
</table> 
<br>
<table style=" border-collapse: collapse;">
     <tr style="">
        <td class="seccion">
          ESPACIO PARA SER ULTILIZADO POR LA ENTIDAD - RECAUDOS SOLICITADOS AL CLIENTE
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                 <tr class="valores">
                    <td style="width:32%;font-size:9px;">
                        <input type="checkbox"  > FOTOCOPIA(S) DE LA C&Eacute;DULA DE IDENTIDAD<br>
                        <input type="checkbox"  > REFERENCIA(S) BANCARIA(S)
                    </td>
                     <td style="width:44%;font-size:9px;">
                        <input type="checkbox"  > CERTIFICACI&Oacute;N DE INGRESOS Y/O CONSTANCIAS DE TRABAJO<br>
                        <input type="checkbox"  > REFERENCIA(S) COMERCIAL(ES)
                    </td>
                     <td style="width:24%;font-size:9px;">
                        <input type="checkbox"  > RECIBO DE SERVICIOS P&Uacute;BLICOS<br>
                        <input type="checkbox"  > REFERENCIA(S) PERSONAL(ES)
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="seccion">
          OBSERVACIONES
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                 <tr class="valores" style="">
                    <td style="width:100%;height:40px;" ></td>
                </tr> 
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:33.33%%;" >ELABORADO POR:</td>
                    <td class="etiqueta" style="width:66.66%;" colspan="2"  >VERIFICADO SEG&Uacute;N RESOLUCI&Oacute;N 119.10 DE LA SUDEBAN ART. 41 POR:</td>
                    
                </tr>
                <tr class="valores" style="">
                    <td style="width:33.33%;">
                    NOMBRE EJECUTIVO:<br><br><br><br>
                    FECHA:<br><br><br><br>
                    FIRMA:<br><br><br>
                    </td>
                    <td style="width:33.33%%; " >
                    NOMBRE GERENTE DE SERVICIO:<br><br><br><br>
                    FECHA:<br><br><br><br>
                    FIRMA:<br><br><br>
                    </td>
                    <td style="width:33.33%%;" >
                    NOMBRE GERENTE DE NEGOCIOS / ALIADO:<br><br><br><br>
                    FECHA:<br><br><br><br>
                    FIRMA:<br><br><br>
                    
                    </td>
                </tr> 
            </table>
        </td>
    </tr>
    
</table>
<br>
<span style="font-size:8px;font-weight: bold;">CyP / FFI-PN V.07/ VP.OPERACIONES/ OPERACIONES DE AGENCIAS / JUNIO 2016</span>

</page>

';

    if (!file_exists(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'])) {
        mkdir(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'], 0777, true);
    }


    $html2pdf->writeHTML($conte);
    $html2pdf->Output(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . '/' . $_POST['tp_documento'] . $_POST['n_documento'] . '_APERTURA.pdf', 'F');
    exit();
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}





