@extends('app')
@section('content')
    <div class="container">
        <h4>设置个人信息</h4>
        <div class="row">
            <div class="col-xs-4 col-md-2">
                <a href="{{ URL('/user/setting') }}">
                    <h5><strong><span>头 像</span></strong></h5>
                </a>
            </div>
            <div class="col-xs-4 col-md-2">
                <a href="{{ URL('/user/password') }}">
                    <h5><strong><span class="user-love">密 码</span></strong></h5>
                </a>
            </div>
        </div>
        <hr>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ URL('/user/password') }}" class="password" action="" method="post" role="form">
            <div class="form-group">
                <label for="inputHave">旧密码</label>
                <input type="password" class="form-control" name="oldpassword" placeholder="" maxlength="18" autocomplete="off" autofocus="true" required="true">
            </div>
            <div class="form-group">
                <label for="inputPassword">新密码</label>
                <input type="password" class="form-control" name="password" placeholder="" maxlength="18" autocomplete="off" required="true">
            </div>
            <div class="form-group">
                <label for="inputPasscof">确认新密码</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="" maxlength="18" autocomplete="off" required="true">
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default">保 存</button>
        </form>
    </div>
@endsection

@section('javascript')
    <script src="/static/js/user.js" type="text/javascript"></script>
@endsection