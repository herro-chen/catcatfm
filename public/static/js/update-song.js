$(document).ready(function() {
    var A = $(".label");
    A.click(function() {
        var B = $(this).data("value");
        $(this).siblings("input").attr("value", B);
        $(this).siblings(".label-info").addClass("label-default");
        $(this).siblings(".label-info").removeClass("label-info");
        $(this).addClass("label-info");
        $(this).removeClass("label-default")
    })
});