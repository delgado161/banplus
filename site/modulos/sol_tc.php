<?php include 'pre_apertura.php' ?>;

<br><br>

<form method="POST" id="form_ap_cuenta">


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
                <div style="float:left;padding:5px;">
                    <label for="tp_documento">C&eacute;dula de identidad:<span  style="color:red">*</span></label><br>
                    <select name="tp_documento" id="tp_documento" class="requerido_">
                        <option value="">
                        <option value="V">V
                        <option value="E">E
                    </select>
                    <input style="width: 70px;" class="requerido_" onkeypress="return solo_letras2(event)" type="text" name="n_documento" id="n_documento" value="">
                </div>
                <div style="float:left;padding:5px;">
                    <label for="naturalizado">naturalizado N&ordm; C.I anteriol:</label><br>
                    <input style="width: 150px;" class="" onkeypress="return solo_letras2(event)" type="text" name="naturalizado" id="naturalizado" value="">
                </div>

                <div style="float:left;padding:5px;">
                    <label for="s_apellido">N&ordm; de r.i.f:<span  style="color:red">*</span></label><br>
                    <b>J -</b> <input style="width: 70px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
                </div>
                <div style="float:left;padding:5px;">
                    <label for="s_apellido">pasaporte:<span  style="color:red">*</span></label><br>
                    <input style="width: 115px;" class="requerido_" onkeypress="return solo_letras(event)" type="text" name="s_apellido" id="s_apellido" value="">
                </div>

                <div class="div_form">
                    <label for="tp_civil">Estado Civil:<span  style="color:red">*</span></label><br>
                    <select style="    width: 115px;" class="requerido_" name="tp_civil" id="tp_civil">
                        <option value="">Seleccione...
                        <option value="S">Soltero
                        <option value="C">Casado
                        <option value="D">Divorciado 
                        <option value="V">Viudo

                    </select>
                </div>

                <div class="div_form">
                    <label for="tp_sexo" >Sexo:<span  style="color:red">*</span></label>
                    <div style="width:100%;height: 4px;" ></div>
                    M<input type="radio" value="M" name="tp_sexo">
                    F<input type="radio" value="F" name="tp_sexo">
                </div>

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



                <!--##################### DIV SEPARADOR ############################-->  
                <div class="sep_2"></div>
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
                    <input class="requerido_" onkeypress="return solo_email(event)" type="text" name="email" id="email" value="" style="width:490px;">
                </div>
            </div>


            <h3>DATOS DEL C&oacute;NYUGE :</h3>
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

                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="cctp_documento">N&uacute;mero de identificaci&oacute;n:</label><br>
                    <select name="cctp_documento" id="cctp_documento" class="">
                        <option value="">
                        <option value="C">V
                        <option value="E">E
                    </select>
                    <input style="width: 140px;" class="" onkeypress="return solo_numeros(event)" type="text" name="n_documento" id="n_documento" value="">
                </div>

                <div style="float:left;padding:5px;">
                    <label for="cc_empresa">Empresa donde trabaja actualmente:</label><br>
                    <input class="" onkeypress="return solo_letras2(event)" style="width:210px;text-align: right;" type="text" name="cc_empresa" id="cc_empresa" value="" >
                </div> 


                <div style="float:left;padding:5px;">
                    <label for="cctp_telefonoH">Tel&eacute;fono Hab.:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="cctp_telefonoH" id="cctp_telefonoH" style="width:60px;">
                        <option value="">
                            <?php echo $_opc_area; ?>
                    </select>
                    <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:50px;" type="text" name="ccd_telefonoh" id="ccd_telefonoh" value="">
                </div>

                <div style="float:left;padding:5px;">
                    <label for="cc_sueldo">Sueldo mensual:<span  style="color:red">*</span></label><br>
                    <input class="requerido_ jmoneda" onkeypress="return solo_moneda(event)" style="width:187px;text-align: right;" type="text" name="cc_sueldo" id="cc_sueldo" value="0,00" >
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
                    <label for="ccemail">Correo electr&oacute;nico:</label><br>
                    <input class="" onkeypress="return solo_email(event)" type="text" name="ccemail" id="ccemail" value="" style="width:450px;">
                </div>

            </div>

            <h3>Direcci&oacute;n de Habitaci&oacute;n:</h3>
            <div>
                <div class="div_form">
                    <label for="dtp_estado">Estado:<span  style="color:red">*</span></label><br>
                    <select class="_estados requerido_" name="dtp_estado" id="dtp_estado" style="width:185px;">
                        <option value="">Seleccione...
                            <?php echo $_opc_estados; ?>
                    </select>
                </div>
                <div class="div_form">
                    <label for="dtp_ciudad">Cuidad:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="dtp_ciudad" id="dtp_ciudad" style="width:185px;">
                        <option value="">Seleccione...
                    </select>
                </div>
                <div class="div_form">
                    <label for="dtp_municipio">Municipio:<span  style="color:red">*</span></label><br>
                    <select class="_estados requerido_" name="dtp_municipio" id="dtp_municipio" style="width:185px;">
                        <option value="">Seleccione...
                    </select>
                </div>
                <div class="div_form">
                    <label for="dtp_parroquia">Parroquia:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="dtp_parroquia" id="dtp_parroquia" style="width:185px;">
                        <option value="">Seleccione...
                    </select>
                </div>

                <!--##################### DIV SEPARADOR ############################-->
                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="d_postal">C&oacute;digo postal:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:79px;" type="text" name="d_postal" id="d_postal" value="" >
                </div>

                <div class="div_form">
                    <label for="d_avenida">Avenida:<span  style="color:red">*</span></label><br>
                    <input size="50" class="requerido_" onkeypress="return solo_letras2(event)" style="width:205px;" type="text" name="d_avenida" id="d_avenida" value="" >
                </div>

                <div class="div_form">
                    <label for="d_calle">Calle:<span  style="color:red">*</span></label><br>
                    <input size="50" class="requerido_" onkeypress="return solo_letras2(event)" style="width:205px;" type="text" name="d_calle" id="d_calle" value="" >
                </div>

                <div class="div_form">
                    <label for="d_urbanizacion">Urbanizaci&oacute;n / Sector / barrio:<span  style="color:red">*</span></label><br>
                    <input style="width:204px;" class="requerido_" onkeypress="return solo_letras2(event)"  type="text" name="d_urbanizacion" id="d_urbanizacion" value="" >
                </div>

                <!--##################### DIV SEPARADOR ############################-->
                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="d_casa">Nombre o N&ordm;:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="dtp_vivienda" id="dtp_vivienda" style="width:115px;">
                        <option value="">Seleccione...
                        <option value="1">Casa
                        <option value="2">Quinta
                        <option value="3">Edificio
                    </select>
                    <input style="width:90px;" class="requerido_" onkeypress="return solo_letras2(event)"  type="text" name="d_casa" id="d_casa" value="" >

                </div>

                <div class="div_form">
                    <label for="e_antiguo">A&ntilde;os en esta direcci&oacute;n:<span  style="color:red">*</span></label><br>
                    <input class="requerido_" onkeypress="return solo_numeros(event)" style="width:130px" type="number" name="e_antiguo" id="e_antiguo" value="" min="0" max="2000" >
                </div>

                <div class="div_form">
                    <label for="dtp_telefonoH">Tel&eacute;fono Hab.:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="dtp_telefonoH" id="dtp_telefonoH" style="width:70px;">
                        <option value="">
                            <?php echo $_opc_area; ?>
                    </select>
                    <input class="requerido_ telefono_" onkeypress="return solo_numeros(event)" style="width:91px;" type="text" name="d_telefonoh" id="d_telefonoh" value="">
                </div>

                <div class="div_form">
                    <label for="d_vivienda">Vivienda:<span  style="color:red">*</span></label><br>
                    <select class="requerido_" name="d_vivienda" id="d_vivienda" style="width:204px;">
                        <option value="">Seleccione...
                        <option value="1">De mis padres
                        <option value="2">Propia
                        <option value="3">Propia hipotecada
                        <option value="4">De un familiar
                        <option value="4">Alquilada
                    </select>
                </div>


                <!--##################### DIV SEPARADOR ############################-->
                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="">Si la vivienda es propia,indique a&ntilde;o de adquisici&oacute;n:</label><br>
                    <input class=" fechas" style="width:286px;background: #e6e6e6;" type="text" name="cuenta_antiguo<?= $i; ?>" id="cuenta_antiguo<?= $i; ?>" value="" readonly>
                </div>

                <div class="cannon">

                </div>

                <!--##################### DIV SEPARADOR ############################-->      
                <div class="cannon">
                    <div class="sep_2 "></div>
                    <div class="div_form">
                        <label for="canon">Alquiler o cuota hipotecaria:</label><br>
                        <input  onkeypress="return solo_moneda(event)" style="width:162px;text-align: right;" type="text" name="canon" id="canon" value="" >
                    </div>
                    <div class="div_form">
                        <label for="canon_nombre">Nombre del acreedor / hipotecario o arrendador:</label><br>
                        <input onkeypress="return solo_letras(event)" style="width:282px;" type="text" name="canon_nombre" id="canon_nombre" value="" >
                    </div>
                    <div class="div_form">
                        <label for="cannon_telefono">Tel&eacute;fono del Arrendador:</label><br>
                        <select  name="cannon_telefono" id="cannon_telefono" style="width:70px;">
                            <option value="">
                                <?php echo $_opc_area; ?>
                        </select>
                        <input class="telefono_" onkeypress="return solo_numeros(event)" style="width:76px;" type="text" name="cannond_telefono" id="cannond_telefono" value="">
                    </div>

                    <div class="div_form">
                        <label for="canon_credito">N&uacute;mero de cr&eacute;dito:</label><br>
                        <input onkeypress="return solo_letras(event)" style="width:98px;" type="text" name="canon_credito" id="canon_credito" value="" >
                    </div>
                </div>

                <!--##################### DIV SEPARADOR ############################-->
                <div class="sep_2"></div>

                <div class="div_form">
                    <label for="d_propiedades">Otras propiedades que posee:<span  style="color:red">*</span></label><br>
                    <input type="checkbox" name="d_propiedades" value="1">Apartamentos&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="d_propiedades" value="2">Terrenos&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="d_propiedades" value="3">Locales&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="d_propiedades" value="4">Automóvil&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="d_propiedades" value="5">Motocicleta&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="d_propiedades" value="6">Otro&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="d_propiedades" value="7">Ninguna

                  
                </div>



            </div>

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




