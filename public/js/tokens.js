$(".tokenizar").click(function (){
    var id = $(this).parent().parent().find('#id').text();
    var tr = $(this).parent().parent();
    creartoken(id, tr);
});

$("#inicialitzartots").click(function (){
    var tots = $("#tots").children('tr');
    if(tots.length) {
        for (var key in tots) {
            if (tots.hasOwnProperty(key)) {
                var obj = tots[key];
                if (typeof obj == 'object') {
                    var tr = obj;
                    var id = obj.children[0].innerText;
                    creartoken(id, tr);
                }
            }
        }
    }
    var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Correcte',
        // (string | mandatory) the text inside the notification
        text: 'Creació automatica de tokens finalitzada',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: '',
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'gritter-light'
    });
});

function creartoken(id, tr){
    var link = url;
    $.ajax({
        type: "post",
        url: link + 'api/admin/users/token',
        data: { id:id },
        success: function(data) {
            if(data == "guay"){
                tr.remove();
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Correcte',
                    // (string | mandatory) the text inside the notification
                    text: 'Token creat correctament',
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
                    text: 'Ha hagut algún error al crear el token',
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
                text: 'Ha hagut algún error al crear el token',
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