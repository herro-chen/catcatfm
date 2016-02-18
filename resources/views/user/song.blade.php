@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <img src="{{ $user->bgimage }}" class="img-responsive">
            </div>
            <div class="col-xs-12 text-center" style="margin-top: -50px;">
                <img src="{{ $user->avatar }}" class="img-circle user-image" width="100">
            </div>

            <div class="col-xs-12 text-center" style="margin-top: 20px;">
                <h4><span class="user-name">{{ $user->name }}</span></h4>
            </div>

            <div class="col-xs-12" style="margin-top: 40px;">
                <div class="row">
                    <div class="col-xs-4 col-md-2">
                        <a href="{{ URL("/user/{$user->name}") }}">
                            <h5><strong><span class="">期 刊</span></strong></h5>
                        </a>
                    </div>
                    <div class="col-xs-4 col-md-2">
                        <a href="{{ URL("/user/{$user->name}/song") }}">
                            <h5><strong><span class="user-love">单 曲</span></strong></h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <table class="table table-striped">
                    <tbody>
                    @foreach($love_songs as $song)
                        <tr>
                            <td><a href="{{ URL("/song/{$song->song_id}") }}">{{ $song->song_name }}</a></td>
                            <td>{{ $song->song_authors }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                {!! $love_songs->render() !!}
            </div>
        </div>
    </div>
@endsection