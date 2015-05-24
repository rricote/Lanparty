jQuery(function($) {
    $('#taula-grups').dataTable();
    $('.borrar').click(function(){
        var tr = $(this).parent().parent().parent();
        var link = url;
        spinner.spin(spin);
        $.ajax({
            type: "delete",
            url: link + 'api/admin/grups/' + $(this).attr('id'),
            success: function(data) {
                if(data == 'CORRECTE'){
                    var unique_id = $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Correcte',
                        // (string | mandatory) the text inside the notification
                        text: 'El grup s\'ha borrat correctament',
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
                        text: 'Ha hagut algun problema al borrar el grup',
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
                    text: 'Ha hagut algun problema al borrar el grup',
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