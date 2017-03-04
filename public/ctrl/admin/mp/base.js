var config = "/js/config.js";
require([config], function () {
require(['jquery', 'vue', 'layer', 'csrf', 'uikit', 'ukc/input'], function ($, Vue, layer, csrf) {
    var appId = '#app-admin-mp-base';
    var form  = $(appId).children('form').data('init');
    var vm = new Vue({
        data: {
            form: form,
            error: []
        },
        computed: {
            err: function () {
                return csrf.err(this.error)
            }
        },
        methods: {
            submit: function (uri) {
                csrf.submit(uri, this.form, function(res) {
                    vm.error = res;
                    layer.msg('数据项存在错误')
                }, function (res) {
                    vm.error = [];
                    layer.msg(res);
                })
            }
        }
    });
    vm.$mount(appId)
})});
