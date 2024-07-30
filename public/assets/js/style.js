$(document).ready(function() {
    function adjustTickerSpeed() {
        var tickerWidth = $('.ticker-wrap').outerWidth();
        var containerWidth = $('.ticker').outerWidth();
        var speed = (tickerWidth / containerWidth) * 20;
        $('.ticker-wrap').css('animation-duration', speed + 's');
    }

    adjustTickerSpeed();
    $(window).resize(adjustTickerSpeed);
});


