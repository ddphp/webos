require.config({
    baseUrl: '/js',
    paths: {
        'jquery.form': ['https://cdn.bootcss.com/jquery.form/4.2.0/jquery.form.min']
    },
    shim: {
        'jquery.form': ['jquery']
    }
});
require(['jquery', 'vue', 'jquery.form'], function ($, Vue) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var appId = '#admin-tp-save';
    var player = $(appId).children('form').data('player');

    var vm = new Vue({
        el: appId,
        data: {
            player: player
        },
        methods: {
            submit: function () {
                var image = $("input[name=image]").val();
                var data = this.player;
                if (image) {
                    data = _.extend(data, {image: image});
                }

                $("#form").ajaxSubmit({
                    url: location.href,
                    type: 'POST',
                    data: data,
                    success: function (res) {
                        vm.player = res;
                    },
                    error: function (error) {
                        alert('error');
                    }
                });
            }
        }
    });
});
