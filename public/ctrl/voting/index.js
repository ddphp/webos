var config = "/js/config.js";
require([config], function () {
require([], function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var appId = '#voting-index';
    var init = $(appId).data('init');

    var vm = new Vue({
        data: {
            page: 1,
            query: '',
            count: { players: 0, voters: 0, visitors: 0 },
            players: []
        },
        watch: {
            query: function (val) {
                if (val !== '' && !$(appId).data('players')) {
                    $(appId).data('players', vm.players);
                }

                if (val === '') {
                    vm.players = $(appId).data('players');
                    $(appId).data('players', null);
                } else {
                    var load = layer.load(2);
                    $.get(init.uri.query, {actid: init.dat.actid, query: vm.query})
                        .done(function (res) {
                            vm.players = res;
                        })
                        .fail(function () {
                            layer.alert('系统出错了^_^');
                        })
                        .always(function () {
                            layer.close(load);
                        });
                }
            }
        },
        computed: {
            playerIds: function () {
                return _.map(this.players, function (val) {
                    return val.id;
                });
            }
        },
        methods: {
            vote: function (event) {
                var data = {
                    'playid': $(event.target).data('id'),
                    'openid': init.dat.openid,
                    'actid' : init.dat.actid
                };
                var load = layer.load(2);
                $.post(init.uri.vote, data)
                    .done(function (res) {
                        if (res.num === 7) {
                            layer.msg(res.msg, function () {
                                location.href = 'https://mp.weixin.qq.com/s?__biz=MzI1MzUzNTE2MA==&mid=2247483665&idx=1&sn=7839ccdbf9a12a7422fa3265bb49cbc0&chksm=e9d3b7c6dea43ed0760c88ce45eda6dc60cc4af6be1e25dad54e8bf3abceb6bae6d2c99d94f7#rd';
                            });
                            return;
                        }
                        layer.msg(res.msg);
                        if (res.num !== 0) return;
                        vm.getCount();
                        vm.getListCount(vm.playerIds);
                    })
                    .fail(function () {
                        layer.alert('系统异常');
                    })
                    .always(function () {
                        layer.close(load);
                    });
            },
            getCount: function () {
                $.get(init.uri.count, {actid: init.dat.actid})
                    .done(function (res) {
                        vm.count   = res;
                    })
                    .fail(function () {
                        layer.alert('系统出错了^_^');
                    })
                    .always(function () {

                    });
            },
            addList: function (page) {
                var load = layer.load(2);
                $.get(init.uri.players, {actid: init.dat.actid, page: page, take: init.dat.take})
                    .done(function (res) {
                        _.each(res, function (re) {
                            vm.players.push(re);
                        });
                    })
                    .fail(function () {
                        layer.alert('系统出错了^_^');
                    })
                    .always(function () {
                        layer.close(load);
                    });
            },
            getListCount: function (playids) {
                $.get(init.uri.votes, {playids: playids})
                    .done(function (votes) {
                        vm.players = _.map(vm.players, function (player) {
                            if (votes[player.id]) {
                                player['vote'] = votes[player.id];
                                return player;
                            } else {
                                return player;
                            }
                        })
                    });
            },
            showPlayer: function (number) {
                location.href = location.href + '/number/' + number;
            }
        },
        mounted: function () {
            vm.getCount();
            vm.addList(1);
        }
    });

    vm.$mount(appId);
})});
