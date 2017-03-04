@extends('wx.base')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/require.js') }}" data-main="{{ asset('ctrl/wx/user/regist.js') }}"></script>
@stop

@section('body')
<div id="app" class="page">
    <div class="page__bd">
        <div class="weui-cells__title">
            <p class="text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 请填写以下资料</p>
        </div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell weui-cell_vcode">
                <div class="weui-cell__hd">
                    <label class="weui-label">手机号</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="tel" placeholder="请输入手机号" v-model="form.mobilephone">
                </div>
                <div class="weui-cell__ft">
                    <button class="weui-vcode-btn" @click="getSmsCode('{{ route('wx.user.regist.smscode') }}')">获取验证码</button>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入短信验证码" v-model="form.smscode"/>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入姓名" v-model="form.name"/>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">身份证号</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入身份证号" v-model="form.personid"/>
                </div>
            </div>
        </div>
        <div class="weui-cells__tips">
            <p class="text-info">
                <i class="fa fa-info-circle" aria-hidden="true"></i> 身份证是保障您会员权益的重要凭证。
            </p>
        </div>

        <div class="weui-btn-area">
            <a class="weui-btn weui-btn_primary" :class="cls.submitBtn" href="javascript:" id="showTooltips"
               @click="submitRegist('{{ route('wx.user.regist.submit') }}', '{{ route('wx.user.index') }}')"> 确定 </a>
        </div>
    </div>

    <div class="page__ft">
        @include('wx.inc.foot')
    </div>

    @include('wx.inc.toast')
</div>
@stop