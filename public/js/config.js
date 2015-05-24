jQuery(function($) {
    $('#taula-config').dataTable();
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
});