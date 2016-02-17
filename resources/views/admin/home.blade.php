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
                <li><a href="http://127.0.0.1:8360/admin/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-image"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">期 刊</span>
                            <span class="info-box-number">2401</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-music"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">歌曲</span>
                            <span class="info-box-number">12</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">营业额</span>
                            <span class="info-box-number">0</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">用户</span>
                            <span class="info-box-number">1</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Main row -->
            <div class="row">

            </div><!-- /.row -->
        </section><!-- /.content -->
    </div>
@endsection