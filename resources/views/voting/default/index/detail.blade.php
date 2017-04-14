@extends('voting.default.inc.base')

@section('body')
    <div class="uk-margin-top uk-margin-small-left uk-margin-small-right uk-margin-large-bottom">
        {!! $activity->activityContent->detail !!}
    </div>
@stop