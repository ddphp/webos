@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/mp/base.js') }}"></script>
@stop

@section('profile')
<div id="app-admin-mp-base">
    <h3>微信公众号基本配置</h3>
    <form id="form" class="uk-form uk-form-stacked uk-margin-top" data-init="{{ $config }}"
          v-on:submit.prevent="submit('{{ route('admin.mp.base.submit') }}')"
    >
        <ukc-input id="app_id" d-name="AppID" :d-err="err.app_id" v-model="form.app_id"></ukc-input>
        <ukc-input id="secret" d-name="AppSecret" :d-err="err.secret" d-width="large" v-model="form.secret"></ukc-input>
        <ukc-input id="token" d-name="Token" :d-err="err.token" d-width="large" v-model="form.token"></ukc-input>
        <ukc-input id="aes_key" d-name="EncodingAESKey" :d-err="err.aes_key" d-width="large" v-model="form.aes_key"></ukc-input>
        <div class="uk-form-row">
            <button class="uk-button">保存</button>
        </div>
    </form>
</div>
@endsection