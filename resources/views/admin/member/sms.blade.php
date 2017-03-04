@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/member/sms.js') }}"></script>
@stop

@section('profile')
    <div id="admin-member-sms">
        <h1 class="uk-h2">短信配置</h1>
        <form class="uk-form uk-form-stacked uk-margin-top" data-init="{{ $form }}"
              v-on:submit.prevent="submit('{{ route('admin.member.sms_store') }}')"
        >
            <ukc-input id="user" d-name="账号" :d-err="err.user" v-model="form.user"></ukc-input>
            <ukc-input id="pass" d-name="密码" :d-err="err.pass" v-model="form.pass"></ukc-input>
            <ukc-input id="sign" d-name="签名" :d-err="err.sign" v-model="form.sign"></ukc-input>
            <div class="uk-form-row">
                <button class="uk-button">保存</button>
            </div>
        </form>
    </div>
@stop