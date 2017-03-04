var config = "/js/config.js";
require([config], function () {
require(['jquery', 'underscore', 'vue', 'layer', 'uikit'], function ($, _, Vue, layer) {
    var vm = new Vue({
        data: {
            age: 123
        },
        methods: {
            info: function (url) {
                var index = layer.load();
                $.get(url)
                    .done(function (res) {
                        layer.alert(res.content, res.options);
                    })
                    .fail(function () {
                        layer.alert('未知错误');
                    })
                    .always(function () {
                        layer.close(index);
                    });
            },
            logout: function (url, loginUrl) {
                var index = layer.load();
                $.get(url)
                    .done(function(res){
                        if (res.num === 0) {
                            location.href = loginUrl;
                        } else {
                            layer.msg('操作失败');
                        }

                    })
                    .fail(function () {
                        layer.alert('未知错误');
                    })
                    .always(function () {
                        layer.close(index);
                    });
            }
        }
    });

    vm.$mount("#app-user");
})});
