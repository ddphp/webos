<?php

namespace App\Http\Middleware;

use App\Models\Admin\Config;
use Closure;

class WxUserConfig
{
    use \App\Traits\Config;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $onlyWx = 'no')
    {
        $wechat = $this->config('mp.base');
        if ($wechat) {
            config(array_dot(['wechat' => $wechat]));
            if ($onlyWx !== 'yes') {
                config(array_dot(['app.company' => $this->config('member.company')]));
                config(array_dot(['app.sms' => $this->config('member.sms')]));
                config(array_dot(['app.sms_code' => $this->config('member.verify')]));
                config(array_dot(['app.card' => $this->config('member.card')]));
            }
        }
        return $next($request);
    }
}
