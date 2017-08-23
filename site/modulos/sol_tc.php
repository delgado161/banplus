<br><br>

<?php include 'pre_apertura.php' ?>
<?php include 'envia_correos.php'; 

 foreach($_POST['group1'] as $check) {
            echo $check; //echoes the value set in the HTML form for each checked checkbox.
                         //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
                         //in your case, it would echo whatever $row['Report ID'] is equivalent to.
    }
// var_dump($_POST['group1']);
?>

<?php if (!isset($_POST['p_formulario'])) {
    ?>
    <form method="POST" id="form_ap_cuenta" enctype="multipart/form-data">
        <input   type="hidden" name="p_formulario" id="p_formulario" value="CREDITO">

        <div style="background-color:#F4F4F4;overflow:auto;overflow-x:hidden;" class="form_n" > 
            <div id="accordion">
                <h3>Datos Personales<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span> </h3>
                <div>
                    <div class="div_form">
                        <label for="p_nombre">Primer Nombre<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['p_nombre']) ? $_DAT['p_nombre'] : '') ?>" style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_nombre" id="p_nombre"  maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_nombre">Segundo Nombre:</label><br>
                        <input value="<?= (!empty($_DAT['s_nombre']) ? $_DAT['s_nombre'] : '') ?>" style="width: 173px;" onkeypress="return solo_letras(event)" type="text" name="s_nombre" id="s_nombre"  maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="p_apellido">Primer Apellido<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['p_apellido']) ? $_DAT['p_apellido'] : '') ?>" style="width: 173px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="p_apellido" id="p_apellido"  maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="s_apellido">Segundo Apellido:</label><br>
                        <input value="<?= (!empty($_DAT['s_apellido']) ? $_DAT['s_apellido'] : '') ?>" style="width: 173px;"  onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido"  maxlength="50">
                    </div>

                    <!--##################### DIV SEPARADOR ############################--> 
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="tp_documento">C&eacute;dula de Identidad<span  style="color:red">*</span></label><br>
                        <select name="tp_documento" id="tp_documento" class="requerido_">
                            <option value="" >
                            <option value="C" <?= (!empty($_DAT['tp_documento'] && $_DAT['tp_documento'] == 'C') ? 'selected' : '') ?>>V
                            <option value="E" <?= (!empty($_DAT['tp_documento'] && $_DAT['tp_documento'] == 'E') ? 'selected' : '') ?>>E
                        </select>
                        <input value="<?= (!empty($_DAT['n_documento']) ? $_DAT['n_documento'] : '') ?>" style="width: 130px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="n_documento" id="n_documento" maxlength="8">
                    </div>

                    <div class="div_form">
                        <label for="pn_rif">N&ordm; de r.i.f<span  style="color:red">*</span></label><br>
                        <b>J -</b> <input value="" style="width: 173px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="rif" id="rif"  >
                    </div>

                    <div class="div_form">
                        <label for="pasaporte">Pasaporte</label><br>
                        <input value="" style="width: 158px;" class="" onkeypress="return solo_numeros(event)" type="text" name="pasaporte" id="pasaporte" >
                    </div>

                    <div class="div_form">
                        <label for="naturalizado">naturalizado N&ordm; C.I anterior:</label><br>
                        <input value="<?= (!empty($_DAT['naturalizado']) ? $_DAT['naturalizado'] : '') ?>" style="width: 170px;" class="" onkeypress="return solo_numeros(event)" type="text" name="naturalizado" id="naturalizado" maxlength="8">
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="fc_nac">Fecha de nacimiento<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['fc_nac']) ? $_DAT['fc_nac'] : '') ?>" class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="fc_nac" id="fc_nac"  readonly>
                    </div>

                    <div class="div_form">
                        <label for="edad">Edad<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['edad']) ? $_DAT['edad'] : '') ?>" class="requerido_" style="width:40px;;background: #e6e6e6;" type="text" name="edad" id="edad"  readonly>
                    </div>



                    <div class="div_form">
                        <label for="tp_pais">Pa&iacute;s de nacimiento<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="tp_pais" id="tp_pais" style="width: 130px;">
                            <option value="" >Seleccione...
                                <?php echo (!empty($_DAT['tp_pais']) ? str_replace('value="' . $_DAT['tp_pais'] . '"', 'value="' . $_DAT['tp_pais'] . '" selected', $_opc_tp_pais) : $_opc_tp_pais); ?>


                        </select>
                        <!--<input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais"  style="width:238px;">-->

                    </div>
                    <div class="div_form">
                        <label for="tp_estado">Estado de nacimiento<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['tp_estado']) ? $_DAT['tp_estado'] : '') ?>" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_estado" id="tp_estado"  style="width:160px;" maxlength="100">
                    </div>
                    <div class="div_form">
                        <label for="tp_ciudad">Ciudad de nacimiento<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['tp_ciudad']) ? $_DAT['tp_ciudad'] : '') ?>" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_ciudad" id="tp_ciudad"  style="width:170px;" maxlength="100">
                    </div>

                    <div class="div_form">
                        <label for="tp_sexo" >Sexo<span  style="color:red">*</span></label>
                        <div style="width:100%;height: 4px;" ></div>
                        M<input type="radio" value="M" name="tp_sexo"  <?= (!empty($_DAT['tp_sexo'] && $_DAT['tp_sexo'] == 'M') ? 'checked' : '') ?>>
                        F<input type="radio" value="F" name="tp_sexo" <?= (!empty($_DAT['tp_sexo'] && $_DAT['tp_sexo'] == 'F') ? 'checked' : '') ?>>
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="tiempo_pais">Tiempo en el pa&iacute;s<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px" type="number" name="tiempo_antiguo" id="tiempo_antiguo"  min="0" max="2000" maxlength="2">
                        <select class="requerido_" name="tiempo_pais" id="tiempo_pais" style="">
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
                            <option value="" >Seleccione...
                                <?php echo (!empty($_DAT['tp_civil']) ? str_replace('value="' . $_DAT['tp_civil'] . '"', 'value="' . $_DAT['tp_civil'] . '" selected', $_opc_civil) : $_opc_civil);   ?>
                        </select>
                    </div>

                    <div class="div_form">
                        <label for="g_familiar">Carga familiar<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['g_familiar']) ? $_DAT['g_familiar'] : '') ?>" class="requerido_" onkeypress="return solo_numeros(event)" style="width:80px;" type="number" name="g_familiar" id="g_familiar" min="0" max="99" maxlength="2">
                    </div>

                    <div class="div_form">
                        <label for="tp_profecion">Profesi&oacute;n u oficio<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="tp_profecion" id="tp_profecion" style="width:174px;">
                            <option value="" >Seleccione...
                                <?php echo (!empty($_DAT['tp_profecion']) ? str_replace('value="' . $_DAT['tp_profecion'] . '"', 'value="' . $_DAT['tp_profecion'] . '" selected', $_opc_profesion) : $_opc_profesion); ?>


                        </select>
                    </div>


                    <div class="div_form">
                        <label for="dtp_telefonoH">Tel&eacute;fono Hab.<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_telefonoH" id="dtp_telefonoH" style="width:70px;">
                            <option value="" >
                                <?php echo (!empty($_DAT['dtp_telefonoH']) ? str_replace('value="' . $_DAT['dtp_telefonoH'] . '"', 'value="' . $_DAT['dtp_telefonoH'] . '" selected', $_opc_area) : $_opc_area); ?>


                        </select>
                        <input value="<?= (!empty($_DAT['d_telefonoh']) ? $_DAT['d_telefonoh'] : '') ?>"  class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="d_telefonoh" id="d_telefonoh" >
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->  
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="dtp_telefono2">Otro Tel&eacute;fono</label><br>
                        <select class="" name="dtp_telefono2" id="dtp_telefono2" style="width:70px;">
                            <option value="" >
                                <?php echo (!empty($_DAT['dtp_telefono2']) ? str_replace('value="' . $_DAT['dtp_telefono2'] . '"', 'value="' . $_DAT['dtp_telefono2'] . '" selected', $_opc_area) : $_opc_area); ?>

                        </select>
                        <input  value="<?= (!empty($_DAT['d_telefono2']) ? $_DAT['d_telefono2'] : '') ?>" class="telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="d_telefono2" id="d_telefono2" >
                    </div>

                    <div class="div_form">
                        <label for="dtp_celular">Celular<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_celular" id="dtp_celular" style="width:70px;">
                            <option value="" >
                                <?php echo (!empty($_DAT['dtp_celular']) ? str_replace('value="' . $_DAT['dtp_celular'] . '"', 'value="' . $_DAT['dtp_celular'] . '" selected', $_opc_cel) : $_opc_cel); ?>


                        </select>
                        <input value="<?= (!empty($_DAT['d_celular']) ? $_DAT['d_celular'] : '') ?>" class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="d_celular" id="d_celular" >
                    </div>


                    <!--                    <div class="div_form">
                                            <label for="tp_ocupacion">Ocupaci&oacute;n<span  style="color:red">*</span></label><br>
                                            <input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_ocupacion" id="tp_ocupacion"  style="width:287px;" maxlength="100">
                    
                                        </div>-->

                    <div class="div_form">
                        <label for="email">Correo electr&oacute;nico<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['email']) ? $_DAT['email'] : '') ?>" class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email"  style="width:371px;">
                    </div>


                </div>
                <h3>Datos del c&oacute;nyuge o concubino<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div class="cc_banplus"> 

                    <div class="div_form">
                        <label for="ccp_nombre">Primer Nombre:</label><br>
                        <input value="<?= (!empty($_DAT['ccp_nombre']) ? $_DAT['ccp_nombre'] : '') ?>" style="width: 173px;" class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="ccp_nombre" id="ccp_nombre"  maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="ccs_nombre">Segundo Nombre:</label><br>
                        <input value="<?= (!empty($_DAT['ccs_nombre']) ? $_DAT['ccs_nombre'] : '') ?>" class="valida_prod" style="width: 173px;" onkeypress="return solo_letras(event)" type="text" name="ccs_nombre" id="ccs_nombre"  maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="ccp_apellido">Primer Apellido:</label><br>
                        <input value="<?= (!empty($_DAT['ccp_apellido']) ? $_DAT['ccp_apellido'] : '') ?>" style="width: 173px;" class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="ccp_apellido" id="ccp_apellido"  maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="ccs_apellido">Segundo Apellido:</label><br>
                        <input value="<?= (!empty($_DAT['ccs_apellido']) ? $_DAT['ccs_apellido'] : '') ?>" class="valida_prod" style="width: 173px;"  onkeypress="return solo_letras(event)" type="text" name="ccs_apellido" id="ccs_apellido"  maxlength="50">
                    </div>

                    <!--##################### DIV SEPARADOR ############################--> 
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="cctp_documento">C&eacute;dula de identidad:</label><br>
                        <select name="cctp_documento" id="cctp_documento" class="valida_prod">
                            <option value="" >
                            <option value="C" <?= (!empty($_DAT['cctp_documento'] && $_DAT['cctp_documento'] == 'C') ? 'selected' : '') ?>>V
                            <option value="E" <?= (!empty($_DAT['cctp_documento'] && $_DAT['cctp_documento'] == 'C') ? 'selected' : '') ?>>E
                        </select>
                        <input  value="<?= (!empty($_DAT['CCn_documento']) ? $_DAT['CCn_documento'] : '') ?>" style="width: 139px;" class="valida_prod" onkeypress="return solo_numeros(event)" type="text" name="CCn_documento" id="CCn_documento"  maxlength="8">
                    </div>




                    <div class="div_form">
                        <label for="ccfc_nac">Fecha de nacimiento:</label><br>
                        <input value="<?= (!empty($_DAT['ccfc_nac']) ? $_DAT['ccfc_nac'] : '') ?>" class="valida_prod" style="width:110px;background: #e6e6e6;" type="text" name="ccfc_nac" id="ccfc_nac"  readonly>
                    </div>

                    <div class="div_form">
                        <label for="ccedad">Edad:</label><br>
                        <input value="<?= (!empty($_DAT['ccedad']) ? $_DAT['ccedad'] : '') ?>" class="valida_prod" style="width:40px;;background: #e6e6e6;" type="text" name="ccedad" id="ccedad"  readonly>
                    </div>

                    <div class="div_form">
                        <label for="cctp_pais">Pa&iacute;s de nacimiento:</label><br>
                        <select class="valida_prod" name="cctp_pais" id="cctp_pais" style="width: 170px;">
                            <option value="">Seleccione...
                                <?php echo (!empty($_DAT['cctp_pais']) ? str_replace('value="' . $_DAT['cctp_pais'] . '"', 'value="' . $_DAT['cctp_pais'] . '" selected', $_opc_tp_pais) : $_opc_tp_pais); ?>

                        </select>
                        <!--<input class="requerido_" onkeypress="return solo_letras(event)" type="text" name="tp_pais" id="tp_pais"  style="width:238px;">-->

                    </div>
                    <div class="div_form">
                        <label for="cctp_estado">Estado de nacimiento:</label><br>
                        <input value="<?= (!empty($_DAT['cctp_estado']) ? $_DAT['cctp_estado'] : '') ?>" class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="cctp_estado" id="cctp_estado"  style="width:180px;" maxlength="100">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="cctp_ciudad">Ciudad de nacimiento:</label><br>
                        <input value="<?= (!empty($_DAT['cctp_ciudad']) ? $_DAT['cctp_ciudad'] : '') ?>" class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="cctp_ciudad" id="cctp_ciudad"  style="width:180px;" maxlength="100">
                    </div>


                    <div class="div_form">
                        <label for="cct_empresa_">Empresa donde trabaja actualmente:</label><br>
                        <input class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="cct_empresa_" id="cct_empresa_"  style="width:355px;" maxlength="100">

                    </div>

                    <div class="div_form">
                        <label for="ccsueldo">Sueldo b&aacute;sico:</label><br>
                        <input value="<?= (!empty($_DAT['ccsueldo']) ? $_DAT['ccsueldo'] : '') ?>" class="valida_prod moneda_3" onkeypress="return solo_moneda(event)" style="width:163px;text-align: right;" type="text" name="ccsueldo" id="ccsueldo" value="0,00" >Bs.
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="dcc_dtp_telefonoH">Tel&eacute;fono Hab.</label><br>
                        <select class="valida_prod" name="dcc_dtp_telefonoH" id="dtp_telefonoH" style="width:70px;">
                            <option value="" >
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="valida_prod telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="dcc_d_telefonoh" id="dcc_d_telefonoh" >
                    </div>

                    <div class="div_form">
                        <label for="dcc_dtp_telefono2">Otro Tel&eacute;fono</label><br>
                        <select class="" name="dcc_dtp_telefono2" id="dcc_dtp_telefono2" style="width:70px;">
                            <option value="" >
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="dcc_d_telefono2" id="dcc_d_telefono2" >
                    </div>

                    <div class="div_form">
                        <label for="ccemail">Correo electr&oacute;nico:</label><br>
                        <input value="<?= (!empty($_DAT['ccemail']) ? $_DAT['ccemail'] : '') ?>" class="valida_prod" onkeypress="return solo_email(event)" type="text" name="ccemail" id="ccemail"  style="width:370px;">
                    </div>
                </div>


                <h3> Direcci&oacute;n de Habitaci&oacute;n<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="dtp_estado">Estado<span  style="color:red">*</span></label><br>
                        <select class="_estados requerido_" name="dtp_estado" id="dtp_estado" style="width:185px;">
                            <option value="" >Seleccione...
                                <?php echo (!empty($_DAT['dtp_estado']) ? str_replace('>' . $_DAT['dtp_estado'], ' selected >' . $_DAT['dtp_estado'], $_opc_estados) : $_opc_estados); ?>
                        </select>

                    </div>
                    <div class="div_form">
                        <label for="dtp_ciudad">Cuidad<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_ciudad" id="dtp_ciudad" style="width:185px;">
                            <option value="" >Seleccione...
                        </select>
                    </div>

                    <div class="div_form municipio">
                        <label for="dtp_municipio">Municipio<span  style="color:red">*</span></label><br>
                        <select class="requerido_ _municipio" name="dtp_municipio" id="dtp_municipio" style="width:185px;">
                            <option value="" >Seleccione...
                        </select>
                    </div>


                    <div class="div_form parroquia">
                        <label for="dtp_parroquia">Parroquia<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dtp_parroquia" id="dtp_parroquia" style="width:185px;">
                            <option value="" >Seleccione...
                        </select>
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="d_postal">C&oacute;digo postal<span  style="color:red">*</span></label><br>
                        <select class=" requerido_" name="d_postal" id="d_postal" style="width:92px;">
                            <option value="" >
                                <?php echo (!empty($_DAT['d_postal']) ? str_replace('value="' . $_DAT['d_postal'] . '"', 'value="' . $_DAT['d_postal'] . '" selected', $_postal) : $_postal); ?>
                        </select>
                    </div>

                    <div class="div_form">
                        <label for="d_calle">Calle<span  style="color:red">*</span></label><br>
                        <input   class="requerido_" onkeypress="return solo_letras2(event)" style="width:208px;" type="text" name="d_calle" id="d_calle"  maxlength="250">
                    </div>

                    <div class="div_form">
                        <label for="d_avenida">Avenida<span  style="color:red">*</span></label><br>
                        <input   class="requerido_" onkeypress="return solo_letras2(event)" style="width:208px;" type="text" name="d_avenida" id="d_avenida"  maxlength="250">
                    </div>


                    <div class="div_form">
                        <label for="d_urbanizacion">Urbanizaci&oacute;n / Sector / Barrio<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['d_urbanizacion']) ? $_DAT['d_urbanizacion'] : '') ?>" style="width:198px;" class="requerido_" onkeypress="return solo_letras2(event)"  type="text" name="d_urbanizacion" id="d_urbanizacion"  maxlength="250">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->   
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="d_ceq"> Tipo de vivienda<span  style="color:red">*</span></label><br>
                        <select class=" requerido_" name="d_ceq" id="d_ceq" style="width:92px;">
                            <option value="CASA">Casa</option>
                            <option value="EDIFICIO">Edificio</option>
                            <option value="QUINTA">Quinta</option>

                        </select>
                        <!--<input value="<?= (!empty($_DAT['d_ceq']) ? $_DAT['d_ceq'] : '') ?>" style="width:95px;" class="requerido_" onkeypress="return solo_letras2(event)"  type="text" name="d_ceq2" id="d_ceq2"  maxlength="50">-->
                    </div>
                    
                      <div class="div_form">
                        <label for="d_ceq"> Nombre / N&ordm; <span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['d_ceq']) ? $_DAT['d_ceq'] : '') ?>" style="width:95px;" class="requerido_" onkeypress="return solo_letras2(event)"  type="text" name="d_ceq2" id="d_ceq2"  maxlength="50">
                    </div>
                    
                    <div class="div_form">
                        <label for="d_piso">Piso<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['d_piso']) ? $_DAT['d_piso'] : '') ?>" class="requerido_" onkeypress="return solo_letras2(event)" style="width:38px;" type="text" name="d_piso" id="d_piso"  maxlength="2">
                    </div>
                    <div class="div_form">
                        <label for="d_apartamento">Apartamento<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['d_apartamento']) ? $_DAT['d_apartamento'] : '') ?>" class="requerido_" onkeypress="return solo_letras2(event)" style="width:75px;" type="text" name="d_apartamento" id="d_apartamento"  maxlength="8">
                    </div>

                    <div class="div_form">
                        <label for="dcc_dtp_telefono2_">Tel&eacute;fono Hab.<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="dcc_dtp_telefono2_" id="dcc_dtp_telefono2_" style="width:70px;">
                            <option value="" >
                                <?php echo (!empty($_DAT['dtp_telefonoH']) ? str_replace('value="' . $_DAT['dtp_telefonoH'] . '"', 'value="' . $_DAT['dtp_telefonoH'] . '" selected', $_opc_area) : $_opc_area); ?>
                        </select>
                        <input  value="<?= (!empty($_DAT['d_telefonoh']) ? $_DAT['d_telefonoh'] : '') ?>" class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="dcc_d_telefono2__" id="dcc_d_telefono2__" >
                    </div>


                    <div class="div_form">
                        <label for="tp_inmueble">Vivienda<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="tp_inmueble" id="tp_inmueble" style="width:208px;">
                            <option value="" >Seleccione...
                            <option value="DE MIS PADRES">De mis padres
                            <option value="PROPIA">Propia
                            <option value="DE UN FAMILIAR">De un Familiar
                            <option value="ALQUILADA">Alquilada
                        </select>
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="ano_vivienda">Si la vivienda es propia,<br>indique a&ntilde;os de adquisici&oacute;n</label><br>
                        <input class="" onkeypress="return solo_numeros(event)" style="width:152px;" type="number" name="ano_vivienda" id="ano_vivienda" min="0" max="2000" maxlength="2">
                    </div>


                    <div class="div_form">
                        <label for="canon">Alquiler o<br> Cuota Hipotecaria:</label><br>
                        <input value="<?= (!empty($_DAT['canon']) ? $_DAT['canon'] : '') ?>" class="" onkeypress="return solo_moneda(event)" style="width:100px;text-align: right;" type="text" name="canon" id="canon"  > Bs.
                    </div>

                    <div class="div_form">
                        <label for="ano_vivienda">A&ntilde;os en esta<br> direcci&oacute;n<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:100px;" type="number" name="ano_vivienda2" id="ano_vivienda2" min="0" max="2000" maxlength="2">
                    </div>

                    <div class="div_form">
                        <label for="canon_nombre">Nombre del Acreedor<br>Hipotecario o Arrendador:</label><br>
                        <input value="<?= (!empty($_DAT['canon_nombre']) ? $_DAT['canon_nombre'] : '') ?>" class="" onkeypress="return solo_letras(event)" style="width:147px;" type="text" name="canon_nombre" id="canon_nombre"  >
                    </div>

                    <div class="div_form">
                        <label for="canon_credito">N&uacute;mero<br>de Cr&eacute;dito:</label><br>
                        <input class="" onkeypress="return solo_numeros(event)" style="width:147px;" type="text" name="canon_credito" id="canon_credito"  >
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="dctp_telefono">Tel&eacute;fono del Arrendador:</label><br>
                        <select  class="" name="dctp_telefono" id="dctp_telefono" style="width:70px;">
                            <option value="" >
                                <?php echo (!empty($_DAT['dctp_telefono']) ? str_replace('value="' . $_DAT['dctp_telefono'] . '"', 'value="' . $_DAT['dctp_telefono'] . '" selected', $_opc_area) : $_opc_area); ?>
                        </select>
                        <input   value="<?= (!empty($_DAT['cd_telefono']) ? $_DAT['cd_telefono'] : '') ?>" class="telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="cd_telefono" id="cd_telefono" >
                    </div>

                </div>

                <h3>Otras propiedades<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="n_empresa">Otras Propiedades que posee:</label><br>
                        <input type="checkbox" name="otras_pA" value="APARTAMENTOS" /> Apartamentos
                        <input type="checkbox" name="otras_pT" value="TERRENOS" />Terrenos
                        <input type="checkbox" name="otras_pL" value="LOCALES" />Locales
                        <input type="checkbox" name="otras_pO" value="OTROS" />Otros
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>
                    <div class="prod_banplus"> 
                        <div class="div_form">
                            <label for="automovil_">Automovil</label><br>
                            <input class="valida_prod" onkeypress="return solo_letras2(event)" style="width:173px;" type="text" name="automovil_" id="automovil_"  maxlength="250">
                        </div>
                        <div class="div_form">
                            <label for="auto_model">Modelo</label><br>
                            <input class="valida_prod" onkeypress="return solo_letras2(event)" style="width:173px;" type="text" name="auto_model" id="auto_model"  maxlength="250">
                        </div>
                        <div class="div_form">
                            <label for="auto_ano">A&ntilde;o</label><br>
                            <input class="valida_prod" onkeypress="return solo_numeros(event)" style="width:173px;" type="text" name="auto_ano" id="auto_ano"  maxlength="250">
                        </div>
                        <div class="div_form">
                            <label for="auto_placa">Placa</label><br>
                            <input class="valida_prod" onkeypress="return solo_letras2(event)" style="width:173px;" type="text" name="auto_placa" id="auto_placa"  maxlength="250">
                        </div>
                    </div>
                </div>
                <h3>Referencias personales familiares o personales<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <?php
                    for ($i = 10; $i <= 11; $i++) {
                        ?>
                        <div class="div_form">
                            <label for="rfa_nombre<?= $i; ?>">Nombre y Apellido<span  style="color:red">*</span></label><br>
                            <input value="<?= (!empty($_DAT['rfa_nombre' . $i]) ? $_DAT['rfa_nombre' . $i] : '') ?>" style="width:162px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rfa_nombre<?= $i; ?>" id="rfa_nombre<?= $i; ?>"  maxlength="100">
                        </div>

                        <div class="div_form">
                            <label for="rf_parentesco<?= $i; ?>">Parentesco<span  style="color:red">*</span></label><br>
                            <input  style="width:115px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="rf_parentesco<?= $i; ?>" id="rf_parentesco<?= $i; ?>"  maxlength="100">

                        </div>
                        <div class="div_form">
                            <label for="rf_direccion<?= $i; ?>">Ciudad<span  style="color:red">*</span></label><br>
                            <input  style="width:126px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="rf_direccion<?= $i; ?>" id="rf_direccion<?= $i; ?>"  maxlength="250">
                        </div>
                        <div class="div_form">
                            <label for="rtp_telefonoH<?= $i; ?>">Tel&eacute;fono.<span  style="color:red">*</span></label><br>
                            <select class="requerido_" name="dtp_telefonoH<?= $i; ?>" id="dtp_telefonoH<?= $i; ?>" style="width:65px;">
                                <option value="" >
                                    <?php echo (!empty($_DAT['dtp_telefonoH' . $i]) ? str_replace('value="' . $_DAT['dtp_telefonoH' . $i] . '"', 'value="' . $_DAT['dtp_telefonoH' . $i] . '" selected', $_opc_area) : $_opc_area); ?>
                            </select>
                            <input  value="<?= (!empty($_DAT['d_telefonoh' . $i]) ? $_DAT['d_telefonoh' . $i] : '') ?>" class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:70px;" type="text" name="d_telefonoh<?= $i; ?>" id="d_telefonoh<?= $i; ?>" >
                        </div>

                        <div class="div_form">
                            <label for="2_dtp_telefonoH<?= $i; ?>">Celular:<span  style="color:red">*</span></label><br>
                            <select class="requerido_" name="2_dtp_telefonoH<?= $i; ?>" id="2_dtp_telefonoH<?= $i; ?>" style="width:65px;">
                                <option value="" >
                                    <?php echo $_opc_cel; ?>
                            </select>
                            <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:70px;" type="text" name="2_d_telefonoh<?= $i; ?>" id="2_d_telefonoh<?= $i; ?>" >
                        </div>
                        <?php
                    }
                    ?>
                </div>


                <h3>Datos Laborales<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="n_empresa">Empresa donde trabaja (Actual)<span  style="color:red">*</span></label><br>
                        <input  value="<?= (!empty($_DAT['n_empresa']) ? $_DAT['n_empresa'] : '') ?>" class="requerido_" onkeypress="return solo_letras(event)" style="width:260px;" type="text" name="n_empresa" id="n_empresa"  maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="ramo_empresa">Sector Econ&oacute;mico<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras(event)" style="width:230px;" type="text" name="ramo_empresa" id="ramo_empresa"  maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="cargo_empresa">Cargo<span  style="color:red">*</span></label><br>
                        <input  value="<?= (!empty($_DAT['cargo_empresa']) ? $_DAT['cargo_empresa'] : '') ?>" class="requerido_" onkeypress="return solo_letras(event)" style="width:226px;" type="text" name="cargo_empresa" id="cargo_empresa"  maxlength="100">
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>


                    <div class="div_form">
                        <label for="e_antiguo">Antig&uuml;edad<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['e_antiguo']) ? $_DAT['e_antiguo'] : '') ?>"  class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px" type="number" name="e_antiguo" id="e_antiguo"  min="0" max="2000" maxlength="2">
                        <select class="requerido_" name="e_antiguo_op" id="e_antiguo_op" style="">
                            <option value="" >Seleccione...
                            <option value="DIAS" <?= (!empty($_DAT['e_antiguo'] && $_DAT['e_antiguo_op'] == 'DIAS') ? 'selected' : '') ?>>D&iacute;as
                            <option value="SEMANAS" <?= (!empty($_DAT['e_antiguo'] && $_DAT['e_antiguo_op'] == 'SEMANAS') ? 'selected' : '') ?>>Semanas
                            <option value="MESES" <?= (!empty($_DAT['e_antiguo'] && $_DAT['e_antiguo_op'] == 'MESES') ? 'selected' : '') ?>>Meses
                            <option value="AÑOS" <?= (!empty($_DAT['e_antiguo'] && $_DAT['e_antiguo_op'] == 'AÑOS') ? 'selected' : '') ?>>A&ntilde;os
                        </select>   
                    </div>

                    <div class="div_form">
                        <label for="sueldo">Sueldo Mensual<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['sueldo']) ? $_DAT['sueldo'] : '') ?>" class="requerido_" onkeypress="return solo_moneda(event)" style="width:115px;text-align: right;" type="text" name="sueldo" id="sueldo"  >Bs.
                    </div>

                    <div class="div_form">
                        <label for="otros_ingresos">Otros ingresos</label><br>
                        <input value="<?= (!empty($_DAT['otros_ingresos']) ? $_DAT['otros_ingresos'] : '') ?>" class="" onkeypress="return solo_moneda(event)" style="width:115px;text-align: right;" type="text" name="otros_ingresos" id="otros_ingresos"  >Bs.
                    </div>

                    <div class="div_form">
                        <label for="concepto_empresa">por concepto de:</label><br>
                        <input class="" onkeypress="return solo_letras(event)" style="width:275px;" type="text" name="concepto_empresa" id="concepto_empresa"  maxlength="100">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>
                    <div class="prod_banplus"> 
                        <div class="div_form">
                            <label for="n_empresa2">Nombre de la empresa donde trabaj&oacute; anteriormente</label><br>
                            <input class="cc_banplus" onkeypress="return solo_letras(event)" style="width:300px;" type="text" name="n_empresa2" id="n_empresa2"  maxlength="250">
                        </div>
                        <div class="div_form">
                            <label for="ramo_empresa2">Sector Econ&oacute;mico</label><br>
                            <input class="cc_banplus" onkeypress="return solo_letras(event)" style="width:220px;" type="text" name="ramo_empresa2" id="ramo_empresa2"  maxlength="250">
                        </div>
                        <div class="div_form">
                            <label for="cargo_empresa2">Cargo</label><br>
                            <input class="cc_banplus" onkeypress="return solo_letras(event)" style="width:196px;" type="text" name="cargo_empresa2" id="cargo_empresa2"  maxlength="100">
                        </div>

                    </div>

                    <!--##################### DIV SEPARADOR ############################-->    
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="sueldo2">Ingreso Mensual</label><br>
                        <input class="" onkeypress="return solo_moneda(event)" style="width:115px;text-align: right;" type="text" name="sueldo2" id="sueldo2"  >Bs.
                    </div>

                    <div class="div_form">
                        <label for="fc_egreso">Fecha de Egreso</label><br>
                        <input class="" style="width:110px;background: #e6e6e6;" type="text" name="fc_egreso" id="fc_egreso"  readonly>
                    </div>


                    <div class="div_form">
                        <label for="e_antiguo2">Tiempo en la empresa</label><br>
                        <input class="" onkeypress="return solo_numeros(event)" style="width:50px" type="number" name="e_antiguo2" id="e_antiguo2"  min="0" max="2000" maxlength="2">
                        <select class="" name="e_antiguo_op2" id="e_antiguo_op" style="">
                            <option value="" >Seleccione...
                            <option value="DIAS">D&iacute;as
                            <option value="SEMANAS">Semanas
                            <option value="MESES">Meses
                            <option value="AÑOS">A&ntilde;os
                        </select>   
                    </div>




                    <!--                    <div class="div_form">
                                            <label for="total_ingresos">Total <br>ingresos<span  style="color:red">*</span></label><br>
                                            <input class="requerido_" style="width:120px;background: #e6e6e6;text-align: right;" type="text" name="total_ingresos" id="total_ingresos"  readonly >Bs.
                                        </div>-->

                </div>

                <h3>Direcci&oacute;n de Empresa actual<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="etp_estado">Estado<span  style="color:red">*</span></label><br>
                        <select  class="_estados requerido_" name="etp_estado" id="etp_estado" style="width:185px;">
                            <option value="" >Seleccione...
                                <?php echo (!empty($_DAT['etp_estado']) ? str_replace('>' . $_DAT['etp_estado'], ' selected >' . $_DAT['etp_estado'], $_opc_estados) : $_opc_estados); ?>
                        </select>
                    </div>
                    <div class="div_form">
                        <label for="etp_ciudad">Cuidad<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="etp_ciudad" id="etp_ciudad" style="width:185px;">
                            <option value="" >Seleccione...
                        </select>
                    </div>

                    <div class="div_form municipio">
                        <label for="etp_municipio">Municipio<span  style="color:red">*</span></label><br>
                        <select class="requerido_ _municipio" name="etp_municipio" id="etp_municipio" style="width:185px;">
                            <option value="" >Seleccione...
                        </select>
                    </div>


                    <div class="div_form parroquia">
                        <label for="etp_parroquia">Parroquia<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="etp_parroquia" id="etp_parroquia" style="width:185px;">
                            <option value="" >Seleccione...
                        </select>
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="e_postal">Zona postal<span  style="color:red">*</span></label><br>
                        <select class="_estados requerido_" name="e_postal" id="e_postal" style="width:92px;">
                            <option value="" >
                                <?php echo (!empty($_DAT['e_postal']) ? str_replace('value="' . $_DAT['e_postal'] . '"', 'value="' . $_DAT['e_postal'] . '" selected', $_postal) : $_postal); ?>
                        </select>
                    </div>


                    <div class="div_form">
                        <label for="e_avenida">Avenida<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:197px;" type="text" name="e_avenida" id="e_avenida"  maxlength="250">
                    </div>

                    <div class="div_form">
                        <label for="e_calle">Calle<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:197px;" type="text" name="e_calle" id="e_calle"  maxlength="250">
                    </div>

                    <div class="div_form">
                        <label for="e_urbanizacion">Urbanizaci&oacute;n / Sector / Barrio<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['e_urbanizacion']) ? $_DAT['e_urbanizacion'] : '') ?>" class="requerido_" onkeypress="return solo_letras2(event)" style="width:220px;" type="text" name="e_urbanizacion" id="e_urbanizacion"  maxlength="250">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="ee_ceq"> Tipo del &aacute;rea de la residencia <span  style="color:red">*</span></label><br>
                        <select class=" requerido_" name="ee_ceq" id="ee_ceq" style="width:92px;">
                            <option value="" >Seleccione...</option>
                            <option value="QUINTA">Quinta</option>
                            <option value="EDIFICIO">Edificio</option>
                            <option value="C.C">C.C</option>

                        </select>
                        <input value="<?= (!empty($_DAT['e_ceq']) ? $_DAT['e_ceq'] : '') ?>" class="requerido_" onkeypress="return solo_letras2(event)" style="width:204px;" type="text" name="e_ceq" id="e_ceq"  maxlength="50">

                    </div>


                    <div class="div_form">
                        <label for="e_piso">Piso<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['e_piso']) ? $_DAT['e_piso'] : '') ?>" class="requerido_" onkeypress="return solo_letras2(event)" style="width:40px;" type="text" name="e_piso" id="e_piso"  maxlength="2">
                    </div>

                    <div class="div_form">
                        <label for="e_Oficina">Oficina<span  style="color:red">*</span></label><br>
                        <input value="<?= (!empty($_DAT['e_Oficina']) ? $_DAT['e_Oficina'] : '') ?>" class="requerido_" onkeypress="return solo_letras2(event)" style="width:70px;" type="text" name="e_Oficina" id="e_Oficina"  maxlength="8">
                    </div>


                    <div class="div_form">
                        <label for="edctp_telefono">Tel&eacute;fono<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="edctp_telefono" id="edctp_telefono" style="width:70px;">
                            <option value="" >
                                <?php echo (!empty($_DAT['edctp_telefono']) ? str_replace('value="' . $_DAT['edctp_telefono'] . '"', 'value="' . $_DAT['edctp_telefono' . $i] . '" selected', $_opc_area) : $_opc_area); ?>

                        </select>
                        <input value="<?= (!empty($_DAT['ecd_telefono']) ? $_DAT['ecd_telefono'] : '') ?>" class="telefono_ requerido_" onkeypress="return solo_numeros(event)" style="width:55px;" type="text" name="ecd_telefono" id="ecd_telefono" >
                    </div>

                    <div class="div_form">
                        <label for="edctp_telefono2">Otro Tel&eacute;fono<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="edctp_telefono2" id="edctp_telefono2" style="width:70px;">
                            <option value="" >
                                <?php echo (!empty($_DAT['edctp_telefono2']) ? str_replace('value="' . $_DAT['edctp_telefono2'] . '"', 'value="' . $_DAT['edctp_telefono2' . $i] . '" selected', $_opc_area) : $_opc_area); ?>

                        </select>
                        <input value="<?= (!empty($_DAT['ecd_telefono2']) ? $_DAT['ecd_telefono2'] : '') ?>" class="telefono_ requerido_" onkeypress="return solo_numeros(event)" style="width:60px;" type="text" name="ecd_telefono2" id="ecd_telefono2" >
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="edctp_fax">fax</label><br>
                        <select class="" name="edctp_fax" id="edctp_fax" style="width:70px;">
                            <option value="" >
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class=" telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_fax" id="ecd_fax" >
                    </div>

                    <div class="div_form">
                        <label for="emp_email">Correo electr&oacute;nico<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="emp_email" id="emp_email"  style="width:515px;">
                    </div>

                </div>

                <h3>Datos financieros<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>


                    <div class="div_form">
                        <label for="balance_al">Balance al:<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="balance_al" id="balance_al"  readonly>
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="df_banco"><b>Activos</b><br>1. banco:</label><br>
                        <input class="requerido_ moneda_4" onkeypress="return solo_moneda(event)" style="width:105px;text-align: right;" type="text" name="df_banco" id="df_banco"  >
                    </div>
                    <div class="div_form">
                        <label for="df_invercion"><br>2. Inverciones:</label><br>
                        <input class="requerido_ moneda_4" onkeypress="return solo_moneda(event)" style="width:105px;text-align: right;" type="text" name="df_invercion" id="df_invercion"  >
                    </div>
                    <div class="div_form">
                        <label for="df_mobiliario"><br>3. Mobiliario:</label><br>
                        <input class="requerido_ moneda_4" onkeypress="return solo_moneda(event)" style="width:105px;text-align: right;" type="text" name="df_mobiliario" id="df_mobiliario"  >
                    </div>
                    <div class="div_form">
                        <label for="df_vehivulo"><br>4. Veh&iacute;culos:</label><br>
                        <input class="requerido_ moneda_4" onkeypress="return solo_moneda(event)" style="width:100px;text-align: right;" type="text" name="df_vehivulo" id="df_vehivulo"  >
                    </div>
                    <div class="div_form">
                        <label for="df_inmuebles"><br>5. Inmuebles:</label><br>
                        <input class="requerido_ moneda_4" onkeypress="return solo_moneda(event)" style="width:100px;text-align: right;" type="text" name="df_inmuebles" id="df_inmuebles"  >
                    </div>
                    <div class="div_form">
                        <label for="df_tactivos"><br><b>Total Activos</b> (1+2+3+4+5):</label><br>
                        <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:135px;text-align: right;background: #e6e6e6;" type="text" name="df_tactivos" id="df_tactivos" value="0,00"  readonly>
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->       
                    <div class="sep_2"></div>
                    <div class="div_form">
                        <label for="df_tarjetas"><b>Pasivo y patrimonio</b><br>7. tarjetas:</label><br>
                        <input class="requerido_ moneda_5" onkeypress="return solo_moneda(event)" style="width:100px;text-align: right;" type="text" name="df_tarjetas" id="df_tarjetas"  >
                    </div>
                    <div class="div_form">
                        <label for="df_prestamos"><br>8. Prestamos:</label><br>
                        <input class="requerido_ moneda_5" onkeypress="return solo_moneda(event)" style="width:97px;text-align: right;" type="text" name="df_prestamos" id="df_prestamos"  >
                    </div>
                    <div class="div_form">
                        <label for="df_hipoteca"><br>9. Hipoteca:</label><br>
                        <input class="requerido_ moneda_5" onkeypress="return solo_moneda(event)" style="width:94px;text-align: right;" type="text" name="df_hipoteca" id="df_hipoteca"  >
                    </div>
                    <div class="div_form">
                        <label for="df_tpasivo"><br>10. <b>total pasivo (7+8+9)</b>:</label><br>
                        <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:121px;text-align: right;background: #e6e6e6;" type="text" name="df_tpasivo" id="df_tpasivo" value="0,00" readonly >
                    </div>
                    <div class="div_form">
                        <label for="df_patrimonio"><br>Patrimonio (6-10):</label><br>
                        <input class="requerido_ moneda_3" onkeypress="return solo_moneda(event)" style="width:95px;text-align: right;background: #e6e6e6;" type="text" name="df_patrimonio" id="df_patrimonio" value="0,00" readonly >
                    </div>
                    <div class="div_form">
                        <label for="df_total"><br><b>Total pasivo y patrimonio:</b></label><br>
                        <input class="requerido_ moneda_3" onkeypress="return solo_moneda(event)" style="width:140px;text-align: right;background: #e6e6e6;" type="text" name="df_total" id="df_total" readonly >
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
                                        <option value="" >Seleccione...</option>
                                        <?php echo (!empty($_DAT['tp_banco' . ($i - 1)]) ? str_replace('value="' . $_DAT['tp_banco' . ($i - 1)] . '"', 'value="' . $_DAT['tp_banco' . ($i - 1)] . '" selected', $_opc_tp_banco) : $_opc_tp_banco); ?>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="div_form">
                                <label for="cuenta<?= $i; ?>">N&ordm; de Cuenta:</label><br>
                                <input value="<?= (!empty($_DAT['cuenta' . ($i - 1)]) ? $_DAT['cuenta' . ($i - 1)] : '') ?>" class="valida_prod cta_banco" maxlength="24" onkeypress="return solo_numeros(event)" style="width:230px;" type="text" name="cuenta<?= $i; ?>" id="cuenta<?= $i; ?>"  >
                            </div>



                            <div class="div_form">
                                <label for="tp_cuenta<?= $i; ?>">Tipo de cuenta:</label><br>
                                <div style="width:100%;height: 4px;" ></div>
                                Corriente<input class="" type="radio" value="C" name="tp_cuenta<?= $i; ?>">
                                Ahorros<input class="" type="radio" value="A" name="tp_cuenta<?= $i; ?>">
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
                                    <option value="" >Seleccione...</option>
                                    <?php echo $_opc_tp_banco; ?>
                                </select>
                            </div>

                            <div class="div_form">
                                <label for="tjp_cuenta<?= $i; ?>">Tarjeta N&ordm;:</label><br>
                                <input class="valida_prod" maxlength="16" onkeypress="return solo_numeros(event)" style="width:142px;" type="text" name="tjp_cuenta<?= $i; ?>" id="tjp_cuenta<?= $i; ?>"  >
                            </div>
                            <div class="div_form">
                                <label for="tjp_titularidad<?= $i; ?>">Titularidad:</label><br>
                                <div style="width:100%;height: 4px;" ></div>
                                T <input type="radio" value="T" name="tjp_titularidad<?= $i; ?>">
                                S <input type="radio" value="S" name="tjp_titularidad<?= $i; ?>">
                            </div>


                            <div class="div_form">
                                <label for="tjp_limite<?= $i; ?>">L&iacute;mite de cr&eacute;dito:</label><br>
                                <input class="valida_prod maxlength tjp_limite" maxlength="24" onkeypress="return solo_numeros(event)" style="width:100px;text-align: right;" type="text" name="tjp_limite<?= $i; ?>" id="tjp_limite<?= $i; ?>"  >
                            </div>

                            <div class="div_form">
                                <label for="tjp_saldo<?= $i; ?>">Saldo Actual:</label><br>
                                <input class="valida_prod tjp_limite" maxlength="24" onkeypress="return solo_numeros(event)" style="width:100px;text-align: right;" type="text" name="tjp_saldo<?= $i; ?>" id="tjp_saldo<?= $i; ?>"  >
                            </div>

                            <div class="div_form">
                                <label for="tjp_tj<?= $i; ?>">Tipo de tarjeta:</label><br>
                                <select  class="valida_prod" name="tjp_tj<?= $i; ?>" id="tjp_tj<?= $i; ?>" style="width:130px;">
                                    <option value="" >Seleccione...</option>
                                     <option value="BLACK">Black</option>
                                    <option value="CL&Aacute;SICA">Cl&aacute;sica</option>
                                    <option value="DORADA">Dorada</option>
                                    <option value="PLATINUM">Platinum</option>
                                     <option value="OTRO">Otro</option>

                                </select>
                            </div>





                        </div>
                        <?php
                    }
                    ?>
                </div>


                <h3>AUTORIZACI&Oacute;N DE CARGO EN CUENTA<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>

                <div>
                    <div class="prod_banplus ref_ban_comer"> 
                        <div class="div_form">
                            <label for="autor_autorizacion">Autorizo a cargar mensualmente el pago:</label><br>
                            <input class="valida_prod" onkeypress="return solo_email(event)" type="text" name="autor_autorizacion" id="autor_autorizacion"  style="width:381px;">
                        </div>


                        <div class="div_form">
                            <label for="autor_tpago">Titularidad:</label><br>
                            <div style="width:100%;height: 4px;" ></div>
                            M&iacute;nimo <input type="radio" value="M" name="autor_tpago">
                            Total <input type="radio" value="T" name="autor_tpago">
                        </div>

                        <div class="div_form">
                            <label for="autor_cuenta">En mi cuenta N&ordm;:</label><br>
                            <input class="valida_prod cta_banco" maxlength="24" onkeypress="return solo_numeros(event)" style="width:230px;" type="text" name="autor_cuenta" id="autor_cuenta"  >
                        </div>
                    </div>
                </div>
                <h3>DIRECCI&Oacute;N DE CORRESPONDENCIA<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>

                <div>
                    <div class="div_form">
                        <label for="autor_autorizacion">ENV&Iacute;O TARJETA DE CR&Eacute;DITO:<br>Agencia Banplus</label><br>
                        <select class="requerido_" name="env_fn_agencia" id="env_fn_agencia" style="width:250px;">
                            <option value="" >Seleccione...
                                <?php echo $_opc_agencia2 ?>
                        </select>
                    </div>


                    <!--                    ##################### DIV SEPARADOR ############################       
                                        <div class="sep_2"></div>-->


                    <div class="div_form">
                        <label for="corresp_correo"><br>Correo electr&oacute;nico:</label><br>
                        <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="corresp_correo" id="corresp_correo"  style="width:250px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Habitaci&oacute;n <input type="radio" value="H" name="env_tarjeta">
                        Oficina <input type="radio" value="O" name="env_tarjeta">

                    </div>



                </div>


                <h3>Solicitud de tarjetas suplementarias<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span> </h3>
                <div>
                    <?php
                    for ($i = 0; $i <= 1; $i++) {
                        ?>
                        <div class="prod_banplus ref_ban_comer"> 
                            <div class="div_form">
                                <label for="ts_p_nombre<?= $i; ?>">Primer Nombre<span  style="color:red">*</span></label><br>
                                <input style="width: 173px;" class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="ts_p_nombre<?= $i; ?>" id="ts_p_nombre<?= $i; ?>"  maxlength="50">
                            </div>
                            <div class="div_form">
                                <label for="ts_s_nombre<?= $i; ?>">Segundo Nombre:</label><br>
                                <input style="width: 173px;" onkeypress="return solo_letras(event)" type="text" name="ts_s_nombre<?= $i; ?>" id="ts_s_nombre<?= $i; ?>"  maxlength="50">
                            </div>
                            <div class="div_form">
                                <label for="p_apellido<?= $i; ?>">Primer Apellido<span  style="color:red">*</span></label><br>
                                <input style="width: 173px;" class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="ts_p_apellido<?= $i; ?>" id="ts_p_apellido<?= $i; ?>"  maxlength="50">
                            </div>
                            <div class="div_form">
                                <label for="ts_s_apellido<?= $i; ?>">Segundo Apellido:</label><br>
                                <input style="width: 173px;"  onkeypress="return solo_letras(event)" type="text" name="ts_s_apellido<?= $i; ?>" id="ts_s_apellido<?= $i; ?>"  maxlength="50">
                            </div>

                            <!--##################### DIV SEPARADOR ############################--> 
                            <div class="sep_2"></div>

                            <div class="div_form">
                                <label for="tp_documento">C&eacute;dula de Identidad<span  style="color:red">*</span></label><br>
                                <select name="ts_tp_documento<?= $i; ?>" id="ts_tp_documento<?= $i; ?>" class="valida_prod">
                                    <option value="" >
                                    <option value="C">V
                                    <option value="E">E
                                </select>
                                <input maxlength="8" style="width: 130px;" class="valida_prod" onkeypress="return solo_numeros(event)" type="text" name="ts_n_documento<?= $i; ?>" id="ts_n_documento<?= $i; ?>" >
                            </div>

                            <div class="div_form">
                                <label for="fc_nac">Fecha de nacimiento<span  style="color:red">*</span></label><br>
                                <input class="valida_prod" style="width:110px;background: #e6e6e6;" type="text" name="ts_fc_nac<?= $i; ?>"  id="ts_fc_nac<?= $i; ?>"  readonly>
                            </div>

                            <div class="div_form">
                                <label for="tp_sexo" >Sexo<span  style="color:red">*</span></label>
                                <div style="width:100%;height: 4px;" ></div>
                                M<input type="radio" value="M" name="ts_tp_sexo<?= $i; ?>">
                                F<input type="radio" value="F" name="ts_tp_sexo<?= $i; ?>">
                            </div>

                            <div class="div_form">
                                <label for="p_apellido">PARENTESCO<span  style="color:red">*</span></label><br>
                                <input style="width: 135px;" class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="ts_parentesco<?= $i; ?>" id="ts_parentesco<?= $i; ?>"  maxlength="50">
                            </div>

                            <div class="div_form">
                                <label for="s_apellido">FIRMA del solicitante Suplementario:</label><br>
                                <input style="width: 200px;background: #e6e6e6;"  onkeypress="return solo_letras(event)" type="text" name="firma_tarjeta_s<?= $i; ?>" id="firma_tarjeta_s<?= $i; ?>"  maxlength="50" readonly>
                            </div>
                        </div>
                        <?php
                    }
                    ?>



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
                        <label for="go_total_ingresos" style="font-size: 12px;">Original de los tres (3) &uacute;ltimos estados de cuentas bancarios firmados y sellados por el banco emisor.<span  style="color:red">*</span></label><br><br>
                        <input name="f_rif2" type="file" class="custom-file-input requerido_" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>


                    <div class="separador_" style=""></div>

                    <div style="float:left;padding:5px;width: 97%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Constancia de trabajo original membretada con firma y sello de la empresa, con vigencia m&aacute;xima de tres (3) meses indicando ingreso mensual o anual, cargo que desempe&ntilde;a y antig&uuml;edad en la empresa (no menor a doce (12) meses). 
                            Si es profesional de libre ejercicio certificaci&oacute;n de ingresos firmada por un contador p&uacute;blico colegiado donde indique y confirme la profesi&oacute;n del solicitante y el origen de los fondos o si es due&ntilde;o o socio de la empresa Registro Mercantil y su modificaci&oacute;n.<span  style="color:red">*</span></label><br><br>
                        <input name="f_constancia" type="file" class="custom-file-input requerido_" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    

                    <div class="separador_" style=""></div>
                    <div style="float:left;padding:5px;width: 97%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Si tiene una actividad adicional justificar los otros ingresos con un documento original que indique la procedencia de los fondos. Validar si aplica.</label><br><br>
                        <input name="f_declaracion" type="file" class="custom-file-input" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                </div>

                <h3>Agencia<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="20" width="20"style="margin-top: -3px;"></span></h3>
                <div>
                    <div class="div_form" >
                        <label for="fn_agencia">Agencia:</label><br>
                        <select class="requerido_" name="fn_agencia" id="fn_agencia" style="width:400px;">
                            <option value="" >Seleccione...
                                <?php echo $_opc_agencia ?>
                        </select>
                    </div>
                    <div class="div_form" style="float:right;">
                        <label for="fc_cita">Fecha de Cita<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:110px;background: #e6e6e6;" type="text" name="fc_cita" id="fc_cita"  readonly>
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




    