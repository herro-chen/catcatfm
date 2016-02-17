@extends('app')
@section('content')
    <div id="player"></div>
    <div class="container" style="">
        <div class="row">
            <div class="col-xs-12">
                <!-- 封面 -->
                <div class="m-panel">
                    <h3>{{ $music->music_name }}</h3>
                    <p class="m-info">
                        <i class="fa fa-tags first"></i> {{ $music->music_moods }}
                        <i class="fa fa-microphone"></i>
                        <a href="" target="_black">{{ $music->user->name }}</a>
                        <i class="fa fa-clock-o"></i> {{ $music->music_create }}
                        <i class="fa fa-heart-o heart-music cursor @if ($is_love) text-danger @endif" data-music="{{ $music->music_id }}"></i>
                        <span>{{ $loves }}</span>
                    </p>
                    <img src="{{ URL::to($music->music_image) }}" class="img-responsive m-pic" alt="{{ $music->music_image }}">
                    <p class="m-text">{{ $music->music_ }}</p>
                    <ul class="ds-recent-visitors" data-num-items="10"></ul>
                </div>

                <!-- 分页 -->
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-xs-6">
                        @if( $previous)
                        <a href="/music/{{ $previous }}"><i class="fa fa-3x fa-arrow-circle-o-left"></i></a>
                        @endif
                    </div>
                    <div class="col-xs-6 text-right">
                        @if( $next)
                        <a href="/music/{{ $next }}"><i class="fa fa-3x fa-arrow-circle-o-right"></i></a>
                        @endif
                    </div>
                </div>

                <!-- 歌单 -->
                <div class="m-panel songshow">
                    <ul>
                    @foreach( $music->songs as $k => $songs )
                        <li>
                            <span class="">
                              {{ $k+1 }} <strong data-song="{{ $songs->song_id  }}" class="list-name" id="song-{{ $k+1 }}">{{ $songs->song_name  }}</strong>
                            </span>
                            <p class="text-right">
                                {{ $songs->song_authors  }}
                                <a href="/song/{{ $songs->song_id  }}"><i class="fa fa-info-circle" title="查看歌曲详情"></i></a>
                                <a href="" target="_black"><i class="fa fa-download" title="下载到本地"></i></a>
                                <i data-song="{{ $songs->song_id  }}" class="fa fa-heart " title="加入我的收藏"></i>
                                <i class="fa fa-play-circle"></i>
                            </p>
                        </li>
                    @endforeach
                    </ul>
                </div>

            </div>

        </div>
    </div>
    <!-- 播放器 -->
    <div id="player-wrapper" class="music">
        <div class="m-seek-bar jp-seek-bar" style="width: 100%;">
            <div class="m-play-bar jp-play-bar" style="width:0; overflow: hidden;"></div>
        </div>
        <div class="container">
            <div class="row" style="padding-top: 20px;">
                <div class="col-xs-4 col-md-4">
                    <i class="fa fa-random random" title="随机"></i>
                    <i class="fa fa-bars order" title="顺序"></i>
                    <i class="fa fa-refresh loop" title="循环"></i>
                    <span class="song-name">歌曲名称</span>
                </div>
                <div class="col-xs-4 col-md-6">
                    <span class="jp-current-time">00:00</span> / <span class="jp-duration">00:00</span>
                </div>
                <div class="col-xs-4 col-md-2">
                    <i class="fa fa-backward previous"></i>
                    <i class="fa fa-play jp-play"></i>
                    <i class="fa fa-pause jp-pause"></i>
                    <i class="fa fa-forward next"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="/static/jplayer/jquery.jplayer.min.js" type="text/javascript"></script>
    <script src="/static/js/mousetrap.min.js" type="text/javascript"></script>
    <script src="/static/js/player.js" type="text/javascript"></script>
    <script src="/static/js/heart.js" type="text/javascript"></script>
    <script src="/static/js/top.js" type="text/javascript"></script>
@endsection