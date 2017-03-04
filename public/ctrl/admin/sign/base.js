var config = "/js/config.js";
require([config], function () {
require(['vue', 'csrf', 'uikit', 'ukc/number'], function (Vue, Csrf) {
    var appId = '#admin-sign-base';
    var $form = $(appId).children('form');
    var form  = $form.data('init');
    var vm = new Vue({
        data: {
            form: form,
            error: []
        },
        computed: {
            err: function () {
                return Csrf.err(this.error);
            }
        },
        methods: {
            submit: function (uri) {
                Csrf.submit(uri, vm.form, function (err) {
                    vm.error = err;
                    layer.msg('数据有误');
                }, function (res) {
                    vm.error = [];
                    layer.msg(res);
                });
            }
        }
    });

    vm.$mount(appId);
})});
