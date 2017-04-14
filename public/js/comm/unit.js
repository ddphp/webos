define([], function () {
    var varsReplace = function (vars, dataObj) {
        return vars.replace(/({\w+})/g, function ($1) {
            var reg = new RegExp("[}{]", "g");
            return dataObj[$1.replace(reg, '')];
        });
    };

    return {
        hostUrl: location.protocol+'//'+location.hostname,
        varsReplace: varsReplace
    };
});
