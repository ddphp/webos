@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/components/form-select.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/components/datepicker.css') }}">
@stop

@section('foot')
    @parent
    <script src="{{ asset('vendor/uikit/js/uikit.js') }}"></script>
    <script src="{{ asset('vendor/uikit/js/components/form-select.js') }}"></script>
    <script src="{{ asset('vendor/uikit/js/components/datepicker.js') }}"></script>
    <script src="{{ asset('ctrl/admin/tp/index.js') }}"></script>
@stop

@section('profile')
    <div id="admin-tp-index" class="uk-grid">
        <div class="uk-width-1-1">
            {{--查询栏--}}
            <form id="form" class="uk-form" v-on:submit.prevent="query">
                <div class="uk-form-row">
                    <label class="uk-form-label" for="name">名称</label>
                    <input class="uk-form-small" type="text" id="name" name="name" placeholder="活动名称"
                           v-model="form.name">
                    <label class="uk-form-label uk-margin-left" for="date">日期</label>
                    <div class="uk-form-icon">
                        <i class="uk-icon-calendar"></i>
                        <input id="date" name="date" class="uk-form-small uk-form-width-small" type="text"
                               v-model="form.date"
                               data-uk-datepicker="{format:'YYYY-MM-DD',i18n:{months:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],weekdays:['日','一','二','三','四','五','六']}}">
                    </div>
                    <button class="uk-button uk-button-small uk-button-primary uk-margin-left">查询</button>
                    <a class="uk-button uk-button-small uk-margin-left" v-on:click="location.href='{{ $urls->edit.'?'.$_nav }}'">新建</a>
                </div>
            </form>
        </div>
        <div class="uk-width-1-1 uk-margin-top">
            <table class="uk-table uk-table-hover uk-table-striped">
                <caption>活动列表</caption>
                <thead>
                <tr>
                    <th class="uk-width-1-10">序号</th>
                    <th class="uk-width-2-10">活动名称</th>
                    <th class="uk-width-2-10">开始日期</th>
                    <th class="uk-width-2-10">结束日期</th>
                    <th class="uk-width-1-10">投票类型</th>
                    <th class="uk-width-2-10">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in list">
                    <td v-text="item.id"></td>
                    <td v-text="item.name"></td>
                    <td v-text="item.sdate"></td>
                    <td v-text="item.edate"></td>
                    <td v-text="item.type==0 ? '一次' : '每天'"></td>
                    <td>
                        <div class="uk-button-group">
                            <a class="uk-button uk-button-mini uk-button-primary" v-on:click="edit(item.id)" v-on:key="item.id">编辑</a>
                            <button class="uk-button uk-button-mini uk-button-primary" v-on:click="content(item.id)">详情</button>
                            <button class="uk-button uk-button-mini uk-button-primary" v-on:click="play(item.id)">选手</button>
                            <button class="uk-button uk-button-mini uk-button-primary">统计</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="uk-width-1-1 uk-margin-top uk-margin-bottom">
            <ul class="uk-pagination uk-pagination-left">
                <li v-on:click="page.cur = 1">
                    <a>第一页</a>
                </li>
                <li v-on:click="page.cur = page.cur<=1 ? 1 : page.cur - 1">
                    <a><i class="uk-icon-angle-double-left"></i></a>
                </li>
                <template v-for="n in page.max">
                    <li v-if="n !== page.cur" v-on:click="page.cur = n"><a v-text="n"></a></li>
                    <li v-else class="uk-active"><span v-text="n"></span></li>
                </template>
                <li v-on:click="page.cur = page.cur>=page.max ? page.max : page.cur + 1">
                    <a><i class="uk-icon-angle-double-right"></i></a>
                </li>
                <li v-on:click="page.cur = page.max">
                    <a>最后一页</a>
                </li>
            </ul>
        </div>
    </div>
@stop