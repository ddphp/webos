<?php
// 微信会员中心
Route::group([
    'prefix' => '/wx',
], function () {
    Route::group([
        'prefix' => '/user',
        'middleware' => ['wx.user.config', 'wx.sync.we7', 'wechat.oauth']
    ], function () {
        Route::group([
            'middleware' => 'wx.bind:no'
        ], function () {
            Route::get('/join', 'Wx\User\Join@index')->name('wx.user.join');
            Route::group([
                'prefix' => '/bind'
            ], function () {
                Route::get('/', 'Wx\User\Bind@index')->name('wx.user.bind');
                Route::group([
                    'prefix' => '/fetch',
                    'as' => 'wx.user.bind.fetch'
                ], function () {
                    Route::get('/', 'Wx\User\Bind@fetchCardInfo');
                    Route::post('/', 'Wx\User\Bind@sendSmsCode');
                });
                Route::post('submit', 'Wx\User\Bind@submit')->name('wx.user.bind.submit');
            });
            Route::group([
                'prefix' => '/regist',
            ], function () {
                Route::get('/', 'Wx\User\Regist@index')->name('wx.user.regist');
                Route::post('/', 'Wx\User\Regist@store')->name('wx.user.regist.submit');
                Route::get('/smscode', 'Wx\User\Regist@getSmsCode')->name('wx.user.regist.smscode');
            });
        });
        Route::group([
            'middleware' => 'wx.bind'
        ], function () {
            Route::get('/index', 'Wx\User\Main@index')->name('wx.user.index');
            Route::get('/detail', 'Wx\User\Main@detail')->name('wx.user.detail');
            Route::group([
                'prefix' => '/edit',
                'as' => 'wx.user.edit'
            ], function () {
                Route::get('/', 'Wx\User\Edit@index');
                Route::post('/', 'Wx\User\Edit@store');
            });
            Route::get('/unbind', 'Wx\User\Unbind@handle')->name('wx.user.unbind');
            Route::get('sign', 'Wx\User\Sign@handle')->name('wx.user.sign');
        });
    });
    Route::get('user/article/{article}', 'Wx\User\Article@index')->name('wx.user.article');
});

// 会员卡图片生成
Route::get('img/card/{type}/{id}.jpg', 'Img\Card@handle')->middleware(['wx.user.config'])->name('img.card');