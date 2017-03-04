var config = "/js/config.js";

require([config], function () {
    require(['jquery', 'vue'], function ($, Vue) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var vm = new Vue({
            data: {
                form: {
                    name: '',
                    mobilephone: '',
                    personid: '',
                    smscode: ''
                },
                show: {
                    toast: false,
                    loading: false
                },
                style: {
                    tips: {
                        display: 'none'
                    }
                },
                cls: {
                    submitBtn: {
                        'weui-btn_disabled': false
                    }
                },
                tips: '',
                toast: ''
            },
            methods: {
                getSmsCode: function (url) {
                    if (vm.cls.submitBtn['weui-btn_disabled']) {
                        return;
                    }

                    vm.show.loading = true;
                    $.get(url, {mobilephone: vm.form.mobilephone})
                        .done(function (res, textStatus, jqXHR) {
                            if (jqXHR.status === 222) {
                                for (i in res) {
                                    var msg = res[i][0];
                                    vm.showTips(msg);
                                    break;
                                }
                            } else {
                                if (res.code === 0) {
                                    vm.showToast(res.msg, function(){});
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
                submitRegist: function (url, href) {
                    if (vm.cls.submitBtn['weui-btn_disabled']) {
                        return;
                    } else {
                        vm.cls.submitBtn['weui-btn_disabled'] = true;
                    }

                    vm.show.loading = true;
                    $.post(url, vm.form)
                        .done(function (res, textStatus, jqXHR) {
                            if (jqXHR.status === 222) {
                                for (i in res) {
                                    var msg = res[i][0];
                                    vm.showTips(msg);
                                    vm.cls.submitBtn['weui-btn_disabled'] = false;
                                    break;
                                }
                            } else {
                                if (res.code === 0) {
                                    vm.showToast(res.msg, function () {
                                        location.href = href;
                                    });
                                } else {
                                    vm.showTips(res.msg);
                                    vm.cls.submitBtn['weui-btn_disabled'] = false;
                                }
                            }
                        })
                        .fail(function () {
                            vm.showTips('未定义错误');
                            vm.cls.submitBtn['weui-btn_disabled'] = false;
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
                },
                showToast: function (msg, callback) {
                    vm.toast = msg;
                    vm.show.toast = true;
                    setTimeout(function () {
                        vm.toast = '';
                        vm.show.toast = false;
                        callback();
                    }, 2000);
                }
            }
        });

        vm.$mount('#app');
    });
});