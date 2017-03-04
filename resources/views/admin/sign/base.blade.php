@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/sign/base.js') }}"></script>
@stop

@section('profile')
    <div id="admin-sign-base" class="uk-margin-top">
        <h1 class="uk-h2">签到基本设置</h1>
        <form class="uk-form uk-form-stacked uk-margin-top" data-init="{{ $form }}"
              v-on:submit.prevent="submit('{{ route('admin.sign.base_store') }}')"
        >
            <ukc-number id="point" min="0" max="100" d-name="赠送积分" :d-err="err.point" v-model="form.point"></ukc-number>
            <div class="uk-form-row">
                <button class="uk-button">保存</button>
            </div>
        </form>
    </div>
@stop