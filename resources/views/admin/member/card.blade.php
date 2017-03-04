@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/member/card.js') }}"></script>
@stop

@section('profile')
    <div id="admin-member-card">
        <h1 class="uk-h2">会员卡设置</h1>
        <form class="uk-form uk-form-stacked uk-margin-top" data-init="{{ $form }}"
              v-on:submit.prevent="submit('{{ route('admin.member.card_store') }}')"
        >
            <ukc-input id="prefix" d-name="卡前缀" :d-err="err.prefix" v-model="form.prefix"></ukc-input>
            <ukc-number id="figure" min="1" max="20" d-name="卡位数（含前缀）" :d-err="err.figure" v-model="form.figure"></ukc-number>
            <ukc-number id="ycJf" min="1" max="200" d-name="注册赠送积分" :d-err="err.ycJf" v-model="form.ycJf"></ukc-number>
            <div class="uk-form-row">
                <button class="uk-button">保存</button>
            </div>
        </form>
    </div>
@stop