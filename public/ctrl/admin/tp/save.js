var config = "/js/config.js";
require([config], function () {
require(['jquery', 'vue', 'underscore',
'uikit', 'ukc/input', 'ukc/date', 'ukc/number', 'jquery.form'
], function ($, Vue, _) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var appId = '#admin-tp-save';

    var form = $(appId).children('form').data('form');

    var vm = new Vue({
        el: appId,
        data: {
            form: form
        },
        methods: {
            submit: function () {
                var sdate = $("#sdate").val();
                var edate = $("#edate").val();
                this.form.sdate = sdate;
                this.form.edate = edate;
                var image = $("input[name=image]").val();
                var data = _.extend(this.form, {image: image});

                $(appId).children("form").ajaxSubmit({
                    type: 'POST',
                    url: location.href,
                    data: data,
                    success: function (res) {
                        console.log(res);
                        vm.form = res;
                    },
                    error: function () {
                        layer.alert('error');
                    }
                });
            }
        }
    });

})});
