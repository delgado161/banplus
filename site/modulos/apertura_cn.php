
<?php include 'pre_apertura.php' ?>


<br><br>

<!--<a href="modulos/pdf_cpn.php">sd </a>-->


<form method="POST" id="form_ap_cuenta" enctype="multipart/form-data">

    <div style="background-color:#F4F4F4;overflow:auto;overflow-x:hidden;" class="form_n" > 
        <div id="accordion">
            <h3>Datos Personales:</h3>
            <div>
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
                    <input style="width: 140px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="n_documento" id="n_documento" value="">
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
                            <?php echo $_opc_civil; ?>
                    </select>
                </div>

                <div class="div_form">
                    <label for="g_familiar">Carga familiar:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:80px;" type="number" name="g_familiar" id="g_familiar" min="0" max="100">
                </div>

                <div class="div_form">
                    <label for="tp_sctivida">Actividad Econ&oacute;mica:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="tp_sctivida" id="tp_sctivida" style="width:260px;">
                        <option value="">Seleccione...
                            <?php echo $_opc_acteco; ?>
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
                    <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_ocupacion" id="tp_ocupacion" value="" style="width:287px;">
           
                </div>

                <div class="div_form">
                    <label for="email">Correo electr&oacute;nico:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email" value="" style="width:450px;">
                </div>


            </div>
            <h3> Direcci&oacute;n de Habitaci&oacute;n:</h3>
            <div>
                <div class="div_form">
                    <label for="dtp_estado">Estado:<span  style="color:red">*</span></label><br>
                    <select class="_estados requerido_" name="dtp_estado" id="dtp_estado" style="width:215px;">
                        <option value="">Seleccione...
                            <?php echo $_opc_estados; ?>
                    </select>
                </div>
                <div class="div_form">
                    <label for="dtp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="dtp_ciudad" id="dtp_ciudad" style="width:215px;">
                        <option value="">Seleccione...
                    </select>
                </div>
                <div class="div_form">
                    <label for="d_postal">C&oacute;digo postal:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:79px;" type="text" name="d_postal" id="d_postal" value="" >
                </div>

                <div class="div_form">
                    <label for="d_calle">Calle o Avenida:<span  style="color:red">*</span></label><br>
                    <input size="50" class="requerido_" onkeypress="return solo_letras2(event)" style="width:208px;" type="text" name="d_calle" id="d_calle" value="" >
                </div>

                <!--##################### DIV SEPARADOR ############################-->   
                <div class="sep_2"></div>
                <div class="div_form">
                    <label for="d_urbanizacion">Urbanizaci&oacute;n:<span  style="color:red">*</span></label><br>
                    <input style="width:224px;" class="requerido_" onkeypress="return solo_letras2(event)"  type="text" name="d_urbanizacion" id="d_urbanizacion" value="" >
                </div>
                <div class="div_form">
                    <label for="d_ceq"> Casa / Edificio / Quinta :<span  style="color:red">*</span></label><br>
                    <input style="width:225px;" class="requerido_" onkeypress="return solo_letras2(event)"  type="text" name="d_ceq" id="d_ceq" value="" >
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
                    <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="d_telefonoh" id="d_telefonoh" value="">
                </div>

                <div class="div_form">
                    <label for="dtp_telefono2">Otro Tel&eacute;fono:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="dtp_telefono2" id="dtp_telefono2" style="width:70px;">
                        <option value="">
                            <?php echo $_opc_area; ?>
                    </select>
                    <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="d_telefono2" id="d_telefono2" value="">
                </div>

                <div class="div_form">
                    <label for="dtp_celular">Celular:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="dtp_celular" id="dtp_celular" style="width:70px;">
                        <option value="">
                            <?php echo $_opc_cel; ?>
                    </select>
                    <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="d_celular" id="d_celular" value="">
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
                        <input  onkeypress="return solo_moneda(event)" style="width:235px;text-align: right;" type="text" name="canon" id="canon" value="" > Bs.
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
                        <input  class="telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="cd_telefono" id="cd_telefono" value="">
                    </div>
                </div>
            </div>
            <h3>Datos Laborales:</h3>
            <div>
                <div class="div_form">
                    <label for="n_empresa">Nombre de la empresa:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_letras3(event)" style="width:238px;" type="text" name="n_empresa" id="n_empresa" value="" >
                </div>
                <div class="div_form">
                    <label for="ramo_empresa">Actividad o ramo:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:238px;" type="text" name="ramo_empresa" id="ramo_empresa" value="" >
                </div>
                <div class="div_form">
                    <label for="cargo_empresa">Cargo:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:238px;" type="text" name="cargo_empresa" id="cargo_empresa" value="" >
                </div>

                <!--##################### DIV SEPARADOR ############################-->    
                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="relacion_l">Relaci&oacute;n laboral:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:238px;" type="text" name="relacion_l" id="relacion_l" value="" >

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
                    <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="sueldo" id="sueldo" value="" >Bs.
                </div>
                <div class="div_form">
                    <label for="comision">Bonificaci&oacute;n o comisiones:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="comision" id="comision" value="" >Bs.
                </div>
                <div class="div_form">
                    <label for="libre_ejercicio">Libre ejercicio de la profesi&oacute;n:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="libre_ejercicio" id="libre_ejercicio" value="" >Bs.
                </div>
                <div class="div_form">
                    <label for="otros_ingresos">Otros ingresos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="otros_ingresos" id="otros_ingresos" value="" >Bs.
                </div>

                <!--##################### DIV SEPARADOR ############################-->    
                <div class="sep_2"></div>

                <div style="float:right;padding:5px;">
                    <label for="total_ingresos">Total ingresos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" style="width:350px;background: #e6e6e6;text-align: right;" type="text" name="total_ingresos" id="total_ingresos" value="" readonly >Bs.
                </div>

            </div>

            <h3>Direcci&oacute;n de Empresa:</h3>
            <div>
                <div class="div_form">
                    <label for="etp_estado">Estado:<span  style="color:red">*</span></label><br>
                    <select  class="_estados requerido_" name="etp_estado" id="etp_estado" style="width:215px;">
                        <option value="">Seleccione...
                            <?php echo $_opc_estados; ?>
                    </select>
                </div>
                <div class="div_form">
                    <label for="etp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="etp_ciudad" id="etp_ciudad" style="width:215px;">
                        <option value="">Seleccione...
                    </select>
                </div>
                <div class="div_form">
                    <label for="e_postal">C&oacute;digo postal:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:79px;" type="text" name="e_postal" id="e_postal" value="" >
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
                    <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:259px;" type="text" name="e_ceq" id="e_ceq" value="" >
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
                    <label for="edctp_telefono">Tel&eacute;fono:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="edctp_telefono" id="edctp_telefono" style="width:70px;">
                        <option value="">
                            <?php echo $_opc_area; ?>
                    </select>
                    <input class="telefono_ requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono" id="ecd_telefono" value="">
                </div>

                <div class="div_form">
                    <label for="edctp_telefono2">Otro Tel&eacute;fono:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="edctp_telefono2" id="edctp_telefono2" style="width:70px;">
                        <option value="">
                            <?php echo $_opc_area; ?>
                    </select>
                    <input class="telefono_ requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono2" id="ecd_telefono2" value="">
                </div>
            </div>

            <h3>Datos de los productos que posee en Banplus:</h3>
            <div>

                <?php
                for ($i = 0; $i <= 3; $i++) {
                    ?>

                    <div style = "float:left;padding:5px;">
                        <label for = "tp_producto<?php echo $i; ?>">Tipo de Producto:</label><br>
    <!--                        <select class = "requerido_" name = "tp_producto<?= $i; ?>" id = "tp_producto<?= $i; ?>" style = "width:120px;">
                            <option value = "">Seleccione...
                        <?php echo $_opc_productos
                        ?>
                        </select>    -->
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:145px;" type="text" name="tp_producto<?= $i; ?>" id="tp_producto<?= $i; ?>" value="" >

                    </div>
                    <div class="div_form">
                        <label for="numero_prod<?= $i; ?>">N&uacute;mero:</label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:200px;" type="text" name="numero_prod<?= $i; ?>" id="numero_prod<?= $i; ?>" value="" >
                    </div>

                    <?php
                }
                ?>
            </div>

            <h3>Referencias Bancarias:</h3>
            <div>


                <?php
                for ($i = 0; $i <= 2; $i++) {
                    ?>

                    <div class="div_form">
                        <label for="tp_banco<?= $i; ?>">Banco:</label><br>
                        <input class="" onkeypress="return solo_letras2(event)" style="width:175px;" type="text" name="tp_banco<?= $i; ?>" id="tp_banco<?= $i; ?>" value="" >

                    </div>
                    <div class="div_form">
                        <label for="cuenta<?= $i; ?>">N&ordm; de Cuenta o TDC:</label><br>
                        <input class=" cta_banco" size="24" onkeypress="return solo_numeros(event)" style="width:170px;" type="text" name="cuenta<?= $i; ?>" id="cuenta<?= $i; ?>" value="" >
                    </div>
                    <div class="div_form">
                        <label for="tp_cuenta<?= $i; ?>">Tipo de cuenta:</label><br>
    <!--                        <select class="requerido_" name="tp_cuenta<?= $i; ?>" id="tp_cuenta<?= $i; ?>" style="width:105px;">
                            <option value = "">Seleccione...               
                        <?php echo $_opc_tp_cuenta; ?>
                        </select>    -->
                        <input class=" cta_banco"  onkeypress="return solo_letras(event)" style="width:100px;" type="text" name="tp_cuenta<?= $i; ?>" id="tp_cuenta<?= $i; ?>" value="" >
                    </div>

                    <div class="div_form">
                        <label for="cuenta_antiguo<?= $i; ?>">Miembro Desde:</label><br>
                        <input class=" fechas" style="width:77px;background: #e6e6e6;" type="text" name="cuenta_antiguo<?= $i; ?>" id="cuenta_antiguo<?= $i; ?>" value="" readonly>
                    </div>

                    <!--                    <div class="div_form">
                                            <label for="cuenta_antiguo<?= $i; ?>">Antig&uuml;edad:<span  style="color:red">*</span></label><br>
                                            
                                            
                                            <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:45px" type="number" name="cuenta_antiguo<?= $i; ?>" id="cuenta_antiguo<?= $i; ?>" value="" min="0" max="2000" >
                                            <select style="width:103px" class="requerido_" name="cuenta__antiguo_op<?= $i; ?>" id="cuenta__antiguo_op<?= $i; ?>" >
                                                <option value="">Seleccione...
                                                <option value="DIAS">D&iacute;as
                                                <option value="SEMANAS">Semanas
                                                <option value="MESES">Meses
                                                <option value="AÑOS">A&ntilde;os
                                            </select>   
                                        </div>-->

                    <div class="div_form">
                        <label for="ag_origen<?= $i; ?>">Agencia Origen:</label><br>
                        <input class="" onkeypress="return solo_letras2(event)" style="width:150px;" type="text" name="ag_origen<?= $i; ?>" id="ag_origen<?= $i; ?>" value="" >
                    </div>


                    <?php
                }
                ?>
            </div>

            <h3>Referencias Comerciales:</h3>
            <div>
                <?php
                for ($i = 0; $i <= 1; $i++) {
                    ?>
                    <div class="div_form">
                        <label for="rc_empresa<?= $i; ?>">Empresa / Comercio:<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width: 202px;" onkeypress="return solo_letras2(event)" type="text" name="rc_empresa<?= $i; ?>" id="rc_empresa<?= $i; ?>" value="">
                    </div>

                    <div class="div_form">
                        <label for="rctp_ramo<?= $i; ?>">Activida / Ramo:<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="rctp_ramo<?= $i; ?>" id="rctp_ramo<?= $i; ?>" value="">
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
            </div> 

            <h3>Referencias personales no familiares:</h3>
            <div>
                <?php
                for ($i = 10; $i <= 11; $i++) {
                    ?>
                    <div class="div_form">
                        <label for="rfa_nombre<?= $i; ?>">Nombre y Apellido:<span  style="color:red">*</span></label><br>
                        <input style="width:189px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rfa_nombre<?= $i; ?>" id="rfa_nombre<?= $i; ?>" value="">
                    </div>

                    <div class="div_form">
                        <label for="rf_ocupacion<?= $i; ?>">Ocupaci&oacute;n:<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="rf_ocupacion<?= $i; ?>" id="rf_ocupacion<?= $i; ?>" style="width:149px;">
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
            </div>

            <h3>Datos del c&oacute;nyuge o concubino:</h3>
            <div>

                <div class="div_form">
                    <label for="ccp_nombre">Primer Nombre:</label><br>
                    <input style="width: 173px;" class="" onkeypress="return solo_letras(event)" type="text" name="ccp_nombre" id="ccp_nombre" value="">
                </div>
                <div class="div_form">
                    <label for="ccs_nombre">Segundo Nombre:</label><br>
                    <input style="width: 173px;" onkeypress="return solo_letras(event)" type="text" name="ccs_nombre" id="ccs_nombre" value="">
                </div>
                <div class="div_form">
                    <label for="ccp_apellido">Primer Apellido:</label><br>
                    <input style="width: 173px;" class="" onkeypress="return solo_letras(event)" type="text" name="ccp_apellido" id="ccp_apellido" value="">
                </div>
                <div class="div_form">
                    <label for="ccs_apellido">Segundo Apellido:</label><br>
                    <input style="width: 173px;"  onkeypress="return solo_letras(event)" type="text" name="ccs_apellido" id="ccs_apellido" value="">
                </div>

                <!--##################### DIV SEPARADOR ############################--> 
                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="cctp_documento">N&uacute;mero de identificaci&oacute;n:</label><br>
                    <select name="cctp_documento" id="cctp_documento" class="">
                        <option value="">
                        <option value="C">V
                        <option value="E">E
                        <option value="P">P
                    </select>
                    <input style="width: 140px;" class="" onkeypress="return solo_numeros(event)" type="text" name="n_documento" id="n_documento" value="">
                </div>

                <div class="div_form">
                    <label for="ccnaturalizado">naturalizado N&ordm; C.I anteriol:</label><br>
                    <input style="width: 170px;" class="" onkeypress="return solo_numeros(event)" type="text" name="ccnaturalizado" id="ccnaturalizado" value="">
                </div>

                <div class="div_form">
                    <label for="cctp_nacionalidad">Nacionalidad:</label><br>
                    <select class="" name="cctp_nacionalidad" id="cctp_nacionalidad" style="width:179px; ">
                        <option value="">Seleccione...
                            <?php echo $_opc_tp_nacionalidad; ?>
                    </select>
                </div>

                <div class="div_form">
                    <label for="cctp_sexo" >Sexo:</label>
                    <div style="width:100%;height: 4px;" ></div>
                    M<input type="radio" value="M" name="cctp_sexo">
                    F<input type="radio" value="F" name="cctp_sexo">
                </div>
                <!--##################### DIV SEPARADOR ############################-->
                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="ccfc_nac">Fecha de nacimiento:</label><br>
                    <input class="" style="width:110px;background: #e6e6e6;" type="text" name="ccfc_nac" id="ccfc_nac" value="" readonly>
                </div>

                <div class="div_form">
                    <label for="ccedad">Edad:</label><br>
                    <input class="" style="width:40px;;background: #e6e6e6;" type="text" name="ccedad" id="ccedad" value="" readonly>
                </div>

                <div class="div_form">
                    <label for="cctp_pais">Pa&iacute;s de nacimiento:</label><br>
                    <select class="" name="cctp_pais" id="cctp_pais" style="width: 170px;">
                        <option value="">Seleccione...
                            <?php echo $_opc_tp_pais; ?>
                    </select>
                    <!--<input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais" value="" style="width:238px;">-->

                </div>
                <div class="div_form">
                    <label for="cctp_estado">Estado de nacimiento:</label><br>
                    <input class="" onkeypress="return solo_letras(event)" type="text" name="cctp_estado" id="cctp_estado" value="" style="width:180px;">
                </div>
                <div class="div_form">
                    <label for="cctp_ciudad">Ciudad de nacimiento:</label><br>
                    <input class="" onkeypress="return solo_letras(event)" type="text" name="cctp_ciudad" id="cctp_ciudad" value="" style="width:180px;">
                </div>



                <!--##################### DIV SEPARADOR ############################-->   
                <div class="sep_2"></div>


                <div class="div_form">
                    <label for="cctp_civil">Estado Civil:</label><br>
                    <select style="    width: 115px;" class="" name="cctp_civil" id="cctp_civil">
                        <option value="">Seleccione...
                        <option value="SOLTERO">Soltero
                        <option value="CASADO">Casado
                        <option value="VIUDO">Viudo
                        <option value="DIVORCIADO">Divorciado                
                    </select>
                </div>

                <div class="div_form">
                    <label for="ccg_familiar">Carga familiar:</label><br>
                    <input class="" onkeypress="return solo_numeros(event)" style="width:80px;" type="number" name="ccg_familiar" id="ccg_familiar" min="0" max="100">
                </div>

                <div class="div_form">
                    <label for="cctp_activida">Actividad Econ&oacute;mica:</label><br>
                    <select class="" name="cctp_activida" id="cctp_activida" style="width:260px;">
                        <option value="">Seleccione...

                    </select>
                </div>

                <div class="div_form">
                    <label for="cctp_profecion">Profesi&oacute;n u oficio:</label><br>
                    <select class="" name="cctp_profecion" id="cctp_profecion" style="width:274px;">
                        <option value="">Seleccione...
                            <?php echo $_opc_profesion ?>
                    </select>
                </div>


                <!--##################### DIV SEPARADOR ############################-->  
                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="cctp_ocupacion">Ocupaci&oacute;n:</label><br>
                    <select class="" name="cctp_ocupacion" id="cctp_ocupacion" style="width:300px">
                        <option value="">Seleccione...
                        <option value="C">Soltero
                        <option value="p">Casado
                        <option value="p">Viudo
                    </select>
                </div>

                <div class="div_form">
                    <label for="ccemail">Correo electr&oacute;nico:</label><br>
                    <input class="" onkeypress="return solo_email(event)" type="text" name="ccemail" id="ccemail" value="" style="width:450px;">
                </div>


            </div>


            <h3>INGRESO DEL CONYUGE O CONCUBINO:</h3>
            <div>

                <div class="div_form">
                    <label for="ccsueldo">Sueldo b&aacute;sico:</label><br>
                    <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="ccsueldo" id="ccsueldo" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="cccomision">Bonificaci&oacute;n o comisiones:</label><br>
                    <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="cccomision" id="cccomision" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="cclibre_ejercicio">Libre ejercicio de la profesi&oacute;n:</label><br>
                    <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="cclibre_ejercicio" id="cclibre_ejercicio" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="ccotros_ingresos">Otros ingresos:</label><br>
                    <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="ccotros_ingresos" id="ccotros_ingresos" value="0,00" >Bs.
                </div>

                <!--##################### DIV SEPARADOR ############################-->    
                <div class="sep_2"></div>

                <div style="float:right;padding:5px;">
                    <label for="cctotal_ingresos">Total ingresos:</label><br>
                    <input class="" style="width:350px;background: #e6e6e6;text-align: right;" type="text" name="cctotal_ingresos" id="cctotal_ingresos" value="0,00" readonly >Bs.
                </div>

            </div>


            <h3>INGRESO MENSUAL GRUPO FAMILIAR:</h3>
            <div>


                <div class="div_form">
                    <label for="igf_sueldo">Sueldo b&aacute;sico:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_2" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_sueldo" id="igf_sueldo" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="igf_comision">Bonificaci&oacute;n o comisiones:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_2" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_comision" id="igf_comision" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="igf_libre_ejercicio">Libre ejercicio de la profesi&oacute;n:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_2 " onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_libre_ejercicio" id="igf_libre_ejercicio" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="igf_otros_ingresos">Otros ingresos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_2" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="igf_otros_ingresos" id="igf_otros_ingresos" value="0,00" >Bs.
                </div>

                <!--##################### DIV SEPARADOR ############################-->    
                <div class="sep_2"></div>

                <div style="float:right;padding:5px;">
                    <label for="igf_total_ingresos">Total ingresos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" style="width:350px;background: #e6e6e6;text-align: right;" type="text" name="igf_total_ingresos" id="igf_total_ingresos" value="0,00" readonly >Bs.
                </div>



            </div>


            <h3>GASTOS MENSUAL PROMEDIO DEL GRUPO FAMILIAR:</h3>
            <div>


                <div class="div_form">
                    <label for="gpm_servicios">servicios b&aacute;sicos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="gpm_servicios" id="gpm_servicios" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="gpm_alquiler">alquiler:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="gpm_alquiler" id="gpm_alquiler" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="gpm_telefono">telefon&iacute;a:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="gpm_telefono" id="gpm_telefono" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="gpm_alimentos">alimentos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="gpm_alimentos" id="gpm_alimentos" value="0,00" >Bs.
                </div>


                <!--##################### DIV SEPARADOR ############################-->    
                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="go_estudios">colegios o estudios:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="go_estudios" id="go_estudios" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="go_creditos">cr&eacute;ditos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="go_creditos" id="go_creditos" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="go_tarjetas">tarjeta de cr&eacute;ditos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="go_tarjetas" id="go_tarjetas" value="0,00" >Bs.
                </div>
                <div class="div_form">
                    <label for="go_otros_ingresos">Otros Gastos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ moneda_" onkeypress="return solo_moneda(event)" style="width:155px;text-align: right;" type="text" name="go_otros_ingresos" id="go_otros_ingresos" value="0,00" >Bs.
                </div>

                <div class="div_form">
                    <label for="go_otros_eso">Especifique Otro Gastos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_letras(event)" style="width:155px;text-align: right;" type="text" name="go_otros_eso" id="go_otros_eso" value="" >
                </div>

                <div style="float:right;padding:5px;">
                    <label for="go_total_ingresos">Total ingresos:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" style="width:350px;background: #e6e6e6;text-align: right;" type="text" name="go_total_ingresos" id="go_total_ingresos" value="0,00" readonly >Bs.
                </div>


            </div>



            <h3>Documentos Requeridos:</h3>
            <div>




                <div style="float:left;padding:5px;">
                    <label for="go_total_ingresos" style="font-size: 12px;">Copia legible de la c&eacute;dula de identidad del solicitante, vigente.:<span  style="color:red">*</span></label><br><br>
                    <input type="file" class="custom-file-input">
                </div>
                <div class="separador_" style=""></div>


                <div style="float:left;padding:5px;">
                    <label for="go_total_ingresos" style="font-size: 12px;">Copia del Registro de Informaci&Oacute;n Fiscal RIF del solicitante, vigente.<span  style="color:red">*</span></label><br><br>
                    <input type="file" class="custom-file-input">
                </div>
                <div class="separador_" style=""></div>

                <div style="float:left;padding:5px;">
                    <label for="go_total_ingresos" style="font-size: 12px;">Constancia de trabajo original membretada con firma y sello de la empresa, con vigencia máxima de tres (3) meses indicando ingreso mensual o anual, cargo que desempeña y antigüedad en la empresa (no menor a doce (12) meses). Si es profesional de libre ejercicio certificación de ingresos firmada por un contador p&Uacute;blico colegiado donde indique y confirme la profesi&Iacute;n del solicitante y el origen de los fondos. Si eres estudiante mayor de edad constancia de estudios actualizada.:<span  style="color:red">*</span></label><br><br>
                    <input type="file" class="custom-file-input">
                </div>
                <div class="separador_" style=""></div>


                <div style="float:left;padding:5px;">
                    <label for="go_total_ingresos" style="font-size: 12px;">Una (1) Referencia Bancaria o Comercial de cada uno de los firmantes (excepto a las personas que abren cuenta por primera vez). No más de 30 d&Iacute;as emitidos.:<span  style="color:red">*</span></label><br><br>
                    <input type="file" class="custom-file-input">
                </div>
                <div class="separador_" style=""></div>

                <div style="float:left;padding:5px;">
                    <label for="go_total_ingresos" style="font-size: 12px;">Si eres firma personal copia certificada de los documentos constitutivos de la firma unipersonal debidamente inscritos en el Registro de Comercio, vigente, legible, sellada y firmada por el ente regulador. :<span  style="color:red">*</span></label><br><br>
                    <input type="file" class="custom-file-input">
                </div>
                <div class="separador_" style=""></div>
                <div style="float:left;padding:5px;">
                    <label for="go_total_ingresos" style="font-size: 12px;">Si eres firma personal última declaración de Impuesto Sobre la Renta (ISLR) emitida por el SENIAT.:<span  style="color:red">*</span></label><br><br>
                    <input type="file" class="custom-file-input">
                </div>


            </div>



        </div>








        <!--##################### DIV SEPARADOR ############################-->    
        <div class="sep_2"></div>


        <div style="float:left;padding:5px;width: 95%;text-align: right;margin-top: 20px;">
            <button type="submit" value="Submit">Enviar</button>
        </div>


    </div>
</form>


<?php
/* 
Created on:28/04/2017,11:40:47 AM
Author    :Roberto Delgado
*/




