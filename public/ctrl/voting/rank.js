var config = "/js/config.js";
require([config], function () {
require([], function () {
    var appId = '#voting-rank';
    var vm = new Vue({
        data: {
            ranks: []
        },
        mounted: function () {
            $.get('http://dongdasm.com/voting/ranks', {actid: $(appId).data('actid')})
                .done(function (res) {
                    vm.ranks = res;
                });
        }
    });

    vm.$mount(appId);
})});
