jQuery(function($) {
	var oTable1 = $('#taula-usuaris').dataTable( {
	    "aoColumns": [
		{ "bSortable": false },
		    null,
            null,
            null,
            null,
            null,
		{ "bSortable": false }
	    ] } );


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
    console.log($(this).attr('id'));
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
        data: { estat:value },
        success: function(data) {
            if(data == "guay"){
                console.log(data);
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
                console.log(data);
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
        }
    });
    console.log($(this).parent().find('#elec').text());
});
function comprovarEmail($tipus){
    console.log($("#afegirEmail").val());
    var link = url;
    var value = $("#afegirEmail").val();
    var resultat;
    $.ajax({
        type: "post",
        url: link + 'api/admin/users/validacio/email',
        data: { email:value },
        success: function(data) {
            if(data == 0){
                console.log('bien');
            } else {
                console.log('mal');
            }
            if($tipus == 1)
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
    });
}

$("#afegirEmail").bind("change paste keyup", function (){
    comprovarEmail(0);
});