
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