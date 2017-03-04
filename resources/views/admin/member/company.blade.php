@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/member/company.js') }}"></script>
@stop

@section('profile')
<div id="admin-member-company">
    <h1 class="uk-h2">公司信息</h1>
    <form class="uk-form uk-form-stacked uk-margin-top" data-init="{{ $form }}"
          v-on:submit.prevent="submit('{{ route('admin.member.company_store') }}')"
    >
        <ukc-input id="name" d-name="公司名称" :d-err="err.name" d-width="large" v-model="form.name"></ukc-input>
        <ukc-input id="store" d-name="店铺名称" :d-err="err.store" v-model="form.store"></ukc-input>
        <ukc-input id="logo" d-name="公司Logo" :d-err="err.logo" d-width="large" v-model="form.logo"></ukc-input>
        <ukc-input id="axis" d-name="地理坐标（纬度,经度）" :d-err="err.axis" v-model="form.axis" placeholder="纬度,经度"></ukc-input>
        <ukc-input id="address" d-name="地址" :d-err="err.address" d-width="large" v-model="form.address"></ukc-input>
        <ukc-input id="tel" d-name="联系电话" :d-err="err.tel" v-model="form.tel"></ukc-input>
        <div class="uk-form-row">
            <button class="uk-button">保存</button>
        </div>
    </form>
</div>
@stop