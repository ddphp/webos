/**
 * Created by PengWeifeng <pwf0112@163.com> on 2016/12/26.
 */
define(function () {
    require.config({
        baseUrl: '/js',
        paths: {
            'jquery': ['http://cdn.bootcss.com/jquery/2.2.4/jquery.min', 'jquery'],
            'vue': ['https://cdn.bootcss.com/vue/2.2.4/vue.min', 'vue'],
            'lodash': ['http://cdn.bootcss.com/lodash.js/4.17.2/lodash', 'lodash'],
            'underscore': ['https://cdn.bootcss.com/underscore.js/1.8.3/underscore-min', 'underscore'],
            'axios': ['https://cdn.bootcss.com/axios/0.15.3/axios.min', '../vendor/axios.min'],
            'bootstrap': ['../vendor/bootstrap/js/bootstrap'],
            'uikit': ['../vendor/uikit/js/uikit'],
            'layer': ['../vendor/layer/layer'],
            'csrf': ['csrf'],
            'wangEditor': ['../vendor/editor/js/wangEditor.min'],
            'jquery.form': ['../vendor/jquery.form.min']
        },
        shim: {
            'underscore': {
                exports: '_'  // deps
            },
            'uikit': ['jquery'],
            'jquery.form': ['jquery']
        }
    });
});
