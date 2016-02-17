@extends('admin.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">音乐</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">音乐 添加</h3>
                        </div><!-- /.box-header -->
                        <form role="form" action="{{ URL("admin/song/{$song->song_id}") }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="put">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="title">名称</label>
                                            <input type="text" class="form-control" name="song_name" value="{{ $song->song_name }}" placeholder="名称">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">歌手</label>
                                            <input type="text" class="form-control" name="song_authors" value="{{ $song->song_authors }}" placeholder="歌手">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">地址</label>
                                            <input type="text" class="form-control" name="song_path" value="{{ $song->song_path }}" placeholder="歌手">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">封面</label>
                                            <input type="text" class="form-control" name="song_image" value="{{ $song->song_image }}" placeholder="歌手">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">心情</label>
                                            <select class="form-control select2" data-placeholder="Select a State" name="song_moods">
                                                @foreach( $songConfig['moods'] as $key => $val )
                                                <option value="{{ $key }}" @if ( $key == $song->song_moods) selected @endif >{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">语言</label>
                                            <select class="form-control select2" data-placeholder="Select a State" name="song_language">
                                                @foreach( $songConfig['languages'] as $key => $val )
                                                    <option value="{{ $key }}" @if ( $key == $song->song_language) selected @endif >{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">风格</label>
                                            <select class="form-control select2" data-placeholder="Select a State" name="song_style">
                                                @foreach( $songConfig['styles'] as $key => $val )
                                                    <option value="{{ $key }}" @if ( $key == $song->song_style) selected @endif >{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div>
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div>
@endsection