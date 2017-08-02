<?php include 'pre_apertura.php' ?>
<?php include 'envia_correos.php'; ?>
<?php
//echo "</br><pre>";
//var_dump($_POST);
//echo "</pre>";
?>

<br><br>
<?php if (!isset($_POST['p_formulario'])) { ?>
    <form method="POST" id="form_ap_cuenta" enctype="multipart/form-data">
        <input   type="hidden" name="p_formulario" id="p_formulario" value="JURIDICO">

        <div style="background-color:#F4F4F4;overflow:auto;overflow-x:hidden;" class="form_n" > 
            <div id="accordion">
                <h3>Datos De la Empresa<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="n_empresa">Nombre de la empresa<span  style="color:red">*</span></label><br>
                        <input style="width: 548px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="n_empresa" id="n_empresa" value="" maxlength="250" >
                    </div>
                    <div class="div_form">
                        <label for="rif">N&ordm; de r.i.f<span  style="color:red">*</span></label><br>
                        <b>J -</b> <input style="width: 173px;" class="requerido_" onkeypress="return solo_numeros(event)" type="text" name="rif" id="rif" value="">
                    </div>

                    <!--##################### DIV SEPARADOR ############################--> 
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="act_economica">actividad econ&oacute;mica<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="act_economica" id="act_economica" style="width:270px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_acteco; ?>
                        </select>
                    </div>
                    <div class="div_form">
                        <label for="act_otros">De seleccionar otros, Indique:</label><br>
                        <input style="width: 200px;" class="" onkeypress="return solo_letras(event)" type="text" name="act_otros" id="act_otros" value="" disabled="">
                    </div>



                    <div class="div_form">
                        <label for="sect_economico">Sector econ&oacute;mico<span  style="color:red">*</span></label><br>
    <!--                    <select style="width: 270px;" class="requerido_" name="sect_economico" id="sect_economico" style="width:100%">
                            <option value="">Seleccione...
                            <option value="C">Venezuela
                            <option value="p">Casado
                            <option value="p">Viudo
                        </select>    -->
                        <input style="width: 258px;"  class="requerido_" onkeypress="return solo_letras(event)" type="text" name="sect_economico" id="sect_economico" value="">
                    </div>



                    <!--##################### DIV SEPARADOR ############################--> 
                    <div class="sep_2"></div>
                    <div class="div_form">
                        <label for="p_venta">volumen en <br>venta mensual<span  style="color:red">*</span></label><br>
                        <input class="requerido_ jmoneda" onkeypress="return solo_moneda(event)" style="width:207px;text-align: right;" type="text" name="p_venta" id="p_venta" value="" >Bs.
                    </div>

                    <div class="div_form">
                        <label for="p_efectivo">promedio mensual de movimiento <br>de la cuenta en efectivo<span  style="color:red">*</span></label><br>
                        <input class="requerido_ jmoneda" onkeypress="return solo_moneda(event)" style="width:230px;text-align: right;" type="text" name="p_efectivo" id="p_efectivo" value="" >Bs.
                    </div>

                    <div class="div_form">
                        <label for="p_cheque">promedio mensual de movimiento <br>de la cuenta en cheques<span  style="color:red">*</span></label><br>
                        <input class="requerido_ jmoneda" onkeypress="return solo_moneda(event)" style="width:228px;text-align: right;" type="text" name="p_cheque" id="p_cheque" value="" >Bs.
                    </div>


                </div>

                <h3>Direcci&oacute;n de Empresa<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="etp_estado">Estado<span  style="color:red">*</span></label><br>
                        <select  class="_estados requerido_" name="etp_estado" id="etp_estado" style="width:216px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_estados; ?>
                        </select>
                    </div>
                    <div class="div_form">
                        <label for="etp_ciudad">Cuidad<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="etp_ciudad" id="etp_ciudad" style="width:216px;">
                            <option value="">Seleccione...
                        </select>
                    </div>
                    <div class="div_form municipio">
                        <label for="etp_municipio">Municipio<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="etp_municipio" id="etp_municipio" style="width:216px;">
                            <option value="">Seleccione...
                        </select>
                    </div>
                    <div class="div_form">
                        <label for="e_postal">C&oacute;digo postal<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="e_postal" id="e_postal" style="width:92px;">
                            <option value="">
                                <?php echo $_postal; ?>
                        </select>
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->  
                    <div class="sep_2"></div>
                    <div class="div_form">
                        <label for="e_calle">Calle o Avenida<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:236px;" type="text" name="e_calle" id="e_calle" value="" >
                    </div>

                    <div class="div_form">
                        <label for="e_urbanizacion">Urbanizaci&oacute;n<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:240px;" type="text" name="e_urbanizacion" id="e_urbanizacion" value="" >
                    </div>

                    <div class="div_form">
                        <label for="e_ceq"> Edificio / Quinta / torre<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_letras2(event)" style="width:240px;" type="text" name="d_ceq" id="d_ceq" value="" >
                    </div>

                    <div class="div_form">
                        <label for="e_Oficina">Oficina<span  style="color:red">*</span></label><br>
                        <input size="5" class="requerido_" onkeypress="return solo_letras2(event)" style="width:60px;" type="text" name="e_Oficina" id="e_Oficina" value="">
                    </div>

                    <div class="div_form">
                        <label for="e_piso">Piso<span  style="color:red">*</span></label><br>
                        <input size="2" class="requerido_" onkeypress="return solo_letras2(event)" style="width:30px;" type="text" name="e_piso" id="e_piso" value="" >
                    </div>

                    <div class="div_form">
                        <label for="e_local">Local<span  style="color:red">*</span></label><br>
                        <input size="5" class="requerido_" onkeypress="return solo_letras2(event)" style="width:40px;" type="text" name="e_local" id="e_local" value="" >
                    </div>

                    <div class="div_form">
                        <label for="edctp_telefono">Tel&eacute;fono<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="edctp_telefono" id="edctp_telefono" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono" id="ecd_telefono" value="">
                    </div>

                    <div class="div_form">
                        <label for="edctp_telefono2">Otro Tel&eacute;fono<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="edctp_telefono2" id="edctp_telefono2" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_telefono2" id="ecd_telefono2" value="">
                    </div>

                    <div class="div_form">
                        <label for="edctp_fax">fax<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="edctp_fax" id="edctp_fax" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="ecd_fax" id="ecd_fax" value="">
                    </div>


                    <!--##################### DIV SEPARADOR ############################-->  
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="email">Correo electr&oacute;nico<span  style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email" value="" style="width:515px;">
                    </div>
                    <div class="div_form">
                        <label for="tp_inmueble">Tipo inmueble<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="tp_inmueble" id="tp_inmueble" style="width:235px;">
                            <option value="">Seleccione...
                            <option value="PROPIO">Propio
                            <option value="ALQUILADO">Alquilado
                        </select>
                    </div>


                    <div class="cannon">
                        <!--##################### DIV SEPARADOR ############################-->      
                        <div class="sep_2"></div>
                        <div class="div_form">
                            <label for="canon_nombre">Nombre del Arrendador:</label><br>
                            <input onkeypress="return solo_letras(event)" style="width:160px;" type="text" name="canon_nombre" id="canon_nombre" value="" >
                        </div>

                        <div class="div_form">
                            <label for="canon">Canon de Arrendamiento:</label><br>
                            <input class="jmoneda"  onkeypress="return solo_moneda(event)" style="width:170px;text-align: right;" type="text" name="canon" id="canon" value="" > Bs.
                        </div>

                        <div class="div_form">
                            <label for="cannon_telefono">Tel&eacute;fono del Arrendador:</label><br>
                            <select  name="cannon_telefono" id="cannon_telefono" style="width:70px;">
                                <option value="">
                                    <?php echo $_opc_area; ?>
                            </select>
                            <input class="telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="cad_telefono" id="cad_telefono" value="">
                        </div>
                        <div class="div_form">
                            <label for="cannon_telefono2">Otro Tel&eacute;lefono:</label><br>
                            <select  name="cannon_telefono2" id="cannon_telefono2" style="width:70px;">
                                <option value="">
                                    <?php echo $_opc_area; ?>
                            </select>
                            <input  class="telefono_" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="cad_telefono2" id="cad_telefono2" value="">
                        </div>
                    </div>
                </div>

                <h3>empresas relacionadas<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>

                    <?php
                    for ($i = 0; $i <= 2; $i++) {
                        ?>
                        <div class="prod_banplus"> 
                            <div class="div_form">
                                <label for="rele_nombre<?php echo $i; ?>">Nombre de la empresa:</label><br>
                                <input style="width: 233px;" class="valida_prod" onkeypress="return solo_letras2(event)" type="text" name="rele_nombre<?php echo $i; ?>" id="rele_nombre<?php echo $i; ?>" value="">

                            </div>
                            <div class="div_form">
                                <label for="rele_rif<?php echo $i; ?>">N&ordm; de r.i.f:</label><br>
                                <b>J -</b> <input style="width: 100px;" class="valida_prod rele_rif" onkeypress="return solo_numeros(event)" type="text" name="rele_rif<?php echo $i; ?>" id="rele_rif<?php echo $i; ?>" value="">
                            </div>
                            <div class="div_form">
                                <label for="rele_telefono<?php echo $i; ?>">Tel&eacute;fono:</label><br>
                                <select class="valida_prod" name="rele_telefono<?php echo $i; ?>" id="rele_telefono<?php echo $i; ?>" style="width:70px;">
                                    <option value="">
                                        <?php echo $_opc_area; ?>
                                </select>
                                <input class="telefono_ valida_prod" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="erele_telefono<?php echo $i; ?>" id="erele_telefono<?php echo $i; ?>" value="">
                            </div>

                            <div class="div_form">
                                <label for="rele_telefono2<?php echo $i; ?>">Otro Tel&eacute;fono:</label><br>
                                <select class=" valida_prod" name="rele_telefono2<?php echo $i; ?>" id="rele_telefono2<?php echo $i; ?>" style="width:70px;">
                                    <option value="">
                                        <?php echo $_opc_area; ?>
                                </select>
                                <input class="telefono_ valida_prod" onkeypress="return solo_numeros(event)" style="width:99px;" type="text" name="2rele_telefono2<?php echo $i; ?>" id="2rele_telefono2<?php echo $i; ?>" value="">
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>

                <h3>Datos de los productos que posee en Banplus<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>

                    <?php
                    for ($i = 0; $i <= 3; $i++) {
                        ?>
                        <div class="prod_banplus"> 
                            <div style = "float:left;padding:5px;">
                                <label for = "tp_producto<?php echo $i; ?>">Tipo de Producto:</label><br>
                                <select class = "valida_prod" name = "tp_producto<?= $i; ?>" id = "tp_producto<?= $i; ?>" style = "width:155px;">
                                    <option value = "">Seleccione...
                                        <?php echo $_opc_productos
                                        ?>
                                </select>   
                                <!--<input class="requerido_" onkeypress="return solo_letras2(event)" style="width:145px;" type="text" name="tp_producto<?= $i; ?>" id="tp_producto<?= $i; ?>" value="" >-->

                            </div>
                            <div class="div_form">
                                <label for="numero_prod<?= $i; ?>">N&uacute;mero:</label><br>
                                <input class="valida_prod" onkeypress="return solo_numeros(event)" style="width:200px;" type="text" name="numero_prod<?= $i; ?>" id="numero_prod<?= $i; ?>" value="" maxlength="20">
                            </div>
                        </div> 
                        <?php
                    }
                    ?>
                </div>

                <h3>Referencias Bancarias<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>


                    <?php
                    for ($i = 0; $i <= 2; $i++) {
                        ?>
                        <div class="prod_banplus ref_ban_comer"> 
                            <div class="div_form">
                                <label for="tp_banco<?= $i; ?>">Banco:</label><br>
                                <select  class="valida_prod" name="tp_banco<?= $i; ?>" id="tp_banco<?= $i; ?>" style="width:187px;">
                                    <option value="">Seleccione...
                                        <?php echo $_opc_tp_banco; ?>
                                </select>
                            </div>

                            <div class="div_form">
                                <label for="cuenta<?= $i; ?>">N&ordm; de Cuenta o TDC:</label><br>
                                <input class="valida_prod cta_banco" size="24" onkeypress="return solo_numeros(event)" style="width:170px;" type="text" name="cuenta<?= $i; ?>" id="cuenta<?= $i; ?>" value="" >
                            </div>

                            <div class="div_form">
                                <label for="tp_cuenta<?= $i; ?>">Tipo de cuenta:</label><br>
            <!--                        <select class="requerido_" name="tp_cuenta<?= $i; ?>" id="tp_cuenta<?= $i; ?>" style="width:105px;">
                                    <option value = "">Seleccione...               
                                <?php echo $_opc_tp_cuenta; ?>
                                </select>    -->
                                <input class="valida_prod"  onkeypress="return solo_letras(event)" style="width:100px;" type="text" name="tp_cuenta<?= $i; ?>" id="tp_cuenta<?= $i; ?>" value="" maxlength="50" >
                            </div>

                            <div class="div_form">
                                <label for="cuenta_antiguo<?= $i; ?>">Miembro Desde:</label><br>
                                <input class="valida_prod fechas" style="width:77px;background: #e6e6e6;" type="text" name="cuenta_antiguo<?= $i; ?>" id="cuenta_antiguo<?= $i; ?>" value="" readonly>
                            </div>

                            <!--                    <div class="div_form">
                                                    <label for="cuenta_antiguo<?= $i; ?>">Antig&uuml;edad<span  style="color:red">*</span></label><br>
                                                    
                                                    
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
                                <input class="valida_prod" onkeypress="return solo_letras2(event)" style="width:150px;" type="text" name="ag_origen<?= $i; ?>" id="ag_origen<?= $i; ?>" value="" maxlength="100" >
                            </div>

                        </div>
                        <?php
                    }
                    ?>
                </div>

                <h3>Referencias Comerciales<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>
                    <?php
                    for ($i = 0; $i <= 1; $i++) {
                        ?>
                        <div class="prod_banplus ref_ban_comer"> 
                            <div class="div_form">
                                <label for="rc_empresa<?= $i; ?>">Empresa / Comercio<span  style="color:red">*</span></label><br>
                                <input class="valida_prod" style="width: 202px;" onkeypress="return solo_letras2(event)" type="text" name="rc_empresa<?= $i; ?>" id="rc_empresa<?= $i; ?>" value="" maxlength="250">
                            </div>

                            <div class="div_form">
                                <label for="rctp_ramo<?= $i; ?>">Activida / Ramo<span  style="color:red">*</span></label><br>
                                <input class="valida_prod" onkeypress="return solo_letras(event)" type="text" name="rctp_ramo<?= $i; ?>" id="rctp_ramo<?= $i; ?>" value="" maxlength="100">
                            </div>

                            <div class="div_form">
                                <label for="rtp_telefonoH<?= $i; ?>">Tel&eacute;fono Hab.<span  style="color:red">*</span></label><br>
                                <select class="valida_prod" name="dtp_telefonoH<?= $i; ?>" id="dtp_telefonoH<?= $i; ?>" style="width:70px;">
                                    <option value="">
                                        <?php echo $_opc_area; ?>
                                </select>
                                <input class="valida_prod telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefonoh<?= $i; ?>" id="d_telefonoh<?= $i; ?>" value="">
                            </div>

                            <div class="div_form">
                                <label for="dtp_telefono2<?= $i; ?>">Otro Tel&eacute;fono<span  style="color:red">*</span></label><br>
                                <select class="valida_prod" name="dtp_telefono2<?= $i; ?>" id="dtp_telefono2<?= $i; ?>" style="width:70px;">
                                    <option value="">
                                        <?php echo $_opc_area; ?>
                                </select>
                                <input class="valida_prod telefono_" onkeypress="return solo_numeros(event)" style="width:100px;" type="text" name="d_telefono2<?= $i; ?>" id="d_telefono2<?= $i; ?>" value="">
                            </div>
                        </div>
                        <?php
                    }
                    ?>   
                </div> 

                <h3>Datos De registro de la empresa<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>
                    <div class="div_form">
                        <label for="ofic_registro">oficina de registro<span  style="color:red">*</span></label><br>
                        <input style="width: 394px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="ofic_registro" id="ofic_registro" value="" maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="tomo_registro">N&ordm; registro<span  style="color:red">*</span></label><br>
                        <input style="width: 100px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="tomo_registro" id="tomo_registro" value="" maxlength="50">
                    </div>
                    <div class="div_form">
                        <label for="tomo_tomo">Tomo<span  style="color:red">*</span></label><br>
                        <input style="width: 100px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="tomo_tomo" id="tomo_tomo" value="" maxlength="20">
                    </div><div class="div_form">
                        <label for="tomo_fecha">Fecha<span  style="color:red">*</span></label><br>
                        <input readonly style="width: 100px;background: #e6e6e6;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="tomo_fecha" id="tomo_fecha" value="">
                    </div>
                    <!--##################### DIV SEPARADOR ############################-->      
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="regis_estado">Estado<span  style="color:red">*</span></label><br>
                        <select  class="_estados requerido_" name="regis_estado" id="regis_estado" style="width:180px;">
                            <option value="">Seleccione...
                                <?php echo $_opc_estados; ?>
                        </select>
                    </div>
                    <div class="div_form">
                        <label for="regis_ciudad">Cuidad<span  style="color:red">*</span></label><br>
                        <select class="requerido_" name="regis_ciudad" id="regis_ciudad" style="width:180px;">
                            <option value="">Seleccione...
                        </select>
                    </div>

                    <div class="div_form">
                        <label for="duracion_empresa">duraci&oacute;n de la empresa<span style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:43px" type="number" name="duracion_empresa" id="duracion_empresa" value="" min="0" max="2000">
                        <select style="width:98px" class="requerido_" name="duracion_empresa_op" id="duracion_empresa_op">
                            <option value="">Seleccione...
                            </option><option value="DIAS">Días
                            </option><option value="SEMANAS">Semanas
                            </option><option value="MESES">Meses
                            </option><option value="AÃ‘OS">Años
                            </option></select>   
                    </div>

                    <div class="div_form">
                        <label for="empleados">empleados<span style="color:red">*</span></label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:59px" type="number" name="empleados" id="empleados" value="" min="0" max="99999999">
                    </div>

                    <div class="div_form">
                        <label for="repr_legal">representante legal<span  style="color:red">*</span></label><br>
                        <input style="width: 133px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="repr_legal" id="repr_legal" value="" maxlength="50">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->      
                    <div class="sep_2"></div>
                    <div class="div_form">
                        <label for="cierre_fiscal">Fecha de cierre fiscal<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:126px;background: #e6e6e6;" type="text" name="cierre_fiscal" id="cierre_fiscal" value="" readonly>
                    </div>


                    <div class="div_form">
                        <label for="domicilio_fisca">domicilio fiscal<span  style="color:red">*</span></label><br>
                        <input style="width: 245px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="domicilio_fisca" id="domicilio_fisca" value="">
                    </div>
                    <div class="div_form">
                        <label for="objeto_fiscal">objeto fiscal<span  style="color:red">*</span></label><br>
                        <input style="width: 345px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="objeto_fiscal" id="objeto_fiscal" value="">
                    </div>

                    <!--##################### DIV SEPARADOR ############################-->      
                    <div class="sep_2"></div>

                    <div class="div_form">
                        <label for="capt_suscrito">capital suscrito<span  style="color:red">*</span></label><br>
                        <input class="jmoneda requerido_" onkeypress="return solo_moneda(event)" style="width:216px;text-align: right;" type="text" name="capt_suscrito" id="capt_suscrito" value=""> Bs.
                    </div>
                    <div class="div_form">
                        <label for="capt_pagado">capital pagado<span  style="color:red">*</span></label><br>
                        <input class="jmoneda requerido_" onkeypress="return solo_moneda(event)" style="width:216px;text-align: right;" type="text" name="capt_pagado" id="capt_pagado" value=""> Bs.
                    </div>
                    <div class="div_form">
                        <label for="capt_reservas">reservas de capital<span  style="color:red">*</span></label><br>
                        <input class="jmoneda requerido_" onkeypress="return solo_moneda(event)" style="width:216px;text-align: right;" type="text" name="capt_reservas" id="capt_reservas" value=""> Bs.
                    </div>



                </div>

                <h3>Datos De registro &uacute;ltima modificaci&oacute;n<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>


                    <div class="div_form">
                        <label for="ult_fecha">Fecha<span  style="color:red">*</span></label><br>
                        <input class="requerido_" style="width:80px;background: #e6e6e6;" type="text" name="ult_fecha" id="ult_fecha" value="" readonly>
                    </div>

                    <div class="div_form">
                        <label for="ult_registro">N&ordm; registro<span  style="color:red">*</span></label><br>
                        <input style="width: 299px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="ult_registro" id="ult_registro" value="" maxlength="250">
                    </div>
                    <div class="div_form">
                        <label for="ult_tomo">tomo<span  style="color:red">*</span></label><br>
                        <input style="width: 85px;" class="requerido_" onkeypress="return solo_letra2s(event)" type="text" name="ult_tomo" id="ult_tomo" value="" maxlength="50">
                    </div>

                    <div class="div_form">
                        <label for="ult_lugar">lugar<span  style="color:red">*</span></label><br>
                        <input style="width: 230px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="ult_lugar" id="ult_lugar" value="" maxlength="50">
                    </div>

                </div>


                <h3>ACCIONISTAS ACTUALES<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>

                    <?php
                    $class = "";
                    for ($i = 0; $i <= 4; $i++) {
                        if ($i == 0)
                            $class = "requerido_";
                        else
                            $class = "valida_prod";
                        ?>
                        <div class="prod_banplus"> 
                            <div class="div_form">
                                <label for="act_nombre<?= $i; ?>">Nombre / Raz&oacute;n social<span  style="color:red">*</span></label><br>
                                <input style="width: 180px;" class="<?= $class ?>" onkeypress="return solo_letras2(event)" type="text" name="act_nombre<?= $i; ?>" id="act_nombre<?= $i; ?>" value="" maxlength="250">
                            </div>
                            <div class="div_form">
                                <label for="actp_documento<?= $i; ?>">C.I / R.I.F <span  style="color:red">*</span></label><br>
                                <select name="actp_documento<?= $i; ?>" id="tp_documento<?= $i; ?>" class="<?= $class ?>">
                                    <option value="">
                                    <option value="C">C.I
                                    <option value="J">J

                                </select>
                                <input style="width: 115px;" class="<?= $class ?>" onkeypress="return solo_numeros(event)" type="text" name="actp_ndocumento<?= $i; ?>" id="actp_ndocumento<?= $i; ?>" value="" maxlength="9">
                            </div>

                            <div class="div_form">
                                <label for="ac_capital<?= $i; ?>">capital suscrito:</label><br>
                                <input class="<?= $class ?> jmoneda2 jmoneda2s" onkeypress="return solo_moneda(event)" style="width:143px;text-align: right;" type="text" name="ac_capital<?= $i; ?>" id="ac_capital<?= $i; ?>" value="">
                            </div>
                            <div class="div_form">
                                <label for="ac_porcentaje<?= $i; ?>">%:</label><br>
                                <input class="<?= $class ?> jmoneda2 jmoneda2_p" onkeypress="return solo_moneda(event)" size="4" style="width:40px;text-align: right;" type="text" name="ac_porcentaje<?= $i; ?>" id="ac_porcentaje<?= $i; ?>" value="" >

                            </div>
                            <div class="div_form">
                                <label for="act_pagado<?= $i; ?>">capital pagado:</label><br>
                                <input class="<?= $class ?> jmoneda2 jmoneda2p" onkeypress="return solo_moneda(event)"  style="width:143px;text-align: right;" type="text" name="act_pagado<?= $i; ?>" id="act_pagado<?= $i; ?>" value="">
                            </div>
                        </div>
                    <?php } ?>

                    <div style="float:left;padding:5px;width: 380px;">
                        <br>
                    </div>

                    <div class="div_form">
                        <label for="act_total_sus">TOTAL suscrito:</label><br>
                        <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:143px;text-align: right;background: #e6e6e6;" type="text" name="act_total_sus" id="act_total_sus" value="0,00">
                    </div>
                    <div class="div_form">
                        <label for="act_total_percent">TOTAL %:</label><br>
                        <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:40px;background: #e6e6e6;text-align: right;"" type="text" name="act_total_percent" id="act_total_percent" value="0,00" >

                    </div>
                    <div class="div_form">
                        <label for="act_total_pagado">TOTAL pagado:</label><br>
                        <input class="requerido_" onkeypress="return solo_moneda(event)" style="width:143px;text-align: right;background: #e6e6e6;" type="text" name="act_total_pagado" id="act_total_pagado" value="0,00">

                    </div>

                </div>


                <h3>PERSONAS AUTORIZADAS A MANTENER RELACION CON LA ENTIDAD <span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>

                    <?php
                    $class = "";
                    for ($i = 0; $i <= 3; $i++) {
                        if ($i == 0)
                            $class = "requerido_";
                        else
                            $class = "valida_prod";
                        ?>

                        <div class="div_form">
                            <label for="p_nombre<?= $i; ?>">Primer Nombre<span  style="color:red">*</span></label><br>
                            <input style="width: 128px;" class="<?= $class ?>" onkeypress="return solo_letras(event)" type="text" name="p_nombre<?= $i; ?>" id="p_nombre<?= $i; ?>" value="" maxlength="50">
                        </div>
                        <div class="div_form">
                            <label for="s_nombre<?= $i; ?>">Segundo Nombre:</label><br>
                            <input style="width: 128px;" class="" onkeypress="return solo_letras(event)" type="text" name="s_nombre<?= $i; ?>" id="s_nombre<?= $i; ?>" value="" maxlength="50">
                        </div>
                        <div class="div_form">
                            <label for="p_apellido<?= $i; ?>">Primer Apellido<span  style="color:red">*</span></label><br>
                            <input style="width: 128px;" class="<?= $class ?>" onkeypress="return solo_letras(event)" type="text" name="p_apellido<?= $i; ?>" id="p_apellido<?= $i; ?>" value="" maxlength="50">
                        </div>
                        <div class="div_form">
                            <label for="s_apellido<?= $i; ?>">Segundo Apellido:</label><br>
                            <input style="width: 128px;" class="" onkeypress="return solo_letras(event)" type="text" name="s_apellido<?= $i; ?>" id="s_apellido<?= $i; ?>" value="" maxlength="50">
                        </div>

                        <div class="div_form">
                            <label for="tp_documento<?= $i; ?>">C.I / PASAPORTE <span  style="color:red">*</span></label><br>
                            <select name="tp_documento<?= $i; ?>" id="tp_documento<?= $i; ?>" class="<?= $class ?>">
                                <option value="">
                                <option value="V">V
                                <option value="E">E
                                <option value="P">P
                            </select>
                            <input style="width: 109px;" class="<?= $class ?>" onkeypress="return solo_numeros(event)" type="text" name="n_documento<?= $i; ?>" id="n_documento<?= $i; ?>" value="" maxlength="9">
                        </div>

                    <?php } ?>
                    <!--##################### DIV SEPARADOR ############################-->      
                    <div class="sep_2"></div>
                    <?php
                    for ($i = 0; $i <= 3; $i++) {
                        if ($i == 0)
                            $class = "requerido_";
                        else
                            $class = "valida_prod";
                        ?>
                        <div class="div_form">
                            <label for="tp_nacionalidad<?= $i; ?>">Nacionalidad<span  style="color:red">*</span></label><br>
                            <select class="<?= $class ?>" name="tp_nacionalidad<?= $i; ?>" id="tp_nacionalidad<?= $i; ?>" style="width:110px; ">
                                <option value="">Seleccione...
                                    <?php echo $_opc_tp_nacionalidad; ?>
                            </select>
                        </div>

                        <div class="div_form">
                            <label for="tp_profecion<?= $i; ?>">Profesi&oacute;n u oficio<span  style="color:red">*</span></label><br>
                            <select class="<?= $class ?>" name="tp_profecion<?= $i; ?>" id="tp_profecion<?= $i; ?>" style="width:124px;">
                                <option value="">Seleccione...
                                    <?php echo $_opc_profesion ?>
                            </select>
                        </div>

                        <div class="div_form">
                            <label for="tp_ocupacion<?= $i; ?>">Ocupaci&oacute;n<span  style="color:red">*</span></label><br>
                            <input style="width: 101px;" class="<?= $class ?>" onkeypress="return solo_letras(event)" type="text" name="tp_ocupacion<?= $i; ?>" id="tp_ocupacion<?= $i; ?>" value="" maxlength="100">

                        </div>

                        <div class="div_form">
                            <label for="dtp_telefonoH<?= $i; ?>">Tel&eacute;fono Hab.<span  style="color:red">*</span></label><br>
                            <select class="<?= $class ?>" name="dtp_telefonoH<?= $i; ?>" id="dtp_telefonoH<?= $i; ?>" style="width:60px;">
                                <option value="">
                                    <?php echo $_opc_area; ?>
                            </select>
                            <input class="telefono_ <?= $class ?>" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="d_telefonoh<?= $i; ?>" id="d_telefonoh<?= $i; ?>" value="">
                        </div>

                        <div class="div_form">
                            <label for="dtp_telefono2<?= $i; ?>">Otro Tel&eacute;fono<span  style="color:red">*</span></label><br>
                            <select class="<?= $class ?>" name="dtp_telefono2<?= $i; ?>" id="dtp_telefono2<?= $i; ?>" style="width:60px;">
                                <option value="">
                                    <?php echo $_opc_area; ?>
                            </select>
                            <input class="<?= $class ?> telefono_" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="d_telefono2<?= $i; ?>" id="d_telefono2<?= $i; ?>" value="">
                        </div>

                        <div class="div_form">
                            <label for="dtp_celular<?= $i; ?>">Celular<span  style="color:red">*</span></label><br>
                            <select class="<?= $class ?>" name="dtp_celular<?= $i; ?>" id="dtp_celular<?= $i; ?>" style="width:60px;">
                                <option value="">
                                    <?php echo $_opc_cel; ?>
                            </select>
                            <input class="<?= $class ?> telefono_" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="d_celular<?= $i; ?>" id="d_celular<?= $i; ?>" value="">
                        </div>

                    <?php } ?> 
                </div>



                <h3>Documentos Requeridos<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>

                    <div style="float:left;padding:5px;width: 95%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Copia del Registro de Información Fiscal (RIF), vigente y actualizado.<span  style="color:red">*</span></label><br><br>
                        <input name="f_reg_fiscal" type="file" class="custom-file-input requerido_" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    <div class="separador_" style=""></div>


                    <div style="float:left;padding:5px;width: 95%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Copia de los documentos constitutivos de la empresa, sus estatutos sociales y modificaciones posteriores, debidamente inscritos en el registro competente.<span  style="color:red">*</span></label><br><br>
                        <input name="f_estatus_empresa" type="file" class="custom-file-input requerido_" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    <div class="separador_" style=""></div>

                    <div style="float:left;padding:5px;width: 95%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Última declaración de Impuesto Sobre la Renta (ISLR) emitida por el SENIAT.<span  style="color:red">*</span></label><br><br>
                        <input name="f_declaracion" type="file" class="custom-file-input requerido_" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    <div class="separador_" style=""></div>


                    <div style="float:left;padding:5px;width: 95%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Una (1) Referencia Bancaria o Comercial. No más de 30 días emitidos.<span  style="color:red">*</span></label><br><br>
                        <input name="f_referencia" type="file" class="custom-file-input" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>
                    <div class="separador_" style=""></div>

                    <div style="float:left;padding:5px;    width: 95%;">
                        <label for="go_total_ingresos" style="font-size: 12px;">Copia de la cédula de identidad laminada (para personas venezolanas y extranjeras residenciadas en el país) o pasaporte (para personas extranjeras no residenciadas en el país), del (los) firmante(s).<span  style="color:red">*</span></label><br><br>
                        <input name="f_firma_1" type="file" class="custom-file-input requerido_" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                        <input name="f_firma_2" type="file" class="custom-file-input" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                        <input name="f_firma_3" type="file" class="custom-file-input" style="width: 100%;"><span class='error' style="padding: 5px;"></span>
                    </div>



                </div>
                <h3>Agencia<span style="float:right;display: none;" class="_alert_span"><img src="img/Error-128.png" alt="" height="25" width="25"style="margin-top: -5px;"></span></h3>
                <div>
                    <div class="div_form" >
                        <label for="fn_agencia">Agencia:</label><br>
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
                        <input id="agencia_direccion" name="agencia_direccion" type="text" class="" style="width: 760px;background: #e6e6e6;"></span>
                    </div>
                </div>


            </div>
            
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



            <div style="float:left;padding:5px;width: 95%;text-align: right;margin-top: 20px;">
                <button type="submit" value="Submit">Enviar</button>
            </div>

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




