$(document).ready(function() {
    var B = $("select"),
        A = $("#inputSeacher"),
        C = $("#seacher");
    B.change(function() {
        var D = $(this).data("source");
        var F = $(this).val();
        var E = Home + "song?";
        B.each(function() {
            var G = $(this).data("source");
            var H = $(this).val();
            if (H != 0) {
                E += "&" + G + "=" + H
            }
        });
        location.href = E
    });
    C.click(function() {
        var D = A.val();
        if ($.trim(D)) {
            location.href = Home + "song?keyword=" + D
        }
    })
});