<!--/* 
Created on : 24/05/2017, 03:37:05 PM
Author     : Roberto Delgado
*/-->
<?php
//var_dump($_POST);

if (isset($_POST['p_formulario']) && $_POST['p_formulario'] == "NATURAL") {


    $_POST['act_economica'] = explode("_", $_POST['act_economica']);
    $_POST['act_economica'] = $_POST['act_economica'][0];

//    var_dump($_POST);


    Foreach ($Estados as $estado) {
        if ($estado['id2_estado'] == $_POST['dtp_estado'])
            $_POST['dtp_estado'] = $estado['nombre'];

        if ($estado['id2_estado'] == $_POST['etp_estado'])
            $_POST['etp_estado'] = $estado['nombre'];
    }




    $_POST['dtp_ciudad'] = explode(",", $_POST['dtp_ciudad']);
    $_POST['etp_ciudad'] = explode(",", $_POST['etp_ciudad']);

    foreach ($Ciudades as $Ciudad) {

        if ($Ciudad['lf_estado'] == $_POST['dtp_ciudad'][0] && $_POST['dtp_ciudad'][1] == $Ciudad['id_banplus']) {
            $_POST['dtp_ciudad'] = $Ciudad['ciudad'];
        }


        if ($Ciudad['lf_estado'] == $_POST['etp_ciudad'][0] && $_POST['etp_ciudad'][1] == $Ciudad['id_banplus'])
            $_POST['etp_ciudad'] = $Ciudad['ciudad'];
    }

    actualizar_campo('inserta_cita', [$_POST['fn_agencia'], $_POST['fc_cita'], 'ACPN_' . $_POST['tp_documento'] . $_POST['n_documento'], serialize($_POST)]);

    foreach ($AGENCIA as $agencia) {
        if ($agencia['id_agencias'] == $_POST['fn_agencia'])
            $_POST['fn_agencia'] = $agencia['nombre'];
    }


    if (!file_exists(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'])) {
        mkdir(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'], 0777, true);
    }


    $uploaddir = dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . "/";

    $path = $_FILES['f_cedula']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $uploadfile = $uploaddir . $_POST['tp_documento'] . $_POST['n_documento'] . '_CEDULA.' . $ext;
    move_uploaded_file($_FILES['f_cedula']['tmp_name'], $uploadfile);

    $path = $_FILES['f_rif']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $uploadfile = $uploaddir . $_POST['tp_documento'] . $_POST['n_documento'] . '_RIF.' . $ext;
    move_uploaded_file($_FILES['f_rif']['tmp_name'], $uploadfile);


    $path = $_FILES['f_constancia']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $uploadfile = $uploaddir . $_POST['tp_documento'] . $_POST['n_documento'] . '_CONSTANCIA.' . $ext;
    move_uploaded_file($_FILES['f_constancia']['tmp_name'], $uploadfile);

    if (!empty($_FILES['f_referencia']['name'])) {
        $path = $_FILES['f_referencia']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . $_POST['tp_documento'] . $_POST['n_documento'] . '_REFERENCIA.' . $ext;
        move_uploaded_file($_FILES['f_referencia']['tmp_name'], $uploadfile);
    }

    if (!empty($_FILES['f_firma']['name'])) {
        $path = $_FILES['f_firma']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . $_POST['tp_documento'] . $_POST['n_documento'] . '_FIRMAPERONAL.' . $ext;
        move_uploaded_file($_FILES['f_firma']['tmp_name'], $uploadfile);
    }
    if (!empty($_FILES['f_declaracion']['name'])) {
        $path = $_FILES['f_declaracion']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . $_POST['tp_documento'] . $_POST['n_documento'] . '_DECLARACION.' . $ext;
        move_uploaded_file($_FILES['f_declaracion']['tmp_name'], $uploadfile);
    }
    
    $ruta = execute_sql("get_parametro", array(66));
    $ruta = $ruta[1]["valor"];
    ?>


    

    <form method="POST" id="form_continuar" enctype="multipart/form-data" action="p_contenido.php?<?=$ruta?>">
        <input   type="hidden" name="p_proceso_id" id="p_proceso_id" value="<?= ('ACPN_' . $_POST['tp_documento'] . $_POST['n_documento']) ?>">

    </form>

    <script>
        $(document).ready(function () {

            $.ajax({
                url: 'modulos/pdf_cpn.php',
                data: <?php echo json_encode($_POST) ?>,
                error: function (xhr, status, error) {
                    //                var err = eval("(" + xhr.responseText + ")");
                    //                alert(error);
                },
                success: function (data) {

                    $.ajax({
                        url: 'modulos/correo.php',
                        data: <?php echo json_encode($_POST) ?>,
                        error: function (xhr, status, error) {

                        },
                        success: function (data) {
                            $('.spiner_').hide();
                            var r = confirm("\u00bfDesea realizar la solicitud de TDC?");
                            if (r == true) {
                              $('#form_continuar').submit();
                            } else {
                                txt = "You pressed Cancel!";
                            }
                        },
                        type: 'POST'
                    });
                },
                type: 'POST'
            });
        });
    </script>

    <?php
}
?>

<?php
if (isset($_POST['p_formulario']) && $_POST['p_formulario'] == "JURIDICO") {

    $_POST['act_economica'] = explode("_", $_POST['act_economica']);
    $_POST['act_economica'] = $_POST['act_economica'][0];

    Foreach ($Estados as $estado) {
        if ($estado['id2_estado'] == $_POST['etp_estado'])
            $_POST['etp_estado'] = $estado['nombre'];
    }




    $_POST['etp_ciudad'] = explode(",", $_POST['etp_ciudad']);

    $_POST['etp_municipio'] = explode(",", $_POST['etp_municipio']);

    foreach ($Ciudades as $Ciudad) {
//
        if ($Ciudad['lf_estado'] == $_POST['etp_ciudad'][0] && 10 == $Ciudad['id_banplus'])
            $_POST['etp_ciudad'] = $Ciudad['ciudad'];;
    }

    foreach ($Municipios as $municipio) {
//
        if ($municipio['lf_estado'] == $_POST['etp_municipio'][0] && $_POST['etp_municipio'][1] == $municipio['pk_municipio'])
            $_POST['etp_municipio'] = $municipio['nombre'];;
    }


    actualizar_campo('inserta_cita', [$_POST['fn_agencia'], $_POST['fc_cita'], 'ACPJ_' . $_POST['rif'], serialize($_POST)]);

    foreach ($AGENCIA as $agencia) {
        if ($agencia['id_agencias'] == $_POST['fn_agencia'])
            $_POST['fn_agencia'] = $agencia['nombre'];
    }

    if (!file_exists(dirname(__FILE__) . '/tmp_apertura/J_' . $_POST['rif'])) {
        mkdir(dirname(__FILE__) . '/tmp_apertura/J_' . $_POST['rif'], 0777, true);
    }

    $uploaddir = dirname(__FILE__) . '/tmp_apertura/J_' . $_POST['rif'] . "/";

    $path = $_FILES['f_reg_fiscal']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $uploadfile = $uploaddir . 'J_' . $_POST['rif'] . '_REGISTROFISCAL.' . $ext;
    move_uploaded_file($_FILES['f_reg_fiscal']['tmp_name'], $uploadfile);

    $path = $_FILES['f_estatus_empresa']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $uploadfile = $uploaddir . 'J_' . $_POST['rif'] . '_ESTATUS_EMPRESA.' . $ext;
    move_uploaded_file($_FILES['f_estatus_empresa']['tmp_name'], $uploadfile);


    $path = $_FILES['f_declaracion']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $uploadfile = $uploaddir . 'J_' . $_POST['rif'] . '_DECLARACION.' . $ext;
    move_uploaded_file($_FILES['f_declaracion']['tmp_name'], $uploadfile);

    $path = $_FILES['f_firma_1']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $uploadfile = $uploaddir . 'J_' . $_POST['rif'] . '_CEDULA_FIRMANTE_1.' . $ext;
    move_uploaded_file($_FILES['f_firma_1']['tmp_name'], $uploadfile);

    if (!empty($_FILES['f_referencia']['name'])) {
        $path = $_FILES['f_referencia']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . 'J_' . $_POST['rif'] . '_REFERENCIA.' . $ext;
        move_uploaded_file($_FILES['f_referencia']['tmp_name'], $uploadfile);
    }

    if (!empty($_FILES['f_firma_2']['name'])) {
        $path = $_FILES['f_firma_2']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . 'J_' . $_POST['rif'] . '_CEDULA_FIRMANTE_2.' . $ext;
        move_uploaded_file($_FILES['f_firma_2']['tmp_name'], $uploadfile);
    }
    if (!empty($_FILES['f_firma_3']['name'])) {
        $path = $_FILES['f_firma_3']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $uploadfile = $uploaddir . 'J_' . $_POST['rif'] . '_CEDULA_FIRMANTE_3.' . $ext;
        move_uploaded_file($_FILES['f_firma_3']['tmp_name'], $uploadfile);
    }
    ?>


    <script>
        $(document).ready(function () {

            $.ajax({
                url: 'modulos/pdf_cpj.php',
                data: <?php echo json_encode($_POST) ?>,
                error: function (xhr, status, error) {
                    //                var err = eval("(" + xhr.responseText + ")");
                    //                alert(error);
                },
                success: function (data) {

                    $.ajax({
                        url: 'modulos/correo.php',
                        data: <?php echo json_encode($_POST) ?>,
                        error: function (xhr, status, error) {

                        },
                        success: function (data) {

                            $('.spiner_').hide();

                            var r = confirm("\u00bfDesea realizar la solicitud de TDC?");
                            if (r == true) {
                                txt = "You pressed OK!";
                            } else {
                                txt = "You pressed Cancel!";
                            }
                        },
                        type: 'POST'
                    });
                },
                type: 'POST'
            });
        });
    </script>

    <?php
}
?>