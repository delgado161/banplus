<?php
$CIVIL = execute_sql("get_civil", array());
$_opc_civil = '';
foreach ($CIVIL as $civil_)
    $_opc_civil .= '  <option value="' . $civil_['nombre'] . '">' . $civil_['nombre'];

$act_eco = execute_sql("get_actividad_e", array());
$_opc_acteco = '';
foreach ($act_eco as $economica)
    $_opc_acteco .= '  <option value="' . $economica['actividad'] . '">' . $economica['actividad'];

$tp_paises = execute_sql("get_paises", array());
$_opc_tp_pais = '';
foreach ($tp_paises as $tp_pais)
    $_opc_tp_pais .= '  <option value="' . $tp_pais['nombre'] . '">' . $tp_pais['nombre'];



$Estados = execute_sql("get_estados_new", array());
$_opc_estados = '';
foreach ($Estados as $estado)
    $_opc_estados .= '  <option value="' . $estado['id2_estado'] . '">' . $estado['nombre'];

$cod_postal = execute_sql("get_codpostal_new", array());
$_postal = '';
foreach ($cod_postal as $post)
    $_postal .= '  <option value="' . $post['codigo'] . '">' . $post['codigo'];



$_codigo_areas = execute_sql("get_codtele_new", array());
foreach ($_codigo_areas as $codigo)
    $_opc_area .= '  <option value="' . $codigo['codigo'] . '">' . $codigo['codigo'];

$_codigo_cel = execute_sql("get_codcel_new", array());
foreach ($_codigo_cel as $codigo)
    $_opc_cel .= '  <option value="' . $codigo['codigo'] . '">' . $codigo['codigo'];


$profesiones = execute_sql("get_profesiones", array());
$_opc_profesion = '';
foreach ($profesiones as $prof)
    $_opc_profesion .= '  <option value="' . $prof['descripcion'] . '">' . $prof['descripcion'];


$productos = execute_sql("get_tp_productos", array());
$_opc_productos = '';
foreach ($productos as $prod)
    $_opc_productos .= '  <option value="' . $prod['id_producto'] . '">' . $prod['tipo'];


$tp_cuentas = execute_sql("get_tp_productos", array());
$_opc_tp_cuenta = '';
foreach ($tp_cuentas as $tp_cuenta)
    $_opc_tp_cuenta .= '  <option value="' . $tp_cuenta['id_cuenta'] . '">' . $tp_cuenta['tipo'];


$tp_banco = execute_sql("get_banco_new", array());
$_opc_tp_banco = '';
foreach ($tp_banco as $tp_banco_)
    $_opc_tp_banco .= '  <option value="' . $tp_banco_['banco'] . '">' . $tp_banco_['banco'];


$_opc_tp_nacionalidad = '';
foreach ($tp_paises as $tp_pais)
    $_opc_tp_nacionalidad .= '  <option value="' . $tp_pais['nacionalidad'] . '">' . $tp_pais['nacionalidad'];
?>
<script    src="https://code.jquery.com/jquery-3.2.1.min.js"    ></script>
<script src = "js/UI/external/jquery/jquery.js" ></script>
<script src="js/UI/jquery-ui.js"></script>
<script src="js/jquery.mask.js"></script>
<script>

    var Ciudades = {};
    var Municipios = {};
<?php
$Ciudades = execute_sql("get_ciudad_new", array());

foreach ($Ciudades as $Ciudad)
    echo "Ciudades['" . $Ciudad['lf_estado'] . "_" . $Ciudad['id_banplus'] . "']='" . $Ciudad['ciudad'] . "';";

$Municipios = execute_sql("get_municipio_new", array());
$_opc_municipios = '';
foreach ($Municipios as $municipio)
    echo "Municipios['" . $municipio['lf_estado'] . "_" . $municipio['pk_municipio'] . "']='" . $municipio['nombre'] . "';";
?>

    $(document).ready(function () {

        $('._estados').change(function () {
            var KEY = $(this).val();
            var ID_SELECT = ($(this).parent().next('div').find('select').attr('id'));
            $('#' + ID_SELECT).find('option').remove().end();
            $('#' + ID_SELECT).append($("<option></option>").attr("value", '').text('Seleccione...'));
            $.each(Ciudades, function (index, value) {
                index = index.split('_');
                if (KEY == index[0]) {
                    $('#' + ID_SELECT).append($("<option></option>").attr("value", index).text(value));
                }
            });


            
            var ID_SELECT = ($(this).parent().next('div').next('.municipio').find('select').attr('id'));
           
            $('#' + ID_SELECT).find('option').remove().end();
            $('#' + ID_SELECT).append($("<option></option>").attr("value", '').text('Seleccione...'));
            $.each(Municipios, function (index, value) {
                index = index.split('_');
                if (KEY == index[0]) {
                    $('#' + ID_SELECT).append($("<option></option>").attr("value", index).text(value));
                }
            });


        });




    });</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">