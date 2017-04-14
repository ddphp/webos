@extends('admin.inc.profile')

@section('head')
    @parent
    @include('inc.csrf')
@stop

@section('foot')
    @parent
    <script src="{{ asset('ctrl/admin/tp/player.js') }}"></script>
@stop

@section('profile')
    <div id="admin-tp-index" class="uk-grid"
         data-list="{{ json_encode($list) }}"
         data-page="{{ json_encode($page) }}"
         data-init="{{ json_encode($init) }}"
    >
        {{-- 查询栏 --}}
        <div class="uk-width-1-1">
            <form id="form" class="uk-form" v-on:submit.prevent="query('{{ $init['url']['query'] }}')">
                <div class="uk-form-row">
                    <label class="uk-form-label" for="number">编号</label>
                    <input class="uk-form-small uk-form-width-small" type="text" id="number" placeholder="选手编号"
                           v-model="form.number">
                    <label class="uk-form-label uk-margin-small-left" for="name">名称</label>
                    <input class="uk-form-small" type="text" id="name" placeholder="选手名称" v-model="form.name">
                    <button class="uk-button uk-button-small uk-button-primary uk-margin-left">查询</button>
                    <a class="uk-button uk-button-small uk-margin-left" v-on:click="edit(0)">新建</a>
                </div>
            </form>
        </div>
        {{-- 列表栏 --}}
        <div class="uk-width-1-1 uk-margin">
            <table class="uk-table uk-table-hover uk-table-striped">
                <caption>选手列表</caption>
                <thead>
                    <tr>
                        <th class="uk-width-1-10">编号</th>
                        <th class="uk-width-4-10">名称</th>
                        <th class="uk-width-2-10">得票数</th>
                        <th class="uk-width-3-10">操作</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="item in list">
                    <td v-text="item.number"></td>
                    <td v-text="item.name"></td>
                    <td v-text="item.vote"></td>
                    <td>
                        <div class="uk-button-group">
                            <a class="uk-button uk-button-mini uk-button-primary" v-on:click="edit(item.id)">编辑</a>
                            <a class="uk-button uk-button-mini uk-button-primary"  v-on:click="detail(item.number)">详情</a>
                            <a class="uk-button uk-button-mini uk-button-danger" v-on:click="del(item.id)">删除</a>
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
                <template v-for="n in page.tot">
                    <li v-if="n !== page.cur" v-on:click="page.cur = n"><a v-text="n"></a></li>
                    <li v-else class="uk-active"><span v-text="n"></span></li>
                </template>
                <li v-on:click="page.cur = page.cur>=page.tot ? page.tot : page.cur + 1">
                    <a><i class="uk-icon-angle-double-right"></i></a>
                </li>
                <li v-on:click="page.cur = page.tot">
                    <a>最后一页</a>
                </li>
            </ul>
        </div>
    </div>
@stop