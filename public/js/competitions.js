jQuery(function($) {
    $('#taula-competitions').dataTable();
    $('.borrar').click(function(){
        if($(this).attr('title'))
            var tr = $(this).parent().parent().parent().parent().parent().parent();
        else
            var tr = $(this).parent().parent().parent();
        var link = url;
        spinner.spin(spin);
        $.ajax({
            type: "delete",
            url: link + 'api/admin/competitions/' + $(this).attr('id'),
            success: function(data) {
                if(data == 'CORRECTE'){
                    var unique_id = $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Correcte',
                        // (string | mandatory) the text inside the notification
                        text: 'La competició s\'ha borrat correctament',
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
                        text: 'Ha hagut algun problema al borrar la competició',
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
                    text: 'Ha hagut algun problema al borrar la competició',
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
});

$('#datepicker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
    $(this).prev().focus();
});

$('#timepicker').timepicker({
    minuteStep: 1,
    showSeconds: true,
    showMeridian: false
}).next().on(ace.click_event, function(){
    $(this).prev().focus();
});

$('#input-image').ace_file_input({
    no_file: 'Cap arxiu ...',
    btn_choose: 'Elegeix',
    btn_change: 'Canvia',
    droppable: false,
    onchange: null,
    thumbnail: false //| true | large
    //whitelist:'gif|png|jpg|jpeg'
    //blacklist:'exe|php'
    //onchange:''
    //
});

$('#input-imatge').ace_file_input({
    no_file: 'Cap arxiu ...',
    btn_choose: 'Elegeix',
    btn_change: 'Canvia',
    droppable: false,
    onchange: null,
    thumbnail: false //| true | large
    //whitelist:'gif|png|jpg|jpeg'
    //blacklist:'exe|php'
    //onchange:''
    //
});
