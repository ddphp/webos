@extends('admin.inc.base')

@section('head')
<link rel="stylesheet" href="{{ asset('vendor/layer/skin/default/layer.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('foot')
<script src="{{ asset('ctrl/admin/login.js') }}"></script>
@stop

@section('body')
    <div class="uk-vertical-align uk-text-center uk-height-1-1">
        <div class="uk-vertical-align-middle" style="width: 360px;">

            <h2>东大微信公众号管理系统</h2>

            <form id="admin-login-form" class="uk-panel uk-panel-box uk-form"
                  @submit.prevent="submit('{{ route('admin.login.store') }}', '{{ route('admin.profile').'?t=menu&i=2' }}')">
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" type="text" placeholder="用户名" v-model="account.user">
                </div>
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" type="password" placeholder="密码" v-model="account.pass">
                </div>
                <div class="uk-form-row">
                    <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">登录</button>
                </div>
                <div class="uk-form-row uk-text-small">
                    <a class="uk-float-right uk-link uk-link-muted" href="#">忘记密码?</a>
                </div>
            </form>

        </div>
    </div>
@stop