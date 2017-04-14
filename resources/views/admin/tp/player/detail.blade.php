@extends('admin.inc.profile')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('vendor/editor/css/wangEditor.min.css') }}">
    @include('inc.csrf')
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/tp/player/detail.js') }}"></script>
@stop

@section('profile')
    <div id="admin-player-detail">
        <h1 class="uk-h3">选手详情 - {{ $player->name }}_{{ $player->number }}</h1>
        <form class="uk-form uk-form-stacked uk-margin-top uk-margin-bottom">
            <div  class="uk-form-row">
                <div id="edit" style="display: none;">
                    {!! $content->detail !!}
                </div>
            </div>
            <div class="uk-form-row">
                <a id="submit" class="uk-button">保存</a>
            </div>
        </form>
    </div>
@stop