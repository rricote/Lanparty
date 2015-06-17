$( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 24,
    values: [ 8, 20 ],
    slide: function( event, ui ) {
        var val = ui.values[$(ui.handle).index()-1]+"";
        console.log(ui.values);
        console.log(ui.values[0]);
        console.log(ui.values[1]);
        $("#inici").attr('value', ui.values[0]);
        $("#final").attr('value', ui.values[1]);
        if(! ui.handle.firstChild ) {
            $(ui.handle).append("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>");
        }
        $(ui.handle.firstChild).show().children().eq(1).text(val);
    }
}).find('a').on('blur', function(){
    $(this.firstChild).hide();
});

$('#timepicker').timepicker({
    minuteStep: 1,
    showSeconds: true,
    showMeridian: false
}).next().on(ace.click_event, function(){
    $(this).prev().focus();
});

$('#datepicker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
    $(this).prev().focus();
});