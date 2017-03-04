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
        // 占位菜单界面
        Route::get('/demo', 'Demo@index')->name('demo');
        // 编辑器图片上传
        Route::post('img/upload', 'Tools\ImgManager@upload')->name('img.upload');
        Route::get('img/{id}', 'Tools\ImgManager@show')->name('img.show');
        // 系统信息
        Route::get('/system/info', 'System@info')->name('system.info');
        Route::get('/system/user', 'System@user')->name('system.user');
        // 登出系统
        Route::get('/logout', 'Index@logout')->name('logout');
    });
    // 后台登录
    Route::group([
        'prefix' => '/login',
        'as' => 'login.'
    ], function () {
        Route::get('/', 'Login@index')->name('index');
        Route::post('/', 'Login@store')->name('store');
    });
});