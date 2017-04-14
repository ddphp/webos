require.config({
    baseUrl: '/js',
    paths: {
        'vue': ['vue'],
        'url': ['../vendor/jurls.min']
    }
});

require([
    'vue',
    'jquery',
    'underscore',
    'url'
], function (Vue, $, _, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var mainUrl = url.parse(location.href);
    var baseUrl = mainUrl.protocol+'//'+mainUrl.hostname+mainUrl.pathname;
    sessionStorage.mainUrl = JSON.stringify(url.parse(location.href));

    var appId = '#admin-tp-index';

    var page = $(appId).data('page');
    var list = $(appId).data('list');
    var init = $(appId).data('init');

    sessionStorage.listVars = JSON.stringify({actid: init.activity});

    var vm = new Vue({
        el: appId,
        data: {
            page: page,
            list: list,
            form: {
                number: '',
                name: ''
            }
        },
        watch: {
            'page.cur': function () {
                this.query();
            }
        },
        methods: {
            query: function () {
                var data = _.extend(vm.form, {page:vm.page.cur, take:10, actid:1});
                $.get(init.url.query, data)
                    .done(function (res) {
                        vm.page = res.page;
                        vm.list = res.list;
                    });
            },
            edit: function (playerId) {
                var mainUrl = JSON.parse(sessionStorage.mainUrl);

                location.href = baseUrl+'/'+playerId+mainUrl.search;
            },
            detail: function (playerNumber) {
                location.href = baseUrl+'/'+playerNumber+'/detail'+mainUrl.search;
            },
            del: function (id) {
                var request = $.post('http://dongdasm.com/admin/tp/players/'+id, {_method:'DELETE'});

                request.done(function () {
                    vm.query();
                });
            }
        }
    });
});
