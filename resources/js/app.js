import './bootstrap';

$(document).ready(function () {
    $('#carouselExampleIndicators').carousel({
        interval: 4000,
        wrap: true,
        keyboard: true
    });


    /* 2 carousel */
    $('#carouselExampleIndicators2').carousel({
        interval: 5000,
        wrap: true,
        keyboard: true
    });
});
