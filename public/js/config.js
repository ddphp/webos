/**
 * Created by PengWeifeng <pwf0112@163.com> on 2016/12/26.
 */
define(function () {
    require.config({
        baseUrl: '/js',
        paths: {
            'jquery': ['http://cdn.bootcss.com/jquery/2.2.4/jquery.min', 'jquery'],
            'vue': ['http://cdn.bootcss.com/vue/2.1.1/vue', 'vue'],
            'lodash': ['http://cdn.bootcss.com/lodash.js/4.17.2/lodash', 'lodash'],
            'underscore': ['https://cdn.bootcss.com/underscore.js/1.8.3/underscore-min', 'underscore'],
            'bootstrap': ['../vendor/bootstrap/js/bootstrap'],
            'uikit': ['../vendor/uikit/js/uikit'],
            'layer': ['../vendor/layer/layer'],
            'csrf': ['csrf'],
            'wangEditor': ['../vendor/editor/js/wangEditor.min']
        },
        shim: {
            'underscore': {
                exports: '_'  // deps
            }
        }
    });
});
