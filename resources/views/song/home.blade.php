@extends('app')
@section('content')
    <div id="player"></div>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-md-3" style="margin-bottom: 20px;">
                <label for="" class="control-label">语言</label>
                <select class="form-control" data-source="language">
                    <option value="0" selected>全部</option>
                @foreach( $songConfig['languages'] as $key => $val )
                    <option value="{{ $key }}" @if (isset($argGet['language']) && $key == $argGet['language'] ) selected @endif>{{ $val }}</option>
                @endforeach

                </select>
            </div>

            <div class="col-xs-6 col-md-3" style="margin-bottom: 20px;">
                <label for="" class="control-label">心情</label>
                <select class="form-control" data-source="mood">
                    <option value="0" selected>全部</option>
                @foreach( $songConfig['moods'] as $key => $val )
                    <option value="{{ $key }}" @if (isset($argGet['mood']) && $key == $argGet['mood'] ) selected @endif>{{ $val }}</option>
                @endforeach

                </select>
            </div>

            <div class="col-xs-6 col-md-3" style="margin-bottom: 20px;">
                <label for="" class="control-label">风格</label>
                <select class="form-control" data-source="style">
                    <option value="0" selected>全部</option>
                @foreach( $songConfig['styles'] as $key => $val )
                    <option value="{{ $key }}" @if (isset($argGet['style']) && $key == $argGet['style'] ) selected @endif>{{ $val }}</option>
                @endforeach

                </select>
            </div>

            <div class="col-xs-6 col-md-3" style="margin-bottom: 20px;">
                <label for="inputSeacher" class="control-label">关键词</label>
                <div class="row">
                    <div class="col-xs-8">
                        <input type="text" class="form-control" id="inputSeacher" value="">
                    </div>
                    <div class="col-xs-4 text-right">
                        <button class="btn btn-info" id="seacher">搜索</button>
                    </div>
                </div>
            </div>
        </div>


        <table class="table table-striped">
            @foreach( $songs as $song )
            <tr>
                <td><a href="/song/{{ $song->song_id }}">{{ $song->song_name }}</a></td>
                <td>{{ $song->song_author }}</td>
                <td>{{ $songConfig['languages'][$song->song_language] }}</td>
                <td>{{ $songConfig['moods'][$song->song_moods] }}</td>
                <td>{{ $songConfig['styles'][$song->song_style] }}</td>
            </tr>
            @endforeach
        </table>

        <div class="text-right">
            <nav class="pagination">
                {!! $songs->appends($argGet)->render() !!}
            </nav>
        </div>

    </div>
@endsection
@section('javascript')
    <script src="/static/js/song.js" type="text/javascript"></script>
@endsection