<?php

include_once "i_hack_function.php";
include_once "i_comunes.php";
include_once "i_generales.php";

/* ======================================================
  FUNCION:       url_script_validar
  DESCRIPCION:   Evita el cross site scripting in URL
  PARAMETROS:    $mensaje: Array.
  [0]: $_SERVER['HTTP_HOST']
  [1]: $_SERVER['SERVER_PORT']
  [2]: $_SERVER['SCRIPT_NAME']
  [3]: $_SERVER['QUERY_STRING']
  [4]: $_SERVER['REQUEST_URI']
  ====================================================== */

function url_script_validar($mensaje) {  //UTILIZADA PARA EVITAR EL Cross Site Scripting in URL
    $lleva = 0;
    $salir = false;


    for ($x = 0; $x <= count($mensaje) - 1; $x++) {
        if (is_array($mensaje[$x])) {
            foreach ($mensaje[$x] as $part_mensaje) {
                $valor = url_script($part_mensaje, $arg);
                if ($valor == 1) {
                    $salir = true;
                    break;
                }
            }
        } else {
            $valor = url_script($mensaje[$x], $arg);
        }
        if ($valor == 1) {
            break;
            $salir = true;
        }
    }

    if ($salir) {
        $marca = 1;
    } else {
        $marca = 0;
    }

    return $marca;

}

function RemoveXSS($val) {
    // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
    // this prevents some character re-spacing such as <java\0script>
    // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
    $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);

    // straight replacements, the user should never need these since they're normal characters

    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';
    for ($i = 0; $i < strlen($search); $i++) {
        // ;? matches the ;, which is optional
        // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
        // &#x0040 @ search for the hex values
        $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
        // &#00064 @ 0{0,7} matches '0' zero to seven times
        $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
    }

    // now the only remaining whitespace attacks are \t, \n, and \r
    $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
    $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $ra = array_merge($ra1, $ra2);

    $found = true; // keep replacing as long as the previous round replaced something
    while ($found == true) {
        $val_before = $val;
        for ($i = 0; $i < sizeof($ra); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    $pattern .= '|';
                    $pattern .= '|(&#0{0,8}([9|10|13]);)';
                    $pattern .= ')*';
                }
                $pattern .= $ra[$i][$j];
            }
            $pattern .= '/i';
            $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
            $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
            if ($val_before == $val) {
                // no replacements were made, so exit the loop
                $found = false;
            }
        }
    }
    return $val;

}

/* ======================================================
  FUNCION:       url_script
  DESCRIPCION:   Evita el cross site scripting in URL
  PARAMETROS:    $mensaje: Array.
  [0]: $_SERVER['HTTP_HOST']
  [1]: $_SERVER['SERVER_PORT']
  [2]: $_SERVER['SCRIPT_NAME']
  [3]: $_SERVER['QUERY_STRING']
  [4]: $_SERVER['REQUEST_URI']
  ====================================================== */

function url_script($mensaje) {  //UTILIZADA PARA EVITAR EL Cross Site Scripting in URL
    $mensaje = htmlentities($mensaje);
    $mensaje = RemoveXSS($mensaje);
    $mensaje = strip_tags(strtolower($mensaje));
    $mensaje = stripslashes($mensaje);
    $mensaje = htmlentities($mensaje);
    $mensaje = trim(str_replace(";", "", $mensaje));

    $lleva = 0;
    $Array_buscar = array("%3C", ">", "&gt;", "<", "&lt;", "select", "update", "drop", ";", "--", "xp_", "insert", "delete", 'quot', '"', "'", "%3d", "shockwave", 'expression', "style", "frame", "script", "/script", "java", "javascript", '<script', "http-equiv", "http", "'", "declare", "char", "set", "cast", "exec", "varchar", "nvarchar", "sysobjects", "xtype", "get", "6465636c617265", "63686172", "736574", "63617374", "65786563", "76617263686172", "7379736f626a65637473", "7874797065", "676574", "73656c656374", "75s7064617465", "64726f70", "2d2d", "78705f", "696e73657274", "64656c657465", "736372697074", "http", "68747470", "1'1", "1'", "1' or '1'='1", "';", "73%2065%206c%2065%2063%2074", "63%2061%2073%2074", "63%61%73%74", "43%2061%2073%2074", "43%61%73%74", "63%2041%2073%2074", "63%41%73%74");

    if ($arg != "") {
        if (is_numeric($arg)) {
            $lleva = 0;
        } else {
            $lleva += 1;
        }
    }

    for ($x = 0; $x <= count($Array_buscar) - 1; $x++) {
        $link1 = explode("/", $mensaje);
        $tamano = strlen($mensaje);
        $hexa = explode("%", $mensaje);
        $hack2 = explode("&#x", $mensaje);

        for ($e = 0; $e < count($link1); $e++) {
            $Palabra_Hex = strip_tags(strtolower(hex2ascii($link1[$e])));
            $tamano_especial = strlen($link1[$e]);
            $link2 = explode("-", $link1[$e]);

            if ($tamano_especial > 250) {
                $lleva += 1;
            }

            if ($e == count($link1) - 1) {
                $barra = explode("-", $link1[$e]);
                if (count($barra) <= 1) {
                    $comparar2 = strpos($link1[$e], $Array_buscar[$x]);

                    if ($comparar2 === false) {
                        
                    } else {
                        $lleva += 1;
                    }
                }
            }

            if ((in_array($link1[$e], $Array_buscar)) || (in_array($Palabra_Hex, $Array_buscar))) {
                if ($Palabra_Hex == "'" && $tamano_especial = 2) {
                    ;
                } else {
                    $lleva++;
                }
            } else {
                $ar_link = explode(" ", $link1[$e]);
                for ($e2 = 0; $e2 < count($ar_link); $e2++) {
                    if (in_array($ar_link[$e2], $Array_buscar)) {
                        $lleva++;
                    }
                }
            }

            for ($r = 0; $r < count($link2); $r++) {

                if ($r == count($link2) - 1) {
                    $tam = strlen($link2[$r]);
                    if ($tam > 30) {
                        $comparar = strpos($link2[$r], $Array_buscar[$x]);
                        if ($comparar === false) {
                            
                        } else {
                            $lleva += 1;
                        }
                    }
                }

                if (in_array($link2[$r], $Array_buscar)) {
                    $lleva++;
                }
            }
        }

        if ($tamano > 300 || count($hexa) >= 45 || count($hack2) > 1) {
            $lleva += 1;
        }
    }
    if ($lleva >= 1) {
        $marca = 1;
    } else {
        $marca = 0;
    }

    return $marca;

}

function hex2ascii($hexadecimal) {
    $ascii = '';
    $hexadecimal = str_replace(" ", "", $hexadecimal);
    $hexadecimal = str_replace("%", "", $hexadecimal);
    $hexadecimal = str_replace("&#x", "", $hexadecimal);
    for ($i = 0; $i < strlen($hexadecimal); $i = $i + 2) {
        $ascii.=chr(hexdec(substr($hexadecimal, $i, 2)));
    }
    $ascii = str_replace(" ", "", $ascii);

    return($ascii);

}

//Arma el Menú Superior de Opciones
function menu_principal_superior($ID, $IDS = null) {
    $OpcMenSup = execute_sql("menu_principal_superior", array());

    if (is_array($OpcMenSup)) {
        $OpcMenSupF[0] .= '<ul id="menu_principal">';

        for ($i = 1; $i <= count($OpcMenSup); $i++) {
            if ($ID == $OpcMenSup[$i]["id_grupo"]) {
                $NomLi = " id='activo'";
            } else {
                $NomLi = "";
            }

            if ($OpcMenSup[$i]["id_contenido"] != "") {
                $Enl = 'p_contenido.php?id=' . $OpcMenSup[$i]["id_grupo"] . '&idc=' . $OpcMenSup[$i]["id_contenido"];
            } else {
                $Enl = 'p_contenido.php?id=' . $OpcMenSup[$i]["id_grupo"];
            }

            $OpcMenSupF[0] .= '<li' . $NomLi . '><a href="' . $Enl . '">' . strtoupper($OpcMenSup[$i]["nombre"]) . '</a>';

            if ($ID == $OpcMenSup[$i]["id_grupo"]) {
                $OpcMenSupF[1] .= menu_hijas($OpcMenSup[$i]["id_grupo"], $IDS);

                if ($OpcMenSupF[1] != "") {
                    $OpcMenSupF[0] .= '<img src="img/arrow_menu_down_blanca.png">';
                }
            }

            $OpcMenSupF[0] .= '</li>';

            if ($i < count($OpcMenSup)) {
                $OpcMenSupF[0] .= '<span id="separador"></span>';
            }
        }

        $OpcMenSupF[0] .= '</ul>';
    } else {
        $OpcMenSupF[0] = "";
    }

    return $OpcMenSupF;

}

//Consigue los datos de las hijas de una opciòn de Menú
function menu_hijas($IDP, $IDS = null) {
    $OpcMenH = execute_sql("menu_principal_superior_hijas", array($IDP));

    if (is_array($OpcMenH)) {
        $OpcMenHF .= '<div id="smoothmenu1" class="ddsmoothmenu"><ul id="mp">';
        for ($i = 1; $i <= count($OpcMenH); $i++) {

            if ($OpcMenH[$i]["id_contenido"] != "") {
                $Enl = 'p_contenido.php?id=' . $OpcMenH[$i]["id_grupo"] . '&idc=' . $OpcMenH[$i]["id_contenido"];
            } else {
                $Enl = '#';
            }

            if ($IDS == $OpcMenH[$i]["id_grupo"]) {
                $NomLi = " id='activo'";
            } else {
                $NomLi = "";
            }

            $OpcMenHF .= '<li><a href="' . $Enl . '"' . $NomLi . '>' . $OpcMenH[$i]["nombre"] . '</a>';

            $OpcMenHF .= menu_hijas_secciones($OpcMenH[$i]["id_grupo"], $IDP);

            $OpcMenHF .= '</li>';

            if ($i < count($OpcMenH)) {
                $OpcMenHF .= '<span id="separador"></span>';
            }
        }
        $OpcMenHF .= '</ul></div>';
    } else {
        $OpcMenHF = "";
    }

    return $OpcMenHF;

}

//Consigue los datos de las secciones hijas de una opciòn de Menú
function menu_hijas_secciones($IDG, $IDP) {
    $OpcMenH = execute_sql("menu_principal_superior_secciones", array($IDG));

    if (is_array($OpcMenH)) {
        $OpcMenHF .= '<ul id="hijas_secciones">';
        for ($i = 1; $i <= count($OpcMenH); $i++) {
            $OpcMenHF .= '<li><a href="p_contenido.php?id=' . $IDP . '&ids=' . $IDG . '&idc=' . $OpcMenH[$i]["id_contenido"] . '">' . $OpcMenH[$i]["titulo"] . '</a></li>';
        }
        $OpcMenHF .= '</ul>';
    } else {
        $OpcMenHF = "";
    }

    return $OpcMenHF;

}

//Arma el Menú Lateral Accesos Directos
function menu_lateral($Id) {
    $OpcMenLat = execute_sql("menu_lateral", array($Id));

    if (is_array($OpcMenLat)) {
        $OpcMenLatF .= '<ul>';

        for ($i = 1; $i <= count($OpcMenLat); $i++) {
            $OpcMenLatF .= '<li><div id="indicador_' . $i . '" style="width:14px;height:20px;float:left;"> </div><span><a href="p_contenido.php?id=' . $Id . '&ids=' . $OpcMenLat[$i]["id_grupo"] . '&idc=' . $OpcMenLat[$i]["id_contenido"] . '" onMouseover="cambiar_icono_over(\'indicador_' . $i . '\')" onMouseout="cambiar_icono_out(\'indicador_' . $i . '\')">' . $OpcMenLat[$i]["titulo"] . '</a></span></li>';
        }

        $OpcMenLatF .= '</ul>';
    } else {
        $OpcMenLatF = "";
    }

    return $OpcMenLatF;

}

//Arma el Menú Inferior (Nivel 1 y 2)
function menu_inferior($Id, $Nivel) {
    $OpcMenLat = execute_sql("menu_inferior", array($Id, $Nivel));
//var_dump($OpcMenLat); die;
    $OpcMenLatF = "";
    if (is_array($OpcMenLat)) {
        $OpcMenLatF = '<ul>';

        if ($Nivel == 3) {
            $OpcMenLatF .= '<li><a href="p_contenido.php">Inicio</a></li><li id="separador"></li>';
        }

        for ($i = 1; $i <= count($OpcMenLat); $i++) {
            $OpcMenLatF .= '<li><a href="p_contenido.php?id=' . $Id . '&ids=' . $OpcMenLat[$i]["id_grupo"] . '&idc=' . $OpcMenLat[$i]["id_contenido"] . '">' . $OpcMenLat[$i]["titulo"] . '</a></li>';

            if ($i < count($OpcMenLat)) {
                $OpcMenLatF .= '<li id="separador"></li>';
            }
        }

        $OpcMenLatF .= '</ul>';
    } else {
        $OpcMenLatF = "";
    }
    //$OpcMenLatF = "<ul><li><a>Inicio</a></li></ul>";
    return $OpcMenLatF;

}

//Busca la pregunta y las respuesta de la última Encuesta Disponible
function encuesta_home($id) {
    $EncPre = execute_sql("encuesta_pregunta", array($id));

    if (is_array($EncPre)) {
        $Encuesta .= '<ul>';

        for ($i = 1; $i <= count($EncPre); $i++) {
            $Encuesta .= '<li>' . $EncPre[$i]["pregunta"];
            $Encuesta .= encuesta_respuesta($EncPre[$i]["id_pregunta"]);
            $Encuesta .= '</li>';
        }

        $Encuesta .= '</ul>';
        $Encuesta .= '<input type="hidden" name="id_enc" value="0#' . $EncPre[1]["id_pregunta"] . '">';
        $Encuesta .= '<input type="hidden" name="id_seg" value="' . $id . '">';
    } else {
        $Encuesta = "";
    }

    return $Encuesta;

}

//Busca las respuesta de una pregunta en la Encuesta
function encuesta_respuesta($Pre) {
    $EncRes = execute_sql("encuesta_respuestas", array($Pre));

    if (is_array($EncRes)) {
        $Encuesta .= '<ul id="respuestas">';

        for ($i = 1; $i <= count($EncRes); $i++) {
            $Encuesta .= '<li><input type="radio" name="opc_enc" value="' . $EncRes[$i]["id_respuestas"] . '#' . $Pre . '"> ' . $EncRes[$i]["respuesta"] . '</li>';
        }

        $Encuesta .= '</ul>';
    } else {
        $Encuesta = "";
    }

    return $Encuesta;

}

//Busca las respuesta y los totales de votos de una pregunta en la Encuesta
function encuesta_respuesta_totales($Pre) {
    //$EncPre = execute_sql("encuesta_pregunta",array());
    //if (is_array($EncPre)){
    $EncResTot = execute_sql("encuesta_respuestas_totales", array($Pre));
    $EncRes = execute_sql("encuesta_respuestas", array($Pre));

    if (is_array($EncRes)) {
        $Encuesta .= '<ul>';

        for ($i = 1; $i <= count($EncRes); $i++) {
            if ($EncResTot[1]["Totales"] != "") {
                $Porcentaje = number_format((($EncRes[$i]["contador"] * 100) / $EncResTot[1]["Totales"]), 1, ',', '');
            } else {
                $Porcentaje = 0;
            }

            $Encuesta .= '<li><div id="linea"><div id="respuesta">' . $EncRes[$i]["respuesta"] . '</div><div id="separador"></div></div><div id="porcentaje">' . $Porcentaje . ' %</div></li>';
        }

        $Encuesta .= '</ul>';
    } else {
        $Encuesta = "";
    }
    //}else{
    //	$Encuesta = "";	
    //}

    return $Encuesta;

}

//Ejecuta la votación de la encuesta en Ajax
function registrar_voto_encuesta($Res) {
    if ($Res != "") {
        actualizar_campo("actualiza_menu", array($Res));
    }

}

//Busca el/los banner de una sección y una posición
function get_banner_home($Sec, $Pos) {
    $Banner = execute_sql("get_banner_home", array($Sec, $Pos));
    if (is_array($Banner)) {
        for ($i = 1; $i <= count($Banner); $i++) {
            if (is_file(URL_UPLOADS_BANNER . $Banner[$i]["imagen"])) {
                $BannerF .= '<div class="imageElement">';
                $BannerF .= '<h3></h3>';
                $BannerF .= '<p></p>';

                if ($Banner[$i]["link"] != "") {
                    $BannerF .= '<a href="' . $Banner[$i]["link"] . '" title="Ver m&aacute;s" class="open"';

                    if ($Banner[$i]["externo"] == 1) {
                        $BannerF .= ' target="_Blank"';
                    }

                    $BannerF .= '></a>';
                } else {
                    /* $BannerF .= '<a href="#" title=" " class="open"></a>'; */
                    $BannerF .= '<a href="#" class="open"></a>';
                }

                $BannerF .= '<img src="' . URL_UPLOADS_BANNER . $Banner[$i]["imagen"] . '" class="full" width="780px" height="320px"/>';

                $BannerF .= '</div>';
                //$BannerF .= '<div class="btn_dots"></div>';
            } else {
                $BannerF = "";
            }
        }
    } else {
        $BannerF = "";
    }

    return $BannerF;

}

//Busca el/los banner de una sección y una posición general
function get_banner_general($Sec, $Pos, $Int = null) {
    if ($Int == null) {
        $Banner = execute_sql("get_banner", array($Sec, $Pos));
    } else {
        $Banner = execute_sql("get_banner_interno", array($Sec, $Pos));
    }

    //var_dump($Banner); die;
    $width_general = "";
    if ($Pos == 2) {
        $width = "250px";
        $height = "252px";
        $width_general = 'width="' . $width . '" height="' . $height . '"';
    }
    if ($Pos == 3) {
        $width = "250px";
        $height = "44px";
        $width_general = 'width="' . $width . '" height="' . $height . '"';
    }
    if ($Pos == 4) {
        $width = "298px";
        $height = "156px";
        $width_general = 'width="' . $width . '" height="' . $height . '"';
    }

    if ($Pos == 5) {
        $width = "298px";
        $height = "156px";
        $width_general = 'width="' . $width . '" height="' . $height . '"';
    }
    if ($Pos == 8) {
        $width = "340px";
        $height = "45px";
        $width_general = 'width="' . $width . '" height="' . $height . '"';
    }
    if ($Pos == 7) {
        $width = "340px";
        $height = "45px";
        $width_general = 'width="' . $width . '" height="' . $height . '"';
    }
    if ($Pos == 6) {
        $width = "340px";
        $height = "45px";
        $width_general = 'width="' . $width . '" height="' . $height . '"';
    }
    if ($Pos == 11) {
        $width = "611px";
        $height = "110px";
        $width_general = 'width="' . $width . '" height="' . $height . '"';
    }

    if ($Pos == 13) {
        $width = "250px";
        $height = "275px";
        $width_general = 'width="' . $width . '" height="' . $height . '"';
    }


    if (is_array($Banner)) {


        for ($i = 1; $i <= count($Banner); $i++) {
            if (is_file(URL_UPLOADS_BANNER . $Banner[$i]["imagen"])) {
                if ($Banner[$i]["link"] != "") {
                    $BannerF .= '<a href="' . $Banner[$i]["link"] . '"';


                    if ($Banner[$i]["externo"] == 1) {
                        $BannerF .= ' target="_Blank"';
                    }
                    $BannerF .= '>';
                }

                $BannerF .= '<img src="' . URL_UPLOADS_BANNER . $Banner[$i]["imagen"] . '"' . $width_general . '/>';

                if (($Banner[$i]["link_externo"] != "") or ( $Banner[$i]["link"] != "")) {
                    $BannerF .= '</a>';
                }
            } else {
                $BannerF = "";
            }
        }
    } else {
        $BannerF = "";
    }
    //var_dump($BannerF);
    return $BannerF;

}

//Busca la marquee para las noticias del home
function get_noticias_home($Id) {
    $EncNot = execute_sql("get_parametro", array(14));

    $Not = execute_sql("noticia_home", array($Id));
    //var_dump($Not);
    if (is_array($Not)) {
        for ($i = 1; $i <= count($Not); $i++) {
            if ($Not[$i]["tipo"] == "3") {
                $NotF .= '<div class="mooquee_item"> ' . $Not[$i]["titulo"] . '</div>';
            } else {
                if ($Not[$i]["noticias_link"] == "") {
                    if ($Not[$i]["contenido"] == "") {
                        $NotF .= '<div class="mooquee_item"> ' . $Not[$i]["titulo"] . '</div>';
                    } else {
                        $NotF .= '<div class="mooquee_item"><a href="?id=' . $Id . '&idc=' . $EncNot[1]["valor"] . '&idn=' . $Not[$i]["id_noticia"] . '">' . $Not[$i]["titulo"] . '</a></div>';
                    }
                } else {
                    $NotF .= '<div class="mooquee_item"><a href="' . $Not[$i]["noticias_link"] . '">' . $Not[$i]["titulo"] . '</a></div>';
                }
            }
        }
    } else {
        $NotF = "";
    }

    return $NotF;

}

//Arma los link para Banplus Online Home
function link_online($Id) {
    $EncOL = execute_sql("get_parametro_link_online", array());

    if (is_array($EncOL)) {
        $EnlacesOL .= '<li id="A" class="topOnline icon_link"';
        if (($Id == 1) || ($Id == 2)) {
            //$EnlacesOL .= ' style="background-color:#CC9900;" onmouseover="style.backgroundColor=\'#6A6B70\';"
            //onmouseout="style.backgroundColor=\'#CC9900\'"'; 
        }


        //$EnlacesOL .= '><a href="' . $EncOL[1]["valor"] . '" target="_Blank">PERSONAS</a></li>';
        $EnlacesOL .= ' onclick="popUp2(\'' . $EncOL[1]["valor"] . '\')"><a class= "icon_link"  >PERSONAS</a></li>';
        $EnlacesOL .= '<li id="B"';
        if (($Id == 5) || ($Id == 3)) {
            $EnlacesOL .= ' style="background-color:#CC9900;" onmouseover="style.backgroundColor=\'#6A6B70\';"
				onmouseout="style.backgroundColor=\'#CC9900\'"';
        }
        //$EnlacesOL .= '><a href="' . $EncOL[2]["valor"] . '" target="_Blank">EMPRESAS</a></li>';
        $EnlacesOL .= ' onclick="popUp2(\'' . $EncOL[2]["valor"] . '\')" ><a class= "icon_link" >EMPRESAS</a></li>';
        $EnlacesOL .= '<li id="C"';
        /* if ($Id==3) { 
          $EnlacesOL .= ' style="background-color:#CC9900;" onmouseover="style.backgroundColor=\'#6A6B70\';"
          onmouseout="style.backgroundColor=\'#CC9900\'"';
          } */
        //$EnlacesOL .= '><a href="' . $EncOL[3]["valor"] . '" target="_Blank">TARJETA DE CR&Eacute;DITO</a></li>';
        $EnlacesOL .= ' onclick="popUp2(\'' . $EncOL[3]["valor"] . '\')" ><a class= "icon_link" >TARJETA DE CR&Eacute;DITO</a></li>';
        /* $EnlacesOL .= '<li id="D"';
          if ($Id==2) {
          $EnlacesOL .= ' style="background-color:#CC9900;" onmouseover="style.backgroundColor=\'#6A6B70\';"
          onmouseout="style.backgroundColor=\'#CC9900\'"';
          }
          $EnlacesOL .= '><a href="' . $EncOL[4]["valor"] . '" target="_Blank">T. ALIMENTACI&Oacute;N</a></li>'; */
    } else {
        $EnlacesOL = "";
    }

    return $EnlacesOL;

}

//Busca las cuentas de Facebook y Twitter
function link_follow() {
    $EncOL = execute_sql("get_parametro_follow", array());
//var_dump($EncOL);die;

    if (is_array($EncOL)) {

        foreach ($EncOL as $value) {
            if ($value['id_parametro'] == 51 || $value['id_parametro'] == 52 || $value['id_parametro'] == 53 || $value['id_parametro'] == 55 || $value['id_parametro'] == 58 || $value['id_parametro'] == 60 || $value['id_parametro'] == 62 || $value['id_parametro'] == 63) {
                $rrssActives[$value['id_parametro']] = $value['valor'];
            }
        }
        for ($i = 1; $i <= count($EncOL); $i++) {


            if ($EncOL[$i]["id_parametro"] == 2 && $rrssActives[52] == 1) {
                if ($EncOL[$i]["valor"] != "") {
                    $EnlacesOL .= '<span id="tw"><a href="http://www.twitter.com/' . $EncOL[$i]["valor"] . '" target="_blank"><img src="img/twitter.jpg" title="Twitter" border="0"></a></span>';
                }
            }

            if ($EncOL[$i]["id_parametro"] == 7 && $rrssActives[51] == 1) {
                if ($EncOL[$i]["valor"] != "") {
                    $EnlacesOL .= '<span id="fb"><a href="' . $EncOL[$i]["valor"] . '" target="_blank"><img src="img/facebook.jpg" title="Facebook" border="0"></a></span>';
                }
            }

            if ($EncOL[$i]["id_parametro"] == 56 && $rrssActives[53] == 1) {
                if ($EncOL[$i]["valor"] != "") {
                    $EnlacesOL .= '<span id="fb"><a href="' . $EncOL[$i]["valor"] . '" target="_blank"><img src="img/instagram.jpg" title="Instagram" border="0"></a></span>';
                }
            }

            if ($EncOL[$i]["id_parametro"] == 63 && $rrssActives[55] == 1) {
                if ($EncOL[$i]["valor"] != "") {
                    $EnlacesOL .= '<span id="fb"><a href="' . $EncOL[$i]["valor"] . '" target="_blank"><img src="img/linkedin.jpg" title="Linkedin" border="0"  style="    "></a></span>';
                }
            }


            if ($EncOL[$i]["id_parametro"] == 57 && $rrssActives[58] == 1) {
                if ($EncOL[$i]["valor"] != "") {
                    $EnlacesOL .= '<span id="fb"><a href="' . $EncOL[$i]["valor"] . '" target="_blank"><img src="img/youtube.jpg" title="You Tube" border="0"  style="       "></a></span>';
                }
            }


            if ($EncOL[$i]["id_parametro"] == 59 && $rrssActives[60] == 1) {
                if ($EncOL[$i]["valor"] != "") {
                    $EnlacesOL .= '<span id="fb"><a href="' . $EncOL[$i]["valor"] . '" target="_blank"><img src="img/google.jpg" title="Google+" border="0"  style="          width: 20px;"></a></span>';
                }
            }

            if ($EncOL[$i]["id_parametro"] == 61 && $rrssActives[62] == 1) {
                if ($EncOL[$i]["valor"] != "") {
                    $EnlacesOL .= '<span id="fb"><a href="' . $EncOL[$i]["valor"] . '" target="_blank"><img src="img/wordpress.jpg" title="Wordpress" border="0"  style="        "></a></span>';
                }
            }
        }

        $EnlacesOL .= '<span id="tit">S&iacute;guenos en:</span>';
    } else {
        $EnlacesOL = "";
    }

    return $EnlacesOL;

}

//Busca el contenido de un ID en específico
function get_contenido($idc) {
    $Cont = execute_sql("get_contenido", array($idc));

    if (is_array($Cont)) {
        $ContF["Id"] = $Cont[1]["id_contenido"];
        $ContF["Titulo"] = $Cont[1]["titulo"];
        $ContF["Imagen"] = $Cont[1]["imagen"];
        $ContF["Resumen"] = $Cont[1]["resumen"];
        $ContF["Contenido"] = $Cont[1]["contenido"];
        $ContF["Modulo"] = $Cont[1]["id_herramienta_financiera"];
        $ContF["Plantilla"] = $Cont[1]["plantilla"];
    } else {
        $ContF[] = "";
    }

    return $ContF;

}

//Arma el ComboBox de Accesos Directos en las páginas internas
function acc_dir_internos($Id) {
    $OpcMenLat = execute_sql("menu_lateral", array($Id));

    if (is_array($OpcMenLat)) {
        for ($i = 1; $i <= count($OpcMenLat); $i++) {
            $OpcMenLatF .= '<option value="?id=' . $Id . '&ids=' . $OpcMenLat[$i]["id_grupo"] . '&idc=' . $OpcMenLat[$i]["id_contenido"] . '">' . $OpcMenLat[$i]["titulo"] . '</option>';
        }
    } else {
        $OpcMenLatF = "";
    }

    return $OpcMenLatF;

}

//Arma el ComboBox de Ciudades donde existen Oficinas
function get_agencias($Id) {
    $OpcOfic = execute_sql("get_agencias", array());

    if (is_array($OpcOfic)) {
        for ($i = 1; $i <= count($OpcOfic); $i++) {
            $OpcOficF .= '<option value="' . $OpcOfic[$i]["id_estado"] . '">' . $OpcOfic[$i]["nombre"] . '</option>';
        }
    } else {
        $OpcOficF = "";
    }

    return $OpcOficF;

}

//Trae todos los estados
function get_estados($Sel) {
    $Estados = execute_sql("get_estados", array());

    if (is_array($Estados)) {
        $EstadosF .= '<ul>';
        for ($i = 1; $i <= count($Estados); $i++) {

            $valid_est = execute_sql("get_agencias_estados", array($Estados[$i]["id_estado"]));

            if (count($valid_est) > 0)
                $EstadosF .= '<li><input type="radio" name="opc_estado" onclick="this.form.submit()" style="cursor:pointer;" value="' . $Estados[$i]["id_estado"] . '"';
            else
                $EstadosF .= '<li><input type="radio" disabled="disabled" name="opc_estado" value="' . $Estados[$i]["id_estado"] . '"';

            if ($Sel == $Estados[$i]["id_estado"]) {
                //$EstadosF .= ' checked';
            }
            $EstadosF .= '>' . $Estados[$i]["nombre"] . '</li>';
        }
        $EstadosF .= '</ul>';
    } else {
        $EstadosF = "";
    }

    return $EstadosF;

}

//Trae los datos de un Estado por su ID
function get_estado_id($Id) {
    $Estados = execute_sql("get_estado_id", array($Id));

    if (is_array($Estados)) {
        $EstadosF[0] = $Estados[1]["id_estado"];
        $EstadosF[1] = $Estados[1]["nombre"];
    } else {
        $EstadosF[] = "";
    }

    return $EstadosF;

}

//Trae todas las agencias por Estado
function get_agencias_estados($Est, $Agen = null) {
    $Agencias = execute_sql("get_agencias_estados", array($Est));
    if (is_array($Agencias)) {
        $AgenciasF .= '<ul>';
        for ($i = 1; $i <= count($Agencias); $i++) {
            $AgenciasF .= '<li><input type="radio" name="opc_agencias" onclick="this.form.submit()" style="cursor:pointer;" value="' . $Agencias[$i]["id_agencias"] . '"';
            if (($Agen == $Agencias[$i]["id_agencias"])) {
                //$AgenciasF .= ' checked';
            }
            $AgenciasF .= '>' . $Agencias[$i]["nombre"] . '</li>';
        }
        $AgenciasF .= '</ul>';
    } else {
        $AgenciasF = "";
    }

    return $AgenciasF;

}

//Trae los datos de una Agencia por su ID
function get_agencia_id($Id) {
    $Estados = execute_sql("get_agencia_id", array($Id));

    if (is_array($Estados)) {
        $EstadosF[0] = $Estados[1]["id_estado"];
        $EstadosF[1] = $Estados[1]["nombre"];
        $EstadosF[2] = $Estados[1]["direccion"];
        $EstadosF[3] = $Estados[1]["telef_1"];
        $EstadosF[4] = $Estados[1]["horario_agencia"];
        $EstadosF[5] = $Estados[1]["horario_taq_auto"];
        $EstadosF[6] = $Estados[1]["coordenadas"];
        $EstadosF[7] = $Estados[1]["Ciudad"];
        $EstadosF[8] = $Estados[1]["Estado"];
    } else {
        $EstadosF[] = "";
    }

    return $EstadosF;

}

//Trae todos los servicios de una agencias
function get_servicios_agencias($Agen) {
    $Servicios = execute_sql("get_servicios_agencias", array($Agen));
    $ServiciosF = "";
    if (is_array($Servicios)) {
        for ($i = 1; $i <= count($Servicios); $i++) {
            if (is_file(URL_UPLOADS_CONTENIDOS . $Servicios[$i]["imagen"])) {
                $ServiciosF .= "<img src='" . URL_UPLOADS_CONTENIDOS . $Servicios[$i]["imagen"] . "' title='" . $Servicios[$i]["nombre"] . "'/>";
            }
        }
    } else {
        $ServiciosF = "";
    }

    return $ServiciosF;

}

function get_servicios_agencias2($Agen) {
    $Servicios = execute_sql("get_servicios_agencias", array($Agen));

    if (is_array($Servicios)) {
        for ($i = 1; $i <= count($Servicios); $i++) {
            if (is_file(URL_UPLOADS_CONTENIDOS . $Servicios[$i]["imagen"])) {
                $ServiciosF .= '<div class="div_grupo_agencias">
								<img src="' . URL_UPLOADS_CONTENIDOS . $Servicios[$i]["imagen"] . '" style="float:left;"/>' .
                        '<label class="agen_leyenda" >' . $Servicios[$i]["nombre"] . '</label>
							   </div>';
            }
        }
    } else {
        $ServiciosF = "";
    }

    return $ServiciosF;

}

//Valida si para un segmento dado existe Tips de Seguridad
function validate_tips($Id) {
    $IdTips = execute_sql("get_parametro", array(9));

    if (is_array($IdTips)) {
        $Validar = execute_sql("validate_tips", array($IdTips[1]["valor"], $Id));

        if (is_array($Validar)) {
            $ValidarF = $Validar[1]["id_contenido"];
        } else {
            $ValidarF = "";
        }
    } else {
        
    }

    return $ValidarF;

}

//Busca Dias Feriados y Dias Bancarios
function get_calendar_days($Tipo) {
    $Dias = execute_sql("get_calendar_days", array($Tipo));

    if (is_array($Dias)) {
        for ($i = 1; $i <= count($Dias); $i++) {
            $DiasF[$Dias[$i]["fecha"]] = array($Dias[$i]["descripcion"]);
        }
    } else {
        $DiasF[] = "";
    }

    return $DiasF;

}

//Busca si una sección dada tiene Documentos Relacionados
function get_doc($Id, $Idc) {
    $Doc = execute_sql("get_doc", array($Id, $Idc));

    if (is_array($Doc)) {
        $DocF .= '<ul>';

        for ($i = 1; $i <= count($Doc); $i++) {
            if ($Doc[$i]["documento"] != "") {
                if (is_file(URL_UPLOADS . $Doc[$i]["documento"])) {
                    $DocF .= '<li><a href="' . URL_UPLOADS . $Doc[$i]["documento"] . '" target="_Blank" Title="' . $Doc[$i]["titulo"] . '">' . $Doc[$i]["titulo"] . '</a></li>';
                }
            }
        }

        $DocF .= '</ul>';
    } else {
        $DocF = "";
    }

    return $DocF;

}

//Busca los Estados Financieros
function get_estados_financieros() {
    $Doc = execute_sql("get_estados_financieros", array());
    $anno = "";
    if (is_array($Doc)) {
        $DocF .= '<ul>';
        for ($i = 1; $i <= count($Doc); $i++) {
            if ($Doc[$i]["archivo"] != "") {
                if (is_file(URL_UPLOADS_ESTADOSFINANCIEROS . $Doc[$i]["archivo"])) {
                    if ($anno != $Doc[$i]["ano"]) {
                        $DocF .='<span class="titulo_fm"><h4>' . $Doc[$i]["ano"] . '</h4></span>';
                        $anno = $Doc[$i]["ano"];
                    }
                    $DocF .= '<dl class="linea_ef"><img src="../site/img/icono_pdf.png" width="20" height="21" />&nbsp;&nbsp;<a href="' . URL_UPLOADS_ESTADOSFINANCIEROS . $Doc[$i]["archivo"] . '" target="_Blank" Title="' . c_mes($Doc[$i]["mes"]) . ' ' . $Doc[$i]["ano"] . '"> <span>' . c_mes($Doc[$i]["mes"]) . '</span></a></dl>';
                }
            }
        }

        $DocF .= '</ul>';
    } else {
        $DocF = "";
    }

    return $DocF;

}

//Busca los memoria semestral
function get_memoria_semetral() {
    $Doc = execute_sql("get_memoria_semetral", array());
    $anno = "";
    if (is_array($Doc)) {
        $DocF .= '<ul>';
        for ($i = 1; $i <= count($Doc); $i++) {
            if ($Doc[$i]["archivo"] != "") {
                if (is_file(URL_UPLOADS_ESTADOSFINANCIEROS . $Doc[$i]["archivo"])) {
                    if ($anno != $Doc[$i]["ano"]) {
                        $DocF .='<span class="titulo_fm"><h4>' . $Doc[$i]["ano"] . '</h4></span>';
                        $anno = $Doc[$i]["ano"];
                    }
                    $DocF .= '<dl class="linea_ef_2"><img src="../site/img/icono_pdf.png" width="20" height="21" />&nbsp;&nbsp;<a href="' . URL_UPLOADS_ESTADOSFINANCIEROS . $Doc[$i]["archivo"] . '" target="_Blank" Title="' . c_mes_2($Doc[$i]["mes"]) . ' ' . $Doc[$i]["ano"] . '"> <span>' . c_mes_2($Doc[$i]["mes"]) . '</span></a></dl>';
                }
            }
        }

        $DocF .= '</ul>';
    } else {
        $DocF = "";
    }

    return $DocF;

}

//Busca las FAQ
function get_faq() {
    $Faq = execute_sql("get_faq", array());

    if (is_array($Faq)) {
        $FaqF .= '<ul id="faq_ul">';

        for ($i = 1; $i <= count($Faq); $i++) {
            $FaqF .= '<li id="padre"><a href="#" onclick="ver(\'respuesta' . $i . '\'); return false">' . $i . '. ' . $Faq[$i]["pregunta"] . '</a></li>';
            $FaqF .= '<li id="respuesta' . $i . '" class="oculto" style="display:none">' . $Faq[$i]["respuesta"] . '<hr></li>';
        }

        $FaqF .= '</ul>';
        $FaqF .= '<input type="hidden" value="' . count($Faq) . '" id="Totales">';
    } else {
        $FaqF = "";
    }

    return $FaqF;

}

//Busca las Novedades
function get_novedades($Id, $Ids, $Idc) {
    $Nov = execute_sql("get_novedades", array());

    if (is_array($Nov)) {
        $NovF .= '<ul>';

        for ($i = 1; $i <= count($Nov); $i++) {
            $venlanc = "";
            if ($Nov[$i]["tipo"] == 1)
                $venlanc = ' target="_blank" ';
            if ($Nov[$i]["tipo"] == 0)
                $NovF .= '<li><a ' . $venlanc . ' href="?id=' . $Id . '&ids=' . $Ids . '&idc=' . $Idc . '&idn=' . $Nov[$i]["id_promociones"] . '" Title="' . $Nov[$i]["titulo"] . '"><img src="' . URL_UPLOADS_CONTENIDOS . $Nov[$i]["imagen"] . '"></a></li>';
            else
                $NovF .= '<li><a ' . $venlanc . ' href="' . $Nov[$i]["url"] . '"><img src="' . URL_UPLOADS_CONTENIDOS . $Nov[$i]["imagen"] . '"></a></li>';
        }

        $NovF .= '</ul>';
    }else {
        $NovF = "";
    }

    return $NovF;

}

//Busca Una Novedad dado su ID
function get_novedades_det($Idn) {
    $Nov = execute_sql("get_novedades_det", array($Idn));

    if (is_array($Nov)) {
        $NovF .= '<p>';

        for ($i = 1; $i <= count($Nov); $i++) {
            //$NovF .= '<img src="' . URL_UPLOADS_CONTENIDOS . $Nov[$i]["imagen"] . '" align="left" style="margin-right:20px;">';
            $NovF .= $Nov[$i]["titulo"] . '<br><br>' . $Nov[$i]["contenido"];
        }

        $NovF .= '</p>';
    } else {
        $NovF = "";
    }

    return $NovF;

}

//Busca los resultados del Buscador
function get_buscador_resultados($Buscar, $Limit, $MRXP) {
    $Buscador = execute_sql("get_buscador_resultados", array($Buscar, $Limit, $MRXP));

    if (is_array($Buscador)) {
        if ($Limit >= $MRXP) {
            $Start = $Limit + 1;
        } else {
            $Start = 1;
        }

        $BuscadorF .= '<ol start="' . $Start . '">';

        for ($i = 1; $i <= count($Buscador); $i++) {
            $BuscadorF .= '<li><a href="?id=' . $Buscador[$i]["id_padre"] . '&ids=' . $Buscador[$i]["id_grupo"] . '&idc=' . $Buscador[$i]["id_contenido"] . '">' . $Buscador[$i]["titulo"] . '</a><br>' . $Buscador[$i]["resumen"] . '</li>';
        }

        $BuscadorF .= '</ol>';
    } else {
        $BuscadorF = "";
    }

    return $BuscadorF;

}

function resaltar($palabra, $texto) {
    $aux = $reemp = str_ireplace($palabra, '%s', $texto);
    $veces = substr_count($reemp, '%s');
    if ($veces == 0)
        return $texto;
    $palabras_originales = array();
    for ($i = 0; $i < $veces; $i++) {
        $palabras_originales[] = '<strong>' . substr($texto, strpos($aux, '%s'), strlen($palabra)) . '</strong>';
        $aux = substr($aux, 0, strpos($aux, '%s')) . $palabra . substr($aux, strlen(substr($aux, 0, strpos($aux, '%s'))) + 2);
    }
    return vsprintf($reemp, $palabras_originales);

}

//Busca los Departamentos contacto
function get_departamentos() {
    $Departamentos = execute_sql("get_departamentos", array());

    if (is_array($Departamentos)) {
        $DepartamentosF .= '<ul id="departamentos">';

        for ($i = 1; $i <= count($Departamentos); $i++) {
            $DepartamentosF .= '<li><input type="radio" name="departamentos" id="departamentos" value="' . $Departamentos[$i]["id_departamentos"] . '"';

            if ($i == 1) {
                $Selected = ' checked';
            } else {
                $Selected = '';
            }

            $DepartamentosF .= $Selected . '> ' . $Departamentos[$i]["nombre"] . '</li>';
        }

        $DepartamentosF .= '</ul>';
    } else {
        $DepartamentosF = "";
    }

    return $DepartamentosF;

}

//Envia los emails
function send_email($Para, $De, $Asunto, $Contenido) {
    //$cabeceras = "From:$De\r\n" . 
    $cabeceras = 'From: Banplus <' . $De . '>' . "\r\n";
    //$cabeceras .= 'Cc: soporte@adverweb.com' . "\r\n";
    $cabeceras .= "X-Mailer: PHP/" . phpversion() . "\r\n" .
            "Mime-Version: 1.0\r\n" .
            "Content-Type: text/html; charset=iso-8859-1\r\n";
    //$Para="soporte@adverweb.com";
    $correo = split(";", $Para);

    //var_dump($correo); die;

    for ($i = 0; $i < count($correo); $i++) {
        //echo $correo[$i] . '<br>' . $De .'<br>' . $Asunto .'<br>' . $Contenido .'<br>';
        if (mail($correo[$i], $Asunto, $Contenido, $cabeceras)) {
            $env_email = 1;
        } else {

            //echo "error"; die;
        }
    }

}

//Arma el Mapa del Site
function get_mapa($IDS = null) {
    $Mapa = execute_sql("menu_principal_superior", array());

    $MapaF .= '<table class="tablle">';
    $MapaF .= '<tr>';
    $MapaF .= '<td>';
    if (is_array($Mapa)) {
        $MapaF .= '<dl id="menu_principal">';

        for ($i = 1; $i <= count($Mapa); $i++) {
            if ($Mapa[$i]["id_contenido"] != "") {
                $Enl = 'p_contenido.php?id=' . $Mapa[$i]["id_grupo"] . '&idc=' . $Mapa[$i]["id_contenido"];
            } else {
                $Enl = 'p_contenido.php?id=' . $Mapa[$i]["id_grupo"];
            }

            $MapaF .= '<dl><a href="' . $Enl . '"> <span class="blue">' . strtoupper($Mapa[$i]["nombre"]) . '</span></a>';

            $MapaF .= menu_hijas_mapa($Mapa[$i]["id_grupo"]);

            $MapaF .= '</dl>';
            $MapaF .= '</td>';
            $MapaF .= '<td>';

            if ($i < count($Mapa)) {
                $MapaF .= '<span id="separador"></span>';
            }
        }

        $MapaF .= '</dl>';
        $MapaF .='</tr>
                  </table>';
    } else {
        $MapaF = "";
    }

    return $MapaF;

}

function menu_hijas_secciones2($IDG, $IDP) {
    $OpcMenH = execute_sql("menu_principal_superior_secciones", array($IDG));

    if (is_array($OpcMenH)) {
        $OpcMenHF .= '<dl id="hijas_secciones">';
        for ($i = 1; $i <= count($OpcMenH); $i++) {
            $OpcMenHF .= '<dl><a href="p_contenido.php?id=' . $IDP . '&ids=' . $IDG . '&idc=' . $OpcMenH[$i]["id_contenido"] . '"> <span class="blue_2">' . $OpcMenH[$i]["titulo"] . '</span></a></dl>';
        }
        $OpcMenHF .= '</dl></br>';
    } else {
        $OpcMenHF = "";
    }

    return $OpcMenHF;

}

//Consigue los datos de las hijas de una opciòn de Menú exclusivamente para el Mapa del Site
function menu_hijas_mapa($IDP) {
    $OpcMenH = execute_sql("menu_principal_superior_hijas", array($IDP));

    if (is_array($OpcMenH)) {
        $OpcMenHF .= '<dl>';
        for ($i = 1; $i <= count($OpcMenH); $i++) {

            if ($OpcMenH[$i]["id_contenido"] != "") {
                $Enl = 'p_contenido.php?id=' . $OpcMenH[$i]["id_grupo"] . '&idc=' . $OpcMenH[$i]["id_contenido"];
            } else {
                $Enl = '#';
            }

            $OpcMenHF .= '<dl id="nivel1"><a href="' . $Enl . '"> <span class="blue_1">' . $OpcMenH[$i]["nombre"] . ' </span"></a>';
            $OpcMenHF .= menu_hijas_secciones2($OpcMenH[$i]["id_grupo"], $IDP);
            $OpcMenHF .= '</dl>';

            if ($i < count($OpcMenH)) {
                $OpcMenHF .= '<span id="separador"></span>';
            }
        }
        $OpcMenHF .= '</dl>';
    } else {
        $OpcMenHF = "";
    }

    return $OpcMenHF;

}

//Busca el listado de las Noticias/Notas de Prensa
function get_noticias($Id, $Tipo, $Par, $NumP, $Not_MRXP) {
    $EncNot = execute_sql("get_parametro", array($Par));

    $Not = execute_sql("get_noticias", array($Id, $Tipo, $NumP, $Not_MRXP));

    if (is_array($Not)) {
        $NotF .= '<ul>';

        for ($i = 1; $i <= count($Not); $i++) {

            if ($Not[$i]["archivo"] != "") {
                if (is_file(URL_UPLOADS . $Not[$i]["archivo"])) {
                    $NotF .= '<li><div class="img_nota_p"><a href="' . URL_UPLOADS . $Not[$i]["archivo"] . '" target="_blank"><img src="../site/img/icono_pdf.png" /></a></div><div class="img_nota_p2"><span class="fecha">';
                }
            } else {
                $NotF .= '<li><div class="img_nota_p"><img src="../site/img/icono_pdf.png" /></div><div class="img_nota_p2"><span class="fecha">';
            }


            $NotF .= $Not[$i]["fecha"];

            if ($Not[$i]["antetitulo"] != "") {
                $NotF .= ' - ' . $Not[$i]["antetitulo"];
            }

            $NotF .= '</span><br><a href="?id=' . $Id . '&idc=' . $EncNot[1]["valor"] . '&idn=' . $Not[$i]["id_noticia"] . '">' . $Not[$i]["titulo"] . '</a><br><br>';

            if ($Not[$i]["sumario"] != "") {
                $NotF .= '<div style="color:#838383;"> ' . $Not[$i]["sumario"] . '</div>';
            }
            if (($i + 1) == (count($Not)))
                $NotF .= '<div class="img_nota_p3" ></div>';
            $NotF .= '</div>';
            $NotF .= '<br></li>';
        }

        $NotF .= '</ul>';
    }else {
        $NotF = "";
    }

    return $NotF;

}

/*
  function get_noticias_2($Id,$Tipo,$Par,$NumP,$Not_MRXP) {

  $EncNot = execute_sql("get_parametro",array($Par));

  $Not = execute_sql("get_noticias",array($Id,$Tipo,$NumP,$Not_MRXP));

  if (is_array($Not)){
  $NotF .= '<ul>';

  for ($i=1;$i<=count($Not);$i++) {

  if ($Not[$i]["archivo"]!="") {
  if (is_file(URL_UPLOADS.$Not[$i]["archivo"])) {
  $NotF .= '<li><div class="img_nota_p"><a href="'.URL_UPLOADS.$Not[$i]["archivo"].'" target="_blank"><img src="../site/img/icono_pdf.png" /></a></div><div class="img_nota_p2"><span class="fecha">';
  }
  }else{
  $NotF .= '<li><div class="img_nota_p"><img src="../site/img/icono_pdf.png" /></div><div class="img_nota_p2"><span class="fecha">';
  }


  $NotF .= $Not[$i]["fecha"];

  if ($Not[$i]["antetitulo"]!="") {
  //$NotF .= ' - ' . $Not[$i]["antetitulo"];
  }

  $NotF .= '</span><br><a href="'.URL_UPLOADS.$Not[$i]["archivo"].'" target="_blank">' . $Not[$i]["titulo"] . '</a><br><br>';
  if($Tipo==4 and ($i+1)!=(count($Not))){
  $NotF .= '<div class="img_nota_p3" ></div>';
  }

  if ($Not[$i]["sumario"]!="") {
  $NotF .= '<div style="color:#838383;"> '.$Not[$i]["sumario"].'</div>';
  }

  if (($i+1)==(count($Not))) $NotF .= '<div class="img_nota_p3" ></div>';
  $NotF .= '</div>';


  $NotF .= '<br></li>';
  }

  $NotF .= '</ul>';
  }else{
  $NotF = "";
  }

  return $NotF;
  }
 */

function get_noticias_2($Id, $Tipo, $Par, $NumP, $Not_MRXP) {
    $EncNot = execute_sql("get_parametro", array($Par));
    $Not = execute_sql("get_noticias", array($Id, $Tipo, $NumP, $Not_MRXP));
    if (is_array($Not)) {
        $NotF .= '<ul>';
        for ($i = 1; $i <= count($Not); $i++) {
            if ($Not[$i]["archivo"] != "") {
                if (is_file(URL_UPLOADS . $Not[$i]["archivo"])) {
                    $NotF .= '<li><div class="img_nota_p"><a href="' . URL_UPLOADS . $Not[$i]["archivo"] . '" target="_blank"><img src="../site/img/icono_pdf.png" /></a></div><div class="img_nota_p2"><span class="fecha">';
                }
            } else {
                $NotF .= '<li><div class="img_nota_p"><img src="../site/img/icono_pdf.png" /></div><div class="img_nota_p2"><span class="fecha">';
            }
            $NotF .= $Not[$i]["fecha"];
            /* if ($Not[$i]["antetitulo"]!="") 
              {
              //$NotF .= ' - ' . $Not[$i]["antetitulo"];
              } */
            $NotF .= '</span><br><a href="' . URL_UPLOADS . $Not[$i]["archivo"] . '" target="_blank">' . $Not[$i]["titulo"] . '</a><br><br>';
            if ($Not[$i]["sumario"] != "") {
                $NotF .= '<div style="color:#838383;"> ' . $Not[$i]["sumario"] . '</div>';
            }
            $NotF .= '</div>';
            if (($Tipo == 4) or ( $Tipo == 2))
                if ($i <= count($Not))
                    $NotF .= '<div class="img_nota_p3" ></div>';
            $NotF .= '<br></li>';
        }
        $NotF .= '</ul>';
    }
    else {
        $NotF = "";
    }
    return $NotF;

}

//Trae el detalle completo de una Noticia/Nota de Prensa
function get_noticia_detalle($Id, $Idn, $Par) {
    $EncNot = execute_sql("get_parametro", array($Par));

    $Not = execute_sql("get_noticia_detalle", array($Idn));

    if (is_array($Not)) {
        for ($i = 1; $i <= count($Not); $i++) {
            $NotF .= '<span class="fecha">';
            $NotF .= $Not[$i]["fecha"];

            if ($Not[$i]["antetitulo"] != "") {
                $NotF .= ' - ' . $Not[$i]["antetitulo"];
            }

            $NotF .= '</span><br><span class="titulo">' . $Not[$i]["titulo"] . '</span><br><br>';

            $NotF .= $Not[$i]["contenido"];

            if ($Not[$i]["archivo"] != "") {
                if (is_file(URL_UPLOADS . $Not[$i]["archivo"])) {
                    $NotF .= '<li><div class="img_nota_p"><a href="' . URL_UPLOADS . $Not[$i]["archivo"] . '" target="_blank"><img src="../site/img/icono_pdf.png" /></a></div><div class="img_nota_p2"><span class="fecha"><br>';
                }
            }

            $NotF .= '<br>';
        }
    } else {
        $NotF = "";
    }

    return $NotF;

}

//Arma un paginador según los valores enviados
function get_paginador($Not_Num_Pag, $NumP, $Id, $Idc, $Cadena = null) {
    if (($Not_Num_Pag > 1) && ($NumP > 1)) {
        $Paginador .= '<li style="margin-right:10px;"><a href="?id=' . $Id . '&idc=' . $Idc . '&np=' . ($NumP - 1);

        if ($Cadena) {
            $Paginador .= $Cadena;
        }

        $Paginador .= '">Anterior</a></li>';
    }

    for ($x = 1; $x <= $Not_Num_Pag; $x++) {
        $Paginador .= '<li';

        if ($x == $NumP) {
            $Paginador .= ' id="bold"';
        }

        $Paginador .= '><a href="?id=' . $Id . '&idc=' . $Idc . '&np=' . $x;

        if ($Cadena) {
            $Paginador .= $Cadena;
        }

        $Paginador .= '">' . $x . '</a></li>';
    }

    if (($Not_Num_Pag > 1) && ($NumP < $Not_Num_Pag)) {
        $Paginador .= '<li style="margin-left:10px;"><a href="?id=' . $Id . '&idc=' . $Idc . '&np=' . ($NumP + 1);

        if ($Cadena) {
            $Paginador .= $Cadena;
        }

        $Paginador .= '">Siguiente</a></li>';
    }

    return $Paginador;

}

//Busca el listado de los Niveles Académicos
function get_niveles_academicos() {
    $Niveles = execute_sql("get_niveles_academicos", array());

    if (is_array($Niveles)) {
        for ($i = 1; $i <= count($Niveles); $i++) {
            $NivelesF .= '<option value="' . $Niveles[$i]["id_nivel_academico"] . '">' . $Niveles[$i]["nivel"] . '</option>';
        }
    } else {
        $NivelesF = "";
    }

    return $NivelesF;

}

//Busca el listado de los Salarios
function get_salarios() {
    $Salarios = execute_sql("get_salarios", array());

    if (is_array($Salarios)) {
        for ($i = 1; $i <= count($Salarios); $i++) {
            $SalariosF .= '<option value="' . $Salarios[$i]["id_aspiracion_salarial"] . '">' . $Salarios[$i]["valor"] . '</option>';
        }
    } else {
        $SalariosF = "";
    }

    return $SalariosF;

}

//Busca el listado de los Ingresos Mensuales para la calculadora
function get_ingresos($Tipo) {
    $Salario_Minimo = execute_sql("get_parametro", array(18));
    $Salario_Minimo = str_replace('.', '', $Salario_Minimo[1]["valor"]);
    $Salario_Minimo = str_replace(',', '.', $Salario_Minimo);

    $Salarios = execute_sql("get_tasas_salario", array($Tipo));

    if (is_array($Salarios)) {
        if ($Tipo == 1) {
            for ($i = 1; $i <= count($Salarios); $i++) {
                if ($i == 1) {
                    $Sw = "Salario menor a " . number_format(($Salario_Minimo * $Salarios[$i]["fin"]), 2, ',', '.');
                } elseif ($i == count($Salarios)) {
                    $Sw = "Salario mayor a " . number_format(($Salario_Minimo * $Salarios[$i]["inicio"]), 2, ',', '.');
                } else {
                    $Sw = "Salario entre " . number_format(($Salario_Minimo * $Salarios[$i]["inicio"]), 2, ',', '.') . " y " . number_format(($Salario_Minimo * $Salarios[$i]["fin"]), 2, ',', '.');
                }

                $SalariosF .= '<option value="' . $Salarios[$i]["tasa"] . '">' . $Sw . ' </option>'; // [Tasa: ' . $Salarios[$i]["tasa"] . ']</option>';
            }
        } elseif ($Tipo == 2) {
            $SalariosF = $Salarios[1]["tasa"];
        }
    } else {
        $SalariosF = "";
    }

    return $SalariosF;

}

//Busca el listado de los Plazos para la calculadora
function get_cuotas($Tipo) {
    $Cuotas = execute_sql("get_cuotas", array($Tipo));

    if (is_array($Cuotas)) {
        for ($i = 1; $i <= count($Cuotas); $i++) {
            $CuotasF .= '<option value="' . $Cuotas[$i]["meses"] . '">' . $Cuotas[$i]["meses"] . '</option>';
        }
    } else {
        $CuotasF = "";
    }

    return $CuotasF;

}

function mes_anhio($mes) {
    switch ($mes) {
        case '1':
            $mes = "Lunes";
            break;
        case '2':
            $mes = "Martes";
            break;
        case '3':
            $mes = "Miercoles";
            break;
        case '4':
            $mes = "Jueves";
            break;
        case '5':
            $mes = "Viernes";
            break;
        case '6':
            $mes = "Sabado";
            break;
        case '7':
            $mes = "Domingo";
            break;
    }
    $mes = $mes . strftime(' %d/ %m/ %G');
    return $mes;

}

function c_mes($mes) {
    switch ($mes) {
        case '1':
            $m = "Enero";
            break;
        case '2':
            $m = "Febrero";
            break;
        case '3':
            $m = "Marzo";
            break;
        case '4':
            $m = "Abril";
            break;
        case '5':
            $m = "Mayo";
            break;
        case '6':
            $m = "Junio";
            break;
        case '7':
            $m = "Julio";
            break;
        case '8':
            $m = "Agosto";
            break;
        case '9':
            $m = "Septiembre";
            break;
        case '10':
            $m = "Octubre";
            break;
        case '11':
            $m = "Noviembre";
            break;
        case '12':
            $m = "Diciembre";
            break;
    }
    return $m;

}

function c_mes_2($mes) {
    switch ($mes) {
        case '1':
            $m = "Primer Semestre";
            break;
        case '2':
            $m = "Segundo Semestre";
            break;
    }
    return $m;

}

function acentos($x) {

    $x = str_replace('á', '&amp;aacute;', utf8_encode($x));
    $x = str_replace('é', '&amp;eacute;', utf8_encode($x));
    $x = str_replace('í', '&amp;iacute;', utf8_encode($x));
    $x = str_replace('ó', '&amp;oacute;', utf8_encode($x));
    $x = str_replace('ú', '&amp;uacute;', utf8_encode($x));
    $x = str_replace('ñ', '&amp;ntilde;', utf8_encode($x));

    return $x;

}

function generateFormToken($form) {

    // generar token de forma aleatoria
    $token = md5(uniqid(microtime(), true));

    // generar fecha de generación del token
    $token_time = time();

    // escribir la información del token en sesión para poder
    // comprobar su validez cuando se reciba un token desde un formulario
    $_SESSION['csrf'][$form . '_token'] = array('token' => $token, 'time' => $token_time);
    ;

    return $token;

}

function verifyFormToken($form, $token, $delta_time = 0) {

    // comprueba si hay un token registrado en sesión para el formulario
    if (!isset($_SESSION['csrf'][$form . '_token'])) {
        return false;
    }

    // compara el token recibido con el registrado en sesión
    if ($_SESSION['csrf'][$form . '_token']['token'] !== $token) {
        return false;
    }

    // si se indica un tiempo máximo de validez del ticket se compara la
    // fecha actual con la de generación del ticket
    if ($delta_time > 0) {
        $token_age = time() - $_SESSION['csrf'][$form . '_token']['time'];
        if ($token_age >= $delta_time) {
            return false;
        }
    }

    return true;

}

//Envia los emails
function send_email2($Para, $De, $Asunto, $Contenido, $Name, $files,$uploaddir) {

    $mail = $_SESSION['mail_config'];
//$mail->IsMAIL();
    $mail->ClearAddresses();

    //Set who the message is to be sent from
    $mail->setFrom($De, '');
    //Set an alternative reply-to address
    //    $mail->addReplyTo($De, 'responder-1');
    //Set who the message is to be sent to
    $mail->addAddress($Para, '');

    $mail->Subject = $Asunto;
    $mail->msgHTML($Contenido);
    $mail->AltBody = '';
    $mail->From = $De;
    $mail->FromName = $Name;







    for ($i = 2; $i < count($files); $i++) {
//        if (strpos($file[$x], 'C17146576') === false) {
           
            $uploadfile1 = $uploaddir . $files[$i];
            $mail->addAttachment($uploadfile1, $files[$i]);
//        }
    }

    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }

}

?>