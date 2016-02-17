$(document).ready(function() {
    var C = $(".fa-heart"),
        A = $(".heart-music"),
        B = $(".heart-yue");
    C.click(function() {
        var D = $(this).data("song");
        var E = $(this);
        $.ajax({
            url: Home + "user/love/0/" + D,
            type: "GET",
            success: function(F) {
                switch (F) {
                    case "0":
                        location.href = Home + "login";
                        break;
                    case "1":
                        E.removeClass("text-danger");
                        break;
                    case "2":
                        E.addClass("text-danger");
                        break;
                    default:
                        break
                }
            }
        })
    });
    A.click(function() {
        var D = $(this).data("music");
        var F = $(this);
        var E = parseInt($(this).next().html());
        $.ajax({
            url: Home + "user/love/1/" + D,
            type: "GET",
            success: function(G) {
                switch (G) {
                    case "0":
                        location.href = Home + "login";
                        break;
                    case "1":
                        F.removeClass("text-danger");
                        F.next().html(E - 1);
                        break;
                    case "2":
                        F.addClass("text-danger");
                        F.next().html(E + 1);
                        break;
                    default:
                        break
                }
            }
        })
    });
    B.click(function() {
        var E = $(this).data("yue");
        var F = $(this);
        var D = parseInt($(this).next().html());
        $.ajax({
            url: Home + "index.php?c=users&m=heart&id=" + E + "&soucre=2",
            type: "GET",
            success: function(G) {
                switch (G) {
                    case "0":
                        location.href = Home + "index.php?c=login";
                        break;
                    case "1":
                        F.removeClass("text-danger");
                        F.next().html(D - 1);
                        break;
                    case "2":
                        F.addClass("text-danger");
                        F.next().html(D + 1);
                        break;
                    default:
                        break
                }
            }
        })
    })
});