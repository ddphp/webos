define(['jquery', 'layer'], function ($, layer) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var o = {};

    o.err = function (err) {
        var t = {};
        _.each(err, function (value, key, error) {
            t[key] = error[key] ? value[0] : '';
        });
        return t;
    };

    o.submit = function (uri, form, errHandler, resHandler) {
        var load = layer.load(2);
        $.post(uri, form)
            .done(function (res, msg, jqXHR) {
                if (jqXHR.status === 222) {
                    errHandler(res);
                } else {
                    resHandler(res);
                }
            })
            .fail(function () {
                layer.alert('未知错误');
            })
            .always(function () {
                layer.close(load);
            });
    };

    return o;
});
