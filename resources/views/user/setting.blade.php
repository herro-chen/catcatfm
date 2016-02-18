@extends('app')
@section('content')
    <div class="container">
        <h4>设置个人信息</h4>
        <div class="row">
            <div class="col-xs-4 col-md-2">
                <a href="{{ URL('/user/setting') }}">
                    <h5><strong><span class="user-love">头 像</span></strong></h5>
                </a>
            </div>
            <div class="col-xs-4 col-md-2">
                <a href="{{ URL('/user/password') }}">
                    <h5><strong><span>密 码</span></strong></h5>
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
        <div class="row user">
            <p style="padding-left:15px;">个人头像</p>
            @foreach( $userConfig['avatars'] as $key => $val)
            <div class="col-xs-2 col-md-1" style="margin-top: 10px;">
                <img src="{{ $val }}" class="avatar cursor @if ( $val == $user->avatar) active @endif" data-avatar="{{ $key }}">
            </div>
            @endforeach
        </div>
        <hr>
        <div class="row user">
            <p style="padding-left:15px;">个人主页背景图</p>
            @foreach( $userConfig['bgimage_ths'] as $key => $val)
            <div class="col-xs-6 col-md-3" style="margin-top: 10px;">
                <img src="{{ $val }}" soucre="{{ $userConfig['bgimages'][$key] }}" class="bgimage cursor @if ( $userConfig['bgimages'][$key] == $user->bgimage) active @endif" data-bgimage="{{ $key }}">
            </div>
            @endforeach
        </div>
        <hr>
        <form action="{{ URL('/user/setting') }}" method="post" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="avatar" id="avatar" value="{{ $user->avatar }}">
            <input type="hidden" name="bgimage" id="bgimage" value="{{ $user->bgimage }}">
            <button type="submit" class="btn btn-default">保 存</button>
        </form>
    </div>
@endsection

@section('javascript')
    <script src="/static/js/user.js" type="text/javascript"></script>
@endsection