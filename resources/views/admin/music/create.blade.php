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
                <li class="active">期刊</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">期刊 添加</h3>
                        </div><!-- /.box-header -->
                        <form class="form-horizontal" role="form" action="{{ URL('admin/music') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-8">
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
                                                <label for="inputTitle" class="col-xs-2 control-label">图 片</label>
                                                <div class="col-xs-8">
                                                    <input type="hidden" name="music_image" id="pic-source" value="/static/image/base-004.jpg" />
                                                    <img src="/static/image/base-004.jpg" id="picture" class="img-responsive" alt="标题">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputTitle" class="col-xs-2 control-label">标 题</label>
                                                <div class="col-xs-8">
                                                    <input type="text" class="form-control" name="music_name" value="" placeholder="" autocomplete="off" maxlength="32" autofocus="true" required="true">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputMoods" class="col-xs-2 control-label">标 签</label>
                                                <div class="col-xs-8">
                                                    <select class="form-control select2" multiple="multiple" data-placeholder="Select a State" name="music_moods">
                                                        @foreach( $songConfig['styles'] as $key => $val )
                                                            <option value="{{ $val }}" >{{ $val }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputText" class="col-xs-2 control-label">描 述</label>
                                                <div class="col-xs-8">
                                                    <textarea class="form-control" rows="4" name="music_text"></textarea>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-xs-2 control-label">网易云音乐</label>
                                                <div class="col-xs-4">
                                                    <input type="text" class="form-control" id="album" placeholder="网易云音乐专辑编号" autocomplete="off" maxlength="32">
                                                </div>
                                                <div class="col-xs-4">
                                                    <input type="text" class="form-control" id="playlist" placeholder="网易云音乐歌单编号" autocomplete="off" maxlength="32">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-xs-offset-2 col-xs-10">
                                                    <button class="btn btn-default" id="yun" type="button">添 加</button>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputSong" class="col-xs-2 control-label">歌 曲</label>
                                                <div class="col-xs-8">
                                                    <input type="text" class="hide" name="song" value="">
                                                    <div class="add-music-song songshow hide">
                                                        <table class="table">
                                                        </table>
                                                    </div>
                                                    <span class="help-block"></span>
                                                    <input type="text" class="form-control" id="inputSong"  placeholder="歌曲名">
                                                    <span class="help-block"></span>
                                                    <div class="scrollspy-example">
                                                        <table class="table">
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
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

@section('javascript')
    <script src="/static/js/add-song.js"></script>
@endsection