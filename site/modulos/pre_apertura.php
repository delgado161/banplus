
<?php
session_start();
$_SESSION = array();

include("includes/captcha-master/simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
?>

<?php
if (isset($_POST['p_proceso_id']) && !empty($_POST['p_proceso_id'])) {
    $DATOS_ = execute_sql("get_data_sol", array($_POST['p_proceso_id']));
    $_DAT = unserialize(unserialize($DATOS_[1]['valores']));
}

$DATOS_ = execute_sql("get_data_sol", array('SOLTC_17146576'));
$_DAT = unserialize(unserialize($DATOS_[1]['valores']));
//var_dump($_DAT);



$AGENCIA = execute_sql("get_agencia_all2", array());
$_opc_agencia = '';
foreach ($AGENCIA as $agencia)
    $_opc_agencia .= '  <option value="' . $agencia['id_agencias'] . '">' . $agencia['nombre'];

$AGENCIA2 = execute_sql("get_agencia_all3", array());
$_opc_agencia2 = '';
foreach ($AGENCIA2 as $agencia)
    $_opc_agencia2 .= '  <option value="' . $agencia['id_agencias'] . '">' . $agencia['nombre'];


$CIVIL = execute_sql("get_civil", array());
$_opc_civil = '';
foreach ($CIVIL as $civil_)
    $_opc_civil .= '  <option value="' . $civil_['nombre'] . '">' . $civil_['nombre'];



$act_eco = execute_sql("get_actividad_e", array());

$_opc_acteco = '';
foreach ($act_eco as $economica)
    $_opc_acteco .= '  <option value="' . $economica['actividad'] . '_' . $economica['id_acteconomica'] . '">' . $economica['actividad'];



$tp_paises = execute_sql("get_paises", array());
$_opc_tp_pais = '';
foreach ($tp_paises as $tp_pais) {
    $_opc_tp_pais .= '  <option value="' . $tp_pais['nombre'] . '">' . $tp_pais['nombre'];
}



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
    $_opc_productos .= '  <option value="' . $prod['tipo'] . '">' . $prod['tipo'];


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

$tp_feriado = execute_sql("get_fecha_new", array());

$Parroquias = execute_sql("get_parroquias_new", array());
?>

<script    src="https://code.jquery.com/jquery-3.2.1.min.js"    ></script>
<script src = "js/UI/external/jquery/jquery.js" ></script>
<script src="js/UI/jquery-ui.js"></script>
<script src="js/jquery.mask.js"></script>
<script src="<?php echo URL_SITE; ?>js/new_js.js" type="text/javascript"></script>	
<script>
    $(document).ready(function () {


        var Ciudades = {};
        var Municipios = {};
        var Agencia = {};
        var Feriado = {};
        var Parroquia = {};
<?php
$Ciudades = execute_sql("get_ciudad_new", array());

foreach ($Ciudades as $Ciudad)
    echo "Ciudades['" . $Ciudad['lf_estado'] . "_" . $Ciudad['id_banplus'] . "']='" . $Ciudad['ciudad'] . "';";

$Municipios = execute_sql("get_municipio_new", array());
$_opc_municipios = '';
foreach ($Municipios as $municipio)
    echo "Municipios['" . $municipio['lf_estado'] . "_" . $municipio['pk_municipio'] . "']='" . $municipio['nombre'] . "';";


foreach ($Parroquias as $parroquia)
    echo "Parroquia['" . $parroquia['lf_parroquia_municipio'] . "_" . $parroquia['lp_parroquia_id'] . "']='" . $parroquia['nombre'] . "';";



foreach ($AGENCIA as $agencia)
    echo "Agencia['" . $agencia['id_agencias'] . "']='" . $agencia['direccion'] . "';";
?>



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


        $('._municipio').change(function () {
            var KEY = $(this).val();
            KEY = KEY.split(',');
            KEY = KEY[1];
            var ID_SELECT = ($(this).parent().next('.parroquia').find('select').attr('id'));
            $('#' + ID_SELECT).find('option').remove().end();
            $('#' + ID_SELECT).append($("<option></option>").attr("value", '').text('Seleccione...'));
            $.each(Parroquia, function (index, value) {
               
                index = index.split('_');
                if (KEY == index[0]) {
                    $('#' + ID_SELECT).append($("<option></option>").attr("value", index).text(value));
                }
            });
        });

<?php
echo "array =[";
foreach ($tp_feriado as $feriado)
    echo '"' . substr($feriado['fecha'], 0, 10) . '",';

echo "];";
?>

        $('#fn_agencia').change(function () {
            var valor_ = false;
            var KEY = $(this).val();
            $('#fc_cita').val('');
            $.each(Agencia, function (index, value) {
                if (KEY == index) {
                    $('#agencia_direccion').val(value);
                    valor_ = true;
                }
            });
            if (!valor_)
                $('#agencia_direccion').val('');


            $.ajax({
                url: 'modulos/valida_fecha.php',
                data: {agencia: KEY},
                error: function (xhr, status, error) {

                },
                success: function (data) {

                    var array2 = "[" + data + "]";
                    $("#fc_cita").datepicker("destroy");
                    $("#fc_cita").datepicker({
                        dateFormat: "dd/mm/yy",
                        yearRange: '-0:+0',
                        minDate: +19,
                        maxDate: +150,
                        beforeShowDay: function (date) {
                            var show = true;
                            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);


                            if (date.getDay() == 0 || array.indexOf(string) != -1 || array2.indexOf(string) != -1)
                                show = false

                            return [show];
                        }
                    });

                    $("#fc_cita").datepicker("refresh");
                },
                type: 'POST'
            });






        });


        //        var array = ["2017-06-22", "2017-06-29", "2017-07-06"];
        $("#fc_cita").datepicker({
            dateFormat: "dd/mm/yy",
            yearRange: '-0:+0',
            minDate: +19,
            maxDate: +150,
            beforeShowDay: function (date) {
                var show = true;
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);


                if (date.getDay() == 6 || date.getDay() == 0 || array.indexOf(string) != -1)
                    show = false

                return [show];
            }
        });


<?php if (!empty($_DAT['dtp_estado'])) { ?>


            $('#dtp_estado').trigger("change");

            $('#dtp_ciudad').find('option').each(function () {
                if ($(this).text() == '<?= $_DAT['dtp_ciudad'] ?>') {
                    $(this).attr('selected', 'selected');
                }
            });

            $('#dtp_municipio').find('option').each(function () {
                if ($(this).text() == '<?= $_DAT['dtp_municipio'] ?>') {
                    $(this).attr('selected', 'selected');
                }
            });

            $('#dtp_municipio').trigger("change");
            $('#dtp_parroquia').find('option').each(function () {
                if ($(this).text() == '<?= $_DAT['dtp_parroquia'] ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            
            
            $('#etp_estado').trigger("change");
            $('#etp_ciudad').find('option').each(function () {
                if ($(this).text() == '<?= $_DAT['etp_ciudad'] ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            
            $('#etp_municipio').find('option').each(function () {
                if ($(this).text() == '<?= $_DAT['etp_municipio'] ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            
             $('#etp_municipio').trigger("change");
            $('#etp_parroquia').find('option').each(function () {
                if ($(this).text() == '<?= $_DAT['etp_parroquia'] ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            

<?php } ?>

    });</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">