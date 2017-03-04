@extends('wx.base')

@section('head')
<style>
    .field {
        width: 4.2em;
        display: inline-block;
        text-align: justify;
        padding-right: 10px;
        font-weight: bold;
    }
</style>
<script>
    wx.config({!! $js !!});
</script>
<script src="{{ asset('js/require.js') }}" data-main="{{ asset('ctrl/wx/user/detail.js') }}"></script>
@stop

@section('body')
<div id="app" class="page">
    <div class="page__hd margin-top__1em" style="text-align: center;">
        <p class="page__desc">
            <img class="img-width__30p img-circle" src="{{ $member['wx']['headimgurl'] }}">
        </p>
        <h1 class="page__title">{{ $member['wx']['nickname'] }}</h1>
    </div>
    <div class="page__bd">
        <div class="weui-cells__title">基本信息</div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <span class="field">会员名</span>
                    <span>{{ $member['ehd']['name'] }}</span>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>
                        <span class="field">卡号</span>
                        <span>{{ $member['ehd']['cardid'] }}</span>
                    </p>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <span class="field">手机号</span>
                    <span>{{ $member['ehd']['phone'] }}</span>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <span class="field">身份证号</span>
                    <span>{{ $member['ehd']['personid'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="{{ route('wx.user.edit') }}">
            <div class="weui-cell__bd">
                <p><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 修改个人信息</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
    </div>

    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="javascript:" @click="sureUnbind">
            <div class="weui-cell__bd">
                <p><i class="fa fa-chain-broken" aria-hidden="true"></i> 取消会员卡绑定</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
    </div>

    <div class="page__ft">
        @include('wx.inc.foot')
    </div>

    @include('wx.inc.toast')

    <!--BEGIN dialog1-->
    <div class="dialog" id="dialog" style="display: none;" v-show="show.dialog">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__hd"><strong class="weui-dialog__title">确认提示</strong></div>
            <div class="weui-dialog__bd">
                您确定要取消会员卡绑定？
            </div>
            <div class="weui-dialog__ft">
                <a href="javascript:" class="weui-dialog__btn weui-dialog__btn_default" @click="noUnbind">不了</a>
                <a href="javascript:" class="weui-dialog__btn weui-dialog__btn_primary"
                   @click="yesUnbind('{{ route('wx.user.unbind') }}')">是的</a>
            </div>
        </div>
    </div>
    <!--END dialog1-->
</div>
@stop