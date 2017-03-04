var config = "/js/config.js";
require([config], function () {
require(['jquery', 'layer', 'vue', 'csrf', 'uikit', 'ukc/input'], function ($, layer, Vue, csrf) {
    var form = $("#admin-member-company").children('form').data('init');
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
                csrf.submit(uri, this.form, function (res) {
                    vm.error = res;
                    layer.msg('数据有误');
                }, function (res) {
                    vm.error = [];
                    layer.msg(res);
                });
            }
        }
    });
    vm.$mount('#admin-member-company');
})});
