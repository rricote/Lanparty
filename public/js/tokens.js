$(".tokenizar").click(function (){
    var id = $(this).parent().parent().find('#id').text();
    var tr = $(this).parent().parent();
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
        }
    });
});

$("#inicialitzartots").click(function (){
    var tots = $("#tots").children('tr');
    console.log(tots);

});
