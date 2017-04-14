@extends('voting.default.inc.base')

@section('foot')
<script src="{{ asset('ctrl/voting/rank.js') }}"></script>
@stop

@section('body')
<div id="voting-rank" style="margin-bottom: 70px;" data-actid="{{ $actid }}">
    <h1 class="uk-text-center uk-margin-top uk-text-warning">排行榜</h1>

    <ul class="uk-list uk-list-line uk-list-striped">
        <li v-for="(rank,key) in ranks">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div>
                    <span class="uk-text-bold uk-margin-small-left"> <span v-text="key + 1"></span> </span>
                    <img class="uk-border-circle uk-margin-small-left" style="width: 35px;" v-bind:src="rank.thumb">
                    <span class="uk-margin-small-left"><span v-text="rank.name"></span></span>
                </div>
                <div class="uk-margin-small-right"> <span v-text="rank.vote + ' 票'"></span> </div>
            </div>
        </li>
    </ul>
</div>
@stop