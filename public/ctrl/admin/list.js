/**
 * Created by Administrator on 2017-03-25.
 * 后台 Admin 模块左侧列表控制器
 */
require.config({
    baseUrl: '/js',
    paths: {
        vue: ['vue'],
        unit: ['comm/unit']
    }
});
require(['vue', 'unit'], function (Vue, Unit) {
    var appId = '#main-list';

    var vm = new Vue({
        el: appId,
        data: {
            t: 'ooo'
        },
        methods: {
            href: function (path, search) {
                var url = location.protocol+'//'+location.hostname+'/'+path+'?'+search;
                var reg = new RegExp("{\\w+}", "g");

                if (reg.test(path)) {
                    var varsObj = JSON.parse(sessionStorage.listVars);
                    if (varsObj) {
                        url = Unit.varsReplace(url, varsObj);
                        location.href = url;
                    } else {
                        alert('error');
                    }
                } else {
                    location.href = url;
                }
            }
        }
    });
});
