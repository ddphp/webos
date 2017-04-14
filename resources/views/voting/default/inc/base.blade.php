<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $activity->name }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/uikit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/uikit.gradient.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/layer/skin/default/layer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/voting/base.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/underscore.js') }}"></script>
@yield('head')
</head>
<body>
@yield('body')
<div id="menu">
    <ul>
        <li onclick="location.href = '{{ route('voting.index', [$activity->id]) }}'">
            <div class="menu_li">
                <img src="http://dongdasm.com/images/coin.png" width="10" />&nbsp;我要投票
            </div>
            <img class="line" src="http://dongdasm.com/images/line.png" width="1">
        </li>
        <li onclick="location.href = '{{ route('voting.rank', [$activity->id]) }}'">
            <div class="menu_li"><img src="http://dongdasm.com/images/coin.png" width="10" />&nbsp;最新排行</div>
            <img class="line" src="http://dongdasm.com/images/line.png" width="1" />
        </li>
        <li onclick="location.href = '{{ route('voting.detail', [$activity->id]) }}'">
            <div class="menu_li"><img src="http://dongdasm.com/images/coin.png" width="10" />&nbsp;活动介绍</div>
        </li>
    </ul>
</div>
<script src="{{ asset('vendor/uikit/js/uikit.min.js') }}"></script>
<script src="{{ asset('vendor/layer/layer.js') }}"></script>
<script src="{{ asset('js/vue.js') }}"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="{{ asset('js/require.js') }}"></script>
@yield('foot')
</body>
</html>