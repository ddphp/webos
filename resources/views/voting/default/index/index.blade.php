@extends('voting.default.inc.base')

@section('foot')
<script type="text/javascript" charset="utf-8">
wx.config({!! $js->config(['onMenuShareTimeline', 'onMenuShareAppMessage'], false) !!});
wx.ready(function(){
    wx.onMenuShareTimeline({
        title: '东大杯最萌风筝宝贝网络投票',
        link: 'http://dongdasm.com/voting/14', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: 'http://dongdasm.com/static/images/wx/logo.jpg', // 分享图标
        success: function () {
            $.get('http://dongdasm.com/voting/share_count/1');
        }
    });

    wx.onMenuShareAppMessage({
        title: '东大杯最萌风筝宝贝网络投票', // 分享标题
        desc: '东大杯最萌风筝宝贝网络投票开始了，快来选择您喜欢的DIY风筝，投票支持小朋友吧。', // 分享描述
        link: 'http://dongdasm.com/voting/14', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: 'http://dongdasm.com/static/images/wx/logo.jpg', // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
            $.get('http://dongdasm.com/voting/share_count/2');
        }
    });
});
</script>
<script src="{{ asset('ctrl/voting/index.js') }}"></script>
@stop

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('body')
<div id="voting-index" data-init="{{ $init }}">
    <img class="uk-margin-bottom" src="{{ $activity->banner }}">

    <div class="uk-grid uk-grid-collapse uk-grid-divider uk-margin-remove">
        <div class="uk-width-1-3 uk-text-center">
            参赛数<br><span v-text="count.players"></span>
        </div>
        <div class="uk-width-1-3 uk-text-center">
            总投票<br><span v-text="count.voters"></span>
        </div>
        <div class="uk-width-1-3 uk-text-center">
            访问量<br><span v-text="count.visitors"></span>
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-panel uk-panel-box-primary uk-text-center">
            <span>活动时间： {{ $activity->sdate }} 至 {{ $activity->edate }}</span>
        </div>
        <form class="uk-form uk-text-center uk-margin-top">
            <div class="uk-form-icon">
                <i class="uk-icon-search"></i>
                <input type="text" placeholder="输入选手编号或者名称查找" v-model.lazy.trim="query"
                       class="uk-form-width-large uk-form-blank">
            </div>
        </form>
    </div>

    <div class="uk-margin-small-left uk-margin-small-right uk-margin-large-bottom">
        <div class="uk-grid uk-grid-small">
            <template v-for="player in players">
                <div class="uk-width-1-2 uk-margin-bottom"{{-- v-on:click="showPlayer(player.number)"--}}>
                    <figure class="uk-overlay">
                        <img v-bind:src="player.thumb" width="" height="" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-left uk-padding-remove">
                            <div class="uk-margin-small-left uk-margin-small-top uk-text-danger">
                                <span class="uk-badge uk-badge-notification uk-badge-danger">@{{ player.number }}号</span>
                            </div>
                        </figcaption>
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom  uk-padding-remove">
                            <div class="uk-margin-small uk-margin-small-left uk-margin-small-right uk-clearfix">
                                <div class="uk-float-left">@{{ player.name }}</div>
                                <div class="uk-float-right">
                                    <small class="uk-text-bold uk-text-danger">
                                        @{{ player.vote }} 票
                                    </small>
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                    <a class="uk-button uk-button-success uk-text-bold uk-margin-small-top uk-button-small uk-width-1-1" :key="'p'+player.id"
                       v-on:click.stop="vote"
                       v-bind:data-id="player.id"
                    >
                        投票支持
                    </a>
                </div>
            </template>
        </div>
    </div>


</div>
@stop