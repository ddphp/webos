@extends('wx.base')

@section('head')
<script data-main="{{ asset('ctrl/wx/user/join.js') }}" src="{{ asset('js/require.js') }}"></script>
@stop

@section('body')
    <div class="page content__center margin-top__1em">
        <div class="page__hd">
            <p class="page__desc">
                <img src="{{ asset('static/images/wx/logo.jpg') }}" class="img-circle img-width__30p">
            </p>
            <h1 class="page__title margin-top__1em"> 会员卡绑定 </h1>
        </div>

        <div class="page__bd page__bd_spacing margin-top__1em">
            <a href="{{ route('wx.user.bind') }}" class="weui-btn weui-btn_primary">绑定已注册会员卡</a>
            <a href="{{ route('wx.user.regist') }}" class="weui-btn weui-btn_default">注册并绑定新会员卡</a>
        </div>

        <div class="page__ft j_bottom">
            @include('wx.inc.foot')
        </div>
    </div>
@stop