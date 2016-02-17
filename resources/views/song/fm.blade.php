@extends('app')
@section('content')
    <div id="player"></div>
    <div class="container fm" style="margin-top: 60px;">
        <div class="row">
            <div class="col-sm-offset-2 col-md-offset-3 col-xs-12 col-sm-8 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <div class="singlecover">
                            <img src="" class="img-circle" id="image">
                        </div>
                        <h4 class="song-name"></h4>
                        <span class="song-author"></span>

                        <div style="margin-top:40px; margin-bottom: 30px;">
                            <i class="fa fa-2x fa-heart" style="margin-right:20px;"></i>
                            <a href="#" target="_black"><i class="fa fa-2x fa-download" title="下载到本地" style="margin-right:20px;"></i></a>
                            <i class="fa fa-2x fa-play jp-play"></i>
                            <i class="fa fa-2x fa-pause jp-pause"></i>
                            <i class="fa fa-2x fa-fast-forward jp-next" style="margin-left:20px;"></i>
                        </div>

                        <div class="m-seek-bar jp-seek-bar" style="width: 100%; margin-bottom: 20px;">
                            <div class="m-play-bar jp-play-bar" style="width:0; overflow: hidden;"></div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <span class="jp-current-time">00:00</span> / <span class="jp-duration">00:00</span>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <span class="label label-default">红心电台</span>
                            <span class="label label-default">随机电台</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="/static/jplayer/jquery.jplayer.min.js" type="text/javascript"></script>
    <script src="/static/js/fm.js" type="text/javascript"></script>
    <script src="/static/js/heart.js" type="text/javascript"></script>
@endsection