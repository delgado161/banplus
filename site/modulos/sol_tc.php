<style>
    .form_n input,.form_n select{
        padding:4px;

    }

    .form_n label{
        font-size:10px;
        text-transform: uppercase;
    }

    .form_n {
        font-size:12px;
    }

    .titulo{
        width:100%;
        float:left;
        text-transform: uppercase;
        margin-top: 20px !important;
        margin-bottom: -8px !important;

    }

    .separador_{
        width:100%; margin-bottom:10px;float:left;border:1px solid  #87BE28;
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

$_codigo_areas = ['0248', '0281', '0240', '0243', '0273', '0284', '0241', '0258', '0287', '0212', '0259', '0235', '0251', '0271', '0212', '0287', '0295', '0255', '0293', '0275', '0271', '0212', '0251', '0262'];
$_codigo_cel = ['0412', '0426', '0416', '0424', '0414'];
//
foreach ($_codigo_areas as $codigo) {
    $_opc_area .= '  <option value="' . $codigo . '">' . $codigo;
}

foreach ($_codigo_cel as $codigo) {
    $_opc_cel .= '  <option value="' . $codigo . '">' . $codigo;
}

$profesiones = execute_sql("get_profesiones", array());
$_opc_profesion = '';
foreach ($profesiones as $prof) {
    $_opc_profesion .= '  <option value="' . $prof['id_profesion'] . '">' . $prof['descripcion'];
}

$productos = execute_sql("get_tp_productos", array());
$_opc_productos = '';
foreach ($productos as $prod) {
    $_opc_productos .= '  <option value="' . $prod['id_producto'] . '">' . $prod['tipo'];
}

$tp_cuentas = execute_sql("get_tp_productos", array());
$_opc_tp_cuenta = '';
foreach ($tp_cuentas as $tp_cuenta) {
    $_opc_tp_cuenta .= '  <option value="' . $tp_cuenta['id_cuenta'] . '">' . $tp_cuenta['tipo'];
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
        <p class="titulo" >Datos Personales:</p>
        <div class="separador_" style=""></div>

        <div style="float:left;padding:5px;">
            <label for="p_nombre">Primer Nombre:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="s_nombre">Segundo Nombre:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_nombre" id="s_nombre" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="p_apellido">Primer Apellido:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="s_apellido">Segundo Apellido:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>


        <!--##################### DIV SEPARADOR ############################--> 
        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="tp_documento">N&uacute;mero de documento:<span  style="color:red">*</span></label><br>
            <select name="tp_documento" id="tp_documento" class="requerido_">
                <option value="">
                <option value="C">C.I
                <option value="E">E
                <option value="P">P
            </select>
            <input style="width: 70px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="n_documento" id="n_documento" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="naturalizado">naturalizado N&ordm; C.I anteriol:<span  style="color:red">*</span></label><br>
            <input style="width: 150px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="naturalizado" id="naturalizado" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="s_apellido">N&ordm; de r.i.f:<span  style="color:red">*</span></label><br>
            <b>J -</b> <input style="width: 70px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="s_apellido">pasaporte:<span  style="color:red">*</span></label><br>
            <input style="width: 108px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="fc_nac">Fecha de nacimiento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:110px;" type="text" name="fc_nac" id="fc_nac" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="edad">Edad:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:65px;;background: #e6e6e6;" type="text" name="edad" id="edad" value="" readonly>
        </div>
        <!--##################### DIV SEPARADOR ############################-->
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="tp_pais">Pa&iacute;s de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_pais" id="tp_pais" style="width:100%">
                <option value="">Seleccione...
                <option value="C">Venezuela
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais" value="" style="width:238px;">

        </div>
        <div style="float:left;padding:5px;">
            <label for="tp_estado">Estado de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_estado" id="tp_estado" style="width:100%;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_estado" id="tp_estado" value="" style="width:238px;">
        </div>
        <div style="float:left;padding:5px;">
            <label for="tp_ciudad">Ciudad de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_ciudad" id="tp_ciudad" style="width:100%;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_ciudad" id="tp_ciudad" value="" style="width:238px;">

        </div>



        <!--##################### DIV SEPARADOR ############################-->   
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="tp_sexo" >Sexo:<span  style="color:red">*</span></label>
            <div style="width:100%;height: 4px;" ></div>
            M<input type="radio" value="M" name="tp_sexo">
            F<input type="radio" value="F" name="tp_sexo">
        </div>

        <div style="float:left;padding:5px;">
            <label for="tp_civil">Estado Civil:<span  style="color:red">*</span></label><br>
            <select style="    width: 115px;" class="requerido_" name="tp_civil" id="tp_civil">
                <option value="">Seleccione...
                <option value="SOLTERO(@)">Soltero(@)
                <option value="CASADO(@)">Casado(@)
                <option value="VIUDO(@)">Viudo(@)
                <option value="DIVORCIADO(@)">Divorciado(@)
                <option value="CONCUBINO(@)">Concubino(@)
            </select>
        </div>

        <div style="float:left;padding:5px;">
            <label for="g_familiar">Carga familiar:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:80px;" type="number" name="g_familiar" id="g_familiar" min="0" max="100">
        </div>

        <div style="float:left;padding:5px;">
            <label for="tp_profecion">Profesi&oacute;n u oficio:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_profecion" id="tp_profecion" style="width:290px;">
                <option value="">Seleccione...
                    <?php echo $_opc_profesion ?>
            </select>
        </div>

        <div style="float:left;padding:5px;">
            <label for="e_antiguo">tiempo en el pais:<span  style="color:red">*</span></label><br>
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
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="dtp_telefonoH">Tel&eacute;fono Hab.:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_telefonoH" id="dtp_telefonoH" style="width:60px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="d_telefonoh" id="d_telefonoh" value="">
        </div>



        <div style="float:left;padding:5px;">
            <label for="dtp_celular">Celular:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_celular" id="dtp_celular" style="width:60px;">
                <option value="">
                    <?php echo $_opc_cel; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="d_celular" id="d_celular" value="">
        </div>





        <div style="float:left;padding:5px;">
            <label for="email">Correo electr&oacute;nico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email" value="" style="width:492px;">
        </div>


        <!--CONYUGUE  ######################################-->
        <p class="titulo"  >DATOS DEL C&oacute;NYUGE :</p>
        <div class="separador_" style=""></div>

        <div style="float:left;padding:5px;">
            <label for="p_nombre">Primer Nombre:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="s_nombre">Segundo Nombre:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_nombre" id="s_nombre" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="p_apellido">Primer Apellido:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="s_apellido">Segundo Apellido:<span  style="color:red">*</span></label><br>
            <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>


        <!--##################### DIV SEPARADOR ############################--> 
        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="tp_documento">N&uacute;mero de documento:<span  style="color:red">*</span></label><br>
            <select name="tp_documento" id="tp_documento" class="requerido_">
                <option value="">
                <option value="C">C.I
                <option value="E">E
                <option value="P">P
            </select>
            <input style="width: 70px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="n_documento" id="n_documento" value="">
        </div>


        <div style="float:left;padding:5px;">
            <label for="fc_nac">Fecha de nacimiento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:110px;" type="text" name="fc_nac" id="fc_nac" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="edad">Edad:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:65px;;background: #e6e6e6;" type="text" name="edad" id="edad" value="" readonly>
        </div>

        <div style="float:left;padding:5px;">
            <label for="sueldo">Empresa donde trabaja actualmente:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:260px;text-align: right;" type="text" name="sueldo" id="sueldo" value="" >
        </div> 


        <div style="float:left;padding:5px;">
            <label for="dtp_telefonoH">Tel&eacute;fono Hab.:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_telefonoH" id="dtp_telefonoH" style="width:60px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="d_telefonoh" id="d_telefonoh" value="">
        </div>

        <!--##################### DIV SEPARADOR ############################-->
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="tp_pais">Pa&iacute;s de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_pais" id="tp_pais" style="width:100%">
                <option value="">Seleccione...
                <option value="C">Venezuela
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais" value="" style="width:238px;">

        </div>
        <div style="float:left;padding:5px;">
            <label for="tp_estado">Estado de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_estado" id="tp_estado" style="width:100%;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_estado" id="tp_estado" value="" style="width:238px;">
        </div>
        <div style="float:left;padding:5px;">
            <label for="tp_ciudad">Ciudad de nacimiento:<span  style="color:red">*</span></label><br>
<!--            <select class="requerido_" name="tp_ciudad" id="tp_ciudad" style="width:100%;">
                <option value="">Seleccione...
                <option value="C">Soltero
                <option value="p">Casado
                <option value="p">Viudo
            </select>-->
            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_ciudad" id="tp_ciudad" value="" style="width:238px;">

        </div>

        <div style="float:left;padding:5px;">
            <label for="sueldo">Sueldo mensual:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:229px;text-align: right;" type="text" name="sueldo" id="sueldo" value="0,00" >Bs.
        </div>




        <div style="float:left;padding:5px;">
            <label for="email">Correo electr&oacute;nico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email" value="" style="width:492px;">
        </div>


        <!--DIRECCION ######################################-->
        <p class="titulo" > Direcci&oacute;n de Habitaci&oacute;n:</p>
        <div class="separador_" style=""></div>
        

        <div style="float:left;padding:5px;">
            <label for="dtp_estado">Estado:<span  style="color:red">*</span></label><br>
            <select class="_estados requerido_" name="dtp_estado" id="dtp_estado" style="width:186px;">
                <option value="">Seleccione...
                    <?php echo $_opc_estados; ?>
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="dtp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_ciudad" id="dtp_ciudad" style="width:186px;">
                <option value="">Seleccione...
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="dtp_ciudad">Municipio:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_ciudad" id="dtp_ciudad" style="width:186px;">
                <option value="">Seleccione...
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="dtp_ciudad">Parroquia:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_ciudad" id="dtp_ciudad" style="width:186px;">
                <option value="">Seleccione...
            </select>
        </div>
        
          <!--##################### DIV SEPARADOR ############################-->   
        <div style="width:100%; margin-top:10px;float:left;"></div>
        
        <div style="float:left;padding:5px;">
            <label for="d_calle">C&oacute;digo postal:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:79px;" type="text" name="d_calle" id="d_calle" value="" >
        </div>

        <div style="float:left;padding:5px;">
            <label for="d_calle">Calle:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:208px;" type="text" name="d_calle" id="d_calle" value="" >
        </div>
        
        <div style="float:left;padding:5px;">
            <label for="d_calle">Avenida:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:208px;" type="text" name="d_calle" id="d_calle" value="" >
        </div>

        <!--##################### DIV SEPARADOR ############################-->   
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="d_urbanizacion">Urbanizaci&oacute;n:<span  style="color:red">*</span></label><br>
            <input style="width:225px;" class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="d_urbanizacion" id="d_urbanizacion" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="d_ceq"> Casa / Edificio / Quinta :<span  style="color:red">*</span></label><br>
            <input style="width:225px;" class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="d_ceq" id="d_urbanizacion" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="d_piso">Piso:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:38px;" type="text" name="d_piso" id="d_piso" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="d_apartamento">Apartamento:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:75px;" type="text" name="d_apartamento" id="d_apartamento" value="">
        </div>


        <div style="float:left;padding:5px;">
            <label for="ano_vivienda">A&ntilde;os en la vivienda:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:110px;" type="number" name="ano_vivienda" id="ano_vivienda" min="0" max="2000">
        </div>



        <!--##################### DIV SEPARADOR ############################-->    
        <div style="width:100%; margin-top:10px;float:left;"></div>


        <div style="float:left;padding:5px;">
            <label for="dtp_telefonoH">Tel&eacute;fono Hab.:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_telefonoH" id="dtp_telefonoH" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefonoh" id="d_telefonoh" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="dtp_telefono2">Otro Tel&eacute;fono:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_telefono2" id="dtp_telefono2" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefono2" id="d_telefono2" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="dtp_celular">Celular:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="dtp_celular" id="dtp_celular" style="width:70px;">
                <option value="">
                    <?php echo $_opc_cel; ?>
            </select>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_celular" id="d_celular" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="tp_inmueble">Tipo inmueble:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_inmueble" id="tp_inmueble" style="width:189px;">
                <option value="">Seleccione...
                <option value="P">Propia
                <option value="A">Arrendada
                <option value="O">Otros
            </select>
        </div>

        <!--##################### DIV SEPARADOR ############################-->      
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="canon">Canon de Arrendamiento:</label><br>
            <input  onkeypress="return solo_moneda(event)" style="width:236px;" type="text" name="canon" id="canon" value="" > Bs.
        </div>
        <div style="float:left;padding:5px;">
            <label for="canon_nombre">Nombre del Arrendador:</label><br>
            <input onkeypress="return solo_letras(event)" style="width:288px;" type="text" name="canon_nombre" id="canon_nombre" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="dctp_telefono">Tel&eacute;fono del Arrendador:</label><br>
            <select  name="dctp_telefono" id="dctp_telefono" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input  onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="cd_telefono" id="cd_telefono" value="">
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




