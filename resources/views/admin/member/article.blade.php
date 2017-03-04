@extends('admin.inc.profile')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('vendor/editor/css/wangEditor.min.css') }}">
    @include('inc.csrf')
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/member/article.js') }}"></script>
@stop

@section('profile')
<div id="admin-member-article">
    <h1 class="uk-h3">{{ $article->name }}</h1>
    <form class="uk-form uk-form-stacked uk-margin-top uk-margin-bottom"
          data-id="{{ $article->id }}"
          data-uri="{{ $url }}"
          data-upload-img = "{{ route('admin.img.upload') }}"
    >
        <div  class="uk-form-row">
            <div id="edit" style="display: none;">
                {!! $article->content !!}
            </div>
        </div>
        <div class="uk-form-row">
            {{ csrf_field() }}
            <a id="submit" class="uk-button">保存</a>
        </div>
    </form>
</div>
@stop