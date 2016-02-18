$(document).ready(function() {
    var B = $(".bgimage");
    var A = $(".avatar");
    B.click(function() {
        B.each(function() {
            $(this).removeClass("active")
        });
        $(this).addClass("active");
        var C = $(this).attr("soucre");
        $('#bgimage').val(C);
    });
    A.click(function() {
        A.each(function() {
            $(this).removeClass("active")
        });
        $(this).addClass("active");
        var C = $(this).attr("src");
        $('#avatar').val(C);
    })
});