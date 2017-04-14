<?php
// 后台管理
Route::group([
    'prefix' => '/admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
], function () {
    // 后台管理
    Route::group([
        'middleware' => ['admin.session']
    ], function () {
        // 菜单主页面
        Route::get('/profile', 'Index@index')->name('profile');
        // 公众号配置功能
        Route::group([
            'prefix' => '/mp/base',
            'namespace' => 'Mp'
        ], function () {
            Route::get('/', 'Base@index')->name('mp.base');
            Route::post('/', 'Base@submit')->name('mp.base.submit');
        });
        // 会员中心功能
        Route::group([
            'prefix' => '/member',
            'namespace' => 'Member',
            'as' => 'member.'
        ], function () {
            // 公司信息配置
            Route::get('/company', 'CompanyConfig@index')->name('company');
            Route::post('/company', 'CompanyConfig@store')->name('company_store');
            // 短信配置
            Route::get('/sms', 'Sms@index')->name('sms');
            Route::post('/sms', 'Sms@store')->name('sms_store');
            // 验证码设置
            Route::get('/verify', 'Verify@index')->name('verify');
            Route::post('/verify', 'Verify@store')->name('verify_store');
            // 卡前缀
            Route::get('/card', 'Card@index')->name('card');
            Route::post('/card', 'Card@store')->name('card_store');
            // 会员文档编辑
            Route::get('/article/{id}', 'Article@index')->name('article');
            Route::post('article/store', 'Article@store')->name('article_store');
        });
        // 会员签到
        Route::group([
            'prefix' => '/sign',
            'namespace' => 'Sign',
            'as' => 'sign.'
        ], function () {
            // 基本配置
            Route::get('/base', 'Base@index')->name('base');
            Route::post('/base', 'Base@store')->name('base_store');
        });
        // 微信投票
        Route::group([
            'prefix'    => '/tp',
            'namespace' => 'Tp',
            'as'        => 'tp.'
        ], function () {
            Route::delete('/players/{player}', "Player@delete");
            Route::get('/index', 'Index@index')->name('index');
            Route::get('/content/{activity}', 'ActivityContent@edit')->name('content.edit');
            Route::post('/content/{activity}', 'ActivityContent@store')->name('content.store');
            Route::get('/{activity?}', 'Index@edit')->where('activity', '^\d+$')->name('edit');
            Route::post('/{activity?}', 'Index@save')->where('activity', '^\d+$')->name('save');
            Route::post('/query', 'Index@query')->name('query');
            Route::get('/{activity}/player', 'Player@index')->name('player');
            Route::get('/{activity}/player/{player}', 'Player@edit')->where('player', '^\d+$')->name('player.edit');
            Route::get('/{activity}/player/{number}/detail', 'Player@detail')->name('player.detail');
            Route::post('/{activity}/player/{number}/detail', 'Player@detailStore')->name('player.detail.store');
            Route::post('/{activity}/player/{player}', 'Player@save')->where('player', '^\d+$')->name('player.save');

        });
        // 积分商城后台
        Route::group([
            'prefix' => '/jfsc',
            'namespace' => 'Jfsc',
            'as' => 'jfsc.'
        ], function () {
            // 活动
            Route::get('fljh', 'Fljh@index')->name('fljh');
        });
        // 占位菜单界面
        Route::get('/demo', 'Demo@index')->name('demo');

        // 系统信息
        Route::get('/system/info', 'System@info')->name('system.info');
        Route::get('/system/user', 'System@user')->name('system.user');
        // 登出系统
        Route::get('/logout', 'Index@logout')->name('logout');
    });
    // 编辑器图片上传
    Route::post('img/upload', 'Tools\ImgManager@upload')->name('img.upload');
    Route::get('img/{id}.{ext}', 'Tools\ImgManager@show')->name('img.show');
    // 后台登录
    Route::group([
        'prefix' => '/login',
        'as' => 'login.'
    ], function () {
        Route::get('/', 'Login@index')->name('index');
        Route::post('/', 'Login@store')->name('store');
    });
});