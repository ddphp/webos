@extends('admin.inc.profile')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/components/form-select.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/components/datepicker.css') }}">
@stop

@section('foot')
    @parent
    <script src="{{ asset('vendor/uikit/js/uikit.js') }}"></script>
    <script src="{{ asset('vendor/uikit/js/components/form-select.js') }}"></script>
    <script src="{{ asset('vendor/uikit/js/components/datepicker.js') }}"></script>
    <script>
        var datepicker = UIkit.datepicker('#date', {
            i18n:{
                months:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
                weekdays:['日','一','二','三','四','五','六']
            }
        });
    </script>
@stop

@section('profile')
<div class="uk-grid">
    <div class="uk-width-1-1">
        {{--查询栏--}}
        <form class="uk-form">
            <div class="uk-form-row">
                <label class="uk-form-label" for="f">ID</label>
                <input class="uk-form-small uk-form-width-small" type="text" placeholder="">
                <label class="uk-form-label uk-margin-left" for="d">名称</label>
                <input class="uk-form-small" type="text" placeholder="">
                <label class="uk-form-label uk-margin-left" for="d">日期</label>
                <div class="uk-form-icon">
                    <i class="uk-icon-calendar"></i>
                    <input id="date" class="uk-form-small uk-form-width-small" type="text" data-uk-datepicker>
                </div>
            </div>
            <div class="uk-form-row">
                <button class="uk-button uk-button-small uk-button-primary">查询</button>
                <button class="uk-button uk-button-small uk-margin-left">添加</button>
            </div>
        </form>
        <hr>
    </div>
    <div class="uk-width-1-1 uk-margin-top">
        <table class="uk-table uk-table-hover uk-table-striped">
            <caption>活动列表</caption>
            <thead>
            <tr>
                <th class="uk-width-1-10">序号</th>
                <th class="uk-width-3-10">名称</th>
                <th class="uk-width-4-10">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>3242342</td>
                <td>3242342</td>
            </tr>
            <tr>
                <td>2</td>
                <td>3242342</td>
                <td>
                    <div class="uk-button-group">
                        <a class="uk-button uk-button-mini uk-button-success" href="">礼品</a>
                        <button class="uk-button uk-button-mini uk-button-primary">订单</button>
                        <button class="uk-button uk-button-mini uk-button-danger">更新</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>3242342</td>
                <td>3242342</td>
            </tr>
            <tr>
                <td>4</td>
                <td>3242342</td>
                <td>3242342</td>
            </tr>
            <tr>
                <td>5</td>
                <td>3242342</td>
                <td>3242342</td>
            </tr>
            <tr>
                <td>1</td>
                <td>3242342</td>
                <td>3242342</td>
            </tr>
            <tr>
                <td>2</td>
                <td>3242342</td>
                <td>
                    <div class="uk-button-group">
                        <a class="uk-button uk-button-mini uk-button-success" href="">礼品</a>
                        <button class="uk-button uk-button-mini uk-button-primary">订单</button>
                        <button class="uk-button uk-button-mini uk-button-danger">更新</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>3242342</td>
                <td>3242342</td>
            </tr>
            <tr>
                <td>4</td>
                <td>3242342</td>
                <td>3242342</td>
            </tr>
            <tr>
                <td>5</td>
                <td>3242342</td>
                <td>3242342</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="uk-width-1-1 uk-margin-top uk-margin-bottom">
        <ul class="uk-pagination uk-pagination-left">
            <li><a href="">第一页</a></li>
            <li><a href=""><i class="uk-icon-angle-double-left"></i></a></li>
            <li class="uk-active"><span>1</span></li>
            <li class="uk-disabled"><span>2</span></li>
            <li><a>3</a></li>
            <li><a href=""><i class="uk-icon-angle-double-right"></i></a></li>
            <li><a href="">最后一页</a></li>
        </ul>
    </div>
</div>
@stop