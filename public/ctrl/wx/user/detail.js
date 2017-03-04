var config = "/js/config.js";

require([config], function () {
    require(['jquery', 'vue'], function ($, Vue) {
        var vm = new Vue({
            data: {
                show: {
                    toast: false,
                    loading: false,
                    dialog: false
                },
                style: {
                    tips: {
                        display: 'none'
                    }
                },
                tips: '',
                toast: ''
            },
            methods: {
                yesUnbind: function (url) {
                    this.show.dialog = false;
                    this.show.loading = true;
                    $.get(url)
                        .done(function (res) {
                            if (res.code === 0) {
                                vm.toast = res.msg;
                                vm.show.toast = true;
                                setTimeout(function () {
                                    vm.toast = '';
                                    vm.show.toast = false;
                                    wx.closeWindow();
                                }, 2000);
                            }
                        })
                        .fail(function () {
                            vm.showTips('未定义错误');
                        })
                        .always(function () {
                            vm.show.loading = false;
                        });
                },
                sureUnbind: function () {
                    this.show.dialog = true;
                },
                noUnbind: function () {
                    this.show.dialog = false;
                },
                showTips: function (msg) {
                    vm.tips = msg;
                    vm.style.tips.display = 'block';
                    setTimeout(function () {
                        vm.tips = '';
                        vm.style.tips.display = 'none';
                    }, 3000);
                }
            }
        });

        vm.$mount('#app');
    });
});