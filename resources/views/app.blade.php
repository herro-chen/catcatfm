<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="icon" href="" />
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/font-awesome.min.css" rel="stylesheet">
    <link href="/static/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL('/') }}">猫猫音乐电台</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL('/music') }}">期 刊</a></li>
                    <li><a href="{{ URL('/song') }}">发 现</a></li>
                    <li><a href="{{ URL('/fm') }}">电 台</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                    <li><a href="{{ URL('/login') }}">登 录</a></li>
                    <li><a href="{{ URL('/register') }}">注 册</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL('/user') }}">个人主页</a></li>
                            <li><a href="{{ URL('/user/setting') }}">账号设置</a></li>
                            <li><a href="{{ URL('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>退出</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <div class="footer">
        <div class="container">
            <a href="{{ URL('/') }}" target="_black">猫猫 FM</a>
        </div>
    </div>

    <i class="fa fa-spinner fa-spin fa-4x hide"></i>
    <img src="/static/image/top.gif" id="back-to-top" alt="back to top">
</body>
<script>
    var Home = '{{ URL('/') }}/';
</script>
<script src="/static/js/jquery-2.1.3.min.js"></script>
<script src="/static/js/bootstrap.min.js"></script>
@yield('javascript')
</html>