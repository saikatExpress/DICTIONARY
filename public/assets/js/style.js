$(document).ready(function() {
    function adjustTickerSpeed() {
        var tickerWidth = $('.ticker-wrap').outerWidth();
        var containerWidth = $('.ticker').outerWidth();
        var speed = (tickerWidth / containerWidth) * 20; // Adjust based on desired speed
        $('.ticker-wrap').css('animation-duration', speed + 's');
    }

    adjustTickerSpeed();
    $(window).resize(adjustTickerSpeed); // Adjust speed on window resize
});
