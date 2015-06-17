jQuery(function($) {
	var oTable1 = $('#taula-usuaris').dataTable( {
        dom: 'Rlfrtip',
        "aoColumns": [
		{ "bSortable": false },
		    null,
            null,
            null,
            null,
            null,
		{ "bSortable": false }
	    ]
    } );
//colvis, colorder

    $('.input-mask-dni').mask('*9999999-a');

	$('table th input:checkbox').on('click' , function(){
	    var that = this;
	    $(this).closest('table').find('tr > td:first-child input:checkbox')
		    .each(function(){
		        this.checked = that.checked;
		        $(this).closest('tr').toggleClass('selected');
		    });

	});


	$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
	function tooltip_placement(context, source) {
	    var $source = $(source);
	    var $parent = $source.closest('table')
	    var off1 = $parent.offset();
	    var w1 = $parent.width();

	    var off2 = $source.offset();
	    var w2 = $source.width();

	    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
	    return 'left';
	}
});

$( ".canvi" ).change(function () {
    var value;
    if($(this).parent().find('#elec').text() == 1){
        $(this).parent().find('#elec').html(2);
        value = 2;
    } else {
        $(this).parent().find('#elec').html(1);
        value = 1;
    }
    var link = url;
    var id = $(this).attr('id');
    $.ajax({
        type: "put",
        url: link + 'api/admin/validacio/' + id,
        data: { state:value },
        success: function(data) {
            if(data == "guay"){
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Correcte',
                    // (string | mandatory) the text inside the notification
                    text: 'S\'ha actualitzat correctament',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
            } else {
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Error',
                    // (string | mandatory) the text inside the notification
                    text: 'Ha hagut algun error al actualitzar la casella',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
                if(value==2){
                    $(this).prop( "checked", false );
                    $(this).parent().find('#elec').html(1);
                }else{
                    $(this).prop( "checked", true );
                    $(this).parent().find('#elec').html(2);
                }
            }
        },
        error: function(){
            var unique_id = $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Error',
                // (string | mandatory) the text inside the notification
                text: 'Ha hagut algun error al actualitzar la casella',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'gritter-light'
            });
            if(value==2){
                $(this).prop( "checked", false );
                $(this).parent().find('#elec').html(1);
            }else{
                $(this).prop( "checked", true );
                $(this).parent().find('#elec').html(2);
            }
        }
    });
});

$('.borrar').click(function(){
    if($(this).attr('title'))
        var tr = $(this).parent().parent().parent().parent().parent().parent();
    else
        var tr = $(this).parent().parent().parent();
    var link = url;
    spinner.spin(spin);
    $.ajax({
        type: "delete",
        url: link + 'api/admin/users/' + $(this).attr('id'),
        success: function(data) {
            if(data == 'CORRECTE'){
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Correcte',
                    // (string | mandatory) the text inside the notification
                    text: 'L\'usuari s\'ha borrat correctament',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
                tr.remove();
            } else {
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Error',
                    // (string | mandatory) the text inside the notification
                    text: 'Ha hagut algun problema al borrar l\'usuari',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
            }
            spinner.stop();
        },
        error: function(){
            var unique_id = $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Error',
                // (string | mandatory) the text inside the notification
                text: 'Ha hagut algun problema al borrar l\'usuari',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'gritter-light'
            });
            spinner.stop();
        }
    });
});

$("#afegiremail").bind("change paste keyup", function (){
    var link = url;
    var value = $("#afegiremail").val();
    $.ajax({
        type: "post",
        url: link + 'api/admin/users/validacio/email',
        data: { email:value },
        success: function(data) {
            if(data == 0){
                $("#afegiremail").parent().parent().removeClass("has-error").addClass("has-success");
                $("#afegiremail").parent().find('#icono').html('<i class="icon-check">');
            } else {
                $("#afegiremail").parent().parent().removeClass("has-success").addClass("has-error");
                $("#afegiremail").parent().find('#icono').html('<i class="icon-remove">');
            }
        }
    });
});

function letraDni(dni) {
    var lockup = 'TRWAGMYFPDXBNJZSQVHLCKE';
    return lockup.charAt(dni % 23);
}

$("#afegirusuari").click(function (){
    var pas = true;
    if(!$("#afegiremail").val())
        pas = false;
    if(!$("#afegirpassword").val())
        pas = false;
    if(!$("#afegirpassword2").val())
        pas = false;
    if(!$("#afegirnom").val())
        pas = false;
    if(!$("#afegirsurname1").val())
        pas = false;
    if(!$("#afegirsurname2").val())
        pas = false;
    if(!$("#afegirusername").val())
        pas = false;
    if(pas) {
        var pasa = false;
        if ($("#afegirdni").val()) {
            var dni = $("#afegirdni").val().split("-");
            if(dni[0].charAt(0).toUpperCase() == 'X')
                dni[0] = dni[0].substr(0, 0) + '0' + dni[0].substr(0 + '0'.length)
            if(dni[0].charAt(0).toUpperCase() == 'Y')
                dni[0] = dni[0].substr(0, 0) + '1' + dni[0].substr(0 + '1'.length)
            if(dni[0].charAt(0).toUpperCase() == 'X')
                dni[0] = dni[0].substr(0, 0) + '2' + dni[0].substr(0 + '2'.length)
            if(letraDni(dni[0]) == dni[1].toUpperCase())
                pasa = true;
        } else {
            pasa = true;
        }
        if (!pasa){
            var unique_id = $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Error',
                // (string | mandatory) the text inside the notification
                text: 'DNI incorrecte',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'gritter-light'
            });
        } else {
            if ($("#afegirpassword").val() != $("#afegirpassword2").val())
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Error',
                    // (string | mandatory) the text inside the notification
                    text: 'Les contrasenyes no coincideixen',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
            else {
                expr = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                if (!expr.test($("#afegiremail").val()))
                    var unique_id = $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Error',
                        // (string | mandatory) the text inside the notification
                        text: 'El format del email és incorrecte',
                        // (bool | optional) if you want it to fade out on its own or just sit there
                        sticky: false,
                        // (int | optional) the time you want it to be alive for before fading out
                        time: '',
                        // (string | optional) the class name you want to apply to that specific message
                        class_name: 'gritter-light'
                    });
                else {
                    var link = url;
                    var value = $("#afegiremail").val();
                    $.ajax({
                        type: "post",
                        url: link + 'api/admin/users/validacio/email',
                        data: { email:value },
                        success: function(data) {
                            if(data == 0){
                                introduirdadesafegir();
                            } else {
                                $("#afegiremail").parent().parent().removeClass("has-success").addClass("has-error");
                                $("#afegiremail").parent().find('#icono').html('<i class="icon-remove">');
                                var unique_id = $.gritter.add({
                                    // (string | mandatory) the heading of the notification
                                    title: 'Error',
                                    // (string | mandatory) the text inside the notification
                                    text: 'El camp email ja s\'esta usant',
                                    // (bool | optional) if you want it to fade out on its own or just sit there
                                    sticky: false,
                                    // (int | optional) the time you want it to be alive for before fading out
                                    time: '',
                                    // (string | optional) the class name you want to apply to that specific message
                                    class_name: 'gritter-light'
                                });
                            }
                        }
                    });
                }
            }
        }
    }else{
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Error',
            // (string | mandatory) the text inside the notification
            text: 'Hi ha algun camp buit',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'gritter-light'
        });
    }
});

function introduirdadesafegir(){
    var link = url;
    var afegiremail = $("#afegiremail").val();
    var afegirpassword = $("#afegirpassword").val();
    var afegirnom = $("#afegirnom").val();
    var afegirsurname1 = $("#afegirsurname1").val();
    var afegirsurname2 = $("#afegirsurname2").val();
    var afegirusername = $("#afegirusername").val();
    if($("#afegirdni").val() == "")
        var afegirdni = (new Date).getTime().toString().substring(5, 13);
    else
        var afegirdni = $("#afegirdni").val();
    $.ajax({
        type: "post",
        url: link + 'api/admin/users',
        data: { email:afegiremail, dni:afegirdni, username:afegirusername, nom:afegirnom, surname1:afegirsurname1, surname2:afegirsurname2, password:afegirpassword },
        success: function(data) {
            if(data == 'CORRECTE'){
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Correcte',
                    // (string | mandatory) the text inside the notification
                    text: 'L\'usuari s\'ha creat correctament',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
                $("#afegiremail").val("");
                $("#afegirpassword").val("");
                $("#afegirpassword2").val("");
                $("#afegirnom").val("");
                $("#afegirsurname1").val("");
                $("#afegirsurname2").val("");
                $("#afegirusername").val("");
                $("#afegirdni").val("");
            } else {
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Error',
                    // (string | mandatory) the text inside the notification
                    text: 'Ha hagut algun problema al crear l\'usuari',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
            }
        },
        error: function(){
            var unique_id = $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Error',
                // (string | mandatory) the text inside the notification
                text: 'Ha hagut algun problema al crear l\'usuari',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'gritter-light'
            });
        }
    });
}
