$( ".canvi" ).change(function () {
    var link = url;
    var id = $(this).attr('id');
    var check = ($(this).prop('checked'))? 1: 2;
    $.ajax({
        type: "post",
        url: link + 'api/competition/change/' + id,
        data: { state: check },
        success: function(data) {
            if(data == 1){
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Correcte',
                    // (string | mandatory) the text inside the notification
                    text: 'Ha sigut inscrit correctament a la competició',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
            } else if(data == 0) {
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Correcte',
                    // (string | mandatory) the text inside the notification
                    text: 'Ha sigut desinscrit correctament a la competició',
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
                    text: data,
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
            }
            if(rec){
                setTimeout(function(){
                    location.reload();
                }, 1500);
            }

             //*/
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
        }
    });
});

$( ".entrar" ).change(function () {
    var link = url;
    var id = $(this).attr('id');
    var check = ($(this).prop('checked'))? 1: 2;
    $.ajax({
        type: "post",
        url: link + 'api/notification/change/' + id,
        data: { state: check },
        success: function(data) {
            if(data == 1){
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Correcte',
                    // (string | mandatory) the text inside the notification
                    text: 'La petició ha sigut enviada correctament',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: false,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'gritter-light'
                });
            } else if(data == 0) {
                var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Correcte',
                    // (string | mandatory) the text inside the notification
                    text: 'La petició ha sigut cancel·lada correctament',
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
                    text: data,
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
                text: 'Ha hagut algun error al actualitzar la casella',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'gritter-light'
            });
        }
    });
});

if ($('.countdowntorneig').length > 0) {
    $('.countdowntorneig').countdown(countdowntimetorneig, function(event) {
        var $this = $(this).html(event.strftime(''
        + '<div><span class="countdown-number">%w</span> <span class="countdown-title">Setmanes</span></div> '
        + '<div><span class="countdown-number">%d</span> <span class="countdown-title">dies</span></div> '
        + '<div><span class="countdown-number">%H</span> <span class="countdown-title">hores</span></div> '
        + '<div><span class="countdown-number">%M</span> <span class="countdown-title">minuts</span></div> '
        + '<div><span class="countdown-number">%S</span> <span class="countdown-title">segons</span></div>'));
    });
}