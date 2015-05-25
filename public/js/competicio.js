$('.countdowntorneig').countdown(countdowntimetorneig, function(event) {
    var $this = $(this).html(event.strftime(''
    + '<div><span class="countdown-number">%w</span> <span class="countdown-title">Setmanes</span></div> '
    + '<div><span class="countdown-number">%d</span> <span class="countdown-title">dies</span></div> '
    + '<div><span class="countdown-number">%H</span> <span class="countdown-title">hores</span></div> '
    + '<div><span class="countdown-number">%M</span> <span class="countdown-title">minuts</span></div> '
    + '<div><span class="countdown-number">%S</span> <span class="countdown-title">segons</span></div>'));
});