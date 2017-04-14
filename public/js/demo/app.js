require.config({
    paths: {
        'jquery': ['../jquery'],
        'async': ['https://cdn.bootcss.com/async/2.1.5/async.min', '../../vendor/async.min']
    }
});

require(['peng', 'async'], function (peng, async) {
    async.series([
        function (cb) {
            cb('error', 1);
        },
        function (num, cb) {
            cb(null, num +4);
        }
    ],function (err, res) {
        console.log(err, res);
    });
});
