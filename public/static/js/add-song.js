$(document).ready(function() {
    var E = $("#inputSong"),
        I = $("tbody"),
        B = $("input[name='song']"),
        J = $(".add-music-song"),
        H = $(".add-music-song table"),
        D = $("#album"),
        F = $("#playlist"),
        C = $("#yun");
    E.bind("input propertychange", function() {
        var L = $(this).val();
        var K = Home + "admin/song/search?str=" + L;
        $.ajax({
            type: "GET",
            url: K,
            dataType: "json",
            success: function(M) {
                if (M.status != "FALSE") {
                    I.html("");
                    $.each(M, function(O, N) {
                        I.append("<tr><td>" + N.song_name + "</td><td>" + N.song_authors + "</td><td><i class='fa fa-plus' data-song='" + N.song_id + "' data-name='" + N.song_name + "' data-author='" + N.song_authors + "'></i></td></tr>")
                    })
                }
            }
        })
    });
    $(document).on({
        click: function() {
            var N = $(this).data("song");
            var L = B.attr("value");
            if (L == "") {
                B.attr("value", N)
            } else {
                var M = L.split("|");
                var K;
                for (K in M) {
                    if (M[K] == N) {
                        return false
                    }
                }
                B.attr("value", L + "|" + N)
            }
            J.removeClass("hide");
            H.append("<tr><td><strong>" + $(this).data("name") + "</strong></td><td><span class='text-right'>" + $(this).data("author") + " </span></td><td><i class='fa fa-times'></i></td></tr>");
            $(this).parents("tr").remove()
        }
    }, ".fa-plus");
    C.click(function() {
        var M = D.val();
        var K = F.val();
        var L;
        if (M != "") {
            L = Home + "admin/song/album/" + M
        }
        if (K != "") {
            L = Home + "admin/song/playlist/" + K
        }
        if (! L) return;
        $.ajax({
            type: "GET",
            url: L,
            dataType: "json",
            success: function(N) {
                if (N.status != "FALSE") {
                    I.html("");
                    $.each(N, function(P, O) {
                        I.append("<tr><td>" + O.song_name + "</td><td>" + O.song_authors + "</td><td><i class='fa fa-plus' data-song='" + O.song_id + "' data-name='" + O.song_name + "' data-author='" + O.song_authors + "'></i></td></tr>")
                    })
                }
            }
        })
    });
});