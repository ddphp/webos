<?php

namespace App\Http\Middleware;

use Closure;

/**
 * 与微挚 AccessToken 保持一致
 */
class SyncAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $app = app(\EasyWeChat\Foundation\Application::class);
        $we7DB = \DB::connection('we7');
        $acid  = $we7DB->table('ims_account_wechats')->where('key', config('wechat.app_id'))->value('acid');
        $we7DBCache = $we7DB->table('ims_core_cache')->where('key', "accesstoken:{$acid}");
        $token = unserialize($we7DBCache->value('value'));  // array:expire token
        $time = time();
        $access = $app->access_token;
        if ($time >= $token['expire']) {
            $tokenStr = $access->getToken(true);
            $token = [
                'token'  => $tokenStr,
                'expire' => $time + 7200 - 200
            ];
            $we7DBCache->update(['value' => serialize($token)]);
        }
        $access->setToken($token['token'], $token['expire'] - $time);

        return $next($request);
    }
}
