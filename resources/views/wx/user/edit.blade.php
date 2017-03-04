@extends('wx.base')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/require.js') }}" data-main="{{ asset('ctrl/wx/user/edit.js') }}"></script>
@stop

@section('body')
<div id="app" class="page" data-form="{{ json_encode($form) }}">
    <div class="page__bd">
        <div class="weui-cells__title">姓名</div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入姓名" v-model="form.name"/>
                </div>
            </div>
        </div>

        <div class="weui-cells__title">Email</div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" placeholder="请输入Email" v-model="form.email"/>
                </div>
            </div>
        </div>

        <div class="weui-cells__title">居住地</div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" placeholder="请输入居住地址" rows="3" v-model="form.address"></textarea>
                    <div class="weui-textarea-counter"><span v-text="textLength">0</span>/40</div>
                </div>
            </div>
        </div>

        <div class="weui-btn-area">
            <a class="weui-btn weui-btn_primary" href="javascript:"
               id="showTooltips" @click="submit('{{ route('wx.user.edit') }}')">确定</a>
        </div>
    </div>
    <div class="page__ft">
        @include('wx.inc.foot')
    </div>

    @include('wx.inc.toast')
</div>
@stop