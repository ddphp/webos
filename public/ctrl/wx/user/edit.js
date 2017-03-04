var config = "/js/config.js";

require([config], function () {
    require(['jquery', 'vue'], function ($, Vue) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var form = $('#app').data('form');

        var vm = new Vue({
            data: {
                form: form,
                show: {
                    toast: false,
                    loading: false
                },
                style: {
                    tips: {
                        display: 'none'
                    }
                },
                tips: '',
                toast: ''
            },
            computed: {
                textLength: function () {
                    return form.address.length;
                }
            },
            methods: {
                submit: function (url) {
                    vm.show.loading = true;
                    $.post(url, vm.form)
                        .done(function (res, a, jqXHR) {
                            if (jqXHR.status === 222) {
                                for (x in res) {
                                    var tips = res[x][0];
                                    break;
                                }
                                vm.showTips(tips);
                            } else {
                                if (res.code === 0) {
                                    vm.toast = res.msg;
                                    vm.show.toast = true;
                                    setTimeout(function () {
                                        vm.toast = '';
                                        vm.show.toast = false;
                                    }, 2000);
                                } else {
                                    vm.showTips(res.msg);
                                }
                            }
                        })
                        .fail(function () {
                            vm.showTips('未定义错误');
                        })
                        .always(function () {
                            vm.show.loading = false;
                        });
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
