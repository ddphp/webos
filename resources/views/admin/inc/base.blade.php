<!doctype html>
<html lang="zh-CN" class="{{ $head['html']['class'] or '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/uikit.gradient.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/layer/skin/default/layer.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/base.css') }}">
    @yield('head')
    <title>{{ $head['title'] or '东大微信公众号管理系统' }}</title>
</head>
<body class="{{ $head['body']['class'] or '' }}">
@yield('body')

@yield('foot')
</body>
</html>