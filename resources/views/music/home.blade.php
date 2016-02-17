@extends('app')
@section('content')
    <div id="player"></div>
    <div class="container">
        <div class="row">
            @foreach( $musics as $music )
            <div class="col-xs-6 col-sm-4 col-md-3 top-15">
                <div class="user-back">
                    <a href="/music/{{ $music->music_id }}">
                        <img src="{{ $music->music_image }}" class="img-responsive">
                    </a>
                    <a href="/music/{{ $music->music_id }}">
                        <p class="text-center top-15">{{ $music->music_name }}</p>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-right">
            <nav class="pagination">
                {!! $musics->render() !!}
            </nav>
        </div>
    </div>
@endsection