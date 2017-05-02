<?php

include_once ("i_db.php");

function sql_quote($value) {
    if (is_array($value)) {
        foreach ($value as $k => $v) {
            if (get_magic_quotes_gpc()) {
                $value[$k] = stripslashes($value[$k]);
            }//check if this function exists
            if (function_exists("mysql_real_escape_string")) {
                $value[$k] = mysql_real_escape_string($value[$k]);
            } else {//for PHP version < 4.3.0 use addslashes
                $value[$k] = addslashes($value[$k]);
            }
        }
    }
    return $value;

}

function execute_sql($nombre, $ArrParams = NULL) {

    switch ($nombre) {
        case 'menu_principal_superior':
            $sql = "SELECT a.id_grupo, a.nombre, a.id_padre, a.id_contenido
						FROM grupo AS a
						WHERE a.estatus='1' AND a.id_padre IS NULL
						ORDER BY a.orden ASC";
            break;
        case 'menu_principal_superior_hijas':
            $sql = "SELECT a.id_grupo, a.nombre, a.id_contenido
						FROM grupo AS a
						WHERE a.estatus='1' AND a.id_padre = '" . $ArrParams[0] . "'
						ORDER BY a.orden ASC";
            break;
        case 'menu_principal_superior_secciones':
            $sql = "SELECT a.id_contenido, b.titulo 
						FROM grupo_secciones AS a
						LEFT JOIN contenidos AS b ON (a.id_contenido=b.id_contenido)
						WHERE a.estatus='1' AND b.estatus='1' AND a.id_grupo = '" . $ArrParams[0] . "'
						ORDER BY a.orden ASC";
            break;
        case 'noticia_home':
            $sql = "SELECT a.id_noticia, a.titulo, a.tipo, a.contenido, a.noticias_link 
						FROM noticias AS a      
						WHERE a.estatus='1' AND  (Now() BETWEEN a.f_desde AND a.f_hasta)
						AND FIND_IN_SET('" . $ArrParams[0] . "', a.id_grupo)
						AND a.tipo in (1,3,5)
						ORDER BY a.orden DESC
						LIMIT 10"; //echo $sql;

            break;
        case 'menu_lateral':
            $sql = "SELECT a.id_grupo_seccion, b.id_contenido, b.id_grupo, c.id_contenido, c.titulo 
						FROM menu AS a 
						LEFT JOIN grupo_secciones AS b ON (a.id_grupo_seccion = b.id_grupo_seccion) 
						LEFT JOIN contenidos AS c ON (b.id_contenido = c.id_contenido) 
                        LEFT JOIN grupo AS d ON (b.id_grupo=d.id_grupo)
						WHERE a.estatus='1' AND b.estatus='1' AND a.posicion=2 AND (b.id_grupo=" . $ArrParams[0] . " OR d.id_padre=" . $ArrParams[0] . ")
						ORDER BY a.orden ASC";
            //echo $sql;
            break;
        case 'menu_inferior':
            $sql = "SELECT a.id_grupo_seccion, b.id_contenido, b.id_grupo, c.id_contenido, c.titulo 
						FROM menu AS a 
						LEFT JOIN grupo_secciones AS b ON (a.id_grupo_seccion = b.id_grupo_seccion) 
						LEFT JOIN contenidos AS c ON (b.id_contenido = c.id_contenido) 
                        LEFT JOIN grupo AS d ON (b.id_grupo=d.id_grupo)
						WHERE a.estatus='1' AND b.estatus='1' AND a.posicion=" . $ArrParams[1] . " AND (b.id_grupo=" . $ArrParams[0] . " OR d.id_padre=" . $ArrParams[0] . ")
						ORDER BY a.orden ASC";

            break;
        case 'encuesta_pregunta':
            $sql = "SELECT a.id_encuesta, b.id_pregunta, b.pregunta
						FROM encuesta AS a 
						LEFT JOIN preguntas AS b ON (a.id_encuesta = b.id_encuesta)
						WHERE a.estatus='1' AND FIND_IN_SET('" . $ArrParams[0] . "', id_grupo) AND b.estatus='1'
						ORDER BY a.id_encuesta DESC
						LIMIT 1";
            break;
        case 'encuesta_respuestas':
            $sql = "SELECT a.id_respuestas, a.respuesta, a.contador
						FROM respuestas AS a
						WHERE a.id_pregunta = '" . $ArrParams[0] . "' AND a.estatus='1'
						ORDER BY a.orden ASC";
            break;
        case 'encuesta_respuestas_totales':
            $sql = "SELECT SUM(a.contador) AS Totales
						FROM respuestas AS a
						WHERE a.id_pregunta = '" . $ArrParams[0] . "' AND a.estatus='1'
						ORDER BY a.respuesta ASC";
            break;
        case 'get_banner':
            $sql = "SELECT a.id_banner, a.imagen, b.link, b.externo
						FROM banner AS a, banner_seccion AS b, grupo_secciones AS c
						WHERE a.id_banner=b.id_banner AND b.id_grupo_secciones=c.id_grupo_seccion AND a.estatus=1 AND b.id_posicion='" . $ArrParams[1] . "' AND c.id_grupo='" . $ArrParams[0] . "'
						AND ((Now() BETWEEN b.fecha_inicio AND b.fecha_fin) OR (Now() >= b.fecha_inicio AND b.fecha_fin is null) OR (b.fecha_inicio is null AND b.fecha_fin is null))";

            if (($ArrParams[1] != 9) and ( $ArrParams[1] != 12)) {
                $sql .= " LIMIT 1";
            } else {
                $sql .= " LIMIT 3";
            } //echo $sql;

            break;
        case 'get_banner_home':
            $sql = "SELECT a.id_banner, a.imagen, b.link, b.externo, b.orden  FROM banner AS a, banner_seccion AS b, grupo_secciones AS c 
						WHERE a.id_banner=b.id_banner AND b.id_grupo_secciones=c.id_grupo_seccion AND a.estatus=1 AND b.id_posicion='" . $ArrParams[1] . "' AND c.id_grupo='" . $ArrParams[0] . "' and 
						((Now() BETWEEN b.fecha_inicio AND b.fecha_fin) OR (Now() >= b.fecha_inicio AND b.fecha_fin is null) OR 
						(b.fecha_inicio is null AND b.fecha_fin is null)) order by b.orden asc LIMIT 4";
            //echo "<li>".$sql; //exit;
            break;
        case 'get_banner_interno':
            if ($ArrParams[1] == 13) {
                $ArrParams[0] = 1;
            }
            $sql = "SELECT a.id_banner, a.imagen, b.link, b.externo,b.fecha_inicio
						FROM banner AS a, banner_seccion AS b,  grupo_secciones AS c
						WHERE a.id_banner=b.id_banner AND b.id_grupo_secciones=c.id_grupo_seccion AND a.estatus=1 AND b.id_posicion='" . $ArrParams[1] . "' AND c.id_contenido='" . $ArrParams[0] . "'
						AND ((Now() BETWEEN b.fecha_inicio AND b.fecha_fin) OR (Now() >= b.fecha_inicio AND b.fecha_fin is null) OR (b.fecha_inicio is null AND b.fecha_fin is null))";
            if ($ArrParams[1] == 13) {
                $sql .= " LIMIT 1";
            }

            //echo $sql;

            break;
        case 'get_parametro':
            $sql = "SELECT a.valor, a.archivo
						FROM parametros AS a
						WHERE a.estatus=1 AND a.id_parametro='" . $ArrParams[0] . "'";


            break;

        case 'get_parametro_value':
            $sql = "SELECT a.email, a.nombre 
						FROM departamentos AS a WHERE a.estatus=1 AND a.id_departamentos='" . $ArrParams[0] . "'";
            // echo "<li>".$sql;
            // exit;
            break;

        case 'get_parametro_link_online':
            $sql = "SELECT a.valor
						FROM parametros AS a
						WHERE a.estatus=1 AND a.id_parametro IN (3,4,5,6)";
            break;
        case 'get_parametro_follow':
            $sql = "SELECT a.id_parametro, a.valor
						FROM parametros AS a
						WHERE a.estatus=1 AND a.id_parametro IN (2,7,50,51,52,53,55,56,57,58,59,60,61,62,63)";
            //echo "<LI>".$sql;
            break;
        case 'get_contenido':
            $sql = "SELECT a.id_contenido, a.imagen, a.resumen, a.contenido, a.titulo,
						a.id_herramienta_financiera, b.plantilla
						FROM contenidos AS a
						LEFT JOIN modulos AS b ON(a.id_herramienta_financiera=b.id_modulo_financiero)
						WHERE a.edicion=1 AND a.estatus=1 AND a.id_contenido='" . $ArrParams[0] . "'";
            break;
        /* movil */
        case 'get_agencias':
            $sql = "SELECT c.id_estado, c.nombre
						FROM agencias AS a, ciudad AS b, estado AS c
						WHERE a.id_ciudad=b.id_ciudad AND b.id_estado=c.id_estado AND a.estatus=1 AND b.estatus=1 AND c.estatus=1
						
						GROUP BY c.id_estado
						ORDER BY c.nombre";
            break;
        case 'get_estados':
            $sql = "SELECT a.id_estado, a.nombre
						FROM estado AS a
						WHERE a.estatus=1";
            break;

        case 'get_ciudad':
            $sql = "SELECT a.*
						FROM ciudad AS a
						WHERE a.estatus=1";
            break;

        case 'get_estado_id':
            $sql = "SELECT a.id_estado, a.nombre
						FROM estado AS a
						WHERE a.estatus=1 AND a.id_estado=" . $ArrParams[0];
            break;
        case 'get_estado_id2':
            $sql = "SELECT a.id_estado, a.nombre
						FROM estado AS a
						WHERE a.estatus=1 AND a.id_estado=" . $ArrParams;
            break;

        /* movil */
        case 'get_agencias_estados':
            $sql = "SELECT a.id_agencias, a.nombre
						FROM agencias AS a, ciudad AS b, estado AS c
						WHERE a.id_ciudad=b.id_ciudad AND b.id_estado=c.id_estado AND a.estatus=1 AND b.estatus=1 AND c.estatus=1 AND c.id_estado=" . $ArrParams[0] . " order by a.nombre ";

            break;
        case 'get_agencia_id':
            $sql = "SELECT a.id_agencias, a.nombre, a.direccion, a.telef_1, a.horario_agencia,
						a.horario_taq_auto, a.coordenadas, b.nombre AS Ciudad, c.nombre AS Estado
						FROM agencias AS a, ciudad AS b, estado AS c
						WHERE a.id_ciudad=b.id_ciudad AND b.id_estado=c.id_estado AND a.estatus=1 AND b.estatus=1 AND c.estatus=1 AND a.id_agencias=" . $ArrParams[0];


            break;
        case 'get_servicios_agencias':
            $sql = "SELECT a.id_servicios, a.nombre, a.imagen 
						FROM servicios AS a, agencias_servicios AS b
						WHERE a.id_servicios=b.id_servicio AND a.estatus=1 AND b.estatus=1 AND b.id_agencias=" . $ArrParams[0];

            break;
        case 'validate_tips':
            $sql = "SELECT a.id_contenido 
						FROM contenidos AS a, grupo_secciones AS b 
						where a.id_contenido = '" . $ArrParams[0] . "' AND a.id_contenido=b.id_contenido AND b.id_grupo='" . $ArrParams[1] . "' LIMIT 1";
            break;
        case 'get_calendar_days':
            $sql = "SELECT a.tipo, DATE_FORMAT(a.fecha,'%d-%m-%Y') AS fecha, a.descripcion 
						FROM calendario AS a 
						where FIND_IN_SET('" . $ArrParams[0] . "', a.tipo) AND a.estatus=1";
            break;
        case 'get_doc':
            $sql = "SELECT a.titulo, a.sumario, a.documento 
						FROM documentos AS a, documentos_secciones AS b, grupo_secciones AS c
						where a.id_documentos=b.id_documentos AND b.id_grupo_sec=c.id_grupo_seccion
						AND c.id_contenido='" . $ArrParams[1] . "' AND c.id_grupo='" . $ArrParams[0] . "' AND a.estatus=1 AND b.estatus=1 
						AND ((Now() BETWEEN b.fecha_inicio AND b.fecha_fin) OR (Now() >= b.fecha_inicio AND b.fecha_fin is null) OR (b.fecha_inicio is null AND b.fecha_fin is null))
						AND c.estatus=1"; //echo $sql;
            break;
        case 'get_estados_financieros':
            $sql = "SELECT a.ano, a.mes, a.archivo 
						FROM informacion_financiera AS a
						where a.estatus=1 order by ano DESC,mes ";
            //echo "<li>".$sql;

            break;
        case 'get_memoria_semetral':
            $sql = "SELECT a.ano, a.mes, a.archivo 
						FROM memoria_semestral AS a
						where a.estatus=1 order by ano DESC,mes";
            //echo "<li>".$sql;
            break;
        case 'get_faq':
            $sql = "SELECT a.id_faq, a.pregunta, a.respuesta 
						FROM faq AS a
						where a.estatus=1
						ORDER BY a.id_faq";
            //echo "<li>".$sql;
            break;
        case 'get_novedades':
            $sql = "SELECT a.id_promociones, a.titulo, a.imagen, a.tipo, a.url
						FROM promociones AS a
						where a.estatus=1
						ORDER BY a.id_promociones desc";
            //echo "<li>".$sql;
            break;
        case 'get_novedades_det':
            $sql = "SELECT a.id_promociones, a.titulo, a.imagen, a.contenido
						FROM promociones AS a
						where a.estatus=1 AND a.id_promociones='" . $ArrParams[0] . "'";
            break;


        case 'get_agencia_all':

            $sql = "select * from agencias where estatus=1 order by nombre asc";

            //echo "<li>".$sql;

            break;
        case 'get_buscador_resultados':

            $consulta = $ArrParams[0];
            $consulta = split(' ', $consulta);

            $sql = "SELECT a.id_contenido, a.resumen, a.contenido, a.titulo, b.id_grupo_seccion, b.id_grupo, c.id_padre";

            $sql .= " FROM awvps_banplus.contenidos AS a
				LEFT JOIN awvps_banplus.grupo_secciones AS b ON (a.id_contenido=b.id_contenido) 
				LEFT JOIN awvps_banplus.grupo AS c ON (b.id_grupo=c.id_grupo)
				WHERE a.estatus='1' AND b.estatus='1' AND c.estatus='1'	AND c.id_padre != ''	
						AND (";


            for ($a = 0; $a < count($consulta); $a++) {
                if ($consulta[$a] != '') {
                    $sql .= "(a.resumen LIKE '%" . acentos($consulta[$a]) . "%')";
                    $sql .= " OR (a.contenido LIKE '%" . acentos($consulta[$a]) . "%')";
                    $sql .= " OR (a.titulo LIKE '%" . $consulta[$a] . "%')";
                    if (($a < count($consulta)) && (($a + 1) != (count($consulta))))
                        $sql .= 'OR ';
                }
            }


            $sql .= ")
						GROUP BY a.id_contenido";

            $sql .= " LIMIT " . $ArrParams[1] . "," . $ArrParams[2];
            //echo "->".$sql."<-";
            break;
        case 'get_buscador_resultados2':
            $consulta = $ArrParams[0];
            $consulta = split(' ', $consulta);

            $sql = "SELECT COUNT(a.id_contenido) AS Total";



            $sql .= " FROM awvps_banplus.contenidos AS a
				LEFT JOIN awvps_banplus.grupo_secciones AS b ON (a.id_contenido=b.id_contenido) 
				LEFT JOIN awvps_banplus.grupo AS c ON (b.id_grupo=c.id_grupo)
				WHERE a.estatus='1' AND b.estatus='1' AND c.estatus='1'	AND c.id_padre != ''	
						AND (";

            for ($a = 0; $a < count($consulta); $a++) {
                if ($consulta[$a] != '') {
                    $sql .= "(a.resumen LIKE '%" . acentos($consulta[$a]) . "%')"; //echo "->".$sql."<-";
                    $sql .= " OR (a.contenido LIKE '%" . acentos($consulta[$a]) . "%')"; //echo "->".$sql."<-";
                    $sql .= " OR (a.titulo LIKE '%" . $consulta[$a] . "%')"; //echo "->".$sql."<-";
                    if (($a < count($consulta)) && (($a + 1) != (count($consulta))))
                        $sql .= 'OR ';
                }
            }


            $sql .= ")
						GROUP BY a.id_contenido";

            //echo "->".$sql."<-";		
            break;

        case 'get_buscador_TOTALES':
            $consulta = $ArrParams[0];
            $consulta = split(' ', $consulta);

            $sql = "SELECT COUNT(a.id_contenido) AS Total";

            $sql .= " FROM awvps_banplus.contenidos AS a
				LEFT JOIN awvps_banplus.grupo_secciones AS b ON (a.id_contenido=b.id_contenido) 
				LEFT JOIN awvps_banplus.grupo AS c ON (b.id_grupo=c.id_grupo)
				WHERE a.estatus='1' AND b.estatus='1' AND c.estatus='1'		
						AND (";

            if (count($consulta) > 1) {
                $sql .= " MATCH (a.contenido, a.resumen, a.titulo) AGAINST ('" . $ArrParams[0] . "') ";
            } else {
                for ($a = 0; $a < count($consulta); $a++) {
                    if ($consulta[$a] != '') {
                        $sql .= "(a.resumen LIKE '%" . $consulta[$a] . "%')";
                        $sql .= " OR (a.contenido LIKE '%" . $consulta[$a] . "%')";
                        if ($a != 0)
                            $sql .= 'OR ';
                    }
                }
            }

            $sql .= ")";
            //echo $sql;	
            break;
        case 'get_departamentos':
            $sql = "SELECT a.id_departamentos, a.nombre, a.email
						FROM departamentos AS a
						where a.estatus=1
						ORDER BY a.nombre";
            break;
        case 'get_noticias':
            $sql = "SELECT a.id_noticia, a.titulo, a.antetitulo, a.sumario, 
						DATE_FORMAT(a.fecha,'%d-%m-%Y') AS fecha,
						a.archivo as archivo
						FROM noticias AS a
						WHERE a.estatus='1' AND fecha <= NOW()
						AND FIND_IN_SET('" . $ArrParams[0] . "', a.id_grupo)
						AND tipo='" . $ArrParams[1] . "'
						ORDER BY a.orden DESC 
						LIMIT " . $ArrParams[2] . "," . $ArrParams[3];
            //exit($sql);
            break;
        case 'get_noticia_detalle':
            $sql = "SELECT a.id_noticia, a.titulo, a.antetitulo, a.sumario, 
						DATE_FORMAT(a.fecha,'%d-%m-%Y') AS fecha, a.contenido, a.imagen,a.archivo as archivo
						FROM noticias AS a
						WHERE a.estatus='1' AND fecha <= NOW()
						AND a.id_noticia='" . $ArrParams[0] . "'";
            //echo "<li>".$sql;			
            break;

        case 'get_noticias_TOTALES':
            $sql = "SELECT count(id_noticia) AS Total
						FROM noticias AS a
						WHERE a.estatus='1' AND fecha <= NOW()
						AND FIND_IN_SET('" . $ArrParams[0] . "', a.id_grupo)
						AND tipo='" . $ArrParams[1] . "'";
            break;
        case 'get_niveles_academicos':
            $sql = "SELECT a.id_nivel_academico, a.nivel
						FROM nivel_academico AS a
						ORDER BY a.nivel";
            break;
        case 'get_niveles_academicos_detalle':
            $sql = "SELECT a.id_nivel_academico, a.nivel
						FROM nivel_academico AS a where id_nivel_academico='" . $ArrParams[0] . "'";
            break;
        case 'get_salarios':
            $sql = "SELECT a.id_aspiracion_salarial, a.valor
						FROM aspiracion_salarial AS a
						ORDER BY a.orden";
            break;
        case 'get_salarios_detalle':
            $sql = "SELECT a.id_aspiracion_salarial, a.valor
						FROM aspiracion_salarial AS a where id_aspiracion_salarial='" . $ArrParams[0] . "'";
            break;
        case 'get_tasas_salario':
            $sql = "SELECT a.inicio, a.fin, a.tasa
						FROM tasas_interes AS a
						WHERE a.tipo='" . $ArrParams[0] . "' AND a.estatus=1
						ORDER BY a.inicio"; // josue echo $sql;
            break;
        case 'get_tasas_salario2':
            $sql = "SELECT a.inicio, a.fin, a.tasa
						FROM tasas_interes AS a
						WHERE a.tipo='" . $ArrParams[0] . "' 
						AND a.inicio='" . $ArrParams[1] . "' 
						AND a.fin='" . $ArrParams[2] . "'
						AND a.estatus=1
						ORDER BY a.inicio";  //echo $sql;
            break;
        case 'get_cuotas':
            $sql = "SELECT a.meses
						FROM cuotas AS a
						WHERE a.tipo='" . $ArrParams[0] . "'
						ORDER BY a.meses";
            //echo $sql;
            break;

        case 'get_valid_seg1':
            // segmento asociado a otro segmento
            $sql = "select * from grupo where id_padre = " . $ArrParams[0];
            //echo "<li>".$sql;

            break;

        case 'get_valid_seg2':
            $sql = "select * from grupo_secciones where id_grupo = " . $ArrParams[0];
            //echo "<li>".$sql;

            break;

        case 'get_valid_seg3':
            // segmento asociado a otro segmento
            $sql = "select * from grupo_secciones where id_contenido =  " . $ArrParams[0];
            //echo "<li>".$sql;
            //exit;						
            break;

        case 'get_estados_disponibles':
            $sql = "select * from estado as c where c.id_estado in (
						select b.id_estado from ciudad as b where b.id_ciudad in (
						select a.id_ciudad from agencias as a))";
            //echo "<li>".$sql;
            break;

        case 'get_ciudad_estado_d':
            $sql = "select b.* from ciudad as b where b.id_ciudad in (
						select a.id_ciudad from agencias as a) and b.id_estado = " . $ArrParams;
            //echo "<br>".$sql."<br><br>";
            break;

        case 'get_agencias_ciudad_d':
            $sql = "select * from  agencias where id_ciudad = " . $ArrParams;
            //echo "<br>".$sql."<br><br>";
            break;

        case 'get_agencias_estado_d':
            $sql = "SELECT a.id_agencias, a.nombre
						FROM agencias AS a, ciudad AS b, estado AS c
						WHERE a.id_ciudad=b.id_ciudad AND b.id_estado=c.id_estado AND a.estatus=1 AND b.estatus=1 AND c.estatus=1 AND c.id_estado=" . $ArrParams;
            break;
    }

    abrirConexion();
    sql_quote($ArrParams);

    $ejecutar_sql = mysql_query($sql);

    if (!$ejecutar_sql) {
        hay_ataque();
    };

    $num_rows = mysql_num_fields($ejecutar_sql);
    $j = 0;
    $x = 1;

    while ($row = mysql_fetch_array($ejecutar_sql)) {
        for ($j = 0; $j < $num_rows; $j++) {
            $name = mysql_field_name($ejecutar_sql, $j);
            $object[$x][$name] = $row[$name];
        }
        $x++;
    }

    mysql_free_result($ejecutar_sql);
    cerrarConexion();
    return $object;

}

function actualizar_campo($nombre, $ArrParams = NULL) {
    switch ($nombre) {
        case 'actualiza_menu':
            $sql = "UPDATE respuestas SET contador=contador+1 WHERE id_respuestas='" . $ArrParams[0] . "'";
            break;
        case 'actualiza_estatus':
            $sql = "UPDATE usuarios SET estatus=0 WHERE acceso='" . $ArrParams[0] . "'";
            //echo $sql;
            break;
        case 'insert_historico_acceso':
            $sql = " INSERT INTO historico_acceso (id_usuario,acceso) VALUES (" . $ArrParams[0] . ",md5('" . $ArrParams[1] . "')) ";
            //echo $sql;
            break;
        case 'update_usuario':
            $sql = " UPDATE usuarios SET llave=md5(acceso) WHERE id_usuario=" . $ArrParams[0] . " ";
            //echo $sql;
            break;
        default:
            return NULL;
    }

    abrirConexion();
    sql_quote($ArrParams);
    $ejecutar_sql = mysql_query($sql);

    if ($Valor == 1) {
        $ejecutar_sql = mysql_insert_id();
    }

    cerrarConexion();
    return($ejecutar_sql);

}

function traer_totales($nombre, $ArrParams = NULL) {

    switch ($nombre) {
        case 'get_noticias_TOTALES':
            $sql = "SELECT count(id_noticia) AS Total
						FROM noticias AS a
						WHERE a.estatus='1' AND fecha <= NOW()
						AND FIND_IN_SET('" . $ArrParams[0] . "', a.id_grupo)
						AND tipo='" . $ArrParams[1] . "'";
            echo "<li>" . $sql;
            break;
        default:
            return NULL;
    }

    abrirConexion();
    sql_quote($ArrParams);
    $ejecutar_sql = mysql_query($sql);
    $num_rows = mysql_num_rows($ejecutar_sql);
    echo "<li>" . $num_rows;
    cerrarConexion();
    return $num_rows;

}

function seteo($cadena) {
    $cad = strtoupper(substr($cadena, 0, 1)); //echo $cadena."-".$cad;
    //echo "cadena cad='".$cad."' ///";
    $cad1 = strtolower(substr($cadena, 1, (strlen($cadena) - 1)));
    //echo "cadena cad1='".$cad1."' ///";
    $cad = $cad . $cad1;
    return $cad;

}

?>
