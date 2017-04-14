@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/components/form-file.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/components/form-select.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/components/datepicker.css') }}">
    <style>
        .uk-form-label {
            text-align: right;
        }
    </style>
@stop

@section('foot')
    @parent
    <script src="{{ asset('vendor/uikit/js/uikit.js') }}"></script>
    <script src="{{ asset('vendor/uikit/js/components/form-select.js') }}"></script>
    <script src="{{ asset('vendor/uikit/js/components/datepicker.js') }}"></script>
    <script src="{{ asset('ctrl/admin/tp/save.js') }}"></script>
@stop

@section('profile')
    <div id="admin-tp-save">
        <h1 class="uk-h3">新建活动</h1>
        <form class="uk-form uk-form-horizontal uk-margin" data-form="{{ json_encode($form) }}" v-on:submit.prevent="submit">
            <ukc-input id="name" d-name="活动名称" v-model="form.name"></ukc-input>
            {{--<ukc-input id="banner" d-name="活动Banner" d-width="large" v-model="form.banner"></ukc-input>--}}
            <div class="uk-form-row">
                <label class="uk-form-label" for="活动Banner">展示图</label>
                <div class="uk-form-controls">
                    <img class="uk-margin" v-bind:src="form.banner" alt="">
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <div class="uk-form-file">
                        <button class="uk-button uk-icon-cloud-upload uk-button-link"> 上传图片</button>
                        <input id="thumb" type="file" name="image">
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="sdate">开始日期</label>
                <div class="uk-form-controls">
                    <div class="uk-form-icon">
                        <i class="uk-icon-calendar"></i>
                        <input id="sdate" class="uk-form-small uk-form-width-small" type="text"
                               v-model="form.sdate"
                               data-uk-datepicker="{format:'YYYY-MM-DD',i18n:{months:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],weekdays:['日','一','二','三','四','五','六']}}">
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="edate">结束日期</label>
                <div class="uk-form-controls">
                    <div class="uk-form-icon">
                        <i class="uk-icon-calendar"></i>
                        <input id="edate" class="uk-form-small uk-form-width-small" type="text"
                               v-model="form.edate"
                               data-uk-datepicker="{format:'YYYY-MM-DD',i18n:{months:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],weekdays:['日','一','二','三','四','五','六']}}">
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="">投票类型</label>
                <div class="uk-form-controls">
                    <select v-model="form.type">
                        <option value="1">每天</option>
                        <option value="0">一次</option>
                    </select>
                </div>
            </div>
            <ukc-number id="tot" d-name="投票总次数" min="1" d-width="small" v-model="form.tot"></ukc-number>
            <ukc-number id="num" d-name="投票选手数" min="1" d-width="small" v-model="form.num"></ukc-number>
            <ukc-number id="vote" d-name="投票次数/选手" min="1" d-width="small" v-model="form.vote"></ukc-number>
            <div class="uk-form-row">
                <label class="uk-form-label" for="">投票模板</label>
                <div class="uk-form-controls">
                    <select v-model="form.skin">
                        <option value="default">default</option>
                    </select>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <button class="uk-button" type="button" v-on:click="submit">保存</button>
                </div>
            </div>
        </form>
    </div>
@stop