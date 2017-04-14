@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/components/form-file.min.css') }}">
    <style>
        .uk-form-label {
            text-align: right;
        }
    </style>
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/tp/player/save.js') }}"></script>
@stop

@section('profile')
    <div id="admin-tp-save">
        <h1 class="uk-h3">新建活动</h1>
        <form id="form" class="uk-form uk-form-horizontal" enctype="multipart/form-data" v-on:submit.prevent="submit"
              data-player="{{ json_encode($player) }}"
        >
            <div class="uk-form-row">
                <label class="uk-form-label" for="number">编号</label>
                <div class="uk-form-controls">
                    <input id="number" class="uk-form-width-small" type="text" v-model="player.number">
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="name">名称</label>
                <div class="uk-form-controls">
                    <input id="name" class="" type="text" v-model="player.name">
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="thumb">展示图</label>
                <div class="uk-form-controls">
                    <img class="uk-margin" v-bind:src="player.thumb" alt="">
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
                <div class="uk-form-controls">
                    <button class="uk-button">保存</button>
                </div>
            </div>
        </form>
    </div>
@stop