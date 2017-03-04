<?php
// 微信好友征集活动
Route::group([
    'prefix' => '/friend'
], function () {
    // 生成活动二维码
    Route::get('qr', function () {
        $openId = 'ouAHtwVDMNVLNDQ-rguw8d-9yb8Y';

        $file = storage_path("app/images/friend/qr/{$openId}.png");
        if (!\Storage::exists("images/friend/qr/{$openId}.png")) {
            $logo = route('friend.rq_logo', [$openId]);
            $wechat = app(\EasyWeChat\Foundation\Application::class);
            $qrcode = $wechat->qrcode;
            $result = $qrcode->temporary(124, 24 * 3600);
            $url = $result->url;
            \QrCode::format('png')
                ->size(520)
                ->margin(1)
                ->merge($logo, .3, true)
                ->errorCorrection('H')
                ->generate($url, $file);
        }

        return $file;
    });

    // 生成活动邀请二维码Logo
    Route::get('qr_logo/{openId}', function (\Illuminate\Http\Request $request, $openId) {
        $size = $request->input('size', 172);
        $border = $request->input('border', 20);

        $user = \Cache::store('wx_user')->remember($openId, 3600 * 24, function() use ($openId) {
            return app(\EasyWeChat\Foundation\Application::class)->user->get($openId);
        });

        $logo = $user->headimgurl;
        $logoContent = \Cache::store('wx_head')->remember($openId, 3600 * 24 * 7, function() use ($logo) {
            return file_get_contents($logo);
        });

        $img = \Image::make($logoContent);
        $img->resize($size, $size);
        $img->resizeCanvas($border, $border, 'center', true);

        return $img->response();
    })->name('friend.rq_logo');
});