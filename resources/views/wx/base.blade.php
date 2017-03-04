<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $head['title'] or config('app.company.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/weui.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    @yield('head')
</head>
<body>
@yield('body')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('vendor/layer/layer.js') }}"></script>
<script src="{{ asset('js/underscore.js') }}"></script>
@yield('foot')
</body>
</html>