$(document).ready(function() {
    var A = $("#back-to-top");
    $(window).scroll(function() {
        if ($(window).scrollTop() > 100) {
            A.fadeIn(1500)
        } else {
            A.fadeOut(1500)
        }
    });
    A.click(function() {
        $("body").animate({
                scrollTop: 0
            },
            1000);
        return false
    })
});