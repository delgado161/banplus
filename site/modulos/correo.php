<!--/* 
Created on : 24/05/2017, 03:42:41 PM
Author     : Roberto Delgado
*/-->
<?php
include_once "../includes/i_funciones.php";


if (isset($_POST['p_formulario']) && $_POST['p_formulario'] == "NATURAL") {


    $subject = 'PREAPERTURA DE CUENTA PERSONA NATURAL';
    $mail_to = $_POST['email'];
    $message = '
<html>
<head>
  <title>PREAPERTURA DE CUENTA PERSONA NATURAL</title>
</head>
<body>
<p style="text-align:justify">Sr.(a) ' . $_POST['p_nombre'] . ' ' . $_POST['s_nombre'] . ' ' . $_POST['p_apellido'] . ' ' . $_POST['s_apellido'] . '. <br><br><br>
Gracias por utilizar el servicio de apertura de cuentas de Banplus Banco Universal. Te 
informamos que se te ha otorgado una cita para formalizar la apertura de tu cuenta, el día 
"Fecha Cita" en la Oficina "Nombre Oficina" Dirección: "Dirección de Oficina". en el horario comprendido de 
08:30 am - 03:30 pm. Para la cita debes consignar los siguientes recaudos en el orden señalado en una 
(1) carpeta manila tamaño oficio:
<ul>
<li>Solicitud de Apertura de Cuenta. </li>
<li>Original y fotocopia legible de la Cédula de Identidad laminada para las personas naturales venezolanas o extranjeras residentes en el país.</li>
<li>Original y fotocopia legible de Pasaporte para las personas naturales extranjeras no residentes en el país.</li>
<li>Original y fotocopia legible de un recibo de servicio público o privado: luz, agua, teléfono, gas, televisión por cable, con antigüedad no mayor a tres (3) meses o, Constancia de Residencia emitida por la autoridad civil correspondiente, con antigüedad no mayor a tres (3) meses o, Registro Único de Información Fiscal (RIF) Vigente.</li>
<li>Original de una (1) constancia de trabajo, se exigirá sólo cuando se declare dependencia laboral, con antigüedad no mayor a un (1) mes de emitida.</li>
<li>Original de un (1) Informe de atestiguamiento o revisión sobre ingresos de personas naturales, se exigirá sólo cuando se declare el libre ejercicio o actividad económica independiente, con antigüedad no mayor a tres (3) meses de emitida.</li>
<li>En caso de poseer obligación de declarar impuesto, Original y fotocopia legible de la última Declaración de Impuesto Sobre la Renta (ISLR), para los clientes que obtengan enriquecimiento anual superior a 1000 UT (asalariados) o ingresos brutos superiores a 1500 UT (trabajadores independientes).</li>
<li>En caso de apertura ordenada por Tribunales de la República, debe presentar Original y fotocopia del Orden del Tribunal.</li>
</ul>
<br></br>
Banplus te invita a visitar la página web wwww.banplus.com, para que conozcas nuestros productos y servicios adicionales a tu disposición.
</p>
  
</body>
</html>
';

    /* Email Detials */
    $Coreo = execute_sql("get_parametro", array(63));
    $from_mail = "<" . $Coreo[1]["valor"] . ">";

    $Coreo_nombre = execute_sql("get_parametro", array(64));
    $from_name = $Coreo_nombre[1]["valor"];

    $path = dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . "/";
    $filename = $_POST['tp_documento'] . $_POST['n_documento'] . '_APERTURA.pdf';

    enviar_email_2($from_name, $from_mail, $message, $path, $filename, $subject, $mail_to);

//    $myfile = fopen(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . '.zip', "w") or die("Unable to open file!");
//    fclose($myfile);


    $zip = new ZipArchive;
    if ($zip->open(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {


        if ($handle = opendir(dirname(__FILE__) . '\tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . "/")) {
// Add all files inside the directory
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && !is_dir(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . "/" . $entry)) {
                    $zip->addFile(dirname(__FILE__) . '/tmp_apertura/' . $_POST['tp_documento'] . $_POST['n_documento'] . "/" . $entry, $_POST['tp_documento'] . $_POST['n_documento'] . "/" . $entry);
                }
            }
            closedir($handle);
        }
        $zip->close();
    }


    $message = '
<html>
<head>
  <title>Solicitud de Preapertura de cuenta página web Persona Natural</title>
</head>
<body>
<p style="text-align:justify">
Usted tiene una nueva solicitud de apertura de cuenta persona natural por procesar.<br><br>
<b>Nombre y Apellido:</b> ' . $_POST['p_nombre'] . ' ' . $_POST['s_nombre'] . ' ' . $_POST['p_apellido'] . ' ' . $_POST['s_apellido'] . '. <br><br>
<b>Cedula: :</b> ' . $_POST['tp_documento'] . $_POST['n_documento'] . '. <br><br>

<br></br>
</p>
  
</body>
</html>
';


    $subject = 'Solicitud de Preapertura de cuenta página web Persona Natural';
    $filename = $_POST['tp_documento'] . $_POST['n_documento'] . '.zip';
    $path = dirname(__FILE__) . '/tmp_apertura/';
    enviar_email_3($from_name, $from_mail, $message, $path, $filename, $subject, $mail_to);
}

function enviar_email_2($from_name, $from_mail, $message, $path, $filename, $subject, $mail_to) {
// a random hash will be necessary to send mixed content
    $separator = md5(time());

// carriage return type (RFC)
    $eol = "\r\n";

// main header (multipart mandatory)
    $headers = "From:" . $from_name . $from_mail . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

// message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/html; charset=\"utf-8\"" . $eol;
//    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;



// Attachment location

    $file = $path . $filename;
    $content = file_get_contents($file);
    $content = chunk_split(base64_encode($content));
    ob_start();
// attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

//SEND Mail
    mail($mail_to, $subject, $body, $headers);

}

function enviar_email_3($from_name, $from_mail, $message, $path, $filename, $subject, $mail_to) {
// a random hash will be necessary to send mixed content
    $separator = md5(time());

// carriage return type (RFC)
    $eol = "\r\n";

// main header (multipart mandatory)
    $headers = "From:" . $from_name . $from_mail . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/alternative; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

// message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/html; charset=\"utf-8\"" . $eol;
//    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;



// Attachment location

    $file = $path . $filename;
    $content = file_get_contents($file);
    $content = chunk_split(base64_encode($content));
    ob_start();
// attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/zip; name=\"" . $filename . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

//SEND Mail
    mail($mail_to, $subject, $body, $headers);

}
