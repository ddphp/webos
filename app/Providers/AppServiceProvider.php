<?php

namespace App\Providers;

use App\Http\Controllers\Admin\Tools\ProfileTrait;
use cszchen\citizenid\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Shitoudev\Phone\PhoneLocation;
use SMSCode\Verify;

class AppServiceProvider extends ServiceProvider
{
    use ProfileTrait;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        /* 自定义验证规则 */
        // 手机号码验证规则
        \Validator::extend('mobilephone', function($attribute, $value) {
            return !empty(app(PhoneLocation::class)->find($value));
        });
        // 身份证号码验证规则
        \Validator::extend('personid', function($attribute, $value) {
            return app(Parser::class)->isValidate($value);
        });

        View::share('profile', $this->profile($request));
        View::share('_nav', parse_url($request->fullUrl(), PHP_URL_QUERY));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Verify::class, function () {
            return (new Verify())
                ->setCodeLength(config('app.sms_code.length'))
                ->setSentIntervalTime(config('app.sms_code.interval'))
                ->setSentMaxTimes(config('app.sms_code.fetch'))
                ->setVerifyTimes(config('app.sms_code.verify'))
                ->setYxTime(config('app.sms_code.validity'));
        });
    }
}
