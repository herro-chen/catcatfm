@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <img src="/static/image/user/1.jpg" class="img-responsive">
            </div>
            <div class="col-xs-12 text-center" style="margin-top: -50px;">
                <img src="/static/image/user/Fruit-1.png" class="img-circle user-image" width="100">
            </div>

            <div class="col-xs-12 text-center" style="margin-top: 20px;">
                <h4><span class="user-name">{{ $user->name }}</span></h4>
                <p>累计听歌：20</p>
                <p>注册时间：{{ $user->created_at }}</p>
                <p>最后登录：{{ $user->updated_at }}</p>
            </div>

            <div class="col-xs-12" style="margin-top: 40px;">
                <div class="row">
                    <div class="col-xs-4 col-md-2">
                        <a href="/user/{{ $user->name }}">
                            <h5><strong><span class="user-love">期 刊</span></strong></h5>
                        </a>
                    </div>
                    <div class="col-xs-4 col-md-2">
                        <a href="/user/{{ $user->name }}/song">
                            <h5><strong><span class="">单 曲</span></strong></h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 top-15">
                @foreach($love_musics as $music)
                <div class="user-back">
                    <a href="/music/{{ $music->music_id }}">
                        <img src="{{ $music->music_image }}" class="img-responsive">
                    </a>
                    <a href="/music/{{ $music->music_id }}">
                        <p class="text-center top-15">{{ $music->music_name }}</p>
                    </a>
                    <p class="text-center hide"><i class="fa fa-trash"></i></p>
                </div>
                @endforeach
            </div>
            <div class="text-right">
                {!! $love_musics->render() !!}
            </div>
        </div>
    </div>
@endsection