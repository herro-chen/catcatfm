$(document).ready(function() {
    var D = $("#player"),
        E = $(".container .jp-play"),
        S = $(".container .jp-pause"),
        P = $(".container .order"),
        U = $(".container .random"),
        X = $(".container .loop"),
        F = $(".container .next"),
        J = $(".container .previous"),
        O = $(".container .list-name");
    title = $(".container .song-name"),
        songplay = $(".container .fa-play-circle");
    var T = 0;
    var A = new Array();
    var Q = 0;
    var B = 0;
    var V = {
        mp3: ""
    };
    var K = new Array();
    G();
    O.each(function() {
        Q = K.push($(this).data("song"))
    });
    function N() {
        var Y = Math.floor(Math.random() * Q);
        return Y
    }
    function I(Z, Y) {
        if (Y == "next") {
            if (Z == Q - 1) {
                Z = 0
            } else {
                Z = parseInt(Z) + 1
            }
        }
        if (Y == "previous") {
            if (Z == 0) {
                Z = Q - 1
            } else {
                Z = parseInt(Z) - 1
            }
        }
        return Z
    }
    function M(Y) {
        return Y
    }
    function C(a, Y) {
        var Z;
        switch (T) {
            case 0:
                Z = I(a, Y);
                break;
            case 1:
                Z = N();
                break;
            case 2:
                Z = M(a);
                break;
            default:
                Z = 0;
                break
        }
        B = Z;
        $.ajax({
            url: Home + "song/path/" + K[Z],
            type: "GET",
            async: false,
            dataType: "json",
            success: function(b) {
                title.html(b.name);
                V = {
                    mp3: b.path
                }
            }
        })
    }
    function W(Y) {
        var Z = 0;
        for (Z in K) {
            if (Y == K[Z]) {
                return Z
            }
        }
        return Z
    }
    D.jPlayer({
        ready: function() {
            $(this).jPlayer("setMedia", V).jPlayer("play")
        },
        play: function() {
            O.parent().removeClass("playing");
            O.parent().removeClass("pausing");
            var Y = parseInt(B) + 1;
            $("#song-" + Y).parent().addClass("playing")
        },
        pause: function() {
            var Y = parseInt(B) + 1;
            $("#song-" + Y).parent().removeClass("playing");
            $("#song-" + Y).parent().addClass("pausing")
        },
        ended: function() {
            C(B, "next");
            $(this).jPlayer("setMedia", V).jPlayer("play");
            $.ajax({
                url: Home + "index.php?c=users&m=counts",
                type: "GET",
                success: function(Y) {}
            })
        },
        swfPath: "static/jplayer",
        supplied: "mp3",
        cssSelectorAncestor: ".music"
    });
    O.click(function() {
        var Y = $(this).data("song");
        B = W(Y);
        var Z = T;
        T = 2;
        C(B, "next");
        D.jPlayer("setMedia", V).jPlayer("play");
        T = Z;
        return false
    });
    P.click(function() {
        T = 1;
        G();
        return false
    });
    U.click(function() {
        T = 2;
        G();
        return false
    });
    X.click(function() {
        T = 0;
        G();
        return false
    });
    function G() {
        P.hide();
        U.hide();
        X.hide();
        switch (T) {
            case 0:
                P.show();
                break;
            case 1:
                U.show();
                break;
            case 2:
                X.show();
                break;
            default:
                break
        }
    }
    J.click(function() {
        C(B, "previous");
        D.jPlayer("setMedia", V).jPlayer("play");
        return false
    });
    F.click(function() {
        C(B, "next");
        D.jPlayer("setMedia", V).jPlayer("play");
        return false
    });
    songplay.click(function() {
        $(this).parent().prev().children().click()
    });
    var R = T;
    T = 2;
    C(B, "next");
    T = R;
    var H = $("#before"),
        L = $("#after");
    if (H.length > 0) {
        Mousetrap.bind("left",
            function() {
                location.href = H.attr("href")
            })
    }
    if (L.length > 0) {
        Mousetrap.bind("right",
            function() {
                location.href = L.attr("href")
            })
    }
});