<?php
$Estados = execute_sql("get_estados2", array());
$_opc_estados = '';
foreach ($Estados as $estado)
    $_opc_estados .= '  <option value="' . $estado['id_estado'] . '">' . $estado['estado'];


$Ciudades = execute_sql("get_ciudad", array());
$_opc_ciudades = '';
$_codigo_areas = ['0248', '0281', '0240', '0243', '0273', '0284', '0241', '0258', '0287', '0212', '0259', '0235', '0251', '0271', '0212', '0287', '0295', '0255', '0293', '0275', '0271', '0212', '0251', '0262'];
$_codigo_cel = ['0412', '0426', '0416', '0424', '0414'];
foreach ($_codigo_areas as $codigo)
    $_opc_area .= '  <option value="' . $codigo . '">' . $codigo;

foreach ($_codigo_cel as $codigo)
    $_opc_cel .= '  <option value="' . $codigo . '">' . $codigo;


$profesiones = execute_sql("get_profesiones", array());
$_opc_profesion = '';
foreach ($profesiones as $prof)
    $_opc_profesion .= '  <option value="' . $prof['id_profesion'] . '">' . $prof['descripcion'];


$productos = execute_sql("get_tp_productos", array());
$_opc_productos = '';
foreach ($productos as $prod)
    $_opc_productos .= '  <option value="' . $prod['id_producto'] . '">' . $prod['tipo'];


$tp_cuentas = execute_sql("get_tp_productos", array());
$_opc_tp_cuenta = '';
foreach ($tp_cuentas as $tp_cuenta)
    $_opc_tp_cuenta .= '  <option value="' . $tp_cuenta['id_cuenta'] . '">' . $tp_cuenta['tipo'];

$tp_paises = execute_sql("get_paises", array());
$_opc_tp_pais = '';
foreach ($tp_paises as $tp_pais)
    $_opc_tp_pais .= '  <option value="' . $tp_pais['nombre'] . '">' . $tp_pais['nombre'];

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
<?php
foreach ($Ciudades as $Ciudad)
    echo "Ciudades['" . $Ciudad['id_estado'] . "_" . $Ciudad['id_ciudad'] . "']='" . $Ciudad['ciudad'] . "';";
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
        });


    });</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">