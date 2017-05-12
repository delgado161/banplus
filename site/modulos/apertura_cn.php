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
<script>

    var Ciudades = {};
<?php
foreach ($Ciudades as $Ciudad)
    echo "Ciudades['" . $Ciudad['id_estado'] . "_" . $Ciudad['id_ciudad'] . "']='" . $Ciudad['ciudad'] . "';";
?>

    $(document).ready(function () {
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: '',
            changeYear: true,
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
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
        $('#form_ap_cuenta').submit(function () {
            var validado = true;
            $('.requerido_').each(function () {
                if ($(this).val().length <= 0) {
                    $(this).css('background', 'rgba(255,0,0,0.30)');
                    validado = false;
                }

            });
            if (!validado)
                alert('Por Favor rellene los campos se\u00f1alados');
            return validado;
        });
        $("#fc_nac").datepicker({
            dateFormat: "dd/mm/yy",
            yearRange: '-200:+0'
        });
        $("#fc_nac").change(function () {
            fecha = $(this).val().split("/");
            $('#edad').val(calcular_edad(fecha[0], fecha[1], fecha[2]));
        });
        $('#tp_inmueble').change(function () {

            if ($(this).val() == "ARRENDADA")
                $('.cannon').show();
            else
                $('.cannon').hide();

        });


        $('#canon').keyup(function () {
            $(this).val(function (index, value) {
                return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
            });

        });

    });</script>

<br><br>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<form method="POST" id="form_ap_cuenta">

    <div style="background-color:#F4F4F4;overflow:auto;overflow-x:hidden;" class="form_n" > 
        <p class="titulo" >Datos Personales:</p>
        <div class="separador_" style=""></div>

        <div class="div_form">
            <label for="p_nombre">Primer Nombre:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre" value="">
        </div>
        <div class="div_form">
            <label for="s_nombre">Segundo Nombre:</label><br>
            <input style="width: 173px;" onkeypress="return solo_letras(event)" type="text" name="s_nombre" id="s_nombre" value="">
        </div>
        <div class="div_form">
            <label for="p_apellido">Primer Apellido:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="">
        </div>
        <div class="div_form">
            <label for="s_apellido">Segundo Apellido:</label><br>
            <input style="width: 173px;"  onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>

        <!--##################### DIV SEPARADOR ############################--> 
        <div class="sep_2"></div>

        <div class="div_form">
            <label for="tp_documento">N&uacute;mero de identificaci&oacute;n:<span  style="color:red">*</span></label><br>
            <select name="tp_documento" id="tp_documento" class="requerido_">
                <option value="">
                <option value="C">V
                <option value="E">E
                <option value="P">P
            </select>
            <input style="width: 140px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="n_documento" id="n_documento" value="">
        </div>

        <div class="div_form">
            <label for="naturalizado">naturalizado N&ordm; C.I anteriol:</label><br>
            <input style="width: 170px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="naturalizado" id="naturalizado" value="">
        </div>

        <div class="div_form">
            <label for="tp_nacionalidad">Nacionalidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_nacionalidad" id="tp_nacionalidad" style="width:179px; ">
                <option value="">Seleccione...
                    <?php echo $_opc_tp_nacionalidad; ?>
            </select>
        </div>

        <div class="div_form">
            <label for="tp_sexo" >Sexo:<span  style="color:red">*</span></label>
            <div style="width:100%;height: 4px;" ></div>
            M<input type="radio" value="M" name="tp_sexo">
            F<input type="radio" value="F" name="tp_sexo">
        </div>
        <!--##################### DIV SEPARADOR ############################-->
        <div class="sep_2"></div>

        <div class="div_form">
            <label for="fc_nac">Fecha de nacimiento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="fc_nac" id="fc_nac" value="" readonly>
        </div>

        <div class="div_form">
            <label for="edad">Edad:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:40px;;background: #e6e6e6;" type="text" name="edad" id="edad" value="" readonly>
        </div>

        <div class="div_form">
            <label for="tp_pais">Pa&iacute;s de nacimiento:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_pais" id="tp_pais" style="width: 170px;">
                <option value="">Seleccione...
                    <?php echo $_opc_tp_pais; ?>
            </select>
            <!--<input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais" value="" style="width:238px;">-->

        </div>
        <div class="div_form">
            <label for="tp_estado">Estado de nacimiento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_estado" id="tp_estado" value="" style="width:180px;">
        </div>
        <div class="div_form">
            <label for="tp_ciudad">Ciudad de nacimiento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_ciudad" id="tp_ciudad" value="" style="width:180px;">
        </div>



        <!--##################### DIV SEPARADOR ############################-->   
        <div class="sep_2"></div>


        <div class="div_form">
            <label for="tp_civil">Estado Civil:<span  style="color:red">*</span></label><br>
            <select style="    width: 115px;" class="requerido_" name="tp_civil" id="tp_civil">
                <option value="">Seleccione...
                <option value="SOLTERO">Soltero
                <option value="CASADO">Casado
                <option value="VIUDO">Viudo
                <option value="DIVORCIADO">Divorciado                
            </select>
        </div>

        <div class="div_form">
            <label for="g_familiar">Carga familiar:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:80px;" type="number" name="g_familiar" id="g_familiar" min="0" max="100">
        </div>

        <div class="div_form">
            <label for="tp_profecion">Actividad Econ&oacute;mica:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_profecion" id="tp_profecion" style="width:260px;">
                <option value="">Seleccione...

            </select>
        </div>

        <div class="div_form">
            <label for="tp_profecion">Profesi&oacute;n u oficio:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_profecion" id="tp_profecion" style="width:274px;">
                <option value="">Seleccione...
                    <?php echo $_opc_profesion ?>
            </select>
        </div>


        <!--##################### DIV SEPARADOR ############################-->  
        <div class="sep_2"></div>

        <div class="div_form">
            <label for="tp_ocupacion">Ocupaci&oacute;n:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_ocupacion" id="tp_ocupacion" style="width:300px">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>
        </div>

        <div class="div_form">
            <label for="email">Correo electr&oacute;nico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email" value="" style="width:450px;">
        </div>


        <!--DIRECCION ######################################-->

        <p class="titulo" > Direcci&oacute;n de Habitaci&oacute;n:</p>
        <div class="separador_" style=""></div>
        <div class="div_form">
            <label for="dtp_estado">Estado:<span  style="color:red">*</span></label><br>
            <select class="_estados requerido_" name="dtp_estado" id="dtp_estado" style="width:216px;">
                <option value="">Seleccione...
                    <?php echo $_opc_estados; ?>
            </select>
        </div>
        <div class="div_form">
            <label for="dtp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_ciudad" id="dtp_ciudad" style="width:216px;">
                <option value="">Seleccione...
            </select>
        </div>
        <div class="div_form">
            <label for="d_postal">C&oacute;digo postal:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:79px;" type="text" name="d_postal" id="d_postal" value="" >
        </div>

        <div class="div_form">
            <label for="d_calle">Calle o Avenida:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:208px;" type="text" name="d_calle" id="d_calle" value="" >
        </div>

        <!--##################### DIV SEPARADOR ############################-->   
        <div class="sep_2"></div>
        <div class="div_form">
            <label for="d_urbanizacion">Urbanizaci&oacute;n:<span  style="color:red">*</span></label><br>
            <input style="width:225px;" class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="d_urbanizacion" id="d_urbanizacion" value="" >
        </div>
        <div class="div_form">
            <label for="d_ceq"> Casa / Edificio / Quinta :<span  style="color:red">*</span></label><br>
            <input style="width:225px;" class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="d_ceq" id="d_ceq" value="" >
        </div>
        <div class="div_form">
            <label for="d_piso">Piso:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:38px;" type="text" name="d_piso" id="d_piso" value="" >
        </div>
        <div class="div_form">
            <label for="d_apartamento">Apartamento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:75px;" type="text" name="d_apartamento" id="d_apartamento" value="">
        </div>
        <div class="div_form">
            <label for="ano_vivienda">A&ntilde;os en la vivienda:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:110px;" type="number" name="ano_vivienda" id="ano_vivienda" min="0" max="2000">
        </div>

        <!--##################### DIV SEPARADOR ############################-->    
        <div class="sep_2"></div>

        <div class="div_form">
            <label for="dtp_telefonoH">Tel&eacute;fono Hab.:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_telefonoH" id="dtp_telefonoH" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefonoh" id="d_telefonoh" value="">
        </div>

        <div class="div_form">
            <label for="dtp_telefono2">Otro Tel&eacute;fono:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_telefono2" id="dtp_telefono2" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefono2" id="d_telefono2" value="">
        </div>

        <div class="div_form">
            <label for="dtp_celular">Celular:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_celular" id="dtp_celular" style="width:70px;">
                <option value="">
                    <?php echo $_opc_cel; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_celular" id="d_celular" value="">
        </div>

        <div class="div_form">
            <label for="tp_inmueble">Tipo inmueble:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_inmueble" id="tp_inmueble" style="width:189px;">
                <option value="">Seleccione...
                <option value="PROPIA">Propia
                <option value="ARRENDADA">Arrendada
                <option value="OTROS">Otros
            </select>
        </div>

        <!--##################### DIV SEPARADOR ############################-->      
        <div class="cannon">
            <div class="sep_2 "></div>
            <div class="div_form">
                <label for="canon">Canon de Arrendamiento:</label><br>
                <input  onkeypress="return solo_moneda(event)" style="width:236px;text-align: right;" type="text" name="canon" id="canon" value="" > Bs.
            </div>
            <div class="div_form">
                <label for="canon_nombre">Nombre del Arrendador:</label><br>
                <input onkeypress="return solo_letras(event)" style="width:288px;" type="text" name="canon_nombre" id="canon_nombre" value="" >
            </div>
            <div class="div_form">
                <label for="dctp_telefono">Tel&eacute;fono del Arrendador:</label><br>
                <select  name="dctp_telefono" id="dctp_telefono" style="width:70px;">
                    <option value="">
                        <?php echo $_opc_area; ?>
                </select>
                <input  onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="cd_telefono" id="cd_telefono" value="">
            </div>
        </div>

        <!--DATOS LABORABLES ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" > Datos Laborales:</p>

        <div class="div_form">
            <label for="n_empresa">Nombre de la empresa:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras3(event)" style="width:238px;" type="text" name="n_empresa" id="n_empresa" value="" >
        </div>
        <div class="div_form">
            <label for="ramo_empresa">Actividad o ramo:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" style="width:238px;" type="text" name="ramo_empresa" id="ramo_empresa" value="" >
        </div>
        <div class="div_form">
            <label for="cargo_empresa">Cargo:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" style="width:238px;" type="text" name="cargo_empresa" id="cargo_empresa" value="" >
        </div>

        <!--##################### DIV SEPARADOR ############################-->    
        <div class="sep_2"></div>

        <div class="div_form">
            <label for="etp_relacion">Relaci&oacute;n laboral:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="etp_relacion" id="etp_relacion" style="width:248px;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>
        </div>

        <div class="div_form">
            <label for="e_antiguo">Antig&uuml;edad:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px" type="number" name="e_antiguo" id="e_antiguo" value="" min="0" max="2000" >
            <select class="requerido_" name="e_antiguo_op" id="e_antiguo_op" style="">
                <option value="">Seleccione...
                <option value="DIAS">D&iacute;as
                <option value="SEMANAS">Semanas
                <option value="MESES">Meses
                <option value="AÑOS">A&ntilde;os
            </select>   
        </div>


        <!--##################### DIV SEPARADOR ############################-->    
        <div class="sep_2"></div>

        <div class="div_form">
            <label for="sueldo">Sueldo b&aacute;sico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="sueldo" id="sueldo" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="comision">Bonificaci&oacute;n o comisiones:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="comision" id="comision" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="libre_ejercicio">Libre ejercicio de la profesi&oacute;n:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="libre_ejercicio" id="libre_ejercicio" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="otros_ingresos">Otros ingresos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="otros_ingresos" id="otros_ingresos" value="0,00" >Bs.
        </div>

        <!--##################### DIV SEPARADOR ############################-->    
        <div class="sep_2"></div>

        <div style="float:right;padding:5px;">
            <label for="total_ingresos">Total ingresos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:350px;background: #e6e6e6;text-align: right;" type="text" name="total_ingresos" id="otros_ingresos" value="0,00" readonly >Bs.
        </div>


        <!--DIRECCION EMPRESA ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" > Direcci&oacute;n de Empresa:</p>

        <div class="div_form">
            <label for="etp_estado">Estado:<span  style="color:red">*</span></label><br>
            <select  class="_estados requerido_" name="etp_estado" id="etp_estado" style="width:216px;">
                <option value="">Seleccione...
                    <?php echo $_opc_estados; ?>
            </select>
        </div>
        <div class="div_form">
            <label for="etp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="etp_ciudad" id="etp_ciudad" style="width:216px;">
                <option value="">Seleccione...
            </select>
        </div>
        <div class="div_form">
            <label for="e_calle">C&oacute;digo postal:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:79px;" type="text" name="e_calle" id="e_calle" value="" >
        </div>

        <div class="div_form">
            <label for="e_calle">Calle o Avenida:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:208px;" type="text" name="e_calle" id="e_calle" value="" >
        </div>
        <!--##################### DIV SEPARADOR ############################-->        <div class="sep_2"></div>
        <div class="div_form">
            <label for="e_urbanizacion">Urbanizaci&oacute;n:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:260px;" type="text" name="e_urbanizacion" id="e_urbanizacion" value="" >
        </div>

        <div class="div_form">
            <label for="e_ceq"> Casa / Edificio / Quinta :<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:260px;" type="text" name="d_ceq" id="d_urbanizacion" value="" >
        </div>

        <div class="div_form">
            <label for="e_Oficina">Oficina:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:70px;" type="text" name="e_Oficina" id="e_Oficina" value="">
        </div>

        <div class="div_form">
            <label for="e_piso">Piso:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:40px;" type="text" name="e_piso" id="e_piso" value="" >
        </div>

        <div class="div_form">
            <label for="e_local">Local:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:43px;" type="text" name="e_local" id="e_local" value="" >
        </div>

        <div class="div_form">
            <label for="edctp_telefono">Tel&eacute;fono:</label><br>
            <select class="requerido_" name="edctp_telefono" id="edctp_telefono" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono" id="ecd_telefono" value="">
        </div>

        <div class="div_form">
            <label for="edctp_telefono2">Otro Tel&eacute;fono:</label><br>
            <select class="requerido_" name="edctp_telefono2" id="edctp_telefono2" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono2" id="ecd_telefono2" value="">
        </div>


        <!--PRODUCTOS BANPLUS  ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" >Datos de los productos que posee en Banplus:</p>

        <?php
        for ($i = 0; $i <= 3; $i++) {
            ?>

            <div style = "float:left;padding:5px;">
                <label for = "tp_producto<?php echo $i; ?>">Tipo de Producto:<span style = "color:red">*</span></label><br>
                <select class = "requerido_" name = "tp_producto<?= $i; ?>" id = "tp_producto<?= $i; ?>" style = "width:120px;">
                    <option value = "">Seleccione...
                        <?php echo $_opc_productos
                        ?>

                </select>    
            </div>
            <div class="div_form">
                <label for="numero_prod<?= $i; ?>">N&uacute;mero:<span  style="color:red">*</span></label><br>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:240px;" type="text" name="numero_prod<?= $i; ?>" id="numero_prod<?= $i; ?>" value="" >
            </div>

            <?php
        }
        ?>

        <!--REFERENCIAS  ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" >Referencias Bancarias:</p>
        <?php
        for ($i = 0; $i <= 2; $i++) {
            ?>

            <div class="div_form">
                <label for="tp_banco<?= $i; ?>">Banco:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="tp_banco<?= $i; ?>" id="tp_banco<?= $i; ?>" style="width:200px;">
                    <option value="C">Soltero
                    <option value="p">Casado
                    <option value="p">Viudo
                </select>    
            </div>
            <div class="div_form">
                <label for="cuenta<?= $i; ?>">N&ordm; de Cuenta o TDC:<span  style="color:red">*</span></label><br>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:134px;" type="text" name="cuenta<?= $i; ?>" id="cuenta<?= $i; ?>" value="" >
            </div>
            <div class="div_form">
                <label for="tp_cuenta<?= $i; ?>">Tipo de cuenta:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="tp_cuenta<?= $i; ?>" id="tp_cuenta<?= $i; ?>" style="width:105px;">
                    <option value = "">Seleccione...               
                        <?php echo $_opc_tp_cuenta; ?>
                </select>    
            </div>

            <div class="div_form">
                <label for="cuenta_antiguo<?= $i; ?>">Antig&uuml;edad:<span  style="color:red">*</span></label><br>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:45px" type="number" name="cuenta_antiguo<?= $i; ?>" id="cuenta_antiguo<?= $i; ?>" value="" min="0" max="2000" >
                <select style="width:103px" class="requerido_" name="cuenta__antiguo_op<?= $i; ?>" id="cuenta__antiguo_op<?= $i; ?>" >
                    <option value="">Seleccione...
                    <option value="DIAS">D&iacute;as
                    <option value="SEMANAS">Semanas
                    <option value="MESES">Meses
                    <option value="AÑOS">A&ntilde;os
                </select>   
            </div>

            <div class="div_form">
                <label for="ag_origen<?= $i; ?>">Agencia Origen:<span  style="color:red">*</span></label><br>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:108px;" type="text" name="ag_origen<?= $i; ?>" id="ag_origen<?= $i; ?>" value="" >
            </div>


            <?php
        }
        ?>



        <!--REFERENCIAS  ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" >Referencias Comerciales:</p>
        <?php
        for ($i = 0; $i <= 1; $i++) {
            ?>
            <div class="div_form">
                <label for="rc_empresa<?= $i; ?>">Empresa / Comercio:<span  style="color:red">*</span></label><br>
                <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rc_empresa<?= $i; ?>" id="rc_empresa<?= $i; ?>" value="">
            </div>

            <div class="div_form">
                <label for="rctp_ramo<?= $i; ?>">Activida / Ramo:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="rctp_ramo<?= $i; ?>" id="rctp_ramo<?= $i; ?>" style="width:193px;">
                    <option value="C">Soltero
                    <option value="p">Casado
                    <option value="p">Viudo
                </select>
            </div>

            <div class="div_form">
                <label for="rtp_telefonoH<?= $i; ?>">Tel&eacute;fono Hab.:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="dtp_telefonoH<?= $i; ?>" id="dtp_telefonoH<?= $i; ?>" style="width:70px;">
                    <option value="">
                        <?php echo $_opc_area; ?>
                </select>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefonoh<?= $i; ?>" id="d_telefonoh<?= $i; ?>" value="">
            </div>

            <div class="div_form">
                <label for="dtp_telefono2<?= $i; ?>">Otro Tel&eacute;fono:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="dtp_telefono2<?= $i; ?>" id="dtp_telefono2<?= $i; ?>" style="width:70px;">
                    <option value="">
                        <?php echo $_opc_area; ?>
                </select>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefono2<?= $i; ?>" id="d_telefono2<?= $i; ?>" value="">
            </div>

            <?php
        }
        ?>

        <!--REFERENCIA PERSONALES NO FAMILAIRES ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" > Referencias personales no familiares:</p>

        <?php
        for ($i = 10; $i <= 11; $i++) {
            ?>
            <div class="div_form">
                <label for="rfa_nombre<?= $i; ?>">Nombre y Apellido:<span  style="color:red">*</span></label><br>
                <input style="width:190px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rfa_nombre<?= $i; ?>" id="rfa_nombre<?= $i; ?>" value="">
            </div>

            <div class="div_form">
                <label for="rf_ocupacion<?= $i; ?>">Ocupaci&oacute;n:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="rf_ocupacion<?= $i; ?>" id="rf_ocupacion<?= $i; ?>" style="width:150px;">
                    <option value="">Seleccione...
                    <option value="C">Soltero
                    <option value="p">Casado
                    <option value="p">Viudo
                </select>
            </div>
            <div class="div_form">
                <label for="rf_direccion<?= $i; ?>">Direci&oacute;n:<span  style="color:red">*</span></label><br>
                <input  style="width:195px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rf_direccion<?= $i; ?>" id="rf_direccion<?= $i; ?>" value="">
            </div>
            <div class="div_form">
                <label for="rtp_telefonoH<?= $i; ?>">Tel&eacute;fono.:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="dtp_telefonoH<?= $i; ?>" id="dtp_telefonoH<?= $i; ?>" style="width:70px;">
                    <option value="">
                        <?php echo $_opc_area; ?>
                </select>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefonoh<?= $i; ?>" id="d_telefonoh<?= $i; ?>" value="">
            </div>
            <?php
        }
        ?>

        <!--CONYUGE ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" >Datos del c&oacute;nyuge o concubino:</p>

        <div class="div_form">
            <label for="ccp_nombre">Primer Nombre:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="ccp_nombre" id="ccp_nombre" value="">
        </div>
        <div class="div_form">
            <label for="ccs_nombre">Segundo Nombre:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="ccs_nombre" id="ccs_nombre" value="">
        </div>
        <div class="div_form">
            <label for="ccp_apellido">Primer Apellido:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="ccp_apellido" id="ccp_apellido" value="">
        </div>
        <div class="div_form">
            <label for="ccs_apellido">Segundo Apellido:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="ccs_apellido" id="ccs_apellido" value="">
        </div>


        <!--##################### DIV SEPARADOR ############################--> 
        <div class="sep_2"></div>

        <div class="div_form">
            <label for="cctp_documento">N&uacute;mero de documento:<span  style="color:red">*</span></label><br>
            <select name="cctp_documento" id="cctp_documento" class="requerido_">
                <option value="">
                <option value="C">C.I
                <option value="E">E
                <option value="P">P
            </select>
            <input style="width: 115px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="ccn_documento" id="ccn_documento" value="">
        </div>
        <div class="div_form">
            <label for="cc_naturalizado">naturalizado N&ordm; C.I anteriol:<span  style="color:red">*</span></label><br>
            <input style="width: 156px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="cc_naturalizado" id="cc_naturalizado" value="">
        </div>

        <div class="div_form">
            <label for="cctp_pais">Nacionalidad:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_pais" id="tp_pais" style="width:100%">
                <option value="">Seleccione...
                <option value="C">Venezuela
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="cctp_pais" id="cctp_pais" value="" style="width:169px;">

        </div>
        <div class="div_form">
            <label for="ccfc_nac">Fecha de nacimiento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:110px;" type="text" name="ccfc_nac" id="ccfc_nac" value="">
        </div>

        <div class="div_form">
            <label for="ccedad">Edad:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:65px;;background: #e6e6e6;" type="text" name="ccedad" id="ccedad" value="" readonly>
        </div>
        <!--##################### DIV SEPARADOR ############################-->
        <div class="sep_2"></div>
        <div class="div_form">
            <label for="cctp_pais">Pa&iacute;s de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_pais" id="tp_pais" style="width:100%">
                <option value="">Seleccione...
                <option value="C">Venezuela
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="cctp_pais" id="cctp_pais" value="" style="width:238px;">

        </div>
        <div class="div_form">
            <label for="cctp_estado">Estado de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_estado" id="tp_estado" style="width:100%;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="cctp_estado" id="cctp_estado" value="" style="width:238px;">
        </div>
        <div class="div_form">
            <label for="cctp_ciudad">Ciudad de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_ciudad" id="tp_ciudad" style="width:100%;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="cctp_ciudad" id="cctp_ciudad" value="" style="width:238px;">

        </div>



        <!--##################### DIV SEPARADOR ############################-->   
        <div class="sep_2"></div>
        <div class="div_form">
            <label for="cctp_sexo" >Sexo:<span  style="color:red">*</span></label>
            <div style="width:100%;height: 4px;" ></div>
            M<input type="radio" value="M" name="cctp_sexo">
            F<input type="radio" value="F" name="cctp_sexo">
        </div>

        <div class="div_form">
            <label for="cctp_civil">Estado Civil:<span  style="color:red">*</span></label><br>
            <select style="    width: 115px;" class="requerido_" name="cctp_civil" id="cctp_civil">
                <option value="">Seleccione...
                <option value="SOLTERO(@)">Soltero(@)
                <option value="CASADO(@)">Casado(@)
                <option value="VIUDO(@)">Viudo(@)
                <option value="DIVORCIADO(@)">Divorciado(@)
                <option value="CONCUBINO(@)">Concubino(@)
            </select>
        </div>

        <div class="div_form">
            <label for="ccg_familiar">Carga familiar:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:80px;" type="number" name="ccg_familiar" id="ccg_familiar" min="0" max="100">
        </div>

        <div class="div_form">
            <label for="cctp_profecion">Actividad Econ&oacute;mica:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="cctp_profecion" id="cctp_profecion" style="width:230px;">
                <option value="">Seleccione...

            </select>
        </div>

        <div class="div_form">
            <label for="cctp_profecion">Profesi&oacute;n u oficio:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="cctp_profecion" id="cctp_profecion" style="width:230px;">
                <option value="">Seleccione...
                    <?php echo $_opc_profesion ?>
            </select>
        </div>


        <!--##################### DIV SEPARADOR ############################-->  
        <div class="sep_2"></div>

        <div class="div_form">
            <label for="cctp_ocupacion">Ocupaci&oacute;n:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="cctp_ocupacion" id="cctp_ocupacion" style="width:300px">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>
        </div>

        <div class="div_form">
            <label for="ccemail">Correo electr&oacute;nico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="ccemail" id="ccemail" value="" style="width:450px;">
        </div>


        <!--INGRESOS CONYUGE ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" >INGRESO DEL CONYUGE O CONCUBINO:</p>


        <div class="div_form">
            <label for="ccsueldo">Sueldo b&aacute;sico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="ccsueldo" id="ccsueldo" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="cccomision">Bonificaci&oacute;n o comisiones:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="cccomision" id="cccomision" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="cclibre_ejercicio">Libre ejercicio de la profesi&oacute;n:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="cclibre_ejercicio" id="cclibre_ejercicio" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="ccotros_ingresos">Otros ingresos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="ccotros_ingresos" id="ccotros_ingresos" value="0,00" >Bs.
        </div>

        <!--##################### DIV SEPARADOR ############################-->    
        <div class="sep_2"></div>

        <div style="float:right;padding:5px;">
            <label for="cctotal_ingresos">Total ingresos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:350px;background: #e6e6e6;text-align: right;" type="text" name="cctotal_ingresos" id="ccotros_ingresos" value="0,00" readonly >Bs.
        </div>

        <!--INGRESOS GRUPO FAMILIAR ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" >INGRESO MENSUAL GRUPO FAMILIAR:</p>


        <div class="div_form">
            <label for="igf_sueldo">Sueldo b&aacute;sico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_sueldo" id="igf_sueldo" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="igf_comision">Bonificaci&oacute;n o comisiones:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_comision" id="igf_comision" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="igf_libre_ejercicio">Libre ejercicio de la profesi&oacute;n:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_libre_ejercicio" id="igf_libre_ejercicio" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="igf_otros_ingresos">Otros ingresos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_otros_ingresos" id="igf_otros_ingresos" value="0,00" >Bs.
        </div>

        <!--##################### DIV SEPARADOR ############################-->    
        <div class="sep_2"></div>

        <div style="float:right;padding:5px;">
            <label for="igf_total_ingresos">Total ingresos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:350px;background: #e6e6e6;text-align: right;" type="text" name="igf_total_ingresos" id="igf_otros_ingresos" value="0,00" readonly >Bs.
        </div>


        <!--GASTOS MENSUAL PROMEDIOS ######################################-->
        <div class="separador_" style=""></div>
        <p class="titulo" >GASTOS MENSUAL PROMEDIO DEL GRUPO FAMILIAR:</p>


        <div class="div_form">
            <label for="igf_servicios">servicios b&aacute;sicos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_sueldo" id="igf_sueldo" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="igf_alquiler">alquiler:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_comision" id="igf_comision" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="igf_telefono">telefon&iacute;a:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_libre_ejercicio" id="igf_libre_ejercicio" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="igf_alimentos">alimentos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_otros_ingresos" id="igf_otros_ingresos" value="0,00" >Bs.
        </div>


        <!--##################### DIV SEPARADOR ############################-->    
        <div class="sep_2"></div>

        <div class="div_form">
            <label for="igf_estudios">colegios o estudios:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_estudios" id="igf_estudios" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="igf_creditos">cr&eacute;ditos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_creditos" id="igf_creditos" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="igf_tarjetas">tarjeta de cr&eacute;ditos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_tarjetas" id="igf_tarjetas" value="0,00" >Bs.
        </div>
        <div class="div_form">
            <label for="igf_otros_ingresos">Otros Gastos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_otros_ingresos" id="igf_otros_ingresos" value="0,00" >Bs.
        </div>

        <div class="div_form">
            <label for="igf_otros_eso">Especifique Otro Gastos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" style="width:155px;text-align: right;" type="text" name="igf_otros_eso" id="igf_otros_eso" value="" >Bs.
        </div>

        <div style="float:right;padding:5px;">
            <label for="igf_total_ingresos">Total ingresos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:350px;background: #e6e6e6;text-align: right;" type="text" name="igf_total_ingresos" id="igf_otros_ingresos" value="0,00" readonly >Bs.
        </div>



        <div style="float:left;padding:5px;width: 95%;text-align: right;margin-top: 20px;">
            <button type="submit" value="Submit">Submit</button>
        </div>


    </div>
</form>


<?php
/* 
Created on:28/04/2017,11:40:47 AM
Author    :Roberto Delgado
*/




