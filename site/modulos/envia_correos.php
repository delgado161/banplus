<!--/* 
Created on : 24/05/2017, 03:37:05 PM
Author     : Roberto Delgado
*/-->
<?php
$uploaddir = dirname(__FILE__) . '/tmp_apertura/';

if (isset($_POST['p_formulario']) && $_POST['p_formulario'] == "NATURAL") {



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
    ?>



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
                        url: 'modulos/corro.php',
                        data: <?php echo json_encode($_POST) ?>,
                        error: function (xhr, status, error) {

                        },
                        success: function (data) {

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