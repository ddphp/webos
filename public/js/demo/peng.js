define(['jquery'], function ($) {
    var count = $("#count").text();

    var add = function () {
        count ++;
    };

    var get = function () {
        alert(count);
    };

    return {
        add: add,
        get: get
    };
});
