<br><br>

<?php include 'pre_apertura.php' ?>
<?php include 'envia_correos.php'; ?>

<?php if (!isset($_POST['p_formulario'])) { ?>
    <form method="POST" id="form_ap_cuenta" enctype="multipart/form-data">
        <input   type="hidden" name="p_formulario" id="p_formulario" value="NATURAL">

        <div style="background-color:#F4F4F4;overflow:auto;overflow-x:hidden;" class="form_n" > 
            <div id="accordion">
                <h3>Datos Personales<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span> </h3>
                <div>
                    <div class="div_form">
                        <label for="p_nombre">Primer Nombre<span  style="color:red">*</span></label><br>
                        <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_nombre">Segundo Nombre:</label><br>
                        <input style="width: 173px;" onkeypress="return solo_letras(event)" type="text" name="s_nombre" id="s_nombre" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="p_apellido">Primer Apellido<span  style="color:red">*</span></label><br>
                        <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_apellido">Segundo Apellido:</label><br>
                        <input style="width: 173px;"  onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="" maxlength="50">
                    </div>

                    <!--##################### DIV SEPARADOR ############################--> 
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="tp_documento">C&eacute;dula de Identidad<span  style="color:red">*</span></label><br>
                        <select name="tp_documento" id="tp_documento" class="requerido_">
                            <option value="">
                            <option value="C">V
                            <option value="E">E
                        </select>
                        <input style="width: 130px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="n_documento" id="n_documento" value="">
                    </div>

                    <div class="div_form">
                        <label for="rif">N&ordm; de r.i.f<span  style="color:red">*</span></label><br>
                        <b>J -</b> <input style="width: 173px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="rif" id="rif" value="">
                    </div>

                    <div class="div_form">
                        <label for="pasaporte">Pasaporte<span  style="color:red">*</span></label><br>
                        <input style="width: 158px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="pasaporte" id="pasaporte" value="">
                    </div>

                    <div class="div_form">
                        <label for="naturalizado">naturalizado N&ordm; C.I anterior:</label><br>
                        <input style="width: 170px;" class="" onkeypress="return solo_numeros(event)" type="text" name="naturalizado" id="naturalizado" value="">
                    </div>

                    <!--                    <div class="div_form">
                                            <label for="tp_nacionalidad">Nacionalidad<span  style="color:red">*</span></label><br>
                                            <select class="requerido_" name="tp_nacionalidad" id="tp_nacionalidad" style="width:179px; ">
                                                <option value="">Seleccione...
                    <?php echo $_opc_tp_nacionalidad; ?>
                                            </select>
                                        </div>-->

                    <!--##################### DIV SEPARADOR ############################-->
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="fc_nac">Fecha de nacimiento<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="fc_nac" id="fc_nac" value="" readonly>
                    </div>

                    <div class="div_form">
                        <label for="edad">Edad<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:40px;;background: #e6e6e6;" type="text" name="edad" id="edad" value="" readonly>
                    </div>



                    <div class="div_form">
                        <label for="tp_pais">Pa&iacute;s de nacimiento<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="tp_pais" id="tp_pais" style="width: 130px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_tp_pais; ?>
                        </select>
                        <!--<input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais" value="" style="width:238px;">-->

                    </div>
                    <div class="div_form">
                        <label for="tp_estado">Estado de nacimiento<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_estado" id="tp_estado" value="" style="width:160px;" maxlength="100">
                    </div>
                    <div class="div_form">
                        <label for="tp_ciudad">Ciudad de nacimiento<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_ciudad" id="tp_ciudad" value="" style="width:170px;" maxlength="100">
                    </div>

                    <div class="div_form">
                        <label for="tp_sexo" >Sexo<span  style="color:red">*</span></label>
                        <div style="width:100%;height: 4px;" ></div>
                        M<input type="radio" value="M" name="tp_sexo">
                        F<input type="radio" value="F" name="tp_sexo">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="e_antiguo">Tiempo en el pa&iacute;s<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px" type="number" name="e_antiguo" id="e_antiguo" value="" min="0" max="2000" maxlength="2">
                        <select class="requerido_" name="e_antiguo_op" id="e_antiguo_op" style="">
                            <option value="">Seleccione...
                            <option value="DIAS">D&iacute;as
                            <option value="SEMANAS">Semanas
                            <option value="MESES">Meses
                            <option value="AÑOS">A&ntilde;os
                        </select>   
                    </div>

                    <div class="div_form">
                        <label for="tp_civil">Estado Civil<span  style="color:red">*</span></label><br>
                        <select style="    width: 115px;" class="requerido_" name="tp_civil" id="tp_civil">
                            <option value="">Seleccione...
                                <?php echo $_opc_civil; ?>
                        </select>
                    </div>

                    <div class="div_form">
                        <label for="g_familiar">Carga familiar<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:80px;" type="number" name="g_familiar" id="g_familiar" min="0" max="99" maxlength="2">
                    </div>

                    <!--                    <div class="div_form">
                                            <label for="tp_sctivida">Actividad Econ&oacute;mica<span  style="color:red">*</span></label><br>
                                            <select class="requerido_" name="tp_sctivida" id="tp_sctivida" style="width:260px;">
                                                <option value="">Seleccione...
                    <?php echo $_opc_acteco; ?>
                                            </select>
                                        </div>-->

                    <div class="div_form">
                        <label for="tp_profecion">Profesi&oacute;n u oficio<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="tp_profecion" id="tp_profecion" style="width:174px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_profesion ?>
                        </select>
                    </div>


                    <div class="div_form">
                        <label for="dtp_telefonoH">Tel&eacute;fono Hab.<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_telefonoH" id="dtp_telefonoH" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="d_telefonoh" id="d_telefonoh" value="">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->  
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="dtp_telefono2">Otro Tel&eacute;fono<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_telefono2" id="dtp_telefono2" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="d_telefono2" id="d_telefono2" value="">
                    </div>

                    <div class="div_form">
                        <label for="dtp_celular">Celular<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_celular" id="dtp_celular" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_cel; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="d_celular" id="d_celular" value="">
                    </div>


                    <!--                    <div class="div_form">
                                            <label for="tp_ocupacion">Ocupaci&oacute;n<span  style="color:red">*</span></label><br>
                                            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_ocupacion" id="tp_ocupacion" value="" style="width:287px;" maxlength="100">
                    
                                        </div>-->

                    <div class="div_form">
                        <label for="email">Correo electr&oacute;nico<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email" value="" style="width:372px;">
                    </div>


                </div>
                <h3>Datos del c&oacute;nyuge o concubino<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div class="cc_banplus"> 

                    <div class="div_form">
                        <label for="ccp_nombre">Primer Nombre:</label><br>
                        <input style="width: 173px;" class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="ccp_nombre" id="ccp_nombre" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="ccs_nombre">Segundo Nombre:</label><br>
                        <input class="valida_prod" style="width: 173px;" onkeypress="return solo_letras(event)" type="text" name="ccs_nombre" id="ccs_nombre" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="ccp_apellido">Primer Apellido:</label><br>
                        <input style="width: 173px;" class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="ccp_apellido" id="ccp_apellido" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="ccs_apellido">Segundo Apellido:</label><br>
                        <input class="valida_prod" style="width: 173px;"  onkeypress="return solo_letras(event)" type="text" name="ccs_apellido" id="ccs_apellido" value="" maxlength="50">
                    </div>

                    <!--##################### DIV SEPARADOR ############################--> 
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="cctp_documento">C&eacute;dula de identidad:</label><br>
                        <select name="cctp_documento" id="cctp_documento" class="valida_prod">
                            <option value="">
                            <option value="C">V
                            <option value="E">E
                        </select>
                        <input style="width: 139px;" class="valida_prod" onkeypress="return solo_numeros(event)" type="text" name="CCn_documento" id="CCn_documento" value="" maxlength="8">
                    </div>




                    <div class="div_form">
                        <label for="ccfc_nac">Fecha de nacimiento:</label><br>
                        <input class="valida_prod" style="width:110px;background: #e6e6e6;" type="text" name="ccfc_nac" id="ccfc_nac" value="" readonly>
                    </div>

                    <div class="div_form">
                        <label for="ccedad">Edad:</label><br>
                        <input class="valida_prod" style="width:40px;;background: #e6e6e6;" type="text" name="ccedad" id="ccedad" value="" readonly>
                    </div>

                    <div class="div_form">
                        <label for="cctp_pais">Pa&iacute;s de nacimiento:</label><br>
                        <select class="valida_prod" name="cctp_pais" id="cctp_pais" style="width: 170px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_tp_pais; ?>
                        </select>
                        <!--<input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais" value="" style="width:238px;">-->

                    </div>
                    <div class="div_form">
                        <label for="cctp_estado">Estado de nacimiento:</label><br>
                        <input class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="cctp_estado" id="cctp_estado" value="" style="width:180px;" maxlength="100">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="cctp_ciudad">Ciudad de nacimiento:</label><br>
                        <input class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="cctp_ciudad" id="cctp_ciudad" value="" style="width:180px;" maxlength="100">
                    </div>


                    <div class="div_form">
                        <label for="cct_empresa_">Empresa donde trabaja actualmente:</label><br>
                        <input class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="cct_empresa_" id="cct_empresa_" value="" style="width:355px;" maxlength="100">

                    </div>

                    <div class="div_form">
                        <label for="ccsueldo">Sueldo b&aacute;sico:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:164px;text-align: right;" type="text" name="ccsueldo" id="ccsueldo" value="0,00" >Bs.
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="dcc_dtp_telefonoH">Tel&eacute;fono Hab.<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dcc_dtp_telefonoH" id="dtp_telefonoH" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="dcc_d_telefonoh" id="dcc_d_telefonoh" value="">
                    </div>

                    <div class="div_form">
                        <label for="dcc_dtp_telefono2">Otro Tel&eacute;fono<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dcc_dtp_telefono2" id="dcc_dtp_telefono2" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="dcc_d_telefono2" id="dcc_d_telefono2" value="">
                    </div>

                    <div class="div_form">
                        <label for="ccemail">Correo electr&oacute;nico:</label><br>
                        <input class="valida_prod" onkeypress="return solo_email(event)" type="text" name="ccemail" id="ccemail" value="" style="width:370px;">
                    </div>


                </div>


                <h3> Direcci&oacute;n de Habitaci&oacute;n<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="dtp_estado">Estado<span  style="color:red">*</span></label><br>
                        <select class="_estados requerido_" name="dtp_estado" id="dtp_estado" style="width:185px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_estados; ?>
                        </select>
                    </div>
                    <div class="div_form">
                        <label for="dtp_ciudad">Cuidad<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_ciudad" id="dtp_ciudad" style="width:185px;">
                            <option value="">Seleccione...
                        </select>
                    </div>

                    <div class="div_form municipio">
                        <label for="dtp_municipio">Municipio<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_municipio" id="dtp_municipio" style="width:185px;">
                            <option value="">Seleccione...
                        </select>
                    </div>


                    <div class="div_form municipio">
                        <label for="dtp_parroquia">Parroquia<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_parroquia" id="dtp_parroquia" style="width:185px;">
                            <option value="">Seleccione...
                        </select>
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="d_postal">C&oacute;digo postal<span  style="color:red">*</span></label><br>
                        <select class=" requerido_" name="d_postal" id="d_postal" style="width:92px;">
                            <option value="">
                                <?php echo $_postal; ?>
                        </select>
                    </div>

                    <div class="div_form">
                        <label for="d_calle">Calle<span  style="color:red">*</span></label><br>
                        <input  class="requerido_" onkeypress="return solo_letras2(event)" style="width:208px;" type="text" name="d_calle" id="d_calle" value="" maxlength="250">
                    </div>

                    <div class="div_form">
                        <label for="d_avenida">Avenida<span  style="color:red">*</span></label><br>
                        <input  class="requerido_" onkeypress="return solo_letras2(event)" style="width:208px;" type="text" name="d_avenida" id="d_avenida" value="" maxlength="250">
                    </div>


                    <div class="div_form">
                        <label for="d_urbanizacion">Urbanizaci&oacute;n / Sector / Barrio<span  style="color:red">*</span></label><br>
                        <input style="width:198px;" class="requerido_" onkeypress="return solo_letras2(event)"  type="text" name="d_urbanizacion" id="d_urbanizacion" value="" maxlength="250">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="d_ceq"> Tipo de vivienda <span  style="color:red">*</span></label><br>
                        <select class=" requerido_" name="d_ceq" id="d_ceq" style="width:92px;">
                            <option value="CASA">Casa</option>
                            <option value="EDIFICIO">Edificio</option>
                            <option value="QUINTA">Quinta</option>

                        </select>
                        <input style="width:95px;" class="requerido_" onkeypress="return solo_letras2(event)"  type="text" name="d_ceq2" id="d_ceq2" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="d_piso">Piso<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:38px;" type="text" name="d_piso" id="d_piso" value="" maxlength="2">
                    </div>
                    <div class="div_form">
                        <label for="d_apartamento">Apartamento<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:75px;" type="text" name="d_apartamento" id="d_apartamento" value="" maxlength="8">
                    </div>

                    <div class="div_form">
                        <label for="dcc_dtp_telefono2_">Tel&eacute;fono Hab.<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dcc_dtp_telefono2_" id="dcc_dtp_telefono2" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="dcc_d_telefono2__" id="dcc_d_telefono2__" value="">
                    </div>


                    <div class="div_form">
                        <label for="tp_inmueble">Vivienda<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="tp_inmueble" id="tp_inmueble" style="width:208px;">
                            <option value="">Seleccione...
                            <option value="DE MIS PADRES">De mis padres
                            <option value="PROPIA">Propia
                            <option value="DE UN FAMILIAR">De un Familiar
                            <option value="ALQUILADA">Alquilada
                        </select>
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="ano_vivienda">Si la vivienda es propia,<br>indique a&ntilde;os de adquisici&oacute;n<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:152px;" type="number" name="ano_vivienda" id="ano_vivienda" min="0" max="2000" maxlength="2">
                    </div>


                    <div class="div_form">
                        <label for="canon">Alquiler o<br> Cuota Hipotecaria:</label><br>
                        <input class="" onkeypress="return solo_moneda(event)" style="width:100px;text-align: right;" type="text" name="canon" id="canon" value="" > Bs.
                    </div>

                    <div class="div_form">
                        <label for="ano_vivienda">A&ntilde;os en esta<br> direcci&oacute;n<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="number" name="ano_vivienda2" id="ano_vivienda2" min="0" max="2000" maxlength="2">
                    </div>

                    <div class="div_form">
                        <label for="canon_nombre">Nombre del Acreedor<br>Hipotecario o Arrendador:</label><br>
                        <input class="" onkeypress="return solo_letras(event)" style="width:147px;" type="text" name="canon_nombre" id="canon_nombre" value="" >
                    </div>

                    <div class="div_form">
                        <label for="canon_credito">N&uacute;mero<br>de Cr&eacute;dito:</label><br>
                        <input class="" onkeypress="return solo_letras(event)" style="width:147px;" type="text" name="canon_credito" id="canon_credito" value="" >
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="dctp_telefono">Tel&eacute;fono del Arrendador:</label><br>
                        <select  class="" name="dctp_telefono" id="dctp_telefono" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input   class="telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="cd_telefono" id="cd_telefono" value="">
                    </div>

                </div>

                <h3>Otras propiedades<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="n_empresa">Otras Propiedades que posee:<span  style="color:red">*</span></label><br>
                        <input type="checkbox" name="group1[]" value="APARTAMENTOS" /> Apartamentos
                        <input type="checkbox" name="group1[]"  value="TERRENOS" />Terrenos
                        <input type="checkbox" name="group1[]" value="LOCALES" />Locales
                        <input type="checkbox" name="group1[]" value="OTROS" />Otros
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="automovil_">Automovil</label><br>
                        <input class="" onkeypress="return solo_letras(event)" style="width:173px;" type="text" name="automovil_" id="automovil_" value="" maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="auto_model">Modelo</label><br>
                        <input class="" onkeypress="return solo_letras(event)" style="width:173px;" type="text" name="auto_model" id="auto_model" value="" maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="auto_ano">A&ntilde;o</label><br>
                        <input class="" onkeypress="return solo_letras(event)" style="width:173px;" type="text" name="auto_ano" id="auto_ano" value="" maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="auto_placa">Placa</label><br>
                        <input class="" onkeypress="return solo_letras(event)" style="width:173px;" type="text" name="auto_ano" id="auto_ano" value="" maxlength="250">
                    </div>
                </div>

                <h3>Referencias personales familiares o personales<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <?php
                    for ($i = 10; $i <= 11; $i++) {
                        ?>
                        <div class="div_form">
                            <label for="rfa_nombre<?= $i; ?>">Nombre y Apellido<span  style="color:red">*</span></label><br>
                            <input style="width:165px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rfa_nombre<?= $i; ?>" id="rfa_nombre<?= $i; ?>" value="" maxlength="100">
                        </div>

                        <div class="div_form">
                            <label for="rf_parentesco<?= $i; ?>">Parentesco<span  style="color:red">*</span></label><br>
                            <input  style="width:115px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rf_parentesco<?= $i; ?>" id="rf_parentesco<?= $i; ?>" value="" maxlength="100">

                        </div>
                        <div class="div_form">
                            <label for="rf_direccion<?= $i; ?>">Ciudad<span  style="color:red">*</span></label><br>
                            <input  style="width:126px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="rf_direccion<?= $i; ?>" id="rf_direccion<?= $i; ?>" value="" maxlength="250">
                        </div>
                        <div class="div_form">
                            <label for="rtp_telefonoH<?= $i; ?>">Tel&eacute;fono.<span  style="color:red">*</span></label><br>
                            <select class="requerido_" name="dtp_telefonoH<?= $i; ?>" id="dtp_telefonoH<?= $i; ?>" style="width:50px;">
                                <option value="">
                                    <?php echo $_opc_area; ?>
                            </select>
                            <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:80px;" type="text" name="d_telefonoh<?= $i; ?>" id="d_telefonoh<?= $i; ?>" value="">
                        </div>
                        <div class="div_form">
                            <label for="2_dtp_telefonoH<?= $i; ?>">Tel&eacute;fono.<span  style="color:red">*</span></label><br>
                            <select class="requerido_" name="2_dtp_telefonoH<?= $i; ?>" id="2_dtp_telefonoH<?= $i; ?>" style="width:50px;">
                                <option value="">
                                    <?php echo $_opc_area; ?>
                            </select>
                            <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:80px;" type="text" name="2_d_telefonoh<?= $i; ?>" id="2_d_telefonoh<?= $i; ?>" value="">
                        </div>
                        <?php
                    }
                    ?>
                </div>


                <h3>Datos Laborales<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="n_empresa">Empresa donde trabaja (Actual)<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" style="width:260px;" type="text" name="n_empresa" id="n_empresa" value="" maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="ramo_empresa">Sector Econ&oacute;mico<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" style="width:230px;" type="text" name="ramo_empresa" id="ramo_empresa" value="" maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="cargo_empresa">Cargo<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" style="width:226px;" type="text" name="cargo_empresa" id="cargo_empresa" value="" maxlength="100">
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->    
                    <!--<div class="sep_2"></div>-->

                    <!--                    <div class="div_form">
                                            <label for="relacion_l">Relaci&oacute;n laboral<span  style="color:red">*</span></label><br>
                                            <input class="requerido_" onkeypress="return solo_letras(event)" style="width:238px;" type="text" name="relacion_l" id="relacion_l" value="" >
                    
                                        </div>-->




                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>


                    <div class="div_form">
                        <label for="e_antiguo">Antig&uuml;edad<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px" type="number" name="e_antiguo" id="e_antiguo" value="" min="0" max="2000" maxlength="2">
                        <select class="requerido_" name="e_antiguo_op" id="e_antiguo_op" style="">
                            <option value="">Seleccione...
                            <option value="DIAS">D&iacute;as
                            <option value="SEMANAS">Semanas
                            <option value="MESES">Meses
                            <option value="AÑOS">A&ntilde;os
                        </select>   
                    </div>

                    <div class="div_form">
                        <label for="sueldo">Sueldo Mensual<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:115px;text-align: right;" type="text" name="sueldo" id="sueldo" value="" >Bs.
                    </div>
                    <!--                    <div class="div_form">
                                            <label for="comision">Bonificaci&oacute;n <br>o comisiones<span  style="color:red">*</span></label><br>
                                            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:115px;text-align: right;" type="text" name="comision" id="comision" value="" >Bs.
                                        </div>
                                        <div class="div_form">
                                            <label for="libre_ejercicio">Libre ejercicio <br>profesi&oacute;n<span  style="color:red">*</span></label><br>
                                            <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:115px;text-align: right;" type="text" name="libre_ejercicio" id="libre_ejercicio" value="" >Bs.
                                        </div>-->
                    <div class="div_form">
                        <label for="otros_ingresos">Otros ingresos<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:115px;text-align: right;" type="text" name="otros_ingresos" id="otros_ingresos" value="" >Bs.
                    </div>

                    <div class="div_form">
                        <label for="concepto_empresa">por concepto de:<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" style="width:275px;" type="text" name="concepto_empresa" id="concepto_empresa" value="" maxlength="100">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="n_empresa2">Nombre de la empresa donde trabajo anteriolmente<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" style="width:300px;" type="text" name="n_empresa2" id="n_empresa2" value="" maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="ramo_empresa2">Sector Econ&oacute;mico<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" style="width:220px;" type="text" name="ramo_empresa2" id="ramo_empresa2" value="" maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="cargo_empresa2">Cargo<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" style="width:196px;" type="text" name="cargo_empresa2" id="cargo_empresa2" value="" maxlength="100">
                    </div>



                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="sueldo2">Ingreso Mensual<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:115px;text-align: right;" type="text" name="sueldo2" id="sueldo2" value="" >Bs.
                    </div>

                    <div class="div_form">
                        <label for="fc_egreso">Fecha de Egreso<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="fc_egreso" id="fc_egreso" value="" readonly>
                    </div>


                    <div class="div_form">
                        <label for="e_antiguo2">Tiempo en la empresa<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px" type="number" name="e_antiguo2" id="e_antiguo2" value="" min="0" max="2000" maxlength="2">
                        <select class="requerido_" name="e_antiguo_op2" id="e_antiguo_op" style="">
                            <option value="">Seleccione...
                            <option value="DIAS">D&iacute;as
                            <option value="SEMANAS">Semanas
                            <option value="MESES">Meses
                            <option value="AÑOS">A&ntilde;os
                        </select>   
                    </div>




                    <!--                    <div class="div_form">
                                            <label for="total_ingresos">Total <br>ingresos<span  style="color:red">*</span></label><br>
                                            <input class="requerido_" style="width:120px;background: #e6e6e6;text-align: right;" type="text" name="total_ingresos" id="total_ingresos" value="" readonly >Bs.
                                        </div>-->

                </div>

                <h3>Direcci&oacute;n de Empresa actual<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="etp_estado">Estado<span  style="color:red">*</span></label><br>
                        <select  class="_estados requerido_" name="etp_estado" id="etp_estado" style="width:185px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_estados; ?>
                        </select>
                    </div>
                    <div class="div_form">
                        <label for="etp_ciudad">Cuidad<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="etp_ciudad" id="etp_ciudad" style="width:185px;">
                            <option value="">Seleccione...
                        </select>
                    </div>

                    <div class="div_form municipio">
                        <label for="etp_municipio">Municipio<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="etp_municipio" id="etp_municipio" style="width:185px;">
                            <option value="">Seleccione...
                        </select>
                    </div>


                    <div class="div_form municipio">
                        <label for="etp_parroquia">Parroquia<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="etp_parroquia" id="etp_parroquia" style="width:185px;">
                            <option value="">Seleccione...
                        </select>
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="e_postal">Zona postal<span  style="color:red">*</span></label><br>
                        <select class="_estados requerido_" name="e_postal" id="e_postal" style="width:92px;">
                            <option value="">
                                <?php echo $_postal; ?>
                        </select>
                    </div>


                    <div class="div_form">
                        <label for="e_avenida">Avenida<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:197px;" type="text" name="e_avenida" id="e_avenida" value="" maxlength="250">
                    </div>

                    <div class="div_form">
                        <label for="e_calle">Calle<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:197px;" type="text" name="e_calle" id="e_calle" value="" maxlength="250">
                    </div>

                    <div class="div_form">
                        <label for="e_urbanizacion">Urbanizaci&oacute;n / Sector / Barrio<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:220px;" type="text" name="e_urbanizacion" id="e_urbanizacion" value="" maxlength="250">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="d_ceq"> Tipo del &aacute;rea de la residencia <span  style="color:red">*</span></label><br>
                        <select class=" requerido_" name="ee_ceq" id="d_ceq" style="width:92px;">
                            <option value="">Seleccione...</option>
                            <option value="QUINTA">Quinta</option>
                            <option value="EDIFICIO">Edificio</option>
                            <option value="C.C">C.C</option>

                        </select>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:205px;" type="text" name="e_ceq" id="e_ceq" value="" maxlength="50">

                    </div>


                    <div class="div_form">
                        <label for="e_piso">Piso<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:40px;" type="text" name="e_piso" id="e_piso" value="" maxlength="2">
                    </div>

                    <div class="div_form">
                        <label for="e_Oficina">Oficina<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:70px;" type="text" name="e_Oficina" id="e_Oficina" value="" maxlength="8">
                    </div>



                    <!--                    <div class="div_form">
                                            <label for="e_local">Local<span  style="color:red">*</span></label><br>
                                            <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:43px;" type="text" name="e_local" id="e_local" value="" maxlength="8">
                                        </div>-->

                    <div class="div_form">
                        <label for="edctp_telefono">Tel&eacute;fono<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="edctp_telefono" id="edctp_telefono" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="telefono_ requerido_" onkeypress="return solo_numeros(event)" style="width:55px;" type="text" name="ecd_telefono" id="ecd_telefono" value="">
                    </div>

                    <div class="div_form">
                        <label for="edctp_telefono2">Otro Tel&eacute;fono<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="edctp_telefono2" id="edctp_telefono2" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="telefono_ requerido_" onkeypress="return solo_numeros(event)" style="width:60px;" type="text" name="ecd_telefono2" id="ecd_telefono2" value="">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="edctp_fax">fax<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="edctp_fax" id="edctp_fax" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_fax" id="ecd_fax" value="">
                    </div>

                    <div class="div_form">
                        <label for="emp_email">Correo electr&oacute;nico<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="emp_email" id="emp_email" value="" style="width:515px;">
                    </div>

                </div>

                <h3>Datos financieros<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>


                    <div class="div_form">
                        <label for="balance_al">Fecha de Egreso<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="balance_al" id="balance_al" value="" readonly>
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="df_banco"><b>Activos</b><br>1. banco:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:105px;text-align: right;" type="text" name="df_banco" id="df_banco" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_invercion"><br>2. Inverciones:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:105px;text-align: right;" type="text" name="df_invercion" id="df_invercion" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_mobiliario"><br>3. Mobiliario:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:105px;text-align: right;" type="text" name="df_mobiliario" id="df_mobiliario" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_vehivulo"><br>4. Veh&iacute;culos:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:100px;text-align: right;" type="text" name="df_vehivulo" id="df_vehivulo" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_inmuebles"><br>5. Inmuebles:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:100px;text-align: right;" type="text" name="df_inmuebles" id="df_inmuebles" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_tactivos"><br><b>Total Activos</b> (1+2+3+4+5):</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:135px;text-align: right;" type="text" name="df_tactivos" id="df_tactivos" value="0,00" >
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>
                    <div class="div_form">
                        <label for="df_tarjetas"><b>Pasivo y patrimonio</b><br>7. tarjetas:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:100px;text-align: right;" type="text" name="df_tarjetas" id="df_tarjetas" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_prestamos"><br>8. Prestamos:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:97px;text-align: right;" type="text" name="df_prestamos" id="df_prestamos" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_hipoteca"><br>3. Hipoteca:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:94px;text-align: right;" type="text" name="df_hipoteca" id="df_hipoteca" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_tpasivo"><br>10. <b>total pasivo (7+8+9)</b>:</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:121px;text-align: right;" type="text" name="df_tpasivo" id="df_tpasivo" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_patrimonio"><br>5. patrimonio (6-10):</label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:95px;text-align: right;" type="text" name="df_patrimonio" id="df_patrimonio" value="0,00" >
                    </div>
                    <div class="div_form">
                        <label for="df_total"><br><b>Total pasivo y patrimonio:</b></label><br>
                        <input class=" moneda_3" onkeypress="return solo_moneda(event)" style="width:140px;text-align: right;" type="text" name="df_total" id="df_total" value="0,00" >
                    </div>


                </div>

                <h3>Referencias Bancarias<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>


                    <?php
                    for ($i = 0; $i <= 3; $i++) {
                        ?>
                        <div class="prod_banplus ref_ban_comer"> 
                            <div class="div_form">
                                <label for="tp_banco<?= $i; ?>">Banco:</label><br>


                                <select  class="valida_prod" name="tp_banco<?= $i; ?>" id="tp_banco<?= $i; ?>" style="width:270px;">
                                    <?php if ($i == 0) { ?>
                                        <option value="BANPLUS">BANPLUS</option>
                                    <?php } else { ?>
                                        <option value="">Seleccione...</option>
                                        <?php echo $_opc_tp_banco; ?>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="div_form">
                                <label for="cuenta<?= $i; ?>">N&ordm; de Cuenta o TDC:</label><br>
                                <input class="valida_prod cta_banco" size="24" onkeypress="return solo_numeros(event)" style="width:230px;" type="text" name="cuenta<?= $i; ?>" id="cuenta<?= $i; ?>" value="" >
                            </div>



                            <div class="div_form">
                                <label for="tp_cuenta<?= $i; ?>">Tipo de cuenta:</label><br>
                                <div style="width:100%;height: 4px;" ></div>
                                Corriente<input type="radio" value="C" name="tp_cuenta<?= $i; ?>">
                                Ahorros<input type="radio" value="A" name="tp_cuenta<?= $i; ?>">
                            </div>



                        </div>
                        <?php
                    }
                    ?>
                </div>

                <h3>Referencias de tarjetas de Cr&eacute;dito<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>


                    <?php
                    for ($i = 0; $i <= 3; $i++) {
                        ?>
                        <div class="prod_banplus ref_ban_comer"> 
                            <div class="div_form">
                                <label for="tjp_banco<?= $i; ?>">Banco:</label><br>
                                <select  class="valida_prod" name="tjp_banco<?= $i; ?>" id="tjp_banco<?= $i; ?>" style="width:130px;">
                                    <option value="">Seleccione...</option>
                                    <?php echo $_opc_tp_banco; ?>
                                </select>
                            </div>

                            <div class="div_form">
                                <label for="tjp_cuenta<?= $i; ?>">Tarjeta N&ordm;:</label><br>
                                <input class="valida_prod cta_banco" size="24" onkeypress="return solo_numeros(event)" style="width:142px;" type="text" name="tjp_cuenta<?= $i; ?>" id="tjp_cuenta<?= $i; ?>" value="" >
                            </div>
                            <div class="div_form">
                                <label for="tjp_titularidad<?= $i; ?>">Titularidad:</label><br>
                                <div style="width:100%;height: 4px;" ></div>
                                T <input type="radio" value="T" name="tjp_titularidad<?= $i; ?>">
                                S <input type="radio" value="S" name="tjp_titularidad<?= $i; ?>">
                            </div>


                            <div class="div_form">
                                <label for="tjp_limite<?= $i; ?>">L&iacute;mite de cr&eacute;dito:</label><br>
                                <input class="valida_prod cta_banco" size="24" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="tjp_limite<?= $i; ?>" id="tjp_limite<?= $i; ?>" value="" >
                            </div>

                            <div class="div_form">
                                <label for="tjp_saldo<?= $i; ?>">Saldo Actual:</label><br>
                                <input class="valida_prod cta_banco" size="24" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="tjp_saldo<?= $i; ?>" id="tjp_saldo<?= $i; ?>" value="" >
                            </div>

                            <div class="div_form">
                                <label for="tjp_banco<?= $i; ?>">Tipo de tarjeta:</label><br>
                                <select  class="valida_prod" name="tjp_banco<?= $i; ?>" id="tjp_banco<?= $i; ?>" style="width:130px;">
                                    <option value="">Seleccione...</option>
                                    <option value="CL&Aacute;SICA">Cl&aacute;sica</option>
                                    <option value="DORADA">Dorada</option>
                                    <option value="PLATINUM">Platinum</option>

                                </select>
                            </div>





                        </div>
                        <?php
                    }
                    ?>
                </div>


                <h3>AUTORIZACI&Oacute;N DE CARGO EN CUENTA<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>

                <div>
                    <div class="div_form">
                        <label for="autor_autorizacion">Autorizo a cargar mensualmente el pago:</label><br>
                        <input class="" onkeypress="return solo_email(event)" type="text" name="autor_autorizacion" id="autor_autorizacion" value="" style="width:381px;">
                    </div>


                    <div class="div_form">
                        <label for="autor_tpago<?= $i; ?>">Titularidad:</label><br>
                        <div style="width:100%;height: 4px;" ></div>
                        M&iacute;nimo <input type="radio" value="M" name="autor_tpago">
                        Total <input type="radio" value="T" name="autor_tpago">
                    </div>

                    <div class="div_form">
                        <label for="autor_cuenta">En mi cuenta N&ordm;:</label><br>
                        <input class=" cta_banco" size="24" onkeypress="return solo_numeros(event)" style="width:230px;" type="text" name="autor_cuenta" id="autor_cuenta" value="" >
                    </div>

                </div>
                <h3>DIRECCI&Oacute;N DE CORRESPONDENCIA<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>

                <div>
                    <div class="div_form">
                        <label for="autor_autorizacion">ENV&Iacute;O TARJETA DE CR&Eacute;DITO:<br>Agencia Banplus</label><br>
                        <select class="requerido_" name="fn_agencia" id="fn_agencia" style="width:400px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_agencia ?>
                        </select>
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>


                    <div class="div_form">
                        <label for="corresp_correo">ENV&Iacute;O TARJETA DE CR&Eacute;DITO:<br>Correo electr&oacute;nico:</label><br>
                        <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="corresp_correo" id="corresp_correo" value="" style="width:372px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Habitaci&oacute;n <input type="radio" value="H" name="autor_tpago">
                        Oficina <input type="radio" value="O" name="autor_tpago">

                    </div>



                </div>


                <h3>Solicitud de tarjetas suplementarias<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span> </h3>
                <div>
                    <div class="div_form">
                        <label for="p_nombre">Primer Nombre<span  style="color:red">*</span></label><br>
                        <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_nombre">Segundo Nombre:</label><br>
                        <input style="width: 173px;" onkeypress="return solo_letras(event)" type="text" name="s_nombre" id="s_nombre" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="p_apellido">Primer Apellido<span  style="color:red">*</span></label><br>
                        <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_apellido">Segundo Apellido:</label><br>
                        <input style="width: 173px;"  onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="" maxlength="50">
                    </div>

                    <!--##################### DIV SEPARADOR ############################--> 
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="tp_documento">C&eacute;dula de Identidad<span  style="color:red">*</span></label><br>
                        <select name="tp_documento" id="tp_documento" class="requerido_">
                            <option value="">
                            <option value="C">V
                            <option value="E">E
                        </select>
                        <input style="width: 130px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="n_documento" id="n_documento" value="">
                    </div>

                    <div class="div_form">
                        <label for="fc_nac">Fecha de nacimiento<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="fc_nac" id="fc_nac" value="" readonly>
                    </div>

                    <div class="div_form">
                        <label for="tp_sexo" >Sexo<span  style="color:red">*</span></label>
                        <div style="width:100%;height: 4px;" ></div>
                        M<input type="radio" value="M" name="tp_sexo">
                        F<input type="radio" value="F" name="tp_sexo">
                    </div>

                    <div class="div_form">
                        <label for="p_apellido">PARENTESCO<span  style="color:red">*</span></label><br>
                        <input style="width: 135px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_apellido">FIRMA del solicitante Suplementario:</label><br>
                        <input style="width: 204px;"  onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="" maxlength="50">
                    </div>

                    <!--##################### DIV SEPARADOR ############################--> 
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="p_nombre">Primer Nombre<span  style="color:red">*</span></label><br>
                        <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_nombre">Segundo Nombre:</label><br>
                        <input style="width: 173px;" onkeypress="return solo_letras(event)" type="text" name="s_nombre" id="s_nombre" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="p_apellido">Primer Apellido<span  style="color:red">*</span></label><br>
                        <input style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_apellido">Segundo Apellido:</label><br>
                        <input style="width: 173px;"  onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="" maxlength="50">
                    </div>

                    <!--##################### DIV SEPARADOR ############################--> 
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="tp_documento">C&eacute;dula de Identidad<span  style="color:red">*</span></label><br>
                        <select name="tp_documento" id="tp_documento" class="requerido_">
                            <option value="">
                            <option value="C">V
                            <option value="E">E
                        </select>
                        <input style="width: 130px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="n_documento" id="n_documento" value="">
                    </div>

                    <div class="div_form">
                        <label for="fc_nac">Fecha de nacimiento<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="fc_nac" id="fc_nac" value="" readonly>
                    </div>

                    <div class="div_form">
                        <label for="tp_sexo" >Sexo<span  style="color:red">*</span></label>
                        <div style="width:100%;height: 4px;" ></div>
                        M<input type="radio" value="M" name="tp_sexo">
                        F<input type="radio" value="F" name="tp_sexo">
                    </div>

                    <div class="div_form">
                        <label for="p_apellido">PARENTESCO<span  style="color:red">*</span></label><br>
                        <input style="width: 135px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_apellido">FIRMA del solicitante Suplementario:</label><br>
                        <input style="width: 204px;"  onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="" maxlength="50">
                    </div>

                </div>


                <h3>Documentos Requeridos<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div style="float:left;padding:5px;width: 97%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Copia legible de la c&eacute;dula de identidad del solicitante, vigente.<span  style="color:red">*</span></label><br><br>
                        <input name="f_cedula" id="f_cedula" type="file" class="custom-file-input requerido_" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    <div class="separador_" style=""></div>

                    <div style="float:left;padding:5px;width: 97%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Copia del Registro de Informaci&Oacute;n Fiscal RIF del solicitante, vigente.<span  style="color:red">*</span></label><br><br>
                        <input name="f_rif" type="file" class="custom-file-input requerido_" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    <div class="separador_" style=""></div>

                    <div style="float:left;padding:5px;width: 97%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Constancia de trabajo original membretada con firma y sello de la empresa, con vigencia m&aacute;xima de tres (3) meses indicando ingreso mensual o anual, cargo que desempe&ntilde;a y antigüedad en la empresa (no menor a doce (12) meses). Si es profesional de libre ejercicio certificaci&oacute;n de ingresos firmada por un contador p&Uacute;blico colegiado donde indique y confirme la profesi&Iacute;n del solicitante y el origen de los fondos. Si eres estudiante mayor de edad constancia de estudios actualizada.<span  style="color:red">*</span></label><br><br>
                        <input name="f_constancia" type="file" class="custom-file-input requerido_" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    <div class="separador_" style=""></div>

                    <div style="float:left;padding:5px;width: 97%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Una (1) Referencia Bancaria o Comercial de cada uno de los firmantes (excepto a las personas que abren cuenta por primera vez). No m&aacute;s de 30 d&Iacute;as emitidos.</label><br><br>
                        <input name="f_referencia" type="file" class="custom-file-input ref_adjunto" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    <div class="separador_" style=""></div>

                    <div style="float:left;padding:5px;width: 97%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Si eres firma personal copia certificada de los documentos constitutivos de la firma unipersonal debidamente inscritos en el Registro de Comercio, vigente, legible, sellada y firmada por el ente regulador. </label><br><br>
                        <input name="f_firma" type="file" class="custom-file-input" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    <div class="separador_" style=""></div>
                    <div style="float:left;padding:5px;width: 97%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Si eres firma personal &uacute;ltima declaraci&oacute;n de Impuesto Sobre la Renta (ISLR) emitida por el SENIAT.</label><br><br>
                        <input name="f_declaracion" type="file" class="custom-file-input" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                </div>

                <h3>Agencia<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form" >
                        <label for="fn_agencia">Aegencia:</label><br>
                        <select class="requerido_" name="fn_agencia" id="fn_agencia" style="width:400px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_agencia ?>
                        </select>
                    </div>
                    <div class="div_form" style="float:right;">
                        <label for="fc_cita">Fecha de Cita<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="fc_cita" id="fc_cita" value="" readonly>
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>
                    <div class="div_form">
                        <label for="agencia_direccion" style="">Dirección:</label><br>
                        <input id="agencia_direccion" name="agencia_direccion" type="text" class="" style="width: 760px;background: #e6e6e6;" readonly></span>
                    </div>
                </div>


            </div>

            <!--##################### DIV SEPARADOR ############################-->    
            <div class="sep_2"></div>

            <div class="div_form" style="text-align: right;float: right;">
                <?php
                echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
                ?>
                <br>
                <input id="capt_" name="capt_" type="text" class="" style="width: 150px;" ><br>
                <br>
                <button  style="    background-color: #2D4B71;padding: 5px;
                         /*font: normal 11px Arial, Georgia, Verdana, Geneva, Helvetica, sans-serif;*/
                         color: #FFF;
                         background-color: #2D4B71;
                         border: 0;
                         cursor: pointer;
                         " type="submit" value="Submit">Enviar</button>
            </div>



            <!--            <div style="float:left;padding:5px;width: 95%;text-align: right;margin-top: 20px;">
            
                        </div>-->


        </div>
    </form>

<?php } else { ?>
    <br><br><br><br><br>
    <h3 style="width: 100%;border:none;    text-align: center;">Espere un momento mientras procesamos el envio de su solictud</h3>
    <br><br><br>
    <div style="width: 100%;text-align: center" class="spiner_">
        <img src="img/spiner.gif" />
    </div>
    <?php
}
    /*
      Created on:28/04/2017,11:40:47 AM
      Author    :Roberto Delgado
     */




    