@extends('app')
@section('content')
    <div id="player"></div>
    <div class="container single" style="margin-top: 60px;">
        <div class="row">
            <div class="col-sm-offset-2 col-md-offset-3 col-xs-12 col-sm-8 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <div class="singlecover">
                            <img src="{{ $song->song_image }}" class="img-circle">
                        </div>
                        <h4 class="song-name">{{ $song->song_name }}</h4>
                        <span class="song-author">{{ $song->song_author }}</span>

                        <div style="margin-top:40px; margin-bottom: 30px;">
                            <i data-song="{{ $song->song_id }}" class="fa fa-2x fa-heart @if ($is_love) text-danger @endif" style="margin-right:20px;"></i>
                            <i class="fa fa-2x fa-play jp-play"></i>
                            <i class="fa fa-2x fa-pause jp-pause"></i>
                            <a href="index.php?c=song&m=download&song=191" target="_black"><i class="fa fa-2x fa-download" title="下载到本地" style="margin-left:20px;"></i></a>
                        </div>

                        <div class="m-seek-bar jp-seek-bar" style="width: 100%; margin-bottom: 20px;">
                            <div class="m-play-bar jp-play-bar" style="width:0; overflow: hidden;"></div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <span class="jp-current-time">00:00</span> / <span class="jp-duration">00:00</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="/static/jplayer/jquery.jplayer.min.js" type="text/javascript"></script>
    <script src="/static/js/single.js" type="text/javascript"></script>
    <script src="/static/js/heart.js" type="text/javascript"></script>
@endsection