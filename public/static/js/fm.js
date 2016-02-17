$(document).ready(function() {
    var G = $("#player"),
        J = $(".jp-play"),
        B = $(".jp-pause"),
        A = $(".jp-next"),
        D = $(".song-name"),
        F = $(".song-author"),
        K = $(".fa-heart"),
        C = $(".fa-download"),
        E = $("#image");
    var H = {
        mp3: ""
    };
    function I() {
        $.ajax({
            url: Home + "/song/random",
            type: "GET",
            async: false,
            dataType: "json",
            success: function(L) {
                H = {
                    mp3: L.path
                };
                E.attr("src", L.image);
                D.text(L.name);
                F.text(L.author);
                K.data("song", L.song);
                C.parent().attr("href", Home + "index.php?c=song&m=download&song=" + L.song);
                if (L.is_love == true) {
                    K.addClass("text-danger")
                }
            }
        })
    }
    I();
    G.jPlayer({
        ready: function() {
            $(this).jPlayer("setMedia", H).jPlayer("play")
        },
        ended: function(L) {
            I();
            $(this).jPlayer("setMedia", H).jPlayer("play");
            $.ajax({
                url: Home + "index.php?c=users&m=counts",
                type: "GET",
                success: function(M) {}
            })
        },
        swfPath: "static/jplayer",
        supplied: "mp3",
        cssSelectorAncestor: ".fm"
    });
    A.click(function(L) {
        K.removeClass("text-danger");
        I();
        G.jPlayer("setMedia", H).jPlayer("play");
        return false
    })
});