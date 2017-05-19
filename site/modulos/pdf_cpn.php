<?php

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
    .etiqueta{ border-top: none;text-align: center;background: rgb(193,193,193);font-weight: bold;font-size: 10px;}
    .titulo{text-align: center;font-size: 12px;border:none;font-weight: bold;}
    .d_linea{font-size: 9px;}
    .b_left{border-left: none;}
    .b_right{border-right: none;}
    .valores td{height: 13px;vertical-align: bottom;padding: 2px;font-size: 10px;border-top: none;}
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
                    <td  style="width:20%;border:none;">AGENCIA:</td>
                    <td  style="width:20%;border:none;">FECHA: </td>
                </tr>
               <tr>
                    <td  style="width:40%;border:none;" colspan="2">N&ordm; DE CUENTA</td>
                    
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
                    <td class="etiqueta" style="width:34%;">LUGAR Y FECHA DE NACIMIENTO</td>
                </tr>
                <tr class="valores">
                    <td style="width:33%;">APELLIDOS</td>
                    <td style="width:33%;">NOMBRES</td>
                    <td style="width:34%;">LUGAR Y FECHA DE NACIMIENTO</td>
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
                    <td style="width:28%;font-size:12px;">
                        V&nbsp;<input type="checkbox"  >
                        E&nbsp;<input type="checkbox"  >
                        P&nbsp;<input type="checkbox"  >
                    </td>
                    <td style="width:25%;">NATURALIZADO</td>
                    <td style="width:15%;">NACIONALIDAD</td>
                    <td style="width:10%;font-size:12px;">
                        &nbsp;<input type="checkbox"  > M
                        &nbsp;<input type="checkbox"  > F
                    </td>
                    <td style="width:14%;">ESTADO CIVIL</td>
                    <td style="width:8%;">EDAD</td>
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
                    <td style="width:23%;">PASAPORTE</td>
                    <td style="width:20%;">NATURALIZADO</td>
                    <td style="width:15%;">NACIONALIDAD</td>
                    <td style="width:14%;">ESTADO CIVIL</td>
                    <td style="width:28%;">EDAD</td>
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
                    <td style="width:26%;"></td>
                    <td style="width:8%;"></td>
                    <td style="width:8%;"></td>
                    <td style="width:38%;"> CIVIL</td>
                    <td style="width:20%;"></td>
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
                    <td class="etiqueta" style="width:20%;">OTRO N&ordm; DE TEL&Eacute;FONO</td>
                    <td class="etiqueta" style="width:12%;">CELULAR</td>
                </tr>
                <tr class="valores">
                    <td  style="width:20%;">CUIDAD O LOCALIDA</td>
                    <td  style="width:16%;">ESTADO</td>
                    <td  style="width:15%;">C&Oacute;DIGO POSTAL.</td>
                    <td  style="width:17%;">N&ordm; TEL&Eacute;FONO HAB.</td>
                    <td  style="width:20%;">OTRO N&ordm; DE TEL&Eacute;FONO</td>
                    <td  style="width:12%;">CELULAR</td>
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
                    <td  style="width:23%;font-size:11.8px;">
                        <input type="checkbox"  >PROPIA 
                        <input type="checkbox"  >ARRENDADA<br>
                        <input type="checkbox"  >OTROS
                    </td>
                    <td class="" style="width:10%;"></td>
                    <td class="" style="width:20%;"></td>
                    <td style="width:25%;"></td>
                    <td style="width:22%;"></td>
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
                    <td  style="width:33%;">NOMBRE DE LA EMPRESA</td>
                    <td  style="width:20%;">ACTIVIDAD O RAMO</td>
                    <td  style="width:16%;">CARGO</td>
                    <td  style="width:19%;">RELACI&Oacute;N LABORAL</td>
                    <td  style="width:12%;">ANTIG&Uuml;EDAD</td>
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
                    <td style="width:20%;">SUELDO B&Aacute;SICO</td>
                    <td style="width:23%;">BONIFICACI&Oacute;N O COMISIONES</td>
                    <td style="width:23%;">LIBRE EJERCICIO PROFESI&Oacute;N</td>
                    <td style="width:17%;">OTROS INGRESOS</td>
                    <td style="width:17%;">TOTAL INGRESOS</td>
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
                   <td  style="width:26%;">EDIFICIO / QUINTA</td>
                    <td  style="width:8%;">PISO</td>
                    <td  style="width:7%;">OFIC.</td>
                    <td  style="width:8%;">LOCAL</td>
                    <td  style="width:35%;">CALLE O AVENIDA</td>
                    <td  style="width:16%;">URBANIZACI&Oacute;N</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="bloque">
            <table style="border-collapse: collapse;" >
                <tr>
                    <td class="etiqueta" style="width:25%;">CUIDAD O LOCALIDA</td>
                    <td class="etiqueta" style="width:24%;">ESTADO</td>
                    <td class="etiqueta" style="width:15%;">C&Oacute;DIGO POSTAL.</td>
                    <td class="etiqueta" style="width:36%;" colspan="2">N&ordm; TEL&Eacute;FONOS</td>
                   
                </tr>
                <tr class="valores">
                    <td  style="width:25%;">CUIDAD O LOCALIDA</td>
                    <td  style="width:24%;">ESTADO</td>
                    <td  style="width:15%;">C&Oacute;DIGO POSTAL.</td>
                    <td  style="width:18%;"></td>
                    <td  style="width:18%;"></td>
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
                <tr class="valores">
                    <td style="width:20%;">TIPO DE PRODUCTO</td>
                    <td style="width:30%;">N&Uacute;MERO</td>
                    <td style="width:20%;">TIPO DE PRODUCTO</td>
                    <td style="width:30%;">N&Uacute;MERO</td>
                </tr>      
                  <tr class="valores">
                    <td style="width:20%;">TIPO DE PRODUCTO</td>
                    <td style="width:30%;">N&Uacute;MERO</td>
                    <td style="width:20%;">TIPO DE PRODUCTO</td>
                    <td style="width:30%;">N&Uacute;MERO</td>
                </tr>      
                  <tr class="valores">
                    <td style="width:20%;">TIPO DE PRODUCTO</td>
                    <td style="width:30%;">N&Uacute;MERO</td>
                    <td style="width:20%;">TIPO DE PRODUCTO</td>
                    <td style="width:30%;">N&Uacute;MERO</td>
                </tr>      
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
                <tr class="valores">
                    <td  style="width:20%;">BANCO</td>
                    <td  style="width:25%;">N&ordm; DE CUENTA O TDC</td>
                    <td  style="width:25%;">TIPO DE CUENTA O TARJETA</td>
                    <td  style="width:15%;">MIENBRO DESDE</td>
                    <td  style="width:15%;">AGENCIA ORIGEN</td>
                </tr>   
                 <tr class="valores">
                    <td  style="width:20%;">BANCO</td>
                    <td  style="width:25%;">N&ordm; DE CUENTA O TDC</td>
                    <td  style="width:25%;">TIPO DE CUENTA O TARJETA</td>
                    <td  style="width:15%;">MIENBRO DESDE</td>
                    <td  style="width:15%;">AGENCIA ORIGEN</td>
                </tr>   
                 <tr class="valores">
                    <td  style="width:20%;">BANCO</td>
                    <td  style="width:25%;">N&ordm; DE CUENTA O TDC</td>
                    <td  style="width:25%;">TIPO DE CUENTA O TARJETA</td>
                    <td  style="width:15%;">MIENBRO DESDE</td>
                    <td  style="width:15%;">AGENCIA ORIGEN</td>
                </tr>   
                   
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
               <tr class="valores">
                    <td  style="width:25%;">BANCO</td>
                    <td  style="width:35%;">N&ordm; DE CUENTA O TDC</td>
                    <td  style="width:20%;"></td>
                    <td  style="width:20%;">MIENBRO DESDE</td>
                </tr>   
                <tr class="valores">
                    <td  style="width:25%;">BANCO</td>
                    <td  style="width:35%;">N&ordm; DE CUENTA O TDC</td>
                    <td  style="width:20%;"></td>
                    <td  style="width:20%;">MIENBRO DESDE</td>
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
                <tr class="valores">
                    <td  style="width:20%;">NOMBRE Y APELLIDO</td>
                    <td  style="width:20%;">OCUPACI&Oacute;N</td>
                    <td  style="width:40%;">DIRECCI&Oacute;N</td>
                    <td  style="width:20%;">N&ordm; DE TEL&Eacute;FONO</td>
                </tr>
                <tr class="valores">
                    <td  style="width:20%;">NOMBRE Y APELLIDO</td>
                    <td  style="width:20%;">OCUPACI&Oacute;N</td>
                    <td  style="width:40%;">DIRECCI&Oacute;N</td>
                    <td  style="width:20%;">N&ordm; DE TEL&Eacute;FONO</td>
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
                    <td class="etiqueta" style="width:34%;">LUGAR Y FECHA DE NACIMIENTO</td>
                </tr>
                <tr class="valores">
                    <td style="width:33%;">APELLIDOS</td>
                    <td style="width:33%;">NOMBRES</td>
                    <td style="width:34%;">LUGAR Y FECHA DE NACIMIENTO</td>
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
                    <td style="width:30%;font-size:12px;">
                        V&nbsp;<input type="checkbox"  value="">
                        E&nbsp;<input type="checkbox"  value="">
                        P&nbsp;<input type="checkbox"  value="">
                    </td>
                    <td style="width:26%;">NATURALIZADO</td>
                    <td style="width:18%;">NACIONALIDAD</td>
                    <td style="width:16%;">ESTADO CIVIL</td>
                    <td style="width:10%;">EDAD</td>
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
                    <td style="width:25%;">NATURALIZADO</td>
                    <td style="width:23%;">NACIONALIDAD</td>
                    <td style="width:18%;">ESTADO CIVIL</td>
                    <td style="width:34%;">EDAD</td>
                </tr>
            </table>
        </td>
    </tr>
</table>        
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
                    <td style="width:20%;">SUELDO B&Aacute;SICO</td>
                    <td style="width:23%;">BONIFICACI&Oacute;N O COMISIONES</td>
                    <td style="width:23%;">LIBRE EJERCICIO PROFESI&Oacute;N</td>
                    <td style="width:17%;">OTROS INGRESOS</td>
                    <td style="width:17%;">TOTAL INGRESOS</td>
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
                    <td style="width:20%;">SUELDO B&Aacute;SICO</td>
                    <td style="width:23%;">BONIFICACI&Oacute;N O COMISIONES</td>
                    <td style="width:23%;">LIBRE EJERCICIO PROFESI&Oacute;N</td>
                    <td style="width:17%;">OTROS INGRESOS</td>
                    <td style="width:17%;">TOTAL INGRESOS</td>
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
                    <td style="width:28%;"></td>
                    <td style="width:17%;">ALQUILER</td>
                    <td style="width:17%;">TELEFON&Iacute;A</td>
                    <td style="width:17%;">ALIMENTOS</td>
                    <td style="width:21%;">COLEGIOS O ESTUDIOS</td>
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
                    <td style="width:21%;"></td>
                    <td style="width:20%;">ALQUILER</td>
                    <td style="width:25%;">
                        <table style="border-collapse: collapse;"  class="sub_td"><tr><td>ESPECIFIQUE</td></tr></table>
                       ALIMENTOS
                    </td>
                    <td style="width:17%;">
                    <table style="border-collapse: collapse;"  class="sub_td"><tr><td>MONTO</td></tr></table>
                       ALIMENTOS
                    </td>
                    <td style="width:17%;"></td>
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
                    <td style="width:28%;">ALQUILER</td>
                    <td style="width:34%;">TELEFON&Iacute;A</td>
                    <td style="width:16%;">ALIMENTOS</td>
                </tr>
               
                
            </table>
        </td>
    </tr>
         <tr style="">
        <td class="etiqueta" style="font-size:8.5px;text-align:left;">
          POSEE USTED O LA EMPRESA PARA LA CUAL TRABAJA RELACI&Oacute;N PERSONAL O COMERCIAL CON ALG&Uacute;N EMPLEADO DE BANPLUS
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
          USTED EJERCI&Oacute; O EJERCE ACTUALMENTE ALGÚN CARGO PUBLICO COMO FUNCIONARIO DE GOBIERNO
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
                    <td class="etiqueta d_linea" style="width:20%;">DESEA REALIZAR OPERACIONES<BR>EN DIVISAS</td>
                    <td class="etiqueta" style="width:40%;">INDIQUE TIPO DE OPERACIONES</td>
                    <td class="etiqueta" style="width:40%;" colspan="2">EN CASO DE TRANSFERENCIA INDIQUE</td>
                </tr>
               <tr class="valores">
                    <td style="width:20%;font-size:12px;text-align:center;">
                     Si&nbsp;<input type="checkbox"  >&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;<input type="checkbox"  >&nbsp;
                    </td>
                    <td style="width:40%;font-size:11px;">
                     Venta de Divisas&nbsp;<input type="checkbox"  >&nbsp;
                     Compra de Divisas&nbsp;<input type="checkbox"  >&nbsp;
                     Transferencias&nbsp;<input type="checkbox"  >
                    </td>
                    <td style="width:20%;">
                        <table style="border-collapse: collapse;"  class="sub_td"><tr><td>PAIS ORIGEN</td></tr></table>
                       ALIMENTOS
                    </td>
                    <td style="width:20%;">
                    <table style="border-collapse: collapse;"  class="sub_td"><tr><td>PAIS DESTINO</td></tr></table>
                       ALIMENTOS
                    </td>
                    
                </tr>
                
            </table>
        </td>
    </tr>
    <tr>
     <td class="bloque">
            <table style="border-collapse: collapse;" >
               <tr class="valores">
                    <td style="width:100%;font-weight:bold;">
                      Autorizo (amos) a Banplus, a realizar todas las investigaciones y verificaciones que considere pertinentes, a fin de conocer con toda precisi&oacute;n y exactitud los datos e informaci&oacute;n
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
                        venezolana vigente y a la Resoluci&oacute;n N° 119-10, de Fecha 09 de marzo de 2010, emanada de la Superintendencia de Bancos y Otras Instituciones Financieras
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
                        contenido del Contrato Único de Cuentas de Ahorro, Corriente y Dep&oacute;sitos, inscrito ante el Registro Público del Segundo Circuito del Municipio Baruta del Estado Miranda, en fecha
                        31 de Marzo de 2014, bajo el No. 8, Folio 49 del Tomo 4 del Protocolo de Transcripci&oacute;n del año 2014, autorizado por la SUDEBAN, mediante Oficio No. SIB-DSB-CJ-OD-03308, de fecha 3
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
</page>

';








    $html2pdf->writeHTML($conte);
    $html2pdf->Output('exemple00.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}


exit();


