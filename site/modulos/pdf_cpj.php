<?php

//ob_start();
//$content = ob_get_clean();
// convert in PDF
include_once "../includes/html2pdf/vendor/autoload.php";
try {
    foreach ($_POST as $key => $post) {
        $_POST[$key] = htmlentities($post);
    }

    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(3, 4, 3, 3));
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
    .valores td{height: 12px;vertical-align: middle;padding: 2px;font-size: 10px;border-top: none;}
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
           FICHA DE IDENTIFICACI&Oacute;N DEL CLIENTE PERSONA JUR&Iacute;DICA
        </td>
    </tr>
    <tr>
        <td class="seccion">
            DATOS DE LA EMPRESA
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:70%;">NOMBRE DE LA EMPRESA</td>
                    <td class="etiqueta" style="width:30%;">N&ordm; DE R.I.F</td>
                </tr>
                <tr class="valores">
                    <td style="width:70%;">' . $_POST['n_empresa'] . '</td>
                    <td style="width:30%;">J-' . $_POST['rif'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
            <tr>
                    <td class="etiqueta" style="width:100%;" colspan="2">ACTIVIDAD ECON&Oacute;MICA</td>
                </tr>
                <tr class="valores">
                    <td style="width:50%;">' . $_POST['act_economica'] . '</td>
                    <td style="width:50%;">' . $_POST['act_otros'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
            <tr>
                    <td class="etiqueta" style="width:100%;" colspan="2">SECTOR ECON&Oacute;MICO</td>
                </tr>
                <tr class="valores">
                    <td style="width:100%;">' . $_POST['sect_economico'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:40%;" >VOLUMEN DE VENTA MENSUAL EN Bs.</td>
                    <td class="etiqueta" style="width:60%;" colspan="2">PROMEDIO MENSUAL DE MOVIMIENTO DE LA CUENTA</td>
                </tr>
                <tr class="valores">
                    <td style="width:40%;height:5px;text-align:center;" rowspan="2">' . $_POST['p_venta'] . '</td>
                    <td style="width:20%;font-size:8px;height:5px;text-align:center;">EFECTIVO</td>
                    <td style="width:20%;font-size:8px;height:5px;text-align:center;">CHEQUE</td>
                </tr>
                 <tr class="valores">
                    <td style="width:20%;border-left:none;">' . $_POST['p_efectivo'] . '</td>
                    <td style="width:20%;">' . $_POST['p_cheque'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="seccion">
            DIRECCI&Oacute;N DE LA EMPRESA
        </td>
    </tr>
      <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:26%;">EDIFICIO / QUINTA / TORRE</td>
                    <td class="etiqueta" style="width:8%;">PISO</td>
                    <td class="etiqueta" style="width:7%;">OFIC.</td>
                    <td class="etiqueta" style="width:8%;">LOCAL</td>
                    <td class="etiqueta" style="width:35%;">CALLE O AVENIDA</td>
                    <td class="etiqueta" style="width:16%;">URBANIZACI&Oacute;N</td>
                </tr>
                <tr class="valores">
                    <td  style="width:26%;">' . $_POST['d_ceq'] . '</td>
                    <td  style="width:8%;">' . $_POST['e_piso'] . '</td>
                    <td  style="width:7%;">' . $_POST['e_Oficina'] . '</td>
                    <td  style="width:8%;">' . $_POST['e_local'] . '</td>
                    <td  style="width:35%;">' . $_POST['p_efectivo'] . '</td>
                    <td  style="width:16%;">' . $_POST['e_calle'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                <td class="etiqueta" style="width:18%;">MUNICIPIO</td>
                    <td class="etiqueta" style="width:18%;">CUIDAD</td>
                    <td class="etiqueta" style="width:18%;">ESTADO</td>
                    <td class="etiqueta" style="width:14%;">C&Oacute;DIGO POSTAL.</td>
                    <td class="etiqueta" style="width:32%;" colspan="2" >N&ordm; TEL&Eacute;FONOS</td>
                   
                </tr>
                <tr class="valores">
                    <td  style="width:18%;height:5px;text-align:center;" rowspan="2">' . $_POST['etp_municipio'] . '</td>
                    <td  style="width:18%;height:5px;text-align:center;"  rowspan="2">' . $_POST['etp_ciudad'] . '</td>
                    <td  style="width:18%;height:5px;text-align:center;"  rowspan="2">' . $_POST['etp_estado'] . '</td>
                    <td  style="width:14%;height:5px;text-align:center;"  rowspan="2">' . $_POST['e_postal'] . '</td>
                    <td  style="width:16%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                    <td  style="width:16%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                </tr>
                 <tr class="valores">
                    <td  style="width:16%;border-left:none;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['edctp_telefono'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['ecd_telefono'] . '</td>
                    <td  style="width:16%;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['edctp_telefono2'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['ecd_telefono2'] . '</td>
                </tr>
                             
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:20%;">N&ordm; DE FAX</td>
                    <td class="etiqueta" style="width:55%;">CORREO ELECTR&Oacute;NICO</td>
                    <td class="etiqueta" style="width:25%;">TIPO DE LOCAL</td>
                </tr>
                <tr class="valores">
                    <td  style="width:20%;height:5px;text-align:center;font-size:8px;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                    <td  style="width:55%;height:5px;text-align:center;" rowspan="2">' . $_POST['email'] . '</td>
                      <td style="width:25%;font-size:12px;vertical-align: middle; "  rowspan="2">';

    if ($_POST['tp_inmueble'] == "PROPIO")
        $conte .= '&nbsp;<input type="checkbox"  checked="checked">PROPIO ';
    else
        $conte .= '&nbsp;<input type="checkbox"  >PROPIO ';

    if ($_POST['tp_inmueble'] == "ALQUILADO")
        $conte .= '&nbsp;<input type="checkbox" checked="checked" >ALQUILADO<br>';
    else
        $conte .= '&nbsp;<input type="checkbox"  >ALQUILADO<br>';



    $conte .= '
                    </td>
                   
                </tr>
                 <tr class="valores">
                    <td  style="width:20%;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['edctp_fax'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['ecd_fax'] . '</td>
                </tr>
                             
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:40%;">NOMBRE DEL ARRENDADOR</td>
                    <td class="etiqueta" style="width:20%;">CANNON DE ARRENDAMIENTO</td>
                    <td class="etiqueta" style="width:20%;">N&ordm; DE TEL&Eacute;FONO</td>
                    <td class="etiqueta" style="width:20%;">OTRO N&ordm; DE TELEFONO</td>
                </tr>
                <tr class="valores">
                    <td  style="width:40%;height:5px;text-align:center;" rowspan="2">' . $_POST['canon_nombre'] . '</td>
                    <td  style="width:20%;height:5px;text-align:center;" rowspan="2">' . $_POST['canon'] . '</td>
                    <td  style="width:20%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                    <td  style="width:20%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                </tr>
                 <tr class="valores">
                    <td  style="width:20%;border-left:none;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['cannon_telefono'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['cad_telefono'] . '</td>
                    <td  style="width:20%;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['cannon_telefono2'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['cad_telefono2'] . '</td>
                </tr>
                             
            </table>
        </td>
    </tr>
    <tr>
        <td class="seccion">
            EMPRESAS RELACIONADAS
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                   
                    <td class="etiqueta" style="width:40%;">NOMBRE</td>
                    <td class="etiqueta" style="width:20%;">N&ordm; DE R.I.F</td>
                    <td class="etiqueta" style="width:40%;" colspan="2">N&ordm; DE TEL&Eacute;FONOS</td>
                    
                </tr>
                <tr class="valores">
                    <td  style="width:40%;height:5px;text-align:center;" rowspan="2">' . $_POST['rele_nombre0'] . '</td>
                    <td  style="width:20%;height:5px;text-align:center;" rowspan="2">J-' . $_POST['rele_rif0'] . '</td>
                    <td  style="width:20%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                    <td  style="width:20%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                </tr>
                 <tr class="valores">
                    <td  style="width:20%;border-left:none;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['rele_telefono0'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['erele_telefono0'] . '</td>
                    <td  style="width:20%;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['rele_telefono20'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['2rele_telefono20'] . '</td>
                </tr>
                
                 <tr class="valores">
                  <td  style="width:40%;" >' . $_POST['rele_nombre1'] . '</td>
                    <td  style="width:20%;" >J-' . $_POST['rele_rif1'] . '</td>
                    <td  style="width:20%;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['rele_telefono1'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['erele_telefono1'] . '</td>
                    <td  style="width:20%;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['rele_telefono21'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['2rele_telefono21'] . '</td>
                </tr>
                <tr class="valores">
                  <td  style="width:40%;" >' . $_POST['rele_nombre2'] . '</td>
                    <td  style="width:20%;" >J-' . $_POST['rele_rif2'] . '</td>
                    <td  style="width:20%;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['rele_telefono2'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['erele_telefono2'] . '</td>
                    <td  style="width:20%;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['rele_telefono22'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['2rele_telefono22'] . '</td>
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
            DATOS DE REGISTRO DE LA EMPRESA
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:60%;">OFICINA DE REGISTRO</td>
                    <td class="etiqueta" style="width:40%;">N&ordm; DE REGISTRO - TOMO - FECHA</td>
                </tr>
                <tr class="valores">
                    <td style="width:60%;">' . $_POST['ofic_registro'] . '</td>
                    <td style="width:40%;">' . $_POST['tomo_registro'] . ' - ' . $_POST['tomo_tomo'] . ' - ' . $_POST['tomo_fecha'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:18%;">CUIDAD</td>
                    <td class="etiqueta" style="width:18%;">ESTADO</td>
                    <td class="etiqueta" style="width:20%;">DURACI&Oacute;N DE LA EMPRESA</td>
                    <td class="etiqueta" style="width:14%;">N&ordm; DE EMPLEADOS</td>
                    <td class="etiqueta" style="width:30%;">REPRESENTANTE LEGAL</td>
                </tr>
                 <tr class="valores">
                    <td  style="width:18%;">' . $_POST['regis_ciudad'] . '</td>
                    <td  style="width:18%;">' . $_POST['regis_estado'] . '</td>
                    <td  style="width:20%;">' . $_POST['duracion_empresa'] . ' ' . $_POST['duracion_empresa_op'] . '</td>
                    <td  style="width:14%;">' . $_POST['empleados'] . '</td>
                    <td  style="width:30%;">' . $_POST['repr_legal'] . '</td>
                </tr>
               
                             
            </table>
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
              <tr>
                    <td class="etiqueta" style="width:20%;">FECHA DE CIERRE FISCAL</td>
                    <td class="etiqueta" style="width:28%;">CAPITAL SUSCRITO</td>
                    <td class="etiqueta" style="width:26%;">CAPITAL PAGADO</td>
                    <td class="etiqueta" style="width:26%;">RESERVAS DE CAPITAL</td>
                </tr>
                 <tr class="valores">
                    <td  style="width:20%;">' . $_POST['cierre_fiscal'] . '</td>
                    <td  style="width:28%;">' . $_POST['capt_suscrito'] . '</td>
                    <td  style="width:26%;">' . $_POST['capt_pagado'] . '</td>
                    <td  style="width:26%;">' . $_POST['capt_reservas'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
     <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:40%;">DOMICILIO FISCAL</td>
                    <td class="etiqueta" style="width:60%;">OBJETO SOCIAL</td>
                 
                </tr>
                <tr class="valores">
                    <td style="width:40%;">' . $_POST['domicilio_fisca'] . '</td>
                    <td style="width:60%;">' . $_POST['objeto_fiscal'] . '</td>
                </tr>
            </table>
        </td>
    </tr>
     <tr style="">
        <td class="seccion">
            DATOS DEL REGISTRO &Uacute;LTIMA MODIFICACI&Oacute;N
        </td>
    </tr>
    <tr>
       <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:20%;">FECHA</td>
                    <td class="etiqueta" style="width:60%;">N&ordm; REGISTRO - TOMO</td>
                    <td class="etiqueta" style="width:20%;">LUGAR</td>
                </tr>
                <tr class="valores">
                    <td style="width:20%;">' . $_POST['ult_fecha'] . '</td>
                    <td style="width:60%;">' . $_POST['ult_registro'] . ' - ' . $_POST['ult_tomo'] . '</td>
                    <td style="width:20%;">' . $_POST['ult_lugar'] . '</td>
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
           ACCIONISTAS ACTUALES
        </td>
    </tr>
    
    <tr>
       <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:26%;">NOMBRE / RAZ&Oacute;N SOCIAL</td>
                    <td class="etiqueta" style="width:20%;">C.I / R.I.F</td>
                    <td class="etiqueta" style="width:23%;">CAPITAL SUSCRITO</td>
                    <td class="etiqueta" style="width:8%;">%</td>
                    <td class="etiqueta" style="width:23%;">CAPITAL PAGADO</td>
                </tr>
                <tr class="valores">
                    <td  style="width:26%;">' . $_POST['act_nombre0'] . '</td>
                    <td  style="width:20%;">' . $_POST['actp_documento0'] . '' . $_POST['actp_ndocumento0'] . '</td>
                    <td  style="width:23%;">' . $_POST['ac_capital0'] . '</td>
                    <td  style="width:8%;">' . $_POST['ac_porcentaje0'] . '</td>
                    <td  style="width:23%;">' . $_POST['act_pagado0'] . '</td>
                </tr>
                  <tr class="valores">
                 <td  style="width:26%;">' . $_POST['act_nombre1'] . '</td>
                    <td  style="width:20%;">' . $_POST['actp_documento1'] . '' . $_POST['actp_ndocumento1'] . '</td>
                    <td  style="width:23%;">' . $_POST['ac_capital1'] . '</td>
                    <td  style="width:8%;">' . $_POST['ac_porcentaje1'] . '</td>
                    <td  style="width:23%;">' . $_POST['act_pagado1'] . '</td>
                </tr>
                  <tr class="valores">
                     <td  style="width:26%;">' . $_POST['act_nombre2'] . '</td>
                    <td  style="width:20%;">' . $_POST['actp_documento2'] . '' . $_POST['actp_ndocumento2'] . '</td>
                    <td  style="width:23%;">' . $_POST['ac_capital2'] . '</td>
                    <td  style="width:8%;">' . $_POST['ac_porcentaje2'] . '</td>
                    <td  style="width:23%;">' . $_POST['act_pagado2'] . '</td>
                </tr>
                  <tr class="valores">
                     <td  style="width:26%;">' . $_POST['act_nombre3'] . '</td>
                    <td  style="width:20%;">' . $_POST['actp_documento3'] . '' . $_POST['actp_ndocumento3'] . '</td>
                    <td  style="width:23%;">' . $_POST['ac_capital3'] . '</td>
                    <td  style="width:8%;">' . $_POST['ac_porcentaje3'] . '</td>
                    <td  style="width:23%;">' . $_POST['act_pagado3'] . '</td>
                </tr>
                  <tr class="valores">
                    <td  style="width:26%;">' . $_POST['act_nombre4'] . '</td>
                    <td  style="width:20%;">' . $_POST['actp_documento4'] . '' . $_POST['actp_ndocumento4'] . '</td>
                    <td  style="width:23%;">' . $_POST['ac_capital4'] . '</td>
                    <td  style="width:8%;">' . $_POST['ac_porcentaje4'] . '</td>
                    <td  style="width:23%;">' . $_POST['act_pagado4'] . '</td>
                </tr>
                  <tr class="valores">
                    <td  style="width:46%;text-align:right;font-weight:bold;" colspan="2"> TOTAL</td>                   
                    <td  style="width:23%;">' . $_POST['act_total_sus'] . '</td>
                    <td  style="width:8%;">' . $_POST['act_total_percent'] . '</td>
                    <td  style="width:23%;">' . $_POST['act_total_pagado'] . '</td>
                </tr>
               
            </table>
        </td>
    </tr>
     <tr style="">
        <td class="seccion">
          FIRMAS AUTORIZADAS A MANTENER RELACI&Oacute;N CON LA ENTIDAD
        </td>
    </tr>
    <tr>
       <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:35%;">APELLIDOS</td>
                    <td class="etiqueta" style="width:35%;">NOMBRES</td>
                    <td class="etiqueta" style="width:30%;">C.I / PASAPORTE</td>
                </tr>
                 <tr class="valores">
                     <td style="width:35%;">' . $_POST['p_apellido0'] . ' ' . $_POST['s_apellido0'] . '</td>
                     <td style="width:35%;">' . $_POST['p_nombre0'] . ' ' . $_POST['s_nombre0'] . '</td>
                    <td style="width:30%;font-size:12px;">';

    if ($_POST['tp_documento0'] == "C")
        $conte .= 'V&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= ' V&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento0'] == "E")
        $conte .= 'E&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'E&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento0'] == "P")
        $conte .= 'P&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'P&nbsp;<input type="checkbox"  >';

    $conte .='   ' . $_POST['n_documento0'] . '         
                    </td>
                </tr>
                 <tr class="valores">
                                     <td style="width:35%;">' . $_POST['p_apellido1'] . ' ' . $_POST['s_apellido1'] . '</td>
                     <td style="width:35%;">' . $_POST['p_nombre1'] . ' ' . $_POST['s_nombre1'] . '</td>
                    <td style="width:30%;font-size:12px;">';

    if ($_POST['tp_documento1'] == "C")
        $conte .= 'V&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= ' V&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento1'] == "E")
        $conte .= 'E&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'E&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento1'] == "P")
        $conte .= 'P&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'P&nbsp;<input type="checkbox"  >';

    $conte .='   ' . $_POST['n_documento1'] . '         
                    </td>
                </tr>
                 <tr class="valores">
                     <td style="width:35%;">' . $_POST['p_apellido2'] . ' ' . $_POST['s_apellido2'] . '</td>
                     <td style="width:35%;">' . $_POST['p_nombre2'] . ' ' . $_POST['s_nombre2'] . '</td>
                    <td style="width:30%;font-size:12px;">';

    if ($_POST['tp_documento2'] == "C")
        $conte .= 'V&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= ' V&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento2'] == "E")
        $conte .= 'E&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'E&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento2'] == "P")
        $conte .= 'P&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'P&nbsp;<input type="checkbox"  >';

    $conte .='   ' . $_POST['n_documento2'] . '   
</td>                
</tr>
                 <tr class="valores">
                     <td style="width:35%;">' . $_POST['p_apellido3'] . ' ' . $_POST['s_apellido3'] . '</td>
                     <td style="width:35%;">' . $_POST['p_nombre3'] . ' ' . $_POST['s_nombre3'] . '</td>
                    <td style="width:30%;font-size:12px;">';

    if ($_POST['tp_documento3'] == "C")
        $conte .= 'V&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= ' V&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento3'] == "E")
        $conte .= 'E&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'E&nbsp;<input type="checkbox"  >';

    if ($_POST['tp_documento3'] == "P")
        $conte .= 'P&nbsp;<input type="checkbox" checked="checked" >';
    else
        $conte .= 'P&nbsp;<input type="checkbox"  >';

    $conte .='   ' . $_POST['n_documento3'] . ' </td>
                </tr>
                
            </table>
        </td>
    </tr>
     <tr>
       <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:17%;">NACIONALIDAD</td>
                    <td class="etiqueta" style="width:20%;">PROFESI&Oacute;N U OFICIO</td>
                    <td class="etiqueta" style="width:17%;">OCUPACI&Oacute;N</td>
                    <td class="etiqueta" style="width:30%;" colspan="2">N&ordm; DE TEL&Eacute;FONOS</td>
                    <td class="etiqueta" style="width:16%;">N&ordm; DE TCELULAR</td>
                </tr>
                 
                 <tr class="valores">
                    <td  style="width:17%;" rowspan="2">' . $_POST['tp_nacionalidad0'] . ' </td>
                    <td  style="width:20%;" rowspan="2">' . $_POST['tp_profecion0'] . ' </td>
                    <td  style="width:17%;" rowspan="2">' . $_POST['tp_ocupacion0'] . ' </td>
                    <td  style="width:15%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                    <td  style="width:15%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                    <td  style="width:16%;font-size:8px;height:5px;text-align:center;border-bottom:none;" >COD. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N&Uacute;MERO </td>
                </tr>
                 <tr class="valores">
                    <td  style="width:15%;border-left:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefonoH0'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefonoh0'] . '</td>
                    <td  style="width:15%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefono20'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefono20'] . '</td>
                    <td  style="width:16%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_celular0'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_celular0'] . '</td>
                </tr>
                <tr class="valores">
                    <td  style="width:17%;">' . $_POST['tp_nacionalidad1'] . ' </td>
                    <td  style="width:20%;">' . $_POST['tp_profecion1'] . ' </td>
                    <td  style="width:17%;">' . $_POST['tp_ocupacion1'] . ' </td>
                    <td  style="width:15%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefonoH1'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefonoh1'] . '</td>
                    <td  style="width:15%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefono21'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefono21'] . '</td>
                    <td  style="width:16%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_celular1'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_celular1'] . '</td>
                </tr>
                <tr class="valores">
                    <td  style="width:17%;">' . $_POST['tp_nacionalidad2'] . ' </td>
                    <td  style="width:20%;">' . $_POST['tp_profecion2'] . ' </td>
                    <td  style="width:17%;">' . $_POST['tp_ocupacion2'] . ' </td>
                    <td  style="width:15%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefonoH2'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefonoh2'] . '</td>
                    <td  style="width:15%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefono22'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefono22'] . '</td>
                    <td  style="width:16%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_celular2'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_celular2'] . '</td>
                </tr>
                <tr class="valores">
                     <td  style="width:17%;">' . $_POST['tp_nacionalidad3'] . ' </td>
                    <td  style="width:20%;">' . $_POST['tp_profecion3'] . ' </td>
                    <td  style="width:17%;">' . $_POST['tp_ocupacion3'] . ' </td>
                    <td  style="width:15%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefonoH3'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefonoh3'] . '</td>
                    <td  style="width:15%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_telefono23'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_telefono23'] . '</td>
                    <td  style="width:16%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['dtp_celular3'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_POST['d_celular3'] . '</td>
                </tr>
                
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="seccion">
            ENTREVISTA AL CLIENTE
        </td>
    </tr>
    
      <tr style="">
        <td class="etiqueta" style="font-size:8.5px;text-align:left;">
          MOTIVO POR LOS CUALES SOLICITA LOS SERVICIOS DE LA INSTITUCION Y USO QUE DAR&Aacute; A LA CUENTA
        </td>
     </tr>
      <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                 <tr class="valores">
                    <td style="width:100%;"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="etiqueta" style="font-size:8.5px;text-align:left;">
          &iquest;SU EMPRESA MANTIENE RELACIONES DE CONTRATOS CON EL ESTADO VENEZOLANO?
            Si&nbsp;<input type="checkbox"  >&nbsp;
            &nbsp;&nbsp;No&nbsp;<input type="checkbox"  >&nbsp;
        </td>
     </tr>
<tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                 <tr class="valores">
                    <td style="width:35%;border-right:none;">Si es afirmativo, indique el Organismo:</td>
                    <td style="width:65%;"></td>
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
                    <td  style="width:19%;" ></td>
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
                         Autorizo(amos) a Banplus, a realizar todas las investigaciones y verificaciones que considere 
                         pertinentes, a fin de conocer con toda precisi&oacute;n y exactitud los datos e informaci&oacute;n suministrados por mi(nosotros) y
                         principalmente la informaci&oacute;n referida amis (nuestros) activos, pasivos y antecedentes crediticios, as&iacute; como
                          cualquier otra que considere necesaria.     
                </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="">
        <td class="seccion">
          DECLARACI&Oacute;N JURADA
        </td>
    </tr>
     <tr>
     <td class="bloque">
            <table style="border-collapse: collapse;" >
               <tr class="valores">
                    <td style="width:100%;">
                    Declaro(amos) bajo fe de juramento que lo fondos utilizados para la apertura y movilizaci&oacute;n de la cuenta corriente, 
                    se originan y utilizar&aacute;n en actividades l&iacute;citas; adoptando, desarrollando y ejecutando programas, normas y controles 
                    para mitigar los riesgos por el uso de los servicios y productos de mi (nuestra) representada, como instrumentos de 
                    legitimaci&oacute;n decapitales y/o financiamiento al terrorismo, con estricto apego a la legislaci&oacute;n venezolana vigente y 
                    a la Resoluci&oacute;n 119-10, defecha 09 de marzo de 2010, emanadade la Superintendencia de Bancos y Otras Instituciones Financieras.
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
                    <td class="etiqueta" style="width:25%;" >LUGAR</td>
                    <td class="etiqueta" style="width:15%;"  >FECHA</td>
                    <td class="etiqueta" style="width:60%;" colspan="3" >FIRMA DEL(LOS) SOLICITANTE(S)</td>
                </tr>
                <tr class="valores" style="">
                    <td style="width:25%;" rowspan="2"></td>
                    <td style="width:15%;" rowspan="2"></td>
                    <td style="width:20%;font-size:8px;height:5px;text-align:center;" >FIRMA 1</td>
                    <td style="width:20%;font-size:8px;height:5px;text-align:center;" >FIRMA 2</td>
                    <td style="width:20%;font-size:8px;height:5px;text-align:center;" >FIRMA 3</td>
                </tr> 
                 <tr class="valores" style="">
                    <td style="width:20%;" ></td>
                    <td style="width:20%;" ></td>
                    <td style="width:20%;" ></td>
                </tr> 
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                      <td class="etiqueta d_linea" style="width:33.33%;" colspan="2">HUELLA DACTILAR PRIMER AUTORIZADO<BR>PULGARES IZQUIERDO - DERECHO</td>
                      <td class="etiqueta d_linea" style="width:33.33%;" colspan="2">HUELLA DACTILAR SEGUNDO AUTORIZADO<BR>PULGARES IZQUIERDO - DERECHO</td>
                      <td class="etiqueta d_linea" style="width:33.33%;" colspan="2">HUELLA DACTILAR TERCER AUTORIZADO<BR>PULGARES IZQUIERDO - DERECHO</td>
                </tr>
                <tr class="valores" style="">
                    <td style="width:16.66%;height:40px;"></td>
                    <td style="width:16.66%;"></td>
                    <td style="width:16.66%;"></td>
                    <td style="width:16.66%;"></td>
                    <td style="width:16.66%;"></td>
                    <td style="width:16.66%;"></td>
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
     <tr style="">
        <td class="seccion">
          DECLARACI&Oacute;N DE I.S.L.R
        </td>
    </tr>
      <tr style="">
        <td class="etiqueta" style="font-size:8.5px;text-align:left;">
          &iquest;LA EMPRESA A LA CUAL REPRESENTA DECLARA IMPUESTOS SOBRE LA RENTA?
        </td>
     </tr>
      <tr style="">
      <td class="bloque">
            <table style="border-collapse: collapse;" >
               <tr class="valores">
                    <td style="width:100%;font-weight:bold;tex-aling:left;">
                      Declaro(amos) que mi (nuestra) representada no presenta declaracion del Impuesto Sobre la Renta (I.S.L.R), requerida por la Superintendencia de las Intituciones del Sector
                      Bancario, por el motivo siguiente: <b>Otras Razones (EXPLIQUE):</b>
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
                    <td style="width:100%;height:20px;" ></td>
                </tr> 
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr class="valores" style="">
                    <td style="width:33.33%;">
                    NOMBRE EJECUTIVO:<br><br>
                    FECHA:<br><br>
                    FIRMA:<br>
                    </td>
                    <td style="width:33.33%; " >
                    NOMBRE GERENTE DE SERVICIO:<br><br>
                    FECHA:<br><br>
                    FIRMA:<br>
                    </td>
                    <td style="width:33.33%;" >
                    NOMBRE GERENTE DE NEGOCIOS / ALIADO:<br><br>
                    FECHA:<br><br>
                    FIRMA:<br>
                    
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



    if (!file_exists(dirname(__FILE__) . '/tmp_apertura/'. date('Ymd') . '/APERTUNA_J/'.'J_' . $_POST['rif'])) {
        mkdir(dirname(__FILE__) .  '/tmp_apertura/'. date('Ymd') . '/APERTUNA_J/'.'J_' . $_POST['rif'], 0777, true);
    }



    $html2pdf->writeHTML($conte);
    $html2pdf->Output(dirname(__FILE__) . '/tmp_apertura/'. date('Ymd') . '/APERTUNA_J/'.'J_' . $_POST['rif'] . '/J_' . $_POST['rif'] . '_APERTURAPJ.pdf', 'F');
    exit();
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}





