$(document).ready(function() {
    var C = $("#player"),
        D = $(".fa-heart");
    var A = D.data("song");
    function B() {
        $.ajax({
            url: Home + "song/path/" + A,
            type: "GET",
            async: false,
            dataType: "json",
            success: function(E) {
                stream = {
                    mp3: E.path
                }
            }
        })
    }
    B();
    C.jPlayer({
        ready: function() {
            $(this).jPlayer("setMedia", stream).jPlayer("play")
        },
        ended: function(E) {
            $(this).jPlayer("setMedia", stream).jPlayer("play");
            $.ajax({
                url: Home + "index.php?c=users&m=counts",
                type: "GET",
                success: function(F) {}
            })
        },
        swfPath: "static/jplayer",
        supplied: "mp3",
        cssSelectorAncestor: ".single"
    })
});