<?php
route::group([
    'prefix' => 'test'
], function () {
    Route::get('/', function () {
        return view('test.index');
    });
});
