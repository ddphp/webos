@extends('wx.base')

@section('head')
<script>
    wx.config({!! $js->config(['openLocation', 'getLocation']) !!});
    wx.ready(function () { });
</script>
@stop

@section('foot')
@if (!$signState)
<script>
    var sign = true;
    $("#wx-user-sign").click(function(){
        if (sign) {
            var load = layer.load(0);
            $.get('{{ route('wx.user.sign') }}')
                .done(function (res) {
                    if (res.cod == 0) {
                        sign = false;
                        _.each(res.dat, function (val, key) {
                            $("#jf-"+key).text(val ? val : '0');
                        });
                        $("#wx-user-sign-badge").html('<span>今日已签到</span>');
                    }
                    layer.msg(res.msg);
                })
                .fail(function () {
                    layer.msg('未知错误');
                })
                .always(function () {
                    layer.close(load);
                });
        }
    });
</script>
@endif
@stop

@section('body')

<div class="page">
    <div class="page__hd page__bd_spacing" style="margin-top: 3px;">
        <img src="{{ route('img.card', ['id' => $member['cardid'], 'type' => $member['ehd']['cardtid'], 'color' => 'fdf6e3']) }}" style="width: 100%;">
    </div>
    <div class="page__bd page__bd_spacing">
        <div class="weui-flex" style="text-align: center; border: double 1px grey; padding: 10px;">
            <div class="weui-flex__item" style="border-right: dashed 1px grey;">
                <div class="placeholder">累计积分 <br> <span id="jf-xsjf">{{ $member['ehd']['xsjf'] ?: 0 }}</span></div>
            </div>
            <div class="weui-flex__item" style="border-right: dashed 1px grey;">
                <div class="placeholder">已用积分 <br> <span id="jf-fljf">{{ $member['ehd']['fljf'] ?: 0 }}</span></div>
            </div>
            <div class="weui-flex__item">
                <div class="placeholder">可用积分 <br> <span id="jf-totjf">{{ $member['ehd']['totjf'] ?: 0 }}</span></div>
            </div>
        </div>
    </div>

    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="{{ route('wx.user.detail') }}">
            <div class="weui-cell__bd">
                <p><i class="fa fa-user fa-lg" aria-hidden="true"></i> {{ $member['ehd']['name'] }}</p>
            </div>
            <div class="weui-cell__ft">
                <span style="vertical-align:middle; font-size: 17px;">详细信息</span>
                {{--<span class="weui-badge weui-badge_dot" style="margin-left: 5px;margin-right: 5px;"></span>--}}
            </div>
        </a>
        <a id="wx-user-sign" class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <p>
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> 签到赚积分
                </p>
            </div>
            <div id="wx-user-sign-badge" class="weui-cell__ft">
                @if ($signState)
                <span>今日已签到</span>
                @else
                <span class="weui-badge">未签到</span>
                @endif
            </div>
        </a>
    </div>

    <div class="weui-panel">
        <div class="weui-panel__hd">会员卡档案</div>
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_small-appmsg">
                <div class="weui-cells">
                    <a class="weui-cell weui-cell_access" href="{{ route('wx.user.article', [1]) }}">
                        <div class="weui-cell__hd"><img src="{{ asset('static/images/wx/zc.jpg') }}" alt="" style="width:20px;margin-right:5px;display:block"></div>
                        <div class="weui-cell__bd weui-cell_primary">
                            <p>会员章程</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                    <a class="weui-cell weui-cell_access" href="{{ route('wx.user.article', [2]) }}">
                        <div class="weui-cell__hd"><img src="{{ asset('static/images/wx/md.jpg') }}" alt="" style="width:20px;margin-right:5px;display:block"></div>
                        <div class="weui-cell__bd weui-cell_primary">
                            <p>适用门店</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="weui-panel">
        <div class="weui-panel__hd">公司联系方式</div>
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_small-appmsg">
                <div class="weui-cells">
                    <a class="weui-cell weui-cell_access" href="javascript:wx.openLocation(JSON.parse('{{ $map }}'));">
                        <div class="weui-cell__hd"><img src="{{ asset('static/images/wx/wz.jpg') }}" alt="" style="width:20px;margin-right:5px;display:block"></div>
                        <div class="weui-cell__bd weui-cell_primary">
                            <p>公司地址</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                    <a class="weui-cell weui-cell_access" href="tel:{{ str_replace('-', '', config('app.company.tel')) }}">
                        <div class="weui-cell__hd"><img src="{{ asset('static/images/wx/dh.jpg') }}" alt="" style="width:20px;margin-right:5px;display:block"></div>
                        <div class="weui-cell__bd weui-cell_primary">
                            <p>联系电话</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="javascript:wx.closeWindow();">
            <div class="weui-cell__bd">
                <p><i class="fa fa-sign-out" aria-hidden="true"></i> 退出</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
    </div>

    <div class="page__ft">
        @include('wx.inc.foot')
    </div>
</div>
@stop