$(document).ready(function() {
    var A = $("#upload_form"),
        C = $("#upload_botton"),
        E = $(".cover"),
        F = $(".fileUpload span"),
        D = $("#picture"),
        B = $("#pic-source");
    A.ajaxForm(function(G) {
        E.removeClass("show");
        if (G == "FALSE") {
            F.html("失 败")
        } else {
            F.html("成 功")
        }
        if (D.length > 0) {
            D.attr("src", G);
            B.attr("value", G);
            F.html("上传图片")
        } else {
            setTimeout(function() {
                location.reload()
            }, 2000)
        }
    });
    C.change(function() {
        A.submit();
        E.addClass("show");
        F.html("上传中")
    })
});