var config = "/js/config.js";
require([config], function () {
require(['jquery', 'underscore', 'layer', 'Vue', 'uikit'], function ($, _, layer, Vue) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var vm = new Vue({
        data: {
            account: {
                user: '',
                pass: ''
            }
        },
        methods: {
            submit: function (url, href) {
                if (_.isEmpty(this.account.user)) {
                    layer.msg('用户名不能为空');
                    return;
                }
                if (_.isEmpty(this.account.pass)) {
                    layer.msg('密码不能为空');
                    return;
                }
                var index = layer.load(0);
                $.post(url, this.account)
                    .done(function (res) {
                        if (res.num === 0) {
                            location.href = href;
                        } else {
                            layer.msg(res.msg);
                        }
                    })
                    .fail(function () {
                        layer.msg('未知错误');
                    })
                    .always(function () {
                        layer.close(index);
                    });
            }
        }
    });

    vm.$mount("#admin-login-form");
})});
