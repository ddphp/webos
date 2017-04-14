var config = "/js/config.js";
require([config], function () {
    require(['jquery', 'wangEditor', 'uikit', 'csrf'], function ($, wangEditor) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var appId = "#admin-tp-content";

        var $edit = $('#edit');
        var docH  = $(window).height();
        $edit.height(docH - 230);
        $edit.css('display', 'block');

        var editor = new wangEditor($edit.get()[0]);
        editor.config.uploadImgUrl = 'http://dongdasm.com/admin/img/upload';
        editor.config.uploadImgFileName = 'img';
        editor.config.menus = ['bold','underline','italic','strikethrough','eraser','forecolor','bgcolor','quote','fontfamily',
            'fontsize','head','unorderlist','orderlist','alignleft','aligncenter','alignright','link','unlink','table','img',
            'undo','redo'
        ];
        editor.create();

        $('#submit').click(function () {
            var request = $.post(location.href, {detail: editor.$txt.html()});
            var load = layer.load(2);
            request.done(function (res) {
                layer.close(load);
                layer.msg(res);
            });
        });
    })});
