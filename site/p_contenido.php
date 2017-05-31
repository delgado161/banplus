<?php
ini_set('display_errors', 0);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

ob_start();
session_start();
setlocale(LC_TIME, "es_ES");
//header('Content-type: text/plain; charset=utf-8');

include_once "includes/i_generales.php";
include_once "includes/i_funciones.php";

$Id = (isset($_REQUEST["id"])) ? intval($_REQUEST["id"]) : '';
$Ids = (isset($_REQUEST["ids"])) ? intval($_REQUEST["ids"]) : '';
$Idc = (isset($_REQUEST["idc"])) ? intval($_REQUEST["idc"]) : '';
$Idn = (isset($_REQUEST["idn"])) ? intval($_REQUEST["idn"]) : '';
$BuscarSrc = (isset($_REQUEST["buscar"])) ? intval($_REQUEST["buscar"]) : '';
$NumP = (isset($_REQUEST["np"])) ? intval($_REQUEST["np"]) : '';

/* $Id = intval($_REQUEST["id"]);
  $Ids = intval($_REQUEST["ids"]);
  $Idc = intval($_REQUEST["idc"]);
  $Idn = intval($_REQUEST["idn"]);
  $BuscarSrc = $_REQUEST["buscar"];
  $NumP = intval($_GET["np"]); */


if ($Id == "") {
    header('Location: p_contenido.php?id=1');
    exit();
}

if ($Idc == "") {
    $Idsb = $Id;
} else {
    $Idsb = $Idc;
}

$metatag_descripcion = execute_sql("get_parametro", array(54));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head> 
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
            <link href='ban.ico' rel='shortcut icon' type='image/x-icon'> 
                <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
                <META http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <META NAME="keywords" content="<?php echo Keywords; ?>"/>
                <META NAME="Description" CONTENT="<?php echo $metatag_descripcion[1]['valor']; ?>"/>
                <title><?php echo TITLE_SITE; ?><?php echo $Title; ?></title>		

                <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

                <script src="<?php echo URL_SITE; ?>js/i_lenguaje.js" type="text/javascript"></script>
                <script src="<?php echo URL_SITE; ?>js/i_generales.js" type="text/javascript"></script>

                <link href="<?php echo URL_SITE; ?>css/site.css" rel="stylesheet" type="text/css" />
                <link rel="stylesheet" href="<?php echo URL_SITE; ?>css/layout.css" type="text/css" media="screen" charset="utf-8" />
                <link rel="stylesheet" href="<?php echo URL_SITE; ?>css/jd.gallery.css" type="text/css" media="screen" charset="utf-8" />

                <SCRIPT src="<?php echo URL_SITE; ?>js/jquery-1.8.1.min.js" type="text/javascript"></SCRIPT>



                <script type="text/javascript" src="<?php echo URL_SITE; ?>js/ddsmoothmenu.js">
                    /***********************************************
                     * Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
                     * This notice MUST stay intact for legal use
                     * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
                     ***********************************************/
                </script>

                <script id="twitter-wjs" src="http://platform.twitter.com/widgets.js"></script>
                <SCRIPT src="<?php echo URL_SITE; ?>/js/autoNumeric-1.7.5.js" type="text/javascript"></SCRIPT>
                <script src="<?php echo URL_SITE; ?>js/mootools-1.2.1-core-yc.js" type="text/javascript"></script>
                <script src="<?php echo URL_SITE; ?>js/mootools-1.2-more.js" type="text/javascript"></script>

                <script src="<?php echo URL_SITE; ?>js/jd.gallery.js" type="text/javascript"></script>
                <script src="<?php echo URL_SITE; ?>js/i_marquee.js" type="text/javascript"></script>
                <?php if ($Idc == "") { ?>
                    <script type="text/javascript">


                        mookieDefaultExample = new Mooquee({
                            trans: {'tin': 'left', 'tout': 'left'},
                            duration: 3,
                            pause: 6

                        });
                    </script>
                <?php } ?>



                <script type="text/javascript">
                    ddsmoothmenu.init({
                        mainmenuid: "smoothmenu1", //menu DIV id
                        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                        classname: 'ddsmoothmenu', //class added to menu's outer DIV
                        //customtheme: ["#1c5a80", "#18374a"],
                        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
                    })
                </script>

                <script>
                    /*jQuery(function($) {
                     $('input.auto').autoNumeric({aSep: '.', aDec: ','});
                     }); */
                </script>

                <link rel="stylesheet" type="text/css" href="<?php echo URL_SITE; ?>css/ddsmoothmenu.css" />

                <!--[if lte IE 10]>
                <script>
                setTimeout(function(){ busca() }, 5000);
                </script>
                
                <![endif]-->

                <script type="text/javascript">


                    function busca() {

                        var x = document.getElementById("twitter-widget-0");
                        /*var links = document.getElementsByTagName("a");
                         var isLink = false;
                         
                         //alert(links.length);
                         for(var i=0; i<links.length; i++){
                         var link = links[i];
                         //alert(link.className);
                         if(link.className=='twitter-timeline'){
                         isLink = true;
                         //alert('gg');
                         }
                         }*/


                        if (x != undefined) {
                            //document.getElementById("tw1").style.display="none";  
                            document.getElementById("tw2").style.display = "none";
                            document.getElementById("tw3").style.display = "block";

                        } else {

                            document.getElementById("tw2").style.display = "block";
                            document.getElementById("tw3").style.display = "none";

                        }

                    }


                </script>



                </head>


                <body   <?php if ($Idc == 28) { ?> onLoad="cargform();" <?php } else {
                    ?> onLoad="cargform();
                                    busca();" <?php } ?> >
                                                       <?php if ($Idc == "") { ?>
                        <script type="text/javascript">
                            function startGallery() {
                                var myGallery = new gallery($('myGallery'), {
                                    timed: true,
                                    showArrows: true,
                                    showCarousel: false,
                                    embedLinks: true,
                                    showInfopane: false,
                                    baseClass: 'jdGallery',
                                    withArrowsClass: 'withArrows'
                                });
                            }
                            window.addEvent('domready', startGallery);

                        </script>
                    <?php } ?>

                    <div id="body_id">

                        <div id="principal">
                            <?php
                            include "includes/i_header.php";
                            ?>
                            <?php
                            if ($Idc == "") {
                                include "includes/i_home.php";
                            } else {
                                include "includes/i_cuerpo.php";
                            }
                            ?>

                        </div>
                        <div id="sombra">
                            <?php
                            include "includes/i_footer.php";
                            ?>	
                        </div>
                        <div id="footer_bottom">
                            <?php
                            include "includes/i_footer2.php";
                            ?>
                        </div>
                    </div>

                </body>
                </html>
