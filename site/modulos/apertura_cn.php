<style>
    .form_n input,.form_n select{
        padding:4px;

    }

    .form_n label{
        font-size:11px;
    }

    .form_n {
        font-size:12px;
    }
</style>

<?php
$Estados = execute_sql("get_estados2", array());


$_opc_estados = '';
foreach ($Estados as $estado) {
    $_opc_estados .= '  <option value="' . $estado['id_estado'] . '">' . $estado['estado'];
}

$Ciudades = execute_sql("get_ciudad", array());
$_opc_ciudades = '';

$_codigo_areas = ['0412', '0426', '0416', '0424', '0414', '0248', '0281', '0240', '0243', '0273', '0284', '0241', '0258', '0287', '0212', '0259', '0235', '0251', '0271', '0212', '0287', '0295', '0255', '0293', '0275', '0271', '0212', '0251', '0262'];

foreach ($_codigo_areas as $codigo) {

    $_opc_area .= '  <option value="' . $codigo . '">' . $codigo;
}
?>
<script    src="https://code.jquery.com/jquery-3.2.1.min.js"    ></script>
<script>

    var Ciudades = {};
<?php
foreach ($Ciudades as $Ciudad) {
    echo "Ciudades['" . $Ciudad['id_estado'] . "_" . $Ciudad['id_ciudad'] . "']='" . $Ciudad['ciudad'] . "';";
}
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



    });



</script>

<br><br>

<form method="POST" id="form_ap_cuenta">


    <div style="background-color:#F4F4F4;overflow:auto;overflow-x:hidden;" class="form_n" > 
        <p class="titulo" style="width:100%;float:left;">Datos Personales:</p>

        <div style="float:left;padding:5px;">
            <label for="tp_documento">N&uacute;mero de documento:<span  style="color:red">*</span></label><br>
            <select name="tp_documento" id="tp_documento" class="requerido_">
                <option value="">
                <option value="C">C.I
                <option value="p">P
            </select>
            <input class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="n_documento" id="n_documento" value="">
        </div>
        <!--    <div style="float:left;padding:5px;">
                <label for="tp_documento">Nacionalidad:<span  style="color:red">*</span></label><br>
                <select name="tp_documento" id="tp_documento" style="width:200px" >
                    <option value="V">Venezolano
                    <option value="E">Extranjero
                </select>        
            </div>-->
        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;width:23,5%;padding:5px;">
            <label for="p_nombre">Primer Nombre:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre" value="">
        </div>
        <div style="float:left;width:23,5%;padding:5px;">
            <label for="s_nombre">Segundo Nombre:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_nombre" id="s_nombre" value="">
        </div>
        <div style="float:left;width:23,5%;padding:5px;">
            <label for="p_apellido">Primer Apellido:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="">
        </div>
        <div style="float:left;width:23,5%;padding:5px;">
            <label for="s_apellido">Segundo Apellido:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="tp_civil">Estado Civil:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_civil" id="tp_civil">
                <option value="">Seleccione...
                <option value="SOLTERO(@)">Soltero(@)
                <option value="CASADO(@)">Casado(@)
                <option value="VIUDO(@)">Viudo(@)
                <option value="DIVORCIADO(@)">Divorciado(@)
                <option value="CONCUBINO(@)">Concubino(@)
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="tp_sexo">Sexo:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_sexo" id="tp_sexo">
                <option value="">Seleccione...
                <option value="M">Masculino
                <option value="F">Femenino
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="fc_nac">Fecha de nacimiento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:110px;" type="text" name="fc_nac" id="fc_nac" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="edad">Edad:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:40px;" type="text" name="edad" id="edad" value="" readonly>
        </div>

        <div style="float:left;padding:5px;">
            <label for="g_familiar">N&uacute;mero de grupo familiar:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:120px;" type="number" name="g_familiar" id="g_familiar" min="1" max="100">
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="tp_pais">Pa&iacute;s de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_pais" id="tp_pais" style="width:100%">
                <option value="">Seleccione...
                <option value="C">Venezuela
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
             <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais" value="" style="width:235px;">
     
        </div>
        <div style="float:left;padding:5px;">
            <label for="tp_estado">Estado de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_estado" id="tp_estado" style="width:100%;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
             <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_estado" id="tp_estado" value="" style="width:235px;">
        </div>
        <div style="float:left;padding:5px;">
            <label for="tp_ciudad">Ciudad de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_ciudad" id="tp_ciudad" style="width:100%;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
              <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_ciudad" id="tp_ciudad" value="" style="width:235px;">
   
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;width:30%;padding:5px;">
            <label for="tp_profecion">Profesi&oacute;n u oficio:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_profecion" id="tp_profecion" style="width:100%;">
                 <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>
        </div>
        <div style="float:left;width:30%;padding:5px;">
            <label for="tp_ocupacion">Ocupaci&oacute;n:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_ocupacion" id="tp_ocupacion" style="width:100%;">
                 <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>
        </div>

        <div style="float:left;padding:5px;">
            <label for="email">Correo electr&oacute;nico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email" value="" style="width:260px;">
        </div>


        <!--CONYUGE ######################################-->
        <div style="width:100%; margin-top:10px;margin-bottom:10px;float:left;border:1px solid  #87BE28;"></div>
        <p class="titulo" style="width:100%;float:left;"> Datos del c&oacute;nyuge:</p>

        <div style="float:left;width:23,5%;padding:5px;">
            <label for="cp_nombre">Primer Nombre:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="cp_nombre" id="cp_nombre" value="">
        </div>
        <div style="float:left;width:23,5%;padding:5px;">
            <label for="cs_nombre">Segundo Nombre:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="cs_nombre" id="cs_nombre" value="">
        </div>
        <div style="float:left;width:23,5%;padding:5px;">
            <label for="cp_apellido">Primer Apellido:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="cp_apellido" id="cp_apellido" value="">
        </div>
        <div style="float:left;width:23,5%;padding:5px;">
            <label for="cs_apellido">Segundo Apellido:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="cs_apellido" id="cs_apellido" value="">
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;width:31.5%;padding:5px;">
            <label for="ctp_estado">Estado:<span  style="color:red">*</span></label><br>
            <select class="_estados requerido_" name="ctp_estado" id="ctp_estado" style="width:100%;">
                <option value="">Seleccione...
                    <?php echo $_opc_estados; ?>
            </select>
        </div>
        <div style="float:left;width:31.5%;padding:5px;">
            <label for="ctp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="ctp_ciudad" id="ctp_ciudad" style="width:100%;">
                <option value="">Seleccione...
            </select>
        </div>


        <div style="float:left;width:31.5%;padding:5px;">
            <label for="c_calle">Calle o Avenida:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="c_calle" id="c_calle" value="" >
        </div>




        <!--DIRECCION ######################################-->
        <div style="width:100%; margin-top:10px;margin-bottom:10px;float:left;border:1px solid  #87BE28;"></div>
        <p class="titulo" style="width:100%;float:left;"> Direcci&oacute;n de Habitaci&oacute;n:</p>

        <div style="float:left;width:31.5%;padding:5px;">
            <label for="dtp_estado">Estado:<span  style="color:red">*</span></label><br>
            <select class="_estados requerido_" name="dtp_estado" id="dtp_estado" style="width:100%;">
                <option value="">Seleccione...
                    <?php echo $_opc_estados; ?>
            </select>
        </div>
        <div style="float:left;width:31.5%;padding:5px;">
            <label for="dtp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_ciudad" id="dtp_ciudad" style="width:100%;">
                <option value="">Seleccione...
            </select>
        </div>


        <div style="float:left;width:31.5%;padding:5px;">
            <label for="d_calle">Calle o Avenida:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="d_calle" id="d_calle" value="" >
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;width:31.5%;padding:5px;">
            <label for="d_urbanizacion">Urbanizaci&oacute;n:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="d_urbanizacion" id="d_urbanizacion" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="d_apartamento">Apartamento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:65px;" type="text" name="d_apartamento" id="d_apartamento" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="d_piso">Piso:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:40px;" type="text" name="d_piso" id="d_piso" value="" >
        </div>

        <div style="float:left;padding:5px;">
            <label for="tp_inmueble">Tipo inmueble:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_inmueble" id="tp_inmueble" style="width:200px;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="ano_vivienda">A&ntilde;os en la vivienda:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="number" name="ano_vivienda" id="ano_vivienda" min="1" max="2000">
        </div>
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="dtp_telefono">Tel&eacute;fono:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_telefono" id="dtp_telefono" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefono" id="d_telefono" value="">
        </div>


        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="canon">Canon de Arrendamiento:</label><br>
            <input  onkeypress="return solo_moneda(event)" style="width:236px;" type="text" name="canon" id="canon" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="canon_nombre">Nombre del Arrendador:</label><br>
            <input onkeypress="return solo_letras(event)" style="width:236px;" type="text" name="canon_nombre" id="canon_nombre" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="dctp_telefono">Tel&eacute;fono del Arrendador:</label><br>
            <select  name="dctp_telefono" id="dctp_telefono" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input  onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="cd_telefono" id="cd_telefono" value="">
        </div>


        <!--DATOS LABORABLES ######################################-->
        <div style="width:100%; margin-top:10px;margin-bottom:10px;float:left;border:1px solid  #87BE28;"></div>
        <p class="titulo" style="width:100%;float:left;"> Datos Laborales:</p>

        <div style="float:left;padding:5px;">
            <label for="n_empresa">Nombre de la empresa:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras3(event)" style="width:236px;" type="text" name="n_empresa" id="n_empresa" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="ramo_empresa">Actividad o ramo:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" style="width:236px;" type="text" name="ramo_empresa" id="ramo_empresa" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="cargo_empresa">Cargo:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" style="width:236px;" type="text" name="cargo_empresa" id="cargo_empresa" value="" >
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="etp_relacion">Relaci&oacute;n laboral:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="etp_relacion" id="etp_relacion" style="width:186px;">
                 <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>
        </div>

        <div style="float:left;padding:5px;">
            <label for="e_antiguo">Antig&uuml;edad:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:65px" type="text" name="e_antiguo" id="e_antiguo" value="" >
        </div>

        <div style="width:100%; padding:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="sueldo">Sueldo b&aacute;sico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px" type="text" name="sueldo" id="sueldo" value="" >Bs.
        </div>
        <div style="float:left;padding:5px;">
            <label for="comision">Bonificaci&oacute;n o comisiones:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px" type="text" name="comision" id="comision" value="" >Bs.
        </div>
        <div style="float:left;padding:5px;">
            <label for="libre_ejercicio">Libre ejercicio de la profesi&oacute;n:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px" type="text" name="libre_ejercicio" id="libre_ejercicio" value="" >Bs.
        </div>
        <div style="float:left;padding:5px;">
            <label for="otros_ingresos">Otros ingresos:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px" type="text" name="otros_ingresos" id="otros_ingresos" value="" >Bs.
        </div>



        <!--DIRECCION EMPRESA ######################################-->
        <div style="width:100%; margin-top:10px;margin-bottom:10px;float:left;border:1px solid  #87BE28;"></div>
        <p class="titulo" style="width:100%;float:left;"> Direcci&oacute;n de Empresa:</p>

        <div style="float:left;width:31.5%;padding:5px;">
            <label for="etp_estado">Estado:<span  style="color:red">*</span></label><br>
            <select  class="_estados requerido_" name="etp_estado" id="etp_estado" style="width:100%;">
                <option value="">Seleccione...
                    <?php echo $_opc_estados; ?>
            </select>
        </div>
        <div style="float:left;width:31.5%;padding:5px;">
            <label for="etp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="etp_ciudad" id="etp_ciudad" style="width:100%;">
                <option value="">Seleccione...
            </select>
        </div>


        <div style="float:left;width:31.5%;padding:5px;">
            <label for="e_calle">Calle o Avenida:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="e_calle" id="e_calle" value="" >
        </div>
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;width:31.5%;padding:5px;">
            <label for="e_urbanizacion">Urbanizaci&oacute;n:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="e_urbanizacion" id="e_urbanizacion" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="e_apartamento">Apartamento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:65px;" type="text" name="e_apartamento" id="e_apartamento" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="e_piso">Piso:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:40px;" type="text" name="e_piso" id="e_piso" value="" >
        </div>

        <div style="float:left;padding:5px;">
            <label for="edctp_telefono">Tel&eacute;fono:</label><br>
            <select class="requerido_" name="edctp_telefono" id="edctp_telefono" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono" id="ecd_telefono" value="">
        </div>

        <!--REFERENCIAS  ######################################-->
        <div style="width:100%; margin-top:10px;margin-bottom:10px;float:left;border:1px solid  #87BE28;"></div>
        <p class="titulo" style="width:100%;float:left;">Referencias Personales:</p>

        <div style="float:left;width:30%;padding:5px;">
            <label for="rtp_ocupacion">Ocupaci&oacute;n:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="rtp_ocupacion" id="rtp_ocupacion" style="width:100%;">
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;width:23,5%;padding:5px;">
            <label for="rp_nombre">Primer Nombre:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rp_nombre" id="rp_nombre" value="">
        </div>
        <div style="float:left;width:23,5%;padding:5px;">
            <label for="rs_nombre">Segundo Nombre:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rs_nombre" id="rs_nombre" value="">
        </div>
        <div style="float:left;width:23,5%;padding:5px;">
            <label for="rp_apellido">Primer Apellido:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rp_apellido" id="rp_apellido" value="">
        </div>
        <div style="float:left;width:23,5%;padding:5px;">
            <label for="rs_apellido">Segundo Apellido:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rs_apellido" id="rs_apellido" value="">
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>


        <div style="float:left;width:31.5%;padding:5px;">
            <label for="rdtp_estado">Estado:<span  style="color:red">*</span></label><br>
            <select class="_estados requerido_" name="rdtp_estado" id="rdtp_estado" style="width:100%;">
                <option value="">Seleccione...
                    <?php echo $_opc_estados; ?>
            </select>
        </div>
        <div style="float:left;width:31.5%;padding:5px;">
            <label for="rdtp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="rdtp_ciudad" id="rdtp_ciudad" style="width:100%;">
                <option value="">Seleccione...
            </select>
        </div>


        <div style="float:left;width:31.5%;padding:5px;">
            <label for="r_calle">Calle o Avenida:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="r_calle" id="r_calle" value="" >
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;width:31.5%;padding:5px;">
            <label for="r_urbanizacion">Urbanizaci&oacute;n:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="r_urbanizacion" id="r_urbanizacion" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="r_apartamento">Apartamento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:65px;" type="text" name="r_apartamento" id="r_apartamento" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="r_piso">Piso:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:40px;" type="text" name="r_piso" id="r_piso" value="" >
        </div>

        <div style="float:left;padding:5px;">
            <label for="rtp_telefono">Tel&eacute;fono:</label><br>
            <select class="requerido_" name="rtp_telefono" id="rtp_telefono" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="r_telefono" id="r_telefono" value="">
        </div>


        <!--REFERENCIAS  ######################################-->
        <div style="width:100%; margin-top:10px;margin-bottom:10px;float:left;border:1px solid  #87BE28;"></div>
        <p class="titulo" style="width:100%;float:left;">Referencias Bancarias:</p>
        <div style="float:left;padding:5px;">
            <label for="tp_banco">Banco:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_banco" id="tp_banco" style="width:246px;">
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>    
        </div>
        <div style="float:left;padding:5px;">
            <label for="cuenta">N&ordm; de Cuenta o TDC:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:236px;" type="text" name="cuenta" id="cuenta" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="tp_cuenta">Tipo de cuenta:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_cuenta" id="tp_cuenta" style="width:145px;">
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>    
        </div>
        <div style="float:left;padding:5px;">
            <label for="cuenta_antiguo">Antig&uuml;edad:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:65px" type="text" name="cuenta_antiguo" id="cuenta_antiguo" value="" >
        </div>

        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="tp_agencia">Agencia:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_agencia" id="tp_agencia" style="width:246px;">
                <option value="">Seleccione...
                    <?php
                    $OpcOfic = execute_sql("get_agencia_all", array());
                    $_opc_agencias = '';
                    foreach ($OpcOfic as $OpcOfi) {
                        echo '  <option value="' . $OpcOfi['id_agencias'] . '">' . $OpcOfi['nombre'];
                    }
                    ?>


            </select>    
        </div>

        <div style="float:left;padding:5px;">
            <label for="tp_producto">Tipo de cuenta:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_producto" id="tp_producto" style="width:145px;">
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>    
        </div>

        <div style="float:left;padding:5px;">
            <label for="numero_bp">N&uacute;mero:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:236px;" type="text" name="numero_bp" id="numero_bp" value="" >
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




