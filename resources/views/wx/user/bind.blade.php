@extends('wx.base')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script data-main="{{ asset('ctrl/wx/user/bind.js') }}" src="{{ asset('js/require.js') }}"></script>
@stop

@section('body')
<div id="app" class="page">
    <div class="page__bd">
        <div class="weui-cells__title">
            <p class="text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 请填写信息</p>
        </div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell weui-cell_select weui-cell_select-before">
                <div class="weui-cell__hd">
                    <select class="weui-select" v-model="form.type">
                        <option value="custsjh">手机号</option>
                        <option value="custid">卡号</option>
                        <option value="custsfz">身份证</option>
                    </select>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number" placeholder="请输入号码" v-model="form.number"/>
                </div>
            </div>
            <div class="weui-cell weui-cell_vcode">
                <div class="weui-cell__hd">
                    <label class="weui-label">短信验证码</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入验证码" v-model="form.smsCode">
                </div>
                <div class="weui-cell__ft">
                    <button class="weui-vcode-btn" @click="fetchSmsCode('{{ route('wx.user.bind.fetch') }}')">
                        获取验证码
                    </button>
                </div>
            </div>
        </div>
        <div class="weui-cells__tips">
            <p class="text-info">
                <i class="fa fa-info-circle" aria-hidden="true"></i> 请先输入卡号、手机号或身份证号，然后点击获取验证码。
            </p>
        </div>

        <div class="weui-btn-area">
            <a class="weui-btn weui-btn_primary" :class="cls.submitBtn" href="javascript:" id="showTooltips"
               @click="submitForm('{{ route('wx.user.bind.submit') }}', '{{ route('wx.user.index') }}')"> 提 交 </a>
        </div>
    </div>
    <div class="page__ft">
        @include('wx.inc.foot')
    </div>

    <!--BEGIN toast-->
    <div id="toast" style="display: none;" :style="style.toast">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-icon-success-no-circle weui-icon_toast"></i>
            <p class="weui-toast__content">@{{ toast }}</p>
        </div>
    </div>
    <!--end toast-->

    <!-- loading toast -->
    <div id="loadingToast" style="display: none;" :style="style.loadingToast">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-loading weui-icon_toast"></i>
            <p class="weui-toast__content">数据加载中</p>
        </div>
    </div>

    <!--BEGIN dialog1-->
    <div class="dialog" id="dialog" style="display: none;" :style="style.dialog">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__hd"><strong class="weui-dialog__title">卡号信息</strong></div>
            <div class="weui-dialog__bd" style="text-align: left;">
                会员名：@{{ member.name }} <br>
                手机号：@{{ member.phone }} <br>
                身份证：@{{ member.personid }}
            </div>
            <div class="weui-dialog__ft">
                <a href="javascript:" class="weui-dialog__btn weui-dialog__btn_default" @click="resetCard">重填</a>
                <a href="javascript:" class="weui-dialog__btn weui-dialog__btn_primary"
                   @click="sendSmsCode('{{ route('wx.user.bind.fetch') }}')">确认</a>
            </div>
        </div>
    </div>
    <!--END dialog1-->
    <div class="weui-toptips weui-toptips_warn js_tooltips">@{{ tips }}</div>
</div>
@stop