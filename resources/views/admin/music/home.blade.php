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
                            <h3 class="box-title">期刊 列表</h3>
                            <div class="pull-right">
                                <a class="btn btn-xs btn-social-icon btn-instagram" href="/admin/music/create"><i class="fa fa-plus"></i></a>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>标题</th>
                                    <th>缩略图</th>
                                    <th>心情</th>
                                    <th>创建时间</th>
                                    <th style="width: 10%">Label</th>
                                </tr>
                                @foreach( $musics as $music)
                                <tr>
                                    <td>{{ $music->music_id }}.</td>
                                    <td>{{ $music->music_name }}</td>
                                    <td>{{ $music->music_image }}</td>
                                    <td>{{ $music->music_moods }}</td>
                                    <td>{{ $music->music_create }}</td>
                                    <td>
                                        <a class="badge bg-green" href="{{ URL("admin/music/{$music->music_id}/edit") }}">修改</a>
                                        <form action="{{ URL("admin/music/{$music->music_id}") }}" method="POST" style="display: inline;">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn badge bg-red">删除</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <nav class="pagination pagination-sm no-margin pull-right">
                                {!! $musics->render() !!}
                            </nav>
                        </div>
                    </div><!-- /.box -->
                </div>
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div>
@endsection