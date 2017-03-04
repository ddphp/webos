@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/member/verify.js') }}"></script>
@stop

@section('profile')
    <div id="admin-member-verify">
        <h1 class="uk-h2">验证码设置</h1>
        <form class="uk-form uk-form-stacked uk-margin-top" data-init="{{ $form }}"
              v-on:submit.prevent="submit('{{ route('admin.member.verify_store') }}')"
        >
            <ukc-input id="bind" d-name="会员绑定模板" d-width="large" :d-err="err.bind" v-model="form.bind"></ukc-input>
            <ukc-input id="regist" d-name="会员注册模板" d-width="large" :d-err="err.regist" v-model="form.regist"></ukc-input>
            <ukc-number id="length" min="4" max="8" d-name="验证码长度" :d-err="err.length" v-model="form.length"></ukc-number>
            <ukc-number id="interval" min="0" max="3600" d-name="重复获取间隔（秒）" :d-err="err.interval" v-model="form.interval"></ukc-number>
            <ukc-number id="validity" min="1" max="720" d-name="验证码有效期（分钟）" :d-err="err.validity" v-model="form.validity"></ukc-number>
            <ukc-number id="fetch" min="1" max="10" d-name="可获取次数/天" :d-err="err.fetch" v-model="form.fetch"></ukc-number>
            <ukc-number id="verify" min="1" max="10" d-name="可验证次数/条" :d-err="err.verify" v-model="form.verify"></ukc-number>
            <div class="uk-form-row">
                <button class="uk-button">保存</button>
            </div>
        </form>
    </div>
@stop