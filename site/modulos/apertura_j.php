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
        <p class="titulo" >Datos De la Empresa:</p>
        <div class="separador_" style=""></div>

        <div style="float:left;padding:5px;">
            <label for="s_apellido">Nombre de la empresa:<span  style="color:red">*</span></label><br>
            <input style="width: 550px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="s_apellido">N&ordm; de r.i.f:<span  style="color:red">*</span></label><br>
            <b>J -</b> <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>

        <!--##################### DIV SEPARADOR ############################--> 
        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="s_apellido">actividad econ&oacute;mica:<span  style="color:red">*</span></label><br>
            <select style="width: 372px;" class="requerido_" name="tp_pais" id="tp_pais" style="width:100%">
                <option value="">Seleccione...
                <option value="C">Venezuela
                <option value="p">Casado
                <option value="p">Viudo
            </select>    
        </div>
        <div style="float:left;padding:5px;">
            <label for="s_apellido">Indique actividad econ&oacute;mica:<span  style="color:red">*</span></label><br>
            <input style="width: 380px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>

        <!--##################### DIV SEPARADOR ############################--> 
        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="s_apellido">Sector econ&oacute;mico:<span  style="color:red">*</span></label><br>
            <input style="width: 762px;"  class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>


        <!--##################### DIV SEPARADOR ############################--> 
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="sueldo">volumen en <br>venta mensual:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:207px;text-align: right;" type="text" name="sueldo" id="sueldo" value="0,00" >Bs.
        </div>

        <div style="float:left;padding:5px;">
            <label for="sueldo">promedio mensual de movimiento <br>de la cuenta en efectivo:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:230px;text-align: right;" type="text" name="sueldo" id="sueldo" value="0,00" >Bs.
        </div>

        <div style="float:left;padding:5px;">
            <label for="sueldo">promedio mensual de movimiento <br>de la cuenta en cheques:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:230px;text-align: right;" type="text" name="sueldo" id="sueldo" value="0,00" >Bs.
        </div>



        <!--DIRECCION EMPRESA ######################################-->
        <p class="titulo" > Direcci&oacute;n de Empresa:</p>
        <div class="separador_" style=""></div>


        <div style="float:left;padding:5px;">
            <label for="etp_estado">Estado:<span  style="color:red">*</span></label><br>
            <select  class="_estados requerido_" name="etp_estado" id="etp_estado" style="width:216px;">
                <option value="">Seleccione...
                    <?php echo $_opc_estados; ?>
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="etp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="etp_ciudad" id="etp_ciudad" style="width:216px;">
                <option value="">Seleccione...
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="etp_ciudad">Municipio:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="etp_ciudad" id="etp_ciudad" style="width:216px;">
                <option value="">Seleccione...
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="e_calle">C&oacute;digo postal:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:79px;" type="text" name="e_calle" id="e_calle" value="" >
        </div>


        <!--##################### DIV SEPARADOR ############################-->  
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <div style="float:left;padding:5px;">
            <label for="e_calle">Calle o Avenida:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:238px;" type="text" name="e_calle" id="e_calle" value="" >
        </div>

        <div style="float:left;padding:5px;">
            <label for="e_urbanizacion">Urbanizaci&oacute;n:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:240px;" type="text" name="e_urbanizacion" id="e_urbanizacion" value="" >
        </div>

        <div style="float:left;padding:5px;">
            <label for="e_ceq"> Edificio / Quinta / torre:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:240px;" type="text" name="d_ceq" id="d_urbanizacion" value="" >
        </div>

        <div style="float:left;padding:5px;">
            <label for="e_Oficina">Oficina:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:60px;" type="text" name="e_Oficina" id="e_Oficina" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="e_piso">Piso:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:30px;" type="text" name="e_piso" id="e_piso" value="" >
        </div>

        <div style="float:left;padding:5px;">
            <label for="e_local">Local:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:40px;" type="text" name="e_local" id="e_local" value="" >
        </div>

        <div style="float:left;padding:5px;">
            <label for="edctp_telefono">Tel&eacute;fono:</label><br>
            <select class="requerido_" name="edctp_telefono" id="edctp_telefono" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono" id="ecd_telefono" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="edctp_telefono2">Otro Tel&eacute;fono:</label><br>
            <select class="requerido_" name="edctp_telefono2" id="edctp_telefono2" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono2" id="ecd_telefono2" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="edctp_telefono2">fax:</label><br>
            <select class="requerido_" name="edctp_telefono2" id="edctp_telefono2" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono2" id="ecd_telefono2" value="">
        </div>


        <!--##################### DIV SEPARADOR ############################-->  
        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="email">Correo electr&oacute;nico:<span  style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email" value="" style="width:515px;">
        </div>
        <div style="float:left;padding:5px;">
            <label for="tp_inmueble">Tipo inmueble:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="tp_inmueble" id="tp_inmueble" style="width:235px;">
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
            <input  onkeypress="return solo_moneda(event)" style="width:170px;" type="text" name="canon" id="canon" value="" > Bs.
        </div>
        <div style="float:left;padding:5px;">
            <label for="canon_nombre">Nombre del Arrendador:</label><br>
            <input onkeypress="return solo_letras(event)" style="width:160px;" type="text" name="canon_nombre" id="canon_nombre" value="" >
        </div>
        <div style="float:left;padding:5px;">
            <label for="dctp_telefono">Tel&eacute;fono del Arrendador:</label><br>
            <select  name="dctp_telefono" id="dctp_telefono" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input  onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="cd_telefono" id="cd_telefono" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="dctp_telefono">Otro Tel&eacute;lefono:</label><br>
            <select  name="dctp_telefono" id="dctp_telefono" style="width:70px;">
                <option value="">
                    <?php echo $_opc_area; ?>
            </select>
            <input  onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="cd_telefono" id="cd_telefono" value="">
        </div>



        <!--EMPRESAS RELACIONADAS ######################################-->
        <p class="titulo" > empresas relacionadas:</p>
        <div class="separador_" style=""></div>


        <?php
        for ($i = 0; $i <= 2; $i++) {
            ?>
            <div style="float:left;padding:5px;">
                <label for="s_apellido">Nombre de la empresa:<span  style="color:red">*</span></label><br>
                <input style="width: 233px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
            </div>
            <div style="float:left;padding:5px;">
                <label for="s_apellido">N&ordm; de r.i.f:<span  style="color:red">*</span></label><br>
                <b>J -</b> <input style="width: 100px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
            </div>
            <div style="float:left;padding:5px;">
                <label for="edctp_telefono">Tel&eacute;fono:</label><br>
                <select class="requerido_" name="edctp_telefono" id="edctp_telefono" style="width:70px;">
                    <option value="">
                        <?php echo $_opc_area; ?>
                </select>
                <input onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono" id="ecd_telefono" value="">
            </div>

            <div style="float:left;padding:5px;">
                <label for="edctp_telefono2">Otro Tel&eacute;fono:</label><br>
                <select class="requerido_" name="edctp_telefono2" id="edctp_telefono2" style="width:70px;">
                    <option value="">
                        <?php echo $_opc_area; ?>
                </select>
                <input onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono2" id="ecd_telefono2" value="">
            </div>
            <?php
        }
        ?>

        <!--PRODUCTOS BANPLUS  ######################################-->
        <p class="titulo" >Datos de los productos que posee en Banplus:</p>
        <div class="separador_" style=""></div>

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
            <div style="float:left;padding:5px;">
                <label for="numero_prod<?= $i; ?>">N&uacute;mero:<span  style="color:red">*</span></label><br>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:240px;" type="text" name="numero_prod<?= $i; ?>" id="numero_prod<?= $i; ?>" value="" >
            </div>

            <?php
        }
        ?>

        <!--REFERENCIAS  ######################################-->
        <p class="titulo" >Referencias Bancarias:</p>
        <div class="separador_" style=""></div>

        <?php
        for ($i = 0; $i <= 2; $i++) {
            ?>

            <div style="float:left;padding:5px;">
                <label for="tp_banco<?= $i; ?>">Banco:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="tp_banco<?= $i; ?>" id="tp_banco<?= $i; ?>" style="width:200px;">
                    <option value="C">Soltero
                    <option value="p">Casado
                    <option value="p">Viudo
                </select>    
            </div>
            <div style="float:left;padding:5px;">
                <label for="cuenta<?= $i; ?>">N&ordm; de Cuenta o TDC:<span  style="color:red">*</span></label><br>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:134px;" type="text" name="cuenta<?= $i; ?>" id="cuenta<?= $i; ?>" value="" >
            </div>
            <div style="float:left;padding:5px;">
                <label for="tp_cuenta<?= $i; ?>">Tipo de cuenta:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="tp_cuenta<?= $i; ?>" id="tp_cuenta<?= $i; ?>" style="width:105px;">
                    <option value = "">Seleccione...               
                        <?php echo $_opc_tp_cuenta; ?>
                </select>    
            </div>

            <div style="float:left;padding:5px;">
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

            <div style="float:left;padding:5px;">
                <label for="ag_origen<?= $i; ?>">Agencia Origen:<span  style="color:red">*</span></label><br>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:108px;" type="text" name="ag_origen<?= $i; ?>" id="ag_origen<?= $i; ?>" value="" >
            </div>


            <?php
        }
        ?>

        <!--REFERENCIAS  ######################################-->
        <p class="titulo" >Referencias Comerciales:</p>
        <div class="separador_" style=""></div>
        <?php
        for ($i = 0; $i <= 1; $i++) {
            ?>
            <div style="float:left;padding:5px;">
                <label for="rc_empresa<?= $i; ?>">Empresa / Comercio:<span  style="color:red">*</span></label><br>
                <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rc_empresa<?= $i; ?>" id="rc_empresa<?= $i; ?>" value="">
            </div>

            <div style="float:left;padding:5px;">
                <label for="rctp_ramo<?= $i; ?>">Activida / Ramo:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="rctp_ramo<?= $i; ?>" id="rctp_ramo<?= $i; ?>" style="width:193px;">
                    <option value="C">Soltero
                    <option value="p">Casado
                    <option value="p">Viudo
                </select>
            </div>

            <div style="float:left;padding:5px;">
                <label for="rtp_telefonoH<?= $i; ?>">Tel&eacute;fono Hab.:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="dtp_telefonoH<?= $i; ?>" id="dtp_telefonoH<?= $i; ?>" style="width:70px;">
                    <option value="">
                        <?php echo $_opc_area; ?>
                </select>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefonoh<?= $i; ?>" id="d_telefonoh<?= $i; ?>" value="">
            </div>

            <div style="float:left;padding:5px;">
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


        <!--DATOS REGISTRO DE LA EMPRESA  ######################################-->
        <p class="titulo" >Datos De registro de la empresa:</p>
        <div class="separador_" style=""></div>

        <div style="float:left;padding:5px;">
            <label for="s_apellido">oficina de registro:<span  style="color:red">*</span></label><br>
            <input style="width: 430px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="s_apellido">N&ordm; registro - tomo - fecha:<span  style="color:red">*</span></label><br>
            <input style="width: 310px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>
        <!--##################### DIV SEPARADOR ############################-->      
        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="etp_estado">Estado:<span  style="color:red">*</span></label><br>
            <select  class="_estados requerido_" name="etp_estado" id="etp_estado" style="width:180px;">
                <option value="">Seleccione...
                    <?php echo $_opc_estados; ?>
            </select>
        </div>
        <div style="float:left;padding:5px;">
            <label for="etp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
            <select class="requerido_" name="etp_ciudad" id="etp_ciudad" style="width:180px;">
                <option value="">Seleccione...
            </select>
        </div>

        <div style="float:left;padding:5px;">
            <label for="cuenta_antiguo2">duraci&oacute;n de la empresa:<span style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:43px" type="number" name="cuenta_antiguo2" id="cuenta_antiguo2" value="" min="0" max="2000">
            <select style="width:100px" class="requerido_" name="cuenta__antiguo_op2" id="cuenta__antiguo_op2">
                <option value="">Seleccione...
                </option><option value="DIAS">Días
                </option><option value="SEMANAS">Semanas
                </option><option value="MESES">Meses
                </option><option value="AÃ‘OS">Años
                </option></select>   
        </div>

        <div style="float:left;padding:5px;">
            <label for="cuenta_antiguo2">empleados:<span style="color:red">*</span></label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:59px" type="number" name="cuenta_antiguo2" id="cuenta_antiguo2" value="" min="0" max="99999999">
        </div>

        <div style="float:left;padding:5px;">
            <label for="s_apellido">representante legal:<span  style="color:red">*</span></label><br>
            <input style="width: 133px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>

        <!--##################### DIV SEPARADOR ############################-->      
        <div style="width:100%; margin-top:10px;float:left;"></div>



        <div style="float:left;padding:5px;">
            <label for="ccfc_nac">Fecha de cierre fiscal:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:126px;" type="text" name="ccfc_nac" id="ccfc_nac" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="canon">capital suscrito:</label><br>
            <input onkeypress="return solo_moneda(event)" style="width:170px;" type="text" name="canon" id="canon" value=""> Bs.
        </div>
        <div style="float:left;padding:5px;">
            <label for="canon">capital pagado:</label><br>
            <input onkeypress="return solo_moneda(event)" style="width:170px;" type="text" name="canon" id="canon" value=""> Bs.
        </div>
        <div style="float:left;padding:5px;">
            <label for="canon">reservas de capital:</label><br>
            <input onkeypress="return solo_moneda(event)" style="width:170px;" type="text" name="canon" id="canon" value=""> Bs.
        </div>

        <!--##################### DIV SEPARADOR ############################-->      
        <div style="width:100%; margin-top:10px;float:left;"></div>

        <div style="float:left;padding:5px;">
            <label for="s_apellido">domicilio fiscal:<span  style="color:red">*</span></label><br>
            <input style="width: 310px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="s_apellido">objeto fiscal:<span  style="color:red">*</span></label><br>
            <input style="width: 430px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>



        <!--DATOS REGISTRO DE LA EMPRESA ULTIMA MODIFICACIOn  ######################################-->
        <p class="titulo" >Datos De registro &uacute;ltima modificaci&oacute;n:</p>
        <div class="separador_" style=""></div>


        <div style="float:left;padding:5px;">
            <label for="ccfc_nac">Fecha:<span  style="color:red">*</span></label><br>
            <input class="requerido_" style="width:80px;" type="text" name="ccfc_nac" id="ccfc_nac" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="s_apellido">objeto fiscal:<span  style="color:red">*</span></label><br>
            <input style="width: 408px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>

        <div style="float:left;padding:5px;">
            <label for="s_apellido">domicilio fiscal:<span  style="color:red">*</span></label><br>
            <input style="width: 230px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
        </div>



        <!--ACCIONISTAS  ######################################-->
        <p class="titulo"  >ACCIONISTAS ACTUALES:</p>
        <div class="separador_" style=""></div>

        <?php
        for ($i = 0; $i <= 4; $i++) {
            ?>
            <div style="float:left;padding:5px;">
                <label for="p_nombre">Nombre / Raz&oacute;n social:<span  style="color:red">*</span></label><br>
                <input style="width: 180px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre" value="">
            </div>
            <div style="float:left;padding:5px;">
                <label for="tp_documento">C.I / R.I.F :<span  style="color:red">*</span></label><br>
                <select name="tp_documento" id="tp_documento" class="requerido_">
                    <option value="">
                    <option value="C">C.I
                    <option value="E">E
                    <option value="P">P
                </select>
                <input style="width: 115px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="n_documento" id="n_documento" value="">
            </div>

            <div style="float:left;padding:5px;">
                <label for="canon">capital suscrito:</label><br>
                <input onkeypress="return solo_moneda(event)" style="width:143px;" type="text" name="canon" id="canon" value="">
            </div>
            <div style="float:left;padding:5px;">
                <label for="canon">%:</label><br>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:40px" type="number" name="cuenta_antiguo2" id="cuenta_antiguo2" value="" min="0" max="99999999">

            </div>
            <div style="float:left;padding:5px;">
                <label for="canon">capital pagado:</label><br>
                <input onkeypress="return solo_moneda(event)" style="width:143px;" type="text" name="canon" id="canon" value="">
            </div>



        <?php } ?>
        <div style="float:left;padding:5px;width: 382px;">
            <br>

        </div>

        <div style="float:left;padding:5px;">
            <label for="canon">TOTAL suscrito:</label><br>
            <input onkeypress="return solo_moneda(event)" style="width:143px;" type="text" name="canon" id="canon" value="">
        </div>
        <div style="float:left;padding:5px;">
            <label for="canon">TOTAL %:</label><br>
            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:40px" type="number" name="cuenta_antiguo2" id="cuenta_antiguo2" value="" min="0" max="99999999">

        </div>
        <div style="float:left;padding:5px;">
            <label for="canon">TOTAL pagado:</label><br>
            <input onkeypress="return solo_moneda(event)" style="width:143px;" type="text" name="canon" id="canon" value="">
        </div>



        <!--PERSONAS AUTORIZADAS A MANTENER RELACION CON LA ENTIDAD  ######################################-->
        <p class="titulo"  >PERSONAS AUTORIZADAS A MANTENER RELACION CON LA ENTIDAD :</p>
        <div class="separador_" style=""></div>

        <?php
        for ($i = 0; $i <= 3; $i++) {
            ?>

            <div style="float:left;padding:5px;">
                <label for="p_nombre">Primer Nombre:<span  style="color:red">*</span></label><br>
                <input style="width: 128px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre" value="">
            </div>
            <div style="float:left;padding:5px;">
                <label for="s_nombre">Segundo Nombre:<span  style="color:red">*</span></label><br>
                <input style="width: 128px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_nombre" id="s_nombre" value="">
            </div>
            <div style="float:left;padding:5px;">
                <label for="p_apellido">Primer Apellido:<span  style="color:red">*</span></label><br>
                <input style="width: 128px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="">
            </div>
            <div style="float:left;padding:5px;">
                <label for="s_apellido">Segundo Apellido:<span  style="color:red">*</span></label><br>
                <input style="width: 128px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
            </div>

            <div style="float:left;padding:5px;">
                <label for="tp_documento">C.I / R.I.F :<span  style="color:red">*</span></label><br>
                <select name="tp_documento" id="tp_documento" class="requerido_">
                    <option value="">
                    <option value="C">C.I
                    <option value="E">E
                    <option value="P">P
                </select>
                <input style="width: 109px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="n_documento" id="n_documento" value="">
            </div>

        <?php } ?>
 <!--##################### DIV SEPARADOR ############################-->      
        <div style="width:100%; margin-top:10px;float:left;"></div>
        <?php
        for ($i = 0; $i <= 3; $i++) {
            ?>
            <div style="float:left;padding:5px;">
                <label for="tp_pais">Nacionalidad:<span  style="color:red">*</span></label><br>
    <!--            <select class="requerido_" name="tp_pais" id="tp_pais" style="width:100%">
                    <option value="">Seleccione...
                    <option value="C">Venezuela
                    <option value="p">Casado
                    <option value="p">Viudo
                </select>-->
                <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais" value="" style="width:100px;">

            </div>

            <div style="float:left;padding:5px;">
                <label for="tp_profecion">Profesi&oacute;n u oficio:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="tp_profecion" id="tp_profecion" style="width:124px;">
                    <option value="">Seleccione...
                        <?php echo $_opc_profesion ?>
                </select>
            </div>

            <div style="float:left;padding:5px;">
                <label for="tp_ocupacion">Ocupaci&oacute;n:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="tp_ocupacion" id="tp_ocupacion" style="width:113px">
                    <option value="">Seleccione...
                    <option value="C">Soltero
                    <option value="p">Casado
                    <option value="p">Viudo
                </select>
            </div>

            <div style="float:left;padding:5px;">
                <label for="dtp_telefonoH">Tel&eacute;fono Hab.:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="dtp_telefonoH" id="dtp_telefonoH" style="width:60px;">
                    <option value="">
                        <?php echo $_opc_area; ?>
                </select>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="d_telefonoh" id="d_telefonoh" value="">
            </div>

            <div style="float:left;padding:5px;">
                <label for="dtp_telefono2">Otro Tel&eacute;fono:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="dtp_telefono2" id="dtp_telefono2" style="width:60px;">
                    <option value="">
                        <?php echo $_opc_area; ?>
                </select>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="d_telefono2" id="d_telefono2" value="">
            </div>

            <div style="float:left;padding:5px;">
                <label for="dtp_celular">Celular:<span  style="color:red">*</span></label><br>
                <select class="requerido_" name="dtp_celular" id="dtp_celular" style="width:60px;">
                    <option value="">
                        <?php echo $_opc_cel; ?>
                </select>
                <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="d_celular" id="d_celular" value="">
            </div>

        <?php } ?>


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




