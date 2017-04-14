var config = "/js/config.js";
require([config], function () {
require(['jquery', 'vue', 'csrf', '../vendor/jurls.min', 'uikit'], function ($, Vue, csrf, urls) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var baseUrl = location.protocol+'//'+location.host;
    var mainUrl = urls.parse(location.href);
    sessionStorage.mainUrl = JSON.stringify(mainUrl);
    var appId = '#admin-tp-index';
    var vm = new Vue({
        el: appId,
        data: {
            form: {
                name: '',
                date: ''
            },
            page: {
                cur: 1,
                max: 1
            },
            list: []
        },
        watch: {
            'page.cur': function () {
                this.query();
            }
        },
        methods: {
            query: function () {
                var form = $("#form").serializeArray();
                var query = {};
                query.page = vm.page.cur;
                _.each(form, function (v) {
                    query[v.name] = v.value;
                });
                vm.form.date = query.date;
                csrf.submit('http://dongdasm.com/admin/tp/query', query, _.noop(), function (res) {
                    vm.list = res.list;
                    vm.page = res.page;
                });
            },
            edit: function (id) {
                location.href = baseUrl+'/admin/tp/'+id+mainUrl.search;
            },
            play: function (id) {
                location.href = baseUrl+'/admin/tp/'+id+'/player/?t=list&i=15';
            },
            content: function (id) {
                location.href = baseUrl+'/admin/tp/content/'+id+''+mainUrl.search;
            }
        }
    });

    vm.query();
})});
