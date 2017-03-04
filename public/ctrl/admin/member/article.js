var config = "/js/config.js";
require([config], function () {
require(['wangEditor', 'uikit', 'csrf'], function (wangEditor) {
    var $edit = $('#edit');
    var docH  = $(window).height();
    var $form = $("form");
    var token = $("input[name='_token']").val();
    $edit.height(docH - 230);
    $edit.css('display', 'block');

    var editor = new wangEditor($edit.get()[0]);
    editor.config.uploadImgUrl = $form.data('uploadImg');
    editor.config.uploadImgFileName = 'img';
    editor.config.menus = ['bold','underline','italic','strikethrough','eraser','forecolor','bgcolor','quote','fontfamily',
        'fontsize','head','unorderlist','orderlist','alignleft','aligncenter','alignright','link','unlink','table','img',
        'undo','redo'
    ];
    editor.create();
    $('#submit').click(function () {
        $.post($form.data('uri'), {id: $form.data('id'), content: editor.$txt.html(), _token: token})
            .done(function (res) {
                layer.msg(res);
            });
    });
})});
