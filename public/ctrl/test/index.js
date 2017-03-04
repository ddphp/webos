var config = "/js/config.js";
require([config], function () {
require(['jquery', 'underscore', 'vue', 'uikit'], function ($, _, Vue) {
    var vm = new Vue({
        data: {
            age: 123
        }
    });

    vm.$mount('#app');
})});
