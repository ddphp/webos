var config = "/js/config.js";
require([config], function () {
require(['jquery', 'csrf', 'vue', 'layer', 'uikit', 'ukc/input'], function ($, csrf, Vue, layer) {
    var appId = '#admin-member-sms';
    var form  = $(appId).children('form').data('init');
    var vm = new Vue({
        data: {
            form: form,
            error: []
        },
        computed: {
            err: function () {
                return csrf.err(this.error);
            }
        },
        methods: {
            submit: function (uri) {
                csrf.submit(uri, this.form, function (err) {
                    vm.error = err;
                    layer.msg('数据有误');
                }, function (res) {
                    vm.error = [];
                    layer.msg(res);
                })
            }
        }
    });

    vm.$mount(appId);
})});
