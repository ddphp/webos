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
                    type: 'custsjh',
                    number: '',
                    smsCode: ''
                },
                member: {
                    cardid: '',
                    name: '',
                    phone: '',
                    personid: ''

                },
                style: {
                    loadingToast: {
                        display: 'none'
                    },
                    toast: {
                        display: 'none'
                    },
                    dialog: {
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
                fetchSmsCode: function ($url) {
                    if (vm.cls.submitBtn['weui-btn_disabled']) {
                        return;
                    }

                    this.style.loadingToast.display = 'block';
                    $.get($url, vm.form)
                        .done(function (res) {
                            if (res.code === 0) {
                                vm.member = res.msg;
                                vm.style.dialog.display = 'block';
                            } else {
                                vm.showTips(res.msg);
                            }
                        })
                        .fail(function () {
                            vm.showTips('未知错误');
                    })
                        .always(function () {
                            vm.style.loadingToast.display = 'none';
                    });
                },
                sendSmsCode: function ($url) {
                    if (vm.cls.submitBtn['weui-btn_disabled']) {
                        return;
                    }

                    this.style.loadingToast.display = 'block';
                    $.post($url, {cardid: vm.member.cardid})
                        .done(function (res) {
                            if (res.code === 0) {
                                vm.toast = res.msg;
                                vm.style.toast.display = 'block';
                                setTimeout(function () {
                                    vm.style.toast.display = 'none';
                                }, 2500);
                            } else {
                                vm.showTips(res.msg);
                            }
                        })
                        .fail(function () {

                        })
                        .always(function () {
                            vm.style.loadingToast.display = 'none';
                        });
                    vm.style.dialog.display = 'none';
                },
                resetCard: function () {
                    this.form.number = '';
                    vm.style.dialog.display = 'none';
                },
                submitForm: function (url, redirect) {
                    if (vm.cls.submitBtn['weui-btn_disabled']) {
                        return;
                    } else {
                        vm.cls.submitBtn['weui-btn_disabled'] = true;
                    }

                    vm.style.loadingToast.display = 'block';
                    $.post(url, vm.form)
                        .done(function (res) {
                            if (res.code === 0) {
                                vm.toast = res.msg;
                                vm.style.toast.display = 'block';
                                setTimeout(function () {
                                    vm.style.toast.display = 'none';
                                    location.href = redirect;
                                }, 1500);
                            } else {
                                vm.showTips(res.msg);
                                vm.cls.submitBtn['weui-btn_disabled'] = false;
                            }
                            console.log(res);
                        })
                        .fail(function () {
                            vm.showTips('未定义错误');
                            vm.cls.submitBtn['weui-btn_disabled'] = false;
                        })
                        .always(function () {
                            vm.style.loadingToast.display = 'none';
                        });
                },
                showTips: function(msg) {
                    this.tips = msg;
                    var $tooltips = $('.js_tooltips');
                    if ($tooltips.css('display') != 'none') return;
                    $tooltips.css('display', 'block');
                    setTimeout(function () {
                        $tooltips.css('display', 'none');
                    }, 3000);
                }
            }
        });

        vm.$mount('#app');
    });
});
