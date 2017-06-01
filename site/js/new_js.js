/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// format number


$(document).ready(function () {

    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        changeYear: true,
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $('#form_ap_cuenta').submit(function () {
        var validado = true;



        if (($('.requerido_2').val().length <= 0 || $('.requerido_2').val() == "" || parseFloat($('.requerido_2').val()) <= 0) && ($('.requerido_21').val().length <= 0 || $('.requerido_21').val() == "")) {
            $('.requerido_2,.requerido_21').css('background', 'rgba(132, 189, 0, 0.15)');
        } else {
            if (($('.requerido_2').val().length <= 0 || $('.requerido_2').val() == "" || parseFloat($('.requerido_2').val()) <= 0)) {
                $('.requerido_2').css('background', 'rgba(255,0,0,0.30)');
                validado = false;
            } else {
                $('.requerido_2').css('background', 'rgba(132, 189, 0, 0.15)');
            }

            if (($('.requerido_21').val().length <= 0 || $('.requerido_21').val() == "")) {
                $('.requerido_21').css('background', 'rgba(255,0,0,0.30)');
                validado = false;
            } else {
                $('.requerido_21').css('background', 'rgba(132, 189, 0, 0.15)');
            }
        }




        $('.prod_banplus,.cc_banplus,.ref_ban_comer').each(function () {
            var validado2 = true;
            var campos = $(this).find('.valida_prod').length;
            var contador = 1;


            $(this).find('.valida_prod').each(function () {
                if ($(this).val().length <= 0 || $(this).val() == "" || parseFloat($(this).val()) <= 0) {
                } else {
                    if (campos == contador) {
                        validado2 = true;
                    } else {
                        validado2 = false;
                    }
                    contador = contador + 1;
                }
            });


            if (!validado2) {
                $(this).find('.valida_prod').css('background', 'rgba(255,0,0,0.30)');
                validado = false;
            }
            else
                $(this).find('.valida_prod').css('background', 'rgba(132, 189, 0, 0.15)');


            if ($(this).hasClass('cc_banplus')) {
                if (!validado2) {
                    $('.cc_banplus2').find('input').each(function () {
                        $(this).addClass('requerido_');
                    });
                }
                else {
                    $('.cc_banplus2').find('input').each(function () {
                        $(this).css('background', 'rgba(132, 189, 0, 0.15)');
                        $(this).removeClass('requerido_');
                    });
                }

            }


            if ($(this).hasClass('ref_ban_comer')) {

                if (!validado) {
                    $('.ref_adjunto').addClass('requerido_');
                }
                else {
                    $('.ref_adjunto').css('background', 'rgba(132, 189, 0, 0.15)');
                    $('.ref_adjunto').removeClass('requerido_');

                }

            }

        });





        $('.custom-file-input').each(function () {

            var ext = $(this).val().split('.').pop().toLowerCase();

            if ($(this).val().length <= 0 || $(this).val() == "" || parseFloat($(this).val()) <= 0) {
                $(this).css('background', 'rgba(132, 189, 0, 0.15)');
            } else {
                if ($.inArray(ext, ['jpg', 'jpeg', 'pdf', 'JPG', 'JPGE', 'PDF']) == -1) {
                    $(this).css('background', 'rgba(255,0,0,0.30)');
                    validado = false;
                    $(this).next('span').html(' FORMATO INVALIDO SOLO SE PERMITEN PNG, JPG, JPEG, PDF');
                } else {
                    var file_size = $(this)[0].files[0].size;
                    if (file_size > 2097152) {
                        $(this).css('background', 'rgba(255,0,0,0.30)');
                        validado = false;
                        $(this).next('span').html('EL ARCHIVO DEBE PESAR MENOR A 2MB');
                    } else {
                        $(this).next('span').html('');
                        $(this).css('background', 'rgba(132, 189, 0, 0.15)');
                    }
                }




            }





        });



        $('.requerido_').each(function () {
            if ($(this).val().length <= 0 || $(this).val() == "" || parseFloat($(this).val()) <= 0) {
                $(this).css('background', 'rgba(255,0,0,0.30)');
                validado = false;
            } else {
                $(this).css('background', 'rgba(132, 189, 0, 0.15)');
            }


        });




        if (!validado)
//            alert('Por Favor rellene los campos se\u00f1alados');
        return true;
    });
    $("#fc_nac").datepicker({
        dateFormat: "dd/mm/yy",
        yearRange: '-100:-18'
    });

    $(".fechas,#cierre_fiscal,#ult_registro,#ccfc_nac").datepicker({
        dateFormat: "dd/mm/yy",
        yearRange: '-100:+0'
    });

    $("#fc_nac").change(function () {
        fecha = $(this).val().split("/");
        $('#edad').val(calcular_edad(fecha[0], fecha[1], fecha[2]));
    });

    $("#ccfc_nac").change(function () {
        fecha = $(this).val().split("/");
        $('#ccedad').val(calcular_edad(fecha[0], fecha[1], fecha[2]));
    });

    $('#tp_inmueble,#d_vivienda').change(function () {

        if ($(this).val() == "ARRENDADA" || $(this).val() == "ALQUILADO" || $(this).val() == "4")
            $('.cannon').show();
        else
            $('.cannon').hide();
    });
    $('#canon,#sueldo,#comision,#libre_ejercicio,#otros_ingresos,.moneda_,.moneda_2,.jmoneda,.jmoneda2').val(0, 00);
    $('#canon,#sueldo,#comision,#libre_ejercicio,#otros_ingresos,.moneda_,.moneda_2,.jmoneda,.jmoneda2').mask("###0,00", {reverse: true});

    $('#canon,#sueldo,#comision,#libre_ejercicio,#otros_ingresos').keyup(function () {
        suma = parseFloat($('#sueldo').val().replace(",", ".")) + parseFloat($('#comision').val().replace(",", ".")) + parseFloat($('#libre_ejercicio').val().replace(",", ".")) + parseFloat($('#otros_ingresos').val().replace(",", "."));
        $('#total_ingresos').val(parseFloat(suma.toFixed(2)));
        $('#total_ingresos').val($('#total_ingresos').val().replace(".", ","));
    });
    $('.telefono_').mask('000-0000');
    $('.cta_banco').mask('0000-0000-00-00-00000000');


    $('.moneda_').keyup(function () {
        var suma2 = 0;

        $('.moneda_').each(function () {
            suma2 = parseFloat($(this).val().replace(",", ".")) + suma2;
        });
        $('#go_total_ingresos').val(parseFloat(suma2.toFixed(2)));
        $('#go_total_ingresos').val($('#go_total_ingresos').val().replace(".", ","));
    });


    $('.jmoneda2s').keyup(function () {
        var suma2 = 0;

        $('.jmoneda2s').each(function () {
            suma2 = parseFloat($(this).val().replace(",", ".")) + suma2;
        });
        $('#act_total_sus').val(parseFloat(suma2.toFixed(2)));
        $('#act_total_sus').val($('#act_total_sus').val().replace(".", ","));
    });

    $('.jmoneda2_p').keyup(function () {
        var suma2 = 0;

        $('.jmoneda2_p').each(function () {
            suma2 = parseFloat($(this).val().replace(",", ".")) + suma2;
        });
        $('#act_total_percent').val(parseFloat(suma2.toFixed(2)));
        $('#act_total_percent').val($('#act_total_percent').val().replace(".", ","));
    });

    $('.jmoneda2p').keyup(function () {
        var suma2 = 0;

        $('.jmoneda2p').each(function () {
            suma2 = parseFloat($(this).val().replace(",", ".")) + suma2;
        });
        $('#act_total_pagado').val(parseFloat(suma2.toFixed(2)));
        $('#act_total_pagado').val($('#act_total_pagado').val().replace(".", ","));
    });




    $('.moneda_2').keyup(function () {
        var suma2 = 0;

        $('.moneda_2').each(function () {
            suma2 = parseFloat($(this).val().replace(",", ".")) + suma2;
        });
        $('#igf_total_ingresos').val(parseFloat(suma2.toFixed(2)));
        $('#igf_total_ingresos').val($('#igf_total_ingresos').val().replace(".", ","));
    });

    $('.moneda_3').keyup(function () {
        var suma2 = 0;

        $('.moneda_3').each(function () {
            suma2 = parseFloat($(this).val().replace(",", ".")) + suma2;
        });
        $('#cctotal_ingresos').val(parseFloat(suma2.toFixed(2)));
        $('#cctotal_ingresos').val($('#cctotal_ingresos').val().replace(".", ","));
    });



    $("#accordion").accordion({
        active: 0
    });

});


function calcular_edad(dia, mes, ano) {
    fecha_hoy = new Date();
    ahora_ano = fecha_hoy.getYear();
    ahora_mes = fecha_hoy.getMonth();
    ahora_dia = fecha_hoy.getDate();
    edad = (ahora_ano + 1900) - ano;

    if (ahora_mes < (mes - 1)) {
        edad--;
    }
    if (((mes - 1) == ahora_mes) && (ahora_dia < dia)) {
        edad--;
    }
    if (edad > 1900) {
        edad -= 1900;
    }

    return edad;
}

function solo_email(event) {
    var regex = new RegExp("^[@a-zA-z0-9._-]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}

function solo_letras(event) {
    var regex = new RegExp("^[a-zA-z ]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}


function solo_letras2(event) {
    var regex = new RegExp("^[a-zA-z0-9 ]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}

function solo_letras3(event) {
    var regex = new RegExp("^[a-zA-z0-9 ]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}


function solo_numeros(event) {
    var regex = new RegExp("^[0-9]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}



function solo_moneda(event) {
    var regex = new RegExp("^[0-9]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}







